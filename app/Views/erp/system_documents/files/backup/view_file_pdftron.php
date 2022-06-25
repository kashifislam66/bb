<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SignaturedocumentsModel;

$SystemModel = new SystemModel();
$UserRolesModel = new RolesModel();
$UsersModel = new UsersModel();	
$SignaturedocumentsModel = new SignaturedocumentsModel();

$session = \Config\Services::session();
$session = $session->get('sup_username');
$request = \Config\Services::request();
$router = service('router');

$xin_system = $SystemModel->where('setting_id', 1)->first();
$role_user = $UserRolesModel->where('role_id', 1)->first();
$user_info = $UsersModel->where('user_id', $session['sup_user_id'])->first();
?>
<?php
	$com_xin_system = erp_company_settings();
	$segment_id = $request->uri->getSegment(3);
	$document_id = udecode($segment_id);
	$result = $SignaturedocumentsModel->where('document_id', $document_id)->first();	
	//echo $result['document_file'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="<?= base_url();?>/public/assets/pdf_sign/syncptrn/samples/style.css" />
    <script type="text/javascript">var main_url = '<?= site_url('erp/'); ?>';</script>
    <script type="text/javascript">var base_url = '<?= base_url(); ?>';</script>
    <script type="text/javascript">var file_url = '<?= base_url('');?>/public/uploads/pdf_files/files/<?= $result['document_file'];?>',</script>
    <script src="<?= base_url();?>/public/assets/pdf_sign/syncptrn/lib/webviewer.min.js"></script>
    <script src="<?= base_url();?>/public/assets/pdf_sign/syncptrn/samples/old-browser-checker.js"></script>
    <script src="<?= base_url();?>/public/assets/pdf_sign/syncptrn/samples/global.js"></script>
    <title>JavaScript PDF Viewer Demo</title>
    <script src="<?= base_url();?>/public/assets/pdf_sign/syncptrn/samples/modernizr.custom.min.js"></script>
   <?php /*?> <script src="<?= base_url();?>/public/assets/pdf_sign/syncptrn/samples/viewing/viewing/viewing.js"></script><?php */?>
  </head>
  <body>
    <header>
      <div class="title sample">Demo: PDF Viewer</div>
    </header>
    <?php /*?><aside>
      <h1>Controls</h1>
      <h2>Choose a file to view</h2>
      <select id="select" style="width: 100%">
        <option value="http://localhost/cz/timehrm_local_dav/public/uploads/pdf_files/files/doc615b5f3da87ae.pdf">https://pdftron.s3.amazonaws.com/downloads/pl/demo-annotated.pdf</option>

        <option value="https://pdftron.s3.amazonaws.com/downloads/pl/report.docx">https://pdftron.s3.amazonaws.com/downloads/pl/report.docx</option>
        <option value="https://pdftron.s3.amazonaws.com/downloads/pl/presentation.pptx">https://pdftron.s3.amazonaws.com/downloads/pl/presentation.pptx</option>

        <option value="http://localhost/cz/timehrm_local_dav/public/uploads/pdf_files/files/doc615b5f3da87ae.pdf">https://pdftron.s3.amazonaws.com/downloads/pl/encrypted-foobar12.pdf</option>
      </select>
    </aside><?php */?>
    <div id="viewer"></div>
    <script src="<?= base_url();?>/public/assets/pdf_sign/syncptrn/samples/menu-button.js"></script>

    <!--ga-tag-->

    <script>
      Modernizr.addTest('async', function() {
        try {
          var result;
          eval('let a = () => {result = "success"}; let b = async () => {await a()}; b()');
          return result === 'success';
        } catch (e) {
          return false;
        }
      });

      // test for async and fall back to code compiled to ES5 if they are not supported
      ['<?= base_url();?>/public/assets/pdf_sign/syncptrn/samples/viewing/viewing/viewing.js'].forEach(function(js) {
        var script = Modernizr.async ? js : js.replace('.js', '.ES5.js');
        var scriptTag = document.createElement('script');
        scriptTag.src = script;
        scriptTag.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(scriptTag);
      });
    </script>
  </body>
</html>
