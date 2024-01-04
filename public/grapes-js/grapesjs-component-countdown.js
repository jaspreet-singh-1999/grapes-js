/**
 * Skipped minification because the original files appears to be already minified.
 * Original file: /npm/grapesjs-component-countdown@1.0.2/dist/index.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
/*! grapesjs-component-countdown - 1.0.2 */
! function(n, t) { 'object' == typeof exports && 'object' == typeof module ? module.exports = t() : 'function' == typeof define && define.amd ? define([], t) : 'object' == typeof exports ? exports["grapesjs-component-countdown"] = t() : n["grapesjs-component-countdown"] = t() }('undefined' != typeof globalThis ? globalThis : 'undefined' != typeof window ? window : this, (() => (() => { "use strict"; var n = { d: (t, e) => { for (var o in e) n.o(e, o) && !n.o(t, o) && Object.defineProperty(t, o, { enumerable: !0, get: e[o] }) }, o: (n, t) => Object.prototype.hasOwnProperty.call(n, t), r: n => { 'undefined' != typeof Symbol && Symbol.toStringTag && Object.defineProperty(n, Symbol.toStringTag, { value: 'Module' }), Object.defineProperty(n, '__esModule', { value: !0 }) } },
        t = {};
    n.r(t), n.d(t, { default: () => o }); var e = void 0 && (void 0).__assign || function() { return e = Object.assign || function(n) { for (var t, e = 1, o = arguments.length; e < o; e++)
                for (var a in t = arguments[e]) Object.prototype.hasOwnProperty.call(t, a) && (n[a] = t[a]); return n }, e.apply(this, arguments) }; const o = function(n, t) { void 0 === t && (t = {}); var o = e({ id: 'countdown', label: 'Countdown', block: {}, props: {}, style: '', styleAdditional: '', startTime: '', endText: 'EXPIRED', dateInputType: 'date', labelDays: 'days', labelHours: 'hours', labelMinutes: 'minutes', labelSeconds: 'seconds', classPrefix: 'countdown' }, t),
            a = o.block,
            c = o.props,
            d = o.style,
            s = o.id,
            l = o.label,
            i = o.classPrefix;
        a && n.Blocks.add(s, e({ media: "<svg viewBox=\"0 0 24 24\">\n        <path fill=\"currentColor\" d=\"M12 20C16.4 20 20 16.4 20 12S16.4 4 12 4 4 7.6 4 12 7.6 20 12 20M12 2C17.5 2 22 6.5 22 12S17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2M17 11.5V13H11V7H12.5V11.5H17Z\" />\n      </svg>", label: l, category: 'Extra', select: !0, content: { type: s } }, a));
        n.Components.addType(s, { model: { defaults: e({ startfrom: o.startTime, classes: [i], endText: o.endText, droppable: !1, script: function(n) { var t = n.startfrom,
                            e = n.endText,
                            o = this,
                            a = new Date(t).getTime(),
                            c = o.querySelector('[data-js=countdown]'),
                            d = o.querySelector('[data-js=countdown-endtext]'),
                            s = o.querySelector('[data-js=countdown-day]'),
                            l = o.querySelector('[data-js=countdown-hour]'),
                            i = o.querySelector('[data-js=countdown-minute]'),
                            r = o.querySelector('[data-js=countdown-second]'),
                            u = o.__gjsCountdownInterval;
                        u && clearInterval(u); var p = window.__gjsCountdownIntervals || [],
                            v = [];
                        p.forEach((function(n) { n.isConnected || (clearInterval(n.__gjsCountdownInterval), v.push(n)) })), p.indexOf(o) < 0 && p.push(o), window.__gjsCountdownIntervals = p.filter((function(n) { return v.indexOf(n) < 0 })); var y = function(n, t, e, o) { s.innerHTML = "".concat(n < 10 ? '0' + n : n), l.innerHTML = "".concat(t < 10 ? '0' + t : t), i.innerHTML = "".concat(e < 10 ? '0' + e : e), r.innerHTML = "".concat(o < 10 ? '0' + o : o) },
                            f = function() { var n = (new Date).getTime(),
                                    t = a - n,
                                    s = Math.floor(t / 864e5),
                                    l = Math.floor(t % 864e5 / 36e5),
                                    i = Math.floor(t % 36e5 / 6e4),
                                    r = Math.floor(t % 6e4 / 1e3);
                                y(s, l, i, r), t < 0 && (clearInterval(o.__gjsCountdownInterval), d.innerHTML = e, c.style.display = 'none', d.style.display = '') };
                        a ? (o.__gjsCountdownInterval = setInterval(f, 1e3), d.style.display = 'none', c.style.display = '', f()) : y(0, 0, 0, 0) }, 'script-props': ['startfrom', 'endText'], traits: [{ label: 'Start', name: 'startfrom', changeProp: !0, type: o.dateInputType }, { label: 'End text', name: 'endText', changeProp: !0 }], components: "\n          <span data-js=\"countdown\" class=\"".concat(i, "-cont\">\n            <div class=\"").concat(i, "-block\">\n              <div data-js=\"countdown-day\" class=\"").concat(i, "-digit\"></div>\n              <div class=\"").concat(i, "-label\">").concat(o.labelDays, "</div>\n            </div>\n            <div class=\"").concat(i, "-block\">\n              <div data-js=\"countdown-hour\" class=\"").concat(i, "-digit\"></div>\n              <div class=\"").concat(i, "-label\">").concat(o.labelHours, "</div>\n            </div>\n            <div class=\"").concat(i, "-block\">\n              <div data-js=\"countdown-minute\" class=\"").concat(i, "-digit\"></div>\n              <div class=\"").concat(i, "-label\">").concat(o.labelMinutes, "</div>\n            </div>\n            <div class=\"").concat(i, "-block\">\n              <div data-js=\"countdown-second\" class=\"").concat(i, "-digit\"></div>\n              <div class=\"").concat(i, "-label\">").concat(o.labelSeconds, "</div>\n            </div>\n          </span>\n          <span data-js=\"countdown-endtext\" class=\"").concat(i, "-endtext\"></span>\n        "), styles: (d || "\n          .".concat(i, " {\n            text-align: center;\n          }\n\n          .").concat(i, "-block {\n            display: inline-block;\n            margin: 0 10px;\n            padding: 10px;\n          }\n\n          .").concat(i, "-digit {\n            font-size: 5rem;\n          }\n\n          .").concat(i, "-endtext {\n            font-size: 5rem;\n          }\n\n          .").concat(i, "-cont {\n            display: inline-block;\n          }\n        ")) + o.styleAdditional }, c) } }) }; return t })()));
//# sourceMappingURL=index.js.map