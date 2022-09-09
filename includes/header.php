  <header>
    <!-- header content begin -->
    <div class="uk-section uk-padding-remove-vertical">
      <nav class="uk-navbar-container" data-uk-sticky="show-on-up: true; animation: uk-animation-slide-top;">
        <div class="uk-container" data-uk-navbar>
          <div class="uk-navbar-left">
            <div class="uk-navbar-item">
              <!-- logo begin -->
              <a class="uk-logo" href="<?= $uri->site ?>">
                <img src="<?= $company->logo_ref ?>" data-src="<?= $company->logo_ref ?>" alt="logo" width="160" height="34" data-uk-img>
              </a>
              <!-- logo end -->
              <!-- navigation begin -->
              <ul class="uk-navbar-nav uk-visible@m">
                <li><a href="<?= $uri->site ?>markets">Markets</a></li>
                <li><a href="<?= $uri->site ?>education">Trading Training</a></li>

                <li><a href="<?= $uri->site ?>about">About</a></li>
                <li><a href="<?= $uri->site ?>careers">Careers</a></li>
                <li><a href="<?= $uri->site ?>contact">Contact</a></li>
              </ul>
              <!-- navigation end -->
            </div>
          </div>
          <div class="uk-navbar-right">
            <div class="uk-navbar-item uk-visible@m in-optional-nav">
              <a href="<?= $uri->site ?>sign-up" class="uk-button uk-button-primary uk-border-rounded">Create Account</a>
              <a href="<?= $uri->site ?>sign-in" class="uk-button uk-button-text"><i class="fas fa-user-circle"></i></a>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <!-- header content end -->
  </header>