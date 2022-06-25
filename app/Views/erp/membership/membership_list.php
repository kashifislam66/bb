
<div id="add_form" class="collapse add-form" data-parent="#accordion" style="">
  <div class="card mb-2">
    <div class="card-header">
      <h5>
        <?= lang('Main.xin_add_new');?>
        <?= lang('Membership.xin_plan');?>
      </h5>
      <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn btn-sm waves-effect waves-light btn-primary m-0"> <i data-feather="minus"></i>
        <?= lang('Main.xin_hide');?>
        </a> </div>
    </div>
    <div id="accordion">
      <div class="card-body">
        <?php $attributes = array('name' => 'add_membership', 'id' => 'xin-form', 'autocomplete' => 'off', 'class' => 'form');?>
        <?php $hidden = array('user_id' => 0);?>
        <?php echo form_open('erp/membership/add_membership', $attributes, $hidden);?>
        <div class="form-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row form-sm-row">
                <div class="col-xl-3 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="membership_type">
                      <?= lang('Membership.xin_membership_type');?>
                      <span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="<?= lang('Membership.xin_membership_type');?>" name="membership_type" type="text" value="">
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="price_monthly">
                      <?= lang('Main.xin_price');?>
                      <span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_price');?>" name="price" type="text" value="">
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="price_yearly" class="control-label">
                      <?= lang('Membership.xin_plan_duration');?>
                      <span class="text-danger">*</span></label>
                    <select class="form-control custom-select" data-plugin="select_hrm" name="plan_duration"  data-placeholder="<?= lang('Membership.xin_plan_duration');?>">
                      <option value="">&nbsp;</option>
                      <option value="4">
                      <?= lang('Main.xin_plan_weekly');?>
                      </option>
                      <option value="5">
                      <?= lang('Main.xin_14days');?>
                      </option>
                      <option value="1">
                      <?= lang('Membership.xin_subscription_monthly');?>
                      </option>
                      <option value="2">
                      <?= lang('Membership.xin_subscription_yearly');?>
                      </option>
                      <option value="3">
                      <?= lang('Main.xin_plan_lifetime');?>
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="price_monthly">
                      <?= lang('Employees.xin_total_employees');?>
                      <span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="<?= lang('Employees.xin_total_employees');?>" name="total_employees" type="text" value="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="description">
                  <?= lang('Main.xin_description');?>
                </label>
                <textarea class="form-control" placeholder="<?= lang('Main.xin_description');?>" name="description" cols="30" rows="1"></textarea>
              </div>
            </div>
          </div>
          	<hr>
            <h5><?= lang('Main.xin_select_plan_icon');?></h5>
            <hr />
            <div class="form-sm-row row text-center">
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815761" value="medal-trial.svg" checked="checked">
                        <label class="form-check-label" for="2815761"><img src="<?= base_url();?>/public/assets/images/pages/medal-trial.svg" for="2815761" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815762" value="medal-bronze.svg">
                        <label class="form-check-label" for="2815762"><img src="<?= base_url();?>/public/assets/images/pages/medal-bronze.svg" for="2815762" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815763" value="medal-gold.svg">
                        <label class="form-check-label" for="2815763"><img src="<?= base_url();?>/public/assets/images/pages/medal-gold.svg" for="2815763" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815764" value="medal-platinum.svg">
                        <label class="form-check-label" for="2815764"><img src="<?= base_url();?>/public/assets/images/pages/medal-platinum.svg" for="2815764" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815765" value="medal-silver.svg">
                        <label class="form-check-label" for="2815765"><img src="<?= base_url();?>/public/assets/images/pages/medal-silver.svg" for="2815765" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815766" value="medal-vip.svg">
                        <label class="form-check-label" for="2815766"><img src="<?= base_url();?>/public/assets/images/pages/medal-vip.svg" for="2815766" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815767" value="medal-pro.svg">
                        <label class="form-check-label" for="2815767"><img src="<?= base_url();?>/public/assets/images/pages/medal-pro.svg" for="2815767" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815768" value="medal-premium.svg">
                        <label class="form-check-label" for="2815768"><img src="<?= base_url();?>/public/assets/images/pages/medal-premium.svg" for="2815768" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="2815769" value="medal-advanced.svg">
                        <label class="form-check-label" for="2815769"><img src="<?= base_url();?>/public/assets/images/pages/medal-advanced.svg" for="2815769" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="28157701" value="medal-enterprise.svg">
                        <label class="form-check-label" for="28157701"><img src="<?= base_url();?>/public/assets/images/pages/medal-enterprise.svg" for="28157701" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="28157702" value="medal-starter.svg">
                        <label class="form-check-label" for="28157702"><img src="<?= base_url();?>/public/assets/images/pages/medal-starter.svg" for="28157702" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6 select-plan-col">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="plan_icon" class="form-check-input" id="28157703" value="medal-basic.svg">
                        <label class="form-check-label" for="28157703"><img src="<?= base_url();?>/public/assets/images/pages/medal-basic.svg" for="28157703" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                </div>
             </div>
        </div>
        <div class="card-footer text-right">
          <button type="reset" class="btn btn-light" href="#add_form" data-toggle="collapse" aria-expanded="false">
          <?= lang('Main.xin_reset');?>
          </button>
          &nbsp;
          <button type="submit" class="btn btn-primary">
          <?= lang('Main.xin_save');?>
          </button>
        </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>
</div>
<div class="card user-profile-list">
  <div class="card-header">
    <h5>
      <?= lang('Main.xin_list_all');?>
      <?= lang('Membership.xin_membership_plans');?>
    </h5>
    <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn waves-effect waves-light btn-primary btn-sm m-0"> <i data-feather="plus"></i>
      <?= lang('Membership.xin_new_subscription');?>
      </a> </div>
  </div>
  <div class="card-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th><?= lang('Membership.xin_membership_type');?></th>
            <th><?= lang('Membership.xin_plan_duration');?></th>
            <th><?= lang('Main.xin_price');?></th>
            <th><?= lang('Dashboard.dashboard_employees');?></th>
            <th width="80"><?= lang('Main.xin_sales');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
