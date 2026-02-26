@extends('layouts.dashboard')

@section('title', 'Employee')
@section('page-title', 'Employee')
@section('page-subtitle', 'Table')

@section('breadcrumb')
    <li class="active">Employee</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Employee Data Table</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Job</th>
                            </tr>
                        </thead>
                        <tbody id="employee-table-body">
                            {{-- Diisi oleh AJAX sebelum DataTable diinisialisasi --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Job</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                {{-- /.box-body --}}

            </div>
            {{-- /.box --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
</section>
@endsection

@pushOnce('scripts')
<script>
$(function () {
    $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/employee',
            type: 'GET',
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'city',
                name: 'city.name'
            },
            {
                data: 'employee_job',
                name: 'employeeJob.name' 
            },
        ],
    });
});
</script>
@endPushOnce