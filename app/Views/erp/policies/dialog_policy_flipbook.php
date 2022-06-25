<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\PolicyModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$PolicyModel = new PolicyModel();
$get_animate = '';
if($request->getGet('data') === 'policy' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$result = $PolicyModel->where('policy_id', $ifield_id)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<div class="modal-body">
  <div class="sample-container">
    <div style="height:500px"> </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-light" data-dismiss="modal">
  <?= lang('Main.xin_close');?>
  </button>
</div>
<script type="text/javascript">
  $('.sample-container div').FlipBook({pdf: '<?= base_url().'/public/uploads/policy/'.$result['attachment'];?>'});
</script>
<style type="text/css">
.modal-body {
    position: relative;
    flex: 1 1 auto;
    /* padding: 1.25rem; */
    height: 510px !important;
}
.modal-dialog {
   /* max-width: 100% !important;*/
    margin: 1.75rem auto;
}
</style>
<?php }
?>
