!function (a, b, c) {
  "use strict";
  var d = function (b, c) {
    this.widget = "", this.$element = a(b), this.defaultTime = c.defaultTime, this.disableFocus = c.disableFocus, this.disableMousewheel = c.disableMousewheel, this.isOpen = c.isOpen, this.minuteStep = c.minuteStep, this.modalBackdrop = c.modalBackdrop, this.orientation = c.orientation, this.secondStep = c.secondStep, this.snapToStep = c.snapToStep, this.showInputs = c.showInputs, this.showMeridian = c.showMeridian, this.showSeconds = c.showSeconds, this.template = c.template, this.appendWidgetTo = c.appendWidgetTo, this.showWidgetOnAddonClick = c.showWidgetOnAddonClick, this.icons = c.icons, this.maxHours = c.maxHours, this.explicitMode = c.explicitMode, this.handleDocumentClick = function (a) {
      var b = a.data.scope;
      b.$element.parent().find(a.target).length || b.$widget.is(a.target) || b.$widget.find(a.target).length || b.hideWidget()
    }, this._init()
  };
  d.prototype = {
    constructor: d, _init: function () {
      var b = this;
      this.showWidgetOnAddonClick && this.$element.parent().hasClass("input-group") && this.$element.parent().hasClass("bootstrap-timepicker") ? (this.$element.parent(".input-group.bootstrap-timepicker").find(".input-group-addon").on({"click.timepicker": a.proxy(this.showWidget, this)}), this.$element.on({
        "focus.timepicker": a.proxy(this.highlightUnit, this),
        "click.timepicker": a.proxy(this.highlightUnit, this),
        "keydown.timepicker": a.proxy(this.elementKeydown, this),
        "blur.timepicker": a.proxy(this.blurElement, this),
        "mousewheel.timepicker DOMMouseScroll.timepicker": a.proxy(this.mousewheel, this)
      })) : this.template ? this.$element.on({
        "focus.timepicker": a.proxy(this.showWidget, this),
        "click.timepicker": a.proxy(this.showWidget, this),
        "blur.timepicker": a.proxy(this.blurElement, this),
        "mousewheel.timepicker DOMMouseScroll.timepicker": a.proxy(this.mousewheel, this)
      }) : this.$element.on({
        "focus.timepicker": a.proxy(this.highlightUnit, this),
        "click.timepicker": a.proxy(this.highlightUnit, this),
        "keydown.timepicker": a.proxy(this.elementKeydown, this),
        "blur.timepicker": a.proxy(this.blurElement, this),
        "mousewheel.timepicker DOMMouseScroll.timepicker": a.proxy(this.mousewheel, this)
      }), this.template !== !1 ? this.$widget = a(this.getTemplate()).on("click", a.proxy(this.widgetClick, this)) : this.$widget = !1, this.showInputs && this.$widget !== !1 && this.$widget.find("input").each(function () {
        a(this).on({
          "click.timepicker": function () {
            a(this).select()
          }, "keydown.timepicker": a.proxy(b.widgetKeydown, b), "keyup.timepicker": a.proxy(b.widgetKeyup, b)
        })
      }), this.setDefaultTime(this.defaultTime)
    }, blurElement: function () {
      this.highlightedUnit = null, this.updateFromElementVal()
    }, clear: function () {
      this.hour = "", this.minute = "", this.second = "", this.meridian = "", this.$element.val("")
    }, decrementHour: function () {
      if (this.showMeridian) if (1 === this.hour) this.hour = 12; else {
        if (12 === this.hour) return this.hour--, this.toggleMeridian();
        if (0 === this.hour) return this.hour = 11, this.toggleMeridian();
        this.hour--
      } else this.hour <= 0 ? this.hour = this.maxHours - 1 : this.hour--
    }, decrementMinute: function (a) {
      var b;
      b = a ? this.minute - a : this.minute - this.minuteStep, 0 > b ? (this.decrementHour(), this.minute = b + 60) : this.minute = b
    }, decrementSecond: function () {
      var a = this.second - this.secondStep;
      0 > a ? (this.decrementMinute(!0), this.second = a + 60) : this.second = a
    }, elementKeydown: function (a) {
      switch (a.which) {
        case 9:
          if (a.shiftKey) {
            if ("hour" === this.highlightedUnit) {
              this.hideWidget();
              break
            }
            this.highlightPrevUnit()
          } else {
            if (this.showMeridian && "meridian" === this.highlightedUnit || this.showSeconds && "second" === this.highlightedUnit || !this.showMeridian && !this.showSeconds && "minute" === this.highlightedUnit) {
              this.hideWidget();
              break
            }
            this.highlightNextUnit()
          }
          a.preventDefault(), this.updateFromElementVal();
          break;
        case 27:
          this.updateFromElementVal();
          break;
        case 37:
          a.preventDefault(), this.highlightPrevUnit(), this.updateFromElementVal();
          break;
        case 38:
          switch (a.preventDefault(), this.highlightedUnit) {
            case"hour":
              this.incrementHour(), this.highlightHour();
              break;
            case"minute":
              this.incrementMinute(), this.highlightMinute();
              break;
            case"second":
              this.incrementSecond(), this.highlightSecond();
              break;
            case"meridian":
              this.toggleMeridian(), this.highlightMeridian()
          }
          this.update();
          break;
        case 39:
          a.preventDefault(), this.highlightNextUnit(), this.updateFromElementVal();
          break;
        case 40:
          switch (a.preventDefault(), this.highlightedUnit) {
            case"hour":
              this.decrementHour(), this.highlightHour();
              break;
            case"minute":
              this.decrementMinute(), this.highlightMinute();
              break;
            case"second":
              this.decrementSecond(), this.highlightSecond();
              break;
            case"meridian":
              this.toggleMeridian(), this.highlightMeridian()
          }
          this.update()
      }
    }, getCursorPosition: function () {
      var a = this.$element.get(0);
      if ("selectionStart" in a) return a.selectionStart;
      if (c.selection) {
        a.focus();
        var b = c.selection.createRange(), d = c.selection.createRange().text.length;
        return b.moveStart("character", -a.value.length), b.text.length - d
      }
    }, getTemplate: function () {
      var a, b, c, d, e, f;
      switch (this.showInputs ? (b = '<input type="text" class="bootstrap-timepicker-hour" maxlength="2"/>', c = '<input type="text" class="bootstrap-timepicker-minute" maxlength="2"/>', d = '<input type="text" class="bootstrap-timepicker-second" maxlength="2"/>', e = '<input type="text" class="bootstrap-timepicker-meridian" maxlength="2"/>') : (b = '<span class="bootstrap-timepicker-hour"></span>', c = '<span class="bootstrap-timepicker-minute"></span>', d = '<span class="bootstrap-timepicker-second"></span>', e = '<span class="bootstrap-timepicker-meridian"></span>'), f = '<table><tr><td><a href="#" data-action="incrementHour"><span class="' + this.icons.up + '"></span></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute"><span class="' + this.icons.up + '"></span></a></td>' + (this.showSeconds ? '<td class="separator">&nbsp;</td><td><a href="#" data-action="incrementSecond"><span class="' + this.icons.up + '"></span></a></td>' : "") + (this.showMeridian ? '<td class="separator">&nbsp;</td><td class="meridian-column"><a href="#" data-action="toggleMeridian"><span class="' + this.icons.up + '"></span></a></td>' : "") + "</tr><tr><td>" + b + '</td> <td class="separator">:</td><td>' + c + "</td> " + (this.showSeconds ? '<td class="separator">:</td><td>' + d + "</td>" : "") + (this.showMeridian ? '<td class="separator">&nbsp;</td><td>' + e + "</td>" : "") + '</tr><tr><td><a href="#" data-action="decrementHour"><span class="' + this.icons.down + '"></span></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><span class="' + this.icons.down + '"></span></a></td>' + (this.showSeconds ? '<td class="separator">&nbsp;</td><td><a href="#" data-action="decrementSecond"><span class="' + this.icons.down + '"></span></a></td>' : "") + (this.showMeridian ? '<td class="separator">&nbsp;</td><td><a href="#" data-action="toggleMeridian"><span class="' + this.icons.down + '"></span></a></td>' : "") + "</tr></table>", this.template) {
        case"modal":
          a = '<div class="bootstrap-timepicker-widget modal hide fade in" data-backdrop="' + (this.modalBackdrop ? "true" : "false") + '"><div class="modal-header"><a href="#" class="close" data-dismiss="modal">&times;</a><h3>Pick a Time</h3></div><div class="modal-content">' + f + '</div><div class="modal-footer"><a href="#" class="btn btn-primary" data-dismiss="modal">OK</a></div></div>';
          break;
        case"dropdown":
          a = '<div class="bootstrap-timepicker-widget dropdown-menu">' + f + "</div>"
      }
      return a
    }, getTime: function () {
      return "" === this.hour ? "" : this.hour + ":" + (1 === this.minute.toString().length ? "0" + this.minute : this.minute) + (this.showSeconds ? ":" + (1 === this.second.toString().length ? "0" + this.second : this.second) : "") + (this.showMeridian ? " " + this.meridian : "")
    }, hideWidget: function () {
      this.isOpen !== !1 && (this.$element.trigger({
        type: "hide.timepicker",
        time: {
          value: this.getTime(),
          hours: this.hour,
          minutes: this.minute,
          seconds: this.second,
          meridian: this.meridian
        }
      }), "modal" === this.template && this.$widget.modal ? this.$widget.modal("hide") : this.$widget.removeClass("open"), a(c).off("mousedown.timepicker, touchend.timepicker", this.handleDocumentClick), this.isOpen = !1, this.$widget.detach())
    }, highlightUnit: function () {
      this.position = this.getCursorPosition(), this.position >= 0 && this.position <= 2 ? this.highlightHour() : this.position >= 3 && this.position <= 5 ? this.highlightMinute() : this.position >= 6 && this.position <= 8 ? this.showSeconds ? this.highlightSecond() : this.highlightMeridian() : this.position >= 9 && this.position <= 11 && this.highlightMeridian()
    }, highlightNextUnit: function () {
      switch (this.highlightedUnit) {
        case"hour":
          this.highlightMinute();
          break;
        case"minute":
          this.showSeconds ? this.highlightSecond() : this.showMeridian ? this.highlightMeridian() : this.highlightHour();
          break;
        case"second":
          this.showMeridian ? this.highlightMeridian() : this.highlightHour();
          break;
        case"meridian":
          this.highlightHour()
      }
    }, highlightPrevUnit: function () {
      switch (this.highlightedUnit) {
        case"hour":
          this.showMeridian ? this.highlightMeridian() : this.showSeconds ? this.highlightSecond() : this.highlightMinute();
          break;
        case"minute":
          this.highlightHour();
          break;
        case"second":
          this.highlightMinute();
          break;
        case"meridian":
          this.showSeconds ? this.highlightSecond() : this.highlightMinute()
      }
    }, highlightHour: function () {
      var a = this.$element.get(0), b = this;
      this.highlightedUnit = "hour", a.setSelectionRange && setTimeout(function () {
        b.hour < 10 ? a.setSelectionRange(0, 1) : a.setSelectionRange(0, 2)
      }, 0)
    }, highlightMinute: function () {
      var a = this.$element.get(0), b = this;
      this.highlightedUnit = "minute", a.setSelectionRange && setTimeout(function () {
        b.hour < 10 ? a.setSelectionRange(2, 4) : a.setSelectionRange(3, 5)
      }, 0)
    }, highlightSecond: function () {
      var a = this.$element.get(0), b = this;
      this.highlightedUnit = "second", a.setSelectionRange && setTimeout(function () {
        b.hour < 10 ? a.setSelectionRange(5, 7) : a.setSelectionRange(6, 8)
      }, 0)
    }, highlightMeridian: function () {
      var a = this.$element.get(0), b = this;
      this.highlightedUnit = "meridian", a.setSelectionRange && (this.showSeconds ? setTimeout(function () {
        b.hour < 10 ? a.setSelectionRange(8, 10) : a.setSelectionRange(9, 11)
      }, 0) : setTimeout(function () {
        b.hour < 10 ? a.setSelectionRange(5, 7) : a.setSelectionRange(6, 8)
      }, 0))
    }, incrementHour: function () {
      if (this.showMeridian) {
        if (11 === this.hour) return this.hour++, this.toggleMeridian();
        12 === this.hour && (this.hour = 0)
      }
      return this.hour === this.maxHours - 1 ? void (this.hour = 0) : void this.hour++
    }, incrementMinute: function (a) {
      var b;
      b = a ? this.minute + a : this.minute + this.minuteStep - this.minute % this.minuteStep, b > 59 ? (this.incrementHour(), this.minute = b - 60) : this.minute = b
    }, incrementSecond: function () {
      var a = this.second + this.secondStep - this.second % this.secondStep;
      a > 59 ? (this.incrementMinute(!0), this.second = a - 60) : this.second = a
    }, mousewheel: function (b) {
      if (!this.disableMousewheel) {
        b.preventDefault(), b.stopPropagation();
        var c = b.originalEvent.wheelDelta || -b.originalEvent.detail, d = null;
        switch ("mousewheel" === b.type ? d = -1 * b.originalEvent.wheelDelta : "DOMMouseScroll" === b.type && (d = 40 * b.originalEvent.detail), d && (b.preventDefault(), a(this).scrollTop(d + a(this).scrollTop())), this.highlightedUnit) {
          case"minute":
            c > 0 ? this.incrementMinute() : this.decrementMinute(), this.highlightMinute();
            break;
          case"second":
            c > 0 ? this.incrementSecond() : this.decrementSecond(), this.highlightSecond();
            break;
          case"meridian":
            this.toggleMeridian(), this.highlightMeridian();
            break;
          default:
            c > 0 ? this.incrementHour() : this.decrementHour(), this.highlightHour()
        }
        return !1
      }
    }, changeToNearestStep: function (a, b) {
      return a % b === 0 ? a : Math.round(a % b / b) ? (a + (b - a % b)) % 60 : a - a % b
    }, place: function () {
      if (!this.isInline) {
        var c = this.$widget.outerWidth(), d = this.$widget.outerHeight(), e = 10, f = a(b).width(), g = a(b).height(),
          h = a(b).scrollTop(), i = parseInt(this.$element.parents().filter(function () {
            return "auto" !== a(this).css("z-index")
          }).first().css("z-index"), 10) + 10,
          j = this.component ? this.component.parent().offset() : this.$element.offset(),
          k = this.component ? this.component.outerHeight(!0) : this.$element.outerHeight(!1),
          l = this.component ? this.component.outerWidth(!0) : this.$element.outerWidth(!1), m = j.left, n = j.top;
        this.$widget.removeClass("timepicker-orient-top timepicker-orient-bottom timepicker-orient-right timepicker-orient-left"), "auto" !== this.orientation.x ? (this.$widget.addClass("timepicker-orient-" + this.orientation.x), "right" === this.orientation.x && (m -= c - l)) : (this.$widget.addClass("timepicker-orient-left"), j.left < 0 ? m -= j.left - e : j.left + c > f && (m = f - c - e));
        var o, p, q = this.orientation.y;
        "auto" === q && (o = -h + j.top - d, p = h + g - (j.top + k + d), q = Math.max(o, p) === p ? "top" : "bottom"), this.$widget.addClass("timepicker-orient-" + q), "top" === q ? n += k : n -= d + parseInt(this.$widget.css("padding-top"), 10), this.$widget.css({
          top: n,
          left: m,
          zIndex: i
        })
      }
    }, remove: function () {
      a("document").off(".timepicker"), this.$widget && this.$widget.remove(), delete this.$element.data().timepicker
    }, setDefaultTime: function (a) {
      if (this.$element.val()) this.updateFromElementVal(); else if ("current" === a) {
        var b = new Date, c = b.getHours(), d = b.getMinutes(), e = b.getSeconds(), f = "AM";
        0 !== e && (e = Math.ceil(b.getSeconds() / this.secondStep) * this.secondStep, 60 === e && (d += 1, e = 0)), 0 !== d && (d = Math.ceil(b.getMinutes() / this.minuteStep) * this.minuteStep, 60 === d && (c += 1, d = 0)), this.showMeridian && (0 === c ? c = 12 : c >= 12 ? (c > 12 && (c -= 12), f = "PM") : f = "AM"), this.hour = c, this.minute = d, this.second = e, this.meridian = f, this.update()
      } else a === !1 ? (this.hour = 0, this.minute = 0, this.second = 0, this.meridian = "AM") : this.setTime(a)
    }, setTime: function (a, b) {
      if (!a) return void this.clear();
      var c, d, e, f, g, h;
      if ("object" == typeof a && a.getMonth) e = a.getHours(), f = a.getMinutes(), g = a.getSeconds(), this.showMeridian && (h = "AM", e > 12 && (h = "PM", e %= 12), 12 === e && (h = "PM")); else {
        if (c = (/a/i.test(a) ? 1 : 0) + (/p/i.test(a) ? 2 : 0), c > 2) return void this.clear();
        if (d = a.replace(/[^0-9\:]/g, "").split(":"), e = d[0] ? d[0].toString() : d.toString(), this.explicitMode && e.length > 2 && e.length % 2 !== 0) return void this.clear();
        f = d[1] ? d[1].toString() : "", g = d[2] ? d[2].toString() : "", e.length > 4 && (g = e.slice(-2), e = e.slice(0, -2)), e.length > 2 && (f = e.slice(-2), e = e.slice(0, -2)), f.length > 2 && (g = f.slice(-2), f = f.slice(0, -2)), e = parseInt(e, 10), f = parseInt(f, 10), g = parseInt(g, 10), isNaN(e) && (e = 0), isNaN(f) && (f = 0), isNaN(g) && (g = 0), g > 59 && (g = 59), f > 59 && (f = 59), e >= this.maxHours && (e = this.maxHours - 1), this.showMeridian ? (e > 12 && (c = 2, e -= 12), c || (c = 1), 0 === e && (e = 12), h = 1 === c ? "AM" : "PM") : 12 > e && 2 === c ? e += 12 : e >= this.maxHours ? e = this.maxHours - 1 : (0 > e || 12 === e && 1 === c) && (e = 0)
      }
      this.hour = e, this.snapToStep ? (this.minute = this.changeToNearestStep(f, this.minuteStep), this.second = this.changeToNearestStep(g, this.secondStep)) : (this.minute = f, this.second = g), this.meridian = h, this.update(b)
    }, showWidget: function () {
      this.isOpen || this.$element.is(":disabled") || (this.$widget.appendTo(this.appendWidgetTo), a(c).on("mousedown.timepicker, touchend.timepicker", {scope: this}, this.handleDocumentClick), this.$element.trigger({
        type: "show.timepicker",
        time: {
          value: this.getTime(),
          hours: this.hour,
          minutes: this.minute,
          seconds: this.second,
          meridian: this.meridian
        }
      }), this.place(), this.disableFocus && this.$element.blur(), "" === this.hour && (this.defaultTime ? this.setDefaultTime(this.defaultTime) : this.setTime("0:0:0")), "modal" === this.template && this.$widget.modal ? this.$widget.modal("show").on("hidden", a.proxy(this.hideWidget, this)) : this.isOpen === !1 && this.$widget.addClass("open"), this.isOpen = !0)
    }, toggleMeridian: function () {
      this.meridian = "AM" === this.meridian ? "PM" : "AM"
    }, update: function (a) {
      this.updateElement(), a || this.updateWidget(), this.$element.trigger({
        type: "changeTime.timepicker",
        time: {
          value: this.getTime(),
          hours: this.hour,
          minutes: this.minute,
          seconds: this.second,
          meridian: this.meridian
        }
      })
    }, updateElement: function () {
      this.$element.val(this.getTime()).change()
    }, updateFromElementVal: function () {
      this.setTime(this.$element.val())
    }, updateWidget: function () {
      if (this.$widget !== !1) {
        var a = this.hour, b = 1 === this.minute.toString().length ? "0" + this.minute : this.minute,
          c = 1 === this.second.toString().length ? "0" + this.second : this.second;
        this.showInputs ? (this.$widget.find("input.bootstrap-timepicker-hour").val(a), this.$widget.find("input.bootstrap-timepicker-minute").val(b), this.showSeconds && this.$widget.find("input.bootstrap-timepicker-second").val(c), this.showMeridian && this.$widget.find("input.bootstrap-timepicker-meridian").val(this.meridian)) : (this.$widget.find("span.bootstrap-timepicker-hour").text(a), this.$widget.find("span.bootstrap-timepicker-minute").text(b), this.showSeconds && this.$widget.find("span.bootstrap-timepicker-second").text(c), this.showMeridian && this.$widget.find("span.bootstrap-timepicker-meridian").text(this.meridian))
      }
    }, updateFromWidgetInputs: function () {
      if (this.$widget !== !1) {
        var a = this.$widget.find("input.bootstrap-timepicker-hour").val() + ":" + this.$widget.find("input.bootstrap-timepicker-minute").val() + (this.showSeconds ? ":" + this.$widget.find("input.bootstrap-timepicker-second").val() : "") + (this.showMeridian ? this.$widget.find("input.bootstrap-timepicker-meridian").val() : "");
        this.setTime(a, !0)
      }
    }, widgetClick: function (b) {
      b.stopPropagation(), b.preventDefault();
      var c = a(b.target), d = c.closest("a").data("action");
      d && this[d](), this.update(), c.is("input") && c.get(0).setSelectionRange(0, 2)
    }, widgetKeydown: function (b) {
      var c = a(b.target), d = c.attr("class").replace("bootstrap-timepicker-", "");
      switch (b.which) {
        case 9:
          if (b.shiftKey) {
            if ("hour" === d) return this.hideWidget()
          } else if (this.showMeridian && "meridian" === d || this.showSeconds && "second" === d || !this.showMeridian && !this.showSeconds && "minute" === d) return this.hideWidget();
          break;
        case 27:
          this.hideWidget();
          break;
        case 38:
          switch (b.preventDefault(), d) {
            case"hour":
              this.incrementHour();
              break;
            case"minute":
              this.incrementMinute();
              break;
            case"second":
              this.incrementSecond();
              break;
            case"meridian":
              this.toggleMeridian()
          }
          this.setTime(this.getTime()), c.get(0).setSelectionRange(0, 2);
          break;
        case 40:
          switch (b.preventDefault(), d) {
            case"hour":
              this.decrementHour();
              break;
            case"minute":
              this.decrementMinute();
              break;
            case"second":
              this.decrementSecond();
              break;
            case"meridian":
              this.toggleMeridian()
          }
          this.setTime(this.getTime()), c.get(0).setSelectionRange(0, 2)
      }
    }, widgetKeyup: function (a) {
      (65 === a.which || 77 === a.which || 80 === a.which || 46 === a.which || 8 === a.which || a.which >= 48 && a.which <= 57 || a.which >= 96 && a.which <= 105) && this.updateFromWidgetInputs()
    }
  }, a.fn.timepicker = function (b) {
    var c = Array.apply(null, arguments);
    return c.shift(), this.each(function () {
      var e = a(this), f = e.data("timepicker"), g = "object" == typeof b && b;
      f || e.data("timepicker", f = new d(this, a.extend({}, a.fn.timepicker.defaults, g, a(this).data()))), "string" == typeof b && f[b].apply(f, c)
    })
  }, a.fn.timepicker.defaults = {
    defaultTime: "current",
    disableFocus: !1,
    disableMousewheel: !1,
    isOpen: !1,
    minuteStep: 15,
    modalBackdrop: !1,
    orientation: {x: "auto", y: "auto"},
    secondStep: 15,
    snapToStep: !1,
    showSeconds: !1,
    showInputs: !0,
    showMeridian: !0,
    template: "dropdown",
    appendWidgetTo: "body",
    showWidgetOnAddonClick: !0,
    icons: {up: "glyphicon glyphicon-chevron-up", down: "glyphicon glyphicon-chevron-down"},
    maxHours: 24,
    explicitMode: !1
  }, a.fn.timepicker.Constructor = d, a(c).on("focus.timepicker.data-api click.timepicker.data-api", '[data-provide="timepicker"]', function (b) {
    var c = a(this);
    c.data("timepicker") || (b.preventDefault(), c.timepicker())
  })
}(jQuery, window, document);
!function (e) {
  var a = {
    t: "transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd",
    a: "webkitAnimationEnd mozAnimationEnd oAnimationEnd oanimationend animationend"
  }, t = {
    en: {
      name: "English",
      gregorian: !1,
      months: {
        short: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
        full: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
      },
      weekdays: {
        short: ["S", "M", "T", "W", "T", "F", "S"],
        full: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
      }
    },
    it: {
      name: "Italiano",
      gregorian: !0,
      months: {
        short: ["Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic"],
        full: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"]
      },
      weekdays: {
        short: ["D", "L", "M", "M", "G", "V", "S"],
        full: ["Domenica", "LunedÃ¬", "MartedÃ¬", "MercoledÃ¬", "GiovedÃ¬", "VenerdÃ¬", "Sabato"]
      }
    },
    fr: {
      name: "FranÃ§ais",
      gregorian: !0,
      months: {
        short: ["Jan", "FÃ©v", "Mar", "Avr", "Mai", "Jui", "Jui", "AoÃ»", "Sep", "Oct", "Nov", "DÃ©c"],
        full: ["Janvier", "FÃ©vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "AoÃ»t", "Septembre", "Octobre", "Novembre", "DÃ©cembre"]
      },
      weekdays: {
        short: ["D", "L", "M", "M", "J", "V", "S"],
        full: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"]
      }
    },
    zh: {
      name: "ä¸­æ–‡",
      gregorian: !0,
      months: {
        short: ["ä¸€æœˆ", "äºŒæœˆ", "ä¸‰æœˆ", "å››æœˆ", "äº”æœˆ", "å…­æœˆ", "ä¸ƒæœˆ", "å…«æœˆ", "ä¹æœˆ", "åæœˆ", "åä¸€æœˆ", "åäºŒæœˆ"],
        full: ["ä¸€æœˆ", "äºŒæœˆ", "ä¸‰æœˆ", "å››æœˆ", "äº”æœˆ", "å…­æœˆ", "ä¸ƒæœˆ", "å…«æœˆ", "ä¹æœˆ", "åæœˆ", "åä¸€æœˆ", "åäºŒæœˆ"]
      },
      weekdays: {
        short: ["å¤©", "ä¸€", "äºŒ", "ä¸‰", "å››", "äº”", "å…­"],
        full: ["æ˜ŸæœŸå¤©", "æ˜ŸæœŸä¸€", "æ˜ŸæœŸäºŒ", "æ˜ŸæœŸä¸‰", "æ˜ŸæœŸå››", "æ˜ŸæœŸäº”", "æ˜ŸæœŸå…­"]
      }
    },
    ar: {
      name: "Ø§Ù„Ø¹ÙŽØ±ÙŽØ¨ÙÙŠÙŽÙ‘Ø©",
      gregorian: !1,
      months: {
        short: ["Ø¬Ø§Ù†ÙÙŠ", "ÙÙŠÙØ±ÙŠ", "Ù…Ø§Ø±Ø³", "Ø£ÙØ±ÙŠÙ„", "Ù…Ø§ÙŠ", "Ø¬ÙˆØ§Ù†", "Ø¬ÙˆÙŠÙ„ÙŠØ©", "Ø£ÙˆØª", "Ø³Ø¨ØªÙ…Ø¨Ø±", "Ø£ÙƒØªÙˆØ¨Ø±", "Ù†ÙˆÙÙ…Ø¨Ø±", "Ø¯ÙŠØ³Ù…Ø¨Ø±"],
        full: ["Ø¬Ø§Ù†ÙÙŠ", "ÙÙŠÙØ±ÙŠ", "Ù…Ø§Ø±Ø³", "Ø£ÙØ±ÙŠÙ„", "Ù…Ø§ÙŠ", "Ø¬ÙˆØ§Ù†", "Ø¬ÙˆÙŠÙ„ÙŠØ©", "Ø£ÙˆØª", "Ø³Ø¨ØªÙ…Ø¨Ø±", "Ø£ÙƒØªÙˆØ¨Ø±", "Ù†ÙˆÙÙ…Ø¨Ø±", "Ø¯ÙŠØ³Ù…Ø¨Ø±"]
      },
      weekdays: {
        short: ["S", "M", "T", "W", "T", "F", "S"],
        full: ["Ø§Ù„Ø£Ø­Ø¯", "Ø§Ù„Ø¥Ø«Ù†ÙŠÙ†", "Ø§Ù„Ø«Ù„Ø«Ø§Ø¡", "Ø§Ù„Ø£Ø±Ø¨Ø¹Ø§Ø¡", "Ø§Ù„Ø®Ù…ÙŠØ³", "Ø§Ù„Ø¬Ù…Ø¹Ø©", "Ø§Ù„Ø³Ø¨Øª"]
      }
    },
    fa: {
      name: "ÙØ§Ø±Ø³ÛŒ",
      gregorian: !1,
      months: {
        short: ["Ú˜Ø§Ù†ÙˆÛŒÙ‡", "ÙÙˆÙˆØ±ÛŒÙ‡", "Ù…Ø§Ø±Ú†", "Ø¢Ù¾Ø±ÛŒÙ„", "Ù…ÛŒ", "Ø¬ÙˆÙ†", "Ø¬ÙˆÙ„Ø§ÛŒ", "Ø¢Ú¯ÙˆØ³Øª", "Ø³Ù¾ØªØ§Ù…Ø¨Ø±", "Ø§Ú©ØªØ¨Ø±", "Ù†ÙˆØ§Ù…Ø¨Ø±", "Ø¯Ø³Ø§Ù…Ø¨Ø±"],
        full: ["Ú˜Ø§Ù†ÙˆÛŒÙ‡", "ÙÙˆÙˆØ±ÛŒÙ‡", "Ù…Ø§Ø±Ú†", "Ø¢Ù¾Ø±ÛŒÙ„", "Ù…ÛŒ", "Ø¬ÙˆÙ†", "Ø¬ÙˆÙ„Ø§ÛŒ", "Ø¢Ú¯ÙˆØ³Øª", "Ø³Ù¾ØªØ§Ù…Ø¨Ø±", "Ø§Ú©ØªØ¨Ø±", "Ù†ÙˆØ§Ù…Ø¨Ø±", "Ø¯Ø³Ø§Ù…Ø¨Ø±"]
      },
      weekdays: {
        short: ["S", "M", "T", "W", "T", "F", "S"],
        full: ["ÛŒÚ©Ø´Ù†Ø¨Ù‡", "Ø¯ÙˆØ´Ù†Ø¨Ù‡", "Ø³Ù‡ Ø´Ù†Ø¨Ù‡", "Ú†Ù‡Ø§Ø±Ø´Ù†Ø¨Ù‡", "Ù¾Ù†Ø¬ Ø´Ù†Ø¨Ù‡", "Ø¬Ù…Ø¹Ù‡", "Ø´Ù†Ø¨Ù‡"]
      }
    },
    hu: {
      name: "Hungarian",
      gregorian: !0,
      months: {
        short: ["jan", "feb", "mÃ¡r", "Ã¡pr", "mÃ¡j", "jÃºn", "jÃºl", "aug", "sze", "okt", "nov", "dec"],
        full: ["januÃ¡r", "februÃ¡r", "mÃ¡rcius", "Ã¡prilis", "mÃ¡jus", "jÃºnius", "jÃºlius", "augusztus", "szeptember", "oktÃ³ber", "november", "december"]
      },
      weekdays: {
        short: ["v", "h", "k", "s", "c", "p", "s"],
        full: ["vasÃ¡rnap", "hÃ©tfÅ‘", "kedd", "szerda", "csÃ¼tÃ¶rtÃ¶k", "pÃ©ntek", "szombat"]
      }
    },
    gr: {
      name: "Î•Î»Î»Î·Î½Î¹ÎºÎ¬",
      gregorian: !0,
      months: {
        short: ["Î™Î±Î½", "Î¦ÎµÎ²", "ÎœÎ¬Ï", "Î‘Ï€Ï", "ÎœÎ¬Î¹", "Î™Î¿ÏÎ½", "Î™Î¿ÏÎ»", "Î‘ÏÎ³", "Î£ÎµÏ€", "ÎŸÎºÏ„", "ÎÎ¿Î­", "Î”ÎµÎº"],
        full: ["Î™Î±Î½Î¿Ï…Î¬ÏÎ¹Î¿Ï‚", "Î¦ÎµÎ²ÏÎ¿Ï…Î¬ÏÎ¹Î¿Ï‚", "ÎœÎ¬ÏÏ„Î¹Î¿Ï‚", "Î‘Ï€ÏÎ¯Î»Î¹Î¿Ï‚", "ÎœÎ¬Î¹Î¿Ï‚", "Î™Î¿ÏÎ½Î¹Î¿Ï‚", "Î™Î¿ÏÎ»Î¹Î¿Ï‚", "Î‘ÏÎ³Î¿Ï…ÏƒÏ„Î¿Ï‚", "Î£ÎµÏ€Ï„Î­Î¼Î²ÏÎ¹Î¿Ï‚", "ÎŸÎºÏ„ÏŽÎ²ÏÎ¹Î¿Ï‚", "ÎÎ¿Î­Î¼Î²ÏÎ¹Î¿Ï‚", "Î”ÎµÎºÎ­Î¼Î²ÏÎ¹Î¿Ï‚"]
      },
      weekdays: {
        short: ["Îš", "Î”", "Î¤", "Î¤", "Î ", "Î ", "Î£"],
        full: ["ÎšÏ…ÏÎ¹Î±ÎºÎ®", "Î”ÎµÏ…Ï„Î­ÏÎ±", "Î¤ÏÎ¯Ï„Î·", "Î¤ÎµÏ„Î¬ÏÏ„Î·", "Î Î­Î¼Ï€Ï„Î·", "Î Î±ÏÎ±ÏƒÎºÎµÏ…Î®", "Î£Î¬Î²Î²Î±Ï„Î¿"]
      }
    },
    es: {
      name: "EspaÃ±ol",
      gregorian: !0,
      months: {
        short: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        full: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
      },
      weekdays: {
        short: ["D", "L", "M", "X", "J", "V", "S"],
        full: ["Domingo", "Lunes", "Martes", "MiÃ©rcoles", "Jueves", "Viernes", "SÃ¡bado"]
      }
    },
    da: {
      name: "Dansk",
      gregorian: !0,
      months: {
        short: ["jan", "feb", "mar", "apr", "maj", "jun", "jul", "aug", "sep", "okt", "nov", "dec"],
        full: ["januar", "februar", "marts", "april", "maj", "juni", "juli", "august", "september", "oktober", "november", "december"]
      },
      weekdays: {
        short: ["s", "m", "t", "o", "t", "f", "l"],
        full: ["sÃ¸ndag", "mandag", "tirsdag", "onsdag", "torsdag", "fredag", "lÃ¸rdag"]
      }
    },
    de: {
      name: "Deutsch",
      gregorian: !0,
      months: {
        short: ["Jan", "Feb", "MÃ¤r", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez"],
        full: ["Januar", "Februar", "MÃ¤rz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"]
      },
      weekdays: {
        short: ["S", "M", "D", "M", "D", "F", "S"],
        full: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"]
      }
    },
    nl: {
      name: "Nederlands",
      gregorian: !0,
      months: {
        short: ["jan", "feb", "maa", "apr", "mei", "jun", "jul", "aug", "sep", "okt", "nov", "dec"],
        full: ["januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december"]
      },
      weekdays: {
        short: ["z", "m", "d", "w", "d", "v", "z"],
        full: ["zondag", "maandag", "dinsdag", "woensdag", "donderdag", "vrijdag", "zaterdag"]
      }
    },
    pl: {
      name: "jÄ™zyk polski",
      gregorian: !0,
      months: {
        short: ["sty", "lut", "mar", "kwi", "maj", "cze", "lip", "sie", "wrz", "paÅº", "lis", "gru"],
        full: ["styczeÅ„", "luty", "marzec", "kwiecieÅ„", "maj", "czerwiec", "lipiec", "sierpieÅ„", "wrzesieÅ„", "paÅºdziernik", "listopad", "grudzieÅ„"]
      },
      weekdays: {
        short: ["n", "p", "w", "Å›", "c", "p", "s"],
        full: ["niedziela", "poniedziaÅ‚ek", "wtorek", "Å›roda", "czwartek", "piÄ…tek", "sobota"]
      }
    },
    pt: {
      name: "PortuguÃªs",
      gregorian: !0,
      months: {
        short: ["Janeiro", "Fevereiro", "MarÃ§o", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
        full: ["Janeiro", "Fevereiro", "MarÃ§o", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]
      },
      weekdays: {
        short: ["D", "S", "T", "Q", "Q", "S", "S"],
        full: ["Domingo", "Segunda", "TerÃ§a", "Quarta", "Quinta", "Sexta", "SÃ¡bado"]
      }
    },
    si: {
      name: "SlovenÅ¡Äina",
      gregorian: !0,
      months: {
        short: ["jan", "feb", "mar", "apr", "maj", "jun", "jul", "avg", "sep", "okt", "nov", "dec"],
        full: ["januar", "februar", "marec", "april", "maj", "junij", "julij", "avgust", "september", "oktober", "november", "december"]
      },
      weekdays: {
        short: ["n", "p", "t", "s", "Ä", "p", "s"],
        full: ["nedelja", "ponedeljek", "torek", "sreda", "Äetrtek", "petek", "sobota"]
      }
    },
    uk: {
      name: "ÑƒÐºÑ€Ð°Ñ—Ð½ÑÑŒÐºÐ° Ð¼Ð¾Ð²Ð°",
      gregorian: !0,
      months: {
        short: ["ÑÑ–Ñ‡ÐµÐ½ÑŒ", "Ð»ÑŽÑ‚Ð¸Ð¹", "Ð±ÐµÑ€ÐµÐ·ÐµÐ½ÑŒ", "ÐºÐ²Ñ–Ñ‚ÐµÐ½ÑŒ", "Ñ‚Ñ€Ð°Ð²ÐµÐ½ÑŒ", "Ñ‡ÐµÑ€Ð²ÐµÐ½ÑŒ", "Ð»Ð¸Ð¿ÐµÐ½ÑŒ", "ÑÐµÑ€Ð¿ÐµÐ½ÑŒ", "Ð²ÐµÑ€ÐµÑÐµÐ½ÑŒ", "Ð¶Ð¾Ð²Ñ‚ÐµÐ½ÑŒ", "Ð»Ð¸ÑÑ‚Ð¾Ð¿Ð°Ð´", "Ð³Ñ€ÑƒÐ´ÐµÐ½ÑŒ"],
        full: ["ÑÑ–Ñ‡ÐµÐ½ÑŒ", "Ð»ÑŽÑ‚Ð¸Ð¹", "Ð±ÐµÑ€ÐµÐ·ÐµÐ½ÑŒ", "ÐºÐ²Ñ–Ñ‚ÐµÐ½ÑŒ", "Ñ‚Ñ€Ð°Ð²ÐµÐ½ÑŒ", "Ñ‡ÐµÑ€Ð²ÐµÐ½ÑŒ", "Ð»Ð¸Ð¿ÐµÐ½ÑŒ", "ÑÐµÑ€Ð¿ÐµÐ½ÑŒ", "Ð²ÐµÑ€ÐµÑÐµÐ½ÑŒ", "Ð¶Ð¾Ð²Ñ‚ÐµÐ½ÑŒ", "Ð»Ð¸ÑÑ‚Ð¾Ð¿Ð°Ð´", "Ð³Ñ€ÑƒÐ´ÐµÐ½ÑŒ"]
      },
      weekdays: {
        short: ["Ð½", "Ð¿", "Ð²", "Ñ", "Ñ‡", "Ð¿", "Ñ"],
        full: ["Ð½ÐµÐ´Ñ–Ð»Ñ", "Ð¿Ð¾Ð½ÐµÐ´Ñ–Ð»Ð¾Ðº", "Ð²Ñ–Ð²Ñ‚Ð¾Ñ€Ð¾Ðº", "ÑÐµÑ€ÐµÐ´Ð°", "Ñ‡ÐµÑ‚Ð²ÐµÑ€", "Ð¿'ÑÑ‚Ð½Ð¸Ñ†Ñ", "ÑÑƒÐ±Ð¾Ñ‚Ð°"]
      }
    },
    ru: {
      name: "Ñ€ÑƒÑÑÐºÐ¸Ð¹ ÑÐ·Ñ‹Ðº",
      gregorian: !0,
      months: {
        short: ["ÑÐ½Ð²Ð°Ñ€ÑŒ", "Ñ„ÐµÐ²Ñ€Ð°Ð»ÑŒ", "Ð¼Ð°Ñ€Ñ‚", "Ð°Ð¿Ñ€ÐµÐ»ÑŒ", "Ð¼Ð°Ð¹", "Ð¸ÑŽÐ½ÑŒ", "Ð¸ÑŽÐ»ÑŒ", "Ð°Ð²Ð³ÑƒÑÑ‚", "ÑÐµÐ½Ñ‚ÑÐ±Ñ€ÑŒ", "Ð¾ÐºÑ‚ÑÐ±Ñ€ÑŒ", "Ð½Ð¾ÑÐ±Ñ€ÑŒ", "Ð´ÐµÐºÐ°Ð±Ñ€ÑŒ"],
        full: ["ÑÐ½Ð²Ð°Ñ€ÑŒ", "Ñ„ÐµÐ²Ñ€Ð°Ð»ÑŒ", "Ð¼Ð°Ñ€Ñ‚", "Ð°Ð¿Ñ€ÐµÐ»ÑŒ", "Ð¼Ð°Ð¹", "Ð¸ÑŽÐ½ÑŒ", "Ð¸ÑŽÐ»ÑŒ", "Ð°Ð²Ð³ÑƒÑÑ‚", "ÑÐµÐ½Ñ‚ÑÐ±Ñ€ÑŒ", "Ð¾ÐºÑ‚ÑÐ±Ñ€ÑŒ", "Ð½Ð¾ÑÐ±Ñ€ÑŒ", "Ð´ÐµÐºÐ°Ð±Ñ€ÑŒ"]
      },
      weekdays: {
        short: ["Ð²", "Ð¿", "Ð²", "Ñ", "Ñ‡", "Ð¿", "Ñ"],
        full: ["Ð²Ð¾ÑÐºÑ€ÐµÑÐµÐ½ÑŒÐµ", "Ð¿Ð¾Ð½ÐµÐ´ÐµÐ»ÑŒÐ½Ð¸Ðº", "Ð²Ñ‚Ð¾Ñ€Ð½Ð¸Ðº", "ÑÑ€ÐµÐ´Ð°", "Ñ‡ÐµÑ‚Ð²ÐµÑ€Ð³", "Ð¿ÑÑ‚Ð½Ð¸Ñ†Ð°", "ÑÑƒÐ±Ð±Ð¾Ñ‚Ð°"]
      }
    },
    tr: {
      name: "TÃ¼rkÃ§e",
      gregorian: !0,
      months: {
        short: ["Oca", "Åžub", "Mar", "Nis", "May", "Haz", "Tem", "AÄŸu", "Eyl", "Eki", "Kas", "Ara"],
        full: ["Ocak", "Åžubat", "Mart", "Nisan", "MayÄ±s", "Haziran", "Temmuz", "AÄŸustos", "EylÃ¼l", "Ekim", "KasÄ±m", "AralÄ±k"]
      },
      weekdays: {
        short: ["P", "P", "S", "Ã‡", "P", "C", "C"],
        full: ["Pazar", "Pazartesi", "Sali", "Ã‡arÅŸamba", "PerÅŸembe", "Cuma", "Cumartesi"]
      }
    },
    ko: {
      name: "ì¡°ì„ ë§",
      gregorian: !0,
      months: {
        short: ["1ì›”", "2ì›”", "3ì›”", "4ì›”", "5ì›”", "6ì›”", "7ì›”", "8ì›”", "9ì›”", "10ì›”", "11ì›”", "12ì›”"],
        full: ["1ì›”", "2ì›”", "3ì›”", "4ì›”", "5ì›”", "6ì›”", "7ì›”", "8ì›”", "9ì›”", "10ì›”", "11ì›”", "12ì›”"]
      },
      weekdays: {
        short: ["ì¼", "ì›”", "í™”", "ìˆ˜", "ëª©", "ê¸ˆ", "í† "],
        full: ["ì¼ìš”ì¼", "ì›”ìš”ì¼", "í™”ìš”ì¼", "ìˆ˜ìš”ì¼", "ëª©ìš”ì¼", "ê¸ˆìš”ì¼", "í† ìš”ì¼"]
      }
    },
    fi: {
      name: "suomen kieli",
      gregorian: !0,
      months: {
        short: ["Tam", "Hel", "Maa", "Huh", "Tou", "Kes", "Hei", "Elo", "Syy", "Lok", "Mar", "Jou"],
        full: ["Tammikuu", "Helmikuu", "Maaliskuu", "Huhtikuu", "Toukokuu", "KesÃ¤kuu", "HeinÃ¤kuu", "Elokuu", "Syyskuu", "Lokakuu", "Marraskuu", "Joulukuu"]
      },
      weekdays: {
        short: ["S", "M", "T", "K", "T", "P", "L"],
        full: ["Sunnuntai", "Maanantai", "Tiistai", "Keskiviikko", "Torstai", "Perjantai", "Lauantai"]
      }
    },
    vi: {
      name: "Tiáº¿ng viá»‡t",
      gregorian: !1,
      months: {
        short: ["Th.01", "Th.02", "Th.03", "Th.04", "Th.05", "Th.06", "Th.07", "Th.08", "Th.09", "Th.10", "Th.11", "Th.12"],
        full: ["ThÃ¡ng 01", "ThÃ¡ng 02", "ThÃ¡ng 03", "ThÃ¡ng 04", "ThÃ¡ng 05", "ThÃ¡ng 06", "ThÃ¡ng 07", "ThÃ¡ng 08", "ThÃ¡ng 09", "ThÃ¡ng 10", "ThÃ¡ng 11", "ThÃ¡ng 12"]
      },
      weekdays: {
        short: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
        full: ["Chá»§ nháº­t", "Thá»© hai", "Thá»© ba", "Thá»© tÆ°", "Thá»© nÄƒm", "Thá»© sÃ¡u", "Thá»© báº£y"]
      }
    }
  }, n = {}, r = null, l = !1, s = null, d = null, u = null, c = !1, k = function () {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? !0 : !1
  }, p = function () {
    r && n[r.id].fx && !n[r.id].fxmobile && (e(window).width() < 480 ? r.element.removeClass("picker-fxs") : r.element.addClass("picker-fxs"))
  }, m = function () {
    return n[r.id].jump >= n[r.id].key.y.max - n[r.id].key.y.min ? !1 : !0
  }, g = function () {
    var e = A(w()), a = A(v());
    if (n[r.id].lock) {
      if ("from" == n[r.id].lock) return a > e ? (Q(), r.element.addClass("picker-lkd"), !0) : (r.element.removeClass("picker-lkd"), !1);
      if ("to" == n[r.id].lock) return e > a ? (Q(), r.element.addClass("picker-lkd"), !0) : (r.element.removeClass("picker-lkd"), !1)
    }
    return n[r.id].disabledays ? -1 != n[r.id].disabledays.indexOf(e) ? (Q(), r.element.addClass("picker-lkd"), !0) : (r.element.removeClass("picker-lkd"), !1) : void 0
  }, h = function (e) {
    return e % 1 === 0
  }, f = function (e) {
    var a = /(^\d{1,4}[\.|\\/|-]\d{1,2}[\.|\\/|-]\d{1,4})(\s*(?:0?[1-9]:[0-5]|1(?=[012])\d:[0-5])\d\s*[ap]m)?$/;
    return a.test(e)
  }, y = function (e) {
    return parseInt(n[r.id].key[e].current)
  }, b = function (e) {
    return parseInt(n[r.id].key[e].today)
  }, v = function () {
    return b("m") + "/" + b("d") + "/" + b("y")
  }, w = function () {
    return y("m") + "/" + y("d") + "/" + y("y")
  }, T = function (e, a) {
    for (var i = [], t = n[r.id].key[e], l = t.min; l <= t.max; l++) l % a == 0 && i.push(l);
    return i
  }, M = function (e, a) {
    for (var i = a[0], t = Math.abs(e - i), n = 0; n < a.length; n++) {
      var r = Math.abs(e - a[n]);
      t > r && (t = r, i = a[n])
    }
    return i
  }, C = function (e, a) {
    var i = n[r.id].key[e];
    return a > i.max ? C(e, a - i.max + (i.min - 1)) : a < i.min ? C(e, a + 1 + (i.max - i.min)) : a
  }, j = function () {
    return t[n[r.id].lang].gregorian ? [1, 2, 3, 4, 5, 6, 0] : [0, 1, 2, 3, 4, 5, 6]
  }, D = function (e) {
    return z('ul.pick[data-k="' + e + '"]')
  }, S = function (a, i) {
    ul = D(a);
    var t = [];
    return ul.find("li").each(function () {
      t.push(e(this).attr("value"))
    }), "last" == i ? t[t.length - 1] : t[0]
  }, z = function (e) {
    return r ? r.element.find(e) : void 0
  }, A = function (e) {
    return Date.parse(e) / 1e3
  }, x = function () {
    n[r.id].large && (r.element.toggleClass("picker-lg"), Y())
  }, J = function () {
    z("ul.pick.pick-l").toggleClass("visible")
  }, F = function () {
    if (!r.element.hasClass("picker-modal")) {
      var e = r.input, a = e.offset().left + e.outerWidth() / 2, i = e.offset().top + e.outerHeight();
      r.element.css({left: a, top: i})
    }
  }, O = function (e) {
    n[r.id].lang = Object.keys(t)[e], E(), G()
  }, E = function () {
    var a = j();
    z(".pick-lg .pick-lg-h li").each(function (i) {
      e(this).html(t[n[r.id].lang].weekdays.short[a[i]])
    }), z("ul.pick.pick-m li").each(function () {
      e(this).html(t[n[r.id].lang].months.short[e(this).attr("value") - 1])
    })
  }, N = function () {
    r.element.addClass("picker-focus")
  }, L = function () {
    g() || (r.element.removeClass("picker-focus"), r.element.hasClass("picker-modal") && e(".picker-modal-overlay").addClass("tohide"), r = null), l = !1
  }, P = function (a) {
    var l = D(a), o = n[r.id].key[a];
    for (n[r.id].key[a].current = o.today < o.min && o.min || o.today, i = o.min; i <= o.max; i++) {
      var s = i;
      "m" == a && (s = t[n[r.id].lang].months.short[i - 1]), "l" == a && (s = t[Object.keys(t)[i]].name), s += "d" == a ? "<span></span>" : "", e("<li>", {
        value: i,
        html: s
      }).appendTo(l)
    }
    e("<div>", {
      class: "pick-arw pick-arw-s1 pick-arw-l",
      html: e("<i>", {class: "pick-i-l"})
    }).appendTo(l), e("<div>", {
      class: "pick-arw pick-arw-s1 pick-arw-r",
      html: e("<i>", {class: "pick-i-r"})
    }).appendTo(l), "y" == a && (e("<div>", {
      class: "pick-arw pick-arw-s2 pick-arw-l",
      html: e("<i>", {class: "pick-i-l"})
    }).appendTo(l), e("<div>", {
      class: "pick-arw pick-arw-s2 pick-arw-r",
      html: e("<i>", {class: "pick-i-r"})
    }).appendTo(l)), K(a, y(a))
  }, Y = function () {
    var a = 0, i = z(".pick-lg-b");
    i.find("li").empty().removeClass("pick-n pick-b pick-a pick-v pick-lk pick-sl pick-h").attr("data-value", "");
    var l = (new Date(w()), new Date(w())), o = new Date(w()), s = function (e) {
      var a = e.getMonth(), i = e.getFullYear(), t = i % 4 == 0 && (i % 100 != 0 || i % 400 == 0);
      return [31, t ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][a]
    };
    o.setMonth(o.getMonth() - 1), l.setDate(1);
    var d = l.getDay() - 1;
    0 > d && (d = 6), t[n[r.id].lang].gregorian && (d--, 0 > d && (d = 6));
    for (var u = s(o) - d; u <= s(o); u++) i.find("li").eq(a).html(u).addClass("pick-b pick-n pick-h"), a++;
    for (var u = 1; u <= s(l); u++) i.find("li").eq(a).html(u).addClass("pick-n pick-v").attr("data-value", u), a++;
    if (i.find("li.pick-n").length < 42) for (var c = 42 - i.find("li.pick-n").length, u = 1; c >= u; u++) i.find("li").eq(a).html(u).addClass("pick-a pick-n pick-h"), a++;
    n[r.id].lock && ("from" === n[r.id].lock ? y("y") <= b("y") && (y("m") == b("m") ? z('.pick-lg .pick-lg-b li.pick-v[data-value="' + b("d") + '"]').prevAll("li").addClass("pick-lk") : y("m") < b("m") ? z(".pick-lg .pick-lg-b li").addClass("pick-lk") : y("m") > b("m") && y("y") < b("y") && z(".pick-lg .pick-lg-b li").addClass("pick-lk")) : y("y") >= b("y") && (y("m") == b("m") ? z('.pick-lg .pick-lg-b li.pick-v[data-value="' + b("d") + '"]').nextAll("li").addClass("pick-lk") : y("m") > b("m") ? z(".pick-lg .pick-lg-b li").addClass("pick-lk") : y("m") < b("m") && y("y") > b("y") && z(".pick-lg .pick-lg-b li").addClass("pick-lk"))), n[r.id].disabledays && e.each(n[r.id].disabledays, function (e, a) {
      if (a && f(a)) {
        var i = new Date(1e3 * a);
        i.getMonth() + 1 == y("m") && i.getFullYear() == y("y") && z('.pick-lg .pick-lg-b li.pick-v[data-value="' + i.getDate() + '"]').addClass("pick-lk")
      }
    }), z(".pick-lg-b li.pick-v[data-value=" + y("d") + "]").addClass("pick-sl")
  }, H = function () {
    var a = y("m"), i = y("y"), l = i % 4 == 0 && (i % 100 != 0 || i % 400 == 0);
    n[r.id].key.d.max = [31, l ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][a - 1], y("d") > n[r.id].key.d.max && (n[r.id].key.d.current = n[r.id].key.d.max, K("d", y("d"))), z(".pick-d li").removeClass("pick-wke").each(function () {
      var l = new Date(a + "/" + e(this).attr("value") + "/" + i).getDay();
      e(this).find("span").html(t[n[r.id].lang].weekdays.full[l]), (0 == l || 6 == l) && e(this).addClass("pick-wke")
    }), r.element.hasClass("picker-lg") && (z(".pick-lg-b li").removeClass("pick-wke"), z(".pick-lg-b li.pick-v").each(function () {
      var t = new Date(a + "/" + e(this).attr("data-value") + "/" + i).getDay();
      (0 == t || 6 == t) && e(this).addClass("pick-wke")
    }))
  }, G = function () {
    r.element.hasClass("picker-lg") && Y(), H(), q()
  }, K = function (e, a) {
    var i = D(e);
    if (i.find("li").removeClass("pick-sl pick-bfr pick-afr"), a == S(e, "last")) {
      var t = i.find('li[value="' + S(e, "first") + '"]');
      t.clone().insertAfter(i.find("li[value=" + a + "]")), t.remove()
    }
    if (a == S(e, "first")) {
      var t = i.find('li[value="' + S(e, "last") + '"]');
      t.clone().insertBefore(i.find("li[value=" + a + "]")), t.remove()
    }
    i.find("li[value=" + a + "]").addClass("pick-sl"), i.find("li.pick-sl").nextAll("li").addClass("pick-afr"), i.find("li.pick-sl").prevAll("li").addClass("pick-bfr")
  }, V = function (e, a) {
    var i = n[r.id].key[e];
    a > i.max && ("d" == e && I("m", "right"), "m" == e && I("y", "right"), a = i.min), a < i.min && ("d" == e && I("m", "left"), "m" == e && I("y", "left"), a = i.max), n[r.id].key[e].current = a, K(e, a)
  }, I = function (e, a) {
    var i = y(e);
    "right" == a ? i++ : i--, V(e, i)
  }, Q = function () {
    r.element.addClass("picker-rmbl")
  }, W = function (e) {
    return 10 > e ? "0" + e : e
  }, B = function (e) {
    var a = ["th", "st", "nd", "rd"], i = e % 100;
    return e + (a[(i - 20) % 10] || a[i] || a[0])
  }, q = function () {
    if (!g() && l) {
      var e = y("d"), a = y("m"), i = y("y"), o = new Date(a + "/" + e + "/" + i).getDay(),
        s = n[r.id].format.replace(/\b(d)\b/g, W(e)).replace(/\b(m)\b/g, W(a)).replace(/\b(S)\b/g, B(e)).replace(/\b(Y)\b/g, i).replace(/\b(U)\b/g, A(w())).replace(/\b(D)\b/g, t[n[r.id].lang].weekdays.short[o]).replace(/\b(l)\b/g, t[n[r.id].lang].weekdays.full[o]).replace(/\b(F)\b/g, t[n[r.id].lang].months.full[a - 1]).replace(/\b(M)\b/g, t[n[r.id].lang].months.short[a - 1]).replace(/\b(n)\b/g, a).replace(/\b(j)\b/g, e);
      r.input.val(s).change(), l = !1
    }
  };
  if (k()) var U = {i: "touchstart", m: "touchmove", e: "touchend"}; else var U = {
    i: "mousedown",
    m: "mousemove",
    e: "mouseup"
  };
  var X = "div.datedropper.picker-focus";
  e(document).on("click", function (e) {
    r && (r.input.is(e.target) || r.element.is(e.target) || 0 !== r.element.has(e.target).length || (L(), s = null))
  }).on(a.a, X + ".picker-rmbl", function () {
    r.element.hasClass("picker-rmbl") && e(this).removeClass("picker-rmbl")
  }).on(a.t, ".picker-modal-overlay", function () {
    e(this).remove()
  }).on(U.i, X + " .pick-lg li.pick-v", function () {
    z(".pick-lg-b li").removeClass("pick-sl"), e(this).addClass("pick-sl"), n[r.id].key.d.current = e(this).attr("data-value"), K("d", e(this).attr("data-value")), l = !0
  }).on("click", X + " .pick-btn-sz", function () {
    x()
  }).on("click", X + " .pick-btn-lng", function () {
    J()
  }).on(U.i, X + " .pick-arw.pick-arw-s2", function (a) {
    a.preventDefault(), s = null;
    var i, t = (e(this).closest("ul").data("k"), n[r.id].jump);
    i = e(this).hasClass("pick-arw-r") ? y("y") + t : y("y") - t;
    var o = T("y", t);
    i > o[o.length - 1] && (i = o[0]), i < o[0] && (i = o[o.length - 1]), n[r.id].key.y.current = i, K("y", y("y")), l = !0
  }).on(U.i, X + " .pick-arw.pick-arw-s1", function (a) {
    a.preventDefault(), s = null;
    var i = e(this).closest("ul").data("k");
    e(this).hasClass("pick-arw-r") ? I(i, "right") : I(i, "left"), l = !0
  }).on(U.i, X + " ul.pick.pick-y li", function () {
    c = !0
  }).on(U.e, X + " ul.pick.pick-y li", function () {
    if (c && m()) {
      e(this).closest("ul").toggleClass("pick-jump");
      var a = M(y("y"), T("y", n[r.id].jump));
      n[r.id].key.y.current = a, K("y", y("y")), c = !1
    }
  }).on(U.i, X + " ul.pick.pick-d li", function () {
    c = !0
  }).on(U.e, X + " ul.pick.pick-d li", function () {
    c && (x(), c = !1)
  }).on(U.i, X + " ul.pick.pick-l li", function () {
    c = !0
  }).on(U.e, X + " ul.pick.pick-l li", function () {
    c && (J(), O(e(this).val()), c = !1)
  }).on(U.i, X + " ul.pick", function (a) {
    if (s = e(this)) {
      var i = s.data("k");
      d = k() ? a.originalEvent.touches[0].pageY : a.pageY, u = y(i)
    }
  }).on(U.m, function (e) {
    if (c = !1, s) {
      e.preventDefault();
      var a = s.data("k");
      o = k() ? e.originalEvent.touches[0].pageY : e.pageY, o = d - o, o = Math.round(.026 * o), i = u + o;
      var t = C(a, i);
      t != n[r.id].key[a].current && V(a, t), l = !0
    }
  }).on(U.e, function () {
    s && (s = null, d = null, u = null), r && G()
  }).on(U.i, X + " .pick-submit", function () {
    L()
  }), e(window).resize(function () {
    r && (F(), p())
  }), e.fn.dateDropper = function () {
    return e(this).each(function () {
      if (e(this).is("input") && !e(this).hasClass("picker-input")) {
        var a = e(this), i = "datedropper-" + Object.keys(n).length;
        a.attr("data-id", i).addClass("picker-input").prop({type: "text", readonly: !0});
        var o = a.data("default-date") && f(a.data("default-date")) ? a.data("default-date") : null,
          s = a.data("disabled-days") ? a.data("disabled-days").split(",") : null, d = a.data("format") || "m/d/Y",
          u = a.data("fx") === !1 ? a.data("fx") : !0, c = a.data("fx") === !1 ? "" : "picker-fxs",
          k = a.data("fx-mobile") === !1 ? a.data("fx-mobile") : !0, p = a.data("init-set") === !1 ? !1 : !0,
          m = a.data("lang") && a.data("lang") in t ? a.data("lang") : "en", g = a.data("large-mode") === !0 ? !0 : !1,
          y = a.data("large-default") === !0 && g === !0 ? "picker-lg" : "",
          b = "from" == a.data("lock") || "to" == a.data("lock") ? a.data("lock") : !1,
          v = a.data("jump") && h(a.data("jump")) ? a.data("jump") : 10,
          w = a.data("max-year") && h(a.data("max-year")) ? a.data("max-year") : (new Date).getFullYear(),
          T = a.data("min-year") && h(a.data("min-year")) ? a.data("min-year") : 1970,
          M = a.data("modal") === !0 ? "picker-modal" : "", C = a.data("theme") || "primary",
          D = a.data("translate-mode") === !0 ? !0 : !1;
        if (s && e.each(s, function (e, a) {
          a && f(a) && (s[e] = A(a))
        }), n[i] = {
          disabledays: s,
          format: d,
          fx: u,
          fxmobile: k,
          lang: m,
          large: g,
          lock: b,
          jump: v,
          key: {
            m: {min: 1, max: 12, current: 1, today: (new Date).getMonth() + 1},
            d: {min: 1, max: 31, current: 1, today: (new Date).getDate()},
            y: {min: T, max: w, current: T, today: (new Date).getFullYear()},
            l: {min: 0, max: Object.keys(t).length - 1, current: 0, today: 0}
          },
          translate: D
        }, o) {
          var S = /\d+/g, x = o, J = x.match(S);
          e.each(J, function (e, a) {
            J[e] = parseInt(a)
          }), n[i].key.m.today = J[0] && J[0] <= 12 ? J[0] : n[i].key.m.today, n[i].key.d.today = J[1] && J[1] <= 31 ? J[1] : n[i].key.d.today, n[i].key.y.today = J[2] ? J[2] : n[i].key.y.today, n[i].key.y.today > n[i].key.y.max && (n[i].key.y.max = n[i].key.y.today), n[i].key.y.today < n[i].key.y.min && (n[i].key.y.min = n[i].key.y.today)
        }
        e("<div>", {
          class: "datedropper " + M + " " + C + " " + c + " " + y,
          id: i,
          html: e("<div>", {class: "picker"})
        }).appendTo("body"), r = {id: i, input: a, element: e("#" + i)};
        for (var F in n[i].key) e("<ul>", {class: "pick pick-" + F, "data-k": F}).appendTo(z(".picker")), P(F);
        if (n[i].large) {
          e("<div>", {class: "pick-lg"}).insertBefore(z(".pick-d")), e('<ul class="pick-lg-h"></ul><ul class="pick-lg-b"></ul>').appendTo(z(".pick-lg"));
          for (var O = j(), E = 0; 7 > E; E++) e("<li>", {html: t[n[r.id].lang].weekdays.short[O[E]]}).appendTo(z(".pick-lg .pick-lg-h"));
          for (var E = 0; 42 > E; E++) e("<li>").appendTo(z(".pick-lg .pick-lg-b"))
        }
        e("<div>", {class: "pick-btns"}).appendTo(z(".picker")), e("<div>", {class: "pick-submit"}).appendTo(z(".pick-btns")), n[r.id].translate && e("<div>", {class: "pick-btn pick-btn-lng"}).appendTo(z(".pick-btns")), n[r.id].large && e("<div>", {class: "pick-btn pick-btn-sz"}).appendTo(z(".pick-btns")), ("Y" == d || "m" == d) && (z(".pick-d,.pick-btn-sz").hide(), r.element.addClass("picker-tiny"), "Y" == d && z(".pick-m,.pick-btn-lng").hide(), "m" == d && z(".pick-y").hide()), p && (l = !0, q()), r = null
      }
    }).focus(function (a) {
      a.preventDefault(), e(this).blur(), r && L(), r = {
        id: e(this).data("id"),
        input: e(this),
        element: e("#" + e(this).data("id"))
      }, p(), F(), G(), N(), r.element.hasClass("picker-modal") && e("body").append('<div class="picker-modal-overlay"></div>')
    })
  }
}(jQuery);
"use strict";
var _createClass = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor)
    }
  }

  return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);
    if (staticProps) defineProperties(Constructor, staticProps);
    return Constructor
  }
}();

function _possibleConstructorReturn(self, call) {
  if (!self) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called")
  }
  return call && (typeof call === "object" || typeof call === "function") ? call : self
}

function _inherits(subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function, not " + typeof superClass)
  }
  subClass.prototype = Object.create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      enumerable: false,
      writable: true,
      configurable: true
    }
  });
  if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass
}

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function")
  }
}

var Emitter = function () {
  function Emitter() {
    _classCallCheck(this, Emitter)
  }

  _createClass(Emitter, [{
    key: "on", value: function on(event, fn) {
      this._callbacks = this._callbacks || {};
      if (!this._callbacks[event]) {
        this._callbacks[event] = []
      }
      this._callbacks[event].push(fn);
      return this
    }
  }, {
    key: "emit", value: function emit(event) {
      this._callbacks = this._callbacks || {};
      var callbacks = this._callbacks[event];
      if (callbacks) {
        for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
          args[_key - 1] = arguments[_key]
        }
        for (var _iterator = callbacks, _isArray = true, _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator](); ;) {
          var _ref;
          if (_isArray) {
            if (_i >= _iterator.length) break;
            _ref = _iterator[_i++]
          } else {
            _i = _iterator.next();
            if (_i.done) break;
            _ref = _i.value
          }
          var callback = _ref;
          callback.apply(this, args)
        }
      }
      return this
    }
  }, {
    key: "off", value: function off(event, fn) {
      if (!this._callbacks || arguments.length === 0) {
        this._callbacks = {};
        return this
      }
      var callbacks = this._callbacks[event];
      if (!callbacks) {
        return this
      }
      if (arguments.length === 1) {
        delete this._callbacks[event];
        return this
      }
      for (var i = 0; i < callbacks.length; i++) {
        var callback = callbacks[i];
        if (callback === fn) {
          callbacks.splice(i, 1);
          break
        }
      }
      return this
    }
  }]);
  return Emitter
}();

function __guard__(value, transform) {
  return typeof value !== "undefined" && value !== null ? transform(value) : undefined
}

function __guardMethod__(obj, methodName, transform) {
  if (typeof obj !== "undefined" && obj !== null && typeof obj[methodName] === "function") {
    return transform(obj, methodName)
  } else {
    return undefined
  }
}

var $jscomp = {
  scope: {}, findInternal: function (a, l, d) {
    a instanceof String && (a = String(a));
    for (var p = a.length, h = 0; h < p; h++) {
      var b = a[h];
      if (l.call(d, b, h, a)) return {i: h, v: b}
    }
    return {i: -1, v: void 0}
  }
};
$jscomp.defineProperty = "function" == typeof Object.defineProperties ? Object.defineProperty : function (a, l, d) {
  if (d.get || d.set) throw new TypeError("ES3 does not support getters and setters.");
  a != Array.prototype && a != Object.prototype && (a[l] = d.value)
};
$jscomp.getGlobal = function (a) {
  return "undefined" != typeof window && window === a ? a : "undefined" != typeof global && null != global ? global : a
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function (a, l, d, p) {
  if (l) {
    d = $jscomp.global;
    a = a.split(".");
    for (p = 0; p < a.length - 1; p++) {
      var h = a[p];
      h in d || (d[h] = {});
      d = d[h]
    }
    a = a[a.length - 1];
    p = d[a];
    l = l(p);
    l != p && null != l && $jscomp.defineProperty(d, a, {configurable: !0, writable: !0, value: l})
  }
};
$jscomp.polyfill("Array.prototype.find", function (a) {
  return a ? a : function (a, d) {
    return $jscomp.findInternal(this, a, d).v
  }
}, "es6-impl", "es3");
(function (a, l, d) {
  "function" === typeof define && define.amd ? define(["jquery"], a) : "object" === typeof exports ? module.exports = a(require("jquery")) : a(l || d)
})(function (a) {
  var l = function (b, e, f) {
    var c = {
      invalid: [], getCaret: function () {
        try {
          var a, r = 0, g = b.get(0), e = document.selection, f = g.selectionStart;
          if (e && -1 === navigator.appVersion.indexOf("MSIE 10")) a = e.createRange(), a.moveStart("character", -c.val().length), r = a.text.length; else if (f || "0" === f) r = f;
          return r
        } catch (C) {
        }
      }, setCaret: function (a) {
        try {
          if (b.is(":focus")) {
            var c, g = b.get(0);
            g.setSelectionRange ? g.setSelectionRange(a, a) : (c = g.createTextRange(), c.collapse(!0), c.moveEnd("character", a), c.moveStart("character", a), c.select())
          }
        } catch (B) {
        }
      }, events: function () {
        b.on("keydown.mask", function (a) {
          b.data("mask-keycode", a.keyCode || a.which);
          b.data("mask-previus-value", b.val());
          b.data("mask-previus-caret-pos", c.getCaret());
          c.maskDigitPosMapOld = c.maskDigitPosMap
        }).on(a.jMaskGlobals.useInput ? "input.mask" : "keyup.mask", c.behaviour).on("paste.mask drop.mask", function () {
          setTimeout(function () {
            b.keydown().keyup()
          }, 100)
        }).on("change.mask", function () {
          b.data("changed", !0)
        }).on("blur.mask", function () {
          d === c.val() || b.data("changed") || b.trigger("change");
          b.data("changed", !1)
        }).on("blur.mask", function () {
          d = c.val()
        }).on("focus.mask", function (b) {
          !0 === f.selectOnFocus && a(b.target).select()
        }).on("focusout.mask", function () {
          f.clearIfNotMatch && !h.test(c.val()) && c.val("")
        })
      }, getRegexMask: function () {
        for (var a = [], b, c, f, n, d = 0; d < e.length; d++) (b = m.translation[e.charAt(d)]) ? (c = b.pattern.toString().replace(/.{1}$|^.{1}/g, ""), f = b.optional, (b = b.recursive) ? (a.push(e.charAt(d)), n = {
          digit: e.charAt(d),
          pattern: c
        }) : a.push(f || b ? c + "?" : c)) : a.push(e.charAt(d).replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&"));
        a = a.join("");
        n && (a = a.replace(new RegExp("(" + n.digit + "(.*" + n.digit + ")?)"), "($1)?").replace(new RegExp(n.digit, "g"), n.pattern));
        return new RegExp(a)
      }, destroyEvents: function () {
        b.off("input keydown keyup paste drop blur focusout ".split(" ").join(".mask "))
      }, val: function (a) {
        var c = b.is("input") ? "val" : "text";
        if (0 < arguments.length) {
          if (b[c]() !== a) b[c](a);
          c = b
        } else c = b[c]();
        return c
      }, calculateCaretPosition: function () {
        var a = b.data("mask-previus-value") || "", e = c.getMasked(), g = c.getCaret();
        if (a !== e) {
          var f = b.data("mask-previus-caret-pos") || 0, e = e.length, d = a.length, m = a = 0, h = 0, l = 0, k;
          for (k = g; k < e && c.maskDigitPosMap[k]; k++) m++;
          for (k = g - 1; 0 <= k && c.maskDigitPosMap[k]; k--) a++;
          for (k = g - 1; 0 <= k; k--) c.maskDigitPosMap[k] && h++;
          for (k = f - 1; 0 <= k; k--) c.maskDigitPosMapOld[k] && l++;
          g > d ? g = 10 * e : f >= g && f !== d ? c.maskDigitPosMapOld[g] || (f = g, g = g - (l - h) - a, c.maskDigitPosMap[g] && (g = f)) : g > f && (g = g + (h - l) + m)
        }
        return g
      }, behaviour: function (f) {
        f = f || window.event;
        c.invalid = [];
        var e = b.data("mask-keycode");
        if (-1 === a.inArray(e, m.byPassKeys)) {
          var e = c.getMasked(), g = c.getCaret();
          setTimeout(function () {
            c.setCaret(c.calculateCaretPosition())
          }, 10);
          c.val(e);
          c.setCaret(g);
          return c.callbacks(f)
        }
      }, getMasked: function (a, b) {
        var g = [], d = void 0 === b ? c.val() : b + "", n = 0, h = e.length, q = 0, l = d.length, k = 1, r = "push",
          p = -1, t = 0, y = [], v, z;
        f.reverse ? (r = "unshift", k = -1, v = 0, n = h - 1, q = l - 1, z = function () {
          return -1 < n && -1 < q
        }) : (v = h - 1, z = function () {
          return n < h && q < l
        });
        for (var A; z();) {
          var x = e.charAt(n), w = d.charAt(q), u = m.translation[x];
          if (u) w.match(u.pattern) ? (g[r](w), u.recursive && (-1 === p ? p = n : n === v && n !== p && (n = p - k), v === p && (n -= k)), n += k) : w === A ? (t--, A = void 0) : u.optional ? (n += k, q -= k) : u.fallback ? (g[r](u.fallback), n += k, q -= k) : c.invalid.push({
            p: q,
            v: w,
            e: u.pattern
          }), q += k; else {
            if (!a) g[r](x);
            w === x ? (y.push(q), q += k) : (A = x, y.push(q + t), t++);
            n += k
          }
        }
        d = e.charAt(v);
        h !== l + 1 || m.translation[d] || g.push(d);
        g = g.join("");
        c.mapMaskdigitPositions(g, y, l);
        return g
      }, mapMaskdigitPositions: function (a, b, e) {
        a = f.reverse ? a.length - e : 0;
        c.maskDigitPosMap = {};
        for (e = 0; e < b.length; e++) c.maskDigitPosMap[b[e] + a] = 1
      }, callbacks: function (a) {
        var h = c.val(), g = h !== d, m = [h, a, b, f], q = function (a, b, c) {
          "function" === typeof f[a] && b && f[a].apply(this, c)
        };
        q("onChange", !0 === g, m);
        q("onKeyPress", !0 === g, m);
        q("onComplete", h.length === e.length, m);
        q("onInvalid", 0 < c.invalid.length, [h, a, b, c.invalid, f])
      }
    };
    b = a(b);
    var m = this, d = c.val(), h;
    e = "function" === typeof e ? e(c.val(), void 0, b, f) : e;
    m.mask = e;
    m.options = f;
    m.remove = function () {
      var a = c.getCaret();
      c.destroyEvents();
      c.val(m.getCleanVal());
      c.setCaret(a);
      return b
    };
    m.getCleanVal = function () {
      return c.getMasked(!0)
    };
    m.getMaskedVal = function (a) {
      return c.getMasked(!1, a)
    };
    m.init = function (d) {
      d = d || !1;
      f = f || {};
      m.clearIfNotMatch = a.jMaskGlobals.clearIfNotMatch;
      m.byPassKeys = a.jMaskGlobals.byPassKeys;
      m.translation = a.extend({}, a.jMaskGlobals.translation, f.translation);
      m = a.extend(!0, {}, m, f);
      h = c.getRegexMask();
      if (d) c.events(), c.val(c.getMasked()); else {
        f.placeholder && b.attr("placeholder", f.placeholder);
        b.data("mask") && b.attr("autocomplete", "off");
        d = 0;
        for (var l = !0; d < e.length; d++) {
          var g = m.translation[e.charAt(d)];
          if (g && g.recursive) {
            l = !1;
            break
          }
        }
        l && b.attr("maxlength", e.length);
        c.destroyEvents();
        c.events();
        d = c.getCaret();
        c.val(c.getMasked());
        c.setCaret(d)
      }
    };
    m.init(!b.is("input"))
  };
  a.maskWatchers = {};
  var d = function () {
    var b = a(this), e = {}, f = b.attr("data-mask");
    b.attr("data-mask-reverse") && (e.reverse = !0);
    b.attr("data-mask-clearifnotmatch") && (e.clearIfNotMatch = !0);
    "true" === b.attr("data-mask-selectonfocus") && (e.selectOnFocus = !0);
    if (p(b, f, e)) return b.data("mask", new l(this, f, e))
  }, p = function (b, e, f) {
    f = f || {};
    var c = a(b).data("mask"), d = JSON.stringify;
    b = a(b).val() || a(b).text();
    try {
      return "function" === typeof e && (e = e(b)), "object" !== typeof c || d(c.options) !== d(f) || c.mask !== e
    } catch (t) {
    }
  }, h = function (a) {
    var b = document.createElement("div"), d;
    a = "on" + a;
    d = a in b;
    d || (b.setAttribute(a, "return;"), d = "function" === typeof b[a]);
    return d
  };
  a.fn.mask = function (b, d) {
    d = d || {};
    var e = this.selector, c = a.jMaskGlobals, h = c.watchInterval, c = d.watchInputs || c.watchInputs,
      t = function () {
        if (p(this, b, d)) return a(this).data("mask", new l(this, b, d))
      };
    a(this).each(t);
    e && "" !== e && c && (clearInterval(a.maskWatchers[e]), a.maskWatchers[e] = setInterval(function () {
      a(document).find(e).each(t)
    }, h));
    return this
  };
  a.fn.masked = function (a) {
    return this.data("mask").getMaskedVal(a)
  };
  a.fn.unmask = function () {
    clearInterval(a.maskWatchers[this.selector]);
    delete a.maskWatchers[this.selector];
    return this.each(function () {
      var b = a(this).data("mask");
      b && b.remove().removeData("mask")
    })
  };
  a.fn.cleanVal = function () {
    return this.data("mask").getCleanVal()
  };
  a.applyDataMask = function (b) {
    b = b || a.jMaskGlobals.maskElements;
    (b instanceof a ? b : a(b)).filter(a.jMaskGlobals.dataMaskAttr).each(d)
  };
  h = {
    maskElements: "input,td,span,div",
    dataMaskAttr: "*[data-mask]",
    dataMask: !0,
    watchInterval: 300,
    watchInputs: !0,
    useInput: !/Chrome\/[2-4][0-9]|SamsungBrowser/.test(window.navigator.userAgent) && h("input"),
    watchDataMask: !1,
    byPassKeys: [9, 16, 17, 18, 36, 37, 38, 39, 40, 91],
    translation: {
      0: {pattern: /\d/},
      9: {pattern: /\d/, optional: !0},
      "#": {pattern: /\d/, recursive: !0},
      A: {pattern: /[a-zA-Z0-9]/},
      S: {pattern: /[a-zA-Z]/}
    }
  };
  a.jMaskGlobals = a.jMaskGlobals || {};
  h = a.jMaskGlobals = a.extend(!0, {}, h, a.jMaskGlobals);
  h.dataMask && a.applyDataMask();
  setInterval(function () {
    a.jMaskGlobals.watchDataMask && a.applyDataMask()
  }, h.watchInterval)
}, window.jQuery, window.Zepto);
(function ($) {
  "use strict";
  $(".timepicker").timepicker({showInputs: false});
  $(".input-daterange-timepicker").daterangepicker({
    timePicker: true,
    singleDatePicker: true,
    locale: {format: "MM/DD/YYYY hh:mm A"}
  });
  $(".datedropper").dateDropper();
  $(".input-slider").slider({range: "min"});
  $(".input-rangeslider").slider({range: true, min: 0, max: 500, values: [75, 300]});

  function readFile(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader;
      reader.onload = function (e) {
        $(input).parents(".avatar-input").find(".avatar-img").attr("src", e.target.result)
      };
      reader.readAsDataURL(input.files[0])
    }
  }

  $(".avatar-file-picker").on("change", function () {
    readFile(this)
  })
})(window.jQuery);