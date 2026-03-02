@extends('layouts.dashboard')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-subtitle', 'Company Information')

@section('breadcrumb')
    <li class="active">Settings</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-building"></i> Company Information</h3>
                </div>

                <form id="form-setting" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="box-body">

                        <div class="alert alert-success alert-dismissible" id="alert-success" style="display:none">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fa fa-check"></i> <span id="alert-message"></span>
                        </div>

                        <div class="alert alert-danger alert-dismissible" id="alert-error" style="display:none">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fa fa-times"></i> <span id="alert-error-message"></span>
                        </div>

                        {{-- Logo --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">Logo</label>
                            <div class="col-sm-10">
                                <div class="mb-2">
                                    <img id="preview-logo"
                                         src="https://via.placeholder.com/120x60?text=LOGO"
                                         alt="Logo" class="img-thumbnail">
                                </div>
                                <input type="file" name="company_logo" id="company_logo" accept="image/*">
                                <p class="help-block">Format: jpg, jpeg, png, svg. Maks 2MB.</p>
                                <span class="help-block text-red error-msg" id="error-company_logo"></span>
                            </div>
                        </div>

                        {{-- Nama Perusahaan --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">Nama Perusahaan <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="company_name" id="company_name" class="form-control"
                                       placeholder="Nama Perusahaan">
                                <span class="help-block text-red error-msg" id="error-company_name"></span>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="company_address" id="company_address" class="form-control" rows="3"
                                          placeholder="Alamat Perusahaan"></textarea>
                                <span class="help-block text-red error-msg" id="error-company_address"></span>
                            </div>
                        </div>

                        {{-- Provinsi --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">Provinsi</label>
                            <div class="col-sm-10">
                                <select name="company_province_id" class="form-control select2-province" style="width:100%"></select>
                                <span class="help-block text-red error-msg" id="error-company_province_id"></span>
                            </div>
                        </div>

                        {{-- Kota --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">Kota</label>
                            <div class="col-sm-10">
                                <select name="company_city_id" class="form-control select2-city" style="width:100%" disabled></select>
                                <span class="help-block text-red error-msg" id="error-company_city_id"></span>
                            </div>
                        </div>

                        {{-- Kecamatan --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">Kecamatan</label>
                            <div class="col-sm-10">
                                <select name="company_district_id" class="form-control select2-district" style="width:100%" disabled></select>
                                <span class="help-block text-red error-msg" id="error-company_district_id"></span>
                            </div>
                        </div>

                        {{-- Kelurahan --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">Kelurahan</label>
                            <div class="col-sm-10">
                                <select name="company_village_id" class="form-control select2-village" style="width:100%" disabled></select>
                                <span class="help-block text-red error-msg" id="error-company_village_id"></span>
                            </div>
                        </div>

                        {{-- Kode Pos --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">Kode Pos</label>
                            <div class="col-sm-4">
                                <input type="text" name="company_post_code" id="company_post_code" class="form-control"
                                       placeholder="Kode Pos">
                                <span class="help-block text-red error-msg" id="error-company_post_code"></span>
                            </div>
                        </div>

                        {{-- No Telepon --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">No. Telepon</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" name="company_phone" id="company_phone" class="form-control"
                                           placeholder="No. Telepon Perusahaan">
                                </div>
                                <span class="help-block text-red error-msg" id="error-company_phone"></span>
                            </div>
                        </div>

                        {{-- Website --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">Website</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                    <input type="text" name="company_website" id="company_website" class="form-control"
                                           placeholder="https://www.perusahaan.com">
                                </div>
                                <span class="help-block text-red error-msg" id="error-company_website"></span>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-left">Email</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" name="company_email" id="company_email" class="form-control"
                                           placeholder="email@perusahaan.com">
                                </div>
                                <span class="help-block text-red error-msg" id="error-company_email"></span>
                            </div>
                        </div>

                    </div>
                    {{-- /.box-body --}}

                    <div class="box-footer">
                        <button type="button" class="btn btn-default" onclick="history.back()">Cancel</button>
                        <button type="submit" class="btn btn-primary pull-right" id="btn-submit">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@pushOnce('scripts')
<script>
$(function () {

    var $form     = $('#form-setting');
    var $province = $form.find('.select2-province');
    var $city     = $form.find('.select2-city');
    var $district = $form.find('.select2-district');
    var $village  = $form.find('.select2-village');

    // Select2 factory
    function makeSelect2($el, url, placeholder, extraParams) {
        if ($el.hasClass('select2-hidden-accessible')) $el.select2('destroy');
        $el.select2({
            placeholder       : placeholder,
            allowClear        : true,
            minimumInputLength: 0,
            ajax: {
                url     : url,
                dataType: 'json',
                delay   : 300,
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
        if (!$el.find('option[value="' + id + '"]').length) {
            $el.append(new Option(text, id, true, true));
        }
        $el.val(id).trigger('change');
    }

    function resetSelect2($el) {
        if ($el.hasClass('select2-hidden-accessible')) $el.select2('destroy');
        $el.empty().prop('disabled', true);
    }

    // Init select2
    function initSelect2() {
        makeSelect2($province, '/api/province', '-- Pilih Provinsi --');

        $province.off('change.cascade').on('change.cascade', function () {
            resetSelect2($city); resetSelect2($district); resetSelect2($village);
            if ($(this).val()) {
                $city.prop('disabled', false);
                makeSelect2($city, '/api/city', '-- Pilih Kota --', function () {
                    return { province_id: $province.val() };
                });
            }
        });

        $city.off('change.cascade').on('change.cascade', function () {
            resetSelect2($district); resetSelect2($village);
            if ($(this).val()) {
                $district.prop('disabled', false);
                makeSelect2($district, '/api/district', '-- Pilih Kecamatan --', function () {
                    return { city_id: $city.val() };
                });
            }
        });

        $district.off('change.cascade').on('change.cascade', function () {
            resetSelect2($village);
            if ($(this).val()) {
                $village.prop('disabled', false);
                makeSelect2($village, '/api/village', '-- Pilih Kelurahan --', function () {
                    return { district_id: $district.val() };
                });
            }
        });
    }

    // Populate select2 with existing values
    function populateSelects(d) {
        setSelect2Val($province, d.company_province_id, d.province?.name ?? '');

        if (d.company_city_id) {
            $city.prop('disabled', false);
            makeSelect2($city, '/api/city', '-- Pilih Kota --', function () {
                return { province_id: $province.val() };
            });
            setSelect2Val($city, d.company_city_id, d.city?.name ?? '');
        }

        if (d.company_district_id) {
            $district.prop('disabled', false);
            makeSelect2($district, '/api/district', '-- Pilih Kecamatan --', function () {
                return { city_id: $city.val() };
            });
            setSelect2Val($district, d.company_district_id, d.district?.name ?? '');
        }

        if (d.company_village_id) {
            $village.prop('disabled', false);
            makeSelect2($village, '/api/village', '-- Pilih Kelurahan --', function () {
                return { district_id: $district.val() };
            });
            setSelect2Val($village, d.company_village_id, d.village?.name ?? '');
        }
    }

    // Load setting
    function loadSetting() {
        $.ajax({
            url    : '/api/setting',
            method : 'GET',
            success: function (res) {
                var d = res.data;

                $('#company_name').val(d.company_name);
                $('#company_address').val(d.company_address);
                $('#company_post_code').val(d.company_post_code);
                $('#company_phone').val(d.company_phone);
                $('#company_website').val(d.company_website);
                $('#company_email').val(d.company_email);

                if (d.company_logo) {
                    $('#preview-logo').attr('src', '/storage/' + d.company_logo);
                }

                populateSelects(d);
            }
        });
    }

    // Preview Logo
    $('#company_logo').on('change', function () {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-logo').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // Clear errors
    function clearErrors() {
        $form.find('.form-group').removeClass('has-error');
        $form.find('.error-msg').text('');
    }

    // Submit
    $form.on('submit', function (e) {
        e.preventDefault();
        clearErrors();

        var formData = new FormData(this);
        formData.append('_method', 'PUT');

        var $btn = $('#btn-submit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url        : '/api/setting',
            method     : 'POST',
            data       : formData,
            processData: false,
            contentType: false,
            success: function (res) {
                $('#alert-error').hide();
                $('#alert-success').show();
                $('#alert-message').text(res.message);
                $('html, body').animate({ scrollTop: 0 }, 300);
            },
            error: function (xhr) {
                $('#alert-success').hide();
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON?.errors;
                    $.each(errors, function (field, messages) {
                        $('#error-' + field).text(messages[0]);
                        $('[name="' + field + '"]').closest('.form-group').addClass('has-error');
                    });
                } else {
                    $('#alert-error').show();
                    $('#alert-error-message').text('Terjadi kesalahan. Silakan coba lagi.');
                }
            },
            complete: function () {
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            }
        });
    });

    // Init
    initSelect2();
    loadSetting();

});
</script>
@endPushOnce