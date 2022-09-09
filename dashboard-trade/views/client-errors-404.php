<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>PAGE NOT FOUND - <?= $company->name ?></title>
  <?php require_once("{$generic->dashboard}includes/client-links.php") ?>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <figure class="d-flex w-100 justify-content-center">
              <img src="<?= $uri->site . $generic->dashboard ?>assets/img/banner/404.svg" class="w-25" alt="">
            </figure>
            <div class="page-description">
              The page you were looking for could not be found.
            </div>
            <div class="page-search">

              <div class="mt-3">
                <a href="<?= $uri->site ?>"><button class="btn btn-primary btn-lg">
                    Back Home
                  </button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="<?= $uri->backend ?>js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(".loader").fadeOut("slow")
    })
  </script>
</body>

</html>