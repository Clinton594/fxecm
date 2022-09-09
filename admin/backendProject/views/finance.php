<?php

// echo "here";


?>
<div class="p-5 bg-white">
  <div id="finance" class="row">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-md-8 text-dark">
          <h1>Financial Accounting</h1>
          <p>This shows a cummulative of each person's working for <span id="range"></span> period </p>
        </div>
        <div class="col-md-4">
          <div class="input-field">
            <input type="text" name="" id="finance-date-range">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <p id="loader"></p>
          <div class="responsive-table">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Mentor</th>
                  <th scope="col">Deposit</th>
                  <th scope="col">Withdrawal</th>
                </tr>
              </thead>
              <tbody id="tbody">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    let range = {
      startDate: moment().startOf("Month"),
      endDate: moment(),
      label: moment().startOf('Month').fromNow()
    }
    getFinance(range)
  })

  function getFinance(range) {
    const loader = $("#loader");
    loader.startLoader();
    $("#tbody").empty();
    $.get(`${site.process}custom`, {
      case: "finance",
      start: range.startDate.format('Y-M-D'),
      stop: range.endDate.format('Y-M-D'),
    }, (response) => {
      loader.stopLoader();
      $("#range").text(range.label);
      const res = isJson(response);
      if (res.status && res.data && res.data.length) {
        res.data.forEach((element, index) => {
          $("#tbody").append(
            $("<tr>").append(
              $("<td>").text(index + 1)
            ).append(
              $("<td>").text(element.mentor)
            ).append(
              $("<td>").text(element.data.deposit)
            ).append(
              $("<td>").text(element.data.withdrawal)
            )
          )
        })
      } else {
        $("#tbody").append(
          $("<tr>").append(
            $("<td>").attr({
              colSpan: 4
            }).addClass('text-muted').text(`No data found`)
          )
        )
      }
    })
  }

  $("#finance-date-range").initDateRange("This Month", function(result) {
    getFinance(result)
  });
</script>