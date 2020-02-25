var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*! Select2 4.0.6-rc.1 | https://github.com/select2/select2/blob/master/LICENSE.md */!function (a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : "object" == (typeof module === "undefined" ? "undefined" : _typeof(module)) && module.exports ? module.exports = function (b, c) {
        return void 0 === c && (c = "undefined" != typeof window ? require("jquery") : require("jquery")(b)), a(c), c;
    } : a(jQuery);
}(function (a) {
    var b = function () {
        if (a && a.fn && a.fn.select2 && a.fn.select2.amd) var b = a.fn.select2.amd;var b;return function () {
            if (!b || !b.requirejs) {
                b ? c = b : b = {};var a, c, d;!function (b) {
                    function e(a, b) {
                        return v.call(a, b);
                    }function f(a, b) {
                        var c,
                            d,
                            e,
                            f,
                            g,
                            h,
                            i,
                            j,
                            k,
                            l,
                            m,
                            n,
                            o = b && b.split("/"),
                            p = t.map,
                            q = p && p["*"] || {};if (a) {
                            for (a = a.split("/"), g = a.length - 1, t.nodeIdCompat && x.test(a[g]) && (a[g] = a[g].replace(x, "")), "." === a[0].charAt(0) && o && (n = o.slice(0, o.length - 1), a = n.concat(a)), k = 0; k < a.length; k++) {
                                if ("." === (m = a[k])) a.splice(k, 1), k -= 1;else if (".." === m) {
                                    if (0 === k || 1 === k && ".." === a[2] || ".." === a[k - 1]) continue;k > 0 && (a.splice(k - 1, 2), k -= 2);
                                }
                            }a = a.join("/");
                        }if ((o || q) && p) {
                            for (c = a.split("/"), k = c.length; k > 0; k -= 1) {
                                if (d = c.slice(0, k).join("/"), o) for (l = o.length; l > 0; l -= 1) {
                                    if ((e = p[o.slice(0, l).join("/")]) && (e = e[d])) {
                                        f = e, h = k;break;
                                    }
                                }if (f) break;!i && q && q[d] && (i = q[d], j = k);
                            }!f && i && (f = i, h = j), f && (c.splice(0, h, f), a = c.join("/"));
                        }return a;
                    }function g(a, c) {
                        return function () {
                            var d = w.call(arguments, 0);return "string" != typeof d[0] && 1 === d.length && d.push(null), _o.apply(b, d.concat([a, c]));
                        };
                    }function h(a) {
                        return function (b) {
                            return f(b, a);
                        };
                    }function i(a) {
                        return function (b) {
                            r[a] = b;
                        };
                    }function j(a) {
                        if (e(s, a)) {
                            var c = s[a];delete s[a], u[a] = !0, n.apply(b, c);
                        }if (!e(r, a) && !e(u, a)) throw new Error("No " + a);return r[a];
                    }function k(a) {
                        var b,
                            c = a ? a.indexOf("!") : -1;return c > -1 && (b = a.substring(0, c), a = a.substring(c + 1, a.length)), [b, a];
                    }function l(a) {
                        return a ? k(a) : [];
                    }function m(a) {
                        return function () {
                            return t && t.config && t.config[a] || {};
                        };
                    }var n,
                        _o,
                        p,
                        q,
                        r = {},
                        s = {},
                        t = {},
                        u = {},
                        v = Object.prototype.hasOwnProperty,
                        w = [].slice,
                        x = /\.js$/;p = function p(a, b) {
                        var c,
                            d = k(a),
                            e = d[0],
                            g = b[1];return a = d[1], e && (e = f(e, g), c = j(e)), e ? a = c && c.normalize ? c.normalize(a, h(g)) : f(a, g) : (a = f(a, g), d = k(a), e = d[0], a = d[1], e && (c = j(e))), { f: e ? e + "!" + a : a, n: a, pr: e, p: c };
                    }, q = { require: function require(a) {
                            return g(a);
                        }, exports: function exports(a) {
                            var b = r[a];return void 0 !== b ? b : r[a] = {};
                        }, module: function module(a) {
                            return { id: a, uri: "", exports: r[a], config: m(a) };
                        } }, n = function n(a, c, d, f) {
                        var h,
                            k,
                            m,
                            n,
                            o,
                            t,
                            v,
                            w = [],
                            x = typeof d === "undefined" ? "undefined" : _typeof(d);if (f = f || a, t = l(f), "undefined" === x || "function" === x) {
                            for (c = !c.length && d.length ? ["require", "exports", "module"] : c, o = 0; o < c.length; o += 1) {
                                if (n = p(c[o], t), "require" === (k = n.f)) w[o] = q.require(a);else if ("exports" === k) w[o] = q.exports(a), v = !0;else if ("module" === k) h = w[o] = q.module(a);else if (e(r, k) || e(s, k) || e(u, k)) w[o] = j(k);else {
                                    if (!n.p) throw new Error(a + " missing " + k);n.p.load(n.n, g(f, !0), i(k), {}), w[o] = r[k];
                                }
                            }m = d ? d.apply(r[a], w) : void 0, a && (h && h.exports !== b && h.exports !== r[a] ? r[a] = h.exports : m === b && v || (r[a] = m));
                        } else a && (r[a] = d);
                    }, a = c = _o = function o(a, c, d, e, f) {
                        if ("string" == typeof a) return q[a] ? q[a](c) : j(p(a, l(c)).f);if (!a.splice) {
                            if (t = a, t.deps && _o(t.deps, t.callback), !c) return;c.splice ? (a = c, c = d, d = null) : a = b;
                        }return c = c || function () {}, "function" == typeof d && (d = e, e = f), e ? n(b, a, c, d) : setTimeout(function () {
                            n(b, a, c, d);
                        }, 4), _o;
                    }, _o.config = function (a) {
                        return _o(a);
                    }, a._defined = r, d = function d(a, b, c) {
                        if ("string" != typeof a) throw new Error("See almond README: incorrect module build, no module name");b.splice || (c = b, b = []), e(r, a) || e(s, a) || (s[a] = [a, b, c]);
                    }, d.amd = { jQuery: !0 };
                }(), b.requirejs = a, b.require = c, b.define = d;
            }
        }(), b.define("almond", function () {}), b.define("jquery", [], function () {
            var b = a || $;return null == b && console && console.error && console.error("Select2: An instance of jQuery or a jQuery-compatible library was not found. Make sure that you are including jQuery before Select2 on your web page."), b;
        }), b.define("select2/utils", ["jquery"], function (a) {
            function b(a) {
                var b = a.prototype,
                    c = [];for (var d in b) {
                    "function" == typeof b[d] && "constructor" !== d && c.push(d);
                }return c;
            }var c = {};c.Extend = function (a, b) {
                function c() {
                    this.constructor = a;
                }var d = {}.hasOwnProperty;for (var e in b) {
                    d.call(b, e) && (a[e] = b[e]);
                }return c.prototype = b.prototype, a.prototype = new c(), a.__super__ = b.prototype, a;
            }, c.Decorate = function (a, c) {
                function d() {
                    var b = Array.prototype.unshift,
                        d = c.prototype.constructor.length,
                        e = a.prototype.constructor;d > 0 && (b.call(arguments, a.prototype.constructor), e = c.prototype.constructor), e.apply(this, arguments);
                }function e() {
                    this.constructor = d;
                }var f = b(c),
                    g = b(a);c.displayName = a.displayName, d.prototype = new e();for (var h = 0; h < g.length; h++) {
                    var i = g[h];d.prototype[i] = a.prototype[i];
                }for (var j = function j(a) {
                    var b = function b() {};(a in d.prototype) && (b = d.prototype[a]);var e = c.prototype[a];return function () {
                        return Array.prototype.unshift.call(arguments, b), e.apply(this, arguments);
                    };
                }, k = 0; k < f.length; k++) {
                    var l = f[k];d.prototype[l] = j(l);
                }return d;
            };var d = function d() {
                this.listeners = {};
            };d.prototype.on = function (a, b) {
                this.listeners = this.listeners || {}, a in this.listeners ? this.listeners[a].push(b) : this.listeners[a] = [b];
            }, d.prototype.trigger = function (a) {
                var b = Array.prototype.slice,
                    c = b.call(arguments, 1);this.listeners = this.listeners || {}, null == c && (c = []), 0 === c.length && c.push({}), c[0]._type = a, a in this.listeners && this.invoke(this.listeners[a], b.call(arguments, 1)), "*" in this.listeners && this.invoke(this.listeners["*"], arguments);
            }, d.prototype.invoke = function (a, b) {
                for (var c = 0, d = a.length; c < d; c++) {
                    a[c].apply(this, b);
                }
            }, c.Observable = d, c.generateChars = function (a) {
                for (var b = "", c = 0; c < a; c++) {
                    b += Math.floor(36 * Math.random()).toString(36);
                }return b;
            }, c.bind = function (a, b) {
                return function () {
                    a.apply(b, arguments);
                };
            }, c._convertData = function (a) {
                for (var b in a) {
                    var c = b.split("-"),
                        d = a;if (1 !== c.length) {
                        for (var e = 0; e < c.length; e++) {
                            var f = c[e];f = f.substring(0, 1).toLowerCase() + f.substring(1), f in d || (d[f] = {}), e == c.length - 1 && (d[f] = a[b]), d = d[f];
                        }delete a[b];
                    }
                }return a;
            }, c.hasScroll = function (b, c) {
                var d = a(c),
                    e = c.style.overflowX,
                    f = c.style.overflowY;return (e !== f || "hidden" !== f && "visible" !== f) && ("scroll" === e || "scroll" === f || d.innerHeight() < c.scrollHeight || d.innerWidth() < c.scrollWidth);
            }, c.escapeMarkup = function (a) {
                var b = { "\\": "&#92;", "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;", "/": "&#47;" };return "string" != typeof a ? a : String(a).replace(/[&<>"'\/\\]/g, function (a) {
                    return b[a];
                });
            }, c.appendMany = function (b, c) {
                if ("1.7" === a.fn.jquery.substr(0, 3)) {
                    var d = a();a.map(c, function (a) {
                        d = d.add(a);
                    }), c = d;
                }b.append(c);
            }, c.__cache = {};var e = 0;return c.GetUniqueElementId = function (a) {
                var b = a.getAttribute("data-select2-id");return null == b && (a.id ? (b = a.id, a.setAttribute("data-select2-id", b)) : (a.setAttribute("data-select2-id", ++e), b = e.toString())), b;
            }, c.StoreData = function (a, b, d) {
                var e = c.GetUniqueElementId(a);c.__cache[e] || (c.__cache[e] = {}), c.__cache[e][b] = d;
            }, c.GetData = function (b, d) {
                var e = c.GetUniqueElementId(b);return d ? c.__cache[e] && null != c.__cache[e][d] ? c.__cache[e][d] : a(b).data(d) : c.__cache[e];
            }, c.RemoveData = function (a) {
                var b = c.GetUniqueElementId(a);null != c.__cache[b] && delete c.__cache[b];
            }, c;
        }), b.define("select2/results", ["jquery", "./utils"], function (a, b) {
            function c(a, b, d) {
                this.$element = a, this.data = d, this.options = b, c.__super__.constructor.call(this);
            }return b.Extend(c, b.Observable), c.prototype.render = function () {
                var b = a('<ul class="select2-results__options" role="tree"></ul>');return this.options.get("multiple") && b.attr("aria-multiselectable", "true"), this.$results = b, b;
            }, c.prototype.clear = function () {
                this.$results.empty();
            }, c.prototype.displayMessage = function (b) {
                var c = this.options.get("escapeMarkup");this.clear(), this.hideLoading();var d = a('<li role="treeitem" aria-live="assertive" class="select2-results__option"></li>'),
                    e = this.options.get("translations").get(b.message);d.append(c(e(b.args))), d[0].className += " select2-results__message", this.$results.append(d);
            }, c.prototype.hideMessages = function () {
                this.$results.find(".select2-results__message").remove();
            }, c.prototype.append = function (a) {
                this.hideLoading();var b = [];if (null == a.results || 0 === a.results.length) return void (0 === this.$results.children().length && this.trigger("results:message", { message: "noResults" }));a.results = this.sort(a.results);for (var c = 0; c < a.results.length; c++) {
                    var d = a.results[c],
                        e = this.option(d);b.push(e);
                }this.$results.append(b);
            }, c.prototype.position = function (a, b) {
                b.find(".select2-results").append(a);
            }, c.prototype.sort = function (a) {
                return this.options.get("sorter")(a);
            }, c.prototype.highlightFirstItem = function () {
                var a = this.$results.find(".select2-results__option[aria-selected]"),
                    b = a.filter("[aria-selected=true]");b.length > 0 ? b.first().trigger("mouseenter") : a.first().trigger("mouseenter"), this.ensureHighlightVisible();
            }, c.prototype.setClasses = function () {
                var c = this;this.data.current(function (d) {
                    var e = a.map(d, function (a) {
                        return a.id.toString();
                    });c.$results.find(".select2-results__option[aria-selected]").each(function () {
                        var c = a(this),
                            d = b.GetData(this, "data"),
                            f = "" + d.id;null != d.element && d.element.selected || null == d.element && a.inArray(f, e) > -1 ? c.attr("aria-selected", "true") : c.attr("aria-selected", "false");
                    });
                });
            }, c.prototype.showLoading = function (a) {
                this.hideLoading();var b = this.options.get("translations").get("searching"),
                    c = { disabled: !0, loading: !0, text: b(a) },
                    d = this.option(c);d.className += " loading-results", this.$results.prepend(d);
            }, c.prototype.hideLoading = function () {
                this.$results.find(".loading-results").remove();
            }, c.prototype.option = function (c) {
                var d = document.createElement("li");d.className = "select2-results__option";var e = { role: "treeitem", "aria-selected": "false" };c.disabled && (delete e["aria-selected"], e["aria-disabled"] = "true"), null == c.id && delete e["aria-selected"], null != c._resultId && (d.id = c._resultId), c.title && (d.title = c.title), c.children && (e.role = "group", e["aria-label"] = c.text, delete e["aria-selected"]);for (var f in e) {
                    var g = e[f];d.setAttribute(f, g);
                }if (c.children) {
                    var h = a(d),
                        i = document.createElement("strong");i.className = "select2-results__group";a(i);this.template(c, i);for (var j = [], k = 0; k < c.children.length; k++) {
                        var l = c.children[k],
                            m = this.option(l);j.push(m);
                    }var n = a("<ul></ul>", { class: "select2-results__options select2-results__options--nested" });n.append(j), h.append(i), h.append(n);
                } else this.template(c, d);return b.StoreData(d, "data", c), d;
            }, c.prototype.bind = function (c, d) {
                var e = this,
                    f = c.id + "-results";this.$results.attr("id", f), c.on("results:all", function (a) {
                    e.clear(), e.append(a.data), c.isOpen() && (e.setClasses(), e.highlightFirstItem());
                }), c.on("results:append", function (a) {
                    e.append(a.data), c.isOpen() && e.setClasses();
                }), c.on("query", function (a) {
                    e.hideMessages(), e.showLoading(a);
                }), c.on("select", function () {
                    c.isOpen() && (e.setClasses(), e.highlightFirstItem());
                }), c.on("unselect", function () {
                    c.isOpen() && (e.setClasses(), e.highlightFirstItem());
                }), c.on("open", function () {
                    e.$results.attr("aria-expanded", "true"), e.$results.attr("aria-hidden", "false"), e.setClasses(), e.ensureHighlightVisible();
                }), c.on("close", function () {
                    e.$results.attr("aria-expanded", "false"), e.$results.attr("aria-hidden", "true"), e.$results.removeAttr("aria-activedescendant");
                }), c.on("results:toggle", function () {
                    var a = e.getHighlightedResults();0 !== a.length && a.trigger("mouseup");
                }), c.on("results:select", function () {
                    var a = e.getHighlightedResults();if (0 !== a.length) {
                        var c = b.GetData(a[0], "data");"true" == a.attr("aria-selected") ? e.trigger("close", {}) : e.trigger("select", { data: c });
                    }
                }), c.on("results:previous", function () {
                    var a = e.getHighlightedResults(),
                        b = e.$results.find("[aria-selected]"),
                        c = b.index(a);if (!(c <= 0)) {
                        var d = c - 1;0 === a.length && (d = 0);var f = b.eq(d);f.trigger("mouseenter");var g = e.$results.offset().top,
                            h = f.offset().top,
                            i = e.$results.scrollTop() + (h - g);0 === d ? e.$results.scrollTop(0) : h - g < 0 && e.$results.scrollTop(i);
                    }
                }), c.on("results:next", function () {
                    var a = e.getHighlightedResults(),
                        b = e.$results.find("[aria-selected]"),
                        c = b.index(a),
                        d = c + 1;if (!(d >= b.length)) {
                        var f = b.eq(d);f.trigger("mouseenter");var g = e.$results.offset().top + e.$results.outerHeight(!1),
                            h = f.offset().top + f.outerHeight(!1),
                            i = e.$results.scrollTop() + h - g;0 === d ? e.$results.scrollTop(0) : h > g && e.$results.scrollTop(i);
                    }
                }), c.on("results:focus", function (a) {
                    a.element.addClass("select2-results__option--highlighted");
                }), c.on("results:message", function (a) {
                    e.displayMessage(a);
                }), a.fn.mousewheel && this.$results.on("mousewheel", function (a) {
                    var b = e.$results.scrollTop(),
                        c = e.$results.get(0).scrollHeight - b + a.deltaY,
                        d = a.deltaY > 0 && b - a.deltaY <= 0,
                        f = a.deltaY < 0 && c <= e.$results.height();d ? (e.$results.scrollTop(0), a.preventDefault(), a.stopPropagation()) : f && (e.$results.scrollTop(e.$results.get(0).scrollHeight - e.$results.height()), a.preventDefault(), a.stopPropagation());
                }), this.$results.on("mouseup", ".select2-results__option[aria-selected]", function (c) {
                    var d = a(this),
                        f = b.GetData(this, "data");if ("true" === d.attr("aria-selected")) return void (e.options.get("multiple") ? e.trigger("unselect", { originalEvent: c, data: f }) : e.trigger("close", {}));e.trigger("select", { originalEvent: c, data: f });
                }), this.$results.on("mouseenter", ".select2-results__option[aria-selected]", function (c) {
                    var d = b.GetData(this, "data");e.getHighlightedResults().removeClass("select2-results__option--highlighted"), e.trigger("results:focus", { data: d, element: a(this) });
                });
            }, c.prototype.getHighlightedResults = function () {
                return this.$results.find(".select2-results__option--highlighted");
            }, c.prototype.destroy = function () {
                this.$results.remove();
            }, c.prototype.ensureHighlightVisible = function () {
                var a = this.getHighlightedResults();if (0 !== a.length) {
                    var b = this.$results.find("[aria-selected]"),
                        c = b.index(a),
                        d = this.$results.offset().top,
                        e = a.offset().top,
                        f = this.$results.scrollTop() + (e - d),
                        g = e - d;f -= 2 * a.outerHeight(!1), c <= 2 ? this.$results.scrollTop(0) : (g > this.$results.outerHeight() || g < 0) && this.$results.scrollTop(f);
                }
            }, c.prototype.template = function (b, c) {
                var d = this.options.get("templateResult"),
                    e = this.options.get("escapeMarkup"),
                    f = d(b, c);null == f ? c.style.display = "none" : "string" == typeof f ? c.innerHTML = e(f) : a(c).append(f);
            }, c;
        }), b.define("select2/keys", [], function () {
            return { BACKSPACE: 8, TAB: 9, ENTER: 13, SHIFT: 16, CTRL: 17, ALT: 18, ESC: 27, SPACE: 32, PAGE_UP: 33, PAGE_DOWN: 34, END: 35, HOME: 36, LEFT: 37, UP: 38, RIGHT: 39, DOWN: 40, DELETE: 46 };
        }), b.define("select2/selection/base", ["jquery", "../utils", "../keys"], function (a, b, c) {
            function d(a, b) {
                this.$element = a, this.options = b, d.__super__.constructor.call(this);
            }return b.Extend(d, b.Observable), d.prototype.render = function () {
                var c = a('<span class="select2-selection" role="combobox"  aria-haspopup="true" aria-expanded="false"></span>');return this._tabindex = 0, null != b.GetData(this.$element[0], "old-tabindex") ? this._tabindex = b.GetData(this.$element[0], "old-tabindex") : null != this.$element.attr("tabindex") && (this._tabindex = this.$element.attr("tabindex")), c.attr("title", this.$element.attr("title")), c.attr("tabindex", this._tabindex), this.$selection = c, c;
            }, d.prototype.bind = function (a, b) {
                var d = this,
                    e = (a.id, a.id + "-results");this.container = a, this.$selection.on("focus", function (a) {
                    d.trigger("focus", a);
                }), this.$selection.on("blur", function (a) {
                    d._handleBlur(a);
                }), this.$selection.on("keydown", function (a) {
                    d.trigger("keypress", a), a.which === c.SPACE && a.preventDefault();
                }), a.on("results:focus", function (a) {
                    d.$selection.attr("aria-activedescendant", a.data._resultId);
                }), a.on("selection:update", function (a) {
                    d.update(a.data);
                }), a.on("open", function () {
                    d.$selection.attr("aria-expanded", "true"), d.$selection.attr("aria-owns", e), d._attachCloseHandler(a);
                }), a.on("close", function () {
                    d.$selection.attr("aria-expanded", "false"), d.$selection.removeAttr("aria-activedescendant"), d.$selection.removeAttr("aria-owns"), d.$selection.focus(), window.setTimeout(function () {
                        d.$selection.focus();
                    }, 0), d._detachCloseHandler(a);
                }), a.on("enable", function () {
                    d.$selection.attr("tabindex", d._tabindex);
                }), a.on("disable", function () {
                    d.$selection.attr("tabindex", "-1");
                });
            }, d.prototype._handleBlur = function (b) {
                var c = this;window.setTimeout(function () {
                    document.activeElement == c.$selection[0] || a.contains(c.$selection[0], document.activeElement) || c.trigger("blur", b);
                }, 1);
            }, d.prototype._attachCloseHandler = function (c) {
                a(document.body).on("mousedown.select2." + c.id, function (c) {
                    var d = a(c.target),
                        e = d.closest(".select2");a(".select2.select2-container--open").each(function () {
                        a(this), this != e[0] && b.GetData(this, "element").select2("close");
                    });
                });
            }, d.prototype._detachCloseHandler = function (b) {
                a(document.body).off("mousedown.select2." + b.id);
            }, d.prototype.position = function (a, b) {
                b.find(".selection").append(a);
            }, d.prototype.destroy = function () {
                this._detachCloseHandler(this.container);
            }, d.prototype.update = function (a) {
                throw new Error("The `update` method must be defined in child classes.");
            }, d;
        }), b.define("select2/selection/single", ["jquery", "./base", "../utils", "../keys"], function (a, b, c, d) {
            function e() {
                e.__super__.constructor.apply(this, arguments);
            }return c.Extend(e, b), e.prototype.render = function () {
                var a = e.__super__.render.call(this);return a.addClass("select2-selection--single"), a.html('<span class="select2-selection__rendered"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>'), a;
            }, e.prototype.bind = function (a, b) {
                var c = this;e.__super__.bind.apply(this, arguments);var d = a.id + "-container";this.$selection.find(".select2-selection__rendered").attr("id", d).attr("role", "textbox").attr("aria-readonly", "true"), this.$selection.attr("aria-labelledby", d), this.$selection.on("mousedown", function (a) {
                    1 === a.which && c.trigger("toggle", { originalEvent: a });
                }), this.$selection.on("focus", function (a) {}), this.$selection.on("blur", function (a) {}), a.on("focus", function (b) {
                    a.isOpen() || c.$selection.focus();
                });
            }, e.prototype.clear = function () {
                var a = this.$selection.find(".select2-selection__rendered");a.empty(), a.removeAttr("title");
            }, e.prototype.display = function (a, b) {
                var c = this.options.get("templateSelection");return this.options.get("escapeMarkup")(c(a, b));
            }, e.prototype.selectionContainer = function () {
                return a("<span></span>");
            }, e.prototype.update = function (a) {
                if (0 === a.length) return void this.clear();var b = a[0],
                    c = this.$selection.find(".select2-selection__rendered"),
                    d = this.display(b, c);c.empty().append(d), c.attr("title", b.title || b.text);
            }, e;
        }), b.define("select2/selection/multiple", ["jquery", "./base", "../utils"], function (a, b, c) {
            function d(a, b) {
                d.__super__.constructor.apply(this, arguments);
            }return c.Extend(d, b), d.prototype.render = function () {
                var a = d.__super__.render.call(this);return a.addClass("select2-selection--multiple"), a.html('<ul class="select2-selection__rendered"></ul>'), a;
            }, d.prototype.bind = function (b, e) {
                var f = this;d.__super__.bind.apply(this, arguments), this.$selection.on("click", function (a) {
                    f.trigger("toggle", { originalEvent: a });
                }), this.$selection.on("click", ".select2-selection__choice__remove", function (b) {
                    if (!f.options.get("disabled")) {
                        var d = a(this),
                            e = d.parent(),
                            g = c.GetData(e[0], "data");f.trigger("unselect", { originalEvent: b, data: g });
                    }
                });
            }, d.prototype.clear = function () {
                var a = this.$selection.find(".select2-selection__rendered");a.empty(), a.removeAttr("title");
            }, d.prototype.display = function (a, b) {
                var c = this.options.get("templateSelection");return this.options.get("escapeMarkup")(c(a, b));
            }, d.prototype.selectionContainer = function () {
                return a('<li class="select2-selection__choice"><span class="select2-selection__choice__remove" role="presentation">&times;</span></li>');
            }, d.prototype.update = function (a) {
                if (this.clear(), 0 !== a.length) {
                    for (var b = [], d = 0; d < a.length; d++) {
                        var e = a[d],
                            f = this.selectionContainer(),
                            g = this.display(e, f);f.append(g), f.attr("title", e.title || e.text), c.StoreData(f[0], "data", e), b.push(f);
                    }var h = this.$selection.find(".select2-selection__rendered");c.appendMany(h, b);
                }
            }, d;
        }), b.define("select2/selection/placeholder", ["../utils"], function (a) {
            function b(a, b, c) {
                this.placeholder = this.normalizePlaceholder(c.get("placeholder")), a.call(this, b, c);
            }return b.prototype.normalizePlaceholder = function (a, b) {
                return "string" == typeof b && (b = { id: "", text: b }), b;
            }, b.prototype.createPlaceholder = function (a, b) {
                var c = this.selectionContainer();return c.html(this.display(b)), c.addClass("select2-selection__placeholder").removeClass("select2-selection__choice"), c;
            }, b.prototype.update = function (a, b) {
                var c = 1 == b.length && b[0].id != this.placeholder.id;if (b.length > 1 || c) return a.call(this, b);this.clear();var d = this.createPlaceholder(this.placeholder);this.$selection.find(".select2-selection__rendered").append(d);
            }, b;
        }), b.define("select2/selection/allowClear", ["jquery", "../keys", "../utils"], function (a, b, c) {
            function d() {}return d.prototype.bind = function (a, b, c) {
                var d = this;a.call(this, b, c), null == this.placeholder && this.options.get("debug") && window.console && console.error && console.error("Select2: The `allowClear` option should be used in combination with the `placeholder` option."), this.$selection.on("mousedown", ".select2-selection__clear", function (a) {
                    d._handleClear(a);
                }), b.on("keypress", function (a) {
                    d._handleKeyboardClear(a, b);
                });
            }, d.prototype._handleClear = function (a, b) {
                if (!this.options.get("disabled")) {
                    var d = this.$selection.find(".select2-selection__clear");if (0 !== d.length) {
                        b.stopPropagation();var e = c.GetData(d[0], "data"),
                            f = this.$element.val();this.$element.val(this.placeholder.id);var g = { data: e };if (this.trigger("clear", g), g.prevented) return void this.$element.val(f);for (var h = 0; h < e.length; h++) {
                            if (g = { data: e[h] }, this.trigger("unselect", g), g.prevented) return void this.$element.val(f);
                        }this.$element.trigger("change"), this.trigger("toggle", {});
                    }
                }
            }, d.prototype._handleKeyboardClear = function (a, c, d) {
                d.isOpen() || c.which != b.DELETE && c.which != b.BACKSPACE || this._handleClear(c);
            }, d.prototype.update = function (b, d) {
                if (b.call(this, d), !(this.$selection.find(".select2-selection__placeholder").length > 0 || 0 === d.length)) {
                    var e = a('<span class="select2-selection__clear">&times;</span>');c.StoreData(e[0], "data", d), this.$selection.find(".select2-selection__rendered").prepend(e);
                }
            }, d;
        }), b.define("select2/selection/search", ["jquery", "../utils", "../keys"], function (a, b, c) {
            function d(a, b, c) {
                a.call(this, b, c);
            }return d.prototype.render = function (b) {
                var c = a('<li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" /></li>');this.$searchContainer = c, this.$search = c.find("input");var d = b.call(this);return this._transferTabIndex(), d;
            }, d.prototype.bind = function (a, d, e) {
                var f = this;a.call(this, d, e), d.on("open", function () {
                    f.$search.trigger("focus");
                }), d.on("close", function () {
                    f.$search.val(""), f.$search.removeAttr("aria-activedescendant"), f.$search.trigger("focus");
                }), d.on("enable", function () {
                    f.$search.prop("disabled", !1), f._transferTabIndex();
                }), d.on("disable", function () {
                    f.$search.prop("disabled", !0);
                }), d.on("focus", function (a) {
                    f.$search.trigger("focus");
                }), d.on("results:focus", function (a) {
                    f.$search.attr("aria-activedescendant", a.id);
                }), this.$selection.on("focusin", ".select2-search--inline", function (a) {
                    f.trigger("focus", a);
                }), this.$selection.on("focusout", ".select2-search--inline", function (a) {
                    f._handleBlur(a);
                }), this.$selection.on("keydown", ".select2-search--inline", function (a) {
                    if (a.stopPropagation(), f.trigger("keypress", a), f._keyUpPrevented = a.isDefaultPrevented(), a.which === c.BACKSPACE && "" === f.$search.val()) {
                        var d = f.$searchContainer.prev(".select2-selection__choice");if (d.length > 0) {
                            var e = b.GetData(d[0], "data");f.searchRemoveChoice(e), a.preventDefault();
                        }
                    }
                });var g = document.documentMode,
                    h = g && g <= 11;this.$selection.on("input.searchcheck", ".select2-search--inline", function (a) {
                    if (h) return void f.$selection.off("input.search input.searchcheck");f.$selection.off("keyup.search");
                }), this.$selection.on("keyup.search input.search", ".select2-search--inline", function (a) {
                    if (h && "input" === a.type) return void f.$selection.off("input.search input.searchcheck");var b = a.which;b != c.SHIFT && b != c.CTRL && b != c.ALT && b != c.TAB && f.handleSearch(a);
                });
            }, d.prototype._transferTabIndex = function (a) {
                this.$search.attr("tabindex", this.$selection.attr("tabindex")), this.$selection.attr("tabindex", "-1");
            }, d.prototype.createPlaceholder = function (a, b) {
                this.$search.attr("placeholder", b.text);
            }, d.prototype.update = function (a, b) {
                var c = this.$search[0] == document.activeElement;if (this.$search.attr("placeholder", ""), a.call(this, b), this.$selection.find(".select2-selection__rendered").append(this.$searchContainer), this.resizeSearch(), c) {
                    this.$element.find("[data-select2-tag]").length ? this.$element.focus() : this.$search.focus();
                }
            }, d.prototype.handleSearch = function () {
                if (this.resizeSearch(), !this._keyUpPrevented) {
                    var a = this.$search.val();this.trigger("query", { term: a });
                }this._keyUpPrevented = !1;
            }, d.prototype.searchRemoveChoice = function (a, b) {
                this.trigger("unselect", { data: b }), this.$search.val(b.text), this.handleSearch();
            }, d.prototype.resizeSearch = function () {
                this.$search.css("width", "25px");var a = "";if ("" !== this.$search.attr("placeholder")) a = this.$selection.find(".select2-selection__rendered").innerWidth();else {
                    a = .75 * (this.$search.val().length + 1) + "em";
                }this.$search.css("width", a);
            }, d;
        }), b.define("select2/selection/eventRelay", ["jquery"], function (a) {
            function b() {}return b.prototype.bind = function (b, c, d) {
                var e = this,
                    f = ["open", "opening", "close", "closing", "select", "selecting", "unselect", "unselecting", "clear", "clearing"],
                    g = ["opening", "closing", "selecting", "unselecting", "clearing"];b.call(this, c, d), c.on("*", function (b, c) {
                    if (-1 !== a.inArray(b, f)) {
                        c = c || {};var d = a.Event("select2:" + b, { params: c });e.$element.trigger(d), -1 !== a.inArray(b, g) && (c.prevented = d.isDefaultPrevented());
                    }
                });
            }, b;
        }), b.define("select2/translation", ["jquery", "require"], function (a, b) {
            function c(a) {
                this.dict = a || {};
            }return c.prototype.all = function () {
                return this.dict;
            }, c.prototype.get = function (a) {
                return this.dict[a];
            }, c.prototype.extend = function (b) {
                this.dict = a.extend({}, b.all(), this.dict);
            }, c._cache = {}, c.loadPath = function (a) {
                if (!(a in c._cache)) {
                    var d = b(a);c._cache[a] = d;
                }return new c(c._cache[a]);
            }, c;
        }), b.define("select2/diacritics", [], function () {
            return { "Ⓐ": "A", "Ａ": "A", "À": "A", "Á": "A", "Â": "A", "Ầ": "A", "Ấ": "A", "Ẫ": "A", "Ẩ": "A", "Ã": "A", "Ā": "A", "Ă": "A", "Ằ": "A", "Ắ": "A", "Ẵ": "A", "Ẳ": "A", "Ȧ": "A", "Ǡ": "A", "Ä": "A", "Ǟ": "A", "Ả": "A", "Å": "A", "Ǻ": "A", "Ǎ": "A", "Ȁ": "A", "Ȃ": "A", "Ạ": "A", "Ậ": "A", "Ặ": "A", "Ḁ": "A", "Ą": "A", "Ⱥ": "A", "Ɐ": "A", "Ꜳ": "AA", "Æ": "AE", "Ǽ": "AE", "Ǣ": "AE", "Ꜵ": "AO", "Ꜷ": "AU", "Ꜹ": "AV", "Ꜻ": "AV", "Ꜽ": "AY", "Ⓑ": "B", "Ｂ": "B", "Ḃ": "B", "Ḅ": "B", "Ḇ": "B", "Ƀ": "B", "Ƃ": "B", "Ɓ": "B", "Ⓒ": "C", "Ｃ": "C", "Ć": "C", "Ĉ": "C", "Ċ": "C", "Č": "C", "Ç": "C", "Ḉ": "C", "Ƈ": "C", "Ȼ": "C", "Ꜿ": "C", "Ⓓ": "D", "Ｄ": "D", "Ḋ": "D", "Ď": "D", "Ḍ": "D", "Ḑ": "D", "Ḓ": "D", "Ḏ": "D", "Đ": "D", "Ƌ": "D", "Ɗ": "D", "Ɖ": "D", "Ꝺ": "D", "Ǳ": "DZ", "Ǆ": "DZ", "ǲ": "Dz", "ǅ": "Dz", "Ⓔ": "E", "Ｅ": "E", "È": "E", "É": "E", "Ê": "E", "Ề": "E", "Ế": "E", "Ễ": "E", "Ể": "E", "Ẽ": "E", "Ē": "E", "Ḕ": "E", "Ḗ": "E", "Ĕ": "E", "Ė": "E", "Ë": "E", "Ẻ": "E", "Ě": "E", "Ȅ": "E", "Ȇ": "E", "Ẹ": "E", "Ệ": "E", "Ȩ": "E", "Ḝ": "E", "Ę": "E", "Ḙ": "E", "Ḛ": "E", "Ɛ": "E", "Ǝ": "E", "Ⓕ": "F", "Ｆ": "F", "Ḟ": "F", "Ƒ": "F", "Ꝼ": "F", "Ⓖ": "G", "Ｇ": "G", "Ǵ": "G", "Ĝ": "G", "Ḡ": "G", "Ğ": "G", "Ġ": "G", "Ǧ": "G", "Ģ": "G", "Ǥ": "G", "Ɠ": "G", "Ꞡ": "G", "Ᵹ": "G", "Ꝿ": "G", "Ⓗ": "H", "Ｈ": "H", "Ĥ": "H", "Ḣ": "H", "Ḧ": "H", "Ȟ": "H", "Ḥ": "H", "Ḩ": "H", "Ḫ": "H", "Ħ": "H", "Ⱨ": "H", "Ⱶ": "H", "Ɥ": "H", "Ⓘ": "I", "Ｉ": "I", "Ì": "I", "Í": "I", "Î": "I", "Ĩ": "I", "Ī": "I", "Ĭ": "I", "İ": "I", "Ï": "I", "Ḯ": "I", "Ỉ": "I", "Ǐ": "I", "Ȉ": "I", "Ȋ": "I", "Ị": "I", "Į": "I", "Ḭ": "I", "Ɨ": "I", "Ⓙ": "J", "Ｊ": "J", "Ĵ": "J", "Ɉ": "J", "Ⓚ": "K", "Ｋ": "K", "Ḱ": "K", "Ǩ": "K", "Ḳ": "K", "Ķ": "K", "Ḵ": "K", "Ƙ": "K", "Ⱪ": "K", "Ꝁ": "K", "Ꝃ": "K", "Ꝅ": "K", "Ꞣ": "K", "Ⓛ": "L", "Ｌ": "L", "Ŀ": "L", "Ĺ": "L", "Ľ": "L", "Ḷ": "L", "Ḹ": "L", "Ļ": "L", "Ḽ": "L", "Ḻ": "L", "Ł": "L", "Ƚ": "L", "Ɫ": "L", "Ⱡ": "L", "Ꝉ": "L", "Ꝇ": "L", "Ꞁ": "L", "Ǉ": "LJ", "ǈ": "Lj", "Ⓜ": "M", "Ｍ": "M", "Ḿ": "M", "Ṁ": "M", "Ṃ": "M", "Ɱ": "M", "Ɯ": "M", "Ⓝ": "N", "Ｎ": "N", "Ǹ": "N", "Ń": "N", "Ñ": "N", "Ṅ": "N", "Ň": "N", "Ṇ": "N", "Ņ": "N", "Ṋ": "N", "Ṉ": "N", "Ƞ": "N", "Ɲ": "N", "Ꞑ": "N", "Ꞥ": "N", "Ǌ": "NJ", "ǋ": "Nj", "Ⓞ": "O", "Ｏ": "O", "Ò": "O", "Ó": "O", "Ô": "O", "Ồ": "O", "Ố": "O", "Ỗ": "O", "Ổ": "O", "Õ": "O", "Ṍ": "O", "Ȭ": "O", "Ṏ": "O", "Ō": "O", "Ṑ": "O", "Ṓ": "O", "Ŏ": "O", "Ȯ": "O", "Ȱ": "O", "Ö": "O", "Ȫ": "O", "Ỏ": "O", "Ő": "O", "Ǒ": "O", "Ȍ": "O", "Ȏ": "O", "Ơ": "O", "Ờ": "O", "Ớ": "O", "Ỡ": "O", "Ở": "O", "Ợ": "O", "Ọ": "O", "Ộ": "O", "Ǫ": "O", "Ǭ": "O", "Ø": "O", "Ǿ": "O", "Ɔ": "O", "Ɵ": "O", "Ꝋ": "O", "Ꝍ": "O", "Ƣ": "OI", "Ꝏ": "OO", "Ȣ": "OU", "Ⓟ": "P", "Ｐ": "P", "Ṕ": "P", "Ṗ": "P", "Ƥ": "P", "Ᵽ": "P", "Ꝑ": "P", "Ꝓ": "P", "Ꝕ": "P", "Ⓠ": "Q", "Ｑ": "Q", "Ꝗ": "Q", "Ꝙ": "Q", "Ɋ": "Q", "Ⓡ": "R", "Ｒ": "R", "Ŕ": "R", "Ṙ": "R", "Ř": "R", "Ȑ": "R", "Ȓ": "R", "Ṛ": "R", "Ṝ": "R", "Ŗ": "R", "Ṟ": "R", "Ɍ": "R", "Ɽ": "R", "Ꝛ": "R", "Ꞧ": "R", "Ꞃ": "R", "Ⓢ": "S", "Ｓ": "S", "ẞ": "S", "Ś": "S", "Ṥ": "S", "Ŝ": "S", "Ṡ": "S", "Š": "S", "Ṧ": "S", "Ṣ": "S", "Ṩ": "S", "Ș": "S", "Ş": "S", "Ȿ": "S", "Ꞩ": "S", "Ꞅ": "S", "Ⓣ": "T", "Ｔ": "T", "Ṫ": "T", "Ť": "T", "Ṭ": "T", "Ț": "T", "Ţ": "T", "Ṱ": "T", "Ṯ": "T", "Ŧ": "T", "Ƭ": "T", "Ʈ": "T", "Ⱦ": "T", "Ꞇ": "T", "Ꜩ": "TZ", "Ⓤ": "U", "Ｕ": "U", "Ù": "U", "Ú": "U", "Û": "U", "Ũ": "U", "Ṹ": "U", "Ū": "U", "Ṻ": "U", "Ŭ": "U", "Ü": "U", "Ǜ": "U", "Ǘ": "U", "Ǖ": "U", "Ǚ": "U", "Ủ": "U", "Ů": "U", "Ű": "U", "Ǔ": "U", "Ȕ": "U", "Ȗ": "U", "Ư": "U", "Ừ": "U", "Ứ": "U", "Ữ": "U", "Ử": "U", "Ự": "U", "Ụ": "U", "Ṳ": "U", "Ų": "U", "Ṷ": "U", "Ṵ": "U", "Ʉ": "U", "Ⓥ": "V", "Ｖ": "V", "Ṽ": "V", "Ṿ": "V", "Ʋ": "V", "Ꝟ": "V", "Ʌ": "V", "Ꝡ": "VY", "Ⓦ": "W", "Ｗ": "W", "Ẁ": "W", "Ẃ": "W", "Ŵ": "W", "Ẇ": "W", "Ẅ": "W", "Ẉ": "W", "Ⱳ": "W", "Ⓧ": "X", "Ｘ": "X", "Ẋ": "X", "Ẍ": "X", "Ⓨ": "Y", "Ｙ": "Y", "Ỳ": "Y", "Ý": "Y", "Ŷ": "Y", "Ỹ": "Y", "Ȳ": "Y", "Ẏ": "Y", "Ÿ": "Y", "Ỷ": "Y", "Ỵ": "Y", "Ƴ": "Y", "Ɏ": "Y", "Ỿ": "Y", "Ⓩ": "Z", "Ｚ": "Z", "Ź": "Z", "Ẑ": "Z", "Ż": "Z", "Ž": "Z", "Ẓ": "Z", "Ẕ": "Z", "Ƶ": "Z", "Ȥ": "Z", "Ɀ": "Z", "Ⱬ": "Z", "Ꝣ": "Z", "ⓐ": "a", "ａ": "a", "ẚ": "a", "à": "a", "á": "a", "â": "a", "ầ": "a", "ấ": "a", "ẫ": "a", "ẩ": "a", "ã": "a", "ā": "a", "ă": "a", "ằ": "a", "ắ": "a", "ẵ": "a", "ẳ": "a", "ȧ": "a", "ǡ": "a", "ä": "a", "ǟ": "a", "ả": "a", "å": "a", "ǻ": "a", "ǎ": "a", "ȁ": "a", "ȃ": "a", "ạ": "a", "ậ": "a", "ặ": "a", "ḁ": "a", "ą": "a", "ⱥ": "a", "ɐ": "a", "ꜳ": "aa", "æ": "ae", "ǽ": "ae", "ǣ": "ae", "ꜵ": "ao", "ꜷ": "au", "ꜹ": "av", "ꜻ": "av", "ꜽ": "ay", "ⓑ": "b", "ｂ": "b", "ḃ": "b", "ḅ": "b", "ḇ": "b", "ƀ": "b", "ƃ": "b", "ɓ": "b", "ⓒ": "c", "ｃ": "c", "ć": "c", "ĉ": "c", "ċ": "c", "č": "c", "ç": "c", "ḉ": "c", "ƈ": "c", "ȼ": "c", "ꜿ": "c", "ↄ": "c", "ⓓ": "d", "ｄ": "d", "ḋ": "d", "ď": "d", "ḍ": "d", "ḑ": "d", "ḓ": "d", "ḏ": "d", "đ": "d", "ƌ": "d", "ɖ": "d", "ɗ": "d", "ꝺ": "d", "ǳ": "dz", "ǆ": "dz", "ⓔ": "e", "ｅ": "e", "è": "e", "é": "e", "ê": "e", "ề": "e", "ế": "e", "ễ": "e", "ể": "e", "ẽ": "e", "ē": "e", "ḕ": "e", "ḗ": "e", "ĕ": "e", "ė": "e", "ë": "e", "ẻ": "e", "ě": "e", "ȅ": "e", "ȇ": "e", "ẹ": "e", "ệ": "e", "ȩ": "e", "ḝ": "e", "ę": "e", "ḙ": "e", "ḛ": "e", "ɇ": "e", "ɛ": "e", "ǝ": "e", "ⓕ": "f", "ｆ": "f", "ḟ": "f", "ƒ": "f", "ꝼ": "f", "ⓖ": "g", "ｇ": "g", "ǵ": "g", "ĝ": "g", "ḡ": "g", "ğ": "g", "ġ": "g", "ǧ": "g", "ģ": "g", "ǥ": "g", "ɠ": "g", "ꞡ": "g", "ᵹ": "g", "ꝿ": "g", "ⓗ": "h", "ｈ": "h", "ĥ": "h", "ḣ": "h", "ḧ": "h", "ȟ": "h", "ḥ": "h", "ḩ": "h", "ḫ": "h", "ẖ": "h", "ħ": "h", "ⱨ": "h", "ⱶ": "h", "ɥ": "h", "ƕ": "hv", "ⓘ": "i", "ｉ": "i", "ì": "i", "í": "i", "î": "i", "ĩ": "i", "ī": "i", "ĭ": "i", "ï": "i", "ḯ": "i", "ỉ": "i", "ǐ": "i", "ȉ": "i", "ȋ": "i", "ị": "i", "į": "i", "ḭ": "i", "ɨ": "i", "ı": "i", "ⓙ": "j", "ｊ": "j", "ĵ": "j", "ǰ": "j", "ɉ": "j", "ⓚ": "k", "ｋ": "k", "ḱ": "k", "ǩ": "k", "ḳ": "k", "ķ": "k", "ḵ": "k", "ƙ": "k", "ⱪ": "k", "ꝁ": "k", "ꝃ": "k", "ꝅ": "k", "ꞣ": "k", "ⓛ": "l", "ｌ": "l", "ŀ": "l", "ĺ": "l", "ľ": "l", "ḷ": "l", "ḹ": "l", "ļ": "l", "ḽ": "l", "ḻ": "l", "ſ": "l", "ł": "l", "ƚ": "l", "ɫ": "l", "ⱡ": "l", "ꝉ": "l", "ꞁ": "l", "ꝇ": "l", "ǉ": "lj", "ⓜ": "m", "ｍ": "m", "ḿ": "m", "ṁ": "m", "ṃ": "m", "ɱ": "m", "ɯ": "m", "ⓝ": "n", "ｎ": "n", "ǹ": "n", "ń": "n", "ñ": "n", "ṅ": "n", "ň": "n", "ṇ": "n", "ņ": "n", "ṋ": "n", "ṉ": "n", "ƞ": "n", "ɲ": "n", "ŉ": "n", "ꞑ": "n", "ꞥ": "n", "ǌ": "nj", "ⓞ": "o", "ｏ": "o", "ò": "o", "ó": "o", "ô": "o", "ồ": "o", "ố": "o", "ỗ": "o", "ổ": "o", "õ": "o", "ṍ": "o", "ȭ": "o", "ṏ": "o", "ō": "o", "ṑ": "o", "ṓ": "o", "ŏ": "o", "ȯ": "o", "ȱ": "o", "ö": "o", "ȫ": "o", "ỏ": "o", "ő": "o", "ǒ": "o", "ȍ": "o", "ȏ": "o", "ơ": "o", "ờ": "o", "ớ": "o", "ỡ": "o", "ở": "o", "ợ": "o", "ọ": "o", "ộ": "o", "ǫ": "o", "ǭ": "o", "ø": "o", "ǿ": "o", "ɔ": "o", "ꝋ": "o", "ꝍ": "o", "ɵ": "o", "ƣ": "oi", "ȣ": "ou", "ꝏ": "oo", "ⓟ": "p", "ｐ": "p", "ṕ": "p", "ṗ": "p", "ƥ": "p", "ᵽ": "p", "ꝑ": "p", "ꝓ": "p", "ꝕ": "p", "ⓠ": "q", "ｑ": "q", "ɋ": "q", "ꝗ": "q", "ꝙ": "q", "ⓡ": "r", "ｒ": "r", "ŕ": "r", "ṙ": "r", "ř": "r", "ȑ": "r", "ȓ": "r", "ṛ": "r", "ṝ": "r", "ŗ": "r", "ṟ": "r", "ɍ": "r", "ɽ": "r", "ꝛ": "r", "ꞧ": "r", "ꞃ": "r", "ⓢ": "s", "ｓ": "s", "ß": "s", "ś": "s", "ṥ": "s", "ŝ": "s", "ṡ": "s", "š": "s", "ṧ": "s", "ṣ": "s", "ṩ": "s", "ș": "s", "ş": "s", "ȿ": "s", "ꞩ": "s", "ꞅ": "s", "ẛ": "s", "ⓣ": "t", "ｔ": "t", "ṫ": "t", "ẗ": "t", "ť": "t", "ṭ": "t", "ț": "t", "ţ": "t", "ṱ": "t", "ṯ": "t", "ŧ": "t", "ƭ": "t", "ʈ": "t", "ⱦ": "t", "ꞇ": "t", "ꜩ": "tz", "ⓤ": "u", "ｕ": "u", "ù": "u", "ú": "u", "û": "u", "ũ": "u", "ṹ": "u", "ū": "u", "ṻ": "u", "ŭ": "u", "ü": "u", "ǜ": "u", "ǘ": "u", "ǖ": "u", "ǚ": "u", "ủ": "u", "ů": "u", "ű": "u", "ǔ": "u", "ȕ": "u", "ȗ": "u", "ư": "u", "ừ": "u", "ứ": "u", "ữ": "u", "ử": "u", "ự": "u", "ụ": "u", "ṳ": "u", "ų": "u", "ṷ": "u", "ṵ": "u", "ʉ": "u", "ⓥ": "v", "ｖ": "v", "ṽ": "v", "ṿ": "v", "ʋ": "v", "ꝟ": "v", "ʌ": "v", "ꝡ": "vy", "ⓦ": "w", "ｗ": "w", "ẁ": "w", "ẃ": "w", "ŵ": "w", "ẇ": "w", "ẅ": "w", "ẘ": "w", "ẉ": "w", "ⱳ": "w", "ⓧ": "x", "ｘ": "x", "ẋ": "x", "ẍ": "x", "ⓨ": "y", "ｙ": "y", "ỳ": "y", "ý": "y", "ŷ": "y", "ỹ": "y", "ȳ": "y", "ẏ": "y", "ÿ": "y", "ỷ": "y", "ẙ": "y", "ỵ": "y", "ƴ": "y", "ɏ": "y", "ỿ": "y", "ⓩ": "z", "ｚ": "z", "ź": "z", "ẑ": "z", "ż": "z", "ž": "z", "ẓ": "z", "ẕ": "z", "ƶ": "z", "ȥ": "z", "ɀ": "z", "ⱬ": "z", "ꝣ": "z", "Ά": "Α", "Έ": "Ε", "Ή": "Η", "Ί": "Ι", "Ϊ": "Ι", "Ό": "Ο", "Ύ": "Υ", "Ϋ": "Υ", "Ώ": "Ω", "ά": "α", "έ": "ε", "ή": "η", "ί": "ι", "ϊ": "ι", "ΐ": "ι", "ό": "ο", "ύ": "υ", "ϋ": "υ", "ΰ": "υ", "ω": "ω", "ς": "σ" };
        }), b.define("select2/data/base", ["../utils"], function (a) {
            function b(a, c) {
                b.__super__.constructor.call(this);
            }return a.Extend(b, a.Observable), b.prototype.current = function (a) {
                throw new Error("The `current` method must be defined in child classes.");
            }, b.prototype.query = function (a, b) {
                throw new Error("The `query` method must be defined in child classes.");
            }, b.prototype.bind = function (a, b) {}, b.prototype.destroy = function () {}, b.prototype.generateResultId = function (b, c) {
                var d = b.id + "-result-";return d += a.generateChars(4), null != c.id ? d += "-" + c.id.toString() : d += "-" + a.generateChars(4), d;
            }, b;
        }), b.define("select2/data/select", ["./base", "../utils", "jquery"], function (a, b, c) {
            function d(a, b) {
                this.$element = a, this.options = b, d.__super__.constructor.call(this);
            }return b.Extend(d, a), d.prototype.current = function (a) {
                var b = [],
                    d = this;this.$element.find(":selected").each(function () {
                    var a = c(this),
                        e = d.item(a);b.push(e);
                }), a(b);
            }, d.prototype.select = function (a) {
                var b = this;if (a.selected = !0, c(a.element).is("option")) return a.element.selected = !0, void this.$element.trigger("change");if (this.$element.prop("multiple")) this.current(function (d) {
                    var e = [];a = [a], a.push.apply(a, d);for (var f = 0; f < a.length; f++) {
                        var g = a[f].id;-1 === c.inArray(g, e) && e.push(g);
                    }b.$element.val(e), b.$element.trigger("change");
                });else {
                    var d = a.id;this.$element.val(d), this.$element.trigger("change");
                }
            }, d.prototype.unselect = function (a) {
                var b = this;if (this.$element.prop("multiple")) {
                    if (a.selected = !1, c(a.element).is("option")) return a.element.selected = !1, void this.$element.trigger("change");this.current(function (d) {
                        for (var e = [], f = 0; f < d.length; f++) {
                            var g = d[f].id;g !== a.id && -1 === c.inArray(g, e) && e.push(g);
                        }b.$element.val(e), b.$element.trigger("change");
                    });
                }
            }, d.prototype.bind = function (a, b) {
                var c = this;this.container = a, a.on("select", function (a) {
                    c.select(a.data);
                }), a.on("unselect", function (a) {
                    c.unselect(a.data);
                });
            }, d.prototype.destroy = function () {
                this.$element.find("*").each(function () {
                    b.RemoveData(this);
                });
            }, d.prototype.query = function (a, b) {
                var d = [],
                    e = this;this.$element.children().each(function () {
                    var b = c(this);if (b.is("option") || b.is("optgroup")) {
                        var f = e.item(b),
                            g = e.matches(a, f);null !== g && d.push(g);
                    }
                }), b({ results: d });
            }, d.prototype.addOptions = function (a) {
                b.appendMany(this.$element, a);
            }, d.prototype.option = function (a) {
                var d;a.children ? (d = document.createElement("optgroup"), d.label = a.text) : (d = document.createElement("option"), void 0 !== d.textContent ? d.textContent = a.text : d.innerText = a.text), void 0 !== a.id && (d.value = a.id), a.disabled && (d.disabled = !0), a.selected && (d.selected = !0), a.title && (d.title = a.title);var e = c(d),
                    f = this._normalizeItem(a);return f.element = d, b.StoreData(d, "data", f), e;
            }, d.prototype.item = function (a) {
                var d = {};if (null != (d = b.GetData(a[0], "data"))) return d;if (a.is("option")) d = { id: a.val(), text: a.text(), disabled: a.prop("disabled"), selected: a.prop("selected"), title: a.prop("title") };else if (a.is("optgroup")) {
                    d = { text: a.prop("label"), children: [], title: a.prop("title") };for (var e = a.children("option"), f = [], g = 0; g < e.length; g++) {
                        var h = c(e[g]),
                            i = this.item(h);f.push(i);
                    }d.children = f;
                }return d = this._normalizeItem(d), d.element = a[0], b.StoreData(a[0], "data", d), d;
            }, d.prototype._normalizeItem = function (a) {
                a !== Object(a) && (a = { id: a, text: a }), a = c.extend({}, { text: "" }, a);var b = { selected: !1, disabled: !1 };return null != a.id && (a.id = a.id.toString()), null != a.text && (a.text = a.text.toString()), null == a._resultId && a.id && null != this.container && (a._resultId = this.generateResultId(this.container, a)), c.extend({}, b, a);
            }, d.prototype.matches = function (a, b) {
                return this.options.get("matcher")(a, b);
            }, d;
        }), b.define("select2/data/array", ["./select", "../utils", "jquery"], function (a, b, c) {
            function d(a, b) {
                var c = b.get("data") || [];d.__super__.constructor.call(this, a, b), this.addOptions(this.convertToOptions(c));
            }return b.Extend(d, a), d.prototype.select = function (a) {
                var b = this.$element.find("option").filter(function (b, c) {
                    return c.value == a.id.toString();
                });0 === b.length && (b = this.option(a), this.addOptions(b)), d.__super__.select.call(this, a);
            }, d.prototype.convertToOptions = function (a) {
                function d(a) {
                    return function () {
                        return c(this).val() == a.id;
                    };
                }for (var e = this, f = this.$element.find("option"), g = f.map(function () {
                    return e.item(c(this)).id;
                }).get(), h = [], i = 0; i < a.length; i++) {
                    var j = this._normalizeItem(a[i]);if (c.inArray(j.id, g) >= 0) {
                        var k = f.filter(d(j)),
                            l = this.item(k),
                            m = c.extend(!0, {}, j, l),
                            n = this.option(m);k.replaceWith(n);
                    } else {
                        var o = this.option(j);if (j.children) {
                            var p = this.convertToOptions(j.children);b.appendMany(o, p);
                        }h.push(o);
                    }
                }return h;
            }, d;
        }), b.define("select2/data/ajax", ["./array", "../utils", "jquery"], function (a, b, c) {
            function d(a, b) {
                this.ajaxOptions = this._applyDefaults(b.get("ajax")), null != this.ajaxOptions.processResults && (this.processResults = this.ajaxOptions.processResults), d.__super__.constructor.call(this, a, b);
            }return b.Extend(d, a), d.prototype._applyDefaults = function (a) {
                var b = { data: function data(a) {
                        return c.extend({}, a, { q: a.term });
                    }, transport: function transport(a, b, d) {
                        var e = c.ajax(a);return e.then(b), e.fail(d), e;
                    } };return c.extend({}, b, a, !0);
            }, d.prototype.processResults = function (a) {
                return a;
            }, d.prototype.query = function (a, b) {
                function d() {
                    var d = f.transport(f, function (d) {
                        var f = e.processResults(d, a);e.options.get("debug") && window.console && console.error && (f && f.results && c.isArray(f.results) || console.error("Select2: The AJAX results did not return an array in the `results` key of the response.")), b(f);
                    }, function () {
                        "status" in d && (0 === d.status || "0" === d.status) || e.trigger("results:message", { message: "errorLoading" });
                    });e._request = d;
                }var e = this;null != this._request && (c.isFunction(this._request.abort) && this._request.abort(), this._request = null);var f = c.extend({ type: "GET" }, this.ajaxOptions);"function" == typeof f.url && (f.url = f.url.call(this.$element, a)), "function" == typeof f.data && (f.data = f.data.call(this.$element, a)), this.ajaxOptions.delay && null != a.term ? (this._queryTimeout && window.clearTimeout(this._queryTimeout), this._queryTimeout = window.setTimeout(d, this.ajaxOptions.delay)) : d();
            }, d;
        }), b.define("select2/data/tags", ["jquery"], function (a) {
            function b(b, c, d) {
                var e = d.get("tags"),
                    f = d.get("createTag");void 0 !== f && (this.createTag = f);var g = d.get("insertTag");if (void 0 !== g && (this.insertTag = g), b.call(this, c, d), a.isArray(e)) for (var h = 0; h < e.length; h++) {
                    var i = e[h],
                        j = this._normalizeItem(i),
                        k = this.option(j);this.$element.append(k);
                }
            }return b.prototype.query = function (a, b, c) {
                function d(a, f) {
                    for (var g = a.results, h = 0; h < g.length; h++) {
                        var i = g[h],
                            j = null != i.children && !d({ results: i.children }, !0);if ((i.text || "").toUpperCase() === (b.term || "").toUpperCase() || j) return !f && (a.data = g, void c(a));
                    }if (f) return !0;var k = e.createTag(b);if (null != k) {
                        var l = e.option(k);l.attr("data-select2-tag", !0), e.addOptions([l]), e.insertTag(g, k);
                    }a.results = g, c(a);
                }var e = this;if (this._removeOldTags(), null == b.term || null != b.page) return void a.call(this, b, c);a.call(this, b, d);
            }, b.prototype.createTag = function (b, c) {
                var d = a.trim(c.term);return "" === d ? null : { id: d, text: d };
            }, b.prototype.insertTag = function (a, b, c) {
                b.unshift(c);
            }, b.prototype._removeOldTags = function (b) {
                this._lastTag;this.$element.find("option[data-select2-tag]").each(function () {
                    this.selected || a(this).remove();
                });
            }, b;
        }), b.define("select2/data/tokenizer", ["jquery"], function (a) {
            function b(a, b, c) {
                var d = c.get("tokenizer");void 0 !== d && (this.tokenizer = d), a.call(this, b, c);
            }return b.prototype.bind = function (a, b, c) {
                a.call(this, b, c), this.$search = b.dropdown.$search || b.selection.$search || c.find(".select2-search__field");
            }, b.prototype.query = function (b, c, d) {
                function e(b) {
                    var c = g._normalizeItem(b);if (!g.$element.find("option").filter(function () {
                        return a(this).val() === c.id;
                    }).length) {
                        var d = g.option(c);d.attr("data-select2-tag", !0), g._removeOldTags(), g.addOptions([d]);
                    }f(c);
                }function f(a) {
                    g.trigger("select", { data: a });
                }var g = this;c.term = c.term || "";var h = this.tokenizer(c, this.options, e);h.term !== c.term && (this.$search.length && (this.$search.val(h.term), this.$search.focus()), c.term = h.term), b.call(this, c, d);
            }, b.prototype.tokenizer = function (b, c, d, e) {
                for (var f = d.get("tokenSeparators") || [], g = c.term, h = 0, i = this.createTag || function (a) {
                    return { id: a.term, text: a.term };
                }; h < g.length;) {
                    var j = g[h];if (-1 !== a.inArray(j, f)) {
                        var k = g.substr(0, h),
                            l = a.extend({}, c, { term: k }),
                            m = i(l);null != m ? (e(m), g = g.substr(h + 1) || "", h = 0) : h++;
                    } else h++;
                }return { term: g };
            }, b;
        }), b.define("select2/data/minimumInputLength", [], function () {
            function a(a, b, c) {
                this.minimumInputLength = c.get("minimumInputLength"), a.call(this, b, c);
            }return a.prototype.query = function (a, b, c) {
                if (b.term = b.term || "", b.term.length < this.minimumInputLength) return void this.trigger("results:message", { message: "inputTooShort", args: { minimum: this.minimumInputLength, input: b.term, params: b } });a.call(this, b, c);
            }, a;
        }), b.define("select2/data/maximumInputLength", [], function () {
            function a(a, b, c) {
                this.maximumInputLength = c.get("maximumInputLength"), a.call(this, b, c);
            }return a.prototype.query = function (a, b, c) {
                if (b.term = b.term || "", this.maximumInputLength > 0 && b.term.length > this.maximumInputLength) return void this.trigger("results:message", { message: "inputTooLong", args: { maximum: this.maximumInputLength, input: b.term, params: b } });a.call(this, b, c);
            }, a;
        }), b.define("select2/data/maximumSelectionLength", [], function () {
            function a(a, b, c) {
                this.maximumSelectionLength = c.get("maximumSelectionLength"), a.call(this, b, c);
            }return a.prototype.query = function (a, b, c) {
                var d = this;this.current(function (e) {
                    var f = null != e ? e.length : 0;if (d.maximumSelectionLength > 0 && f >= d.maximumSelectionLength) return void d.trigger("results:message", { message: "maximumSelected", args: { maximum: d.maximumSelectionLength } });a.call(d, b, c);
                });
            }, a;
        }), b.define("select2/dropdown", ["jquery", "./utils"], function (a, b) {
            function c(a, b) {
                this.$element = a, this.options = b, c.__super__.constructor.call(this);
            }return b.Extend(c, b.Observable), c.prototype.render = function () {
                var b = a('<span class="select2-dropdown"><span class="select2-results"></span></span>');return b.attr("dir", this.options.get("dir")), this.$dropdown = b, b;
            }, c.prototype.bind = function () {}, c.prototype.position = function (a, b) {}, c.prototype.destroy = function () {
                this.$dropdown.remove();
            }, c;
        }), b.define("select2/dropdown/search", ["jquery", "../utils"], function (a, b) {
            function c() {}return c.prototype.render = function (b) {
                var c = b.call(this),
                    d = a('<span class="select2-search select2-search--dropdown"><input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" /></span>');return this.$searchContainer = d, this.$search = d.find("input"), c.prepend(d), c;
            }, c.prototype.bind = function (b, c, d) {
                var e = this;b.call(this, c, d), this.$search.on("keydown", function (a) {
                    e.trigger("keypress", a), e._keyUpPrevented = a.isDefaultPrevented();
                }), this.$search.on("input", function (b) {
                    a(this).off("keyup");
                }), this.$search.on("keyup input", function (a) {
                    e.handleSearch(a);
                }), c.on("open", function () {
                    e.$search.attr("tabindex", 0), e.$search.focus(), window.setTimeout(function () {
                        e.$search.focus();
                    }, 0);
                }), c.on("close", function () {
                    e.$search.attr("tabindex", -1), e.$search.val(""), e.$search.blur();
                }), c.on("focus", function () {
                    c.isOpen() || e.$search.focus();
                }), c.on("results:all", function (a) {
                    if (null == a.query.term || "" === a.query.term) {
                        e.showSearch(a) ? e.$searchContainer.removeClass("select2-search--hide") : e.$searchContainer.addClass("select2-search--hide");
                    }
                });
            }, c.prototype.handleSearch = function (a) {
                if (!this._keyUpPrevented) {
                    var b = this.$search.val();this.trigger("query", { term: b });
                }this._keyUpPrevented = !1;
            }, c.prototype.showSearch = function (a, b) {
                return !0;
            }, c;
        }), b.define("select2/dropdown/hidePlaceholder", [], function () {
            function a(a, b, c, d) {
                this.placeholder = this.normalizePlaceholder(c.get("placeholder")), a.call(this, b, c, d);
            }return a.prototype.append = function (a, b) {
                b.results = this.removePlaceholder(b.results), a.call(this, b);
            }, a.prototype.normalizePlaceholder = function (a, b) {
                return "string" == typeof b && (b = { id: "", text: b }), b;
            }, a.prototype.removePlaceholder = function (a, b) {
                for (var c = b.slice(0), d = b.length - 1; d >= 0; d--) {
                    var e = b[d];this.placeholder.id === e.id && c.splice(d, 1);
                }return c;
            }, a;
        }), b.define("select2/dropdown/infiniteScroll", ["jquery"], function (a) {
            function b(a, b, c, d) {
                this.lastParams = {}, a.call(this, b, c, d), this.$loadingMore = this.createLoadingMore(), this.loading = !1;
            }return b.prototype.append = function (a, b) {
                this.$loadingMore.remove(), this.loading = !1, a.call(this, b), this.showLoadingMore(b) && this.$results.append(this.$loadingMore);
            }, b.prototype.bind = function (b, c, d) {
                var e = this;b.call(this, c, d), c.on("query", function (a) {
                    e.lastParams = a, e.loading = !0;
                }), c.on("query:append", function (a) {
                    e.lastParams = a, e.loading = !0;
                }), this.$results.on("scroll", function () {
                    var b = a.contains(document.documentElement, e.$loadingMore[0]);if (!e.loading && b) {
                        e.$results.offset().top + e.$results.outerHeight(!1) + 50 >= e.$loadingMore.offset().top + e.$loadingMore.outerHeight(!1) && e.loadMore();
                    }
                });
            }, b.prototype.loadMore = function () {
                this.loading = !0;var b = a.extend({}, { page: 1 }, this.lastParams);b.page++, this.trigger("query:append", b);
            }, b.prototype.showLoadingMore = function (a, b) {
                return b.pagination && b.pagination.more;
            }, b.prototype.createLoadingMore = function () {
                var b = a('<li class="select2-results__option select2-results__option--load-more"role="treeitem" aria-disabled="true"></li>'),
                    c = this.options.get("translations").get("loadingMore");return b.html(c(this.lastParams)), b;
            }, b;
        }), b.define("select2/dropdown/attachBody", ["jquery", "../utils"], function (a, b) {
            function c(b, c, d) {
                this.$dropdownParent = d.get("dropdownParent") || a(document.body), b.call(this, c, d);
            }return c.prototype.bind = function (a, b, c) {
                var d = this,
                    e = !1;a.call(this, b, c), b.on("open", function () {
                    d._showDropdown(), d._attachPositioningHandler(b), e || (e = !0, b.on("results:all", function () {
                        d._positionDropdown(), d._resizeDropdown();
                    }), b.on("results:append", function () {
                        d._positionDropdown(), d._resizeDropdown();
                    }));
                }), b.on("close", function () {
                    d._hideDropdown(), d._detachPositioningHandler(b);
                }), this.$dropdownContainer.on("mousedown", function (a) {
                    a.stopPropagation();
                });
            }, c.prototype.destroy = function (a) {
                a.call(this), this.$dropdownContainer.remove();
            }, c.prototype.position = function (a, b, c) {
                b.attr("class", c.attr("class")), b.removeClass("select2"), b.addClass("select2-container--open"), b.css({ position: "absolute", top: -999999 }), this.$container = c;
            }, c.prototype.render = function (b) {
                var c = a("<span></span>"),
                    d = b.call(this);return c.append(d), this.$dropdownContainer = c, c;
            }, c.prototype._hideDropdown = function (a) {
                this.$dropdownContainer.detach();
            }, c.prototype._attachPositioningHandler = function (c, d) {
                var e = this,
                    f = "scroll.select2." + d.id,
                    g = "resize.select2." + d.id,
                    h = "orientationchange.select2." + d.id,
                    i = this.$container.parents().filter(b.hasScroll);i.each(function () {
                    b.StoreData(this, "select2-scroll-position", { x: a(this).scrollLeft(), y: a(this).scrollTop() });
                }), i.on(f, function (c) {
                    var d = b.GetData(this, "select2-scroll-position");a(this).scrollTop(d.y);
                }), a(window).on(f + " " + g + " " + h, function (a) {
                    e._positionDropdown(), e._resizeDropdown();
                });
            }, c.prototype._detachPositioningHandler = function (c, d) {
                var e = "scroll.select2." + d.id,
                    f = "resize.select2." + d.id,
                    g = "orientationchange.select2." + d.id;this.$container.parents().filter(b.hasScroll).off(e), a(window).off(e + " " + f + " " + g);
            }, c.prototype._positionDropdown = function () {
                var b = a(window),
                    c = this.$dropdown.hasClass("select2-dropdown--above"),
                    d = this.$dropdown.hasClass("select2-dropdown--below"),
                    e = null,
                    f = this.$container.offset();f.bottom = f.top + this.$container.outerHeight(!1);var g = { height: this.$container.outerHeight(!1) };g.top = f.top, g.bottom = f.top + g.height;var h = { height: this.$dropdown.outerHeight(!1) },
                    i = { top: b.scrollTop(), bottom: b.scrollTop() + b.height() },
                    j = i.top < f.top - h.height,
                    k = i.bottom > f.bottom + h.height,
                    l = { left: f.left, top: g.bottom },
                    m = this.$dropdownParent;"static" === m.css("position") && (m = m.offsetParent());var n = m.offset();l.top -= n.top, l.left -= n.left, c || d || (e = "below"), k || !j || c ? !j && k && c && (e = "below") : e = "above", ("above" == e || c && "below" !== e) && (l.top = g.top - n.top - h.height), null != e && (this.$dropdown.removeClass("select2-dropdown--below select2-dropdown--above").addClass("select2-dropdown--" + e), this.$container.removeClass("select2-container--below select2-container--above").addClass("select2-container--" + e)), this.$dropdownContainer.css(l);
            }, c.prototype._resizeDropdown = function () {
                var a = { width: this.$container.outerWidth(!1) + "px" };this.options.get("dropdownAutoWidth") && (a.minWidth = a.width, a.position = "relative", a.width = "auto"), this.$dropdown.css(a);
            }, c.prototype._showDropdown = function (a) {
                this.$dropdownContainer.appendTo(this.$dropdownParent), this._positionDropdown(), this._resizeDropdown();
            }, c;
        }), b.define("select2/dropdown/minimumResultsForSearch", [], function () {
            function a(b) {
                for (var c = 0, d = 0; d < b.length; d++) {
                    var e = b[d];e.children ? c += a(e.children) : c++;
                }return c;
            }function b(a, b, c, d) {
                this.minimumResultsForSearch = c.get("minimumResultsForSearch"), this.minimumResultsForSearch < 0 && (this.minimumResultsForSearch = 1 / 0), a.call(this, b, c, d);
            }return b.prototype.showSearch = function (b, c) {
                return !(a(c.data.results) < this.minimumResultsForSearch) && b.call(this, c);
            }, b;
        }), b.define("select2/dropdown/selectOnClose", ["../utils"], function (a) {
            function b() {}return b.prototype.bind = function (a, b, c) {
                var d = this;a.call(this, b, c), b.on("close", function (a) {
                    d._handleSelectOnClose(a);
                });
            }, b.prototype._handleSelectOnClose = function (b, c) {
                if (c && null != c.originalSelect2Event) {
                    var d = c.originalSelect2Event;if ("select" === d._type || "unselect" === d._type) return;
                }var e = this.getHighlightedResults();if (!(e.length < 1)) {
                    var f = a.GetData(e[0], "data");null != f.element && f.element.selected || null == f.element && f.selected || this.trigger("select", { data: f });
                }
            }, b;
        }), b.define("select2/dropdown/closeOnSelect", [], function () {
            function a() {}return a.prototype.bind = function (a, b, c) {
                var d = this;a.call(this, b, c), b.on("select", function (a) {
                    d._selectTriggered(a);
                }), b.on("unselect", function (a) {
                    d._selectTriggered(a);
                });
            }, a.prototype._selectTriggered = function (a, b) {
                var c = b.originalEvent;c && c.ctrlKey || this.trigger("close", { originalEvent: c, originalSelect2Event: b });
            }, a;
        }), b.define("select2/i18n/en", [], function () {
            return { errorLoading: function errorLoading() {
                    return "The results could not be loaded.";
                }, inputTooLong: function inputTooLong(a) {
                    var b = a.input.length - a.maximum,
                        c = "Please delete " + b + " character";return 1 != b && (c += "s"), c;
                }, inputTooShort: function inputTooShort(a) {
                    return "Please enter " + (a.minimum - a.input.length) + " or more characters";
                }, loadingMore: function loadingMore() {
                    return "Loading more results…";
                }, maximumSelected: function maximumSelected(a) {
                    var b = "You can only select " + a.maximum + " item";return 1 != a.maximum && (b += "s"), b;
                }, noResults: function noResults() {
                    return "No results found";
                }, searching: function searching() {
                    return "Searching…";
                } };
        }), b.define("select2/defaults", ["jquery", "require", "./results", "./selection/single", "./selection/multiple", "./selection/placeholder", "./selection/allowClear", "./selection/search", "./selection/eventRelay", "./utils", "./translation", "./diacritics", "./data/select", "./data/array", "./data/ajax", "./data/tags", "./data/tokenizer", "./data/minimumInputLength", "./data/maximumInputLength", "./data/maximumSelectionLength", "./dropdown", "./dropdown/search", "./dropdown/hidePlaceholder", "./dropdown/infiniteScroll", "./dropdown/attachBody", "./dropdown/minimumResultsForSearch", "./dropdown/selectOnClose", "./dropdown/closeOnSelect", "./i18n/en"], function (a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C) {
            function D() {
                this.reset();
            }return D.prototype.apply = function (l) {
                if (l = a.extend(!0, {}, this.defaults, l), null == l.dataAdapter) {
                    if (null != l.ajax ? l.dataAdapter = o : null != l.data ? l.dataAdapter = n : l.dataAdapter = m, l.minimumInputLength > 0 && (l.dataAdapter = j.Decorate(l.dataAdapter, r)), l.maximumInputLength > 0 && (l.dataAdapter = j.Decorate(l.dataAdapter, s)), l.maximumSelectionLength > 0 && (l.dataAdapter = j.Decorate(l.dataAdapter, t)), l.tags && (l.dataAdapter = j.Decorate(l.dataAdapter, p)), null == l.tokenSeparators && null == l.tokenizer || (l.dataAdapter = j.Decorate(l.dataAdapter, q)), null != l.query) {
                        var C = b(l.amdBase + "compat/query");l.dataAdapter = j.Decorate(l.dataAdapter, C);
                    }if (null != l.initSelection) {
                        var D = b(l.amdBase + "compat/initSelection");l.dataAdapter = j.Decorate(l.dataAdapter, D);
                    }
                }if (null == l.resultsAdapter && (l.resultsAdapter = c, null != l.ajax && (l.resultsAdapter = j.Decorate(l.resultsAdapter, x)), null != l.placeholder && (l.resultsAdapter = j.Decorate(l.resultsAdapter, w)), l.selectOnClose && (l.resultsAdapter = j.Decorate(l.resultsAdapter, A))), null == l.dropdownAdapter) {
                    if (l.multiple) l.dropdownAdapter = u;else {
                        var E = j.Decorate(u, v);l.dropdownAdapter = E;
                    }if (0 !== l.minimumResultsForSearch && (l.dropdownAdapter = j.Decorate(l.dropdownAdapter, z)), l.closeOnSelect && (l.dropdownAdapter = j.Decorate(l.dropdownAdapter, B)), null != l.dropdownCssClass || null != l.dropdownCss || null != l.adaptDropdownCssClass) {
                        var F = b(l.amdBase + "compat/dropdownCss");l.dropdownAdapter = j.Decorate(l.dropdownAdapter, F);
                    }l.dropdownAdapter = j.Decorate(l.dropdownAdapter, y);
                }if (null == l.selectionAdapter) {
                    if (l.multiple ? l.selectionAdapter = e : l.selectionAdapter = d, null != l.placeholder && (l.selectionAdapter = j.Decorate(l.selectionAdapter, f)), l.allowClear && (l.selectionAdapter = j.Decorate(l.selectionAdapter, g)), l.multiple && (l.selectionAdapter = j.Decorate(l.selectionAdapter, h)), null != l.containerCssClass || null != l.containerCss || null != l.adaptContainerCssClass) {
                        var G = b(l.amdBase + "compat/containerCss");l.selectionAdapter = j.Decorate(l.selectionAdapter, G);
                    }l.selectionAdapter = j.Decorate(l.selectionAdapter, i);
                }if ("string" == typeof l.language) if (l.language.indexOf("-") > 0) {
                    var H = l.language.split("-"),
                        I = H[0];l.language = [l.language, I];
                } else l.language = [l.language];if (a.isArray(l.language)) {
                    var J = new k();l.language.push("en");for (var K = l.language, L = 0; L < K.length; L++) {
                        var M = K[L],
                            N = {};try {
                            N = k.loadPath(M);
                        } catch (a) {
                            try {
                                M = this.defaults.amdLanguageBase + M, N = k.loadPath(M);
                            } catch (a) {
                                l.debug && window.console && console.warn && console.warn('Select2: The language file for "' + M + '" could not be automatically loaded. A fallback will be used instead.');continue;
                            }
                        }J.extend(N);
                    }l.translations = J;
                } else {
                    var O = k.loadPath(this.defaults.amdLanguageBase + "en"),
                        P = new k(l.language);P.extend(O), l.translations = P;
                }return l;
            }, D.prototype.reset = function () {
                function b(a) {
                    function b(a) {
                        return l[a] || a;
                    }return a.replace(/[^\u0000-\u007E]/g, b);
                }function c(d, e) {
                    if ("" === a.trim(d.term)) return e;if (e.children && e.children.length > 0) {
                        for (var f = a.extend(!0, {}, e), g = e.children.length - 1; g >= 0; g--) {
                            null == c(d, e.children[g]) && f.children.splice(g, 1);
                        }return f.children.length > 0 ? f : c(d, f);
                    }var h = b(e.text).toUpperCase(),
                        i = b(d.term).toUpperCase();return h.indexOf(i) > -1 ? e : null;
                }this.defaults = { amdBase: "./", amdLanguageBase: "./i18n/", closeOnSelect: !0, debug: !1, dropdownAutoWidth: !1, escapeMarkup: j.escapeMarkup, language: C, matcher: c, minimumInputLength: 0, maximumInputLength: 0, maximumSelectionLength: 0, minimumResultsForSearch: 0, selectOnClose: !1, sorter: function sorter(a) {
                        return a;
                    }, templateResult: function templateResult(a) {
                        return a.text;
                    }, templateSelection: function templateSelection(a) {
                        return a.text;
                    }, theme: "default", width: "resolve" };
            }, D.prototype.set = function (b, c) {
                var d = a.camelCase(b),
                    e = {};e[d] = c;var f = j._convertData(e);a.extend(!0, this.defaults, f);
            }, new D();
        }), b.define("select2/options", ["require", "jquery", "./defaults", "./utils"], function (a, b, c, d) {
            function e(b, e) {
                if (this.options = b, null != e && this.fromElement(e), this.options = c.apply(this.options), e && e.is("input")) {
                    var f = a(this.get("amdBase") + "compat/inputData");this.options.dataAdapter = d.Decorate(this.options.dataAdapter, f);
                }
            }return e.prototype.fromElement = function (a) {
                var c = ["select2"];null == this.options.multiple && (this.options.multiple = a.prop("multiple")), null == this.options.disabled && (this.options.disabled = a.prop("disabled")), null == this.options.language && (a.prop("lang") ? this.options.language = a.prop("lang").toLowerCase() : a.closest("[lang]").prop("lang") && (this.options.language = a.closest("[lang]").prop("lang"))), null == this.options.dir && (a.prop("dir") ? this.options.dir = a.prop("dir") : a.closest("[dir]").prop("dir") ? this.options.dir = a.closest("[dir]").prop("dir") : this.options.dir = "ltr"), a.prop("disabled", this.options.disabled), a.prop("multiple", this.options.multiple), d.GetData(a[0], "select2Tags") && (this.options.debug && window.console && console.warn && console.warn('Select2: The `data-select2-tags` attribute has been changed to use the `data-data` and `data-tags="true"` attributes and will be removed in future versions of Select2.'), d.StoreData(a[0], "data", d.GetData(a[0], "select2Tags")), d.StoreData(a[0], "tags", !0)), d.GetData(a[0], "ajaxUrl") && (this.options.debug && window.console && console.warn && console.warn("Select2: The `data-ajax-url` attribute has been changed to `data-ajax--url` and support for the old attribute will be removed in future versions of Select2."), a.attr("ajax--url", d.GetData(a[0], "ajaxUrl")), d.StoreData(a[0], "ajax-Url", d.GetData(a[0], "ajaxUrl")));var e = {};e = b.fn.jquery && "1." == b.fn.jquery.substr(0, 2) && a[0].dataset ? b.extend(!0, {}, a[0].dataset, d.GetData(a[0])) : d.GetData(a[0]);var f = b.extend(!0, {}, e);f = d._convertData(f);for (var g in f) {
                    b.inArray(g, c) > -1 || (b.isPlainObject(this.options[g]) ? b.extend(this.options[g], f[g]) : this.options[g] = f[g]);
                }return this;
            }, e.prototype.get = function (a) {
                return this.options[a];
            }, e.prototype.set = function (a, b) {
                this.options[a] = b;
            }, e;
        }), b.define("select2/core", ["jquery", "./options", "./utils", "./keys"], function (a, b, c, d) {
            var e = function e(a, d) {
                null != c.GetData(a[0], "select2") && c.GetData(a[0], "select2").destroy(), this.$element = a, this.id = this._generateId(a), d = d || {}, this.options = new b(d, a), e.__super__.constructor.call(this);var f = a.attr("tabindex") || 0;c.StoreData(a[0], "old-tabindex", f), a.attr("tabindex", "-1");var g = this.options.get("dataAdapter");this.dataAdapter = new g(a, this.options);var h = this.render();this._placeContainer(h);var i = this.options.get("selectionAdapter");this.selection = new i(a, this.options), this.$selection = this.selection.render(), this.selection.position(this.$selection, h);var j = this.options.get("dropdownAdapter");this.dropdown = new j(a, this.options), this.$dropdown = this.dropdown.render(), this.dropdown.position(this.$dropdown, h);var k = this.options.get("resultsAdapter");this.results = new k(a, this.options, this.dataAdapter), this.$results = this.results.render(), this.results.position(this.$results, this.$dropdown);var l = this;this._bindAdapters(), this._registerDomEvents(), this._registerDataEvents(), this._registerSelectionEvents(), this._registerDropdownEvents(), this._registerResultsEvents(), this._registerEvents(), this.dataAdapter.current(function (a) {
                    l.trigger("selection:update", { data: a });
                }), a.addClass("select2-hidden-accessible"), a.attr("aria-hidden", "true"), this._syncAttributes(), c.StoreData(a[0], "select2", this), a.data("select2", this);
            };return c.Extend(e, c.Observable), e.prototype._generateId = function (a) {
                var b = "";return b = null != a.attr("id") ? a.attr("id") : null != a.attr("name") ? a.attr("name") + "-" + c.generateChars(2) : c.generateChars(4), b = b.replace(/(:|\.|\[|\]|,)/g, ""), b = "select2-" + b;
            }, e.prototype._placeContainer = function (a) {
                a.insertAfter(this.$element);var b = this._resolveWidth(this.$element, this.options.get("width"));null != b && a.css("width", b);
            }, e.prototype._resolveWidth = function (a, b) {
                var c = /^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i;if ("resolve" == b) {
                    var d = this._resolveWidth(a, "style");return null != d ? d : this._resolveWidth(a, "element");
                }if ("element" == b) {
                    var e = a.outerWidth(!1);return e <= 0 ? "auto" : e + "px";
                }if ("style" == b) {
                    var f = a.attr("style");if ("string" != typeof f) return null;for (var g = f.split(";"), h = 0, i = g.length; h < i; h += 1) {
                        var j = g[h].replace(/\s/g, ""),
                            k = j.match(c);if (null !== k && k.length >= 1) return k[1];
                    }return null;
                }return b;
            }, e.prototype._bindAdapters = function () {
                this.dataAdapter.bind(this, this.$container), this.selection.bind(this, this.$container), this.dropdown.bind(this, this.$container), this.results.bind(this, this.$container);
            }, e.prototype._registerDomEvents = function () {
                var b = this;this.$element.on("change.select2", function () {
                    b.dataAdapter.current(function (a) {
                        b.trigger("selection:update", { data: a });
                    });
                }), this.$element.on("focus.select2", function (a) {
                    b.trigger("focus", a);
                }), this._syncA = c.bind(this._syncAttributes, this), this._syncS = c.bind(this._syncSubtree, this), this.$element[0].attachEvent && this.$element[0].attachEvent("onpropertychange", this._syncA);var d = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;null != d ? (this._observer = new d(function (c) {
                    a.each(c, b._syncA), a.each(c, b._syncS);
                }), this._observer.observe(this.$element[0], { attributes: !0, childList: !0, subtree: !1 })) : this.$element[0].addEventListener && (this.$element[0].addEventListener("DOMAttrModified", b._syncA, !1), this.$element[0].addEventListener("DOMNodeInserted", b._syncS, !1), this.$element[0].addEventListener("DOMNodeRemoved", b._syncS, !1));
            }, e.prototype._registerDataEvents = function () {
                var a = this;this.dataAdapter.on("*", function (b, c) {
                    a.trigger(b, c);
                });
            }, e.prototype._registerSelectionEvents = function () {
                var b = this,
                    c = ["toggle", "focus"];this.selection.on("toggle", function () {
                    b.toggleDropdown();
                }), this.selection.on("focus", function (a) {
                    b.focus(a);
                }), this.selection.on("*", function (d, e) {
                    -1 === a.inArray(d, c) && b.trigger(d, e);
                });
            }, e.prototype._registerDropdownEvents = function () {
                var a = this;this.dropdown.on("*", function (b, c) {
                    a.trigger(b, c);
                });
            }, e.prototype._registerResultsEvents = function () {
                var a = this;this.results.on("*", function (b, c) {
                    a.trigger(b, c);
                });
            }, e.prototype._registerEvents = function () {
                var a = this;this.on("open", function () {
                    a.$container.addClass("select2-container--open");
                }), this.on("close", function () {
                    a.$container.removeClass("select2-container--open");
                }), this.on("enable", function () {
                    a.$container.removeClass("select2-container--disabled");
                }), this.on("disable", function () {
                    a.$container.addClass("select2-container--disabled");
                }), this.on("blur", function () {
                    a.$container.removeClass("select2-container--focus");
                }), this.on("query", function (b) {
                    a.isOpen() || a.trigger("open", {}), this.dataAdapter.query(b, function (c) {
                        a.trigger("results:all", { data: c, query: b });
                    });
                }), this.on("query:append", function (b) {
                    this.dataAdapter.query(b, function (c) {
                        a.trigger("results:append", { data: c, query: b });
                    });
                }), this.on("keypress", function (b) {
                    var c = b.which;a.isOpen() ? c === d.ESC || c === d.TAB || c === d.UP && b.altKey ? (a.close(), b.preventDefault()) : c === d.ENTER ? (a.trigger("results:select", {}), b.preventDefault()) : c === d.SPACE && b.ctrlKey ? (a.trigger("results:toggle", {}), b.preventDefault()) : c === d.UP ? (a.trigger("results:previous", {}), b.preventDefault()) : c === d.DOWN && (a.trigger("results:next", {}), b.preventDefault()) : (c === d.ENTER || c === d.SPACE || c === d.DOWN && b.altKey) && (a.open(), b.preventDefault());
                });
            }, e.prototype._syncAttributes = function () {
                this.options.set("disabled", this.$element.prop("disabled")), this.options.get("disabled") ? (this.isOpen() && this.close(), this.trigger("disable", {})) : this.trigger("enable", {});
            }, e.prototype._syncSubtree = function (a, b) {
                var c = !1,
                    d = this;if (!a || !a.target || "OPTION" === a.target.nodeName || "OPTGROUP" === a.target.nodeName) {
                    if (b) {
                        if (b.addedNodes && b.addedNodes.length > 0) for (var e = 0; e < b.addedNodes.length; e++) {
                            var f = b.addedNodes[e];f.selected && (c = !0);
                        } else b.removedNodes && b.removedNodes.length > 0 && (c = !0);
                    } else c = !0;c && this.dataAdapter.current(function (a) {
                        d.trigger("selection:update", { data: a });
                    });
                }
            }, e.prototype.trigger = function (a, b) {
                var c = e.__super__.trigger,
                    d = { open: "opening", close: "closing", select: "selecting", unselect: "unselecting", clear: "clearing" };if (void 0 === b && (b = {}), a in d) {
                    var f = d[a],
                        g = { prevented: !1, name: a, args: b };if (c.call(this, f, g), g.prevented) return void (b.prevented = !0);
                }c.call(this, a, b);
            }, e.prototype.toggleDropdown = function () {
                this.options.get("disabled") || (this.isOpen() ? this.close() : this.open());
            }, e.prototype.open = function () {
                this.isOpen() || this.trigger("query", {});
            }, e.prototype.close = function () {
                this.isOpen() && this.trigger("close", {});
            }, e.prototype.isOpen = function () {
                return this.$container.hasClass("select2-container--open");
            }, e.prototype.hasFocus = function () {
                return this.$container.hasClass("select2-container--focus");
            }, e.prototype.focus = function (a) {
                this.hasFocus() || (this.$container.addClass("select2-container--focus"), this.trigger("focus", {}));
            }, e.prototype.enable = function (a) {
                this.options.get("debug") && window.console && console.warn && console.warn('Select2: The `select2("enable")` method has been deprecated and will be removed in later Select2 versions. Use $element.prop("disabled") instead.'), null != a && 0 !== a.length || (a = [!0]);var b = !a[0];this.$element.prop("disabled", b);
            }, e.prototype.data = function () {
                this.options.get("debug") && arguments.length > 0 && window.console && console.warn && console.warn('Select2: Data can no longer be set using `select2("data")`. You should consider setting the value instead using `$element.val()`.');var a = [];return this.dataAdapter.current(function (b) {
                    a = b;
                }), a;
            }, e.prototype.val = function (b) {
                if (this.options.get("debug") && window.console && console.warn && console.warn('Select2: The `select2("val")` method has been deprecated and will be removed in later Select2 versions. Use $element.val() instead.'), null == b || 0 === b.length) return this.$element.val();var c = b[0];a.isArray(c) && (c = a.map(c, function (a) {
                    return a.toString();
                })), this.$element.val(c).trigger("change");
            }, e.prototype.destroy = function () {
                this.$container.remove(), this.$element[0].detachEvent && this.$element[0].detachEvent("onpropertychange", this._syncA), null != this._observer ? (this._observer.disconnect(), this._observer = null) : this.$element[0].removeEventListener && (this.$element[0].removeEventListener("DOMAttrModified", this._syncA, !1), this.$element[0].removeEventListener("DOMNodeInserted", this._syncS, !1), this.$element[0].removeEventListener("DOMNodeRemoved", this._syncS, !1)), this._syncA = null, this._syncS = null, this.$element.off(".select2"), this.$element.attr("tabindex", c.GetData(this.$element[0], "old-tabindex")), this.$element.removeClass("select2-hidden-accessible"), this.$element.attr("aria-hidden", "false"), c.RemoveData(this.$element[0]), this.$element.removeData("select2"), this.dataAdapter.destroy(), this.selection.destroy(), this.dropdown.destroy(), this.results.destroy(), this.dataAdapter = null, this.selection = null, this.dropdown = null, this.results = null;
            }, e.prototype.render = function () {
                var b = a('<span class="select2 select2-container"><span class="selection"></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>');return b.attr("dir", this.options.get("dir")), this.$container = b, this.$container.addClass("select2-container--" + this.options.get("theme")), c.StoreData(b[0], "element", this.$element), b;
            }, e;
        }), b.define("select2/compat/utils", ["jquery"], function (a) {
            function b(b, c, d) {
                var e,
                    f,
                    g = [];e = a.trim(b.attr("class")), e && (e = "" + e, a(e.split(/\s+/)).each(function () {
                    0 === this.indexOf("select2-") && g.push(this);
                })), e = a.trim(c.attr("class")), e && (e = "" + e, a(e.split(/\s+/)).each(function () {
                    0 !== this.indexOf("select2-") && null != (f = d(this)) && g.push(f);
                })), b.attr("class", g.join(" "));
            }return { syncCssClasses: b };
        }), b.define("select2/compat/containerCss", ["jquery", "./utils"], function (a, b) {
            function c(a) {
                return null;
            }function d() {}return d.prototype.render = function (d) {
                var e = d.call(this),
                    f = this.options.get("containerCssClass") || "";a.isFunction(f) && (f = f(this.$element));var g = this.options.get("adaptContainerCssClass");if (g = g || c, -1 !== f.indexOf(":all:")) {
                    f = f.replace(":all:", "");var h = g;g = function g(a) {
                        var b = h(a);return null != b ? b + " " + a : a;
                    };
                }var i = this.options.get("containerCss") || {};return a.isFunction(i) && (i = i(this.$element)), b.syncCssClasses(e, this.$element, g), e.css(i), e.addClass(f), e;
            }, d;
        }), b.define("select2/compat/dropdownCss", ["jquery", "./utils"], function (a, b) {
            function c(a) {
                return null;
            }function d() {}return d.prototype.render = function (d) {
                var e = d.call(this),
                    f = this.options.get("dropdownCssClass") || "";a.isFunction(f) && (f = f(this.$element));var g = this.options.get("adaptDropdownCssClass");if (g = g || c, -1 !== f.indexOf(":all:")) {
                    f = f.replace(":all:", "");var h = g;g = function g(a) {
                        var b = h(a);return null != b ? b + " " + a : a;
                    };
                }var i = this.options.get("dropdownCss") || {};return a.isFunction(i) && (i = i(this.$element)), b.syncCssClasses(e, this.$element, g), e.css(i), e.addClass(f), e;
            }, d;
        }), b.define("select2/compat/initSelection", ["jquery"], function (a) {
            function b(a, b, c) {
                c.get("debug") && window.console && console.warn && console.warn("Select2: The `initSelection` option has been deprecated in favor of a custom data adapter that overrides the `current` method. This method is now called multiple times instead of a single time when the instance is initialized. Support will be removed for the `initSelection` option in future versions of Select2"), this.initSelection = c.get("initSelection"), this._isInitialized = !1, a.call(this, b, c);
            }return b.prototype.current = function (b, c) {
                var d = this;if (this._isInitialized) return void b.call(this, c);this.initSelection.call(null, this.$element, function (b) {
                    d._isInitialized = !0, a.isArray(b) || (b = [b]), c(b);
                });
            }, b;
        }), b.define("select2/compat/inputData", ["jquery", "../utils"], function (a, b) {
            function c(a, b, c) {
                this._currentData = [], this._valueSeparator = c.get("valueSeparator") || ",", "hidden" === b.prop("type") && c.get("debug") && console && console.warn && console.warn("Select2: Using a hidden input with Select2 is no longer supported and may stop working in the future. It is recommended to use a `<select>` element instead."), a.call(this, b, c);
            }return c.prototype.current = function (b, c) {
                function d(b, c) {
                    var e = [];return b.selected || -1 !== a.inArray(b.id, c) ? (b.selected = !0, e.push(b)) : b.selected = !1, b.children && e.push.apply(e, d(b.children, c)), e;
                }for (var e = [], f = 0; f < this._currentData.length; f++) {
                    var g = this._currentData[f];e.push.apply(e, d(g, this.$element.val().split(this._valueSeparator)));
                }c(e);
            }, c.prototype.select = function (b, c) {
                if (this.options.get("multiple")) {
                    var d = this.$element.val();d += this._valueSeparator + c.id, this.$element.val(d), this.$element.trigger("change");
                } else this.current(function (b) {
                    a.map(b, function (a) {
                        a.selected = !1;
                    });
                }), this.$element.val(c.id), this.$element.trigger("change");
            }, c.prototype.unselect = function (a, b) {
                var c = this;b.selected = !1, this.current(function (a) {
                    for (var d = [], e = 0; e < a.length; e++) {
                        var f = a[e];b.id != f.id && d.push(f.id);
                    }c.$element.val(d.join(c._valueSeparator)), c.$element.trigger("change");
                });
            }, c.prototype.query = function (a, b, c) {
                for (var d = [], e = 0; e < this._currentData.length; e++) {
                    var f = this._currentData[e],
                        g = this.matches(b, f);null !== g && d.push(g);
                }c({ results: d });
            }, c.prototype.addOptions = function (c, d) {
                var e = a.map(d, function (a) {
                    return b.GetData(a[0], "data");
                });this._currentData.push.apply(this._currentData, e);
            }, c;
        }), b.define("select2/compat/matcher", ["jquery"], function (a) {
            function b(b) {
                function c(c, d) {
                    var e = a.extend(!0, {}, d);if (null == c.term || "" === a.trim(c.term)) return e;if (d.children) {
                        for (var f = d.children.length - 1; f >= 0; f--) {
                            var g = d.children[f];b(c.term, g.text, g) || e.children.splice(f, 1);
                        }if (e.children.length > 0) return e;
                    }return b(c.term, d.text, d) ? e : null;
                }return c;
            }return b;
        }), b.define("select2/compat/query", [], function () {
            function a(a, b, c) {
                c.get("debug") && window.console && console.warn && console.warn("Select2: The `query` option has been deprecated in favor of a custom data adapter that overrides the `query` method. Support will be removed for the `query` option in future versions of Select2."), a.call(this, b, c);
            }return a.prototype.query = function (a, b, c) {
                b.callback = c, this.options.get("query").call(null, b);
            }, a;
        }), b.define("select2/dropdown/attachContainer", [], function () {
            function a(a, b, c) {
                a.call(this, b, c);
            }return a.prototype.position = function (a, b, c) {
                c.find(".dropdown-wrapper").append(b), b.addClass("select2-dropdown--below"), c.addClass("select2-container--below");
            }, a;
        }), b.define("select2/dropdown/stopPropagation", [], function () {
            function a() {}return a.prototype.bind = function (a, b, c) {
                a.call(this, b, c);var d = ["blur", "change", "click", "dblclick", "focus", "focusin", "focusout", "input", "keydown", "keyup", "keypress", "mousedown", "mouseenter", "mouseleave", "mousemove", "mouseover", "mouseup", "search", "touchend", "touchstart"];this.$dropdown.on(d.join(" "), function (a) {
                    a.stopPropagation();
                });
            }, a;
        }), b.define("select2/selection/stopPropagation", [], function () {
            function a() {}return a.prototype.bind = function (a, b, c) {
                a.call(this, b, c);var d = ["blur", "change", "click", "dblclick", "focus", "focusin", "focusout", "input", "keydown", "keyup", "keypress", "mousedown", "mouseenter", "mouseleave", "mousemove", "mouseover", "mouseup", "search", "touchend", "touchstart"];this.$selection.on(d.join(" "), function (a) {
                    a.stopPropagation();
                });
            }, a;
        }), function (c) {
            "function" == typeof b.define && b.define.amd ? b.define("jquery-mousewheel", ["jquery"], c) : "object" == (typeof exports === "undefined" ? "undefined" : _typeof(exports)) ? module.exports = c : c(a);
        }(function (a) {
            function b(b) {
                var g = b || window.event,
                    h = i.call(arguments, 1),
                    j = 0,
                    l = 0,
                    m = 0,
                    n = 0,
                    o = 0,
                    p = 0;if (b = a.event.fix(g), b.type = "mousewheel", "detail" in g && (m = -1 * g.detail), "wheelDelta" in g && (m = g.wheelDelta), "wheelDeltaY" in g && (m = g.wheelDeltaY), "wheelDeltaX" in g && (l = -1 * g.wheelDeltaX), "axis" in g && g.axis === g.HORIZONTAL_AXIS && (l = -1 * m, m = 0), j = 0 === m ? l : m, "deltaY" in g && (m = -1 * g.deltaY, j = m), "deltaX" in g && (l = g.deltaX, 0 === m && (j = -1 * l)), 0 !== m || 0 !== l) {
                    if (1 === g.deltaMode) {
                        var q = a.data(this, "mousewheel-line-height");j *= q, m *= q, l *= q;
                    } else if (2 === g.deltaMode) {
                        var r = a.data(this, "mousewheel-page-height");j *= r, m *= r, l *= r;
                    }if (n = Math.max(Math.abs(m), Math.abs(l)), (!f || n < f) && (f = n, d(g, n) && (f /= 40)), d(g, n) && (j /= 40, l /= 40, m /= 40), j = Math[j >= 1 ? "floor" : "ceil"](j / f), l = Math[l >= 1 ? "floor" : "ceil"](l / f), m = Math[m >= 1 ? "floor" : "ceil"](m / f), k.settings.normalizeOffset && this.getBoundingClientRect) {
                        var s = this.getBoundingClientRect();o = b.clientX - s.left, p = b.clientY - s.top;
                    }return b.deltaX = l, b.deltaY = m, b.deltaFactor = f, b.offsetX = o, b.offsetY = p, b.deltaMode = 0, h.unshift(b, j, l, m), e && clearTimeout(e), e = setTimeout(c, 200), (a.event.dispatch || a.event.handle).apply(this, h);
                }
            }function c() {
                f = null;
            }function d(a, b) {
                return k.settings.adjustOldDeltas && "mousewheel" === a.type && b % 120 == 0;
            }var e,
                f,
                g = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
                h = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
                i = Array.prototype.slice;if (a.event.fixHooks) for (var j = g.length; j;) {
                a.event.fixHooks[g[--j]] = a.event.mouseHooks;
            }var k = a.event.special.mousewheel = { version: "3.1.12", setup: function setup() {
                    if (this.addEventListener) for (var c = h.length; c;) {
                        this.addEventListener(h[--c], b, !1);
                    } else this.onmousewheel = b;a.data(this, "mousewheel-line-height", k.getLineHeight(this)), a.data(this, "mousewheel-page-height", k.getPageHeight(this));
                }, teardown: function teardown() {
                    if (this.removeEventListener) for (var c = h.length; c;) {
                        this.removeEventListener(h[--c], b, !1);
                    } else this.onmousewheel = null;a.removeData(this, "mousewheel-line-height"), a.removeData(this, "mousewheel-page-height");
                }, getLineHeight: function getLineHeight(b) {
                    var c = a(b),
                        d = c["offsetParent" in a.fn ? "offsetParent" : "parent"]();return d.length || (d = a("body")), parseInt(d.css("fontSize"), 10) || parseInt(c.css("fontSize"), 10) || 16;
                }, getPageHeight: function getPageHeight(b) {
                    return a(b).height();
                }, settings: { adjustOldDeltas: !0, normalizeOffset: !0 } };a.fn.extend({ mousewheel: function mousewheel(a) {
                    return a ? this.bind("mousewheel", a) : this.trigger("mousewheel");
                }, unmousewheel: function unmousewheel(a) {
                    return this.unbind("mousewheel", a);
                } });
        }), b.define("jquery.select2", ["jquery", "jquery-mousewheel", "./select2/core", "./select2/defaults", "./select2/utils"], function (a, b, c, d, e) {
            if (null == a.fn.select2) {
                var f = ["open", "close", "destroy"];a.fn.select2 = function (b) {
                    if ("object" == _typeof(b = b || {})) return this.each(function () {
                        var d = a.extend(!0, {}, b);new c(a(this), d);
                    }), this;if ("string" == typeof b) {
                        var d,
                            g = Array.prototype.slice.call(arguments, 1);return this.each(function () {
                            var a = e.GetData(this, "select2");null == a && window.console && console.error && console.error("The select2('" + b + "') method was called on an element that is not using Select2."), d = a[b].apply(a, g);
                        }), a.inArray(b, f) > -1 ? this : d;
                    }throw new Error("Invalid arguments for Select2: " + b);
                };
            }return null == a.fn.select2.defaults && (a.fn.select2.defaults = d), c;
        }), { define: b.define, require: b.require };
    }(),
        c = b.require("jquery.select2");return a.fn.select2.amd = b, c;
});
/*!
  * Bootstrap v4.1.3 (https://getbootstrap.com/)
  * Copyright 2011-2018 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
  */
!function (e, t) {
    "object" == (typeof exports === "undefined" ? "undefined" : _typeof(exports)) && "undefined" != typeof module ? t(exports, require("jquery")) : "function" == typeof define && define.amd ? define(["exports", "jquery"], t) : t(e.bootstrap = {}, e.jQuery);
}(this, function (e, t) {
    "use strict";
    function i(e, t) {
        for (var n = 0; n < t.length; n++) {
            var i = t[n];i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i);
        }
    }function s(e, t, n) {
        return t && i(e.prototype, t), n && i(e, n), e;
    }function l(r) {
        for (var e = 1; e < arguments.length; e++) {
            var o = null != arguments[e] ? arguments[e] : {},
                t = Object.keys(o);"function" == typeof Object.getOwnPropertySymbols && (t = t.concat(Object.getOwnPropertySymbols(o).filter(function (e) {
                return Object.getOwnPropertyDescriptor(o, e).enumerable;
            }))), t.forEach(function (e) {
                var t, n, i;t = r, i = o[n = e], n in t ? Object.defineProperty(t, n, { value: i, enumerable: !0, configurable: !0, writable: !0 }) : t[n] = i;
            });
        }return r;
    }for (var r, n, o, a, c, u, f, h, d, p, m, g, _, v, y, E, b, w, C, T, S, D, A, I, O, N, k, x, P, L, j, H, M, F, W, R, U, B, q, K, Q, Y, V, z, G, J, Z, X, $, ee, te, ne, ie, re, oe, se, ae, le, ce, ue, fe, he, de, pe, me, ge, _e, ve, ye, Ee, be, we = function (i) {
        var t = "transitionend";function e(e) {
            var t = this,
                n = !1;return i(this).one(l.TRANSITION_END, function () {
                n = !0;
            }), setTimeout(function () {
                n || l.triggerTransitionEnd(t);
            }, e), this;
        }var l = { TRANSITION_END: "bsTransitionEnd", getUID: function getUID(e) {
                for (; e += ~~(1e6 * Math.random()), document.getElementById(e);) {}return e;
            }, getSelectorFromElement: function getSelectorFromElement(e) {
                var t = e.getAttribute("data-target");t && "#" !== t || (t = e.getAttribute("href") || "");try {
                    return document.querySelector(t) ? t : null;
                } catch (e) {
                    return null;
                }
            }, getTransitionDurationFromElement: function getTransitionDurationFromElement(e) {
                if (!e) return 0;var t = i(e).css("transition-duration");return parseFloat(t) ? (t = t.split(",")[0], 1e3 * parseFloat(t)) : 0;
            }, reflow: function reflow(e) {
                return e.offsetHeight;
            }, triggerTransitionEnd: function triggerTransitionEnd(e) {
                i(e).trigger(t);
            }, supportsTransitionEnd: function supportsTransitionEnd() {
                return Boolean(t);
            }, isElement: function isElement(e) {
                return (e[0] || e).nodeType;
            }, typeCheckConfig: function typeCheckConfig(e, t, n) {
                for (var i in n) {
                    if (Object.prototype.hasOwnProperty.call(n, i)) {
                        var r = n[i],
                            o = t[i],
                            s = o && l.isElement(o) ? "element" : (a = o, {}.toString.call(a).match(/\s([a-z]+)/i)[1].toLowerCase());if (!new RegExp(r).test(s)) throw new Error(e.toUpperCase() + ': Option "' + i + '" provided type "' + s + '" but expected type "' + r + '".');
                    }
                }var a;
            } };return i.fn.emulateTransitionEnd = e, i.event.special[l.TRANSITION_END] = { bindType: t, delegateType: t, handle: function handle(e) {
                if (i(e.target).is(this)) return e.handleObj.handler.apply(this, arguments);
            } }, l;
    }(t = t && t.hasOwnProperty("default") ? t.default : t), Ce = (n = "alert", a = "." + (o = "bs.alert"), c = (r = t).fn[n], u = { CLOSE: "close" + a, CLOSED: "closed" + a, CLICK_DATA_API: "click" + a + ".data-api" }, f = "alert", h = "fade", d = "show", p = function () {
        function i(e) {
            this._element = e;
        }var e = i.prototype;return e.close = function (e) {
            var t = this._element;e && (t = this._getRootElement(e)), this._triggerCloseEvent(t).isDefaultPrevented() || this._removeElement(t);
        }, e.dispose = function () {
            r.removeData(this._element, o), this._element = null;
        }, e._getRootElement = function (e) {
            var t = we.getSelectorFromElement(e),
                n = !1;return t && (n = document.querySelector(t)), n || (n = r(e).closest("." + f)[0]), n;
        }, e._triggerCloseEvent = function (e) {
            var t = r.Event(u.CLOSE);return r(e).trigger(t), t;
        }, e._removeElement = function (t) {
            var n = this;if (r(t).removeClass(d), r(t).hasClass(h)) {
                var e = we.getTransitionDurationFromElement(t);r(t).one(we.TRANSITION_END, function (e) {
                    return n._destroyElement(t, e);
                }).emulateTransitionEnd(e);
            } else this._destroyElement(t);
        }, e._destroyElement = function (e) {
            r(e).detach().trigger(u.CLOSED).remove();
        }, i._jQueryInterface = function (n) {
            return this.each(function () {
                var e = r(this),
                    t = e.data(o);t || (t = new i(this), e.data(o, t)), "close" === n && t[n](this);
            });
        }, i._handleDismiss = function (t) {
            return function (e) {
                e && e.preventDefault(), t.close(this);
            };
        }, s(i, null, [{ key: "VERSION", get: function get() {
                return "4.1.3";
            } }]), i;
    }(), r(document).on(u.CLICK_DATA_API, '[data-dismiss="alert"]', p._handleDismiss(new p())), r.fn[n] = p._jQueryInterface, r.fn[n].Constructor = p, r.fn[n].noConflict = function () {
        return r.fn[n] = c, p._jQueryInterface;
    }, p), Te = (g = "button", v = "." + (_ = "bs.button"), y = ".data-api", E = (m = t).fn[g], b = "active", w = "btn", T = '[data-toggle^="button"]', S = '[data-toggle="buttons"]', D = "input", A = ".active", I = ".btn", O = { CLICK_DATA_API: "click" + v + y, FOCUS_BLUR_DATA_API: (C = "focus") + v + y + " blur" + v + y }, N = function () {
        function n(e) {
            this._element = e;
        }var e = n.prototype;return e.toggle = function () {
            var e = !0,
                t = !0,
                n = m(this._element).closest(S)[0];if (n) {
                var i = this._element.querySelector(D);if (i) {
                    if ("radio" === i.type) if (i.checked && this._element.classList.contains(b)) e = !1;else {
                        var r = n.querySelector(A);r && m(r).removeClass(b);
                    }if (e) {
                        if (i.hasAttribute("disabled") || n.hasAttribute("disabled") || i.classList.contains("disabled") || n.classList.contains("disabled")) return;i.checked = !this._element.classList.contains(b), m(i).trigger("change");
                    }i.focus(), t = !1;
                }
            }t && this._element.setAttribute("aria-pressed", !this._element.classList.contains(b)), e && m(this._element).toggleClass(b);
        }, e.dispose = function () {
            m.removeData(this._element, _), this._element = null;
        }, n._jQueryInterface = function (t) {
            return this.each(function () {
                var e = m(this).data(_);e || (e = new n(this), m(this).data(_, e)), "toggle" === t && e[t]();
            });
        }, s(n, null, [{ key: "VERSION", get: function get() {
                return "4.1.3";
            } }]), n;
    }(), m(document).on(O.CLICK_DATA_API, T, function (e) {
        e.preventDefault();var t = e.target;m(t).hasClass(w) || (t = m(t).closest(I)), N._jQueryInterface.call(m(t), "toggle");
    }).on(O.FOCUS_BLUR_DATA_API, T, function (e) {
        var t = m(e.target).closest(I)[0];m(t).toggleClass(C, /^focus(in)?$/.test(e.type));
    }), m.fn[g] = N._jQueryInterface, m.fn[g].Constructor = N, m.fn[g].noConflict = function () {
        return m.fn[g] = E, N._jQueryInterface;
    }, N), Se = (x = "carousel", L = "." + (P = "bs.carousel"), j = ".data-api", H = (k = t).fn[x], M = { interval: 5e3, keyboard: !0, slide: !1, pause: "hover", wrap: !0 }, F = { interval: "(number|boolean)", keyboard: "boolean", slide: "(boolean|string)", pause: "(string|boolean)", wrap: "boolean" }, W = "next", R = "prev", U = "left", B = "right", q = { SLIDE: "slide" + L, SLID: "slid" + L, KEYDOWN: "keydown" + L, MOUSEENTER: "mouseenter" + L, MOUSELEAVE: "mouseleave" + L, TOUCHEND: "touchend" + L, LOAD_DATA_API: "load" + L + j, CLICK_DATA_API: "click" + L + j }, K = "carousel", Q = "active", Y = "slide", V = "carousel-item-right", z = "carousel-item-left", G = "carousel-item-next", J = "carousel-item-prev", Z = ".active", X = ".active.carousel-item", $ = ".carousel-item", ee = ".carousel-item-next, .carousel-item-prev", te = ".carousel-indicators", ne = "[data-slide], [data-slide-to]", ie = '[data-ride="carousel"]', re = function () {
        function o(e, t) {
            this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this.touchTimeout = null, this._config = this._getConfig(t), this._element = k(e)[0], this._indicatorsElement = this._element.querySelector(te), this._addEventListeners();
        }var e = o.prototype;return e.next = function () {
            this._isSliding || this._slide(W);
        }, e.nextWhenVisible = function () {
            !document.hidden && k(this._element).is(":visible") && "hidden" !== k(this._element).css("visibility") && this.next();
        }, e.prev = function () {
            this._isSliding || this._slide(R);
        }, e.pause = function (e) {
            e || (this._isPaused = !0), this._element.querySelector(ee) && (we.triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null;
        }, e.cycle = function (e) {
            e || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval));
        }, e.to = function (e) {
            var t = this;this._activeElement = this._element.querySelector(X);var n = this._getItemIndex(this._activeElement);if (!(e > this._items.length - 1 || e < 0)) if (this._isSliding) k(this._element).one(q.SLID, function () {
                return t.to(e);
            });else {
                if (n === e) return this.pause(), void this.cycle();var i = n < e ? W : R;this._slide(i, this._items[e]);
            }
        }, e.dispose = function () {
            k(this._element).off(L), k.removeData(this._element, P), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null;
        }, e._getConfig = function (e) {
            return e = l({}, M, e), we.typeCheckConfig(x, e, F), e;
        }, e._addEventListeners = function () {
            var t = this;this._config.keyboard && k(this._element).on(q.KEYDOWN, function (e) {
                return t._keydown(e);
            }), "hover" === this._config.pause && (k(this._element).on(q.MOUSEENTER, function (e) {
                return t.pause(e);
            }).on(q.MOUSELEAVE, function (e) {
                return t.cycle(e);
            }), ("ontouchstart" in document.documentElement) && k(this._element).on(q.TOUCHEND, function () {
                t.pause(), t.touchTimeout && clearTimeout(t.touchTimeout), t.touchTimeout = setTimeout(function (e) {
                    return t.cycle(e);
                }, 500 + t._config.interval);
            }));
        }, e._keydown = function (e) {
            if (!/input|textarea/i.test(e.target.tagName)) switch (e.which) {case 37:
                    e.preventDefault(), this.prev();break;case 39:
                    e.preventDefault(), this.next();}
        }, e._getItemIndex = function (e) {
            return this._items = e && e.parentNode ? [].slice.call(e.parentNode.querySelectorAll($)) : [], this._items.indexOf(e);
        }, e._getItemByDirection = function (e, t) {
            var n = e === W,
                i = e === R,
                r = this._getItemIndex(t),
                o = this._items.length - 1;if ((i && 0 === r || n && r === o) && !this._config.wrap) return t;var s = (r + (e === R ? -1 : 1)) % this._items.length;return -1 === s ? this._items[this._items.length - 1] : this._items[s];
        }, e._triggerSlideEvent = function (e, t) {
            var n = this._getItemIndex(e),
                i = this._getItemIndex(this._element.querySelector(X)),
                r = k.Event(q.SLIDE, { relatedTarget: e, direction: t, from: i, to: n });return k(this._element).trigger(r), r;
        }, e._setActiveIndicatorElement = function (e) {
            if (this._indicatorsElement) {
                var t = [].slice.call(this._indicatorsElement.querySelectorAll(Z));k(t).removeClass(Q);var n = this._indicatorsElement.children[this._getItemIndex(e)];n && k(n).addClass(Q);
            }
        }, e._slide = function (e, t) {
            var n,
                i,
                r,
                o = this,
                s = this._element.querySelector(X),
                a = this._getItemIndex(s),
                l = t || s && this._getItemByDirection(e, s),
                c = this._getItemIndex(l),
                u = Boolean(this._interval);if (e === W ? (n = z, i = G, r = U) : (n = V, i = J, r = B), l && k(l).hasClass(Q)) this._isSliding = !1;else if (!this._triggerSlideEvent(l, r).isDefaultPrevented() && s && l) {
                this._isSliding = !0, u && this.pause(), this._setActiveIndicatorElement(l);var f = k.Event(q.SLID, { relatedTarget: l, direction: r, from: a, to: c });if (k(this._element).hasClass(Y)) {
                    k(l).addClass(i), we.reflow(l), k(s).addClass(n), k(l).addClass(n);var h = we.getTransitionDurationFromElement(s);k(s).one(we.TRANSITION_END, function () {
                        k(l).removeClass(n + " " + i).addClass(Q), k(s).removeClass(Q + " " + i + " " + n), o._isSliding = !1, setTimeout(function () {
                            return k(o._element).trigger(f);
                        }, 0);
                    }).emulateTransitionEnd(h);
                } else k(s).removeClass(Q), k(l).addClass(Q), this._isSliding = !1, k(this._element).trigger(f);u && this.cycle();
            }
        }, o._jQueryInterface = function (i) {
            return this.each(function () {
                var e = k(this).data(P),
                    t = l({}, M, k(this).data());"object" == (typeof i === "undefined" ? "undefined" : _typeof(i)) && (t = l({}, t, i));var n = "string" == typeof i ? i : t.slide;if (e || (e = new o(this, t), k(this).data(P, e)), "number" == typeof i) e.to(i);else if ("string" == typeof n) {
                    if ("undefined" == typeof e[n]) throw new TypeError('No method named "' + n + '"');e[n]();
                } else t.interval && (e.pause(), e.cycle());
            });
        }, o._dataApiClickHandler = function (e) {
            var t = we.getSelectorFromElement(this);if (t) {
                var n = k(t)[0];if (n && k(n).hasClass(K)) {
                    var i = l({}, k(n).data(), k(this).data()),
                        r = this.getAttribute("data-slide-to");r && (i.interval = !1), o._jQueryInterface.call(k(n), i), r && k(n).data(P).to(r), e.preventDefault();
                }
            }
        }, s(o, null, [{ key: "VERSION", get: function get() {
                return "4.1.3";
            } }, { key: "Default", get: function get() {
                return M;
            } }]), o;
    }(), k(document).on(q.CLICK_DATA_API, ne, re._dataApiClickHandler), k(window).on(q.LOAD_DATA_API, function () {
        for (var e = [].slice.call(document.querySelectorAll(ie)), t = 0, n = e.length; t < n; t++) {
            var i = k(e[t]);re._jQueryInterface.call(i, i.data());
        }
    }), k.fn[x] = re._jQueryInterface, k.fn[x].Constructor = re, k.fn[x].noConflict = function () {
        return k.fn[x] = H, re._jQueryInterface;
    }, re), De = (se = "collapse", le = "." + (ae = "bs.collapse"), ce = (oe = t).fn[se], ue = { toggle: !0, parent: "" }, fe = { toggle: "boolean", parent: "(string|element)" }, he = { SHOW: "show" + le, SHOWN: "shown" + le, HIDE: "hide" + le, HIDDEN: "hidden" + le, CLICK_DATA_API: "click" + le + ".data-api" }, de = "show", pe = "collapse", me = "collapsing", ge = "collapsed", _e = "width", ve = "height", ye = ".show, .collapsing", Ee = '[data-toggle="collapse"]', be = function () {
        function a(t, e) {
            this._isTransitioning = !1, this._element = t, this._config = this._getConfig(e), this._triggerArray = oe.makeArray(document.querySelectorAll('[data-toggle="collapse"][href="#' + t.id + '"],[data-toggle="collapse"][data-target="#' + t.id + '"]'));for (var n = [].slice.call(document.querySelectorAll(Ee)), i = 0, r = n.length; i < r; i++) {
                var o = n[i],
                    s = we.getSelectorFromElement(o),
                    a = [].slice.call(document.querySelectorAll(s)).filter(function (e) {
                    return e === t;
                });null !== s && 0 < a.length && (this._selector = s, this._triggerArray.push(o));
            }this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle();
        }var e = a.prototype;return e.toggle = function () {
            oe(this._element).hasClass(de) ? this.hide() : this.show();
        }, e.show = function () {
            var e,
                t,
                n = this;if (!this._isTransitioning && !oe(this._element).hasClass(de) && (this._parent && 0 === (e = [].slice.call(this._parent.querySelectorAll(ye)).filter(function (e) {
                return e.getAttribute("data-parent") === n._config.parent;
            })).length && (e = null), !(e && (t = oe(e).not(this._selector).data(ae)) && t._isTransitioning))) {
                var i = oe.Event(he.SHOW);if (oe(this._element).trigger(i), !i.isDefaultPrevented()) {
                    e && (a._jQueryInterface.call(oe(e).not(this._selector), "hide"), t || oe(e).data(ae, null));var r = this._getDimension();oe(this._element).removeClass(pe).addClass(me), this._element.style[r] = 0, this._triggerArray.length && oe(this._triggerArray).removeClass(ge).attr("aria-expanded", !0), this.setTransitioning(!0);var o = "scroll" + (r[0].toUpperCase() + r.slice(1)),
                        s = we.getTransitionDurationFromElement(this._element);oe(this._element).one(we.TRANSITION_END, function () {
                        oe(n._element).removeClass(me).addClass(pe).addClass(de), n._element.style[r] = "", n.setTransitioning(!1), oe(n._element).trigger(he.SHOWN);
                    }).emulateTransitionEnd(s), this._element.style[r] = this._element[o] + "px";
                }
            }
        }, e.hide = function () {
            var e = this;if (!this._isTransitioning && oe(this._element).hasClass(de)) {
                var t = oe.Event(he.HIDE);if (oe(this._element).trigger(t), !t.isDefaultPrevented()) {
                    var n = this._getDimension();this._element.style[n] = this._element.getBoundingClientRect()[n] + "px", we.reflow(this._element), oe(this._element).addClass(me).removeClass(pe).removeClass(de);var i = this._triggerArray.length;if (0 < i) for (var r = 0; r < i; r++) {
                        var o = this._triggerArray[r],
                            s = we.getSelectorFromElement(o);if (null !== s) oe([].slice.call(document.querySelectorAll(s))).hasClass(de) || oe(o).addClass(ge).attr("aria-expanded", !1);
                    }this.setTransitioning(!0);this._element.style[n] = "";var a = we.getTransitionDurationFromElement(this._element);oe(this._element).one(we.TRANSITION_END, function () {
                        e.setTransitioning(!1), oe(e._element).removeClass(me).addClass(pe).trigger(he.HIDDEN);
                    }).emulateTransitionEnd(a);
                }
            }
        }, e.setTransitioning = function (e) {
            this._isTransitioning = e;
        }, e.dispose = function () {
            oe.removeData(this._element, ae), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null;
        }, e._getConfig = function (e) {
            return (e = l({}, ue, e)).toggle = Boolean(e.toggle), we.typeCheckConfig(se, e, fe), e;
        }, e._getDimension = function () {
            return oe(this._element).hasClass(_e) ? _e : ve;
        }, e._getParent = function () {
            var n = this,
                e = null;we.isElement(this._config.parent) ? (e = this._config.parent, "undefined" != typeof this._config.parent.jquery && (e = this._config.parent[0])) : e = document.querySelector(this._config.parent);var t = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]',
                i = [].slice.call(e.querySelectorAll(t));return oe(i).each(function (e, t) {
                n._addAriaAndCollapsedClass(a._getTargetFromElement(t), [t]);
            }), e;
        }, e._addAriaAndCollapsedClass = function (e, t) {
            if (e) {
                var n = oe(e).hasClass(de);t.length && oe(t).toggleClass(ge, !n).attr("aria-expanded", n);
            }
        }, a._getTargetFromElement = function (e) {
            var t = we.getSelectorFromElement(e);return t ? document.querySelector(t) : null;
        }, a._jQueryInterface = function (i) {
            return this.each(function () {
                var e = oe(this),
                    t = e.data(ae),
                    n = l({}, ue, e.data(), "object" == (typeof i === "undefined" ? "undefined" : _typeof(i)) && i ? i : {});if (!t && n.toggle && /show|hide/.test(i) && (n.toggle = !1), t || (t = new a(this, n), e.data(ae, t)), "string" == typeof i) {
                    if ("undefined" == typeof t[i]) throw new TypeError('No method named "' + i + '"');t[i]();
                }
            });
        }, s(a, null, [{ key: "VERSION", get: function get() {
                return "4.1.3";
            } }, { key: "Default", get: function get() {
                return ue;
            } }]), a;
    }(), oe(document).on(he.CLICK_DATA_API, Ee, function (e) {
        "A" === e.currentTarget.tagName && e.preventDefault();var n = oe(this),
            t = we.getSelectorFromElement(this),
            i = [].slice.call(document.querySelectorAll(t));oe(i).each(function () {
            var e = oe(this),
                t = e.data(ae) ? "toggle" : n.data();be._jQueryInterface.call(e, t);
        });
    }), oe.fn[se] = be._jQueryInterface, oe.fn[se].Constructor = be, oe.fn[se].noConflict = function () {
        return oe.fn[se] = ce, be._jQueryInterface;
    }, be), Ae = "undefined" != typeof window && "undefined" != typeof document, Ie = ["Edge", "Trident", "Firefox"], Oe = 0, Ne = 0; Ne < Ie.length; Ne += 1) {
        if (Ae && 0 <= navigator.userAgent.indexOf(Ie[Ne])) {
            Oe = 1;break;
        }
    }var ke = Ae && window.Promise ? function (e) {
        var t = !1;return function () {
            t || (t = !0, window.Promise.resolve().then(function () {
                t = !1, e();
            }));
        };
    } : function (e) {
        var t = !1;return function () {
            t || (t = !0, setTimeout(function () {
                t = !1, e();
            }, Oe));
        };
    };function xe(e) {
        return e && "[object Function]" === {}.toString.call(e);
    }function Pe(e, t) {
        if (1 !== e.nodeType) return [];var n = getComputedStyle(e, null);return t ? n[t] : n;
    }function Le(e) {
        return "HTML" === e.nodeName ? e : e.parentNode || e.host;
    }function je(e) {
        if (!e) return document.body;switch (e.nodeName) {case "HTML":case "BODY":
                return e.ownerDocument.body;case "#document":
                return e.body;}var t = Pe(e),
            n = t.overflow,
            i = t.overflowX,
            r = t.overflowY;return (/(auto|scroll|overlay)/.test(n + r + i) ? e : je(Le(e))
        );
    }var He = Ae && !(!window.MSInputMethodContext || !document.documentMode),
        Me = Ae && /MSIE 10/.test(navigator.userAgent);function Fe(e) {
        return 11 === e ? He : 10 === e ? Me : He || Me;
    }function We(e) {
        if (!e) return document.documentElement;for (var t = Fe(10) ? document.body : null, n = e.offsetParent; n === t && e.nextElementSibling;) {
            n = (e = e.nextElementSibling).offsetParent;
        }var i = n && n.nodeName;return i && "BODY" !== i && "HTML" !== i ? -1 !== ["TD", "TABLE"].indexOf(n.nodeName) && "static" === Pe(n, "position") ? We(n) : n : e ? e.ownerDocument.documentElement : document.documentElement;
    }function Re(e) {
        return null !== e.parentNode ? Re(e.parentNode) : e;
    }function Ue(e, t) {
        if (!(e && e.nodeType && t && t.nodeType)) return document.documentElement;var n = e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
            i = n ? e : t,
            r = n ? t : e,
            o = document.createRange();o.setStart(i, 0), o.setEnd(r, 0);var s,
            a,
            l = o.commonAncestorContainer;if (e !== l && t !== l || i.contains(r)) return "BODY" === (a = (s = l).nodeName) || "HTML" !== a && We(s.firstElementChild) !== s ? We(l) : l;var c = Re(e);return c.host ? Ue(c.host, t) : Ue(e, Re(t).host);
    }function Be(e) {
        var t = "top" === (1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "top") ? "scrollTop" : "scrollLeft",
            n = e.nodeName;if ("BODY" === n || "HTML" === n) {
            var i = e.ownerDocument.documentElement;return (e.ownerDocument.scrollingElement || i)[t];
        }return e[t];
    }function qe(e, t) {
        var n = "x" === t ? "Left" : "Top",
            i = "Left" === n ? "Right" : "Bottom";return parseFloat(e["border" + n + "Width"], 10) + parseFloat(e["border" + i + "Width"], 10);
    }function Ke(e, t, n, i) {
        return Math.max(t["offset" + e], t["scroll" + e], n["client" + e], n["offset" + e], n["scroll" + e], Fe(10) ? n["offset" + e] + i["margin" + ("Height" === e ? "Top" : "Left")] + i["margin" + ("Height" === e ? "Bottom" : "Right")] : 0);
    }function Qe() {
        var e = document.body,
            t = document.documentElement,
            n = Fe(10) && getComputedStyle(t);return { height: Ke("Height", e, t, n), width: Ke("Width", e, t, n) };
    }var Ye = function () {
        function i(e, t) {
            for (var n = 0; n < t.length; n++) {
                var i = t[n];i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i);
            }
        }return function (e, t, n) {
            return t && i(e.prototype, t), n && i(e, n), e;
        };
    }(),
        Ve = function Ve(e, t, n) {
        return t in e ? Object.defineProperty(e, t, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : e[t] = n, e;
    },
        ze = Object.assign || function (e) {
        for (var t = 1; t < arguments.length; t++) {
            var n = arguments[t];for (var i in n) {
                Object.prototype.hasOwnProperty.call(n, i) && (e[i] = n[i]);
            }
        }return e;
    };function Ge(e) {
        return ze({}, e, { right: e.left + e.width, bottom: e.top + e.height });
    }function Je(e) {
        var t = {};try {
            if (Fe(10)) {
                t = e.getBoundingClientRect();var n = Be(e, "top"),
                    i = Be(e, "left");t.top += n, t.left += i, t.bottom += n, t.right += i;
            } else t = e.getBoundingClientRect();
        } catch (e) {}var r = { left: t.left, top: t.top, width: t.right - t.left, height: t.bottom - t.top },
            o = "HTML" === e.nodeName ? Qe() : {},
            s = o.width || e.clientWidth || r.right - r.left,
            a = o.height || e.clientHeight || r.bottom - r.top,
            l = e.offsetWidth - s,
            c = e.offsetHeight - a;if (l || c) {
            var u = Pe(e);l -= qe(u, "x"), c -= qe(u, "y"), r.width -= l, r.height -= c;
        }return Ge(r);
    }function Ze(e, t) {
        var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
            i = Fe(10),
            r = "HTML" === t.nodeName,
            o = Je(e),
            s = Je(t),
            a = je(e),
            l = Pe(t),
            c = parseFloat(l.borderTopWidth, 10),
            u = parseFloat(l.borderLeftWidth, 10);n && "HTML" === t.nodeName && (s.top = Math.max(s.top, 0), s.left = Math.max(s.left, 0));var f = Ge({ top: o.top - s.top - c, left: o.left - s.left - u, width: o.width, height: o.height });if (f.marginTop = 0, f.marginLeft = 0, !i && r) {
            var h = parseFloat(l.marginTop, 10),
                d = parseFloat(l.marginLeft, 10);f.top -= c - h, f.bottom -= c - h, f.left -= u - d, f.right -= u - d, f.marginTop = h, f.marginLeft = d;
        }return (i && !n ? t.contains(a) : t === a && "BODY" !== a.nodeName) && (f = function (e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
                i = Be(t, "top"),
                r = Be(t, "left"),
                o = n ? -1 : 1;return e.top += i * o, e.bottom += i * o, e.left += r * o, e.right += r * o, e;
        }(f, t)), f;
    }function Xe(e) {
        if (!e || !e.parentElement || Fe()) return document.documentElement;for (var t = e.parentElement; t && "none" === Pe(t, "transform");) {
            t = t.parentElement;
        }return t || document.documentElement;
    }function $e(e, t, n, i) {
        var r = 4 < arguments.length && void 0 !== arguments[4] && arguments[4],
            o = { top: 0, left: 0 },
            s = r ? Xe(e) : Ue(e, t);if ("viewport" === i) o = function (e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
                n = e.ownerDocument.documentElement,
                i = Ze(e, n),
                r = Math.max(n.clientWidth, window.innerWidth || 0),
                o = Math.max(n.clientHeight, window.innerHeight || 0),
                s = t ? 0 : Be(n),
                a = t ? 0 : Be(n, "left");return Ge({ top: s - i.top + i.marginTop, left: a - i.left + i.marginLeft, width: r, height: o });
        }(s, r);else {
            var a = void 0;"scrollParent" === i ? "BODY" === (a = je(Le(t))).nodeName && (a = e.ownerDocument.documentElement) : a = "window" === i ? e.ownerDocument.documentElement : i;var l = Ze(a, s, r);if ("HTML" !== a.nodeName || function e(t) {
                var n = t.nodeName;return "BODY" !== n && "HTML" !== n && ("fixed" === Pe(t, "position") || e(Le(t)));
            }(s)) o = l;else {
                var c = Qe(),
                    u = c.height,
                    f = c.width;o.top += l.top - l.marginTop, o.bottom = u + l.top, o.left += l.left - l.marginLeft, o.right = f + l.left;
            }
        }return o.left += n, o.top += n, o.right -= n, o.bottom -= n, o;
    }function et(e, t, i, n, r) {
        var o = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 0;if (-1 === e.indexOf("auto")) return e;var s = $e(i, n, o, r),
            a = { top: { width: s.width, height: t.top - s.top }, right: { width: s.right - t.right, height: s.height }, bottom: { width: s.width, height: s.bottom - t.bottom }, left: { width: t.left - s.left, height: s.height } },
            l = Object.keys(a).map(function (e) {
            return ze({ key: e }, a[e], { area: (t = a[e], t.width * t.height) });var t;
        }).sort(function (e, t) {
            return t.area - e.area;
        }),
            c = l.filter(function (e) {
            var t = e.width,
                n = e.height;return t >= i.clientWidth && n >= i.clientHeight;
        }),
            u = 0 < c.length ? c[0].key : l[0].key,
            f = e.split("-")[1];return u + (f ? "-" + f : "");
    }function tt(e, t, n) {
        var i = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : null;return Ze(n, i ? Xe(t) : Ue(t, n), i);
    }function nt(e) {
        var t = getComputedStyle(e),
            n = parseFloat(t.marginTop) + parseFloat(t.marginBottom),
            i = parseFloat(t.marginLeft) + parseFloat(t.marginRight);return { width: e.offsetWidth + i, height: e.offsetHeight + n };
    }function it(e) {
        var t = { left: "right", right: "left", bottom: "top", top: "bottom" };return e.replace(/left|right|bottom|top/g, function (e) {
            return t[e];
        });
    }function rt(e, t, n) {
        n = n.split("-")[0];var i = nt(e),
            r = { width: i.width, height: i.height },
            o = -1 !== ["right", "left"].indexOf(n),
            s = o ? "top" : "left",
            a = o ? "left" : "top",
            l = o ? "height" : "width",
            c = o ? "width" : "height";return r[s] = t[s] + t[l] / 2 - i[l] / 2, r[a] = n === a ? t[a] - i[c] : t[it(a)], r;
    }function ot(e, t) {
        return Array.prototype.find ? e.find(t) : e.filter(t)[0];
    }function st(e, n, t) {
        return (void 0 === t ? e : e.slice(0, function (e, t, n) {
            if (Array.prototype.findIndex) return e.findIndex(function (e) {
                return e[t] === n;
            });var i = ot(e, function (e) {
                return e[t] === n;
            });return e.indexOf(i);
        }(e, "name", t))).forEach(function (e) {
            e.function && console.warn("`modifier.function` is deprecated, use `modifier.fn`!");var t = e.function || e.fn;e.enabled && xe(t) && (n.offsets.popper = Ge(n.offsets.popper), n.offsets.reference = Ge(n.offsets.reference), n = t(n, e));
        }), n;
    }function at(e, n) {
        return e.some(function (e) {
            var t = e.name;return e.enabled && t === n;
        });
    }function lt(e) {
        for (var t = [!1, "ms", "Webkit", "Moz", "O"], n = e.charAt(0).toUpperCase() + e.slice(1), i = 0; i < t.length; i++) {
            var r = t[i],
                o = r ? "" + r + n : e;if ("undefined" != typeof document.body.style[o]) return o;
        }return null;
    }function ct(e) {
        var t = e.ownerDocument;return t ? t.defaultView : window;
    }function ut(e, t, n, i) {
        n.updateBound = i, ct(e).addEventListener("resize", n.updateBound, { passive: !0 });var r = je(e);return function e(t, n, i, r) {
            var o = "BODY" === t.nodeName,
                s = o ? t.ownerDocument.defaultView : t;s.addEventListener(n, i, { passive: !0 }), o || e(je(s.parentNode), n, i, r), r.push(s);
        }(r, "scroll", n.updateBound, n.scrollParents), n.scrollElement = r, n.eventsEnabled = !0, n;
    }function ft() {
        var e, t;this.state.eventsEnabled && (cancelAnimationFrame(this.scheduleUpdate), this.state = (e = this.reference, t = this.state, ct(e).removeEventListener("resize", t.updateBound), t.scrollParents.forEach(function (e) {
            e.removeEventListener("scroll", t.updateBound);
        }), t.updateBound = null, t.scrollParents = [], t.scrollElement = null, t.eventsEnabled = !1, t));
    }function ht(e) {
        return "" !== e && !isNaN(parseFloat(e)) && isFinite(e);
    }function dt(n, i) {
        Object.keys(i).forEach(function (e) {
            var t = "";-1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(e) && ht(i[e]) && (t = "px"), n.style[e] = i[e] + t;
        });
    }function pt(e, t, n) {
        var i = ot(e, function (e) {
            return e.name === t;
        }),
            r = !!i && e.some(function (e) {
            return e.name === n && e.enabled && e.order < i.order;
        });if (!r) {
            var o = "`" + t + "`",
                s = "`" + n + "`";console.warn(s + " modifier is required by " + o + " modifier in order to work, be sure to include it before " + o + "!");
        }return r;
    }var mt = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
        gt = mt.slice(3);function _t(e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
            n = gt.indexOf(e),
            i = gt.slice(n + 1).concat(gt.slice(0, n));return t ? i.reverse() : i;
    }var vt = "flip",
        yt = "clockwise",
        Et = "counterclockwise";function bt(e, r, o, t) {
        var s = [0, 0],
            a = -1 !== ["right", "left"].indexOf(t),
            n = e.split(/(\+|\-)/).map(function (e) {
            return e.trim();
        }),
            i = n.indexOf(ot(n, function (e) {
            return -1 !== e.search(/,|\s/);
        }));n[i] && -1 === n[i].indexOf(",") && console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");var l = /\s*,\s*|\s+/,
            c = -1 !== i ? [n.slice(0, i).concat([n[i].split(l)[0]]), [n[i].split(l)[1]].concat(n.slice(i + 1))] : [n];return (c = c.map(function (e, t) {
            var n = (1 === t ? !a : a) ? "height" : "width",
                i = !1;return e.reduce(function (e, t) {
                return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t) ? (e[e.length - 1] = t, i = !0, e) : i ? (e[e.length - 1] += t, i = !1, e) : e.concat(t);
            }, []).map(function (e) {
                return function (e, t, n, i) {
                    var r = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                        o = +r[1],
                        s = r[2];if (!o) return e;if (0 === s.indexOf("%")) {
                        var a = void 0;switch (s) {case "%p":
                                a = n;break;case "%":case "%r":default:
                                a = i;}return Ge(a)[t] / 100 * o;
                    }if ("vh" === s || "vw" === s) return ("vh" === s ? Math.max(document.documentElement.clientHeight, window.innerHeight || 0) : Math.max(document.documentElement.clientWidth, window.innerWidth || 0)) / 100 * o;return o;
                }(e, n, r, o);
            });
        })).forEach(function (n, i) {
            n.forEach(function (e, t) {
                ht(e) && (s[i] += e * ("-" === n[t - 1] ? -1 : 1));
            });
        }), s;
    }var wt = { placement: "bottom", positionFixed: !1, eventsEnabled: !0, removeOnDestroy: !1, onCreate: function onCreate() {}, onUpdate: function onUpdate() {}, modifiers: { shift: { order: 100, enabled: !0, fn: function fn(e) {
                    var t = e.placement,
                        n = t.split("-")[0],
                        i = t.split("-")[1];if (i) {
                        var r = e.offsets,
                            o = r.reference,
                            s = r.popper,
                            a = -1 !== ["bottom", "top"].indexOf(n),
                            l = a ? "left" : "top",
                            c = a ? "width" : "height",
                            u = { start: Ve({}, l, o[l]), end: Ve({}, l, o[l] + o[c] - s[c]) };e.offsets.popper = ze({}, s, u[i]);
                    }return e;
                } }, offset: { order: 200, enabled: !0, fn: function fn(e, t) {
                    var n = t.offset,
                        i = e.placement,
                        r = e.offsets,
                        o = r.popper,
                        s = r.reference,
                        a = i.split("-")[0],
                        l = void 0;return l = ht(+n) ? [+n, 0] : bt(n, o, s, a), "left" === a ? (o.top += l[0], o.left -= l[1]) : "right" === a ? (o.top += l[0], o.left += l[1]) : "top" === a ? (o.left += l[0], o.top -= l[1]) : "bottom" === a && (o.left += l[0], o.top += l[1]), e.popper = o, e;
                }, offset: 0 }, preventOverflow: { order: 300, enabled: !0, fn: function fn(e, i) {
                    var t = i.boundariesElement || We(e.instance.popper);e.instance.reference === t && (t = We(t));var n = lt("transform"),
                        r = e.instance.popper.style,
                        o = r.top,
                        s = r.left,
                        a = r[n];r.top = "", r.left = "", r[n] = "";var l = $e(e.instance.popper, e.instance.reference, i.padding, t, e.positionFixed);r.top = o, r.left = s, r[n] = a, i.boundaries = l;var c = i.priority,
                        u = e.offsets.popper,
                        f = { primary: function primary(e) {
                            var t = u[e];return u[e] < l[e] && !i.escapeWithReference && (t = Math.max(u[e], l[e])), Ve({}, e, t);
                        }, secondary: function secondary(e) {
                            var t = "right" === e ? "left" : "top",
                                n = u[t];return u[e] > l[e] && !i.escapeWithReference && (n = Math.min(u[t], l[e] - ("right" === e ? u.width : u.height))), Ve({}, t, n);
                        } };return c.forEach(function (e) {
                        var t = -1 !== ["left", "top"].indexOf(e) ? "primary" : "secondary";u = ze({}, u, f[t](e));
                    }), e.offsets.popper = u, e;
                }, priority: ["left", "right", "top", "bottom"], padding: 5, boundariesElement: "scrollParent" }, keepTogether: { order: 400, enabled: !0, fn: function fn(e) {
                    var t = e.offsets,
                        n = t.popper,
                        i = t.reference,
                        r = e.placement.split("-")[0],
                        o = Math.floor,
                        s = -1 !== ["top", "bottom"].indexOf(r),
                        a = s ? "right" : "bottom",
                        l = s ? "left" : "top",
                        c = s ? "width" : "height";return n[a] < o(i[l]) && (e.offsets.popper[l] = o(i[l]) - n[c]), n[l] > o(i[a]) && (e.offsets.popper[l] = o(i[a])), e;
                } }, arrow: { order: 500, enabled: !0, fn: function fn(e, t) {
                    var n;if (!pt(e.instance.modifiers, "arrow", "keepTogether")) return e;var i = t.element;if ("string" == typeof i) {
                        if (!(i = e.instance.popper.querySelector(i))) return e;
                    } else if (!e.instance.popper.contains(i)) return console.warn("WARNING: `arrow.element` must be child of its popper element!"), e;var r = e.placement.split("-")[0],
                        o = e.offsets,
                        s = o.popper,
                        a = o.reference,
                        l = -1 !== ["left", "right"].indexOf(r),
                        c = l ? "height" : "width",
                        u = l ? "Top" : "Left",
                        f = u.toLowerCase(),
                        h = l ? "left" : "top",
                        d = l ? "bottom" : "right",
                        p = nt(i)[c];a[d] - p < s[f] && (e.offsets.popper[f] -= s[f] - (a[d] - p)), a[f] + p > s[d] && (e.offsets.popper[f] += a[f] + p - s[d]), e.offsets.popper = Ge(e.offsets.popper);var m = a[f] + a[c] / 2 - p / 2,
                        g = Pe(e.instance.popper),
                        _ = parseFloat(g["margin" + u], 10),
                        v = parseFloat(g["border" + u + "Width"], 10),
                        y = m - e.offsets.popper[f] - _ - v;return y = Math.max(Math.min(s[c] - p, y), 0), e.arrowElement = i, e.offsets.arrow = (Ve(n = {}, f, Math.round(y)), Ve(n, h, ""), n), e;
                }, element: "[x-arrow]" }, flip: { order: 600, enabled: !0, fn: function fn(p, m) {
                    if (at(p.instance.modifiers, "inner")) return p;if (p.flipped && p.placement === p.originalPlacement) return p;var g = $e(p.instance.popper, p.instance.reference, m.padding, m.boundariesElement, p.positionFixed),
                        _ = p.placement.split("-")[0],
                        v = it(_),
                        y = p.placement.split("-")[1] || "",
                        E = [];switch (m.behavior) {case vt:
                            E = [_, v];break;case yt:
                            E = _t(_);break;case Et:
                            E = _t(_, !0);break;default:
                            E = m.behavior;}return E.forEach(function (e, t) {
                        if (_ !== e || E.length === t + 1) return p;_ = p.placement.split("-")[0], v = it(_);var n,
                            i = p.offsets.popper,
                            r = p.offsets.reference,
                            o = Math.floor,
                            s = "left" === _ && o(i.right) > o(r.left) || "right" === _ && o(i.left) < o(r.right) || "top" === _ && o(i.bottom) > o(r.top) || "bottom" === _ && o(i.top) < o(r.bottom),
                            a = o(i.left) < o(g.left),
                            l = o(i.right) > o(g.right),
                            c = o(i.top) < o(g.top),
                            u = o(i.bottom) > o(g.bottom),
                            f = "left" === _ && a || "right" === _ && l || "top" === _ && c || "bottom" === _ && u,
                            h = -1 !== ["top", "bottom"].indexOf(_),
                            d = !!m.flipVariations && (h && "start" === y && a || h && "end" === y && l || !h && "start" === y && c || !h && "end" === y && u);(s || f || d) && (p.flipped = !0, (s || f) && (_ = E[t + 1]), d && (y = "end" === (n = y) ? "start" : "start" === n ? "end" : n), p.placement = _ + (y ? "-" + y : ""), p.offsets.popper = ze({}, p.offsets.popper, rt(p.instance.popper, p.offsets.reference, p.placement)), p = st(p.instance.modifiers, p, "flip"));
                    }), p;
                }, behavior: "flip", padding: 5, boundariesElement: "viewport" }, inner: { order: 700, enabled: !1, fn: function fn(e) {
                    var t = e.placement,
                        n = t.split("-")[0],
                        i = e.offsets,
                        r = i.popper,
                        o = i.reference,
                        s = -1 !== ["left", "right"].indexOf(n),
                        a = -1 === ["top", "left"].indexOf(n);return r[s ? "left" : "top"] = o[n] - (a ? r[s ? "width" : "height"] : 0), e.placement = it(t), e.offsets.popper = Ge(r), e;
                } }, hide: { order: 800, enabled: !0, fn: function fn(e) {
                    if (!pt(e.instance.modifiers, "hide", "preventOverflow")) return e;var t = e.offsets.reference,
                        n = ot(e.instance.modifiers, function (e) {
                        return "preventOverflow" === e.name;
                    }).boundaries;if (t.bottom < n.top || t.left > n.right || t.top > n.bottom || t.right < n.left) {
                        if (!0 === e.hide) return e;e.hide = !0, e.attributes["x-out-of-boundaries"] = "";
                    } else {
                        if (!1 === e.hide) return e;e.hide = !1, e.attributes["x-out-of-boundaries"] = !1;
                    }return e;
                } }, computeStyle: { order: 850, enabled: !0, fn: function fn(e, t) {
                    var n = t.x,
                        i = t.y,
                        r = e.offsets.popper,
                        o = ot(e.instance.modifiers, function (e) {
                        return "applyStyle" === e.name;
                    }).gpuAcceleration;void 0 !== o && console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");var s = void 0 !== o ? o : t.gpuAcceleration,
                        a = Je(We(e.instance.popper)),
                        l = { position: r.position },
                        c = { left: Math.floor(r.left), top: Math.round(r.top), bottom: Math.round(r.bottom), right: Math.floor(r.right) },
                        u = "bottom" === n ? "top" : "bottom",
                        f = "right" === i ? "left" : "right",
                        h = lt("transform"),
                        d = void 0,
                        p = void 0;if (p = "bottom" === u ? -a.height + c.bottom : c.top, d = "right" === f ? -a.width + c.right : c.left, s && h) l[h] = "translate3d(" + d + "px, " + p + "px, 0)", l[u] = 0, l[f] = 0, l.willChange = "transform";else {
                        var m = "bottom" === u ? -1 : 1,
                            g = "right" === f ? -1 : 1;l[u] = p * m, l[f] = d * g, l.willChange = u + ", " + f;
                    }var _ = { "x-placement": e.placement };return e.attributes = ze({}, _, e.attributes), e.styles = ze({}, l, e.styles), e.arrowStyles = ze({}, e.offsets.arrow, e.arrowStyles), e;
                }, gpuAcceleration: !0, x: "bottom", y: "right" }, applyStyle: { order: 900, enabled: !0, fn: function fn(e) {
                    var t, n;return dt(e.instance.popper, e.styles), t = e.instance.popper, n = e.attributes, Object.keys(n).forEach(function (e) {
                        !1 !== n[e] ? t.setAttribute(e, n[e]) : t.removeAttribute(e);
                    }), e.arrowElement && Object.keys(e.arrowStyles).length && dt(e.arrowElement, e.arrowStyles), e;
                }, onLoad: function onLoad(e, t, n, i, r) {
                    var o = tt(r, t, e, n.positionFixed),
                        s = et(n.placement, o, t, e, n.modifiers.flip.boundariesElement, n.modifiers.flip.padding);return t.setAttribute("x-placement", s), dt(t, { position: n.positionFixed ? "fixed" : "absolute" }), n;
                }, gpuAcceleration: void 0 } } },
        Ct = function () {
        function o(e, t) {
            var n = this,
                i = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};!function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
            }(this, o), this.scheduleUpdate = function () {
                return requestAnimationFrame(n.update);
            }, this.update = ke(this.update.bind(this)), this.options = ze({}, o.Defaults, i), this.state = { isDestroyed: !1, isCreated: !1, scrollParents: [] }, this.reference = e && e.jquery ? e[0] : e, this.popper = t && t.jquery ? t[0] : t, this.options.modifiers = {}, Object.keys(ze({}, o.Defaults.modifiers, i.modifiers)).forEach(function (e) {
                n.options.modifiers[e] = ze({}, o.Defaults.modifiers[e] || {}, i.modifiers ? i.modifiers[e] : {});
            }), this.modifiers = Object.keys(this.options.modifiers).map(function (e) {
                return ze({ name: e }, n.options.modifiers[e]);
            }).sort(function (e, t) {
                return e.order - t.order;
            }), this.modifiers.forEach(function (e) {
                e.enabled && xe(e.onLoad) && e.onLoad(n.reference, n.popper, n.options, e, n.state);
            }), this.update();var r = this.options.eventsEnabled;r && this.enableEventListeners(), this.state.eventsEnabled = r;
        }return Ye(o, [{ key: "update", value: function value() {
                return function () {
                    if (!this.state.isDestroyed) {
                        var e = { instance: this, styles: {}, arrowStyles: {}, attributes: {}, flipped: !1, offsets: {} };e.offsets.reference = tt(this.state, this.popper, this.reference, this.options.positionFixed), e.placement = et(this.options.placement, e.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding), e.originalPlacement = e.placement, e.positionFixed = this.options.positionFixed, e.offsets.popper = rt(this.popper, e.offsets.reference, e.placement), e.offsets.popper.position = this.options.positionFixed ? "fixed" : "absolute", e = st(this.modifiers, e), this.state.isCreated ? this.options.onUpdate(e) : (this.state.isCreated = !0, this.options.onCreate(e));
                    }
                }.call(this);
            } }, { key: "destroy", value: function value() {
                return function () {
                    return this.state.isDestroyed = !0, at(this.modifiers, "applyStyle") && (this.popper.removeAttribute("x-placement"), this.popper.style.position = "", this.popper.style.top = "", this.popper.style.left = "", this.popper.style.right = "", this.popper.style.bottom = "", this.popper.style.willChange = "", this.popper.style[lt("transform")] = ""), this.disableEventListeners(), this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper), this;
                }.call(this);
            } }, { key: "enableEventListeners", value: function value() {
                return function () {
                    this.state.eventsEnabled || (this.state = ut(this.reference, this.options, this.state, this.scheduleUpdate));
                }.call(this);
            } }, { key: "disableEventListeners", value: function value() {
                return ft.call(this);
            } }]), o;
    }();Ct.Utils = ("undefined" != typeof window ? window : global).PopperUtils, Ct.placements = mt, Ct.Defaults = wt;var Tt,
        St,
        Dt,
        At,
        It,
        Ot,
        Nt,
        kt,
        xt,
        Pt,
        Lt,
        jt,
        Ht,
        Mt,
        Ft,
        Wt,
        Rt,
        Ut,
        Bt,
        qt,
        Kt,
        Qt,
        Yt,
        Vt,
        zt,
        Gt,
        Jt,
        Zt,
        Xt,
        $t,
        en,
        tn,
        nn,
        rn,
        on,
        sn,
        an,
        ln,
        cn,
        un,
        fn,
        hn,
        dn,
        pn,
        mn,
        gn,
        _n,
        vn,
        yn,
        En,
        bn,
        wn,
        Cn,
        Tn,
        Sn,
        Dn,
        An,
        In,
        On,
        Nn,
        kn,
        xn,
        Pn,
        Ln,
        jn,
        Hn,
        Mn,
        Fn,
        Wn,
        Rn,
        Un,
        Bn,
        qn,
        Kn,
        Qn,
        Yn,
        Vn,
        zn,
        Gn,
        Jn,
        Zn,
        Xn,
        $n,
        ei,
        ti,
        ni,
        ii,
        ri,
        oi,
        si,
        ai,
        li,
        ci,
        ui,
        fi,
        hi,
        di,
        pi,
        mi,
        gi,
        _i,
        vi,
        yi,
        Ei,
        bi,
        wi,
        Ci,
        Ti,
        Si,
        Di,
        Ai,
        Ii,
        Oi,
        Ni,
        ki,
        xi,
        Pi,
        Li,
        ji,
        Hi,
        Mi,
        Fi,
        Wi,
        Ri,
        Ui,
        Bi = (St = "dropdown", At = "." + (Dt = "bs.dropdown"), It = ".data-api", Ot = (Tt = t).fn[St], Nt = new RegExp("38|40|27"), kt = { HIDE: "hide" + At, HIDDEN: "hidden" + At, SHOW: "show" + At, SHOWN: "shown" + At, CLICK: "click" + At, CLICK_DATA_API: "click" + At + It, KEYDOWN_DATA_API: "keydown" + At + It, KEYUP_DATA_API: "keyup" + At + It }, xt = "disabled", Pt = "show", Lt = "dropup", jt = "dropright", Ht = "dropleft", Mt = "dropdown-menu-right", Ft = "position-static", Wt = '[data-toggle="dropdown"]', Rt = ".dropdown form", Ut = ".dropdown-menu", Bt = ".navbar-nav", qt = ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)", Kt = "top-start", Qt = "top-end", Yt = "bottom-start", Vt = "bottom-end", zt = "right-start", Gt = "left-start", Jt = { offset: 0, flip: !0, boundary: "scrollParent", reference: "toggle", display: "dynamic" }, Zt = { offset: "(number|string|function)", flip: "boolean", boundary: "(string|element)", reference: "(string|element)", display: "string" }, Xt = function () {
        function c(e, t) {
            this._element = e, this._popper = null, this._config = this._getConfig(t), this._menu = this._getMenuElement(), this._inNavbar = this._detectNavbar(), this._addEventListeners();
        }var e = c.prototype;return e.toggle = function () {
            if (!this._element.disabled && !Tt(this._element).hasClass(xt)) {
                var e = c._getParentFromElement(this._element),
                    t = Tt(this._menu).hasClass(Pt);if (c._clearMenus(), !t) {
                    var n = { relatedTarget: this._element },
                        i = Tt.Event(kt.SHOW, n);if (Tt(e).trigger(i), !i.isDefaultPrevented()) {
                        if (!this._inNavbar) {
                            if ("undefined" == typeof Ct) throw new TypeError("Bootstrap dropdown require Popper.js (https://popper.js.org)");var r = this._element;"parent" === this._config.reference ? r = e : we.isElement(this._config.reference) && (r = this._config.reference, "undefined" != typeof this._config.reference.jquery && (r = this._config.reference[0])), "scrollParent" !== this._config.boundary && Tt(e).addClass(Ft), this._popper = new Ct(r, this._menu, this._getPopperConfig());
                        }"ontouchstart" in document.documentElement && 0 === Tt(e).closest(Bt).length && Tt(document.body).children().on("mouseover", null, Tt.noop), this._element.focus(), this._element.setAttribute("aria-expanded", !0), Tt(this._menu).toggleClass(Pt), Tt(e).toggleClass(Pt).trigger(Tt.Event(kt.SHOWN, n));
                    }
                }
            }
        }, e.dispose = function () {
            Tt.removeData(this._element, Dt), Tt(this._element).off(At), this._element = null, (this._menu = null) !== this._popper && (this._popper.destroy(), this._popper = null);
        }, e.update = function () {
            this._inNavbar = this._detectNavbar(), null !== this._popper && this._popper.scheduleUpdate();
        }, e._addEventListeners = function () {
            var t = this;Tt(this._element).on(kt.CLICK, function (e) {
                e.preventDefault(), e.stopPropagation(), t.toggle();
            });
        }, e._getConfig = function (e) {
            return e = l({}, this.constructor.Default, Tt(this._element).data(), e), we.typeCheckConfig(St, e, this.constructor.DefaultType), e;
        }, e._getMenuElement = function () {
            if (!this._menu) {
                var e = c._getParentFromElement(this._element);e && (this._menu = e.querySelector(Ut));
            }return this._menu;
        }, e._getPlacement = function () {
            var e = Tt(this._element.parentNode),
                t = Yt;return e.hasClass(Lt) ? (t = Kt, Tt(this._menu).hasClass(Mt) && (t = Qt)) : e.hasClass(jt) ? t = zt : e.hasClass(Ht) ? t = Gt : Tt(this._menu).hasClass(Mt) && (t = Vt), t;
        }, e._detectNavbar = function () {
            return 0 < Tt(this._element).closest(".navbar").length;
        }, e._getPopperConfig = function () {
            var t = this,
                e = {};"function" == typeof this._config.offset ? e.fn = function (e) {
                return e.offsets = l({}, e.offsets, t._config.offset(e.offsets) || {}), e;
            } : e.offset = this._config.offset;var n = { placement: this._getPlacement(), modifiers: { offset: e, flip: { enabled: this._config.flip }, preventOverflow: { boundariesElement: this._config.boundary } } };return "static" === this._config.display && (n.modifiers.applyStyle = { enabled: !1 }), n;
        }, c._jQueryInterface = function (t) {
            return this.each(function () {
                var e = Tt(this).data(Dt);if (e || (e = new c(this, "object" == (typeof t === "undefined" ? "undefined" : _typeof(t)) ? t : null), Tt(this).data(Dt, e)), "string" == typeof t) {
                    if ("undefined" == typeof e[t]) throw new TypeError('No method named "' + t + '"');e[t]();
                }
            });
        }, c._clearMenus = function (e) {
            if (!e || 3 !== e.which && ("keyup" !== e.type || 9 === e.which)) for (var t = [].slice.call(document.querySelectorAll(Wt)), n = 0, i = t.length; n < i; n++) {
                var r = c._getParentFromElement(t[n]),
                    o = Tt(t[n]).data(Dt),
                    s = { relatedTarget: t[n] };if (e && "click" === e.type && (s.clickEvent = e), o) {
                    var a = o._menu;if (Tt(r).hasClass(Pt) && !(e && ("click" === e.type && /input|textarea/i.test(e.target.tagName) || "keyup" === e.type && 9 === e.which) && Tt.contains(r, e.target))) {
                        var l = Tt.Event(kt.HIDE, s);Tt(r).trigger(l), l.isDefaultPrevented() || ("ontouchstart" in document.documentElement && Tt(document.body).children().off("mouseover", null, Tt.noop), t[n].setAttribute("aria-expanded", "false"), Tt(a).removeClass(Pt), Tt(r).removeClass(Pt).trigger(Tt.Event(kt.HIDDEN, s)));
                    }
                }
            }
        }, c._getParentFromElement = function (e) {
            var t,
                n = we.getSelectorFromElement(e);return n && (t = document.querySelector(n)), t || e.parentNode;
        }, c._dataApiKeydownHandler = function (e) {
            if ((/input|textarea/i.test(e.target.tagName) ? !(32 === e.which || 27 !== e.which && (40 !== e.which && 38 !== e.which || Tt(e.target).closest(Ut).length)) : Nt.test(e.which)) && (e.preventDefault(), e.stopPropagation(), !this.disabled && !Tt(this).hasClass(xt))) {
                var t = c._getParentFromElement(this),
                    n = Tt(t).hasClass(Pt);if ((n || 27 === e.which && 32 === e.which) && (!n || 27 !== e.which && 32 !== e.which)) {
                    var i = [].slice.call(t.querySelectorAll(qt));if (0 !== i.length) {
                        var r = i.indexOf(e.target);38 === e.which && 0 < r && r--, 40 === e.which && r < i.length - 1 && r++, r < 0 && (r = 0), i[r].focus();
                    }
                } else {
                    if (27 === e.which) {
                        var o = t.querySelector(Wt);Tt(o).trigger("focus");
                    }Tt(this).trigger("click");
                }
            }
        }, s(c, null, [{ key: "VERSION", get: function get() {
                return "4.1.3";
            } }, { key: "Default", get: function get() {
                return Jt;
            } }, { key: "DefaultType", get: function get() {
                return Zt;
            } }]), c;
    }(), Tt(document).on(kt.KEYDOWN_DATA_API, Wt, Xt._dataApiKeydownHandler).on(kt.KEYDOWN_DATA_API, Ut, Xt._dataApiKeydownHandler).on(kt.CLICK_DATA_API + " " + kt.KEYUP_DATA_API, Xt._clearMenus).on(kt.CLICK_DATA_API, Wt, function (e) {
        e.preventDefault(), e.stopPropagation(), Xt._jQueryInterface.call(Tt(this), "toggle");
    }).on(kt.CLICK_DATA_API, Rt, function (e) {
        e.stopPropagation();
    }), Tt.fn[St] = Xt._jQueryInterface, Tt.fn[St].Constructor = Xt, Tt.fn[St].noConflict = function () {
        return Tt.fn[St] = Ot, Xt._jQueryInterface;
    }, Xt),
        qi = (en = "modal", nn = "." + (tn = "bs.modal"), rn = ($t = t).fn[en], on = { backdrop: !0, keyboard: !0, focus: !0, show: !0 }, sn = { backdrop: "(boolean|string)", keyboard: "boolean", focus: "boolean", show: "boolean" }, an = { HIDE: "hide" + nn, HIDDEN: "hidden" + nn, SHOW: "show" + nn, SHOWN: "shown" + nn, FOCUSIN: "focusin" + nn, RESIZE: "resize" + nn, CLICK_DISMISS: "click.dismiss" + nn, KEYDOWN_DISMISS: "keydown.dismiss" + nn, MOUSEUP_DISMISS: "mouseup.dismiss" + nn, MOUSEDOWN_DISMISS: "mousedown.dismiss" + nn, CLICK_DATA_API: "click" + nn + ".data-api" }, ln = "modal-scrollbar-measure", cn = "modal-backdrop", un = "modal-open", fn = "fade", hn = "show", dn = ".modal-dialog", pn = '[data-toggle="modal"]', mn = '[data-dismiss="modal"]', gn = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top", _n = ".sticky-top", vn = function () {
        function r(e, t) {
            this._config = this._getConfig(t), this._element = e, this._dialog = e.querySelector(dn), this._backdrop = null, this._isShown = !1, this._isBodyOverflowing = !1, this._ignoreBackdropClick = !1, this._scrollbarWidth = 0;
        }var e = r.prototype;return e.toggle = function (e) {
            return this._isShown ? this.hide() : this.show(e);
        }, e.show = function (e) {
            var t = this;if (!this._isTransitioning && !this._isShown) {
                $t(this._element).hasClass(fn) && (this._isTransitioning = !0);var n = $t.Event(an.SHOW, { relatedTarget: e });$t(this._element).trigger(n), this._isShown || n.isDefaultPrevented() || (this._isShown = !0, this._checkScrollbar(), this._setScrollbar(), this._adjustDialog(), $t(document.body).addClass(un), this._setEscapeEvent(), this._setResizeEvent(), $t(this._element).on(an.CLICK_DISMISS, mn, function (e) {
                    return t.hide(e);
                }), $t(this._dialog).on(an.MOUSEDOWN_DISMISS, function () {
                    $t(t._element).one(an.MOUSEUP_DISMISS, function (e) {
                        $t(e.target).is(t._element) && (t._ignoreBackdropClick = !0);
                    });
                }), this._showBackdrop(function () {
                    return t._showElement(e);
                }));
            }
        }, e.hide = function (e) {
            var t = this;if (e && e.preventDefault(), !this._isTransitioning && this._isShown) {
                var n = $t.Event(an.HIDE);if ($t(this._element).trigger(n), this._isShown && !n.isDefaultPrevented()) {
                    this._isShown = !1;var i = $t(this._element).hasClass(fn);if (i && (this._isTransitioning = !0), this._setEscapeEvent(), this._setResizeEvent(), $t(document).off(an.FOCUSIN), $t(this._element).removeClass(hn), $t(this._element).off(an.CLICK_DISMISS), $t(this._dialog).off(an.MOUSEDOWN_DISMISS), i) {
                        var r = we.getTransitionDurationFromElement(this._element);$t(this._element).one(we.TRANSITION_END, function (e) {
                            return t._hideModal(e);
                        }).emulateTransitionEnd(r);
                    } else this._hideModal();
                }
            }
        }, e.dispose = function () {
            $t.removeData(this._element, tn), $t(window, document, this._element, this._backdrop).off(nn), this._config = null, this._element = null, this._dialog = null, this._backdrop = null, this._isShown = null, this._isBodyOverflowing = null, this._ignoreBackdropClick = null, this._scrollbarWidth = null;
        }, e.handleUpdate = function () {
            this._adjustDialog();
        }, e._getConfig = function (e) {
            return e = l({}, on, e), we.typeCheckConfig(en, e, sn), e;
        }, e._showElement = function (e) {
            var t = this,
                n = $t(this._element).hasClass(fn);this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE || document.body.appendChild(this._element), this._element.style.display = "block", this._element.removeAttribute("aria-hidden"), this._element.scrollTop = 0, n && we.reflow(this._element), $t(this._element).addClass(hn), this._config.focus && this._enforceFocus();var i = $t.Event(an.SHOWN, { relatedTarget: e }),
                r = function r() {
                t._config.focus && t._element.focus(), t._isTransitioning = !1, $t(t._element).trigger(i);
            };if (n) {
                var o = we.getTransitionDurationFromElement(this._element);$t(this._dialog).one(we.TRANSITION_END, r).emulateTransitionEnd(o);
            } else r();
        }, e._enforceFocus = function () {
            var t = this;$t(document).off(an.FOCUSIN).on(an.FOCUSIN, function (e) {
                document !== e.target && t._element !== e.target && 0 === $t(t._element).has(e.target).length && t._element.focus();
            });
        }, e._setEscapeEvent = function () {
            var t = this;this._isShown && this._config.keyboard ? $t(this._element).on(an.KEYDOWN_DISMISS, function (e) {
                27 === e.which && (e.preventDefault(), t.hide());
            }) : this._isShown || $t(this._element).off(an.KEYDOWN_DISMISS);
        }, e._setResizeEvent = function () {
            var t = this;this._isShown ? $t(window).on(an.RESIZE, function (e) {
                return t.handleUpdate(e);
            }) : $t(window).off(an.RESIZE);
        }, e._hideModal = function () {
            var e = this;this._element.style.display = "none", this._element.setAttribute("aria-hidden", !0), this._isTransitioning = !1, this._showBackdrop(function () {
                $t(document.body).removeClass(un), e._resetAdjustments(), e._resetScrollbar(), $t(e._element).trigger(an.HIDDEN);
            });
        }, e._removeBackdrop = function () {
            this._backdrop && ($t(this._backdrop).remove(), this._backdrop = null);
        }, e._showBackdrop = function (e) {
            var t = this,
                n = $t(this._element).hasClass(fn) ? fn : "";if (this._isShown && this._config.backdrop) {
                if (this._backdrop = document.createElement("div"), this._backdrop.className = cn, n && this._backdrop.classList.add(n), $t(this._backdrop).appendTo(document.body), $t(this._element).on(an.CLICK_DISMISS, function (e) {
                    t._ignoreBackdropClick ? t._ignoreBackdropClick = !1 : e.target === e.currentTarget && ("static" === t._config.backdrop ? t._element.focus() : t.hide());
                }), n && we.reflow(this._backdrop), $t(this._backdrop).addClass(hn), !e) return;if (!n) return void e();var i = we.getTransitionDurationFromElement(this._backdrop);$t(this._backdrop).one(we.TRANSITION_END, e).emulateTransitionEnd(i);
            } else if (!this._isShown && this._backdrop) {
                $t(this._backdrop).removeClass(hn);var r = function r() {
                    t._removeBackdrop(), e && e();
                };if ($t(this._element).hasClass(fn)) {
                    var o = we.getTransitionDurationFromElement(this._backdrop);$t(this._backdrop).one(we.TRANSITION_END, r).emulateTransitionEnd(o);
                } else r();
            } else e && e();
        }, e._adjustDialog = function () {
            var e = this._element.scrollHeight > document.documentElement.clientHeight;!this._isBodyOverflowing && e && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !e && (this._element.style.paddingRight = this._scrollbarWidth + "px");
        }, e._resetAdjustments = function () {
            this._element.style.paddingLeft = "", this._element.style.paddingRight = "";
        }, e._checkScrollbar = function () {
            var e = document.body.getBoundingClientRect();this._isBodyOverflowing = e.left + e.right < window.innerWidth, this._scrollbarWidth = this._getScrollbarWidth();
        }, e._setScrollbar = function () {
            var r = this;if (this._isBodyOverflowing) {
                var e = [].slice.call(document.querySelectorAll(gn)),
                    t = [].slice.call(document.querySelectorAll(_n));$t(e).each(function (e, t) {
                    var n = t.style.paddingRight,
                        i = $t(t).css("padding-right");$t(t).data("padding-right", n).css("padding-right", parseFloat(i) + r._scrollbarWidth + "px");
                }), $t(t).each(function (e, t) {
                    var n = t.style.marginRight,
                        i = $t(t).css("margin-right");$t(t).data("margin-right", n).css("margin-right", parseFloat(i) - r._scrollbarWidth + "px");
                });var n = document.body.style.paddingRight,
                    i = $t(document.body).css("padding-right");$t(document.body).data("padding-right", n).css("padding-right", parseFloat(i) + this._scrollbarWidth + "px");
            }
        }, e._resetScrollbar = function () {
            var e = [].slice.call(document.querySelectorAll(gn));$t(e).each(function (e, t) {
                var n = $t(t).data("padding-right");$t(t).removeData("padding-right"), t.style.paddingRight = n || "";
            });var t = [].slice.call(document.querySelectorAll("" + _n));$t(t).each(function (e, t) {
                var n = $t(t).data("margin-right");"undefined" != typeof n && $t(t).css("margin-right", n).removeData("margin-right");
            });var n = $t(document.body).data("padding-right");$t(document.body).removeData("padding-right"), document.body.style.paddingRight = n || "";
        }, e._getScrollbarWidth = function () {
            var e = document.createElement("div");e.className = ln, document.body.appendChild(e);var t = e.getBoundingClientRect().width - e.clientWidth;return document.body.removeChild(e), t;
        }, r._jQueryInterface = function (n, i) {
            return this.each(function () {
                var e = $t(this).data(tn),
                    t = l({}, on, $t(this).data(), "object" == (typeof n === "undefined" ? "undefined" : _typeof(n)) && n ? n : {});if (e || (e = new r(this, t), $t(this).data(tn, e)), "string" == typeof n) {
                    if ("undefined" == typeof e[n]) throw new TypeError('No method named "' + n + '"');e[n](i);
                } else t.show && e.show(i);
            });
        }, s(r, null, [{ key: "VERSION", get: function get() {
                return "4.1.3";
            } }, { key: "Default", get: function get() {
                return on;
            } }]), r;
    }(), $t(document).on(an.CLICK_DATA_API, pn, function (e) {
        var t,
            n = this,
            i = we.getSelectorFromElement(this);i && (t = document.querySelector(i));var r = $t(t).data(tn) ? "toggle" : l({}, $t(t).data(), $t(this).data());"A" !== this.tagName && "AREA" !== this.tagName || e.preventDefault();var o = $t(t).one(an.SHOW, function (e) {
            e.isDefaultPrevented() || o.one(an.HIDDEN, function () {
                $t(n).is(":visible") && n.focus();
            });
        });vn._jQueryInterface.call($t(t), r, this);
    }), $t.fn[en] = vn._jQueryInterface, $t.fn[en].Constructor = vn, $t.fn[en].noConflict = function () {
        return $t.fn[en] = rn, vn._jQueryInterface;
    }, vn),
        Ki = (En = "tooltip", wn = "." + (bn = "bs.tooltip"), Cn = (yn = t).fn[En], Tn = "bs-tooltip", Sn = new RegExp("(^|\\s)" + Tn + "\\S+", "g"), In = { animation: !0, template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>', trigger: "hover focus", title: "", delay: 0, html: !(An = { AUTO: "auto", TOP: "top", RIGHT: "right", BOTTOM: "bottom", LEFT: "left" }), selector: !(Dn = { animation: "boolean", template: "string", title: "(string|element|function)", trigger: "string", delay: "(number|object)", html: "boolean", selector: "(string|boolean)", placement: "(string|function)", offset: "(number|string)", container: "(string|element|boolean)", fallbackPlacement: "(string|array)", boundary: "(string|element)" }), placement: "top", offset: 0, container: !1, fallbackPlacement: "flip", boundary: "scrollParent" }, Nn = "out", kn = { HIDE: "hide" + wn, HIDDEN: "hidden" + wn, SHOW: (On = "show") + wn, SHOWN: "shown" + wn, INSERTED: "inserted" + wn, CLICK: "click" + wn, FOCUSIN: "focusin" + wn, FOCUSOUT: "focusout" + wn, MOUSEENTER: "mouseenter" + wn, MOUSELEAVE: "mouseleave" + wn }, xn = "fade", Pn = "show", Ln = ".tooltip-inner", jn = ".arrow", Hn = "hover", Mn = "focus", Fn = "click", Wn = "manual", Rn = function () {
        function i(e, t) {
            if ("undefined" == typeof Ct) throw new TypeError("Bootstrap tooltips require Popper.js (https://popper.js.org)");this._isEnabled = !0, this._timeout = 0, this._hoverState = "", this._activeTrigger = {}, this._popper = null, this.element = e, this.config = this._getConfig(t), this.tip = null, this._setListeners();
        }var e = i.prototype;return e.enable = function () {
            this._isEnabled = !0;
        }, e.disable = function () {
            this._isEnabled = !1;
        }, e.toggleEnabled = function () {
            this._isEnabled = !this._isEnabled;
        }, e.toggle = function (e) {
            if (this._isEnabled) if (e) {
                var t = this.constructor.DATA_KEY,
                    n = yn(e.currentTarget).data(t);n || (n = new this.constructor(e.currentTarget, this._getDelegateConfig()), yn(e.currentTarget).data(t, n)), n._activeTrigger.click = !n._activeTrigger.click, n._isWithActiveTrigger() ? n._enter(null, n) : n._leave(null, n);
            } else {
                if (yn(this.getTipElement()).hasClass(Pn)) return void this._leave(null, this);this._enter(null, this);
            }
        }, e.dispose = function () {
            clearTimeout(this._timeout), yn.removeData(this.element, this.constructor.DATA_KEY), yn(this.element).off(this.constructor.EVENT_KEY), yn(this.element).closest(".modal").off("hide.bs.modal"), this.tip && yn(this.tip).remove(), this._isEnabled = null, this._timeout = null, this._hoverState = null, (this._activeTrigger = null) !== this._popper && this._popper.destroy(), this._popper = null, this.element = null, this.config = null, this.tip = null;
        }, e.show = function () {
            var t = this;if ("none" === yn(this.element).css("display")) throw new Error("Please use show on visible elements");var e = yn.Event(this.constructor.Event.SHOW);if (this.isWithContent() && this._isEnabled) {
                yn(this.element).trigger(e);var n = yn.contains(this.element.ownerDocument.documentElement, this.element);if (e.isDefaultPrevented() || !n) return;var i = this.getTipElement(),
                    r = we.getUID(this.constructor.NAME);i.setAttribute("id", r), this.element.setAttribute("aria-describedby", r), this.setContent(), this.config.animation && yn(i).addClass(xn);var o = "function" == typeof this.config.placement ? this.config.placement.call(this, i, this.element) : this.config.placement,
                    s = this._getAttachment(o);this.addAttachmentClass(s);var a = !1 === this.config.container ? document.body : yn(document).find(this.config.container);yn(i).data(this.constructor.DATA_KEY, this), yn.contains(this.element.ownerDocument.documentElement, this.tip) || yn(i).appendTo(a), yn(this.element).trigger(this.constructor.Event.INSERTED), this._popper = new Ct(this.element, i, { placement: s, modifiers: { offset: { offset: this.config.offset }, flip: { behavior: this.config.fallbackPlacement }, arrow: { element: jn }, preventOverflow: { boundariesElement: this.config.boundary } }, onCreate: function onCreate(e) {
                        e.originalPlacement !== e.placement && t._handlePopperPlacementChange(e);
                    }, onUpdate: function onUpdate(e) {
                        t._handlePopperPlacementChange(e);
                    } }), yn(i).addClass(Pn), "ontouchstart" in document.documentElement && yn(document.body).children().on("mouseover", null, yn.noop);var l = function l() {
                    t.config.animation && t._fixTransition();var e = t._hoverState;t._hoverState = null, yn(t.element).trigger(t.constructor.Event.SHOWN), e === Nn && t._leave(null, t);
                };if (yn(this.tip).hasClass(xn)) {
                    var c = we.getTransitionDurationFromElement(this.tip);yn(this.tip).one(we.TRANSITION_END, l).emulateTransitionEnd(c);
                } else l();
            }
        }, e.hide = function (e) {
            var t = this,
                n = this.getTipElement(),
                i = yn.Event(this.constructor.Event.HIDE),
                r = function r() {
                t._hoverState !== On && n.parentNode && n.parentNode.removeChild(n), t._cleanTipClass(), t.element.removeAttribute("aria-describedby"), yn(t.element).trigger(t.constructor.Event.HIDDEN), null !== t._popper && t._popper.destroy(), e && e();
            };if (yn(this.element).trigger(i), !i.isDefaultPrevented()) {
                if (yn(n).removeClass(Pn), "ontouchstart" in document.documentElement && yn(document.body).children().off("mouseover", null, yn.noop), this._activeTrigger[Fn] = !1, this._activeTrigger[Mn] = !1, this._activeTrigger[Hn] = !1, yn(this.tip).hasClass(xn)) {
                    var o = we.getTransitionDurationFromElement(n);yn(n).one(we.TRANSITION_END, r).emulateTransitionEnd(o);
                } else r();this._hoverState = "";
            }
        }, e.update = function () {
            null !== this._popper && this._popper.scheduleUpdate();
        }, e.isWithContent = function () {
            return Boolean(this.getTitle());
        }, e.addAttachmentClass = function (e) {
            yn(this.getTipElement()).addClass(Tn + "-" + e);
        }, e.getTipElement = function () {
            return this.tip = this.tip || yn(this.config.template)[0], this.tip;
        }, e.setContent = function () {
            var e = this.getTipElement();this.setElementContent(yn(e.querySelectorAll(Ln)), this.getTitle()), yn(e).removeClass(xn + " " + Pn);
        }, e.setElementContent = function (e, t) {
            var n = this.config.html;"object" == (typeof t === "undefined" ? "undefined" : _typeof(t)) && (t.nodeType || t.jquery) ? n ? yn(t).parent().is(e) || e.empty().append(t) : e.text(yn(t).text()) : e[n ? "html" : "text"](t);
        }, e.getTitle = function () {
            var e = this.element.getAttribute("data-original-title");return e || (e = "function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title), e;
        }, e._getAttachment = function (e) {
            return An[e.toUpperCase()];
        }, e._setListeners = function () {
            var i = this;this.config.trigger.split(" ").forEach(function (e) {
                if ("click" === e) yn(i.element).on(i.constructor.Event.CLICK, i.config.selector, function (e) {
                    return i.toggle(e);
                });else if (e !== Wn) {
                    var t = e === Hn ? i.constructor.Event.MOUSEENTER : i.constructor.Event.FOCUSIN,
                        n = e === Hn ? i.constructor.Event.MOUSELEAVE : i.constructor.Event.FOCUSOUT;yn(i.element).on(t, i.config.selector, function (e) {
                        return i._enter(e);
                    }).on(n, i.config.selector, function (e) {
                        return i._leave(e);
                    });
                }yn(i.element).closest(".modal").on("hide.bs.modal", function () {
                    return i.hide();
                });
            }), this.config.selector ? this.config = l({}, this.config, { trigger: "manual", selector: "" }) : this._fixTitle();
        }, e._fixTitle = function () {
            var e = _typeof(this.element.getAttribute("data-original-title"));(this.element.getAttribute("title") || "string" !== e) && (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""));
        }, e._enter = function (e, t) {
            var n = this.constructor.DATA_KEY;(t = t || yn(e.currentTarget).data(n)) || (t = new this.constructor(e.currentTarget, this._getDelegateConfig()), yn(e.currentTarget).data(n, t)), e && (t._activeTrigger["focusin" === e.type ? Mn : Hn] = !0), yn(t.getTipElement()).hasClass(Pn) || t._hoverState === On ? t._hoverState = On : (clearTimeout(t._timeout), t._hoverState = On, t.config.delay && t.config.delay.show ? t._timeout = setTimeout(function () {
                t._hoverState === On && t.show();
            }, t.config.delay.show) : t.show());
        }, e._leave = function (e, t) {
            var n = this.constructor.DATA_KEY;(t = t || yn(e.currentTarget).data(n)) || (t = new this.constructor(e.currentTarget, this._getDelegateConfig()), yn(e.currentTarget).data(n, t)), e && (t._activeTrigger["focusout" === e.type ? Mn : Hn] = !1), t._isWithActiveTrigger() || (clearTimeout(t._timeout), t._hoverState = Nn, t.config.delay && t.config.delay.hide ? t._timeout = setTimeout(function () {
                t._hoverState === Nn && t.hide();
            }, t.config.delay.hide) : t.hide());
        }, e._isWithActiveTrigger = function () {
            for (var e in this._activeTrigger) {
                if (this._activeTrigger[e]) return !0;
            }return !1;
        }, e._getConfig = function (e) {
            return "number" == typeof (e = l({}, this.constructor.Default, yn(this.element).data(), "object" == (typeof e === "undefined" ? "undefined" : _typeof(e)) && e ? e : {})).delay && (e.delay = { show: e.delay, hide: e.delay }), "number" == typeof e.title && (e.title = e.title.toString()), "number" == typeof e.content && (e.content = e.content.toString()), we.typeCheckConfig(En, e, this.constructor.DefaultType), e;
        }, e._getDelegateConfig = function () {
            var e = {};if (this.config) for (var t in this.config) {
                this.constructor.Default[t] !== this.config[t] && (e[t] = this.config[t]);
            }return e;
        }, e._cleanTipClass = function () {
            var e = yn(this.getTipElement()),
                t = e.attr("class").match(Sn);null !== t && t.length && e.removeClass(t.join(""));
        }, e._handlePopperPlacementChange = function (e) {
            var t = e.instance;this.tip = t.popper, this._cleanTipClass(), this.addAttachmentClass(this._getAttachment(e.placement));
        }, e._fixTransition = function () {
            var e = this.getTipElement(),
                t = this.config.animation;null === e.getAttribute("x-placement") && (yn(e).removeClass(xn), this.config.animation = !1, this.hide(), this.show(), this.config.animation = t);
        }, i._jQueryInterface = function (n) {
            return this.each(function () {
                var e = yn(this).data(bn),
                    t = "object" == (typeof n === "undefined" ? "undefined" : _typeof(n)) && n;if ((e || !/dispose|hide/.test(n)) && (e || (e = new i(this, t), yn(this).data(bn, e)), "string" == typeof n)) {
                    if ("undefined" == typeof e[n]) throw new TypeError('No method named "' + n + '"');e[n]();
                }
            });
        }, s(i, null, [{ key: "VERSION", get: function get() {
                return "4.1.3";
            } }, { key: "Default", get: function get() {
                return In;
            } }, { key: "NAME", get: function get() {
                return En;
            } }, { key: "DATA_KEY", get: function get() {
                return bn;
            } }, { key: "Event", get: function get() {
                return kn;
            } }, { key: "EVENT_KEY", get: function get() {
                return wn;
            } }, { key: "DefaultType", get: function get() {
                return Dn;
            } }]), i;
    }(), yn.fn[En] = Rn._jQueryInterface, yn.fn[En].Constructor = Rn, yn.fn[En].noConflict = function () {
        return yn.fn[En] = Cn, Rn._jQueryInterface;
    }, Rn),
        Qi = (Bn = "popover", Kn = "." + (qn = "bs.popover"), Qn = (Un = t).fn[Bn], Yn = "bs-popover", Vn = new RegExp("(^|\\s)" + Yn + "\\S+", "g"), zn = l({}, Ki.Default, { placement: "right", trigger: "click", content: "", template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>' }), Gn = l({}, Ki.DefaultType, { content: "(string|element|function)" }), Jn = "fade", Xn = ".popover-header", $n = ".popover-body", ei = { HIDE: "hide" + Kn, HIDDEN: "hidden" + Kn, SHOW: (Zn = "show") + Kn, SHOWN: "shown" + Kn, INSERTED: "inserted" + Kn, CLICK: "click" + Kn, FOCUSIN: "focusin" + Kn, FOCUSOUT: "focusout" + Kn, MOUSEENTER: "mouseenter" + Kn, MOUSELEAVE: "mouseleave" + Kn }, ti = function (e) {
        var t, n;function i() {
            return e.apply(this, arguments) || this;
        }n = e, (t = i).prototype = Object.create(n.prototype), (t.prototype.constructor = t).__proto__ = n;var r = i.prototype;return r.isWithContent = function () {
            return this.getTitle() || this._getContent();
        }, r.addAttachmentClass = function (e) {
            Un(this.getTipElement()).addClass(Yn + "-" + e);
        }, r.getTipElement = function () {
            return this.tip = this.tip || Un(this.config.template)[0], this.tip;
        }, r.setContent = function () {
            var e = Un(this.getTipElement());this.setElementContent(e.find(Xn), this.getTitle());var t = this._getContent();"function" == typeof t && (t = t.call(this.element)), this.setElementContent(e.find($n), t), e.removeClass(Jn + " " + Zn);
        }, r._getContent = function () {
            return this.element.getAttribute("data-content") || this.config.content;
        }, r._cleanTipClass = function () {
            var e = Un(this.getTipElement()),
                t = e.attr("class").match(Vn);null !== t && 0 < t.length && e.removeClass(t.join(""));
        }, i._jQueryInterface = function (n) {
            return this.each(function () {
                var e = Un(this).data(qn),
                    t = "object" == (typeof n === "undefined" ? "undefined" : _typeof(n)) ? n : null;if ((e || !/destroy|hide/.test(n)) && (e || (e = new i(this, t), Un(this).data(qn, e)), "string" == typeof n)) {
                    if ("undefined" == typeof e[n]) throw new TypeError('No method named "' + n + '"');e[n]();
                }
            });
        }, s(i, null, [{ key: "VERSION", get: function get() {
                return "4.1.3";
            } }, { key: "Default", get: function get() {
                return zn;
            } }, { key: "NAME", get: function get() {
                return Bn;
            } }, { key: "DATA_KEY", get: function get() {
                return qn;
            } }, { key: "Event", get: function get() {
                return ei;
            } }, { key: "EVENT_KEY", get: function get() {
                return Kn;
            } }, { key: "DefaultType", get: function get() {
                return Gn;
            } }]), i;
    }(Ki), Un.fn[Bn] = ti._jQueryInterface, Un.fn[Bn].Constructor = ti, Un.fn[Bn].noConflict = function () {
        return Un.fn[Bn] = Qn, ti._jQueryInterface;
    }, ti),
        Yi = (ii = "scrollspy", oi = "." + (ri = "bs.scrollspy"), si = (ni = t).fn[ii], ai = { offset: 10, method: "auto", target: "" }, li = { offset: "number", method: "string", target: "(string|element)" }, ci = { ACTIVATE: "activate" + oi, SCROLL: "scroll" + oi, LOAD_DATA_API: "load" + oi + ".data-api" }, ui = "dropdown-item", fi = "active", hi = '[data-spy="scroll"]', di = ".active", pi = ".nav, .list-group", mi = ".nav-link", gi = ".nav-item", _i = ".list-group-item", vi = ".dropdown", yi = ".dropdown-item", Ei = ".dropdown-toggle", bi = "offset", wi = "position", Ci = function () {
        function n(e, t) {
            var n = this;this._element = e, this._scrollElement = "BODY" === e.tagName ? window : e, this._config = this._getConfig(t), this._selector = this._config.target + " " + mi + "," + this._config.target + " " + _i + "," + this._config.target + " " + yi, this._offsets = [], this._targets = [], this._activeTarget = null, this._scrollHeight = 0, ni(this._scrollElement).on(ci.SCROLL, function (e) {
                return n._process(e);
            }), this.refresh(), this._process();
        }var e = n.prototype;return e.refresh = function () {
            var t = this,
                e = this._scrollElement === this._scrollElement.window ? bi : wi,
                r = "auto" === this._config.method ? e : this._config.method,
                o = r === wi ? this._getScrollTop() : 0;this._offsets = [], this._targets = [], this._scrollHeight = this._getScrollHeight(), [].slice.call(document.querySelectorAll(this._selector)).map(function (e) {
                var t,
                    n = we.getSelectorFromElement(e);if (n && (t = document.querySelector(n)), t) {
                    var i = t.getBoundingClientRect();if (i.width || i.height) return [ni(t)[r]().top + o, n];
                }return null;
            }).filter(function (e) {
                return e;
            }).sort(function (e, t) {
                return e[0] - t[0];
            }).forEach(function (e) {
                t._offsets.push(e[0]), t._targets.push(e[1]);
            });
        }, e.dispose = function () {
            ni.removeData(this._element, ri), ni(this._scrollElement).off(oi), this._element = null, this._scrollElement = null, this._config = null, this._selector = null, this._offsets = null, this._targets = null, this._activeTarget = null, this._scrollHeight = null;
        }, e._getConfig = function (e) {
            if ("string" != typeof (e = l({}, ai, "object" == (typeof e === "undefined" ? "undefined" : _typeof(e)) && e ? e : {})).target) {
                var t = ni(e.target).attr("id");t || (t = we.getUID(ii), ni(e.target).attr("id", t)), e.target = "#" + t;
            }return we.typeCheckConfig(ii, e, li), e;
        }, e._getScrollTop = function () {
            return this._scrollElement === window ? this._scrollElement.pageYOffset : this._scrollElement.scrollTop;
        }, e._getScrollHeight = function () {
            return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
        }, e._getOffsetHeight = function () {
            return this._scrollElement === window ? window.innerHeight : this._scrollElement.getBoundingClientRect().height;
        }, e._process = function () {
            var e = this._getScrollTop() + this._config.offset,
                t = this._getScrollHeight(),
                n = this._config.offset + t - this._getOffsetHeight();if (this._scrollHeight !== t && this.refresh(), n <= e) {
                var i = this._targets[this._targets.length - 1];this._activeTarget !== i && this._activate(i);
            } else {
                if (this._activeTarget && e < this._offsets[0] && 0 < this._offsets[0]) return this._activeTarget = null, void this._clear();for (var r = this._offsets.length; r--;) {
                    this._activeTarget !== this._targets[r] && e >= this._offsets[r] && ("undefined" == typeof this._offsets[r + 1] || e < this._offsets[r + 1]) && this._activate(this._targets[r]);
                }
            }
        }, e._activate = function (t) {
            this._activeTarget = t, this._clear();var e = this._selector.split(",");e = e.map(function (e) {
                return e + '[data-target="' + t + '"],' + e + '[href="' + t + '"]';
            });var n = ni([].slice.call(document.querySelectorAll(e.join(","))));n.hasClass(ui) ? (n.closest(vi).find(Ei).addClass(fi), n.addClass(fi)) : (n.addClass(fi), n.parents(pi).prev(mi + ", " + _i).addClass(fi), n.parents(pi).prev(gi).children(mi).addClass(fi)), ni(this._scrollElement).trigger(ci.ACTIVATE, { relatedTarget: t });
        }, e._clear = function () {
            var e = [].slice.call(document.querySelectorAll(this._selector));ni(e).filter(di).removeClass(fi);
        }, n._jQueryInterface = function (t) {
            return this.each(function () {
                var e = ni(this).data(ri);if (e || (e = new n(this, "object" == (typeof t === "undefined" ? "undefined" : _typeof(t)) && t), ni(this).data(ri, e)), "string" == typeof t) {
                    if ("undefined" == typeof e[t]) throw new TypeError('No method named "' + t + '"');e[t]();
                }
            });
        }, s(n, null, [{ key: "VERSION", get: function get() {
                return "4.1.3";
            } }, { key: "Default", get: function get() {
                return ai;
            } }]), n;
    }(), ni(window).on(ci.LOAD_DATA_API, function () {
        for (var e = [].slice.call(document.querySelectorAll(hi)), t = e.length; t--;) {
            var n = ni(e[t]);Ci._jQueryInterface.call(n, n.data());
        }
    }), ni.fn[ii] = Ci._jQueryInterface, ni.fn[ii].Constructor = Ci, ni.fn[ii].noConflict = function () {
        return ni.fn[ii] = si, Ci._jQueryInterface;
    }, Ci),
        Vi = (Di = "." + (Si = "bs.tab"), Ai = (Ti = t).fn.tab, Ii = { HIDE: "hide" + Di, HIDDEN: "hidden" + Di, SHOW: "show" + Di, SHOWN: "shown" + Di, CLICK_DATA_API: "click" + Di + ".data-api" }, Oi = "dropdown-menu", Ni = "active", ki = "disabled", xi = "fade", Pi = "show", Li = ".dropdown", ji = ".nav, .list-group", Hi = ".active", Mi = "> li > .active", Fi = '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]', Wi = ".dropdown-toggle", Ri = "> .dropdown-menu .active", Ui = function () {
        function i(e) {
            this._element = e;
        }var e = i.prototype;return e.show = function () {
            var n = this;if (!(this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && Ti(this._element).hasClass(Ni) || Ti(this._element).hasClass(ki))) {
                var e,
                    i,
                    t = Ti(this._element).closest(ji)[0],
                    r = we.getSelectorFromElement(this._element);if (t) {
                    var o = "UL" === t.nodeName ? Mi : Hi;i = (i = Ti.makeArray(Ti(t).find(o)))[i.length - 1];
                }var s = Ti.Event(Ii.HIDE, { relatedTarget: this._element }),
                    a = Ti.Event(Ii.SHOW, { relatedTarget: i });if (i && Ti(i).trigger(s), Ti(this._element).trigger(a), !a.isDefaultPrevented() && !s.isDefaultPrevented()) {
                    r && (e = document.querySelector(r)), this._activate(this._element, t);var l = function l() {
                        var e = Ti.Event(Ii.HIDDEN, { relatedTarget: n._element }),
                            t = Ti.Event(Ii.SHOWN, { relatedTarget: i });Ti(i).trigger(e), Ti(n._element).trigger(t);
                    };e ? this._activate(e, e.parentNode, l) : l();
                }
            }
        }, e.dispose = function () {
            Ti.removeData(this._element, Si), this._element = null;
        }, e._activate = function (e, t, n) {
            var i = this,
                r = ("UL" === t.nodeName ? Ti(t).find(Mi) : Ti(t).children(Hi))[0],
                o = n && r && Ti(r).hasClass(xi),
                s = function s() {
                return i._transitionComplete(e, r, n);
            };if (r && o) {
                var a = we.getTransitionDurationFromElement(r);Ti(r).one(we.TRANSITION_END, s).emulateTransitionEnd(a);
            } else s();
        }, e._transitionComplete = function (e, t, n) {
            if (t) {
                Ti(t).removeClass(Pi + " " + Ni);var i = Ti(t.parentNode).find(Ri)[0];i && Ti(i).removeClass(Ni), "tab" === t.getAttribute("role") && t.setAttribute("aria-selected", !1);
            }if (Ti(e).addClass(Ni), "tab" === e.getAttribute("role") && e.setAttribute("aria-selected", !0), we.reflow(e), Ti(e).addClass(Pi), e.parentNode && Ti(e.parentNode).hasClass(Oi)) {
                var r = Ti(e).closest(Li)[0];if (r) {
                    var o = [].slice.call(r.querySelectorAll(Wi));Ti(o).addClass(Ni);
                }e.setAttribute("aria-expanded", !0);
            }n && n();
        }, i._jQueryInterface = function (n) {
            return this.each(function () {
                var e = Ti(this),
                    t = e.data(Si);if (t || (t = new i(this), e.data(Si, t)), "string" == typeof n) {
                    if ("undefined" == typeof t[n]) throw new TypeError('No method named "' + n + '"');t[n]();
                }
            });
        }, s(i, null, [{ key: "VERSION", get: function get() {
                return "4.1.3";
            } }]), i;
    }(), Ti(document).on(Ii.CLICK_DATA_API, Fi, function (e) {
        e.preventDefault(), Ui._jQueryInterface.call(Ti(this), "show");
    }), Ti.fn.tab = Ui._jQueryInterface, Ti.fn.tab.Constructor = Ui, Ti.fn.tab.noConflict = function () {
        return Ti.fn.tab = Ai, Ui._jQueryInterface;
    }, Ui);!function (e) {
        if ("undefined" == typeof e) throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");var t = e.fn.jquery.split(" ")[0].split(".");if (t[0] < 2 && t[1] < 9 || 1 === t[0] && 9 === t[1] && t[2] < 1 || 4 <= t[0]) throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0");
    }(t), e.Util = we, e.Alert = Ce, e.Button = Te, e.Carousel = Se, e.Collapse = De, e.Dropdown = Bi, e.Modal = qi, e.Popover = Qi, e.Scrollspy = Yi, e.Tab = Vi, e.Tooltip = Ki, Object.defineProperty(e, "__esModule", { value: !0 });
});
//# sourceMappingURL=bootstrap.bundle.min.js.map
$(document).ready(function () {

    function Hover_slider() {
        var _this = this;

        this.myEvents = function () {

            $("body").on('mouseover', '.product-card_thumb-img-holder', function () {
                var img_path = $(this).find("img").attr("src");
                var alt_text = $(this).find("img").attr("alt");
                $(this).closest('.product-card_thumb-img-holder');
                $(this).parent().find('.product-card_thumb-img-holder').removeClass("active_slider");
                $(this).addClass("active_slider");
                console.log($(this));
                $(this).closest(".product-card").find('.card-img-top').attr("src", img_path);
                $(".main-image-alt-text").text(alt_text);
            });
        };
        this.products = function () {
            $("body").on('mouseover', ".product-single-view-outer .product-card_thumb-img-holder", function () {
                console.log(1);
                $('.product-single-view-outer .product-card_thumb-img-holder').removeClass("active_slider");
                var img_path = $(this).find("img").attr("src");

                $(".product-single-view-outer .product-card_view--single img").addClass("active_slider").attr("src", img_path);
                $(".product-single-view-outer .product-card_view--single .product-single-lightbox-item").attr("href", img_path);
                $(this).addClass("active_slider");
            });
        };
    }

    var app = new Hover_slider();
    app.myEvents();
    app.products();
});

$(document).ready(function () {
    heightBlock('.main-left-tabs .nav', '.main-left-tabs .nav a');
    $(window).resize(function () {
        heightBlock('.main-left-tabs .nav', '.main-left-tabs .nav a');
    });

    $('body').on('click', '.product-grid-list .display-icon', function () {
        if ($(this).hasClass('list')) {
            $(this).closest('body').find('.products__all-list-product >li').addClass('products_col-list');
            $(this).closest('body').find('.products__item-wrapper').addClass('product_list');
        } else {
            $(this).closest('body').find('.products__all-list-product >li').removeClass('products_col-list');
            $(this).closest('body').find('.products__item-wrapper').removeClass('product_list');
        }
    });
    // product slider
    function Product_slider() {
        var _this = this;
        this.products = function () {
            $("body").on('mouseover', ".products__item-wrapper .products__item-photo-thumb-item", function () {
                $(this).closest('.products__item-wrapper').find('.products__item-photo-thumb-item').removeClass("active-slider");
                var img_path = $(this).find("img").attr("src");
                $(this).closest('.products__item-wrapper').find(".products__item-photo img").addClass("active-slider").attr("src", img_path);
                $(this).addClass("active-slider");
            });

            $("body").on('mouseout', ".products__item-wrapper .products__item-photo-thumb-item", function () {
                $(this).closest('.products__item-wrapper').find('.products__item-photo-thumb-item').removeClass("active-slider");
                var img_path = $(this).closest(".products__item-photo-thumb").find("img").first().attr('src');
                $(this).closest('.products__item-wrapper').find(".products__item-photo img").addClass("active-slider").attr("src", img_path);
                $(this).addClass("active-slider");
            });
        };
    }

    var productSlider = new Product_slider();
    productSlider.products();
    // product-slider
    $(".carousel_1").carousel({
        pagination: false,
        controls: false
    });
    $(".carousel_2").carousel({
        controls: false,
        pagination: false,
        autoAdvance: true,
        show: {
            "0px": 1,
            "500px": 2,
            "980px": 3
        }
    });

    // product range
    $('body').on('change', '.product-range input', function () {
        $(this).closest('.product-range').children().removeClass('active line-none');
        if ($(this).is(":checked")) {
            $(this).parent().addClass('active');
            $(this).parent().prevAll().addClass('active');
            $(this).parent().addClass('line-none');
        }
    });
    // search for mobile
    $('body').on('click', '.header-bottom .search-mobile-icon', function () {
        $(this).closest('.header-bottom').find('.cat-search').addClass('opened-full');
        $(this).hide();
        $(this).parent().find('.header-mobile-search-close').addClass('active');
    });
    $('body').on('click', '.header-bottom .header-mobile-search-close', function () {
        $(this).closest('.header-bottom').find('.cat-search').removeClass('opened-full');
        $(this).removeClass('active');
        $(this).parent().find('.search-mobile-icon').show();
    });
});

//new

$('.currency--select-2').select2({
    minimumResultsForSearch: Infinity,
    dropdownCssClass: "currency-dropdown"
});

$('.select_with-tag').select2();

$('#accounts--selects').select2({
    dropdownParent: $('.my-account--selects'),
    minimumResultsForSearch: Infinity
});

$('.select-2--no-search').select2({
    minimumResultsForSearch: Infinity
});

var afterHeight;
var productsWallHeight = parseInt($('body').find('.products-box').height());
$("body").find(".products__item-wrapper").hover(function () {
    afterHeight = parseInt($('body').find('.products__item-wrapper-inner').height());
    $(this).closest('.products-box').css('height', productsWallHeight);
    // $(this).closest('.products__item-wrapper').find('.products__item-wrapper-inner').css('height',567);
}, function () {
    $(this).closest('.products__item-wrapper').find('.products__item-wrapper-inner').css('height', 'auto');
});

$(document).ready(function () {
    $("#loading").fadeOut("slow", function () {
        var afterHeight;
        var productsWallHeight = parseInt($('body').find('.products-box').height());
        $("body").find(".products__item-wrapper").hover(function () {
            afterHeight = parseInt($('body').find('.products__item-wrapper-inner').height());
            $(this).closest('.products-box').css('height', productsWallHeight);
            // $(this).closest('.products__item-wrapper').find('.products__item-wrapper-inner').css('height',567);
        }, function () {
            $(this).closest('.products__item-wrapper').find('.products__item-wrapper-inner').css('height', 'auto');
        });

        $(this).removeClass('d-flex').addClass('d-none'); // Optional if it's going to only be used once.
        $("#singleProductPageCnt").removeClass('d-none').addClass('d-flex');

        $('body').on('click', '#carousel-tabs-wrap a[aria-controls="pills-videos"]', function () {
            $(".video--carousel").carousel({
                pagination: false,
                controls: false
            });

            $(".video--carousel-thumb").carousel({
                controls: false,
                pagination: false,
                //                show: 4,
                matchWidth: false
            });

            $('.video-carousel-wrap iframe[src*="https://www.youtube.com/embed/"]').addClass("youtube-iframe");

            $('.video-carousel-wrap .video-item-thumb').on('itemClick.carousel', function () {
                $('body .youtube-iframe').each(function (index) {
                    $(".youtube-iframe")[index].contentWindow.postMessage('{"event":"command","func":"' + "stopVideo" + '","args":""}', "*");
                    return true;
                });
            });
        });

        $(".product__single-top .brands-top-slider").carousel({
            pagination: false,
            // controls: false,
            infinite: true,
            matchWidth: false,
            show: {
                "740px": 2,
                "980px": 3,
                "1220px": 9
            }
        });
        $(".product-card-thumbs--single").carousel({
            controls: true,
            pagination: false,
            matchWidth: false
        });
        // start carousel tabs
        var activeTab = $('#carousel-tabs-wrap a').filter('.active');
        $('#carousel-tabs-wrap a').on('click', function (e) {
            e.preventDefault();
            activeTab.removeClass('active');
            $(activeTab.attr('href')).removeClass('active');
            activeTab = $(this);
            activeTab.addClass("active");
            $(activeTab.attr('href')).addClass('active');
        });
        $(".carousel-tabs").carousel({
            show: {
                "740px": 2,
                "980px": 3,
                "1220px": 2
            },
            matchWidth: false,
            controls: false,
            pagination: false
        });
        if ($(window).width() > 1400) {
            $(".carousel-tabs .fs-touch-element").touch("destroy");
        } else {
            $(".carousel-tabs .fs-touch-element").touch();
        }
        $(window).resize(function () {
            if ($(window).width() > 1400) {
                $(".carousel-tabs .fs-touch-element").touch("destroy");
            } else {
                $(".carousel-tabs .fs-touch-element").touch();
            }
        });

        //                    end carousel tabs
    });

    $('body').on('keydown', '.continue-shp-wrapp_qty .field-input', function (ev) {
        ev.preventDefault();
        return false;
    });

    $("#singleProductPageCnt").fadeIn(function () {

        function checkLimit(value, max) {
            return value <= max;
        }

        var getCurrencySymbol = function getCurrencySymbol() {
            return $('.header-bottom #symbol').val();
        };
        // $('.share-button').on('click', function(ev) {
        //     ev.stopImmediatePropagation();
        //     $('#share_modal').addClass('show');
        // });
        // $(document).click(function (e) {
        //     console.log(e.target);
        //     const containerBlock = $("#share_modal");
        //     let arrowLink = $('.share-button.facebook-share-button');
        //     console.log(arrowLink.has(e.target).length === 0,containerBlock.has(e.target).length === 0,containerBlock !== e.target);
        //     if ($(e.target).closest('#share_modal').length === 0 || $(e.target).hasClass('share_modal_close')) {
        //         if (containerBlock.hasClass('show')) {
        //             containerBlock.removeClass('show');
        //         }
        //     }
        // });
        //count total price function
        var countTotalPrice = function countTotalPrice() {
            var total_price = 0;
            $('#singleProductPageCnt .product__single-item-info-price[data-single-price]').each(function () {
                // console.log('aaaa', $(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length === 1);
                if ($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length === 1) {
                    $(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').is(":checked") ? total_price += $(this).data('single-price') * 1 : total_price = total_price;
                } else {
                    total_price += $(this).data('single-price') * 1;
                }
            });
            return (total_price * $('.continue-shp-wrapp .continue-shp-wrapp_qty input[type="number"].field-input.product-qty-select').val() * 1).toFixed(2);
        };

        var setOfferPrice = function setOfferPrice(offer, offerPrice) {
            // console.log(totalPrice, 222222222222222222);
            offer.html("" + getCurrencySymbol() + offerPrice);
        };

        var countOfferTotalPrice = function countOfferTotalPrice() {
            var offer_total_price = 0;
            $('.added-offers').find('.special__popup-content-right-product-price').each(function (key) {
                console.log(key);
                offer_total_price += Number($(this).data('price')).toFixed(2);
            });
            $('.offer-total-price').html("" + getCurrencySymbol() + offer_total_price);
        };

        var countOfferPrice = function countOfferPrice() {
            var gget = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;


            $('#specialPopUpModal .special__popup-main-product-item').each(function () {
                var value = 0;
                var id = $(this).data('id');
                $(this).find('.pr-wrap').each(function () {
                    if ($(this).data('per-price') === 'product') {
                        value += $(this).data('price');
                    } else if ($(this).data('per-price') === 'item') {
                        $(this).find('.product__single-item-info-bottom').each(function () {
                            if ($(this).closest('.product__single-item-info-bottom').find('.select-variation-option').length > 0 || $(this).hasClass('get-single-price') && $(this).closest('.filter').length > 0) {
                                value += $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price');
                            } else if ($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="radio"]').length > 0) {
                                value += $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price');
                            } else if ($(this).closest('.pr-wrap').find('.popup-select').length > 0) {
                                value += $(this).find('.get-single-price').data('single-price');
                            } else if ($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length > 0) {
                                if ($(this).closest('.product__single-item-info-bottom').find('.custom-control-input').prop('checked')) {
                                    value += $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price');
                                }
                            }
                        });
                    }
                });

                $(this).find('.product__single-item_price').data('price-for-add', value);
                setOfferPrice($(this).find('.product__single-item_price'), value);
                // var addedPricePlace = $(`#specialPopUpModal .added-offers .special__popup-content-right-product[data-id="${id}"] .special__popup-content-right-product-price`);
                // if(!$(this).hasClass('user-non-select')) {
                //     addedPricePlace.data('price', value);
                //     addedPricePlace.html(`${getCurrencySymbol()}${value}`);
                // }
                countOfferTotalPrice();
            });
        };
        var setTotalPrice = function setTotalPrice(totalPrice) {
            // console.log(totalPrice, 222222222222222222);
            totalPrice !== undefined && $('.continue-shp-wrapp .price-place-summary').html("" + getCurrencySymbol() + Number(totalPrice).toFixed(2));
        };

        countOfferPrice();

        setTotalPrice(countTotalPrice());

        $('body').on('click', " .continue-shp-wrapp_qty-minus.qty-count, .continue-shp-wrapp_qty-plus.qty-count", function () {
            var totalQtyInput = $(this).closest('.continue-shp-wrapp_qty').find('input.product-qty-select');
            console.log(111111, '--------');
            if ($(this).hasClass('continue-shp-wrapp_qty-plus')) {
                totalQtyInput.val(totalQtyInput.val() * 1 + 1);
            } else if ($(this).hasClass('continue-shp-wrapp_qty-minus') && totalQtyInput.val() * 1 > 1) {
                totalQtyInput.val(totalQtyInput.val() * 1 - 1);
            }
            setTotalPrice(countTotalPrice());
        });

        //qty up and down,  and input-qty
        $('body').on('click', '.product__single-item-info-bottom .inp-up, .product__single-item-info-bottom .inp-down', function (ev) {
            var _this2 = this;

            var flag = void 0;
            var input_qty = $(this).closest('.quantity').find('.input-qty');
            var qty = input_qty.val();
            var prevV = void 0;
            var nextV = void 0;
            console.log(222222, '--------');
            if ($(this).hasClass('inp-up')) {
                if (qty * 1 + 1 <= $(this).closest('.quantity').find('.product-qty_per_price').attr('max')) {
                    input_qty.val(qty * 1 + 1);
                    console.log(9999999, '--------');
                }
                flag = true;
            } else if ($(this).hasClass('inp-down')) {
                prevV = $(this).closest('.quantity').find('input.product-qty').val() * 1;
                qty > 1 && input_qty.val(qty * 1 - 1);
                nextV = $(this).closest('.quantity').find('input.product-qty').val() * 1;
                flag = false;
            }

            var variation_id = 0;

            if ($(this).closest('.filters-select-wizard').length > 0 || $(this).closest('.filter').find('.filters-modal-wizard').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').data('id');
            } else if ($(this).closest('.product__single-item-info-bottom').find('.select-variation-option').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').find('.select-variation-option').val();
            } else if ($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="radio"]').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').find('.custom-control-input:checked').val();
            } else if ($(this).closest('.product__single-item-info').find('.popup-select').length > 0 && $(this).closest('#singleProductPageCnt').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').data('id');
                if (prevV === 1 && nextV === 1 && !flag) {
                    return true;
                } else {
                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price', $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price') * 1 / (flag ? $(this).closest('.quantity').find('input.product-qty').val() * 1 - 1 : $(this).closest('.quantity').find('input.product-qty').val() * 1 + 1) * ($(this).closest('.quantity').find('input.product-qty').val() * 1));
                    // $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span').html(`${getCurrencySymbol()}${$(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')}`);
                    // setTotalPrice(countTotalPrice());
                    // return true;
                }
            } else if ($(this).closest('.pr-wrap').find('.popup-select').length > 0 && $(this).closest('#specialPopUpModal').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').data('id');
                if (prevV === 1 && nextV === 1 && !flag) {
                    return true;
                } else {
                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price', $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price') * 1 / (flag ? $(this).closest('.quantity').find('input.product-qty').val() * 1 - 1 : $(this).closest('.quantity').find('input.product-qty').val() * 1 + 1) * ($(this).closest('.quantity').find('input.product-qty').val() * 1));
                    // $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span').html(`${getCurrencySymbol()}${$(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')}`);
                    // setTotalPrice(countTotalPrice());
                    // return true;
                }
            } else if ($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').find('.custom-control-input').val();
                // console.log($(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')*1, ($(this).closest('.quantity').find('input.product-qty').val()*1-1), $(this).closest('.quantity').find('input.product-qty').val()*1);
                // console.log('val',$(this).closest('.product__single-item-info-bottom').find('.input.product-qty').val()*1);
                if (prevV === 1 && nextV === 1 && !flag) {
                    return true;
                } else {
                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price', $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price') * 1 / (flag ? $(this).closest('.quantity').find('input.product-qty').val() * 1 - 1 : $(this).closest('.quantity').find('input.product-qty').val() * 1 + 1) * ($(this).closest('.quantity').find('input.product-qty').val() * 1));
                    // $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span').html(`${getCurrencySymbol()}${$(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')}`);
                    // setTotalPrice(countTotalPrice());
                    // return true;
                }
            }
            var price_place = $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span');
            fetch("/products/get-discount-price", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    variation_id: variation_id,
                    qty: input_qty.val() * 1
                })
            }).then(function (res) {
                return res.json();
            }).then(function (data) {
                // alert(data.price)
                console.log(333333, '--------');

                price_place.html("" + getCurrencySymbol() + data.price);
                $(_this2).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price', data.price);
                setTotalPrice(countTotalPrice());
                if ($(_this2).closest('#specialPopUpModal')) {
                    $(_this2).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price);
                    countOfferPrice();
                }
            }).catch(function (error) {
                return console.error(error);
            });
        });

        //select variation
        $('body').on('change', '#singleProductPageCnt select.select-variation-option.single-product-select', function (ev) {
            ev.preventDefault();
            var row = $(this).closest('.product__single-item-info-bottom');
            var group_id = row.data('id');
            var select_element_id = $(this).val();
            var vpid = $('#vpid').val();
            var $self = $(this);
            var val = $(this).val();
            var img_variation = $(this).find('option:selected').attr('data-img');
            var item = row.closest('.product__single-item-info');

            var img_path = $(".product-single-view-outer").find('img[src="' + img_variation + '"]').first();
            if (img_path) {
                $('.single-product_top-img').attr("src", img_path.attr('src'));
                console.log(img_path, 'img_src_exists');
            }
            // var img_path = $(".products__item-photo-thumb").find("img").first().attr('src');
            // $(this).closest('.products__item-wrapper').find(".products__item-photo img").addClass("active-slider").attr("src", img_path);

            if (val !== 'no') {
                fetch("/products/get-variation-menu-raw", {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        group_id: group_id,
                        select_element_id: select_element_id,
                        vpid: vpid
                    })
                }).then(function (response) {
                    return response.json();
                }).then(function (data) {
                    console.log(444444, '--------');

                    row.html(data.html);
                    row.find('.select-2').select2({ minimumResultsForSearch: -1 });
                    if (item.data('per-price') === 'product') {
                        item.find('.product__single-item-info-price').data('single-price', item.data('price') * 1);
                        var currency = $('#symbol').val();
                        item.find('.product__single-item_price').text(currency + item.data('price') * 1);
                    }
                    // row.find('.product-qty').select2();
                    $self.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                    setTotalPrice(countTotalPrice());
                }).catch(function (error) {
                    console.log(error);
                });
            } else {
                if (item.data('per-price') === 'item') {
                    // item.data('price', 0);
                    item.find('.product__single-item-info-price').data('single-price', 0);
                    var currency = $('#symbol').val();
                    item.find('.product__single-item-info-price span').text(currency + item.find('.product__single-item-info-price').data('single-price') * 1);
                } else if (item.data('per-price') === 'product') {
                    // item.data('price', 0);
                    item.find('.product__single-item-info-price').data('single-price', 0);
                    var _currency = $('#symbol').val();
                    item.find('.product__single-item_price').text(_currency + item.find('.product__single-item-info-price').data('single-price') * 1);
                }
                setTotalPrice(countTotalPrice());
            }
        });

        $('body').on('change', '#specialPopUpModal select.select-variation-option.single-product-select', function (ev) {
            ev.preventDefault();
            var row = $(this).closest('.product__single-item-info-bottom');
            var group_id = row.data('id');
            var select_element_id = $(this).val();
            var vpid = $('#vpid').val();

            fetch("/products/get-offer-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    group_id: group_id,
                    select_element_id: select_element_id,
                    vpid: vpid
                })
            }).then(function (response) {
                return response.json();
            }).then(function (data) {
                console.log(555555, '--------');

                row.html(data.html);
                row.find('.select-2').select2({ minimumResultsForSearch: -1 });
                if ($(this).closest('#specialPopUpModal')) {
                    $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price);
                    countOfferPrice();
                }
            }).catch(function (error) {
                console.log(error);
            });
        });

        //add new single item
        $('body').on('click', '#singleProductPageCnt .product__single-item-add-new a.product__single-item-add-new-btn', function (ev) {
            ev.preventDefault();
            var row = $(this).closest('.product__single-item-info');
            var id = row.data('group-id');
            var $self = $(this);
            console.log(666666, $self.closest('.product__single-item-info.limit').find('.product__single-item-info-bottom').length, $self.closest('.product__single-item-info.limit').data('limit'), $self.closest('.product__single-item-info.limit').data('min-limit'));
            checkLimit($self.closest('.product__single-item-info.limit').find('.product__single-item-info-bottom').length + 1, $self.closest('.product__single-item-info.limit').data('limit')) && fetch("/products/get-variation-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    id: id
                })
            }).then(function (response) {
                return response.json();
            }).then(function (data) {
                // row.html(data.html);
                console.log(666666, '--------');

                var single_item_info_bottom = row.find('.product__single-item-info-bottom');
                row.find('.product__single-item-add-new').before(data.html);

                // console.log(row.find('.select-2'));
                row.find('.product__single-item-info-bottom').last().find('.select-2').select2({ minimumResultsForSearch: -1 });
                $self.closest('.product__single-item-info').css('border-color', '#d7d7d7');

                setTotalPrice(countTotalPrice());
                // const new_rows_list = row.find('.product__single-item-info-bottom');
                // console.log($(new_rows_list[new_rows_list.length - 1]).find('select'));
                // $(new_rows_list[new_rows_list.length-1]).find('select').select2()
            }).catch(function (error) {
                console.log(error);
            });
        });

        $('body').on('click', '#specialPopUpModal .product__single-item-add-new a.product__single-item-add-new-btn', function (ev) {
            ev.preventDefault();
            console.log(777777, '--------');
            var $self = $(this);
            var row = $self.closest('.pr-wrap');
            var id = row.data('group-id');
            $self.closest('.limit.pr-wrap').css('border', 'none');
            checkLimit($self.closest('.limit.pr-wrap').find('.product__single-item-info-bottom').length + 1, $self.closest('.limit.pr-wrap').data('limit')) && fetch("/products/get-offer-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    id: id
                })
            }).then(function (response) {
                return response.json();
            }).then(function (data) {
                // row.html(data.html);
                var single_item_info_bottom = row.find('.product__single-item-info-bottom');
                row.find('.product__single-item-add-new').before(data.html);

                // console.log(row.find('.select-2'));
                row.find('.product__single-item-info-bottom').last().find('.select-2').select2({ minimumResultsForSearch: -1 });
                if ($(this).closest('#specialPopUpModal')) {
                    $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price);
                    countOfferPrice();
                }
                setTotalPrice(countTotalPrice());
                // const new_rows_list = row.find('.product__single-item-info-bottom');
                // console.log($(new_rows_list[new_rows_list.length - 1]).find('select'));
                // $(new_rows_list[new_rows_list.length-1]).find('select').select2()
            }).catch(function (error) {
                console.log(error);
            });
        });

        $('body').on('click', '#singleProductPageCnt .remove-single_product-item', function () {
            console.log(888888, '--------');

            $(this).closest('.product__single-item-info-bottom').remove();
            $(this).closest('.product__single-item-info').css('border-color', '#d7d7d7');
            setTotalPrice(countTotalPrice());
        });

        $('body').on('click', '#specialPopUpModal .remove-single_product-item', function () {
            console.log(999999, '--------');

            $(this).closest('.product__single-item-info-bottom').remove();
            countOfferPrice();
        });

        //select-qty
        $('body').on('change', 'select.select-qty', function (ev) {
            var _this3 = this;

            var price_place = $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span');
            var variation_id = $(this).closest('.product__single-item-info-bottom').find('.select-variation-option').val();
            var discount_id = $(this).val();

            fetch("/products/get-discount-price", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    variation_id: variation_id,
                    discount_id: discount_id
                })
            }).then(function (res) {
                return res.json();
            }).then(function (data) {
                console.log(101010, '--------');

                price_place.html("" + getCurrencySymbol() + data.price);
                $(_this3).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price', data.price);
                setTotalPrice(countTotalPrice());
                if ($(_this3).closest('#specialPopUpModal')) {
                    $(_this3).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price);
                    countOfferPrice();
                }
            }).catch(function (error) {
                return console.error(error);
            });
        });

        $('body').on('input', '#singleProductPageCnt .product_radio-single .custom-radio .custom-control-input[type="checkbox"]', function (ev) {
            ev.preventDefault();
            console.log(121212, '--------');
            if ($(this).is(':checked') && checkLimit($(this).closest('.product__single-item-info').find('.custom-control-input:checked').length, $(this).closest('.product__single-item-info.limit').data('limit'))) {
                $(this).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                setTotalPrice(countTotalPrice());
            } else {
                $(this).prop('checked', false);
                setTotalPrice(countTotalPrice());
            }

            var img_variation = $(this).attr('data-img');
            var img_path = $(".product-single-view-outer").find('img[src="' + img_variation + '"]').first();
            if (img_path) {
                $('.single-product_top-img').attr("src", img_path.attr('src'));
            }
            // const row = $(this).closest('.product__single-item-info-bottom');
            // const group_id = $(this).data('id');
            // const select_element_id = $(this).val();
            // const vpid = $('#vpid').val();
        });

        $('body').on('change', '#specialPopUpModal .product_radio-single .custom-radio .custom-control-input[type="checkbox"]', function (ev) {
            ev.preventDefault();
            console.log(131313, '--------');
            $(this).closest('.limit.pr-wrap').css('border', 'none');
            if ($(this).is(':checked') && checkLimit($(this).closest('.limit.pr-wrap').find('.custom-control-input:checked').length, $(this).closest('.pr-wrap.limit').data('limit'))) {
                if ($(this).closest('#specialPopUpModal')) {
                    countOfferPrice();
                }
            } else {
                $(this).prop('checked', false);
                countOfferPrice();
            }
            // const row = $(this).closest('.product__single-item-info-bottom');
            // const group_id = $(this).data('id');
            // const select_element_id = $(this).val();
            // const vpid = $('#vpid').val();
            // if($(this).closest('#specialPopUpModal')) {
            //     countOfferPrice();
            // }
        });

        $('body').on('change', '#singleProductPageCnt .product_radio-single .custom-radio .custom-control-input[type="radio"]', function (ev) {
            ev.preventDefault();
            var row = $(this).closest('.product__single-item-info-bottom');
            var group_id = $(this).data('id');
            var select_element_id = $(this).val();
            var vpid = $('#vpid').val();
            var $self = $(this);

            var img_variation = $self.attr('data-img');
            var img_path = $(".product-single-view-outer").find('img[src="' + img_variation + '"]').first();
            if (img_path) {
                $('.single-product_top-img').attr("src", img_path.attr('src'));
            }

            fetch("/products/get-variation-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    group_id: group_id,
                    select_element_id: select_element_id,
                    vpid: vpid
                })
            }).then(function (response) {
                return response.json();
            }).then(function (data) {
                console.log(141414, '--------');

                row.html(data.html);
                row.find('.select-2').select2({ minimumResultsForSearch: -1 });
                $self.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                // row.find('.product-qty').select2();
                setTotalPrice(countTotalPrice());
            }).catch(function (error) {
                console.log(error);
            });
        });

        $('body').on('change', '#specialPopUpModal .product_radio-single .custom-radio .custom-control-input[type="radio"]', function (ev) {
            ev.preventDefault();
            var row = $(this).closest('.product__single-item-info-bottom');
            var group_id = $(this).data('id');
            var select_element_id = $(this).val();
            var vpid = $('#vpid').val();

            fetch("/products/get-offer-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    group_id: group_id,
                    select_element_id: select_element_id,
                    vpid: vpid
                })
            }).then(function (response) {
                return response.json();
            }).then(function (data) {
                console.log(151515, '--------');

                row.html(data.html);
                row.find('.select-2').select2({ minimumResultsForSearch: -1 });
                // row.find('.product-qty').select2();
                if ($(this).closest('#specialPopUpModal')) {
                    // $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                    countOfferPrice();
                }
                // setTotalPrice(countTotalPrice());
            }).catch(function (error) {
                console.log(error);
            });
        });

        var btnAddToRemove = function btnAddToRemove(btn) {
            btn.removeClass('add-btn').addClass('remove-btn');
            btn.html('remove');
        };

        var btnRemoveToAdd = function btnRemoveToAdd(btn) {
            btn.removeClass('remove-btn').addClass('add-btn');
            btn.html('add');
        };

        minLimitCheck = function minLimitCheck($self) {
            var wrapper = $self.closest('.special__popup-main-product-item');
            var wrongLimit = [];
            wrapper.find('.limit.pr-wrap').each(function () {
                var minLimit = $(this).data('min-limit');
                if ($(this).find('.product__single-item-add-new').length > 0) {
                    $(this).find('.single-product-select').length < minLimit && wrongLimit.push($(this).data('group-id'));
                } else if ($(this).find('.custom-control-input[type="checkbox"]').length > 0) {
                    var count = 0;
                    $(this).find('.custom-control-input[type="checkbox"]').each(function () {
                        $(this).is(':checked') && ++count;
                    });
                    count < minLimit && wrongLimit.push($(this).data('group-id'));
                } else if ($(this).find('.popup-select').length > 0) {
                    $(this).find('.product__single-item-info-bottom').length < minLimit && wrongLimit.push($(this).data('group-id'));
                }
            });

            return wrongLimit;
        };

        $('body').on('click', '.special__popup-main-product-item-btn.add-btn', function () {
            var id = $(this).closest('.special__popup-main-product-item').data('id');
            var price = $(this).closest('.special__popup-main-product-item').find('.product__single-item_price').data('price-for-add');
            var $self = $(this);
            var wrongMinLimit = minLimitCheck($self);
            console.log(wrongMinLimit);
            if (wrongMinLimit.length === 0) {
                fetch("/products/add-offer", {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        id: id,
                        price: price
                    })
                }).then(function (response) {
                    return response.json();
                }).then(function (data) {
                    $self.closest('.special__popup-main-product-item').addClass('active');
                    $self.closest('.special__popup-main-product-item').addClass('user-non-select');
                    // console.log($self.closest('.special__popup-main-product-item'));
                    btnAddToRemove($self);
                    if ($("#specialPopUpModal .added-offers .special__popup-content-right-product[data-id=\"" + id + "\"]").length === 0) {
                        $('.special__popup-content-right-item.added-offers').append(data.html);
                    }
                    countOfferTotalPrice();
                }).catch(function (error) {
                    console.log(error);
                });
            } else {
                wrongMinLimit.map(function (groupId) {
                    $self.closest('.special__popup-main-product-item').find(".limit.pr-wrap[data-group-id=\"" + groupId + "\"]").css('border', '1px solid red');
                });
            }
        });

        $('body').on('click', '.special__popup-main-product-item-btn.remove-btn', function () {
            btnRemoveToAdd($(this));
            $(this).closest('.special__popup-main-product-item').removeClass('active');
            var id = $(this).closest('.special__popup-main-product-item').data('id');
            $('.special__popup-content-right-item.added-offers').find(".special__popup-content-right-product[data-id=\"" + id + "\"]").remove();
            countOfferTotalPrice();
        });

        $('body').on('click', '.special__popup-content-right-product-remove', function () {
            var id = $(this).closest('.special__popup-content-right-product').data('id');
            $(this).closest('.special__popup-content-right-product').remove();
            var product = $("#specialPopUpModal .special__popup-main-product-item[data-id=\"" + id + "\"]");
            var buttonCart = product.find('.special__popup-main-product-item-btn');
            product.removeClass('active');
            buttonCart.removeClass('remove-btn').addClass('add-btn').html('add');
            if (buttonCart.closest('.user-non-select').length > 0) {
                buttonCart.closest('.user-non-select').removeClass('user-non-select');
            }
            countOfferTotalPrice();
        });

        //data object for add-to-cart and extra
        var addDataKey = {};

        //item price
        var item_price = 0;

        //section price
        var section_price = 0;

        //extra group ids
        var selectedGroupId = [];

        //event default
        var eventInitialDefault = function eventInitialDefault(ev) {
            ev.preventDefault();
            ev.stopImmediatePropagation();
        };

        // return true if argument is checked
        var isChecked = function isChecked(checkbox) {
            return checkbox.is(':checked');
        };

        //return true if argument is required
        var isReq = function isReq(el) {
            return Number(el.closest('[data-req]').attr('data-req'));
        };

        //return true if arguments is section and false if arguments is item
        var isSection = function isSection(el) {
            return el.closest('[data-per-price]').attr('data-per-price') === "product";
        };

        //return true if argument is single select
        var isSingle = function isSingle(select) {
            if (select.attr('id')) {
                return select.attr('id').includes('single');
            }
        };

        //return true if we are on the cart page
        var isCartPage = function isCartPage() {
            return $('.shopping-cart_wrapper').length !== 0;
        };

        //pass element and get row
        var getRow = function getRow(el) {
            return $(el).closest('product-single-info_row');
        };

        // product-count-plus event callback
        var handleProductCountPlus = function handleProductCountPlus(plus_button, section, type, limit) {
            var counter = $(plus_button.closest('.continue-shp-wrapp_qty').find('.field-input')[0]);

            // new_qty(section);
            // Number(counter.val()) < Number(limit) - Number(new_qty(section)) +
            Number($(plus_button.closest('.continue-shp-wrapp_qty').find('.field-input')[0]).val()) && counter.val(Number(counter.val()) + 1);
            // new_qty(section);
            // if (type === 'select') {
            //     select2MaxLimit(section, limit);
            // }

            var price = plus_button.closest('[data-price]').attr('data-price');
            plus_button.closest('[data-price]').find('.price-placee').html("" + getCurrencySymbol() + price * Number(counter.val()));
        };

        //create hidden input and take data for filter modal
        var createInputHiddenForFilter = function createInputHiddenForFilter(items, self) {
            var inputHidden = document.createElement('input');
            $(inputHidden).attr({
                type: 'hidden',
                name: self.attr('data-name'),
                value: items
            });
            $('body').find("." + self.attr('id')).closest('.product-single-info_row').find('.product-single-info_row-items').append($(inputHidden));
        };

        var makeSelectedItemModal = function makeSelectedItemModal(id, title, filter) {
            return "<div class=\"col-md-2 col-sm-3 selected-item_popup\" data-id-popup=\"" + id + "\">\n                              <div class=\"d-flex justify-content-between selected-item_popup-wrapper\">\n                                <div class=\"align-self-center text-truncate\">\n                                  " + title + "\n                                </div>\n                                <div class=\"d-flex align-items-center justify-content-end\">\n                                  <div class=\"mr-1\">Qty</div>\n                                  <div class=\"continue-shp-wrapp_qty position-relative mr-0\">\n                                    <!--minus qty-->\n                                    <span class=\"d-flex align-items-center pointer position-absolute selected-item-popup_qty-minus qty-count\">\n                                                    <svg viewBox=\"0 0 20 3\" width=\"12px\" height=\"3px\">\n                                                        <path fill-rule=\"evenodd\" fill=\"rgb(214, 217, 225)\"\n                                                              d=\"M20.004,2.938 L-0.007,2.938 L-0.007,0.580 L20.004,0.580 L20.004,2.938 Z\"></path>\n                                                    </svg>\n                                                </span>\n                                    <input class=\"popup_field-input w-100 h-100 font-23 text-center border-0 selected-item-popup_qty-select none-touchable\" min=\"number\" name=\"\"\n                                           type=\"number\" value=\"1\">\n                                    <!--plus qty-->\n                                    <span class=\"d-flex align-items-center pointer position-absolute selected-item-popup_qty-plus qty-count\">\n                                                    <svg viewBox=\"0 0 20 20\" width=\"15px\" height=\"15px\">\n                                                        <path fill-rule=\"evenodd\" fill=\"rgb(211, 214, 223)\"\n                                                              d=\"M20.004,10.938 L11.315,10.938 L11.315,20.000 L8.696,20.000 L8.696,10.938 L-0.007,10.938 L-0.007,8.580 L8.696,8.580 L8.696,0.007 L11.315,0.007 L11.315,8.580 L20.004,8.580 L20.004,10.938 Z\"></path>\n                                                    </svg>\n                                                </span>\n                                  </div>\n                                  <div>\n                                    <a href=\"javascript:void(0)\" data-el-id=\"" + id + "\" class=\"btn btn-sm delete-menu-item" + (!filter ? '_popup' : '') + " text-danger\"><i class=\"fa fa-times\"></i></a>\n                                </div>\n                                </div>\n                              </div>\n                            </div>";
        };

        var makeOutOfStockSelectOption = function makeOutOfStockSelectOption(select, type) {
            if (type === "select") {
                select.find('[data-out="1"]').attr('disabled', 'disabled');

                var current_item_id = $(select.find('[data-out="0"]')[0]).attr('data-select2-id');
                // new_qty(select);
                if (isSingle(select)) {
                    select.find('[data-out="0"]').length > 0 && select.val($(select.find('[data-out="0"]')[0]).val());
                    fetch("/products/get-variation-menu-raw", {
                        method: "post",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('input[name="_token"]').val()
                        },
                        credentials: "same-origin",
                        body: JSON.stringify({
                            id: $(select.find('[data-out="0"]')[0]).val(),
                            selectElementId: current_item_id
                        })
                    }).then(function (response) {
                        return response.json();
                    }).then(function (json) {
                        if (isSingle(select)) {
                            !isSection(select) && select.closest('.product-single-info_row').find('.selected-menu-options').html(json.html);
                        } else {
                            select.closest('.product-single-info_row').find('.product-single-info_row-items').append(json.html);
                        }
                        setTotalPrice(countTotalPrice());
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            } else if (type === "list") {
                select.find('[data-out="1"]').addClass('none-touchable-op');
            } else if (type === "popup") {
                select.find('[data-out="1"]').closest('.single-item-wrapper').addClass('none-touchable-op');
            } else if (type === "filter") {
                // console.log('filter stock', select);
                select.find('[data-out="1"]').addClass('none-touchable-op');
            }
        };

        var discountInputChange = function discountInputChange($ev, $element, discount_type) {
            // console.log('99999999999999999999999999999999999999', discount_type);
            var variation_id = $element.attr('data-id');
            // console.log(variation_id);
            if (discount_type === 'range') {
                var qty = $element.val();
                fetch("/products/get-discount-price", {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        variation_id: variation_id,
                        qty: qty
                    })
                }).then(function (res) {
                    return res.json();
                }).then(function (data) {
                    $element.closest('.menu-item-selected').find('.price-placee').html("" + getCurrencySymbol() + data.price);
                }).catch(function (error) {
                    return console.error(error);
                });
            } else if (discount_type === 'fixed') {
                var discount_id = $element.val();
                fetch("/products/get-discount-price", {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        variation_id: variation_id,
                        discount_id: discount_id
                    })
                }).then(function (res) {
                    return res.json();
                }).then(function (data) {
                    $element.closest('.menu-item-selected').find('.price-placee').html("" + getCurrencySymbol() + data.price);
                }).catch(function (error) {
                    return console.error(error);
                });
            }
        };

        var unselectHandle = function unselectHandle(select, id) {
            select.closest('.filters-select-wizard').find(".product__single-item-info-bottom[data-id=\"" + id + "\"]").remove();
            setTimeout(function () {
                // select2MaxLimit(select, limit);
                // setTotalPrice(false);
                setTotalPrice(countTotalPrice());
            }, 0);
        };

        var selectHandle = function selectHandle(el, id, selectElementId, limit, select) {

            // console.log('el', el, 'id', id, 'selectElementId', selectElementId, 'select',select)
            fetch("/products/get-variation-menu-raws", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({ items: [{ id: id, value: 1 }], ids: [id] })
            }).then(function (response) {
                return response.json();
            }).then(function (json) {
                // const isMultiple = select.closest('[data-limit]').attr('data-limit') === '1' ? false : true;

                el.closest('.product__single-item-info-bottom').find('.filter-children-items').append(json.html);
                // select2MaxLimit(select, limit);
                setTotalPrice(countTotalPrice());
                // el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.product__single-item-info-bottom').remove();
                // el.closest('.product__single-item-info-bottom').find('.filter-children-items').append(json.html);
                // el.closest('.product-single-info_row').find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').html($(el.closest('.product-single-info_row').find('.filter-children-items').children()[1]));
                // console.log('$(el.closest(\'.product__single-item-info-bottom\').find(\'.filter-children-items\').children()[1])', $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]));
                // $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]).remove();
                el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.select-2').each(function () {
                    $(this).select2({ minimumResultsForSearch: -1 });
                });
                el.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                el.closest('.filters-select-wizard').on('click', '.remove-single_product-item', function (ev) {
                    // ev.stopImmediatePropagation();
                    unselectHandle($(this), $(this).closest('.product__single-item-info-bottom').data('id'));
                });

                // setTotalPrice(modal);
            }).catch(function (error) {
                console.log(error);
            });
        };

        var selectOfferHandle = function selectOfferHandle(el, id, selectElementId, limit, select) {

            // console.log('el', el, 'id', id, 'selectElementId', selectElementId, 'select',select)
            fetch("/products/get-offer-menu-raws", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({ items: [{ id: id, value: 1 }], ids: [id] })
            }).then(function (response) {
                return response.json();
            }).then(function (json) {
                // const isMultiple = select.closest('[data-limit]').attr('data-limit') === '1' ? false : true;

                el.closest('.filter-children-items').append(json.html);
                // select2MaxLimit(select, limit);
                // setTotalPrice(countTotalPrice());

                // el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.product__single-item-info-bottom').remove();
                // el.closest('.product__single-item-info-bottom').find('.filter-children-items').append(json.html);
                // el.closest('.product-single-info_row').find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').html($(el.closest('.product-single-info_row').find('.filter-children-items').children()[1]));
                // console.log('$(el.closest(\'.product__single-item-info-bottom\').find(\'.filter-children-items\').children()[1])', $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]));
                // $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]).remove();
                el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.select-2').each(function () {
                    $(this).select2({ minimumResultsForSearch: -1 });
                });
                el.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                el.closest('.filters-select-wizard').on('click', '.remove-single_product-item', function (ev) {
                    // ev.stopImmediatePropagation();
                    unselectHandle($(this), $(this).closest('.product__single-item-info-bottom').data('id'));
                });
                countOfferPrice();
                countOfferTotalPrice();

                // setTotalPrice(modal);
            }).catch(function (error) {
                console.log(error);
            });
        };
        // //unselect handle function

        // const filterModalSingleInit = () => {
        //     (function () {
        //         const $body = $('body');
        //
        //         $(`#singleProductPageCnt .filters-modal-wizard`).each(function (index) {
        //             const group_id = $(this).attr('data-group');
        //             const filter = [];
        //
        //             let dg = null;
        //             let filter_limit = 0;
        //
        //             $("body").on('click', `.filters-modal-wizard[data-group="${group_id}"]`, function () {
        //                 dg = $(this).attr('data-group');
        //                 let group = $(this).attr('data-group');
        //                 filter_limit = $(this).closest('.limit').attr('data-limit');
        //                 const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
        //                     return $(item).attr('data-id');
        //                 });
        //                 // console.log('index',index);
        //                 $.ajax({
        //                     type: "post",
        //                     url: "/products/select-items",
        //                     cache: false,
        //                     data: {
        //                         group,
        //                         selectedIds,
        //                         type: "popup"
        //                     },
        //                     headers: {
        //                         "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        //                     },
        //                     success: function (data) {
        //                         if (!data.error) {
        //                             $("#wizardViewModal .selected-items_filter").empty();
        //                             $(`.filter[data-group-id="${group}"]`).closest('.product-single-info_row').find('.menu-item-selected').toArray().map((selectedItem) => {
        //                                 const selectedItemId = $(selectedItem).attr('data-id');
        //                                 const selectedItemTitle = $(selectedItem).find('.delete-menu-item').parent().text().trim();
        //                                 // $("#wizardViewModal .selected-items_filter").append(makeSelectedItemModal(selectedItemId, selectedItemTitle, true));
        //                             });
        //                             $("#wizardViewModal").modal();
        //                         } else {
        //                             alert("error");
        //                         }
        //                     }
        //                 });
        //             });
        //
        //             $("body").on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .wrap-item`, function (ev) {
        //                 const id = $(this).attr('data-id');
        //                 const title = $(this).find('.name').text().trim();
        //                 filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
        //                 // filter_limit > new_qty(null, 'filter') &&
        //                 if (!$(this).hasClass('active')) {
        //                     $(this).addClass('active');
        //                     // $('.selected-items_filter').append(makeSelectedItemModal(id, title, true));
        //                 } else if ($(this).hasClass('active')) {
        //                     $(`[data-id-popup="${id}"]`).remove();
        //                     $(this).removeClass('active');
        //                 }
        //             });
        //
        //             $('body').on('click', '#wizardViewModal .selected-item-popup_qty-minus', function (ev) {
        //                 eventInitialDefault(ev);
        //                 $(this).siblings(".popup_field-input").val() > 1 && $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) - 1);
        //             });
        //
        //             $('body').on('click', '#wizardViewModal .selected-item-popup_qty-plus', function (ev) {
        //                 eventInitialDefault(ev);
        //                 filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
        //                 if (filter_limit > new_qty(null, 'filter')) {
        //                     $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) + 1);
        //                 }
        //             });
        //
        //             $('body').on('click', '#wizardViewModal .selected-item_popup .delete-menu-item', function () {
        //                 const remove_id = $(this).attr('data-el-id');
        //                 $('#wizardViewModal').find(`.wrap-item[data-id="${remove_id}"]`).removeClass('active');
        //                 $(this).closest('.selected-item_popup').remove();
        //             });
        //
        //
        //             $('body').on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function () {
        //                 const items_array = [];
        //                 // console.log(2, '*****************************')
        //
        //                 $('#wizardViewModal .modal-body').find('.wrap-item').each(function () {
        //                     $(this).hasClass('active') && (items_array.push($(this).attr('data-id')));
        //                 });
        //
        //                 const popup_items_qty = [];
        //                 // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
        //                 $(`[data-id-popup].selected-item_popup`).find('.popup_field-input').each(function () {
        //                     const $this = $(this);
        //                     popup_items_qty.push({
        //                         id: $this.closest('.selected-item_popup').attr('data-id-popup'),
        //                         value: $this.val()
        //                     });
        //                 });
        //
        //                 fetch("/products/get-variation-menu-raws", {
        //                     method: "post",
        //                     headers: {
        //                         "Content-Type": "application/json",
        //                         Accept: "application/json",
        //                         "X-Requested-With": "XMLHttpRequest",
        //                         "X-CSRF-Token": $('input[name="_token"]').val()
        //                     },
        //                     credentials: "same-origin",
        //                     body: JSON.stringify({ids: items_array})
        //                 })
        //                     .then(function (response) {
        //                         return response.json();
        //                     })
        //                     .then(function (json) {
        //                         const items_row = $(`[data-group-id="${dg}"]`).find('.product-single-info_row-items');
        //                         items_row.append(json.html);
        //                         const selects = items_row.find('.select-2');
        //                         selects.length > 0 && selects.each(function() {
        //                             $(this).select2({minimumResultsForSearch: -1});
        //                         });
        //                         $(`[data-group-id="${dg}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
        //                         // $(`[data-group-id="${dg}"]`).closest('.product-single-info_row').find('.field-input').each(function () {
        //                         //     const d_id = $(this).attr('data-id');
        //                         //     const value = popup_items_qty.length > 0 && popup_items_qty.find((el) => {
        //                         //         return el.id === d_id;
        //                         //     }).value;
        //                         //     $(this).val(value);
        //                         //     $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
        //                         // });
        //                         setTotalPrice(countTotalPrice());
        //
        //                         $('#wizardViewModal').modal('hide');
        //
        //
        //
        //                         $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
        //                             $(this).closest('.menu-item-selected').remove();
        //                             setTotalPrice(countTotalPrice());
        //                         });
        //
        //                         $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
        //                             ev.preventDefault();
        //                             ev.stopImmediatePropagation();
        //                             const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
        //
        //                             handleProductCountMinus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
        //                             setTotalPrice(countTotalPrice());
        //
        //                         });
        //
        //                         $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
        //                             ev.preventDefault();
        //                             ev.stopImmediatePropagation();
        //                             const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
        //
        //                             handleProductCountPlus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
        //                             setTotalPrice(countTotalPrice());
        //                         });
        //                     });
        //             });
        //
        //             $(this).on('click', function (e) {
        //                 const first_category_id = $(this).attr('data-action');
        //                 let self = $(this);
        //                 let selectMoreItems = [];
        //                 let selectSingleItems;
        //
        //                 $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .item-content`, function () {
        //                     $('.shopping-cart_wrapper .item-content').removeClass('active');
        //                     $(this).addClass('active');
        //                 });
        //
        //                 $body.on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function (e) {
        //                     eventInitialDefault(e);
        //                     // console.log(1, '*****************************')
        //
        //                     $(`.filter[data-group-id="${group_id}"]`).find('.product-single-info_row-items').empty();
        //
        //                     if (Number(self.attr('data-multiple')) === 1) {
        //                         $(this).closest('.contents-wrapper').find('.wrap-item.active').each(function () {
        //                             selectMoreItems.push($(this).attr('data-id'));
        //                         });
        //                         selectMoreItems.forEach((item) => {
        //                             createInputHiddenForFilter(item, self);
        //                         });
        //                     } else {
        //                         selectSingleItems = $(this).closest('.contents-wrapper').find('.wrap-item.active').attr('data-id');
        //                         createInputHiddenForFilter(selectSingleItems, self);
        //                     }
        //
        //                     $('#wizardViewModal').modal('hide');
        //                 });
        //
        //                 $.ajax({
        //                     type: "post",
        //                     url: "/filters",
        //                     cache: false,
        //                     data: {
        //                         group: self.attr('data-group'),
        //                         category_id: first_category_id,
        //                         filters: filter,
        //                         type: "popup"
        //                     },
        //                     headers: {
        //                         "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        //                     },
        //                     success: function (data) {
        //                         if (!data.error) {
        //                             const modal_group_id = self.attr('data-group');
        //                             $('#wizardViewModal').attr('data-group', modal_group_id);
        //                             const contantPlace = $('.contents-wrapper .content');
        //                             const wizardPlace = $('.shopping-cart-head .nav-pills');
        //
        //                             wizardPlace.empty();
        //                             wizardPlace.append(data.wizard);
        //                             if (data.type === "filter") {
        //                                 contantPlace.html(data.filters);
        //                             } else if (data.type === "items") {
        //                                 contantPlace.html(data.items_html);
        //                                 makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
        //                                 $('.shopping-cart_wrapper .next-btn').addClass('d-none');
        //                                 $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
        //                             }
        //                         } else {
        //                             alert("error");
        //                         }
        //                     },
        //                     error: function (error) {
        //                         filter.pop();
        //                     }
        //                 });
        //
        //                 $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .next-btn`, function (e) {
        //                     eventInitialDefault(e);
        //                     $('.content-wrap').find('.active').toArray().map(function (actv) {
        //                         filter.push($(actv).closest('[data-id]').attr('data-id'));
        //                     });
        //                     // console.log(filter);
        //
        //                     $('.content-wrap').find('.active').length === 0 ? alert('select item') : $.ajax({
        //                         type: "post",
        //                         url: "/filters",
        //                         cache: false,
        //                         data: {
        //                             group: self.attr('data-group'),
        //                             category_id: first_category_id,
        //                             filters: filter,
        //                             type: "popup"
        //                         },
        //                         headers: {
        //                             "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        //                         },
        //                         success: function (data) {
        //                             if (!data.error) {
        //                                 $('.shopping-cart-head .nav-pills').empty();
        //                                 $('.shopping-cart-head .nav-pills').append(data.wizard);
        //                                 $('.back-btn').removeClass('d-none');
        //                                 if (data.type === "filter") {
        //                                     $('.contents-wrapper .content').html(data.filters);
        //                                 } else if (data.type === "items") {
        //                                     $('.contents-wrapper .content').html(data.items_html);
        //                                     $(`#wizardViewModal[data-group="${group_id}"] .selected-item_popup`).each(function () {
        //                                         $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).length > 0
        //                                         && $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).addClass('active');
        //                                     });
        //                                     makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
        //                                     $('.shopping-cart_wrapper .next-btn').addClass('d-none');
        //                                     $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
        //                                 }
        //                             } else {
        //                                 alert("error");
        //                             }
        //                         },
        //                         error: function (error) {
        //                             filter.pop();
        //                         }
        //                     });
        //                 });
        //                 $('body').on('click', '.shopping-cart_wrapper .back-btn', function (e) {
        //                     e.preventDefault();
        //                     e.stopImmediatePropagation();
        //
        //                     filter.pop();
        //                     // console.log(filter)
        //                     $.ajax({
        //                         type: "post",
        //                         url: "/filters",
        //                         cache: false,
        //                         data: {
        //                             group: self.attr('data-group'),
        //                             category_id: first_category_id,
        //                             filters: filter,
        //                             type: 'popup'   //self.attr('data-type')
        //                         },
        //                         headers: {
        //                             "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        //                         },
        //                         success: function (data) {
        //                             if (!data.error) {
        //
        //                                 $('.shopping-cart-head .nav-pills').empty();
        //                                 $('.shopping-cart-head .nav-pills').append(data.wizard);
        //                                 if (data.type === "filter") {
        //                                     $('.contents-wrapper .content').html(data.filters);
        //                                     $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
        //                                     $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
        //                                 } else if (data.type === "items") {
        //                                     $('.contents-wrapper .content').html(data.items_html);
        //                                 }
        //                                 if (filter.length === 0) {
        //                                     $('.shopping-cart_wrapper .back-btn').addClass('d-none');
        //                                 }
        //                             } else {
        //                                 alert("error");
        //                             }
        //                         },
        //                         error: function (error) {
        //                             console.log(error);
        //                         }
        //                     });
        //                 });
        //             });
        //             $('#wizardViewModal').on('hidden.bs.modal', function (e) {
        //                 filter.length = 0;
        //                 $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
        //                 $('.shopping-cart_wrapper .back-btn').addClass('d-none');
        //                 $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
        //                 $('#wizardViewModal .selected-items_filter').empty();
        //                 $('#wizardViewModal .content-wrap .wrap-item').removeClass('active');
        //             });
        //         });
        //     })();
        // };
        // filterModalSingleInit();

        function limite_message(group_id, active_item) {
            var place = $('#wizardViewModal .message_place_js');
            var limit = $(".product__single-item-info[data-group-id=\"" + group_id + "\"]").data('limit');
            var min_limit = $(".product__single-item-info[data-group-id=\"" + group_id + "\"]").data('min-limit');
            var count = $('#wizardAll').find('.item-content.active').length;
            var message = '';
            console.log(22222222222);
            // console.log(count, min_limit, limit)
            if (count < min_limit || count > limit) {
                $('#wizardViewModal .b_save').attr('disabled', true);
            } else {
                $('#wizardViewModal .b_save').attr('disabled', false);
            }

            if (limit !== 1) {
                if (min_limit >= 1 && count === 0) {
                    message = "You need to select items";
                } else if (min_limit >= 1 && count < min_limit && limit !== count) {
                    message = min_limit - count + " items left";
                } else if (count === limit && !active_item) {
                    message = "You allowed to select " + limit + " items only";
                } else if (count >= min_limit && count <= limit) {
                    message = '';
                }
            }

            if (limit === 1 && count === 0) {
                message = 'You need to select one item';
            } else if (limit === 1 && count !== 0) {
                message = '';
            }

            // console.log(limit, min_limit, count, message,  group_id);
            place.text(message);
        }

        function activate_item(self, id, name, group_id) {
            var limit = $(".product__single-item-info[data-group-id=\"" + group_id + "\"]").data('limit');
            if (limit !== 1) {
                if ($(self).hasClass('active')) {
                    $("#wizardViewModal #myTabContent").find("li[data-id=\"" + id + "\"]").each(function () {
                        $(this).find('.item-content').removeClass('active');
                    });
                    $('#wizardViewModal .footer-list').find("li[data-id=\"" + id + "\"]").remove();
                } else {
                    var group_element = $(".product__single-item-info[data-group-id=\"" + group_id + "\"]");

                    if ($("#wizardViewModal #myTabContent #wizardAll").find('.item-content.active').length < group_element.data('limit')) {
                        $(self).addClass('active');
                        $("#wizardViewModal #myTabContent").find("li[data-id=\"" + id + "\"]").each(function () {
                            $(this).find('.item-content').addClass('active');
                        });
                        $('#wizardViewModal .footer-list').find(".footer-list-item[data-id=\"" + id + "\"]").length === 0 && $('#wizardViewModal .footer-list').append("<li class=\"footer-list-item\" data-id=\"" + id + "\" data-name=\"" + name + "\">\n                                                            <span class=\"title\">" + name + "</span>\n                                                            <span class=\"close-icon item-selected-footer\"><i class=\"fa fa-times\"></i></span>\n                                                        </li>");
                    }
                }
            } else {
                // if($(self).hasClass('active')) {
                // $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                //     $(this).find('.item-content').removeClass('active');
                // });
                // $('#wizardViewModal .footer-list').find(`li[data-id="${id}"]`).remove();
                // } else {
                $("#wizardViewModal #myTabContent").find('li').each(function () {
                    if ($(this).data('id') === id) {
                        $(this).find('.item-content').addClass('active');
                    } else {
                        $(this).find('.item-content').removeClass('active');
                    }
                });

                var _group_element = $(".product__single-item-info[data-group-id=\"" + group_id + "\"]");

                if ($("#wizardViewModal #myTabContent #wizardAll").find('.item-content.active').length < _group_element.data('limit')) {
                    $(self).addClass('active');
                    $("#wizardViewModal #myTabContent").find("li[data-id=\"" + id + "\"]").each(function () {
                        $(this).find('.item-content').addClass('active');
                    });
                    $('#wizardViewModal .footer-list').find(".footer-list-item[data-id=\"" + id + "\"]").length === 0 && $('#wizardViewModal .footer-list').html("<li class=\"footer-list-item\" data-id=\"" + id + "\" data-name=\"" + name + "\">\n                                                            <span class=\"title\">" + name + "</span>\n                                                            <span class=\"close-icon item-selected-footer\"><i class=\"fa fa-times\"></i></span>\n                                                        </li>");
                }
                // }
            }
        }

        var filterModalSingleInit = function filterModalSingleInit() {
            (function () {
                $("#singleProductPageCnt .filters-modal-wizard").each(function (index) {
                    var button_group_id = $(this).attr('data-group');
                    selected_ides = [];
                    var x_group = void 0;
                    $("body").on('click', ".filters-modal-wizard[data-group=\"" + button_group_id + "\"]", function () {
                        var group_id = $(this).data('group');
                        x_group = group_id;
                        $("#wizardViewModal").attr('data-group', group_id);

                        // const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
                        //     return $(item).attr('data-id');
                        // });

                        $("#wizardViewModal .modal-body").empty();
                        $("#wizardViewModal .footer-list").empty();
                        $.ajax({
                            type: "post",
                            url: "/filters/render-tabs",
                            cache: false,
                            data: {
                                group: group_id
                            },
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            },
                            success: function success(data) {
                                $("#wizardViewModal .modal-body").html(data.html);
                                selected_ides.length = 0;
                                $(".product__single-item-info[data-group-id=\"" + group_id + "\"]").find('.product__single-item-info-bottom').each(function (a, b) {
                                    $(this).data('id') && selected_ides.push($(this).data('id'));
                                });
                                $("#wizardViewModal ul.content li").each(function () {
                                    $(this).find(".item-content").on('click', function () {
                                        var id = $(this).closest('li').attr('data-id');
                                        var name = $(this).closest('li').attr('data-name');
                                        activate_item(this, id, name, group_id);
                                        var active_item = $(this).hasClass('active');
                                        limite_message(group_id, active_item);
                                    });
                                    // console.log(selected_ides);
                                    // console.log('lalalalaaaa', selected_ides.includes($(this).data('id')) && $($(this).find(".item-content")[0]));
                                    if (selected_ides.includes($(this).data('id'))) {
                                        var id = $(this).closest('li').attr('data-id');
                                        var name = $(this).closest('li').attr('data-name');
                                        activate_item(this, id, name, group_id);
                                        limite_message(group_id, true);
                                    }
                                });
                                limite_message(group_id, true);
                                // $(`#wizardViewModal ul.content li`).each(function() {
                                //
                                // });
                                $("#wizardViewModal").modal();
                            },
                            error: function error() {
                                $("#wizardViewModal .modal-body").empty();
                                $("#wizardViewModal").modal();
                            }
                        });
                    });

                    $('body').on('click', "#wizardViewModal[data-group=\"" + button_group_id + "\"] .close-icon.item-selected-footer", function (ev) {
                        var id = $(this).closest('li').data('id');
                        var group_id = button_group_id;
                        $("#wizardViewModal #myTabContent").find("li[data-id=\"" + id + "\"]").each(function () {
                            $(this).find('.active').removeClass('active');
                        });
                        $(this).closest('li').remove();
                        // console.log(x_group, group_id)
                        if (x_group === group_id) {
                            limite_message(x_group);
                        }
                    });

                    $('body').on('click', "#wizardViewModal[data-group=\"" + button_group_id + "\"] .b_save", function () {
                        var items_array = [];

                        $('#wizardViewModal .modal-body').find(".item-content.active").each(function () {
                            items_array.push($(this).closest('li').attr('data-id'));
                        });

                        var popup_items_qty = [];
                        // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
                        $("[data-id-popup].selected-item_popup").find('.popup_field-input').each(function () {
                            var $this = $(this);
                            popup_items_qty.push({
                                id: $this.closest('.selected-item_popup').attr('data-id-popup'),
                                value: $this.val()
                            });
                        });

                        fetch("/products/get-variation-menu-raws", {
                            method: "post",
                            headers: {
                                "Content-Type": "application/json",
                                Accept: "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-Token": $('input[name="_token"]').val()
                            },
                            credentials: "same-origin",
                            body: JSON.stringify({ ids: items_array })
                        }).then(function (response) {
                            return response.json();
                        }).then(function (json) {
                            // console.log(json);

                            var items_row = $("[data-group-id=\"" + button_group_id + "\"]").find('.product-single-info_row-items');
                            items_row.html(json.html);

                            var selects = items_row.find('.select-2');
                            selects.length > 0 && selects.each(function () {
                                $(this).select2({ minimumResultsForSearch: -1 });
                            });
                            $("[data-group-id=\"" + button_group_id + "\"]").closest('.product__single-item-info').css('border-color', '#d7d7d7');
                            $("[data-group-id=\"" + button_group_id + "\"]").closest('.product-single-info_row').find('.field-input').each(function () {
                                var d_id = $(this).attr('data-id');
                                var value = popup_items_qty.length > 0 && popup_items_qty.find(function (el) {
                                    return el.id === d_id;
                                }).value;
                                $(this).val(value);
                                $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
                            });
                            setTotalPrice(countTotalPrice());

                            $('#wizardViewModal').modal('hide');

                            $("[data-group=\"" + button_group_id + "\"]").closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                                $(this).closest('.menu-item-selected').remove();
                                setTotalPrice(countTotalPrice());
                            });

                            $("[data-group=\"" + button_group_id + "\"]").closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                                ev.preventDefault();
                                ev.stopImmediatePropagation();
                                var limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                handleProductCountMinus($(this), $("[data-group=\"" + button_group_id + "\"]"), 'popup', limit);
                                setTotalPrice(countTotalPrice());
                            });

                            $("[data-group=\"" + button_group_id + "\"]").closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                                ev.preventDefault();
                                ev.stopImmediatePropagation();
                                var limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                handleProductCountPlus($(this), $("[data-group=\"" + button_group_id + "\"]"), 'popup', limit);
                                setTotalPrice(countTotalPrice());
                            });

                            // console.log('group_id', group_id);

                        });
                    });

                    $('body').on('click', '#wizardViewModal .item-selected-footer', function () {
                        var id = $(this).closest('.footer-list-item').attr('data-id');
                        var name = $(this).closest('.footer-list-item').attr('data-name');
                        activate_item($("#wizardViewModal .content[data-id=\"" + id + "\"]").find('.item-content'), id, name);
                        $(this).closest('.footer-list-item').remove();
                    });
                });
            })();
        };

        var filterModalOfferInit = function filterModalOfferInit() {
            (function () {
                $("#specialPopUpModal .filters-modal-wizard").each(function (index) {
                    var button_group_id = $(this).attr('data-group');
                    selected_ides = [];
                    var x_group = void 0;

                    $("body").on('click', ".filters-modal-wizard[data-group=\"" + button_group_id + "\"]", function () {
                        var group_id = $(this).data('group');
                        x_group = group_id;
                        $("#wizardViewModal").attr('data-group', group_id);

                        // const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
                        //     return $(item).attr('data-id');
                        // });

                        $("#wizardViewModal .modal-body").empty();
                        $("#wizardViewModal .footer-list").empty();
                        $.ajax({
                            type: "post",
                            url: "/filters/render-tabs",
                            cache: false,
                            data: {
                                group: group_id
                            },
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            },
                            success: function success(data) {
                                $("#wizardViewModal .modal-body").html(data.html);
                                selected_ides.length = 0;
                                $(".product__single-item-info[data-group-id=\"" + button_group_id + "\"]").find('.product__single-item-info-bottom').each(function (a, b) {
                                    $(this).data('id') && selected_ides.push($(this).data('id'));
                                });
                                $("#wizardViewModal ul.content li").each(function () {
                                    $(this).find(".item-content").on('click', function () {
                                        var id = $(this).closest('li').attr('data-id');
                                        var name = $(this).closest('li').attr('data-name');
                                        activate_item(this, id, name, group_id);
                                        var active_item = $(this).hasClass('active');
                                        limite_message(group_id, active_item);
                                    });
                                    // console.log(selected_ides);
                                    // console.log('lalalalaaaa', selected_ides.includes($(this).data('id')) && $($(this).find(".item-content")[0]));
                                    if (selected_ides.includes($(this).data('id'))) {
                                        var id = $(this).closest('li').attr('data-id');
                                        var name = $(this).closest('li').attr('data-name');
                                        activate_item(this, id, name, group_id);
                                        limite_message(group_id, true);
                                    }
                                });
                                limite_message(group_id, true);

                                // $(`#wizardViewModal ul.content li`).each(function() {
                                //
                                // });
                                $("#wizardViewModal").modal();
                            },
                            error: function error() {
                                $("#wizardViewModal .modal-body").empty();
                                $("#wizardViewModal").modal();
                            }
                        });
                    });

                    $('body').on('click', "#wizardViewModal[data-group=\"" + button_group_id + "\"] .close-icon.item-selected-footer", function (ev) {
                        var id = $(this).closest('li').data('id');
                        var group_id = button_group_id;
                        $("#wizardViewModal #myTabContent").find("li[data-id=\"" + id + "\"]").each(function () {
                            $(this).find('.active').removeClass('active');
                        });
                        $(this).closest('li').remove();
                        console.log(x_group, group_id);
                        if (x_group === group_id) {
                            limite_message(x_group);
                        }
                    });

                    $('body').on('click', "#wizardViewModal[data-group=\"" + button_group_id + "\"] .b_save", function () {
                        var items_array = [];

                        $('#wizardViewModal .modal-body').find(".item-content.active").each(function () {
                            items_array.push($(this).closest('li').attr('data-id'));
                        });

                        var popup_items_qty = [];
                        // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
                        $("[data-id-popup].selected-item_popup").find('.popup_field-input').each(function () {
                            var $this = $(this);
                            popup_items_qty.push({
                                id: $this.closest('.selected-item_popup').attr('data-id-popup'),
                                value: $this.val()
                            });
                        });

                        fetch("/products/get-offer-menu-raws", {
                            method: "post",
                            headers: {
                                "Content-Type": "application/json",
                                Accept: "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-Token": $('input[name="_token"]').val()
                            },
                            credentials: "same-origin",
                            body: JSON.stringify({ ids: items_array })
                        }).then(function (response) {
                            return response.json();
                        }).then(function (json) {
                            console.log(json);

                            var items_row = $("[data-group-id=\"" + button_group_id + "\"]").find('.product-single-info_row-items');
                            items_row.html(json.html);

                            var selects = items_row.find('.select-2');
                            selects.length > 0 && selects.each(function () {
                                $(this).select2({ minimumResultsForSearch: -1 });
                            });
                            $("[data-group-id=\"" + button_group_id + "\"]").closest('.product__single-item-info').css('border-color', '#d7d7d7');
                            $("[data-group-id=\"" + button_group_id + "\"]").closest('.product-single-info_row').find('.field-input').each(function () {
                                var d_id = $(this).attr('data-id');
                                var value = popup_items_qty.length > 0 && popup_items_qty.find(function (el) {
                                    return el.id === d_id;
                                }).value;
                                $(this).val(value);
                                $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
                            });
                            // setTotalPrice(countTotalPrice());

                            countOfferPrice();
                            countOfferTotalPrice();

                            $('#wizardViewModal').modal('hide');

                            $("[data-group=\"" + button_group_id + "\"]").closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                                $(this).closest('.menu-item-selected').remove();
                                setTotalPrice(countTotalPrice());
                            });

                            $("[data-group=\"" + button_group_id + "\"]").closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                                ev.preventDefault();
                                ev.stopImmediatePropagation();
                                var limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                handleProductCountMinus($(this), $("[data-group=\"" + button_group_id + "\"]"), 'popup', limit);
                                setTotalPrice(countTotalPrice());
                            });

                            $("[data-group=\"" + button_group_id + "\"]").closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                                ev.preventDefault();
                                ev.stopImmediatePropagation();
                                var limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                handleProductCountPlus($(this), $("[data-group=\"" + button_group_id + "\"]"), 'popup', limit);
                                setTotalPrice(countTotalPrice());
                            });

                            // console.log('group_id', group_id);

                        });
                    });

                    $('body').on('click', '#wizardViewModal .item-selected-footer', function () {
                        var id = $(this).closest('.footer-list-item').attr('data-id');
                        var name = $(this).closest('.footer-list-item').attr('data-name');
                        activate_item($("#wizardViewModal .content[data-id=\"" + id + "\"]").find('.item-content'), id, name);
                        $(this).closest('.footer-list-item').remove();
                    });
                });
            })();
            // $(`#specialPopUpModal .filters-modal-wizard`).each(function (index) {
            //     const group_id = $(this).attr('data-group');
            //     const filter = [];
            //
            //     let dg = null;
            //     let filter_limit = 0;
            //
            //     $("body").on('click', `.filters-modal-wizard[data-group="${group_id}"]`, function () {
            //         dg = $(this).attr('data-group');
            //         let group = $(this).attr('data-group');
            //         filter_limit = $(this).closest('.limit').attr('data-limit');
            //         const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
            //             return $(item).attr('data-id');
            //         });
            //         // console.log('index',index);
            //         $.ajax({
            //             type: "post",
            //             url: "/products/select-items",
            //             cache: false,
            //             data: {
            //                 group,
            //                 selectedIds,
            //                 type: "popup"
            //             },
            //             headers: {
            //                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            //             },
            //             success: function (data) {
            //                 if (!data.error) {
            //                     $("#wizardViewModal .selected-items_filter").empty();
            //                     $(`.filter[data-group-id="${group}"]`).closest('.product-single-info_row').find('.menu-item-selected').toArray().map((selectedItem) => {
            //                         const selectedItemId = $(selectedItem).attr('data-id');
            //                         const selectedItemTitle = $(selectedItem).find('.delete-menu-item').parent().text().trim();
            //                         // $("#wizardViewModal .selected-items_filter").append(makeSelectedItemModal(selectedItemId, selectedItemTitle, true));
            //                     });
            //                     $("#wizardViewModal").modal();
            //                 } else {
            //                     alert("error");
            //                 }
            //             }
            //         });
            //     });
            //
            //     $("body").on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .wrap-item`, function (ev) {
            //         const id = $(this).attr('data-id');
            //         const title = $(this).find('.name').text().trim();
            //         filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
            //         // filter_limit > new_qty(null, 'filter') &&
            //         if (!$(this).hasClass('active')) {
            //             $(this).addClass('active');
            //             // $('.selected-items_filter').append(makeSelectedItemModal(id, title, true));
            //         } else if ($(this).hasClass('active')) {
            //             $(`[data-id-popup="${id}"]`).remove();
            //             $(this).removeClass('active');
            //         }
            //     });
            //
            //     $('body').on('click', '#wizardViewModal .selected-item-popup_qty-minus', function (ev) {
            //         eventInitialDefault(ev);
            //         $(this).siblings(".popup_field-input").val() > 1 && $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) - 1);
            //     });
            //
            //     $('body').on('click', '#wizardViewModal .selected-item-popup_qty-plus', function (ev) {
            //         eventInitialDefault(ev);
            //         filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
            //         if (filter_limit > new_qty(null, 'filter')) {
            //             $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) + 1);
            //         }
            //     });
            //
            //     $('body').on('click', '#wizardViewModal .selected-item_popup .delete-menu-item', function () {
            //         const remove_id = $(this).attr('data-el-id');
            //         $('#wizardViewModal').find(`.wrap-item[data-id="${remove_id}"]`).removeClass('active');
            //         $(this).closest('.selected-item_popup').remove();
            //     });
            //
            //
            //     $('body').on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function () {
            //         const items_array = [];
            //         // console.log(2, '*****************************')
            //
            //         $('#wizardViewModal .modal-body').find('.wrap-item').each(function () {
            //             $(this).hasClass('active') && (items_array.push($(this).attr('data-id')));
            //         });
            //
            //         const popup_items_qty = [];
            //         // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
            //         $(`[data-id-popup].selected-item_popup`).find('.popup_field-input').each(function () {
            //             const $this = $(this);
            //             popup_items_qty.push({
            //                 id: $this.closest('.selected-item_popup').attr('data-id-popup'),
            //                 value: $this.val()
            //             });
            //         });
            //
            //         fetch("/products/get-offer-menu-raws", {
            //             method: "post",
            //             headers: {
            //                 "Content-Type": "application/json",
            //                 Accept: "application/json",
            //                 "X-Requested-With": "XMLHttpRequest",
            //                 "X-CSRF-Token": $('input[name="_token"]').val()
            //             },
            //             credentials: "same-origin",
            //             body: JSON.stringify({ids: items_array})
            //         })
            //             .then(function (response) {
            //                 return response.json();
            //             })
            //             .then(function (json) {
            //                 const items_row = $(`[data-group-id="${dg}"]`).find('.product-single-info_row-items');
            //                 items_row.append(json.html);
            //                 const selects = items_row.find('.select-2');
            //                 selects.length > 0 && selects.each(function() {
            //                     $(this).select2({minimumResultsForSearch: -1});
            //                 });
            //                 $(`[data-group-id="${dg}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
            //                 // $(`[data-group-id="${dg}"]`).closest('.product-single-info_row').find('.field-input').each(function () {
            //                 //     const d_id = $(this).attr('data-id');
            //                 //     const value = popup_items_qty.length > 0 && popup_items_qty.find((el) => {
            //                 //         return el.id === d_id;
            //                 //     }).value;
            //                 //     $(this).val(value);
            //                 //     $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
            //                 // });
            //                 countOfferPrice();
            //                 countOfferTotalPrice();
            //
            //                 $('#wizardViewModal').modal('hide');
            //
            //
            //
            //                 $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
            //                     $(this).closest('.menu-item-selected').remove();
            //                     setTotalPrice(countTotalPrice());
            //                 });
            //
            //                 $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
            //                     ev.preventDefault();
            //                     ev.stopImmediatePropagation();
            //                     const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
            //
            //                     handleProductCountMinus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
            //                     setTotalPrice(countTotalPrice());
            //
            //                 });
            //
            //                 $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
            //                     ev.preventDefault();
            //                     ev.stopImmediatePropagation();
            //                     const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
            //
            //                     handleProductCountPlus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
            //                     setTotalPrice(countTotalPrice());
            //                 });
            //             });
            //     });
            //
            //     $(this).on('click', function (e) {
            //         const first_category_id = $(this).attr('data-action');
            //         let self = $(this);
            //         let selectMoreItems = [];
            //         let selectSingleItems;
            //
            //         $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .item-content`, function () {
            //             $('.shopping-cart_wrapper .item-content').removeClass('active');
            //             $(this).addClass('active');
            //         });
            //
            //         $body.on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function (e) {
            //             eventInitialDefault(e);
            //             // console.log(1, '*****************************')
            //
            //             $(`.filter[data-group-id="${group_id}"]`).find('.product-single-info_row-items').empty();
            //
            //             if (Number(self.attr('data-multiple')) === 1) {
            //                 $(this).closest('.contents-wrapper').find('.wrap-item.active').each(function () {
            //                     selectMoreItems.push($(this).attr('data-id'));
            //                 });
            //                 selectMoreItems.forEach((item) => {
            //                     createInputHiddenForFilter(item, self);
            //                 });
            //             } else {
            //                 selectSingleItems = $(this).closest('.contents-wrapper').find('.wrap-item.active').attr('data-id');
            //                 createInputHiddenForFilter(selectSingleItems, self);
            //             }
            //
            //             $('#wizardViewModal').modal('hide');
            //         });
            //
            //         $.ajax({
            //             type: "post",
            //             url: "/filters",
            //             cache: false,
            //             data: {
            //                 group: self.attr('data-group'),
            //                 category_id: first_category_id,
            //                 filters: filter,
            //                 type: "popup"
            //             },
            //             headers: {
            //                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            //             },
            //             success: function (data) {
            //                 if (!data.error) {
            //                     const modal_group_id = self.attr('data-group');
            //                     $('#wizardViewModal').attr('data-group', modal_group_id);
            //                     const contantPlace = $('.contents-wrapper .content');
            //                     const wizardPlace = $('.shopping-cart-head .nav-pills');
            //
            //                     wizardPlace.empty();
            //                     wizardPlace.append(data.wizard);
            //                     if (data.type === "filter") {
            //                         contantPlace.html(data.filters);
            //                     } else if (data.type === "items") {
            //                         contantPlace.html(data.items_html);
            //                         makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
            //                         $('.shopping-cart_wrapper .next-btn').addClass('d-none');
            //                         $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
            //                     }
            //                 } else {
            //                     alert("error");
            //                 }
            //             },
            //             error: function (error) {
            //                 filter.pop();
            //             }
            //         });
            //
            //         $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .next-btn`, function (e) {
            //             eventInitialDefault(e);
            //             $('.content-wrap').find('.active').toArray().map(function (actv) {
            //                 filter.push($(actv).closest('[data-id]').attr('data-id'));
            //             });
            //             // console.log(filter);
            //
            //             $('.content-wrap').find('.active').length === 0 ? alert('select item') : $.ajax({
            //                 type: "post",
            //                 url: "/filters",
            //                 cache: false,
            //                 data: {
            //                     group: self.attr('data-group'),
            //                     category_id: first_category_id,
            //                     filters: filter,
            //                     type: "popup"
            //                 },
            //                 headers: {
            //                     "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            //                 },
            //                 success: function (data) {
            //                     if (!data.error) {
            //                         $('.shopping-cart-head .nav-pills').empty();
            //                         $('.shopping-cart-head .nav-pills').append(data.wizard);
            //                         $('.back-btn').removeClass('d-none');
            //                         if (data.type === "filter") {
            //                             $('.contents-wrapper .content').html(data.filters);
            //                         } else if (data.type === "items") {
            //                             $('.contents-wrapper .content').html(data.items_html);
            //                             $(`#wizardViewModal[data-group="${group_id}"] .selected-item_popup`).each(function () {
            //                                 $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).length > 0
            //                                 && $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).addClass('active');
            //                             });
            //                             makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
            //                             $('.shopping-cart_wrapper .next-btn').addClass('d-none');
            //                             $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
            //                         }
            //                     } else {
            //                         alert("error");
            //                     }
            //                 },
            //                 error: function (error) {
            //                     filter.pop();
            //                 }
            //             });
            //         });
            //         $('body').on('click', '.shopping-cart_wrapper .back-btn', function (e) {
            //             e.preventDefault();
            //             e.stopImmediatePropagation();
            //
            //             filter.pop();
            //             // console.log(filter)
            //             $.ajax({
            //                 type: "post",
            //                 url: "/filters",
            //                 cache: false,
            //                 data: {
            //                     group: self.attr('data-group'),
            //                     category_id: first_category_id,
            //                     filters: filter,
            //                     type: 'popup'   //self.attr('data-type')
            //                 },
            //                 headers: {
            //                     "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            //                 },
            //                 success: function (data) {
            //                     if (!data.error) {
            //
            //                         $('.shopping-cart-head .nav-pills').empty();
            //                         $('.shopping-cart-head .nav-pills').append(data.wizard);
            //                         if (data.type === "filter") {
            //                             $('.contents-wrapper .content').html(data.filters);
            //                             $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
            //                             $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
            //                         } else if (data.type === "items") {
            //                             $('.contents-wrapper .content').html(data.items_html);
            //                         }
            //                         if (filter.length === 0) {
            //                             $('.shopping-cart_wrapper .back-btn').addClass('d-none');
            //                         }
            //                     } else {
            //                         alert("error");
            //                     }
            //                 },
            //                 error: function (error) {
            //                     console.log(error);
            //                 }
            //             });
            //         });
            //     });
            //     $('#wizardViewModal').on('hidden.bs.modal', function (e) {
            //         filter.length = 0;
            //         $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
            //         $('.shopping-cart_wrapper .back-btn').addClass('d-none');
            //         $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
            //         $('#wizardViewModal .selected-items_filter').empty();
            //         $('#wizardViewModal .content-wrap .wrap-item').removeClass('active');
            //     });
            // });
        };

        filterModalSingleInit();

        var filterSelectSingleInit = function filterSelectSingleInit() {
            (function () {

                $("#singleProductPageCnt .filters-select-wizard").each(function () {
                    var group_id = $(this).attr('data-group');

                    $("[data-group=\"" + group_id + "\"]").on('change', function () {
                        var self = $(this);
                        var parentRow = $(this).closest('.product__single-item-info-bottom');
                        var data = parentRow.find('form#filter-form').serialize();
                        var limit = $(this).closest('[data-limit]').attr('data-limit');

                        AjaxCall("/filters", data, function (res) {
                            if (!res.error) {
                                switch (res.type) {
                                    case 'filter':
                                        parentRow.find('.filter-children-items').empty();
                                        parentRow.find('.filter-children-selects').html(res.filters);
                                        Number(parentRow.find('.limit[data-limit]').attr('data-limit')) === 1 && parentRow.find('.limit[data-per-price]').attr('data-per-price') !== 'product' && parentRow.find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').empty();
                                        break;
                                    case 'items':
                                        var isMultiple = self.closest('[data-limit]').attr('data-limit') === '1' ? false : true;
                                        parentRow.find('.filter-children-selects').html(res.filters);
                                        parentRow.find('.filter-children-items').children().length === 0 && parentRow.find('.filter-children-items').html(res.items_html);
                                        parentRow.find(".product--select-items").select2({
                                            multiple: isMultiple,
                                            placeholder: "Select Products"
                                        });
                                        makeOutOfStockSelectOption(parentRow.find(".product--select-items"), 'select');
                                        if (isMultiple) {
                                            // select2MaxLimit(parentRow.find('.product--select-items'), limit);
                                        } else {
                                            setTimeout(function () {
                                                var selectElementId = $(parentRow.find(".product--select-items").children()[0]).val();
                                                var id = parentRow.find(".product--select-items").val();
                                                selectHandle(self, id, selectElementId, limit, parentRow.find(".product--select-items"));
                                            }, 0);
                                        }
                                        parentRow.find(".product--select-items").find('option[value=""]').remove();

                                        break;
                                }
                            }
                        });
                    });

                    $("[data-group=\"" + group_id + "\"]").on('select2:select', '.product--select-items', function (e) {
                        var id = e.params.data.id;
                        var limit = $(this).closest('[data-limit]').attr('data-limit');
                        var selectElementId = $(e.params.data.element).attr('data-select2-id');
                        // console.log(1111111111111, e.params);
                        selectHandle($(e.target), id, selectElementId, limit, $(this));
                    });

                    $("[data-group=\"" + group_id + "\"]").on('select2:unselect', '.product--select-items', function (e) {
                        // console.log(e)

                        // const limit = $(this).closest('[data-limit]').attr('data-limit');
                        unselectHandle($(this), e.params.data.id);
                    });

                    $("[data-group=\"" + group_id + "\"]").on('click', '.product-count-minus', function (ev) {
                        eventInitialDefault(ev);
                        var limit = $(this).closest('[data-limit]').attr('data-limit');
                        var row = $(this).closest('.product-single-info_row');
                        var select = row.find('.product--select-items');

                        handleProductCountMinus($(this), select, 'select', limit);
                        setTotalPrice(countTotalPrice());
                    });

                    $("[data-group=\"" + group_id + "\"]").on('click', '.product-count-plus', function (ev) {
                        eventInitialDefault(ev);
                        var limit = $(this).closest('[data-limit]').attr('data-limit');
                        var row = $(this).closest('.product-single-info_row');
                        var select = row.find('.product--select-items');

                        handleProductCountPlus($(this), select, 'select', limit);
                        setTotalPrice(countTotalPrice());
                    });

                    $("[data-group=\"" + group_id + "\"]").on('click', '.remove-single_product-item', function () {
                        // const limit = $(this).closest('[data-limit]').attr('data-limit');

                        if ($(this).closest('.filters-select-wizard').length > 0) {
                            var $this = $(this);
                            var s_id = $this.attr('data-el-id');

                            $(".select2-selection__choice[data-select2-id=\"" + s_id + "\"].select2-selection__choice__remove").click();
                            $(this).closest('.filters-select-wizard').find("option[data-select2-id=\"" + s_id + "\"]");
                            var deleted = $this.closest('.product__single-item-info-bottom').attr('data-id');
                            var values = $(this).closest('.filters-select-wizard').find('.product--select-items').val().filter(function (value) {
                                return value !== deleted;
                            });
                            // console.log('$this', $this, 's_id', s_id, 'deleted', deleted, 'values', values)
                            $(this).closest('.filters-select-wizard').find('.product--select-items').val(values).trigger('change.select2');
                            $this.closest('.menu-item-selected').remove();
                            // select2MaxLimit($(this).closest('.filters-select-wizard').find('.product--select-items'), limit);
                            setTotalPrice(countTotalPrice());
                        }
                    });
                });
            })();
        };

        filterSelectSingleInit();

        var filterSelectOfferInit = function filterSelectOfferInit() {
            (function () {

                $("#specialPopUpModal .filters-select-wizard").each(function () {
                    var group_id = $(this).attr('data-group');

                    $("[data-group=\"" + group_id + "\"]").on('change', function () {
                        var self = $(this);
                        var parentRow = $(this).closest('.product__single-item-info-bottom');
                        var data = parentRow.find('form#filter-form').serialize();
                        var limit = $(this).closest('[data-limit]').attr('data-limit');

                        AjaxCall("/filters", data, function (res) {
                            if (!res.error) {
                                switch (res.type) {
                                    case 'filter':
                                        parentRow.find('.filter-children-items').empty();
                                        parentRow.find('.filter-children-selects').html(res.filters);
                                        Number(parentRow.find('.limit[data-limit]').attr('data-limit')) === 1 && parentRow.find('.limit[data-per-price]').attr('data-per-price') !== 'product' && parentRow.find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').empty();
                                        break;
                                    case 'items':
                                        var isMultiple = self.closest('[data-limit]').attr('data-limit') === '1' ? false : true;
                                        parentRow.find('.filter-children-selects').html(res.filters);
                                        parentRow.find('.filter-children-items').children().length === 0 && parentRow.find('.filter-children-items').html(res.items_html);
                                        parentRow.find(".product--select-items").select2({
                                            multiple: isMultiple,
                                            placeholder: "Select Products"
                                        });
                                        makeOutOfStockSelectOption(parentRow.find(".product--select-items"), 'select');
                                        if (isMultiple) {
                                            // select2MaxLimit(parentRow.find('.product--select-items'), limit);
                                        } else {
                                            setTimeout(function () {
                                                var selectElementId = $(parentRow.find(".product--select-items").children()[0]).val();
                                                var id = parentRow.find(".product--select-items").val();
                                                selectOfferHandle(self, id, selectElementId, limit, parentRow.find(".product--select-items"));
                                                countOfferPrice();
                                            }, 0);
                                        }
                                        parentRow.find(".product--select-items").find('option[value=""]').remove();

                                        break;
                                }
                            }
                        });
                    });

                    $("[data-group=\"" + group_id + "\"]").on('select2:select', '.product--select-items', function (e) {
                        var id = e.params.data.id;
                        var limit = $(this).closest('[data-limit]').attr('data-limit');
                        var selectElementId = $(e.params.data.element).attr('data-select2-id');
                        // console.log(1111111111111, e.params);
                        selectOfferHandle($(e.target), id, selectElementId, limit, $(this));
                        countOfferPrice();
                        countOfferTotalPrice();
                    });

                    $("[data-group=\"" + group_id + "\"]").on('select2:unselect', '.product--select-items', function (e) {
                        // console.log(e)

                        // const limit = $(this).closest('[data-limit]').attr('data-limit');
                        unselectHandle($(this), e.params.data.id);
                        countOfferPrice();
                        countOfferTotalPrice();
                    });

                    $("[data-group=\"" + group_id + "\"]").on('click', '.product-count-minus', function (ev) {
                        eventInitialDefault(ev);
                        var limit = $(this).closest('[data-limit]').attr('data-limit');
                        var row = $(this).closest('.product-single-info_row');
                        var select = row.find('.product--select-items');

                        handleProductCountMinus($(this), select, 'select', limit);
                        countOfferPrice();
                        countOfferTotalPrice();
                    });

                    $("[data-group=\"" + group_id + "\"]").on('click', '.product-count-plus', function (ev) {
                        eventInitialDefault(ev);
                        var limit = $(this).closest('[data-limit]').attr('data-limit');
                        var row = $(this).closest('.product-single-info_row');
                        var select = row.find('.product--select-items');

                        handleProductCountPlus($(this), select, 'select', limit);
                        countOfferPrice();
                        countOfferTotalPrice();
                    });

                    $("[data-group=\"" + group_id + "\"]").on('click', '.remove-single_product-item', function () {
                        // const limit = $(this).closest('[data-limit]').attr('data-limit');

                        if ($(this).closest('.filters-select-wizard').length > 0) {
                            var $this = $(this);
                            var s_id = $this.attr('data-el-id');

                            $(".select2-selection__choice[data-select2-id=\"" + s_id + "\"].select2-selection__choice__remove").click();
                            $(this).closest('.filters-select-wizard').find("option[data-select2-id=\"" + s_id + "\"]");
                            var deleted = $this.closest('.product__single-item-info-bottom').attr('data-id');
                            var values = $(this).closest('.filters-select-wizard').find('.product--select-items').val().filter(function (value) {
                                return value !== deleted;
                            });
                            // console.log('$this', $this, 's_id', s_id, 'deleted', deleted, 'values', values)
                            $(this).closest('.filters-select-wizard').find('.product--select-items').val(values).trigger('change.select2');
                            $this.closest('.menu-item-selected').remove();
                            // select2MaxLimit($(this).closest('.filters-select-wizard').find('.product--select-items'), limit);
                            countOfferPrice();
                            countOfferTotalPrice();
                        }
                    });
                });
            })();
        };

        $('body').on('click', '#specialPopUpModal .bottom-btn-cart', function () {

            var activeProducts = $('body').find(' .special__popup-main-product-item.active');
            var products = [];
            //Edo
            if (location.pathname === "/my-cart") {
                if (activeProducts.length > 0) {
                    activeProducts.each(function () {
                        var product_id = $(this).data('id');
                        var product_qty = 1;
                        var variations = [];

                        var pr_items = $(this).find('.pr-wrap');

                        pr_items.each(function () {
                            var group_id = $(this).data('group-id');
                            var products = [];
                            $(this).find('.product__single-item-info-bottom').each(function () {

                                // console.log('.product__single-item-info-bottom', this);
                                var id = void 0;
                                var qty = void 0;
                                var discount_id = void 0;
                                if ($(this).closest('.filter').length > 0 && $(this).hasClass('get-single-price')) {
                                    id = $(this).data('id');
                                    if ($(this).find('.input-qty').length > 0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if ($(this).find('.select-qty').length > 0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if ($(this).find('.single-product-select').length > 0 && $(this).closest('.filter').length === 0) {
                                    id = $(this).find('.single-product-select').val();
                                    if ($(this).find('.input-qty').length > 0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if ($(this).find('.select-qty').length > 0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if ($(this).find('.custom-control-input').length > 0) {
                                    id = $(this).find('.custom-control-input:checked').val();
                                    // console.log('id', id, $(this), $(this).find('.custom-control-input:checked'),  555555555);
                                    if ($(this).find('.input-qty').length > 0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if ($(this).find('.select-qty').length > 0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if ($(this).closest('.pr-wrap').find('.popup-select').length > 0) {
                                    id = $(this).data('id');

                                    if ($(this).find('.input-qty').length > 0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if ($(this).find('.select-qty').length > 0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if ($(this).closest('.filter').length > 0 && $(this).hasClass('.get-single-price')) {
                                    id = $(this).data('id');

                                    if ($(this).find('.input-qty').length > 0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if ($(this).find('.select-qty').length > 0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                }
                                products.push({
                                    id: id,
                                    qty: qty,
                                    discount_id: discount_id
                                });
                            });

                            variations.push({
                                group_id: group_id,
                                products: products.filter(function (el) {
                                    return el.id !== undefined;
                                })
                            });
                        });
                        products.push({ product_id: product_id, product_qty: product_qty, variations: variations });
                        // console.log(products);
                    });

                    fetch("/add-extra-to-cart", {
                        method: "post",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('input[name="_token"]').val()
                        },
                        credentials: "same-origin",
                        body: JSON.stringify({
                            key: $('.special__popup-content').data('key'),
                            product_id: $('.special__popup-content').data('product-id'),
                            variations: products
                        })
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) {
                        // $self.closest('.special__popup-main-product-item').addClass('active');
                        // console.log($self.closest('.special__popup-main-product-item'));
                        // btnAddToRemove($self);
                        // $('.special__popup-content-right-item.added-offers').append(data.html);
                        $(".cart-area").html(data.html);
                        // addOfferEvent();
                        $("#specialPopUpModal").modal('hide');

                        // $('#headerShopCartBtn').click();
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else {}
            } else {

                if (activeProducts.length > 0) {
                    activeProducts.each(function () {
                        var product_id = $(this).data('id');
                        var product_qty = 1;
                        var variations = [];

                        var pr_items = $(this).find('.pr-wrap');

                        pr_items.each(function () {
                            var group_id = $(this).data('group-id');
                            var products = [];
                            $(this).find('.product__single-item-info-bottom').each(function () {
                                // console.log('.product__single-item-info-bottom', this)
                                var id = void 0;
                                var qty = void 0;
                                var discount_id = void 0;

                                if ($(this).closest('.filter').length > 0 && $(this).hasClass('get-single-price')) {
                                    // console.log(1111111111)
                                    id = $(this).data('id');
                                    if ($(this).find('.input-qty').length > 0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if ($(this).find('.select-qty').length > 0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                }if ($(this).find('.single-product-select').length > 0 && $(this).closest('.filter').length == 0) {
                                    // console.log(222222222)

                                    id = $(this).find('.single-product-select').val();
                                    if ($(this).find('.input-qty').length > 0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if ($(this).find('.select-qty').length > 0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if ($(this).find('.custom-control-input').length > 0) {
                                    // console.log(333333333333)

                                    id = $(this).find('.custom-control-input:checked').val();
                                    // console.log('id', id, $(this), $(this).find('.custom-control-input:checked'),  555555555);
                                    if ($(this).find('.input-qty').length > 0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if ($(this).find('.select-qty').length > 0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if ($(this).closest('.pr-wrap').find('.popup-select').length > 0) {

                                    id = $(this).data('id');

                                    if ($(this).find('.input-qty').length > 0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if ($(this).find('.select-qty').length > 0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                }
                                products.push({
                                    id: id,
                                    qty: qty,
                                    discount_id: discount_id
                                });
                            });

                            variations.push({
                                group_id: group_id,
                                products: products.filter(function (el) {
                                    return el.id !== undefined;
                                })
                            });
                        });
                        products.push({ product_id: product_id, product_qty: product_qty, variations: variations });
                        // console.log(products);
                    });

                    fetch("/add-extra-to-cart", {
                        method: "post",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('input[name="_token"]').val()
                        },
                        credentials: "same-origin",
                        body: JSON.stringify({
                            key: $('.special__popup-content').data('key'),
                            product_id: $('.special__popup-content').data('product-id'),
                            variations: products
                        })
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) {
                        // $self.closest('.special__popup-main-product-item').addClass('active');
                        // console.log($self.closest('.special__popup-main-product-item'));
                        // btnAddToRemove($self);
                        // $('.special__popup-content-right-item.added-offers').append(data.html);
                        $("#specialPopUpModal").modal('hide');
                        $("#headerShopCartBtn").click();
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else {}
            }
        });

        $('body').on('change', '[data-discount-type] input, [data-discount-type] select', function (ev) {
            var discount_type = $(ev.target).closest('[data-discount-type]').attr('data-discount-type');
            discountInputChange($(ev), $(ev.target), discount_type);
        });

        setTotalPrice();

        var initCount = 0,
            initPopupCount = 0,
            initFilterModalCount = 0;

        var dg_popup = void 0;

        $("body").on('click', ".popup-select", function () {
            var $this = $(this);
            var selected_ids = [];
            $this.closest('.limit.pr-wrap').length > 0 && setTimeout(function () {
                $this.closest('.limit.pr-wrap').css('border', 'none');
            }, 1000);
            if ($(this).closest('#singleProductPageCnt').length > 0) {
                $('#popUpModal').attr('product-or-offer', 'product');
            } else if ($(this).closest('#specialPopUpModal').length > 0) {
                $('#popUpModal').attr('product-or-offer', 'offer');
            }

            dg_popup = $this.data('group');
            $this.closest('.product__single-item-info').find('.product__single-item-info-bottom').length > 0 && $this.closest('.product__single-item-info').find('.product__single-item-info-bottom').each(function () {
                selected_ids.push($(this).data('id'));
            });
            // console.log('selected_ids', selected_ids)
            $.ajax({
                type: "post",
                url: "/products/select-items",
                cache: false,
                data: {
                    group: dg_popup,
                    ids: selected_ids
                },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function success(data) {
                    if (!data.error) {
                        $("#popUpModal .modal-content").html(data.html);
                        // $('#popUpModal .title_popup').text(`You can add ${limit} product`);
                        // makeSelectedItem(data_group_id);
                        $("#popUpModal").attr('data-group', dg_popup);
                        makeOutOfStockSelectOption($("#popUpModal .modal-content"), 'popup');
                        $("#popUpModal").attr('limit', $this.closest('.product__single-item-info.limit').data('limit') || $this.closest('.pr-wrap.limit').data('limit'));
                        $("#popUpModal").modal();
                    } else {
                        console.log(data.error);
                    }
                }
            });
        });
        //[data-group="${dg_popup}"]
        $("body").on('click', "#popUpModal .single-item-wrapper .single-item", function (ev) {
            console.log(181818, '-------');
            var offer = $(this).closest('#popUpModal').attr('product-or-offer') === 'offer';
            var id = $(this).closest(".single-item-wrapper").attr('data-id');
            var title = $(this).find('.name-item').text().trim();
            var selectedCount = $(this).closest('.modal-body').find('.single-item-wrapper.active').length;
            var limit = $(this).closest('#popUpModal').attr('limit') * 1;
            var group = $(this).closest('#popUpModal').attr('data-group');
            var selectedItemsCountInPage = $('#singleProductPageCnt').find("[data-group-id=\"" + group + "\"]").find('.product__single-item-info-bottom').length || $('#specialPopUpModal').find("[data-group-id=\"" + group + "\"]").find('.product__single-item-info-bottom').length;
            console.log({
                id: id,
                title: title,
                selectedCount: selectedCount,
                limit: limit,
                group: group,
                offer: offer,
                selectedItemsCountInPage: selectedItemsCountInPage
            });
            if (!$(this).closest(".single-item-wrapper").hasClass('active') && selectedCount + 1 + selectedItemsCountInPage <= limit) {
                $(this).closest(".single-item-wrapper").addClass('active');
                // $(this).closest('.modal').find('.selected-items_popup')
                //     .append(makeSelectedItemModal(id, title));
            } else if ($(this).closest(".single-item-wrapper").hasClass('active')) {
                // $(`[data-id-popup="${id}"]`).remove();
                $(this).closest(".single-item-wrapper").removeClass('active');
            }
        });

        $("body").on('click', "#popUpModal .modal-footer .b_save", function () {
            var items_value_array = [];
            var items_array = [];
            $('#popUpModal').find('.single-item-wrapper.active').each(function () {
                items_value_array.push({
                    id: $(this).data('id'),
                    value: 1
                    // $(this).find('.selected-item-popup_qty-select').val()
                });
                items_array.push($(this).data('id'));
            });

            if ($(this).closest('#popUpModal').attr('product-or-offer') === 'product') {
                fetch("/products/get-variation-menu-raws", {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        ids: items_array,
                        items: items_value_array
                    })
                }).then(function (response) {
                    return response.json();
                }).then(function (json) {
                    var selected_product_wrapper = $("[data-group=\"" + dg_popup + "\"]").closest('.product-single-info_row').find('.product-single-info_row-items');

                    $(".product__single-item-info[data-group-id=\"" + dg_popup + "\"]").append(json.html);
                    $(".product__single-item-info[data-group-id=\"" + dg_popup + "\"]").find('.select-2').each(function () {
                        $(this).select2({ minimumResultsForSearch: -1 });
                    });
                    selected_product_wrapper.empty();
                    selected_product_wrapper.append(json.html);

                    json.items.map(function (item) {
                        var item_price = Number(selected_product_wrapper.find(".menu-item-selected[data-id=\"" + item.id + "\"]").attr('data-price'));
                        selected_product_wrapper.find(".menu-item-selected[data-id=\"" + item.id + "\"]").find('.product-qty').val(Number(item.value));
                        selected_product_wrapper.find(".menu-item-selected[data-id=\"" + item.id + "\"]").find('.price-placee').html("" + getCurrencySymbol() + item_price * Number(item.value));
                    });
                    $(".product__single-item-info[data-group-id=\"" + dg_popup + "\"]").closest('.product__single-item-info').css('border-color', '#d7d7d7');
                    // setTotalPrice(modal);
                    setTotalPrice(countTotalPrice());
                    $('#popUpModal').modal('hide');

                    $("[data-group=\"" + dg_popup + "\"]").closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                        $(this).closest('.menu-item-selected').remove();
                        setTotalPrice(countTotalPrice());
                    });

                    // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                    //     eventInitialDefault(ev);
                    //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                    //
                    //     // handleProductCountMinus($(this), $(`[data-group="${data_group_id}"]`), 'popup', limit);
                    //     // setTotalPrice(modal);
                    // });
                    //
                    // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                    //     eventInitialDefault(ev);
                    //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                    //
                    //     // handleProductCountPlus($(this), $(`[data-group="${dg_popup}"]`), 'popup', limit);
                    //     // setTotalPrice(modal);
                    // });
                });
            } else if ($(this).closest('#popUpModal').attr('product-or-offer') === 'offer') {
                fetch("/products/get-offer-menu-raws", {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        ids: items_array,
                        items: items_value_array
                    })
                }).then(function (response) {
                    return response.json();
                }).then(function (json) {
                    var selected_product_wrapper = $(".pr-wrap[data-group-id=\"" + dg_popup + "\"]");
                    // console.log(111111111111111111, selected_product_wrapper, dg_popup)
                    selected_product_wrapper.append(json.html);

                    // $(`.product__single-item-info[data-group-id="${dg_popup}"]`).append(json.html);
                    $(".pr-wrap[data-group-id=\"" + dg_popup + "\"]").find('.select-2').each(function () {
                        $(this).select2({ minimumResultsForSearch: -1 });
                    });

                    // $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                    countOfferPrice();

                    // selected_product_wrapper.find('.product__single-item-info-bottom').remove();
                    //
                    //
                    // json.items.map((item) => {
                    //     const item_price = Number(selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).attr('data-price'));
                    //     selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.product-qty').val(Number(item.value));
                    //     selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.price-placee').html(`${getCurrencySymbol()}${item_price * Number(item.value)}`);
                    // });

                    // setTotalPrice(modal);
                    // setTotalPrice(countTotalPrice());
                    $('#popUpModal').modal('hide');

                    $("[data-group=\"" + dg_popup + "\"]").closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                        $(this).closest('.menu-item-selected').remove();
                        setTotalPrice(countTotalPrice());
                    });

                    // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                    //     eventInitialDefault(ev);
                    //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                    //
                    //     // handleProductCountMinus($(this), $(`[data-group="${data_group_id}"]`), 'popup', limit);
                    //     // setTotalPrice(modal);
                    // });
                    //
                    // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                    //     eventInitialDefault(ev);
                    //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                    //
                    //     // handleProductCountPlus($(this), $(`[data-group="${dg_popup}"]`), 'popup', limit);
                    //     // setTotalPrice(modal);
                    // });
                });
            }
        });

        $("body").on('click', ".select-extra", function () {
            $("#extraModal").find(".select-extra").removeClass("active");
            $(this).addClass("active");
            AjaxCall("/products/get-extra-item", {
                id: $(this).attr('data-id'),
                group: $(this).attr('data-group')
            }, function (res) {
                if (!res.error) {
                    $("#extraModal").find(".extra-main-content").html(res.html);
                    var selectedExtra = selectedGroupId.find(function (_ref) {
                        var group = _ref.group;

                        return group === $("#extraModal [data-group-id]").attr('data-group-id');
                    });

                    if (selectedExtra) {
                        $("#extraModal [data-group-id]").closest('.product-single-info_row ').addClass('pointer-events-none');
                        $('#extraModal .product-card_btn').removeClass('d-inline-flex').addClass('d-none');
                        $('#extraModal .product-card_edit').removeClass('d-none').addClass('d-inline-flex');
                        $("#extraModal").find(".extra-main-content").html(selectedExtra.view);
                        productsInit(true, res.type);
                    } else {
                        $('#extraModal .product-card_btn').removeClass('d-none').addClass('d-inline-flex');
                        $('#extraModal .product-card_edit').removeClass('d-inline-flex').addClass('d-none');
                        productsInit(true, res.type);
                    }
                }
            });
        });

        $('#extraModal').on('hidden.bs.modal', function () {
            $(this).find('.extra-main-content').empty();
            $("#extraModal .modal-price-place-summary").html(getCurrencySymbol() + '0');
            !isCartPage() && $('#headerShopCartBtn').click();
            selectedGroupId.length = 0;
        });
        // productsInit();

        $("body").on('click', '.bottom-btn-cart.no-btn', function () {
            $("#specialPopUpModal").modal('hide');
            setTimeout(function () {
                $("#headerShopCartBtn").click();
            }, 0);
        });

        $("body").on('click', '.btn-add-to-cart', function (e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var product_id = $('#singleProductPageCnt #vpid').val();
            var product_qty = $('.continue-shp-wrapp_qty .field-input.product-qty-select').val();
            var variations = [];
            var bad = [];
            var product__single_items = $('.product__single-item-info');

            product__single_items.each(function () {
                var group_id = $(this).data('group-id');
                var products = [];
                $(this).find('.product__single-item-info-bottom').each(function () {
                    var id = void 0;
                    var qty = void 0;
                    var discount_id = void 0;
                    if ($(this).closest('.filter').length > 0) {
                        id = $(this).data('id');
                        if ($(this).find('.input-qty').length > 0) {
                            qty = $(this).find('.input-qty').val();
                            discount_id = null;
                        } else if ($(this).find('.select-qty').length > 0) {
                            qty = null;
                            discount_id = $(this).find('.select-qty').val();
                        } else {
                            qty = '1';
                            discount_id = null;
                        }
                    } else {
                        if ($(this).find('.single-product-select').length > 0) {
                            id = $(this).find('.single-product-select').val();
                            if ($(this).find('.input-qty').length > 0) {
                                qty = $(this).find('.input-qty').val();
                                discount_id = null;
                            } else if ($(this).find('.select-qty').length > 0) {
                                qty = null;
                                discount_id = $(this).find('.select-qty').val();
                            } else {
                                qty = '1';
                                discount_id = null;
                            }
                        } else if ($(this).find('.custom-control-input').length > 0) {
                            id = $(this).find('.custom-control-input:checked').val();

                            if ($(this).find('.input-qty').length > 0) {
                                qty = $(this).find('.input-qty').val();
                                discount_id = null;
                            } else if ($(this).find('.select-qty').length > 0) {
                                qty = null;
                                discount_id = $(this).find('.select-qty').val();
                            } else {
                                qty = '1';
                                discount_id = null;
                            }
                        } else if ($(this).closest('.product__single-item-info').find('.popup-select').length > 0) {
                            id = $(this).data('id');

                            if ($(this).find('.input-qty').length > 0) {
                                qty = $(this).find('.input-qty').val();
                                discount_id = null;
                            } else if ($(this).find('.select-qty').length > 0) {
                                qty = null;
                                discount_id = $(this).find('.select-qty').val();
                            } else {
                                qty = '1';
                                discount_id = null;
                            }
                        }
                    }

                    id === 'no' ? products = 'no' : products.push({
                        id: id,
                        qty: qty,
                        discount_id: discount_id
                    });
                });

                variations.push({
                    group_id: group_id,
                    products: products !== 'no' ? products.filter(function (el) {
                        return el.id !== undefined;
                    }) : 'no'
                });
            });
            // console.log({product_id,product_qty, variations});
            variations.map(function (gr) {
                var minLimit = $('#singleProductPageCnt').find("[data-group-id=\"" + gr.group_id + "\"]").attr('data-min-limit') * 1;
                var maxLimit = $('#singleProductPageCnt').find("[data-group-id=\"" + gr.group_id + "\"]").attr('data-limit') * 1;
                console.log(gr.group_id, minLimit);
                gr.products.length < minLimit && minLimit !== 0 && bad.push(gr.group_id);
            });
            // console.log(variations);
            if (bad.length !== 0) {
                bad.map(function (group_id) {
                    $(".product__single-item-info[data-group-id=\"" + group_id + "\"]").css('border-color', 'red');
                });
                return false;
            } else {
                $.ajax({
                    type: "post",
                    url: "/add-to-cart",
                    cache: false,
                    datatype: "json",
                    data: { product_id: product_id, product_qty: product_qty, variations: variations },
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function success(data) {
                        if (!data.error) {

                            if (data.message === 'added') {
                                $('#cartSidebar').html(data.headerHtml);
                                $('.add-cart-number.cart-count').html(data.count);
                                console.log('data.show_popup', data.show_popup);
                                if (data.show_popup) {
                                    $('#specialPopUpModal .modal-body').html(data.specialHtml);
                                    $('.special__popup-main-product-item .select-2').each(function () {
                                        $(this).select2({ minimumResultsForSearch: -1 });
                                    });
                                    filterModalOfferInit();
                                    filterSelectOfferInit();
                                    countOfferPrice();
                                    $("#specialPopUpModal").modal('show');
                                } else {
                                    $('#headerShopCartBtn').trigger('click');
                                }
                            }

                            // $(".cart-count").html(data.count);
                            // $('#cartSidebar').html(data.headerHtml);
                            // addDataKey.key = data.key;
                            // addDataKey.product_id = data.product_id;
                            // AjaxCall("/products/get-extra-content", {id: $("#vpid").val()}, function (res) {
                            //     if (!res.error) {
                            //         $("#extraModal .modal-body").html(res.html);
                            //         productsInit();
                            //         $("#extraModal").modal();
                            //     }
                            // });
                            //
                            // $('#extraModal .extra-content-left .select-extra.item.active').click();
                        } else {
                                //test
                                // alert(data.message);
                            }
                    }
                });
            }
        });

        $('#specialPopUpModal').on('hidden.bs.modal', function (e) {
            // $('#cartSidebar').empty();
            // $('.add-cart-number.cart-count').empty();
            $('#specialPopUpModal .modal-body').empty();
        });

        $("body").on("click", ".extra-sections", function () {
            var id = $(this).attr('data-product-id');
            var key = $(this).attr('data-key');
            AjaxCall("/products/get-extra-content", { id: id }, function (res) {
                if (!res.error) {
                    $("#extraModal .modal-body").html(res.html);
                    productsInit();
                    addDataKey.product_id = id;
                    addDataKey.key = key;
                    $("#extraModal").modal();
                    $('#extraModal .extra-content-left .select-extra.item.active').click();
                }
            });
        });

        $('.shopping-cart-inner').find('.product-qty-select').addClass('none-touchable');

        // $("body").on('click', '.qty-count', function (ev) {
        //     const inCartList = typeof ev.originalEvent.path.find((path) => {
        //         return $(path).hasClass('shopping-cart-inner');
        //     }) !== "undefined";
        //     if (inCartList) {
        //         return;
        //     } else {
        //         let qty = $('.product-qty-select').val();
        //         let type = $(this).data('type');
        //         if (type == 'plus') {
        //             qty = parseInt(qty) + 1;
        //             $('.product-qty-select').val(qty);
        //             setTotalPrice();
        //         } else {
        //             if (qty > 1) {
        //                 qty -= 1;
        //                 $('.product-qty-select').val(qty);
        //                 setTotalPrice();
        //             }
        //         }
        //     }
        // });


        // function addOfferEvent() {
        //     $("body").find().each(function() {

        // const items = [];
        // $(this).closest('.footer').find('.remove-extra-from-cart').each(function() {
        //     items.push($(this).data('uid'));
        // });
        $("body").on('click', '.add-offers-btn', function (ev) {
            var item_id = $(this).data('uid');
            eventInitialDefault(ev);

            $.ajax({
                type: "post",
                url: "/my-cart-special-offer",
                cache: false,
                datatype: "json",
                data: { item_id: item_id },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function success(data) {
                    if (!data.error) {
                        // console.log(data.html)
                        $('#specialPopUpModal .modal-body').html(data.html);

                        $('#specialPopUpModal .modal-body').find('.select-2').select2({ minimumResultsForSearch: -1 });
                        $('.special__popup-content-right-product').each(function () {
                            if ($(".special__popup-main-product-item[data-id=\"" + $(this).data('id') + "\"]").length > 0) {
                                $(".special__popup-main-product-item[data-id=\"" + $(this).data('id') + "\"]").addClass('user-non-select');
                            }
                        });
                        $('.user-non-select').find('.special__popup-main-product-item-btn').removeClass('add-btn').addClass('remove-btn').html('remove');
                        filterModalOfferInit();
                        filterSelectOfferInit();
                        countOfferPrice();
                        countOfferTotalPrice();
                        $('#specialPopUpModal .product__single-item_price').each(function () {
                            $(this).closest('.special__popup-main-product-item-price').length === 0 && $(this).css('display', 'none');
                        });
                        $("#specialPopUpModal").modal();
                        // if(data.message === 'added') {
                        //     $('#cartSidebar').html(data.headerHtml);
                        //     $('.add-cart-number.cart-count').html(data.count);
                        //     $('#specialPopUpModal .modal-body').html(data.specialHtml);
                        //     $('.special__popup-main-product-item .select-2').each(function() {
                        //         $(this).select2();
                        //     });
                        //     filterModalOfferInit();
                        //     filterSelectOfferInit();
                        //     countOfferPrice();
                        //     $("#specialPopUpModal").modal();
                        // }

                        // $(".cart-count").html(data.count);
                        // $('#cartSidebar').html(data.headerHtml);
                        // addDataKey.key = data.key;
                        // addDataKey.product_id = data.product_id;
                        // AjaxCall("/products/get-extra-content", {id: $("#vpid").val()}, function (res) {
                        //     if (!res.error) {
                        //         $("#extraModal .modal-body").html(res.html);
                        //         productsInit();
                        //         $("#extraModal").modal();
                        //     }
                        // });
                        //
                        // $('#extraModal .extra-content-left .select-extra.item.active').click();
                    } else {
                            //test
                            // alert(data.message);
                        }
                }
            });
        });
        // });
        // };

        // addOfferEvent();
        //------------------------------------------------------------------------------------------------------------------------
    });
});

// my account select start
$('#accounts--selects').on('select2:select', function (e) {
    var locUrl = e.params.data.id;
    window.location.replace(locUrl);
});
// my account select end

// header search for mobile
$('body').on('click', '.search-icon-mobile .icon', function () {
    $(this).closest('.header-bottom').find('.cat-search').toggleClass('closed');
});

$('.nav-item.nav-item--has-dropdown').hover(function () {
    var darkBg = $(this).closest('body').find('.dark-bg_body');
    if ($('body').hasClass('show-filter')) {
        $('body').removeClass('show-filter');
    } else {
        darkBg.addClass('show');
    }
}, function () {
    var darkBg = $(this).closest('body').find('.dark-bg_body');
    if (!$('.top-filters .nav-item--has-dropdown_dropdown').hasClass('open')) {
        darkBg.removeClass('show');
    } else {
        $('body').addClass('show-filter');
    }
});
// filter show
$('body').on('click', '.top-filters .arrow-wrap .arrow-filters', function () {
    var darkBg = $(this).closest('body').find('.dark-bg_body');
    if (darkBg.hasClass('show')) {
        darkBg.removeClass('show');
    } else {
        darkBg.addClass('show');
    }
    $(this).find('.arrow').toggleClass('opened');
    $(this).closest('.top-filters').find('.main-filters').toggleClass('closed-mobile');
    $(this).closest('.arrow-wrap').find('.nav-item--has-dropdown_dropdown').toggleClass('open');

    $(this).closest('body').toggleClass('show-filter');
});

// range
// $('.range-steps_item.active').nextAll($('.range-steps_item')).addClass('line-none');


// cards change display
$('body').on('click', '.display-icon', function (e) {
    e.preventDefault();
    $('.display-icon').removeClass('active');
    $(this).addClass('active');
    if ($(this).attr('id') === 'dispGrid') {
        localStorage.setItem('display-grid', "grid");
        $('.change-display-wrap').addClass('display-grid');
    } else {
        localStorage.setItem('display-grid', "list");
        $('.change-display-wrap').removeClass('display-grid');
    }
});

localStorage.getItem('display-grid') == "list" && $('#displVertBtn').click();

// scroll top button
$('body').on('click', '#scrollTopBtn', function () {
    if ($('#singleProductPageCnt').length) {
        $('#singleProductPageCnt').animate({
            scrollTop: 0
        }, 800);
    } else {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    }
});

// product range count
$('body').on('click ', ' .range-steps input', function () {
    $(this).closest('.range-steps').find('.range-steps_item').removeClass('active line-none');
    if ($(this).is(":checked")) {
        $(this).parent().addClass('active');
        $(this).parent().addClass('line-none');
        $(this).parent().nextAll($('.range-steps_item')).addClass('line-none');
    }
});

$('body').on('click', '.range-steps_count', function () {
    var rangeItem = $(this).closest('.range-steps_item');
    $(this).closest('.range-steps').find('input').removeAttr('checked');
    // if(!rangeItem.find('input').is(":checked")){
    $(this).closest('.range-steps').find('.range-steps_item').removeClass('active line-none');
    rangeItem.find('input').removeAttr('checked');
    $(this).closest('.range-steps_item').addClass('active').nextAll().addClass('line-none');
    // }
});

// cookies: change content top styles
changeHeaderWhenIsCookie();

// display filter for mobile
// $('body').on('click', '.filters-for-mobile .btn--filter', function () {
//     $(this).closest('.top-filters').find('.main-filters').toggleClass('closed-mobile');
// });


// menu click mobile
$('body').on('click', '.header-top .nav-item--has-dropdown', function () {
    $(this).toggleClass('active');
    $('body').find('.dark-bg_body').removeClass('show');
});

// hidden sidebars slide from right
openSidebar($('#ptofileBtn'), $('#profileSidebar'), []);
openSidebar($('#headerShopCartBtn'), $('#cartSidebar'));
openSidebar($('.share-button.facebook-share-button'), $('#share_modal'));

// my account select make fixed when scrolled
$(window).scroll(function () {
    var wScroll = $(this).scrollTop();

    if (wScroll > 0) {
        $('.my-account--selects').addClass('pos-fixed');
    } else {
        $('.my-account--selects').removeClass('pos-fixed');
    }
});

function checkSidebar() {
    var active = 0;
    $('.hidden-sidebar').each(function () {
        if ($(this).hasClass('show')) {
            active = 1;
        }
    });
    if (!!active) {
        $('.dark-bg_body').addClass('show');
        $('body').addClass('body-over-hidden');
    } else {
        $('.dark-bg_body').removeClass('show');
        $('body').removeClass('body-over-hidden');
    }
};

function openSidebar(btn, sidebar) {
    btn.on('click', function (e) {
        e.stopPropagation();
        $('.sidebar_button_active_detector').each(function () {
            // console.log($(this), btn);
            $(this)[0] != btn[0] && $(this).removeClass('active');
        });
        $('.hidden-sidebar').each(function () {
            $(this)[0] != sidebar[0] && $(this).removeClass('show');
        });

        $(this).toggleClass('active');
        sidebar.toggleClass('show');
        checkSidebar();
    });

    $('body').on('click', function (e) {
        if (btn.hasClass('active')) {
            btn.removeClass('active');
        }
        if (!$(e.target).closest(sidebar).length) {
            sidebar.removeClass('show');
        }

        if ($(e.target).hasClass('share_modal_close')) {
            sidebar.removeClass('show');
        }
        checkSidebar();
    });
}

function changeHeaderWhenIsCookie() {
    if ($('.js-cookie-consent.cookie-consent').css('display') !== 'none') {
        var cookieHeight = $('.js-cookie-consent.cookie-consent').height();

        $('.main-header .header-top').css('top', cookieHeight);

        var headerPaddingTop = parseInt($('.main-header').css('padding-top'));
        var headerPaddingTopNew = headerPaddingTop + cookieHeight + 'px';

        $('.main-header').css('padding-top', headerPaddingTopNew);

        var headerHeight = $('.header-top').height();
        var accountSelectPaddingTop = headerHeight + cookieHeight;

        $('.my-account--selects').css('top', accountSelectPaddingTop);

        $('.js-cookie-consent-agree').on('click', function () {
            var resetHeaderPaddingTop = headerPaddingTop + 'px';
            $('.main-header').css('padding-top', resetHeaderPaddingTop);
            $('.main-header .header-top').css('top', 0);

            $('.my-account--selects').css('top', headerHeight);
        });
    }
}

function heightBlock(mainDiv, element) {
    var countElement = 0;
    $(element).each(function () {
        countElement += $(this).outerHeight();
    });
    if ($(mainDiv).outerHeight() < countElement) {
        $(mainDiv).css('display', 'block');
    } else {
        $(mainDiv).css('display', 'flex');
    }
}

// console.log(1111111111111111111);
$('body').on('click', function (ev) {
    // console.log(2, $(ev.target));
    if ($(ev.target).closest('.navbar-toggler').length === 0) {
        if ($('.navbar-collapse').hasClass('show') && !($(ev.target).hasClass('navbar-nav') || $(ev.target).closest('.navbar-nav').length > 0)) {
            $('.navbar-collapse').removeClass('show');
            // console.log(1);
        }
    }
});
// $("body").on('click', `#popUpModal .modal-footer .b_save`, function () {
//     const items_value_array = [];
//     const items_array = [];
//     $('#popUpModal').find('.single-item-wrapper.active').each(function () {
//         items_value_array.push({
//             id: $(this).data('id'),
//             value: 1
//             // $(this).find('.selected-item-popup_qty-select').val()
//         });
//         items_array.push($(this).data('id'));
//     });
//     fetch("/products/get-variation-menu-raws", {
//         method: "post",
//         headers: {
//             "Content-Type": "application/json",
//             Accept: "application/json",
//             "X-Requested-With": "XMLHttpRequest",
//             "X-CSRF-Token": $('input[name="_token"]').val()
//         },
//         credentials: "same-origin",
//         body: JSON.stringify({
//             ids: items_array,
//             items: items_value_array
//         })
//     })
//         .then(function (response) {
//             return response.json();
//         })
//         .then(function (json) {
//             const selected_product_wrapper = $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').find('.product-single-info_row-items');
//
//             $(`.product__single-item-info[data-group-id="${dg_popup}"]`).append(json.html);
//             $(`.product__single-item-info[data-group-id="${dg_popup}"]`).find('.select-2').each(function() {
//                 $(this).select2();
//             });
//             selected_product_wrapper.empty();
//             selected_product_wrapper.append(json.html);
//
//             json.items.map((item) => {
//                 const item_price = Number(selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).attr('data-price'));
//                 selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.product-qty').val(Number(item.value));
//                 selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.price-placee').html(`${getCurrencySymbol()}${item_price * Number(item.value)}`);
//             });
//
//             // setTotalPrice(modal);
//             setTotalPrice(countTotalPrice());
//             $('#popUpModal').modal('hide');
//
//             $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
//                 $(this).closest('.menu-item-selected').remove();
//                 setTotalPrice(modal);
//             });
//
//             // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
//             //     eventInitialDefault(ev);
//             //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
//             //
//             //     // handleProductCountMinus($(this), $(`[data-group="${data_group_id}"]`), 'popup', limit);
//             //     // setTotalPrice(modal);
//             // });
//             //
//             // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
//             //     eventInitialDefault(ev);
//             //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
//             //
//             //     // handleProductCountPlus($(this), $(`[data-group="${dg_popup}"]`), 'popup', limit);
//             //     // setTotalPrice(modal);
//             // });
//         });
// });

// $('body').on('click', '.filter-sidebar-wrapper .head.filter-main__head', function () {
//     let blockId = $(this).parent().find('.all-filters');
//     if ($(blockId).css('display') == 'none')
//     {
//         $(blockId).animate({height: 'show'}, 400);
//         $(this).find('i').toggleClass('fa-plus fa-minus');
//     }
//     else
//     {
//         $(blockId).animate({height: 'hide'}, 400);
//         $(this).find('i').toggleClass('fa-minus fa-plus');
//     }
// });

// // remove cart-info from cart sidbar
// $('.cart-item-close').on('click', function (e) {
//     e.stopPropagation();
//     $(this).parent($('.cart-aside-item')).remove();
//     if(!$('.cart-aside-item').length) {
//     $('#cartSidebarEmptyMsg').show();
//         $('#headerShopCartBtn').removeClass('active')
// } else {
//         $('#cartSidebarEmptyMsg').hide();
//     }
// });

// grid brands products

//counts qty for group
//         const new_qty = function (group, type) {
//             let qty = 0;
//             if (type === 'popup') {
//                 $('.selected-items_popup').find('.popup_field-input').each(function () {
//                     qty += Number($(this).val());
//                 });
//             } else if (type === 'filter') {
//                 $('#wizardViewModal .selected-items_filter').find('.popup_field-input').each(function () {
//                     qty += Number($(this).val());
//                 });
//             } else {
//                 group.closest('.product-single-info_row').find('.product-qty').each(function () {
//                     qty += Number($(this).val());
//                 });
//             }
//
//             return qty;
//         };

//set select2 max limit
//         const select2MaxLimit = (section, limit) => {
//             section.select2({
//                 maximumSelectionLength:
//                     Number(limit)
//                     - Number(new_qty(section))
//                     + section.closest('.product-single-info_row').find('input[name="qty"]').length
//             });
//         };

//product-count-minus event callback
//         const handleProductCountMinus = (minus_button, section, type, limit) => {
//             const counter = $(minus_button.closest('.continue-shp-wrapp_qty').find('.field-input')[0]);
//
//             Number(counter.val()) > 1 && counter.val(Number(counter.val()) - 1);
//             new_qty(section);
//
//             if (type === 'select') {
//                 select2MaxLimit(section, limit);
//             } else if (type === 'checkbox') {
//
//             }
//
//             const price = minus_button.closest('[data-price]').attr('data-price');
//             minus_button.closest('[data-price]').find('.price-placee').html(`${getCurrencySymbol()}${price * Number(counter.val())}`);
//         };
// const countPrices = (modal) => {
//     section_price = 0;
//     item_price = 0;
//     $(`${modal ? '#extraModal' : '.single-product-dtls-wrap'} [data-per-price]`).each(function () {
//         const $this = $(this);
//         if ($this.attr('data-per-price') === 'product') {
//             section_price += Number($this.attr('data-price'));
//         } else if ($this.attr('data-per-price') === 'item') {
//             $this.closest('.product-single-info_row').find('.product-qty').length !== 0
//             && $this.closest('.product-single-info_row').find('.product-qty').each(function () {
//                 const $product_qty_input = $(this);
//                 const qty = Number($product_qty_input.val());
//                 const price = Number($product_qty_input.closest('[data-price]').attr('data-price'));
//                 item_price = item_price + (qty * price);
//             });
//         }
//     });
//     return section_price + item_price;
// };
//
// const setTotalPrice = (modal) => {
//     const total_price_count = Number($('.product-qty-select').val());
//     //total price element
//     const $total = modal ? $('.modal-price-place-summary') : $('.price-place-summary');
//     $total.html(`${getCurrencySymbol()}${countPrices(modal) * total_price_count}`);
// };

// const makeSelectedItem = (data_group) => {
//     $(`.package_product[data-group-id="${data_group}"]`).closest('.product-single-info_row').find('.menu-item-selected').each(function () {
//         $('#popUpModal').find(`.single-item-wrapper[data-id="${$(this).attr('data-id')}"]`).find('.single-item').click();
//         $(`.selected-item_popup[data-id-popup="${$(this).attr('data-id')}"]`).find('.selected-item-popup_qty-select').val(Number($(this).find('.product-qty').val()));
//     });
// };
//         const productsInit = (modal, modalType = 'all') => {
//             const getParentId = modal ? '#extraModal' : '#requiredProducts';
// //--------------------------------select start
//             const selectInit = () => {
//                 (function () {
//                     $(`${getParentId} .product-pack-select`) && $(`${getParentId} .product-pack-select`).each(function (i, e) {
//                         makeOutOfStockSelectOption($(this), 'select');
//                         const products_id = $(e).attr('data-id');
//                         const select = $(e);
//                         fetch("/products/get-package-type-limit", {
//                             method: "post",
//                             headers: {
//                                 "Content-Type": "application/json",
//                                 Accept: "application/json",
//                                 "X-Requested-With": "XMLHttpRequest",
//                                 "X-CSRF-Token": $('input[name="_token"]').val()
//                             },
//                             credentials: "same-origin",
//                             body: JSON.stringify({id: products_id})
//                         })
//                             .then(function (response) {
//                                 return response.json();
//
//                             })
//                             .then(function (json) {
//                                 const limit = Number(json.limit);
//
//                                 select.select2({
//                                     minimumResultsForSearch: Infinity,
//                                     maximumSelectionLength: isSingle(select) ? Infinity : Number(json.limit),
//                                     placeholder: 'Select an option'
//                                 });
//
//                                 select.closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
//                                     eventInitialDefault(ev);
//                                     handleProductCountMinus($(this), select, 'select', limit);
//                                     setTotalPrice(modal);
//                                 });
//
//                                 select.closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
//                                     eventInitialDefault(ev);
//                                     handleProductCountPlus($(this), select, 'select', limit);
//                                     setTotalPrice(modal);
//                                 });
//
//                                 select.on('select2:select', function (e) {
//                                     const $this = $(this);
//                                     const current_item_id = $(e.params.data.element).val();
//                                     new_qty(select);
//                                     console.log({
//                                         id: e.params.data.id,
//                                             selectElementId: current_item_id
//                                     })
//                                     fetch("/products/get-variation-menu-raw", {
//                                         method: "post",
//                                         headers: {
//                                             "Content-Type": "application/json",
//                                             Accept: "application/json",
//                                             "X-Requested-With": "XMLHttpRequest",
//                                             "X-CSRF-Token": $('input[name="_token"]').val()
//                                         },
//                                         credentials: "same-origin",
//                                         body: JSON.stringify({
//                                             id: e.params.data.id,
//                                             selectElementId: current_item_id
//                                         })
//                                     })
//                                         .then(function (response) {
//                                             return response.json();
//                                         })
//                                         .then(function (json) {
//                                             if (isSingle(select)) {
//                                                 !isSection(select) && ($this.closest('.product-single-info_row').find('.selected-menu-options').html(json.html));
//                                             } else {
//                                                 $this.closest('.product-single-info_row').find('.product-single-info_row-items').append(json.html);
//                                             }
//                                             setTotalPrice(modal);
//
//                                             $('.delete-menu-item').on('click', function () {
//                                                 const $this = $(this);
//                                                 const s_id = $this.attr('data-el-id');
//                                                 $(`.select2-selection__choice[data-select2-id="${s_id}"].select2-selection__choice__remove`).click();
//                                                 $(`#multi_v_select_${products_id} option[data-select2-id="${s_id}"]`);
//                                                 const deleted = $this.closest('.menu-item-selected').attr('data-id');
//                                                 const values = select.val().filter((value) => value !== deleted);
//                                                 select.val(values).trigger('change.select2');
//                                                 $this.closest('.menu-item-selected').remove();
//                                                 new_qty(select);
//                                                 select2MaxLimit(select, limit);
//                                                 setTotalPrice(modal);
//                                             });
//
//                                         })
//                                         .catch(function (error) {
//                                             console.log(error);
//                                         });
//                                 });
//
//                                 isSingle(select) && select.ready(function (e) {
//                                     const current_item_id = select.children().first().attr('data-select2-id');
//
//                                     fetch("/products/get-variation-menu-raw", {
//                                         method: "post",
//                                         headers: {
//                                             "Content-Type": "application/json",
//                                             Accept: "application/json",
//                                             "X-Requested-With": "XMLHttpRequest",
//                                             "X-CSRF-Token": $('input[name="_token"]').val()
//                                         },
//                                         credentials: "same-origin",
//                                         body: JSON.stringify({
//                                             id: select.children().first().attr('value'),
//                                             selectElementId: current_item_id
//                                         })
//                                     })
//                                         .then(function (response) {
//                                             return response.json();
//                                         })
//                                         .then(function (json) {
//                                             if (isSingle(select)) {
//                                                 !isSection(select) && (item_price += select.closest('.product-single-info_row').find('.menu-item-selected').find('[data-price]'));
//                                             } else {
//                                                 select.closest('.product-single-info_row').find('.product-single-info_row-items').append(json.html);
//                                             }
//
//                                             setTotalPrice(modal);
//                                         })
//                                         .catch(function (error) {
//                                             console.log(error);
//                                         });
//                                 });
//
//                                 $(`#multi_v_select_${products_id}`).on('select2:unselect', function (e) {
//                                     $(this).closest('.product-single-info_row').find(`.menu-item-selected[data-id="${e.params.data.id}"]`).remove();
//                                     setTimeout(function () {
//                                         new_qty(select);
//                                         select2MaxLimit(select, limit);
//                                         setTotalPrice(modal);
//                                     }, 0);
//                                 });
//                             })
//                             .catch(function (error) {
//                                 console.log(error);
//                             });
//
//                     });
//                 })();
//             };
// //--------------------------------select end
//
// //--------------------------------list start
//             const listInit = () => {
//                 (function () {
//                     const hasQtyCounter = (qty_section) => {
//                         return qty_section.children().length !== 0;
//                     };
//
//                     const counterHtml = (id) => {
//                         return (`<div class="continue-shp-wrapp_qty position-relative product-counts-wrapper w-100">
//                                     <span class="d-flex align-items-center h-100 pointer position-absolute product-count-minus">
//                                         <svg viewBox="0 0 20 3" width="20px" height="3px">
//                                             <path fill-rule="evenodd" fill="rgb(214, 217, 225)" d="M20.004,2.938 L-0.007,2.938 L-0.007,0.580 L20.004,0.580 L20.004,2.938 Z"></path>
//                                         </svg>
//                                     </span>
//                                     <input name="qty" data-id="${id}" min="1" value="1" type="number" class="field-input w-100 h-100 font-23 text-center border-0 form-control product-qty none-touchable"/>
//                                     <span  class="d-flex align-items-center h-100 pointer position-absolute product-count-plus">
//                                         <svg viewBox="0 0 20 20" width="20px" height="20px">
//                                             <path fill-rule="evenodd" fill="rgb(211, 214, 223)" d="M20.004,10.938 L11.315,10.938 L11.315,20.000 L8.696,20.000 L8.696,10.938 L-0.007,10.938 L-0.007,8.580 L8.696,8.580 L8.696,0.007 L11.315,0.007 L11.315,8.580 L20.004,8.580 L20.004,10.938 Z"></path>
//                                         </svg>
//                                     </span>
//                                 </div>`);
//                     };
//
//                     $(`${getParentId} .products-list-wrap`).each(function (index, data_el) {
//                         makeOutOfStockSelectOption($(this), 'list');
//                         const products_id = $(data_el).attr('data-id');
//                         const limit = Number($(data_el).attr('data-limit'));
//
//                         $(`#products-list_${products_id}`).on('click', '.package_checkbox_label', function (event) {
//                             eventInitialDefault(event);
//                             const checkbox = $(event.target).closest('.checkbox-wrap').find('.package_checkbox')[0];
//                             const id = $(checkbox).val();
//                             const counter_wrap = $($(event.target).closest('.product-list-item').find('.list-qty')[0]);
//                             const price = $(counter_wrap[0]).closest('[data-price]').attr('data-price');
//                             const block_id = $(this).closest('.products-list-wrap').attr('data-id');
//
//                             if (new_qty(counter_wrap) === limit && !isChecked($(checkbox))) {
//                                 return false;
//                             }
//                             if (!hasQtyCounter(counter_wrap)) {
//                                 // products-list-wrap
//                                 fetch("/products/get-variation-menu-raw", {
//                                     method: "post",
//                                     headers: {
//                                         "Content-Type": "application/json",
//                                         Accept: "application/json",
//                                         "X-Requested-With": "XMLHttpRequest",
//                                         "X-CSRF-Token": $('input[name="_token"]').val()
//                                     },
//                                     credentials: "same-origin",
//                                     body: JSON.stringify({id: block_id, selectElementId: id})
//                                 })
//                                     .then(function (response) {
//                                         return response.json();
//                                     })
//                                     .then(function (json) {
//                                         $(counter_wrap[0]).append(json.html);
//                                     })
//                                     .catch(function (error) {
//                                         console.log(error);
//                                     });
//                                 // $(counter_wrap[0]).append(counterHtml(id));
//                                 setTotalPrice(modal);
//                             } else {
//                                 $(counter_wrap[0]).closest('[data-price]').find('.price-placee').html(`${getCurrencySymbol()}${price}`);
//                                 $(counter_wrap[0]).empty();
//                                 setTotalPrice(modal);
//                             }
//                             $(this).closest('div').find('.package_checkbox')[0].click();
//                         });
//
//                         $(`#products-list_${products_id}`).on('click', '.product-count-minus', function (ev) {
//                             eventInitialDefault(ev);
//                             handleProductCountMinus($(this), $(`#products-list_${products_id}`), 'checkbox', limit);
//                             setTotalPrice(modal);
//                         });
//
//                         $(`#products-list_${products_id}`).on('click', '.product-count-plus', function (ev) {
//                             eventInitialDefault(ev);
//                             handleProductCountPlus($(this), $(`#products-list_${products_id}`), 'checkbox', limit);
//                             setTotalPrice(modal);
//                         });
//                     });
//                 })();
//             };
// //--------------------------------list end
//
// //--------------------------------popup start
//             const popupInit = () => {
//                 (function () {
//
//                     $(`${getParentId} .popup-select`).each(function () {
//                         const data_group_id = $(this).closest('.package_product').attr('data-group-id');
//                         let limit = 0;
//
//
//                         $('body').on('click', '.delete-menu-item_popup', function () {
//                             const id = $(this).attr('data-el-id');
//
//                             $(this).closest('.modal').find(`.single-item-wrapper[data-id="${id}"]`).removeClass('active');
//                             $(this).closest('.selected-item_popup').remove();
//                         });
//
//                         $('body').on('click', `#popUpModal[data-group="${data_group_id}"] .selected-item-popup_qty-plus`, function (ev) {
//                             eventInitialDefault(ev);
//                             if (limit > new_qty(null, 'popup')) {
//                                 $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) + 1);
//                             }
//                         });
//
//                         $('body').on('click', `#popUpModal[data-group="${data_group_id}"] .selected-item-popup_qty-minus`, function (ev) {
//                             eventInitialDefault(ev);
//                             $(this).siblings(".popup_field-input").val() > 1 && $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) - 1);
//                         });
//
//                         $('#popUpModal').on('click', '.b_close', function () {
//                             $(".single-item-wrapper").removeClass('active');
//                         });
//
//                     });
//
//                 })();
//             };
// //--------------------------------popup end
//
//--------------------------------filter modal start

//--------------------------------filter modal end
//
// //--------------------------------filter select start
//             const filterSelectInit = () => {
//                 (function () {
//
// //select handle function
//                     const selectHandle = (el, id, selectElementId, limit, select) => {
//                         fetch("/products/get-variation-menu-raw", {
//                             method: "post",
//                             headers: {
//                                 "Content-Type": "application/json",
//                                 Accept: "application/json",
//                                 "X-Requested-With": "XMLHttpRequest",
//                                 "X-CSRF-Token": $('input[name="_token"]').val()
//                             },
//                             credentials: "same-origin",
//                             body: JSON.stringify({id: id, selectElementId: id})
//                         })
//                             .then(function (response) {
//                                 return response.json();
//                             })
//                             .then(function (json) {
//                                 const isMultiple = select.closest('[data-limit]').attr('data-limit') === '1' ? false : true;
//                                 if (isMultiple) {
//                                     el.closest('.product-single-info_row').find('.filter-children-items').append(json.html);
//                                     select2MaxLimit(select, limit);
//                                 } else {
//                                     el.closest('.product-single-info_row').find('.menu-item-selected').remove();
//                                     el.closest('.product-single-info_row').find('.filter-children-items').append(json.html);
//                                     // el.closest('.product-single-info_row').find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').html($(el.closest('.product-single-info_row').find('.filter-children-items').children()[1]));
//                                     $(el.closest('.product-single-info_row').find('.filter-children-items').children()[1]).remove();
//                                 }
//                                 setTotalPrice(modal);
//                             })
//                             .catch(function (error) {
//                                 console.log(error);
//                             });
//                     };
//
// //unselect handle function
//                     const unselectHandle = (select, id, limit) => {
//                         select.closest('.filters-select-wizard').find(`.menu-item-selected[data-id="${id}"]`).remove();
//                         setTimeout(function () {
//                             select2MaxLimit(select, limit);
//                             setTotalPrice(modal);
//                         }, 0);
//                     };
//
//
//                     $(`${getParentId} .filters-select-wizard`).each(function () {
//                         const group_id = $(this).attr('data-group');
//
//                         $(`[data-group="${group_id}"]`).on('change', function () {
//                             let self = $(this);
//                             let parentRow = $(this).closest('.product-single-info_row');
//                             let data = parentRow.find('form#filter-form').serialize();
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//
//                             AjaxCall("/filters",
//                                 data,
//                                 function (res) {
//                                     if (!res.error) {
//                                         switch (res.type) {
//                                             case 'filter':
//                                                 parentRow.find('.filter-children-items').empty();
//                                                 parentRow.find('.filter-children-selects').html(res.filters);
//                                                 Number(parentRow.find('.limit[data-limit]').attr('data-limit')) === 1
//                                                 && parentRow.find('.limit[data-per-price]').attr('data-per-price') !== 'product'
//                                                 && parentRow.find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').empty();
//                                                 break;
//                                             case 'items':
//                                                 const isMultiple = self.closest('[data-limit]').attr('data-limit') === '1' ? false : true;
//                                                 parentRow.find('.filter-children-selects').html(res.filters);
//                                                 parentRow.find('.filter-children-items').children().length === 0 && parentRow.find('.filter-children-items').html(res.items_html);
//                                                 parentRow.find(".product--select-items").select2({
//                                                     multiple: isMultiple,
//                                                     placeholder: "Select Products",
//                                                 });
//                                                 makeOutOfStockSelectOption(parentRow.find(".product--select-items"), 'select');
//                                                 if (isMultiple) {
//                                                     select2MaxLimit(parentRow.find('.product--select-items'), limit);
//                                                 } else {
//                                                     setTimeout(function () {
//                                                         const selectElementId = $(parentRow.find(".product--select-items").children()[0]).val();
//                                                         const id = parentRow.find(".product--select-items").val();
//                                                         selectHandle(self, id, selectElementId, limit, parentRow.find(".product--select-items"));
//                                                     }, 0);
//
//                                                 }
//                                                 parentRow.find(".product--select-items").find('option[value=""]').remove();
//                                                 break;
//                                         }
//                                     }
//                                 });
//                         });
//
//                         $(`[data-group="${group_id}"]`).on('select2:select', '.product--select-items', function (e) {
//                             const id = e.params.data.id;
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//                             const selectElementId = $(e.params.data.element).attr('data-select2-id');
//                             selectHandle($(e.target), id, selectElementId, limit, $(this));
//                         });
//
//                         $(`[data-group="${group_id}"]`).on('select2:unselect', '.product--select-items', function (e) {
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//                             unselectHandle($(this), e.params.data.id, limit);
//                         });
//
//                         $(`[data-group="${group_id}"]`).on('click', '.product-count-minus', function (ev) {
//                             eventInitialDefault(ev);
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//                             const row = $(this).closest('.product-single-info_row');
//                             const select = row.find('.product--select-items');
//
//                             handleProductCountMinus($(this), select, 'select', limit);
//                             setTotalPrice(modal);
//                         });
//
//                         $(`[data-group="${group_id}"]`).on('click', '.product-count-plus', function (ev) {
//                             eventInitialDefault(ev);
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//                             const row = $(this).closest('.product-single-info_row');
//                             const select = row.find('.product--select-items');
//
//                             handleProductCountPlus($(this), select, 'select', limit);
//                             setTotalPrice(modal);
//                         });
//
//                         $(`[data-group="${group_id}"]`).on('click', '.delete-menu-item', function () {
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//
//                             if ($(this).closest('.filters-select-wizard').length > 0) {
//                                 const $this = $(this);
//                                 const s_id = $this.attr('data-el-id');
//
//                                 $(`.select2-selection__choice[data-select2-id="${s_id}"].select2-selection__choice__remove`).click();
//                                 $(this).closest('.filters-select-wizard').find(`option[data-select2-id="${s_id}"]`);
//                                 const deleted = $this.closest('.menu-item-selected').attr('data-id');
//                                 const values = $(this).closest('.filters-select-wizard').find('.product--select-items').val().filter((value) => value !== deleted);
//                                 $(this).closest('.filters-select-wizard').find('.product--select-items').val(values).trigger('change.select2');
//                                 $this.closest('.menu-item-selected').remove();
//                                 select2MaxLimit($(this).closest('.filters-select-wizard').find('.product--select-items'), limit);
//                                 setTotalPrice(modal);
//                             }
//                         });
//                     });
//
//                 })();
//             };
// //--------------------------------filter select end
//
//             if (!modal && initCount === 0) {
//                 selectInit();
//                 listInit();
//                 popupInit();
//                 filterModalInit();
//                 filterSelectInit();
//                 initCount++;
//             } else if (modal) {
//                 switch (modalType) {
//                     case 'menu':
//                         selectInit();
//                         break;
//                     case 'list':
//                         listInit();
//                         break;
//                     case 'popup':
//                         if (initPopupCount === 0) {
//                             popupInit();
//                             initPopupCount++;
//                         }
//                         break;
//                     case 'filter_popup':
//                         if (initFilterModalCount === 0) {
//                             filterModalInit();
//                             initFilterModalCount++;
//                         }
//                         break;
//                     case 'select_filter':
//                         filterSelectInit();
//                         break;
//                     default:
//                         return;
//                 }
//             }
//         };
// $("body").on('click', '#extraModal .product-card_btn', function () {
//     const variations = $('#extraModal [data-group-id]').toArray().map(function (el) {
//         const group_id = $(el).attr('data-group-id');
//         const products = [];
//         $(`#extraModal [data-group-id="${group_id}"]`).toArray().map(function (gr) {
//             console.log($(gr).find('.custom-control-input'))
//
//             if ($(gr).closest('.product-single-info_row').find('.product-qty').length !== 0) {
//                 $(gr).closest('.product-single-info_row').find('.product-qty').toArray().map(function (qt) {
//                     products.push({
//                         id: $(qt).attr('data-id'),
//                         qty: $(qt).val()
//                     });
//                 });
//             } else if ($(gr).find('.custom-control-input').length === 0 || $(gr).find('.custom-control-input').is(':checked')) {
//
//                 products.push({
//                     id: $($(gr).find('[data-id]')[0]).attr('data-id'),
//                     qty: 1
//                 });
//                 console.log(products, 'products')
//             } else {
//                 products.push({
//                     id: $($(gr).find('[data-id]')[0]).attr('data-id'),
//                     qty: 1
//                 });
//             }
//         });
//         return {
//             group_id,
//             products
//         };
//     });
//
//
//
//     const filtered_variations = variations.filter((variation) => {
//         return variation.products.length > 0;
//     });
//     console.log('filtered_variations', filtered_variations);
//     if (filtered_variations.length > 0) {
//         $.ajax({
//             type: "post",
//             url: "/add-extra-to-cart",
//             cache: false,
//             datatype: "json",
//             data: {
//                 key: addDataKey.key,
//                 product_id: addDataKey.product_id,
//                 variations: filtered_variations[0],
//                 cart: isCartPage()
//             },
//             headers: {
//                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
//             },
//             success: function (data) {
//                 if (!data.error) {
//                     $(`#extraModal [data-group-id]`).closest('.product-single-info_row ').addClass('pointer-events-none');
//                     selectedGroupId.push({
//                         group: $(`#extraModal [data-group-id]`).attr('data-group-id'),
//                         view: $(`#extraModal [data-group-id]`).closest('.product-single-info_row '),
//                     });
//
//                     $('#extraModal .product-card_btn').removeClass('d-inline-flex').addClass('d-none');
//                     $('#extraModal .product-card_edit').removeClass('d-none').addClass('d-inline-flex');
//
//                     $('.cart-area').html(data.html);
//                 } else {
//
//                 }
//             }
//         });
//     }
// });
// $("body").on('click', '.btn-add-to-cart', function () {
//     var variationId = $(this).data("id");
//     let all_validation = false;
//     let item_validation = 0;
//     $('#requiredProducts .limit').each(function (index, gr) {
//         const $group = $(gr);
//         const group_id = Number($group.attr('data-id'));
//         const group_limit = Number($group.attr('data-limit'));
//         const group_min_limit = Number($group.attr('data-min-limit'));
//         let qty = 0;
//
//         $group.closest('.product-single-info_row').find('.product-qty').each(function (index, i_qty) {
//             const $item_qty = $(i_qty)
//
//             qty += Number($item_qty.val());
//         });
//
//         if (group_limit >= qty && group_min_limit <= qty) {
//             item_validation += 1;
//         }
//     });
//     all_validation = true;
//     $('.product-qty').toArray().map(function (el) {
//         return {
//             id: $(el).attr('data-id'),
//             qty: $(el).val()
//         };
//     });
//
//     if (all_validation) {
//         const product_id = $('#vpid').val();
//         const product_qty = $('.product-qty-select').val();
//         const variations = $('#requiredProducts [data-group-id]').toArray().map(function (el) {
//             const group_id = $(el).attr('data-group-id');
//             const products = [];
//             $(`[data-group-id="${group_id}"]`).toArray().map(function (gr) {
//                 if ($(gr).closest('.product-single-info_row').find('.product-qty').length !== 0) {
//                     $(gr).closest('.product-single-info_row').find('.product-qty').toArray().map(function (qt) {
//                         products.push({
//                             id: $(qt).attr('data-id'),
//                             qty: $(qt).val()
//                         });
//                     });
//                 } else if ($(gr).find('.custom-control-input').length === 0 || $(gr).find('.custom-control-input').is(':checked')) {
//                     products.push({
//                         id: $($(gr).find('[data-id]')[0]).attr('data-id'),
//                         qty: 1
//                     });
//                 }
//             });
//             return {
//                 group_id,
//                 products
//             };
//         });
//
//         const filtered_variations = variations.filter((variation) => {
//             return variation.products.length > 0;
//         });
//         const product_data = {
//             product_id,
//             product_qty,
//             variations: filtered_variations
//         };
//
//         $.ajax({
//             type: "post",
//             url: "/add-to-cart",
//             cache: false,
//             datatype: "json",
//             data: product_data,
//             headers: {
//                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
//             },
//             success: function (data) {
//                 if (!data.error) {
//                     $(".cart-count").html(data.count);
//                     $('#cartSidebar').html(data.headerHtml);
//                     addDataKey.key = data.key;
//                     addDataKey.product_id = data.product_id;
//                     AjaxCall("/products/get-extra-content", {id: $("#vpid").val()}, function (res) {
//                         if (!res.error) {
//                             $("#extraModal .modal-body").html(res.html);
//                             productsInit();
//                             $("#extraModal").modal();
//                         }
//                     });
//
//                     $('#extraModal .extra-content-left .select-extra.item.active').click();
//                 } else {
//                     alert(data.message);
//                 }
//             }
//         });
//     } else {
//         alert('Select available variation');
//     }
// });


window.AjaxCall = function postSendAjax(url, data, _success, _error) {
    $.ajax({
        type: "post",
        url: url,
        cache: false,
        datatype: "json",
        data: data,
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        },
        success: function success(data) {
            if (_success) {
                _success(data);
            }
            return data;
        },
        error: function error(errorThrown) {
            if (_error) {
                _error(errorThrown);
            }
            return errorThrown;
        }
    });
};

function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
        var a,
            b,
            i,
            val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) {
            //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = x.length - 1;
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

$(document).ready(function () {
    // if($('#filter-form .filter-sidebar-wrapper').length === 0) {
    document.getElementById("search-product").addEventListener("keyup", function (event) {
        event.preventDefault();

        event.target.value.trim() === '' ? $('#autocomplite_content_search').css('display', 'none') : $('#autocomplite_content_search').css('display', 'block');
        if (event.target.value.trim() !== '') {
            console.log('***********************');
            $('.search_icon_header').removeClass('d-flex').addClass('d-none');
            $('.close_icon_header').removeClass('d-none').addClass('d-flex');
        } else {
            $('.search_icon_header').removeClass('d-none').addClass('d-flex');
            $('.close_icon_header').removeClass('d-flex').addClass('d-none');
        }
        if (event.keyCode === 13) {
            var form = $("#filter-form");
            var category = $('.all_categories').val();
            var search_text = $("#search-product").val();
            var url = "/products/" + category;

            if (form.length > 0) {
                if (search_text) {
                    var input = $("<input>").attr("type", "hidden").attr("name", "q").val(search_text);
                    form.append(input);
                }
                form.attr('action', url);
                form.submit();
            } else {
                window.location = "/products/" + category + "?q=" + $(this).val();
            }
        }
    });
    // }

    $(document).on('click', function (ev) {
        if ($(ev.target).closest('#autocomplite_content_search').length > 0) {} else {
            $('#autocomplite_content_search').css('display', 'none');
        };
    });

    $('body').on('click', '.close_icon_header', function () {
        $('#search-product').val('');
        $('.search_icon_header').removeClass('d-none').addClass('d-flex');
        $('.close_icon_header').removeClass('d-flex').addClass('d-none');
        $('#search-product').focus();
        $('#autocomplite_content_search').css('display', 'none');
    });

    // $('#search-product').val().trim() === '' ? $('#autocomplite_content_search').css('display', 'none') : $('#autocomplite_content_search').css('display', 'block')

    $("#search-product").autocomplete({
        // serviceUrl: '/search',
        // onSelect: function (suggestion) {
        //     alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        // },
        // source:countries,
        // lookup: countries,
        appendTo: "#autocomplite_content_search",
        width: '100%',
        source: function source(d, e) {

            var category = $(".all_categories").val();
            category = category.length === 0 ? null : $(".all_categories").val();
            var data = {
                name: $("#search-product").val(),
                category: category
            };
            $.ajax({
                type: 'POST',
                url: '/search',
                dataType: "JSON",
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                data: data,
                success: function success(b) {
                    // console.log(b, d, e);
                    var c = [];
                    console.log('------------------', b.data);

                    if (b.data.length > 0) {
                        $.each(b.data, function (i, a) {
                            c.push(a);
                        });
                        $('#autocomplite_content_search .not_found').removeClass('d-flex').addClass('d-none');
                    } else {

                        if ($('#search-product').val().trim() === '') {
                            $('#autocomplite_content_search').css('display', 'none');
                            $('#autocomplite_content_search .not_found').removeClass('d-flex').addClass('d-none');
                        } else {
                            $('#autocomplite_content_search').css('display', 'block');
                            $('#autocomplite_content_search .not_found').removeClass('d-none').addClass('d-flex');
                        }
                    }
                    e(c);
                }
            });
        },
        onSelect: function onSelect(suggestion) {
            alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        // console.log(location, 55555555555, item);
        encodeURI(item.slug);
        var inner_html = "  <a class=\"autocomplete_link_custom\" style=\"all: unset;\" href=\"" + location.origin + "/products/" + encodeURI(item.category) + "/" + encodeURI(item.slug) + "\">\n                                <div class=\"autocomplete_content_custom\">\n                                    <div class=\"autocomplete_image_container_custom\">\n                                        <img class=\"autocomplete_image_custom\" src=\"" + item.image + "\">\n                                    </div>\n                                    <div class=\"autocomplete-right-main-content\">\n                                         <div class=\"autocomplete_title_container_custom\">\n                                            <h4 class=\"font-sec-reg font-17 text-main-clr lh-1 autocomplete_title_custom\">" + item.name + "</h4>\n                                        </div>\n                                        <p class=\"font-main-light text-light-clr font-14 autocomplete_description_custom\">" + item.short_description + "...</p>\n                                    </div>\n\n                                </div>\n                            </a>";
        // console.log('--------------', item);
        return $("<li></li>").data("item.autocomplete", item).append(inner_html).appendTo(ul);
    };

    $("body").on('click', '.shopping-cart-content .inp-up, .shopping-cart-content .inp-down', function () {
        var uid = $(this).closest('.shopping__cart-tab-table-wall').data('uid');
        var condition = $(this).hasClass('inp-up');
        if (uid && uid != '') {
            $.ajax({
                type: "post",
                url: "/update-cart",
                cache: false,
                datatype: "json",
                data: { uid: uid, condition: condition },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function success(data) {
                    if (!data.error) {
                        $('.cart-area').html(data.html);
                        $('#cartSidebar').html(data.headerHtml);
                    } else {
                        alert('error');
                    }
                }
            });
        } else {
            alert('Select available variation');
        }
    });

    // $("body").on('change', '.qty-input' ,function () {
    //     var uid = $(this).data('uid');
    //     var condition = 'inner';
    //     var value = $(this).val();
    //     if(uid && uid != ''){
    //         $.ajax({
    //             type: "post",
    //             url: "/update-cart",
    //             cache: false,
    //             datatype: "json",
    //             data: {  uid : uid, condition: condition,value :value },
    //             headers: {
    //                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
    //             },
    //             success: function(data) {
    //                 if(! data.error){
    //                     $('.cart-area').html(data.html)
    //                     $('#cartSidebar').html(data.headerHtml)
    //                 }else{
    //                     alert('error')
    //                 }
    //             }
    //         });
    //     }else{
    //         alert('Select available variation');
    //     }
    // });


    $("body").on('click', '.remove-from-cart', function (e) {
        e.stopPropagation();
        var uid = $(this).data('uid');

        if (uid && uid != '') {
            $.ajax({
                type: "post",
                url: "/remove-from-cart",
                cache: false,
                datatype: "json",
                data: { uid: uid },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function success(data) {
                    if (!data.error) {
                        $('.cart-area').html(data.html);
                        $('#cartSidebar').html(data.headerHtml);
                        $(".cart-count").html(data.count);
                    } else {
                        alert('error');
                    }
                }
            });
        } else {
            alert('Select available variation');
        }
    });

    $("body").on('click', '.remove-extra-from-cart', function (e) {
        e.stopPropagation();
        var uid = $(this).data('uid');
        var section_id = $(this).data('section-id');

        if (uid && uid != '' && section_id && section_id != '') {
            $.ajax({
                type: "post",
                url: "/remove-from-cart",
                cache: false,
                datatype: "json",
                data: { uid: uid, section_id: section_id },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function success(data) {
                    if (!data.error) {
                        $('.cart-area').html(data.html);
                        $('#cartSidebar').html(data.headerHtml);
                        $(".cart-count").html(data.count);
                    } else {
                        alert('error');
                    }
                }
            });
        } else {
            alert('Select available variation');
        }
    });

    $("#change-currency").change(function () {
        var code = $(this).val();
        $.ajax({
            type: "post",
            url: "/change-currency",
            cache: false,
            datatype: "json",
            data: {
                code: code
            },
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function success(data) {
                window.location.reload();
            }
        });
    });
});

var GOOGLE_RECAPTCHA_KEY = $('meta[name="google-recaptcha-key"]').attr("content");
console.log();
function onRecaptchaLoadCallback() {
    var clientId = grecaptcha.render('inline-badge', {
        'sitekey': GOOGLE_RECAPTCHA_KEY,
        'badge': 'bottomleft',
        'size': 'invisible'
    });
}
(function () {
    $('body').on('change', '.wholesaler_radio', function (ev) {
        if ($(this).val() == 1) {
            $("body").find(".wholesaler-box").addClass('show').removeClass('d-none');
        } else {
            $("body").find(".wholesaler-box").addClass('d-none').removeClass('show');
        }
    });

    $('#register-form-1').on('submit', function (ev) {
        var _this4 = this;

        ev.preventDefault();

        grecaptcha.ready(function () {

            grecaptcha.execute(GOOGLE_RECAPTCHA_KEY, { action: 'action_name' }).then(function (token) {
                $('.g-recaptcha-response').val(token);
            }).then(function () {
                var data = $(_this4).serialize();

                var firstNameEl = $('#firstName');
                var lastNameEl = $('#lastName');
                var emailEl = $('#e-mail');
                var phoneEl = $('#phoneNumber');
                var passwordEl = $('#password');
                var wholesaler_radio = $('.wholesaler_radio');
                var companyName = $('#companyName');
                var companyNumber = $('#companyNumber');

                var errorHandler = function errorHandler(fieldElement, errorObject, message, fieldElementName) {
                    var change = function change(fieldElementChange, fieldElementNameChange) {
                        fieldElementChange.removeClass('transition-horizontal input-error');
                        $(fieldElementNameChange + '~p').remove();
                    };
                    change(fieldElement, fieldElementName);

                    var pTag = fieldElement.next().prop("tagName") !== 'p';

                    if (errorObject && message && pTag) {
                        fieldElement.parent().append('<p style="color: red; font-size: 12px; margin-top: 2px;">' + message + '</p>');
                        fieldElement.addClass('transition-horizontal input-error');
                        setTimeout(function () {
                            fieldElement.removeClass('transition-horizontal');
                        }, 500);
                    }
                    fieldElement.on('keypress', function () {
                        return change(fieldElement, fieldElementName);
                    });
                    fieldElement.on('change', function () {
                        return change(fieldElement, fieldElementName);
                    });
                };
                // const validation = () => {
                //     !firstNameEl.val() && errorHandler(firstNameEl, true, 'The name field is required.', '#firstName');
                //     firstNameEl.val().length === 1 && errorHandler(firstNameEl, true, 'The name must be at least 2 characters.', '#firstName');
                //     !lastNameEl.val() && errorHandler(lastNameEl, true, 'The name field is required.', '#lastName');
                //     lastNameEl.val().length === 1 && errorHandler(lastNameEl, true, 'The name must be at least 2 characters.', '#lastName');
                // }
                // validation() &&
                $.ajax({
                    type: "post",
                    url: "/register",
                    cache: false,
                    datatype: "json",
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function success(data) {
                        if (!data.error) {
                            window.location = data.redirectPath;
                        }
                    },
                    error: function error(_error2) {
                        console.log($('form')[0]);
                        errorHandler(firstNameEl, _error2.responseJSON.errors, _error2.responseJSON.errors.name, '#firstName');
                        errorHandler(lastNameEl, _error2.responseJSON.errors, _error2.responseJSON.errors.last_name, '#lastName');
                        errorHandler(emailEl, _error2.responseJSON.errors, _error2.responseJSON.errors.email, '#e-mail');
                        errorHandler(phoneEl, _error2.responseJSON.errors, _error2.responseJSON.errors.phone, '#phoneNumber');
                        errorHandler(passwordEl, _error2.responseJSON.errors, _error2.responseJSON.errors.password, '#password');
                        console.log(wholesaler_radio.val(), _typeof(wholesaler_radio.val()));
                        if (wholesaler_radio.val()) {

                            errorHandler(companyName, _error2.responseJSON.errors, _error2.responseJSON.errors.company_name, '#companyName');
                            errorHandler(companyNumber, _error2.responseJSON.errors, _error2.responseJSON.errors.company_number, '#companyNumber');
                        }
                    }
                });
            });
        });
    });
})();

(function () {
    $('#login-form').on('submit', function (ev) {
        var _this5 = this;

        ev.preventDefault();

        var GOOGLE_RECAPTCHA_KEY = $('meta[name="google-recaptcha-key"]').attr("content");
        grecaptcha.ready(function () {

            grecaptcha.execute(GOOGLE_RECAPTCHA_KEY, { action: 'action_name' }).then(function (token) {
                $('.g-recaptcha-response').val(token);
            }).then(function () {
                var data = $(_this5).serialize();

                var errorHandler = function errorHandler(fieldElement, errorObject, message, fieldElementName) {
                    var change = function change(fieldElementChange, fieldElementNameChange) {
                        fieldElementChange.removeClass('transition-horizontal input-error');
                        $(fieldElementNameChange + '~p').remove();
                    };
                    change(fieldElement, fieldElementName);

                    var pTag = fieldElement.next().prop("tagName") !== 'p';

                    if (errorObject && message && pTag) {
                        fieldElement.parent().append('<p style="color: red; font-size: 12px; margin-top: 2px;">' + message + '</p>');
                        fieldElement.addClass('transition-horizontal input-error');
                        setTimeout(function () {
                            fieldElement.removeClass('transition-horizontal');
                        }, 500);
                    }
                    fieldElement.on('keypress', function () {
                        change(fieldElement, fieldElementName);
                    });
                    fieldElement.on('change', function () {
                        change(fieldElement, fieldElementName);
                    });
                };

                $.ajax({
                    type: "post",
                    url: "/login",
                    cache: false,
                    datatype: "json",
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function success(data) {
                        if (!data.error) {
                            location.href = data.redirectPath;
                            console.log(data);
                        } else {
                            alert('error');
                        }
                    },
                    error: function error(_error3) {
                        var emailEl = $('#loginEmail');
                        var passwordEl = $('#loginPass');
                        errorHandler(emailEl, _error3.responseJSON.errors, _error3.responseJSON.errors.email, '#loginEmail');
                        errorHandler(passwordEl, _error3.responseJSON.errors, _error3.responseJSON.errors.password, '#loginPass');
                    }
                });
            });
        });
    });

    $('#login-form-checkout').on('submit', function (ev) {
        var _this6 = this;

        ev.preventDefault();

        var GOOGLE_RECAPTCHA_KEY = $('meta[name="google-recaptcha-key"]').attr("content");
        grecaptcha.ready(function () {
            grecaptcha.execute(GOOGLE_RECAPTCHA_KEY, { action: 'action_name' }).then(function (token) {
                $('.g-recaptcha-response').val(token);
            }).then(function () {
                var data = $(_this6).serialize();

                var errorHandler = function errorHandler(fieldElement, errorObject, message, fieldElementName) {
                    var change = function change(fieldElementChange, fieldElementNameChange) {
                        fieldElementChange.removeClass('transition-horizontal input-error');
                        $(fieldElementNameChange + '~p').remove();
                    };
                    change(fieldElement, fieldElementName);

                    var pTag = fieldElement.next().prop("tagName") !== 'p';

                    if (errorObject && message && pTag) {
                        fieldElement.parent().append('<p style="color: red; font-size: 12px; margin-top: 2px;">' + message + '</p>');
                        fieldElement.addClass('transition-horizontal input-error');
                        setTimeout(function () {
                            fieldElement.removeClass('transition-horizontal');
                        }, 500);
                    }
                    fieldElement.on('keypress', function () {
                        change(fieldElement, fieldElementName);
                    });
                    fieldElement.on('change', function () {
                        change(fieldElement, fieldElementName);
                    });
                };

                $.ajax({
                    type: "post",
                    url: "/login",
                    cache: false,
                    datatype: "json",
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function success(data) {
                        if (!data.error) {
                            location.href = data.redirectPath;
                            console.log(data);
                        } else {
                            alert('error');
                        }
                    },
                    error: function error(_error4) {
                        var emailEl = $('#loginEmail');
                        var passwordEl = $('#loginPass');
                        errorHandler(emailEl, _error4.responseJSON.errors, _error4.responseJSON.errors.email, '#loginEmail');
                        errorHandler(passwordEl, _error4.responseJSON.errors, _error4.responseJSON.errors.password, '#loginPass');
                    }
                });
            });
        });
    });
})();

/**
 * Created by sahak on 1/7/2019.
 */
$(document).ready(function () {
    var modalHtml = '<div class="modal adult-modal" tabindex="-1" role="dialog">' + '<div class="modal-dialog modal-lg modal-dialog-centered" role="document">' + '<div class="modal-content rounded-0">' + '<div class="modal-body d-flex flex-column">' + '<h2 class="font-25 font-main-bold text-uppercase text-center mb-5">Are you of legal smoking age ?</h2>' + '<div class="d-flex justify-content-center">' + '<button type="button" class="btn ntfs-btn adult col-3 mr-4 rounded-0">Yes (18+)</button>' + '<button type="button" class="btn btn-transp not-adult col-3 rounded-0" data-dismiss="modal">No (under 18)</button>' + '</div>' + '<div class="mt-auto text-center">' + '<p class="text-uppercase mb-0 font-12"><i>The products of this website are intended for adults only.</i></p>' + '<p class="font-12"><i>By entering this website, you certify that you are of legel smoking age, in the district in which you reside.</i></p>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>';

    function getCookie(name) {
        var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function setCookie(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }

    if (!getCookie('adult')) {
        $('body').append(modalHtml);
        $('body').find('.adult-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
    }
    $('body').on('click', '.not-adult', function () {
        window.location = 'http://www.google.com';
    });
    $('body').on('click', '.adult', function () {
        setCookie('adult', 1, 3600 * 24 * 40);
        window.location.reload();
    });
});
