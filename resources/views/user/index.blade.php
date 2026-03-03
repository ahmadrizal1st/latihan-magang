@extends('layouts.dashboard')

@section('title', 'User')
@section('page-title', 'User')
@section('page-subtitle', 'Table')

@section('breadcrumb')
    <li class="active">User</li>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">User Data Table</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateUser">
                            <i class="fa fa-plus"></i> Add User
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
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
<div class="modal fade" id="modalCreateUser" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Create User</h4>
            </div>
            <form id="formCreateUser" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name...">
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-red">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email...">
                    </div>
                    <div class="form-group">
                        <label>Password <span class="text-red">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password...">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password <span class="text-red">*</span></label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password...">
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
<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-pencil"></i> Edit User</h4>
            </div>
            <form id="formEditUser" role="form">
                <input type="hidden" id="editUserId">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editUserName" name="name" placeholder="Enter name...">
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-red">*</span></label>
                        <input type="email" class="form-control" id="editUserEmail" name="email" placeholder="Enter email...">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter new password...">
                        <p class="help-block">Leave blank if you don't want to change the password.</p>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password...">
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
<div class="modal fade" id="modalDeleteUser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
                <button type="button" class="close" data-dismiss="modal">
                    <span style="color:#fff;">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteUserName"></strong>?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="deleteUserId">
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
            url : '/api/user',
            type: 'GET',
            data: function (d) { d.datatable = true; return d; }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name',        name: 'name' },
            { data: 'email',       name: 'email' },
            { data: 'created_at',  name: 'created_at' },
            {
                data: null, orderable: false, searchable: false,
                render: function (data, type, row) {
                    return '<button class="btn btn-warning btn-xs btn-edit"'
                             + ' data-id="'    + row.id    + '"'
                             + ' data-name="'  + row.name  + '"'
                             + ' data-email="' + row.email + '">'
                             + '<i class="fa fa-pencil"></i> Edit</button> '
                         + '<button class="btn btn-danger btn-xs btn-delete"'
                             + ' data-id="'   + row.id   + '"'
                             + ' data-name="' + row.name + '">'
                             + '<i class="fa fa-trash"></i> Delete</button>';
                }
            }
        ]
    });

    // Create
    $('#formCreateUser').on('submit', function (e) {
        e.preventDefault();
        var $btn = $(this).find('[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url        : '/api/user',
            type       : 'POST',
            contentType: 'application/json',
            data       : JSON.stringify({
                name                 : $('[name="name"]', this).val(),
                email                : $('[name="email"]', this).val(),
                password             : $('[name="password"]', this).val(),
                password_confirmation: $('[name="password_confirmation"]', this).val(),
            }),
            headers : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success : function () { $('#modalCreateUser').modal('hide'); table.ajax.reload(); },
            error   : function (xhr) { handleValidationErrors(xhr, '#formCreateUser'); },
            complete: function () { $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save'); }
        });
    });

    // Edit
    $('#example1').on('click', '.btn-edit', function () {
        $('#editUserId').val($(this).data('id'));
        $('#editUserName').val($(this).data('name'));
        $('#editUserEmail').val($(this).data('email'));
        $('#modalEditUser').modal('show');
    });

    $('#formEditUser').on('submit', function (e) {
        e.preventDefault();
        var id   = $('#editUserId').val();
        var $btn = $(this).find('[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url        : '/api/user/' + id,
            type       : 'PUT',
            contentType: 'application/json',
            data       : JSON.stringify({
                name                 : $('#editUserName').val(),
                email                : $('#editUserEmail').val(),
                password             : $('[name="password"]', this).val(),
                password_confirmation: $('[name="password_confirmation"]', this).val(),
            }),
            headers : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success : function () { $('#modalEditUser').modal('hide'); table.ajax.reload(null, false); },
            error   : function (xhr) { handleValidationErrors(xhr, '#formEditUser'); },
            complete: function () { $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update'); }
        });
    });

    // Delete
    $('#example1').on('click', '.btn-delete', function () {
        $('#deleteUserId').val($(this).data('id'));
        $('#deleteUserName').text($(this).data('name'));
        $('#modalDeleteUser').modal('show');
    });

    $('#btnConfirmDelete').on('click', function () {
        var id   = $('#deleteUserId').val();
        var $btn = $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url     : '/api/user/' + id,
            type    : 'DELETE',
            headers : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success : function () { $('#modalDeleteUser').modal('hide'); table.ajax.reload(null, false); },
            error   : function () { alert('Failed to delete. Please try again.'); },
            complete: function () { $btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Delete'); }
        });
    });

    // Reset modal
    $('#modalCreateUser, #modalEditUser').on('hidden.bs.modal', function () {
        var $form = $(this).find('form');
        $form[0].reset();
        $form.find('.form-group').removeClass('has-error');
        $form.find('.help-block.error-msg').remove();
    });

});
</script>
@endPushOnce