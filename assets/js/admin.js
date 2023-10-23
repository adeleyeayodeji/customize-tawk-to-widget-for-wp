jQuery(document).ready(function ($) {
  //on change $("#customise-tawk-to-widget-switch")
  $("#customise-tawk-to-widget-switch").change(function () {
    //get #customise-tawk-to-widget-switch
    var $switch = $(this);
    //get the switch parent
    var $switchParent = $switch.parent();
    //get the next element
    var statusText = $switchParent.next();
    //check if switch is checked
    if ($switch.is(":checked")) {
      //set content
      statusText.text("Active");
    } else {
      //set content
      statusText.text("Inactive");
    }
  });

  $(".customise-tawk-to-widget-container--body--site-widget-save").click(
    function (e) {
      e.preventDefault();
      var button = $(this);
      //get #customise-tawk-to-widget-switch
      var $switch = $("#customise-tawk-to-widget-switch");
      var switchChecked = "inactive";
      //check if switch is checked
      if ($switch.is(":checked")) {
        switchChecked = "active";
      } else {
        switchChecked = "inactive";
      }
      //widget_position
      var $widgetPosition = $("select[name='widget_position']");
      //input gradient_left
      var $gradientLeft = $("input[name='gradient_left']");
      //input gradient_right
      var $gradientRight = $("input[name='gradient_right']");
      //data
      var data = {
        action: "customize_tawk_to_widget_save",
        switch: switchChecked,
        widget_position: $widgetPosition.val(),
        gradient_left: $gradientLeft.val(),
        gradient_right: $gradientRight.val(),
        nonce: advancetawktocustomise.nonce
      };
      //ajax
      $.ajax({
        type: "POST",
        url: advancetawktocustomise.ajaxurl,
        data,
        dataType: "json",
        beforeSend: () => {
          $(".notice").remove();
          //block .customise-tawk-to-main-body
          $(".customise-tawk-to-main-body").block({
            message: null,
            overlayCSS: {
              background: "#fff",
              opacity: 0.6
            },
            css: {
              border: 0,
              color: "#fff",
              padding: 0,
              backgroundColor: "transparent"
            }
          });
        },
        success: function (response) {
          //unblock .customise-tawk-to-main-body
          $(".customise-tawk-to-main-body").unblock();
          //check if response code is 200
          if (response.code == 200) {
            //show success message before button
            button.before(
              '<div class="notice notice-success is-dismissible customise-tawk-to-notice"><p>' +
                response.message +
                "</p></div>"
            );
            //remove success message after 5 seconds
            setTimeout(function () {
              $(".notice").remove();
            }, 10000);
          } else {
            //show error message
            button.before(
              '<div class="notice notice-error is-dismissible customise-tawk-to-notice"><p>' +
                response.message +
                "</p></div>"
            );
            //remove error message after 5 seconds
            setTimeout(function () {
              $(".notice").remove();
            }, 10000);
          }
        },
        error: () => {
          //unblock .customise-tawk-to-main-body
          $(".customise-tawk-to-main-body").unblock();
          //show error message
          button.before(
            '<div class="notice notice-error is-dismissible customise-tawk-to-notice"><p>' +
              advancetawktocustomise.error +
              "</p></div>"
          );
          //remove error message after 5 seconds
          setTimeout(function () {
            $(".notice").remove();
          }, 10000);
        }
      });
    }
  );
});
