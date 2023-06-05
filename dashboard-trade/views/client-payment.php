<?php
require_once("{$generic->dashboard}includes/client-auth.php");
$param = object($_GET);
$bank = $paramControl->load_sources("wire-transfer");

// see($param);
if (!empty($param->hash) && !empty($param->_k)) {
  $transaction = $generic->getFromTable("transaction", "id={$param->_k}, tx_no={$param->hash}, status=0");
  if (count($transaction)) {
    $transaction = reset($transaction);

    if ($transaction->paid_into !== "USD") {
      $temp = array_filter($coins, function ($temp) use ($transaction) {
        return $temp->symbol == $transaction->paid_into;
      });
      if (count($temp)) {
        $temp = reset($temp);

        $price = $forExchange->getRates([$temp->symbol]);
        $coin = reset($price);
        $coin = object(array_merge(arrray($temp), arrray($coin)));
        $amount = round(($transaction->amount / $coin->price), 4);
      } else die("Error Fetching coin price");
    } else {
      $amount = $transaction->amount;
    }
  } else die("Transaction is invalid");
}

?>
<form class="pannel" id="payment">
  <h4 class="popup-title">Payment Details</h4>
  <div>
    <div class="row align-items-center">
      <?php if ($transaction->paid_into === "USD") { ?>
        <table class="table">
          <tbody>
            <tr>
              <td>AMOUNT</td>
              <td><?= $fmn->format($amount) ?></td>
            </tr>
            <?php foreach ($bank as $key => $value) { ?>
              <tr>
                <td><?= strtoupper($key) ?></td>
                <td><?= strtoupper($value) ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        <div class="col-4">
          <img src="<?= $coin->qr_code ?>" class="img-fluid">
        </div>
        <div class="col-8">
          <label><?= $transaction->paid_into ?> Deposit Address ( <b><?= $coin->network ?></b> )</label>
          <div class="copy-wrap contact-search mgb-0-5x mb-3">
            <input type="text" class="copy-address" value="<?= $coin->wallet ?>" readonly style="padding-left: 15px;width:92%">
            <span class="copy-feedback copy-trigger" data-clipboard data-clipboard-text="<?= $coin->wallet ?>"> <i class="fa fa-copy"></i></span>
          </div>
          <!-- .copy-wrap -->
          <label>Deposit amount</label>
          <div class="copy-wrap contact-search  mgb-0-5x">
            <input type="text" class="copy-address" value="<?= $amount ?> <?= $transaction->paid_into ?>" readonly style="padding-left: 15px;width:92%">
            <span class="copy-feedback copy-trigger" data-clipboard data-clipboard-text="<?= $amount ?>"> <i class="fa fa-copy"></i></span>
          </div>
        </div>
      <?php }; ?>
      <div class="col-12 d-flex justify-content-between">
        <div>
          <div class="form-group">
            <label class="d-block">Paid ?</label>
            <div class="form-check">
              <input class="form-check-input" required value="" type="checkbox" id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">
                Yes, I have made payment
              </label>
            </div>
          </div>
        </div>
        <div>
          <button name="add_btn" type="submit" class="btn btn-primary btn-lg submit float-right" data-to=timer-pannel>Proceed <i class="fa fa-arrow-right">
            </i>
          </button>
          <input type="hidden" name="InvID" value="<?= $transaction->id ?>">
          <?php if ($transaction->tx_type == "exchange") { ?>
            <input type="hidden" name="case" value="confirm-exchange">
          <?php } else { ?>
            <input type="hidden" name="case" value="notify-deposit">
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</form>
<script src="<?= $uri->backend ?>js/jquery-3.3.1.min.js"></script>
<script src="<?= $uri->backend ?>js/mini-controllers.js"></script>
<script>
  $(document).ready(function() {
    $(".copy-address").clipboard();
    $("#payment").submitForm({
      process_url: `${site.process}custom`,
    }, null, function(response) {
      window.location = `${site.domain}transactions`
    });
  })
</script>