<?php require_once("{$generic->dashboard}includes/client-auth.php") ?>
<?php
$emptyObject = new stdClass();

$plans = $generic->getFromTable("content", "type=investment, status=1");
$plans = array_remap($plans, array_column($plans, "id"));
$investments = $generic->getFromTable("accounts", "user_id={$session->user_id}", 1, 10, ID_DESC);
// Profits taken per investment
$profits = $generic->getFromTable("transaction", "user_id={$session->user_id}, status=1", 1, 0, ID_DESC);
$profits = array_group($profits, "account_id");


$investments = array_values(array_filter(array_map(function ($plan = null) use ($plans, $profits) {
  if (isset($plans[$plan->plan])) {
    $plan->reinvest = $plans[$plan->plan]->parent;
    $plan->profit   = 0;
    if (isset($profits[$plan->id])) {
      $plan->profit = array_sum(array_column(array_filter($profits[$plan->id], function ($_plan) {
        return $_plan->tx_type == "topup";
      }), "amount"));
    }
    return $plan;
  }
}, $investments)));

$current = array_filter($investments, function ($x) {
  return $x->status == 1;
});

$allowConcurrentWithdrawals = $company->concurrent_withdrawal;
if (empty($allowConcurrentWithdrawals)) {
  $allowConcurrentWithdrawals = count($current) === 0;
}

$status = $paramControl->load_sources("status");
$colors = ["warning", "success", "danger", "primary"];

$user->wallet = isjson($user->wallet);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Withdrawal - <?= $company->name ?></title>
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
            <li class="breadcrumb-item">Withdrawal</li>
          </ul>
          <div class="section-body">
            <div class="row">
              <div class="col-xl-5 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                  <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                      <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                          <div class="card-content">
                            <h5 class="font-15 text-muted">Account Balance</h5>
                            <h2 class="mb-3 font-18"><?= $currency . $fmn->format($user->balance) ?></h2>
                            <div>
                              <?php if (empty($company->lock_withdrawals)) {
                                if ($user->balance > 0 && $allowConcurrentWithdrawals) {
                                  if ($user->wallet != $emptyObject && !empty($user->wallet)) { ?>
                                    <div class="w-100">
                                      <button class="btn btn-icon icon-left btn-primary w-100 fundacct">
                                        <i class="far fa-edit"></i> Withdrawal
                                      </button>
                                    </div>
                                  <?php
                                  } else { ?>
                                    <div>
                                      <p>You have not added withdrawal wallet addreses yet.</p>
                                      <a href="<?= $uri->site ?>wallets?redir=<?= $uri->site ?>withdraw" class="btn btn-warning btn-auto btn-block">Create Wallet</a>
                                    </div>
                                  <?php }
                                } else { ?>
                                  <?php if (empty($user->balance)) { ?>
                                    <small>You'll be able to make withdrawals once you receive your earning.</small>
                                    <hr><br>
                                  <?php } ?>
                                  <?php if (!$allowConcurrentWithdrawals) { ?>
                                    <small>You'll be able to make withdrawals once your current running investments complete.</small>
                                  <?php } ?>
                                <?php }
                              } else { ?><small>Withdrawals are unavailable at the moment.</small> <?php } ?>
                            </div>

                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="<?= $generic->dashboard ?>assets/img/banner/1.png" alt="">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Account Investment History</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-stripped">
                        <tbody>
                          <tr>
                            <th>S/N</th>
                            <th>PLAN</th>
                            <th>CAPITAL</th>
                            <th>PROFITS</th>
                            <th>START DATE</th>
                            <th>COMPLETION DATE</th>
                            <th>STATUS</th>
                          </tr>
                          <?php foreach ($investments as $key => $plan) {
                            $date = new DateTime($plan->date_created);
                            $plan->amount = $plan->amount + $plan->reinvested;
                          ?>
                            <tr>
                              <td><?= $key + 1 ?></td>
                              <td><?= $plan->name ?></td>
                              <td><?= $currency . $fmn->format($plan->amount) ?></td>
                              <td><?= $currency . $fmn->format(($plan->profit)) ?></td>
                              <td class="align-middle">
                                <?= $date->format("jS M, Y") ?>
                              </td>
                              <td>
                                <?php
                                $stop = new DateTime(date("Y-m-d", strtotime("+{$plan->duration}", strtotime($plan->date_created))))
                                ?>
                                <?= $stop->format("jS M, Y") ?>
                              </td>

                              <td>
                                <span class="badge badge-outline bg-<?= $colors[$plan->status] ?> badge-pill"><?= $status[$plan->status] ?></span>
                                <?php if ($plan->status == 2 && !empty($plan->reinvest)) { ?> <button class="btn btn-primary btn-sm float-end" data-plan=<?= $plan->id ?> data-case=reinvest capital=<?= $plan->amount ?>>Reinvest</button> <?php } ?>
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
              <form id="withdraw-form">
                <div class="row">
                  <div class="form-group col-12">
                    <label>Enter Amount</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-dollar-sign"></i>
                        </div>
                      </div>
                      <input type="number" min="<?= $company->other ?>" max="<?= $user->balance ?>" required class="form-control" placeholder="Enter the amount" name="amount">
                    </div>
                  </div>
                  <div class="form-group col-12">
                    <label>Choose Wallet</label>
                    <select name="coin" required class="form-control selectric">
                      <?php foreach ($user->wallet as $key => $value) { ?>
                        <option value="<?= $key ?>"><?= $key ?> - <?= $value ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-12 d-none" id="equivalent">
                    <label>You'll Recieve</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text" id="token"></div>
                      </div>
                      <input type="text" disabled readonly class="form-control">
                    </div>
                  </div>
                  <div class="form-group col-12">
                    <hr>
                    <label>Request OTP Code</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text" id="token">
                          <i class="fas fa-user-lock"></i>
                        </div>
                      </div>
                      <input type="number" name="pin" required class="form-control send-code" data-code="withdrawal">
                    </div>
                    <p>
                      <small>Some OTP codes may be getting stuck in the spam folder.</small>
                    </p>
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
  <script src="<?= $uri->site . $generic->dashboard ?>assets/js/select.min.js"></script>
  <script src="<?= $uri->backend ?>js/swal.js"></script>
  <script>
    $(document).ready(function() {
      $("button[data-case]").click(function() {
        let button = $(this);
        let captial = button.attr("capital")
        Swal.fire({
          title: `Re-Invest this investment ?`,
          text: `Make sure you have up to $${captial} in your dashboard to proceed.`
        }).then(function(value) {
          if (value.isConfirmed) {
            button.startLoader();
            let data = button.data();
            $.post(`${site.process}custom`, data, function(response) {
              button.stopLoader();
              let res = isJson(response)
              if (res.status) {
                window.location.reload();
                toast(res.message);
              } else toast(res.message, "red");
            });
          }
        })
      })
      $(".fundacct").click(() => {
        const myModal = new bootstrap.Modal(document.querySelector('#paymentModal'))
        myModal.show()
      });

      $(".select-coin").click(function() {
        $(this).find("input").attr({
          checked: false
        });
        $(".select-coin").removeClass("btn-primary");
        $(this).addClass("btn-primary").find("input").attr({
          checked: true
        });
      });

      $("#withdraw-form").submitForm({
        process_url: `${site.process}custom`,
        case: "withdrawal"
      }, null, function(response) {
        window.location = `${site.domain}transactions`
      });

      $("#withdraw-form").find("input[name=amount], select").each(function() {
        $(this).change(() => {
          const data = $("#withdraw-form").find("input[name=amount], select").values();
          if (!Object.values(data).some(x => !x)) {
            $.get(`${site.process}custom`, {
              ...data,
              case: "convertCurrency"
            }, (responst) => {
              const response = isJson(responst);
              if (response.status) {
                $("#equivalent").removeClass("d-none")
                $("#equivalent #token").text(response.coin)
                $("#equivalent").find("input").val(response.data)
              } else $("#equivalent").addClass("d-none")
            });
          } else {
            toast("Amount is empty !!!", "bg-primary")
          }
        })
      })
    })
  </script>
</body>

</html>