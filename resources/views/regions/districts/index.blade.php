@extends('layouts.dashboard')

@section('title', 'District')
@section('page-title', 'District')
@section('page-subtitle', 'Table')

@section('breadcrumb')
    <li class="active">District</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">District Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateDistrict">
                            <i class="fa fa-plus"></i> Add District
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Villages</th>
                                <th>Employees</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Villages</th>
                                <th>Employees</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- Modal Create District --}}
<div class="modal fade" id="modalCreateDistrict" tabindex="-1" role="dialog" aria-labelledby="modalCreateDistrictLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalCreateDistrictLabel">
                    <i class="fa fa-plus-circle"></i> Create District
                </h4>
            </div>
            <form id="formCreateDistrict" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="districtCityId">City <span class="text-red">*</span></label>
                        <select class="form-control select2-city" id="districtCityId" name="city_id" style="width: 100%;">
                            <option value="">-- Select City --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="districtName">District Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="districtName" name="name" placeholder="Enter district name...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit District --}}
<div class="modal fade" id="modalEditDistrict" tabindex="-1" role="dialog" aria-labelledby="modalEditDistrictLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditDistrictLabel">
                    <i class="fa fa-pencil"></i> Edit District
                </h4>
            </div>
            <form id="formEditDistrict" role="form">
                <input type="hidden" id="editDistrictId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editDistrictCityId">City <span class="text-red">*</span></label>
                        <select class="form-control select2-city" id="editDistrictCityId" name="city_id" style="width: 100%;">
                            <option value="">-- Select City --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editDistrictName">District Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editDistrictName" name="name" placeholder="Enter district name...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Confirm Delete --}}
<div class="modal fade" id="modalDeleteDistrict" tabindex="-1" role="dialog" aria-labelledby="modalDeleteDistrictLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteDistrictLabel">
                    <i class="fa fa-trash"></i> Confirm Delete
                </h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteDistrictName"></strong>?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="deleteDistrictId">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmDeleteDistrict">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@pushOnce('scripts')
<script>
$(function () {

    // ── INIT SELECT2 CITY ─────────────────────────────────────────────────────
    function initSelect2City(selector, modalSelector) {
        $(selector).select2({
            placeholder: '-- Select City --',
            allowClear: true,
            dropdownParent: $(modalSelector),
            ajax: {
                url: '/api/city',
                type: 'GET',
                dataType: 'json',
                delay: 300,
                data: function (params) {
                    return {
                        search: params.term || '',
                        page: params.page || 1
                    };
                },
                processResults: function (response) {
                    return {
                        results: response.results,
                        pagination: response.pagination ?? { more: false }
                    };
                },
                cache: true
            },
            minimumInputLength: 0
        });
    }

    initSelect2City('#districtCityId',     '#modalCreateDistrict');
    initSelect2City('#editDistrictCityId', '#modalEditDistrict');


    // ── DATATABLE ─────────────────────────────────────────────────────────────
    var table = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/district',
            type: 'GET',
            data: function(d) {
                d.datatable = true;
                return d;
            }
        },
        columns: [
            { data: 'DT_RowIndex',     name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name',            name: 'name' },
            { data: 'city_name',       name: 'city_name', orderable: false, searchable: false },
            { data: 'villages_count',  name: 'villages_count',  searchable: false, orderable: false, defaultContent: 0 },
            { data: 'employees_count', name: 'employees_count', searchable: false, orderable: false, defaultContent: 0 },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-warning btn-xs btn-edit"
                            data-id="${data}"
                            data-name="${row.name}"
                            data-city-id="${row.city_id ?? ''}"
                            data-city-name="${row.city_name ?? ''}">
                            <i class="fa fa-pencil"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-xs btn-delete"
                            data-id="${data}"
                            data-name="${row.name}">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    `;
                }
            }
        ],
    });


    // ── CREATE ────────────────────────────────────────────────────────────────
    $('#formCreateDistrict').on('submit', function(e) {
        e.preventDefault();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '/api/district',
            type: 'POST',
            data: $(this).serialize(),
            success: function() {
                $('#modalCreateDistrict').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formCreateDistrict');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
            }
        });
    });


    // ── OPEN EDIT MODAL ───────────────────────────────────────────────────────
    $('#example1').on('click', '.btn-edit', function() {
        var cityId   = $(this).data('city-id');
        var cityName = $(this).data('city-name');

        $('#editDistrictId').val($(this).data('id'));
        $('#editDistrictName').val($(this).data('name'));

        // Set nilai Select2 secara programatik
        var $select = $('#editDistrictCityId');
        if ($select.find('option[value="' + cityId + '"]').length === 0) {
            $select.append(new Option(cityName, cityId, true, true));
        }
        $select.val(cityId).trigger('change');

        $('#modalEditDistrict').modal('show');
    });


    // ── EDIT SUBMIT ───────────────────────────────────────────────────────────
    $('#formEditDistrict').on('submit', function(e) {
        e.preventDefault();
        var id   = $('#editDistrictId').val();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url: '/api/district/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function() {
                $('#modalEditDistrict').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formEditDistrict');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            }
        });
    });


    // ── OPEN DELETE MODAL ─────────────────────────────────────────────────────
    $('#example1').on('click', '.btn-delete', function() {
        $('#deleteDistrictId').val($(this).data('id'));
        $('#deleteDistrictName').text($(this).data('name'));
        $('#modalDeleteDistrict').modal('show');
    });


    // ── CONFIRM DELETE ────────────────────────────────────────────────────────
    $('#btnConfirmDeleteDistrict').on('click', function() {
        var id   = $('#deleteDistrictId').val();
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: '/api/district/' + id,
            type: 'DELETE',
            success: function() {
                $('#modalDeleteDistrict').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function() {
                alert('Failed to delete. Please try again.');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Delete');
            }
        });
    });


    // ── RESET MODALS ON CLOSE ─────────────────────────────────────────────────
    $('#modalCreateDistrict, #modalEditDistrict').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $(this).find('.form-group').removeClass('has-error');
        $(this).find('.help-block.error-msg').remove();
        $(this).find('.select2-city').val(null).trigger('change');
    });


    // ── VALIDATION HELPER ─────────────────────────────────────────────────────
    function handleValidationErrors(xhr, formSelector) {
        $(formSelector + ' .form-group').removeClass('has-error');
        $(formSelector + ' .help-block.error-msg').remove();
        var errors = xhr.responseJSON?.errors;
        if (errors) {
            $.each(errors, function(field, messages) {
                var $input = $(formSelector + ' [name="' + field + '"]');
                $input.closest('.form-group').addClass('has-error');
                $input.after('<span class="help-block error-msg">' + messages[0] + '</span>');
            });
        }
    }
});
</script>
@endPushOnce