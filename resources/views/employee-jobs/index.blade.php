@extends('layouts.dashboard')

@section('title', 'Job')
@section('page-title', 'Job')
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
                    <h3 class="box-title">Job Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#modalCreateEmployeeJob">
                            <i class="fa fa-plus"></i> Add Job
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
                        <tbody></tbody>
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
            </div>
        </div>
    </div>
</section>

{{-- Modal Create --}}
<div class="modal fade" id="modalCreateEmployeeJob" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Create Job</h4>
            </div>
            <form id="formCreateEmployeeJob" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Job Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter job name...">
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

{{-- Modal Edit --}}
<div class="modal fade" id="modalEditEmployeeJob" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-pencil"></i> Edit Job</h4>
            </div>
            <form id="formEditEmployeeJob" role="form">
                <input type="hidden" id="editJobId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Job Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editJobName" name="name"
                            placeholder="Enter job name...">
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

{{-- Modal Delete --}}
<div class="modal fade" id="modalDeleteEmployeeJob" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal">
                    <span style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this job?</p>
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
@endsection

@pushOnce('scripts')
<script>
    $(function () {

        // Helper: Validation errors
        function handleValidationErrors(xhr, formSel) {
            $(formSel + ' .form-group').removeClass('has-error');
            $(formSel + ' .help-block.error-msg').remove();
            var errors = xhr.responseJSON?.errors;
            if (!errors) return;
            $.each(errors, function (field, messages) {
                var $input = $(formSel + ' [name="' + field + '"]');
                $input.closest('.form-group').addClass('has-error');
                $input.after('<span class="help-block error-msg">' + messages[0] + '</span>');
            });
        }

        // DataTable
        var table = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            responsive: false,
            autoWidth: false,
            ajax: {
                url: '/api/job',
                type: 'GET',
                data: function (d) {
                    d.datatable = true;
                    return d;
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                {
                    data: 'employees',
                    orderable: false,
                    searchable: false,
                    render: function (data) {
                        if (!data || !Array.isArray(data)) return 0;
                        return data.length;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return '<button class="btn btn-warning btn-xs btn-edit"'
                            + ' data-id="' + (row.id ?? '') + '"'
                            + ' data-name="' + (row.name ?? '') + '">'
                            + '<i class="fa fa-pencil"></i> Edit</button> '
                            + '<button class="btn btn-danger btn-xs btn-delete"'
                            + ' data-id="' + (row.id ?? '') + '">'
                            + '<i class="fa fa-trash"></i> Delete</button>';
                    }
                }
            ]
        });

        // Create
        $('#formCreateEmployeeJob').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
            $.ajax({
                url: '/api/job',
                type: 'POST',
                data: $form.serialize(),
                success: function () {
                    $('#modalCreateEmployeeJob').modal('hide');
                    table.ajax.reload();
                },
                error: function (xhr) {
                    handleValidationErrors(xhr, '#formCreateEmployeeJob');
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
                }
            });
        });

        // Edit
        $('#example1').on('click', '.btn-edit', function () {
            var $btn = $(this);
            $('#editJobId').val($btn.data('id'));
            $('#editJobName').val($btn.data('name'));
            $('#modalEditEmployeeJob').modal('show');
        });

        $('#formEditEmployeeJob').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            var id = $('#editJobId').val();
            var $btn = $form.find('[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
            $.ajax({
                url: '/api/job/' + id,
                type: 'PUT',
                data: $form.serialize(),
                success: function () {
                    $('#modalEditEmployeeJob').modal('hide');
                    table.ajax.reload(null, false);
                },
                error: function (xhr) {
                    handleValidationErrors(xhr, '#formEditEmployeeJob');
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                }
            });
        });

        // Delete
        $('#example1').on('click', '.btn-delete', function () {
            $('#deleteJobId').val($(this).data('id'));
            $('#modalDeleteEmployeeJob').modal('show');
        });

        $('#btnConfirmDelete').on('click', function () {
            var id = $('#deleteJobId').val();
            var $btn = $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');
            $.ajax({
                url: '/api/job/' + id,
                type: 'DELETE',
                success: function () {
                    $('#modalDeleteEmployeeJob').modal('hide');
                    table.ajax.reload(null, false);
                },
                error: function () {
                    alert('Failed to delete. Please try again.');
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Delete');
                }
            });
        });

        // Reset modal on close
        $('#modalCreateEmployeeJob, #modalEditEmployeeJob').on('hidden.bs.modal', function () {
            var $form = $(this).find('form');
            $form[0].reset();
            $form.find('.form-group').removeClass('has-error');
            $form.find('.help-block.error-msg').remove();
        });

    });
</script>
@endPushOnce