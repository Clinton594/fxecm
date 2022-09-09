<?php
require_once("{$generic->dashboard}includes/client-auth.php");
$investments = $generic->getFromTable("content", "type=investment, type=category, status=1");
$investments = array_remap($investments, array_column($investments, "id"));
$plans = array_filter($investments, function ($v) {
  return $v->type == "investment";
});
$categ = array_map(function ($v) {
  unset($v->body);
  return $v;
}, array_filter($investments, function ($v) {
  return $v->type == "category";
}));
$grouped_plans = array_group($plans, "category");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title> Packages - <?= $company->name ?></title>
  <?php require_once("{$generic->dashboard}includes/client-links.php") ?>
</head>

<body>
  <?php require_once("{$generic->dashboard}includes/client-loader.php") ?>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?php require_once("{$generic->dashboard}includes/client-sidebar.php") ?>
      <!-- Main Content -->
      <div class="main-content">
        <form class="section" id="invest-form">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Home</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="<?= $uri->site ?>account">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Trading Engines</li>
          </ul>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <h3 class="d-flex align-items-center"><span class="bg-primary circle me-3">1</span>Purchase a Trading Bot</h3>
              </div>
            </div>
            <?php foreach ($grouped_plans as $key => $plans) { ?>
              <div class="row">
                <div class="col-12">
                  <h4><?= $key ?></h4>
                </div>
                <?php foreach ($plans as $key1 => $plan) { ?>
                  <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing">
                      <div class="pricing-title">
                        <?= $plan->title ?>
                      </div>
                      <div class="pricing-padding">
                        <div class="pricing-price">
                          <div><?= $val = round(calculate_roi($plan), 2) ?>%</strong></div>
                          <div>In <?= $plan->product ?></div>
                        </div>
                        <div class="pricing-details">
                          <div class="pricing-item">
                            <div class="pricing-item-icon"><i class="fas fa-dollar-sign"></i></div>
                            <div class="pricing-item-label"><strong>Limits:</strong> <span class="pamount11"><?= $currency . $fmn->format($plan->business) ?></span> - <span class="pamount12"><?= $currency . $fmn->format($plan->label) ?></span></div>
                          </div>

                          <div class="pricing-item">
                            <div class="pricing-item-icon"><i class="fa fa-redo"></i></div>
                            <div class="pricing-item-label"><small> <?= $plan->auto ?>% every <?= $plan->view ?></small></div>
                          </div>
                          <div class="pricing-item">
                            <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                            <div class="pricing-item-label">Live Support</div>
                          </div>
                        </div>
                      </div>
                      <div class="pricing-cta">
                        <a href="javascript:;" class="select-plan" data-val="<?= $val ?>" data-duration="<?= $plan->product ?>">
                          Select
                          <i class="fas fa-arrow-right"></i>
                          <input type="radio" hidden name="plan_id" required value="<?= $plan->id ?>"></a>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>

            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="d-flex align-items-center"><span class="bg-primary circle me-3">2</span> Choose Amount</h3>
                </div>
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col bg-black py-3 mb-2 rounded">
                      <div class="d-flex mb-3">
                        <div class="card-circle l-bg-orange text-white me-3">
                          <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div>
                          <h6 class="text-muted mb-0">Available Balance</h6>
                          <span class="font-weight-bold mb-0"><?= $currency . $fmn->format($user->balance) ?></span>
                        </div>
                      </div>
                      <hr>
                      <?php if (empty($user->balance)) { ?>
                        <div>
                          <p>Your account balance is empty.</p>
                          <a href="<?= $uri->site ?>fund-account" class="btn btn-icon icon-left btn-warning shadow-sm">
                            <i class="fas fa-check-double"></i>
                            Fund Account Now
                          </a>
                        </div>
                      <?php } else { ?>
                        <div>
                          <div class="row g-3 align-items-center justify-content-between">
                            <div class="col-auto">
                              <div class="input-group">
                                <div class="input-group-text"><i class="fa fa-dollar-sign"></i> </div>
                                <input type="number" tep="any" id="plan_amount" name="amount" class="form-control" placeholder="Enter amount" required>
                              </div>
                              <label for="">Enter the amount you wish to invest</label>
                            </div>
                            <div class="col-auto">
                              <div class="input-group">
                                <div class="input-group-text"><i class="fa fa-dollar-sign"></i> </div>
                                <div class="form-control" id="equivalent">0.00</div>
                                <div class="input-group-text" id="duration"> </div>
                              </div>
                              <label for="">Total Profit to earn</label>
                            </div>
                            <div class="col-auto">
                              <button class="submit btn btn-icon icon-left btn-warning shadow-sm">
                                <i class="far fa-paper-plane"></i>
                                Invest
                              </button>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      </form>
    </div>

  </div>
  </div>
  <?php require_once("{$generic->dashboard}includes/client-footer.php") ?>
  <script>
    $(document).ready(function() {
      $("#plan_amount").change(() => {
        calc_price();
      })

      $(".select-plan").click(function() {
        $(this).find("input").attr({
          checked: false
        });
        $(".select-plan").removeClass("bg-primary");
        $(this).addClass("bg-primary").find("input").attr({
          checked: true
        });
        calc_price();
      });

      if ($("#invest-form button.submit").length) {
        $("#invest-form").submitForm({
          process_url: `${site.process}custom`,
          case: "invest"
        }, null, function(response) {
          window.location = `${site.domain}withdraw`
        });
      }
    })

    function calc_price() {
      let box = $(".select-plan.bg-primary");
      if (box.length) {
        let roi = box.attr("data-val");
        let dur = box.attr("data-duration");
        let amount = $("#plan_amount").val();
        if (amount = parseInt(amount)) {
          amount += ((amount * roi) / 100);
          $("#equivalent").text(amount.toFixed(2));
          $("#duration").text(` in ${dur}`);
        } else {
          $("#equivalent").text("0.00");
          $("#duration").text("")
        }
      } else toast("Select a plan", "red");
    }
  </script>
</body>

</html>