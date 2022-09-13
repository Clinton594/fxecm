 <footer>
   <!-- footer content begin -->
   <div class="uk-section uk-section-secondary in-footer-feature uk-margin-medium-top">
     <div class="uk-container">
       <div class="uk-grid uk-flex uk-flex-center">
         <div class="uk-width-5-6@m">
           <div class="uk-grid uk-child-width-1-3@s" data-uk-grid>
             <div class="uk-flex uk-flex-middle">
               <div class="uk-margin-right">
                 <i class="fas fa-history in-icon-wrap"></i>
               </div>
               <div>
                 <h6 class="uk-margin-remove"><?= date("Y") - 1999 ?> years of Excellence</h6>
               </div>
             </div>
             <div class="uk-flex uk-flex-middle uk-flex-center@m">
               <div class="uk-margin-right">
                 <i class="fas fa-trophy in-icon-wrap"></i>
               </div>
               <div>
                 <h6 class="uk-margin-remove">15+ Global Awards</h6>
               </div>
             </div>
             <div class="uk-flex uk-flex-middle uk-flex-right@m">
               <div class="uk-margin-right">
                 <i class="fas fa-phone-alt in-icon-wrap"></i>
               </div>
               <div>
                 <h6 class="uk-margin-remove">24/5 Customer Support</h6>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="uk-section uk-background-secondary uk-light">
     <div class="uk-container uk-text-small">
       <div class="uk-child-width-1-2@m" data-uk-grid>
         <div class="in-footer-logo">
           <img src="assets/img/in-lazy.gif" data-src="<?= $company->logo_ref ?>" alt="logo" width="127" height="27" data-uk-img>
         </div>
       </div>
       <div class="uk-child-width-1-2@s uk-child-width-1-4@m uk-margin-large-top" data-uk-grid>
         <div>
           <h5>Pages</h5>
           <ul class="uk-list uk-link-text">
             <li><a href="<?= $uri->site ?>">Home</a></li>
             <li><a href="<?= $uri->site ?>about">About Us</a></li>
             <li><a href="<?= $uri->site ?>markets">Markets</a></li>
             <li><a href="<?= $uri->site ?>education">Training </a></li>
           </ul>
         </div>
         <div>
           <h5>Partner Platforms</h5>
           <ul class="uk-list uk-link-text">
             <li><a href="https://www.youtube.com/c/TradeAcademy">Trade Academy</a></li>
             <li><a href="#">Trading apps</a></li>
             <li><a href="https://www.metatrader5.com">MetaTrader 5</a></li>
           </ul>
         </div>
         <div>
           <h5>Account Types</h5>
           <ul class="uk-list uk-link-text">
             <li><a href="<?= $uri->site ?>sign-in">Demo account</a></li>
             <li><a href="<?= $uri->site ?>sign-in">Standart account</a></li>
             <li><a href="<?= $uri->site ?>sign-in">ECN account</a></li>
           </ul>
         </div>
         <div>
           <h5>Learn to Trade </h5>
           <ul class="uk-list uk-link-text">
             <li><a href="<?= $uri->site ?>contact">Premium Training</a></li>
             <li><a href="<?= $uri->site ?>contact">Contact Us</a></li>
             <li><a href="<?= $uri->site ?>faq">FAQ</a></li>
           </ul>
         </div>
       </div>
       <div class="uk-grid uk-margin-large-top">
         <div class="uk-width-1-1">
           <p class="uk-heading-line uk-margin-large-bottom"><span>Copyright ©<?= date("Y") ?> <?= $company->name ?> Inc. All Rights Reserved.</span></p>
           <p class="in-trading-risk">Trading derivatives and leveraged products carries a high level of risk, including the risk of losing substantially more than your initial investment. It is not suitable for everyone. Before you make any decision in relation to a financial product you should obtain and consider our Product Disclosure Statement (PDS) and Financial Services Guide (FSG) available on our website and seek independent advice if necessary</p>
         </div>
       </div>
     </div>
   </div>
   <!-- footer content end -->
   <!-- totop begin -->
   <div class="uk-visible@m">
     <a href="#" class="in-totop fas fa-chevron-up" data-uk-scroll></a>
   </div>
   <?php require_once("includes/support.php") ?>
 </footer>
 <!-- Javascript -->
 <script src="<?= $uri->site ?>assets/js/vendors/uikit.min.js"></script>
 <script src="<?= $uri->site ?>assets/js/vendors/blockit.min.js<?= $cache_control ?>"></script>
 <script src="<?= $uri->site ?>assets/js/config-theme.js"></script>