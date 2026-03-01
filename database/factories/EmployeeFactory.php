<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\District;
use App\Models\EmployeeJob;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $province = Province::inRandomOrder()->first();
        $city = City::where('province_id', $province->id)->inRandomOrder()->first();
        $district = District::where('city_id', $city->id)->inRandomOrder()->first();
        $village = Village::where('district_id', $district->id)->inRandomOrder()->first();

        return [
            'name'            => $this->faker->name(),
            'job_id'          => EmployeeJob::inRandomOrder()->first()->id,
            'date_of_birth'   => $this->faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
            'place_of_birth'  => $this->faker->city(),
            'address'         => $this->faker->address(),
            'province_id'     => $province->id,
            'city_id'         => $city->id,
            'district_id'     => $district->id,
            'village_id'      => $village->id,
            'postal_code_id'  => null,
            'photo'           => null,
        ];
    }
}