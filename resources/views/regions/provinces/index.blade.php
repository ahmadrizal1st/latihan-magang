@extends('layouts.dashboard')

@section('title', 'Province')
@section('page-title', 'Province')
@section('page-subtitle', 'Table')

@section('breadcrumb')
    <li class="active">Province</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Province Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateProvince">
                            <i class="fa fa-plus"></i> Add Province
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Cities</th>
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
                                <th>Cities</th>
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

{{-- Modal Create Province --}}
<div class="modal fade" id="modalCreateProvince" tabindex="-1" role="dialog" aria-labelledby="modalCreateProvinceLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalCreateProvinceLabel">
                    <i class="fa fa-plus-circle"></i> Create Province
                </h4>
            </div>
            <form id="formCreateProvince" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="provinceName">Province Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="provinceName" name="name" placeholder="Enter province name...">
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

{{-- Modal Edit Province --}}
<div class="modal fade" id="modalEditProvince" tabindex="-1" role="dialog" aria-labelledby="modalEditProvinceLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditProvinceLabel">
                    <i class="fa fa-pencil"></i> Edit Province
                </h4>
            </div>
            <form id="formEditProvince" role="form">
                <input type="hidden" id="editProvinceId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editProvinceName">Province Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editProvinceName" name="name" placeholder="Enter province name...">
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
<div class="modal fade" id="modalDeleteProvince" tabindex="-1" role="dialog" aria-labelledby="modalDeleteProvinceLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteProvinceLabel">
                    <i class="fa fa-trash"></i> Confirm Delete
                </h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteProvinceName"></strong>?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="deleteProvinceId">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmDeleteProvince">
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
    var table = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/province',
            type: 'GET',
            data: function(d) {
                d.datatable = true;
                return d;
            }
        },
        columns: [
            { data: 'DT_RowIndex',      name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name',             name: 'name' },
            { data: 'cities_count',     name: 'cities_count',     searchable: false },
            { data: 'districts_count',  name: 'districts_count',  searchable: false },
            { data: 'villages_count',   name: 'villages_count',   searchable: false },
            { data: 'employees_count',  name: 'employees_count',  searchable: false },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-warning btn-xs btn-edit"
                            data-id="${data}"
                            data-name="${row.name}">
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

    // CREATE
    $('#formCreateProvince').on('submit', function(e) {
        e.preventDefault();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '/api/province',
            type: 'POST',
            data: $(this).serialize(),
            success: function() {
                $('#modalCreateProvince').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formCreateProvince');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
            }
        });
    });

    // OPEN EDIT MODAL
    $('#example1').on('click', '.btn-edit', function() {
        $('#editProvinceId').val($(this).data('id'));
        $('#editProvinceName').val($(this).data('name'));
        $('#modalEditProvince').modal('show');
    });

    // EDIT SUBMIT
    $('#formEditProvince').on('submit', function(e) {
        e.preventDefault();
        var id   = $('#editProvinceId').val();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url: '/api/province/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function() {
                $('#modalEditProvince').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formEditProvince');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            }
        });
    });

    // OPEN DELETE MODAL
    $('#example1').on('click', '.btn-delete', function() {
        $('#deleteProvinceId').val($(this).data('id'));
        $('#deleteProvinceName').text($(this).data('name'));
        $('#modalDeleteProvince').modal('show');
    });

    // CONFIRM DELETE
    $('#btnConfirmDeleteProvince').on('click', function() {
        var id   = $('#deleteProvinceId').val();
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: '/api/province/' + id,
            type: 'DELETE',
            success: function() {
                $('#modalDeleteProvince').modal('hide');
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

    // RESET MODALS ON CLOSE
    $('#modalCreateProvince, #modalEditProvince').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $(this).find('.form-group').removeClass('has-error');
        $(this).find('.help-block.error-msg').remove();
    });

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