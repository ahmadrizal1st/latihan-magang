<?php

namespace App\Services;

use App\Models\Counter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NipService
{
    /**
     * Generate NIP based on date of birth and current year-month.
     *
     * Format : {year_born}{month_born}{day_born}{yy_created}{mm_created}{counter(5)}
     * Example: 2004      09          11         26          03          00001
     * Result : 20040911260300001
     *
     * @param  string  $dateOfBirth  Format: Y-m-d
     * @return string
     */
    public function generate(string $dateOfBirth): string
    {
        // Parse the date of birth and get the current date
        $born = Carbon::parse($dateOfBirth);
        $now  = Carbon::now();

        // Build the NIP prefix from:
        // - Date of birth (year + month + day): e.g. "20040911"
        // - Creation year (2-digit) + month   : e.g. "2603"
        // Result: "200409112603"
        $prefix = $born->format('Ymd')
                . $now->format('y')
                . $now->format('m');

        // Use a database transaction to prevent race conditions
        // when multiple requests hit simultaneously
        $counter = DB::transaction(function () {

            // Lock the single 'nip' row to prevent race conditions
            // on PostgreSQL, ensuring only one transaction can
            // increment the counter at a time.
            Counter::lockForUpdate()->where('code', 'nip')->first();

            // Get the current counter value from the 'nip' row,
            // then increment by 1 for the new entry.
            // If no row exists yet, start from 1.
            $maxCounter  = Counter::where('code', 'nip')->value('counter') ?? 0;
            $nextCounter = $maxCounter + 1;

            // Update the counter if the 'nip' row already exists,
            // or create it if this is the first NIP generation.
            Counter::updateOrCreate(
                ['code'        => 'nip'],
                [
                    'description' => 'Employee NIP',
                    'counter'     => $nextCounter,
                ]
            );

            return $nextCounter;
        });

        // Combine prefix + zero-padded 5-digit counter
        // Example: "200409112603" + "00002" = "20040911260300002"
        return $prefix . str_pad($counter, 5, '0', STR_PAD_LEFT);
    }
}