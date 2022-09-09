<!DOCTYPE html>
<html lang="zxx" dir="ltr">


<head>
  <title>Home - <?= $company->name ?></title>
  <?php require_once("includes/links.php") ?>
</head>

<body>
  <!-- preloader begin -->
  <?php require_once("includes/loader.php") ?>
  <!-- preloader end -->
  <?php require_once("includes/header.php") ?>
  <main>
    <!-- slideshow content begin -->
    <div class="uk-section uk-padding-remove-vertical">
      <div class="uk-light in-slideshow uk-background-cover uk-background-top-center" style="background-image: url(<?= $uri->site ?>assets/img/in-liquid-slide-bg.png);" data-uk-slideshow>
        <ul class="uk-slideshow-items">

          <li>
            <div class="uk-container">
              <div class="uk-grid-medium" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <div class="uk-overlay">
                    <h1>New standard<br>in stock broker.</h1>
                    <p class="uk-text-lead uk-visible@m">Trade forex, commodities, synthetic and stock indices from a single account</p>
                    <a href="<?= $uri->site ?>sign-up" class="uk-button uk-button-default uk-border-rounded uk-visible@s">Open Account</a>
                  </div>
                </div>
                <div class="uk-width-1-2@s">
                  <img class="in-slide-img" src="assets/img/in-lazy.gif" data-src="assets/img/hero_platform4.avif" alt="image-slide" width="500" height="400" data-uk-img>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="uk-container">
              <div class="uk-grid-medium" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <div class="uk-overlay">
                    <h1>Multi-regulated global broker.</h1>
                    <p class="uk-text-lead uk-visible@m">A trusted destination for traders worldwide, Authorised by FCA, ASIC &amp; FSCA</p>
                    <a href="<?= $uri->site ?>sign-in" class="uk-button uk-button-default uk-border-rounded uk-visible@s">Explore</a>
                  </div>
                </div>
                <div class="uk-width-1-2@s">
                  <img class="in-slide-img" src="assets/img/in-lazy.gif" data-src="assets/img/hero_platform2.avif" alt="image-slide" width="500" height="400" data-uk-img>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="uk-container">
              <div class="uk-grid-medium" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <div class="uk-overlay">
                    <h1>Award-winning trading platforms.</h1>
                    <p class="uk-text-lead uk-visible@m">Explore endless trading opportunities with tight spreads and no commission</p>
                    <a href="<?= $uri->site ?>sign-up" class="uk-button uk-button-default uk-border-rounded uk-visible@s">Discover platform</a>
                  </div>
                </div>
                <div class="uk-width-1-2@s">
                  <img class="in-slide-img" src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/p2p_home_banner.webp" alt="image-slide" width="500" height="400" data-uk-img>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="uk-container">
              <div class="uk-grid-medium" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <div class="uk-overlay">
                    <h1>Learn forex with our courses.</h1>
                    <p class="uk-text-lead uk-visible@m">Weekly educational workshops are a great resource for any skill level trader</p>
                    <a href="<?= $uri->site ?>education" class="uk-button uk-button-default uk-border-rounded uk-visible@s">Discover courses</a>
                  </div>
                </div>
                <div class="uk-width-1-2@s">
                  <img class="in-slide-img" src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-slide-3.svg" alt="image-slide" width="500" height="400" data-uk-img>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slideshow-item="next"></a>
        <!-- Markets -->
        <div class="uk-section uk-padding-remove-vertical in-slideshow-features uk-visible@m">
          <div class="uk-container">
            <div class="uk-grid uk-flex uk-flex-center">
              <div class="uk-width-5-6@m">
                <div class="uk-grid uk-child-width-1-6@m uk-text-center" data-uk-grid>
                  <div class="uk-width-1-1">
                    <p class="uk-text-lead">1700+ market. Countless opportunities.</p>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-5.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Forex<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-6.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Indices<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-7.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Crypto<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-8.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Shares<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-9.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Commodities<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-10.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">All Markets<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- slideshow content end -->
    <!-- section content begin -->
    <div class="uk-section in-liquid-6">
      <div class="uk-container">
        <div class="uk-grid uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand@m">
            <h2>Simple. <br> Reliable. <span class="in-highlight">Flexible</span>.</h2>
            <p>
              Trade forex, synthetics, stocks & indices, cryptocurrencies, basket indices, and commodities.
              Tight spreads</p>
            <div class="uk-grid-medium uk-child-width-1-3@s uk-child-width-1-3@m uk-margin-medium" data-uk-grid>
              <div>
                <div class="in-count-wrap">
                  <p class="uk-text-lead uk-margin-remove-bottom count" data-counter-end="1700" data-counter-append="+">0+</p>
                  <p class="uk-text-muted uk-margin-remove-top">Markets</p>
                </div>
              </div>
              <div>
                <div class="in-count-wrap">
                  <p class="uk-text-lead uk-margin-remove-bottom count" data-counter-end="33">0</p>
                  <p class="uk-text-muted uk-margin-remove-top">Contries</p>
                </div>
              </div>
              <div>
                <div class="in-count-wrap">
                  <p class="uk-text-lead uk-margin-remove-bottom count" data-counter-end="23">0</p>
                  <p class="uk-text-muted uk-margin-remove-top">Currencies</p>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-width-3-5@m uk-inline uk-dark">
            <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-object-4.svg" alt="sample-image" data-width data-height data-uk-img>
            <span class="uk-position-absolute uk-transform-center dot-pulse one" style="left: 24%; top: 42%"></span>
            <span class="uk-position-absolute uk-transform-center dot-pulse two" style="left: 26%; top: 32%"></span>
            <span class="uk-position-absolute uk-transform-center dot-pulse one" style="left: 34%; top: 30%"></span>
            <span class="uk-position-absolute uk-transform-center dot-pulse one" style="left: 48%; top: 27%"></span>
            <span class="uk-position-absolute uk-transform-center dot-pulse one" style="left: 54%; top: 30%"></span>
            <span class="uk-position-absolute uk-transform-center dot-pulse two" style="left: 70%; top: 47%"></span>
            <span class="uk-position-absolute uk-transform-center dot-pulse two" style="left: 59%; top: 38%"></span>
            <span class="uk-position-absolute uk-transform-center dot-pulse two" style="left: 76%; top: 53%"></span>
            <span class="uk-position-absolute uk-transform-center dot-pulse one" style="left: 86%; top: 35%"></span>
            <span class="uk-position-absolute uk-transform-center dot-pulse two" style="left: 80%; top: 43%"></span>
            <span class="uk-position-absolute uk-transform-center dot-pulse one" style="left: 89%; top: 72%"></span>
            <p class="uk-text-small uk-text-muted uk-text-center uk-margin-top">Graphic is for illustration purpose only and should not be relied upon for investment decisions.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
    <!-- section content begin -->
    <div class="uk-section in-liquid-7 in-offset-top-10">
      <div class="uk-container">
        <div class="uk-grid uk-flex uk-flex-center">
          <div class="uk-width-5-6@m uk-background-contain uk-background-center-center" style="background-image: url(<?= $uri->site ?>assets/img/in-liquid-7-bg.png);" data-uk-img>
            <div class="uk-text-center">
              <h2 class="uk-margin-remove">Liquid trading platform.</h2>
              <p class="uk-text-lead uk-text-muted uk-margin-small-top">Improve your trading results with our industry-leading technology</p>
            </div>
            <div class="uk-grid-medium uk-child-width-1-3@s uk-child-width-1-3@m uk-text-center uk-margin-top" data-uk-grid>
              <div>
                <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-award.svg" alt="wave-award" width="71" height="58" data-uk-img>
                <h6 class="uk-margin-small-top uk-margin-remove-bottom">Best CFD Broker</h6>
                <p class="uk-text-small uk-margin-remove-top">TradeON Summit 2020</p>
              </div>
              <div>
                <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-award.svg" alt="wave-award" width="71" height="58" data-uk-img>
                <h6 class="uk-margin-small-top uk-margin-remove-bottom">Best Execution Broker</h6>
                <p class="uk-text-small uk-margin-remove-top">Forex EXPO Dubai 2020</p>
              </div>
              <div>
                <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-award.svg" alt="wave-award" width="71" height="58" data-uk-img>
                <h6 class="uk-margin-small-top uk-margin-remove-bottom">Best Trading Platform</h6>
                <p class="uk-text-small uk-margin-remove-top">London Summit 2020</p>
              </div>
            </div>
            <img class="uk-align-center" src="<?= $uri->site ?>assets/img/in-liquid-7-mockup.png" data-src="<?= $uri->site ?>assets/img/in-liquid-7-mockup.png" alt="sample-images" width="691" height="420" data-uk-img>
            <div class="uk-grid-divider uk-child-width-1-2@s uk-child-width-1-4@m uk-text-center in-offset-top-10" data-uk-grid>
              <div>
                <h2 class="uk-margin-small-bottom">~30ms</h2>
                <p class="uk-text-small uk-text-uppercase uk-margin-remove-top">executions speed*</p>
              </div>
              <div>
                <h2 class="uk-margin-small-bottom">24/5</h2>
                <p class="uk-text-small uk-text-uppercase uk-margin-remove-top">support</p>
              </div>
              <div>
                <h2 class="uk-margin-small-bottom">0.0</h2>
                <p class="uk-text-small uk-text-uppercase uk-margin-remove-top">spread from 0.0 pips</p>
              </div>
              <div>
                <h2 class="uk-margin-small-bottom">150+</h2>
                <p class="uk-text-small uk-text-uppercase uk-margin-remove-top">trading instruments</p>
              </div>
            </div>
            <div class="uk-text-center uk-margin-medium-top">
              <a class="uk-button uk-button-primary uk-border-rounded uk-margin-small-right" href="#">Create account<i class="fas fa-angle-right uk-margin-small-left"></i></a>
              <a class="uk-button uk-button-secondary uk-border-rounded" href="#">Discover platform<i class="fas fa-angle-right uk-margin-small-left"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
    <!-- section content begin -->
    <div class="uk-section uk-section-muted uk-padding-large in-liquid-8">
      <div class="uk-container">
        <div class="uk-grid uk-flex uk-flex-center in-offset-bottom-20">
          <div class="uk-width-5-6@m uk-text-center">
            <h2 class="uk-margin-remove">Liquid trading academy.</h2>
            <p class="uk-text-lead uk-text-muted uk-margin-small-top">Explore, Learn, and Grow</p>
            <div class="uk-grid-medium uk-child-width-1-3@m" data-uk-grid>
              <div>
                <div class="uk-card uk-card-default uk-card-body">
                  <h6><i class="fas fa-video uk-margin-small-right"></i>9 Lessons 70+ Videos</h6>
                </div>
              </div>
              <div>
                <div class="uk-card uk-card-default uk-card-body">
                  <h6><i class="fas fa-graduation-cap uk-margin-small-right"></i>Test your Knowledge</h6>
                </div>
              </div>
              <div>
                <div class="uk-card uk-card-default uk-card-body">
                  <h6><i class="fas fa-award uk-margin-small-right"></i>Certificate Awarded</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="uk-grid uk-grid-large uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-3-5@m">
            <div class="uk-inline uk-dark in-liquid-video uk-margin-small-bottom">
              <img class="uk-border-rounded uk-width-1-1" src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-8-image.jpg" alt="sample-images" width="533" height="355" data-uk-img>
              <div class="uk-position-center">
                <a href="#link" data-uk-toggle>
                  <div class="in-play-button"></div>
                  <i class="fas fa-play"></i>
                </a>
              </div>
              <div class="uk-flex-top" data-uk-modal>
                <div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical in-iframe">
                  <button class="uk-modal-close-outside" type="button" data-uk-close></button>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-width-expand@m">
            <h3>What you will learn</h3>
            <ul class="uk-list uk-list-bullet in-list-check">
              <li>Introduction to Financial Trading</li>
              <li>Technical Analysis</li>
              <li>Fundamental Analysis</li>
              <li>When to Enter & Exit Trades</li>
              <li>How to Manage Risk</li>
              <li>Trading Psychology</li>
            </ul>
            <a class="uk-button uk-button-primary uk-border-rounded uk-margin-small-top" href="#">Create demo account now<i class="fas fa-angle-right uk-margin-small-left"></i></a>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
    <!-- section content begin -->
    <div class="uk-section in-liquid-9">
      <div class="uk-container">
        <div class="uk-grid uk-flex uk-flex-center">
          <div class="uk-width-5-6@m uk-text-center">
            <h2 class="uk-margin-remove">Choose the best account type for you.</h2>
            <div class="uk-grid-medium uk-child-width-1-3@s uk-child-width-1-5@m uk-margin-medium-top in-offset-bottom-20" data-uk-grid>
              <div>
                <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-11.svg" alt="sample-icon" width="82" height="82" data-uk-img>
                <p>Individual accounts</p>
              </div>
              <div>
                <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-12.svg" alt="sample-icon" width="82" height="82" data-uk-img>
                <p>Join accounts</p>
              </div>
              <div>
                <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-13.svg" alt="sample-icon" width="82" height="82" data-uk-img>
                <p>Trust accounts</p>
              </div>
              <div>
                <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-14.svg" alt="sample-icon" width="82" height="82" data-uk-img>
                <p>Family account</p>
              </div>
              <div>
                <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-15.svg" alt="sample-icon" width="82" height="82" data-uk-img>
                <p>Institutional</p>
              </div>
            </div>
            <p class="uk-text-small uk-margin-medium-top in-text-devices"><span>Trade anywhere, anytime using our various platforms.</span></p>
            <div class="uk-card uk-card-default uk-card-body uk-box-shadow-small">
              <div class="uk-grid-divider uk-child-width-1-2@s uk-child-width-1-4@m" data-uk-grid>
                <div>
                  <i class="fab fa-apple"></i>
                  <p class="uk-text-small">MacOS/iPhone</p>
                </div>
                <div>
                  <i class="fab fa-android"></i>
                  <p class="uk-text-small">Android app</p>
                </div>
                <div>
                  <i class="fab fa-windows"></i>
                  <p class="uk-text-small">Windows 10</p>
                </div>
                <div>
                  <i class="fab fa-chrome"></i>
                  <p class="uk-text-small">WebTrader</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
  </main>
  <?php require_once("includes/footer.php") ?>
</body>

</html>