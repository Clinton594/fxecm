<?php
require_once("{$generic->dashboard}includes/client-auth.php");
$approval = $paramControl->load_sources("approval");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>KYC - <?= $company->name ?></title>
  <?php require_once("{$generic->dashboard}includes/client-links.php") ?>
</head>

<body>
  <?php require_once("{$generic->dashboard}includes/client-loader.php") ?>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <!-- Main Content -->
      <div class="main-content p-5">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="bg-style mb-5">
                  <div>
                    <h1>Welcome <?= ucfirst($session->greeting) ?> <?= $user->first_name ?></h1>
                    <div class="row">
                      <div class="col-md-6">
                        <p>Due to Governing policies of financial institutions, you are required by law to provide a means of identification.</p>
                        <i class="mb-3 float-start">In case of any issues, contact support.</i>
                      </div>
                    </div>
                    <a href="<?= $uri->site ?>contact" class="btn btn-icon icon-right btn-primary"><i class="far fa-user"></i> Contact Support</a>
                  </div>
                  <div>
                    <img width="100%" src="<?= $generic->dashboard ?>assets/img/banner/stats-rafiki.png" alt="" srcset="">
                  </div>
                </div>
              </div>
            </div>
            <?php if (empty($user->kyc_status)) { ?>
              <div class="row">
                <div class="col-12">
                  <form action="" id="kyc-form">
                    <div class="row">
                      <input type="hidden" name="id" value="<?= $user->id ?>">
                      <input type="hidden" name="kyc_status" value="2">
                      <div class="col-12 col-md-6 col-sm-12">
                        <div class="card">
                          <div class="card-header text-center">
                            <h4>Upload Photo</h4>
                          </div>
                          <div class="card-body">
                            <div class="empty-state" data-height="400" style="height: 400px;">
                              <figure class="avatar-photo">
                                <img src="<?= $user->picture_ref ?>" class="img-fluid" alt="">
                              </figure>
                              <a class="btn btn-primary btn-flat mt-4">
                                <span class="trigger-file">Upload Photo</span>
                                <div><input type="file" class="file-upload" name="picture_ref" hidden data-path="<?= $uri->site ?>assets/img/users/<?= $user->username ?>/" id=""></div>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6 col-sm-12">
                        <div class="card">
                          <div class="card-header text-center">
                            <h4>Upload a Valid ID Card</h4>
                          </div>
                          <div class="card-body">
                            <div class="empty-state" data-height="400" style="height: 400px;">
                              <figure id="avatar-photo">
                                <img src="<?= $uri->site . $generic->dashboard ?>assets/img/banner/kyc.png" class="img-fluid" alt="">
                              </figure>
                              <a class="btn btn-primary btn-flat mt-4">
                                <span class="trigger-file">Upload ID</span>
                                <div><input type="file" class="file-upload" name="kyc_identity" hidden data-path="<?= $uri->site ?>assets/img/users/<?= $user->username ?>/" id=""></div>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="submit btn btn-success d-none" id="submit">Submit</button>
                  </form>
                </div>

              </div>
            <?php } else { ?>
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2><?= $approval[$user->kyc_status] ?></h2>
                <?php if ($user->kyc_status != 1) { ?>
                  <p class="lead">
                    Your KYC is <?= $approval[$user->kyc_status] ?>. In case of any issues, contact support.
                  </p>
                <?php } else { ?>
                  <a href="<?= $uri->site ?>account" rel="noopener noreferrer" class="btn btn-primary">Continue to Dashboard</a>
                <?php } ?>
              </div>
            <?php } ?>
          </div>
        </section>
      </div>
    </div>
  </div>
  <?php require_once("{$generic->dashboard}includes/client-footer.php") ?>
  <script>
    $(document).ready(() => {
      if ($("#kyc-form").length) {
        $("#kyc-form").submitForm({
          formName: "kyc-submission",
        }, null, () => {
          window.location.reload()
        });
        $(".trigger-file").click(function() {
          $(this).next().find(".file-upload").click()
        })
        $(".file-upload").each(function() {
          const button = $(this);
          button.uploadFile({}, (response) => {
            button.attr({
              type: "hiddem",
              value: response.src
            }).val(response.src).closest(".empty-state").find("figure").addClass("avatar-photo").find("img").attr({
              src: response.src
            });
            button.parent().parent().fadeOut("slow");
            if (Object.values($("#kyc-form input").values()).every((a) => a)) {
              $("#submit").removeClass("d-none");
            }
          });

        })
      }
    })
  </script>
</body>

</html>