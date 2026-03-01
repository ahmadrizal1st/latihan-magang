@extends('layouts.dashboard')

@section('title', 'Counter')
@section('page-title', 'Counter')
@section('page-subtitle', 'Table')

@section('breadcrumb')
    <li class="active">Counter</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Counter Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateCounter">
                            <i class="fa fa-plus"></i> Add Counter
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Counter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Counter</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- Modal Create Counter --}}
<div class="modal fade" id="modalCreateCounter" tabindex="-1" role="dialog" aria-labelledby="modalCreateCounterLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalCreateCounterLabel">
                    <i class="fa fa-plus-circle"></i> Create Counter
                </h4>
            </div>
            <form id="formCreateCounter" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="counterCode">Code <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="counterCode" name="code" placeholder="Enter counter code...">
                    </div>
                    <div class="form-group">
                        <label for="counterDescription">Description</label>
                        <input type="text" class="form-control" id="counterDescription" name="description" placeholder="Enter description...">
                    </div>
                    <div class="form-group">
                        <label for="counterValue">Counter <span class="text-red">*</span></label>
                        <input type="number" class="form-control" id="counterValue" name="counter" placeholder="0" min="0" value="0">
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

{{-- Modal Edit Counter --}}
<div class="modal fade" id="modalEditCounter" tabindex="-1" role="dialog" aria-labelledby="modalEditCounterLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditCounterLabel">
                    <i class="fa fa-pencil"></i> Edit Counter
                </h4>
            </div>
            <form id="formEditCounter" role="form">
                <input type="hidden" id="editCounterId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editCounterCode">Code <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editCounterCode" name="code" placeholder="Enter counter code...">
                    </div>
                    <div class="form-group">
                        <label for="editCounterDescription">Description</label>
                        <input type="text" class="form-control" id="editCounterDescription" name="description" placeholder="Enter description...">
                    </div>
                    <div class="form-group">
                        <label for="editCounterValue">Counter <span class="text-red">*</span></label>
                        <input type="number" class="form-control" id="editCounterValue" name="counter" placeholder="0" min="0">
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
<div class="modal fade" id="modalDeleteCounter" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCounterLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteCounterLabel">
                    <i class="fa fa-trash"></i> Confirm Delete
                </h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete counter <strong id="deleteCounterCode"></strong>?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="deleteCounterId">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmDeleteCounter">
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
            url: '/api/counter',
            type: 'GET',
            data: function(d) {
                d.datatable = true;
                return d;
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'code', name: 'code' },
            {
                data: 'description',
                name: 'description',
                render: function(data) {
                    return data ?? '-';
                }
            },
            { data: 'counter', name: 'counter' },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-warning btn-xs btn-edit"
                            data-id="${data}"
                            data-code="${row.code}"
                            data-description="${row.description ?? ''}"
                            data-counter="${row.counter}">
                            <i class="fa fa-pencil"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-xs btn-delete"
                            data-id="${data}"
                            data-code="${row.code}">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    `;
                }
            }
        ],
    });

    // CREATE
    $('#formCreateCounter').on('submit', function(e) {
        e.preventDefault();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '/api/counter',
            type: 'POST',
            data: $(this).serialize(),
            success: function() {
                $('#modalCreateCounter').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formCreateCounter');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
            }
        });
    });

    // OPEN EDIT MODAL
    $('#example1').on('click', '.btn-edit', function() {
        $('#editCounterId').val($(this).data('id'));
        $('#editCounterCode').val($(this).data('code'));
        $('#editCounterDescription').val($(this).data('description'));
        $('#editCounterValue').val($(this).data('counter'));
        $('#modalEditCounter').modal('show');
    });

    // EDIT SUBMIT
    $('#formEditCounter').on('submit', function(e) {
        e.preventDefault();
        var id   = $('#editCounterId').val();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url: '/api/counter/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function() {
                $('#modalEditCounter').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formEditCounter');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            }
        });
    });

    // OPEN DELETE MODAL
    $('#example1').on('click', '.btn-delete', function() {
        $('#deleteCounterId').val($(this).data('id'));
        $('#deleteCounterCode').text($(this).data('code'));
        $('#modalDeleteCounter').modal('show');
    });

    // CONFIRM DELETE
    $('#btnConfirmDeleteCounter').on('click', function() {
        var id   = $('#deleteCounterId').val();
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: '/api/counter/' + id,
            type: 'DELETE',
            success: function() {
                $('#modalDeleteCounter').modal('hide');
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
    $('#modalCreateCounter, #modalEditCounter').on('hidden.bs.modal', function() {
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