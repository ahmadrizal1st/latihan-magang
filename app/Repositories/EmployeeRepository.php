<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;


class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(
        private Employee $model
    ) {}

    public function getAll()
    {
        /** 
         * Penggunaan relasi menggunakan with() mengatasi n+1 problem
         * Method select() digunakan untuk memilih semua kolom untuk penerapan yajra datatables
         * Yajra bisa tambahkan WHERE, LIMIT, ORDER BY, dll
         * Hasil: Builder (query belum dieksekusi)
         * Hanya mendefinisikan "ambil semua kolom dari tabel employees"
         * 
         * Jika menggunakan get()
         * Bisa jalan tapi tidak efisien, karena semua data sudah di-load
         * Yajra filter di PHP bukan di database
         */
        return Employee::with(['city', 'employeeJob']);
    }
}