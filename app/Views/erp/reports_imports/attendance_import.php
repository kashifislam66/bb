<?php
/* Attendance Import view
*/
?>
<?php /*?><?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<?php $user_info = $this->Xin_model->read_user_info($session['user_id']);?>
<?php $role_resources_ids = $this->Xin_model->user_role_resource(); ?><?php */?>

<div id="smartwizard-2" class="smartwizard-example sw-main sw-theme-default">
  <ul class="nav nav-tabs step-anchor">
    <?php //if(in_array('92',$role_resources_ids)) { ?>
    <li class="nav-item done"> <a href="<?= site_url('erp/staff-import');?>" class="mb-3 nav-link"> <span class="sw-done-icon fas fa-user-edit"></span> <span class="sw-icon fas fa-user-edit"></span> <?php echo lang('Main.xin_import_employees');?>
      <div class="text-muted small"><?php echo lang('Main.xin_import_employees');?></div>
      </a> </li>
    <?php //} ?>
    <?php //if(in_array('443',$role_resources_ids)) { ?>
    <li class="nav-item active"> <a href="<?= site_url('erp/attendance-import');?>" class="mb-3 nav-link"> <span class="sw-done-icon fas fa-clock"></span> <span class="sw-icon fas fa-clock"></span> <?php echo lang('Main.left_import_attendance');?>
      <div class="text-muted small"><?php echo lang('Main.left_import_attendance');?></div>
      </a> </li>
    <?php //} ?>
  </ul>
  <hr class="border-light m-0 mb-3">
  <div class="sw-container tab-content">
    <?php //if(in_array('443',$role_resources_ids)) { ?>
    <div id="smartwizard-2-step-1" class="card animated fadeIn tab-pane step-content" style="display: block;">
      <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong><?php echo lang('Main.left_import_attendance');?></strong> <?php echo lang('Main.xin_attendance_import_csv_file');?></span></div>
      <div class="card-body">
        <div class="alert alert-primary" role="alert">
			<?php echo lang('Main.xin_attendance_description_line1');?>
        </div>
        <div class="alert alert-warning" role="alert">
			<?php echo lang('Main.xin_attendance_description_line2');?>
        </div>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><?= lang('Main.xin_hints');?>:</strong> <?= lang('Main.xin_attendance_description_line3');?>
        </div>
        <h6><a href="<?php echo base_url();?>uploads/csv/sample-csv-attendance.csv" class="btn btn-primary"> <i class="fa fa-download"></i> <?php echo lang('Main.xin_attendance_download_sample');?> </a></h6>
        <?php $attributes = array('name' => 'import_time', 'id' => 'import_time', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => 0);?>
        <?php echo form_open_multipart('erp/application/upload_attendance', $attributes, $hidden);?>
        <fieldset class="form-group">
          <label for="logo"><?php echo lang('Main.xin_attendance_upload_file');?></label>
          <input type="file" class="form-control-file" id="file" name="file">
          <small><?php echo lang('Main.xin_attendance_allowed_size');?></small>
        </fieldset>
      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary">
        <?= lang('Main.left_import_attendance');?>
        </button>
      </div>
      <?php echo form_close(); ?> </div>
    <?php //} ?>
  </div>
</div>
