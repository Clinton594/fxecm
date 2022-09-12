<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
  <title>Sign Up - <?= $company->name ?></title>
  <?php require_once("includes/links.php") ?>
  <style>
    main,
    .uk-padding-remove-vertical,
    .uk-background-cover {
      min-height: 100vh;
    }

    .mt {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <!-- preloader begin -->
  <?php require_once("includes/loader.php")
  ?>
  <!-- preloader end -->
  <main>
    <!-- section content begin -->
    <div class="uk-section uk-padding-remove-vertical">
      <div class="uk-container uk-container-expand">
        <div class="uk-grid" data-uk-height-viewport="expand: true">
          <div class="uk-width-3-5@m uk-background-cover uk-background-center-right uk-visible@m uk-box-shadow-xlarge" style="background-image: url(<?= $uri->site ?>assets/img/in-signin-image.jpg);"></div>
          <div class="uk-width-expand@m uk-flex uk-flex-middle uk-background-cover">
            <div class="uk-grid uk-flex-center">
              <div class="uk-width-3-1@m">
                <div class="in-padding-horizontal@s">
                  <!-- logo begin -->
                  <a class="uk-logo" href="<?= $uri->site ?>">
                    <img src="<?= $company->favicon2 ?>" data-src="<?= $company->logo_ref ?>" alt="logo" width="160" height="34" data-uk-img>
                  </a>
                  <!-- logo end -->
                  <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">Create an Account</p>
                  <p class="uk-text-small uk-margin-remove-top uk-margin-medium-bottom">Don't have an account? <a href="<?= $uri->site ?>sign-in">Sign In here</a></p>
                  <!-- login form begin -->
                  <form id="register_frm" class="uk-grid uk-form">
                    <div class="uk-margin-small uk-width-1-2 uk-inline">
                      <label for="firstname">
                        <small>First Name</small>
                      </label>
                      <span class="uk-form-icon uk-form-icon-flip mt fas fa-user fa-sm"></span>
                      <input class="uk-input uk-border-rounded" id="firstname" value="" name="first_name" required type="text" placeholder="First Name">
                    </div>
                    <div class="uk-margin-small uk-width-1-2 uk-inline">
                      <label for="last_name">
                        <small>Last Name</small>
                      </label>
                      <span class="uk-form-icon uk-form-icon-flip mt fas fa-user fa-sm"></span>
                      <input class="uk-input uk-border-rounded" id="last_name" value="" name="last_name" required type="text" placeholder="Last Name">
                    </div>
                    <div class="uk-margin-small uk-width-1-2 uk-inline">
                      <label for="email">
                        <small>Email</small>
                      </label>
                      <span class="uk-form-icon uk-form-icon-flip mt fas fa-envelope fa-sm"></span>
                      <input class="uk-input uk-border-rounded" id="email" value="" name="email" required type="email" placeholder="Email">
                    </div>
                    <div class="uk-margin-small uk-width-1-2 uk-inline">
                      <label for="phone">
                        <small>Phone Number</small>
                      </label>
                      <span class="uk-form-icon uk-form-icon-flip mt fas fa-phone fa-sm"></span>
                      <input class="uk-input uk-border-rounded" id="phone" value="" name="phone" required type="tel" placeholder="Phone">
                    </div>
                    <div class="uk-margin-small uk-width-1-2 uk-inline">
                      <label for="password">
                        <small>Password</small>
                      </label>
                      <span class="uk-form-icon uk-form-icon-flip mt fas fa-secure fa-sm"></span>
                      <input class="uk-input uk-border-rounded" id="password" value="" name="password" required type="password" placeholder="Password">
                    </div>
                    <div class="uk-margin-small uk-width-1-2 uk-inline">
                      <label for="password2">
                        <small>Confirm Password</small>
                      </label>
                      <span class="uk-form-icon uk-form-icon-flip mt fas fa-secure fa-sm"></span>
                      <input class="uk-input uk-border-rounded" id="password2" value="" name="password2" required type="password" placeholder="Confirm Password">
                    </div>



                    <div class="uk-margin-small uk-width-1-1">
                      <button class="submit uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit" name="submit">Sign in</button>
                    </div>
                  </form>
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