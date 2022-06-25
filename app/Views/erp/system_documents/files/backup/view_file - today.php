<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\DepartmentModel;
use App\Models\StaffdetailsModel;
use App\Models\SignaturedocumentsModel;

$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$DepartmentModel = new DepartmentModel();
$StaffdetailsModel = new StaffdetailsModel();
$SignaturedocumentsModel = new SignaturedocumentsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	
	$employee_detail = $StaffdetailsModel->where('user_id', $user_info['user_id'])->first();
	$val = $employee_detail['department_id'];
    $main_department = $DepartmentModel->where('company_id', $user_info['company_id'])->where('department_id', $employee_detail['department_id'])->findAll();
	$tab_active = 'active';
} else {
	$val = 0;
	$main_department = $DepartmentModel->where('company_id', $usession['sup_user_id'])->findAll();
	$tab_active = '';
}
$segment_id = $request->uri->getSegment(3);
$document_id = udecode($segment_id);
$result = $SignaturedocumentsModel->where('document_id', $document_id)->first();	
//echo $result['document_file'];
//exit;
?>
<a href="<?= site_url('erp/signature-files');?>" class="btn btn-primary mb-2">Back</a>
<div class="right-bar font-list light-card">
  <div class="right-bar-head">
    <div class="pull-right close-right-bar-head close-right-bar"><i class="fas fa-window-close"></i></div>
  </div>
  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 347px; height: 668.6px;">
    <div class="right-bar-body" style="overflow: hidden; width: 347px; height: 668.6px;">
      <div class="font-list">
        <div class="font-item" font="courier" family="'Courier', sans-serif" style="font-family:'Courier', sans-serif;">Courier</div>
        <div class="font-item selected" font="dejavusans" family="'Dejavusans', sans-serif" style="font-family:'Dejavusans', sans-serif;">Dejavusans</div>
        <div class="font-item" font="freemono" family="'Free Mono', cursive" style="font-family:'Free Mono', cursive;">Free Mono</div>
        <div class="font-item" font="freesans" family="'Free Sans', sans-serif" style="font-family:'Free Sans', sans-serif;">Free Sans</div>
        <div class="font-item" font="kozminproregular" family="'KozGoPro-Regular', serif" style="font-family:'KozGoPro-Regular', serif;">KozGoPro-Regular</div>
        <div class="font-item" font="msungstdlight" family="'MSung Light', sans-serif" style="font-family:'MSung Light', sans-serif;">MSung Light</div>
        <div class="font-item" font="pdfatimes" family="'Times', cursive" style="font-family:'Times', cursive;">Times</div>
      </div>
    </div>
    <div class="slimScrollBarY" style="background: rgb(158, 165, 171); width: 3px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; height: 668.2px; display: none;"></div>
    <div class="slimScrollRailY" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
  </div>
</div>
<input type="hidden" value="<?= csrf_hash();?>" name="csrf_token" id="csrf_token" />
<input type="hidden" value="<?= $segment_id;?>" name="file_token" id="file_token" />
<div class="signer-overlay">
  <div class="signer-overlay-header">
    <div class="signer-overlay-logo"> <a href=""><img src="https://localhost/cz/timehrm_local_dav_signpdf/public/uploads/logo/other/other-logo.svg" class="img-responsive"></a> </div>
    <div class="signer-overlay-action">
      <button class="btn btn-default close-editor-overlay">Close </button>
      <button class="btn btn-primary signer-save">Save</button>
    </div>
    <div class="signer-header-tools">
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%;">
        <div class="signer-header-tool-holder" style="overflow: hidden; width: 100%; height: 70px; white-space: nowrap;">
          <div class="signer-tool" tool="signature" action="true">
            <div class="tool-icon tool-signature"></div>
            <p>Signature</p>
          </div>
          <div class="signer-tool" tool="text" action="true">
            <div class="tool-icon tool-text"></div>
            <p>Text</p>
          </div>
        </div>
        <div class="slimScrollBarX" style="background: rgba(0, 0, 0, 0); height: 1px; position: absolute; left: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; bottom: 1px;"></div>
        <div class="slimScrollRailX" style="width: 100%; height: 1px; position: absolute; left: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0; z-index: 90; bottom: 1px;"></div>
      </div>
    </div>
  </div>
  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 70px;">
    <div class="signer-more-tools" style="overflow: hidden; width: 100%; height: 70px; white-space: nowrap;">
      <div class="signer-tool" tool="bold" action="false" group="text">
        <div class="tool-icon tool-bold"></div>
        <p>Bold</p>
      </div>
      <div class="signer-tool" tool="italic" action="false" group="text">
        <div class="tool-icon tool-italic"></div>
        <p>Italic</p>
      </div>
      <div class="signer-tool" tool="font" action="false" group="text">
        <div class="tool-icon tool-font"></div>
        <p>Font</p>
      </div>
      <div class="signer-tool" tool="fontsize" action="false">
        <div class="tool-icon tool-fontsize">
          <div class="numberInput">
            <input type="text" class="font-size" value="14" min="0">
            <span class="arrow up"></span> <span class="arrow down"></span> </div>
        </div>
        <p class="font-size-label">Font Size</p>
      </div>
      <div class="signer-tool" tool="color" action="false" color="#000000" style="display:none;">
        <div class="tool-icon tool-colorfill"><button id="color-picker" class="jscolor {valueElement:null,value:'000000', borderRadius:'1px', borderColor:'#e6eaee', onFineChange:'updateColor(this)'}" style="background-image: none; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);"></button></div>
        <p>Color</p>
    </div>
      <div class="signer-tool" tool="duplicate" action="false">
        <div class="tool-icon tool-duplicate"></div>
        <p>Duplicate</p>
      </div>
      <div class="signer-tool" tool="delete" action="false">
        <div class="tool-icon tool-delete"></div>
        <p>Delete</p>
      </div>
    </div>
    <div class="slimScrollBarX" style="background: rgba(0, 0, 0, 0); height: 1px; position: absolute; left: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; bottom: 1px;"></div>
    <div class="slimScrollRailX" style="width: 100%; height: 1px; position: absolute; left: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0; z-index: 90; bottom: 1px;"></div>
  </div>
  <div class="signer-overlay-previewer col-md-8 light-card"></div>
  <div class="signer-assembler"></div>
  <div class="signer-builder"></div>
  <div class="request-helper">Select input fields and signature position for <strong></strong></div>
</div>
<div class="row">
  <div class="col-md-6 col-xl-12">
    <div class="card">
      <h5 class="card-header">
        <button class="btn btn-success btn-responsive launch-editor">Sign &amp; Edit</button>
      </h5>
      <div class="row">
        <div class="col-md-12">
          <div class="light-card document">
            <div class="signer-document"> 
              <!-- open PDF docements -->
              <div class="document-pagination">
                <div class="pull-left">
                  <button id="prev" class="btn btn-default btn-round disabled"><i class="fas fa-angle-left"></i></button>
                  <button id="next" class="btn btn-default btn-round"><i class="fas fa-angle-right"></i></button>
                  <span class="text-muted ml-15">Page <span id="page_num">1</span> of <span id="page_count">3</span></span> </div>
              </div>
              <div class="document-load" style="display: none;">
                <div class="loader-box">
                  <div class="circle-loader"></div>
                </div>
              </div>
              <div class="document-error"> <i class="ion-android-warning text-danger"></i>
                <p class="text-muted"><strong>Oops! </strong> <span class="error-message"> Something went wrong.</span></p>
              </div>
              <div class="text-center">
                <div class="document-map" style=""></div>
                <canvas id="document-viewer" height="1087" width="769"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
