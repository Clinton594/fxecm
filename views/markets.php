<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
  <title>Markets - <?= $company->name ?></title>
  <?php require_once("includes/links.php") ?>
</head>

<body>
  <!-- preloader begin -->
  <?php require_once("includes/loader.php") ?>
  <!-- preloader end -->
  <?php require_once("includes/header.php") ?>
  <div class="uk-section uk-padding-remove-vertical in-liquid-breadcrumb">
    <div class="uk-container">
      <div class="uk-grid">
        <div class="uk-width-1-1">
          <ul class="uk-breadcrumb">
            <li><span>Markets</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb content end -->
  <main>
    <!-- section content begin -->
    <div class="uk-section">
      <div class="uk-container">
        <div class="uk-grid-match uk-grid-medium uk-child-width-1-2@s uk-child-width-1-3@m in-card-10" data-uk-grid>
          <div class="uk-width-1-1">
            <h2 class="uk-margin-remove">Trade <span class="in-highlight">Types</span>.</h2>
            <p class="uk-text-lead uk-text-muted uk-margin-remove">Trade the way you want with 3 flexible trade types.</p>
          </div>
          <div>
            <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
              <picture>
                <img src="<?= $uri->site ?>assets/img/trade_type_cfds.webp" alt="">
              </picture>
              <h4 class="uk-margin-top">
                <b>CFDs</b>
              </h4>
              <hr>
              <p>Trade with leverage and low spreads for better returns on successful trades.</p>
            </div>
          </div>
          <div>
            <div class="uk-card uk-card-default uk-card-body uk-border-rounded ">
              <picture>
                <img src="<?= $uri->site ?>assets/img/trade_type_digitaloptions.webp" alt="">
              </picture>
              <h4 class="uk-margin-top">
                <b>Miltipliers</b>
              </h4>
              <hr>
              <p>Multiply your potential profit without risking more than your stake.</p>
            </div>
          </div>
          <div>
            <div class="uk-card uk-card-default uk-card-body uk-border-rounded ">
              <picture>
                <img src="<?= $uri->site ?>assets/img/trade_type_multipliers.webp" alt="">
              </picture>
              <h4 class="uk-margin-top uk-float-center">
                <b>Digital Options</b>
              </h4>
              <hr>
              <p>Earn fixed payouts by predicting asset price movements.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
    <!-- section content begin -->
    <div class="uk-section">
      <div class="uk-container">
        <div class="uk-grid">
          <div class="uk-width-2-3@m">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-width-auto@m">
                <i class="fas fa-money-bill-wave fa-2x in-icon-wrap circle large primary-color uk-margin-right"></i>
              </div>
              <div class="uk-width-expand">
                <h3>Why trade with <?= $company->name ?>?</h3>
                <p>Client trust is our highest priority, and that’s why millions of users choose us. Here are some of the things that make us a leading online trading service provider.</p>
                <div class="uk-grid uk-child-width-1-1 uk-child-width-1-2@m">
                  <div>
                    <ul class="uk-list uk-list-bullet in-list-check">
                      <li>Direct Market Access (DMA)</li>
                      <li>Leverage up to 1:500</li>
                      <li>T+0 settlement</li>
                      <li>Dividends paid in cash</li>
                    </ul>
                  </div>
                  <div class="in-margin-top-10@s in-margin-bottom-40@s">
                    <ul class="uk-list uk-list-bullet in-list-check">
                      <li>Free from UK Stamp Duty</li>
                      <li>Short selling available</li>
                      <li>Commissions from 0.08%</li>
                      <li>Access to 1500 global shares</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="uk-width-1-3@m">
            <h3>Our Shares offer</h3>
            <table class="uk-table uk-table-divider uk-table-striped uk-text-small uk-text-center">
              <thead>
                <tr>
                  <th class="uk-text-center">Name</th>
                  <th class="uk-text-center">Initial Deposit</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Apple Inc CFD</td>
                  <td>10%</td>
                </tr>
                <tr>
                  <td>Alibaba CFD</td>
                  <td>10%</td>
                </tr>
                <tr>
                  <td>Facebook CFD</td>
                  <td>10%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="uk-section">
      <div class="uk-container">
        <div class="uk-grid-match uk-grid-medium uk-child-width-1-2@s uk-child-width-1-3@m in-card-10" data-uk-grid>
          <div class="uk-width-1-1">
            <h2 class="uk-margin-remove">Trading <span class="in-highlight">Markets</span>.</h2>
            <p>Some believe you must choose between an online broker and a wealth management firm. At Liquid, you don’t need to compromise. Whether you invest on your own, with an advisor, or a little of both — we can support you.</p>
          </div>
          <div class="uk-width-1-2">
            <h4>Crypto</h4>
            <div class="tradingview-widget-container">
              <div class="tradingview-widget-container__widget"></div>
              <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
                {
                  "width": "100%",
                  "height": 490,
                  "defaultColumn": "overview",
                  "screener_type": "crypto_mkt",
                  "displayCurrency": "USD",
                  "colorTheme": "light",
                  "locale": "en"
                }
              </script>
            </div>
          </div>
          <div class="uk-width-1-2">
            <h4>Forex</h4>
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
              <div class="tradingview-widget-container__widget"></div>
              <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
                {
                  "width": "100%",
                  "height": 490,
                  "defaultColumn": "overview",
                  "defaultScreen": "general",
                  "market": "forex",
                  "showToolbar": true,
                  "colorTheme": "light",
                  "locale": "en"
                }
              </script>
            </div>
          </div>
          <div>
            <div class="uk-card uk-card-default uk-card-body uk-border-rounded ">
              <picture>
                <img src="<?= $uri->site ?>assets/img/markets/stock.png" alt="">
              </picture>
              <h4 class="uk-margin-top">
                <b>Stock</b>
              </h4>
            </div>
          </div>
          <div>
            <div class="uk-card uk-card-default uk-card-body uk-border-rounded ">
              <picture>
                <img src="<?= $uri->site ?>assets/img/markets/indices.png" alt="">
              </picture>
              <h4 class="uk-margin-top">
                <b>Indices</b>
              </h4>
            </div>
          </div>
          <div>
            <div class="uk-card uk-card-default uk-card-body uk-border-rounded ">
              <picture>
                <img src="<?= $uri->site ?>assets/img/markets/commodities.png" alt="">
              </picture>
              <h4 class="uk-margin-top uk-float-center">
                <b>Commodities</b>
              </h4>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- section content end -->
    <!-- section content begin -->
    <div class="uk-section">
      <div class="uk-container">
        <div class="uk-grid">
          <div class="uk-width-1-1 in-card-16">
            <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
              <div class="uk-grid uk-flex-middle" data-uk-grid>
                <div class="uk-width-1-1 uk-width-expand@m">
                  <h3>Get up to $600 plus 60 days of commission-free stocks &amp; forex trades</h3>
                </div>
                <div class="uk-width-auto">
                  <a class="uk-button uk-button-primary uk-border-rounded" href="<?= $uri->site ?>sign-up">Open an Account</a>
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