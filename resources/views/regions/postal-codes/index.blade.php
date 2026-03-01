@extends('layouts.dashboard')

@section('title', 'Postal Code')
@section('page-title', 'Postal Code')
@section('page-subtitle', 'Table')

@section('breadcrumb')
    <li class="active">Postal Code</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Postal Code Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreatePostalCode">
                            <i class="fa fa-plus"></i> Add Postal Code
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Employees</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
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

{{-- Modal Create Postal Code --}}
<div class="modal fade" id="modalCreatePostalCode" tabindex="-1" role="dialog" aria-labelledby="modalCreatePostalCodeLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalCreatePostalCodeLabel">
                    <i class="fa fa-plus-circle"></i> Create Postal Code
                </h4>
            </div>
            <form id="formCreatePostalCode" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="postalCode">Postal Code <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="postalCode" name="code" placeholder="Enter postal code..." maxlength="10">
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

{{-- Modal Edit Postal Code --}}
<div class="modal fade" id="modalEditPostalCode" tabindex="-1" role="dialog" aria-labelledby="modalEditPostalCodeLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditPostalCodeLabel">
                    <i class="fa fa-pencil"></i> Edit Postal Code
                </h4>
            </div>
            <form id="formEditPostalCode" role="form">
                <input type="hidden" id="editPostalCodeId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editPostalCode">Postal Code <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editPostalCode" name="code" placeholder="Enter postal code..." maxlength="10">
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
<div class="modal fade" id="modalDeletePostalCode" tabindex="-1" role="dialog" aria-labelledby="modalDeletePostalCodeLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeletePostalCodeLabel">
                    <i class="fa fa-trash"></i> Confirm Delete
                </h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete postal code <strong id="deletePostalCodeCode"></strong>?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="deletePostalCodeId">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmDeletePostalCode">
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
            url: '/api/postal-code',
            type: 'GET',
            data: function(d) {
                d.datatable = true;
                return d;
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            {
                data: 'employees_count',
                name: 'employees_count',
                orderable: false,
                searchable: false,
                defaultContent: '0',
                render: function(data) {
                    return data ?? 0;
                }
            },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-warning btn-xs btn-edit"
                            data-id="${data}"
                            data-code="${row.name}">
                            <i class="fa fa-pencil"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-xs btn-delete"
                            data-id="${data}"
                            data-code="${row.name}">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    `;
                }
            }
        ],
    });

    // CREATE
    $('#formCreatePostalCode').on('submit', function(e) {
        e.preventDefault();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '/api/postal-code',
            type: 'POST',
            data: $(this).serialize(),
            success: function() {
                $('#modalCreatePostalCode').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formCreatePostalCode');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
            }
        });
    });

    // OPEN EDIT MODAL
    $('#example1').on('click', '.btn-edit', function() {
        $('#editPostalCodeId').val($(this).data('id'));
        $('#editPostalCode').val($(this).data('code'));
        $('#modalEditPostalCode').modal('show');
    });

    // EDIT SUBMIT
    $('#formEditPostalCode').on('submit', function(e) {
        e.preventDefault();
        var id   = $('#editPostalCodeId').val();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url: '/api/postal-code/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function() {
                $('#modalEditPostalCode').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formEditPostalCode');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            }
        });
    });

    // OPEN DELETE MODAL
    $('#example1').on('click', '.btn-delete', function() {
        $('#deletePostalCodeId').val($(this).data('id'));
        $('#deletePostalCodeCode').text($(this).data('code'));
        $('#modalDeletePostalCode').modal('show');
    });

    // CONFIRM DELETE
    $('#btnConfirmDeletePostalCode').on('click', function() {
        var id   = $('#deletePostalCodeId').val();
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: '/api/postal-code/' + id,
            type: 'DELETE',
            success: function() {
                $('#modalDeletePostalCode').modal('hide');
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
    $('#modalCreatePostalCode, #modalEditPostalCode').on('hidden.bs.modal', function() {
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