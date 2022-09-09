 <?php $testimonies = $generic->getFromTable("content", "status=1, type=testimony", 0, 4);
  ?>
 <section class="customer-review-tab ptb-120 bg-light position-relative z-2">
   <div class="container">
     <div class="row justify-content-center align-content-center">
       <div class="col-md-10 col-lg-6">
         <div class="section-heading text-center">
           <h4 class="h5 text-primary">Testimonial</h4>
           <h2>What the world is saying</h2>
           <p>Helping our audience keep track of what's happening in the crypto and stock markets with our daily symbol snapshots.</p>
         </div>
       </div>
     </div>
     <div class="row">
       <div class="col-12">
         <div class="tab-content" id="testimonial-tabContent">
           <?php foreach ($testimonies as $key => $value) {
              $show = empty($key) ? "active show" : ""; ?>
             <div class="tab-pane fade <?= $show ?>" id="testimonial-tab-<?= $key ?>" role="tabpanel">
               <div class="row align-items-center justify-content-between">
                 <div class="col-lg-6 col-md-6">
                   <div class="testimonial-tab-content mb-5 mb-lg-0 mb-md-0">
                     <img src="assets/img/testimonial/quotes-left.svg" alt="testimonial quote" width="65" class="img-fluid mb-32">
                     <blockquote class="blockquote">
                       <h1><?= $value->label ?></h1>
                       <p><?= $value->body ?></p>
                     </blockquote>
                     <div class="author-info mt-4">
                       <h6 class="mb-0"><?= $value->title ?></h6>
                     </div>
                   </div>
                 </div>
                 <div class="col-lg-5 col-md-6">
                   <div class="author-img-wrap pt-5 ps-5">
                     <div class="testimonial-video-wrapper position-relative">
                       <img src="<?= strip_tbn($value->image) ?>" class="img-fluid rounded-custom shadow-lg" alt="testimonial author">
                       <div class="position-absolute bg-secondary-dark z--1 dot-mask dm-size-16 dm-wh-350 top--40 left--40 top-left"></div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           <?php } ?>
         </div>
       </div>
     </div>
     <div class="row">
       <div class="col-12">
         <ul class="nav nav-pills testimonial-tab-menu mt-60" id="testimonial" role="tablist">
           <?php foreach ($testimonies as $key => $value) {
              $show = empty($key) ? "active show" : "";  ?>
             <li class="nav-item" role="presentation">
               <div class="nav-link d-flex align-items-center rounded-custom border border-light border-2 testimonial-tab-link <?= $show ?>" data-bs-toggle="pill" data-bs-target="#testimonial-tab-<?= $key ?>" role="tab" aria-selected="false">
                 <div class="testimonial-thumb me-3">
                   <img src="<?= $value->image ?>" width="50" class="rounded-circle" alt="testimonial thumb">
                 </div>
                 <div class="author-info">
                   <h6 class="mb-0"><?= $value->title ?></h6>
                   <span></span>
                 </div>
               </div>
             </li>
           <?php } ?>
         </ul>
       </div>
     </div>
   </div>
 </section>