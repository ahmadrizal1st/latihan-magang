@extends('layouts.dashboard')

@section('title', 'Employee Job')
@section('page-title', 'Employee Job')
@section('page-subtitle', 'Table')

@section('breadcrumb')
    <li class="active">Employee Job</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Employee Job Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateEmployeeJob">
                            <i class="fa fa-plus"></i> Add Employee Job
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Employee</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="employee-job-table-body">
                            {{-- Diisi oleh AJAX sebelum DataTable diinisialisasi --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Employee</th>
                                <th>Action</th>
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

{{-- Modal Create Employee Job --}}
<div class="modal fade" id="modalCreateEmployeeJob" tabindex="-1" role="dialog" aria-labelledby="modalCreateEmployeeJobLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalCreateEmployeeJobLabel">
                    <i class="fa fa-plus-circle"></i> Create Employee Job
                </h4>
            </div>
            <form id="formCreateEmployeeJob" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jobName">Job Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="jobName" name="name" placeholder="Enter job name...">
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
{{-- /.modal --}}

{{-- Modal Edit Employee Job --}}
<div class="modal fade" id="modalEditEmployeeJob" tabindex="-1" role="dialog" aria-labelledby="modalEditEmployeeJobLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditEmployeeJobLabel">
                    <i class="fa fa-pencil"></i> Edit Employee Job
                </h4>
            </div>
            <form id="formEditEmployeeJob" role="form">
                <input type="hidden" id="editJobId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editJobName">Job Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editJobName" name="name" placeholder="Enter job name...">
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
{{-- /.modal --}}

{{-- Modal Confirm Delete --}}
<div class="modal fade" id="modalDeleteEmployeeJob" tabindex="-1" role="dialog" aria-labelledby="modalDeleteEmployeeJobLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteEmployeeJobLabel">
                    <i class="fa fa-trash"></i> Confirm Delete
                </h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteJobName"></strong>?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="deleteJobId">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmDelete">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>
{{-- /.modal --}}

@endsection

@pushOnce('scripts')
<script>
$(function () {
    // Initialize DataTable
    var table = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/employee-job',
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
            },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-warning btn-xs btn-edit"
                            data-id="${data}"
                            data-name="${row.name}"
                            data-description="${row.description ?? ''}">
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
    $('#formCreateEmployeeJob').on('submit', function(e) {
        e.preventDefault();

        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '/api/employee-job',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#modalCreateEmployeeJob').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formCreateEmployeeJob');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
            }
        });
    });

    // OPEN EDIT MODAL
    $('#example1').on('click', '.btn-edit', function() {
        var id          = $(this).data('id');
        var name        = $(this).data('name');
        var description = $(this).data('description');

        $('#editJobId').val(id);
        $('#editJobName').val(name);

        $('#modalEditEmployeeJob').modal('show');
    });

    // EDIT SUBMIT
    $('#formEditEmployeeJob').on('submit', function(e) {
        e.preventDefault();

        var id   = $('#editJobId').val();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url: '/api/employee-job/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                $('#modalEditEmployeeJob').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formEditEmployeeJob');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            }
        });
    });

    // OPEN DELETE MODAL
    $('#example1').on('click', '.btn-delete', function() {
        var id   = $(this).data('id');
        var name = $(this).data('name');

        $('#deleteJobId').val(id);
        $('#deleteJobName').text(name);

        $('#modalDeleteEmployeeJob').modal('show');
    });

    // CONFIRM DELETE
    $('#btnConfirmDelete').on('click', function() {
        var id   = $('#deleteJobId').val();
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: '/api/employee-job/' + id,
            type: 'DELETE',
            success: function(response) {
                $('#modalDeleteEmployeeJob').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                alert('Failed to delete. Please try again.');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Delete');
            }
        });
    });

    // RESET MODALS ON CLOSE
    $('#modalCreateEmployeeJob, #modalEditEmployeeJob').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $(this).find('.form-group').removeClass('has-error');
        $(this).find('.help-block.error-msg').remove();
    });

    // HELPER: Validation Errors
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