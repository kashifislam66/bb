<?php
use App\Models\SystemModel;
use App\Models\CmspageModel;
use App\Models\FrontendcontentModel;

$SystemModel = new SystemModel();
$CmspageModel = new CmspageModel();
$FrontendcontentModel = new FrontendcontentModel();

$cms_page = $CmspageModel->where('page_id', 3)->first();
/* Home page view
*/		
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$xin_system = $SystemModel->where('setting_id', 1)->first();
$frontend_content = $FrontendcontentModel->where('frontend_id', 1)->first();
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
      <!-- sidebar area end -->      
      <div class="body-overlay"></div>
      <!-- sidebar area end -->
      <main>
         <!-- hero area start -->
         <section class="hero__area hero__height-2 p-relative d-flex align-items-center">
            <div class="hero__shape-2">
               <img class="hero-2-dot" src="<?= base_url();?>/public/frontend/assets/img/icon/hero/home-2/hero-2-dot.png" alt="">
               <img class="hero-2-dot-2" src="<?= base_url();?>/public/frontend/assets/img/icon/hero/home-2/hero-2-dot-2.png" alt="">
               <img class="hero-2-flower" src="<?= base_url();?>/public/frontend/assets/img/icon/hero/home-2/hero-2-flower.png" alt="">
               <img class="hero-2-triangle" src="<?= base_url();?>/public/frontend/assets/img/icon/hero/home-2/hero-2-triangle.png" alt="">
               <img class="hero-2-triangle-2" src="<?= base_url();?>/public/frontend/assets/img/icon/hero/home-2/hero-2-triangle-2.png" alt="">
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-5 col-xl-6 col-lg-8">
                     <div class="hero__content-2 mt-55">
                        <span class="hero__pre-title"><?= lang('Frontend.xin_analytics');?></span>
                        <h2 class="hero__title-2"><?= lang('Frontend.xin_bring_your_team_together');?></h2>
                        <p><?= lang('Frontend.xin_succ_move_your_employees');?></p>
                        <a href="<?= site_url('register');?>" class="w-btn w-btn-blue w-btn-7 w-btn-6"><?= lang('Frontend.xin_try_for_free');?></a>

                        <div class="hero__client mt-60">
                           <ul>
                              <li><img src="<?= base_url();?>/public/frontend/assets/img/client/home-2/client-2-1.png" alt=""></li>
                              <li><img src="<?= base_url();?>/public/frontend/assets/img/client/home-2/client-2-2.png" alt=""></li>
                              <li><img src="<?= base_url();?>/public/frontend/assets/img/client/home-2/client-2-3.png" alt=""></li>
                              <li><img src="<?= base_url();?>/public/frontend/assets/img/client/home-2/client-2-4.png" alt=""></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-6 offset-xxl-1 col-xl-6">
                     <div class="hero__thumb-2 mt-80">
                        <div class="hero__thumb-inner p-relative ml-60">
                           <img class="hero-2-thumb" width="700" height="400" src="<?= base_url();?>/public/frontend/assets/img/hero/home-2/hero-2-thumb.png" alt="">
                           <div class="promotion__play" style="border:2px solid #7127ea; border-radius:50%;">
                           <a href="<?= $frontend_content['youtube_url'];?>" data-fancybox="" class="pulse-play"><i class="arrow_triangle-right"></i></a>
                        </div>
                           <img class="hero-2-girl" src="<?= base_url();?>/public/frontend/assets/img/hero/home-2/hero-2-girl.png" alt="">
                           <img class="hero-2-thumb-sm" src="<?= base_url();?>/public/frontend/assets/img/hero/home-2/hero-2-thumb-sm.png" alt="">
                           <img class="hero-2-thumb-sm-2" src="<?= base_url();?>/public/frontend/assets/img/hero/home-2/hero-2-thumb-sm-2.png" alt="">
                           <img class="hero-2-thumb-sm-3" src="<?= base_url();?>/public/frontend/assets/img/hero/home-2/hero-2-thumb-sm-3.png" alt="">
                           <img class="hero-2-circle" src="<?= base_url();?>/public/frontend/assets/img/hero/home-2/hero-2-circle.png" alt="">
                           <img class="hero-2-circle-2" src="<?= base_url();?>/public/frontend/assets/img/hero/home-2/hero-2-circle-2.png" alt="">
                           <img class="hero-2-leaf" src="<?= base_url();?>/public/frontend/assets/img/hero/home-2/hero-2-leaf.png" alt="">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- hero area end -->
         <!-- services area start -->
         <?= html_entity_decode($cms_page['page_description']);?>
         <!-- cta area end -->
      </main>
      <!-- footer area start -->
      <?php echo view('frontend/components/footer'); ?>
      <!-- footer area end -->
      <!-- JS here -->
      <?php echo view('frontend/components/htmlfooter'); ?>
   </body>
</html>

