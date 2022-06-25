<?php
/*
* System Settings - Settings View
*/
?>
<?php
use App\Models\SystemModel;
use App\Models\ConstantsModel;
use App\Models\FrontendcontentModel;

$SystemModel = new SystemModel();
$ConstantsModel = new ConstantsModel();
$FrontendcontentModel = new FrontendcontentModel();

$xin_system = $SystemModel->where('setting_id', 1)->first();
$frontend_content = $FrontendcontentModel->where('frontend_id', 1)->first();
?>
<div class="row">
<!-- start -->
<div class="col-lg-3">
  <div class="card user-card user-card-1">
    <div class="card-body pb-0">
      <div class="media user-about-block align-items-center mt-0 mb-3">
        <div class="position-relative d-inline-block">
          <div class="certificated-badge"> <a href="javascript:void(0)" class="mb-3 nav-link"><span class="sw-icon fas fa-cog"></span></a> </div>
        </div>
        <div class="media-body ml-3">
          <h6 class="mb-1">
            <?= lang('Main.xin_frontend_settings');?>
          </h6>
          <p class="mb-0 text-muted">
            <?= lang('Main.header_configuration');?>
          </p>
        </div>
      </div>
    </div>
    <div class="nav flex-column nav-pills list-group list-group-flush list-pills" id="user-set-tab" role="tablist" aria-orientation="vertical"> <a class="nav-link list-group-item list-group-item-action active" id="constant-cmspages-tab" data-toggle="pill" href="#constant-cmspages" role="tab" aria-controls="constant-cmspages" aria-selected="false"> <span class="f-w-500"><i class="feather icon-file-text m-r-10 h5 "></i>
      <?= lang('Main.xin_cms_pages');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-content-tab" data-toggle="pill" href="#account-content" role="tab" aria-controls="account-content" aria-selected="false"> <span class="f-w-500"><i class="feather icon-edit m-r-10 h5 "></i>
      <?= lang('Main.xin_frontend_content');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a></div>
  </div>
</div>
<div class="col-lg-9">
  <div class="tab-content" id="user-set-tabContent">
    <div class="tab-pane fade show active" id="constant-cmspages" role="tabpanel" aria-labelledby="constant-cmspages-tab">
      <div class="card user-profile-list">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="card-header with-elements"> <span class="card-header-title mr-2"> <strong>
                <?= lang('Main.xin_list_all');?>
                </strong>
                <?= lang('Main.xin_cms_pages');?>
                </span> </div>
              <div class="card-body">
                <div class="card-datatable table-responsive">
                  <table class="datatables-demo table table-striped table-bordered" id="xin_table_cms_pages" style="width:100%;">
                    <thead>
                      <tr>
                        <th><?= lang('Main.xin_cms_page_name');?></th>
                        <th width="80">&nbsp;</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="account-content" role="tabpanel" aria-labelledby="account-content-tab">
      <div class="card">
        <div class="card-header">
          <h5><i data-feather="edit" class="icon-svg-primary wid-20"></i><span class="p-l-5">
            <?= lang('Main.xin_frontend_content');?>
            </span></h5>
        </div>
        <?php $attributes = array('name' => 'utube_url_info', 'id' => 'utube_url_info', 'autocomplete' => 'off');?>
        <?php $hidden = array('token' => 'Layout');?>
        <?= form_open('erp/application/update_frontend_content', $attributes, $hidden);?>
        <div class="card-body">
          <div class="bg-white">
            <div class="row">              
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">
                    <?= lang('Main.xin_frontend_about');?>
                    <span class="text-danger">*</span> </label>
                  	<textarea class="form-control" rows="2" name="about_short" placeholder="<?= lang('Main.xin_frontend_about_details');?>"><?= $frontend_content['about_short'];?></textarea>
                </div>
              </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">
                    <?= lang('Main.xin_youtube_link');?>
                    <span class="text-danger">*</span> </label>
                  	<input type="text" class="form-control" name="youtube_url" placeholder="<?= lang('Main.xin_homepage_youtube_link_place');?>" value="<?= $frontend_content['youtube_url'];?>">
                </div>
              </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>
                      <?= lang('Employees.xin_facebook');?>
                    </label>
                    <div class="input-group">
                      <div class="input-group-prepend d-flex"> <span class="input-group-text bg-facebook text-white"> <i class="fab fa-facebook-f"></i> </span> </div>
                      <input type="text" class="form-control" placeholder="<?= lang('Employees.xin_profile_url');?>" name="fb_profile" value="<?= $frontend_content['fb_profile'];?>">
                    </div>
                  </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label>
                      <?= lang('Employees.xin_twitter');?>
                    </label>
                    <div class="input-group">
                      <div class="input-group-prepend d-flex"> <span class="input-group-text bg-twitter text-white"> <i class="fab fa-twitter"></i> </span> </div>
                      <input type="text" class="form-control" placeholder="<?= lang('Employees.xin_profile_url');?>" name="twitter_profile" value="<?= $frontend_content['twitter_profile'];?>">
                    </div>
                  </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label>
                      <?= lang('Employees.xin_linkedin');?>
                    </label>
                    <div class="input-group">
                      <div class="input-group-prepend d-flex"> <span class="input-group-text bg-linkedin text-white"> <i class="fab fa-linkedin-in"></i> </span> </div>
                      <input type="text" class="form-control" placeholder="<?= lang('Employees.xin_profile_url');?>" name="linkedin_profile" value="<?= $frontend_content['linkedin_profile'];?>">
                    </div>
                  </div>
              </div>
              </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <button type="submit" class="btn btn-primary">
          <?= lang('Main.xin_save');?>
          </button>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>
