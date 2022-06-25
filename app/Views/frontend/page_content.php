<?php
use App\Models\MainModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\CmspageModel;
use App\Models\ConstantsModel;
use App\Models\CountryModel;
use App\Models\MembershipModel;
use App\Models\CompanymembershipModel;

$MainModel = new MainModel();
$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$CmspageModel = new CmspageModel();
$ConstantsModel = new ConstantsModel();
$CountryModel = new CountryModel();
$MembershipModel = new MembershipModel();
$CompanymembershipModel = new CompanymembershipModel();

$company_types = $ConstantsModel->where('type','company_type')->orderBy('constants_id', 'ASC')->findAll();
$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();
$membership = $MembershipModel->orderBy('membership_id', 'ASC')->findAll();
$request = \Config\Services::request();
$segment_id = $request->uri->getSegment(2);
$page_id = udecode($segment_id);
$cms_page = $CmspageModel->where('page_id', $page_id)->first();
/* Company Details view
*/		
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$xin_system = $SystemModel->where('setting_id', 1)->first();
?>
<?php echo view('frontend/components/htmlhead'); ?>
   <body>
      <!-- pre loader area start -->
      <div id="loading">
         <div id="loading-center">
            <div id="loading-center-absolute">
               <div class="object" id="object_one"></div>
               <div class="object" id="object_two" style="left:20px;"></div>
               <div class="object" id="object_three" style="left:40px;"></div>
               <div class="object" id="object_four" style="left:60px;"></div>
               <div class="object" id="object_five" style="left:80px;"></div>
            </div>
         </div>  
      </div>
      <!-- pre loader area end -->
      <!-- back to top start -->
      <div class="progress-wrap">
         <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
         </svg>
      </div>
      <!-- back to top end -->
      <!-- header area start -->
      <?php echo view('frontend/components/top_link'); ?>
      <!-- header area end -->
      <!-- sidebar area start -->      
      <div class="body-overlay"></div>
      <!-- sidebar area end -->
      <main>
        <!-- page title area start -->
        <section class="page__title-area page__title-height d-flex align-items-center fix p-relative z-index-1" data-background="<?= base_url();?>/public/frontend/assets/img/page-title/page-title.jpg">
         <div class="page__title-shape">
            <img class="page-title-dot-4" src="<?= base_url();?>/public/frontend/assets/img/page-title/dot-4.png" alt="">
            <img class="page-title-dot" src="<?= base_url();?>/public/frontend/assets/img/page-title/dot.png" alt="">
            <img class="page-title-dot-2" src="<?= base_url();?>/public/frontend/assets/img/page-title/dot-2.png" alt="">
            <img class="page-title-dot-3" src="<?= base_url();?>/public/frontend/assets/img/page-title/dot-3.png" alt="">
            <img class="page-title-plus" src="<?= base_url();?>/public/frontend/assets/img/page-title/plus.png" alt="">
            <img class="page-title-triangle" src="<?= base_url();?>/public/frontend/assets/img/page-title/triangle.png" alt="">
         </div>
           <div class="container">
              <div class="row">
                 <div class="col-xxl-12">
                    <div class="page__title-wrapper text-center">
                       <h3> <?= $cms_page['page_name'];?> </h3>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb justify-content-center">
                              <li class="breadcrumb-item"><a href="<?= site_url('');?>"><?= lang('Frontend.xin_home');?></a></li>
                              <li class="breadcrumb-item active" aria-current="page"><?= $cms_page['page_name'];?></li>
                           </ol>
                        </nav>
                    </div>
                 </div>
              </div>
           </div>
        </section>
       <!-- pricing area start -->
         <section class="services__details pt-115 pb-100">
            <div class="container">
                  <div class="row">
                     <div class="col-xl-12 col-lg-12">
                        <div class="">
                              <?= html_entity_decode($cms_page['page_description']);?>
                        </div>
                     </div>
                  </div>
            </div>
         </section>
         <!-- pricing area end -->
         <!-- cta area start -->
         <!-- cta area end -->
      </main>
      <!-- footer area start -->
      <?php echo view('frontend/components/footer'); ?>
      <!-- footer area end -->
      <!-- JS here -->
      <?php echo view('frontend/components/htmlfooter'); ?>
   </body>
</html>