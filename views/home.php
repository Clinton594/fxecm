<?php $plans = $generic->getFromTable("content", "status=1, type=investment", 1, 4) ?>
<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
  <title>Home - <?= $company->name ?></title>
  <?php require_once("includes/links.php") ?>
  <style>
    @media screen and (max-width: 760px) {
      .uk-slideshow-items {
        min-height: 75vh !important;
      }

      .uk-slideshow-items h1 {
        min-height: unset !important;
      }


      .uk-slideshow-items .uk-text-lead {
        display: block !important;
        font-size: small !important;
      }
    }
  </style>
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
                    <p class="uk-text-lead">Trade forex, commodities, synthetic and stock indices from a single account</p>
                    <a href="<?= $uri->site ?>sign-up" class="uk-button uk-button-default uk-border-rounded uk-visible@m">Open Account</a>
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
                  <img class="in-slide-img" src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-7-mockup.png" alt="image-slide" width="500" height="400" data-uk-img>
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
                    <p class="uk-text-lead">Our markets with countless opportunities.</p>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-5.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Forex<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-6.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Synthetics<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-7.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Crypto<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-8.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Stock<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-9.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Commodities<i class="fas fa-angle-right uk-margin-small-left"></i></a>
                  </div>
                  <div class="slide-icons-1">
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-10.svg" alt="sample-icon" width="48" height="48" data-uk-img>
                    <a class="uk-button uk-button-text uk-align-center" href="<?= $uri->site ?>markets">Explore<i class="fas fa-angle-right uk-margin-small-left"></i></a>
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
        <div class="uk-grid" style="width: 100%; position:relative">
          <div class="tradingview-widget-container" style="position: absolute;top: -90px;">
            <div class="tradingview-widget-container__widget"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
              {
                "symbols": [{
                    "proName": "FOREXCOM:SPXUSD",
                    "title": "S&P 500"
                  },
                  {
                    "proName": "FOREXCOM:NSXUSD",
                    "title": "US 100"
                  },
                  {
                    "proName": "FX_IDC:EURUSD",
                    "title": "EUR/USD"
                  },
                  {
                    "proName": "BITSTAMP:BTCUSD",
                    "title": "Bitcoin"
                  },
                  {
                    "proName": "BITSTAMP:ETHUSD",
                    "title": "Ethereum"
                  },
                  {
                    "description": "Solana",
                    "proName": "BINANCE:SOLUSDT"
                  }
                ],
                "showSymbolLogo": true,
                "colorTheme": "light",
                "isTransparent": false,
                "displayMode": "adaptive",
                "locale": "en"
              }
            </script>
          </div>
        </div>
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
    <div class="uk-section in-liquid-2">
      <div class="uk-container">
        <div class="uk-grid-large uk-child-width-1-2@m uk-grid" data-uk-grid="">
          <div class="uk-flex uk-flex-left uk-first-column">
            <div class="uk-margin-right">
              <img src="<?= $uri->site ?>assets/img/in-liquid-icon-1.svg" data-src="assets/img/in-liquid-icon-1.svg" alt="sample-icon" width="128" height="128" data-uk-img="">
            </div>
            <div>
              <h3>Proven track record</h3>
              <p><?= $company->name ?> – the co-owners of the Binary.com brands – has a history that dates back to 1999 when we laid the groundwork for the world’s first fixed-odds trading service.</p>
              <a class="uk-button uk-button-text" href="<?= $uri->site ?>about">Learn more<i class="fas fa-long-arrow-alt-right uk-margin-small-left"></i></a>

            </div>
          </div>
          <div class="uk-flex uk-flex-left">
            <div class="uk-margin-right">
              <img src="<?= $uri->site ?>assets/img/in-liquid-icon-2.svg" data-src="assets/img/in-liquid-icon-2.svg" alt="sample-icon" width="128" height="128" data-uk-img="">
            </div>
            <div>
              <h3>Licensed and regulated</h3>
              <p><?= $company->name ?> is regulated by several entities including the Malta Financial Services Authority (MFSA), the Labuan Financial Services Authority (Labuan FSA)...</p>
              <a class="uk-button uk-button-text" href="<?= $uri->site ?>about">Learn more<i class="fas fa-long-arrow-alt-right uk-margin-small-left"></i></a>

            </div>
          </div>
          <div class="uk-flex uk-flex-left uk-grid-margin uk-first-column">
            <div class="uk-margin-right">
              <img src="<?= $uri->site ?>assets/img/in-liquid-icon-3.svg" data-src="assets/img/in-liquid-icon-3.svg" alt="sample-icon" width="128" height="128" data-uk-img="">
            </div>
            <div>
              <h3>Client money protection</h3>
              <p><?= $company->name ?> does not use your money for its business interests and you are allowed to withdraw your money at any time. </p>
              <a class="uk-button uk-button-text" href="<?= $uri->site ?>about">Learn more<i class="fas fa-long-arrow-alt-right uk-margin-small-left"></i></a>

            </div>
          </div>
          <div class="uk-flex uk-flex-left uk-grid-margin">
            <div class="uk-margin-right">
              <img src="<?= $uri->site ?>assets/img/in-liquid-icon-4.svg" data-src="assets/img/in-liquid-icon-4.svg" alt="sample-icon" width="128" height="128" data-uk-img="">
            </div>
            <div>
              <h3>Risk awareness and management</h3>
              <p>Online trading is exciting but involves risks and can lead to an addiction. At <?= $company->name ?>, we look out for our customers’ responsible trading.</p>
              <a class="uk-button uk-button-text" href="<?= $uri->site ?>about">Learn more<i class="fas fa-long-arrow-alt-right uk-margin-small-left"></i></a>
            </div>
          </div>
        </div>
        <div class="uk-grid uk-flex uk-flex-center">
          <div class="uk-width-5-6@m uk-margin-medium-top">
            <div class="uk-card uk-card-default uk-card-body uk-background-contain uk-background-top-left" style="background-image: url(img/in-liquid-card-bg.png);" data-uk-img="">
              <div class="uk-grid uk-child-width-1-3@s uk-child-width-1-3@m uk-text-center uk-grid-stack" data-uk-grid="">
                <div class="uk-width-1-1 uk-first-column">
                  <h4><span>Simple steps to start trade.</span></h4>
                </div>
                <div class="uk-first-column">
                  <span class="in-icon-wrap circle">1</span>
                  <p>Register account</p>
                </div>
                <div class="uk-first-column">
                  <span class="in-icon-wrap circle">2</span>
                  <p>Fund your account</p>
                </div>
                <div class="uk-first-column">
                  <span class="in-icon-wrap circle">3</span>
                  <p>Start your trade</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
    <div class="uk-section uk-section-muted uk-padding-large in-liquid-3 uk-background-contain uk-background-center-center" style="background-image: url(img/in-liquid-3-bg.png);" data-uk-img="">
      <div class="uk-container">
        <div class="uk-grid uk-flex uk-flex-center">
          <div class="uk-width-5-6@m uk-inline">
            <div class="uk-grid-large uk-flex uk-flex-middle uk-flex-right uk-grid uk-grid-stack" data-uk-grid="">
              <div class="uk-position-top-left uk-first-column">
                <img src="assets/img/in-liquid-3-mockup.png" data-src="assets/img/in-liquid-3-mockup.png" alt="sample-images" width="650">
              </div>
              <div class="uk-width-1-2@m uk-first-column">
                <span class="uk-label in-liquid-label uk-margin-bottom">Coming soon on multiple platform</span>
                <h2 class="uk-margin-remove">World class platform<br>trade without a doubt.</h2>
                <p>Choose from 3 powerful platforms — each designed with your needs in mind.</p>
                <div class="uk-grid-small uk-child-width-1-3 uk-child-width-1-4@m uk-margin-medium-top uk-text-center uk-grid" data-uk-grid="">
                  <div class="uk-first-column">
                    <i class="fab fa-apple in-icon-wrap"></i>
                    <p class="uk-text-small">MacOS</p>
                  </div>
                  <div>
                    <i class="fab fa-windows in-icon-wrap"></i>
                    <p class="uk-text-small">Windows</p>
                  </div>
                  <div>
                    <i class="fab fa-google-play in-icon-wrap"></i>
                    <p class="uk-text-small">Android</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- section content begin -->
    <div class="uk-section in-liquid-9">
      <div class="uk-container">
        <div class="uk-grid uk-flex uk-flex-center">
          <div class="uk-width-5-6@m uk-text-center">
            <h2 class="uk-margin-remove">Choose the best account type for you.</h2>

            <p class="uk-text-small uk-margin-medium-top in-text-devices"><span>Trade anywhere, anytime using any of our various platforms.</span></p>
            <div class="uk-card uk-card-default uk-card-body uk-box-shadow-small">
              <div class="uk-grid-divider uk-child-width-1-2@s uk-child-width-1-4@m" data-uk-grid>
                <?php foreach ($plans as $key => $plan) { ?>
                  <div>
                    <img src="<?= $uri->site ?>assets/img/in-lazy.gif" data-src="<?= $uri->site ?>assets/img/in-liquid-icon-<?= 11 + $key ?>.svg" alt="sample-icon" width="30" height="30" data-uk-img>
                    <b class="uk-text-small"><?= $plan->title ?></b>
                    <p class="uk-text-small uk-margin-small-top">
                      <small><b>Minimum</b> - <?= $currency . $fmn->format($plan->business) ?></small>
                      <br>
                      <small><b>Maximum</b> - <?= $currency . $fmn->format($plan->label) ?></small>
                      <br>
                      <small><b>ROI</b> - <?= $plan->auto ?>%</small>
                    </p>
                    <a href="<?= $uri->site ?>invest" style="font-size: xx-small; line-height:33px" class="uk-button uk-button-default uk-border-rounded">Proceed</a>
                  </div>
                <?php } ?>
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