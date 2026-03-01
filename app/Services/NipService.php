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
        $counter = DB::transaction(function () use ($prefix) {

            // Lock the row with the highest counter value to prevent
            // race conditions on PostgreSQL. This is done separately
            // from the aggregate query since PostgreSQL does not allow
            // FOR UPDATE with aggregate functions.
            Counter::lockForUpdate()->orderBy('counter', 'desc')->first();

            // Get the highest counter value across all rows,
            // then increment by 1 for the new entry.
            // If no rows exist yet, start from 1.
            $maxCounter  = Counter::max('counter') ?? 0;
            $nextCounter = $maxCounter + 1;

            // Build the full NIP code (prefix + 5-digit padded counter)
            // to store in the code column for traceability.
            // Example: "200409112603" + "00002" = "20040911260300002"
            $fullNip = $prefix . str_pad($nextCounter, 5, '0', STR_PAD_LEFT);

            // Insert a new row for each NIP generation.
            // The code column stores the complete generated NIP,
            // so each row can be traced back to which employee it belongs to.
            Counter::create([
                'code'        => $fullNip,
                'description' => 'Employee NIP',
                'counter'     => $nextCounter,
            ]);

            return $nextCounter;
        });

        // Combine prefix + zero-padded 5-digit counter
        // Example: "200409112603" + "00002" = "20040911260300002"
        return $prefix . str_pad($counter, 5, '0', STR_PAD_LEFT);
    }
}