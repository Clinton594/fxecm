<?php
require_once("{$generic->dashboard}includes/client-auth.php");
$transactions = $generic->getFromTable("transaction", "user_id={$session->user_id}, status=1", 1, 0, ID_DESC);
$transactionx = array_group($transactions, "tx_type");
// see($transactionx);
$deposits = $withdrawn = $reward = $topup = $invest = [];
if (isset($transactionx["deposit"])) $deposits = $transactionx["deposit"];
if (isset($transactionx["invest"])) $invest = $transactionx["invest"];
if (isset($transactionx["withdrawal"])) $withdrawn = $transactionx["withdrawal"];
if (isset($transactionx["topup"])) $topup = $transactionx["topup"];
if (isset($transactionx["bonus"])) $reward = $transactionx["bonus"];

$investments = $generic->getFromTable("accounts", "user_id={$session->user_id}", 1, 0, ID_DESC);

$current = array_filter($investments, function ($x) {
  return $x->status == 1;
});

$earning = array_filter($topup, function ($x) use ($current) {
  return in_array($x->account_id, array_column($current, "id"));
});

$tiers = $paramControl->load_sources("referral-bonus");

$chart = dashboard_data($user->id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Dashboards - <?= $company->name ?></title>
  <?php require_once("{$generic->dashboard}includes/client-links.php") ?>
</head>

<body>
  <canvas class="d-none"><?= json_encode($chart) ?></canvas>
  <?php require_once("{$generic->dashboard}includes/client-loader.php") ?>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?php require_once("{$generic->dashboard}includes/client-sidebar.php") ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Home</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="<?= $uri->site ?>account"> <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ul>
          <div class="row">
            <div class="col-12">
              <div class="bg-style mb-5">
                <div>
                  <h1>Welcome <?= ucfirst($session->greeting) ?> <?= $user->first_name ?></h1>
                  <p>Get extra <?= $tiers->tier1 ?>% when you refer someone using the referral program link below.</p>
                  <button data-clipboard-text="<?= $uri->site ?>referral/<?= $user->username ?>" class="btn btn-icon icon-right btn-primary"><i class="far fa-copy"></i> Copy your referral link</button>
                </div>
                <div>
                  <img width="100%" src="<?= $generic->dashboard ?>assets/img/banner/stats-rafiki.png" alt="" srcset="">
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-6 col-6">
              <div class="card l-bg-style1">
                <div class="card-statistic-3">
                  <div class="card-icon card-icon-large"><i class="fa fa-dollar-sign"></i></div>
                  <div class="card-content">
                    <h4 class="card-title">Available Balance</h4>
                    <strong><?= $currency . $fmn->format($user->balance) ?></strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-6 col-6">
              <div class="card l-bg-style5">
                <div class="card-statistic-3">
                  <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                  <div class="card-content">
                    <h4 class="card-title text-truncate">Active Investment</h4>
                    <strong>
                      <?= $currency . $fmn->format($fmn->parse(array_sum(array_column($current, "amount")))) ?>
                    </strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-6 col-6">
              <div class="card l-bg-style3">
                <div class="card-statistic-3">
                  <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                  <div class="card-content">
                    <h4 class="card-title">Current Earning</h4>
                    <strong>
                      <?= $currency . $fmn->format($fmn->parse(array_sum(array_column($earning, "amount")))) ?>
                    </strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-6 col-6">
              <div class="card l-bg-style2">
                <div class="card-statistic-3">
                  <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                  <div class="card-content">
                    <h4 class="card-title">Total Invested</h4>
                    <strong><?= $currency . $fmn->format($fmn->parse(array_sum(array_column($invest, "amount")))) ?></strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-6 col-6">
              <div class="card l-bg-style3">
                <div class="card-statistic-3">
                  <div class="card-icon card-icon-large"><i class="fa fa-globe"></i></div>
                  <div class="card-content">
                    <h4 class="card-title">Total Earning</h4>
                    <strong><?= $currency . $fmn->format($fmn->parse(array_sum(array_column($topup, "amount")))) ?></strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-6 col-6">
              <div class="card l-bg-style4">
                <div class="card-statistic-3">
                  <div class="card-icon card-icon-large"><i class="fa fa-money-bill-alt"></i></div>
                  <div class="card-content">
                    <h4 class="card-title">Total withdrawn</h4>
                    <strong><?= $currency . $fmn->format($fmn->parse(array_sum(array_column($withdrawn, "amount")))) ?></strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Earnings Chart</h4>
                </div>
                <div class="card-body">
                  <div id="chart1"></div>
                </div>
              </div>
            </div>

          </div>
          <!-- Trading View Charts -->
          <div class="row">
            <div class="col-12 col-sm-12">
              <div class="card">
                <div class="card-header flex-column">
                  <h4>Cryptocurrency Market Widget</h4>
                  <p class="text-muted mb-2 font-15 text-truncate">This widget displays crypto assets and then sorts them by their market capitalization and trends.</p>
                </div>
                <div class="card-body">
                  <!-- TradingView Widget BEGIN -->
                  <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/cryptocurrencies/prices-all/" rel="noopener" target="_blank"><span class="blue-text">Cryptocurrency Markets</span></a> by TradingView</div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
                      {
                        "width": "100%",
                        "height": 490,
                        "defaultColumn": "moving_averages",
                        "screener_type": "crypto_mkt",
                        "displayCurrency": "USD",
                        "colorTheme": "light",
                        "locale": "en"
                      }
                    </script>
                  </div>
                  <!-- TradingView Widget END -->
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12">
              <div class="card">
                <div class="card-header flex-column">
                  <h4>Forex Cross Rates Widget</h4>
                  <p class="text-muted mb-2 font-15 text-truncate">This allows you to display real-time quotes of selected currencies in comparison to other major currencies.</p>
                </div>
                <div class="card-body">
                  <!-- TradingView Widget BEGIN -->
                  <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-forex-cross-rates.js" async>
                      {
                        "width": "100%",
                        "height": "500",
                        "currencies": [
                          "EUR",
                          "USD",
                          "JPY",
                          "GBP",
                          "CHF",
                          "AUD",
                          "CAD",
                          "NZD",
                          "CNY",
                          "TRY",
                          "SEK",
                          "NOK",
                          "DKK",
                          "ZAR",
                          "HKD",
                          "SGD",
                          "THB",
                          "MXN",
                          "IDR",
                          "KRW",
                          "PLN"
                        ],
                        "isTransparent": true,
                        "colorTheme": "light",
                        "locale": "en"
                      }
                    </script>
                  </div>
                  <!-- TradingView Widget END -->
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php require_once("{$generic->dashboard}includes/client-footer.php") ?>
      <script src="<?= $uri->site . $generic->dashboard ?>assets/js/apexchart.js<?= $cache_control ?>"></script>
      <script src="<?= $uri->site . $generic->dashboard ?>assets/js/jqvmap.js<?= $cache_control ?>"></script>
    </div>
  </div>
</body>

</html>