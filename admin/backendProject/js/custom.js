function open_memeber(button) {
  let row = $(button).closest("tr");
  let pageid = $(button).data("pageid");
  // console.log(pageid);
  loadSelection(row, pageid, "new_form" + pageid, "modal");
}

function getReferrals(x) {
  let row = $(x).closest("tr");
  let pageData = $(x).data();
  $(x).parent().startLoader();
  $.post(`${site.process}custom`, { case: "getReferrals", ...$(x).data() }, function (response) {
    $(x).parent().stopLoader();
    let res = isJson(response);
    if (res.status) {
      $("#newextform1_referrals" + pageData.pageid)
        .find(".modal-content")
        .html(res.data);
      $("#newextform1_referrals" + pageData.pageid).openModal();
    }
  });
  // loadSelection(row, pageid, "newextform1_referrals"+pageid,"modal");
}

function attach_name(ths) {
  let pageData = $(ths).data();
  let val = $(ths).val();
  let index = $(ths).find(`option[value=${val}]`).text();
  $(`#name${pageData.pageid}`).val(index).attr({ value: index });
}

function toggleType(ths) {
  const pageData = $(ths).data();
  const val = $(ths).val();
  $(ths).closest(".card-content").find(`#amount${pageData.pageid}`).next().text(`*${val}`);
}
