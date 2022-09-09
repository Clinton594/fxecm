<?php require_once("{$generic->dashboard}includes/client-auth.php") ?>
<?php
$status = $paramControl->load_sources("approval");
$transactions = $generic->getFromTable("transaction", "user_id={$user->id}", 1, 0, ID_DESC);
$colors = ["warning", "success", "danger", "primary"]
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Transactions - <?= $company->name ?></title>
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
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Home</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="<?= $uri->site ?>account">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Transactions</li>
          </ul>
          <div class="section-body">

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4>History</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="table" class="table table-bordered my-4 float-start w-100">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Tx Type</th>
                            <th>Tx No</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php foreach ($transactions as $key => $transaction) {
                            $date = new DateTime($transaction->date); ?>
                            <tr>
                              <th><?= $key + 1 ?></th>
                              <td><?= strtoupper($transaction->tx_type) ?></td>
                              <td><?= $transaction->tx_no ?></td>
                              <td><?= $currency . $fmn->format($transaction->amount) ?></td>
                              <td><?= $transaction->description ?></td>
                              <td class="align-middle">
                                <?= $date->format("Y-m-d") ?>
                              </td>
                              <td>
                                <?php
                                if ($transaction->tx_type === "invoice" && empty($transaction->status)) { ?>
                                  <span class="pay"> <a href="javascript:;" onclick="loadPayment('<?= $uri->site ?>payment?hash=<?= $transaction->tx_no ?>&_k=<?= $transaction->id ?>')">pay</a> </span>
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
    </div>
  </div>
  <?php require_once("{$generic->dashboard}includes/client-footer.php") ?>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#table").DataTable()
    })
  </script>
</body>

</html>