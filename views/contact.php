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
            <li><span>Contact Us</span></li>
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
        <div class="uk-grid uk-flex uk-flex-center">
          <div class="uk-width-1-2@m uk-text-center">
            <h2 class="uk-margin-small-bottom">Do not hesitate to <span class="in-highlight">reach out.</span></h2>
            <p class="uk-text-lead uk-text-muted uk-margin-remove">Just fill in the contact form here and we’ll be sure to reply as fast as possible</p>
          </div>
          <div class="uk-width-1-1@m uk-margin-large-top">
            <div class="uk-grid uk-grid-large uk-child-width-1-2@m" data-uk-grid>
              <div>
                <form id="contact-form" class="uk-form uk-grid-small" data-uk-grid>
                  <div class="uk-width-1-1">
                    <input class="uk-input uk-border-rounded" id="name" name="user_name" type="text" placeholder="Full name">
                  </div>
                  <div class="uk-width-1-1">
                    <input class="uk-input uk-border-rounded" id="email" name="email" type="email" placeholder="Email address">
                  </div>
                  <div class="uk-width-1-1">
                    <input class="uk-input uk-border-rounded" id="subject" name="title" type="text" placeholder="Subject">
                  </div>
                  <div class="uk-width-1-1">
                    <textarea class="uk-textarea uk-border-rounded" id="message" name="message" rows="6" placeholder="Message"></textarea>
                  </div>
                  <div class="uk-width-1-1">
                    <button class="submit uk-width-1-1 uk-button uk-button-primary uk-border-rounded" id="sendemail" type="submit" name="submit">Send Message</button>
                  </div>
                </form>
              </div>
              <div>
                <h4 class="uk-margin-remove-bottom">Business submissions</h4>
                <p class="uk-margin-small-top">For business plan submissions. Please submit using this</p>
                <div class="uk-flex uk-flex-middle uk-margin">
                  <div class="uk-margin-small-right">
                    <i class="fas fa-envelope fa-sm in-icon-wrap circle small primary-color"></i>
                  </div>
                  <div>
                    <p class="uk-margin-remove">
                      <a href="mailto:<?= $company->email ?>"><?= $company->email ?></a>
                    </p>
                  </div>
                </div>
                <div class="uk-flex uk-flex-middle uk-margin">
                  <div class="uk-margin-small-right">
                    <i class="fas fa-phone fa-sm in-icon-wrap circle small primary-color"></i>
                  </div>
                  <div>
                    <p class="uk-margin-remove">
                      <a href="tel:<?= $company->phone ?>"><?= $company->phone ?></a>
                    </p>
                  </div>
                </div>
                <div class="uk-flex uk-flex-middle uk-margin">
                  <div class="uk-margin-small-right">
                    <i class="fas fa-location-arrow fa-sm in-icon-wrap circle small primary-color"></i>
                  </div>
                  <div>
                    <p class="uk-margin-remove"><?= $company->address ?></p>
                  </div>
                </div>
                <hr class="uk-margin-medium">
                <h4 class="uk-margin-bottom">Our social media</h4>
                <a href="#" class="fab fa-telegram-plane fa-lg uk-margin-right"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
  </main>
  <?php require_once("includes/footer.php") ?>
  <script src="<?= $uri->backend ?>js/jquery-3.3.1.min.js"></script>
  <script src="<?= $uri->backend ?>js/controllers.js"></script>
  <script>
    $(document).ready(function() {
      $("#contact-form").submitForm({
        case: "send-mail",
        process_url: `${site.process}custom/`,
        validation: "strict"
      })
    })
  </script>
</body>

</html>