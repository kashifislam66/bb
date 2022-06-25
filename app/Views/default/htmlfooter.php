<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\FormsModel;
use App\Models\TerminationModel;
use App\Models\ResignationsModel;
use App\Models\SignaturedocumentsModel;

$SystemModel = new SystemModel();
$UserRolesModel = new RolesModel();
$UsersModel = new UsersModel();	
$TerminationModel = new TerminationModel();
$ResignationsModel = new ResignationsModel();	
$SignaturedocumentsModel = new SignaturedocumentsModel();

$session = \Config\Services::session();
$session = $session->get('sup_username');
$request = \Config\Services::request();
$router = service('router');

$xin_system = $SystemModel->where('setting_id', 1)->first();
$role_user = $UserRolesModel->where('role_id', 1)->first();
$user_info = $UsersModel->where('user_id', $session['sup_user_id'])->first();
?>
<?= view('default/vendors/modal_erp');?>

<!-- Core scripts -->

<!-- Required Js -->
    <script src="<?= base_url();?>/public/assets/js/vendor-all.min.js"></script>
    <script src="<?= base_url();?>/public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/bootstrap.min1.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/feather.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/pcoded.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/clipboard.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/uikit.min.js"></script>
	<script src="<?= base_url();?>/public/assets/plugins/time/date-en-US.js"></script>
	<script src="<?= base_url();?>/public/assets/plugins/time/jquery.ui.timeselect.js"></script>
    
    <?php /*?><script src="<?= base_url();?>/public/assets/js/vendor-all.min.js"></script>
    <script src="<?= base_url();?>/public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/popper.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/bootstrap.min1.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/feather.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/pcoded.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/clipboard.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/uikit.min.js"></script><?php */?>
    
    
    <script src="<?= base_url();?>/public/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/select2.full.min.js"></script>
    <script src="<?= base_url();?>/public/assets/plugins/toastr/toastr.js"></script>
	<script src="<?= base_url();?>/public/assets/plugins/sweetalert2/sweetalert2@10.js"></script>
    <link rel="stylesheet" href="<?= base_url();?>/public/assets/plugins/ladda/ladda.css">
    <script src="<?= base_url();?>/public/assets/plugins/spin/spin.js"></script>
    <script src="<?= base_url();?>/public/assets/plugins/ladda/ladda.js"></script>
    <script src="<?= base_url();?>/public/assets/plugins/moment/moment.js"></script>
    <script src="<?php echo base_url();?>/public/assets/plugins/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>

    <script src="<?= base_url();?>/public/assets/plugins/colorpicker/bootstrap-colorpicker.js"></script>
    <link href="<?= base_url();?>/public/assets/plugins/colorpicker/bootstrap-colorpicker.css" rel="stylesheet">
    <script src="<?= base_url();?>/public/assets/js/plugins/jquery.bootstrap.wizard.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/jquery.barrating.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/isotope.pkgd.min.js"></script>

    <script src="<?= base_url();?>/public/assets/js/plugins/jquery.barrating.min.js"></script>
    <?php if($router->controllerName() == '\App\Controllers\Erp\Todos' || $router->methodName() == 'training_details' || $router->methodName() == 'ticket_details'){?>
    <script src="<?= base_url();?>/public/assets/js/pages/todo.js"></script>
    <?php } ?>
    <?php if($router->methodName() == 'events_calendar' || $router->methodName() == 'meetings_calendar' || $router->methodName() == 'leave_calendar' || $router->methodName() == 'invoice_calendar' || $router->methodName() == 'projects_calendar' || $router->methodName() == 'tasks_calendar' || $router->methodName() == 'goals_calendar' || $router->methodName() == 'training_calendar' || $router->methodName() == 'travel_calendar' || $router->methodName() == 'holidays_calendar' || $router->controllerName() == '\App\Controllers\Erp\Dashboard' || $router->methodName() =='erp_calendar' || $router->methodName() =='client_invoice_calendar' || $router->methodName() =='estimates_calendar'){?>
    <script src="<?= base_url();?>/public/assets/js/plugins/moment.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/fullcalendar.min.js"></script>
    <?php } ?>
    <?php if($router->methodName() =='goal_details' || $router->methodName() =='task_details' || $router->methodName() =='project_details' || $router->methodName() =='general_task_details'){?>
    <script type="text/javascript" src="<?= base_url();?>/public/assets/plugins/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript">
	$(document).ready(function(){	
		$("#range_grid").ionRangeSlider({
			type: "single",
			min: 0,
			max: 100,
			from: '<?php echo $progress;?>',
			grid: true,
			force_edges: true,
			onChange: function (data) {
				$('#progres_val').val(data.from);
			}
		});
	});
	</script>
    <?php } ?>
    <script src="<?= base_url();?>/public/assets/js/plugins/bootstrap-timepicker.min.js"></script>
     <script>
	$('.date').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		clearButton: true,
		switchOnClick: true,
		format: 'YYYY-MM-DD'
	});
	// default time
    $('.timepicker').timepicker({
        defaultTime: '',
        minuteStep: 10,
        secondStep:30,
        showSeconds: false,
        maxHours:24,
        showMeridian: false
    });
	$(".time_dropdown_add").timeselect({
        'step': 1,
        autocompleteSettings: {
            autoFocus: true
        }
    });
	$('.timepicker222').bootstrapMaterialDatePicker({
		date: false,
		shortTime: true,
		format: 'HH:mm'
	});
  	$('.hr_month_year').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat:'yy-mm',
		yearRange: '1950:' + (new Date().getFullYear() + 15),
		beforeShow: function(input) {
			$(input).datepicker("widget").addClass('hide-calendar');
		},
		onClose: function(dateText, inst) {
			var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
			$(this).datepicker('setDate', new Date(year, month, 1));
			$(this).datepicker('widget').removeClass('hide-calendar');
			$(this).datepicker('widget').hide();
		}
			
	});
</script>
<script>
	 $(function() {
        $('#ex20a').on('click', function(e) {
            $('#ex20a')
                .parent()
                .find(' >.well')
                .toggle()
                .find('input')
                .slider('relayout');
            e.preventDefault();
        });
    });
	// [ rating-fontawesome ]
	$('.star-rating').barrating({
		theme: 'fontawesome-stars',
		showSelectedRating: false
	});
	$('.bar-rating').barrating('show', {
            theme: 'bars-1to10',
        });
        var currentRating = $('#demo-fontawesome-o').data('current-rating');
	$('#demo-fontawesome-o').barrating({
            theme: 'fontawesome-stars-o',
            showSelectedRating: false,
            initialRating: $('#demo-fontawesome-o').data('current-rating'),
			hoverState: false,
			readonly: false,
			clickState: false,
        });
    // init Isotope
    var $grid = $('.grid').isotope({
        itemSelector: '.element-item',
        layoutMode: 'fitRows',
        getSortData: {
            name: '.name',
            symbol: '.symbol',
            number: '.number parseInt',
            category: '[data-category]',
        }
    });

    // bind filter button click
    $('#filters').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
            filter: filterValue
        });
    });
    $('#filters-side').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
            filter: filterValue
        });
    });
    // change active class on buttons
    $('.button-group').each(function(i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'button', function() {
            $buttonGroup.find('.active').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
    <script>
    $('.chk-indeterminate').prop('indeterminate', true);
    </script>
	<script type="application/javascript">
	$(document).ready(function(){
		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });
        $('.demo-movie').barrating('show', {
            theme: 'bars-movie'
        });
		$('.hr_color').colorpicker({
		  format: 'auto'
		});
        //Ladda.bind('button[type=submit]');
        toastr.options.closeButton = <?= $xin_system['notification_close_btn'];?>;
        toastr.options.progressBar = <?= $xin_system['notification_bar'];?>;
        toastr.options.timeOut = 3000;
        toastr.options.preventDuplicates = true;
        toastr.options.positionClass = "<?= $xin_system['notification_position'];?>";
    });
    </script>
    <?php if($router->methodName() != 'reports'):?>
    <script type="application/javascript">
	$(document).ready(function(){
		Ladda.bind('button[type=submit]');
	});
	</script>
    <?php endif;?>
    <?php if($router->controllerName() == '\App\Controllers\Erp\Dashboard' || $router->methodName() == 'helpdesk_dashboard' || $router->methodName() == 'projects_dashboard' || $router->methodName() == 'timesheet_dashboard' || $router->methodName() == 'invoice_dashboard' || $router->methodName() == 'leave_status' || $router->methodName() == 'tasks_summary' || $router->methodName() == 'corehr_dashboard' || $router->methodName() == 'staff_dashboard' || $router->methodName() == 'client_details' || $router->methodName() == 'recruitment_dashboard' || $router->methodName() == 'tickets_page' || $router->methodName() == 'recruitment_dashboard' || $router->controllerName() == '\App\Controllers\Erp\Leave' || $router->methodName() == 'project_invoices' || $router->methodName() == 'jobs'){?>
    
    <script src="<?= base_url();?>/public/assets/js/plugins/apexcharts.min.js"></script>
    <script src="<?= base_url();?>/public/assets/js/plugins/jquery.peity.min.js"></script>
    <?php } ?>
    <?php if($router->methodName() =='tasks_scrum_board' || $router->methodName() =='projects_scrum_board') { ?>
    <script src="<?php echo base_url();?>/public/assets/plugins/dragula/dragula.js"></script>
    <?php } ?>
    
    <script type="text/javascript">
    var desk_url = '<?php echo site_url('erp/desk'); ?>';
    var processing_request = '<?= lang('Login.xin_processing_request');?>';</script>
	<script type="text/javascript">var dt_lengthMenu = '<?= lang('Datatables.xin_dt_lengthMenu');?>';</script>
	<script type="text/javascript">var dt_zeroRecords = '<?= lang('Datatables.xin_dt_zeroRecords');?>';</script>
	<script type="text/javascript">var dt_info = '<?= lang('Datatables.xin_dt_info');?>';</script>
	<script type="text/javascript">var dt_infoEmpty = '<?= lang('Datatables.xin_dt_infoEmpty');?>';</script>
	<script type="text/javascript">var dt_infoFiltered = '<?= lang('Datatables.xin_dt_infoFiltered');?>';</script>
	<script type="text/javascript">var dt_search = '<?= lang('Datatables.xin_dt_search');?>';</script>
	<script type="text/javascript">var dt_first = '<?= lang('Datatables.dt_first');?>';</script>
	<script type="text/javascript">var dt_previous = '<?= lang('Datatables.dt_previous');?>';</script>
	<script type="text/javascript">var dt_next = '<?= lang('Datatables.dt_next');?>';</script>
	<script type="text/javascript">var dt_last = '<?= lang('Datatables.dt_last');?>';</script>
	<script type="text/javascript">var main_url = '<?= site_url('erp/'); ?>';</script>
    <script type="text/javascript">var base_url = '<?= base_url(''); ?>';</script>
	<script type="text/javascript">var processing_request = '<?= lang('Login.xin_processing_request');?>';</script>
	<script type="text/javascript">var request_submitted = '<?= lang('Dashboard.xin_hr_request_submitted');?>';</script>
    
    <script type="text/javascript" src="<?php echo base_url();?>/public/assets/plugins/kendo/kendo.all.min.js"></script>
    <script src="<?php echo base_url();?>/public/assets/plugins/kendo/kendo.timezones.min.js"></script>
    
	<script type="text/javascript" src="<?= base_url().'/public/module_scripts/'.$path_url.'.js'; ?>"></script>
    <?php if($router->controllerName() == '\App\Controllers\Erp\Dashboard') { ?>
    	<?php if($user_info['user_type'] == 'staff'){ ?>
			<?php if($xin_system['is_ssl_available'] == 1){ ?>
            <script type="text/javascript" src="<?= base_url().'/public/module_scripts/staff/set_clocking_ssl.js'; ?>"></script>
            <?php } else {?>
            <script type="text/javascript" src="<?= base_url().'/public/module_scripts/staff/set_clocking_non_ssl.js'; ?>"></script>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php if($router->controllerName() =='\App\Controllers\Erp\Settings' && $router->methodName() =='index') { ?>
    <script src="<?php echo base_url();?>/public/assets/js/plugins/ekko-lightbox.min.js"></script>
    <script src="<?php echo base_url();?>/public/assets/js/plugins/lightbox.min.js"></script>
    <script src="<?php echo base_url();?>/public/assets/js/pages/ac-lightbox.js"></script>
    <?php } ?>
    
    <?php if($router->methodName() =='leave_status' || $router->methodName() =='invoice_dashboard' || $router->methodName() =='tickets_page' || $router->methodName() == 'recruitment_dashboard' || $router->methodName() == 'tasks_summary' || $router->methodName() == 'projects_dashboard' || $router->controllerName() == '\App\Controllers\Erp\Dashboard' || $router->controllerName() == '\App\Controllers\Erp\Leave' || $router->methodName() == 'project_invoices' || $router->methodName() == 'jobs') { ?>
    <script type="text/javascript" src="<?= base_url().'/public/module_scripts/dashboard/leave_status.js'; ?>"></script>
    <?php } ?>
    <script>
		$(".editor").kendoEditor({
			resizable: {
				content: true,
				toolbar: true
			}
		});
        </script>
    <?php if($router->controllerName() == '\App\Controllers\Erp\Roles'){?>
    <?php /*?><script type="text/javascript" src="<?= base_url();?>/public/assets/plugins/kendo/kendo.all.min.js"></script><?php */?>
	
    <?= view('erp/staff_roles/role_values');?>
    <?php } ?>
    <?php if($router->methodName() =='org_chart'){?>
	<?= view('default/vendors/org_chart');?>
    <?php }?>
    <?php if($router->methodName() =='events_calendar'){?>
	<?= view('default/vendors/events_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='meetings_calendar'){?>
	<?= view('default/vendors/meetings_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='leave_calendar'){?>
	<?= view('default/vendors/leave_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='invoice_calendar'){?>
	<?= view('default/vendors/invoice_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='estimates_calendar'){?>
	<?= view('default/vendors/estimates_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='client_invoice_calendar'){?>
	<?= view('default/vendors/client_invoice_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='projects_calendar'){?>
	<?= view('default/vendors/projects_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='tasks_calendar'){?>
	<?= view('default/vendors/tasks_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='goals_calendar'){?>
	<?= view('default/vendors/goals_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='training_calendar'){?>
	<?= view('default/vendors/training_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='travel_calendar'){?>
	<?= view('default/vendors/travel_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='holidays_calendar'){?>
	<?= view('default/vendors/holidays_calendar');?>
    <?php }?>
    <?php if($router->methodName() =='erp_calendar'){?>
	<?= view('default/vendors/full_hr_calendar');?>
    <?php }?>
    <?php if($router->controllerName() == '\App\Controllers\Erp\Dashboard'){?>	
    <?= view('default/vendors/full_anniversary_calendar');?>
    <?php } ?>
    <script>
	$('.btn-print-invoice').on('click', function() {
		var link2 = document.createElement('link');
		link2.innerHTML =
			'<style>@media print{*,::after,::before{text-shadow:none!important;box-shadow:none!important}a:not(.btn){text-decoration:underline}abbr[title]::after{content:" ("attr(title) ")"}pre{white-space:pre-wrap!important}blockquote,pre{border:1px solid #adb5bd;page-break-inside:avoid}thead{display:table-header-group}img,tr{page-break-inside:avoid}h2,h3,p{orphans:3;widows:3}h2,h3{page-break-after:avoid}@page{size:a3}body{min-width:992px!important}.container{min-width:992px!important}.navbar{display:none}.badge{border:1px solid #000}.table{border-collapse:collapse!important}.table td,.table th{background-color:#fff!important}.table-bordered td,.table-bordered th{border:1px solid #dee2e6!important}.table-dark{color:inherit}.table-dark tbody+tbody,.table-dark td,.table-dark th,.table-dark thead th{border-color:#dee2e6}.table .thead-dark th{color:inherit;border-color:#dee2e6}}.page-header{display:none;}</style>';

		document.getElementsByTagName('head')[0].appendChild(link2);
		window.print();
	});
</script>
<?php if($router->methodName() =='create_invoice' || $router->methodName() =='edit_invoice' || $router->methodName() =='create_estimate' || $router->methodName() =='edit_estimate'){?>
    <script type="text/javascript">
	$(document).ready(function(){
		$('#add-invoice-item').click(function () {
			var invoice_items = '<div class="row item-row">'
						+'<hr>'
						+'<div class="form-group mb-1 col-sm-12 col-md-3">'
						+'<label for="item_name"><?= lang('Invoices.xin_title_item');?></label>'
						+'<br>'
						+'<input type="text" class="form-control form-control-sm item_name" name="item_name[]" id="item_name" placeholder="Item Name">'
						+'</div>'
						+'<div class="form-group mb-1 col-sm-12 col-md-2">'
						+'<label for="qty_hrs" class="cursor-pointer"><?= lang('Invoices.xin_title_increases');?></label>'
						+'<br>'
						+'<div class="input-group input-group-sm">'
						+'<input type="text" class="form-control form-control-sm increases" name="qty_increases[]" id="qty_increases" value="100">'
						+'<span class="input-group-text" id="inputGroup-sizing-sm">%</span>'
						+'</div>'
						+'</div>'
						+'<div class="form-group mb-1 col-sm-12 col-md-1">'
						+'<label for="qty_hrs" class="cursor-pointer"><?= lang('Invoices.xin_title_days');?></label>'
						+'<br>'
						+'<input type="text" class="form-control form-control-sm qty_days" name="qty_days[]" id="qty_days" value="1">'
						+'</div>'
						+'<div class="form-group mb-1 col-sm-12 col-md-1">'
						+'<label for="qty_hrs" class="cursor-pointer"><?= lang('Invoices.xin_title_qty_hrs');?></label>'
						+'<br>'
						+'<input type="text" class="form-control form-control-sm qty_hrs" name="qty_hrs[]" id="qty_hrs" value="1">'
						+'</div>'
						+'<div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2">'
						+'<label for="unit_price"><?= lang('Invoices.xin_title_unit_price');?></label>'
						+'<br>'
						+'<input class="form-control form-control-sm unit_price" type="text" name="unit_price[]" value="0" id="unit_price" />'
						+'</div>'
						+'<div class="form-group mb-1 col-sm-12 col-md-2">'
						+'<label for="profession"><?= lang('Invoices.xin_subtotal');?></label>'
						+'<input type="text" class="form-control form-control-sm sub-total-item" readonly="readonly" name="sub_total_item[]" value="0" />'
						+'<p style="display:none" class="form-control-static"><span class="amount-html">0</span></p>'
						+'</div>'
						+'<div class="form-group col-sm-12 col-md-1 text-xs-center">'
						+'<label for="profession">&nbsp;</label><br><button type="button" class="btn icon-btn btn-sm btn-outline-danger waves-effect waves-light remove-invoice-item" data-repeater-delete=""> <span class="fa fa-trash"></span></button>'
						+'</div>'
						+'</div>'
	
			$('#item-list').append(invoice_items).fadeIn(500);
	
		});
	});	
	
	</script>
    <?php } ?>
    <?php if($router->methodName() =='upgrade_subscription'){?>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script> 
    <script type="text/javascript">
	//set your publishable key
	Stripe.setPublishableKey('<?= $xin_system['stripe_publishable_key'];?>');
	//callback to handle the response from stripe
	function stripeResponseHandler(status, response) {
		if (response.error) {
			//enable the submit button
			$('#payBtn').removeAttr("disabled");
			//display the errors on the form
			$(".payment-errors").html('<div class="alert alert-danger">'+response.error.message+'</div>');
			$("#payBtn").removeAttr("data-loading");
		} else {
			var form$ = $("#stripe_payment");
			//get token id
			var token = response['id'];
			//insert the token into the form
			form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
			//submit form to the server
			form$.get(0).submit();
		}
	}
	$(document).ready(function() {
		//on form submit
		$("#stripe_payment").submit(function(event) {
			//disable the submit button to prevent repeated clicks
			$('#payBtn').attr("disabled", "disabled");
			
			//create single-use token to charge the user
			Stripe.createToken({
				number: $('.card-number').val(),
				cvc: $('.card-cvc').val(),
				exp_month: $('.card-expiry-month').val(),
				exp_year: $('.card-expiry-year').val()
			}, stripeResponseHandler);
			
			//submit from callback
			return false;
		});
	});
	</script>
    <?php } ?>
	<?php if($router->controllerName() == '\App\Controllers\Erp\Files' && $router->methodName() == 'view_file'){?>
    <?php
		$segment_id = $request->uri->getSegment(3);
		$document_id = udecode($segment_id);
		$result = $SignaturedocumentsModel->where('document_id', $document_id)->first();	
	?>	
    <script type="text/javascript">var base_url = '<?= base_url(''); ?>';</script>
    <script type="text/javascript">var file_url = '<?= base_url();?>/public/uploads/pdf_files/files/<?= $result['document_file'];?>';</script> 
    <link rel="stylesheet" href="<?= base_url();?>/public/assets/pdf_sign/viewer/viewer.css">
    <link rel="resource" type="application/l10n" href="<?= base_url();?>/public/assets/pdf_sign/viewer/locale/locale.properties">
    <script src="<?= base_url();?>/public/assets/pdf_sign/viewer/build/pdf.js"></script>
  	<script src="<?= base_url();?>/public/assets/pdf_sign/viewer/viewer.js"></script>
	<?php } ?>
    <?php if($router->controllerName() == '\App\Controllers\Erp\Resignation' && $router->methodName() == 'view_file'){?>
    <?php
		$segment_id = $request->uri->getSegment(3);
		$document_id = udecode($segment_id);
		$result = $ResignationsModel->where('resignation_id', $document_id)->first();	
	?>	
    <script type="text/javascript">var base_url = '<?= base_url(''); ?>';</script>
    <script type="text/javascript">var file_url = '<?= base_url();?>/public/uploads/pdf_files/resignation/<?= $result['document_file'];?>';</script>  
    <link rel="stylesheet" href="<?= base_url();?>/public/assets/pdf_sign/viewer/viewer.css">
    <link rel="resource" type="application/l10n" href="<?= base_url();?>/public/assets/pdf_sign/viewer/locale/locale.properties">
    <script src="<?= base_url();?>/public/assets/pdf_sign/viewer/build/pdf.js"></script>
  	<script src="<?= base_url();?>/public/assets/pdf_sign/viewer/viewer.js"></script>
	<?php } ?>
    <?php if($router->controllerName() == '\App\Controllers\Erp\Termination' && $router->methodName() == 'view_file'){?>
    <?php
		$segment_id = $request->uri->getSegment(3);
		$document_id = udecode($segment_id);
		$result = $TerminationModel->where('termination_id', $document_id)->first();	
	?>	
    <script type="text/javascript">var base_url = '<?= base_url(''); ?>';</script>
    <script type="text/javascript">var file_url = '<?= base_url();?>/public/uploads/pdf_files/termination/<?= $result['document_file'];?>';</script>  
    <link rel="stylesheet" href="<?= base_url();?>/public/assets/pdf_sign/viewer/viewer.css">
    <link rel="resource" type="application/l10n" href="<?= base_url();?>/public/assets/pdf_sign/viewer/locale/locale.properties">
    <script src="<?= base_url();?>/public/assets/pdf_sign/viewer/build/pdf.js"></script>
  	<script src="<?= base_url();?>/public/assets/pdf_sign/viewer/viewer.js"></script>
	<?php } ?>
	<?php if($router->controllerName() == '\App\Controllers\Erp\Dashboard'){?>
    <script src="<?= base_url();?>/public/assets/flip_book/public/js/html2canvas.min.js"></script>
	<script src="<?= base_url();?>/public/assets/flip_book/public/js/three.min.js"></script>
    <script src="<?= base_url();?>/public/assets/flip_book/public/js/pdf.min.js"></script>
    
    <script src="<?= base_url();?>/public/assets/flip_book/public/js/3dflipbook.min.js"></script>
    
    
	<?php } ?>
    <?php if($router->controllerName() == '\App\Controllers\Erp\Forms' && ($router->methodName() == 'create_form' || $router->methodName() == 'edit_form')){?>
    <?php $form_types = array(1=>'Text Box',2=>'List Box',3=>'Check Box',4=>'Date',5=>'Text Area (Large Text Field)',6=>'Time',7=>'Radio Box',8=>'Data | List of Departments',9=>'Data | List of Employees',10=>'Data | List of Projects',11=>'Data | List of Designations',12=>'Data | List of Job Posts');?>
    <script type="text/javascript">
	$(document).ready(function(){
		$('#add-invoice-item').click(function () {
			var invoice_items = '<div class="row item-row">'
						+'<hr>'
						+'<div class="form-group mb-1 col-sm-12 col-md-3">'
						+'<label for="item_name"><?= lang('Main.xin_field_type');?></label>'
						+'<br>'
						+'<select class="form-control form-control-sm" name="field_type[]" data-placeholder="<?= lang('Main.xin_field_type');?>">'<?php foreach($form_types as $type_key=>$type_value) {?>+'<option value="<?= $type_key?>"><?= $type_value ?></option>'<?php } ?>+'</select>'
						+'</div>'
						+'<div class="form-group mb-1 col-sm-12 col-md-2">'
						+'<label for="qty_hrs" class="cursor-pointer"><?= lang('Main.xin_field_name');?></label>'
						+'<br>'
						+'<div class="input-group input-group-sm">'
						+'<input type="text" class="form-control form-control-sm increases" name="field_name[]" value="">'
						+'</div>'
						+'</div>'
						+'<div class="form-group mb-1 col-sm-12 col-md-4">'
						+'<label for="qty_hrs" class="cursor-pointer"><?= lang('Main.xin_field_options_list');?></label>'
						+'<br>'
						+'<input type="text" class="form-control form-control-sm" name="field_options[]" value="">'
						+'</div>'
						+'<div class="skin skin-flat form-group mb-1 col-sm-12 col-md-1">'
						+'<label for="unit_price"><?= lang('Main.xin_field_mandatory');?></label>'
						+'<br>'
						+'<select class="form-control form-control-sm" name="field_mandatory[]">'+'<option value="0"><?= lang('Main.xin_no');?></option>'+'<option value="1"><?= lang('Main.xin_yes');?></option>'+'</select>'
						+'</div>'
						+'<div class="form-group mb-1 col-sm-12 col-md-1">'
						+'<label for="profession"><?= lang('Main.xin_field_order');?></label>'
						+'<input type="text" class="form-control form-control-sm sub-total-item" name="field_order[]" value="" size="2"/>'
						+'</div>'
						+'<div class="form-group col-sm-12 col-md-1 text-xs-center">'
						+'<label for="profession">&nbsp;</label><br><button type="button" class="btn icon-btn btn-sm btn-outline-danger waves-effect waves-light remove-invoice-item" data-repeater-delete=""> <span class="fa fa-trash"></span></button>'
						+'</div>'
						+'</div>'
	
			$('#item-list').append(invoice_items).fadeIn(500);
	
		});
	});	
	
	</script>
    <?php } ?>
    <?php if($user_info['user_type']=='super_user'){?>
	<script>
    feather.replace();
    var headercolor = document.querySelectorAll(".header-color > a");
    for (var h = 0; h < headercolor.length; h++) {
        var c = headercolor[h];

        c.addEventListener('click', function (event) {
            var targetElement = event.target;
            if (targetElement.tagName == "SPAN") {
                targetElement = targetElement.parentNode;
            }
            var temp = targetElement.getAttribute('data-value');
            if (temp == "bg-default") {
                removeClassByPrefix(document.querySelector(".pc-header:not(.pc-mob-header)"), 'bg-');
            } else {
                removeClassByPrefix(document.querySelector(".pc-header:not(.pc-mob-header)"), 'bg-');
                document.querySelector(".pc-header:not(.pc-mob-header)").classList.add(temp);
				removeClassByPrefix(document.querySelector(".m-header"), 'bg-');
				document.querySelector(".m-header").classList.add(temp);
				$('.header_options').val(temp);
            }
        });
    }
    function removeClassByPrefix(node, prefix) {
        for (let i = 0; i < node.classList.length; i++) {
            let value = node.classList[i];
            if (value.startsWith(prefix)) {
                node.classList.remove(value);
            }
        }
    }
</script>
<?php } ?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery( ".mark-as-read" ).click(function() {
		jQuery.get(main_url+"notifications/mark_all_as_read", function(data, status){
			toastr.info(data);
			setTimeout(function(){
				window.location = '';
			}, 2000);
		});
	});
});
</script>
<?php
if($user_info['user_type'] == 'company' || $user_info['user_type'] == 'staff'){
?>
<script type="text/javascript">
function hrefreshUsers() {
	$.ajax({
		url: main_url+"chat/refresh_chat_count_notify",
		type: 'GET',
		dataType: 'json',
		success: function(JSON) {
			<?php if($router->controllerName() != '\App\Controllers\Erp\Chat'){?>
			if(JSON.fcount > 0 && JSON.fmessage_date > JSON.current){
				toastr.options.closeButton = true;
				toastr.options.progressBar = true;
				toastr.options.timeOut = 5000;
				toastr.options.hideDuration = 10000;
				toastr.options.preventDuplicates = true;
				toastr.options.positionClass = "toast-bottom-right";
				toastr.options.onclick = function () {
					window.location = '<?= site_url('erp/inbox');?>/'+JSON.to_user;
				};
				toastr.info(JSON.message,JSON.full_name);
			}
		    setTimeout(hrefreshUsers, 3000);
			<?php } ?>					
		},
		error: function() {
		 
		}
	  });
}
function threfreshUsers() {
	$.ajax({
		url: main_url+"chat/refresh_chat_count",
		type: 'GET',
		dataType: 'html',
		success: function(data) {
		prev_chat = $(".header-chat-inotify").html();
		jQuery('.header-chat-inotify').html(data);
		curr_chat = $(".header-chat-inotify").html();
		setTimeout(threfreshUsers, 3000);					
		},
		error: function() {
		 
		}
	  });
}
$(document).ready(function(){
	setTimeout(threfreshUsers, 2000);
	setTimeout(hrefreshUsers, 3000);
	
});
</script>
<?php  } ?>
