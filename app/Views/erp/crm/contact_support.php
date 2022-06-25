<?php $attributes = array('name' => 'add_ticket', 'id' => 'xin-form', 'autocomplete' => 'off');?>
<?php $hidden = array('user_id' => 1);?>
<?php echo form_open('erp/crm/add_ticket', $attributes, $hidden);?>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="card ">
      <div class="card-header">
        <h5>
          <?= lang('Membership.xin_how_can_we_help');?>
        </h5>
      </div>
      <div class="card-body">
        <div class="alert alert-primary">
          <div class="media align-items-center"> <i class="feather icon-alert-circle h2"></i>
            <div class="media-body ml-3">
              <?= lang('Membership.xin_ask_a_question_text');?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="demo-text-input" class="col-form-label">
                <?= lang('Dashboard.xin_category');?>
              </label>
              <select class="form-control" name="category" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.xin_category');?>">
                <option value="0">
                <?= lang('Membership.xin_general');?>
                </option>
                <option value="1">
                <?= lang('Membership.xin_technical');?>
                </option>
                <option value="2">
                <?= lang('Membership.xin_billing');?>
                </option>
                <option value="3">
                <?= lang('Users.xin_subscription_issue');?>
                </option>
                <option value="4">
                <?= lang('Membership.xin_other');?>
                </option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="demo-number-input" class="col-form-label">
                <?= lang('Projects.xin_p_priority');?>
              </label>
              <select class="form-control" name="priority" data-plugin="select_hrm" data-placeholder="<?= lang('Projects.xin_p_priority');?>">
                <option value="1">
                <?= lang('Projects.xin_low');?>
                </option>
                <option value="2">
                <?= lang('Main.xin_medium');?>
                </option>
                <option value="3">
                <?= lang('Projects.xin_high');?>
                </option>
                <option value="4">
                <?= lang('Main.xin_critical');?>
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="demo-tel-input" class="col-form-label">
            <?= lang('Membership.xin_describe_your_problem');?>
          </label>
          <input class="form-control" name="subject" type="text" placeholder="<?= lang('Membership.xin_write_your_problem');?>... " id="demo-tel-input">
        </div>
        <div class="form-group">
          <label for="demo-email-input" class="col-form-label">
            <?= lang('Membership.xin_give_us_details');?>
          </label>
          <textarea class="form-control" name="description" placeholder="<?= lang('Membership.xin_give_us_details_placeholder');?>..." rows="3"></textarea>
        </div>
      </div>
      <div class="card-footer text-right">
        <button class="btn btn-primary" type="submit">
        <?= lang('Dashboard.left_create_ticket');?>
        </button>
      </div>
    </div>
  </div>
</div>
<?= form_close(); ?>
