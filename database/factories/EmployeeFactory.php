<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;
use App\Models\District;
use App\Models\EmployeeJob;
use App\Models\Province;
use App\Models\Village;
use App\Services\NipService;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $province = Province::inRandomOrder()->first();
            $city = City::where('province_id', $province->id)->inRandomOrder()->first();
        } while (!$city);

        do {
            $district = District::where('city_id', $city->id)->inRandomOrder()->first();
        } while (!$district);

        do {
            $village = Village::where('district_id', $district->id)->inRandomOrder()->first();
        } while (!$village);

        $dateOfBirth = $this->faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d');
        $nip = app(NipService::class)->generate($dateOfBirth);

        return [
            'name'            => $this->faker->name(),
            'nip'             => $nip,
            'job_id'          => EmployeeJob::inRandomOrder()->first()->id,
            'date_of_birth'   => $this->faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
            'place_of_birth'  => $this->faker->city(),
            'address'         => $this->faker->address(),
            'province_id'     => $province->id,
            'city_id'         => $city->id,
            'district_id'     => $district->id,
            'village_id'      => $village->id,
            'post_code'       => $this->faker->postcode(),
            'photo'           => null,
        ];
    }
}