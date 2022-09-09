  <?php
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
    <title>Sign In - <?= $company->name ?></title>
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

              <div class="card">
                <div class="login">
                  <form method="POST" id="register_frm">
                    <div class="card shadow-lg card-primary">
                      <div class="card-header justify-content-between bg-danger">
                        <a href="<?= $uri->site ?>"><img src="<?= $company->favicon2 ?>" height="30px"></a>
                        <h4 class="text-white">Securely sign in</h4>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="form-group col-12">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control forgot-element" name="email" />
                            <div class="invalid-feedback"></div>
                          </div>

                          <div class="form-group col-12">
                            <label for="password" class="d-block">Type your password</label>
                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" />
                            <div id="pwindicator" class="pwindicator">
                              <div class="bar"></div>
                              <div class="label"></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <a class="custom-control-label forgot-password" for="agree">Forgot Password</a>
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="submit btn btn-danger btn-lg btn-block">Login</button>
                        </div>
                      </div>
                      <div class="mb-4 text-muted text-center">Not Registered? <a href="<?= $uri->site ?>sign-up">Create Account</a></div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="mb-3 d-flex justify-content-end">
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
        $("#register_frm").loginForm({
          formName: "loginMembers",
          return_values: true,
          forgoTPassword: true,
        }, function(response) {
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