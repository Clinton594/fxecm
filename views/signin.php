<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
  <title>Sign In - <?= $company->name ?></title>
  <?php require_once("includes/links.php") ?>
  <style>
    main,
    .uk-padding-remove-vertical,
    .uk-background-cover {
      min-height: 100vh;
    }

    #forgot-panel {
      border: none !important;
      width: 100%;
    }

    .mt {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <!-- preloader begin -->
  <?php require_once("includes/loader.php") ?>
  <!-- preloader end -->


  <!-- breadcrumb content end -->
  <main>
    <!-- section content begin -->
    <div class="uk-section uk-padding-remove-vertical">
      <div class="uk-container uk-container-expand">
        <div class="uk-grid" data-uk-height-viewport="expand: true">
          <div class="uk-width-3-5@m uk-background-cover uk-background-center-right uk-visible@m uk-box-shadow-xlarge" style="background-image: url(<?= $uri->site ?>assets/img/in-signin-image.jpg);"></div>
          <div class="uk-width-expand@m uk-background-cover  uk-flex uk-flex-middle">
            <div class="uk-grid uk-flex-center">
              <div class="uk-width-3-5@m">
                <div class="in-padding-horizontal@s">
                  <!-- logo begin -->
                  <a class="uk-logo" href="<?= $uri->site ?>">
                    <img src="<?= $company->favicon2 ?>" data-src="<?= $company->favicon2 ?>" alt="logo" width="160" height="34" data-uk-img>
                  </a>
                  <!-- logo end -->
                  <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">Log into your account</p>
                  <p class="uk-text-small uk-margin-remove-top uk-margin-medium-bottom">Don't have an account? <a href="<?= $uri->site ?>sign-up">Register here</a></p>
                  <!-- login form begin -->
                  <form id="register_frm" class="uk-grid uk-form">
                    <div class="uk-margin-small uk-width-1-1 uk-inline">
                      <span class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
                      <input class="uk-input uk-border-rounded forgot-element" id="email" value="" name="email" required type="email" placeholder="Email">
                    </div>
                    <div class="uk-margin-small uk-width-1-1 uk-inline">
                      <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                      <input class="uk-input uk-border-rounded" required name="password" value="" type="password" placeholder="Password">
                    </div>
                    <div class="uk-margin-small uk-width-auto uk-text-small">
                      <label><input class="uk-checkbox uk-border-rounded" type="checkbox"> Remember me</label>
                    </div>
                    <div class="uk-margin-small uk-width-expand uk-text-small">
                      <label class="uk-align-right"><a class="uk-link-reset forgot-password" href="#">Forgot password?</a></label>
                    </div>
                    <div class="uk-margin-small uk-width-1-1">
                      <button class="submit uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit" name="submit">Sign in</button>
                    </div>
                  </form>
                  <!-- login form end -->
                  <p class="uk-heading-line uk-text-center"><span>Or sign in with</span></p>
                  <div class="uk-margin-medium-bottom uk-text-center">
                    <a class="uk-button uk-button-small uk-border-rounded in-brand-google" href="#"><i class="fab fa-google uk-margin-small-right"></i>Google</a>
                    <a class="uk-button uk-button-small uk-border-rounded in-brand-facebook" href="#"><i class="fab fa-facebook-f uk-margin-small-right"></i>Facebook</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
  </main>
  <!-- Javascript -->
  <script src="<?= $uri->site ?>js/vendors/uikit.min.js"></script>
  <script src="<?= $uri->site ?>js/vendors/blockit.min.js"></script>
  <script src="<?= $uri->site ?>js/config-theme.js"></script>
  <script src="<?= $uri->backend ?>js/jquery-3.3.1.min.js"></script>
  <script src="<?= $uri->backend ?>js/controllers.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("body").addClass("loaded")

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
      $("input").addClass("uk-input")
    })
  </script>
</body>

</html>