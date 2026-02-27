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
                        <tbody></tbody>
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
            </div>
        </div>
    </div>
</section>

{{-- Modal Create Employee --}}
<div class="modal fade" id="modalCreateEmployee" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Create Employee</h4>
            </div>
            <form id="formCreateEmployee" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter employee name...">
                    </div>
                    <div class="form-group">
                        <label>City <span class="text-red">*</span></label>
                        <select class="form-control select2-city" name="city_id" style="width: 100%;">
                            <option value="">-- Select City --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Job <span class="text-red">*</span></label>
                        <select class="form-control select2-job" name="employee_job_id" style="width: 100%;">
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

{{-- Modal Edit Employee --}}
<div class="modal fade" id="modalEditEmployee" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-pencil"></i> Edit Employee</h4>
            </div>
            <form id="formEditEmployee" role="form">
                <input type="hidden" id="editEmployeeId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editEmployeeName" name="name" placeholder="Enter employee name...">
                    </div>
                    <div class="form-group">
                        <label>City <span class="text-red">*</span></label>
                        <select class="form-control select2-city" name="city_id" style="width: 100%;">
                            <option value="">-- Select City --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Job <span class="text-red">*</span></label>
                        <select class="form-control select2-job" name="employee_job_id" style="width: 100%;">
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

{{-- Modal Confirm Delete --}}
<div class="modal fade" id="modalDeleteEmployee" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal">
                    <span style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Confirm Delete</h4>
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

@endsection

@pushOnce('scripts')
<script>
$(function () {

    // HELPER: Init Select2 AJAX - City
    function initSelect2City(selector, selectedId, selectedText) {
        var $el = $(selector);

        // Destroy jika sudah pernah diinisialisasi
        if ($el.hasClass('select2-hidden-accessible')) {
            $el.select2('destroy');
        }

        $el.select2({
            dropdownParent: $el.closest('.modal'),
            placeholder: '-- Select City --',
            allowClear: true,
            minimumInputLength: 0,
            ajax: {
                url: '/api/city',
                dataType: 'json',
                delay: 300,
                data: function (params) {
                    return { search: params.term ?? '' };
                },
                processResults: function (response) {
                    // Jika API return { results: [...] } langsung pakai
                    // Jika return { data: [...] } atau array, mapping manual
                    var items = response.results ?? response.data ?? response;
                    return {
                        results: $.map(items, function (city) {
                            return { id: city.id, text: city.text ?? city.name };
                        })
                    };
                },
                cache: true
            }
        });

        // Set nilai awal untuk mode Edit
        if (selectedId && selectedText) {
            var option = new Option(selectedText, selectedId, true, true);
            $el.append(option).trigger('change');
        }
    }

    // HELPER: Init Select2 AJAX - Job
    function initSelect2Job(selector, selectedId, selectedText) {
        var $el = $(selector);

        if ($el.hasClass('select2-hidden-accessible')) {
            $el.select2('destroy');
        }

        $el.select2({
            dropdownParent: $el.closest('.modal'),
            placeholder: '-- Select Job --',
            allowClear: true,
            minimumInputLength: 0,
            ajax: {
                url: '/api/employee-job',
                dataType: 'json',
                delay: 300,
                data: function (params) {
                    return { search: params.term ?? '' };
                },
                processResults: function (response) {
                    var items = response.results ?? response.data ?? response;
                    return {
                        results: $.map(items, function (job) {
                            return { id: job.id, text: job.text ?? job.name };
                        })
                    };
                },
                cache: true
            }
        });

        if (selectedId && selectedText) {
            var option = new Option(selectedText, selectedId, true, true);
            $el.append(option).trigger('change');
        }
    }

    // DATATABLES
    var table = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/employee',
            type: 'GET',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'city', name: 'city.name' },
            { data: 'employee_job', name: 'employeeJob.name' },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-warning btn-xs btn-edit"
                            data-id="${data}"
                            data-name="${row.name}"
                            data-city-id="${row.city_id ?? ''}"
                            data-city-name="${row.city_name ?? ''}"
                            data-job-id="${row.employee_job_id ?? ''}"
                            data-job-name="${row.employee_job_name ?? ''}">
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
    $('#modalCreateEmployee').on('show.bs.modal', function () {
        initSelect2City('#formCreateEmployee .select2-city', null, null);
        initSelect2Job('#formCreateEmployee .select2-job', null, null);
    });

    $('#formCreateEmployee').on('submit', function (e) {
        e.preventDefault();

        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '/api/employee',
            type: 'POST',
            data: $(this).serialize(),
            success: function () {
                $('#modalCreateEmployee').modal('hide');
                table.ajax.reload();
            },
            error: function (xhr) {
                handleValidationErrors(xhr, '#formCreateEmployee');
            },
            complete: function () {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save');
            }
        });
    });

    // EDIT
    $('#example1').on('click', '.btn-edit', function () {
        var id       = $(this).data('id');
        var name     = $(this).data('name');
        var cityId   = $(this).data('city-id');
        var cityName = $(this).data('city-name');
        var jobId    = $(this).data('job-id');
        var jobName  = $(this).data('job-name');

        $('#editEmployeeId').val(id);
        $('#editEmployeeName').val(name);

        // Init Select2 dengan pre-selected value
        initSelect2City('#formEditEmployee .select2-city', cityId, cityName);
        initSelect2Job('#formEditEmployee .select2-job', jobId, jobName);

        $('#modalEditEmployee').modal('show');
    });

    $('#formEditEmployee').on('submit', function (e) {
        e.preventDefault();

        var id   = $('#editEmployeeId').val();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url: '/api/employee/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function () {
                $('#modalEditEmployee').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function (xhr) {
                handleValidationErrors(xhr, '#formEditEmployee');
            },
            complete: function () {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            }
        });
    });

    // DELETE
    $('#example1').on('click', '.btn-delete', function () {
        $('#deleteEmployeeId').val($(this).data('id'));
        $('#deleteEmployeeName').text($(this).data('name'));
        $('#modalDeleteEmployee').modal('show');
    });

    $('#btnConfirmDelete').on('click', function () {
        var id   = $('#deleteEmployeeId').val();
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: '/api/employee/' + id,
            type: 'DELETE',
            success: function () {
                $('#modalDeleteEmployee').modal('hide');
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

    // RESET MODAL
    $('#modalCreateEmployee, #modalEditEmployee').on('hidden.bs.modal', function () {
        var $form = $(this).find('form');
        $form[0].reset();

        // Destroy & reset Select2
        $form.find('.select2-city, .select2-job').each(function () {
            if ($(this).hasClass('select2-hidden-accessible')) {
                $(this).val(null).trigger('change');
            }
        });

        $form.find('.form-group').removeClass('has-error');
        $form.find('.help-block.error-msg').remove();
    });

    // HELPER: Tampilkan Validation Errors
    function handleValidationErrors(xhr, formSelector) {
        $(formSelector + ' .form-group').removeClass('has-error');
        $(formSelector + ' .help-block.error-msg').remove();

        var errors = xhr.responseJSON?.errors;
        if (errors) {
            $.each(errors, function (field, messages) {
                var $input = $(formSelector + ' [name="' + field + '"]');
                $input.closest('.form-group').addClass('has-error');
                $input.after('<span class="help-block error-msg">' + messages[0] + '</span>');
            });
        }
    }

});
</script>
@endPushOnce