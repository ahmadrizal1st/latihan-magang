@extends('layouts.dashboard')

@section('title', 'Village')
@section('page-title', 'Village')
@section('page-subtitle', 'Table')

@section('breadcrumb')
    <li class="active">Village</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Village Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateVillage">
                            <i class="fa fa-plus"></i> Add Village
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>District</th>
                                <th>Employees</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>District</th>
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

{{-- Modal Create Village --}}
<div class="modal fade" id="modalCreateVillage" tabindex="-1" role="dialog" aria-labelledby="modalCreateVillageLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalCreateVillageLabel">
                    <i class="fa fa-plus-circle"></i> Create Village
                </h4>
            </div>
            <form id="formCreateVillage" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="villageDistrictId">District <span class="text-red">*</span></label>
                        <select class="form-control select2-district" id="villageDistrictId" name="district_id" style="width: 100%;">
                            <option value="">-- Select District --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="villageName">Village Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="villageName" name="name" placeholder="Enter village name...">
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

{{-- Modal Edit Village --}}
<div class="modal fade" id="modalEditVillage" tabindex="-1" role="dialog" aria-labelledby="modalEditVillageLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditVillageLabel">
                    <i class="fa fa-pencil"></i> Edit Village
                </h4>
            </div>
            <form id="formEditVillage" role="form">
                <input type="hidden" id="editVillageId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editVillageDistrictId">District <span class="text-red">*</span></label>
                        <select class="form-control select2-district" id="editVillageDistrictId" name="district_id" style="width: 100%;">
                            <option value="">-- Select District --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editVillageName">Village Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editVillageName" name="name" placeholder="Enter village name...">
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
<div class="modal fade" id="modalDeleteVillage" tabindex="-1" role="dialog" aria-labelledby="modalDeleteVillageLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteVillageLabel">
                    <i class="fa fa-trash"></i> Confirm Delete
                </h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteVillageName"></strong>?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="deleteVillageId">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmDeleteVillage">
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

    // ── INIT SELECT2 DISTRICT ─────────────────────────────────────────────────
    function initSelect2District(selector, modalSelector) {
        $(selector).select2({
            placeholder: '-- Select District --',
            allowClear: true,
            dropdownParent: $(modalSelector),
            ajax: {
                url: '/api/district',
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

    initSelect2District('#villageDistrictId',     '#modalCreateVillage');
    initSelect2District('#editVillageDistrictId', '#modalEditVillage');


    // ── DATATABLE ─────────────────────────────────────────────────────────────
    var table = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/village',
            type: 'GET',
            data: function(d) {
                d.datatable = true;
                return d;
            }
        },
        columns: [
            { data: 'DT_RowIndex',     name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name',            name: 'name' },
            { data: 'district_name',   name: 'district_name', orderable: false, searchable: false, defaultContent: '-' },
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
                            data-district-id="${row.district_id ?? ''}"
                            data-district-name="${row.district_name ?? ''}">
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
    $('#formCreateVillage').on('submit', function(e) {
        e.preventDefault();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '/api/village',
            type: 'POST',
            data: $(this).serialize(),
            success: function() {
                $('#modalCreateVillage').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formCreateVillage');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
            }
        });
    });


    // ── OPEN EDIT MODAL ───────────────────────────────────────────────────────
    $('#example1').on('click', '.btn-edit', function() {
        var districtId   = $(this).data('district-id');
        var districtName = $(this).data('district-name');

        $('#editVillageId').val($(this).data('id'));
        $('#editVillageName').val($(this).data('name'));

        var $select = $('#editVillageDistrictId');
        if ($select.find('option[value="' + districtId + '"]').length === 0) {
            $select.append(new Option(districtName, districtId, true, true));
        }
        $select.val(districtId).trigger('change');

        $('#modalEditVillage').modal('show');
    });


    // ── EDIT SUBMIT ───────────────────────────────────────────────────────────
    $('#formEditVillage').on('submit', function(e) {
        e.preventDefault();
        var id   = $('#editVillageId').val();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url: '/api/village/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function() {
                $('#modalEditVillage').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formEditVillage');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            }
        });
    });


    // ── OPEN DELETE MODAL ─────────────────────────────────────────────────────
    $('#example1').on('click', '.btn-delete', function() {
        $('#deleteVillageId').val($(this).data('id'));
        $('#deleteVillageName').text($(this).data('name'));
        $('#modalDeleteVillage').modal('show');
    });


    // ── CONFIRM DELETE ────────────────────────────────────────────────────────
    $('#btnConfirmDeleteVillage').on('click', function() {
        var id   = $('#deleteVillageId').val();
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: '/api/village/' + id,
            type: 'DELETE',
            success: function() {
                $('#modalDeleteVillage').modal('hide');
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
    $('#modalCreateVillage, #modalEditVillage').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $(this).find('.form-group').removeClass('has-error');
        $(this).find('.help-block.error-msg').remove();
        $(this).find('.select2-district').val(null).trigger('change');
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