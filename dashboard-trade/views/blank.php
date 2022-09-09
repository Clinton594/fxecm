<?php require_once("{$generic->dashboard}includes/client-auth.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>------------ - <?= $company->name ?></title>
  <?php require_once("{$generic->dashboard}includes/client-links.php") ?>
</head>

<body>
  <?php require_once("{$generic->dashboard}includes/client-loader.php") ?>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?php require_once("{$generic->dashboard}includes/client-sidebar.php") ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Home</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="<?= $uri->site ?>account">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Blank Page</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
          </div>
        </section>
      </div>

    </div>
  </div>
  <?php require_once("{$generic->dashboard}includes/client-footer.php") ?>
</body>

</html>