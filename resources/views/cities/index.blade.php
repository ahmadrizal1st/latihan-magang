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
    $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/city',
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
                data: 'employees',
                orderable: false, 
                searchable: false,
                render: function(data) {
                    return data.length;
                }
            }
        ],
    });
});
</script>
@endPushOnce