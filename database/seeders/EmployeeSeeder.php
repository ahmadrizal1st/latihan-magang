<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            ['name' => 'Jane Doe',            'city' => 'Madrid',  'job' => 'Programmer'],
            ['name' => 'Adam Smith',           'city' => 'London',  'job' => 'UI/UX Designer'],
            ['name' => 'Steven Berk',          'city' => 'Madrid',  'job' => 'System Analyst'],
            ['name' => 'John Drink Water',     'city' => 'Jakarta', 'job' => 'Programmer'],
            ['name' => 'Alphonse Calman',      'city' => 'Paris',   'job' => 'UI/UX Designer'],
            ['name' => 'Paulo Verbose',        'city' => 'Jakarta', 'job' => 'System Analyst'],
            ['name' => 'Rebecca Bernardo',     'city' => 'Paris',   'job' => 'Programmer'],
            ['name' => 'Luis Petrucci',        'city' => 'London',  'job' => 'System Analyst'],
            ['name' => 'Frank Bethoveen',      'city' => 'Madrid',  'job' => 'UI/UX Designer'],
            ['name' => 'Calumn Sweet',         'city' => 'Jakarta', 'job' => 'UI/UX Designer'],
            ['name' => 'Edward Campbell',      'city' => 'Lisbon',  'job' => 'Programmer'],
            ['name' => 'Harry Potter',         'city' => 'Jakarta', 'job' => 'UI/UX Designer'],
            ['name' => 'Gilberto',             'city' => 'Lisbon',  'job' => 'System Analyst'],
            ['name' => 'Luka Smitic',          'city' => 'Madrid',  'job' => 'Programmer'],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}