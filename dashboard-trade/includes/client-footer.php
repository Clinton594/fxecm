<footer class="main-footer">
  <div class="footer-left">
    Copyright &copy; <?= date("Y") ?>
    <div class="bullet"></div>
    <?= $company->name ?> | <?= $company->address ?>
  </div>
  <div class="footer-right"></div>
</footer>
<scripts>
  <!-- General JS Scripts -->
  <script src="<?= $uri->site . $generic->dashboard ?>assets/js/app.min.js<?= $cache_control ?>"></script>
  <!-- Template JS File -->
  <script src="<?= $uri->site . $generic->dashboard ?>assets/js/scripts.js<?= $cache_control ?>"></script>
  <!-- Custom JS File -->
  <script src="<?= $uri->backend ?>js/controllers.js<?= $cache_control ?>"></script>
  <script src="<?= $uri->site . $generic->dashboard ?>assets/js/custom.js<?= $cache_control ?>"></script>
  <?php if (file_exists(absolute_filepath("{$uri->site}includes/support.php"))) { ?>
    <?php require_once("includes/support.php") ?>
  <?php } ?>
  <script>
    async function loadPayment(url, element) {
      const modal = "paymentModal";
      let myModal;
      if (element) {
        $(element).startLoader()
      }
      if ($(`#${modal}`).length === 0) {
        $("body").append(
          $('<div>').addClass('modal').attr({
            'tabindex': '-1',
            id: modal
          }).append($('<div>').addClass('modal-dialog').append($('<div>').addClass('modal-content').append($('<div>').addClass('modal-body'))))
        );
        myModal = new bootstrap.Modal(document.querySelector(`#${modal}`));
      } else myModal = bootstrap.Modal.getOrCreateInstance(document.querySelector(`#${modal}`));

      $(`#${modal}`).find(".modal-header").remove();
      const content = $(`#${modal}`).find(".modal-body").children();
      const div = $("<div>").attr({
        id: "paymentbody"
      });

      const newContent = await div.load(url).hide();
      $(`#${modal}`).find(".modal-body").append(newContent)

      content.swapDiv(div, (res) => {
        setTimeout(() => {
          content.remove();
        }, 2000);
        if (!$(`#${modal}`).hasClass("show")) {
          myModal.show();
        }
        if (element) {
          $(element).stopLoader()
        }
      })
      document.querySelector(`#${modal}`).addEventListener('hidden.bs.modal', function(event) {
        window.location.reload()
      });
    }

    $(document).ready(() => {
      const page = $("#sidebar-wrapper").data("page");
      $("#sidebar-wrapper").find(".dropdown.active").removeClass("active");
      $("#sidebar-wrapper").find(`.dropdown[data-page=${page}]`).addClass("active")
    })
  </script>
</scripts>