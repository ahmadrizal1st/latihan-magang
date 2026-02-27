@extends('layouts.dashboard')

@section('title', 'Employee')
@section('page-title', 'Employee')
@section('page-subtitle', 'Table')

@section('breadcrumb')
    <li class="active">Employee</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Employee Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateEmployee">
                            <i class="fa fa-plus"></i> Add Employee
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
                                <th>Job</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="employee-table-body">
                            {{-- Diisi oleh AJAX sebelum DataTable diinisialisasi --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Job</th>
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

{{-- Modal Create Employee --}}
<div class="modal fade" id="modalCreateEmployee" tabindex="-1" role="dialog" aria-labelledby="modalCreateEmployeeLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalCreateEmployeeLabel">
                    <i class="fa fa-plus-circle"></i> Create Employee
                </h4>
            </div>
            <form id="formCreateEmployee" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="employeeName">Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="employeeName" name="name" placeholder="Enter employee name...">
                    </div>
                    <div class="form-group">
                        <label for="employeeCityId">City <span class="text-red">*</span></label>
                        <select class="form-control" id="employeeCityId" name="city_id">
                            <option value="">-- Select City --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employeeJobId">Job <span class="text-red">*</span></label>
                        <select class="form-control" id="employeeJobId" name="employee_job_id">
                            <option value="">-- Select Job --</option>
                        </select>
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

{{-- Modal Edit Employee --}}
<div class="modal fade" id="modalEditEmployee" tabindex="-1" role="dialog" aria-labelledby="modalEditEmployeeLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditEmployeeLabel">
                    <i class="fa fa-pencil"></i> Edit Employee
                </h4>
            </div>
            <form id="formEditEmployee" role="form">
                <input type="hidden" id="editEmployeeId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editEmployeeName">Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editEmployeeName" name="name" placeholder="Enter employee name...">
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeCityId">City <span class="text-red">*</span></label>
                        <select class="form-control" id="editEmployeeCityId" name="city_id">
                            <option value="">-- Select City --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editEmployeeJobId">Job <span class="text-red">*</span></label>
                        <select class="form-control" id="editEmployeeJobId" name="employee_job_id">
                            <option value="">-- Select Job --</option>
                        </select>
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
<div class="modal fade" id="modalDeleteEmployee" tabindex="-1" role="dialog" aria-labelledby="modalDeleteEmployeeLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteEmployeeLabel">
                    <i class="fa fa-trash"></i> Confirm Delete
                </h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteEmployeeName"></strong>?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="deleteEmployeeId">
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
            url: '/api/employee',
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
                data: 'city',
                name: 'city.name'
            },
            {
                data: 'employee_job',
                name: 'employeeJob.name'
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
                            data-city-id="${row.city_id ?? ''}"
                            data-job-id="${row.employee_job_id ?? ''}">
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

    // LOAD DROPDOWN OPTIONS
    function loadCities(selectSelector, selectedId) {
        $.get('/api/city', { all: true }, function(response) {
            var options = '<option value="">-- Select City --</option>';
            $.each(response.data ?? response, function(i, city) {
                var selected = (city.id == selectedId) ? 'selected' : '';
                options += `<option value="${city.id}" ${selected}>${city.name}</option>`;
            });
            $(selectSelector).html(options);
        });
    }

    function loadJobs(selectSelector, selectedId) {
        $.get('/api/employee-job', { all: true }, function(response) {
            var options = '<option value="">-- Select Job --</option>';
            $.each(response.data ?? response, function(i, job) {
                var selected = (job.id == selectedId) ? 'selected' : '';
                options += `<option value="${job.id}" ${selected}>${job.name}</option>`;
            });
            $(selectSelector).html(options);
        });
    }

    // CREATE
    $('#modalCreateEmployee').on('show.bs.modal', function() {
        loadCities('#employeeCityId', null);
        loadJobs('#employeeJobId', null);
    });

    $('#formCreateEmployee').on('submit', function(e) {
        e.preventDefault();

        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '/api/employee',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#modalCreateEmployee').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formCreateEmployee');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
            }
        });
    });

    // OPEN EDIT MODAL
    $('#example1').on('click', '.btn-edit', function() {
        var id     = $(this).data('id');
        var name   = $(this).data('name');
        var cityId = $(this).data('city-id');
        var jobId  = $(this).data('job-id');

        $('#editEmployeeId').val(id);
        $('#editEmployeeName').val(name);

        loadCities('#editEmployeeCityId', cityId);
        loadJobs('#editEmployeeJobId', jobId);

        $('#modalEditEmployee').modal('show');
    });

    // EDIT SUBMIT
    $('#formEditEmployee').on('submit', function(e) {
        e.preventDefault();

        var id   = $('#editEmployeeId').val();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url: '/api/employee/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                $('#modalEditEmployee').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                handleValidationErrors(xhr, '#formEditEmployee');
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

        $('#deleteEmployeeId').val(id);
        $('#deleteEmployeeName').text(name);

        $('#modalDeleteEmployee').modal('show');
    });

    // CONFIRM DELETE
    $('#btnConfirmDelete').on('click', function() {
        var id   = $('#deleteEmployeeId').val();
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: '/api/employee/' + id,
            type: 'DELETE',
            success: function(response) {
                $('#modalDeleteEmployee').modal('hide');
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
    $('#modalCreateEmployee, #modalEditEmployee').on('hidden.bs.modal', function() {
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