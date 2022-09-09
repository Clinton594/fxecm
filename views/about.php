<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
  <title>About <?= $company->name ?></title>
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
            <li><span>About Us</span></li>
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
          <div class="uk-width-1-1 uk-flex uk-flex-center">
            <div class="uk-width-3-4@m uk-text-center">
              <h2 class="uk-margin-small-bottom">Putting our clients first <span class="in-highlight">since 1999.</span></h2>
              <p class=""><?= $company->name ?> is one of the world’s largest online brokers. We offer CFDs and other <?= $company->name ?>atives on forex, indices, cryptocurrencies, commodities, and synthetics to millions of registered users across the globe.
                <br>
                From inception, our goal was to break free of the high commissions and clunky products offered by traditional brokers. Also, we aim to deliver a first-class experience to digitally inclined traders, regardless of the size of their accounts.
                <br>
                In a journey spanning more than <?= date("Y") - 1999 ?> years, we have grown to over 2.5 million customers worldwide. But our mission has remained the same.
              </p>
            </div>
          </div>
          <div class="uk-grid uk-grid-large uk-child-width-1-3@m uk-margin-medium-top" data-uk-grid>
            <div class="uk-flex uk-flex-left">
              <div class="uk-margin-right">
                <i class="fas fa-leaf fa-lg in-icon-wrap circle primary-color"></i>
              </div>
              <div>
                <h3>Integrity</h3>
                <p>We serve our customers with fairness and transparency. We settle all contracts by the book and speak plainly and truthfully.</p>
              </div>
            </div>
            <div class="uk-flex uk-flex-left">
              <div class="uk-margin-right">
                <i class="fas fa-hourglass-end fa-lg in-icon-wrap circle primary-color"></i>
              </div>
              <div>
                <h3>Competence</h3>
                <p>We value colleagues with an aptitude to learn and grow and the ability to use good judgement.</p>
              </div>
            </div>
            <div class="uk-flex uk-flex-left">
              <div class="uk-margin-right">
                <i class="fas fa-flag fa-lg in-icon-wrap circle primary-color"></i>
              </div>
              <div>
                <h3>Teamwork</h3>
                <p>We value team players that collaborate freely across departments with humility and ambition.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- section content end -->
    <!-- section content begin -->
    <div class="uk-section in-offset-top-40 in-offset-bottom-20">
      <div class="uk-container">
        <div class="uk-grid">
          <div class="uk-width-1-1">
            <div class="uk-card uk-card-default uk-border-rounded uk-background-center uk-background-contain uk-background-image@m" style="background-image: url(<?= $uri->site ?>assets/img/in-team-background-1.png);" data-uk-parallax="bgy: -100">
              <div class="uk-card-body">
                <div class="uk-grid uk-flex uk-flex-center">
                  <div class="uk-width-1-1@m uk-text-center">
                    <h2>Trust the Professionals</h2>
                    <p>We are a group of passionate, independent thinkers who never stop exploring new ways to improve trading for the self-directed investor.</p>
                  </div>
                </div>
                <div class="uk-grid uk-child-width-1-4@m uk-margin-medium-top" data-uk-grid>
                  <div class="uk-flex uk-flex-left justify-center">
                    <div class="uk-margin-right">
                      <img class="uk-align-center " src="<?= $uri->site ?>assets/img/in-team-2.png" alt="image-team" width="150">
                    </div>
                    <div class="justify-center ">
                      <p class="uk-text-small uk-text-muted uk-text-uppercase uk-margin-remove-bottom">Chief Executive Officer</p>
                      <h4 class="uk-margin-small-top">Arthur Parker</h4>
                      <div>
                        <a class="uk-link-muted" href="#"><i class="fab fa-facebook-f uk-margin-small-right"></i></a>
                        <a class="uk-link-muted" href="#"><i class="fab fa-twitter uk-margin-small-right"></i></a>
                        <a class="uk-link-muted" href="#"><i class="fab fa-linkedin-in"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="uk-flex uk-flex-left justify-center">
                    <div class="uk-margin-right">
                      <img class="uk-align-center " src="<?= $uri->site ?>assets/img/in-team-1.png" alt="image-team" width="150">
                    </div>
                    <div class="justify-center ">
                      <p class="uk-text-small uk-text-muted uk-text-uppercase uk-margin-remove-bottom">Chief Operating Officer</p>
                      <h4 class="uk-margin-small-top">Cynthia Dixon</h4>
                      <div>
                        <a class="uk-link-muted" href="#"><i class="fab fa-facebook-f uk-margin-small-right"></i></a>
                        <a class="uk-link-muted" href="#"><i class="fab fa-twitter uk-margin-small-right"></i></a>
                        <a class="uk-link-muted" href="#"><i class="fab fa-linkedin-in"></i></a>
                      </div>
                    </div>
                  </div>

                  <div class="uk-flex uk-flex-left justify-center">
                    <div class="uk-margin-right">
                      <img class="uk-align-center " src="<?= $uri->site ?>assets/img/in-team-3.png" alt="image-team" width="150">
                    </div>
                    <div class="justify-center ">
                      <p class="uk-text-small uk-text-muted uk-text-uppercase uk-margin-remove-bottom">Marketing Specialist</p>
                      <h4 class="uk-margin-small-top">Evelyn Mason</h4>
                      <div class="">
                        <a class="uk-link-muted" href="#"><i class="fab fa-facebook-f uk-margin-small-right"></i></a>
                        <a class="uk-link-muted" href="#"><i class="fab fa-twitter uk-margin-small-right"></i></a>
                        <a class="uk-link-muted" href="#"><i class="fab fa-linkedin-in"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="uk-flex uk-flex-left justify-center">
                    <div class="uk-margin-right">
                      <img class="uk-align-center " src="<?= $uri->site ?>assets/img/in-team-4.png" alt="image-team" width="150">
                    </div>
                    <div class="justify-center ">
                      <p class="uk-text-small uk-text-muted uk-text-uppercase uk-margin-remove-bottom">Human Resources</p>
                      <h4 class="uk-margin-small-top">Bryan Greene</h4>
                      <div>
                        <a class="uk-link-muted" href="#"><i class="fab fa-facebook-f uk-margin-small-right"></i></a>
                        <a class="uk-link-muted" href="#"><i class="fab fa-twitter uk-margin-small-right"></i></a>
                        <a class="uk-link-muted" href="#"><i class="fab fa-linkedin-in"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
          <div class="uk-width-3-4@m">
            <div class="uk-grid uk-flex uk-flex-middle" data-uk-grid>
              <div class="uk-width-1-2@m">
                <h4 class="uk-text-muted in-offset-bottom-10">Number speaks</h4>
                <h1 class="uk-margin-medium-bottom">We always ready<br>for a <span class="in-highlight">challenge.</span></h1>
                <a href="<?= $uri->site ?>sign-up" class="uk-button uk-button-primary uk-border-rounded">Open Account<i class="fas fa-angle-right uk-margin-small-left"></i></a>
              </div>
              <div class="uk-width-1-2@m">
                <div class="uk-margin-large" data-uk-grid>
                  <div class="uk-width-1-3@m">
                    <h1 class="uk-text-primary uk-text-right@m">
                      <span>$10B+</span>
                    </h1>
                    <hr class="uk-divider-small uk-text-right@m">
                  </div>
                  <div class="uk-width-expand@m">
                    <h3>Trading Turnover</h3>
                    <p>Indicates how much trading activity took place in the market as a whole which also comprises individual stock.</p>
                  </div>
                </div>
                <div class="uk-margin-large" data-uk-grid>
                  <div class="uk-width-1-3@m">
                    <h1 class="uk-text-primary uk-text-right@m">
                      <span class="count" data-counter-end="27">0</span>
                    </h1>
                    <hr class="uk-divider-small uk-text-right@m">
                  </div>
                  <div class="uk-width-expand@m">
                    <h3>Countries covered</h3>
                    <p>We have a wide range of coverage with several currencies support.</p>
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
  <?php require_once("includes/footer.php") ?>

</body>


</html>