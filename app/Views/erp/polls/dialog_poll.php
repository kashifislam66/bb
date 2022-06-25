<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\PollsModel;
use App\Models\ConstantsModel;
use App\Models\PollsQuestions;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$PollsModel = new PollsModel();
$PollsQuestions = new PollsQuestions();
$ConstantsModel = new ConstantsModel();
$get_animate = '';

if($request->getGet('data') === 'polls' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$result = $PollsModel->where('poll_id', $ifield_id)->first();
$questions = $PollsQuestions->where('poll_ref_id', $ifield_id)->where('company_id', $result['company_id'])->findAll();

?>
<div class="modal-header">
    <h5 class="modal-title">
        <?= lang('Main.xin_edit_poll');?>
        <span class="font-weight-light">
            <?= lang('Main.xin_information');?>
        </span> <br>
        <small class="text-muted">
            <?= lang('Main.xin_below_required_info');?>
        </small>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span>
    </button>
</div>
<?php $attributes = array('name' => 'edit_poll', 'id' => 'edit_poll', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open('erp/polls/update_poll', $attributes, $hidden);?>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="contact_number">
                    <?= lang('Main.title');?>
                    <span class="text-danger">*</span> </label>
                <input class="form-control" placeholder="<?= lang('Main.title');?>" name="poll_title" type="text"
                    value="<?= $result['poll_title'];?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="contact_number">
                    <?= lang('Main.xin_poll_start_date');?>
                    <span class="text-danger">*</span> </label>
                <input class="form-control m_date" placeholder="<?= lang('Main.xin_poll_start_date');?>"
                    name="poll_start_date" type="text" value="<?= $result['poll_start_date'];?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="contact_number">
                    <?= lang('Main.xin_poll_end_date');?>
                    <span class="text-danger">*</span> </label>
                <input class="form-control m_date" placeholder="<?= lang('Main.xin_poll_end_date');?>"
                    name="poll_end_date" type="text" value="<?= $result['poll_end_date'];?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="status" class="control-label">
                    <?= lang('Main.dashboard_xin_status');?>
                </label>
                <select class="form-control" name="is_active" data-plugin="select_hrm"
                    data-placeholder="<?= lang('Main.dashboard_xin_status');?>">
                    <option value="0" <?php if($result['is_active']=='0'):?> selected <?php endif; ?>>
                        <?= lang('Main.xin_employees_inactive');?>
                    </option>
                    <option value="1" <?php if($result['is_active']=='1'):?> selected <?php endif; ?>>
                        <?= lang('Main.xin_employees_active');?>
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="after-edit-more">
    <?php $totalItems = count($questions);
    foreach($questions as $key => $question_res) : ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="contact_number">
                        <?= lang('Main.xin_poll_question');?>
                        <span class="text-danger">*</span> </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_poll_question');?>" name="poll_question[<?= $question_res['id'] ?>]"
                        type="text" value="<?= $question_res['poll_question'];?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contact_number">
                        <?= lang('Main.xin_poll_answer1');?>
                        <span class="text-danger">*</span> </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_poll_answer1');?>" name="poll_answer1[<?= $question_res['id'] ?>]"
                        type="text" value="<?= $question_res['poll_answer1'];?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contact_number">
                        <?= lang('Main.xin_poll_answer2');?>
                        <span class="text-danger">*</span> </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_poll_answer2');?>" name="poll_answer2[<?= $question_res['id'] ?>]"
                        type="text" value="<?= $question_res['poll_answer2'];?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contact_number">
                        <?= lang('Main.xin_poll_answer3');?>
                    </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_poll_answer3');?>" name="poll_answer3[<?= $question_res['id'] ?>]"
                        type="text" value="<?= $question_res['poll_answer3'];?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contact_number">
                        <?= lang('Main.xin_poll_answer4');?>
                    </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_poll_answer4');?>" name="poll_answer4[<?= $question_res['id'] ?>]"
                        type="text" value="<?= $question_res['poll_answer4'];?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="contact_number">
                        <?= lang('Main.xin_poll_answer5');?>
                    </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_poll_answer5');?>" name="poll_answer5[<?= $question_res['id'] ?>]"
                        type="text" value="<?= $question_res['poll_answer5'];?>">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">
                        <?= lang('Main.xin_notes');?>
                    </label>
                    <textarea class="form-control" placeholder="<?= lang('Main.xin_notes');?>" name="notes[<?= $question_res['id'] ?>]" cols="30"
                        rows="3" id="notes"><?= $question_res['notes'];?></textarea>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="col-md-2">
            <div class="form-group change">
                <label for="">&nbsp;</label><br />
                <a class="btn btn-success edit-more">+ Add More</a>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">
        <?= lang('Main.xin_close');?>
    </button>
    <button type="submit" class="btn btn-primary">
        <?= lang('Main.xin_update');?>
    </button>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
$(document).ready(function() {

    $('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_hrm"]').select2({
        width: '100%'
    });
    Ladda.bind('button[type=submit]');
    $('.m_date').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        clearButton: false,
        switchOnClick: true,
        format: 'YYYY-MM-DD',
        //cancelText: 'Cancelll', okText: 'Okk',clearText: 'Clearr',nowText: 'Noww'
    });
    /* Edit data */
    $("#edit_poll").submit(function(e) {
        var fd = new FormData(this);
        var obj = $(this),
            action = obj.attr('name');
        fd.append("is_ajax", 1);
        fd.append("type", 'edit_record');
        fd.append("form", action);
        e.preventDefault();
        $.ajax({
            url: e.target.action,
            type: "POST",
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success: function(JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    Ladda.stopAll();
                } else {
                    // On page load: datatable
                    var xin_table = $('#xin_table').dataTable({
                        "bDestroy": true,
                        "ajax": {
                            url: "<?= site_url("erp/polls/polls_list") ?>",
                            type: 'GET'
                        },
                        "language": {
                            "lengthMenu": dt_lengthMenu,
                            "zeroRecords": dt_zeroRecords,
                            "info": dt_info,
                            "infoEmpty": dt_infoEmpty,
                            "infoFiltered": dt_infoFiltered,
                            "search": dt_search,
                            "paginate": {
                                "first": dt_first,
                                "previous": dt_previous,
                                "next": dt_next,
                                "last": dt_last
                            },
                        },
                        "fnDrawCallback": function(settings) {
                            $('[data-toggle="tooltip"]').tooltip();
                        }
                    });
                    xin_table.api().ajax.reload(function() {
                        toastr.success(JSON.result);
                    }, true);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    $('.edit-modal-data').modal('toggle');
                    Ladda.stopAll();
                }
            },
            error: function() {
                toastr.error(JSON.error);
                $('input[name="csrf_token"]').val(JSON.csrf_hash);
                Ladda.stopAll();
            }
        });
    });
});

$(document).ready(function() {
        var totalItems = <?php echo json_encode($totalItems); ?>;
        var counter = totalItems + 1;
    $("body").on('click', '.edit-more', '.btn-remove-detail-row-edit', function(e) {
        e.preventDefault();
        counter++;
        //var rowid = Math.random();
        var $html = '<div class="item-single-row" id="' + counter + '">\
		<div class="pull-right" style="margin-bottom:10px;text-align: right;" ><button class="btn btn-sm btn-success btn btn-danger btn-remove-detail-row-edit">Remove</i></button></div>\
		<div class="row">\
		<div class="col-md-12">\
					<div class="form-group">\
						<label for="contact_number">\
							Poll Question \
							<span class="text-danger">*</span> </label>\
						<input class="form-control" placeholder="Poll Question "\
							name="poll_question[' + counter + ']" type="text" value="">\
					</div>\
				</div>\
				</div>\
			<div class="row">\
				<div class="col-md-4">\
					<div class="form-group">\
						<label for="contact_number">\
							Poll Answer #1\
							<span class="text-danger">*</span> </label>\
						<input class="form-control" placeholder="Poll Answer #1"\
							name="poll_answer1[' + counter + ']" type="text" value="">\
					</div>\
				</div>\
				<div class="col-md-4">\
					<div class="form-group">\
						<label for="contact_number">\
							Poll Answer #2\
							<span class="text-danger">*</span> </label>\
						<input class="form-control" placeholder="Poll Answer #2"\
							name="poll_answer2[' + counter + ']" type="text" value="">\
					</div>\
				</div>\
				<div class="col-md-4">\
					<div class="form-group">\
						<label for="contact_number">\
							Poll Answer #3 (Optional)\
						</label>\
						<input class="form-control" placeholder="Poll Answer #3 (Optional)"\
							name="poll_answer3[' + counter + ']" type="text" value="">\
					</div>\
				</div>\
				<div class="col-md-4">\
					<div class="form-group">\
						<label for="contact_number">\
							Poll Answer #4 (Optional)\
						</label>\
						<input class="form-control" placeholder="Poll Answer #4 (Optional)"\
							name="poll_answer4[' + counter + ']" type="text" value="">\
					</div>\
				</div>\
				<div class="col-md-4">\
					<div class="form-group">\
						<label for="contact_number">\
							Poll Answer #5 (Optional)\
						</label>\
						<input class="form-control" placeholder="Poll Answer #5 (Optional)"\
							name="poll_answer5[' + counter + ']" type="text" value="">\
					</div>\
				</div>\
				<div class="col-md-12">\
					<div class="form-group">\
						<label for="address">\
							Notes\
						</label>\
						<textarea class="form-control" placeholder="Notes" name="notes[' + counter + ']"\
							cols="30" rows="3" id="notes"></textarea>\
					</div>\
				</div>\
			</div></div>';
        $(".after-edit-more").append($html);
    });

    $("body").on('click', '.btn-remove-detail-row-edit', function() {
        var $row = $(this).parents('.item-single-row');

        $row.remove();
    });
});
</script>
<?php }
?>