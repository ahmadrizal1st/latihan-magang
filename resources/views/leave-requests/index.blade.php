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
        $(function ()                //         ct2
        function makeSelect2($el, url, placeholder, ext            ) {
            if ($el.hasClass('select2-hidden-accessible')) $el.sele            troy');
                      lect2({
            dropdownParent: $el                odal'),
         placehold                der,
        allow                
                minimu                : 0,
                       x:                            rl,
                                  'json                           ay: 300,
                                         arams) {
                        var q                         erm ?? '' };
                        if (typeof extraParams === 'fu                         extraPara                                           rn q;
                    },
                                 sults: function (response) {
                        var it                        ts ?? res                                                    return {
                                       : $.map(items, function (item) {
                                re                            : i                        e ?                                                   })
                                };
                            },
                    cache: fa                        }
                });
        }

        function setSelect2Val($el, id, text) {
            if (!id) return;
                 f (!$el.find('option[value="' +        + '        .length) $el.a        d(new Option(text, id, true, true));
                       (id).trigger('change');
        }

        // Validati               function handleValidationErrors(xhr, formSel)                   $(formSel + ' .form-group').remo            'has-error');
                   ormSel + ' .help-block.error-msg').remove();                 var errors = xhr.responseJSON?.errors;
            i                return;
            $.each(errors, function (field, m                               var $input = $(formSel + ' [name="' + field + '"]');
                       put.        est        orm-group').a        ass('has-error');
                $inpu            '<span class="help            rror-msg">' + mess            + '</sp');
                });
        }

               DataTable        v             = $('#e                taTble({
            process                           se                ue,
            scrollX: true,
            responsive                            autoWidth:                        ajax: {
              url: '/api/le -request',
                type: 'GET',                     data: function (d)  d.datatable = true;  turn d; }
            },
            columns: [
                            'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'employee                 'employee_nip' e: false, search                 defaultContent:                 { d                ee_name', name: 'empl _name', orderable: fal                le: false, defaultC : '-' },
                            'type', name: 'type'                  { data:                am                                                    t_date', name: 'st                                 { data                    me: 'end_date' },
                { d                        name: 'return                              {
                    data: null,
                                                         se se,
   der: f                                                    e = row;
                  ret                            arning btn-xs btn-edit"'
                       + ' data-i                                             mployee-i oyee_id ?? ''                                   + ' data-em me="' + (e. e ?? '') + '"                             + ' data-type="' + (e  ?? '') + '"'
                                           .reason ?? '') + '"'                ' data-start                            ') + '"'
                         + ' da date="' + (e.e                                                + ' data-return-date="' + (e                            '
                            + '<i class="fa fa-penc                                                    + '<b                            tn-xs btn-delete"'
                            +                     .i                                                     + '<i clas        a fa-trash"></i> Delete</button>';
                    }
                    }
            ]
        });

        // Create
        $('#modalCreateLeaveRequest').on('show.bs.modal        uncti        ) {
            makeSelect2($('#formCreateLeaveRequest .s            mployee'), '/api/emp            '-- Select Employee --');
        });

        $('#formCreateLeaveRequest').on('submit', function (e) {
            e.preven            ();
                     btns).find('[type="submit"]'                bled).html('<i                a-spa-spin"></i> Saving...'                    $.aax({
                url: '/api/leave-request',
                type: 'POST',
                       a: $(s).serialize(),
                success: function () { $('#modalCreateLeaveReq                ('hide'); table.ajax.reload(); },
                error: function (xhr) { handleValidationErrors            form        teLea        quest');                        complete: function () { $btn.prop('dis            false).html('<i class            save"></i> Save'); }
            });
        })               // Edit
        $('#example1').on('click'            edit', function () {
            var $btn = $(th                      $('#editLeaveRequestId').val($btn.data('id'))                  $('#editLeaveType').val($btn.data('type'));
                $('#editLeaveReason').val($btn.data('reason'));
                   #editLeaveStartDate').val($btn.data('start-date'));
            $('#            eEndDate').val($btn.data('end-date'));
            $('#editLeaveReturnDa            ($btn.data('return-date'));

            var $employeeSelect = $('#formEditLeaveRequest            2-employee');
            makeSelect2($empl        Selec        /api/employee', '-- Select Employee --');
            s            2Val($employeeSelect            ata('e oyee-id'), $btn.data('employee-nam                       $('#modalEditLeaveRequest').modal('show');
        });

        $('#formEditLeaveRequest').on('submit', function (e                    e                ult        var id = $('#editLeaveR                al()       va                his)[type="submit"]').prop(                true).hml('<i class="fa fa-spinner fa-spin"></i> Updating...');

            $.ajax({
                               leavequest/' + id,
                type: 'PUT',
                data: $(this).ser                              success: function () { $('#modalEditLeaveRequest').modal('hide'); table.ajax.reload(            lse)        
                    er         function (xhr) { handleValidationErrors(xhr, '#formEdit            uest'); },
                complete: function () { $            ('disabled', false).html('<i class="fa fa-sav        /i> U        e'); }
            });
        });

        // De                 $ example1').on('click', '.btn-delete'            on () {
            $('#deleteLeaveRequestId').val($(this).data('id'));
            $('#modalDeleteLea            t').modal                   );

        $('#btnConfirmDelet                k', ction () {
                 ar id =$('#deleteLeaveRequestId').val();
            var $btn = $(this).prop('disabled', true).html('<i                a-spir fa-spin"></i> Deleting...');

            $.ajax({
                            pi/leave-request/' + id,
                type: 'DELETE',
                success: function () { $('            lete        eRequ        ).modal('hide')        ble.ajax.reload(null, false); },
                error: function () { alert('Failed to del            ase try again.'); },
                         ete: function () {             p('disabled', false).html('<i class="fa fa-trash"><                ; }
            });
        });

        // Reset modal
        $('#modalCreate                , #modalEditLeave            ).on            .bs.modal', function () {
            var $form = $(            nd('form');
            $form[0].reset();

                    $formct2-employee').each(function () {
                if ($(this).hasClass('select2-hidden-accessible')) $(this).select2('destroy');
                $(this).empty();
            });
            $form.find('.form-group').removeClass('has-error');
            $form.find('.help-block.error-msg').remove();
        });

    });
</script>
@endPushOnce