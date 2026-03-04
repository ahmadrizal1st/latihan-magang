@extends('layouts.dashboard')

@section('title', 'Leave Request')
@section('page-title', 'Leave Request')
@section('page-subtitle', 'Table')

@section('breadcrumb')
<li class="active">Leave Request</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Leave Request Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#modalCreateLeaveRequest">
                            <i class="fa fa-plus"></i> Add Leave Request
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Employee Name</th>
                                <th>Type</th>
                                <th>Reason</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Return Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Employee Name</th>
                                <th>Type</th>
                                <th>Reason</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Return Date</th>
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
<div class="modal fade" id="modalCreateLeaveRequest" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Create Leave Request</h4>
            </div>
            <form id="formCreateLeaveRequest" role="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Employee <span class="text-red">*</span></label>
                                <select class="form-control select2-employee" name="employee_id"
                                    style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="type"
                                    placeholder="Enter leave type (e.g., Sick, Vacation)...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Reason <span class="text-red">*</span></label>
                                <textarea class="form-control" name="reason" rows="2"
                                    placeholder="Enter reason..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Date <span class="text-red">*</span></label>
                                <input type="date" class="form-control" name="start_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>End Date <span class="text-red">*</span></label>
                                <input type="date" class="form-control" name="end_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Return Date <span class="text-red">*</span></label>
                                <input type="date" class="form-control" name="return_date">
                            </div>
                        </div>
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
<div class="modal fade" id="modalEditLeaveRequest" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-pencil"></i> Edit Leave Request</h4>
            </div>
            <form id="formEditLeaveRequest" role="form">
                <input type="hidden" id="editLeaveRequestId" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Employee <span class="text-red">*</span></label>
                                <select class="form-control select2-employee" name="employee_id"
                                    style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="editLeaveType" name="type"
                                    placeholder="Enter leave type (e.g., Sick, Vacation)...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Reason <span class="text-red">*</span></label>
                                <textarea class="form-control" id="editLeaveReason" name="reason" rows="2"
                                    placeholder="Enter reason..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Date <span class="text-red">*</span></label>
                                <input type="date" class="form-control" id="editLeaveStartDate" name="start_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>End Date <span class="text-red">*</span></label>
                                <input type="date" class="form-control" id="editLeaveEndDate" name="end_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Return Date <span class="text-red">*</span></label>
                                <input type="date" class="form-control" id="editLeaveReturnDate" name="return_date">
                            </div>
                        </div>
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
<div class="modal fade" id="modalDeleteLeaveRequest" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal">
                    <span style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this leave request?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="deleteLeaveRequestId">
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

        // Helper: Select2
        function makeSelect2($el, url, placeholder, extraParams) {
            if ($el.hasClass('select2-hidden-accessible')) {
                $el.select2('destroy');
            }
            $el.select2({
                dropdownParent: $el.closest('.modal'),
                placeholder: placeholder,
                allowClear: true,
                minimumInputLength: 0,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 300,
                    data: function (params) {
                        var q = { search: params.term ?? '' };
                        if (typeof extraParams === 'function') {
                            $.extend(q, extraParams());
                        }
                        return q;
                    },
                    processResults: function (response) {
                        var items = response.data ?? response;
                        return {
                            results: $.map(items, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name ? (item.nip ? item.nip + ' - ' + item.name : item.name) : item.text
                                };
                            })
                        };
                    },
                    cache: false
                }
            });
        }

        function setSelect2Val($el, id, text) {
            if (!id) return;
            if (!$el.find('option[value="' + id + '"]').length) {
                $el.append(new Option(text, id, true, true));
            }
            $el.val(id).trigger('change');
        }

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
                url: '/api/leave-request',
                type: 'GET',
                data: function (d) {
                    d.datatable = true;
                    return d;
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'employee_nip', name: 'employee_nip', orderable: false, searchable: false, defaultContent: '-' },
                { data: 'employee_name', name: 'employee_name', orderable: false, searchable: false, defaultContent: '-' },
                { data: 'type', name: 'type' },
                { data: 'reason', name: 'reason' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'return_date', name: 'return_date' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        var e = row;
                        return '<button class="btn btn-warning btn-xs btn-edit"'
                            + ' data-id="' + (e.id ?? '') + '"'
                            + ' data-employee-id="' + (e.employee_id ?? '') + '"'
                            + ' data-employee-name="' + (e.employee_name ?? '') + '"'
                            + ' data-type="' + (e.type ?? '') + '"'
                            + ' data-reason="' + (e.reason ?? '') + '"'
                            + ' data-start-date="' + (e.start_date ?? '') + '"'
                            + ' data-end-date="' + (e.end_date ?? '') + '"'
                            + ' data-return-date="' + (e.return_date ?? '') + '">'
                            + '<i class="fa fa-pencil"></i> Edit</button> '
                            + '<button class="btn btn-danger btn-xs btn-delete"'
                            + ' data-id="' + (e.id ?? '') + '">'
                            + '<i class="fa fa-trash"></i> Delete</button>';
                    }
                }
            ]
        });

        // Create
        $('#modalCreateLeaveRequest').on('show.bs.modal', function () {
            makeSelect2($('#formCreateLeaveRequest .select2-employee'), '/api/employee', '-- Select Employee --');
        });

        $('#formCreateLeaveRequest').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
            $.ajax({
                url: '/api/leave-request',
                type: 'POST',
                data: $form.serialize(),
                success: function () {
                    $('#modalCreateLeaveRequest').modal('hide');
                    table.ajax.reload();
                },
                error: function (xhr) {
                    handleValidationErrors(xhr, '#formCreateLeaveRequest');
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
                }
            });
        });

        // Edit
        $('#example1').on('click', '.btn-edit', function () {
            var $btn = $(this);
            $('#editLeaveRequestId').val($btn.data('id'));
            $('#editLeaveType').val($btn.data('type'));
            $('#editLeaveReason').val($btn.data('reason'));
            $('#editLeaveStartDate').val($btn.data('start-date'));
            $('#editLeaveEndDate').val($btn.data('end-date'));
            $('#editLeaveReturnDate').val($btn.data('return-date'));

            var $employeeSelect = $('#formEditLeaveRequest .select2-employee');
            makeSelect2($employeeSelect, '/api/employee', '-- Select Employee --');
            setSelect2Val($employeeSelect, $btn.data('employee-id'), $btn.data('employee-name'));

            $('#modalEditLeaveRequest').modal('show');
        });

        $('#formEditLeaveRequest').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            var id = $('#editLeaveRequestId').val();
            var $btn = $form.find('[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
            $.ajax({
                url: '/api/leave-request/' + id,
                type: 'PUT',
                data: $form.serialize(),
                success: function () {
                    $('#modalEditLeaveRequest').modal('hide');
                    table.ajax.reload(null, false);
                },
                error: function (xhr) {
                    handleValidationErrors(xhr, '#formEditLeaveRequest');
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                }
            });
        });

        // Delete
        $('#example1').on('click', '.btn-delete', function () {
            $('#deleteLeaveRequestId').val($(this).data('id'));
            $('#modalDeleteLeaveRequest').modal('show');
        });

        $('#btnConfirmDelete').on('click', function () {
            var id = $('#deleteLeaveRequestId').val();
            var $btn = $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');
            $.ajax({
                url: '/api/leave-request/' + id,
                type: 'DELETE',
                success: function () {
                    $('#modalDeleteLeaveRequest').modal('hide');
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
        $('#modalCreateLeaveRequest, #modalEditLeaveRequest').on('hidden.bs.modal', function () {
            var $form = $(this).find('form');
            $form[0].reset();
            $form.find('.select2-employee').each(function () {
                if ($(this).hasClass('select2-hidden-accessible')) $(this).select2('destroy');
                $(this).empty();
            });
            $form.find('.form-group').removeClass('has-error');
            $form.find('.help-block.error-msg').remove();
        });

    });
</script>
@endPushOnce