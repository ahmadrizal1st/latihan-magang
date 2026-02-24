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
    $.ajax({
        url: '/api/employee',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var tbody = $('#employee-table-body');
            tbody.empty();

            if (!response.data || response.data.length === 0) {
                tbody.append('<tr><td colspan="4" class="text-center">No data available</td></tr>');
            } else {
                $.each(response.data, function (index, employee) {
                    tbody.append(
                        '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + employee.name + '</td>' +
                            '<td>' + employee.city + '</td>' +
                            '<td>' + employee.job  + '</td>' +
                        '</tr>'
                    );
                });
            }

            // Initialize DataTable AFTER data is populated
            $('#example1').DataTable();
            
            // Optional: Initialize example2 if it exists
            if ($('#example2').length) {
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                });
            }
        },
        error: function (xhr, status, error) {
            $('#employee-table-body').html(
                '<tr><td colspan="4" class="text-center text-danger">' +
                'Failed to load data: ' + error +
                '</td></tr>'
            );
        }
    });
});
</script>
@endPushOnce