$.fn.extend({
  submitForm: function (parameters, callbefore, callback) {
    let form = $(this);
    let domName = form.prop("tagName") || null;
    if (!domName || domName.toLowerCase() !== "form") {
      alert("This is not a form element !!!");
      return;
    } else if (form.find("button.submit").length == 0) {
      alert("add classname 'submit' to the submit button");
      return;
    } else {
      let button = form.find("button.submit, button[type=submit], input[type=submit]");
      form.attr({ action: "javascript:;", method: "POST" });
      button.removeAttr("onclick").off("click").attr({ type: "submit" });
      form.submit(function () {
        let proceed = true;
        parameters.validation = parameters.validation || "strict";
        //button.Loader.start();
        let formData = form.serializeArray();
        if (form[0].checkValidity() === true) {
          button[0].go = true;
          //merge parameters with FormData
          for (let key in parameters) {
            formData.push({ name: key, value: parameters[key] });
          }
          // Find data in form dom and push to formData
          let _formdata = form.formdata();
          for (let i in _formdata) {
            formData.push(_formdata[i]);
          }
          //Run a function befor submission
          if (typeof callbefore === "function") {
            formData = callbefore(formData);
            if (formData.error) {
              toast(formData.error, "red", formData.duration);
              return false;
            }
          }
          if (parameters.validation === "strict") {
            for (let key in formData) {
              if (formData[key].value === "") {
                let desc = form.find("[name=" + formData[key].name + "]").attr("placeholder") || formData[key].name;
                toast(desc + " is invalid", "black");
                proceed = false;
              }
            }
          }
          if (proceed === true && button[0].go === true && formData) {
            button.startLoader(true); //set true to deactivate form inputs
            button[0].go = false;
            let process_url = formData.filter((obj) => {
              return obj.name == "process_url";
            });
            process_url = process_url[0] ? process_url[0].value : parameters.process_url;
            process_url = process_url || `${site.process}submit`;

            // Default case
            let kase = formData.filter((obj) => {
              return obj.name == "case";
            });

            $.post(process_url, formData, (response) => {
              button.stopLoader(true); //set true to reactivate form inputs
              button[0].go = true;
              let res = isJson(response);
              let color = ["red", "green"];
              let status = res.status ? res.status : 0;
              let message = res.status ? "Successful" : "An Error Occured, Check console !!!";
              message = res.message || message;
              toast(message, color[status]);
              //if there is callback function
              if (typeof callback == "function") {
                if (res.status) {
                  for (let i in formData) {
                    res[formData[i].name] = formData[i].value;
                  }
                  callback(res);
                } else {
                  console.log(response);
                }
              } else {
                if (res.status) {
                  form[0].reset();
                } else {
                  console.log(response);
                }
              }
            });
          }
        } else {
          console.log(form[0].checkValidity());
          console.log(formData);
        }
      });
      form.find("input[type=file].file_upload").each(function () {
        $(this).uploadFile();
      });
    }
  },
});

$.fn.extend({
  disableForm: function () {
    $(this).find("input, select, textarea, button").not(":disabled").addClass("mydisabled").attr({ disabled: true });
  },
});
$.fn.extend({
  enableForm: function () {
    $(this).find(".mydisabled").removeClass("mydisabled").attr({ disabled: false });
  },
});

$.fn.extend({
  // Creates a formdata inside a form DOM and adds values to it;
  // retrieves all formdata inside a DOM by not passing any paramters
  // retrieves specific formdata inside a DOM by not passing only the key
  // Clears all values inside a formdata object by passing false as parameter
  formdata: function (key, value) {
    let form = $(this);
    let domName = form.prop("tagName") || null;
    // Must be initialized on a form element
    if (!domName || domName.toLowerCase() !== "form") {
      toast("This is not a form element !!!");
      return;
    }
    let formdata = [];
    // Creates a default empty formdata array if there isnt any one existing before or to to empty an exitsting formdata
    if (!form.prop("formdata") || key === false) {
      form[0].formdata = formdata;
    }
    if (key) {
      formdata = form.prop("formdata");
      // Remove every existing key from the formdata array
      if (value) {
        formdata.forEach((item, i) => {
          if (item.name == key) formdata.splice(i, 1);
        });
        let obj = { name: key, value: value };
        form[0].formdata.push(obj);
        return true;
      } else {
        // retun the existing data from the key
        formdata = form.prop("formdata") || [];
        formdata.forEach((item, i) => {
          if (item.name == key) value = item.value;
        });
        return value;
      }
    } else {
      formdata = form.prop("formdata") || [];
      return formdata;
    }
  },
});

$.fn.extend({
  startLoader: function (disable_form, size = 16) {
    let degrees = 0;
    let $this = $(this);
    if ($this) {
      $this.append(
        $("<img>")
          .addClass("_loader")
          .attr({ src: site.backend + "icons/rotate_right.svg", disabled: true })
          .css({ width: size })
      );
      let rocket = $(this).find("._loader")[0];
      let interval = setInterval(function () {
        degrees = degrees >= 359 ? 0 : degrees;
        degrees = parseInt(degrees) + parseInt(25);
        rocket.style.webkitTransform = "rotate(" + degrees + "deg)";
      }, 50);
      $this[0].interval = interval;
      if (disable_form === true) {
        $this.closest("form").disableForm();
      }
    }
    return $this;
  },
});

$.fn.extend({
  stopLoader: function (enable_form) {
    let degrees = 0;
    let $this = $(this);
    if ($this[0].interval) {
      let interval = $this[0].interval;
      clearInterval(interval);
      $this.attr({ disabled: false }).find("._loader").remove();
      if (enable_form === true) {
        $this.closest("form").enableForm();
      }
    }
  },
});
if (typeof toast !== "function") {
  function toast(msg, color = "green", time) {
    time = time || 2000;
    var ts = $("<div>")
      .appendTo("body")
      .css({
        overflow: "hidden",
        display: "block",
        position: "fixed",
        "z-index": "800001",
        top: "30px",
        right: "4%",
        "background-color": color,
        "border-radius": "2px",
        "text-align": "center",
      })
      .addClass(color)
      .attr({ id: "toast-container_" })
      .append(
        $("<div>")
          .css({
            "background-color": color,
            opacity: "1",
            float: "left",
            padding: "5px 10px",
            "text-align": "center",
            "line-height": "30px",
            "margin-top": "0px",
            "font-size": "15px",
            color: "white",
            "font-family": "'Raleway', sans-serif",
          })
          .addClass("toast_")
          .text(msg)
      );
    $(ts).animate({ top: 10 }, 1000);
    setTimeout(function () {
      $(ts).remove();
    }, time);
  }
}
if (typeof isJson !== "function") {
  window.isJson = function (str) {
    "use strict";
    if (!str) {
      return false;
    } else if (typeof str == "object") {
      return str;
    } else {
      try {
        var data = JSON.parse(str);
        if (typeof data !== "object") {
          return false;
        }
        return data;
      } catch (e) {
        return false;
      }
    }
  };
}
if (!jQuery.fn.swapDiv) {
  $.fn.extend({
    swapDiv: function (toshow, callback) {
      if ($(this).length) {
        $(toshow).hide();
        $(this).animate({ marginLeft: "-5%", opacity: 0 }, "fast", function () {
          $(this).hide();
          $(toshow).show().css({ opacity: 0, "margin-left": "-5%" }).animate({ marginLeft: "0%", opacity: 1 }, "slow");
          if (typeof callback == "function") {
            callback(toshow);
          }
        });
      } else {
        $(toshow).show();
        if (typeof callback == "function") {
          callback(toshow);
        }
      }
    },
  });
}
function strtourl(str) {
  str = str.toLowerCase().replace(/\[^0-9a-z]/gi, "");
  return str.replace(/ /g, "-");
}
$.fn.extend({
  clipboard: function (text) {
    if (!text) {
      $(this).click(function (e) {
        if ($(this).attr("data-clipboard-text")) text = $(this).attr("data-clipboard-text");
        else if ($(this).attr("data-clipboard-from")) text = $(`#${$(this).attr("data-clipboard-from")}`).text();
        $(this)._copy(text);
      });
    } else {
      $(this)._copy(text);
    }
    return $(this);
  },
  _copy: function (text) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
    $(this).css({ backgroundColor: "green", text: "white" });
    toast("Copied !!!");
  },
});
$("[data-clipboard-text]").clipboard();
