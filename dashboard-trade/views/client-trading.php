<?php require_once("{$generic->dashboard}includes/client-auth.php") ?>
<?php
$status = $paramControl->load_sources("approval");
$plans = $generic->getFromTable("content", "status=1, type=investment", 1, 0);
$plans = array_remap($plans, array_column($plans, "id"));

$transactions = $generic->getFromTable("transaction", "user_id={$user->id}, tx_type=topup", 1, 0, ID_DESC);
$colors = ["warning", "success", "danger", "primary"]
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Trade - <?= $company->name ?></title>
  <?php require_once("{$generic->dashboard}includes/client-links.php") ?>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

</head>

<body>
  <?php require_once("{$generic->dashboard}includes/client-loader.php") ?>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?php require_once("{$generic->dashboard}includes/client-sidebar.php") ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <div class="section-body">
            <div class="row">
              <!-- TradingView Widget BEGIN -->
              <div class="tradingview-widget-container col-12">
                <div id="tradingview_d74da"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                <script type="text/javascript">
                  new TradingView.widget({
                    "width": "100%",
                    "height": 700,
                    "symbol": "NASDAQ:AAPL",
                    "interval": "D",
                    "timezone": "Etc/UTC",
                    "theme": "light",
                    "style": "1",
                    "locale": "en",
                    "toolbar_bg": "#f1f3f6",
                    "enable_publishing": false,
                    "withdateranges": true,
                    "hide_side_toolbar": false,
                    "allow_symbol_change": true,
                    "watchlist": [
                      "OANDA:USDJPY",
                      "FX:EURUSD",
                      "OANDA:EURGBP",
                      "FX:USDCHF",
                      "BITSTAMP:BTCUSD",
                      "PHEMEX:ETHUSDT"
                    ],
                    "studies": [
                      "chandeMO@tv-basicstudies",
                      "Volume@tv-basicstudies"
                    ],
                    "container_id": "tradingview_d74da"
                  });
                </script>
              </div>
              <!-- TradingView Widget END -->
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card mt-5">
                  <div class="card-header">
                    <h4>Trading History</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="table" class="table table-bordered my-4 w-100">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Tx No</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php foreach ($transactions as $key => $transaction) {
                            $date = new DateTime($transaction->date); ?>
                            <tr>
                              <th><?= $key + 1 ?></th>
                              <td><?= $transaction->tx_no ?></td>
                              <td><?= $currency . $fmn->format($transaction->amount) ?></td>
                              <td><?= $transaction->description ?></td>
                              <td class="align-middle">
                                <?= $date->format("Y-m-d") ?>
                              </td>
                              <td>
                                <button onclick="popmodal(this)" data-trade='<?= $transaction->temp ?>' class="btn badge bg-<?= $colors[$transaction->status] ?> badge-shadow">
                                  View Details
                                </button>
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
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div id="modal-body" class="modal-body">

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <?php require_once("{$generic->dashboard}includes/client-footer.php") ?>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#table").DataTable()
    })

    function popmodal(el) {
      const data = $(el).data("trade");
      myModal = bootstrap.Modal.getOrCreateInstance(document.querySelector(`#staticBackdrop`));
      $(`#modal-body`).empty();
      $(`#modal-body`).append(() => {
        const tbody = $("<tbody>");
        for (const key in data) {
          if (key !== "increment") {
            const value = data[key];
            tbody.append($("<tr>").append($("<td>").text(key.replace("_", " ").toUpperCase())).append($("<td>").text(value)))
          }
        }
        return $("<table>").addClass("table").append(tbody)
      });
      $("#staticBackdropLabel").text(data.increment);
      myModal.show();
    }
  </script>
</body>

</html>