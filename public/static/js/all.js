/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/js--sources/main.js":
/*!**********************************************!*\
  !*** ./resources/assets/js--sources/main.js ***!
  \**********************************************/
/***/ (() => {

AOS.init({
  duration: 800,
  easing: 'slide',
  once: false
});
jQuery(document).ready(function ($) {
  'use strict';

  var resetForm = function resetForm(form) {
    $(form).trigger('reset');
    $(form).find('.err-msg-block').remove();
    $(form).find('.has-error').remove();
    $(form).find('.invalid').attr('title', '').removeClass('invalid');
  };
  var sendAjax = function sendAjax(url, data, callback, type) {
    data = data || {};
    if (typeof type == 'undefined') type = 'json';
    $.ajax({
      type: 'post',
      url: url,
      data: data,
      // processData: false,
      // contentType: false,
      dataType: type,
      beforeSend: function beforeSend(request) {
        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
      },
      success: function success(json) {
        if (typeof callback == 'function') {
          callback(json);
        }
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        alert('Не удалось выполнить запрос! Ошибка на сервере.');
        console.log(errorThrown);
      }
    });
  };

  //перезвонить
  $('#contact-us').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    var url = form.attr('action');
    sendAjax(url, data, function (json) {
      if (typeof json.errors !== 'undefined') {
        var focused = false;
        for (var key in json.errors) {
          if (!focused) {
            form.find('#' + key).focus();
            focused = true;
          }
          form.find('#' + key).after('<span class="has-error">' + json.errors[key] + '</span>');
        }
        form.find('.form-res').after('<div class="err-msg-block has-error">Заполните, пожалуйста, обязательные поля.</div>');
      } else {
        resetForm(form);
        alert('Сообщение отправлено!');
      }
    });
  });
  $('.loader').delay(1000).fadeOut('slow');
  $('#overlayer').delay(1000).fadeOut('slow');
  var siteMenuClone = function siteMenuClone() {
    $('.js-clone-nav').each(function () {
      var $this = $(this);
      $this.clone().attr('class', 'site-nav-wrap').appendTo('.site-mobile-menu-body');
    });
    setTimeout(function () {
      var counter = 0;
      $('.site-mobile-menu .has-children').each(function () {
        var $this = $(this);
        $this.prepend('<span class="arrow-collapse collapsed">');
        $this.find('.arrow-collapse').attr({
          'data-toggle': 'collapse',
          'data-target': '#collapseItem' + counter
        });
        $this.find('> ul').attr({
          "class": 'collapse',
          id: 'collapseItem' + counter
        });
        counter++;
      });
    }, 1000);
    $('body').on('click', '.arrow-collapse', function (e) {
      var $this = $(this);
      if ($this.closest('li').find('.collapse').hasClass('show')) {
        $this.removeClass('active');
      } else {
        $this.addClass('active');
      }
      e.preventDefault();
    });
    $(window).resize(function () {
      var $this = $(this),
        w = $this.width();
      if (w > 768) {
        if ($('body').hasClass('offcanvas-menu')) {
          $('body').removeClass('offcanvas-menu');
        }
      }
    });
    $('body').on('click', '.js-menu-toggle', function (e) {
      var $this = $(this);
      e.preventDefault();
      if ($('body').hasClass('offcanvas-menu')) {
        $('body').removeClass('offcanvas-menu');
        $this.removeClass('active');
      } else {
        $('body').addClass('offcanvas-menu');
        $this.addClass('active');
      }
    });

    // click outisde offcanvas
    $(document).mouseup(function (e) {
      var container = $('.site-mobile-menu');
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('offcanvas-menu')) {
          $('body').removeClass('offcanvas-menu');
        }
      }
    });
  };
  siteMenuClone();
  var sitePlusMinus = function sitePlusMinus() {
    $('.js-btn-minus').on('click', function (e) {
      e.preventDefault();
      if ($(this).closest('.input-group').find('.form-control').val() != 0) {
        $(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
      } else {
        $(this).closest('.input-group').find('.form-control').val(parseInt(0));
      }
    });
    $('.js-btn-plus').on('click', function (e) {
      e.preventDefault();
      $(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) + 1);
    });
  };
  // sitePlusMinus();

  var siteSliderRange = function siteSliderRange() {
    $('#slider-range').slider({
      range: true,
      min: 0,
      max: 500,
      values: [75, 300],
      slide: function slide(event, ui) {
        $('#amount').val('$' + ui.values[0] + ' - $' + ui.values[1]);
      }
    });
    $('#amount').val('$' + $('#slider-range').slider('values', 0) + ' - $' + $('#slider-range').slider('values', 1));
  };
  // siteSliderRange();

  var siteCarousel = function siteCarousel() {
    if ($('.nonloop-block-13').length > 0) {
      $('.nonloop-block-13').owlCarousel({
        center: false,
        items: 1,
        loop: true,
        stagePadding: 0,
        margin: 0,
        smartSpeed: 1000,
        autoplay: true,
        nav: true,
        navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">'],
        responsive: {
          600: {
            margin: 0,
            nav: true,
            items: 2
          },
          1000: {
            margin: 0,
            stagePadding: 0,
            nav: true,
            items: 2
          },
          1200: {
            margin: 0,
            stagePadding: 0,
            nav: true,
            items: 3
          }
        }
      });
    }
    $('.slide-one-item').owlCarousel({
      center: false,
      items: 1,
      loop: true,
      stagePadding: 0,
      margin: 0,
      smartSpeed: 1500,
      autoplay: true,
      pauseOnHover: false,
      dots: true,
      nav: true,
      navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">']
    });
    if ($('.owl-all').length > 0) {
      $('.owl-all').owlCarousel({
        center: false,
        items: 1,
        loop: false,
        stagePadding: 0,
        margin: 0,
        autoplay: false,
        nav: false,
        dots: true,
        touchDrag: true,
        mouseDrag: true,
        smartSpeed: 1000,
        navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">'],
        responsive: {
          768: {
            margin: 30,
            nav: false,
            responsiveRefreshRate: 10,
            items: 1
          },
          992: {
            margin: 30,
            stagePadding: 0,
            nav: false,
            responsiveRefreshRate: 10,
            touchDrag: false,
            mouseDrag: false,
            items: 3
          },
          1200: {
            margin: 30,
            stagePadding: 0,
            nav: false,
            responsiveRefreshRate: 10,
            touchDrag: false,
            mouseDrag: false,
            items: 3
          }
        }
      });
    }
  };
  siteCarousel();
  var siteCountDown = function siteCountDown() {
    $('#date-countdown').countdown('2020/10/10', function (event) {
      var $this = $(this).html(event.strftime('' + '<span class="countdown-block"><span class="label">%w</span> weeks </span>' + '<span class="countdown-block"><span class="label">%d</span> days </span>' + '<span class="countdown-block"><span class="label">%H</span> hr </span>' + '<span class="countdown-block"><span class="label">%M</span> min </span>' + '<span class="countdown-block"><span class="label">%S</span> sec</span>'));
    });
  };
  // siteCountDown();

  var siteDatePicker = function siteDatePicker() {
    if ($('.datepicker').length > 0) {
      $('.datepicker').datepicker();
    }
  };
  // siteDatePicker();

  var siteSticky = function siteSticky() {
    $('.js-sticky-header').sticky();
    // $('.js-sticky-header').sticky({ topSpacing: 0 });
  };

  siteSticky();

  // navigation
  var OnePageNavigation = function OnePageNavigation() {
    var navToggler = $('.site-menu-toggle');
    $('body').on('click', ".main-menu li a[href^='#'], .smoothscroll[href^='#'], .site-mobile-menu .site-nav-wrap li a[href^='#']", function (e) {
      e.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top - 50
      }, 600, 'easeInOutExpo', function () {
        // window.location.hash = hash;
      });
    });
  };
  OnePageNavigation();
  var siteScroll = function siteScroll() {
    $(window).scroll(function () {
      var st = $(this).scrollTop();
      if (st > 100) {
        $('.js-sticky-header').addClass('is-sticky');
      } else {
        $('.js-sticky-header').removeClass('is-sticky');
      }
    });
  };
  siteScroll();
  var counter = function counter() {
    $('#about-section').waypoint(function (direction) {
      if (direction === 'down' && !$(this.element).hasClass('ftco-animated')) {
        var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',');
        $('.number > span').each(function () {
          var $this = $(this),
            num = $this.data('number');
          $this.animateNumber({
            number: num,
            numberStep: comma_separator_number_step
          }, 7000);
        });
      }
    }, {
      offset: '95%'
    });
  };
  counter();
});

/***/ }),

/***/ "./resources/assets/css/main.css":
/*!***************************************!*\
  !*** ./resources/assets/css/main.css ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/static/js/all": 0,
/******/ 			"static/css/all": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["static/css/all"], () => (__webpack_require__("./resources/assets/js--sources/main.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["static/css/all"], () => (__webpack_require__("./resources/assets/css/main.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;