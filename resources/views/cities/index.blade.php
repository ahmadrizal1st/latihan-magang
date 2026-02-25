@extends('layouts.dashboard')

@section('title', 'City')
@section('page-title', 'City')
@section('page-subtitle', 'Table')

@section('breadcrumb')
    <li class="active">City</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">city Data Table</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Employee</th>
                            </tr>
                        </thead>
                        <tbody id="city-table-body">
                            {{-- Diisi oleh AJAX sebelum DataTable diinisialisasi --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Employee</th>
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
        url: '/api/city',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var tbody = $('#city-table-body');
            tbody.empty();

            if (!response.data || response.data.length === 0) {
                tbody.append('<tr><td colspan="4" class="text-center">No data available</td></tr>');
            } else {
                $.each(response.data, function (index, city) {
                    tbody.append(
                        '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + city.name + '</td>' +
                            '<td>' + city.employees.length + '</td>' +
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
            $('#city-table-body').html(
                '<tr><td colspan="4" class="text-center text-danger">' +
                'Failed to load data: ' + error +
                '</td></tr>'
            );
        }
    });
});
</script>
@endPushOnce