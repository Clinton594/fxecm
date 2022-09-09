  <?php
  require_once("{$generic->dashboard}includes/client-auth.php");
  require_once("{$generic->dashboard}includes/client-auth-redirect.php");
  ?>
  <?php
  $datatypes = $paramControl->load_sources("datatypes")->picture;
  $countries = $paramControl->load_sources("countries");
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
    <title>Confirm Email - <?= $company->name ?></title>
    <?php require_once("{$generic->dashboard}includes/client-links.php") ?>
  </head>

  <body>
    <?php require_once("{$generic->dashboard}includes/client-loader.php") ?>
    <div id="app">
      <section class="section auth-bg" style="background-image: url(<?= $backgroundImage ?>);">
        <div class="auth-overlay"></div>
        <div class="container mt-5">
          <div class="row">
            <div class="col-lg-4 col-sm-10 offset-lg-4">
              <div class="card card-primary">
                <div class="card-header flex-column">
                  <div class="card-header rounded justify-content-between bg-primary">
                    <a href="<?= $uri->site ?>"><img src="<?= $company->logo_ref ?>" height="30px"></a>
                    <h4 class="text-white">Confirm Email</h4>
                  </div>
                  <p class="text-center text-wrap">
                    <small>
                      <center>Click on the "Send Code" button below, also check your spam folder.</center>
                    </small>
                  </p>
                </div>
                <div class="card-body">
                  <div class="mb-3 d-flex justify-content-end">
                    <?php require_once("{$generic->dashboard}includes/translator.php") ?>
                  </div>
                  <form method="POST" id="register-form">
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="phone">Enter Email Code</label>
                        <div class="position-relative">
                          <input type="number" class="form-control send-code" data-code="verify-email" id="code" name="pin" />
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="submit btn btn-primary btn-lg btn-block w-100">Confirm Email</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <script src="<?= $uri->backend ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= $uri->backend ?>js/controllers.js"></script>
    <script>
      $(document).ready(() => {
        $(".loader").fadeOut("slow");
        $("#register-form").submitForm({
          process_url: `${site.process}custom`,
          case: `confirm-email`
        }, (data) => {
          data.push({
            name: "pinAction",
            value: $("#code").data("code")
          });
          return data
        }, (response) => {
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