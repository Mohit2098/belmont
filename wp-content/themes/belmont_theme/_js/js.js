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
  if ($.cookie("tabCookie")) {
    loadTabContent($.cookie("tabCookie"));
  }
  if ($.cookie("trailerCookies")) {
    ajaxRequest();
    updateCompareButtons();
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

  // Created tabCookie for tabContent
  function activateTab(tabID) {
    $.cookie("tabCookie", tabID, { path: "/" });
  }

  $(document).on("click", ".tabContentCl", function () {
    let tabID = $(this).data("tabid");
    activateTab(tabID);
  });

  $(document).on("click", ".tabs-link-detail", function () {
    let tabID = $(this).data("tabid");
    loadTabContent(tabID);
  });

  function loadTabContent(tabID) {
    ajaxRequest();
    updateCompareButtons();

    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action: "load_trailer_tab",
        tab_ID: tabID,
      },
      beforeSend: function () {
        $("#loading-container").addClass("show-loader");
      },
      success: function (data) {
        $(".trailer-archive").html(data);
        $(".slider-product").slick(loadProductSlider());
        $(".products-nav").slick(loadProductNavSlider());
        $("#loading-container").removeClass("show-loader");
        ajaxRequest();
        updateCompareButtons();
      },
      error: function (errorThrown) {
        $(".trailer-archive").html(
          "<div class='result_content'><h3>No Trailers Found!</h3></div>"
        );
      },
      complete: function () {
        destroyTabCookie();
      },
    });
  }
  // function to destroy the tabcookie
  function destroyTabCookie() {
    $.removeCookie("tabCookie", { path: "/" });
  }

  $(".link-trailer").on("click", function () {
    $("html, body").animate(
      {
        scrollTop: $(".detail-box").offset().top - 200,
      },
      1000
    );
  });

  // Define function to make AJAX request for trailerCookies
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

  // Update the compare button
  function updateCompareButtons() {
    let trailerCookie = $.cookie("trailerCookies");
    let trailerArray = trailerCookie ? trailerCookie.split(",") : [];
    let inCompareButtons = $(".addToCompare");
    inCompareButtons.each(function () {
      let trailerData = $(this).attr("data-id");
      if (trailerArray.includes(trailerData)) {
        $(this).addClass("addedCompare").html('<img src="/wp-content/themes/belmont_theme/_images/check-icon.svg">IN COMPARE');
      } else {
        $(this).removeClass("addedCompare").text("ADD TO COMPARE");
      }
    });
  }

  // Add trailer to compare
  $(document).on("click", ".addToCompare", function () {
    let trailerCookie = $.cookie("trailerCookies") || "";
    let trailerData = $(this).attr("data-id");
    let trailerArray = trailerCookie.split(",");
    if (trailerArray.length >= 4) {
      trailerArray.splice(-1, 1);
      trailerCookie = trailerArray.toString() + ",";
    } else {
      if (trailerArray.includes(trailerData)) {
        trailerArray.splice(trailerArray.indexOf(trailerData), 1);
        trailerCookie = trailerArray.toString() + ",";
      } else {
        trailerCookie = trailerCookie.length
          ? trailerCookie + "," + trailerData + ","
          : trailerData + ",";
      }
    }
    $.cookie("trailerCookies", trailerCookie.slice(0, -1), { path: "/" });
    ajaxRequest();
    updateCompareButtons();
  });

  // Remove trailer from compare
  $(document).on("click", ".remove-trailer", function () {
    let removeTrailerData = $(this).attr("data-id");
    let removeTrailerCookie = $.cookie("trailerCookies").split(",");
    removeTrailerCookie.splice(
      removeTrailerCookie.indexOf(removeTrailerData),
      1
    );
    $.cookie("trailerCookies", removeTrailerCookie, { path: "/" });
    ajaxRequest();
    updateCompareButtons();
  });

  // Clear all cookies
  $(document).on("click", ".clear-button", function () {
    $.removeCookie("trailerCookies", { path: "/" });
    ajaxRequest();
    updateCompareButtons();
  });

  // Compare trailers
  $(document).on("click", ".compare-button", function () {
    let compareTrailerCookie = $.cookie("trailerCookies") || "";
    if (compareTrailerCookie.split(",").length >= 2) {
      let dataSource = $(".compare-button").attr("data-redirect");
      $(".compare-button").attr("href", dataSource);
    } else {
      $(".compare-button").removeAttr("href");
      $(".compare-box.highlight-border").addClass("highlight-border-cl");
    }
  });
});
