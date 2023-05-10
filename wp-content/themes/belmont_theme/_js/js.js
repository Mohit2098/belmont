function loadProductSlider() {
  return {
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    infinite: false,
    asNavFor: ".products-nav",
  };
}

function loadProductNavSlider() {
  return {
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: ".slider-product",
    arrows: true,
    infinite: false,
    centerMode: false,
    focusOnSelect: true,
  };
}

jQuery(document).ready(function ($) {
  if($.cookie("trailerCookies")){
    ajaxRequest(); //call function for the page load
  }
  $(".rt-menu-toggle").click(function () {
    $("header.site-header").toggleClass("opened-menu");

    if ($(this).attr("aria-label") === "Open Menu") {
      $(this).attr("aria-label", "Close Menu");
    } else {
      $(this).attr("aria-label", "Open Menu");
    }
  });

  // submenu
  $(".bl-navigation ul.menu > li .sub-menu").before(
    "<span class='open-label'></span>"
  );
  $(window)
    .on("resize", function mobileViewUpdate() {
      var viewportWidth = $(window).width();
      if (viewportWidth < 992) {
        $(".bl-navigation ul.menu > li .open-label").click(function () {
          $(this).next(".sub-menu").toggleClass("open-sub-menu");
          $(this).parent().toggleClass("open-dropdown");
        });
      }
    })
    .trigger("resize");

  // collapse
  $(document).on("click", ".trigger-toggle", function () {
    $(this).prev().toggleClass("show");
    $(this).toggleClass("only-one");
  });
  $(document).on("click", ".option-toggle", function () {
    $(this).parent().next().toggleClass("show-content");
    $(this).toggleClass("opened");
  });

  // gallery slider
  $(".gallery-slider").slick({
    dots: false,
    arrows: false,
    infinite: false,
    centerMode: false,
    speed: 300,
    slidesToShow: 4.8,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3.8,
          slidesToScroll: 3,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
    ],
  });

  const slider = $(".gallery-slider");
  // slider
  //   .slick({
  //     dots: true
  //   });

  slider.on("wheel", function (e) {
    e.preventDefault();

    if (e.originalEvent.deltaY < 0) {
      $(this).slick("slickNext");
    } else {
      $(this).slick("slickPrev");
    }
  });

  // hero slider
  $(".hero-slider-bl").slick({
    dots: true,
    arrows: false,
    infinite: true,
    speed: 300,
    fade: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  // testimonial slider
  $(".testimonial-slider").slick({
    dots: false,
    arrows: false,
    infinite: true,
    autoplay: true,
    speed: 400,
    slidesToShow: 1,
    slidesToScroll: 1,
  });

  $(".slider-product").slick(loadProductSlider());
  $(".products-nav").slick(loadProductNavSlider());

  $(document).on("click", ".tabs-link-detail", function () {
    ajaxRequest();
    var tabID = $(this).data("tabid");
    jQuery.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action: "load_trailer_tab",
        tab_ID: tabID,
      },

      beforeSend: function () {
        jQuery("#loading-container").addClass("show-loader");
      },
      success: function (data) {
        jQuery(".trailer-archive").html(data);
        jQuery(".slider-product").slick(loadProductSlider());
        jQuery(".products-nav").slick(loadProductNavSlider());
        jQuery("#loading-container").removeClass("show-loader");
        ajaxRequest();
      },
      error: function (errorThrown) {
        jQuery(".trailer-archive").html(
          "<div class='result_content'><h3>No Trailers Found!</h3></div>"
        );
      },
    });
  });

  $(".link-trailer").on("click", function () {
    $("html, body").animate(
      {
        scrollTop: $(".detail-box").offset().top - 200,
      },
      1000
    );
  });

  // Define function to make AJAX request

  function ajaxRequest() {
    let trailerCookie = $.cookie("trailerCookies") || "";
    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action: "trailer_cookie",
        trailerCookies: trailerCookie,
      },
      beforeSend: function () {
        jQuery("#loading-container").show();
      },
      success: function (data) {
        if (data.trim().length > 0) {
          $(".action-wrap").removeClass("d-none");
          $(".filter-stripe-wrap").removeClass("hidden-filter");
          $(".filter-stripe-wrap").addClass("show-filter");
        } else {
          $(".action-wrap").addClass("d-none");
          $(".filter-stripe-wrap").addClass("hidden-filter");
          $(".filter-stripe-wrap").removeClass("show-filter");
        }
        jQuery("#loading-container").hide();
        $(".filter-stripe-wrap >.wrapperCl").html(data);
      },
    });
  }

  // Add trailer to compare
  
  $(document).on("click", ".inCompare", function () {
    let trailerCookie = $.cookie("trailerCookies") || "";
    let trailerData = $(this).attr("data-id");

    if (trailerCookie.split(",").length >= 5) {
      let trailerArray = trailerCookie.split(",");
      trailerArray.pop();
      trailerArray.pop();
      trailerCookie = trailerArray.join(",") + ",";
    } else {
      let trailerArray = trailerCookie.split(",");

      if (trailerArray.includes(trailerData)) {
        trailerCookie = trailerCookie.replace(`${trailerData+ ','}`,'');
      }
      if (!trailerArray.includes(trailerData)) {
        trailerCookie = trailerCookie + trailerData + ",";
      }
    }
    // Create cookie for trailers
    $.cookie("trailerCookies", trailerCookie, {path: "/",});
    ajaxRequest();
  });

  // Remove trailer from compare
  $(document).on("click", ".remove-trailer", function () {
    let trailerData = $(this).attr("data-id");
    let trailerCookie = $.cookie("trailerCookies").replace(`${trailerData + ","}`,"");
    $.cookie("trailerCookies", trailerCookie, { path: "/" });
    ajaxRequest();
  });

  // Clear all cookies
  $(document).on("click", ".clear-button", function () {
    $.removeCookie("trailerCookies", { path: "/" });
    ajaxRequest();
  });

  // Compare trailers
  $(document).on("click", ".compare-button", function () {
    let trailerCookie = $.cookie("trailerCookies") || "";

    if (trailerCookie.split(",").length >= 3) {
      let dataSource = $(".compare-button").attr("data-redirect");
      $(".compare-button").attr("href",dataSource);
    } else {
      $(".compare-button").removeAttr("href");
      $(".compare-box.highlight-border").css("border", "2px dashed red");
    }
  });
  });
