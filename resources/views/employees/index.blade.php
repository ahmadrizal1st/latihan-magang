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
                                <th>Photo</th>
                                <th>NIP</th>
                                <th>Name</th>
                                <th>Province</th>
                                <th>City</th>
                                <th>District</th>
                                <th>Village</th>
                                <th>Postal Code</th>
                                <th>Job</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>NIP</th>
                                <th>Name</th>
                                <th>Province</th>
                                <th>City</th>
                                <th>District</th>
                                <th>Village</th>
                                <th>Postal Code</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Create Employee</h4>
            </div>
            <form id="formCreateEmployee" role="form" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter employee name...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth <span class="text-red">*</span></label>
                                <input type="date" class="form-control" name="date_of_birth">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Province <span class="text-red">*</span></label>
                                <select class="form-control select2-province" name="province_id" style="width: 100%;">
                                    <option value="">-- Select Province --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City <span class="text-red">*</span></label>
                                <select class="form-control select2-city" name="city_id" style="width: 100%;">
                                    <option value="">-- Select City --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>District <span class="text-red">*</span></label>
                                <select class="form-control select2-district" name="district_id" style="width: 100%;">
                                    <option value="">-- Select District --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Village <span class="text-red">*</span></label>
                                <select class="form-control select2-village" name="village_id" style="width: 100%;">
                                    <option value="">-- Select Village --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Postal Code <span class="text-red">*</span></label>
                                <select class="form-control select2-postal-code" name="postal_code_id" style="width: 100%;">
                                    <option value="">-- Select Postal Code --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job <span class="text-red">*</span></label>
                                <select class="form-control select2-job" name="employee_job_id" style="width: 100%;">
                                    <option value="">-- Select Job --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo" accept="image/*">
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

{{-- Modal Edit Employee --}}
<div class="modal fade" id="modalEditEmployee" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-pencil"></i> Edit Employee</h4>
            </div>
            <form id="formEditEmployee" role="form" enctype="multipart/form-data">
                <input type="hidden" id="editEmployeeId" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="editEmployeeName" name="name" placeholder="Enter employee name...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth <span class="text-red">*</span></label>
                                <input type="date" class="form-control" id="editEmployeeDob" name="date_of_birth">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Province <span class="text-red">*</span></label>
                                <select class="form-control select2-province" name="province_id" style="width: 100%;">
                                    <option value="">-- Select Province --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City <span class="text-red">*</span></label>
                                <select class="form-control select2-city" name="city_id" style="width: 100%;">
                                    <option value="">-- Select City --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>District <span class="text-red">*</span></label>
                                <select class="form-control select2-district" name="district_id" style="width: 100%;">
                                    <option value="">-- Select District --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Village <span class="text-red">*</span></label>
                                <select class="form-control select2-village" name="village_id" style="width: 100%;">
                                    <option value="">-- Select Village --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Postal Code <span class="text-red">*</span></label>
                                <select class="form-control select2-postal-code" name="postal_code_id" style="width: 100%;">
                                    <option value="">-- Select Postal Code --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job <span class="text-red">*</span></label>
                                <select class="form-control select2-job" name="employee_job_id" style="width: 100%;">
                                    <option value="">-- Select Job --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Photo</label>
                                <div id="editPhotoPreview" class="mb-1"></div>
                                <input type="file" name="photo" accept="image/*">
                                <p class="help-block">Kosongkan jika tidak ingin mengganti foto.</p>
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

    // HELPER: Init Select2 AJAX

    function initSelect2(selector, url, placeholder, selectedId, selectedText) {
        var $el = $(selector);
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
                    return { search: params.term ?? '' };
                },
                processResults: function (response) {
                    var items = response.results ?? response.data ?? response;
                    return {
                        results: $.map(items, function (item) {
                            return { id: item.id, text: item.text ?? item.name ?? item.code };
                        })
                    };
                },
                cache: true
            }
        });
        if (selectedId && selectedText) {
            $el.append(new Option(selectedText, selectedId, true, true)).trigger('change');
        }
    }

    function initAllSelect2(formSelector, data) {
        data = data || {};
        initSelect2(formSelector + ' .select2-province',   '/api/province',    '-- Select Province --',    data.province_id,    data.province_name);
        initSelect2(formSelector + ' .select2-city',       '/api/city',        '-- Select City --',        data.city_id,        data.city_name);
        initSelect2(formSelector + ' .select2-district',   '/api/district',    '-- Select District --',    data.district_id,    data.district_name);
        initSelect2(formSelector + ' .select2-village',    '/api/village',     '-- Select Village --',     data.village_id,     data.village_name);
        initSelect2(formSelector + ' .select2-postal-code','/api/postal-code', '-- Select Postal Code --', data.postal_code_id, data.postal_code_text);
        initSelect2(formSelector + ' .select2-job',        '/api/employee-job','-- Select Job --',         data.employee_job_id,data.employee_job_name);
    }

    // DATATABLES

    var table = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: {
            url: '/api/employee',
            type: 'GET',
            data: function (d) {
                d.datatable = true;
                return d;
            }
        },
        columns: [
            { data: 'DT_RowIndex',   name: 'DT_RowIndex',        orderable: false, searchable: false },
            {
                data: 'photo_url',
                name: 'photo',
                orderable: false,
                searchable: false,
                render: function (url) {
                    return `<img src="${url}" alt="photo" style="width:40px;height:40px;object-fit:cover;border-radius:50%;">`;
                }
            },
            { data: 'nip',           name: 'nip' },
            { data: 'name',          name: 'name' },
            { data: 'province',      name: 'province.name' },
            { data: 'city',          name: 'city.name' },
            { data: 'district',      name: 'district.name' },
            { data: 'village',       name: 'village.name' },
            { data: 'postal_code',   name: 'postalCode.code' },
            { data: 'employee_job',  name: 'employeeJob.name' },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-warning btn-xs btn-edit"
                            data-id="${row.id}"
                            data-name="${row.name}"
                            data-dob="${row.date_of_birth ?? ''}"
                            data-province-id="${row.province_id ?? ''}"
                            data-province-name="${row.province_name ?? ''}"
                            data-city-id="${row.city_id ?? ''}"
                            data-city-name="${row.city_name ?? ''}"
                            data-district-id="${row.district_id ?? ''}"
                            data-district-name="${row.district_name ?? ''}"
                            data-village-id="${row.village_id ?? ''}"
                            data-village-name="${row.village_name ?? ''}"
                            data-postal-code-id="${row.postal_code_id ?? ''}"
                            data-postal-code-text="${row.postal_code ?? ''}"
                            data-job-id="${row.employee_job_id ?? ''}"
                            data-job-name="${row.employee_job_name ?? ''}"
                            data-photo-url="${row.photo_url ?? ''}">
                            <i class="fa fa-pencil"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-xs btn-delete"
                            data-id="${row.id}"
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
        initAllSelect2('#formCreateEmployee');
    });

    $('#formCreateEmployee').on('submit', function (e) {
        e.preventDefault();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '/api/employee',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
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
        var $btn = $(this);

        $('#editEmployeeId').val($btn.data('id'));
        $('#editEmployeeName').val($btn.data('name'));
        $('#editEmployeeDob').val($btn.data('dob'));

        var photoUrl = $btn.data('photo-url');
        $('#editPhotoPreview').html(
            photoUrl
                ? `<img src="${photoUrl}" style="width:60px;height:60px;object-fit:cover;border-radius:4px;">`
                : ''
        );

        initAllSelect2('#formEditEmployee', {
            province_id:    $btn.data('province-id'),
            province_name:  $btn.data('province-name'),
            city_id:        $btn.data('city-id'),
            city_name:      $btn.data('city-name'),
            district_id:    $btn.data('district-id'),
            district_name:  $btn.data('district-name'),
            village_id:     $btn.data('village-id'),
            village_name:   $btn.data('village-name'),
            postal_code_id: $btn.data('postal-code-id'),
            postal_code_text: $btn.data('postal-code-text'),
            employee_job_id:   $btn.data('job-id'),
            employee_job_name: $btn.data('job-name'),
        });

        $('#modalEditEmployee').modal('show');
    });

    $('#formEditEmployee').on('submit', function (e) {
        e.preventDefault();
        var id   = $('#editEmployeeId').val();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        var formData = new FormData(this);
        formData.append('_method', 'PUT');

        $.ajax({
            url: '/api/employee/' + id,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
        $form.find('.select2-province, .select2-city, .select2-district, .select2-village, .select2-postal-code, .select2-job').each(function () {
            if ($(this).hasClass('select2-hidden-accessible')) {
                $(this).val(null).trigger('change');
            }
        });
        $form.find('.form-group').removeClass('has-error');
        $form.find('.help-block.error-msg').remove();
        $('#editPhotoPreview').html('');
    });

    // HELPER: Validation Errors

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