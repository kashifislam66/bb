<?php
use App\Models\ConstantsModel;
use App\Models\CmspageModel;
use App\Models\CurrenciesModel;
$CmspageModel = new CmspageModel();
$ConstantsModel = new ConstantsModel();
$CurrenciesModel = new CurrenciesModel();
$request = \Config\Services::request();

if($request->getGet('data') === 'currency_type' && $request->getGet('type') === 'currency_type' && $field_id){
$ifield_id = udecode($field_id);
$result = $CurrenciesModel->where('currency_id', $ifield_id)->first();
?>
<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Main.xin_edit_currency_type');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'ed_currency_type_info', 'id' => 'ed_currency_type_info', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open('erp/settings/update_currency_type', $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label">
            <?= lang('Main.xin_country');?>
            <span class="text-danger">*</span> </label>
          <input class="form-control" placeholder="<?= lang('Main.xin_country');?>" name="country" type="text" value="<?= $result['country_name'];?>">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label">
            <?= lang('Main.xin_currency_name');?>
            <span class="text-danger">*</span> </label>
          <input class="form-control" placeholder="<?= lang('Main.xin_currency_name');?>" name="currency_name" type="text" value="<?= $result['currency_name'];?>">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label">
            <?= lang('Main.xin_currency_code');?>
            <span class="text-danger">*</span> </label>
          <input class="form-control" placeholder="<?= lang('Main.xin_currency_code');?>" name="currency_code" type="text" value="<?= $result['currency_code'];?>">
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
$(document).ready(function(){
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
	Ladda.bind('button[type=submit]');
	/* Edit data */
	$("#ed_currency_type_info").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=46&type=edit_record&data=ed_currency_type_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					$('.edit-modal-data').modal('toggle');
					// On page load: datatable
					var xin_table_currencies = $('#xin_table_currencies').dataTable({
						"bDestroy": true,
						//"bFilter": false,
						"iDisplayLength": 25,
						"aLengthMenu": [[25, 50, 75, 100, -1], [25, 50, 75, 100, "All"]],
						"ajax": {
							url : "<?php echo site_url("erp/settings/currency_list") ?>",
							type : 'GET'
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
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}			
					});
					xin_table_currencies.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();			
				}
			}
		});
	});
});	
</script>
<?php } else if($request->getGet('data') === 'ed_subscription_tax' && $request->getGet('field_id')){
$category_id = udecode($field_id);
$result = $ConstantsModel->where('constants_id', $category_id)->where('type','subscription_tax')->first();
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Invoices.xin_edit_tax_type');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'update_subscription_tax', 'id' => 'update_subscription_tax', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?= form_open('erp/types/update_subscription_tax', $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="name">
          <?= lang('Invoices.xin_tax_name');?>
          <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" name="name" placeholder="<?= lang('Invoices.xin_tax_name');?>" value="<?= $result['category_name'];?>">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="name">
          <?= lang('Invoices.xin_tax_rate');?>
          <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" name="fieldone" placeholder="<?= lang('Invoices.xin_tax_rate');?>" value="<?= $result['field_one'];?>">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="name">
          <?= lang('Dashboard.xin_invoice_tax_type');?>
          <span class="text-danger">*</span> </label>
        <select class="form-control" name="fieldtwo" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.xin_invoice_tax_type');?>">
          <option value="fixed" <?php if($result['field_two']=='fixed'):?> selected="selected"<?php endif;?>>
          <?= lang('Employees.xin_title_tax_fixed');?>
          </option>
          <option value="percentage" <?php if($result['field_two']=='percentage'):?> selected="selected"<?php endif;?>>
          <?= lang('Employees.xin_title_tax_percent');?>
          </option>
        </select>
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
<?= form_close(); ?>
<script type="text/javascript">
$(document).ready(function(){ 

	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' }); 	 
	Ladda.bind('button[type=submit]');

	/* Edit data */
	$("#update_subscription_tax").submit(function(e){
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');		
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=1&type=edit_record&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					var xin_table = $('#xin_table_subscription_tax').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?= site_url("erp/types/subscription_tax_list") ?>",
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					$('.edit-modal-data').modal('toggle');
					Ladda.stopAll();
				}
			}
		});
	});
});	
  </script>
<?php } else if($request->getGet('data') === 'ed_company_type' && $request->getGet('type') === 'ed_company_type' && $field_id){
$ifield_id = udecode($field_id);
$row = $ConstantsModel->where('constants_id', $ifield_id)->where('type','company_type')->first();
?>
<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Main.xin_edit_company_type');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'ed_company_type_info', 'id' => 'ed_company_type_info', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open('erp/settings/update_company_type', $attributes, $hidden);?>
<div class="modal-body">
  <div class="form-group">
    <label for="name" class="form-control-label">
      <?= lang('Main.xin_company_type');?>
      <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="name" placeholder="<?= lang('Main.xin_company_type');?>" value="<?php echo $row['category_name'];?>">
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
$(document).ready(function(){
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
	Ladda.bind('button[type=submit]');
	/* Edit data */
	$("#ed_company_type_info").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=46&type=edit_record&data=ed_company_type_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					$('.edit-modal-data').modal('toggle');
					// On page load: datatable
					var xin_table_company_type = $('#xin_table_company_type').dataTable({
						"bDestroy": true,
						//"bFilter": false,
						//"iDisplayLength": 10,
						"aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, "All"]],
						"ajax": {
							url : "<?php echo site_url("erp/settings/company_type_list") ?>",
							type : 'GET'
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
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}			
					});
					xin_table_company_type.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();			
				}
			}
		});
	});
});	
</script>
<?php } else if($request->getGet('data') === 'ed_religion' && $request->getGet('type') === 'ed_religion' && $field_id){
$ifield_id = udecode($field_id);
$row = $ConstantsModel->where('constants_id', $ifield_id)->where('type','religion')->first();
?>
<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Main.xin_edit_religion');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'ed_religion_info', 'id' => 'ed_religion_info', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open('erp/settings/update_religion', $attributes, $hidden);?>
<div class="modal-body">
  <div class="form-group">
    <label for="name" class="form-control-label">
      <?= lang('Main.xin_ethnicity_type_title');?>
      <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="religion" placeholder="<?= lang('Main.xin_ethnicity_type_title');?>" value="<?php echo $row['category_name'];?>">
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
$(document).ready(function(){
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
	Ladda.bind('button[type=submit]');
	/* Edit data */
	$("#ed_religion_info").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=46&type=edit_record&data=ed_religion_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					$('.edit-modal-data').modal('toggle');
					// On page load: datatable
					var xin_table_religion = $('#xin_table_religion').dataTable({
						"bDestroy": true,
						//"bFilter": false,
						//"iDisplayLength": 10,
						"aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, "All"]],
						"ajax": {
							url : "<?php echo site_url("erp/settings/religion_list") ?>",
							type : 'GET'
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
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}			
					});
					xin_table_religion.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();			
				}
			}
		});
	});
});	
</script>
<?php } else if($request->getGet('data') === 'ed_cms_pages' && $request->getGet('type') === 'ed_cms_pages' && $field_id){
$ifield_id = udecode($field_id);
$row = $CmspageModel->where('page_id', $ifield_id)->first();
?>
<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Main.xin_cms_page_update');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'ed_page_info', 'id' => 'ed_page_info', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open('erp/settings/update_page', $attributes, $hidden);?>
<div class="modal-body">
  <div class="form-group">
    <label for="name" class="form-control-label">
      <?= lang('Main.xin_cms_page_name');?>
      <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="page_name" placeholder="<?= lang('Main.xin_cms_page_name');?>" value="<?php echo $row['page_name'];?>">
  </div>
  <div class="form-group">
    <label for="message">
      <?= lang('Main.xin_cms_page_content');?>
    </label>
    <textarea class="form-control meditor" placeholder="<?= lang('Main.xin_cms_page_content');?>" name="page_description" rows="10" style="height:350px;">
      <?php echo $row['page_description'];?></textarea>
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
$(document).ready(function(){
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
	Ladda.bind('button[type=submit]');
	$(".meditor").kendoEditor({
		
		tools: [
			"bold",
			"italic",
			"underline",
			"justifyLeft",
			"justifyCenter",
			"justifyRight",
			"insertUnorderedList",
			"createLink",
			"unlink",
			"tableWizard",
			"createTable",
			"addRowAbove",
			"addRowBelow",
			"addColumnLeft",
			"addColumnRight",
			"deleteRow",
			"deleteColumn",
			"mergeCellsHorizontally",
			"mergeCellsVertically",
			"splitCellHorizontally",
			"splitCellVertically",
			"tableAlignLeft",
			"tableAlignCenter",
			"tableAlignRight",
			"formatting",
			{
				name: "fontName",
				items: [
					{ text: "Andale Mono", value: "Andale Mono" },
					{ text: "Arial", value: "Arial" },
					{ text: "Arial Black", value: "Arial Black" },
					{ text: "Book Antiqua", value: "Book Antiqua" },
					{ text: "Comic Sans MS", value: "Comic Sans MS" },
					{ text: "Courier New", value: "Courier New" },
					{ text: "Georgia", value: "Georgia" },
					{ text: "Helvetica", value: "Helvetica" },
					{ text: "Impact", value: "Impact" },
					{ text: "Symbol", value: "Symbol" },
					{ text: "Tahoma", value: "Tahoma" },
					{ text: "Terminal", value: "Terminal" },
					{ text: "Times New Roman", value: "Times New Roman" },
					{ text: "Trebuchet MS", value: "Trebuchet MS" },
					{ text: "Verdana", value: "Verdana" },
				]
			},
			"fontSize",
			"foreColor",
			"backColor",
		]
	});
	/* Edit data */
	$("#ed_page_info").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=46&type=edit_record&data=ed_page_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					$('.edit-modal-data').modal('toggle');
					// On page load: datatable
					var xin_table_cms_pages2 = $('#xin_table_cms_pages').dataTable({
						"bDestroy": true,
						//"bFilter": false,
						//"iDisplayLength": 10,
						"aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, "All"]],
						"ajax": {
							url : "<?php echo site_url("erp/settings/cms_pages_list") ?>",
							type : 'GET'
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
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}			
					});
					xin_table_cms_pages2.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();			
				}
			}
		});
	});
});	
</script>
<?php }?>
