<?php
use App\Models\ConstantsModel;
use App\Models\CountryModel;
use App\Models\MembershipModel;
use App\Models\CompanymembershipModel;
use App\Models\MainModel;
use App\Models\UsersModel;
use App\Models\SystemModel;

$ConstantsModel = new ConstantsModel();
$CountryModel = new CountryModel();
$MembershipModel = new MembershipModel();
$MainModel = new MainModel();
$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$CompanymembershipModel = new CompanymembershipModel();
/* Key Subscription view
*/		
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$xin_system = erp_company_settings();
$field_id = $request->uri->getSegment(3);
$membership_id = udecode($field_id);
$xin_super_system = $SystemModel->where('setting_id', 1)->first();

$company_types = $ConstantsModel->where('type','company_type')->orderBy('constants_id', 'ASC')->findAll();
$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();

$result = $UsersModel->where('user_id', $usession['sup_user_id'])->where('user_type','company')->first();
$membership = $MembershipModel->where('membership_id', $membership_id)->first();
$subscription_tax = $ConstantsModel->where('type','subscription_tax')->where('constants_id', $xin_super_system['tax_type'])->first();
// tax
if($xin_super_system['enable_tax'] == 1):
	if($subscription_tax['field_two']=='fixed'){
		$tax_rate = $subscription_tax['field_one'];
		$membership_price = currency_converter($membership['price']);
		$final_subs_price = $membership_price  + $tax_rate;
	} else {
		$p_rate = $subscription_tax['field_one'];
		$membership_price = currency_converter($membership['price']);
		$tax_rate = $membership_price / 100 * $p_rate;
		$final_subs_price = $membership_price  + $tax_rate;
	}
else:
	$tax_rate = 0;
	$membership_price = currency_converter($membership['price']);
	$converted = currency_converter($membership['price']);
	$final_subs_price = currency_converter($membership['price']);
endif;
$converted = currency_converter($membership['price']);
$fprice = number_format($final_subs_price,2,".","");
// Razorpay Information >>> company info
$contact_name = $result['first_name'].' '.$result['last_name'];
$company_name = $result['company_name'];
$company_email = $result['email'];
$company_number = $result['contact_number'];

$description        = $membership['description'];
$txnid              = date("YmdHis");     
$key_id             = $xin_super_system['razorpay_keyid'];
$currency_code      = 'INR';            
$total              = ($fprice* 100); // 100 = 1 indian rupees
$amount             = $fprice;
$merchant_order_id  = $membership['membership_type'].'-'.date("YmdHis");
$card_holder_name   = $contact_name;
$email              = $company_email;
$phone              = $company_number;
$name               = $company_name;
?>  
<div class="row">
    <div class="col-md-8">
        <div class="tab-content">
            <div class="tab-pane show active" id="payment-information">
                <div class="card">
                    <div class="card mb-0 shadow-none">
                        <div class="card-header">
                            <h5 class="mb-2"><?= lang('Membership.xin_payment_selection');?></h5>
                            <p class="text-muted mb-0"><?= lang('Membership.xin_one_payment_selection');?></p>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                       <?php if($xin_super_system['paypal_active'] == 'yes'):?>
                        <div class="card mb-0 shadow-none border-top">
                            <div class="card-header" id="headingOne">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="BillingPaypal" name="billingOptions" class="custom-control-input" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" checked>
                                    <label class="custom-control-label font-weight-bold" for="BillingPaypal"><?= lang('Membership.xin_pay_with_paypal');?></label>
                                </div>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <?php $attributes = array('name' => 'paypal_process', 'id' => 'paypal_process', 'autocomplete' => 'off');?>
								<?php $hidden = array('paypal_info' => uencode($usession['sup_user_id']), 'token' => $field_id);?>
                                <?= form_open('erp/pay/paypal_process', $attributes, $hidden);?> 
                                <div class="card-body bg-light">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p class="mb-0 pl-3 pt-1"><?= lang('Membership.xin_pay_with_paypal_text');?></p>
                                        </div>
                                        <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                            <img src="<?= base_url();?>/public/assets/images/product/paypal.png" class="hei-25" alt="payment-images">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                  <button type="submit" class="btn btn-danger text-sm-right mt-md-0 mt-2">
                                  <?= lang('Membership.xin_complete_order');?>
                                  </button>
                                </div>
                               <?= form_close(); ?> 
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if($xin_super_system['stripe_active'] == 'yes'):?>
                        <div class="card mb-0 shadow-none border-top">
                            <div class="card-header" id="headingTwo">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="BillingCard" name="billingOptions" class="custom-control-input collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <label class="custom-control-label font-weight-bold" for="BillingCard"><?= lang('Membership.xin_pay_with_stripe');?></label>
                                </div>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <?php $attributes = array('name' => 'stripe_payment', 'id' => 'stripe_payment', 'autocomplete' => 'off');?>
							<?php $hidden = array('stripe_info' => uencode($usession['sup_user_id']), 'token' => $field_id);?>
                            <?= form_open('erp/stripe/payment', $attributes, $hidden);?>                            
                                <div class="card-body bg-light">
                                <span class="payment-errors alert"></span>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p class="mb-0 pl-3 pt-1"><?= lang('Membership.xin_safe_money_transfer_options');?></p>
                                        </div>
                                        <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                            <img src="<?= base_url();?>/public/assets/images/product/card.png" height="24" alt="payment-images">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="card-number"><?= lang('Membership.xin_card_number');?></label>
                                                <input type="text" id="card_number" class="form-control bg-transparent card-number" data-toggle="input-mask" data-mask-format="0000 0000 0000 0000" placeholder="0000 0000 0000 0000" name="card_number" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="card-name-on"><?= lang('Membership.xin_name_on_card');?></label>
                                                <input type="text" name="name" id="name" class="form-control bg-transparent" placeholder="Your Full Name" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="card-expiry-date"><?= lang('Membership.xin_expiry_month');?></label>
                                                <input type="text" id="card_expiry" class="form-control bg-transparent card-expiry-month" data-toggle="input-mask" data-mask-format="00/00" placeholder="MM" name="card_exp_month" value="">
                                            </div>
                                      </div>
                                      <div class="col-md-2">      
                                            <div class="form-group">
                                                <label for="card-expiry-date"><?= lang('Membership.xin_expiry_year');?></label>
                                                <input type="text" id="card_expiry" class="form-control bg-transparent card-expiry-year" data-toggle="input-mask" data-mask-format="00/00" placeholder="YYYY" name="card_exp_year" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="card-cvv"><?= lang('Membership.xin_cvv_code');?></label>
                                                <input type="text" name="card_cvc" id="card_cvc" class="form-control bg-transparent card-cvc" data-toggle="input-mask" data-mask-format="000" placeholder="012" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                  <button id="payBtn" type="submit" class="btn btn-danger text-sm-right mt-md-0 mt-2">
                                  <?= lang('Membership.xin_complete_order');?>
                                  </button>
                                </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if($xin_super_system['razorpay_active'] == 'yes'):?>
                        <div class="card mb-0 shadow-none border-top">
                            <div class="card-header" id="headingOne">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="BillingRazorpay" name="billingOptions" class="custom-control-input" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <label class="custom-control-label font-weight-bold" for="BillingRazorpay"><?= lang('Main.xin_razorpay');?></label>
                                </div>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body bg-light">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p class="mb-0 pl-3 pt-1"><?= lang('Main.xin_razorpay_details');?></p>
                                        </div>
                                        <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                            <img src="<?= base_url();?>/public/assets/images/product/razorpay.svg" class="hei-25" alt="payment-images">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                	<?php $attributes = array('name' => 'razorpay-form', 'id' => 'razorpay-form', 'autocomplete' => 'off');?>
									<?php $hidden = array('razorpay_info' => $merchant_order_id);?>
                                    <?= form_open('erp/razorpay/callback', $attributes, $hidden);?> 
                                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                                    <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?= $merchant_order_id; ?>"/>
                                    <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?= $txnid; ?>"/>
                                    <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?= $description; ?>"/>
                                    <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?= site_url('erp/razorpay/success'); ?>"/>
                                    <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?= site_url('erp/razorpay/failed'); ?>"/>
                                    <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?= $card_holder_name; ?>"/>
                                    <input type="hidden" name="merchant_total" id="merchant_total" value="<?= $total; ?>"/>
                                    <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?= $amount; ?>"/>
                                    <input type="hidden" name="membership_id" id="membership_id" value="<?= $membership_id; ?>"/>
                                    <input type="hidden" name="subscription_id" id="subscription_id" value="<?= $membership['subscription_id']; ?>"/>
                                    <input type="hidden" name="membership_type" id="membership_type" value="<?= $membership['membership_type']; ?>"/>
                                    <input type="hidden" name="plan_duration" id="plan_duration" value="<?= $membership['plan_duration']; ?>"/>
                                    <?= form_close(); ?>
                                  	<button id="pay-btn" type="submit" onclick="razorpaySubmit(this);" class="btn btn-danger text-sm-right mt-md-0 mt-2">
                                  	<?= lang('Membership.xin_complete_order');?>
                                  	</button>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if($xin_super_system['paystack_active'] == 'yes'):?>
                        <div class="card mb-0 shadow-none border-top">
                            <div class="card-header" id="headingOne">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="BillingPaystack" name="billingOptions" class="custom-control-input" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    <label class="custom-control-label font-weight-bold" for="BillingPaystack"><?= lang('Main.xin_paystack');?></label>
                                </div>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body bg-light">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p class="mb-0 pl-3 pt-1"><?= lang('Main.xin_paystack_details');?></p>
                                        </div>
                                        <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                            <img src="<?= base_url();?>/public/assets/images/product/paystack.png" class="hei-25" alt="payment-images">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                  <form>
                                    <button type="button" onclick="payWithPaystack()" class="btn btn-danger text-sm-right mt-md-0 mt-2">
									<?= lang('Membership.xin_complete_order');?></button>
                                </form>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if($xin_super_system['paystack_active'] == 'yes'):?>
                        <div class="card mb-0 shadow-none border-top">
                            <div class="card-header" id="headingOne">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="BillingFlutterwave" name="billingOptions" class="custom-control-input" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    <label class="custom-control-label font-weight-bold" for="BillingFlutterwave"><?= lang('Main.xin_flutterwave_pay');?></label>
                                </div>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body bg-light">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p class="mb-0 pl-3 pt-1"><?= lang('Main.xin_flutterwave_details');?></p>
                                        </div>
                                        <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                            <img src="<?= base_url();?>/public/assets/images/product/flutterwave.png" class="hei-60" alt="payment-images">
                                        </div>
                                    </div>
                                    <div class="alert alert-primary mt-2" role="alert">
										<?= lang('Main.xin_flutterwave_close_option');?>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                  <?php $attributes = array('name' => 'flutterwave-form', 'id' => 'flutterwave-form', 'autocomplete' => 'off');?>
									<?php $hidden = array('flutterwave_info' => 'flutterwave');?>
                                    <?= form_open('erp/flutterwave/verify_payments', $attributes, $hidden);?>
                                          <input type="hidden" id="amount" name="amount" value="<?= $fprice;?>">
                                          <input type="hidden" id="email" name="email" value="<?= $company_email;?>">
                                          <input type="hidden" id="email" name="currency" value="<?= $xin_system['default_currency'];?>">
                                          <input type="hidden" id="phone" name="phone" value="<?= $company_number;?>">
                                          <button type="button" id="submit" class="btn btn-danger text-sm-right mt-md-0 mt-2">
                                          <?= lang('Membership.xin_complete_order');?></button>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php
    if($membership['plan_duration']==1){
    	$plan_duration = lang('Membership.xin_subscription_monthly');
    } else if($membership['plan_duration']==2){
    	$plan_duration = lang('Membership.xin_subscription_yearly');
    } else if($membership['plan_duration']==4){
        $plan_duration = lang('Main.xin_plan_weekly');
    } else if($membership['plan_duration']==5){
        $plan_duration = lang('Main.xin_14days');
    } else {
    	$plan_duration = lang('Main.xin_plan_lifetime');
    }
    ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><?= lang('Membership.xin_complete_summary');?></h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item py-0">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="m-0 d-inline-block align-middle">
                                            <a href="#!" class="text-body font-weight-semibold"><?= $membership['membership_type'];?></a>
                                            <br>
                                            <small><?= lang('Membership.xin_subscription_id');?>: <?= $membership['subscription_id'];?></small>
                                        </p>
                                    </td>
                                    <td class="text-right">
                                        <?= number_to_currency($converted, $xin_system['default_currency'],null,2);?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
                <li class="list-group-item py-0">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="m-0 d-inline-block align-middle">
                                            <a href="#!" class="text-body font-weight-semibold"><?= lang('Main.xin_description');?></a>
                                            
                                            <br>
                                            <small><?= lang('Employees.xin_total_employees');?>: <?= $membership['total_employees'];?></small>
                                            <br>
                                            <small><?= lang('Membership.xin_plan_duration');?>: <?= $plan_duration;?></small>
                                            <br>
                                            <small><?= html_entity_decode($membership['description']);?></small>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
            <div class="card-body py-2">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0 w-auto table-sm float-right text-right">
                        <tbody>
                            <tr>
                                <td>
                                    <h6 class="m-0"><?= lang('Invoices.xin_subtotal');?>:</h6>
                                </td>
                                <td>
                                    <?= number_to_currency($converted, $xin_system['default_currency'],null,2);?>
                                </td>
                            </tr>
                            <?php if($xin_super_system['enable_tax'] == 1):?>
                            <tr>
                                <td>
                                    <h6 class="m-0"><?= lang('Invoices.xin_tax');?>:</h6>
                                    <?php
									if($subscription_tax['constants_id']!=181){
										if($subscription_tax['field_two']=='fixed'){
											$fvalue = lang('Employees.xin_title_tax_fixed');
										} else {
											$fvalue = $subscription_tax['field_one'].'%';
										}?>
										<small><?= $subscription_tax['category_name'];?>(<?= $fvalue?>)</small>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?= number_to_currency($tax_rate, $xin_system['default_currency'],null,2);?>
                                </td>
                            </tr>
                            <?php endif;?>
                            <tr class="border-top">
                                <td>
                                    <h5 class="m-0"><?= lang('Main.xin_total');?>:</h5>
                                </td>
                                <td class="font-weight-semibold">
                                    <?= number_to_currency($final_subs_price, $xin_system['default_currency'],null,2);?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($xin_super_system['razorpay_active'] == 'yes'):?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
	var options = {
		key:            "<?= $key_id; ?>",
		amount:         "<?= $total; ?>",
		name:           "<?= $name; ?>",
		description:    "Order # <?= $merchant_order_id; ?>",
		netbanking:     true,
		currency:       "<?= $currency_code; ?>", // INR
		prefill: {
			name:       "<?= $card_holder_name; ?>",
			email:      "<?= $email; ?>",
			contact:    "<?= $phone; ?>"
		},
		notes: {
			soolegal_order_id: "<?= $membership['description']; ?>",
		},
		handler: function (transaction) {
			document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
			document.getElementById('razorpay-form').submit();
		},
		"modal": {
			"ondismiss": function(){
				location.reload()
			}
		}
	};
	var razorpay_pay_btn, instance;
	function razorpaySubmit(el) {
		if(typeof Razorpay == 'undefined') {
			setTimeout(razorpaySubmit, 200);
			if(!razorpay_pay_btn && el) {
				razorpay_pay_btn    = el;
				el.disabled         = true;
				el.value            = 'Please wait...';  
			}
		} else {
			if(!instance) {
				instance = new Razorpay(options);
				if(razorpay_pay_btn) {
					razorpay_pay_btn.disabled   = false;
					razorpay_pay_btn.value      = "Pay Now";
				}
			}
			instance.open();
		}
	}  
</script>
<?php endif;?>
<?php if($xin_super_system['paystack_active'] == 'yes'):?>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
$(document).ready(function(){
	//-- Click on detail
	$("ul.menu-items > li").on("click",function(){
		$("ul.menu-items > li").removeClass("active");
		$(this).addClass("active");
	})

	$(".attr,.attr2").on("click",function(){
		var clase = $(this).attr("class");

		$("." + clase).removeClass("active");
		$(this).addClass("active");
	})

})
</script>
<script>
function payWithPaystack(){
	var handler = PaystackPop.setup({
		key: '<?= $xin_super_system['paystack_public_secret']; ?>',
		email: '<?= $company_email;?>',
		amount: '<?= $total;?>',
		ref: ''+Math.floor((Math.random() * 1000000000) + 1),
		callback: function(response){
			window.location.replace("<?php echo site_url().'erp/paystack/verify_payment/'; ?>"+response.reference);
		},
		onClose: function(){
			window.location = '';
		}
	});
	handler.openIframe();
}
</script>
<?php endif;?>

<script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", (event) => {
	// Add an event listener for when the user clicks the submit button to pay
	document.getElementById("submit").addEventListener("click", (e) => {
		e.preventDefault();
		const PBFKey = "<?= $xin_super_system['flutterwave_public_key']; ?>"; // paste in the public key from your dashboard here
		const txRef = ''+Math.floor((Math.random() * 1000000000) + 1); //Generate a random id for the transaction reference
		const email = document.getElementById('email').value;
		const phone = document.getElementById('phone').value;
		const amount = document.getElementById('amount').value;    
        // getpaidSetup is Rave's inline script function. it holds the payment data to pass to Rave.
        getpaidSetup({
            PBFPubKey: PBFKey,
            customer_email: email,
            amount: amount,
            customer_phone: phone,
            currency: "<?= $xin_system['default_currency'];?>",// Select the currency.
            txref: txRef,
            onClose: function(){
				window.location = '';
			},
            callback: function(response) {
				
                txref = response.tx.txRef;// collect flwRef returned and pass to a server page to complete status check.
                if(response.tx.chargeResponse =='00' || response.tx.chargeResponse == '0') {
               // redirect to a verification page
                  window.location = "<?= site_url('erp/flutterwave/payment_status');?>?txref="+txref+"&token=<?= $field_id;?>"; //
                } else {
                // redirect to a verification page
                  window.location = "<?= site_url('erp/flutterwave/payment_status');?>?txref="+txref+"&token=<?= $field_id;?>"; //
                }
            }
          });
        });
    });
</script>