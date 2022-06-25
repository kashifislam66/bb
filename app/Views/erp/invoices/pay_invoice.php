<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\InvoicesModel;
use App\Models\ConstantsModel;
use App\Models\AccountsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();	
$AccountsModel = new AccountsModel();	
$InvoicesModel = new InvoicesModel();			
$ConstantsModel = new ConstantsModel();
$get_animate = '';
$xin_com_system = erp_company_settings();
if($request->getGet('data') === 'invoice_pay' && $request->getGet('field_id')){
$invoice_id = udecode($field_id);
$result = $InvoicesModel->where('invoice_id', $invoice_id)->first();
$payment_method = $ConstantsModel->where('type','payment_method')->orderBy('constants_id', 'ASC')->findAll();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$accounts = $AccountsModel->where('company_id', $user_info['company_id'])->orderBy('account_id', 'ASC')->findAll();
	$tax_types = $ConstantsModel->where('company_id', $user_info['company_id'])->where('type','tax_type')->findAll();
} else {
	$accounts = $AccountsModel->where('company_id', $usession['sup_user_id'])->orderBy('account_id', 'ASC')->findAll();
	$tax_types = $ConstantsModel->where('company_id', $usession['sup_user_id'])->where('type','tax_type')->findAll();
}
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Invoices.xin_pay_invoice');?>
 </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'pay_invoice_record', 'id' => 'pay_invoice_record', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?= form_open('erp/invoices/pay_invoice_record', $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
          <label for="payment_method">
            <?= lang('Main.xin_payment_method');?>
          </label>
          <select name="payment_method" class="form-control" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_payment_method');?>">
            <option value=""></option>
            <?php foreach($payment_method as $ipayment_method) {?>
            <option value="<?php echo $ipayment_method['constants_id'];?>"> <?php echo $ipayment_method['category_name'];?></option>
            <?php } ?>
          </select>
        </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="award_date">
          <?= lang('Users.xin_payment_date');?>
        </label>
        <div class="input-group">
          <input class="form-control payment_date" placeholder="<?= lang('Users.xin_payment_date');?>" name="payment_date" type="text">
          <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
          <label for="account_id">
            <?= lang('Main.xin_deposit_to');?> <span class="text-danger">*</span>
          </label>
          <select name="deposit_to" class="form-control" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_deposit_to');?>">
            <option value=""></option>
            <?php foreach($accounts as $iaccounts) {?>
            <option value="<?php echo $iaccounts['account_id'];?>"><?php echo $iaccounts['account_name'];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="account_id">
            <?= lang('Dashboard.xin_invoice_tax_type');?> <span class="text-danger">*</span>
          </label>
          <select name="with_holding_tax" class="form-control tax_type" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.xin_invoice_tax_type');?>">
            <option value=""></option>
            <?php foreach($tax_types as $_tax){?>
			<?php
            if($_tax['field_two']=='percentage') {
                $_tax_type = $_tax['field_one'].'%';
            } else {
                $_tax_type = number_to_currency($_tax['field_one'], $xin_com_system['default_currency'],null,2);
            }
            ?>
            <option tax-type="<?php echo $_tax['field_two'];?>" tax-rate="<?php echo $_tax['field_one'];?>" value="<?php echo $_tax['constants_id'];?>"><?php echo $_tax['category_name'];?> (<?php echo $_tax_type;?>)</option>
            <?php } ?>
          </select>
        </div>
      </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="status"><?php echo lang('Main.dashboard_xin_status');?></label>
        <select class="form-control" name="status" data-plugin="select_hrm" data-placeholder="<?php echo lang('Main.dashboard_xin_status');?>">
          <option value=""></option>
          <option value="1"><?php echo lang('Invoices.xin_paid');?></option>
        </select>
      </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="pay_full" name="pay_full" value="1" checked="checked">
            <label class="custom-control-label" for="enable_tax"><?= lang('Main.xin_pay_full_amount');?></label>
        </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="amount">
            <?= lang('Main.xin_amount');?> <span class="text-danger">*</span>
          </label>
          <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text"><?= $xin_com_system['default_currency'];?></span></div>
            <input class="form-control invoice_amount" placeholder="<?= lang('Main.xin_amount');?>" name="total_amount" type="text" value="<?= $result['grand_total'];?>">
          </div>
        </div>
      </div>
  </div>
</div>
 <input class="tax_rate" name="holding_tax_rate" type="hidden" value="">
<div class="modal-footer">
  <button type="button" class="btn btn-light" data-dismiss="modal">
  <?= lang('Main.xin_close');?>
  </button>
  <button type="submit" class="btn btn-success">
  <?= lang('Invoices.xin_pay_invoice');?>
  </button>
</div>
<?= form_close(); ?>
<script type="text/javascript">
$(document).ready(function(){ 

	var grand_total = '<?= $result['grand_total'];?>';
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' }); 	 
	Ladda.bind('button[type=submit]');
	// Payment Date
	$('.payment_date').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		clearButton: false,
		switchOnClick: true,
		format: 'YYYY-MM-DD'
	});
	// taxtype
	jQuery(document).on('change click','.tax_type',function() {
	 var qty = 0;
	 var unit_price = 0;
	 var tax_rate = 0;
	 //var sub_total = $('.items-sub-total').val();
	 var element = $(".tax_type option:selected");
	 var tax_type = element.attr("tax-type");
	 if(tax_type == 'fixed'){
		var perc_tax = element.attr("tax-rate");
		var trfloat = parseFloat(perc_tax);
	 } else {
		var st_tax = element.attr("tax-rate");
		var perc_tax = grand_total / 100 * st_tax;
		var trfloat = parseFloat(perc_tax);
	 }
	 var totalamount = parseFloat(perc_tax) + parseFloat(grand_total);
	 var ftax = parseFloat(totalamount).toFixed(2);
	 var tax_rate = parseFloat(perc_tax);
	 $('.invoice_amount').val(ftax);
	 $('.tax_rate').val(trfloat);
});
	/* Edit data */
	$("#pay_invoice_record").submit(function(e){
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
					toastr.success(JSON.result);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					$('.view-modal-data').modal('toggle');
					Ladda.stopAll();
					window.location = '';
				}
			}
		});
	});
});	
  </script>
<?php }
?>
