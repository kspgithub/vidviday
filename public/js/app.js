(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/app"],{

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

__webpack_require__(/*! ./libs/jquery-ui.min */ "./resources/js/libs/jquery-ui.min.js");

window.Swiper = __webpack_require__(/*! ./libs/swiper.min */ "./resources/js/libs/swiper.min.js");

__webpack_require__(/*! ./libs/jquery.sumoselect.min */ "./resources/js/libs/jquery.sumoselect.min.js");

__webpack_require__(/*! ./libs/jquery.inputmask.min */ "./resources/js/libs/jquery.inputmask.min.js");

__webpack_require__(/*! ./libs/SmoothScroll */ "./resources/js/libs/SmoothScroll.js");

__webpack_require__(/*! ./libs/datepicker.min */ "./resources/js/libs/datepicker.min.js");

__webpack_require__(/*! ./libs/full-calendar */ "./resources/js/libs/full-calendar.js");

__webpack_require__(/*! ./libs/global */ "./resources/js/libs/global.js");

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo';
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

window.moment = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");

/***/ }),

/***/ "./resources/js/libs/SmoothScroll.js":
/*!*******************************************!*\
  !*** ./resources/js/libs/SmoothScroll.js ***!
  \*******************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*////////////////////*/

/* - SMOOTH SCCROLL - */

/*////////////////////*/
// SmoothScroll for websites v1.4.9 (Balazs Galambosi)
// http://www.smoothscroll.net/
// Licensed under the terms of the MIT license.
// You may use it in your theme if you credit me. 
// It is also free to use on any individual website.
// Exception:
// The only restriction is to not publish any  
// extension for browsers or native application
// without getting a written permission first.
!function () {
  var e,
      t,
      o,
      n,
      r = {
    frameRate: 144,
    animationTime: 1400,
    stepSize: 120,
    pulseAlgorithm: true,
    pulseScale: 4,
    pulseNormalize: 1,
    accelerationDelta: 60,
    accelerationMax: 3,
    keyboardSupport: true,
    arrowScroll: 50,
    fixedBackground: true,
    excluded: ''
  },
      a = r,
      l = !1,
      i = !1,
      c = {
    x: 0,
    y: 0
  },
      u = !1,
      s = document.documentElement,
      d = [],
      f = /^Mac/.test(navigator.platform),
      m = {
    left: 37,
    up: 38,
    right: 39,
    down: 40,
    spacebar: 32,
    pageup: 33,
    pagedown: 34,
    end: 35,
    home: 36
  },
      h = {
    37: 1,
    38: 1,
    39: 1,
    40: 1
  };

  function w() {
    if (!u && document.body) {
      u = !0;
      var n = document.body,
          r = document.documentElement,
          c = window.innerHeight,
          d = n.scrollHeight;
      if (s = document.compatMode.indexOf("CSS") >= 0 ? r : n, e = n, a.keyboardSupport && A("keydown", S), top != self) i = !0;else if (Z && d > c && (n.offsetHeight <= c || r.offsetHeight <= c)) {
        var f,
            m = document.createElement("div");
        m.style.cssText = "position:absolute; z-index:-10000; top:0; left:0; right:0; height:" + s.scrollHeight + "px", document.body.appendChild(m), o = function o() {
          f || (f = setTimeout(function () {
            l || (m.style.height = "0", m.style.height = s.scrollHeight + "px", f = null);
          }, 500));
        }, setTimeout(o, 10), A("resize", o);

        if ((t = new q(o)).observe(n, {
          attributes: !0,
          childList: !0,
          characterData: !1
        }), s.offsetHeight <= c) {
          var h = document.createElement("div");
          h.style.clear = "both", n.appendChild(h);
        }
      }
      a.fixedBackground || l || (n.style.backgroundAttachment = "scroll", r.style.backgroundAttachment = "scroll");
    }
  }

  var p = [],
      v = !1,
      y = Date.now();

  function b(e, t, o) {
    var n, r;

    if (n = (n = t) > 0 ? 1 : -1, r = (r = o) > 0 ? 1 : -1, (c.x !== n || c.y !== r) && (c.x = n, c.y = r, p = [], y = 0), 1 != a.accelerationMax) {
      var l = Date.now() - y;

      if (l < a.accelerationDelta) {
        var i = (1 + 50 / l) / 2;
        i > 1 && (i = Math.min(i, a.accelerationMax), t *= i, o *= i);
      }

      y = Date.now();
    }

    if (p.push({
      x: t,
      y: o,
      lastX: t < 0 ? .99 : -.99,
      lastY: o < 0 ? .99 : -.99,
      start: Date.now()
    }), !v) {
      var u = V(),
          s = e === u || e === document.body;
      null == e.$scrollBehavior && function (e) {
        var t = M(e);

        if (null == B[t]) {
          var o = getComputedStyle(e, "")["scroll-behavior"];
          B[t] = "smooth" == o;
        }

        return B[t];
      }(e) && (e.$scrollBehavior = e.style.scrollBehavior, e.style.scrollBehavior = "auto");

      var d = function d(n) {
        for (var r = Date.now(), l = 0, i = 0, c = 0; c < p.length; c++) {
          var u = p[c],
              f = r - u.start,
              m = f >= a.animationTime,
              h = m ? 1 : f / a.animationTime;
          a.pulseAlgorithm && (h = I(h));
          var w = u.x * h - u.lastX >> 0,
              y = u.y * h - u.lastY >> 0;
          l += w, i += y, u.lastX += w, u.lastY += y, m && (p.splice(c, 1), c--);
        }

        s ? window.scrollBy(l, i) : (l && (e.scrollLeft += l), i && (e.scrollTop += i)), t || o || (p = []), p.length ? R(d, e, 1e3 / a.frameRate + 1) : (v = !1, null != e.$scrollBehavior && (e.style.scrollBehavior = e.$scrollBehavior, e.$scrollBehavior = null));
      };

      R(d, e, 0), v = !0;
    }
  }

  function g(t) {
    u || w();
    var o = t.target;
    if (t.defaultPrevented || t.ctrlKey) return !0;
    if (K(e, "embed") || K(o, "embed") && /\.pdf/i.test(o.src) || K(e, "object") || o.shadowRoot) return !0;
    var r = -t.wheelDeltaX || t.deltaX || 0,
        l = -t.wheelDeltaY || t.deltaY || 0;
    f && (t.wheelDeltaX && P(t.wheelDeltaX, 120) && (r = t.wheelDeltaX / Math.abs(t.wheelDeltaX) * -120), t.wheelDeltaY && P(t.wheelDeltaY, 120) && (l = t.wheelDeltaY / Math.abs(t.wheelDeltaY) * -120)), r || l || (l = -t.wheelDelta || 0), 1 === t.deltaMode && (r *= 40, l *= 40);
    var c = L(o);
    return c ? !!function (e) {
      if (!e) return;
      d.length || (d = [e, e, e]);
      e = Math.abs(e), d.push(e), d.shift(), clearTimeout(n), n = setTimeout(function () {
        try {
          localStorage.SS_deltaBuffer = d.join(",");
        } catch (e) {}
      }, 1e3);
      var t = e > 120 && $(e);
      return !$(120) && !$(100) && !t;
    }(l) || (Math.abs(r) > 1.2 && (r *= a.stepSize / 120), Math.abs(l) > 1.2 && (l *= a.stepSize / 120), b(c, r, l), t.preventDefault(), void C()) : !i || !U || (Object.defineProperty(t, "target", {
      value: window.frameElement
    }), parent.wheel(t));
  }

  function S(t) {
    var o = t.target,
        n = t.ctrlKey || t.altKey || t.metaKey || t.shiftKey && t.keyCode !== m.spacebar;
    document.body.contains(e) || (e = document.activeElement);
    var r = /^(button|submit|radio|checkbox|file|color|image)$/i;
    if (t.defaultPrevented || /^(textarea|select|embed|object)$/i.test(o.nodeName) || K(o, "input") && !r.test(o.type) || K(e, "video") || function (e) {
      var t = e.target,
          o = !1;
      if (-1 != document.URL.indexOf("www.youtube.com/watch")) do {
        if (o = t.classList && t.classList.contains("html5-video-controls")) break;
      } while (t = t.parentNode);
      return o;
    }(t) || o.isContentEditable || n) return !0;
    if ((K(o, "button") || K(o, "input") && r.test(o.type)) && t.keyCode === m.spacebar) return !0;
    if (K(o, "input") && "radio" == o.type && h[t.keyCode]) return !0;
    var l = 0,
        c = 0,
        u = L(e);
    if (!u) return !i || !U || parent.keydown(t);
    var s = u.clientHeight;

    switch (u == document.body && (s = window.innerHeight), t.keyCode) {
      case m.up:
        c = -a.arrowScroll;
        break;

      case m.down:
        c = a.arrowScroll;
        break;

      case m.spacebar:
        c = -(t.shiftKey ? 1 : -1) * s * .9;
        break;

      case m.pageup:
        c = .9 * -s;
        break;

      case m.pagedown:
        c = .9 * s;
        break;

      case m.home:
        u == document.body && document.scrollingElement && (u = document.scrollingElement), c = -u.scrollTop;
        break;

      case m.end:
        var d = u.scrollHeight - u.scrollTop - s;
        c = d > 0 ? d + 10 : 0;
        break;

      case m.left:
        l = -a.arrowScroll;
        break;

      case m.right:
        l = a.arrowScroll;
        break;

      default:
        return !0;
    }

    b(u, l, c), t.preventDefault(), C();
  }

  function x(t) {
    e = t.target;
  }

  var k,
      D,
      M = (k = 0, function (e) {
    return e.uniqueID || (e.uniqueID = k++);
  }),
      E = {},
      T = {},
      B = {};

  function C() {
    clearTimeout(D), D = setInterval(function () {
      E = T = B = {};
    }, 1e3);
  }

  function H(e, t, o) {
    for (var n = o ? E : T, r = e.length; r--;) {
      n[M(e[r])] = t;
    }

    return t;
  }

  function z(e, t) {
    return (t ? E : T)[M(e)];
  }

  function L(e) {
    var t = [],
        o = document.body,
        n = s.scrollHeight;

    do {
      var r = z(e, !1);
      if (r) return H(t, r);

      if (t.push(e), n === e.scrollHeight) {
        var a = X(s) && X(o) || Y(s);
        if (i && O(s) || !i && a) return H(t, V());
      } else if (O(e) && Y(e)) return H(t, e);
    } while (e = e.parentElement);
  }

  function O(e) {
    return e.clientHeight + 10 < e.scrollHeight;
  }

  function X(e) {
    return "hidden" !== getComputedStyle(e, "").getPropertyValue("overflow-y");
  }

  function Y(e) {
    var t = getComputedStyle(e, "").getPropertyValue("overflow-y");
    return "scroll" === t || "auto" === t;
  }

  function A(e, t, o) {
    window.addEventListener(e, t, o || !1);
  }

  function N(e, t, o) {
    window.removeEventListener(e, t, o || !1);
  }

  function K(e, t) {
    return e && (e.nodeName || "").toLowerCase() === t.toLowerCase();
  }

  if (window.localStorage && localStorage.SS_deltaBuffer) try {
    d = localStorage.SS_deltaBuffer.split(",");
  } catch (e) {}

  function P(e, t) {
    return Math.floor(e / t) == e / t;
  }

  function $(e) {
    return P(d[0], e) && P(d[1], e) && P(d[2], e);
  }

  var j,
      R = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function (e, t, o) {
    window.setTimeout(e, o || 1e3 / 60);
  },
      q = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver,
      V = (j = document.scrollingElement, function () {
    if (!j) {
      var e = document.createElement("div");
      e.style.cssText = "height:10000px;width:1px;", document.body.appendChild(e);
      var t = document.body.scrollTop;
      document.documentElement.scrollTop, window.scrollBy(0, 3), j = document.body.scrollTop != t ? document.body : document.documentElement, window.scrollBy(0, -3), document.body.removeChild(e);
    }

    return j;
  });

  function F(e) {
    var t, o;
    return (e *= a.pulseScale) < 1 ? t = e - (1 - Math.exp(-e)) : (e -= 1, t = (o = Math.exp(-1)) + (1 - Math.exp(-e)) * (1 - o)), t * a.pulseNormalize;
  }

  function I(e) {
    return e >= 1 ? 1 : e <= 0 ? 0 : (1 == a.pulseNormalize && (a.pulseNormalize /= F(1)), F(e));
  }

  var _ = window.navigator.userAgent,
      W = /Edge/.test(_),
      U = /chrome/i.test(_) && !W,
      G = /safari/i.test(_) && !W,
      J = /mobile/i.test(_),
      Q = /Windows NT 6.1/i.test(_) && /rv:11/i.test(_),
      Z = G && (/Version\/8/i.test(_) || /Version\/9/i.test(_)),
      ee = (U || G || Q) && !J,
      te = !1;

  try {
    window.addEventListener("test", null, Object.defineProperty({}, "passive", {
      get: function get() {
        te = !0;
      }
    }));
  } catch (e) {}

  var oe = !!te && {
    passive: !1
  },
      ne = "onwheel" in document.createElement("div") ? "wheel" : "mousewheel";

  function re(e) {
    for (var t in e) {
      r.hasOwnProperty(t) && (a[t] = e[t]);
    }
  }

  ne && ee && (A(ne, g, oe), A("mousedown", x), A("load", w)), re.destroy = function () {
    t && t.disconnect(), N(ne, g), N("mousedown", x), N("keydown", S), N("resize", o), N("load", w);
  }, window.SmoothScrollOptions && re(window.SmoothScrollOptions),  true ? !(__WEBPACK_AMD_DEFINE_RESULT__ = (function () {
    return re;
  }).call(exports, __webpack_require__, exports, module),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : 0;
}();

/***/ }),

/***/ "./resources/js/libs/datepicker.min.js":
/*!*********************************************!*\
  !*** ./resources/js/libs/datepicker.min.js ***!
  \*********************************************/
/***/ (() => {

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*///////////////////////*/

/* AIR DATEPICKER PLUGIN */

/*///////////////////////*/
!function (t, e, i) {
  !function () {
    var s,
        a,
        n,
        h = "2.2.3",
        o = "datepicker",
        r = ".datepicker-here",
        c = !1,
        d = '<div class="datepicker"><i class="datepicker--pointer"></i><nav class="datepicker--nav"></nav><div class="datepicker--content"></div></div>',
        l = {
      classes: "",
      inline: !1,
      language: "ru",
      startDate: new Date(),
      firstDay: "",
      weekends: [6, 0],
      dateFormat: "",
      altField: "",
      altFieldDateFormat: "@",
      toggleSelected: !0,
      keyboardNav: !0,
      position: "bottom left",
      offset: 12,
      view: "days",
      minView: "days",
      showOtherMonths: !0,
      selectOtherMonths: !0,
      moveToOtherMonthsOnSelect: !0,
      showOtherYears: !0,
      selectOtherYears: !0,
      moveToOtherYearsOnSelect: !0,
      minDate: "",
      maxDate: "",
      disableNavWhenOutOfRange: !0,
      multipleDates: !1,
      multipleDatesSeparator: ",",
      range: !1,
      todayButton: !1,
      clearButton: !1,
      showEvent: "focus",
      autoClose: !1,
      monthsField: "monthsShort",
      prevHtml: '<svg><path d="M 17,12 l -5,5 l 5,5"></path></svg>',
      nextHtml: '<svg><path d="M 14,12 l 5,5 l -5,5"></path></svg>',
      navTitles: {
        days: "MM, <i>yyyy</i>",
        months: "yyyy",
        years: "yyyy1 - yyyy2"
      },
      timepicker: !1,
      onlyTimepicker: !1,
      dateTimeSeparator: " ",
      timeFormat: "",
      minHours: 0,
      maxHours: 24,
      minMinutes: 0,
      maxMinutes: 59,
      hoursStep: 1,
      minutesStep: 1,
      onSelect: "",
      onShow: "",
      onHide: "",
      onChangeMonth: "",
      onChangeYear: "",
      onChangeDecade: "",
      onChangeView: "",
      onRenderCell: ""
    },
        u = {
      ctrlRight: [17, 39],
      ctrlUp: [17, 38],
      ctrlLeft: [17, 37],
      ctrlDown: [17, 40],
      shiftRight: [16, 39],
      shiftUp: [16, 38],
      shiftLeft: [16, 37],
      shiftDown: [16, 40],
      altUp: [18, 38],
      altRight: [18, 39],
      altLeft: [18, 37],
      altDown: [18, 40],
      ctrlShiftUp: [16, 17, 38]
    },
        m = function m(t, a) {
      this.el = t, this.$el = e(t), this.opts = e.extend(!0, {}, l, a, this.$el.data()), s == i && (s = e("body")), this.opts.startDate || (this.opts.startDate = new Date()), "INPUT" == this.el.nodeName && (this.elIsInput = !0), this.opts.altField && (this.$altField = "string" == typeof this.opts.altField ? e(this.opts.altField) : this.opts.altField), this.inited = !1, this.visible = !1, this.silent = !1, this.currentDate = this.opts.startDate, this.currentView = this.opts.view, this._createShortCuts(), this.selectedDates = [], this.views = {}, this.keys = [], this.minRange = "", this.maxRange = "", this._prevOnSelectValue = "", this.init();
    };

    n = m, n.prototype = {
      VERSION: h,
      viewIndexes: ["days", "months", "years"],
      init: function init() {
        c || this.opts.inline || !this.elIsInput || this._buildDatepickersContainer(), this._buildBaseHtml(), this._defineLocale(this.opts.language), this._syncWithMinMaxDates(), this.elIsInput && (this.opts.inline || (this._setPositionClasses(this.opts.position), this._bindEvents()), this.opts.keyboardNav && !this.opts.onlyTimepicker && this._bindKeyboardEvents(), this.$datepicker.on("mousedown", this._onMouseDownDatepicker.bind(this)), this.$datepicker.on("mouseup", this._onMouseUpDatepicker.bind(this))), this.opts.classes && this.$datepicker.addClass(this.opts.classes), this.opts.timepicker && (this.timepicker = new e.fn.datepicker.Timepicker(this, this.opts), this._bindTimepickerEvents()), this.opts.onlyTimepicker && this.$datepicker.addClass("-only-timepicker-"), this.views[this.currentView] = new e.fn.datepicker.Body(this, this.currentView, this.opts), this.views[this.currentView].show(), this.nav = new e.fn.datepicker.Navigation(this, this.opts), this.view = this.currentView, this.$el.on("clickCell.adp", this._onClickCell.bind(this)), this.$datepicker.on("mouseenter", ".datepicker--cell", this._onMouseEnterCell.bind(this)), this.$datepicker.on("mouseleave", ".datepicker--cell", this._onMouseLeaveCell.bind(this)), this.inited = !0;
      },
      _createShortCuts: function _createShortCuts() {
        this.minDate = this.opts.minDate ? this.opts.minDate : new Date(-86399999136e5), this.maxDate = this.opts.maxDate ? this.opts.maxDate : new Date(86399999136e5);
      },
      _bindEvents: function _bindEvents() {
        this.$el.on(this.opts.showEvent + ".adp", this._onShowEvent.bind(this)), this.$el.on("mouseup.adp", this._onMouseUpEl.bind(this)), this.$el.on("blur.adp", this._onBlur.bind(this)), this.$el.on("keyup.adp", this._onKeyUpGeneral.bind(this)), e(t).on("resize.adp", this._onResize.bind(this)), e("body").on("mouseup.adp", this._onMouseUpBody.bind(this));
      },
      _bindKeyboardEvents: function _bindKeyboardEvents() {
        this.$el.on("keydown.adp", this._onKeyDown.bind(this)), this.$el.on("keyup.adp", this._onKeyUp.bind(this)), this.$el.on("hotKey.adp", this._onHotKey.bind(this));
      },
      _bindTimepickerEvents: function _bindTimepickerEvents() {
        this.$el.on("timeChange.adp", this._onTimeChange.bind(this));
      },
      isWeekend: function isWeekend(t) {
        return -1 !== this.opts.weekends.indexOf(t);
      },
      _defineLocale: function _defineLocale(t) {
        "string" == typeof t ? (this.loc = e.fn.datepicker.language[t], this.loc || (console.warn("Can't find language \"" + t + '" in Datepicker.language, will use "ru" instead'), this.loc = e.extend(!0, {}, e.fn.datepicker.language.ru)), this.loc = e.extend(!0, {}, e.fn.datepicker.language.ru, e.fn.datepicker.language[t])) : this.loc = e.extend(!0, {}, e.fn.datepicker.language.ru, t), this.opts.dateFormat && (this.loc.dateFormat = this.opts.dateFormat), this.opts.timeFormat && (this.loc.timeFormat = this.opts.timeFormat), "" !== this.opts.firstDay && (this.loc.firstDay = this.opts.firstDay), this.opts.timepicker && (this.loc.dateFormat = [this.loc.dateFormat, this.loc.timeFormat].join(this.opts.dateTimeSeparator)), this.opts.onlyTimepicker && (this.loc.dateFormat = this.loc.timeFormat);
        var i = this._getWordBoundaryRegExp;
        (this.loc.timeFormat.match(i("aa")) || this.loc.timeFormat.match(i("AA"))) && (this.ampm = !0);
      },
      _buildDatepickersContainer: function _buildDatepickersContainer() {
        c = !0, s.append('<div class="datepickers-container" id="datepickers-container"></div>'), a = e("#datepickers-container");
      },
      _buildBaseHtml: function _buildBaseHtml() {
        var t,
            i = e('<div class="datepicker-inline">');
        t = "INPUT" == this.el.nodeName ? this.opts.inline ? i.insertAfter(this.$el) : a : i.appendTo(this.$el), this.$datepicker = e(d).appendTo(t), this.$content = e(".datepicker--content", this.$datepicker), this.$nav = e(".datepicker--nav", this.$datepicker);
      },
      _triggerOnChange: function _triggerOnChange() {
        if (!this.selectedDates.length) {
          if ("" === this._prevOnSelectValue) return;
          return this._prevOnSelectValue = "", this.opts.onSelect("", "", this);
        }

        var t,
            e = this.selectedDates,
            i = n.getParsedDate(e[0]),
            s = this,
            a = new Date(i.year, i.month, i.date, i.hours, i.minutes);
        t = e.map(function (t) {
          return s.formatDate(s.loc.dateFormat, t);
        }).join(this.opts.multipleDatesSeparator), (this.opts.multipleDates || this.opts.range) && (a = e.map(function (t) {
          var e = n.getParsedDate(t);
          return new Date(e.year, e.month, e.date, e.hours, e.minutes);
        })), this._prevOnSelectValue = t, this.opts.onSelect(t, a, this);
      },
      next: function next() {
        var t = this.parsedDate,
            e = this.opts;

        switch (this.view) {
          case "days":
            this.date = new Date(t.year, t.month + 1, 1), e.onChangeMonth && e.onChangeMonth(this.parsedDate.month, this.parsedDate.year);
            break;

          case "months":
            this.date = new Date(t.year + 1, t.month, 1), e.onChangeYear && e.onChangeYear(this.parsedDate.year);
            break;

          case "years":
            this.date = new Date(t.year + 10, 0, 1), e.onChangeDecade && e.onChangeDecade(this.curDecade);
        }
      },
      prev: function prev() {
        var t = this.parsedDate,
            e = this.opts;

        switch (this.view) {
          case "days":
            this.date = new Date(t.year, t.month - 1, 1), e.onChangeMonth && e.onChangeMonth(this.parsedDate.month, this.parsedDate.year);
            break;

          case "months":
            this.date = new Date(t.year - 1, t.month, 1), e.onChangeYear && e.onChangeYear(this.parsedDate.year);
            break;

          case "years":
            this.date = new Date(t.year - 10, 0, 1), e.onChangeDecade && e.onChangeDecade(this.curDecade);
        }
      },
      formatDate: function formatDate(t, e) {
        e = e || this.date;
        var i,
            s = t,
            a = this._getWordBoundaryRegExp,
            h = this.loc,
            o = n.getLeadingZeroNum,
            r = n.getDecade(e),
            c = n.getParsedDate(e),
            d = c.fullHours,
            l = c.hours,
            u = t.match(a("aa")) || t.match(a("AA")),
            m = "am",
            p = this._replacer;

        switch (this.opts.timepicker && this.timepicker && u && (i = this.timepicker._getValidHoursFromDate(e, u), d = o(i.hours), l = i.hours, m = i.dayPeriod), !0) {
          case /@/.test(s):
            s = s.replace(/@/, e.getTime());

          case /aa/.test(s):
            s = p(s, a("aa"), m);

          case /AA/.test(s):
            s = p(s, a("AA"), m.toUpperCase());

          case /dd/.test(s):
            s = p(s, a("dd"), c.fullDate);

          case /d/.test(s):
            s = p(s, a("d"), c.date);

          case /DD/.test(s):
            s = p(s, a("DD"), h.days[c.day]);

          case /D/.test(s):
            s = p(s, a("D"), h.daysShort[c.day]);

          case /mm/.test(s):
            s = p(s, a("mm"), c.fullMonth);

          case /m/.test(s):
            s = p(s, a("m"), c.month + 1);

          case /MM/.test(s):
            s = p(s, a("MM"), this.loc.months[c.month]);

          case /M/.test(s):
            s = p(s, a("M"), h.monthsShort[c.month]);

          case /ii/.test(s):
            s = p(s, a("ii"), c.fullMinutes);

          case /i/.test(s):
            s = p(s, a("i"), c.minutes);

          case /hh/.test(s):
            s = p(s, a("hh"), d);

          case /h/.test(s):
            s = p(s, a("h"), l);

          case /yyyy/.test(s):
            s = p(s, a("yyyy"), c.year);

          case /yyyy1/.test(s):
            s = p(s, a("yyyy1"), r[0]);

          case /yyyy2/.test(s):
            s = p(s, a("yyyy2"), r[1]);

          case /yy/.test(s):
            s = p(s, a("yy"), c.year.toString().slice(-2));
        }

        return s;
      },
      _replacer: function _replacer(t, e, i) {
        return t.replace(e, function (t, e, s, a) {
          return e + i + a;
        });
      },
      _getWordBoundaryRegExp: function _getWordBoundaryRegExp(t) {
        var e = "\\s|\\.|-|/|\\\\|,|\\$|\\!|\\?|:|;";
        return new RegExp("(^|>|" + e + ")(" + t + ")($|<|" + e + ")", "g");
      },
      selectDate: function selectDate(t) {
        var e = this,
            i = e.opts,
            s = e.parsedDate,
            a = e.selectedDates,
            h = a.length,
            o = "";
        if (Array.isArray(t)) return void t.forEach(function (t) {
          e.selectDate(t);
        });

        if (t instanceof Date) {
          if (this.lastSelectedDate = t, this.timepicker && this.timepicker._setTime(t), e._trigger("selectDate", t), this.timepicker && (t.setHours(this.timepicker.hours), t.setMinutes(this.timepicker.minutes)), "days" == e.view && t.getMonth() != s.month && i.moveToOtherMonthsOnSelect && (o = new Date(t.getFullYear(), t.getMonth(), 1)), "years" == e.view && t.getFullYear() != s.year && i.moveToOtherYearsOnSelect && (o = new Date(t.getFullYear(), 0, 1)), o && (e.silent = !0, e.date = o, e.silent = !1, e.nav._render()), i.multipleDates && !i.range) {
            if (h === i.multipleDates) return;
            e._isSelected(t) || e.selectedDates.push(t);
          } else i.range ? 2 == h ? (e.selectedDates = [t], e.minRange = t, e.maxRange = "") : 1 == h ? (e.selectedDates.push(t), e.maxRange ? e.minRange = t : e.maxRange = t, n.bigger(e.maxRange, e.minRange) && (e.maxRange = e.minRange, e.minRange = t), e.selectedDates = [e.minRange, e.maxRange]) : (e.selectedDates = [t], e.minRange = t) : e.selectedDates = [t];

          e._setInputValue(), i.onSelect && e._triggerOnChange(), i.autoClose && !this.timepickerIsActive && (i.multipleDates || i.range ? i.range && 2 == e.selectedDates.length && e.hide() : e.hide()), e.views[this.currentView]._render();
        }
      },
      removeDate: function removeDate(t) {
        var e = this.selectedDates,
            i = this;
        if (t instanceof Date) return e.some(function (s, a) {
          return n.isSame(s, t) ? (e.splice(a, 1), i.selectedDates.length ? i.lastSelectedDate = i.selectedDates[i.selectedDates.length - 1] : (i.minRange = "", i.maxRange = "", i.lastSelectedDate = ""), i.views[i.currentView]._render(), i._setInputValue(), i.opts.onSelect && i._triggerOnChange(), !0) : void 0;
        });
      },
      today: function today() {
        this.silent = !0, this.view = this.opts.minView, this.silent = !1, this.date = new Date(), this.opts.todayButton instanceof Date && this.selectDate(this.opts.todayButton);
      },
      clear: function clear() {
        this.selectedDates = [], this.minRange = "", this.maxRange = "", this.views[this.currentView]._render(), this._setInputValue(), this.opts.onSelect && this._triggerOnChange();
      },
      update: function update(t, i) {
        var s = arguments.length,
            a = this.lastSelectedDate;
        return 2 == s ? this.opts[t] = i : 1 == s && "object" == _typeof(t) && (this.opts = e.extend(!0, this.opts, t)), this._createShortCuts(), this._syncWithMinMaxDates(), this._defineLocale(this.opts.language), this.nav._addButtonsIfNeed(), this.opts.onlyTimepicker || this.nav._render(), this.views[this.currentView]._render(), this.elIsInput && !this.opts.inline && (this._setPositionClasses(this.opts.position), this.visible && this.setPosition(this.opts.position)), this.opts.classes && this.$datepicker.addClass(this.opts.classes), this.opts.onlyTimepicker && this.$datepicker.addClass("-only-timepicker-"), this.opts.timepicker && (a && this.timepicker._handleDate(a), this.timepicker._updateRanges(), this.timepicker._updateCurrentTime(), a && (a.setHours(this.timepicker.hours), a.setMinutes(this.timepicker.minutes))), this._setInputValue(), this;
      },
      _syncWithMinMaxDates: function _syncWithMinMaxDates() {
        var t = this.date.getTime();
        this.silent = !0, this.minTime > t && (this.date = this.minDate), this.maxTime < t && (this.date = this.maxDate), this.silent = !1;
      },
      _isSelected: function _isSelected(t, e) {
        var i = !1;
        return this.selectedDates.some(function (s) {
          return n.isSame(s, t, e) ? (i = s, !0) : void 0;
        }), i;
      },
      _setInputValue: function _setInputValue() {
        var t,
            e = this,
            i = e.opts,
            s = e.loc.dateFormat,
            a = i.altFieldDateFormat,
            n = e.selectedDates.map(function (t) {
          return e.formatDate(s, t);
        });
        i.altField && e.$altField.length && (t = this.selectedDates.map(function (t) {
          return e.formatDate(a, t);
        }), t = t.join(this.opts.multipleDatesSeparator), this.$altField.val(t)), n = n.join(this.opts.multipleDatesSeparator), this.$el.val(n);
      },
      _isInRange: function _isInRange(t, e) {
        var i = t.getTime(),
            s = n.getParsedDate(t),
            a = n.getParsedDate(this.minDate),
            h = n.getParsedDate(this.maxDate),
            o = new Date(s.year, s.month, a.date).getTime(),
            r = new Date(s.year, s.month, h.date).getTime(),
            c = {
          day: i >= this.minTime && i <= this.maxTime,
          month: o >= this.minTime && r <= this.maxTime,
          year: s.year >= a.year && s.year <= h.year
        };
        return e ? c[e] : c.day;
      },
      _getDimensions: function _getDimensions(t) {
        var e = t.offset();
        return {
          width: t.outerWidth(),
          height: t.outerHeight(),
          left: e.left,
          top: e.top
        };
      },
      _getDateFromCell: function _getDateFromCell(t) {
        var e = this.parsedDate,
            s = t.data("year") || e.year,
            a = t.data("month") == i ? e.month : t.data("month"),
            n = t.data("date") || 1;
        return new Date(s, a, n);
      },
      _setPositionClasses: function _setPositionClasses(t) {
        t = t.split(" ");
        var e = t[0],
            i = t[1],
            s = "datepicker -" + e + "-" + i + "- -from-" + e + "-";
        this.visible && (s += " active"), this.$datepicker.removeAttr("class").addClass(s);
      },
      setPosition: function setPosition(t) {
        t = t || this.opts.position;

        var e,
            i,
            s = this._getDimensions(this.$el),
            a = this._getDimensions(this.$datepicker),
            n = t.split(" "),
            h = this.opts.offset,
            o = n[0],
            r = n[1];

        switch (o) {
          case "top":
            e = s.top - a.height - h;
            break;

          case "right":
            i = s.left + s.width + h;
            break;

          case "bottom":
            e = s.top + s.height + h;
            break;

          case "left":
            i = s.left - a.width - h;
        }

        switch (r) {
          case "top":
            e = s.top;
            break;

          case "right":
            i = s.left + s.width - a.width;
            break;

          case "bottom":
            e = s.top + s.height - a.height;
            break;

          case "left":
            i = s.left;
            break;

          case "center":
            /left|right/.test(o) ? e = s.top + s.height / 2 - a.height / 2 : i = s.left + s.width / 2 - a.width / 2;
        }

        this.$datepicker.css({
          left: i,
          top: e
        });
      },
      show: function show() {
        var t = this.opts.onShow;
        this.setPosition(this.opts.position), this.$datepicker.addClass("active"), this.visible = !0, t && this._bindVisionEvents(t);
      },
      hide: function hide() {
        var t = this.opts.onHide;
        this.$datepicker.removeClass("active").css({
          left: "-100000px"
        }), this.focused = "", this.keys = [], this.inFocus = !1, this.visible = !1, this.$el.blur(), t && this._bindVisionEvents(t);
      },
      down: function down(t) {
        this._changeView(t, "down");
      },
      up: function up(t) {
        this._changeView(t, "up");
      },
      _bindVisionEvents: function _bindVisionEvents(t) {
        this.$datepicker.off("transitionend.dp"), t(this, !1), this.$datepicker.one("transitionend.dp", t.bind(this, this, !0));
      },
      _changeView: function _changeView(t, e) {
        t = t || this.focused || this.date;
        var i = "up" == e ? this.viewIndex + 1 : this.viewIndex - 1;
        i > 2 && (i = 2), 0 > i && (i = 0), this.silent = !0, this.date = new Date(t.getFullYear(), t.getMonth(), 1), this.silent = !1, this.view = this.viewIndexes[i];
      },
      _handleHotKey: function _handleHotKey(t) {
        var e,
            i,
            s,
            a = n.getParsedDate(this._getFocusedDate()),
            h = this.opts,
            o = !1,
            r = !1,
            c = !1,
            d = a.year,
            l = a.month,
            u = a.date;

        switch (t) {
          case "ctrlRight":
          case "ctrlUp":
            l += 1, o = !0;
            break;

          case "ctrlLeft":
          case "ctrlDown":
            l -= 1, o = !0;
            break;

          case "shiftRight":
          case "shiftUp":
            r = !0, d += 1;
            break;

          case "shiftLeft":
          case "shiftDown":
            r = !0, d -= 1;
            break;

          case "altRight":
          case "altUp":
            c = !0, d += 10;
            break;

          case "altLeft":
          case "altDown":
            c = !0, d -= 10;
            break;

          case "ctrlShiftUp":
            this.up();
        }

        s = n.getDaysCount(new Date(d, l)), i = new Date(d, l, u), u > s && (u = s), i.getTime() < this.minTime ? i = this.minDate : i.getTime() > this.maxTime && (i = this.maxDate), this.focused = i, e = n.getParsedDate(i), o && h.onChangeMonth && h.onChangeMonth(e.month, e.year), r && h.onChangeYear && h.onChangeYear(e.year), c && h.onChangeDecade && h.onChangeDecade(this.curDecade);
      },
      _registerKey: function _registerKey(t) {
        var e = this.keys.some(function (e) {
          return e == t;
        });
        e || this.keys.push(t);
      },
      _unRegisterKey: function _unRegisterKey(t) {
        var e = this.keys.indexOf(t);
        this.keys.splice(e, 1);
      },
      _isHotKeyPressed: function _isHotKeyPressed() {
        var t,
            e = !1,
            i = this,
            s = this.keys.sort();

        for (var a in u) {
          t = u[a], s.length == t.length && t.every(function (t, e) {
            return t == s[e];
          }) && (i._trigger("hotKey", a), e = !0);
        }

        return e;
      },
      _trigger: function _trigger(t, e) {
        this.$el.trigger(t, e);
      },
      _focusNextCell: function _focusNextCell(t, e) {
        e = e || this.cellType;
        var i = n.getParsedDate(this._getFocusedDate()),
            s = i.year,
            a = i.month,
            h = i.date;

        if (!this._isHotKeyPressed()) {
          switch (t) {
            case 37:
              "day" == e ? h -= 1 : "", "month" == e ? a -= 1 : "", "year" == e ? s -= 1 : "";
              break;

            case 38:
              "day" == e ? h -= 7 : "", "month" == e ? a -= 3 : "", "year" == e ? s -= 4 : "";
              break;

            case 39:
              "day" == e ? h += 1 : "", "month" == e ? a += 1 : "", "year" == e ? s += 1 : "";
              break;

            case 40:
              "day" == e ? h += 7 : "", "month" == e ? a += 3 : "", "year" == e ? s += 4 : "";
          }

          var o = new Date(s, a, h);
          o.getTime() < this.minTime ? o = this.minDate : o.getTime() > this.maxTime && (o = this.maxDate), this.focused = o;
        }
      },
      _getFocusedDate: function _getFocusedDate() {
        var t = this.focused || this.selectedDates[this.selectedDates.length - 1],
            e = this.parsedDate;
        if (!t) switch (this.view) {
          case "days":
            t = new Date(e.year, e.month, new Date().getDate());
            break;

          case "months":
            t = new Date(e.year, e.month, 1);
            break;

          case "years":
            t = new Date(e.year, 0, 1);
        }
        return t;
      },
      _getCell: function _getCell(t, i) {
        i = i || this.cellType;
        var s,
            a = n.getParsedDate(t),
            h = '.datepicker--cell[data-year="' + a.year + '"]';

        switch (i) {
          case "month":
            h = '[data-month="' + a.month + '"]';
            break;

          case "day":
            h += '[data-month="' + a.month + '"][data-date="' + a.date + '"]';
        }

        return s = this.views[this.currentView].$el.find(h), s.length ? s : e("");
      },
      destroy: function destroy() {
        var t = this;
        t.$el.off(".adp").data("datepicker", ""), t.selectedDates = [], t.focused = "", t.views = {}, t.keys = [], t.minRange = "", t.maxRange = "", t.opts.inline || !t.elIsInput ? t.$datepicker.closest(".datepicker-inline").remove() : t.$datepicker.remove();
      },
      _handleAlreadySelectedDates: function _handleAlreadySelectedDates(t, e) {
        this.opts.range ? this.opts.toggleSelected ? this.removeDate(e) : 2 != this.selectedDates.length && this._trigger("clickCell", e) : this.opts.toggleSelected && this.removeDate(e), this.opts.toggleSelected || (this.lastSelectedDate = t, this.opts.timepicker && (this.timepicker._setTime(t), this.timepicker.update()));
      },
      _onShowEvent: function _onShowEvent(t) {
        this.visible || this.show();
      },
      _onBlur: function _onBlur() {
        !this.inFocus && this.visible && this.hide();
      },
      _onMouseDownDatepicker: function _onMouseDownDatepicker(t) {
        this.inFocus = !0;
      },
      _onMouseUpDatepicker: function _onMouseUpDatepicker(t) {
        this.inFocus = !1, t.originalEvent.inFocus = !0, t.originalEvent.timepickerFocus || this.$el.focus();
      },
      _onKeyUpGeneral: function _onKeyUpGeneral(t) {
        var e = this.$el.val();
        e || this.clear();
      },
      _onResize: function _onResize() {
        this.visible && this.setPosition();
      },
      _onMouseUpBody: function _onMouseUpBody(t) {
        t.originalEvent.inFocus || this.visible && !this.inFocus && this.hide();
      },
      _onMouseUpEl: function _onMouseUpEl(t) {
        t.originalEvent.inFocus = !0, setTimeout(this._onKeyUpGeneral.bind(this), 4);
      },
      _onKeyDown: function _onKeyDown(t) {
        var e = t.which;

        if (this._registerKey(e), e >= 37 && 40 >= e && (t.preventDefault(), this._focusNextCell(e)), 13 == e && this.focused) {
          if (this._getCell(this.focused).hasClass("-disabled-")) return;
          if (this.view != this.opts.minView) this.down();else {
            var i = this._isSelected(this.focused, this.cellType);

            if (!i) return this.timepicker && (this.focused.setHours(this.timepicker.hours), this.focused.setMinutes(this.timepicker.minutes)), void this.selectDate(this.focused);

            this._handleAlreadySelectedDates(i, this.focused);
          }
        }

        27 == e && this.hide();
      },
      _onKeyUp: function _onKeyUp(t) {
        var e = t.which;

        this._unRegisterKey(e);
      },
      _onHotKey: function _onHotKey(t, e) {
        this._handleHotKey(e);
      },
      _onMouseEnterCell: function _onMouseEnterCell(t) {
        var i = e(t.target).closest(".datepicker--cell"),
            s = this._getDateFromCell(i);

        this.silent = !0, this.focused && (this.focused = ""), i.addClass("-focus-"), this.focused = s, this.silent = !1, this.opts.range && 1 == this.selectedDates.length && (this.minRange = this.selectedDates[0], this.maxRange = "", n.less(this.minRange, this.focused) && (this.maxRange = this.minRange, this.minRange = ""), this.views[this.currentView]._update());
      },
      _onMouseLeaveCell: function _onMouseLeaveCell(t) {
        var i = e(t.target).closest(".datepicker--cell");
        i.removeClass("-focus-"), this.silent = !0, this.focused = "", this.silent = !1;
      },
      _onTimeChange: function _onTimeChange(t, e, i) {
        var s = new Date(),
            a = this.selectedDates,
            n = !1;
        a.length && (n = !0, s = this.lastSelectedDate), s.setHours(e), s.setMinutes(i), n || this._getCell(s).hasClass("-disabled-") ? (this._setInputValue(), this.opts.onSelect && this._triggerOnChange()) : this.selectDate(s);
      },
      _onClickCell: function _onClickCell(t, e) {
        this.timepicker && (e.setHours(this.timepicker.hours), e.setMinutes(this.timepicker.minutes)), this.selectDate(e);
      },

      set focused(t) {
        if (!t && this.focused) {
          var e = this._getCell(this.focused);

          e.length && e.removeClass("-focus-");
        }

        this._focused = t, this.opts.range && 1 == this.selectedDates.length && (this.minRange = this.selectedDates[0], this.maxRange = "", n.less(this.minRange, this._focused) && (this.maxRange = this.minRange, this.minRange = "")), this.silent || (this.date = t);
      },

      get focused() {
        return this._focused;
      },

      get parsedDate() {
        return n.getParsedDate(this.date);
      },

      set date(t) {
        return t instanceof Date ? (this.currentDate = t, this.inited && !this.silent && (this.views[this.view]._render(), this.nav._render(), this.visible && this.elIsInput && this.setPosition()), t) : void 0;
      },

      get date() {
        return this.currentDate;
      },

      set view(t) {
        return this.viewIndex = this.viewIndexes.indexOf(t), this.viewIndex < 0 ? void 0 : (this.prevView = this.currentView, this.currentView = t, this.inited && (this.views[t] ? this.views[t]._render() : this.views[t] = new e.fn.datepicker.Body(this, t, this.opts), this.views[this.prevView].hide(), this.views[t].show(), this.nav._render(), this.opts.onChangeView && this.opts.onChangeView(t), this.elIsInput && this.visible && this.setPosition()), t);
      },

      get view() {
        return this.currentView;
      },

      get cellType() {
        return this.view.substring(0, this.view.length - 1);
      },

      get minTime() {
        var t = n.getParsedDate(this.minDate);
        return new Date(t.year, t.month, t.date).getTime();
      },

      get maxTime() {
        var t = n.getParsedDate(this.maxDate);
        return new Date(t.year, t.month, t.date).getTime();
      },

      get curDecade() {
        return n.getDecade(this.date);
      }

    }, n.getDaysCount = function (t) {
      return new Date(t.getFullYear(), t.getMonth() + 1, 0).getDate();
    }, n.getParsedDate = function (t) {
      return {
        year: t.getFullYear(),
        month: t.getMonth(),
        fullMonth: t.getMonth() + 1 < 10 ? "0" + (t.getMonth() + 1) : t.getMonth() + 1,
        date: t.getDate(),
        fullDate: t.getDate() < 10 ? "0" + t.getDate() : t.getDate(),
        day: t.getDay(),
        hours: t.getHours(),
        fullHours: t.getHours() < 10 ? "0" + t.getHours() : t.getHours(),
        minutes: t.getMinutes(),
        fullMinutes: t.getMinutes() < 10 ? "0" + t.getMinutes() : t.getMinutes()
      };
    }, n.getDecade = function (t) {
      var e = 10 * Math.floor(t.getFullYear() / 10);
      return [e, e + 9];
    }, n.template = function (t, e) {
      return t.replace(/#\{([\w]+)\}/g, function (t, i) {
        return e[i] || 0 === e[i] ? e[i] : void 0;
      });
    }, n.isSame = function (t, e, i) {
      if (!t || !e) return !1;
      var s = n.getParsedDate(t),
          a = n.getParsedDate(e),
          h = i ? i : "day",
          o = {
        day: s.date == a.date && s.month == a.month && s.year == a.year,
        month: s.month == a.month && s.year == a.year,
        year: s.year == a.year
      };
      return o[h];
    }, n.less = function (t, e, i) {
      return t && e ? e.getTime() < t.getTime() : !1;
    }, n.bigger = function (t, e, i) {
      return t && e ? e.getTime() > t.getTime() : !1;
    }, n.getLeadingZeroNum = function (t) {
      return parseInt(t) < 10 ? "0" + t : t;
    }, n.resetTime = function (t) {
      return "object" == _typeof(t) ? (t = n.getParsedDate(t), new Date(t.year, t.month, t.date)) : void 0;
    }, e.fn.datepicker = function (t) {
      return this.each(function () {
        if (e.data(this, o)) {
          var i = e.data(this, o);
          i.opts = e.extend(!0, i.opts, t), i.update();
        } else e.data(this, o, new m(this, t));
      });
    }, e.fn.datepicker.Constructor = m, e.fn.datepicker.language = {
      ru: {
        days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
        daysShort: ["Вос", "Пон", "Вто", "Сре", "Чет", "Пят", "Суб"],
        daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
        months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
        monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
        today: "Сегодня",
        clear: "Очистить",
        dateFormat: "dd.mm.yyyy",
        timeFormat: "hh:ii",
        firstDay: 1
      }
    }, e(function () {
      e(r).datepicker();
    });
  }(), function () {
    var t = {
      days: '<div class="datepicker--days datepicker--body"><div class="datepicker--days-names"></div><div class="datepicker--cells datepicker--cells-days"></div></div>',
      months: '<div class="datepicker--months datepicker--body"><div class="datepicker--cells datepicker--cells-months"></div></div>',
      years: '<div class="datepicker--years datepicker--body"><div class="datepicker--cells datepicker--cells-years"></div></div>'
    },
        s = e.fn.datepicker,
        a = s.Constructor;
    s.Body = function (t, i, s) {
      this.d = t, this.type = i, this.opts = s, this.$el = e(""), this.opts.onlyTimepicker || this.init();
    }, s.Body.prototype = {
      init: function init() {
        this._buildBaseHtml(), this._render(), this._bindEvents();
      },
      _bindEvents: function _bindEvents() {
        this.$el.on("click", ".datepicker--cell", e.proxy(this._onClickCell, this));
      },
      _buildBaseHtml: function _buildBaseHtml() {
        this.$el = e(t[this.type]).appendTo(this.d.$content), this.$names = e(".datepicker--days-names", this.$el), this.$cells = e(".datepicker--cells", this.$el);
      },
      _getDayNamesHtml: function _getDayNamesHtml(t, e, s, a) {
        return e = e != i ? e : t, s = s ? s : "", a = a != i ? a : 0, a > 7 ? s : 7 == e ? this._getDayNamesHtml(t, 0, s, ++a) : (s += '<div class="datepicker--day-name' + (this.d.isWeekend(e) ? " -weekend-" : "") + '">' + this.d.loc.daysMin[e] + "</div>", this._getDayNamesHtml(t, ++e, s, ++a));
      },
      _getCellContents: function _getCellContents(t, e) {
        var i = "datepicker--cell datepicker--cell-" + e,
            s = new Date(),
            n = this.d,
            h = a.resetTime(n.minRange),
            o = a.resetTime(n.maxRange),
            r = n.opts,
            c = a.getParsedDate(t),
            d = {},
            l = c.date;

        switch (e) {
          case "day":
            n.isWeekend(c.day) && (i += " -weekend-"), c.month != this.d.parsedDate.month && (i += " -other-month-", r.selectOtherMonths || (i += " -disabled-"), r.showOtherMonths || (l = ""));
            break;

          case "month":
            l = n.loc[n.opts.monthsField][c.month];
            break;

          case "year":
            var u = n.curDecade;
            l = c.year, (c.year < u[0] || c.year > u[1]) && (i += " -other-decade-", r.selectOtherYears || (i += " -disabled-"), r.showOtherYears || (l = ""));
        }

        return r.onRenderCell && (d = r.onRenderCell(t, e) || {}, l = d.html ? d.html : l, i += d.classes ? " " + d.classes : ""), r.range && (a.isSame(h, t, e) && (i += " -range-from-"), a.isSame(o, t, e) && (i += " -range-to-"), 1 == n.selectedDates.length && n.focused ? ((a.bigger(h, t) && a.less(n.focused, t) || a.less(o, t) && a.bigger(n.focused, t)) && (i += " -in-range-"), a.less(o, t) && a.isSame(n.focused, t) && (i += " -range-from-"), a.bigger(h, t) && a.isSame(n.focused, t) && (i += " -range-to-")) : 2 == n.selectedDates.length && a.bigger(h, t) && a.less(o, t) && (i += " -in-range-")), a.isSame(s, t, e) && (i += " -current-"), n.focused && a.isSame(t, n.focused, e) && (i += " -focus-"), n._isSelected(t, e) && (i += " -selected-"), (!n._isInRange(t, e) || d.disabled) && (i += " -disabled-"), {
          html: l,
          classes: i
        };
      },
      _getDaysHtml: function _getDaysHtml(t) {
        var e = a.getDaysCount(t),
            i = new Date(t.getFullYear(), t.getMonth(), 1).getDay(),
            s = new Date(t.getFullYear(), t.getMonth(), e).getDay(),
            n = i - this.d.loc.firstDay,
            h = 6 - s + this.d.loc.firstDay;
        n = 0 > n ? n + 7 : n, h = h > 6 ? h - 7 : h;

        for (var o, r, c = -n + 1, d = "", l = c, u = e + h; u >= l; l++) {
          r = t.getFullYear(), o = t.getMonth(), d += this._getDayHtml(new Date(r, o, l));
        }

        return d;
      },
      _getDayHtml: function _getDayHtml(t) {
        var e = this._getCellContents(t, "day");

        return '<div class="' + e.classes + '" data-date="' + t.getDate() + '" data-month="' + t.getMonth() + '" data-year="' + t.getFullYear() + '">' + e.html + "</div>";
      },
      _getMonthsHtml: function _getMonthsHtml(t) {
        for (var e = "", i = a.getParsedDate(t), s = 0; 12 > s;) {
          e += this._getMonthHtml(new Date(i.year, s)), s++;
        }

        return e;
      },
      _getMonthHtml: function _getMonthHtml(t) {
        var e = this._getCellContents(t, "month");

        return '<div class="' + e.classes + '" data-month="' + t.getMonth() + '">' + e.html + "</div>";
      },
      _getYearsHtml: function _getYearsHtml(t) {
        var e = (a.getParsedDate(t), a.getDecade(t)),
            i = e[0] - 1,
            s = "",
            n = i;

        for (n; n <= e[1] + 1; n++) {
          s += this._getYearHtml(new Date(n, 0));
        }

        return s;
      },
      _getYearHtml: function _getYearHtml(t) {
        var e = this._getCellContents(t, "year");

        return '<div class="' + e.classes + '" data-year="' + t.getFullYear() + '">' + e.html + "</div>";
      },
      _renderTypes: {
        days: function days() {
          var t = this._getDayNamesHtml(this.d.loc.firstDay),
              e = this._getDaysHtml(this.d.currentDate);

          this.$cells.html(e), this.$names.html(t);
        },
        months: function months() {
          var t = this._getMonthsHtml(this.d.currentDate);

          this.$cells.html(t);
        },
        years: function years() {
          var t = this._getYearsHtml(this.d.currentDate);

          this.$cells.html(t);
        }
      },
      _render: function _render() {
        this.opts.onlyTimepicker || this._renderTypes[this.type].bind(this)();
      },
      _update: function _update() {
        var t,
            i,
            s,
            a = e(".datepicker--cell", this.$cells),
            n = this;
        a.each(function (a, h) {
          i = e(this), s = n.d._getDateFromCell(e(this)), t = n._getCellContents(s, n.d.cellType), i.attr("class", t.classes);
        });
      },
      show: function show() {
        this.opts.onlyTimepicker || (this.$el.addClass("active"), this.acitve = !0);
      },
      hide: function hide() {
        this.$el.removeClass("active"), this.active = !1;
      },
      _handleClick: function _handleClick(t) {
        var e = t.data("date") || 1,
            i = t.data("month") || 0,
            s = t.data("year") || this.d.parsedDate.year,
            a = this.d;
        if (a.view != this.opts.minView) return void a.down(new Date(s, i, e));

        var n = new Date(s, i, e),
            h = this.d._isSelected(n, this.d.cellType);

        return h ? void a._handleAlreadySelectedDates.bind(a, h, n)() : void a._trigger("clickCell", n);
      },
      _onClickCell: function _onClickCell(t) {
        var i = e(t.target).closest(".datepicker--cell");
        i.hasClass("-disabled-") || this._handleClick.bind(this)(i);
      }
    };
  }(), function () {
    var t = '<div class="datepicker--nav-action" data-action="prev">#{prevHtml}</div><div class="datepicker--nav-title">#{title}</div><div class="datepicker--nav-action" data-action="next">#{nextHtml}</div>',
        i = '<div class="datepicker--buttons"></div>',
        s = '<span class="datepicker--button" data-action="#{action}">#{label}</span>',
        a = e.fn.datepicker,
        n = a.Constructor;
    a.Navigation = function (t, e) {
      this.d = t, this.opts = e, this.$buttonsContainer = "", this.init();
    }, a.Navigation.prototype = {
      init: function init() {
        this._buildBaseHtml(), this._bindEvents();
      },
      _bindEvents: function _bindEvents() {
        this.d.$nav.on("click", ".datepicker--nav-action", e.proxy(this._onClickNavButton, this)), this.d.$nav.on("click", ".datepicker--nav-title", e.proxy(this._onClickNavTitle, this)), this.d.$datepicker.on("click", ".datepicker--button", e.proxy(this._onClickNavButton, this));
      },
      _buildBaseHtml: function _buildBaseHtml() {
        this.opts.onlyTimepicker || this._render(), this._addButtonsIfNeed();
      },
      _addButtonsIfNeed: function _addButtonsIfNeed() {
        this.opts.todayButton && this._addButton("today"), this.opts.clearButton && this._addButton("clear");
      },
      _render: function _render() {
        var i = this._getTitle(this.d.currentDate),
            s = n.template(t, e.extend({
          title: i
        }, this.opts));

        this.d.$nav.html(s), "years" == this.d.view && e(".datepicker--nav-title", this.d.$nav).addClass("-disabled-"), this.setNavStatus();
      },
      _getTitle: function _getTitle(t) {
        return this.d.formatDate(this.opts.navTitles[this.d.view], t);
      },
      _addButton: function _addButton(t) {
        this.$buttonsContainer.length || this._addButtonsContainer();
        var i = {
          action: t,
          label: this.d.loc[t]
        },
            a = n.template(s, i);
        e("[data-action=" + t + "]", this.$buttonsContainer).length || this.$buttonsContainer.append(a);
      },
      _addButtonsContainer: function _addButtonsContainer() {
        this.d.$datepicker.append(i), this.$buttonsContainer = e(".datepicker--buttons", this.d.$datepicker);
      },
      setNavStatus: function setNavStatus() {
        if ((this.opts.minDate || this.opts.maxDate) && this.opts.disableNavWhenOutOfRange) {
          var t = this.d.parsedDate,
              e = t.month,
              i = t.year,
              s = t.date;

          switch (this.d.view) {
            case "days":
              this.d._isInRange(new Date(i, e - 1, 1), "month") || this._disableNav("prev"), this.d._isInRange(new Date(i, e + 1, 1), "month") || this._disableNav("next");
              break;

            case "months":
              this.d._isInRange(new Date(i - 1, e, s), "year") || this._disableNav("prev"), this.d._isInRange(new Date(i + 1, e, s), "year") || this._disableNav("next");
              break;

            case "years":
              var a = n.getDecade(this.d.date);
              this.d._isInRange(new Date(a[0] - 1, 0, 1), "year") || this._disableNav("prev"), this.d._isInRange(new Date(a[1] + 1, 0, 1), "year") || this._disableNav("next");
          }
        }
      },
      _disableNav: function _disableNav(t) {
        e('[data-action="' + t + '"]', this.d.$nav).addClass("-disabled-");
      },
      _activateNav: function _activateNav(t) {
        e('[data-action="' + t + '"]', this.d.$nav).removeClass("-disabled-");
      },
      _onClickNavButton: function _onClickNavButton(t) {
        var i = e(t.target).closest("[data-action]"),
            s = i.data("action");
        this.d[s]();
      },
      _onClickNavTitle: function _onClickNavTitle(t) {
        return e(t.target).hasClass("-disabled-") ? void 0 : "days" == this.d.view ? this.d.view = "months" : void (this.d.view = "years");
      }
    };
  }(), function () {
    var t = '<div class="datepicker--time"><div class="datepicker--time-current">   <span class="datepicker--time-current-hours">#{hourVisible}</span>   <span class="datepicker--time-current-colon">:</span>   <span class="datepicker--time-current-minutes">#{minValue}</span></div><div class="datepicker--time-sliders">   <div class="datepicker--time-row">      <input type="range" name="hours" value="#{hourValue}" min="#{hourMin}" max="#{hourMax}" step="#{hourStep}"/>   </div>   <div class="datepicker--time-row">      <input type="range" name="minutes" value="#{minValue}" min="#{minMin}" max="#{minMax}" step="#{minStep}"/>   </div></div></div>',
        i = e.fn.datepicker,
        s = i.Constructor;
    i.Timepicker = function (t, e) {
      this.d = t, this.opts = e, this.init();
    }, i.Timepicker.prototype = {
      init: function init() {
        var t = "input";
        this._setTime(this.d.date), this._buildHTML(), navigator.userAgent.match(/trident/gi) && (t = "change"), this.d.$el.on("selectDate", this._onSelectDate.bind(this)), this.$ranges.on(t, this._onChangeRange.bind(this)), this.$ranges.on("mouseup", this._onMouseUpRange.bind(this)), this.$ranges.on("mousemove focus ", this._onMouseEnterRange.bind(this)), this.$ranges.on("mouseout blur", this._onMouseOutRange.bind(this));
      },
      _setTime: function _setTime(t) {
        var e = s.getParsedDate(t);
        this._handleDate(t), this.hours = e.hours < this.minHours ? this.minHours : e.hours, this.minutes = e.minutes < this.minMinutes ? this.minMinutes : e.minutes;
      },
      _setMinTimeFromDate: function _setMinTimeFromDate(t) {
        this.minHours = t.getHours(), this.minMinutes = t.getMinutes(), this.d.lastSelectedDate && this.d.lastSelectedDate.getHours() > t.getHours() && (this.minMinutes = this.opts.minMinutes);
      },
      _setMaxTimeFromDate: function _setMaxTimeFromDate(t) {
        this.maxHours = t.getHours(), this.maxMinutes = t.getMinutes(), this.d.lastSelectedDate && this.d.lastSelectedDate.getHours() < t.getHours() && (this.maxMinutes = this.opts.maxMinutes);
      },
      _setDefaultMinMaxTime: function _setDefaultMinMaxTime() {
        var t = 23,
            e = 59,
            i = this.opts;
        this.minHours = i.minHours < 0 || i.minHours > t ? 0 : i.minHours, this.minMinutes = i.minMinutes < 0 || i.minMinutes > e ? 0 : i.minMinutes, this.maxHours = i.maxHours < 0 || i.maxHours > t ? t : i.maxHours, this.maxMinutes = i.maxMinutes < 0 || i.maxMinutes > e ? e : i.maxMinutes;
      },
      _validateHoursMinutes: function _validateHoursMinutes(t) {
        this.hours < this.minHours ? this.hours = this.minHours : this.hours > this.maxHours && (this.hours = this.maxHours), this.minutes < this.minMinutes ? this.minutes = this.minMinutes : this.minutes > this.maxMinutes && (this.minutes = this.maxMinutes);
      },
      _buildHTML: function _buildHTML() {
        var i = s.getLeadingZeroNum,
            a = {
          hourMin: this.minHours,
          hourMax: i(this.maxHours),
          hourStep: this.opts.hoursStep,
          hourValue: this.hours,
          hourVisible: i(this.displayHours),
          minMin: this.minMinutes,
          minMax: i(this.maxMinutes),
          minStep: this.opts.minutesStep,
          minValue: i(this.minutes)
        },
            n = s.template(t, a);
        this.$timepicker = e(n).appendTo(this.d.$datepicker), this.$ranges = e('[type="range"]', this.$timepicker), this.$hours = e('[name="hours"]', this.$timepicker), this.$minutes = e('[name="minutes"]', this.$timepicker), this.$hoursText = e(".datepicker--time-current-hours", this.$timepicker), this.$minutesText = e(".datepicker--time-current-minutes", this.$timepicker), this.d.ampm && (this.$ampm = e('<span class="datepicker--time-current-ampm">').appendTo(e(".datepicker--time-current", this.$timepicker)).html(this.dayPeriod), this.$timepicker.addClass("-am-pm-"));
      },
      _updateCurrentTime: function _updateCurrentTime() {
        var t = s.getLeadingZeroNum(this.displayHours),
            e = s.getLeadingZeroNum(this.minutes);
        this.$hoursText.html(t), this.$minutesText.html(e), this.d.ampm && this.$ampm.html(this.dayPeriod);
      },
      _updateRanges: function _updateRanges() {
        this.$hours.attr({
          min: this.minHours,
          max: this.maxHours
        }).val(this.hours), this.$minutes.attr({
          min: this.minMinutes,
          max: this.maxMinutes
        }).val(this.minutes);
      },
      _handleDate: function _handleDate(t) {
        this._setDefaultMinMaxTime(), t && (s.isSame(t, this.d.opts.minDate) ? this._setMinTimeFromDate(this.d.opts.minDate) : s.isSame(t, this.d.opts.maxDate) && this._setMaxTimeFromDate(this.d.opts.maxDate)), this._validateHoursMinutes(t);
      },
      update: function update() {
        this._updateRanges(), this._updateCurrentTime();
      },
      _getValidHoursFromDate: function _getValidHoursFromDate(t, e) {
        var i = t,
            a = t;
        t instanceof Date && (i = s.getParsedDate(t), a = i.hours);
        var n = e || this.d.ampm,
            h = "am";
        if (n) switch (!0) {
          case 0 == a:
            a = 12;
            break;

          case 12 == a:
            h = "pm";
            break;

          case a > 11:
            a -= 12, h = "pm";
        }
        return {
          hours: a,
          dayPeriod: h
        };
      },

      set hours(t) {
        this._hours = t;

        var e = this._getValidHoursFromDate(t);

        this.displayHours = e.hours, this.dayPeriod = e.dayPeriod;
      },

      get hours() {
        return this._hours;
      },

      _onChangeRange: function _onChangeRange(t) {
        var i = e(t.target),
            s = i.attr("name");
        this.d.timepickerIsActive = !0, this[s] = i.val(), this._updateCurrentTime(), this.d._trigger("timeChange", [this.hours, this.minutes]), this._handleDate(this.d.lastSelectedDate), this.update();
      },
      _onSelectDate: function _onSelectDate(t, e) {
        this._handleDate(e), this.update();
      },
      _onMouseEnterRange: function _onMouseEnterRange(t) {
        var i = e(t.target).attr("name");
        e(".datepicker--time-current-" + i, this.$timepicker).addClass("-focus-");
      },
      _onMouseOutRange: function _onMouseOutRange(t) {
        var i = e(t.target).attr("name");
        this.d.inFocus || e(".datepicker--time-current-" + i, this.$timepicker).removeClass("-focus-");
      },
      _onMouseUpRange: function _onMouseUpRange(t) {
        this.d.timepickerIsActive = !1;
      }
    };
  }();
}(window, jQuery);

(function ($) {
  $.fn.datepicker.language['uk'] = {
    days: ['Неділя', 'Понеділок', 'Вівторок', 'Середа', 'Четверг', "П'ятниця", 'Субота'],
    daysShort: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
    daysMin: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
    months: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
    monthsShort: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру'],
    today: 'Сьогодні',
    clear: 'Очистити',
    dateFormat: 'dd/mm/yyyy',
    timeFormat: 'hh:ii',
    firstDay: 1
  };
})(jQuery);
/*////////////////*/

/* CUSTOM SCRIPTS */

/*////////////////*/


jQuery(function ($) {
  $('.datepicker-here').each(function () {
    var datepicker = $(this);
    $(this).datepicker({
      inline: true,
      dateFormat: 'D, dd.mm.yyyy',
      onSelect: function onSelect(formattedDate, date) {
        if ($(datepicker).data('range') == true) {
          if (date.length == 2) {
            $(datepicker).parent().parent().removeClass('active');
          }
        } else {
          $(datepicker).parent().parent().removeClass('active');
        }

        $(datepicker).parent().prev().html(formattedDate);

        if ($(datepicker).hasClass('participant-datepicker')) {
          $(datepicker).addClass('picked');
          $(datepicker).parent().parent().removeClass('active');
          $(datepicker).closest('.datepicker-input').find('input').val(formattedDate);
        }
      }
    });
  });
  $('.datepicker-here-2').each(function () {
    var datepicker = $(this);
    $(this).datepicker({
      inline: true,
      dateFormat: 'dd.mm.yyyy',
      onSelect: function onSelect(formattedDate, date) {
        if ($(datepicker).data('range') == true) {
          if (date.length == 2) {
            $(datepicker).parent().parent().removeClass('active');
          }
        } else {
          $(datepicker).parent().parent().removeClass('active');
        }

        $(datepicker).parent().prev().html(formattedDate);

        if ($(datepicker).hasClass('participant-datepicker')) {
          $(datepicker).addClass('picked');
          $(datepicker).parent().parent().removeClass('active');
          $(datepicker).closest('.datepicker-input').find('input').val(formattedDate);
        }
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/libs/full-calendar.js":
/*!********************************************!*\
  !*** ./resources/js/libs/full-calendar.js ***!
  \********************************************/
/***/ (function(module, exports, __webpack_require__) {

/* module decorator */ module = __webpack_require__.nmd(module);
var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*///////////*/

/* MOMENT JS */

/*///////////*/
// moment.js
// version : 2.18.1
// authors : Tim Wood, Iskren Chernev, Moment.js contributors
// license : MIT
// momentjs.com
!function (a, b) {
  "object" == ( false ? 0 : _typeof(exports)) && "undefined" != "object" ? module.exports = b() :  true ? !(__WEBPACK_AMD_DEFINE_FACTORY__ = (b),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : 0;
}(this, function () {
  "use strict";

  function a() {
    return sd.apply(null, arguments);
  }

  function b(a) {
    sd = a;
  }

  function c(a) {
    return a instanceof Array || "[object Array]" === Object.prototype.toString.call(a);
  }

  function d(a) {
    return null != a && "[object Object]" === Object.prototype.toString.call(a);
  }

  function e(a) {
    var b;

    for (b in a) {
      return !1;
    }

    return !0;
  }

  function f(a) {
    return void 0 === a;
  }

  function g(a) {
    return "number" == typeof a || "[object Number]" === Object.prototype.toString.call(a);
  }

  function h(a) {
    return a instanceof Date || "[object Date]" === Object.prototype.toString.call(a);
  }

  function i(a, b) {
    var c,
        d = [];

    for (c = 0; c < a.length; ++c) {
      d.push(b(a[c], c));
    }

    return d;
  }

  function j(a, b) {
    return Object.prototype.hasOwnProperty.call(a, b);
  }

  function k(a, b) {
    for (var c in b) {
      j(b, c) && (a[c] = b[c]);
    }

    return j(b, "toString") && (a.toString = b.toString), j(b, "valueOf") && (a.valueOf = b.valueOf), a;
  }

  function l(a, b, c, d) {
    return sb(a, b, c, d, !0).utc();
  }

  function m() {
    return {
      empty: !1,
      unusedTokens: [],
      unusedInput: [],
      overflow: -2,
      charsLeftOver: 0,
      nullInput: !1,
      invalidMonth: null,
      invalidFormat: !1,
      userInvalidated: !1,
      iso: !1,
      parsedDateParts: [],
      meridiem: null,
      rfc2822: !1,
      weekdayMismatch: !1
    };
  }

  function n(a) {
    return null == a._pf && (a._pf = m()), a._pf;
  }

  function o(a) {
    if (null == a._isValid) {
      var b = n(a),
          c = ud.call(b.parsedDateParts, function (a) {
        return null != a;
      }),
          d = !isNaN(a._d.getTime()) && b.overflow < 0 && !b.empty && !b.invalidMonth && !b.invalidWeekday && !b.nullInput && !b.invalidFormat && !b.userInvalidated && (!b.meridiem || b.meridiem && c);
      if (a._strict && (d = d && 0 === b.charsLeftOver && 0 === b.unusedTokens.length && void 0 === b.bigHour), null != Object.isFrozen && Object.isFrozen(a)) return d;
      a._isValid = d;
    }

    return a._isValid;
  }

  function p(a) {
    var b = l(NaN);
    return null != a ? k(n(b), a) : n(b).userInvalidated = !0, b;
  }

  function q(a, b) {
    var c, d, e;
    if (f(b._isAMomentObject) || (a._isAMomentObject = b._isAMomentObject), f(b._i) || (a._i = b._i), f(b._f) || (a._f = b._f), f(b._l) || (a._l = b._l), f(b._strict) || (a._strict = b._strict), f(b._tzm) || (a._tzm = b._tzm), f(b._isUTC) || (a._isUTC = b._isUTC), f(b._offset) || (a._offset = b._offset), f(b._pf) || (a._pf = n(b)), f(b._locale) || (a._locale = b._locale), vd.length > 0) for (c = 0; c < vd.length; c++) {
      d = vd[c], e = b[d], f(e) || (a[d] = e);
    }
    return a;
  }

  function r(b) {
    q(this, b), this._d = new Date(null != b._d ? b._d.getTime() : NaN), this.isValid() || (this._d = new Date(NaN)), wd === !1 && (wd = !0, a.updateOffset(this), wd = !1);
  }

  function s(a) {
    return a instanceof r || null != a && null != a._isAMomentObject;
  }

  function t(a) {
    return a < 0 ? Math.ceil(a) || 0 : Math.floor(a);
  }

  function u(a) {
    var b = +a,
        c = 0;
    return 0 !== b && isFinite(b) && (c = t(b)), c;
  }

  function v(a, b, c) {
    var d,
        e = Math.min(a.length, b.length),
        f = Math.abs(a.length - b.length),
        g = 0;

    for (d = 0; d < e; d++) {
      (c && a[d] !== b[d] || !c && u(a[d]) !== u(b[d])) && g++;
    }

    return g + f;
  }

  function w(b) {
    a.suppressDeprecationWarnings === !1 && "undefined" != typeof console && console.warn && console.warn("Deprecation warning: " + b);
  }

  function x(b, c) {
    var d = !0;
    return k(function () {
      if (null != a.deprecationHandler && a.deprecationHandler(null, b), d) {
        for (var e, f = [], g = 0; g < arguments.length; g++) {
          if (e = "", "object" == _typeof(arguments[g])) {
            e += "\n[" + g + "] ";

            for (var h in arguments[0]) {
              e += h + ": " + arguments[0][h] + ", ";
            }

            e = e.slice(0, -2);
          } else e = arguments[g];

          f.push(e);
        }

        w(b + "\nArguments: " + Array.prototype.slice.call(f).join("") + "\n" + new Error().stack), d = !1;
      }

      return c.apply(this, arguments);
    }, c);
  }

  function y(b, c) {
    null != a.deprecationHandler && a.deprecationHandler(b, c), xd[b] || (w(c), xd[b] = !0);
  }

  function z(a) {
    return a instanceof Function || "[object Function]" === Object.prototype.toString.call(a);
  }

  function A(a) {
    var b, c;

    for (c in a) {
      b = a[c], z(b) ? this[c] = b : this["_" + c] = b;
    }

    this._config = a, this._dayOfMonthOrdinalParseLenient = new RegExp((this._dayOfMonthOrdinalParse.source || this._ordinalParse.source) + "|" + /\d{1,2}/.source);
  }

  function B(a, b) {
    var c,
        e = k({}, a);

    for (c in b) {
      j(b, c) && (d(a[c]) && d(b[c]) ? (e[c] = {}, k(e[c], a[c]), k(e[c], b[c])) : null != b[c] ? e[c] = b[c] : delete e[c]);
    }

    for (c in a) {
      j(a, c) && !j(b, c) && d(a[c]) && (e[c] = k({}, e[c]));
    }

    return e;
  }

  function C(a) {
    null != a && this.set(a);
  }

  function D(a, b, c) {
    var d = this._calendar[a] || this._calendar.sameElse;
    return z(d) ? d.call(b, c) : d;
  }

  function E(a) {
    var b = this._longDateFormat[a],
        c = this._longDateFormat[a.toUpperCase()];

    return b || !c ? b : (this._longDateFormat[a] = c.replace(/MMMM|MM|DD|dddd/g, function (a) {
      return a.slice(1);
    }), this._longDateFormat[a]);
  }

  function F() {
    return this._invalidDate;
  }

  function G(a) {
    return this._ordinal.replace("%d", a);
  }

  function H(a, b, c, d) {
    var e = this._relativeTime[c];
    return z(e) ? e(a, b, c, d) : e.replace(/%d/i, a);
  }

  function I(a, b) {
    var c = this._relativeTime[a > 0 ? "future" : "past"];
    return z(c) ? c(b) : c.replace(/%s/i, b);
  }

  function J(a, b) {
    var c = a.toLowerCase();
    Hd[c] = Hd[c + "s"] = Hd[b] = a;
  }

  function K(a) {
    return "string" == typeof a ? Hd[a] || Hd[a.toLowerCase()] : void 0;
  }

  function L(a) {
    var b,
        c,
        d = {};

    for (c in a) {
      j(a, c) && (b = K(c), b && (d[b] = a[c]));
    }

    return d;
  }

  function M(a, b) {
    Id[a] = b;
  }

  function N(a) {
    var b = [];

    for (var c in a) {
      b.push({
        unit: c,
        priority: Id[c]
      });
    }

    return b.sort(function (a, b) {
      return a.priority - b.priority;
    }), b;
  }

  function O(b, c) {
    return function (d) {
      return null != d ? (Q(this, b, d), a.updateOffset(this, c), this) : P(this, b);
    };
  }

  function P(a, b) {
    return a.isValid() ? a._d["get" + (a._isUTC ? "UTC" : "") + b]() : NaN;
  }

  function Q(a, b, c) {
    a.isValid() && a._d["set" + (a._isUTC ? "UTC" : "") + b](c);
  }

  function R(a) {
    return a = K(a), z(this[a]) ? this[a]() : this;
  }

  function S(a, b) {
    if ("object" == _typeof(a)) {
      a = L(a);

      for (var c = N(a), d = 0; d < c.length; d++) {
        this[c[d].unit](a[c[d].unit]);
      }
    } else if (a = K(a), z(this[a])) return this[a](b);

    return this;
  }

  function T(a, b, c) {
    var d = "" + Math.abs(a),
        e = b - d.length,
        f = a >= 0;
    return (f ? c ? "+" : "" : "-") + Math.pow(10, Math.max(0, e)).toString().substr(1) + d;
  }

  function U(a, b, c, d) {
    var e = d;
    "string" == typeof d && (e = function e() {
      return this[d]();
    }), a && (Md[a] = e), b && (Md[b[0]] = function () {
      return T(e.apply(this, arguments), b[1], b[2]);
    }), c && (Md[c] = function () {
      return this.localeData().ordinal(e.apply(this, arguments), a);
    });
  }

  function V(a) {
    return a.match(/\[[\s\S]/) ? a.replace(/^\[|\]$/g, "") : a.replace(/\\/g, "");
  }

  function W(a) {
    var b,
        c,
        d = a.match(Jd);

    for (b = 0, c = d.length; b < c; b++) {
      Md[d[b]] ? d[b] = Md[d[b]] : d[b] = V(d[b]);
    }

    return function (b) {
      var e,
          f = "";

      for (e = 0; e < c; e++) {
        f += z(d[e]) ? d[e].call(b, a) : d[e];
      }

      return f;
    };
  }

  function X(a, b) {
    return a.isValid() ? (b = Y(b, a.localeData()), Ld[b] = Ld[b] || W(b), Ld[b](a)) : a.localeData().invalidDate();
  }

  function Y(a, b) {
    function c(a) {
      return b.longDateFormat(a) || a;
    }

    var d = 5;

    for (Kd.lastIndex = 0; d >= 0 && Kd.test(a);) {
      a = a.replace(Kd, c), Kd.lastIndex = 0, d -= 1;
    }

    return a;
  }

  function Z(a, b, c) {
    ce[a] = z(b) ? b : function (a, d) {
      return a && c ? c : b;
    };
  }

  function $(a, b) {
    return j(ce, a) ? ce[a](b._strict, b._locale) : new RegExp(_(a));
  }

  function _(a) {
    return aa(a.replace("\\", "").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function (a, b, c, d, e) {
      return b || c || d || e;
    }));
  }

  function aa(a) {
    return a.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&");
  }

  function ba(a, b) {
    var c,
        d = b;

    for ("string" == typeof a && (a = [a]), g(b) && (d = function d(a, c) {
      c[b] = u(a);
    }), c = 0; c < a.length; c++) {
      de[a[c]] = d;
    }
  }

  function ca(a, b) {
    ba(a, function (a, c, d, e) {
      d._w = d._w || {}, b(a, d._w, d, e);
    });
  }

  function da(a, b, c) {
    null != b && j(de, a) && de[a](b, c._a, c, a);
  }

  function ea(a, b) {
    return new Date(Date.UTC(a, b + 1, 0)).getUTCDate();
  }

  function fa(a, b) {
    return a ? c(this._months) ? this._months[a.month()] : this._months[(this._months.isFormat || oe).test(b) ? "format" : "standalone"][a.month()] : c(this._months) ? this._months : this._months.standalone;
  }

  function ga(a, b) {
    return a ? c(this._monthsShort) ? this._monthsShort[a.month()] : this._monthsShort[oe.test(b) ? "format" : "standalone"][a.month()] : c(this._monthsShort) ? this._monthsShort : this._monthsShort.standalone;
  }

  function ha(a, b, c) {
    var d,
        e,
        f,
        g = a.toLocaleLowerCase();
    if (!this._monthsParse) for (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = [], d = 0; d < 12; ++d) {
      f = l([2e3, d]), this._shortMonthsParse[d] = this.monthsShort(f, "").toLocaleLowerCase(), this._longMonthsParse[d] = this.months(f, "").toLocaleLowerCase();
    }
    return c ? "MMM" === b ? (e = ne.call(this._shortMonthsParse, g), e !== -1 ? e : null) : (e = ne.call(this._longMonthsParse, g), e !== -1 ? e : null) : "MMM" === b ? (e = ne.call(this._shortMonthsParse, g), e !== -1 ? e : (e = ne.call(this._longMonthsParse, g), e !== -1 ? e : null)) : (e = ne.call(this._longMonthsParse, g), e !== -1 ? e : (e = ne.call(this._shortMonthsParse, g), e !== -1 ? e : null));
  }

  function ia(a, b, c) {
    var d, e, f;
    if (this._monthsParseExact) return ha.call(this, a, b, c);

    for (this._monthsParse || (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = []), d = 0; d < 12; d++) {
      if (e = l([2e3, d]), c && !this._longMonthsParse[d] && (this._longMonthsParse[d] = new RegExp("^" + this.months(e, "").replace(".", "") + "$", "i"), this._shortMonthsParse[d] = new RegExp("^" + this.monthsShort(e, "").replace(".", "") + "$", "i")), c || this._monthsParse[d] || (f = "^" + this.months(e, "") + "|^" + this.monthsShort(e, ""), this._monthsParse[d] = new RegExp(f.replace(".", ""), "i")), c && "MMMM" === b && this._longMonthsParse[d].test(a)) return d;
      if (c && "MMM" === b && this._shortMonthsParse[d].test(a)) return d;
      if (!c && this._monthsParse[d].test(a)) return d;
    }
  }

  function ja(a, b) {
    var c;
    if (!a.isValid()) return a;
    if ("string" == typeof b) if (/^\d+$/.test(b)) b = u(b);else if (b = a.localeData().monthsParse(b), !g(b)) return a;
    return c = Math.min(a.date(), ea(a.year(), b)), a._d["set" + (a._isUTC ? "UTC" : "") + "Month"](b, c), a;
  }

  function ka(b) {
    return null != b ? (ja(this, b), a.updateOffset(this, !0), this) : P(this, "Month");
  }

  function la() {
    return ea(this.year(), this.month());
  }

  function ma(a) {
    return this._monthsParseExact ? (j(this, "_monthsRegex") || oa.call(this), a ? this._monthsShortStrictRegex : this._monthsShortRegex) : (j(this, "_monthsShortRegex") || (this._monthsShortRegex = re), this._monthsShortStrictRegex && a ? this._monthsShortStrictRegex : this._monthsShortRegex);
  }

  function na(a) {
    return this._monthsParseExact ? (j(this, "_monthsRegex") || oa.call(this), a ? this._monthsStrictRegex : this._monthsRegex) : (j(this, "_monthsRegex") || (this._monthsRegex = se), this._monthsStrictRegex && a ? this._monthsStrictRegex : this._monthsRegex);
  }

  function oa() {
    function a(a, b) {
      return b.length - a.length;
    }

    var b,
        c,
        d = [],
        e = [],
        f = [];

    for (b = 0; b < 12; b++) {
      c = l([2e3, b]), d.push(this.monthsShort(c, "")), e.push(this.months(c, "")), f.push(this.months(c, "")), f.push(this.monthsShort(c, ""));
    }

    for (d.sort(a), e.sort(a), f.sort(a), b = 0; b < 12; b++) {
      d[b] = aa(d[b]), e[b] = aa(e[b]);
    }

    for (b = 0; b < 24; b++) {
      f[b] = aa(f[b]);
    }

    this._monthsRegex = new RegExp("^(" + f.join("|") + ")", "i"), this._monthsShortRegex = this._monthsRegex, this._monthsStrictRegex = new RegExp("^(" + e.join("|") + ")", "i"), this._monthsShortStrictRegex = new RegExp("^(" + d.join("|") + ")", "i");
  }

  function pa(a) {
    return qa(a) ? 366 : 365;
  }

  function qa(a) {
    return a % 4 === 0 && a % 100 !== 0 || a % 400 === 0;
  }

  function ra() {
    return qa(this.year());
  }

  function sa(a, b, c, d, e, f, g) {
    var h = new Date(a, b, c, d, e, f, g);
    return a < 100 && a >= 0 && isFinite(h.getFullYear()) && h.setFullYear(a), h;
  }

  function ta(a) {
    var b = new Date(Date.UTC.apply(null, arguments));
    return a < 100 && a >= 0 && isFinite(b.getUTCFullYear()) && b.setUTCFullYear(a), b;
  }

  function ua(a, b, c) {
    var d = 7 + b - c,
        e = (7 + ta(a, 0, d).getUTCDay() - b) % 7;
    return -e + d - 1;
  }

  function va(a, b, c, d, e) {
    var f,
        g,
        h = (7 + c - d) % 7,
        i = ua(a, d, e),
        j = 1 + 7 * (b - 1) + h + i;
    return j <= 0 ? (f = a - 1, g = pa(f) + j) : j > pa(a) ? (f = a + 1, g = j - pa(a)) : (f = a, g = j), {
      year: f,
      dayOfYear: g
    };
  }

  function wa(a, b, c) {
    var d,
        e,
        f = ua(a.year(), b, c),
        g = Math.floor((a.dayOfYear() - f - 1) / 7) + 1;
    return g < 1 ? (e = a.year() - 1, d = g + xa(e, b, c)) : g > xa(a.year(), b, c) ? (d = g - xa(a.year(), b, c), e = a.year() + 1) : (e = a.year(), d = g), {
      week: d,
      year: e
    };
  }

  function xa(a, b, c) {
    var d = ua(a, b, c),
        e = ua(a + 1, b, c);
    return (pa(a) - d + e) / 7;
  }

  function ya(a) {
    return wa(a, this._week.dow, this._week.doy).week;
  }

  function za() {
    return this._week.dow;
  }

  function Aa() {
    return this._week.doy;
  }

  function Ba(a) {
    var b = this.localeData().week(this);
    return null == a ? b : this.add(7 * (a - b), "d");
  }

  function Ca(a) {
    var b = wa(this, 1, 4).week;
    return null == a ? b : this.add(7 * (a - b), "d");
  }

  function Da(a, b) {
    return "string" != typeof a ? a : isNaN(a) ? (a = b.weekdaysParse(a), "number" == typeof a ? a : null) : parseInt(a, 10);
  }

  function Ea(a, b) {
    return "string" == typeof a ? b.weekdaysParse(a) % 7 || 7 : isNaN(a) ? null : a;
  }

  function Fa(a, b) {
    return a ? c(this._weekdays) ? this._weekdays[a.day()] : this._weekdays[this._weekdays.isFormat.test(b) ? "format" : "standalone"][a.day()] : c(this._weekdays) ? this._weekdays : this._weekdays.standalone;
  }

  function Ga(a) {
    return a ? this._weekdaysShort[a.day()] : this._weekdaysShort;
  }

  function Ha(a) {
    return a ? this._weekdaysMin[a.day()] : this._weekdaysMin;
  }

  function Ia(a, b, c) {
    var d,
        e,
        f,
        g = a.toLocaleLowerCase();
    if (!this._weekdaysParse) for (this._weekdaysParse = [], this._shortWeekdaysParse = [], this._minWeekdaysParse = [], d = 0; d < 7; ++d) {
      f = l([2e3, 1]).day(d), this._minWeekdaysParse[d] = this.weekdaysMin(f, "").toLocaleLowerCase(), this._shortWeekdaysParse[d] = this.weekdaysShort(f, "").toLocaleLowerCase(), this._weekdaysParse[d] = this.weekdays(f, "").toLocaleLowerCase();
    }
    return c ? "dddd" === b ? (e = ne.call(this._weekdaysParse, g), e !== -1 ? e : null) : "ddd" === b ? (e = ne.call(this._shortWeekdaysParse, g), e !== -1 ? e : null) : (e = ne.call(this._minWeekdaysParse, g), e !== -1 ? e : null) : "dddd" === b ? (e = ne.call(this._weekdaysParse, g), e !== -1 ? e : (e = ne.call(this._shortWeekdaysParse, g), e !== -1 ? e : (e = ne.call(this._minWeekdaysParse, g), e !== -1 ? e : null))) : "ddd" === b ? (e = ne.call(this._shortWeekdaysParse, g), e !== -1 ? e : (e = ne.call(this._weekdaysParse, g), e !== -1 ? e : (e = ne.call(this._minWeekdaysParse, g), e !== -1 ? e : null))) : (e = ne.call(this._minWeekdaysParse, g), e !== -1 ? e : (e = ne.call(this._weekdaysParse, g), e !== -1 ? e : (e = ne.call(this._shortWeekdaysParse, g), e !== -1 ? e : null)));
  }

  function Ja(a, b, c) {
    var d, e, f;
    if (this._weekdaysParseExact) return Ia.call(this, a, b, c);

    for (this._weekdaysParse || (this._weekdaysParse = [], this._minWeekdaysParse = [], this._shortWeekdaysParse = [], this._fullWeekdaysParse = []), d = 0; d < 7; d++) {
      if (e = l([2e3, 1]).day(d), c && !this._fullWeekdaysParse[d] && (this._fullWeekdaysParse[d] = new RegExp("^" + this.weekdays(e, "").replace(".", ".?") + "$", "i"), this._shortWeekdaysParse[d] = new RegExp("^" + this.weekdaysShort(e, "").replace(".", ".?") + "$", "i"), this._minWeekdaysParse[d] = new RegExp("^" + this.weekdaysMin(e, "").replace(".", ".?") + "$", "i")), this._weekdaysParse[d] || (f = "^" + this.weekdays(e, "") + "|^" + this.weekdaysShort(e, "") + "|^" + this.weekdaysMin(e, ""), this._weekdaysParse[d] = new RegExp(f.replace(".", ""), "i")), c && "dddd" === b && this._fullWeekdaysParse[d].test(a)) return d;
      if (c && "ddd" === b && this._shortWeekdaysParse[d].test(a)) return d;
      if (c && "dd" === b && this._minWeekdaysParse[d].test(a)) return d;
      if (!c && this._weekdaysParse[d].test(a)) return d;
    }
  }

  function Ka(a) {
    if (!this.isValid()) return null != a ? this : NaN;
    var b = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
    return null != a ? (a = Da(a, this.localeData()), this.add(a - b, "d")) : b;
  }

  function La(a) {
    if (!this.isValid()) return null != a ? this : NaN;
    var b = (this.day() + 7 - this.localeData()._week.dow) % 7;
    return null == a ? b : this.add(a - b, "d");
  }

  function Ma(a) {
    if (!this.isValid()) return null != a ? this : NaN;

    if (null != a) {
      var b = Ea(a, this.localeData());
      return this.day(this.day() % 7 ? b : b - 7);
    }

    return this.day() || 7;
  }

  function Na(a) {
    return this._weekdaysParseExact ? (j(this, "_weekdaysRegex") || Qa.call(this), a ? this._weekdaysStrictRegex : this._weekdaysRegex) : (j(this, "_weekdaysRegex") || (this._weekdaysRegex = ye), this._weekdaysStrictRegex && a ? this._weekdaysStrictRegex : this._weekdaysRegex);
  }

  function Oa(a) {
    return this._weekdaysParseExact ? (j(this, "_weekdaysRegex") || Qa.call(this), a ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex) : (j(this, "_weekdaysShortRegex") || (this._weekdaysShortRegex = ze), this._weekdaysShortStrictRegex && a ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex);
  }

  function Pa(a) {
    return this._weekdaysParseExact ? (j(this, "_weekdaysRegex") || Qa.call(this), a ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex) : (j(this, "_weekdaysMinRegex") || (this._weekdaysMinRegex = Ae), this._weekdaysMinStrictRegex && a ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex);
  }

  function Qa() {
    function a(a, b) {
      return b.length - a.length;
    }

    var b,
        c,
        d,
        e,
        f,
        g = [],
        h = [],
        i = [],
        j = [];

    for (b = 0; b < 7; b++) {
      c = l([2e3, 1]).day(b), d = this.weekdaysMin(c, ""), e = this.weekdaysShort(c, ""), f = this.weekdays(c, ""), g.push(d), h.push(e), i.push(f), j.push(d), j.push(e), j.push(f);
    }

    for (g.sort(a), h.sort(a), i.sort(a), j.sort(a), b = 0; b < 7; b++) {
      h[b] = aa(h[b]), i[b] = aa(i[b]), j[b] = aa(j[b]);
    }

    this._weekdaysRegex = new RegExp("^(" + j.join("|") + ")", "i"), this._weekdaysShortRegex = this._weekdaysRegex, this._weekdaysMinRegex = this._weekdaysRegex, this._weekdaysStrictRegex = new RegExp("^(" + i.join("|") + ")", "i"), this._weekdaysShortStrictRegex = new RegExp("^(" + h.join("|") + ")", "i"), this._weekdaysMinStrictRegex = new RegExp("^(" + g.join("|") + ")", "i");
  }

  function Ra() {
    return this.hours() % 12 || 12;
  }

  function Sa() {
    return this.hours() || 24;
  }

  function Ta(a, b) {
    U(a, 0, 0, function () {
      return this.localeData().meridiem(this.hours(), this.minutes(), b);
    });
  }

  function Ua(a, b) {
    return b._meridiemParse;
  }

  function Va(a) {
    return "p" === (a + "").toLowerCase().charAt(0);
  }

  function Wa(a, b, c) {
    return a > 11 ? c ? "pm" : "PM" : c ? "am" : "AM";
  }

  function Xa(a) {
    return a ? a.toLowerCase().replace("_", "-") : a;
  }

  function Ya(a) {
    for (var b, c, d, e, f = 0; f < a.length;) {
      for (e = Xa(a[f]).split("-"), b = e.length, c = Xa(a[f + 1]), c = c ? c.split("-") : null; b > 0;) {
        if (d = Za(e.slice(0, b).join("-"))) return d;
        if (c && c.length >= b && v(e, c, !0) >= b - 1) break;
        b--;
      }

      f++;
    }

    return null;
  }

  function Za(a) {
    var b = null;
    if (!Fe[a] && "undefined" != "object" && module && module.exports) try {
      b = Be._abbr, Object(function webpackMissingModule() { var e = new Error("Cannot find module 'undefined'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()), $a(b);
    } catch (a) {}
    return Fe[a];
  }

  function $a(a, b) {
    var c;
    return a && (c = f(b) ? bb(a) : _a(a, b), c && (Be = c)), Be._abbr;
  }

  function _a(a, b) {
    if (null !== b) {
      var c = Ee;
      if (b.abbr = a, null != Fe[a]) y("defineLocaleOverride", "use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."), c = Fe[a]._config;else if (null != b.parentLocale) {
        if (null == Fe[b.parentLocale]) return Ge[b.parentLocale] || (Ge[b.parentLocale] = []), Ge[b.parentLocale].push({
          name: a,
          config: b
        }), null;
        c = Fe[b.parentLocale]._config;
      }
      return Fe[a] = new C(B(c, b)), Ge[a] && Ge[a].forEach(function (a) {
        _a(a.name, a.config);
      }), $a(a), Fe[a];
    }

    return delete Fe[a], null;
  }

  function ab(a, b) {
    if (null != b) {
      var c,
          d = Ee;
      null != Fe[a] && (d = Fe[a]._config), b = B(d, b), c = new C(b), c.parentLocale = Fe[a], Fe[a] = c, $a(a);
    } else null != Fe[a] && (null != Fe[a].parentLocale ? Fe[a] = Fe[a].parentLocale : null != Fe[a] && delete Fe[a]);

    return Fe[a];
  }

  function bb(a) {
    var b;
    if (a && a._locale && a._locale._abbr && (a = a._locale._abbr), !a) return Be;

    if (!c(a)) {
      if (b = Za(a)) return b;
      a = [a];
    }

    return Ya(a);
  }

  function cb() {
    return Ad(Fe);
  }

  function db(a) {
    var b,
        c = a._a;
    return c && n(a).overflow === -2 && (b = c[fe] < 0 || c[fe] > 11 ? fe : c[ge] < 1 || c[ge] > ea(c[ee], c[fe]) ? ge : c[he] < 0 || c[he] > 24 || 24 === c[he] && (0 !== c[ie] || 0 !== c[je] || 0 !== c[ke]) ? he : c[ie] < 0 || c[ie] > 59 ? ie : c[je] < 0 || c[je] > 59 ? je : c[ke] < 0 || c[ke] > 999 ? ke : -1, n(a)._overflowDayOfYear && (b < ee || b > ge) && (b = ge), n(a)._overflowWeeks && b === -1 && (b = le), n(a)._overflowWeekday && b === -1 && (b = me), n(a).overflow = b), a;
  }

  function eb(a) {
    var b,
        c,
        d,
        e,
        f,
        g,
        h = a._i,
        i = He.exec(h) || Ie.exec(h);

    if (i) {
      for (n(a).iso = !0, b = 0, c = Ke.length; b < c; b++) {
        if (Ke[b][1].exec(i[1])) {
          e = Ke[b][0], d = Ke[b][2] !== !1;
          break;
        }
      }

      if (null == e) return void (a._isValid = !1);

      if (i[3]) {
        for (b = 0, c = Le.length; b < c; b++) {
          if (Le[b][1].exec(i[3])) {
            f = (i[2] || " ") + Le[b][0];
            break;
          }
        }

        if (null == f) return void (a._isValid = !1);
      }

      if (!d && null != f) return void (a._isValid = !1);

      if (i[4]) {
        if (!Je.exec(i[4])) return void (a._isValid = !1);
        g = "Z";
      }

      a._f = e + (f || "") + (g || ""), lb(a);
    } else a._isValid = !1;
  }

  function fb(a) {
    var b,
        c,
        d,
        e,
        f,
        g,
        h,
        i,
        j = {
      " GMT": " +0000",
      " EDT": " -0400",
      " EST": " -0500",
      " CDT": " -0500",
      " CST": " -0600",
      " MDT": " -0600",
      " MST": " -0700",
      " PDT": " -0700",
      " PST": " -0800"
    },
        k = "YXWVUTSRQPONZABCDEFGHIKLM";

    if (b = a._i.replace(/\([^\)]*\)|[\n\t]/g, " ").replace(/(\s\s+)/g, " ").replace(/^\s|\s$/g, ""), c = Ne.exec(b)) {
      if (d = c[1] ? "ddd" + (5 === c[1].length ? ", " : " ") : "", e = "D MMM " + (c[2].length > 10 ? "YYYY " : "YY "), f = "HH:mm" + (c[4] ? ":ss" : ""), c[1]) {
        var l = new Date(c[2]),
            m = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"][l.getDay()];
        if (c[1].substr(0, 3) !== m) return n(a).weekdayMismatch = !0, void (a._isValid = !1);
      }

      switch (c[5].length) {
        case 2:
          0 === i ? h = " +0000" : (i = k.indexOf(c[5][1].toUpperCase()) - 12, h = (i < 0 ? " -" : " +") + ("" + i).replace(/^-?/, "0").match(/..$/)[0] + "00");
          break;

        case 4:
          h = j[c[5]];
          break;

        default:
          h = j[" GMT"];
      }

      c[5] = h, a._i = c.splice(1).join(""), g = " ZZ", a._f = d + e + f + g, lb(a), n(a).rfc2822 = !0;
    } else a._isValid = !1;
  }

  function gb(b) {
    var c = Me.exec(b._i);
    return null !== c ? void (b._d = new Date(+c[1])) : (eb(b), void (b._isValid === !1 && (delete b._isValid, fb(b), b._isValid === !1 && (delete b._isValid, a.createFromInputFallback(b)))));
  }

  function hb(a, b, c) {
    return null != a ? a : null != b ? b : c;
  }

  function ib(b) {
    var c = new Date(a.now());
    return b._useUTC ? [c.getUTCFullYear(), c.getUTCMonth(), c.getUTCDate()] : [c.getFullYear(), c.getMonth(), c.getDate()];
  }

  function jb(a) {
    var b,
        c,
        d,
        e,
        f = [];

    if (!a._d) {
      for (d = ib(a), a._w && null == a._a[ge] && null == a._a[fe] && kb(a), null != a._dayOfYear && (e = hb(a._a[ee], d[ee]), (a._dayOfYear > pa(e) || 0 === a._dayOfYear) && (n(a)._overflowDayOfYear = !0), c = ta(e, 0, a._dayOfYear), a._a[fe] = c.getUTCMonth(), a._a[ge] = c.getUTCDate()), b = 0; b < 3 && null == a._a[b]; ++b) {
        a._a[b] = f[b] = d[b];
      }

      for (; b < 7; b++) {
        a._a[b] = f[b] = null == a._a[b] ? 2 === b ? 1 : 0 : a._a[b];
      }

      24 === a._a[he] && 0 === a._a[ie] && 0 === a._a[je] && 0 === a._a[ke] && (a._nextDay = !0, a._a[he] = 0), a._d = (a._useUTC ? ta : sa).apply(null, f), null != a._tzm && a._d.setUTCMinutes(a._d.getUTCMinutes() - a._tzm), a._nextDay && (a._a[he] = 24);
    }
  }

  function kb(a) {
    var b, c, d, e, f, g, h, i;
    if (b = a._w, null != b.GG || null != b.W || null != b.E) f = 1, g = 4, c = hb(b.GG, a._a[ee], wa(tb(), 1, 4).year), d = hb(b.W, 1), e = hb(b.E, 1), (e < 1 || e > 7) && (i = !0);else {
      f = a._locale._week.dow, g = a._locale._week.doy;
      var j = wa(tb(), f, g);
      c = hb(b.gg, a._a[ee], j.year), d = hb(b.w, j.week), null != b.d ? (e = b.d, (e < 0 || e > 6) && (i = !0)) : null != b.e ? (e = b.e + f, (b.e < 0 || b.e > 6) && (i = !0)) : e = f;
    }
    d < 1 || d > xa(c, f, g) ? n(a)._overflowWeeks = !0 : null != i ? n(a)._overflowWeekday = !0 : (h = va(c, d, e, f, g), a._a[ee] = h.year, a._dayOfYear = h.dayOfYear);
  }

  function lb(b) {
    if (b._f === a.ISO_8601) return void eb(b);
    if (b._f === a.RFC_2822) return void fb(b);
    b._a = [], n(b).empty = !0;
    var c,
        d,
        e,
        f,
        g,
        h = "" + b._i,
        i = h.length,
        j = 0;

    for (e = Y(b._f, b._locale).match(Jd) || [], c = 0; c < e.length; c++) {
      f = e[c], d = (h.match($(f, b)) || [])[0], d && (g = h.substr(0, h.indexOf(d)), g.length > 0 && n(b).unusedInput.push(g), h = h.slice(h.indexOf(d) + d.length), j += d.length), Md[f] ? (d ? n(b).empty = !1 : n(b).unusedTokens.push(f), da(f, d, b)) : b._strict && !d && n(b).unusedTokens.push(f);
    }

    n(b).charsLeftOver = i - j, h.length > 0 && n(b).unusedInput.push(h), b._a[he] <= 12 && n(b).bigHour === !0 && b._a[he] > 0 && (n(b).bigHour = void 0), n(b).parsedDateParts = b._a.slice(0), n(b).meridiem = b._meridiem, b._a[he] = mb(b._locale, b._a[he], b._meridiem), jb(b), db(b);
  }

  function mb(a, b, c) {
    var d;
    return null == c ? b : null != a.meridiemHour ? a.meridiemHour(b, c) : null != a.isPM ? (d = a.isPM(c), d && b < 12 && (b += 12), d || 12 !== b || (b = 0), b) : b;
  }

  function nb(a) {
    var b, c, d, e, f;
    if (0 === a._f.length) return n(a).invalidFormat = !0, void (a._d = new Date(NaN));

    for (e = 0; e < a._f.length; e++) {
      f = 0, b = q({}, a), null != a._useUTC && (b._useUTC = a._useUTC), b._f = a._f[e], lb(b), o(b) && (f += n(b).charsLeftOver, f += 10 * n(b).unusedTokens.length, n(b).score = f, (null == d || f < d) && (d = f, c = b));
    }

    k(a, c || b);
  }

  function ob(a) {
    if (!a._d) {
      var b = L(a._i);
      a._a = i([b.year, b.month, b.day || b.date, b.hour, b.minute, b.second, b.millisecond], function (a) {
        return a && parseInt(a, 10);
      }), jb(a);
    }
  }

  function pb(a) {
    var b = new r(db(qb(a)));
    return b._nextDay && (b.add(1, "d"), b._nextDay = void 0), b;
  }

  function qb(a) {
    var b = a._i,
        d = a._f;
    return a._locale = a._locale || bb(a._l), null === b || void 0 === d && "" === b ? p({
      nullInput: !0
    }) : ("string" == typeof b && (a._i = b = a._locale.preparse(b)), s(b) ? new r(db(b)) : (h(b) ? a._d = b : c(d) ? nb(a) : d ? lb(a) : rb(a), o(a) || (a._d = null), a));
  }

  function rb(b) {
    var e = b._i;
    f(e) ? b._d = new Date(a.now()) : h(e) ? b._d = new Date(e.valueOf()) : "string" == typeof e ? gb(b) : c(e) ? (b._a = i(e.slice(0), function (a) {
      return parseInt(a, 10);
    }), jb(b)) : d(e) ? ob(b) : g(e) ? b._d = new Date(e) : a.createFromInputFallback(b);
  }

  function sb(a, b, f, g, h) {
    var i = {};
    return f !== !0 && f !== !1 || (g = f, f = void 0), (d(a) && e(a) || c(a) && 0 === a.length) && (a = void 0), i._isAMomentObject = !0, i._useUTC = i._isUTC = h, i._l = f, i._i = a, i._f = b, i._strict = g, pb(i);
  }

  function tb(a, b, c, d) {
    return sb(a, b, c, d, !1);
  }

  function ub(a, b) {
    var d, e;
    if (1 === b.length && c(b[0]) && (b = b[0]), !b.length) return tb();

    for (d = b[0], e = 1; e < b.length; ++e) {
      b[e].isValid() && !b[e][a](d) || (d = b[e]);
    }

    return d;
  }

  function vb() {
    var a = [].slice.call(arguments, 0);
    return ub("isBefore", a);
  }

  function wb() {
    var a = [].slice.call(arguments, 0);
    return ub("isAfter", a);
  }

  function xb(a) {
    for (var b in a) {
      if (Re.indexOf(b) === -1 || null != a[b] && isNaN(a[b])) return !1;
    }

    for (var c = !1, d = 0; d < Re.length; ++d) {
      if (a[Re[d]]) {
        if (c) return !1;
        parseFloat(a[Re[d]]) !== u(a[Re[d]]) && (c = !0);
      }
    }

    return !0;
  }

  function yb() {
    return this._isValid;
  }

  function zb() {
    return Sb(NaN);
  }

  function Ab(a) {
    var b = L(a),
        c = b.year || 0,
        d = b.quarter || 0,
        e = b.month || 0,
        f = b.week || 0,
        g = b.day || 0,
        h = b.hour || 0,
        i = b.minute || 0,
        j = b.second || 0,
        k = b.millisecond || 0;
    this._isValid = xb(b), this._milliseconds = +k + 1e3 * j + 6e4 * i + 1e3 * h * 60 * 60, this._days = +g + 7 * f, this._months = +e + 3 * d + 12 * c, this._data = {}, this._locale = bb(), this._bubble();
  }

  function Bb(a) {
    return a instanceof Ab;
  }

  function Cb(a) {
    return a < 0 ? Math.round(-1 * a) * -1 : Math.round(a);
  }

  function Db(a, b) {
    U(a, 0, 0, function () {
      var a = this.utcOffset(),
          c = "+";
      return a < 0 && (a = -a, c = "-"), c + T(~~(a / 60), 2) + b + T(~~a % 60, 2);
    });
  }

  function Eb(a, b) {
    var c = (b || "").match(a);
    if (null === c) return null;
    var d = c[c.length - 1] || [],
        e = (d + "").match(Se) || ["-", 0, 0],
        f = +(60 * e[1]) + u(e[2]);
    return 0 === f ? 0 : "+" === e[0] ? f : -f;
  }

  function Fb(b, c) {
    var d, e;
    return c._isUTC ? (d = c.clone(), e = (s(b) || h(b) ? b.valueOf() : tb(b).valueOf()) - d.valueOf(), d._d.setTime(d._d.valueOf() + e), a.updateOffset(d, !1), d) : tb(b).local();
  }

  function Gb(a) {
    return 15 * -Math.round(a._d.getTimezoneOffset() / 15);
  }

  function Hb(b, c, d) {
    var e,
        f = this._offset || 0;
    if (!this.isValid()) return null != b ? this : NaN;

    if (null != b) {
      if ("string" == typeof b) {
        if (b = Eb(_d, b), null === b) return this;
      } else Math.abs(b) < 16 && !d && (b = 60 * b);

      return !this._isUTC && c && (e = Gb(this)), this._offset = b, this._isUTC = !0, null != e && this.add(e, "m"), f !== b && (!c || this._changeInProgress ? Xb(this, Sb(b - f, "m"), 1, !1) : this._changeInProgress || (this._changeInProgress = !0, a.updateOffset(this, !0), this._changeInProgress = null)), this;
    }

    return this._isUTC ? f : Gb(this);
  }

  function Ib(a, b) {
    return null != a ? ("string" != typeof a && (a = -a), this.utcOffset(a, b), this) : -this.utcOffset();
  }

  function Jb(a) {
    return this.utcOffset(0, a);
  }

  function Kb(a) {
    return this._isUTC && (this.utcOffset(0, a), this._isUTC = !1, a && this.subtract(Gb(this), "m")), this;
  }

  function Lb() {
    if (null != this._tzm) this.utcOffset(this._tzm, !1, !0);else if ("string" == typeof this._i) {
      var a = Eb($d, this._i);
      null != a ? this.utcOffset(a) : this.utcOffset(0, !0);
    }
    return this;
  }

  function Mb(a) {
    return !!this.isValid() && (a = a ? tb(a).utcOffset() : 0, (this.utcOffset() - a) % 60 === 0);
  }

  function Nb() {
    return this.utcOffset() > this.clone().month(0).utcOffset() || this.utcOffset() > this.clone().month(5).utcOffset();
  }

  function Ob() {
    if (!f(this._isDSTShifted)) return this._isDSTShifted;
    var a = {};

    if (q(a, this), a = qb(a), a._a) {
      var b = a._isUTC ? l(a._a) : tb(a._a);
      this._isDSTShifted = this.isValid() && v(a._a, b.toArray()) > 0;
    } else this._isDSTShifted = !1;

    return this._isDSTShifted;
  }

  function Pb() {
    return !!this.isValid() && !this._isUTC;
  }

  function Qb() {
    return !!this.isValid() && this._isUTC;
  }

  function Rb() {
    return !!this.isValid() && this._isUTC && 0 === this._offset;
  }

  function Sb(a, b) {
    var c,
        d,
        e,
        f = a,
        h = null;
    return Bb(a) ? f = {
      ms: a._milliseconds,
      d: a._days,
      M: a._months
    } : g(a) ? (f = {}, b ? f[b] = a : f.milliseconds = a) : (h = Te.exec(a)) ? (c = "-" === h[1] ? -1 : 1, f = {
      y: 0,
      d: u(h[ge]) * c,
      h: u(h[he]) * c,
      m: u(h[ie]) * c,
      s: u(h[je]) * c,
      ms: u(Cb(1e3 * h[ke])) * c
    }) : (h = Ue.exec(a)) ? (c = "-" === h[1] ? -1 : 1, f = {
      y: Tb(h[2], c),
      M: Tb(h[3], c),
      w: Tb(h[4], c),
      d: Tb(h[5], c),
      h: Tb(h[6], c),
      m: Tb(h[7], c),
      s: Tb(h[8], c)
    }) : null == f ? f = {} : "object" == _typeof(f) && ("from" in f || "to" in f) && (e = Vb(tb(f.from), tb(f.to)), f = {}, f.ms = e.milliseconds, f.M = e.months), d = new Ab(f), Bb(a) && j(a, "_locale") && (d._locale = a._locale), d;
  }

  function Tb(a, b) {
    var c = a && parseFloat(a.replace(",", "."));
    return (isNaN(c) ? 0 : c) * b;
  }

  function Ub(a, b) {
    var c = {
      milliseconds: 0,
      months: 0
    };
    return c.months = b.month() - a.month() + 12 * (b.year() - a.year()), a.clone().add(c.months, "M").isAfter(b) && --c.months, c.milliseconds = +b - +a.clone().add(c.months, "M"), c;
  }

  function Vb(a, b) {
    var c;
    return a.isValid() && b.isValid() ? (b = Fb(b, a), a.isBefore(b) ? c = Ub(a, b) : (c = Ub(b, a), c.milliseconds = -c.milliseconds, c.months = -c.months), c) : {
      milliseconds: 0,
      months: 0
    };
  }

  function Wb(a, b) {
    return function (c, d) {
      var e, f;
      return null === d || isNaN(+d) || (y(b, "moment()." + b + "(period, number) is deprecated. Please use moment()." + b + "(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."), f = c, c = d, d = f), c = "string" == typeof c ? +c : c, e = Sb(c, d), Xb(this, e, a), this;
    };
  }

  function Xb(b, c, d, e) {
    var f = c._milliseconds,
        g = Cb(c._days),
        h = Cb(c._months);
    b.isValid() && (e = null == e || e, f && b._d.setTime(b._d.valueOf() + f * d), g && Q(b, "Date", P(b, "Date") + g * d), h && ja(b, P(b, "Month") + h * d), e && a.updateOffset(b, g || h));
  }

  function Yb(a, b) {
    var c = a.diff(b, "days", !0);
    return c < -6 ? "sameElse" : c < -1 ? "lastWeek" : c < 0 ? "lastDay" : c < 1 ? "sameDay" : c < 2 ? "nextDay" : c < 7 ? "nextWeek" : "sameElse";
  }

  function Zb(b, c) {
    var d = b || tb(),
        e = Fb(d, this).startOf("day"),
        f = a.calendarFormat(this, e) || "sameElse",
        g = c && (z(c[f]) ? c[f].call(this, d) : c[f]);
    return this.format(g || this.localeData().calendar(f, this, tb(d)));
  }

  function $b() {
    return new r(this);
  }

  function _b(a, b) {
    var c = s(a) ? a : tb(a);
    return !(!this.isValid() || !c.isValid()) && (b = K(f(b) ? "millisecond" : b), "millisecond" === b ? this.valueOf() > c.valueOf() : c.valueOf() < this.clone().startOf(b).valueOf());
  }

  function ac(a, b) {
    var c = s(a) ? a : tb(a);
    return !(!this.isValid() || !c.isValid()) && (b = K(f(b) ? "millisecond" : b), "millisecond" === b ? this.valueOf() < c.valueOf() : this.clone().endOf(b).valueOf() < c.valueOf());
  }

  function bc(a, b, c, d) {
    return d = d || "()", ("(" === d[0] ? this.isAfter(a, c) : !this.isBefore(a, c)) && (")" === d[1] ? this.isBefore(b, c) : !this.isAfter(b, c));
  }

  function cc(a, b) {
    var c,
        d = s(a) ? a : tb(a);
    return !(!this.isValid() || !d.isValid()) && (b = K(b || "millisecond"), "millisecond" === b ? this.valueOf() === d.valueOf() : (c = d.valueOf(), this.clone().startOf(b).valueOf() <= c && c <= this.clone().endOf(b).valueOf()));
  }

  function dc(a, b) {
    return this.isSame(a, b) || this.isAfter(a, b);
  }

  function ec(a, b) {
    return this.isSame(a, b) || this.isBefore(a, b);
  }

  function fc(a, b, c) {
    var d, e, f, g;
    return this.isValid() ? (d = Fb(a, this), d.isValid() ? (e = 6e4 * (d.utcOffset() - this.utcOffset()), b = K(b), "year" === b || "month" === b || "quarter" === b ? (g = gc(this, d), "quarter" === b ? g /= 3 : "year" === b && (g /= 12)) : (f = this - d, g = "second" === b ? f / 1e3 : "minute" === b ? f / 6e4 : "hour" === b ? f / 36e5 : "day" === b ? (f - e) / 864e5 : "week" === b ? (f - e) / 6048e5 : f), c ? g : t(g)) : NaN) : NaN;
  }

  function gc(a, b) {
    var c,
        d,
        e = 12 * (b.year() - a.year()) + (b.month() - a.month()),
        f = a.clone().add(e, "months");
    return b - f < 0 ? (c = a.clone().add(e - 1, "months"), d = (b - f) / (f - c)) : (c = a.clone().add(e + 1, "months"), d = (b - f) / (c - f)), -(e + d) || 0;
  }

  function hc() {
    return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ");
  }

  function ic() {
    if (!this.isValid()) return null;
    var a = this.clone().utc();
    return a.year() < 0 || a.year() > 9999 ? X(a, "YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]") : z(Date.prototype.toISOString) ? this.toDate().toISOString() : X(a, "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]");
  }

  function jc() {
    if (!this.isValid()) return "moment.invalid(/* " + this._i + " */)";
    var a = "moment",
        b = "";
    this.isLocal() || (a = 0 === this.utcOffset() ? "moment.utc" : "moment.parseZone", b = "Z");
    var c = "[" + a + '("]',
        d = 0 <= this.year() && this.year() <= 9999 ? "YYYY" : "YYYYYY",
        e = "-MM-DD[T]HH:mm:ss.SSS",
        f = b + '[")]';
    return this.format(c + d + e + f);
  }

  function kc(b) {
    b || (b = this.isUtc() ? a.defaultFormatUtc : a.defaultFormat);
    var c = X(this, b);
    return this.localeData().postformat(c);
  }

  function lc(a, b) {
    return this.isValid() && (s(a) && a.isValid() || tb(a).isValid()) ? Sb({
      to: this,
      from: a
    }).locale(this.locale()).humanize(!b) : this.localeData().invalidDate();
  }

  function mc(a) {
    return this.from(tb(), a);
  }

  function nc(a, b) {
    return this.isValid() && (s(a) && a.isValid() || tb(a).isValid()) ? Sb({
      from: this,
      to: a
    }).locale(this.locale()).humanize(!b) : this.localeData().invalidDate();
  }

  function oc(a) {
    return this.to(tb(), a);
  }

  function pc(a) {
    var b;
    return void 0 === a ? this._locale._abbr : (b = bb(a), null != b && (this._locale = b), this);
  }

  function qc() {
    return this._locale;
  }

  function rc(a) {
    switch (a = K(a)) {
      case "year":
        this.month(0);

      case "quarter":
      case "month":
        this.date(1);

      case "week":
      case "isoWeek":
      case "day":
      case "date":
        this.hours(0);

      case "hour":
        this.minutes(0);

      case "minute":
        this.seconds(0);

      case "second":
        this.milliseconds(0);
    }

    return "week" === a && this.weekday(0), "isoWeek" === a && this.isoWeekday(1), "quarter" === a && this.month(3 * Math.floor(this.month() / 3)), this;
  }

  function sc(a) {
    return a = K(a), void 0 === a || "millisecond" === a ? this : ("date" === a && (a = "day"), this.startOf(a).add(1, "isoWeek" === a ? "week" : a).subtract(1, "ms"));
  }

  function tc() {
    return this._d.valueOf() - 6e4 * (this._offset || 0);
  }

  function uc() {
    return Math.floor(this.valueOf() / 1e3);
  }

  function vc() {
    return new Date(this.valueOf());
  }

  function wc() {
    var a = this;
    return [a.year(), a.month(), a.date(), a.hour(), a.minute(), a.second(), a.millisecond()];
  }

  function xc() {
    var a = this;
    return {
      years: a.year(),
      months: a.month(),
      date: a.date(),
      hours: a.hours(),
      minutes: a.minutes(),
      seconds: a.seconds(),
      milliseconds: a.milliseconds()
    };
  }

  function yc() {
    return this.isValid() ? this.toISOString() : null;
  }

  function zc() {
    return o(this);
  }

  function Ac() {
    return k({}, n(this));
  }

  function Bc() {
    return n(this).overflow;
  }

  function Cc() {
    return {
      input: this._i,
      format: this._f,
      locale: this._locale,
      isUTC: this._isUTC,
      strict: this._strict
    };
  }

  function Dc(a, b) {
    U(0, [a, a.length], 0, b);
  }

  function Ec(a) {
    return Ic.call(this, a, this.week(), this.weekday(), this.localeData()._week.dow, this.localeData()._week.doy);
  }

  function Fc(a) {
    return Ic.call(this, a, this.isoWeek(), this.isoWeekday(), 1, 4);
  }

  function Gc() {
    return xa(this.year(), 1, 4);
  }

  function Hc() {
    var a = this.localeData()._week;

    return xa(this.year(), a.dow, a.doy);
  }

  function Ic(a, b, c, d, e) {
    var f;
    return null == a ? wa(this, d, e).year : (f = xa(a, d, e), b > f && (b = f), Jc.call(this, a, b, c, d, e));
  }

  function Jc(a, b, c, d, e) {
    var f = va(a, b, c, d, e),
        g = ta(f.year, 0, f.dayOfYear);
    return this.year(g.getUTCFullYear()), this.month(g.getUTCMonth()), this.date(g.getUTCDate()), this;
  }

  function Kc(a) {
    return null == a ? Math.ceil((this.month() + 1) / 3) : this.month(3 * (a - 1) + this.month() % 3);
  }

  function Lc(a) {
    var b = Math.round((this.clone().startOf("day") - this.clone().startOf("year")) / 864e5) + 1;
    return null == a ? b : this.add(a - b, "d");
  }

  function Mc(a, b) {
    b[ke] = u(1e3 * ("0." + a));
  }

  function Nc() {
    return this._isUTC ? "UTC" : "";
  }

  function Oc() {
    return this._isUTC ? "Coordinated Universal Time" : "";
  }

  function Pc(a) {
    return tb(1e3 * a);
  }

  function Qc() {
    return tb.apply(null, arguments).parseZone();
  }

  function Rc(a) {
    return a;
  }

  function Sc(a, b, c, d) {
    var e = bb(),
        f = l().set(d, b);
    return e[c](f, a);
  }

  function Tc(a, b, c) {
    if (g(a) && (b = a, a = void 0), a = a || "", null != b) return Sc(a, b, c, "month");
    var d,
        e = [];

    for (d = 0; d < 12; d++) {
      e[d] = Sc(a, d, c, "month");
    }

    return e;
  }

  function Uc(a, b, c, d) {
    "boolean" == typeof a ? (g(b) && (c = b, b = void 0), b = b || "") : (b = a, c = b, a = !1, g(b) && (c = b, b = void 0), b = b || "");
    var e = bb(),
        f = a ? e._week.dow : 0;
    if (null != c) return Sc(b, (c + f) % 7, d, "day");
    var h,
        i = [];

    for (h = 0; h < 7; h++) {
      i[h] = Sc(b, (h + f) % 7, d, "day");
    }

    return i;
  }

  function Vc(a, b) {
    return Tc(a, b, "months");
  }

  function Wc(a, b) {
    return Tc(a, b, "monthsShort");
  }

  function Xc(a, b, c) {
    return Uc(a, b, c, "weekdays");
  }

  function Yc(a, b, c) {
    return Uc(a, b, c, "weekdaysShort");
  }

  function Zc(a, b, c) {
    return Uc(a, b, c, "weekdaysMin");
  }

  function $c() {
    var a = this._data;
    return this._milliseconds = df(this._milliseconds), this._days = df(this._days), this._months = df(this._months), a.milliseconds = df(a.milliseconds), a.seconds = df(a.seconds), a.minutes = df(a.minutes), a.hours = df(a.hours), a.months = df(a.months), a.years = df(a.years), this;
  }

  function _c(a, b, c, d) {
    var e = Sb(b, c);
    return a._milliseconds += d * e._milliseconds, a._days += d * e._days, a._months += d * e._months, a._bubble();
  }

  function ad(a, b) {
    return _c(this, a, b, 1);
  }

  function bd(a, b) {
    return _c(this, a, b, -1);
  }

  function cd(a) {
    return a < 0 ? Math.floor(a) : Math.ceil(a);
  }

  function dd() {
    var a,
        b,
        c,
        d,
        e,
        f = this._milliseconds,
        g = this._days,
        h = this._months,
        i = this._data;
    return f >= 0 && g >= 0 && h >= 0 || f <= 0 && g <= 0 && h <= 0 || (f += 864e5 * cd(fd(h) + g), g = 0, h = 0), i.milliseconds = f % 1e3, a = t(f / 1e3), i.seconds = a % 60, b = t(a / 60), i.minutes = b % 60, c = t(b / 60), i.hours = c % 24, g += t(c / 24), e = t(ed(g)), h += e, g -= cd(fd(e)), d = t(h / 12), h %= 12, i.days = g, i.months = h, i.years = d, this;
  }

  function ed(a) {
    return 4800 * a / 146097;
  }

  function fd(a) {
    return 146097 * a / 4800;
  }

  function gd(a) {
    if (!this.isValid()) return NaN;
    var b,
        c,
        d = this._milliseconds;
    if (a = K(a), "month" === a || "year" === a) return b = this._days + d / 864e5, c = this._months + ed(b), "month" === a ? c : c / 12;

    switch (b = this._days + Math.round(fd(this._months)), a) {
      case "week":
        return b / 7 + d / 6048e5;

      case "day":
        return b + d / 864e5;

      case "hour":
        return 24 * b + d / 36e5;

      case "minute":
        return 1440 * b + d / 6e4;

      case "second":
        return 86400 * b + d / 1e3;

      case "millisecond":
        return Math.floor(864e5 * b) + d;

      default:
        throw new Error("Unknown unit " + a);
    }
  }

  function hd() {
    return this.isValid() ? this._milliseconds + 864e5 * this._days + this._months % 12 * 2592e6 + 31536e6 * u(this._months / 12) : NaN;
  }

  function id(a) {
    return function () {
      return this.as(a);
    };
  }

  function jd(a) {
    return a = K(a), this.isValid() ? this[a + "s"]() : NaN;
  }

  function kd(a) {
    return function () {
      return this.isValid() ? this._data[a] : NaN;
    };
  }

  function ld() {
    return t(this.days() / 7);
  }

  function md(a, b, c, d, e) {
    return e.relativeTime(b || 1, !!c, a, d);
  }

  function nd(a, b, c) {
    var d = Sb(a).abs(),
        e = uf(d.as("s")),
        f = uf(d.as("m")),
        g = uf(d.as("h")),
        h = uf(d.as("d")),
        i = uf(d.as("M")),
        j = uf(d.as("y")),
        k = e <= vf.ss && ["s", e] || e < vf.s && ["ss", e] || f <= 1 && ["m"] || f < vf.m && ["mm", f] || g <= 1 && ["h"] || g < vf.h && ["hh", g] || h <= 1 && ["d"] || h < vf.d && ["dd", h] || i <= 1 && ["M"] || i < vf.M && ["MM", i] || j <= 1 && ["y"] || ["yy", j];
    return k[2] = b, k[3] = +a > 0, k[4] = c, md.apply(null, k);
  }

  function od(a) {
    return void 0 === a ? uf : "function" == typeof a && (uf = a, !0);
  }

  function pd(a, b) {
    return void 0 !== vf[a] && (void 0 === b ? vf[a] : (vf[a] = b, "s" === a && (vf.ss = b - 1), !0));
  }

  function qd(a) {
    if (!this.isValid()) return this.localeData().invalidDate();
    var b = this.localeData(),
        c = nd(this, !a, b);
    return a && (c = b.pastFuture(+this, c)), b.postformat(c);
  }

  function rd() {
    if (!this.isValid()) return this.localeData().invalidDate();
    var a,
        b,
        c,
        d = wf(this._milliseconds) / 1e3,
        e = wf(this._days),
        f = wf(this._months);
    a = t(d / 60), b = t(a / 60), d %= 60, a %= 60, c = t(f / 12), f %= 12;
    var g = c,
        h = f,
        i = e,
        j = b,
        k = a,
        l = d,
        m = this.asSeconds();
    return m ? (m < 0 ? "-" : "") + "P" + (g ? g + "Y" : "") + (h ? h + "M" : "") + (i ? i + "D" : "") + (j || k || l ? "T" : "") + (j ? j + "H" : "") + (k ? k + "M" : "") + (l ? l + "S" : "") : "P0D";
  }

  var sd, td;
  td = Array.prototype.some ? Array.prototype.some : function (a) {
    for (var b = Object(this), c = b.length >>> 0, d = 0; d < c; d++) {
      if (d in b && a.call(this, b[d], d, b)) return !0;
    }

    return !1;
  };
  var ud = td,
      vd = a.momentProperties = [],
      wd = !1,
      xd = {};
  a.suppressDeprecationWarnings = !1, a.deprecationHandler = null;
  var yd;
  yd = Object.keys ? Object.keys : function (a) {
    var b,
        c = [];

    for (b in a) {
      j(a, b) && c.push(b);
    }

    return c;
  };
  var zd,
      Ad = yd,
      Bd = {
    sameDay: "[Today at] LT",
    nextDay: "[Tomorrow at] LT",
    nextWeek: "dddd [at] LT",
    lastDay: "[Yesterday at] LT",
    lastWeek: "[Last] dddd [at] LT",
    sameElse: "L"
  },
      Cd = {
    LTS: "h:mm:ss A",
    LT: "h:mm A",
    L: "MM/DD/YYYY",
    LL: "MMMM D, YYYY",
    LLL: "MMMM D, YYYY h:mm A",
    LLLL: "dddd, MMMM D, YYYY h:mm A"
  },
      Dd = "Invalid date",
      Ed = "%d",
      Fd = /\d{1,2}/,
      Gd = {
    future: "in %s",
    past: "%s ago",
    s: "a few seconds",
    ss: "%d seconds",
    m: "a minute",
    mm: "%d minutes",
    h: "an hour",
    hh: "%d hours",
    d: "a day",
    dd: "%d days",
    M: "a month",
    MM: "%d months",
    y: "a year",
    yy: "%d years"
  },
      Hd = {},
      Id = {},
      Jd = /(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g,
      Kd = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g,
      Ld = {},
      Md = {},
      Nd = /\d/,
      Od = /\d\d/,
      Pd = /\d{3}/,
      Qd = /\d{4}/,
      Rd = /[+-]?\d{6}/,
      Sd = /\d\d?/,
      Td = /\d\d\d\d?/,
      Ud = /\d\d\d\d\d\d?/,
      Vd = /\d{1,3}/,
      Wd = /\d{1,4}/,
      Xd = /[+-]?\d{1,6}/,
      Yd = /\d+/,
      Zd = /[+-]?\d+/,
      $d = /Z|[+-]\d\d:?\d\d/gi,
      _d = /Z|[+-]\d\d(?::?\d\d)?/gi,
      ae = /[+-]?\d+(\.\d{1,3})?/,
      be = /[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i,
      ce = {},
      de = {},
      ee = 0,
      fe = 1,
      ge = 2,
      he = 3,
      ie = 4,
      je = 5,
      ke = 6,
      le = 7,
      me = 8;
  zd = Array.prototype.indexOf ? Array.prototype.indexOf : function (a) {
    var b;

    for (b = 0; b < this.length; ++b) {
      if (this[b] === a) return b;
    }

    return -1;
  };
  var ne = zd;
  U("M", ["MM", 2], "Mo", function () {
    return this.month() + 1;
  }), U("MMM", 0, 0, function (a) {
    return this.localeData().monthsShort(this, a);
  }), U("MMMM", 0, 0, function (a) {
    return this.localeData().months(this, a);
  }), J("month", "M"), M("month", 8), Z("M", Sd), Z("MM", Sd, Od), Z("MMM", function (a, b) {
    return b.monthsShortRegex(a);
  }), Z("MMMM", function (a, b) {
    return b.monthsRegex(a);
  }), ba(["M", "MM"], function (a, b) {
    b[fe] = u(a) - 1;
  }), ba(["MMM", "MMMM"], function (a, b, c, d) {
    var e = c._locale.monthsParse(a, d, c._strict);

    null != e ? b[fe] = e : n(c).invalidMonth = a;
  });
  var oe = /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/,
      pe = "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
      qe = "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
      re = be,
      se = be;
  U("Y", 0, 0, function () {
    var a = this.year();
    return a <= 9999 ? "" + a : "+" + a;
  }), U(0, ["YY", 2], 0, function () {
    return this.year() % 100;
  }), U(0, ["YYYY", 4], 0, "year"), U(0, ["YYYYY", 5], 0, "year"), U(0, ["YYYYYY", 6, !0], 0, "year"), J("year", "y"), M("year", 1), Z("Y", Zd), Z("YY", Sd, Od), Z("YYYY", Wd, Qd), Z("YYYYY", Xd, Rd), Z("YYYYYY", Xd, Rd), ba(["YYYYY", "YYYYYY"], ee), ba("YYYY", function (b, c) {
    c[ee] = 2 === b.length ? a.parseTwoDigitYear(b) : u(b);
  }), ba("YY", function (b, c) {
    c[ee] = a.parseTwoDigitYear(b);
  }), ba("Y", function (a, b) {
    b[ee] = parseInt(a, 10);
  }), a.parseTwoDigitYear = function (a) {
    return u(a) + (u(a) > 68 ? 1900 : 2e3);
  };
  var te = O("FullYear", !0);
  U("w", ["ww", 2], "wo", "week"), U("W", ["WW", 2], "Wo", "isoWeek"), J("week", "w"), J("isoWeek", "W"), M("week", 5), M("isoWeek", 5), Z("w", Sd), Z("ww", Sd, Od), Z("W", Sd), Z("WW", Sd, Od), ca(["w", "ww", "W", "WW"], function (a, b, c, d) {
    b[d.substr(0, 1)] = u(a);
  });
  var ue = {
    dow: 0,
    doy: 6
  };
  U("d", 0, "do", "day"), U("dd", 0, 0, function (a) {
    return this.localeData().weekdaysMin(this, a);
  }), U("ddd", 0, 0, function (a) {
    return this.localeData().weekdaysShort(this, a);
  }), U("dddd", 0, 0, function (a) {
    return this.localeData().weekdays(this, a);
  }), U("e", 0, 0, "weekday"), U("E", 0, 0, "isoWeekday"), J("day", "d"), J("weekday", "e"), J("isoWeekday", "E"), M("day", 11), M("weekday", 11), M("isoWeekday", 11), Z("d", Sd), Z("e", Sd), Z("E", Sd), Z("dd", function (a, b) {
    return b.weekdaysMinRegex(a);
  }), Z("ddd", function (a, b) {
    return b.weekdaysShortRegex(a);
  }), Z("dddd", function (a, b) {
    return b.weekdaysRegex(a);
  }), ca(["dd", "ddd", "dddd"], function (a, b, c, d) {
    var e = c._locale.weekdaysParse(a, d, c._strict);

    null != e ? b.d = e : n(c).invalidWeekday = a;
  }), ca(["d", "e", "E"], function (a, b, c, d) {
    b[d] = u(a);
  });
  var ve = "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
      we = "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
      xe = "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
      ye = be,
      ze = be,
      Ae = be;
  U("H", ["HH", 2], 0, "hour"), U("h", ["hh", 2], 0, Ra), U("k", ["kk", 2], 0, Sa), U("hmm", 0, 0, function () {
    return "" + Ra.apply(this) + T(this.minutes(), 2);
  }), U("hmmss", 0, 0, function () {
    return "" + Ra.apply(this) + T(this.minutes(), 2) + T(this.seconds(), 2);
  }), U("Hmm", 0, 0, function () {
    return "" + this.hours() + T(this.minutes(), 2);
  }), U("Hmmss", 0, 0, function () {
    return "" + this.hours() + T(this.minutes(), 2) + T(this.seconds(), 2);
  }), Ta("a", !0), Ta("A", !1), J("hour", "h"), M("hour", 13), Z("a", Ua), Z("A", Ua), Z("H", Sd), Z("h", Sd), Z("k", Sd), Z("HH", Sd, Od), Z("hh", Sd, Od), Z("kk", Sd, Od), Z("hmm", Td), Z("hmmss", Ud), Z("Hmm", Td), Z("Hmmss", Ud), ba(["H", "HH"], he), ba(["k", "kk"], function (a, b, c) {
    var d = u(a);
    b[he] = 24 === d ? 0 : d;
  }), ba(["a", "A"], function (a, b, c) {
    c._isPm = c._locale.isPM(a), c._meridiem = a;
  }), ba(["h", "hh"], function (a, b, c) {
    b[he] = u(a), n(c).bigHour = !0;
  }), ba("hmm", function (a, b, c) {
    var d = a.length - 2;
    b[he] = u(a.substr(0, d)), b[ie] = u(a.substr(d)), n(c).bigHour = !0;
  }), ba("hmmss", function (a, b, c) {
    var d = a.length - 4,
        e = a.length - 2;
    b[he] = u(a.substr(0, d)), b[ie] = u(a.substr(d, 2)), b[je] = u(a.substr(e)), n(c).bigHour = !0;
  }), ba("Hmm", function (a, b, c) {
    var d = a.length - 2;
    b[he] = u(a.substr(0, d)), b[ie] = u(a.substr(d));
  }), ba("Hmmss", function (a, b, c) {
    var d = a.length - 4,
        e = a.length - 2;
    b[he] = u(a.substr(0, d)), b[ie] = u(a.substr(d, 2)), b[je] = u(a.substr(e));
  });
  var Be,
      Ce = /[ap]\.?m?\.?/i,
      De = O("Hours", !0),
      Ee = {
    calendar: Bd,
    longDateFormat: Cd,
    invalidDate: Dd,
    ordinal: Ed,
    dayOfMonthOrdinalParse: Fd,
    relativeTime: Gd,
    months: pe,
    monthsShort: qe,
    week: ue,
    weekdays: ve,
    weekdaysMin: xe,
    weekdaysShort: we,
    meridiemParse: Ce
  },
      Fe = {},
      Ge = {},
      He = /^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
      Ie = /^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
      Je = /Z|[+-]\d\d(?::?\d\d)?/,
      Ke = [["YYYYYY-MM-DD", /[+-]\d{6}-\d\d-\d\d/], ["YYYY-MM-DD", /\d{4}-\d\d-\d\d/], ["GGGG-[W]WW-E", /\d{4}-W\d\d-\d/], ["GGGG-[W]WW", /\d{4}-W\d\d/, !1], ["YYYY-DDD", /\d{4}-\d{3}/], ["YYYY-MM", /\d{4}-\d\d/, !1], ["YYYYYYMMDD", /[+-]\d{10}/], ["YYYYMMDD", /\d{8}/], ["GGGG[W]WWE", /\d{4}W\d{3}/], ["GGGG[W]WW", /\d{4}W\d{2}/, !1], ["YYYYDDD", /\d{7}/]],
      Le = [["HH:mm:ss.SSSS", /\d\d:\d\d:\d\d\.\d+/], ["HH:mm:ss,SSSS", /\d\d:\d\d:\d\d,\d+/], ["HH:mm:ss", /\d\d:\d\d:\d\d/], ["HH:mm", /\d\d:\d\d/], ["HHmmss.SSSS", /\d\d\d\d\d\d\.\d+/], ["HHmmss,SSSS", /\d\d\d\d\d\d,\d+/], ["HHmmss", /\d\d\d\d\d\d/], ["HHmm", /\d\d\d\d/], ["HH", /\d\d/]],
      Me = /^\/?Date\((\-?\d+)/i,
      Ne = /^((?:Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d?\d\s(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(?:\d\d)?\d\d\s)(\d\d:\d\d)(\:\d\d)?(\s(?:UT|GMT|[ECMP][SD]T|[A-IK-Za-ik-z]|[+-]\d{4}))$/;
  a.createFromInputFallback = x("value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged and will be removed in an upcoming major release. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.", function (a) {
    a._d = new Date(a._i + (a._useUTC ? " UTC" : ""));
  }), a.ISO_8601 = function () {}, a.RFC_2822 = function () {};

  var Oe = x("moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/", function () {
    var a = tb.apply(null, arguments);
    return this.isValid() && a.isValid() ? a < this ? this : a : p();
  }),
      Pe = x("moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/", function () {
    var a = tb.apply(null, arguments);
    return this.isValid() && a.isValid() ? a > this ? this : a : p();
  }),
      Qe = function Qe() {
    return Date.now ? Date.now() : +new Date();
  },
      Re = ["year", "quarter", "month", "week", "day", "hour", "minute", "second", "millisecond"];

  Db("Z", ":"), Db("ZZ", ""), Z("Z", _d), Z("ZZ", _d), ba(["Z", "ZZ"], function (a, b, c) {
    c._useUTC = !0, c._tzm = Eb(_d, a);
  });
  var Se = /([\+\-]|\d\d)/gi;

  a.updateOffset = function () {};

  var Te = /^(\-)?(?:(\d*)[. ])?(\d+)\:(\d+)(?:\:(\d+)(\.\d*)?)?$/,
      Ue = /^(-)?P(?:(-?[0-9,.]*)Y)?(?:(-?[0-9,.]*)M)?(?:(-?[0-9,.]*)W)?(?:(-?[0-9,.]*)D)?(?:T(?:(-?[0-9,.]*)H)?(?:(-?[0-9,.]*)M)?(?:(-?[0-9,.]*)S)?)?$/;
  Sb.fn = Ab.prototype, Sb.invalid = zb;
  var Ve = Wb(1, "add"),
      We = Wb(-1, "subtract");
  a.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ", a.defaultFormatUtc = "YYYY-MM-DDTHH:mm:ss[Z]";
  var Xe = x("moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.", function (a) {
    return void 0 === a ? this.localeData() : this.locale(a);
  });
  U(0, ["gg", 2], 0, function () {
    return this.weekYear() % 100;
  }), U(0, ["GG", 2], 0, function () {
    return this.isoWeekYear() % 100;
  }), Dc("gggg", "weekYear"), Dc("ggggg", "weekYear"), Dc("GGGG", "isoWeekYear"), Dc("GGGGG", "isoWeekYear"), J("weekYear", "gg"), J("isoWeekYear", "GG"), M("weekYear", 1), M("isoWeekYear", 1), Z("G", Zd), Z("g", Zd), Z("GG", Sd, Od), Z("gg", Sd, Od), Z("GGGG", Wd, Qd), Z("gggg", Wd, Qd), Z("GGGGG", Xd, Rd), Z("ggggg", Xd, Rd), ca(["gggg", "ggggg", "GGGG", "GGGGG"], function (a, b, c, d) {
    b[d.substr(0, 2)] = u(a);
  }), ca(["gg", "GG"], function (b, c, d, e) {
    c[e] = a.parseTwoDigitYear(b);
  }), U("Q", 0, "Qo", "quarter"), J("quarter", "Q"), M("quarter", 7), Z("Q", Nd), ba("Q", function (a, b) {
    b[fe] = 3 * (u(a) - 1);
  }), U("D", ["DD", 2], "Do", "date"), J("date", "D"), M("date", 9), Z("D", Sd), Z("DD", Sd, Od), Z("Do", function (a, b) {
    return a ? b._dayOfMonthOrdinalParse || b._ordinalParse : b._dayOfMonthOrdinalParseLenient;
  }), ba(["D", "DD"], ge), ba("Do", function (a, b) {
    b[ge] = u(a.match(Sd)[0], 10);
  });
  var Ye = O("Date", !0);
  U("DDD", ["DDDD", 3], "DDDo", "dayOfYear"), J("dayOfYear", "DDD"), M("dayOfYear", 4), Z("DDD", Vd), Z("DDDD", Pd), ba(["DDD", "DDDD"], function (a, b, c) {
    c._dayOfYear = u(a);
  }), U("m", ["mm", 2], 0, "minute"), J("minute", "m"), M("minute", 14), Z("m", Sd), Z("mm", Sd, Od), ba(["m", "mm"], ie);
  var Ze = O("Minutes", !1);
  U("s", ["ss", 2], 0, "second"), J("second", "s"), M("second", 15), Z("s", Sd), Z("ss", Sd, Od), ba(["s", "ss"], je);
  var $e = O("Seconds", !1);
  U("S", 0, 0, function () {
    return ~~(this.millisecond() / 100);
  }), U(0, ["SS", 2], 0, function () {
    return ~~(this.millisecond() / 10);
  }), U(0, ["SSS", 3], 0, "millisecond"), U(0, ["SSSS", 4], 0, function () {
    return 10 * this.millisecond();
  }), U(0, ["SSSSS", 5], 0, function () {
    return 100 * this.millisecond();
  }), U(0, ["SSSSSS", 6], 0, function () {
    return 1e3 * this.millisecond();
  }), U(0, ["SSSSSSS", 7], 0, function () {
    return 1e4 * this.millisecond();
  }), U(0, ["SSSSSSSS", 8], 0, function () {
    return 1e5 * this.millisecond();
  }), U(0, ["SSSSSSSSS", 9], 0, function () {
    return 1e6 * this.millisecond();
  }), J("millisecond", "ms"), M("millisecond", 16), Z("S", Vd, Nd), Z("SS", Vd, Od), Z("SSS", Vd, Pd);

  var _e;

  for (_e = "SSSS"; _e.length <= 9; _e += "S") {
    Z(_e, Yd);
  }

  for (_e = "S"; _e.length <= 9; _e += "S") {
    ba(_e, Mc);
  }

  var af = O("Milliseconds", !1);
  U("z", 0, 0, "zoneAbbr"), U("zz", 0, 0, "zoneName");
  var bf = r.prototype;
  bf.add = Ve, bf.calendar = Zb, bf.clone = $b, bf.diff = fc, bf.endOf = sc, bf.format = kc, bf.from = lc, bf.fromNow = mc, bf.to = nc, bf.toNow = oc, bf.get = R, bf.invalidAt = Bc, bf.isAfter = _b, bf.isBefore = ac, bf.isBetween = bc, bf.isSame = cc, bf.isSameOrAfter = dc, bf.isSameOrBefore = ec, bf.isValid = zc, bf.lang = Xe, bf.locale = pc, bf.localeData = qc, bf.max = Pe, bf.min = Oe, bf.parsingFlags = Ac, bf.set = S, bf.startOf = rc, bf.subtract = We, bf.toArray = wc, bf.toObject = xc, bf.toDate = vc, bf.toISOString = ic, bf.inspect = jc, bf.toJSON = yc, bf.toString = hc, bf.unix = uc, bf.valueOf = tc, bf.creationData = Cc, bf.year = te, bf.isLeapYear = ra, bf.weekYear = Ec, bf.isoWeekYear = Fc, bf.quarter = bf.quarters = Kc, bf.month = ka, bf.daysInMonth = la, bf.week = bf.weeks = Ba, bf.isoWeek = bf.isoWeeks = Ca, bf.weeksInYear = Hc, bf.isoWeeksInYear = Gc, bf.date = Ye, bf.day = bf.days = Ka, bf.weekday = La, bf.isoWeekday = Ma, bf.dayOfYear = Lc, bf.hour = bf.hours = De, bf.minute = bf.minutes = Ze, bf.second = bf.seconds = $e, bf.millisecond = bf.milliseconds = af, bf.utcOffset = Hb, bf.utc = Jb, bf.local = Kb, bf.parseZone = Lb, bf.hasAlignedHourOffset = Mb, bf.isDST = Nb, bf.isLocal = Pb, bf.isUtcOffset = Qb, bf.isUtc = Rb, bf.isUTC = Rb, bf.zoneAbbr = Nc, bf.zoneName = Oc, bf.dates = x("dates accessor is deprecated. Use date instead.", Ye), bf.months = x("months accessor is deprecated. Use month instead", ka), bf.years = x("years accessor is deprecated. Use year instead", te), bf.zone = x("moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/", Ib), bf.isDSTShifted = x("isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information", Ob);
  var cf = C.prototype;
  cf.calendar = D, cf.longDateFormat = E, cf.invalidDate = F, cf.ordinal = G, cf.preparse = Rc, cf.postformat = Rc, cf.relativeTime = H, cf.pastFuture = I, cf.set = A, cf.months = fa, cf.monthsShort = ga, cf.monthsParse = ia, cf.monthsRegex = na, cf.monthsShortRegex = ma, cf.week = ya, cf.firstDayOfYear = Aa, cf.firstDayOfWeek = za, cf.weekdays = Fa, cf.weekdaysMin = Ha, cf.weekdaysShort = Ga, cf.weekdaysParse = Ja, cf.weekdaysRegex = Na, cf.weekdaysShortRegex = Oa, cf.weekdaysMinRegex = Pa, cf.isPM = Va, cf.meridiem = Wa, $a("en", {
    dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/,
    ordinal: function ordinal(a) {
      var b = a % 10,
          c = 1 === u(a % 100 / 10) ? "th" : 1 === b ? "st" : 2 === b ? "nd" : 3 === b ? "rd" : "th";
      return a + c;
    }
  }), a.lang = x("moment.lang is deprecated. Use moment.locale instead.", $a), a.langData = x("moment.langData is deprecated. Use moment.localeData instead.", bb);
  var df = Math.abs,
      ef = id("ms"),
      ff = id("s"),
      gf = id("m"),
      hf = id("h"),
      jf = id("d"),
      kf = id("w"),
      lf = id("M"),
      mf = id("y"),
      nf = kd("milliseconds"),
      of = kd("seconds"),
      pf = kd("minutes"),
      qf = kd("hours"),
      rf = kd("days"),
      sf = kd("months"),
      tf = kd("years"),
      uf = Math.round,
      vf = {
    ss: 44,
    s: 45,
    m: 45,
    h: 22,
    d: 26,
    M: 11
  },
      wf = Math.abs,
      xf = Ab.prototype;
  return xf.isValid = yb, xf.abs = $c, xf.add = ad, xf.subtract = bd, xf.as = gd, xf.asMilliseconds = ef, xf.asSeconds = ff, xf.asMinutes = gf, xf.asHours = hf, xf.asDays = jf, xf.asWeeks = kf, xf.asMonths = lf, xf.asYears = mf, xf.valueOf = hd, xf._bubble = dd, xf.get = jd, xf.milliseconds = nf, xf.seconds = of, xf.minutes = pf, xf.hours = qf, xf.days = rf, xf.weeks = ld, xf.months = sf, xf.years = tf, xf.humanize = qd, xf.toISOString = rd, xf.toString = rd, xf.toJSON = rd, xf.locale = pc, xf.localeData = qc, xf.toIsoString = x("toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)", rd), xf.lang = Xe, U("X", 0, 0, "unix"), U("x", 0, 0, "valueOf"), Z("x", Zd), Z("X", ae), ba("X", function (a, b, c) {
    c._d = new Date(1e3 * parseFloat(a, 10));
  }), ba("x", function (a, b, c) {
    c._d = new Date(u(a));
  }), a.version = "2.18.1", b(tb), a.fn = bf, a.min = vb, a.max = wb, a.now = Qe, a.utc = l, a.unix = Pc, a.months = Vc, a.isDate = h, a.locale = $a, a.invalid = p, a.duration = Sb, a.isMoment = s, a.weekdays = Xc, a.parseZone = Qc, a.localeData = bb, a.isDuration = Bb, a.monthsShort = Wc, a.weekdaysMin = Zc, a.defineLocale = _a, a.updateLocale = ab, a.locales = cb, a.weekdaysShort = Yc, a.normalizeUnits = K, a.relativeTimeRounding = od, a.relativeTimeThreshold = pd, a.calendarFormat = Yb, a.prototype = bf, a;
});
/*///////////////*/

/* FULL CALENDAR */

/*///////////////*/
// FullCalendar v3.4.0
// Docs & License: https://fullcalendar.io/
// (c) 2017 Adam Shaw

!function (t) {
   true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js"), __webpack_require__(/*! moment */ "./node_modules/moment/moment.js")], __WEBPACK_AMD_DEFINE_FACTORY__ = (t),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : 0;
}(function (t, e) {
  var n = t.fullCalendar = {
    version: "3.4.0",
    internalApiVersion: 9
  },
      i = n.views = {};

  t.fn.fullCalendar = function (e) {
    var n = Array.prototype.slice.call(arguments, 1),
        i = this;
    return this.each(function (r, s) {
      var o,
          a = t(s),
          l = a.data("fullCalendar");
      "string" == typeof e ? l && t.isFunction(l[e]) && (o = l[e].apply(l, n), r || (i = o), "destroy" === e && a.removeData("fullCalendar")) : l || (l = new ne(a, e), a.data("fullCalendar", l), l.render());
    }), i;
  };

  var r = ["header", "footer", "buttonText", "buttonIcons", "themeButtonIcons"];

  function s(t) {
    return $(t, r);
  }

  function o(t, e) {
    e.left && t.css({
      "border-left-width": 1,
      "margin-left": e.left - 1
    }), e.right && t.css({
      "border-right-width": 1,
      "margin-right": e.right - 1
    });
  }

  function a(t) {
    t.css({
      "margin-left": "",
      "margin-right": "",
      "border-left-width": "",
      "border-right-width": ""
    });
  }

  function l() {
    t("body").addClass("fc-not-allowed");
  }

  function u() {
    t("body").removeClass("fc-not-allowed");
  }

  function h(e, n, i) {
    var r = Math.floor(n / e.length),
        s = Math.floor(n - r * (e.length - 1)),
        o = [],
        a = [],
        l = [],
        u = 0;
    c(e), e.each(function (n, i) {
      var h = n === e.length - 1 ? s : r,
          c = t(i).outerHeight(!0);
      c < h ? (o.push(i), a.push(c), l.push(t(i).height())) : u += c;
    }), i && (n -= u, r = Math.floor(n / o.length), s = Math.floor(n - r * (o.length - 1))), t(o).each(function (e, n) {
      var i = e === o.length - 1 ? s : r,
          u = a[e],
          h = i - (u - l[e]);
      u < i && t(n).height(h);
    });
  }

  function c(t) {
    t.height("");
  }

  function d(e) {
    var n = 0;
    return e.find("> *").each(function (e, i) {
      var r = t(i).outerWidth();
      r > n && (n = r);
    }), n++, e.width(n), n;
  }

  function f(t, e) {
    var n,
        i = t.add(e);
    return i.css({
      position: "relative",
      left: -1
    }), n = t.outerHeight() - e.outerHeight(), i.css({
      position: "",
      left: ""
    }), n;
  }

  function g(e) {
    var n = e.css("position"),
        i = e.parents().filter(function () {
      var e = t(this);
      return /(auto|scroll)/.test(e.css("overflow") + e.css("overflow-y") + e.css("overflow-x"));
    }).eq(0);
    return "fixed" !== n && i.length ? i : t(e[0].ownerDocument || document);
  }

  function p(t, e) {
    var n = t.offset(),
        i = n.left - (e ? e.left : 0),
        r = n.top - (e ? e.top : 0);
    return {
      left: i,
      right: i + t.outerWidth(),
      top: r,
      bottom: r + t.outerHeight()
    };
  }

  function v(t, e) {
    var n = t.offset(),
        i = m(t),
        r = n.left + S(t, "border-left-width") + i.left - (e ? e.left : 0),
        s = n.top + S(t, "border-top-width") + i.top - (e ? e.top : 0);
    return {
      left: r,
      right: r + t[0].clientWidth,
      top: s,
      bottom: s + t[0].clientHeight
    };
  }

  function m(e) {
    var n,
        i = e[0].offsetWidth - e[0].clientWidth,
        r = e[0].offsetHeight - e[0].clientHeight;
    return i = y(i), n = {
      left: 0,
      right: 0,
      top: 0,
      bottom: r = y(r)
    }, !function () {
      null === w && (e = t("<div><div/></div>").css({
        position: "absolute",
        top: -1e3,
        left: 0,
        border: 0,
        padding: 0,
        overflow: "scroll",
        direction: "rtl"
      }).appendTo("body"), n = e.children().offset().left > e.offset().left, e.remove(), w = n);
      var e, n;
      return w;
    }() || "rtl" != e.css("direction") ? n.right = i : n.left = i, n;
  }

  function y(t) {
    return t = Math.max(0, t), t = Math.round(t);
  }

  n.intersectRanges = B, n.applyAll = J, n.debounce = lt, n.isInt = ot, n.htmlEscape = et, n.cssToStr = it, n.proxy = at, n.capitaliseFirstLetter = rt, n.getOuterRect = p, n.getClientRect = v, n.getContentRect = function (t, e) {
    var n = t.offset(),
        i = n.left + S(t, "border-left-width") + S(t, "padding-left") - (e ? e.left : 0),
        r = n.top + S(t, "border-top-width") + S(t, "padding-top") - (e ? e.top : 0);
    return {
      left: i,
      right: i + t.width(),
      top: r,
      bottom: r + t.height()
    };
  }, n.getScrollbarWidths = m;
  var w = null;

  function S(t, e) {
    return parseFloat(t.css(e)) || 0;
  }

  function b(t) {
    return 1 == t.which && !t.ctrlKey;
  }

  function E(t) {
    var e = t.originalEvent.touches;
    return e && e.length ? e[0].pageX : t.pageX;
  }

  function D(t) {
    var e = t.originalEvent.touches;
    return e && e.length ? e[0].pageY : t.pageY;
  }

  function T(t) {
    return /^touch/.test(t.type);
  }

  function C(t) {
    t.addClass("fc-unselectable").on("selectstart", H);
  }

  function H(t) {
    t.preventDefault();
  }

  function R(t, e) {
    var n = {
      left: Math.max(t.left, e.left),
      right: Math.min(t.right, e.right),
      top: Math.max(t.top, e.top),
      bottom: Math.min(t.bottom, e.bottom)
    };
    return n.left < n.right && n.top < n.bottom && n;
  }

  function x(e) {
    var n,
        i,
        r = [],
        s = [];

    for ("string" == typeof e ? s = e.split(/\s*,\s*/) : "function" == typeof e ? s = [e] : t.isArray(e) && (s = e), n = 0; n < s.length; n++) {
      "string" == typeof (i = s[n]) ? r.push("-" == i.charAt(0) ? {
        field: i.substring(1),
        order: -1
      } : {
        field: i,
        order: 1
      }) : "function" == typeof i && r.push({
        func: i
      });
    }

    return r;
  }

  function I(t, e, n) {
    var i, r;

    for (i = 0; i < n.length; i++) {
      if (r = k(t, e, n[i])) return r;
    }

    return 0;
  }

  function k(t, e, n) {
    return n.func ? n.func(t, e) : M(t[n.field], e[n.field]) * (n.order || 1);
  }

  function M(e, n) {
    return e || n ? null == n ? -1 : null == e ? 1 : "string" === t.type(e) || "string" === t.type(n) ? String(e).localeCompare(String(n)) : e - n : 0;
  }

  function B(t, e) {
    var n,
        i,
        r,
        s,
        o = t.start,
        a = t.end,
        l = e.start,
        u = e.end;
    if (a > l && o < u) return o >= l ? (n = o.clone(), r = !0) : (n = l.clone(), r = !1), a <= u ? (i = a.clone(), s = !0) : (i = u.clone(), s = !1), {
      start: n,
      end: i,
      isStart: r,
      isEnd: s
    };
  }

  n.preventDefault = H, n.intersectRects = R, n.parseFieldSpecs = x, n.compareByFieldSpecs = I, n.compareByFieldSpec = k, n.flexibleCompare = M, n.computeGreatestUnit = A, n.divideRangeByDuration = function (t, e, n) {
    var i;
    if (U(n)) return (e - t) / n;
    if (i = n.asMonths(), Math.abs(i) >= 1 && ot(i)) return e.diff(t, "months", !0) / i;
    return e.diff(t, "days", !0) / n.asDays();
  }, n.divideDurationByDuration = O, n.multiplyDuration = function (t, n) {
    var i;
    if (U(t)) return e.duration(t * n);
    if (i = t.asMonths(), Math.abs(i) >= 1 && ot(i)) return e.duration({
      months: i * n
    });
    return e.duration({
      days: t.asDays() * n
    });
  }, n.durationHasTime = U;
  var L = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"],
      N = ["year", "month", "week", "day", "hour", "minute", "second", "millisecond"];

  function z(t, n) {
    return e.duration({
      days: t.clone().stripTime().diff(n.clone().stripTime(), "days"),
      ms: t.time() - n.time()
    });
  }

  function F(t, n, i) {
    return e.duration(Math.round(t.diff(n, i, !0)), i);
  }

  function A(t, e) {
    var n, i, r;

    for (n = 0; n < N.length && !((r = V(i = N[n], t, e)) >= 1 && ot(r)); n++) {
      ;
    }

    return i;
  }

  function G(t, e) {
    var n = A(t);
    return "week" === n && "object" == _typeof(e) && e.days && (n = "day"), n;
  }

  function V(t, n, i) {
    return null != i ? i.diff(n, t, !0) : e.isDuration(n) ? n.as(t) : n.end.diff(n.start, t, !0);
  }

  function O(t, e) {
    var n, i;
    return U(t) || U(e) ? t / e : (n = t.asMonths(), i = e.asMonths(), Math.abs(n) >= 1 && ot(n) && Math.abs(i) >= 1 && ot(i) ? n / i : t.asDays() / e.asDays());
  }

  function P(t) {
    return {
      start: t.start.clone(),
      end: t.end.clone()
    };
  }

  function _(t, e) {
    var n, i;
    return t = P(t), e.start && (t.start = W(t.start, e)), e.end && (t.end = (n = t.end, i = e.end, (n.isBefore(i) ? n : i).clone())), t;
  }

  function W(t, e) {
    var n, i;
    return t = t.clone(), e.start && (n = t, i = e.start, t = (n.isAfter(i) ? n : i).clone()), e.end && t >= e.end && (t = e.end.clone().subtract(1)), t;
  }

  function Y(t, e) {
    return (!e.start || t >= e.start) && (!e.end || t < e.end);
  }

  function q(t, e) {
    return (!e.start || t.start >= e.start) && (!e.end || t.end <= e.end);
  }

  function U(t) {
    return Boolean(t.hours() || t.minutes() || t.seconds() || t.milliseconds());
  }

  function j(t) {
    return /^\d+\:\d+(?:\:\d+\.?(?:\d{3})?)?$/.test(t);
  }

  n.log = function () {
    var t = window.console;
    if (t && t.log) return t.log.apply(t, arguments);
  }, n.warn = function () {
    var t = window.console;
    return t && t.warn ? t.warn.apply(t, arguments) : n.log.apply(n, arguments);
  };
  var Z = {}.hasOwnProperty;

  function $(t, e) {
    var n,
        i,
        r,
        s,
        o,
        a,
        l = {};
    if (e) for (n = 0; n < e.length; n++) {
      for (i = e[n], r = [], s = t.length - 1; s >= 0; s--) {
        if ("object" == _typeof(o = t[s][i])) r.unshift(o);else if (void 0 !== o) {
          l[i] = o;
          break;
        }
      }

      r.length && (l[i] = $(r));
    }

    for (n = t.length - 1; n >= 0; n--) {
      for (i in a = t[n]) {
        i in l || (l[i] = a[i]);
      }
    }

    return l;
  }

  function Q(t) {
    var e = function e() {};

    return e.prototype = t, new e();
  }

  function X(t, e) {
    for (var n in t) {
      K(t, n) && (e[n] = t[n]);
    }
  }

  function K(t, e) {
    return Z.call(t, e);
  }

  function J(e, n, i) {
    if (t.isFunction(e) && (e = [e]), e) {
      var r, s;

      for (r = 0; r < e.length; r++) {
        s = e[r].apply(n, i) || s;
      }

      return s;
    }
  }

  function tt() {
    for (var t = 0; t < arguments.length; t++) {
      if (void 0 !== arguments[t]) return arguments[t];
    }
  }

  function et(t) {
    return (t + "").replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, "&#039;").replace(/"/g, "&quot;").replace(/\n/g, "<br />");
  }

  function nt(t) {
    return t.replace(/&.*?;/g, "");
  }

  function it(e) {
    var n = [];
    return t.each(e, function (t, e) {
      null != e && n.push(t + ":" + e);
    }), n.join(";");
  }

  function rt(t) {
    return t.charAt(0).toUpperCase() + t.slice(1);
  }

  function st(t, e) {
    return t - e;
  }

  function ot(t) {
    return t % 1 == 0;
  }

  function at(t, e) {
    var n = t[e];
    return function () {
      return n.apply(t, arguments);
    };
  }

  function lt(t, e, n) {
    var i,
        r,
        s,
        o,
        a,
        l = function l() {
      var u = +new Date() - o;
      u < e ? i = setTimeout(l, e - u) : (i = null, n || (a = t.apply(s, r), s = r = null));
    };

    return function () {
      s = this, r = arguments, o = +new Date();
      var u = n && !i;
      return i || (i = setTimeout(l, e)), u && (a = t.apply(s, r), s = r = null), a;
    };
  }

  n.createObject = Q;
  var ut = /^\s*\d{4}-\d\d$/,
      ht = /^\s*\d{4}-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?)?$/,
      ct = e.fn,
      dt = t.extend({}, ct),
      ft = e.momentProperties;

  function gt(n, i, r) {
    var s,
        o,
        a,
        l,
        u = n[0],
        h = 1 == n.length && "string" == typeof u;
    return e.isMoment(u) || function (t) {
      return "[object Date]" === Object.prototype.toString.call(t) || t instanceof Date;
    }(u) || void 0 === u ? l = e.apply(null, n) : (s = !1, o = !1, h ? ut.test(u) ? (n = [u += "-01"], s = !0, o = !0) : (a = ht.exec(u)) && (s = !a[5], o = !0) : t.isArray(u) && (o = !0), l = i || s ? e.utc.apply(e, n) : e.apply(null, n), s ? (l._ambigTime = !0, l._ambigZone = !0) : r && (o ? l._ambigZone = !0 : h && l.utcOffset(u))), l._fullCalendar = !0, l;
  }

  function pt(t) {
    return "en" !== t.locale() ? t.clone().locale("en") : t;
  }

  ft.push("_fullCalendar"), ft.push("_ambigTime"), ft.push("_ambigZone"), n.moment = function () {
    return gt(arguments);
  }, n.moment.utc = function () {
    var t = gt(arguments, !0);
    return t.hasTime() && t.utc(), t;
  }, n.moment.parseZone = function () {
    return gt(arguments, !0, !0);
  }, ct.week = ct.weeks = function (t) {
    var e = this._locale._fullCalendar_weekCalc;
    return null == t && "function" == typeof e ? e(this) : "ISO" === e ? dt.isoWeek.apply(this, arguments) : dt.week.apply(this, arguments);
  }, ct.time = function (t) {
    if (!this._fullCalendar) return dt.time.apply(this, arguments);
    if (null == t) return e.duration({
      hours: this.hours(),
      minutes: this.minutes(),
      seconds: this.seconds(),
      milliseconds: this.milliseconds()
    });
    this._ambigTime = !1, e.isDuration(t) || e.isMoment(t) || (t = e.duration(t));
    var n = 0;
    return e.isDuration(t) && (n = 24 * Math.floor(t.asDays())), this.hours(n + t.hours()).minutes(t.minutes()).seconds(t.seconds()).milliseconds(t.milliseconds());
  }, ct.stripTime = function () {
    return this._ambigTime || (this.utc(!0), this.set({
      hours: 0,
      minutes: 0,
      seconds: 0,
      ms: 0
    }), this._ambigTime = !0, this._ambigZone = !0), this;
  }, ct.hasTime = function () {
    return !this._ambigTime;
  }, ct.stripZone = function () {
    var t;
    return this._ambigZone || (t = this._ambigTime, this.utc(!0), this._ambigTime = t || !1, this._ambigZone = !0), this;
  }, ct.hasZone = function () {
    return !this._ambigZone;
  }, ct.local = function (t) {
    return dt.local.call(this, this._ambigZone || t), this._ambigTime = !1, this._ambigZone = !1, this;
  }, ct.utc = function (t) {
    return dt.utc.call(this, t), this._ambigTime = !1, this._ambigZone = !1, this;
  }, ct.utcOffset = function (t) {
    return null != t && (this._ambigTime = !1, this._ambigZone = !1), dt.utcOffset.apply(this, arguments);
  }, ct.format = function () {
    return this._fullCalendar && arguments[0] ? vt(this, arguments[0]) : this._ambigTime ? yt(pt(this), "YYYY-MM-DD") : this._ambigZone ? yt(pt(this), "YYYY-MM-DD[T]HH:mm:ss") : this._fullCalendar ? yt(pt(this)) : dt.format.apply(this, arguments);
  }, ct.toISOString = function () {
    return this._ambigTime ? yt(pt(this), "YYYY-MM-DD") : this._ambigZone ? yt(pt(this), "YYYY-MM-DD[T]HH:mm:ss") : this._fullCalendar ? dt.toISOString.apply(pt(this), arguments) : dt.toISOString.apply(this, arguments);
  }, function () {
    n.formatDate = function (t, e) {
      return function (t, e) {
        return p(g(t, e).join(""));
      }(u(e).fakeFormatString, t);
    }, n.formatRange = function (t, e, i, r, s) {
      var o;
      return t = n.moment.parseZone(t), e = n.moment.parseZone(e), o = t.localeData(), function (t, e, n, i, r) {
        var s,
            o,
            a,
            l = t.sameUnits,
            u = e.clone().stripZone(),
            h = n.clone().stripZone(),
            c = g(t.fakeFormatString, e),
            d = g(t.fakeFormatString, n),
            f = "",
            v = "",
            m = "",
            y = "",
            w = "";

        for (s = 0; s < l.length && (!l[s] || u.isSame(h, l[s])); s++) {
          f += c[s];
        }

        for (o = l.length - 1; o > s && (!l[o] || u.isSame(h, l[o])) && (o - 1 !== s || "." !== c[o]); o--) {
          v = c[o] + v;
        }

        for (a = s; a <= o; a++) {
          m += c[a], y += d[a];
        }

        return (m || y) && (w = r ? y + i + m : m + i + y), p(f + w + v);
      }(u(i = o.longDateFormat(i) || i), t, e, r || " - ", s);
    }, n.oldMomentFormat = a, n.queryMostGranularFormatUnit = function (t) {
      var e,
          n,
          i,
          r,
          s = h(t);

      for (e = 0; e < s.length; e++) {
        (n = s[e]).token && (i = o[n.token.charAt(0)]) && (!r || i.value > r.value) && (r = i);
      }

      if (r) return r.unit;
      return null;
    };
    var t = "\v",
        e = "",
        i = "",
        r = new RegExp(i + "([^" + i + "]*)" + i, "g"),
        s = {
      t: function t(_t2) {
        return a(_t2, "a").charAt(0);
      },
      T: function T(t) {
        return a(t, "A").charAt(0);
      }
    },
        o = {
      Y: {
        value: 1,
        unit: "year"
      },
      M: {
        value: 2,
        unit: "month"
      },
      W: {
        value: 3,
        unit: "week"
      },
      w: {
        value: 3,
        unit: "week"
      },
      D: {
        value: 4,
        unit: "day"
      },
      d: {
        value: 4,
        unit: "day"
      }
    };

    function a(t, e) {
      return dt.format.call(t, e);
    }

    var l = {};

    function u(t) {
      return l[t] || (l[t] = function (t) {
        var e = h(t);
        return {
          fakeFormatString: d(e),
          sameUnits: f(e)
        };
      }(t));
    }

    function h(t) {
      for (var e, n = [], i = /\[([^\]]*)\]|\(([^\)]*)\)|(LTS|LT|(\w)\4*o?)|([^\w\[\(]+)/g; e = i.exec(t);) {
        e[1] ? n.push.apply(n, c(e[1])) : e[2] ? n.push({
          maybe: h(e[2])
        }) : e[3] ? n.push({
          token: e[3]
        }) : e[5] && n.push.apply(n, c(e[5]));
      }

      return n;
    }

    function c(t) {
      return ". " === t ? [".", " "] : [t];
    }

    function d(n) {
      var r,
          o,
          a = [];

      for (r = 0; r < n.length; r++) {
        "string" == typeof (o = n[r]) ? a.push("[" + o + "]") : o.token ? o.token in s ? a.push(e + "[" + o.token + "]") : a.push(o.token) : o.maybe && a.push(i + d(o.maybe) + i);
      }

      return a.join(t);
    }

    function f(t) {
      var e,
          n,
          i,
          r = [];

      for (e = 0; e < t.length; e++) {
        (n = t[e]).token ? (i = o[n.token.charAt(0)], r.push(i ? i.unit : "second")) : n.maybe ? r.push.apply(r, f(n.maybe)) : r.push(null);
      }

      return r;
    }

    function g(n, i) {
      var r,
          o,
          l = [],
          u = a(i, n).split(t);

      for (r = 0; r < u.length; r++) {
        (o = u[r]).charAt(0) === e ? l.push(s[o.substring(1)](i)) : l.push(o);
      }

      return l;
    }

    function p(t) {
      return t.replace(r, function (t, e) {
        return e.match(/[1-9]/) ? e : "";
      });
    }
  }();
  var vt = n.formatDate,
      mt = n.formatRange,
      yt = n.oldMomentFormat;

  function wt() {}

  function St(t, e) {
    X(e, t.prototype);
  }

  n.Class = wt, wt.extend = function () {
    var t,
        e,
        n = arguments.length;

    for (t = 0; t < n; t++) {
      e = arguments[t], t < n - 1 && St(this, e);
    }

    return function (t, e) {
      var n;
      K(e, "constructor") && (n = e.constructor);
      "function" != typeof n && (n = e.constructor = function () {
        t.apply(this, arguments);
      });
      return n.prototype = Q(t.prototype), X(e, n.prototype), X(t, n), n;
    }(this, e || {});
  }, wt.mixin = function (t) {
    St(this, t);
  };
  var bt = wt.extend(xt, It, {
    _props: null,
    _watchers: null,
    _globalWatchArgs: null,
    constructor: function constructor() {
      this._watchers = {}, this._props = {}, this.applyGlobalWatchers();
    },
    applyGlobalWatchers: function applyGlobalWatchers() {
      var t,
          e = this._globalWatchArgs || [];

      for (t = 0; t < e.length; t++) {
        this.watch.apply(this, e[t]);
      }
    },
    has: function has(t) {
      return t in this._props;
    },
    get: function get(t) {
      return void 0 === t ? this._props : this._props[t];
    },
    set: function set(t, e) {
      var n;
      "string" == typeof t ? (n = {})[t] = void 0 === e ? null : e : n = t, this.setProps(n);
    },
    reset: function reset(t) {
      var e,
          n = this._props,
          i = {};

      for (e in n) {
        i[e] = void 0;
      }

      for (e in t) {
        i[e] = t[e];
      }

      this.setProps(i);
    },
    unset: function unset(t) {
      var e,
          n,
          i = {};

      for (e = "string" == typeof t ? [t] : t, n = 0; n < e.length; n++) {
        i[e[n]] = void 0;
      }

      this.setProps(i);
    },
    setProps: function setProps(t) {
      var e,
          n,
          i = {},
          r = 0;

      for (e in t) {
        "object" != _typeof(n = t[e]) && n === this._props[e] || (i[e] = n, r++);
      }

      if (r) {
        for (e in this.trigger("before:batchChange", i), i) {
          n = i[e], this.trigger("before:change", e, n), this.trigger("before:change:" + e, n);
        }

        for (e in i) {
          void 0 === (n = i[e]) ? delete this._props[e] : this._props[e] = n, this.trigger("change:" + e, n), this.trigger("change", e, n);
        }

        this.trigger("batchChange", i);
      }
    },
    watch: function watch(t, e, n, i) {
      var r = this;
      this.unwatch(t), this._watchers[t] = this._watchDeps(e, function (e) {
        var i = n.call(r, e);
        i && i.then ? (r.unset(t), i.then(function (e) {
          r.set(t, e);
        })) : r.set(t, i);
      }, function () {
        r.unset(t), i && i.call(r);
      });
    },
    unwatch: function unwatch(t) {
      var e = this._watchers[t];
      e && (delete this._watchers[t], e.teardown());
    },
    _watchDeps: function _watchDeps(t, e, n) {
      var i = this,
          r = 0,
          s = t.length,
          o = 0,
          a = {},
          l = [],
          u = !1;

      function h(t, e) {
        i.on(t, e), l.push([t, e]);
      }

      return t.forEach(function (t) {
        var i = !1;
        "?" === t.charAt(0) && (t = t.substring(1), i = !0), h("before:change:" + t, function (t) {
          1 == ++r && o === s && (u = !0, n(), u = !1);
        }), h("change:" + t, function (n) {
          !function (t, n, i) {
            void 0 === n ? (i || void 0 === a[t] || o--, delete a[t]) : (i || void 0 !== a[t] || o++, a[t] = n), --r || o === s && (u || e(a));
          }(t, n, i);
        });
      }), t.forEach(function (t) {
        var e = !1;
        "?" === t.charAt(0) && (t = t.substring(1), e = !0), i.has(t) ? (a[t] = i.get(t), o++) : e && o++;
      }), o === s && e(a), {
        teardown: function teardown() {
          for (var t = 0; t < l.length; t++) {
            i.off(l[t][0], l[t][1]);
          }

          l = null, o === s && n();
        },
        flash: function flash() {
          o === s && (n(), e(a));
        }
      };
    },
    flash: function flash(t) {
      var e = this._watchers[t];
      e && e.flash();
    }
  });
  bt.watch = function () {
    var t = this.prototype;
    t._globalWatchArgs || (t._globalWatchArgs = []), t._globalWatchArgs.push(arguments);
  }, n.Model = bt;
  var Et = {
    construct: function construct(e) {
      var n = t.Deferred(),
          i = n.promise();
      return "function" == typeof e && e(function (t) {
        n.resolve(t), Dt(i, t);
      }, function () {
        n.reject(), Tt(i);
      }), i;
    },
    resolve: function resolve(e) {
      var n = t.Deferred().resolve(e).promise();
      return Dt(n, e), n;
    },
    reject: function reject() {
      var e = t.Deferred().reject().promise();
      return Tt(e), e;
    }
  };

  function Dt(t, e) {
    t.then = function (n) {
      return "function" == typeof n && n(e), t;
    };
  }

  function Tt(t) {
    t.then = function (e, n) {
      return "function" == typeof n && n(), t;
    };
  }

  n.Promise = Et;
  var Ct = wt.extend(xt, {
    q: null,
    isPaused: !1,
    isRunning: !1,
    constructor: function constructor() {
      this.q = [];
    },
    queue: function queue() {
      this.q.push.apply(this.q, arguments), this.tryStart();
    },
    pause: function pause() {
      this.isPaused = !0;
    },
    resume: function resume() {
      this.isPaused = !1, this.tryStart();
    },
    tryStart: function tryStart() {
      !this.isRunning && this.canRunNext() && (this.isRunning = !0, this.trigger("start"), this.runNext());
    },
    canRunNext: function canRunNext() {
      return !this.isPaused && this.q.length;
    },
    runNext: function runNext() {
      this.runTask(this.q.shift());
    },
    runTask: function runTask(t) {
      this.runTaskFunc(t);
    },
    runTaskFunc: function runTaskFunc(t) {
      var e = this,
          n = t();

      function i() {
        e.canRunNext() ? e.runNext() : (e.isRunning = !1, e.trigger("stop"));
      }

      n && n.then ? n.then(i) : i();
    }
  });
  n.TaskQueue = Ct;
  var Ht = Ct.extend({
    waitsByNamespace: null,
    waitNamespace: null,
    waitId: null,
    constructor: function constructor(t) {
      Ct.call(this), this.waitsByNamespace = t || {};
    },
    queue: function queue(t, e, n) {
      var i,
          r = {
        func: t,
        namespace: e,
        type: n
      };
      e && (i = this.waitsByNamespace[e]), this.waitNamespace && (e === this.waitNamespace && null != i ? this.delayWait(i) : (this.clearWait(), this.tryStart())), this.compoundTask(r) && (this.waitNamespace || null == i ? this.tryStart() : this.startWait(e, i));
    },
    startWait: function startWait(t, e) {
      this.waitNamespace = t, this.spawnWait(e);
    },
    delayWait: function delayWait(t) {
      clearTimeout(this.waitId), this.spawnWait(t);
    },
    spawnWait: function spawnWait(t) {
      var e = this;
      this.waitId = setTimeout(function () {
        e.waitNamespace = null, e.tryStart();
      }, t);
    },
    clearWait: function clearWait() {
      this.waitNamespace && (clearTimeout(this.waitId), this.waitId = null, this.waitNamespace = null);
    },
    canRunNext: function canRunNext() {
      if (!Ct.prototype.canRunNext.apply(this, arguments)) return !1;

      if (this.waitNamespace) {
        for (var t = this.q, e = 0; e < t.length; e++) {
          if (t[e].namespace !== this.waitNamespace) return !0;
        }

        return !1;
      }

      return !0;
    },
    runTask: function runTask(t) {
      this.runTaskFunc(t.func);
    },
    compoundTask: function compoundTask(t) {
      var e,
          n,
          i = this.q,
          r = !0;

      if (t.namespace && ("destroy" === t.type || "init" === t.type)) {
        for (e = i.length - 1; e >= 0; e--) {
          (n = i[e]).namespace !== t.namespace || "add" !== n.type && "remove" !== n.type || i.splice(e, 1);
        }

        "destroy" === t.type ? i.length && (n = i[i.length - 1]).namespace === t.namespace && ("init" === n.type ? (r = !1, i.pop()) : "destroy" === n.type && (r = !1)) : "init" === t.type && i.length && (n = i[i.length - 1]).namespace === t.namespace && "init" === n.type && i.pop();
      }

      return r && i.push(t), r;
    }
  });
  n.RenderQueue = Ht;
  var Rt,
      xt = n.EmitterMixin = {
    on: function on(e, n) {
      return t(this).on(e, this._prepareIntercept(n)), this;
    },
    one: function one(e, n) {
      return t(this).one(e, this._prepareIntercept(n)), this;
    },
    _prepareIntercept: function _prepareIntercept(e) {
      var n = function n(t, _n) {
        return e.apply(_n.context || this, _n.args || []);
      };

      return e.guid || (e.guid = t.guid++), n.guid = e.guid, n;
    },
    off: function off(e, n) {
      return t(this).off(e, n), this;
    },
    trigger: function trigger(e) {
      var n = Array.prototype.slice.call(arguments, 1);
      return t(this).triggerHandler(e, {
        args: n
      }), this;
    },
    triggerWith: function triggerWith(e, n, i) {
      return t(this).triggerHandler(e, {
        context: n,
        args: i
      }), this;
    }
  },
      It = n.ListenerMixin = (Rt = 0, {
    listenerId: null,
    listenTo: function listenTo(e, n, i) {
      if ("object" == _typeof(n)) for (var r in n) {
        n.hasOwnProperty(r) && this.listenTo(e, r, n[r]);
      } else "string" == typeof n && e.on(n + "." + this.getListenerNamespace(), t.proxy(i, this));
    },
    stopListeningTo: function stopListeningTo(t, e) {
      t.off((e || "") + "." + this.getListenerNamespace());
    },
    getListenerNamespace: function getListenerNamespace() {
      return null == this.listenerId && (this.listenerId = Rt++), "_listener" + this.listenerId;
    }
  }),
      kt = wt.extend(It, {
    isHidden: !0,
    options: null,
    el: null,
    margin: 10,
    constructor: function constructor(t) {
      this.options = t || {};
    },
    show: function show() {
      this.isHidden && (this.el || this.render(), this.el.show(), this.position(), this.isHidden = !1, this.trigger("show"));
    },
    hide: function hide() {
      this.isHidden || (this.el.hide(), this.isHidden = !0, this.trigger("hide"));
    },
    render: function render() {
      var e = this,
          n = this.options;
      this.el = t('<div class="fc-popover"/>').addClass(n.className || "").css({
        top: 0,
        left: 0
      }).append(n.content).appendTo(n.parentEl), this.el.on("click", ".fc-close", function () {
        e.hide();
      }), n.autoHide && this.listenTo(t(document), "mousedown", this.documentMousedown);
    },
    documentMousedown: function documentMousedown(e) {
      this.el && !t(e.target).closest(this.el).length && this.hide();
    },
    removeElement: function removeElement() {
      this.hide(), this.el && (this.el.remove(), this.el = null), this.stopListeningTo(t(document), "mousedown");
    },
    position: function position() {
      var e,
          n,
          i,
          r,
          s,
          o = this.options,
          a = this.el.offsetParent().offset(),
          l = this.el.outerWidth(),
          u = this.el.outerHeight(),
          h = t(window),
          c = g(this.el);
      r = o.top || 0, s = void 0 !== o.left ? o.left : void 0 !== o.right ? o.right - l : 0, c.is(window) || c.is(document) ? (c = h, e = 0, n = 0) : (e = (i = c.offset()).top, n = i.left), e += h.scrollTop(), n += h.scrollLeft(), !1 !== o.viewportConstrain && (r = Math.min(r, e + c.outerHeight() - u - this.margin), r = Math.max(r, e + this.margin), s = Math.min(s, n + c.outerWidth() - l - this.margin), s = Math.max(s, n + this.margin)), this.el.css({
        top: r - a.top,
        left: s - a.left
      });
    },
    trigger: function trigger(t) {
      this.options[t] && this.options[t].apply(this, Array.prototype.slice.call(arguments, 1));
    }
  }),
      Mt = n.CoordCache = wt.extend({
    els: null,
    forcedOffsetParentEl: null,
    origin: null,
    boundingRect: null,
    isHorizontal: !1,
    isVertical: !1,
    lefts: null,
    rights: null,
    tops: null,
    bottoms: null,
    constructor: function constructor(e) {
      this.els = t(e.els), this.isHorizontal = e.isHorizontal, this.isVertical = e.isVertical, this.forcedOffsetParentEl = e.offsetParent ? t(e.offsetParent) : null;
    },
    build: function build() {
      var t = this.forcedOffsetParentEl;
      !t && this.els.length > 0 && (t = this.els.eq(0).offsetParent()), this.origin = t ? t.offset() : null, this.boundingRect = this.queryBoundingRect(), this.isHorizontal && this.buildElHorizontals(), this.isVertical && this.buildElVerticals();
    },
    clear: function clear() {
      this.origin = null, this.boundingRect = null, this.lefts = null, this.rights = null, this.tops = null, this.bottoms = null;
    },
    ensureBuilt: function ensureBuilt() {
      this.origin || this.build();
    },
    buildElHorizontals: function buildElHorizontals() {
      var e = [],
          n = [];
      this.els.each(function (i, r) {
        var s = t(r),
            o = s.offset().left,
            a = s.outerWidth();
        e.push(o), n.push(o + a);
      }), this.lefts = e, this.rights = n;
    },
    buildElVerticals: function buildElVerticals() {
      var e = [],
          n = [];
      this.els.each(function (i, r) {
        var s = t(r),
            o = s.offset().top,
            a = s.outerHeight();
        e.push(o), n.push(o + a);
      }), this.tops = e, this.bottoms = n;
    },
    getHorizontalIndex: function getHorizontalIndex(t) {
      this.ensureBuilt();
      var e,
          n = this.lefts,
          i = this.rights,
          r = n.length;

      for (e = 0; e < r; e++) {
        if (t >= n[e] && t < i[e]) return e;
      }
    },
    getVerticalIndex: function getVerticalIndex(t) {
      this.ensureBuilt();
      var e,
          n = this.tops,
          i = this.bottoms,
          r = n.length;

      for (e = 0; e < r; e++) {
        if (t >= n[e] && t < i[e]) return e;
      }
    },
    getLeftOffset: function getLeftOffset(t) {
      return this.ensureBuilt(), this.lefts[t];
    },
    getLeftPosition: function getLeftPosition(t) {
      return this.ensureBuilt(), this.lefts[t] - this.origin.left;
    },
    getRightOffset: function getRightOffset(t) {
      return this.ensureBuilt(), this.rights[t];
    },
    getRightPosition: function getRightPosition(t) {
      return this.ensureBuilt(), this.rights[t] - this.origin.left;
    },
    getWidth: function getWidth(t) {
      return this.ensureBuilt(), this.rights[t] - this.lefts[t];
    },
    getTopOffset: function getTopOffset(t) {
      return this.ensureBuilt(), this.tops[t];
    },
    getTopPosition: function getTopPosition(t) {
      return this.ensureBuilt(), this.tops[t] - this.origin.top;
    },
    getBottomOffset: function getBottomOffset(t) {
      return this.ensureBuilt(), this.bottoms[t];
    },
    getBottomPosition: function getBottomPosition(t) {
      return this.ensureBuilt(), this.bottoms[t] - this.origin.top;
    },
    getHeight: function getHeight(t) {
      return this.ensureBuilt(), this.bottoms[t] - this.tops[t];
    },
    queryBoundingRect: function queryBoundingRect() {
      var t;
      return this.els.length > 0 && !(t = g(this.els.eq(0))).is(document) ? v(t) : null;
    },
    isPointInBounds: function isPointInBounds(t, e) {
      return this.isLeftInBounds(t) && this.isTopInBounds(e);
    },
    isLeftInBounds: function isLeftInBounds(t) {
      return !this.boundingRect || t >= this.boundingRect.left && t < this.boundingRect.right;
    },
    isTopInBounds: function isTopInBounds(t) {
      return !this.boundingRect || t >= this.boundingRect.top && t < this.boundingRect.bottom;
    }
  }),
      Bt = n.DragListener = wt.extend(It, {
    options: null,
    subjectEl: null,
    originX: null,
    originY: null,
    scrollEl: null,
    isInteracting: !1,
    isDistanceSurpassed: !1,
    isDelayEnded: !1,
    isDragging: !1,
    isTouch: !1,
    isGeneric: !1,
    delay: null,
    delayTimeoutId: null,
    minDistance: null,
    shouldCancelTouchScroll: !0,
    scrollAlwaysKills: !1,
    constructor: function constructor(t) {
      this.options = t || {};
    },
    startInteraction: function startInteraction(e, n) {
      if ("mousedown" === e.type) {
        if (Gt.get().shouldIgnoreMouse()) return;
        if (!b(e)) return;
        e.preventDefault();
      }

      this.isInteracting || (n = n || {}, this.delay = tt(n.delay, this.options.delay, 0), this.minDistance = tt(n.distance, this.options.distance, 0), this.subjectEl = this.options.subjectEl, C(t("body")), this.isInteracting = !0, this.isTouch = T(e), this.isGeneric = "dragstart" === e.type, this.isDelayEnded = !1, this.isDistanceSurpassed = !1, this.originX = E(e), this.originY = D(e), this.scrollEl = g(t(e.target)), this.bindHandlers(), this.initAutoScroll(), this.handleInteractionStart(e), this.startDelay(e), this.minDistance || this.handleDistanceSurpassed(e));
    },
    handleInteractionStart: function handleInteractionStart(t) {
      this.trigger("interactionStart", t);
    },
    endInteraction: function endInteraction(e, n) {
      this.isInteracting && (this.endDrag(e), this.delayTimeoutId && (clearTimeout(this.delayTimeoutId), this.delayTimeoutId = null), this.destroyAutoScroll(), this.unbindHandlers(), this.isInteracting = !1, this.handleInteractionEnd(e, n), t("body").removeClass("fc-unselectable").off("selectstart", H));
    },
    handleInteractionEnd: function handleInteractionEnd(t, e) {
      this.trigger("interactionEnd", t, e || !1);
    },
    bindHandlers: function bindHandlers() {
      var e = Gt.get();
      this.isGeneric ? this.listenTo(t(document), {
        drag: this.handleMove,
        dragstop: this.endInteraction
      }) : this.isTouch ? this.listenTo(e, {
        touchmove: this.handleTouchMove,
        touchend: this.endInteraction,
        scroll: this.handleTouchScroll
      }) : this.listenTo(e, {
        mousemove: this.handleMouseMove,
        mouseup: this.endInteraction
      }), this.listenTo(e, {
        selectstart: H,
        contextmenu: H
      });
    },
    unbindHandlers: function unbindHandlers() {
      this.stopListeningTo(Gt.get()), this.stopListeningTo(t(document));
    },
    startDrag: function startDrag(t, e) {
      this.startInteraction(t, e), this.isDragging || (this.isDragging = !0, this.handleDragStart(t));
    },
    handleDragStart: function handleDragStart(t) {
      this.trigger("dragStart", t);
    },
    handleMove: function handleMove(t) {
      var e = E(t) - this.originX,
          n = D(t) - this.originY,
          i = this.minDistance;
      this.isDistanceSurpassed || e * e + n * n >= i * i && this.handleDistanceSurpassed(t), this.isDragging && this.handleDrag(e, n, t);
    },
    handleDrag: function handleDrag(t, e, n) {
      this.trigger("drag", t, e, n), this.updateAutoScroll(n);
    },
    endDrag: function endDrag(t) {
      this.isDragging && (this.isDragging = !1, this.handleDragEnd(t));
    },
    handleDragEnd: function handleDragEnd(t) {
      this.trigger("dragEnd", t);
    },
    startDelay: function startDelay(t) {
      var e = this;
      this.delay ? this.delayTimeoutId = setTimeout(function () {
        e.handleDelayEnd(t);
      }, this.delay) : this.handleDelayEnd(t);
    },
    handleDelayEnd: function handleDelayEnd(t) {
      this.isDelayEnded = !0, this.isDistanceSurpassed && this.startDrag(t);
    },
    handleDistanceSurpassed: function handleDistanceSurpassed(t) {
      this.isDistanceSurpassed = !0, this.isDelayEnded && this.startDrag(t);
    },
    handleTouchMove: function handleTouchMove(t) {
      this.isDragging && this.shouldCancelTouchScroll && t.preventDefault(), this.handleMove(t);
    },
    handleMouseMove: function handleMouseMove(t) {
      this.handleMove(t);
    },
    handleTouchScroll: function handleTouchScroll(t) {
      this.isDragging && !this.scrollAlwaysKills || this.endInteraction(t, !0);
    },
    trigger: function trigger(t) {
      this.options[t] && this.options[t].apply(this, Array.prototype.slice.call(arguments, 1)), this["_" + t] && this["_" + t].apply(this, Array.prototype.slice.call(arguments, 1));
    }
  });
  Bt.mixin({
    isAutoScroll: !1,
    scrollBounds: null,
    scrollTopVel: null,
    scrollLeftVel: null,
    scrollIntervalId: null,
    scrollSensitivity: 30,
    scrollSpeed: 200,
    scrollIntervalMs: 50,
    initAutoScroll: function initAutoScroll() {
      var t = this.scrollEl;
      this.isAutoScroll = this.options.scroll && t && !t.is(window) && !t.is(document), this.isAutoScroll && this.listenTo(t, "scroll", lt(this.handleDebouncedScroll, 100));
    },
    destroyAutoScroll: function destroyAutoScroll() {
      this.endAutoScroll(), this.isAutoScroll && this.stopListeningTo(this.scrollEl, "scroll");
    },
    computeScrollBounds: function computeScrollBounds() {
      this.isAutoScroll && (this.scrollBounds = p(this.scrollEl));
    },
    updateAutoScroll: function updateAutoScroll(t) {
      var e,
          n,
          i,
          r,
          s = this.scrollSensitivity,
          o = this.scrollBounds,
          a = 0,
          l = 0;
      o && (e = (s - (D(t) - o.top)) / s, n = (s - (o.bottom - D(t))) / s, i = (s - (E(t) - o.left)) / s, r = (s - (o.right - E(t))) / s, e >= 0 && e <= 1 ? a = e * this.scrollSpeed * -1 : n >= 0 && n <= 1 && (a = n * this.scrollSpeed), i >= 0 && i <= 1 ? l = i * this.scrollSpeed * -1 : r >= 0 && r <= 1 && (l = r * this.scrollSpeed)), this.setScrollVel(a, l);
    },
    setScrollVel: function setScrollVel(t, e) {
      this.scrollTopVel = t, this.scrollLeftVel = e, this.constrainScrollVel(), !this.scrollTopVel && !this.scrollLeftVel || this.scrollIntervalId || (this.scrollIntervalId = setInterval(at(this, "scrollIntervalFunc"), this.scrollIntervalMs));
    },
    constrainScrollVel: function constrainScrollVel() {
      var t = this.scrollEl;
      this.scrollTopVel < 0 ? t.scrollTop() <= 0 && (this.scrollTopVel = 0) : this.scrollTopVel > 0 && t.scrollTop() + t[0].clientHeight >= t[0].scrollHeight && (this.scrollTopVel = 0), this.scrollLeftVel < 0 ? t.scrollLeft() <= 0 && (this.scrollLeftVel = 0) : this.scrollLeftVel > 0 && t.scrollLeft() + t[0].clientWidth >= t[0].scrollWidth && (this.scrollLeftVel = 0);
    },
    scrollIntervalFunc: function scrollIntervalFunc() {
      var t = this.scrollEl,
          e = this.scrollIntervalMs / 1e3;
      this.scrollTopVel && t.scrollTop(t.scrollTop() + this.scrollTopVel * e), this.scrollLeftVel && t.scrollLeft(t.scrollLeft() + this.scrollLeftVel * e), this.constrainScrollVel(), this.scrollTopVel || this.scrollLeftVel || this.endAutoScroll();
    },
    endAutoScroll: function endAutoScroll() {
      this.scrollIntervalId && (clearInterval(this.scrollIntervalId), this.scrollIntervalId = null, this.handleScrollEnd());
    },
    handleDebouncedScroll: function handleDebouncedScroll() {
      this.scrollIntervalId || this.handleScrollEnd();
    },
    handleScrollEnd: function handleScrollEnd() {}
  });
  var Lt = Bt.extend({
    component: null,
    origHit: null,
    hit: null,
    coordAdjust: null,
    constructor: function constructor(t, e) {
      Bt.call(this, e), this.component = t;
    },
    handleInteractionStart: function handleInteractionStart(t) {
      var e,
          n,
          i,
          r,
          s,
          o,
          a = this.subjectEl;
      this.component.hitsNeeded(), this.computeScrollBounds(), t ? (i = n = {
        left: E(t),
        top: D(t)
      }, a && (i = function (t, e) {
        return {
          left: Math.min(Math.max(t.left, e.left), e.right),
          top: Math.min(Math.max(t.top, e.top), e.bottom)
        };
      }(i, e = p(a))), this.origHit = this.queryHit(i.left, i.top), a && this.options.subjectCenter && (this.origHit && (e = R(this.origHit, e) || e), i = {
        left: ((o = e).left + o.right) / 2,
        top: (o.top + o.bottom) / 2
      }), this.coordAdjust = (s = n, {
        left: (r = i).left - s.left,
        top: r.top - s.top
      })) : (this.origHit = null, this.coordAdjust = null), Bt.prototype.handleInteractionStart.apply(this, arguments);
    },
    handleDragStart: function handleDragStart(t) {
      var e;
      Bt.prototype.handleDragStart.apply(this, arguments), (e = this.queryHit(E(t), D(t))) && this.handleHitOver(e);
    },
    handleDrag: function handleDrag(t, e, n) {
      var i;
      Bt.prototype.handleDrag.apply(this, arguments), Nt(i = this.queryHit(E(n), D(n)), this.hit) || (this.hit && this.handleHitOut(), i && this.handleHitOver(i));
    },
    handleDragEnd: function handleDragEnd() {
      this.handleHitDone(), Bt.prototype.handleDragEnd.apply(this, arguments);
    },
    handleHitOver: function handleHitOver(t) {
      var e = Nt(t, this.origHit);
      this.hit = t, this.trigger("hitOver", this.hit, e, this.origHit);
    },
    handleHitOut: function handleHitOut() {
      this.hit && (this.trigger("hitOut", this.hit), this.handleHitDone(), this.hit = null);
    },
    handleHitDone: function handleHitDone() {
      this.hit && this.trigger("hitDone", this.hit);
    },
    handleInteractionEnd: function handleInteractionEnd() {
      Bt.prototype.handleInteractionEnd.apply(this, arguments), this.origHit = null, this.hit = null, this.component.hitsNotNeeded();
    },
    handleScrollEnd: function handleScrollEnd() {
      Bt.prototype.handleScrollEnd.apply(this, arguments), this.isDragging && (this.component.releaseHits(), this.component.prepareHits());
    },
    queryHit: function queryHit(t, e) {
      return this.coordAdjust && (t += this.coordAdjust.left, e += this.coordAdjust.top), this.component.queryHit(t, e);
    }
  });

  function Nt(t, e) {
    return !t && !e || !(!t || !e) && t.component === e.component && zt(t, e) && zt(e, t);
  }

  function zt(t, e) {
    for (var n in t) {
      if (!/^(component|left|right|top|bottom)$/.test(n) && t[n] !== e[n]) return !1;
    }

    return !0;
  }

  n.touchMouseIgnoreWait = 500;
  var Ft,
      At,
      Gt = wt.extend(It, xt, {
    isTouching: !1,
    mouseIgnoreDepth: 0,
    handleScrollProxy: null,
    bind: function bind() {
      var e = this;
      this.listenTo(t(document), {
        touchstart: this.handleTouchStart,
        touchcancel: this.handleTouchCancel,
        touchend: this.handleTouchEnd,
        mousedown: this.handleMouseDown,
        mousemove: this.handleMouseMove,
        mouseup: this.handleMouseUp,
        click: this.handleClick,
        selectstart: this.handleSelectStart,
        contextmenu: this.handleContextMenu
      }), window.addEventListener("touchmove", this.handleTouchMoveProxy = function (n) {
        e.handleTouchMove(t.Event(n));
      }, {
        passive: !1
      }), window.addEventListener("scroll", this.handleScrollProxy = function (n) {
        e.handleScroll(t.Event(n));
      }, !0);
    },
    unbind: function unbind() {
      this.stopListeningTo(t(document)), window.removeEventListener("touchmove", this.handleTouchMoveProxy), window.removeEventListener("scroll", this.handleScrollProxy, !0);
    },
    handleTouchStart: function handleTouchStart(t) {
      this.stopTouch(t, !0), this.isTouching = !0, this.trigger("touchstart", t);
    },
    handleTouchMove: function handleTouchMove(t) {
      this.isTouching && this.trigger("touchmove", t);
    },
    handleTouchCancel: function handleTouchCancel(t) {
      this.isTouching && (this.trigger("touchcancel", t), this.stopTouch(t));
    },
    handleTouchEnd: function handleTouchEnd(t) {
      this.stopTouch(t);
    },
    handleMouseDown: function handleMouseDown(t) {
      this.shouldIgnoreMouse() || this.trigger("mousedown", t);
    },
    handleMouseMove: function handleMouseMove(t) {
      this.shouldIgnoreMouse() || this.trigger("mousemove", t);
    },
    handleMouseUp: function handleMouseUp(t) {
      this.shouldIgnoreMouse() || this.trigger("mouseup", t);
    },
    handleClick: function handleClick(t) {
      this.shouldIgnoreMouse() || this.trigger("click", t);
    },
    handleSelectStart: function handleSelectStart(t) {
      this.trigger("selectstart", t);
    },
    handleContextMenu: function handleContextMenu(t) {
      this.trigger("contextmenu", t);
    },
    handleScroll: function handleScroll(t) {
      this.trigger("scroll", t);
    },
    stopTouch: function stopTouch(t, e) {
      this.isTouching && (this.isTouching = !1, this.trigger("touchend", t), e || this.startTouchMouseIgnore());
    },
    startTouchMouseIgnore: function startTouchMouseIgnore() {
      var t = this,
          e = n.touchMouseIgnoreWait;
      e && (this.mouseIgnoreDepth++, setTimeout(function () {
        t.mouseIgnoreDepth--;
      }, e));
    },
    shouldIgnoreMouse: function shouldIgnoreMouse() {
      return this.isTouching || Boolean(this.mouseIgnoreDepth);
    }
  });
  Ft = null, At = 0, Gt.get = function () {
    return Ft || (Ft = new Gt()).bind(), Ft;
  }, Gt.needed = function () {
    Gt.get(), At++;
  }, Gt.unneeded = function () {
    --At || (Ft.unbind(), Ft = null);
  };
  var Vt = wt.extend(It, {
    options: null,
    sourceEl: null,
    el: null,
    parentEl: null,
    top0: null,
    left0: null,
    y0: null,
    x0: null,
    topDelta: null,
    leftDelta: null,
    isFollowing: !1,
    isHidden: !1,
    isAnimating: !1,
    constructor: function constructor(e, n) {
      this.options = n = n || {}, this.sourceEl = e, this.parentEl = n.parentEl ? t(n.parentEl) : e.parent();
    },
    start: function start(e) {
      this.isFollowing || (this.isFollowing = !0, this.y0 = D(e), this.x0 = E(e), this.topDelta = 0, this.leftDelta = 0, this.isHidden || this.updatePosition(), T(e) ? this.listenTo(t(document), "touchmove", this.handleMove) : this.listenTo(t(document), "mousemove", this.handleMove));
    },
    stop: function stop(e, n) {
      var i = this,
          r = this.options.revertDuration;

      function s() {
        i.isAnimating = !1, i.removeElement(), i.top0 = i.left0 = null, n && n();
      }

      this.isFollowing && !this.isAnimating && (this.isFollowing = !1, this.stopListeningTo(t(document)), e && r && !this.isHidden ? (this.isAnimating = !0, this.el.animate({
        top: this.top0,
        left: this.left0
      }, {
        duration: r,
        complete: s
      })) : s());
    },
    getEl: function getEl() {
      var t = this.el;
      return t || ((t = this.el = this.sourceEl.clone().addClass(this.options.additionalClass || "").css({
        position: "absolute",
        visibility: "",
        display: this.isHidden ? "none" : "",
        margin: 0,
        right: "auto",
        bottom: "auto",
        width: this.sourceEl.width(),
        height: this.sourceEl.height(),
        opacity: this.options.opacity || "",
        zIndex: this.options.zIndex
      })).addClass("fc-unselectable"), t.appendTo(this.parentEl)), t;
    },
    removeElement: function removeElement() {
      this.el && (this.el.remove(), this.el = null);
    },
    updatePosition: function updatePosition() {
      var t, e;
      this.getEl(), null === this.top0 && (t = this.sourceEl.offset(), e = this.el.offsetParent().offset(), this.top0 = t.top - e.top, this.left0 = t.left - e.left), this.el.css({
        top: this.top0 + this.topDelta,
        left: this.left0 + this.leftDelta
      });
    },
    handleMove: function handleMove(t) {
      this.topDelta = D(t) - this.y0, this.leftDelta = E(t) - this.x0, this.isHidden || this.updatePosition();
    },
    hide: function hide() {
      this.isHidden || (this.isHidden = !0, this.el && this.el.hide());
    },
    show: function show() {
      this.isHidden && (this.isHidden = !1, this.updatePosition(), this.getEl().show());
    }
  }),
      Ot = n.Grid = wt.extend(It, {
    hasDayInteractions: !0,
    view: null,
    isRTL: null,
    start: null,
    end: null,
    el: null,
    elsByFill: null,
    eventTimeFormat: null,
    displayEventTime: null,
    displayEventEnd: null,
    minResizeDuration: null,
    largeUnit: null,
    dayClickListener: null,
    daySelectListener: null,
    segDragListener: null,
    segResizeListener: null,
    externalDragListener: null,
    constructor: function constructor(t) {
      this.view = t, this.isRTL = t.opt("isRTL"), this.elsByFill = {}, this.dayClickListener = this.buildDayClickListener(), this.daySelectListener = this.buildDaySelectListener();
    },
    computeEventTimeFormat: function computeEventTimeFormat() {
      return this.view.opt("smallTimeFormat");
    },
    computeDisplayEventTime: function computeDisplayEventTime() {
      return !0;
    },
    computeDisplayEventEnd: function computeDisplayEventEnd() {
      return !0;
    },
    setRange: function setRange(t) {
      this.start = t.start.clone(), this.end = t.end.clone(), this.rangeUpdated(), this.processRangeOptions();
    },
    rangeUpdated: function rangeUpdated() {},
    processRangeOptions: function processRangeOptions() {
      var t,
          e,
          n = this.view;
      this.eventTimeFormat = n.opt("eventTimeFormat") || n.opt("timeFormat") || this.computeEventTimeFormat(), null == (t = n.opt("displayEventTime")) && (t = this.computeDisplayEventTime()), null == (e = n.opt("displayEventEnd")) && (e = this.computeDisplayEventEnd()), this.displayEventTime = t, this.displayEventEnd = e;
    },
    spanToSegs: function spanToSegs(t) {},
    diffDates: function diffDates(t, e) {
      return this.largeUnit ? F(t, e, this.largeUnit) : z(t, e);
    },
    hitsNeededDepth: 0,
    hitsNeeded: function hitsNeeded() {
      this.hitsNeededDepth++ || this.prepareHits();
    },
    hitsNotNeeded: function hitsNotNeeded() {
      this.hitsNeededDepth && ! --this.hitsNeededDepth && this.releaseHits();
    },
    prepareHits: function prepareHits() {},
    releaseHits: function releaseHits() {},
    queryHit: function queryHit(t, e) {},
    getSafeHitSpan: function getSafeHitSpan(t) {
      var e = this.getHitSpan(t);
      return q(e, this.view.activeRange) ? e : null;
    },
    getHitSpan: function getHitSpan(t) {},
    getHitEl: function getHitEl(t) {},
    setElement: function setElement(t) {
      this.el = t, this.hasDayInteractions && (C(t), this.bindDayHandler("touchstart", this.dayTouchStart), this.bindDayHandler("mousedown", this.dayMousedown)), this.bindSegHandlers(), this.bindGlobalHandlers();
    },
    bindDayHandler: function bindDayHandler(e, n) {
      var i = this;
      this.el.on(e, function (e) {
        if (!t(e.target).is(i.segSelector + "," + i.segSelector + " *,.fc-more,a[data-goto]")) return n.call(i, e);
      });
    },
    removeElement: function removeElement() {
      this.unbindGlobalHandlers(), this.clearDragListeners(), this.el.remove();
    },
    renderSkeleton: function renderSkeleton() {},
    renderDates: function renderDates() {},
    unrenderDates: function unrenderDates() {},
    bindGlobalHandlers: function bindGlobalHandlers() {
      this.listenTo(t(document), {
        dragstart: this.externalDragStart,
        sortstart: this.externalDragStart
      });
    },
    unbindGlobalHandlers: function unbindGlobalHandlers() {
      this.stopListeningTo(t(document));
    },
    dayMousedown: function dayMousedown(t) {
      var e = this.view;
      Gt.get().shouldIgnoreMouse() || (this.dayClickListener.startInteraction(t), e.opt("selectable") && this.daySelectListener.startInteraction(t, {
        distance: e.opt("selectMinDistance")
      }));
    },
    dayTouchStart: function dayTouchStart(t) {
      var e,
          n = this.view;
      n.isSelected || n.selectedEvent || (null == (e = n.opt("selectLongPressDelay")) && (e = n.opt("longPressDelay")), this.dayClickListener.startInteraction(t), n.opt("selectable") && this.daySelectListener.startInteraction(t, {
        delay: e
      }));
    },
    buildDayClickListener: function buildDayClickListener() {
      var t,
          e = this,
          n = this.view,
          i = new Lt(this, {
        scroll: n.opt("dragScroll"),
        interactionStart: function interactionStart() {
          t = i.origHit;
        },
        hitOver: function hitOver(e, n, i) {
          n || (t = null);
        },
        hitOut: function hitOut() {
          t = null;
        },
        interactionEnd: function interactionEnd(i, r) {
          var s;
          !r && t && (s = e.getSafeHitSpan(t)) && n.triggerDayClick(s, e.getHitEl(t), i);
        }
      });
      return i.shouldCancelTouchScroll = !1, i.scrollAlwaysKills = !0, i;
    },
    buildDaySelectListener: function buildDaySelectListener() {
      var t,
          e = this,
          n = this.view;
      return new Lt(this, {
        scroll: n.opt("dragScroll"),
        interactionStart: function interactionStart() {
          t = null;
        },
        dragStart: function dragStart() {
          n.unselect();
        },
        hitOver: function hitOver(n, i, r) {
          var s, o;
          r && (s = e.getSafeHitSpan(r), o = e.getSafeHitSpan(n), (t = s && o ? e.computeSelection(s, o) : null) ? e.renderSelection(t) : !1 === t && l());
        },
        hitOut: function hitOut() {
          t = null, e.unrenderSelection();
        },
        hitDone: function hitDone() {
          u();
        },
        interactionEnd: function interactionEnd(e, i) {
          !i && t && n.reportSelection(t, e);
        }
      });
    },
    clearDragListeners: function clearDragListeners() {
      this.dayClickListener.endInteraction(), this.daySelectListener.endInteraction(), this.segDragListener && this.segDragListener.endInteraction(), this.segResizeListener && this.segResizeListener.endInteraction(), this.externalDragListener && this.externalDragListener.endInteraction();
    },
    renderEventLocationHelper: function renderEventLocationHelper(t, e) {
      var n = this.fabricateHelperEvent(t, e);
      return this.renderHelper(n, e);
    },
    fabricateHelperEvent: function fabricateHelperEvent(t, e) {
      var n = e ? Q(e.event) : {};
      return n.start = t.start.clone(), n.end = t.end ? t.end.clone() : null, n.allDay = null, this.view.calendar.normalizeEventDates(n), n.className = (n.className || []).concat("fc-helper"), e || (n.editable = !1), n;
    },
    renderHelper: function renderHelper(t, e) {},
    unrenderHelper: function unrenderHelper() {},
    renderSelection: function renderSelection(t) {
      this.renderHighlight(t);
    },
    unrenderSelection: function unrenderSelection() {
      this.unrenderHighlight();
    },
    computeSelection: function computeSelection(t, e) {
      var n = this.computeSelectionSpan(t, e);
      return !(n && !this.view.calendar.isSelectionSpanAllowed(n)) && n;
    },
    computeSelectionSpan: function computeSelectionSpan(t, e) {
      var n = [t.start, t.end, e.start, e.end];
      return n.sort(st), {
        start: n[0].clone(),
        end: n[3].clone()
      };
    },
    renderHighlight: function renderHighlight(t) {
      this.renderFill("highlight", this.spanToSegs(t));
    },
    unrenderHighlight: function unrenderHighlight() {
      this.unrenderFill("highlight");
    },
    highlightSegClasses: function highlightSegClasses() {
      return ["fc-highlight"];
    },
    renderBusinessHours: function renderBusinessHours() {},
    unrenderBusinessHours: function unrenderBusinessHours() {},
    getNowIndicatorUnit: function getNowIndicatorUnit() {},
    renderNowIndicator: function renderNowIndicator(t) {},
    unrenderNowIndicator: function unrenderNowIndicator() {},
    renderFill: function renderFill(t, e) {},
    unrenderFill: function unrenderFill(t) {
      var e = this.elsByFill[t];
      e && (e.remove(), delete this.elsByFill[t]);
    },
    renderFillSegEls: function renderFillSegEls(e, n) {
      var i,
          r = this,
          s = this[e + "SegEl"],
          o = "",
          a = [];

      if (n.length) {
        for (i = 0; i < n.length; i++) {
          o += this.fillSegHtml(e, n[i]);
        }

        t(o).each(function (e, i) {
          var o = n[e],
              l = t(i);
          s && (l = s.call(r, o, l)), l && (l = t(l)).is(r.fillSegTag) && (o.el = l, a.push(o));
        });
      }

      return a;
    },
    fillSegTag: "div",
    fillSegHtml: function fillSegHtml(t, e) {
      var n = this[t + "SegClasses"],
          i = this[t + "SegCss"],
          r = n ? n.call(this, e) : [],
          s = it(i ? i.call(this, e) : {});
      return "<" + this.fillSegTag + (r.length ? ' class="' + r.join(" ") + '"' : "") + (s ? ' style="' + s + '"' : "") + " />";
    },
    getDayClasses: function getDayClasses(t, e) {
      var n,
          i = this.view,
          r = [];
      return Y(t, i.activeRange) ? (r.push("fc-" + L[t.day()]), 1 == i.currentRangeAs("months") && t.month() != i.currentRange.start.month() && r.push("fc-other-month"), n = i.calendar.getNow(), t.isSame(n, "day") ? (r.push("fc-today"), !0 !== e && r.push(i.highlightStateClass)) : t < n ? r.push("fc-past") : r.push("fc-future")) : r.push("fc-disabled-day"), r;
    }
  });

  function Pt(t) {
    return {
      start: t.start.clone(),
      end: t.end ? t.end.clone() : null,
      allDay: t.allDay
    };
  }

  function _t(t) {
    var e = Wt(t);
    return "background" === e || "inverse-background" === e;
  }

  function Wt(t) {
    return tt((t.source || {}).rendering, t.rendering);
  }

  function Yt(t, e) {
    return t.start - e.start;
  }

  Ot.mixin({
    segSelector: ".fc-event-container > *",
    mousedOverSeg: null,
    isDraggingSeg: !1,
    isResizingSeg: !1,
    isDraggingExternal: !1,
    segs: null,
    renderEvents: function renderEvents(t) {
      var e,
          n = [],
          i = [];

      for (e = 0; e < t.length; e++) {
        (_t(t[e]) ? n : i).push(t[e]);
      }

      this.segs = [].concat(this.renderBgEvents(n), this.renderFgEvents(i));
    },
    renderBgEvents: function renderBgEvents(t) {
      var e = this.eventsToSegs(t);
      return this.renderBgSegs(e) || e;
    },
    renderFgEvents: function renderFgEvents(t) {
      var e = this.eventsToSegs(t);
      return this.renderFgSegs(e) || e;
    },
    unrenderEvents: function unrenderEvents() {
      this.handleSegMouseout(), this.clearDragListeners(), this.unrenderFgSegs(), this.unrenderBgSegs(), this.segs = null;
    },
    getEventSegs: function getEventSegs() {
      return this.segs || [];
    },
    renderFgSegs: function renderFgSegs(t) {},
    unrenderFgSegs: function unrenderFgSegs() {},
    renderFgSegEls: function renderFgSegEls(e, n) {
      var i,
          r = this.view,
          s = "",
          o = [];

      if (e.length) {
        for (i = 0; i < e.length; i++) {
          s += this.fgSegHtml(e[i], n);
        }

        t(s).each(function (n, i) {
          var s = e[n],
              a = r.resolveEventEl(s.event, t(i));
          a && (a.data("fc-seg", s), s.el = a, o.push(s));
        });
      }

      return o;
    },
    fgSegHtml: function fgSegHtml(t, e) {},
    renderBgSegs: function renderBgSegs(t) {
      return this.renderFill("bgEvent", t);
    },
    unrenderBgSegs: function unrenderBgSegs() {
      this.unrenderFill("bgEvent");
    },
    bgEventSegEl: function bgEventSegEl(t, e) {
      return this.view.resolveEventEl(t.event, e);
    },
    bgEventSegClasses: function bgEventSegClasses(t) {
      var e = t.event,
          n = e.source || {};
      return ["fc-bgevent"].concat(e.className, n.className || []);
    },
    bgEventSegCss: function bgEventSegCss(t) {
      return {
        "background-color": this.getSegSkinCss(t)["background-color"]
      };
    },
    businessHoursSegClasses: function businessHoursSegClasses(t) {
      return ["fc-nonbusiness", "fc-bgevent"];
    },
    buildBusinessHourSegs: function buildBusinessHourSegs(t, e) {
      return this.eventsToSegs(this.buildBusinessHourEvents(t, e));
    },
    buildBusinessHourEvents: function buildBusinessHourEvents(e, n) {
      var i,
          r = this.view.calendar;
      return null == n && (n = r.opt("businessHours")), !(i = r.computeBusinessHourEvents(e, n)).length && n && (i = [t.extend({}, de, {
        start: this.view.activeRange.end,
        end: this.view.activeRange.end,
        dow: null
      })]), i;
    },
    bindSegHandlers: function bindSegHandlers() {
      this.bindSegHandlersToEl(this.el);
    },
    bindSegHandlersToEl: function bindSegHandlersToEl(t) {
      this.bindSegHandlerToEl(t, "touchstart", this.handleSegTouchStart), this.bindSegHandlerToEl(t, "mouseenter", this.handleSegMouseover), this.bindSegHandlerToEl(t, "mouseleave", this.handleSegMouseout), this.bindSegHandlerToEl(t, "mousedown", this.handleSegMousedown), this.bindSegHandlerToEl(t, "click", this.handleSegClick);
    },
    bindSegHandlerToEl: function bindSegHandlerToEl(e, n, i) {
      var r = this;
      e.on(n, this.segSelector, function (e) {
        var n = t(this).data("fc-seg");
        if (n && !r.isDraggingSeg && !r.isResizingSeg) return i.call(r, n, e);
      });
    },
    handleSegClick: function handleSegClick(t, e) {
      !1 === this.view.publiclyTrigger("eventClick", t.el[0], t.event, e) && e.preventDefault();
    },
    handleSegMouseover: function handleSegMouseover(t, e) {
      Gt.get().shouldIgnoreMouse() || this.mousedOverSeg || (this.mousedOverSeg = t, this.view.isEventResizable(t.event) && t.el.addClass("fc-allow-mouse-resize"), this.view.publiclyTrigger("eventMouseover", t.el[0], t.event, e));
    },
    handleSegMouseout: function handleSegMouseout(t, e) {
      e = e || {}, this.mousedOverSeg && (t = t || this.mousedOverSeg, this.mousedOverSeg = null, this.view.isEventResizable(t.event) && t.el.removeClass("fc-allow-mouse-resize"), this.view.publiclyTrigger("eventMouseout", t.el[0], t.event, e));
    },
    handleSegMousedown: function handleSegMousedown(t, e) {
      !this.startSegResize(t, e, {
        distance: 5
      }) && this.view.isEventDraggable(t.event) && this.buildSegDragListener(t).startInteraction(e, {
        distance: 5
      });
    },
    handleSegTouchStart: function handleSegTouchStart(t, e) {
      var n,
          i = this.view,
          r = t.event,
          s = i.isEventSelected(r),
          o = i.isEventDraggable(r),
          a = i.isEventResizable(r),
          l = !1;
      s && a && (l = this.startSegResize(t, e)), l || !o && !a || (null == (n = i.opt("eventLongPressDelay")) && (n = i.opt("longPressDelay")), (o ? this.buildSegDragListener(t) : this.buildSegSelectListener(t)).startInteraction(e, {
        delay: s ? 0 : n
      }));
    },
    startSegResize: function startSegResize(e, n, i) {
      return !!t(n.target).is(".fc-resizer") && (this.buildSegResizeListener(e, t(n.target).is(".fc-start-resizer")).startInteraction(n, i), !0);
    },
    buildSegDragListener: function buildSegDragListener(t) {
      var e,
          n,
          i,
          r = this,
          s = this.view,
          o = t.el,
          a = t.event;
      if (this.segDragListener) return this.segDragListener;
      var h = this.segDragListener = new Lt(s, {
        scroll: s.opt("dragScroll"),
        subjectEl: o,
        subjectCenter: !0,
        interactionStart: function interactionStart(i) {
          t.component = r, e = !1, (n = new Vt(t.el, {
            additionalClass: "fc-dragging",
            parentEl: s.el,
            opacity: h.isTouch ? null : s.opt("dragOpacity"),
            revertDuration: s.opt("dragRevertDuration"),
            zIndex: 2
          })).hide(), n.start(i);
        },
        dragStart: function dragStart(n) {
          h.isTouch && !s.isEventSelected(a) && s.selectEvent(a), e = !0, r.handleSegMouseout(t, n), r.segDragStart(t, n), s.hideEvent(a);
        },
        hitOver: function hitOver(e, o, u) {
          var c, d, f;
          t.hit && (u = t.hit), c = u.component.getSafeHitSpan(u), d = e.component.getSafeHitSpan(e), !(!c || !d) && (i = r.computeEventDrop(c, d, a)) && r.isEventLocationAllowed(i, a) || (i = null, l()), i && (f = s.renderDrag(i, t)) ? (f.addClass("fc-dragging"), h.isTouch || r.applyDragOpacity(f), n.hide()) : n.show(), o && (i = null);
        },
        hitOut: function hitOut() {
          s.unrenderDrag(), n.show(), i = null;
        },
        hitDone: function hitDone() {
          u();
        },
        interactionEnd: function interactionEnd(l) {
          delete t.component, n.stop(!i, function () {
            e && (s.unrenderDrag(), r.segDragStop(t, l)), i ? s.reportSegDrop(t, i, r.largeUnit, o, l) : s.showEvent(a);
          }), r.segDragListener = null;
        }
      });
      return h;
    },
    buildSegSelectListener: function buildSegSelectListener(t) {
      var e = this,
          n = this.view,
          i = t.event;
      if (this.segDragListener) return this.segDragListener;
      var r = this.segDragListener = new Bt({
        dragStart: function dragStart(t) {
          r.isTouch && !n.isEventSelected(i) && n.selectEvent(i);
        },
        interactionEnd: function interactionEnd(t) {
          e.segDragListener = null;
        }
      });
      return r;
    },
    segDragStart: function segDragStart(t, e) {
      this.isDraggingSeg = !0, this.view.publiclyTrigger("eventDragStart", t.el[0], t.event, e, {});
    },
    segDragStop: function segDragStop(t, e) {
      this.isDraggingSeg = !1, this.view.publiclyTrigger("eventDragStop", t.el[0], t.event, e, {});
    },
    computeEventDrop: function computeEventDrop(t, e, n) {
      var i,
          r,
          s = this.view.calendar,
          o = t.start,
          a = e.start;
      return o.hasTime() === a.hasTime() ? (i = this.diffDates(a, o), n.allDay && U(i) ? (r = {
        start: n.start.clone(),
        end: s.getEventEnd(n),
        allDay: !1
      }, s.normalizeEventTimes(r)) : r = Pt(n), r.start.add(i), r.end && r.end.add(i)) : r = {
        start: a.clone(),
        end: null,
        allDay: !a.hasTime()
      }, r;
    },
    applyDragOpacity: function applyDragOpacity(t) {
      var e = this.view.opt("dragOpacity");
      null != e && t.css("opacity", e);
    },
    externalDragStart: function externalDragStart(e, n) {
      var i,
          r,
          s = this.view;
      s.opt("droppable") && (i = t((n ? n.item : null) || e.target), r = s.opt("dropAccept"), (t.isFunction(r) ? r.call(i[0], i) : i.is(r)) && (this.isDraggingExternal || this.listenToExternalDrag(i, e, n)));
    },
    listenToExternalDrag: function listenToExternalDrag(i, r, s) {
      var o,
          a = this,
          h = this.view,
          c = function (i) {
        var r,
            s,
            o,
            a,
            l = n.dataAttrPrefix;
        l && (l += "-");
        (r = i.data(l + "event") || null) && (r = "object" == _typeof(r) ? t.extend({}, r) : {}, null == (s = r.start) && (s = r.time), o = r.duration, a = r.stick, delete r.start, delete r.time, delete r.duration, delete r.stick);
        null == s && (s = i.data(l + "start"));
        null == s && (s = i.data(l + "time"));
        null == o && (o = i.data(l + "duration"));
        null == a && (a = i.data(l + "stick"));
        return s = null != s ? e.duration(s) : null, o = null != o ? e.duration(o) : null, a = Boolean(a), {
          eventProps: r,
          startTime: s,
          duration: o,
          stick: a
        };
      }(i);

      (a.externalDragListener = new Lt(this, {
        interactionStart: function interactionStart() {
          a.isDraggingExternal = !0;
        },
        hitOver: function hitOver(t) {
          var e = t.component.getSafeHitSpan(t);
          !!e && (o = a.computeExternalDrop(e, c)) && a.isExternalLocationAllowed(o, c.eventProps) || (o = null, l()), o && a.renderDrag(o);
        },
        hitOut: function hitOut() {
          o = null;
        },
        hitDone: function hitDone() {
          u(), a.unrenderDrag();
        },
        interactionEnd: function interactionEnd(t) {
          o && h.reportExternalDrop(c, o, i, t, s), a.isDraggingExternal = !1, a.externalDragListener = null;
        }
      })).startDrag(r);
    },
    computeExternalDrop: function computeExternalDrop(t, e) {
      var n = {
        start: this.view.calendar.applyTimezone(t.start),
        end: null
      };
      return e.startTime && !n.start.hasTime() && n.start.time(e.startTime), e.duration && (n.end = n.start.clone().add(e.duration)), n;
    },
    renderDrag: function renderDrag(t, e) {},
    unrenderDrag: function unrenderDrag() {},
    buildSegResizeListener: function buildSegResizeListener(t, e) {
      var n,
          i,
          r = this,
          s = this.view,
          o = s.calendar,
          a = t.el,
          h = t.event,
          c = o.getEventEnd(h);
      return this.segResizeListener = new Lt(this, {
        scroll: s.opt("dragScroll"),
        subjectEl: a,
        interactionStart: function interactionStart() {
          n = !1;
        },
        dragStart: function dragStart(e) {
          n = !0, r.handleSegMouseout(t, e), r.segResizeStart(t, e);
        },
        hitOver: function hitOver(n, o, a) {
          var u = r.getSafeHitSpan(a),
              d = r.getSafeHitSpan(n);
          !(!u || !d) && (i = e ? r.computeEventStartResize(u, d, h) : r.computeEventEndResize(u, d, h)) && r.isEventLocationAllowed(i, h) ? i.start.isSame(h.start.clone().stripZone()) && i.end.isSame(c.clone().stripZone()) && (i = null) : (i = null, l()), i && (s.hideEvent(h), r.renderEventResize(i, t));
        },
        hitOut: function hitOut() {
          i = null, s.showEvent(h);
        },
        hitDone: function hitDone() {
          r.unrenderEventResize(), u();
        },
        interactionEnd: function interactionEnd(e) {
          n && r.segResizeStop(t, e), i ? s.reportSegResize(t, i, r.largeUnit, a, e) : s.showEvent(h), r.segResizeListener = null;
        }
      });
    },
    segResizeStart: function segResizeStart(t, e) {
      this.isResizingSeg = !0, this.view.publiclyTrigger("eventResizeStart", t.el[0], t.event, e, {});
    },
    segResizeStop: function segResizeStop(t, e) {
      this.isResizingSeg = !1, this.view.publiclyTrigger("eventResizeStop", t.el[0], t.event, e, {});
    },
    computeEventStartResize: function computeEventStartResize(t, e, n) {
      return this.computeEventResize("start", t, e, n);
    },
    computeEventEndResize: function computeEventEndResize(t, e, n) {
      return this.computeEventResize("end", t, e, n);
    },
    computeEventResize: function computeEventResize(t, e, n, i) {
      var r,
          s,
          o = this.view.calendar,
          a = this.diffDates(n[t], e[t]);
      return (r = {
        start: i.start.clone(),
        end: o.getEventEnd(i),
        allDay: i.allDay
      }).allDay && U(a) && (r.allDay = !1, o.normalizeEventTimes(r)), r[t].add(a), r.start.isBefore(r.end) || (s = this.minResizeDuration || (i.allDay ? o.defaultAllDayEventDuration : o.defaultTimedEventDuration), "start" == t ? r.start = r.end.clone().subtract(s) : r.end = r.start.clone().add(s)), r;
    },
    renderEventResize: function renderEventResize(t, e) {},
    unrenderEventResize: function unrenderEventResize() {},
    getEventTimeText: function getEventTimeText(t, e, n) {
      return null == e && (e = this.eventTimeFormat), null == n && (n = this.displayEventEnd), this.displayEventTime && t.start.hasTime() ? n && t.end ? this.view.formatRange(t, e) : t.start.format(e) : "";
    },
    getSegClasses: function getSegClasses(t, e, n) {
      var i = this.view,
          r = ["fc-event", t.isStart ? "fc-start" : "fc-not-start", t.isEnd ? "fc-end" : "fc-not-end"].concat(this.getSegCustomClasses(t));
      return e && r.push("fc-draggable"), n && r.push("fc-resizable"), i.isEventSelected(t.event) && r.push("fc-selected"), r;
    },
    getSegCustomClasses: function getSegCustomClasses(t) {
      var e = t.event;
      return [].concat(e.className, e.source ? e.source.className : []);
    },
    getSegSkinCss: function getSegSkinCss(t) {
      return {
        "background-color": this.getSegBackgroundColor(t),
        "border-color": this.getSegBorderColor(t),
        color: this.getSegTextColor(t)
      };
    },
    getSegBackgroundColor: function getSegBackgroundColor(t) {
      return t.event.backgroundColor || t.event.color || this.getSegDefaultBackgroundColor(t);
    },
    getSegDefaultBackgroundColor: function getSegDefaultBackgroundColor(t) {
      var e = t.event.source || {};
      return e.backgroundColor || e.color || this.view.opt("eventBackgroundColor") || this.view.opt("eventColor");
    },
    getSegBorderColor: function getSegBorderColor(t) {
      return t.event.borderColor || t.event.color || this.getSegDefaultBorderColor(t);
    },
    getSegDefaultBorderColor: function getSegDefaultBorderColor(t) {
      var e = t.event.source || {};
      return e.borderColor || e.color || this.view.opt("eventBorderColor") || this.view.opt("eventColor");
    },
    getSegTextColor: function getSegTextColor(t) {
      return t.event.textColor || this.getSegDefaultTextColor(t);
    },
    getSegDefaultTextColor: function getSegDefaultTextColor(t) {
      return (t.event.source || {}).textColor || this.view.opt("eventTextColor");
    },
    isEventLocationAllowed: function isEventLocationAllowed(t, e) {
      if (this.isEventLocationInRange(t)) {
        var n,
            i = this.view.calendar,
            r = this.eventToSpans(t);

        if (r.length) {
          for (n = 0; n < r.length; n++) {
            if (!i.isEventSpanAllowed(r[n], e)) return !1;
          }

          return !0;
        }
      }

      return !1;
    },
    isExternalLocationAllowed: function isExternalLocationAllowed(t, e) {
      if (this.isEventLocationInRange(t)) {
        var n,
            i = this.view.calendar,
            r = this.eventToSpans(t);

        if (r.length) {
          for (n = 0; n < r.length; n++) {
            if (!i.isExternalSpanAllowed(r[n], t, e)) return !1;
          }

          return !0;
        }
      }

      return !1;
    },
    isEventLocationInRange: function isEventLocationInRange(t) {
      return q(this.eventToRawRange(t), this.view.validRange);
    },
    eventToSegs: function eventToSegs(t) {
      return this.eventsToSegs([t]);
    },
    eventToSpans: function eventToSpans(t) {
      var e = this.eventToRange(t);
      return e ? this.eventRangeToSpans(e, t) : [];
    },
    eventsToSegs: function eventsToSegs(e, n) {
      var i = this,
          r = function (t) {
        var e,
            n,
            i = {};

        for (e = 0; e < t.length; e++) {
          n = t[e], (i[n._id] || (i[n._id] = [])).push(n);
        }

        return i;
      }(e),
          s = [];

      return t.each(r, function (t, e) {
        var r,
            o,
            a = [],
            l = [];

        for (o = 0; o < e.length; o++) {
          (r = i.eventToRange(e[o])) && (l.push(r), a.push(e[o]));
        }

        if ("inverse-background" === Wt(e[0])) for (l = i.invertRanges(l), o = 0; o < l.length; o++) {
          s.push.apply(s, i.eventRangeToSegs(l[o], e[0], n));
        } else for (o = 0; o < l.length; o++) {
          s.push.apply(s, i.eventRangeToSegs(l[o], a[o], n));
        }
      }), s;
    },
    eventToRange: function eventToRange(t) {
      return this.refineRawEventRange(this.eventToRawRange(t));
    },
    refineRawEventRange: function refineRawEventRange(t) {
      var e = this.view,
          n = e.calendar,
          i = B(t, e.activeRange);
      if (i) return n.localizeMoment(i.start), n.localizeMoment(i.end), i;
    },
    eventToRawRange: function eventToRawRange(t) {
      var e = this.view.calendar;
      return {
        start: t.start.clone().stripZone(),
        end: (t.end ? t.end.clone() : e.getDefaultEventEnd(null != t.allDay ? t.allDay : !t.start.hasTime(), t.start)).stripZone()
      };
    },
    eventRangeToSegs: function eventRangeToSegs(t, e, n) {
      var i,
          r = this.eventRangeToSpans(t, e),
          s = [];

      for (i = 0; i < r.length; i++) {
        s.push.apply(s, this.eventSpanToSegs(r[i], e, n));
      }

      return s;
    },
    eventRangeToSpans: function eventRangeToSpans(e, n) {
      return [t.extend({}, e)];
    },
    eventSpanToSegs: function eventSpanToSegs(t, e, n) {
      var i,
          r,
          s = n ? n(t) : this.spanToSegs(t);

      for (i = 0; i < s.length; i++) {
        r = s[i], t.isStart || (r.isStart = !1), t.isEnd || (r.isEnd = !1), r.event = e, r.eventStartMS = +t.start, r.eventDurationMS = t.end - t.start;
      }

      return s;
    },
    invertRanges: function invertRanges(t) {
      var e,
          n,
          i = this.view,
          r = i.activeRange.start.clone(),
          s = i.activeRange.end.clone(),
          o = [],
          a = r;

      for (t.sort(Yt), e = 0; e < t.length; e++) {
        (n = t[e]).start > a && o.push({
          start: a,
          end: n.start
        }), n.end > a && (a = n.end);
      }

      return a < s && o.push({
        start: a,
        end: s
      }), o;
    },
    sortEventSegs: function sortEventSegs(t) {
      t.sort(at(this, "compareEventSegs"));
    },
    compareEventSegs: function compareEventSegs(t, e) {
      return t.eventStartMS - e.eventStartMS || e.eventDurationMS - t.eventDurationMS || e.event.allDay - t.event.allDay || I(t.event, e.event, this.view.eventOrderSpecs);
    }
  }), n.pluckEventDateProps = Pt, n.isBgEvent = _t, n.dataAttrPrefix = "";
  var qt = n.DayTableMixin = {
    breakOnWeeks: !1,
    dayDates: null,
    dayIndices: null,
    daysPerRow: null,
    rowCnt: null,
    colCnt: null,
    colHeadFormat: null,
    updateDayTable: function updateDayTable() {
      for (var t, e, n, i = this.view, r = this.start.clone(), s = -1, o = [], a = []; r.isBefore(this.end);) {
        i.isHiddenDay(r) ? o.push(s + .5) : (s++, o.push(s), a.push(r.clone())), r.add(1, "days");
      }

      if (this.breakOnWeeks) {
        for (e = a[0].day(), t = 1; t < a.length && a[t].day() != e; t++) {
          ;
        }

        n = Math.ceil(a.length / t);
      } else n = 1, t = a.length;

      this.dayDates = a, this.dayIndices = o, this.daysPerRow = t, this.rowCnt = n, this.updateDayTableCols();
    },
    updateDayTableCols: function updateDayTableCols() {
      this.colCnt = this.computeColCnt(), this.colHeadFormat = this.view.opt("columnFormat") || this.computeColHeadFormat();
    },
    computeColCnt: function computeColCnt() {
      return this.daysPerRow;
    },
    getCellDate: function getCellDate(t, e) {
      return this.dayDates[this.getCellDayIndex(t, e)].clone();
    },
    getCellRange: function getCellRange(t, e) {
      var n = this.getCellDate(t, e),
          i = n.clone().add(1, "days");
      return {
        start: n,
        end: i
      };
    },
    getCellDayIndex: function getCellDayIndex(t, e) {
      return t * this.daysPerRow + this.getColDayIndex(e);
    },
    getColDayIndex: function getColDayIndex(t) {
      return this.isRTL ? this.colCnt - 1 - t : t;
    },
    getDateDayIndex: function getDateDayIndex(t) {
      var e = this.dayIndices,
          n = t.diff(this.start, "days");
      return n < 0 ? e[0] - 1 : n >= e.length ? e[e.length - 1] + 1 : e[n];
    },
    computeColHeadFormat: function computeColHeadFormat() {
      return this.rowCnt > 1 || this.colCnt > 10 ? "ddd" : this.colCnt > 1 ? this.view.opt("dayOfMonthFormat") : "dddd";
    },
    sliceRangeByRow: function sliceRangeByRow(t) {
      var e,
          n,
          i,
          r,
          s,
          o = this.daysPerRow,
          a = this.view.computeDayRange(t),
          l = this.getDateDayIndex(a.start),
          u = this.getDateDayIndex(a.end.clone().subtract(1, "days")),
          h = [];

      for (e = 0; e < this.rowCnt; e++) {
        i = (n = e * o) + o - 1, r = Math.max(l, n), s = Math.min(u, i), (r = Math.ceil(r)) <= (s = Math.floor(s)) && h.push({
          row: e,
          firstRowDayIndex: r - n,
          lastRowDayIndex: s - n,
          isStart: r === l,
          isEnd: s === u
        });
      }

      return h;
    },
    sliceRangeByDay: function sliceRangeByDay(t) {
      var e,
          n,
          i,
          r,
          s,
          o,
          a = this.daysPerRow,
          l = this.view.computeDayRange(t),
          u = this.getDateDayIndex(l.start),
          h = this.getDateDayIndex(l.end.clone().subtract(1, "days")),
          c = [];

      for (e = 0; e < this.rowCnt; e++) {
        for (i = (n = e * a) + a - 1, r = n; r <= i; r++) {
          s = Math.max(u, r), o = Math.min(h, r), (s = Math.ceil(s)) <= (o = Math.floor(o)) && c.push({
            row: e,
            firstRowDayIndex: s - n,
            lastRowDayIndex: o - n,
            isStart: s === u,
            isEnd: o === h
          });
        }
      }

      return c;
    },
    renderHeadHtml: function renderHeadHtml() {
      return '<div class="fc-row ' + this.view.widgetHeaderClass + '"><table><thead>' + this.renderHeadTrHtml() + "</thead></table></div>";
    },
    renderHeadIntroHtml: function renderHeadIntroHtml() {
      return this.renderIntroHtml();
    },
    renderHeadTrHtml: function renderHeadTrHtml() {
      return "<tr>" + (this.isRTL ? "" : this.renderHeadIntroHtml()) + this.renderHeadDateCellsHtml() + (this.isRTL ? this.renderHeadIntroHtml() : "") + "</tr>";
    },
    renderHeadDateCellsHtml: function renderHeadDateCellsHtml() {
      var t,
          e,
          n = [];

      for (t = 0; t < this.colCnt; t++) {
        e = this.getCellDate(0, t), n.push(this.renderHeadDateCellHtml(e));
      }

      return n.join("");
    },
    renderHeadDateCellHtml: function renderHeadDateCellHtml(t, e, n) {
      var i = this.view,
          r = Y(t, i.activeRange),
          s = ["fc-day-header", i.widgetHeaderClass],
          o = et(t.format(this.colHeadFormat));
      return 1 === this.rowCnt ? s = s.concat(this.getDayClasses(t, !0)) : s.push("fc-" + L[t.day()]), '<th class="' + s.join(" ") + '"' + (1 === (r && this.rowCnt) ? ' data-date="' + t.format("YYYY-MM-DD") + '"' : "") + (e > 1 ? ' colspan="' + e + '"' : "") + (n ? " " + n : "") + ">" + (r ? i.buildGotoAnchorHtml({
        date: t,
        forceOff: this.rowCnt > 1 || 1 === this.colCnt
      }, o) : o) + "</th>";
    },
    renderBgTrHtml: function renderBgTrHtml(t) {
      return "<tr>" + (this.isRTL ? "" : this.renderBgIntroHtml(t)) + this.renderBgCellsHtml(t) + (this.isRTL ? this.renderBgIntroHtml(t) : "") + "</tr>";
    },
    renderBgIntroHtml: function renderBgIntroHtml(t) {
      return this.renderIntroHtml();
    },
    renderBgCellsHtml: function renderBgCellsHtml(t) {
      var e,
          n,
          i = [];

      for (e = 0; e < this.colCnt; e++) {
        n = this.getCellDate(t, e), i.push(this.renderBgCellHtml(n));
      }

      return i.join("");
    },
    renderBgCellHtml: function renderBgCellHtml(t, e) {
      var n = this.view,
          i = Y(t, n.activeRange),
          r = this.getDayClasses(t);
      return r.unshift("fc-day", n.widgetContentClass), '<td class="' + r.join(" ") + '"' + (i ? ' data-date="' + t.format("YYYY-MM-DD") + '"' : "") + (e ? " " + e : "") + "></td>";
    },
    renderIntroHtml: function renderIntroHtml() {},
    bookendCells: function bookendCells(t) {
      var e = this.renderIntroHtml();
      e && (this.isRTL ? t.append(e) : t.prepend(e));
    }
  },
      Ut = n.DayGrid = Ot.extend(qt, {
    numbersVisible: !1,
    bottomCoordPadding: 0,
    rowEls: null,
    cellEls: null,
    helperEls: null,
    rowCoordCache: null,
    colCoordCache: null,
    renderDates: function renderDates(t) {
      var e,
          n,
          i = this.view,
          r = this.rowCnt,
          s = this.colCnt,
          o = "";

      for (e = 0; e < r; e++) {
        o += this.renderDayRowHtml(e, t);
      }

      for (this.el.html(o), this.rowEls = this.el.find(".fc-row"), this.cellEls = this.el.find(".fc-day, .fc-disabled-day"), this.rowCoordCache = new Mt({
        els: this.rowEls,
        isVertical: !0
      }), this.colCoordCache = new Mt({
        els: this.cellEls.slice(0, this.colCnt),
        isHorizontal: !0
      }), e = 0; e < r; e++) {
        for (n = 0; n < s; n++) {
          i.publiclyTrigger("dayRender", null, this.getCellDate(e, n), this.getCellEl(e, n));
        }
      }
    },
    unrenderDates: function unrenderDates() {
      this.removeSegPopover();
    },
    renderBusinessHours: function renderBusinessHours() {
      var t = this.buildBusinessHourSegs(!0);
      this.renderFill("businessHours", t, "bgevent");
    },
    unrenderBusinessHours: function unrenderBusinessHours() {
      this.unrenderFill("businessHours");
    },
    renderDayRowHtml: function renderDayRowHtml(t, e) {
      var n = ["fc-row", "fc-week", this.view.widgetContentClass];
      return e && n.push("fc-rigid"), '<div class="' + n.join(" ") + '"><div class="fc-bg"><table>' + this.renderBgTrHtml(t) + '</table></div><div class="fc-content-skeleton"><table>' + (this.numbersVisible ? "<thead>" + this.renderNumberTrHtml(t) + "</thead>" : "") + "</table></div></div>";
    },
    renderNumberTrHtml: function renderNumberTrHtml(t) {
      return "<tr>" + (this.isRTL ? "" : this.renderNumberIntroHtml(t)) + this.renderNumberCellsHtml(t) + (this.isRTL ? this.renderNumberIntroHtml(t) : "") + "</tr>";
    },
    renderNumberIntroHtml: function renderNumberIntroHtml(t) {
      return this.renderIntroHtml();
    },
    renderNumberCellsHtml: function renderNumberCellsHtml(t) {
      var e,
          n,
          i = [];

      for (e = 0; e < this.colCnt; e++) {
        n = this.getCellDate(t, e), i.push(this.renderNumberCellHtml(n));
      }

      return i.join("");
    },
    renderNumberCellHtml: function renderNumberCellHtml(t) {
      var e,
          n,
          i = this.view,
          r = "",
          s = Y(t, i.activeRange),
          o = i.dayNumbersVisible && s;
      return o || i.cellWeekNumbersVisible ? ((e = this.getDayClasses(t)).unshift("fc-day-top"), i.cellWeekNumbersVisible && (n = "ISO" === t._locale._fullCalendar_weekCalc ? 1 : t._locale.firstDayOfWeek()), r += '<td class="' + e.join(" ") + '"' + (s ? ' data-date="' + t.format() + '"' : "") + ">", i.cellWeekNumbersVisible && t.day() == n && (r += i.buildGotoAnchorHtml({
        date: t,
        type: "week"
      }, {
        "class": "fc-week-number"
      }, t.format("w"))), o && (r += i.buildGotoAnchorHtml(t, {
        "class": "fc-day-number"
      }, t.date())), r += "</td>") : "<td/>";
    },
    computeEventTimeFormat: function computeEventTimeFormat() {
      return this.view.opt("extraSmallTimeFormat");
    },
    computeDisplayEventEnd: function computeDisplayEventEnd() {
      return 1 == this.colCnt;
    },
    rangeUpdated: function rangeUpdated() {
      this.updateDayTable();
    },
    spanToSegs: function spanToSegs(t) {
      var e,
          n,
          i = this.sliceRangeByRow(t);

      for (e = 0; e < i.length; e++) {
        n = i[e], this.isRTL ? (n.leftCol = this.daysPerRow - 1 - n.lastRowDayIndex, n.rightCol = this.daysPerRow - 1 - n.firstRowDayIndex) : (n.leftCol = n.firstRowDayIndex, n.rightCol = n.lastRowDayIndex);
      }

      return i;
    },
    prepareHits: function prepareHits() {
      this.colCoordCache.build(), this.rowCoordCache.build(), this.rowCoordCache.bottoms[this.rowCnt - 1] += this.bottomCoordPadding;
    },
    releaseHits: function releaseHits() {
      this.colCoordCache.clear(), this.rowCoordCache.clear();
    },
    queryHit: function queryHit(t, e) {
      if (this.colCoordCache.isLeftInBounds(t) && this.rowCoordCache.isTopInBounds(e)) {
        var n = this.colCoordCache.getHorizontalIndex(t),
            i = this.rowCoordCache.getVerticalIndex(e);
        if (null != i && null != n) return this.getCellHit(i, n);
      }
    },
    getHitSpan: function getHitSpan(t) {
      return this.getCellRange(t.row, t.col);
    },
    getHitEl: function getHitEl(t) {
      return this.getCellEl(t.row, t.col);
    },
    getCellHit: function getCellHit(t, e) {
      return {
        row: t,
        col: e,
        component: this,
        left: this.colCoordCache.getLeftOffset(e),
        right: this.colCoordCache.getRightOffset(e),
        top: this.rowCoordCache.getTopOffset(t),
        bottom: this.rowCoordCache.getBottomOffset(t)
      };
    },
    getCellEl: function getCellEl(t, e) {
      return this.cellEls.eq(t * this.colCnt + e);
    },
    renderDrag: function renderDrag(t, e) {
      var n,
          i = this.eventToSpans(t);

      for (n = 0; n < i.length; n++) {
        this.renderHighlight(i[n]);
      }

      if (e && e.component !== this) return this.renderEventLocationHelper(t, e);
    },
    unrenderDrag: function unrenderDrag() {
      this.unrenderHighlight(), this.unrenderHelper();
    },
    renderEventResize: function renderEventResize(t, e) {
      var n,
          i = this.eventToSpans(t);

      for (n = 0; n < i.length; n++) {
        this.renderHighlight(i[n]);
      }

      return this.renderEventLocationHelper(t, e);
    },
    unrenderEventResize: function unrenderEventResize() {
      this.unrenderHighlight(), this.unrenderHelper();
    },
    renderHelper: function renderHelper(e, n) {
      var i,
          r = [],
          s = this.eventToSegs(e);
      return s = this.renderFgSegEls(s), i = this.renderSegRows(s), this.rowEls.each(function (e, s) {
        var o,
            a = t(s),
            l = t('<div class="fc-helper-skeleton"><table/></div>');
        o = n && n.row === e ? n.el.position().top : a.find(".fc-content-skeleton tbody").position().top, l.css("top", o).find("table").append(i[e].tbodyEl), a.append(l), r.push(l[0]);
      }), this.helperEls = t(r);
    },
    unrenderHelper: function unrenderHelper() {
      this.helperEls && (this.helperEls.remove(), this.helperEls = null);
    },
    fillSegTag: "td",
    renderFill: function renderFill(e, n, i) {
      var r,
          s,
          o,
          a = [];

      for (n = this.renderFillSegEls(e, n), r = 0; r < n.length; r++) {
        s = n[r], o = this.renderFillRow(e, s, i), this.rowEls.eq(s.row).append(o), a.push(o[0]);
      }

      return this.elsByFill[e] = t(a), n;
    },
    renderFillRow: function renderFillRow(e, n, i) {
      var r,
          s,
          o = this.colCnt,
          a = n.leftCol,
          l = n.rightCol + 1;
      return i = i || e.toLowerCase(), s = (r = t('<div class="fc-' + i + '-skeleton"><table><tr/></table></div>')).find("tr"), a > 0 && s.append('<td colspan="' + a + '"/>'), s.append(n.el.attr("colspan", l - a)), l < o && s.append('<td colspan="' + (o - l) + '"/>'), this.bookendCells(s), r;
    }
  });

  function jt(t, e) {
    var n, i;

    for (n = 0; n < e.length; n++) {
      if ((i = e[n]).leftCol <= t.rightCol && i.rightCol >= t.leftCol) return !0;
    }

    return !1;
  }

  function Zt(t, e) {
    return t.leftCol - e.leftCol;
  }

  Ut.mixin({
    rowStructs: null,
    unrenderEvents: function unrenderEvents() {
      this.removeSegPopover(), Ot.prototype.unrenderEvents.apply(this, arguments);
    },
    getEventSegs: function getEventSegs() {
      return Ot.prototype.getEventSegs.call(this).concat(this.popoverSegs || []);
    },
    renderBgSegs: function renderBgSegs(e) {
      var n = t.grep(e, function (t) {
        return t.event.allDay;
      });
      return Ot.prototype.renderBgSegs.call(this, n);
    },
    renderFgSegs: function renderFgSegs(e) {
      var n;
      return e = this.renderFgSegEls(e), n = this.rowStructs = this.renderSegRows(e), this.rowEls.each(function (e, i) {
        t(i).find(".fc-content-skeleton > table").append(n[e].tbodyEl);
      }), e;
    },
    unrenderFgSegs: function unrenderFgSegs() {
      for (var t, e = this.rowStructs || []; t = e.pop();) {
        t.tbodyEl.remove();
      }

      this.rowStructs = null;
    },
    renderSegRows: function renderSegRows(t) {
      var e,
          n,
          i = [];

      for (e = this.groupSegRows(t), n = 0; n < e.length; n++) {
        i.push(this.renderSegRow(n, e[n]));
      }

      return i;
    },
    fgSegHtml: function fgSegHtml(t, e) {
      var n,
          i,
          r = this.view,
          s = t.event,
          o = r.isEventDraggable(s),
          a = !e && s.allDay && t.isStart && r.isEventResizableFromStart(s),
          l = !e && s.allDay && t.isEnd && r.isEventResizableFromEnd(s),
          u = this.getSegClasses(t, o, a || l),
          h = it(this.getSegSkinCss(t)),
          c = "";
      return u.unshift("fc-day-grid-event", "fc-h-event"), t.isStart && (n = this.getEventTimeText(s)) && (c = '<span class="fc-time">' + et(n) + "</span>"), i = '<span class="fc-title">' + (et(s.title || "") || "&nbsp;") + "</span>", '<a class="' + u.join(" ") + '"' + (s.url ? ' href="' + et(s.url) + '"' : "") + (h ? ' style="' + h + '"' : "") + '><div class="fc-content">' + (this.isRTL ? i + " " + c : c + " " + i) + "</div>" + (a ? '<div class="fc-resizer fc-start-resizer" />' : "") + (l ? '<div class="fc-resizer fc-end-resizer" />' : "") + "</a>";
    },
    renderSegRow: function renderSegRow(e, n) {
      var i,
          r,
          s,
          o,
          a,
          l,
          u,
          h = this.colCnt,
          c = this.buildSegLevels(n),
          d = Math.max(1, c.length),
          f = t("<tbody/>"),
          g = [],
          p = [],
          v = [];

      function m(e) {
        for (; s < e;) {
          (u = (v[i - 1] || [])[s]) ? u.attr("rowspan", parseInt(u.attr("rowspan") || 1, 10) + 1) : (u = t("<td/>"), o.append(u)), p[i][s] = u, v[i][s] = u, s++;
        }
      }

      for (i = 0; i < d; i++) {
        if (r = c[i], s = 0, o = t("<tr/>"), g.push([]), p.push([]), v.push([]), r) for (a = 0; a < r.length; a++) {
          for (m((l = r[a]).leftCol), u = t('<td class="fc-event-container"/>').append(l.el), l.leftCol != l.rightCol ? u.attr("colspan", l.rightCol - l.leftCol + 1) : v[i][s] = u; s <= l.rightCol;) {
            p[i][s] = u, g[i][s] = l, s++;
          }

          o.append(u);
        }
        m(h), this.bookendCells(o), f.append(o);
      }

      return {
        row: e,
        tbodyEl: f,
        cellMatrix: p,
        segMatrix: g,
        segLevels: c,
        segs: n
      };
    },
    buildSegLevels: function buildSegLevels(t) {
      var e,
          n,
          i,
          r = [];

      for (this.sortEventSegs(t), e = 0; e < t.length; e++) {
        for (n = t[e], i = 0; i < r.length && jt(n, r[i]); i++) {
          ;
        }

        n.level = i, (r[i] || (r[i] = [])).push(n);
      }

      for (i = 0; i < r.length; i++) {
        r[i].sort(Zt);
      }

      return r;
    },
    groupSegRows: function groupSegRows(t) {
      var e,
          n = [];

      for (e = 0; e < this.rowCnt; e++) {
        n.push([]);
      }

      for (e = 0; e < t.length; e++) {
        n[t[e].row].push(t[e]);
      }

      return n;
    }
  }), Ut.mixin({
    segPopover: null,
    popoverSegs: null,
    removeSegPopover: function removeSegPopover() {
      this.segPopover && this.segPopover.hide();
    },
    limitRows: function limitRows(t) {
      var e,
          n,
          i = this.rowStructs || [];

      for (e = 0; e < i.length; e++) {
        this.unlimitRow(e), !1 !== (n = !!t && ("number" == typeof t ? t : this.computeRowLevelLimit(e))) && this.limitRow(e, n);
      }
    },
    computeRowLevelLimit: function computeRowLevelLimit(e) {
      var n,
          i,
          r,
          s = this.rowEls.eq(e).height(),
          o = this.rowStructs[e].tbodyEl.children();

      function a(e, n) {
        r = Math.max(r, t(n).outerHeight());
      }

      for (n = 0; n < o.length; n++) {
        if (i = o.eq(n).removeClass("fc-limited"), r = 0, i.find("> td > :first-child").each(a), i.position().top + r > s) return n;
      }

      return !1;
    },
    limitRow: function limitRow(e, n) {
      var i,
          r,
          s,
          o,
          a,
          l,
          u,
          h,
          c,
          d,
          f,
          g,
          p,
          v,
          m,
          y = this,
          w = this.rowStructs[e],
          S = [],
          b = 0;

      function E(i) {
        for (; b < i;) {
          (l = y.getCellSegs(e, b, n)).length && (c = r[n - 1][b], m = y.renderMoreLink(e, b, l), v = t("<div/>").append(m), c.append(v), S.push(v[0])), b++;
        }
      }

      if (n && n < w.segLevels.length) {
        for (i = w.segLevels[n - 1], r = w.cellMatrix, s = w.tbodyEl.children().slice(n).addClass("fc-limited").get(), o = 0; o < i.length; o++) {
          for (E((a = i[o]).leftCol), h = [], u = 0; b <= a.rightCol;) {
            l = this.getCellSegs(e, b, n), h.push(l), u += l.length, b++;
          }

          if (u) {
            for (d = (c = r[n - 1][a.leftCol]).attr("rowspan") || 1, f = [], g = 0; g < h.length; g++) {
              p = t('<td class="fc-more-cell"/>').attr("rowspan", d), l = h[g], m = this.renderMoreLink(e, a.leftCol + g, [a].concat(l)), v = t("<div/>").append(m), p.append(v), f.push(p[0]), S.push(p[0]);
            }

            c.addClass("fc-limited").after(t(f)), s.push(c[0]);
          }
        }

        E(this.colCnt), w.moreEls = t(S), w.limitedEls = t(s);
      }
    },
    unlimitRow: function unlimitRow(t) {
      var e = this.rowStructs[t];
      e.moreEls && (e.moreEls.remove(), e.moreEls = null), e.limitedEls && (e.limitedEls.removeClass("fc-limited"), e.limitedEls = null);
    },
    renderMoreLink: function renderMoreLink(e, n, i) {
      var r = this,
          s = this.view;
      return t('<a class="fc-more"/>').text(this.getMoreLinkText(i.length)).on("click", function (o) {
        var a = s.opt("eventLimitClick"),
            l = r.getCellDate(e, n),
            u = t(this),
            h = r.getCellEl(e, n),
            c = r.getCellSegs(e, n),
            d = r.resliceDaySegs(c, l),
            f = r.resliceDaySegs(i, l);
        "function" == typeof a && (a = s.publiclyTrigger("eventLimitClick", null, {
          date: l,
          dayEl: h,
          moreEl: u,
          segs: d,
          hiddenSegs: f
        }, o)), "popover" === a ? r.showSegPopover(e, n, u, d) : "string" == typeof a && s.calendar.zoomTo(l, a);
      });
    },
    showSegPopover: function showSegPopover(t, e, n, i) {
      var r,
          s,
          o = this,
          a = this.view,
          l = n.parent();
      r = 1 == this.rowCnt ? a.el : this.rowEls.eq(t), s = {
        className: "fc-more-popover",
        content: this.renderSegPopoverContent(t, e, i),
        parentEl: this.view.el,
        top: r.offset().top,
        autoHide: !0,
        viewportConstrain: a.opt("popoverViewportConstrain"),
        hide: function hide() {
          if (o.popoverSegs) for (var t, e = 0; e < o.popoverSegs.length; ++e) {
            t = o.popoverSegs[e], a.publiclyTrigger("eventDestroy", t.event, t.event, t.el);
          }
          o.segPopover.removeElement(), o.segPopover = null, o.popoverSegs = null;
        }
      }, this.isRTL ? s.right = l.offset().left + l.outerWidth() + 1 : s.left = l.offset().left - 1, this.segPopover = new kt(s), this.segPopover.show(), this.bindSegHandlersToEl(this.segPopover.el);
    },
    renderSegPopoverContent: function renderSegPopoverContent(e, n, i) {
      var r,
          s = this.view,
          o = s.opt("theme"),
          a = this.getCellDate(e, n).format(s.opt("dayPopoverFormat")),
          l = t('<div class="fc-header ' + s.widgetHeaderClass + '"><span class="fc-close ' + (o ? "ui-icon ui-icon-closethick" : "fc-icon fc-icon-x") + '"></span><span class="fc-title">' + et(a) + '</span><div class="fc-clear"/></div><div class="fc-body ' + s.widgetContentClass + '"><div class="fc-event-container"></div></div>'),
          u = l.find(".fc-event-container");

      for (i = this.renderFgSegEls(i, !0), this.popoverSegs = i, r = 0; r < i.length; r++) {
        this.hitsNeeded(), i[r].hit = this.getCellHit(e, n), this.hitsNotNeeded(), u.append(i[r].el);
      }

      return l;
    },
    resliceDaySegs: function resliceDaySegs(e, n) {
      var i = t.map(e, function (t) {
        return t.event;
      }),
          r = n.clone(),
          s = r.clone().add(1, "days"),
          o = {
        start: r,
        end: s
      };
      return e = this.eventsToSegs(i, function (t) {
        var e = B(t, o);
        return e ? [e] : [];
      }), this.sortEventSegs(e), e;
    },
    getMoreLinkText: function getMoreLinkText(t) {
      var e = this.view.opt("eventLimitText");
      return "function" == typeof e ? e(t) : "+" + t + " " + e;
    },
    getCellSegs: function getCellSegs(t, e, n) {
      for (var i, r = this.rowStructs[t].segMatrix, s = n || 0, o = []; s < r.length;) {
        (i = r[s][e]) && o.push(i), s++;
      }

      return o;
    }
  });
  var $t = n.TimeGrid = Ot.extend(qt, {
    slotDuration: null,
    snapDuration: null,
    snapsPerSlot: null,
    labelFormat: null,
    labelInterval: null,
    colEls: null,
    slatContainerEl: null,
    slatEls: null,
    nowIndicatorEls: null,
    colCoordCache: null,
    slatCoordCache: null,
    constructor: function constructor() {
      Ot.apply(this, arguments), this.processOptions();
    },
    renderDates: function renderDates() {
      this.el.html(this.renderHtml()), this.colEls = this.el.find(".fc-day, .fc-disabled-day"), this.slatContainerEl = this.el.find(".fc-slats"), this.slatEls = this.slatContainerEl.find("tr"), this.colCoordCache = new Mt({
        els: this.colEls,
        isHorizontal: !0
      }), this.slatCoordCache = new Mt({
        els: this.slatEls,
        isVertical: !0
      }), this.renderContentSkeleton();
    },
    renderHtml: function renderHtml() {
      return '<div class="fc-bg"><table>' + this.renderBgTrHtml(0) + '</table></div><div class="fc-slats"><table>' + this.renderSlatRowHtml() + "</table></div>";
    },
    renderSlatRowHtml: function renderSlatRowHtml() {
      for (var t, n, i, r = this.view, s = this.isRTL, o = "", a = e.duration(+this.view.minTime); a < this.view.maxTime;) {
        t = this.start.clone().time(a), n = ot(O(a, this.labelInterval)), i = '<td class="fc-axis fc-time ' + r.widgetContentClass + '" ' + r.axisStyleAttr() + ">" + (n ? "<span>" + et(t.format(this.labelFormat)) + "</span>" : "") + "</td>", o += '<tr data-time="' + t.format("HH:mm:ss") + '"' + (n ? "" : ' class="fc-minor"') + ">" + (s ? "" : i) + '<td class="' + r.widgetContentClass + '"/>' + (s ? i : "") + "</tr>", a.add(this.slotDuration);
      }

      return o;
    },
    processOptions: function processOptions() {
      var n,
          i = this.view,
          r = i.opt("slotDuration"),
          s = i.opt("snapDuration");
      r = e.duration(r), s = s ? e.duration(s) : r, this.slotDuration = r, this.snapDuration = s, this.snapsPerSlot = r / s, this.minResizeDuration = s, n = i.opt("slotLabelFormat"), t.isArray(n) && (n = n[n.length - 1]), this.labelFormat = n || i.opt("smallTimeFormat"), n = i.opt("slotLabelInterval"), this.labelInterval = n ? e.duration(n) : this.computeLabelInterval(r);
    },
    computeLabelInterval: function computeLabelInterval(t) {
      var n, i, r;

      for (n = Se.length - 1; n >= 0; n--) {
        if (ot(r = O(i = e.duration(Se[n]), t)) && r > 1) return i;
      }

      return e.duration(t);
    },
    computeEventTimeFormat: function computeEventTimeFormat() {
      return this.view.opt("noMeridiemTimeFormat");
    },
    computeDisplayEventEnd: function computeDisplayEventEnd() {
      return !0;
    },
    prepareHits: function prepareHits() {
      this.colCoordCache.build(), this.slatCoordCache.build();
    },
    releaseHits: function releaseHits() {
      this.colCoordCache.clear();
    },
    queryHit: function queryHit(t, e) {
      var n = this.snapsPerSlot,
          i = this.colCoordCache,
          r = this.slatCoordCache;

      if (i.isLeftInBounds(t) && r.isTopInBounds(e)) {
        var s = i.getHorizontalIndex(t),
            o = r.getVerticalIndex(e);

        if (null != s && null != o) {
          var a = r.getTopOffset(o),
              l = r.getHeight(o),
              u = (e - a) / l,
              h = Math.floor(u * n),
              c = a + h / n * l,
              d = a + (h + 1) / n * l;
          return {
            col: s,
            snap: o * n + h,
            component: this,
            left: i.getLeftOffset(s),
            right: i.getRightOffset(s),
            top: c,
            bottom: d
          };
        }
      }
    },
    getHitSpan: function getHitSpan(t) {
      var e,
          n = this.getCellDate(0, t.col),
          i = this.computeSnapTime(t.snap);
      return n.time(i), e = n.clone().add(this.snapDuration), {
        start: n,
        end: e
      };
    },
    getHitEl: function getHitEl(t) {
      return this.colEls.eq(t.col);
    },
    rangeUpdated: function rangeUpdated() {
      this.updateDayTable();
    },
    computeSnapTime: function computeSnapTime(t) {
      return e.duration(this.view.minTime + this.snapDuration * t);
    },
    spanToSegs: function spanToSegs(t) {
      var e,
          n = this.sliceRangeByTimes(t);

      for (e = 0; e < n.length; e++) {
        this.isRTL ? n[e].col = this.daysPerRow - 1 - n[e].dayIndex : n[e].col = n[e].dayIndex;
      }

      return n;
    },
    sliceRangeByTimes: function sliceRangeByTimes(t) {
      var e,
          n,
          i,
          r = [];

      for (n = 0; n < this.daysPerRow; n++) {
        (e = B(t, {
          start: (i = this.dayDates[n].clone().time(0)).clone().add(this.view.minTime),
          end: i.clone().add(this.view.maxTime)
        })) && (e.dayIndex = n, r.push(e));
      }

      return r;
    },
    updateSize: function updateSize(t) {
      this.slatCoordCache.build(), t && this.updateSegVerticals([].concat(this.fgSegs || [], this.bgSegs || [], this.businessSegs || []));
    },
    getTotalSlatHeight: function getTotalSlatHeight() {
      return this.slatContainerEl.outerHeight();
    },
    computeDateTop: function computeDateTop(t, n) {
      return this.computeTimeTop(e.duration(t - n.clone().stripTime()));
    },
    computeTimeTop: function computeTimeTop(t) {
      var e,
          n,
          i = this.slatEls.length,
          r = (t - this.view.minTime) / this.slotDuration;
      return r = Math.max(0, r), r = Math.min(i, r), e = Math.floor(r), n = r - (e = Math.min(e, i - 1)), this.slatCoordCache.getTopPosition(e) + this.slatCoordCache.getHeight(e) * n;
    },
    renderDrag: function renderDrag(t, e) {
      var n, i;
      if (e) return this.renderEventLocationHelper(t, e);

      for (n = this.eventToSpans(t), i = 0; i < n.length; i++) {
        this.renderHighlight(n[i]);
      }
    },
    unrenderDrag: function unrenderDrag() {
      this.unrenderHelper(), this.unrenderHighlight();
    },
    renderEventResize: function renderEventResize(t, e) {
      return this.renderEventLocationHelper(t, e);
    },
    unrenderEventResize: function unrenderEventResize() {
      this.unrenderHelper();
    },
    renderHelper: function renderHelper(t, e) {
      return this.renderHelperSegs(this.eventToSegs(t), e);
    },
    unrenderHelper: function unrenderHelper() {
      this.unrenderHelperSegs();
    },
    renderBusinessHours: function renderBusinessHours() {
      this.renderBusinessSegs(this.buildBusinessHourSegs());
    },
    unrenderBusinessHours: function unrenderBusinessHours() {
      this.unrenderBusinessSegs();
    },
    getNowIndicatorUnit: function getNowIndicatorUnit() {
      return "minute";
    },
    renderNowIndicator: function renderNowIndicator(e) {
      var n,
          i = this.spanToSegs({
        start: e,
        end: e
      }),
          r = this.computeDateTop(e, e),
          s = [];

      for (n = 0; n < i.length; n++) {
        s.push(t('<div class="fc-now-indicator fc-now-indicator-line"></div>').css("top", r).appendTo(this.colContainerEls.eq(i[n].col))[0]);
      }

      i.length > 0 && s.push(t('<div class="fc-now-indicator fc-now-indicator-arrow"></div>').css("top", r).appendTo(this.el.find(".fc-content-skeleton"))[0]), this.nowIndicatorEls = t(s);
    },
    unrenderNowIndicator: function unrenderNowIndicator() {
      this.nowIndicatorEls && (this.nowIndicatorEls.remove(), this.nowIndicatorEls = null);
    },
    renderSelection: function renderSelection(t) {
      this.view.opt("selectHelper") ? this.renderEventLocationHelper(t) : this.renderHighlight(t);
    },
    unrenderSelection: function unrenderSelection() {
      this.unrenderHelper(), this.unrenderHighlight();
    },
    renderHighlight: function renderHighlight(t) {
      this.renderHighlightSegs(this.spanToSegs(t));
    },
    unrenderHighlight: function unrenderHighlight() {
      this.unrenderHighlightSegs();
    }
  });

  function Qt(t) {
    var e,
        n,
        i = t.forwardSegs,
        r = 0;

    if (void 0 === t.forwardPressure) {
      for (e = 0; e < i.length; e++) {
        Qt(n = i[e]), r = Math.max(r, 1 + n.forwardPressure);
      }

      t.forwardPressure = r;
    }
  }

  function Xt(t, e, n) {
    n = n || [];

    for (var i = 0; i < e.length; i++) {
      r = t, s = e[i], r.bottom > s.top && r.top < s.bottom && n.push(e[i]);
    }

    var r, s;
    return n;
  }

  $t.mixin({
    colContainerEls: null,
    fgContainerEls: null,
    bgContainerEls: null,
    helperContainerEls: null,
    highlightContainerEls: null,
    businessContainerEls: null,
    fgSegs: null,
    bgSegs: null,
    helperSegs: null,
    highlightSegs: null,
    businessSegs: null,
    renderContentSkeleton: function renderContentSkeleton() {
      var e,
          n,
          i = "";

      for (e = 0; e < this.colCnt; e++) {
        i += '<td><div class="fc-content-col"><div class="fc-event-container fc-helper-container"></div><div class="fc-event-container"></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td>';
      }

      n = t('<div class="fc-content-skeleton"><table><tr>' + i + "</tr></table></div>"), this.colContainerEls = n.find(".fc-content-col"), this.helperContainerEls = n.find(".fc-helper-container"), this.fgContainerEls = n.find(".fc-event-container:not(.fc-helper-container)"), this.bgContainerEls = n.find(".fc-bgevent-container"), this.highlightContainerEls = n.find(".fc-highlight-container"), this.businessContainerEls = n.find(".fc-business-container"), this.bookendCells(n.find("tr")), this.el.append(n);
    },
    renderFgSegs: function renderFgSegs(t) {
      return t = this.renderFgSegsIntoContainers(t, this.fgContainerEls), this.fgSegs = t, t;
    },
    unrenderFgSegs: function unrenderFgSegs() {
      this.unrenderNamedSegs("fgSegs");
    },
    renderHelperSegs: function renderHelperSegs(e, n) {
      var i,
          r,
          s,
          o = [];

      for (e = this.renderFgSegsIntoContainers(e, this.helperContainerEls), i = 0; i < e.length; i++) {
        r = e[i], n && n.col === r.col && (s = n.el, r.el.css({
          left: s.css("left"),
          right: s.css("right"),
          "margin-left": s.css("margin-left"),
          "margin-right": s.css("margin-right")
        })), o.push(r.el[0]);
      }

      return this.helperSegs = e, t(o);
    },
    unrenderHelperSegs: function unrenderHelperSegs() {
      this.unrenderNamedSegs("helperSegs");
    },
    renderBgSegs: function renderBgSegs(t) {
      return t = this.renderFillSegEls("bgEvent", t), this.updateSegVerticals(t), this.attachSegsByCol(this.groupSegsByCol(t), this.bgContainerEls), this.bgSegs = t, t;
    },
    unrenderBgSegs: function unrenderBgSegs() {
      this.unrenderNamedSegs("bgSegs");
    },
    renderHighlightSegs: function renderHighlightSegs(t) {
      t = this.renderFillSegEls("highlight", t), this.updateSegVerticals(t), this.attachSegsByCol(this.groupSegsByCol(t), this.highlightContainerEls), this.highlightSegs = t;
    },
    unrenderHighlightSegs: function unrenderHighlightSegs() {
      this.unrenderNamedSegs("highlightSegs");
    },
    renderBusinessSegs: function renderBusinessSegs(t) {
      t = this.renderFillSegEls("businessHours", t), this.updateSegVerticals(t), this.attachSegsByCol(this.groupSegsByCol(t), this.businessContainerEls), this.businessSegs = t;
    },
    unrenderBusinessSegs: function unrenderBusinessSegs() {
      this.unrenderNamedSegs("businessSegs");
    },
    groupSegsByCol: function groupSegsByCol(t) {
      var e,
          n = [];

      for (e = 0; e < this.colCnt; e++) {
        n.push([]);
      }

      for (e = 0; e < t.length; e++) {
        n[t[e].col].push(t[e]);
      }

      return n;
    },
    attachSegsByCol: function attachSegsByCol(t, e) {
      var n, i, r;

      for (n = 0; n < this.colCnt; n++) {
        for (i = t[n], r = 0; r < i.length; r++) {
          e.eq(n).append(i[r].el);
        }
      }
    },
    unrenderNamedSegs: function unrenderNamedSegs(t) {
      var e,
          n = this[t];

      if (n) {
        for (e = 0; e < n.length; e++) {
          n[e].el.remove();
        }

        this[t] = null;
      }
    },
    renderFgSegsIntoContainers: function renderFgSegsIntoContainers(t, e) {
      var n, i;

      for (t = this.renderFgSegEls(t), n = this.groupSegsByCol(t), i = 0; i < this.colCnt; i++) {
        this.updateFgSegCoords(n[i]);
      }

      return this.attachSegsByCol(n, e), t;
    },
    fgSegHtml: function fgSegHtml(t, e) {
      var n,
          i,
          r,
          s = this.view,
          o = t.event,
          a = s.isEventDraggable(o),
          l = !e && t.isStart && s.isEventResizableFromStart(o),
          u = !e && t.isEnd && s.isEventResizableFromEnd(o),
          h = this.getSegClasses(t, a, l || u),
          c = it(this.getSegSkinCss(t));
      return h.unshift("fc-time-grid-event", "fc-v-event"), s.isMultiDayEvent(o) ? (t.isStart || t.isEnd) && (n = this.getEventTimeText(t), i = this.getEventTimeText(t, "LT"), r = this.getEventTimeText(t, null, !1)) : (n = this.getEventTimeText(o), i = this.getEventTimeText(o, "LT"), r = this.getEventTimeText(o, null, !1)), '<a class="' + h.join(" ") + '"' + (o.url ? ' href="' + et(o.url) + '"' : "") + (c ? ' style="' + c + '"' : "") + '><div class="fc-content">' + (n ? '<div class="fc-time" data-start="' + et(r) + '" data-full="' + et(i) + '"><span>' + et(n) + "</span></div>" : "") + (o.title ? '<div class="fc-title">' + et(o.title) + "</div>" : "") + '</div><div class="fc-bg"/>' + (u ? '<div class="fc-resizer fc-end-resizer" />' : "") + "</a>";
    },
    updateSegVerticals: function updateSegVerticals(t) {
      this.computeSegVerticals(t), this.assignSegVerticals(t);
    },
    computeSegVerticals: function computeSegVerticals(t) {
      var e, n, i;

      for (e = 0; e < t.length; e++) {
        n = t[e], i = this.dayDates[n.dayIndex], n.top = this.computeDateTop(n.start, i), n.bottom = this.computeDateTop(n.end, i);
      }
    },
    assignSegVerticals: function assignSegVerticals(t) {
      var e, n;

      for (e = 0; e < t.length; e++) {
        (n = t[e]).el.css(this.generateSegVerticalCss(n));
      }
    },
    generateSegVerticalCss: function generateSegVerticalCss(t) {
      return {
        top: t.top,
        bottom: -t.bottom
      };
    },
    updateFgSegCoords: function updateFgSegCoords(t) {
      this.computeSegVerticals(t), this.computeFgSegHorizontals(t), this.assignSegVerticals(t), this.assignFgSegHorizontals(t);
    },
    computeFgSegHorizontals: function computeFgSegHorizontals(t) {
      var e, n, i;

      if (this.sortEventSegs(t), function (t) {
        var e, n, i, r, s;

        for (e = 0; e < t.length; e++) {
          for (n = t[e], i = 0; i < n.length; i++) {
            for ((r = n[i]).forwardSegs = [], s = e + 1; s < t.length; s++) {
              Xt(r, t[s], r.forwardSegs);
            }
          }
        }
      }(e = function (t) {
        var e,
            n,
            i,
            r = [];

        for (e = 0; e < t.length; e++) {
          for (n = t[e], i = 0; i < r.length && Xt(n, r[i]).length; i++) {
            ;
          }

          n.level = i, (r[i] || (r[i] = [])).push(n);
        }

        return r;
      }(t)), n = e[0]) {
        for (i = 0; i < n.length; i++) {
          Qt(n[i]);
        }

        for (i = 0; i < n.length; i++) {
          this.computeFgSegForwardBack(n[i], 0, 0);
        }
      }
    },
    computeFgSegForwardBack: function computeFgSegForwardBack(t, e, n) {
      var i,
          r = t.forwardSegs;
      if (void 0 === t.forwardCoord) for (r.length ? (this.sortForwardSegs(r), this.computeFgSegForwardBack(r[0], e + 1, n), t.forwardCoord = r[0].backwardCoord) : t.forwardCoord = 1, t.backwardCoord = t.forwardCoord - (t.forwardCoord - n) / (e + 1), i = 0; i < r.length; i++) {
        this.computeFgSegForwardBack(r[i], 0, t.forwardCoord);
      }
    },
    sortForwardSegs: function sortForwardSegs(t) {
      t.sort(at(this, "compareForwardSegs"));
    },
    compareForwardSegs: function compareForwardSegs(t, e) {
      return e.forwardPressure - t.forwardPressure || (t.backwardCoord || 0) - (e.backwardCoord || 0) || this.compareEventSegs(t, e);
    },
    assignFgSegHorizontals: function assignFgSegHorizontals(t) {
      var e, n;

      for (e = 0; e < t.length; e++) {
        (n = t[e]).el.css(this.generateFgSegHorizontalCss(n)), n.bottom - n.top < 30 && n.el.addClass("fc-short");
      }
    },
    generateFgSegHorizontalCss: function generateFgSegHorizontalCss(t) {
      var e,
          n,
          i = this.view.opt("slotEventOverlap"),
          r = t.backwardCoord,
          s = t.forwardCoord,
          o = this.generateSegVerticalCss(t);
      return i && (s = Math.min(1, r + 2 * (s - r))), this.isRTL ? (e = 1 - s, n = r) : (e = r, n = 1 - s), o.zIndex = t.level + 1, o.left = 100 * e + "%", o.right = 100 * n + "%", i && t.forwardPressure && (o[this.isRTL ? "marginLeft" : "marginRight"] = 20), o;
    }
  });
  var Kt = n.View = bt.extend({
    type: null,
    name: null,
    title: null,
    calendar: null,
    viewSpec: null,
    options: null,
    el: null,
    renderQueue: null,
    batchRenderDepth: 0,
    isDatesRendered: !1,
    isEventsRendered: !1,
    isBaseRendered: !1,
    queuedScroll: null,
    isRTL: !1,
    isSelected: !1,
    selectedEvent: null,
    eventOrderSpecs: null,
    widgetHeaderClass: null,
    widgetContentClass: null,
    highlightStateClass: null,
    nextDayThreshold: null,
    isHiddenDayHash: null,
    isNowIndicatorRendered: null,
    initialNowDate: null,
    initialNowQueriedMs: null,
    nowIndicatorTimeoutID: null,
    nowIndicatorIntervalID: null,
    constructor: function constructor(t, n) {
      bt.prototype.constructor.call(this), this.calendar = t, this.viewSpec = n, this.type = n.type, this.options = n.options, this.name = this.type, this.nextDayThreshold = e.duration(this.opt("nextDayThreshold")), this.initThemingProps(), this.initHiddenDays(), this.isRTL = this.opt("isRTL"), this.eventOrderSpecs = x(this.opt("eventOrder")), this.renderQueue = this.buildRenderQueue(), this.initAutoBatchRender(), this.initialize();
    },
    buildRenderQueue: function buildRenderQueue() {
      var t = this,
          e = new Ht({
        event: this.opt("eventRenderWait")
      });
      return e.on("start", function () {
        t.freezeHeight(), t.addScroll(t.queryScroll());
      }), e.on("stop", function () {
        t.thawHeight(), t.popScroll();
      }), e;
    },
    initAutoBatchRender: function initAutoBatchRender() {
      var t = this;
      this.on("before:change", function () {
        t.startBatchRender();
      }), this.on("change", function () {
        t.stopBatchRender();
      });
    },
    startBatchRender: function startBatchRender() {
      this.batchRenderDepth++ || this.renderQueue.pause();
    },
    stopBatchRender: function stopBatchRender() {
      --this.batchRenderDepth || this.renderQueue.resume();
    },
    initialize: function initialize() {},
    opt: function opt(t) {
      return this.options[t];
    },
    publiclyTrigger: function publiclyTrigger(t, e) {
      var n = this.calendar;
      return n.publiclyTrigger.apply(n, [t, e || this].concat(Array.prototype.slice.call(arguments, 2), [this]));
    },
    updateTitle: function updateTitle() {
      this.title = this.computeTitle(), this.calendar.setToolbarsTitle(this.title);
    },
    computeTitle: function computeTitle() {
      var t;
      return t = /^(year|month)$/.test(this.currentRangeUnit) ? this.currentRange : this.activeRange, this.formatRange({
        start: this.calendar.applyTimezone(t.start),
        end: this.calendar.applyTimezone(t.end)
      }, this.opt("titleFormat") || this.computeTitleFormat(), this.opt("titleRangeSeparator"));
    },
    computeTitleFormat: function computeTitleFormat() {
      return "year" == this.currentRangeUnit ? "YYYY" : "month" == this.currentRangeUnit ? this.opt("monthYearFormat") : this.currentRangeAs("days") > 1 ? "ll" : "LL";
    },
    formatRange: function formatRange(t, e, n) {
      var i = t.end;
      return i.hasTime() || (i = i.clone().subtract(1)), mt(t.start, i, e, n, this.opt("isRTL"));
    },
    getAllDayHtml: function getAllDayHtml() {
      return this.opt("allDayHtml") || et(this.opt("allDayText"));
    },
    buildGotoAnchorHtml: function buildGotoAnchorHtml(e, i, r) {
      var s, o, a, l;
      return t.isPlainObject(e) ? (s = e.date, o = e.type, a = e.forceOff) : s = e, l = {
        date: (s = n.moment(s)).format("YYYY-MM-DD"),
        type: o || "day"
      }, "string" == typeof i && (r = i, i = null), i = i ? " " + function (e) {
        var n = [];
        return t.each(e, function (t, e) {
          null != e && n.push(t + '="' + et(e) + '"');
        }), n.join(" ");
      }(i) : "", r = r || "", !a && this.opt("navLinks") ? "<a" + i + ' data-goto="' + et(JSON.stringify(l)) + '">' + r + "</a>" : "<span" + i + ">" + r + "</span>";
    },
    setElement: function setElement(t) {
      this.el = t, this.bindGlobalHandlers(), this.bindBaseRenderHandlers(), this.renderSkeleton();
    },
    removeElement: function removeElement() {
      this.unsetDate(), this.unrenderSkeleton(), this.unbindGlobalHandlers(), this.unbindBaseRenderHandlers(), this.el.remove();
    },
    renderSkeleton: function renderSkeleton() {},
    unrenderSkeleton: function unrenderSkeleton() {},
    setDate: function setDate(t) {
      var e,
          n,
          i = this.get("dateProfile"),
          r = this.buildDateProfile(t, null, !0);
      return i && (e = i.activeRange, n = r.activeRange, (e.start && n.start && e.start.isSame(n.start) || !e.start && !n.start) && (e.end && n.end && e.end.isSame(n.end) || !e.end && !n.end)) || this.set("dateProfile", r), r.date;
    },
    unsetDate: function unsetDate() {
      this.unset("dateProfile");
    },
    requestDateRender: function requestDateRender(t) {
      var e = this;
      this.renderQueue.queue(function () {
        e.executeDateRender(t);
      }, "date", "init");
    },
    requestDateUnrender: function requestDateUnrender() {
      var t = this;
      this.renderQueue.queue(function () {
        t.executeDateUnrender();
      }, "date", "destroy");
    },
    fetchInitialEvents: function fetchInitialEvents(t) {
      return this.calendar.requestEvents(t.activeRange.start, t.activeRange.end);
    },
    bindEventChanges: function bindEventChanges() {
      this.listenTo(this.calendar, "eventsReset", this.resetEvents);
    },
    unbindEventChanges: function unbindEventChanges() {
      this.stopListeningTo(this.calendar, "eventsReset");
    },
    setEvents: function setEvents(t) {
      this.set("currentEvents", t), this.set("hasEvents", !0);
    },
    unsetEvents: function unsetEvents() {
      this.unset("currentEvents"), this.unset("hasEvents");
    },
    resetEvents: function resetEvents(t) {
      this.startBatchRender(), this.unsetEvents(), this.setEvents(t), this.stopBatchRender();
    },
    requestEventsRender: function requestEventsRender(t) {
      var e = this;
      this.renderQueue.queue(function () {
        e.executeEventsRender(t);
      }, "event", "init");
    },
    requestEventsUnrender: function requestEventsUnrender() {
      var t = this;
      this.renderQueue.queue(function () {
        t.executeEventsUnrender();
      }, "event", "destroy");
    },
    executeDateRender: function executeDateRender(t, e) {
      this.setDateProfileForRendering(t), this.updateTitle(), this.calendar.updateToolbarButtons(), this.render && this.render(), this.renderDates(), this.updateSize(), this.renderBusinessHours(), this.startNowIndicator(), e || this.addScroll(this.computeInitialDateScroll()), this.isDatesRendered = !0, this.trigger("datesRendered");
    },
    executeDateUnrender: function executeDateUnrender() {
      this.unselect(), this.stopNowIndicator(), this.trigger("before:datesUnrendered"), this.unrenderBusinessHours(), this.unrenderDates(), this.destroy && this.destroy(), this.isDatesRendered = !1;
    },
    renderDates: function renderDates() {},
    unrenderDates: function unrenderDates() {},
    bindBaseRenderHandlers: function bindBaseRenderHandlers() {
      var t = this;
      this.on("datesRendered.baseHandler", function () {
        t.onBaseRender();
      }), this.on("before:datesUnrendered.baseHandler", function () {
        t.onBeforeBaseUnrender();
      });
    },
    unbindBaseRenderHandlers: function unbindBaseRenderHandlers() {
      this.off(".baseHandler");
    },
    onBaseRender: function onBaseRender() {
      this.applyScreenState(), this.publiclyTrigger("viewRender", this, this, this.el);
    },
    onBeforeBaseUnrender: function onBeforeBaseUnrender() {
      this.applyScreenState(), this.publiclyTrigger("viewDestroy", this, this, this.el);
    },
    bindGlobalHandlers: function bindGlobalHandlers() {
      this.listenTo(Gt.get(), {
        touchstart: this.processUnselect,
        mousedown: this.handleDocumentMousedown
      });
    },
    unbindGlobalHandlers: function unbindGlobalHandlers() {
      this.stopListeningTo(Gt.get());
    },
    initThemingProps: function initThemingProps() {
      var t = this.opt("theme") ? "ui" : "fc";
      this.widgetHeaderClass = t + "-widget-header", this.widgetContentClass = t + "-widget-content", this.highlightStateClass = t + "-state-highlight";
    },
    renderBusinessHours: function renderBusinessHours() {},
    unrenderBusinessHours: function unrenderBusinessHours() {},
    startNowIndicator: function startNowIndicator() {
      var t,
          n,
          i,
          r = this;
      this.opt("nowIndicator") && (t = this.getNowIndicatorUnit()) && (n = at(this, "updateNowIndicator"), this.initialNowDate = this.calendar.getNow(), this.initialNowQueriedMs = +new Date(), this.renderNowIndicator(this.initialNowDate), this.isNowIndicatorRendered = !0, i = this.initialNowDate.clone().startOf(t).add(1, t) - this.initialNowDate, this.nowIndicatorTimeoutID = setTimeout(function () {
        r.nowIndicatorTimeoutID = null, n(), i = +e.duration(1, t), i = Math.max(100, i), r.nowIndicatorIntervalID = setInterval(n, i);
      }, i));
    },
    updateNowIndicator: function updateNowIndicator() {
      this.isNowIndicatorRendered && (this.unrenderNowIndicator(), this.renderNowIndicator(this.initialNowDate.clone().add(new Date() - this.initialNowQueriedMs)));
    },
    stopNowIndicator: function stopNowIndicator() {
      this.isNowIndicatorRendered && (this.nowIndicatorTimeoutID && (clearTimeout(this.nowIndicatorTimeoutID), this.nowIndicatorTimeoutID = null), this.nowIndicatorIntervalID && (clearTimeout(this.nowIndicatorIntervalID), this.nowIndicatorIntervalID = null), this.unrenderNowIndicator(), this.isNowIndicatorRendered = !1);
    },
    getNowIndicatorUnit: function getNowIndicatorUnit() {},
    renderNowIndicator: function renderNowIndicator(t) {},
    unrenderNowIndicator: function unrenderNowIndicator() {},
    updateSize: function updateSize(t) {
      var e;
      t && (e = this.queryScroll()), this.updateHeight(t), this.updateWidth(t), this.updateNowIndicator(), t && this.applyScroll(e);
    },
    updateWidth: function updateWidth(t) {},
    updateHeight: function updateHeight(t) {
      var e = this.calendar;
      this.setHeight(e.getSuggestedViewHeight(), e.isHeightAuto());
    },
    setHeight: function setHeight(t, e) {},
    addForcedScroll: function addForcedScroll(e) {
      this.addScroll(t.extend(e, {
        isForced: !0
      }));
    },
    addScroll: function addScroll(e) {
      var n = this.queuedScroll || (this.queuedScroll = {});
      n.isForced || t.extend(n, e);
    },
    popScroll: function popScroll() {
      this.applyQueuedScroll(), this.queuedScroll = null;
    },
    applyQueuedScroll: function applyQueuedScroll() {
      this.queuedScroll && this.applyScroll(this.queuedScroll);
    },
    queryScroll: function queryScroll() {
      var e = {};
      return this.isDatesRendered && t.extend(e, this.queryDateScroll()), e;
    },
    applyScroll: function applyScroll(t) {
      this.isDatesRendered && this.applyDateScroll(t);
    },
    computeInitialDateScroll: function computeInitialDateScroll() {
      return {};
    },
    queryDateScroll: function queryDateScroll() {
      return {};
    },
    applyDateScroll: function applyDateScroll(t) {},
    freezeHeight: function freezeHeight() {
      this.calendar.freezeContentHeight();
    },
    thawHeight: function thawHeight() {
      this.calendar.thawContentHeight();
    },
    executeEventsRender: function executeEventsRender(t) {
      this.renderEvents(t), this.isEventsRendered = !0, this.onEventsRender();
    },
    executeEventsUnrender: function executeEventsUnrender() {
      this.onBeforeEventsUnrender(), this.destroyEvents && this.destroyEvents(), this.unrenderEvents(), this.isEventsRendered = !1;
    },
    onEventsRender: function onEventsRender() {
      this.applyScreenState(), this.renderedEventSegEach(function (t) {
        this.publiclyTrigger("eventAfterRender", t.event, t.event, t.el);
      }), this.publiclyTrigger("eventAfterAllRender");
    },
    onBeforeEventsUnrender: function onBeforeEventsUnrender() {
      this.applyScreenState(), this.renderedEventSegEach(function (t) {
        this.publiclyTrigger("eventDestroy", t.event, t.event, t.el);
      });
    },
    applyScreenState: function applyScreenState() {
      this.thawHeight(), this.freezeHeight(), this.applyQueuedScroll();
    },
    renderEvents: function renderEvents(t) {},
    unrenderEvents: function unrenderEvents() {},
    resolveEventEl: function resolveEventEl(e, n) {
      var i = this.publiclyTrigger("eventRender", e, e, n);
      return !1 === i ? n = null : i && !0 !== i && (n = t(i)), n;
    },
    showEvent: function showEvent(t) {
      this.renderedEventSegEach(function (t) {
        t.el.css("visibility", "");
      }, t);
    },
    hideEvent: function hideEvent(t) {
      this.renderedEventSegEach(function (t) {
        t.el.css("visibility", "hidden");
      }, t);
    },
    renderedEventSegEach: function renderedEventSegEach(t, e) {
      var n,
          i = this.getEventSegs();

      for (n = 0; n < i.length; n++) {
        e && i[n].event._id !== e._id || i[n].el && t.call(this, i[n]);
      }
    },
    getEventSegs: function getEventSegs() {
      return [];
    },
    isEventDraggable: function isEventDraggable(t) {
      return this.isEventStartEditable(t);
    },
    isEventStartEditable: function isEventStartEditable(t) {
      return tt(t.startEditable, (t.source || {}).startEditable, this.opt("eventStartEditable"), this.isEventGenerallyEditable(t));
    },
    isEventGenerallyEditable: function isEventGenerallyEditable(t) {
      return tt(t.editable, (t.source || {}).editable, this.opt("editable"));
    },
    reportSegDrop: function reportSegDrop(t, e, n, i, r) {
      var s = this.calendar,
          o = s.mutateSeg(t, e, n);
      this.triggerEventDrop(t.event, o.dateDelta, function () {
        o.undo(), s.reportEventChange();
      }, i, r), s.reportEventChange();
    },
    triggerEventDrop: function triggerEventDrop(t, e, n, i, r) {
      this.publiclyTrigger("eventDrop", i[0], t, e, n, r, {});
    },
    reportExternalDrop: function reportExternalDrop(e, n, i, r, s) {
      var o,
          a,
          l = e.eventProps;
      l && (o = t.extend({}, l, n), a = this.calendar.renderEvent(o, e.stick)[0]), this.triggerExternalDrop(a, n, i, r, s);
    },
    triggerExternalDrop: function triggerExternalDrop(t, e, n, i, r) {
      this.publiclyTrigger("drop", n[0], e.start, i, r), t && this.publiclyTrigger("eventReceive", null, t);
    },
    renderDrag: function renderDrag(t, e) {},
    unrenderDrag: function unrenderDrag() {},
    isEventResizableFromStart: function isEventResizableFromStart(t) {
      return this.opt("eventResizableFromStart") && this.isEventResizable(t);
    },
    isEventResizableFromEnd: function isEventResizableFromEnd(t) {
      return this.isEventResizable(t);
    },
    isEventResizable: function isEventResizable(t) {
      var e = t.source || {};
      return tt(t.durationEditable, e.durationEditable, this.opt("eventDurationEditable"), t.editable, e.editable, this.opt("editable"));
    },
    reportSegResize: function reportSegResize(t, e, n, i, r) {
      var s = this.calendar,
          o = s.mutateSeg(t, e, n);
      this.triggerEventResize(t.event, o.durationDelta, function () {
        o.undo(), s.reportEventChange();
      }, i, r), s.reportEventChange();
    },
    triggerEventResize: function triggerEventResize(t, e, n, i, r) {
      this.publiclyTrigger("eventResize", i[0], t, e, n, r, {});
    },
    select: function select(t, e) {
      this.unselect(e), this.renderSelection(t), this.reportSelection(t, e);
    },
    renderSelection: function renderSelection(t) {},
    reportSelection: function reportSelection(t, e) {
      this.isSelected = !0, this.triggerSelect(t, e);
    },
    triggerSelect: function triggerSelect(t, e) {
      this.publiclyTrigger("select", null, this.calendar.applyTimezone(t.start), this.calendar.applyTimezone(t.end), e);
    },
    unselect: function unselect(t) {
      this.isSelected && (this.isSelected = !1, this.destroySelection && this.destroySelection(), this.unrenderSelection(), this.publiclyTrigger("unselect", null, t));
    },
    unrenderSelection: function unrenderSelection() {},
    selectEvent: function selectEvent(t) {
      this.selectedEvent && this.selectedEvent === t || (this.unselectEvent(), this.renderedEventSegEach(function (t) {
        t.el.addClass("fc-selected");
      }, t), this.selectedEvent = t);
    },
    unselectEvent: function unselectEvent() {
      this.selectedEvent && (this.renderedEventSegEach(function (t) {
        t.el.removeClass("fc-selected");
      }, this.selectedEvent), this.selectedEvent = null);
    },
    isEventSelected: function isEventSelected(t) {
      return this.selectedEvent && this.selectedEvent._id === t._id;
    },
    handleDocumentMousedown: function handleDocumentMousedown(t) {
      b(t) && this.processUnselect(t);
    },
    processUnselect: function processUnselect(t) {
      this.processRangeUnselect(t), this.processEventUnselect(t);
    },
    processRangeUnselect: function processRangeUnselect(e) {
      var n;
      this.isSelected && this.opt("unselectAuto") && ((n = this.opt("unselectCancel")) && t(e.target).closest(n).length || this.unselect(e));
    },
    processEventUnselect: function processEventUnselect(e) {
      this.selectedEvent && (t(e.target).closest(".fc-selected").length || this.unselectEvent());
    },
    triggerDayClick: function triggerDayClick(t, e, n) {
      this.publiclyTrigger("dayClick", e, this.calendar.applyTimezone(t.start), n);
    },
    computeDayRange: function computeDayRange(t) {
      var e,
          n = t.start.clone().stripTime(),
          i = t.end,
          r = null;
      return i && (r = i.clone().stripTime(), (e = +i.time()) && e >= this.nextDayThreshold && r.add(1, "days")), (!i || r <= n) && (r = n.clone().add(1, "days")), {
        start: n,
        end: r
      };
    },
    isMultiDayEvent: function isMultiDayEvent(t) {
      var e = this.computeDayRange(t);
      return e.end.diff(e.start, "days") > 1;
    }
  });
  Kt.watch("displayingDates", ["dateProfile"], function (t) {
    this.requestDateRender(t.dateProfile);
  }, function () {
    this.requestDateUnrender();
  }), Kt.watch("initialEvents", ["dateProfile"], function (t) {
    return this.fetchInitialEvents(t.dateProfile);
  }), Kt.watch("bindingEvents", ["initialEvents"], function (t) {
    this.setEvents(t.initialEvents), this.bindEventChanges();
  }, function () {
    this.unbindEventChanges(), this.unsetEvents();
  }), Kt.watch("displayingEvents", ["displayingDates", "hasEvents"], function () {
    this.requestEventsRender(this.get("currentEvents"));
  }, function () {
    this.requestEventsUnrender();
  }), Kt.mixin({
    currentRange: null,
    currentRangeUnit: null,
    renderRange: null,
    activeRange: null,
    validRange: null,
    dateIncrement: null,
    minTime: null,
    maxTime: null,
    usesMinMaxTime: !1,
    start: null,
    end: null,
    intervalStart: null,
    intervalEnd: null,
    setDateProfileForRendering: function setDateProfileForRendering(t) {
      this.currentRange = t.currentRange, this.currentRangeUnit = t.currentRangeUnit, this.renderRange = t.renderRange, this.activeRange = t.activeRange, this.validRange = t.validRange, this.dateIncrement = t.dateIncrement, this.minTime = t.minTime, this.maxTime = t.maxTime, this.start = t.activeRange.start, this.end = t.activeRange.end, this.intervalStart = t.currentRange.start, this.intervalEnd = t.currentRange.end;
    },
    buildPrevDateProfile: function buildPrevDateProfile(t) {
      var e = t.clone().startOf(this.currentRangeUnit).subtract(this.dateIncrement);
      return this.buildDateProfile(e, -1);
    },
    buildNextDateProfile: function buildNextDateProfile(t) {
      var e = t.clone().startOf(this.currentRangeUnit).add(this.dateIncrement);
      return this.buildDateProfile(e, 1);
    },
    buildDateProfile: function buildDateProfile(t, n, i) {
      var r,
          s,
          o,
          a,
          l,
          u,
          h,
          c,
          d = this.buildValidRange();
      return i && (t = W(t, d)), o = this.buildCurrentRangeInfo(t, n), l = P(a = this.buildRenderRange(o.range, o.unit)), this.opt("showNonCurrentDates") || (l = _(l, o.range)), r = e.duration(this.opt("minTime")), s = e.duration(this.opt("maxTime")), this.adjustActiveRange(l, r, s), t = W(t, l = _(l, d)), h = o.range, u = (!(c = d).start || h.end >= c.start) && (!c.end || h.start < c.end), {
        validRange: d,
        currentRange: o.range,
        currentRangeUnit: o.unit,
        activeRange: l,
        renderRange: a,
        minTime: r,
        maxTime: s,
        isValid: u,
        date: t,
        dateIncrement: this.buildDateIncrement(o.duration)
      };
    },
    buildValidRange: function buildValidRange() {
      return this.getRangeOption("validRange", this.calendar.getNow()) || {};
    },
    buildCurrentRangeInfo: function buildCurrentRangeInfo(t, e) {
      var n,
          i = null,
          r = null,
          s = null;
      return this.viewSpec.duration ? (i = this.viewSpec.duration, r = this.viewSpec.durationUnit, s = this.buildRangeFromDuration(t, e, i, r)) : (n = this.opt("dayCount")) ? (r = "day", s = this.buildRangeFromDayCount(t, e, n)) : (s = this.buildCustomVisibleRange(t)) ? r = A(s.start, s.end) : (r = A(i = this.getFallbackDuration()), s = this.buildRangeFromDuration(t, e, i, r)), this.normalizeCurrentRange(s, r), {
        duration: i,
        unit: r,
        range: s
      };
    },
    getFallbackDuration: function getFallbackDuration() {
      return e.duration({
        days: 1
      });
    },
    normalizeCurrentRange: function normalizeCurrentRange(t, e) {
      /^(year|month|week|day)$/.test(e) ? (t.start.stripTime(), t.end.stripTime()) : (t.start.hasTime() || t.start.time(0), t.end.hasTime() || t.end.time(0));
    },
    adjustActiveRange: function adjustActiveRange(t, e, n) {
      var i = !1;
      this.usesMinMaxTime && (e < 0 && (t.start.time(0).add(e), i = !0), n > 864e5 && (t.end.time(n - 864e5), i = !0), i && (t.start.hasTime() || t.start.time(0), t.end.hasTime() || t.end.time(0)));
    },
    buildRangeFromDuration: function buildRangeFromDuration(t, n, i, r) {
      var s,
          o,
          a,
          l = this.opt("dateAlignment"),
          u = t.clone();
      return i.as("days") <= 1 && this.isHiddenDay(u) && (u = this.skipHiddenDays(u, n)).startOf("day"), l || (l = (o = this.opt("dateIncrement")) && (a = e.duration(o)) < i ? G(a, o) : r), u.startOf(l), s = u.clone().add(i), {
        start: u,
        end: s
      };
    },
    buildRangeFromDayCount: function buildRangeFromDayCount(t, e, n) {
      var i,
          r = this.opt("dateAlignment"),
          s = 0,
          o = t.clone();
      r && o.startOf(r), o.startOf("day"), i = (o = this.skipHiddenDays(o, e)).clone();

      do {
        i.add(1, "day"), this.isHiddenDay(i) || s++;
      } while (s < n);

      return {
        start: o,
        end: i
      };
    },
    buildCustomVisibleRange: function buildCustomVisibleRange(t) {
      var e = this.getRangeOption("visibleRange", this.calendar.moment(t));
      return !e || e.start && e.end ? e : null;
    },
    buildRenderRange: function buildRenderRange(t, e) {
      return this.trimHiddenDays(t);
    },
    buildDateIncrement: function buildDateIncrement(t) {
      var n,
          i = this.opt("dateIncrement");
      return i ? e.duration(i) : (n = this.opt("dateAlignment")) ? e.duration(1, n) : t || e.duration({
        days: 1
      });
    },
    trimHiddenDays: function trimHiddenDays(t) {
      return {
        start: this.skipHiddenDays(t.start),
        end: this.skipHiddenDays(t.end, -1, !0)
      };
    },
    currentRangeAs: function currentRangeAs(t) {
      var e = this.currentRange;
      return e.end.diff(e.start, t, !0);
    },
    getRangeOption: function getRangeOption(t) {
      var e = this.opt(t);
      if ("function" == typeof e && (e = e.apply(null, Array.prototype.slice.call(arguments, 1))), e) return this.calendar.parseRange(e);
    },
    initHiddenDays: function initHiddenDays() {
      var e,
          n = this.opt("hiddenDays") || [],
          i = [],
          r = 0;

      for (!1 === this.opt("weekends") && n.push(0, 6), e = 0; e < 7; e++) {
        (i[e] = -1 !== t.inArray(e, n)) || r++;
      }

      if (!r) throw "invalid hiddenDays";
      this.isHiddenDayHash = i;
    },
    isHiddenDay: function isHiddenDay(t) {
      return e.isMoment(t) && (t = t.day()), this.isHiddenDayHash[t];
    },
    skipHiddenDays: function skipHiddenDays(t, e, n) {
      var i = t.clone();

      for (e = e || 1; this.isHiddenDayHash[(i.day() + (n ? e : 0) + 7) % 7];) {
        i.add(e, "days");
      }

      return i;
    }
  });
  var Jt = n.Scroller = wt.extend({
    el: null,
    scrollEl: null,
    overflowX: null,
    overflowY: null,
    constructor: function constructor(t) {
      t = t || {}, this.overflowX = t.overflowX || t.overflow || "auto", this.overflowY = t.overflowY || t.overflow || "auto";
    },
    render: function render() {
      this.el = this.renderEl(), this.applyOverflow();
    },
    renderEl: function renderEl() {
      return this.scrollEl = t('<div class="fc-scroller"></div>');
    },
    clear: function clear() {
      this.setHeight("auto"), this.applyOverflow();
    },
    destroy: function destroy() {
      this.el.remove();
    },
    applyOverflow: function applyOverflow() {
      this.scrollEl.css({
        "overflow-x": this.overflowX,
        "overflow-y": this.overflowY
      });
    },
    lockOverflow: function lockOverflow(t) {
      var e = this.overflowX,
          n = this.overflowY;
      t = t || this.getScrollbarWidths(), "auto" === e && (e = t.top || t.bottom || this.scrollEl[0].scrollWidth - 1 > this.scrollEl[0].clientWidth ? "scroll" : "hidden"), "auto" === n && (n = t.left || t.right || this.scrollEl[0].scrollHeight - 1 > this.scrollEl[0].clientHeight ? "scroll" : "hidden"), this.scrollEl.css({
        "overflow-x": e,
        "overflow-y": n
      });
    },
    setHeight: function setHeight(t) {
      this.scrollEl.height(t);
    },
    getScrollTop: function getScrollTop() {
      return this.scrollEl.scrollTop();
    },
    setScrollTop: function setScrollTop(t) {
      this.scrollEl.scrollTop(t);
    },
    getClientWidth: function getClientWidth() {
      return this.scrollEl[0].clientWidth;
    },
    getClientHeight: function getClientHeight() {
      return this.scrollEl[0].clientHeight;
    },
    getScrollbarWidths: function getScrollbarWidths() {
      return m(this.scrollEl);
    }
  });

  function te(t) {
    this.items = t || [];
  }

  function ee(e, n) {
    var i,
        r = this;
    r.setToolbarOptions = function (t) {
      n = t;
    }, r.render = function () {
      var r = n.layout;
      s = e.opt("theme") ? "ui" : "fc", r ? (i ? i.empty() : i = this.el = t("<div class='fc-toolbar " + n.extraClasses + "'/>"), i.append(l("left")).append(l("right")).append(l("center")).append('<div class="fc-clear"/>')) : a();
    }, r.removeElement = a, r.updateTitle = function (t) {
      i && i.find("h2").text(t);
    }, r.activateButton = function (t) {
      i && i.find(".fc-" + t + "-button").addClass(s + "-state-active");
    }, r.deactivateButton = function (t) {
      i && i.find(".fc-" + t + "-button").removeClass(s + "-state-active");
    }, r.disableButton = function (t) {
      i && i.find(".fc-" + t + "-button").prop("disabled", !0).addClass(s + "-state-disabled");
    }, r.enableButton = function (t) {
      i && i.find(".fc-" + t + "-button").prop("disabled", !1).removeClass(s + "-state-disabled");
    }, r.getViewsWithButtons = function () {
      return o;
    }, r.el = null;
    var s,
        o = [];

    function a() {
      i && (i.remove(), i = r.el = null);
    }

    function l(i) {
      var r = t('<div class="fc-' + i + '"/>'),
          a = n.layout[i],
          l = e.opt("customButtons") || {},
          u = e.opt("buttonText") || {};
      return a && t.each(a.split(" "), function (n) {
        var i,
            a = t(),
            h = !0;
        t.each(this.split(","), function (n, i) {
          var r, c, d, f, g, p, v, m, y;
          "title" == i ? (a = a.add(t("<h2>&nbsp;</h2>")), h = !1) : ((r = l[i]) ? (d = function d(t) {
            r.click && r.click.call(y[0], t);
          }, f = "", g = r.text) : (c = e.getViewSpec(i)) ? (d = function d() {
            e.changeView(i);
          }, o.push(i), f = c.buttonTextOverride, g = c.buttonTextDefault) : e[i] && (d = function d() {
            e[i]();
          }, f = (e.overrides.buttonText || {})[i], g = u[i]), d && (p = r ? r.themeIcon : e.opt("themeButtonIcons")[i], v = r ? r.icon : e.opt("buttonIcons")[i], m = f ? et(f) : p && e.opt("theme") ? "<span class='ui-icon ui-icon-" + p + "'></span>" : v && !e.opt("theme") ? "<span class='fc-icon fc-icon-" + v + "'></span>" : et(g), y = t('<button type="button" class="' + ["fc-" + i + "-button", s + "-button", s + "-state-default"].join(" ") + '">' + m + "</button>").click(function (t) {
            y.hasClass(s + "-state-disabled") || (d(t), (y.hasClass(s + "-state-active") || y.hasClass(s + "-state-disabled")) && y.removeClass(s + "-state-hover"));
          }).mousedown(function () {
            y.not("." + s + "-state-active").not("." + s + "-state-disabled").addClass(s + "-state-down");
          }).mouseup(function () {
            y.removeClass(s + "-state-down");
          }).hover(function () {
            y.not("." + s + "-state-active").not("." + s + "-state-disabled").addClass(s + "-state-hover");
          }, function () {
            y.removeClass(s + "-state-hover").removeClass(s + "-state-down");
          }), a = a.add(y)));
        }), h && a.first().addClass(s + "-corner-left").end().last().addClass(s + "-corner-right").end(), a.length > 1 ? (i = t("<div/>"), h && i.addClass("fc-button-group"), i.append(a), r.append(i)) : r.append(a);
      }), r;
    }
  }

  te.prototype.proxyCall = function (t) {
    var e = Array.prototype.slice.call(arguments, 1),
        n = [];
    return this.items.forEach(function (i) {
      n.push(i[t].apply(i, e));
    }), n;
  };

  var ne = n.Calendar = wt.extend(xt, {
    view: null,
    viewsByType: null,
    currentDate: null,
    loadingLevel: 0,
    constructor: function constructor(i, r) {
      Gt.needed(), this.el = i, this.viewsByType = {}, this.viewSpecCache = {}, this.initOptionsInternals(r), this.initMomentInternals(), this.initCurrentDate(), function () {
        var i = this;
        i.requestEvents = function (t, e) {
          return !i.opt("lazyFetching") || d(t, e) ? f(t, e) : Et.resolve(o);
        }, i.reportEventChange = c, i.isFetchNeeded = d, i.fetchEvents = f, i.fetchEventSources = p, i.refetchEvents = g, i.refetchEventSources = function (t) {
          return p(E(t));
        }, i.getEventSources = function () {
          return l.slice(1);
        }, i.getEventSourceById = b, i.addEventSource = function (t) {
          var e = w(t);
          e && (l.push(e), p([e], "add"));
        }, i.removeEventSource = function (t) {
          S(D(t));
        }, i.removeEventSources = function (t) {
          null == t ? S(l, !0) : S(E(t));
        }, i.updateEvent = function (t) {
          H([t]);
        }, i.updateEvents = H, i.renderEvent = function (t, e) {
          return I([t], e);
        }, i.renderEvents = I, i.removeEvents = function (e) {
          var n, i;
          null == e ? e = function e() {
            return !0;
          } : t.isFunction(e) || (n = e + "", e = function e(t) {
            return t._id == n;
          });

          for (h = t.grep(h, e, !0), i = 0; i < l.length; i++) {
            t.isArray(l[i].events) && (l[i].events = t.grep(l[i].events, e, !0));
          }

          c();
        }, i.clientEvents = k, i.mutateEvent = V, i.normalizeEventDates = N, i.normalizeEventTimes = A;
        var r,
            s,
            o,
            a = {
          events: []
        },
            l = [a],
            u = 0,
            h = [];

        function c() {
          o = function (t) {
            var e,
                n,
                o = [];

            for (e = 0; e < t.length; e++) {
              (n = t[e]).start.clone().stripZone() < s && i.getEventEnd(n).stripZone() > r && o.push(n);
            }

            return o;
          }(h), i.trigger("eventsReset", o);
        }

        function d(t, e) {
          return !r || t < r || e > s;
        }

        function f(t, e) {
          return r = t, s = e, g();
        }

        function g() {
          return p(l, "reset");
        }

        function p(t, e) {
          var n, r;

          for ("reset" === e ? h = [] : "add" !== e && (h = C(h, t)), n = 0; n < t.length; n++) {
            "pending" !== (r = t[n])._status && u++, r._fetchId = (r._fetchId || 0) + 1, r._status = "pending";
          }

          for (n = 0; n < t.length; n++) {
            v(r = t[n], r._fetchId);
          }

          return u ? Et.construct(function (t) {
            i.one("eventsReceived", t);
          }) : Et.resolve(o);
        }

        function v(e, o) {
          !function e(o, a) {
            var l;
            var u = n.sourceFetchers;
            var h;

            for (l = 0; l < u.length; l++) {
              if (!0 === (h = u[l].call(i, o, r.clone(), s.clone(), i.opt("timezone"), a))) return;
              if ("object" == _typeof(h)) return void e(h, a);
            }

            var c = o.events;
            if (c) t.isFunction(c) ? (i.pushLoading(), c.call(i, r.clone(), s.clone(), i.opt("timezone"), function (t) {
              a(t), i.popLoading();
            })) : t.isArray(c) ? a(c) : a();else {
              var d = o.url;

              if (d) {
                var f,
                    g = o.success,
                    p = o.error,
                    v = o.complete;
                f = t.isFunction(o.data) ? o.data() : o.data;
                var m = t.extend({}, f || {}),
                    y = tt(o.startParam, i.opt("startParam")),
                    w = tt(o.endParam, i.opt("endParam")),
                    S = tt(o.timezoneParam, i.opt("timezoneParam"));
                y && (m[y] = r.format()), w && (m[w] = s.format()), i.opt("timezone") && "local" != i.opt("timezone") && (m[S] = i.opt("timezone")), i.pushLoading(), t.ajax(t.extend({}, ue, o, {
                  data: m,
                  success: function success(e) {
                    e = e || [];
                    var n = J(g, this, arguments);
                    t.isArray(n) && (e = n), a(e);
                  },
                  error: function error() {
                    J(p, this, arguments), a();
                  },
                  complete: function complete() {
                    J(v, this, arguments), i.popLoading();
                  }
                }));
              } else a();
            }
          }(e, function (n) {
            var i,
                r,
                s,
                a = t.isArray(e.events);

            if (o === e._fetchId && "rejected" !== e._status) {
              if (e._status = "resolved", n) for (i = 0; i < n.length; i++) {
                r = n[i], (s = a ? r : B(r, e)) && h.push.apply(h, G(s));
              }
              y();
            }
          });
        }

        function m(t) {
          var e = "pending" === t._status;
          t._status = "rejected", e && y();
        }

        function y() {
          --u || (c(), i.trigger("eventsReceived", o));
        }

        function w(e) {
          var r,
              s,
              o = n.sourceNormalizers;

          if (t.isFunction(e) || t.isArray(e) ? r = {
            events: e
          } : "string" == typeof e ? r = {
            url: e
          } : "object" == _typeof(e) && (r = t.extend({}, e)), r) {
            for (r.className ? "string" == typeof r.className && (r.className = r.className.split(/\s+/)) : r.className = [], t.isArray(r.events) && (r.origArray = r.events, r.events = t.map(r.events, function (t) {
              return B(t, r);
            })), s = 0; s < o.length; s++) {
              o[s].call(i, r);
            }

            return r;
          }
        }

        function S(e, n) {
          var i;

          for (i = 0; i < e.length; i++) {
            m(e[i]);
          }

          n ? (l = [], h = []) : (l = t.grep(l, function (t) {
            for (i = 0; i < e.length; i++) {
              if (t === e[i]) return !1;
            }

            return !0;
          }), h = C(h, e)), c();
        }

        function b(e) {
          return t.grep(l, function (t) {
            return t.id && t.id === e;
          })[0];
        }

        function E(e) {
          e ? t.isArray(e) || (e = [e]) : e = [];
          var n,
              i = [];

          for (n = 0; n < e.length; n++) {
            i.push.apply(i, D(e[n]));
          }

          return i;
        }

        function D(e) {
          var n, i;

          for (n = 0; n < l.length; n++) {
            if ((i = l[n]) === e) return [i];
          }

          return (i = b(e)) ? [i] : t.grep(l, function (t) {
            return i = t, (n = e) && i && T(n) == T(i);
            var n, i;
          });
        }

        function T(t) {
          return ("object" == _typeof(t) ? t.origArray || t.googleCalendarId || t.url || t.events : null) || t;
        }

        function C(e, n) {
          return t.grep(e, function (t) {
            for (var e = 0; e < n.length; e++) {
              if (t.source === n[e]) return !1;
            }

            return !0;
          });
        }

        function H(t) {
          var e, n;

          for (e = 0; e < t.length; e++) {
            (n = t[e]).start = i.moment(n.start), n.end ? n.end = i.moment(n.end) : n.end = null, V(n, R(n));
          }

          c();
        }

        function R(e) {
          var n = {};
          return t.each(e, function (e, i) {
            x(e) && void 0 !== i && function (e) {
              return /undefined|null|boolean|number|string/.test(t.type(e));
            }(i) && (n[e] = i);
          }), n;
        }

        function x(t) {
          return !/^_|^(id|allDay|start|end)$/.test(t);
        }

        function I(t, e) {
          var n,
              i,
              r,
              s,
              o,
              l = [];

          for (r = 0; r < t.length; r++) {
            if (i = B(t[r])) {
              for (n = G(i), s = 0; s < n.length; s++) {
                (o = n[s]).source || (e && (a.events.push(o), o.source = a), h.push(o));
              }

              l = l.concat(n);
            }
          }

          return l.length && c(), l;
        }

        function k(e) {
          return t.isFunction(e) ? t.grep(h, e) : null != e ? (e += "", t.grep(h, function (t) {
            return t._id == e;
          })) : h;
        }

        function M(t) {
          t.start = i.moment(t.start), t.end && (t.end = i.moment(t.end)), ce(t);
        }

        function B(n, r) {
          var s,
              o,
              a,
              l = i.opt("eventDataTransform"),
              u = {};
          if (l && (n = l(n)), r && r.eventDataTransform && (n = r.eventDataTransform(n)), t.extend(u, n), r && (u.source = r), u._id = n._id || (void 0 === n.id ? "_fc" + he++ : n.id + ""), n.className ? "string" == typeof n.className ? u.className = n.className.split(/\s+/) : u.className = n.className : u.className = [], s = n.start || n.date, o = n.end, j(s) && (s = e.duration(s)), j(o) && (o = e.duration(o)), n.dow || e.isDuration(s) || e.isDuration(o)) u.start = s ? e.duration(s) : null, u.end = o ? e.duration(o) : null, u._recurring = !0;else {
            if (s && !(s = i.moment(s)).isValid()) return !1;
            o && ((o = i.moment(o)).isValid() || (o = null)), void 0 === (a = n.allDay) && (a = tt(r ? r.allDayDefault : void 0, i.opt("allDayDefault"))), L(s, o, a, u);
          }
          return i.normalizeEvent(u), u;
        }

        function L(t, e, n, i) {
          i.start = t, i.end = e, i.allDay = n, N(i), ce(i);
        }

        function N(t) {
          A(t), t.end && !t.end.isAfter(t.start) && (t.end = null), t.end || (i.opt("forceEventDuration") ? t.end = i.getDefaultEventEnd(t.allDay, t.start) : t.end = null);
        }

        function A(t) {
          null == t.allDay && (t.allDay = !(t.start.hasTime() || t.end && t.end.hasTime())), t.allDay ? (t.start.stripTime(), t.end && t.end.stripTime()) : (t.start.hasTime() || (t.start = i.applyTimezone(t.start.time(0))), t.end && !t.end.hasTime() && (t.end = i.applyTimezone(t.end.time(0))));
        }

        function G(e, n, i) {
          var o,
              a,
              l,
              u,
              h,
              c,
              d,
              f,
              g,
              p = [];
          if (n = n || r, i = i || s, e) if (e._recurring) {
            if (a = e.dow) for (o = {}, l = 0; l < a.length; l++) {
              o[a[l]] = !0;
            }

            for (u = n.clone().stripTime(); u.isBefore(i);) {
              o && !o[u.day()] || (h = e.start, c = e.end, d = u.clone(), f = null, h && (d = d.time(h)), c && (f = u.clone().time(c)), g = t.extend({}, e), L(d, f, !h && !c, g), p.push(g)), u.add(1, "days");
            }
          } else p.push(e);
          return p;
        }

        function V(n, r, s) {
          var o,
              a,
              l,
              u,
              h,
              c,
              d = {};

          function f(t, n) {
            return s ? F(t, n, s) : r.allDay ? (i = t, o = n, e.duration({
              days: i.clone().stripTime().diff(o.clone().stripTime(), "days")
            })) : z(t, n);
            var i, o;
          }

          return (r = r || {}).start || (r.start = n.start.clone()), void 0 === r.end && (r.end = n.end ? n.end.clone() : null), null == r.allDay && (r.allDay = n.allDay), N(r), N(o = {
            start: n._start.clone(),
            end: n._end ? n._end.clone() : i.getDefaultEventEnd(n._allDay, n._start),
            allDay: r.allDay
          }), a = null !== n._end && null === r.end, l = f(r.start, o.start), r.end ? (u = f(r.end, o.end), h = u.subtract(l)) : h = null, t.each(r, function (t, e) {
            x(t) && void 0 !== e && (d[t] = e);
          }), c = function (e, n, r, s, o, a) {
            var l = i.getIsAmbigTimezone(),
                u = [];
            s && !s.valueOf() && (s = null);
            o && !o.valueOf() && (o = null);
            return t.each(e, function (e, h) {
              var c, d;
              c = {
                start: h.start.clone(),
                end: h.end ? h.end.clone() : null,
                allDay: h.allDay
              }, t.each(a, function (t) {
                c[t] = h[t];
              }), N(d = {
                start: h._start,
                end: h._end,
                allDay: r
              }), n ? d.end = null : o && !d.end && (d.end = i.getDefaultEventEnd(d.allDay, d.start)), s && (d.start.add(s), d.end && d.end.add(s)), o && d.end.add(o), l && !d.allDay && (s || o) && (d.start.stripZone(), d.end && d.end.stripZone()), t.extend(h, a, d), ce(h), u.push(function () {
                t.extend(h, c), ce(h);
              });
            }), function () {
              for (var t = 0; t < u.length; t++) {
                u[t]();
              }
            };
          }(k(n._id), a, r.allDay, l, h, d), {
            dateDelta: l,
            durationDelta: h,
            undo: c
          };
        }

        t.each((i.opt("events") ? [i.opt("events")] : []).concat(i.opt("eventSources") || []), function (t, e) {
          var n = w(e);
          n && l.push(n);
        }), i.getEventCache = function () {
          return h;
        }, i.rezoneArrayEventSources = function () {
          var e, n, i;

          for (e = 0; e < l.length; e++) {
            if (n = l[e].events, t.isArray(n)) for (i = 0; i < n.length; i++) {
              M(n[i]);
            }
          }
        }, i.buildEventFromInput = B, i.expandEvent = G;
      }.call(this), this.initialize();
    },
    initialize: function initialize() {},
    getCalendar: function getCalendar() {
      return this;
    },
    getView: function getView() {
      return this.view;
    },
    publiclyTrigger: function publiclyTrigger(t, e) {
      var n = Array.prototype.slice.call(arguments, 2),
          i = this.opt(t);
      if (e = e || this.el[0], this.triggerWith(t, e, n), i) return i.apply(e, n);
    },
    instantiateView: function instantiateView(t) {
      var e = this.getViewSpec(t);
      return new e["class"](this, e);
    },
    isValidViewType: function isValidViewType(t) {
      return Boolean(this.getViewSpec(t));
    },
    changeView: function changeView(t, e) {
      e && (e.start && e.end ? this.recordOptionOverrides({
        visibleRange: e
      }) : this.currentDate = this.moment(e).stripZone()), this.renderView(t);
    },
    zoomTo: function zoomTo(t, e) {
      var n;
      e = e || "day", n = this.getViewSpec(e) || this.getUnitViewSpec(e), this.currentDate = t.clone(), this.renderView(n ? n.type : null);
    },
    initCurrentDate: function initCurrentDate() {
      var t = this.opt("defaultDate");
      this.currentDate = null != t ? this.moment(t).stripZone() : this.getNow();
    },
    prev: function prev() {
      var t = this.view.buildPrevDateProfile(this.currentDate);
      t.isValid && (this.currentDate = t.date, this.renderView());
    },
    next: function next() {
      var t = this.view.buildNextDateProfile(this.currentDate);
      t.isValid && (this.currentDate = t.date, this.renderView());
    },
    prevYear: function prevYear() {
      this.currentDate.add(-1, "years"), this.renderView();
    },
    nextYear: function nextYear() {
      this.currentDate.add(1, "years"), this.renderView();
    },
    today: function today() {
      this.currentDate = this.getNow(), this.renderView();
    },
    gotoDate: function gotoDate(t) {
      this.currentDate = this.moment(t).stripZone(), this.renderView();
    },
    incrementDate: function incrementDate(t) {
      this.currentDate.add(e.duration(t)), this.renderView();
    },
    getDate: function getDate() {
      return this.applyTimezone(this.currentDate);
    },
    pushLoading: function pushLoading() {
      this.loadingLevel++ || this.publiclyTrigger("loading", null, !0, this.view);
    },
    popLoading: function popLoading() {
      --this.loadingLevel || this.publiclyTrigger("loading", null, !1, this.view);
    },
    select: function select(t, e) {
      this.view.select(this.buildSelectSpan.apply(this, arguments));
    },
    unselect: function unselect() {
      this.view && this.view.unselect();
    },
    buildSelectSpan: function buildSelectSpan(t, e) {
      var n,
          i = this.moment(t).stripZone();
      return n = e ? this.moment(e).stripZone() : i.hasTime() ? i.clone().add(this.defaultTimedEventDuration) : i.clone().add(this.defaultAllDayEventDuration), {
        start: i,
        end: n
      };
    },
    parseRange: function parseRange(t) {
      var e = null,
          n = null;
      return t.start && (e = this.moment(t.start).stripZone()), t.end && (n = this.moment(t.end).stripZone()), e || n ? e && n && n.isBefore(e) ? null : {
        start: e,
        end: n
      } : null;
    },
    rerenderEvents: function rerenderEvents() {
      this.elementVisible() && this.reportEventChange();
    }
  });
  ne.mixin({
    dirDefaults: null,
    localeDefaults: null,
    overrides: null,
    dynamicOverrides: null,
    optionsModel: null,
    initOptionsInternals: function initOptionsInternals(e) {
      this.overrides = t.extend({}, e), this.dynamicOverrides = {}, this.optionsModel = new bt(), this.populateOptionsHash();
    },
    option: function option(t, e) {
      var n;

      if ("string" == typeof t) {
        if (void 0 === e) return this.optionsModel.get(t);
        (n = {})[t] = e, this.setOptions(n);
      } else "object" == _typeof(t) && this.setOptions(t);
    },
    opt: function opt(t) {
      return this.optionsModel.get(t);
    },
    setOptions: function setOptions(t) {
      var e,
          n = 0;

      for (e in this.recordOptionOverrides(t), t) {
        n++;
      }

      if (1 === n) {
        if ("height" === e || "contentHeight" === e || "aspectRatio" === e) return void this.updateSize(!0);
        if ("defaultDate" === e) return;
        if ("businessHours" === e) return void (this.view && (this.view.unrenderBusinessHours(), this.view.renderBusinessHours()));
        if ("timezone" === e) return this.rezoneArrayEventSources(), void this.refetchEvents();
      }

      this.renderHeader(), this.renderFooter(), this.viewsByType = {}, this.reinitView();
    },
    populateOptionsHash: function populateOptionsHash() {
      var t, e, n, i;
      t = tt(this.dynamicOverrides.locale, this.overrides.locale), (e = ie[t]) || (t = ne.defaults.locale, e = ie[t] || {}), n = tt(this.dynamicOverrides.isRTL, this.overrides.isRTL, e.isRTL, ne.defaults.isRTL) ? ne.rtlDefaults : {}, this.dirDefaults = n, this.localeDefaults = e, ae(i = s([ne.defaults, n, e, this.overrides, this.dynamicOverrides])), this.optionsModel.reset(i);
    },
    recordOptionOverrides: function recordOptionOverrides(t) {
      var e;

      for (e in t) {
        this.dynamicOverrides[e] = t[e];
      }

      this.viewSpecCache = {}, this.populateOptionsHash();
    }
  }), ne.mixin({
    defaultAllDayEventDuration: null,
    defaultTimedEventDuration: null,
    localeData: null,
    initMomentInternals: function initMomentInternals() {
      var t = this;
      this.defaultAllDayEventDuration = e.duration(this.opt("defaultAllDayEventDuration")), this.defaultTimedEventDuration = e.duration(this.opt("defaultTimedEventDuration")), this.optionsModel.watch("buildingMomentLocale", ["?locale", "?monthNames", "?monthNamesShort", "?dayNames", "?dayNamesShort", "?firstDay", "?weekNumberCalculation"], function (e) {
        var n,
            i = e.weekNumberCalculation,
            r = e.firstDay;
        "iso" === i && (i = "ISO");
        var s = Q(le(e.locale));
        e.monthNames && (s._months = e.monthNames), e.monthNamesShort && (s._monthsShort = e.monthNamesShort), e.dayNames && (s._weekdays = e.dayNames), e.dayNamesShort && (s._weekdaysShort = e.dayNamesShort), null == r && "ISO" === i && (r = 1), null != r && ((n = Q(s._week)).dow = r, s._week = n), "ISO" !== i && "local" !== i && "function" != typeof i || (s._fullCalendar_weekCalc = i), t.localeData = s, t.currentDate && t.localizeMoment(t.currentDate);
      });
    },
    moment: function moment() {
      var t;
      return "local" === this.opt("timezone") ? (t = n.moment.apply(null, arguments)).hasTime() && t.local() : t = "UTC" === this.opt("timezone") ? n.moment.utc.apply(null, arguments) : n.moment.parseZone.apply(null, arguments), this.localizeMoment(t), t;
    },
    localizeMoment: function localizeMoment(t) {
      t._locale = this.localeData;
    },
    getIsAmbigTimezone: function getIsAmbigTimezone() {
      return "local" !== this.opt("timezone") && "UTC" !== this.opt("timezone");
    },
    applyTimezone: function applyTimezone(t) {
      if (!t.hasTime()) return t.clone();
      var e,
          n = this.moment(t.toArray()),
          i = t.time() - n.time();
      return i && (e = n.clone().add(i), t.time() - e.time() == 0 && (n = e)), n;
    },
    getNow: function getNow() {
      var t = this.opt("now");
      return "function" == typeof t && (t = t()), this.moment(t).stripZone();
    },
    humanizeDuration: function humanizeDuration(t) {
      return t.locale(this.opt("locale")).humanize();
    },
    getEventEnd: function getEventEnd(t) {
      return t.end ? t.end.clone() : this.getDefaultEventEnd(t.allDay, t.start);
    },
    getDefaultEventEnd: function getDefaultEventEnd(t, e) {
      var n = e.clone();
      return t ? n.stripTime().add(this.defaultAllDayEventDuration) : n.add(this.defaultTimedEventDuration), this.getIsAmbigTimezone() && n.stripZone(), n;
    }
  }), ne.mixin({
    viewSpecCache: null,
    getViewSpec: function getViewSpec(t) {
      var e = this.viewSpecCache;
      return e[t] || (e[t] = this.buildViewSpec(t));
    },
    getUnitViewSpec: function getUnitViewSpec(e) {
      var i, r, s;
      if (-1 != t.inArray(e, N)) for (i = this.header.getViewsWithButtons(), t.each(n.views, function (t) {
        i.push(t);
      }), r = 0; r < i.length; r++) {
        if ((s = this.getViewSpec(i[r])) && s.singleUnit == e) return s;
      }
    },
    buildViewSpec: function buildViewSpec(t) {
      for (var n, r, o, a, l, u = this.overrides.views || {}, h = [], c = [], d = [], f = t; f;) {
        n = i[f], r = u[f], f = null, "function" == typeof n && (n = {
          "class": n
        }), n && (h.unshift(n), c.unshift(n.defaults || {}), o = o || n.duration, f = f || n.type), r && (d.unshift(r), o = o || r.duration, f = f || r.type);
      }

      return (n = $(h)).type = t, !!n["class"] && ((o = o || this.dynamicOverrides.duration || this.overrides.duration) && (a = e.duration(o)).valueOf() && (l = G(a, o), n.duration = a, n.durationUnit = l, 1 === a.as(l) && (n.singleUnit = l, d.unshift(u[l] || {}))), n.defaults = s(c), n.overrides = s(d), this.buildViewSpecOptions(n), this.buildViewSpecButtonText(n, t), n);
    },
    buildViewSpecOptions: function buildViewSpecOptions(t) {
      t.options = s([ne.defaults, t.defaults, this.dirDefaults, this.localeDefaults, this.overrides, t.overrides, this.dynamicOverrides]), ae(t.options);
    },
    buildViewSpecButtonText: function buildViewSpecButtonText(t, e) {
      function n(n) {
        var i = n.buttonText || {};
        return i[e] || (t.buttonTextKey ? i[t.buttonTextKey] : null) || (t.singleUnit ? i[t.singleUnit] : null);
      }

      t.buttonTextOverride = n(this.dynamicOverrides) || n(this.overrides) || t.overrides.buttonText, t.buttonTextDefault = n(this.localeDefaults) || n(this.dirDefaults) || t.defaults.buttonText || n(ne.defaults) || (t.duration ? this.humanizeDuration(t.duration) : null) || e;
    }
  }), ne.mixin({
    el: null,
    contentEl: null,
    suggestedViewHeight: null,
    windowResizeProxy: null,
    ignoreWindowResize: 0,
    render: function render() {
      this.contentEl ? this.elementVisible() && (this.calcSize(), this.renderView()) : this.initialRender();
    },
    initialRender: function initialRender() {
      var e = this,
          n = this.el;
      n.addClass("fc"), n.on("click.fc", "a[data-goto]", function (n) {
        var i = t(this).data("goto"),
            r = e.moment(i.date),
            s = i.type,
            o = e.view.opt("navLink" + rt(s) + "Click");
        "function" == typeof o ? o(r, n) : ("string" == typeof o && (s = o), e.zoomTo(r, s));
      }), this.optionsModel.watch("applyingThemeClasses", ["?theme"], function (t) {
        n.toggleClass("ui-widget", t.theme), n.toggleClass("fc-unthemed", !t.theme);
      }), this.optionsModel.watch("applyingDirClasses", ["?isRTL", "?locale"], function (t) {
        n.toggleClass("fc-ltr", !t.isRTL), n.toggleClass("fc-rtl", t.isRTL);
      }), this.contentEl = t("<div class='fc-view-container'/>").prependTo(n), this.initToolbars(), this.renderHeader(), this.renderFooter(), this.renderView(this.opt("defaultView")), this.opt("handleWindowResize") && t(window).resize(this.windowResizeProxy = lt(this.windowResize.bind(this), this.opt("windowResizeDelay")));
    },
    destroy: function destroy() {
      this.view && this.view.removeElement(), this.toolbarsManager.proxyCall("removeElement"), this.contentEl.remove(), this.el.removeClass("fc fc-ltr fc-rtl fc-unthemed ui-widget"), this.el.off(".fc"), this.windowResizeProxy && (t(window).unbind("resize", this.windowResizeProxy), this.windowResizeProxy = null), Gt.unneeded();
    },
    elementVisible: function elementVisible() {
      return this.el.is(":visible");
    },
    renderView: function renderView(e, n) {
      this.ignoreWindowResize++;
      var i = this.view && e && this.view.type !== e;
      i && (this.freezeContentHeight(), this.clearView()), !this.view && e && (this.view = this.viewsByType[e] || (this.viewsByType[e] = this.instantiateView(e)), this.view.setElement(t("<div class='fc-view fc-" + e + "-view' />").appendTo(this.contentEl)), this.toolbarsManager.proxyCall("activateButton", e)), this.view && (n && this.view.addForcedScroll(n), this.elementVisible() && (this.currentDate = this.view.setDate(this.currentDate))), i && this.thawContentHeight(), this.ignoreWindowResize--;
    },
    clearView: function clearView() {
      this.toolbarsManager.proxyCall("deactivateButton", this.view.type), this.view.removeElement(), this.view = null;
    },
    reinitView: function reinitView() {
      this.ignoreWindowResize++, this.freezeContentHeight();
      var t = this.view.type,
          e = this.view.queryScroll();
      this.clearView(), this.calcSize(), this.renderView(t, e), this.thawContentHeight(), this.ignoreWindowResize--;
    },
    getSuggestedViewHeight: function getSuggestedViewHeight() {
      return null === this.suggestedViewHeight && this.calcSize(), this.suggestedViewHeight;
    },
    isHeightAuto: function isHeightAuto() {
      return "auto" === this.opt("contentHeight") || "auto" === this.opt("height");
    },
    updateSize: function updateSize(t) {
      if (this.elementVisible()) return t && this._calcSize(), this.ignoreWindowResize++, this.view.updateSize(!0), this.ignoreWindowResize--, !0;
    },
    calcSize: function calcSize() {
      this.elementVisible() && this._calcSize();
    },
    _calcSize: function _calcSize() {
      var t = this.opt("contentHeight"),
          e = this.opt("height");
      this.suggestedViewHeight = "number" == typeof t ? t : "function" == typeof t ? t() : "number" == typeof e ? e - this.queryToolbarsHeight() : "function" == typeof e ? e() - this.queryToolbarsHeight() : "parent" === e ? this.el.parent().height() - this.queryToolbarsHeight() : Math.round(this.contentEl.width() / Math.max(this.opt("aspectRatio"), .5));
    },
    windowResize: function windowResize(t) {
      !this.ignoreWindowResize && t.target === window && this.view.renderRange && this.updateSize(!0) && this.view.publiclyTrigger("windowResize", this.el[0]);
    },
    freezeContentHeight: function freezeContentHeight() {
      this.contentEl.css({
        width: "100%",
        height: this.contentEl.height(),
        overflow: "hidden"
      });
    },
    thawContentHeight: function thawContentHeight() {
      this.contentEl.css({
        width: "",
        height: "",
        overflow: ""
      });
    }
  }), ne.mixin({
    header: null,
    footer: null,
    toolbarsManager: null,
    initToolbars: function initToolbars() {
      this.header = new ee(this, this.computeHeaderOptions()), this.footer = new ee(this, this.computeFooterOptions()), this.toolbarsManager = new te([this.header, this.footer]);
    },
    computeHeaderOptions: function computeHeaderOptions() {
      return {
        extraClasses: "fc-header-toolbar",
        layout: this.opt("header")
      };
    },
    computeFooterOptions: function computeFooterOptions() {
      return {
        extraClasses: "fc-footer-toolbar",
        layout: this.opt("footer")
      };
    },
    renderHeader: function renderHeader() {
      var t = this.header;
      t.setToolbarOptions(this.computeHeaderOptions()), t.render(), t.el && this.el.prepend(t.el);
    },
    renderFooter: function renderFooter() {
      var t = this.footer;
      t.setToolbarOptions(this.computeFooterOptions()), t.render(), t.el && this.el.append(t.el);
    },
    setToolbarsTitle: function setToolbarsTitle(t) {
      this.toolbarsManager.proxyCall("updateTitle", t);
    },
    updateToolbarButtons: function updateToolbarButtons() {
      var t = this.getNow(),
          e = this.view,
          n = e.buildDateProfile(t),
          i = e.buildPrevDateProfile(this.currentDate),
          r = e.buildNextDateProfile(this.currentDate);
      this.toolbarsManager.proxyCall(n.isValid && !Y(t, e.currentRange) ? "enableButton" : "disableButton", "today"), this.toolbarsManager.proxyCall(i.isValid ? "enableButton" : "disableButton", "prev"), this.toolbarsManager.proxyCall(r.isValid ? "enableButton" : "disableButton", "next");
    },
    queryToolbarsHeight: function queryToolbarsHeight() {
      return this.toolbarsManager.items.reduce(function (t, e) {
        return t + (e.el ? e.el.outerHeight(!0) : 0);
      }, 0);
    }
  }), ne.defaults = {
    titleRangeSeparator: " – ",
    monthYearFormat: "MMMM YYYY",
    defaultTimedEventDuration: "02:00:00",
    defaultAllDayEventDuration: {
      days: 1
    },
    forceEventDuration: !1,
    nextDayThreshold: "09:00:00",
    defaultView: "month",
    aspectRatio: 1.35,
    header: {
      left: "title",
      center: "",
      right: "today prev,next"
    },
    weekends: !0,
    weekNumbers: !1,
    weekNumberTitle: "W",
    weekNumberCalculation: "local",
    scrollTime: "06:00:00",
    minTime: "00:00:00",
    maxTime: "24:00:00",
    showNonCurrentDates: !0,
    lazyFetching: !0,
    startParam: "start",
    endParam: "end",
    timezoneParam: "timezone",
    timezone: !1,
    isRTL: !1,
    buttonText: {
      prev: "prev",
      next: "next",
      prevYear: "prev year",
      nextYear: "next year",
      year: "year",
      today: "today",
      month: "month",
      week: "week",
      day: "day"
    },
    buttonIcons: {
      prev: "left-single-arrow",
      next: "right-single-arrow",
      prevYear: "left-double-arrow",
      nextYear: "right-double-arrow"
    },
    allDayText: "all-day",
    theme: !1,
    themeButtonIcons: {
      prev: "circle-triangle-w",
      next: "circle-triangle-e",
      prevYear: "seek-prev",
      nextYear: "seek-next"
    },
    dragOpacity: .75,
    dragRevertDuration: 500,
    dragScroll: !0,
    unselectAuto: !0,
    dropAccept: "*",
    eventOrder: "title",
    eventLimit: !1,
    eventLimitText: "more",
    eventLimitClick: "popover",
    dayPopoverFormat: "LL",
    handleWindowResize: !0,
    windowResizeDelay: 100,
    longPressDelay: 1e3
  }, ne.englishDefaults = {
    dayPopoverFormat: "dddd, MMMM D"
  }, ne.rtlDefaults = {
    header: {
      left: "next,prev today",
      center: "",
      right: "title"
    },
    buttonIcons: {
      prev: "right-single-arrow",
      next: "left-single-arrow",
      prevYear: "right-double-arrow",
      nextYear: "left-double-arrow"
    },
    themeButtonIcons: {
      prev: "circle-triangle-e",
      next: "circle-triangle-w",
      nextYear: "seek-prev",
      prevYear: "seek-next"
    }
  };
  var ie = n.locales = {};
  n.datepickerLocale = function (e, n, i) {
    var r = ie[e] || (ie[e] = {});
    r.isRTL = i.isRTL, r.weekNumberTitle = i.weekHeader, t.each(re, function (t, e) {
      r[t] = e(i);
    }), t.datepicker && (t.datepicker.regional[n] = t.datepicker.regional[e] = i, t.datepicker.regional.en = t.datepicker.regional[""], t.datepicker.setDefaults(i));
  }, n.locale = function (e, n) {
    var i, r;
    i = ie[e] || (ie[e] = {}), n && (i = ie[e] = s([i, n])), r = le(e), t.each(se, function (t, e) {
      null == i[t] && (i[t] = e(r, i));
    }), ne.defaults.locale = e;
  };
  var re = {
    buttonText: function buttonText(t) {
      return {
        prev: nt(t.prevText),
        next: nt(t.nextText),
        today: nt(t.currentText)
      };
    },
    monthYearFormat: function monthYearFormat(t) {
      return t.showMonthAfterYear ? "YYYY[" + t.yearSuffix + "] MMMM" : "MMMM YYYY[" + t.yearSuffix + "]";
    }
  },
      se = {
    dayOfMonthFormat: function dayOfMonthFormat(t, e) {
      var n = t.longDateFormat("l");
      return n = n.replace(/^Y+[^\w\s]*|[^\w\s]*Y+$/g, ""), e.isRTL ? n += " ddd" : n = "ddd " + n, n;
    },
    mediumTimeFormat: function mediumTimeFormat(t) {
      return t.longDateFormat("LT").replace(/\s*a$/i, "a");
    },
    smallTimeFormat: function smallTimeFormat(t) {
      return t.longDateFormat("LT").replace(":mm", "(:mm)").replace(/(\Wmm)$/, "($1)").replace(/\s*a$/i, "a");
    },
    extraSmallTimeFormat: function extraSmallTimeFormat(t) {
      return t.longDateFormat("LT").replace(":mm", "(:mm)").replace(/(\Wmm)$/, "($1)").replace(/\s*a$/i, "t");
    },
    hourFormat: function hourFormat(t) {
      return t.longDateFormat("LT").replace(":mm", "").replace(/(\Wmm)$/, "").replace(/\s*a$/i, "a");
    },
    noMeridiemTimeFormat: function noMeridiemTimeFormat(t) {
      return t.longDateFormat("LT").replace(/\s*a$/i, "");
    }
  },
      oe = {
    smallDayDateFormat: function smallDayDateFormat(t) {
      return t.isRTL ? "D dd" : "dd D";
    },
    weekFormat: function weekFormat(t) {
      return t.isRTL ? "w[ " + t.weekNumberTitle + "]" : "[" + t.weekNumberTitle + " ]w";
    },
    smallWeekFormat: function smallWeekFormat(t) {
      return t.isRTL ? "w[" + t.weekNumberTitle + "]" : "[" + t.weekNumberTitle + "]w";
    }
  };

  function ae(e) {
    t.each(oe, function (t, n) {
      null == e[t] && (e[t] = n(e));
    });
  }

  function le(t) {
    return e.localeData(t) || e.localeData("en");
  }

  n.locale("en", ne.englishDefaults), n.sourceNormalizers = [], n.sourceFetchers = [];
  var ue = {
    dataType: "json",
    cache: !1
  },
      he = 1;

  function ce(t) {
    t._allDay = t.allDay, t._start = t.start.clone(), t._end = t.end ? t.end.clone() : null;
  }

  ne.prototype.mutateSeg = function (t, e) {
    return this.mutateEvent(t.event, e);
  }, ne.prototype.normalizeEvent = function (t) {}, ne.prototype.spanContainsSpan = function (t, e) {
    var n = t.start.clone().stripZone(),
        i = this.getEventEnd(t).stripZone();
    return e.start >= n && e.end <= i;
  }, ne.prototype.getPeerEvents = function (t, e) {
    var n,
        i,
        r = this.getEventCache(),
        s = [];

    for (n = 0; n < r.length; n++) {
      i = r[n], e && e._id === i._id || s.push(i);
    }

    return s;
  }, ne.prototype.isEventSpanAllowed = function (t, e) {
    var n = e.source || {},
        i = this.opt("eventAllow"),
        r = tt(e.constraint, n.constraint, this.opt("eventConstraint")),
        s = tt(e.overlap, n.overlap, this.opt("eventOverlap"));
    return this.isSpanAllowed(t, r, s, e) && (!i || !1 !== i(t, e));
  }, ne.prototype.isExternalSpanAllowed = function (e, n, i) {
    var r, s;
    return i && (r = t.extend({}, i, n), s = this.expandEvent(this.buildEventFromInput(r))[0]), s ? this.isEventSpanAllowed(e, s) : this.isSelectionSpanAllowed(e);
  }, ne.prototype.isSelectionSpanAllowed = function (t) {
    var e = this.opt("selectAllow");
    return this.isSpanAllowed(t, this.opt("selectConstraint"), this.opt("selectOverlap")) && (!e || !1 !== e(t));
  }, ne.prototype.isSpanAllowed = function (t, e, n, i) {
    var r, s, o, a, l, u;

    if (null != e && (r = this.constraintToEvents(e))) {
      for (s = !1, a = 0; a < r.length; a++) {
        if (this.spanContainsSpan(r[a], t)) {
          s = !0;
          break;
        }
      }

      if (!s) return !1;
    }

    for (o = this.getPeerEvents(t, i), a = 0; a < o.length; a++) {
      if (l = o[a], this.eventIntersectsRange(l, t)) {
        if (!1 === n) return !1;
        if ("function" == typeof n && !n(l, i)) return !1;

        if (i) {
          if (!1 === (u = tt(l.overlap, (l.source || {}).overlap))) return !1;
          if ("function" == typeof u && !u(i, l)) return !1;
        }
      }
    }

    return !0;
  }, ne.prototype.constraintToEvents = function (t) {
    return "businessHours" === t ? this.getCurrentBusinessHourEvents() : "object" == _typeof(t) ? null != t.start ? this.expandEvent(this.buildEventFromInput(t)) : null : this.clientEvents(t);
  }, ne.prototype.eventIntersectsRange = function (t, e) {
    var n = t.start.clone().stripZone(),
        i = this.getEventEnd(t).stripZone();
    return e.start < i && e.end > n;
  };
  var de = {
    id: "_fcBusinessHours",
    start: "09:00",
    end: "17:00",
    dow: [1, 2, 3, 4, 5],
    rendering: "inverse-background"
  };
  ne.prototype.getCurrentBusinessHourEvents = function (t) {
    return this.computeBusinessHourEvents(t, this.opt("businessHours"));
  }, ne.prototype.computeBusinessHourEvents = function (e, n) {
    return !0 === n ? this.expandBusinessHourEvents(e, [{}]) : t.isPlainObject(n) ? this.expandBusinessHourEvents(e, [n]) : t.isArray(n) ? this.expandBusinessHourEvents(e, n, !0) : [];
  }, ne.prototype.expandBusinessHourEvents = function (e, n, i) {
    var r,
        s,
        o = this.getView(),
        a = [];

    for (r = 0; r < n.length; r++) {
      s = n[r], i && !s.dow || (s = t.extend({}, de, s), e && (s.start = null, s.end = null), a.push.apply(a, this.expandEvent(this.buildEventFromInput(s), o.activeRange.start, o.activeRange.end)));
    }

    return a;
  };
  var fe = n.BasicView = Kt.extend({
    scroller: null,
    dayGridClass: Ut,
    dayGrid: null,
    dayNumbersVisible: !1,
    colWeekNumbersVisible: !1,
    cellWeekNumbersVisible: !1,
    weekNumberWidth: null,
    headContainerEl: null,
    headRowEl: null,
    initialize: function initialize() {
      this.dayGrid = this.instantiateDayGrid(), this.scroller = new Jt({
        overflowX: "hidden",
        overflowY: "auto"
      });
    },
    instantiateDayGrid: function instantiateDayGrid() {
      return new (this.dayGridClass.extend(ge))(this);
    },
    buildRenderRange: function buildRenderRange(t, e) {
      var n = Kt.prototype.buildRenderRange.apply(this, arguments);
      return /^(year|month)$/.test(e) && (n.start.startOf("week"), n.end.weekday() && n.end.add(1, "week").startOf("week")), this.trimHiddenDays(n);
    },
    renderDates: function renderDates() {
      this.dayGrid.breakOnWeeks = /year|month|week/.test(this.currentRangeUnit), this.dayGrid.setRange(this.renderRange), this.dayNumbersVisible = this.dayGrid.rowCnt > 1, this.opt("weekNumbers") && (this.opt("weekNumbersWithinDays") ? (this.cellWeekNumbersVisible = !0, this.colWeekNumbersVisible = !1) : (this.cellWeekNumbersVisible = !1, this.colWeekNumbersVisible = !0)), this.dayGrid.numbersVisible = this.dayNumbersVisible || this.cellWeekNumbersVisible || this.colWeekNumbersVisible, this.el.addClass("fc-basic-view").html(this.renderSkeletonHtml()), this.renderHead(), this.scroller.render();
      var e = this.scroller.el.addClass("fc-day-grid-container"),
          n = t('<div class="fc-day-grid" />').appendTo(e);
      this.el.find(".fc-body > tr > td").append(e), this.dayGrid.setElement(n), this.dayGrid.renderDates(this.hasRigidRows());
    },
    renderHead: function renderHead() {
      this.headContainerEl = this.el.find(".fc-head-container").html(this.dayGrid.renderHeadHtml()), this.headRowEl = this.headContainerEl.find(".fc-row");
    },
    unrenderDates: function unrenderDates() {
      this.dayGrid.unrenderDates(), this.dayGrid.removeElement(), this.scroller.destroy();
    },
    renderBusinessHours: function renderBusinessHours() {
      this.dayGrid.renderBusinessHours();
    },
    unrenderBusinessHours: function unrenderBusinessHours() {
      this.dayGrid.unrenderBusinessHours();
    },
    renderSkeletonHtml: function renderSkeletonHtml() {
      return '<table><thead class="fc-head"><tr><td class="fc-head-container ' + this.widgetHeaderClass + '"></td></tr></thead><tbody class="fc-body"><tr><td class="' + this.widgetContentClass + '"></td></tr></tbody></table>';
    },
    weekNumberStyleAttr: function weekNumberStyleAttr() {
      return null !== this.weekNumberWidth ? 'style="width:' + this.weekNumberWidth + 'px"' : "";
    },
    hasRigidRows: function hasRigidRows() {
      var t = this.opt("eventLimit");
      return t && "number" != typeof t;
    },
    updateWidth: function updateWidth() {
      this.colWeekNumbersVisible && (this.weekNumberWidth = d(this.el.find(".fc-week-number")));
    },
    setHeight: function setHeight(t, e) {
      var n,
          i,
          r = this.opt("eventLimit");
      this.scroller.clear(), a(this.headRowEl), this.dayGrid.removeSegPopover(), r && "number" == typeof r && this.dayGrid.limitRows(r), n = this.computeScrollerHeight(t), this.setGridHeight(n, e), r && "number" != typeof r && this.dayGrid.limitRows(r), e || (this.scroller.setHeight(n), ((i = this.scroller.getScrollbarWidths()).left || i.right) && (o(this.headRowEl, i), n = this.computeScrollerHeight(t), this.scroller.setHeight(n)), this.scroller.lockOverflow(i));
    },
    computeScrollerHeight: function computeScrollerHeight(t) {
      return t - f(this.el, this.scroller.el);
    },
    setGridHeight: function setGridHeight(t, e) {
      e ? c(this.dayGrid.rowEls) : h(this.dayGrid.rowEls, t, !0);
    },
    computeInitialDateScroll: function computeInitialDateScroll() {
      return {
        top: 0
      };
    },
    queryDateScroll: function queryDateScroll() {
      return {
        top: this.scroller.getScrollTop()
      };
    },
    applyDateScroll: function applyDateScroll(t) {
      void 0 !== t.top && this.scroller.setScrollTop(t.top);
    },
    hitsNeeded: function hitsNeeded() {
      this.dayGrid.hitsNeeded();
    },
    hitsNotNeeded: function hitsNotNeeded() {
      this.dayGrid.hitsNotNeeded();
    },
    prepareHits: function prepareHits() {
      this.dayGrid.prepareHits();
    },
    releaseHits: function releaseHits() {
      this.dayGrid.releaseHits();
    },
    queryHit: function queryHit(t, e) {
      return this.dayGrid.queryHit(t, e);
    },
    getHitSpan: function getHitSpan(t) {
      return this.dayGrid.getHitSpan(t);
    },
    getHitEl: function getHitEl(t) {
      return this.dayGrid.getHitEl(t);
    },
    renderEvents: function renderEvents(t) {
      this.dayGrid.renderEvents(t), this.updateHeight();
    },
    getEventSegs: function getEventSegs() {
      return this.dayGrid.getEventSegs();
    },
    unrenderEvents: function unrenderEvents() {
      this.dayGrid.unrenderEvents();
    },
    renderDrag: function renderDrag(t, e) {
      return this.dayGrid.renderDrag(t, e);
    },
    unrenderDrag: function unrenderDrag() {
      this.dayGrid.unrenderDrag();
    },
    renderSelection: function renderSelection(t) {
      this.dayGrid.renderSelection(t);
    },
    unrenderSelection: function unrenderSelection() {
      this.dayGrid.unrenderSelection();
    }
  }),
      ge = {
    renderHeadIntroHtml: function renderHeadIntroHtml() {
      var t = this.view;
      return t.colWeekNumbersVisible ? '<th class="fc-week-number ' + t.widgetHeaderClass + '" ' + t.weekNumberStyleAttr() + "><span>" + et(t.opt("weekNumberTitle")) + "</span></th>" : "";
    },
    renderNumberIntroHtml: function renderNumberIntroHtml(t) {
      var e = this.view,
          n = this.getCellDate(t, 0);
      return e.colWeekNumbersVisible ? '<td class="fc-week-number" ' + e.weekNumberStyleAttr() + ">" + e.buildGotoAnchorHtml({
        date: n,
        type: "week",
        forceOff: 1 === this.colCnt
      }, n.format("w")) + "</td>" : "";
    },
    renderBgIntroHtml: function renderBgIntroHtml() {
      var t = this.view;
      return t.colWeekNumbersVisible ? '<td class="fc-week-number ' + t.widgetContentClass + '" ' + t.weekNumberStyleAttr() + "></td>" : "";
    },
    renderIntroHtml: function renderIntroHtml() {
      var t = this.view;
      return t.colWeekNumbersVisible ? '<td class="fc-week-number" ' + t.weekNumberStyleAttr() + "></td>" : "";
    }
  },
      pe = n.MonthView = fe.extend({
    buildRenderRange: function buildRenderRange() {
      var t,
          e = fe.prototype.buildRenderRange.apply(this, arguments);
      return this.isFixedWeeks() && (t = Math.ceil(e.end.diff(e.start, "weeks", !0)), e.end.add(6 - t, "weeks")), e;
    },
    setGridHeight: function setGridHeight(t, e) {
      e && (t *= this.rowCnt / 6), h(this.dayGrid.rowEls, t, !e);
    },
    isFixedWeeks: function isFixedWeeks() {
      return this.opt("fixedWeekCount");
    }
  });
  i.basic = {
    "class": fe
  }, i.basicDay = {
    type: "basic",
    duration: {
      days: 1
    }
  }, i.basicWeek = {
    type: "basic",
    duration: {
      weeks: 1
    }
  }, i.month = {
    "class": pe,
    duration: {
      months: 1
    },
    defaults: {
      fixedWeekCount: !0
    }
  };
  var ve = n.AgendaView = Kt.extend({
    scroller: null,
    timeGridClass: $t,
    timeGrid: null,
    dayGridClass: Ut,
    dayGrid: null,
    axisWidth: null,
    headContainerEl: null,
    noScrollRowEls: null,
    bottomRuleEl: null,
    usesMinMaxTime: !0,
    initialize: function initialize() {
      this.timeGrid = this.instantiateTimeGrid(), this.opt("allDaySlot") && (this.dayGrid = this.instantiateDayGrid()), this.scroller = new Jt({
        overflowX: "hidden",
        overflowY: "auto"
      });
    },
    instantiateTimeGrid: function instantiateTimeGrid() {
      return new (this.timeGridClass.extend(me))(this);
    },
    instantiateDayGrid: function instantiateDayGrid() {
      return new (this.dayGridClass.extend(ye))(this);
    },
    renderDates: function renderDates() {
      this.timeGrid.setRange(this.renderRange), this.dayGrid && this.dayGrid.setRange(this.renderRange), this.el.addClass("fc-agenda-view").html(this.renderSkeletonHtml()), this.renderHead(), this.scroller.render();
      var e = this.scroller.el.addClass("fc-time-grid-container"),
          n = t('<div class="fc-time-grid" />').appendTo(e);
      this.el.find(".fc-body > tr > td").append(e), this.timeGrid.setElement(n), this.timeGrid.renderDates(), this.bottomRuleEl = t('<hr class="fc-divider ' + this.widgetHeaderClass + '"/>').appendTo(this.timeGrid.el), this.dayGrid && (this.dayGrid.setElement(this.el.find(".fc-day-grid")), this.dayGrid.renderDates(), this.dayGrid.bottomCoordPadding = this.dayGrid.el.next("hr").outerHeight()), this.noScrollRowEls = this.el.find(".fc-row:not(.fc-scroller *)");
    },
    renderHead: function renderHead() {
      this.headContainerEl = this.el.find(".fc-head-container").html(this.timeGrid.renderHeadHtml());
    },
    unrenderDates: function unrenderDates() {
      this.timeGrid.unrenderDates(), this.timeGrid.removeElement(), this.dayGrid && (this.dayGrid.unrenderDates(), this.dayGrid.removeElement()), this.scroller.destroy();
    },
    renderSkeletonHtml: function renderSkeletonHtml() {
      return '<table><thead class="fc-head"><tr><td class="fc-head-container ' + this.widgetHeaderClass + '"></td></tr></thead><tbody class="fc-body"><tr><td class="' + this.widgetContentClass + '">' + (this.dayGrid ? '<div class="fc-day-grid"/><hr class="fc-divider ' + this.widgetHeaderClass + '"/>' : "") + "</td></tr></tbody></table>";
    },
    axisStyleAttr: function axisStyleAttr() {
      return null !== this.axisWidth ? 'style="width:' + this.axisWidth + 'px"' : "";
    },
    renderBusinessHours: function renderBusinessHours() {
      this.timeGrid.renderBusinessHours(), this.dayGrid && this.dayGrid.renderBusinessHours();
    },
    unrenderBusinessHours: function unrenderBusinessHours() {
      this.timeGrid.unrenderBusinessHours(), this.dayGrid && this.dayGrid.unrenderBusinessHours();
    },
    getNowIndicatorUnit: function getNowIndicatorUnit() {
      return this.timeGrid.getNowIndicatorUnit();
    },
    renderNowIndicator: function renderNowIndicator(t) {
      this.timeGrid.renderNowIndicator(t);
    },
    unrenderNowIndicator: function unrenderNowIndicator() {
      this.timeGrid.unrenderNowIndicator();
    },
    updateSize: function updateSize(t) {
      this.timeGrid.updateSize(t), Kt.prototype.updateSize.call(this, t);
    },
    updateWidth: function updateWidth() {
      this.axisWidth = d(this.el.find(".fc-axis"));
    },
    setHeight: function setHeight(t, e) {
      var n, i, r;
      this.bottomRuleEl.hide(), this.scroller.clear(), a(this.noScrollRowEls), this.dayGrid && (this.dayGrid.removeSegPopover(), (n = this.opt("eventLimit")) && "number" != typeof n && (n = we), n && this.dayGrid.limitRows(n)), e || (i = this.computeScrollerHeight(t), this.scroller.setHeight(i), ((r = this.scroller.getScrollbarWidths()).left || r.right) && (o(this.noScrollRowEls, r), i = this.computeScrollerHeight(t), this.scroller.setHeight(i)), this.scroller.lockOverflow(r), this.timeGrid.getTotalSlatHeight() < i && this.bottomRuleEl.show());
    },
    computeScrollerHeight: function computeScrollerHeight(t) {
      return t - f(this.el, this.scroller.el);
    },
    computeInitialDateScroll: function computeInitialDateScroll() {
      var t = e.duration(this.opt("scrollTime")),
          n = this.timeGrid.computeTimeTop(t);
      return (n = Math.ceil(n)) && n++, {
        top: n
      };
    },
    queryDateScroll: function queryDateScroll() {
      return {
        top: this.scroller.getScrollTop()
      };
    },
    applyDateScroll: function applyDateScroll(t) {
      void 0 !== t.top && this.scroller.setScrollTop(t.top);
    },
    hitsNeeded: function hitsNeeded() {
      this.timeGrid.hitsNeeded(), this.dayGrid && this.dayGrid.hitsNeeded();
    },
    hitsNotNeeded: function hitsNotNeeded() {
      this.timeGrid.hitsNotNeeded(), this.dayGrid && this.dayGrid.hitsNotNeeded();
    },
    prepareHits: function prepareHits() {
      this.timeGrid.prepareHits(), this.dayGrid && this.dayGrid.prepareHits();
    },
    releaseHits: function releaseHits() {
      this.timeGrid.releaseHits(), this.dayGrid && this.dayGrid.releaseHits();
    },
    queryHit: function queryHit(t, e) {
      var n = this.timeGrid.queryHit(t, e);
      return !n && this.dayGrid && (n = this.dayGrid.queryHit(t, e)), n;
    },
    getHitSpan: function getHitSpan(t) {
      return t.component.getHitSpan(t);
    },
    getHitEl: function getHitEl(t) {
      return t.component.getHitEl(t);
    },
    renderEvents: function renderEvents(t) {
      var e,
          n = [],
          i = [];

      for (e = 0; e < t.length; e++) {
        t[e].allDay ? n.push(t[e]) : i.push(t[e]);
      }

      this.timeGrid.renderEvents(i), this.dayGrid && this.dayGrid.renderEvents(n), this.updateHeight();
    },
    getEventSegs: function getEventSegs() {
      return this.timeGrid.getEventSegs().concat(this.dayGrid ? this.dayGrid.getEventSegs() : []);
    },
    unrenderEvents: function unrenderEvents() {
      this.timeGrid.unrenderEvents(), this.dayGrid && this.dayGrid.unrenderEvents();
    },
    renderDrag: function renderDrag(t, e) {
      return t.start.hasTime() ? this.timeGrid.renderDrag(t, e) : this.dayGrid ? this.dayGrid.renderDrag(t, e) : void 0;
    },
    unrenderDrag: function unrenderDrag() {
      this.timeGrid.unrenderDrag(), this.dayGrid && this.dayGrid.unrenderDrag();
    },
    renderSelection: function renderSelection(t) {
      t.start.hasTime() || t.end.hasTime() ? this.timeGrid.renderSelection(t) : this.dayGrid && this.dayGrid.renderSelection(t);
    },
    unrenderSelection: function unrenderSelection() {
      this.timeGrid.unrenderSelection(), this.dayGrid && this.dayGrid.unrenderSelection();
    }
  }),
      me = {
    renderHeadIntroHtml: function renderHeadIntroHtml() {
      var t,
          e = this.view;
      return e.opt("weekNumbers") ? (t = this.start.format(e.opt("smallWeekFormat")), '<th class="fc-axis fc-week-number ' + e.widgetHeaderClass + '" ' + e.axisStyleAttr() + ">" + e.buildGotoAnchorHtml({
        date: this.start,
        type: "week",
        forceOff: this.colCnt > 1
      }, et(t)) + "</th>") : '<th class="fc-axis ' + e.widgetHeaderClass + '" ' + e.axisStyleAttr() + "></th>";
    },
    renderBgIntroHtml: function renderBgIntroHtml() {
      var t = this.view;
      return '<td class="fc-axis ' + t.widgetContentClass + '" ' + t.axisStyleAttr() + "></td>";
    },
    renderIntroHtml: function renderIntroHtml() {
      return '<td class="fc-axis" ' + this.view.axisStyleAttr() + "></td>";
    }
  },
      ye = {
    renderBgIntroHtml: function renderBgIntroHtml() {
      var t = this.view;
      return '<td class="fc-axis ' + t.widgetContentClass + '" ' + t.axisStyleAttr() + "><span>" + t.getAllDayHtml() + "</span></td>";
    },
    renderIntroHtml: function renderIntroHtml() {
      return '<td class="fc-axis" ' + this.view.axisStyleAttr() + "></td>";
    }
  },
      we = 5,
      Se = [{
    hours: 1
  }, {
    minutes: 30
  }, {
    minutes: 15
  }, {
    seconds: 30
  }, {
    seconds: 15
  }];
  i.agenda = {
    "class": ve,
    defaults: {
      allDaySlot: !0,
      slotDuration: "00:30:00",
      slotEventOverlap: !0
    }
  }, i.agendaDay = {
    type: "agenda",
    duration: {
      days: 1
    }
  }, i.agendaWeek = {
    type: "agenda",
    duration: {
      weeks: 1
    }
  };
  var be = Kt.extend({
    grid: null,
    scroller: null,
    initialize: function initialize() {
      this.grid = new Ee(this), this.scroller = new Jt({
        overflowX: "hidden",
        overflowY: "auto"
      });
    },
    renderSkeleton: function renderSkeleton() {
      this.el.addClass("fc-list-view " + this.widgetContentClass), this.scroller.render(), this.scroller.el.appendTo(this.el), this.grid.setElement(this.scroller.scrollEl);
    },
    unrenderSkeleton: function unrenderSkeleton() {
      this.scroller.destroy();
    },
    setHeight: function setHeight(t, e) {
      this.scroller.setHeight(this.computeScrollerHeight(t));
    },
    computeScrollerHeight: function computeScrollerHeight(t) {
      return t - f(this.el, this.scroller.el);
    },
    renderDates: function renderDates() {
      this.grid.setRange(this.renderRange);
    },
    renderEvents: function renderEvents(t) {
      this.grid.renderEvents(t);
    },
    unrenderEvents: function unrenderEvents() {
      this.grid.unrenderEvents();
    },
    isEventResizable: function isEventResizable(t) {
      return !1;
    },
    isEventDraggable: function isEventDraggable(t) {
      return !1;
    }
  }),
      Ee = Ot.extend({
    segSelector: ".fc-list-item",
    hasDayInteractions: !1,
    spanToSegs: function spanToSegs(t) {
      for (var e, n = this.view, i = n.renderRange.start.clone().time(0), r = 0, s = []; i < n.renderRange.end;) {
        if ((e = B(t, {
          start: i,
          end: i.clone().add(1, "day")
        })) && (e.dayIndex = r, s.push(e)), i.add(1, "day"), r++, e && !e.isEnd && t.end.hasTime() && t.end < i.clone().add(this.view.nextDayThreshold)) {
          e.end = t.end.clone(), e.isEnd = !0;
          break;
        }
      }

      return s;
    },
    computeEventTimeFormat: function computeEventTimeFormat() {
      return this.view.opt("mediumTimeFormat");
    },
    handleSegClick: function handleSegClick(e, n) {
      var i;
      Ot.prototype.handleSegClick.apply(this, arguments), t(n.target).closest("a[href]").length || (i = e.event.url) && !n.isDefaultPrevented() && (window.location.href = i);
    },
    renderFgSegs: function renderFgSegs(t) {
      return (t = this.renderFgSegEls(t)).length ? this.renderSegList(t) : this.renderEmptyMessage(), t;
    },
    renderEmptyMessage: function renderEmptyMessage() {
      this.el.html('<div class="fc-list-empty-wrap2"><div class="fc-list-empty-wrap1"><div class="fc-list-empty">' + et(this.view.opt("noEventsMessage")) + "</div></div></div>");
    },
    renderSegList: function renderSegList(e) {
      var n,
          i,
          r,
          s = this.groupSegsByDay(e),
          o = t('<table class="fc-list-table"><tbody/></table>'),
          a = o.find("tbody");

      for (n = 0; n < s.length; n++) {
        if (i = s[n]) for (a.append(this.dayHeaderHtml(this.view.renderRange.start.clone().add(n, "days"))), this.sortEventSegs(i), r = 0; r < i.length; r++) {
          a.append(i[r].el);
        }
      }

      this.el.empty().append(o);
    },
    groupSegsByDay: function groupSegsByDay(t) {
      var e,
          n,
          i = [];

      for (e = 0; e < t.length; e++) {
        (i[(n = t[e]).dayIndex] || (i[n.dayIndex] = [])).push(n);
      }

      return i;
    },
    dayHeaderHtml: function dayHeaderHtml(t) {
      var e = this.view,
          n = e.opt("listDayFormat"),
          i = e.opt("listDayAltFormat");
      return '<tr class="fc-list-heading" data-date="' + t.format("YYYY-MM-DD") + '"><td class="' + e.widgetHeaderClass + '" colspan="3">' + (n ? e.buildGotoAnchorHtml(t, {
        "class": "fc-list-heading-main"
      }, et(t.format(n))) : "") + (i ? e.buildGotoAnchorHtml(t, {
        "class": "fc-list-heading-alt"
      }, et(t.format(i))) : "") + "</td></tr>";
    },
    fgSegHtml: function fgSegHtml(t) {
      var e,
          n = this.view,
          i = ["fc-list-item"].concat(this.getSegCustomClasses(t)),
          r = this.getSegBackgroundColor(t),
          s = t.event,
          o = s.url;
      return e = s.allDay ? n.getAllDayHtml() : n.isMultiDayEvent(s) ? t.isStart || t.isEnd ? et(this.getEventTimeText(t)) : n.getAllDayHtml() : et(this.getEventTimeText(s)), o && i.push("fc-has-url"), '<tr class="' + i.join(" ") + '">' + (this.displayEventTime ? '<td class="fc-list-item-time ' + n.widgetContentClass + '">' + (e || "") + "</td>" : "") + '<td class="fc-list-item-marker ' + n.widgetContentClass + '"><span class="fc-event-dot"' + (r ? ' style="background-color:' + r + '"' : "") + '></span></td><td class="fc-list-item-title ' + n.widgetContentClass + '"><a' + (o ? ' href="' + et(o) + '"' : "") + ">" + et(t.event.title || "") + "</a></td></tr>";
    }
  });
  return i.list = {
    "class": be,
    buttonTextKey: "list",
    defaults: {
      buttonText: "list",
      listDayFormat: "LL",
      noEventsMessage: "No events to display"
    }
  }, i.listDay = {
    type: "list",
    duration: {
      days: 1
    },
    defaults: {
      listDayFormat: "dddd"
    }
  }, i.listWeek = {
    type: "list",
    duration: {
      weeks: 1
    },
    defaults: {
      listDayFormat: "dddd",
      listDayAltFormat: "LL"
    }
  }, i.listMonth = {
    type: "list",
    duration: {
      month: 1
    },
    defaults: {
      listDayAltFormat: "dddd"
    }
  }, i.listYear = {
    type: "list",
    duration: {
      year: 1
    },
    defaults: {
      listDayAltFormat: "dddd"
    }
  }, n;
});
/*//////////////*/

/* LOCALISATION */

/*//////////////*/

!function (e) {
   true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js"), __webpack_require__(/*! moment */ "./node_modules/moment/moment.js")], __WEBPACK_AMD_DEFINE_FACTORY__ = (e),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : 0;
}(function (e, t) {
  !function () {
    function e(e, t) {
      var _ = e.split("_");

      return t % 10 == 1 && t % 100 != 11 ? _[0] : t % 10 >= 2 && t % 10 <= 4 && (t % 100 < 10 || t % 100 >= 20) ? _[1] : _[2];
    }

    function _(t, _, n) {
      var a = {
        mm: _ ? "хвилина_хвилини_хвилин" : "хвилину_хвилини_хвилин",
        hh: _ ? "година_години_годин" : "годину_години_годин",
        dd: "день_дні_днів",
        MM: "місяць_місяці_місяців",
        yy: "рік_роки_років"
      };
      return "m" === n ? _ ? "хвилина" : "хвилину" : "h" === n ? _ ? "година" : "годину" : t + " " + e(a[n], +t);
    }

    function n(e, t) {
      var _ = {
        nominative: "неділя_понеділок_вівторок_середа_четвер_п’ятниця_субота".split("_"),
        accusative: "неділю_понеділок_вівторок_середу_четвер_п’ятницю_суботу".split("_"),
        genitive: "неділі_понеділка_вівторка_середи_четверга_п’ятниці_суботи".split("_")
      };
      return e ? _[/(\[[ВвУу]\]) ?dddd/.test(t) ? "accusative" : /\[?(?:минулої|наступної)? ?\] ?dddd/.test(t) ? "genitive" : "nominative"][e.day()] : _.nominative;
    }

    function a(e) {
      return function () {
        return e + "о" + (11 === this.hours() ? "б" : "") + "] LT";
      };
    }

    t.defineLocale("uk", {
      months: {
        format: "січня_лютого_березня_квітня_травня_червня_липня_серпня_вересня_жовтня_листопада_грудня".split("_"),
        standalone: "січень_лютий_березень_квітень_травень_червень_липень_серпень_вересень_жовтень_листопад_грудень".split("_")
      },
      monthsShort: "січ_лют_бер_квіт_трав_черв_лип_серп_вер_жовт_лист_груд".split("_"),
      weekdays: n,
      weekdaysShort: "нд_пн_вт_ср_чт_пт_сб".split("_"),
      weekdaysMin: "нд_пн_вт_ср_чт_пт_сб".split("_"),
      longDateFormat: {
        LT: "HH:mm",
        LTS: "HH:mm:ss",
        L: "DD.MM.YYYY",
        LL: "D MMMM YYYY р.",
        LLL: "D MMMM YYYY р., HH:mm",
        LLLL: "dddd, D MMMM YYYY р., HH:mm"
      },
      calendar: {
        sameDay: a("[Сьогодні "),
        nextDay: a("[Завтра "),
        lastDay: a("[Вчора "),
        nextWeek: a("[У] dddd ["),
        lastWeek: function lastWeek() {
          switch (this.day()) {
            case 0:
            case 3:
            case 5:
            case 6:
              return a("[Минулої] dddd [").call(this);

            case 1:
            case 2:
            case 4:
              return a("[Минулого] dddd [").call(this);
          }
        },
        sameElse: "L"
      },
      relativeTime: {
        future: "за %s",
        past: "%s тому",
        s: "декілька секунд",
        m: _,
        mm: _,
        h: "годину",
        hh: _,
        d: "день",
        dd: _,
        M: "місяць",
        MM: _,
        y: "рік",
        yy: _
      },
      meridiemParse: /ночі|ранку|дня|вечора/,
      isPM: function isPM(e) {
        return /^(дня|вечора)$/.test(e);
      },
      meridiem: function meridiem(e, t, _) {
        return e < 4 ? "ночі" : e < 12 ? "ранку" : e < 17 ? "дня" : "вечора";
      },
      dayOfMonthOrdinalParse: /\d{1,2}-(й|го)/,
      ordinal: function ordinal(e, t) {
        switch (t) {
          case "M":
          case "d":
          case "DDD":
          case "w":
          case "W":
            return e + "-й";

          case "D":
            return e + "-го";

          default:
            return e;
        }
      },
      week: {
        dow: 1,
        doy: 7
      }
    });
  }(), e.fullCalendar.datepickerLocale("uk", "uk", {
    closeText: "Закрити",
    prevText: "&#x3C;",
    nextText: "&#x3E;",
    currentText: "Сьогодні",
    monthNames: ["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень"],
    monthNamesShort: ["Січ", "Лют", "Бер", "Кві", "Тра", "Чер", "Лип", "Сер", "Вер", "Жов", "Лис", "Гру"],
    dayNames: ["неділя", "понеділок", "вівторок", "середа", "четвер", "п’ятниця", "субота"],
    dayNamesShort: ["Нд", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    dayNamesMin: ["Нд", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    weekHeader: "Тиж",
    dateFormat: "dd.mm.yy",
    firstDay: 1,
    isRTL: !1,
    showMonthAfterYear: !1,
    yearSuffix: ""
  }), e.fullCalendar.locale("uk", {
    buttonText: {
      month: "Місяць",
      week: "Тиждень",
      day: "День",
      list: "Порядок денний"
    },
    allDayText: "Увесь день",
    eventLimitText: function eventLimitText(e) {
      return "+ще " + e + "...";
    },
    noEventsMessage: "Немає подій для відображення"
  });
});
/*////////////////*/

/* CUSTOM SCRIPTS */

/*////////////////*/

jQuery(function ($) {
  /*if ($('#calendar').length) {*/
  var events = [{
    id: 'event_01',
    title: 'Золота Підкова Львівщини',
    start: '2021-04-25',
    end: '2021-05-30',
    className: 'still-have',
    url: 'tour.php'
  }, {
    id: 'event_02',
    title: '10 родзинок Закарпаття + долина нарцисів',
    start: '2021-04-27',
    end: '2021-05-30',
    className: 'have-a-lot',
    url: 'tour.php'
  }, {
    id: 'event_03',
    title: 'Кам’янець-Подільський, Чернівці + Бакота',
    start: '2021-04-28',
    end: '2021-05-15',
    className: 'no-have',
    url: 'tour.php'
  }, {
    id: 'event_04',
    title: 'Печера Атлантида, Хотин + круїз',
    start: '2021-04-12',
    end: '2021-05-01',
    className: 'have-a-lot',
    url: 'tour.php'
  }, {
    id: 'event_05',
    title: 'Похід на Пікуй',
    start: '2021-04-30',
    end: '2021-05-18',
    className: 'still-have',
    url: 'tour.php'
  }, {
    id: 'event_06',
    title: 'Тур-відпустка "Довкола Карпат за 7 днів"',
    start: '2021-05-23',
    end: '2021-05-30',
    className: 'have-a-lot',
    url: 'tour.php'
  }, {
    id: 'event_07',
    title: 'Сиро-Винний тур Закарпаттям',
    start: '2021-04-30',
    end: '2021-05-04',
    className: 'still-have',
    url: 'tour.php'
  }, {
    id: 'event_08',
    title: 'Озеро Синевир та водоспад Шипіт',
    start: '2021-05-16',
    end: '2021-05-16',
    className: 'still-have',
    url: 'tour.php'
  }, {
    id: 'event_09',
    title: 'Яремче, Буковель + Говерла',
    start: '2021-05-16',
    end: '2021-05-18',
    className: 'still-have',
    url: 'tour.php'
  }, {
    id: 'event_10',
    title: 'Тараканів, Дубно + тунель кохання',
    start: '2021-05-16',
    end: '2021-05-19',
    className: 'still-have',
    url: 'tour.php'
  }];
  $(document).delegate('.calendar-init', 'click', function () {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev title next today',
        center: '',
        right: 'agendaDay, month',
        locale: 'uk'
      },
      windowResize: function windowResize(view) {
        if ($(window).width() < 514) {
          $('#calendar').fullCalendar('changeView', 'basicDay');
        } else {
          $('#calendar').fullCalendar('changeView', 'month');
        }
      },
      eventAfterAllRender: function eventAfterAllRender(view) {
        $('.fc-toolbar').eq(1).replaceWith($('.fc-toolbar').eq(0).clone(true));
      },
      firstDay: 1,
      contentHeight: "auto",
      aspectRatio: 2,
      fixedWeekCount: false,
      navLinks: true,
      editable: false,
      eventLimit: true,
      defaultView: 'month',
      views: {
        agenda: {
          eventLimit: 0
        }
      },
      eventClick: function eventClick(calEvent) {
        if (event.url) {
          window.open(event.url);
          return false;
        }
      },
      events: events
    });
    $('.fc-toolbar').clone(true).insertAfter($('.fc-view-container'));
    $(this).removeClass('calendar-init');
  });
  $(document).delegate('.fc-day-grid-event', 'mouseenter', function () {
    var content = $(this).find('.fc-content').html(),
        event = $('.fc-day-grid-event');
    $(event).each(function () {
      if ($(this).find('.fc-content').html() == content) {
        $(this).addClass('hover');
      } else {
        $(this).removeClass('hover');
      }
    });
  });
  $(document).delegate('.fc-day-grid-event', 'mouseleave', function () {
    var event = $('.fc-day-grid-event');
    $(event).each(function () {
      $(this).removeClass('hover');
    });
  });
  /*$(document).delegate('.fc-event:not(.tooltip-wrap)', 'mouseenter', function() {
  	$(this).addClass('tooltip-wrap');
  	$(this).append('<span class="tooltip">' + $(this).find('.fc-title').html() + '</span>')
  });*/
});

/***/ }),

/***/ "./resources/js/libs/global.js":
/*!*************************************!*\
  !*** ./resources/js/libs/global.js ***!
  \*************************************/
/***/ (() => {

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var _functions = {},
    winWidth;
jQuery(function ($) {
  "use strict";
  /*##############*/

  /* 01 VARIABLES */

  /*##############*/

  var winScr,
      winWidth = $(window).width(),
      winHeight = $(window).height(),
      is_Mac = navigator.platform.toUpperCase().indexOf('MAC') >= 0,
      is_IE = /MSIE 9/i.test(navigator.userAgent) || /rv:11.0/i.test(navigator.userAgent) || /MSIE 10/i.test(navigator.userAgent) || /Edge\/\d+/.test(navigator.userAgent),
      is_Chrome = navigator.userAgent.indexOf('Chrome') >= 0 && navigator.userAgent.indexOf('Edge') < 0,
      isTouchScreen = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);
  /*###############################*/

  /* 02 FUNCTION ON DOCUMENT READY */

  /*###############################*/

  if (isTouchScreen) $('html').addClass('touch-screen');
  if (is_Mac) $('html').addClass('mac');
  if (is_IE) $('html').addClass('ie');
  if (is_Chrome) $('html').addClass('chrome');
  headerScrolled();
  goUpButtonScrolled();
  setTimeout(function () {
    lazyLoadImg();
    lazyLoadBg();
    lazyLoadVideo();
    $(".slider-range").each(function () {
      var $range = $(this),
          $input = $(this).parent().find('input');
      $(this).slider({
        range: true,
        min: $(this).data('min'),
        max: $(this).data('max'),
        values: $(this).data('values'),
        slide: function slide(event, ui) {
          $(this).parent().find('.range-min').text(ui.values[0]);
          $(this).parent().find('.range-max').text(ui.values[1]);
        }
      });
    });
  }, 200); // Lazy loadings for images, backgrounds adn videos

  function lazyLoadImg() {
    $('img[data-img-src]').each(function (i, el) {
      $(el).attr('src', $(el).data('img-src'));
    });
  }

  function lazyLoadBg() {
    $('[data-bg-src]').each(function (i, el) {
      $(el).css('background-image', 'url(' + $(el).data('bg-src') + ')');
    });
  }

  function lazyLoadVideo() {
    $('.video').each(function () {
      var video = '<video ' + ($(this).is('[data-autoplay]') ? 'autoplay' : '') + ' muted playsinline><source src="' + $(this).data('video-src') + '" type="video/mp4"></video>';
      $(this).prepend(video);
    });
  }
  /*############################*/

  /* 03 FUNCTION ON PAGE SCROLL */

  /*############################*/


  $(window).scroll(function () {
    _functions.scrollCall();
  });
  var prev_scroll = 0;

  _functions.scrollCall = function () {
    winScr = $(window).scrollTop();
    headerScrolled();
    goUpButtonScrolled();
  };

  _functions.scrollCall();
  /*###################*/

  /* 04 SWIPER SLIDERS */

  /*###################*/


  _functions.getSwOptions = function (swiper) {
    var options = swiper.data('options');
    options = !options || _typeof(options) !== 'object' ? {} : options;
    var $p = swiper.closest('.swiper-entry'),
        slidesLength = swiper.find('>.swiper-wrapper>.swiper-slide').length;
    if (!options.pagination) options.pagination = {
      el: $p.find('.swiper-pagination')[0],
      clickable: true
    };
    if (!options.navigation) options.navigation = {
      nextEl: $p.find('.swiper-button-next')[0],
      prevEl: $p.find('.swiper-button-prev')[0]
    };
    options.preloadImages = false;
    options.lazy = {
      loadPrevNext: true
    };
    options.observer = true;
    options.observeParents = true;
    options.watchOverflow = true;
    options.watchSlidesVisibility = true;
    if (!options.speed) options.speed = 500;
    options.roundLengths = false;
    if (!options.centerInsufficientSlides) options.centerInsufficientSlides = false;

    if (options.customFraction) {
      $p.addClass('custom-fraction-swiper');

      if (slidesLength > 1 && slidesLength < 10) {
        $p.find('.custom-current').text('01');
        $p.find('.custom-total').text('0' + slidesLength);
      } else if (slidesLength > 1) {
        $p.find('.custom-current').text('01');
        $p.find('.custom-total').text(slidesLength);
      }
    }

    if (isTouchScreen) options.direction = "horizontal";
    return options;
  };

  _functions.initSwiper = function (el) {
    var swiper = new Swiper(el[0], _functions.getSwOptions(el));
  };

  $('.swiper-entry .swiper-container').each(function () {
    _functions.initSwiper($(this));

    swiperConfig($(this));
  });

  function swiperConfig(el) {
    var slides = $(el).find('.swiper-slide:not(.swiper-slide-duplicate)'),
        visibleSlides = $(el).find('.swiper-slide-visible:not(.swiper-slide-duplicate)');

    if ($(slides).length <= $(visibleSlides).length) {
      $(el).parent().addClass('no-swipe');
    }
  }

  $('.swiper-thumbs').each(function () {
    var top = $(this).find('.swiper-container.swiper-thumbs-top')[0].swiper,
        bottom = $(this).find('.swiper-container.swiper-thumbs-bottom')[0].swiper;
    top.thumbs.swiper = bottom;
    top.thumbs.init();
    top.thumbs.update();
  });
  $('.swiper-control').each(function () {
    var top = $(this).find('.swiper-container')[0].swiper,
        bottom = $(this).find('.swiper-container')[1].swiper;
    top.controller.control = bottom;
    bottom.controller.control = top;
  });
  $('.custom-fraction-swiper').each(function () {
    var $this = $(this),
        $thisSwiper = $this.find('.swiper-container')[0].swiper;
    $thisSwiper.on('slideChange', function () {
      $this.find('.custom-current').text(function () {
        if ($thisSwiper.realIndex < 9) {
          return '0' + ($thisSwiper.realIndex + 1);
        } else {
          return $thisSwiper.realIndex + 1;
        }
      });
    });
  });
  /*##################################*/

  /* 06 BUTTONS, CLICKS, HOVER, FOCUS */

  /*##################################*/

  function headerLayerClose() {
    $('#header-layer-close').removeClass('active');
  }

  function headerLayerOpen() {
    $('#header-layer-close').addClass('active');
  }

  function mobileMenuClose() {
    $('nav').removeClass('active');
  }

  function mobileMenuOpen() {
    $('nav').addClass('active');
  }

  function menuBtnClose() {
    $('#menu-btn').removeClass('active');
  }

  function menuBtnOpen() {
    $('#menu-btn').addClass('active');
  }

  function searchDropdownClose() {
    $('#search-dropdown').removeClass('active');
  }

  function searchDropdownOpen() {
    $('#search-dropdown').addClass('active');
  }

  function tourSelectionClose() {
    $('#tour-selection-dropdown').removeClass('active');
  }

  function tourSelectionOpen() {
    $('#tour-selection-dropdown').addClass('active');
  } // Mobile menu button


  $('#menu-btn').on('click', function () {
    $('nav ul .dropdown-toggle').slideUp(330);
    $('.tel, .exchange, .lang, .log-inned').removeClass('active');
    tourSelectionClose();

    if ($(this).hasClass('active')) {
      addScroll();
      headerLayerClose();
      mobileMenuClose();
      menuBtnClose();
    } else {
      removeScroll();
      headerLayerOpen();
      mobileMenuOpen();
      menuBtnOpen();
    }
  }); // Mobile menu dropdown

  $('nav li.dropdown > span').on('click', function () {
    $('nav .only-mobile .dropdown').removeClass('active');
    $(this).parent().toggleClass('active');
    $(this).next().slideToggle(330);
  }); // Mobile menu layer close

  $('#header-layer-close').on('click', function () {
    addScroll();
    headerLayerClose();
    mobileMenuClose();
    menuBtnClose();
    tourSelectionClose();
    $('nav ul .dropdown-toggle').slideUp(330);
    $('.tel, .exchange, .lang, .log-inned').removeClass('active');
  }); // Mobile search dropdown open/close

  $('#search-btn').on('click', function () {
    removeScroll();
    headerLayerClose();
    mobileMenuClose();
    menuBtnClose();
    searchDropdownOpen();
    tourSelectionClose();
    $('nav ul .dropdown-toggle').slideUp(330);
    $('.tel, .exchange, .lang').removeClass('active');
  });
  $('#search-dropdown .btn-close').on('click', function () {
    addScroll();
    searchDropdownClose();
  }); // Header dropsowns

  $('header .row > div > .tel > .full-size, header .row > div > .exchange > .full-size, header .row > div > .lang > .full-size, header .row > div > .log-inned > .full-size').on('click', function () {
    var dropdown = $(this).parent();
    mobileMenuClose();
    menuBtnClose();
    searchDropdownClose();
    tourSelectionClose();
    $('nav ul .dropdown-toggle').slideUp(330);

    if ($(dropdown).hasClass('active')) {
      addScroll();
      headerLayerClose();
      $('.dropdown').removeClass('active');
    } else {
      removeScroll();
      headerLayerOpen();
      $('.dropdown').removeClass('active');
      $(dropdown).addClass('active');
    }
  }); // Mobile menu dropdowns

  $('nav .exchange > .full-size, nav .lang > .full-size').on('click', function () {
    var dropdown = $(this).parent();
    $('nav ul .dropdown-toggle').slideUp(330);

    if ($(dropdown).hasClass('active')) {
      $('.dropdown').removeClass('active');
    } else {
      $('.dropdown').removeClass('active');
      $(dropdown).addClass('active');
    }
  }); // Tour selection dropdown

  $('#tour-selection-btn').on('click', function () {
    removeScroll();
    headerLayerOpen();
    tourSelectionOpen();
  });
  $('#tour-selection-dropdown .btn-close').on('click', function () {
    addScroll();
    headerLayerClose();
    tourSelectionClose();
  }); // Datepicker events

  $('.single-datepicker .datepicker-input > span').on('click', function () {
    if ($(this).parent().hasClass('active')) {
      $(this).parent().removeClass('active');
    } else {
      $(this).parent().addClass('active');
    }
  });
  $('.double-datepicker .datepicker-input > span').on('click', function () {
    $($(this).parent()).toggleClass('active').siblings().removeClass('active');
  });
  $('.single-datepicker, .double-datepicker').on('mouseleave', function () {
    $(this).find('.datepicker-input').removeClass('active');
  });
  $(document).delegate('.fc-right button.fc-state-active', 'click', function () {
    $(this).parent().toggleClass('active');
  }); // Button scroll to top

  $('.btn-to-top').on('click', function () {
    $('html, body').animate({
      scrollTop: 0
    }, 1000);
  }); // Like click

  $('.like').on('click', function () {
    $(this).toggleClass('active');
  }); // Decrement

  $(document).delegate('.number-input .decrement', 'click', function () {
    var $input = $(this).siblings('input'),
        val = parseInt($input.val()),
        min = parseInt($input.attr('min')),
        step = parseInt($input.attr('step')),
        temp = val - step;
    $input.val(temp >= min ? temp : min);
  }); // Increment

  $(document).delegate('.number-input .increment', 'click', function () {
    var $input = $(this).siblings('input'),
        val = parseInt($input.val()),
        max = parseInt($input.attr('max')),
        step = parseInt($input.attr('step')),
        temp = val + step;
    $input.val(temp <= max ? temp : max);
  }); // Popup

  var popupTop = 0;

  function removeScroll() {
    popupTop = $(window).scrollTop();
    $('html').css({
      "position": "fixed",
      "top": -$(window).scrollTop(),
      "width": "100%"
    });
  }

  function addScroll() {
    $('html').css({
      "position": "static"
    });
    window.scroll(0, popupTop);
  }

  _functions.openPopup = function (popup) {
    $('.popup-content').removeClass('active');
    $(popup + ', .popup-wrap').addClass('active');
    removeScroll();
  };

  _functions.closePopup = function () {
    $('.popup-wrap, .popup-content').removeClass('active');
    addScroll();
  };

  _functions.textPopup = function (title, description) {
    $('#text-popup .text-popup-title').html(title);
    $('#text-popup .text-popup-description').html(description);

    _functions.openPopup('#text-popup');
  };

  $(document).on('click', '.open-popup', function (e) {
    e.preventDefault();
    headerLayerClose();
    mobileMenuClose();
    menuBtnClose();
    tourSelectionClose();
    $('.dropdown').removeClass('active');

    _functions.openPopup('.popup-content[data-rel="' + $(this).data('rel') + '"]');
  });
  $(document).on('click', '.close-popup, .popup-wrap .btn-close:not(.btn-delete), .popup-wrap .layer-close', function (e) {
    e.preventDefault();

    _functions.closePopup();
  }); // Video pop-up

  $(document).on('click', '.video-open', function (e) {
    e.preventDefault();
    var video = $(this).attr('href');
    $('.video-popup-container iframe').attr('src', video);
    $('.video-popup').addClass('active');
    $('html').addClass('overflow-hidden');
  });
  $('.video-popup-close, .video-popup-layer').on('click', function (e) {
    $('html').removeClass('overflow-hidden');
    $('.video-popup').removeClass('active');
    $('.video-popup-container iframe').attr('src', 'about:blank');
    e.preventDefault();
  }); //accordion

  function pageScroll(current) {
    $('html, body').animate({
      scrollTop: current.offset().top - $('header').outerHeight()
    }, 420);
  }

  $(document).on('click', '.accordion-title', function () {
    var current = $(this);

    if (current.parent().hasClass('active')) {
      current.parent().removeClass('active');
      current.next().slideUp(300);
    } else {
      current.parent().addClass('active');
      current.next().slideDown(function () {
        pageScroll(current);
      });
      pageScroll(current);
    }
  }); //expand all accordion

  $(document).on('click', '.expand-all', function () {
    var headerHeight = $('header').outerHeight() + 40,
        current = $(this),
        topAccordion = $(this).parents('.accordion-all-expand');

    if (current.hasClass('up')) {
      current.parents('.accordion-all-expand').find('.accordion-item').removeClass('active').find('.accordion-inner').slideUp();
    } else {
      current.parents('.accordion-all-expand').find('.accordion-item').addClass('active').find('.accordion-inner').slideDown(function () {
        pageScroll(topAccordion, headerHeight);
      });
    }
  }); //tabs

  $(document).on('click', '.tab-title', function () {
    $(this).parent().toggleClass('active');
  });
  $(document).on('click', '.tab-toggle .tab-caption', function () {
    var tab = $(this).closest('.tabs').find('.tab'),
        tabIndex = $(this).index(),
        topTabIndex = tabIndex + 1;
    $(this).addClass('active').siblings().removeClass('active');
    tab.eq(tabIndex).addClass('active').siblings().removeClass('active');
    $('.tab-top-part').removeClass('active');
    $('.tab-top-part[data-tab="' + topTabIndex + '"]').addClass('active');
    $(this).parents('.tab-nav').removeClass('active').find('.tab-title').text($(this).find('> span').text());
  });
  $(document).on('click', '.tab-prev', function () {
    $(this).closest('.tabs').find('.tab.active').removeClass('active').prev().addClass('active');
    $(this).closest('.tabs').find('.tab-caption.active').removeClass('active').prev().addClass('active');
    var index = $('.tab.active').index() + 1;
    $('.tab-top-part').removeClass('active');
    $('.tab-top-part[data-tab="' + index + '"]').addClass('active');
  });
  $(document).on('click', '.tab-next', function () {
    $(this).closest('.tabs').find('.tab.active').removeClass('active').next().addClass('active');
    $(this).closest('.tabs').find('.tab-caption.active').removeClass('active').next().addClass('active');
    var index = $('.tab.active').index() + 1;
    $('.tab-top-part').removeClass('active');
    $('.tab-top-part[data-tab="' + index + '"]').addClass('active');
  }); // Calculator clicks

  $('.calc-row .checkbox input').on('change', function () {
    if ($(this).parent().parent().hasClass('checked')) {
      $(this).parent().parent().removeClass('checked');
    } else {
      $(this).parent().parent().addClass('checked');
    }

    calcTotalPrice($(this));
  });
  $('.calc-row .number-input button').on('click', function () {
    var amountProduct = parseInt($(this).closest('.calc-row').find('.number-input input').val()),
        productPrice = parseInt($(this).closest('.calc-row').find('.calc-item-price').attr('data-price'));
    $(this).closest('.calc-row').find('.calc-item-price').html(amountProduct * productPrice);
    calcTotalPrice($(this));
  });

  function calcTotalPrice(el) {
    var eachItem = $(el).closest('.calc-rows-wrap').find('.calc-row.checked'),
        allSummProduct = 0;
    $(eachItem).each(function () {
      allSummProduct += +$(this).find('.calc-item-price').html();
    });
    $(el).closest('.calc').find('.calc-total-price').html(allSummProduct);
  } // Input focus


  $('input, textarea').on('focus', function () {
    $(this).parent().addClass('active');
  }); // Input blur

  $('input, textarea').on('blur', function () {
    if ($(this).val()) {
      $(this).parent().addClass('active');
    } else {
      $(this).parent().removeClass('active');
    }

    if ($(this).is(':invalid')) {
      $(this).parent().addClass('invalid');
    } else {
      $(this).parent().removeClass('invalid');
    }
  }); //input mask tel

  $('input.input[type="tel"]').on('focus', function () {
    $(this).inputmask({
      "mask": "+38 (999) 999-99-99"
    });
  }); // Upload image

  $('.img-input:not(.btn) input').on('change', function (e) {
    var $t = $(this);

    if (this.files && this.files[0]) {
      var upload = new FileReader();

      upload.onload = function (e) {
        $t.closest('.img-input-wrap').append('<div class="loaded-img"><img src="' + e.target.result + '" alt="img"><div class="btn-delete"></div></div>');
      };

      upload.readAsDataURL(this.files[0]);
    }
  });
  $('.img-input.btn input').on('change', function (e) {
    var $t = $(this);

    if (this.files && this.files[0]) {
      var upload = new FileReader();

      upload.onload = function (e) {
        $t.closest('.img-input-wrap').find('.img img').remove();
        $t.closest('.img-input-wrap').find('.img').append('<img src="' + e.target.result + '" alt="img">');
      };

      upload.readAsDataURL(this.files[0]);
    }
  }); // Remove image

  $(document).on('click', '.loaded-img .btn-delete', function () {
    $(this).closest('.loaded-img').remove();
  }); // Show more info

  $('.show-more').on('click', function () {
    $(this).toggleClass('active');
    $(this).parents('.load-more-wrapp').find('.more-info').slideToggle(300);
  }); // Remove participant

  $('.participant .btn-delete').on('click', function () {
    $(this).closest('.participant').remove();
    $('.participant').each(function () {
      $(this).find('.h4 span').html($(this).index() + 1);
    });
  }); // Apartment form

  $(document).on('click', '.apartment-option .number-input button', function () {
    var val = parseInt($(this).parent().find('input').val());

    if (val > 0) {
      $(this).closest('.apartment-option').addClass('active');
    } else {
      $(this).closest('.apartment-option').removeClass('active');
    }
  }); // Radio button with accordion

  $('.radio-accordion').on('change', function () {
    var radioAccordion = $(this).siblings(),
        radioAccordionToggle = $(radioAccordion).find('.radio-accordion-toggle');
    $(radioAccordionToggle).slideUp(300);
    $(this).find('.radio-accordion-toggle').slideDown(300);
  });
  /*###############*/

  /* 07 ANIMATIONS */

  /*###############*/

  function headerScrolled() {
    if (winScr >= $('header').outerHeight()) {
      $('header').addClass('scrolled');
    } else {
      $('header').removeClass('scrolled');
    }

    if (winScr >= 1 && $('.step-page').length) {
      $('.step-page').addClass('scrolled');
    } else {
      $('.step-page').removeClass('scrolled');
    }
  }

  function goUpButtonScrolled() {
    if (winScr >= $('header').outerHeight()) {
      $('.btn-to-top').addClass('active');
    } else {
      $('.btn-to-top').removeClass('active');
    }
  }
  /*#################*/

  /* 08 AUTOCOMPLETE */

  /*#################*/


  var availableTags = ['Манява — Драгобрат — полонина Перці', 'Тур-відпустка «6 днів у замових Карпатах»', 'Сиро-винний тур Закарпатським та Прикарпатським краями', 'Сиро-Винний тур Закарпаттям'];
  var availableTags = [{
    value: 'Сиро-Винний тур Закарпаттям',
    icon: 'img/preview_1.jpg'
  }, {
    value: 'Тур 10 родзинок Закарпаття',
    icon: 'img/preview_2.jpg'
  }, {
    value: 'Тур Різдво у Карпатах',
    icon: 'img/preview_3.jpg'
  }, {
    value: 'Тур Озера Карпат',
    icon: 'img/preview_4.jpg'
  }, {
    value: 'Тур Несамовите озеро в Карпатах',
    icon: 'img/preview_5.jpg'
  }];

  if ($('.input-search').length) {
    $('.input-search').each(function () {
      $(this).autocomplete({
        source: availableTags,
        open: function open(event, ui) {
          $(this).parent().addClass('active-autocomplete');
          $('.ui-menu').append('<li class="ui-menu-item-all">Всі результати пошуку</li>');

          if ($(this).parent().hasClass('search-dropdown-form')) {
            $('.ui-menu').addClass('no-shadow');
          }
        },
        close: function close(event, ui) {
          $(this).parent().removeClass('active-autocomplete');
        }
      }).autocomplete('instance')._renderItem = function (ul, item) {
        return $('<li>').append('<div><img src="' + item.icon + '" alt="preview image"/>' + '<span>' + item.value + '</span></div>').appendTo(ul);
      };
    });
  } // 09 Comments stars rank


  $('.rating-picker .select-icon').on('click', function () {
    $(this).addClass('active').siblings().removeClass('active');
    $(this).parent().addClass('active');
  });
});

/***/ }),

/***/ "./resources/js/libs/jquery-ui.min.js":
/*!********************************************!*\
  !*** ./resources/js/libs/jquery-ui.min.js ***!
  \********************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*###########*/

/* JQUERY UI */

/*###########*/
// jQuery UI - v1.12.1 - 2020-04-03
// http://jqueryui.com
// Includes: widget.js, position.js, data.js, disable-selection.js, focusable.js, form-reset-mixin.js, jquery-1-7.js, keycode.js, labels.js, scroll-parent.js, tabbable.js, unique-id.js, widgets/accordion.js, widgets/autocomplete.js, widgets/menu.js, widgets/mouse.js, widgets/slider.js
// Copyright jQuery Foundation and other contributors; Licensed MIT
(function (t) {
   true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")], __WEBPACK_AMD_DEFINE_FACTORY__ = (t),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : 0;
})(function (t) {
  function e(t) {
    for (var e = t.css("visibility"); "inherit" === e;) {
      t = t.parent(), e = t.css("visibility");
    }

    return "hidden" !== e;
  }

  t.ui = t.ui || {}, t.ui.version = "1.12.1";
  var i = 0,
      s = Array.prototype.slice;
  t.cleanData = function (e) {
    return function (i) {
      var s, n, o;

      for (o = 0; null != (n = i[o]); o++) {
        try {
          s = t._data(n, "events"), s && s.remove && t(n).triggerHandler("remove");
        } catch (a) {}
      }

      e(i);
    };
  }(t.cleanData), t.widget = function (e, i, s) {
    var n,
        o,
        a,
        r = {},
        h = e.split(".")[0];
    e = e.split(".")[1];
    var l = h + "-" + e;
    return s || (s = i, i = t.Widget), t.isArray(s) && (s = t.extend.apply(null, [{}].concat(s))), t.expr[":"][l.toLowerCase()] = function (e) {
      return !!t.data(e, l);
    }, t[h] = t[h] || {}, n = t[h][e], o = t[h][e] = function (t, e) {
      return this._createWidget ? (arguments.length && this._createWidget(t, e), void 0) : new o(t, e);
    }, t.extend(o, n, {
      version: s.version,
      _proto: t.extend({}, s),
      _childConstructors: []
    }), a = new i(), a.options = t.widget.extend({}, a.options), t.each(s, function (e, s) {
      return t.isFunction(s) ? (r[e] = function () {
        function t() {
          return i.prototype[e].apply(this, arguments);
        }

        function n(t) {
          return i.prototype[e].apply(this, t);
        }

        return function () {
          var e,
              i = this._super,
              o = this._superApply;
          return this._super = t, this._superApply = n, e = s.apply(this, arguments), this._super = i, this._superApply = o, e;
        };
      }(), void 0) : (r[e] = s, void 0);
    }), o.prototype = t.widget.extend(a, {
      widgetEventPrefix: n ? a.widgetEventPrefix || e : e
    }, r, {
      constructor: o,
      namespace: h,
      widgetName: e,
      widgetFullName: l
    }), n ? (t.each(n._childConstructors, function (e, i) {
      var s = i.prototype;
      t.widget(s.namespace + "." + s.widgetName, o, i._proto);
    }), delete n._childConstructors) : i._childConstructors.push(o), t.widget.bridge(e, o), o;
  }, t.widget.extend = function (e) {
    for (var i, n, o = s.call(arguments, 1), a = 0, r = o.length; r > a; a++) {
      for (i in o[a]) {
        n = o[a][i], o[a].hasOwnProperty(i) && void 0 !== n && (e[i] = t.isPlainObject(n) ? t.isPlainObject(e[i]) ? t.widget.extend({}, e[i], n) : t.widget.extend({}, n) : n);
      }
    }

    return e;
  }, t.widget.bridge = function (e, i) {
    var n = i.prototype.widgetFullName || e;

    t.fn[e] = function (o) {
      var a = "string" == typeof o,
          r = s.call(arguments, 1),
          h = this;
      return a ? this.length || "instance" !== o ? this.each(function () {
        var i,
            s = t.data(this, n);
        return "instance" === o ? (h = s, !1) : s ? t.isFunction(s[o]) && "_" !== o.charAt(0) ? (i = s[o].apply(s, r), i !== s && void 0 !== i ? (h = i && i.jquery ? h.pushStack(i.get()) : i, !1) : void 0) : t.error("no such method '" + o + "' for " + e + " widget instance") : t.error("cannot call methods on " + e + " prior to initialization; " + "attempted to call method '" + o + "'");
      }) : h = void 0 : (r.length && (o = t.widget.extend.apply(null, [o].concat(r))), this.each(function () {
        var e = t.data(this, n);
        e ? (e.option(o || {}), e._init && e._init()) : t.data(this, n, new i(o, this));
      })), h;
    };
  }, t.Widget = function () {}, t.Widget._childConstructors = [], t.Widget.prototype = {
    widgetName: "widget",
    widgetEventPrefix: "",
    defaultElement: "<div>",
    options: {
      classes: {},
      disabled: !1,
      create: null
    },
    _createWidget: function _createWidget(e, s) {
      s = t(s || this.defaultElement || this)[0], this.element = t(s), this.uuid = i++, this.eventNamespace = "." + this.widgetName + this.uuid, this.bindings = t(), this.hoverable = t(), this.focusable = t(), this.classesElementLookup = {}, s !== this && (t.data(s, this.widgetFullName, this), this._on(!0, this.element, {
        remove: function remove(t) {
          t.target === s && this.destroy();
        }
      }), this.document = t(s.style ? s.ownerDocument : s.document || s), this.window = t(this.document[0].defaultView || this.document[0].parentWindow)), this.options = t.widget.extend({}, this.options, this._getCreateOptions(), e), this._create(), this.options.disabled && this._setOptionDisabled(this.options.disabled), this._trigger("create", null, this._getCreateEventData()), this._init();
    },
    _getCreateOptions: function _getCreateOptions() {
      return {};
    },
    _getCreateEventData: t.noop,
    _create: t.noop,
    _init: t.noop,
    destroy: function destroy() {
      var e = this;
      this._destroy(), t.each(this.classesElementLookup, function (t, i) {
        e._removeClass(i, t);
      }), this.element.off(this.eventNamespace).removeData(this.widgetFullName), this.widget().off(this.eventNamespace).removeAttr("aria-disabled"), this.bindings.off(this.eventNamespace);
    },
    _destroy: t.noop,
    widget: function widget() {
      return this.element;
    },
    option: function option(e, i) {
      var s,
          n,
          o,
          a = e;
      if (0 === arguments.length) return t.widget.extend({}, this.options);
      if ("string" == typeof e) if (a = {}, s = e.split("."), e = s.shift(), s.length) {
        for (n = a[e] = t.widget.extend({}, this.options[e]), o = 0; s.length - 1 > o; o++) {
          n[s[o]] = n[s[o]] || {}, n = n[s[o]];
        }

        if (e = s.pop(), 1 === arguments.length) return void 0 === n[e] ? null : n[e];
        n[e] = i;
      } else {
        if (1 === arguments.length) return void 0 === this.options[e] ? null : this.options[e];
        a[e] = i;
      }
      return this._setOptions(a), this;
    },
    _setOptions: function _setOptions(t) {
      var e;

      for (e in t) {
        this._setOption(e, t[e]);
      }

      return this;
    },
    _setOption: function _setOption(t, e) {
      return "classes" === t && this._setOptionClasses(e), this.options[t] = e, "disabled" === t && this._setOptionDisabled(e), this;
    },
    _setOptionClasses: function _setOptionClasses(e) {
      var i, s, n;

      for (i in e) {
        n = this.classesElementLookup[i], e[i] !== this.options.classes[i] && n && n.length && (s = t(n.get()), this._removeClass(n, i), s.addClass(this._classes({
          element: s,
          keys: i,
          classes: e,
          add: !0
        })));
      }
    },
    _setOptionDisabled: function _setOptionDisabled(t) {
      this._toggleClass(this.widget(), this.widgetFullName + "-disabled", null, !!t), t && (this._removeClass(this.hoverable, null, "ui-state-hover"), this._removeClass(this.focusable, null, "ui-state-focus"));
    },
    enable: function enable() {
      return this._setOptions({
        disabled: !1
      });
    },
    disable: function disable() {
      return this._setOptions({
        disabled: !0
      });
    },
    _classes: function _classes(e) {
      function i(i, o) {
        var a, r;

        for (r = 0; i.length > r; r++) {
          a = n.classesElementLookup[i[r]] || t(), a = e.add ? t(t.unique(a.get().concat(e.element.get()))) : t(a.not(e.element).get()), n.classesElementLookup[i[r]] = a, s.push(i[r]), o && e.classes[i[r]] && s.push(e.classes[i[r]]);
        }
      }

      var s = [],
          n = this;
      return e = t.extend({
        element: this.element,
        classes: this.options.classes || {}
      }, e), this._on(e.element, {
        remove: "_untrackClassesElement"
      }), e.keys && i(e.keys.match(/\S+/g) || [], !0), e.extra && i(e.extra.match(/\S+/g) || []), s.join(" ");
    },
    _untrackClassesElement: function _untrackClassesElement(e) {
      var i = this;
      t.each(i.classesElementLookup, function (s, n) {
        -1 !== t.inArray(e.target, n) && (i.classesElementLookup[s] = t(n.not(e.target).get()));
      });
    },
    _removeClass: function _removeClass(t, e, i) {
      return this._toggleClass(t, e, i, !1);
    },
    _addClass: function _addClass(t, e, i) {
      return this._toggleClass(t, e, i, !0);
    },
    _toggleClass: function _toggleClass(t, e, i, s) {
      s = "boolean" == typeof s ? s : i;
      var n = "string" == typeof t || null === t,
          o = {
        extra: n ? e : i,
        keys: n ? t : e,
        element: n ? this.element : t,
        add: s
      };
      return o.element.toggleClass(this._classes(o), s), this;
    },
    _on: function _on(e, i, s) {
      var n,
          o = this;
      "boolean" != typeof e && (s = i, i = e, e = !1), s ? (i = n = t(i), this.bindings = this.bindings.add(i)) : (s = i, i = this.element, n = this.widget()), t.each(s, function (s, a) {
        function r() {
          return e || o.options.disabled !== !0 && !t(this).hasClass("ui-state-disabled") ? ("string" == typeof a ? o[a] : a).apply(o, arguments) : void 0;
        }

        "string" != typeof a && (r.guid = a.guid = a.guid || r.guid || t.guid++);
        var h = s.match(/^([\w:-]*)\s*(.*)$/),
            l = h[1] + o.eventNamespace,
            c = h[2];
        c ? n.on(l, c, r) : i.on(l, r);
      });
    },
    _off: function _off(e, i) {
      i = (i || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, e.off(i).off(i), this.bindings = t(this.bindings.not(e).get()), this.focusable = t(this.focusable.not(e).get()), this.hoverable = t(this.hoverable.not(e).get());
    },
    _delay: function _delay(t, e) {
      function i() {
        return ("string" == typeof t ? s[t] : t).apply(s, arguments);
      }

      var s = this;
      return setTimeout(i, e || 0);
    },
    _hoverable: function _hoverable(e) {
      this.hoverable = this.hoverable.add(e), this._on(e, {
        mouseenter: function mouseenter(e) {
          this._addClass(t(e.currentTarget), null, "ui-state-hover");
        },
        mouseleave: function mouseleave(e) {
          this._removeClass(t(e.currentTarget), null, "ui-state-hover");
        }
      });
    },
    _focusable: function _focusable(e) {
      this.focusable = this.focusable.add(e), this._on(e, {
        focusin: function focusin(e) {
          this._addClass(t(e.currentTarget), null, "ui-state-focus");
        },
        focusout: function focusout(e) {
          this._removeClass(t(e.currentTarget), null, "ui-state-focus");
        }
      });
    },
    _trigger: function _trigger(e, i, s) {
      var n,
          o,
          a = this.options[e];
      if (s = s || {}, i = t.Event(i), i.type = (e === this.widgetEventPrefix ? e : this.widgetEventPrefix + e).toLowerCase(), i.target = this.element[0], o = i.originalEvent) for (n in o) {
        n in i || (i[n] = o[n]);
      }
      return this.element.trigger(i, s), !(t.isFunction(a) && a.apply(this.element[0], [i].concat(s)) === !1 || i.isDefaultPrevented());
    }
  }, t.each({
    show: "fadeIn",
    hide: "fadeOut"
  }, function (e, i) {
    t.Widget.prototype["_" + e] = function (s, n, o) {
      "string" == typeof n && (n = {
        effect: n
      });
      var a,
          r = n ? n === !0 || "number" == typeof n ? i : n.effect || i : e;
      n = n || {}, "number" == typeof n && (n = {
        duration: n
      }), a = !t.isEmptyObject(n), n.complete = o, n.delay && s.delay(n.delay), a && t.effects && t.effects.effect[r] ? s[e](n) : r !== e && s[r] ? s[r](n.duration, n.easing, o) : s.queue(function (i) {
        t(this)[e](), o && o.call(s[0]), i();
      });
    };
  }), t.widget, function () {
    function e(t, e, i) {
      return [parseFloat(t[0]) * (u.test(t[0]) ? e / 100 : 1), parseFloat(t[1]) * (u.test(t[1]) ? i / 100 : 1)];
    }

    function i(e, i) {
      return parseInt(t.css(e, i), 10) || 0;
    }

    function s(e) {
      var i = e[0];
      return 9 === i.nodeType ? {
        width: e.width(),
        height: e.height(),
        offset: {
          top: 0,
          left: 0
        }
      } : t.isWindow(i) ? {
        width: e.width(),
        height: e.height(),
        offset: {
          top: e.scrollTop(),
          left: e.scrollLeft()
        }
      } : i.preventDefault ? {
        width: 0,
        height: 0,
        offset: {
          top: i.pageY,
          left: i.pageX
        }
      } : {
        width: e.outerWidth(),
        height: e.outerHeight(),
        offset: e.offset()
      };
    }

    var n,
        o = Math.max,
        a = Math.abs,
        r = /left|center|right/,
        h = /top|center|bottom/,
        l = /[\+\-]\d+(\.[\d]+)?%?/,
        c = /^\w+/,
        u = /%$/,
        d = t.fn.position;
    t.position = {
      scrollbarWidth: function scrollbarWidth() {
        if (void 0 !== n) return n;
        var e,
            i,
            s = t("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
            o = s.children()[0];
        return t("body").append(s), e = o.offsetWidth, s.css("overflow", "scroll"), i = o.offsetWidth, e === i && (i = s[0].clientWidth), s.remove(), n = e - i;
      },
      getScrollInfo: function getScrollInfo(e) {
        var i = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"),
            s = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"),
            n = "scroll" === i || "auto" === i && e.width < e.element[0].scrollWidth,
            o = "scroll" === s || "auto" === s && e.height < e.element[0].scrollHeight;
        return {
          width: o ? t.position.scrollbarWidth() : 0,
          height: n ? t.position.scrollbarWidth() : 0
        };
      },
      getWithinInfo: function getWithinInfo(e) {
        var i = t(e || window),
            s = t.isWindow(i[0]),
            n = !!i[0] && 9 === i[0].nodeType,
            o = !s && !n;
        return {
          element: i,
          isWindow: s,
          isDocument: n,
          offset: o ? t(e).offset() : {
            left: 0,
            top: 0
          },
          scrollLeft: i.scrollLeft(),
          scrollTop: i.scrollTop(),
          width: i.outerWidth(),
          height: i.outerHeight()
        };
      }
    }, t.fn.position = function (n) {
      if (!n || !n.of) return d.apply(this, arguments);
      n = t.extend({}, n);

      var u,
          p,
          f,
          g,
          m,
          _,
          v = t(n.of),
          b = t.position.getWithinInfo(n.within),
          y = t.position.getScrollInfo(b),
          w = (n.collision || "flip").split(" "),
          k = {};

      return _ = s(v), v[0].preventDefault && (n.at = "left top"), p = _.width, f = _.height, g = _.offset, m = t.extend({}, g), t.each(["my", "at"], function () {
        var t,
            e,
            i = (n[this] || "").split(" ");
        1 === i.length && (i = r.test(i[0]) ? i.concat(["center"]) : h.test(i[0]) ? ["center"].concat(i) : ["center", "center"]), i[0] = r.test(i[0]) ? i[0] : "center", i[1] = h.test(i[1]) ? i[1] : "center", t = l.exec(i[0]), e = l.exec(i[1]), k[this] = [t ? t[0] : 0, e ? e[0] : 0], n[this] = [c.exec(i[0])[0], c.exec(i[1])[0]];
      }), 1 === w.length && (w[1] = w[0]), "right" === n.at[0] ? m.left += p : "center" === n.at[0] && (m.left += p / 2), "bottom" === n.at[1] ? m.top += f : "center" === n.at[1] && (m.top += f / 2), u = e(k.at, p, f), m.left += u[0], m.top += u[1], this.each(function () {
        var s,
            r,
            h = t(this),
            l = h.outerWidth(),
            c = h.outerHeight(),
            d = i(this, "marginLeft"),
            _ = i(this, "marginTop"),
            x = l + d + i(this, "marginRight") + y.width,
            C = c + _ + i(this, "marginBottom") + y.height,
            D = t.extend({}, m),
            I = e(k.my, h.outerWidth(), h.outerHeight());

        "right" === n.my[0] ? D.left -= l : "center" === n.my[0] && (D.left -= l / 2), "bottom" === n.my[1] ? D.top -= c : "center" === n.my[1] && (D.top -= c / 2), D.left += I[0], D.top += I[1], s = {
          marginLeft: d,
          marginTop: _
        }, t.each(["left", "top"], function (e, i) {
          t.ui.position[w[e]] && t.ui.position[w[e]][i](D, {
            targetWidth: p,
            targetHeight: f,
            elemWidth: l,
            elemHeight: c,
            collisionPosition: s,
            collisionWidth: x,
            collisionHeight: C,
            offset: [u[0] + I[0], u[1] + I[1]],
            my: n.my,
            at: n.at,
            within: b,
            elem: h
          });
        }), n.using && (r = function r(t) {
          var e = g.left - D.left,
              i = e + p - l,
              s = g.top - D.top,
              r = s + f - c,
              u = {
            target: {
              element: v,
              left: g.left,
              top: g.top,
              width: p,
              height: f
            },
            element: {
              element: h,
              left: D.left,
              top: D.top,
              width: l,
              height: c
            },
            horizontal: 0 > i ? "left" : e > 0 ? "right" : "center",
            vertical: 0 > r ? "top" : s > 0 ? "bottom" : "middle"
          };
          l > p && p > a(e + i) && (u.horizontal = "center"), c > f && f > a(s + r) && (u.vertical = "middle"), u.important = o(a(e), a(i)) > o(a(s), a(r)) ? "horizontal" : "vertical", n.using.call(this, t, u);
        }), h.offset(t.extend(D, {
          using: r
        }));
      });
    }, t.ui.position = {
      fit: {
        left: function left(t, e) {
          var i,
              s = e.within,
              n = s.isWindow ? s.scrollLeft : s.offset.left,
              a = s.width,
              r = t.left - e.collisionPosition.marginLeft,
              h = n - r,
              l = r + e.collisionWidth - a - n;
          e.collisionWidth > a ? h > 0 && 0 >= l ? (i = t.left + h + e.collisionWidth - a - n, t.left += h - i) : t.left = l > 0 && 0 >= h ? n : h > l ? n + a - e.collisionWidth : n : h > 0 ? t.left += h : l > 0 ? t.left -= l : t.left = o(t.left - r, t.left);
        },
        top: function top(t, e) {
          var i,
              s = e.within,
              n = s.isWindow ? s.scrollTop : s.offset.top,
              a = e.within.height,
              r = t.top - e.collisionPosition.marginTop,
              h = n - r,
              l = r + e.collisionHeight - a - n;
          e.collisionHeight > a ? h > 0 && 0 >= l ? (i = t.top + h + e.collisionHeight - a - n, t.top += h - i) : t.top = l > 0 && 0 >= h ? n : h > l ? n + a - e.collisionHeight : n : h > 0 ? t.top += h : l > 0 ? t.top -= l : t.top = o(t.top - r, t.top);
        }
      },
      flip: {
        left: function left(t, e) {
          var i,
              s,
              n = e.within,
              o = n.offset.left + n.scrollLeft,
              r = n.width,
              h = n.isWindow ? n.scrollLeft : n.offset.left,
              l = t.left - e.collisionPosition.marginLeft,
              c = l - h,
              u = l + e.collisionWidth - r - h,
              d = "left" === e.my[0] ? -e.elemWidth : "right" === e.my[0] ? e.elemWidth : 0,
              p = "left" === e.at[0] ? e.targetWidth : "right" === e.at[0] ? -e.targetWidth : 0,
              f = -2 * e.offset[0];
          0 > c ? (i = t.left + d + p + f + e.collisionWidth - r - o, (0 > i || a(c) > i) && (t.left += d + p + f)) : u > 0 && (s = t.left - e.collisionPosition.marginLeft + d + p + f - h, (s > 0 || u > a(s)) && (t.left += d + p + f));
        },
        top: function top(t, e) {
          var i,
              s,
              n = e.within,
              o = n.offset.top + n.scrollTop,
              r = n.height,
              h = n.isWindow ? n.scrollTop : n.offset.top,
              l = t.top - e.collisionPosition.marginTop,
              c = l - h,
              u = l + e.collisionHeight - r - h,
              d = "top" === e.my[1],
              p = d ? -e.elemHeight : "bottom" === e.my[1] ? e.elemHeight : 0,
              f = "top" === e.at[1] ? e.targetHeight : "bottom" === e.at[1] ? -e.targetHeight : 0,
              g = -2 * e.offset[1];
          0 > c ? (s = t.top + p + f + g + e.collisionHeight - r - o, (0 > s || a(c) > s) && (t.top += p + f + g)) : u > 0 && (i = t.top - e.collisionPosition.marginTop + p + f + g - h, (i > 0 || u > a(i)) && (t.top += p + f + g));
        }
      },
      flipfit: {
        left: function left() {
          t.ui.position.flip.left.apply(this, arguments), t.ui.position.fit.left.apply(this, arguments);
        },
        top: function top() {
          t.ui.position.flip.top.apply(this, arguments), t.ui.position.fit.top.apply(this, arguments);
        }
      }
    };
  }(), t.ui.position, t.extend(t.expr[":"], {
    data: t.expr.createPseudo ? t.expr.createPseudo(function (e) {
      return function (i) {
        return !!t.data(i, e);
      };
    }) : function (e, i, s) {
      return !!t.data(e, s[3]);
    }
  }), t.fn.extend({
    disableSelection: function () {
      var t = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
      return function () {
        return this.on(t + ".ui-disableSelection", function (t) {
          t.preventDefault();
        });
      };
    }(),
    enableSelection: function enableSelection() {
      return this.off(".ui-disableSelection");
    }
  }), t.ui.focusable = function (i, s) {
    var n,
        o,
        a,
        r,
        h,
        l = i.nodeName.toLowerCase();
    return "area" === l ? (n = i.parentNode, o = n.name, i.href && o && "map" === n.nodeName.toLowerCase() ? (a = t("img[usemap='#" + o + "']"), a.length > 0 && a.is(":visible")) : !1) : (/^(input|select|textarea|button|object)$/.test(l) ? (r = !i.disabled, r && (h = t(i).closest("fieldset")[0], h && (r = !h.disabled))) : r = "a" === l ? i.href || s : s, r && t(i).is(":visible") && e(t(i)));
  }, t.extend(t.expr[":"], {
    focusable: function focusable(e) {
      return t.ui.focusable(e, null != t.attr(e, "tabindex"));
    }
  }), t.ui.focusable, t.fn.form = function () {
    return "string" == typeof this[0].form ? this.closest("form") : t(this[0].form);
  }, t.ui.formResetMixin = {
    _formResetHandler: function _formResetHandler() {
      var e = t(this);
      setTimeout(function () {
        var i = e.data("ui-form-reset-instances");
        t.each(i, function () {
          this.refresh();
        });
      });
    },
    _bindFormResetHandler: function _bindFormResetHandler() {
      if (this.form = this.element.form(), this.form.length) {
        var t = this.form.data("ui-form-reset-instances") || [];
        t.length || this.form.on("reset.ui-form-reset", this._formResetHandler), t.push(this), this.form.data("ui-form-reset-instances", t);
      }
    },
    _unbindFormResetHandler: function _unbindFormResetHandler() {
      if (this.form.length) {
        var e = this.form.data("ui-form-reset-instances");
        e.splice(t.inArray(this, e), 1), e.length ? this.form.data("ui-form-reset-instances", e) : this.form.removeData("ui-form-reset-instances").off("reset.ui-form-reset");
      }
    }
  }, "1.7" === t.fn.jquery.substring(0, 3) && (t.each(["Width", "Height"], function (e, i) {
    function s(e, i, s, o) {
      return t.each(n, function () {
        i -= parseFloat(t.css(e, "padding" + this)) || 0, s && (i -= parseFloat(t.css(e, "border" + this + "Width")) || 0), o && (i -= parseFloat(t.css(e, "margin" + this)) || 0);
      }), i;
    }

    var n = "Width" === i ? ["Left", "Right"] : ["Top", "Bottom"],
        o = i.toLowerCase(),
        a = {
      innerWidth: t.fn.innerWidth,
      innerHeight: t.fn.innerHeight,
      outerWidth: t.fn.outerWidth,
      outerHeight: t.fn.outerHeight
    };
    t.fn["inner" + i] = function (e) {
      return void 0 === e ? a["inner" + i].call(this) : this.each(function () {
        t(this).css(o, s(this, e) + "px");
      });
    }, t.fn["outer" + i] = function (e, n) {
      return "number" != typeof e ? a["outer" + i].call(this, e) : this.each(function () {
        t(this).css(o, s(this, e, !0, n) + "px");
      });
    };
  }), t.fn.addBack = function (t) {
    return this.add(null == t ? this.prevObject : this.prevObject.filter(t));
  }), t.ui.keyCode = {
    BACKSPACE: 8,
    COMMA: 188,
    DELETE: 46,
    DOWN: 40,
    END: 35,
    ENTER: 13,
    ESCAPE: 27,
    HOME: 36,
    LEFT: 37,
    PAGE_DOWN: 34,
    PAGE_UP: 33,
    PERIOD: 190,
    RIGHT: 39,
    SPACE: 32,
    TAB: 9,
    UP: 38
  }, t.ui.escapeSelector = function () {
    var t = /([!"#$%&'()*+,.\/:;<=>?@[\]^`{|}~])/g;
    return function (e) {
      return e.replace(t, "\\$1");
    };
  }(), t.fn.labels = function () {
    var e, i, s, n, o;
    return this[0].labels && this[0].labels.length ? this.pushStack(this[0].labels) : (n = this.eq(0).parents("label"), s = this.attr("id"), s && (e = this.eq(0).parents().last(), o = e.add(e.length ? e.siblings() : this.siblings()), i = "label[for='" + t.ui.escapeSelector(s) + "']", n = n.add(o.find(i).addBack(i))), this.pushStack(n));
  }, t.fn.scrollParent = function (e) {
    var i = this.css("position"),
        s = "absolute" === i,
        n = e ? /(auto|scroll|hidden)/ : /(auto|scroll)/,
        o = this.parents().filter(function () {
      var e = t(this);
      return s && "static" === e.css("position") ? !1 : n.test(e.css("overflow") + e.css("overflow-y") + e.css("overflow-x"));
    }).eq(0);
    return "fixed" !== i && o.length ? o : t(this[0].ownerDocument || document);
  }, t.extend(t.expr[":"], {
    tabbable: function tabbable(e) {
      var i = t.attr(e, "tabindex"),
          s = null != i;
      return (!s || i >= 0) && t.ui.focusable(e, s);
    }
  }), t.fn.extend({
    uniqueId: function () {
      var t = 0;
      return function () {
        return this.each(function () {
          this.id || (this.id = "ui-id-" + ++t);
        });
      };
    }(),
    removeUniqueId: function removeUniqueId() {
      return this.each(function () {
        /^ui-id-\d+$/.test(this.id) && t(this).removeAttr("id");
      });
    }
  }), t.widget("ui.accordion", {
    version: "1.12.1",
    options: {
      active: 0,
      animate: {},
      classes: {
        "ui-accordion-header": "ui-corner-top",
        "ui-accordion-header-collapsed": "ui-corner-all",
        "ui-accordion-content": "ui-corner-bottom"
      },
      collapsible: !1,
      event: "click",
      header: "> li > :first-child, > :not(li):even",
      heightStyle: "auto",
      icons: {
        activeHeader: "ui-icon-triangle-1-s",
        header: "ui-icon-triangle-1-e"
      },
      activate: null,
      beforeActivate: null
    },
    hideProps: {
      borderTopWidth: "hide",
      borderBottomWidth: "hide",
      paddingTop: "hide",
      paddingBottom: "hide",
      height: "hide"
    },
    showProps: {
      borderTopWidth: "show",
      borderBottomWidth: "show",
      paddingTop: "show",
      paddingBottom: "show",
      height: "show"
    },
    _create: function _create() {
      var e = this.options;
      this.prevShow = this.prevHide = t(), this._addClass("ui-accordion", "ui-widget ui-helper-reset"), this.element.attr("role", "tablist"), e.collapsible || e.active !== !1 && null != e.active || (e.active = 0), this._processPanels(), 0 > e.active && (e.active += this.headers.length), this._refresh();
    },
    _getCreateEventData: function _getCreateEventData() {
      return {
        header: this.active,
        panel: this.active.length ? this.active.next() : t()
      };
    },
    _createIcons: function _createIcons() {
      var e,
          i,
          s = this.options.icons;
      s && (e = t("<span>"), this._addClass(e, "ui-accordion-header-icon", "ui-icon " + s.header), e.prependTo(this.headers), i = this.active.children(".ui-accordion-header-icon"), this._removeClass(i, s.header)._addClass(i, null, s.activeHeader)._addClass(this.headers, "ui-accordion-icons"));
    },
    _destroyIcons: function _destroyIcons() {
      this._removeClass(this.headers, "ui-accordion-icons"), this.headers.children(".ui-accordion-header-icon").remove();
    },
    _destroy: function _destroy() {
      var t;
      this.element.removeAttr("role"), this.headers.removeAttr("role aria-expanded aria-selected aria-controls tabIndex").removeUniqueId(), this._destroyIcons(), t = this.headers.next().css("display", "").removeAttr("role aria-hidden aria-labelledby").removeUniqueId(), "content" !== this.options.heightStyle && t.css("height", "");
    },
    _setOption: function _setOption(t, e) {
      return "active" === t ? (this._activate(e), void 0) : ("event" === t && (this.options.event && this._off(this.headers, this.options.event), this._setupEvents(e)), this._super(t, e), "collapsible" !== t || e || this.options.active !== !1 || this._activate(0), "icons" === t && (this._destroyIcons(), e && this._createIcons()), void 0);
    },
    _setOptionDisabled: function _setOptionDisabled(t) {
      this._super(t), this.element.attr("aria-disabled", t), this._toggleClass(null, "ui-state-disabled", !!t), this._toggleClass(this.headers.add(this.headers.next()), null, "ui-state-disabled", !!t);
    },
    _keydown: function _keydown(e) {
      if (!e.altKey && !e.ctrlKey) {
        var i = t.ui.keyCode,
            s = this.headers.length,
            n = this.headers.index(e.target),
            o = !1;

        switch (e.keyCode) {
          case i.RIGHT:
          case i.DOWN:
            o = this.headers[(n + 1) % s];
            break;

          case i.LEFT:
          case i.UP:
            o = this.headers[(n - 1 + s) % s];
            break;

          case i.SPACE:
          case i.ENTER:
            this._eventHandler(e);

            break;

          case i.HOME:
            o = this.headers[0];
            break;

          case i.END:
            o = this.headers[s - 1];
        }

        o && (t(e.target).attr("tabIndex", -1), t(o).attr("tabIndex", 0), t(o).trigger("focus"), e.preventDefault());
      }
    },
    _panelKeyDown: function _panelKeyDown(e) {
      e.keyCode === t.ui.keyCode.UP && e.ctrlKey && t(e.currentTarget).prev().trigger("focus");
    },
    refresh: function refresh() {
      var e = this.options;
      this._processPanels(), e.active === !1 && e.collapsible === !0 || !this.headers.length ? (e.active = !1, this.active = t()) : e.active === !1 ? this._activate(0) : this.active.length && !t.contains(this.element[0], this.active[0]) ? this.headers.length === this.headers.find(".ui-state-disabled").length ? (e.active = !1, this.active = t()) : this._activate(Math.max(0, e.active - 1)) : e.active = this.headers.index(this.active), this._destroyIcons(), this._refresh();
    },
    _processPanels: function _processPanels() {
      var t = this.headers,
          e = this.panels;
      this.headers = this.element.find(this.options.header), this._addClass(this.headers, "ui-accordion-header ui-accordion-header-collapsed", "ui-state-default"), this.panels = this.headers.next().filter(":not(.ui-accordion-content-active)").hide(), this._addClass(this.panels, "ui-accordion-content", "ui-helper-reset ui-widget-content"), e && (this._off(t.not(this.headers)), this._off(e.not(this.panels)));
    },
    _refresh: function _refresh() {
      var e,
          i = this.options,
          s = i.heightStyle,
          n = this.element.parent();
      this.active = this._findActive(i.active), this._addClass(this.active, "ui-accordion-header-active", "ui-state-active")._removeClass(this.active, "ui-accordion-header-collapsed"), this._addClass(this.active.next(), "ui-accordion-content-active"), this.active.next().show(), this.headers.attr("role", "tab").each(function () {
        var e = t(this),
            i = e.uniqueId().attr("id"),
            s = e.next(),
            n = s.uniqueId().attr("id");
        e.attr("aria-controls", n), s.attr("aria-labelledby", i);
      }).next().attr("role", "tabpanel"), this.headers.not(this.active).attr({
        "aria-selected": "false",
        "aria-expanded": "false",
        tabIndex: -1
      }).next().attr({
        "aria-hidden": "true"
      }).hide(), this.active.length ? this.active.attr({
        "aria-selected": "true",
        "aria-expanded": "true",
        tabIndex: 0
      }).next().attr({
        "aria-hidden": "false"
      }) : this.headers.eq(0).attr("tabIndex", 0), this._createIcons(), this._setupEvents(i.event), "fill" === s ? (e = n.height(), this.element.siblings(":visible").each(function () {
        var i = t(this),
            s = i.css("position");
        "absolute" !== s && "fixed" !== s && (e -= i.outerHeight(!0));
      }), this.headers.each(function () {
        e -= t(this).outerHeight(!0);
      }), this.headers.next().each(function () {
        t(this).height(Math.max(0, e - t(this).innerHeight() + t(this).height()));
      }).css("overflow", "auto")) : "auto" === s && (e = 0, this.headers.next().each(function () {
        var i = t(this).is(":visible");
        i || t(this).show(), e = Math.max(e, t(this).css("height", "").height()), i || t(this).hide();
      }).height(e));
    },
    _activate: function _activate(e) {
      var i = this._findActive(e)[0];

      i !== this.active[0] && (i = i || this.active[0], this._eventHandler({
        target: i,
        currentTarget: i,
        preventDefault: t.noop
      }));
    },
    _findActive: function _findActive(e) {
      return "number" == typeof e ? this.headers.eq(e) : t();
    },
    _setupEvents: function _setupEvents(e) {
      var i = {
        keydown: "_keydown"
      };
      e && t.each(e.split(" "), function (t, e) {
        i[e] = "_eventHandler";
      }), this._off(this.headers.add(this.headers.next())), this._on(this.headers, i), this._on(this.headers.next(), {
        keydown: "_panelKeyDown"
      }), this._hoverable(this.headers), this._focusable(this.headers);
    },
    _eventHandler: function _eventHandler(e) {
      var i,
          s,
          n = this.options,
          o = this.active,
          a = t(e.currentTarget),
          r = a[0] === o[0],
          h = r && n.collapsible,
          l = h ? t() : a.next(),
          c = o.next(),
          u = {
        oldHeader: o,
        oldPanel: c,
        newHeader: h ? t() : a,
        newPanel: l
      };
      e.preventDefault(), r && !n.collapsible || this._trigger("beforeActivate", e, u) === !1 || (n.active = h ? !1 : this.headers.index(a), this.active = r ? t() : a, this._toggle(u), this._removeClass(o, "ui-accordion-header-active", "ui-state-active"), n.icons && (i = o.children(".ui-accordion-header-icon"), this._removeClass(i, null, n.icons.activeHeader)._addClass(i, null, n.icons.header)), r || (this._removeClass(a, "ui-accordion-header-collapsed")._addClass(a, "ui-accordion-header-active", "ui-state-active"), n.icons && (s = a.children(".ui-accordion-header-icon"), this._removeClass(s, null, n.icons.header)._addClass(s, null, n.icons.activeHeader)), this._addClass(a.next(), "ui-accordion-content-active")));
    },
    _toggle: function _toggle(e) {
      var i = e.newPanel,
          s = this.prevShow.length ? this.prevShow : e.oldPanel;
      this.prevShow.add(this.prevHide).stop(!0, !0), this.prevShow = i, this.prevHide = s, this.options.animate ? this._animate(i, s, e) : (s.hide(), i.show(), this._toggleComplete(e)), s.attr({
        "aria-hidden": "true"
      }), s.prev().attr({
        "aria-selected": "false",
        "aria-expanded": "false"
      }), i.length && s.length ? s.prev().attr({
        tabIndex: -1,
        "aria-expanded": "false"
      }) : i.length && this.headers.filter(function () {
        return 0 === parseInt(t(this).attr("tabIndex"), 10);
      }).attr("tabIndex", -1), i.attr("aria-hidden", "false").prev().attr({
        "aria-selected": "true",
        "aria-expanded": "true",
        tabIndex: 0
      });
    },
    _animate: function _animate(t, e, i) {
      var s,
          n,
          o,
          a = this,
          r = 0,
          h = t.css("box-sizing"),
          l = t.length && (!e.length || t.index() < e.index()),
          c = this.options.animate || {},
          u = l && c.down || c,
          d = function d() {
        a._toggleComplete(i);
      };

      return "number" == typeof u && (o = u), "string" == typeof u && (n = u), n = n || u.easing || c.easing, o = o || u.duration || c.duration, e.length ? t.length ? (s = t.show().outerHeight(), e.animate(this.hideProps, {
        duration: o,
        easing: n,
        step: function step(t, e) {
          e.now = Math.round(t);
        }
      }), t.hide().animate(this.showProps, {
        duration: o,
        easing: n,
        complete: d,
        step: function step(t, i) {
          i.now = Math.round(t), "height" !== i.prop ? "content-box" === h && (r += i.now) : "content" !== a.options.heightStyle && (i.now = Math.round(s - e.outerHeight() - r), r = 0);
        }
      }), void 0) : e.animate(this.hideProps, o, n, d) : t.animate(this.showProps, o, n, d);
    },
    _toggleComplete: function _toggleComplete(t) {
      var e = t.oldPanel,
          i = e.prev();
      this._removeClass(e, "ui-accordion-content-active"), this._removeClass(i, "ui-accordion-header-active")._addClass(i, "ui-accordion-header-collapsed"), e.length && (e.parent()[0].className = e.parent()[0].className), this._trigger("activate", null, t);
    }
  }), t.ui.safeActiveElement = function (t) {
    var e;

    try {
      e = t.activeElement;
    } catch (i) {
      e = t.body;
    }

    return e || (e = t.body), e.nodeName || (e = t.body), e;
  }, t.widget("ui.menu", {
    version: "1.12.1",
    defaultElement: "<ul>",
    delay: 300,
    options: {
      icons: {
        submenu: "ui-icon-caret-1-e"
      },
      items: "> *",
      menus: "ul",
      position: {
        my: "left top",
        at: "right top"
      },
      role: "menu",
      blur: null,
      focus: null,
      select: null
    },
    _create: function _create() {
      this.activeMenu = this.element, this.mouseHandled = !1, this.element.uniqueId().attr({
        role: this.options.role,
        tabIndex: 0
      }), this._addClass("ui-menu", "ui-widget ui-widget-content"), this._on({
        "mousedown .ui-menu-item": function mousedownUiMenuItem(t) {
          t.preventDefault();
        },
        "click .ui-menu-item": function clickUiMenuItem(e) {
          var i = t(e.target),
              s = t(t.ui.safeActiveElement(this.document[0]));
          !this.mouseHandled && i.not(".ui-state-disabled").length && (this.select(e), e.isPropagationStopped() || (this.mouseHandled = !0), i.has(".ui-menu").length ? this.expand(e) : !this.element.is(":focus") && s.closest(".ui-menu").length && (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)));
        },
        "mouseenter .ui-menu-item": function mouseenterUiMenuItem(e) {
          if (!this.previousFilter) {
            var i = t(e.target).closest(".ui-menu-item"),
                s = t(e.currentTarget);
            i[0] === s[0] && (this._removeClass(s.siblings().children(".ui-state-active"), null, "ui-state-active"), this.focus(e, s));
          }
        },
        mouseleave: "collapseAll",
        "mouseleave .ui-menu": "collapseAll",
        focus: function focus(t, e) {
          var i = this.active || this.element.find(this.options.items).eq(0);
          e || this.focus(t, i);
        },
        blur: function blur(e) {
          this._delay(function () {
            var i = !t.contains(this.element[0], t.ui.safeActiveElement(this.document[0]));
            i && this.collapseAll(e);
          });
        },
        keydown: "_keydown"
      }), this.refresh(), this._on(this.document, {
        click: function click(t) {
          this._closeOnDocumentClick(t) && this.collapseAll(t), this.mouseHandled = !1;
        }
      });
    },
    _destroy: function _destroy() {
      var e = this.element.find(".ui-menu-item").removeAttr("role aria-disabled"),
          i = e.children(".ui-menu-item-wrapper").removeUniqueId().removeAttr("tabIndex role aria-haspopup");
      this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeAttr("role aria-labelledby aria-expanded aria-hidden aria-disabled tabIndex").removeUniqueId().show(), i.children().each(function () {
        var e = t(this);
        e.data("ui-menu-submenu-caret") && e.remove();
      });
    },
    _keydown: function _keydown(e) {
      var i,
          s,
          n,
          o,
          a = !0;

      switch (e.keyCode) {
        case t.ui.keyCode.PAGE_UP:
          this.previousPage(e);
          break;

        case t.ui.keyCode.PAGE_DOWN:
          this.nextPage(e);
          break;

        case t.ui.keyCode.HOME:
          this._move("first", "first", e);

          break;

        case t.ui.keyCode.END:
          this._move("last", "last", e);

          break;

        case t.ui.keyCode.UP:
          this.previous(e);
          break;

        case t.ui.keyCode.DOWN:
          this.next(e);
          break;

        case t.ui.keyCode.LEFT:
          this.collapse(e);
          break;

        case t.ui.keyCode.RIGHT:
          this.active && !this.active.is(".ui-state-disabled") && this.expand(e);
          break;

        case t.ui.keyCode.ENTER:
        case t.ui.keyCode.SPACE:
          this._activate(e);

          break;

        case t.ui.keyCode.ESCAPE:
          this.collapse(e);
          break;

        default:
          a = !1, s = this.previousFilter || "", o = !1, n = e.keyCode >= 96 && 105 >= e.keyCode ? "" + (e.keyCode - 96) : String.fromCharCode(e.keyCode), clearTimeout(this.filterTimer), n === s ? o = !0 : n = s + n, i = this._filterMenuItems(n), i = o && -1 !== i.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : i, i.length || (n = String.fromCharCode(e.keyCode), i = this._filterMenuItems(n)), i.length ? (this.focus(e, i), this.previousFilter = n, this.filterTimer = this._delay(function () {
            delete this.previousFilter;
          }, 1e3)) : delete this.previousFilter;
      }

      a && e.preventDefault();
    },
    _activate: function _activate(t) {
      this.active && !this.active.is(".ui-state-disabled") && (this.active.children("[aria-haspopup='true']").length ? this.expand(t) : this.select(t));
    },
    refresh: function refresh() {
      var e,
          i,
          s,
          n,
          o,
          a = this,
          r = this.options.icons.submenu,
          h = this.element.find(this.options.menus);
      this._toggleClass("ui-menu-icons", null, !!this.element.find(".ui-icon").length), s = h.filter(":not(.ui-menu)").hide().attr({
        role: this.options.role,
        "aria-hidden": "true",
        "aria-expanded": "false"
      }).each(function () {
        var e = t(this),
            i = e.prev(),
            s = t("<span>").data("ui-menu-submenu-caret", !0);
        a._addClass(s, "ui-menu-icon", "ui-icon " + r), i.attr("aria-haspopup", "true").prepend(s), e.attr("aria-labelledby", i.attr("id"));
      }), this._addClass(s, "ui-menu", "ui-widget ui-widget-content ui-front"), e = h.add(this.element), i = e.find(this.options.items), i.not(".ui-menu-item").each(function () {
        var e = t(this);
        a._isDivider(e) && a._addClass(e, "ui-menu-divider", "ui-widget-content");
      }), n = i.not(".ui-menu-item, .ui-menu-divider"), o = n.children().not(".ui-menu").uniqueId().attr({
        tabIndex: -1,
        role: this._itemRole()
      }), this._addClass(n, "ui-menu-item")._addClass(o, "ui-menu-item-wrapper"), i.filter(".ui-state-disabled").attr("aria-disabled", "true"), this.active && !t.contains(this.element[0], this.active[0]) && this.blur();
    },
    _itemRole: function _itemRole() {
      return {
        menu: "menuitem",
        listbox: "option"
      }[this.options.role];
    },
    _setOption: function _setOption(t, e) {
      if ("icons" === t) {
        var i = this.element.find(".ui-menu-icon");

        this._removeClass(i, null, this.options.icons.submenu)._addClass(i, null, e.submenu);
      }

      this._super(t, e);
    },
    _setOptionDisabled: function _setOptionDisabled(t) {
      this._super(t), this.element.attr("aria-disabled", t + ""), this._toggleClass(null, "ui-state-disabled", !!t);
    },
    focus: function focus(t, e) {
      var i, s, n;
      this.blur(t, t && "focus" === t.type), this._scrollIntoView(e), this.active = e.first(), s = this.active.children(".ui-menu-item-wrapper"), this._addClass(s, null, "ui-state-active"), this.options.role && this.element.attr("aria-activedescendant", s.attr("id")), n = this.active.parent().closest(".ui-menu-item").children(".ui-menu-item-wrapper"), this._addClass(n, null, "ui-state-active"), t && "keydown" === t.type ? this._close() : this.timer = this._delay(function () {
        this._close();
      }, this.delay), i = e.children(".ui-menu"), i.length && t && /^mouse/.test(t.type) && this._startOpening(i), this.activeMenu = e.parent(), this._trigger("focus", t, {
        item: e
      });
    },
    _scrollIntoView: function _scrollIntoView(e) {
      var i, s, n, o, a, r;
      this._hasScroll() && (i = parseFloat(t.css(this.activeMenu[0], "borderTopWidth")) || 0, s = parseFloat(t.css(this.activeMenu[0], "paddingTop")) || 0, n = e.offset().top - this.activeMenu.offset().top - i - s, o = this.activeMenu.scrollTop(), a = this.activeMenu.height(), r = e.outerHeight(), 0 > n ? this.activeMenu.scrollTop(o + n) : n + r > a && this.activeMenu.scrollTop(o + n - a + r));
    },
    blur: function blur(t, e) {
      e || clearTimeout(this.timer), this.active && (this._removeClass(this.active.children(".ui-menu-item-wrapper"), null, "ui-state-active"), this._trigger("blur", t, {
        item: this.active
      }), this.active = null);
    },
    _startOpening: function _startOpening(t) {
      clearTimeout(this.timer), "true" === t.attr("aria-hidden") && (this.timer = this._delay(function () {
        this._close(), this._open(t);
      }, this.delay));
    },
    _open: function _open(e) {
      var i = t.extend({
        of: this.active
      }, this.options.position);
      clearTimeout(this.timer), this.element.find(".ui-menu").not(e.parents(".ui-menu")).hide().attr("aria-hidden", "true"), e.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(i);
    },
    collapseAll: function collapseAll(e, i) {
      clearTimeout(this.timer), this.timer = this._delay(function () {
        var s = i ? this.element : t(e && e.target).closest(this.element.find(".ui-menu"));
        s.length || (s = this.element), this._close(s), this.blur(e), this._removeClass(s.find(".ui-state-active"), null, "ui-state-active"), this.activeMenu = s;
      }, this.delay);
    },
    _close: function _close(t) {
      t || (t = this.active ? this.active.parent() : this.element), t.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false");
    },
    _closeOnDocumentClick: function _closeOnDocumentClick(e) {
      return !t(e.target).closest(".ui-menu").length;
    },
    _isDivider: function _isDivider(t) {
      return !/[^\-\u2014\u2013\s]/.test(t.text());
    },
    collapse: function collapse(t) {
      var e = this.active && this.active.parent().closest(".ui-menu-item", this.element);
      e && e.length && (this._close(), this.focus(t, e));
    },
    expand: function expand(t) {
      var e = this.active && this.active.children(".ui-menu ").find(this.options.items).first();
      e && e.length && (this._open(e.parent()), this._delay(function () {
        this.focus(t, e);
      }));
    },
    next: function next(t) {
      this._move("next", "first", t);
    },
    previous: function previous(t) {
      this._move("prev", "last", t);
    },
    isFirstItem: function isFirstItem() {
      return this.active && !this.active.prevAll(".ui-menu-item").length;
    },
    isLastItem: function isLastItem() {
      return this.active && !this.active.nextAll(".ui-menu-item").length;
    },
    _move: function _move(t, e, i) {
      var s;
      this.active && (s = "first" === t || "last" === t ? this.active["first" === t ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[t + "All"](".ui-menu-item").eq(0)), s && s.length && this.active || (s = this.activeMenu.find(this.options.items)[e]()), this.focus(i, s);
    },
    nextPage: function nextPage(e) {
      var i, s, n;
      return this.active ? (this.isLastItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.nextAll(".ui-menu-item").each(function () {
        return i = t(this), 0 > i.offset().top - s - n;
      }), this.focus(e, i)) : this.focus(e, this.activeMenu.find(this.options.items)[this.active ? "last" : "first"]())), void 0) : (this.next(e), void 0);
    },
    previousPage: function previousPage(e) {
      var i, s, n;
      return this.active ? (this.isFirstItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.prevAll(".ui-menu-item").each(function () {
        return i = t(this), i.offset().top - s + n > 0;
      }), this.focus(e, i)) : this.focus(e, this.activeMenu.find(this.options.items).first())), void 0) : (this.next(e), void 0);
    },
    _hasScroll: function _hasScroll() {
      return this.element.outerHeight() < this.element.prop("scrollHeight");
    },
    select: function select(e) {
      this.active = this.active || t(e.target).closest(".ui-menu-item");
      var i = {
        item: this.active
      };
      this.active.has(".ui-menu").length || this.collapseAll(e, !0), this._trigger("select", e, i);
    },
    _filterMenuItems: function _filterMenuItems(e) {
      var i = e.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"),
          s = RegExp("^" + i, "i");
      return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function () {
        return s.test(t.trim(t(this).children(".ui-menu-item-wrapper").text()));
      });
    }
  }), t.widget("ui.autocomplete", {
    version: "1.12.1",
    defaultElement: "<input>",
    options: {
      appendTo: null,
      autoFocus: !1,
      delay: 300,
      minLength: 1,
      position: {
        my: "left top",
        at: "left bottom",
        collision: "none"
      },
      source: null,
      change: null,
      close: null,
      focus: null,
      open: null,
      response: null,
      search: null,
      select: null
    },
    requestIndex: 0,
    pending: 0,
    _create: function _create() {
      var e,
          i,
          s,
          n = this.element[0].nodeName.toLowerCase(),
          o = "textarea" === n,
          a = "input" === n;
      this.isMultiLine = o || !a && this._isContentEditable(this.element), this.valueMethod = this.element[o || a ? "val" : "text"], this.isNewMenu = !0, this._addClass("ui-autocomplete-input"), this.element.attr("autocomplete", "off"), this._on(this.element, {
        keydown: function keydown(n) {
          if (this.element.prop("readOnly")) return e = !0, s = !0, i = !0, void 0;
          e = !1, s = !1, i = !1;
          var o = t.ui.keyCode;

          switch (n.keyCode) {
            case o.PAGE_UP:
              e = !0, this._move("previousPage", n);
              break;

            case o.PAGE_DOWN:
              e = !0, this._move("nextPage", n);
              break;

            case o.UP:
              e = !0, this._keyEvent("previous", n);
              break;

            case o.DOWN:
              e = !0, this._keyEvent("next", n);
              break;

            case o.ENTER:
              this.menu.active && (e = !0, n.preventDefault(), this.menu.select(n));
              break;

            case o.TAB:
              this.menu.active && this.menu.select(n);
              break;

            case o.ESCAPE:
              this.menu.element.is(":visible") && (this.isMultiLine || this._value(this.term), this.close(n), n.preventDefault());
              break;

            default:
              i = !0, this._searchTimeout(n);
          }
        },
        keypress: function keypress(s) {
          if (e) return e = !1, (!this.isMultiLine || this.menu.element.is(":visible")) && s.preventDefault(), void 0;

          if (!i) {
            var n = t.ui.keyCode;

            switch (s.keyCode) {
              case n.PAGE_UP:
                this._move("previousPage", s);

                break;

              case n.PAGE_DOWN:
                this._move("nextPage", s);

                break;

              case n.UP:
                this._keyEvent("previous", s);

                break;

              case n.DOWN:
                this._keyEvent("next", s);

            }
          }
        },
        input: function input(t) {
          return s ? (s = !1, t.preventDefault(), void 0) : (this._searchTimeout(t), void 0);
        },
        focus: function focus() {
          this.selectedItem = null, this.previous = this._value();
        },
        blur: function blur(t) {
          return this.cancelBlur ? (delete this.cancelBlur, void 0) : (clearTimeout(this.searching), this.close(t), this._change(t), void 0);
        }
      }), this._initSource(), this.menu = t("<ul>").appendTo(this._appendTo()).menu({
        role: null
      }).hide().menu("instance"), this._addClass(this.menu.element, "ui-autocomplete", "ui-front"), this._on(this.menu.element, {
        mousedown: function mousedown(e) {
          e.preventDefault(), this.cancelBlur = !0, this._delay(function () {
            delete this.cancelBlur, this.element[0] !== t.ui.safeActiveElement(this.document[0]) && this.element.trigger("focus");
          });
        },
        menufocus: function menufocus(e, i) {
          var s, n;
          return this.isNewMenu && (this.isNewMenu = !1, e.originalEvent && /^mouse/.test(e.originalEvent.type)) ? (this.menu.blur(), this.document.one("mousemove", function () {
            t(e.target).trigger(e.originalEvent);
          }), void 0) : (n = i.item.data("ui-autocomplete-item"), !1 !== this._trigger("focus", e, {
            item: n
          }) && e.originalEvent && /^key/.test(e.originalEvent.type) && this._value(n.value), s = i.item.attr("aria-label") || n.value, s && t.trim(s).length && (this.liveRegion.children().hide(), t("<div>").text(s).appendTo(this.liveRegion)), void 0);
        },
        menuselect: function menuselect(e, i) {
          var s = i.item.data("ui-autocomplete-item"),
              n = this.previous;
          this.element[0] !== t.ui.safeActiveElement(this.document[0]) && (this.element.trigger("focus"), this.previous = n, this._delay(function () {
            this.previous = n, this.selectedItem = s;
          })), !1 !== this._trigger("select", e, {
            item: s
          }) && this._value(s.value), this.term = this._value(), this.close(e), this.selectedItem = s;
        }
      }), this.liveRegion = t("<div>", {
        role: "status",
        "aria-live": "assertive",
        "aria-relevant": "additions"
      }).appendTo(this.document[0].body), this._addClass(this.liveRegion, null, "ui-helper-hidden-accessible"), this._on(this.window, {
        beforeunload: function beforeunload() {
          this.element.removeAttr("autocomplete");
        }
      });
    },
    _destroy: function _destroy() {
      clearTimeout(this.searching), this.element.removeAttr("autocomplete"), this.menu.element.remove(), this.liveRegion.remove();
    },
    _setOption: function _setOption(t, e) {
      this._super(t, e), "source" === t && this._initSource(), "appendTo" === t && this.menu.element.appendTo(this._appendTo()), "disabled" === t && e && this.xhr && this.xhr.abort();
    },
    _isEventTargetInWidget: function _isEventTargetInWidget(e) {
      var i = this.menu.element[0];
      return e.target === this.element[0] || e.target === i || t.contains(i, e.target);
    },
    _closeOnClickOutside: function _closeOnClickOutside(t) {
      this._isEventTargetInWidget(t) || this.close();
    },
    _appendTo: function _appendTo() {
      var e = this.options.appendTo;
      return e && (e = e.jquery || e.nodeType ? t(e) : this.document.find(e).eq(0)), e && e[0] || (e = this.element.closest(".ui-front, dialog")), e.length || (e = this.document[0].body), e;
    },
    _initSource: function _initSource() {
      var e,
          i,
          s = this;
      t.isArray(this.options.source) ? (e = this.options.source, this.source = function (i, s) {
        s(t.ui.autocomplete.filter(e, i.term));
      }) : "string" == typeof this.options.source ? (i = this.options.source, this.source = function (e, n) {
        s.xhr && s.xhr.abort(), s.xhr = t.ajax({
          url: i,
          data: e,
          dataType: "json",
          success: function success(t) {
            n(t);
          },
          error: function error() {
            n([]);
          }
        });
      }) : this.source = this.options.source;
    },
    _searchTimeout: function _searchTimeout(t) {
      clearTimeout(this.searching), this.searching = this._delay(function () {
        var e = this.term === this._value(),
            i = this.menu.element.is(":visible"),
            s = t.altKey || t.ctrlKey || t.metaKey || t.shiftKey;

        (!e || e && !i && !s) && (this.selectedItem = null, this.search(null, t));
      }, this.options.delay);
    },
    search: function search(t, e) {
      return t = null != t ? t : this._value(), this.term = this._value(), t.length < this.options.minLength ? this.close(e) : this._trigger("search", e) !== !1 ? this._search(t) : void 0;
    },
    _search: function _search(t) {
      this.pending++, this._addClass("ui-autocomplete-loading"), this.cancelSearch = !1, this.source({
        term: t
      }, this._response());
    },
    _response: function _response() {
      var e = ++this.requestIndex;
      return t.proxy(function (t) {
        e === this.requestIndex && this.__response(t), this.pending--, this.pending || this._removeClass("ui-autocomplete-loading");
      }, this);
    },
    __response: function __response(t) {
      t && (t = this._normalize(t)), this._trigger("response", null, {
        content: t
      }), !this.options.disabled && t && t.length && !this.cancelSearch ? (this._suggest(t), this._trigger("open")) : this._close();
    },
    close: function close(t) {
      this.cancelSearch = !0, this._close(t);
    },
    _close: function _close(t) {
      this._off(this.document, "mousedown"), this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", t));
    },
    _change: function _change(t) {
      this.previous !== this._value() && this._trigger("change", t, {
        item: this.selectedItem
      });
    },
    _normalize: function _normalize(e) {
      return e.length && e[0].label && e[0].value ? e : t.map(e, function (e) {
        return "string" == typeof e ? {
          label: e,
          value: e
        } : t.extend({}, e, {
          label: e.label || e.value,
          value: e.value || e.label
        });
      });
    },
    _suggest: function _suggest(e) {
      var i = this.menu.element.empty();
      this._renderMenu(i, e), this.isNewMenu = !0, this.menu.refresh(), i.show(), this._resizeMenu(), i.position(t.extend({
        of: this.element
      }, this.options.position)), this.options.autoFocus && this.menu.next(), this._on(this.document, {
        mousedown: "_closeOnClickOutside"
      });
    },
    _resizeMenu: function _resizeMenu() {
      var t = this.menu.element;
      t.outerWidth(Math.max(t.width("").outerWidth() + 1, this.element.outerWidth()));
    },
    _renderMenu: function _renderMenu(e, i) {
      var s = this;
      t.each(i, function (t, i) {
        s._renderItemData(e, i);
      });
    },
    _renderItemData: function _renderItemData(t, e) {
      return this._renderItem(t, e).data("ui-autocomplete-item", e);
    },
    _renderItem: function _renderItem(e, i) {
      return t("<li>").append(t("<div>").text(i.label)).appendTo(e);
    },
    _move: function _move(t, e) {
      return this.menu.element.is(":visible") ? this.menu.isFirstItem() && /^previous/.test(t) || this.menu.isLastItem() && /^next/.test(t) ? (this.isMultiLine || this._value(this.term), this.menu.blur(), void 0) : (this.menu[t](e), void 0) : (this.search(null, e), void 0);
    },
    widget: function widget() {
      return this.menu.element;
    },
    _value: function _value() {
      return this.valueMethod.apply(this.element, arguments);
    },
    _keyEvent: function _keyEvent(t, e) {
      (!this.isMultiLine || this.menu.element.is(":visible")) && (this._move(t, e), e.preventDefault());
    },
    _isContentEditable: function _isContentEditable(t) {
      if (!t.length) return !1;
      var e = t.prop("contentEditable");
      return "inherit" === e ? this._isContentEditable(t.parent()) : "true" === e;
    }
  }), t.extend(t.ui.autocomplete, {
    escapeRegex: function escapeRegex(t) {
      return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
    },
    filter: function filter(e, i) {
      var s = RegExp(t.ui.autocomplete.escapeRegex(i), "i");
      return t.grep(e, function (t) {
        return s.test(t.label || t.value || t);
      });
    }
  }), t.widget("ui.autocomplete", t.ui.autocomplete, {
    options: {
      messages: {
        noResults: "No search results.",
        results: function results(t) {
          return t + (t > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate.";
        }
      }
    },
    __response: function __response(e) {
      var i;
      this._superApply(arguments), this.options.disabled || this.cancelSearch || (i = e && e.length ? this.options.messages.results(e.length) : this.options.messages.noResults, this.liveRegion.children().hide(), t("<div>").text(i).appendTo(this.liveRegion));
    }
  }), t.ui.autocomplete, t.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());
  var n = !1;
  t(document).on("mouseup", function () {
    n = !1;
  }), t.widget("ui.mouse", {
    version: "1.12.1",
    options: {
      cancel: "input, textarea, button, select, option",
      distance: 1,
      delay: 0
    },
    _mouseInit: function _mouseInit() {
      var e = this;
      this.element.on("mousedown." + this.widgetName, function (t) {
        return e._mouseDown(t);
      }).on("click." + this.widgetName, function (i) {
        return !0 === t.data(i.target, e.widgetName + ".preventClickEvent") ? (t.removeData(i.target, e.widgetName + ".preventClickEvent"), i.stopImmediatePropagation(), !1) : void 0;
      }), this.started = !1;
    },
    _mouseDestroy: function _mouseDestroy() {
      this.element.off("." + this.widgetName), this._mouseMoveDelegate && this.document.off("mousemove." + this.widgetName, this._mouseMoveDelegate).off("mouseup." + this.widgetName, this._mouseUpDelegate);
    },
    _mouseDown: function _mouseDown(e) {
      if (!n) {
        this._mouseMoved = !1, this._mouseStarted && this._mouseUp(e), this._mouseDownEvent = e;
        var i = this,
            s = 1 === e.which,
            o = "string" == typeof this.options.cancel && e.target.nodeName ? t(e.target).closest(this.options.cancel).length : !1;
        return s && !o && this._mouseCapture(e) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function () {
          i.mouseDelayMet = !0;
        }, this.options.delay)), this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(e) !== !1, !this._mouseStarted) ? (e.preventDefault(), !0) : (!0 === t.data(e.target, this.widgetName + ".preventClickEvent") && t.removeData(e.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function (t) {
          return i._mouseMove(t);
        }, this._mouseUpDelegate = function (t) {
          return i._mouseUp(t);
        }, this.document.on("mousemove." + this.widgetName, this._mouseMoveDelegate).on("mouseup." + this.widgetName, this._mouseUpDelegate), e.preventDefault(), n = !0, !0)) : !0;
      }
    },
    _mouseMove: function _mouseMove(e) {
      if (this._mouseMoved) {
        if (t.ui.ie && (!document.documentMode || 9 > document.documentMode) && !e.button) return this._mouseUp(e);
        if (!e.which) if (e.originalEvent.altKey || e.originalEvent.ctrlKey || e.originalEvent.metaKey || e.originalEvent.shiftKey) this.ignoreMissingWhich = !0;else if (!this.ignoreMissingWhich) return this._mouseUp(e);
      }

      return (e.which || e.button) && (this._mouseMoved = !0), this._mouseStarted ? (this._mouseDrag(e), e.preventDefault()) : (this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, e) !== !1, this._mouseStarted ? this._mouseDrag(e) : this._mouseUp(e)), !this._mouseStarted);
    },
    _mouseUp: function _mouseUp(e) {
      this.document.off("mousemove." + this.widgetName, this._mouseMoveDelegate).off("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && t.data(e.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(e)), this._mouseDelayTimer && (clearTimeout(this._mouseDelayTimer), delete this._mouseDelayTimer), this.ignoreMissingWhich = !1, n = !1, e.preventDefault();
    },
    _mouseDistanceMet: function _mouseDistanceMet(t) {
      return Math.max(Math.abs(this._mouseDownEvent.pageX - t.pageX), Math.abs(this._mouseDownEvent.pageY - t.pageY)) >= this.options.distance;
    },
    _mouseDelayMet: function _mouseDelayMet() {
      return this.mouseDelayMet;
    },
    _mouseStart: function _mouseStart() {},
    _mouseDrag: function _mouseDrag() {},
    _mouseStop: function _mouseStop() {},
    _mouseCapture: function _mouseCapture() {
      return !0;
    }
  }), t.widget("ui.slider", t.ui.mouse, {
    version: "1.12.1",
    widgetEventPrefix: "slide",
    options: {
      animate: !1,
      classes: {
        "ui-slider": "ui-corner-all",
        "ui-slider-handle": "ui-corner-all",
        "ui-slider-range": "ui-corner-all ui-widget-header"
      },
      distance: 0,
      max: 100,
      min: 0,
      orientation: "horizontal",
      range: !1,
      step: 1,
      value: 0,
      values: null,
      change: null,
      slide: null,
      start: null,
      stop: null
    },
    numPages: 5,
    _create: function _create() {
      this._keySliding = !1, this._mouseSliding = !1, this._animateOff = !0, this._handleIndex = null, this._detectOrientation(), this._mouseInit(), this._calculateNewMax(), this._addClass("ui-slider ui-slider-" + this.orientation, "ui-widget ui-widget-content"), this._refresh(), this._animateOff = !1;
    },
    _refresh: function _refresh() {
      this._createRange(), this._createHandles(), this._setupEvents(), this._refreshValue();
    },
    _createHandles: function _createHandles() {
      var e,
          i,
          s = this.options,
          n = this.element.find(".ui-slider-handle"),
          o = "<span tabindex='0'></span>",
          a = [];

      for (i = s.values && s.values.length || 1, n.length > i && (n.slice(i).remove(), n = n.slice(0, i)), e = n.length; i > e; e++) {
        a.push(o);
      }

      this.handles = n.add(t(a.join("")).appendTo(this.element)), this._addClass(this.handles, "ui-slider-handle", "ui-state-default"), this.handle = this.handles.eq(0), this.handles.each(function (e) {
        t(this).data("ui-slider-handle-index", e).attr("tabIndex", 0);
      });
    },
    _createRange: function _createRange() {
      var e = this.options;
      e.range ? (e.range === !0 && (e.values ? e.values.length && 2 !== e.values.length ? e.values = [e.values[0], e.values[0]] : t.isArray(e.values) && (e.values = e.values.slice(0)) : e.values = [this._valueMin(), this._valueMin()]), this.range && this.range.length ? (this._removeClass(this.range, "ui-slider-range-min ui-slider-range-max"), this.range.css({
        left: "",
        bottom: ""
      })) : (this.range = t("<div>").appendTo(this.element), this._addClass(this.range, "ui-slider-range")), ("min" === e.range || "max" === e.range) && this._addClass(this.range, "ui-slider-range-" + e.range)) : (this.range && this.range.remove(), this.range = null);
    },
    _setupEvents: function _setupEvents() {
      this._off(this.handles), this._on(this.handles, this._handleEvents), this._hoverable(this.handles), this._focusable(this.handles);
    },
    _destroy: function _destroy() {
      this.handles.remove(), this.range && this.range.remove(), this._mouseDestroy();
    },
    _mouseCapture: function _mouseCapture(e) {
      var i,
          s,
          n,
          o,
          a,
          r,
          h,
          l,
          c = this,
          u = this.options;
      return u.disabled ? !1 : (this.elementSize = {
        width: this.element.outerWidth(),
        height: this.element.outerHeight()
      }, this.elementOffset = this.element.offset(), i = {
        x: e.pageX,
        y: e.pageY
      }, s = this._normValueFromMouse(i), n = this._valueMax() - this._valueMin() + 1, this.handles.each(function (e) {
        var i = Math.abs(s - c.values(e));
        (n > i || n === i && (e === c._lastChangedValue || c.values(e) === u.min)) && (n = i, o = t(this), a = e);
      }), r = this._start(e, a), r === !1 ? !1 : (this._mouseSliding = !0, this._handleIndex = a, this._addClass(o, null, "ui-state-active"), o.trigger("focus"), h = o.offset(), l = !t(e.target).parents().addBack().is(".ui-slider-handle"), this._clickOffset = l ? {
        left: 0,
        top: 0
      } : {
        left: e.pageX - h.left - o.width() / 2,
        top: e.pageY - h.top - o.height() / 2 - (parseInt(o.css("borderTopWidth"), 10) || 0) - (parseInt(o.css("borderBottomWidth"), 10) || 0) + (parseInt(o.css("marginTop"), 10) || 0)
      }, this.handles.hasClass("ui-state-hover") || this._slide(e, a, s), this._animateOff = !0, !0));
    },
    _mouseStart: function _mouseStart() {
      return !0;
    },
    _mouseDrag: function _mouseDrag(t) {
      var e = {
        x: t.pageX,
        y: t.pageY
      },
          i = this._normValueFromMouse(e);

      return this._slide(t, this._handleIndex, i), !1;
    },
    _mouseStop: function _mouseStop(t) {
      return this._removeClass(this.handles, null, "ui-state-active"), this._mouseSliding = !1, this._stop(t, this._handleIndex), this._change(t, this._handleIndex), this._handleIndex = null, this._clickOffset = null, this._animateOff = !1, !1;
    },
    _detectOrientation: function _detectOrientation() {
      this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal";
    },
    _normValueFromMouse: function _normValueFromMouse(t) {
      var e, i, s, n, o;
      return "horizontal" === this.orientation ? (e = this.elementSize.width, i = t.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (e = this.elementSize.height, i = t.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)), s = i / e, s > 1 && (s = 1), 0 > s && (s = 0), "vertical" === this.orientation && (s = 1 - s), n = this._valueMax() - this._valueMin(), o = this._valueMin() + s * n, this._trimAlignValue(o);
    },
    _uiHash: function _uiHash(t, e, i) {
      var s = {
        handle: this.handles[t],
        handleIndex: t,
        value: void 0 !== e ? e : this.value()
      };
      return this._hasMultipleValues() && (s.value = void 0 !== e ? e : this.values(t), s.values = i || this.values()), s;
    },
    _hasMultipleValues: function _hasMultipleValues() {
      return this.options.values && this.options.values.length;
    },
    _start: function _start(t, e) {
      return this._trigger("start", t, this._uiHash(e));
    },
    _slide: function _slide(t, e, i) {
      var s,
          n,
          o = this.value(),
          a = this.values();
      this._hasMultipleValues() && (n = this.values(e ? 0 : 1), o = this.values(e), 2 === this.options.values.length && this.options.range === !0 && (i = 0 === e ? Math.min(n, i) : Math.max(n, i)), a[e] = i), i !== o && (s = this._trigger("slide", t, this._uiHash(e, i, a)), s !== !1 && (this._hasMultipleValues() ? this.values(e, i) : this.value(i)));
    },
    _stop: function _stop(t, e) {
      this._trigger("stop", t, this._uiHash(e));
    },
    _change: function _change(t, e) {
      this._keySliding || this._mouseSliding || (this._lastChangedValue = e, this._trigger("change", t, this._uiHash(e)));
    },
    value: function value(t) {
      return arguments.length ? (this.options.value = this._trimAlignValue(t), this._refreshValue(), this._change(null, 0), void 0) : this._value();
    },
    values: function values(e, i) {
      var s, n, o;
      if (arguments.length > 1) return this.options.values[e] = this._trimAlignValue(i), this._refreshValue(), this._change(null, e), void 0;
      if (!arguments.length) return this._values();
      if (!t.isArray(arguments[0])) return this._hasMultipleValues() ? this._values(e) : this.value();

      for (s = this.options.values, n = arguments[0], o = 0; s.length > o; o += 1) {
        s[o] = this._trimAlignValue(n[o]), this._change(null, o);
      }

      this._refreshValue();
    },
    _setOption: function _setOption(e, i) {
      var s,
          n = 0;

      switch ("range" === e && this.options.range === !0 && ("min" === i ? (this.options.value = this._values(0), this.options.values = null) : "max" === i && (this.options.value = this._values(this.options.values.length - 1), this.options.values = null)), t.isArray(this.options.values) && (n = this.options.values.length), this._super(e, i), e) {
        case "orientation":
          this._detectOrientation(), this._removeClass("ui-slider-horizontal ui-slider-vertical")._addClass("ui-slider-" + this.orientation), this._refreshValue(), this.options.range && this._refreshRange(i), this.handles.css("horizontal" === i ? "bottom" : "left", "");
          break;

        case "value":
          this._animateOff = !0, this._refreshValue(), this._change(null, 0), this._animateOff = !1;
          break;

        case "values":
          for (this._animateOff = !0, this._refreshValue(), s = n - 1; s >= 0; s--) {
            this._change(null, s);
          }

          this._animateOff = !1;
          break;

        case "step":
        case "min":
        case "max":
          this._animateOff = !0, this._calculateNewMax(), this._refreshValue(), this._animateOff = !1;
          break;

        case "range":
          this._animateOff = !0, this._refresh(), this._animateOff = !1;
      }
    },
    _setOptionDisabled: function _setOptionDisabled(t) {
      this._super(t), this._toggleClass(null, "ui-state-disabled", !!t);
    },
    _value: function _value() {
      var t = this.options.value;
      return t = this._trimAlignValue(t);
    },
    _values: function _values(t) {
      var e, i, s;
      if (arguments.length) return e = this.options.values[t], e = this._trimAlignValue(e);

      if (this._hasMultipleValues()) {
        for (i = this.options.values.slice(), s = 0; i.length > s; s += 1) {
          i[s] = this._trimAlignValue(i[s]);
        }

        return i;
      }

      return [];
    },
    _trimAlignValue: function _trimAlignValue(t) {
      if (this._valueMin() >= t) return this._valueMin();
      if (t >= this._valueMax()) return this._valueMax();
      var e = this.options.step > 0 ? this.options.step : 1,
          i = (t - this._valueMin()) % e,
          s = t - i;
      return 2 * Math.abs(i) >= e && (s += i > 0 ? e : -e), parseFloat(s.toFixed(5));
    },
    _calculateNewMax: function _calculateNewMax() {
      var t = this.options.max,
          e = this._valueMin(),
          i = this.options.step,
          s = Math.round((t - e) / i) * i;

      t = s + e, t > this.options.max && (t -= i), this.max = parseFloat(t.toFixed(this._precision()));
    },
    _precision: function _precision() {
      var t = this._precisionOf(this.options.step);

      return null !== this.options.min && (t = Math.max(t, this._precisionOf(this.options.min))), t;
    },
    _precisionOf: function _precisionOf(t) {
      var e = "" + t,
          i = e.indexOf(".");
      return -1 === i ? 0 : e.length - i - 1;
    },
    _valueMin: function _valueMin() {
      return this.options.min;
    },
    _valueMax: function _valueMax() {
      return this.max;
    },
    _refreshRange: function _refreshRange(t) {
      "vertical" === t && this.range.css({
        width: "",
        left: ""
      }), "horizontal" === t && this.range.css({
        height: "",
        bottom: ""
      });
    },
    _refreshValue: function _refreshValue() {
      var e,
          i,
          s,
          n,
          o,
          a = this.options.range,
          r = this.options,
          h = this,
          l = this._animateOff ? !1 : r.animate,
          c = {};
      this._hasMultipleValues() ? this.handles.each(function (s) {
        i = 100 * ((h.values(s) - h._valueMin()) / (h._valueMax() - h._valueMin())), c["horizontal" === h.orientation ? "left" : "bottom"] = i + "%", t(this).stop(1, 1)[l ? "animate" : "css"](c, r.animate), h.options.range === !0 && ("horizontal" === h.orientation ? (0 === s && h.range.stop(1, 1)[l ? "animate" : "css"]({
          left: i + "%"
        }, r.animate), 1 === s && h.range[l ? "animate" : "css"]({
          width: i - e + "%"
        }, {
          queue: !1,
          duration: r.animate
        })) : (0 === s && h.range.stop(1, 1)[l ? "animate" : "css"]({
          bottom: i + "%"
        }, r.animate), 1 === s && h.range[l ? "animate" : "css"]({
          height: i - e + "%"
        }, {
          queue: !1,
          duration: r.animate
        }))), e = i;
      }) : (s = this.value(), n = this._valueMin(), o = this._valueMax(), i = o !== n ? 100 * ((s - n) / (o - n)) : 0, c["horizontal" === this.orientation ? "left" : "bottom"] = i + "%", this.handle.stop(1, 1)[l ? "animate" : "css"](c, r.animate), "min" === a && "horizontal" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
        width: i + "%"
      }, r.animate), "max" === a && "horizontal" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
        width: 100 - i + "%"
      }, r.animate), "min" === a && "vertical" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
        height: i + "%"
      }, r.animate), "max" === a && "vertical" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
        height: 100 - i + "%"
      }, r.animate));
    },
    _handleEvents: {
      keydown: function keydown(e) {
        var i,
            s,
            n,
            o,
            a = t(e.target).data("ui-slider-handle-index");

        switch (e.keyCode) {
          case t.ui.keyCode.HOME:
          case t.ui.keyCode.END:
          case t.ui.keyCode.PAGE_UP:
          case t.ui.keyCode.PAGE_DOWN:
          case t.ui.keyCode.UP:
          case t.ui.keyCode.RIGHT:
          case t.ui.keyCode.DOWN:
          case t.ui.keyCode.LEFT:
            if (e.preventDefault(), !this._keySliding && (this._keySliding = !0, this._addClass(t(e.target), null, "ui-state-active"), i = this._start(e, a), i === !1)) return;
        }

        switch (o = this.options.step, s = n = this._hasMultipleValues() ? this.values(a) : this.value(), e.keyCode) {
          case t.ui.keyCode.HOME:
            n = this._valueMin();
            break;

          case t.ui.keyCode.END:
            n = this._valueMax();
            break;

          case t.ui.keyCode.PAGE_UP:
            n = this._trimAlignValue(s + (this._valueMax() - this._valueMin()) / this.numPages);
            break;

          case t.ui.keyCode.PAGE_DOWN:
            n = this._trimAlignValue(s - (this._valueMax() - this._valueMin()) / this.numPages);
            break;

          case t.ui.keyCode.UP:
          case t.ui.keyCode.RIGHT:
            if (s === this._valueMax()) return;
            n = this._trimAlignValue(s + o);
            break;

          case t.ui.keyCode.DOWN:
          case t.ui.keyCode.LEFT:
            if (s === this._valueMin()) return;
            n = this._trimAlignValue(s - o);
        }

        this._slide(e, a, n);
      },
      keyup: function keyup(e) {
        var i = t(e.target).data("ui-slider-handle-index");
        this._keySliding && (this._keySliding = !1, this._stop(e, i), this._change(e, i), this._removeClass(t(e.target), null, "ui-state-active"));
      }
    }
  });
});
/*#######################*/

/* JQUERY UI TOUCH PUNCH */

/*#######################*/
// jQuery UI Touch Punch 0.2.3
// Copyright 2011вЂ“2014, Dave Furfero
// Dual licensed under the MIT or GPL Version 2 licenses.
// Depends:
//  jquery.ui.widget.js
//  jquery.ui.mouse.js


!function (a) {
  function f(a, b) {
    if (!(a.originalEvent.touches.length > 1)) {
      a.preventDefault();
      var c = a.originalEvent.changedTouches[0],
          d = document.createEvent("MouseEvents");
      d.initMouseEvent(b, !0, !0, window, 1, c.screenX, c.screenY, c.clientX, c.clientY, !1, !1, !1, !1, 0, null), a.target.dispatchEvent(d);
    }
  }

  if (a.support.touch = "ontouchend" in document, a.support.touch) {
    var e,
        b = a.ui.mouse.prototype,
        c = b._mouseInit,
        d = b._mouseDestroy;
    b._touchStart = function (a) {
      var b = this;
      !e && b._mouseCapture(a.originalEvent.changedTouches[0]) && (e = !0, b._touchMoved = !1, f(a, "mouseover"), f(a, "mousemove"), f(a, "mousedown"));
    }, b._touchMove = function (a) {
      e && (this._touchMoved = !0, f(a, "mousemove"));
    }, b._touchEnd = function (a) {
      e && (f(a, "mouseup"), f(a, "mouseout"), this._touchMoved || f(a, "click"), e = !1);
    }, b._mouseInit = function () {
      var b = this;
      b.element.bind({
        touchstart: a.proxy(b, "_touchStart"),
        touchmove: a.proxy(b, "_touchMove"),
        touchend: a.proxy(b, "_touchEnd")
      }), c.call(b);
    }, b._mouseDestroy = function () {
      var b = this;
      b.element.unbind({
        touchstart: a.proxy(b, "_touchStart"),
        touchmove: a.proxy(b, "_touchMove"),
        touchend: a.proxy(b, "_touchEnd")
      }), d.call(b);
    };
  }
}(jQuery);

/***/ }),

/***/ "./resources/js/libs/jquery.inputmask.min.js":
/*!***************************************************!*\
  !*** ./resources/js/libs/jquery.inputmask.min.js ***!
  \***************************************************/
/***/ ((module, exports, __webpack_require__) => {

/* module decorator */ module = __webpack_require__.nmd(module);
var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof2(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof2 = function _typeof2(obj) { return typeof obj; }; } else { _typeof2 = function _typeof2(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof2(obj); }

// dist/jquery.inputmask.min
// https://github.com/RobinHerbots/Inputmask
// Copyright (c) 2010 - 2020 Robin Herbots
// Licensed under the MIT license
// Version: 5.0.4-beta.1
!function webpackUniversalModuleDefinition(root, factory) {
  if ("object" == ( false ? 0 : _typeof2(exports)) && "object" == ( false ? 0 : _typeof2(module))) module.exports = factory(__webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js"));else if (true) !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));else { var i, a; }
}(window, function (__WEBPACK_EXTERNAL_MODULE__3__) {
  return modules = [function (module) {
    module.exports = JSON.parse('{"BACKSPACE":8,"BACKSPACE_SAFARI":127,"DELETE":46,"DOWN":40,"END":35,"ENTER":13,"ESCAPE":27,"HOME":36,"INSERT":45,"LEFT":37,"PAGE_DOWN":34,"PAGE_UP":33,"RIGHT":39,"SPACE":32,"TAB":9,"UP":38,"X":88,"CONTROL":17}');
  }, function (module, exports, __nested_webpack_require_1585__) {
    "use strict";

    function _typeof(obj) {
      return _typeof = "function" == typeof Symbol && "symbol" == _typeof2(Symbol.iterator) ? function _typeof(obj) {
        return _typeof2(obj);
      } : function _typeof(obj) {
        return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
      }, _typeof(obj);
    }

    var $ = __nested_webpack_require_1585__(2),
        window = __nested_webpack_require_1585__(4),
        document = window.document,
        generateMaskSet = __nested_webpack_require_1585__(5).generateMaskSet,
        analyseMask = __nested_webpack_require_1585__(5).analyseMask,
        maskScope = __nested_webpack_require_1585__(8);

    function Inputmask(alias, options, internal) {
      if (!(this instanceof Inputmask)) return new Inputmask(alias, options, internal);
      this.el = void 0, this.events = {}, this.maskset = void 0, !0 !== internal && ($.isPlainObject(alias) ? options = alias : (options = options || {}, alias && (options.alias = alias)), this.opts = $.extend(!0, {}, this.defaults, options), this.noMasksCache = options && void 0 !== options.definitions, this.userOptions = options || {}, resolveAlias(this.opts.alias, options, this.opts), this.isRTL = this.opts.numericInput), this.refreshValue = !1, this.undoValue = void 0, this.$el = void 0, this.skipKeyPressEvent = !1, this.skipInputEvent = !1, this.validationEvent = !1, this.ignorable = !1, this.maxLength, this.mouseEnter = !1, this.originalPlaceholder = void 0;
    }

    function resolveAlias(aliasStr, options, opts) {
      var aliasDefinition = Inputmask.prototype.aliases[aliasStr];
      return aliasDefinition ? (aliasDefinition.alias && resolveAlias(aliasDefinition.alias, void 0, opts), $.extend(!0, opts, aliasDefinition), $.extend(!0, opts, options), !0) : (null === opts.mask && (opts.mask = aliasStr), !1);
    }

    function importAttributeOptions(npt, opts, userOptions, dataAttribute) {
      function importOption(option, optionData) {
        optionData = void 0 !== optionData ? optionData : npt.getAttribute(dataAttribute + "-" + option), null !== optionData && ("string" == typeof optionData && (0 === option.indexOf("on") ? optionData = window[optionData] : "false" === optionData ? optionData = !1 : "true" === optionData && (optionData = !0)), userOptions[option] = optionData);
      }

      if (!0 === opts.importDataAttributes) {
        var attrOptions = npt.getAttribute(dataAttribute),
            option,
            dataoptions,
            optionData,
            p;
        if (attrOptions && "" !== attrOptions && (attrOptions = attrOptions.replace(/'/g, '"'), dataoptions = JSON.parse("{" + attrOptions + "}")), dataoptions) for (p in optionData = void 0, dataoptions) {
          if ("alias" === p.toLowerCase()) {
            optionData = dataoptions[p];
            break;
          }
        }

        for (option in importOption("alias", optionData), userOptions.alias && resolveAlias(userOptions.alias, userOptions, opts), opts) {
          if (dataoptions) for (p in optionData = void 0, dataoptions) {
            if (p.toLowerCase() === option.toLowerCase()) {
              optionData = dataoptions[p];
              break;
            }
          }
          importOption(option, optionData);
        }
      }

      return $.extend(!0, opts, userOptions), "rtl" !== npt.dir && !opts.rightAlign || (npt.style.textAlign = "right"), "rtl" !== npt.dir && !opts.numericInput || (npt.dir = "ltr", npt.removeAttribute("dir"), opts.isRTL = !0), Object.keys(userOptions).length;
    }

    Inputmask.prototype = {
      dataAttribute: "data-inputmask",
      defaults: {
        _maxTestPos: 500,
        placeholder: "_",
        optionalmarker: ["[", "]"],
        quantifiermarker: ["{", "}"],
        groupmarker: ["(", ")"],
        alternatormarker: "|",
        escapeChar: "\\",
        mask: null,
        regex: null,
        oncomplete: $.noop,
        onincomplete: $.noop,
        oncleared: $.noop,
        repeat: 0,
        greedy: !1,
        autoUnmask: !1,
        removeMaskOnSubmit: !1,
        clearMaskOnLostFocus: !0,
        insertMode: !0,
        insertModeVisual: !0,
        clearIncomplete: !1,
        alias: null,
        onKeyDown: $.noop,
        onBeforeMask: null,
        onBeforePaste: function onBeforePaste(pastedValue, opts) {
          return $.isFunction(opts.onBeforeMask) ? opts.onBeforeMask.call(this, pastedValue, opts) : pastedValue;
        },
        onBeforeWrite: null,
        onUnMask: null,
        showMaskOnFocus: !0,
        showMaskOnHover: !0,
        onKeyValidation: $.noop,
        skipOptionalPartCharacter: " ",
        numericInput: !1,
        rightAlign: !1,
        undoOnEscape: !0,
        radixPoint: "",
        _radixDance: !1,
        groupSeparator: "",
        keepStatic: null,
        positionCaretOnTab: !0,
        tabThrough: !1,
        supportsInputType: ["text", "tel", "url", "password", "search"],
        ignorables: [8, 9, 19, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 93, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 0, 229],
        isComplete: null,
        preValidation: null,
        postValidation: null,
        staticDefinitionSymbol: void 0,
        jitMasking: !1,
        nullable: !0,
        inputEventOnly: !1,
        noValuePatching: !1,
        positionCaretOnClick: "lvp",
        casing: null,
        inputmode: "text",
        importDataAttributes: !0,
        shiftPositions: !0
      },
      definitions: {
        9: {
          validator: "[0-9\uFF11-\uFF19]",
          definitionSymbol: "*"
        },
        a: {
          validator: "[A-Za-z\u0410-\u044F\u0401\u0451\xC0-\xFF\xB5]",
          definitionSymbol: "*"
        },
        "*": {
          validator: "[0-9\uFF11-\uFF19A-Za-z\u0410-\u044F\u0401\u0451\xC0-\xFF\xB5]"
        }
      },
      aliases: {},
      masksCache: {},
      mask: function mask(elems) {
        var that = this;
        return "string" == typeof elems && (elems = document.getElementById(elems) || document.querySelectorAll(elems)), elems = elems.nodeName ? [elems] : elems, $.each(elems, function (ndx, el) {
          var scopedOpts = $.extend(!0, {}, that.opts);

          if (importAttributeOptions(el, scopedOpts, $.extend(!0, {}, that.userOptions), that.dataAttribute)) {
            var maskset = generateMaskSet(scopedOpts, that.noMasksCache);
            void 0 !== maskset && (void 0 !== el.inputmask && (el.inputmask.opts.autoUnmask = !0, el.inputmask.remove()), el.inputmask = new Inputmask(void 0, void 0, !0), el.inputmask.opts = scopedOpts, el.inputmask.noMasksCache = that.noMasksCache, el.inputmask.userOptions = $.extend(!0, {}, that.userOptions), el.inputmask.isRTL = scopedOpts.isRTL || scopedOpts.numericInput, el.inputmask.el = el, el.inputmask.$el = $(el), el.inputmask.maskset = maskset, $.data(el, "_inputmask_opts", scopedOpts), maskScope.call(el.inputmask, {
              action: "mask"
            }));
          }
        }), elems && elems[0] && elems[0].inputmask || this;
      },
      option: function option(options, noremask) {
        return "string" == typeof options ? this.opts[options] : "object" === _typeof(options) ? ($.extend(this.userOptions, options), this.el && !0 !== noremask && this.mask(this.el), this) : void 0;
      },
      unmaskedvalue: function unmaskedvalue(value) {
        return this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache), maskScope.call(this, {
          action: "unmaskedvalue",
          value: value
        });
      },
      remove: function remove() {
        return maskScope.call(this, {
          action: "remove"
        });
      },
      getemptymask: function getemptymask() {
        return this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache), maskScope.call(this, {
          action: "getemptymask"
        });
      },
      hasMaskedValue: function hasMaskedValue() {
        return !this.opts.autoUnmask;
      },
      isComplete: function isComplete() {
        return this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache), maskScope.call(this, {
          action: "isComplete"
        });
      },
      getmetadata: function getmetadata() {
        return this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache), maskScope.call(this, {
          action: "getmetadata"
        });
      },
      isValid: function isValid(value) {
        return this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache), maskScope.call(this, {
          action: "isValid",
          value: value
        });
      },
      format: function format(value, metadata) {
        return this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache), maskScope.call(this, {
          action: "format",
          value: value,
          metadata: metadata
        });
      },
      setValue: function setValue(value) {
        this.el && $(this.el).trigger("setvalue", [value]);
      },
      analyseMask: analyseMask
    }, Inputmask.extendDefaults = function (options) {
      $.extend(!0, Inputmask.prototype.defaults, options);
    }, Inputmask.extendDefinitions = function (definition) {
      $.extend(!0, Inputmask.prototype.definitions, definition);
    }, Inputmask.extendAliases = function (alias) {
      $.extend(!0, Inputmask.prototype.aliases, alias);
    }, Inputmask.format = function (value, options, metadata) {
      return Inputmask(options).format(value, metadata);
    }, Inputmask.unmask = function (value, options) {
      return Inputmask(options).unmaskedvalue(value);
    }, Inputmask.isValid = function (value, options) {
      return Inputmask(options).isValid(value);
    }, Inputmask.remove = function (elems) {
      "string" == typeof elems && (elems = document.getElementById(elems) || document.querySelectorAll(elems)), elems = elems.nodeName ? [elems] : elems, $.each(elems, function (ndx, el) {
        el.inputmask && el.inputmask.remove();
      });
    }, Inputmask.setValue = function (elems, value) {
      "string" == typeof elems && (elems = document.getElementById(elems) || document.querySelectorAll(elems)), elems = elems.nodeName ? [elems] : elems, $.each(elems, function (ndx, el) {
        el.inputmask ? el.inputmask.setValue(value) : $(el).trigger("setvalue", [value]);
      });
    };
    var escapeRegexRegex = new RegExp("(\\" + ["/", ".", "*", "+", "?", "|", "(", ")", "[", "]", "{", "}", "\\", "$", "^"].join("|\\") + ")", "gim");
    Inputmask.escapeRegex = function (str) {
      return str.replace(escapeRegexRegex, "\\$1");
    }, Inputmask.dependencyLib = $, window.Inputmask = Inputmask, module.exports = Inputmask;
  }, function (module, exports, __nested_webpack_require_12366__) {
    "use strict";

    var jquery = __nested_webpack_require_12366__(3);

    if (void 0 === jquery) throw "jQuery not loaded!";
    module.exports = jquery;
  }, function (module, exports) {
    module.exports = __WEBPACK_EXTERNAL_MODULE__3__;
  }, function (module, exports, __nested_webpack_require_12653__) {
    "use strict";

    var __WEBPACK_AMD_DEFINE_RESULT__;

    function _typeof(obj) {
      return _typeof = "function" == typeof Symbol && "symbol" == _typeof2(Symbol.iterator) ? function _typeof(obj) {
        return _typeof2(obj);
      } : function _typeof(obj) {
        return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
      }, _typeof(obj);
    }

    __WEBPACK_AMD_DEFINE_RESULT__ = function () {
      return "undefined" != typeof window ? window : new (eval("require('jsdom').JSDOM"))("").window;
    }.call(exports, __nested_webpack_require_12653__, exports, module), void 0 === __WEBPACK_AMD_DEFINE_RESULT__ || (module.exports = __WEBPACK_AMD_DEFINE_RESULT__);
  }, function (module, exports, __nested_webpack_require_13448__) {
    "use strict";

    var $ = __nested_webpack_require_13448__(2);

    function generateMaskSet(opts, nocache) {
      var ms;

      function generateMask(mask, metadata, opts) {
        var regexMask = !1,
            masksetDefinition,
            maskdefKey;

        if (null !== mask && "" !== mask || (regexMask = null !== opts.regex, mask = regexMask ? (mask = opts.regex, mask.replace(/^(\^)(.*)(\$)$/, "$2")) : (regexMask = !0, ".*")), 1 === mask.length && !1 === opts.greedy && 0 !== opts.repeat && (opts.placeholder = ""), 0 < opts.repeat || "*" === opts.repeat || "+" === opts.repeat) {
          var repeatStart = "*" === opts.repeat ? 0 : "+" === opts.repeat ? 1 : opts.repeat;
          mask = opts.groupmarker[0] + mask + opts.groupmarker[1] + opts.quantifiermarker[0] + repeatStart + "," + opts.repeat + opts.quantifiermarker[1];
        }

        return maskdefKey = regexMask ? "regex_" + opts.regex : opts.numericInput ? mask.split("").reverse().join("") : mask, !1 !== opts.keepStatic && (maskdefKey = "ks_" + maskdefKey), void 0 === Inputmask.prototype.masksCache[maskdefKey] || !0 === nocache ? (masksetDefinition = {
          mask: mask,
          maskToken: Inputmask.prototype.analyseMask(mask, regexMask, opts),
          validPositions: {},
          _buffer: void 0,
          buffer: void 0,
          tests: {},
          excludes: {},
          metadata: metadata,
          maskLength: void 0,
          jitOffset: {}
        }, !0 !== nocache && (Inputmask.prototype.masksCache[maskdefKey] = masksetDefinition, masksetDefinition = $.extend(!0, {}, Inputmask.prototype.masksCache[maskdefKey]))) : masksetDefinition = $.extend(!0, {}, Inputmask.prototype.masksCache[maskdefKey]), masksetDefinition;
      }

      if ($.isFunction(opts.mask) && (opts.mask = opts.mask(opts)), $.isArray(opts.mask)) {
        if (1 < opts.mask.length) {
          null === opts.keepStatic && (opts.keepStatic = !0);
          var altMask = opts.groupmarker[0];
          return $.each(opts.isRTL ? opts.mask.reverse() : opts.mask, function (ndx, msk) {
            1 < altMask.length && (altMask += opts.groupmarker[1] + opts.alternatormarker + opts.groupmarker[0]), void 0 === msk.mask || $.isFunction(msk.mask) ? altMask += msk : altMask += msk.mask;
          }), altMask += opts.groupmarker[1], generateMask(altMask, opts.mask, opts);
        }

        opts.mask = opts.mask.pop();
      }

      return null === opts.keepStatic && (opts.keepStatic = !1), ms = opts.mask && void 0 !== opts.mask.mask && !$.isFunction(opts.mask.mask) ? generateMask(opts.mask.mask, opts.mask, opts) : generateMask(opts.mask, opts.mask, opts), ms;
    }

    function analyseMask(mask, regexMask, opts) {
      var tokenizer = /(?:[?*+]|\{[0-9+*]+(?:,[0-9+*]*)?(?:\|[0-9+*]*)?\})|[^.?*+^${[]()|\\]+|./g,
          regexTokenizer = /\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./g,
          escaped = !1,
          currentToken = new MaskToken(),
          match,
          m,
          openenings = [],
          maskTokens = [],
          openingToken,
          currentOpeningToken,
          alternator,
          lastMatch,
          closeRegexGroup = !1;

      function MaskToken(isGroup, isOptional, isQuantifier, isAlternator) {
        this.matches = [], this.openGroup = isGroup || !1, this.alternatorGroup = !1, this.isGroup = isGroup || !1, this.isOptional = isOptional || !1, this.isQuantifier = isQuantifier || !1, this.isAlternator = isAlternator || !1, this.quantifier = {
          min: 1,
          max: 1
        };
      }

      function insertTestDefinition(mtoken, element, position) {
        position = void 0 !== position ? position : mtoken.matches.length;
        var prevMatch = mtoken.matches[position - 1];
        if (regexMask) 0 === element.indexOf("[") || escaped && /\\d|\\s|\\w]/i.test(element) || "." === element ? mtoken.matches.splice(position++, 0, {
          fn: new RegExp(element, opts.casing ? "i" : ""),
          "static": !1,
          optionality: !1,
          newBlockMarker: void 0 === prevMatch ? "master" : prevMatch.def !== element,
          casing: null,
          def: element,
          placeholder: void 0,
          nativeDef: element
        }) : (escaped && (element = element[element.length - 1]), $.each(element.split(""), function (ndx, lmnt) {
          prevMatch = mtoken.matches[position - 1], mtoken.matches.splice(position++, 0, {
            fn: /[a-z]/i.test(opts.staticDefinitionSymbol || lmnt) ? new RegExp("[" + (opts.staticDefinitionSymbol || lmnt) + "]", opts.casing ? "i" : "") : null,
            "static": !0,
            optionality: !1,
            newBlockMarker: void 0 === prevMatch ? "master" : prevMatch.def !== lmnt && !0 !== prevMatch["static"],
            casing: null,
            def: opts.staticDefinitionSymbol || lmnt,
            placeholder: void 0 !== opts.staticDefinitionSymbol ? lmnt : void 0,
            nativeDef: (escaped ? "'" : "") + lmnt
          });
        })), escaped = !1;else {
          var maskdef = (opts.definitions ? opts.definitions[element] : void 0) || Inputmask.prototype.definitions[element];
          maskdef && !escaped ? mtoken.matches.splice(position++, 0, {
            fn: maskdef.validator ? "string" == typeof maskdef.validator ? new RegExp(maskdef.validator, opts.casing ? "i" : "") : new function () {
              this.test = maskdef.validator;
            }() : new RegExp("."),
            "static": maskdef["static"] || !1,
            optionality: !1,
            newBlockMarker: void 0 === prevMatch ? "master" : prevMatch.def !== (maskdef.definitionSymbol || element),
            casing: maskdef.casing,
            def: maskdef.definitionSymbol || element,
            placeholder: maskdef.placeholder,
            nativeDef: element,
            generated: maskdef.generated
          }) : (mtoken.matches.splice(position++, 0, {
            fn: /[a-z]/i.test(opts.staticDefinitionSymbol || element) ? new RegExp("[" + (opts.staticDefinitionSymbol || element) + "]", opts.casing ? "i" : "") : null,
            "static": !0,
            optionality: !1,
            newBlockMarker: void 0 === prevMatch ? "master" : prevMatch.def !== element && !0 !== prevMatch["static"],
            casing: null,
            def: opts.staticDefinitionSymbol || element,
            placeholder: void 0 !== opts.staticDefinitionSymbol ? element : void 0,
            nativeDef: (escaped ? "'" : "") + element
          }), escaped = !1);
        }
      }

      function verifyGroupMarker(maskToken) {
        maskToken && maskToken.matches && $.each(maskToken.matches, function (ndx, token) {
          var nextToken = maskToken.matches[ndx + 1];
          (void 0 === nextToken || void 0 === nextToken.matches || !1 === nextToken.isQuantifier) && token && token.isGroup && (token.isGroup = !1, regexMask || (insertTestDefinition(token, opts.groupmarker[0], 0), !0 !== token.openGroup && insertTestDefinition(token, opts.groupmarker[1]))), verifyGroupMarker(token);
        });
      }

      function defaultCase() {
        if (0 < openenings.length) {
          if (currentOpeningToken = openenings[openenings.length - 1], insertTestDefinition(currentOpeningToken, m), currentOpeningToken.isAlternator) {
            alternator = openenings.pop();

            for (var mndx = 0; mndx < alternator.matches.length; mndx++) {
              alternator.matches[mndx].isGroup && (alternator.matches[mndx].isGroup = !1);
            }

            0 < openenings.length ? (currentOpeningToken = openenings[openenings.length - 1], currentOpeningToken.matches.push(alternator)) : currentToken.matches.push(alternator);
          }
        } else insertTestDefinition(currentToken, m);
      }

      function reverseTokens(maskToken) {
        function reverseStatic(st) {
          return st === opts.optionalmarker[0] ? st = opts.optionalmarker[1] : st === opts.optionalmarker[1] ? st = opts.optionalmarker[0] : st === opts.groupmarker[0] ? st = opts.groupmarker[1] : st === opts.groupmarker[1] && (st = opts.groupmarker[0]), st;
        }

        for (var match in maskToken.matches = maskToken.matches.reverse(), maskToken.matches) {
          if (Object.prototype.hasOwnProperty.call(maskToken.matches, match)) {
            var intMatch = parseInt(match);

            if (maskToken.matches[match].isQuantifier && maskToken.matches[intMatch + 1] && maskToken.matches[intMatch + 1].isGroup) {
              var qt = maskToken.matches[match];
              maskToken.matches.splice(match, 1), maskToken.matches.splice(intMatch + 1, 0, qt);
            }

            void 0 !== maskToken.matches[match].matches ? maskToken.matches[match] = reverseTokens(maskToken.matches[match]) : maskToken.matches[match] = reverseStatic(maskToken.matches[match]);
          }
        }

        return maskToken;
      }

      function groupify(matches) {
        var groupToken = new MaskToken(!0);
        return groupToken.openGroup = !1, groupToken.matches = matches, groupToken;
      }

      function closeGroup() {
        if (openingToken = openenings.pop(), openingToken.openGroup = !1, void 0 !== openingToken) {
          if (0 < openenings.length) {
            if (currentOpeningToken = openenings[openenings.length - 1], currentOpeningToken.matches.push(openingToken), currentOpeningToken.isAlternator) {
              alternator = openenings.pop();

              for (var mndx = 0; mndx < alternator.matches.length; mndx++) {
                alternator.matches[mndx].isGroup = !1, alternator.matches[mndx].alternatorGroup = !1;
              }

              0 < openenings.length ? (currentOpeningToken = openenings[openenings.length - 1], currentOpeningToken.matches.push(alternator)) : currentToken.matches.push(alternator);
            }
          } else currentToken.matches.push(openingToken);
        } else defaultCase();
      }

      function groupQuantifier(matches) {
        var lastMatch = matches.pop();
        return lastMatch.isQuantifier && (lastMatch = groupify([matches.pop(), lastMatch])), lastMatch;
      }

      for (regexMask && (opts.optionalmarker[0] = void 0, opts.optionalmarker[1] = void 0); match = regexMask ? regexTokenizer.exec(mask) : tokenizer.exec(mask);) {
        if (m = match[0], regexMask) switch (m.charAt(0)) {
          case "?":
            m = "{0,1}";
            break;

          case "+":
          case "*":
            m = "{" + m + "}";
            break;

          case "|":
            if (0 === openenings.length) {
              var altRegexGroup = groupify(currentToken.matches);
              altRegexGroup.openGroup = !0, openenings.push(altRegexGroup), currentToken.matches = [], closeRegexGroup = !0;
            }

            break;
        }
        if (escaped) defaultCase();else switch (m.charAt(0)) {
          case "(?=":
            break;

          case "(?!":
            break;

          case "(?<=":
            break;

          case "(?<!":
            break;

          case opts.escapeChar:
            escaped = !0, regexMask && defaultCase();
            break;

          case opts.optionalmarker[1]:
          case opts.groupmarker[1]:
            closeGroup();
            break;

          case opts.optionalmarker[0]:
            openenings.push(new MaskToken(!1, !0));
            break;

          case opts.groupmarker[0]:
            openenings.push(new MaskToken(!0));
            break;

          case opts.quantifiermarker[0]:
            var quantifier = new MaskToken(!1, !1, !0);
            m = m.replace(/[{}]/g, "");
            var mqj = m.split("|"),
                mq = mqj[0].split(","),
                mq0 = isNaN(mq[0]) ? mq[0] : parseInt(mq[0]),
                mq1 = 1 === mq.length ? mq0 : isNaN(mq[1]) ? mq[1] : parseInt(mq[1]);
            "*" !== mq0 && "+" !== mq0 || (mq0 = "*" === mq1 ? 0 : 1), quantifier.quantifier = {
              min: mq0,
              max: mq1,
              jit: mqj[1]
            };
            var matches = 0 < openenings.length ? openenings[openenings.length - 1].matches : currentToken.matches;

            if (match = matches.pop(), match.isAlternator) {
              matches.push(match), matches = match.matches;
              var groupToken = new MaskToken(!0),
                  tmpMatch = matches.pop();
              matches.push(groupToken), matches = groupToken.matches, match = tmpMatch;
            }

            match.isGroup || (match = groupify([match])), matches.push(match), matches.push(quantifier);
            break;

          case opts.alternatormarker:
            if (0 < openenings.length) {
              currentOpeningToken = openenings[openenings.length - 1];
              var subToken = currentOpeningToken.matches[currentOpeningToken.matches.length - 1];
              lastMatch = currentOpeningToken.openGroup && (void 0 === subToken.matches || !1 === subToken.isGroup && !1 === subToken.isAlternator) ? openenings.pop() : groupQuantifier(currentOpeningToken.matches);
            } else lastMatch = groupQuantifier(currentToken.matches);

            if (lastMatch.isAlternator) openenings.push(lastMatch);else if (lastMatch.alternatorGroup ? (alternator = openenings.pop(), lastMatch.alternatorGroup = !1) : alternator = new MaskToken(!1, !1, !1, !0), alternator.matches.push(lastMatch), openenings.push(alternator), lastMatch.openGroup) {
              lastMatch.openGroup = !1;
              var alternatorGroup = new MaskToken(!0);
              alternatorGroup.alternatorGroup = !0, openenings.push(alternatorGroup);
            }
            break;

          default:
            defaultCase();
        }
      }

      for (closeRegexGroup && closeGroup(); 0 < openenings.length;) {
        openingToken = openenings.pop(), currentToken.matches.push(openingToken);
      }

      return 0 < currentToken.matches.length && (verifyGroupMarker(currentToken), maskTokens.push(currentToken)), (opts.numericInput || opts.isRTL) && reverseTokens(maskTokens[0]), maskTokens;
    }

    module.exports = {
      generateMaskSet: generateMaskSet,
      analyseMask: analyseMask
    };
  }, function (module, exports, __nested_webpack_require_27770__) {
    "use strict";

    __nested_webpack_require_27770__(7), __nested_webpack_require_27770__(10), __nested_webpack_require_27770__(11), __nested_webpack_require_27770__(12), module.exports = __nested_webpack_require_27770__(1);
  }, function (module, exports, __nested_webpack_require_27988__) {
    "use strict";

    var Inputmask = __nested_webpack_require_27988__(1);

    Inputmask.extendDefinitions({
      A: {
        validator: "[A-Za-z\u0410-\u044F\u0401\u0451\xC0-\xFF\xB5]",
        casing: "upper"
      },
      "&": {
        validator: "[0-9A-Za-z\u0410-\u044F\u0401\u0451\xC0-\xFF\xB5]",
        casing: "upper"
      },
      "#": {
        validator: "[0-9A-Fa-f]",
        casing: "upper"
      }
    });
    var ipValidatorRegex = new RegExp("25[0-5]|2[0-4][0-9]|[01][0-9][0-9]");

    function ipValidator(chrs, maskset, pos, strict, opts) {
      return chrs = -1 < pos - 1 && "." !== maskset.buffer[pos - 1] ? (chrs = maskset.buffer[pos - 1] + chrs, -1 < pos - 2 && "." !== maskset.buffer[pos - 2] ? maskset.buffer[pos - 2] + chrs : "0" + chrs) : "00" + chrs, ipValidatorRegex.test(chrs);
    }

    Inputmask.extendAliases({
      cssunit: {
        regex: "[+-]?[0-9]+\\.?([0-9]+)?(px|em|rem|ex|%|in|cm|mm|pt|pc)"
      },
      url: {
        regex: "(https?|ftp)//.*",
        autoUnmask: !1
      },
      ip: {
        mask: "i[i[i]].j[j[j]].k[k[k]].l[l[l]]",
        definitions: {
          i: {
            validator: ipValidator
          },
          j: {
            validator: ipValidator
          },
          k: {
            validator: ipValidator
          },
          l: {
            validator: ipValidator
          }
        },
        onUnMask: function onUnMask(maskedValue, unmaskedValue, opts) {
          return maskedValue;
        },
        inputmode: "numeric"
      },
      email: {
        mask: "*{1,64}[.*{1,64}][.*{1,64}][.*{1,63}]@-{1,63}.-{1,63}[.-{1,63}][.-{1,63}]",
        greedy: !1,
        casing: "lower",
        onBeforePaste: function onBeforePaste(pastedValue, opts) {
          return pastedValue = pastedValue.toLowerCase(), pastedValue.replace("mailto:", "");
        },
        definitions: {
          "*": {
            validator: "[0-9\uFF11-\uFF19A-Za-z\u0410-\u044F\u0401\u0451\xC0-\xFF\xB5!#$%&'*+/=?^_`{|}~-]"
          },
          "-": {
            validator: "[0-9A-Za-z-]"
          }
        },
        onUnMask: function onUnMask(maskedValue, unmaskedValue, opts) {
          return maskedValue;
        },
        inputmode: "email"
      },
      mac: {
        mask: "##:##:##:##:##:##"
      },
      vin: {
        mask: "V{13}9{4}",
        definitions: {
          V: {
            validator: "[A-HJ-NPR-Za-hj-npr-z\\d]",
            casing: "upper"
          }
        },
        clearIncomplete: !0,
        autoUnmask: !0
      },
      ssn: {
        mask: "999-99-9999",
        postValidation: function postValidation(buffer, pos, c, currentResult, opts, maskset, strict) {
          return /^(?!219-09-9999|078-05-1120)(?!666|000|9.{2}).{3}-(?!00).{2}-(?!0{4}).{4}$/.test(buffer.join(""));
        }
      }
    }), module.exports = Inputmask;
  }, function (module, exports, __nested_webpack_require_30885__) {
    "use strict";

    __nested_webpack_require_30885__(9);

    var $ = __nested_webpack_require_30885__(2),
        window = __nested_webpack_require_30885__(4),
        document = window.document,
        ua = window.navigator && window.navigator.userAgent || "",
        ie = 0 < ua.indexOf("MSIE ") || 0 < ua.indexOf("Trident/"),
        mobile = ("ontouchstart" in window),
        iemobile = /iemobile/i.test(ua),
        iphone = /iphone/i.test(ua) && !iemobile,
        keyCode = __nested_webpack_require_30885__(0);

    module.exports = function maskScope(actionObj) {
      var inputmask = this,
          maskset = inputmask.maskset,
          opts = inputmask.opts,
          el = inputmask.el,
          isRTL = inputmask.isRTL || (inputmask.isRTL = opts.numericInput);

      function getMaskTemplate(baseOnInput, minimalPos, includeMode, noJit, clearOptionalTail) {
        var greedy = opts.greedy;
        clearOptionalTail && (opts.greedy = !1), minimalPos = minimalPos || 0;
        var maskTemplate = [],
            ndxIntlzr,
            pos = 0,
            test,
            testPos,
            jitRenderStatic;

        do {
          if (!0 === baseOnInput && maskset.validPositions[pos]) testPos = clearOptionalTail && !0 === maskset.validPositions[pos].match.optionality && void 0 === maskset.validPositions[pos + 1] && (!0 === maskset.validPositions[pos].generatedInput || maskset.validPositions[pos].input == opts.skipOptionalPartCharacter && 0 < pos) ? determineTestTemplate(pos, getTests(pos, ndxIntlzr, pos - 1)) : maskset.validPositions[pos], test = testPos.match, ndxIntlzr = testPos.locator.slice(), maskTemplate.push(!0 === includeMode ? testPos.input : !1 === includeMode ? test.nativeDef : getPlaceholder(pos, test));else {
            testPos = getTestTemplate(pos, ndxIntlzr, pos - 1), test = testPos.match, ndxIntlzr = testPos.locator.slice();
            var jitMasking = !0 !== noJit && (!1 !== opts.jitMasking ? opts.jitMasking : test.jit);
            jitRenderStatic = jitRenderStatic && test["static"] && test.def !== opts.groupSeparator && null === test.fn || maskset.validPositions[pos - 1] && test["static"] && test.def !== opts.groupSeparator && null === test.fn, jitRenderStatic || !1 === jitMasking || void 0 === jitMasking || "number" == typeof jitMasking && isFinite(jitMasking) && pos < jitMasking ? maskTemplate.push(!1 === includeMode ? test.nativeDef : getPlaceholder(pos, test)) : jitRenderStatic = !1;
          }
          pos++;
        } while ((void 0 === inputmask.maxLength || pos < inputmask.maxLength) && (!0 !== test["static"] || "" !== test.def) || pos < minimalPos);

        return "" === maskTemplate[maskTemplate.length - 1] && maskTemplate.pop(), !1 === includeMode && void 0 !== maskset.maskLength || (maskset.maskLength = pos - 1), opts.greedy = greedy, maskTemplate;
      }

      function resetMaskSet(soft) {
        maskset.buffer = void 0, !0 !== soft && (maskset.validPositions = {}, maskset.p = 0);
      }

      function getLastValidPosition(closestTo, strict, validPositions) {
        var before = -1,
            after = -1,
            valids = validPositions || maskset.validPositions;

        for (var posNdx in void 0 === closestTo && (closestTo = -1), valids) {
          var psNdx = parseInt(posNdx);
          valids[psNdx] && (strict || !0 !== valids[psNdx].generatedInput) && (psNdx <= closestTo && (before = psNdx), closestTo <= psNdx && (after = psNdx));
        }

        return -1 === before || before == closestTo ? after : -1 == after ? before : closestTo - before < after - closestTo ? before : after;
      }

      function getDecisionTaker(tst) {
        var decisionTaker = tst.locator[tst.alternation];
        return "string" == typeof decisionTaker && 0 < decisionTaker.length && (decisionTaker = decisionTaker.split(",")[0]), void 0 !== decisionTaker ? decisionTaker.toString() : "";
      }

      function getLocator(tst, align) {
        var locator = (null != tst.alternation ? tst.mloc[getDecisionTaker(tst)] : tst.locator).join("");
        if ("" !== locator) for (; locator.length < align;) {
          locator += "0";
        }
        return locator;
      }

      function determineTestTemplate(pos, tests) {
        pos = 0 < pos ? pos - 1 : 0;

        for (var altTest = getTest(pos), targetLocator = getLocator(altTest), tstLocator, closest, bestMatch, ndx = 0; ndx < tests.length; ndx++) {
          var tst = tests[ndx];
          tstLocator = getLocator(tst, targetLocator.length);
          var distance = Math.abs(tstLocator - targetLocator);
          (void 0 === closest || "" !== tstLocator && distance < closest || bestMatch && !opts.greedy && bestMatch.match.optionality && "master" === bestMatch.match.newBlockMarker && (!tst.match.optionality || !tst.match.newBlockMarker) || bestMatch && bestMatch.match.optionalQuantifier && !tst.match.optionalQuantifier) && (closest = distance, bestMatch = tst);
        }

        return bestMatch;
      }

      function getTestTemplate(pos, ndxIntlzr, tstPs) {
        return maskset.validPositions[pos] || determineTestTemplate(pos, getTests(pos, ndxIntlzr ? ndxIntlzr.slice() : ndxIntlzr, tstPs));
      }

      function getTest(pos, tests) {
        return maskset.validPositions[pos] ? maskset.validPositions[pos] : (tests || getTests(pos))[0];
      }

      function positionCanMatchDefinition(pos, testDefinition, opts) {
        for (var valid = !1, tests = getTests(pos), tndx = 0; tndx < tests.length; tndx++) {
          if (tests[tndx].match && (!(tests[tndx].match.nativeDef !== testDefinition.match[opts.shiftPositions ? "def" : "nativeDef"] || opts.shiftPositions && testDefinition.match["static"]) || tests[tndx].match.nativeDef === testDefinition.match.nativeDef)) {
            valid = !0;
            break;
          }

          if (tests[tndx].match && tests[tndx].match.def === testDefinition.match.nativeDef) {
            valid = void 0;
            break;
          }
        }

        return !1 === valid && void 0 !== maskset.jitOffset[pos] && (valid = positionCanMatchDefinition(pos + maskset.jitOffset[pos], testDefinition, opts)), valid;
      }

      function getTests(pos, ndxIntlzr, tstPs) {
        var maskTokens = maskset.maskToken,
            testPos = ndxIntlzr ? tstPs : 0,
            ndxInitializer = ndxIntlzr ? ndxIntlzr.slice() : [0],
            matches = [],
            insertStop = !1,
            latestMatch,
            cacheDependency = ndxIntlzr ? ndxIntlzr.join("") : "";

        function resolveTestFromToken(maskToken, ndxInitializer, loopNdx, quantifierRecurse) {
          function handleMatch(match, loopNdx, quantifierRecurse) {
            function isFirstMatch(latestMatch, tokenGroup) {
              var firstMatch = 0 === $.inArray(latestMatch, tokenGroup.matches);
              return firstMatch || $.each(tokenGroup.matches, function (ndx, match) {
                if (!0 === match.isQuantifier ? firstMatch = isFirstMatch(latestMatch, tokenGroup.matches[ndx - 1]) : Object.prototype.hasOwnProperty.call(match, "matches") && (firstMatch = isFirstMatch(latestMatch, match)), firstMatch) return !1;
              }), firstMatch;
            }

            function resolveNdxInitializer(pos, alternateNdx, targetAlternation) {
              var bestMatch, indexPos;

              if ((maskset.tests[pos] || maskset.validPositions[pos]) && $.each(maskset.tests[pos] || [maskset.validPositions[pos]], function (ndx, lmnt) {
                if (lmnt.mloc[alternateNdx]) return bestMatch = lmnt, !1;
                var alternation = void 0 !== targetAlternation ? targetAlternation : lmnt.alternation,
                    ndxPos = void 0 !== lmnt.locator[alternation] ? lmnt.locator[alternation].toString().indexOf(alternateNdx) : -1;
                (void 0 === indexPos || ndxPos < indexPos) && -1 !== ndxPos && (bestMatch = lmnt, indexPos = ndxPos);
              }), bestMatch) {
                var bestMatchAltIndex = bestMatch.locator[bestMatch.alternation],
                    locator = bestMatch.mloc[alternateNdx] || bestMatch.mloc[bestMatchAltIndex] || bestMatch.locator;
                return locator.slice((void 0 !== targetAlternation ? targetAlternation : bestMatch.alternation) + 1);
              }

              return void 0 !== targetAlternation ? resolveNdxInitializer(pos, alternateNdx) : void 0;
            }

            function isSubsetOf(source, target) {
              function expand(pattern) {
                for (var expanded = [], start = -1, end, i = 0, l = pattern.length; i < l; i++) {
                  if ("-" === pattern.charAt(i)) for (end = pattern.charCodeAt(i + 1); ++start < end;) {
                    expanded.push(String.fromCharCode(start));
                  } else start = pattern.charCodeAt(i), expanded.push(pattern.charAt(i));
                }

                return expanded.join("");
              }

              return source.match.def === target.match.nativeDef || !(!(opts.regex || source.match.fn instanceof RegExp && target.match.fn instanceof RegExp) || !0 === source.match["static"] || !0 === target.match["static"]) && -1 !== expand(target.match.fn.toString().replace(/[[\]/]/g, "")).indexOf(expand(source.match.fn.toString().replace(/[[\]/]/g, "")));
            }

            function staticCanMatchDefinition(source, target) {
              return !0 === source.match["static"] && !0 !== target.match["static"] && target.match.fn.test(source.match.def, maskset, pos, !1, opts, !1);
            }

            function setMergeLocators(targetMatch, altMatch) {
              var alternationNdx = targetMatch.alternation,
                  shouldMerge = void 0 === altMatch || alternationNdx === altMatch.alternation && -1 === targetMatch.locator[alternationNdx].toString().indexOf(altMatch.locator[alternationNdx]);
              if (!shouldMerge && alternationNdx > altMatch.alternation) for (var i = altMatch.alternation; i < alternationNdx; i++) {
                if (targetMatch.locator[i] !== altMatch.locator[i]) {
                  alternationNdx = i, shouldMerge = !0;
                  break;
                }
              }

              if (shouldMerge) {
                targetMatch.mloc = targetMatch.mloc || {};
                var locNdx = targetMatch.locator[alternationNdx];

                if (void 0 !== locNdx) {
                  if ("string" == typeof locNdx && (locNdx = locNdx.split(",")[0]), void 0 === targetMatch.mloc[locNdx] && (targetMatch.mloc[locNdx] = targetMatch.locator.slice()), void 0 !== altMatch) {
                    for (var ndx in altMatch.mloc) {
                      "string" == typeof ndx && (ndx = ndx.split(",")[0]), void 0 === targetMatch.mloc[ndx] && (targetMatch.mloc[ndx] = altMatch.mloc[ndx]);
                    }

                    targetMatch.locator[alternationNdx] = Object.keys(targetMatch.mloc).join(",");
                  }

                  return !0;
                }

                targetMatch.alternation = void 0;
              }

              return !1;
            }

            function isSameLevel(targetMatch, altMatch) {
              if (targetMatch.locator.length !== altMatch.locator.length) return !1;

              for (var locNdx = targetMatch.alternation + 1; locNdx < targetMatch.locator.length; locNdx++) {
                if (targetMatch.locator[locNdx] !== altMatch.locator[locNdx]) return !1;
              }

              return !0;
            }

            if (testPos > opts._maxTestPos && void 0 !== quantifierRecurse) throw "Inputmask: There is probably an error in your mask definition or in the code. Create an issue on github with an example of the mask you are using. " + maskset.mask;
            if (testPos === pos && void 0 === match.matches) return matches.push({
              match: match,
              locator: loopNdx.reverse(),
              cd: cacheDependency,
              mloc: {}
            }), !0;

            if (void 0 !== match.matches) {
              if (match.isGroup && quantifierRecurse !== match) {
                if (match = handleMatch(maskToken.matches[$.inArray(match, maskToken.matches) + 1], loopNdx, quantifierRecurse), match) return !0;
              } else if (match.isOptional) {
                var optionalToken = match,
                    mtchsNdx = matches.length;

                if (match = resolveTestFromToken(match, ndxInitializer, loopNdx, quantifierRecurse), match) {
                  if ($.each(matches, function (ndx, mtch) {
                    mtchsNdx <= ndx && (mtch.match.optionality = !0);
                  }), latestMatch = matches[matches.length - 1].match, void 0 !== quantifierRecurse || !isFirstMatch(latestMatch, optionalToken)) return !0;
                  insertStop = !0, testPos = pos;
                }
              } else if (match.isAlternator) {
                var alternateToken = match,
                    malternateMatches = [],
                    maltMatches,
                    currentMatches = matches.slice(),
                    loopNdxCnt = loopNdx.length,
                    altIndex = 0 < ndxInitializer.length ? ndxInitializer.shift() : -1;

                if (-1 === altIndex || "string" == typeof altIndex) {
                  var currentPos = testPos,
                      ndxInitializerClone = ndxInitializer.slice(),
                      altIndexArr = [],
                      amndx;
                  if ("string" == typeof altIndex) altIndexArr = altIndex.split(",");else for (amndx = 0; amndx < alternateToken.matches.length; amndx++) {
                    altIndexArr.push(amndx.toString());
                  }

                  if (void 0 !== maskset.excludes[pos]) {
                    for (var altIndexArrClone = altIndexArr.slice(), i = 0, exl = maskset.excludes[pos].length; i < exl; i++) {
                      var excludeSet = maskset.excludes[pos][i].toString().split(":");
                      loopNdx.length == excludeSet[1] && altIndexArr.splice(altIndexArr.indexOf(excludeSet[0]), 1);
                    }

                    0 === altIndexArr.length && (delete maskset.excludes[pos], altIndexArr = altIndexArrClone);
                  }

                  (!0 === opts.keepStatic || isFinite(parseInt(opts.keepStatic)) && currentPos >= opts.keepStatic) && (altIndexArr = altIndexArr.slice(0, 1));

                  for (var unMatchedAlternation = !1, ndx = 0; ndx < altIndexArr.length; ndx++) {
                    amndx = parseInt(altIndexArr[ndx]), matches = [], ndxInitializer = "string" == typeof altIndex && resolveNdxInitializer(testPos, amndx, loopNdxCnt) || ndxInitializerClone.slice(), alternateToken.matches[amndx] && handleMatch(alternateToken.matches[amndx], [amndx].concat(loopNdx), quantifierRecurse) ? match = !0 : 0 === ndx && (unMatchedAlternation = !0), maltMatches = matches.slice(), testPos = currentPos, matches = [];

                    for (var ndx1 = 0; ndx1 < maltMatches.length; ndx1++) {
                      var altMatch = maltMatches[ndx1],
                          dropMatch = !1;
                      altMatch.match.jit = altMatch.match.jit || unMatchedAlternation, altMatch.alternation = altMatch.alternation || loopNdxCnt, setMergeLocators(altMatch);

                      for (var ndx2 = 0; ndx2 < malternateMatches.length; ndx2++) {
                        var altMatch2 = malternateMatches[ndx2];

                        if ("string" != typeof altIndex || void 0 !== altMatch.alternation && -1 !== $.inArray(altMatch.locator[altMatch.alternation].toString(), altIndexArr)) {
                          if (altMatch.match.nativeDef === altMatch2.match.nativeDef) {
                            dropMatch = !0, setMergeLocators(altMatch2, altMatch);
                            break;
                          }

                          if (isSubsetOf(altMatch, altMatch2)) {
                            setMergeLocators(altMatch, altMatch2) && (dropMatch = !0, malternateMatches.splice(malternateMatches.indexOf(altMatch2), 0, altMatch));
                            break;
                          }

                          if (isSubsetOf(altMatch2, altMatch)) {
                            setMergeLocators(altMatch2, altMatch);
                            break;
                          }

                          if (staticCanMatchDefinition(altMatch, altMatch2)) {
                            isSameLevel(altMatch, altMatch2) || void 0 !== el.inputmask.userOptions.keepStatic ? setMergeLocators(altMatch, altMatch2) && (dropMatch = !0, malternateMatches.splice(malternateMatches.indexOf(altMatch2), 0, altMatch)) : opts.keepStatic = !0;
                            break;
                          }
                        }
                      }

                      dropMatch || malternateMatches.push(altMatch);
                    }
                  }

                  matches = currentMatches.concat(malternateMatches), testPos = pos, insertStop = 0 < matches.length, match = 0 < malternateMatches.length, ndxInitializer = ndxInitializerClone.slice();
                } else match = handleMatch(alternateToken.matches[altIndex] || maskToken.matches[altIndex], [altIndex].concat(loopNdx), quantifierRecurse);

                if (match) return !0;
              } else if (match.isQuantifier && quantifierRecurse !== maskToken.matches[$.inArray(match, maskToken.matches) - 1]) for (var qt = match, qndx = 0 < ndxInitializer.length ? ndxInitializer.shift() : 0; qndx < (isNaN(qt.quantifier.max) ? qndx + 1 : qt.quantifier.max) && testPos <= pos; qndx++) {
                var tokenGroup = maskToken.matches[$.inArray(qt, maskToken.matches) - 1];

                if (match = handleMatch(tokenGroup, [qndx].concat(loopNdx), tokenGroup), match) {
                  if (latestMatch = matches[matches.length - 1].match, latestMatch.optionalQuantifier = qndx >= qt.quantifier.min, latestMatch.jit = (qndx || 1) * tokenGroup.matches.indexOf(latestMatch) >= qt.quantifier.jit, latestMatch.optionalQuantifier && isFirstMatch(latestMatch, tokenGroup)) {
                    insertStop = !0, testPos = pos;
                    break;
                  }

                  return latestMatch.jit && (maskset.jitOffset[pos] = tokenGroup.matches.length - tokenGroup.matches.indexOf(latestMatch)), !0;
                }
              } else if (match = resolveTestFromToken(match, ndxInitializer, loopNdx, quantifierRecurse), match) return !0;
            } else testPos++;
          }

          for (var tndx = 0 < ndxInitializer.length ? ndxInitializer.shift() : 0; tndx < maskToken.matches.length; tndx++) {
            if (!0 !== maskToken.matches[tndx].isQuantifier) {
              var match = handleMatch(maskToken.matches[tndx], [tndx].concat(loopNdx), quantifierRecurse);
              if (match && testPos === pos) return match;
              if (pos < testPos) break;
            }
          }
        }

        function mergeLocators(pos, tests) {
          var locator = [];
          return $.isArray(tests) || (tests = [tests]), 0 < tests.length && (void 0 === tests[0].alternation || !0 === opts.keepStatic ? (locator = determineTestTemplate(pos, tests.slice()).locator.slice(), 0 === locator.length && (locator = tests[0].locator.slice())) : $.each(tests, function (ndx, tst) {
            if ("" !== tst.def) if (0 === locator.length) locator = tst.locator.slice();else for (var i = 0; i < locator.length; i++) {
              tst.locator[i] && -1 === locator[i].toString().indexOf(tst.locator[i]) && (locator[i] += "," + tst.locator[i]);
            }
          })), locator;
        }

        if (-1 < pos && (void 0 === inputmask.maxLength || pos < inputmask.maxLength)) {
          if (void 0 === ndxIntlzr) {
            for (var previousPos = pos - 1, test; void 0 === (test = maskset.validPositions[previousPos] || maskset.tests[previousPos]) && -1 < previousPos;) {
              previousPos--;
            }

            void 0 !== test && -1 < previousPos && (ndxInitializer = mergeLocators(previousPos, test), cacheDependency = ndxInitializer.join(""), testPos = previousPos);
          }

          if (maskset.tests[pos] && maskset.tests[pos][0].cd === cacheDependency) return maskset.tests[pos];

          for (var mtndx = ndxInitializer.shift(); mtndx < maskTokens.length; mtndx++) {
            var match = resolveTestFromToken(maskTokens[mtndx], ndxInitializer, [mtndx]);
            if (match && testPos === pos || pos < testPos) break;
          }
        }

        return 0 !== matches.length && !insertStop || matches.push({
          match: {
            fn: null,
            "static": !0,
            optionality: !1,
            casing: null,
            def: "",
            placeholder: ""
          },
          locator: [],
          mloc: {},
          cd: cacheDependency
        }), void 0 !== ndxIntlzr && maskset.tests[pos] ? $.extend(!0, [], matches) : (maskset.tests[pos] = $.extend(!0, [], matches), maskset.tests[pos]);
      }

      function getBufferTemplate() {
        return void 0 === maskset._buffer && (maskset._buffer = getMaskTemplate(!1, 1), void 0 === maskset.buffer && (maskset.buffer = maskset._buffer.slice())), maskset._buffer;
      }

      function getBuffer(noCache) {
        return void 0 !== maskset.buffer && !0 !== noCache || (maskset.buffer = getMaskTemplate(!0, getLastValidPosition(), !0), void 0 === maskset._buffer && (maskset._buffer = maskset.buffer.slice())), maskset.buffer;
      }

      function refreshFromBuffer(start, end, buffer) {
        var i,
            p,
            skipOptionalPartCharacter = opts.skipOptionalPartCharacter,
            bffr = isRTL ? buffer.slice().reverse() : buffer;
        if (opts.skipOptionalPartCharacter = "", !0 === start) resetMaskSet(), maskset.tests = {}, start = 0, end = buffer.length, p = determineNewCaretPosition({
          begin: 0,
          end: 0
        }, !1).begin;else {
          for (i = start; i < end; i++) {
            delete maskset.validPositions[i];
          }

          p = start;
        }
        var keypress = new $.Event("keypress");

        for (i = start; i < end; i++) {
          keypress.which = bffr[i].toString().charCodeAt(0), inputmask.ignorable = !1;
          var valResult = EventHandlers.keypressEvent.call(el, keypress, !0, !1, !1, p);
          !1 !== valResult && (p = valResult.forwardPosition);
        }

        opts.skipOptionalPartCharacter = skipOptionalPartCharacter;
      }

      function casing(elem, test, pos) {
        switch (opts.casing || test.casing) {
          case "upper":
            elem = elem.toUpperCase();
            break;

          case "lower":
            elem = elem.toLowerCase();
            break;

          case "title":
            var posBefore = maskset.validPositions[pos - 1];
            elem = 0 === pos || posBefore && posBefore.input === String.fromCharCode(keyCode.SPACE) ? elem.toUpperCase() : elem.toLowerCase();
            break;

          default:
            if ($.isFunction(opts.casing)) {
              var args = Array.prototype.slice.call(arguments);
              args.push(maskset.validPositions), elem = opts.casing.apply(this, args);
            }

        }

        return elem;
      }

      function checkAlternationMatch(altArr1, altArr2, na) {
        for (var altArrC = opts.greedy ? altArr2 : altArr2.slice(0, 1), isMatch = !1, naArr = void 0 !== na ? na.split(",") : [], naNdx, i = 0; i < naArr.length; i++) {
          -1 !== (naNdx = altArr1.indexOf(naArr[i])) && altArr1.splice(naNdx, 1);
        }

        for (var alndx = 0; alndx < altArr1.length; alndx++) {
          if (-1 !== $.inArray(altArr1[alndx], altArrC)) {
            isMatch = !0;
            break;
          }
        }

        return isMatch;
      }

      function alternate(maskPos, c, strict, fromIsValid, rAltPos, selection) {
        var validPsClone = $.extend(!0, {}, maskset.validPositions),
            tstClone = $.extend(!0, {}, maskset.tests),
            lastAlt,
            alternation,
            isValidRslt = !1,
            returnRslt = !1,
            altPos,
            prevAltPos,
            i,
            validPos,
            decisionPos,
            lAltPos = void 0 !== rAltPos ? rAltPos : getLastValidPosition(),
            nextPos,
            input,
            begin,
            end;
        if (selection && (begin = selection.begin, end = selection.end, selection.begin > selection.end && (begin = selection.end, end = selection.begin)), -1 === lAltPos && void 0 === rAltPos) lastAlt = 0, prevAltPos = getTest(lastAlt), alternation = prevAltPos.alternation;else for (; 0 <= lAltPos; lAltPos--) {
          if (altPos = maskset.validPositions[lAltPos], altPos && void 0 !== altPos.alternation) {
            if (prevAltPos && prevAltPos.locator[altPos.alternation] !== altPos.locator[altPos.alternation]) break;
            lastAlt = lAltPos, alternation = maskset.validPositions[lastAlt].alternation, prevAltPos = altPos;
          }
        }

        if (void 0 !== alternation) {
          decisionPos = parseInt(lastAlt), maskset.excludes[decisionPos] = maskset.excludes[decisionPos] || [], !0 !== maskPos && maskset.excludes[decisionPos].push(getDecisionTaker(prevAltPos) + ":" + prevAltPos.alternation);
          var validInputs = [],
              resultPos = -1;

          for (i = decisionPos; i < getLastValidPosition(void 0, !0) + 1; i++) {
            -1 === resultPos && maskPos <= i && void 0 !== c && (validInputs.push(c), resultPos = validInputs.length - 1), validPos = maskset.validPositions[i], validPos && !0 !== validPos.generatedInput && (void 0 === selection || i < begin || end <= i) && validInputs.push(validPos.input), delete maskset.validPositions[i];
          }

          for (-1 === resultPos && void 0 !== c && (validInputs.push(c), resultPos = validInputs.length - 1); void 0 !== maskset.excludes[decisionPos] && maskset.excludes[decisionPos].length < 10;) {
            for (maskset.tests = {}, resetMaskSet(!0), isValidRslt = !0, i = 0; i < validInputs.length && (nextPos = isValidRslt.caret || getLastValidPosition(void 0, !0) + 1, input = validInputs[i], isValidRslt = isValid(nextPos, input, !1, fromIsValid, !0)); i++) {
              i === resultPos && (returnRslt = isValidRslt), 1 == maskPos && isValidRslt && (returnRslt = {
                caretPos: i
              });
            }

            if (isValidRslt) break;

            if (resetMaskSet(), prevAltPos = getTest(decisionPos), maskset.validPositions = $.extend(!0, {}, validPsClone), maskset.tests = $.extend(!0, {}, tstClone), !maskset.excludes[decisionPos]) {
              returnRslt = alternate(maskPos, c, strict, fromIsValid, decisionPos - 1, selection);
              break;
            }

            var decisionTaker = getDecisionTaker(prevAltPos);

            if (-1 !== maskset.excludes[decisionPos].indexOf(decisionTaker + ":" + prevAltPos.alternation)) {
              returnRslt = alternate(maskPos, c, strict, fromIsValid, decisionPos - 1, selection);
              break;
            }

            for (maskset.excludes[decisionPos].push(decisionTaker + ":" + prevAltPos.alternation), i = decisionPos; i < getLastValidPosition(void 0, !0) + 1; i++) {
              delete maskset.validPositions[i];
            }
          }
        }

        return returnRslt && !1 === opts.keepStatic || delete maskset.excludes[decisionPos], returnRslt;
      }

      function isValid(pos, c, strict, fromIsValid, fromAlternate, validateOnly) {
        function isSelection(posObj) {
          return isRTL ? 1 < posObj.begin - posObj.end || posObj.begin - posObj.end == 1 : 1 < posObj.end - posObj.begin || posObj.end - posObj.begin == 1;
        }

        strict = !0 === strict;
        var maskPos = pos;

        function processCommandObject(commandObj) {
          if (void 0 !== commandObj) {
            if (void 0 !== commandObj.remove && ($.isArray(commandObj.remove) || (commandObj.remove = [commandObj.remove]), $.each(commandObj.remove.sort(function (a, b) {
              return b.pos - a.pos;
            }), function (ndx, lmnt) {
              revalidateMask({
                begin: lmnt,
                end: lmnt + 1
              });
            }), commandObj.remove = void 0), void 0 !== commandObj.insert && ($.isArray(commandObj.insert) || (commandObj.insert = [commandObj.insert]), $.each(commandObj.insert.sort(function (a, b) {
              return a.pos - b.pos;
            }), function (ndx, lmnt) {
              "" !== lmnt.c && isValid(lmnt.pos, lmnt.c, void 0 === lmnt.strict || lmnt.strict, void 0 !== lmnt.fromIsValid ? lmnt.fromIsValid : fromIsValid);
            }), commandObj.insert = void 0), commandObj.refreshFromBuffer && commandObj.buffer) {
              var refresh = commandObj.refreshFromBuffer;
              refreshFromBuffer(!0 === refresh ? refresh : refresh.start, refresh.end, commandObj.buffer), commandObj.refreshFromBuffer = void 0;
            }

            void 0 !== commandObj.rewritePosition && (maskPos = commandObj.rewritePosition, commandObj = !0);
          }

          return commandObj;
        }

        function _isValid(position, c, strict) {
          var rslt = !1;
          return $.each(getTests(position), function (ndx, tst) {
            var test = tst.match;

            if (getBuffer(!0), rslt = null != test.fn ? test.fn.test(c, maskset, position, strict, opts, isSelection(pos)) : (c === test.def || c === opts.skipOptionalPartCharacter) && "" !== test.def && {
              c: getPlaceholder(position, test, !0) || test.def,
              pos: position
            }, !1 !== rslt) {
              var elem = void 0 !== rslt.c ? rslt.c : c,
                  validatedPos = position;
              return elem = elem === opts.skipOptionalPartCharacter && !0 === test["static"] ? getPlaceholder(position, test, !0) || test.def : elem, rslt = processCommandObject(rslt), !0 !== rslt && void 0 !== rslt.pos && rslt.pos !== position && (validatedPos = rslt.pos), !0 !== rslt && void 0 === rslt.pos && void 0 === rslt.c ? !1 : (!1 === revalidateMask(pos, $.extend({}, tst, {
                input: casing(elem, test, validatedPos)
              }), fromIsValid, validatedPos) && (rslt = !1), !1);
            }
          }), rslt;
        }

        void 0 !== pos.begin && (maskPos = isRTL ? pos.end : pos.begin);
        var result = !0,
            positionsClone = $.extend(!0, {}, maskset.validPositions);
        if (!1 === opts.keepStatic && void 0 !== maskset.excludes[maskPos] && !0 !== fromAlternate && !0 !== fromIsValid) for (var i = maskPos; i < (isRTL ? pos.begin : pos.end); i++) {
          void 0 !== maskset.excludes[i] && (maskset.excludes[i] = void 0, delete maskset.tests[i]);
        }

        if ($.isFunction(opts.preValidation) && !0 !== fromIsValid && !0 !== validateOnly && (result = opts.preValidation.call(el, getBuffer(), maskPos, c, isSelection(pos), opts, maskset, pos, strict || fromAlternate), result = processCommandObject(result)), !0 === result) {
          if (void 0 === inputmask.maxLength || maskPos < inputmask.maxLength) {
            if (result = _isValid(maskPos, c, strict), (!strict || !0 === fromIsValid) && !1 === result && !0 !== validateOnly) {
              var currentPosValid = maskset.validPositions[maskPos];

              if (!currentPosValid || !0 !== currentPosValid.match["static"] || currentPosValid.match.def !== c && c !== opts.skipOptionalPartCharacter) {
                if (opts.insertMode || void 0 === maskset.validPositions[seekNext(maskPos)] || pos.end > maskPos) {
                  var skip = !1;
                  if (maskset.jitOffset[maskPos] && void 0 === maskset.validPositions[seekNext(maskPos)] && (result = isValid(maskPos + maskset.jitOffset[maskPos], c, !0), !1 !== result && (!0 !== fromAlternate && (result.caret = maskPos), skip = !0)), pos.end > maskPos && (maskset.validPositions[maskPos] = void 0), !skip && !isMask(maskPos, opts.keepStatic)) for (var nPos = maskPos + 1, snPos = seekNext(maskPos); nPos <= snPos; nPos++) {
                    if (result = _isValid(nPos, c, strict), !1 !== result) {
                      result = trackbackPositions(maskPos, void 0 !== result.pos ? result.pos : nPos) || result, maskPos = nPos;
                      break;
                    }
                  }
                }
              } else result = {
                caret: seekNext(maskPos)
              };
            }
          } else result = !1;

          !1 !== result || !opts.keepStatic || !isComplete(getBuffer()) && 0 !== maskPos || strict || !0 === fromAlternate ? isSelection(pos) && maskset.tests[maskPos] && 1 < maskset.tests[maskPos].length && opts.keepStatic && !strict && !0 !== fromAlternate && (result = alternate(!0)) : result = alternate(maskPos, c, strict, fromIsValid, void 0, pos), !0 === result && (result = {
            pos: maskPos
          });
        }

        if ($.isFunction(opts.postValidation) && !0 !== fromIsValid && !0 !== validateOnly) {
          var postResult = opts.postValidation.call(el, getBuffer(!0), void 0 !== pos.begin ? isRTL ? pos.end : pos.begin : pos, c, result, opts, maskset, strict);
          void 0 !== postResult && (result = !0 === postResult ? result : postResult);
        }

        result && void 0 === result.pos && (result.pos = maskPos), !1 === result || !0 === validateOnly ? (resetMaskSet(!0), maskset.validPositions = $.extend(!0, {}, positionsClone)) : trackbackPositions(void 0, maskPos, !0);
        var endResult = processCommandObject(result);
        return endResult;
      }

      function trackbackPositions(originalPos, newPos, fillOnly) {
        if (void 0 === originalPos) for (originalPos = newPos - 1; 0 < originalPos && !maskset.validPositions[originalPos]; originalPos--) {
          ;
        }

        for (var ps = originalPos; ps < newPos; ps++) {
          if (void 0 === maskset.validPositions[ps] && !isMask(ps, !0)) {
            var vp = 0 == ps ? getTest(ps) : maskset.validPositions[ps - 1];

            if (vp) {
              var tests = getTests(ps).slice();
              "" === tests[tests.length - 1].match.def && tests.pop();
              var bestMatch = determineTestTemplate(ps, tests),
                  np;

              if (bestMatch && (!0 !== bestMatch.match.jit || "master" === bestMatch.match.newBlockMarker && (np = maskset.validPositions[ps + 1]) && !0 === np.match.optionalQuantifier) && (bestMatch = $.extend({}, bestMatch, {
                input: getPlaceholder(ps, bestMatch.match, !0) || bestMatch.match.def
              }), bestMatch.generatedInput = !0, revalidateMask(ps, bestMatch, !0), !0 !== fillOnly)) {
                var cvpInput = maskset.validPositions[newPos].input;
                return maskset.validPositions[newPos] = void 0, isValid(newPos, cvpInput, !0, !0);
              }
            }
          }
        }
      }

      function revalidateMask(pos, validTest, fromIsValid, validatedPos) {
        function IsEnclosedStatic(pos, valids, selection) {
          var posMatch = valids[pos];
          if (void 0 === posMatch || !0 !== posMatch.match["static"] || !0 === posMatch.match.optionality || void 0 !== valids[0] && void 0 !== valids[0].alternation) return !1;
          var prevMatch = selection.begin <= pos - 1 ? valids[pos - 1] && !0 === valids[pos - 1].match["static"] && valids[pos - 1] : valids[pos - 1],
              nextMatch = selection.end > pos + 1 ? valids[pos + 1] && !0 === valids[pos + 1].match["static"] && valids[pos + 1] : valids[pos + 1];
          return prevMatch && nextMatch;
        }

        var offset = 0,
            begin = void 0 !== pos.begin ? pos.begin : pos,
            end = void 0 !== pos.end ? pos.end : pos;

        if (pos.begin > pos.end && (begin = pos.end, end = pos.begin), validatedPos = void 0 !== validatedPos ? validatedPos : begin, begin !== end || opts.insertMode && void 0 !== maskset.validPositions[validatedPos] && void 0 === fromIsValid || void 0 === validTest) {
          var positionsClone = $.extend(!0, {}, maskset.validPositions),
              lvp = getLastValidPosition(void 0, !0),
              i;

          for (maskset.p = begin, i = lvp; begin <= i; i--) {
            delete maskset.validPositions[i], void 0 === validTest && delete maskset.tests[i + 1];
          }

          var valid = !0,
              j = validatedPos,
              posMatch = j,
              t,
              canMatch;

          for (validTest && (maskset.validPositions[validatedPos] = $.extend(!0, {}, validTest), posMatch++, j++), i = validTest ? end : end - 1; i <= lvp; i++) {
            if (void 0 !== (t = positionsClone[i]) && !0 !== t.generatedInput && (end <= i || begin <= i && IsEnclosedStatic(i, positionsClone, {
              begin: begin,
              end: end
            }))) {
              for (; "" !== getTest(posMatch).match.def;) {
                if (!1 !== (canMatch = positionCanMatchDefinition(posMatch, t, opts)) || "+" === t.match.def) {
                  "+" === t.match.def && getBuffer(!0);
                  var result = isValid(posMatch, t.input, "+" !== t.match.def, "+" !== t.match.def);
                  if (valid = !1 !== result, j = (result.pos || posMatch) + 1, !valid && canMatch) break;
                } else valid = !1;

                if (valid) {
                  void 0 === validTest && t.match["static"] && i === pos.begin && offset++;
                  break;
                }

                if (!valid && posMatch > maskset.maskLength) break;
                posMatch++;
              }

              "" == getTest(posMatch).match.def && (valid = !1), posMatch = j;
            }

            if (!valid) break;
          }

          if (!valid) return maskset.validPositions = $.extend(!0, {}, positionsClone), resetMaskSet(!0), !1;
        } else validTest && getTest(validatedPos).match.cd === validTest.match.cd && (maskset.validPositions[validatedPos] = $.extend(!0, {}, validTest));

        return resetMaskSet(!0), offset;
      }

      function isMask(pos, strict, fuzzy) {
        var test = getTestTemplate(pos).match;
        if ("" === test.def && (test = getTest(pos).match), !0 !== test["static"]) return test.fn;
        if (!0 === fuzzy && void 0 !== maskset.validPositions[pos] && !0 !== maskset.validPositions[pos].generatedInput) return !0;

        if (!0 !== strict && -1 < pos) {
          if (fuzzy) {
            var tests = getTests(pos);
            return tests.length > 1 + ("" === tests[tests.length - 1].match.def ? 1 : 0);
          }

          var testTemplate = determineTestTemplate(pos, getTests(pos)),
              testPlaceHolder = getPlaceholder(pos, testTemplate.match);
          return testTemplate.match.def !== testPlaceHolder;
        }

        return !1;
      }

      function seekNext(pos, newBlock, fuzzy) {
        void 0 === fuzzy && (fuzzy = !0);

        for (var position = pos + 1; "" !== getTest(position).match.def && (!0 === newBlock && (!0 !== getTest(position).match.newBlockMarker || !isMask(position, void 0, !0)) || !0 !== newBlock && !isMask(position, void 0, fuzzy));) {
          position++;
        }

        return position;
      }

      function seekPrevious(pos, newBlock) {
        var position = pos,
            tests;
        if (position <= 0) return 0;

        for (; 0 < --position && (!0 === newBlock && !0 !== getTest(position).match.newBlockMarker || !0 !== newBlock && !isMask(position, void 0, !0) && (tests = getTests(position), tests.length < 2 || 2 === tests.length && "" === tests[1].match.def));) {
          ;
        }

        return position;
      }

      function writeBuffer(input, buffer, caretPos, event, triggerEvents) {
        if (event && $.isFunction(opts.onBeforeWrite)) {
          var result = opts.onBeforeWrite.call(inputmask, event, buffer, caretPos, opts);

          if (result) {
            if (result.refreshFromBuffer) {
              var refresh = result.refreshFromBuffer;
              refreshFromBuffer(!0 === refresh ? refresh : refresh.start, refresh.end, result.buffer || buffer), buffer = getBuffer(!0);
            }

            void 0 !== caretPos && (caretPos = void 0 !== result.caret ? result.caret : caretPos);
          }
        }

        if (void 0 !== input && (input.inputmask._valueSet(buffer.join("")), void 0 === caretPos || void 0 !== event && "blur" === event.type || caret(input, caretPos, void 0, void 0, void 0 !== event && "keydown" === event.type && (event.keyCode === keyCode.DELETE || event.keyCode === keyCode.BACKSPACE)), !0 === triggerEvents)) {
          var $input = $(input),
              nptVal = input.inputmask._valueGet();

          input.inputmask.skipInputEvent = !0, $input.trigger("input"), setTimeout(function () {
            nptVal === getBufferTemplate().join("") ? $input.trigger("cleared") : !0 === isComplete(buffer) && $input.trigger("complete");
          }, 0);
        }
      }

      function getPlaceholder(pos, test, returnPL) {
        if (test = test || getTest(pos).match, void 0 !== test.placeholder || !0 === returnPL) return $.isFunction(test.placeholder) ? test.placeholder(opts) : test.placeholder;
        if (!0 !== test["static"]) return opts.placeholder.charAt(pos % opts.placeholder.length);

        if (-1 < pos && void 0 === maskset.validPositions[pos]) {
          var tests = getTests(pos),
              staticAlternations = [],
              prevTest;
          if (tests.length > 1 + ("" === tests[tests.length - 1].match.def ? 1 : 0)) for (var i = 0; i < tests.length; i++) {
            if ("" !== tests[i].match.def && !0 !== tests[i].match.optionality && !0 !== tests[i].match.optionalQuantifier && (!0 === tests[i].match["static"] || void 0 === prevTest || !1 !== tests[i].match.fn.test(prevTest.match.def, maskset, pos, !0, opts)) && (staticAlternations.push(tests[i]), !0 === tests[i].match["static"] && (prevTest = tests[i]), 1 < staticAlternations.length && /[0-9a-bA-Z]/.test(staticAlternations[0].match.def))) return opts.placeholder.charAt(pos % opts.placeholder.length);
          }
        }

        return test.def;
      }

      function HandleNativePlaceholder(npt, value) {
        if (ie) {
          if (npt.inputmask._valueGet() !== value && (npt.placeholder !== value || "" === npt.placeholder)) {
            var buffer = getBuffer().slice(),
                nptValue = npt.inputmask._valueGet();

            if (nptValue !== value) {
              var lvp = getLastValidPosition();
              -1 === lvp && nptValue === getBufferTemplate().join("") ? buffer = [] : -1 !== lvp && clearOptionalTail(buffer), writeBuffer(npt, buffer);
            }
          }
        } else npt.placeholder !== value && (npt.placeholder = value, "" === npt.placeholder && npt.removeAttribute("placeholder"));
      }

      function determineNewCaretPosition(selectedCaret, tabbed) {
        function doRadixFocus(clickPos) {
          if ("" !== opts.radixPoint && 0 !== opts.digits) {
            var vps = maskset.validPositions;

            if (void 0 === vps[clickPos] || vps[clickPos].input === getPlaceholder(clickPos)) {
              if (clickPos < seekNext(-1)) return !0;
              var radixPos = $.inArray(opts.radixPoint, getBuffer());

              if (-1 !== radixPos) {
                for (var vp in vps) {
                  if (vps[vp] && radixPos < vp && vps[vp].input !== getPlaceholder(vp)) return !1;
                }

                return !0;
              }
            }
          }

          return !1;
        }

        if (tabbed && (isRTL ? selectedCaret.end = selectedCaret.begin : selectedCaret.begin = selectedCaret.end), selectedCaret.begin === selectedCaret.end) {
          switch (opts.positionCaretOnClick) {
            case "none":
              break;

            case "select":
              selectedCaret = {
                begin: 0,
                end: getBuffer().length
              };
              break;

            case "ignore":
              selectedCaret.end = selectedCaret.begin = seekNext(getLastValidPosition());
              break;

            case "radixFocus":
              if (doRadixFocus(selectedCaret.begin)) {
                var radixPos = getBuffer().join("").indexOf(opts.radixPoint);
                selectedCaret.end = selectedCaret.begin = opts.numericInput ? seekNext(radixPos) : radixPos;
                break;
              }

            default:
              var clickPosition = selectedCaret.begin,
                  lvclickPosition = getLastValidPosition(clickPosition, !0),
                  lastPosition = seekNext(-1 !== lvclickPosition || isMask(0) ? lvclickPosition : 0);
              if (clickPosition < lastPosition) selectedCaret.end = selectedCaret.begin = isMask(clickPosition, !0) || isMask(clickPosition - 1, !0) ? clickPosition : seekNext(clickPosition);else {
                var lvp = maskset.validPositions[lvclickPosition],
                    tt = getTestTemplate(lastPosition, lvp ? lvp.match.locator : void 0, lvp),
                    placeholder = getPlaceholder(lastPosition, tt.match);

                if ("" !== placeholder && getBuffer()[lastPosition] !== placeholder && !0 !== tt.match.optionalQuantifier && !0 !== tt.match.newBlockMarker || !isMask(lastPosition, opts.keepStatic) && tt.match.def === placeholder) {
                  var newPos = seekNext(lastPosition);
                  (newPos <= clickPosition || clickPosition === lastPosition) && (lastPosition = newPos);
                }

                selectedCaret.end = selectedCaret.begin = lastPosition;
              }
          }

          return selectedCaret;
        }
      }

      var EventRuler = {
        on: function on(input, eventName, eventHandler) {
          var ev = function ev(e) {
            e.originalEvent && (e = e.originalEvent || e, arguments[0] = e);
            var that = this,
                args,
                inputmask = that.inputmask;

            if (void 0 === inputmask && "FORM" !== this.nodeName) {
              var imOpts = $.data(that, "_inputmask_opts");
              imOpts ? new Inputmask(imOpts).mask(that) : EventRuler.off(that);
            } else {
              if ("setvalue" === e.type || "FORM" === this.nodeName || !(that.disabled || that.readOnly && !("keydown" === e.type && e.ctrlKey && 67 === e.keyCode || !1 === opts.tabThrough && e.keyCode === keyCode.TAB))) {
                switch (e.type) {
                  case "input":
                    if (!0 === inputmask.skipInputEvent || e.inputType && "insertCompositionText" === e.inputType) return inputmask.skipInputEvent = !1, e.preventDefault();
                    break;

                  case "keydown":
                    inputmask.skipKeyPressEvent = !1, inputmask.skipInputEvent = !1;
                    break;

                  case "keypress":
                    if (!0 === inputmask.skipKeyPressEvent) return e.preventDefault();
                    inputmask.skipKeyPressEvent = !0;
                    break;

                  case "click":
                  case "focus":
                    return inputmask.validationEvent ? (inputmask.validationEvent = !1, input.blur(), HandleNativePlaceholder(input, (isRTL ? getBufferTemplate().slice().reverse() : getBufferTemplate()).join("")), setTimeout(function () {
                      input.focus();
                    }, 3e3)) : (args = arguments, setTimeout(function () {
                      input.inputmask && eventHandler.apply(that, args);
                    }, 0)), !1;
                }

                var returnVal = eventHandler.apply(that, arguments);
                return !1 === returnVal && (e.preventDefault(), e.stopPropagation()), returnVal;
              }

              e.preventDefault();
            }
          };

          input.inputmask.events[eventName] = input.inputmask.events[eventName] || [], input.inputmask.events[eventName].push(ev), -1 !== $.inArray(eventName, ["submit", "reset"]) ? null !== input.form && $(input.form).on(eventName, ev) : $(input).on(eventName, ev);
        },
        off: function off(input, event) {
          var events;
          input.inputmask && input.inputmask.events && (event ? (events = [], events[event] = input.inputmask.events[event]) : events = input.inputmask.events, $.each(events, function (eventName, evArr) {
            for (; 0 < evArr.length;) {
              var ev = evArr.pop();
              -1 !== $.inArray(eventName, ["submit", "reset"]) ? null !== input.form && $(input.form).off(eventName, ev) : $(input).off(eventName, ev);
            }

            delete input.inputmask.events[eventName];
          }));
        }
      },
          EventHandlers = {
        keydownEvent: function keydownEvent(e) {
          var input = this,
              $input = $(input),
              k = e.keyCode,
              pos = caret(input),
              kdResult = opts.onKeyDown.call(this, e, getBuffer(), pos, opts);
          if (void 0 !== kdResult) return kdResult;
          if (k === keyCode.BACKSPACE || k === keyCode.DELETE || iphone && k === keyCode.BACKSPACE_SAFARI || e.ctrlKey && k === keyCode.X && !("oncut" in input)) e.preventDefault(), handleRemove(input, k, pos), writeBuffer(input, getBuffer(!0), maskset.p, e, input.inputmask._valueGet() !== getBuffer().join(""));else if (k === keyCode.END || k === keyCode.PAGE_DOWN) {
            e.preventDefault();
            var caretPos = seekNext(getLastValidPosition());
            caret(input, e.shiftKey ? pos.begin : caretPos, caretPos, !0);
          } else k === keyCode.HOME && !e.shiftKey || k === keyCode.PAGE_UP ? (e.preventDefault(), caret(input, 0, e.shiftKey ? pos.begin : 0, !0)) : (opts.undoOnEscape && k === keyCode.ESCAPE || 90 === k && e.ctrlKey) && !0 !== e.altKey ? (checkVal(input, !0, !1, inputmask.undoValue.split("")), $input.trigger("click")) : !0 === opts.tabThrough && k === keyCode.TAB ? (!0 === e.shiftKey ? (!0 === getTest(pos.begin).match["static"] && (pos.begin = seekNext(pos.begin)), pos.end = seekPrevious(pos.begin, !0), pos.begin = seekPrevious(pos.end, !0)) : (pos.begin = seekNext(pos.begin, !0), pos.end = seekNext(pos.begin, !0), pos.end < maskset.maskLength && pos.end--), pos.begin < maskset.maskLength && (e.preventDefault(), caret(input, pos.begin, pos.end))) : e.shiftKey || opts.insertModeVisual && !1 === opts.insertMode && (k === keyCode.RIGHT ? setTimeout(function () {
            var caretPos = caret(input);
            caret(input, caretPos.begin);
          }, 0) : k === keyCode.LEFT && setTimeout(function () {
            var caretPos_begin = translatePosition(input.inputmask.caretPos.begin),
                caretPos_end = translatePosition(input.inputmask.caretPos.end);
            caret(input, isRTL ? caretPos_begin + (caretPos_begin === maskset.maskLength ? 0 : 1) : caretPos_begin - (0 === caretPos_begin ? 0 : 1));
          }, 0));
          inputmask.ignorable = -1 !== $.inArray(k, opts.ignorables);
        },
        keypressEvent: function keypressEvent(e, checkval, writeOut, strict, ndx) {
          var input = this,
              $input = $(input),
              k = e.which || e.charCode || e.keyCode;
          if (!(!0 === checkval || e.ctrlKey && e.altKey) && (e.ctrlKey || e.metaKey || inputmask.ignorable)) return k === keyCode.ENTER && inputmask.undoValue !== getBuffer().join("") && (inputmask.undoValue = getBuffer().join(""), setTimeout(function () {
            $input.trigger("change");
          }, 0)), inputmask.skipInputEvent = !0, !0;

          if (k) {
            44 !== k && 46 !== k || 3 !== e.location || "" === opts.radixPoint || (k = opts.radixPoint.charCodeAt(0));
            var pos = checkval ? {
              begin: ndx,
              end: ndx
            } : caret(input),
                forwardPosition,
                c = String.fromCharCode(k);
            maskset.writeOutBuffer = !0;
            var valResult = isValid(pos, c, strict);

            if (!1 !== valResult && (resetMaskSet(!0), forwardPosition = void 0 !== valResult.caret ? valResult.caret : seekNext(valResult.pos.begin ? valResult.pos.begin : valResult.pos), maskset.p = forwardPosition), forwardPosition = opts.numericInput && void 0 === valResult.caret ? seekPrevious(forwardPosition) : forwardPosition, !1 !== writeOut && (setTimeout(function () {
              opts.onKeyValidation.call(input, k, valResult);
            }, 0), maskset.writeOutBuffer && !1 !== valResult)) {
              var buffer = getBuffer();
              writeBuffer(input, buffer, forwardPosition, e, !0 !== checkval);
            }

            if (e.preventDefault(), checkval) return !1 !== valResult && (valResult.forwardPosition = forwardPosition), valResult;
          }
        },
        pasteEvent: function pasteEvent(e) {
          var input = this,
              inputValue = this.inputmask._valueGet(!0),
              caretPos = caret(this),
              tempValue;

          isRTL && (tempValue = caretPos.end, caretPos.end = caretPos.begin, caretPos.begin = tempValue);
          var valueBeforeCaret = inputValue.substr(0, caretPos.begin),
              valueAfterCaret = inputValue.substr(caretPos.end, inputValue.length);
          if (valueBeforeCaret == (isRTL ? getBufferTemplate().slice().reverse() : getBufferTemplate()).slice(0, caretPos.begin).join("") && (valueBeforeCaret = ""), valueAfterCaret == (isRTL ? getBufferTemplate().slice().reverse() : getBufferTemplate()).slice(caretPos.end).join("") && (valueAfterCaret = ""), window.clipboardData && window.clipboardData.getData) inputValue = valueBeforeCaret + window.clipboardData.getData("Text") + valueAfterCaret;else {
            if (!e.clipboardData || !e.clipboardData.getData) return !0;
            inputValue = valueBeforeCaret + e.clipboardData.getData("text/plain") + valueAfterCaret;
          }
          var pasteValue = inputValue;

          if ($.isFunction(opts.onBeforePaste)) {
            if (pasteValue = opts.onBeforePaste.call(inputmask, inputValue, opts), !1 === pasteValue) return e.preventDefault();
            pasteValue = pasteValue || inputValue;
          }

          return checkVal(this, !0, !1, pasteValue.toString().split(""), e), e.preventDefault();
        },
        inputFallBackEvent: function inputFallBackEvent(e) {
          function ieMobileHandler(input, inputValue, caretPos) {
            if (iemobile) {
              var inputChar = inputValue.replace(getBuffer().join(""), "");

              if (1 === inputChar.length) {
                var iv = inputValue.split("");
                iv.splice(caretPos.begin, 0, inputChar), inputValue = iv.join("");
              }
            }

            return inputValue;
          }

          function analyseChanges(inputValue, buffer, caretPos) {
            for (var frontPart = inputValue.substr(0, caretPos.begin).split(""), backPart = inputValue.substr(caretPos.begin).split(""), frontBufferPart = buffer.substr(0, caretPos.begin).split(""), backBufferPart = buffer.substr(caretPos.begin).split(""), fpl = frontPart.length >= frontBufferPart.length ? frontPart.length : frontBufferPart.length, bpl = backPart.length >= backBufferPart.length ? backPart.length : backBufferPart.length, bl, i, action = "", data = [], marker = "~", placeholder; frontPart.length < fpl;) {
              frontPart.push("~");
            }

            for (; frontBufferPart.length < fpl;) {
              frontBufferPart.push("~");
            }

            for (; backPart.length < bpl;) {
              backPart.unshift("~");
            }

            for (; backBufferPart.length < bpl;) {
              backBufferPart.unshift("~");
            }

            var newBuffer = frontPart.concat(backPart),
                oldBuffer = frontBufferPart.concat(backBufferPart);

            for (i = 0, bl = newBuffer.length; i < bl; i++) {
              switch (placeholder = getPlaceholder(translatePosition(i)), action) {
                case "insertText":
                  oldBuffer[i - 1] === newBuffer[i] && caretPos.begin == newBuffer.length - 1 && data.push(newBuffer[i]), i = bl;
                  break;

                case "insertReplacementText":
                  "~" === newBuffer[i] ? caretPos.end++ : i = bl;
                  break;

                case "deleteContentBackward":
                  "~" === newBuffer[i] ? caretPos.end++ : i = bl;
                  break;

                default:
                  newBuffer[i] !== oldBuffer[i] && ("~" !== newBuffer[i + 1] && newBuffer[i + 1] !== placeholder && void 0 !== newBuffer[i + 1] || (oldBuffer[i] !== placeholder || "~" !== oldBuffer[i + 1]) && "~" !== oldBuffer[i] ? "~" === oldBuffer[i + 1] && oldBuffer[i] === newBuffer[i + 1] ? (action = "insertText", data.push(newBuffer[i]), caretPos.begin--, caretPos.end--) : newBuffer[i] !== placeholder && "~" !== newBuffer[i] && ("~" === newBuffer[i + 1] || oldBuffer[i] !== newBuffer[i] && oldBuffer[i + 1] === newBuffer[i + 1]) ? (action = "insertReplacementText", data.push(newBuffer[i]), caretPos.begin--) : "~" === newBuffer[i] ? (action = "deleteContentBackward", !isMask(translatePosition(i), !0) && oldBuffer[i] !== opts.radixPoint || caretPos.end++) : i = bl : (action = "insertText", data.push(newBuffer[i]), caretPos.begin--, caretPos.end--));
                  break;
              }
            }

            return {
              action: action,
              data: data,
              caret: caretPos
            };
          }

          var input = this,
              inputValue = input.inputmask._valueGet(!0),
              buffer = (isRTL ? getBuffer().slice().reverse() : getBuffer()).join(""),
              caretPos = caret(input, void 0, void 0, !0);

          if (buffer !== inputValue) {
            inputValue = ieMobileHandler(input, inputValue, caretPos);
            var changes = analyseChanges(inputValue, buffer, caretPos);

            switch ((input.inputmask.shadowRoot || document).activeElement !== input && input.focus(), writeBuffer(input, getBuffer()), caret(input, caretPos.begin, caretPos.end, !0), changes.action) {
              case "insertText":
              case "insertReplacementText":
                $.each(changes.data, function (ndx, entry) {
                  var keypress = new $.Event("keypress");
                  keypress.which = entry.charCodeAt(0), inputmask.ignorable = !1, EventHandlers.keypressEvent.call(input, keypress);
                }), setTimeout(function () {
                  inputmask.$el.trigger("keyup");
                }, 0);
                break;

              case "deleteContentBackward":
                var keydown = new $.Event("keydown");
                keydown.keyCode = keyCode.BACKSPACE, EventHandlers.keydownEvent.call(input, keydown);
                break;

              default:
                applyInputValue(input, inputValue);
                break;
            }

            e.preventDefault();
          }
        },
        compositionendEvent: function compositionendEvent(e) {
          inputmask.$el.trigger("input");
        },
        setValueEvent: function setValueEvent(e, argument_1, argument_2) {
          var input = this,
              value = e && e.detail ? e.detail[0] : argument_1;
          void 0 === value && (value = this.inputmask._valueGet(!0)), applyInputValue(this, value), (e.detail && void 0 !== e.detail[1] || void 0 !== argument_2) && caret(this, e.detail ? e.detail[1] : argument_2);
        },
        focusEvent: function focusEvent(e) {
          var input = this,
              nptValue = this.inputmask._valueGet();

          opts.showMaskOnFocus && nptValue !== getBuffer().join("") && writeBuffer(this, getBuffer(), seekNext(getLastValidPosition())), !0 !== opts.positionCaretOnTab || !1 !== inputmask.mouseEnter || isComplete(getBuffer()) && -1 !== getLastValidPosition() || EventHandlers.clickEvent.apply(this, [e, !0]), inputmask.undoValue = getBuffer().join("");
        },
        invalidEvent: function invalidEvent(e) {
          inputmask.validationEvent = !0;
        },
        mouseleaveEvent: function mouseleaveEvent() {
          var input = this;
          inputmask.mouseEnter = !1, opts.clearMaskOnLostFocus && (this.inputmask.shadowRoot || document).activeElement !== this && HandleNativePlaceholder(this, inputmask.originalPlaceholder);
        },
        clickEvent: function clickEvent(e, tabbed) {
          var input = this;

          if ((this.inputmask.shadowRoot || document).activeElement === this) {
            var newCaretPosition = determineNewCaretPosition(caret(this), tabbed);
            void 0 !== newCaretPosition && caret(this, newCaretPosition);
          }
        },
        cutEvent: function cutEvent(e) {
          var input = this,
              pos = caret(this),
              clipboardData = window.clipboardData || e.clipboardData,
              clipData = isRTL ? getBuffer().slice(pos.end, pos.begin) : getBuffer().slice(pos.begin, pos.end);
          clipboardData.setData("text", isRTL ? clipData.reverse().join("") : clipData.join("")), document.execCommand && document.execCommand("copy"), handleRemove(this, keyCode.DELETE, pos), writeBuffer(this, getBuffer(), maskset.p, e, inputmask.undoValue !== getBuffer().join(""));
        },
        blurEvent: function blurEvent(e) {
          var $input = $(this),
              input = this;

          if (this.inputmask) {
            HandleNativePlaceholder(this, inputmask.originalPlaceholder);

            var nptValue = this.inputmask._valueGet(),
                buffer = getBuffer().slice();

            "" !== nptValue && (opts.clearMaskOnLostFocus && (-1 === getLastValidPosition() && nptValue === getBufferTemplate().join("") ? buffer = [] : clearOptionalTail(buffer)), !1 === isComplete(buffer) && (setTimeout(function () {
              $input.trigger("incomplete");
            }, 0), opts.clearIncomplete && (resetMaskSet(), buffer = opts.clearMaskOnLostFocus ? [] : getBufferTemplate().slice())), writeBuffer(this, buffer, void 0, e)), inputmask.undoValue !== getBuffer().join("") && (inputmask.undoValue = getBuffer().join(""), $input.trigger("change"));
          }
        },
        mouseenterEvent: function mouseenterEvent() {
          var input = this;
          inputmask.mouseEnter = !0, (this.inputmask.shadowRoot || document).activeElement !== this && (null == inputmask.originalPlaceholder && this.placeholder !== inputmask.originalPlaceholder && (inputmask.originalPlaceholder = this.placeholder), opts.showMaskOnHover && HandleNativePlaceholder(this, (isRTL ? getBufferTemplate().slice().reverse() : getBufferTemplate()).join("")));
        },
        submitEvent: function submitEvent() {
          inputmask.undoValue !== getBuffer().join("") && inputmask.$el.trigger("change"), opts.clearMaskOnLostFocus && -1 === getLastValidPosition() && el.inputmask._valueGet && el.inputmask._valueGet() === getBufferTemplate().join("") && el.inputmask._valueSet(""), opts.clearIncomplete && !1 === isComplete(getBuffer()) && el.inputmask._valueSet(""), opts.removeMaskOnSubmit && (el.inputmask._valueSet(el.inputmask.unmaskedvalue(), !0), setTimeout(function () {
            writeBuffer(el, getBuffer());
          }, 0));
        },
        resetEvent: function resetEvent() {
          el.inputmask.refreshValue = !0, setTimeout(function () {
            applyInputValue(el, el.inputmask._valueGet(!0));
          }, 0);
        }
      },
          valueBuffer;

      function checkVal(input, writeOut, strict, nptvl, initiatingEvent) {
        var inputmask = this || input.inputmask,
            inputValue = nptvl.slice(),
            charCodes = "",
            initialNdx = -1,
            result = void 0;

        function isTemplateMatch(ndx, charCodes) {
          for (var targetTemplate = getMaskTemplate(!0, 0).slice(ndx, seekNext(ndx)).join("").replace(/'/g, ""), charCodeNdx = targetTemplate.indexOf(charCodes); 0 < charCodeNdx && " " === targetTemplate[charCodeNdx - 1];) {
            charCodeNdx--;
          }

          var match = 0 === charCodeNdx && !isMask(ndx) && (getTest(ndx).match.nativeDef === charCodes.charAt(0) || !0 === getTest(ndx).match["static"] && getTest(ndx).match.nativeDef === "'" + charCodes.charAt(0) || " " === getTest(ndx).match.nativeDef && (getTest(ndx + 1).match.nativeDef === charCodes.charAt(0) || !0 === getTest(ndx + 1).match["static"] && getTest(ndx + 1).match.nativeDef === "'" + charCodes.charAt(0)));

          if (!match && 0 < charCodeNdx && !isMask(ndx, !1, !0)) {
            var nextPos = seekNext(ndx);
            inputmask.caretPos.begin < nextPos && (inputmask.caretPos = {
              begin: nextPos
            });
          }

          return match;
        }

        resetMaskSet(), maskset.tests = {}, initialNdx = opts.radixPoint ? determineNewCaretPosition({
          begin: 0,
          end: 0
        }).begin : 0, maskset.p = initialNdx, inputmask.caretPos = {
          begin: initialNdx
        };
        var staticMatches = [],
            prevCaretPos = inputmask.caretPos;

        if ($.each(inputValue, function (ndx, charCode) {
          if (void 0 !== charCode) if (void 0 === maskset.validPositions[ndx] && inputValue[ndx] === getPlaceholder(ndx) && isMask(ndx, !0) && !1 === isValid(ndx, inputValue[ndx], !0, void 0, void 0, !0)) maskset.p++;else {
            var keypress = new $.Event("_checkval");
            keypress.which = charCode.toString().charCodeAt(0), charCodes += charCode;
            var lvp = getLastValidPosition(void 0, !0);
            isTemplateMatch(initialNdx, charCodes) ? result = EventHandlers.keypressEvent.call(input, keypress, !0, !1, strict, lvp + 1) : (result = EventHandlers.keypressEvent.call(input, keypress, !0, !1, strict, inputmask.caretPos.begin), result && (initialNdx = inputmask.caretPos.begin + 1, charCodes = "")), result ? (void 0 !== result.pos && maskset.validPositions[result.pos] && !0 === maskset.validPositions[result.pos].match["static"] && void 0 === maskset.validPositions[result.pos].alternation && (staticMatches.push(result.pos), isRTL || (result.forwardPosition = result.pos + 1)), writeBuffer(void 0, getBuffer(), result.forwardPosition, keypress, !1), inputmask.caretPos = {
              begin: result.forwardPosition,
              end: result.forwardPosition
            }, prevCaretPos = inputmask.caretPos) : inputmask.caretPos = prevCaretPos;
          }
        }), 0 < staticMatches.length) {
          var sndx,
              validPos,
              nextValid = seekNext(-1, void 0, !1);
          if (!isComplete(getBuffer()) && staticMatches.length <= nextValid || isComplete(getBuffer()) && 0 < staticMatches.length && staticMatches.length !== nextValid && 0 === staticMatches[0]) for (var nextSndx = nextValid; void 0 !== (sndx = staticMatches.shift());) {
            var keypress = new $.Event("_checkval");
            if (validPos = maskset.validPositions[sndx], validPos.generatedInput = !0, keypress.which = validPos.input.charCodeAt(0), result = EventHandlers.keypressEvent.call(input, keypress, !0, !1, strict, nextSndx), result && void 0 !== result.pos && result.pos !== sndx && maskset.validPositions[result.pos] && !0 === maskset.validPositions[result.pos].match["static"]) staticMatches.push(result.pos);else if (!result) break;
            nextSndx++;
          } else for (; sndx = staticMatches.pop();) {
            validPos = maskset.validPositions[sndx], validPos && (validPos.generatedInput = !0);
          }
        }

        if (writeOut) for (var vndx in writeBuffer(input, getBuffer(), result ? result.forwardPosition : void 0, initiatingEvent || new $.Event("checkval"), initiatingEvent && "input" === initiatingEvent.type && inputmask.undoValue !== getBuffer().join("")), maskset.validPositions) {
          !0 !== maskset.validPositions[vndx].match.generated && delete maskset.validPositions[vndx].generatedInput;
        }
      }

      function unmaskedvalue(input) {
        if (input) {
          if (void 0 === input.inputmask) return input.value;
          input.inputmask && input.inputmask.refreshValue && applyInputValue(input, input.inputmask._valueGet(!0));
        }

        var umValue = [],
            vps = maskset.validPositions;

        for (var pndx in vps) {
          vps[pndx] && vps[pndx].match && (1 != vps[pndx].match["static"] || !0 !== vps[pndx].generatedInput) && umValue.push(vps[pndx].input);
        }

        var unmaskedValue = 0 === umValue.length ? "" : (isRTL ? umValue.reverse() : umValue).join("");

        if ($.isFunction(opts.onUnMask)) {
          var bufferValue = (isRTL ? getBuffer().slice().reverse() : getBuffer()).join("");
          unmaskedValue = opts.onUnMask.call(inputmask, bufferValue, unmaskedValue, opts);
        }

        return unmaskedValue;
      }

      function translatePosition(pos) {
        return !isRTL || "number" != typeof pos || opts.greedy && "" === opts.placeholder || !el || (pos = el.inputmask._valueGet().length - pos), pos;
      }

      function caret(input, begin, end, notranslate, isDelete) {
        var range;
        if (void 0 === begin) return "selectionStart" in input && "selectionEnd" in input ? (begin = input.selectionStart, end = input.selectionEnd) : window.getSelection ? (range = window.getSelection().getRangeAt(0), range.commonAncestorContainer.parentNode !== input && range.commonAncestorContainer !== input || (begin = range.startOffset, end = range.endOffset)) : document.selection && document.selection.createRange && (range = document.selection.createRange(), begin = 0 - range.duplicate().moveStart("character", -input.inputmask._valueGet().length), end = begin + range.text.length), {
          begin: notranslate ? begin : translatePosition(begin),
          end: notranslate ? end : translatePosition(end)
        };

        if ($.isArray(begin) && (end = isRTL ? begin[0] : begin[1], begin = isRTL ? begin[1] : begin[0]), void 0 !== begin.begin && (end = isRTL ? begin.begin : begin.end, begin = isRTL ? begin.end : begin.begin), "number" == typeof begin) {
          begin = notranslate ? begin : translatePosition(begin), end = notranslate ? end : translatePosition(end), end = "number" == typeof end ? end : begin;
          var scrollCalc = parseInt(((input.ownerDocument.defaultView || window).getComputedStyle ? (input.ownerDocument.defaultView || window).getComputedStyle(input, null) : input.currentStyle).fontSize) * end;
          if (input.scrollLeft = scrollCalc > input.scrollWidth ? scrollCalc : 0, input.inputmask.caretPos = {
            begin: begin,
            end: end
          }, opts.insertModeVisual && !1 === opts.insertMode && begin === end && (isDelete || end++), input === (input.inputmask.shadowRoot || document).activeElement) if ("setSelectionRange" in input) input.setSelectionRange(begin, end);else if (window.getSelection) {
            if (range = document.createRange(), void 0 === input.firstChild || null === input.firstChild) {
              var textNode = document.createTextNode("");
              input.appendChild(textNode);
            }

            range.setStart(input.firstChild, begin < input.inputmask._valueGet().length ? begin : input.inputmask._valueGet().length), range.setEnd(input.firstChild, end < input.inputmask._valueGet().length ? end : input.inputmask._valueGet().length), range.collapse(!0);
            var sel = window.getSelection();
            sel.removeAllRanges(), sel.addRange(range);
          } else input.createTextRange && (range = input.createTextRange(), range.collapse(!0), range.moveEnd("character", end), range.moveStart("character", begin), range.select());
        }
      }

      function determineLastRequiredPosition(returnDefinition) {
        var buffer = getMaskTemplate(!0, getLastValidPosition(), !0, !0),
            bl = buffer.length,
            pos,
            lvp = getLastValidPosition(),
            positions = {},
            lvTest = maskset.validPositions[lvp],
            ndxIntlzr = void 0 !== lvTest ? lvTest.locator.slice() : void 0,
            testPos;

        for (pos = lvp + 1; pos < buffer.length; pos++) {
          testPos = getTestTemplate(pos, ndxIntlzr, pos - 1), ndxIntlzr = testPos.locator.slice(), positions[pos] = $.extend(!0, {}, testPos);
        }

        var lvTestAlt = lvTest && void 0 !== lvTest.alternation ? lvTest.locator[lvTest.alternation] : void 0;

        for (pos = bl - 1; lvp < pos && (testPos = positions[pos], (testPos.match.optionality || testPos.match.optionalQuantifier && testPos.match.newBlockMarker || lvTestAlt && (lvTestAlt !== positions[pos].locator[lvTest.alternation] && 1 != testPos.match["static"] || !0 === testPos.match["static"] && testPos.locator[lvTest.alternation] && checkAlternationMatch(testPos.locator[lvTest.alternation].toString().split(","), lvTestAlt.toString().split(",")) && "" !== getTests(pos)[0].def)) && buffer[pos] === getPlaceholder(pos, testPos.match)); pos--) {
          bl--;
        }

        return returnDefinition ? {
          l: bl,
          def: positions[bl] ? positions[bl].match : void 0
        } : bl;
      }

      function clearOptionalTail(buffer) {
        buffer.length = 0;

        for (var template = getMaskTemplate(!0, 0, !0, void 0, !0), lmnt; void 0 !== (lmnt = template.shift());) {
          buffer.push(lmnt);
        }

        return buffer;
      }

      function isComplete(buffer) {
        if ($.isFunction(opts.isComplete)) return opts.isComplete(buffer, opts);

        if ("*" !== opts.repeat) {
          var complete = !1,
              lrp = determineLastRequiredPosition(!0),
              aml = seekPrevious(lrp.l);

          if (void 0 === lrp.def || lrp.def.newBlockMarker || lrp.def.optionality || lrp.def.optionalQuantifier) {
            complete = !0;

            for (var i = 0; i <= aml; i++) {
              var test = getTestTemplate(i).match;

              if (!0 !== test["static"] && void 0 === maskset.validPositions[i] && !0 !== test.optionality && !0 !== test.optionalQuantifier || !0 === test["static"] && buffer[i] !== getPlaceholder(i, test)) {
                complete = !1;
                break;
              }
            }
          }

          return complete;
        }
      }

      function handleRemove(input, k, pos, strict, fromIsValid) {
        if ((opts.numericInput || isRTL) && (k === keyCode.BACKSPACE ? k = keyCode.DELETE : k === keyCode.DELETE && (k = keyCode.BACKSPACE), isRTL)) {
          var pend = pos.end;
          pos.end = pos.begin, pos.begin = pend;
        }

        var lvp = getLastValidPosition(void 0, !0),
            offset;

        if (pos.end >= getBuffer().length && lvp >= pos.end && (pos.end = lvp + 1), k === keyCode.BACKSPACE ? pos.end - pos.begin < 1 && (pos.begin = seekPrevious(pos.begin)) : k === keyCode.DELETE && pos.begin === pos.end && (pos.end = isMask(pos.end, !0, !0) ? pos.end + 1 : seekNext(pos.end) + 1), !1 !== (offset = revalidateMask(pos))) {
          if (!0 !== strict && !1 !== opts.keepStatic || null !== opts.regex && -1 !== getTest(pos.begin).match.def.indexOf("|")) {
            var result = alternate(!0);

            if (result) {
              var newPos = void 0 !== result.caret ? result.caret : result.pos ? seekNext(result.pos.begin ? result.pos.begin : result.pos) : getLastValidPosition(-1, !0);
              (k !== keyCode.DELETE || pos.begin > newPos) && pos.begin;
            }
          }

          !0 !== strict && (maskset.p = k === keyCode.DELETE ? pos.begin + offset : pos.begin);
        }
      }

      function applyInputValue(input, value) {
        input.inputmask.refreshValue = !1, $.isFunction(opts.onBeforeMask) && (value = opts.onBeforeMask.call(inputmask, value, opts) || value), value = value.toString().split(""), checkVal(input, !0, !1, value), inputmask.undoValue = getBuffer().join(""), (opts.clearMaskOnLostFocus || opts.clearIncomplete) && input.inputmask._valueGet() === getBufferTemplate().join("") && -1 === getLastValidPosition() && input.inputmask._valueSet("");
      }

      function mask() {
        function isElementTypeSupported(input, opts) {
          function patchValueProperty(npt) {
            var valueGet, valueSet;

            function patchValhook(type) {
              if ($.valHooks && (void 0 === $.valHooks[type] || !0 !== $.valHooks[type].inputmaskpatch)) {
                var valhookGet = $.valHooks[type] && $.valHooks[type].get ? $.valHooks[type].get : function (elem) {
                  return elem.value;
                },
                    valhookSet = $.valHooks[type] && $.valHooks[type].set ? $.valHooks[type].set : function (elem, value) {
                  return elem.value = value, elem;
                };
                $.valHooks[type] = {
                  get: function get(elem) {
                    if (elem.inputmask) {
                      if (elem.inputmask.opts.autoUnmask) return elem.inputmask.unmaskedvalue();
                      var result = valhookGet(elem);
                      return -1 !== getLastValidPosition(void 0, void 0, elem.inputmask.maskset.validPositions) || !0 !== opts.nullable ? result : "";
                    }

                    return valhookGet(elem);
                  },
                  set: function set(elem, value) {
                    var result = valhookSet(elem, value);
                    return elem.inputmask && applyInputValue(elem, value), result;
                  },
                  inputmaskpatch: !0
                };
              }
            }

            function getter() {
              return this.inputmask ? this.inputmask.opts.autoUnmask ? this.inputmask.unmaskedvalue() : -1 !== getLastValidPosition() || !0 !== opts.nullable ? (this.inputmask.shadowRoot || document.activeElement) === this && opts.clearMaskOnLostFocus ? (isRTL ? clearOptionalTail(getBuffer().slice()).reverse() : clearOptionalTail(getBuffer().slice())).join("") : valueGet.call(this) : "" : valueGet.call(this);
            }

            function setter(value) {
              valueSet.call(this, value), this.inputmask && applyInputValue(this, value);
            }

            function installNativeValueSetFallback(npt) {
              EventRuler.on(npt, "mouseenter", function () {
                var input = this,
                    value = this.inputmask._valueGet(!0);

                value !== (isRTL ? getBuffer().reverse() : getBuffer()).join("") && applyInputValue(this, value);
              });
            }

            if (!npt.inputmask.__valueGet) {
              if (!0 !== opts.noValuePatching) {
                if (Object.getOwnPropertyDescriptor) {
                  var valueProperty = Object.getPrototypeOf ? Object.getOwnPropertyDescriptor(Object.getPrototypeOf(npt), "value") : void 0;
                  valueProperty && valueProperty.get && valueProperty.set ? (valueGet = valueProperty.get, valueSet = valueProperty.set, Object.defineProperty(npt, "value", {
                    get: getter,
                    set: setter,
                    configurable: !0
                  })) : "input" !== npt.tagName.toLowerCase() && (valueGet = function valueGet() {
                    return this.textContent;
                  }, valueSet = function valueSet(value) {
                    this.textContent = value;
                  }, Object.defineProperty(npt, "value", {
                    get: getter,
                    set: setter,
                    configurable: !0
                  }));
                } else document.__lookupGetter__ && npt.__lookupGetter__("value") && (valueGet = npt.__lookupGetter__("value"), valueSet = npt.__lookupSetter__("value"), npt.__defineGetter__("value", getter), npt.__defineSetter__("value", setter));

                npt.inputmask.__valueGet = valueGet, npt.inputmask.__valueSet = valueSet;
              }

              npt.inputmask._valueGet = function (overruleRTL) {
                return isRTL && !0 !== overruleRTL ? valueGet.call(this.el).split("").reverse().join("") : valueGet.call(this.el);
              }, npt.inputmask._valueSet = function (value, overruleRTL) {
                valueSet.call(this.el, null == value ? "" : !0 !== overruleRTL && isRTL ? value.split("").reverse().join("") : value);
              }, void 0 === valueGet && (valueGet = function valueGet() {
                return this.value;
              }, valueSet = function valueSet(value) {
                this.value = value;
              }, patchValhook(npt.type), installNativeValueSetFallback(npt));
            }
          }

          "textarea" !== input.tagName.toLowerCase() && opts.ignorables.push(keyCode.ENTER);
          var elementType = input.getAttribute("type"),
              isSupported = "input" === input.tagName.toLowerCase() && -1 !== $.inArray(elementType, opts.supportsInputType) || input.isContentEditable || "textarea" === input.tagName.toLowerCase();
          if (!isSupported) if ("input" === input.tagName.toLowerCase()) {
            var el = document.createElement("input");
            el.setAttribute("type", elementType), isSupported = "text" === el.type, el = null;
          } else isSupported = "partial";
          return !1 !== isSupported ? patchValueProperty(input) : input.inputmask = void 0, isSupported;
        }

        EventRuler.off(el);
        var isSupported = isElementTypeSupported(el, opts);

        if (!1 !== isSupported) {
          inputmask.originalPlaceholder = el.placeholder, inputmask.maxLength = void 0 !== el ? el.maxLength : void 0, -1 === inputmask.maxLength && (inputmask.maxLength = void 0), "inputMode" in el && null === el.getAttribute("inputmode") && (el.inputMode = opts.inputmode, el.setAttribute("inputmode", opts.inputmode)), !0 === isSupported && (opts.showMaskOnFocus = opts.showMaskOnFocus && -1 === ["cc-number", "cc-exp"].indexOf(el.autocomplete), iphone && (opts.insertModeVisual = !1), EventRuler.on(el, "submit", EventHandlers.submitEvent), EventRuler.on(el, "reset", EventHandlers.resetEvent), EventRuler.on(el, "blur", EventHandlers.blurEvent), EventRuler.on(el, "focus", EventHandlers.focusEvent), EventRuler.on(el, "invalid", EventHandlers.invalidEvent), EventRuler.on(el, "click", EventHandlers.clickEvent), EventRuler.on(el, "mouseleave", EventHandlers.mouseleaveEvent), EventRuler.on(el, "mouseenter", EventHandlers.mouseenterEvent), EventRuler.on(el, "paste", EventHandlers.pasteEvent), EventRuler.on(el, "cut", EventHandlers.cutEvent), EventRuler.on(el, "complete", opts.oncomplete), EventRuler.on(el, "incomplete", opts.onincomplete), EventRuler.on(el, "cleared", opts.oncleared), mobile || !0 === opts.inputEventOnly ? el.removeAttribute("maxLength") : (EventRuler.on(el, "keydown", EventHandlers.keydownEvent), EventRuler.on(el, "keypress", EventHandlers.keypressEvent)), EventRuler.on(el, "input", EventHandlers.inputFallBackEvent), EventRuler.on(el, "compositionend", EventHandlers.compositionendEvent)), EventRuler.on(el, "setvalue", EventHandlers.setValueEvent), inputmask.undoValue = getBufferTemplate().join("");
          var activeElement = (el.inputmask.shadowRoot || document).activeElement;

          if ("" !== el.inputmask._valueGet(!0) || !1 === opts.clearMaskOnLostFocus || activeElement === el) {
            applyInputValue(el, el.inputmask._valueGet(!0), opts);
            var buffer = getBuffer().slice();
            !1 === isComplete(buffer) && opts.clearIncomplete && resetMaskSet(), opts.clearMaskOnLostFocus && activeElement !== el && (-1 === getLastValidPosition() ? buffer = [] : clearOptionalTail(buffer)), (!1 === opts.clearMaskOnLostFocus || opts.showMaskOnFocus && activeElement === el || "" !== el.inputmask._valueGet(!0)) && writeBuffer(el, buffer), activeElement === el && caret(el, seekNext(getLastValidPosition()));
          }
        }
      }

      if (void 0 !== actionObj) switch (actionObj.action) {
        case "isComplete":
          return el = actionObj.el, isComplete(getBuffer());

        case "unmaskedvalue":
          return void 0 !== el && void 0 === actionObj.value || (valueBuffer = actionObj.value, valueBuffer = ($.isFunction(opts.onBeforeMask) && opts.onBeforeMask.call(inputmask, valueBuffer, opts) || valueBuffer).split(""), checkVal.call(this, void 0, !1, !1, valueBuffer), $.isFunction(opts.onBeforeWrite) && opts.onBeforeWrite.call(inputmask, void 0, getBuffer(), 0, opts)), unmaskedvalue(el);

        case "mask":
          mask();
          break;

        case "format":
          return valueBuffer = ($.isFunction(opts.onBeforeMask) && opts.onBeforeMask.call(inputmask, actionObj.value, opts) || actionObj.value).split(""), checkVal.call(this, void 0, !0, !1, valueBuffer), actionObj.metadata ? {
            value: isRTL ? getBuffer().slice().reverse().join("") : getBuffer().join(""),
            metadata: maskScope.call(this, {
              action: "getmetadata"
            }, maskset, opts)
          } : isRTL ? getBuffer().slice().reverse().join("") : getBuffer().join("");

        case "isValid":
          actionObj.value ? (valueBuffer = ($.isFunction(opts.onBeforeMask) && opts.onBeforeMask.call(inputmask, actionObj.value, opts) || actionObj.value).split(""), checkVal.call(this, void 0, !0, !1, valueBuffer)) : actionObj.value = isRTL ? getBuffer().slice().reverse().join("") : getBuffer().join("");

          for (var buffer = getBuffer(), rl = determineLastRequiredPosition(), lmib = buffer.length - 1; rl < lmib && !isMask(lmib); lmib--) {
            ;
          }

          return buffer.splice(rl, lmib + 1 - rl), isComplete(buffer) && actionObj.value === (isRTL ? getBuffer().slice().reverse().join("") : getBuffer().join(""));

        case "getemptymask":
          return getBufferTemplate().join("");

        case "remove":
          if (el && el.inputmask) {
            $.data(el, "_inputmask_opts", null);
            var cv = opts.autoUnmask ? unmaskedvalue(el) : el.inputmask._valueGet(opts.autoUnmask),
                valueProperty;
            cv !== getBufferTemplate().join("") ? el.inputmask._valueSet(cv, opts.autoUnmask) : el.inputmask._valueSet(""), EventRuler.off(el), Object.getOwnPropertyDescriptor && Object.getPrototypeOf ? (valueProperty = Object.getOwnPropertyDescriptor(Object.getPrototypeOf(el), "value"), valueProperty && el.inputmask.__valueGet && Object.defineProperty(el, "value", {
              get: el.inputmask.__valueGet,
              set: el.inputmask.__valueSet,
              configurable: !0
            })) : document.__lookupGetter__ && el.__lookupGetter__("value") && el.inputmask.__valueGet && (el.__defineGetter__("value", el.inputmask.__valueGet), el.__defineSetter__("value", el.inputmask.__valueSet)), el.inputmask = void 0;
          }

          return el;

        case "getmetadata":
          if ($.isArray(maskset.metadata)) {
            var maskTarget = getMaskTemplate(!0, 0, !1).join("");
            return $.each(maskset.metadata, function (ndx, mtdt) {
              if (mtdt.mask === maskTarget) return maskTarget = mtdt, !1;
            }), maskTarget;
          }

          return maskset.metadata;
      }
    };
  }, function (module, exports, __webpack_require__) {
    "use strict";

    function _typeof(obj) {
      return _typeof = "function" == typeof Symbol && "symbol" == _typeof2(Symbol.iterator) ? function _typeof(obj) {
        return _typeof2(obj);
      } : function _typeof(obj) {
        return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
      }, _typeof(obj);
    }

    "function" != typeof Object.getPrototypeOf && (Object.getPrototypeOf = "object" === _typeof("test".__proto__) ? function (object) {
      return object.__proto__;
    } : function (object) {
      return object.constructor.prototype;
    });
  }, function (module, exports, __nested_webpack_require_118854__) {
    "use strict";

    function _typeof(obj) {
      return _typeof = "function" == typeof Symbol && "symbol" == _typeof2(Symbol.iterator) ? function _typeof(obj) {
        return _typeof2(obj);
      } : function _typeof(obj) {
        return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
      }, _typeof(obj);
    }

    var Inputmask = __nested_webpack_require_118854__(1),
        $ = Inputmask.dependencyLib,
        keyCode = __nested_webpack_require_118854__(0),
        formatCode = {
      d: ["[1-9]|[12][0-9]|3[01]", Date.prototype.setDate, "day", Date.prototype.getDate],
      dd: ["0[1-9]|[12][0-9]|3[01]", Date.prototype.setDate, "day", function () {
        return pad(Date.prototype.getDate.call(this), 2);
      }],
      ddd: [""],
      dddd: [""],
      m: ["[1-9]|1[012]", Date.prototype.setMonth, "month", function () {
        return Date.prototype.getMonth.call(this) + 1;
      }],
      mm: ["0[1-9]|1[012]", Date.prototype.setMonth, "month", function () {
        return pad(Date.prototype.getMonth.call(this) + 1, 2);
      }],
      mmm: [""],
      mmmm: [""],
      yy: ["[0-9]{2}", Date.prototype.setFullYear, "year", function () {
        return pad(Date.prototype.getFullYear.call(this), 2);
      }],
      yyyy: ["[0-9]{4}", Date.prototype.setFullYear, "year", function () {
        return pad(Date.prototype.getFullYear.call(this), 4);
      }],
      h: ["[1-9]|1[0-2]", Date.prototype.setHours, "hours", Date.prototype.getHours],
      hh: ["0[1-9]|1[0-2]", Date.prototype.setHours, "hours", function () {
        return pad(Date.prototype.getHours.call(this), 2);
      }],
      hx: [function (x) {
        return "[0-9]{".concat(x, "}");
      }, Date.prototype.setHours, "hours", function (x) {
        return Date.prototype.getHours;
      }],
      H: ["1?[0-9]|2[0-3]", Date.prototype.setHours, "hours", Date.prototype.getHours],
      HH: ["0[0-9]|1[0-9]|2[0-3]", Date.prototype.setHours, "hours", function () {
        return pad(Date.prototype.getHours.call(this), 2);
      }],
      Hx: [function (x) {
        return "[0-9]{".concat(x, "}");
      }, Date.prototype.setHours, "hours", function (x) {
        return function () {
          return pad(Date.prototype.getHours.call(this), x);
        };
      }],
      M: ["[1-5]?[0-9]", Date.prototype.setMinutes, "minutes", Date.prototype.getMinutes],
      MM: ["0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]", Date.prototype.setMinutes, "minutes", function () {
        return pad(Date.prototype.getMinutes.call(this), 2);
      }],
      s: ["[1-5]?[0-9]", Date.prototype.setSeconds, "seconds", Date.prototype.getSeconds],
      ss: ["0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]", Date.prototype.setSeconds, "seconds", function () {
        return pad(Date.prototype.getSeconds.call(this), 2);
      }],
      l: ["[0-9]{3}", Date.prototype.setMilliseconds, "milliseconds", function () {
        return pad(Date.prototype.getMilliseconds.call(this), 3);
      }],
      L: ["[0-9]{2}", Date.prototype.setMilliseconds, "milliseconds", function () {
        return pad(Date.prototype.getMilliseconds.call(this), 2);
      }],
      t: ["[ap]"],
      tt: ["[ap]m"],
      T: ["[AP]"],
      TT: ["[AP]M"],
      Z: [""],
      o: [""],
      S: [""]
    },
        formatAlias = {
      isoDate: "yyyy-mm-dd",
      isoTime: "HH:MM:ss",
      isoDateTime: "yyyy-mm-dd'T'HH:MM:ss",
      isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
    };

    function formatcode(match) {
      var dynMatches = new RegExp("\\d+$").exec(match[0]);

      if (dynMatches && void 0 !== dynMatches[0]) {
        var fcode = formatCode[match[0][0] + "x"].slice("");
        return fcode[0] = fcode[0](dynMatches[0]), fcode[3] = fcode[3](dynMatches[0]), fcode;
      }

      if (formatCode[match[0]]) return formatCode[match[0]];
    }

    function getTokenizer(opts) {
      if (!opts.tokenizer) {
        var tokens = [],
            dyntokens = [];

        for (var ndx in formatCode) {
          if (/\.*x$/.test(ndx)) {
            var dynToken = ndx[0] + "\\d+";
            -1 === dyntokens.indexOf(dynToken) && dyntokens.push(dynToken);
          } else -1 === tokens.indexOf(ndx[0]) && tokens.push(ndx[0]);
        }

        opts.tokenizer = "(" + (0 < dyntokens.length ? dyntokens.join("|") + "|" : "") + tokens.join("+|") + ")+?|.", opts.tokenizer = new RegExp(opts.tokenizer, "g");
      }

      return opts.tokenizer;
    }

    function isValidDate(dateParts, currentResult) {
      return (!isFinite(dateParts.rawday) || "29" == dateParts.day && !isFinite(dateParts.rawyear) || new Date(dateParts.date.getFullYear(), isFinite(dateParts.rawmonth) ? dateParts.month : dateParts.date.getMonth() + 1, 0).getDate() >= dateParts.day) && currentResult;
    }

    function isDateInRange(dateParts, opts) {
      var result = !0;

      if (opts.min) {
        if (dateParts.rawyear) {
          var rawYear = dateParts.rawyear.replace(/[^0-9]/g, ""),
              minYear = opts.min.year.substr(0, rawYear.length);
          result = minYear <= rawYear;
        }

        dateParts.year === dateParts.rawyear && opts.min.date.getTime() == opts.min.date.getTime() && (result = opts.min.date.getTime() <= dateParts.date.getTime());
      }

      return result && opts.max && opts.max.date.getTime() == opts.max.date.getTime() && (result = opts.max.date.getTime() >= dateParts.date.getTime()), result;
    }

    function parse(format, dateObjValue, opts, raw) {
      var mask = "",
          match,
          fcode;

      for (getTokenizer(opts).lastIndex = 0; match = getTokenizer(opts).exec(format);) {
        if (void 0 === dateObjValue) {
          if (fcode = formatcode(match)) mask += "(" + fcode[0] + ")";else switch (match[0]) {
            case "[":
              mask += "(";
              break;

            case "]":
              mask += ")?";
              break;

            default:
              mask += Inputmask.escapeRegex(match[0]);
          }
        } else if (fcode = formatcode(match)) {
          if (!0 !== raw && fcode[3]) {
            var getFn = fcode[3];
            mask += getFn.call(dateObjValue.date);
          } else fcode[2] ? mask += dateObjValue["raw" + fcode[2]] : mask += match[0];
        } else mask += match[0];
      }

      return mask;
    }

    function pad(val, len) {
      for (val = String(val), len = len || 2; val.length < len;) {
        val = "0" + val;
      }

      return val;
    }

    function analyseMask(maskString, format, opts) {
      var dateObj = {
        date: new Date(1, 0, 1)
      },
          targetProp,
          mask = maskString,
          match,
          dateOperation;

      function extendProperty(value) {
        var correctedValue = value.replace(/[^0-9]/g, "0");
        return correctedValue;
      }

      function setValue(dateObj, value, opts) {
        dateObj[targetProp] = extendProperty(value), dateObj["raw" + targetProp] = value, void 0 !== dateOperation && dateOperation.call(dateObj.date, "month" == targetProp ? parseInt(dateObj[targetProp]) - 1 : dateObj[targetProp]);
      }

      if ("string" == typeof mask) {
        for (getTokenizer(opts).lastIndex = 0; match = getTokenizer(opts).exec(format);) {
          var value = mask.slice(0, match[0].length);
          formatCode.hasOwnProperty(match[0]) && (targetProp = formatCode[match[0]][2], dateOperation = formatCode[match[0]][1], setValue(dateObj, value, opts)), mask = mask.slice(value.length);
        }

        return dateObj;
      }

      if (mask && "object" === _typeof(mask) && mask.hasOwnProperty("date")) return mask;
    }

    function importDate(dateObj, opts) {
      var match,
          date = "";

      for (getTokenizer(opts).lastIndex = 0; match = getTokenizer(opts).exec(opts.inputFormat);) {
        "d" === match[0].charAt(0) ? date += pad(dateObj.getDate(), match[0].length) : "m" === match[0].charAt(0) ? date += pad(dateObj.getMonth() + 1, match[0].length) : "yyyy" === match[0] ? date += dateObj.getFullYear().toString() : "y" === match[0].charAt(0) && (date += pad(dateObj.getYear(), match[0].length));
      }

      return date;
    }

    function getTokenMatch(pos, opts) {
      var calcPos = 0,
          targetMatch,
          match,
          matchLength = 0;

      for (getTokenizer(opts).lastIndex = 0; match = getTokenizer(opts).exec(opts.inputFormat);) {
        var dynMatches = new RegExp("\\d+$").exec(match[0]);

        if (matchLength = dynMatches ? parseInt(dynMatches[0]) : match[0].length, calcPos += matchLength, pos <= calcPos) {
          targetMatch = match, match = getTokenizer(opts).exec(opts.inputFormat);
          break;
        }
      }

      return {
        targetMatchIndex: calcPos - matchLength,
        nextMatch: match,
        targetMatch: targetMatch
      };
    }

    Inputmask.extendAliases({
      datetime: {
        mask: function mask(opts) {
          return opts.numericInput = !1, formatCode.S = opts.i18n.ordinalSuffix.join("|"), opts.inputFormat = formatAlias[opts.inputFormat] || opts.inputFormat, opts.displayFormat = formatAlias[opts.displayFormat] || opts.displayFormat || opts.inputFormat, opts.outputFormat = formatAlias[opts.outputFormat] || opts.outputFormat || opts.inputFormat, opts.placeholder = "" !== opts.placeholder ? opts.placeholder : opts.inputFormat.replace(/[[\]]/, ""), opts.regex = parse(opts.inputFormat, void 0, opts), opts.min = analyseMask(opts.min, opts.inputFormat, opts), opts.max = analyseMask(opts.max, opts.inputFormat, opts), null;
        },
        placeholder: "",
        inputFormat: "isoDateTime",
        displayFormat: void 0,
        outputFormat: void 0,
        min: null,
        max: null,
        skipOptionalPartCharacter: "",
        i18n: {
          dayNames: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
          monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
          ordinalSuffix: ["st", "nd", "rd", "th"]
        },
        preValidation: function preValidation(buffer, pos, c, isSelection, opts, maskset, caretPos, strict) {
          if (strict) return !0;

          if (isNaN(c) && buffer[pos] !== c) {
            var tokenMatch = getTokenMatch(pos, opts);

            if (tokenMatch.nextMatch && tokenMatch.nextMatch[0] === c && 1 < tokenMatch.targetMatch[0].length) {
              var validator = formatCode[tokenMatch.targetMatch[0]][0];
              if (new RegExp(validator).test("0" + buffer[pos - 1])) return buffer[pos] = buffer[pos - 1], buffer[pos - 1] = "0", {
                fuzzy: !0,
                buffer: buffer,
                refreshFromBuffer: {
                  start: pos - 1,
                  end: pos + 1
                },
                pos: pos + 1
              };
            }
          }

          return !0;
        },
        postValidation: function postValidation(buffer, pos, c, currentResult, opts, maskset, strict) {
          if (strict) return !0;
          var tokenMatch, validator;
          if (!1 === currentResult) return tokenMatch = getTokenMatch(pos + 1, opts), tokenMatch.targetMatch && tokenMatch.targetMatchIndex === pos && 1 < tokenMatch.targetMatch[0].length && void 0 !== formatCode[tokenMatch.targetMatch[0]] && (validator = formatCode[tokenMatch.targetMatch[0]][0], new RegExp(validator).test("0" + c)) ? {
            insert: [{
              pos: pos,
              c: "0"
            }, {
              pos: pos + 1,
              c: c
            }],
            pos: pos + 1
          } : currentResult;

          if (currentResult.fuzzy && (buffer = currentResult.buffer, pos = currentResult.pos), tokenMatch = getTokenMatch(pos, opts), tokenMatch.targetMatch && tokenMatch.targetMatch[0] && void 0 !== formatCode[tokenMatch.targetMatch[0]]) {
            validator = formatCode[tokenMatch.targetMatch[0]][0];
            var part = buffer.slice(tokenMatch.targetMatchIndex, tokenMatch.targetMatchIndex + tokenMatch.targetMatch[0].length);
            !1 === new RegExp(validator).test(part.join("")) && 2 === tokenMatch.targetMatch[0].length && maskset.validPositions[tokenMatch.targetMatchIndex] && maskset.validPositions[tokenMatch.targetMatchIndex + 1] && (maskset.validPositions[tokenMatch.targetMatchIndex + 1].input = "0");
          }

          var result = currentResult,
              dateParts = analyseMask(buffer.join(""), opts.inputFormat, opts);
          return result && dateParts.date.getTime() == dateParts.date.getTime() && (result = isValidDate(dateParts, result), result = result && isDateInRange(dateParts, opts)), pos && result && currentResult.pos !== pos ? {
            buffer: parse(opts.inputFormat, dateParts, opts).split(""),
            refreshFromBuffer: {
              start: pos,
              end: currentResult.pos
            }
          } : result;
        },
        onKeyDown: function onKeyDown(e, buffer, caretPos, opts) {
          var input = this;
          e.ctrlKey && e.keyCode === keyCode.RIGHT && (this.inputmask._valueSet(importDate(new Date(), opts)), $(this).trigger("setvalue"));
        },
        onUnMask: function onUnMask(maskedValue, unmaskedValue, opts) {
          return unmaskedValue ? parse(opts.outputFormat, analyseMask(maskedValue, opts.inputFormat, opts), opts, !0) : unmaskedValue;
        },
        casing: function casing(elem, test, pos, validPositions) {
          return 0 == test.nativeDef.indexOf("[ap]") ? elem.toLowerCase() : 0 == test.nativeDef.indexOf("[AP]") ? elem.toUpperCase() : elem;
        },
        onBeforeMask: function onBeforeMask(initialValue, opts) {
          return "[object Date]" === Object.prototype.toString.call(initialValue) && (initialValue = importDate(initialValue, opts)), initialValue;
        },
        insertMode: !1,
        shiftPositions: !1,
        keepStatic: !1,
        inputmode: "numeric"
      }
    }), module.exports = Inputmask;
  }, function (module, exports, __nested_webpack_require_133064__) {
    "use strict";

    var Inputmask = __nested_webpack_require_133064__(1),
        $ = Inputmask.dependencyLib,
        keyCode = __nested_webpack_require_133064__(0);

    function autoEscape(txt, opts) {
      for (var escapedTxt = "", i = 0; i < txt.length; i++) {
        Inputmask.prototype.definitions[txt.charAt(i)] || opts.definitions[txt.charAt(i)] || opts.optionalmarker[0] === txt.charAt(i) || opts.optionalmarker[1] === txt.charAt(i) || opts.quantifiermarker[0] === txt.charAt(i) || opts.quantifiermarker[1] === txt.charAt(i) || opts.groupmarker[0] === txt.charAt(i) || opts.groupmarker[1] === txt.charAt(i) || opts.alternatormarker === txt.charAt(i) ? escapedTxt += "\\" + txt.charAt(i) : escapedTxt += txt.charAt(i);
      }

      return escapedTxt;
    }

    function alignDigits(buffer, digits, opts, force) {
      if (0 < buffer.length && 0 < digits && (!opts.digitsOptional || force)) {
        var radixPosition = $.inArray(opts.radixPoint, buffer);
        -1 === radixPosition && (buffer.push(opts.radixPoint), radixPosition = buffer.length - 1);

        for (var i = 1; i <= digits; i++) {
          isFinite(buffer[radixPosition + i]) || (buffer[radixPosition + i] = "0");
        }
      }

      return buffer;
    }

    function findValidator(symbol, maskset) {
      var posNdx = 0;

      if ("+" === symbol) {
        for (posNdx in maskset.validPositions) {
          ;
        }

        posNdx = parseInt(posNdx);
      }

      for (var tstNdx in maskset.tests) {
        if (tstNdx = parseInt(tstNdx), posNdx <= tstNdx) for (var ndx = 0, ndxl = maskset.tests[tstNdx].length; ndx < ndxl; ndx++) {
          if ((void 0 === maskset.validPositions[tstNdx] || "-" === symbol) && maskset.tests[tstNdx][ndx].match.def === symbol) return tstNdx + (void 0 !== maskset.validPositions[tstNdx] && "-" !== symbol ? 1 : 0);
        }
      }

      return posNdx;
    }

    function findValid(symbol, maskset) {
      var ret = -1;
      return $.each(maskset.validPositions, function (ndx, tst) {
        if (tst && tst.match.def === symbol) return ret = parseInt(ndx), !1;
      }), ret;
    }

    function parseMinMaxOptions(opts) {
      void 0 === opts.parseMinMaxOptions && (null !== opts.min && (opts.min = opts.min.toString().replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator), "g"), ""), "," === opts.radixPoint && (opts.min = opts.min.replace(opts.radixPoint, ".")), opts.min = isFinite(opts.min) ? parseFloat(opts.min) : NaN, isNaN(opts.min) && (opts.min = Number.MIN_VALUE)), null !== opts.max && (opts.max = opts.max.toString().replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator), "g"), ""), "," === opts.radixPoint && (opts.max = opts.max.replace(opts.radixPoint, ".")), opts.max = isFinite(opts.max) ? parseFloat(opts.max) : NaN, isNaN(opts.max) && (opts.max = Number.MAX_VALUE)), opts.parseMinMaxOptions = "done");
    }

    function genMask(opts) {
      opts.repeat = 0, opts.groupSeparator === opts.radixPoint && opts.digits && "0" !== opts.digits && ("." === opts.radixPoint ? opts.groupSeparator = "," : "," === opts.radixPoint ? opts.groupSeparator = "." : opts.groupSeparator = ""), " " === opts.groupSeparator && (opts.skipOptionalPartCharacter = void 0), 1 < opts.placeholder.length && (opts.placeholder = opts.placeholder.charAt(0)), "radixFocus" === opts.positionCaretOnClick && "" === opts.placeholder && (opts.positionCaretOnClick = "lvp");
      var decimalDef = "0",
          radixPointDef = opts.radixPoint;
      !0 === opts.numericInput && void 0 === opts.__financeInput ? (decimalDef = "1", opts.positionCaretOnClick = "radixFocus" === opts.positionCaretOnClick ? "lvp" : opts.positionCaretOnClick, opts.digitsOptional = !1, isNaN(opts.digits) && (opts.digits = 2), opts._radixDance = !1, radixPointDef = "," === opts.radixPoint ? "?" : "!", "" !== opts.radixPoint && void 0 === opts.definitions[radixPointDef] && (opts.definitions[radixPointDef] = {}, opts.definitions[radixPointDef].validator = "[" + opts.radixPoint + "]", opts.definitions[radixPointDef].placeholder = opts.radixPoint, opts.definitions[radixPointDef]["static"] = !0, opts.definitions[radixPointDef].generated = !0)) : (opts.__financeInput = !1, opts.numericInput = !0);
      var mask = "[+]",
          altMask;

      if (mask += autoEscape(opts.prefix, opts), "" !== opts.groupSeparator ? (void 0 === opts.definitions[opts.groupSeparator] && (opts.definitions[opts.groupSeparator] = {}, opts.definitions[opts.groupSeparator].validator = "[" + opts.groupSeparator + "]", opts.definitions[opts.groupSeparator].placeholder = opts.groupSeparator, opts.definitions[opts.groupSeparator]["static"] = !0, opts.definitions[opts.groupSeparator].generated = !0), mask += opts._mask(opts)) : mask += "9{+}", void 0 !== opts.digits && 0 !== opts.digits) {
        var dq = opts.digits.toString().split(",");
        isFinite(dq[0]) && dq[1] && isFinite(dq[1]) ? mask += radixPointDef + decimalDef + "{" + opts.digits + "}" : (isNaN(opts.digits) || 0 < parseInt(opts.digits)) && (opts.digitsOptional ? (altMask = mask + radixPointDef + decimalDef + "{0," + opts.digits + "}", opts.keepStatic = !0) : mask += radixPointDef + decimalDef + "{" + opts.digits + "}");
      }

      return mask += autoEscape(opts.suffix, opts), mask += "[-]", altMask && (mask = [altMask + autoEscape(opts.suffix, opts) + "[-]", mask]), opts.greedy = !1, parseMinMaxOptions(opts), mask;
    }

    function hanndleRadixDance(pos, c, radixPos, maskset, opts) {
      return opts._radixDance && opts.numericInput && c !== opts.negationSymbol.back && pos <= radixPos && (0 < radixPos || c == opts.radixPoint) && (void 0 === maskset.validPositions[pos - 1] || maskset.validPositions[pos - 1].input !== opts.negationSymbol.back) && (pos -= 1), pos;
    }

    function decimalValidator(chrs, maskset, pos, strict, opts) {
      var radixPos = maskset.buffer ? maskset.buffer.indexOf(opts.radixPoint) : -1,
          result = -1 !== radixPos && new RegExp("[0-9\uFF11-\uFF19]").test(chrs);
      return opts._radixDance && result && null == maskset.validPositions[radixPos] ? {
        insert: {
          pos: radixPos === pos ? radixPos + 1 : radixPos,
          c: opts.radixPoint
        },
        pos: pos
      } : result;
    }

    function checkForLeadingZeroes(buffer, opts) {
      var numberMatches = new RegExp("(^" + ("" !== opts.negationSymbol.front ? Inputmask.escapeRegex(opts.negationSymbol.front) + "?" : "") + Inputmask.escapeRegex(opts.prefix) + ")(.*)(" + Inputmask.escapeRegex(opts.suffix) + ("" != opts.negationSymbol.back ? Inputmask.escapeRegex(opts.negationSymbol.back) + "?" : "") + "$)").exec(buffer.slice().reverse().join("")),
          number = numberMatches ? numberMatches[2] : "",
          leadingzeroes = !1;
      return number && (number = number.split(opts.radixPoint.charAt(0))[0], leadingzeroes = new RegExp("^[0" + opts.groupSeparator + "]*").exec(number)), !(!leadingzeroes || !(1 < leadingzeroes[0].length || 0 < leadingzeroes[0].length && leadingzeroes[0].length < number.length)) && leadingzeroes;
    }

    Inputmask.extendAliases({
      numeric: {
        mask: genMask,
        _mask: function _mask(opts) {
          return "(" + opts.groupSeparator + "999){+|1}";
        },
        digits: "*",
        digitsOptional: !0,
        enforceDigitsOnBlur: !1,
        radixPoint: ".",
        positionCaretOnClick: "radixFocus",
        _radixDance: !0,
        groupSeparator: "",
        allowMinus: !0,
        negationSymbol: {
          front: "-",
          back: ""
        },
        prefix: "",
        suffix: "",
        min: null,
        max: null,
        step: 1,
        unmaskAsNumber: !1,
        roundingFN: Math.round,
        inputmode: "numeric",
        shortcuts: {
          k: "000",
          m: "000000"
        },
        placeholder: "0",
        greedy: !1,
        rightAlign: !0,
        insertMode: !0,
        autoUnmask: !1,
        skipOptionalPartCharacter: "",
        definitions: {
          0: {
            validator: decimalValidator
          },
          1: {
            validator: decimalValidator,
            definitionSymbol: "9"
          },
          "+": {
            validator: function validator(chrs, maskset, pos, strict, opts) {
              return opts.allowMinus && ("-" === chrs || chrs === opts.negationSymbol.front);
            }
          },
          "-": {
            validator: function validator(chrs, maskset, pos, strict, opts) {
              return opts.allowMinus && chrs === opts.negationSymbol.back;
            }
          }
        },
        preValidation: function preValidation(buffer, pos, c, isSelection, opts, maskset, caretPos, strict) {
          if (!1 !== opts.__financeInput && c === opts.radixPoint) return !1;
          var pattern;

          if (pattern = opts.shortcuts && opts.shortcuts[c]) {
            if (1 < pattern.length) for (var inserts = [], i = 0; i < pattern.length; i++) {
              inserts.push({
                pos: pos + i,
                c: pattern[i],
                strict: !1
              });
            }
            return {
              insert: inserts
            };
          }

          var radixPos = $.inArray(opts.radixPoint, buffer),
              initPos = pos;

          if (pos = hanndleRadixDance(pos, c, radixPos, maskset, opts), "-" === c || c === opts.negationSymbol.front) {
            if (!0 !== opts.allowMinus) return !1;
            var isNegative = !1,
                front = findValid("+", maskset),
                back = findValid("-", maskset);
            return -1 !== front && (isNegative = [front, back]), !1 !== isNegative ? {
              remove: isNegative,
              caret: initPos
            } : {
              insert: [{
                pos: findValidator("+", maskset),
                c: opts.negationSymbol.front,
                fromIsValid: !0
              }, {
                pos: findValidator("-", maskset),
                c: opts.negationSymbol.back,
                fromIsValid: void 0
              }],
              caret: initPos + opts.negationSymbol.back.length
            };
          }

          if (strict) return !0;
          if (-1 !== radixPos && !0 === opts._radixDance && !1 === isSelection && c === opts.radixPoint && void 0 !== opts.digits && (isNaN(opts.digits) || 0 < parseInt(opts.digits)) && radixPos !== pos) return {
            caret: opts._radixDance && pos === radixPos - 1 ? radixPos + 1 : radixPos
          };
          if (!1 === opts.__financeInput) if (isSelection) {
            if (opts.digitsOptional) return {
              rewritePosition: caretPos.end
            };

            if (!opts.digitsOptional) {
              if (caretPos.begin > radixPos && caretPos.end <= radixPos) return c === opts.radixPoint ? {
                insert: {
                  pos: radixPos + 1,
                  c: "0",
                  fromIsValid: !0
                },
                rewritePosition: radixPos
              } : {
                rewritePosition: radixPos + 1
              };
              if (caretPos.begin < radixPos) return {
                rewritePosition: caretPos.begin - 1
              };
            }
          } else if (!opts.showMaskOnHover && !opts.showMaskOnFocus && !opts.digitsOptional && 0 < opts.digits && "" === this.inputmask.__valueGet.call(this)) return {
            rewritePosition: radixPos
          };
          return {
            rewritePosition: pos
          };
        },
        postValidation: function postValidation(buffer, pos, c, currentResult, opts, maskset, strict) {
          if (!1 === currentResult) return currentResult;
          if (strict) return !0;

          if (null !== opts.min || null !== opts.max) {
            var unmasked = opts.onUnMask(buffer.slice().reverse().join(""), void 0, $.extend({}, opts, {
              unmaskAsNumber: !0
            }));
            if (null !== opts.min && unmasked < opts.min && (unmasked.toString().length >= opts.min.toString().length || unmasked < 0)) return !1;
            if (null !== opts.max && unmasked > opts.max) return !1;
          }

          return currentResult;
        },
        onUnMask: function onUnMask(maskedValue, unmaskedValue, opts) {
          if ("" === unmaskedValue && !0 === opts.nullable) return unmaskedValue;
          var processValue = maskedValue.replace(opts.prefix, "");
          return processValue = processValue.replace(opts.suffix, ""), processValue = processValue.replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator), "g"), ""), "" !== opts.placeholder.charAt(0) && (processValue = processValue.replace(new RegExp(opts.placeholder.charAt(0), "g"), "0")), opts.unmaskAsNumber ? ("" !== opts.radixPoint && -1 !== processValue.indexOf(opts.radixPoint) && (processValue = processValue.replace(Inputmask.escapeRegex.call(this, opts.radixPoint), ".")), processValue = processValue.replace(new RegExp("^" + Inputmask.escapeRegex(opts.negationSymbol.front)), "-"), processValue = processValue.replace(new RegExp(Inputmask.escapeRegex(opts.negationSymbol.back) + "$"), ""), Number(processValue)) : processValue;
        },
        isComplete: function isComplete(buffer, opts) {
          var maskedValue = (opts.numericInput ? buffer.slice().reverse() : buffer).join("");
          return maskedValue = maskedValue.replace(new RegExp("^" + Inputmask.escapeRegex(opts.negationSymbol.front)), "-"), maskedValue = maskedValue.replace(new RegExp(Inputmask.escapeRegex(opts.negationSymbol.back) + "$"), ""), maskedValue = maskedValue.replace(opts.prefix, ""), maskedValue = maskedValue.replace(opts.suffix, ""), maskedValue = maskedValue.replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator) + "([0-9]{3})", "g"), "$1"), "," === opts.radixPoint && (maskedValue = maskedValue.replace(Inputmask.escapeRegex(opts.radixPoint), ".")), isFinite(maskedValue);
        },
        onBeforeMask: function onBeforeMask(initialValue, opts) {
          var radixPoint = opts.radixPoint || ",";
          isFinite(opts.digits) && (opts.digits = parseInt(opts.digits)), "number" != typeof initialValue && "number" !== opts.inputType || "" === radixPoint || (initialValue = initialValue.toString().replace(".", radixPoint));
          var valueParts = initialValue.split(radixPoint),
              integerPart = valueParts[0].replace(/[^\-0-9]/g, ""),
              decimalPart = 1 < valueParts.length ? valueParts[1].replace(/[^0-9]/g, "") : "",
              forceDigits = 1 < valueParts.length;
          initialValue = integerPart + ("" !== decimalPart ? radixPoint + decimalPart : decimalPart);
          var digits = 0;

          if ("" !== radixPoint && (digits = opts.digitsOptional ? opts.digits < decimalPart.length ? opts.digits : decimalPart.length : opts.digits, "" !== decimalPart || !opts.digitsOptional)) {
            var digitsFactor = Math.pow(10, digits || 1);
            initialValue = initialValue.replace(Inputmask.escapeRegex(radixPoint), "."), isNaN(parseFloat(initialValue)) || (initialValue = (opts.roundingFN(parseFloat(initialValue) * digitsFactor) / digitsFactor).toFixed(digits)), initialValue = initialValue.toString().replace(".", radixPoint);
          }

          if (0 === opts.digits && -1 !== initialValue.indexOf(radixPoint) && (initialValue = initialValue.substring(0, initialValue.indexOf(radixPoint))), null !== opts.min || null !== opts.max) {
            var numberValue = initialValue.toString().replace(radixPoint, ".");
            null !== opts.min && numberValue < opts.min ? initialValue = opts.min.toString().replace(".", radixPoint) : null !== opts.max && numberValue > opts.max && (initialValue = opts.max.toString().replace(".", radixPoint));
          }

          return alignDigits(initialValue.toString().split(""), digits, opts, forceDigits).join("");
        },
        onBeforeWrite: function onBeforeWrite(e, buffer, caretPos, opts) {
          function stripBuffer(buffer, stripRadix) {
            if (!1 !== opts.__financeInput || stripRadix) {
              var position = $.inArray(opts.radixPoint, buffer);
              -1 !== position && buffer.splice(position, 1);
            }

            if ("" !== opts.groupSeparator) for (; -1 !== (position = buffer.indexOf(opts.groupSeparator));) {
              buffer.splice(position, 1);
            }
            return buffer;
          }

          var result,
              leadingzeroes = checkForLeadingZeroes(buffer, opts);

          if (leadingzeroes) {
            var buf = buffer.slice().reverse(),
                caretNdx = buf.join("").indexOf(leadingzeroes[0]);
            buf.splice(caretNdx, leadingzeroes[0].length);
            var newCaretPos = buf.length - caretNdx;
            stripBuffer(buf), result = {
              refreshFromBuffer: !0,
              buffer: buf.reverse(),
              caret: caretPos < newCaretPos ? caretPos : newCaretPos
            };
          }

          if (e) switch (e.type) {
            case "blur":
            case "checkval":
              if (null !== opts.min) {
                var unmasked = opts.onUnMask(buffer.slice().reverse().join(""), void 0, $.extend({}, opts, {
                  unmaskAsNumber: !0
                }));
                if (null !== opts.min && unmasked < opts.min) return {
                  refreshFromBuffer: !0,
                  buffer: alignDigits(opts.min.toString().replace(".", opts.radixPoint).split(""), opts.digits, opts).reverse()
                };
              }

              if (buffer[buffer.length - 1] === opts.negationSymbol.front) {
                var nmbrMtchs = new RegExp("(^" + ("" != opts.negationSymbol.front ? Inputmask.escapeRegex(opts.negationSymbol.front) + "?" : "") + Inputmask.escapeRegex(opts.prefix) + ")(.*)(" + Inputmask.escapeRegex(opts.suffix) + ("" != opts.negationSymbol.back ? Inputmask.escapeRegex(opts.negationSymbol.back) + "?" : "") + "$)").exec(stripBuffer(buffer.slice(), !0).reverse().join("")),
                    number = nmbrMtchs ? nmbrMtchs[2] : "";
                0 == number && (result = {
                  refreshFromBuffer: !0,
                  buffer: [0]
                });
              } else "" !== opts.radixPoint && buffer[0] === opts.radixPoint && (result && result.buffer ? result.buffer.shift() : (buffer.shift(), result = {
                refreshFromBuffer: !0,
                buffer: stripBuffer(buffer)
              }));

              if (opts.enforceDigitsOnBlur) {
                result = result || {};
                var bffr = result && result.buffer || buffer.slice().reverse();
                result.refreshFromBuffer = !0, result.buffer = alignDigits(bffr, opts.digits, opts, !0).reverse();
              }

          }
          return result;
        },
        onKeyDown: function onKeyDown(e, buffer, caretPos, opts) {
          var $input = $(this),
              bffr;
          if (e.ctrlKey) switch (e.keyCode) {
            case keyCode.UP:
              return this.inputmask.__valueSet.call(this, parseFloat(this.inputmask.unmaskedvalue()) + parseInt(opts.step)), $input.trigger("setvalue"), !1;

            case keyCode.DOWN:
              return this.inputmask.__valueSet.call(this, parseFloat(this.inputmask.unmaskedvalue()) - parseInt(opts.step)), $input.trigger("setvalue"), !1;
          }

          if (!e.shiftKey && (e.keyCode === keyCode.DELETE || e.keyCode === keyCode.BACKSPACE || e.keyCode === keyCode.BACKSPACE_SAFARI) && caretPos.begin !== buffer.length) {
            if (buffer[e.keyCode === keyCode.DELETE ? caretPos.begin - 1 : caretPos.end] === opts.negationSymbol.front) return bffr = buffer.slice().reverse(), "" !== opts.negationSymbol.front && bffr.shift(), "" !== opts.negationSymbol.back && bffr.pop(), $input.trigger("setvalue", [bffr.join(""), caretPos.begin]), !1;

            if (!0 === opts._radixDance) {
              var radixPos = $.inArray(opts.radixPoint, buffer);

              if (opts.digitsOptional) {
                if (0 === radixPos) return bffr = buffer.slice().reverse(), bffr.pop(), $input.trigger("setvalue", [bffr.join(""), caretPos.begin >= bffr.length ? bffr.length : caretPos.begin]), !1;
              } else if (-1 !== radixPos && (caretPos.begin < radixPos || caretPos.end < radixPos || e.keyCode === keyCode.DELETE && caretPos.begin === radixPos)) return caretPos.begin !== caretPos.end || e.keyCode !== keyCode.BACKSPACE && e.keyCode !== keyCode.BACKSPACE_SAFARI || caretPos.begin++, bffr = buffer.slice().reverse(), bffr.splice(bffr.length - caretPos.begin, caretPos.begin - caretPos.end + 1), bffr = alignDigits(bffr, opts.digits, opts).join(""), $input.trigger("setvalue", [bffr, caretPos.begin >= bffr.length ? radixPos + 1 : caretPos.begin]), !1;
            }
          }
        }
      },
      currency: {
        prefix: "",
        groupSeparator: ",",
        alias: "numeric",
        digits: 2,
        digitsOptional: !1
      },
      decimal: {
        alias: "numeric"
      },
      integer: {
        alias: "numeric",
        digits: 0
      },
      percentage: {
        alias: "numeric",
        min: 0,
        max: 100,
        suffix: " %",
        digits: 0,
        allowMinus: !1
      },
      indianns: {
        alias: "numeric",
        _mask: function _mask(opts) {
          return "(" + opts.groupSeparator + "99){*|1}(" + opts.groupSeparator + "999){1|1}";
        },
        groupSeparator: ",",
        radixPoint: ".",
        placeholder: "0",
        digits: 2,
        digitsOptional: !1
      }
    }), module.exports = Inputmask;
  }, function (module, exports, __nested_webpack_require_154684__) {
    "use strict";

    var _inputmask = _interopRequireDefault(__nested_webpack_require_154684__(1));

    function _typeof(obj) {
      return _typeof = "function" == typeof Symbol && "symbol" == _typeof2(Symbol.iterator) ? function _typeof(obj) {
        return _typeof2(obj);
      } : function _typeof(obj) {
        return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
      }, _typeof(obj);
    }

    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor)) throw new TypeError("Cannot call a class as a function");
    }

    function _possibleConstructorReturn(self, call) {
      return !call || "object" !== _typeof(call) && "function" != typeof call ? _assertThisInitialized(self) : call;
    }

    function _assertThisInitialized(self) {
      if (void 0 === self) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
      return self;
    }

    function _inherits(subClass, superClass) {
      if ("function" != typeof superClass && null !== superClass) throw new TypeError("Super expression must either be null or a function");
      subClass.prototype = Object.create(superClass && superClass.prototype, {
        constructor: {
          value: subClass,
          writable: !0,
          configurable: !0
        }
      }), superClass && _setPrototypeOf(subClass, superClass);
    }

    function _wrapNativeSuper(Class) {
      var _cache = "function" == typeof Map ? new Map() : void 0;

      return _wrapNativeSuper = function _wrapNativeSuper(Class) {
        if (null === Class || !_isNativeFunction(Class)) return Class;
        if ("function" != typeof Class) throw new TypeError("Super expression must either be null or a function");

        if ("undefined" != typeof _cache) {
          if (_cache.has(Class)) return _cache.get(Class);

          _cache.set(Class, Wrapper);
        }

        function Wrapper() {
          return _construct(Class, arguments, _getPrototypeOf(this).constructor);
        }

        return Wrapper.prototype = Object.create(Class.prototype, {
          constructor: {
            value: Wrapper,
            enumerable: !1,
            writable: !0,
            configurable: !0
          }
        }), _setPrototypeOf(Wrapper, Class);
      }, _wrapNativeSuper(Class);
    }

    function isNativeReflectConstruct() {
      if ("undefined" == typeof Reflect || !Reflect.construct) return !1;
      if (Reflect.construct.sham) return !1;
      if ("function" == typeof Proxy) return !0;

      try {
        return Date.prototype.toString.call(Reflect.construct(Date, [], function () {})), !0;
      } catch (e) {
        return !1;
      }
    }

    function _construct(Parent, args, Class) {
      return _construct = isNativeReflectConstruct() ? Reflect.construct : function _construct(Parent, args, Class) {
        var a = [null];
        a.push.apply(a, args);
        var Constructor = Function.bind.apply(Parent, a),
            instance = new Constructor();
        return Class && _setPrototypeOf(instance, Class.prototype), instance;
      }, _construct.apply(null, arguments);
    }

    function _isNativeFunction(fn) {
      return -1 !== Function.toString.call(fn).indexOf("[native code]");
    }

    function _setPrototypeOf(o, p) {
      return _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
        return o.__proto__ = p, o;
      }, _setPrototypeOf(o, p);
    }

    function _getPrototypeOf(o) {
      return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {
        return o.__proto__ || Object.getPrototypeOf(o);
      }, _getPrototypeOf(o);
    }

    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : {
        "default": obj
      };
    }

    if (document.head.createShadowRoot || document.head.attachShadow) {
      var InputmaskElement = function (_HTMLElement) {
        function InputmaskElement() {
          var _this;

          _classCallCheck(this, InputmaskElement), _this = _possibleConstructorReturn(this, _getPrototypeOf(InputmaskElement).call(this));

          var attributeNames = _this.getAttributeNames(),
              shadow = _this.attachShadow({
            mode: "closed"
          }),
              input = document.createElement("input");

          for (var attr in input.type = "text", shadow.appendChild(input), attributeNames) {
            Object.prototype.hasOwnProperty.call(attributeNames, attr) && input.setAttribute("data-inputmask-" + attributeNames[attr], _this.getAttribute(attributeNames[attr]));
          }

          return new _inputmask["default"]().mask(input), input.inputmask.shadowRoot = shadow, _this;
        }

        return _inherits(InputmaskElement, _HTMLElement), InputmaskElement;
      }(_wrapNativeSuper(HTMLElement));

      customElements.define("input-mask", InputmaskElement);
    }
  }, function (module, exports, __nested_webpack_require_159722__) {
    "use strict";

    function _typeof(obj) {
      return _typeof = "function" == typeof Symbol && "symbol" == _typeof2(Symbol.iterator) ? function _typeof(obj) {
        return _typeof2(obj);
      } : function _typeof(obj) {
        return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
      }, _typeof(obj);
    }

    var $ = __nested_webpack_require_159722__(3),
        Inputmask = __nested_webpack_require_159722__(1);

    void 0 === $.fn.inputmask && ($.fn.inputmask = function (fn, options) {
      var nptmask,
          input = this[0];
      if (void 0 === options && (options = {}), "string" == typeof fn) switch (fn) {
        case "unmaskedvalue":
          return input && input.inputmask ? input.inputmask.unmaskedvalue() : $(input).val();

        case "remove":
          return this.each(function () {
            this.inputmask && this.inputmask.remove();
          });

        case "getemptymask":
          return input && input.inputmask ? input.inputmask.getemptymask() : "";

        case "hasMaskedValue":
          return !(!input || !input.inputmask) && input.inputmask.hasMaskedValue();

        case "isComplete":
          return !input || !input.inputmask || input.inputmask.isComplete();

        case "getmetadata":
          return input && input.inputmask ? input.inputmask.getmetadata() : void 0;

        case "setvalue":
          Inputmask.setValue(input, options);
          break;

        case "option":
          if ("string" != typeof options) return this.each(function () {
            if (void 0 !== this.inputmask) return this.inputmask.option(options);
          });
          if (input && void 0 !== input.inputmask) return input.inputmask.option(options);
          break;

        default:
          return options.alias = fn, nptmask = new Inputmask(options), this.each(function () {
            nptmask.mask(this);
          });
      } else {
        if (Array.isArray(fn)) return options.alias = fn, nptmask = new Inputmask(options), this.each(function () {
          nptmask.mask(this);
        });
        if ("object" == _typeof(fn)) return nptmask = new Inputmask(fn), void 0 === fn.mask && void 0 === fn.alias ? this.each(function () {
          if (void 0 !== this.inputmask) return this.inputmask.option(fn);
          nptmask.mask(this);
        }) : this.each(function () {
          nptmask.mask(this);
        });
        if (void 0 === fn) return this.each(function () {
          nptmask = new Inputmask(options), nptmask.mask(this);
        });
      }
    });
  }, function (module, exports, __nested_webpack_require_162360__) {
    "use strict";

    var im = __nested_webpack_require_162360__(6),
        jQuery = __nested_webpack_require_162360__(3);

    im.dependencyLib === jQuery && __nested_webpack_require_162360__(13), module.exports = im;
  }], installedModules = {}, __nested_webpack_require_164186__.m = modules, __nested_webpack_require_164186__.c = installedModules, __nested_webpack_require_164186__.d = function (exports, name, getter) {
    __nested_webpack_require_164186__.o(exports, name) || Object.defineProperty(exports, name, {
      enumerable: !0,
      get: getter
    });
  }, __nested_webpack_require_164186__.r = function (exports) {
    "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(exports, Symbol.toStringTag, {
      value: "Module"
    }), Object.defineProperty(exports, "__esModule", {
      value: !0
    });
  }, __nested_webpack_require_164186__.t = function (value, mode) {
    if (1 & mode && (value = __nested_webpack_require_164186__(value)), 8 & mode) return value;
    if (4 & mode && "object" == _typeof2(value) && value && value.__esModule) return value;
    var ns = Object.create(null);
    if (__nested_webpack_require_164186__.r(ns), Object.defineProperty(ns, "default", {
      enumerable: !0,
      value: value
    }), 2 & mode && "string" != typeof value) for (var key in value) {
      __nested_webpack_require_164186__.d(ns, key, function (key) {
        return value[key];
      }.bind(null, key));
    }
    return ns;
  }, __nested_webpack_require_164186__.n = function (module) {
    var getter = module && module.__esModule ? function getDefault() {
      return module["default"];
    } : function getModuleExports() {
      return module;
    };
    return __nested_webpack_require_164186__.d(getter, "a", getter), getter;
  }, __nested_webpack_require_164186__.o = function (object, property) {
    return Object.prototype.hasOwnProperty.call(object, property);
  }, __nested_webpack_require_164186__.p = "", __nested_webpack_require_164186__(__nested_webpack_require_164186__.s = 14);

  function __nested_webpack_require_164186__(moduleId) {
    if (installedModules[moduleId]) return installedModules[moduleId].exports;
    var module = installedModules[moduleId] = {
      i: moduleId,
      l: !1,
      exports: {}
    };
    return modules[moduleId].call(module.exports, module, module.exports, __nested_webpack_require_164186__), module.l = !0, module.exports;
  }

  var modules, installedModules;
});

/***/ }),

/***/ "./resources/js/libs/jquery.sumoselect.min.js":
/*!****************************************************!*\
  !*** ./resources/js/libs/jquery.sumoselect.min.js ***!
  \****************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*######################*/

/* 01 SUMOSELECT PLUGIN */

/*######################*/

/*!
 * jquery.sumoselect - v3.0.3
 * http://hemantnegi.github.io/jquery.sumoselect
 */
!function (e) {
  "use strict";

   true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")], __WEBPACK_AMD_DEFINE_FACTORY__ = (e),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : 0;
}(function (e) {
  "namespace sumo";

  e.fn.SumoSelect = function (t) {
    var l = e.extend({
      placeholder: "Select Here",
      csvDispCount: 3,
      captionFormat: "{0} Selected",
      captionFormatAllSelected: "{0} all selected!",
      floatWidth: 400,
      forceCustomRendering: !1,
      nativeOnDevice: ["Android", "BlackBerry", "iPhone", "iPad", "iPod", "Opera Mini", "IEMobile", "Silk"],
      outputAsCSV: !1,
      csvSepChar: ",",
      okCancelInMulti: !1,
      isClickAwayOk: !1,
      triggerChangeCombined: !0,
      selectAll: !1,
      search: !1,
      searchText: "Search...",
      noMatch: 'No matches for "{0}"',
      prefix: "",
      locale: ["OK", "Cancel", "Select All"],
      up: !1,
      showTitle: !0
    }, t),
        s = this.each(function () {
      var t = this;
      !this.sumo && e(this).is("select") && (this.sumo = {
        E: e(t),
        is_multi: e(t).attr("multiple"),
        select: "",
        caption: "",
        placeholder: "",
        optDiv: "",
        CaptionCont: "",
        ul: "",
        is_floating: !1,
        is_opened: !1,
        mob: !1,
        Pstate: [],
        createElems: function createElems() {
          var t = this;
          return t.E.wrap('<div class="SumoSelect" tabindex="0" role="button" aria-expanded="false">'), t.select = t.E.parent(), t.caption = e("<span>"), t.CaptionCont = e('<p class="CaptionCont SelectBox" ><label><i></i></label></p>').attr("style", t.E.attr("style")).prepend(t.caption), t.select.append(t.CaptionCont), t.is_multi || (l.okCancelInMulti = !1), t.E.attr("disabled") && t.select.addClass("disabled").removeAttr("tabindex"), l.outputAsCSV && t.is_multi && t.E.attr("name") && (t.select.append(e('<input class="HEMANT123" type="hidden" />').attr("name", t.E.attr("name")).val(t.getSelStr())), t.E.removeAttr("name")), t.isMobile() && !l.forceCustomRendering ? void t.setNativeMobile() : (t.E.attr("name") && t.select.addClass("sumo_" + t.E.attr("name").replace(/\[\]/, "")), t.E.addClass("SumoUnder").attr("tabindex", "-1"), t.optDiv = e('<div class="optWrapper ' + (l.up ? "up" : "") + '">'), t.floatingList(), t.ul = e('<ul class="options">'), t.optDiv.append(t.ul), l.selectAll && t.is_multi && t.SelAll(), l.search && t.Search(), t.ul.append(t.prepItems(t.E.children())), t.is_multi && t.multiSelelect(), t.select.append(t.optDiv), t.basicEvents(), void t.selAllState());
        },
        prepItems: function prepItems(t, l) {
          var i = [],
              s = this;
          return e(t).each(function (t, n) {
            n = e(n), i.push(n.is("optgroup") ? e('<li class="group ' + (n[0].disabled ? "disabled" : "") + '"><label>' + n.attr("label") + "</label><ul></ul></li>").find("ul").append(s.prepItems(n.children(), n[0].disabled)).end() : s.createLi(n, l));
          }), i;
        },
        createLi: function createLi(t, l) {
          var i = this;
          t.attr("value") || t.attr("value", t.val());
          var s = e('<li class="opt"><label>' + t.text() + "</label></li>");
          return s.data("opt", t), t.data("li", s), i.is_multi && s.prepend("<span><i></i></span>"), (t[0].disabled || l) && (s = s.addClass("disabled")), i.onOptClick(s), t[0].selected && s.addClass("selected"), t.attr("class") && s.addClass(t.attr("class")), t.attr("title") && s.attr("title", t.attr("title")), s;
        },
        getSelStr: function getSelStr() {
          return sopt = [], this.E.find("option:selected").each(function () {
            sopt.push(e(this).val());
          }), sopt.join(l.csvSepChar);
        },
        multiSelelect: function multiSelelect() {
          var t = this;
          t.optDiv.addClass("multiple"), t.okbtn = e('<p tabindex="0" class="btnOk">' + l.locale[0] + "</p>").click(function () {
            t._okbtn(), t.hideOpts();
          }), t.cancelBtn = e('<p tabindex="0" class="btnCancel">' + l.locale[1] + "</p>").click(function () {
            t._cnbtn(), t.hideOpts();
          });
          var i = t.okbtn.add(t.cancelBtn);
          t.optDiv.append(e('<div class="MultiControls">').append(i)), i.on("keydown.sumo", function (l) {
            var i = e(this);

            switch (l.which) {
              case 32:
              case 13:
                i.trigger("click");
                break;

              case 9:
                if (i.hasClass("btnOk")) return;

              case 27:
                return t._cnbtn(), void t.hideOpts();
            }

            l.stopPropagation(), l.preventDefault();
          });
        },
        _okbtn: function _okbtn() {
          var e = this,
              t = 0;
          l.triggerChangeCombined && (e.E.find("option:selected").length != e.Pstate.length ? t = 1 : e.E.find("option").each(function (l, i) {
            i.selected && e.Pstate.indexOf(l) < 0 && (t = 1);
          }), t && (e.callChange(), e.setText()));
        },
        _cnbtn: function _cnbtn() {
          var e = this;
          e.E.find("option:selected").each(function () {
            this.selected = !1;
          }), e.optDiv.find("li.selected").removeClass("selected");

          for (var t = 0; t < e.Pstate.length; t++) {
            e.E.find("option")[e.Pstate[t]].selected = !0, e.ul.find("li.opt").eq(e.Pstate[t]).addClass("selected");
          }

          e.selAllState();
        },
        SelAll: function SelAll() {
          var t = this;
          t.is_multi && (t.selAll = e('<p class="select-all"><span><i></i></span><label>' + l.locale[2] + "</label></p>"), t.optDiv.addClass("selall"), t.selAll.on("click", function () {
            t.selAll.toggleClass("selected"), t.toggSelAll(t.selAll.hasClass("selected"), 1);
          }), t.optDiv.prepend(t.selAll));
        },
        Search: function Search() {
          var t = this,
              i = t.CaptionCont.addClass("search"),
              s = e('<p class="no-match">');
          t.ftxt = e('<input type="text" class="search-txt" value="" placeholder="' + l.searchText + '">').on("click", function (e) {
            e.stopPropagation();
          }), i.append(t.ftxt), t.optDiv.children("ul").after(s), t.ftxt.on("keyup.sumo", function () {
            var i = t.optDiv.find("ul.options li.opt").each(function (l, i) {
              var i = e(i),
                  s = i.data("opt")[0];
              s.hidden = i.text().toLowerCase().indexOf(t.ftxt.val().toLowerCase()) < 0, i.toggleClass("hidden", s.hidden);
            }).not(".hidden");
            s.html(l.noMatch.replace(/\{0\}/g, "<em></em>")).toggle(!i.length), s.find("em").text(t.ftxt.val()), t.selAllState();
          });
        },
        selAllState: function selAllState() {
          var t = this;

          if (l.selectAll && t.is_multi) {
            var i = 0,
                s = 0;
            t.optDiv.find("li.opt").not(".hidden").each(function (t, l) {
              e(l).hasClass("selected") && i++, e(l).hasClass("disabled") || s++;
            }), i == s ? t.selAll.removeClass("partial").addClass("selected") : 0 == i ? t.selAll.removeClass("selected partial") : t.selAll.addClass("partial");
          }
        },
        showOpts: function showOpts() {
          var t = this;
          t.E.attr("disabled") || (t.E.trigger("sumo:opening", t), t.is_opened = !0, t.select.addClass("open").attr("aria-expanded", "true"), t.E.trigger("sumo:opened", t), t.ftxt ? t.ftxt.focus() : t.select.focus(), e(document).on("click.sumo", function (e) {
            if (!t.select.is(e.target) && 0 === t.select.has(e.target).length) {
              if (!t.is_opened) return;
              t.hideOpts(), l.okCancelInMulti && (l.isClickAwayOk ? t._okbtn() : t._cnbtn());
            }
          }), t.is_floating && (H = t.optDiv.children("ul").outerHeight() + 2, t.is_multi && (H += parseInt(t.optDiv.css("padding-bottom"))), t.optDiv.css("height", H), e("body").addClass("sumoStopScroll")), t.setPstate());
        },
        setPstate: function setPstate() {
          var e = this;
          e.is_multi && (e.is_floating || l.okCancelInMulti) && (e.Pstate = [], e.E.find("option").each(function (t, l) {
            l.selected && e.Pstate.push(t);
          }));
        },
        callChange: function callChange() {
          this.E.trigger("change").trigger("click");
        },
        hideOpts: function hideOpts() {
          var t = this;
          t.is_opened && (t.E.trigger("sumo:closing", t), t.is_opened = !1, t.select.removeClass("open").attr("aria-expanded", "true").find("ul li.sel").removeClass("sel"), t.E.trigger("sumo:closed", t), e(document).off("click.sumo"), t.select.focus(), e("body").removeClass("sumoStopScroll"), l.search && (t.ftxt.val(""), t.ftxt.trigger("keyup.sumo")));
        },
        setOnOpen: function setOnOpen() {
          var e = this,
              t = e.optDiv.find("li.opt:not(.hidden)").eq(l.search ? 0 : e.E[0].selectedIndex);
          t.hasClass("disabled") && (t = t.next(":not(disabled)"), !t.length) || (e.optDiv.find("li.sel").removeClass("sel"), t.addClass("sel"), e.showOpts());
        },
        nav: function nav(e) {
          var t,
              l = this,
              i = l.ul.find("li.opt:not(.disabled, .hidden)"),
              s = l.ul.find("li.opt.sel:not(.hidden)"),
              n = i.index(s);

          if (l.is_opened && s.length) {
            if (e && n > 0) t = i.eq(n - 1);else {
              if (!(!e && n < i.length - 1 && n > -1)) return;
              t = i.eq(n + 1);
            }
            s.removeClass("sel"), s = t.addClass("sel");
            var a = l.ul,
                o = a.scrollTop(),
                c = s.position().top + o;
            c >= o + a.height() - s.outerHeight() && a.scrollTop(c - a.height() + s.outerHeight()), o > c && a.scrollTop(c);
          } else l.setOnOpen();
        },
        basicEvents: function basicEvents() {
          var t = this;
          t.CaptionCont.click(function (e) {
            t.E.trigger("click"), t.is_opened ? t.hideOpts() : t.showOpts(), e.stopPropagation();
          }), t.select.on("keydown.sumo", function (e) {
            switch (e.which) {
              case 38:
                t.nav(!0);
                break;

              case 40:
                t.nav(!1);
                break;

              case 65:
                if (t.is_multi && e.ctrlKey) {
                  t.toggSelAll(!e.shiftKey, 1);
                  break;
                }

                return;

              case 32:
                if (l.search && t.ftxt.is(e.target)) return;

              case 13:
                t.is_opened ? t.optDiv.find("ul li.sel").trigger("click") : t.setOnOpen();
                break;

              case 9:
                return void (l.okCancelInMulti || t.hideOpts());

              case 27:
                return l.okCancelInMulti && t._cnbtn(), void t.hideOpts();

              default:
                return;
            }

            e.preventDefault();
          }), e(window).on("resize.sumo", function () {
            t.floatingList();
          });
        },
        onOptClick: function onOptClick(t) {
          var i = this;
          t.click(function () {
            var t = e(this);

            if (!t.hasClass("disabled")) {
              i.is_multi ? (t.toggleClass("selected"), t.data("opt")[0].selected = t.hasClass("selected"), i.selAllState()) : (t.parent().find("li.selected").removeClass("selected"), t.toggleClass("selected"), t.data("opt")[0].selected = !0), i.is_multi && l.triggerChangeCombined && (i.is_floating || l.okCancelInMulti) || (i.setText(), i.callChange()), i.is_multi || i.hideOpts();
            }
          });
        },
        setText: function setText() {
          var t = this;

          if (t.placeholder = "", t.is_multi) {
            for (sels = t.E.find(":selected").not(":disabled"), i = 0; i < sels.length; i++) {
              if (i + 1 >= l.csvDispCount && l.csvDispCount) {
                sels.length == t.E.find("option").length && l.captionFormatAllSelected ? t.placeholder = l.captionFormatAllSelected.replace(/\{0\}/g, sels.length) + "," : t.placeholder = l.captionFormat.replace(/\{0\}/g, sels.length) + ",";
                break;
              }

              t.placeholder += e(sels[i]).text() + ", ";
            }

            t.placeholder = t.placeholder.replace(/,([^,]*)$/, "$1");
          } else t.placeholder = t.E.find(":selected").not(":disabled").text();

          var s = !1;
          t.placeholder || (s = !0, t.placeholder = t.E.attr("placeholder"), t.placeholder || (t.placeholder = t.E.find("option:disabled:selected").text())), t.placeholder = t.placeholder ? l.prefix + " " + t.placeholder : l.placeholder, t.caption.html(t.placeholder), l.showTitle && t.CaptionCont.attr("title", t.placeholder);
          var n = t.select.find("input.HEMANT123");
          return n.length && n.val(t.getSelStr()), s ? t.caption.addClass("placeholder") : t.caption.removeClass("placeholder"), t.placeholder;
        },
        isMobile: function isMobile() {
          for (var e = navigator.userAgent || navigator.vendor || window.opera, t = 0; t < l.nativeOnDevice.length; t++) {
            if (e.toString().toLowerCase().indexOf(l.nativeOnDevice[t].toLowerCase()) > 0) return l.nativeOnDevice[t];
          }

          return !1;
        },
        setNativeMobile: function setNativeMobile() {
          var e = this;
          e.E.addClass("SelectClass"), e.mob = !0, e.E.change(function () {
            e.setText();
          });
        },
        floatingList: function floatingList() {
          var t = this;
          t.is_floating = e(window).width() <= l.floatWidth, t.optDiv.toggleClass("isFloating", t.is_floating), t.is_floating || t.optDiv.css("height", ""), t.optDiv.toggleClass("okCancelInMulti", l.okCancelInMulti && !t.is_floating);
        },
        vRange: function vRange(e) {
          var t = this,
              l = t.E.find("option");
          if (l.length <= e || 0 > e) throw "index out of bounds";
          return t;
        },
        toggSel: function toggSel(t, l) {
          var i,
              s = this;
          "number" == typeof l ? (s.vRange(l), i = s.E.find("option")[l]) : i = s.E.find('option[value="' + l + '"]')[0] || 0, i && !i.disabled && i.selected != t && (i.selected = t, s.mob || e(i).data("li").toggleClass("selected", t), s.callChange(), s.setPstate(), s.setText(), s.selAllState());
        },
        toggDis: function toggDis(e, t) {
          var l = this.vRange(t);
          l.E.find("option")[t].disabled = e, e && (l.E.find("option")[t].selected = !1), l.mob || l.optDiv.find("ul.options li").eq(t).toggleClass("disabled", e).removeClass("selected"), l.setText();
        },
        toggSumo: function toggSumo(e) {
          var t = this;
          return t.enabled = e, t.select.toggleClass("disabled", e), e ? (t.E.attr("disabled", "disabled"), t.select.removeAttr("tabindex")) : (t.E.removeAttr("disabled"), t.select.attr("tabindex", "0")), t;
        },
        toggSelAll: function toggSelAll(t, l) {
          var i = this;
          i.E.find("option:not(:disabled,:hidden)").each(function (l, i) {
            var s = i.selected,
                i = e(i).data("li");
            i.hasClass("hidden") || (t ? s || i.trigger("click") : s && i.trigger("click"));
          }), l || (!i.mob && i.selAll && i.selAll.removeClass("partial").toggleClass("selected", !!t), i.callChange(), i.setText(), i.setPstate());
        },
        reload: function reload() {
          var t = this.unload();
          return e(t).SumoSelect(l);
        },
        unload: function unload() {
          var e = this;
          return e.select.before(e.E), e.E.show(), l.outputAsCSV && e.is_multi && e.select.find("input.HEMANT123").length && e.E.attr("name", e.select.find("input.HEMANT123").attr("name")), e.select.remove(), delete t.sumo, t;
        },
        add: function add(l, i, s) {
          if ("undefined" == typeof l) throw "No value to add";
          var n = this;
          if (opts = n.E.find("option"), "number" == typeof i && (s = i, i = l), "undefined" == typeof i && (i = l), opt = e("<option></option>").val(l).html(i), opts.length < s) throw "index out of bounds";
          return "undefined" == typeof s || opts.length == s ? (n.E.append(opt), n.mob || n.ul.append(n.createLi(opt))) : (opts.eq(s).before(opt), n.mob || n.ul.find("li.opt").eq(s).before(n.createLi(opt))), t;
        },
        remove: function remove(e) {
          var t = this.vRange(e);
          t.E.find("option").eq(e).remove(), t.mob || t.optDiv.find("ul.options li").eq(e).remove(), t.setText();
        },
        selectItem: function selectItem(e) {
          this.toggSel(!0, e);
        },
        unSelectItem: function unSelectItem(e) {
          this.toggSel(!1, e);
        },
        selectAll: function selectAll() {
          this.toggSelAll(!0);
        },
        unSelectAll: function unSelectAll() {
          this.toggSelAll(!1);
        },
        disableItem: function disableItem(e) {
          this.toggDis(!0, e);
        },
        enableItem: function enableItem(e) {
          this.toggDis(!1, e);
        },
        enabled: !0,
        enable: function enable() {
          return this.toggSumo(!1);
        },
        disable: function disable() {
          return this.toggSumo(!0);
        },
        init: function init() {
          var e = this;
          return e.createElems(), e.setText(), e;
        }
      }, t.sumo.init());
    });
    return 1 == s.length ? s[0] : s;
  };
});
/*###################*/

/* 02 CUSTOM SCRIPTS */

/*###################*/

jQuery(function ($) {
  if ($('select').length) {
    $('select').each(function () {
      $(this).SumoSelect({
        search: $(this).data('search'),
        searchText: $(this).data('search-text')
      });
    });
    $('.custom-select').each(function () {
      var option = $(this).closest('.SumoSelect').find('.opt');
      $(option).each(function () {
        var img = $(this).closest('.SumoSelect').find('option').eq($(this).index()).data('img');
        $(this).prepend('<img src="' + img + '">');
      });
    });
  }
});

/***/ }),

/***/ "./resources/js/libs/swiper.min.js":
/*!*****************************************!*\
  !*** ./resources/js/libs/swiper.min.js ***!
  \*****************************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/**
 * Swiper 5.3.0
 * Most modern mobile touch slider and framework with hardware accelerated transitions
 * http://swiperjs.com
 *
 * Copyright 2014-2020 Vladimir Kharlampidi
 *
 * Released under the MIT License
 *
 * Released on: January 11, 2020
 */
!function (e, t) {
  "object" == ( false ? 0 : _typeof(exports)) && "undefined" != "object" ? module.exports = t() :  true ? !(__WEBPACK_AMD_DEFINE_FACTORY__ = (t),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : 0;
}(this, function () {
  "use strict";

  var e = "undefined" == typeof document ? {
    body: {},
    addEventListener: function addEventListener() {},
    removeEventListener: function removeEventListener() {},
    activeElement: {
      blur: function blur() {},
      nodeName: ""
    },
    querySelector: function querySelector() {
      return null;
    },
    querySelectorAll: function querySelectorAll() {
      return [];
    },
    getElementById: function getElementById() {
      return null;
    },
    createEvent: function createEvent() {
      return {
        initEvent: function initEvent() {}
      };
    },
    createElement: function createElement() {
      return {
        children: [],
        childNodes: [],
        style: {},
        setAttribute: function setAttribute() {},
        getElementsByTagName: function getElementsByTagName() {
          return [];
        }
      };
    },
    location: {
      hash: ""
    }
  } : document,
      t = "undefined" == typeof window ? {
    document: e,
    navigator: {
      userAgent: ""
    },
    location: {},
    history: {},
    CustomEvent: function CustomEvent() {
      return this;
    },
    addEventListener: function addEventListener() {},
    removeEventListener: function removeEventListener() {},
    getComputedStyle: function getComputedStyle() {
      return {
        getPropertyValue: function getPropertyValue() {
          return "";
        }
      };
    },
    Image: function Image() {},
    Date: function Date() {},
    screen: {},
    setTimeout: function setTimeout() {},
    clearTimeout: function clearTimeout() {}
  } : window,
      i = function i(e) {
    for (var t = 0; t < e.length; t += 1) {
      this[t] = e[t];
    }

    return this.length = e.length, this;
  };

  function s(s, a) {
    var r = [],
        n = 0;
    if (s && !a && s instanceof i) return s;
    if (s) if ("string" == typeof s) {
      var o,
          l,
          d = s.trim();

      if (d.indexOf("<") >= 0 && d.indexOf(">") >= 0) {
        var h = "div";

        for (0 === d.indexOf("<li") && (h = "ul"), 0 === d.indexOf("<tr") && (h = "tbody"), 0 !== d.indexOf("<td") && 0 !== d.indexOf("<th") || (h = "tr"), 0 === d.indexOf("<tbody") && (h = "table"), 0 === d.indexOf("<option") && (h = "select"), (l = e.createElement(h)).innerHTML = d, n = 0; n < l.childNodes.length; n += 1) {
          r.push(l.childNodes[n]);
        }
      } else for (o = a || "#" !== s[0] || s.match(/[ .<>:~]/) ? (a || e).querySelectorAll(s.trim()) : [e.getElementById(s.trim().split("#")[1])], n = 0; n < o.length; n += 1) {
        o[n] && r.push(o[n]);
      }
    } else if (s.nodeType || s === t || s === e) r.push(s);else if (s.length > 0 && s[0].nodeType) for (n = 0; n < s.length; n += 1) {
      r.push(s[n]);
    }
    return new i(r);
  }

  function a(e) {
    for (var t = [], i = 0; i < e.length; i += 1) {
      -1 === t.indexOf(e[i]) && t.push(e[i]);
    }

    return t;
  }

  s.fn = i.prototype, s.Class = i, s.Dom7 = i;
  var r = {
    addClass: function addClass(e) {
      if (void 0 === e) return this;

      for (var t = e.split(" "), i = 0; i < t.length; i += 1) {
        for (var s = 0; s < this.length; s += 1) {
          void 0 !== this[s] && void 0 !== this[s].classList && this[s].classList.add(t[i]);
        }
      }

      return this;
    },
    removeClass: function removeClass(e) {
      for (var t = e.split(" "), i = 0; i < t.length; i += 1) {
        for (var s = 0; s < this.length; s += 1) {
          void 0 !== this[s] && void 0 !== this[s].classList && this[s].classList.remove(t[i]);
        }
      }

      return this;
    },
    hasClass: function hasClass(e) {
      return !!this[0] && this[0].classList.contains(e);
    },
    toggleClass: function toggleClass(e) {
      for (var t = e.split(" "), i = 0; i < t.length; i += 1) {
        for (var s = 0; s < this.length; s += 1) {
          void 0 !== this[s] && void 0 !== this[s].classList && this[s].classList.toggle(t[i]);
        }
      }

      return this;
    },
    attr: function attr(e, t) {
      var i = arguments;
      if (1 === arguments.length && "string" == typeof e) return this[0] ? this[0].getAttribute(e) : void 0;

      for (var s = 0; s < this.length; s += 1) {
        if (2 === i.length) this[s].setAttribute(e, t);else for (var a in e) {
          this[s][a] = e[a], this[s].setAttribute(a, e[a]);
        }
      }

      return this;
    },
    removeAttr: function removeAttr(e) {
      for (var t = 0; t < this.length; t += 1) {
        this[t].removeAttribute(e);
      }

      return this;
    },
    data: function data(e, t) {
      var i;

      if (void 0 !== t) {
        for (var s = 0; s < this.length; s += 1) {
          (i = this[s]).dom7ElementDataStorage || (i.dom7ElementDataStorage = {}), i.dom7ElementDataStorage[e] = t;
        }

        return this;
      }

      if (i = this[0]) {
        if (i.dom7ElementDataStorage && e in i.dom7ElementDataStorage) return i.dom7ElementDataStorage[e];
        var a = i.getAttribute("data-" + e);
        return a || void 0;
      }
    },
    transform: function transform(e) {
      for (var t = 0; t < this.length; t += 1) {
        var i = this[t].style;
        i.webkitTransform = e, i.transform = e;
      }

      return this;
    },
    transition: function transition(e) {
      "string" != typeof e && (e += "ms");

      for (var t = 0; t < this.length; t += 1) {
        var i = this[t].style;
        i.webkitTransitionDuration = e, i.transitionDuration = e;
      }

      return this;
    },
    on: function on() {
      for (var e, t = [], i = arguments.length; i--;) {
        t[i] = arguments[i];
      }

      var a = t[0],
          r = t[1],
          n = t[2],
          o = t[3];

      function l(e) {
        var t = e.target;

        if (t) {
          var i = e.target.dom7EventData || [];
          if (i.indexOf(e) < 0 && i.unshift(e), s(t).is(r)) n.apply(t, i);else for (var a = s(t).parents(), o = 0; o < a.length; o += 1) {
            s(a[o]).is(r) && n.apply(a[o], i);
          }
        }
      }

      function d(e) {
        var t = e && e.target && e.target.dom7EventData || [];
        t.indexOf(e) < 0 && t.unshift(e), n.apply(this, t);
      }

      "function" == typeof t[1] && (a = (e = t)[0], n = e[1], o = e[2], r = void 0), o || (o = !1);

      for (var h, p = a.split(" "), c = 0; c < this.length; c += 1) {
        var u = this[c];
        if (r) for (h = 0; h < p.length; h += 1) {
          var v = p[h];
          u.dom7LiveListeners || (u.dom7LiveListeners = {}), u.dom7LiveListeners[v] || (u.dom7LiveListeners[v] = []), u.dom7LiveListeners[v].push({
            listener: n,
            proxyListener: l
          }), u.addEventListener(v, l, o);
        } else for (h = 0; h < p.length; h += 1) {
          var f = p[h];
          u.dom7Listeners || (u.dom7Listeners = {}), u.dom7Listeners[f] || (u.dom7Listeners[f] = []), u.dom7Listeners[f].push({
            listener: n,
            proxyListener: d
          }), u.addEventListener(f, d, o);
        }
      }

      return this;
    },
    off: function off() {
      for (var e, t = [], i = arguments.length; i--;) {
        t[i] = arguments[i];
      }

      var s = t[0],
          a = t[1],
          r = t[2],
          n = t[3];
      "function" == typeof t[1] && (s = (e = t)[0], r = e[1], n = e[2], a = void 0), n || (n = !1);

      for (var o = s.split(" "), l = 0; l < o.length; l += 1) {
        for (var d = o[l], h = 0; h < this.length; h += 1) {
          var p = this[h],
              c = void 0;
          if (!a && p.dom7Listeners ? c = p.dom7Listeners[d] : a && p.dom7LiveListeners && (c = p.dom7LiveListeners[d]), c && c.length) for (var u = c.length - 1; u >= 0; u -= 1) {
            var v = c[u];
            r && v.listener === r ? (p.removeEventListener(d, v.proxyListener, n), c.splice(u, 1)) : r && v.listener && v.listener.dom7proxy && v.listener.dom7proxy === r ? (p.removeEventListener(d, v.proxyListener, n), c.splice(u, 1)) : r || (p.removeEventListener(d, v.proxyListener, n), c.splice(u, 1));
          }
        }
      }

      return this;
    },
    trigger: function trigger() {
      for (var i = [], s = arguments.length; s--;) {
        i[s] = arguments[s];
      }

      for (var a = i[0].split(" "), r = i[1], n = 0; n < a.length; n += 1) {
        for (var o = a[n], l = 0; l < this.length; l += 1) {
          var d = this[l],
              h = void 0;

          try {
            h = new t.CustomEvent(o, {
              detail: r,
              bubbles: !0,
              cancelable: !0
            });
          } catch (t) {
            (h = e.createEvent("Event")).initEvent(o, !0, !0), h.detail = r;
          }

          d.dom7EventData = i.filter(function (e, t) {
            return t > 0;
          }), d.dispatchEvent(h), d.dom7EventData = [], delete d.dom7EventData;
        }
      }

      return this;
    },
    transitionEnd: function transitionEnd(e) {
      var t,
          i = ["webkitTransitionEnd", "transitionend"],
          s = this;

      function a(r) {
        if (r.target === this) for (e.call(this, r), t = 0; t < i.length; t += 1) {
          s.off(i[t], a);
        }
      }

      if (e) for (t = 0; t < i.length; t += 1) {
        s.on(i[t], a);
      }
      return this;
    },
    outerWidth: function outerWidth(e) {
      if (this.length > 0) {
        if (e) {
          var t = this.styles();
          return this[0].offsetWidth + parseFloat(t.getPropertyValue("margin-right")) + parseFloat(t.getPropertyValue("margin-left"));
        }

        return this[0].offsetWidth;
      }

      return null;
    },
    outerHeight: function outerHeight(e) {
      if (this.length > 0) {
        if (e) {
          var t = this.styles();
          return this[0].offsetHeight + parseFloat(t.getPropertyValue("margin-top")) + parseFloat(t.getPropertyValue("margin-bottom"));
        }

        return this[0].offsetHeight;
      }

      return null;
    },
    offset: function offset() {
      if (this.length > 0) {
        var i = this[0],
            s = i.getBoundingClientRect(),
            a = e.body,
            r = i.clientTop || a.clientTop || 0,
            n = i.clientLeft || a.clientLeft || 0,
            o = i === t ? t.scrollY : i.scrollTop,
            l = i === t ? t.scrollX : i.scrollLeft;
        return {
          top: s.top + o - r,
          left: s.left + l - n
        };
      }

      return null;
    },
    css: function css(e, i) {
      var s;

      if (1 === arguments.length) {
        if ("string" != typeof e) {
          for (s = 0; s < this.length; s += 1) {
            for (var a in e) {
              this[s].style[a] = e[a];
            }
          }

          return this;
        }

        if (this[0]) return t.getComputedStyle(this[0], null).getPropertyValue(e);
      }

      if (2 === arguments.length && "string" == typeof e) {
        for (s = 0; s < this.length; s += 1) {
          this[s].style[e] = i;
        }

        return this;
      }

      return this;
    },
    each: function each(e) {
      if (!e) return this;

      for (var t = 0; t < this.length; t += 1) {
        if (!1 === e.call(this[t], t, this[t])) return this;
      }

      return this;
    },
    html: function html(e) {
      if (void 0 === e) return this[0] ? this[0].innerHTML : void 0;

      for (var t = 0; t < this.length; t += 1) {
        this[t].innerHTML = e;
      }

      return this;
    },
    text: function text(e) {
      if (void 0 === e) return this[0] ? this[0].textContent.trim() : null;

      for (var t = 0; t < this.length; t += 1) {
        this[t].textContent = e;
      }

      return this;
    },
    is: function is(a) {
      var r,
          n,
          o = this[0];
      if (!o || void 0 === a) return !1;

      if ("string" == typeof a) {
        if (o.matches) return o.matches(a);
        if (o.webkitMatchesSelector) return o.webkitMatchesSelector(a);
        if (o.msMatchesSelector) return o.msMatchesSelector(a);

        for (r = s(a), n = 0; n < r.length; n += 1) {
          if (r[n] === o) return !0;
        }

        return !1;
      }

      if (a === e) return o === e;
      if (a === t) return o === t;

      if (a.nodeType || a instanceof i) {
        for (r = a.nodeType ? [a] : a, n = 0; n < r.length; n += 1) {
          if (r[n] === o) return !0;
        }

        return !1;
      }

      return !1;
    },
    index: function index() {
      var e,
          t = this[0];

      if (t) {
        for (e = 0; null !== (t = t.previousSibling);) {
          1 === t.nodeType && (e += 1);
        }

        return e;
      }
    },
    eq: function eq(e) {
      if (void 0 === e) return this;
      var t,
          s = this.length;
      return new i(e > s - 1 ? [] : e < 0 ? (t = s + e) < 0 ? [] : [this[t]] : [this[e]]);
    },
    append: function append() {
      for (var t, s = [], a = arguments.length; a--;) {
        s[a] = arguments[a];
      }

      for (var r = 0; r < s.length; r += 1) {
        t = s[r];

        for (var n = 0; n < this.length; n += 1) {
          if ("string" == typeof t) {
            var o = e.createElement("div");

            for (o.innerHTML = t; o.firstChild;) {
              this[n].appendChild(o.firstChild);
            }
          } else if (t instanceof i) for (var l = 0; l < t.length; l += 1) {
            this[n].appendChild(t[l]);
          } else this[n].appendChild(t);
        }
      }

      return this;
    },
    prepend: function prepend(t) {
      var s, a;

      for (s = 0; s < this.length; s += 1) {
        if ("string" == typeof t) {
          var r = e.createElement("div");

          for (r.innerHTML = t, a = r.childNodes.length - 1; a >= 0; a -= 1) {
            this[s].insertBefore(r.childNodes[a], this[s].childNodes[0]);
          }
        } else if (t instanceof i) for (a = 0; a < t.length; a += 1) {
          this[s].insertBefore(t[a], this[s].childNodes[0]);
        } else this[s].insertBefore(t, this[s].childNodes[0]);
      }

      return this;
    },
    next: function next(e) {
      return this.length > 0 ? e ? this[0].nextElementSibling && s(this[0].nextElementSibling).is(e) ? new i([this[0].nextElementSibling]) : new i([]) : this[0].nextElementSibling ? new i([this[0].nextElementSibling]) : new i([]) : new i([]);
    },
    nextAll: function nextAll(e) {
      var t = [],
          a = this[0];
      if (!a) return new i([]);

      for (; a.nextElementSibling;) {
        var r = a.nextElementSibling;
        e ? s(r).is(e) && t.push(r) : t.push(r), a = r;
      }

      return new i(t);
    },
    prev: function prev(e) {
      if (this.length > 0) {
        var t = this[0];
        return e ? t.previousElementSibling && s(t.previousElementSibling).is(e) ? new i([t.previousElementSibling]) : new i([]) : t.previousElementSibling ? new i([t.previousElementSibling]) : new i([]);
      }

      return new i([]);
    },
    prevAll: function prevAll(e) {
      var t = [],
          a = this[0];
      if (!a) return new i([]);

      for (; a.previousElementSibling;) {
        var r = a.previousElementSibling;
        e ? s(r).is(e) && t.push(r) : t.push(r), a = r;
      }

      return new i(t);
    },
    parent: function parent(e) {
      for (var t = [], i = 0; i < this.length; i += 1) {
        null !== this[i].parentNode && (e ? s(this[i].parentNode).is(e) && t.push(this[i].parentNode) : t.push(this[i].parentNode));
      }

      return s(a(t));
    },
    parents: function parents(e) {
      for (var t = [], i = 0; i < this.length; i += 1) {
        for (var r = this[i].parentNode; r;) {
          e ? s(r).is(e) && t.push(r) : t.push(r), r = r.parentNode;
        }
      }

      return s(a(t));
    },
    closest: function closest(e) {
      var t = this;
      return void 0 === e ? new i([]) : (t.is(e) || (t = t.parents(e).eq(0)), t);
    },
    find: function find(e) {
      for (var t = [], s = 0; s < this.length; s += 1) {
        for (var a = this[s].querySelectorAll(e), r = 0; r < a.length; r += 1) {
          t.push(a[r]);
        }
      }

      return new i(t);
    },
    children: function children(e) {
      for (var t = [], r = 0; r < this.length; r += 1) {
        for (var n = this[r].childNodes, o = 0; o < n.length; o += 1) {
          e ? 1 === n[o].nodeType && s(n[o]).is(e) && t.push(n[o]) : 1 === n[o].nodeType && t.push(n[o]);
        }
      }

      return new i(a(t));
    },
    filter: function filter(e) {
      for (var t = [], s = 0; s < this.length; s += 1) {
        e.call(this[s], s, this[s]) && t.push(this[s]);
      }

      return new i(t);
    },
    remove: function remove() {
      for (var e = 0; e < this.length; e += 1) {
        this[e].parentNode && this[e].parentNode.removeChild(this[e]);
      }

      return this;
    },
    add: function add() {
      for (var e = [], t = arguments.length; t--;) {
        e[t] = arguments[t];
      }

      var i, a;

      for (i = 0; i < e.length; i += 1) {
        var r = s(e[i]);

        for (a = 0; a < r.length; a += 1) {
          this[this.length] = r[a], this.length += 1;
        }
      }

      return this;
    },
    styles: function styles() {
      return this[0] ? t.getComputedStyle(this[0], null) : {};
    }
  };
  Object.keys(r).forEach(function (e) {
    s.fn[e] = s.fn[e] || r[e];
  });

  var n = {
    deleteProps: function deleteProps(e) {
      var t = e;
      Object.keys(t).forEach(function (e) {
        try {
          t[e] = null;
        } catch (e) {}

        try {
          delete t[e];
        } catch (e) {}
      });
    },
    nextTick: function nextTick(e, t) {
      return void 0 === t && (t = 0), setTimeout(e, t);
    },
    now: function now() {
      return Date.now();
    },
    getTranslate: function getTranslate(e, i) {
      var s, a, r;
      void 0 === i && (i = "x");
      var n = t.getComputedStyle(e, null);
      return t.WebKitCSSMatrix ? ((a = n.transform || n.webkitTransform).split(",").length > 6 && (a = a.split(", ").map(function (e) {
        return e.replace(",", ".");
      }).join(", ")), r = new t.WebKitCSSMatrix("none" === a ? "" : a)) : s = (r = n.MozTransform || n.OTransform || n.MsTransform || n.msTransform || n.transform || n.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,")).toString().split(","), "x" === i && (a = t.WebKitCSSMatrix ? r.m41 : 16 === s.length ? parseFloat(s[12]) : parseFloat(s[4])), "y" === i && (a = t.WebKitCSSMatrix ? r.m42 : 16 === s.length ? parseFloat(s[13]) : parseFloat(s[5])), a || 0;
    },
    parseUrlQuery: function parseUrlQuery(e) {
      var i,
          s,
          a,
          r,
          n = {},
          o = e || t.location.href;
      if ("string" == typeof o && o.length) for (r = (s = (o = o.indexOf("?") > -1 ? o.replace(/\S*\?/, "") : "").split("&").filter(function (e) {
        return "" !== e;
      })).length, i = 0; i < r; i += 1) {
        a = s[i].replace(/#\S+/g, "").split("="), n[decodeURIComponent(a[0])] = void 0 === a[1] ? void 0 : decodeURIComponent(a[1]) || "";
      }
      return n;
    },
    isObject: function isObject(e) {
      return "object" == _typeof(e) && null !== e && e.constructor && e.constructor === Object;
    },
    extend: function extend() {
      for (var e = [], t = arguments.length; t--;) {
        e[t] = arguments[t];
      }

      for (var i = Object(e[0]), s = 1; s < e.length; s += 1) {
        var a = e[s];
        if (null != a) for (var r = Object.keys(Object(a)), o = 0, l = r.length; o < l; o += 1) {
          var d = r[o],
              h = Object.getOwnPropertyDescriptor(a, d);
          void 0 !== h && h.enumerable && (n.isObject(i[d]) && n.isObject(a[d]) ? n.extend(i[d], a[d]) : !n.isObject(i[d]) && n.isObject(a[d]) ? (i[d] = {}, n.extend(i[d], a[d])) : i[d] = a[d]);
        }
      }

      return i;
    }
  },
      o = {
    touch: t.Modernizr && !0 === t.Modernizr.touch || !!(t.navigator.maxTouchPoints > 0 || "ontouchstart" in t || t.DocumentTouch && e instanceof t.DocumentTouch),
    pointerEvents: !!t.PointerEvent && "maxTouchPoints" in t.navigator && t.navigator.maxTouchPoints > 0,
    observer: "MutationObserver" in t || "WebkitMutationObserver" in t,
    passiveListener: function () {
      var e = !1;

      try {
        var i = Object.defineProperty({}, "passive", {
          get: function get() {
            e = !0;
          }
        });
        t.addEventListener("testPassiveListener", null, i);
      } catch (e) {}

      return e;
    }(),
    gestures: "ongesturestart" in t
  },
      l = function l(e) {
    void 0 === e && (e = {});
    var t = this;
    t.params = e, t.eventsListeners = {}, t.params && t.params.on && Object.keys(t.params.on).forEach(function (e) {
      t.on(e, t.params.on[e]);
    });
  },
      d = {
    components: {
      configurable: !0
    }
  };

  l.prototype.on = function (e, t, i) {
    var s = this;
    if ("function" != typeof t) return s;
    var a = i ? "unshift" : "push";
    return e.split(" ").forEach(function (e) {
      s.eventsListeners[e] || (s.eventsListeners[e] = []), s.eventsListeners[e][a](t);
    }), s;
  }, l.prototype.once = function (e, t, i) {
    var s = this;
    if ("function" != typeof t) return s;

    function a() {
      for (var i = [], r = arguments.length; r--;) {
        i[r] = arguments[r];
      }

      s.off(e, a), a.f7proxy && delete a.f7proxy, t.apply(s, i);
    }

    return a.f7proxy = t, s.on(e, a, i);
  }, l.prototype.off = function (e, t) {
    var i = this;
    return i.eventsListeners ? (e.split(" ").forEach(function (e) {
      void 0 === t ? i.eventsListeners[e] = [] : i.eventsListeners[e] && i.eventsListeners[e].length && i.eventsListeners[e].forEach(function (s, a) {
        (s === t || s.f7proxy && s.f7proxy === t) && i.eventsListeners[e].splice(a, 1);
      });
    }), i) : i;
  }, l.prototype.emit = function () {
    for (var e = [], t = arguments.length; t--;) {
      e[t] = arguments[t];
    }

    var i,
        s,
        a,
        r = this;
    if (!r.eventsListeners) return r;
    "string" == typeof e[0] || Array.isArray(e[0]) ? (i = e[0], s = e.slice(1, e.length), a = r) : (i = e[0].events, s = e[0].data, a = e[0].context || r);
    var n = Array.isArray(i) ? i : i.split(" ");
    return n.forEach(function (e) {
      if (r.eventsListeners && r.eventsListeners[e]) {
        var t = [];
        r.eventsListeners[e].forEach(function (e) {
          t.push(e);
        }), t.forEach(function (e) {
          e.apply(a, s);
        });
      }
    }), r;
  }, l.prototype.useModulesParams = function (e) {
    var t = this;
    t.modules && Object.keys(t.modules).forEach(function (i) {
      var s = t.modules[i];
      s.params && n.extend(e, s.params);
    });
  }, l.prototype.useModules = function (e) {
    void 0 === e && (e = {});
    var t = this;
    t.modules && Object.keys(t.modules).forEach(function (i) {
      var s = t.modules[i],
          a = e[i] || {};
      s.instance && Object.keys(s.instance).forEach(function (e) {
        var i = s.instance[e];
        t[e] = "function" == typeof i ? i.bind(t) : i;
      }), s.on && t.on && Object.keys(s.on).forEach(function (e) {
        t.on(e, s.on[e]);
      }), s.create && s.create.bind(t)(a);
    });
  }, d.components.set = function (e) {
    this.use && this.use(e);
  }, l.installModule = function (e) {
    for (var t = [], i = arguments.length - 1; i-- > 0;) {
      t[i] = arguments[i + 1];
    }

    var s = this;
    s.prototype.modules || (s.prototype.modules = {});
    var a = e.name || Object.keys(s.prototype.modules).length + "_" + n.now();
    return s.prototype.modules[a] = e, e.proto && Object.keys(e.proto).forEach(function (t) {
      s.prototype[t] = e.proto[t];
    }), e["static"] && Object.keys(e["static"]).forEach(function (t) {
      s[t] = e["static"][t];
    }), e.install && e.install.apply(s, t), s;
  }, l.use = function (e) {
    for (var t = [], i = arguments.length - 1; i-- > 0;) {
      t[i] = arguments[i + 1];
    }

    var s = this;
    return Array.isArray(e) ? (e.forEach(function (e) {
      return s.installModule(e);
    }), s) : s.installModule.apply(s, [e].concat(t));
  }, Object.defineProperties(l, d);
  var h = {
    updateSize: function updateSize() {
      var e,
          t,
          i = this.$el;
      e = void 0 !== this.params.width ? this.params.width : i[0].clientWidth, t = void 0 !== this.params.height ? this.params.height : i[0].clientHeight, 0 === e && this.isHorizontal() || 0 === t && this.isVertical() || (e = e - parseInt(i.css("padding-left"), 10) - parseInt(i.css("padding-right"), 10), t = t - parseInt(i.css("padding-top"), 10) - parseInt(i.css("padding-bottom"), 10), n.extend(this, {
        width: e,
        height: t,
        size: this.isHorizontal() ? e : t
      }));
    },
    updateSlides: function updateSlides() {
      var e = this.params,
          i = this.$wrapperEl,
          s = this.size,
          a = this.rtlTranslate,
          r = this.wrongRTL,
          o = this.virtual && e.virtual.enabled,
          l = o ? this.virtual.slides.length : this.slides.length,
          d = i.children("." + this.params.slideClass),
          h = o ? this.virtual.slides.length : d.length,
          p = [],
          c = [],
          u = [];

      function v(t) {
        return !e.cssMode || t !== d.length - 1;
      }

      var f = e.slidesOffsetBefore;
      "function" == typeof f && (f = e.slidesOffsetBefore.call(this));
      var m = e.slidesOffsetAfter;
      "function" == typeof m && (m = e.slidesOffsetAfter.call(this));
      var g = this.snapGrid.length,
          b = this.snapGrid.length,
          w = e.spaceBetween,
          y = -f,
          x = 0,
          T = 0;

      if (void 0 !== s) {
        var E, S;
        "string" == typeof w && w.indexOf("%") >= 0 && (w = parseFloat(w.replace("%", "")) / 100 * s), this.virtualSize = -w, a ? d.css({
          marginLeft: "",
          marginTop: ""
        }) : d.css({
          marginRight: "",
          marginBottom: ""
        }), e.slidesPerColumn > 1 && (E = Math.floor(h / e.slidesPerColumn) === h / this.params.slidesPerColumn ? h : Math.ceil(h / e.slidesPerColumn) * e.slidesPerColumn, "auto" !== e.slidesPerView && "row" === e.slidesPerColumnFill && (E = Math.max(E, e.slidesPerView * e.slidesPerColumn)));

        for (var C, M = e.slidesPerColumn, P = E / M, z = Math.floor(h / e.slidesPerColumn), k = 0; k < h; k += 1) {
          S = 0;
          var $ = d.eq(k);

          if (e.slidesPerColumn > 1) {
            var L = void 0,
                I = void 0,
                D = void 0;

            if ("row" === e.slidesPerColumnFill && e.slidesPerGroup > 1) {
              var O = Math.floor(k / (e.slidesPerGroup * e.slidesPerColumn)),
                  A = k - e.slidesPerColumn * e.slidesPerGroup * O,
                  G = 0 === O ? e.slidesPerGroup : Math.min(Math.ceil((h - O * M * e.slidesPerGroup) / M), e.slidesPerGroup);
              L = (I = A - (D = Math.floor(A / G)) * G + O * e.slidesPerGroup) + D * E / M, $.css({
                "-webkit-box-ordinal-group": L,
                "-moz-box-ordinal-group": L,
                "-ms-flex-order": L,
                "-webkit-order": L,
                order: L
              });
            } else "column" === e.slidesPerColumnFill ? (D = k - (I = Math.floor(k / M)) * M, (I > z || I === z && D === M - 1) && (D += 1) >= M && (D = 0, I += 1)) : I = k - (D = Math.floor(k / P)) * P;

            $.css("margin-" + (this.isHorizontal() ? "top" : "left"), 0 !== D && e.spaceBetween && e.spaceBetween + "px");
          }

          if ("none" !== $.css("display")) {
            if ("auto" === e.slidesPerView) {
              var B = t.getComputedStyle($[0], null),
                  H = $[0].style.transform,
                  N = $[0].style.webkitTransform;
              if (H && ($[0].style.transform = "none"), N && ($[0].style.webkitTransform = "none"), e.roundLengths) S = this.isHorizontal() ? $.outerWidth(!0) : $.outerHeight(!0);else if (this.isHorizontal()) {
                var X = parseFloat(B.getPropertyValue("width")),
                    V = parseFloat(B.getPropertyValue("padding-left")),
                    Y = parseFloat(B.getPropertyValue("padding-right")),
                    F = parseFloat(B.getPropertyValue("margin-left")),
                    W = parseFloat(B.getPropertyValue("margin-right")),
                    R = B.getPropertyValue("box-sizing");
                S = R && "border-box" === R ? X + F + W : X + V + Y + F + W;
              } else {
                var q = parseFloat(B.getPropertyValue("height")),
                    j = parseFloat(B.getPropertyValue("padding-top")),
                    K = parseFloat(B.getPropertyValue("padding-bottom")),
                    U = parseFloat(B.getPropertyValue("margin-top")),
                    _ = parseFloat(B.getPropertyValue("margin-bottom")),
                    Z = B.getPropertyValue("box-sizing");

                S = Z && "border-box" === Z ? q + U + _ : q + j + K + U + _;
              }
              H && ($[0].style.transform = H), N && ($[0].style.webkitTransform = N), e.roundLengths && (S = Math.floor(S));
            } else S = (s - (e.slidesPerView - 1) * w) / e.slidesPerView, e.roundLengths && (S = Math.floor(S)), d[k] && (this.isHorizontal() ? d[k].style.width = S + "px" : d[k].style.height = S + "px");

            d[k] && (d[k].swiperSlideSize = S), u.push(S), e.centeredSlides ? (y = y + S / 2 + x / 2 + w, 0 === x && 0 !== k && (y = y - s / 2 - w), 0 === k && (y = y - s / 2 - w), Math.abs(y) < .001 && (y = 0), e.roundLengths && (y = Math.floor(y)), T % e.slidesPerGroup == 0 && p.push(y), c.push(y)) : (e.roundLengths && (y = Math.floor(y)), (T - Math.min(this.params.slidesPerGroupSkip, T)) % this.params.slidesPerGroup == 0 && p.push(y), c.push(y), y = y + S + w), this.virtualSize += S + w, x = S, T += 1;
          }
        }

        if (this.virtualSize = Math.max(this.virtualSize, s) + m, a && r && ("slide" === e.effect || "coverflow" === e.effect) && i.css({
          width: this.virtualSize + e.spaceBetween + "px"
        }), e.setWrapperSize && (this.isHorizontal() ? i.css({
          width: this.virtualSize + e.spaceBetween + "px"
        }) : i.css({
          height: this.virtualSize + e.spaceBetween + "px"
        })), e.slidesPerColumn > 1 && (this.virtualSize = (S + e.spaceBetween) * E, this.virtualSize = Math.ceil(this.virtualSize / e.slidesPerColumn) - e.spaceBetween, this.isHorizontal() ? i.css({
          width: this.virtualSize + e.spaceBetween + "px"
        }) : i.css({
          height: this.virtualSize + e.spaceBetween + "px"
        }), e.centeredSlides)) {
          C = [];

          for (var Q = 0; Q < p.length; Q += 1) {
            var J = p[Q];
            e.roundLengths && (J = Math.floor(J)), p[Q] < this.virtualSize + p[0] && C.push(J);
          }

          p = C;
        }

        if (!e.centeredSlides) {
          C = [];

          for (var ee = 0; ee < p.length; ee += 1) {
            var te = p[ee];
            e.roundLengths && (te = Math.floor(te)), p[ee] <= this.virtualSize - s && C.push(te);
          }

          p = C, Math.floor(this.virtualSize - s) - Math.floor(p[p.length - 1]) > 1 && p.push(this.virtualSize - s);
        }

        if (0 === p.length && (p = [0]), 0 !== e.spaceBetween && (this.isHorizontal() ? a ? d.filter(v).css({
          marginLeft: w + "px"
        }) : d.filter(v).css({
          marginRight: w + "px"
        }) : d.filter(v).css({
          marginBottom: w + "px"
        })), e.centeredSlides && e.centeredSlidesBounds) {
          var ie = 0;
          u.forEach(function (t) {
            ie += t + (e.spaceBetween ? e.spaceBetween : 0);
          });
          var se = (ie -= e.spaceBetween) - s;
          p = p.map(function (e) {
            return e < 0 ? -f : e > se ? se + m : e;
          });
        }

        if (e.centerInsufficientSlides) {
          var ae = 0;

          if (u.forEach(function (t) {
            ae += t + (e.spaceBetween ? e.spaceBetween : 0);
          }), (ae -= e.spaceBetween) < s) {
            var re = (s - ae) / 2;
            p.forEach(function (e, t) {
              p[t] = e - re;
            }), c.forEach(function (e, t) {
              c[t] = e + re;
            });
          }
        }

        n.extend(this, {
          slides: d,
          snapGrid: p,
          slidesGrid: c,
          slidesSizesGrid: u
        }), h !== l && this.emit("slidesLengthChange"), p.length !== g && (this.params.watchOverflow && this.checkOverflow(), this.emit("snapGridLengthChange")), c.length !== b && this.emit("slidesGridLengthChange"), (e.watchSlidesProgress || e.watchSlidesVisibility) && this.updateSlidesOffset();
      }
    },
    updateAutoHeight: function updateAutoHeight(e) {
      var t,
          i = [],
          s = 0;
      if ("number" == typeof e ? this.setTransition(e) : !0 === e && this.setTransition(this.params.speed), "auto" !== this.params.slidesPerView && this.params.slidesPerView > 1) for (t = 0; t < Math.ceil(this.params.slidesPerView); t += 1) {
        var a = this.activeIndex + t;
        if (a > this.slides.length) break;
        i.push(this.slides.eq(a)[0]);
      } else i.push(this.slides.eq(this.activeIndex)[0]);

      for (t = 0; t < i.length; t += 1) {
        if (void 0 !== i[t]) {
          var r = i[t].offsetHeight;
          s = r > s ? r : s;
        }
      }

      s && this.$wrapperEl.css("height", s + "px");
    },
    updateSlidesOffset: function updateSlidesOffset() {
      for (var e = this.slides, t = 0; t < e.length; t += 1) {
        e[t].swiperSlideOffset = this.isHorizontal() ? e[t].offsetLeft : e[t].offsetTop;
      }
    },
    updateSlidesProgress: function updateSlidesProgress(e) {
      void 0 === e && (e = this && this.translate || 0);
      var t = this.params,
          i = this.slides,
          a = this.rtlTranslate;

      if (0 !== i.length) {
        void 0 === i[0].swiperSlideOffset && this.updateSlidesOffset();
        var r = -e;
        a && (r = e), i.removeClass(t.slideVisibleClass), this.visibleSlidesIndexes = [], this.visibleSlides = [];

        for (var n = 0; n < i.length; n += 1) {
          var o = i[n],
              l = (r + (t.centeredSlides ? this.minTranslate() : 0) - o.swiperSlideOffset) / (o.swiperSlideSize + t.spaceBetween);

          if (t.watchSlidesVisibility) {
            var d = -(r - o.swiperSlideOffset),
                h = d + this.slidesSizesGrid[n];
            (d >= 0 && d < this.size - 1 || h > 1 && h <= this.size || d <= 0 && h >= this.size) && (this.visibleSlides.push(o), this.visibleSlidesIndexes.push(n), i.eq(n).addClass(t.slideVisibleClass));
          }

          o.progress = a ? -l : l;
        }

        this.visibleSlides = s(this.visibleSlides);
      }
    },
    updateProgress: function updateProgress(e) {
      if (void 0 === e) {
        var t = this.rtlTranslate ? -1 : 1;
        e = this && this.translate && this.translate * t || 0;
      }

      var i = this.params,
          s = this.maxTranslate() - this.minTranslate(),
          a = this.progress,
          r = this.isBeginning,
          o = this.isEnd,
          l = r,
          d = o;
      0 === s ? (a = 0, r = !0, o = !0) : (r = (a = (e - this.minTranslate()) / s) <= 0, o = a >= 1), n.extend(this, {
        progress: a,
        isBeginning: r,
        isEnd: o
      }), (i.watchSlidesProgress || i.watchSlidesVisibility) && this.updateSlidesProgress(e), r && !l && this.emit("reachBeginning toEdge"), o && !d && this.emit("reachEnd toEdge"), (l && !r || d && !o) && this.emit("fromEdge"), this.emit("progress", a);
    },
    updateSlidesClasses: function updateSlidesClasses() {
      var e,
          t = this.slides,
          i = this.params,
          s = this.$wrapperEl,
          a = this.activeIndex,
          r = this.realIndex,
          n = this.virtual && i.virtual.enabled;
      t.removeClass(i.slideActiveClass + " " + i.slideNextClass + " " + i.slidePrevClass + " " + i.slideDuplicateActiveClass + " " + i.slideDuplicateNextClass + " " + i.slideDuplicatePrevClass), (e = n ? this.$wrapperEl.find("." + i.slideClass + '[data-swiper-slide-index="' + a + '"]') : t.eq(a)).addClass(i.slideActiveClass), i.loop && (e.hasClass(i.slideDuplicateClass) ? s.children("." + i.slideClass + ":not(." + i.slideDuplicateClass + ')[data-swiper-slide-index="' + r + '"]').addClass(i.slideDuplicateActiveClass) : s.children("." + i.slideClass + "." + i.slideDuplicateClass + '[data-swiper-slide-index="' + r + '"]').addClass(i.slideDuplicateActiveClass));
      var o = e.nextAll("." + i.slideClass).eq(0).addClass(i.slideNextClass);
      i.loop && 0 === o.length && (o = t.eq(0)).addClass(i.slideNextClass);
      var l = e.prevAll("." + i.slideClass).eq(0).addClass(i.slidePrevClass);
      i.loop && 0 === l.length && (l = t.eq(-1)).addClass(i.slidePrevClass), i.loop && (o.hasClass(i.slideDuplicateClass) ? s.children("." + i.slideClass + ":not(." + i.slideDuplicateClass + ')[data-swiper-slide-index="' + o.attr("data-swiper-slide-index") + '"]').addClass(i.slideDuplicateNextClass) : s.children("." + i.slideClass + "." + i.slideDuplicateClass + '[data-swiper-slide-index="' + o.attr("data-swiper-slide-index") + '"]').addClass(i.slideDuplicateNextClass), l.hasClass(i.slideDuplicateClass) ? s.children("." + i.slideClass + ":not(." + i.slideDuplicateClass + ')[data-swiper-slide-index="' + l.attr("data-swiper-slide-index") + '"]').addClass(i.slideDuplicatePrevClass) : s.children("." + i.slideClass + "." + i.slideDuplicateClass + '[data-swiper-slide-index="' + l.attr("data-swiper-slide-index") + '"]').addClass(i.slideDuplicatePrevClass));
    },
    updateActiveIndex: function updateActiveIndex(e) {
      var t,
          i = this.rtlTranslate ? this.translate : -this.translate,
          s = this.slidesGrid,
          a = this.snapGrid,
          r = this.params,
          o = this.activeIndex,
          l = this.realIndex,
          d = this.snapIndex,
          h = e;

      if (void 0 === h) {
        for (var p = 0; p < s.length; p += 1) {
          void 0 !== s[p + 1] ? i >= s[p] && i < s[p + 1] - (s[p + 1] - s[p]) / 2 ? h = p : i >= s[p] && i < s[p + 1] && (h = p + 1) : i >= s[p] && (h = p);
        }

        r.normalizeSlideIndex && (h < 0 || void 0 === h) && (h = 0);
      }

      if (a.indexOf(i) >= 0) t = a.indexOf(i);else {
        var c = Math.min(r.slidesPerGroupSkip, h);
        t = c + Math.floor((h - c) / r.slidesPerGroup);
      }

      if (t >= a.length && (t = a.length - 1), h !== o) {
        var u = parseInt(this.slides.eq(h).attr("data-swiper-slide-index") || h, 10);
        n.extend(this, {
          snapIndex: t,
          realIndex: u,
          previousIndex: o,
          activeIndex: h
        }), this.emit("activeIndexChange"), this.emit("snapIndexChange"), l !== u && this.emit("realIndexChange"), (this.initialized || this.runCallbacksOnInit) && this.emit("slideChange");
      } else t !== d && (this.snapIndex = t, this.emit("snapIndexChange"));
    },
    updateClickedSlide: function updateClickedSlide(e) {
      var t = this.params,
          i = s(e.target).closest("." + t.slideClass)[0],
          a = !1;
      if (i) for (var r = 0; r < this.slides.length; r += 1) {
        this.slides[r] === i && (a = !0);
      }
      if (!i || !a) return this.clickedSlide = void 0, void (this.clickedIndex = void 0);
      this.clickedSlide = i, this.virtual && this.params.virtual.enabled ? this.clickedIndex = parseInt(s(i).attr("data-swiper-slide-index"), 10) : this.clickedIndex = s(i).index(), t.slideToClickedSlide && void 0 !== this.clickedIndex && this.clickedIndex !== this.activeIndex && this.slideToClickedSlide();
    }
  };
  var p = {
    getTranslate: function getTranslate(e) {
      void 0 === e && (e = this.isHorizontal() ? "x" : "y");
      var t = this.params,
          i = this.rtlTranslate,
          s = this.translate,
          a = this.$wrapperEl;
      if (t.virtualTranslate) return i ? -s : s;
      if (t.cssMode) return s;
      var r = n.getTranslate(a[0], e);
      return i && (r = -r), r || 0;
    },
    setTranslate: function setTranslate(e, t) {
      var i = this.rtlTranslate,
          s = this.params,
          a = this.$wrapperEl,
          r = this.wrapperEl,
          n = this.progress,
          o = 0,
          l = 0;
      this.isHorizontal() ? o = i ? -e : e : l = e, s.roundLengths && (o = Math.floor(o), l = Math.floor(l)), s.cssMode ? r[this.isHorizontal() ? "scrollLeft" : "scrollTop"] = this.isHorizontal() ? -o : -l : s.virtualTranslate || a.transform("translate3d(" + o + "px, " + l + "px, 0px)"), this.previousTranslate = this.translate, this.translate = this.isHorizontal() ? o : l;
      var d = this.maxTranslate() - this.minTranslate();
      (0 === d ? 0 : (e - this.minTranslate()) / d) !== n && this.updateProgress(e), this.emit("setTranslate", this.translate, t);
    },
    minTranslate: function minTranslate() {
      return -this.snapGrid[0];
    },
    maxTranslate: function maxTranslate() {
      return -this.snapGrid[this.snapGrid.length - 1];
    },
    translateTo: function translateTo(e, t, i, s, a) {
      var r;
      void 0 === e && (e = 0), void 0 === t && (t = this.params.speed), void 0 === i && (i = !0), void 0 === s && (s = !0);
      var n = this,
          o = n.params,
          l = n.wrapperEl;
      if (n.animating && o.preventInteractionOnTransition) return !1;
      var d,
          h = n.minTranslate(),
          p = n.maxTranslate();

      if (d = s && e > h ? h : s && e < p ? p : e, n.updateProgress(d), o.cssMode) {
        var c = n.isHorizontal();
        return 0 === t ? l[c ? "scrollLeft" : "scrollTop"] = -d : l.scrollTo ? l.scrollTo(((r = {})[c ? "left" : "top"] = -d, r.behavior = "smooth", r)) : l[c ? "scrollLeft" : "scrollTop"] = -d, !0;
      }

      return 0 === t ? (n.setTransition(0), n.setTranslate(d), i && (n.emit("beforeTransitionStart", t, a), n.emit("transitionEnd"))) : (n.setTransition(t), n.setTranslate(d), i && (n.emit("beforeTransitionStart", t, a), n.emit("transitionStart")), n.animating || (n.animating = !0, n.onTranslateToWrapperTransitionEnd || (n.onTranslateToWrapperTransitionEnd = function (e) {
        n && !n.destroyed && e.target === this && (n.$wrapperEl[0].removeEventListener("transitionend", n.onTranslateToWrapperTransitionEnd), n.$wrapperEl[0].removeEventListener("webkitTransitionEnd", n.onTranslateToWrapperTransitionEnd), n.onTranslateToWrapperTransitionEnd = null, delete n.onTranslateToWrapperTransitionEnd, i && n.emit("transitionEnd"));
      }), n.$wrapperEl[0].addEventListener("transitionend", n.onTranslateToWrapperTransitionEnd), n.$wrapperEl[0].addEventListener("webkitTransitionEnd", n.onTranslateToWrapperTransitionEnd))), !0;
    }
  };
  var c = {
    setTransition: function setTransition(e, t) {
      this.params.cssMode || this.$wrapperEl.transition(e), this.emit("setTransition", e, t);
    },
    transitionStart: function transitionStart(e, t) {
      void 0 === e && (e = !0);
      var i = this.activeIndex,
          s = this.params,
          a = this.previousIndex;

      if (!s.cssMode) {
        s.autoHeight && this.updateAutoHeight();
        var r = t;

        if (r || (r = i > a ? "next" : i < a ? "prev" : "reset"), this.emit("transitionStart"), e && i !== a) {
          if ("reset" === r) return void this.emit("slideResetTransitionStart");
          this.emit("slideChangeTransitionStart"), "next" === r ? this.emit("slideNextTransitionStart") : this.emit("slidePrevTransitionStart");
        }
      }
    },
    transitionEnd: function transitionEnd(e, t) {
      void 0 === e && (e = !0);
      var i = this.activeIndex,
          s = this.previousIndex,
          a = this.params;

      if (this.animating = !1, !a.cssMode) {
        this.setTransition(0);
        var r = t;

        if (r || (r = i > s ? "next" : i < s ? "prev" : "reset"), this.emit("transitionEnd"), e && i !== s) {
          if ("reset" === r) return void this.emit("slideResetTransitionEnd");
          this.emit("slideChangeTransitionEnd"), "next" === r ? this.emit("slideNextTransitionEnd") : this.emit("slidePrevTransitionEnd");
        }
      }
    }
  };
  var u = {
    slideTo: function slideTo(e, t, i, s) {
      var a;
      void 0 === e && (e = 0), void 0 === t && (t = this.params.speed), void 0 === i && (i = !0);
      var r = this,
          n = e;
      n < 0 && (n = 0);
      var o = r.params,
          l = r.snapGrid,
          d = r.slidesGrid,
          h = r.previousIndex,
          p = r.activeIndex,
          c = r.rtlTranslate,
          u = r.wrapperEl;
      if (r.animating && o.preventInteractionOnTransition) return !1;
      var v = Math.min(r.params.slidesPerGroupSkip, n),
          f = v + Math.floor((n - v) / r.params.slidesPerGroup);
      f >= d.length && (f = d.length - 1), (p || o.initialSlide || 0) === (h || 0) && i && r.emit("beforeSlideChangeStart");
      var m,
          g = -l[f];
      if (r.updateProgress(g), o.normalizeSlideIndex) for (var b = 0; b < d.length; b += 1) {
        -Math.floor(100 * g) >= Math.floor(100 * d[b]) && (n = b);
      }

      if (r.initialized && n !== p) {
        if (!r.allowSlideNext && g < r.translate && g < r.minTranslate()) return !1;
        if (!r.allowSlidePrev && g > r.translate && g > r.maxTranslate() && (p || 0) !== n) return !1;
      }

      if (m = n > p ? "next" : n < p ? "prev" : "reset", c && -g === r.translate || !c && g === r.translate) return r.updateActiveIndex(n), o.autoHeight && r.updateAutoHeight(), r.updateSlidesClasses(), "slide" !== o.effect && r.setTranslate(g), "reset" !== m && (r.transitionStart(i, m), r.transitionEnd(i, m)), !1;

      if (o.cssMode) {
        var w = r.isHorizontal();
        return 0 === t ? u[w ? "scrollLeft" : "scrollTop"] = -g : u.scrollTo ? u.scrollTo(((a = {})[w ? "left" : "top"] = -g, a.behavior = "smooth", a)) : u[w ? "scrollLeft" : "scrollTop"] = -g, !0;
      }

      return 0 === t ? (r.setTransition(0), r.setTranslate(g), r.updateActiveIndex(n), r.updateSlidesClasses(), r.emit("beforeTransitionStart", t, s), r.transitionStart(i, m), r.transitionEnd(i, m)) : (r.setTransition(t), r.setTranslate(g), r.updateActiveIndex(n), r.updateSlidesClasses(), r.emit("beforeTransitionStart", t, s), r.transitionStart(i, m), r.animating || (r.animating = !0, r.onSlideToWrapperTransitionEnd || (r.onSlideToWrapperTransitionEnd = function (e) {
        r && !r.destroyed && e.target === this && (r.$wrapperEl[0].removeEventListener("transitionend", r.onSlideToWrapperTransitionEnd), r.$wrapperEl[0].removeEventListener("webkitTransitionEnd", r.onSlideToWrapperTransitionEnd), r.onSlideToWrapperTransitionEnd = null, delete r.onSlideToWrapperTransitionEnd, r.transitionEnd(i, m));
      }), r.$wrapperEl[0].addEventListener("transitionend", r.onSlideToWrapperTransitionEnd), r.$wrapperEl[0].addEventListener("webkitTransitionEnd", r.onSlideToWrapperTransitionEnd))), !0;
    },
    slideToLoop: function slideToLoop(e, t, i, s) {
      void 0 === e && (e = 0), void 0 === t && (t = this.params.speed), void 0 === i && (i = !0);
      var a = e;
      return this.params.loop && (a += this.loopedSlides), this.slideTo(a, t, i, s);
    },
    slideNext: function slideNext(e, t, i) {
      void 0 === e && (e = this.params.speed), void 0 === t && (t = !0);
      var s = this.params,
          a = this.animating,
          r = this.activeIndex < s.slidesPerGroupSkip ? 1 : s.slidesPerGroup;

      if (s.loop) {
        if (a) return !1;
        this.loopFix(), this._clientLeft = this.$wrapperEl[0].clientLeft;
      }

      return this.slideTo(this.activeIndex + r, e, t, i);
    },
    slidePrev: function slidePrev(e, t, i) {
      void 0 === e && (e = this.params.speed), void 0 === t && (t = !0);
      var s = this.params,
          a = this.animating,
          r = this.snapGrid,
          n = this.slidesGrid,
          o = this.rtlTranslate;

      if (s.loop) {
        if (a) return !1;
        this.loopFix(), this._clientLeft = this.$wrapperEl[0].clientLeft;
      }

      function l(e) {
        return e < 0 ? -Math.floor(Math.abs(e)) : Math.floor(e);
      }

      var d,
          h = l(o ? this.translate : -this.translate),
          p = r.map(function (e) {
        return l(e);
      }),
          c = (n.map(function (e) {
        return l(e);
      }), r[p.indexOf(h)], r[p.indexOf(h) - 1]);
      return void 0 === c && s.cssMode && r.forEach(function (e) {
        !c && h >= e && (c = e);
      }), void 0 !== c && (d = n.indexOf(c)) < 0 && (d = this.activeIndex - 1), this.slideTo(d, e, t, i);
    },
    slideReset: function slideReset(e, t, i) {
      return void 0 === e && (e = this.params.speed), void 0 === t && (t = !0), this.slideTo(this.activeIndex, e, t, i);
    },
    slideToClosest: function slideToClosest(e, t, i, s) {
      void 0 === e && (e = this.params.speed), void 0 === t && (t = !0), void 0 === s && (s = .5);
      var a = this.activeIndex,
          r = Math.min(this.params.slidesPerGroupSkip, a),
          n = r + Math.floor((a - r) / this.params.slidesPerGroup),
          o = this.rtlTranslate ? this.translate : -this.translate;

      if (o >= this.snapGrid[n]) {
        var l = this.snapGrid[n];
        o - l > (this.snapGrid[n + 1] - l) * s && (a += this.params.slidesPerGroup);
      } else {
        var d = this.snapGrid[n - 1];
        o - d <= (this.snapGrid[n] - d) * s && (a -= this.params.slidesPerGroup);
      }

      return a = Math.max(a, 0), a = Math.min(a, this.slidesGrid.length - 1), this.slideTo(a, e, t, i);
    },
    slideToClickedSlide: function slideToClickedSlide() {
      var e,
          t = this,
          i = t.params,
          a = t.$wrapperEl,
          r = "auto" === i.slidesPerView ? t.slidesPerViewDynamic() : i.slidesPerView,
          o = t.clickedIndex;

      if (i.loop) {
        if (t.animating) return;
        e = parseInt(s(t.clickedSlide).attr("data-swiper-slide-index"), 10), i.centeredSlides ? o < t.loopedSlides - r / 2 || o > t.slides.length - t.loopedSlides + r / 2 ? (t.loopFix(), o = a.children("." + i.slideClass + '[data-swiper-slide-index="' + e + '"]:not(.' + i.slideDuplicateClass + ")").eq(0).index(), n.nextTick(function () {
          t.slideTo(o);
        })) : t.slideTo(o) : o > t.slides.length - r ? (t.loopFix(), o = a.children("." + i.slideClass + '[data-swiper-slide-index="' + e + '"]:not(.' + i.slideDuplicateClass + ")").eq(0).index(), n.nextTick(function () {
          t.slideTo(o);
        })) : t.slideTo(o);
      } else t.slideTo(o);
    }
  };
  var v = {
    loopCreate: function loopCreate() {
      var t = this,
          i = t.params,
          a = t.$wrapperEl;
      a.children("." + i.slideClass + "." + i.slideDuplicateClass).remove();
      var r = a.children("." + i.slideClass);

      if (i.loopFillGroupWithBlank) {
        var n = i.slidesPerGroup - r.length % i.slidesPerGroup;

        if (n !== i.slidesPerGroup) {
          for (var o = 0; o < n; o += 1) {
            var l = s(e.createElement("div")).addClass(i.slideClass + " " + i.slideBlankClass);
            a.append(l);
          }

          r = a.children("." + i.slideClass);
        }
      }

      "auto" !== i.slidesPerView || i.loopedSlides || (i.loopedSlides = r.length), t.loopedSlides = Math.ceil(parseFloat(i.loopedSlides || i.slidesPerView, 10)), t.loopedSlides += i.loopAdditionalSlides, t.loopedSlides > r.length && (t.loopedSlides = r.length);
      var d = [],
          h = [];
      r.each(function (e, i) {
        var a = s(i);
        e < t.loopedSlides && h.push(i), e < r.length && e >= r.length - t.loopedSlides && d.push(i), a.attr("data-swiper-slide-index", e);
      });

      for (var p = 0; p < h.length; p += 1) {
        a.append(s(h[p].cloneNode(!0)).addClass(i.slideDuplicateClass));
      }

      for (var c = d.length - 1; c >= 0; c -= 1) {
        a.prepend(s(d[c].cloneNode(!0)).addClass(i.slideDuplicateClass));
      }
    },
    loopFix: function loopFix() {
      this.emit("beforeLoopFix");
      var e,
          t = this.activeIndex,
          i = this.slides,
          s = this.loopedSlides,
          a = this.allowSlidePrev,
          r = this.allowSlideNext,
          n = this.snapGrid,
          o = this.rtlTranslate;
      this.allowSlidePrev = !0, this.allowSlideNext = !0;
      var l = -n[t] - this.getTranslate();
      if (t < s) e = i.length - 3 * s + t, e += s, this.slideTo(e, 0, !1, !0) && 0 !== l && this.setTranslate((o ? -this.translate : this.translate) - l);else if (t >= i.length - s) {
        e = -i.length + t + s, e += s, this.slideTo(e, 0, !1, !0) && 0 !== l && this.setTranslate((o ? -this.translate : this.translate) - l);
      }
      this.allowSlidePrev = a, this.allowSlideNext = r, this.emit("loopFix");
    },
    loopDestroy: function loopDestroy() {
      var e = this.$wrapperEl,
          t = this.params,
          i = this.slides;
      e.children("." + t.slideClass + "." + t.slideDuplicateClass + ",." + t.slideClass + "." + t.slideBlankClass).remove(), i.removeAttr("data-swiper-slide-index");
    }
  };
  var f = {
    setGrabCursor: function setGrabCursor(e) {
      if (!(o.touch || !this.params.simulateTouch || this.params.watchOverflow && this.isLocked || this.params.cssMode)) {
        var t = this.el;
        t.style.cursor = "move", t.style.cursor = e ? "-webkit-grabbing" : "-webkit-grab", t.style.cursor = e ? "-moz-grabbin" : "-moz-grab", t.style.cursor = e ? "grabbing" : "grab";
      }
    },
    unsetGrabCursor: function unsetGrabCursor() {
      o.touch || this.params.watchOverflow && this.isLocked || this.params.cssMode || (this.el.style.cursor = "");
    }
  };
  var m,
      g,
      b,
      w,
      y,
      x,
      T,
      E,
      S,
      C,
      M,
      P,
      z,
      k,
      $,
      L = {
    appendSlide: function appendSlide(e) {
      var t = this.$wrapperEl,
          i = this.params;
      if (i.loop && this.loopDestroy(), "object" == _typeof(e) && "length" in e) for (var s = 0; s < e.length; s += 1) {
        e[s] && t.append(e[s]);
      } else t.append(e);
      i.loop && this.loopCreate(), i.observer && o.observer || this.update();
    },
    prependSlide: function prependSlide(e) {
      var t = this.params,
          i = this.$wrapperEl,
          s = this.activeIndex;
      t.loop && this.loopDestroy();
      var a = s + 1;

      if ("object" == _typeof(e) && "length" in e) {
        for (var r = 0; r < e.length; r += 1) {
          e[r] && i.prepend(e[r]);
        }

        a = s + e.length;
      } else i.prepend(e);

      t.loop && this.loopCreate(), t.observer && o.observer || this.update(), this.slideTo(a, 0, !1);
    },
    addSlide: function addSlide(e, t) {
      var i = this.$wrapperEl,
          s = this.params,
          a = this.activeIndex;
      s.loop && (a -= this.loopedSlides, this.loopDestroy(), this.slides = i.children("." + s.slideClass));
      var r = this.slides.length;
      if (e <= 0) this.prependSlide(t);else if (e >= r) this.appendSlide(t);else {
        for (var n = a > e ? a + 1 : a, l = [], d = r - 1; d >= e; d -= 1) {
          var h = this.slides.eq(d);
          h.remove(), l.unshift(h);
        }

        if ("object" == _typeof(t) && "length" in t) {
          for (var p = 0; p < t.length; p += 1) {
            t[p] && i.append(t[p]);
          }

          n = a > e ? a + t.length : a;
        } else i.append(t);

        for (var c = 0; c < l.length; c += 1) {
          i.append(l[c]);
        }

        s.loop && this.loopCreate(), s.observer && o.observer || this.update(), s.loop ? this.slideTo(n + this.loopedSlides, 0, !1) : this.slideTo(n, 0, !1);
      }
    },
    removeSlide: function removeSlide(e) {
      var t = this.params,
          i = this.$wrapperEl,
          s = this.activeIndex;
      t.loop && (s -= this.loopedSlides, this.loopDestroy(), this.slides = i.children("." + t.slideClass));
      var a,
          r = s;

      if ("object" == _typeof(e) && "length" in e) {
        for (var n = 0; n < e.length; n += 1) {
          a = e[n], this.slides[a] && this.slides.eq(a).remove(), a < r && (r -= 1);
        }

        r = Math.max(r, 0);
      } else a = e, this.slides[a] && this.slides.eq(a).remove(), a < r && (r -= 1), r = Math.max(r, 0);

      t.loop && this.loopCreate(), t.observer && o.observer || this.update(), t.loop ? this.slideTo(r + this.loopedSlides, 0, !1) : this.slideTo(r, 0, !1);
    },
    removeAllSlides: function removeAllSlides() {
      for (var e = [], t = 0; t < this.slides.length; t += 1) {
        e.push(t);
      }

      this.removeSlide(e);
    }
  },
      I = (m = t.navigator.platform, g = t.navigator.userAgent, b = {
    ios: !1,
    android: !1,
    androidChrome: !1,
    desktop: !1,
    iphone: !1,
    ipod: !1,
    ipad: !1,
    edge: !1,
    ie: !1,
    firefox: !1,
    macos: !1,
    windows: !1,
    cordova: !(!t.cordova && !t.phonegap),
    phonegap: !(!t.cordova && !t.phonegap),
    electron: !1
  }, w = t.screen.width, y = t.screen.height, x = g.match(/(Android);?[\s\/]+([\d.]+)?/), T = g.match(/(iPad).*OS\s([\d_]+)/), E = g.match(/(iPod)(.*OS\s([\d_]+))?/), S = !T && g.match(/(iPhone\sOS|iOS)\s([\d_]+)/), C = g.indexOf("MSIE ") >= 0 || g.indexOf("Trident/") >= 0, M = g.indexOf("Edge/") >= 0, P = g.indexOf("Gecko/") >= 0 && g.indexOf("Firefox/") >= 0, z = "Win32" === m, k = g.toLowerCase().indexOf("electron") >= 0, $ = "MacIntel" === m, !T && $ && o.touch && (1024 === w && 1366 === y || 834 === w && 1194 === y || 834 === w && 1112 === y || 768 === w && 1024 === y) && (T = g.match(/(Version)\/([\d.]+)/), $ = !1), b.ie = C, b.edge = M, b.firefox = P, x && !z && (b.os = "android", b.osVersion = x[2], b.android = !0, b.androidChrome = g.toLowerCase().indexOf("chrome") >= 0), (T || S || E) && (b.os = "ios", b.ios = !0), S && !E && (b.osVersion = S[2].replace(/_/g, "."), b.iphone = !0), T && (b.osVersion = T[2].replace(/_/g, "."), b.ipad = !0), E && (b.osVersion = E[3] ? E[3].replace(/_/g, ".") : null, b.ipod = !0), b.ios && b.osVersion && g.indexOf("Version/") >= 0 && "10" === b.osVersion.split(".")[0] && (b.osVersion = g.toLowerCase().split("version/")[1].split(" ")[0]), b.webView = !(!(S || T || E) || !g.match(/.*AppleWebKit(?!.*Safari)/i) && !t.navigator.standalone) || t.matchMedia && t.matchMedia("(display-mode: standalone)").matches, b.webview = b.webView, b.standalone = b.webView, b.desktop = !(b.ios || b.android) || k, b.desktop && (b.electron = k, b.macos = $, b.windows = z, b.macos && (b.os = "macos"), b.windows && (b.os = "windows")), b.pixelRatio = t.devicePixelRatio || 1, b);

  function D(i) {
    var a = this.touchEventsData,
        r = this.params,
        o = this.touches;

    if (!this.animating || !r.preventInteractionOnTransition) {
      var l = i;
      l.originalEvent && (l = l.originalEvent);
      var d = s(l.target);
      if (("wrapper" !== r.touchEventsTarget || d.closest(this.wrapperEl).length) && (a.isTouchEvent = "touchstart" === l.type, (a.isTouchEvent || !("which" in l) || 3 !== l.which) && !(!a.isTouchEvent && "button" in l && l.button > 0 || a.isTouched && a.isMoved))) if (r.noSwiping && d.closest(r.noSwipingSelector ? r.noSwipingSelector : "." + r.noSwipingClass)[0]) this.allowClick = !0;else if (!r.swipeHandler || d.closest(r.swipeHandler)[0]) {
        o.currentX = "touchstart" === l.type ? l.targetTouches[0].pageX : l.pageX, o.currentY = "touchstart" === l.type ? l.targetTouches[0].pageY : l.pageY;
        var h = o.currentX,
            p = o.currentY,
            c = r.edgeSwipeDetection || r.iOSEdgeSwipeDetection,
            u = r.edgeSwipeThreshold || r.iOSEdgeSwipeThreshold;

        if (!c || !(h <= u || h >= t.screen.width - u)) {
          if (n.extend(a, {
            isTouched: !0,
            isMoved: !1,
            allowTouchCallbacks: !0,
            isScrolling: void 0,
            startMoving: void 0
          }), o.startX = h, o.startY = p, a.touchStartTime = n.now(), this.allowClick = !0, this.updateSize(), this.swipeDirection = void 0, r.threshold > 0 && (a.allowThresholdMove = !1), "touchstart" !== l.type) {
            var v = !0;
            d.is(a.formElements) && (v = !1), e.activeElement && s(e.activeElement).is(a.formElements) && e.activeElement !== d[0] && e.activeElement.blur();
            var f = v && this.allowTouchMove && r.touchStartPreventDefault;
            (r.touchStartForcePreventDefault || f) && l.preventDefault();
          }

          this.emit("touchStart", l);
        }
      }
    }
  }

  function O(t) {
    var i = this.touchEventsData,
        a = this.params,
        r = this.touches,
        o = this.rtlTranslate,
        l = t;

    if (l.originalEvent && (l = l.originalEvent), i.isTouched) {
      if (!i.isTouchEvent || "mousemove" !== l.type) {
        var d = "touchmove" === l.type && l.targetTouches && (l.targetTouches[0] || l.changedTouches[0]),
            h = "touchmove" === l.type ? d.pageX : l.pageX,
            p = "touchmove" === l.type ? d.pageY : l.pageY;
        if (l.preventedByNestedSwiper) return r.startX = h, void (r.startY = p);
        if (!this.allowTouchMove) return this.allowClick = !1, void (i.isTouched && (n.extend(r, {
          startX: h,
          startY: p,
          currentX: h,
          currentY: p
        }), i.touchStartTime = n.now()));
        if (i.isTouchEvent && a.touchReleaseOnEdges && !a.loop) if (this.isVertical()) {
          if (p < r.startY && this.translate <= this.maxTranslate() || p > r.startY && this.translate >= this.minTranslate()) return i.isTouched = !1, void (i.isMoved = !1);
        } else if (h < r.startX && this.translate <= this.maxTranslate() || h > r.startX && this.translate >= this.minTranslate()) return;
        if (i.isTouchEvent && e.activeElement && l.target === e.activeElement && s(l.target).is(i.formElements)) return i.isMoved = !0, void (this.allowClick = !1);

        if (i.allowTouchCallbacks && this.emit("touchMove", l), !(l.targetTouches && l.targetTouches.length > 1)) {
          r.currentX = h, r.currentY = p;
          var c = r.currentX - r.startX,
              u = r.currentY - r.startY;

          if (!(this.params.threshold && Math.sqrt(Math.pow(c, 2) + Math.pow(u, 2)) < this.params.threshold)) {
            var v;
            if (void 0 === i.isScrolling) this.isHorizontal() && r.currentY === r.startY || this.isVertical() && r.currentX === r.startX ? i.isScrolling = !1 : c * c + u * u >= 25 && (v = 180 * Math.atan2(Math.abs(u), Math.abs(c)) / Math.PI, i.isScrolling = this.isHorizontal() ? v > a.touchAngle : 90 - v > a.touchAngle);
            if (i.isScrolling && this.emit("touchMoveOpposite", l), void 0 === i.startMoving && (r.currentX === r.startX && r.currentY === r.startY || (i.startMoving = !0)), i.isScrolling) i.isTouched = !1;else if (i.startMoving) {
              this.allowClick = !1, a.cssMode || l.preventDefault(), a.touchMoveStopPropagation && !a.nested && l.stopPropagation(), i.isMoved || (a.loop && this.loopFix(), i.startTranslate = this.getTranslate(), this.setTransition(0), this.animating && this.$wrapperEl.trigger("webkitTransitionEnd transitionend"), i.allowMomentumBounce = !1, !a.grabCursor || !0 !== this.allowSlideNext && !0 !== this.allowSlidePrev || this.setGrabCursor(!0), this.emit("sliderFirstMove", l)), this.emit("sliderMove", l), i.isMoved = !0;
              var f = this.isHorizontal() ? c : u;
              r.diff = f, f *= a.touchRatio, o && (f = -f), this.swipeDirection = f > 0 ? "prev" : "next", i.currentTranslate = f + i.startTranslate;
              var m = !0,
                  g = a.resistanceRatio;

              if (a.touchReleaseOnEdges && (g = 0), f > 0 && i.currentTranslate > this.minTranslate() ? (m = !1, a.resistance && (i.currentTranslate = this.minTranslate() - 1 + Math.pow(-this.minTranslate() + i.startTranslate + f, g))) : f < 0 && i.currentTranslate < this.maxTranslate() && (m = !1, a.resistance && (i.currentTranslate = this.maxTranslate() + 1 - Math.pow(this.maxTranslate() - i.startTranslate - f, g))), m && (l.preventedByNestedSwiper = !0), !this.allowSlideNext && "next" === this.swipeDirection && i.currentTranslate < i.startTranslate && (i.currentTranslate = i.startTranslate), !this.allowSlidePrev && "prev" === this.swipeDirection && i.currentTranslate > i.startTranslate && (i.currentTranslate = i.startTranslate), a.threshold > 0) {
                if (!(Math.abs(f) > a.threshold || i.allowThresholdMove)) return void (i.currentTranslate = i.startTranslate);
                if (!i.allowThresholdMove) return i.allowThresholdMove = !0, r.startX = r.currentX, r.startY = r.currentY, i.currentTranslate = i.startTranslate, void (r.diff = this.isHorizontal() ? r.currentX - r.startX : r.currentY - r.startY);
              }

              a.followFinger && !a.cssMode && ((a.freeMode || a.watchSlidesProgress || a.watchSlidesVisibility) && (this.updateActiveIndex(), this.updateSlidesClasses()), a.freeMode && (0 === i.velocities.length && i.velocities.push({
                position: r[this.isHorizontal() ? "startX" : "startY"],
                time: i.touchStartTime
              }), i.velocities.push({
                position: r[this.isHorizontal() ? "currentX" : "currentY"],
                time: n.now()
              })), this.updateProgress(i.currentTranslate), this.setTranslate(i.currentTranslate));
            }
          }
        }
      }
    } else i.startMoving && i.isScrolling && this.emit("touchMoveOpposite", l);
  }

  function A(e) {
    var t = this,
        i = t.touchEventsData,
        s = t.params,
        a = t.touches,
        r = t.rtlTranslate,
        o = t.$wrapperEl,
        l = t.slidesGrid,
        d = t.snapGrid,
        h = e;
    if (h.originalEvent && (h = h.originalEvent), i.allowTouchCallbacks && t.emit("touchEnd", h), i.allowTouchCallbacks = !1, !i.isTouched) return i.isMoved && s.grabCursor && t.setGrabCursor(!1), i.isMoved = !1, void (i.startMoving = !1);
    s.grabCursor && i.isMoved && i.isTouched && (!0 === t.allowSlideNext || !0 === t.allowSlidePrev) && t.setGrabCursor(!1);
    var p,
        c = n.now(),
        u = c - i.touchStartTime;
    if (t.allowClick && (t.updateClickedSlide(h), t.emit("tap click", h), u < 300 && c - i.lastClickTime < 300 && t.emit("doubleTap doubleClick", h)), i.lastClickTime = n.now(), n.nextTick(function () {
      t.destroyed || (t.allowClick = !0);
    }), !i.isTouched || !i.isMoved || !t.swipeDirection || 0 === a.diff || i.currentTranslate === i.startTranslate) return i.isTouched = !1, i.isMoved = !1, void (i.startMoving = !1);
    if (i.isTouched = !1, i.isMoved = !1, i.startMoving = !1, p = s.followFinger ? r ? t.translate : -t.translate : -i.currentTranslate, !s.cssMode) if (s.freeMode) {
      if (p < -t.minTranslate()) return void t.slideTo(t.activeIndex);
      if (p > -t.maxTranslate()) return void (t.slides.length < d.length ? t.slideTo(d.length - 1) : t.slideTo(t.slides.length - 1));

      if (s.freeModeMomentum) {
        if (i.velocities.length > 1) {
          var v = i.velocities.pop(),
              f = i.velocities.pop(),
              m = v.position - f.position,
              g = v.time - f.time;
          t.velocity = m / g, t.velocity /= 2, Math.abs(t.velocity) < s.freeModeMinimumVelocity && (t.velocity = 0), (g > 150 || n.now() - v.time > 300) && (t.velocity = 0);
        } else t.velocity = 0;

        t.velocity *= s.freeModeMomentumVelocityRatio, i.velocities.length = 0;
        var b = 1e3 * s.freeModeMomentumRatio,
            w = t.velocity * b,
            y = t.translate + w;
        r && (y = -y);
        var x,
            T,
            E = !1,
            S = 20 * Math.abs(t.velocity) * s.freeModeMomentumBounceRatio;
        if (y < t.maxTranslate()) s.freeModeMomentumBounce ? (y + t.maxTranslate() < -S && (y = t.maxTranslate() - S), x = t.maxTranslate(), E = !0, i.allowMomentumBounce = !0) : y = t.maxTranslate(), s.loop && s.centeredSlides && (T = !0);else if (y > t.minTranslate()) s.freeModeMomentumBounce ? (y - t.minTranslate() > S && (y = t.minTranslate() + S), x = t.minTranslate(), E = !0, i.allowMomentumBounce = !0) : y = t.minTranslate(), s.loop && s.centeredSlides && (T = !0);else if (s.freeModeSticky) {
          for (var C, M = 0; M < d.length; M += 1) {
            if (d[M] > -y) {
              C = M;
              break;
            }
          }

          y = -(y = Math.abs(d[C] - y) < Math.abs(d[C - 1] - y) || "next" === t.swipeDirection ? d[C] : d[C - 1]);
        }

        if (T && t.once("transitionEnd", function () {
          t.loopFix();
        }), 0 !== t.velocity) {
          if (b = r ? Math.abs((-y - t.translate) / t.velocity) : Math.abs((y - t.translate) / t.velocity), s.freeModeSticky) {
            var P = Math.abs((r ? -y : y) - t.translate),
                z = t.slidesSizesGrid[t.activeIndex];
            b = P < z ? s.speed : P < 2 * z ? 1.5 * s.speed : 2.5 * s.speed;
          }
        } else if (s.freeModeSticky) return void t.slideToClosest();

        s.freeModeMomentumBounce && E ? (t.updateProgress(x), t.setTransition(b), t.setTranslate(y), t.transitionStart(!0, t.swipeDirection), t.animating = !0, o.transitionEnd(function () {
          t && !t.destroyed && i.allowMomentumBounce && (t.emit("momentumBounce"), t.setTransition(s.speed), t.setTranslate(x), o.transitionEnd(function () {
            t && !t.destroyed && t.transitionEnd();
          }));
        })) : t.velocity ? (t.updateProgress(y), t.setTransition(b), t.setTranslate(y), t.transitionStart(!0, t.swipeDirection), t.animating || (t.animating = !0, o.transitionEnd(function () {
          t && !t.destroyed && t.transitionEnd();
        }))) : t.updateProgress(y), t.updateActiveIndex(), t.updateSlidesClasses();
      } else if (s.freeModeSticky) return void t.slideToClosest();

      (!s.freeModeMomentum || u >= s.longSwipesMs) && (t.updateProgress(), t.updateActiveIndex(), t.updateSlidesClasses());
    } else {
      for (var k = 0, $ = t.slidesSizesGrid[0], L = 0; L < l.length; L += L < s.slidesPerGroupSkip ? 1 : s.slidesPerGroup) {
        var I = L < s.slidesPerGroupSkip - 1 ? 1 : s.slidesPerGroup;
        void 0 !== l[L + I] ? p >= l[L] && p < l[L + I] && (k = L, $ = l[L + I] - l[L]) : p >= l[L] && (k = L, $ = l[l.length - 1] - l[l.length - 2]);
      }

      var D = (p - l[k]) / $,
          O = k < s.slidesPerGroupSkip - 1 ? 1 : s.slidesPerGroup;

      if (u > s.longSwipesMs) {
        if (!s.longSwipes) return void t.slideTo(t.activeIndex);
        "next" === t.swipeDirection && (D >= s.longSwipesRatio ? t.slideTo(k + O) : t.slideTo(k)), "prev" === t.swipeDirection && (D > 1 - s.longSwipesRatio ? t.slideTo(k + O) : t.slideTo(k));
      } else {
        if (!s.shortSwipes) return void t.slideTo(t.activeIndex);
        t.navigation && (h.target === t.navigation.nextEl || h.target === t.navigation.prevEl) ? h.target === t.navigation.nextEl ? t.slideTo(k + O) : t.slideTo(k) : ("next" === t.swipeDirection && t.slideTo(k + O), "prev" === t.swipeDirection && t.slideTo(k));
      }
    }
  }

  function G() {
    var e = this.params,
        t = this.el;

    if (!t || 0 !== t.offsetWidth) {
      e.breakpoints && this.setBreakpoint();
      var i = this.allowSlideNext,
          s = this.allowSlidePrev,
          a = this.snapGrid;
      this.allowSlideNext = !0, this.allowSlidePrev = !0, this.updateSize(), this.updateSlides(), this.updateSlidesClasses(), ("auto" === e.slidesPerView || e.slidesPerView > 1) && this.isEnd && !this.params.centeredSlides ? this.slideTo(this.slides.length - 1, 0, !1, !0) : this.slideTo(this.activeIndex, 0, !1, !0), this.autoplay && this.autoplay.running && this.autoplay.paused && this.autoplay.run(), this.allowSlidePrev = s, this.allowSlideNext = i, this.params.watchOverflow && a !== this.snapGrid && this.checkOverflow();
    }
  }

  function B(e) {
    this.allowClick || (this.params.preventClicks && e.preventDefault(), this.params.preventClicksPropagation && this.animating && (e.stopPropagation(), e.stopImmediatePropagation()));
  }

  function H() {
    var e = this.wrapperEl;
    this.previousTranslate = this.translate, this.translate = this.isHorizontal() ? -e.scrollLeft : -e.scrollTop, -0 === this.translate && (this.translate = 0), this.updateActiveIndex(), this.updateSlidesClasses();
    var t = this.maxTranslate() - this.minTranslate();
    (0 === t ? 0 : (this.translate - this.minTranslate()) / t) !== this.progress && this.updateProgress(this.translate), this.emit("setTranslate", this.translate, !1);
  }

  var N = !1;

  function X() {}

  var V = {
    init: !0,
    direction: "horizontal",
    touchEventsTarget: "container",
    initialSlide: 0,
    speed: 300,
    cssMode: !1,
    updateOnWindowResize: !0,
    preventInteractionOnTransition: !1,
    edgeSwipeDetection: !1,
    edgeSwipeThreshold: 20,
    freeMode: !1,
    freeModeMomentum: !0,
    freeModeMomentumRatio: 1,
    freeModeMomentumBounce: !0,
    freeModeMomentumBounceRatio: 1,
    freeModeMomentumVelocityRatio: 1,
    freeModeSticky: !1,
    freeModeMinimumVelocity: .02,
    autoHeight: !1,
    setWrapperSize: !1,
    virtualTranslate: !1,
    effect: "slide",
    breakpoints: void 0,
    spaceBetween: 0,
    slidesPerView: 1,
    slidesPerColumn: 1,
    slidesPerColumnFill: "column",
    slidesPerGroup: 1,
    slidesPerGroupSkip: 0,
    centeredSlides: !1,
    centeredSlidesBounds: !1,
    slidesOffsetBefore: 0,
    slidesOffsetAfter: 0,
    normalizeSlideIndex: !0,
    centerInsufficientSlides: !1,
    watchOverflow: !1,
    roundLengths: !1,
    touchRatio: 1,
    touchAngle: 45,
    simulateTouch: !0,
    shortSwipes: !0,
    longSwipes: !0,
    longSwipesRatio: .5,
    longSwipesMs: 300,
    followFinger: !0,
    allowTouchMove: !0,
    threshold: 0,
    touchMoveStopPropagation: !1,
    touchStartPreventDefault: !0,
    touchStartForcePreventDefault: !1,
    touchReleaseOnEdges: !1,
    uniqueNavElements: !0,
    resistance: !0,
    resistanceRatio: .85,
    watchSlidesProgress: !1,
    watchSlidesVisibility: !1,
    grabCursor: !1,
    preventClicks: !0,
    preventClicksPropagation: !0,
    slideToClickedSlide: !1,
    preloadImages: !0,
    updateOnImagesReady: !0,
    loop: !1,
    loopAdditionalSlides: 0,
    loopedSlides: null,
    loopFillGroupWithBlank: !1,
    allowSlidePrev: !0,
    allowSlideNext: !0,
    swipeHandler: null,
    noSwiping: !0,
    noSwipingClass: "swiper-no-swiping",
    noSwipingSelector: null,
    passiveListeners: !0,
    containerModifierClass: "swiper-container-",
    slideClass: "swiper-slide",
    slideBlankClass: "swiper-slide-invisible-blank",
    slideActiveClass: "swiper-slide-active",
    slideDuplicateActiveClass: "swiper-slide-duplicate-active",
    slideVisibleClass: "swiper-slide-visible",
    slideDuplicateClass: "swiper-slide-duplicate",
    slideNextClass: "swiper-slide-next",
    slideDuplicateNextClass: "swiper-slide-duplicate-next",
    slidePrevClass: "swiper-slide-prev",
    slideDuplicatePrevClass: "swiper-slide-duplicate-prev",
    wrapperClass: "swiper-wrapper",
    runCallbacksOnInit: !0
  },
      Y = {
    update: h,
    translate: p,
    transition: c,
    slide: u,
    loop: v,
    grabCursor: f,
    manipulation: L,
    events: {
      attachEvents: function attachEvents() {
        var t = this.params,
            i = this.touchEvents,
            s = this.el,
            a = this.wrapperEl;
        this.onTouchStart = D.bind(this), this.onTouchMove = O.bind(this), this.onTouchEnd = A.bind(this), t.cssMode && (this.onScroll = H.bind(this)), this.onClick = B.bind(this);
        var r = !!t.nested;
        if (!o.touch && o.pointerEvents) s.addEventListener(i.start, this.onTouchStart, !1), e.addEventListener(i.move, this.onTouchMove, r), e.addEventListener(i.end, this.onTouchEnd, !1);else {
          if (o.touch) {
            var n = !("touchstart" !== i.start || !o.passiveListener || !t.passiveListeners) && {
              passive: !0,
              capture: !1
            };
            s.addEventListener(i.start, this.onTouchStart, n), s.addEventListener(i.move, this.onTouchMove, o.passiveListener ? {
              passive: !1,
              capture: r
            } : r), s.addEventListener(i.end, this.onTouchEnd, n), i.cancel && s.addEventListener(i.cancel, this.onTouchEnd, n), N || (e.addEventListener("touchstart", X), N = !0);
          }

          (t.simulateTouch && !I.ios && !I.android || t.simulateTouch && !o.touch && I.ios) && (s.addEventListener("mousedown", this.onTouchStart, !1), e.addEventListener("mousemove", this.onTouchMove, r), e.addEventListener("mouseup", this.onTouchEnd, !1));
        }
        (t.preventClicks || t.preventClicksPropagation) && s.addEventListener("click", this.onClick, !0), t.cssMode && a.addEventListener("scroll", this.onScroll), t.updateOnWindowResize ? this.on(I.ios || I.android ? "resize orientationchange observerUpdate" : "resize observerUpdate", G, !0) : this.on("observerUpdate", G, !0);
      },
      detachEvents: function detachEvents() {
        var t = this.params,
            i = this.touchEvents,
            s = this.el,
            a = this.wrapperEl,
            r = !!t.nested;
        if (!o.touch && o.pointerEvents) s.removeEventListener(i.start, this.onTouchStart, !1), e.removeEventListener(i.move, this.onTouchMove, r), e.removeEventListener(i.end, this.onTouchEnd, !1);else {
          if (o.touch) {
            var n = !("onTouchStart" !== i.start || !o.passiveListener || !t.passiveListeners) && {
              passive: !0,
              capture: !1
            };
            s.removeEventListener(i.start, this.onTouchStart, n), s.removeEventListener(i.move, this.onTouchMove, r), s.removeEventListener(i.end, this.onTouchEnd, n), i.cancel && s.removeEventListener(i.cancel, this.onTouchEnd, n);
          }

          (t.simulateTouch && !I.ios && !I.android || t.simulateTouch && !o.touch && I.ios) && (s.removeEventListener("mousedown", this.onTouchStart, !1), e.removeEventListener("mousemove", this.onTouchMove, r), e.removeEventListener("mouseup", this.onTouchEnd, !1));
        }
        (t.preventClicks || t.preventClicksPropagation) && s.removeEventListener("click", this.onClick, !0), t.cssMode && a.removeEventListener("scroll", this.onScroll), this.off(I.ios || I.android ? "resize orientationchange observerUpdate" : "resize observerUpdate", G);
      }
    },
    breakpoints: {
      setBreakpoint: function setBreakpoint() {
        var e = this.activeIndex,
            t = this.initialized,
            i = this.loopedSlides;
        void 0 === i && (i = 0);
        var s = this.params,
            a = this.$el,
            r = s.breakpoints;

        if (r && (!r || 0 !== Object.keys(r).length)) {
          var o = this.getBreakpoint(r);

          if (o && this.currentBreakpoint !== o) {
            var l = o in r ? r[o] : void 0;
            l && ["slidesPerView", "spaceBetween", "slidesPerGroup", "slidesPerGroupSkip", "slidesPerColumn"].forEach(function (e) {
              var t = l[e];
              void 0 !== t && (l[e] = "slidesPerView" !== e || "AUTO" !== t && "auto" !== t ? "slidesPerView" === e ? parseFloat(t) : parseInt(t, 10) : "auto");
            });
            var d = l || this.originalParams,
                h = s.slidesPerColumn > 1,
                p = d.slidesPerColumn > 1;
            h && !p ? a.removeClass(s.containerModifierClass + "multirow " + s.containerModifierClass + "multirow-column") : !h && p && (a.addClass(s.containerModifierClass + "multirow"), "column" === d.slidesPerColumnFill && a.addClass(s.containerModifierClass + "multirow-column"));
            var c = d.direction && d.direction !== s.direction,
                u = s.loop && (d.slidesPerView !== s.slidesPerView || c);
            c && t && this.changeDirection(), n.extend(this.params, d), n.extend(this, {
              allowTouchMove: this.params.allowTouchMove,
              allowSlideNext: this.params.allowSlideNext,
              allowSlidePrev: this.params.allowSlidePrev
            }), this.currentBreakpoint = o, u && t && (this.loopDestroy(), this.loopCreate(), this.updateSlides(), this.slideTo(e - i + this.loopedSlides, 0, !1)), this.emit("breakpoint", d);
          }
        }
      },
      getBreakpoint: function getBreakpoint(e) {
        if (e) {
          var i = !1,
              s = Object.keys(e).map(function (e) {
            if ("string" == typeof e && e.startsWith("@")) {
              var i = parseFloat(e.substr(1));
              return {
                value: t.innerHeight * i,
                point: e
              };
            }

            return {
              value: e,
              point: e
            };
          });
          s.sort(function (e, t) {
            return parseInt(e.value, 10) - parseInt(t.value, 10);
          });

          for (var a = 0; a < s.length; a += 1) {
            var r = s[a],
                n = r.point;
            r.value <= t.innerWidth && (i = n);
          }

          return i || "max";
        }
      }
    },
    checkOverflow: {
      checkOverflow: function checkOverflow() {
        var e = this.params,
            t = this.isLocked,
            i = this.slides.length > 0 && e.slidesOffsetBefore + e.spaceBetween * (this.slides.length - 1) + this.slides[0].offsetWidth * this.slides.length;
        e.slidesOffsetBefore && e.slidesOffsetAfter && i ? this.isLocked = i <= this.size : this.isLocked = 1 === this.snapGrid.length, this.allowSlideNext = !this.isLocked, this.allowSlidePrev = !this.isLocked, t !== this.isLocked && this.emit(this.isLocked ? "lock" : "unlock"), t && t !== this.isLocked && (this.isEnd = !1, this.navigation.update());
      }
    },
    classes: {
      addClasses: function addClasses() {
        var e = this.classNames,
            t = this.params,
            i = this.rtl,
            s = this.$el,
            a = [];
        a.push("initialized"), a.push(t.direction), t.freeMode && a.push("free-mode"), t.autoHeight && a.push("autoheight"), i && a.push("rtl"), t.slidesPerColumn > 1 && (a.push("multirow"), "column" === t.slidesPerColumnFill && a.push("multirow-column")), I.android && a.push("android"), I.ios && a.push("ios"), t.cssMode && a.push("css-mode"), a.forEach(function (i) {
          e.push(t.containerModifierClass + i);
        }), s.addClass(e.join(" "));
      },
      removeClasses: function removeClasses() {
        var e = this.$el,
            t = this.classNames;
        e.removeClass(t.join(" "));
      }
    },
    images: {
      loadImage: function loadImage(e, i, s, a, r, n) {
        var o;

        function l() {
          n && n();
        }

        e.complete && r ? l() : i ? ((o = new t.Image()).onload = l, o.onerror = l, a && (o.sizes = a), s && (o.srcset = s), i && (o.src = i)) : l();
      },
      preloadImages: function preloadImages() {
        var e = this;

        function t() {
          null != e && e && !e.destroyed && (void 0 !== e.imagesLoaded && (e.imagesLoaded += 1), e.imagesLoaded === e.imagesToLoad.length && (e.params.updateOnImagesReady && e.update(), e.emit("imagesReady")));
        }

        e.imagesToLoad = e.$el.find("img");

        for (var i = 0; i < e.imagesToLoad.length; i += 1) {
          var s = e.imagesToLoad[i];
          e.loadImage(s, s.currentSrc || s.getAttribute("src"), s.srcset || s.getAttribute("srcset"), s.sizes || s.getAttribute("sizes"), !0, t);
        }
      }
    }
  },
      F = {},
      W = function (e) {
    function t() {
      for (var i, a, r, l = [], d = arguments.length; d--;) {
        l[d] = arguments[d];
      }

      1 === l.length && l[0].constructor && l[0].constructor === Object ? r = l[0] : (a = (i = l)[0], r = i[1]), r || (r = {}), r = n.extend({}, r), a && !r.el && (r.el = a), e.call(this, r), Object.keys(Y).forEach(function (e) {
        Object.keys(Y[e]).forEach(function (i) {
          t.prototype[i] || (t.prototype[i] = Y[e][i]);
        });
      });
      var h = this;
      void 0 === h.modules && (h.modules = {}), Object.keys(h.modules).forEach(function (e) {
        var t = h.modules[e];

        if (t.params) {
          var i = Object.keys(t.params)[0],
              s = t.params[i];
          if ("object" != _typeof(s) || null === s) return;
          if (!(i in r && "enabled" in s)) return;
          !0 === r[i] && (r[i] = {
            enabled: !0
          }), "object" != _typeof(r[i]) || "enabled" in r[i] || (r[i].enabled = !0), r[i] || (r[i] = {
            enabled: !1
          });
        }
      });
      var p = n.extend({}, V);
      h.useModulesParams(p), h.params = n.extend({}, p, F, r), h.originalParams = n.extend({}, h.params), h.passedParams = n.extend({}, r), h.$ = s;
      var c = s(h.params.el);

      if (a = c[0]) {
        if (c.length > 1) {
          var u = [];
          return c.each(function (e, i) {
            var s = n.extend({}, r, {
              el: i
            });
            u.push(new t(s));
          }), u;
        }

        var v, f, m;
        return a.swiper = h, c.data("swiper", h), a && a.shadowRoot && a.shadowRoot.querySelector ? (v = s(a.shadowRoot.querySelector("." + h.params.wrapperClass))).children = function (e) {
          return c.children(e);
        } : v = c.children("." + h.params.wrapperClass), n.extend(h, {
          $el: c,
          el: a,
          $wrapperEl: v,
          wrapperEl: v[0],
          classNames: [],
          slides: s(),
          slidesGrid: [],
          snapGrid: [],
          slidesSizesGrid: [],
          isHorizontal: function isHorizontal() {
            return "horizontal" === h.params.direction;
          },
          isVertical: function isVertical() {
            return "vertical" === h.params.direction;
          },
          rtl: "rtl" === a.dir.toLowerCase() || "rtl" === c.css("direction"),
          rtlTranslate: "horizontal" === h.params.direction && ("rtl" === a.dir.toLowerCase() || "rtl" === c.css("direction")),
          wrongRTL: "-webkit-box" === v.css("display"),
          activeIndex: 0,
          realIndex: 0,
          isBeginning: !0,
          isEnd: !1,
          translate: 0,
          previousTranslate: 0,
          progress: 0,
          velocity: 0,
          animating: !1,
          allowSlideNext: h.params.allowSlideNext,
          allowSlidePrev: h.params.allowSlidePrev,
          touchEvents: (f = ["touchstart", "touchmove", "touchend", "touchcancel"], m = ["mousedown", "mousemove", "mouseup"], o.pointerEvents && (m = ["pointerdown", "pointermove", "pointerup"]), h.touchEventsTouch = {
            start: f[0],
            move: f[1],
            end: f[2],
            cancel: f[3]
          }, h.touchEventsDesktop = {
            start: m[0],
            move: m[1],
            end: m[2]
          }, o.touch || !h.params.simulateTouch ? h.touchEventsTouch : h.touchEventsDesktop),
          touchEventsData: {
            isTouched: void 0,
            isMoved: void 0,
            allowTouchCallbacks: void 0,
            touchStartTime: void 0,
            isScrolling: void 0,
            currentTranslate: void 0,
            startTranslate: void 0,
            allowThresholdMove: void 0,
            formElements: "input, select, option, textarea, button, video",
            lastClickTime: n.now(),
            clickTimeout: void 0,
            velocities: [],
            allowMomentumBounce: void 0,
            isTouchEvent: void 0,
            startMoving: void 0
          },
          allowClick: !0,
          allowTouchMove: h.params.allowTouchMove,
          touches: {
            startX: 0,
            startY: 0,
            currentX: 0,
            currentY: 0,
            diff: 0
          },
          imagesToLoad: [],
          imagesLoaded: 0
        }), h.useModules(), h.params.init && h.init(), h;
      }
    }

    e && (t.__proto__ = e), t.prototype = Object.create(e && e.prototype), t.prototype.constructor = t;
    var i = {
      extendedDefaults: {
        configurable: !0
      },
      defaults: {
        configurable: !0
      },
      Class: {
        configurable: !0
      },
      $: {
        configurable: !0
      }
    };
    return t.prototype.slidesPerViewDynamic = function () {
      var e = this.params,
          t = this.slides,
          i = this.slidesGrid,
          s = this.size,
          a = this.activeIndex,
          r = 1;

      if (e.centeredSlides) {
        for (var n, o = t[a].swiperSlideSize, l = a + 1; l < t.length; l += 1) {
          t[l] && !n && (r += 1, (o += t[l].swiperSlideSize) > s && (n = !0));
        }

        for (var d = a - 1; d >= 0; d -= 1) {
          t[d] && !n && (r += 1, (o += t[d].swiperSlideSize) > s && (n = !0));
        }
      } else for (var h = a + 1; h < t.length; h += 1) {
        i[h] - i[a] < s && (r += 1);
      }

      return r;
    }, t.prototype.update = function () {
      var e = this;

      if (e && !e.destroyed) {
        var t = e.snapGrid,
            i = e.params;
        i.breakpoints && e.setBreakpoint(), e.updateSize(), e.updateSlides(), e.updateProgress(), e.updateSlidesClasses(), e.params.freeMode ? (s(), e.params.autoHeight && e.updateAutoHeight()) : (("auto" === e.params.slidesPerView || e.params.slidesPerView > 1) && e.isEnd && !e.params.centeredSlides ? e.slideTo(e.slides.length - 1, 0, !1, !0) : e.slideTo(e.activeIndex, 0, !1, !0)) || s(), i.watchOverflow && t !== e.snapGrid && e.checkOverflow(), e.emit("update");
      }

      function s() {
        var t = e.rtlTranslate ? -1 * e.translate : e.translate,
            i = Math.min(Math.max(t, e.maxTranslate()), e.minTranslate());
        e.setTranslate(i), e.updateActiveIndex(), e.updateSlidesClasses();
      }
    }, t.prototype.changeDirection = function (e, t) {
      void 0 === t && (t = !0);
      var i = this.params.direction;
      return e || (e = "horizontal" === i ? "vertical" : "horizontal"), e === i || "horizontal" !== e && "vertical" !== e ? this : (this.$el.removeClass("" + this.params.containerModifierClass + i).addClass("" + this.params.containerModifierClass + e), this.params.direction = e, this.slides.each(function (t, i) {
        "vertical" === e ? i.style.width = "" : i.style.height = "";
      }), this.emit("changeDirection"), t && this.update(), this);
    }, t.prototype.init = function () {
      this.initialized || (this.emit("beforeInit"), this.params.breakpoints && this.setBreakpoint(), this.addClasses(), this.params.loop && this.loopCreate(), this.updateSize(), this.updateSlides(), this.params.watchOverflow && this.checkOverflow(), this.params.grabCursor && this.setGrabCursor(), this.params.preloadImages && this.preloadImages(), this.params.loop ? this.slideTo(this.params.initialSlide + this.loopedSlides, 0, this.params.runCallbacksOnInit) : this.slideTo(this.params.initialSlide, 0, this.params.runCallbacksOnInit), this.attachEvents(), this.initialized = !0, this.emit("init"));
    }, t.prototype.destroy = function (e, t) {
      void 0 === e && (e = !0), void 0 === t && (t = !0);
      var i = this,
          s = i.params,
          a = i.$el,
          r = i.$wrapperEl,
          o = i.slides;
      return void 0 === i.params || i.destroyed ? null : (i.emit("beforeDestroy"), i.initialized = !1, i.detachEvents(), s.loop && i.loopDestroy(), t && (i.removeClasses(), a.removeAttr("style"), r.removeAttr("style"), o && o.length && o.removeClass([s.slideVisibleClass, s.slideActiveClass, s.slideNextClass, s.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-slide-index")), i.emit("destroy"), Object.keys(i.eventsListeners).forEach(function (e) {
        i.off(e);
      }), !1 !== e && (i.$el[0].swiper = null, i.$el.data("swiper", null), n.deleteProps(i)), i.destroyed = !0, null);
    }, t.extendDefaults = function (e) {
      n.extend(F, e);
    }, i.extendedDefaults.get = function () {
      return F;
    }, i.defaults.get = function () {
      return V;
    }, i.Class.get = function () {
      return e;
    }, i.$.get = function () {
      return s;
    }, Object.defineProperties(t, i), t;
  }(l),
      R = {
    name: "device",
    proto: {
      device: I
    },
    "static": {
      device: I
    }
  },
      q = {
    name: "support",
    proto: {
      support: o
    },
    "static": {
      support: o
    }
  },
      j = {
    isEdge: !!t.navigator.userAgent.match(/Edge/g),
    isSafari: function () {
      var e = t.navigator.userAgent.toLowerCase();
      return e.indexOf("safari") >= 0 && e.indexOf("chrome") < 0 && e.indexOf("android") < 0;
    }(),
    isUiWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(t.navigator.userAgent)
  },
      K = {
    name: "browser",
    proto: {
      browser: j
    },
    "static": {
      browser: j
    }
  },
      U = {
    name: "resize",
    create: function create() {
      var e = this;
      n.extend(e, {
        resize: {
          resizeHandler: function resizeHandler() {
            e && !e.destroyed && e.initialized && (e.emit("beforeResize"), e.emit("resize"));
          },
          orientationChangeHandler: function orientationChangeHandler() {
            e && !e.destroyed && e.initialized && e.emit("orientationchange");
          }
        }
      });
    },
    on: {
      init: function init() {
        t.addEventListener("resize", this.resize.resizeHandler), t.addEventListener("orientationchange", this.resize.orientationChangeHandler);
      },
      destroy: function destroy() {
        t.removeEventListener("resize", this.resize.resizeHandler), t.removeEventListener("orientationchange", this.resize.orientationChangeHandler);
      }
    }
  },
      _ = {
    func: t.MutationObserver || t.WebkitMutationObserver,
    attach: function attach(e, i) {
      void 0 === i && (i = {});
      var s = this,
          a = new (0, _.func)(function (e) {
        if (1 !== e.length) {
          var i = function i() {
            s.emit("observerUpdate", e[0]);
          };

          t.requestAnimationFrame ? t.requestAnimationFrame(i) : t.setTimeout(i, 0);
        } else s.emit("observerUpdate", e[0]);
      });
      a.observe(e, {
        attributes: void 0 === i.attributes || i.attributes,
        childList: void 0 === i.childList || i.childList,
        characterData: void 0 === i.characterData || i.characterData
      }), s.observer.observers.push(a);
    },
    init: function init() {
      if (o.observer && this.params.observer) {
        if (this.params.observeParents) for (var e = this.$el.parents(), t = 0; t < e.length; t += 1) {
          this.observer.attach(e[t]);
        }
        this.observer.attach(this.$el[0], {
          childList: this.params.observeSlideChildren
        }), this.observer.attach(this.$wrapperEl[0], {
          attributes: !1
        });
      }
    },
    destroy: function destroy() {
      this.observer.observers.forEach(function (e) {
        e.disconnect();
      }), this.observer.observers = [];
    }
  },
      Z = {
    name: "observer",
    params: {
      observer: !1,
      observeParents: !1,
      observeSlideChildren: !1
    },
    create: function create() {
      n.extend(this, {
        observer: {
          init: _.init.bind(this),
          attach: _.attach.bind(this),
          destroy: _.destroy.bind(this),
          observers: []
        }
      });
    },
    on: {
      init: function init() {
        this.observer.init();
      },
      destroy: function destroy() {
        this.observer.destroy();
      }
    }
  },
      Q = {
    update: function update(e) {
      var t = this,
          i = t.params,
          s = i.slidesPerView,
          a = i.slidesPerGroup,
          r = i.centeredSlides,
          o = t.params.virtual,
          l = o.addSlidesBefore,
          d = o.addSlidesAfter,
          h = t.virtual,
          p = h.from,
          c = h.to,
          u = h.slides,
          v = h.slidesGrid,
          f = h.renderSlide,
          m = h.offset;
      t.updateActiveIndex();
      var g,
          b,
          w,
          y = t.activeIndex || 0;
      g = t.rtlTranslate ? "right" : t.isHorizontal() ? "left" : "top", r ? (b = Math.floor(s / 2) + a + l, w = Math.floor(s / 2) + a + d) : (b = s + (a - 1) + l, w = a + d);
      var x = Math.max((y || 0) - w, 0),
          T = Math.min((y || 0) + b, u.length - 1),
          E = (t.slidesGrid[x] || 0) - (t.slidesGrid[0] || 0);

      function S() {
        t.updateSlides(), t.updateProgress(), t.updateSlidesClasses(), t.lazy && t.params.lazy.enabled && t.lazy.load();
      }

      if (n.extend(t.virtual, {
        from: x,
        to: T,
        offset: E,
        slidesGrid: t.slidesGrid
      }), p === x && c === T && !e) return t.slidesGrid !== v && E !== m && t.slides.css(g, E + "px"), void t.updateProgress();
      if (t.params.virtual.renderExternal) return t.params.virtual.renderExternal.call(t, {
        offset: E,
        from: x,
        to: T,
        slides: function () {
          for (var e = [], t = x; t <= T; t += 1) {
            e.push(u[t]);
          }

          return e;
        }()
      }), void S();
      var C = [],
          M = [];
      if (e) t.$wrapperEl.find("." + t.params.slideClass).remove();else for (var P = p; P <= c; P += 1) {
        (P < x || P > T) && t.$wrapperEl.find("." + t.params.slideClass + '[data-swiper-slide-index="' + P + '"]').remove();
      }

      for (var z = 0; z < u.length; z += 1) {
        z >= x && z <= T && (void 0 === c || e ? M.push(z) : (z > c && M.push(z), z < p && C.push(z)));
      }

      M.forEach(function (e) {
        t.$wrapperEl.append(f(u[e], e));
      }), C.sort(function (e, t) {
        return t - e;
      }).forEach(function (e) {
        t.$wrapperEl.prepend(f(u[e], e));
      }), t.$wrapperEl.children(".swiper-slide").css(g, E + "px"), S();
    },
    renderSlide: function renderSlide(e, t) {
      var i = this.params.virtual;
      if (i.cache && this.virtual.cache[t]) return this.virtual.cache[t];
      var a = i.renderSlide ? s(i.renderSlide.call(this, e, t)) : s('<div class="' + this.params.slideClass + '" data-swiper-slide-index="' + t + '">' + e + "</div>");
      return a.attr("data-swiper-slide-index") || a.attr("data-swiper-slide-index", t), i.cache && (this.virtual.cache[t] = a), a;
    },
    appendSlide: function appendSlide(e) {
      if ("object" == _typeof(e) && "length" in e) for (var t = 0; t < e.length; t += 1) {
        e[t] && this.virtual.slides.push(e[t]);
      } else this.virtual.slides.push(e);
      this.virtual.update(!0);
    },
    prependSlide: function prependSlide(e) {
      var t = this.activeIndex,
          i = t + 1,
          s = 1;

      if (Array.isArray(e)) {
        for (var a = 0; a < e.length; a += 1) {
          e[a] && this.virtual.slides.unshift(e[a]);
        }

        i = t + e.length, s = e.length;
      } else this.virtual.slides.unshift(e);

      if (this.params.virtual.cache) {
        var r = this.virtual.cache,
            n = {};
        Object.keys(r).forEach(function (e) {
          var t = r[e],
              i = t.attr("data-swiper-slide-index");
          i && t.attr("data-swiper-slide-index", parseInt(i, 10) + 1), n[parseInt(e, 10) + s] = t;
        }), this.virtual.cache = n;
      }

      this.virtual.update(!0), this.slideTo(i, 0);
    },
    removeSlide: function removeSlide(e) {
      if (null != e) {
        var t = this.activeIndex;
        if (Array.isArray(e)) for (var i = e.length - 1; i >= 0; i -= 1) {
          this.virtual.slides.splice(e[i], 1), this.params.virtual.cache && delete this.virtual.cache[e[i]], e[i] < t && (t -= 1), t = Math.max(t, 0);
        } else this.virtual.slides.splice(e, 1), this.params.virtual.cache && delete this.virtual.cache[e], e < t && (t -= 1), t = Math.max(t, 0);
        this.virtual.update(!0), this.slideTo(t, 0);
      }
    },
    removeAllSlides: function removeAllSlides() {
      this.virtual.slides = [], this.params.virtual.cache && (this.virtual.cache = {}), this.virtual.update(!0), this.slideTo(0, 0);
    }
  },
      J = {
    name: "virtual",
    params: {
      virtual: {
        enabled: !1,
        slides: [],
        cache: !0,
        renderSlide: null,
        renderExternal: null,
        addSlidesBefore: 0,
        addSlidesAfter: 0
      }
    },
    create: function create() {
      n.extend(this, {
        virtual: {
          update: Q.update.bind(this),
          appendSlide: Q.appendSlide.bind(this),
          prependSlide: Q.prependSlide.bind(this),
          removeSlide: Q.removeSlide.bind(this),
          removeAllSlides: Q.removeAllSlides.bind(this),
          renderSlide: Q.renderSlide.bind(this),
          slides: this.params.virtual.slides,
          cache: {}
        }
      });
    },
    on: {
      beforeInit: function beforeInit() {
        if (this.params.virtual.enabled) {
          this.classNames.push(this.params.containerModifierClass + "virtual");
          var e = {
            watchSlidesProgress: !0
          };
          n.extend(this.params, e), n.extend(this.originalParams, e), this.params.initialSlide || this.virtual.update();
        }
      },
      setTranslate: function setTranslate() {
        this.params.virtual.enabled && this.virtual.update();
      }
    }
  },
      ee = {
    handle: function handle(i) {
      var s = this.rtlTranslate,
          a = i;
      a.originalEvent && (a = a.originalEvent);
      var r = a.keyCode || a.charCode;
      if (!this.allowSlideNext && (this.isHorizontal() && 39 === r || this.isVertical() && 40 === r || 34 === r)) return !1;
      if (!this.allowSlidePrev && (this.isHorizontal() && 37 === r || this.isVertical() && 38 === r || 33 === r)) return !1;

      if (!(a.shiftKey || a.altKey || a.ctrlKey || a.metaKey || e.activeElement && e.activeElement.nodeName && ("input" === e.activeElement.nodeName.toLowerCase() || "textarea" === e.activeElement.nodeName.toLowerCase()))) {
        if (this.params.keyboard.onlyInViewport && (33 === r || 34 === r || 37 === r || 39 === r || 38 === r || 40 === r)) {
          var n = !1;
          if (this.$el.parents("." + this.params.slideClass).length > 0 && 0 === this.$el.parents("." + this.params.slideActiveClass).length) return;
          var o = t.innerWidth,
              l = t.innerHeight,
              d = this.$el.offset();
          s && (d.left -= this.$el[0].scrollLeft);

          for (var h = [[d.left, d.top], [d.left + this.width, d.top], [d.left, d.top + this.height], [d.left + this.width, d.top + this.height]], p = 0; p < h.length; p += 1) {
            var c = h[p];
            c[0] >= 0 && c[0] <= o && c[1] >= 0 && c[1] <= l && (n = !0);
          }

          if (!n) return;
        }

        this.isHorizontal() ? (33 !== r && 34 !== r && 37 !== r && 39 !== r || (a.preventDefault ? a.preventDefault() : a.returnValue = !1), (34 !== r && 39 !== r || s) && (33 !== r && 37 !== r || !s) || this.slideNext(), (33 !== r && 37 !== r || s) && (34 !== r && 39 !== r || !s) || this.slidePrev()) : (33 !== r && 34 !== r && 38 !== r && 40 !== r || (a.preventDefault ? a.preventDefault() : a.returnValue = !1), 34 !== r && 40 !== r || this.slideNext(), 33 !== r && 38 !== r || this.slidePrev()), this.emit("keyPress", r);
      }
    },
    enable: function enable() {
      this.keyboard.enabled || (s(e).on("keydown", this.keyboard.handle), this.keyboard.enabled = !0);
    },
    disable: function disable() {
      this.keyboard.enabled && (s(e).off("keydown", this.keyboard.handle), this.keyboard.enabled = !1);
    }
  },
      te = {
    name: "keyboard",
    params: {
      keyboard: {
        enabled: !1,
        onlyInViewport: !0
      }
    },
    create: function create() {
      n.extend(this, {
        keyboard: {
          enabled: !1,
          enable: ee.enable.bind(this),
          disable: ee.disable.bind(this),
          handle: ee.handle.bind(this)
        }
      });
    },
    on: {
      init: function init() {
        this.params.keyboard.enabled && this.keyboard.enable();
      },
      destroy: function destroy() {
        this.keyboard.enabled && this.keyboard.disable();
      }
    }
  };

  var ie = {
    lastScrollTime: n.now(),
    lastEventBeforeSnap: void 0,
    recentWheelEvents: [],
    event: function event() {
      return t.navigator.userAgent.indexOf("firefox") > -1 ? "DOMMouseScroll" : function () {
        var t = ("onwheel" in e);

        if (!t) {
          var i = e.createElement("div");
          i.setAttribute("onwheel", "return;"), t = "function" == typeof i.onwheel;
        }

        return !t && e.implementation && e.implementation.hasFeature && !0 !== e.implementation.hasFeature("", "") && (t = e.implementation.hasFeature("Events.wheel", "3.0")), t;
      }() ? "wheel" : "mousewheel";
    },
    normalize: function normalize(e) {
      var t = 0,
          i = 0,
          s = 0,
          a = 0;
      return "detail" in e && (i = e.detail), "wheelDelta" in e && (i = -e.wheelDelta / 120), "wheelDeltaY" in e && (i = -e.wheelDeltaY / 120), "wheelDeltaX" in e && (t = -e.wheelDeltaX / 120), "axis" in e && e.axis === e.HORIZONTAL_AXIS && (t = i, i = 0), s = 10 * t, a = 10 * i, "deltaY" in e && (a = e.deltaY), "deltaX" in e && (s = e.deltaX), e.shiftKey && !s && (s = a, a = 0), (s || a) && e.deltaMode && (1 === e.deltaMode ? (s *= 40, a *= 40) : (s *= 800, a *= 800)), s && !t && (t = s < 1 ? -1 : 1), a && !i && (i = a < 1 ? -1 : 1), {
        spinX: t,
        spinY: i,
        pixelX: s,
        pixelY: a
      };
    },
    handleMouseEnter: function handleMouseEnter() {
      this.mouseEntered = !0;
    },
    handleMouseLeave: function handleMouseLeave() {
      this.mouseEntered = !1;
    },
    handle: function handle(e) {
      var t = e,
          i = this,
          a = i.params.mousewheel;
      i.params.cssMode && t.preventDefault();
      var r = i.$el;
      if ("container" !== i.params.mousewheel.eventsTarged && (r = s(i.params.mousewheel.eventsTarged)), !i.mouseEntered && !r[0].contains(t.target) && !a.releaseOnEdges) return !0;
      t.originalEvent && (t = t.originalEvent);
      var o = 0,
          l = i.rtlTranslate ? -1 : 1,
          d = ie.normalize(t);
      if (a.forceToAxis) {
        if (i.isHorizontal()) {
          if (!(Math.abs(d.pixelX) > Math.abs(d.pixelY))) return !0;
          o = d.pixelX * l;
        } else {
          if (!(Math.abs(d.pixelY) > Math.abs(d.pixelX))) return !0;
          o = d.pixelY;
        }
      } else o = Math.abs(d.pixelX) > Math.abs(d.pixelY) ? -d.pixelX * l : -d.pixelY;
      if (0 === o) return !0;

      if (a.invert && (o = -o), i.params.freeMode) {
        var h = {
          time: n.now(),
          delta: Math.abs(o),
          direction: Math.sign(o)
        },
            p = i.mousewheel.lastEventBeforeSnap,
            c = p && h.time < p.time + 500 && h.delta <= p.delta && h.direction === p.direction;

        if (!c) {
          i.mousewheel.lastEventBeforeSnap = void 0, i.params.loop && i.loopFix();
          var u = i.getTranslate() + o * a.sensitivity,
              v = i.isBeginning,
              f = i.isEnd;

          if (u >= i.minTranslate() && (u = i.minTranslate()), u <= i.maxTranslate() && (u = i.maxTranslate()), i.setTransition(0), i.setTranslate(u), i.updateProgress(), i.updateActiveIndex(), i.updateSlidesClasses(), (!v && i.isBeginning || !f && i.isEnd) && i.updateSlidesClasses(), i.params.freeModeSticky) {
            clearTimeout(i.mousewheel.timeout), i.mousewheel.timeout = void 0;
            var m = i.mousewheel.recentWheelEvents;
            m.length >= 15 && m.shift();
            var g = m.length ? m[m.length - 1] : void 0,
                b = m[0];
            if (m.push(h), g && (h.delta > g.delta || h.direction !== g.direction)) m.splice(0);else if (m.length >= 15 && h.time - b.time < 500 && b.delta - h.delta >= 1 && h.delta <= 6) {
              var w = o > 0 ? .8 : .2;
              i.mousewheel.lastEventBeforeSnap = h, m.splice(0), i.mousewheel.timeout = n.nextTick(function () {
                i.slideToClosest(i.params.speed, !0, void 0, w);
              }, 0);
            }
            i.mousewheel.timeout || (i.mousewheel.timeout = n.nextTick(function () {
              i.mousewheel.lastEventBeforeSnap = h, m.splice(0), i.slideToClosest(i.params.speed, !0, void 0, .5);
            }, 500));
          }

          if (c || i.emit("scroll", t), i.params.autoplay && i.params.autoplayDisableOnInteraction && i.autoplay.stop(), u === i.minTranslate() || u === i.maxTranslate()) return !0;
        }
      } else {
        var y = {
          time: n.now(),
          delta: Math.abs(o),
          direction: Math.sign(o),
          raw: e
        },
            x = i.mousewheel.recentWheelEvents;
        x.length >= 2 && x.shift();
        var T = x.length ? x[x.length - 1] : void 0;
        if (x.push(y), T ? (y.direction !== T.direction || y.delta > T.delta) && i.mousewheel.animateSlider(y) : i.mousewheel.animateSlider(y), i.mousewheel.releaseScroll(y)) return !0;
      }

      return t.preventDefault ? t.preventDefault() : t.returnValue = !1, !1;
    },
    animateSlider: function animateSlider(e) {
      return e.delta >= 6 && n.now() - this.mousewheel.lastScrollTime < 60 || (e.direction < 0 ? this.isEnd && !this.params.loop || this.animating || (this.slideNext(), this.emit("scroll", e.raw)) : this.isBeginning && !this.params.loop || this.animating || (this.slidePrev(), this.emit("scroll", e.raw)), this.mousewheel.lastScrollTime = new t.Date().getTime(), !1);
    },
    releaseScroll: function releaseScroll(e) {
      var t = this.params.mousewheel;

      if (e.direction < 0) {
        if (this.isEnd && !this.params.loop && t.releaseOnEdges) return !0;
      } else if (this.isBeginning && !this.params.loop && t.releaseOnEdges) return !0;

      return !1;
    },
    enable: function enable() {
      var e = ie.event();
      if (this.params.cssMode) return this.wrapperEl.removeEventListener(e, this.mousewheel.handle), !0;
      if (!e) return !1;
      if (this.mousewheel.enabled) return !1;
      var t = this.$el;
      return "container" !== this.params.mousewheel.eventsTarged && (t = s(this.params.mousewheel.eventsTarged)), t.on("mouseenter", this.mousewheel.handleMouseEnter), t.on("mouseleave", this.mousewheel.handleMouseLeave), t.on(e, this.mousewheel.handle), this.mousewheel.enabled = !0, !0;
    },
    disable: function disable() {
      var e = ie.event();
      if (this.params.cssMode) return this.wrapperEl.addEventListener(e, this.mousewheel.handle), !0;
      if (!e) return !1;
      if (!this.mousewheel.enabled) return !1;
      var t = this.$el;
      return "container" !== this.params.mousewheel.eventsTarged && (t = s(this.params.mousewheel.eventsTarged)), t.off(e, this.mousewheel.handle), this.mousewheel.enabled = !1, !0;
    }
  },
      se = {
    update: function update() {
      var e = this.params.navigation;

      if (!this.params.loop) {
        var t = this.navigation,
            i = t.$nextEl,
            s = t.$prevEl;
        s && s.length > 0 && (this.isBeginning ? s.addClass(e.disabledClass) : s.removeClass(e.disabledClass), s[this.params.watchOverflow && this.isLocked ? "addClass" : "removeClass"](e.lockClass)), i && i.length > 0 && (this.isEnd ? i.addClass(e.disabledClass) : i.removeClass(e.disabledClass), i[this.params.watchOverflow && this.isLocked ? "addClass" : "removeClass"](e.lockClass));
      }
    },
    onPrevClick: function onPrevClick(e) {
      e.preventDefault(), this.isBeginning && !this.params.loop || this.slidePrev();
    },
    onNextClick: function onNextClick(e) {
      e.preventDefault(), this.isEnd && !this.params.loop || this.slideNext();
    },
    init: function init() {
      var e,
          t,
          i = this.params.navigation;
      (i.nextEl || i.prevEl) && (i.nextEl && (e = s(i.nextEl), this.params.uniqueNavElements && "string" == typeof i.nextEl && e.length > 1 && 1 === this.$el.find(i.nextEl).length && (e = this.$el.find(i.nextEl))), i.prevEl && (t = s(i.prevEl), this.params.uniqueNavElements && "string" == typeof i.prevEl && t.length > 1 && 1 === this.$el.find(i.prevEl).length && (t = this.$el.find(i.prevEl))), e && e.length > 0 && e.on("click", this.navigation.onNextClick), t && t.length > 0 && t.on("click", this.navigation.onPrevClick), n.extend(this.navigation, {
        $nextEl: e,
        nextEl: e && e[0],
        $prevEl: t,
        prevEl: t && t[0]
      }));
    },
    destroy: function destroy() {
      var e = this.navigation,
          t = e.$nextEl,
          i = e.$prevEl;
      t && t.length && (t.off("click", this.navigation.onNextClick), t.removeClass(this.params.navigation.disabledClass)), i && i.length && (i.off("click", this.navigation.onPrevClick), i.removeClass(this.params.navigation.disabledClass));
    }
  },
      ae = {
    update: function update() {
      var e = this.rtl,
          t = this.params.pagination;

      if (t.el && this.pagination.el && this.pagination.$el && 0 !== this.pagination.$el.length) {
        var i,
            a = this.virtual && this.params.virtual.enabled ? this.virtual.slides.length : this.slides.length,
            r = this.pagination.$el,
            n = this.params.loop ? Math.ceil((a - 2 * this.loopedSlides) / this.params.slidesPerGroup) : this.snapGrid.length;

        if (this.params.loop ? ((i = Math.ceil((this.activeIndex - this.loopedSlides) / this.params.slidesPerGroup)) > a - 1 - 2 * this.loopedSlides && (i -= a - 2 * this.loopedSlides), i > n - 1 && (i -= n), i < 0 && "bullets" !== this.params.paginationType && (i = n + i)) : i = void 0 !== this.snapIndex ? this.snapIndex : this.activeIndex || 0, "bullets" === t.type && this.pagination.bullets && this.pagination.bullets.length > 0) {
          var o,
              l,
              d,
              h = this.pagination.bullets;
          if (t.dynamicBullets && (this.pagination.bulletSize = h.eq(0)[this.isHorizontal() ? "outerWidth" : "outerHeight"](!0), r.css(this.isHorizontal() ? "width" : "height", this.pagination.bulletSize * (t.dynamicMainBullets + 4) + "px"), t.dynamicMainBullets > 1 && void 0 !== this.previousIndex && (this.pagination.dynamicBulletIndex += i - this.previousIndex, this.pagination.dynamicBulletIndex > t.dynamicMainBullets - 1 ? this.pagination.dynamicBulletIndex = t.dynamicMainBullets - 1 : this.pagination.dynamicBulletIndex < 0 && (this.pagination.dynamicBulletIndex = 0)), o = i - this.pagination.dynamicBulletIndex, d = ((l = o + (Math.min(h.length, t.dynamicMainBullets) - 1)) + o) / 2), h.removeClass(t.bulletActiveClass + " " + t.bulletActiveClass + "-next " + t.bulletActiveClass + "-next-next " + t.bulletActiveClass + "-prev " + t.bulletActiveClass + "-prev-prev " + t.bulletActiveClass + "-main"), r.length > 1) h.each(function (e, a) {
            var r = s(a),
                n = r.index();
            n === i && r.addClass(t.bulletActiveClass), t.dynamicBullets && (n >= o && n <= l && r.addClass(t.bulletActiveClass + "-main"), n === o && r.prev().addClass(t.bulletActiveClass + "-prev").prev().addClass(t.bulletActiveClass + "-prev-prev"), n === l && r.next().addClass(t.bulletActiveClass + "-next").next().addClass(t.bulletActiveClass + "-next-next"));
          });else {
            var p = h.eq(i),
                c = p.index();

            if (p.addClass(t.bulletActiveClass), t.dynamicBullets) {
              for (var u = h.eq(o), v = h.eq(l), f = o; f <= l; f += 1) {
                h.eq(f).addClass(t.bulletActiveClass + "-main");
              }

              if (this.params.loop) {
                if (c >= h.length - t.dynamicMainBullets) {
                  for (var m = t.dynamicMainBullets; m >= 0; m -= 1) {
                    h.eq(h.length - m).addClass(t.bulletActiveClass + "-main");
                  }

                  h.eq(h.length - t.dynamicMainBullets - 1).addClass(t.bulletActiveClass + "-prev");
                } else u.prev().addClass(t.bulletActiveClass + "-prev").prev().addClass(t.bulletActiveClass + "-prev-prev"), v.next().addClass(t.bulletActiveClass + "-next").next().addClass(t.bulletActiveClass + "-next-next");
              } else u.prev().addClass(t.bulletActiveClass + "-prev").prev().addClass(t.bulletActiveClass + "-prev-prev"), v.next().addClass(t.bulletActiveClass + "-next").next().addClass(t.bulletActiveClass + "-next-next");
            }
          }

          if (t.dynamicBullets) {
            var g = Math.min(h.length, t.dynamicMainBullets + 4),
                b = (this.pagination.bulletSize * g - this.pagination.bulletSize) / 2 - d * this.pagination.bulletSize,
                w = e ? "right" : "left";
            h.css(this.isHorizontal() ? w : "top", b + "px");
          }
        }

        if ("fraction" === t.type && (r.find("." + t.currentClass).text(t.formatFractionCurrent(i + 1)), r.find("." + t.totalClass).text(t.formatFractionTotal(n))), "progressbar" === t.type) {
          var y;
          y = t.progressbarOpposite ? this.isHorizontal() ? "vertical" : "horizontal" : this.isHorizontal() ? "horizontal" : "vertical";
          var x = (i + 1) / n,
              T = 1,
              E = 1;
          "horizontal" === y ? T = x : E = x, r.find("." + t.progressbarFillClass).transform("translate3d(0,0,0) scaleX(" + T + ") scaleY(" + E + ")").transition(this.params.speed);
        }

        "custom" === t.type && t.renderCustom ? (r.html(t.renderCustom(this, i + 1, n)), this.emit("paginationRender", this, r[0])) : this.emit("paginationUpdate", this, r[0]), r[this.params.watchOverflow && this.isLocked ? "addClass" : "removeClass"](t.lockClass);
      }
    },
    render: function render() {
      var e = this.params.pagination;

      if (e.el && this.pagination.el && this.pagination.$el && 0 !== this.pagination.$el.length) {
        var t = this.virtual && this.params.virtual.enabled ? this.virtual.slides.length : this.slides.length,
            i = this.pagination.$el,
            s = "";

        if ("bullets" === e.type) {
          for (var a = this.params.loop ? Math.ceil((t - 2 * this.loopedSlides) / this.params.slidesPerGroup) : this.snapGrid.length, r = 0; r < a; r += 1) {
            e.renderBullet ? s += e.renderBullet.call(this, r, e.bulletClass) : s += "<" + e.bulletElement + ' class="' + e.bulletClass + '"></' + e.bulletElement + ">";
          }

          i.html(s), this.pagination.bullets = i.find("." + e.bulletClass);
        }

        "fraction" === e.type && (s = e.renderFraction ? e.renderFraction.call(this, e.currentClass, e.totalClass) : '<span class="' + e.currentClass + '"></span> / <span class="' + e.totalClass + '"></span>', i.html(s)), "progressbar" === e.type && (s = e.renderProgressbar ? e.renderProgressbar.call(this, e.progressbarFillClass) : '<span class="' + e.progressbarFillClass + '"></span>', i.html(s)), "custom" !== e.type && this.emit("paginationRender", this.pagination.$el[0]);
      }
    },
    init: function init() {
      var e = this,
          t = e.params.pagination;

      if (t.el) {
        var i = s(t.el);
        0 !== i.length && (e.params.uniqueNavElements && "string" == typeof t.el && i.length > 1 && 1 === e.$el.find(t.el).length && (i = e.$el.find(t.el)), "bullets" === t.type && t.clickable && i.addClass(t.clickableClass), i.addClass(t.modifierClass + t.type), "bullets" === t.type && t.dynamicBullets && (i.addClass("" + t.modifierClass + t.type + "-dynamic"), e.pagination.dynamicBulletIndex = 0, t.dynamicMainBullets < 1 && (t.dynamicMainBullets = 1)), "progressbar" === t.type && t.progressbarOpposite && i.addClass(t.progressbarOppositeClass), t.clickable && i.on("click", "." + t.bulletClass, function (t) {
          t.preventDefault();
          var i = s(this).index() * e.params.slidesPerGroup;
          e.params.loop && (i += e.loopedSlides), e.slideTo(i);
        }), n.extend(e.pagination, {
          $el: i,
          el: i[0]
        }));
      }
    },
    destroy: function destroy() {
      var e = this.params.pagination;

      if (e.el && this.pagination.el && this.pagination.$el && 0 !== this.pagination.$el.length) {
        var t = this.pagination.$el;
        t.removeClass(e.hiddenClass), t.removeClass(e.modifierClass + e.type), this.pagination.bullets && this.pagination.bullets.removeClass(e.bulletActiveClass), e.clickable && t.off("click", "." + e.bulletClass);
      }
    }
  },
      re = {
    setTranslate: function setTranslate() {
      if (this.params.scrollbar.el && this.scrollbar.el) {
        var e = this.scrollbar,
            t = this.rtlTranslate,
            i = this.progress,
            s = e.dragSize,
            a = e.trackSize,
            r = e.$dragEl,
            n = e.$el,
            o = this.params.scrollbar,
            l = s,
            d = (a - s) * i;
        t ? (d = -d) > 0 ? (l = s - d, d = 0) : -d + s > a && (l = a + d) : d < 0 ? (l = s + d, d = 0) : d + s > a && (l = a - d), this.isHorizontal() ? (r.transform("translate3d(" + d + "px, 0, 0)"), r[0].style.width = l + "px") : (r.transform("translate3d(0px, " + d + "px, 0)"), r[0].style.height = l + "px"), o.hide && (clearTimeout(this.scrollbar.timeout), n[0].style.opacity = 1, this.scrollbar.timeout = setTimeout(function () {
          n[0].style.opacity = 0, n.transition(400);
        }, 1e3));
      }
    },
    setTransition: function setTransition(e) {
      this.params.scrollbar.el && this.scrollbar.el && this.scrollbar.$dragEl.transition(e);
    },
    updateSize: function updateSize() {
      if (this.params.scrollbar.el && this.scrollbar.el) {
        var e = this.scrollbar,
            t = e.$dragEl,
            i = e.$el;
        t[0].style.width = "", t[0].style.height = "";
        var s,
            a = this.isHorizontal() ? i[0].offsetWidth : i[0].offsetHeight,
            r = this.size / this.virtualSize,
            o = r * (a / this.size);
        s = "auto" === this.params.scrollbar.dragSize ? a * r : parseInt(this.params.scrollbar.dragSize, 10), this.isHorizontal() ? t[0].style.width = s + "px" : t[0].style.height = s + "px", i[0].style.display = r >= 1 ? "none" : "", this.params.scrollbar.hide && (i[0].style.opacity = 0), n.extend(e, {
          trackSize: a,
          divider: r,
          moveDivider: o,
          dragSize: s
        }), e.$el[this.params.watchOverflow && this.isLocked ? "addClass" : "removeClass"](this.params.scrollbar.lockClass);
      }
    },
    getPointerPosition: function getPointerPosition(e) {
      return this.isHorizontal() ? "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].clientX : e.clientX : "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].clientY : e.clientY;
    },
    setDragPosition: function setDragPosition(e) {
      var t,
          i = this.scrollbar,
          s = this.rtlTranslate,
          a = i.$el,
          r = i.dragSize,
          n = i.trackSize,
          o = i.dragStartPos;
      t = (i.getPointerPosition(e) - a.offset()[this.isHorizontal() ? "left" : "top"] - (null !== o ? o : r / 2)) / (n - r), t = Math.max(Math.min(t, 1), 0), s && (t = 1 - t);
      var l = this.minTranslate() + (this.maxTranslate() - this.minTranslate()) * t;
      this.updateProgress(l), this.setTranslate(l), this.updateActiveIndex(), this.updateSlidesClasses();
    },
    onDragStart: function onDragStart(e) {
      var t = this.params.scrollbar,
          i = this.scrollbar,
          s = this.$wrapperEl,
          a = i.$el,
          r = i.$dragEl;
      this.scrollbar.isTouched = !0, this.scrollbar.dragStartPos = e.target === r[0] || e.target === r ? i.getPointerPosition(e) - e.target.getBoundingClientRect()[this.isHorizontal() ? "left" : "top"] : null, e.preventDefault(), e.stopPropagation(), s.transition(100), r.transition(100), i.setDragPosition(e), clearTimeout(this.scrollbar.dragTimeout), a.transition(0), t.hide && a.css("opacity", 1), this.params.cssMode && this.$wrapperEl.css("scroll-snap-type", "none"), this.emit("scrollbarDragStart", e);
    },
    onDragMove: function onDragMove(e) {
      var t = this.scrollbar,
          i = this.$wrapperEl,
          s = t.$el,
          a = t.$dragEl;
      this.scrollbar.isTouched && (e.preventDefault ? e.preventDefault() : e.returnValue = !1, t.setDragPosition(e), i.transition(0), s.transition(0), a.transition(0), this.emit("scrollbarDragMove", e));
    },
    onDragEnd: function onDragEnd(e) {
      var t = this.params.scrollbar,
          i = this.scrollbar,
          s = this.$wrapperEl,
          a = i.$el;
      this.scrollbar.isTouched && (this.scrollbar.isTouched = !1, this.params.cssMode && (this.$wrapperEl.css("scroll-snap-type", ""), s.transition("")), t.hide && (clearTimeout(this.scrollbar.dragTimeout), this.scrollbar.dragTimeout = n.nextTick(function () {
        a.css("opacity", 0), a.transition(400);
      }, 1e3)), this.emit("scrollbarDragEnd", e), t.snapOnRelease && this.slideToClosest());
    },
    enableDraggable: function enableDraggable() {
      if (this.params.scrollbar.el) {
        var t = this.scrollbar,
            i = this.touchEventsTouch,
            s = this.touchEventsDesktop,
            a = this.params,
            r = t.$el[0],
            n = !(!o.passiveListener || !a.passiveListeners) && {
          passive: !1,
          capture: !1
        },
            l = !(!o.passiveListener || !a.passiveListeners) && {
          passive: !0,
          capture: !1
        };
        o.touch ? (r.addEventListener(i.start, this.scrollbar.onDragStart, n), r.addEventListener(i.move, this.scrollbar.onDragMove, n), r.addEventListener(i.end, this.scrollbar.onDragEnd, l)) : (r.addEventListener(s.start, this.scrollbar.onDragStart, n), e.addEventListener(s.move, this.scrollbar.onDragMove, n), e.addEventListener(s.end, this.scrollbar.onDragEnd, l));
      }
    },
    disableDraggable: function disableDraggable() {
      if (this.params.scrollbar.el) {
        var t = this.scrollbar,
            i = this.touchEventsTouch,
            s = this.touchEventsDesktop,
            a = this.params,
            r = t.$el[0],
            n = !(!o.passiveListener || !a.passiveListeners) && {
          passive: !1,
          capture: !1
        },
            l = !(!o.passiveListener || !a.passiveListeners) && {
          passive: !0,
          capture: !1
        };
        o.touch ? (r.removeEventListener(i.start, this.scrollbar.onDragStart, n), r.removeEventListener(i.move, this.scrollbar.onDragMove, n), r.removeEventListener(i.end, this.scrollbar.onDragEnd, l)) : (r.removeEventListener(s.start, this.scrollbar.onDragStart, n), e.removeEventListener(s.move, this.scrollbar.onDragMove, n), e.removeEventListener(s.end, this.scrollbar.onDragEnd, l));
      }
    },
    init: function init() {
      if (this.params.scrollbar.el) {
        var e = this.scrollbar,
            t = this.$el,
            i = this.params.scrollbar,
            a = s(i.el);
        this.params.uniqueNavElements && "string" == typeof i.el && a.length > 1 && 1 === t.find(i.el).length && (a = t.find(i.el));
        var r = a.find("." + this.params.scrollbar.dragClass);
        0 === r.length && (r = s('<div class="' + this.params.scrollbar.dragClass + '"></div>'), a.append(r)), n.extend(e, {
          $el: a,
          el: a[0],
          $dragEl: r,
          dragEl: r[0]
        }), i.draggable && e.enableDraggable();
      }
    },
    destroy: function destroy() {
      this.scrollbar.disableDraggable();
    }
  },
      ne = {
    setTransform: function setTransform(e, t) {
      var i = this.rtl,
          a = s(e),
          r = i ? -1 : 1,
          n = a.attr("data-swiper-parallax") || "0",
          o = a.attr("data-swiper-parallax-x"),
          l = a.attr("data-swiper-parallax-y"),
          d = a.attr("data-swiper-parallax-scale"),
          h = a.attr("data-swiper-parallax-opacity");

      if (o || l ? (o = o || "0", l = l || "0") : this.isHorizontal() ? (o = n, l = "0") : (l = n, o = "0"), o = o.indexOf("%") >= 0 ? parseInt(o, 10) * t * r + "%" : o * t * r + "px", l = l.indexOf("%") >= 0 ? parseInt(l, 10) * t + "%" : l * t + "px", null != h) {
        var p = h - (h - 1) * (1 - Math.abs(t));
        a[0].style.opacity = p;
      }

      if (null == d) a.transform("translate3d(" + o + ", " + l + ", 0px)");else {
        var c = d - (d - 1) * (1 - Math.abs(t));
        a.transform("translate3d(" + o + ", " + l + ", 0px) scale(" + c + ")");
      }
    },
    setTranslate: function setTranslate() {
      var e = this,
          t = e.$el,
          i = e.slides,
          a = e.progress,
          r = e.snapGrid;
      t.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y], [data-swiper-parallax-opacity], [data-swiper-parallax-scale]").each(function (t, i) {
        e.parallax.setTransform(i, a);
      }), i.each(function (t, i) {
        var n = i.progress;
        e.params.slidesPerGroup > 1 && "auto" !== e.params.slidesPerView && (n += Math.ceil(t / 2) - a * (r.length - 1)), n = Math.min(Math.max(n, -1), 1), s(i).find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y], [data-swiper-parallax-opacity], [data-swiper-parallax-scale]").each(function (t, i) {
          e.parallax.setTransform(i, n);
        });
      });
    },
    setTransition: function setTransition(e) {
      void 0 === e && (e = this.params.speed);
      this.$el.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y], [data-swiper-parallax-opacity], [data-swiper-parallax-scale]").each(function (t, i) {
        var a = s(i),
            r = parseInt(a.attr("data-swiper-parallax-duration"), 10) || e;
        0 === e && (r = 0), a.transition(r);
      });
    }
  },
      oe = {
    getDistanceBetweenTouches: function getDistanceBetweenTouches(e) {
      if (e.targetTouches.length < 2) return 1;
      var t = e.targetTouches[0].pageX,
          i = e.targetTouches[0].pageY,
          s = e.targetTouches[1].pageX,
          a = e.targetTouches[1].pageY;
      return Math.sqrt(Math.pow(s - t, 2) + Math.pow(a - i, 2));
    },
    onGestureStart: function onGestureStart(e) {
      var t = this.params.zoom,
          i = this.zoom,
          a = i.gesture;

      if (i.fakeGestureTouched = !1, i.fakeGestureMoved = !1, !o.gestures) {
        if ("touchstart" !== e.type || "touchstart" === e.type && e.targetTouches.length < 2) return;
        i.fakeGestureTouched = !0, a.scaleStart = oe.getDistanceBetweenTouches(e);
      }

      a.$slideEl && a.$slideEl.length || (a.$slideEl = s(e.target).closest(".swiper-slide"), 0 === a.$slideEl.length && (a.$slideEl = this.slides.eq(this.activeIndex)), a.$imageEl = a.$slideEl.find("img, svg, canvas"), a.$imageWrapEl = a.$imageEl.parent("." + t.containerClass), a.maxRatio = a.$imageWrapEl.attr("data-swiper-zoom") || t.maxRatio, 0 !== a.$imageWrapEl.length) ? (a.$imageEl.transition(0), this.zoom.isScaling = !0) : a.$imageEl = void 0;
    },
    onGestureChange: function onGestureChange(e) {
      var t = this.params.zoom,
          i = this.zoom,
          s = i.gesture;

      if (!o.gestures) {
        if ("touchmove" !== e.type || "touchmove" === e.type && e.targetTouches.length < 2) return;
        i.fakeGestureMoved = !0, s.scaleMove = oe.getDistanceBetweenTouches(e);
      }

      s.$imageEl && 0 !== s.$imageEl.length && (o.gestures ? i.scale = e.scale * i.currentScale : i.scale = s.scaleMove / s.scaleStart * i.currentScale, i.scale > s.maxRatio && (i.scale = s.maxRatio - 1 + Math.pow(i.scale - s.maxRatio + 1, .5)), i.scale < t.minRatio && (i.scale = t.minRatio + 1 - Math.pow(t.minRatio - i.scale + 1, .5)), s.$imageEl.transform("translate3d(0,0,0) scale(" + i.scale + ")"));
    },
    onGestureEnd: function onGestureEnd(e) {
      var t = this.params.zoom,
          i = this.zoom,
          s = i.gesture;

      if (!o.gestures) {
        if (!i.fakeGestureTouched || !i.fakeGestureMoved) return;
        if ("touchend" !== e.type || "touchend" === e.type && e.changedTouches.length < 2 && !I.android) return;
        i.fakeGestureTouched = !1, i.fakeGestureMoved = !1;
      }

      s.$imageEl && 0 !== s.$imageEl.length && (i.scale = Math.max(Math.min(i.scale, s.maxRatio), t.minRatio), s.$imageEl.transition(this.params.speed).transform("translate3d(0,0,0) scale(" + i.scale + ")"), i.currentScale = i.scale, i.isScaling = !1, 1 === i.scale && (s.$slideEl = void 0));
    },
    onTouchStart: function onTouchStart(e) {
      var t = this.zoom,
          i = t.gesture,
          s = t.image;
      i.$imageEl && 0 !== i.$imageEl.length && (s.isTouched || (I.android && e.preventDefault(), s.isTouched = !0, s.touchesStart.x = "touchstart" === e.type ? e.targetTouches[0].pageX : e.pageX, s.touchesStart.y = "touchstart" === e.type ? e.targetTouches[0].pageY : e.pageY));
    },
    onTouchMove: function onTouchMove(e) {
      var t = this.zoom,
          i = t.gesture,
          s = t.image,
          a = t.velocity;

      if (i.$imageEl && 0 !== i.$imageEl.length && (this.allowClick = !1, s.isTouched && i.$slideEl)) {
        s.isMoved || (s.width = i.$imageEl[0].offsetWidth, s.height = i.$imageEl[0].offsetHeight, s.startX = n.getTranslate(i.$imageWrapEl[0], "x") || 0, s.startY = n.getTranslate(i.$imageWrapEl[0], "y") || 0, i.slideWidth = i.$slideEl[0].offsetWidth, i.slideHeight = i.$slideEl[0].offsetHeight, i.$imageWrapEl.transition(0), this.rtl && (s.startX = -s.startX, s.startY = -s.startY));
        var r = s.width * t.scale,
            o = s.height * t.scale;

        if (!(r < i.slideWidth && o < i.slideHeight)) {
          if (s.minX = Math.min(i.slideWidth / 2 - r / 2, 0), s.maxX = -s.minX, s.minY = Math.min(i.slideHeight / 2 - o / 2, 0), s.maxY = -s.minY, s.touchesCurrent.x = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, s.touchesCurrent.y = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, !s.isMoved && !t.isScaling) {
            if (this.isHorizontal() && (Math.floor(s.minX) === Math.floor(s.startX) && s.touchesCurrent.x < s.touchesStart.x || Math.floor(s.maxX) === Math.floor(s.startX) && s.touchesCurrent.x > s.touchesStart.x)) return void (s.isTouched = !1);
            if (!this.isHorizontal() && (Math.floor(s.minY) === Math.floor(s.startY) && s.touchesCurrent.y < s.touchesStart.y || Math.floor(s.maxY) === Math.floor(s.startY) && s.touchesCurrent.y > s.touchesStart.y)) return void (s.isTouched = !1);
          }

          e.preventDefault(), e.stopPropagation(), s.isMoved = !0, s.currentX = s.touchesCurrent.x - s.touchesStart.x + s.startX, s.currentY = s.touchesCurrent.y - s.touchesStart.y + s.startY, s.currentX < s.minX && (s.currentX = s.minX + 1 - Math.pow(s.minX - s.currentX + 1, .8)), s.currentX > s.maxX && (s.currentX = s.maxX - 1 + Math.pow(s.currentX - s.maxX + 1, .8)), s.currentY < s.minY && (s.currentY = s.minY + 1 - Math.pow(s.minY - s.currentY + 1, .8)), s.currentY > s.maxY && (s.currentY = s.maxY - 1 + Math.pow(s.currentY - s.maxY + 1, .8)), a.prevPositionX || (a.prevPositionX = s.touchesCurrent.x), a.prevPositionY || (a.prevPositionY = s.touchesCurrent.y), a.prevTime || (a.prevTime = Date.now()), a.x = (s.touchesCurrent.x - a.prevPositionX) / (Date.now() - a.prevTime) / 2, a.y = (s.touchesCurrent.y - a.prevPositionY) / (Date.now() - a.prevTime) / 2, Math.abs(s.touchesCurrent.x - a.prevPositionX) < 2 && (a.x = 0), Math.abs(s.touchesCurrent.y - a.prevPositionY) < 2 && (a.y = 0), a.prevPositionX = s.touchesCurrent.x, a.prevPositionY = s.touchesCurrent.y, a.prevTime = Date.now(), i.$imageWrapEl.transform("translate3d(" + s.currentX + "px, " + s.currentY + "px,0)");
        }
      }
    },
    onTouchEnd: function onTouchEnd() {
      var e = this.zoom,
          t = e.gesture,
          i = e.image,
          s = e.velocity;

      if (t.$imageEl && 0 !== t.$imageEl.length) {
        if (!i.isTouched || !i.isMoved) return i.isTouched = !1, void (i.isMoved = !1);
        i.isTouched = !1, i.isMoved = !1;
        var a = 300,
            r = 300,
            n = s.x * a,
            o = i.currentX + n,
            l = s.y * r,
            d = i.currentY + l;
        0 !== s.x && (a = Math.abs((o - i.currentX) / s.x)), 0 !== s.y && (r = Math.abs((d - i.currentY) / s.y));
        var h = Math.max(a, r);
        i.currentX = o, i.currentY = d;
        var p = i.width * e.scale,
            c = i.height * e.scale;
        i.minX = Math.min(t.slideWidth / 2 - p / 2, 0), i.maxX = -i.minX, i.minY = Math.min(t.slideHeight / 2 - c / 2, 0), i.maxY = -i.minY, i.currentX = Math.max(Math.min(i.currentX, i.maxX), i.minX), i.currentY = Math.max(Math.min(i.currentY, i.maxY), i.minY), t.$imageWrapEl.transition(h).transform("translate3d(" + i.currentX + "px, " + i.currentY + "px,0)");
      }
    },
    onTransitionEnd: function onTransitionEnd() {
      var e = this.zoom,
          t = e.gesture;
      t.$slideEl && this.previousIndex !== this.activeIndex && (t.$imageEl.transform("translate3d(0,0,0) scale(1)"), t.$imageWrapEl.transform("translate3d(0,0,0)"), e.scale = 1, e.currentScale = 1, t.$slideEl = void 0, t.$imageEl = void 0, t.$imageWrapEl = void 0);
    },
    toggle: function toggle(e) {
      var t = this.zoom;
      t.scale && 1 !== t.scale ? t.out() : t["in"](e);
    },
    "in": function _in(e) {
      var t,
          i,
          a,
          r,
          n,
          o,
          l,
          d,
          h,
          p,
          c,
          u,
          v,
          f,
          m,
          g,
          b = this.zoom,
          w = this.params.zoom,
          y = b.gesture,
          x = b.image;
      (y.$slideEl || (y.$slideEl = this.clickedSlide ? s(this.clickedSlide) : this.slides.eq(this.activeIndex), y.$imageEl = y.$slideEl.find("img, svg, canvas"), y.$imageWrapEl = y.$imageEl.parent("." + w.containerClass)), y.$imageEl && 0 !== y.$imageEl.length) && (y.$slideEl.addClass("" + w.zoomedSlideClass), void 0 === x.touchesStart.x && e ? (t = "touchend" === e.type ? e.changedTouches[0].pageX : e.pageX, i = "touchend" === e.type ? e.changedTouches[0].pageY : e.pageY) : (t = x.touchesStart.x, i = x.touchesStart.y), b.scale = y.$imageWrapEl.attr("data-swiper-zoom") || w.maxRatio, b.currentScale = y.$imageWrapEl.attr("data-swiper-zoom") || w.maxRatio, e ? (m = y.$slideEl[0].offsetWidth, g = y.$slideEl[0].offsetHeight, a = y.$slideEl.offset().left + m / 2 - t, r = y.$slideEl.offset().top + g / 2 - i, l = y.$imageEl[0].offsetWidth, d = y.$imageEl[0].offsetHeight, h = l * b.scale, p = d * b.scale, v = -(c = Math.min(m / 2 - h / 2, 0)), f = -(u = Math.min(g / 2 - p / 2, 0)), (n = a * b.scale) < c && (n = c), n > v && (n = v), (o = r * b.scale) < u && (o = u), o > f && (o = f)) : (n = 0, o = 0), y.$imageWrapEl.transition(300).transform("translate3d(" + n + "px, " + o + "px,0)"), y.$imageEl.transition(300).transform("translate3d(0,0,0) scale(" + b.scale + ")"));
    },
    out: function out() {
      var e = this.zoom,
          t = this.params.zoom,
          i = e.gesture;
      i.$slideEl || (i.$slideEl = this.clickedSlide ? s(this.clickedSlide) : this.slides.eq(this.activeIndex), i.$imageEl = i.$slideEl.find("img, svg, canvas"), i.$imageWrapEl = i.$imageEl.parent("." + t.containerClass)), i.$imageEl && 0 !== i.$imageEl.length && (e.scale = 1, e.currentScale = 1, i.$imageWrapEl.transition(300).transform("translate3d(0,0,0)"), i.$imageEl.transition(300).transform("translate3d(0,0,0) scale(1)"), i.$slideEl.removeClass("" + t.zoomedSlideClass), i.$slideEl = void 0);
    },
    enable: function enable() {
      var e = this.zoom;

      if (!e.enabled) {
        e.enabled = !0;
        var t = !("touchstart" !== this.touchEvents.start || !o.passiveListener || !this.params.passiveListeners) && {
          passive: !0,
          capture: !1
        },
            i = !o.passiveListener || {
          passive: !1,
          capture: !0
        };
        o.gestures ? (this.$wrapperEl.on("gesturestart", ".swiper-slide", e.onGestureStart, t), this.$wrapperEl.on("gesturechange", ".swiper-slide", e.onGestureChange, t), this.$wrapperEl.on("gestureend", ".swiper-slide", e.onGestureEnd, t)) : "touchstart" === this.touchEvents.start && (this.$wrapperEl.on(this.touchEvents.start, ".swiper-slide", e.onGestureStart, t), this.$wrapperEl.on(this.touchEvents.move, ".swiper-slide", e.onGestureChange, i), this.$wrapperEl.on(this.touchEvents.end, ".swiper-slide", e.onGestureEnd, t), this.touchEvents.cancel && this.$wrapperEl.on(this.touchEvents.cancel, ".swiper-slide", e.onGestureEnd, t)), this.$wrapperEl.on(this.touchEvents.move, "." + this.params.zoom.containerClass, e.onTouchMove, i);
      }
    },
    disable: function disable() {
      var e = this.zoom;

      if (e.enabled) {
        this.zoom.enabled = !1;
        var t = !("touchstart" !== this.touchEvents.start || !o.passiveListener || !this.params.passiveListeners) && {
          passive: !0,
          capture: !1
        },
            i = !o.passiveListener || {
          passive: !1,
          capture: !0
        };
        o.gestures ? (this.$wrapperEl.off("gesturestart", ".swiper-slide", e.onGestureStart, t), this.$wrapperEl.off("gesturechange", ".swiper-slide", e.onGestureChange, t), this.$wrapperEl.off("gestureend", ".swiper-slide", e.onGestureEnd, t)) : "touchstart" === this.touchEvents.start && (this.$wrapperEl.off(this.touchEvents.start, ".swiper-slide", e.onGestureStart, t), this.$wrapperEl.off(this.touchEvents.move, ".swiper-slide", e.onGestureChange, i), this.$wrapperEl.off(this.touchEvents.end, ".swiper-slide", e.onGestureEnd, t), this.touchEvents.cancel && this.$wrapperEl.off(this.touchEvents.cancel, ".swiper-slide", e.onGestureEnd, t)), this.$wrapperEl.off(this.touchEvents.move, "." + this.params.zoom.containerClass, e.onTouchMove, i);
      }
    }
  },
      le = {
    loadInSlide: function loadInSlide(e, t) {
      void 0 === t && (t = !0);
      var i = this,
          a = i.params.lazy;

      if (void 0 !== e && 0 !== i.slides.length) {
        var r = i.virtual && i.params.virtual.enabled ? i.$wrapperEl.children("." + i.params.slideClass + '[data-swiper-slide-index="' + e + '"]') : i.slides.eq(e),
            n = r.find("." + a.elementClass + ":not(." + a.loadedClass + "):not(." + a.loadingClass + ")");
        !r.hasClass(a.elementClass) || r.hasClass(a.loadedClass) || r.hasClass(a.loadingClass) || (n = n.add(r[0])), 0 !== n.length && n.each(function (e, n) {
          var o = s(n);
          o.addClass(a.loadingClass);
          var l = o.attr("data-background"),
              d = o.attr("data-src"),
              h = o.attr("data-srcset"),
              p = o.attr("data-sizes");
          i.loadImage(o[0], d || l, h, p, !1, function () {
            if (null != i && i && (!i || i.params) && !i.destroyed) {
              if (l ? (o.css("background-image", 'url("' + l + '")'), o.removeAttr("data-background")) : (h && (o.attr("srcset", h), o.removeAttr("data-srcset")), p && (o.attr("sizes", p), o.removeAttr("data-sizes")), d && (o.attr("src", d), o.removeAttr("data-src"))), o.addClass(a.loadedClass).removeClass(a.loadingClass), r.find("." + a.preloaderClass).remove(), i.params.loop && t) {
                var e = r.attr("data-swiper-slide-index");

                if (r.hasClass(i.params.slideDuplicateClass)) {
                  var s = i.$wrapperEl.children('[data-swiper-slide-index="' + e + '"]:not(.' + i.params.slideDuplicateClass + ")");
                  i.lazy.loadInSlide(s.index(), !1);
                } else {
                  var n = i.$wrapperEl.children("." + i.params.slideDuplicateClass + '[data-swiper-slide-index="' + e + '"]');
                  i.lazy.loadInSlide(n.index(), !1);
                }
              }

              i.emit("lazyImageReady", r[0], o[0]);
            }
          }), i.emit("lazyImageLoad", r[0], o[0]);
        });
      }
    },
    load: function load() {
      var e = this,
          t = e.$wrapperEl,
          i = e.params,
          a = e.slides,
          r = e.activeIndex,
          n = e.virtual && i.virtual.enabled,
          o = i.lazy,
          l = i.slidesPerView;

      function d(e) {
        if (n) {
          if (t.children("." + i.slideClass + '[data-swiper-slide-index="' + e + '"]').length) return !0;
        } else if (a[e]) return !0;

        return !1;
      }

      function h(e) {
        return n ? s(e).attr("data-swiper-slide-index") : s(e).index();
      }

      if ("auto" === l && (l = 0), e.lazy.initialImageLoaded || (e.lazy.initialImageLoaded = !0), e.params.watchSlidesVisibility) t.children("." + i.slideVisibleClass).each(function (t, i) {
        var a = n ? s(i).attr("data-swiper-slide-index") : s(i).index();
        e.lazy.loadInSlide(a);
      });else if (l > 1) for (var p = r; p < r + l; p += 1) {
        d(p) && e.lazy.loadInSlide(p);
      } else e.lazy.loadInSlide(r);
      if (o.loadPrevNext) if (l > 1 || o.loadPrevNextAmount && o.loadPrevNextAmount > 1) {
        for (var c = o.loadPrevNextAmount, u = l, v = Math.min(r + u + Math.max(c, u), a.length), f = Math.max(r - Math.max(u, c), 0), m = r + l; m < v; m += 1) {
          d(m) && e.lazy.loadInSlide(m);
        }

        for (var g = f; g < r; g += 1) {
          d(g) && e.lazy.loadInSlide(g);
        }
      } else {
        var b = t.children("." + i.slideNextClass);
        b.length > 0 && e.lazy.loadInSlide(h(b));
        var w = t.children("." + i.slidePrevClass);
        w.length > 0 && e.lazy.loadInSlide(h(w));
      }
    }
  },
      de = {
    LinearSpline: function LinearSpline(e, t) {
      var i,
          s,
          a,
          r,
          n,
          o = function o(e, t) {
        for (s = -1, i = e.length; i - s > 1;) {
          e[a = i + s >> 1] <= t ? s = a : i = a;
        }

        return i;
      };

      return this.x = e, this.y = t, this.lastIndex = e.length - 1, this.interpolate = function (e) {
        return e ? (n = o(this.x, e), r = n - 1, (e - this.x[r]) * (this.y[n] - this.y[r]) / (this.x[n] - this.x[r]) + this.y[r]) : 0;
      }, this;
    },
    getInterpolateFunction: function getInterpolateFunction(e) {
      this.controller.spline || (this.controller.spline = this.params.loop ? new de.LinearSpline(this.slidesGrid, e.slidesGrid) : new de.LinearSpline(this.snapGrid, e.snapGrid));
    },
    setTranslate: function setTranslate(e, t) {
      var i,
          s,
          a = this,
          r = a.controller.control;

      function n(e) {
        var t = a.rtlTranslate ? -a.translate : a.translate;
        "slide" === a.params.controller.by && (a.controller.getInterpolateFunction(e), s = -a.controller.spline.interpolate(-t)), s && "container" !== a.params.controller.by || (i = (e.maxTranslate() - e.minTranslate()) / (a.maxTranslate() - a.minTranslate()), s = (t - a.minTranslate()) * i + e.minTranslate()), a.params.controller.inverse && (s = e.maxTranslate() - s), e.updateProgress(s), e.setTranslate(s, a), e.updateActiveIndex(), e.updateSlidesClasses();
      }

      if (Array.isArray(r)) for (var o = 0; o < r.length; o += 1) {
        r[o] !== t && r[o] instanceof W && n(r[o]);
      } else r instanceof W && t !== r && n(r);
    },
    setTransition: function setTransition(e, t) {
      var i,
          s = this,
          a = s.controller.control;

      function r(t) {
        t.setTransition(e, s), 0 !== e && (t.transitionStart(), t.params.autoHeight && n.nextTick(function () {
          t.updateAutoHeight();
        }), t.$wrapperEl.transitionEnd(function () {
          a && (t.params.loop && "slide" === s.params.controller.by && t.loopFix(), t.transitionEnd());
        }));
      }

      if (Array.isArray(a)) for (i = 0; i < a.length; i += 1) {
        a[i] !== t && a[i] instanceof W && r(a[i]);
      } else a instanceof W && t !== a && r(a);
    }
  },
      he = {
    makeElFocusable: function makeElFocusable(e) {
      return e.attr("tabIndex", "0"), e;
    },
    addElRole: function addElRole(e, t) {
      return e.attr("role", t), e;
    },
    addElLabel: function addElLabel(e, t) {
      return e.attr("aria-label", t), e;
    },
    disableEl: function disableEl(e) {
      return e.attr("aria-disabled", !0), e;
    },
    enableEl: function enableEl(e) {
      return e.attr("aria-disabled", !1), e;
    },
    onEnterKey: function onEnterKey(e) {
      var t = this.params.a11y;

      if (13 === e.keyCode) {
        var i = s(e.target);
        this.navigation && this.navigation.$nextEl && i.is(this.navigation.$nextEl) && (this.isEnd && !this.params.loop || this.slideNext(), this.isEnd ? this.a11y.notify(t.lastSlideMessage) : this.a11y.notify(t.nextSlideMessage)), this.navigation && this.navigation.$prevEl && i.is(this.navigation.$prevEl) && (this.isBeginning && !this.params.loop || this.slidePrev(), this.isBeginning ? this.a11y.notify(t.firstSlideMessage) : this.a11y.notify(t.prevSlideMessage)), this.pagination && i.is("." + this.params.pagination.bulletClass) && i[0].click();
      }
    },
    notify: function notify(e) {
      var t = this.a11y.liveRegion;
      0 !== t.length && (t.html(""), t.html(e));
    },
    updateNavigation: function updateNavigation() {
      if (!this.params.loop && this.navigation) {
        var e = this.navigation,
            t = e.$nextEl,
            i = e.$prevEl;
        i && i.length > 0 && (this.isBeginning ? this.a11y.disableEl(i) : this.a11y.enableEl(i)), t && t.length > 0 && (this.isEnd ? this.a11y.disableEl(t) : this.a11y.enableEl(t));
      }
    },
    updatePagination: function updatePagination() {
      var e = this,
          t = e.params.a11y;
      e.pagination && e.params.pagination.clickable && e.pagination.bullets && e.pagination.bullets.length && e.pagination.bullets.each(function (i, a) {
        var r = s(a);
        e.a11y.makeElFocusable(r), e.a11y.addElRole(r, "button"), e.a11y.addElLabel(r, t.paginationBulletMessage.replace(/{{index}}/, r.index() + 1));
      });
    },
    init: function init() {
      this.$el.append(this.a11y.liveRegion);
      var e,
          t,
          i = this.params.a11y;
      this.navigation && this.navigation.$nextEl && (e = this.navigation.$nextEl), this.navigation && this.navigation.$prevEl && (t = this.navigation.$prevEl), e && (this.a11y.makeElFocusable(e), this.a11y.addElRole(e, "button"), this.a11y.addElLabel(e, i.nextSlideMessage), e.on("keydown", this.a11y.onEnterKey)), t && (this.a11y.makeElFocusable(t), this.a11y.addElRole(t, "button"), this.a11y.addElLabel(t, i.prevSlideMessage), t.on("keydown", this.a11y.onEnterKey)), this.pagination && this.params.pagination.clickable && this.pagination.bullets && this.pagination.bullets.length && this.pagination.$el.on("keydown", "." + this.params.pagination.bulletClass, this.a11y.onEnterKey);
    },
    destroy: function destroy() {
      var e, t;
      this.a11y.liveRegion && this.a11y.liveRegion.length > 0 && this.a11y.liveRegion.remove(), this.navigation && this.navigation.$nextEl && (e = this.navigation.$nextEl), this.navigation && this.navigation.$prevEl && (t = this.navigation.$prevEl), e && e.off("keydown", this.a11y.onEnterKey), t && t.off("keydown", this.a11y.onEnterKey), this.pagination && this.params.pagination.clickable && this.pagination.bullets && this.pagination.bullets.length && this.pagination.$el.off("keydown", "." + this.params.pagination.bulletClass, this.a11y.onEnterKey);
    }
  },
      pe = {
    init: function init() {
      if (this.params.history) {
        if (!t.history || !t.history.pushState) return this.params.history.enabled = !1, void (this.params.hashNavigation.enabled = !0);
        var e = this.history;
        e.initialized = !0, e.paths = pe.getPathValues(), (e.paths.key || e.paths.value) && (e.scrollToSlide(0, e.paths.value, this.params.runCallbacksOnInit), this.params.history.replaceState || t.addEventListener("popstate", this.history.setHistoryPopState));
      }
    },
    destroy: function destroy() {
      this.params.history.replaceState || t.removeEventListener("popstate", this.history.setHistoryPopState);
    },
    setHistoryPopState: function setHistoryPopState() {
      this.history.paths = pe.getPathValues(), this.history.scrollToSlide(this.params.speed, this.history.paths.value, !1);
    },
    getPathValues: function getPathValues() {
      var e = t.location.pathname.slice(1).split("/").filter(function (e) {
        return "" !== e;
      }),
          i = e.length;
      return {
        key: e[i - 2],
        value: e[i - 1]
      };
    },
    setHistory: function setHistory(e, i) {
      if (this.history.initialized && this.params.history.enabled) {
        var s = this.slides.eq(i),
            a = pe.slugify(s.attr("data-history"));
        t.location.pathname.includes(e) || (a = e + "/" + a);
        var r = t.history.state;
        r && r.value === a || (this.params.history.replaceState ? t.history.replaceState({
          value: a
        }, null, a) : t.history.pushState({
          value: a
        }, null, a));
      }
    },
    slugify: function slugify(e) {
      return e.toString().replace(/\s+/g, "-").replace(/[^\w-]+/g, "").replace(/--+/g, "-").replace(/^-+/, "").replace(/-+$/, "");
    },
    scrollToSlide: function scrollToSlide(e, t, i) {
      if (t) for (var s = 0, a = this.slides.length; s < a; s += 1) {
        var r = this.slides.eq(s);

        if (pe.slugify(r.attr("data-history")) === t && !r.hasClass(this.params.slideDuplicateClass)) {
          var n = r.index();
          this.slideTo(n, e, i);
        }
      } else this.slideTo(0, e, i);
    }
  },
      ce = {
    onHashCange: function onHashCange() {
      var t = e.location.hash.replace("#", "");

      if (t !== this.slides.eq(this.activeIndex).attr("data-hash")) {
        var i = this.$wrapperEl.children("." + this.params.slideClass + '[data-hash="' + t + '"]').index();
        if (void 0 === i) return;
        this.slideTo(i);
      }
    },
    setHash: function setHash() {
      if (this.hashNavigation.initialized && this.params.hashNavigation.enabled) if (this.params.hashNavigation.replaceState && t.history && t.history.replaceState) t.history.replaceState(null, null, "#" + this.slides.eq(this.activeIndex).attr("data-hash") || 0);else {
        var i = this.slides.eq(this.activeIndex),
            s = i.attr("data-hash") || i.attr("data-history");
        e.location.hash = s || "";
      }
    },
    init: function init() {
      if (!(!this.params.hashNavigation.enabled || this.params.history && this.params.history.enabled)) {
        this.hashNavigation.initialized = !0;
        var i = e.location.hash.replace("#", "");
        if (i) for (var a = 0, r = this.slides.length; a < r; a += 1) {
          var n = this.slides.eq(a);

          if ((n.attr("data-hash") || n.attr("data-history")) === i && !n.hasClass(this.params.slideDuplicateClass)) {
            var o = n.index();
            this.slideTo(o, 0, this.params.runCallbacksOnInit, !0);
          }
        }
        this.params.hashNavigation.watchState && s(t).on("hashchange", this.hashNavigation.onHashCange);
      }
    },
    destroy: function destroy() {
      this.params.hashNavigation.watchState && s(t).off("hashchange", this.hashNavigation.onHashCange);
    }
  },
      ue = {
    run: function run() {
      var e = this,
          t = e.slides.eq(e.activeIndex),
          i = e.params.autoplay.delay;
      t.attr("data-swiper-autoplay") && (i = t.attr("data-swiper-autoplay") || e.params.autoplay.delay), clearTimeout(e.autoplay.timeout), e.autoplay.timeout = n.nextTick(function () {
        e.params.autoplay.reverseDirection ? e.params.loop ? (e.loopFix(), e.slidePrev(e.params.speed, !0, !0), e.emit("autoplay")) : e.isBeginning ? e.params.autoplay.stopOnLastSlide ? e.autoplay.stop() : (e.slideTo(e.slides.length - 1, e.params.speed, !0, !0), e.emit("autoplay")) : (e.slidePrev(e.params.speed, !0, !0), e.emit("autoplay")) : e.params.loop ? (e.loopFix(), e.slideNext(e.params.speed, !0, !0), e.emit("autoplay")) : e.isEnd ? e.params.autoplay.stopOnLastSlide ? e.autoplay.stop() : (e.slideTo(0, e.params.speed, !0, !0), e.emit("autoplay")) : (e.slideNext(e.params.speed, !0, !0), e.emit("autoplay")), e.params.cssMode && e.autoplay.running && e.autoplay.run();
      }, i);
    },
    start: function start() {
      return void 0 === this.autoplay.timeout && !this.autoplay.running && (this.autoplay.running = !0, this.emit("autoplayStart"), this.autoplay.run(), !0);
    },
    stop: function stop() {
      return !!this.autoplay.running && void 0 !== this.autoplay.timeout && (this.autoplay.timeout && (clearTimeout(this.autoplay.timeout), this.autoplay.timeout = void 0), this.autoplay.running = !1, this.emit("autoplayStop"), !0);
    },
    pause: function pause(e) {
      this.autoplay.running && (this.autoplay.paused || (this.autoplay.timeout && clearTimeout(this.autoplay.timeout), this.autoplay.paused = !0, 0 !== e && this.params.autoplay.waitForTransition ? (this.$wrapperEl[0].addEventListener("transitionend", this.autoplay.onTransitionEnd), this.$wrapperEl[0].addEventListener("webkitTransitionEnd", this.autoplay.onTransitionEnd)) : (this.autoplay.paused = !1, this.autoplay.run())));
    }
  },
      ve = {
    setTranslate: function setTranslate() {
      for (var e = this.slides, t = 0; t < e.length; t += 1) {
        var i = this.slides.eq(t),
            s = -i[0].swiperSlideOffset;
        this.params.virtualTranslate || (s -= this.translate);
        var a = 0;
        this.isHorizontal() || (a = s, s = 0);
        var r = this.params.fadeEffect.crossFade ? Math.max(1 - Math.abs(i[0].progress), 0) : 1 + Math.min(Math.max(i[0].progress, -1), 0);
        i.css({
          opacity: r
        }).transform("translate3d(" + s + "px, " + a + "px, 0px)");
      }
    },
    setTransition: function setTransition(e) {
      var t = this,
          i = t.slides,
          s = t.$wrapperEl;

      if (i.transition(e), t.params.virtualTranslate && 0 !== e) {
        var a = !1;
        i.transitionEnd(function () {
          if (!a && t && !t.destroyed) {
            a = !0, t.animating = !1;

            for (var e = ["webkitTransitionEnd", "transitionend"], i = 0; i < e.length; i += 1) {
              s.trigger(e[i]);
            }
          }
        });
      }
    }
  },
      fe = {
    setTranslate: function setTranslate() {
      var e,
          t = this.$el,
          i = this.$wrapperEl,
          a = this.slides,
          r = this.width,
          n = this.height,
          o = this.rtlTranslate,
          l = this.size,
          d = this.params.cubeEffect,
          h = this.isHorizontal(),
          p = this.virtual && this.params.virtual.enabled,
          c = 0;
      d.shadow && (h ? (0 === (e = i.find(".swiper-cube-shadow")).length && (e = s('<div class="swiper-cube-shadow"></div>'), i.append(e)), e.css({
        height: r + "px"
      })) : 0 === (e = t.find(".swiper-cube-shadow")).length && (e = s('<div class="swiper-cube-shadow"></div>'), t.append(e)));

      for (var u = 0; u < a.length; u += 1) {
        var v = a.eq(u),
            f = u;
        p && (f = parseInt(v.attr("data-swiper-slide-index"), 10));
        var m = 90 * f,
            g = Math.floor(m / 360);
        o && (m = -m, g = Math.floor(-m / 360));
        var b = Math.max(Math.min(v[0].progress, 1), -1),
            w = 0,
            y = 0,
            x = 0;
        f % 4 == 0 ? (w = 4 * -g * l, x = 0) : (f - 1) % 4 == 0 ? (w = 0, x = 4 * -g * l) : (f - 2) % 4 == 0 ? (w = l + 4 * g * l, x = l) : (f - 3) % 4 == 0 && (w = -l, x = 3 * l + 4 * l * g), o && (w = -w), h || (y = w, w = 0);
        var T = "rotateX(" + (h ? 0 : -m) + "deg) rotateY(" + (h ? m : 0) + "deg) translate3d(" + w + "px, " + y + "px, " + x + "px)";

        if (b <= 1 && b > -1 && (c = 90 * f + 90 * b, o && (c = 90 * -f - 90 * b)), v.transform(T), d.slideShadows) {
          var E = h ? v.find(".swiper-slide-shadow-left") : v.find(".swiper-slide-shadow-top"),
              S = h ? v.find(".swiper-slide-shadow-right") : v.find(".swiper-slide-shadow-bottom");
          0 === E.length && (E = s('<div class="swiper-slide-shadow-' + (h ? "left" : "top") + '"></div>'), v.append(E)), 0 === S.length && (S = s('<div class="swiper-slide-shadow-' + (h ? "right" : "bottom") + '"></div>'), v.append(S)), E.length && (E[0].style.opacity = Math.max(-b, 0)), S.length && (S[0].style.opacity = Math.max(b, 0));
        }
      }

      if (i.css({
        "-webkit-transform-origin": "50% 50% -" + l / 2 + "px",
        "-moz-transform-origin": "50% 50% -" + l / 2 + "px",
        "-ms-transform-origin": "50% 50% -" + l / 2 + "px",
        "transform-origin": "50% 50% -" + l / 2 + "px"
      }), d.shadow) if (h) e.transform("translate3d(0px, " + (r / 2 + d.shadowOffset) + "px, " + -r / 2 + "px) rotateX(90deg) rotateZ(0deg) scale(" + d.shadowScale + ")");else {
        var C = Math.abs(c) - 90 * Math.floor(Math.abs(c) / 90),
            M = 1.5 - (Math.sin(2 * C * Math.PI / 360) / 2 + Math.cos(2 * C * Math.PI / 360) / 2),
            P = d.shadowScale,
            z = d.shadowScale / M,
            k = d.shadowOffset;
        e.transform("scale3d(" + P + ", 1, " + z + ") translate3d(0px, " + (n / 2 + k) + "px, " + -n / 2 / z + "px) rotateX(-90deg)");
      }
      var $ = j.isSafari || j.isUiWebView ? -l / 2 : 0;
      i.transform("translate3d(0px,0," + $ + "px) rotateX(" + (this.isHorizontal() ? 0 : c) + "deg) rotateY(" + (this.isHorizontal() ? -c : 0) + "deg)");
    },
    setTransition: function setTransition(e) {
      var t = this.$el;
      this.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), this.params.cubeEffect.shadow && !this.isHorizontal() && t.find(".swiper-cube-shadow").transition(e);
    }
  },
      me = {
    setTranslate: function setTranslate() {
      for (var e = this.slides, t = this.rtlTranslate, i = 0; i < e.length; i += 1) {
        var a = e.eq(i),
            r = a[0].progress;
        this.params.flipEffect.limitRotation && (r = Math.max(Math.min(a[0].progress, 1), -1));
        var n = -180 * r,
            o = 0,
            l = -a[0].swiperSlideOffset,
            d = 0;

        if (this.isHorizontal() ? t && (n = -n) : (d = l, l = 0, o = -n, n = 0), a[0].style.zIndex = -Math.abs(Math.round(r)) + e.length, this.params.flipEffect.slideShadows) {
          var h = this.isHorizontal() ? a.find(".swiper-slide-shadow-left") : a.find(".swiper-slide-shadow-top"),
              p = this.isHorizontal() ? a.find(".swiper-slide-shadow-right") : a.find(".swiper-slide-shadow-bottom");
          0 === h.length && (h = s('<div class="swiper-slide-shadow-' + (this.isHorizontal() ? "left" : "top") + '"></div>'), a.append(h)), 0 === p.length && (p = s('<div class="swiper-slide-shadow-' + (this.isHorizontal() ? "right" : "bottom") + '"></div>'), a.append(p)), h.length && (h[0].style.opacity = Math.max(-r, 0)), p.length && (p[0].style.opacity = Math.max(r, 0));
        }

        a.transform("translate3d(" + l + "px, " + d + "px, 0px) rotateX(" + o + "deg) rotateY(" + n + "deg)");
      }
    },
    setTransition: function setTransition(e) {
      var t = this,
          i = t.slides,
          s = t.activeIndex,
          a = t.$wrapperEl;

      if (i.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), t.params.virtualTranslate && 0 !== e) {
        var r = !1;
        i.eq(s).transitionEnd(function () {
          if (!r && t && !t.destroyed) {
            r = !0, t.animating = !1;

            for (var e = ["webkitTransitionEnd", "transitionend"], i = 0; i < e.length; i += 1) {
              a.trigger(e[i]);
            }
          }
        });
      }
    }
  },
      ge = {
    setTranslate: function setTranslate() {
      for (var e = this.width, t = this.height, i = this.slides, a = this.$wrapperEl, r = this.slidesSizesGrid, n = this.params.coverflowEffect, l = this.isHorizontal(), d = this.translate, h = l ? e / 2 - d : t / 2 - d, p = l ? n.rotate : -n.rotate, c = n.depth, u = 0, v = i.length; u < v; u += 1) {
        var f = i.eq(u),
            m = r[u],
            g = (h - f[0].swiperSlideOffset - m / 2) / m * n.modifier,
            b = l ? p * g : 0,
            w = l ? 0 : p * g,
            y = -c * Math.abs(g),
            x = l ? 0 : n.stretch * g,
            T = l ? n.stretch * g : 0;
        Math.abs(T) < .001 && (T = 0), Math.abs(x) < .001 && (x = 0), Math.abs(y) < .001 && (y = 0), Math.abs(b) < .001 && (b = 0), Math.abs(w) < .001 && (w = 0);
        var E = "translate3d(" + T + "px," + x + "px," + y + "px)  rotateX(" + w + "deg) rotateY(" + b + "deg)";

        if (f.transform(E), f[0].style.zIndex = 1 - Math.abs(Math.round(g)), n.slideShadows) {
          var S = l ? f.find(".swiper-slide-shadow-left") : f.find(".swiper-slide-shadow-top"),
              C = l ? f.find(".swiper-slide-shadow-right") : f.find(".swiper-slide-shadow-bottom");
          0 === S.length && (S = s('<div class="swiper-slide-shadow-' + (l ? "left" : "top") + '"></div>'), f.append(S)), 0 === C.length && (C = s('<div class="swiper-slide-shadow-' + (l ? "right" : "bottom") + '"></div>'), f.append(C)), S.length && (S[0].style.opacity = g > 0 ? g : 0), C.length && (C[0].style.opacity = -g > 0 ? -g : 0);
        }
      }

      (o.pointerEvents || o.prefixedPointerEvents) && (a[0].style.perspectiveOrigin = h + "px 50%");
    },
    setTransition: function setTransition(e) {
      this.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e);
    }
  },
      be = {
    init: function init() {
      var e = this.params.thumbs,
          t = this.constructor;
      e.swiper instanceof t ? (this.thumbs.swiper = e.swiper, n.extend(this.thumbs.swiper.originalParams, {
        watchSlidesProgress: !0,
        slideToClickedSlide: !1
      }), n.extend(this.thumbs.swiper.params, {
        watchSlidesProgress: !0,
        slideToClickedSlide: !1
      })) : n.isObject(e.swiper) && (this.thumbs.swiper = new t(n.extend({}, e.swiper, {
        watchSlidesVisibility: !0,
        watchSlidesProgress: !0,
        slideToClickedSlide: !1
      })), this.thumbs.swiperCreated = !0), this.thumbs.swiper.$el.addClass(this.params.thumbs.thumbsContainerClass), this.thumbs.swiper.on("tap", this.thumbs.onThumbClick);
    },
    onThumbClick: function onThumbClick() {
      var e = this.thumbs.swiper;

      if (e) {
        var t = e.clickedIndex,
            i = e.clickedSlide;

        if (!(i && s(i).hasClass(this.params.thumbs.slideThumbActiveClass) || null == t)) {
          var a;

          if (a = e.params.loop ? parseInt(s(e.clickedSlide).attr("data-swiper-slide-index"), 10) : t, this.params.loop) {
            var r = this.activeIndex;
            this.slides.eq(r).hasClass(this.params.slideDuplicateClass) && (this.loopFix(), this._clientLeft = this.$wrapperEl[0].clientLeft, r = this.activeIndex);
            var n = this.slides.eq(r).prevAll('[data-swiper-slide-index="' + a + '"]').eq(0).index(),
                o = this.slides.eq(r).nextAll('[data-swiper-slide-index="' + a + '"]').eq(0).index();
            a = void 0 === n ? o : void 0 === o ? n : o - r < r - n ? o : n;
          }

          this.slideTo(a);
        }
      }
    },
    update: function update(e) {
      var t = this.thumbs.swiper;

      if (t) {
        var i = "auto" === t.params.slidesPerView ? t.slidesPerViewDynamic() : t.params.slidesPerView;

        if (this.realIndex !== t.realIndex) {
          var s,
              a = t.activeIndex;

          if (t.params.loop) {
            t.slides.eq(a).hasClass(t.params.slideDuplicateClass) && (t.loopFix(), t._clientLeft = t.$wrapperEl[0].clientLeft, a = t.activeIndex);
            var r = t.slides.eq(a).prevAll('[data-swiper-slide-index="' + this.realIndex + '"]').eq(0).index(),
                n = t.slides.eq(a).nextAll('[data-swiper-slide-index="' + this.realIndex + '"]').eq(0).index();
            s = void 0 === r ? n : void 0 === n ? r : n - a == a - r ? a : n - a < a - r ? n : r;
          } else s = this.realIndex;

          t.visibleSlidesIndexes && t.visibleSlidesIndexes.indexOf(s) < 0 && (t.params.centeredSlides ? s = s > a ? s - Math.floor(i / 2) + 1 : s + Math.floor(i / 2) - 1 : s > a && (s = s - i + 1), t.slideTo(s, e ? 0 : void 0));
        }

        var o = 1,
            l = this.params.thumbs.slideThumbActiveClass;
        if (this.params.slidesPerView > 1 && !this.params.centeredSlides && (o = this.params.slidesPerView), this.params.thumbs.multipleActiveThumbs || (o = 1), o = Math.floor(o), t.slides.removeClass(l), t.params.loop || t.params.virtual && t.params.virtual.enabled) for (var d = 0; d < o; d += 1) {
          t.$wrapperEl.children('[data-swiper-slide-index="' + (this.realIndex + d) + '"]').addClass(l);
        } else for (var h = 0; h < o; h += 1) {
          t.slides.eq(this.realIndex + h).addClass(l);
        }
      }
    }
  },
      we = [R, q, K, U, Z, J, te, {
    name: "mousewheel",
    params: {
      mousewheel: {
        enabled: !1,
        releaseOnEdges: !1,
        invert: !1,
        forceToAxis: !1,
        sensitivity: 1,
        eventsTarged: "container"
      }
    },
    create: function create() {
      n.extend(this, {
        mousewheel: {
          enabled: !1,
          enable: ie.enable.bind(this),
          disable: ie.disable.bind(this),
          handle: ie.handle.bind(this),
          handleMouseEnter: ie.handleMouseEnter.bind(this),
          handleMouseLeave: ie.handleMouseLeave.bind(this),
          animateSlider: ie.animateSlider.bind(this),
          releaseScroll: ie.releaseScroll.bind(this),
          lastScrollTime: n.now(),
          lastEventBeforeSnap: void 0,
          recentWheelEvents: []
        }
      });
    },
    on: {
      init: function init() {
        !this.params.mousewheel.enabled && this.params.cssMode && this.mousewheel.disable(), this.params.mousewheel.enabled && this.mousewheel.enable();
      },
      destroy: function destroy() {
        this.params.cssMode && this.mousewheel.enable(), this.mousewheel.enabled && this.mousewheel.disable();
      }
    }
  }, {
    name: "navigation",
    params: {
      navigation: {
        nextEl: null,
        prevEl: null,
        hideOnClick: !1,
        disabledClass: "swiper-button-disabled",
        hiddenClass: "swiper-button-hidden",
        lockClass: "swiper-button-lock"
      }
    },
    create: function create() {
      n.extend(this, {
        navigation: {
          init: se.init.bind(this),
          update: se.update.bind(this),
          destroy: se.destroy.bind(this),
          onNextClick: se.onNextClick.bind(this),
          onPrevClick: se.onPrevClick.bind(this)
        }
      });
    },
    on: {
      init: function init() {
        this.navigation.init(), this.navigation.update();
      },
      toEdge: function toEdge() {
        this.navigation.update();
      },
      fromEdge: function fromEdge() {
        this.navigation.update();
      },
      destroy: function destroy() {
        this.navigation.destroy();
      },
      click: function click(e) {
        var t,
            i = this.navigation,
            a = i.$nextEl,
            r = i.$prevEl;
        !this.params.navigation.hideOnClick || s(e.target).is(r) || s(e.target).is(a) || (a ? t = a.hasClass(this.params.navigation.hiddenClass) : r && (t = r.hasClass(this.params.navigation.hiddenClass)), !0 === t ? this.emit("navigationShow", this) : this.emit("navigationHide", this), a && a.toggleClass(this.params.navigation.hiddenClass), r && r.toggleClass(this.params.navigation.hiddenClass));
      }
    }
  }, {
    name: "pagination",
    params: {
      pagination: {
        el: null,
        bulletElement: "span",
        clickable: !1,
        hideOnClick: !1,
        renderBullet: null,
        renderProgressbar: null,
        renderFraction: null,
        renderCustom: null,
        progressbarOpposite: !1,
        type: "bullets",
        dynamicBullets: !1,
        dynamicMainBullets: 1,
        formatFractionCurrent: function formatFractionCurrent(e) {
          return e;
        },
        formatFractionTotal: function formatFractionTotal(e) {
          return e;
        },
        bulletClass: "swiper-pagination-bullet",
        bulletActiveClass: "swiper-pagination-bullet-active",
        modifierClass: "swiper-pagination-",
        currentClass: "swiper-pagination-current",
        totalClass: "swiper-pagination-total",
        hiddenClass: "swiper-pagination-hidden",
        progressbarFillClass: "swiper-pagination-progressbar-fill",
        progressbarOppositeClass: "swiper-pagination-progressbar-opposite",
        clickableClass: "swiper-pagination-clickable",
        lockClass: "swiper-pagination-lock"
      }
    },
    create: function create() {
      n.extend(this, {
        pagination: {
          init: ae.init.bind(this),
          render: ae.render.bind(this),
          update: ae.update.bind(this),
          destroy: ae.destroy.bind(this),
          dynamicBulletIndex: 0
        }
      });
    },
    on: {
      init: function init() {
        this.pagination.init(), this.pagination.render(), this.pagination.update();
      },
      activeIndexChange: function activeIndexChange() {
        this.params.loop ? this.pagination.update() : void 0 === this.snapIndex && this.pagination.update();
      },
      snapIndexChange: function snapIndexChange() {
        this.params.loop || this.pagination.update();
      },
      slidesLengthChange: function slidesLengthChange() {
        this.params.loop && (this.pagination.render(), this.pagination.update());
      },
      snapGridLengthChange: function snapGridLengthChange() {
        this.params.loop || (this.pagination.render(), this.pagination.update());
      },
      destroy: function destroy() {
        this.pagination.destroy();
      },
      click: function click(e) {
        this.params.pagination.el && this.params.pagination.hideOnClick && this.pagination.$el.length > 0 && !s(e.target).hasClass(this.params.pagination.bulletClass) && (!0 === this.pagination.$el.hasClass(this.params.pagination.hiddenClass) ? this.emit("paginationShow", this) : this.emit("paginationHide", this), this.pagination.$el.toggleClass(this.params.pagination.hiddenClass));
      }
    }
  }, {
    name: "scrollbar",
    params: {
      scrollbar: {
        el: null,
        dragSize: "auto",
        hide: !1,
        draggable: !1,
        snapOnRelease: !0,
        lockClass: "swiper-scrollbar-lock",
        dragClass: "swiper-scrollbar-drag"
      }
    },
    create: function create() {
      n.extend(this, {
        scrollbar: {
          init: re.init.bind(this),
          destroy: re.destroy.bind(this),
          updateSize: re.updateSize.bind(this),
          setTranslate: re.setTranslate.bind(this),
          setTransition: re.setTransition.bind(this),
          enableDraggable: re.enableDraggable.bind(this),
          disableDraggable: re.disableDraggable.bind(this),
          setDragPosition: re.setDragPosition.bind(this),
          getPointerPosition: re.getPointerPosition.bind(this),
          onDragStart: re.onDragStart.bind(this),
          onDragMove: re.onDragMove.bind(this),
          onDragEnd: re.onDragEnd.bind(this),
          isTouched: !1,
          timeout: null,
          dragTimeout: null
        }
      });
    },
    on: {
      init: function init() {
        this.scrollbar.init(), this.scrollbar.updateSize(), this.scrollbar.setTranslate();
      },
      update: function update() {
        this.scrollbar.updateSize();
      },
      resize: function resize() {
        this.scrollbar.updateSize();
      },
      observerUpdate: function observerUpdate() {
        this.scrollbar.updateSize();
      },
      setTranslate: function setTranslate() {
        this.scrollbar.setTranslate();
      },
      setTransition: function setTransition(e) {
        this.scrollbar.setTransition(e);
      },
      destroy: function destroy() {
        this.scrollbar.destroy();
      }
    }
  }, {
    name: "parallax",
    params: {
      parallax: {
        enabled: !1
      }
    },
    create: function create() {
      n.extend(this, {
        parallax: {
          setTransform: ne.setTransform.bind(this),
          setTranslate: ne.setTranslate.bind(this),
          setTransition: ne.setTransition.bind(this)
        }
      });
    },
    on: {
      beforeInit: function beforeInit() {
        this.params.parallax.enabled && (this.params.watchSlidesProgress = !0, this.originalParams.watchSlidesProgress = !0);
      },
      init: function init() {
        this.params.parallax.enabled && this.parallax.setTranslate();
      },
      setTranslate: function setTranslate() {
        this.params.parallax.enabled && this.parallax.setTranslate();
      },
      setTransition: function setTransition(e) {
        this.params.parallax.enabled && this.parallax.setTransition(e);
      }
    }
  }, {
    name: "zoom",
    params: {
      zoom: {
        enabled: !1,
        maxRatio: 3,
        minRatio: 1,
        toggle: !0,
        containerClass: "swiper-zoom-container",
        zoomedSlideClass: "swiper-slide-zoomed"
      }
    },
    create: function create() {
      var e = this,
          t = {
        enabled: !1,
        scale: 1,
        currentScale: 1,
        isScaling: !1,
        gesture: {
          $slideEl: void 0,
          slideWidth: void 0,
          slideHeight: void 0,
          $imageEl: void 0,
          $imageWrapEl: void 0,
          maxRatio: 3
        },
        image: {
          isTouched: void 0,
          isMoved: void 0,
          currentX: void 0,
          currentY: void 0,
          minX: void 0,
          minY: void 0,
          maxX: void 0,
          maxY: void 0,
          width: void 0,
          height: void 0,
          startX: void 0,
          startY: void 0,
          touchesStart: {},
          touchesCurrent: {}
        },
        velocity: {
          x: void 0,
          y: void 0,
          prevPositionX: void 0,
          prevPositionY: void 0,
          prevTime: void 0
        }
      };
      "onGestureStart onGestureChange onGestureEnd onTouchStart onTouchMove onTouchEnd onTransitionEnd toggle enable disable in out".split(" ").forEach(function (i) {
        t[i] = oe[i].bind(e);
      }), n.extend(e, {
        zoom: t
      });
      var i = 1;
      Object.defineProperty(e.zoom, "scale", {
        get: function get() {
          return i;
        },
        set: function set(t) {
          if (i !== t) {
            var s = e.zoom.gesture.$imageEl ? e.zoom.gesture.$imageEl[0] : void 0,
                a = e.zoom.gesture.$slideEl ? e.zoom.gesture.$slideEl[0] : void 0;
            e.emit("zoomChange", t, s, a);
          }

          i = t;
        }
      });
    },
    on: {
      init: function init() {
        this.params.zoom.enabled && this.zoom.enable();
      },
      destroy: function destroy() {
        this.zoom.disable();
      },
      touchStart: function touchStart(e) {
        this.zoom.enabled && this.zoom.onTouchStart(e);
      },
      touchEnd: function touchEnd(e) {
        this.zoom.enabled && this.zoom.onTouchEnd(e);
      },
      doubleTap: function doubleTap(e) {
        this.params.zoom.enabled && this.zoom.enabled && this.params.zoom.toggle && this.zoom.toggle(e);
      },
      transitionEnd: function transitionEnd() {
        this.zoom.enabled && this.params.zoom.enabled && this.zoom.onTransitionEnd();
      },
      slideChange: function slideChange() {
        this.zoom.enabled && this.params.zoom.enabled && this.params.cssMode && this.zoom.onTransitionEnd();
      }
    }
  }, {
    name: "lazy",
    params: {
      lazy: {
        enabled: !1,
        loadPrevNext: !1,
        loadPrevNextAmount: 1,
        loadOnTransitionStart: !1,
        elementClass: "swiper-lazy",
        loadingClass: "swiper-lazy-loading",
        loadedClass: "swiper-lazy-loaded",
        preloaderClass: "swiper-lazy-preloader"
      }
    },
    create: function create() {
      n.extend(this, {
        lazy: {
          initialImageLoaded: !1,
          load: le.load.bind(this),
          loadInSlide: le.loadInSlide.bind(this)
        }
      });
    },
    on: {
      beforeInit: function beforeInit() {
        this.params.lazy.enabled && this.params.preloadImages && (this.params.preloadImages = !1);
      },
      init: function init() {
        this.params.lazy.enabled && !this.params.loop && 0 === this.params.initialSlide && this.lazy.load();
      },
      scroll: function scroll() {
        this.params.freeMode && !this.params.freeModeSticky && this.lazy.load();
      },
      resize: function resize() {
        this.params.lazy.enabled && this.lazy.load();
      },
      scrollbarDragMove: function scrollbarDragMove() {
        this.params.lazy.enabled && this.lazy.load();
      },
      transitionStart: function transitionStart() {
        this.params.lazy.enabled && (this.params.lazy.loadOnTransitionStart || !this.params.lazy.loadOnTransitionStart && !this.lazy.initialImageLoaded) && this.lazy.load();
      },
      transitionEnd: function transitionEnd() {
        this.params.lazy.enabled && !this.params.lazy.loadOnTransitionStart && this.lazy.load();
      },
      slideChange: function slideChange() {
        this.params.lazy.enabled && this.params.cssMode && this.lazy.load();
      }
    }
  }, {
    name: "controller",
    params: {
      controller: {
        control: void 0,
        inverse: !1,
        by: "slide"
      }
    },
    create: function create() {
      n.extend(this, {
        controller: {
          control: this.params.controller.control,
          getInterpolateFunction: de.getInterpolateFunction.bind(this),
          setTranslate: de.setTranslate.bind(this),
          setTransition: de.setTransition.bind(this)
        }
      });
    },
    on: {
      update: function update() {
        this.controller.control && this.controller.spline && (this.controller.spline = void 0, delete this.controller.spline);
      },
      resize: function resize() {
        this.controller.control && this.controller.spline && (this.controller.spline = void 0, delete this.controller.spline);
      },
      observerUpdate: function observerUpdate() {
        this.controller.control && this.controller.spline && (this.controller.spline = void 0, delete this.controller.spline);
      },
      setTranslate: function setTranslate(e, t) {
        this.controller.control && this.controller.setTranslate(e, t);
      },
      setTransition: function setTransition(e, t) {
        this.controller.control && this.controller.setTransition(e, t);
      }
    }
  }, {
    name: "a11y",
    params: {
      a11y: {
        enabled: !0,
        notificationClass: "swiper-notification",
        prevSlideMessage: "Previous slide",
        nextSlideMessage: "Next slide",
        firstSlideMessage: "This is the first slide",
        lastSlideMessage: "This is the last slide",
        paginationBulletMessage: "Go to slide {{index}}"
      }
    },
    create: function create() {
      var e = this;
      n.extend(e, {
        a11y: {
          liveRegion: s('<span class="' + e.params.a11y.notificationClass + '" aria-live="assertive" aria-atomic="true"></span>')
        }
      }), Object.keys(he).forEach(function (t) {
        e.a11y[t] = he[t].bind(e);
      });
    },
    on: {
      init: function init() {
        this.params.a11y.enabled && (this.a11y.init(), this.a11y.updateNavigation());
      },
      toEdge: function toEdge() {
        this.params.a11y.enabled && this.a11y.updateNavigation();
      },
      fromEdge: function fromEdge() {
        this.params.a11y.enabled && this.a11y.updateNavigation();
      },
      paginationUpdate: function paginationUpdate() {
        this.params.a11y.enabled && this.a11y.updatePagination();
      },
      destroy: function destroy() {
        this.params.a11y.enabled && this.a11y.destroy();
      }
    }
  }, {
    name: "history",
    params: {
      history: {
        enabled: !1,
        replaceState: !1,
        key: "slides"
      }
    },
    create: function create() {
      n.extend(this, {
        history: {
          init: pe.init.bind(this),
          setHistory: pe.setHistory.bind(this),
          setHistoryPopState: pe.setHistoryPopState.bind(this),
          scrollToSlide: pe.scrollToSlide.bind(this),
          destroy: pe.destroy.bind(this)
        }
      });
    },
    on: {
      init: function init() {
        this.params.history.enabled && this.history.init();
      },
      destroy: function destroy() {
        this.params.history.enabled && this.history.destroy();
      },
      transitionEnd: function transitionEnd() {
        this.history.initialized && this.history.setHistory(this.params.history.key, this.activeIndex);
      },
      slideChange: function slideChange() {
        this.history.initialized && this.params.cssMode && this.history.setHistory(this.params.history.key, this.activeIndex);
      }
    }
  }, {
    name: "hash-navigation",
    params: {
      hashNavigation: {
        enabled: !1,
        replaceState: !1,
        watchState: !1
      }
    },
    create: function create() {
      n.extend(this, {
        hashNavigation: {
          initialized: !1,
          init: ce.init.bind(this),
          destroy: ce.destroy.bind(this),
          setHash: ce.setHash.bind(this),
          onHashCange: ce.onHashCange.bind(this)
        }
      });
    },
    on: {
      init: function init() {
        this.params.hashNavigation.enabled && this.hashNavigation.init();
      },
      destroy: function destroy() {
        this.params.hashNavigation.enabled && this.hashNavigation.destroy();
      },
      transitionEnd: function transitionEnd() {
        this.hashNavigation.initialized && this.hashNavigation.setHash();
      },
      slideChange: function slideChange() {
        this.hashNavigation.initialized && this.params.cssMode && this.hashNavigation.setHash();
      }
    }
  }, {
    name: "autoplay",
    params: {
      autoplay: {
        enabled: !1,
        delay: 3e3,
        waitForTransition: !0,
        disableOnInteraction: !0,
        stopOnLastSlide: !1,
        reverseDirection: !1
      }
    },
    create: function create() {
      var e = this;
      n.extend(e, {
        autoplay: {
          running: !1,
          paused: !1,
          run: ue.run.bind(e),
          start: ue.start.bind(e),
          stop: ue.stop.bind(e),
          pause: ue.pause.bind(e),
          onVisibilityChange: function onVisibilityChange() {
            "hidden" === document.visibilityState && e.autoplay.running && e.autoplay.pause(), "visible" === document.visibilityState && e.autoplay.paused && (e.autoplay.run(), e.autoplay.paused = !1);
          },
          onTransitionEnd: function onTransitionEnd(t) {
            e && !e.destroyed && e.$wrapperEl && t.target === this && (e.$wrapperEl[0].removeEventListener("transitionend", e.autoplay.onTransitionEnd), e.$wrapperEl[0].removeEventListener("webkitTransitionEnd", e.autoplay.onTransitionEnd), e.autoplay.paused = !1, e.autoplay.running ? e.autoplay.run() : e.autoplay.stop());
          }
        }
      });
    },
    on: {
      init: function init() {
        this.params.autoplay.enabled && (this.autoplay.start(), document.addEventListener("visibilitychange", this.autoplay.onVisibilityChange));
      },
      beforeTransitionStart: function beforeTransitionStart(e, t) {
        this.autoplay.running && (t || !this.params.autoplay.disableOnInteraction ? this.autoplay.pause(e) : this.autoplay.stop());
      },
      sliderFirstMove: function sliderFirstMove() {
        this.autoplay.running && (this.params.autoplay.disableOnInteraction ? this.autoplay.stop() : this.autoplay.pause());
      },
      touchEnd: function touchEnd() {
        this.params.cssMode && this.autoplay.paused && !this.params.autoplay.disableOnInteraction && this.autoplay.run();
      },
      destroy: function destroy() {
        this.autoplay.running && this.autoplay.stop(), document.removeEventListener("visibilitychange", this.autoplay.onVisibilityChange);
      }
    }
  }, {
    name: "effect-fade",
    params: {
      fadeEffect: {
        crossFade: !1
      }
    },
    create: function create() {
      n.extend(this, {
        fadeEffect: {
          setTranslate: ve.setTranslate.bind(this),
          setTransition: ve.setTransition.bind(this)
        }
      });
    },
    on: {
      beforeInit: function beforeInit() {
        if ("fade" === this.params.effect) {
          this.classNames.push(this.params.containerModifierClass + "fade");
          var e = {
            slidesPerView: 1,
            slidesPerColumn: 1,
            slidesPerGroup: 1,
            watchSlidesProgress: !0,
            spaceBetween: 0,
            virtualTranslate: !0
          };
          n.extend(this.params, e), n.extend(this.originalParams, e);
        }
      },
      setTranslate: function setTranslate() {
        "fade" === this.params.effect && this.fadeEffect.setTranslate();
      },
      setTransition: function setTransition(e) {
        "fade" === this.params.effect && this.fadeEffect.setTransition(e);
      }
    }
  }, {
    name: "effect-cube",
    params: {
      cubeEffect: {
        slideShadows: !0,
        shadow: !0,
        shadowOffset: 20,
        shadowScale: .94
      }
    },
    create: function create() {
      n.extend(this, {
        cubeEffect: {
          setTranslate: fe.setTranslate.bind(this),
          setTransition: fe.setTransition.bind(this)
        }
      });
    },
    on: {
      beforeInit: function beforeInit() {
        if ("cube" === this.params.effect) {
          this.classNames.push(this.params.containerModifierClass + "cube"), this.classNames.push(this.params.containerModifierClass + "3d");
          var e = {
            slidesPerView: 1,
            slidesPerColumn: 1,
            slidesPerGroup: 1,
            watchSlidesProgress: !0,
            resistanceRatio: 0,
            spaceBetween: 0,
            centeredSlides: !1,
            virtualTranslate: !0
          };
          n.extend(this.params, e), n.extend(this.originalParams, e);
        }
      },
      setTranslate: function setTranslate() {
        "cube" === this.params.effect && this.cubeEffect.setTranslate();
      },
      setTransition: function setTransition(e) {
        "cube" === this.params.effect && this.cubeEffect.setTransition(e);
      }
    }
  }, {
    name: "effect-flip",
    params: {
      flipEffect: {
        slideShadows: !0,
        limitRotation: !0
      }
    },
    create: function create() {
      n.extend(this, {
        flipEffect: {
          setTranslate: me.setTranslate.bind(this),
          setTransition: me.setTransition.bind(this)
        }
      });
    },
    on: {
      beforeInit: function beforeInit() {
        if ("flip" === this.params.effect) {
          this.classNames.push(this.params.containerModifierClass + "flip"), this.classNames.push(this.params.containerModifierClass + "3d");
          var e = {
            slidesPerView: 1,
            slidesPerColumn: 1,
            slidesPerGroup: 1,
            watchSlidesProgress: !0,
            spaceBetween: 0,
            virtualTranslate: !0
          };
          n.extend(this.params, e), n.extend(this.originalParams, e);
        }
      },
      setTranslate: function setTranslate() {
        "flip" === this.params.effect && this.flipEffect.setTranslate();
      },
      setTransition: function setTransition(e) {
        "flip" === this.params.effect && this.flipEffect.setTransition(e);
      }
    }
  }, {
    name: "effect-coverflow",
    params: {
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: !0
      }
    },
    create: function create() {
      n.extend(this, {
        coverflowEffect: {
          setTranslate: ge.setTranslate.bind(this),
          setTransition: ge.setTransition.bind(this)
        }
      });
    },
    on: {
      beforeInit: function beforeInit() {
        "coverflow" === this.params.effect && (this.classNames.push(this.params.containerModifierClass + "coverflow"), this.classNames.push(this.params.containerModifierClass + "3d"), this.params.watchSlidesProgress = !0, this.originalParams.watchSlidesProgress = !0);
      },
      setTranslate: function setTranslate() {
        "coverflow" === this.params.effect && this.coverflowEffect.setTranslate();
      },
      setTransition: function setTransition(e) {
        "coverflow" === this.params.effect && this.coverflowEffect.setTransition(e);
      }
    }
  }, {
    name: "thumbs",
    params: {
      thumbs: {
        multipleActiveThumbs: !0,
        swiper: null,
        slideThumbActiveClass: "swiper-slide-thumb-active",
        thumbsContainerClass: "swiper-container-thumbs"
      }
    },
    create: function create() {
      n.extend(this, {
        thumbs: {
          swiper: null,
          init: be.init.bind(this),
          update: be.update.bind(this),
          onThumbClick: be.onThumbClick.bind(this)
        }
      });
    },
    on: {
      beforeInit: function beforeInit() {
        var e = this.params.thumbs;
        e && e.swiper && (this.thumbs.init(), this.thumbs.update(!0));
      },
      slideChange: function slideChange() {
        this.thumbs.swiper && this.thumbs.update();
      },
      update: function update() {
        this.thumbs.swiper && this.thumbs.update();
      },
      resize: function resize() {
        this.thumbs.swiper && this.thumbs.update();
      },
      observerUpdate: function observerUpdate() {
        this.thumbs.swiper && this.thumbs.update();
      },
      setTransition: function setTransition(e) {
        var t = this.thumbs.swiper;
        t && t.setTransition(e);
      },
      beforeDestroy: function beforeDestroy() {
        var e = this.thumbs.swiper;
        e && this.thumbs.swiperCreated && e && e.destroy();
      }
    }
  }];
  return void 0 === W.use && (W.use = W.Class.use, W.installModule = W.Class.installModule), W.use(we), W;
});

/***/ }),

/***/ "./resources/scss/app.scss":
/*!*********************************!*\
  !*** ./resources/scss/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/admin/app.scss":
/*!***************************************!*\
  !*** ./resources/scss/admin/app.scss ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/moment/locale sync recursive ^\\.\\/.*$":
/*!***************************************************!*\
  !*** ./node_modules/moment/locale/ sync ^\.\/.*$ ***!
  \***************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./af": "./node_modules/moment/locale/af.js",
	"./af.js": "./node_modules/moment/locale/af.js",
	"./ar": "./node_modules/moment/locale/ar.js",
	"./ar-dz": "./node_modules/moment/locale/ar-dz.js",
	"./ar-dz.js": "./node_modules/moment/locale/ar-dz.js",
	"./ar-kw": "./node_modules/moment/locale/ar-kw.js",
	"./ar-kw.js": "./node_modules/moment/locale/ar-kw.js",
	"./ar-ly": "./node_modules/moment/locale/ar-ly.js",
	"./ar-ly.js": "./node_modules/moment/locale/ar-ly.js",
	"./ar-ma": "./node_modules/moment/locale/ar-ma.js",
	"./ar-ma.js": "./node_modules/moment/locale/ar-ma.js",
	"./ar-sa": "./node_modules/moment/locale/ar-sa.js",
	"./ar-sa.js": "./node_modules/moment/locale/ar-sa.js",
	"./ar-tn": "./node_modules/moment/locale/ar-tn.js",
	"./ar-tn.js": "./node_modules/moment/locale/ar-tn.js",
	"./ar.js": "./node_modules/moment/locale/ar.js",
	"./az": "./node_modules/moment/locale/az.js",
	"./az.js": "./node_modules/moment/locale/az.js",
	"./be": "./node_modules/moment/locale/be.js",
	"./be.js": "./node_modules/moment/locale/be.js",
	"./bg": "./node_modules/moment/locale/bg.js",
	"./bg.js": "./node_modules/moment/locale/bg.js",
	"./bm": "./node_modules/moment/locale/bm.js",
	"./bm.js": "./node_modules/moment/locale/bm.js",
	"./bn": "./node_modules/moment/locale/bn.js",
	"./bn-bd": "./node_modules/moment/locale/bn-bd.js",
	"./bn-bd.js": "./node_modules/moment/locale/bn-bd.js",
	"./bn.js": "./node_modules/moment/locale/bn.js",
	"./bo": "./node_modules/moment/locale/bo.js",
	"./bo.js": "./node_modules/moment/locale/bo.js",
	"./br": "./node_modules/moment/locale/br.js",
	"./br.js": "./node_modules/moment/locale/br.js",
	"./bs": "./node_modules/moment/locale/bs.js",
	"./bs.js": "./node_modules/moment/locale/bs.js",
	"./ca": "./node_modules/moment/locale/ca.js",
	"./ca.js": "./node_modules/moment/locale/ca.js",
	"./cs": "./node_modules/moment/locale/cs.js",
	"./cs.js": "./node_modules/moment/locale/cs.js",
	"./cv": "./node_modules/moment/locale/cv.js",
	"./cv.js": "./node_modules/moment/locale/cv.js",
	"./cy": "./node_modules/moment/locale/cy.js",
	"./cy.js": "./node_modules/moment/locale/cy.js",
	"./da": "./node_modules/moment/locale/da.js",
	"./da.js": "./node_modules/moment/locale/da.js",
	"./de": "./node_modules/moment/locale/de.js",
	"./de-at": "./node_modules/moment/locale/de-at.js",
	"./de-at.js": "./node_modules/moment/locale/de-at.js",
	"./de-ch": "./node_modules/moment/locale/de-ch.js",
	"./de-ch.js": "./node_modules/moment/locale/de-ch.js",
	"./de.js": "./node_modules/moment/locale/de.js",
	"./dv": "./node_modules/moment/locale/dv.js",
	"./dv.js": "./node_modules/moment/locale/dv.js",
	"./el": "./node_modules/moment/locale/el.js",
	"./el.js": "./node_modules/moment/locale/el.js",
	"./en-au": "./node_modules/moment/locale/en-au.js",
	"./en-au.js": "./node_modules/moment/locale/en-au.js",
	"./en-ca": "./node_modules/moment/locale/en-ca.js",
	"./en-ca.js": "./node_modules/moment/locale/en-ca.js",
	"./en-gb": "./node_modules/moment/locale/en-gb.js",
	"./en-gb.js": "./node_modules/moment/locale/en-gb.js",
	"./en-ie": "./node_modules/moment/locale/en-ie.js",
	"./en-ie.js": "./node_modules/moment/locale/en-ie.js",
	"./en-il": "./node_modules/moment/locale/en-il.js",
	"./en-il.js": "./node_modules/moment/locale/en-il.js",
	"./en-in": "./node_modules/moment/locale/en-in.js",
	"./en-in.js": "./node_modules/moment/locale/en-in.js",
	"./en-nz": "./node_modules/moment/locale/en-nz.js",
	"./en-nz.js": "./node_modules/moment/locale/en-nz.js",
	"./en-sg": "./node_modules/moment/locale/en-sg.js",
	"./en-sg.js": "./node_modules/moment/locale/en-sg.js",
	"./eo": "./node_modules/moment/locale/eo.js",
	"./eo.js": "./node_modules/moment/locale/eo.js",
	"./es": "./node_modules/moment/locale/es.js",
	"./es-do": "./node_modules/moment/locale/es-do.js",
	"./es-do.js": "./node_modules/moment/locale/es-do.js",
	"./es-mx": "./node_modules/moment/locale/es-mx.js",
	"./es-mx.js": "./node_modules/moment/locale/es-mx.js",
	"./es-us": "./node_modules/moment/locale/es-us.js",
	"./es-us.js": "./node_modules/moment/locale/es-us.js",
	"./es.js": "./node_modules/moment/locale/es.js",
	"./et": "./node_modules/moment/locale/et.js",
	"./et.js": "./node_modules/moment/locale/et.js",
	"./eu": "./node_modules/moment/locale/eu.js",
	"./eu.js": "./node_modules/moment/locale/eu.js",
	"./fa": "./node_modules/moment/locale/fa.js",
	"./fa.js": "./node_modules/moment/locale/fa.js",
	"./fi": "./node_modules/moment/locale/fi.js",
	"./fi.js": "./node_modules/moment/locale/fi.js",
	"./fil": "./node_modules/moment/locale/fil.js",
	"./fil.js": "./node_modules/moment/locale/fil.js",
	"./fo": "./node_modules/moment/locale/fo.js",
	"./fo.js": "./node_modules/moment/locale/fo.js",
	"./fr": "./node_modules/moment/locale/fr.js",
	"./fr-ca": "./node_modules/moment/locale/fr-ca.js",
	"./fr-ca.js": "./node_modules/moment/locale/fr-ca.js",
	"./fr-ch": "./node_modules/moment/locale/fr-ch.js",
	"./fr-ch.js": "./node_modules/moment/locale/fr-ch.js",
	"./fr.js": "./node_modules/moment/locale/fr.js",
	"./fy": "./node_modules/moment/locale/fy.js",
	"./fy.js": "./node_modules/moment/locale/fy.js",
	"./ga": "./node_modules/moment/locale/ga.js",
	"./ga.js": "./node_modules/moment/locale/ga.js",
	"./gd": "./node_modules/moment/locale/gd.js",
	"./gd.js": "./node_modules/moment/locale/gd.js",
	"./gl": "./node_modules/moment/locale/gl.js",
	"./gl.js": "./node_modules/moment/locale/gl.js",
	"./gom-deva": "./node_modules/moment/locale/gom-deva.js",
	"./gom-deva.js": "./node_modules/moment/locale/gom-deva.js",
	"./gom-latn": "./node_modules/moment/locale/gom-latn.js",
	"./gom-latn.js": "./node_modules/moment/locale/gom-latn.js",
	"./gu": "./node_modules/moment/locale/gu.js",
	"./gu.js": "./node_modules/moment/locale/gu.js",
	"./he": "./node_modules/moment/locale/he.js",
	"./he.js": "./node_modules/moment/locale/he.js",
	"./hi": "./node_modules/moment/locale/hi.js",
	"./hi.js": "./node_modules/moment/locale/hi.js",
	"./hr": "./node_modules/moment/locale/hr.js",
	"./hr.js": "./node_modules/moment/locale/hr.js",
	"./hu": "./node_modules/moment/locale/hu.js",
	"./hu.js": "./node_modules/moment/locale/hu.js",
	"./hy-am": "./node_modules/moment/locale/hy-am.js",
	"./hy-am.js": "./node_modules/moment/locale/hy-am.js",
	"./id": "./node_modules/moment/locale/id.js",
	"./id.js": "./node_modules/moment/locale/id.js",
	"./is": "./node_modules/moment/locale/is.js",
	"./is.js": "./node_modules/moment/locale/is.js",
	"./it": "./node_modules/moment/locale/it.js",
	"./it-ch": "./node_modules/moment/locale/it-ch.js",
	"./it-ch.js": "./node_modules/moment/locale/it-ch.js",
	"./it.js": "./node_modules/moment/locale/it.js",
	"./ja": "./node_modules/moment/locale/ja.js",
	"./ja.js": "./node_modules/moment/locale/ja.js",
	"./jv": "./node_modules/moment/locale/jv.js",
	"./jv.js": "./node_modules/moment/locale/jv.js",
	"./ka": "./node_modules/moment/locale/ka.js",
	"./ka.js": "./node_modules/moment/locale/ka.js",
	"./kk": "./node_modules/moment/locale/kk.js",
	"./kk.js": "./node_modules/moment/locale/kk.js",
	"./km": "./node_modules/moment/locale/km.js",
	"./km.js": "./node_modules/moment/locale/km.js",
	"./kn": "./node_modules/moment/locale/kn.js",
	"./kn.js": "./node_modules/moment/locale/kn.js",
	"./ko": "./node_modules/moment/locale/ko.js",
	"./ko.js": "./node_modules/moment/locale/ko.js",
	"./ku": "./node_modules/moment/locale/ku.js",
	"./ku.js": "./node_modules/moment/locale/ku.js",
	"./ky": "./node_modules/moment/locale/ky.js",
	"./ky.js": "./node_modules/moment/locale/ky.js",
	"./lb": "./node_modules/moment/locale/lb.js",
	"./lb.js": "./node_modules/moment/locale/lb.js",
	"./lo": "./node_modules/moment/locale/lo.js",
	"./lo.js": "./node_modules/moment/locale/lo.js",
	"./lt": "./node_modules/moment/locale/lt.js",
	"./lt.js": "./node_modules/moment/locale/lt.js",
	"./lv": "./node_modules/moment/locale/lv.js",
	"./lv.js": "./node_modules/moment/locale/lv.js",
	"./me": "./node_modules/moment/locale/me.js",
	"./me.js": "./node_modules/moment/locale/me.js",
	"./mi": "./node_modules/moment/locale/mi.js",
	"./mi.js": "./node_modules/moment/locale/mi.js",
	"./mk": "./node_modules/moment/locale/mk.js",
	"./mk.js": "./node_modules/moment/locale/mk.js",
	"./ml": "./node_modules/moment/locale/ml.js",
	"./ml.js": "./node_modules/moment/locale/ml.js",
	"./mn": "./node_modules/moment/locale/mn.js",
	"./mn.js": "./node_modules/moment/locale/mn.js",
	"./mr": "./node_modules/moment/locale/mr.js",
	"./mr.js": "./node_modules/moment/locale/mr.js",
	"./ms": "./node_modules/moment/locale/ms.js",
	"./ms-my": "./node_modules/moment/locale/ms-my.js",
	"./ms-my.js": "./node_modules/moment/locale/ms-my.js",
	"./ms.js": "./node_modules/moment/locale/ms.js",
	"./mt": "./node_modules/moment/locale/mt.js",
	"./mt.js": "./node_modules/moment/locale/mt.js",
	"./my": "./node_modules/moment/locale/my.js",
	"./my.js": "./node_modules/moment/locale/my.js",
	"./nb": "./node_modules/moment/locale/nb.js",
	"./nb.js": "./node_modules/moment/locale/nb.js",
	"./ne": "./node_modules/moment/locale/ne.js",
	"./ne.js": "./node_modules/moment/locale/ne.js",
	"./nl": "./node_modules/moment/locale/nl.js",
	"./nl-be": "./node_modules/moment/locale/nl-be.js",
	"./nl-be.js": "./node_modules/moment/locale/nl-be.js",
	"./nl.js": "./node_modules/moment/locale/nl.js",
	"./nn": "./node_modules/moment/locale/nn.js",
	"./nn.js": "./node_modules/moment/locale/nn.js",
	"./oc-lnc": "./node_modules/moment/locale/oc-lnc.js",
	"./oc-lnc.js": "./node_modules/moment/locale/oc-lnc.js",
	"./pa-in": "./node_modules/moment/locale/pa-in.js",
	"./pa-in.js": "./node_modules/moment/locale/pa-in.js",
	"./pl": "./node_modules/moment/locale/pl.js",
	"./pl.js": "./node_modules/moment/locale/pl.js",
	"./pt": "./node_modules/moment/locale/pt.js",
	"./pt-br": "./node_modules/moment/locale/pt-br.js",
	"./pt-br.js": "./node_modules/moment/locale/pt-br.js",
	"./pt.js": "./node_modules/moment/locale/pt.js",
	"./ro": "./node_modules/moment/locale/ro.js",
	"./ro.js": "./node_modules/moment/locale/ro.js",
	"./ru": "./node_modules/moment/locale/ru.js",
	"./ru.js": "./node_modules/moment/locale/ru.js",
	"./sd": "./node_modules/moment/locale/sd.js",
	"./sd.js": "./node_modules/moment/locale/sd.js",
	"./se": "./node_modules/moment/locale/se.js",
	"./se.js": "./node_modules/moment/locale/se.js",
	"./si": "./node_modules/moment/locale/si.js",
	"./si.js": "./node_modules/moment/locale/si.js",
	"./sk": "./node_modules/moment/locale/sk.js",
	"./sk.js": "./node_modules/moment/locale/sk.js",
	"./sl": "./node_modules/moment/locale/sl.js",
	"./sl.js": "./node_modules/moment/locale/sl.js",
	"./sq": "./node_modules/moment/locale/sq.js",
	"./sq.js": "./node_modules/moment/locale/sq.js",
	"./sr": "./node_modules/moment/locale/sr.js",
	"./sr-cyrl": "./node_modules/moment/locale/sr-cyrl.js",
	"./sr-cyrl.js": "./node_modules/moment/locale/sr-cyrl.js",
	"./sr.js": "./node_modules/moment/locale/sr.js",
	"./ss": "./node_modules/moment/locale/ss.js",
	"./ss.js": "./node_modules/moment/locale/ss.js",
	"./sv": "./node_modules/moment/locale/sv.js",
	"./sv.js": "./node_modules/moment/locale/sv.js",
	"./sw": "./node_modules/moment/locale/sw.js",
	"./sw.js": "./node_modules/moment/locale/sw.js",
	"./ta": "./node_modules/moment/locale/ta.js",
	"./ta.js": "./node_modules/moment/locale/ta.js",
	"./te": "./node_modules/moment/locale/te.js",
	"./te.js": "./node_modules/moment/locale/te.js",
	"./tet": "./node_modules/moment/locale/tet.js",
	"./tet.js": "./node_modules/moment/locale/tet.js",
	"./tg": "./node_modules/moment/locale/tg.js",
	"./tg.js": "./node_modules/moment/locale/tg.js",
	"./th": "./node_modules/moment/locale/th.js",
	"./th.js": "./node_modules/moment/locale/th.js",
	"./tk": "./node_modules/moment/locale/tk.js",
	"./tk.js": "./node_modules/moment/locale/tk.js",
	"./tl-ph": "./node_modules/moment/locale/tl-ph.js",
	"./tl-ph.js": "./node_modules/moment/locale/tl-ph.js",
	"./tlh": "./node_modules/moment/locale/tlh.js",
	"./tlh.js": "./node_modules/moment/locale/tlh.js",
	"./tr": "./node_modules/moment/locale/tr.js",
	"./tr.js": "./node_modules/moment/locale/tr.js",
	"./tzl": "./node_modules/moment/locale/tzl.js",
	"./tzl.js": "./node_modules/moment/locale/tzl.js",
	"./tzm": "./node_modules/moment/locale/tzm.js",
	"./tzm-latn": "./node_modules/moment/locale/tzm-latn.js",
	"./tzm-latn.js": "./node_modules/moment/locale/tzm-latn.js",
	"./tzm.js": "./node_modules/moment/locale/tzm.js",
	"./ug-cn": "./node_modules/moment/locale/ug-cn.js",
	"./ug-cn.js": "./node_modules/moment/locale/ug-cn.js",
	"./uk": "./node_modules/moment/locale/uk.js",
	"./uk.js": "./node_modules/moment/locale/uk.js",
	"./ur": "./node_modules/moment/locale/ur.js",
	"./ur.js": "./node_modules/moment/locale/ur.js",
	"./uz": "./node_modules/moment/locale/uz.js",
	"./uz-latn": "./node_modules/moment/locale/uz-latn.js",
	"./uz-latn.js": "./node_modules/moment/locale/uz-latn.js",
	"./uz.js": "./node_modules/moment/locale/uz.js",
	"./vi": "./node_modules/moment/locale/vi.js",
	"./vi.js": "./node_modules/moment/locale/vi.js",
	"./x-pseudo": "./node_modules/moment/locale/x-pseudo.js",
	"./x-pseudo.js": "./node_modules/moment/locale/x-pseudo.js",
	"./yo": "./node_modules/moment/locale/yo.js",
	"./yo.js": "./node_modules/moment/locale/yo.js",
	"./zh-cn": "./node_modules/moment/locale/zh-cn.js",
	"./zh-cn.js": "./node_modules/moment/locale/zh-cn.js",
	"./zh-hk": "./node_modules/moment/locale/zh-hk.js",
	"./zh-hk.js": "./node_modules/moment/locale/zh-hk.js",
	"./zh-mo": "./node_modules/moment/locale/zh-mo.js",
	"./zh-mo.js": "./node_modules/moment/locale/zh-mo.js",
	"./zh-tw": "./node_modules/moment/locale/zh-tw.js",
	"./zh-tw.js": "./node_modules/moment/locale/zh-tw.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./node_modules/moment/locale sync recursive ^\\.\\/.*$";

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["css/admin","css/app","/js/vendor"], () => (__webpack_exec__("./resources/js/app.js"), __webpack_exec__("./resources/scss/app.scss"), __webpack_exec__("./resources/scss/admin/app.scss")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=app.js.map