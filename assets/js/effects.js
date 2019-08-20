"use strict";

(function ($) {
  //Imagem Submenu
  $('.has-image').each(function (index, element) {
    element == $(this);
    var url = $(this).attr('data-image');
    $(this).find('ul').append('<div class="content-right"><li class="image-child"><img src="' + url + '" /></li></div>');
  }); // HOVER MENU FUNC

  var target = document.querySelector(".target");
  var links = $('.menu-hover-effect a').not('.cart-contents');
  var colors = ["#d1e1ef", "#175186", "#b3dde9", "#248ba7", "#419ab3"];

  function mouseenterFunc() {
    if (!this.parentNode.classList.contains("active")) {
      for (var i = 0; i < links.length; i++) {
        if (links[i].parentNode.classList.contains("active")) {
          links[i].parentNode.classList.remove("active");
        } //links[i].style.opacity = "0.25";

      }

      this.parentNode.classList.add("active");
      this.style.opacity = "1";
      var width = this.getBoundingClientRect().width;
      var height = this.getBoundingClientRect().height;
      var left = this.getBoundingClientRect().left + window.pageXOffset;
      var top = this.getBoundingClientRect().top + window.pageYOffset + 5;
      var color = colors[Math.floor(Math.random() * colors.length)];
      target.style.width = width + 'px';
      target.style.height = height + 'px';
      target.style.left = left + 'px';
      target.style.top = top + 'px';
      target.style.borderColor = color;
      target.style.transform = "none";
    }
  }

  for (var i = 0; i < links.length; i++) {
    /* links[i].addEventListener("click", (e) => e.preventDefault()) */
    links[i].addEventListener("mouseenter", mouseenterFunc);
  }

  function resizeFunc() {
    var active = document.querySelector(".menu-container-effect li.active");

    if (active) {
      var left = active.getBoundingClientRect().left + window.pageXOffset;
      var top = active.getBoundingClientRect().top + window.pageYOffset;
      target.style.left = left + 'px';
      target.style.top = top + 'px';
    }
  } //hover Busca


  $('.search-form').on('click', function () {
    $('.search-form > span').addClass('show-effects');
  });
  $(document).mouseup(function (e) {
    var popup = $('.search-form > span');

    if (!$('.search-form').is(e.target) && !popup.is(e.target) && popup.has(e.target).length == 0) {
      popup.removeClass("show-effects");
    } //console.log(e)

  }); //let span
  //HOVER SUBMENU categorias

  $(".menu-item-has-children").hover(function () {
    // over
    $(this).addClass('has-children');
  }, function () {
    // out
    $(this).removeClass("has-children");
  }); //Carrousel

  var swiper = new Swiper('.slider-partners', {
    slidesPerView: 'auto',
    spaceBetween: 33,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    breakpoints: {
      1024: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      480: {
        slidesPerView: 1,
        spaceBetween: 10
      }
    }
  });
  var swiper2 = new Swiper('.slider-min-img', {
    slidesPerView: 3,
    loop: true,
    spaceBetween: 28,
    breakpoints: {
      1024: {
        slidesPerView: 2,
        spaceBetween: 10
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 0
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 10
      }
    }
  });
  var swiperLoopProds = new Swiper('.prod-slide', {
    slidesPerView: 4,
    navigation: {
      nextEl: ".next1",
      prevEl: ".prev1"
    },
    breakpoints: {
      1024: {
        slidesPerView: 3,
        spaceBetween: 0
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 0
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 10
      }
    }
  });
  var swiperLoopProds2 = new Swiper('.prod-slide-selling', {
    slidesPerView: 4,
    navigation: {
      nextEl: ".next2",
      prevEl: ".prev2"
    },
    breakpoints: {
      1024: {
        slidesPerView: 3,
        spaceBetween: 0
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 0
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 10
      }
    }
  });
  var swiperLoopProds3 = new Swiper('.prod-slide-outlet', {
    slidesPerView: 4,
    navigation: {
      nextEl: ".next3",
      prevEl: ".prev3"
    },
    breakpoints: {
      1024: {
        slidesPerView: 3,
        spaceBetween: 0
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 0
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 30
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 30
      }
    }
  }); // Show menu mobile

  $(".button-menu-mobile").click(function () {
    $(".container-menu-mobile").addClass("show-mobile-menu");
  });
  $(".xis").click(function () {
    $(".container-menu-mobile").removeClass("show-mobile-menu");
  }); //add to cart

  $(".ajax_add_to_cart").click(function (e) {
    e.preventDefault();
    var countClick = 1;
    var adtocartCount = parseInt($(".cart-contents-count").text());
    $(".cart-contents-count").html(adtocartCount + countClick);
  });
  window.addEventListener("resize", resizeFunc);
})(jQuery);