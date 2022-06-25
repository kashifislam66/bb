<?php
use App\Models\SystemModel;
use App\Models\UsersModel;
use App\Models\InvoicesModel;
use App\Models\ProjectsModel;
use App\Models\ConstantsModel;
use App\Models\InvoiceitemsModel;


$request = \Config\Services::request();
$SystemModel = new SystemModel();
$UsersModel = new UsersModel();
$InvoicesModel = new InvoicesModel();
$ProjectsModel = new ProjectsModel();
$ConstantsModel = new ConstantsModel();
$InvoiceitemsModel = new InvoiceitemsModel();

/* Company Details view
*/		
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$segment_id = $request->uri->getSegment(3);
/////
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$invoice_id = udecode($segment_id);
$xin_system = erp_company_settings();
$inv_company_info = $UsersModel->where('user_id', $xin_system['company_id'])->first();

$result = $InvoicesModel->where('invoice_id', $invoice_id)->first();
$company_info = $UsersModel->where('user_id', $result['client_id'])->where('user_type', 'customer')->first();
if($company_info){
	$company_contact = $company_info['first_name'].' '.$company_info['last_name'];
	$address_1 = $company_info['address_1'].' '.$company_info['address_2'];
	$cemail = $company_info['email'];
	$ccontact_number = $company_info['contact_number'];
	$csz = $company_info['city'].', '.$company_info['state'].' '.$company_info['zipcode'];
} else {
	$csz = '--';
	$cemail = '--';
	$address_1 = '--';
	$ccontact_number = '--';
	$company_contact = '--';
}
$invoice_items = $InvoiceitemsModel->where('invoice_id', $invoice_id)->findAll();
$ci_erp_settings = $SystemModel->where('setting_id', 1)->first();
// get status
if($result['status'] == 0){
	$status = lang('Invoices.xin_unpaid');
} else if($result['status'] == 1) {
	$status = lang('Invoices.xin_paid');
} else {
	$status = lang('Projects.xin_project_cancelled');
}
//payment method
$_payment_method = $ConstantsModel->where('type','payment_method')->where('constants_id', $result['payment_method'])->first();
if($_payment_method){
	$ipayment_method = $_payment_method['category_name'];
} else {
	$ipayment_method = '--';
}
//get tax
$_tax_type = $ConstantsModel->where('type','tax_type')->where('constants_id', $result['tax_type'])->first();
if($_tax_type){
	if($_tax_type['field_two']=='percentage') {
		$tax_type_field = $_tax_type['field_one'].'%';
	} else {
		$tax_type_field = number_to_currency($_tax_type['field_one'], $xin_system['default_currency'],null,2);
	}
} else {
	$tax_type_field = 0;
}
if($result['discount_type'] == 1) {
	$discount_figure = number_to_currency($result['discount_figure'],$xin_system['default_currency'],null,2);
} else {
	$discount_figure = $result['discount_figure'].'%';
}
// get project
$get_project = $ProjectsModel->where('project_id',$result['project_id'])->first();
if($get_project) {
	$project_title = $get_project['title'];
} else {
	$project_title = '--';
}
?>
<div class="row justify-content-md-center print-invoice"> 
  <!-- [ basic-alert ] start -->
  <div class="col-md-10"> 
    <!-- [ Invoice ] start -->
    <div class="container">
      <div>
        <div class="card" id="printTable">
          <div class="card-header">
            <h5>
              <?= lang('Invoices.xin_view_invoice').' #'.$result['invoice_number'];?>
            </h5>
            <div class="card-header-right"> <a href="<?= site_url('erp/print-invoice/').$segment_id;?>" target="_blank" class="collapsed btn btn-sm waves-effect waves-light btn-success m-0">
              <?= lang('Invoices.xin_print_download_invoice');?>
              </a>
              <?php if($user_info['user_type'] != 'customer'){ ?>
				  <?php if($result['status'] == 0) { ?>
					  <?php if(in_array('invoice4',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
                      <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-invoice_id="<?php echo $segment_id; ?>" data-target=".view-modal-data">
                      <?= lang('Invoices.xin_pay_invoice');?>
                      </button>
                      <?php } ?>
                      <?php if(in_array('invoice4',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
                      <a href="<?= site_url('erp/edit-invoice/').$segment_id;?>" class="collapsed btn btn-sm waves-effect waves-light btn-primary m-0">
                      <?= lang('Main.xin_edit');?>
                      </a>
                      <?php } ?>
                  <?php } ?>
              <?php } ?>
            </div>
          </div>
          <div class="card-body">
            <div class="row invoive-info1 d-print-inline-flex">
              <div class="col-sm-6 invoice-client-info">
                <h6 class="m-b-5">
                  <strong><?= $inv_company_info['company_name'];?></strong>
                </h6>
                <p class="m-0 m-t-10">
                  <?= $inv_company_info['address_1'];?>
                  <br>
                  <?= $inv_company_info['address_2'];?>
                </p>
                <p class="m-0">
                  <?= $inv_company_info['contact_number'];?>
                </p>
                <p><a class="text-secondary" href="mailto:<?= $inv_company_info['email'];?>" target="_top">
                  <?= $inv_company_info['email'];?>
                  </a></p>
              </div>
              
              <div class="col-sm-6 invoice-client-info">
               
                <h6 class="m-b-5">
                  <strong><?= $company_contact;?></strong>
                </h6>
                <p class="m-0 m-t-10">
                  <?= $address_1;?>
                  <br>
                  <?= $csz;?>
                </p>
                <p class="m-0">
                  <?= $ccontact_number;?>
                </p>
                <p><a class="text-secondary" href="mailto:<?= $cemail;?>" target="_top">
                  <?= $cemail;?>
                  </a></p>
              </div>
            </div>
            <div class="row invoive-info1 d-print-inline-flex m-b-10">
              <div class="col-sm-6 invoice-client-info">
              <img class="img-fluid" width="171" height="30" src="<?= base_url();?>/public/uploads/logo/other/<?= $ci_erp_settings['other_logo'];?>" alt="<?= $inv_company_info['company_name'];?>">
              </div>
              <div class="col-sm-6 invoice-client-info">
              <strong><?= lang('Main.xin_e_details_date');?></strong>: <?= $result['created_at'];?>
              </div>
            </div>  
            <div class="row invoive-info d-print-inline-flex">
              <div class="col align-self-start">
                    &nbsp;
                </div>
                <div class="col align-self-center">
                    <strong><?= lang('Projects.xin_project');?>: <?= $project_title;?></strong>
                </div>
                <div class="col align-self-end">
                    &nbsp;
                </div>
            </div>
            <div class="row invoive-info d-print-inline-flex">
              	<div class="col-sm-6 invoice-client-info">
                    <strong><?= lang('Main.xin_bank_account');?>:</strong> <?= $xin_system['bank_account'];?> <br />
                    <strong><?= lang('Main.xin_vat_number');?>:</strong> <?= $xin_system['vat_number'];?>
                </div>
               
                <div class="col-sm-6 invoice-client-info">
                    <strong><?= lang('Invoices.xin_invoice_number');?></strong>: <?= $result['invoice_number'];?><br />
                    <strong><?= lang('Main.dashboard_xin_status');?></strong>:  <?= $status;?>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-xs">
                        <thead>
                            <tr>
                                <th><?= lang('Main.xin_description');?></th>
                                <th><?= lang('Invoices.xin_title_increases');?></th>
                                <th><?= lang('Invoices.xin_title_days');?></th>
                                <th><?= lang('Invoices.xin_title_qty_hrs');?></th>
                                <th><?= lang('Invoices.xin_title_unit_price');?></th>
                                <th><?= lang('Main.xin_total');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($invoice_items as $item){?>
                              <tr>
                                <td><?= $item['item_name'];?></td>
                                <td><?= $item['qty_increases'];?>%</td>
                                <td><?= $item['qty_days'];?></td>
                                <td><?= $item['item_qty'];?></td>
                                <td><?= number_to_currency($item['item_unit_price'],$xin_system['default_currency'],null,2);?></td>
                                <td><?= number_to_currency($item['item_sub_total'],$xin_system['default_currency'],null,2);?></td>
                              </tr>
                              <?php } ?>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
              <?php
				$idata = site_url('erp/invoice-detail/').$segment_id;
				$urlRelativeFilePath = 'https://chart.googleapis.com/chart?cht=qr&chs=100x100&chl='.$idata.'';
				echo '<img src="'.$urlRelativeFilePath.'" />';	
				?>
              </div>
              <div class="col-sm-8">
                <table class="table table-responsive invoice-table invoice-total">
                  <tbody>
                    <tr>
                      <th><?= lang('Main.xin_total_exlusive_btw');?>
                        :</th>
                      <td><?= number_to_currency($result['sub_total_amount'],$xin_system['default_currency'],null,2);?></td>
                    </tr>
                    <tr>
                      <th>B.T.W.&nbsp;(<?= $tax_type_field;?>) :</th>
                      <td><?= number_to_currency($result['total_tax'],$xin_system['default_currency'],null,2);?></td>
                    </tr>
                    <tr>
                      <th><?= lang('Invoices.xin_discount');?>&nbsp;(<?= $discount_figure;?>) :</th>
                      <td><?= number_to_currency($result['total_discount'],$xin_system['default_currency'],null,2);?></td>
                    </tr>
                    <tr class="text-info">
                      <td><hr />
                        <h5 class="text-primary m-r-10">
                          <?= lang('Main.xin_total_amount_tobe_paid');?>
                          :</h5></td>
                      <td><hr />
                        <h5 class="text-primary">
                          <?= number_to_currency($result['grand_total'],$xin_system['default_currency'],null,2);?>
                        </h5></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <h6>
                  <?= lang('Invoices.xin_terms_condition');?>
                  :</h6>
                <p>
                  <?= $xin_system['invoice_terms_condition'];?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Invoice ] end --> 
  </div>
  <!-- [ basic-alert ] end --> 
</div>
<style type="text/css">
.invoice-total.table {
    background: #fff !important;
}
</style>