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
                    <h3 class="box-title">City Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateCity">
                            <i class="fa fa-plus"></i> Add City
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Province</th>
                                <th>Districts</th>
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
                                <th>Province</th>
                                <th>Districts</th>
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

{{-- Modal Create City --}}
<div class="modal fade" id="modalCreateCity" tabindex="-1" role="dialog" aria-labelledby="modalCreateCityLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalCreateCityLabel">
                    <i class="fa fa-plus-circle"></i> Create City
                </h4>
            </div>
            <form id="formCreateCity" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="provinceId">Province <span class="text-red">*</span></label>
                        <select class="form-control select2-province" id="provinceId" name="province_id" style="width: 100%;">
                            <option value="">-- Select Province --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cityName">City Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="cityName" name="name" placeholder="Enter city name...">
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

{{-- Modal Edit City --}}
<div class="modal fade" id="modalEditCity" tabindex="-1" role="dialog" aria-labelledby="modalEditCityLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditCityLabel">
                    <i class="fa fa-pencil"></i> Edit City
                </h4>
            </div>
            <form id="formEditCity" role="form">
                <input type="hidden" id="editCityId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editProvinceId">Province <span class="text-red">*</span></label>
                        <select class="form-control select2-province" id="editProvinceId" name="province_id" style="width: 100%;">
                            <option value="">-- Select Province --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editCityName">City Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editCityName" name="name" placeholder="Enter city name...">
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
<div class="modal fade" id="modalDeleteCity" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCityLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteCityLabel">
                    <i class="fa fa-trash"></i> Confirm Delete
                </h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteCityName"></strong>?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="deleteCityId">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmDeleteCity">
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

    // ── INIT SELECT2 ──────────────────────────────────────────────────────────
    function initSelect2Province(selector, modalSelector) {
        $(selector).select2({
            placeholder: '-- Select Province --',
            allowClear: true,
            dropdownParent: $(modalSelector),
            ajax: {
                url: '/api/province',
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
                    // API mengembalikan { results: [{id, text}, ...], pagination: {more} }
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

    initSelect2Province('#provinceId',     '#modalCreateCity');
    initSelect2Province('#editProvinceId', '#modalEditCity');


    // ── DATATABLE ─────────────────────────────────────────────────────────────
    var table = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/city',
            type: 'GET',
            data: function(d) {
                d.datatable = true;
                return d;
            }
        },
        columns: [
            { data: 'DT_RowIndex',     name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name',            name: 'name' },
            { data: 'province_name',   name: 'province_name' },
            { data: 'districts_count', name: 'districts_count', searchable: false },
            { data: 'villages_count',  name: 'villages_count',  searchable: false },
            { data: 'employees_count', name: 'employees_count', searchable: false },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-warning btn-xs btn-edit"
                            data-id="${data}"
                            data-name="${row.name}"
                            data-province-id="${row.province_id}"
                            data-province-name="${row.province_name}">
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
    $('#formCreateCity').on('submit', function(e) {
        e.preventDefault();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '/api/city',
            type: 'POST',
            data: $(this).serialize(),
            success: function() {
                $('#modalCreateCity').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formCreateCity');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
            }
        });
    });


    // ── OPEN EDIT MODAL ───────────────────────────────────────────────────────
    $('#example1').on('click', '.btn-edit', function() {
        var provinceId   = $(this).data('province-id');
        var provinceName = $(this).data('province-name');

        $('#editCityId').val($(this).data('id'));
        $('#editCityName').val($(this).data('name'));

        // Set nilai Select2 secara programatik (buat option jika belum ada)
        var $select = $('#editProvinceId');
        if ($select.find('option[value="' + provinceId + '"]').length === 0) {
            $select.append(new Option(provinceName, provinceId, true, true));
        }
        $select.val(provinceId).trigger('change');

        $('#modalEditCity').modal('show');
    });

    // ── EDIT SUBMIT ───────────────────────────────────────────────────────────
    $('#formEditCity').on('submit', function(e) {
        e.preventDefault();
        var id   = $('#editCityId').val();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url: '/api/city/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function() {
                $('#modalEditCity').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formEditCity');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            }
        });
    });


    // ── OPEN DELETE MODAL ─────────────────────────────────────────────────────
    $('#example1').on('click', '.btn-delete', function() {
        $('#deleteCityId').val($(this).data('id'));
        $('#deleteCityName').text($(this).data('name'));
        $('#modalDeleteCity').modal('show');
    });

    // ── CONFIRM DELETE ────────────────────────────────────────────────────────
    $('#btnConfirmDeleteCity').on('click', function() {
        var id   = $('#deleteCityId').val();
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: '/api/city/' + id,
            type: 'DELETE',
            success: function() {
                $('#modalDeleteCity').modal('hide');
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
    $('#modalCreateCity, #modalEditCity').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $(this).find('.form-group').removeClass('has-error');
        $(this).find('.help-block.error-msg').remove();
        // Reset Select2 ke placeholder
        $(this).find('.select2-province').val(null).trigger('change');
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