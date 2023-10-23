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
  },
  false
);
