<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\DepartmentModel;
use App\Models\StaffdetailsModel;

$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$DepartmentModel = new DepartmentModel();
$StaffdetailsModel = new StaffdetailsModel();
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
?>
<div class="card">
      <div class="card-body">
        
        <div class="row">
          <div class="col-md-12">
          
<div class="signer-overlay m-t-50">
  <div class="signer-overlay-header">
    <div class="signer-overlay-logo"> <a href=""><img src="https://localhost/cz/timehrm_local_dav_signpdf/public/uploads/logo/timehrm-logo.svg" class="img-responsive"></a> </div>
    <div class="signer-overlay-action">
      <button class="btn btn-responsive btn-default close-editor-overlay"><i class="ion-ios-close-outline"></i> Close </button>
      <button class="btn btn-responsive btn-primary signer-save"><i class="ion-ios-checkmark-outline"></i> <span>Save</span> </button>
      <button class="btn btn-responsive btn-primary signer-next" index="1"><i class="ion-ios-checkmark-outline"></i> <span>Next</span> </button>
    </div>
    <div class="signer-header-tools">
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%;">
        <div class="signer-header-tool-holder" style="overflow: hidden; width: 100%; height: 70px; white-space: nowrap;">
          <div class="signer-tool" tool="signature" action="true">
            <div class="tool-icon tool-signature"></div>
            <p>Signature</p>
          </div>
          <div class="signer-tool" tool="stamp" action="true">
            <div class="tool-icon tool-stamp"></div>
            <p>R/Stamp</p>
          </div>
          <div class="signer-tool" tool="text" action="true">
            <div class="tool-icon tool-text"></div>
            <p>Text</p>
          </div>
          <div class="signer-tool" tool="draw" action="true">
            <div class="tool-icon tool-draw"></div>
            <p>Draw</p>
          </div>
          <div class="signer-tool" tool="image" action="true">
            <div class="tool-icon tool-image"></div>
            <p>Image</p>
          </div>
          <div class="signer-tool" tool="symbol" action="true">
            <div class="tool-icon tool-symbols"></div>
            <p>Symbols</p>
          </div>
          <div class="signer-tool" tool="shape" action="true">
            <div class="tool-icon tool-shapes"></div>
            <p>Shapes</p>
          </div>
          <div class="signer-tool" tool="fields" action="true">
            <div class="tool-icon tool-fields"></div>
            <p>Fields</p>
          </div>
          <div class="signer-tool" tool="input" action="true">
            <div class="tool-icon tool-textinput"></div>
            <p>Input</p>
          </div>
          <div class="signer-tool" tool="rotate" action="true">
            <div class="tool-icon tool-rotate"></div>
            <p>Rotate</p>
          </div>
        </div>
        <div class="slimScrollBarX" style="background: rgba(0, 0, 0, 0); height: 1px; position: absolute; left: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; bottom: 1px;"></div>
        <div class="slimScrollRailX" style="width: 100%; height: 1px; position: absolute; left: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0; z-index: 90; bottom: 1px;"></div>
      </div>
    </div>
  </div>
  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 70px;">
    <div class="signer-more-tools" style="overflow: hidden; width: 100%; height: 70px; white-space: nowrap;">
      <div class="signer-tool" tool="alignleft" action="false" group="text">
        <div class="tool-icon tool-alignleft"></div>
        <p>Align Left</p>
      </div>
      <div class="signer-tool" tool="aligncenter" action="false" group="text">
        <div class="tool-icon tool-aligncenter"></div>
        <p>Align Center</p>
      </div>
      <div class="signer-tool" tool="alignright" action="false" group="text">
        <div class="tool-icon tool-alignright"></div>
        <p>Align Right</p>
      </div>
      <div class="signer-tool" tool="bold" action="false" group="text">
        <div class="tool-icon tool-bold"></div>
        <p>Bold</p>
      </div>
      <div class="signer-tool" tool="italic" action="false" group="text">
        <div class="tool-icon tool-italic"></div>
        <p>Italic</p>
      </div>
      <div class="signer-tool" tool="underline" action="false" group="text">
        <div class="tool-icon tool-underline"></div>
        <p>Underline</p>
      </div>
      <div class="signer-tool" tool="strikethrough" action="false" group="text">
        <div class="tool-icon tool-strikethrough"></div>
        <p>Strikethrough</p>
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
      <div class="signer-tool" tool="color" action="false" color="#000000">
        <div class="tool-icon tool-colorfill">
          <button id="color-picker" class="jscolor {valueElement:null,value:'000000', borderRadius:'1px', borderColor:'#e6eaee', onFineChange:'updateColor(this)'}" style="background-image: none; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);"></button>
        </div>
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
  <div class="signer-overlay-footer">
    <p class="text-muted text-center"> Powered by Signer Inc | 2021 © Signer Inc | All Rights Reserved. </p>
  </div>
  <div class="signer-assembler"></div>
  <div class="signer-builder"></div>
  <div class="request-helper">Select input fields and signature position for <strong></strong></div>
</div>
</div></div></div></div>
<div class="row">
  <div class="col-md-6 col-xl-12">
    <h5>Header and Footer</h5>
    <div class="card">
      <h5 class="card-header">
        <button class="btn btn-success btn-responsive launch-editor">Sign &amp; Edit</button>
      </h5>
      <div class="card-body">
        
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
</div>
<div class="card"> </div>
