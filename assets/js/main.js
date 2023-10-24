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
        element.style.left = "20px";
        //set right style auto
        element.style.right = "auto";
      } else {
        //set right style 20px
        element.style.right = "20px";
        //set left style auto
        element.style.left = "auto";
      }
    });
  }
};

document.addEventListener(
  "DOMContentLoaded",
  () => {
    window.Tawk_API = window.Tawk_API || {};
    window.Tawk_API.onLoad = function () {
      window.$_Tawk.hideWidget();
    };

    document
      .querySelector(".advancetawktocustomise-new-design")
      .addEventListener("click", () => {
        window.$_Tawk.toggle();
      });

    window.Tawk_API.onChatMinimized = function () {
      //fade in advancetawktocustomisebtn
      document.querySelector(".advancetawktocustomise").style.display = "block";
    };

    window.Tawk_API.onChatMaximized = function () {
      document.querySelector(".advancetawktocustomise").style.display = "none";
    };

    setInterval(() => {
      customiseTawkToWidget();
    }, 500);
  },
  false
);
