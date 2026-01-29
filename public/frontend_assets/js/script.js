$(document).ready(function () {
  // Scroll to top
  $(window).scroll(function () {
    if ($(this).scrollTop() > 400) {
      $("#scrollToTop").addClass("show");
    } else {
      $("#scrollToTop").removeClass("show");
    }
  });

  $("#scrollToTop").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 450);
    return false;
  });

  // Optional: better sticky behavior on resize / load
  function updateSticky() {
    const left = $(".sidebar").first();
    const right = $(".sidebar").last();

    if ($(window).width() >= 992) {
      left.css({ position: "sticky", top: "80px" });
      right.css({ position: "sticky", top: "80px" });
    } else {
      left.css({ position: "static" });
      right.css({ position: "static" });
    }
  }

  updateSticky();
  $(window).on("resize", updateSticky);
});
