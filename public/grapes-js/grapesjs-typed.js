/**
 * Skipped minification because the original files appears to be already minified.
 * Original file: /npm/grapesjs-typed@2.0.1/dist/index.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
/*! grapesjs-typed - 2.0.1 */
! function(e, t) { 'object' == typeof exports && 'object' == typeof module ? module.exports = t() : 'function' == typeof define && define.amd ? define([], t) : 'object' == typeof exports ? exports["grapesjs-typed"] = t() : e["grapesjs-typed"] = t() }('undefined' != typeof globalThis ? globalThis : 'undefined' != typeof window ? window : this, (() => (() => { "use strict"; var e = { d: (t, n) => { for (var o in n) e.o(n, o) && !e.o(t, o) && Object.defineProperty(t, o, { enumerable: !0, get: n[o] }) }, o: (e, t) => Object.prototype.hasOwnProperty.call(e, t), r: e => { 'undefined' != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: 'Module' }), Object.defineProperty(e, '__esModule', { value: !0 }) } },
        t = {};
    e.r(t), e.d(t, { default: () => c }); var n = 'typed',
        o = 'typed-strings',
        r = void 0 && (void 0).__assign || function() { return r = Object.assign || function(e) { for (var t, n = 1, o = arguments.length; n < o; n++)
                    for (var r in t = arguments[n]) Object.prototype.hasOwnProperty.call(t, r) && (e[r] = t[r]); return e }, r.apply(this, arguments) },
        a = void 0 && (void 0).__spreadArray || function(e, t, n) { if (n || 2 === arguments.length)
                for (var o, r = 0, a = t.length; r < a; r++) !o && r in t || (o || (o = Array.prototype.slice.call(t, 0, r)), o[r] = t[r]); return e.concat(o || Array.prototype.slice.call(t)) }; var s = void 0 && (void 0).__assign || function() { return s = Object.assign || function(e) { for (var t, n = 1, o = arguments.length; n < o; n++)
                for (var r in t = arguments[n]) Object.prototype.hasOwnProperty.call(t, r) && (e[r] = t[r]); return e }, s.apply(this, arguments) }; var p = void 0 && (void 0).__assign || function() { return p = Object.assign || function(e) { for (var t, n = 1, o = arguments.length; n < o; n++)
                for (var r in t = arguments[n]) Object.prototype.hasOwnProperty.call(t, r) && (e[r] = t[r]); return e }, p.apply(this, arguments) }; const c = function(e, t) { void 0 === t && (t = {}); var c = p({ script: 'https://cdn.jsdelivr.net/npm/typed.js@2.0.11', block: {}, props: function(e) { return e } }, t);! function(e, t) { var s = e.DomComponents,
                p = Object.keys,
                c = { strings: [], 'type-speed': 0, 'start-delay': 0, 'back-speed': 0, 'smart-backspace': !0, 'back-delay': 700, 'fade-out': !1, 'fade-out-class': 'typed-fade-out', 'fade-out-delay': 500, 'show-cursor': !0, 'cursor-char': '|', 'auto-insert-css': !0, 'bind-input-focus-events': !1, 'content-type': 'html', loop: !1, 'loop-count': 1 / 0, shuffle: !1, attr: '' },
                i = p(c),
                d = i.filter((function(e) { return ['strings'].indexOf(e) < 0 })).map((function(e) { return { changeProp: !0, type: (t = c[e], 'number' == typeof t ? 'number' : 'boolean' == typeof t ? 'checkbox' : 'text'), min: 0, name: e }; var t }));
            d.unshift({ changeProp: !0, name: 'strings', type: o }), s.addType(n, { model: { defaults: t.props(r(r({}, c), { typedsrc: t.script, droppable: 0, traits: d, 'script-props': a(a([], i, !0), ['typedsrc'], !1), script: function(e) { var t, n = this,
                                o = (t = e.strings, Array.isArray(t) ? t : t.indexOf('\n') >= 0 ? t.split('\n') : []),
                                r = function(e) { return parseInt(e, 10) || 0 },
                                a = function(e) { return !!e },
                                s = function() { var t = n;
                                    t.innerHTML = '<span></span>'; var s = parseInt("".concat(e['loop-count']), 10); "".concat(e['type-speed']); var p = { typeSpeed: r(e['type-speed']), startDelay: r(e['start-delay']), backDelay: r(e['back-delay']), backSpeed: r(e['back-speed']), smartBackspace: a(e['smart-backspace']), fadeOut: a(e['fade-out']), fadeOutClass: e['fade-out-class'], fadeOutDelay: r(e['fade-out-delay']), shuffle: a(e.shuffle), loop: a(e.loop), loopCount: isNaN(s) ? 1 / 0 : s, showCursor: a(e['show-cursor']), cursorChar: e['cursor-char'], autoInsertCss: a(e['auto-insert-css']), bindInputFocusEvents: a(e['bind-input-focus-events']), attr: e.attr, contentType: e['content-type'] };
                                    o && o.length && (p.strings = o), new window.Typed(t.children[0], p) }; if (window.Typed) s();
                            else { var p = document.createElement('script');
                                p.src = e.typedsrc, p.onload = s, document.head.appendChild(p) } } })) } }) }(e, c),
        function(e, t) { var o = e.BlockManager,
                r = t.block;
            r && o.add(n, s({ label: 'Typed', media: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300"><path d="M212.3 44l2.3 49.6h-6A60 60 0 00204 75c-3.2-6-7.5-10.5-12.9-13.3a44.9 44.9 0 00-21.1-4.3h-29.8V219c0 13 1.4 21 4.2 24.3 4 4.4 10 6.6 18.2 6.6h7.4v5.7H80.2V250h7.5c9 0 15.3-2.7 19-8.2 2.4-3.3 3.5-10.9 3.5-22.7V57.3H84.8a71 71 0 00-21.1 2.2 29 29 0 00-13.9 11.3 46.1 46.1 0 00-6.9 22.8H37L39.5 44h172.8zM245 22h18v256h-18z"/></svg>', content: { type: n }, select: !0 }, r)) }(e, c),
        function(e) { e.TraitManager.addType(o, { createInput: function(e) { var t = e.component; return "<textarea>".concat(t.get('strings').join('\n'), "</textarea>") }, onUpdate: function(e) { var t = e.component;
                    e.elInput.value = t.get('strings').join('\n') }, onEvent: function(e) { var t = e.component,
                        n = (e.elInput.value || '').split('\n');
                    t.set('strings', n) } }) }(e) }; return t })()));
//# sourceMappingURL=index.js.map