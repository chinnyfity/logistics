
! function(a) {
  "use strict";

  function t() {
    a(".slimscroll").slimscroll({
      height: "auto",
      position: "right",
      size: "7px",
      color: "#9ea5ab",
      wheelStep: 5,
      touchScrollStep: 50
    })
  }
  t(), a("#side-nav").metisMenu(), a(".button-menu-mobile").on("click", function(e) {
    e.preventDefault(), a("body").toggleClass("enlarge-menu"), t()
  }), a(window).width() < 1025 ? a("body").addClass("enlarge-menu") : 1 != a("body").data("keep-enlarged") && a("body").removeClass("enlarge-menu"), a(".left-sidenav a").each(function() {
    var e = window.location.href.split(/[?#]/)[0];
    this.href == e && (a(this).addClass("active"), a(this).parent().addClass("active"), a(this).parent().parent().addClass("in"), a(this).parent().parent().prev().addClass("active"), a(this).parent().parent().parent().addClass("active"), a(this).parent().parent().parent().parent().addClass("in"), a(this).parent().parent().parent().parent().parent().addClass("active"))
  }), Waves.init()
}(jQuery);