<?php
$datatypes = $paramControl->load_sources("datatypes")->picture;
$countries = $paramControl->load_sources("countries");
$gender = $paramControl->load_sources("gender");
$dir = "{$generic->dashboard}assets/img/image-gallery/";
$bgImages = array_filter(_readDir($dir), function ($x) use ($datatypes) {
  $ext = strtolower(pathinfo($x, PATHINFO_EXTENSION));
  return in_array($ext, $datatypes);
});
$backgroundImage = $uri->site . $dir . $bgImages[array_rand($bgImages)];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Signup - <?= $company->name ?></title>
  <?php require_once("{$generic->dashboard}includes/client-links.php") ?>
</head>

<body>
  <?php require_once("{$generic->dashboard}includes/client-loader.php") ?>
  <div id="app">
    <section class="section auth-bg" style="background-image: url(<?= $backgroundImage ?>);">
      <div class="auth-overlay"></div>
      <div class="container mt-5">
        <div class="row">

          <div class="col-lg-8 d-none d-lg-block">
            <div class="card bg-transparent d-flex h-100 align-items-center flex-column justify-content-center shadow-sm">
              <img src="<?= $company->favicon2 ?>" alt="<?= $company->name ?>" srcset="">
              <h4 class="text-white text-center" id="content">If you're signed up for a season, see it through. <br> You don't have to stay forever, but at least stay until you see it through.</h4>
            </div>
          </div>
          <div class="col-lg-4 col-sm-10">

            <div class="card card-primary">
              <div class="card-header">
                <div class="card-header rounded justify-content-between bg-info">
                  <a href="<?= $uri->site ?>"><img src="<?= $company->favicon2 ?>" height="30px"></a>
                  <h4 class="text-white">Create Account</h4>
                </div>
              </div>
              <div class="card-body">
                <form method="POST" id="register_frm">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="frist_name">First Name</label>
                      <input id="frist_name" type="text" class="form-control" required name="first_name" autofocus />
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Last Name</label>
                      <input id="last_name" type="text" class="form-control" required name="last_name" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" required name="email" />
                      <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-6">
                      <label for="phone">Phone</label>
                      <input id="phone" type="tel" class="form-control" required name="phone" />
                      <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-6">
                      <label for="country">Country</label>
                      <select name="country" class="form-control" required id="">
                        <option value="" disabled selected>Select country</option>
                        <?php foreach ($countries as $key => $value) { ?>
                          <option value="<?= $key ?>"><?= $value ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="gender">Gender</label>
                      <select required name="gender" class="form-control" id="">
                        <option value="" disabled selected>Select gender</option>
                        <?php foreach ($gender as $key => $value) { ?>
                          <option value="<?= $key ?>"><?= $value ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Type a valid Password</label>
                      <input id="password" type="password" required class="form-control pwstrength" data-indicator="pwindicator" name="password" />
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" required type="password" class="form-control" name="password2" />
                    </div>
                  </div>
                  <?php if ($uri->page_source == "referral" && !empty($uri->content_id)) { ?>
                    <div class="form-group col-12">
                      <input type="hidden" name="referral" value="<?= $uri->content_id ?>">
                      <div class="form-control">Referred by <strong><?= strtoupper($uri->content_id) ?></strong></div>
                    </div>
                  <?php } ?>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input required type="checkbox" name="agree" class="custom-control-input" id="agree" />
                      <label class="custom-control-label" for="agree">I agree with the <a href="<?= $uri->site ?>terms">terms and conditions</a></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="submit btn btn-info btn-lg btn-block">Register</button>
                  </div>
                </form>
              </div>
              <div class="mb-4 text-muted text-center">Already Registered? <a href="<?= $uri->site ?>sign-in">Sign In</a></div>
            </div>
            <div class="d-flex justify-content-end">
              <?php require_once("{$generic->dashboard}includes/translator.php") ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="<?= $uri->backend ?>js/jquery-3.3.1.min.js"></script>
  <script src="<?= $uri->backend ?>js/controllers.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(".loader").fadeOut("slow");
      $("#register_frm").submitForm({
        formName: "loginMembers",
        return_values: true
      }, null, function(response) {
        setTimeout(() => {
          let url = new String(window.location);
          if (url.indexOf('?') != -1) {
            url = url.split("=")[1];
          } else {
            url = site.domain + "account";
          }
          window.location = url;
        }, 1500);
      })
    })
  </script>
</body>

</html>