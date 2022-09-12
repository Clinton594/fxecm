<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
  <title>Contact <?= $company->name ?></title>
  <?php require_once("includes/links.php") ?>
  <style>
    .justify-center {
      justify-content: center !important;
      flex-direction: column;
      text-align: center;
    }

    h4.uk-margin-small-top {
      margin-top: 2px !important;
      margin-bottom: 0;
    }
  </style>
</head>

<body>
  <!-- preloader begin -->
  <?php require_once("includes/loader.php") ?>
  <!-- preloader end -->
  <?php require_once("includes/header.php") ?>
  <div class="uk-section uk-padding-remove-vertical in-liquid-breadcrumb">
    <div class="uk-container">
      <div class="uk-grid">
        <div class="uk-width-1-1">
          <ul class="uk-breadcrumb">
            <li><span>FAQ</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- breadcrumb content end -->
  <main>
    <!-- section content begin -->
    <div class="uk-section">
      <div class="uk-container">
        <div class="uk-grid">
          <div class="uk-width-1-1 uk-text-center uk-margin-medium-bottom">
            <h2>Company <span class="in-highlight">legal docs.</span></h2>
          </div>
          <div class="uk-grid-divider uk-child-width-1-3@m uk-child-width-1-2@s" data-uk-grid>
            <div>
              <i class="fas fa-file fa-lg in-icon-wrap circle primary-color"></i>
              <h4 class="uk-margin-top">Terms of Service</h4>
              <p>Read the Terms of Service and License Agreement for Blockit as well as our BlockitApp &amp; Developer Agreements.</p>
              <ul class="uk-list uk-margin-top">
                <li><a class="uk-button uk-button-text" href="#"><i class="fas fa-file-pdf uk-margin-small-right"></i>License Agreement</a></li>
                <li><a class="uk-button uk-button-text" href="#"><i class="fas fa-file-pdf uk-margin-small-right"></i>Term of Services for Blockit Trade</a></li>
              </ul>
            </div>
            <div>
              <i class="fas fa-globe fa-lg in-icon-wrap circle primary-color"></i>
              <h4 class="uk-margin-top">Policies</h4>
              <p>Find out more about what information we collect at Blockit, how we use it, and what control you have over your data.</p>
              <ul class="uk-list uk-margin-top">
                <li><a class="uk-button uk-button-text" href="#"><i class="fas fa-file-pdf uk-margin-small-right"></i>Privacy Statement</a></li>
              </ul>
            </div>
            <div class="uk-visible@m">
              <i class="fas fa-shield-alt fa-lg in-icon-wrap circle primary-color"></i>
              <h4 class="uk-margin-top">Security</h4>
              <p>Learn more about how we keep your work and personal data safe when you’re using our services.</p>
              <ul class="uk-list uk-margin-top">
                <li><a class="uk-button uk-button-text" href="#"><i class="fas fa-file-pdf uk-margin-small-right"></i>Liquid Trade Security</a></li>
                <li><a class="uk-button uk-button-text" href="#"><i class="fas fa-file-pdf uk-margin-small-right"></i>Responsible Disclosure Policy</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
    <!-- section content begin -->
    <div class="uk-section">
      <div class="uk-container">
        <div class="uk-grid uk-flex uk-flex-center">
          <div class="uk-width-3-5@m">
            <h2 class="uk-margin-bottom uk-text-center">Company Faq.</h2>
            <p class="uk-text-lead uk-text-muted uk-margin-remove uk-text-center">Cupidatat non proident sunt in culpa qui officia deserunt.</p>
            <p class="uk-text-center">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla.</p>
            <ul class="in-faq-3 uk-margin-medium-top" data-uk-accordion>
              <li class="uk-card uk-card-default uk-card-body uk-box-shadow-small uk-border-rounded">
                <a class="uk-accordion-title" href="#">How to contact with liquid team?</a>
                <div class="uk-accordion-content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua voluptate velit esse cillum dolore.</p>
                  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum quia non numquam eius modi.</p>
                </div>
              </li>
              <li class="uk-card uk-card-default uk-card-body uk-box-shadow-small uk-border-rounded">
                <a class="uk-accordion-title" href="#">Gulp installation failed, how to fix this issue?</a>
                <div class="uk-accordion-content">
                  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum numquam eius tempora.</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                </div>
              </li>
              <li class="uk-card uk-card-default uk-card-body uk-box-shadow-small uk-border-rounded">
                <a class="uk-accordion-title" href="#">Website response taking time, how to improve?</a>
                <div class="uk-accordion-content">
                  <p>Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime.</p>
                </div>
              </li>
              <li class="uk-card uk-card-default uk-card-body uk-box-shadow-small uk-border-rounded">
                <a class="uk-accordion-title" href="#">New update fixed all bug and issues</a>
                <div class="uk-accordion-content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                  <p>Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio cum soluta nobis est eligendi optio cumque nihil impedit placeat facere possimus.</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
  </main>
  <?php require_once("includes/footer.php") ?>

</body>

</html>