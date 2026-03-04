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
                        <button type="button" class="btn btn-success btn-sm" id="btnBulkIdCard" style="display: none;">
                            <i class="fa fa-file-pdf-o"></i> Download ID Card (<span id="bulkCount">0</span>)
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#modalCreateEmployee">
                            <i class="fa fa-plus"></i> Add Employee
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll" class="flat-red" title="Select All"></th>
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
                                <th></th>
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

{{-- Modal Create --}}
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
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter employee name...">
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
                                <label>Place of Birth <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="place_of_birth"
                                    placeholder="Enter place of birth...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job <span class="text-red">*</span></label>
                                <select class="form-control select2-job" name="employee_job_id"
                                    style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address <span class="text-red">*</span></label>
                                <textarea class="form-control" name="address" rows="2"
                                    placeholder="Enter address..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Province <span class="text-red">*</span></label>
                                <select class="form-control select2-province" name="province_id"
                                    style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City <span class="text-red">*</span></label>
                                <select class="form-control select2-city" name="city_id" style="width: 100%;"
                                    disabled></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>District <span class="text-red">*</span></label>
                                <select class="form-control select2-district" name="district_id" style="width: 100%;"
                                    disabled></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Village <span class="text-red">*</span></label>
                                <select class="form-control select2-village" name="village_id" style="width: 100%;"
                                    disabled></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Postal Code <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="post_code"
                                    placeholder="Enter postal code...">
                            </div>
                        </div>
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

{{-- Modal Edit --}}
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
                                <input type="text" class="form-control" id="editEmployeeName" name="name"
                                    placeholder="Enter employee name...">
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
                                <label>Place of Birth <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="editEmployeePlaceOfBirth"
                                    name="place_of_birth" placeholder="Enter place of birth...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job <span class="text-red">*</span></label>
                                <select class="form-control select2-job" name="employee_job_id"
                                    style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address <span class="text-red">*</span></label>
                                <textarea class="form-control" id="editEmployeeAddress" name="address" rows="2"
                                    placeholder="Enter address..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Province <span class="text-red">*</span></label>
                                <select class="form-control select2-province" name="province_id"
                                    style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City <span class="text-red">*</span></label>
                                <select class="form-control select2-city" name="city_id" style="width: 100%;"
                                    disabled></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>District <span class="text-red">*</span></label>
                                <select class="form-control select2-district" name="district_id" style="width: 100%;"
                                    disabled></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Village <span class="text-red">*</span></label>
                                <select class="form-control select2-village" name="village_id" style="width: 100%;"
                                    disabled></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Postal Code <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="editEmployeePostCode" name="post_code"
                                    placeholder="Enter postal code...">
                            </div>
                        </div>
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

{{-- Modal Delete --}}
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

        // Select2
        function makeSelect2($el, url, placeholder, extraParams) {
            if ($el.hasClass('select2-hidden-accessible')) $el.select2('destroy');
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
                        if (typeof extraParams === 'function') $.extend(q, extraParams());
                        return q;
                    },
                    processResults: function (response) {
                        var items = response.results ?? response.data ?? response;
                        return {
                            results: $.map(items, function (item) {
                                return { id: item.id, text: item.text ?? item.name ?? item.code };
                            })
                        };
                    },
                    cache: false
                }
            });
        }

        function setSelect2Val($el, id, text) {
            if (!id) return;
            if (!$el.find('option[value="' + id + '"]').length) $el.append(new Option(text, id, true, true));
            $el.val(id).trigger('change');
        }

        function resetSelect2($el) {
            if ($el.hasClass('select2-hidden-accessible')) $el.select2('destroy');
            $el.empty().prop('disabled', true);
        }

        // Cascading location
        function setupCascading(formSel) {
            var $form = $(formSel);
            var $province = $form.find('.select2-province');
            var $city = $form.find('.select2-city');
            var $district = $form.find('.select2-district');
            var $village = $form.find('.select2-village');

            makeSelect2($province, '/api/province', '-- Select Province --');
            makeSelect2($form.find('.select2-job'), '/api/job', '-- Select Job --');

            $province.off('change.cascade').on('change.cascade', function () {
                resetSelect2($city); resetSelect2($district); resetSelect2($village);
                if ($(this).val()) {
                    $city.prop('disabled', false);
                    makeSelect2($city, '/api/city', '-- Select City --', function () {
                        return { province_id: $province.val() };
                    });
                }
            });

            $city.off('change.cascade').on('change.cascade', function () {
                resetSelect2($district); resetSelect2($village);
                if ($(this).val()) {
                    $district.prop('disabled', false);
                    makeSelect2($district, '/api/district', '-- Select District --', function () {
                        return { city_id: $city.val() };
                    });
                }
            });

            $district.off('change.cascade').on('change.cascade', function () {
                resetSelect2($village);
                if ($(this).val()) {
                    $village.prop('disabled', false);
                    makeSelect2($village, '/api/village', '-- Select Village --', function () {
                        return { district_id: $district.val() };
                    });
                }
            });
        }

        function populateEditSelects($form, d) {
            var $province = $form.find('.select2-province');
            var $city = $form.find('.select2-city');
            var $district = $form.find('.select2-district');
            var $village = $form.find('.select2-village');

            setSelect2Val($province, d.provinceId, d.provinceName);

            if (d.cityId) {
                $city.prop('disabled', false);
                makeSelect2($city, '/api/city', '-- Select City --', function () { return { province_id: $province.val() }; });
                setSelect2Val($city, d.cityId, d.cityName);
            }
            if (d.districtId) {
                $district.prop('disabled', false);
                makeSelect2($district, '/api/district', '-- Select District --', function () { return { city_id: $city.val() }; });
                setSelect2Val($district, d.districtId, d.districtName);
            }
            if (d.villageId) {
                $village.prop('disabled', false);
                makeSelect2($village, '/api/village', '-- Select Village --', function () { return { district_id: $district.val() }; });
                setSelect2Val($village, d.villageId, d.villageName);
            }

            setSelect2Val($form.find('.select2-job'), d.jobId, d.jobName);
        }

        // Validation
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
            responsive: true,
            autoWidth: false,
            ajax: {
                url: '/api/employee',
                type: 'GET',
                data: function (d) { d.datatable = true; return d; }
            },
            columns: [
                {
                    data: null, orderable: false, searchable: false, className: 'text-center',
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="row-checkbox flat-red" value="' + row.id + '">';
                    }
                },
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {
                    data: 'photo_url', name: 'photo', orderable: false, searchable: false,
                    render: function (url) {
                        return url
                            ? '<img src="' + url + '" style="width:40px;height:40px;object-fit:cover;border-radius:50%;">'
                            : '<i class="fa fa-user-circle fa-2x text-muted"></i>';
                    }
                },
                { data: 'nip', name: 'nip' },
                { data: 'name', name: 'name' },
                { data: 'province_name', name: 'province_name', orderable: false, searchable: false, defaultContent: '-' },
                { data: 'city_name', name: 'city_name', orderable: false, searchable: false, defaultContent: '-' },
                { data: 'district_name', name: 'district_name', orderable: false, searchable: false, defaultContent: '-' },
                { data: 'village_name', name: 'village_name', orderable: false, searchable: false, defaultContent: '-' },
                { data: 'post_code', name: 'post_code', orderable: false, searchable: false, defaultContent: '-' },
                { data: 'employee_job_name', name: 'employee_job_name', orderable: false, searchable: false, defaultContent: '-' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        var e = row;
                        return '<a href="/api/employee/' + e.id + '/id-card" target="_blank" class="btn btn-info btn-xs">'
                            + '<i class="fa fa-id-card-o"></i> ID Card</a> '
                            + '<button class="btn btn-warning btn-xs btn-edit"'
                            + ' data-id="' + e.id + '"'
                            + ' data-name="' + (e.name ?? '') + '"'
                            + ' data-dob="' + (e.date_of_birth ?? '') + '"'
                            + ' data-place-of-birth="' + (e.place_of_birth ?? '') + '"'
                            + ' data-address="' + (e.address ?? '') + '"'
                            + ' data-province-id="' + (e.province_id ?? '') + '"'
                            + ' data-province-name="' + (e.province_name ?? '') + '"'
                            + ' data-city-id="' + (e.city_id ?? '') + '"'
                            + ' data-city-name="' + (e.city_name ?? '') + '"'
                            + ' data-district-id="' + (e.district_id ?? '') + '"'
                            + ' data-district-name="' + (e.district_name ?? '') + '"'
                            + ' data-village-id="' + (e.village_id ?? '') + '"'
                            + ' data-village-name="' + (e.village_name ?? '') + '"'
                            + ' data-post-code="' + (e.post_code ?? '') + '"'
                            + ' data-job-id="' + (e.job_id ?? '') + '"'
                            + ' data-job-name="' + (e.employee_job_name ?? '') + '"'
                            + ' data-photo-url="' + (e.photo_url ?? '') + '">'
                            + '<i class="fa fa-pencil"></i> Edit</button> '
                            + '<button class="btn btn-danger btn-xs btn-delete"'
                            + ' data-id="' + e.id + '" data-name="' + e.name + '">'
                            + '<i class="fa fa-trash"></i> Delete</button>';
                    }
                }
            ]
        });

        // iCheck
        function initICheck($el) {
            $el.iCheck({ checkboxClass: 'icheckbox_flat-green', radioClass: 'iradio_flat-green' });
        }

        initICheck($('#checkAll'));

        var isUpdatingCheckAll = false;

        table.on('draw', function () {
            $('#example1 tbody .flat-red').each(function () {
                if ($(this).closest('.icheckbox_flat-green').length) $(this).iCheck('destroy');
            });
            initICheck($('#example1 tbody .flat-red'));

            isUpdatingCheckAll = true;
            $('#checkAll').iCheck('uncheck').prop('indeterminate', false);
            isUpdatingCheckAll = false;

            updateBulkButton();
        });

        $('#checkAll').on('ifChecked ifUnchecked', function (e) {
            if (isUpdatingCheckAll) return;
            $('#example1 tbody .row-checkbox').iCheck(e.type === 'ifChecked' ? 'check' : 'uncheck');
            updateBulkButton();
        });

        $('#example1').on('ifChecked ifUnchecked', '.row-checkbox', function () {
            var total = $('#example1 tbody .row-checkbox').length;
            var checked = $('#example1 tbody .row-checkbox:checked').length;

            isUpdatingCheckAll = true;
            if (checked === 0) {
                $('#checkAll').iCheck('uncheck').prop('indeterminate', false);
            } else if (checked === total) {
                $('#checkAll').prop('indeterminate', false).iCheck('check');
            } else {
                $('#checkAll').iCheck('uncheck').prop('indeterminate', true).iCheck('update');
            }
            isUpdatingCheckAll = false;

            updateBulkButton();
        });

        function updateBulkButton() {
            var count = $('#example1 tbody .row-checkbox:checked').length;
            $('#bulkCount').text(count);
            $('#btnBulkIdCard').toggle(count > 0);
        }

        // Bulk download
        $('#btnBulkIdCard').on('click', function () {
            var ids = $('#example1 tbody .row-checkbox:checked').map(function () { return $(this).val(); }).get();
            if (!ids.length) return;

            var $btn = $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Generating...');

            $.ajax({
                url: '/api/employee/id-card/bulk',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ ids: ids }),
                xhrFields: { responseType: 'blob' },
                success: function (blob) {
                    var url = URL.createObjectURL(blob);
                    var a = Object.assign(document.createElement('a'), { href: url, download: 'id-card-bulk-' + Date.now() + '.pdf' });
                    document.body.appendChild(a);
                    a.click();
                    URL.revokeObjectURL(url);
                    a.remove();
                },
                error: function () { alert('Gagal generate ID Card. Silakan coba lagi.'); },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fa fa-file-pdf-o"></i> Download ID Card (<span id="bulkCount">0</span>)');
                    updateBulkButton();
                }
            });
        });

        // Create
        $('#modalCreateEmployee').on('show.bs.modal', function () {
            setupCascading('#formCreateEmployee');
        });

        $('#formCreateEmployee').on('submit', function (e) {
            e.preventDefault();
            var $btn = $(this).find('[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

            $.ajax({
                url: '/api/employee',
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function () { $('#modalCreateEmployee').modal('hide'); table.ajax.reload(); },
                error: function (xhr) { handleValidationErrors(xhr, '#formCreateEmployee'); },
                complete: function () { $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save'); }
            });
        });

        // Edit
        $('#example1').on('click', '.btn-edit', function () {
            var $btn = $(this);

            $('#editEmployeeId').val($btn.data('id'));
            $('#editEmployeeName').val($btn.data('name'));
            $('#editEmployeeDob').val($btn.data('dob'));
            $('#editEmployeePlaceOfBirth').val($btn.data('place-of-birth'));
            $('#editEmployeeAddress').val($btn.data('address'));
            $('#editEmployeePostCode').val($btn.data('post-code'));

            var photoUrl = $btn.data('photo-url');
            $('#editPhotoPreview').html(photoUrl
                ? '<img src="' + photoUrl + '" style="width:60px;height:60px;object-fit:cover;border-radius:4px;">'
                : ''
            );

            setupCascading('#formEditEmployee');
            populateEditSelects($('#formEditEmployee'), {
                provinceId: $btn.data('province-id'), provinceName: $btn.data('province-name'),
                cityId: $btn.data('city-id'), cityName: $btn.data('city-name'),
                districtId: $btn.data('district-id'), districtName: $btn.data('district-name'),
                villageId: $btn.data('village-id'), villageName: $btn.data('village-name'),
                jobId: $btn.data('job-id'), jobName: $btn.data('job-name'),
            });

            $('#modalEditEmployee').modal('show');
        });

        $('#formEditEmployee').on('submit', function (e) {
            e.preventDefault();
            var id = $('#editEmployeeId').val();
            var $btn = $(this).find('[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

            var formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: '/api/employee/' + id,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () { $('#modalEditEmployee').modal('hide'); table.ajax.reload(null, false); },
                error: function (xhr) { handleValidationErrors(xhr, '#formEditEmployee'); },
                complete: function () { $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update'); }
            });
        });

        // Delete
        $('#example1').on('click', '.btn-delete', function () {
            $('#deleteEmployeeId').val($(this).data('id'));
            $('#deleteEmployeeName').text($(this).data('name'));
            $('#modalDeleteEmployee').modal('show');
        });

        $('#btnConfirmDelete').on('click', function () {
            var id = $('#deleteEmployeeId').val();
            var $btn = $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

            $.ajax({
                url: '/api/employee/' + id,
                type: 'DELETE',
                success: function () { $('#modalDeleteEmployee').modal('hide'); table.ajax.reload(null, false); },
                error: function () { alert('Failed to delete. Please try again.'); },
                complete: function () { $btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Delete'); }
            });
        });

        // Reset modal
        $('#modalCreateEmployee, #modalEditEmployee').on('hidden.bs.modal', function () {
            var $form = $(this).find('form');
            $form[0].reset();

            $form.find('.select2-province, .select2-city, .select2-district, .select2-village, .select2-job').each(function () {
                if ($(this).hasClass('select2-hidden-accessible')) $(this).select2('destroy');
                $(this).empty();
            });
            $form.find('.select2-city, .select2-district, .select2-village').prop('disabled', true);
            $form.find('.form-group').removeClass('has-error');
            $form.find('.help-block.error-msg').remove();
            $('#editPhotoPreview').html('');
        });

    });
</script>
@endPushOnce