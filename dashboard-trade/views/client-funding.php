<?php require_once("{$generic->dashboard}includes/client-auth.php") ?>
<?php
$status = $paramControl->load_sources("approval");
$transactions = $generic->getFromTable("transaction", "tx_type=invoice, tx_type=deposit, user_id={$user->id}", 1, 0, ID_DESC);
$colors = ["warning", "success", "danger", "primary"]
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Fund Account - <?= $company->name ?></title>
  <?php require_once("{$generic->dashboard}includes/client-links.php") ?>
</head>

<body>
  <?php require_once("{$generic->dashboard}includes/client-loader.php") ?>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?php require_once("{$generic->dashboard}includes/client-sidebar.php") ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Home</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="<?= $uri->site ?>account">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Fund Account</li>
          </ul>
          <div class="section-body">
            <div class="row">
              <div class="col-12 mb-4">
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                  <div class="tradingview-widget-container__widget"></div>
                  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
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
                          "description": "Apple",
                          "proName": "NASDAQ:AAPL"
                        },
                        {
                          "description": "Tesla",
                          "proName": "NASDAQ:TSLA"
                        },
                        {
                          "description": "USDJPY",
                          "proName": "OANDA:USDJPY"
                        }
                      ],
                      "colorTheme": "light",
                      "isTransparent": false,
                      "showSymbolLogo": true,
                      "locale": "en"
                    }
                  </script>
                </div>
                <!-- TradingView Widget END -->
              </div>
            </div>
            <div class="row">
              <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                  <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                      <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                          <div class="card-content">
                            <h5 class="font-15">Account Balance</h5>
                            <h2 class="mb-3 font-18"><?= $currency . $fmn->format($user->balance) ?></h2>
                            <div class="col-xl-4 offset-xl-4 d-block d-lg-none">
                              <button class="btn btn-icon icon-left btn-primary w-100 fundacct"><i class="far fa-edit"></i> Fund Account</button>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="<?= $generic->dashboard ?>assets/img/banner/4.png" alt="">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 offset-xl-4 d-none d-lg-block">
                <button class="btn btn-icon icon-left btn-primary btn-lg mt-5 fundacct"><i class="far fa-edit"></i> Fund Account</button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Account Funding History</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th>Tx No</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                          <?php foreach ($transactions as $key => $transaction) {
                            $date = new DateTime($transaction->date); ?>
                            <tr>
                              <td><?= $transaction->tx_no ?></td>
                              <td><?= $currency . $fmn->format($transaction->amount) ?></td>
                              <td class="align-middle">
                                <?= $date->format("Y-m-d") ?>
                              </td>
                              <td>
                                <?php
                                if ($transaction->tx_type === "invoice" && empty($transaction->status)) { ?>
                                  <span class="pay"> <a href="javascript:;" class="btn btn-sm btn-primary" onclick="loadPayment('<?= $uri->site ?>payment?hash=<?= $transaction->tx_no ?>&_k=<?= $transaction->id ?>', this)">Pay Now</a> </span>
                                <?php } else { ?>
                                  <span class="badge bg-<?= $colors[$transaction->status] ?> badge-shadow"><?= $status[$transaction->status] ?></span>
                                <?php } ?>
                              </td>
                            </tr>
                          <?php } ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="formModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="formModal">Fund Account</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="fund-form">
                <div class="form-group">
                  <label>Enter Amount</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-dollar-sign"></i>
                      </div>
                    </div>
                    <input type="number" required class="form-control" placeholder="Enter the amount" name="amount">
                  </div>
                </div>
                <div class="form-group">
                  <label>Choose payment method</label>
                  <div class="border py-2 d-flex">
                    <?php foreach ($coins as $key => $coin) { ?>
                      <div class="select-coin">
                        <div class="user-item">
                          <img alt="<?= $coin->name ?>" height="30px" src="<?= $coin->logo ?>">
                          <span> <small><?= $coin->name ?></small> </span>
                          <div class="user-details d-none">
                            <input type="radio" hidden name="PSys" required value="<?= $coin->id ?>">
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                    <div class="select-coin">
                      <div class="user-item">
                        <img alt="Bank" height="30px" src="<?= $uri->site . $generic->dashboard ?>assets/img/bank-transfer-transparent.png">
                        <span> <small>Wire Transfer</small> </span>
                        <div class="user-details d-none">
                          <input type="radio" hidden name="PSys" required value="0">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="submit float-right btn-icon and icon-right btn btn-primary m-t-15 waves-effect">Proceed <i class="fa fa-arrow-right"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once("{$generic->dashboard}includes/client-footer.php") ?>
  <script>
    $(document).ready(function() {
      $(".fundacct").click(() => {
        const myModal = new bootstrap.Modal(document.querySelector('#paymentModal'))
        myModal.show()
      });

      $(".select-coin").click(function() {
        $(".select-coin").find("input").attr({
          checked: false
        });
        $(".select-coin").removeClass("btn-primary");
        $(this).addClass("btn-primary").find("input").attr({
          checked: true
        });
      });

      $("#fund-form").submitForm({
        process_url: `${site.process}custom`,
        case: "fund-account"
      }, null, function(response) {
        loadPayment(`${site.domain}payment?hash=${response.data.hash_key}&_k=${response.data.key}`)
      });
    })
  </script>
</body>

</html>