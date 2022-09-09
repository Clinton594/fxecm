      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline me-auto">
          <ul class="navbar-nav mr-3">
            <li>
              <a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                <i data-feather="menu"></i>
              </a>
            </li>

          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li>
            <a href="#" class="nav-link nav-link-lg fullscreen-btn">
              <i data-feather="maximize"></i>
            </a>
          </li>

          <li class="dropdown dropdown-list-toggle">
            <a href="#" data-bs-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i data-feather="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item">
                  <span class="dropdown-item-icon bg-info text-white"> <i class="fas fa-bell"></i> </span>
                  <span class="dropdown-item-desc">
                    Welcome to <?= $company->name ?> <span class="time">Now</span>
                  </span>
                </a>
              </div>
            </div>
          </li>
          <li class="dropdown">
            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?= $user->picture_ref ?>" class="user-img-radious-style rounded-cirlce" />
              <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?= $user->first_name ?> <?= $user->last_name ?></div>
              <a href="<?= $uri->site ?>settings" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile </a>
              <a href="<?= $uri->site ?>join-affiliate" class="dropdown-item has-icon">
                <i class="fas fa-users"></i>
                Referrals
              </a>
              <a href="<?= $uri->site ?>wallets" class="dropdown-item has-icon">
                <i class="fas fa-dollar-sign"></i>
                Wallets
              </a>
              <a href="javascript:;" class="dropdown-item has-icon settingPanelToggle">
                <i class="fas fa-palette"></i>
                Themes
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= $uri->site ?>sign-out" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- Side bar -->
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper" data-page="<?= $uri->page_source ?>">
          <div class="sidebar-brand">
            <a href="<?= $uri->site ?>">
              <img alt="image" src="<?= $company->logo_ref ?>" class="header-logo" />
            </a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" class="rounded-circle" src="<?= $user->picture_ref ?>" />
            </div>
            <div class="sidebar-user-details">
              <div class="user-name"><?= $user->first_name ?> <?= $user->last_name ?></div>
              <div class="user-role"><?= $user->email ?></div>
              <div class="sidebar-userpic-btn">
                <a href="<?= $uri->site ?>settings" data-bs-toggle="tooltip" title="Profile">
                  <i data-feather="user"></i>
                </a>
                <a href="<?= $uri->site ?>contact" data-bs-toggle="tooltip" title="Support">
                  <i data-feather="message-square"></i>
                </a>
                <a href="javascript:(void)" data-bs-toggle="tooltip" class="settingPanelToggle" title="Themes">
                  <i data-feather="sun"></i>
                </a>
                <a href="<?= $uri->site ?>sign-out" data-bs-toggle="tooltip" title="Log Out">
                  <i data-feather="log-out"></i>
                </a>
              </div>
              <hr>
            </div>
          </div>
          <!--Side bar Menu Links -->
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown" data-page="account">
              <a href="<?= $uri->site ?>account" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown" data-page="fund-account">
              <a href="<?= $uri->site ?>fund-account" class="nav-link"><i data-feather="check-circle"></i><span>Fund Account</span></a>
            </li>
            <li class="dropdown" data-page="invest">
              <a href="<?= $uri->site ?>invest" class="nav-link"><i data-feather="grid"></i><span>Trading Engines</span></a>
            </li>
            <li class="dropdown" data-page="trading">
              <a href="<?= $uri->site ?>trading" class="nav-link"><i data-feather="bar-chart-2"></i><span>Trades</span></a>
            </li>
            <li class="dropdown" data-page="withdraw">
              <a href="<?= $uri->site ?>withdraw" class="nav-link"><i data-feather="copy"></i><span>Withdraw</span></a>
            </li>
            <li class="menu-header">Others</li>

            <li class="dropdown" data-page="transactions">
              <a href="<?= $uri->site ?>transactions" class="nav-link"><i data-feather="grid"></i><span>Transactions</span></a>
            </li>
            <li class="dropdown" data-page="join-affiliate">
              <a href="<?= $uri->site ?>join-affiliate" class="nav-link"><i data-feather="users"></i><span>Referrals</span></a>
            </li>
            <li class="dropdown ps-3" style="margin-bottom: 70px;" data-page="join-affiliate">
              <?php require_once("{$generic->dashboard}includes/translator.php") ?>
            </li>
          </ul>
        </aside>
      </div>
      <div class="settingSidebar">
        <div class="settingSidebar-body ps-container ps-theme-default">
          <div class="fade show active">
            <div class="setting-panel-header">Setting Panel</div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Select Layout</h6>
              <div class="selectgroup layout-color w-50">
                <label class="selectgroup-item">
                  <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked />
                  <span class="selectgroup-button">Light</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout" />
                  <span class="selectgroup-button">Dark</span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Sidebar Color</h6>
              <div class="selectgroup selectgroup-pills sidebar-color">
                <label class="selectgroup-item">
                  <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar" />
                  <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked />
                  <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Color Theme</h6>
              <div class="theme-setting-options">
                <ul class="choose-theme list-unstyled mb-0">
                  <li title="white" class="active">
                    <div class="white"></div>
                  </li>
                  <li title="cyan">
                    <div class="cyan"></div>
                  </li>
                  <li title="black">
                    <div class="black"></div>
                  </li>
                  <li title="purple">
                    <div class="purple"></div>
                  </li>
                  <li title="orange">
                    <div class="orange"></div>
                  </li>
                  <li title="green">
                    <div class="green"></div>
                  </li>
                  <li title="red">
                    <div class="red"></div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <div class="theme-setting-options">
                <label class="m-b-0">
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting" />
                  <span class="custom-switch-indicator"></span>
                  <span class="control-label p-l-10">Mini Sidebar</span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <div class="theme-setting-options">
                <label class="m-b-0">
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting" />
                  <span class="custom-switch-indicator"></span>
                  <span class="control-label p-l-10">Sticky Header</span>
                </label>
              </div>
            </div>
            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
              <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                <i class="fas fa-undo"></i> Restore Default
              </a>
            </div>
          </div>
        </div>
      </div>