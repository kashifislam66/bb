<?php
use App\Models\UsersModel;
use App\Models\MembershipModel;
use App\Models\SuperroleModel;
use App\Models\SystemModel;

$MembershipModel = new MembershipModel();
$SuperroleModel = new SuperroleModel();
$MembershipModel = new MembershipModel();

$SystemModel = new SystemModel();
$UsersModel = new UsersModel();
$request = \Config\Services::request();

$xin_system = $SystemModel->where('setting_id', 1)->first();
$field_id = $request->uri->getSegment(3);
$membership_id = udecode($field_id);
$result = $MembershipModel->where('membership_id', $membership_id)->first();
?>

<div class="media align-items-center py-0 mb-3">
  <div class="display-1 text-primary"><i class="lnr lnr-briefcase text-big"></i></div>
  <div class="media-body ml-0">
    <h4 class="font-weight-bold mb-2 text-primary">
      <?= $result['membership_type'];?>
    </h4>
    <div class="text-muted mb-0">
      <?= lang('Membership.xin_subscription_id');?>
      :
      <?= $result['subscription_id']?>
    </div>
    <div class="text-muted mb-0">
      <?= lang('Membership.xin_you_can_view_and_update');?>
      <span class="text-primary"><i class="fas fa-info-circle"></i></span>
      <?= lang('Main.xin_created_at');?>
      :
      <?= $result['created_at'];?>
    </div>
  </div>
</div>
<h3 class="mt-0">
  <?= lang('Membership.xin_update_subscription');?>
</h3>
<div class="row">
  <div class="col-md-12">
    <div class="card mt-md-4">
      <div class="card-header">
        <h5>
          <?= lang('Membership.xin_update_subscription');?>
        </h5>
      </div>
      <div class="card-body">
        <?php $attributes = array('name' => 'update_membership', 'id' => 'edit_membership', 'autocomplete' => 'off', 'class' => 'form');?>
        <?php $hidden = array('user_id' => 0, 'token' => $field_id);?>
        <?php echo form_open('erp/membership/update_membership', $attributes, $hidden);?>
        <div class="form-body">
              <div class="row form-sm-row">
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="membership_type">
                      <?= lang('Membership.xin_membership_type');?>
                      <span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="<?= lang('Membership.xin_membership_type');?>" name="membership_type" type="text" value="<?= $result['membership_type'];?>">
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="form-group">
                    <label for="price_monthly">
                      <?= lang('Main.xin_price');?>
                      <span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_price');?>" name="price" type="text" value="<?= $result['price'];?>">
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="form-group">
                    <label for="price_yearly" class="control-label">
                      <?= lang('Employees.xin_total_employees');?>
                      <span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="<?= lang('Employees.xin_total_employees');?>" name="total_employees" type="text" value="<?= $result['total_employees'];?>">
                  </div>
                </div>
  
            <div class="col-md-4 col-sm-6">
              <div class="form-group">
                <label for="role_name">
                  <?= lang('Membership.xin_plan_duration');?>
                  <span class="text-danger">*</span></label>
                <select class="form-control custom-select" data-plugin="select_hrm" name="plan_duration"  data-placeholder="<?= lang('Membership.xin_plan_duration');?>">
                  <option value="">&nbsp;</option>
                  <option value="4" <?php if($result['plan_duration']==4):?> selected="selected"<?php endif;?>>
				  <?= lang('Main.xin_plan_weekly');?>
                  </option>
                  <option value="5" <?php if($result['plan_duration']==5):?> selected="selected"<?php endif;?>>
                  <?= lang('Main.xin_14days');?>
                  </option>
                  <option value="1" <?php if($result['plan_duration']==1):?> selected="selected"<?php endif;?>>
                  <?= lang('Membership.xin_subscription_monthly');?>
                  </option>
                  <option value="2" <?php if($result['plan_duration']==2):?> selected="selected"<?php endif;?>>
                  <?= lang('Membership.xin_subscription_yearly');?>
                  </option>
                  <option value="3" <?php if($result['plan_duration']==3):?> selected="selected"<?php endif;?>>
                  <?= lang('Main.xin_plan_lifetime');?>
                  </option>
                </select>
              </div>
            </div>
            <div class="col-md-8 col-sm-12">
              <div class="form-group">
                <label for="description">
                  <?= lang('Main.xin_description');?>
                </label>
                <textarea class="form-control" placeholder="<?= lang('Main.xin_description');?>" name="description" cols="30" rows="1"><?= $result['description'];?></textarea>
              </div>
            </div>
          </div>
          <h5><?= lang('Main.xin_select_plan_icon');?></h5>
          <div class="row form-row text-center">
            <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                <div class="form-check form-check-inline">
                    <input type="radio" name="plan_icon" class="form-check-input" id="2815761" value="medal-trial.svg" <?php if($result['plan_icon']=='medal-trial.svg'):?> checked="checked" <?php endif;?>>
                    <label class="form-check-label" for="2815761"><img src="<?= base_url();?>/public/assets/images/pages/medal-trial.svg" for="2815761" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                <div class="form-check form-check-inline">
                    <input type="radio" name="plan_icon" class="form-check-input" id="2815762" value="medal-bronze.svg" <?php if($result['plan_icon']=='medal-bronze.svg'):?> checked="checked" <?php endif;?>>
                    <label class="form-check-label" for="2815762"><img src="<?= base_url();?>/public/assets/images/pages/medal-bronze.svg" for="2815762" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                <div class="form-check form-check-inline">
                    <input type="radio" name="plan_icon" class="form-check-input" id="2815763" value="medal-gold.svg" <?php if($result['plan_icon']=='medal-gold.svg'):?> checked="checked" <?php endif;?>>
                    <label class="form-check-label" for="2815763"><img src="<?= base_url();?>/public/assets/images/pages/medal-gold.svg" for="2815763" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                <div class="form-check form-check-inline">
                    <input type="radio" name="plan_icon" class="form-check-input" id="2815764" value="medal-platinum.svg" <?php if($result['plan_icon']=='medal-platinum.svg'):?> checked="checked" <?php endif;?>>
                    <label class="form-check-label" for="2815764"><img src="<?= base_url();?>/public/assets/images/pages/medal-platinum.svg" for="2815764" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                <div class="form-check form-check-inline">
                    <input type="radio" name="plan_icon" class="form-check-input" id="2815765" value="medal-silver.svg" <?php if($result['plan_icon']=='medal-silver.svg'):?> checked="checked" <?php endif;?>>
                    <label class="form-check-label" for="2815765"><img src="<?= base_url();?>/public/assets/images/pages/medal-silver.svg" for="2815765" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                <div class="form-check form-check-inline">
                    <input type="radio" name="plan_icon" class="form-check-input" id="2815766" value="medal-vip.svg" <?php if($result['plan_icon']=='medal-vip.svg'):?> checked="checked" <?php endif;?>>
                    <label class="form-check-label" for="2815766"><img src="<?= base_url();?>/public/assets/images/pages/medal-vip.svg" for="2815766" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815767" value="medal-pro.svg" <?php if($result['plan_icon']=='medal-pro.svg'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="2815767"><img src="<?= base_url();?>/public/assets/images/pages/medal-pro.svg" for="2815767" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815768" value="medal-premium.svg" <?php if($result['plan_icon']=='medal-premium.svg'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="2815768"><img src="<?= base_url();?>/public/assets/images/pages/medal-premium.svg" for="2815768" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815769" value="medal-advanced.svg" <?php if($result['plan_icon']=='medal-advanced.svg'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="2815769"><img src="<?= base_url();?>/public/assets/images/pages/medal-advanced.svg" for="2815769" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="28157701" value="medal-enterprise.svg" <?php if($result['plan_icon']=='medal-enterprise.svg'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="28157701"><img src="<?= base_url();?>/public/assets/images/pages/medal-enterprise.svg" for="28157701" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="28157702" value="medal-starter.svg" <?php if($result['plan_icon']=='medal-starter.svg'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="28157702"><img src="<?= base_url();?>/public/assets/images/pages/medal-starter.svg" for="28157702" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="28157703" value="medal-basic.svg" <?php if($result['plan_icon']=='medal-basic.svg'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="28157703"><img src="<?= base_url();?>/public/assets/images/pages/medal-basic.svg" for="28157703" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
         </div>
        </div>
        </div>
        <div class="card-footer text-right">
          <button type="submit" class="btn btn-primary">
          <?= lang('Membership.xin_update_subscription');?>
          </button>
        </div>
        <?php echo form_close(); ?>
    </div>
  </div>
</div>
