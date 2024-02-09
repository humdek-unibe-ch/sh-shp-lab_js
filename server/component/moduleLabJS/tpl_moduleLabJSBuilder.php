<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<div id="root">
        <style>
            @keyframes fadein {
                from {
                    opacity: 0
                }

                to {
                    opacity: 1
                }
            }

            #root .loading {
                width: 100%;
                height: 90vh;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center
            }

            #root .loading img {
                opacity: 0;
                animation: 4.5s linear 1s infinite alternate fadein;
                filter: grayscale(75%);
                margin: 2rem
            }
        </style>
        <div class="loading"><img src="labjs_icon_192.png" class="loading-img"></div>
    </div>
    <script>!function (e) { function t(t) { for (var n, o, u = t[0], i = t[1], f = t[2], l = 0, d = []; l < u.length; l++)o = u[l], Object.prototype.hasOwnProperty.call(a, o) && a[o] && d.push(a[o][0]), a[o] = 0; for (n in i) Object.prototype.hasOwnProperty.call(i, n) && (e[n] = i[n]); for (s && s(t); d.length;)d.shift()(); return c.push.apply(c, f || []), r() } function r() { for (var e, t = 0; t < c.length; t++) { for (var r = c[t], n = !0, o = 1; o < r.length; o++) { var i = r[o]; 0 !== a[i] && (n = !1) } n && (c.splice(t--, 1), e = u(u.s = r[0])) } return e } var n = {}, o = { 1: 0 }, a = { 1: 0 }, c = []; function u(t) { if (n[t]) return n[t].exports; var r = n[t] = { i: t, l: !1, exports: {} }; return e[t].call(r.exports, r, r.exports, u), r.l = !0, r.exports } u.e = function (e) { var t = []; o[e] ? t.push(o[e]) : 0 !== o[e] && { 5: 1, 7: 1, 8: 1, 9: 1, 10: 1 }[e] && t.push(o[e] = new Promise((function (t, r) { for (var n = "static/css/" + ({}[e] || e) + "." + { 3: "31d6cfe0", 4: "31d6cfe0", 5: "f11e92ef", 6: "31d6cfe0", 7: "b3d54b72", 8: "3514efe6", 9: "1a96a908", 10: "197c6520", 11: "31d6cfe0", 12: "31d6cfe0", 13: "31d6cfe0", 14: "31d6cfe0", 15: "31d6cfe0", 16: "31d6cfe0" }[e] + ".chunk.css", a = u.p + n, c = document.getElementsByTagName("link"), i = 0; i < c.length; i++) { var f = (s = c[i]).getAttribute("data-href") || s.getAttribute("href"); if ("stylesheet" === s.rel && (f === n || f === a)) return t() } var l = document.getElementsByTagName("style"); for (i = 0; i < l.length; i++) { var s; if ((f = (s = l[i]).getAttribute("data-href")) === n || f === a) return t() } var d = document.createElement("link"); d.rel = "stylesheet", d.type = "text/css", d.onload = t, d.onerror = function (t) { var n = t && t.target && t.target.src || a, c = new Error("Loading CSS chunk " + e + " failed.\n(" + n + ")"); c.code = "CSS_CHUNK_LOAD_FAILED", c.request = n, delete o[e], d.parentNode.removeChild(d), r(c) }, d.href = a, document.getElementsByTagName("head")[0].appendChild(d) })).then((function () { o[e] = 0 }))); var r = a[e]; if (0 !== r) if (r) t.push(r[2]); else { var n = new Promise((function (t, n) { r = a[e] = [t, n] })); t.push(r[2] = n); var c, i = document.createElement("script"); i.charset = "utf-8", i.timeout = 120, u.nc && i.setAttribute("nonce", u.nc), i.src = function (e) { return u.p + "static/js/" + ({}[e] || e) + "." + { 3: "5db0c634", 4: "752c4117", 5: "89c5bdc8", 6: "681b8946", 7: "cc117be1", 8: "85153d92", 9: "012f29a1", 10: "dbe49a1d", 11: "42801040", 12: "1f10c7af", 13: "6fa0cc8c", 14: "f4d3de21", 15: "00083ec1", 16: "91a71458" }[e] + ".chunk.js" }(e); var f = new Error; c = function (t) { i.onerror = i.onload = null, clearTimeout(l); var r = a[e]; if (0 !== r) { if (r) { var n = t && ("load" === t.type ? "missing" : t.type), o = t && t.target && t.target.src; f.message = "Loading chunk " + e + " failed.\n(" + n + ": " + o + ")", f.name = "ChunkLoadError", f.type = n, f.request = o, r[1](f) } a[e] = void 0 } }; var l = setTimeout((function () { c({ type: "timeout", target: i }) }), 12e4); i.onerror = i.onload = c, document.head.appendChild(i) } return Promise.all(t) }, u.m = e, u.c = n, u.d = function (e, t, r) { u.o(e, t) || Object.defineProperty(e, t, { enumerable: !0, get: r }) }, u.r = function (e) { "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 }) }, u.t = function (e, t) { if (1 & t && (e = u(e)), 8 & t) return e; if (4 & t && "object" == typeof e && e && e.__esModule) return e; var r = Object.create(null); if (u.r(r), Object.defineProperty(r, "default", { enumerable: !0, value: e }), 2 & t && "string" != typeof e) for (var n in e) u.d(r, n, function (t) { return e[t] }.bind(null, n)); return r }, u.n = function (e) { var t = e && e.__esModule ? function () { return e.default } : function () { return e }; return u.d(t, "a", t), t }, u.o = function (e, t) { return Object.prototype.hasOwnProperty.call(e, t) }, u.p = "/", u.oe = function (e) { throw console.error(e), e }; var i = this["webpackJsonplab.js.builder"] = this["webpackJsonplab.js.builder"] || [], f = i.push.bind(i); i.push = t, i = i.slice(); for (var l = 0; l < i.length; l++)t(i[l]); var s = f; r() }([])</script>
    <script src="/static/js/2.760f5555.chunk.js"></script>
    <script src="/static/js/main.7679b418.chunk.js"></script>