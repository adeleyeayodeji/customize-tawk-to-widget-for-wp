let customiseTawkToWidget = () => {
  //target iframe with title 'chat widget'
  var iframe = document.querySelectorAll('iframe[title="chat widget"]');
  //check if element exists
  if (iframe.length > 0) {
    //loop through only first and second frames
    iframe.forEach((element, index) => {
      //check if index is 1, exit
      if (index > 1) return;
      //check customise tawk.to widget position
      if (
        advancetawktocustomise.tawktocustomise_settings.widget_position ==
        "topLeft"
      ) {
        //set left style 20px
        element.style.setProperty("left", "20px", "important");
        //set right style auto
        element.style.setProperty("right", "auto", "important");
      } else {
        //set right style 20px
        element.style.setProperty("right", "20px", "important");
        //set left style auto
        element.style.setProperty("left", "auto", "important");
      }
    });
  }
};

document.addEventListener(
  "DOMContentLoaded",
  () => {
    window.Tawk_API = window.Tawk_API || {};

    // Set interval to check for .widget-visible or .widget-hidden class
    window.widgetVisibilityCheck = setInterval(() => {
      //check if .widget-visible exists
      if (document.querySelector(".widget-visible")) {
        //set advancetawktocustomise to display none to important
        document
          .querySelector(".widget-visible")
          .style.setProperty("display", "none", "important");

        //confirm .widget-visible is hidden then clear interval
        if (
          document.querySelector(".widget-visible").style.display === "none"
        ) {
          clearInterval(widgetVisibilityCheck);
        }
      }
    }, 50);

    window.Tawk_API.onLoad = function () {
      //display advancetawktocustomise
      document.querySelector(".advancetawktocustomise").style.display = "block";
      //hideWidget
      window.$_Tawk.hideWidget();
    };

    document
      .querySelector(".advancetawktocustomise-new-design")
      .addEventListener("click", () => {
        //then toggle widget
        window.$_Tawk.toggle();
      });

    window.Tawk_API.onChatMinimized = function () {
      //fade in advancetawktocustomisebtn
      document.querySelector(".advancetawktocustomise").style.display = "block";
      //hide widget
      window.$_Tawk.hideWidget();
    };

    window.Tawk_API.onChatMaximized = function () {
      document.querySelector(".advancetawktocustomise").style.display = "none";
    };

    //customise init
    let initcustomise = () => {
      //init
      document.querySelector(".advancetawktocustomise").style.display = "block";
      //hideWidget
      window.$_Tawk.hideWidget();
      //check element exist and set widget-hidden to block
      if (document.querySelector(".widget-hidden")) {
        document.querySelector(".widget-hidden").style.display = "block";
      }
      //check element exist and set widget-visible to none
      if (document.querySelector(".widget-visible")) {
        document.querySelector(".widget-visible").style.display = "block";
      }
    };

    //set interval to check if api has onBeforeLoaded hasOwnProperty and is true
    let tawkApiCheck = setInterval(() => {
      if (
        window.Tawk_API.hasOwnProperty("onBeforeLoaded") &&
        window.Tawk_API.onBeforeLoaded
      ) {
        initcustomise();
        clearInterval(tawkApiCheck);
      }
    }, 500);
  },
  false
);

//set interval to check if api has onBeforeLoaded hasOwnProperty and is true
setInterval(() => {
  customiseTawkToWidget();
}, 50);
