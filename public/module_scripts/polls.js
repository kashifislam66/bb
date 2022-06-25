$(document).ready(function() {
    var xin_table = $('#xin_table').dataTable({
        "bDestroy": true,
        "ajax": {
            url: main_url + "polls/polls_list",
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

    $('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_hrm"]').select2({ width: '100%' });
    /* Delete data */
    $("#delete_record").submit(function(e) {
        /*Form Submit*/
        e.preventDefault();
        var obj = $(this),
            action = obj.attr('name');
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize() + "&is_ajax=2&type=delete_record&form=" + action,
            cache: false,
            success: function(JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    Ladda.stopAll();
                } else {
                    $('.delete-modal').modal('toggle');
                    xin_table.api().ajax.reload(function() {
                        toastr.success(JSON.result);
                    }, true);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    Ladda.stopAll();
                }
            }
        });
    });

    // edit
    $('.edit-modal-data').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var field_id = button.data('field_id');
        var modal = $(this);
        $.ajax({
            url: main_url + "polls/read_poll",
            type: "GET",
            data: 'jd=1&data=polls&field_id=' + field_id,
            success: function(response) {
                if (response) {
                    $("#ajax_modal").html(response);
                }
            }
        });
    });

    /* Add data */
    /*Form Submit*/
    $("#xin-form").submit(function(e) {
        var fd = new FormData(this);
        var obj = $(this),
            action = obj.attr('name');
        fd.append("is_ajax", 1);
        fd.append("type", 'add_record');
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
                    xin_table.api().ajax.reload(function() {
                        toastr.success(JSON.result);
                    }, true);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    $('#xin-form')[0].reset(); // To reset form fields
                    $('.add-form').removeClass('show');
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
    /* Add data */
    /*Form Submit*/
    $("#update_vote").submit(function(e) {
        var fd = new FormData(this);
        var obj = $(this),
            action = obj.attr('name');
        fd.append("is_ajax", 1);
        fd.append("type", 'add_record');
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
                    toastr.success(JSON.result);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    Ladda.stopAll();
                    setTimeout(function() {
                        window.location = '';
                    }, 2000);
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
$(document).on("click", ".delete", function() {
    $('input[name=_token]').val($(this).data('record-id'));
    $('#delete_record').attr('action', main_url + 'polls/delete_poll');
});

$(document).ready(function() {
    var counter = 1;
    $("body").on('click', '.add-more', '.btn-remove-detail-row', function(e) {
        e.preventDefault();
        counter++;
        //var rowid = Math.random();
        var $html = '<div class="item-single-row" id="' + counter + '">\
		<div class="pull-right" style="margin-bottom:10px;text-align: right;" ><button class="btn btn-sm btn-success btn btn-danger btn-remove-detail-row">Remove</i></button></div>\
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
        $(".after-add-more").append($html);
    });

    $("body").on('click', '.btn-remove-detail-row', function() {
        var $row = $(this).parents('.item-single-row');

        $row.remove();
    });
});