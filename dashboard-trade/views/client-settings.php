<?php
require_once("{$generic->dashboard}includes/client-auth.php");
$reg = new DateTime($user->date);
$gender = $paramControl->load_sources("gender");
$countries = $paramControl->load_sources("countries");
$bonus = $paramControl->load_sources("referral-bonus");
$tiercount = count((array)$bonus);

// Wallets
$user->wallet = json_decode($user->wallet);
$coins = array_values(
  array_filter($coins, function ($coin = null) {
    return $coin->withdrawal;
  })
);
$coins = array_remap($coins, array_column($coins, "symbol"));

// referrals
$users = $generic->getFromTable("users");
$users = array_remap($users, array_column($users, "id"));
$refss = $generic->getFromTable("referral");

$referals = array_values(array_filter($refss, function ($x) use ($user) {
  return $x->referral_id === $user->id;
}));

$activeReferals = array_values(array_filter($referals, function ($x) {
  return $x->amount > 0;
}));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title><?= $user->first_name ?> on <?= $company->name ?></title>
  <?php require_once("{$generic->dashboard}includes/client-links.php") ?>
</head>

<body data-page=<?= $uri->page_source ?>>
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
            <li class="breadcrumb-item">Profile</li>
          </ul>
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4" id="profile">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      <img alt="image" src="<?= $user->picture_ref ?>" class="rounded-circle author-box-picture">
                      <div class="clearfix"></div>
                      <div class="author-box-name">
                        <a href="#"><?= $user->first_name ?> <?= $user->last_name ?></a>
                      </div>
                      <hr>
                    </div>
                    <div class="py-4">
                      <p class="clearfix">
                        <span class="float-left">
                          Username
                        </span>
                        <span class="float-right text-muted">
                          <?= $user->username ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Registered On
                        </span>
                        <span class="float-right text-muted">
                          <?= $reg->format("jS M Y") ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Phone
                        </span>
                        <span class="float-right text-muted">
                          <?= $user->phone ?>
                        </span>
                      </p>

                      <p class="clearfix">
                        <span class="float-left">
                          Upline
                        </span>
                        <span class="float-right text-muted">
                          <?= get_upline($user->id)->username ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Active Direct Referrals
                        </span>
                        <span class="float-right text-muted">
                          <?= count($activeReferals)  ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Direct Referrals
                        </span>
                        <span class="float-right text-muted">
                          <?= count($referals)  ?>
                        </span>
                      </p>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="settings-tab2" data-bs-toggle="tab" href="#settings" role="tab" aria-selected="true">Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="wallets-tab2" data-bs-toggle="tab" href="#wallets" role="tab" aria-selected="false">Wallets</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="join-affiliate-tab2" data-bs-toggle="tab" href="#join-affiliate" role="tab" aria-selected="false">Referrals</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="settings-tab2">
                        <form method="post" class="needs-validation">
                          <div class="card-header">
                            <h4>Edit Profile</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>First Name</label>
                                <input type="text" class="form-control" required name="first_name" value="<?= $user->first_name ?>">
                              </div>
                              <div class="form-group col-md-6 col-12">
                                <label>Last Name</label>
                                <input type="text" class="form-control" required name="last_name" value="<?= $user->last_name ?>">
                                <input type="hidden" hidden class="form-control" required name="id" value="<?= $user->id ?>">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>Country</label>
                                <select name="country" required class="form-control selectric" value="<?= $user->country ?>">
                                  <?php foreach ($countries as $key => $value) { ?>
                                    <option <?php if ($key == $user->country) { ?> selected <?php } ?> value="<?= $key ?>"><?= $value ?></option>
                                  <?php } ?>
                                </select>
                              </div>

                              <div class="form-group col-md-6 col-12">
                                <label>Phone</label>
                                <input type="tel" required class="form-control" name="phone" value="<?= $user->phone ?>">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>Gender</label>
                                <select name="gender" required class="form-control selectric" value="<?= $user->gender ?>">
                                  <?php foreach ($gender as $key => $value) { ?>
                                    <option <?php if ($key == $user->gender) { ?> selected <?php } ?> value="<?= $key ?>"><?= $value ?></option>
                                  <?php } ?>
                                </select>
                              </div>

                            </div>
                            <div class="row">
                              <div class="col-md-6 offset-md-6">
                                <button type="submit" class="submit btn float-end btn-primary">Save Changes</button>
                              </div>
                            </div>
                          </div>

                        </form>
                      </div>
                      <div class="tab-pane fade" id="wallets" role="tabpanel" aria-labelledby="wallets-tab2">
                        <form id="wallets-form" method="post" class="needs-validation">
                          <div class="card-header">
                            <h4>Edit Wallets</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <?php foreach ($coins as $key => $value) {
                                $address = $tag = ""; ?>
                                <?php if (!empty($user->wallet->{$value->symbol})) {
                                  list($address, $tag) = explode(",", "{$user->wallet->{$value->symbol}},");
                                } ?>

                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label><?= $value->name ?> (<?= $value->network ?>)</label>
                                    <input placeholder="Paste your <?= $value->symbol ?> wallet address here" name="<?= $value->symbol ?>" <?php if (!empty($address)) { ?> value="<?= $address ?>" <?php } ?> autocomplete="off" type="text" class="form-control">
                                  </div>
                                  <hr>
                                </div>
                              <?php } ?>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Request OTP Code
                                  </label>
                                  <div>
                                    <input class="form-control send-code" name="pin" required value="" autocomplete="off" size="8" type="number" data-code="wallet">
                                  </div>
                                  <p style="line-height: normal">
                                    <small>Some OTP codes may be getting stuck in the spam folder.</small>
                                  </p>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="h-100" style="display: flex;flex-direction: column;justify-content: center;align-items: flex-end;">
                                  <button type="submit" class="submit btn btn-primary float-end">Save Changes</button>
                                </div>
                              </div>
                            </div>
                          </div>

                        </form>
                      </div>
                      <div class="tab-pane fade" id="join-affiliate" role="tabpanel" aria-labelledby="join-affiliate-tab2">
                        <div class="card-header">
                          <h4> Referral Lists </h4>
                        </div>
                        <div class="card-body">
                          <p>New participants who register using your affiliate link become your referrals. Our affiliate program offers <?= $tiercount ?>-tier compensation system for new referrals.</p>

                          <ul>
                            <?php foreach ($bonus as $key => $value) { ?>
                              <li>
                                <?= strtoupper($key) ?> gets <?= $value ?>% commission.
                              </li>
                            <?php } ?>
                          </ul>
                          <p>You can promote your affiliate link in any legal way. We provide all the necessary promotional materials and all kinds of support.</p>
                          <h6>Downlines</h6>
                          <div>
                            <?php if (isset($referals) && count($referals)) { ?>
                              <div class="table-responsive">
                                <p>My direct referrals and their downlines</p>
                                <table class="table">
                                  <thead>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Direct Referrals</th>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($referals as $key => $referal) { ?>
                                      <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $users[$referal->referred_id]->username ?> </td>
                                        <td><?= $referal->amount > 0 ? "Active" : "No Deposit Yet" ?></td>
                                        <td><?php $date = new DateTime($referal->date) ?> <?= $date->format("jS M, Y") ?></td>
                                        <td><?= $c = count(array_values(array_filter($refss, function ($x) use ($referal) {
                                              return $x->referral_id === $referal->referred_id;
                                            }))) ?> Referral<?= $c > 1 ? "s" : "" ?></td>
                                      </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            <?php } else { ?>
                              <div class="alert alert-light"> No data </div>
                            <?php }
                            ?>
                          </div>
                        </div>
                      </div>
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
  <script src="<?= $uri->site . $generic->dashboard ?>assets/js/select.min.js"></script>
  <script>
    $(document).ready(function() {
      const page = $("body").data("page");
      if ($(`#${page}-tab2`).length) {
        $(".nav-link, .tab-pane").removeClass("active show");
        $(`#${page}-tab2`).addClass("active")
        $(`#${page}`).addClass("active show");

        $(".nav-link").click(function() {
          const page = $(this).attr("href").replace("#", "");
          if (window.innerWidth < 500 && page !== "settings") {
            $("#profile").fadeOut()
          } else $("#profile").fadeIn();
          window.history.pushState({}, "", page);
        });
        let url = new String(window.location);
        if (url.indexOf('?') === -1) {
          $(`#${page}-tab2`).click()
        }
      }
      $('#wallets form').submitForm({
          case: "submit-wallet",
          process_url: `${site.process}custom`,
          validation: "normal"
        },
        function(formdata) {
          return filterObj(formdata);
        },
        function(response) {

          setTimeout(() => {
            let url = new String(window.location);
            if (url.indexOf('?') != -1) {
              url = url.split("=")[1];
            }
            window.location = url;
          }, 1500)
        });

      $('#settings form').submitForm({
          formName: "user-profile",
          validation: "strict"
        },
        null,
        function(response) {
          console.log(response);
        });
    });

    function filterObj(param) {
      let returnArray = [];
      let collectionObj = {};
      for (const key in param) {
        const object = param[key];
        const name = object.name;
        const value = object.value;
        if (collectionObj[name] === undefined) {
          collectionObj[name] = [];
        }
        collectionObj[name].push(value);
      }
      for (const key in collectionObj) {
        const value = collectionObj[key].join(',');
        returnArray.push({
          name: key,
          value: value
        })
      }
      return returnArray;
    }
  </script>
</body>

</html>