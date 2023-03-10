! function(e, t) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function(e) {
        if (!e.document) throw new Error("jQuery requires a window with a document");
        return t(e)
    } : t(e)
}("undefined" != typeof window ? window : this, function(C, e) {
    function t(e, t) {
        return t.toUpperCase()
    }
    var u = [],
        f = C.document,
        h = u.slice,
        m = u.concat,
        r = u.push,
        s = u.indexOf,
        i = {},
        n = i.toString,
        g = i.hasOwnProperty,
        v = {},
        o = "1.12.4",
        k = function(e, t) {
            return new k.fn.init(e, t)
        },
        a = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        l = /^-ms-/,
        c = /-([\da-z])/gi;

    function d(e) {
        var t = !!e && "length" in e && e.length,
            i = k.type(e);
        return "function" !== i && !k.isWindow(e) && ("array" === i || 0 === t || "number" == typeof t && 0 < t && t - 1 in e)
    }
    k.fn = k.prototype = {
        jquery: o,
        constructor: k,
        selector: "",
        length: 0,
        toArray: function() {
            return h.call(this)
        },
        get: function(e) {
            return null != e ? e < 0 ? this[e + this.length] : this[e] : h.call(this)
        },
        pushStack: function(e) {
            var t = k.merge(this.constructor(), e);
            return t.prevObject = this, t.context = this.context, t
        },
        each: function(e) {
            return k.each(this, e)
        },
        map: function(i) {
            return this.pushStack(k.map(this, function(e, t) {
                return i.call(e, t, e)
            }))
        },
        slice: function() {
            return this.pushStack(h.apply(this, arguments))
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq(-1)
        },
        eq: function(e) {
            var t = this.length,
                i = +e + (e < 0 ? t : 0);
            return this.pushStack(0 <= i && i < t ? [this[i]] : [])
        },
        end: function() {
            return this.prevObject || this.constructor()
        },
        push: r,
        sort: u.sort,
        splice: u.splice
    }, k.extend = k.fn.extend = function() {
        var e, t, i, n, s, o, a = arguments[0] || {},
            r = 1,
            l = arguments.length,
            c = !1;
        for ("boolean" == typeof a && (c = a, a = arguments[r] || {}, r++), "object" == typeof a || k.isFunction(a) || (a = {}), r === l && (a = this, r--); r < l; r++)
            if (null != (s = arguments[r]))
                for (n in s) e = a[n], a !== (i = s[n]) && (c && i && (k.isPlainObject(i) || (t = k.isArray(i))) ? (o = t ? (t = !1, e && k.isArray(e) ? e : []) : e && k.isPlainObject(e) ? e : {}, a[n] = k.extend(c, o, i)) : void 0 !== i && (a[n] = i));
        return a
    }, k.extend({
        expando: "jQuery" + (o + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(e) {
            throw new Error(e)
        },
        noop: function() {},
        isFunction: function(e) {
            return "function" === k.type(e)
        },
        isArray: Array.isArray || function(e) {
            return "array" === k.type(e)
        },
        isWindow: function(e) {
            return null != e && e == e.window
        },
        isNumeric: function(e) {
            var t = e && e.toString();
            return !k.isArray(e) && 0 <= t - parseFloat(t) + 1
        },
        isEmptyObject: function(e) {
            var t;
            for (t in e) return !1;
            return !0
        },
        isPlainObject: function(e) {
            var t;
            if (!e || "object" !== k.type(e) || e.nodeType || k.isWindow(e)) return !1;
            try {
                if (e.constructor && !g.call(e, "constructor") && !g.call(e.constructor.prototype, "isPrototypeOf")) return !1
            } catch (e) {
                return !1
            }
            if (!v.ownFirst)
                for (t in e) return g.call(e, t);
            for (t in e);
            return void 0 === t || g.call(e, t)
        },
        type: function(e) {
            return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? i[n.call(e)] || "object" : typeof e
        },
        globalEval: function(e) {
            e && k.trim(e) && (C.execScript || function(e) {
                C.eval.call(C, e)
            })(e)
        },
        camelCase: function(e) {
            return e.replace(l, "ms-").replace(c, t)
        },
        nodeName: function(e, t) {
            return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
        },
        each: function(e, t) {
            var i, n = 0;
            if (d(e))
                for (i = e.length; n < i && !1 !== t.call(e[n], n, e[n]); n++);
            else
                for (n in e)
                    if (!1 === t.call(e[n], n, e[n])) break; return e
        },
        trim: function(e) {
            return null == e ? "" : (e + "").replace(a, "")
        },
        makeArray: function(e, t) {
            var i = t || [];
            return null != e && (d(Object(e)) ? k.merge(i, "string" == typeof e ? [e] : e) : r.call(i, e)), i
        },
        inArray: function(e, t, i) {
            var n;
            if (t) {
                if (s) return s.call(t, e, i);
                for (n = t.length, i = i ? i < 0 ? Math.max(0, n + i) : i : 0; i < n; i++)
                    if (i in t && t[i] === e) return i
            }
            return -1
        },
        merge: function(e, t) {
            for (var i = +t.length, n = 0, s = e.length; n < i;) e[s++] = t[n++];
            if (i != i)
                for (; void 0 !== t[n];) e[s++] = t[n++];
            return e.length = s, e
        },
        grep: function(e, t, i) {
            for (var n = [], s = 0, o = e.length, a = !i; s < o; s++) !t(e[s], s) != a && n.push(e[s]);
            return n
        },
        map: function(e, t, i) {
            var n, s, o = 0,
                a = [];
            if (d(e))
                for (n = e.length; o < n; o++) null != (s = t(e[o], o, i)) && a.push(s);
            else
                for (o in e) null != (s = t(e[o], o, i)) && a.push(s);
            return m.apply([], a)
        },
        guid: 1,
        proxy: function(e, t) {
            var i, n, s;
            return "string" == typeof t && (s = e[t], t = e, e = s), k.isFunction(e) ? (i = h.call(arguments, 2), (n = function() {
                return e.apply(t || this, i.concat(h.call(arguments)))
            }).guid = e.guid = e.guid || k.guid++, n) : void 0
        },
        now: function() {
            return +new Date
        },
        support: v
    }), "function" == typeof Symbol && (k.fn[Symbol.iterator] = u[Symbol.iterator]), k.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function(e, t) {
        i["[object " + t + "]"] = t.toLowerCase()
    });
    var p = function(i) {
        function u(e, t, i) {
            var n = "0x" + t - 65536;
            return n != n || i ? t : n < 0 ? String.fromCharCode(65536 + n) : String.fromCharCode(n >> 10 | 55296, 1023 & n | 56320)
        }

        function s() {
            x()
        }
        var e, f, y, o, a, m, d, g, w, l, c, x, C, r, k, v, h, p, b, D = "sizzle" + 1 * new Date,
            _ = i.document,
            T = 0,
            n = 0,
            S = se(),
            I = se(),
            E = se(),
            A = function(e, t) {
                return e === t && (c = !0), 0
            },
            N = {}.hasOwnProperty,
            t = [],
            M = t.pop,
            O = t.push,
            P = t.push,
            H = t.slice,
            z = function(e, t) {
                for (var i = 0, n = e.length; i < n; i++)
                    if (e[i] === t) return i;
                return -1
            },
            L = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            $ = "[\\x20\\t\\r\\n\\f]",
            F = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
            W = "\\[" + $ + "*(" + F + ")(?:" + $ + "*([*^$|!~]?=)" + $ + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + F + "))|)" + $ + "*\\]",
            j = ":(" + F + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + W + ")*)|.*)\\)|)",
            R = new RegExp($ + "+", "g"),
            B = new RegExp("^" + $ + "+|((?:^|[^\\\\])(?:\\\\.)*)" + $ + "+$", "g"),
            q = new RegExp("^" + $ + "*," + $ + "*"),
            U = new RegExp("^" + $ + "*([>+~]|" + $ + ")" + $ + "*"),
            V = new RegExp("=" + $ + "*([^\\]'\"]*?)" + $ + "*\\]", "g"),
            Y = new RegExp(j),
            K = new RegExp("^" + F + "$"),
            G = {
                ID: new RegExp("^#(" + F + ")"),
                CLASS: new RegExp("^\\.(" + F + ")"),
                TAG: new RegExp("^(" + F + "|[*])"),
                ATTR: new RegExp("^" + W),
                PSEUDO: new RegExp("^" + j),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + $ + "*(even|odd|(([+-]|)(\\d*)n|)" + $ + "*(?:([+-]|)" + $ + "*(\\d+)|))" + $ + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + L + ")$", "i"),
                needsContext: new RegExp("^" + $ + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + $ + "*((?:-\\d)?\\d*)" + $ + "*\\)|)(?=[^-]|$)", "i")
            },
            X = /^(?:input|select|textarea|button)$/i,
            Q = /^h\d$/i,
            J = /^[^{]+\{\s*\[native \w/,
            Z = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            ee = /[+~]/,
            te = /'|\\/g,
            ie = new RegExp("\\\\([\\da-f]{1,6}" + $ + "?|(" + $ + ")|.)", "ig");
        try {
            P.apply(t = H.call(_.childNodes), _.childNodes), t[_.childNodes.length].nodeType
        } catch (e) {
            P = {
                apply: t.length ? function(e, t) {
                    O.apply(e, H.call(t))
                } : function(e, t) {
                    for (var i = e.length, n = 0; e[i++] = t[n++];);
                    e.length = i - 1
                }
            }
        }

        function ne(e, t, i, n) {
            var s, o, a, r, l, c, h, u, d = t && t.ownerDocument,
                p = t ? t.nodeType : 9;
            if (i = i || [], "string" != typeof e || !e || 1 !== p && 9 !== p && 11 !== p) return i;
            if (!n && ((t ? t.ownerDocument || t : _) !== C && x(t), t = t || C, k)) {
                if (11 !== p && (c = Z.exec(e)))
                    if (s = c[1]) {
                        if (9 === p) {
                            if (!(a = t.getElementById(s))) return i;
                            if (a.id === s) return i.push(a), i
                        } else if (d && (a = d.getElementById(s)) && b(t, a) && a.id === s) return i.push(a), i
                    } else {
                        if (c[2]) return P.apply(i, t.getElementsByTagName(e)), i;
                        if ((s = c[3]) && f.getElementsByClassName && t.getElementsByClassName) return P.apply(i, t.getElementsByClassName(s)), i
                    }
                if (f.qsa && !E[e + " "] && (!v || !v.test(e))) {
                    if (1 !== p) d = t, u = e;
                    else if ("object" !== t.nodeName.toLowerCase()) {
                        for ((r = t.getAttribute("id")) ? r = r.replace(te, "\\$&") : t.setAttribute("id", r = D), o = (h = m(e)).length, l = K.test(r) ? "#" + r : "[id='" + r + "']"; o--;) h[o] = l + " " + fe(h[o]);
                        u = h.join(","), d = ee.test(e) && de(t.parentNode) || t
                    }
                    if (u) try {
                        return P.apply(i, d.querySelectorAll(u)), i
                    } catch (e) {} finally {
                        r === D && t.removeAttribute("id")
                    }
                }
            }
            return g(e.replace(B, "$1"), t, i, n)
        }

        function se() {
            var n = [];
            return function e(t, i) {
                return n.push(t + " ") > y.cacheLength && delete e[n.shift()], e[t + " "] = i
            }
        }

        function oe(e) {
            return e[D] = !0, e
        }

        function ae(e) {
            var t = C.createElement("div");
            try {
                return !!e(t)
            } catch (e) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t), t = null
            }
        }

        function re(e, t) {
            for (var i = e.split("|"), n = i.length; n--;) y.attrHandle[i[n]] = t
        }

        function le(e, t) {
            var i = t && e,
                n = i && 1 === e.nodeType && 1 === t.nodeType && (~t.sourceIndex || 1 << 31) - (~e.sourceIndex || 1 << 31);
            if (n) return n;
            if (i)
                for (; i = i.nextSibling;)
                    if (i === t) return -1;
            return e ? 1 : -1
        }

        function ce(t) {
            return function(e) {
                return "input" === e.nodeName.toLowerCase() && e.type === t
            }
        }

        function he(i) {
            return function(e) {
                var t = e.nodeName.toLowerCase();
                return ("input" === t || "button" === t) && e.type === i
            }
        }

        function ue(a) {
            return oe(function(o) {
                return o = +o, oe(function(e, t) {
                    for (var i, n = a([], e.length, o), s = n.length; s--;) e[i = n[s]] && (e[i] = !(t[i] = e[i]))
                })
            })
        }

        function de(e) {
            return e && void 0 !== e.getElementsByTagName && e
        }
        for (e in f = ne.support = {}, a = ne.isXML = function(e) {
                var t = e && (e.ownerDocument || e).documentElement;
                return !!t && "HTML" !== t.nodeName
            }, x = ne.setDocument = function(e) {
                var t, i, n = e ? e.ownerDocument || e : _;
                return n !== C && 9 === n.nodeType && n.documentElement && (r = (C = n).documentElement, k = !a(C), (i = C.defaultView) && i.top !== i && (i.addEventListener ? i.addEventListener("unload", s, !1) : i.attachEvent && i.attachEvent("onunload", s)), f.attributes = ae(function(e) {
                    return e.className = "i", !e.getAttribute("className")
                }), f.getElementsByTagName = ae(function(e) {
                    return e.appendChild(C.createComment("")), !e.getElementsByTagName("*").length
                }), f.getElementsByClassName = J.test(C.getElementsByClassName), f.getById = ae(function(e) {
                    return r.appendChild(e).id = D, !C.getElementsByName || !C.getElementsByName(D).length
                }), f.getById ? (y.find.ID = function(e, t) {
                    if (void 0 !== t.getElementById && k) {
                        var i = t.getElementById(e);
                        return i ? [i] : []
                    }
                }, y.filter.ID = function(e) {
                    var t = e.replace(ie, u);
                    return function(e) {
                        return e.getAttribute("id") === t
                    }
                }) : (delete y.find.ID, y.filter.ID = function(e) {
                    var i = e.replace(ie, u);
                    return function(e) {
                        var t = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                        return t && t.value === i
                    }
                }), y.find.TAG = f.getElementsByTagName ? function(e, t) {
                    return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : f.qsa ? t.querySelectorAll(e) : void 0
                } : function(e, t) {
                    var i, n = [],
                        s = 0,
                        o = t.getElementsByTagName(e);
                    if ("*" !== e) return o;
                    for (; i = o[s++];) 1 === i.nodeType && n.push(i);
                    return n
                }, y.find.CLASS = f.getElementsByClassName && function(e, t) {
                    return void 0 !== t.getElementsByClassName && k ? t.getElementsByClassName(e) : void 0
                }, h = [], v = [], (f.qsa = J.test(C.querySelectorAll)) && (ae(function(e) {
                    r.appendChild(e).innerHTML = "<a id='" + D + "'></a><select id='" + D + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && v.push("[*^$]=" + $ + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || v.push("\\[" + $ + "*(?:value|" + L + ")"), e.querySelectorAll("[id~=" + D + "-]").length || v.push("~="), e.querySelectorAll(":checked").length || v.push(":checked"), e.querySelectorAll("a#" + D + "+*").length || v.push(".#.+[+~]")
                }), ae(function(e) {
                    var t = C.createElement("input");
                    t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && v.push("name" + $ + "*[*^$|!~]?="), e.querySelectorAll(":enabled").length || v.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), v.push(",.*:")
                })), (f.matchesSelector = J.test(p = r.matches || r.webkitMatchesSelector || r.mozMatchesSelector || r.oMatchesSelector || r.msMatchesSelector)) && ae(function(e) {
                    f.disconnectedMatch = p.call(e, "div"), p.call(e, "[s!='']:x"), h.push("!=", j)
                }), v = v.length && new RegExp(v.join("|")), h = h.length && new RegExp(h.join("|")), t = J.test(r.compareDocumentPosition), b = t || J.test(r.contains) ? function(e, t) {
                    var i = 9 === e.nodeType ? e.documentElement : e,
                        n = t && t.parentNode;
                    return e === n || !(!n || 1 !== n.nodeType || !(i.contains ? i.contains(n) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(n)))
                } : function(e, t) {
                    if (t)
                        for (; t = t.parentNode;)
                            if (t === e) return !0;
                    return !1
                }, A = t ? function(e, t) {
                    if (e === t) return c = !0, 0;
                    var i = !e.compareDocumentPosition - !t.compareDocumentPosition;
                    return i || (1 & (i = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1) || !f.sortDetached && t.compareDocumentPosition(e) === i ? e === C || e.ownerDocument === _ && b(_, e) ? -1 : t === C || t.ownerDocument === _ && b(_, t) ? 1 : l ? z(l, e) - z(l, t) : 0 : 4 & i ? -1 : 1)
                } : function(e, t) {
                    if (e === t) return c = !0, 0;
                    var i, n = 0,
                        s = e.parentNode,
                        o = t.parentNode,
                        a = [e],
                        r = [t];
                    if (!s || !o) return e === C ? -1 : t === C ? 1 : s ? -1 : o ? 1 : l ? z(l, e) - z(l, t) : 0;
                    if (s === o) return le(e, t);
                    for (i = e; i = i.parentNode;) a.unshift(i);
                    for (i = t; i = i.parentNode;) r.unshift(i);
                    for (; a[n] === r[n];) n++;
                    return n ? le(a[n], r[n]) : a[n] === _ ? -1 : r[n] === _ ? 1 : 0
                }), C
            }, ne.matches = function(e, t) {
                return ne(e, null, null, t)
            }, ne.matchesSelector = function(e, t) {
                if ((e.ownerDocument || e) !== C && x(e), t = t.replace(V, "='$1']"), f.matchesSelector && k && !E[t + " "] && (!h || !h.test(t)) && (!v || !v.test(t))) try {
                    var i = p.call(e, t);
                    if (i || f.disconnectedMatch || e.document && 11 !== e.document.nodeType) return i
                } catch (e) {}
                return 0 < ne(t, C, null, [e]).length
            }, ne.contains = function(e, t) {
                return (e.ownerDocument || e) !== C && x(e), b(e, t)
            }, ne.attr = function(e, t) {
                (e.ownerDocument || e) !== C && x(e);
                var i = y.attrHandle[t.toLowerCase()],
                    n = i && N.call(y.attrHandle, t.toLowerCase()) ? i(e, t, !k) : void 0;
                return void 0 !== n ? n : f.attributes || !k ? e.getAttribute(t) : (n = e.getAttributeNode(t)) && n.specified ? n.value : null
            }, ne.error = function(e) {
                throw new Error("Syntax error, unrecognized expression: " + e)
            }, ne.uniqueSort = function(e) {
                var t, i = [],
                    n = 0,
                    s = 0;
                if (c = !f.detectDuplicates, l = !f.sortStable && e.slice(0), e.sort(A), c) {
                    for (; t = e[s++];) t === e[s] && (n = i.push(s));
                    for (; n--;) e.splice(i[n], 1)
                }
                return l = null, e
            }, o = ne.getText = function(e) {
                var t, i = "",
                    n = 0,
                    s = e.nodeType;
                if (s) {
                    if (1 === s || 9 === s || 11 === s) {
                        if ("string" == typeof e.textContent) return e.textContent;
                        for (e = e.firstChild; e; e = e.nextSibling) i += o(e)
                    } else if (3 === s || 4 === s) return e.nodeValue
                } else
                    for (; t = e[n++];) i += o(t);
                return i
            }, (y = ne.selectors = {
                cacheLength: 50,
                createPseudo: oe,
                match: G,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: !0
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: !0
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function(e) {
                        return e[1] = e[1].replace(ie, u), e[3] = (e[3] || e[4] || e[5] || "").replace(ie, u), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                    },
                    CHILD: function(e) {
                        return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || ne.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && ne.error(e[0]), e
                    },
                    PSEUDO: function(e) {
                        var t, i = !e[6] && e[2];
                        return G.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : i && Y.test(i) && (t = m(i, !0)) && (t = i.indexOf(")", i.length - t) - i.length) && (e[0] = e[0].slice(0, t), e[2] = i.slice(0, t)), e.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function(e) {
                        var t = e.replace(ie, u).toLowerCase();
                        return "*" === e ? function() {
                            return !0
                        } : function(e) {
                            return e.nodeName && e.nodeName.toLowerCase() === t
                        }
                    },
                    CLASS: function(e) {
                        var t = S[e + " "];
                        return t || (t = new RegExp("(^|" + $ + ")" + e + "(" + $ + "|$)")) && S(e, function(e) {
                            return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "")
                        })
                    },
                    ATTR: function(i, n, s) {
                        return function(e) {
                            var t = ne.attr(e, i);
                            return null == t ? "!=" === n : !n || (t += "", "=" === n ? t === s : "!=" === n ? t !== s : "^=" === n ? s && 0 === t.indexOf(s) : "*=" === n ? s && -1 < t.indexOf(s) : "$=" === n ? s && t.slice(-s.length) === s : "~=" === n ? -1 < (" " + t.replace(R, " ") + " ").indexOf(s) : "|=" === n && (t === s || t.slice(0, s.length + 1) === s + "-"))
                        }
                    },
                    CHILD: function(f, e, t, m, g) {
                        var v = "nth" !== f.slice(0, 3),
                            b = "last" !== f.slice(-4),
                            _ = "of-type" === e;
                        return 1 === m && 0 === g ? function(e) {
                            return !!e.parentNode
                        } : function(e, t, i) {
                            var n, s, o, a, r, l, c = v != b ? "nextSibling" : "previousSibling",
                                h = e.parentNode,
                                u = _ && e.nodeName.toLowerCase(),
                                d = !i && !_,
                                p = !1;
                            if (h) {
                                if (v) {
                                    for (; c;) {
                                        for (a = e; a = a[c];)
                                            if (_ ? a.nodeName.toLowerCase() === u : 1 === a.nodeType) return !1;
                                        l = c = "only" === f && !l && "nextSibling"
                                    }
                                    return !0
                                }
                                if (l = [b ? h.firstChild : h.lastChild], b && d) {
                                    for (p = (r = (n = (s = (o = (a = h)[D] || (a[D] = {}))[a.uniqueID] || (o[a.uniqueID] = {}))[f] || [])[0] === T && n[1]) && n[2], a = r && h.childNodes[r]; a = ++r && a && a[c] || (p = r = 0) || l.pop();)
                                        if (1 === a.nodeType && ++p && a === e) {
                                            s[f] = [T, r, p];
                                            break
                                        }
                                } else if (d && (p = r = (n = (s = (o = (a = e)[D] || (a[D] = {}))[a.uniqueID] || (o[a.uniqueID] = {}))[f] || [])[0] === T && n[1]), !1 === p)
                                    for (;
                                        (a = ++r && a && a[c] || (p = r = 0) || l.pop()) && ((_ ? a.nodeName.toLowerCase() !== u : 1 !== a.nodeType) || !++p || (d && ((s = (o = a[D] || (a[D] = {}))[a.uniqueID] || (o[a.uniqueID] = {}))[f] = [T, p]), a !== e)););
                                return (p -= g) === m || p % m == 0 && 0 <= p / m
                            }
                        }
                    },
                    PSEUDO: function(e, o) {
                        var t, a = y.pseudos[e] || y.setFilters[e.toLowerCase()] || ne.error("unsupported pseudo: " + e);
                        return a[D] ? a(o) : 1 < a.length ? (t = [e, e, "", o], y.setFilters.hasOwnProperty(e.toLowerCase()) ? oe(function(e, t) {
                            for (var i, n = a(e, o), s = n.length; s--;) e[i = z(e, n[s])] = !(t[i] = n[s])
                        }) : function(e) {
                            return a(e, 0, t)
                        }) : a
                    }
                },
                pseudos: {
                    not: oe(function(e) {
                        var n = [],
                            s = [],
                            r = d(e.replace(B, "$1"));
                        return r[D] ? oe(function(e, t, i, n) {
                            for (var s, o = r(e, null, n, []), a = e.length; a--;)(s = o[a]) && (e[a] = !(t[a] = s))
                        }) : function(e, t, i) {
                            return n[0] = e, r(n, null, i, s), n[0] = null, !s.pop()
                        }
                    }),
                    has: oe(function(t) {
                        return function(e) {
                            return 0 < ne(t, e).length
                        }
                    }),
                    contains: oe(function(t) {
                        return t = t.replace(ie, u),
                            function(e) {
                                return -1 < (e.textContent || e.innerText || o(e)).indexOf(t)
                            }
                    }),
                    lang: oe(function(i) {
                        return K.test(i || "") || ne.error("unsupported lang: " + i), i = i.replace(ie, u).toLowerCase(),
                            function(e) {
                                var t;
                                do {
                                    if (t = k ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return (t = t.toLowerCase()) === i || 0 === t.indexOf(i + "-")
                                } while ((e = e.parentNode) && 1 === e.nodeType);
                                return !1
                            }
                    }),
                    target: function(e) {
                        var t = i.location && i.location.hash;
                        return t && t.slice(1) === e.id
                    },
                    root: function(e) {
                        return e === r
                    },
                    focus: function(e) {
                        return e === C.activeElement && (!C.hasFocus || C.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                    },
                    enabled: function(e) {
                        return !1 === e.disabled
                    },
                    disabled: function(e) {
                        return !0 === e.disabled
                    },
                    checked: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && !!e.checked || "option" === t && !!e.selected
                    },
                    selected: function(e) {
                        return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
                    },
                    empty: function(e) {
                        for (e = e.firstChild; e; e = e.nextSibling)
                            if (e.nodeType < 6) return !1;
                        return !0
                    },
                    parent: function(e) {
                        return !y.pseudos.empty(e)
                    },
                    header: function(e) {
                        return Q.test(e.nodeName)
                    },
                    input: function(e) {
                        return X.test(e.nodeName)
                    },
                    button: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && "button" === e.type || "button" === t
                    },
                    text: function(e) {
                        var t;
                        return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                    },
                    first: ue(function() {
                        return [0]
                    }),
                    last: ue(function(e, t) {
                        return [t - 1]
                    }),
                    eq: ue(function(e, t, i) {
                        return [i < 0 ? i + t : i]
                    }),
                    even: ue(function(e, t) {
                        for (var i = 0; i < t; i += 2) e.push(i);
                        return e
                    }),
                    odd: ue(function(e, t) {
                        for (var i = 1; i < t; i += 2) e.push(i);
                        return e
                    }),
                    lt: ue(function(e, t, i) {
                        for (var n = i < 0 ? i + t : i; 0 <= --n;) e.push(n);
                        return e
                    }),
                    gt: ue(function(e, t, i) {
                        for (var n = i < 0 ? i + t : i; ++n < t;) e.push(n);
                        return e
                    })
                }
            }).pseudos.nth = y.pseudos.eq, {
                radio: !0,
                checkbox: !0,
                file: !0,
                password: !0,
                image: !0
            }) y.pseudos[e] = ce(e);
        for (e in {
                submit: !0,
                reset: !0
            }) y.pseudos[e] = he(e);

        function pe() {}

        function fe(e) {
            for (var t = 0, i = e.length, n = ""; t < i; t++) n += e[t].value;
            return n
        }

        function me(r, e, t) {
            var l = e.dir,
                c = t && "parentNode" === l,
                h = n++;
            return e.first ? function(e, t, i) {
                for (; e = e[l];)
                    if (1 === e.nodeType || c) return r(e, t, i)
            } : function(e, t, i) {
                var n, s, o, a = [T, h];
                if (i) {
                    for (; e = e[l];)
                        if ((1 === e.nodeType || c) && r(e, t, i)) return !0
                } else
                    for (; e = e[l];)
                        if (1 === e.nodeType || c) {
                            if ((n = (s = (o = e[D] || (e[D] = {}))[e.uniqueID] || (o[e.uniqueID] = {}))[l]) && n[0] === T && n[1] === h) return a[2] = n[2];
                            if ((s[l] = a)[2] = r(e, t, i)) return !0
                        }
            }
        }

        function ge(s) {
            return 1 < s.length ? function(e, t, i) {
                for (var n = s.length; n--;)
                    if (!s[n](e, t, i)) return !1;
                return !0
            } : s[0]
        }

        function ve(e, t, i, n, s) {
            for (var o, a = [], r = 0, l = e.length, c = null != t; r < l; r++)(o = e[r]) && (i && !i(o, n, s) || (a.push(o), c && t.push(r)));
            return a
        }

        function be(p, f, m, g, v, e) {
            return g && !g[D] && (g = be(g)), v && !v[D] && (v = be(v, e)), oe(function(e, t, i, n) {
                var s, o, a, r = [],
                    l = [],
                    c = t.length,
                    h = e || function(e, t, i) {
                        for (var n = 0, s = t.length; n < s; n++) ne(e, t[n], i);
                        return i
                    }(f || "*", i.nodeType ? [i] : i, []),
                    u = !p || !e && f ? h : ve(h, r, p, i, n),
                    d = m ? v || (e ? p : c || g) ? [] : t : u;
                if (m && m(u, d, i, n), g)
                    for (s = ve(d, l), g(s, [], i, n), o = s.length; o--;)(a = s[o]) && (d[l[o]] = !(u[l[o]] = a));
                if (e) {
                    if (v || p) {
                        if (v) {
                            for (s = [], o = d.length; o--;)(a = d[o]) && s.push(u[o] = a);
                            v(null, d = [], s, n)
                        }
                        for (o = d.length; o--;)(a = d[o]) && -1 < (s = v ? z(e, a) : r[o]) && (e[s] = !(t[s] = a))
                    }
                } else d = ve(d === t ? d.splice(c, d.length) : d), v ? v(null, t, d, n) : P.apply(t, d)
            })
        }

        function _e(e) {
            for (var s, t, i, n = e.length, o = y.relative[e[0].type], a = o || y.relative[" "], r = o ? 1 : 0, l = me(function(e) {
                    return e === s
                }, a, !0), c = me(function(e) {
                    return -1 < z(s, e)
                }, a, !0), h = [function(e, t, i) {
                    var n = !o && (i || t !== w) || ((s = t).nodeType ? l(e, t, i) : c(e, t, i));
                    return s = null, n
                }]; r < n; r++)
                if (t = y.relative[e[r].type]) h = [me(ge(h), t)];
                else {
                    if ((t = y.filter[e[r].type].apply(null, e[r].matches))[D]) {
                        for (i = ++r; i < n && !y.relative[e[i].type]; i++);
                        return be(1 < r && ge(h), 1 < r && fe(e.slice(0, r - 1).concat({
                            value: " " === e[r - 2].type ? "*" : ""
                        })).replace(B, "$1"), t, r < i && _e(e.slice(r, i)), i < n && _e(e = e.slice(i)), i < n && fe(e))
                    }
                    h.push(t)
                }
            return ge(h)
        }
        return pe.prototype = y.filters = y.pseudos, y.setFilters = new pe, m = ne.tokenize = function(e, t) {
            var i, n, s, o, a, r, l, c = I[e + " "];
            if (c) return t ? 0 : c.slice(0);
            for (a = e, r = [], l = y.preFilter; a;) {
                for (o in i && !(n = q.exec(a)) || (n && (a = a.slice(n[0].length) || a), r.push(s = [])), i = !1, (n = U.exec(a)) && (i = n.shift(), s.push({
                        value: i,
                        type: n[0].replace(B, " ")
                    }), a = a.slice(i.length)), y.filter) !(n = G[o].exec(a)) || l[o] && !(n = l[o](n)) || (i = n.shift(), s.push({
                    value: i,
                    type: o,
                    matches: n
                }), a = a.slice(i.length));
                if (!i) break
            }
            return t ? a.length : a ? ne.error(e) : I(e, r).slice(0)
        }, d = ne.compile = function(e, t) {
            var i, g, v, b, _, n = [],
                s = [],
                o = E[e + " "];
            if (!o) {
                for (i = (t = t || m(e)).length; i--;)(o = _e(t[i]))[D] ? n.push(o) : s.push(o);
                (o = E(e, (g = s, b = 0 < (v = n).length, _ = 0 < g.length, b ? oe(a) : a))).selector = e
            }

            function a(e, t, i, n, s) {
                var o, a, r, l = 0,
                    c = "0",
                    h = e && [],
                    u = [],
                    d = w,
                    p = e || _ && y.find.TAG("*", s),
                    f = T += null == d ? 1 : Math.random() || .1,
                    m = p.length;
                for (s && (w = t === C || t || s); c !== m && null != (o = p[c]); c++) {
                    if (_ && o) {
                        for (a = 0, t || o.ownerDocument === C || (x(o), i = !k); r = g[a++];)
                            if (r(o, t || C, i)) {
                                n.push(o);
                                break
                            }
                        s && (T = f)
                    }
                    b && ((o = !r && o) && l--, e && h.push(o))
                }
                if (l += c, b && c !== l) {
                    for (a = 0; r = v[a++];) r(h, u, t, i);
                    if (e) {
                        if (0 < l)
                            for (; c--;) h[c] || u[c] || (u[c] = M.call(n));
                        u = ve(u)
                    }
                    P.apply(n, u), s && !e && 0 < u.length && 1 < l + v.length && ne.uniqueSort(n)
                }
                return s && (T = f, w = d), h
            }
            return o
        }, g = ne.select = function(e, t, i, n) {
            var s, o, a, r, l, c = "function" == typeof e && e,
                h = !n && m(e = c.selector || e);
            if (i = i || [], 1 === h.length) {
                if (2 < (o = h[0] = h[0].slice(0)).length && "ID" === (a = o[0]).type && f.getById && 9 === t.nodeType && k && y.relative[o[1].type]) {
                    if (!(t = (y.find.ID(a.matches[0].replace(ie, u), t) || [])[0])) return i;
                    c && (t = t.parentNode), e = e.slice(o.shift().value.length)
                }
                for (s = G.needsContext.test(e) ? 0 : o.length; s-- && (a = o[s], !y.relative[r = a.type]);)
                    if ((l = y.find[r]) && (n = l(a.matches[0].replace(ie, u), ee.test(o[0].type) && de(t.parentNode) || t))) {
                        if (o.splice(s, 1), !(e = n.length && fe(o))) return P.apply(i, n), i;
                        break
                    }
            }
            return (c || d(e, h))(n, t, !k, i, !t || ee.test(e) && de(t.parentNode) || t), i
        }, f.sortStable = D.split("").sort(A).join("") === D, f.detectDuplicates = !!c, x(), f.sortDetached = ae(function(e) {
            return 1 & e.compareDocumentPosition(C.createElement("div"))
        }), ae(function(e) {
            return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
        }) || re("type|href|height|width", function(e, t, i) {
            return i ? void 0 : e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
        }), f.attributes && ae(function(e) {
            return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
        }) || re("value", function(e, t, i) {
            return i || "input" !== e.nodeName.toLowerCase() ? void 0 : e.defaultValue
        }), ae(function(e) {
            return null == e.getAttribute("disabled")
        }) || re(L, function(e, t, i) {
            var n;
            return i ? void 0 : !0 === e[t] ? t.toLowerCase() : (n = e.getAttributeNode(t)) && n.specified ? n.value : null
        }), ne
    }(C);

    function b(e, t, i) {
        for (var n = [], s = void 0 !== i;
            (e = e[t]) && 9 !== e.nodeType;)
            if (1 === e.nodeType) {
                if (s && k(e).is(i)) break;
                n.push(e)
            }
        return n
    }

    function _(e, t) {
        for (var i = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && i.push(e);
        return i
    }
    k.find = p, k.expr = p.selectors, k.expr[":"] = k.expr.pseudos, k.uniqueSort = k.unique = p.uniqueSort, k.text = p.getText, k.isXMLDoc = p.isXML, k.contains = p.contains;
    var y = k.expr.match.needsContext,
        w = /^<([\w-]+)\s*\/?>(?:<\/\1>|)$/,
        x = /^.[^:#\[\.,]*$/;

    function D(e, i, n) {
        if (k.isFunction(i)) return k.grep(e, function(e, t) {
            return !!i.call(e, t, e) !== n
        });
        if (i.nodeType) return k.grep(e, function(e) {
            return e === i !== n
        });
        if ("string" == typeof i) {
            if (x.test(i)) return k.filter(i, e, n);
            i = k.filter(i, e)
        }
        return k.grep(e, function(e) {
            return -1 < k.inArray(e, i) !== n
        })
    }
    k.filter = function(e, t, i) {
        var n = t[0];
        return i && (e = ":not(" + e + ")"), 1 === t.length && 1 === n.nodeType ? k.find.matchesSelector(n, e) ? [n] : [] : k.find.matches(e, k.grep(t, function(e) {
            return 1 === e.nodeType
        }))
    }, k.fn.extend({
        find: function(e) {
            var t, i = [],
                n = this,
                s = n.length;
            if ("string" != typeof e) return this.pushStack(k(e).filter(function() {
                for (t = 0; t < s; t++)
                    if (k.contains(n[t], this)) return !0
            }));
            for (t = 0; t < s; t++) k.find(e, n[t], i);
            return (i = this.pushStack(1 < s ? k.unique(i) : i)).selector = this.selector ? this.selector + " " + e : e, i
        },
        filter: function(e) {
            return this.pushStack(D(this, e || [], !1))
        },
        not: function(e) {
            return this.pushStack(D(this, e || [], !0))
        },
        is: function(e) {
            return !!D(this, "string" == typeof e && y.test(e) ? k(e) : e || [], !1).length
        }
    });
    var T, S = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/;
    (k.fn.init = function(e, t, i) {
        var n, s;
        if (!e) return this;
        if (i = i || T, "string" != typeof e) return e.nodeType ? (this.context = this[0] = e, this.length = 1, this) : k.isFunction(e) ? void 0 !== i.ready ? i.ready(e) : e(k) : (void 0 !== e.selector && (this.selector = e.selector, this.context = e.context), k.makeArray(e, this));
        if (!(n = "<" === e.charAt(0) && ">" === e.charAt(e.length - 1) && 3 <= e.length ? [null, e, null] : S.exec(e)) || !n[1] && t) return !t || t.jquery ? (t || i).find(e) : this.constructor(t).find(e);
        if (n[1]) {
            if (t = t instanceof k ? t[0] : t, k.merge(this, k.parseHTML(n[1], t && t.nodeType ? t.ownerDocument || t : f, !0)), w.test(n[1]) && k.isPlainObject(t))
                for (n in t) k.isFunction(this[n]) ? this[n](t[n]) : this.attr(n, t[n]);
            return this
        }
        if ((s = f.getElementById(n[2])) && s.parentNode) {
            if (s.id !== n[2]) return T.find(e);
            this.length = 1, this[0] = s
        }
        return this.context = f, this.selector = e, this
    }).prototype = k.fn, T = k(f);
    var I = /^(?:parents|prev(?:Until|All))/,
        E = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };

    function A(e, t) {
        for (;
            (e = e[t]) && 1 !== e.nodeType;);
        return e
    }
    k.fn.extend({
        has: function(e) {
            var t, i = k(e, this),
                n = i.length;
            return this.filter(function() {
                for (t = 0; t < n; t++)
                    if (k.contains(this, i[t])) return !0
            })
        },
        closest: function(e, t) {
            for (var i, n = 0, s = this.length, o = [], a = y.test(e) || "string" != typeof e ? k(e, t || this.context) : 0; n < s; n++)
                for (i = this[n]; i && i !== t; i = i.parentNode)
                    if (i.nodeType < 11 && (a ? -1 < a.index(i) : 1 === i.nodeType && k.find.matchesSelector(i, e))) {
                        o.push(i);
                        break
                    }
            return this.pushStack(1 < o.length ? k.uniqueSort(o) : o)
        },
        index: function(e) {
            return e ? "string" == typeof e ? k.inArray(this[0], k(e)) : k.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function(e, t) {
            return this.pushStack(k.uniqueSort(k.merge(this.get(), k(e, t))))
        },
        addBack: function(e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    }), k.each({
        parent: function(e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        },
        parents: function(e) {
            return b(e, "parentNode")
        },
        parentsUntil: function(e, t, i) {
            return b(e, "parentNode", i)
        },
        next: function(e) {
            return A(e, "nextSibling")
        },
        prev: function(e) {
            return A(e, "previousSibling")
        },
        nextAll: function(e) {
            return b(e, "nextSibling")
        },
        prevAll: function(e) {
            return b(e, "previousSibling")
        },
        nextUntil: function(e, t, i) {
            return b(e, "nextSibling", i)
        },
        prevUntil: function(e, t, i) {
            return b(e, "previousSibling", i)
        },
        siblings: function(e) {
            return _((e.parentNode || {}).firstChild, e)
        },
        children: function(e) {
            return _(e.firstChild)
        },
        contents: function(e) {
            return k.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : k.merge([], e.childNodes)
        }
    }, function(n, s) {
        k.fn[n] = function(e, t) {
            var i = k.map(this, s, e);
            return "Until" !== n.slice(-5) && (t = e), t && "string" == typeof t && (i = k.filter(t, i)), 1 < this.length && (E[n] || (i = k.uniqueSort(i)), I.test(n) && (i = i.reverse())), this.pushStack(i)
        }
    });
    var N, M, O = /\S+/g;

    function P() {
        f.addEventListener ? (f.removeEventListener("DOMContentLoaded", H), C.removeEventListener("load", H)) : (f.detachEvent("onreadystatechange", H), C.detachEvent("onload", H))
    }

    function H() {
        !f.addEventListener && "load" !== C.event.type && "complete" !== f.readyState || (P(), k.ready())
    }
    for (M in k.Callbacks = function(n) {
            var e, i;

            function s() {
                for (r = n.once, a = o = !0; c.length; h = -1)
                    for (t = c.shift(); ++h < l.length;) !1 === l[h].apply(t[0], t[1]) && n.stopOnFalse && (h = l.length, t = !1);
                n.memory || (t = !1), o = !1, r && (l = t ? [] : "")
            }
            n = "string" == typeof n ? (e = n, i = {}, k.each(e.match(O) || [], function(e, t) {
                i[t] = !0
            }), i) : k.extend({}, n);
            var o, t, a, r, l = [],
                c = [],
                h = -1,
                u = {
                    add: function() {
                        return l && (t && !o && (h = l.length - 1, c.push(t)), function i(e) {
                            k.each(e, function(e, t) {
                                k.isFunction(t) ? n.unique && u.has(t) || l.push(t) : t && t.length && "string" !== k.type(t) && i(t)
                            })
                        }(arguments), t && !o && s()), this
                    },
                    remove: function() {
                        return k.each(arguments, function(e, t) {
                            for (var i; - 1 < (i = k.inArray(t, l, i));) l.splice(i, 1), i <= h && h--
                        }), this
                    },
                    has: function(e) {
                        return e ? -1 < k.inArray(e, l) : 0 < l.length
                    },
                    empty: function() {
                        return l = l && [], this
                    },
                    disable: function() {
                        return r = c = [], l = t = "", this
                    },
                    disabled: function() {
                        return !l
                    },
                    lock: function() {
                        return r = !0, t || u.disable(), this
                    },
                    locked: function() {
                        return !!r
                    },
                    fireWith: function(e, t) {
                        return r || (t = [e, (t = t || []).slice ? t.slice() : t], c.push(t), o || s()), this
                    },
                    fire: function() {
                        return u.fireWith(this, arguments), this
                    },
                    fired: function() {
                        return !!a
                    }
                };
            return u
        }, k.extend({
            Deferred: function(e) {
                var o = [
                        ["resolve", "done", k.Callbacks("once memory"), "resolved"],
                        ["reject", "fail", k.Callbacks("once memory"), "rejected"],
                        ["notify", "progress", k.Callbacks("memory")]
                    ],
                    s = "pending",
                    a = {
                        state: function() {
                            return s
                        },
                        always: function() {
                            return r.done(arguments).fail(arguments), this
                        },
                        then: function() {
                            var s = arguments;
                            return k.Deferred(function(n) {
                                k.each(o, function(e, t) {
                                    var i = k.isFunction(s[e]) && s[e];
                                    r[t[1]](function() {
                                        var e = i && i.apply(this, arguments);
                                        e && k.isFunction(e.promise) ? e.promise().progress(n.notify).done(n.resolve).fail(n.reject) : n[t[0] + "With"](this === a ? n.promise() : this, i ? [e] : arguments)
                                    })
                                }), s = null
                            }).promise()
                        },
                        promise: function(e) {
                            return null != e ? k.extend(e, a) : a
                        }
                    },
                    r = {};
                return a.pipe = a.then, k.each(o, function(e, t) {
                    var i = t[2],
                        n = t[3];
                    a[t[1]] = i.add, n && i.add(function() {
                        s = n
                    }, o[1 ^ e][2].disable, o[2][2].lock), r[t[0]] = function() {
                        return r[t[0] + "With"](this === r ? a : this, arguments), this
                    }, r[t[0] + "With"] = i.fireWith
                }), a.promise(r), e && e.call(r, r), r
            },
            when: function(e) {
                function t(t, i, n) {
                    return function(e) {
                        i[t] = this, n[t] = 1 < arguments.length ? h.call(arguments) : e, n === s ? c.notifyWith(i, n) : --l || c.resolveWith(i, n)
                    }
                }
                var s, i, n, o = 0,
                    a = h.call(arguments),
                    r = a.length,
                    l = 1 !== r || e && k.isFunction(e.promise) ? r : 0,
                    c = 1 === l ? e : k.Deferred();
                if (1 < r)
                    for (s = new Array(r), i = new Array(r), n = new Array(r); o < r; o++) a[o] && k.isFunction(a[o].promise) ? a[o].promise().progress(t(o, i, s)).done(t(o, n, a)).fail(c.reject) : --l;
                return l || c.resolveWith(n, a), c.promise()
            }
        }), k.fn.ready = function(e) {
            return k.ready.promise().done(e), this
        }, k.extend({
            isReady: !1,
            readyWait: 1,
            holdReady: function(e) {
                e ? k.readyWait++ : k.ready(!0)
            },
            ready: function(e) {
                (!0 === e ? --k.readyWait : k.isReady) || (k.isReady = !0) !== e && 0 < --k.readyWait || (N.resolveWith(f, [k]), k.fn.triggerHandler && (k(f).triggerHandler("ready"), k(f).off("ready")))
            }
        }), k.ready.promise = function(e) {
            if (!N)
                if (N = k.Deferred(), "complete" === f.readyState || "loading" !== f.readyState && !f.documentElement.doScroll) C.setTimeout(k.ready);
                else if (f.addEventListener) f.addEventListener("DOMContentLoaded", H), C.addEventListener("load", H);
            else {
                f.attachEvent("onreadystatechange", H), C.attachEvent("onload", H);
                var i = !1;
                try {
                    i = null == C.frameElement && f.documentElement
                } catch (e) {}
                i && i.doScroll && ! function t() {
                    if (!k.isReady) {
                        try {
                            i.doScroll("left")
                        } catch (e) {
                            return C.setTimeout(t, 50)
                        }
                        P(), k.ready()
                    }
                }()
            }
            return N.promise(e)
        }, k.ready.promise(), k(v)) break;

    function z(e) {
        var t = k.noData[(e.nodeName + " ").toLowerCase()],
            i = +e.nodeType || 1;
        return (1 === i || 9 === i) && (!t || !0 !== t && e.getAttribute("classid") === t)
    }
    v.ownFirst = "0" === M, v.inlineBlockNeedsLayout = !1, k(function() {
            var e, t, i, n;
            (i = f.getElementsByTagName("body")[0]) && i.style && (t = f.createElement("div"), (n = f.createElement("div")).style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", i.appendChild(n).appendChild(t), void 0 !== t.style.zoom && (t.style.cssText = "display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1", v.inlineBlockNeedsLayout = e = 3 === t.offsetWidth, e && (i.style.zoom = 1)), i.removeChild(n))
        }),
        function() {
            var e = f.createElement("div");
            v.deleteExpando = !0;
            try {
                delete e.test
            } catch (e) {
                v.deleteExpando = !1
            }
            e = null
        }();
    var L, $ = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        F = /([A-Z])/g;

    function W(e, t, i) {
        if (void 0 === i && 1 === e.nodeType) {
            var n = "data-" + t.replace(F, "-$1").toLowerCase();
            if ("string" == typeof(i = e.getAttribute(n))) {
                try {
                    i = "true" === i || "false" !== i && ("null" === i ? null : +i + "" === i ? +i : $.test(i) ? k.parseJSON(i) : i)
                } catch (e) {}
                k.data(e, t, i)
            } else i = void 0
        }
        return i
    }

    function j(e) {
        var t;
        for (t in e)
            if (("data" !== t || !k.isEmptyObject(e[t])) && "toJSON" !== t) return !1;
        return !0
    }

    function R(e, t, i, n) {
        if (z(e)) {
            var s, o, a = k.expando,
                r = e.nodeType,
                l = r ? k.cache : e,
                c = r ? e[a] : e[a] && a;
            if (c && l[c] && (n || l[c].data) || void 0 !== i || "string" != typeof t) return l[c = c || (r ? e[a] = u.pop() || k.guid++ : a)] || (l[c] = r ? {} : {
                toJSON: k.noop
            }), "object" != typeof t && "function" != typeof t || (n ? l[c] = k.extend(l[c], t) : l[c].data = k.extend(l[c].data, t)), o = l[c], n || (o.data || (o.data = {}), o = o.data), void 0 !== i && (o[k.camelCase(t)] = i), "string" == typeof t ? null == (s = o[t]) && (s = o[k.camelCase(t)]) : s = o, s
        }
    }

    function B(e, t, i) {
        if (z(e)) {
            var n, s, o = e.nodeType,
                a = o ? k.cache : e,
                r = o ? e[k.expando] : k.expando;
            if (a[r]) {
                if (t && (n = i ? a[r] : a[r].data)) {
                    s = (t = k.isArray(t) ? t.concat(k.map(t, k.camelCase)) : t in n ? [t] : (t = k.camelCase(t)) in n ? [t] : t.split(" ")).length;
                    for (; s--;) delete n[t[s]];
                    if (i ? !j(n) : !k.isEmptyObject(n)) return
                }(i || (delete a[r].data, j(a[r]))) && (o ? k.cleanData([e], !0) : v.deleteExpando || a != a.window ? delete a[r] : a[r] = void 0)
            }
        }
    }

    function q(e, t) {
        return e = t || e, "none" === k.css(e, "display") || !k.contains(e.ownerDocument, e)
    }
    k.extend({
        cache: {},
        noData: {
            "applet ": !0,
            "embed ": !0,
            "object ": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        },
        hasData: function(e) {
            return !!(e = e.nodeType ? k.cache[e[k.expando]] : e[k.expando]) && !j(e)
        },
        data: function(e, t, i) {
            return R(e, t, i)
        },
        removeData: function(e, t) {
            return B(e, t)
        },
        _data: function(e, t, i) {
            return R(e, t, i, !0)
        },
        _removeData: function(e, t) {
            return B(e, t, !0)
        }
    }), k.fn.extend({
        data: function(e, t) {
            var i, n, s, o = this[0],
                a = o && o.attributes;
            if (void 0 !== e) return "object" == typeof e ? this.each(function() {
                k.data(this, e)
            }) : 1 < arguments.length ? this.each(function() {
                k.data(this, e, t)
            }) : o ? W(o, e, k.data(o, e)) : void 0;
            if (this.length && (s = k.data(o), 1 === o.nodeType && !k._data(o, "parsedAttrs"))) {
                for (i = a.length; i--;) a[i] && 0 === (n = a[i].name).indexOf("data-") && W(o, n = k.camelCase(n.slice(5)), s[n]);
                k._data(o, "parsedAttrs", !0)
            }
            return s
        },
        removeData: function(e) {
            return this.each(function() {
                k.removeData(this, e)
            })
        }
    }), k.extend({
        queue: function(e, t, i) {
            var n;
            return e ? (t = (t || "fx") + "queue", n = k._data(e, t), i && (!n || k.isArray(i) ? n = k._data(e, t, k.makeArray(i)) : n.push(i)), n || []) : void 0
        },
        dequeue: function(e, t) {
            t = t || "fx";
            var i = k.queue(e, t),
                n = i.length,
                s = i.shift(),
                o = k._queueHooks(e, t);
            "inprogress" === s && (s = i.shift(), n--), s && ("fx" === t && i.unshift("inprogress"), delete o.stop, s.call(e, function() {
                k.dequeue(e, t)
            }, o)), !n && o && o.empty.fire()
        },
        _queueHooks: function(e, t) {
            var i = t + "queueHooks";
            return k._data(e, i) || k._data(e, i, {
                empty: k.Callbacks("once memory").add(function() {
                    k._removeData(e, t + "queue"), k._removeData(e, i)
                })
            })
        }
    }), k.fn.extend({
        queue: function(t, i) {
            var e = 2;
            return "string" != typeof t && (i = t, t = "fx", e--), arguments.length < e ? k.queue(this[0], t) : void 0 === i ? this : this.each(function() {
                var e = k.queue(this, t, i);
                k._queueHooks(this, t), "fx" === t && "inprogress" !== e[0] && k.dequeue(this, t)
            })
        },
        dequeue: function(e) {
            return this.each(function() {
                k.dequeue(this, e)
            })
        },
        clearQueue: function(e) {
            return this.queue(e || "fx", [])
        },
        promise: function(e, t) {
            function i() {
                --s || o.resolveWith(a, [a])
            }
            var n, s = 1,
                o = k.Deferred(),
                a = this,
                r = this.length;
            for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; r--;)(n = k._data(a[r], e + "queueHooks")) && n.empty && (s++, n.empty.add(i));
            return i(), o.promise(t)
        }
    }), v.shrinkWrapBlocks = function() {
        return null != L ? L : (L = !1, (t = f.getElementsByTagName("body")[0]) && t.style ? (e = f.createElement("div"), (i = f.createElement("div")).style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", t.appendChild(i).appendChild(e), void 0 !== e.style.zoom && (e.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1", e.appendChild(f.createElement("div")).style.width = "5px", L = 3 !== e.offsetWidth), t.removeChild(i), L) : void 0);
        var e, t, i
    };
    var U = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        V = new RegExp("^(?:([+-])=|)(" + U + ")([a-z%]*)$", "i"),
        Y = ["Top", "Right", "Bottom", "Left"];

    function K(e, t, i, n) {
        var s, o = 1,
            a = 20,
            r = n ? function() {
                return n.cur()
            } : function() {
                return k.css(e, t, "")
            },
            l = r(),
            c = i && i[3] || (k.cssNumber[t] ? "" : "px"),
            h = (k.cssNumber[t] || "px" !== c && +l) && V.exec(k.css(e, t));
        if (h && h[3] !== c)
            for (c = c || h[3], i = i || [], h = +l || 1; h /= o = o || ".5", k.style(e, t, h + c), o !== (o = r() / l) && 1 !== o && --a;);
        return i && (h = +h || +l || 0, s = i[1] ? h + (i[1] + 1) * i[2] : +i[2], n && (n.unit = c, n.start = h, n.end = s)), s
    }
    var G, X, Q, J = function(e, t, i, n, s, o, a) {
            var r = 0,
                l = e.length,
                c = null == i;
            if ("object" === k.type(i))
                for (r in s = !0, i) J(e, t, r, i[r], !0, o, a);
            else if (void 0 !== n && (s = !0, k.isFunction(n) || (a = !0), c && (t = a ? (t.call(e, n), null) : (c = t, function(e, t, i) {
                    return c.call(k(e), i)
                })), t))
                for (; r < l; r++) t(e[r], i, a ? n : n.call(e[r], r, t(e[r], i)));
            return s ? e : c ? t.call(e) : l ? t(e[0], i) : o
        },
        Z = /^(?:checkbox|radio)$/i,
        ee = /<([\w:-]+)/,
        te = /^$|\/(?:java|ecma)script/i,
        ie = /^\s+/,
        ne = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|dialog|figcaption|figure|footer|header|hgroup|main|mark|meter|nav|output|picture|progress|section|summary|template|time|video";

    function se(e) {
        var t = ne.split("|"),
            i = e.createDocumentFragment();
        if (i.createElement)
            for (; t.length;) i.createElement(t.pop());
        return i
    }
    G = f.createElement("div"), X = f.createDocumentFragment(), Q = f.createElement("input"), G.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", v.leadingWhitespace = 3 === G.firstChild.nodeType, v.tbody = !G.getElementsByTagName("tbody").length, v.htmlSerialize = !!G.getElementsByTagName("link").length, v.html5Clone = "<:nav></:nav>" !== f.createElement("nav").cloneNode(!0).outerHTML, Q.type = "checkbox", Q.checked = !0, X.appendChild(Q), v.appendChecked = Q.checked, G.innerHTML = "<textarea>x</textarea>", v.noCloneChecked = !!G.cloneNode(!0).lastChild.defaultValue, X.appendChild(G), (Q = f.createElement("input")).setAttribute("type", "radio"), Q.setAttribute("checked", "checked"), Q.setAttribute("name", "t"), G.appendChild(Q), v.checkClone = G.cloneNode(!0).cloneNode(!0).lastChild.checked, v.noCloneEvent = !!G.addEventListener, G[k.expando] = 1, v.attributes = !G.getAttribute(k.expando);
    var oe = {
        option: [1, "<select multiple='multiple'>", "</select>"],
        legend: [1, "<fieldset>", "</fieldset>"],
        area: [1, "<map>", "</map>"],
        param: [1, "<object>", "</object>"],
        thead: [1, "<table>", "</table>"],
        tr: [2, "<table><tbody>", "</tbody></table>"],
        col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
        td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
        _default: v.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
    };

    function ae(e, t) {
        var i, n, s = 0,
            o = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : void 0;
        if (!o)
            for (o = [], i = e.childNodes || e; null != (n = i[s]); s++) !t || k.nodeName(n, t) ? o.push(n) : k.merge(o, ae(n, t));
        return void 0 === t || t && k.nodeName(e, t) ? k.merge([e], o) : o
    }

    function re(e, t) {
        for (var i, n = 0; null != (i = e[n]); n++) k._data(i, "globalEval", !t || k._data(t[n], "globalEval"))
    }
    oe.optgroup = oe.option, oe.tbody = oe.tfoot = oe.colgroup = oe.caption = oe.thead, oe.th = oe.td;
    var le = /<|&#?\w+;/,
        ce = /<tbody/i;

    function he(e) {
        Z.test(e.type) && (e.defaultChecked = e.checked)
    }

    function ue(e, t, i, n, s) {
        for (var o, a, r, l, c, h, u, d = e.length, p = se(t), f = [], m = 0; m < d; m++)
            if ((a = e[m]) || 0 === a)
                if ("object" === k.type(a)) k.merge(f, a.nodeType ? [a] : a);
                else if (le.test(a)) {
            for (l = l || p.appendChild(t.createElement("div")), c = (ee.exec(a) || ["", ""])[1].toLowerCase(), u = oe[c] || oe._default, l.innerHTML = u[1] + k.htmlPrefilter(a) + u[2], o = u[0]; o--;) l = l.lastChild;
            if (!v.leadingWhitespace && ie.test(a) && f.push(t.createTextNode(ie.exec(a)[0])), !v.tbody)
                for (o = (a = "table" !== c || ce.test(a) ? "<table>" !== u[1] || ce.test(a) ? 0 : l : l.firstChild) && a.childNodes.length; o--;) k.nodeName(h = a.childNodes[o], "tbody") && !h.childNodes.length && a.removeChild(h);
            for (k.merge(f, l.childNodes), l.textContent = ""; l.firstChild;) l.removeChild(l.firstChild);
            l = p.lastChild
        } else f.push(t.createTextNode(a));
        for (l && p.removeChild(l), v.appendChecked || k.grep(ae(f, "input"), he), m = 0; a = f[m++];)
            if (n && -1 < k.inArray(a, n)) s && s.push(a);
            else if (r = k.contains(a.ownerDocument, a), l = ae(p.appendChild(a), "script"), r && re(l), i)
            for (o = 0; a = l[o++];) te.test(a.type || "") && i.push(a);
        return l = null, p
    }! function() {
        var e, t, i = f.createElement("div");
        for (e in {
                submit: !0,
                change: !0,
                focusin: !0
            }) t = "on" + e, (v[e] = t in C) || (i.setAttribute(t, "t"), v[e] = !1 === i.attributes[t].expando);
        i = null
    }();
    var de = /^(?:input|select|textarea)$/i,
        pe = /^key/,
        fe = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
        me = /^(?:focusinfocus|focusoutblur)$/,
        ge = /^([^.]*)(?:\.(.+)|)/;

    function ve() {
        return !0
    }

    function be() {
        return !1
    }

    function _e() {
        try {
            return f.activeElement
        } catch (e) {}
    }

    function ye(e, t, i, n, s, o) {
        var a, r;
        if ("object" == typeof t) {
            for (r in "string" != typeof i && (n = n || i, i = void 0), t) ye(e, r, i, n, t[r], o);
            return e
        }
        if (null == n && null == s ? (s = i, n = i = void 0) : null == s && ("string" == typeof i ? (s = n, n = void 0) : (s = n, n = i, i = void 0)), !1 === s) s = be;
        else if (!s) return e;
        return 1 === o && (a = s, (s = function(e) {
            return k().off(e), a.apply(this, arguments)
        }).guid = a.guid || (a.guid = k.guid++)), e.each(function() {
            k.event.add(this, t, s, n, i)
        })
    }
    k.event = {
        global: {},
        add: function(e, t, i, n, s) {
            var o, a, r, l, c, h, u, d, p, f, m, g = k._data(e);
            if (g) {
                for (i.handler && (i = (l = i).handler, s = l.selector), i.guid || (i.guid = k.guid++), (a = g.events) || (a = g.events = {}), (h = g.handle) || ((h = g.handle = function(e) {
                        return void 0 === k || e && k.event.triggered === e.type ? void 0 : k.event.dispatch.apply(h.elem, arguments)
                    }).elem = e), r = (t = (t || "").match(O) || [""]).length; r--;) p = m = (o = ge.exec(t[r]) || [])[1], f = (o[2] || "").split(".").sort(), p && (c = k.event.special[p] || {}, p = (s ? c.delegateType : c.bindType) || p, c = k.event.special[p] || {}, u = k.extend({
                    type: p,
                    origType: m,
                    data: n,
                    handler: i,
                    guid: i.guid,
                    selector: s,
                    needsContext: s && k.expr.match.needsContext.test(s),
                    namespace: f.join(".")
                }, l), (d = a[p]) || ((d = a[p] = []).delegateCount = 0, c.setup && !1 !== c.setup.call(e, n, f, h) || (e.addEventListener ? e.addEventListener(p, h, !1) : e.attachEvent && e.attachEvent("on" + p, h))), c.add && (c.add.call(e, u), u.handler.guid || (u.handler.guid = i.guid)), s ? d.splice(d.delegateCount++, 0, u) : d.push(u), k.event.global[p] = !0);
                e = null
            }
        },
        remove: function(e, t, i, n, s) {
            var o, a, r, l, c, h, u, d, p, f, m, g = k.hasData(e) && k._data(e);
            if (g && (h = g.events)) {
                for (c = (t = (t || "").match(O) || [""]).length; c--;)
                    if (p = m = (r = ge.exec(t[c]) || [])[1], f = (r[2] || "").split(".").sort(), p) {
                        for (u = k.event.special[p] || {}, d = h[p = (n ? u.delegateType : u.bindType) || p] || [], r = r[2] && new RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)"), l = o = d.length; o--;) a = d[o], !s && m !== a.origType || i && i.guid !== a.guid || r && !r.test(a.namespace) || n && n !== a.selector && ("**" !== n || !a.selector) || (d.splice(o, 1), a.selector && d.delegateCount--, u.remove && u.remove.call(e, a));
                        l && !d.length && (u.teardown && !1 !== u.teardown.call(e, f, g.handle) || k.removeEvent(e, p, g.handle), delete h[p])
                    } else
                        for (p in h) k.event.remove(e, p + t[c], i, n, !0);
                k.isEmptyObject(h) && (delete g.handle, k._removeData(e, "events"))
            }
        },
        trigger: function(e, t, i, n) {
            var s, o, a, r, l, c, h, u = [i || f],
                d = g.call(e, "type") ? e.type : e,
                p = g.call(e, "namespace") ? e.namespace.split(".") : [];
            if (a = c = i = i || f, 3 !== i.nodeType && 8 !== i.nodeType && !me.test(d + k.event.triggered) && (-1 < d.indexOf(".") && (d = (p = d.split(".")).shift(), p.sort()), o = d.indexOf(":") < 0 && "on" + d, (e = e[k.expando] ? e : new k.Event(d, "object" == typeof e && e)).isTrigger = n ? 2 : 3, e.namespace = p.join("."), e.rnamespace = e.namespace ? new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = i), t = null == t ? [e] : k.makeArray(t, [e]), l = k.event.special[d] || {}, n || !l.trigger || !1 !== l.trigger.apply(i, t))) {
                if (!n && !l.noBubble && !k.isWindow(i)) {
                    for (r = l.delegateType || d, me.test(r + d) || (a = a.parentNode); a; a = a.parentNode) u.push(a), c = a;
                    c === (i.ownerDocument || f) && u.push(c.defaultView || c.parentWindow || C)
                }
                for (h = 0;
                    (a = u[h++]) && !e.isPropagationStopped();) e.type = 1 < h ? r : l.bindType || d, (s = (k._data(a, "events") || {})[e.type] && k._data(a, "handle")) && s.apply(a, t), (s = o && a[o]) && s.apply && z(a) && (e.result = s.apply(a, t), !1 === e.result && e.preventDefault());
                if (e.type = d, !n && !e.isDefaultPrevented() && (!l._default || !1 === l._default.apply(u.pop(), t)) && z(i) && o && i[d] && !k.isWindow(i)) {
                    (c = i[o]) && (i[o] = null), k.event.triggered = d;
                    try {
                        i[d]()
                    } catch (e) {}
                    k.event.triggered = void 0, c && (i[o] = c)
                }
                return e.result
            }
        },
        dispatch: function(e) {
            e = k.event.fix(e);
            var t, i, n, s, o, a = [],
                r = h.call(arguments),
                l = (k._data(this, "events") || {})[e.type] || [],
                c = k.event.special[e.type] || {};
            if ((r[0] = e).delegateTarget = this, !c.preDispatch || !1 !== c.preDispatch.call(this, e)) {
                for (a = k.event.handlers.call(this, e, l), t = 0;
                    (s = a[t++]) && !e.isPropagationStopped();)
                    for (e.currentTarget = s.elem, i = 0;
                        (o = s.handlers[i++]) && !e.isImmediatePropagationStopped();) e.rnamespace && !e.rnamespace.test(o.namespace) || (e.handleObj = o, e.data = o.data, void 0 !== (n = ((k.event.special[o.origType] || {}).handle || o.handler).apply(s.elem, r)) && !1 === (e.result = n) && (e.preventDefault(), e.stopPropagation()));
                return c.postDispatch && c.postDispatch.call(this, e), e.result
            }
        },
        handlers: function(e, t) {
            var i, n, s, o, a = [],
                r = t.delegateCount,
                l = e.target;
            if (r && l.nodeType && ("click" !== e.type || isNaN(e.button) || e.button < 1))
                for (; l != this; l = l.parentNode || this)
                    if (1 === l.nodeType && (!0 !== l.disabled || "click" !== e.type)) {
                        for (n = [], i = 0; i < r; i++) void 0 === n[s = (o = t[i]).selector + " "] && (n[s] = o.needsContext ? -1 < k(s, this).index(l) : k.find(s, this, null, [l]).length), n[s] && n.push(o);
                        n.length && a.push({
                            elem: l,
                            handlers: n
                        })
                    }
            return r < t.length && a.push({
                elem: this,
                handlers: t.slice(r)
            }), a
        },
        fix: function(e) {
            if (e[k.expando]) return e;
            var t, i, n, s = e.type,
                o = e,
                a = this.fixHooks[s];
            for (a || (this.fixHooks[s] = a = fe.test(s) ? this.mouseHooks : pe.test(s) ? this.keyHooks : {}), n = a.props ? this.props.concat(a.props) : this.props, e = new k.Event(o), t = n.length; t--;) e[i = n[t]] = o[i];
            return e.target || (e.target = o.srcElement || f), 3 === e.target.nodeType && (e.target = e.target.parentNode), e.metaKey = !!e.metaKey, a.filter ? a.filter(e, o) : e
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget detail eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "),
            filter: function(e, t) {
                return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode), e
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function(e, t) {
                var i, n, s, o = t.button,
                    a = t.fromElement;
                return null == e.pageX && null != t.clientX && (s = (n = e.target.ownerDocument || f).documentElement, i = n.body, e.pageX = t.clientX + (s && s.scrollLeft || i && i.scrollLeft || 0) - (s && s.clientLeft || i && i.clientLeft || 0), e.pageY = t.clientY + (s && s.scrollTop || i && i.scrollTop || 0) - (s && s.clientTop || i && i.clientTop || 0)), !e.relatedTarget && a && (e.relatedTarget = a === e.target ? t.toElement : a), e.which || void 0 === o || (e.which = 1 & o ? 1 : 2 & o ? 3 : 4 & o ? 2 : 0), e
            }
        },
        special: {
            load: {
                noBubble: !0
            },
            focus: {
                trigger: function() {
                    if (this !== _e() && this.focus) try {
                        return this.focus(), !1
                    } catch (e) {}
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function() {
                    return this === _e() && this.blur ? (this.blur(), !1) : void 0
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function() {
                    return k.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0
                },
                _default: function(e) {
                    return k.nodeName(e.target, "a")
                }
            },
            beforeunload: {
                postDispatch: function(e) {
                    void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                }
            }
        },
        simulate: function(e, t, i) {
            var n = k.extend(new k.Event, i, {
                type: e,
                isSimulated: !0
            });
            k.event.trigger(n, null, t), n.isDefaultPrevented() && i.preventDefault()
        }
    }, k.removeEvent = f.removeEventListener ? function(e, t, i) {
        e.removeEventListener && e.removeEventListener(t, i)
    } : function(e, t, i) {
        var n = "on" + t;
        e.detachEvent && (void 0 === e[n] && (e[n] = null), e.detachEvent(n, i))
    }, k.Event = function(e, t) {
        return this instanceof k.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? ve : be) : this.type = e, t && k.extend(this, t), this.timeStamp = e && e.timeStamp || k.now(), void(this[k.expando] = !0)) : new k.Event(e, t)
    }, k.Event.prototype = {
        constructor: k.Event,
        isDefaultPrevented: be,
        isPropagationStopped: be,
        isImmediatePropagationStopped: be,
        preventDefault: function() {
            var e = this.originalEvent;
            this.isDefaultPrevented = ve, e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
        },
        stopPropagation: function() {
            var e = this.originalEvent;
            this.isPropagationStopped = ve, e && !this.isSimulated && (e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0)
        },
        stopImmediatePropagation: function() {
            var e = this.originalEvent;
            this.isImmediatePropagationStopped = ve, e && e.stopImmediatePropagation && e.stopImmediatePropagation(), this.stopPropagation()
        }
    }, k.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function(e, s) {
        k.event.special[e] = {
            delegateType: s,
            bindType: s,
            handle: function(e) {
                var t, i = e.relatedTarget,
                    n = e.handleObj;
                return i && (i === this || k.contains(this, i)) || (e.type = n.origType, t = n.handler.apply(this, arguments), e.type = s), t
            }
        }
    }), v.submit || (k.event.special.submit = {
        setup: function() {
            return !k.nodeName(this, "form") && void k.event.add(this, "click._submit keypress._submit", function(e) {
                var t = e.target,
                    i = k.nodeName(t, "input") || k.nodeName(t, "button") ? k.prop(t, "form") : void 0;
                i && !k._data(i, "submit") && (k.event.add(i, "submit._submit", function(e) {
                    e._submitBubble = !0
                }), k._data(i, "submit", !0))
            })
        },
        postDispatch: function(e) {
            e._submitBubble && (delete e._submitBubble, this.parentNode && !e.isTrigger && k.event.simulate("submit", this.parentNode, e))
        },
        teardown: function() {
            return !k.nodeName(this, "form") && void k.event.remove(this, "._submit")
        }
    }), v.change || (k.event.special.change = {
        setup: function() {
            return de.test(this.nodeName) ? ("checkbox" !== this.type && "radio" !== this.type || (k.event.add(this, "propertychange._change", function(e) {
                "checked" === e.originalEvent.propertyName && (this._justChanged = !0)
            }), k.event.add(this, "click._change", function(e) {
                this._justChanged && !e.isTrigger && (this._justChanged = !1), k.event.simulate("change", this, e)
            })), !1) : void k.event.add(this, "beforeactivate._change", function(e) {
                var t = e.target;
                de.test(t.nodeName) && !k._data(t, "change") && (k.event.add(t, "change._change", function(e) {
                    !this.parentNode || e.isSimulated || e.isTrigger || k.event.simulate("change", this.parentNode, e)
                }), k._data(t, "change", !0))
            })
        },
        handle: function(e) {
            var t = e.target;
            return this !== t || e.isSimulated || e.isTrigger || "radio" !== t.type && "checkbox" !== t.type ? e.handleObj.handler.apply(this, arguments) : void 0
        },
        teardown: function() {
            return k.event.remove(this, "._change"), !de.test(this.nodeName)
        }
    }), v.focusin || k.each({
        focus: "focusin",
        blur: "focusout"
    }, function(i, n) {
        function s(e) {
            k.event.simulate(n, e.target, k.event.fix(e))
        }
        k.event.special[n] = {
            setup: function() {
                var e = this.ownerDocument || this,
                    t = k._data(e, n);
                t || e.addEventListener(i, s, !0), k._data(e, n, (t || 0) + 1)
            },
            teardown: function() {
                var e = this.ownerDocument || this,
                    t = k._data(e, n) - 1;
                t ? k._data(e, n, t) : (e.removeEventListener(i, s, !0), k._removeData(e, n))
            }
        }
    }), k.fn.extend({
        on: function(e, t, i, n) {
            return ye(this, e, t, i, n)
        },
        one: function(e, t, i, n) {
            return ye(this, e, t, i, n, 1)
        },
        off: function(e, t, i) {
            var n, s;
            if (e && e.preventDefault && e.handleObj) return n = e.handleObj, k(e.delegateTarget).off(n.namespace ? n.origType + "." + n.namespace : n.origType, n.selector, n.handler), this;
            if ("object" != typeof e) return !1 !== t && "function" != typeof t || (i = t, t = void 0), !1 === i && (i = be), this.each(function() {
                k.event.remove(this, e, i, t)
            });
            for (s in e) this.off(s, t, e[s]);
            return this
        },
        trigger: function(e, t) {
            return this.each(function() {
                k.event.trigger(e, t, this)
            })
        },
        triggerHandler: function(e, t) {
            var i = this[0];
            return i ? k.event.trigger(e, t, i, !0) : void 0
        }
    });
    var we = / jQuery\d+="(?:null|\d+)"/g,
        xe = new RegExp("<(?:" + ne + ")[\\s/>]", "i"),
        Ce = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:-]+)[^>]*)\/>/gi,
        ke = /<script|<style|<link/i,
        De = /checked\s*(?:[^=]|=\s*.checked.)/i,
        Te = /^true\/(.*)/,
        Se = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
        Ie = se(f).appendChild(f.createElement("div"));

    function Ee(e, t) {
        return k.nodeName(e, "table") && k.nodeName(11 !== t.nodeType ? t : t.firstChild, "tr") ? e.getElementsByTagName("tbody")[0] || e.appendChild(e.ownerDocument.createElement("tbody")) : e
    }

    function Ae(e) {
        return e.type = (null !== k.find.attr(e, "type")) + "/" + e.type, e
    }

    function Ne(e) {
        var t = Te.exec(e.type);
        return t ? e.type = t[1] : e.removeAttribute("type"), e
    }

    function Me(e, t) {
        if (1 === t.nodeType && k.hasData(e)) {
            var i, n, s, o = k._data(e),
                a = k._data(t, o),
                r = o.events;
            if (r)
                for (i in delete a.handle, a.events = {}, r)
                    for (n = 0, s = r[i].length; n < s; n++) k.event.add(t, i, r[i][n]);
            a.data && (a.data = k.extend({}, a.data))
        }
    }

    function Oe(e, t) {
        var i, n, s;
        if (1 === t.nodeType) {
            if (i = t.nodeName.toLowerCase(), !v.noCloneEvent && t[k.expando]) {
                for (n in (s = k._data(t)).events) k.removeEvent(t, n, s.handle);
                t.removeAttribute(k.expando)
            }
            "script" === i && t.text !== e.text ? (Ae(t).text = e.text, Ne(t)) : "object" === i ? (t.parentNode && (t.outerHTML = e.outerHTML), v.html5Clone && e.innerHTML && !k.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : "input" === i && Z.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : "option" === i ? t.defaultSelected = t.selected = e.defaultSelected : "input" !== i && "textarea" !== i || (t.defaultValue = e.defaultValue)
        }
    }

    function Pe(i, n, s, o) {
        n = m.apply([], n);
        var e, t, a, r, l, c, h = 0,
            u = i.length,
            d = u - 1,
            p = n[0],
            f = k.isFunction(p);
        if (f || 1 < u && "string" == typeof p && !v.checkClone && De.test(p)) return i.each(function(e) {
            var t = i.eq(e);
            f && (n[0] = p.call(this, e, t.html())), Pe(t, n, s, o)
        });
        if (u && (e = (c = ue(n, i[0].ownerDocument, !1, i, o)).firstChild, 1 === c.childNodes.length && (c = e), e || o)) {
            for (a = (r = k.map(ae(c, "script"), Ae)).length; h < u; h++) t = c, h !== d && (t = k.clone(t, !0, !0), a && k.merge(r, ae(t, "script"))), s.call(i[h], t, h);
            if (a)
                for (l = r[r.length - 1].ownerDocument, k.map(r, Ne), h = 0; h < a; h++) t = r[h], te.test(t.type || "") && !k._data(t, "globalEval") && k.contains(l, t) && (t.src ? k._evalUrl && k._evalUrl(t.src) : k.globalEval((t.text || t.textContent || t.innerHTML || "").replace(Se, "")));
            c = e = null
        }
        return i
    }

    function He(e, t, i) {
        for (var n, s = t ? k.filter(t, e) : e, o = 0; null != (n = s[o]); o++) i || 1 !== n.nodeType || k.cleanData(ae(n)), n.parentNode && (i && k.contains(n.ownerDocument, n) && re(ae(n, "script")), n.parentNode.removeChild(n));
        return e
    }
    k.extend({
        htmlPrefilter: function(e) {
            return e.replace(Ce, "<$1></$2>")
        },
        clone: function(e, t, i) {
            var n, s, o, a, r, l = k.contains(e.ownerDocument, e);
            if (v.html5Clone || k.isXMLDoc(e) || !xe.test("<" + e.nodeName + ">") ? o = e.cloneNode(!0) : (Ie.innerHTML = e.outerHTML, Ie.removeChild(o = Ie.firstChild)), !(v.noCloneEvent && v.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || k.isXMLDoc(e)))
                for (n = ae(o), r = ae(e), a = 0; null != (s = r[a]); ++a) n[a] && Oe(s, n[a]);
            if (t)
                if (i)
                    for (r = r || ae(e), n = n || ae(o), a = 0; null != (s = r[a]); a++) Me(s, n[a]);
                else Me(e, o);
            return 0 < (n = ae(o, "script")).length && re(n, !l && ae(e, "script")), n = r = s = null, o
        },
        cleanData: function(e, t) {
            for (var i, n, s, o, a = 0, r = k.expando, l = k.cache, c = v.attributes, h = k.event.special; null != (i = e[a]); a++)
                if ((t || z(i)) && (o = (s = i[r]) && l[s])) {
                    if (o.events)
                        for (n in o.events) h[n] ? k.event.remove(i, n) : k.removeEvent(i, n, o.handle);
                    l[s] && (delete l[s], c || void 0 === i.removeAttribute ? i[r] = void 0 : i.removeAttribute(r), u.push(s))
                }
        }
    }), k.fn.extend({
        domManip: Pe,
        detach: function(e) {
            return He(this, e, !0)
        },
        remove: function(e) {
            return He(this, e)
        },
        text: function(e) {
            return J(this, function(e) {
                return void 0 === e ? k.text(this) : this.empty().append((this[0] && this[0].ownerDocument || f).createTextNode(e))
            }, null, e, arguments.length)
        },
        append: function() {
            return Pe(this, arguments, function(e) {
                1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || Ee(this, e).appendChild(e)
            })
        },
        prepend: function() {
            return Pe(this, arguments, function(e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = Ee(this, e);
                    t.insertBefore(e, t.firstChild)
                }
            })
        },
        before: function() {
            return Pe(this, arguments, function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        },
        after: function() {
            return Pe(this, arguments, function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        },
        empty: function() {
            for (var e, t = 0; null != (e = this[t]); t++) {
                for (1 === e.nodeType && k.cleanData(ae(e, !1)); e.firstChild;) e.removeChild(e.firstChild);
                e.options && k.nodeName(e, "select") && (e.options.length = 0)
            }
            return this
        },
        clone: function(e, t) {
            return e = null != e && e, t = null == t ? e : t, this.map(function() {
                return k.clone(this, e, t)
            })
        },
        html: function(e) {
            return J(this, function(e) {
                var t = this[0] || {},
                    i = 0,
                    n = this.length;
                if (void 0 === e) return 1 === t.nodeType ? t.innerHTML.replace(we, "") : void 0;
                if ("string" == typeof e && !ke.test(e) && (v.htmlSerialize || !xe.test(e)) && (v.leadingWhitespace || !ie.test(e)) && !oe[(ee.exec(e) || ["", ""])[1].toLowerCase()]) {
                    e = k.htmlPrefilter(e);
                    try {
                        for (; i < n; i++) 1 === (t = this[i] || {}).nodeType && (k.cleanData(ae(t, !1)), t.innerHTML = e);
                        t = 0
                    } catch (e) {}
                }
                t && this.empty().append(e)
            }, null, e, arguments.length)
        },
        replaceWith: function() {
            var i = [];
            return Pe(this, arguments, function(e) {
                var t = this.parentNode;
                k.inArray(this, i) < 0 && (k.cleanData(ae(this)), t && t.replaceChild(e, this))
            }, i)
        }
    }), k.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(e, a) {
        k.fn[e] = function(e) {
            for (var t, i = 0, n = [], s = k(e), o = s.length - 1; i <= o; i++) t = i === o ? this : this.clone(!0), k(s[i])[a](t), r.apply(n, t.get());
            return this.pushStack(n)
        }
    });
    var ze, Le = {
        HTML: "block",
        BODY: "block"
    };

    function $e(e, t) {
        var i = k(t.createElement(e)).appendTo(t.body),
            n = k.css(i[0], "display");
        return i.detach(), n
    }

    function Fe(e) {
        var t = f,
            i = Le[e];
        return i || ("none" !== (i = $e(e, t)) && i || ((t = ((ze = (ze || k("<iframe frameborder='0' width='0' height='0'/>")).appendTo(t.documentElement))[0].contentWindow || ze[0].contentDocument).document).write(), t.close(), i = $e(e, t), ze.detach()), Le[e] = i), i
    }

    function We(e, t, i, n) {
        var s, o, a = {};
        for (o in t) a[o] = e.style[o], e.style[o] = t[o];
        for (o in s = i.apply(e, n || []), t) e.style[o] = a[o];
        return s
    }
    var je = /^margin/,
        Re = new RegExp("^(" + U + ")(?!px)[a-z%]+$", "i"),
        Be = f.documentElement;
    ! function() {
        var n, s, o, a, r, l, c = f.createElement("div"),
            h = f.createElement("div");
        if (h.style) {
            function e() {
                var e, t, i = f.documentElement;
                i.appendChild(c), h.style.cssText = "-webkit-box-sizing:border-box;box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%", n = o = l = !1, s = r = !0, C.getComputedStyle && (t = C.getComputedStyle(h), n = "1%" !== (t || {}).top, l = "2px" === (t || {}).marginLeft, o = "4px" === (t || {
                    width: "4px"
                }).width, h.style.marginRight = "50%", s = "4px" === (t || {
                    marginRight: "4px"
                }).marginRight, (e = h.appendChild(f.createElement("div"))).style.cssText = h.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", e.style.marginRight = e.style.width = "0", h.style.width = "1px", r = !parseFloat((C.getComputedStyle(e) || {}).marginRight), h.removeChild(e)), h.style.display = "none", (a = 0 === h.getClientRects().length) && (h.style.display = "", h.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", h.childNodes[0].style.borderCollapse = "separate", (e = h.getElementsByTagName("td"))[0].style.cssText = "margin:0;border:0;padding:0;display:none", (a = 0 === e[0].offsetHeight) && (e[0].style.display = "", e[1].style.display = "none", a = 0 === e[0].offsetHeight)), i.removeChild(c)
            }
            h.style.cssText = "float:left;opacity:.5", v.opacity = "0.5" === h.style.opacity, v.cssFloat = !!h.style.cssFloat, h.style.backgroundClip = "content-box", h.cloneNode(!0).style.backgroundClip = "", v.clearCloneStyle = "content-box" === h.style.backgroundClip, (c = f.createElement("div")).style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute", h.innerHTML = "", c.appendChild(h), v.boxSizing = "" === h.style.boxSizing || "" === h.style.MozBoxSizing || "" === h.style.WebkitBoxSizing, k.extend(v, {
                reliableHiddenOffsets: function() {
                    return null == n && e(), a
                },
                boxSizingReliable: function() {
                    return null == n && e(), o
                },
                pixelMarginRight: function() {
                    return null == n && e(), s
                },
                pixelPosition: function() {
                    return null == n && e(), n
                },
                reliableMarginRight: function() {
                    return null == n && e(), r
                },
                reliableMarginLeft: function() {
                    return null == n && e(), l
                }
            })
        }
    }();
    var qe, Ue, Ve = /^(top|right|bottom|left)$/;

    function Ye(e, t) {
        return {
            get: function() {
                return e() ? void delete this.get : (this.get = t).apply(this, arguments)
            }
        }
    }
    C.getComputedStyle ? (qe = function(e) {
        var t = e.ownerDocument.defaultView;
        return t && t.opener || (t = C), t.getComputedStyle(e)
    }, Ue = function(e, t, i) {
        var n, s, o, a, r = e.style;
        return "" !== (a = (i = i || qe(e)) ? i.getPropertyValue(t) || i[t] : void 0) && void 0 !== a || k.contains(e.ownerDocument, e) || (a = k.style(e, t)), i && !v.pixelMarginRight() && Re.test(a) && je.test(t) && (n = r.width, s = r.minWidth, o = r.maxWidth, r.minWidth = r.maxWidth = r.width = a, a = i.width, r.width = n, r.minWidth = s, r.maxWidth = o), void 0 === a ? a : a + ""
    }) : Be.currentStyle && (qe = function(e) {
        return e.currentStyle
    }, Ue = function(e, t, i) {
        var n, s, o, a, r = e.style;
        return null == (a = (i = i || qe(e)) ? i[t] : void 0) && r && r[t] && (a = r[t]), Re.test(a) && !Ve.test(t) && (n = r.left, (o = (s = e.runtimeStyle) && s.left) && (s.left = e.currentStyle.left), r.left = "fontSize" === t ? "1em" : a, a = r.pixelLeft + "px", r.left = n, o && (s.left = o)), void 0 === a ? a : a + "" || "auto"
    });
    var Ke = /alpha\([^)]*\)/i,
        Ge = /opacity\s*=\s*([^)]*)/i,
        Xe = /^(none|table(?!-c[ea]).+)/,
        Qe = new RegExp("^(" + U + ")(.*)$", "i"),
        Je = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        Ze = {
            letterSpacing: "0",
            fontWeight: "400"
        },
        et = ["Webkit", "O", "Moz", "ms"],
        tt = f.createElement("div").style;

    function it(e) {
        if (e in tt) return e;
        for (var t = e.charAt(0).toUpperCase() + e.slice(1), i = et.length; i--;)
            if ((e = et[i] + t) in tt) return e
    }

    function nt(e, t) {
        for (var i, n, s, o = [], a = 0, r = e.length; a < r; a++)(n = e[a]).style && (o[a] = k._data(n, "olddisplay"), i = n.style.display, t ? (o[a] || "none" !== i || (n.style.display = ""), "" === n.style.display && q(n) && (o[a] = k._data(n, "olddisplay", Fe(n.nodeName)))) : (s = q(n), (i && "none" !== i || !s) && k._data(n, "olddisplay", s ? i : k.css(n, "display"))));
        for (a = 0; a < r; a++)(n = e[a]).style && (t && "none" !== n.style.display && "" !== n.style.display || (n.style.display = t ? o[a] || "" : "none"));
        return e
    }

    function st(e, t, i) {
        var n = Qe.exec(t);
        return n ? Math.max(0, n[1] - (i || 0)) + (n[2] || "px") : t
    }

    function ot(e, t, i, n, s) {
        for (var o = i === (n ? "border" : "content") ? 4 : "width" === t ? 1 : 0, a = 0; o < 4; o += 2) "margin" === i && (a += k.css(e, i + Y[o], !0, s)), n ? ("content" === i && (a -= k.css(e, "padding" + Y[o], !0, s)), "margin" !== i && (a -= k.css(e, "border" + Y[o] + "Width", !0, s))) : (a += k.css(e, "padding" + Y[o], !0, s), "padding" !== i && (a += k.css(e, "border" + Y[o] + "Width", !0, s)));
        return a
    }

    function at(e, t, i) {
        var n = !0,
            s = "width" === t ? e.offsetWidth : e.offsetHeight,
            o = qe(e),
            a = v.boxSizing && "border-box" === k.css(e, "boxSizing", !1, o);
        if (s <= 0 || null == s) {
            if (((s = Ue(e, t, o)) < 0 || null == s) && (s = e.style[t]), Re.test(s)) return s;
            n = a && (v.boxSizingReliable() || s === e.style[t]), s = parseFloat(s) || 0
        }
        return s + ot(e, t, i || (a ? "border" : "content"), n, o) + "px"
    }

    function rt(e, t, i, n, s) {
        return new rt.prototype.init(e, t, i, n, s)
    }
    k.extend({
        cssHooks: {
            opacity: {
                get: function(e, t) {
                    if (t) {
                        var i = Ue(e, "opacity");
                        return "" === i ? "1" : i
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {
            float: v.cssFloat ? "cssFloat" : "styleFloat"
        },
        style: function(e, t, i, n) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var s, o, a, r = k.camelCase(t),
                    l = e.style;
                if (t = k.cssProps[r] || (k.cssProps[r] = it(r) || r), a = k.cssHooks[t] || k.cssHooks[r], void 0 === i) return a && "get" in a && void 0 !== (s = a.get(e, !1, n)) ? s : l[t];
                if ("string" == (o = typeof i) && (s = V.exec(i)) && s[1] && (i = K(e, t, s), o = "number"), null != i && i == i && ("number" === o && (i += s && s[3] || (k.cssNumber[r] ? "" : "px")), v.clearCloneStyle || "" !== i || 0 !== t.indexOf("background") || (l[t] = "inherit"), !(a && "set" in a && void 0 === (i = a.set(e, i, n))))) try {
                    l[t] = i
                } catch (e) {}
            }
        },
        css: function(e, t, i, n) {
            var s, o, a, r = k.camelCase(t);
            return t = k.cssProps[r] || (k.cssProps[r] = it(r) || r), (a = k.cssHooks[t] || k.cssHooks[r]) && "get" in a && (o = a.get(e, !0, i)), void 0 === o && (o = Ue(e, t, n)), "normal" === o && t in Ze && (o = Ze[t]), "" === i || i ? (s = parseFloat(o), !0 === i || isFinite(s) ? s || 0 : o) : o
        }
    }), k.each(["height", "width"], function(e, s) {
        k.cssHooks[s] = {
            get: function(e, t, i) {
                return t ? Xe.test(k.css(e, "display")) && 0 === e.offsetWidth ? We(e, Je, function() {
                    return at(e, s, i)
                }) : at(e, s, i) : void 0
            },
            set: function(e, t, i) {
                var n = i && qe(e);
                return st(0, t, i ? ot(e, s, i, v.boxSizing && "border-box" === k.css(e, "boxSizing", !1, n), n) : 0)
            }
        }
    }), v.opacity || (k.cssHooks.opacity = {
        get: function(e, t) {
            return Ge.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : t ? "1" : ""
        },
        set: function(e, t) {
            var i = e.style,
                n = e.currentStyle,
                s = k.isNumeric(t) ? "alpha(opacity=" + 100 * t + ")" : "",
                o = n && n.filter || i.filter || "";
            ((i.zoom = 1) <= t || "" === t) && "" === k.trim(o.replace(Ke, "")) && i.removeAttribute && (i.removeAttribute("filter"), "" === t || n && !n.filter) || (i.filter = Ke.test(o) ? o.replace(Ke, s) : o + " " + s)
        }
    }), k.cssHooks.marginRight = Ye(v.reliableMarginRight, function(e, t) {
        return t ? We(e, {
            display: "inline-block"
        }, Ue, [e, "marginRight"]) : void 0
    }), k.cssHooks.marginLeft = Ye(v.reliableMarginLeft, function(e, t) {
        return t ? (parseFloat(Ue(e, "marginLeft")) || (k.contains(e.ownerDocument, e) ? e.getBoundingClientRect().left - We(e, {
            marginLeft: 0
        }, function() {
            return e.getBoundingClientRect().left
        }) : 0)) + "px" : void 0
    }), k.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function(s, o) {
        k.cssHooks[s + o] = {
            expand: function(e) {
                for (var t = 0, i = {}, n = "string" == typeof e ? e.split(" ") : [e]; t < 4; t++) i[s + Y[t] + o] = n[t] || n[t - 2] || n[0];
                return i
            }
        }, je.test(s) || (k.cssHooks[s + o].set = st)
    }), k.fn.extend({
        css: function(e, t) {
            return J(this, function(e, t, i) {
                var n, s, o = {},
                    a = 0;
                if (k.isArray(t)) {
                    for (n = qe(e), s = t.length; a < s; a++) o[t[a]] = k.css(e, t[a], !1, n);
                    return o
                }
                return void 0 !== i ? k.style(e, t, i) : k.css(e, t)
            }, e, t, 1 < arguments.length)
        },
        show: function() {
            return nt(this, !0)
        },
        hide: function() {
            return nt(this)
        },
        toggle: function(e) {
            return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function() {
                q(this) ? k(this).show() : k(this).hide()
            })
        }
    }), ((k.Tween = rt).prototype = {
        constructor: rt,
        init: function(e, t, i, n, s, o) {
            this.elem = e, this.prop = i, this.easing = s || k.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = n, this.unit = o || (k.cssNumber[i] ? "" : "px")
        },
        cur: function() {
            var e = rt.propHooks[this.prop];
            return e && e.get ? e.get(this) : rt.propHooks._default.get(this)
        },
        run: function(e) {
            var t, i = rt.propHooks[this.prop];
            return this.options.duration ? this.pos = t = k.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), i && i.set ? i.set(this) : rt.propHooks._default.set(this), this
        }
    }).init.prototype = rt.prototype, (rt.propHooks = {
        _default: {
            get: function(e) {
                var t;
                return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = k.css(e.elem, e.prop, "")) && "auto" !== t ? t : 0
            },
            set: function(e) {
                k.fx.step[e.prop] ? k.fx.step[e.prop](e) : 1 !== e.elem.nodeType || null == e.elem.style[k.cssProps[e.prop]] && !k.cssHooks[e.prop] ? e.elem[e.prop] = e.now : k.style(e.elem, e.prop, e.now + e.unit)
            }
        }
    }).scrollTop = rt.propHooks.scrollLeft = {
        set: function(e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, k.easing = {
        linear: function(e) {
            return e
        },
        swing: function(e) {
            return .5 - Math.cos(e * Math.PI) / 2
        },
        _default: "swing"
    }, k.fx = rt.prototype.init, k.fx.step = {};
    var lt, ct, ht, ut, dt, pt, ft, mt = /^(?:toggle|show|hide)$/,
        gt = /queueHooks$/;

    function vt() {
        return C.setTimeout(function() {
            lt = void 0
        }), lt = k.now()
    }

    function bt(e, t) {
        var i, n = {
                height: e
            },
            s = 0;
        for (t = t ? 1 : 0; s < 4; s += 2 - t) n["margin" + (i = Y[s])] = n["padding" + i] = e;
        return t && (n.opacity = n.width = e), n
    }

    function _t(e, t, i) {
        for (var n, s = (yt.tweeners[t] || []).concat(yt.tweeners["*"]), o = 0, a = s.length; o < a; o++)
            if (n = s[o].call(i, t, e)) return n
    }

    function yt(o, e, t) {
        var i, a, n = 0,
            s = yt.prefilters.length,
            r = k.Deferred().always(function() {
                delete l.elem
            }),
            l = function() {
                if (a) return !1;
                for (var e = lt || vt(), t = Math.max(0, c.startTime + c.duration - e), i = 1 - (t / c.duration || 0), n = 0, s = c.tweens.length; n < s; n++) c.tweens[n].run(i);
                return r.notifyWith(o, [c, i, t]), i < 1 && s ? t : (r.resolveWith(o, [c]), !1)
            },
            c = r.promise({
                elem: o,
                props: k.extend({}, e),
                opts: k.extend(!0, {
                    specialEasing: {},
                    easing: k.easing._default
                }, t),
                originalProperties: e,
                originalOptions: t,
                startTime: lt || vt(),
                duration: t.duration,
                tweens: [],
                createTween: function(e, t) {
                    var i = k.Tween(o, c.opts, e, t, c.opts.specialEasing[e] || c.opts.easing);
                    return c.tweens.push(i), i
                },
                stop: function(e) {
                    var t = 0,
                        i = e ? c.tweens.length : 0;
                    if (a) return this;
                    for (a = !0; t < i; t++) c.tweens[t].run(1);
                    return e ? (r.notifyWith(o, [c, 1, 0]), r.resolveWith(o, [c, e])) : r.rejectWith(o, [c, e]), this
                }
            }),
            h = c.props;
        for (function(e, t) {
                var i, n, s, o, a;
                for (i in e)
                    if (s = t[n = k.camelCase(i)], o = e[i], k.isArray(o) && (s = o[1], o = e[i] = o[0]), i !== n && (e[n] = o, delete e[i]), (a = k.cssHooks[n]) && "expand" in a)
                        for (i in o = a.expand(o), delete e[n], o) i in e || (e[i] = o[i], t[i] = s);
                    else t[n] = s
            }(h, c.opts.specialEasing); n < s; n++)
            if (i = yt.prefilters[n].call(c, o, h, c.opts)) return k.isFunction(i.stop) && (k._queueHooks(c.elem, c.opts.queue).stop = k.proxy(i.stop, i)), i;
        return k.map(h, _t, c), k.isFunction(c.opts.start) && c.opts.start.call(o, c), k.fx.timer(k.extend(l, {
            elem: o,
            anim: c,
            queue: c.opts.queue
        })), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always)
    }
    k.Animation = k.extend(yt, {
        tweeners: {
            "*": [function(e, t) {
                var i = this.createTween(e, t);
                return K(i.elem, e, V.exec(t), i), i
            }]
        },
        tweener: function(e, t) {
            for (var i, n = 0, s = (e = k.isFunction(e) ? (t = e, ["*"]) : e.match(O)).length; n < s; n++) i = e[n], yt.tweeners[i] = yt.tweeners[i] || [], yt.tweeners[i].unshift(t)
        },
        prefilters: [function(t, e, i) {
            var n, s, o, a, r, l, c, h = this,
                u = {},
                d = t.style,
                p = t.nodeType && q(t),
                f = k._data(t, "fxshow");
            for (n in i.queue || (null == (r = k._queueHooks(t, "fx")).unqueued && (r.unqueued = 0, l = r.empty.fire, r.empty.fire = function() {
                    r.unqueued || l()
                }), r.unqueued++, h.always(function() {
                    h.always(function() {
                        r.unqueued--, k.queue(t, "fx").length || r.empty.fire()
                    })
                })), 1 === t.nodeType && ("height" in e || "width" in e) && (i.overflow = [d.overflow, d.overflowX, d.overflowY], "inline" === ("none" === (c = k.css(t, "display")) ? k._data(t, "olddisplay") || Fe(t.nodeName) : c) && "none" === k.css(t, "float") && (v.inlineBlockNeedsLayout && "inline" !== Fe(t.nodeName) ? d.zoom = 1 : d.display = "inline-block")), i.overflow && (d.overflow = "hidden", v.shrinkWrapBlocks() || h.always(function() {
                    d.overflow = i.overflow[0], d.overflowX = i.overflow[1], d.overflowY = i.overflow[2]
                })), e)
                if (s = e[n], mt.exec(s)) {
                    if (delete e[n], o = o || "toggle" === s, s === (p ? "hide" : "show")) {
                        if ("show" !== s || !f || void 0 === f[n]) continue;
                        p = !0
                    }
                    u[n] = f && f[n] || k.style(t, n)
                } else c = void 0;
            if (k.isEmptyObject(u)) "inline" === ("none" === c ? Fe(t.nodeName) : c) && (d.display = c);
            else
                for (n in f ? "hidden" in f && (p = f.hidden) : f = k._data(t, "fxshow", {}), o && (f.hidden = !p), p ? k(t).show() : h.done(function() {
                        k(t).hide()
                    }), h.done(function() {
                        var e;
                        for (e in k._removeData(t, "fxshow"), u) k.style(t, e, u[e])
                    }), u) a = _t(p ? f[n] : 0, n, h), n in f || (f[n] = a.start, p && (a.end = a.start, a.start = "width" === n || "height" === n ? 1 : 0))
        }],
        prefilter: function(e, t) {
            t ? yt.prefilters.unshift(e) : yt.prefilters.push(e)
        }
    }), k.speed = function(e, t, i) {
        var n = e && "object" == typeof e ? k.extend({}, e) : {
            complete: i || !i && t || k.isFunction(e) && e,
            duration: e,
            easing: i && t || t && !k.isFunction(t) && t
        };
        return n.duration = k.fx.off ? 0 : "number" == typeof n.duration ? n.duration : n.duration in k.fx.speeds ? k.fx.speeds[n.duration] : k.fx.speeds._default, null != n.queue && !0 !== n.queue || (n.queue = "fx"), n.old = n.complete, n.complete = function() {
            k.isFunction(n.old) && n.old.call(this), n.queue && k.dequeue(this, n.queue)
        }, n
    }, k.fn.extend({
        fadeTo: function(e, t, i, n) {
            return this.filter(q).css("opacity", 0).show().end().animate({
                opacity: t
            }, e, i, n)
        },
        animate: function(t, e, i, n) {
            function s() {
                var e = yt(this, k.extend({}, t), a);
                (o || k._data(this, "finish")) && e.stop(!0)
            }
            var o = k.isEmptyObject(t),
                a = k.speed(e, i, n);
            return s.finish = s, o || !1 === a.queue ? this.each(s) : this.queue(a.queue, s)
        },
        stop: function(s, e, o) {
            function a(e) {
                var t = e.stop;
                delete e.stop, t(o)
            }
            return "string" != typeof s && (o = e, e = s, s = void 0), e && !1 !== s && this.queue(s || "fx", []), this.each(function() {
                var e = !0,
                    t = null != s && s + "queueHooks",
                    i = k.timers,
                    n = k._data(this);
                if (t) n[t] && n[t].stop && a(n[t]);
                else
                    for (t in n) n[t] && n[t].stop && gt.test(t) && a(n[t]);
                for (t = i.length; t--;) i[t].elem !== this || null != s && i[t].queue !== s || (i[t].anim.stop(o), e = !1, i.splice(t, 1));
                !e && o || k.dequeue(this, s)
            })
        },
        finish: function(a) {
            return !1 !== a && (a = a || "fx"), this.each(function() {
                var e, t = k._data(this),
                    i = t[a + "queue"],
                    n = t[a + "queueHooks"],
                    s = k.timers,
                    o = i ? i.length : 0;
                for (t.finish = !0, k.queue(this, a, []), n && n.stop && n.stop.call(this, !0), e = s.length; e--;) s[e].elem === this && s[e].queue === a && (s[e].anim.stop(!0), s.splice(e, 1));
                for (e = 0; e < o; e++) i[e] && i[e].finish && i[e].finish.call(this);
                delete t.finish
            })
        }
    }), k.each(["toggle", "show", "hide"], function(e, n) {
        var s = k.fn[n];
        k.fn[n] = function(e, t, i) {
            return null == e || "boolean" == typeof e ? s.apply(this, arguments) : this.animate(bt(n, !0), e, t, i)
        }
    }), k.each({
        slideDown: bt("show"),
        slideUp: bt("hide"),
        slideToggle: bt("toggle"),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        },
        fadeToggle: {
            opacity: "toggle"
        }
    }, function(e, n) {
        k.fn[e] = function(e, t, i) {
            return this.animate(n, e, t, i)
        }
    }), k.timers = [], k.fx.tick = function() {
        var e, t = k.timers,
            i = 0;
        for (lt = k.now(); i < t.length; i++)(e = t[i])() || t[i] !== e || t.splice(i--, 1);
        t.length || k.fx.stop(), lt = void 0
    }, k.fx.timer = function(e) {
        k.timers.push(e), e() ? k.fx.start() : k.timers.pop()
    }, k.fx.interval = 13, k.fx.start = function() {
        ct = ct || C.setInterval(k.fx.tick, k.fx.interval)
    }, k.fx.stop = function() {
        C.clearInterval(ct), ct = null
    }, k.fx.speeds = {
        slow: 600,
        fast: 200,
        _default: 400
    }, k.fn.delay = function(n, e) {
        return n = k.fx && k.fx.speeds[n] || n, e = e || "fx", this.queue(e, function(e, t) {
            var i = C.setTimeout(e, n);
            t.stop = function() {
                C.clearTimeout(i)
            }
        })
    }, ut = f.createElement("input"), dt = f.createElement("div"), ft = (pt = f.createElement("select")).appendChild(f.createElement("option")), (dt = f.createElement("div")).setAttribute("className", "t"), dt.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", ht = dt.getElementsByTagName("a")[0], ut.setAttribute("type", "checkbox"), dt.appendChild(ut), (ht = dt.getElementsByTagName("a")[0]).style.cssText = "top:1px", v.getSetAttribute = "t" !== dt.className, v.style = /top/.test(ht.getAttribute("style")), v.hrefNormalized = "/a" === ht.getAttribute("href"), v.checkOn = !!ut.value, v.optSelected = ft.selected, v.enctype = !!f.createElement("form").enctype, pt.disabled = !0, v.optDisabled = !ft.disabled, (ut = f.createElement("input")).setAttribute("value", ""), v.input = "" === ut.getAttribute("value"), ut.value = "t", ut.setAttribute("type", "radio"), v.radioValue = "t" === ut.value;
    var wt = /\r/g,
        xt = /[\x20\t\r\n\f]+/g;
    k.fn.extend({
        val: function(i) {
            var n, e, s, t = this[0];
            return arguments.length ? (s = k.isFunction(i), this.each(function(e) {
                var t;
                1 === this.nodeType && (null == (t = s ? i.call(this, e, k(this).val()) : i) ? t = "" : "number" == typeof t ? t += "" : k.isArray(t) && (t = k.map(t, function(e) {
                    return null == e ? "" : e + ""
                })), (n = k.valHooks[this.type] || k.valHooks[this.nodeName.toLowerCase()]) && "set" in n && void 0 !== n.set(this, t, "value") || (this.value = t))
            })) : t ? (n = k.valHooks[t.type] || k.valHooks[t.nodeName.toLowerCase()]) && "get" in n && void 0 !== (e = n.get(t, "value")) ? e : "string" == typeof(e = t.value) ? e.replace(wt, "") : null == e ? "" : e : void 0
        }
    }), k.extend({
        valHooks: {
            option: {
                get: function(e) {
                    var t = k.find.attr(e, "value");
                    return null != t ? t : k.trim(k.text(e)).replace(xt, " ")
                }
            },
            select: {
                get: function(e) {
                    for (var t, i, n = e.options, s = e.selectedIndex, o = "select-one" === e.type || s < 0, a = o ? null : [], r = o ? s + 1 : n.length, l = s < 0 ? r : o ? s : 0; l < r; l++)
                        if (((i = n[l]).selected || l === s) && (v.optDisabled ? !i.disabled : null === i.getAttribute("disabled")) && (!i.parentNode.disabled || !k.nodeName(i.parentNode, "optgroup"))) {
                            if (t = k(i).val(), o) return t;
                            a.push(t)
                        }
                    return a
                },
                set: function(e, t) {
                    for (var i, n, s = e.options, o = k.makeArray(t), a = s.length; a--;)
                        if (n = s[a], -1 < k.inArray(k.valHooks.option.get(n), o)) try {
                            n.selected = i = !0
                        } catch (e) {
                            n.scrollHeight
                        } else n.selected = !1;
                    return i || (e.selectedIndex = -1), s
                }
            }
        }
    }), k.each(["radio", "checkbox"], function() {
        k.valHooks[this] = {
            set: function(e, t) {
                return k.isArray(t) ? e.checked = -1 < k.inArray(k(e).val(), t) : void 0
            }
        }, v.checkOn || (k.valHooks[this].get = function(e) {
            return null === e.getAttribute("value") ? "on" : e.value
        })
    });
    var Ct, kt, Dt = k.expr.attrHandle,
        Tt = /^(?:checked|selected)$/i,
        St = v.getSetAttribute,
        It = v.input;
    k.fn.extend({
        attr: function(e, t) {
            return J(this, k.attr, e, t, 1 < arguments.length)
        },
        removeAttr: function(e) {
            return this.each(function() {
                k.removeAttr(this, e)
            })
        }
    }), k.extend({
        attr: function(e, t, i) {
            var n, s, o = e.nodeType;
            if (3 !== o && 8 !== o && 2 !== o) return void 0 === e.getAttribute ? k.prop(e, t, i) : (1 === o && k.isXMLDoc(e) || (t = t.toLowerCase(), s = k.attrHooks[t] || (k.expr.match.bool.test(t) ? kt : Ct)), void 0 !== i ? null === i ? void k.removeAttr(e, t) : s && "set" in s && void 0 !== (n = s.set(e, i, t)) ? n : (e.setAttribute(t, i + ""), i) : s && "get" in s && null !== (n = s.get(e, t)) ? n : null == (n = k.find.attr(e, t)) ? void 0 : n)
        },
        attrHooks: {
            type: {
                set: function(e, t) {
                    if (!v.radioValue && "radio" === t && k.nodeName(e, "input")) {
                        var i = e.value;
                        return e.setAttribute("type", t), i && (e.value = i), t
                    }
                }
            }
        },
        removeAttr: function(e, t) {
            var i, n, s = 0,
                o = t && t.match(O);
            if (o && 1 === e.nodeType)
                for (; i = o[s++];) n = k.propFix[i] || i, k.expr.match.bool.test(i) ? It && St || !Tt.test(i) ? e[n] = !1 : e[k.camelCase("default-" + i)] = e[n] = !1 : k.attr(e, i, ""), e.removeAttribute(St ? i : n)
        }
    }), kt = {
        set: function(e, t, i) {
            return !1 === t ? k.removeAttr(e, i) : It && St || !Tt.test(i) ? e.setAttribute(!St && k.propFix[i] || i, i) : e[k.camelCase("default-" + i)] = e[i] = !0, i
        }
    }, k.each(k.expr.match.bool.source.match(/\w+/g), function(e, t) {
        var o = Dt[t] || k.find.attr;
        It && St || !Tt.test(t) ? Dt[t] = function(e, t, i) {
            var n, s;
            return i || (s = Dt[t], Dt[t] = n, n = null != o(e, t, i) ? t.toLowerCase() : null, Dt[t] = s), n
        } : Dt[t] = function(e, t, i) {
            return i ? void 0 : e[k.camelCase("default-" + t)] ? t.toLowerCase() : null
        }
    }), It && St || (k.attrHooks.value = {
        set: function(e, t, i) {
            return k.nodeName(e, "input") ? void(e.defaultValue = t) : Ct && Ct.set(e, t, i)
        }
    }), St || (Ct = {
        set: function(e, t, i) {
            var n = e.getAttributeNode(i);
            return n || e.setAttributeNode(n = e.ownerDocument.createAttribute(i)), n.value = t += "", "value" === i || t === e.getAttribute(i) ? t : void 0
        }
    }, Dt.id = Dt.name = Dt.coords = function(e, t, i) {
        var n;
        return i ? void 0 : (n = e.getAttributeNode(t)) && "" !== n.value ? n.value : null
    }, k.valHooks.button = {
        get: function(e, t) {
            var i = e.getAttributeNode(t);
            return i && i.specified ? i.value : void 0
        },
        set: Ct.set
    }, k.attrHooks.contenteditable = {
        set: function(e, t, i) {
            Ct.set(e, "" !== t && t, i)
        }
    }, k.each(["width", "height"], function(e, i) {
        k.attrHooks[i] = {
            set: function(e, t) {
                return "" === t ? (e.setAttribute(i, "auto"), t) : void 0
            }
        }
    })), v.style || (k.attrHooks.style = {
        get: function(e) {
            return e.style.cssText || void 0
        },
        set: function(e, t) {
            return e.style.cssText = t + ""
        }
    });
    var Et = /^(?:input|select|textarea|button|object)$/i,
        At = /^(?:a|area)$/i;
    k.fn.extend({
        prop: function(e, t) {
            return J(this, k.prop, e, t, 1 < arguments.length)
        },
        removeProp: function(e) {
            return e = k.propFix[e] || e, this.each(function() {
                try {
                    this[e] = void 0, delete this[e]
                } catch (e) {}
            })
        }
    }), k.extend({
        prop: function(e, t, i) {
            var n, s, o = e.nodeType;
            if (3 !== o && 8 !== o && 2 !== o) return 1 === o && k.isXMLDoc(e) || (t = k.propFix[t] || t, s = k.propHooks[t]), void 0 !== i ? s && "set" in s && void 0 !== (n = s.set(e, i, t)) ? n : e[t] = i : s && "get" in s && null !== (n = s.get(e, t)) ? n : e[t]
        },
        propHooks: {
            tabIndex: {
                get: function(e) {
                    var t = k.find.attr(e, "tabindex");
                    return t ? parseInt(t, 10) : Et.test(e.nodeName) || At.test(e.nodeName) && e.href ? 0 : -1
                }
            }
        },
        propFix: {
            for: "htmlFor",
            class: "className"
        }
    }), v.hrefNormalized || k.each(["href", "src"], function(e, t) {
        k.propHooks[t] = {
            get: function(e) {
                return e.getAttribute(t, 4)
            }
        }
    }), v.optSelected || (k.propHooks.selected = {
        get: function(e) {
            var t = e.parentNode;
            return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null
        },
        set: function(e) {
            var t = e.parentNode;
            t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
        }
    }), k.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
        k.propFix[this.toLowerCase()] = this
    }), v.enctype || (k.propFix.enctype = "encoding");
    var Nt = /[\t\r\n\f]/g;

    function Mt(e) {
        return k.attr(e, "class") || ""
    }
    k.fn.extend({
        addClass: function(t) {
            var e, i, n, s, o, a, r, l = 0;
            if (k.isFunction(t)) return this.each(function(e) {
                k(this).addClass(t.call(this, e, Mt(this)))
            });
            if ("string" == typeof t && t)
                for (e = t.match(O) || []; i = this[l++];)
                    if (s = Mt(i), n = 1 === i.nodeType && (" " + s + " ").replace(Nt, " ")) {
                        for (a = 0; o = e[a++];) n.indexOf(" " + o + " ") < 0 && (n += o + " ");
                        s !== (r = k.trim(n)) && k.attr(i, "class", r)
                    }
            return this
        },
        removeClass: function(t) {
            var e, i, n, s, o, a, r, l = 0;
            if (k.isFunction(t)) return this.each(function(e) {
                k(this).removeClass(t.call(this, e, Mt(this)))
            });
            if (!arguments.length) return this.attr("class", "");
            if ("string" == typeof t && t)
                for (e = t.match(O) || []; i = this[l++];)
                    if (s = Mt(i), n = 1 === i.nodeType && (" " + s + " ").replace(Nt, " ")) {
                        for (a = 0; o = e[a++];)
                            for (; - 1 < n.indexOf(" " + o + " ");) n = n.replace(" " + o + " ", " ");
                        s !== (r = k.trim(n)) && k.attr(i, "class", r)
                    }
            return this
        },
        toggleClass: function(s, t) {
            var o = typeof s;
            return "boolean" == typeof t && "string" == o ? t ? this.addClass(s) : this.removeClass(s) : k.isFunction(s) ? this.each(function(e) {
                k(this).toggleClass(s.call(this, e, Mt(this), t), t)
            }) : this.each(function() {
                var e, t, i, n;
                if ("string" == o)
                    for (t = 0, i = k(this), n = s.match(O) || []; e = n[t++];) i.hasClass(e) ? i.removeClass(e) : i.addClass(e);
                else void 0 !== s && "boolean" != o || ((e = Mt(this)) && k._data(this, "__className__", e), k.attr(this, "class", e || !1 === s ? "" : k._data(this, "__className__") || ""))
            })
        },
        hasClass: function(e) {
            var t, i, n = 0;
            for (t = " " + e + " "; i = this[n++];)
                if (1 === i.nodeType && -1 < (" " + Mt(i) + " ").replace(Nt, " ").indexOf(t)) return !0;
            return !1
        }
    }), k.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(e, i) {
        k.fn[i] = function(e, t) {
            return 0 < arguments.length ? this.on(i, null, e, t) : this.trigger(i)
        }
    }), k.fn.extend({
        hover: function(e, t) {
            return this.mouseenter(e).mouseleave(t || e)
        }
    });
    var Ot = C.location,
        Pt = k.now(),
        Ht = /\?/,
        zt = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
    k.parseJSON = function(e) {
        if (C.JSON && C.JSON.parse) return C.JSON.parse(e + "");
        var s, o = null,
            t = k.trim(e + "");
        return t && !k.trim(t.replace(zt, function(e, t, i, n) {
            return s && t && (o = 0), 0 === o ? e : (s = i || t, o += !n - !i, "")
        })) ? Function("return " + t)() : k.error("Invalid JSON: " + e)
    }, k.parseXML = function(e) {
        var t;
        if (!e || "string" != typeof e) return null;
        try {
            C.DOMParser ? t = (new C.DOMParser).parseFromString(e, "text/xml") : ((t = new C.ActiveXObject("Microsoft.XMLDOM")).async = "false", t.loadXML(e))
        } catch (e) {
            t = void 0
        }
        return t && t.documentElement && !t.getElementsByTagName("parsererror").length || k.error("Invalid XML: " + e), t
    };
    var Lt = /#.*$/,
        $t = /([?&])_=[^&]*/,
        Ft = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
        Wt = /^(?:GET|HEAD)$/,
        jt = /^\/\//,
        Rt = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,
        Bt = {},
        qt = {},
        Ut = "*/".concat("*"),
        Vt = Ot.href,
        Yt = Rt.exec(Vt.toLowerCase()) || [];

    function Kt(o) {
        return function(e, t) {
            "string" != typeof e && (t = e, e = "*");
            var i, n = 0,
                s = e.toLowerCase().match(O) || [];
            if (k.isFunction(t))
                for (; i = s[n++];) "+" === i.charAt(0) ? (i = i.slice(1) || "*", (o[i] = o[i] || []).unshift(t)) : (o[i] = o[i] || []).push(t)
        }
    }

    function Gt(t, s, o, a) {
        var r = {},
            l = t === qt;

        function c(e) {
            var n;
            return r[e] = !0, k.each(t[e] || [], function(e, t) {
                var i = t(s, o, a);
                return "string" != typeof i || l || r[i] ? l ? !(n = i) : void 0 : (s.dataTypes.unshift(i), c(i), !1)
            }), n
        }
        return c(s.dataTypes[0]) || !r["*"] && c("*")
    }

    function Xt(e, t) {
        var i, n, s = k.ajaxSettings.flatOptions || {};
        for (n in t) void 0 !== t[n] && ((s[n] ? e : i = i || {})[n] = t[n]);
        return i && k.extend(!0, e, i), e
    }
    k.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: Vt,
            type: "GET",
            isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(Yt[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Ut,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /\bxml\b/,
                html: /\bhtml/,
                json: /\bjson\b/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": k.parseJSON,
                "text xml": k.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(e, t) {
            return t ? Xt(Xt(e, k.ajaxSettings), t) : Xt(k.ajaxSettings, e)
        },
        ajaxPrefilter: Kt(Bt),
        ajaxTransport: Kt(qt),
        ajax: function(e, t) {
            "object" == typeof e && (t = e, e = void 0), t = t || {};
            var i, n, h, u, d, p, f, s, m = k.ajaxSetup({}, t),
                g = m.context || m,
                v = m.context && (g.nodeType || g.jquery) ? k(g) : k.event,
                b = k.Deferred(),
                _ = k.Callbacks("once memory"),
                y = m.statusCode || {},
                o = {},
                a = {},
                w = 0,
                r = "canceled",
                x = {
                    readyState: 0,
                    getResponseHeader: function(e) {
                        var t;
                        if (2 === w) {
                            if (!s)
                                for (s = {}; t = Ft.exec(u);) s[t[1].toLowerCase()] = t[2];
                            t = s[e.toLowerCase()]
                        }
                        return null == t ? null : t
                    },
                    getAllResponseHeaders: function() {
                        return 2 === w ? u : null
                    },
                    setRequestHeader: function(e, t) {
                        var i = e.toLowerCase();
                        return w || (e = a[i] = a[i] || e, o[e] = t), this
                    },
                    overrideMimeType: function(e) {
                        return w || (m.mimeType = e), this
                    },
                    statusCode: function(e) {
                        var t;
                        if (e)
                            if (w < 2)
                                for (t in e) y[t] = [y[t], e[t]];
                            else x.always(e[x.status]);
                        return this
                    },
                    abort: function(e) {
                        var t = e || r;
                        return f && f.abort(t), l(0, t), this
                    }
                };
            if (b.promise(x).complete = _.add, x.success = x.done, x.error = x.fail, m.url = ((e || m.url || Vt) + "").replace(Lt, "").replace(jt, Yt[1] + "//"), m.type = t.method || t.type || m.method || m.type, m.dataTypes = k.trim(m.dataType || "*").toLowerCase().match(O) || [""], null == m.crossDomain && (i = Rt.exec(m.url.toLowerCase()), m.crossDomain = !(!i || i[1] === Yt[1] && i[2] === Yt[2] && (i[3] || ("http:" === i[1] ? "80" : "443")) === (Yt[3] || ("http:" === Yt[1] ? "80" : "443")))), m.data && m.processData && "string" != typeof m.data && (m.data = k.param(m.data, m.traditional)), Gt(Bt, m, t, x), 2 === w) return x;
            for (n in (p = k.event && m.global) && 0 == k.active++ && k.event.trigger("ajaxStart"), m.type = m.type.toUpperCase(), m.hasContent = !Wt.test(m.type), h = m.url, m.hasContent || (m.data && (h = m.url += (Ht.test(h) ? "&" : "?") + m.data, delete m.data), !1 === m.cache && (m.url = $t.test(h) ? h.replace($t, "$1_=" + Pt++) : h + (Ht.test(h) ? "&" : "?") + "_=" + Pt++)), m.ifModified && (k.lastModified[h] && x.setRequestHeader("If-Modified-Since", k.lastModified[h]), k.etag[h] && x.setRequestHeader("If-None-Match", k.etag[h])), (m.data && m.hasContent && !1 !== m.contentType || t.contentType) && x.setRequestHeader("Content-Type", m.contentType), x.setRequestHeader("Accept", m.dataTypes[0] && m.accepts[m.dataTypes[0]] ? m.accepts[m.dataTypes[0]] + ("*" !== m.dataTypes[0] ? ", " + Ut + "; q=0.01" : "") : m.accepts["*"]), m.headers) x.setRequestHeader(n, m.headers[n]);
            if (m.beforeSend && (!1 === m.beforeSend.call(g, x, m) || 2 === w)) return x.abort();
            for (n in r = "abort", {
                    success: 1,
                    error: 1,
                    complete: 1
                }) x[n](m[n]);
            if (f = Gt(qt, m, t, x)) {
                if (x.readyState = 1, p && v.trigger("ajaxSend", [x, m]), 2 === w) return x;
                m.async && 0 < m.timeout && (d = C.setTimeout(function() {
                    x.abort("timeout")
                }, m.timeout));
                try {
                    w = 1, f.send(o, l)
                } catch (e) {
                    if (!(w < 2)) throw e;
                    l(-1, e)
                }
            } else l(-1, "No Transport");

            function l(e, t, i, n) {
                var s, o, a, r, l, c = t;
                2 !== w && (w = 2, d && C.clearTimeout(d), f = void 0, u = n || "", x.readyState = 0 < e ? 4 : 0, s = 200 <= e && e < 300 || 304 === e, i && (r = function(e, t, i) {
                    for (var n, s, o, a, r = e.contents, l = e.dataTypes;
                        "*" === l[0];) l.shift(), void 0 === s && (s = e.mimeType || t.getResponseHeader("Content-Type"));
                    if (s)
                        for (a in r)
                            if (r[a] && r[a].test(s)) {
                                l.unshift(a);
                                break
                            }
                    if (l[0] in i) o = l[0];
                    else {
                        for (a in i) {
                            if (!l[0] || e.converters[a + " " + l[0]]) {
                                o = a;
                                break
                            }
                            n = n || a
                        }
                        o = o || n
                    }
                    return o ? (o !== l[0] && l.unshift(o), i[o]) : void 0
                }(m, x, i)), r = function(e, t, i, n) {
                    var s, o, a, r, l, c = {},
                        h = e.dataTypes.slice();
                    if (h[1])
                        for (a in e.converters) c[a.toLowerCase()] = e.converters[a];
                    for (o = h.shift(); o;)
                        if (e.responseFields[o] && (i[e.responseFields[o]] = t), !l && n && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = o, o = h.shift())
                            if ("*" === o) o = l;
                            else if ("*" !== l && l !== o) {
                        if (!(a = c[l + " " + o] || c["* " + o]))
                            for (s in c)
                                if ((r = s.split(" "))[1] === o && (a = c[l + " " + r[0]] || c["* " + r[0]])) {
                                    !0 === a ? a = c[s] : !0 !== c[s] && (o = r[0], h.unshift(r[1]));
                                    break
                                }
                        if (!0 !== a)
                            if (a && e.throws) t = a(t);
                            else try {
                                t = a(t)
                            } catch (e) {
                                return {
                                    state: "parsererror",
                                    error: a ? e : "No conversion from " + l + " to " + o
                                }
                            }
                    }
                    return {
                        state: "success",
                        data: t
                    }
                }(m, r, x, s), s ? (m.ifModified && ((l = x.getResponseHeader("Last-Modified")) && (k.lastModified[h] = l), (l = x.getResponseHeader("etag")) && (k.etag[h] = l)), 204 === e || "HEAD" === m.type ? c = "nocontent" : 304 === e ? c = "notmodified" : (c = r.state, o = r.data, s = !(a = r.error))) : (a = c, !e && c || (c = "error", e < 0 && (e = 0))), x.status = e, x.statusText = (t || c) + "", s ? b.resolveWith(g, [o, c, x]) : b.rejectWith(g, [x, c, a]), x.statusCode(y), y = void 0, p && v.trigger(s ? "ajaxSuccess" : "ajaxError", [x, m, s ? o : a]), _.fireWith(g, [x, c]), p && (v.trigger("ajaxComplete", [x, m]), --k.active || k.event.trigger("ajaxStop")))
            }
            return x
        },
        getJSON: function(e, t, i) {
            return k.get(e, t, i, "json")
        },
        getScript: function(e, t) {
            return k.get(e, void 0, t, "script")
        }
    }), k.each(["get", "post"], function(e, s) {
        k[s] = function(e, t, i, n) {
            return k.isFunction(t) && (n = n || i, i = t, t = void 0), k.ajax(k.extend({
                url: e,
                type: s,
                dataType: n,
                data: t,
                success: i
            }, k.isPlainObject(e) && e))
        }
    }), k._evalUrl = function(e) {
        return k.ajax({
            url: e,
            type: "GET",
            dataType: "script",
            cache: !0,
            async: !1,
            global: !1,
            throws: !0
        })
    }, k.fn.extend({
        wrapAll: function(t) {
            if (k.isFunction(t)) return this.each(function(e) {
                k(this).wrapAll(t.call(this, e))
            });
            if (this[0]) {
                var e = k(t, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && e.insertBefore(this[0]), e.map(function() {
                    for (var e = this; e.firstChild && 1 === e.firstChild.nodeType;) e = e.firstChild;
                    return e
                }).append(this)
            }
            return this
        },
        wrapInner: function(i) {
            return k.isFunction(i) ? this.each(function(e) {
                k(this).wrapInner(i.call(this, e))
            }) : this.each(function() {
                var e = k(this),
                    t = e.contents();
                t.length ? t.wrapAll(i) : e.append(i)
            })
        },
        wrap: function(t) {
            var i = k.isFunction(t);
            return this.each(function(e) {
                k(this).wrapAll(i ? t.call(this, e) : t)
            })
        },
        unwrap: function() {
            return this.parent().each(function() {
                k.nodeName(this, "body") || k(this).replaceWith(this.childNodes)
            }).end()
        }
    }), k.expr.filters.hidden = function(e) {
        return v.reliableHiddenOffsets() ? e.offsetWidth <= 0 && e.offsetHeight <= 0 && !e.getClientRects().length : function(e) {
            if (!k.contains(e.ownerDocument || f, e)) return !0;
            for (; e && 1 === e.nodeType;) {
                if ("none" === ((t = e).style && t.style.display || k.css(t, "display")) || "hidden" === e.type) return !0;
                e = e.parentNode
            }
            var t;
            return !1
        }(e)
    }, k.expr.filters.visible = function(e) {
        return !k.expr.filters.hidden(e)
    };
    var Qt = /%20/g,
        Jt = /\[\]$/,
        Zt = /\r?\n/g,
        ei = /^(?:submit|button|image|reset|file)$/i,
        ti = /^(?:input|select|textarea|keygen)/i;

    function ii(i, e, n, s) {
        var t;
        if (k.isArray(e)) k.each(e, function(e, t) {
            n || Jt.test(i) ? s(i, t) : ii(i + "[" + ("object" == typeof t && null != t ? e : "") + "]", t, n, s)
        });
        else if (n || "object" !== k.type(e)) s(i, e);
        else
            for (t in e) ii(i + "[" + t + "]", e[t], n, s)
    }
    k.param = function(e, t) {
        function i(e, t) {
            t = k.isFunction(t) ? t() : null == t ? "" : t, s[s.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
        }
        var n, s = [];
        if (void 0 === t && (t = k.ajaxSettings && k.ajaxSettings.traditional), k.isArray(e) || e.jquery && !k.isPlainObject(e)) k.each(e, function() {
            i(this.name, this.value)
        });
        else
            for (n in e) ii(n, e[n], t, i);
        return s.join("&").replace(Qt, "+")
    }, k.fn.extend({
        serialize: function() {
            return k.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                var e = k.prop(this, "elements");
                return e ? k.makeArray(e) : this
            }).filter(function() {
                var e = this.type;
                return this.name && !k(this).is(":disabled") && ti.test(this.nodeName) && !ei.test(e) && (this.checked || !Z.test(e))
            }).map(function(e, t) {
                var i = k(this).val();
                return null == i ? null : k.isArray(i) ? k.map(i, function(e) {
                    return {
                        name: t.name,
                        value: e.replace(Zt, "\r\n")
                    }
                }) : {
                    name: t.name,
                    value: i.replace(Zt, "\r\n")
                }
            }).get()
        }
    }), k.ajaxSettings.xhr = void 0 !== C.ActiveXObject ? function() {
        return this.isLocal ? ri() : 8 < f.documentMode ? ai() : /^(get|post|head|put|delete|options)$/i.test(this.type) && ai() || ri()
    } : ai;
    var ni = 0,
        si = {},
        oi = k.ajaxSettings.xhr();

    function ai() {
        try {
            return new C.XMLHttpRequest
        } catch (e) {}
    }

    function ri() {
        try {
            return new C.ActiveXObject("Microsoft.XMLHTTP")
        } catch (e) {}
    }
    C.attachEvent && C.attachEvent("onunload", function() {
        for (var e in si) si[e](void 0, !0)
    }), v.cors = !!oi && "withCredentials" in oi, (oi = v.ajax = !!oi) && k.ajaxTransport(function(l) {
        var c;
        if (!l.crossDomain || v.cors) return {
            send: function(e, o) {
                var t, a = l.xhr(),
                    r = ++ni;
                if (a.open(l.type, l.url, l.async, l.username, l.password), l.xhrFields)
                    for (t in l.xhrFields) a[t] = l.xhrFields[t];
                for (t in l.mimeType && a.overrideMimeType && a.overrideMimeType(l.mimeType), l.crossDomain || e["X-Requested-With"] || (e["X-Requested-With"] = "XMLHttpRequest"), e) void 0 !== e[t] && a.setRequestHeader(t, e[t] + "");
                a.send(l.hasContent && l.data || null), c = function(e, t) {
                    var i, n, s;
                    if (c && (t || 4 === a.readyState))
                        if (delete si[r], c = void 0, a.onreadystatechange = k.noop, t) 4 !== a.readyState && a.abort();
                        else {
                            s = {}, i = a.status, "string" == typeof a.responseText && (s.text = a.responseText);
                            try {
                                n = a.statusText
                            } catch (e) {
                                n = ""
                            }
                            i || !l.isLocal || l.crossDomain ? 1223 === i && (i = 204) : i = s.text ? 200 : 404
                        }
                    s && o(i, n, s, a.getAllResponseHeaders())
                }, l.async ? 4 === a.readyState ? C.setTimeout(c) : a.onreadystatechange = si[r] = c : c()
            },
            abort: function() {
                c && c(void 0, !0)
            }
        }
    }), k.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /\b(?:java|ecma)script\b/
        },
        converters: {
            "text script": function(e) {
                return k.globalEval(e), e
            }
        }
    }), k.ajaxPrefilter("script", function(e) {
        void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET", e.global = !1)
    }), k.ajaxTransport("script", function(t) {
        if (t.crossDomain) {
            var n, s = f.head || k("head")[0] || f.documentElement;
            return {
                send: function(e, i) {
                    (n = f.createElement("script")).async = !0, t.scriptCharset && (n.charset = t.scriptCharset), n.src = t.url, n.onload = n.onreadystatechange = function(e, t) {
                        !t && n.readyState && !/loaded|complete/.test(n.readyState) || (n.onload = n.onreadystatechange = null, n.parentNode && n.parentNode.removeChild(n), n = null, t || i(200, "success"))
                    }, s.insertBefore(n, s.firstChild)
                },
                abort: function() {
                    n && n.onload(void 0, !0)
                }
            }
        }
    });
    var li = [],
        ci = /(=)\?(?=&|$)|\?\?/;
    k.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var e = li.pop() || k.expando + "_" + Pt++;
            return this[e] = !0, e
        }
    }), k.ajaxPrefilter("json jsonp", function(e, t, i) {
        var n, s, o, a = !1 !== e.jsonp && (ci.test(e.url) ? "url" : "string" == typeof e.data && 0 === (e.contentType || "").indexOf("application/x-www-form-urlencoded") && ci.test(e.data) && "data");
        return a || "jsonp" === e.dataTypes[0] ? (n = e.jsonpCallback = k.isFunction(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, a ? e[a] = e[a].replace(ci, "$1" + n) : !1 !== e.jsonp && (e.url += (Ht.test(e.url) ? "&" : "?") + e.jsonp + "=" + n), e.converters["script json"] = function() {
            return o || k.error(n + " was not called"), o[0]
        }, e.dataTypes[0] = "json", s = C[n], C[n] = function() {
            o = arguments
        }, i.always(function() {
            void 0 === s ? k(C).removeProp(n) : C[n] = s, e[n] && (e.jsonpCallback = t.jsonpCallback, li.push(n)), o && k.isFunction(s) && s(o[0]), o = s = void 0
        }), "script") : void 0
    }), k.parseHTML = function(e, t, i) {
        if (!e || "string" != typeof e) return null;
        "boolean" == typeof t && (i = t, t = !1), t = t || f;
        var n = w.exec(e),
            s = !i && [];
        return n ? [t.createElement(n[1])] : (n = ue([e], t, s), s && s.length && k(s).remove(), k.merge([], n.childNodes))
    };
    var hi = k.fn.load;

    function ui(e) {
        return k.isWindow(e) ? e : 9 === e.nodeType && (e.defaultView || e.parentWindow)
    }
    k.fn.load = function(e, t, i) {
        if ("string" != typeof e && hi) return hi.apply(this, arguments);
        var n, s, o, a = this,
            r = e.indexOf(" ");
        return -1 < r && (n = k.trim(e.slice(r, e.length)), e = e.slice(0, r)), k.isFunction(t) ? (i = t, t = void 0) : t && "object" == typeof t && (s = "POST"), 0 < a.length && k.ajax({
            url: e,
            type: s || "GET",
            dataType: "html",
            data: t
        }).done(function(e) {
            o = arguments, a.html(n ? k("<div>").append(k.parseHTML(e)).find(n) : e)
        }).always(i && function(e, t) {
            a.each(function() {
                i.apply(this, o || [e.responseText, t, e])
            })
        }), this
    }, k.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(e, t) {
        k.fn[t] = function(e) {
            return this.on(t, e)
        }
    }), k.expr.filters.animated = function(t) {
        return k.grep(k.timers, function(e) {
            return t === e.elem
        }).length
    }, k.offset = {
        setOffset: function(e, t, i) {
            var n, s, o, a, r, l, c = k.css(e, "position"),
                h = k(e),
                u = {};
            "static" === c && (e.style.position = "relative"), r = h.offset(), o = k.css(e, "top"), l = k.css(e, "left"), s = ("absolute" === c || "fixed" === c) && -1 < k.inArray("auto", [o, l]) ? (a = (n = h.position()).top, n.left) : (a = parseFloat(o) || 0, parseFloat(l) || 0), k.isFunction(t) && (t = t.call(e, i, k.extend({}, r))), null != t.top && (u.top = t.top - r.top + a), null != t.left && (u.left = t.left - r.left + s), "using" in t ? t.using.call(e, u) : h.css(u)
        }
    }, k.fn.extend({
        offset: function(t) {
            if (arguments.length) return void 0 === t ? this : this.each(function(e) {
                k.offset.setOffset(this, t, e)
            });
            var e, i, n = {
                    top: 0,
                    left: 0
                },
                s = this[0],
                o = s && s.ownerDocument;
            return o ? (e = o.documentElement, k.contains(e, s) ? (void 0 !== s.getBoundingClientRect && (n = s.getBoundingClientRect()), i = ui(o), {
                top: n.top + (i.pageYOffset || e.scrollTop) - (e.clientTop || 0),
                left: n.left + (i.pageXOffset || e.scrollLeft) - (e.clientLeft || 0)
            }) : n) : void 0
        },
        position: function() {
            if (this[0]) {
                var e, t, i = {
                        top: 0,
                        left: 0
                    },
                    n = this[0];
                return "fixed" === k.css(n, "position") ? t = n.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), k.nodeName(e[0], "html") || (i = e.offset()), i.top += k.css(e[0], "borderTopWidth", !0), i.left += k.css(e[0], "borderLeftWidth", !0)), {
                    top: t.top - i.top - k.css(n, "marginTop", !0),
                    left: t.left - i.left - k.css(n, "marginLeft", !0)
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                for (var e = this.offsetParent; e && !k.nodeName(e, "html") && "static" === k.css(e, "position");) e = e.offsetParent;
                return e || Be
            })
        }
    }), k.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function(t, s) {
        var o = /Y/.test(s);
        k.fn[t] = function(e) {
            return J(this, function(e, t, i) {
                var n = ui(e);
                return void 0 === i ? n ? s in n ? n[s] : n.document.documentElement[t] : e[t] : void(n ? n.scrollTo(o ? k(n).scrollLeft() : i, o ? i : k(n).scrollTop()) : e[t] = i)
            }, t, e, arguments.length, null)
        }
    }), k.each(["top", "left"], function(e, i) {
        k.cssHooks[i] = Ye(v.pixelPosition, function(e, t) {
            return t ? (t = Ue(e, i), Re.test(t) ? k(e).position()[i] + "px" : t) : void 0
        })
    }), k.each({
        Height: "height",
        Width: "width"
    }, function(o, a) {
        k.each({
            padding: "inner" + o,
            content: a,
            "": "outer" + o
        }, function(n, e) {
            k.fn[e] = function(e, t) {
                var i = arguments.length && (n || "boolean" != typeof e),
                    s = n || (!0 === e || !0 === t ? "margin" : "border");
                return J(this, function(e, t, i) {
                    var n;
                    return k.isWindow(e) ? e.document.documentElement["client" + o] : 9 === e.nodeType ? (n = e.documentElement, Math.max(e.body["scroll" + o], n["scroll" + o], e.body["offset" + o], n["offset" + o], n["client" + o])) : void 0 === i ? k.css(e, t, s) : k.style(e, t, i, s)
                }, a, i ? e : void 0, i, null)
            }
        })
    }), k.fn.extend({
        bind: function(e, t, i) {
            return this.on(e, null, t, i)
        },
        unbind: function(e, t) {
            return this.off(e, null, t)
        },
        delegate: function(e, t, i, n) {
            return this.on(t, e, i, n)
        },
        undelegate: function(e, t, i) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", i)
        }
    }), k.fn.size = function() {
        return this.length
    }, k.fn.andSelf = k.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() {
        return k
    });
    var di = C.jQuery,
        pi = C.$;
    return k.noConflict = function(e) {
        return C.$ === k && (C.$ = pi), e && C.jQuery === k && (C.jQuery = di), k
    }, e || (C.jQuery = C.$ = k), k
}),
function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : e(jQuery)
}(function(C) {
    function e() {
        this._curInst = null, this._keyEvent = !1, this._disabledInputs = [], this._datepickerShowing = !1, this._inDialog = !1, this._mainDivId = "ui-datepicker-div", this._inlineClass = "ui-datepicker-inline", this._appendClass = "ui-datepicker-append", this._triggerClass = "ui-datepicker-trigger", this._dialogClass = "ui-datepicker-dialog", this._disableClass = "ui-datepicker-disabled", this._unselectableClass = "ui-datepicker-unselectable", this._currentClass = "ui-datepicker-current-day", this._dayOverClass = "ui-datepicker-days-cell-over", this.regional = [], this.regional[""] = {
            closeText: "Done",
            prevText: "Prev",
            nextText: "Next",
            currentText: "Today",
            monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
            weekHeader: "Wk",
            dateFormat: "mm/dd/yy",
            firstDay: 0,
            isRTL: !1,
            showMonthAfterYear: !1,
            yearSuffix: ""
        }, this._defaults = {
            showOn: "focus",
            showAnim: "fadeIn",
            showOptions: {},
            defaultDate: null,
            appendText: "",
            buttonText: "...",
            buttonImage: "",
            buttonImageOnly: !1,
            hideIfNoPrevNext: !1,
            navigationAsDateFormat: !1,
            gotoCurrent: !1,
            changeMonth: !1,
            changeYear: !1,
            yearRange: "c-10:c+10",
            showOtherMonths: !1,
            selectOtherMonths: !1,
            showWeek: !1,
            calculateWeek: this.iso8601Week,
            shortYearCutoff: "+10",
            minDate: null,
            maxDate: null,
            duration: "fast",
            beforeShowDay: null,
            beforeShow: null,
            onSelect: null,
            onChangeMonthYear: null,
            onClose: null,
            numberOfMonths: 1,
            showCurrentAtPos: 0,
            stepMonths: 1,
            stepBigMonths: 12,
            altField: "",
            altFormat: "",
            constrainInput: !0,
            showButtonPanel: !1,
            autoSize: !1,
            disabled: !1
        }, C.extend(this._defaults, this.regional[""]), this.regional.en = C.extend(!0, {}, this.regional[""]), this.regional["en-US"] = C.extend(!0, {}, this.regional.en), this.dpDiv = i(C("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))
    }

    function i(e) {
        var t = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
        return e.on("mouseout", t, function() {
            C(this).removeClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && C(this).removeClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && C(this).removeClass("ui-datepicker-next-hover")
        }).on("mouseover", t, o)
    }

    function o() {
        C.datepicker._isDisabledDatepicker(ie.inline ? ie.dpDiv.parent()[0] : ie.input[0]) || (C(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"), C(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && C(this).addClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && C(this).addClass("ui-datepicker-next-hover"))
    }

    function u(e, t) {
        for (var i in C.extend(e, t), t) null == t[i] && (e[i] = t[i]);
        return e
    }

    function t(t) {
        return function() {
            var e = this.element.val();
            t.apply(this, arguments), this._refresh(), e !== this.element.val() && this._trigger("change")
        }
    }
    C.ui = C.ui || {}, C.ui.version = "1.12.1";
    var n, s, x, k, a, r, l, c, h, D, d, p = 0,
        f = Array.prototype.slice;

    function T(e, t, i) {
        return [parseFloat(e[0]) * (h.test(e[0]) ? t / 100 : 1), parseFloat(e[1]) * (h.test(e[1]) ? i / 100 : 1)]
    }

    function S(e, t) {
        return parseInt(C.css(e, t), 10) || 0
    }
    C.cleanData = (d = C.cleanData, function(e) {
        var t, i, n;
        for (n = 0; null != (i = e[n]); n++) try {
            (t = C._data(i, "events")) && t.remove && C(i).triggerHandler("remove")
        } catch (e) {}
        d(e)
    }), C.widget = function(e, i, t) {
        var n, s, o, a = {},
            r = e.split(".")[0],
            l = r + "-" + (e = e.split(".")[1]);
        return t || (t = i, i = C.Widget), C.isArray(t) && (t = C.extend.apply(null, [{}].concat(t))), C.expr[":"][l.toLowerCase()] = function(e) {
            return !!C.data(e, l)
        }, C[r] = C[r] || {}, n = C[r][e], s = C[r][e] = function(e, t) {
            return this._createWidget ? void(arguments.length && this._createWidget(e, t)) : new s(e, t)
        }, C.extend(s, n, {
            version: t.version,
            _proto: C.extend({}, t),
            _childConstructors: []
        }), (o = new i).options = C.widget.extend({}, o.options), C.each(t, function(t, n) {
            return C.isFunction(n) ? void(a[t] = function() {
                var e, t = this._super,
                    i = this._superApply;
                return this._super = s, this._superApply = o, e = n.apply(this, arguments), this._super = t, this._superApply = i, e
            }) : void(a[t] = n);

            function s() {
                return i.prototype[t].apply(this, arguments)
            }

            function o(e) {
                return i.prototype[t].apply(this, e)
            }
        }), s.prototype = C.widget.extend(o, {
            widgetEventPrefix: n && o.widgetEventPrefix || e
        }, a, {
            constructor: s,
            namespace: r,
            widgetName: e,
            widgetFullName: l
        }), n ? (C.each(n._childConstructors, function(e, t) {
            var i = t.prototype;
            C.widget(i.namespace + "." + i.widgetName, s, t._proto)
        }), delete n._childConstructors) : i._childConstructors.push(s), C.widget.bridge(e, s), s
    }, C.widget.extend = function(e) {
        for (var t, i, n = f.call(arguments, 1), s = 0, o = n.length; s < o; s++)
            for (t in n[s]) i = n[s][t], n[s].hasOwnProperty(t) && void 0 !== i && (e[t] = C.isPlainObject(i) ? C.isPlainObject(e[t]) ? C.widget.extend({}, e[t], i) : C.widget.extend({}, i) : i);
        return e
    }, C.widget.bridge = function(o, t) {
        var a = t.prototype.widgetFullName || o;
        C.fn[o] = function(i) {
            var e = "string" == typeof i,
                n = f.call(arguments, 1),
                s = this;
            return e ? this.length || "instance" !== i ? this.each(function() {
                var e, t = C.data(this, a);
                return "instance" === i ? (s = t, !1) : t ? C.isFunction(t[i]) && "_" !== i.charAt(0) ? (e = t[i].apply(t, n)) !== t && void 0 !== e ? (s = e && e.jquery ? s.pushStack(e.get()) : e, !1) : void 0 : C.error("no such method '" + i + "' for " + o + " widget instance") : C.error("cannot call methods on " + o + " prior to initialization; attempted to call method '" + i + "'")
            }) : s = void 0 : (n.length && (i = C.widget.extend.apply(null, [i].concat(n))), this.each(function() {
                var e = C.data(this, a);
                e ? (e.option(i || {}), e._init && e._init()) : C.data(this, a, new t(i, this))
            })), s
        }
    }, C.Widget = function() {}, C.Widget._childConstructors = [], C.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {
            classes: {},
            disabled: !1,
            create: null
        },
        _createWidget: function(e, t) {
            t = C(t || this.defaultElement || this)[0], this.element = C(t), this.uuid = p++, this.eventNamespace = "." + this.widgetName + this.uuid, this.bindings = C(), this.hoverable = C(), this.focusable = C(), this.classesElementLookup = {}, t !== this && (C.data(t, this.widgetFullName, this), this._on(!0, this.element, {
                remove: function(e) {
                    e.target === t && this.destroy()
                }
            }), this.document = C(t.style ? t.ownerDocument : t.document || t), this.window = C(this.document[0].defaultView || this.document[0].parentWindow)), this.options = C.widget.extend({}, this.options, this._getCreateOptions(), e), this._create(), this.options.disabled && this._setOptionDisabled(this.options.disabled), this._trigger("create", null, this._getCreateEventData()), this._init()
        },
        _getCreateOptions: function() {
            return {}
        },
        _getCreateEventData: C.noop,
        _create: C.noop,
        _init: C.noop,
        destroy: function() {
            var i = this;
            this._destroy(), C.each(this.classesElementLookup, function(e, t) {
                i._removeClass(t, e)
            }), this.element.off(this.eventNamespace).removeData(this.widgetFullName), this.widget().off(this.eventNamespace).removeAttr("aria-disabled"), this.bindings.off(this.eventNamespace)
        },
        _destroy: C.noop,
        widget: function() {
            return this.element
        },
        option: function(e, t) {
            var i, n, s, o = e;
            if (0 === arguments.length) return C.widget.extend({}, this.options);
            if ("string" == typeof e)
                if (o = {}, e = (i = e.split(".")).shift(), i.length) {
                    for (n = o[e] = C.widget.extend({}, this.options[e]), s = 0; i.length - 1 > s; s++) n[i[s]] = n[i[s]] || {}, n = n[i[s]];
                    if (e = i.pop(), 1 === arguments.length) return void 0 === n[e] ? null : n[e];
                    n[e] = t
                } else {
                    if (1 === arguments.length) return void 0 === this.options[e] ? null : this.options[e];
                    o[e] = t
                }
            return this._setOptions(o), this
        },
        _setOptions: function(e) {
            var t;
            for (t in e) this._setOption(t, e[t]);
            return this
        },
        _setOption: function(e, t) {
            return "classes" === e && this._setOptionClasses(t), this.options[e] = t, "disabled" === e && this._setOptionDisabled(t), this
        },
        _setOptionClasses: function(e) {
            var t, i, n;
            for (t in e) n = this.classesElementLookup[t], e[t] !== this.options.classes[t] && n && n.length && (i = C(n.get()), this._removeClass(n, t), i.addClass(this._classes({
                element: i,
                keys: t,
                classes: e,
                add: !0
            })))
        },
        _setOptionDisabled: function(e) {
            this._toggleClass(this.widget(), this.widgetFullName + "-disabled", null, !!e), e && (this._removeClass(this.hoverable, null, "ui-state-hover"), this._removeClass(this.focusable, null, "ui-state-focus"))
        },
        enable: function() {
            return this._setOptions({
                disabled: !1
            })
        },
        disable: function() {
            return this._setOptions({
                disabled: !0
            })
        },
        _classes: function(s) {
            function e(e, t) {
                var i, n;
                for (n = 0; e.length > n; n++) i = a.classesElementLookup[e[n]] || C(), i = s.add ? C(C.unique(i.get().concat(s.element.get()))) : C(i.not(s.element).get()), a.classesElementLookup[e[n]] = i, o.push(e[n]), t && s.classes[e[n]] && o.push(s.classes[e[n]])
            }
            var o = [],
                a = this;
            return s = C.extend({
                element: this.element,
                classes: this.options.classes || {}
            }, s), this._on(s.element, {
                remove: "_untrackClassesElement"
            }), s.keys && e(s.keys.match(/\S+/g) || [], !0), s.extra && e(s.extra.match(/\S+/g) || []), o.join(" ")
        },
        _untrackClassesElement: function(i) {
            var n = this;
            C.each(n.classesElementLookup, function(e, t) {
                -1 !== C.inArray(i.target, t) && (n.classesElementLookup[e] = C(t.not(i.target).get()))
            })
        },
        _removeClass: function(e, t, i) {
            return this._toggleClass(e, t, i, !1)
        },
        _addClass: function(e, t, i) {
            return this._toggleClass(e, t, i, !0)
        },
        _toggleClass: function(e, t, i, n) {
            n = "boolean" == typeof n ? n : i;
            var s = "string" == typeof e || null === e,
                o = {
                    extra: s ? t : i,
                    keys: s ? e : t,
                    element: s ? this.element : e,
                    add: n
                };
            return o.element.toggleClass(this._classes(o), n), this
        },
        _on: function(a, r, e) {
            var l, c = this;
            "boolean" != typeof a && (e = r, r = a, a = !1), e ? (r = l = C(r), this.bindings = this.bindings.add(r)) : (e = r, r = this.element, l = this.widget()), C.each(e, function(e, t) {
                function i() {
                    return a || !0 !== c.options.disabled && !C(this).hasClass("ui-state-disabled") ? ("string" == typeof t ? c[t] : t).apply(c, arguments) : void 0
                }
                "string" != typeof t && (i.guid = t.guid = t.guid || i.guid || C.guid++);
                var n = e.match(/^([\w:-]*)\s*(.*)$/),
                    s = n[1] + c.eventNamespace,
                    o = n[2];
                o ? l.on(s, o, i) : r.on(s, i)
            })
        },
        _off: function(e, t) {
            t = (t || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, e.off(t).off(t), this.bindings = C(this.bindings.not(e).get()), this.focusable = C(this.focusable.not(e).get()), this.hoverable = C(this.hoverable.not(e).get())
        },
        _delay: function(e, t) {
            var i = this;
            return setTimeout(function() {
                return ("string" == typeof e ? i[e] : e).apply(i, arguments)
            }, t || 0)
        },
        _hoverable: function(e) {
            this.hoverable = this.hoverable.add(e), this._on(e, {
                mouseenter: function(e) {
                    this._addClass(C(e.currentTarget), null, "ui-state-hover")
                },
                mouseleave: function(e) {
                    this._removeClass(C(e.currentTarget), null, "ui-state-hover")
                }
            })
        },
        _focusable: function(e) {
            this.focusable = this.focusable.add(e), this._on(e, {
                focusin: function(e) {
                    this._addClass(C(e.currentTarget), null, "ui-state-focus")
                },
                focusout: function(e) {
                    this._removeClass(C(e.currentTarget), null, "ui-state-focus")
                }
            })
        },
        _trigger: function(e, t, i) {
            var n, s, o = this.options[e];
            if (i = i || {}, (t = C.Event(t)).type = (e === this.widgetEventPrefix ? e : this.widgetEventPrefix + e).toLowerCase(), t.target = this.element[0], s = t.originalEvent)
                for (n in s) n in t || (t[n] = s[n]);
            return this.element.trigger(t, i), !(C.isFunction(o) && !1 === o.apply(this.element[0], [t].concat(i)) || t.isDefaultPrevented())
        }
    }, C.each({
        show: "fadeIn",
        hide: "fadeOut"
    }, function(o, a) {
        C.Widget.prototype["_" + o] = function(t, e, i) {
            "string" == typeof e && (e = {
                effect: e
            });
            var n, s = e ? !0 === e || "number" == typeof e ? a : e.effect || a : o;
            "number" == typeof(e = e || {}) && (e = {
                duration: e
            }), n = !C.isEmptyObject(e), e.complete = i, e.delay && t.delay(e.delay), n && C.effects && C.effects.effect[s] ? t[o](e) : s !== o && t[s] ? t[s](e.duration, e.easing, i) : t.queue(function(e) {
                C(this)[o](), i && i.call(t[0]), e()
            })
        }
    }), C.widget, x = Math.max, k = Math.abs, a = /left|center|right/, r = /top|center|bottom/, l = /[\+\-]\d+(\.[\d]+)?%?/, c = /^\w+/, h = /%$/, D = C.fn.position, C.position = {
        scrollbarWidth: function() {
            if (void 0 !== s) return s;
            var e, t, i = C("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                n = i.children()[0];
            return C("body").append(i), e = n.offsetWidth, i.css("overflow", "scroll"), e === (t = n.offsetWidth) && (t = i[0].clientWidth), i.remove(), s = e - t
        },
        getScrollInfo: function(e) {
            var t = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"),
                i = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"),
                n = "scroll" === t || "auto" === t && e.width < e.element[0].scrollWidth;
            return {
                width: "scroll" === i || "auto" === i && e.height < e.element[0].scrollHeight ? C.position.scrollbarWidth() : 0,
                height: n ? C.position.scrollbarWidth() : 0
            }
        },
        getWithinInfo: function(e) {
            var t = C(e || window),
                i = C.isWindow(t[0]),
                n = !!t[0] && 9 === t[0].nodeType;
            return {
                element: t,
                isWindow: i,
                isDocument: n,
                offset: i || n ? {
                    left: 0,
                    top: 0
                } : C(e).offset(),
                scrollLeft: t.scrollLeft(),
                scrollTop: t.scrollTop(),
                width: t.outerWidth(),
                height: t.outerHeight()
            }
        }
    }, C.fn.position = function(u) {
        if (!u || !u.of) return D.apply(this, arguments);
        u = C.extend({}, u);
        var d, p, f, m, g, e, t, i, v = C(u.of),
            b = C.position.getWithinInfo(u.within),
            _ = C.position.getScrollInfo(b),
            y = (u.collision || "flip").split(" "),
            w = {};
        return e = 9 === (i = (t = v)[0]).nodeType ? {
            width: t.width(),
            height: t.height(),
            offset: {
                top: 0,
                left: 0
            }
        } : C.isWindow(i) ? {
            width: t.width(),
            height: t.height(),
            offset: {
                top: t.scrollTop(),
                left: t.scrollLeft()
            }
        } : i.preventDefault ? {
            width: 0,
            height: 0,
            offset: {
                top: i.pageY,
                left: i.pageX
            }
        } : {
            width: t.outerWidth(),
            height: t.outerHeight(),
            offset: t.offset()
        }, v[0].preventDefault && (u.at = "left top"), p = e.width, f = e.height, m = e.offset, g = C.extend({}, m), C.each(["my", "at"], function() {
            var e, t, i = (u[this] || "").split(" ");
            1 === i.length && (i = a.test(i[0]) ? i.concat(["center"]) : r.test(i[0]) ? ["center"].concat(i) : ["center", "center"]), i[0] = a.test(i[0]) ? i[0] : "center", i[1] = r.test(i[1]) ? i[1] : "center", e = l.exec(i[0]), t = l.exec(i[1]), w[this] = [e ? e[0] : 0, t ? t[0] : 0], u[this] = [c.exec(i[0])[0], c.exec(i[1])[0]]
        }), 1 === y.length && (y[1] = y[0]), "right" === u.at[0] ? g.left += p : "center" === u.at[0] && (g.left += p / 2), "bottom" === u.at[1] ? g.top += f : "center" === u.at[1] && (g.top += f / 2), d = T(w.at, p, f), g.left += d[0], g.top += d[1], this.each(function() {
            var i, e, a = C(this),
                r = a.outerWidth(),
                l = a.outerHeight(),
                t = S(this, "marginLeft"),
                n = S(this, "marginTop"),
                s = r + t + S(this, "marginRight") + _.width,
                o = l + n + S(this, "marginBottom") + _.height,
                c = C.extend({}, g),
                h = T(w.my, a.outerWidth(), a.outerHeight());
            "right" === u.my[0] ? c.left -= r : "center" === u.my[0] && (c.left -= r / 2), "bottom" === u.my[1] ? c.top -= l : "center" === u.my[1] && (c.top -= l / 2), c.left += h[0], c.top += h[1], i = {
                marginLeft: t,
                marginTop: n
            }, C.each(["left", "top"], function(e, t) {
                C.ui.position[y[e]] && C.ui.position[y[e]][t](c, {
                    targetWidth: p,
                    targetHeight: f,
                    elemWidth: r,
                    elemHeight: l,
                    collisionPosition: i,
                    collisionWidth: s,
                    collisionHeight: o,
                    offset: [d[0] + h[0], d[1] + h[1]],
                    my: u.my,
                    at: u.at,
                    within: b,
                    elem: a
                })
            }), u.using && (e = function(e) {
                var t = m.left - c.left,
                    i = t + p - r,
                    n = m.top - c.top,
                    s = n + f - l,
                    o = {
                        target: {
                            element: v,
                            left: m.left,
                            top: m.top,
                            width: p,
                            height: f
                        },
                        element: {
                            element: a,
                            left: c.left,
                            top: c.top,
                            width: r,
                            height: l
                        },
                        horizontal: i < 0 ? "left" : 0 < t ? "right" : "center",
                        vertical: s < 0 ? "top" : 0 < n ? "bottom" : "middle"
                    };
                p < r && p > k(t + i) && (o.horizontal = "center"), f < l && f > k(n + s) && (o.vertical = "middle"), o.important = x(k(t), k(i)) > x(k(n), k(s)) ? "horizontal" : "vertical", u.using.call(this, e, o)
            }), a.offset(C.extend(c, {
                using: e
            }))
        })
    }, C.ui.position = {
        fit: {
            left: function(e, t) {
                var i, n = t.within,
                    s = n.isWindow ? n.scrollLeft : n.offset.left,
                    o = n.width,
                    a = e.left - t.collisionPosition.marginLeft,
                    r = s - a,
                    l = a + t.collisionWidth - o - s;
                t.collisionWidth > o ? 0 < r && l <= 0 ? (i = e.left + r + t.collisionWidth - o - s, e.left += r - i) : e.left = 0 < l && r <= 0 ? s : l < r ? s + o - t.collisionWidth : s : 0 < r ? e.left += r : 0 < l ? e.left -= l : e.left = x(e.left - a, e.left)
            },
            top: function(e, t) {
                var i, n = t.within,
                    s = n.isWindow ? n.scrollTop : n.offset.top,
                    o = t.within.height,
                    a = e.top - t.collisionPosition.marginTop,
                    r = s - a,
                    l = a + t.collisionHeight - o - s;
                t.collisionHeight > o ? 0 < r && l <= 0 ? (i = e.top + r + t.collisionHeight - o - s, e.top += r - i) : e.top = 0 < l && r <= 0 ? s : l < r ? s + o - t.collisionHeight : s : 0 < r ? e.top += r : 0 < l ? e.top -= l : e.top = x(e.top - a, e.top)
            }
        },
        flip: {
            left: function(e, t) {
                var i, n, s = t.within,
                    o = s.offset.left + s.scrollLeft,
                    a = s.width,
                    r = s.isWindow ? s.scrollLeft : s.offset.left,
                    l = e.left - t.collisionPosition.marginLeft,
                    c = l - r,
                    h = l + t.collisionWidth - a - r,
                    u = "left" === t.my[0] ? -t.elemWidth : "right" === t.my[0] ? t.elemWidth : 0,
                    d = "left" === t.at[0] ? t.targetWidth : "right" === t.at[0] ? -t.targetWidth : 0,
                    p = -2 * t.offset[0];
                c < 0 ? ((i = e.left + u + d + p + t.collisionWidth - a - o) < 0 || k(c) > i) && (e.left += u + d + p) : 0 < h && (0 < (n = e.left - t.collisionPosition.marginLeft + u + d + p - r) || h > k(n)) && (e.left += u + d + p)
            },
            top: function(e, t) {
                var i, n, s = t.within,
                    o = s.offset.top + s.scrollTop,
                    a = s.height,
                    r = s.isWindow ? s.scrollTop : s.offset.top,
                    l = e.top - t.collisionPosition.marginTop,
                    c = l - r,
                    h = l + t.collisionHeight - a - r,
                    u = "top" === t.my[1] ? -t.elemHeight : "bottom" === t.my[1] ? t.elemHeight : 0,
                    d = "top" === t.at[1] ? t.targetHeight : "bottom" === t.at[1] ? -t.targetHeight : 0,
                    p = -2 * t.offset[1];
                c < 0 ? ((n = e.top + u + d + p + t.collisionHeight - a - o) < 0 || k(c) > n) && (e.top += u + d + p) : 0 < h && (0 < (i = e.top - t.collisionPosition.marginTop + u + d + p - r) || h > k(i)) && (e.top += u + d + p)
            }
        },
        flipfit: {
            left: function() {
                C.ui.position.flip.left.apply(this, arguments), C.ui.position.fit.left.apply(this, arguments)
            },
            top: function() {
                C.ui.position.flip.top.apply(this, arguments), C.ui.position.fit.top.apply(this, arguments)
            }
        }
    }, C.ui.position, C.extend(C.expr[":"], {
        data: C.expr.createPseudo ? C.expr.createPseudo(function(t) {
            return function(e) {
                return !!C.data(e, t)
            }
        }) : function(e, t, i) {
            return !!C.data(e, i[3])
        }
    }), C.fn.extend({
        disableSelection: (n = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown", function() {
            return this.on(n + ".ui-disableSelection", function(e) {
                e.preventDefault()
            })
        }),
        enableSelection: function() {
            return this.off(".ui-disableSelection")
        }
    });
    var m, g, v, b, _, y, w, I, E, A, N, M, O, P, H, z, L, $, F, W, j, R, B, q = "ui-effects-",
        U = "ui-effects-style",
        V = "ui-effects-animated",
        Y = C;

    function K(e, t, i, n) {
        return C.isPlainObject(e) && (e = (t = e).effect), e = {
            effect: e
        }, null == t && (t = {}), C.isFunction(t) && (n = t, i = null, t = {}), "number" != typeof t && !C.fx.speeds[t] || (n = i, i = t, t = {}), C.isFunction(i) && (n = i, i = null), t && C.extend(e, t), i = i || t.duration, e.duration = C.fx.off ? 0 : "number" == typeof i ? i : i in C.fx.speeds ? C.fx.speeds[i] : C.fx.speeds._default, e.complete = n || t.complete, e
    }

    function G(e) {
        return !(e && "number" != typeof e && !C.fx.speeds[e]) || "string" == typeof e && !C.effects.effect[e] || !!C.isFunction(e) || "object" == typeof e && !e.effect
    }

    function X(e, t) {
        var i = t.outerWidth(),
            n = t.outerHeight(),
            s = /^rect\((-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto)\)$/.exec(e) || ["", 0, i, n, 0];
        return {
            top: parseFloat(s[1]) || 0,
            right: "auto" === s[2] ? i : parseFloat(s[2]),
            bottom: "auto" === s[3] ? n : parseFloat(s[3]),
            left: parseFloat(s[4]) || 0
        }
    }

    function Q(e) {
        var t, i, n = e.ownerDocument.defaultView ? e.ownerDocument.defaultView.getComputedStyle(e, null) : e.currentStyle,
            s = {};
        if (n && n.length && n[0] && n[n[0]])
            for (i = n.length; i--;) "string" == typeof n[t = n[i]] && (s[C.camelCase(t)] = n[t]);
        else
            for (t in n) "string" == typeof n[t] && (s[t] = n[t]);
        return s
    }

    function J(e, t, i) {
        var n = $[t.type] || {};
        return null == e ? i || !t.def ? null : t.def : (e = n.floor ? ~~e : parseFloat(e), isNaN(e) ? t.def : n.mod ? (e + n.mod) % n.mod : e < 0 ? 0 : e > n.max ? n.max : e)
    }

    function Z(a) {
        var r = z(),
            l = r._rgba = [];
        return a = a.toLowerCase(), j(H, function(e, t) {
            var i, n = t.re.exec(a),
                s = n && t.parse(n),
                o = t.space || "rgba";
            return s ? (i = r[o](s), r[L[o].cache] = i[L[o].cache], l = r._rgba = i._rgba, !1) : M
        }), l.length ? ("0,0,0,0" === l.join() && N.extend(l, O.transparent), r) : O[a]
    }

    function ee(e, t, i) {
        return 6 * (i = (i + 1) % 1) < 1 ? e + 6 * (t - e) * i : 2 * i < 1 ? t : 3 * i < 2 ? e + 6 * (t - e) * (2 / 3 - i) : e
    }
    C.effects = {
        effect: {}
    }, P = /^([\-+])=\s*(\d+\.?\d*)/, H = [{
        re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
        parse: function(e) {
            return [e[1], e[2], e[3], e[4]]
        }
    }, {
        re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
        parse: function(e) {
            return [2.55 * e[1], 2.55 * e[2], 2.55 * e[3], e[4]]
        }
    }, {
        re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,
        parse: function(e) {
            return [parseInt(e[1], 16), parseInt(e[2], 16), parseInt(e[3], 16)]
        }
    }, {
        re: /#([a-f0-9])([a-f0-9])([a-f0-9])/,
        parse: function(e) {
            return [parseInt(e[1] + e[1], 16), parseInt(e[2] + e[2], 16), parseInt(e[3] + e[3], 16)]
        }
    }, {
        re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
        space: "hsla",
        parse: function(e) {
            return [e[1], e[2] / 100, e[3] / 100, e[4]]
        }
    }], z = (N = Y).Color = function(e, t, i, n) {
        return new N.Color.fn.parse(e, t, i, n)
    }, L = {
        rgba: {
            props: {
                red: {
                    idx: 0,
                    type: "byte"
                },
                green: {
                    idx: 1,
                    type: "byte"
                },
                blue: {
                    idx: 2,
                    type: "byte"
                }
            }
        },
        hsla: {
            props: {
                hue: {
                    idx: 0,
                    type: "degrees"
                },
                saturation: {
                    idx: 1,
                    type: "percent"
                },
                lightness: {
                    idx: 2,
                    type: "percent"
                }
            }
        }
    }, $ = {
        byte: {
            floor: !0,
            max: 255
        },
        percent: {
            max: 1
        },
        degrees: {
            mod: 360,
            floor: !0
        }
    }, F = z.support = {}, W = N("<p>")[0], j = N.each, W.style.cssText = "background-color:rgba(1,1,1,.5)", F.rgba = -1 < W.style.backgroundColor.indexOf("rgba"), j(L, function(e, t) {
        t.cache = "_" + e, t.props.alpha = {
            idx: 3,
            type: "percent",
            def: 1
        }
    }), z.fn = N.extend(z.prototype, {
        parse: function(s, e, t, i) {
            if (s === M) return this._rgba = [null, null, null, null], this;
            (s.jquery || s.nodeType) && (s = N(s).css(e), e = M);
            var o = this,
                n = N.type(s),
                a = this._rgba = [];
            return e !== M && (s = [s, e, t, i], n = "array"), "string" === n ? this.parse(Z(s) || O._default) : "array" === n ? (j(L.rgba.props, function(e, t) {
                a[t.idx] = J(s[t.idx], t)
            }), this) : "object" === n ? (j(L, s instanceof z ? function(e, t) {
                s[t.cache] && (o[t.cache] = s[t.cache].slice())
            } : function(e, i) {
                var n = i.cache;
                j(i.props, function(e, t) {
                    if (!o[n] && i.to) {
                        if ("alpha" === e || null == s[e]) return;
                        o[n] = i.to(o._rgba)
                    }
                    o[n][t.idx] = J(s[e], t, !0)
                }), o[n] && N.inArray(null, o[n].slice(0, 3)) < 0 && (o[n][3] = 1, i.from && (o._rgba = i.from(o[n])))
            }), this) : M
        },
        is: function(e) {
            var s = z(e),
                o = !0,
                a = this;
            return j(L, function(e, t) {
                var i, n = s[t.cache];
                return n && (i = a[t.cache] || t.to && t.to(a._rgba) || [], j(t.props, function(e, t) {
                    return null != n[t.idx] ? o = n[t.idx] === i[t.idx] : M
                })), o
            }), o
        },
        _space: function() {
            var i = [],
                n = this;
            return j(L, function(e, t) {
                n[t.cache] && i.push(e)
            }), i.pop()
        },
        transition: function(e, a) {
            var r = z(e),
                t = r._space(),
                i = L[t],
                n = 0 === this.alpha() ? z("transparent") : this,
                l = n[i.cache] || i.to(n._rgba),
                c = l.slice();
            return r = r[i.cache], j(i.props, function(e, t) {
                var i = t.idx,
                    n = l[i],
                    s = r[i],
                    o = $[t.type] || {};
                null !== s && (null === n ? c[i] = s : (o.mod && (s - n > o.mod / 2 ? n += o.mod : n - s > o.mod / 2 && (n -= o.mod)), c[i] = J((s - n) * a + n, t)))
            }), this[t](c)
        },
        blend: function(e) {
            if (1 === this._rgba[3]) return this;
            var t = this._rgba.slice(),
                i = t.pop(),
                n = z(e)._rgba;
            return z(N.map(t, function(e, t) {
                return (1 - i) * n[t] + i * e
            }))
        },
        toRgbaString: function() {
            var e = "rgba(",
                t = N.map(this._rgba, function(e, t) {
                    return null == e ? 2 < t ? 1 : 0 : e
                });
            return 1 === t[3] && (t.pop(), e = "rgb("), e + t.join() + ")"
        },
        toHslaString: function() {
            var e = "hsla(",
                t = N.map(this.hsla(), function(e, t) {
                    return null == e && (e = 2 < t ? 1 : 0), t && t < 3 && (e = Math.round(100 * e) + "%"), e
                });
            return 1 === t[3] && (t.pop(), e = "hsl("), e + t.join() + ")"
        },
        toHexString: function(e) {
            var t = this._rgba.slice(),
                i = t.pop();
            return e && t.push(~~(255 * i)), "#" + N.map(t, function(e) {
                return 1 === (e = (e || 0).toString(16)).length ? "0" + e : e
            }).join("")
        },
        toString: function() {
            return 0 === this._rgba[3] ? "transparent" : this.toRgbaString()
        }
    }), z.fn.parse.prototype = z.fn, L.hsla.to = function(e) {
        if (null == e[0] || null == e[1] || null == e[2]) return [null, null, null, e[3]];
        var t, i, n = e[0] / 255,
            s = e[1] / 255,
            o = e[2] / 255,
            a = e[3],
            r = Math.max(n, s, o),
            l = Math.min(n, s, o),
            c = r - l,
            h = r + l,
            u = .5 * h;
        return t = l === r ? 0 : n === r ? 60 * (s - o) / c + 360 : s === r ? 60 * (o - n) / c + 120 : 60 * (n - s) / c + 240, i = 0 == c ? 0 : u <= .5 ? c / h : c / (2 - h), [Math.round(t) % 360, i, u, null == a ? 1 : a]
    }, L.hsla.from = function(e) {
        if (null == e[0] || null == e[1] || null == e[2]) return [null, null, null, e[3]];
        var t = e[0] / 360,
            i = e[1],
            n = e[2],
            s = e[3],
            o = n <= .5 ? n * (1 + i) : n + i - n * i,
            a = 2 * n - o;
        return [Math.round(255 * ee(a, o, t + 1 / 3)), Math.round(255 * ee(a, o, t)), Math.round(255 * ee(a, o, t - 1 / 3)), s]
    }, j(L, function(l, e) {
        var i = e.props,
            a = e.cache,
            r = e.to,
            c = e.from;
        z.fn[l] = function(e) {
            if (r && !this[a] && (this[a] = r(this._rgba)), e === M) return this[a].slice();
            var t, n = N.type(e),
                s = "array" === n || "object" === n ? e : arguments,
                o = this[a].slice();
            return j(i, function(e, t) {
                var i = s["object" === n ? e : t.idx];
                null == i && (i = o[t.idx]), o[t.idx] = J(i, t)
            }), c ? ((t = z(c(o)))[a] = o, t) : z(o)
        }, j(i, function(a, r) {
            z.fn[a] || (z.fn[a] = function(e) {
                var t, i = N.type(e),
                    n = "alpha" === a ? this._hsla ? "hsla" : "rgba" : l,
                    s = this[n](),
                    o = s[r.idx];
                return "undefined" === i ? o : ("function" === i && (e = e.call(this, o), i = N.type(e)), null == e && r.empty ? this : ("string" === i && (t = P.exec(e)) && (e = o + parseFloat(t[2]) * ("+" === t[1] ? 1 : -1)), s[r.idx] = e, this[n](s)))
            })
        })
    }), z.hook = function(e) {
        var t = e.split(" ");
        j(t, function(e, o) {
            N.cssHooks[o] = {
                set: function(e, t) {
                    var i, n, s = "";
                    if ("transparent" !== t && ("string" !== N.type(t) || (i = Z(t)))) {
                        if (t = z(i || t), !F.rgba && 1 !== t._rgba[3]) {
                            for (n = "backgroundColor" === o ? e.parentNode : e;
                                ("" === s || "transparent" === s) && n && n.style;) try {
                                s = N.css(n, "backgroundColor"), n = n.parentNode
                            } catch (e) {}
                            t = t.blend(s && "transparent" !== s ? s : "_default")
                        }
                        t = t.toRgbaString()
                    }
                    try {
                        e.style[o] = t
                    } catch (e) {}
                }
            }, N.fx.step[o] = function(e) {
                e.colorInit || (e.start = z(e.elem, o), e.end = z(e.end), e.colorInit = !0), N.cssHooks[o].set(e.elem, e.start.transition(e.end, e.pos))
            }
        })
    }, z.hook("backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor"), N.cssHooks.borderColor = {
        expand: function(i) {
            var n = {};
            return j(["Top", "Right", "Bottom", "Left"], function(e, t) {
                n["border" + t + "Color"] = i
            }), n
        }
    }, O = N.Color.names = {
        aqua: "#00ffff",
        black: "#000000",
        blue: "#0000ff",
        fuchsia: "#ff00ff",
        gray: "#808080",
        green: "#008000",
        lime: "#00ff00",
        maroon: "#800000",
        navy: "#000080",
        olive: "#808000",
        purple: "#800080",
        red: "#ff0000",
        silver: "#c0c0c0",
        teal: "#008080",
        white: "#ffffff",
        yellow: "#ffff00",
        transparent: [null, null, null, 0],
        _default: "#ffffff"
    }, E = ["add", "remove", "toggle"], A = {
        border: 1,
        borderBottom: 1,
        borderColor: 1,
        borderLeft: 1,
        borderRight: 1,
        borderTop: 1,
        borderWidth: 1,
        margin: 1,
        padding: 1
    }, C.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], function(e, t) {
        C.fx.step[t] = function(e) {
            ("none" !== e.end && !e.setAttr || 1 === e.pos && !e.setAttr) && (Y.style(e.elem, t, e.end), e.setAttr = !0)
        }
    }), C.fn.addBack || (C.fn.addBack = function(e) {
        return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
    }), C.effects.animateClass = function(s, e, t, i) {
        var o = C.speed(e, t, i);
        return this.queue(function() {
            var e, i = C(this),
                t = i.attr("class") || "",
                n = o.children ? i.find("*").addBack() : i;
            n = n.map(function() {
                return {
                    el: C(this),
                    start: Q(this)
                }
            }), (e = function() {
                C.each(E, function(e, t) {
                    s[t] && i[t + "Class"](s[t])
                })
            })(), n = n.map(function() {
                return this.end = Q(this.el[0]), this.diff = function(e, t) {
                    var i, n, s = {};
                    for (i in t) n = t[i], e[i] !== n && (A[i] || !C.fx.step[i] && isNaN(parseFloat(n)) || (s[i] = n));
                    return s
                }(this.start, this.end), this
            }), i.attr("class", t), n = n.map(function() {
                var e = this,
                    t = C.Deferred(),
                    i = C.extend({}, o, {
                        queue: !1,
                        complete: function() {
                            t.resolve(e)
                        }
                    });
                return this.el.animate(this.diff, i), t.promise()
            }), C.when.apply(C, n.get()).done(function() {
                e(), C.each(arguments, function() {
                    var t = this.el;
                    C.each(this.diff, function(e) {
                        t.css(e, "")
                    })
                }), o.complete.call(i[0])
            })
        })
    }, C.fn.extend({
        addClass: (I = C.fn.addClass, function(e, t, i, n) {
            return t ? C.effects.animateClass.call(this, {
                add: e
            }, t, i, n) : I.apply(this, arguments)
        }),
        removeClass: (w = C.fn.removeClass, function(e, t, i, n) {
            return 1 < arguments.length ? C.effects.animateClass.call(this, {
                remove: e
            }, t, i, n) : w.apply(this, arguments)
        }),
        toggleClass: (y = C.fn.toggleClass, function(e, t, i, n, s) {
            return "boolean" == typeof t || void 0 === t ? i ? C.effects.animateClass.call(this, t ? {
                add: e
            } : {
                remove: e
            }, i, n, s) : y.apply(this, arguments) : C.effects.animateClass.call(this, {
                toggle: e
            }, t, i, n)
        }),
        switchClass: function(e, t, i, n, s) {
            return C.effects.animateClass.call(this, {
                add: t,
                remove: e
            }, i, n, s)
        }
    }), C.expr && C.expr.filters && C.expr.filters.animated && (C.expr.filters.animated = (_ = C.expr.filters.animated, function(e) {
        return !!C(e).data(V) || _(e)
    })), !1 !== C.uiBackCompat && C.extend(C.effects, {
        save: function(e, t) {
            for (var i = 0, n = t.length; i < n; i++) null !== t[i] && e.data(q + t[i], e[0].style[t[i]])
        },
        restore: function(e, t) {
            for (var i, n = 0, s = t.length; n < s; n++) null !== t[n] && (i = e.data(q + t[n]), e.css(t[n], i))
        },
        setMode: function(e, t) {
            return "toggle" === t && (t = e.is(":hidden") ? "show" : "hide"), t
        },
        createWrapper: function(i) {
            if (i.parent().is(".ui-effects-wrapper")) return i.parent();
            var n = {
                    width: i.outerWidth(!0),
                    height: i.outerHeight(!0),
                    float: i.css("float")
                },
                e = C("<div></div>").addClass("ui-effects-wrapper").css({
                    fontSize: "100%",
                    background: "transparent",
                    border: "none",
                    margin: 0,
                    padding: 0
                }),
                t = {
                    width: i.width(),
                    height: i.height()
                },
                s = document.activeElement;
            try {
                s.id
            } catch (e) {
                s = document.body
            }
            return i.wrap(e), i[0] !== s && !C.contains(i[0], s) || C(s).trigger("focus"), e = i.parent(), "static" === i.css("position") ? (e.css({
                position: "relative"
            }), i.css({
                position: "relative"
            })) : (C.extend(n, {
                position: i.css("position"),
                zIndex: i.css("z-index")
            }), C.each(["top", "left", "bottom", "right"], function(e, t) {
                n[t] = i.css(t), isNaN(parseInt(n[t], 10)) && (n[t] = "auto")
            }), i.css({
                position: "relative",
                top: 0,
                left: 0,
                right: "auto",
                bottom: "auto"
            })), i.css(t), e.css(n).show()
        },
        removeWrapper: function(e) {
            var t = document.activeElement;
            return e.parent().is(".ui-effects-wrapper") && (e.parent().replaceWith(e), e[0] !== t && !C.contains(e[0], t) || C(t).trigger("focus")), e
        }
    }), C.extend(C.effects, {
        version: "1.12.1",
        define: function(e, t, i) {
            return i || (i = t, t = "effect"), C.effects.effect[e] = i, C.effects.effect[e].mode = t, i
        },
        scaledDimensions: function(e, t, i) {
            if (0 === t) return {
                height: 0,
                width: 0,
                outerHeight: 0,
                outerWidth: 0
            };
            var n = "horizontal" !== i ? (t || 100) / 100 : 1,
                s = "vertical" !== i ? (t || 100) / 100 : 1;
            return {
                height: e.height() * s,
                width: e.width() * n,
                outerHeight: e.outerHeight() * s,
                outerWidth: e.outerWidth() * n
            }
        },
        clipToBox: function(e) {
            return {
                width: e.clip.right - e.clip.left,
                height: e.clip.bottom - e.clip.top,
                left: e.clip.left,
                top: e.clip.top
            }
        },
        unshift: function(e, t, i) {
            var n = e.queue();
            1 < t && n.splice.apply(n, [1, 0].concat(n.splice(t, i))), e.dequeue()
        },
        saveStyle: function(e) {
            e.data(U, e[0].style.cssText)
        },
        restoreStyle: function(e) {
            e[0].style.cssText = e.data(U) || "", e.removeData(U)
        },
        mode: function(e, t) {
            var i = e.is(":hidden");
            return "toggle" === t && (t = i ? "show" : "hide"), (i ? "hide" === t : "show" === t) && (t = "none"), t
        },
        getBaseline: function(e, t) {
            var i, n;
            switch (e[0]) {
                case "top":
                    i = 0;
                    break;
                case "middle":
                    i = .5;
                    break;
                case "bottom":
                    i = 1;
                    break;
                default:
                    i = e[0] / t.height
            }
            switch (e[1]) {
                case "left":
                    n = 0;
                    break;
                case "center":
                    n = .5;
                    break;
                case "right":
                    n = 1;
                    break;
                default:
                    n = e[1] / t.width
            }
            return {
                x: n,
                y: i
            }
        },
        createPlaceholder: function(e) {
            var t, i = e.css("position"),
                n = e.position();
            return e.css({
                marginTop: e.css("marginTop"),
                marginBottom: e.css("marginBottom"),
                marginLeft: e.css("marginLeft"),
                marginRight: e.css("marginRight")
            }).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()), /^(static|relative)/.test(i) && (i = "absolute", t = C("<" + e[0].nodeName + ">").insertAfter(e).css({
                display: /^(inline|ruby)/.test(e.css("display")) ? "inline-block" : "block",
                visibility: "hidden",
                marginTop: e.css("marginTop"),
                marginBottom: e.css("marginBottom"),
                marginLeft: e.css("marginLeft"),
                marginRight: e.css("marginRight"),
                float: e.css("float")
            }).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()).addClass("ui-effects-placeholder"), e.data(q + "placeholder", t)), e.css({
                position: i,
                left: n.left,
                top: n.top
            }), t
        },
        removePlaceholder: function(e) {
            var t = q + "placeholder",
                i = e.data(t);
            i && (i.remove(), e.removeData(t))
        },
        cleanUp: function(e) {
            C.effects.restoreStyle(e), C.effects.removePlaceholder(e)
        },
        setTransition: function(n, e, s, o) {
            return o = o || {}, C.each(e, function(e, t) {
                var i = n.cssUnit(t);
                0 < i[0] && (o[t] = i[0] * s + i[1])
            }), o
        }
    }), C.fn.extend({
        effect: function() {
            function e(e) {
                function t() {
                    C.isFunction(r) && r.call(i[0]), C.isFunction(e) && e()
                }
                var i = C(this);
                n.mode = c.shift(), !1 === C.uiBackCompat || o ? "none" === n.mode ? (i[l](), t()) : s.call(i[0], n, function() {
                    i.removeData(V), C.effects.cleanUp(i), "hide" === n.mode && i.hide(), t()
                }) : (i.is(":hidden") ? "hide" === l : "show" === l) ? (i[l](), t()) : s.call(i[0], n, t)
            }

            function t(e) {
                var t = C(this),
                    i = C.effects.mode(t, l) || o;
                t.data(V, !0), c.push(i), o && ("show" === i || i === o && "hide" === i) && t.show(), o && "none" === i || C.effects.saveStyle(t), C.isFunction(e) && e()
            }
            var n = K.apply(this, arguments),
                s = C.effects.effect[n.effect],
                o = s.mode,
                i = n.queue,
                a = i || "fx",
                r = n.complete,
                l = n.mode,
                c = [];
            return C.fx.off || !s ? l ? this[l](n.duration, r) : this.each(function() {
                r && r.call(this)
            }) : !1 === i ? this.each(t).each(e) : this.queue(a, t).queue(a, e)
        },
        show: (b = C.fn.show, function(e) {
            if (G(e)) return b.apply(this, arguments);
            var t = K.apply(this, arguments);
            return t.mode = "show", this.effect.call(this, t)
        }),
        hide: (v = C.fn.hide, function(e) {
            if (G(e)) return v.apply(this, arguments);
            var t = K.apply(this, arguments);
            return t.mode = "hide", this.effect.call(this, t)
        }),
        toggle: (g = C.fn.toggle, function(e) {
            if (G(e) || "boolean" == typeof e) return g.apply(this, arguments);
            var t = K.apply(this, arguments);
            return t.mode = "toggle", this.effect.call(this, t)
        }),
        cssUnit: function(e) {
            var i = this.css(e),
                n = [];
            return C.each(["em", "px", "%", "pt"], function(e, t) {
                0 < i.indexOf(t) && (n = [parseFloat(i), t])
            }), n
        },
        cssClip: function(e) {
            return e ? this.css("clip", "rect(" + e.top + "px " + e.right + "px " + e.bottom + "px " + e.left + "px)") : X(this.css("clip"), this)
        },
        transfer: function(e, t) {
            var i = C(this),
                n = C(e.to),
                s = "fixed" === n.css("position"),
                o = C("body"),
                a = s ? o.scrollTop() : 0,
                r = s ? o.scrollLeft() : 0,
                l = n.offset(),
                c = {
                    top: l.top - a,
                    left: l.left - r,
                    height: n.innerHeight(),
                    width: n.innerWidth()
                },
                h = i.offset(),
                u = C("<div class='ui-effects-transfer'></div>").appendTo("body").addClass(e.className).css({
                    top: h.top - a,
                    left: h.left - r,
                    height: i.innerHeight(),
                    width: i.innerWidth(),
                    position: s ? "fixed" : "absolute"
                }).animate(c, e.duration, e.easing, function() {
                    u.remove(), C.isFunction(t) && t()
                })
        }
    }), C.fx.step.clip = function(e) {
        e.clipInit || (e.start = C(e.elem).cssClip(), "string" == typeof e.end && (e.end = X(e.end, e.elem)), e.clipInit = !0), C(e.elem).cssClip({
            top: e.pos * (e.end.top - e.start.top) + e.start.top,
            right: e.pos * (e.end.right - e.start.right) + e.start.right,
            bottom: e.pos * (e.end.bottom - e.start.bottom) + e.start.bottom,
            left: e.pos * (e.end.left - e.start.left) + e.start.left
        })
    }, m = {}, C.each(["Quad", "Cubic", "Quart", "Quint", "Expo"], function(t, e) {
        m[e] = function(e) {
            return Math.pow(e, t + 2)
        }
    }), C.extend(m, {
        Sine: function(e) {
            return 1 - Math.cos(e * Math.PI / 2)
        },
        Circ: function(e) {
            return 1 - Math.sqrt(1 - e * e)
        },
        Elastic: function(e) {
            return 0 === e || 1 === e ? e : -Math.pow(2, 8 * (e - 1)) * Math.sin((80 * (e - 1) - 7.5) * Math.PI / 15)
        },
        Back: function(e) {
            return e * e * (3 * e - 2)
        },
        Bounce: function(e) {
            for (var t, i = 4;
                ((t = Math.pow(2, --i)) - 1) / 11 > e;);
            return 1 / Math.pow(4, 3 - i) - 7.5625 * Math.pow((3 * t - 2) / 22 - e, 2)
        }
    }), C.each(m, function(e, t) {
        C.easing["easeIn" + e] = t, C.easing["easeOut" + e] = function(e) {
            return 1 - t(1 - e)
        }, C.easing["easeInOut" + e] = function(e) {
            return e < .5 ? t(2 * e) / 2 : 1 - t(-2 * e + 2) / 2
        }
    }), C.effects, C.effects.define("blind", "hide", function(e, t) {
        var i = {
                up: ["bottom", "top"],
                vertical: ["bottom", "top"],
                down: ["top", "bottom"],
                left: ["right", "left"],
                horizontal: ["right", "left"],
                right: ["left", "right"]
            },
            n = C(this),
            s = e.direction || "up",
            o = n.cssClip(),
            a = {
                clip: C.extend({}, o)
            },
            r = C.effects.createPlaceholder(n);
        a.clip[i[s][0]] = a.clip[i[s][1]], "show" === e.mode && (n.cssClip(a.clip), r && r.css(C.effects.clipToBox(a)), a.clip = o), r && r.animate(C.effects.clipToBox(a), e.duration, e.easing), n.animate(a, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: t
        })
    }), C.effects.define("bounce", function(e, t) {
        var i, n, s, o = C(this),
            a = e.mode,
            r = "hide" === a,
            l = "show" === a,
            c = e.direction || "up",
            h = e.distance,
            u = e.times || 5,
            d = 2 * u + (l || r ? 1 : 0),
            p = e.duration / d,
            f = e.easing,
            m = "up" === c || "down" === c ? "top" : "left",
            g = "up" === c || "left" === c,
            v = 0,
            b = o.queue().length;
        for (C.effects.createPlaceholder(o), s = o.css(m), h = h || o["top" == m ? "outerHeight" : "outerWidth"]() / 3, l && ((n = {
                opacity: 1
            })[m] = s, o.css("opacity", 0).css(m, g ? 2 * -h : 2 * h).animate(n, p, f)), r && (h /= Math.pow(2, u - 1)), (n = {})[m] = s; v < u; v++)(i = {})[m] = (g ? "-=" : "+=") + h, o.animate(i, p, f).animate(n, p, f), h = r ? 2 * h : h / 2;
        r && ((i = {
            opacity: 0
        })[m] = (g ? "-=" : "+=") + h, o.animate(i, p, f)), o.queue(t), C.effects.unshift(o, b, 1 + d)
    }), C.effects.define("clip", "hide", function(e, t) {
        var i, n = {},
            s = C(this),
            o = e.direction || "vertical",
            a = "both" === o,
            r = a || "horizontal" === o,
            l = a || "vertical" === o;
        i = s.cssClip(), n.clip = {
            top: l ? (i.bottom - i.top) / 2 : i.top,
            right: r ? (i.right - i.left) / 2 : i.right,
            bottom: l ? (i.bottom - i.top) / 2 : i.bottom,
            left: r ? (i.right - i.left) / 2 : i.left
        }, C.effects.createPlaceholder(s), "show" === e.mode && (s.cssClip(n.clip), n.clip = i), s.animate(n, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: t
        })
    }), C.effects.define("drop", "hide", function(e, t) {
        var i, n = C(this),
            s = "show" === e.mode,
            o = e.direction || "left",
            a = "up" === o || "down" === o ? "top" : "left",
            r = "up" === o || "left" === o ? "-=" : "+=",
            l = "+=" == r ? "-=" : "+=",
            c = {
                opacity: 0
            };
        C.effects.createPlaceholder(n), i = e.distance || n["top" == a ? "outerHeight" : "outerWidth"](!0) / 2, c[a] = r + i, s && (n.css(c), c[a] = l + i, c.opacity = 1), n.animate(c, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: t
        })
    }), C.effects.define("explode", "hide", function(e, t) {
        function i() {
            g.push(this), g.length === c * h && (u.css({
                visibility: "visible"
            }), C(g).remove(), t())
        }
        var n, s, o, a, r, l, c = e.pieces ? Math.round(Math.sqrt(e.pieces)) : 3,
            h = c,
            u = C(this),
            d = "show" === e.mode,
            p = u.show().css("visibility", "hidden").offset(),
            f = Math.ceil(u.outerWidth() / h),
            m = Math.ceil(u.outerHeight() / c),
            g = [];
        for (n = 0; n < c; n++)
            for (a = p.top + n * m, l = n - (c - 1) / 2, s = 0; s < h; s++) o = p.left + s * f, r = s - (h - 1) / 2, u.clone().appendTo("body").wrap("<div></div>").css({
                position: "absolute",
                visibility: "visible",
                left: -s * f,
                top: -n * m
            }).parent().addClass("ui-effects-explode").css({
                position: "absolute",
                overflow: "hidden",
                width: f,
                height: m,
                left: o + (d ? r * f : 0),
                top: a + (d ? l * m : 0),
                opacity: d ? 0 : 1
            }).animate({
                left: o + (d ? 0 : r * f),
                top: a + (d ? 0 : l * m),
                opacity: d ? 1 : 0
            }, e.duration || 500, e.easing, i)
    }), C.effects.define("fade", "toggle", function(e, t) {
        var i = "show" === e.mode;
        C(this).css("opacity", i ? 0 : 1).animate({
            opacity: i ? 1 : 0
        }, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: t
        })
    }), C.effects.define("fold", "hide", function(t, e) {
        var i = C(this),
            n = t.mode,
            s = "show" === n,
            o = "hide" === n,
            a = t.size || 15,
            r = /([0-9]+)%/.exec(a),
            l = t.horizFirst ? ["right", "bottom"] : ["bottom", "right"],
            c = t.duration / 2,
            h = C.effects.createPlaceholder(i),
            u = i.cssClip(),
            d = {
                clip: C.extend({}, u)
            },
            p = {
                clip: C.extend({}, u)
            },
            f = [u[l[0]], u[l[1]]],
            m = i.queue().length;
        r && (a = parseInt(r[1], 10) / 100 * f[o ? 0 : 1]), d.clip[l[0]] = a, p.clip[l[0]] = a, p.clip[l[1]] = 0, s && (i.cssClip(p.clip), h && h.css(C.effects.clipToBox(p)), p.clip = u), i.queue(function(e) {
            h && h.animate(C.effects.clipToBox(d), c, t.easing).animate(C.effects.clipToBox(p), c, t.easing), e()
        }).animate(d, c, t.easing).animate(p, c, t.easing).queue(e), C.effects.unshift(i, m, 4)
    }), C.effects.define("highlight", "show", function(e, t) {
        var i = C(this),
            n = {
                backgroundColor: i.css("backgroundColor")
            };
        "hide" === e.mode && (n.opacity = 0), C.effects.saveStyle(i), i.css({
            backgroundImage: "none",
            backgroundColor: e.color || "#ffff99"
        }).animate(n, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: t
        })
    }), C.effects.define("size", function(s, t) {
        var e, o, i, n = C(this),
            a = ["fontSize"],
            r = ["borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom"],
            l = ["borderLeftWidth", "borderRightWidth", "paddingLeft", "paddingRight"],
            c = s.mode,
            h = "effect" !== c,
            u = s.scale || "both",
            d = s.origin || ["middle", "center"],
            p = n.css("position"),
            f = n.position(),
            m = C.effects.scaledDimensions(n),
            g = s.from || m,
            v = s.to || C.effects.scaledDimensions(n, 0);
        C.effects.createPlaceholder(n), "show" === c && (i = g, g = v, v = i), o = {
            from: {
                y: g.height / m.height,
                x: g.width / m.width
            },
            to: {
                y: v.height / m.height,
                x: v.width / m.width
            }
        }, "box" !== u && "both" !== u || (o.from.y !== o.to.y && (g = C.effects.setTransition(n, r, o.from.y, g), v = C.effects.setTransition(n, r, o.to.y, v)), o.from.x !== o.to.x && (g = C.effects.setTransition(n, l, o.from.x, g), v = C.effects.setTransition(n, l, o.to.x, v))), "content" !== u && "both" !== u || o.from.y === o.to.y || (g = C.effects.setTransition(n, a, o.from.y, g), v = C.effects.setTransition(n, a, o.to.y, v)), d && (e = C.effects.getBaseline(d, m), g.top = (m.outerHeight - g.outerHeight) * e.y + f.top, g.left = (m.outerWidth - g.outerWidth) * e.x + f.left, v.top = (m.outerHeight - v.outerHeight) * e.y + f.top, v.left = (m.outerWidth - v.outerWidth) * e.x + f.left), n.css(g), "content" !== u && "both" !== u || (r = r.concat(["marginTop", "marginBottom"]).concat(a), l = l.concat(["marginLeft", "marginRight"]), n.find("*[width]").each(function() {
            var e = C(this),
                t = C.effects.scaledDimensions(e),
                i = {
                    height: t.height * o.from.y,
                    width: t.width * o.from.x,
                    outerHeight: t.outerHeight * o.from.y,
                    outerWidth: t.outerWidth * o.from.x
                },
                n = {
                    height: t.height * o.to.y,
                    width: t.width * o.to.x,
                    outerHeight: t.height * o.to.y,
                    outerWidth: t.width * o.to.x
                };
            o.from.y !== o.to.y && (i = C.effects.setTransition(e, r, o.from.y, i), n = C.effects.setTransition(e, r, o.to.y, n)), o.from.x !== o.to.x && (i = C.effects.setTransition(e, l, o.from.x, i), n = C.effects.setTransition(e, l, o.to.x, n)), h && C.effects.saveStyle(e), e.css(i), e.animate(n, s.duration, s.easing, function() {
                h && C.effects.restoreStyle(e)
            })
        })), n.animate(v, {
            queue: !1,
            duration: s.duration,
            easing: s.easing,
            complete: function() {
                var e = n.offset();
                0 === v.opacity && n.css("opacity", g.opacity), h || (n.css("position", "static" === p ? "relative" : p).offset(e), C.effects.saveStyle(n)), t()
            }
        })
    }), C.effects.define("scale", function(e, t) {
        var i = C(this),
            n = e.mode,
            s = parseInt(e.percent, 10) || (0 === parseInt(e.percent, 10) ? 0 : "effect" !== n ? 0 : 100),
            o = C.extend(!0, {
                from: C.effects.scaledDimensions(i),
                to: C.effects.scaledDimensions(i, s, e.direction || "both"),
                origin: e.origin || ["middle", "center"]
            }, e);
        e.fade && (o.from.opacity = 1, o.to.opacity = 0), C.effects.effect.size.call(this, o, t)
    }), C.effects.define("puff", "hide", function(e, t) {
        var i = C.extend(!0, {}, e, {
            fade: !0,
            percent: parseInt(e.percent, 10) || 150
        });
        C.effects.effect.scale.call(this, i, t)
    }), C.effects.define("pulsate", "show", function(e, t) {
        var i = C(this),
            n = e.mode,
            s = "show" === n,
            o = s || "hide" === n,
            a = 2 * (e.times || 5) + (o ? 1 : 0),
            r = e.duration / a,
            l = 0,
            c = 1,
            h = i.queue().length;
        for (!s && i.is(":visible") || (i.css("opacity", 0).show(), l = 1); c < a; c++) i.animate({
            opacity: l
        }, r, e.easing), l = 1 - l;
        i.animate({
            opacity: l
        }, r, e.easing), i.queue(t), C.effects.unshift(i, h, 1 + a)
    }), C.effects.define("shake", function(e, t) {
        var i = 1,
            n = C(this),
            s = e.direction || "left",
            o = e.distance || 20,
            a = e.times || 3,
            r = 2 * a + 1,
            l = Math.round(e.duration / r),
            c = "up" === s || "down" === s ? "top" : "left",
            h = "up" === s || "left" === s,
            u = {},
            d = {},
            p = {},
            f = n.queue().length;
        for (C.effects.createPlaceholder(n), u[c] = (h ? "-=" : "+=") + o, d[c] = (h ? "+=" : "-=") + 2 * o, p[c] = (h ? "-=" : "+=") + 2 * o, n.animate(u, l, e.easing); i < a; i++) n.animate(d, l, e.easing).animate(p, l, e.easing);
        n.animate(d, l, e.easing).animate(u, l / 2, e.easing).queue(t), C.effects.unshift(n, f, 1 + r)
    }), C.effects.define("slide", "show", function(e, t) {
        var i, n, s = C(this),
            o = {
                up: ["bottom", "top"],
                down: ["top", "bottom"],
                left: ["right", "left"],
                right: ["left", "right"]
            },
            a = e.mode,
            r = e.direction || "left",
            l = "up" === r || "down" === r ? "top" : "left",
            c = "up" === r || "left" === r,
            h = e.distance || s["top" == l ? "outerHeight" : "outerWidth"](!0),
            u = {};
        C.effects.createPlaceholder(s), i = s.cssClip(), n = s.position()[l], u[l] = (c ? -1 : 1) * h + n, u.clip = s.cssClip(), u.clip[o[r][1]] = u.clip[o[r][0]], "show" === a && (s.cssClip(u.clip), s.css(l, u[l]), u.clip = i, u[l] = n), s.animate(u, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: t
        })
    }), !1 !== C.uiBackCompat && C.effects.define("transfer", function(e, t) {
        C(this).transfer(e, t)
    }), C.ui.focusable = function(e, t) {
        var i, n, s, o, a, r = e.nodeName.toLowerCase();
        return "area" === r ? (n = (i = e.parentNode).name, !(!e.href || !n || "map" !== i.nodeName.toLowerCase()) && 0 < (s = C("img[usemap='#" + n + "']")).length && s.is(":visible")) : (/^(input|select|textarea|button|object)$/.test(r) ? (o = !e.disabled) && (a = C(e).closest("fieldset")[0]) && (o = !a.disabled) : o = "a" === r && e.href || t, o && C(e).is(":visible") && function(e) {
            for (var t = e.css("visibility");
                "inherit" === t;) t = (e = e.parent()).css("visibility");
            return "hidden" !== t
        }(C(e)))
    }, C.extend(C.expr[":"], {
        focusable: function(e) {
            return C.ui.focusable(e, null != C.attr(e, "tabindex"))
        }
    }), C.ui.focusable, C.fn.form = function() {
        return "string" == typeof this[0].form ? this.closest("form") : C(this[0].form)
    }, C.ui.formResetMixin = {
        _formResetHandler: function() {
            var t = C(this);
            setTimeout(function() {
                var e = t.data("ui-form-reset-instances");
                C.each(e, function() {
                    this.refresh()
                })
            })
        },
        _bindFormResetHandler: function() {
            if (this.form = this.element.form(), this.form.length) {
                var e = this.form.data("ui-form-reset-instances") || [];
                e.length || this.form.on("reset.ui-form-reset", this._formResetHandler), e.push(this), this.form.data("ui-form-reset-instances", e)
            }
        },
        _unbindFormResetHandler: function() {
            if (this.form.length) {
                var e = this.form.data("ui-form-reset-instances");
                e.splice(C.inArray(this, e), 1), e.length ? this.form.data("ui-form-reset-instances", e) : this.form.removeData("ui-form-reset-instances").off("reset.ui-form-reset")
            }
        }
    }, "1.7" === C.fn.jquery.substring(0, 3) && (C.each(["Width", "Height"], function(e, i) {
        function n(e, t, i, n) {
            return C.each(s, function() {
                t -= parseFloat(C.css(e, "padding" + this)) || 0, i && (t -= parseFloat(C.css(e, "border" + this + "Width")) || 0), n && (t -= parseFloat(C.css(e, "margin" + this)) || 0)
            }), t
        }
        var s = "Width" === i ? ["Left", "Right"] : ["Top", "Bottom"],
            o = i.toLowerCase(),
            a = {
                innerWidth: C.fn.innerWidth,
                innerHeight: C.fn.innerHeight,
                outerWidth: C.fn.outerWidth,
                outerHeight: C.fn.outerHeight
            };
        C.fn["inner" + i] = function(e) {
            return void 0 === e ? a["inner" + i].call(this) : this.each(function() {
                C(this).css(o, n(this, e) + "px")
            })
        }, C.fn["outer" + i] = function(e, t) {
            return "number" != typeof e ? a["outer" + i].call(this, e) : this.each(function() {
                C(this).css(o, n(this, e, !0, t) + "px")
            })
        }
    }), C.fn.addBack = function(e) {
        return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
    }), C.ui.keyCode = {
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
    }, C.ui.escapeSelector = (B = /([!"#$%&'()*+,.\/:;<=>?@[\]^`{|}~])/g, function(e) {
        return e.replace(B, "\\$1")
    }), C.fn.labels = function() {
        var e, t, i, n, s;
        return this[0].labels && this[0].labels.length ? this.pushStack(this[0].labels) : (n = this.eq(0).parents("label"), (i = this.attr("id")) && (s = (e = this.eq(0).parents().last()).add(e.length ? e.siblings() : this.siblings()), t = "label[for='" + C.ui.escapeSelector(i) + "']", n = n.add(s.find(t).addBack(t))), this.pushStack(n))
    }, C.fn.scrollParent = function(e) {
        var t = this.css("position"),
            i = "absolute" === t,
            n = e ? /(auto|scroll|hidden)/ : /(auto|scroll)/,
            s = this.parents().filter(function() {
                var e = C(this);
                return (!i || "static" !== e.css("position")) && n.test(e.css("overflow") + e.css("overflow-y") + e.css("overflow-x"))
            }).eq(0);
        return "fixed" !== t && s.length ? s : C(this[0].ownerDocument || document)
    }, C.extend(C.expr[":"], {
        tabbable: function(e) {
            var t = C.attr(e, "tabindex"),
                i = null != t;
            return (!i || 0 <= t) && C.ui.focusable(e, i)
        }
    }), C.fn.extend({
        uniqueId: (R = 0, function() {
            return this.each(function() {
                this.id || (this.id = "ui-id-" + ++R)
            })
        }),
        removeUniqueId: function() {
            return this.each(function() {
                /^ui-id-\d+$/.test(this.id) && C(this).removeAttr("id")
            })
        }
    }), C.widget("ui.accordion", {
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
        _create: function() {
            var e = this.options;
            this.prevShow = this.prevHide = C(), this._addClass("ui-accordion", "ui-widget ui-helper-reset"), this.element.attr("role", "tablist"), e.collapsible || !1 !== e.active && null != e.active || (e.active = 0), this._processPanels(), e.active < 0 && (e.active += this.headers.length), this._refresh()
        },
        _getCreateEventData: function() {
            return {
                header: this.active,
                panel: this.active.length ? this.active.next() : C()
            }
        },
        _createIcons: function() {
            var e, t, i = this.options.icons;
            i && (e = C("<span>"), this._addClass(e, "ui-accordion-header-icon", "ui-icon " + i.header), e.prependTo(this.headers), t = this.active.children(".ui-accordion-header-icon"), this._removeClass(t, i.header)._addClass(t, null, i.activeHeader)._addClass(this.headers, "ui-accordion-icons"))
        },
        _destroyIcons: function() {
            this._removeClass(this.headers, "ui-accordion-icons"), this.headers.children(".ui-accordion-header-icon").remove()
        },
        _destroy: function() {
            var e;
            this.element.removeAttr("role"), this.headers.removeAttr("role aria-expanded aria-selected aria-controls tabIndex").removeUniqueId(), this._destroyIcons(), e = this.headers.next().css("display", "").removeAttr("role aria-hidden aria-labelledby").removeUniqueId(), "content" !== this.options.heightStyle && e.css("height", "")
        },
        _setOption: function(e, t) {
            return "active" === e ? void this._activate(t) : ("event" === e && (this.options.event && this._off(this.headers, this.options.event), this._setupEvents(t)), this._super(e, t), "collapsible" !== e || t || !1 !== this.options.active || this._activate(0), void("icons" === e && (this._destroyIcons(), t && this._createIcons())))
        },
        _setOptionDisabled: function(e) {
            this._super(e), this.element.attr("aria-disabled", e), this._toggleClass(null, "ui-state-disabled", !!e), this._toggleClass(this.headers.add(this.headers.next()), null, "ui-state-disabled", !!e)
        },
        _keydown: function(e) {
            if (!e.altKey && !e.ctrlKey) {
                var t = C.ui.keyCode,
                    i = this.headers.length,
                    n = this.headers.index(e.target),
                    s = !1;
                switch (e.keyCode) {
                    case t.RIGHT:
                    case t.DOWN:
                        s = this.headers[(n + 1) % i];
                        break;
                    case t.LEFT:
                    case t.UP:
                        s = this.headers[(n - 1 + i) % i];
                        break;
                    case t.SPACE:
                    case t.ENTER:
                        this._eventHandler(e);
                        break;
                    case t.HOME:
                        s = this.headers[0];
                        break;
                    case t.END:
                        s = this.headers[i - 1]
                }
                s && (C(e.target).attr("tabIndex", -1), C(s).attr("tabIndex", 0), C(s).trigger("focus"), e.preventDefault())
            }
        },
        _panelKeyDown: function(e) {
            e.keyCode === C.ui.keyCode.UP && e.ctrlKey && C(e.currentTarget).prev().trigger("focus")
        },
        refresh: function() {
            var e = this.options;
            this._processPanels(), !1 === e.active && !0 === e.collapsible || !this.headers.length ? (e.active = !1, this.active = C()) : !1 === e.active ? this._activate(0) : this.active.length && !C.contains(this.element[0], this.active[0]) ? this.headers.length === this.headers.find(".ui-state-disabled").length ? (e.active = !1, this.active = C()) : this._activate(Math.max(0, e.active - 1)) : e.active = this.headers.index(this.active), this._destroyIcons(), this._refresh()
        },
        _processPanels: function() {
            var e = this.headers,
                t = this.panels;
            this.headers = this.element.find(this.options.header), this._addClass(this.headers, "ui-accordion-header ui-accordion-header-collapsed", "ui-state-default"), this.panels = this.headers.next().filter(":not(.ui-accordion-content-active)").hide(), this._addClass(this.panels, "ui-accordion-content", "ui-helper-reset ui-widget-content"), t && (this._off(e.not(this.headers)), this._off(t.not(this.panels)))
        },
        _refresh: function() {
            var i, e = this.options,
                t = e.heightStyle,
                n = this.element.parent();
            this.active = this._findActive(e.active), this._addClass(this.active, "ui-accordion-header-active", "ui-state-active")._removeClass(this.active, "ui-accordion-header-collapsed"), this._addClass(this.active.next(), "ui-accordion-content-active"), this.active.next().show(), this.headers.attr("role", "tab").each(function() {
                var e = C(this),
                    t = e.uniqueId().attr("id"),
                    i = e.next(),
                    n = i.uniqueId().attr("id");
                e.attr("aria-controls", n), i.attr("aria-labelledby", t)
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
            }) : this.headers.eq(0).attr("tabIndex", 0), this._createIcons(), this._setupEvents(e.event), "fill" === t ? (i = n.height(), this.element.siblings(":visible").each(function() {
                var e = C(this),
                    t = e.css("position");
                "absolute" !== t && "fixed" !== t && (i -= e.outerHeight(!0))
            }), this.headers.each(function() {
                i -= C(this).outerHeight(!0)
            }), this.headers.next().each(function() {
                C(this).height(Math.max(0, i - C(this).innerHeight() + C(this).height()))
            }).css("overflow", "auto")) : "auto" === t && (i = 0, this.headers.next().each(function() {
                var e = C(this).is(":visible");
                e || C(this).show(), i = Math.max(i, C(this).css("height", "").height()), e || C(this).hide()
            }).height(i))
        },
        _activate: function(e) {
            var t = this._findActive(e)[0];
            t !== this.active[0] && (t = t || this.active[0], this._eventHandler({
                target: t,
                currentTarget: t,
                preventDefault: C.noop
            }))
        },
        _findActive: function(e) {
            return "number" == typeof e ? this.headers.eq(e) : C()
        },
        _setupEvents: function(e) {
            var i = {
                keydown: "_keydown"
            };
            e && C.each(e.split(" "), function(e, t) {
                i[t] = "_eventHandler"
            }), this._off(this.headers.add(this.headers.next())), this._on(this.headers, i), this._on(this.headers.next(), {
                keydown: "_panelKeyDown"
            }), this._hoverable(this.headers), this._focusable(this.headers)
        },
        _eventHandler: function(e) {
            var t, i, n = this.options,
                s = this.active,
                o = C(e.currentTarget),
                a = o[0] === s[0],
                r = a && n.collapsible,
                l = r ? C() : o.next(),
                c = s.next(),
                h = {
                    oldHeader: s,
                    oldPanel: c,
                    newHeader: r ? C() : o,
                    newPanel: l
                };
            e.preventDefault(), a && !n.collapsible || !1 === this._trigger("beforeActivate", e, h) || (n.active = !r && this.headers.index(o), this.active = a ? C() : o, this._toggle(h), this._removeClass(s, "ui-accordion-header-active", "ui-state-active"), n.icons && (t = s.children(".ui-accordion-header-icon"), this._removeClass(t, null, n.icons.activeHeader)._addClass(t, null, n.icons.header)), a || (this._removeClass(o, "ui-accordion-header-collapsed")._addClass(o, "ui-accordion-header-active", "ui-state-active"), n.icons && (i = o.children(".ui-accordion-header-icon"), this._removeClass(i, null, n.icons.header)._addClass(i, null, n.icons.activeHeader)), this._addClass(o.next(), "ui-accordion-content-active")))
        },
        _toggle: function(e) {
            var t = e.newPanel,
                i = this.prevShow.length ? this.prevShow : e.oldPanel;
            this.prevShow.add(this.prevHide).stop(!0, !0), this.prevShow = t, this.prevHide = i, this.options.animate ? this._animate(t, i, e) : (i.hide(), t.show(), this._toggleComplete(e)), i.attr({
                "aria-hidden": "true"
            }), i.prev().attr({
                "aria-selected": "false",
                "aria-expanded": "false"
            }), t.length && i.length ? i.prev().attr({
                tabIndex: -1,
                "aria-expanded": "false"
            }) : t.length && this.headers.filter(function() {
                return 0 === parseInt(C(this).attr("tabIndex"), 10)
            }).attr("tabIndex", -1), t.attr("aria-hidden", "false").prev().attr({
                "aria-selected": "true",
                "aria-expanded": "true",
                tabIndex: 0
            })
        },
        _animate: function(e, i, t) {
            function n() {
                r._toggleComplete(t)
            }
            var s, o, a, r = this,
                l = 0,
                c = e.css("box-sizing"),
                h = e.length && (!i.length || e.index() < i.index()),
                u = this.options.animate || {},
                d = h && u.down || u;
            return "number" == typeof d && (a = d), "string" == typeof d && (o = d), o = o || d.easing || u.easing, a = a || d.duration || u.duration, i.length ? e.length ? (s = e.show().outerHeight(), i.animate(this.hideProps, {
                duration: a,
                easing: o,
                step: function(e, t) {
                    t.now = Math.round(e)
                }
            }), void e.hide().animate(this.showProps, {
                duration: a,
                easing: o,
                complete: n,
                step: function(e, t) {
                    t.now = Math.round(e), "height" !== t.prop ? "content-box" === c && (l += t.now) : "content" !== r.options.heightStyle && (t.now = Math.round(s - i.outerHeight() - l), l = 0)
                }
            })) : i.animate(this.hideProps, a, o, n) : e.animate(this.showProps, a, o, n)
        },
        _toggleComplete: function(e) {
            var t = e.oldPanel,
                i = t.prev();
            this._removeClass(t, "ui-accordion-content-active"), this._removeClass(i, "ui-accordion-header-active")._addClass(i, "ui-accordion-header-collapsed"), t.length && (t.parent()[0].className = t.parent()[0].className), this._trigger("activate", null, e)
        }
    }), C.ui.safeActiveElement = function(t) {
        var i;
        try {
            i = t.activeElement
        } catch (e) {
            i = t.body
        }
        return (i = i || t.body).nodeName || (i = t.body), i
    }, C.widget("ui.menu", {
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
        _create: function() {
            this.activeMenu = this.element, this.mouseHandled = !1, this.element.uniqueId().attr({
                role: this.options.role,
                tabIndex: 0
            }), this._addClass("ui-menu", "ui-widget ui-widget-content"), this._on({
                "mousedown .ui-menu-item": function(e) {
                    e.preventDefault()
                },
                "click .ui-menu-item": function(e) {
                    var t = C(e.target),
                        i = C(C.ui.safeActiveElement(this.document[0]));
                    !this.mouseHandled && t.not(".ui-state-disabled").length && (this.select(e), e.isPropagationStopped() || (this.mouseHandled = !0), t.has(".ui-menu").length ? this.expand(e) : !this.element.is(":focus") && i.closest(".ui-menu").length && (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)))
                },
                "mouseenter .ui-menu-item": function(e) {
                    if (!this.previousFilter) {
                        var t = C(e.target).closest(".ui-menu-item"),
                            i = C(e.currentTarget);
                        t[0] === i[0] && (this._removeClass(i.siblings().children(".ui-state-active"), null, "ui-state-active"), this.focus(e, i))
                    }
                },
                mouseleave: "collapseAll",
                "mouseleave .ui-menu": "collapseAll",
                focus: function(e, t) {
                    var i = this.active || this.element.find(this.options.items).eq(0);
                    t || this.focus(e, i)
                },
                blur: function(e) {
                    this._delay(function() {
                        C.contains(this.element[0], C.ui.safeActiveElement(this.document[0])) || this.collapseAll(e)
                    })
                },
                keydown: "_keydown"
            }), this.refresh(), this._on(this.document, {
                click: function(e) {
                    this._closeOnDocumentClick(e) && this.collapseAll(e), this.mouseHandled = !1
                }
            })
        },
        _destroy: function() {
            var e = this.element.find(".ui-menu-item").removeAttr("role aria-disabled").children(".ui-menu-item-wrapper").removeUniqueId().removeAttr("tabIndex role aria-haspopup");
            this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeAttr("role aria-labelledby aria-expanded aria-hidden aria-disabled tabIndex").removeUniqueId().show(), e.children().each(function() {
                var e = C(this);
                e.data("ui-menu-submenu-caret") && e.remove()
            })
        },
        _keydown: function(e) {
            var t, i, n, s, o = !0;
            switch (e.keyCode) {
                case C.ui.keyCode.PAGE_UP:
                    this.previousPage(e);
                    break;
                case C.ui.keyCode.PAGE_DOWN:
                    this.nextPage(e);
                    break;
                case C.ui.keyCode.HOME:
                    this._move("first", "first", e);
                    break;
                case C.ui.keyCode.END:
                    this._move("last", "last", e);
                    break;
                case C.ui.keyCode.UP:
                    this.previous(e);
                    break;
                case C.ui.keyCode.DOWN:
                    this.next(e);
                    break;
                case C.ui.keyCode.LEFT:
                    this.collapse(e);
                    break;
                case C.ui.keyCode.RIGHT:
                    this.active && !this.active.is(".ui-state-disabled") && this.expand(e);
                    break;
                case C.ui.keyCode.ENTER:
                case C.ui.keyCode.SPACE:
                    this._activate(e);
                    break;
                case C.ui.keyCode.ESCAPE:
                    this.collapse(e);
                    break;
                default:
                    o = !1, i = this.previousFilter || "", s = !1, n = 96 <= e.keyCode && e.keyCode <= 105 ? "" + (e.keyCode - 96) : String.fromCharCode(e.keyCode), clearTimeout(this.filterTimer), n === i ? s = !0 : n = i + n, t = this._filterMenuItems(n), (t = s && -1 !== t.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : t).length || (n = String.fromCharCode(e.keyCode), t = this._filterMenuItems(n)), t.length ? (this.focus(e, t), this.previousFilter = n, this.filterTimer = this._delay(function() {
                        delete this.previousFilter
                    }, 1e3)) : delete this.previousFilter
            }
            o && e.preventDefault()
        },
        _activate: function(e) {
            this.active && !this.active.is(".ui-state-disabled") && (this.active.children("[aria-haspopup='true']").length ? this.expand(e) : this.select(e))
        },
        refresh: function() {
            var e, t, i, n, s = this,
                o = this.options.icons.submenu,
                a = this.element.find(this.options.menus);
            this._toggleClass("ui-menu-icons", null, !!this.element.find(".ui-icon").length), t = a.filter(":not(.ui-menu)").hide().attr({
                role: this.options.role,
                "aria-hidden": "true",
                "aria-expanded": "false"
            }).each(function() {
                var e = C(this),
                    t = e.prev(),
                    i = C("<span>").data("ui-menu-submenu-caret", !0);
                s._addClass(i, "ui-menu-icon", "ui-icon " + o), t.attr("aria-haspopup", "true").prepend(i), e.attr("aria-labelledby", t.attr("id"))
            }), this._addClass(t, "ui-menu", "ui-widget ui-widget-content ui-front"), (e = a.add(this.element).find(this.options.items)).not(".ui-menu-item").each(function() {
                var e = C(this);
                s._isDivider(e) && s._addClass(e, "ui-menu-divider", "ui-widget-content")
            }), n = (i = e.not(".ui-menu-item, .ui-menu-divider")).children().not(".ui-menu").uniqueId().attr({
                tabIndex: -1,
                role: this._itemRole()
            }), this._addClass(i, "ui-menu-item")._addClass(n, "ui-menu-item-wrapper"), e.filter(".ui-state-disabled").attr("aria-disabled", "true"), this.active && !C.contains(this.element[0], this.active[0]) && this.blur()
        },
        _itemRole: function() {
            return {
                menu: "menuitem",
                listbox: "option"
            }[this.options.role]
        },
        _setOption: function(e, t) {
            if ("icons" === e) {
                var i = this.element.find(".ui-menu-icon");
                this._removeClass(i, null, this.options.icons.submenu)._addClass(i, null, t.submenu)
            }
            this._super(e, t)
        },
        _setOptionDisabled: function(e) {
            this._super(e), this.element.attr("aria-disabled", e + ""), this._toggleClass(null, "ui-state-disabled", !!e)
        },
        focus: function(e, t) {
            var i, n, s;
            this.blur(e, e && "focus" === e.type), this._scrollIntoView(t), this.active = t.first(), n = this.active.children(".ui-menu-item-wrapper"), this._addClass(n, null, "ui-state-active"), this.options.role && this.element.attr("aria-activedescendant", n.attr("id")), s = this.active.parent().closest(".ui-menu-item").children(".ui-menu-item-wrapper"), this._addClass(s, null, "ui-state-active"), e && "keydown" === e.type ? this._close() : this.timer = this._delay(function() {
                this._close()
            }, this.delay), (i = t.children(".ui-menu")).length && e && /^mouse/.test(e.type) && this._startOpening(i), this.activeMenu = t.parent(), this._trigger("focus", e, {
                item: t
            })
        },
        _scrollIntoView: function(e) {
            var t, i, n, s, o, a;
            this._hasScroll() && (t = parseFloat(C.css(this.activeMenu[0], "borderTopWidth")) || 0, i = parseFloat(C.css(this.activeMenu[0], "paddingTop")) || 0, n = e.offset().top - this.activeMenu.offset().top - t - i, s = this.activeMenu.scrollTop(), o = this.activeMenu.height(), a = e.outerHeight(), n < 0 ? this.activeMenu.scrollTop(s + n) : o < n + a && this.activeMenu.scrollTop(s + n - o + a))
        },
        blur: function(e, t) {
            t || clearTimeout(this.timer), this.active && (this._removeClass(this.active.children(".ui-menu-item-wrapper"), null, "ui-state-active"), this._trigger("blur", e, {
                item: this.active
            }), this.active = null)
        },
        _startOpening: function(e) {
            clearTimeout(this.timer), "true" === e.attr("aria-hidden") && (this.timer = this._delay(function() {
                this._close(), this._open(e)
            }, this.delay))
        },
        _open: function(e) {
            var t = C.extend({
                of: this.active
            }, this.options.position);
            clearTimeout(this.timer), this.element.find(".ui-menu").not(e.parents(".ui-menu")).hide().attr("aria-hidden", "true"), e.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(t)
        },
        collapseAll: function(t, i) {
            clearTimeout(this.timer), this.timer = this._delay(function() {
                var e = i ? this.element : C(t && t.target).closest(this.element.find(".ui-menu"));
                e.length || (e = this.element), this._close(e), this.blur(t), this._removeClass(e.find(".ui-state-active"), null, "ui-state-active"), this.activeMenu = e
            }, this.delay)
        },
        _close: function(e) {
            (e = e || (this.active ? this.active.parent() : this.element)).find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false")
        },
        _closeOnDocumentClick: function(e) {
            return !C(e.target).closest(".ui-menu").length
        },
        _isDivider: function(e) {
            return !/[^\-\u2014\u2013\s]/.test(e.text())
        },
        collapse: function(e) {
            var t = this.active && this.active.parent().closest(".ui-menu-item", this.element);
            t && t.length && (this._close(), this.focus(e, t))
        },
        expand: function(e) {
            var t = this.active && this.active.children(".ui-menu ").find(this.options.items).first();
            t && t.length && (this._open(t.parent()), this._delay(function() {
                this.focus(e, t)
            }))
        },
        next: function(e) {
            this._move("next", "first", e)
        },
        previous: function(e) {
            this._move("prev", "last", e)
        },
        isFirstItem: function() {
            return this.active && !this.active.prevAll(".ui-menu-item").length
        },
        isLastItem: function() {
            return this.active && !this.active.nextAll(".ui-menu-item").length
        },
        _move: function(e, t, i) {
            var n;
            this.active && (n = "first" === e || "last" === e ? this.active["first" === e ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[e + "All"](".ui-menu-item").eq(0)), n && n.length && this.active || (n = this.activeMenu.find(this.options.items)[t]()), this.focus(i, n)
        },
        nextPage: function(e) {
            var t, i, n;
            return this.active ? void(this.isLastItem() || (this._hasScroll() ? (i = this.active.offset().top, n = this.element.height(), this.active.nextAll(".ui-menu-item").each(function() {
                return (t = C(this)).offset().top - i - n < 0
            }), this.focus(e, t)) : this.focus(e, this.activeMenu.find(this.options.items)[this.active ? "last" : "first"]()))) : void this.next(e)
        },
        previousPage: function(e) {
            var t, i, n;
            return this.active ? void(this.isFirstItem() || (this._hasScroll() ? (i = this.active.offset().top, n = this.element.height(), this.active.prevAll(".ui-menu-item").each(function() {
                return 0 < (t = C(this)).offset().top - i + n
            }), this.focus(e, t)) : this.focus(e, this.activeMenu.find(this.options.items).first()))) : void this.next(e)
        },
        _hasScroll: function() {
            return this.element.outerHeight() < this.element.prop("scrollHeight")
        },
        select: function(e) {
            this.active = this.active || C(e.target).closest(".ui-menu-item");
            var t = {
                item: this.active
            };
            this.active.has(".ui-menu").length || this.collapseAll(e, !0), this._trigger("select", e, t)
        },
        _filterMenuItems: function(e) {
            var t = e.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"),
                i = RegExp("^" + t, "i");
            return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function() {
                return i.test(C.trim(C(this).children(".ui-menu-item-wrapper").text()))
            })
        }
    }), C.widget("ui.autocomplete", {
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
        _create: function() {
            var i, n, s, e = this.element[0].nodeName.toLowerCase(),
                t = "textarea" === e,
                o = "input" === e;
            this.isMultiLine = t || !o && this._isContentEditable(this.element), this.valueMethod = this.element[t || o ? "val" : "text"], this.isNewMenu = !0, this._addClass("ui-autocomplete-input"), this.element.attr("autocomplete", "off"), this._on(this.element, {
                keydown: function(e) {
                    if (this.element.prop("readOnly")) n = s = i = !0;
                    else {
                        n = s = i = !1;
                        var t = C.ui.keyCode;
                        switch (e.keyCode) {
                            case t.PAGE_UP:
                                i = !0, this._move("previousPage", e);
                                break;
                            case t.PAGE_DOWN:
                                i = !0, this._move("nextPage", e);
                                break;
                            case t.UP:
                                i = !0, this._keyEvent("previous", e);
                                break;
                            case t.DOWN:
                                i = !0, this._keyEvent("next", e);
                                break;
                            case t.ENTER:
                                this.menu.active && (i = !0, e.preventDefault(), this.menu.select(e));
                                break;
                            case t.TAB:
                                this.menu.active && this.menu.select(e);
                                break;
                            case t.ESCAPE:
                                this.menu.element.is(":visible") && (this.isMultiLine || this._value(this.term), this.close(e), e.preventDefault());
                                break;
                            default:
                                n = !0, this._searchTimeout(e)
                        }
                    }
                },
                keypress: function(e) {
                    if (i) return i = !1, void(this.isMultiLine && !this.menu.element.is(":visible") || e.preventDefault());
                    if (!n) {
                        var t = C.ui.keyCode;
                        switch (e.keyCode) {
                            case t.PAGE_UP:
                                this._move("previousPage", e);
                                break;
                            case t.PAGE_DOWN:
                                this._move("nextPage", e);
                                break;
                            case t.UP:
                                this._keyEvent("previous", e);
                                break;
                            case t.DOWN:
                                this._keyEvent("next", e)
                        }
                    }
                },
                input: function(e) {
                    return s ? (s = !1, void e.preventDefault()) : void this._searchTimeout(e)
                },
                focus: function() {
                    this.selectedItem = null, this.previous = this._value()
                },
                blur: function(e) {
                    return this.cancelBlur ? void delete this.cancelBlur : (clearTimeout(this.searching), this.close(e), void this._change(e))
                }
            }), this._initSource(), this.menu = C("<ul>").appendTo(this._appendTo()).menu({
                role: null
            }).hide().menu("instance"), this._addClass(this.menu.element, "ui-autocomplete", "ui-front"), this._on(this.menu.element, {
                mousedown: function(e) {
                    e.preventDefault(), this.cancelBlur = !0, this._delay(function() {
                        delete this.cancelBlur, this.element[0] !== C.ui.safeActiveElement(this.document[0]) && this.element.trigger("focus")
                    })
                },
                menufocus: function(e, t) {
                    var i, n;
                    return this.isNewMenu && (this.isNewMenu = !1, e.originalEvent && /^mouse/.test(e.originalEvent.type)) ? (this.menu.blur(), void this.document.one("mousemove", function() {
                        C(e.target).trigger(e.originalEvent)
                    })) : (n = t.item.data("ui-autocomplete-item"), !1 !== this._trigger("focus", e, {
                        item: n
                    }) && e.originalEvent && /^key/.test(e.originalEvent.type) && this._value(n.value), void((i = t.item.attr("aria-label") || n.value) && C.trim(i).length && (this.liveRegion.children().hide(), C("<div>").text(i).appendTo(this.liveRegion))))
                },
                menuselect: function(e, t) {
                    var i = t.item.data("ui-autocomplete-item"),
                        n = this.previous;
                    this.element[0] !== C.ui.safeActiveElement(this.document[0]) && (this.element.trigger("focus"), this.previous = n, this._delay(function() {
                        this.previous = n, this.selectedItem = i
                    })), !1 !== this._trigger("select", e, {
                        item: i
                    }) && this._value(i.value), this.term = this._value(), this.close(e), this.selectedItem = i
                }
            }), this.liveRegion = C("<div>", {
                role: "status",
                "aria-live": "assertive",
                "aria-relevant": "additions"
            }).appendTo(this.document[0].body), this._addClass(this.liveRegion, null, "ui-helper-hidden-accessible"), this._on(this.window, {
                beforeunload: function() {
                    this.element.removeAttr("autocomplete")
                }
            })
        },
        _destroy: function() {
            clearTimeout(this.searching), this.element.removeAttr("autocomplete"), this.menu.element.remove(), this.liveRegion.remove()
        },
        _setOption: function(e, t) {
            this._super(e, t), "source" === e && this._initSource(), "appendTo" === e && this.menu.element.appendTo(this._appendTo()), "disabled" === e && t && this.xhr && this.xhr.abort()
        },
        _isEventTargetInWidget: function(e) {
            var t = this.menu.element[0];
            return e.target === this.element[0] || e.target === t || C.contains(t, e.target)
        },
        _closeOnClickOutside: function(e) {
            this._isEventTargetInWidget(e) || this.close()
        },
        _appendTo: function() {
            var e = this.options.appendTo;
            return (e = e && (e.jquery || e.nodeType ? C(e) : this.document.find(e).eq(0))) && e[0] || (e = this.element.closest(".ui-front, dialog")), e.length || (e = this.document[0].body), e
        },
        _initSource: function() {
            var i, n, s = this;
            C.isArray(this.options.source) ? (i = this.options.source, this.source = function(e, t) {
                t(C.ui.autocomplete.filter(i, e.term))
            }) : "string" == typeof this.options.source ? (n = this.options.source, this.source = function(e, t) {
                s.xhr && s.xhr.abort(), s.xhr = C.ajax({
                    url: n,
                    data: e,
                    dataType: "json",
                    success: function(e) {
                        t(e)
                    },
                    error: function() {
                        t([])
                    }
                })
            }) : this.source = this.options.source
        },
        _searchTimeout: function(n) {
            clearTimeout(this.searching), this.searching = this._delay(function() {
                var e = this.term === this._value(),
                    t = this.menu.element.is(":visible"),
                    i = n.altKey || n.ctrlKey || n.metaKey || n.shiftKey;
                e && (!e || t || i) || (this.selectedItem = null, this.search(null, n))
            }, this.options.delay)
        },
        search: function(e, t) {
            return e = null != e ? e : this._value(), this.term = this._value(), e.length < this.options.minLength ? this.close(t) : !1 !== this._trigger("search", t) ? this._search(e) : void 0
        },
        _search: function(e) {
            this.pending++, this._addClass("ui-autocomplete-loading"), this.cancelSearch = !1, this.source({
                term: e
            }, this._response())
        },
        _response: function() {
            var t = ++this.requestIndex;
            return C.proxy(function(e) {
                t === this.requestIndex && this.__response(e), this.pending--, this.pending || this._removeClass("ui-autocomplete-loading")
            }, this)
        },
        __response: function(e) {
            e = e && this._normalize(e), this._trigger("response", null, {
                content: e
            }), !this.options.disabled && e && e.length && !this.cancelSearch ? (this._suggest(e), this._trigger("open")) : this._close()
        },
        close: function(e) {
            this.cancelSearch = !0, this._close(e)
        },
        _close: function(e) {
            this._off(this.document, "mousedown"), this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", e))
        },
        _change: function(e) {
            this.previous !== this._value() && this._trigger("change", e, {
                item: this.selectedItem
            })
        },
        _normalize: function(e) {
            return e.length && e[0].label && e[0].value ? e : C.map(e, function(e) {
                return "string" == typeof e ? {
                    label: e,
                    value: e
                } : C.extend({}, e, {
                    label: e.label || e.value,
                    value: e.value || e.label
                })
            })
        },
        _suggest: function(e) {
            var t = this.menu.element.empty();
            this._renderMenu(t, e), this.isNewMenu = !0, this.menu.refresh(), t.show(), this._resizeMenu(), t.position(C.extend({
                of: this.element
            }, this.options.position)), this.options.autoFocus && this.menu.next(), this._on(this.document, {
                mousedown: "_closeOnClickOutside"
            })
        },
        _resizeMenu: function() {
            var e = this.menu.element;
            e.outerWidth(Math.max(e.width("").outerWidth() + 1, this.element.outerWidth()))
        },
        _renderMenu: function(i, e) {
            var n = this;
            C.each(e, function(e, t) {
                n._renderItemData(i, t)
            })
        },
        _renderItemData: function(e, t) {
            return this._renderItem(e, t).data("ui-autocomplete-item", t)
        },
        _renderItem: function(e, t) {
            return C("<li>").append(C("<div>").text(t.label)).appendTo(e)
        },
        _move: function(e, t) {
            return this.menu.element.is(":visible") ? this.menu.isFirstItem() && /^previous/.test(e) || this.menu.isLastItem() && /^next/.test(e) ? (this.isMultiLine || this._value(this.term), void this.menu.blur()) : void this.menu[e](t) : void this.search(null, t)
        },
        widget: function() {
            return this.menu.element
        },
        _value: function() {
            return this.valueMethod.apply(this.element, arguments)
        },
        _keyEvent: function(e, t) {
            this.isMultiLine && !this.menu.element.is(":visible") || (this._move(e, t), t.preventDefault())
        },
        _isContentEditable: function(e) {
            if (!e.length) return !1;
            var t = e.prop("contentEditable");
            return "inherit" === t ? this._isContentEditable(e.parent()) : "true" === t
        }
    }), C.extend(C.ui.autocomplete, {
        escapeRegex: function(e) {
            return e.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
        },
        filter: function(e, t) {
            var i = RegExp(C.ui.autocomplete.escapeRegex(t), "i");
            return C.grep(e, function(e) {
                return i.test(e.label || e.value || e)
            })
        }
    }), C.widget("ui.autocomplete", C.ui.autocomplete, {
        options: {
            messages: {
                noResults: "No search results.",
                results: function(e) {
                    return e + (1 < e ? " results are" : " result is") + " available, use up and down arrow keys to navigate."
                }
            }
        },
        __response: function(e) {
            var t;
            this._superApply(arguments), this.options.disabled || this.cancelSearch || (t = e && e.length ? this.options.messages.results(e.length) : this.options.messages.noResults, this.liveRegion.children().hide(), C("<div>").text(t).appendTo(this.liveRegion))
        }
    }), C.ui.autocomplete;
    var te, ie, ne = /ui-corner-([a-z]){2,6}/g;
    C.widget("ui.controlgroup", {
        version: "1.12.1",
        defaultElement: "<div>",
        options: {
            direction: "horizontal",
            disabled: null,
            onlyVisible: !0,
            items: {
                button: "input[type=button], input[type=submit], input[type=reset], button, a",
                controlgroupLabel: ".ui-controlgroup-label",
                checkboxradio: "input[type='checkbox'], input[type='radio']",
                selectmenu: "select",
                spinner: ".ui-spinner-input"
            }
        },
        _create: function() {
            this._enhance()
        },
        _enhance: function() {
            this.element.attr("role", "toolbar"), this.refresh()
        },
        _destroy: function() {
            this._callChildMethod("destroy"), this.childWidgets.removeData("ui-controlgroup-data"), this.element.removeAttr("role"), this.options.items.controlgroupLabel && this.element.find(this.options.items.controlgroupLabel).find(".ui-controlgroup-label-contents").contents().unwrap()
        },
        _initWidgets: function() {
            var a = this,
                r = [];
            C.each(this.options.items, function(s, e) {
                var t, o = {};
                return e ? "controlgroupLabel" === s ? ((t = a.element.find(e)).each(function() {
                    var e = C(this);
                    e.children(".ui-controlgroup-label-contents").length || e.contents().wrapAll("<span class='ui-controlgroup-label-contents'></span>")
                }), a._addClass(t, null, "ui-widget ui-widget-content ui-state-default"), void(r = r.concat(t.get()))) : void(C.fn[s] && (o = a["_" + s + "Options"] ? a["_" + s + "Options"]("middle") : {
                    classes: {}
                }, a.element.find(e).each(function() {
                    var e = C(this),
                        t = e[s]("instance"),
                        i = C.widget.extend({}, o);
                    if ("button" !== s || !e.parent(".ui-spinner").length) {
                        (t = t || e[s]()[s]("instance")) && (i.classes = a._resolveClassesValues(i.classes, t)), e[s](i);
                        var n = e[s]("widget");
                        C.data(n[0], "ui-controlgroup-data", t || e[s]("instance")), r.push(n[0])
                    }
                }))) : void 0
            }), this.childWidgets = C(C.unique(r)), this._addClass(this.childWidgets, "ui-controlgroup-item")
        },
        _callChildMethod: function(t) {
            this.childWidgets.each(function() {
                var e = C(this).data("ui-controlgroup-data");
                e && e[t] && e[t]()
            })
        },
        _updateCornerClass: function(e, t) {
            var i = this._buildSimpleOptions(t, "label").classes.label;
            this._removeClass(e, null, "ui-corner-top ui-corner-bottom ui-corner-left ui-corner-right ui-corner-all"), this._addClass(e, null, i)
        },
        _buildSimpleOptions: function(e, t) {
            var i = "vertical" === this.options.direction,
                n = {
                    classes: {}
                };
            return n.classes[t] = {
                middle: "",
                first: "ui-corner-" + (i ? "top" : "left"),
                last: "ui-corner-" + (i ? "bottom" : "right"),
                only: "ui-corner-all"
            }[e], n
        },
        _spinnerOptions: function(e) {
            var t = this._buildSimpleOptions(e, "ui-spinner");
            return t.classes["ui-spinner-up"] = "", t.classes["ui-spinner-down"] = "", t
        },
        _buttonOptions: function(e) {
            return this._buildSimpleOptions(e, "ui-button")
        },
        _checkboxradioOptions: function(e) {
            return this._buildSimpleOptions(e, "ui-checkboxradio-label")
        },
        _selectmenuOptions: function(e) {
            var t = "vertical" === this.options.direction;
            return {
                width: t && "auto",
                classes: {
                    middle: {
                        "ui-selectmenu-button-open": "",
                        "ui-selectmenu-button-closed": ""
                    },
                    first: {
                        "ui-selectmenu-button-open": "ui-corner-" + (t ? "top" : "tl"),
                        "ui-selectmenu-button-closed": "ui-corner-" + (t ? "top" : "left")
                    },
                    last: {
                        "ui-selectmenu-button-open": t ? "" : "ui-corner-tr",
                        "ui-selectmenu-button-closed": "ui-corner-" + (t ? "bottom" : "right")
                    },
                    only: {
                        "ui-selectmenu-button-open": "ui-corner-top",
                        "ui-selectmenu-button-closed": "ui-corner-all"
                    }
                }[e]
            }
        },
        _resolveClassesValues: function(i, n) {
            var s = {};
            return C.each(i, function(e) {
                var t = n.options.classes[e] || "";
                t = C.trim(t.replace(ne, "")), s[e] = (t + " " + i[e]).replace(/\s+/g, " ")
            }), s
        },
        _setOption: function(e, t) {
            return "direction" === e && this._removeClass("ui-controlgroup-" + this.options.direction), this._super(e, t), "disabled" === e ? void this._callChildMethod(t ? "disable" : "enable") : void this.refresh()
        },
        refresh: function() {
            var s, o = this;
            this._addClass("ui-controlgroup ui-controlgroup-" + this.options.direction), "horizontal" === this.options.direction && this._addClass(null, "ui-helper-clearfix"), this._initWidgets(), s = this.childWidgets, this.options.onlyVisible && (s = s.filter(":visible")), s.length && (C.each(["first", "last"], function(e, t) {
                var i = s[t]().data("ui-controlgroup-data");
                if (i && o["_" + i.widgetName + "Options"]) {
                    var n = o["_" + i.widgetName + "Options"](1 === s.length ? "only" : t);
                    n.classes = o._resolveClassesValues(n.classes, i), i.element[i.widgetName](n)
                } else o._updateCornerClass(s[t](), t)
            }), this._callChildMethod("refresh"))
        }
    }), C.widget("ui.checkboxradio", [C.ui.formResetMixin, {
        version: "1.12.1",
        options: {
            disabled: null,
            label: null,
            icon: !0,
            classes: {
                "ui-checkboxradio-label": "ui-corner-all",
                "ui-checkboxradio-icon": "ui-corner-all"
            }
        },
        _getCreateOptions: function() {
            var e, t, i = this,
                n = this._super() || {};
            return this._readType(), t = this.element.labels(), this.label = C(t[t.length - 1]), this.label.length || C.error("No label found for checkboxradio widget"), this.originalLabel = "", this.label.contents().not(this.element[0]).each(function() {
                i.originalLabel += 3 === this.nodeType ? C(this).text() : this.outerHTML
            }), this.originalLabel && (n.label = this.originalLabel), null != (e = this.element[0].disabled) && (n.disabled = e), n
        },
        _create: function() {
            var e = this.element[0].checked;
            this._bindFormResetHandler(), null == this.options.disabled && (this.options.disabled = this.element[0].disabled), this._setOption("disabled", this.options.disabled), this._addClass("ui-checkboxradio", "ui-helper-hidden-accessible"), this._addClass(this.label, "ui-checkboxradio-label", "ui-button ui-widget"), "radio" === this.type && this._addClass(this.label, "ui-checkboxradio-radio-label"), this.options.label && this.options.label !== this.originalLabel ? this._updateLabel() : this.originalLabel && (this.options.label = this.originalLabel), this._enhance(), e && (this._addClass(this.label, "ui-checkboxradio-checked", "ui-state-active"), this.icon && this._addClass(this.icon, null, "ui-state-hover")), this._on({
                change: "_toggleClasses",
                focus: function() {
                    this._addClass(this.label, null, "ui-state-focus ui-visual-focus")
                },
                blur: function() {
                    this._removeClass(this.label, null, "ui-state-focus ui-visual-focus")
                }
            })
        },
        _readType: function() {
            var e = this.element[0].nodeName.toLowerCase();
            this.type = this.element[0].type, "input" === e && /radio|checkbox/.test(this.type) || C.error("Can't create checkboxradio on element.nodeName=" + e + " and element.type=" + this.type)
        },
        _enhance: function() {
            this._updateIcon(this.element[0].checked)
        },
        widget: function() {
            return this.label
        },
        _getRadioGroup: function() {
            var e = this.element[0].name,
                t = "input[name='" + C.ui.escapeSelector(e) + "']";
            return e ? (this.form.length ? C(this.form[0].elements).filter(t) : C(t).filter(function() {
                return 0 === C(this).form().length
            })).not(this.element) : C([])
        },
        _toggleClasses: function() {
            var e = this.element[0].checked;
            this._toggleClass(this.label, "ui-checkboxradio-checked", "ui-state-active", e), this.options.icon && "checkbox" === this.type && this._toggleClass(this.icon, null, "ui-icon-check ui-state-checked", e)._toggleClass(this.icon, null, "ui-icon-blank", !e), "radio" === this.type && this._getRadioGroup().each(function() {
                var e = C(this).checkboxradio("instance");
                e && e._removeClass(e.label, "ui-checkboxradio-checked", "ui-state-active")
            })
        },
        _destroy: function() {
            this._unbindFormResetHandler(), this.icon && (this.icon.remove(), this.iconSpace.remove())
        },
        _setOption: function(e, t) {
            return "label" !== e || t ? (this._super(e, t), "disabled" === e ? (this._toggleClass(this.label, null, "ui-state-disabled", t), void(this.element[0].disabled = t)) : void this.refresh()) : void 0
        },
        _updateIcon: function(e) {
            var t = "ui-icon ui-icon-background ";
            this.options.icon ? (this.icon || (this.icon = C("<span>"), this.iconSpace = C("<span> </span>"), this._addClass(this.iconSpace, "ui-checkboxradio-icon-space")), "checkbox" === this.type ? (t += e ? "ui-icon-check ui-state-checked" : "ui-icon-blank", this._removeClass(this.icon, null, e ? "ui-icon-blank" : "ui-icon-check")) : t += "ui-icon-blank", this._addClass(this.icon, "ui-checkboxradio-icon", t), e || this._removeClass(this.icon, null, "ui-icon-check ui-state-checked"), this.icon.prependTo(this.label).after(this.iconSpace)) : void 0 !== this.icon && (this.icon.remove(), this.iconSpace.remove(), delete this.icon)
        },
        _updateLabel: function() {
            var e = this.label.contents().not(this.element[0]);
            this.icon && (e = e.not(this.icon[0])), this.iconSpace && (e = e.not(this.iconSpace[0])), e.remove(), this.label.append(this.options.label)
        },
        refresh: function() {
            var e = this.element[0].checked,
                t = this.element[0].disabled;
            this._updateIcon(e), this._toggleClass(this.label, "ui-checkboxradio-checked", "ui-state-active", e), null !== this.options.label && this._updateLabel(), t !== this.options.disabled && this._setOptions({
                disabled: t
            })
        }
    }]), C.ui.checkboxradio, C.widget("ui.button", {
        version: "1.12.1",
        defaultElement: "<button>",
        options: {
            classes: {
                "ui-button": "ui-corner-all"
            },
            disabled: null,
            icon: null,
            iconPosition: "beginning",
            label: null,
            showLabel: !0
        },
        _getCreateOptions: function() {
            var e, t = this._super() || {};
            return this.isInput = this.element.is("input"), null != (e = this.element[0].disabled) && (t.disabled = e), this.originalLabel = this.isInput ? this.element.val() : this.element.html(), this.originalLabel && (t.label = this.originalLabel), t
        },
        _create: function() {
            !this.option.showLabel & !this.options.icon && (this.options.showLabel = !0), null == this.options.disabled && (this.options.disabled = this.element[0].disabled || !1), this.hasTitle = !!this.element.attr("title"), this.options.label && this.options.label !== this.originalLabel && (this.isInput ? this.element.val(this.options.label) : this.element.html(this.options.label)), this._addClass("ui-button", "ui-widget"), this._setOption("disabled", this.options.disabled), this._enhance(), this.element.is("a") && this._on({
                keyup: function(e) {
                    e.keyCode === C.ui.keyCode.SPACE && (e.preventDefault(), this.element[0].click ? this.element[0].click() : this.element.trigger("click"))
                }
            })
        },
        _enhance: function() {
            this.element.is("button") || this.element.attr("role", "button"), this.options.icon && (this._updateIcon("icon", this.options.icon), this._updateTooltip())
        },
        _updateTooltip: function() {
            this.title = this.element.attr("title"), this.options.showLabel || this.title || this.element.attr("title", this.options.label)
        },
        _updateIcon: function(e, t) {
            var i = "iconPosition" !== e,
                n = i ? this.options.iconPosition : t,
                s = "top" === n || "bottom" === n;
            this.icon ? i && this._removeClass(this.icon, null, this.options.icon) : (this.icon = C("<span>"), this._addClass(this.icon, "ui-button-icon", "ui-icon"), this.options.showLabel || this._addClass("ui-button-icon-only")), i && this._addClass(this.icon, null, t), this._attachIcon(n), s ? (this._addClass(this.icon, null, "ui-widget-icon-block"), this.iconSpace && this.iconSpace.remove()) : (this.iconSpace || (this.iconSpace = C("<span> </span>"), this._addClass(this.iconSpace, "ui-button-icon-space")), this._removeClass(this.icon, null, "ui-wiget-icon-block"), this._attachIconSpace(n))
        },
        _destroy: function() {
            this.element.removeAttr("role"), this.icon && this.icon.remove(), this.iconSpace && this.iconSpace.remove(), this.hasTitle || this.element.removeAttr("title")
        },
        _attachIconSpace: function(e) {
            this.icon[/^(?:end|bottom)/.test(e) ? "before" : "after"](this.iconSpace)
        },
        _attachIcon: function(e) {
            this.element[/^(?:end|bottom)/.test(e) ? "append" : "prepend"](this.icon)
        },
        _setOptions: function(e) {
            var t = void 0 === e.showLabel ? this.options.showLabel : e.showLabel,
                i = void 0 === e.icon ? this.options.icon : e.icon;
            t || i || (e.showLabel = !0), this._super(e)
        },
        _setOption: function(e, t) {
            "icon" === e && (t ? this._updateIcon(e, t) : this.icon && (this.icon.remove(), this.iconSpace && this.iconSpace.remove())), "iconPosition" === e && this._updateIcon(e, t), "showLabel" === e && (this._toggleClass("ui-button-icon-only", null, !t), this._updateTooltip()), "label" === e && (this.isInput ? this.element.val(t) : (this.element.html(t), this.icon && (this._attachIcon(this.options.iconPosition), this._attachIconSpace(this.options.iconPosition)))), this._super(e, t), "disabled" === e && (this._toggleClass(null, "ui-state-disabled", t), (this.element[0].disabled = t) && this.element.blur())
        },
        refresh: function() {
            var e = this.element.is("input, button") ? this.element[0].disabled : this.element.hasClass("ui-button-disabled");
            e !== this.options.disabled && this._setOptions({
                disabled: e
            }), this._updateTooltip()
        }
    }), !1 !== C.uiBackCompat && (C.widget("ui.button", C.ui.button, {
        options: {
            text: !0,
            icons: {
                primary: null,
                secondary: null
            }
        },
        _create: function() {
            this.options.showLabel && !this.options.text && (this.options.showLabel = this.options.text), !this.options.showLabel && this.options.text && (this.options.text = this.options.showLabel), this.options.icon || !this.options.icons.primary && !this.options.icons.secondary ? this.options.icon && (this.options.icons.primary = this.options.icon) : this.options.icons.primary ? this.options.icon = this.options.icons.primary : (this.options.icon = this.options.icons.secondary, this.options.iconPosition = "end"), this._super()
        },
        _setOption: function(e, t) {
            return "text" === e ? void this._super("showLabel", t) : ("showLabel" === e && (this.options.text = t), "icon" === e && (this.options.icons.primary = t), "icons" === e && (t.primary ? (this._super("icon", t.primary), this._super("iconPosition", "beginning")) : t.secondary && (this._super("icon", t.secondary), this._super("iconPosition", "end"))), void this._superApply(arguments))
        }
    }), C.fn.button = (te = C.fn.button, function() {
        return !this.length || this.length && "INPUT" !== this[0].tagName || this.length && "INPUT" === this[0].tagName && "checkbox" !== this.attr("type") && "radio" !== this.attr("type") ? te.apply(this, arguments) : (C.ui.checkboxradio || C.error("Checkboxradio widget missing"), 0 === arguments.length ? this.checkboxradio({
            icon: !1
        }) : this.checkboxradio.apply(this, arguments))
    }), C.fn.buttonset = function() {
        return C.ui.controlgroup || C.error("Controlgroup widget missing"), "option" === arguments[0] && "items" === arguments[1] && arguments[2] ? this.controlgroup.apply(this, [arguments[0], "items.button", arguments[2]]) : "option" === arguments[0] && "items" === arguments[1] ? this.controlgroup.apply(this, [arguments[0], "items.button"]) : ("object" == typeof arguments[0] && arguments[0].items && (arguments[0].items = {
            button: arguments[0].items
        }), this.controlgroup.apply(this, arguments))
    }), C.ui.button, C.extend(C.ui, {
        datepicker: {
            version: "1.12.1"
        }
    }), C.extend(e.prototype, {
        markerClassName: "hasDatepicker",
        maxRows: 4,
        _widgetDatepicker: function() {
            return this.dpDiv
        },
        setDefaults: function(e) {
            return u(this._defaults, e || {}), this
        },
        _attachDatepicker: function(e, t) {
            var i, n, s;
            n = "div" === (i = e.nodeName.toLowerCase()) || "span" === i, e.id || (this.uuid += 1, e.id = "dp" + this.uuid), (s = this._newInst(C(e), n)).settings = C.extend({}, t || {}), "input" === i ? this._connectDatepicker(e, s) : n && this._inlineDatepicker(e, s)
        },
        _newInst: function(e, t) {
            return {
                id: e[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1"),
                input: e,
                selectedDay: 0,
                selectedMonth: 0,
                selectedYear: 0,
                drawMonth: 0,
                drawYear: 0,
                inline: t,
                dpDiv: t ? i(C("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) : this.dpDiv
            }
        },
        _connectDatepicker: function(e, t) {
            var i = C(e);
            t.append = C([]), t.trigger = C([]), i.hasClass(this.markerClassName) || (this._attachments(i, t), i.addClass(this.markerClassName).on("keydown", this._doKeyDown).on("keypress", this._doKeyPress).on("keyup", this._doKeyUp), this._autoSize(t), C.data(e, "datepicker", t), t.settings.disabled && this._disableDatepicker(e))
        },
        _attachments: function(e, t) {
            var i, n, s, o = this._get(t, "appendText"),
                a = this._get(t, "isRTL");
            t.append && t.append.remove(), o && (t.append = C("<span class='" + this._appendClass + "'>" + o + "</span>"), e[a ? "before" : "after"](t.append)), e.off("focus", this._showDatepicker), t.trigger && t.trigger.remove(), "focus" !== (i = this._get(t, "showOn")) && "both" !== i || e.on("focus", this._showDatepicker), "button" !== i && "both" !== i || (n = this._get(t, "buttonText"), s = this._get(t, "buttonImage"), t.trigger = C(this._get(t, "buttonImageOnly") ? C("<img/>").addClass(this._triggerClass).attr({
                src: s,
                alt: n,
                title: n
            }) : C("<button type='button'></button>").addClass(this._triggerClass).html(s ? C("<img/>").attr({
                src: s,
                alt: n,
                title: n
            }) : n)), e[a ? "before" : "after"](t.trigger), t.trigger.on("click", function() {
                return C.datepicker._datepickerShowing && C.datepicker._lastInput === e[0] ? C.datepicker._hideDatepicker() : (C.datepicker._datepickerShowing && C.datepicker._lastInput !== e[0] && C.datepicker._hideDatepicker(), C.datepicker._showDatepicker(e[0])), !1
            }))
        },
        _autoSize: function(e) {
            if (this._get(e, "autoSize") && !e.inline) {
                var t, i, n, s, o = new Date(2009, 11, 20),
                    a = this._get(e, "dateFormat");
                a.match(/[DM]/) && (t = function(e) {
                    for (s = n = i = 0; e.length > s; s++) e[s].length > i && (i = e[s].length, n = s);
                    return n
                }, o.setMonth(t(this._get(e, a.match(/MM/) ? "monthNames" : "monthNamesShort"))), o.setDate(t(this._get(e, a.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - o.getDay())), e.input.attr("size", this._formatDate(e, o).length)
            }
        },
        _inlineDatepicker: function(e, t) {
            var i = C(e);
            i.hasClass(this.markerClassName) || (i.addClass(this.markerClassName).append(t.dpDiv), C.data(e, "datepicker", t), this._setDate(t, this._getDefaultDate(t), !0), this._updateDatepicker(t), this._updateAlternate(t), t.settings.disabled && this._disableDatepicker(e), t.dpDiv.css("display", "block"))
        },
        _dialogDatepicker: function(e, t, i, n, s) {
            var o, a, r, l, c, h = this._dialogInst;
            return h || (this.uuid += 1, o = "dp" + this.uuid, this._dialogInput = C("<input type='text' id='" + o + "' style='position: absolute; top: -100px; width: 0px;'/>"), this._dialogInput.on("keydown", this._doKeyDown), C("body").append(this._dialogInput), (h = this._dialogInst = this._newInst(this._dialogInput, !1)).settings = {}, C.data(this._dialogInput[0], "datepicker", h)), u(h.settings, n || {}), t = t && t.constructor === Date ? this._formatDate(h, t) : t, this._dialogInput.val(t), this._pos = s ? s.length ? s : [s.pageX, s.pageY] : null, this._pos || (a = document.documentElement.clientWidth, r = document.documentElement.clientHeight, l = document.documentElement.scrollLeft || document.body.scrollLeft, c = document.documentElement.scrollTop || document.body.scrollTop, this._pos = [a / 2 - 100 + l, r / 2 - 150 + c]), this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"), h.settings.onSelect = i, this._inDialog = !0, this.dpDiv.addClass(this._dialogClass), this._showDatepicker(this._dialogInput[0]), C.blockUI && C.blockUI(this.dpDiv), C.data(this._dialogInput[0], "datepicker", h), this
        },
        _destroyDatepicker: function(e) {
            var t, i = C(e),
                n = C.data(e, "datepicker");
            i.hasClass(this.markerClassName) && (t = e.nodeName.toLowerCase(), C.removeData(e, "datepicker"), "input" === t ? (n.append.remove(), n.trigger.remove(), i.removeClass(this.markerClassName).off("focus", this._showDatepicker).off("keydown", this._doKeyDown).off("keypress", this._doKeyPress).off("keyup", this._doKeyUp)) : "div" !== t && "span" !== t || i.removeClass(this.markerClassName).empty(), ie === n && (ie = null))
        },
        _enableDatepicker: function(t) {
            var e, i, n = C(t),
                s = C.data(t, "datepicker");
            n.hasClass(this.markerClassName) && ("input" === (e = t.nodeName.toLowerCase()) ? (t.disabled = !1, s.trigger.filter("button").each(function() {
                this.disabled = !1
            }).end().filter("img").css({
                opacity: "1.0",
                cursor: ""
            })) : "div" !== e && "span" !== e || ((i = n.children("." + this._inlineClass)).children().removeClass("ui-state-disabled"), i.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !1)), this._disabledInputs = C.map(this._disabledInputs, function(e) {
                return e === t ? null : e
            }))
        },
        _disableDatepicker: function(t) {
            var e, i, n = C(t),
                s = C.data(t, "datepicker");
            n.hasClass(this.markerClassName) && ("input" === (e = t.nodeName.toLowerCase()) ? (t.disabled = !0, s.trigger.filter("button").each(function() {
                this.disabled = !0
            }).end().filter("img").css({
                opacity: "0.5",
                cursor: "default"
            })) : "div" !== e && "span" !== e || ((i = n.children("." + this._inlineClass)).children().addClass("ui-state-disabled"), i.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !0)), this._disabledInputs = C.map(this._disabledInputs, function(e) {
                return e === t ? null : e
            }), this._disabledInputs[this._disabledInputs.length] = t)
        },
        _isDisabledDatepicker: function(e) {
            if (!e) return !1;
            for (var t = 0; this._disabledInputs.length > t; t++)
                if (this._disabledInputs[t] === e) return !0;
            return !1
        },
        _getInst: function(e) {
            try {
                return C.data(e, "datepicker")
            } catch (e) {
                throw "Missing instance data for this datepicker"
            }
        },
        _optionDatepicker: function(e, t, i) {
            var n, s, o, a, r = this._getInst(e);
            return 2 === arguments.length && "string" == typeof t ? "defaults" === t ? C.extend({}, C.datepicker._defaults) : r ? "all" === t ? C.extend({}, r.settings) : this._get(r, t) : null : (n = t || {}, "string" == typeof t && ((n = {})[t] = i), void(r && (this._curInst === r && this._hideDatepicker(), s = this._getDateDatepicker(e, !0), o = this._getMinMaxDate(r, "min"), a = this._getMinMaxDate(r, "max"), u(r.settings, n), null !== o && void 0 !== n.dateFormat && void 0 === n.minDate && (r.settings.minDate = this._formatDate(r, o)), null !== a && void 0 !== n.dateFormat && void 0 === n.maxDate && (r.settings.maxDate = this._formatDate(r, a)), "disabled" in n && (n.disabled ? this._disableDatepicker(e) : this._enableDatepicker(e)), this._attachments(C(e), r), this._autoSize(r), this._setDate(r, s), this._updateAlternate(r), this._updateDatepicker(r))))
        },
        _changeDatepicker: function(e, t, i) {
            this._optionDatepicker(e, t, i)
        },
        _refreshDatepicker: function(e) {
            var t = this._getInst(e);
            t && this._updateDatepicker(t)
        },
        _setDateDatepicker: function(e, t) {
            var i = this._getInst(e);
            i && (this._setDate(i, t), this._updateDatepicker(i), this._updateAlternate(i))
        },
        _getDateDatepicker: function(e, t) {
            var i = this._getInst(e);
            return i && !i.inline && this._setDateFromField(i, t), i ? this._getDate(i) : null
        },
        _doKeyDown: function(e) {
            var t, i, n, s = C.datepicker._getInst(e.target),
                o = !0,
                a = s.dpDiv.is(".ui-datepicker-rtl");
            if (s._keyEvent = !0, C.datepicker._datepickerShowing) switch (e.keyCode) {
                case 9:
                    C.datepicker._hideDatepicker(), o = !1;
                    break;
                case 13:
                    return (n = C("td." + C.datepicker._dayOverClass + ":not(." + C.datepicker._currentClass + ")", s.dpDiv))[0] && C.datepicker._selectDay(e.target, s.selectedMonth, s.selectedYear, n[0]), (t = C.datepicker._get(s, "onSelect")) ? (i = C.datepicker._formatDate(s), t.apply(s.input ? s.input[0] : null, [i, s])) : C.datepicker._hideDatepicker(), !1;
                case 27:
                    C.datepicker._hideDatepicker();
                    break;
                case 33:
                    C.datepicker._adjustDate(e.target, e.ctrlKey ? -C.datepicker._get(s, "stepBigMonths") : -C.datepicker._get(s, "stepMonths"), "M");
                    break;
                case 34:
                    C.datepicker._adjustDate(e.target, e.ctrlKey ? +C.datepicker._get(s, "stepBigMonths") : +C.datepicker._get(s, "stepMonths"), "M");
                    break;
                case 35:
                    (e.ctrlKey || e.metaKey) && C.datepicker._clearDate(e.target), o = e.ctrlKey || e.metaKey;
                    break;
                case 36:
                    (e.ctrlKey || e.metaKey) && C.datepicker._gotoToday(e.target), o = e.ctrlKey || e.metaKey;
                    break;
                case 37:
                    (e.ctrlKey || e.metaKey) && C.datepicker._adjustDate(e.target, a ? 1 : -1, "D"), o = e.ctrlKey || e.metaKey, e.originalEvent.altKey && C.datepicker._adjustDate(e.target, e.ctrlKey ? -C.datepicker._get(s, "stepBigMonths") : -C.datepicker._get(s, "stepMonths"), "M");
                    break;
                case 38:
                    (e.ctrlKey || e.metaKey) && C.datepicker._adjustDate(e.target, -7, "D"), o = e.ctrlKey || e.metaKey;
                    break;
                case 39:
                    (e.ctrlKey || e.metaKey) && C.datepicker._adjustDate(e.target, a ? -1 : 1, "D"), o = e.ctrlKey || e.metaKey, e.originalEvent.altKey && C.datepicker._adjustDate(e.target, e.ctrlKey ? +C.datepicker._get(s, "stepBigMonths") : +C.datepicker._get(s, "stepMonths"), "M");
                    break;
                case 40:
                    (e.ctrlKey || e.metaKey) && C.datepicker._adjustDate(e.target, 7, "D"), o = e.ctrlKey || e.metaKey;
                    break;
                default:
                    o = !1
            } else 36 === e.keyCode && e.ctrlKey ? C.datepicker._showDatepicker(this) : o = !1;
            o && (e.preventDefault(), e.stopPropagation())
        },
        _doKeyPress: function(e) {
            var t, i, n = C.datepicker._getInst(e.target);
            return C.datepicker._get(n, "constrainInput") ? (t = C.datepicker._possibleChars(C.datepicker._get(n, "dateFormat")), i = String.fromCharCode(null == e.charCode ? e.keyCode : e.charCode), e.ctrlKey || e.metaKey || i < " " || !t || -1 < t.indexOf(i)) : void 0
        },
        _doKeyUp: function(e) {
            var t = C.datepicker._getInst(e.target);
            if (t.input.val() !== t.lastVal) try {
                C.datepicker.parseDate(C.datepicker._get(t, "dateFormat"), t.input ? t.input.val() : null, C.datepicker._getFormatConfig(t)) && (C.datepicker._setDateFromField(t), C.datepicker._updateAlternate(t), C.datepicker._updateDatepicker(t))
            } catch (e) {}
            return !0
        },
        _showDatepicker: function(e) {
            var t, i, n, s, o, a, r;
            "input" !== (e = e.target || e).nodeName.toLowerCase() && (e = C("input", e.parentNode)[0]), C.datepicker._isDisabledDatepicker(e) || C.datepicker._lastInput === e || (t = C.datepicker._getInst(e), C.datepicker._curInst && C.datepicker._curInst !== t && (C.datepicker._curInst.dpDiv.stop(!0, !0), t && C.datepicker._datepickerShowing && C.datepicker._hideDatepicker(C.datepicker._curInst.input[0])), !1 !== (n = (i = C.datepicker._get(t, "beforeShow")) ? i.apply(e, [e, t]) : {}) && (u(t.settings, n), t.lastVal = null, C.datepicker._lastInput = e, C.datepicker._setDateFromField(t), C.datepicker._inDialog && (e.value = ""), C.datepicker._pos || (C.datepicker._pos = C.datepicker._findPos(e), C.datepicker._pos[1] += e.offsetHeight), s = !1, C(e).parents().each(function() {
                return !(s |= "fixed" === C(this).css("position"))
            }), o = {
                left: C.datepicker._pos[0],
                top: C.datepicker._pos[1]
            }, C.datepicker._pos = null, t.dpDiv.empty(), t.dpDiv.css({
                position: "absolute",
                display: "block",
                top: "-1000px"
            }), C.datepicker._updateDatepicker(t), o = C.datepicker._checkOffset(t, o, s), t.dpDiv.css({
                position: C.datepicker._inDialog && C.blockUI ? "static" : s ? "fixed" : "absolute",
                display: "none",
                left: o.left + "px",
                top: o.top + "px"
            }), t.inline || (a = C.datepicker._get(t, "showAnim"), r = C.datepicker._get(t, "duration"), t.dpDiv.css("z-index", function(e) {
                for (var t, i; e.length && e[0] !== document;) {
                    if (("absolute" === (t = e.css("position")) || "relative" === t || "fixed" === t) && (i = parseInt(e.css("zIndex"), 10), !isNaN(i) && 0 !== i)) return i;
                    e = e.parent()
                }
                return 0
            }(C(e)) + 1), C.datepicker._datepickerShowing = !0, C.effects && C.effects.effect[a] ? t.dpDiv.show(a, C.datepicker._get(t, "showOptions"), r) : t.dpDiv[a || "show"](a ? r : null), C.datepicker._shouldFocusInput(t) && t.input.trigger("focus"), C.datepicker._curInst = t)))
        },
        _updateDatepicker: function(e) {
            this.maxRows = 4, (ie = e).dpDiv.empty().append(this._generateHTML(e)), this._attachHandlers(e);
            var t, i = this._getNumberOfMonths(e),
                n = i[1],
                s = e.dpDiv.find("." + this._dayOverClass + " a");
            0 < s.length && o.apply(s.get(0)), e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""), 1 < n && e.dpDiv.addClass("ui-datepicker-multi-" + n).css("width", 17 * n + "em"), e.dpDiv[(1 !== i[0] || 1 !== i[1] ? "add" : "remove") + "Class"]("ui-datepicker-multi"), e.dpDiv[(this._get(e, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"), e === C.datepicker._curInst && C.datepicker._datepickerShowing && C.datepicker._shouldFocusInput(e) && e.input.trigger("focus"), e.yearshtml && (t = e.yearshtml, setTimeout(function() {
                t === e.yearshtml && e.yearshtml && e.dpDiv.find("select.ui-datepicker-year:first").replaceWith(e.yearshtml), t = e.yearshtml = null
            }, 0))
        },
        _shouldFocusInput: function(e) {
            return e.input && e.input.is(":visible") && !e.input.is(":disabled") && !e.input.is(":focus")
        },
        _checkOffset: function(e, t, i) {
            var n = e.dpDiv.outerWidth(),
                s = e.dpDiv.outerHeight(),
                o = e.input ? e.input.outerWidth() : 0,
                a = e.input ? e.input.outerHeight() : 0,
                r = document.documentElement.clientWidth + (i ? 0 : C(document).scrollLeft()),
                l = document.documentElement.clientHeight + (i ? 0 : C(document).scrollTop());
            return t.left -= this._get(e, "isRTL") ? n - o : 0, t.left -= i && t.left === e.input.offset().left ? C(document).scrollLeft() : 0, t.top -= i && t.top === e.input.offset().top + a ? C(document).scrollTop() : 0, t.left -= Math.min(t.left, t.left + n > r && n < r ? Math.abs(t.left + n - r) : 0), t.top -= Math.min(t.top, t.top + s > l && s < l ? Math.abs(s + a) : 0), t
        },
        _findPos: function(e) {
            for (var t, i = this._getInst(e), n = this._get(i, "isRTL"); e && ("hidden" === e.type || 1 !== e.nodeType || C.expr.filters.hidden(e));) e = e[n ? "previousSibling" : "nextSibling"];
            return [(t = C(e).offset()).left, t.top]
        },
        _hideDatepicker: function(e) {
            var t, i, n, s, o = this._curInst;
            !o || e && o !== C.data(e, "datepicker") || this._datepickerShowing && (t = this._get(o, "showAnim"), i = this._get(o, "duration"), n = function() {
                C.datepicker._tidyDialog(o)
            }, C.effects && (C.effects.effect[t] || C.effects[t]) ? o.dpDiv.hide(t, C.datepicker._get(o, "showOptions"), i, n) : o.dpDiv["slideDown" === t ? "slideUp" : "fadeIn" === t ? "fadeOut" : "hide"](t ? i : null, n), t || n(), this._datepickerShowing = !1, (s = this._get(o, "onClose")) && s.apply(o.input ? o.input[0] : null, [o.input ? o.input.val() : "", o]), this._lastInput = null, this._inDialog && (this._dialogInput.css({
                position: "absolute",
                left: "0",
                top: "-100px"
            }), C.blockUI && (C.unblockUI(), C("body").append(this.dpDiv))), this._inDialog = !1)
        },
        _tidyDialog: function(e) {
            e.dpDiv.removeClass(this._dialogClass).off(".ui-datepicker-calendar")
        },
        _checkExternalClick: function(e) {
            if (C.datepicker._curInst) {
                var t = C(e.target),
                    i = C.datepicker._getInst(t[0]);
                (t[0].id === C.datepicker._mainDivId || 0 !== t.parents("#" + C.datepicker._mainDivId).length || t.hasClass(C.datepicker.markerClassName) || t.closest("." + C.datepicker._triggerClass).length || !C.datepicker._datepickerShowing || C.datepicker._inDialog && C.blockUI) && (!t.hasClass(C.datepicker.markerClassName) || C.datepicker._curInst === i) || C.datepicker._hideDatepicker()
            }
        },
        _adjustDate: function(e, t, i) {
            var n = C(e),
                s = this._getInst(n[0]);
            this._isDisabledDatepicker(n[0]) || (this._adjustInstDate(s, t + ("M" === i ? this._get(s, "showCurrentAtPos") : 0), i), this._updateDatepicker(s))
        },
        _gotoToday: function(e) {
            var t, i = C(e),
                n = this._getInst(i[0]);
            this._get(n, "gotoCurrent") && n.currentDay ? (n.selectedDay = n.currentDay, n.drawMonth = n.selectedMonth = n.currentMonth, n.drawYear = n.selectedYear = n.currentYear) : (t = new Date, n.selectedDay = t.getDate(), n.drawMonth = n.selectedMonth = t.getMonth(), n.drawYear = n.selectedYear = t.getFullYear()), this._notifyChange(n), this._adjustDate(i)
        },
        _selectMonthYear: function(e, t, i) {
            var n = C(e),
                s = this._getInst(n[0]);
            s["selected" + ("M" === i ? "Month" : "Year")] = s["draw" + ("M" === i ? "Month" : "Year")] = parseInt(t.options[t.selectedIndex].value, 10), this._notifyChange(s), this._adjustDate(n)
        },
        _selectDay: function(e, t, i, n) {
            var s, o = C(e);
            C(n).hasClass(this._unselectableClass) || this._isDisabledDatepicker(o[0]) || ((s = this._getInst(o[0])).selectedDay = s.currentDay = C("a", n).html(), s.selectedMonth = s.currentMonth = t, s.selectedYear = s.currentYear = i, this._selectDate(e, this._formatDate(s, s.currentDay, s.currentMonth, s.currentYear)))
        },
        _clearDate: function(e) {
            var t = C(e);
            this._selectDate(t, "")
        },
        _selectDate: function(e, t) {
            var i, n = C(e),
                s = this._getInst(n[0]);
            t = null != t ? t : this._formatDate(s), s.input && s.input.val(t), this._updateAlternate(s), (i = this._get(s, "onSelect")) ? i.apply(s.input ? s.input[0] : null, [t, s]) : s.input && s.input.trigger("change"), s.inline ? this._updateDatepicker(s) : (this._hideDatepicker(), this._lastInput = s.input[0], "object" != typeof s.input[0] && s.input.trigger("focus"), this._lastInput = null)
        },
        _updateAlternate: function(e) {
            var t, i, n, s = this._get(e, "altField");
            s && (t = this._get(e, "altFormat") || this._get(e, "dateFormat"), i = this._getDate(e), n = this.formatDate(t, i, this._getFormatConfig(e)), C(s).val(n))
        },
        noWeekends: function(e) {
            var t = e.getDay();
            return [0 < t && t < 6, ""]
        },
        iso8601Week: function(e) {
            var t, i = new Date(e.getTime());
            return i.setDate(i.getDate() + 4 - (i.getDay() || 7)), t = i.getTime(), i.setMonth(0), i.setDate(1), Math.floor(Math.round((t - i) / 864e5) / 7) + 1
        },
        parseDate: function(i, o, e) {
            if (null == i || null == o) throw "Invalid arguments";
            if (!(o = "object" == typeof o ? "" + o : o + "")) return null;

            function a(e) {
                var t = i.length > r + 1 && i.charAt(r + 1) === e;
                return t && r++, t
            }

            function t(e) {
                var t = a(e),
                    i = "@" === e ? 14 : "!" === e ? 20 : "y" === e && t ? 4 : "o" === e ? 3 : 2,
                    n = RegExp("^\\d{" + ("y" === e ? i : 1) + "," + i + "}"),
                    s = o.substring(u).match(n);
                if (!s) throw "Missing number at position " + u;
                return u += s[0].length, parseInt(s[0], 10)
            }

            function n(e, t, i) {
                var n = -1,
                    s = C.map(a(e) ? i : t, function(e, t) {
                        return [
                            [t, e]
                        ]
                    }).sort(function(e, t) {
                        return -(e[1].length - t[1].length)
                    });
                if (C.each(s, function(e, t) {
                        var i = t[1];
                        return o.substr(u, i.length).toLowerCase() === i.toLowerCase() ? (n = t[0], u += i.length, !1) : void 0
                    }), -1 !== n) return n + 1;
                throw "Unknown name at position " + u
            }

            function s() {
                if (o.charAt(u) !== i.charAt(r)) throw "Unexpected literal at position " + u;
                u++
            }
            var r, l, c, h, u = 0,
                d = (e ? e.shortYearCutoff : null) || this._defaults.shortYearCutoff,
                p = "string" != typeof d ? d : (new Date).getFullYear() % 100 + parseInt(d, 10),
                f = (e ? e.dayNamesShort : null) || this._defaults.dayNamesShort,
                m = (e ? e.dayNames : null) || this._defaults.dayNames,
                g = (e ? e.monthNamesShort : null) || this._defaults.monthNamesShort,
                v = (e ? e.monthNames : null) || this._defaults.monthNames,
                b = -1,
                _ = -1,
                y = -1,
                w = -1,
                x = !1;
            for (r = 0; i.length > r; r++)
                if (x) "'" !== i.charAt(r) || a("'") ? s() : x = !1;
                else switch (i.charAt(r)) {
                    case "d":
                        y = t("d");
                        break;
                    case "D":
                        n("D", f, m);
                        break;
                    case "o":
                        w = t("o");
                        break;
                    case "m":
                        _ = t("m");
                        break;
                    case "M":
                        _ = n("M", g, v);
                        break;
                    case "y":
                        b = t("y");
                        break;
                    case "@":
                        b = (h = new Date(t("@"))).getFullYear(), _ = h.getMonth() + 1, y = h.getDate();
                        break;
                    case "!":
                        b = (h = new Date((t("!") - this._ticksTo1970) / 1e4)).getFullYear(), _ = h.getMonth() + 1, y = h.getDate();
                        break;
                    case "'":
                        a("'") ? s() : x = !0;
                        break;
                    default:
                        s()
                }
                if (o.length > u && (c = o.substr(u), !/^\s+/.test(c))) throw "Extra/unparsed characters found in date: " + c;
            if (-1 === b ? b = (new Date).getFullYear() : b < 100 && (b += (new Date).getFullYear() - (new Date).getFullYear() % 100 + (b <= p ? 0 : -100)), -1 < w)
                for (_ = 1, y = w; !(y <= (l = this._getDaysInMonth(b, _ - 1)));) _++, y -= l;
            if ((h = this._daylightSavingAdjust(new Date(b, _ - 1, y))).getFullYear() !== b || h.getMonth() + 1 !== _ || h.getDate() !== y) throw "Invalid date";
            return h
        },
        ATOM: "yy-mm-dd",
        COOKIE: "D, dd M yy",
        ISO_8601: "yy-mm-dd",
        RFC_822: "D, d M y",
        RFC_850: "DD, dd-M-y",
        RFC_1036: "D, d M y",
        RFC_1123: "D, d M yy",
        RFC_2822: "D, d M yy",
        RSS: "D, d M y",
        TICKS: "!",
        TIMESTAMP: "@",
        W3C: "yy-mm-dd",
        _ticksTo1970: 864e9 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)),
        formatDate: function(i, e, t) {
            if (!e) return "";

            function s(e) {
                var t = i.length > a + 1 && i.charAt(a + 1) === e;
                return t && a++, t
            }

            function n(e, t, i) {
                var n = "" + t;
                if (s(e))
                    for (; i > n.length;) n = "0" + n;
                return n
            }

            function o(e, t, i, n) {
                return s(e) ? n[t] : i[t]
            }
            var a, r = (t ? t.dayNamesShort : null) || this._defaults.dayNamesShort,
                l = (t ? t.dayNames : null) || this._defaults.dayNames,
                c = (t ? t.monthNamesShort : null) || this._defaults.monthNamesShort,
                h = (t ? t.monthNames : null) || this._defaults.monthNames,
                u = "",
                d = !1;
            if (e)
                for (a = 0; i.length > a; a++)
                    if (d) "'" !== i.charAt(a) || s("'") ? u += i.charAt(a) : d = !1;
                    else switch (i.charAt(a)) {
                        case "d":
                            u += n("d", e.getDate(), 2);
                            break;
                        case "D":
                            u += o("D", e.getDay(), r, l);
                            break;
                        case "o":
                            u += n("o", Math.round((new Date(e.getFullYear(), e.getMonth(), e.getDate()).getTime() - new Date(e.getFullYear(), 0, 0).getTime()) / 864e5), 3);
                            break;
                        case "m":
                            u += n("m", e.getMonth() + 1, 2);
                            break;
                        case "M":
                            u += o("M", e.getMonth(), c, h);
                            break;
                        case "y":
                            u += s("y") ? e.getFullYear() : (e.getFullYear() % 100 < 10 ? "0" : "") + e.getFullYear() % 100;
                            break;
                        case "@":
                            u += e.getTime();
                            break;
                        case "!":
                            u += 1e4 * e.getTime() + this._ticksTo1970;
                            break;
                        case "'":
                            s("'") ? u += "'" : d = !0;
                            break;
                        default:
                            u += i.charAt(a)
                    }
                    return u
        },
        _possibleChars: function(i) {
            function e(e) {
                var t = i.length > n + 1 && i.charAt(n + 1) === e;
                return t && n++, t
            }
            var n, t = "",
                s = !1;
            for (n = 0; i.length > n; n++)
                if (s) "'" !== i.charAt(n) || e("'") ? t += i.charAt(n) : s = !1;
                else switch (i.charAt(n)) {
                    case "d":
                    case "m":
                    case "y":
                    case "@":
                        t += "0123456789";
                        break;
                    case "D":
                    case "M":
                        return null;
                    case "'":
                        e("'") ? t += "'" : s = !0;
                        break;
                    default:
                        t += i.charAt(n)
                }
                return t
        },
        _get: function(e, t) {
            return void 0 !== e.settings[t] ? e.settings[t] : this._defaults[t]
        },
        _setDateFromField: function(e, t) {
            if (e.input.val() !== e.lastVal) {
                var i = this._get(e, "dateFormat"),
                    n = e.lastVal = e.input ? e.input.val() : null,
                    s = this._getDefaultDate(e),
                    o = s,
                    a = this._getFormatConfig(e);
                try {
                    o = this.parseDate(i, n, a) || s
                } catch (e) {
                    n = t ? "" : n
                }
                e.selectedDay = o.getDate(), e.drawMonth = e.selectedMonth = o.getMonth(), e.drawYear = e.selectedYear = o.getFullYear(), e.currentDay = n ? o.getDate() : 0, e.currentMonth = n ? o.getMonth() : 0, e.currentYear = n ? o.getFullYear() : 0, this._adjustInstDate(e)
            }
        },
        _getDefaultDate: function(e) {
            return this._restrictMinMax(e, this._determineDate(e, this._get(e, "defaultDate"), new Date))
        },
        _determineDate: function(r, e, t) {
            var i, n, s = null == e || "" === e ? t : "string" == typeof e ? function(e) {
                try {
                    return C.datepicker.parseDate(C.datepicker._get(r, "dateFormat"), e, C.datepicker._getFormatConfig(r))
                } catch (e) {}
                for (var t = (e.toLowerCase().match(/^c/) ? C.datepicker._getDate(r) : null) || new Date, i = t.getFullYear(), n = t.getMonth(), s = t.getDate(), o = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, a = o.exec(e); a;) {
                    switch (a[2] || "d") {
                        case "d":
                        case "D":
                            s += parseInt(a[1], 10);
                            break;
                        case "w":
                        case "W":
                            s += 7 * parseInt(a[1], 10);
                            break;
                        case "m":
                        case "M":
                            n += parseInt(a[1], 10), s = Math.min(s, C.datepicker._getDaysInMonth(i, n));
                            break;
                        case "y":
                        case "Y":
                            i += parseInt(a[1], 10), s = Math.min(s, C.datepicker._getDaysInMonth(i, n))
                    }
                    a = o.exec(e)
                }
                return new Date(i, n, s)
            }(e) : "number" == typeof e ? isNaN(e) ? t : (i = e, (n = new Date).setDate(n.getDate() + i), n) : new Date(e.getTime());
            return (s = s && "Invalid Date" == "" + s ? t : s) && (s.setHours(0), s.setMinutes(0), s.setSeconds(0), s.setMilliseconds(0)), this._daylightSavingAdjust(s)
        },
        _daylightSavingAdjust: function(e) {
            return e ? (e.setHours(12 < e.getHours() ? e.getHours() + 2 : 0), e) : null
        },
        _setDate: function(e, t, i) {
            var n = !t,
                s = e.selectedMonth,
                o = e.selectedYear,
                a = this._restrictMinMax(e, this._determineDate(e, t, new Date));
            e.selectedDay = e.currentDay = a.getDate(), e.drawMonth = e.selectedMonth = e.currentMonth = a.getMonth(), e.drawYear = e.selectedYear = e.currentYear = a.getFullYear(), s === e.selectedMonth && o === e.selectedYear || i || this._notifyChange(e), this._adjustInstDate(e), e.input && e.input.val(n ? "" : this._formatDate(e))
        },
        _getDate: function(e) {
            return !e.currentYear || e.input && "" === e.input.val() ? null : this._daylightSavingAdjust(new Date(e.currentYear, e.currentMonth, e.currentDay))
        },
        _attachHandlers: function(e) {
            var t = this._get(e, "stepMonths"),
                i = "#" + e.id.replace(/\\\\/g, "\\");
            e.dpDiv.find("[data-handler]").map(function() {
                var e = {
                    prev: function() {
                        C.datepicker._adjustDate(i, -t, "M")
                    },
                    next: function() {
                        C.datepicker._adjustDate(i, +t, "M")
                    },
                    hide: function() {
                        C.datepicker._hideDatepicker()
                    },
                    today: function() {
                        C.datepicker._gotoToday(i)
                    },
                    selectDay: function() {
                        return C.datepicker._selectDay(i, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this), !1
                    },
                    selectMonth: function() {
                        return C.datepicker._selectMonthYear(i, this, "M"), !1
                    },
                    selectYear: function() {
                        return C.datepicker._selectMonthYear(i, this, "Y"), !1
                    }
                };
                C(this).on(this.getAttribute("data-event"), e[this.getAttribute("data-handler")])
            })
        },
        _generateHTML: function(e) {
            var t, i, n, s, o, a, r, l, c, h, u, d, p, f, m, g, v, b, _, y, w, x, C, k, D, T, S, I, E, A, N, M, O, P, H, z, L, $, F, W = new Date,
                j = this._daylightSavingAdjust(new Date(W.getFullYear(), W.getMonth(), W.getDate())),
                R = this._get(e, "isRTL"),
                B = this._get(e, "showButtonPanel"),
                q = this._get(e, "hideIfNoPrevNext"),
                U = this._get(e, "navigationAsDateFormat"),
                V = this._getNumberOfMonths(e),
                Y = this._get(e, "showCurrentAtPos"),
                K = this._get(e, "stepMonths"),
                G = 1 !== V[0] || 1 !== V[1],
                X = this._daylightSavingAdjust(e.currentDay ? new Date(e.currentYear, e.currentMonth, e.currentDay) : new Date(9999, 9, 9)),
                Q = this._getMinMaxDate(e, "min"),
                J = this._getMinMaxDate(e, "max"),
                Z = e.drawMonth - Y,
                ee = e.drawYear;
            if (Z < 0 && (Z += 12, ee--), J)
                for (t = this._daylightSavingAdjust(new Date(J.getFullYear(), J.getMonth() - V[0] * V[1] + 1, J.getDate())), t = Q && t < Q ? Q : t; this._daylightSavingAdjust(new Date(ee, Z, 1)) > t;) --Z < 0 && (Z = 11, ee--);
            for (e.drawMonth = Z, e.drawYear = ee, i = this._get(e, "prevText"), i = U ? this.formatDate(i, this._daylightSavingAdjust(new Date(ee, Z - K, 1)), this._getFormatConfig(e)) : i, n = this._canAdjustMonth(e, -1, ee, Z) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (R ? "e" : "w") + "'>" + i + "</span></a>" : q ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (R ? "e" : "w") + "'>" + i + "</span></a>", s = this._get(e, "nextText"), s = U ? this.formatDate(s, this._daylightSavingAdjust(new Date(ee, Z + K, 1)), this._getFormatConfig(e)) : s, o = this._canAdjustMonth(e, 1, ee, Z) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + s + "'><span class='ui-icon ui-icon-circle-triangle-" + (R ? "w" : "e") + "'>" + s + "</span></a>" : q ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + s + "'><span class='ui-icon ui-icon-circle-triangle-" + (R ? "w" : "e") + "'>" + s + "</span></a>", a = this._get(e, "currentText"), r = this._get(e, "gotoCurrent") && e.currentDay ? X : j, a = U ? this.formatDate(a, r, this._getFormatConfig(e)) : a, l = e.inline ? "" : "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(e, "closeText") + "</button>", c = B ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (R ? l : "") + (this._isInRange(e, r) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + a + "</button>" : "") + (R ? "" : l) + "</div>" : "", h = parseInt(this._get(e, "firstDay"), 10), h = isNaN(h) ? 0 : h, u = this._get(e, "showWeek"), d = this._get(e, "dayNames"), p = this._get(e, "dayNamesMin"), f = this._get(e, "monthNames"), m = this._get(e, "monthNamesShort"), g = this._get(e, "beforeShowDay"), v = this._get(e, "showOtherMonths"), b = this._get(e, "selectOtherMonths"), _ = this._getDefaultDate(e), y = "", x = 0; V[0] > x; x++) {
                for (C = "", this.maxRows = 4, k = 0; V[1] > k; k++) {
                    if (D = this._daylightSavingAdjust(new Date(ee, Z, e.selectedDay)), T = " ui-corner-all", S = "", G) {
                        if (S += "<div class='ui-datepicker-group", 1 < V[1]) switch (k) {
                            case 0:
                                S += " ui-datepicker-group-first", T = " ui-corner-" + (R ? "right" : "left");
                                break;
                            case V[1] - 1:
                                S += " ui-datepicker-group-last", T = " ui-corner-" + (R ? "left" : "right");
                                break;
                            default:
                                S += " ui-datepicker-group-middle", T = ""
                        }
                        S += "'>"
                    }
                    for (S += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + T + "'>" + (/all|left/.test(T) && 0 === x ? R ? o : n : "") + (/all|right/.test(T) && 0 === x ? R ? n : o : "") + this._generateMonthYearHeader(e, Z, ee, Q, J, 0 < x || 0 < k, f, m) + "</div><table class='ui-datepicker-calendar'><thead><tr>", I = u ? "<th class='ui-datepicker-week-col'>" + this._get(e, "weekHeader") + "</th>" : "", w = 0; w < 7; w++) I += "<th scope='col'" + (5 <= (w + h + 6) % 7 ? " class='ui-datepicker-week-end'" : "") + "><span title='" + d[E = (w + h) % 7] + "'>" + p[E] + "</span></th>";
                    for (S += I + "</tr></thead><tbody>", A = this._getDaysInMonth(ee, Z), ee === e.selectedYear && Z === e.selectedMonth && (e.selectedDay = Math.min(e.selectedDay, A)), N = (this._getFirstDayOfMonth(ee, Z) - h + 7) % 7, M = Math.ceil((N + A) / 7), O = G && this.maxRows > M ? this.maxRows : M, this.maxRows = O, P = this._daylightSavingAdjust(new Date(ee, Z, 1 - N)), H = 0; H < O; H++) {
                        for (S += "<tr>", z = u ? "<td class='ui-datepicker-week-col'>" + this._get(e, "calculateWeek")(P) + "</td>" : "", w = 0; w < 7; w++) L = g ? g.apply(e.input ? e.input[0] : null, [P]) : [!0, ""], F = ($ = P.getMonth() !== Z) && !b || !L[0] || Q && P < Q || J && J < P, z += "<td class='" + (5 <= (w + h + 6) % 7 ? " ui-datepicker-week-end" : "") + ($ ? " ui-datepicker-other-month" : "") + (P.getTime() === D.getTime() && Z === e.selectedMonth && e._keyEvent || _.getTime() === P.getTime() && _.getTime() === D.getTime() ? " " + this._dayOverClass : "") + (F ? " " + this._unselectableClass + " ui-state-disabled" : "") + ($ && !v ? "" : " " + L[1] + (P.getTime() === X.getTime() ? " " + this._currentClass : "") + (P.getTime() === j.getTime() ? " ui-datepicker-today" : "")) + "'" + ($ && !v || !L[2] ? "" : " title='" + L[2].replace(/'/g, "&#39;") + "'") + (F ? "" : " data-handler='selectDay' data-event='click' data-month='" + P.getMonth() + "' data-year='" + P.getFullYear() + "'") + ">" + ($ && !v ? "&#xa0;" : F ? "<span class='ui-state-default'>" + P.getDate() + "</span>" : "<a class='ui-state-default" + (P.getTime() === j.getTime() ? " ui-state-highlight" : "") + (P.getTime() === X.getTime() ? " ui-state-active" : "") + ($ ? " ui-priority-secondary" : "") + "' href='#'>" + P.getDate() + "</a>") + "</td>", P.setDate(P.getDate() + 1), P = this._daylightSavingAdjust(P);
                        S += z + "</tr>"
                    }
                    11 < ++Z && (Z = 0, ee++), C += S += "</tbody></table>" + (G ? "</div>" + (0 < V[0] && k === V[1] - 1 ? "<div class='ui-datepicker-row-break'></div>" : "") : "")
                }
                y += C
            }
            return y += c, e._keyEvent = !1, y
        },
        _generateMonthYearHeader: function(e, t, i, n, s, o, a, r) {
            var l, c, h, u, d, p, f, m, g = this._get(e, "changeMonth"),
                v = this._get(e, "changeYear"),
                b = this._get(e, "showMonthAfterYear"),
                _ = "<div class='ui-datepicker-title'>",
                y = "";
            if (o || !g) y += "<span class='ui-datepicker-month'>" + a[t] + "</span>";
            else {
                for (l = n && n.getFullYear() === i, c = s && s.getFullYear() === i, y += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>", h = 0; h < 12; h++)(!l || h >= n.getMonth()) && (!c || s.getMonth() >= h) && (y += "<option value='" + h + "'" + (h === t ? " selected='selected'" : "") + ">" + r[h] + "</option>");
                y += "</select>"
            }
            if (b || (_ += y + (!o && g && v ? "" : "&#xa0;")), !e.yearshtml)
                if (e.yearshtml = "", o || !v) _ += "<span class='ui-datepicker-year'>" + i + "</span>";
                else {
                    for (u = this._get(e, "yearRange").split(":"), d = (new Date).getFullYear(), f = (p = function(e) {
                            var t = e.match(/c[+\-].*/) ? i + parseInt(e.substring(1), 10) : e.match(/[+\-].*/) ? d + parseInt(e, 10) : parseInt(e, 10);
                            return isNaN(t) ? d : t
                        })(u[0]), m = Math.max(f, p(u[1] || "")), f = n ? Math.max(f, n.getFullYear()) : f, m = s ? Math.min(m, s.getFullYear()) : m, e.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; f <= m; f++) e.yearshtml += "<option value='" + f + "'" + (f === i ? " selected='selected'" : "") + ">" + f + "</option>";
                    e.yearshtml += "</select>", _ += e.yearshtml, e.yearshtml = null
                }
            return _ += this._get(e, "yearSuffix"), b && (_ += (!o && g && v ? "" : "&#xa0;") + y), _ + "</div>"
        },
        _adjustInstDate: function(e, t, i) {
            var n = e.selectedYear + ("Y" === i ? t : 0),
                s = e.selectedMonth + ("M" === i ? t : 0),
                o = Math.min(e.selectedDay, this._getDaysInMonth(n, s)) + ("D" === i ? t : 0),
                a = this._restrictMinMax(e, this._daylightSavingAdjust(new Date(n, s, o)));
            e.selectedDay = a.getDate(), e.drawMonth = e.selectedMonth = a.getMonth(), e.drawYear = e.selectedYear = a.getFullYear(), "M" !== i && "Y" !== i || this._notifyChange(e)
        },
        _restrictMinMax: function(e, t) {
            var i = this._getMinMaxDate(e, "min"),
                n = this._getMinMaxDate(e, "max"),
                s = i && t < i ? i : t;
            return n && n < s ? n : s
        },
        _notifyChange: function(e) {
            var t = this._get(e, "onChangeMonthYear");
            t && t.apply(e.input ? e.input[0] : null, [e.selectedYear, e.selectedMonth + 1, e])
        },
        _getNumberOfMonths: function(e) {
            var t = this._get(e, "numberOfMonths");
            return null == t ? [1, 1] : "number" == typeof t ? [1, t] : t
        },
        _getMinMaxDate: function(e, t) {
            return this._determineDate(e, this._get(e, t + "Date"), null)
        },
        _getDaysInMonth: function(e, t) {
            return 32 - this._daylightSavingAdjust(new Date(e, t, 32)).getDate()
        },
        _getFirstDayOfMonth: function(e, t) {
            return new Date(e, t, 1).getDay()
        },
        _canAdjustMonth: function(e, t, i, n) {
            var s = this._getNumberOfMonths(e),
                o = this._daylightSavingAdjust(new Date(i, n + (t < 0 ? t : s[0] * s[1]), 1));
            return t < 0 && o.setDate(this._getDaysInMonth(o.getFullYear(), o.getMonth())), this._isInRange(e, o)
        },
        _isInRange: function(e, t) {
            var i, n, s = this._getMinMaxDate(e, "min"),
                o = this._getMinMaxDate(e, "max"),
                a = null,
                r = null,
                l = this._get(e, "yearRange");
            return l && (i = l.split(":"), n = (new Date).getFullYear(), a = parseInt(i[0], 10), r = parseInt(i[1], 10), i[0].match(/[+\-].*/) && (a += n), i[1].match(/[+\-].*/) && (r += n)), (!s || t.getTime() >= s.getTime()) && (!o || t.getTime() <= o.getTime()) && (!a || t.getFullYear() >= a) && (!r || r >= t.getFullYear())
        },
        _getFormatConfig: function(e) {
            var t = this._get(e, "shortYearCutoff");
            return {
                shortYearCutoff: t = "string" != typeof t ? t : (new Date).getFullYear() % 100 + parseInt(t, 10),
                dayNamesShort: this._get(e, "dayNamesShort"),
                dayNames: this._get(e, "dayNames"),
                monthNamesShort: this._get(e, "monthNamesShort"),
                monthNames: this._get(e, "monthNames")
            }
        },
        _formatDate: function(e, t, i, n) {
            t || (e.currentDay = e.selectedDay, e.currentMonth = e.selectedMonth, e.currentYear = e.selectedYear);
            var s = t ? "object" == typeof t ? t : this._daylightSavingAdjust(new Date(n, i, t)) : this._daylightSavingAdjust(new Date(e.currentYear, e.currentMonth, e.currentDay));
            return this.formatDate(this._get(e, "dateFormat"), s, this._getFormatConfig(e))
        }
    }), C.fn.datepicker = function(e) {
        if (!this.length) return this;
        C.datepicker.initialized || (C(document).on("mousedown", C.datepicker._checkExternalClick), C.datepicker.initialized = !0), 0 === C("#" + C.datepicker._mainDivId).length && C("body").append(C.datepicker.dpDiv);
        var t = Array.prototype.slice.call(arguments, 1);
        return "string" != typeof e || "isDisabled" !== e && "getDate" !== e && "widget" !== e ? "option" === e && 2 === arguments.length && "string" == typeof arguments[1] ? C.datepicker["_" + e + "Datepicker"].apply(C.datepicker, [this[0]].concat(t)) : this.each(function() {
            "string" == typeof e ? C.datepicker["_" + e + "Datepicker"].apply(C.datepicker, [this].concat(t)) : C.datepicker._attachDatepicker(this, e)
        }) : C.datepicker["_" + e + "Datepicker"].apply(C.datepicker, [this[0]].concat(t))
    }, C.datepicker = new e, C.datepicker.initialized = !1, C.datepicker.uuid = (new Date).getTime(), C.datepicker.version = "1.12.1", C.datepicker, C.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());
    var se = !1;
    C(document).on("mouseup", function() {
        se = !1
    }), C.widget("ui.mouse", {
        version: "1.12.1",
        options: {
            cancel: "input, textarea, button, select, option",
            distance: 1,
            delay: 0
        },
        _mouseInit: function() {
            var t = this;
            this.element.on("mousedown." + this.widgetName, function(e) {
                return t._mouseDown(e)
            }).on("click." + this.widgetName, function(e) {
                return !0 === C.data(e.target, t.widgetName + ".preventClickEvent") ? (C.removeData(e.target, t.widgetName + ".preventClickEvent"), e.stopImmediatePropagation(), !1) : void 0
            }), this.started = !1
        },
        _mouseDestroy: function() {
            this.element.off("." + this.widgetName), this._mouseMoveDelegate && this.document.off("mousemove." + this.widgetName, this._mouseMoveDelegate).off("mouseup." + this.widgetName, this._mouseUpDelegate)
        },
        _mouseDown: function(e) {
            if (!se) {
                this._mouseMoved = !1, this._mouseStarted && this._mouseUp(e), this._mouseDownEvent = e;
                var t = this,
                    i = 1 === e.which,
                    n = !("string" != typeof this.options.cancel || !e.target.nodeName) && C(e.target).closest(this.options.cancel).length;
                return i && !n && this._mouseCapture(e) && (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() {
                    t.mouseDelayMet = !0
                }, this.options.delay)), this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = !1 !== this._mouseStart(e), !this._mouseStarted) ? e.preventDefault() : (!0 === C.data(e.target, this.widgetName + ".preventClickEvent") && C.removeData(e.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function(e) {
                    return t._mouseMove(e)
                }, this._mouseUpDelegate = function(e) {
                    return t._mouseUp(e)
                }, this.document.on("mousemove." + this.widgetName, this._mouseMoveDelegate).on("mouseup." + this.widgetName, this._mouseUpDelegate), e.preventDefault(), se = !0)), !0
            }
        },
        _mouseMove: function(e) {
            if (this._mouseMoved) {
                if (C.ui.ie && (!document.documentMode || document.documentMode < 9) && !e.button) return this._mouseUp(e);
                if (!e.which)
                    if (e.originalEvent.altKey || e.originalEvent.ctrlKey || e.originalEvent.metaKey || e.originalEvent.shiftKey) this.ignoreMissingWhich = !0;
                    else if (!this.ignoreMissingWhich) return this._mouseUp(e)
            }
            return (e.which || e.button) && (this._mouseMoved = !0), this._mouseStarted ? (this._mouseDrag(e), e.preventDefault()) : (this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = !1 !== this._mouseStart(this._mouseDownEvent, e), this._mouseStarted ? this._mouseDrag(e) : this._mouseUp(e)), !this._mouseStarted)
        },
        _mouseUp: function(e) {
            this.document.off("mousemove." + this.widgetName, this._mouseMoveDelegate).off("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && C.data(e.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(e)), this._mouseDelayTimer && (clearTimeout(this._mouseDelayTimer), delete this._mouseDelayTimer), this.ignoreMissingWhich = !1, se = !1, e.preventDefault()
        },
        _mouseDistanceMet: function(e) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - e.pageX), Math.abs(this._mouseDownEvent.pageY - e.pageY)) >= this.options.distance
        },
        _mouseDelayMet: function() {
            return this.mouseDelayMet
        },
        _mouseStart: function() {},
        _mouseDrag: function() {},
        _mouseStop: function() {},
        _mouseCapture: function() {
            return !0
        }
    }), C.ui.plugin = {
        add: function(e, t, i) {
            var n, s = C.ui[e].prototype;
            for (n in i) s.plugins[n] = s.plugins[n] || [], s.plugins[n].push([t, i[n]])
        },
        call: function(e, t, i, n) {
            var s, o = e.plugins[t];
            if (o && (n || e.element[0].parentNode && 11 !== e.element[0].parentNode.nodeType))
                for (s = 0; o.length > s; s++) e.options[o[s][0]] && o[s][1].apply(e.element, i)
        }
    }, C.ui.safeBlur = function(e) {
        e && "body" !== e.nodeName.toLowerCase() && C(e).trigger("blur")
    }, C.widget("ui.draggable", C.ui.mouse, {
        version: "1.12.1",
        widgetEventPrefix: "drag",
        options: {
            addClasses: !0,
            appendTo: "parent",
            axis: !1,
            connectToSortable: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            iframeFix: !1,
            opacity: !1,
            refreshPositions: !1,
            revert: !1,
            revertDuration: 500,
            scope: "default",
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            snap: !1,
            snapMode: "both",
            snapTolerance: 20,
            stack: !1,
            zIndex: !1,
            drag: null,
            start: null,
            stop: null
        },
        _create: function() {
            "original" === this.options.helper && this._setPositionRelative(), this.options.addClasses && this._addClass("ui-draggable"), this._setHandleClassName(), this._mouseInit()
        },
        _setOption: function(e, t) {
            this._super(e, t), "handle" === e && (this._removeHandleClassName(), this._setHandleClassName())
        },
        _destroy: function() {
            return (this.helper || this.element).is(".ui-draggable-dragging") ? void(this.destroyOnClear = !0) : (this._removeHandleClassName(), void this._mouseDestroy())
        },
        _mouseCapture: function(e) {
            var t = this.options;
            return !(this.helper || t.disabled || 0 < C(e.target).closest(".ui-resizable-handle").length || (this.handle = this._getHandle(e), !this.handle || (this._blurActiveElement(e), this._blockFrames(!0 === t.iframeFix ? "iframe" : t.iframeFix), 0)))
        },
        _blockFrames: function(e) {
            this.iframeBlocks = this.document.find(e).map(function() {
                var e = C(this);
                return C("<div>").css("position", "absolute").appendTo(e.parent()).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()).offset(e.offset())[0]
            })
        },
        _unblockFrames: function() {
            this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks)
        },
        _blurActiveElement: function(e) {
            var t = C.ui.safeActiveElement(this.document[0]);
            C(e.target).closest(t).length || C.ui.safeBlur(t)
        },
        _mouseStart: function(e) {
            var t = this.options;
            return this.helper = this._createHelper(e), this._addClass(this.helper, "ui-draggable-dragging"), this._cacheHelperProportions(), C.ui.ddmanager && (C.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(!0), this.offsetParent = this.helper.offsetParent(), this.hasFixedAncestor = 0 < this.helper.parents().filter(function() {
                return "fixed" === C(this).css("position")
            }).length, this.positionAbs = this.element.offset(), this._refreshOffsets(e), this.originalPosition = this.position = this._generatePosition(e, !1), this.originalPageX = e.pageX, this.originalPageY = e.pageY, t.cursorAt && this._adjustOffsetFromHelper(t.cursorAt), this._setContainment(), !1 === this._trigger("start", e) ? (this._clear(), !1) : (this._cacheHelperProportions(), C.ui.ddmanager && !t.dropBehaviour && C.ui.ddmanager.prepareOffsets(this, e), this._mouseDrag(e, !0), C.ui.ddmanager && C.ui.ddmanager.dragStart(this, e), !0)
        },
        _refreshOffsets: function(e) {
            this.offset = {
                top: this.positionAbs.top - this.margins.top,
                left: this.positionAbs.left - this.margins.left,
                scroll: !1,
                parent: this._getParentOffset(),
                relative: this._getRelativeOffset()
            }, this.offset.click = {
                left: e.pageX - this.offset.left,
                top: e.pageY - this.offset.top
            }
        },
        _mouseDrag: function(e, t) {
            if (this.hasFixedAncestor && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(e, !0), this.positionAbs = this._convertPositionTo("absolute"), !t) {
                var i = this._uiHash();
                if (!1 === this._trigger("drag", e, i)) return this._mouseUp(new C.Event("mouseup", e)), !1;
                this.position = i.position
            }
            return this.helper[0].style.left = this.position.left + "px", this.helper[0].style.top = this.position.top + "px", C.ui.ddmanager && C.ui.ddmanager.drag(this, e), !1
        },
        _mouseStop: function(e) {
            var t = this,
                i = !1;
            return C.ui.ddmanager && !this.options.dropBehaviour && (i = C.ui.ddmanager.drop(this, e)), this.dropped && (i = this.dropped, this.dropped = !1), "invalid" === this.options.revert && !i || "valid" === this.options.revert && i || !0 === this.options.revert || C.isFunction(this.options.revert) && this.options.revert.call(this.element, i) ? C(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() {
                !1 !== t._trigger("stop", e) && t._clear()
            }) : !1 !== this._trigger("stop", e) && this._clear(), !1
        },
        _mouseUp: function(e) {
            return this._unblockFrames(), C.ui.ddmanager && C.ui.ddmanager.dragStop(this, e), this.handleElement.is(e.target) && this.element.trigger("focus"), C.ui.mouse.prototype._mouseUp.call(this, e)
        },
        cancel: function() {
            return this.helper.is(".ui-draggable-dragging") ? this._mouseUp(new C.Event("mouseup", {
                target: this.element[0]
            })) : this._clear(), this
        },
        _getHandle: function(e) {
            return !this.options.handle || !!C(e.target).closest(this.element.find(this.options.handle)).length
        },
        _setHandleClassName: function() {
            this.handleElement = this.options.handle ? this.element.find(this.options.handle) : this.element, this._addClass(this.handleElement, "ui-draggable-handle")
        },
        _removeHandleClassName: function() {
            this._removeClass(this.handleElement, "ui-draggable-handle")
        },
        _createHelper: function(e) {
            var t = this.options,
                i = C.isFunction(t.helper),
                n = i ? C(t.helper.apply(this.element[0], [e])) : "clone" === t.helper ? this.element.clone().removeAttr("id") : this.element;
            return n.parents("body").length || n.appendTo("parent" === t.appendTo ? this.element[0].parentNode : t.appendTo), i && n[0] === this.element[0] && this._setPositionRelative(), n[0] === this.element[0] || /(fixed|absolute)/.test(n.css("position")) || n.css("position", "absolute"), n
        },
        _setPositionRelative: function() {
            /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative")
        },
        _adjustOffsetFromHelper: function(e) {
            "string" == typeof e && (e = e.split(" ")), C.isArray(e) && (e = {
                left: +e[0],
                top: +e[1] || 0
            }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
        },
        _isRootNode: function(e) {
            return /(html|body)/i.test(e.tagName) || e === this.document[0]
        },
        _getParentOffset: function() {
            var e = this.offsetParent.offset(),
                t = this.document[0];
            return "absolute" === this.cssPosition && this.scrollParent[0] !== t && C.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()), this._isRootNode(this.offsetParent[0]) && (e = {
                top: 0,
                left: 0
            }), {
                top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function() {
            if ("relative" !== this.cssPosition) return {
                top: 0,
                left: 0
            };
            var e = this.element.position(),
                t = this._isRootNode(this.scrollParent[0]);
            return {
                top: e.top - (parseInt(this.helper.css("top"), 10) || 0) + (t ? 0 : this.scrollParent.scrollTop()),
                left: e.left - (parseInt(this.helper.css("left"), 10) || 0) + (t ? 0 : this.scrollParent.scrollLeft())
            }
        },
        _cacheMargins: function() {
            this.margins = {
                left: parseInt(this.element.css("marginLeft"), 10) || 0,
                top: parseInt(this.element.css("marginTop"), 10) || 0,
                right: parseInt(this.element.css("marginRight"), 10) || 0,
                bottom: parseInt(this.element.css("marginBottom"), 10) || 0
            }
        },
        _cacheHelperProportions: function() {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            }
        },
        _setContainment: function() {
            var e, t, i, n = this.options,
                s = this.document[0];
            return this.relativeContainer = null, n.containment ? "window" === n.containment ? void(this.containment = [C(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, C(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, C(window).scrollLeft() + C(window).width() - this.helperProportions.width - this.margins.left, C(window).scrollTop() + (C(window).height() || s.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : "document" === n.containment ? void(this.containment = [0, 0, C(s).width() - this.helperProportions.width - this.margins.left, (C(s).height() || s.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : n.containment.constructor === Array ? void(this.containment = n.containment) : ("parent" === n.containment && (n.containment = this.helper[0].parentNode), void((i = (t = C(n.containment))[0]) && (e = /(scroll|auto)/.test(t.css("overflow")), this.containment = [(parseInt(t.css("borderLeftWidth"), 10) || 0) + (parseInt(t.css("paddingLeft"), 10) || 0), (parseInt(t.css("borderTopWidth"), 10) || 0) + (parseInt(t.css("paddingTop"), 10) || 0), (e ? Math.max(i.scrollWidth, i.offsetWidth) : i.offsetWidth) - (parseInt(t.css("borderRightWidth"), 10) || 0) - (parseInt(t.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (e ? Math.max(i.scrollHeight, i.offsetHeight) : i.offsetHeight) - (parseInt(t.css("borderBottomWidth"), 10) || 0) - (parseInt(t.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relativeContainer = t))) : void(this.containment = null)
        },
        _convertPositionTo: function(e, t) {
            t = t || this.position;
            var i = "absolute" === e ? 1 : -1,
                n = this._isRootNode(this.scrollParent[0]);
            return {
                top: t.top + this.offset.relative.top * i + this.offset.parent.top * i - ("fixed" === this.cssPosition ? -this.offset.scroll.top : n ? 0 : this.offset.scroll.top) * i,
                left: t.left + this.offset.relative.left * i + this.offset.parent.left * i - ("fixed" === this.cssPosition ? -this.offset.scroll.left : n ? 0 : this.offset.scroll.left) * i
            }
        },
        _generatePosition: function(e, t) {
            var i, n, s, o, a = this.options,
                r = this._isRootNode(this.scrollParent[0]),
                l = e.pageX,
                c = e.pageY;
            return r && this.offset.scroll || (this.offset.scroll = {
                top: this.scrollParent.scrollTop(),
                left: this.scrollParent.scrollLeft()
            }), t && (this.containment && (i = this.relativeContainer ? (n = this.relativeContainer.offset(), [this.containment[0] + n.left, this.containment[1] + n.top, this.containment[2] + n.left, this.containment[3] + n.top]) : this.containment, e.pageX - this.offset.click.left < i[0] && (l = i[0] + this.offset.click.left), e.pageY - this.offset.click.top < i[1] && (c = i[1] + this.offset.click.top), e.pageX - this.offset.click.left > i[2] && (l = i[2] + this.offset.click.left), e.pageY - this.offset.click.top > i[3] && (c = i[3] + this.offset.click.top)), a.grid && (s = a.grid[1] ? this.originalPageY + Math.round((c - this.originalPageY) / a.grid[1]) * a.grid[1] : this.originalPageY, c = i ? s - this.offset.click.top >= i[1] || s - this.offset.click.top > i[3] ? s : s - this.offset.click.top >= i[1] ? s - a.grid[1] : s + a.grid[1] : s, o = a.grid[0] ? this.originalPageX + Math.round((l - this.originalPageX) / a.grid[0]) * a.grid[0] : this.originalPageX, l = i ? o - this.offset.click.left >= i[0] || o - this.offset.click.left > i[2] ? o : o - this.offset.click.left >= i[0] ? o - a.grid[0] : o + a.grid[0] : o), "y" === a.axis && (l = this.originalPageX), "x" === a.axis && (c = this.originalPageY)), {
                top: c - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.offset.scroll.top : r ? 0 : this.offset.scroll.top),
                left: l - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.offset.scroll.left : r ? 0 : this.offset.scroll.left)
            }
        },
        _clear: function() {
            this._removeClass(this.helper, "ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1, this.destroyOnClear && this.destroy()
        },
        _trigger: function(e, t, i) {
            return i = i || this._uiHash(), C.ui.plugin.call(this, e, [t, i, this], !0), /^(drag|start|stop)/.test(e) && (this.positionAbs = this._convertPositionTo("absolute"), i.offset = this.positionAbs), C.Widget.prototype._trigger.call(this, e, t, i)
        },
        plugins: {},
        _uiHash: function() {
            return {
                helper: this.helper,
                position: this.position,
                originalPosition: this.originalPosition,
                offset: this.positionAbs
            }
        }
    }), C.ui.plugin.add("draggable", "connectToSortable", {
        start: function(t, e, i) {
            var n = C.extend({}, e, {
                item: i.element
            });
            i.sortables = [], C(i.options.connectToSortable).each(function() {
                var e = C(this).sortable("instance");
                e && !e.options.disabled && (i.sortables.push(e), e.refreshPositions(), e._trigger("activate", t, n))
            })
        },
        stop: function(t, e, i) {
            var n = C.extend({}, e, {
                item: i.element
            });
            i.cancelHelperRemoval = !1, C.each(i.sortables, function() {
                var e = this;
                e.isOver ? (e.isOver = 0, i.cancelHelperRemoval = !0, e.cancelHelperRemoval = !1, e._storedCSS = {
                    position: e.placeholder.css("position"),
                    top: e.placeholder.css("top"),
                    left: e.placeholder.css("left")
                }, e._mouseStop(t), e.options.helper = e.options._helper) : (e.cancelHelperRemoval = !0, e._trigger("deactivate", t, n))
            })
        },
        drag: function(i, n, s) {
            C.each(s.sortables, function() {
                var e = !1,
                    t = this;
                t.positionAbs = s.positionAbs, t.helperProportions = s.helperProportions, t.offset.click = s.offset.click, t._intersectsWith(t.containerCache) && (e = !0, C.each(s.sortables, function() {
                    return this.positionAbs = s.positionAbs, this.helperProportions = s.helperProportions, this.offset.click = s.offset.click, this !== t && this._intersectsWith(this.containerCache) && C.contains(t.element[0], this.element[0]) && (e = !1), e
                })), e ? (t.isOver || (t.isOver = 1, s._parent = n.helper.parent(), t.currentItem = n.helper.appendTo(t.element).data("ui-sortable-item", !0), t.options._helper = t.options.helper, t.options.helper = function() {
                    return n.helper[0]
                }, i.target = t.currentItem[0], t._mouseCapture(i, !0), t._mouseStart(i, !0, !0), t.offset.click.top = s.offset.click.top, t.offset.click.left = s.offset.click.left, t.offset.parent.left -= s.offset.parent.left - t.offset.parent.left, t.offset.parent.top -= s.offset.parent.top - t.offset.parent.top, s._trigger("toSortable", i), s.dropped = t.element, C.each(s.sortables, function() {
                    this.refreshPositions()
                }), s.currentItem = s.element, t.fromOutside = s), t.currentItem && (t._mouseDrag(i), n.position = t.position)) : t.isOver && (t.isOver = 0, t.cancelHelperRemoval = !0, t.options._revert = t.options.revert, t.options.revert = !1, t._trigger("out", i, t._uiHash(t)), t._mouseStop(i, !0), t.options.revert = t.options._revert, t.options.helper = t.options._helper, t.placeholder && t.placeholder.remove(), n.helper.appendTo(s._parent), s._refreshOffsets(i), n.position = s._generatePosition(i, !0), s._trigger("fromSortable", i), s.dropped = !1, C.each(s.sortables, function() {
                    this.refreshPositions()
                }))
            })
        }
    }), C.ui.plugin.add("draggable", "cursor", {
        start: function(e, t, i) {
            var n = C("body"),
                s = i.options;
            n.css("cursor") && (s._cursor = n.css("cursor")), n.css("cursor", s.cursor)
        },
        stop: function(e, t, i) {
            var n = i.options;
            n._cursor && C("body").css("cursor", n._cursor)
        }
    }), C.ui.plugin.add("draggable", "opacity", {
        start: function(e, t, i) {
            var n = C(t.helper),
                s = i.options;
            n.css("opacity") && (s._opacity = n.css("opacity")), n.css("opacity", s.opacity)
        },
        stop: function(e, t, i) {
            var n = i.options;
            n._opacity && C(t.helper).css("opacity", n._opacity)
        }
    }), C.ui.plugin.add("draggable", "scroll", {
        start: function(e, t, i) {
            i.scrollParentNotHidden || (i.scrollParentNotHidden = i.helper.scrollParent(!1)), i.scrollParentNotHidden[0] !== i.document[0] && "HTML" !== i.scrollParentNotHidden[0].tagName && (i.overflowOffset = i.scrollParentNotHidden.offset())
        },
        drag: function(e, t, i) {
            var n = i.options,
                s = !1,
                o = i.scrollParentNotHidden[0],
                a = i.document[0];
            o !== a && "HTML" !== o.tagName ? (n.axis && "x" === n.axis || (i.overflowOffset.top + o.offsetHeight - e.pageY < n.scrollSensitivity ? o.scrollTop = s = o.scrollTop + n.scrollSpeed : e.pageY - i.overflowOffset.top < n.scrollSensitivity && (o.scrollTop = s = o.scrollTop - n.scrollSpeed)), n.axis && "y" === n.axis || (i.overflowOffset.left + o.offsetWidth - e.pageX < n.scrollSensitivity ? o.scrollLeft = s = o.scrollLeft + n.scrollSpeed : e.pageX - i.overflowOffset.left < n.scrollSensitivity && (o.scrollLeft = s = o.scrollLeft - n.scrollSpeed))) : (n.axis && "x" === n.axis || (e.pageY - C(a).scrollTop() < n.scrollSensitivity ? s = C(a).scrollTop(C(a).scrollTop() - n.scrollSpeed) : C(window).height() - (e.pageY - C(a).scrollTop()) < n.scrollSensitivity && (s = C(a).scrollTop(C(a).scrollTop() + n.scrollSpeed))), n.axis && "y" === n.axis || (e.pageX - C(a).scrollLeft() < n.scrollSensitivity ? s = C(a).scrollLeft(C(a).scrollLeft() - n.scrollSpeed) : C(window).width() - (e.pageX - C(a).scrollLeft()) < n.scrollSensitivity && (s = C(a).scrollLeft(C(a).scrollLeft() + n.scrollSpeed)))), !1 !== s && C.ui.ddmanager && !n.dropBehaviour && C.ui.ddmanager.prepareOffsets(i, e)
        }
    }), C.ui.plugin.add("draggable", "snap", {
        start: function(e, t, i) {
            var n = i.options;
            i.snapElements = [], C(n.snap.constructor !== String ? n.snap.items || ":data(ui-draggable)" : n.snap).each(function() {
                var e = C(this),
                    t = e.offset();
                this !== i.element[0] && i.snapElements.push({
                    item: this,
                    width: e.outerWidth(),
                    height: e.outerHeight(),
                    top: t.top,
                    left: t.left
                })
            })
        },
        drag: function(e, t, i) {
            var n, s, o, a, r, l, c, h, u, d, p = i.options,
                f = p.snapTolerance,
                m = t.offset.left,
                g = m + i.helperProportions.width,
                v = t.offset.top,
                b = v + i.helperProportions.height;
            for (u = i.snapElements.length - 1; 0 <= u; u--) l = (r = i.snapElements[u].left - i.margins.left) + i.snapElements[u].width, h = (c = i.snapElements[u].top - i.margins.top) + i.snapElements[u].height, g < r - f || l + f < m || b < c - f || h + f < v || !C.contains(i.snapElements[u].item.ownerDocument, i.snapElements[u].item) ? (i.snapElements[u].snapping && i.options.snap.release && i.options.snap.release.call(i.element, e, C.extend(i._uiHash(), {
                snapItem: i.snapElements[u].item
            })), i.snapElements[u].snapping = !1) : ("inner" !== p.snapMode && (n = f >= Math.abs(c - b), s = f >= Math.abs(h - v), o = f >= Math.abs(r - g), a = f >= Math.abs(l - m), n && (t.position.top = i._convertPositionTo("relative", {
                top: c - i.helperProportions.height,
                left: 0
            }).top), s && (t.position.top = i._convertPositionTo("relative", {
                top: h,
                left: 0
            }).top), o && (t.position.left = i._convertPositionTo("relative", {
                top: 0,
                left: r - i.helperProportions.width
            }).left), a && (t.position.left = i._convertPositionTo("relative", {
                top: 0,
                left: l
            }).left)), d = n || s || o || a, "outer" !== p.snapMode && (n = f >= Math.abs(c - v), s = f >= Math.abs(h - b), o = f >= Math.abs(r - m), a = f >= Math.abs(l - g), n && (t.position.top = i._convertPositionTo("relative", {
                top: c,
                left: 0
            }).top), s && (t.position.top = i._convertPositionTo("relative", {
                top: h - i.helperProportions.height,
                left: 0
            }).top), o && (t.position.left = i._convertPositionTo("relative", {
                top: 0,
                left: r
            }).left), a && (t.position.left = i._convertPositionTo("relative", {
                top: 0,
                left: l - i.helperProportions.width
            }).left)), !i.snapElements[u].snapping && (n || s || o || a || d) && i.options.snap.snap && i.options.snap.snap.call(i.element, e, C.extend(i._uiHash(), {
                snapItem: i.snapElements[u].item
            })), i.snapElements[u].snapping = n || s || o || a || d)
        }
    }), C.ui.plugin.add("draggable", "stack", {
        start: function(e, t, i) {
            var n, s = i.options,
                o = C.makeArray(C(s.stack)).sort(function(e, t) {
                    return (parseInt(C(e).css("zIndex"), 10) || 0) - (parseInt(C(t).css("zIndex"), 10) || 0)
                });
            o.length && (n = parseInt(C(o[0]).css("zIndex"), 10) || 0, C(o).each(function(e) {
                C(this).css("zIndex", n + e)
            }), this.css("zIndex", n + o.length))
        }
    }), C.ui.plugin.add("draggable", "zIndex", {
        start: function(e, t, i) {
            var n = C(t.helper),
                s = i.options;
            n.css("zIndex") && (s._zIndex = n.css("zIndex")), n.css("zIndex", s.zIndex)
        },
        stop: function(e, t, i) {
            var n = i.options;
            n._zIndex && C(t.helper).css("zIndex", n._zIndex)
        }
    }), C.ui.draggable, C.widget("ui.resizable", C.ui.mouse, {
        version: "1.12.1",
        widgetEventPrefix: "resize",
        options: {
            alsoResize: !1,
            animate: !1,
            animateDuration: "slow",
            animateEasing: "swing",
            aspectRatio: !1,
            autoHide: !1,
            classes: {
                "ui-resizable-se": "ui-icon ui-icon-gripsmall-diagonal-se"
            },
            containment: !1,
            ghost: !1,
            grid: !1,
            handles: "e,s,se",
            helper: !1,
            maxHeight: null,
            maxWidth: null,
            minHeight: 10,
            minWidth: 10,
            zIndex: 90,
            resize: null,
            start: null,
            stop: null
        },
        _num: function(e) {
            return parseFloat(e) || 0
        },
        _isNumber: function(e) {
            return !isNaN(parseFloat(e))
        },
        _hasScroll: function(e, t) {
            if ("hidden" === C(e).css("overflow")) return !1;
            var i = t && "left" === t ? "scrollLeft" : "scrollTop",
                n = !1;
            return 0 < e[i] || (e[i] = 1, n = 0 < e[i], e[i] = 0, n)
        },
        _create: function() {
            var e, t = this.options,
                i = this;
            this._addClass("ui-resizable"), C.extend(this, {
                _aspectRatio: !!t.aspectRatio,
                aspectRatio: t.aspectRatio,
                originalElement: this.element,
                _proportionallyResizeElements: [],
                _helper: t.helper || t.ghost || t.animate ? t.helper || "ui-resizable-helper" : null
            }), this.element[0].nodeName.match(/^(canvas|textarea|input|select|button|img)$/i) && (this.element.wrap(C("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
                position: this.element.css("position"),
                width: this.element.outerWidth(),
                height: this.element.outerHeight(),
                top: this.element.css("top"),
                left: this.element.css("left")
            })), this.element = this.element.parent().data("ui-resizable", this.element.resizable("instance")), this.elementIsWrapper = !0, e = {
                marginTop: this.originalElement.css("marginTop"),
                marginRight: this.originalElement.css("marginRight"),
                marginBottom: this.originalElement.css("marginBottom"),
                marginLeft: this.originalElement.css("marginLeft")
            }, this.element.css(e), this.originalElement.css("margin", 0), this.originalResizeStyle = this.originalElement.css("resize"), this.originalElement.css("resize", "none"), this._proportionallyResizeElements.push(this.originalElement.css({
                position: "static",
                zoom: 1,
                display: "block"
            })), this.originalElement.css(e), this._proportionallyResize()), this._setupHandles(), t.autoHide && C(this.element).on("mouseenter", function() {
                t.disabled || (i._removeClass("ui-resizable-autohide"), i._handles.show())
            }).on("mouseleave", function() {
                t.disabled || i.resizing || (i._addClass("ui-resizable-autohide"), i._handles.hide())
            }), this._mouseInit()
        },
        _destroy: function() {
            function e(e) {
                C(e).removeData("resizable").removeData("ui-resizable").off(".resizable").find(".ui-resizable-handle").remove()
            }
            var t;
            return this._mouseDestroy(), this.elementIsWrapper && (e(this.element), t = this.element, this.originalElement.css({
                position: t.css("position"),
                width: t.outerWidth(),
                height: t.outerHeight(),
                top: t.css("top"),
                left: t.css("left")
            }).insertAfter(t), t.remove()), this.originalElement.css("resize", this.originalResizeStyle), e(this.originalElement), this
        },
        _setOption: function(e, t) {
            switch (this._super(e, t), e) {
                case "handles":
                    this._removeHandles(), this._setupHandles()
            }
        },
        _setupHandles: function() {
            var e, t, i, n, s, o = this.options,
                a = this;
            if (this.handles = o.handles || (C(".ui-resizable-handle", this.element).length ? {
                    n: ".ui-resizable-n",
                    e: ".ui-resizable-e",
                    s: ".ui-resizable-s",
                    w: ".ui-resizable-w",
                    se: ".ui-resizable-se",
                    sw: ".ui-resizable-sw",
                    ne: ".ui-resizable-ne",
                    nw: ".ui-resizable-nw"
                } : "e,s,se"), this._handles = C(), this.handles.constructor === String)
                for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), i = this.handles.split(","), this.handles = {}, t = 0; i.length > t; t++) n = "ui-resizable-" + (e = C.trim(i[t])), s = C("<div>"), this._addClass(s, "ui-resizable-handle " + n), s.css({
                    zIndex: o.zIndex
                }), this.handles[e] = ".ui-resizable-" + e, this.element.append(s);
            this._renderAxis = function(e) {
                var t, i, n, s;
                for (t in e = e || this.element, this.handles) this.handles[t].constructor === String ? this.handles[t] = this.element.children(this.handles[t]).first().show() : (this.handles[t].jquery || this.handles[t].nodeType) && (this.handles[t] = C(this.handles[t]), this._on(this.handles[t], {
                    mousedown: a._mouseDown
                })), this.elementIsWrapper && this.originalElement[0].nodeName.match(/^(textarea|input|select|button)$/i) && (i = C(this.handles[t], this.element), s = /sw|ne|nw|se|n|s/.test(t) ? i.outerHeight() : i.outerWidth(), n = ["padding", /ne|nw|n/.test(t) ? "Top" : /se|sw|s/.test(t) ? "Bottom" : /^e$/.test(t) ? "Right" : "Left"].join(""), e.css(n, s), this._proportionallyResize()), this._handles = this._handles.add(this.handles[t])
            }, this._renderAxis(this.element), this._handles = this._handles.add(this.element.find(".ui-resizable-handle")), this._handles.disableSelection(), this._handles.on("mouseover", function() {
                a.resizing || (this.className && (s = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), a.axis = s && s[1] ? s[1] : "se")
            }), o.autoHide && (this._handles.hide(), this._addClass("ui-resizable-autohide"))
        },
        _removeHandles: function() {
            this._handles.remove()
        },
        _mouseCapture: function(e) {
            var t, i, n = !1;
            for (t in this.handles)(i = C(this.handles[t])[0]) !== e.target && !C.contains(i, e.target) || (n = !0);
            return !this.options.disabled && n
        },
        _mouseStart: function(e) {
            var t, i, n, s = this.options,
                o = this.element;
            return this.resizing = !0, this._renderProxy(), t = this._num(this.helper.css("left")), i = this._num(this.helper.css("top")), s.containment && (t += C(s.containment).scrollLeft() || 0, i += C(s.containment).scrollTop() || 0), this.offset = this.helper.offset(), this.position = {
                left: t,
                top: i
            }, this.size = this._helper ? {
                width: this.helper.width(),
                height: this.helper.height()
            } : {
                width: o.width(),
                height: o.height()
            }, this.originalSize = this._helper ? {
                width: o.outerWidth(),
                height: o.outerHeight()
            } : {
                width: o.width(),
                height: o.height()
            }, this.sizeDiff = {
                width: o.outerWidth() - o.width(),
                height: o.outerHeight() - o.height()
            }, this.originalPosition = {
                left: t,
                top: i
            }, this.originalMousePosition = {
                left: e.pageX,
                top: e.pageY
            }, this.aspectRatio = "number" == typeof s.aspectRatio ? s.aspectRatio : this.originalSize.width / this.originalSize.height || 1, n = C(".ui-resizable-" + this.axis).css("cursor"), C("body").css("cursor", "auto" === n ? this.axis + "-resize" : n), this._addClass("ui-resizable-resizing"), this._propagate("start", e), !0
        },
        _mouseDrag: function(e) {
            var t, i, n = this.originalMousePosition,
                s = this.axis,
                o = e.pageX - n.left || 0,
                a = e.pageY - n.top || 0,
                r = this._change[s];
            return this._updatePrevProperties(), r && (t = r.apply(this, [e, o, a]), this._updateVirtualBoundaries(e.shiftKey), (this._aspectRatio || e.shiftKey) && (t = this._updateRatio(t, e)), t = this._respectSize(t, e), this._updateCache(t), this._propagate("resize", e), i = this._applyChanges(), !this._helper && this._proportionallyResizeElements.length && this._proportionallyResize(), C.isEmptyObject(i) || (this._updatePrevProperties(), this._trigger("resize", e, this.ui()), this._applyChanges())), !1
        },
        _mouseStop: function(e) {
            this.resizing = !1;
            var t, i, n, s, o, a, r, l = this.options,
                c = this;
            return this._helper && (n = (i = (t = this._proportionallyResizeElements).length && /textarea/i.test(t[0].nodeName)) && this._hasScroll(t[0], "left") ? 0 : c.sizeDiff.height, s = i ? 0 : c.sizeDiff.width, o = {
                width: c.helper.width() - s,
                height: c.helper.height() - n
            }, a = parseFloat(c.element.css("left")) + (c.position.left - c.originalPosition.left) || null, r = parseFloat(c.element.css("top")) + (c.position.top - c.originalPosition.top) || null, l.animate || this.element.css(C.extend(o, {
                top: r,
                left: a
            })), c.helper.height(c.size.height), c.helper.width(c.size.width), this._helper && !l.animate && this._proportionallyResize()), C("body").css("cursor", "auto"), this._removeClass("ui-resizable-resizing"), this._propagate("stop", e), this._helper && this.helper.remove(), !1
        },
        _updatePrevProperties: function() {
            this.prevPosition = {
                top: this.position.top,
                left: this.position.left
            }, this.prevSize = {
                width: this.size.width,
                height: this.size.height
            }
        },
        _applyChanges: function() {
            var e = {};
            return this.position.top !== this.prevPosition.top && (e.top = this.position.top + "px"), this.position.left !== this.prevPosition.left && (e.left = this.position.left + "px"), this.size.width !== this.prevSize.width && (e.width = this.size.width + "px"), this.size.height !== this.prevSize.height && (e.height = this.size.height + "px"), this.helper.css(e), e
        },
        _updateVirtualBoundaries: function(e) {
            var t, i, n, s, o, a = this.options;
            o = {
                minWidth: this._isNumber(a.minWidth) ? a.minWidth : 0,
                maxWidth: this._isNumber(a.maxWidth) ? a.maxWidth : 1 / 0,
                minHeight: this._isNumber(a.minHeight) ? a.minHeight : 0,
                maxHeight: this._isNumber(a.maxHeight) ? a.maxHeight : 1 / 0
            }, (this._aspectRatio || e) && (t = o.minHeight * this.aspectRatio, n = o.minWidth / this.aspectRatio, i = o.maxHeight * this.aspectRatio, s = o.maxWidth / this.aspectRatio, t > o.minWidth && (o.minWidth = t), n > o.minHeight && (o.minHeight = n), o.maxWidth > i && (o.maxWidth = i), o.maxHeight > s && (o.maxHeight = s)), this._vBoundaries = o
        },
        _updateCache: function(e) {
            this.offset = this.helper.offset(), this._isNumber(e.left) && (this.position.left = e.left), this._isNumber(e.top) && (this.position.top = e.top), this._isNumber(e.height) && (this.size.height = e.height), this._isNumber(e.width) && (this.size.width = e.width)
        },
        _updateRatio: function(e) {
            var t = this.position,
                i = this.size,
                n = this.axis;
            return this._isNumber(e.height) ? e.width = e.height * this.aspectRatio : this._isNumber(e.width) && (e.height = e.width / this.aspectRatio), "sw" === n && (e.left = t.left + (i.width - e.width), e.top = null), "nw" === n && (e.top = t.top + (i.height - e.height), e.left = t.left + (i.width - e.width)), e
        },
        _respectSize: function(e) {
            var t = this._vBoundaries,
                i = this.axis,
                n = this._isNumber(e.width) && t.maxWidth && t.maxWidth < e.width,
                s = this._isNumber(e.height) && t.maxHeight && t.maxHeight < e.height,
                o = this._isNumber(e.width) && t.minWidth && t.minWidth > e.width,
                a = this._isNumber(e.height) && t.minHeight && t.minHeight > e.height,
                r = this.originalPosition.left + this.originalSize.width,
                l = this.originalPosition.top + this.originalSize.height,
                c = /sw|nw|w/.test(i),
                h = /nw|ne|n/.test(i);
            return o && (e.width = t.minWidth), a && (e.height = t.minHeight), n && (e.width = t.maxWidth), s && (e.height = t.maxHeight), o && c && (e.left = r - t.minWidth), n && c && (e.left = r - t.maxWidth), a && h && (e.top = l - t.minHeight), s && h && (e.top = l - t.maxHeight), e.width || e.height || e.left || !e.top ? e.width || e.height || e.top || !e.left || (e.left = null) : e.top = null, e
        },
        _getPaddingPlusBorderDimensions: function(e) {
            for (var t = 0, i = [], n = [e.css("borderTopWidth"), e.css("borderRightWidth"), e.css("borderBottomWidth"), e.css("borderLeftWidth")], s = [e.css("paddingTop"), e.css("paddingRight"), e.css("paddingBottom"), e.css("paddingLeft")]; t < 4; t++) i[t] = parseFloat(n[t]) || 0, i[t] += parseFloat(s[t]) || 0;
            return {
                height: i[0] + i[2],
                width: i[1] + i[3]
            }
        },
        _proportionallyResize: function() {
            if (this._proportionallyResizeElements.length)
                for (var e, t = 0, i = this.helper || this.element; this._proportionallyResizeElements.length > t; t++) e = this._proportionallyResizeElements[t], this.outerDimensions || (this.outerDimensions = this._getPaddingPlusBorderDimensions(e)), e.css({
                    height: i.height() - this.outerDimensions.height || 0,
                    width: i.width() - this.outerDimensions.width || 0
                })
        },
        _renderProxy: function() {
            var e = this.element,
                t = this.options;
            this.elementOffset = e.offset(), this._helper ? (this.helper = this.helper || C("<div style='overflow:hidden;'></div>"), this._addClass(this.helper, this._helper), this.helper.css({
                width: this.element.outerWidth(),
                height: this.element.outerHeight(),
                position: "absolute",
                left: this.elementOffset.left + "px",
                top: this.elementOffset.top + "px",
                zIndex: ++t.zIndex
            }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element
        },
        _change: {
            e: function(e, t) {
                return {
                    width: this.originalSize.width + t
                }
            },
            w: function(e, t) {
                var i = this.originalSize;
                return {
                    left: this.originalPosition.left + t,
                    width: i.width - t
                }
            },
            n: function(e, t, i) {
                var n = this.originalSize;
                return {
                    top: this.originalPosition.top + i,
                    height: n.height - i
                }
            },
            s: function(e, t, i) {
                return {
                    height: this.originalSize.height + i
                }
            },
            se: function(e, t, i) {
                return C.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [e, t, i]))
            },
            sw: function(e, t, i) {
                return C.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [e, t, i]))
            },
            ne: function(e, t, i) {
                return C.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [e, t, i]))
            },
            nw: function(e, t, i) {
                return C.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [e, t, i]))
            }
        },
        _propagate: function(e, t) {
            C.ui.plugin.call(this, e, [t, this.ui()]), "resize" !== e && this._trigger(e, t, this.ui())
        },
        plugins: {},
        ui: function() {
            return {
                originalElement: this.originalElement,
                element: this.element,
                helper: this.helper,
                position: this.position,
                size: this.size,
                originalSize: this.originalSize,
                originalPosition: this.originalPosition
            }
        }
    }), C.ui.plugin.add("resizable", "animate", {
        stop: function(t) {
            var i = C(this).resizable("instance"),
                e = i.options,
                n = i._proportionallyResizeElements,
                s = n.length && /textarea/i.test(n[0].nodeName),
                o = s && i._hasScroll(n[0], "left") ? 0 : i.sizeDiff.height,
                a = s ? 0 : i.sizeDiff.width,
                r = {
                    width: i.size.width - a,
                    height: i.size.height - o
                },
                l = parseFloat(i.element.css("left")) + (i.position.left - i.originalPosition.left) || null,
                c = parseFloat(i.element.css("top")) + (i.position.top - i.originalPosition.top) || null;
            i.element.animate(C.extend(r, c && l ? {
                top: c,
                left: l
            } : {}), {
                duration: e.animateDuration,
                easing: e.animateEasing,
                step: function() {
                    var e = {
                        width: parseFloat(i.element.css("width")),
                        height: parseFloat(i.element.css("height")),
                        top: parseFloat(i.element.css("top")),
                        left: parseFloat(i.element.css("left"))
                    };
                    n && n.length && C(n[0]).css({
                        width: e.width,
                        height: e.height
                    }), i._updateCache(e), i._propagate("resize", t)
                }
            })
        }
    }), C.ui.plugin.add("resizable", "containment", {
        start: function() {
            var i, n, e, t, s, o, a, r = C(this).resizable("instance"),
                l = r.options,
                c = r.element,
                h = l.containment,
                u = h instanceof C ? h.get(0) : /parent/.test(h) ? c.parent().get(0) : h;
            u && (r.containerElement = C(u), /document/.test(h) || h === document ? (r.containerOffset = {
                left: 0,
                top: 0
            }, r.containerPosition = {
                left: 0,
                top: 0
            }, r.parentData = {
                element: C(document),
                left: 0,
                top: 0,
                width: C(document).width(),
                height: C(document).height() || document.body.parentNode.scrollHeight
            }) : (i = C(u), n = [], C(["Top", "Right", "Left", "Bottom"]).each(function(e, t) {
                n[e] = r._num(i.css("padding" + t))
            }), r.containerOffset = i.offset(), r.containerPosition = i.position(), r.containerSize = {
                height: i.innerHeight() - n[3],
                width: i.innerWidth() - n[1]
            }, e = r.containerOffset, t = r.containerSize.height, s = r.containerSize.width, o = r._hasScroll(u, "left") ? u.scrollWidth : s, a = r._hasScroll(u) ? u.scrollHeight : t, r.parentData = {
                element: u,
                left: e.left,
                top: e.top,
                width: o,
                height: a
            }))
        },
        resize: function(e) {
            var t, i, n, s, o = C(this).resizable("instance"),
                a = o.options,
                r = o.containerOffset,
                l = o.position,
                c = o._aspectRatio || e.shiftKey,
                h = {
                    top: 0,
                    left: 0
                },
                u = o.containerElement,
                d = !0;
            u[0] !== document && /static/.test(u.css("position")) && (h = r), l.left < (o._helper ? r.left : 0) && (o.size.width = o.size.width + (o._helper ? o.position.left - r.left : o.position.left - h.left), c && (o.size.height = o.size.width / o.aspectRatio, d = !1), o.position.left = a.helper ? r.left : 0), l.top < (o._helper ? r.top : 0) && (o.size.height = o.size.height + (o._helper ? o.position.top - r.top : o.position.top), c && (o.size.width = o.size.height * o.aspectRatio, d = !1), o.position.top = o._helper ? r.top : 0), n = o.containerElement.get(0) === o.element.parent().get(0), s = /relative|absolute/.test(o.containerElement.css("position")), n && s ? (o.offset.left = o.parentData.left + o.position.left, o.offset.top = o.parentData.top + o.position.top) : (o.offset.left = o.element.offset().left, o.offset.top = o.element.offset().top), t = Math.abs(o.sizeDiff.width + (o._helper ? o.offset.left - h.left : o.offset.left - r.left)), i = Math.abs(o.sizeDiff.height + (o._helper ? o.offset.top - h.top : o.offset.top - r.top)), t + o.size.width >= o.parentData.width && (o.size.width = o.parentData.width - t, c && (o.size.height = o.size.width / o.aspectRatio, d = !1)), i + o.size.height >= o.parentData.height && (o.size.height = o.parentData.height - i, c && (o.size.width = o.size.height * o.aspectRatio, d = !1)), d || (o.position.left = o.prevPosition.left, o.position.top = o.prevPosition.top, o.size.width = o.prevSize.width, o.size.height = o.prevSize.height)
        },
        stop: function() {
            var e = C(this).resizable("instance"),
                t = e.options,
                i = e.containerOffset,
                n = e.containerPosition,
                s = e.containerElement,
                o = C(e.helper),
                a = o.offset(),
                r = o.outerWidth() - e.sizeDiff.width,
                l = o.outerHeight() - e.sizeDiff.height;
            e._helper && !t.animate && /relative/.test(s.css("position")) && C(this).css({
                left: a.left - n.left - i.left,
                width: r,
                height: l
            }), e._helper && !t.animate && /static/.test(s.css("position")) && C(this).css({
                left: a.left - n.left - i.left,
                width: r,
                height: l
            })
        }
    }), C.ui.plugin.add("resizable", "alsoResize", {
        start: function() {
            var e = C(this).resizable("instance").options;
            C(e.alsoResize).each(function() {
                var e = C(this);
                e.data("ui-resizable-alsoresize", {
                    width: parseFloat(e.width()),
                    height: parseFloat(e.height()),
                    left: parseFloat(e.css("left")),
                    top: parseFloat(e.css("top"))
                })
            })
        },
        resize: function(e, i) {
            var t = C(this).resizable("instance"),
                n = t.options,
                s = t.originalSize,
                o = t.originalPosition,
                a = {
                    height: t.size.height - s.height || 0,
                    width: t.size.width - s.width || 0,
                    top: t.position.top - o.top || 0,
                    left: t.position.left - o.left || 0
                };
            C(n.alsoResize).each(function() {
                var e = C(this),
                    n = C(this).data("ui-resizable-alsoresize"),
                    s = {},
                    t = e.parents(i.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
                C.each(t, function(e, t) {
                    var i = (n[t] || 0) + (a[t] || 0);
                    i && 0 <= i && (s[t] = i || null)
                }), e.css(s)
            })
        },
        stop: function() {
            C(this).removeData("ui-resizable-alsoresize")
        }
    }), C.ui.plugin.add("resizable", "ghost", {
        start: function() {
            var e = C(this).resizable("instance"),
                t = e.size;
            e.ghost = e.originalElement.clone(), e.ghost.css({
                opacity: .25,
                display: "block",
                position: "relative",
                height: t.height,
                width: t.width,
                margin: 0,
                left: 0,
                top: 0
            }), e._addClass(e.ghost, "ui-resizable-ghost"), !1 !== C.uiBackCompat && "string" == typeof e.options.ghost && e.ghost.addClass(this.options.ghost), e.ghost.appendTo(e.helper)
        },
        resize: function() {
            var e = C(this).resizable("instance");
            e.ghost && e.ghost.css({
                position: "relative",
                height: e.size.height,
                width: e.size.width
            })
        },
        stop: function() {
            var e = C(this).resizable("instance");
            e.ghost && e.helper && e.helper.get(0).removeChild(e.ghost.get(0))
        }
    }), C.ui.plugin.add("resizable", "grid", {
        resize: function() {
            var e, t = C(this).resizable("instance"),
                i = t.options,
                n = t.size,
                s = t.originalSize,
                o = t.originalPosition,
                a = t.axis,
                r = "number" == typeof i.grid ? [i.grid, i.grid] : i.grid,
                l = r[0] || 1,
                c = r[1] || 1,
                h = Math.round((n.width - s.width) / l) * l,
                u = Math.round((n.height - s.height) / c) * c,
                d = s.width + h,
                p = s.height + u,
                f = i.maxWidth && d > i.maxWidth,
                m = i.maxHeight && p > i.maxHeight,
                g = i.minWidth && i.minWidth > d,
                v = i.minHeight && i.minHeight > p;
            i.grid = r, g && (d += l), v && (p += c), f && (d -= l), m && (p -= c), /^(se|s|e)$/.test(a) ? (t.size.width = d, t.size.height = p) : /^(ne)$/.test(a) ? (t.size.width = d, t.size.height = p, t.position.top = o.top - u) : /^(sw)$/.test(a) ? (t.size.width = d, t.size.height = p, t.position.left = o.left - h) : ((p - c <= 0 || d - l <= 0) && (e = t._getPaddingPlusBorderDimensions(this)), 0 < p - c ? (t.size.height = p, t.position.top = o.top - u) : (p = c - e.height, t.size.height = p, t.position.top = o.top + s.height - p), 0 < d - l ? (t.size.width = d, t.position.left = o.left - h) : (d = l - e.width, t.size.width = d, t.position.left = o.left + s.width - d))
        }
    }), C.ui.resizable, C.widget("ui.dialog", {
        version: "1.12.1",
        options: {
            appendTo: "body",
            autoOpen: !0,
            buttons: [],
            classes: {
                "ui-dialog": "ui-corner-all",
                "ui-dialog-titlebar": "ui-corner-all"
            },
            closeOnEscape: !0,
            closeText: "Close",
            draggable: !0,
            hide: null,
            height: "auto",
            maxHeight: null,
            maxWidth: null,
            minHeight: 150,
            minWidth: 150,
            modal: !1,
            position: {
                my: "center",
                at: "center",
                of: window,
                collision: "fit",
                using: function(e) {
                    var t = C(this).css(e).offset().top;
                    t < 0 && C(this).css("top", e.top - t)
                }
            },
            resizable: !0,
            show: null,
            title: null,
            width: 300,
            beforeClose: null,
            close: null,
            drag: null,
            dragStart: null,
            dragStop: null,
            focus: null,
            open: null,
            resize: null,
            resizeStart: null,
            resizeStop: null
        },
        sizeRelatedOptions: {
            buttons: !0,
            height: !0,
            maxHeight: !0,
            maxWidth: !0,
            minHeight: !0,
            minWidth: !0,
            width: !0
        },
        resizableRelatedOptions: {
            maxHeight: !0,
            maxWidth: !0,
            minHeight: !0,
            minWidth: !0
        },
        _create: function() {
            this.originalCss = {
                display: this.element[0].style.display,
                width: this.element[0].style.width,
                minHeight: this.element[0].style.minHeight,
                maxHeight: this.element[0].style.maxHeight,
                height: this.element[0].style.height
            }, this.originalPosition = {
                parent: this.element.parent(),
                index: this.element.parent().children().index(this.element)
            }, this.originalTitle = this.element.attr("title"), null == this.options.title && null != this.originalTitle && (this.options.title = this.originalTitle), this.options.disabled && (this.options.disabled = !1), this._createWrapper(), this.element.show().removeAttr("title").appendTo(this.uiDialog), this._addClass("ui-dialog-content", "ui-widget-content"), this._createTitlebar(), this._createButtonPane(), this.options.draggable && C.fn.draggable && this._makeDraggable(), this.options.resizable && C.fn.resizable && this._makeResizable(), this._isOpen = !1, this._trackFocus()
        },
        _init: function() {
            this.options.autoOpen && this.open()
        },
        _appendTo: function() {
            var e = this.options.appendTo;
            return e && (e.jquery || e.nodeType) ? C(e) : this.document.find(e || "body").eq(0)
        },
        _destroy: function() {
            var e, t = this.originalPosition;
            this._untrackInstance(), this._destroyOverlay(), this.element.removeUniqueId().css(this.originalCss).detach(), this.uiDialog.remove(), this.originalTitle && this.element.attr("title", this.originalTitle), (e = t.parent.children().eq(t.index)).length && e[0] !== this.element[0] ? e.before(this.element) : t.parent.append(this.element)
        },
        widget: function() {
            return this.uiDialog
        },
        disable: C.noop,
        enable: C.noop,
        close: function(e) {
            var t = this;
            this._isOpen && !1 !== this._trigger("beforeClose", e) && (this._isOpen = !1, this._focusedElement = null, this._destroyOverlay(), this._untrackInstance(), this.opener.filter(":focusable").trigger("focus").length || C.ui.safeBlur(C.ui.safeActiveElement(this.document[0])), this._hide(this.uiDialog, this.options.hide, function() {
                t._trigger("close", e)
            }))
        },
        isOpen: function() {
            return this._isOpen
        },
        moveToTop: function() {
            this._moveToTop()
        },
        _moveToTop: function(e, t) {
            var i = !1,
                n = this.uiDialog.siblings(".ui-front:visible").map(function() {
                    return +C(this).css("z-index")
                }).get(),
                s = Math.max.apply(null, n);
            return s >= +this.uiDialog.css("z-index") && (this.uiDialog.css("z-index", s + 1), i = !0), i && !t && this._trigger("focus", e), i
        },
        open: function() {
            var e = this;
            return this._isOpen ? void(this._moveToTop() && this._focusTabbable()) : (this._isOpen = !0, this.opener = C(C.ui.safeActiveElement(this.document[0])), this._size(), this._position(), this._createOverlay(), this._moveToTop(null, !0), this.overlay && this.overlay.css("z-index", this.uiDialog.css("z-index") - 1), this._show(this.uiDialog, this.options.show, function() {
                e._focusTabbable(), e._trigger("focus")
            }), this._makeFocusTarget(), void this._trigger("open"))
        },
        _focusTabbable: function() {
            var e = this._focusedElement;
            (e = e || this.element.find("[autofocus]")).length || (e = this.element.find(":tabbable")), e.length || (e = this.uiDialogButtonPane.find(":tabbable")), e.length || (e = this.uiDialogTitlebarClose.filter(":tabbable")), e.length || (e = this.uiDialog), e.eq(0).trigger("focus")
        },
        _keepFocus: function(e) {
            function t() {
                var e = C.ui.safeActiveElement(this.document[0]);
                this.uiDialog[0] === e || C.contains(this.uiDialog[0], e) || this._focusTabbable()
            }
            e.preventDefault(), t.call(this), this._delay(t)
        },
        _createWrapper: function() {
            this.uiDialog = C("<div>").hide().attr({
                tabIndex: -1,
                role: "dialog"
            }).appendTo(this._appendTo()), this._addClass(this.uiDialog, "ui-dialog", "ui-widget ui-widget-content ui-front"), this._on(this.uiDialog, {
                keydown: function(e) {
                    if (this.options.closeOnEscape && !e.isDefaultPrevented() && e.keyCode && e.keyCode === C.ui.keyCode.ESCAPE) return e.preventDefault(), void this.close(e);
                    if (e.keyCode === C.ui.keyCode.TAB && !e.isDefaultPrevented()) {
                        var t = this.uiDialog.find(":tabbable"),
                            i = t.filter(":first"),
                            n = t.filter(":last");
                        e.target !== n[0] && e.target !== this.uiDialog[0] || e.shiftKey ? e.target !== i[0] && e.target !== this.uiDialog[0] || !e.shiftKey || (this._delay(function() {
                            n.trigger("focus")
                        }), e.preventDefault()) : (this._delay(function() {
                            i.trigger("focus")
                        }), e.preventDefault())
                    }
                },
                mousedown: function(e) {
                    this._moveToTop(e) && this._focusTabbable()
                }
            }), this.element.find("[aria-describedby]").length || this.uiDialog.attr({
                "aria-describedby": this.element.uniqueId().attr("id")
            })
        },
        _createTitlebar: function() {
            var e;
            this.uiDialogTitlebar = C("<div>"), this._addClass(this.uiDialogTitlebar, "ui-dialog-titlebar", "ui-widget-header ui-helper-clearfix"), this._on(this.uiDialogTitlebar, {
                mousedown: function(e) {
                    C(e.target).closest(".ui-dialog-titlebar-close") || this.uiDialog.trigger("focus")
                }
            }), this.uiDialogTitlebarClose = C("<button type='button'></button>").button({
                label: C("<a>").text(this.options.closeText).html(),
                icon: "ui-icon-closethick",
                showLabel: !1
            }).appendTo(this.uiDialogTitlebar), this._addClass(this.uiDialogTitlebarClose, "ui-dialog-titlebar-close"), this._on(this.uiDialogTitlebarClose, {
                click: function(e) {
                    e.preventDefault(), this.close(e)
                }
            }), e = C("<span>").uniqueId().prependTo(this.uiDialogTitlebar), this._addClass(e, "ui-dialog-title"), this._title(e), this.uiDialogTitlebar.prependTo(this.uiDialog), this.uiDialog.attr({
                "aria-labelledby": e.attr("id")
            })
        },
        _title: function(e) {
            this.options.title ? e.text(this.options.title) : e.html("&#160;")
        },
        _createButtonPane: function() {
            this.uiDialogButtonPane = C("<div>"), this._addClass(this.uiDialogButtonPane, "ui-dialog-buttonpane", "ui-widget-content ui-helper-clearfix"), this.uiButtonSet = C("<div>").appendTo(this.uiDialogButtonPane), this._addClass(this.uiButtonSet, "ui-dialog-buttonset"), this._createButtons()
        },
        _createButtons: function() {
            var s = this,
                e = this.options.buttons;
            return this.uiDialogButtonPane.remove(), this.uiButtonSet.empty(), C.isEmptyObject(e) || C.isArray(e) && !e.length ? void this._removeClass(this.uiDialog, "ui-dialog-buttons") : (C.each(e, function(e, t) {
                var i, n;
                t = C.isFunction(t) ? {
                    click: t,
                    text: e
                } : t, t = C.extend({
                    type: "button"
                }, t), i = t.click, n = {
                    icon: t.icon,
                    iconPosition: t.iconPosition,
                    showLabel: t.showLabel,
                    icons: t.icons,
                    text: t.text
                }, delete t.click, delete t.icon, delete t.iconPosition, delete t.showLabel, delete t.icons, "boolean" == typeof t.text && delete t.text, C("<button></button>", t).button(n).appendTo(s.uiButtonSet).on("click", function() {
                    i.apply(s.element[0], arguments)
                })
            }), this._addClass(this.uiDialog, "ui-dialog-buttons"), void this.uiDialogButtonPane.appendTo(this.uiDialog))
        },
        _makeDraggable: function() {
            function s(e) {
                return {
                    position: e.position,
                    offset: e.offset
                }
            }
            var o = this,
                a = this.options;
            this.uiDialog.draggable({
                cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
                handle: ".ui-dialog-titlebar",
                containment: "document",
                start: function(e, t) {
                    o._addClass(C(this), "ui-dialog-dragging"), o._blockFrames(), o._trigger("dragStart", e, s(t))
                },
                drag: function(e, t) {
                    o._trigger("drag", e, s(t))
                },
                stop: function(e, t) {
                    var i = t.offset.left - o.document.scrollLeft(),
                        n = t.offset.top - o.document.scrollTop();
                    a.position = {
                        my: "left top",
                        at: "left" + (0 <= i ? "+" : "") + i + " top" + (0 <= n ? "+" : "") + n,
                        of: o.window
                    }, o._removeClass(C(this), "ui-dialog-dragging"), o._unblockFrames(), o._trigger("dragStop", e, s(t))
                }
            })
        },
        _makeResizable: function() {
            function o(e) {
                return {
                    originalPosition: e.originalPosition,
                    originalSize: e.originalSize,
                    position: e.position,
                    size: e.size
                }
            }
            var a = this,
                r = this.options,
                e = r.resizable,
                t = this.uiDialog.css("position"),
                i = "string" == typeof e ? e : "n,e,s,w,se,sw,ne,nw";
            this.uiDialog.resizable({
                cancel: ".ui-dialog-content",
                containment: "document",
                alsoResize: this.element,
                maxWidth: r.maxWidth,
                maxHeight: r.maxHeight,
                minWidth: r.minWidth,
                minHeight: this._minHeight(),
                handles: i,
                start: function(e, t) {
                    a._addClass(C(this), "ui-dialog-resizing"), a._blockFrames(), a._trigger("resizeStart", e, o(t))
                },
                resize: function(e, t) {
                    a._trigger("resize", e, o(t))
                },
                stop: function(e, t) {
                    var i = a.uiDialog.offset(),
                        n = i.left - a.document.scrollLeft(),
                        s = i.top - a.document.scrollTop();
                    r.height = a.uiDialog.height(), r.width = a.uiDialog.width(), r.position = {
                        my: "left top",
                        at: "left" + (0 <= n ? "+" : "") + n + " top" + (0 <= s ? "+" : "") + s,
                        of: a.window
                    }, a._removeClass(C(this), "ui-dialog-resizing"), a._unblockFrames(), a._trigger("resizeStop", e, o(t))
                }
            }).css("position", t)
        },
        _trackFocus: function() {
            this._on(this.widget(), {
                focusin: function(e) {
                    this._makeFocusTarget(), this._focusedElement = C(e.target)
                }
            })
        },
        _makeFocusTarget: function() {
            this._untrackInstance(), this._trackingInstances().unshift(this)
        },
        _untrackInstance: function() {
            var e = this._trackingInstances(),
                t = C.inArray(this, e); - 1 !== t && e.splice(t, 1)
        },
        _trackingInstances: function() {
            var e = this.document.data("ui-dialog-instances");
            return e || (e = [], this.document.data("ui-dialog-instances", e)), e
        },
        _minHeight: function() {
            var e = this.options;
            return "auto" === e.height ? e.minHeight : Math.min(e.minHeight, e.height)
        },
        _position: function() {
            var e = this.uiDialog.is(":visible");
            e || this.uiDialog.show(), this.uiDialog.position(this.options.position), e || this.uiDialog.hide()
        },
        _setOptions: function(e) {
            var i = this,
                n = !1,
                s = {};
            C.each(e, function(e, t) {
                i._setOption(e, t), e in i.sizeRelatedOptions && (n = !0), e in i.resizableRelatedOptions && (s[e] = t)
            }), n && (this._size(), this._position()), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", s)
        },
        _setOption: function(e, t) {
            var i, n, s = this.uiDialog;
            "disabled" !== e && (this._super(e, t), "appendTo" === e && this.uiDialog.appendTo(this._appendTo()), "buttons" === e && this._createButtons(), "closeText" === e && this.uiDialogTitlebarClose.button({
                label: C("<a>").text("" + this.options.closeText).html()
            }), "draggable" === e && ((i = s.is(":data(ui-draggable)")) && !t && s.draggable("destroy"), !i && t && this._makeDraggable()), "position" === e && this._position(), "resizable" === e && ((n = s.is(":data(ui-resizable)")) && !t && s.resizable("destroy"), n && "string" == typeof t && s.resizable("option", "handles", t), n || !1 === t || this._makeResizable()), "title" === e && this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))
        },
        _size: function() {
            var e, t, i, n = this.options;
            this.element.show().css({
                width: "auto",
                minHeight: 0,
                maxHeight: "none",
                height: 0
            }), n.minWidth > n.width && (n.width = n.minWidth), e = this.uiDialog.css({
                height: "auto",
                width: n.width
            }).outerHeight(), t = Math.max(0, n.minHeight - e), i = "number" == typeof n.maxHeight ? Math.max(0, n.maxHeight - e) : "none", "auto" === n.height ? this.element.css({
                minHeight: t,
                maxHeight: i,
                height: "auto"
            }) : this.element.height(Math.max(0, n.height - e)), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", "minHeight", this._minHeight())
        },
        _blockFrames: function() {
            this.iframeBlocks = this.document.find("iframe").map(function() {
                var e = C(this);
                return C("<div>").css({
                    position: "absolute",
                    width: e.outerWidth(),
                    height: e.outerHeight()
                }).appendTo(e.parent()).offset(e.offset())[0]
            })
        },
        _unblockFrames: function() {
            this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks)
        },
        _allowInteraction: function(e) {
            return !!C(e.target).closest(".ui-dialog").length || !!C(e.target).closest(".ui-datepicker").length
        },
        _createOverlay: function() {
            if (this.options.modal) {
                var t = !0;
                this._delay(function() {
                    t = !1
                }), this.document.data("ui-dialog-overlays") || this._on(this.document, {
                    focusin: function(e) {
                        t || this._allowInteraction(e) || (e.preventDefault(), this._trackingInstances()[0]._focusTabbable())
                    }
                }), this.overlay = C("<div>").appendTo(this._appendTo()), this._addClass(this.overlay, null, "ui-widget-overlay ui-front"), this._on(this.overlay, {
                    mousedown: "_keepFocus"
                }), this.document.data("ui-dialog-overlays", (this.document.data("ui-dialog-overlays") || 0) + 1)
            }
        },
        _destroyOverlay: function() {
            if (this.options.modal && this.overlay) {
                var e = this.document.data("ui-dialog-overlays") - 1;
                e ? this.document.data("ui-dialog-overlays", e) : (this._off(this.document, "focusin"), this.document.removeData("ui-dialog-overlays")), this.overlay.remove(), this.overlay = null
            }
        }
    }), !1 !== C.uiBackCompat && C.widget("ui.dialog", C.ui.dialog, {
        options: {
            dialogClass: ""
        },
        _createWrapper: function() {
            this._super(), this.uiDialog.addClass(this.options.dialogClass)
        },
        _setOption: function(e, t) {
            "dialogClass" === e && this.uiDialog.removeClass(this.options.dialogClass).addClass(t), this._superApply(arguments)
        }
    }), C.ui.dialog, C.widget("ui.droppable", {
        version: "1.12.1",
        widgetEventPrefix: "drop",
        options: {
            accept: "*",
            addClasses: !0,
            greedy: !1,
            scope: "default",
            tolerance: "intersect",
            activate: null,
            deactivate: null,
            drop: null,
            out: null,
            over: null
        },
        _create: function() {
            var e, t = this.options,
                i = t.accept;
            this.isover = !1, this.isout = !0, this.accept = C.isFunction(i) ? i : function(e) {
                return e.is(i)
            }, this.proportions = function() {
                return arguments.length ? void(e = arguments[0]) : e = e || {
                    width: this.element[0].offsetWidth,
                    height: this.element[0].offsetHeight
                }
            }, this._addToManager(t.scope), t.addClasses && this._addClass("ui-droppable")
        },
        _addToManager: function(e) {
            C.ui.ddmanager.droppables[e] = C.ui.ddmanager.droppables[e] || [], C.ui.ddmanager.droppables[e].push(this)
        },
        _splice: function(e) {
            for (var t = 0; e.length > t; t++) e[t] === this && e.splice(t, 1)
        },
        _destroy: function() {
            var e = C.ui.ddmanager.droppables[this.options.scope];
            this._splice(e)
        },
        _setOption: function(e, t) {
            if ("accept" === e) this.accept = C.isFunction(t) ? t : function(e) {
                return e.is(t)
            };
            else if ("scope" === e) {
                var i = C.ui.ddmanager.droppables[this.options.scope];
                this._splice(i), this._addToManager(t)
            }
            this._super(e, t)
        },
        _activate: function(e) {
            var t = C.ui.ddmanager.current;
            this._addActiveClass(), t && this._trigger("activate", e, this.ui(t))
        },
        _deactivate: function(e) {
            var t = C.ui.ddmanager.current;
            this._removeActiveClass(), t && this._trigger("deactivate", e, this.ui(t))
        },
        _over: function(e) {
            var t = C.ui.ddmanager.current;
            t && (t.currentItem || t.element)[0] !== this.element[0] && this.accept.call(this.element[0], t.currentItem || t.element) && (this._addHoverClass(), this._trigger("over", e, this.ui(t)))
        },
        _out: function(e) {
            var t = C.ui.ddmanager.current;
            t && (t.currentItem || t.element)[0] !== this.element[0] && this.accept.call(this.element[0], t.currentItem || t.element) && (this._removeHoverClass(), this._trigger("out", e, this.ui(t)))
        },
        _drop: function(t, e) {
            var i = e || C.ui.ddmanager.current,
                n = !1;
            return !(!i || (i.currentItem || i.element)[0] === this.element[0]) && (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() {
                var e = C(this).droppable("instance");
                return e.options.greedy && !e.options.disabled && e.options.scope === i.options.scope && e.accept.call(e.element[0], i.currentItem || i.element) && ae(i, C.extend(e, {
                    offset: e.element.offset()
                }), e.options.tolerance, t) ? !(n = !0) : void 0
            }), !n && !!this.accept.call(this.element[0], i.currentItem || i.element) && (this._removeActiveClass(), this._removeHoverClass(), this._trigger("drop", t, this.ui(i)), this.element))
        },
        ui: function(e) {
            return {
                draggable: e.currentItem || e.element,
                helper: e.helper,
                position: e.position,
                offset: e.positionAbs
            }
        },
        _addHoverClass: function() {
            this._addClass("ui-droppable-hover")
        },
        _removeHoverClass: function() {
            this._removeClass("ui-droppable-hover")
        },
        _addActiveClass: function() {
            this._addClass("ui-droppable-active")
        },
        _removeActiveClass: function() {
            this._removeClass("ui-droppable-active")
        }
    });
    var oe, ae = C.ui.intersect = function(e, t, i, n) {
        if (!t.offset) return !1;
        var s = (e.positionAbs || e.position.absolute).left + e.margins.left,
            o = (e.positionAbs || e.position.absolute).top + e.margins.top,
            a = s + e.helperProportions.width,
            r = o + e.helperProportions.height,
            l = t.offset.left,
            c = t.offset.top,
            h = l + t.proportions().width,
            u = c + t.proportions().height;
        switch (i) {
            case "fit":
                return l <= s && a <= h && c <= o && r <= u;
            case "intersect":
                return s + e.helperProportions.width / 2 > l && h > a - e.helperProportions.width / 2 && o + e.helperProportions.height / 2 > c && u > r - e.helperProportions.height / 2;
            case "pointer":
                return re(n.pageY, c, t.proportions().height) && re(n.pageX, l, t.proportions().width);
            case "touch":
                return (c <= o && o <= u || c <= r && r <= u || o < c && u < r) && (l <= s && s <= h || l <= a && a <= h || s < l && h < a);
            default:
                return !1
        }
    };

    function re(e, t, i) {
        return t <= e && e < t + i
    }!(C.ui.ddmanager = {
        current: null,
        droppables: {
            default: []
        },
        prepareOffsets: function(e, t) {
            var i, n, s = C.ui.ddmanager.droppables[e.options.scope] || [],
                o = t ? t.type : null,
                a = (e.currentItem || e.element).find(":data(ui-droppable)").addBack();
            e: for (i = 0; s.length > i; i++)
                if (!(s[i].options.disabled || e && !s[i].accept.call(s[i].element[0], e.currentItem || e.element))) {
                    for (n = 0; a.length > n; n++)
                        if (a[n] === s[i].element[0]) {
                            s[i].proportions().height = 0;
                            continue e
                        }
                    s[i].visible = "none" !== s[i].element.css("display"), s[i].visible && ("mousedown" === o && s[i]._activate.call(s[i], t), s[i].offset = s[i].element.offset(), s[i].proportions({
                        width: s[i].element[0].offsetWidth,
                        height: s[i].element[0].offsetHeight
                    }))
                }
        },
        drop: function(e, t) {
            var i = !1;
            return C.each((C.ui.ddmanager.droppables[e.options.scope] || []).slice(), function() {
                this.options && (!this.options.disabled && this.visible && ae(e, this, this.options.tolerance, t) && (i = this._drop.call(this, t) || i), !this.options.disabled && this.visible && this.accept.call(this.element[0], e.currentItem || e.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, t)))
            }), i
        },
        dragStart: function(e, t) {
            e.element.parentsUntil("body").on("scroll.droppable", function() {
                e.options.refreshPositions || C.ui.ddmanager.prepareOffsets(e, t)
            })
        },
        drag: function(o, a) {
            o.options.refreshPositions && C.ui.ddmanager.prepareOffsets(o, a), C.each(C.ui.ddmanager.droppables[o.options.scope] || [], function() {
                if (!this.options.disabled && !this.greedyChild && this.visible) {
                    var e, t, i, n = ae(o, this, this.options.tolerance, a),
                        s = !n && this.isover ? "isout" : n && !this.isover ? "isover" : null;
                    s && (this.options.greedy && (t = this.options.scope, (i = this.element.parents(":data(ui-droppable)").filter(function() {
                        return C(this).droppable("instance").options.scope === t
                    })).length && ((e = C(i[0]).droppable("instance")).greedyChild = "isover" === s)), e && "isover" === s && (e.isover = !1, e.isout = !0, e._out.call(e, a)), this[s] = !0, this["isout" === s ? "isover" : "isout"] = !1, this["isover" === s ? "_over" : "_out"].call(this, a), e && "isout" === s && (e.isout = !1, e.isover = !0, e._over.call(e, a)))
                }
            })
        },
        dragStop: function(e, t) {
            e.element.parentsUntil("body").off("scroll.droppable"), e.options.refreshPositions || C.ui.ddmanager.prepareOffsets(e, t)
        }
    }) !== C.uiBackCompat && C.widget("ui.droppable", C.ui.droppable, {
        options: {
            hoverClass: !1,
            activeClass: !1
        },
        _addActiveClass: function() {
            this._super(), this.options.activeClass && this.element.addClass(this.options.activeClass)
        },
        _removeActiveClass: function() {
            this._super(), this.options.activeClass && this.element.removeClass(this.options.activeClass)
        },
        _addHoverClass: function() {
            this._super(), this.options.hoverClass && this.element.addClass(this.options.hoverClass)
        },
        _removeHoverClass: function() {
            this._super(), this.options.hoverClass && this.element.removeClass(this.options.hoverClass)
        }
    }), C.ui.droppable, C.widget("ui.progressbar", {
        version: "1.12.1",
        options: {
            classes: {
                "ui-progressbar": "ui-corner-all",
                "ui-progressbar-value": "ui-corner-left",
                "ui-progressbar-complete": "ui-corner-right"
            },
            max: 100,
            value: 0,
            change: null,
            complete: null
        },
        min: 0,
        _create: function() {
            this.oldValue = this.options.value = this._constrainedValue(), this.element.attr({
                role: "progressbar",
                "aria-valuemin": this.min
            }), this._addClass("ui-progressbar", "ui-widget ui-widget-content"), this.valueDiv = C("<div>").appendTo(this.element), this._addClass(this.valueDiv, "ui-progressbar-value", "ui-widget-header"), this._refreshValue()
        },
        _destroy: function() {
            this.element.removeAttr("role aria-valuemin aria-valuemax aria-valuenow"), this.valueDiv.remove()
        },
        value: function(e) {
            return void 0 === e ? this.options.value : (this.options.value = this._constrainedValue(e), void this._refreshValue())
        },
        _constrainedValue: function(e) {
            return void 0 === e && (e = this.options.value), this.indeterminate = !1 === e, "number" != typeof e && (e = 0), !this.indeterminate && Math.min(this.options.max, Math.max(this.min, e))
        },
        _setOptions: function(e) {
            var t = e.value;
            delete e.value, this._super(e), this.options.value = this._constrainedValue(t), this._refreshValue()
        },
        _setOption: function(e, t) {
            "max" === e && (t = Math.max(this.min, t)), this._super(e, t)
        },
        _setOptionDisabled: function(e) {
            this._super(e), this.element.attr("aria-disabled", e), this._toggleClass(null, "ui-state-disabled", !!e)
        },
        _percentage: function() {
            return this.indeterminate ? 100 : 100 * (this.options.value - this.min) / (this.options.max - this.min)
        },
        _refreshValue: function() {
            var e = this.options.value,
                t = this._percentage();
            this.valueDiv.toggle(this.indeterminate || e > this.min).width(t.toFixed(0) + "%"), this._toggleClass(this.valueDiv, "ui-progressbar-complete", null, e === this.options.max)._toggleClass("ui-progressbar-indeterminate", null, this.indeterminate), this.indeterminate ? (this.element.removeAttr("aria-valuenow"), this.overlayDiv || (this.overlayDiv = C("<div>").appendTo(this.valueDiv), this._addClass(this.overlayDiv, "ui-progressbar-overlay"))) : (this.element.attr({
                "aria-valuemax": this.options.max,
                "aria-valuenow": e
            }), this.overlayDiv && (this.overlayDiv.remove(), this.overlayDiv = null)), this.oldValue !== e && (this.oldValue = e, this._trigger("change")), e === this.options.max && this._trigger("complete")
        }
    }), C.widget("ui.selectable", C.ui.mouse, {
        version: "1.12.1",
        options: {
            appendTo: "body",
            autoRefresh: !0,
            distance: 0,
            filter: "*",
            tolerance: "touch",
            selected: null,
            selecting: null,
            start: null,
            stop: null,
            unselected: null,
            unselecting: null
        },
        _create: function() {
            var n = this;
            this._addClass("ui-selectable"), this.dragged = !1, this.refresh = function() {
                n.elementPos = C(n.element[0]).offset(), n.selectees = C(n.options.filter, n.element[0]), n._addClass(n.selectees, "ui-selectee"), n.selectees.each(function() {
                    var e = C(this),
                        t = e.offset(),
                        i = {
                            left: t.left - n.elementPos.left,
                            top: t.top - n.elementPos.top
                        };
                    C.data(this, "selectable-item", {
                        element: this,
                        $element: e,
                        left: i.left,
                        top: i.top,
                        right: i.left + e.outerWidth(),
                        bottom: i.top + e.outerHeight(),
                        startselected: !1,
                        selected: e.hasClass("ui-selected"),
                        selecting: e.hasClass("ui-selecting"),
                        unselecting: e.hasClass("ui-unselecting")
                    })
                })
            }, this.refresh(), this._mouseInit(), this.helper = C("<div>"), this._addClass(this.helper, "ui-selectable-helper")
        },
        _destroy: function() {
            this.selectees.removeData("selectable-item"), this._mouseDestroy()
        },
        _mouseStart: function(i) {
            var n = this,
                e = this.options;
            this.opos = [i.pageX, i.pageY], this.elementPos = C(this.element[0]).offset(), this.options.disabled || (this.selectees = C(e.filter, this.element[0]), this._trigger("start", i), C(e.appendTo).append(this.helper), this.helper.css({
                left: i.pageX,
                top: i.pageY,
                width: 0,
                height: 0
            }), e.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each(function() {
                var e = C.data(this, "selectable-item");
                e.startselected = !0, i.metaKey || i.ctrlKey || (n._removeClass(e.$element, "ui-selected"), e.selected = !1, n._addClass(e.$element, "ui-unselecting"), e.unselecting = !0, n._trigger("unselecting", i, {
                    unselecting: e.element
                }))
            }), C(i.target).parents().addBack().each(function() {
                var e, t = C.data(this, "selectable-item");
                return t ? (e = !i.metaKey && !i.ctrlKey || !t.$element.hasClass("ui-selected"), n._removeClass(t.$element, e ? "ui-unselecting" : "ui-selected")._addClass(t.$element, e ? "ui-selecting" : "ui-unselecting"), t.unselecting = !e, t.selecting = e, (t.selected = e) ? n._trigger("selecting", i, {
                    selecting: t.element
                }) : n._trigger("unselecting", i, {
                    unselecting: t.element
                }), !1) : void 0
            }))
        },
        _mouseDrag: function(n) {
            if (this.dragged = !0, !this.options.disabled) {
                var e, s = this,
                    o = this.options,
                    a = this.opos[0],
                    r = this.opos[1],
                    l = n.pageX,
                    c = n.pageY;
                return l < a && (e = l, l = a, a = e), c < r && (e = c, c = r, r = e), this.helper.css({
                    left: a,
                    top: r,
                    width: l - a,
                    height: c - r
                }), this.selectees.each(function() {
                    var e = C.data(this, "selectable-item"),
                        t = !1,
                        i = {};
                    e && e.element !== s.element[0] && (i.left = e.left + s.elementPos.left, i.right = e.right + s.elementPos.left, i.top = e.top + s.elementPos.top, i.bottom = e.bottom + s.elementPos.top, "touch" === o.tolerance ? t = !(i.left > l || a > i.right || i.top > c || r > i.bottom) : "fit" === o.tolerance && (t = i.left > a && l > i.right && i.top > r && c > i.bottom), t ? (e.selected && (s._removeClass(e.$element, "ui-selected"), e.selected = !1), e.unselecting && (s._removeClass(e.$element, "ui-unselecting"), e.unselecting = !1), e.selecting || (s._addClass(e.$element, "ui-selecting"), e.selecting = !0, s._trigger("selecting", n, {
                        selecting: e.element
                    }))) : (e.selecting && ((n.metaKey || n.ctrlKey) && e.startselected ? (s._removeClass(e.$element, "ui-selecting"), e.selecting = !1, s._addClass(e.$element, "ui-selected"), e.selected = !0) : (s._removeClass(e.$element, "ui-selecting"), e.selecting = !1, e.startselected && (s._addClass(e.$element, "ui-unselecting"), e.unselecting = !0), s._trigger("unselecting", n, {
                        unselecting: e.element
                    }))), e.selected && (n.metaKey || n.ctrlKey || e.startselected || (s._removeClass(e.$element, "ui-selected"), e.selected = !1, s._addClass(e.$element, "ui-unselecting"), e.unselecting = !0, s._trigger("unselecting", n, {
                        unselecting: e.element
                    })))))
                }), !1
            }
        },
        _mouseStop: function(t) {
            var i = this;
            return this.dragged = !1, C(".ui-unselecting", this.element[0]).each(function() {
                var e = C.data(this, "selectable-item");
                i._removeClass(e.$element, "ui-unselecting"), e.unselecting = !1, e.startselected = !1, i._trigger("unselected", t, {
                    unselected: e.element
                })
            }), C(".ui-selecting", this.element[0]).each(function() {
                var e = C.data(this, "selectable-item");
                i._removeClass(e.$element, "ui-selecting")._addClass(e.$element, "ui-selected"), e.selecting = !1, e.selected = !0, e.startselected = !0, i._trigger("selected", t, {
                    selected: e.element
                })
            }), this._trigger("stop", t), this.helper.remove(), !1
        }
    }), C.widget("ui.selectmenu", [C.ui.formResetMixin, {
        version: "1.12.1",
        defaultElement: "<select>",
        options: {
            appendTo: null,
            classes: {
                "ui-selectmenu-button-open": "ui-corner-top",
                "ui-selectmenu-button-closed": "ui-corner-all"
            },
            disabled: null,
            icons: {
                button: "ui-icon-triangle-1-s"
            },
            position: {
                my: "left top",
                at: "left bottom",
                collision: "none"
            },
            width: !1,
            change: null,
            close: null,
            focus: null,
            open: null,
            select: null
        },
        _create: function() {
            var e = this.element.uniqueId().attr("id");
            this.ids = {
                element: e,
                button: e + "-button",
                menu: e + "-menu"
            }, this._drawButton(), this._drawMenu(), this._bindFormResetHandler(), this._rendered = !1, this.menuItems = C()
        },
        _drawButton: function() {
            var e, t = this,
                i = this._parseOption(this.element.find("option:selected"), this.element[0].selectedIndex);
            this.labels = this.element.labels().attr("for", this.ids.button), this._on(this.labels, {
                click: function(e) {
                    this.button.focus(), e.preventDefault()
                }
            }), this.element.hide(), this.button = C("<span>", {
                tabindex: this.options.disabled ? -1 : 0,
                id: this.ids.button,
                role: "combobox",
                "aria-expanded": "false",
                "aria-autocomplete": "list",
                "aria-owns": this.ids.menu,
                "aria-haspopup": "true",
                title: this.element.attr("title")
            }).insertAfter(this.element), this._addClass(this.button, "ui-selectmenu-button ui-selectmenu-button-closed", "ui-button ui-widget"), e = C("<span>").appendTo(this.button), this._addClass(e, "ui-selectmenu-icon", "ui-icon " + this.options.icons.button), this.buttonItem = this._renderButtonItem(i).appendTo(this.button), !1 !== this.options.width && this._resizeButton(), this._on(this.button, this._buttonEvents), this.button.one("focusin", function() {
                t._rendered || t._refreshMenu()
            })
        },
        _drawMenu: function() {
            var n = this;
            this.menu = C("<ul>", {
                "aria-hidden": "true",
                "aria-labelledby": this.ids.button,
                id: this.ids.menu
            }), this.menuWrap = C("<div>").append(this.menu), this._addClass(this.menuWrap, "ui-selectmenu-menu", "ui-front"), this.menuWrap.appendTo(this._appendTo()), this.menuInstance = this.menu.menu({
                classes: {
                    "ui-menu": "ui-corner-bottom"
                },
                role: "listbox",
                select: function(e, t) {
                    e.preventDefault(), n._setSelection(), n._select(t.item.data("ui-selectmenu-item"), e)
                },
                focus: function(e, t) {
                    var i = t.item.data("ui-selectmenu-item");
                    null != n.focusIndex && i.index !== n.focusIndex && (n._trigger("focus", e, {
                        item: i
                    }), n.isOpen || n._select(i, e)), n.focusIndex = i.index, n.button.attr("aria-activedescendant", n.menuItems.eq(i.index).attr("id"))
                }
            }).menu("instance"), this.menuInstance._off(this.menu, "mouseleave"), this.menuInstance._closeOnDocumentClick = function() {
                return !1
            }, this.menuInstance._isDivider = function() {
                return !1
            }
        },
        refresh: function() {
            this._refreshMenu(), this.buttonItem.replaceWith(this.buttonItem = this._renderButtonItem(this._getSelectedItem().data("ui-selectmenu-item") || {})), null === this.options.width && this._resizeButton()
        },
        _refreshMenu: function() {
            var e, t = this.element.find("option");
            this.menu.empty(), this._parseOptions(t), this._renderMenu(this.menu, this.items), this.menuInstance.refresh(), this.menuItems = this.menu.find("li").not(".ui-selectmenu-optgroup").find(".ui-menu-item-wrapper"), this._rendered = !0, t.length && (e = this._getSelectedItem(), this.menuInstance.focus(null, e), this._setAria(e.data("ui-selectmenu-item")), this._setOption("disabled", this.element.prop("disabled")))
        },
        open: function(e) {
            this.options.disabled || (this._rendered ? (this._removeClass(this.menu.find(".ui-state-active"), null, "ui-state-active"), this.menuInstance.focus(null, this._getSelectedItem())) : this._refreshMenu(), this.menuItems.length && (this.isOpen = !0, this._toggleAttr(), this._resizeMenu(), this._position(), this._on(this.document, this._documentClick), this._trigger("open", e)))
        },
        _position: function() {
            this.menuWrap.position(C.extend({
                of: this.button
            }, this.options.position))
        },
        close: function(e) {
            this.isOpen && (this.isOpen = !1, this._toggleAttr(), this.range = null, this._off(this.document), this._trigger("close", e))
        },
        widget: function() {
            return this.button
        },
        menuWidget: function() {
            return this.menu
        },
        _renderButtonItem: function(e) {
            var t = C("<span>");
            return this._setText(t, e.label), this._addClass(t, "ui-selectmenu-text"), t
        },
        _renderMenu: function(n, e) {
            var s = this,
                o = "";
            C.each(e, function(e, t) {
                var i;
                t.optgroup !== o && (i = C("<li>", {
                    text: t.optgroup
                }), s._addClass(i, "ui-selectmenu-optgroup", "ui-menu-divider" + (t.element.parent("optgroup").prop("disabled") ? " ui-state-disabled" : "")), i.appendTo(n), o = t.optgroup), s._renderItemData(n, t)
            })
        },
        _renderItemData: function(e, t) {
            return this._renderItem(e, t).data("ui-selectmenu-item", t)
        },
        _renderItem: function(e, t) {
            var i = C("<li>"),
                n = C("<div>", {
                    title: t.element.attr("title")
                });
            return t.disabled && this._addClass(i, null, "ui-state-disabled"), this._setText(n, t.label), i.append(n).appendTo(e)
        },
        _setText: function(e, t) {
            t ? e.text(t) : e.html("&#160;")
        },
        _move: function(e, t) {
            var i, n, s = ".ui-menu-item";
            this.isOpen ? i = this.menuItems.eq(this.focusIndex).parent("li") : (i = this.menuItems.eq(this.element[0].selectedIndex).parent("li"), s += ":not(.ui-state-disabled)"), (n = "first" === e || "last" === e ? i["first" === e ? "prevAll" : "nextAll"](s).eq(-1) : i[e + "All"](s).eq(0)).length && this.menuInstance.focus(t, n)
        },
        _getSelectedItem: function() {
            return this.menuItems.eq(this.element[0].selectedIndex).parent("li")
        },
        _toggle: function(e) {
            this[this.isOpen ? "close" : "open"](e)
        },
        _setSelection: function() {
            var e;
            this.range && (window.getSelection ? ((e = window.getSelection()).removeAllRanges(), e.addRange(this.range)) : this.range.select(), this.button.focus())
        },
        _documentClick: {
            mousedown: function(e) {
                this.isOpen && (C(e.target).closest(".ui-selectmenu-menu, #" + C.ui.escapeSelector(this.ids.button)).length || this.close(e))
            }
        },
        _buttonEvents: {
            mousedown: function() {
                var e;
                window.getSelection ? (e = window.getSelection()).rangeCount && (this.range = e.getRangeAt(0)) : this.range = document.selection.createRange()
            },
            click: function(e) {
                this._setSelection(), this._toggle(e)
            },
            keydown: function(e) {
                var t = !0;
                switch (e.keyCode) {
                    case C.ui.keyCode.TAB:
                    case C.ui.keyCode.ESCAPE:
                        this.close(e), t = !1;
                        break;
                    case C.ui.keyCode.ENTER:
                        this.isOpen && this._selectFocusedItem(e);
                        break;
                    case C.ui.keyCode.UP:
                        e.altKey ? this._toggle(e) : this._move("prev", e);
                        break;
                    case C.ui.keyCode.DOWN:
                        e.altKey ? this._toggle(e) : this._move("next", e);
                        break;
                    case C.ui.keyCode.SPACE:
                        this.isOpen ? this._selectFocusedItem(e) : this._toggle(e);
                        break;
                    case C.ui.keyCode.LEFT:
                        this._move("prev", e);
                        break;
                    case C.ui.keyCode.RIGHT:
                        this._move("next", e);
                        break;
                    case C.ui.keyCode.HOME:
                    case C.ui.keyCode.PAGE_UP:
                        this._move("first", e);
                        break;
                    case C.ui.keyCode.END:
                    case C.ui.keyCode.PAGE_DOWN:
                        this._move("last", e);
                        break;
                    default:
                        this.menu.trigger(e), t = !1
                }
                t && e.preventDefault()
            }
        },
        _selectFocusedItem: function(e) {
            var t = this.menuItems.eq(this.focusIndex).parent("li");
            t.hasClass("ui-state-disabled") || this._select(t.data("ui-selectmenu-item"), e)
        },
        _select: function(e, t) {
            var i = this.element[0].selectedIndex;
            this.element[0].selectedIndex = e.index, this.buttonItem.replaceWith(this.buttonItem = this._renderButtonItem(e)), this._setAria(e), this._trigger("select", t, {
                item: e
            }), e.index !== i && this._trigger("change", t, {
                item: e
            }), this.close(t)
        },
        _setAria: function(e) {
            var t = this.menuItems.eq(e.index).attr("id");
            this.button.attr({
                "aria-labelledby": t,
                "aria-activedescendant": t
            }), this.menu.attr("aria-activedescendant", t)
        },
        _setOption: function(e, t) {
            if ("icons" === e) {
                var i = this.button.find("span.ui-icon");
                this._removeClass(i, null, this.options.icons.button)._addClass(i, null, t.button)
            }
            this._super(e, t), "appendTo" === e && this.menuWrap.appendTo(this._appendTo()), "width" === e && this._resizeButton()
        },
        _setOptionDisabled: function(e) {
            this._super(e), this.menuInstance.option("disabled", e), this.button.attr("aria-disabled", e), this._toggleClass(this.button, null, "ui-state-disabled", e), this.element.prop("disabled", e), e ? (this.button.attr("tabindex", -1), this.close()) : this.button.attr("tabindex", 0)
        },
        _appendTo: function() {
            var e = this.options.appendTo;
            return (e = e && (e.jquery || e.nodeType ? C(e) : this.document.find(e).eq(0))) && e[0] || (e = this.element.closest(".ui-front, dialog")), e.length || (e = this.document[0].body), e
        },
        _toggleAttr: function() {
            this.button.attr("aria-expanded", this.isOpen), this._removeClass(this.button, "ui-selectmenu-button-" + (this.isOpen ? "closed" : "open"))._addClass(this.button, "ui-selectmenu-button-" + (this.isOpen ? "open" : "closed"))._toggleClass(this.menuWrap, "ui-selectmenu-open", null, this.isOpen), this.menu.attr("aria-hidden", !this.isOpen)
        },
        _resizeButton: function() {
            var e = this.options.width;
            return !1 === e ? void this.button.css("width", "") : (null === e && (e = this.element.show().outerWidth(), this.element.hide()), void this.button.outerWidth(e))
        },
        _resizeMenu: function() {
            this.menu.outerWidth(Math.max(this.button.outerWidth(), this.menu.width("").outerWidth() + 1))
        },
        _getCreateOptions: function() {
            var e = this._super();
            return e.disabled = this.element.prop("disabled"), e
        },
        _parseOptions: function(e) {
            var i = this,
                n = [];
            e.each(function(e, t) {
                n.push(i._parseOption(C(t), e))
            }), this.items = n
        },
        _parseOption: function(e, t) {
            var i = e.parent("optgroup");
            return {
                element: e,
                index: t,
                value: e.val(),
                label: e.text(),
                optgroup: i.attr("label") || "",
                disabled: i.prop("disabled") || e.prop("disabled")
            }
        },
        _destroy: function() {
            this._unbindFormResetHandler(), this.menuWrap.remove(), this.button.remove(), this.element.show(), this.element.removeUniqueId(), this.labels.attr("for", this.ids.element)
        }
    }]), C.widget("ui.slider", C.ui.mouse, {
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
        _create: function() {
            this._keySliding = !1, this._mouseSliding = !1, this._animateOff = !0, this._handleIndex = null, this._detectOrientation(), this._mouseInit(), this._calculateNewMax(), this._addClass("ui-slider ui-slider-" + this.orientation, "ui-widget ui-widget-content"), this._refresh(), this._animateOff = !1
        },
        _refresh: function() {
            this._createRange(), this._createHandles(), this._setupEvents(), this._refreshValue()
        },
        _createHandles: function() {
            var e, t, i = this.options,
                n = this.element.find(".ui-slider-handle"),
                s = [];
            for (t = i.values && i.values.length || 1, n.length > t && (n.slice(t).remove(), n = n.slice(0, t)), e = n.length; e < t; e++) s.push("<span tabindex='0'></span>");
            this.handles = n.add(C(s.join("")).appendTo(this.element)), this._addClass(this.handles, "ui-slider-handle", "ui-state-default"), this.handle = this.handles.eq(0), this.handles.each(function(e) {
                C(this).data("ui-slider-handle-index", e).attr("tabIndex", 0)
            })
        },
        _createRange: function() {
            var e = this.options;
            e.range ? (!0 === e.range && (e.values ? e.values.length && 2 !== e.values.length ? e.values = [e.values[0], e.values[0]] : C.isArray(e.values) && (e.values = e.values.slice(0)) : e.values = [this._valueMin(), this._valueMin()]), this.range && this.range.length ? (this._removeClass(this.range, "ui-slider-range-min ui-slider-range-max"), this.range.css({
                left: "",
                bottom: ""
            })) : (this.range = C("<div>").appendTo(this.element), this._addClass(this.range, "ui-slider-range")), "min" !== e.range && "max" !== e.range || this._addClass(this.range, "ui-slider-range-" + e.range)) : (this.range && this.range.remove(), this.range = null)
        },
        _setupEvents: function() {
            this._off(this.handles), this._on(this.handles, this._handleEvents), this._hoverable(this.handles), this._focusable(this.handles)
        },
        _destroy: function() {
            this.handles.remove(), this.range && this.range.remove(), this._mouseDestroy()
        },
        _mouseCapture: function(e) {
            var t, i, n, s, o, a, r, l = this,
                c = this.options;
            return !c.disabled && (this.elementSize = {
                width: this.element.outerWidth(),
                height: this.element.outerHeight()
            }, this.elementOffset = this.element.offset(), t = {
                x: e.pageX,
                y: e.pageY
            }, i = this._normValueFromMouse(t), n = this._valueMax() - this._valueMin() + 1, this.handles.each(function(e) {
                var t = Math.abs(i - l.values(e));
                (t < n || n === t && (e === l._lastChangedValue || l.values(e) === c.min)) && (n = t, s = C(this), o = e)
            }), !1 !== this._start(e, o) && (this._mouseSliding = !0, this._handleIndex = o, this._addClass(s, null, "ui-state-active"), s.trigger("focus"), a = s.offset(), r = !C(e.target).parents().addBack().is(".ui-slider-handle"), this._clickOffset = r ? {
                left: 0,
                top: 0
            } : {
                left: e.pageX - a.left - s.width() / 2,
                top: e.pageY - a.top - s.height() / 2 - (parseInt(s.css("borderTopWidth"), 10) || 0) - (parseInt(s.css("borderBottomWidth"), 10) || 0) + (parseInt(s.css("marginTop"), 10) || 0)
            }, this.handles.hasClass("ui-state-hover") || this._slide(e, o, i), this._animateOff = !0))
        },
        _mouseStart: function() {
            return !0
        },
        _mouseDrag: function(e) {
            var t = {
                    x: e.pageX,
                    y: e.pageY
                },
                i = this._normValueFromMouse(t);
            return this._slide(e, this._handleIndex, i), !1
        },
        _mouseStop: function(e) {
            return this._removeClass(this.handles, null, "ui-state-active"), this._mouseSliding = !1, this._stop(e, this._handleIndex), this._change(e, this._handleIndex), this._handleIndex = null, this._clickOffset = null, this._animateOff = !1
        },
        _detectOrientation: function() {
            this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal"
        },
        _normValueFromMouse: function(e) {
            var t, i, n, s;
            return 1 < (i = ("horizontal" === this.orientation ? (t = this.elementSize.width, e.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (t = this.elementSize.height, e.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0))) / t) && (i = 1), i < 0 && (i = 0), "vertical" === this.orientation && (i = 1 - i), n = this._valueMax() - this._valueMin(), s = this._valueMin() + i * n, this._trimAlignValue(s)
        },
        _uiHash: function(e, t, i) {
            var n = {
                handle: this.handles[e],
                handleIndex: e,
                value: void 0 !== t ? t : this.value()
            };
            return this._hasMultipleValues() && (n.value = void 0 !== t ? t : this.values(e), n.values = i || this.values()), n
        },
        _hasMultipleValues: function() {
            return this.options.values && this.options.values.length
        },
        _start: function(e, t) {
            return this._trigger("start", e, this._uiHash(t))
        },
        _slide: function(e, t, i) {
            var n, s = this.value(),
                o = this.values();
            this._hasMultipleValues() && (n = this.values(t ? 0 : 1), s = this.values(t), 2 === this.options.values.length && !0 === this.options.range && (i = 0 === t ? Math.min(n, i) : Math.max(n, i)), o[t] = i), i === s || !1 !== this._trigger("slide", e, this._uiHash(t, i, o)) && (this._hasMultipleValues() ? this.values(t, i) : this.value(i))
        },
        _stop: function(e, t) {
            this._trigger("stop", e, this._uiHash(t))
        },
        _change: function(e, t) {
            this._keySliding || this._mouseSliding || (this._lastChangedValue = t, this._trigger("change", e, this._uiHash(t)))
        },
        value: function(e) {
            return arguments.length ? (this.options.value = this._trimAlignValue(e), this._refreshValue(), void this._change(null, 0)) : this._value()
        },
        values: function(e, t) {
            var i, n, s;
            if (1 < arguments.length) return this.options.values[e] = this._trimAlignValue(t), this._refreshValue(), void this._change(null, e);
            if (!arguments.length) return this._values();
            if (!C.isArray(e)) return this._hasMultipleValues() ? this._values(e) : this.value();
            for (i = this.options.values, n = e, s = 0; i.length > s; s += 1) i[s] = this._trimAlignValue(n[s]), this._change(null, s);
            this._refreshValue()
        },
        _setOption: function(e, t) {
            var i, n = 0;
            switch ("range" === e && !0 === this.options.range && ("min" === t ? (this.options.value = this._values(0), this.options.values = null) : "max" === t && (this.options.value = this._values(this.options.values.length - 1), this.options.values = null)), C.isArray(this.options.values) && (n = this.options.values.length), this._super(e, t), e) {
                case "orientation":
                    this._detectOrientation(), this._removeClass("ui-slider-horizontal ui-slider-vertical")._addClass("ui-slider-" + this.orientation), this._refreshValue(), this.options.range && this._refreshRange(t), this.handles.css("horizontal" === t ? "bottom" : "left", "");
                    break;
                case "value":
                    this._animateOff = !0, this._refreshValue(), this._change(null, 0), this._animateOff = !1;
                    break;
                case "values":
                    for (this._animateOff = !0, this._refreshValue(), i = n - 1; 0 <= i; i--) this._change(null, i);
                    this._animateOff = !1;
                    break;
                case "step":
                case "min":
                case "max":
                    this._animateOff = !0, this._calculateNewMax(), this._refreshValue(), this._animateOff = !1;
                    break;
                case "range":
                    this._animateOff = !0, this._refresh(), this._animateOff = !1
            }
        },
        _setOptionDisabled: function(e) {
            this._super(e), this._toggleClass(null, "ui-state-disabled", !!e)
        },
        _value: function() {
            var e = this.options.value;
            return this._trimAlignValue(e)
        },
        _values: function(e) {
            var t, i, n;
            if (arguments.length) return t = this.options.values[e], this._trimAlignValue(t);
            if (this._hasMultipleValues()) {
                for (i = this.options.values.slice(), n = 0; i.length > n; n += 1) i[n] = this._trimAlignValue(i[n]);
                return i
            }
            return []
        },
        _trimAlignValue: function(e) {
            if (this._valueMin() >= e) return this._valueMin();
            if (e >= this._valueMax()) return this._valueMax();
            var t = 0 < this.options.step ? this.options.step : 1,
                i = (e - this._valueMin()) % t,
                n = e - i;
            return 2 * Math.abs(i) >= t && (n += 0 < i ? t : -t), parseFloat(n.toFixed(5))
        },
        _calculateNewMax: function() {
            var e = this.options.max,
                t = this._valueMin(),
                i = this.options.step;
            (e = Math.round((e - t) / i) * i + t) > this.options.max && (e -= i), this.max = parseFloat(e.toFixed(this._precision()))
        },
        _precision: function() {
            var e = this._precisionOf(this.options.step);
            return null !== this.options.min && (e = Math.max(e, this._precisionOf(this.options.min))), e
        },
        _precisionOf: function(e) {
            var t = "" + e,
                i = t.indexOf(".");
            return -1 === i ? 0 : t.length - i - 1
        },
        _valueMin: function() {
            return this.options.min
        },
        _valueMax: function() {
            return this.max
        },
        _refreshRange: function(e) {
            "vertical" === e && this.range.css({
                width: "",
                left: ""
            }), "horizontal" === e && this.range.css({
                height: "",
                bottom: ""
            })
        },
        _refreshValue: function() {
            var t, i, e, n, s, o = this.options.range,
                a = this.options,
                r = this,
                l = !this._animateOff && a.animate,
                c = {};
            this._hasMultipleValues() ? this.handles.each(function(e) {
                i = (r.values(e) - r._valueMin()) / (r._valueMax() - r._valueMin()) * 100, c["horizontal" === r.orientation ? "left" : "bottom"] = i + "%", C(this).stop(1, 1)[l ? "animate" : "css"](c, a.animate), !0 === r.options.range && ("horizontal" === r.orientation ? (0 === e && r.range.stop(1, 1)[l ? "animate" : "css"]({
                    left: i + "%"
                }, a.animate), 1 === e && r.range[l ? "animate" : "css"]({
                    width: i - t + "%"
                }, {
                    queue: !1,
                    duration: a.animate
                })) : (0 === e && r.range.stop(1, 1)[l ? "animate" : "css"]({
                    bottom: i + "%"
                }, a.animate), 1 === e && r.range[l ? "animate" : "css"]({
                    height: i - t + "%"
                }, {
                    queue: !1,
                    duration: a.animate
                }))), t = i
            }) : (e = this.value(), n = this._valueMin(), s = this._valueMax(), i = s !== n ? (e - n) / (s - n) * 100 : 0, c["horizontal" === this.orientation ? "left" : "bottom"] = i + "%", this.handle.stop(1, 1)[l ? "animate" : "css"](c, a.animate), "min" === o && "horizontal" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
                width: i + "%"
            }, a.animate), "max" === o && "horizontal" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
                width: 100 - i + "%"
            }, a.animate), "min" === o && "vertical" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
                height: i + "%"
            }, a.animate), "max" === o && "vertical" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
                height: 100 - i + "%"
            }, a.animate))
        },
        _handleEvents: {
            keydown: function(e) {
                var t, i, n, s = C(e.target).data("ui-slider-handle-index");
                switch (e.keyCode) {
                    case C.ui.keyCode.HOME:
                    case C.ui.keyCode.END:
                    case C.ui.keyCode.PAGE_UP:
                    case C.ui.keyCode.PAGE_DOWN:
                    case C.ui.keyCode.UP:
                    case C.ui.keyCode.RIGHT:
                    case C.ui.keyCode.DOWN:
                    case C.ui.keyCode.LEFT:
                        if (e.preventDefault(), !this._keySliding && (this._keySliding = !0, this._addClass(C(e.target), null, "ui-state-active"), !1 === this._start(e, s))) return
                }
                switch (n = this.options.step, t = i = this._hasMultipleValues() ? this.values(s) : this.value(), e.keyCode) {
                    case C.ui.keyCode.HOME:
                        i = this._valueMin();
                        break;
                    case C.ui.keyCode.END:
                        i = this._valueMax();
                        break;
                    case C.ui.keyCode.PAGE_UP:
                        i = this._trimAlignValue(t + (this._valueMax() - this._valueMin()) / this.numPages);
                        break;
                    case C.ui.keyCode.PAGE_DOWN:
                        i = this._trimAlignValue(t - (this._valueMax() - this._valueMin()) / this.numPages);
                        break;
                    case C.ui.keyCode.UP:
                    case C.ui.keyCode.RIGHT:
                        if (t === this._valueMax()) return;
                        i = this._trimAlignValue(t + n);
                        break;
                    case C.ui.keyCode.DOWN:
                    case C.ui.keyCode.LEFT:
                        if (t === this._valueMin()) return;
                        i = this._trimAlignValue(t - n)
                }
                this._slide(e, s, i)
            },
            keyup: function(e) {
                var t = C(e.target).data("ui-slider-handle-index");
                this._keySliding && (this._keySliding = !1, this._stop(e, t), this._change(e, t), this._removeClass(C(e.target), null, "ui-state-active"))
            }
        }
    }), C.widget("ui.sortable", C.ui.mouse, {
        version: "1.12.1",
        widgetEventPrefix: "sort",
        ready: !1,
        options: {
            appendTo: "parent",
            axis: !1,
            connectWith: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            dropOnEmpty: !0,
            forcePlaceholderSize: !1,
            forceHelperSize: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            items: "> *",
            opacity: !1,
            placeholder: !1,
            revert: !1,
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            scope: "default",
            tolerance: "intersect",
            zIndex: 1e3,
            activate: null,
            beforeStop: null,
            change: null,
            deactivate: null,
            out: null,
            over: null,
            receive: null,
            remove: null,
            sort: null,
            start: null,
            stop: null,
            update: null
        },
        _isOverAxis: function(e, t, i) {
            return t <= e && e < t + i
        },
        _isFloating: function(e) {
            return /left|right/.test(e.css("float")) || /inline|table-cell/.test(e.css("display"))
        },
        _create: function() {
            this.containerCache = {}, this._addClass("ui-sortable"), this.refresh(), this.offset = this.element.offset(), this._mouseInit(), this._setHandleClassName(), this.ready = !0
        },
        _setOption: function(e, t) {
            this._super(e, t), "handle" === e && this._setHandleClassName()
        },
        _setHandleClassName: function() {
            var e = this;
            this._removeClass(this.element.find(".ui-sortable-handle"), "ui-sortable-handle"), C.each(this.items, function() {
                e._addClass(this.instance.options.handle ? this.item.find(this.instance.options.handle) : this.item, "ui-sortable-handle")
            })
        },
        _destroy: function() {
            this._mouseDestroy();
            for (var e = this.items.length - 1; 0 <= e; e--) this.items[e].item.removeData(this.widgetName + "-item");
            return this
        },
        _mouseCapture: function(e, t) {
            var i = null,
                n = !1,
                s = this;
            return !(this.reverting || this.options.disabled || "static" === this.options.type || (this._refreshItems(e), C(e.target).parents().each(function() {
                return C.data(this, s.widgetName + "-item") === s ? (i = C(this), !1) : void 0
            }), C.data(e.target, s.widgetName + "-item") === s && (i = C(e.target)), !i || this.options.handle && !t && (C(this.options.handle, i).find("*").addBack().each(function() {
                this === e.target && (n = !0)
            }), !n) || (this.currentItem = i, this._removeCurrentsFromItems(), 0)))
        },
        _mouseStart: function(e, t, i) {
            var n, s, o = this.options;
            if ((this.currentContainer = this).refreshPositions(), this.helper = this._createHelper(e), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
                    top: this.offset.top - this.margins.top,
                    left: this.offset.left - this.margins.left
                }, C.extend(this.offset, {
                    click: {
                        left: e.pageX - this.offset.left,
                        top: e.pageY - this.offset.top
                    },
                    parent: this._getParentOffset(),
                    relative: this._getRelativeOffset()
                }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(e), this.originalPageX = e.pageX, this.originalPageY = e.pageY, o.cursorAt && this._adjustOffsetFromHelper(o.cursorAt), this.domPosition = {
                    prev: this.currentItem.prev()[0],
                    parent: this.currentItem.parent()[0]
                }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), o.containment && this._setContainment(), o.cursor && "auto" !== o.cursor && (s = this.document.find("body"), this.storedCursor = s.css("cursor"), s.css("cursor", o.cursor), this.storedStylesheet = C("<style>*{ cursor: " + o.cursor + " !important; }</style>").appendTo(s)), o.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", o.opacity)), o.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", o.zIndex)), this.scrollParent[0] !== this.document[0] && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", e, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !i)
                for (n = this.containers.length - 1; 0 <= n; n--) this.containers[n]._trigger("activate", e, this._uiHash(this));
            return C.ui.ddmanager && (C.ui.ddmanager.current = this), C.ui.ddmanager && !o.dropBehaviour && C.ui.ddmanager.prepareOffsets(this, e), this.dragging = !0, this._addClass(this.helper, "ui-sortable-helper"), this._mouseDrag(e), !0
        },
        _mouseDrag: function(e) {
            var t, i, n, s, o = this.options,
                a = !1;
            for (this.position = this._generatePosition(e), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== this.document[0] && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - e.pageY < o.scrollSensitivity ? this.scrollParent[0].scrollTop = a = this.scrollParent[0].scrollTop + o.scrollSpeed : e.pageY - this.overflowOffset.top < o.scrollSensitivity && (this.scrollParent[0].scrollTop = a = this.scrollParent[0].scrollTop - o.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - e.pageX < o.scrollSensitivity ? this.scrollParent[0].scrollLeft = a = this.scrollParent[0].scrollLeft + o.scrollSpeed : e.pageX - this.overflowOffset.left < o.scrollSensitivity && (this.scrollParent[0].scrollLeft = a = this.scrollParent[0].scrollLeft - o.scrollSpeed)) : (e.pageY - this.document.scrollTop() < o.scrollSensitivity ? a = this.document.scrollTop(this.document.scrollTop() - o.scrollSpeed) : this.window.height() - (e.pageY - this.document.scrollTop()) < o.scrollSensitivity && (a = this.document.scrollTop(this.document.scrollTop() + o.scrollSpeed)), e.pageX - this.document.scrollLeft() < o.scrollSensitivity ? a = this.document.scrollLeft(this.document.scrollLeft() - o.scrollSpeed) : this.window.width() - (e.pageX - this.document.scrollLeft()) < o.scrollSensitivity && (a = this.document.scrollLeft(this.document.scrollLeft() + o.scrollSpeed))), !1 !== a && C.ui.ddmanager && !o.dropBehaviour && C.ui.ddmanager.prepareOffsets(this, e)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), t = this.items.length - 1; 0 <= t; t--)
                if (n = (i = this.items[t]).item[0], (s = this._intersectsWithPointer(i)) && i.instance === this.currentContainer && n !== this.currentItem[0] && this.placeholder[1 === s ? "next" : "prev"]()[0] !== n && !C.contains(this.placeholder[0], n) && ("semi-dynamic" !== this.options.type || !C.contains(this.element[0], n))) {
                    if (this.direction = 1 === s ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(i)) break;
                    this._rearrange(e, i), this._trigger("change", e, this._uiHash());
                    break
                }
            return this._contactContainers(e), C.ui.ddmanager && C.ui.ddmanager.drag(this, e), this._trigger("sort", e, this._uiHash()), this.lastPositionAbs = this.positionAbs, !1
        },
        _mouseStop: function(e, t) {
            if (e) {
                if (C.ui.ddmanager && !this.options.dropBehaviour && C.ui.ddmanager.drop(this, e), this.options.revert) {
                    var i = this,
                        n = this.placeholder.offset(),
                        s = this.options.axis,
                        o = {};
                    s && "x" !== s || (o.left = n.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === this.document[0].body ? 0 : this.offsetParent[0].scrollLeft)), s && "y" !== s || (o.top = n.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === this.document[0].body ? 0 : this.offsetParent[0].scrollTop)), this.reverting = !0, C(this.helper).animate(o, parseInt(this.options.revert, 10) || 500, function() {
                        i._clear(e)
                    })
                } else this._clear(e, t);
                return !1
            }
        },
        cancel: function() {
            if (this.dragging) {
                this._mouseUp(new C.Event("mouseup", {
                    target: null
                })), "original" === this.options.helper ? (this.currentItem.css(this._storedCSS), this._removeClass(this.currentItem, "ui-sortable-helper")) : this.currentItem.show();
                for (var e = this.containers.length - 1; 0 <= e; e--) this.containers[e]._trigger("deactivate", null, this._uiHash(this)), this.containers[e].containerCache.over && (this.containers[e]._trigger("out", null, this._uiHash(this)), this.containers[e].containerCache.over = 0)
            }
            return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), C.extend(this, {
                helper: null,
                dragging: !1,
                reverting: !1,
                _noFinalSort: null
            }), this.domPosition.prev ? C(this.domPosition.prev).after(this.currentItem) : C(this.domPosition.parent).prepend(this.currentItem)), this
        },
        serialize: function(t) {
            var e = this._getItemsAsjQuery(t && t.connected),
                i = [];
            return t = t || {}, C(e).each(function() {
                var e = (C(t.item || this).attr(t.attribute || "id") || "").match(t.expression || /(.+)[\-=_](.+)/);
                e && i.push((t.key || e[1] + "[]") + "=" + (t.key && t.expression ? e[1] : e[2]))
            }), !i.length && t.key && i.push(t.key + "="), i.join("&")
        },
        toArray: function(e) {
            var t = this._getItemsAsjQuery(e && e.connected),
                i = [];
            return e = e || {}, t.each(function() {
                i.push(C(e.item || this).attr(e.attribute || "id") || "")
            }), i
        },
        _intersectsWith: function(e) {
            var t = this.positionAbs.left,
                i = t + this.helperProportions.width,
                n = this.positionAbs.top,
                s = n + this.helperProportions.height,
                o = e.left,
                a = o + e.width,
                r = e.top,
                l = r + e.height,
                c = this.offset.click.top,
                h = this.offset.click.left,
                u = "x" === this.options.axis || r < n + c && n + c < l,
                d = "y" === this.options.axis || o < t + h && t + h < a,
                p = u && d;
            return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > e[this.floating ? "width" : "height"] ? p : t + this.helperProportions.width / 2 > o && a > i - this.helperProportions.width / 2 && n + this.helperProportions.height / 2 > r && l > s - this.helperProportions.height / 2
        },
        _intersectsWithPointer: function(e) {
            var t, i, n = "x" === this.options.axis || this._isOverAxis(this.positionAbs.top + this.offset.click.top, e.top, e.height),
                s = "y" === this.options.axis || this._isOverAxis(this.positionAbs.left + this.offset.click.left, e.left, e.width);
            return !(!n || !s) && (t = this._getDragVerticalDirection(), i = this._getDragHorizontalDirection(), this.floating ? "right" === i || "down" === t ? 2 : 1 : t && ("down" === t ? 2 : 1))
        },
        _intersectsWithSides: function(e) {
            var t = this._isOverAxis(this.positionAbs.top + this.offset.click.top, e.top + e.height / 2, e.height),
                i = this._isOverAxis(this.positionAbs.left + this.offset.click.left, e.left + e.width / 2, e.width),
                n = this._getDragVerticalDirection(),
                s = this._getDragHorizontalDirection();
            return this.floating && s ? "right" === s && i || "left" === s && !i : n && ("down" === n && t || "up" === n && !t)
        },
        _getDragVerticalDirection: function() {
            var e = this.positionAbs.top - this.lastPositionAbs.top;
            return 0 != e && (0 < e ? "down" : "up")
        },
        _getDragHorizontalDirection: function() {
            var e = this.positionAbs.left - this.lastPositionAbs.left;
            return 0 != e && (0 < e ? "right" : "left")
        },
        refresh: function(e) {
            return this._refreshItems(e), this._setHandleClassName(), this.refreshPositions(), this
        },
        _connectWith: function() {
            var e = this.options;
            return e.connectWith.constructor === String ? [e.connectWith] : e.connectWith
        },
        _getItemsAsjQuery: function(e) {
            function t() {
                a.push(this)
            }
            var i, n, s, o, a = [],
                r = [],
                l = this._connectWith();
            if (l && e)
                for (i = l.length - 1; 0 <= i; i--)
                    for (n = (s = C(l[i], this.document[0])).length - 1; 0 <= n; n--)(o = C.data(s[n], this.widgetFullName)) && o !== this && !o.options.disabled && r.push([C.isFunction(o.options.items) ? o.options.items.call(o.element) : C(o.options.items, o.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), o]);
            for (r.push([C.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
                    options: this.options,
                    item: this.currentItem
                }) : C(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), i = r.length - 1; 0 <= i; i--) r[i][0].each(t);
            return C(a)
        },
        _removeCurrentsFromItems: function() {
            var i = this.currentItem.find(":data(" + this.widgetName + "-item)");
            this.items = C.grep(this.items, function(e) {
                for (var t = 0; i.length > t; t++)
                    if (i[t] === e.item[0]) return !1;
                return !0
            })
        },
        _refreshItems: function(e) {
            this.items = [], this.containers = [this];
            var t, i, n, s, o, a, r, l, c = this.items,
                h = [
                    [C.isFunction(this.options.items) ? this.options.items.call(this.element[0], e, {
                        item: this.currentItem
                    }) : C(this.options.items, this.element), this]
                ],
                u = this._connectWith();
            if (u && this.ready)
                for (t = u.length - 1; 0 <= t; t--)
                    for (i = (n = C(u[t], this.document[0])).length - 1; 0 <= i; i--)(s = C.data(n[i], this.widgetFullName)) && s !== this && !s.options.disabled && (h.push([C.isFunction(s.options.items) ? s.options.items.call(s.element[0], e, {
                        item: this.currentItem
                    }) : C(s.options.items, s.element), s]), this.containers.push(s));
            for (t = h.length - 1; 0 <= t; t--)
                for (o = h[t][1], i = 0, l = (a = h[t][0]).length; i < l; i++)(r = C(a[i])).data(this.widgetName + "-item", o), c.push({
                    item: r,
                    instance: o,
                    width: 0,
                    height: 0,
                    left: 0,
                    top: 0
                })
        },
        refreshPositions: function(e) {
            var t, i, n, s;
            for (this.floating = !!this.items.length && ("x" === this.options.axis || this._isFloating(this.items[0].item)), this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset()), t = this.items.length - 1; 0 <= t; t--)(i = this.items[t]).instance !== this.currentContainer && this.currentContainer && i.item[0] !== this.currentItem[0] || (n = this.options.toleranceElement ? C(this.options.toleranceElement, i.item) : i.item, e || (i.width = n.outerWidth(), i.height = n.outerHeight()), s = n.offset(), i.left = s.left, i.top = s.top);
            if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this);
            else
                for (t = this.containers.length - 1; 0 <= t; t--) s = this.containers[t].element.offset(), this.containers[t].containerCache.left = s.left, this.containers[t].containerCache.top = s.top, this.containers[t].containerCache.width = this.containers[t].element.outerWidth(), this.containers[t].containerCache.height = this.containers[t].element.outerHeight();
            return this
        },
        _createPlaceholder: function(i) {
            var n, s = (i = i || this).options;
            s.placeholder && s.placeholder.constructor !== String || (n = s.placeholder, s.placeholder = {
                element: function() {
                    var e = i.currentItem[0].nodeName.toLowerCase(),
                        t = C("<" + e + ">", i.document[0]);
                    return i._addClass(t, "ui-sortable-placeholder", n || i.currentItem[0].className)._removeClass(t, "ui-sortable-helper"), "tbody" === e ? i._createTrPlaceholder(i.currentItem.find("tr").eq(0), C("<tr>", i.document[0]).appendTo(t)) : "tr" === e ? i._createTrPlaceholder(i.currentItem, t) : "img" === e && t.attr("src", i.currentItem.attr("src")), n || t.css("visibility", "hidden"), t
                },
                update: function(e, t) {
                    n && !s.forcePlaceholderSize || (t.height() || t.height(i.currentItem.innerHeight() - parseInt(i.currentItem.css("paddingTop") || 0, 10) - parseInt(i.currentItem.css("paddingBottom") || 0, 10)), t.width() || t.width(i.currentItem.innerWidth() - parseInt(i.currentItem.css("paddingLeft") || 0, 10) - parseInt(i.currentItem.css("paddingRight") || 0, 10)))
                }
            }), i.placeholder = C(s.placeholder.element.call(i.element, i.currentItem)), i.currentItem.after(i.placeholder), s.placeholder.update(i, i.placeholder)
        },
        _createTrPlaceholder: function(e, t) {
            var i = this;
            e.children().each(function() {
                C("<td>&#160;</td>", i.document[0]).attr("colspan", C(this).attr("colspan") || 1).appendTo(t)
            })
        },
        _contactContainers: function(e) {
            var t, i, n, s, o, a, r, l, c, h, u = null,
                d = null;
            for (t = this.containers.length - 1; 0 <= t; t--)
                if (!C.contains(this.currentItem[0], this.containers[t].element[0]))
                    if (this._intersectsWith(this.containers[t].containerCache)) {
                        if (u && C.contains(this.containers[t].element[0], u.element[0])) continue;
                        u = this.containers[t], d = t
                    } else this.containers[t].containerCache.over && (this.containers[t]._trigger("out", e, this._uiHash(this)), this.containers[t].containerCache.over = 0);
            if (u)
                if (1 === this.containers.length) this.containers[d].containerCache.over || (this.containers[d]._trigger("over", e, this._uiHash(this)), this.containers[d].containerCache.over = 1);
                else {
                    for (n = 1e4, s = null, o = (c = u.floating || this._isFloating(this.currentItem)) ? "left" : "top", a = c ? "width" : "height", h = c ? "pageX" : "pageY", i = this.items.length - 1; 0 <= i; i--) C.contains(this.containers[d].element[0], this.items[i].item[0]) && this.items[i].item[0] !== this.currentItem[0] && (r = this.items[i].item.offset()[o], l = !1, e[h] - r > this.items[i][a] / 2 && (l = !0), n > Math.abs(e[h] - r) && (n = Math.abs(e[h] - r), s = this.items[i], this.direction = l ? "up" : "down"));
                    if (!s && !this.options.dropOnEmpty) return;
                    if (this.currentContainer === this.containers[d]) return void(this.currentContainer.containerCache.over || (this.containers[d]._trigger("over", e, this._uiHash()), this.currentContainer.containerCache.over = 1));
                    s ? this._rearrange(e, s, null, !0) : this._rearrange(e, null, this.containers[d].element, !0), this._trigger("change", e, this._uiHash()), this.containers[d]._trigger("change", e, this._uiHash(this)), this.currentContainer = this.containers[d], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[d]._trigger("over", e, this._uiHash(this)), this.containers[d].containerCache.over = 1
                }
        },
        _createHelper: function(e) {
            var t = this.options,
                i = C.isFunction(t.helper) ? C(t.helper.apply(this.element[0], [e, this.currentItem])) : "clone" === t.helper ? this.currentItem.clone() : this.currentItem;
            return i.parents("body").length || C("parent" !== t.appendTo ? t.appendTo : this.currentItem[0].parentNode)[0].appendChild(i[0]), i[0] === this.currentItem[0] && (this._storedCSS = {
                width: this.currentItem[0].style.width,
                height: this.currentItem[0].style.height,
                position: this.currentItem.css("position"),
                top: this.currentItem.css("top"),
                left: this.currentItem.css("left")
            }), i[0].style.width && !t.forceHelperSize || i.width(this.currentItem.width()), i[0].style.height && !t.forceHelperSize || i.height(this.currentItem.height()), i
        },
        _adjustOffsetFromHelper: function(e) {
            "string" == typeof e && (e = e.split(" ")), C.isArray(e) && (e = {
                left: +e[0],
                top: +e[1] || 0
            }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
        },
        _getParentOffset: function() {
            this.offsetParent = this.helper.offsetParent();
            var e = this.offsetParent.offset();
            return "absolute" === this.cssPosition && this.scrollParent[0] !== this.document[0] && C.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === this.document[0].body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && C.ui.ie) && (e = {
                top: 0,
                left: 0
            }), {
                top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function() {
            if ("relative" !== this.cssPosition) return {
                top: 0,
                left: 0
            };
            var e = this.currentItem.position();
            return {
                top: e.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                left: e.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
            }
        },
        _cacheMargins: function() {
            this.margins = {
                left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
                top: parseInt(this.currentItem.css("marginTop"), 10) || 0
            }
        },
        _cacheHelperProportions: function() {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            }
        },
        _setContainment: function() {
            var e, t, i, n = this.options;
            "parent" === n.containment && (n.containment = this.helper[0].parentNode), "document" !== n.containment && "window" !== n.containment || (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, "document" === n.containment ? this.document.width() : this.window.width() - this.helperProportions.width - this.margins.left, ("document" === n.containment ? this.document.height() || document.body.parentNode.scrollHeight : this.window.height() || this.document[0].body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(n.containment) || (e = C(n.containment)[0], t = C(n.containment).offset(), i = "hidden" !== C(e).css("overflow"), this.containment = [t.left + (parseInt(C(e).css("borderLeftWidth"), 10) || 0) + (parseInt(C(e).css("paddingLeft"), 10) || 0) - this.margins.left, t.top + (parseInt(C(e).css("borderTopWidth"), 10) || 0) + (parseInt(C(e).css("paddingTop"), 10) || 0) - this.margins.top, t.left + (i ? Math.max(e.scrollWidth, e.offsetWidth) : e.offsetWidth) - (parseInt(C(e).css("borderLeftWidth"), 10) || 0) - (parseInt(C(e).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, t.top + (i ? Math.max(e.scrollHeight, e.offsetHeight) : e.offsetHeight) - (parseInt(C(e).css("borderTopWidth"), 10) || 0) - (parseInt(C(e).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top])
        },
        _convertPositionTo: function(e, t) {
            t = t || this.position;
            var i = "absolute" === e ? 1 : -1,
                n = "absolute" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && C.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                s = /(html|body)/i.test(n[0].tagName);
            return {
                top: t.top + this.offset.relative.top * i + this.offset.parent.top * i - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : s ? 0 : n.scrollTop()) * i,
                left: t.left + this.offset.relative.left * i + this.offset.parent.left * i - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : s ? 0 : n.scrollLeft()) * i
            }
        },
        _generatePosition: function(e) {
            var t, i, n = this.options,
                s = e.pageX,
                o = e.pageY,
                a = "absolute" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && C.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                r = /(html|body)/i.test(a[0].tagName);
            return "relative" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), this.originalPosition && (this.containment && (e.pageX - this.offset.click.left < this.containment[0] && (s = this.containment[0] + this.offset.click.left), e.pageY - this.offset.click.top < this.containment[1] && (o = this.containment[1] + this.offset.click.top), e.pageX - this.offset.click.left > this.containment[2] && (s = this.containment[2] + this.offset.click.left), e.pageY - this.offset.click.top > this.containment[3] && (o = this.containment[3] + this.offset.click.top)), n.grid && (t = this.originalPageY + Math.round((o - this.originalPageY) / n.grid[1]) * n.grid[1], o = this.containment ? t - this.offset.click.top >= this.containment[1] && t - this.offset.click.top <= this.containment[3] ? t : t - this.offset.click.top >= this.containment[1] ? t - n.grid[1] : t + n.grid[1] : t, i = this.originalPageX + Math.round((s - this.originalPageX) / n.grid[0]) * n.grid[0], s = this.containment ? i - this.offset.click.left >= this.containment[0] && i - this.offset.click.left <= this.containment[2] ? i : i - this.offset.click.left >= this.containment[0] ? i - n.grid[0] : i + n.grid[0] : i)), {
                top: o - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : r ? 0 : a.scrollTop()),
                left: s - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : r ? 0 : a.scrollLeft())
            }
        },
        _rearrange: function(e, t, i, n) {
            i ? i[0].appendChild(this.placeholder[0]) : t.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? t.item[0] : t.item[0].nextSibling), this.counter = this.counter ? ++this.counter : 1;
            var s = this.counter;
            this._delay(function() {
                s === this.counter && this.refreshPositions(!n)
            })
        },
        _clear: function(e, t) {
            function i(t, i, n) {
                return function(e) {
                    n._trigger(t, e, i._uiHash(i))
                }
            }
            this.reverting = !1;
            var n, s = [];
            if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
                for (n in this._storedCSS) "auto" !== this._storedCSS[n] && "static" !== this._storedCSS[n] || (this._storedCSS[n] = "");
                this.currentItem.css(this._storedCSS), this._removeClass(this.currentItem, "ui-sortable-helper")
            } else this.currentItem.show();
            for (this.fromOutside && !t && s.push(function(e) {
                    this._trigger("receive", e, this._uiHash(this.fromOutside))
                }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || t || s.push(function(e) {
                    this._trigger("update", e, this._uiHash())
                }), this !== this.currentContainer && (t || (s.push(function(e) {
                    this._trigger("remove", e, this._uiHash())
                }), s.push(function(t) {
                    return function(e) {
                        t._trigger("receive", e, this._uiHash(this))
                    }
                }.call(this, this.currentContainer)), s.push(function(t) {
                    return function(e) {
                        t._trigger("update", e, this._uiHash(this))
                    }
                }.call(this, this.currentContainer)))), n = this.containers.length - 1; 0 <= n; n--) t || s.push(i("deactivate", this, this.containers[n])), this.containers[n].containerCache.over && (s.push(i("out", this, this.containers[n])), this.containers[n].containerCache.over = 0);
            if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), this.dragging = !1, t || this._trigger("beforeStop", e, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.cancelHelperRemoval || (this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null), !t) {
                for (n = 0; s.length > n; n++) s[n].call(this, e);
                this._trigger("stop", e, this._uiHash())
            }
            return this.fromOutside = !1, !this.cancelHelperRemoval
        },
        _trigger: function() {
            !1 === C.Widget.prototype._trigger.apply(this, arguments) && this.cancel()
        },
        _uiHash: function(e) {
            var t = e || this;
            return {
                helper: t.helper,
                placeholder: t.placeholder || C([]),
                position: t.position,
                originalPosition: t.originalPosition,
                offset: t.positionAbs,
                item: t.currentItem,
                sender: e ? e.element : null
            }
        }
    }), C.widget("ui.spinner", {
        version: "1.12.1",
        defaultElement: "<input>",
        widgetEventPrefix: "spin",
        options: {
            classes: {
                "ui-spinner": "ui-corner-all",
                "ui-spinner-down": "ui-corner-br",
                "ui-spinner-up": "ui-corner-tr"
            },
            culture: null,
            icons: {
                down: "ui-icon-triangle-1-s",
                up: "ui-icon-triangle-1-n"
            },
            incremental: !0,
            max: null,
            min: null,
            numberFormat: null,
            page: 10,
            step: 1,
            change: null,
            spin: null,
            start: null,
            stop: null
        },
        _create: function() {
            this._setOption("max", this.options.max), this._setOption("min", this.options.min), this._setOption("step", this.options.step), "" !== this.value() && this._value(this.element.val(), !0), this._draw(), this._on(this._events), this._refresh(), this._on(this.window, {
                beforeunload: function() {
                    this.element.removeAttr("autocomplete")
                }
            })
        },
        _getCreateOptions: function() {
            var n = this._super(),
                s = this.element;
            return C.each(["min", "max", "step"], function(e, t) {
                var i = s.attr(t);
                null != i && i.length && (n[t] = i)
            }), n
        },
        _events: {
            keydown: function(e) {
                this._start(e) && this._keydown(e) && e.preventDefault()
            },
            keyup: "_stop",
            focus: function() {
                this.previous = this.element.val()
            },
            blur: function(e) {
                return this.cancelBlur ? void delete this.cancelBlur : (this._stop(), this._refresh(), void(this.previous !== this.element.val() && this._trigger("change", e)))
            },
            mousewheel: function(e, t) {
                if (t) {
                    if (!this.spinning && !this._start(e)) return !1;
                    this._spin((0 < t ? 1 : -1) * this.options.step, e), clearTimeout(this.mousewheelTimer), this.mousewheelTimer = this._delay(function() {
                        this.spinning && this._stop(e)
                    }, 100), e.preventDefault()
                }
            },
            "mousedown .ui-spinner-button": function(e) {
                function t() {
                    this.element[0] === C.ui.safeActiveElement(this.document[0]) || (this.element.trigger("focus"), this.previous = i, this._delay(function() {
                        this.previous = i
                    }))
                }
                var i;
                i = this.element[0] === C.ui.safeActiveElement(this.document[0]) ? this.previous : this.element.val(), e.preventDefault(), t.call(this), this.cancelBlur = !0, this._delay(function() {
                    delete this.cancelBlur, t.call(this)
                }), !1 !== this._start(e) && this._repeat(null, C(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e)
            },
            "mouseup .ui-spinner-button": "_stop",
            "mouseenter .ui-spinner-button": function(e) {
                return C(e.currentTarget).hasClass("ui-state-active") ? !1 !== this._start(e) && void this._repeat(null, C(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e) : void 0
            },
            "mouseleave .ui-spinner-button": "_stop"
        },
        _enhance: function() {
            this.uiSpinner = this.element.attr("autocomplete", "off").wrap("<span>").parent().append("<a></a><a></a>")
        },
        _draw: function() {
            this._enhance(), this._addClass(this.uiSpinner, "ui-spinner", "ui-widget ui-widget-content"), this._addClass("ui-spinner-input"), this.element.attr("role", "spinbutton"), this.buttons = this.uiSpinner.children("a").attr("tabIndex", -1).attr("aria-hidden", !0).button({
                classes: {
                    "ui-button": ""
                }
            }), this._removeClass(this.buttons, "ui-corner-all"), this._addClass(this.buttons.first(), "ui-spinner-button ui-spinner-up"), this._addClass(this.buttons.last(), "ui-spinner-button ui-spinner-down"), this.buttons.first().button({
                icon: this.options.icons.up,
                showLabel: !1
            }), this.buttons.last().button({
                icon: this.options.icons.down,
                showLabel: !1
            }), this.buttons.height() > Math.ceil(.5 * this.uiSpinner.height()) && 0 < this.uiSpinner.height() && this.uiSpinner.height(this.uiSpinner.height())
        },
        _keydown: function(e) {
            var t = this.options,
                i = C.ui.keyCode;
            switch (e.keyCode) {
                case i.UP:
                    return this._repeat(null, 1, e), !0;
                case i.DOWN:
                    return this._repeat(null, -1, e), !0;
                case i.PAGE_UP:
                    return this._repeat(null, t.page, e), !0;
                case i.PAGE_DOWN:
                    return this._repeat(null, -t.page, e), !0
            }
            return !1
        },
        _start: function(e) {
            return !(!this.spinning && !1 === this._trigger("start", e)) && (this.counter || (this.counter = 1), this.spinning = !0)
        },
        _repeat: function(e, t, i) {
            e = e || 500, clearTimeout(this.timer), this.timer = this._delay(function() {
                this._repeat(40, t, i)
            }, e), this._spin(t * this.options.step, i)
        },
        _spin: function(e, t) {
            var i = this.value() || 0;
            this.counter || (this.counter = 1), i = this._adjustValue(i + e * this._increment(this.counter)), this.spinning && !1 === this._trigger("spin", t, {
                value: i
            }) || (this._value(i), this.counter++)
        },
        _increment: function(e) {
            var t = this.options.incremental;
            return t ? C.isFunction(t) ? t(e) : Math.floor(e * e * e / 5e4 - e * e / 500 + 17 * e / 200 + 1) : 1
        },
        _precision: function() {
            var e = this._precisionOf(this.options.step);
            return null !== this.options.min && (e = Math.max(e, this._precisionOf(this.options.min))), e
        },
        _precisionOf: function(e) {
            var t = "" + e,
                i = t.indexOf(".");
            return -1 === i ? 0 : t.length - i - 1
        },
        _adjustValue: function(e) {
            var t, i, n = this.options;
            return i = e - (t = null !== n.min ? n.min : 0), e = t + (i = Math.round(i / n.step) * n.step), e = parseFloat(e.toFixed(this._precision())), null !== n.max && e > n.max ? n.max : null !== n.min && n.min > e ? n.min : e
        },
        _stop: function(e) {
            this.spinning && (clearTimeout(this.timer), clearTimeout(this.mousewheelTimer), this.counter = 0, this.spinning = !1, this._trigger("stop", e))
        },
        _setOption: function(e, t) {
            var i, n, s;
            return "culture" === e || "numberFormat" === e ? (i = this._parse(this.element.val()), this.options[e] = t, void this.element.val(this._format(i))) : ("max" !== e && "min" !== e && "step" !== e || "string" != typeof t || (t = this._parse(t)), "icons" === e && (n = this.buttons.first().find(".ui-icon"), this._removeClass(n, null, this.options.icons.up), this._addClass(n, null, t.up), s = this.buttons.last().find(".ui-icon"), this._removeClass(s, null, this.options.icons.down), this._addClass(s, null, t.down)), void this._super(e, t))
        },
        _setOptionDisabled: function(e) {
            this._super(e), this._toggleClass(this.uiSpinner, null, "ui-state-disabled", !!e), this.element.prop("disabled", !!e), this.buttons.button(e ? "disable" : "enable")
        },
        _setOptions: t(function(e) {
            this._super(e)
        }),
        _parse: function(e) {
            return "string" == typeof e && "" !== e && (e = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(e, 10, this.options.culture) : +e), "" === e || isNaN(e) ? null : e
        },
        _format: function(e) {
            return "" === e ? "" : window.Globalize && this.options.numberFormat ? Globalize.format(e, this.options.numberFormat, this.options.culture) : e
        },
        _refresh: function() {
            this.element.attr({
                "aria-valuemin": this.options.min,
                "aria-valuemax": this.options.max,
                "aria-valuenow": this._parse(this.element.val())
            })
        },
        isValid: function() {
            var e = this.value();
            return null !== e && e === this._adjustValue(e)
        },
        _value: function(e, t) {
            var i;
            "" === e || null !== (i = this._parse(e)) && (t || (i = this._adjustValue(i)), e = this._format(i)), this.element.val(e), this._refresh()
        },
        _destroy: function() {
            this.element.prop("disabled", !1).removeAttr("autocomplete role aria-valuemin aria-valuemax aria-valuenow"), this.uiSpinner.replaceWith(this.element)
        },
        stepUp: t(function(e) {
            this._stepUp(e)
        }),
        _stepUp: function(e) {
            this._start() && (this._spin((e || 1) * this.options.step), this._stop())
        },
        stepDown: t(function(e) {
            this._stepDown(e)
        }),
        _stepDown: function(e) {
            this._start() && (this._spin((e || 1) * -this.options.step), this._stop())
        },
        pageUp: t(function(e) {
            this._stepUp((e || 1) * this.options.page)
        }),
        pageDown: t(function(e) {
            this._stepDown((e || 1) * this.options.page)
        }),
        value: function(e) {
            return arguments.length ? void t(this._value).call(this, e) : this._parse(this.element.val())
        },
        widget: function() {
            return this.uiSpinner
        }
    }), !1 !== C.uiBackCompat && C.widget("ui.spinner", C.ui.spinner, {
        _enhance: function() {
            this.uiSpinner = this.element.attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml())
        },
        _uiSpinnerHtml: function() {
            return "<span>"
        },
        _buttonHtml: function() {
            return "<a></a><a></a>"
        }
    }), C.ui.spinner, C.widget("ui.tabs", {
        version: "1.12.1",
        delay: 300,
        options: {
            active: null,
            classes: {
                "ui-tabs": "ui-corner-all",
                "ui-tabs-nav": "ui-corner-all",
                "ui-tabs-panel": "ui-corner-bottom",
                "ui-tabs-tab": "ui-corner-top"
            },
            collapsible: !1,
            event: "click",
            heightStyle: "content",
            hide: null,
            show: null,
            activate: null,
            beforeActivate: null,
            beforeLoad: null,
            load: null
        },
        _isLocal: (oe = /#.*$/, function(e) {
            var t, i;
            t = e.href.replace(oe, ""), i = location.href.replace(oe, "");
            try {
                t = decodeURIComponent(t)
            } catch (e) {}
            try {
                i = decodeURIComponent(i)
            } catch (e) {}
            return 1 < e.hash.length && t === i
        }),
        _create: function() {
            var t = this,
                e = this.options;
            this.running = !1, this._addClass("ui-tabs", "ui-widget ui-widget-content"), this._toggleClass("ui-tabs-collapsible", null, e.collapsible), this._processTabs(), e.active = this._initialActive(), C.isArray(e.disabled) && (e.disabled = C.unique(e.disabled.concat(C.map(this.tabs.filter(".ui-state-disabled"), function(e) {
                return t.tabs.index(e)
            }))).sort()), this.active = !1 !== this.options.active && this.anchors.length ? this._findActive(e.active) : C(), this._refresh(), this.active.length && this.load(e.active)
        },
        _initialActive: function() {
            var i = this.options.active,
                e = this.options.collapsible,
                n = location.hash.substring(1);
            return null === i && (n && this.tabs.each(function(e, t) {
                return C(t).attr("aria-controls") === n ? (i = e, !1) : void 0
            }), null === i && (i = this.tabs.index(this.tabs.filter(".ui-tabs-active"))), null !== i && -1 !== i || (i = !!this.tabs.length && 0)), !1 !== i && -1 === (i = this.tabs.index(this.tabs.eq(i))) && (i = !e && 0), !e && !1 === i && this.anchors.length && (i = 0), i
        },
        _getCreateEventData: function() {
            return {
                tab: this.active,
                panel: this.active.length ? this._getPanelForTab(this.active) : C()
            }
        },
        _tabKeydown: function(e) {
            var t = C(C.ui.safeActiveElement(this.document[0])).closest("li"),
                i = this.tabs.index(t),
                n = !0;
            if (!this._handlePageNav(e)) {
                switch (e.keyCode) {
                    case C.ui.keyCode.RIGHT:
                    case C.ui.keyCode.DOWN:
                        i++;
                        break;
                    case C.ui.keyCode.UP:
                    case C.ui.keyCode.LEFT:
                        n = !1, i--;
                        break;
                    case C.ui.keyCode.END:
                        i = this.anchors.length - 1;
                        break;
                    case C.ui.keyCode.HOME:
                        i = 0;
                        break;
                    case C.ui.keyCode.SPACE:
                        return e.preventDefault(), clearTimeout(this.activating), void this._activate(i);
                    case C.ui.keyCode.ENTER:
                        return e.preventDefault(), clearTimeout(this.activating), void this._activate(i !== this.options.active && i);
                    default:
                        return
                }
                e.preventDefault(), clearTimeout(this.activating), i = this._focusNextTab(i, n), e.ctrlKey || e.metaKey || (t.attr("aria-selected", "false"), this.tabs.eq(i).attr("aria-selected", "true"), this.activating = this._delay(function() {
                    this.option("active", i)
                }, this.delay))
            }
        },
        _panelKeydown: function(e) {
            this._handlePageNav(e) || e.ctrlKey && e.keyCode === C.ui.keyCode.UP && (e.preventDefault(), this.active.trigger("focus"))
        },
        _handlePageNav: function(e) {
            return e.altKey && e.keyCode === C.ui.keyCode.PAGE_UP ? (this._activate(this._focusNextTab(this.options.active - 1, !1)), !0) : e.altKey && e.keyCode === C.ui.keyCode.PAGE_DOWN ? (this._activate(this._focusNextTab(this.options.active + 1, !0)), !0) : void 0
        },
        _findNextTab: function(e, t) {
            for (var i = this.tabs.length - 1; - 1 !== C.inArray((i < e && (e = 0), e < 0 && (e = i), e), this.options.disabled);) e = t ? e + 1 : e - 1;
            return e
        },
        _focusNextTab: function(e, t) {
            return e = this._findNextTab(e, t), this.tabs.eq(e).trigger("focus"), e
        },
        _setOption: function(e, t) {
            return "active" === e ? void this._activate(t) : (this._super(e, t), "collapsible" === e && (this._toggleClass("ui-tabs-collapsible", null, t), t || !1 !== this.options.active || this._activate(0)), "event" === e && this._setupEvents(t), void("heightStyle" === e && this._setupHeightStyle(t)))
        },
        _sanitizeSelector: function(e) {
            return e ? e.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g, "\\$&") : ""
        },
        refresh: function() {
            var e = this.options,
                t = this.tablist.children(":has(a[href])");
            e.disabled = C.map(t.filter(".ui-state-disabled"), function(e) {
                return t.index(e)
            }), this._processTabs(), !1 !== e.active && this.anchors.length ? this.active.length && !C.contains(this.tablist[0], this.active[0]) ? this.tabs.length === e.disabled.length ? (e.active = !1, this.active = C()) : this._activate(this._findNextTab(Math.max(0, e.active - 1), !1)) : e.active = this.tabs.index(this.active) : (e.active = !1, this.active = C()), this._refresh()
        },
        _refresh: function() {
            this._setOptionDisabled(this.options.disabled), this._setupEvents(this.options.event), this._setupHeightStyle(this.options.heightStyle), this.tabs.not(this.active).attr({
                "aria-selected": "false",
                "aria-expanded": "false",
                tabIndex: -1
            }), this.panels.not(this._getPanelForTab(this.active)).hide().attr({
                "aria-hidden": "true"
            }), this.active.length ? (this.active.attr({
                "aria-selected": "true",
                "aria-expanded": "true",
                tabIndex: 0
            }), this._addClass(this.active, "ui-tabs-active", "ui-state-active"), this._getPanelForTab(this.active).show().attr({
                "aria-hidden": "false"
            })) : this.tabs.eq(0).attr("tabIndex", 0)
        },
        _processTabs: function() {
            var l = this,
                e = this.tabs,
                t = this.anchors,
                i = this.panels;
            this.tablist = this._getList().attr("role", "tablist"), this._addClass(this.tablist, "ui-tabs-nav", "ui-helper-reset ui-helper-clearfix ui-widget-header"), this.tablist.on("mousedown" + this.eventNamespace, "> li", function(e) {
                C(this).is(".ui-state-disabled") && e.preventDefault()
            }).on("focus" + this.eventNamespace, ".ui-tabs-anchor", function() {
                C(this).closest("li").is(".ui-state-disabled") && this.blur()
            }), this.tabs = this.tablist.find("> li:has(a[href])").attr({
                role: "tab",
                tabIndex: -1
            }), this._addClass(this.tabs, "ui-tabs-tab", "ui-state-default"), this.anchors = this.tabs.map(function() {
                return C("a", this)[0]
            }).attr({
                role: "presentation",
                tabIndex: -1
            }), this._addClass(this.anchors, "ui-tabs-anchor"), this.panels = C(), this.anchors.each(function(e, t) {
                var i, n, s, o = C(t).uniqueId().attr("id"),
                    a = C(t).closest("li"),
                    r = a.attr("aria-controls");
                l._isLocal(t) ? (s = (i = t.hash).substring(1), n = l.element.find(l._sanitizeSelector(i))) : (i = "#" + (s = a.attr("aria-controls") || C({}).uniqueId()[0].id), (n = l.element.find(i)).length || (n = l._createPanel(s)).insertAfter(l.panels[e - 1] || l.tablist), n.attr("aria-live", "polite")), n.length && (l.panels = l.panels.add(n)), r && a.data("ui-tabs-aria-controls", r), a.attr({
                    "aria-controls": s,
                    "aria-labelledby": o
                }), n.attr("aria-labelledby", o)
            }), this.panels.attr("role", "tabpanel"), this._addClass(this.panels, "ui-tabs-panel", "ui-widget-content"), e && (this._off(e.not(this.tabs)), this._off(t.not(this.anchors)), this._off(i.not(this.panels)))
        },
        _getList: function() {
            return this.tablist || this.element.find("ol, ul").eq(0)
        },
        _createPanel: function(e) {
            return C("<div>").attr("id", e).data("ui-tabs-destroy", !0)
        },
        _setOptionDisabled: function(e) {
            var t, i, n;
            for (C.isArray(e) && (e.length ? e.length === this.anchors.length && (e = !0) : e = !1), n = 0; i = this.tabs[n]; n++) t = C(i), !0 === e || -1 !== C.inArray(n, e) ? (t.attr("aria-disabled", "true"), this._addClass(t, null, "ui-state-disabled")) : (t.removeAttr("aria-disabled"), this._removeClass(t, null, "ui-state-disabled"));
            this.options.disabled = e, this._toggleClass(this.widget(), this.widgetFullName + "-disabled", null, !0 === e)
        },
        _setupEvents: function(e) {
            var i = {};
            e && C.each(e.split(" "), function(e, t) {
                i[t] = "_eventHandler"
            }), this._off(this.anchors.add(this.tabs).add(this.panels)), this._on(!0, this.anchors, {
                click: function(e) {
                    e.preventDefault()
                }
            }), this._on(this.anchors, i), this._on(this.tabs, {
                keydown: "_tabKeydown"
            }), this._on(this.panels, {
                keydown: "_panelKeydown"
            }), this._focusable(this.tabs), this._hoverable(this.tabs)
        },
        _setupHeightStyle: function(e) {
            var i, t = this.element.parent();
            "fill" === e ? (i = t.height(), i -= this.element.outerHeight() - this.element.height(), this.element.siblings(":visible").each(function() {
                var e = C(this),
                    t = e.css("position");
                "absolute" !== t && "fixed" !== t && (i -= e.outerHeight(!0))
            }), this.element.children().not(this.panels).each(function() {
                i -= C(this).outerHeight(!0)
            }), this.panels.each(function() {
                C(this).height(Math.max(0, i - C(this).innerHeight() + C(this).height()))
            }).css("overflow", "auto")) : "auto" === e && (i = 0, this.panels.each(function() {
                i = Math.max(i, C(this).height("").height())
            }).height(i))
        },
        _eventHandler: function(e) {
            var t = this.options,
                i = this.active,
                n = C(e.currentTarget).closest("li"),
                s = n[0] === i[0],
                o = s && t.collapsible,
                a = o ? C() : this._getPanelForTab(n),
                r = i.length ? this._getPanelForTab(i) : C(),
                l = {
                    oldTab: i,
                    oldPanel: r,
                    newTab: o ? C() : n,
                    newPanel: a
                };
            e.preventDefault(), n.hasClass("ui-state-disabled") || n.hasClass("ui-tabs-loading") || this.running || s && !t.collapsible || !1 === this._trigger("beforeActivate", e, l) || (t.active = !o && this.tabs.index(n), this.active = s ? C() : n, this.xhr && this.xhr.abort(), r.length || a.length || C.error("jQuery UI Tabs: Mismatching fragment identifier."), a.length && this.load(this.tabs.index(n), e), this._toggle(e, l))
        },
        _toggle: function(e, t) {
            function i() {
                s.running = !1, s._trigger("activate", e, t)
            }

            function n() {
                s._addClass(t.newTab.closest("li"), "ui-tabs-active", "ui-state-active"), o.length && s.options.show ? s._show(o, s.options.show, i) : (o.show(), i())
            }
            var s = this,
                o = t.newPanel,
                a = t.oldPanel;
            this.running = !0, a.length && this.options.hide ? this._hide(a, this.options.hide, function() {
                s._removeClass(t.oldTab.closest("li"), "ui-tabs-active", "ui-state-active"), n()
            }) : (this._removeClass(t.oldTab.closest("li"), "ui-tabs-active", "ui-state-active"), a.hide(), n()), a.attr("aria-hidden", "true"), t.oldTab.attr({
                "aria-selected": "false",
                "aria-expanded": "false"
            }), o.length && a.length ? t.oldTab.attr("tabIndex", -1) : o.length && this.tabs.filter(function() {
                return 0 === C(this).attr("tabIndex")
            }).attr("tabIndex", -1), o.attr("aria-hidden", "false"), t.newTab.attr({
                "aria-selected": "true",
                "aria-expanded": "true",
                tabIndex: 0
            })
        },
        _activate: function(e) {
            var t, i = this._findActive(e);
            i[0] !== this.active[0] && (i.length || (i = this.active), t = i.find(".ui-tabs-anchor")[0], this._eventHandler({
                target: t,
                currentTarget: t,
                preventDefault: C.noop
            }))
        },
        _findActive: function(e) {
            return !1 === e ? C() : this.tabs.eq(e)
        },
        _getIndex: function(e) {
            return "string" == typeof e && (e = this.anchors.index(this.anchors.filter("[href$='" + C.ui.escapeSelector(e) + "']"))), e
        },
        _destroy: function() {
            this.xhr && this.xhr.abort(), this.tablist.removeAttr("role").off(this.eventNamespace), this.anchors.removeAttr("role tabIndex").removeUniqueId(), this.tabs.add(this.panels).each(function() {
                C.data(this, "ui-tabs-destroy") ? C(this).remove() : C(this).removeAttr("role tabIndex aria-live aria-busy aria-selected aria-labelledby aria-hidden aria-expanded")
            }), this.tabs.each(function() {
                var e = C(this),
                    t = e.data("ui-tabs-aria-controls");
                t ? e.attr("aria-controls", t).removeData("ui-tabs-aria-controls") : e.removeAttr("aria-controls")
            }), this.panels.show(), "content" !== this.options.heightStyle && this.panels.css("height", "")
        },
        enable: function(i) {
            var e = this.options.disabled;
            !1 !== e && (e = void 0 !== i && (i = this._getIndex(i), C.isArray(e) ? C.map(e, function(e) {
                return e !== i ? e : null
            }) : C.map(this.tabs, function(e, t) {
                return t !== i ? t : null
            })), this._setOptionDisabled(e))
        },
        disable: function(e) {
            var t = this.options.disabled;
            if (!0 !== t) {
                if (void 0 === e) t = !0;
                else {
                    if (e = this._getIndex(e), -1 !== C.inArray(e, t)) return;
                    t = C.isArray(t) ? C.merge([e], t).sort() : [e]
                }
                this._setOptionDisabled(t)
            }
        },
        load: function(e, n) {
            function s(e, t) {
                "abort" === t && o.panels.stop(!1, !0), o._removeClass(i, "ui-tabs-loading"), a.removeAttr("aria-busy"), e === o.xhr && delete o.xhr
            }
            e = this._getIndex(e);
            var o = this,
                i = this.tabs.eq(e),
                t = i.find(".ui-tabs-anchor"),
                a = this._getPanelForTab(i),
                r = {
                    tab: i,
                    panel: a
                };
            this._isLocal(t[0]) || (this.xhr = C.ajax(this._ajaxSettings(t, n, r)), this.xhr && "canceled" !== this.xhr.statusText && (this._addClass(i, "ui-tabs-loading"), a.attr("aria-busy", "true"), this.xhr.done(function(e, t, i) {
                setTimeout(function() {
                    a.html(e), o._trigger("load", n, r), s(i, t)
                }, 1)
            }).fail(function(e, t) {
                setTimeout(function() {
                    s(e, t)
                }, 1)
            })))
        },
        _ajaxSettings: function(e, i, n) {
            var s = this;
            return {
                url: e.attr("href").replace(/#.*$/, ""),
                beforeSend: function(e, t) {
                    return s._trigger("beforeLoad", i, C.extend({
                        jqXHR: e,
                        ajaxSettings: t
                    }, n))
                }
            }
        },
        _getPanelForTab: function(e) {
            var t = C(e).attr("aria-controls");
            return this.element.find(this._sanitizeSelector("#" + t))
        }
    }), !1 !== C.uiBackCompat && C.widget("ui.tabs", C.ui.tabs, {
        _processTabs: function() {
            this._superApply(arguments), this._addClass(this.tabs, "ui-tab")
        }
    }), C.ui.tabs, C.widget("ui.tooltip", {
        version: "1.12.1",
        options: {
            classes: {
                "ui-tooltip": "ui-corner-all ui-widget-shadow"
            },
            content: function() {
                var e = C(this).attr("title") || "";
                return C("<a>").text(e).html()
            },
            hide: !0,
            items: "[title]:not([disabled])",
            position: {
                my: "left top+15",
                at: "left bottom",
                collision: "flipfit flip"
            },
            show: !0,
            track: !1,
            close: null,
            open: null
        },
        _addDescribedBy: function(e, t) {
            var i = (e.attr("aria-describedby") || "").split(/\s+/);
            i.push(t), e.data("ui-tooltip-id", t).attr("aria-describedby", C.trim(i.join(" ")))
        },
        _removeDescribedBy: function(e) {
            var t = e.data("ui-tooltip-id"),
                i = (e.attr("aria-describedby") || "").split(/\s+/),
                n = C.inArray(t, i); - 1 !== n && i.splice(n, 1), e.removeData("ui-tooltip-id"), (i = C.trim(i.join(" "))) ? e.attr("aria-describedby", i) : e.removeAttr("aria-describedby")
        },
        _create: function() {
            this._on({
                mouseover: "open",
                focusin: "open"
            }), this.tooltips = {}, this.parents = {}, this.liveRegion = C("<div>").attr({
                role: "log",
                "aria-live": "assertive",
                "aria-relevant": "additions"
            }).appendTo(this.document[0].body), this._addClass(this.liveRegion, null, "ui-helper-hidden-accessible"), this.disabledTitles = C([])
        },
        _setOption: function(e, t) {
            var i = this;
            this._super(e, t), "content" === e && C.each(this.tooltips, function(e, t) {
                i._updateContent(t.element)
            })
        },
        _setOptionDisabled: function(e) {
            this[e ? "_disable" : "_enable"]()
        },
        _disable: function() {
            var n = this;
            C.each(this.tooltips, function(e, t) {
                var i = C.Event("blur");
                i.target = i.currentTarget = t.element[0], n.close(i, !0)
            }), this.disabledTitles = this.disabledTitles.add(this.element.find(this.options.items).addBack().filter(function() {
                var e = C(this);
                return e.is("[title]") ? e.data("ui-tooltip-title", e.attr("title")).removeAttr("title") : void 0
            }))
        },
        _enable: function() {
            this.disabledTitles.each(function() {
                var e = C(this);
                e.data("ui-tooltip-title") && e.attr("title", e.data("ui-tooltip-title"))
            }), this.disabledTitles = C([])
        },
        open: function(e) {
            var i = this,
                t = C(e ? e.target : this.element).closest(this.options.items);
            t.length && !t.data("ui-tooltip-id") && (t.attr("title") && t.data("ui-tooltip-title", t.attr("title")), t.data("ui-tooltip-open", !0), e && "mouseover" === e.type && t.parents().each(function() {
                var e, t = C(this);
                t.data("ui-tooltip-open") && ((e = C.Event("blur")).target = e.currentTarget = this, i.close(e, !0)), t.attr("title") && (t.uniqueId(), i.parents[this.id] = {
                    element: this,
                    title: t.attr("title")
                }, t.attr("title", ""))
            }), this._registerCloseHandlers(e, t), this._updateContent(t, e))
        },
        _updateContent: function(t, i) {
            var e, n = this.options.content,
                s = this,
                o = i ? i.type : null;
            return "string" == typeof n || n.nodeType || n.jquery ? this._open(i, t, n) : void((e = n.call(t[0], function(e) {
                s._delay(function() {
                    t.data("ui-tooltip-open") && (i && (i.type = o), this._open(i, t, e))
                })
            })) && this._open(i, t, e))
        },
        _open: function(e, t, i) {
            function n(e) {
                l.of = e, o.is(":hidden") || o.position(l)
            }
            var s, o, a, r, l = C.extend({}, this.options.position);
            if (i) {
                if (s = this._find(t)) return void s.tooltip.find(".ui-tooltip-content").html(i);
                t.is("[title]") && (e && "mouseover" === e.type ? t.attr("title", "") : t.removeAttr("title")), s = this._tooltip(t), o = s.tooltip, this._addDescribedBy(t, o.attr("id")), o.find(".ui-tooltip-content").html(i), this.liveRegion.children().hide(), (r = C("<div>").html(o.find(".ui-tooltip-content").html())).removeAttr("name").find("[name]").removeAttr("name"), r.removeAttr("id").find("[id]").removeAttr("id"), r.appendTo(this.liveRegion), this.options.track && e && /^mouse/.test(e.type) ? (this._on(this.document, {
                    mousemove: n
                }), n(e)) : o.position(C.extend({
                    of: t
                }, this.options.position)), o.hide(), this._show(o, this.options.show), this.options.track && this.options.show && this.options.show.delay && (a = this.delayedShow = setInterval(function() {
                    o.is(":visible") && (n(l.of), clearInterval(a))
                }, C.fx.interval)), this._trigger("open", e, {
                    tooltip: o
                })
            }
        },
        _registerCloseHandlers: function(e, i) {
            var t = {
                keyup: function(e) {
                    if (e.keyCode === C.ui.keyCode.ESCAPE) {
                        var t = C.Event(e);
                        t.currentTarget = i[0], this.close(t, !0)
                    }
                }
            };
            i[0] !== this.element[0] && (t.remove = function() {
                this._removeTooltip(this._find(i).tooltip)
            }), e && "mouseover" !== e.type || (t.mouseleave = "close"), e && "focusin" !== e.type || (t.focusout = "close"), this._on(!0, i, t)
        },
        close: function(e) {
            var t, i = this,
                n = C(e ? e.currentTarget : this.element),
                s = this._find(n);
            return s ? (t = s.tooltip, void(s.closing || (clearInterval(this.delayedShow), n.data("ui-tooltip-title") && !n.attr("title") && n.attr("title", n.data("ui-tooltip-title")), this._removeDescribedBy(n), s.hiding = !0, t.stop(!0), this._hide(t, this.options.hide, function() {
                i._removeTooltip(C(this))
            }), n.removeData("ui-tooltip-open"), this._off(n, "mouseleave focusout keyup"), n[0] !== this.element[0] && this._off(n, "remove"), this._off(this.document, "mousemove"), e && "mouseleave" === e.type && C.each(this.parents, function(e, t) {
                C(t.element).attr("title", t.title), delete i.parents[e]
            }), s.closing = !0, this._trigger("close", e, {
                tooltip: t
            }), s.hiding || (s.closing = !1)))) : void n.removeData("ui-tooltip-open")
        },
        _tooltip: function(e) {
            var t = C("<div>").attr("role", "tooltip"),
                i = C("<div>").appendTo(t),
                n = t.uniqueId().attr("id");
            return this._addClass(i, "ui-tooltip-content"), this._addClass(t, "ui-tooltip", "ui-widget ui-widget-content"), t.appendTo(this._appendTo(e)), this.tooltips[n] = {
                element: e,
                tooltip: t
            }
        },
        _find: function(e) {
            var t = e.data("ui-tooltip-id");
            return t ? this.tooltips[t] : null
        },
        _removeTooltip: function(e) {
            e.remove(), delete this.tooltips[e.attr("id")]
        },
        _appendTo: function(e) {
            var t = e.closest(".ui-front, dialog");
            return t.length || (t = this.document[0].body), t
        },
        _destroy: function() {
            var s = this;
            C.each(this.tooltips, function(e, t) {
                var i = C.Event("blur"),
                    n = t.element;
                i.target = i.currentTarget = n[0], s.close(i, !0), C("#" + e).remove(), n.data("ui-tooltip-title") && (n.attr("title") || n.attr("title", n.data("ui-tooltip-title")), n.removeData("ui-tooltip-title"))
            }), this.liveRegion.remove()
        }
    }), !1 !== C.uiBackCompat && C.widget("ui.tooltip", C.ui.tooltip, {
        options: {
            tooltipClass: null
        },
        _tooltip: function() {
            var e = this._superApply(arguments);
            return this.options.tooltipClass && e.tooltip.addClass(this.options.tooltipClass), e
        }
    }), C.ui.tooltip
}),
function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : e.Popper = t()
}(this, function() {
    "use strict";

    function o(e) {
        return e && "[object Function]" === {}.toString.call(e)
    }

    function y(e, t) {
        if (1 !== e.nodeType) return [];
        var i = e.ownerDocument.defaultView.getComputedStyle(e, null);
        return t ? i[t] : i
    }

    function f(e) {
        return "HTML" === e.nodeName ? e : e.parentNode || e.host
    }

    function m(e) {
        if (!e) return document.body;
        switch (e.nodeName) {
            case "HTML":
            case "BODY":
                return e.ownerDocument.body;
            case "#document":
                return e.body
        }
        var t = y(e),
            i = t.overflow,
            n = t.overflowX,
            s = t.overflowY;
        return /(auto|scroll|overlay)/.test(i + s + n) ? e : m(f(e))
    }

    function g(e) {
        return 11 === e ? q : 10 === e ? U : q || U
    }

    function N(e) {
        if (!e) return document.documentElement;
        for (var t = g(10) ? document.body : null, i = e.offsetParent || null; i === t && e.nextElementSibling;) i = (e = e.nextElementSibling).offsetParent;
        var n = i && i.nodeName;
        return n && "BODY" !== n && "HTML" !== n ? -1 !== ["TH", "TD", "TABLE"].indexOf(i.nodeName) && "static" === y(i, "position") ? N(i) : i : e ? e.ownerDocument.documentElement : document.documentElement
    }

    function h(e) {
        return null === e.parentNode ? e : h(e.parentNode)
    }

    function v(e, t) {
        if (!(e && e.nodeType && t && t.nodeType)) return document.documentElement;
        var i = e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
            n = i ? e : t,
            s = i ? t : e,
            o = document.createRange();
        o.setStart(n, 0), o.setEnd(s, 0);
        var a, r, l = o.commonAncestorContainer;
        if (e !== l && t !== l || n.contains(s)) return "BODY" === (r = (a = l).nodeName) || "HTML" !== r && N(a.firstElementChild) !== a ? N(l) : l;
        var c = h(e);
        return c.host ? v(c.host, t) : v(e, h(t).host)
    }

    function b(e, t) {
        var i = "top" === (1 < arguments.length && void 0 !== t ? t : "top") ? "scrollTop" : "scrollLeft",
            n = e.nodeName;
        if ("BODY" !== n && "HTML" !== n) return e[i];
        var s = e.ownerDocument.documentElement;
        return (e.ownerDocument.scrollingElement || s)[i]
    }

    function u(e, t) {
        var i = "x" === t ? "Left" : "Top",
            n = "Left" == i ? "Right" : "Bottom";
        return parseFloat(e["border" + i + "Width"], 10) + parseFloat(e["border" + n + "Width"], 10)
    }

    function s(e, t, i, n) {
        return L(t["offset" + e], t["scroll" + e], i["client" + e], i["offset" + e], i["scroll" + e], g(10) ? parseInt(i["offset" + e]) + parseInt(n["margin" + ("Height" === e ? "Top" : "Left")]) + parseInt(n["margin" + ("Height" === e ? "Bottom" : "Right")]) : 0)
    }

    function _(e) {
        var t = e.body,
            i = e.documentElement,
            n = g(10) && getComputedStyle(i);
        return {
            height: s("Height", t, i, n),
            width: s("Width", t, i, n)
        }
    }

    function w(e) {
        return V({}, e, {
            right: e.left + e.width,
            bottom: e.top + e.height
        })
    }

    function M(e) {
        var t = {};
        try {
            if (g(10)) {
                t = e.getBoundingClientRect();
                var i = b(e, "top"),
                    n = b(e, "left");
                t.top += i, t.left += n, t.bottom += i, t.right += n
            } else t = e.getBoundingClientRect()
        } catch (e) {}
        var s = {
                left: t.left,
                top: t.top,
                width: t.right - t.left,
                height: t.bottom - t.top
            },
            o = "HTML" === e.nodeName ? _(e.ownerDocument) : {},
            a = o.width || e.clientWidth || s.right - s.left,
            r = o.height || e.clientHeight || s.bottom - s.top,
            l = e.offsetWidth - a,
            c = e.offsetHeight - r;
        if (l || c) {
            var h = y(e);
            l -= u(h, "x"), c -= u(h, "y"), s.width -= l, s.height -= c
        }
        return w(s)
    }

    function x(e, t, i) {
        var n = 2 < arguments.length && void 0 !== i && i,
            s = g(10),
            o = "HTML" === t.nodeName,
            a = M(e),
            r = M(t),
            l = m(e),
            c = y(t),
            h = parseFloat(c.borderTopWidth, 10),
            u = parseFloat(c.borderLeftWidth, 10);
        n && o && (r.top = L(r.top, 0), r.left = L(r.left, 0));
        var d = w({
            top: a.top - r.top - h,
            left: a.left - r.left - u,
            width: a.width,
            height: a.height
        });
        if (d.marginTop = 0, d.marginLeft = 0, !s && o) {
            var p = parseFloat(c.marginTop, 10),
                f = parseFloat(c.marginLeft, 10);
            d.top -= h - p, d.bottom -= h - p, d.left -= u - f, d.right -= u - f, d.marginTop = p, d.marginLeft = f
        }
        return (s && !n ? t.contains(l) : t === l && "BODY" !== l.nodeName) && (d = function(e, t, i) {
            var n = 2 < arguments.length && !1,
                s = b(t, "top"),
                o = b(t, "left"),
                a = n ? -1 : 1;
            return e.top += s * a, e.bottom += s * a, e.left += o * a, e.right += o * a, e
        }(d, t)), d
    }

    function C(e) {
        if (!e || !e.parentElement || g()) return document.documentElement;
        for (var t = e.parentElement; t && "none" === y(t, "transform");) t = t.parentElement;
        return t || document.documentElement
    }

    function k(e, t, i, n, s) {
        var o = 4 < arguments.length && void 0 !== s && s,
            a = {
                top: 0,
                left: 0
            },
            r = o ? C(e) : v(e, t);
        if ("viewport" === n) a = function(e, t) {
            var i = 1 < arguments.length && void 0 !== t && t,
                n = e.ownerDocument.documentElement,
                s = x(e, n),
                o = L(n.clientWidth, window.innerWidth || 0),
                a = L(n.clientHeight, window.innerHeight || 0),
                r = i ? 0 : b(n),
                l = i ? 0 : b(n, "left");
            return w({
                top: r - s.top + s.marginTop,
                left: l - s.left + s.marginLeft,
                width: o,
                height: a
            })
        }(r, o);
        else {
            var l;
            "scrollParent" === n ? "BODY" === (l = m(f(t))).nodeName && (l = e.ownerDocument.documentElement) : l = "window" === n ? e.ownerDocument.documentElement : n;
            var c = x(l, r, o);
            if ("HTML" !== l.nodeName || function e(t) {
                    var i = t.nodeName;
                    return "BODY" !== i && "HTML" !== i && ("fixed" === y(t, "position") || e(f(t)))
                }(r)) a = c;
            else {
                var h = _(e.ownerDocument),
                    u = h.height,
                    d = h.width;
                a.top += c.top - c.marginTop, a.bottom = u + c.top, a.left += c.left - c.marginLeft, a.right = d + c.left
            }
        }
        var p = "number" == typeof(i = i || 0);
        return a.left += p ? i : i.left || 0, a.top += p ? i : i.top || 0, a.right -= p ? i : i.right || 0, a.bottom -= p ? i : i.bottom || 0, a
    }

    function r(e, t, n, i, s, o) {
        var a = 5 < arguments.length && void 0 !== o ? o : 0;
        if (-1 === e.indexOf("auto")) return e;
        var r = k(n, i, a, s),
            l = {
                top: {
                    width: r.width,
                    height: t.top - r.top
                },
                right: {
                    width: r.right - t.right,
                    height: r.height
                },
                bottom: {
                    width: r.width,
                    height: r.bottom - t.bottom
                },
                left: {
                    width: t.left - r.left,
                    height: r.height
                }
            },
            c = Object.keys(l).map(function(e) {
                return V({
                    key: e
                }, l[e], {
                    area: (t = l[e], t.width * t.height)
                });
                var t
            }).sort(function(e, t) {
                return t.area - e.area
            }),
            h = c.filter(function(e) {
                var t = e.width,
                    i = e.height;
                return t >= n.clientWidth && i >= n.clientHeight
            }),
            u = 0 < h.length ? h[0].key : c[0].key,
            d = e.split("-")[1];
        return u + (d ? "-" + d : "")
    }

    function l(e, t, i, n) {
        var s = 3 < arguments.length && void 0 !== n ? n : null;
        return x(i, s ? C(t) : v(t, i), s)
    }

    function D(e) {
        var t = e.ownerDocument.defaultView.getComputedStyle(e),
            i = parseFloat(t.marginTop || 0) + parseFloat(t.marginBottom || 0),
            n = parseFloat(t.marginLeft || 0) + parseFloat(t.marginRight || 0);
        return {
            width: e.offsetWidth + n,
            height: e.offsetHeight + i
        }
    }

    function T(e) {
        var t = {
            left: "right",
            right: "left",
            bottom: "top",
            top: "bottom"
        };
        return e.replace(/left|right|bottom|top/g, function(e) {
            return t[e]
        })
    }

    function S(e, t, i) {
        i = i.split("-")[0];
        var n = D(e),
            s = {
                width: n.width,
                height: n.height
            },
            o = -1 !== ["right", "left"].indexOf(i),
            a = o ? "top" : "left",
            r = o ? "left" : "top",
            l = o ? "height" : "width",
            c = o ? "width" : "height";
        return s[a] = t[a] + t[l] / 2 - n[l] / 2, s[r] = i === r ? t[r] - n[c] : t[T(r)], s
    }

    function O(e, t) {
        return Array.prototype.find ? e.find(t) : e.filter(t)[0]
    }

    function I(e, i, t) {
        return (void 0 === t ? e : e.slice(0, function(e, t, i) {
            if (Array.prototype.findIndex) return e.findIndex(function(e) {
                return e.name === i
            });
            var n = O(e, function(e) {
                return e.name === i
            });
            return e.indexOf(n)
        }(e, 0, t))).forEach(function(e) {
            e.function && console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
            var t = e.function || e.fn;
            e.enabled && o(t) && (i.offsets.popper = w(i.offsets.popper), i.offsets.reference = w(i.offsets.reference), i = t(i, e))
        }), i
    }

    function e(e, i) {
        return e.some(function(e) {
            var t = e.name;
            return e.enabled && t === i
        })
    }

    function P(e) {
        for (var t = [!1, "ms", "Webkit", "Moz", "O"], i = e.charAt(0).toUpperCase() + e.slice(1), n = 0; n < t.length; n++) {
            var s = t[n],
                o = s ? "" + s + i : e;
            if (void 0 !== document.body.style[o]) return o
        }
        return null
    }

    function a(e) {
        var t = e.ownerDocument;
        return t ? t.defaultView : window
    }

    function d(e) {
        return "" !== e && !isNaN(parseFloat(e)) && isFinite(e)
    }

    function c(i, n) {
        Object.keys(n).forEach(function(e) {
            var t = ""; - 1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(e) && d(n[e]) && (t = "px"), i.style[e] = n[e] + t
        })
    }

    function E(e, t, i) {
        var n = O(e, function(e) {
                return e.name === t
            }),
            s = !!n && e.some(function(e) {
                return e.name === i && e.enabled && e.order < n.order
            });
        if (!s) {
            var o = "`" + t + "`";
            console.warn("`" + i + "` modifier is required by " + o + " modifier in order to work, be sure to include it before " + o + "!")
        }
        return s
    }

    function t(e, t) {
        var i = 1 < arguments.length && void 0 !== t && t,
            n = G.indexOf(e),
            s = G.slice(n + 1).concat(G.slice(0, n));
        return i ? s.reverse() : s
    }
    for (var A = Math.min, H = Math.floor, z = Math.round, L = Math.max, i = "undefined" != typeof window && "undefined" != typeof document, n = ["Edge", "Trident", "Firefox"], p = 0, $ = 0; $ < n.length; $ += 1)
        if (i && 0 <= navigator.userAgent.indexOf(n[$])) {
            p = 1;
            break
        }
    function F(e, t, i) {
        return t in e ? Object.defineProperty(e, t, {
            value: i,
            enumerable: !0,
            configurable: !0,
            writable: !0
        }) : e[t] = i, e
    }
    var W, j, R, B = i && window.Promise ? function(e) {
            var t = !1;
            return function() {
                t || (t = !0, window.Promise.resolve().then(function() {
                    t = !1, e()
                }))
            }
        } : function(e) {
            var t = !1;
            return function() {
                t || (t = !0, setTimeout(function() {
                    t = !1, e()
                }, p))
            }
        },
        q = i && !(!window.MSInputMethodContext || !document.documentMode),
        U = i && /MSIE 10/.test(navigator.userAgent),
        V = Object.assign || function(e) {
            for (var t, i = 1; i < arguments.length; i++)
                for (var n in t = arguments[i]) Object.prototype.hasOwnProperty.call(t, n) && (e[n] = t[n]);
            return e
        },
        Y = i && /Firefox/i.test(navigator.userAgent),
        K = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
        G = K.slice(3),
        X = (W = Q, (j = [{
            key: "update",
            value: function() {
                return function() {
                    if (!this.state.isDestroyed) {
                        var e = {
                            instance: this,
                            styles: {},
                            arrowStyles: {},
                            attributes: {},
                            flipped: !1,
                            offsets: {}
                        };
                        e.offsets.reference = l(this.state, this.popper, this.reference, this.options.positionFixed), e.placement = r(this.options.placement, e.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding), e.originalPlacement = e.placement, e.positionFixed = this.options.positionFixed, e.offsets.popper = S(this.popper, e.offsets.reference, e.placement), e.offsets.popper.position = this.options.positionFixed ? "fixed" : "absolute", e = I(this.modifiers, e), this.state.isCreated ? this.options.onUpdate(e) : (this.state.isCreated = !0, this.options.onCreate(e))
                    }
                }.call(this)
            }
        }, {
            key: "destroy",
            value: function() {
                return function() {
                    return this.state.isDestroyed = !0, e(this.modifiers, "applyStyle") && (this.popper.removeAttribute("x-placement"), this.popper.style.position = "", this.popper.style.top = "", this.popper.style.left = "", this.popper.style.right = "", this.popper.style.bottom = "", this.popper.style.willChange = "", this.popper.style[P("transform")] = ""), this.disableEventListeners(), this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper), this
                }.call(this)
            }
        }, {
            key: "enableEventListeners",
            value: function() {
                return function() {
                    this.state.eventsEnabled || (this.state = function(e, t, i, n) {
                        i.updateBound = n, a(e).addEventListener("resize", i.updateBound, {
                            passive: !0
                        });
                        var s = m(e);
                        return function e(t, i, n, s) {
                            var o = "BODY" === t.nodeName,
                                a = o ? t.ownerDocument.defaultView : t;
                            a.addEventListener(i, n, {
                                passive: !0
                            }), o || e(m(a.parentNode), i, n, s), s.push(a)
                        }(s, "scroll", i.updateBound, i.scrollParents), i.scrollElement = s, i.eventsEnabled = !0, i
                    }(this.reference, this.options, this.state, this.scheduleUpdate))
                }.call(this)
            }
        }, {
            key: "disableEventListeners",
            value: function() {
                return function() {
                    var e, t;
                    this.state.eventsEnabled && (cancelAnimationFrame(this.scheduleUpdate), this.state = (e = this.reference, t = this.state, a(e).removeEventListener("resize", t.updateBound), t.scrollParents.forEach(function(e) {
                        e.removeEventListener("scroll", t.updateBound)
                    }), t.updateBound = null, t.scrollParents = [], t.scrollElement = null, t.eventsEnabled = !1, t))
                }.call(this)
            }
        }]) && J(W.prototype, j), R && J(W, R), Q);

    function Q(e, t) {
        var i = this,
            n = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};
        (function(e) {
            if (!(e instanceof Q)) throw new TypeError("Cannot call a class as a function")
        })(this), this.scheduleUpdate = function() {
            return requestAnimationFrame(i.update)
        }, this.update = B(this.update.bind(this)), this.options = V({}, Q.Defaults, n), this.state = {
            isDestroyed: !1,
            isCreated: !1,
            scrollParents: []
        }, this.reference = e && e.jquery ? e[0] : e, this.popper = t && t.jquery ? t[0] : t, this.options.modifiers = {}, Object.keys(V({}, Q.Defaults.modifiers, n.modifiers)).forEach(function(e) {
            i.options.modifiers[e] = V({}, Q.Defaults.modifiers[e] || {}, n.modifiers ? n.modifiers[e] : {})
        }), this.modifiers = Object.keys(this.options.modifiers).map(function(e) {
            return V({
                name: e
            }, i.options.modifiers[e])
        }).sort(function(e, t) {
            return e.order - t.order
        }), this.modifiers.forEach(function(e) {
            e.enabled && o(e.onLoad) && e.onLoad(i.reference, i.popper, i.options, e, i.state)
        }), this.update();
        var s = this.options.eventsEnabled;
        s && this.enableEventListeners(), this.state.eventsEnabled = s
    }

    function J(e, t) {
        for (var i, n = 0; n < t.length; n++)(i = t[n]).enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
    }
    return X.Utils = ("undefined" == typeof window ? global : window).PopperUtils, X.placements = K, X.Defaults = {
        placement: "bottom",
        positionFixed: !1,
        eventsEnabled: !0,
        removeOnDestroy: !1,
        onCreate: function() {},
        onUpdate: function() {},
        modifiers: {
            shift: {
                order: 100,
                enabled: !0,
                fn: function(e) {
                    var t = e.placement,
                        i = t.split("-")[0],
                        n = t.split("-")[1];
                    if (n) {
                        var s = e.offsets,
                            o = s.reference,
                            a = s.popper,
                            r = -1 !== ["bottom", "top"].indexOf(i),
                            l = r ? "left" : "top",
                            c = r ? "width" : "height",
                            h = {
                                start: F({}, l, o[l]),
                                end: F({}, l, o[l] + o[c] - a[c])
                            };
                        e.offsets.popper = V({}, a, h[n])
                    }
                    return e
                }
            },
            offset: {
                order: 200,
                enabled: !0,
                fn: function(e, t) {
                    var i, n = t.offset,
                        s = e.placement,
                        o = e.offsets,
                        a = o.popper,
                        r = o.reference,
                        l = s.split("-")[0];
                    return i = d(+n) ? [+n, 0] : function(e, s, o, t) {
                        var a = [0, 0],
                            r = -1 !== ["right", "left"].indexOf(t),
                            i = e.split(/(\+|\-)/).map(function(e) {
                                return e.trim()
                            }),
                            n = i.indexOf(O(i, function(e) {
                                return -1 !== e.search(/,|\s/)
                            }));
                        i[n] && -1 === i[n].indexOf(",") && console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");
                        var l = /\s*,\s*|\s+/,
                            c = -1 === n ? [i] : [i.slice(0, n).concat([i[n].split(l)[0]]), [i[n].split(l)[1]].concat(i.slice(n + 1))];
                        return (c = c.map(function(e, t) {
                            var i = (1 === t ? !r : r) ? "height" : "width",
                                n = !1;
                            return e.reduce(function(e, t) {
                                return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t) ? (e[e.length - 1] = t, n = !0, e) : n ? (e[e.length - 1] += t, n = !1, e) : e.concat(t)
                            }, []).map(function(e) {
                                return function(e, t, i, n) {
                                    var s, o = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                                        a = +o[1],
                                        r = o[2];
                                    if (!a) return e;
                                    if (0 !== r.indexOf("%")) return "vh" !== r && "vw" !== r ? a : ("vh" === r ? L(document.documentElement.clientHeight, window.innerHeight || 0) : L(document.documentElement.clientWidth, window.innerWidth || 0)) / 100 * a;
                                    switch (r) {
                                        case "%p":
                                            s = i;
                                            break;
                                        case "%":
                                        case "%r":
                                        default:
                                            s = n
                                    }
                                    return w(s)[t] / 100 * a
                                }(e, i, s, o)
                            })
                        })).forEach(function(i, n) {
                            i.forEach(function(e, t) {
                                d(e) && (a[n] += e * ("-" === i[t - 1] ? -1 : 1))
                            })
                        }), a
                    }(n, a, r, l), "left" === l ? (a.top += i[0], a.left -= i[1]) : "right" === l ? (a.top += i[0], a.left += i[1]) : "top" === l ? (a.left += i[0], a.top -= i[1]) : "bottom" === l && (a.left += i[0], a.top += i[1]), e.popper = a, e
                },
                offset: 0
            },
            preventOverflow: {
                order: 300,
                enabled: !0,
                fn: function(e, n) {
                    var t = n.boundariesElement || N(e.instance.popper);
                    e.instance.reference === t && (t = N(t));
                    var i = P("transform"),
                        s = e.instance.popper.style,
                        o = s.top,
                        a = s.left,
                        r = s[i];
                    s.top = "", s.left = "", s[i] = "";
                    var l = k(e.instance.popper, e.instance.reference, n.padding, t, e.positionFixed);
                    s.top = o, s.left = a, s[i] = r, n.boundaries = l;
                    var c = n.priority,
                        h = e.offsets.popper,
                        u = {
                            primary: function(e) {
                                var t = h[e];
                                return h[e] < l[e] && !n.escapeWithReference && (t = L(h[e], l[e])), F({}, e, t)
                            },
                            secondary: function(e) {
                                var t = "right" === e ? "left" : "top",
                                    i = h[t];
                                return h[e] > l[e] && !n.escapeWithReference && (i = A(h[t], l[e] - ("right" === e ? h.width : h.height))), F({}, t, i)
                            }
                        };
                    return c.forEach(function(e) {
                        var t = -1 === ["left", "top"].indexOf(e) ? "secondary" : "primary";
                        h = V({}, h, u[t](e))
                    }), e.offsets.popper = h, e
                },
                priority: ["left", "right", "top", "bottom"],
                padding: 5,
                boundariesElement: "scrollParent"
            },
            keepTogether: {
                order: 400,
                enabled: !0,
                fn: function(e) {
                    var t = e.offsets,
                        i = t.popper,
                        n = t.reference,
                        s = e.placement.split("-")[0],
                        o = H,
                        a = -1 !== ["top", "bottom"].indexOf(s),
                        r = a ? "right" : "bottom",
                        l = a ? "left" : "top",
                        c = a ? "width" : "height";
                    return i[r] < o(n[l]) && (e.offsets.popper[l] = o(n[l]) - i[c]), i[l] > o(n[r]) && (e.offsets.popper[l] = o(n[r])), e
                }
            },
            arrow: {
                order: 500,
                enabled: !0,
                fn: function(e, t) {
                    var i;
                    if (!E(e.instance.modifiers, "arrow", "keepTogether")) return e;
                    var n = t.element;
                    if ("string" == typeof n) {
                        if (!(n = e.instance.popper.querySelector(n))) return e
                    } else if (!e.instance.popper.contains(n)) return console.warn("WARNING: `arrow.element` must be child of its popper element!"), e;
                    var s = e.placement.split("-")[0],
                        o = e.offsets,
                        a = o.popper,
                        r = o.reference,
                        l = -1 !== ["left", "right"].indexOf(s),
                        c = l ? "height" : "width",
                        h = l ? "Top" : "Left",
                        u = h.toLowerCase(),
                        d = l ? "left" : "top",
                        p = l ? "bottom" : "right",
                        f = D(n)[c];
                    r[p] - f < a[u] && (e.offsets.popper[u] -= a[u] - (r[p] - f)), r[u] + f > a[p] && (e.offsets.popper[u] += r[u] + f - a[p]), e.offsets.popper = w(e.offsets.popper);
                    var m = r[u] + r[c] / 2 - f / 2,
                        g = y(e.instance.popper),
                        v = parseFloat(g["margin" + h], 10),
                        b = parseFloat(g["border" + h + "Width"], 10),
                        _ = m - e.offsets.popper[u] - v - b;
                    return _ = L(A(a[c] - f, _), 0), e.arrowElement = n, e.offsets.arrow = (F(i = {}, u, z(_)), F(i, d, ""), i), e
                },
                element: "[x-arrow]"
            },
            flip: {
                order: 600,
                enabled: !0,
                fn: function(p, f) {
                    if (e(p.instance.modifiers, "inner")) return p;
                    if (p.flipped && p.placement === p.originalPlacement) return p;
                    var m = k(p.instance.popper, p.instance.reference, f.padding, f.boundariesElement, p.positionFixed),
                        g = p.placement.split("-")[0],
                        v = T(g),
                        b = p.placement.split("-")[1] || "",
                        _ = [];
                    switch (f.behavior) {
                        case "flip":
                            _ = [g, v];
                            break;
                        case "clockwise":
                            _ = t(g);
                            break;
                        case "counterclockwise":
                            _ = t(g, !0);
                            break;
                        default:
                            _ = f.behavior
                    }
                    return _.forEach(function(e, t) {
                        if (g !== e || _.length === t + 1) return p;
                        g = p.placement.split("-")[0], v = T(g);
                        var i = p.offsets.popper,
                            n = p.offsets.reference,
                            s = H,
                            o = "left" === g && s(i.right) > s(n.left) || "right" === g && s(i.left) < s(n.right) || "top" === g && s(i.bottom) > s(n.top) || "bottom" === g && s(i.top) < s(n.bottom),
                            a = s(i.left) < s(m.left),
                            r = s(i.right) > s(m.right),
                            l = s(i.top) < s(m.top),
                            c = s(i.bottom) > s(m.bottom),
                            h = "left" === g && a || "right" === g && r || "top" === g && l || "bottom" === g && c,
                            u = -1 !== ["top", "bottom"].indexOf(g),
                            d = !!f.flipVariations && (u && "start" === b && a || u && "end" === b && r || !u && "start" === b && l || !u && "end" === b && c);
                        (o || h || d) && (p.flipped = !0, (o || h) && (g = _[t + 1]), d && (b = "end" === b ? "start" : "start" === b ? "end" : b), p.placement = g + (b ? "-" + b : ""), p.offsets.popper = V({}, p.offsets.popper, S(p.instance.popper, p.offsets.reference, p.placement)), p = I(p.instance.modifiers, p, "flip"))
                    }), p
                },
                behavior: "flip",
                padding: 5,
                boundariesElement: "viewport"
            },
            inner: {
                order: 700,
                enabled: !1,
                fn: function(e) {
                    var t = e.placement,
                        i = t.split("-")[0],
                        n = e.offsets,
                        s = n.popper,
                        o = n.reference,
                        a = -1 !== ["left", "right"].indexOf(i),
                        r = -1 === ["top", "left"].indexOf(i);
                    return s[a ? "left" : "top"] = o[i] - (r ? s[a ? "width" : "height"] : 0), e.placement = T(t), e.offsets.popper = w(s), e
                }
            },
            hide: {
                order: 800,
                enabled: !0,
                fn: function(e) {
                    if (!E(e.instance.modifiers, "hide", "preventOverflow")) return e;
                    var t = e.offsets.reference,
                        i = O(e.instance.modifiers, function(e) {
                            return "preventOverflow" === e.name
                        }).boundaries;
                    if (t.bottom < i.top || t.left > i.right || t.top > i.bottom || t.right < i.left) {
                        if (!0 === e.hide) return e;
                        e.hide = !0, e.attributes["x-out-of-boundaries"] = ""
                    } else {
                        if (!1 === e.hide) return e;
                        e.hide = !1, e.attributes["x-out-of-boundaries"] = !1
                    }
                    return e
                }
            },
            computeStyle: {
                order: 850,
                enabled: !0,
                fn: function(e, t) {
                    var i = t.x,
                        n = t.y,
                        s = e.offsets.popper,
                        o = O(e.instance.modifiers, function(e) {
                            return "applyStyle" === e.name
                        }).gpuAcceleration;
                    void 0 !== o && console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");
                    var a, r, l, c, h, u, d, p, f, m, g, v, b, _ = void 0 === o ? t.gpuAcceleration : o,
                        y = N(e.instance.popper),
                        w = M(y),
                        x = {
                            position: s.position
                        },
                        C = (l = e, c = window.devicePixelRatio < 2 || !Y, h = l.offsets, u = h.popper, d = h.reference, p = -1 !== ["left", "right"].indexOf(l.placement), f = -1 !== l.placement.indexOf("-"), m = d.width % 2 == u.width % 2, g = 1 == d.width % 2 && 1 == u.width % 2, b = c ? z : S, {
                            left: (v = c ? p || f || m ? z : H : S)(g && !f && c ? u.left - 1 : u.left),
                            top: b(u.top),
                            bottom: b(u.bottom),
                            right: v(u.right)
                        }),
                        k = "bottom" === i ? "top" : "bottom",
                        D = "right" === n ? "left" : "right",
                        T = P("transform");

                    function S(e) {
                        return e
                    }
                    if (r = "bottom" == k ? "HTML" === y.nodeName ? -y.clientHeight + C.bottom : -w.height + C.bottom : C.top, a = "right" == D ? "HTML" === y.nodeName ? -y.clientWidth + C.right : -w.width + C.right : C.left, _ && T) x[T] = "translate3d(" + a + "px, " + r + "px, 0)", x[k] = 0, x[D] = 0, x.willChange = "transform";
                    else {
                        var I = "bottom" == k ? -1 : 1,
                            E = "right" == D ? -1 : 1;
                        x[k] = r * I, x[D] = a * E, x.willChange = k + ", " + D
                    }
                    var A = {
                        "x-placement": e.placement
                    };
                    return e.attributes = V({}, A, e.attributes), e.styles = V({}, x, e.styles), e.arrowStyles = V({}, e.offsets.arrow, e.arrowStyles), e
                },
                gpuAcceleration: !0,
                x: "bottom",
                y: "right"
            },
            applyStyle: {
                order: 900,
                enabled: !0,
                fn: function(e) {
                    return c(e.instance.popper, e.styles), t = e.instance.popper, i = e.attributes, Object.keys(i).forEach(function(e) {
                        !1 === i[e] ? t.removeAttribute(e) : t.setAttribute(e, i[e])
                    }), e.arrowElement && Object.keys(e.arrowStyles).length && c(e.arrowElement, e.arrowStyles), e;
                    var t, i
                },
                onLoad: function(e, t, i, n, s) {
                    var o = l(s, t, e, i.positionFixed),
                        a = r(i.placement, o, t, e, i.modifiers.flip.boundariesElement, i.modifiers.flip.padding);
                    return t.setAttribute("x-placement", a), c(t, {
                        position: i.positionFixed ? "fixed" : "absolute"
                    }), i
                },
                gpuAcceleration: void 0
            }
        }
    }, X
}),
function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? t(exports, require("popper.js"), require("jquery")) : "function" == typeof define && define.amd ? define(["exports", "popper.js", "jquery"], t) : t(e.bootstrap = {}, e.Popper, e.jQuery)
}(this, function(e, u, f) {
    "use strict";

    function n(e, t) {
        for (var i = 0; i < t.length; i++) {
            var n = t[i];
            n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
        }
    }

    function o(e, t, i) {
        return t && n(e.prototype, t), i && n(e, i), e
    }

    function a(s) {
        for (var e = 1; e < arguments.length; e++) {
            var o = null != arguments[e] ? arguments[e] : {},
                t = Object.keys(o);
            "function" == typeof Object.getOwnPropertySymbols && (t = t.concat(Object.getOwnPropertySymbols(o).filter(function(e) {
                return Object.getOwnPropertyDescriptor(o, e).enumerable
            }))), t.forEach(function(e) {
                var t, i, n;
                t = s, n = o[i = e], i in t ? Object.defineProperty(t, i, {
                    value: n,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0
                }) : t[i] = n
            })
        }
        return s
    }
    u = u && u.hasOwnProperty("default") ? u.default : u, f = f && f.hasOwnProperty("default") ? f.default : f;
    var t = "transitionend",
        m = {
            TRANSITION_END: "bsTransitionEnd",
            getUID: function(e) {
                for (; e += ~~(1e6 * Math.random()), document.getElementById(e););
                return e
            },
            getSelectorFromElement: function(e) {
                var t = e.getAttribute("data-target");
                if (!t || "#" === t) {
                    var i = e.getAttribute("href");
                    t = i && "#" !== i ? i.trim() : ""
                }
                return t && document.querySelector(t) ? t : null
            },
            getTransitionDurationFromElement: function(e) {
                if (!e) return 0;
                var t = f(e).css("transition-duration"),
                    i = f(e).css("transition-delay"),
                    n = parseFloat(t),
                    s = parseFloat(i);
                return n || s ? (t = t.split(",")[0], i = i.split(",")[0], 1e3 * (parseFloat(t) + parseFloat(i))) : 0
            },
            reflow: function(e) {
                return e.offsetHeight
            },
            triggerTransitionEnd: function(e) {
                f(e).trigger(t)
            },
            supportsTransitionEnd: function() {
                return Boolean(t)
            },
            isElement: function(e) {
                return (e[0] || e).nodeType
            },
            typeCheckConfig: function(e, t, i) {
                for (var n in i)
                    if (Object.prototype.hasOwnProperty.call(i, n)) {
                        var s = i[n],
                            o = t[n],
                            a = o && m.isElement(o) ? "element" : (r = o, {}.toString.call(r).match(/\s([a-z]+)/i)[1].toLowerCase());
                        if (!new RegExp(s).test(a)) throw new Error(e.toUpperCase() + ': Option "' + n + '" provided type "' + a + '" but expected type "' + s + '".')
                    }
                var r
            },
            findShadowRoot: function(e) {
                if (!document.documentElement.attachShadow) return null;
                if ("function" != typeof e.getRootNode) return e instanceof ShadowRoot ? e : e.parentNode ? m.findShadowRoot(e.parentNode) : null;
                var t = e.getRootNode();
                return t instanceof ShadowRoot ? t : null
            }
        };
    f.fn.emulateTransitionEnd = function(e) {
        var t = this,
            i = !1;
        return f(this).one(m.TRANSITION_END, function() {
            i = !0
        }), setTimeout(function() {
            i || m.triggerTransitionEnd(t)
        }, e), this
    }, f.event.special[m.TRANSITION_END] = {
        bindType: t,
        delegateType: t,
        handle: function(e) {
            if (f(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
        }
    };
    var i, s = "alert",
        r = "bs.alert",
        l = "." + r,
        c = f.fn[s],
        h = {
            CLOSE: "close" + l,
            CLOSED: "closed" + l,
            CLICK_DATA_API: "click" + l + ".data-api"
        },
        d = ((i = p.prototype).close = function(e) {
            var t = this._element;
            e && (t = this._getRootElement(e)), this._triggerCloseEvent(t).isDefaultPrevented() || this._removeElement(t)
        }, i.dispose = function() {
            f.removeData(this._element, r), this._element = null
        }, i._getRootElement = function(e) {
            var t = m.getSelectorFromElement(e),
                i = !1;
            return t && (i = document.querySelector(t)), i || f(e).closest(".alert")[0]
        }, i._triggerCloseEvent = function(e) {
            var t = f.Event(h.CLOSE);
            return f(e).trigger(t), t
        }, i._removeElement = function(t) {
            var i = this;
            if (f(t).removeClass("show"), f(t).hasClass("fade")) {
                var e = m.getTransitionDurationFromElement(t);
                f(t).one(m.TRANSITION_END, function(e) {
                    return i._destroyElement(t, e)
                }).emulateTransitionEnd(e)
            } else this._destroyElement(t)
        }, i._destroyElement = function(e) {
            f(e).detach().trigger(h.CLOSED).remove()
        }, p._jQueryInterface = function(i) {
            return this.each(function() {
                var e = f(this),
                    t = e.data(r);
                t || (t = new p(this), e.data(r, t)), "close" === i && t[i](this)
            })
        }, p._handleDismiss = function(t) {
            return function(e) {
                e && e.preventDefault(), t.close(this)
            }
        }, o(p, null, [{
            key: "VERSION",
            get: function() {
                return "4.2.1"
            }
        }]), p);

    function p(e) {
        this._element = e
    }
    f(document).on(h.CLICK_DATA_API, '[data-dismiss="alert"]', d._handleDismiss(new d)), f.fn[s] = d._jQueryInterface, f.fn[s].Constructor = d, f.fn[s].noConflict = function() {
        return f.fn[s] = c, d._jQueryInterface
    };
    var g, v = "button",
        b = "bs.button",
        _ = "." + b,
        y = ".data-api",
        w = f.fn[v],
        x = "active",
        C = '[data-toggle^="button"]',
        k = {
            CLICK_DATA_API: "click" + _ + y,
            FOCUS_BLUR_DATA_API: "focus" + _ + y + " blur" + _ + y
        },
        D = ((g = T.prototype).toggle = function() {
            var e = !0,
                t = !0,
                i = f(this._element).closest('[data-toggle="buttons"]')[0];
            if (i) {
                var n = this._element.querySelector('input:not([type="hidden"])');
                if (n) {
                    if ("radio" === n.type)
                        if (n.checked && this._element.classList.contains(x)) e = !1;
                        else {
                            var s = i.querySelector(".active");
                            s && f(s).removeClass(x)
                        }
                    if (e) {
                        if (n.hasAttribute("disabled") || i.hasAttribute("disabled") || n.classList.contains("disabled") || i.classList.contains("disabled")) return;
                        n.checked = !this._element.classList.contains(x), f(n).trigger("change")
                    }
                    n.focus(), t = !1
                }
            }
            t && this._element.setAttribute("aria-pressed", !this._element.classList.contains(x)), e && f(this._element).toggleClass(x)
        }, g.dispose = function() {
            f.removeData(this._element, b), this._element = null
        }, T._jQueryInterface = function(t) {
            return this.each(function() {
                var e = f(this).data(b);
                e || (e = new T(this), f(this).data(b, e)), "toggle" === t && e[t]()
            })
        }, o(T, null, [{
            key: "VERSION",
            get: function() {
                return "4.2.1"
            }
        }]), T);

    function T(e) {
        this._element = e
    }
    f(document).on(k.CLICK_DATA_API, C, function(e) {
        e.preventDefault();
        var t = e.target;
        f(t).hasClass("btn") || (t = f(t).closest(".btn")), D._jQueryInterface.call(f(t), "toggle")
    }).on(k.FOCUS_BLUR_DATA_API, C, function(e) {
        var t = f(e.target).closest(".btn")[0];
        f(t).toggleClass("focus", /^focus(in)?$/.test(e.type))
    }), f.fn[v] = D._jQueryInterface, f.fn[v].Constructor = D, f.fn[v].noConflict = function() {
        return f.fn[v] = w, D._jQueryInterface
    };
    var S, I = "carousel",
        E = "bs.carousel",
        A = "." + E,
        N = f.fn[I],
        M = {
            interval: 5e3,
            keyboard: !0,
            slide: !1,
            pause: "hover",
            wrap: !0,
            touch: !0
        },
        O = {
            interval: "(number|boolean)",
            keyboard: "boolean",
            slide: "(boolean|string)",
            pause: "(string|boolean)",
            wrap: "boolean",
            touch: "boolean"
        },
        P = "next",
        H = "prev",
        z = {
            SLIDE: "slide" + A,
            SLID: "slid" + A,
            KEYDOWN: "keydown" + A,
            MOUSEENTER: "mouseenter" + A,
            MOUSELEAVE: "mouseleave" + A,
            TOUCHSTART: "touchstart" + A,
            TOUCHMOVE: "touchmove" + A,
            TOUCHEND: "touchend" + A,
            POINTERDOWN: "pointerdown" + A,
            POINTERUP: "pointerup" + A,
            DRAG_START: "dragstart" + A,
            LOAD_DATA_API: "load" + A + ".data-api",
            CLICK_DATA_API: "click" + A + ".data-api"
        },
        L = "active",
        $ = ".active.carousel-item",
        F = {
            TOUCH: "touch",
            PEN: "pen"
        },
        W = ((S = j.prototype).next = function() {
            this._isSliding || this._slide(P)
        }, S.nextWhenVisible = function() {
            !document.hidden && f(this._element).is(":visible") && "hidden" !== f(this._element).css("visibility") && this.next()
        }, S.prev = function() {
            this._isSliding || this._slide(H)
        }, S.pause = function(e) {
            e || (this._isPaused = !0), this._element.querySelector(".carousel-item-next, .carousel-item-prev") && (m.triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null
        }, S.cycle = function(e) {
            e || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval))
        }, S.to = function(e) {
            var t = this;
            this._activeElement = this._element.querySelector($);
            var i = this._getItemIndex(this._activeElement);
            if (!(e > this._items.length - 1 || e < 0))
                if (this._isSliding) f(this._element).one(z.SLID, function() {
                    return t.to(e)
                });
                else {
                    if (i === e) return this.pause(), void this.cycle();
                    var n = i < e ? P : H;
                    this._slide(n, this._items[e])
                }
        }, S.dispose = function() {
            f(this._element).off(A), f.removeData(this._element, E), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null
        }, S._getConfig = function(e) {
            return e = a({}, M, e), m.typeCheckConfig(I, e, O), e
        }, S._handleSwipe = function() {
            var e = Math.abs(this.touchDeltaX);
            if (!(e <= 40)) {
                var t = e / this.touchDeltaX;
                0 < t && this.prev(), t < 0 && this.next()
            }
        }, S._addEventListeners = function() {
            var t = this;
            this._config.keyboard && f(this._element).on(z.KEYDOWN, function(e) {
                return t._keydown(e)
            }), "hover" === this._config.pause && f(this._element).on(z.MOUSEENTER, function(e) {
                return t.pause(e)
            }).on(z.MOUSELEAVE, function(e) {
                return t.cycle(e)
            }), this._addTouchEventListeners()
        }, S._addTouchEventListeners = function() {
            var i = this;
            if (this._touchSupported) {
                var t = function(e) {
                        i._pointerEvent && F[e.originalEvent.pointerType.toUpperCase()] ? i.touchStartX = e.originalEvent.clientX : i._pointerEvent || (i.touchStartX = e.originalEvent.touches[0].clientX)
                    },
                    n = function(e) {
                        i._pointerEvent && F[e.originalEvent.pointerType.toUpperCase()] && (i.touchDeltaX = e.originalEvent.clientX - i.touchStartX), i._handleSwipe(), "hover" === i._config.pause && (i.pause(), i.touchTimeout && clearTimeout(i.touchTimeout), i.touchTimeout = setTimeout(function(e) {
                            return i.cycle(e)
                        }, 500 + i._config.interval))
                    };
                f(this._element.querySelectorAll(".carousel-item img")).on(z.DRAG_START, function(e) {
                    return e.preventDefault()
                }), this._pointerEvent ? (f(this._element).on(z.POINTERDOWN, function(e) {
                    return t(e)
                }), f(this._element).on(z.POINTERUP, function(e) {
                    return n(e)
                }), this._element.classList.add("pointer-event")) : (f(this._element).on(z.TOUCHSTART, function(e) {
                    return t(e)
                }), f(this._element).on(z.TOUCHMOVE, function(e) {
                    var t;
                    (t = e).originalEvent.touches && 1 < t.originalEvent.touches.length ? i.touchDeltaX = 0 : i.touchDeltaX = t.originalEvent.touches[0].clientX - i.touchStartX
                }), f(this._element).on(z.TOUCHEND, function(e) {
                    return n(e)
                }))
            }
        }, S._keydown = function(e) {
            if (!/input|textarea/i.test(e.target.tagName)) switch (e.which) {
                case 37:
                    e.preventDefault(), this.prev();
                    break;
                case 39:
                    e.preventDefault(), this.next()
            }
        }, S._getItemIndex = function(e) {
            return this._items = e && e.parentNode ? [].slice.call(e.parentNode.querySelectorAll(".carousel-item")) : [], this._items.indexOf(e)
        }, S._getItemByDirection = function(e, t) {
            var i = e === P,
                n = e === H,
                s = this._getItemIndex(t),
                o = this._items.length - 1;
            if ((n && 0 === s || i && s === o) && !this._config.wrap) return t;
            var a = (s + (e === H ? -1 : 1)) % this._items.length;
            return -1 == a ? this._items[this._items.length - 1] : this._items[a]
        }, S._triggerSlideEvent = function(e, t) {
            var i = this._getItemIndex(e),
                n = this._getItemIndex(this._element.querySelector($)),
                s = f.Event(z.SLIDE, {
                    relatedTarget: e,
                    direction: t,
                    from: n,
                    to: i
                });
            return f(this._element).trigger(s), s
        }, S._setActiveIndicatorElement = function(e) {
            if (this._indicatorsElement) {
                var t = [].slice.call(this._indicatorsElement.querySelectorAll(".active"));
                f(t).removeClass(L);
                var i = this._indicatorsElement.children[this._getItemIndex(e)];
                i && f(i).addClass(L)
            }
        }, S._slide = function(e, t) {
            var i, n, s, o = this,
                a = this._element.querySelector($),
                r = this._getItemIndex(a),
                l = t || a && this._getItemByDirection(e, a),
                c = this._getItemIndex(l),
                h = Boolean(this._interval);
            if (s = e === P ? (i = "carousel-item-left", n = "carousel-item-next", "left") : (i = "carousel-item-right", n = "carousel-item-prev", "right"), l && f(l).hasClass(L)) this._isSliding = !1;
            else if (!this._triggerSlideEvent(l, s).isDefaultPrevented() && a && l) {
                this._isSliding = !0, h && this.pause(), this._setActiveIndicatorElement(l);
                var u = f.Event(z.SLID, {
                    relatedTarget: l,
                    direction: s,
                    from: r,
                    to: c
                });
                if (f(this._element).hasClass("slide")) {
                    f(l).addClass(n), m.reflow(l), f(a).addClass(i), f(l).addClass(i);
                    var d = parseInt(l.getAttribute("data-interval"), 10);
                    this._config.interval = d ? (this._config.defaultInterval = this._config.defaultInterval || this._config.interval, d) : this._config.defaultInterval || this._config.interval;
                    var p = m.getTransitionDurationFromElement(a);
                    f(a).one(m.TRANSITION_END, function() {
                        f(l).removeClass(i + " " + n).addClass(L), f(a).removeClass(L + " " + n + " " + i), o._isSliding = !1, setTimeout(function() {
                            return f(o._element).trigger(u)
                        }, 0)
                    }).emulateTransitionEnd(p)
                } else f(a).removeClass(L), f(l).addClass(L), this._isSliding = !1, f(this._element).trigger(u);
                h && this.cycle()
            }
        }, j._jQueryInterface = function(n) {
            return this.each(function() {
                var e = f(this).data(E),
                    t = a({}, M, f(this).data());
                "object" == typeof n && (t = a({}, t, n));
                var i = "string" == typeof n ? n : t.slide;
                if (e || (e = new j(this, t), f(this).data(E, e)), "number" == typeof n) e.to(n);
                else if ("string" == typeof i) {
                    if (void 0 === e[i]) throw new TypeError('No method named "' + i + '"');
                    e[i]()
                } else t.interval && (e.pause(), e.cycle())
            })
        }, j._dataApiClickHandler = function(e) {
            var t = m.getSelectorFromElement(this);
            if (t) {
                var i = f(t)[0];
                if (i && f(i).hasClass("carousel")) {
                    var n = a({}, f(i).data(), f(this).data()),
                        s = this.getAttribute("data-slide-to");
                    s && (n.interval = !1), j._jQueryInterface.call(f(i), n), s && f(i).data(E).to(s), e.preventDefault()
                }
            }
        }, o(j, null, [{
            key: "VERSION",
            get: function() {
                return "4.2.1"
            }
        }, {
            key: "Default",
            get: function() {
                return M
            }
        }]), j);

    function j(e, t) {
        this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this.touchTimeout = null, this.touchStartX = 0, this.touchDeltaX = 0, this._config = this._getConfig(t), this._element = e, this._indicatorsElement = this._element.querySelector(".carousel-indicators"), this._touchSupported = "ontouchstart" in document.documentElement || 0 < navigator.maxTouchPoints, this._pointerEvent = Boolean(window.PointerEvent || window.MSPointerEvent), this._addEventListeners()
    }
    f(document).on(z.CLICK_DATA_API, "[data-slide], [data-slide-to]", W._dataApiClickHandler), f(window).on(z.LOAD_DATA_API, function() {
        for (var e = [].slice.call(document.querySelectorAll('[data-ride="carousel"]')), t = 0, i = e.length; t < i; t++) {
            var n = f(e[t]);
            W._jQueryInterface.call(n, n.data())
        }
    }), f.fn[I] = W._jQueryInterface, f.fn[I].Constructor = W, f.fn[I].noConflict = function() {
        return f.fn[I] = N, W._jQueryInterface
    };
    var R, B = "collapse",
        q = "bs.collapse",
        U = "." + q,
        V = f.fn[B],
        Y = {
            toggle: !0,
            parent: ""
        },
        K = {
            toggle: "boolean",
            parent: "(string|element)"
        },
        G = {
            SHOW: "show" + U,
            SHOWN: "shown" + U,
            HIDE: "hide" + U,
            HIDDEN: "hidden" + U,
            CLICK_DATA_API: "click" + U + ".data-api"
        },
        X = "show",
        Q = "collapse",
        J = "collapsing",
        Z = "collapsed",
        ee = '[data-toggle="collapse"]',
        te = ((R = ie.prototype).toggle = function() {
            f(this._element).hasClass(X) ? this.hide() : this.show()
        }, R.show = function() {
            var e, t, i = this;
            if (!(this._isTransitioning || f(this._element).hasClass(X) || (this._parent && 0 === (e = [].slice.call(this._parent.querySelectorAll(".show, .collapsing")).filter(function(e) {
                    return "string" == typeof i._config.parent ? e.getAttribute("data-parent") === i._config.parent : e.classList.contains(Q)
                })).length && (e = null), e && (t = f(e).not(this._selector).data(q)) && t._isTransitioning))) {
                var n = f.Event(G.SHOW);
                if (f(this._element).trigger(n), !n.isDefaultPrevented()) {
                    e && (ie._jQueryInterface.call(f(e).not(this._selector), "hide"), t || f(e).data(q, null));
                    var s = this._getDimension();
                    f(this._element).removeClass(Q).addClass(J), this._element.style[s] = 0, this._triggerArray.length && f(this._triggerArray).removeClass(Z).attr("aria-expanded", !0), this.setTransitioning(!0);
                    var o = "scroll" + (s[0].toUpperCase() + s.slice(1)),
                        a = m.getTransitionDurationFromElement(this._element);
                    f(this._element).one(m.TRANSITION_END, function() {
                        f(i._element).removeClass(J).addClass(Q).addClass(X), i._element.style[s] = "", i.setTransitioning(!1), f(i._element).trigger(G.SHOWN)
                    }).emulateTransitionEnd(a), this._element.style[s] = this._element[o] + "px"
                }
            }
        }, R.hide = function() {
            var e = this;
            if (!this._isTransitioning && f(this._element).hasClass(X)) {
                var t = f.Event(G.HIDE);
                if (f(this._element).trigger(t), !t.isDefaultPrevented()) {
                    var i = this._getDimension();
                    this._element.style[i] = this._element.getBoundingClientRect()[i] + "px", m.reflow(this._element), f(this._element).addClass(J).removeClass(Q).removeClass(X);
                    var n = this._triggerArray.length;
                    if (0 < n)
                        for (var s = 0; s < n; s++) {
                            var o = this._triggerArray[s],
                                a = m.getSelectorFromElement(o);
                            null !== a && (f([].slice.call(document.querySelectorAll(a))).hasClass(X) || f(o).addClass(Z).attr("aria-expanded", !1))
                        }
                    this.setTransitioning(!0), this._element.style[i] = "";
                    var r = m.getTransitionDurationFromElement(this._element);
                    f(this._element).one(m.TRANSITION_END, function() {
                        e.setTransitioning(!1), f(e._element).removeClass(J).addClass(Q).trigger(G.HIDDEN)
                    }).emulateTransitionEnd(r)
                }
            }
        }, R.setTransitioning = function(e) {
            this._isTransitioning = e
        }, R.dispose = function() {
            f.removeData(this._element, q), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null
        }, R._getConfig = function(e) {
            return (e = a({}, Y, e)).toggle = Boolean(e.toggle), m.typeCheckConfig(B, e, K), e
        }, R._getDimension = function() {
            return f(this._element).hasClass("width") ? "width" : "height"
        }, R._getParent = function() {
            var e, i = this;
            m.isElement(this._config.parent) ? (e = this._config.parent, void 0 !== this._config.parent.jquery && (e = this._config.parent[0])) : e = document.querySelector(this._config.parent);
            var t = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]',
                n = [].slice.call(e.querySelectorAll(t));
            return f(n).each(function(e, t) {
                i._addAriaAndCollapsedClass(ie._getTargetFromElement(t), [t])
            }), e
        }, R._addAriaAndCollapsedClass = function(e, t) {
            var i = f(e).hasClass(X);
            t.length && f(t).toggleClass(Z, !i).attr("aria-expanded", i)
        }, ie._getTargetFromElement = function(e) {
            var t = m.getSelectorFromElement(e);
            return t ? document.querySelector(t) : null
        }, ie._jQueryInterface = function(n) {
            return this.each(function() {
                var e = f(this),
                    t = e.data(q),
                    i = a({}, Y, e.data(), "object" == typeof n && n ? n : {});
                if (!t && i.toggle && /show|hide/.test(n) && (i.toggle = !1), t || (t = new ie(this, i), e.data(q, t)), "string" == typeof n) {
                    if (void 0 === t[n]) throw new TypeError('No method named "' + n + '"');
                    t[n]()
                }
            })
        }, o(ie, null, [{
            key: "VERSION",
            get: function() {
                return "4.2.1"
            }
        }, {
            key: "Default",
            get: function() {
                return Y
            }
        }]), ie);

    function ie(t, e) {
        this._isTransitioning = !1, this._element = t, this._config = this._getConfig(e), this._triggerArray = [].slice.call(document.querySelectorAll('[data-toggle="collapse"][href="#' + t.id + '"],[data-toggle="collapse"][data-target="#' + t.id + '"]'));
        for (var i = [].slice.call(document.querySelectorAll(ee)), n = 0, s = i.length; n < s; n++) {
            var o = i[n],
                a = m.getSelectorFromElement(o),
                r = [].slice.call(document.querySelectorAll(a)).filter(function(e) {
                    return e === t
                });
            null !== a && 0 < r.length && (this._selector = a, this._triggerArray.push(o))
        }
        this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle()
    }
    f(document).on(G.CLICK_DATA_API, ee, function(e) {
        "A" === e.currentTarget.tagName && e.preventDefault();
        var i = f(this),
            t = m.getSelectorFromElement(this),
            n = [].slice.call(document.querySelectorAll(t));
        f(n).each(function() {
            var e = f(this),
                t = e.data(q) ? "toggle" : i.data();
            te._jQueryInterface.call(e, t)
        })
    }), f.fn[B] = te._jQueryInterface, f.fn[B].Constructor = te, f.fn[B].noConflict = function() {
        return f.fn[B] = V, te._jQueryInterface
    };
    var ne, se = "dropdown",
        oe = "bs.dropdown",
        ae = "." + oe,
        re = ".data-api",
        le = f.fn[se],
        ce = new RegExp("38|40|27"),
        he = {
            HIDE: "hide" + ae,
            HIDDEN: "hidden" + ae,
            SHOW: "show" + ae,
            SHOWN: "shown" + ae,
            CLICK: "click" + ae,
            CLICK_DATA_API: "click" + ae + re,
            KEYDOWN_DATA_API: "keydown" + ae + re,
            KEYUP_DATA_API: "keyup" + ae + re
        },
        ue = "disabled",
        de = "show",
        pe = "dropdown-menu-right",
        fe = '[data-toggle="dropdown"]',
        me = ".dropdown-menu",
        ge = {
            offset: 0,
            flip: !0,
            boundary: "scrollParent",
            reference: "toggle",
            display: "dynamic"
        },
        ve = {
            offset: "(number|string|function)",
            flip: "boolean",
            boundary: "(string|element)",
            reference: "(string|element)",
            display: "string"
        },
        be = ((ne = _e.prototype).toggle = function() {
            if (!this._element.disabled && !f(this._element).hasClass(ue)) {
                var e = _e._getParentFromElement(this._element),
                    t = f(this._menu).hasClass(de);
                if (_e._clearMenus(), !t) {
                    var i = {
                            relatedTarget: this._element
                        },
                        n = f.Event(he.SHOW, i);
                    if (f(e).trigger(n), !n.isDefaultPrevented()) {
                        if (!this._inNavbar) {
                            if (void 0 === u) throw new TypeError("Bootstrap's dropdowns require Popper.js (https://popper.js.org/)");
                            var s = this._element;
                            "parent" === this._config.reference ? s = e : m.isElement(this._config.reference) && (s = this._config.reference, void 0 !== this._config.reference.jquery && (s = this._config.reference[0])), "scrollParent" !== this._config.boundary && f(e).addClass("position-static"), this._popper = new u(s, this._menu, this._getPopperConfig())
                        }
                        "ontouchstart" in document.documentElement && 0 === f(e).closest(".navbar-nav").length && f(document.body).children().on("mouseover", null, f.noop), this._element.focus(), this._element.setAttribute("aria-expanded", !0), f(this._menu).toggleClass(de), f(e).toggleClass(de).trigger(f.Event(he.SHOWN, i))
                    }
                }
            }
        }, ne.show = function() {
            if (!(this._element.disabled || f(this._element).hasClass(ue) || f(this._menu).hasClass(de))) {
                var e = {
                        relatedTarget: this._element
                    },
                    t = f.Event(he.SHOW, e),
                    i = _e._getParentFromElement(this._element);
                f(i).trigger(t), t.isDefaultPrevented() || (f(this._menu).toggleClass(de), f(i).toggleClass(de).trigger(f.Event(he.SHOWN, e)))
            }
        }, ne.hide = function() {
            if (!this._element.disabled && !f(this._element).hasClass(ue) && f(this._menu).hasClass(de)) {
                var e = {
                        relatedTarget: this._element
                    },
                    t = f.Event(he.HIDE, e),
                    i = _e._getParentFromElement(this._element);
                f(i).trigger(t), t.isDefaultPrevented() || (f(this._menu).toggleClass(de), f(i).toggleClass(de).trigger(f.Event(he.HIDDEN, e)))
            }
        }, ne.dispose = function() {
            f.removeData(this._element, oe), f(this._element).off(ae), this._element = null, (this._menu = null) !== this._popper && (this._popper.destroy(), this._popper = null)
        }, ne.update = function() {
            this._inNavbar = this._detectNavbar(), null !== this._popper && this._popper.scheduleUpdate()
        }, ne._addEventListeners = function() {
            var t = this;
            f(this._element).on(he.CLICK, function(e) {
                e.preventDefault(), e.stopPropagation(), t.toggle()
            })
        }, ne._getConfig = function(e) {
            return e = a({}, this.constructor.Default, f(this._element).data(), e), m.typeCheckConfig(se, e, this.constructor.DefaultType), e
        }, ne._getMenuElement = function() {
            if (!this._menu) {
                var e = _e._getParentFromElement(this._element);
                e && (this._menu = e.querySelector(me))
            }
            return this._menu
        }, ne._getPlacement = function() {
            var e = f(this._element.parentNode),
                t = "bottom-start";
            return e.hasClass("dropup") ? (t = "top-start", f(this._menu).hasClass(pe) && (t = "top-end")) : e.hasClass("dropright") ? t = "right-start" : e.hasClass("dropleft") ? t = "left-start" : f(this._menu).hasClass(pe) && (t = "bottom-end"), t
        }, ne._detectNavbar = function() {
            return 0 < f(this._element).closest(".navbar").length
        }, ne._getPopperConfig = function() {
            var t = this,
                e = {};
            "function" == typeof this._config.offset ? e.fn = function(e) {
                return e.offsets = a({}, e.offsets, t._config.offset(e.offsets) || {}), e
            } : e.offset = this._config.offset;
            var i = {
                placement: this._getPlacement(),
                modifiers: {
                    offset: e,
                    flip: {
                        enabled: this._config.flip
                    },
                    preventOverflow: {
                        boundariesElement: this._config.boundary
                    }
                }
            };
            return "static" === this._config.display && (i.modifiers.applyStyle = {
                enabled: !1
            }), i
        }, _e._jQueryInterface = function(t) {
            return this.each(function() {
                var e = f(this).data(oe);
                if (e || (e = new _e(this, "object" == typeof t ? t : null), f(this).data(oe, e)), "string" == typeof t) {
                    if (void 0 === e[t]) throw new TypeError('No method named "' + t + '"');
                    e[t]()
                }
            })
        }, _e._clearMenus = function(e) {
            if (!e || 3 !== e.which && ("keyup" !== e.type || 9 === e.which))
                for (var t = [].slice.call(document.querySelectorAll(fe)), i = 0, n = t.length; i < n; i++) {
                    var s = _e._getParentFromElement(t[i]),
                        o = f(t[i]).data(oe),
                        a = {
                            relatedTarget: t[i]
                        };
                    if (e && "click" === e.type && (a.clickEvent = e), o) {
                        var r = o._menu;
                        if (f(s).hasClass(de) && !(e && ("click" === e.type && /input|textarea/i.test(e.target.tagName) || "keyup" === e.type && 9 === e.which) && f.contains(s, e.target))) {
                            var l = f.Event(he.HIDE, a);
                            f(s).trigger(l), l.isDefaultPrevented() || ("ontouchstart" in document.documentElement && f(document.body).children().off("mouseover", null, f.noop), t[i].setAttribute("aria-expanded", "false"), f(r).removeClass(de), f(s).removeClass(de).trigger(f.Event(he.HIDDEN, a)))
                        }
                    }
                }
        }, _e._getParentFromElement = function(e) {
            var t, i = m.getSelectorFromElement(e);
            return i && (t = document.querySelector(i)), t || e.parentNode
        }, _e._dataApiKeydownHandler = function(e) {
            if ((/input|textarea/i.test(e.target.tagName) ? !(32 === e.which || 27 !== e.which && (40 !== e.which && 38 !== e.which || f(e.target).closest(me).length)) : ce.test(e.which)) && (e.preventDefault(), e.stopPropagation(), !this.disabled && !f(this).hasClass(ue))) {
                var t = _e._getParentFromElement(this),
                    i = f(t).hasClass(de);
                if (i && (!i || 27 !== e.which && 32 !== e.which)) {
                    var n = [].slice.call(t.querySelectorAll(".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)"));
                    if (0 !== n.length) {
                        var s = n.indexOf(e.target);
                        38 === e.which && 0 < s && s--, 40 === e.which && s < n.length - 1 && s++, s < 0 && (s = 0), n[s].focus()
                    }
                } else {
                    if (27 === e.which) {
                        var o = t.querySelector(fe);
                        f(o).trigger("focus")
                    }
                    f(this).trigger("click")
                }
            }
        }, o(_e, null, [{
            key: "VERSION",
            get: function() {
                return "4.2.1"
            }
        }, {
            key: "Default",
            get: function() {
                return ge
            }
        }, {
            key: "DefaultType",
            get: function() {
                return ve
            }
        }]), _e);

    function _e(e, t) {
        this._element = e, this._popper = null, this._config = this._getConfig(t), this._menu = this._getMenuElement(), this._inNavbar = this._detectNavbar(), this._addEventListeners()
    }
    f(document).on(he.KEYDOWN_DATA_API, fe, be._dataApiKeydownHandler).on(he.KEYDOWN_DATA_API, me, be._dataApiKeydownHandler).on(he.CLICK_DATA_API + " " + he.KEYUP_DATA_API, be._clearMenus).on(he.CLICK_DATA_API, fe, function(e) {
        e.preventDefault(), e.stopPropagation(), be._jQueryInterface.call(f(this), "toggle")
    }).on(he.CLICK_DATA_API, ".dropdown form", function(e) {
        e.stopPropagation()
    }), f.fn[se] = be._jQueryInterface, f.fn[se].Constructor = be, f.fn[se].noConflict = function() {
        return f.fn[se] = le, be._jQueryInterface
    };
    var ye, we = "modal",
        xe = "bs.modal",
        Ce = "." + xe,
        ke = f.fn[we],
        De = {
            backdrop: !0,
            keyboard: !0,
            focus: !0,
            show: !0
        },
        Te = {
            backdrop: "(boolean|string)",
            keyboard: "boolean",
            focus: "boolean",
            show: "boolean"
        },
        Se = {
            HIDE: "hide" + Ce,
            HIDDEN: "hidden" + Ce,
            SHOW: "show" + Ce,
            SHOWN: "shown" + Ce,
            FOCUSIN: "focusin" + Ce,
            RESIZE: "resize" + Ce,
            CLICK_DISMISS: "click.dismiss" + Ce,
            KEYDOWN_DISMISS: "keydown.dismiss" + Ce,
            MOUSEUP_DISMISS: "mouseup.dismiss" + Ce,
            MOUSEDOWN_DISMISS: "mousedown.dismiss" + Ce,
            CLICK_DATA_API: "click" + Ce + ".data-api"
        },
        Ie = "modal-open",
        Ee = "fade",
        Ae = "show",
        Ne = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
        Me = ".sticky-top",
        Oe = ((ye = Pe.prototype).toggle = function(e) {
            return this._isShown ? this.hide() : this.show(e)
        }, ye.show = function(e) {
            var t = this;
            if (!this._isShown && !this._isTransitioning) {
                f(this._element).hasClass(Ee) && (this._isTransitioning = !0);
                var i = f.Event(Se.SHOW, {
                    relatedTarget: e
                });
                f(this._element).trigger(i), this._isShown || i.isDefaultPrevented() || (this._isShown = !0, this._checkScrollbar(), this._setScrollbar(), this._adjustDialog(), this._setEscapeEvent(), this._setResizeEvent(), f(this._element).on(Se.CLICK_DISMISS, '[data-dismiss="modal"]', function(e) {
                    return t.hide(e)
                }), f(this._dialog).on(Se.MOUSEDOWN_DISMISS, function() {
                    f(t._element).one(Se.MOUSEUP_DISMISS, function(e) {
                        f(e.target).is(t._element) && (t._ignoreBackdropClick = !0)
                    })
                }), this._showBackdrop(function() {
                    return t._showElement(e)
                }))
            }
        }, ye.hide = function(e) {
            var t = this;
            if (e && e.preventDefault(), this._isShown && !this._isTransitioning) {
                var i = f.Event(Se.HIDE);
                if (f(this._element).trigger(i), this._isShown && !i.isDefaultPrevented()) {
                    this._isShown = !1;
                    var n = f(this._element).hasClass(Ee);
                    if (n && (this._isTransitioning = !0), this._setEscapeEvent(), this._setResizeEvent(), f(document).off(Se.FOCUSIN), f(this._element).removeClass(Ae), f(this._element).off(Se.CLICK_DISMISS), f(this._dialog).off(Se.MOUSEDOWN_DISMISS), n) {
                        var s = m.getTransitionDurationFromElement(this._element);
                        f(this._element).one(m.TRANSITION_END, function(e) {
                            return t._hideModal(e)
                        }).emulateTransitionEnd(s)
                    } else this._hideModal()
                }
            }
        }, ye.dispose = function() {
            [window, this._element, this._dialog].forEach(function(e) {
                return f(e).off(Ce)
            }), f(document).off(Se.FOCUSIN), f.removeData(this._element, xe), this._config = null, this._element = null, this._dialog = null, this._backdrop = null, this._isShown = null, this._isBodyOverflowing = null, this._ignoreBackdropClick = null, this._isTransitioning = null, this._scrollbarWidth = null
        }, ye.handleUpdate = function() {
            this._adjustDialog()
        }, ye._getConfig = function(e) {
            return e = a({}, De, e), m.typeCheckConfig(we, e, Te), e
        }, ye._showElement = function(e) {
            var t = this,
                i = f(this._element).hasClass(Ee);

            function n() {
                t._config.focus && t._element.focus(), t._isTransitioning = !1, f(t._element).trigger(s)
            }
            this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE || document.body.appendChild(this._element), this._element.style.display = "block", this._element.removeAttribute("aria-hidden"), this._element.setAttribute("aria-modal", !0), this._element.scrollTop = 0, i && m.reflow(this._element), f(this._element).addClass(Ae), this._config.focus && this._enforceFocus();
            var s = f.Event(Se.SHOWN, {
                relatedTarget: e
            });
            if (i) {
                var o = m.getTransitionDurationFromElement(this._dialog);
                f(this._dialog).one(m.TRANSITION_END, n).emulateTransitionEnd(o)
            } else n()
        }, ye._enforceFocus = function() {
            var t = this;
            f(document).off(Se.FOCUSIN).on(Se.FOCUSIN, function(e) {
                document !== e.target && t._element !== e.target && 0 === f(t._element).has(e.target).length && t._element.focus()
            })
        }, ye._setEscapeEvent = function() {
            var t = this;
            this._isShown && this._config.keyboard ? f(this._element).on(Se.KEYDOWN_DISMISS, function(e) {
                27 === e.which && (e.preventDefault(), t.hide())
            }) : this._isShown || f(this._element).off(Se.KEYDOWN_DISMISS)
        }, ye._setResizeEvent = function() {
            var t = this;
            this._isShown ? f(window).on(Se.RESIZE, function(e) {
                return t.handleUpdate(e)
            }) : f(window).off(Se.RESIZE)
        }, ye._hideModal = function() {
            var e = this;
            this._element.style.display = "none", this._element.setAttribute("aria-hidden", !0), this._element.removeAttribute("aria-modal"), this._isTransitioning = !1, this._showBackdrop(function() {
                f(document.body).removeClass(Ie), e._resetAdjustments(), e._resetScrollbar(), f(e._element).trigger(Se.HIDDEN)
            })
        }, ye._removeBackdrop = function() {
            this._backdrop && (f(this._backdrop).remove(), this._backdrop = null)
        }, ye._showBackdrop = function(e) {
            var t = this,
                i = f(this._element).hasClass(Ee) ? Ee : "";
            if (this._isShown && this._config.backdrop) {
                if (this._backdrop = document.createElement("div"), this._backdrop.className = "modal-backdrop", i && this._backdrop.classList.add(i), f(this._backdrop).appendTo(document.body), f(this._element).on(Se.CLICK_DISMISS, function(e) {
                        t._ignoreBackdropClick ? t._ignoreBackdropClick = !1 : e.target === e.currentTarget && ("static" === t._config.backdrop ? t._element.focus() : t.hide())
                    }), i && m.reflow(this._backdrop), f(this._backdrop).addClass(Ae), !e) return;
                if (!i) return void e();
                var n = m.getTransitionDurationFromElement(this._backdrop);
                f(this._backdrop).one(m.TRANSITION_END, e).emulateTransitionEnd(n)
            } else if (!this._isShown && this._backdrop) {
                f(this._backdrop).removeClass(Ae);
                var s = function() {
                    t._removeBackdrop(), e && e()
                };
                if (f(this._element).hasClass(Ee)) {
                    var o = m.getTransitionDurationFromElement(this._backdrop);
                    f(this._backdrop).one(m.TRANSITION_END, s).emulateTransitionEnd(o)
                } else s()
            } else e && e()
        }, ye._adjustDialog = function() {
            var e = this._element.scrollHeight > document.documentElement.clientHeight;
            !this._isBodyOverflowing && e && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !e && (this._element.style.paddingRight = this._scrollbarWidth + "px")
        }, ye._resetAdjustments = function() {
            this._element.style.paddingLeft = "", this._element.style.paddingRight = ""
        }, ye._checkScrollbar = function() {
            var e = document.body.getBoundingClientRect();
            this._isBodyOverflowing = e.left + e.right < window.innerWidth, this._scrollbarWidth = this._getScrollbarWidth()
        }, ye._setScrollbar = function() {
            var s = this;
            if (this._isBodyOverflowing) {
                var e = [].slice.call(document.querySelectorAll(Ne)),
                    t = [].slice.call(document.querySelectorAll(Me));
                f(e).each(function(e, t) {
                    var i = t.style.paddingRight,
                        n = f(t).css("padding-right");
                    f(t).data("padding-right", i).css("padding-right", parseFloat(n) + s._scrollbarWidth + "px")
                }), f(t).each(function(e, t) {
                    var i = t.style.marginRight,
                        n = f(t).css("margin-right");
                    f(t).data("margin-right", i).css("margin-right", parseFloat(n) - s._scrollbarWidth + "px")
                });
                var i = document.body.style.paddingRight,
                    n = f(document.body).css("padding-right");
                f(document.body).data("padding-right", i).css("padding-right", parseFloat(n) + this._scrollbarWidth + "px")
            }
            f(document.body).addClass(Ie)
        }, ye._resetScrollbar = function() {
            var e = [].slice.call(document.querySelectorAll(Ne));
            f(e).each(function(e, t) {
                var i = f(t).data("padding-right");
                f(t).removeData("padding-right"), t.style.paddingRight = i || ""
            });
            var t = [].slice.call(document.querySelectorAll(Me));
            f(t).each(function(e, t) {
                var i = f(t).data("margin-right");
                void 0 !== i && f(t).css("margin-right", i).removeData("margin-right")
            });
            var i = f(document.body).data("padding-right");
            f(document.body).removeData("padding-right"), document.body.style.paddingRight = i || ""
        }, ye._getScrollbarWidth = function() {
            var e = document.createElement("div");
            e.className = "modal-scrollbar-measure", document.body.appendChild(e);
            var t = e.getBoundingClientRect().width - e.clientWidth;
            return document.body.removeChild(e), t
        }, Pe._jQueryInterface = function(i, n) {
            return this.each(function() {
                var e = f(this).data(xe),
                    t = a({}, De, f(this).data(), "object" == typeof i && i ? i : {});
                if (e || (e = new Pe(this, t), f(this).data(xe, e)), "string" == typeof i) {
                    if (void 0 === e[i]) throw new TypeError('No method named "' + i + '"');
                    e[i](n)
                } else t.show && e.show(n)
            })
        }, o(Pe, null, [{
            key: "VERSION",
            get: function() {
                return "4.2.1"
            }
        }, {
            key: "Default",
            get: function() {
                return De
            }
        }]), Pe);

    function Pe(e, t) {
        this._config = this._getConfig(t), this._element = e, this._dialog = e.querySelector(".modal-dialog"), this._backdrop = null, this._isShown = !1, this._isBodyOverflowing = !1, this._ignoreBackdropClick = !1, this._isTransitioning = !1, this._scrollbarWidth = 0
    }
    f(document).on(Se.CLICK_DATA_API, '[data-toggle="modal"]', function(e) {
        var t, i = this,
            n = m.getSelectorFromElement(this);
        n && (t = document.querySelector(n));
        var s = f(t).data(xe) ? "toggle" : a({}, f(t).data(), f(this).data());
        "A" !== this.tagName && "AREA" !== this.tagName || e.preventDefault();
        var o = f(t).one(Se.SHOW, function(e) {
            e.isDefaultPrevented() || o.one(Se.HIDDEN, function() {
                f(i).is(":visible") && i.focus()
            })
        });
        Oe._jQueryInterface.call(f(t), s, this)
    }), f.fn[we] = Oe._jQueryInterface, f.fn[we].Constructor = Oe, f.fn[we].noConflict = function() {
        return f.fn[we] = ke, Oe._jQueryInterface
    };
    var He, ze = "tooltip",
        Le = "bs.tooltip",
        $e = "." + Le,
        Fe = f.fn[ze],
        We = "bs-tooltip",
        je = new RegExp("(^|\\s)" + We + "\\S+", "g"),
        Re = {
            animation: "boolean",
            template: "string",
            title: "(string|element|function)",
            trigger: "string",
            delay: "(number|object)",
            html: "boolean",
            selector: "(string|boolean)",
            placement: "(string|function)",
            offset: "(number|string)",
            container: "(string|element|boolean)",
            fallbackPlacement: "(string|array)",
            boundary: "(string|element)"
        },
        Be = {
            AUTO: "auto",
            TOP: "top",
            RIGHT: "right",
            BOTTOM: "bottom",
            LEFT: "left"
        },
        qe = {
            animation: !0,
            template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
            trigger: "hover focus",
            title: "",
            delay: 0,
            html: !1,
            selector: !1,
            placement: "top",
            offset: 0,
            container: !1,
            fallbackPlacement: "flip",
            boundary: "scrollParent"
        },
        Ue = "show",
        Ve = {
            HIDE: "hide" + $e,
            HIDDEN: "hidden" + $e,
            SHOW: "show" + $e,
            SHOWN: "shown" + $e,
            INSERTED: "inserted" + $e,
            CLICK: "click" + $e,
            FOCUSIN: "focusin" + $e,
            FOCUSOUT: "focusout" + $e,
            MOUSEENTER: "mouseenter" + $e,
            MOUSELEAVE: "mouseleave" + $e
        },
        Ye = "fade",
        Ke = "show",
        Ge = "hover",
        Xe = ((He = Qe.prototype).enable = function() {
            this._isEnabled = !0
        }, He.disable = function() {
            this._isEnabled = !1
        }, He.toggleEnabled = function() {
            this._isEnabled = !this._isEnabled
        }, He.toggle = function(e) {
            if (this._isEnabled)
                if (e) {
                    var t = this.constructor.DATA_KEY,
                        i = f(e.currentTarget).data(t);
                    i || (i = new this.constructor(e.currentTarget, this._getDelegateConfig()), f(e.currentTarget).data(t, i)), i._activeTrigger.click = !i._activeTrigger.click, i._isWithActiveTrigger() ? i._enter(null, i) : i._leave(null, i)
                } else {
                    if (f(this.getTipElement()).hasClass(Ke)) return void this._leave(null, this);
                    this._enter(null, this)
                }
        }, He.dispose = function() {
            clearTimeout(this._timeout), f.removeData(this.element, this.constructor.DATA_KEY), f(this.element).off(this.constructor.EVENT_KEY), f(this.element).closest(".modal").off("hide.bs.modal"), this.tip && f(this.tip).remove(), this._isEnabled = null, this._timeout = null, this._hoverState = null, (this._activeTrigger = null) !== this._popper && this._popper.destroy(), this._popper = null, this.element = null, this.config = null, this.tip = null
        }, He.show = function() {
            var t = this;
            if ("none" === f(this.element).css("display")) throw new Error("Please use show on visible elements");
            var e = f.Event(this.constructor.Event.SHOW);
            if (this.isWithContent() && this._isEnabled) {
                f(this.element).trigger(e);
                var i = m.findShadowRoot(this.element),
                    n = f.contains(null !== i ? i : this.element.ownerDocument.documentElement, this.element);
                if (e.isDefaultPrevented() || !n) return;
                var s = this.getTipElement(),
                    o = m.getUID(this.constructor.NAME);
                s.setAttribute("id", o), this.element.setAttribute("aria-describedby", o), this.setContent(), this.config.animation && f(s).addClass(Ye);
                var a = "function" == typeof this.config.placement ? this.config.placement.call(this, s, this.element) : this.config.placement,
                    r = this._getAttachment(a);
                this.addAttachmentClass(r);
                var l = this._getContainer();
                f(s).data(this.constructor.DATA_KEY, this), f.contains(this.element.ownerDocument.documentElement, this.tip) || f(s).appendTo(l), f(this.element).trigger(this.constructor.Event.INSERTED), this._popper = new u(this.element, s, {
                    placement: r,
                    modifiers: {
                        offset: {
                            offset: this.config.offset
                        },
                        flip: {
                            behavior: this.config.fallbackPlacement
                        },
                        arrow: {
                            element: ".arrow"
                        },
                        preventOverflow: {
                            boundariesElement: this.config.boundary
                        }
                    },
                    onCreate: function(e) {
                        e.originalPlacement !== e.placement && t._handlePopperPlacementChange(e)
                    },
                    onUpdate: function(e) {
                        return t._handlePopperPlacementChange(e)
                    }
                }), f(s).addClass(Ke), "ontouchstart" in document.documentElement && f(document.body).children().on("mouseover", null, f.noop);
                var c = function() {
                    t.config.animation && t._fixTransition();
                    var e = t._hoverState;
                    t._hoverState = null, f(t.element).trigger(t.constructor.Event.SHOWN), "out" === e && t._leave(null, t)
                };
                if (f(this.tip).hasClass(Ye)) {
                    var h = m.getTransitionDurationFromElement(this.tip);
                    f(this.tip).one(m.TRANSITION_END, c).emulateTransitionEnd(h)
                } else c()
            }
        }, He.hide = function(e) {
            function t() {
                i._hoverState !== Ue && n.parentNode && n.parentNode.removeChild(n), i._cleanTipClass(), i.element.removeAttribute("aria-describedby"), f(i.element).trigger(i.constructor.Event.HIDDEN), null !== i._popper && i._popper.destroy(), e && e()
            }
            var i = this,
                n = this.getTipElement(),
                s = f.Event(this.constructor.Event.HIDE);
            if (f(this.element).trigger(s), !s.isDefaultPrevented()) {
                if (f(n).removeClass(Ke), "ontouchstart" in document.documentElement && f(document.body).children().off("mouseover", null, f.noop), this._activeTrigger.click = !1, this._activeTrigger.focus = !1, this._activeTrigger[Ge] = !1, f(this.tip).hasClass(Ye)) {
                    var o = m.getTransitionDurationFromElement(n);
                    f(n).one(m.TRANSITION_END, t).emulateTransitionEnd(o)
                } else t();
                this._hoverState = ""
            }
        }, He.update = function() {
            null !== this._popper && this._popper.scheduleUpdate()
        }, He.isWithContent = function() {
            return Boolean(this.getTitle())
        }, He.addAttachmentClass = function(e) {
            f(this.getTipElement()).addClass(We + "-" + e)
        }, He.getTipElement = function() {
            return this.tip = this.tip || f(this.config.template)[0], this.tip
        }, He.setContent = function() {
            var e = this.getTipElement();
            this.setElementContent(f(e.querySelectorAll(".tooltip-inner")), this.getTitle()), f(e).removeClass("fade show")
        }, He.setElementContent = function(e, t) {
            var i = this.config.html;
            "object" == typeof t && (t.nodeType || t.jquery) ? i ? f(t).parent().is(e) || e.empty().append(t) : e.text(f(t).text()) : e[i ? "html" : "text"](t)
        }, He.getTitle = function() {
            var e = this.element.getAttribute("data-original-title");
            return e || ("function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title)
        }, He._getContainer = function() {
            return !1 === this.config.container ? document.body : m.isElement(this.config.container) ? f(this.config.container) : f(document).find(this.config.container)
        }, He._getAttachment = function(e) {
            return Be[e.toUpperCase()]
        }, He._setListeners = function() {
            var n = this;
            this.config.trigger.split(" ").forEach(function(e) {
                if ("click" === e) f(n.element).on(n.constructor.Event.CLICK, n.config.selector, function(e) {
                    return n.toggle(e)
                });
                else if ("manual" !== e) {
                    var t = e === Ge ? n.constructor.Event.MOUSEENTER : n.constructor.Event.FOCUSIN,
                        i = e === Ge ? n.constructor.Event.MOUSELEAVE : n.constructor.Event.FOCUSOUT;
                    f(n.element).on(t, n.config.selector, function(e) {
                        return n._enter(e)
                    }).on(i, n.config.selector, function(e) {
                        return n._leave(e)
                    })
                }
            }), f(this.element).closest(".modal").on("hide.bs.modal", function() {
                n.element && n.hide()
            }), this.config.selector ? this.config = a({}, this.config, {
                trigger: "manual",
                selector: ""
            }) : this._fixTitle()
        }, He._fixTitle = function() {
            var e = typeof this.element.getAttribute("data-original-title");
            !this.element.getAttribute("title") && "string" == e || (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""))
        }, He._enter = function(e, t) {
            var i = this.constructor.DATA_KEY;
            (t = t || f(e.currentTarget).data(i)) || (t = new this.constructor(e.currentTarget, this._getDelegateConfig()), f(e.currentTarget).data(i, t)), e && (t._activeTrigger["focusin" === e.type ? "focus" : Ge] = !0), f(t.getTipElement()).hasClass(Ke) || t._hoverState === Ue ? t._hoverState = Ue : (clearTimeout(t._timeout), t._hoverState = Ue, t.config.delay && t.config.delay.show ? t._timeout = setTimeout(function() {
                t._hoverState === Ue && t.show()
            }, t.config.delay.show) : t.show())
        }, He._leave = function(e, t) {
            var i = this.constructor.DATA_KEY;
            (t = t || f(e.currentTarget).data(i)) || (t = new this.constructor(e.currentTarget, this._getDelegateConfig()), f(e.currentTarget).data(i, t)), e && (t._activeTrigger["focusout" === e.type ? "focus" : Ge] = !1), t._isWithActiveTrigger() || (clearTimeout(t._timeout), t._hoverState = "out", t.config.delay && t.config.delay.hide ? t._timeout = setTimeout(function() {
                "out" === t._hoverState && t.hide()
            }, t.config.delay.hide) : t.hide())
        }, He._isWithActiveTrigger = function() {
            for (var e in this._activeTrigger)
                if (this._activeTrigger[e]) return !0;
            return !1
        }, He._getConfig = function(e) {
            return "number" == typeof(e = a({}, this.constructor.Default, f(this.element).data(), "object" == typeof e && e ? e : {})).delay && (e.delay = {
                show: e.delay,
                hide: e.delay
            }), "number" == typeof e.title && (e.title = e.title.toString()), "number" == typeof e.content && (e.content = e.content.toString()), m.typeCheckConfig(ze, e, this.constructor.DefaultType), e
        }, He._getDelegateConfig = function() {
            var e = {};
            if (this.config)
                for (var t in this.config) this.constructor.Default[t] !== this.config[t] && (e[t] = this.config[t]);
            return e
        }, He._cleanTipClass = function() {
            var e = f(this.getTipElement()),
                t = e.attr("class").match(je);
            null !== t && t.length && e.removeClass(t.join(""))
        }, He._handlePopperPlacementChange = function(e) {
            var t = e.instance;
            this.tip = t.popper, this._cleanTipClass(), this.addAttachmentClass(this._getAttachment(e.placement))
        }, He._fixTransition = function() {
            var e = this.getTipElement(),
                t = this.config.animation;
            null === e.getAttribute("x-placement") && (f(e).removeClass(Ye), this.config.animation = !1, this.hide(), this.show(), this.config.animation = t)
        }, Qe._jQueryInterface = function(i) {
            return this.each(function() {
                var e = f(this).data(Le),
                    t = "object" == typeof i && i;
                if ((e || !/dispose|hide/.test(i)) && (e || (e = new Qe(this, t), f(this).data(Le, e)), "string" == typeof i)) {
                    if (void 0 === e[i]) throw new TypeError('No method named "' + i + '"');
                    e[i]()
                }
            })
        }, o(Qe, null, [{
            key: "VERSION",
            get: function() {
                return "4.2.1"
            }
        }, {
            key: "Default",
            get: function() {
                return qe
            }
        }, {
            key: "NAME",
            get: function() {
                return ze
            }
        }, {
            key: "DATA_KEY",
            get: function() {
                return Le
            }
        }, {
            key: "Event",
            get: function() {
                return Ve
            }
        }, {
            key: "EVENT_KEY",
            get: function() {
                return $e
            }
        }, {
            key: "DefaultType",
            get: function() {
                return Re
            }
        }]), Qe);

    function Qe(e, t) {
        if (void 0 === u) throw new TypeError("Bootstrap's tooltips require Popper.js (https://popper.js.org/)");
        this._isEnabled = !0, this._timeout = 0, this._hoverState = "", this._activeTrigger = {}, this._popper = null, this.element = e, this.config = this._getConfig(t), this.tip = null, this._setListeners()
    }
    f.fn[ze] = Xe._jQueryInterface, f.fn[ze].Constructor = Xe, f.fn[ze].noConflict = function() {
        return f.fn[ze] = Fe, Xe._jQueryInterface
    };
    var Je = "popover",
        Ze = "bs.popover",
        et = "." + Ze,
        tt = f.fn[Je],
        it = "bs-popover",
        nt = new RegExp("(^|\\s)" + it + "\\S+", "g"),
        st = a({}, Xe.Default, {
            placement: "right",
            trigger: "click",
            content: "",
            template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
        }),
        ot = a({}, Xe.DefaultType, {
            content: "(string|element|function)"
        }),
        at = {
            HIDE: "hide" + et,
            HIDDEN: "hidden" + et,
            SHOW: "show" + et,
            SHOWN: "shown" + et,
            INSERTED: "inserted" + et,
            CLICK: "click" + et,
            FOCUSIN: "focusin" + et,
            FOCUSOUT: "focusout" + et,
            MOUSEENTER: "mouseenter" + et,
            MOUSELEAVE: "mouseleave" + et
        },
        rt = function(e) {
            var t, i;

            function n() {
                return e.apply(this, arguments) || this
            }
            i = e, (t = n).prototype = Object.create(i.prototype), (t.prototype.constructor = t).__proto__ = i;
            var s = n.prototype;
            return s.isWithContent = function() {
                return this.getTitle() || this._getContent()
            }, s.addAttachmentClass = function(e) {
                f(this.getTipElement()).addClass(it + "-" + e)
            }, s.getTipElement = function() {
                return this.tip = this.tip || f(this.config.template)[0], this.tip
            }, s.setContent = function() {
                var e = f(this.getTipElement());
                this.setElementContent(e.find(".popover-header"), this.getTitle());
                var t = this._getContent();
                "function" == typeof t && (t = t.call(this.element)), this.setElementContent(e.find(".popover-body"), t), e.removeClass("fade show")
            }, s._getContent = function() {
                return this.element.getAttribute("data-content") || this.config.content
            }, s._cleanTipClass = function() {
                var e = f(this.getTipElement()),
                    t = e.attr("class").match(nt);
                null !== t && 0 < t.length && e.removeClass(t.join(""))
            }, n._jQueryInterface = function(i) {
                return this.each(function() {
                    var e = f(this).data(Ze),
                        t = "object" == typeof i ? i : null;
                    if ((e || !/dispose|hide/.test(i)) && (e || (e = new n(this, t), f(this).data(Ze, e)), "string" == typeof i)) {
                        if (void 0 === e[i]) throw new TypeError('No method named "' + i + '"');
                        e[i]()
                    }
                })
            }, o(n, null, [{
                key: "VERSION",
                get: function() {
                    return "4.2.1"
                }
            }, {
                key: "Default",
                get: function() {
                    return st
                }
            }, {
                key: "NAME",
                get: function() {
                    return Je
                }
            }, {
                key: "DATA_KEY",
                get: function() {
                    return Ze
                }
            }, {
                key: "Event",
                get: function() {
                    return at
                }
            }, {
                key: "EVENT_KEY",
                get: function() {
                    return et
                }
            }, {
                key: "DefaultType",
                get: function() {
                    return ot
                }
            }]), n
        }(Xe);
    f.fn[Je] = rt._jQueryInterface, f.fn[Je].Constructor = rt, f.fn[Je].noConflict = function() {
        return f.fn[Je] = tt, rt._jQueryInterface
    };
    var lt, ct = "scrollspy",
        ht = "bs.scrollspy",
        ut = "." + ht,
        dt = f.fn[ct],
        pt = {
            offset: 10,
            method: "auto",
            target: ""
        },
        ft = {
            offset: "number",
            method: "string",
            target: "(string|element)"
        },
        mt = {
            ACTIVATE: "activate" + ut,
            SCROLL: "scroll" + ut,
            LOAD_DATA_API: "load" + ut + ".data-api"
        },
        gt = "active",
        vt = ".nav, .list-group",
        bt = ".nav-link",
        _t = ".list-group-item",
        yt = ((lt = wt.prototype).refresh = function() {
            var t = this,
                e = this._scrollElement === this._scrollElement.window ? "offset" : "position",
                s = "auto" === this._config.method ? e : this._config.method,
                o = "position" === s ? this._getScrollTop() : 0;
            this._offsets = [], this._targets = [], this._scrollHeight = this._getScrollHeight(), [].slice.call(document.querySelectorAll(this._selector)).map(function(e) {
                var t, i = m.getSelectorFromElement(e);
                if (i && (t = document.querySelector(i)), t) {
                    var n = t.getBoundingClientRect();
                    if (n.width || n.height) return [f(t)[s]().top + o, i]
                }
                return null
            }).filter(function(e) {
                return e
            }).sort(function(e, t) {
                return e[0] - t[0]
            }).forEach(function(e) {
                t._offsets.push(e[0]), t._targets.push(e[1])
            })
        }, lt.dispose = function() {
            f.removeData(this._element, ht), f(this._scrollElement).off(ut), this._element = null, this._scrollElement = null, this._config = null, this._selector = null, this._offsets = null, this._targets = null, this._activeTarget = null, this._scrollHeight = null
        }, lt._getConfig = function(e) {
            if ("string" != typeof(e = a({}, pt, "object" == typeof e && e ? e : {})).target) {
                var t = f(e.target).attr("id");
                t || (t = m.getUID(ct), f(e.target).attr("id", t)), e.target = "#" + t
            }
            return m.typeCheckConfig(ct, e, ft), e
        }, lt._getScrollTop = function() {
            return this._scrollElement === window ? this._scrollElement.pageYOffset : this._scrollElement.scrollTop
        }, lt._getScrollHeight = function() {
            return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight)
        }, lt._getOffsetHeight = function() {
            return this._scrollElement === window ? window.innerHeight : this._scrollElement.getBoundingClientRect().height
        }, lt._process = function() {
            var e = this._getScrollTop() + this._config.offset,
                t = this._getScrollHeight(),
                i = this._config.offset + t - this._getOffsetHeight();
            if (this._scrollHeight !== t && this.refresh(), i <= e) {
                var n = this._targets[this._targets.length - 1];
                this._activeTarget !== n && this._activate(n)
            } else {
                if (this._activeTarget && e < this._offsets[0] && 0 < this._offsets[0]) return this._activeTarget = null, void this._clear();
                for (var s = this._offsets.length; s--;) this._activeTarget !== this._targets[s] && e >= this._offsets[s] && (void 0 === this._offsets[s + 1] || e < this._offsets[s + 1]) && this._activate(this._targets[s])
            }
        }, lt._activate = function(t) {
            this._activeTarget = t, this._clear();
            var e = this._selector.split(",").map(function(e) {
                    return e + '[data-target="' + t + '"],' + e + '[href="' + t + '"]'
                }),
                i = f([].slice.call(document.querySelectorAll(e.join(","))));
            i.hasClass("dropdown-item") ? (i.closest(".dropdown").find(".dropdown-toggle").addClass(gt), i.addClass(gt)) : (i.addClass(gt), i.parents(vt).prev(bt + ", " + _t).addClass(gt), i.parents(vt).prev(".nav-item").children(bt).addClass(gt)), f(this._scrollElement).trigger(mt.ACTIVATE, {
                relatedTarget: t
            })
        }, lt._clear = function() {
            [].slice.call(document.querySelectorAll(this._selector)).filter(function(e) {
                return e.classList.contains(gt)
            }).forEach(function(e) {
                return e.classList.remove(gt)
            })
        }, wt._jQueryInterface = function(t) {
            return this.each(function() {
                var e = f(this).data(ht);
                if (e || (e = new wt(this, "object" == typeof t && t), f(this).data(ht, e)), "string" == typeof t) {
                    if (void 0 === e[t]) throw new TypeError('No method named "' + t + '"');
                    e[t]()
                }
            })
        }, o(wt, null, [{
            key: "VERSION",
            get: function() {
                return "4.2.1"
            }
        }, {
            key: "Default",
            get: function() {
                return pt
            }
        }]), wt);

    function wt(e, t) {
        var i = this;
        this._element = e, this._scrollElement = "BODY" === e.tagName ? window : e, this._config = this._getConfig(t), this._selector = this._config.target + " " + bt + "," + this._config.target + " " + _t + "," + this._config.target + " .dropdown-item", this._offsets = [], this._targets = [], this._activeTarget = null, this._scrollHeight = 0, f(this._scrollElement).on(mt.SCROLL, function(e) {
            return i._process(e)
        }), this.refresh(), this._process()
    }
    f(window).on(mt.LOAD_DATA_API, function() {
        for (var e = [].slice.call(document.querySelectorAll('[data-spy="scroll"]')), t = e.length; t--;) {
            var i = f(e[t]);
            yt._jQueryInterface.call(i, i.data())
        }
    }), f.fn[ct] = yt._jQueryInterface, f.fn[ct].Constructor = yt, f.fn[ct].noConflict = function() {
        return f.fn[ct] = dt, yt._jQueryInterface
    };
    var xt, Ct = "bs.tab",
        kt = "." + Ct,
        Dt = f.fn.tab,
        Tt = {
            HIDE: "hide" + kt,
            HIDDEN: "hidden" + kt,
            SHOW: "show" + kt,
            SHOWN: "shown" + kt,
            CLICK_DATA_API: "click.bs.tab.data-api"
        },
        St = "active",
        It = "> li > .active",
        Et = ((xt = At.prototype).show = function() {
            var i = this;
            if (!(this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && f(this._element).hasClass(St) || f(this._element).hasClass("disabled"))) {
                var e, n, t = f(this._element).closest(".nav, .list-group")[0],
                    s = m.getSelectorFromElement(this._element);
                if (t) {
                    var o = "UL" === t.nodeName || "OL" === t.nodeName ? It : ".active";
                    n = (n = f.makeArray(f(t).find(o)))[n.length - 1]
                }
                var a = f.Event(Tt.HIDE, {
                        relatedTarget: this._element
                    }),
                    r = f.Event(Tt.SHOW, {
                        relatedTarget: n
                    });
                if (n && f(n).trigger(a), f(this._element).trigger(r), !r.isDefaultPrevented() && !a.isDefaultPrevented()) {
                    s && (e = document.querySelector(s)), this._activate(this._element, t);
                    var l = function() {
                        var e = f.Event(Tt.HIDDEN, {
                                relatedTarget: i._element
                            }),
                            t = f.Event(Tt.SHOWN, {
                                relatedTarget: n
                            });
                        f(n).trigger(e), f(i._element).trigger(t)
                    };
                    e ? this._activate(e, e.parentNode, l) : l()
                }
            }
        }, xt.dispose = function() {
            f.removeData(this._element, Ct), this._element = null
        }, xt._activate = function(e, t, i) {
            function n() {
                return s._transitionComplete(e, o, i)
            }
            var s = this,
                o = (!t || "UL" !== t.nodeName && "OL" !== t.nodeName ? f(t).children(".active") : f(t).find(It))[0],
                a = i && o && f(o).hasClass("fade");
            if (o && a) {
                var r = m.getTransitionDurationFromElement(o);
                f(o).removeClass("show").one(m.TRANSITION_END, n).emulateTransitionEnd(r)
            } else n()
        }, xt._transitionComplete = function(e, t, i) {
            if (t) {
                f(t).removeClass(St);
                var n = f(t.parentNode).find("> .dropdown-menu .active")[0];
                n && f(n).removeClass(St), "tab" === t.getAttribute("role") && t.setAttribute("aria-selected", !1)
            }
            if (f(e).addClass(St), "tab" === e.getAttribute("role") && e.setAttribute("aria-selected", !0), m.reflow(e), f(e).addClass("show"), e.parentNode && f(e.parentNode).hasClass("dropdown-menu")) {
                var s = f(e).closest(".dropdown")[0];
                if (s) {
                    var o = [].slice.call(s.querySelectorAll(".dropdown-toggle"));
                    f(o).addClass(St)
                }
                e.setAttribute("aria-expanded", !0)
            }
            i && i()
        }, At._jQueryInterface = function(i) {
            return this.each(function() {
                var e = f(this),
                    t = e.data(Ct);
                if (t || (t = new At(this), e.data(Ct, t)), "string" == typeof i) {
                    if (void 0 === t[i]) throw new TypeError('No method named "' + i + '"');
                    t[i]()
                }
            })
        }, o(At, null, [{
            key: "VERSION",
            get: function() {
                return "4.2.1"
            }
        }]), At);

    function At(e) {
        this._element = e
    }
    f(document).on(Tt.CLICK_DATA_API, '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]', function(e) {
        e.preventDefault(), Et._jQueryInterface.call(f(this), "show")
    }), f.fn.tab = Et._jQueryInterface, f.fn.tab.Constructor = Et, f.fn.tab.noConflict = function() {
        return f.fn.tab = Dt, Et._jQueryInterface
    };
    var Nt, Mt = "toast",
        Ot = "bs.toast",
        Pt = "." + Ot,
        Ht = f.fn[Mt],
        zt = {
            CLICK_DISMISS: "click.dismiss" + Pt,
            HIDE: "hide" + Pt,
            HIDDEN: "hidden" + Pt,
            SHOW: "show" + Pt,
            SHOWN: "shown" + Pt
        },
        Lt = "show",
        $t = {
            animation: "boolean",
            autohide: "boolean",
            delay: "number"
        },
        Ft = {
            animation: !0,
            autohide: !0,
            delay: 500
        },
        Wt = ((Nt = jt.prototype).show = function() {
            var e = this;

            function t() {
                e._element.classList.remove("showing"), e._element.classList.add(Lt), f(e._element).trigger(zt.SHOWN), e._config.autohide && e.hide()
            }
            if (f(this._element).trigger(zt.SHOW), this._config.animation && this._element.classList.add("fade"), this._element.classList.remove("hide"), this._element.classList.add("showing"), this._config.animation) {
                var i = m.getTransitionDurationFromElement(this._element);
                f(this._element).one(m.TRANSITION_END, t).emulateTransitionEnd(i)
            } else t()
        }, Nt.hide = function(e) {
            var t = this;
            this._element.classList.contains(Lt) && (f(this._element).trigger(zt.HIDE), e ? this._close() : this._timeout = setTimeout(function() {
                t._close()
            }, this._config.delay))
        }, Nt.dispose = function() {
            clearTimeout(this._timeout), this._timeout = null, this._element.classList.contains(Lt) && this._element.classList.remove(Lt), f(this._element).off(zt.CLICK_DISMISS), f.removeData(this._element, Ot), this._element = null, this._config = null
        }, Nt._getConfig = function(e) {
            return e = a({}, Ft, f(this._element).data(), "object" == typeof e && e ? e : {}), m.typeCheckConfig(Mt, e, this.constructor.DefaultType), e
        }, Nt._setListeners = function() {
            var e = this;
            f(this._element).on(zt.CLICK_DISMISS, '[data-dismiss="toast"]', function() {
                return e.hide(!0)
            })
        }, Nt._close = function() {
            function e() {
                t._element.classList.add("hide"), f(t._element).trigger(zt.HIDDEN)
            }
            var t = this;
            if (this._element.classList.remove(Lt), this._config.animation) {
                var i = m.getTransitionDurationFromElement(this._element);
                f(this._element).one(m.TRANSITION_END, e).emulateTransitionEnd(i)
            } else e()
        }, jt._jQueryInterface = function(i) {
            return this.each(function() {
                var e = f(this),
                    t = e.data(Ot);
                if (t || (t = new jt(this, "object" == typeof i && i), e.data(Ot, t)), "string" == typeof i) {
                    if (void 0 === t[i]) throw new TypeError('No method named "' + i + '"');
                    t[i](this)
                }
            })
        }, o(jt, null, [{
            key: "VERSION",
            get: function() {
                return "4.2.1"
            }
        }, {
            key: "DefaultType",
            get: function() {
                return $t
            }
        }]), jt);

    function jt(e, t) {
        this._element = e, this._config = this._getConfig(t), this._timeout = null, this._setListeners()
    }
    f.fn[Mt] = Wt._jQueryInterface, f.fn[Mt].Constructor = Wt, f.fn[Mt].noConflict = function() {
            return f.fn[Mt] = Ht, Wt._jQueryInterface
        },
        function() {
            if (void 0 === f) throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");
            var e = f.fn.jquery.split(" ")[0].split(".");
            if (e[0] < 2 && e[1] < 9 || 1 === e[0] && 9 === e[1] && e[2] < 1 || 4 <= e[0]) throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")
        }(), e.Util = m, e.Alert = d, e.Button = D, e.Carousel = W, e.Collapse = te, e.Dropdown = be, e.Modal = Oe, e.Popover = rt, e.Scrollspy = yt, e.Tab = Et, e.Toast = Wt, e.Tooltip = Xe, Object.defineProperty(e, "__esModule", {
            value: !0
        })
}),
function(e, t) {
    void 0 === e && void 0 !== window && (e = window), "function" == typeof define && define.amd ? define(["jquery"], function(e) {
        return t(e)
    }) : "object" == typeof module && module.exports ? module.exports = t(require("jquery")) : t(e.jQuery)
}(this, function(e) {
    ! function(q) {
        "use strict";
        var e, c, t, i = document.createElement("_");
        if (i.classList.toggle("c3", !1), i.classList.contains("c3")) {
            var n = DOMTokenList.prototype.toggle;
            DOMTokenList.prototype.toggle = function(e, t) {
                return 1 in arguments && !this.contains(e) == !t ? t : n.call(this, e)
            }
        }

        function D(e) {
            var t, i = [],
                n = e && e.options;
            if (e.multiple)
                for (var s = 0, o = n.length; s < o; s++)(t = n[s]).selected && i.push(t.value || t.text);
            else i = e.value;
            return i
        }
        String.prototype.startsWith || (e = function() {
            try {
                var e = {},
                    t = Object.defineProperty,
                    i = t(e, e, e) && t
            } catch (e) {}
            return i
        }(), c = {}.toString, t = function(e) {
            if (null == this) throw new TypeError;
            var t = String(this);
            if (e && "[object RegExp]" == c.call(e)) throw new TypeError;
            var i = t.length,
                n = String(e),
                s = n.length,
                o = 1 < arguments.length ? arguments[1] : void 0,
                a = o ? Number(o) : 0;
            a != a && (a = 0);
            var r = Math.min(Math.max(a, 0), i);
            if (i < s + r) return !1;
            for (var l = -1; ++l < s;)
                if (t.charCodeAt(r + l) != n.charCodeAt(l)) return !1;
            return !0
        }, e ? e(String.prototype, "startsWith", {
            value: t,
            configurable: !0,
            writable: !0
        }) : String.prototype.startsWith = t), Object.keys || (Object.keys = function(e, t, i) {
            for (t in i = [], e) i.hasOwnProperty.call(e, t) && i.push(t);
            return i
        });
        var s = {
            useDefault: !1,
            _set: q.valHooks.select.set
        };
        q.valHooks.select.set = function(e, t) {
            return t && !s.useDefault && q(e).data("selected", !0), s._set.apply(this, arguments)
        };
        var T = null,
            o = function() {
                try {
                    return new Event("change"), !0
                } catch (e) {
                    return !1
                }
            }();

        function C(e, t, i, n) {
            for (var s = ["content", "subtext", "tokens"], o = !1, a = 0; a < s.length; a++) {
                var r = s[a],
                    l = e[r];
                if (l && (l = l.toString(), "content" === r && (l = l.replace(/<[^>]+>/g, "")), n && (l = h(l)), l = l.toUpperCase(), o = "contains" === i ? 0 <= l.indexOf(t) : l.startsWith(t))) break
            }
            return o
        }

        function I(e) {
            return parseInt(e, 10) || 0
        }

        function h(e) {
            return q.each([{
                re: /[\xC0-\xC6]/g,
                ch: "A"
            }, {
                re: /[\xE0-\xE6]/g,
                ch: "a"
            }, {
                re: /[\xC8-\xCB]/g,
                ch: "E"
            }, {
                re: /[\xE8-\xEB]/g,
                ch: "e"
            }, {
                re: /[\xCC-\xCF]/g,
                ch: "I"
            }, {
                re: /[\xEC-\xEF]/g,
                ch: "i"
            }, {
                re: /[\xD2-\xD6]/g,
                ch: "O"
            }, {
                re: /[\xF2-\xF6]/g,
                ch: "o"
            }, {
                re: /[\xD9-\xDC]/g,
                ch: "U"
            }, {
                re: /[\xF9-\xFC]/g,
                ch: "u"
            }, {
                re: /[\xC7-\xE7]/g,
                ch: "c"
            }, {
                re: /[\xD1]/g,
                ch: "N"
            }, {
                re: /[\xF1]/g,
                ch: "n"
            }], function() {
                e = e ? e.replace(this.re, this.ch) : ""
            }), e
        }

        function a(t) {
            function i(e) {
                return t[e]
            }
            var e = "(?:" + Object.keys(t).join("|") + ")",
                n = RegExp(e),
                s = RegExp(e, "g");
            return function(e) {
                return e = null == e ? "" : "" + e, n.test(e) ? e.replace(s, i) : e
            }
        }
        q.fn.triggerNative = function(e) {
            var t, i = this[0];
            i.dispatchEvent ? (o ? t = new Event(e, {
                bubbles: !0
            }) : (t = document.createEvent("Event")).initEvent(e, !0, !1), i.dispatchEvent(t)) : i.fireEvent ? ((t = document.createEventObject()).eventType = e, i.fireEvent("on" + e, t)) : this.trigger(e)
        };
        var U = a({
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#x27;",
                "`": "&#x60;"
            }),
            p = a({
                "&amp;": "&",
                "&lt;": "<",
                "&gt;": ">",
                "&quot;": '"',
                "&#x27;": "'",
                "&#x60;": "`"
            }),
            k = {
                32: " ",
                48: "0",
                49: "1",
                50: "2",
                51: "3",
                52: "4",
                53: "5",
                54: "6",
                55: "7",
                56: "8",
                57: "9",
                59: ";",
                65: "A",
                66: "B",
                67: "C",
                68: "D",
                69: "E",
                70: "F",
                71: "G",
                72: "H",
                73: "I",
                74: "J",
                75: "K",
                76: "L",
                77: "M",
                78: "N",
                79: "O",
                80: "P",
                81: "Q",
                82: "R",
                83: "S",
                84: "T",
                85: "U",
                86: "V",
                87: "W",
                88: "X",
                89: "Y",
                90: "Z",
                96: "0",
                97: "1",
                98: "2",
                99: "3",
                100: "4",
                101: "5",
                102: "6",
                103: "7",
                104: "8",
                105: "9"
            },
            V = {
                success: !1,
                major: "3"
            };
        try {
            V.full = (q.fn.dropdown.Constructor.VERSION || "").split(" ")[0].split("."), V.major = V.full[0], V.success = !0
        } catch (e) {
            console.warn("There was an issue retrieving Bootstrap's version. Ensure Bootstrap is being loaded before bootstrap-select and there is no namespace collision. If loading Bootstrap asynchronously, the version may need to be manually specified via $.fn.selectpicker.Constructor.BootstrapVersion.", e)
        }
        var Y = {
                DISABLED: "disabled",
                DIVIDER: "divider",
                SHOW: "open",
                DROPUP: "dropup",
                MENU: "dropdown-menu",
                MENURIGHT: "dropdown-menu-right",
                MENULEFT: "dropdown-menu-left",
                BUTTONCLASS: "btn-default",
                POPOVERHEADER: "popover-title"
            },
            S = {
                MENU: "." + Y.MENU
            };
        "4" === V.major && (Y.DIVIDER = "dropdown-divider", Y.SHOW = "show", Y.BUTTONCLASS = "btn-light", Y.POPOVERHEADER = "popover-header");
        var E = new RegExp("38|40"),
            A = new RegExp("^9$|27"),
            l = (new RegExp("13|32"), function(e, t) {
                var i = this;
                s.useDefault || (q.valHooks.select.set = s._set, s.useDefault = !0), this.$element = q(e), this.$newElement = null, this.$button = null, this.$menu = null, this.options = t, this.selectpicker = {
                    main: {
                        map: {
                            newIndex: {},
                            originalIndex: {}
                        }
                    },
                    current: {
                        map: {}
                    },
                    search: {
                        map: {}
                    },
                    view: {},
                    keydown: {
                        keyHistory: "",
                        resetKeyHistory: {
                            start: function() {
                                return setTimeout(function() {
                                    i.selectpicker.keydown.keyHistory = ""
                                }, 800)
                            }
                        }
                    }
                }, null === this.options.title && (this.options.title = this.$element.attr("title"));
                var n = this.options.windowPadding;
                "number" == typeof n && (this.options.windowPadding = [n, n, n, n]), this.val = l.prototype.val, this.render = l.prototype.render, this.refresh = l.prototype.refresh, this.setStyle = l.prototype.setStyle, this.selectAll = l.prototype.selectAll, this.deselectAll = l.prototype.deselectAll, this.destroy = l.prototype.destroy, this.remove = l.prototype.remove, this.show = l.prototype.show, this.hide = l.prototype.hide, this.init()
            });

        function r(e) {
            var o, a = arguments,
                r = e;
            if ([].shift.apply(a), !V.success) {
                try {
                    V.full = (q.fn.dropdown.Constructor.VERSION || "").split(" ")[0].split(".")
                } catch (e) {
                    V.full = l.BootstrapVersion.split(" ")[0].split(".")
                }
                V.major = V.full[0], V.success = !0, "4" === V.major && (Y.DIVIDER = "dropdown-divider", Y.SHOW = "show", Y.BUTTONCLASS = "btn-light", l.DEFAULTS.style = Y.BUTTONCLASS = "btn-light", Y.POPOVERHEADER = "popover-header")
            }
            var t = this.each(function() {
                var e = q(this);
                if (e.is("select")) {
                    var t = e.data("selectpicker"),
                        i = "object" == typeof r && r;
                    if (t) {
                        if (i)
                            for (var n in i) i.hasOwnProperty(n) && (t.options[n] = i[n])
                    } else {
                        var s = q.extend({}, l.DEFAULTS, q.fn.selectpicker.defaults || {}, e.data(), i);
                        s.template = q.extend({}, l.DEFAULTS.template, q.fn.selectpicker.defaults ? q.fn.selectpicker.defaults.template : {}, e.data().template, i.template), e.data("selectpicker", t = new l(this, s))
                    }
                    "string" == typeof r && (o = t[r] instanceof Function ? t[r].apply(t, a) : t.options[r])
                }
            });
            return void 0 !== o ? o : t
        }
        l.VERSION = "1.13.2", l.BootstrapVersion = V.major, l.DEFAULTS = {
            noneSelectedText: "Nothing selected",
            noneResultsText: "No results matched {0}",
            countSelectedText: function(e, t) {
                return 1 == e ? "{0} item selected" : "{0} items selected"
            },
            maxOptionsText: function(e, t) {
                return [1 == e ? "Limit reached ({n} item max)" : "Limit reached ({n} items max)", 1 == t ? "Group limit reached ({n} item max)" : "Group limit reached ({n} items max)"]
            },
            selectAllText: "Select All",
            deselectAllText: "Deselect All",
            doneButton: !1,
            doneButtonText: "Close",
            multipleSeparator: ", ",
            styleBase: "btn",
            style: Y.BUTTONCLASS,
            size: "auto",
            title: null,
            selectedTextFormat: "values",
            width: !1,
            container: !1,
            hideDisabled: !1,
            showSubtext: !1,
            showIcon: !0,
            showContent: !0,
            dropupAuto: !0,
            header: !1,
            liveSearch: !1,
            liveSearchPlaceholder: null,
            liveSearchNormalize: !1,
            liveSearchStyle: "contains",
            actionsBox: !1,
            iconBase: "glyphicon",
            tickIcon: "glyphicon-ok",
            showTick: !1,
            template: {
                caret: '<span class="caret"></span>'
            },
            maxOptions: !1,
            mobile: !1,
            selectOnTab: !1,
            dropdownAlignRight: !1,
            windowPadding: 0,
            virtualScroll: 600,
            display: !1
        }, "4" === V.major && (l.DEFAULTS.style = "btn-light", l.DEFAULTS.iconBase = "", l.DEFAULTS.tickIcon = "bs-ok-default"), l.prototype = {
            constructor: l,
            init: function() {
                var i = this,
                    e = this.$element.attr("id");
                this.$element.addClass("bs-select-hidden"), this.multiple = this.$element.prop("multiple"), this.autofocus = this.$element.prop("autofocus"), this.$newElement = this.createDropdown(), this.createLi(), this.$element.after(this.$newElement).prependTo(this.$newElement), this.$button = this.$newElement.children("button"), this.$menu = this.$newElement.children(S.MENU), this.$menuInner = this.$menu.children(".inner"), this.$searchbox = this.$menu.find("input"), this.$element.removeClass("bs-select-hidden"), !0 === this.options.dropdownAlignRight && this.$menu.addClass(Y.MENURIGHT), void 0 !== e && this.$button.attr("data-id", e), this.checkDisabled(), this.clickListener(), this.options.liveSearch && this.liveSearchListener(), this.render(), this.setStyle(), this.setWidth(), this.options.container ? this.selectPosition() : this.$element.on("hide.bs.select", function() {
                    if (i.isVirtual()) {
                        var e = i.$menuInner[0],
                            t = e.firstChild.cloneNode(!1);
                        e.replaceChild(t, e.firstChild), e.scrollTop = 0
                    }
                }), this.$menu.data("this", this), this.$newElement.data("this", this), this.options.mobile && this.mobile(), this.$newElement.on({
                    "hide.bs.dropdown": function(e) {
                        i.$menuInner.attr("aria-expanded", !1), i.$element.trigger("hide.bs.select", e)
                    },
                    "hidden.bs.dropdown": function(e) {
                        i.$element.trigger("hidden.bs.select", e)
                    },
                    "show.bs.dropdown": function(e) {
                        i.$menuInner.attr("aria-expanded", !0), i.$element.trigger("show.bs.select", e)
                    },
                    "shown.bs.dropdown": function(e) {
                        i.$element.trigger("shown.bs.select", e)
                    }
                }), i.$element[0].hasAttribute("required") && this.$element.on("invalid", function() {
                    i.$button.addClass("bs-invalid"), i.$element.on({
                        "shown.bs.select": function() {
                            i.$element.val(i.$element.val()).off("shown.bs.select")
                        },
                        "rendered.bs.select": function() {
                            this.validity.valid && i.$button.removeClass("bs-invalid"), i.$element.off("rendered.bs.select")
                        }
                    }), i.$button.on("blur.bs.select", function() {
                        i.$element.focus().blur(), i.$button.off("blur.bs.select")
                    })
                }), setTimeout(function() {
                    i.$element.trigger("loaded.bs.select")
                })
            },
            createDropdown: function() {
                var e = this.multiple || this.options.showTick ? " show-tick" : "",
                    t = this.autofocus ? " autofocus" : "",
                    i = this.options.header ? '<div class="' + Y.POPOVERHEADER + '"><button type="button" class="close" aria-hidden="true">&times;</button>' + this.options.header + "</div>" : "",
                    n = this.options.liveSearch ? '<div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"' + (null === this.options.liveSearchPlaceholder ? "" : ' placeholder="' + U(this.options.liveSearchPlaceholder) + '"') + ' role="textbox" aria-label="Search"></div>' : "",
                    s = this.multiple && this.options.actionsBox ? '<div class="bs-actionsbox"><div class="btn-group btn-group-sm btn-block"><button type="button" class="actions-btn bs-select-all btn ' + Y.BUTTONCLASS + '">' + this.options.selectAllText + '</button><button type="button" class="actions-btn bs-deselect-all btn ' + Y.BUTTONCLASS + '">' + this.options.deselectAllText + "</button></div></div>" : "",
                    o = this.multiple && this.options.doneButton ? '<div class="bs-donebutton"><div class="btn-group btn-block"><button type="button" class="btn btn-sm ' + Y.BUTTONCLASS + '">' + this.options.doneButtonText + "</button></div></div>" : "",
                    a = '<div class="dropdown bootstrap-select' + e + '"><button type="button" class="' + this.options.styleBase + ' dropdown-toggle" ' + ("static" === this.options.display ? 'data-display="static"' : "") + 'data-toggle="dropdown"' + t + ' role="button"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner"></div></div> </div>' + ("4" === V.major ? "" : '<span class="bs-caret">' + this.options.template.caret + "</span>") + '</button><div class="' + Y.MENU + " " + ("4" === V.major ? "" : Y.SHOW) + '" role="combobox">' + i + n + s + '<div class="inner ' + Y.SHOW + '" role="listbox" aria-expanded="false" tabindex="-1"><ul class="' + Y.MENU + " inner " + ("4" === V.major ? Y.SHOW : "") + '"></ul></div>' + o + "</div></div>";
                return q(a)
            },
            setPositionData: function() {
                this.selectpicker.view.canHighlight = [];
                for (var e = 0; e < this.selectpicker.current.data.length; e++) {
                    var t = this.selectpicker.current.data[e],
                        i = !0;
                    "divider" === t.type ? (i = !1, t.height = this.sizeInfo.dividerHeight) : "optgroup-label" === t.type ? (i = !1, t.height = this.sizeInfo.dropdownHeaderHeight) : t.height = this.sizeInfo.liHeight, t.disabled && (i = !1), this.selectpicker.view.canHighlight.push(i), t.position = (0 === e ? 0 : this.selectpicker.current.data[e - 1].position) + t.height
                }
            },
            isVirtual: function() {
                return !1 !== this.options.virtualScroll && this.selectpicker.main.elements.length >= this.options.virtualScroll || !0 === this.options.virtualScroll
            },
            createView: function(S, e) {
                e = e || 0;
                var I = this;
                this.selectpicker.current = S ? this.selectpicker.search : this.selectpicker.main;
                var E, A, N = [];

                function i(e, t) {
                    var i, n, s, o, a, r, l, c, h, u = I.selectpicker.current.elements.length,
                        d = [],
                        p = void 0,
                        f = !0,
                        m = I.isVirtual();
                    I.selectpicker.view.scrollTop = e, !0 === m && I.sizeInfo.hasScrollBar && I.$menu[0].offsetWidth > I.sizeInfo.totalMenuWidth && (I.sizeInfo.menuWidth = I.$menu[0].offsetWidth, I.sizeInfo.totalMenuWidth = I.sizeInfo.menuWidth + I.sizeInfo.scrollBarWidth, I.$menu.css("min-width", I.sizeInfo.menuWidth)), i = Math.ceil(I.sizeInfo.menuInnerHeight / I.sizeInfo.liHeight * 1.5), n = Math.round(u / i) || 1;
                    for (var g = 0; g < n; g++) {
                        var v = (g + 1) * i;
                        if (g === n - 1 && (v = u), d[g] = [g * i + (g ? 1 : 0), v], !u) break;
                        void 0 === p && e <= I.selectpicker.current.data[v - 1].position - I.sizeInfo.menuInnerHeight && (p = g)
                    }
                    if (void 0 === p && (p = 0), a = [I.selectpicker.view.position0, I.selectpicker.view.position1], s = Math.max(0, p - 1), o = Math.min(n - 1, p + 1), I.selectpicker.view.position0 = Math.max(0, d[s][0]) || 0, I.selectpicker.view.position1 = Math.min(u, d[o][1]) || 0, r = a[0] !== I.selectpicker.view.position0 || a[1] !== I.selectpicker.view.position1, void 0 !== I.activeIndex && (A = I.selectpicker.current.elements[I.selectpicker.current.map.newIndex[I.prevActiveIndex]], N = I.selectpicker.current.elements[I.selectpicker.current.map.newIndex[I.activeIndex]], E = I.selectpicker.current.elements[I.selectpicker.current.map.newIndex[I.selectedIndex]], t && (I.activeIndex !== I.selectedIndex && (N.classList.remove("active"), N.firstChild && N.firstChild.classList.remove("active")), I.activeIndex = void 0), I.activeIndex && I.activeIndex !== I.selectedIndex && E && E.length && (E.classList.remove("active"), E.firstChild && E.firstChild.classList.remove("active"))), void 0 !== I.prevActiveIndex && I.prevActiveIndex !== I.activeIndex && I.prevActiveIndex !== I.selectedIndex && A && A.length && (A.classList.remove("active"), A.firstChild && A.firstChild.classList.remove("active")), (t || r) && (l = I.selectpicker.view.visibleElements ? I.selectpicker.view.visibleElements.slice() : [], I.selectpicker.view.visibleElements = I.selectpicker.current.elements.slice(I.selectpicker.view.position0, I.selectpicker.view.position1), I.setOptionStatus(), (S || !1 === m && t) && (c = l, h = I.selectpicker.view.visibleElements, f = !(c.length === h.length && c.every(function(e, t) {
                            return e === h[t]
                        }))), (t || !0 === m) && f)) {
                        var b, _, y = I.$menuInner[0],
                            w = document.createDocumentFragment(),
                            x = y.firstChild.cloneNode(!1),
                            C = !0 === m ? I.selectpicker.view.visibleElements : I.selectpicker.current.elements;
                        y.replaceChild(x, y.firstChild), g = 0;
                        for (var k = C.length; g < k; g++) w.appendChild(C[g]);
                        !0 === m && (b = 0 === I.selectpicker.view.position0 ? 0 : I.selectpicker.current.data[I.selectpicker.view.position0 - 1].position, _ = I.selectpicker.view.position1 > u - 1 ? 0 : I.selectpicker.current.data[u - 1].position - I.selectpicker.current.data[I.selectpicker.view.position1 - 1].position, y.firstChild.style.marginTop = b + "px", y.firstChild.style.marginBottom = _ + "px"), y.firstChild.appendChild(w)
                    }
                    if (I.prevActiveIndex = I.activeIndex, I.options.liveSearch) {
                        if (S && t) {
                            var D, T = 0;
                            I.selectpicker.view.canHighlight[T] || (T = 1 + I.selectpicker.view.canHighlight.slice(1).indexOf(!0)), D = I.selectpicker.view.visibleElements[T], I.selectpicker.view.currentActive && (I.selectpicker.view.currentActive.classList.remove("active"), I.selectpicker.view.currentActive.firstChild && I.selectpicker.view.currentActive.firstChild.classList.remove("active")), D && (D.classList.add("active"), D.firstChild && D.firstChild.classList.add("active")), I.activeIndex = I.selectpicker.current.map.originalIndex[T]
                        }
                    } else I.$menuInner.focus()
                }
                this.setPositionData(), i(e, !0), this.$menuInner.off("scroll.createView").on("scroll.createView", function(e, t) {
                    I.noScroll || i(this.scrollTop, t), I.noScroll = !1
                }), q(window).off("resize.createView").on("resize.createView", function() {
                    i(I.$menuInner[0].scrollTop)
                })
            },
            createLi: function() {
                var E, A = this,
                    N = [],
                    M = 0,
                    O = 0,
                    P = [],
                    H = 0,
                    z = 0,
                    L = -1;
                this.selectpicker.view.titleOption || (this.selectpicker.view.titleOption = document.createElement("option"));
                var $ = {
                        span: document.createElement("span"),
                        subtext: document.createElement("small"),
                        a: document.createElement("a"),
                        li: document.createElement("li"),
                        whitespace: document.createTextNode(" ")
                    },
                    e = $.span.cloneNode(!1),
                    F = document.createDocumentFragment();

                function W(e, t, i, n) {
                    var s = $.li.cloneNode(!1);
                    return e && (1 === e.nodeType || 11 === e.nodeType ? s.appendChild(e) : s.innerHTML = e), void 0 !== i && "" !== i && (s.className = i), null != n && s.classList.add("optgroup-" + n), s
                }

                function j(e, t, i) {
                    var n = $.a.cloneNode(!0);
                    return e && (11 === e.nodeType ? n.appendChild(e) : n.insertAdjacentHTML("beforeend", e)), void 0 !== t & "" !== t && (n.className = t), "4" === V.major && n.classList.add("dropdown-item"), i && n.setAttribute("style", i), n
                }

                function R(e) {
                    var t, i, n = $.text.cloneNode(!1);
                    if (e.optionContent) n.innerHTML = e.optionContent;
                    else {
                        if (n.textContent = e.text, e.optionIcon) {
                            var s = $.whitespace.cloneNode(!1);
                            (i = $.span.cloneNode(!1)).className = A.options.iconBase + " " + e.optionIcon, F.appendChild(i), F.appendChild(s)
                        }
                        e.optionSubtext && ((t = $.subtext.cloneNode(!1)).innerHTML = e.optionSubtext, n.appendChild(t))
                    }
                    return F.appendChild(n), F
                }
                if (e.className = A.options.iconBase + " " + A.options.tickIcon + " check-mark", $.a.appendChild(e), $.a.setAttribute("role", "option"), $.subtext.className = "text-muted", $.text = $.span.cloneNode(!1), $.text.className = "text", this.options.title && !this.multiple) {
                    L--;
                    var t = this.$element[0],
                        i = !1,
                        n = !this.selectpicker.view.titleOption.parentNode;
                    n && (this.selectpicker.view.titleOption.className = "bs-title-option", this.selectpicker.view.titleOption.value = "", i = void 0 === q(t.options[t.selectedIndex]).attr("selected") && void 0 === this.$element.data("selected")), !n && 0 === this.selectpicker.view.titleOption.index || t.insertBefore(this.selectpicker.view.titleOption, t.firstChild), i && (t.selectedIndex = 0)
                }
                var B = this.$element.find("option");
                B.each(function(e) {
                    var t = q(this);
                    if (L++, !t.hasClass("bs-title-option")) {
                        var i, n, s = t.data(),
                            o = this.className || "",
                            a = U(this.style.cssText),
                            r = s.content,
                            l = this.textContent,
                            c = s.tokens,
                            h = s.subtext,
                            u = s.icon,
                            d = t.parent(),
                            p = d[0],
                            f = "OPTGROUP" === p.tagName,
                            m = f && p.disabled,
                            g = this.disabled || m,
                            v = this.previousElementSibling && "OPTGROUP" === this.previousElementSibling.tagName,
                            b = d.data();
                        if (!0 === s.hidden || A.options.hideDisabled && (g && !f || m)) i = s.prevHiddenIndex, t.next().data("prevHiddenIndex", void 0 !== i ? i : e), L--, v || void 0 !== i && (T = B[i].previousElementSibling) && "OPTGROUP" === T.tagName && !T.disabled && (v = !0), v && "divider" !== P[P.length - 1].type && (L++, N.push(W(!1, 0, Y.DIVIDER, H + "div")), P.push({
                            type: "divider",
                            optID: H
                        }));
                        else {
                            if (f && !0 !== s.divider) {
                                if (A.options.hideDisabled && g) {
                                    if (void 0 === b.allOptionsDisabled) {
                                        var _ = d.children();
                                        d.data("allOptionsDisabled", _.filter(":disabled").length === _.length)
                                    }
                                    if (d.data("allOptionsDisabled")) return void L--
                                }
                                var y = " " + p.className || "";
                                if (!this.previousElementSibling) {
                                    H += 1;
                                    var w = p.label,
                                        x = U(w),
                                        C = b.subtext,
                                        k = b.icon;
                                    0 !== e && 0 < N.length && (L++, N.push(W(!1, 0, Y.DIVIDER, H + "div")), P.push({
                                        type: "divider",
                                        optID: H
                                    })), L++;
                                    var D = function(e) {
                                        var t, i, n = $.text.cloneNode(!1);
                                        if (n.innerHTML = e.labelEscaped, e.labelIcon) {
                                            var s = $.whitespace.cloneNode(!1);
                                            (i = $.span.cloneNode(!1)).className = A.options.iconBase + " " + e.labelIcon, F.appendChild(i), F.appendChild(s)
                                        }
                                        return e.labelSubtext && ((t = $.subtext.cloneNode(!1)).textContent = e.labelSubtext, n.appendChild(t)), F.appendChild(n), F
                                    }({
                                        labelEscaped: x,
                                        labelSubtext: C,
                                        labelIcon: k
                                    });
                                    N.push(W(D, 0, "dropdown-header" + y, H)), P.push({
                                        content: x,
                                        subtext: C,
                                        type: "optgroup-label",
                                        optID: H
                                    }), z = L - 1
                                }
                                if (A.options.hideDisabled && g || !0 === s.hidden) return void L--;
                                n = R({
                                    text: l,
                                    optionContent: r,
                                    optionSubtext: h,
                                    optionIcon: u
                                }), N.push(W(j(n, "opt " + o + y, a), 0, "", H)), P.push({
                                    content: r || l,
                                    subtext: h,
                                    tokens: c,
                                    type: "option",
                                    optID: H,
                                    headerIndex: z,
                                    lastIndex: z + p.childElementCount,
                                    originalIndex: e,
                                    data: s
                                }), M++
                            } else if (!0 === s.divider) N.push(W(!1, 0, Y.DIVIDER)), P.push({
                                type: "divider",
                                originalIndex: e,
                                data: s
                            });
                            else {
                                var T;
                                !v && A.options.hideDisabled && void 0 !== (i = s.prevHiddenIndex) && (T = B[i].previousElementSibling) && "OPTGROUP" === T.tagName && !T.disabled && (v = !0), v && "divider" !== P[P.length - 1].type && (L++, N.push(W(!1, 0, Y.DIVIDER, H + "div")), P.push({
                                    type: "divider",
                                    optID: H
                                })), n = R({
                                    text: l,
                                    optionContent: r,
                                    optionSubtext: h,
                                    optionIcon: u
                                }), N.push(W(j(n, o, a))), P.push({
                                    content: r || l,
                                    subtext: h,
                                    tokens: c,
                                    type: "option",
                                    originalIndex: e,
                                    data: s
                                }), M++
                            }
                            A.selectpicker.main.map.newIndex[e] = L, A.selectpicker.main.map.originalIndex[L] = e;
                            var S = P[P.length - 1];
                            S.disabled = g;
                            var I = 0;
                            S.content && (I += S.content.length), S.subtext && (I += S.subtext.length), u && (I += 1), O < I && (O = I, E = N[N.length - 1])
                        }
                    }
                }), this.selectpicker.main.elements = N, this.selectpicker.main.data = P, this.selectpicker.current = this.selectpicker.main, this.selectpicker.view.widestOption = E, this.selectpicker.view.availableOptionsCount = M
            },
            findLis: function() {
                return this.$menuInner.find(".inner > li")
            },
            render: function() {
                var e = this.$element.find("option"),
                    t = [],
                    i = [];
                this.togglePlaceholder(), this.tabIndex();
                for (var n = 0, s = this.selectpicker.main.elements.length; n < s; n++) {
                    var o = e[this.selectpicker.main.map.originalIndex[n]];
                    if (o && o.selected && (t.push(o), i.length < 100 && "count" !== this.options.selectedTextFormat || 1 === t.length)) {
                        if (this.options.hideDisabled && (o.disabled || "OPTGROUP" === o.parentNode.tagName && o.parentNode.disabled)) return;
                        var a, r, l = this.selectpicker.main.data[n].data,
                            c = l.icon && this.options.showIcon ? '<i class="' + this.options.iconBase + " " + l.icon + '"></i> ' : "";
                        a = this.options.showSubtext && l.subtext && !this.multiple ? ' <small class="text-muted">' + l.subtext + "</small>" : "", r = o.title ? o.title : l.content && this.options.showContent ? l.content.toString() : c + o.innerHTML.trim() + a, i.push(r)
                    }
                }
                var h = this.multiple ? i.join(this.options.multipleSeparator) : i[0];
                if (50 < t.length && (h += "..."), this.multiple && -1 !== this.options.selectedTextFormat.indexOf("count")) {
                    var u = this.options.selectedTextFormat.split(">");
                    if (1 < u.length && t.length > u[1] || 1 === u.length && 2 <= t.length) {
                        var d = this.selectpicker.view.availableOptionsCount;
                        h = ("function" == typeof this.options.countSelectedText ? this.options.countSelectedText(t.length, d) : this.options.countSelectedText).replace("{0}", t.length.toString()).replace("{1}", d.toString())
                    }
                }
                null == this.options.title && (this.options.title = this.$element.attr("title")), "static" == this.options.selectedTextFormat && (h = this.options.title), h = h || (void 0 !== this.options.title ? this.options.title : this.options.noneSelectedText), this.$button[0].title = p(h.replace(/<[^>]*>?/g, "").trim()), this.$button.find(".filter-option-inner-inner")[0].innerHTML = h, this.$element.trigger("rendered.bs.select")
            },
            setStyle: function(e, t) {
                this.$element.attr("class") && this.$newElement.addClass(this.$element.attr("class").replace(/selectpicker|mobile-device|bs-select-hidden|validate\[.*\]/gi, ""));
                var i = e || this.options.style;
                "add" == t ? this.$button.addClass(i) : "remove" == t ? this.$button.removeClass(i) : (this.$button.removeClass(this.options.style), this.$button.addClass(i))
            },
            liHeight: function(e) {
                if (e || !1 !== this.options.size && !this.sizeInfo) {
                    this.sizeInfo || (this.sizeInfo = {});
                    var t = document.createElement("div"),
                        i = document.createElement("div"),
                        n = document.createElement("div"),
                        s = document.createElement("ul"),
                        o = document.createElement("li"),
                        a = document.createElement("li"),
                        r = document.createElement("li"),
                        l = document.createElement("a"),
                        c = document.createElement("span"),
                        h = this.options.header && 0 < this.$menu.find("." + Y.POPOVERHEADER).length ? this.$menu.find("." + Y.POPOVERHEADER)[0].cloneNode(!0) : null,
                        u = this.options.liveSearch ? document.createElement("div") : null,
                        d = this.options.actionsBox && this.multiple && 0 < this.$menu.find(".bs-actionsbox").length ? this.$menu.find(".bs-actionsbox")[0].cloneNode(!0) : null,
                        p = this.options.doneButton && this.multiple && 0 < this.$menu.find(".bs-donebutton").length ? this.$menu.find(".bs-donebutton")[0].cloneNode(!0) : null;
                    if (this.sizeInfo.selectWidth = this.$newElement[0].offsetWidth, c.className = "text", l.className = "dropdown-item " + this.$element.find("option")[0].className, t.className = this.$menu[0].parentNode.className + " " + Y.SHOW, t.style.width = this.sizeInfo.selectWidth + "px", "auto" === this.options.width && (i.style.minWidth = 0), i.className = Y.MENU + " " + Y.SHOW, n.className = "inner " + Y.SHOW, s.className = Y.MENU + " inner " + ("4" === V.major ? Y.SHOW : ""), o.className = Y.DIVIDER, a.className = "dropdown-header", c.appendChild(document.createTextNode("Inner text")), l.appendChild(c), r.appendChild(l), a.appendChild(c.cloneNode(!0)), this.selectpicker.view.widestOption && s.appendChild(this.selectpicker.view.widestOption.cloneNode(!0)), s.appendChild(r), s.appendChild(o), s.appendChild(a), h && i.appendChild(h), u) {
                        var f = document.createElement("input");
                        u.className = "bs-searchbox", f.className = "form-control", u.appendChild(f), i.appendChild(u)
                    }
                    d && i.appendChild(d), n.appendChild(s), i.appendChild(n), p && i.appendChild(p), t.appendChild(i), document.body.appendChild(t);
                    var m, g = l.offsetHeight,
                        v = a ? a.offsetHeight : 0,
                        b = h ? h.offsetHeight : 0,
                        _ = u ? u.offsetHeight : 0,
                        y = d ? d.offsetHeight : 0,
                        w = p ? p.offsetHeight : 0,
                        x = q(o).outerHeight(!0),
                        C = !!window.getComputedStyle && window.getComputedStyle(i),
                        k = i.offsetWidth,
                        D = C ? null : q(i),
                        T = {
                            vert: I(C ? C.paddingTop : D.css("paddingTop")) + I(C ? C.paddingBottom : D.css("paddingBottom")) + I(C ? C.borderTopWidth : D.css("borderTopWidth")) + I(C ? C.borderBottomWidth : D.css("borderBottomWidth")),
                            horiz: I(C ? C.paddingLeft : D.css("paddingLeft")) + I(C ? C.paddingRight : D.css("paddingRight")) + I(C ? C.borderLeftWidth : D.css("borderLeftWidth")) + I(C ? C.borderRightWidth : D.css("borderRightWidth"))
                        },
                        S = {
                            vert: T.vert + I(C ? C.marginTop : D.css("marginTop")) + I(C ? C.marginBottom : D.css("marginBottom")) + 2,
                            horiz: T.horiz + I(C ? C.marginLeft : D.css("marginLeft")) + I(C ? C.marginRight : D.css("marginRight")) + 2
                        };
                    n.style.overflowY = "scroll", m = i.offsetWidth - k, document.body.removeChild(t), this.sizeInfo.liHeight = g, this.sizeInfo.dropdownHeaderHeight = v, this.sizeInfo.headerHeight = b, this.sizeInfo.searchHeight = _, this.sizeInfo.actionsHeight = y, this.sizeInfo.doneButtonHeight = w, this.sizeInfo.dividerHeight = x, this.sizeInfo.menuPadding = T, this.sizeInfo.menuExtras = S, this.sizeInfo.menuWidth = k, this.sizeInfo.totalMenuWidth = this.sizeInfo.menuWidth, this.sizeInfo.scrollBarWidth = m, this.sizeInfo.selectHeight = this.$newElement[0].offsetHeight, this.setPositionData()
                }
            },
            getSelectPosition: function() {
                var e, t = q(window),
                    i = this.$newElement.offset(),
                    n = q(this.options.container);
                this.options.container && !n.is("body") ? ((e = n.offset()).top += parseInt(n.css("borderTopWidth")), e.left += parseInt(n.css("borderLeftWidth"))) : e = {
                    top: 0,
                    left: 0
                };
                var s = this.options.windowPadding;
                this.sizeInfo.selectOffsetTop = i.top - e.top - t.scrollTop(), this.sizeInfo.selectOffsetBot = t.height() - this.sizeInfo.selectOffsetTop - this.sizeInfo.selectHeight - e.top - s[2], this.sizeInfo.selectOffsetLeft = i.left - e.left - t.scrollLeft(), this.sizeInfo.selectOffsetRight = t.width() - this.sizeInfo.selectOffsetLeft - this.sizeInfo.selectWidth - e.left - s[1], this.sizeInfo.selectOffsetTop -= s[0], this.sizeInfo.selectOffsetLeft -= s[3]
            },
            setMenuSize: function(e) {
                this.getSelectPosition();
                var t, i, n, s, o, a, r, l = this.sizeInfo.selectWidth,
                    c = this.sizeInfo.liHeight,
                    h = this.sizeInfo.headerHeight,
                    u = this.sizeInfo.searchHeight,
                    d = this.sizeInfo.actionsHeight,
                    p = this.sizeInfo.doneButtonHeight,
                    f = this.sizeInfo.dividerHeight,
                    m = this.sizeInfo.menuPadding,
                    g = 0;
                if (this.options.dropupAuto && (r = c * this.selectpicker.current.elements.length + m.vert, this.$newElement.toggleClass(Y.DROPUP, this.sizeInfo.selectOffsetTop - this.sizeInfo.selectOffsetBot > this.sizeInfo.menuExtras.vert && r + this.sizeInfo.menuExtras.vert + 50 > this.sizeInfo.selectOffsetBot)), "auto" === this.options.size) s = 3 < this.selectpicker.current.elements.length ? 3 * this.sizeInfo.liHeight + this.sizeInfo.menuExtras.vert - 2 : 0, i = this.sizeInfo.selectOffsetBot - this.sizeInfo.menuExtras.vert, n = s + h + u + d + p, a = Math.max(s - m.vert, 0), this.$newElement.hasClass(Y.DROPUP) && (i = this.sizeInfo.selectOffsetTop - this.sizeInfo.menuExtras.vert), t = (o = i) - h - u - d - p - m.vert;
                else if (this.options.size && "auto" != this.options.size && this.selectpicker.current.elements.length > this.options.size) {
                    for (var v = 0; v < this.options.size; v++) "divider" === this.selectpicker.current.data[v].type && g++;
                    t = (i = c * this.options.size + g * f + m.vert) - m.vert, o = i + h + u + d + p, n = a = ""
                }
                "auto" === this.options.dropdownAlignRight && this.$menu.toggleClass(Y.MENURIGHT, this.sizeInfo.selectOffsetLeft > this.sizeInfo.selectOffsetRight && this.sizeInfo.selectOffsetRight < this.$menu[0].offsetWidth - l), this.$menu.css({
                    "max-height": o + "px",
                    overflow: "hidden",
                    "min-height": n + "px"
                }), this.$menuInner.css({
                    "max-height": t + "px",
                    "overflow-y": "auto",
                    "min-height": a + "px"
                }), this.sizeInfo.menuInnerHeight = t, this.selectpicker.current.data.length && this.selectpicker.current.data[this.selectpicker.current.data.length - 1].position > this.sizeInfo.menuInnerHeight && (this.sizeInfo.hasScrollBar = !0, this.sizeInfo.totalMenuWidth = this.sizeInfo.menuWidth + this.sizeInfo.scrollBarWidth, this.$menu.css("min-width", this.sizeInfo.totalMenuWidth)), this.dropdown && this.dropdown._popper && this.dropdown._popper.update()
            },
            setSize: function(e) {
                if (this.liHeight(e), this.options.header && this.$menu.css("padding-top", 0), !1 !== this.options.size) {
                    var t, i = this,
                        n = q(window),
                        s = 0;
                    this.setMenuSize(), "auto" === this.options.size ? (this.$searchbox.off("input.setMenuSize propertychange.setMenuSize").on("input.setMenuSize propertychange.setMenuSize", function() {
                        return i.setMenuSize()
                    }), n.off("resize.setMenuSize scroll.setMenuSize").on("resize.setMenuSize scroll.setMenuSize", function() {
                        return i.setMenuSize()
                    })) : this.options.size && "auto" != this.options.size && this.selectpicker.current.elements.length > this.options.size && (this.$searchbox.off("input.setMenuSize propertychange.setMenuSize"), n.off("resize.setMenuSize scroll.setMenuSize")), e ? s = this.$menuInner[0].scrollTop : i.multiple || "number" == typeof(t = i.selectpicker.main.map.newIndex[i.$element[0].selectedIndex]) && !1 !== i.options.size && (s = (s = i.sizeInfo.liHeight * t) - i.sizeInfo.menuInnerHeight / 2 + i.sizeInfo.liHeight / 2), i.createView(!1, s)
                }
            },
            setWidth: function() {
                var i = this;
                "auto" === this.options.width ? requestAnimationFrame(function() {
                    i.$menu.css("min-width", "0"), i.liHeight(), i.setMenuSize();
                    var e = i.$newElement.clone().appendTo("body"),
                        t = e.css("width", "auto").children("button").outerWidth();
                    e.remove(), i.sizeInfo.selectWidth = Math.max(i.sizeInfo.totalMenuWidth, t), i.$newElement.css("width", i.sizeInfo.selectWidth + "px")
                }) : "fit" === this.options.width ? (this.$menu.css("min-width", ""), this.$newElement.css("width", "").addClass("fit-width")) : this.options.width ? (this.$menu.css("min-width", ""), this.$newElement.css("width", this.options.width)) : (this.$menu.css("min-width", ""), this.$newElement.css("width", "")), this.$newElement.hasClass("fit-width") && "fit" !== this.options.width && this.$newElement.removeClass("fit-width")
            },
            selectPosition: function() {
                function e(e) {
                    var t = {},
                        i = a.options.display || q.fn.dropdown.Constructor.Default.display;
                    a.$bsContainer.addClass(e.attr("class").replace(/form-control|fit-width/gi, "")).toggleClass(Y.DROPUP, e.hasClass(Y.DROPUP)), n = e.offset(), r.is("body") ? s = {
                        top: 0,
                        left: 0
                    } : ((s = r.offset()).top += parseInt(r.css("borderTopWidth")) - r.scrollTop(), s.left += parseInt(r.css("borderLeftWidth")) - r.scrollLeft()), o = e.hasClass(Y.DROPUP) ? 0 : e[0].offsetHeight, (V.major < 4 || "static" === i) && (t.top = n.top - s.top + o, t.left = n.left - s.left), t.width = e[0].offsetWidth, a.$bsContainer.css(t)
                }
                this.$bsContainer = q('<div class="bs-container" />');
                var n, s, o, a = this,
                    r = q(this.options.container);
                this.$button.on("click.bs.dropdown.data-api", function() {
                    a.isDisabled() || (e(a.$newElement), a.$bsContainer.appendTo(a.options.container).toggleClass(Y.SHOW, !a.$button.hasClass(Y.SHOW)).append(a.$menu))
                }), q(window).on("resize scroll", function() {
                    e(a.$newElement)
                }), this.$element.on("hide.bs.select", function() {
                    a.$menu.data("height", a.$menu.height()), a.$bsContainer.detach()
                })
            },
            setOptionStatus: function() {
                var e = this.$element.find("option");
                if (this.noScroll = !1, this.selectpicker.view.visibleElements && this.selectpicker.view.visibleElements.length)
                    for (var t = 0; t < this.selectpicker.view.visibleElements.length; t++) {
                        var i = this.selectpicker.current.map.originalIndex[t + this.selectpicker.view.position0],
                            n = e[i];
                        if (n) {
                            var s = this.selectpicker.main.map.newIndex[i],
                                o = this.selectpicker.main.elements[s];
                            this.setDisabled(i, n.disabled || "OPTGROUP" === n.parentNode.tagName && n.parentNode.disabled, s, o), this.setSelected(i, n.selected, s, o)
                        }
                    }
            },
            setSelected: function(e, t, i, n) {
                var s, o, a, r = void 0 !== this.activeIndex,
                    l = this.activeIndex === e || t && !this.multiple && !r;
                i = i || this.selectpicker.main.map.newIndex[e], a = (n = n || this.selectpicker.main.elements[i]).firstChild, t && (this.selectedIndex = e), n.classList.toggle("selected", t), n.classList.toggle("active", l), l && (this.selectpicker.view.currentActive = n, this.activeIndex = e), a && (a.classList.toggle("selected", t), a.classList.toggle("active", l), a.setAttribute("aria-selected", t)), l || !r && t && void 0 !== this.prevActiveIndex && (s = this.selectpicker.main.map.newIndex[this.prevActiveIndex], (o = this.selectpicker.main.elements[s]).classList.toggle("selected", t), o.classList.remove("active"), o.firstChild && (o.firstChild.classList.toggle("selected", t), o.firstChild.classList.remove("active")))
            },
            setDisabled: function(e, t, i, n) {
                var s;
                i = i || this.selectpicker.main.map.newIndex[e], s = (n = n || this.selectpicker.main.elements[i]).firstChild, n.classList.toggle(Y.DISABLED, t), s && ("4" === V.major && s.classList.toggle(Y.DISABLED, t), s.setAttribute("aria-disabled", t), t ? s.setAttribute("tabindex", -1) : s.setAttribute("tabindex", 0))
            },
            isDisabled: function() {
                return this.$element[0].disabled
            },
            checkDisabled: function() {
                var e = this;
                this.isDisabled() ? (this.$newElement.addClass(Y.DISABLED), this.$button.addClass(Y.DISABLED).attr("tabindex", -1).attr("aria-disabled", !0)) : (this.$button.hasClass(Y.DISABLED) && (this.$newElement.removeClass(Y.DISABLED), this.$button.removeClass(Y.DISABLED).attr("aria-disabled", !1)), -1 != this.$button.attr("tabindex") || this.$element.data("tabindex") || this.$button.removeAttr("tabindex")), this.$button.click(function() {
                    return !e.isDisabled()
                })
            },
            togglePlaceholder: function() {
                var e = this.$element[0],
                    t = e.selectedIndex,
                    i = -1 === t;
                i || e.options[t].value || (i = !0), this.$button.toggleClass("bs-placeholder", i)
            },
            tabIndex: function() {
                this.$element.data("tabindex") !== this.$element.attr("tabindex") && -98 !== this.$element.attr("tabindex") && "-98" !== this.$element.attr("tabindex") && (this.$element.data("tabindex", this.$element.attr("tabindex")), this.$button.attr("tabindex", this.$element.data("tabindex"))), this.$element.attr("tabindex", -98)
            },
            clickListener: function() {
                var k = this,
                    t = q(document);

                function e() {
                    k.options.liveSearch ? k.$searchbox.focus() : k.$menuInner.focus()
                }

                function i() {
                    k.dropdown && k.dropdown._popper && k.dropdown._popper.state.isCreated ? e() : requestAnimationFrame(i)
                }
                t.data("spaceSelect", !1), this.$button.on("keyup", function(e) {
                    /(32)/.test(e.keyCode.toString(10)) && t.data("spaceSelect") && (e.preventDefault(), t.data("spaceSelect", !1))
                }), this.$newElement.on("show.bs.dropdown", function() {
                    3 < V.major && !k.dropdown && (k.dropdown = k.$button.data("bs.dropdown"), k.dropdown._menu = k.$menu[0])
                }), this.$button.on("click.bs.dropdown.data-api", function() {
                    k.$newElement.hasClass(Y.SHOW) || k.setSize()
                }), this.$element.on("shown.bs.select", function() {
                    k.$menuInner[0].scrollTop !== k.selectpicker.view.scrollTop && (k.$menuInner[0].scrollTop = k.selectpicker.view.scrollTop), 3 < V.major ? requestAnimationFrame(i) : e()
                }), this.$menuInner.on("click", "li a", function(e, t) {
                    var i = q(this),
                        n = k.isVirtual() ? k.selectpicker.view.position0 : 0,
                        s = k.selectpicker.current.map.originalIndex[i.parent().index() + n],
                        o = D(k.$element[0]),
                        a = k.$element.prop("selectedIndex"),
                        r = !0;
                    if (k.multiple && 1 !== k.options.maxOptions && e.stopPropagation(), e.preventDefault(), !k.isDisabled() && !i.parent().hasClass(Y.DISABLED)) {
                        var l = k.$element.find("option"),
                            c = l.eq(s),
                            h = c.prop("selected"),
                            u = c.parent("optgroup"),
                            d = u.find("option"),
                            p = k.options.maxOptions,
                            f = u.data("maxOptions") || !1;
                        if (s === k.activeIndex && (t = !0), t || (k.prevActiveIndex = k.activeIndex, k.activeIndex = void 0), k.multiple) {
                            if (c.prop("selected", !h), k.setSelected(s, !h), i.blur(), !1 !== p || !1 !== f) {
                                var m = p < l.filter(":selected").length,
                                    g = f < u.find("option:selected").length;
                                if (p && m || f && g)
                                    if (p && 1 == p) {
                                        l.prop("selected", !1), c.prop("selected", !0);
                                        for (var v = 0; v < l.length; v++) k.setSelected(v, !1);
                                        k.setSelected(s, !0)
                                    } else if (f && 1 == f) {
                                    for (u.find("option:selected").prop("selected", !1), c.prop("selected", !0), v = 0; v < d.length; v++) {
                                        var b = d[v];
                                        k.setSelected(l.index(b), !1)
                                    }
                                    k.setSelected(s, !0)
                                } else {
                                    var _ = "string" == typeof k.options.maxOptionsText ? [k.options.maxOptionsText, k.options.maxOptionsText] : k.options.maxOptionsText,
                                        y = "function" == typeof _ ? _(p, f) : _,
                                        w = y[0].replace("{n}", p),
                                        x = y[1].replace("{n}", f),
                                        C = q('<div class="notify"></div>');
                                    y[2] && (w = w.replace("{var}", y[2][1 < p ? 0 : 1]), x = x.replace("{var}", y[2][1 < f ? 0 : 1])), c.prop("selected", !1), k.$menu.append(C), p && m && (C.append(q("<div>" + w + "</div>")), r = !1, k.$element.trigger("maxReached.bs.select")), f && g && (C.append(q("<div>" + x + "</div>")), r = !1, k.$element.trigger("maxReachedGrp.bs.select")), setTimeout(function() {
                                        k.setSelected(s, !1)
                                    }, 10), C.delay(750).fadeOut(300, function() {
                                        q(this).remove()
                                    })
                                }
                            }
                        } else l.prop("selected", !1), c.prop("selected", !0), k.setSelected(s, !0);
                        !k.multiple || k.multiple && 1 === k.options.maxOptions ? k.$button.focus() : k.options.liveSearch && k.$searchbox.focus(), r && (o != D(k.$element[0]) && k.multiple || a != k.$element.prop("selectedIndex") && !k.multiple) && (T = [s, c.prop("selected"), o], k.$element.triggerNative("change"))
                    }
                }), this.$menu.on("click", "li." + Y.DISABLED + " a, ." + Y.POPOVERHEADER + ", ." + Y.POPOVERHEADER + " :not(.close)", function(e) {
                    e.currentTarget == this && (e.preventDefault(), e.stopPropagation(), k.options.liveSearch && !q(e.target).hasClass("close") ? k.$searchbox.focus() : k.$button.focus())
                }), this.$menuInner.on("click", ".divider, .dropdown-header", function(e) {
                    e.preventDefault(), e.stopPropagation(), k.options.liveSearch ? k.$searchbox.focus() : k.$button.focus()
                }), this.$menu.on("click", "." + Y.POPOVERHEADER + " .close", function() {
                    k.$button.click()
                }), this.$searchbox.on("click", function(e) {
                    e.stopPropagation()
                }), this.$menu.on("click", ".actions-btn", function(e) {
                    k.options.liveSearch ? k.$searchbox.focus() : k.$button.focus(), e.preventDefault(), e.stopPropagation(), q(this).hasClass("bs-select-all") ? k.selectAll() : k.deselectAll()
                }), this.$element.on({
                    change: function() {
                        k.render(), k.$element.trigger("changed.bs.select", T), T = null
                    },
                    focus: function() {
                        k.$button.focus()
                    }
                })
            },
            liveSearchListener: function() {
                var p = this,
                    f = document.createElement("li");
                this.$button.on("click.bs.dropdown.data-api", function() {
                    p.$searchbox.val() && p.$searchbox.val("")
                }), this.$searchbox.on("click.bs.dropdown.data-api focus.bs.dropdown.data-api touchend.bs.dropdown.data-api", function(e) {
                    e.stopPropagation()
                }), this.$searchbox.on("input propertychange", function() {
                    var e = p.$searchbox.val();
                    if (p.selectpicker.search.map.newIndex = {}, p.selectpicker.search.map.originalIndex = {}, p.selectpicker.search.elements = [], p.selectpicker.search.data = [], e) {
                        var t = [],
                            i = e.toUpperCase(),
                            n = {},
                            s = [],
                            o = p._searchStyle(),
                            a = p.options.liveSearchNormalize;
                        p._$lisSelected = p.$menuInner.find(".selected");
                        for (var r = 0; r < p.selectpicker.main.data.length; r++) {
                            var l = p.selectpicker.main.data[r];
                            n[r] || (n[r] = C(l, i, o, a)), n[r] && void 0 !== l.headerIndex && -1 === s.indexOf(l.headerIndex) && (0 < l.headerIndex && (n[l.headerIndex - 1] = !0, s.push(l.headerIndex - 1)), n[l.headerIndex] = !0, s.push(l.headerIndex), n[l.lastIndex + 1] = !0), n[r] && "optgroup-label" !== l.type && s.push(r)
                        }
                        r = 0;
                        for (var c = s.length; r < c; r++) {
                            var h = s[r],
                                u = s[r - 1],
                                d = (l = p.selectpicker.main.data[h], p.selectpicker.main.data[u]);
                            ("divider" !== l.type || "divider" === l.type && d && "divider" !== d.type && c - 1 !== r) && (p.selectpicker.search.data.push(l), t.push(p.selectpicker.main.elements[h]), l.hasOwnProperty("originalIndex") && (p.selectpicker.search.map.newIndex[l.originalIndex] = t.length - 1, p.selectpicker.search.map.originalIndex[t.length - 1] = l.originalIndex))
                        }
                        p.activeIndex = void 0, p.noScroll = !0, p.$menuInner.scrollTop(0), p.selectpicker.search.elements = t, p.createView(!0), t.length || (f.className = "no-results", f.innerHTML = p.options.noneResultsText.replace("{0}", '"' + U(e) + '"'), p.$menuInner[0].firstChild.appendChild(f))
                    } else p.$menuInner.scrollTop(0), p.createView(!1)
                })
            },
            _searchStyle: function() {
                return this.options.liveSearchStyle || "contains"
            },
            val: function(e) {
                return void 0 !== e ? (this.$element.val(e).triggerNative("change"), this.$element) : this.$element.val()
            },
            changeAll: function(e) {
                if (this.multiple) {
                    void 0 === e && (e = !0);
                    var t = this.$element.find("option"),
                        i = 0,
                        n = 0,
                        s = D(this.$element[0]);
                    this.$element.addClass("bs-select-hidden");
                    for (var o = 0; o < this.selectpicker.current.elements.length; o++) {
                        var a = this.selectpicker.current.data[o],
                            r = t[this.selectpicker.current.map.originalIndex[o]];
                        r && !r.disabled && "divider" !== a.type && (r.selected && i++, r.selected = e, r.selected && n++)
                    }
                    this.$element.removeClass("bs-select-hidden"), i !== n && (this.setOptionStatus(), this.togglePlaceholder(), T = [null, null, s], this.$element.triggerNative("change"))
                }
            },
            selectAll: function() {
                return this.changeAll(!0)
            },
            deselectAll: function() {
                return this.changeAll(!1)
            },
            toggle: function(e) {
                (e = e || window.event) && e.stopPropagation(), this.$button.trigger("click.bs.dropdown.data-api")
            },
            keydown: function(e) {
                var t, i, n, s, o, a = q(this),
                    r = a.hasClass("dropdown-toggle"),
                    l = (r ? a.closest(".dropdown") : a.closest(S.MENU)).data("this"),
                    c = l.findLis(),
                    h = !1,
                    u = 9 === e.which && !r && !l.options.selectOnTab,
                    d = E.test(e.which) || u,
                    p = l.$menuInner[0].scrollTop,
                    f = l.isVirtual(),
                    m = !0 === f ? l.selectpicker.view.position0 : 0;
                if (!(i = l.$newElement.hasClass(Y.SHOW)) && (d || 48 <= e.which && e.which <= 57 || 96 <= e.which && e.which <= 105 || 65 <= e.which && e.which <= 90) && l.$button.trigger("click.bs.dropdown.data-api"), 27 === e.which && i && (e.preventDefault(), l.$button.trigger("click.bs.dropdown.data-api").focus()), d) {
                    if (!c.length) return;
                    void 0 === (t = !0 === f ? c.index(c.filter(".active")) : l.selectpicker.current.map.newIndex[l.activeIndex]) && (t = -1), -1 !== t && ((n = l.selectpicker.current.elements[t + m]).classList.remove("active"), n.firstChild && n.firstChild.classList.remove("active")), 38 === e.which ? (-1 !== t && t--, t + m < 0 && (t += c.length), l.selectpicker.view.canHighlight[t + m] || -1 == (t = l.selectpicker.view.canHighlight.slice(0, t + m).lastIndexOf(!0) - m) && (t = c.length - 1)) : 40 !== e.which && !u || (++t + m >= l.selectpicker.view.canHighlight.length && (t = 0), l.selectpicker.view.canHighlight[t + m] || (t = t + 1 + l.selectpicker.view.canHighlight.slice(t + m + 1).indexOf(!0))), e.preventDefault();
                    var g = m + t;
                    38 === e.which ? 0 === m && t === c.length - 1 ? (l.$menuInner[0].scrollTop = l.$menuInner[0].scrollHeight, g = l.selectpicker.current.elements.length - 1) : h = (o = (s = l.selectpicker.current.data[g]).position - s.height) < p : 40 !== e.which && !u || (0 === t ? g = l.$menuInner[0].scrollTop = 0 : h = p < (o = (s = l.selectpicker.current.data[g]).position - l.sizeInfo.menuInnerHeight)), (n = l.selectpicker.current.elements[g]) && (n.classList.add("active"), n.firstChild && n.firstChild.classList.add("active")), l.activeIndex = l.selectpicker.current.map.originalIndex[g], l.selectpicker.view.currentActive = n, h && (l.$menuInner[0].scrollTop = o), l.options.liveSearch ? l.$searchbox.focus() : a.focus()
                } else if (!a.is("input") && !A.test(e.which) || 32 === e.which && l.selectpicker.keydown.keyHistory) {
                    var v, b, _ = [];
                    e.preventDefault(), l.selectpicker.keydown.keyHistory += k[e.which], l.selectpicker.keydown.resetKeyHistory.cancel && clearTimeout(l.selectpicker.keydown.resetKeyHistory.cancel), l.selectpicker.keydown.resetKeyHistory.cancel = l.selectpicker.keydown.resetKeyHistory.start(), b = l.selectpicker.keydown.keyHistory, /^(.)\1+$/.test(b) && (b = b.charAt(0));
                    for (var y = 0; y < l.selectpicker.current.data.length; y++) {
                        var w = l.selectpicker.current.data[y];
                        C(w, b, "startsWith", !0) && l.selectpicker.view.canHighlight[y] && (w.index = y, _.push(w.originalIndex))
                    }
                    if (_.length) {
                        var x = 0;
                        c.removeClass("active").find("a").removeClass("active"), 1 === b.length && (-1 === (x = _.indexOf(l.activeIndex)) || x === _.length - 1 ? x = 0 : x++), v = l.selectpicker.current.map.newIndex[_[x]], h = 0 < p - (s = l.selectpicker.current.data[v]).position ? (o = s.position - s.height, !0) : (o = s.position - l.sizeInfo.menuInnerHeight, s.position > p + l.sizeInfo.menuInnerHeight), (n = l.selectpicker.current.elements[v]).classList.add("active"), n.firstChild && n.firstChild.classList.add("active"), l.activeIndex = _[x], n.firstChild.focus(), h && (l.$menuInner[0].scrollTop = o), a.focus()
                    }
                }
                i && (32 === e.which && !l.selectpicker.keydown.keyHistory || 13 === e.which || 9 === e.which && l.options.selectOnTab) && (32 !== e.which && e.preventDefault(), l.options.liveSearch && 32 === e.which || (l.$menuInner.find(".active a").trigger("click", !0), a.focus(), l.options.liveSearch || (e.preventDefault(), q(document).data("spaceSelect", !0))))
            },
            mobile: function() {
                this.$element.addClass("mobile-device")
            },
            refresh: function() {
                var e = q.extend({}, this.options, this.$element.data());
                this.options = e, this.selectpicker.main.map.newIndex = {}, this.selectpicker.main.map.originalIndex = {}, this.createLi(), this.checkDisabled(), this.render(), this.setStyle(), this.setWidth(), this.setSize(!0), this.$element.trigger("refreshed.bs.select")
            },
            hide: function() {
                this.$newElement.hide()
            },
            show: function() {
                this.$newElement.show()
            },
            remove: function() {
                this.$newElement.remove(), this.$element.remove()
            },
            destroy: function() {
                this.$newElement.before(this.$element).remove(), this.$bsContainer ? this.$bsContainer.remove() : this.$menu.remove(), this.$element.off(".bs.select").removeData("selectpicker").removeClass("bs-select-hidden selectpicker")
            }
        };
        var u = q.fn.selectpicker;
        q.fn.selectpicker = r, q.fn.selectpicker.Constructor = l, q.fn.selectpicker.noConflict = function() {
            return q.fn.selectpicker = u, this
        }, q(document).off("keydown.bs.dropdown.data-api").on("keydown.bs.select", '.bootstrap-select [data-toggle="dropdown"], .bootstrap-select [role="listbox"], .bs-searchbox input', l.prototype.keydown).on("focusin.modal", '.bootstrap-select [data-toggle="dropdown"], .bootstrap-select [role="listbox"], .bs-searchbox input', function(e) {
            e.stopPropagation()
        }), q(window).on("load.bs.select.data-api", function() {
            q(".selectpicker").each(function() {
                var e = q(this);
                r.call(e, e.data())
            })
        })
    }(e)
}),
function(w) {
    var i = !0;
    w.flexslider = function(p, e) {
        var f = w(p);
        f.vars = w.extend({}, w.flexslider.defaults, e);
        var t, h = f.vars.namespace,
            m = window.navigator && window.navigator.msPointerEnabled && window.MSGesture,
            u = ("ontouchstart" in window || m || window.DocumentTouch && document instanceof DocumentTouch) && f.vars.touch,
            a = "click touchend MSPointerUp keyup",
            r = "",
            g = "vertical" === f.vars.direction,
            v = f.vars.reverse,
            b = 0 < f.vars.itemWidth,
            _ = "fade" === f.vars.animation,
            d = "" !== f.vars.asNavFor,
            y = {};
        w.data(p, "flexslider", f), y = {
            init: function() {
                f.animating = !1, f.currentSlide = parseInt(f.vars.startAt ? f.vars.startAt : 0, 10), isNaN(f.currentSlide) && (f.currentSlide = 0), f.animatingTo = f.currentSlide, f.atEnd = 0 === f.currentSlide || f.currentSlide === f.last, f.containerSelector = f.vars.selector.substr(0, f.vars.selector.search(" ")), f.slides = w(f.vars.selector, f), f.container = w(f.containerSelector, f), f.count = f.slides.length, f.syncExists = 0 < w(f.vars.sync).length, "slide" === f.vars.animation && (f.vars.animation = "swing"), f.prop = g ? "top" : "marginLeft", f.args = {}, f.manualPause = !1, f.stopped = !1, f.started = !1, f.startTimeout = null, f.transitions = !f.vars.video && !_ && f.vars.useCSS && function() {
                    var e = document.createElement("div"),
                        t = ["perspectiveProperty", "WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
                    for (var i in t)
                        if (void 0 !== e.style[t[i]]) return f.pfx = t[i].replace("Perspective", "").toLowerCase(), f.prop = "-" + f.pfx + "-transform", !0;
                    return !1
                }(), (f.ensureAnimationEnd = "") !== f.vars.controlsContainer && (f.controlsContainer = 0 < w(f.vars.controlsContainer).length && w(f.vars.controlsContainer)), "" !== f.vars.manualControls && (f.manualControls = 0 < w(f.vars.manualControls).length && w(f.vars.manualControls)), "" !== f.vars.customDirectionNav && (f.customDirectionNav = 2 === w(f.vars.customDirectionNav).length && w(f.vars.customDirectionNav)), f.vars.randomize && (f.slides.sort(function() {
                    return Math.round(Math.random()) - .5
                }), f.container.empty().append(f.slides)), f.doMath(), f.setup("init"), f.vars.controlNav && y.controlNav.setup(), f.vars.directionNav && y.directionNav.setup(), f.vars.keyboard && (1 === w(f.containerSelector).length || f.vars.multipleKeyboard) && w(document).bind("keyup", function(e) {
                    var t = e.keyCode;
                    if (!f.animating && (39 === t || 37 === t)) {
                        var i = 39 === t ? f.getTarget("next") : 37 === t && f.getTarget("prev");
                        f.flexAnimate(i, f.vars.pauseOnAction)
                    }
                }), f.vars.mousewheel && f.bind("mousewheel", function(e, t, i, n) {
                    e.preventDefault();
                    var s = t < 0 ? f.getTarget("next") : f.getTarget("prev");
                    f.flexAnimate(s, f.vars.pauseOnAction)
                }), f.vars.pausePlay && y.pausePlay.setup(), f.vars.slideshow && f.vars.pauseInvisible && y.pauseInvisible.init(), f.vars.slideshow && (f.vars.pauseOnHover && f.hover(function() {
                    f.manualPlay || f.manualPause || f.pause()
                }, function() {
                    f.manualPause || f.manualPlay || f.stopped || f.play()
                }), f.vars.pauseInvisible && y.pauseInvisible.isHidden() || (0 < f.vars.initDelay ? f.startTimeout = setTimeout(f.play, f.vars.initDelay) : f.play())), d && y.asNav.setup(), u && f.vars.touch && y.touch(), (!_ || _ && f.vars.smoothHeight) && w(window).bind("resize orientationchange focus", y.resize), f.find("img").attr("draggable", "false"), setTimeout(function() {
                    f.vars.start(f)
                }, 200)
            },
            asNav: {
                setup: function() {
                    f.asNav = !0, f.animatingTo = Math.floor(f.currentSlide / f.move), f.currentItem = f.currentSlide, f.slides.removeClass(h + "active-slide").eq(f.currentItem).addClass(h + "active-slide"), m ? (p._slider = f).slides.each(function() {
                        this._gesture = new MSGesture, (this._gesture.target = this).addEventListener("MSPointerDown", function(e) {
                            e.preventDefault(), e.currentTarget._gesture && e.currentTarget._gesture.addPointer(e.pointerId)
                        }, !1), this.addEventListener("MSGestureTap", function(e) {
                            e.preventDefault();
                            var t = w(this),
                                i = t.index();
                            w(f.vars.asNavFor).data("flexslider").animating || t.hasClass("active") || (f.direction = f.currentItem < i ? "next" : "prev", f.flexAnimate(i, f.vars.pauseOnAction, !1, !0, !0))
                        })
                    }) : f.slides.on(a, function(e) {
                        e.preventDefault();
                        var t = w(this),
                            i = t.index();
                        t.offset().left - w(f).scrollLeft() <= 0 && t.hasClass(h + "active-slide") ? f.flexAnimate(f.getTarget("prev"), !0) : w(f.vars.asNavFor).data("flexslider").animating || t.hasClass(h + "active-slide") || (f.direction = f.currentItem < i ? "next" : "prev", f.flexAnimate(i, f.vars.pauseOnAction, !1, !0, !0))
                    })
                }
            },
            controlNav: {
                setup: function() {
                    f.manualControls ? y.controlNav.setupManual() : y.controlNav.setupPaging()
                },
                setupPaging: function() {
                    var e, t, i = "thumbnails" === f.vars.controlNav ? "control-thumbs" : "control-paging",
                        n = 1;
                    if (f.controlNavScaffold = w('<ol class="' + h + "control-nav " + h + i + '"></ol>'), 1 < f.pagingCount)
                        for (var s = 0; s < f.pagingCount; s++) {
                            if (void 0 === (t = f.slides.eq(s)).attr("data-thumb-alt") && t.attr("data-thumb-alt", ""), altText = "" !== t.attr("data-thumb-alt") ? altText = ' alt="' + t.attr("data-thumb-alt") + '"' : "", e = "thumbnails" === f.vars.controlNav ? '<img src="' + t.attr("data-thumb") + '"' + altText + "/>" : '<a href="#">' + n + "</a>", "thumbnails" === f.vars.controlNav && !0 === f.vars.thumbCaptions) {
                                var o = t.attr("data-thumbcaption");
                                "" !== o && void 0 !== o && (e += '<span class="' + h + 'caption">' + o + "</span>")
                            }
                            f.controlNavScaffold.append("<li>" + e + "</li>"), n++
                        }
                    f.controlsContainer ? w(f.controlsContainer).append(f.controlNavScaffold) : f.append(f.controlNavScaffold), y.controlNav.set(), y.controlNav.active(), f.controlNavScaffold.delegate("a, img", a, function(e) {
                        if (e.preventDefault(), "" === r || r === e.type) {
                            var t = w(this),
                                i = f.controlNav.index(t);
                            t.hasClass(h + "active") || (f.direction = i > f.currentSlide ? "next" : "prev", f.flexAnimate(i, f.vars.pauseOnAction))
                        }
                        "" === r && (r = e.type), y.setToClearWatchedEvent()
                    })
                },
                setupManual: function() {
                    f.controlNav = f.manualControls, y.controlNav.active(), f.controlNav.bind(a, function(e) {
                        if (e.preventDefault(), "" === r || r === e.type) {
                            var t = w(this),
                                i = f.controlNav.index(t);
                            t.hasClass(h + "active") || (i > f.currentSlide ? f.direction = "next" : f.direction = "prev", f.flexAnimate(i, f.vars.pauseOnAction))
                        }
                        "" === r && (r = e.type), y.setToClearWatchedEvent()
                    })
                },
                set: function() {
                    var e = "thumbnails" === f.vars.controlNav ? "img" : "a";
                    f.controlNav = w("." + h + "control-nav li " + e, f.controlsContainer ? f.controlsContainer : f)
                },
                active: function() {
                    f.controlNav.removeClass(h + "active").eq(f.animatingTo).addClass(h + "active")
                },
                update: function(e, t) {
                    1 < f.pagingCount && "add" === e ? f.controlNavScaffold.append(w('<li><a href="#">' + f.count + "</a></li>")) : 1 === f.pagingCount ? f.controlNavScaffold.find("li").remove() : f.controlNav.eq(t).closest("li").remove(), y.controlNav.set(), 1 < f.pagingCount && f.pagingCount !== f.controlNav.length ? f.update(t, e) : y.controlNav.active()
                }
            },
            directionNav: {
                setup: function() {
                    var e = w('<ul class="' + h + 'direction-nav"><li class="' + h + 'nav-prev"><a class="' + h + 'prev" href="#">' + f.vars.prevText + '</a></li><li class="' + h + 'nav-next"><a class="' + h + 'next" href="#">' + f.vars.nextText + "</a></li></ul>");
                    f.customDirectionNav ? f.directionNav = f.customDirectionNav : f.controlsContainer ? (w(f.controlsContainer).append(e), f.directionNav = w("." + h + "direction-nav li a", f.controlsContainer)) : (f.append(e), f.directionNav = w("." + h + "direction-nav li a", f)), y.directionNav.update(), f.directionNav.bind(a, function(e) {
                        var t;
                        e.preventDefault(), "" !== r && r !== e.type || (t = w(this).hasClass(h + "next") ? f.getTarget("next") : f.getTarget("prev"), f.flexAnimate(t, f.vars.pauseOnAction)), "" === r && (r = e.type), y.setToClearWatchedEvent()
                    })
                },
                update: function() {
                    var e = h + "disabled";
                    1 === f.pagingCount ? f.directionNav.addClass(e).attr("tabindex", "-1") : f.vars.animationLoop ? f.directionNav.removeClass(e).removeAttr("tabindex") : 0 === f.animatingTo ? f.directionNav.removeClass(e).filter("." + h + "prev").addClass(e).attr("tabindex", "-1") : f.animatingTo === f.last ? f.directionNav.removeClass(e).filter("." + h + "next").addClass(e).attr("tabindex", "-1") : f.directionNav.removeClass(e).removeAttr("tabindex")
                }
            },
            pausePlay: {
                setup: function() {
                    var e = w('<div class="' + h + 'pauseplay"><a href="#"></a></div>');
                    f.controlsContainer ? (f.controlsContainer.append(e), f.pausePlay = w("." + h + "pauseplay a", f.controlsContainer)) : (f.append(e), f.pausePlay = w("." + h + "pauseplay a", f)), y.pausePlay.update(f.vars.slideshow ? h + "pause" : h + "play"), f.pausePlay.bind(a, function(e) {
                        e.preventDefault(), "" !== r && r !== e.type || (w(this).hasClass(h + "pause") ? (f.manualPause = !0, f.manualPlay = !1, f.pause()) : (f.manualPause = !1, f.manualPlay = !0, f.play())), "" === r && (r = e.type), y.setToClearWatchedEvent()
                    })
                },
                update: function(e) {
                    "play" === e ? f.pausePlay.removeClass(h + "pause").addClass(h + "play").html(f.vars.playText) : f.pausePlay.removeClass(h + "play").addClass(h + "pause").html(f.vars.pauseText)
                }
            },
            touch: function() {
                var s, o, a, r, l, c, e, n, h, u = !1,
                    t = 0,
                    i = 0,
                    d = 0;
                m ? (p.style.msTouchAction = "none", p._gesture = new MSGesture, (p._gesture.target = p).addEventListener("MSPointerDown", function(e) {
                    e.stopPropagation(), f.animating ? e.preventDefault() : (f.pause(), p._gesture.addPointer(e.pointerId), d = 0, r = g ? f.h : f.w, c = Number(new Date), a = b && v && f.animatingTo === f.last ? 0 : b && v ? f.limit - (f.itemW + f.vars.itemMargin) * f.move * f.animatingTo : b && f.currentSlide === f.last ? f.limit : b ? (f.itemW + f.vars.itemMargin) * f.move * f.currentSlide : v ? (f.last - f.currentSlide + f.cloneOffset) * r : (f.currentSlide + f.cloneOffset) * r)
                }, !1), p._slider = f, p.addEventListener("MSGestureChange", function(e) {
                    e.stopPropagation();
                    var t = e.target._slider;
                    if (t) {
                        var i = -e.translationX,
                            n = -e.translationY;
                        l = d += g ? n : i, u = g ? Math.abs(d) < Math.abs(-i) : Math.abs(d) < Math.abs(-n), e.detail !== e.MSGESTURE_FLAG_INERTIA ? (!u || 500 < Number(new Date) - c) && (e.preventDefault(), !_ && t.transitions && (t.vars.animationLoop || (l = d / (0 === t.currentSlide && d < 0 || t.currentSlide === t.last && 0 < d ? Math.abs(d) / r + 2 : 1)), t.setProps(a + l, "setTouch"))) : setImmediate(function() {
                            p._gesture.stop()
                        })
                    }
                }, !1), p.addEventListener("MSGestureEnd", function(e) {
                    e.stopPropagation();
                    var t = e.target._slider;
                    if (t) {
                        if (t.animatingTo === t.currentSlide && !u && null !== l) {
                            var i = v ? -l : l,
                                n = 0 < i ? t.getTarget("next") : t.getTarget("prev");
                            t.canAdvance(n) && (Number(new Date) - c < 550 && 50 < Math.abs(i) || Math.abs(i) > r / 2) ? t.flexAnimate(n, t.vars.pauseOnAction) : _ || t.flexAnimate(t.currentSlide, t.vars.pauseOnAction, !0)
                        }
                        a = l = o = s = null, d = 0
                    }
                }, !1)) : (e = function(e) {
                    f.animating ? e.preventDefault() : !window.navigator.msPointerEnabled && 1 !== e.touches.length || (f.pause(), r = g ? f.h : f.w, c = Number(new Date), t = e.touches[0].pageX, i = e.touches[0].pageY, a = b && v && f.animatingTo === f.last ? 0 : b && v ? f.limit - (f.itemW + f.vars.itemMargin) * f.move * f.animatingTo : b && f.currentSlide === f.last ? f.limit : b ? (f.itemW + f.vars.itemMargin) * f.move * f.currentSlide : v ? (f.last - f.currentSlide + f.cloneOffset) * r : (f.currentSlide + f.cloneOffset) * r, s = g ? i : t, o = g ? t : i, p.addEventListener("touchmove", n, !1), p.addEventListener("touchend", h, !1))
                }, n = function(e) {
                    t = e.touches[0].pageX, i = e.touches[0].pageY, l = g ? s - i : s - t, (!(u = g ? Math.abs(l) < Math.abs(t - o) : Math.abs(l) < Math.abs(i - o)) || 500 < Number(new Date) - c) && (e.preventDefault(), !_ && f.transitions && (f.vars.animationLoop || (l /= 0 === f.currentSlide && l < 0 || f.currentSlide === f.last && 0 < l ? Math.abs(l) / r + 2 : 1), f.setProps(a + l, "setTouch")))
                }, h = function(e) {
                    if (p.removeEventListener("touchmove", n, !1), f.animatingTo === f.currentSlide && !u && null !== l) {
                        var t = v ? -l : l,
                            i = 0 < t ? f.getTarget("next") : f.getTarget("prev");
                        f.canAdvance(i) && (Number(new Date) - c < 550 && 50 < Math.abs(t) || Math.abs(t) > r / 2) ? f.flexAnimate(i, f.vars.pauseOnAction) : _ || f.flexAnimate(f.currentSlide, f.vars.pauseOnAction, !0)
                    }
                    p.removeEventListener("touchend", h, !1), a = l = o = s = null
                }, p.addEventListener("touchstart", e, !1))
            },
            resize: function() {
                !f.animating && f.is(":visible") && (b || f.doMath(), _ ? y.smoothHeight() : b ? (f.slides.width(f.computedW), f.update(f.pagingCount), f.setProps()) : g ? (f.viewport.height(f.h), f.setProps(f.h, "setTotal")) : (f.vars.smoothHeight && y.smoothHeight(), f.newSlides.width(f.computedW), f.setProps(f.computedW, "setTotal")))
            },
            smoothHeight: function(e) {
                if (!g || _) {
                    var t = _ ? f : f.viewport;
                    e ? t.animate({
                        height: f.slides.eq(f.animatingTo).height()
                    }, e) : t.height(f.slides.eq(f.animatingTo).height())
                }
            },
            sync: function(e) {
                var t = w(f.vars.sync).data("flexslider"),
                    i = f.animatingTo;
                switch (e) {
                    case "animate":
                        t.flexAnimate(i, f.vars.pauseOnAction, !1, !0);
                        break;
                    case "play":
                        t.playing || t.asNav || t.play();
                        break;
                    case "pause":
                        t.pause()
                }
            },
            uniqueID: function(e) {
                return e.filter("[id]").add(e.find("[id]")).each(function() {
                    var e = w(this);
                    e.attr("id", e.attr("id") + "_clone")
                }), e
            },
            pauseInvisible: {
                visProp: null,
                init: function() {
                    var e = y.pauseInvisible.getHiddenProp();
                    if (e) {
                        var t = e.replace(/[H|h]idden/, "") + "visibilitychange";
                        document.addEventListener(t, function() {
                            y.pauseInvisible.isHidden() ? f.startTimeout ? clearTimeout(f.startTimeout) : f.pause() : f.started ? f.play() : 0 < f.vars.initDelay ? setTimeout(f.play, f.vars.initDelay) : f.play()
                        })
                    }
                },
                isHidden: function() {
                    var e = y.pauseInvisible.getHiddenProp();
                    return !!e && document[e]
                },
                getHiddenProp: function() {
                    var e = ["webkit", "moz", "ms", "o"];
                    if ("hidden" in document) return "hidden";
                    for (var t = 0; t < e.length; t++)
                        if (e[t] + "Hidden" in document) return e[t] + "Hidden";
                    return null
                }
            },
            setToClearWatchedEvent: function() {
                clearTimeout(t), t = setTimeout(function() {
                    r = ""
                }, 3e3)
            }
        }, f.flexAnimate = function(e, t, i, n, s) {
            if (f.vars.animationLoop || e === f.currentSlide || (f.direction = e > f.currentSlide ? "next" : "prev"), d && 1 === f.pagingCount && (f.direction = f.currentItem < e ? "next" : "prev"), !f.animating && (f.canAdvance(e, s) || i) && f.is(":visible")) {
                if (d && n) {
                    var o = w(f.vars.asNavFor).data("flexslider");
                    if (f.atEnd = 0 === e || e === f.count - 1, o.flexAnimate(e, !0, !1, !0, s), f.direction = f.currentItem < e ? "next" : "prev", o.direction = f.direction, Math.ceil((e + 1) / f.visible) - 1 === f.currentSlide || 0 === e) return f.currentItem = e, f.slides.removeClass(h + "active-slide").eq(e).addClass(h + "active-slide"), !1;
                    f.currentItem = e, f.slides.removeClass(h + "active-slide").eq(e).addClass(h + "active-slide"), e = Math.floor(e / f.visible)
                }
                if (f.animating = !0, f.animatingTo = e, t && f.pause(), f.vars.before(f), f.syncExists && !s && y.sync("animate"), f.vars.controlNav && y.controlNav.active(), b || f.slides.removeClass(h + "active-slide").eq(e).addClass(h + "active-slide"), f.atEnd = 0 === e || e === f.last, f.vars.directionNav && y.directionNav.update(), e === f.last && (f.vars.end(f), f.vars.animationLoop || f.pause()), _) u ? (f.slides.eq(f.currentSlide).css({
                    opacity: 0,
                    zIndex: 1
                }), f.slides.eq(e).css({
                    opacity: 1,
                    zIndex: 2
                }), f.wrapup(c)) : (f.slides.eq(f.currentSlide).css({
                    zIndex: 1
                }).animate({
                    opacity: 0
                }, f.vars.animationSpeed, f.vars.easing), f.slides.eq(e).css({
                    zIndex: 2
                }).animate({
                    opacity: 1
                }, f.vars.animationSpeed, f.vars.easing, f.wrapup));
                else {
                    var a, r, l, c = g ? f.slides.filter(":first").height() : f.computedW;
                    r = b ? (a = f.vars.itemMargin, (l = (f.itemW + a) * f.move * f.animatingTo) > f.limit && 1 !== f.visible ? f.limit : l) : 0 === f.currentSlide && e === f.count - 1 && f.vars.animationLoop && "next" !== f.direction ? v ? (f.count + f.cloneOffset) * c : 0 : f.currentSlide === f.last && 0 === e && f.vars.animationLoop && "prev" !== f.direction ? v ? 0 : (f.count + 1) * c : v ? (f.count - 1 - e + f.cloneOffset) * c : (e + f.cloneOffset) * c, f.setProps(r, "", f.vars.animationSpeed), f.transitions ? (f.vars.animationLoop && f.atEnd || (f.animating = !1, f.currentSlide = f.animatingTo), f.container.unbind("webkitTransitionEnd transitionend"), f.container.bind("webkitTransitionEnd transitionend", function() {
                        clearTimeout(f.ensureAnimationEnd), f.wrapup(c)
                    }), clearTimeout(f.ensureAnimationEnd), f.ensureAnimationEnd = setTimeout(function() {
                        f.wrapup(c)
                    }, f.vars.animationSpeed + 100)) : f.container.animate(f.args, f.vars.animationSpeed, f.vars.easing, function() {
                        f.wrapup(c)
                    })
                }
                f.vars.smoothHeight && y.smoothHeight(f.vars.animationSpeed)
            }
        }, f.wrapup = function(e) {
            _ || b || (0 === f.currentSlide && f.animatingTo === f.last && f.vars.animationLoop ? f.setProps(e, "jumpEnd") : f.currentSlide === f.last && 0 === f.animatingTo && f.vars.animationLoop && f.setProps(e, "jumpStart")), f.animating = !1, f.currentSlide = f.animatingTo, f.vars.after(f)
        }, f.animateSlides = function() {
            !f.animating && i && f.flexAnimate(f.getTarget("next"))
        }, f.pause = function() {
            clearInterval(f.animatedSlides), f.animatedSlides = null, f.playing = !1, f.vars.pausePlay && y.pausePlay.update("play"), f.syncExists && y.sync("pause")
        }, f.play = function() {
            f.playing && clearInterval(f.animatedSlides), f.animatedSlides = f.animatedSlides || setInterval(f.animateSlides, f.vars.slideshowSpeed), f.started = f.playing = !0, f.vars.pausePlay && y.pausePlay.update("pause"), f.syncExists && y.sync("play")
        }, f.stop = function() {
            f.pause(), f.stopped = !0
        }, f.canAdvance = function(e, t) {
            var i = d ? f.pagingCount - 1 : f.last;
            return !(!t && (!d || f.currentItem !== f.count - 1 || 0 !== e || "prev" !== f.direction) && (d && 0 === f.currentItem && e === f.pagingCount - 1 && "next" !== f.direction || e === f.currentSlide && !d || !f.vars.animationLoop && (f.atEnd && 0 === f.currentSlide && e === i && "next" !== f.direction || f.atEnd && f.currentSlide === i && 0 === e && "next" === f.direction)))
        }, f.getTarget = function(e) {
            return "next" === (f.direction = e) ? f.currentSlide === f.last ? 0 : f.currentSlide + 1 : 0 === f.currentSlide ? f.last : f.currentSlide - 1
        }, f.setProps = function(e, t, i) {
            var n, s = (n = e || (f.itemW + f.vars.itemMargin) * f.move * f.animatingTo, -1 * function() {
                if (b) return "setTouch" === t ? e : v && f.animatingTo === f.last ? 0 : v ? f.limit - (f.itemW + f.vars.itemMargin) * f.move * f.animatingTo : f.animatingTo === f.last ? f.limit : n;
                switch (t) {
                    case "setTotal":
                        return v ? (f.count - 1 - f.currentSlide + f.cloneOffset) * e : (f.currentSlide + f.cloneOffset) * e;
                    case "setTouch":
                        return e;
                    case "jumpEnd":
                        return v ? e : f.count * e;
                    case "jumpStart":
                        return v ? f.count * e : e;
                    default:
                        return e
                }
            }() + "px");
            f.transitions && (s = g ? "translate3d(0," + s + ",0)" : "translate3d(" + s + ",0,0)", i = void 0 !== i ? i / 1e3 + "s" : "0s", f.container.css("-" + f.pfx + "-transition-duration", i), f.container.css("transition-duration", i)), f.args[f.prop] = s, !f.transitions && void 0 !== i || f.container.css(f.args), f.container.css("transform", s)
        }, f.setup = function(e) {
            var t, i;
            _ ? (f.slides.css({
                width: "100%",
                float: "left",
                marginRight: "-100%",
                position: "relative"
            }), "init" === e && (u ? f.slides.css({
                opacity: 0,
                display: "block",
                webkitTransition: "opacity " + f.vars.animationSpeed / 1e3 + "s ease",
                zIndex: 1
            }).eq(f.currentSlide).css({
                opacity: 1,
                zIndex: 2
            }) : 0 == f.vars.fadeFirstSlide ? f.slides.css({
                opacity: 0,
                display: "block",
                zIndex: 1
            }).eq(f.currentSlide).css({
                zIndex: 2
            }).css({
                opacity: 1
            }) : f.slides.css({
                opacity: 0,
                display: "block",
                zIndex: 1
            }).eq(f.currentSlide).css({
                zIndex: 2
            }).animate({
                opacity: 1
            }, f.vars.animationSpeed, f.vars.easing)), f.vars.smoothHeight && y.smoothHeight()) : ("init" === e && (f.viewport = w('<div class="' + h + 'viewport"></div>').css({
                overflow: "hidden",
                position: "relative"
            }).appendTo(f).append(f.container), f.cloneCount = 0, f.cloneOffset = 0, v && (i = w.makeArray(f.slides).reverse(), f.slides = w(i), f.container.empty().append(f.slides))), f.vars.animationLoop && !b && (f.cloneCount = 2, f.cloneOffset = 1, "init" !== e && f.container.find(".clone").remove(), f.container.append(y.uniqueID(f.slides.first().clone().addClass("clone")).attr("aria-hidden", "true")).prepend(y.uniqueID(f.slides.last().clone().addClass("clone")).attr("aria-hidden", "true"))), f.newSlides = w(f.vars.selector, f), t = v ? f.count - 1 - f.currentSlide + f.cloneOffset : f.currentSlide + f.cloneOffset, g && !b ? (f.container.height(200 * (f.count + f.cloneCount) + "%").css("position", "absolute").width("100%"), setTimeout(function() {
                f.newSlides.css({
                    display: "block"
                }), f.doMath(), f.viewport.height(f.h), f.setProps(t * f.h, "init")
            }, "init" === e ? 100 : 0)) : (f.container.width(200 * (f.count + f.cloneCount) + "%"), f.setProps(t * f.computedW, "init"), setTimeout(function() {
                f.doMath(), f.newSlides.css({
                    width: f.computedW,
                    marginRight: f.computedM,
                    float: "left",
                    display: "block"
                }), f.vars.smoothHeight && y.smoothHeight()
            }, "init" === e ? 100 : 0))), b || f.slides.removeClass(h + "active-slide").eq(f.currentSlide).addClass(h + "active-slide"), f.vars.init(f)
        }, f.doMath = function() {
            var e = f.slides.first(),
                t = f.vars.itemMargin,
                i = f.vars.minItems,
                n = f.vars.maxItems;
            f.w = void 0 === f.viewport ? f.width() : f.viewport.width(), f.h = e.height(), f.boxPadding = e.outerWidth() - e.width(), b ? (f.itemT = f.vars.itemWidth + t, f.itemM = t, f.minW = i ? i * f.itemT : f.w, f.maxW = n ? n * f.itemT - t : f.w, f.itemW = f.minW > f.w ? (f.w - t * (i - 1)) / i : f.maxW < f.w ? (f.w - t * (n - 1)) / n : f.vars.itemWidth > f.w ? f.w : f.vars.itemWidth, f.visible = Math.floor(f.w / f.itemW), f.move = 0 < f.vars.move && f.vars.move < f.visible ? f.vars.move : f.visible, f.pagingCount = Math.ceil((f.count - f.visible) / f.move + 1), f.last = f.pagingCount - 1, f.limit = 1 === f.pagingCount ? 0 : f.vars.itemWidth > f.w ? f.itemW * (f.count - 1) + t * (f.count - 1) : (f.itemW + t) * f.count - f.w - t) : (f.itemW = f.w, f.itemM = t, f.pagingCount = f.count, f.last = f.count - 1), f.computedW = f.itemW - f.boxPadding, f.computedM = f.itemM
        }, f.update = function(e, t) {
            f.doMath(), b || (e < f.currentSlide ? f.currentSlide += 1 : e <= f.currentSlide && 0 !== e && (f.currentSlide -= 1), f.animatingTo = f.currentSlide), f.vars.controlNav && !f.manualControls && ("add" === t && !b || f.pagingCount > f.controlNav.length ? y.controlNav.update("add") : ("remove" === t && !b || f.pagingCount < f.controlNav.length) && (b && f.currentSlide > f.last && (f.currentSlide -= 1, f.animatingTo -= 1), y.controlNav.update("remove", f.last))), f.vars.directionNav && y.directionNav.update()
        }, f.addSlide = function(e, t) {
            var i = w(e);
            f.count += 1, f.last = f.count - 1, g && v ? void 0 !== t ? f.slides.eq(f.count - t).after(i) : f.container.prepend(i) : void 0 !== t ? f.slides.eq(t).before(i) : f.container.append(i), f.update(t, "add"), f.slides = w(f.vars.selector + ":not(.clone)", f), f.setup(), f.vars.added(f)
        }, f.removeSlide = function(e) {
            var t = isNaN(e) ? f.slides.index(w(e)) : e;
            f.count -= 1, f.last = f.count - 1, isNaN(e) ? w(e, f.slides).remove() : g && v ? f.slides.eq(f.last).remove() : f.slides.eq(e).remove(), f.doMath(), f.update(t, "remove"), f.slides = w(f.vars.selector + ":not(.clone)", f), f.setup(), f.vars.removed(f)
        }, y.init()
    }, w(window).blur(function(e) {
        i = !1
    }).focus(function(e) {
        i = !0
    }), w.flexslider.defaults = {
        namespace: "flex-",
        selector: ".slides > li",
        animation: "fade",
        easing: "swing",
        direction: "horizontal",
        reverse: !1,
        
        animationLoop: !0,
        smoothHeight: !1,
        startAt: 0,
        slideshow: !0,
        slideshowSpeed: 7e3,
        animationSpeed: 600,
        initDelay: 0,
        randomize: !1,
        fadeFirstSlide: !0,
        thumbCaptions: !1,
        pauseOnAction: !0,
        pauseOnHover: !1,
        pauseInvisible: !0,
        useCSS: !0,
        touch: !0,
        video: !1,
        controlNav: !0,
        directionNav: !0,
        prevText: "Previous",
        nextText: "Next",
        keyboard: !0,
        multipleKeyboard: !1,
        mousewheel: !1,
        pausePlay: !1,
        pauseText: "Pause",
        playText: "Play",
        controlsContainer: "",
        manualControls: "",
        customDirectionNav: "",
        sync: "",
        asNavFor: "",
        itemWidth: 0,
        itemMargin: 0,
        minItems: 1,
        maxItems: 0,
        move: 0,
        allowOneSlide: false,
        start: function() {},
        before: function() {},
        after: function() {},
        end: function() {},
        added: function() {},
        removed: function() {},
        init: function() {}
    }, w.fn.flexslider = function(n) {
        if (void 0 === n && (n = {}), "object" == typeof n) return this.each(function() {
            var e = w(this),
                t = n.selector ? n.selector : ".slides > li",
                i = e.find(t);
            1 === i.length && !1 === n.allowOneSlide || 0 === i.length ? (i.fadeIn(400), n.start && n.start(e)) : void 0 === e.data("flexslider") && new w.flexslider(this, n)
            
        });
        

        var e = w(this).data("flexslider");

        switch (n) {
            case "play":
                e.play();
                break;
            case "pause":
                e.pause();
                break;
            case "stop":
                e.stop();
                break;
            case "next":
                e.flexAnimate(e.getTarget("next"), !1);
                break;
            case "prev":
            case "previous":
                e.flexAnimate(e.getTarget("prev"), !1);
                break;
            default:
                "number" == typeof n && e.flexAnimate(n, !0)
        }
    }
}(jQuery),
function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? e(require("jquery")) : e(jQuery)
}(function(f) {
    function m(e) {
        return v.raw ? e : encodeURIComponent(e)
    }

    function g(e, t) {
        var i = v.raw ? e : function(e) {
            0 === e.indexOf('"') && (e = e.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
            try {
                return e = decodeURIComponent(e.replace(n, " ")), v.json ? JSON.parse(e) : e
            } catch (e) {}
        }(e);
        return f.isFunction(t) ? t(i) : i
    }
    var n = /\+/g,
        v = f.cookie = function(e, t, i) {
            if (void 0 !== t && !f.isFunction(t)) {
                if ("number" == typeof(i = f.extend({}, v.defaults, i)).expires) {
                    var n = i.expires,
                        s = i.expires = new Date;
                    s.setTime(+s + 864e5 * n)
                }
                return document.cookie = [m(e), "=", (o = t, m(v.json ? JSON.stringify(o) : String(o))), i.expires ? "; expires=" + i.expires.toUTCString() : "", i.path ? "; path=" + i.path : "", i.domain ? "; domain=" + i.domain : "", i.secure ? "; secure" : ""].join("")
            }
            for (var o, a, r = e ? void 0 : {}, l = document.cookie ? document.cookie.split("; ") : [], c = 0, h = l.length; c < h; c++) {
                var u = l[c].split("="),
                    d = (a = u.shift(), v.raw ? a : decodeURIComponent(a)),
                    p = u.join("=");
                if (e && e === d) {
                    r = g(p, t);
                    break
                }
                e || void 0 === (p = g(p)) || (r[d] = p)
            }
            return r
        };
    v.defaults = {}, f.removeCookie = function(e, t) {
        return void 0 !== f.cookie(e) && (f.cookie(e, "", f.extend({}, t, {
            expires: -1
        })), !f.cookie(e))
    }
}),
function(c, e, a) {
    var s = "intlTelInput",
        i = {
            preferredCountries: ["us", "gb"],
            initialDialCode: !0,
            americaMode: !1,
            onlyCountries: []
        };

    function o(e, t) {
        this.element = e, this.options = c.extend({}, i, t), this._defaults = i, this._name = s, this.init()
    }
    o.prototype = {
        init: function() {
            var l = this;
            if (0 < this.options.onlyCountries.length) {
                var s = [],
                    o = {};
                c.each(this.options.onlyCountries, function(e, t) {
                    var i = l._getCountryData(t);
                    if (i) {
                        s.push(i);
                        var n = i["calling-code"];
                        o[n] ? o[n].push(t) : o[n] = [t]
                    }
                }), intlTelInput.countries = s, intlTelInput.countryCodes = o
            }
            var n = [];
            c.each(this.options.preferredCountries, function(e, t) {
                var i = l._getCountryData(t);
                i && n.push(i)
            }), this.defaultCountry = n.length ? n[0] : intlTelInput.countries[0], this.telInput = c(this.element), this.options.initialDialCode && "" === this.telInput.val() && this.telInput.val("+" + this.defaultCountry["calling-code"] + " "), this.telInput.wrap(c("<div>", {
                class: "intl-tel-input"
            }));
            var e = c("<div>", {
                    class: "flag-dropdown f16"
                }).insertBefore(this.telInput),
                t = c("<div>", {
                    class: "selected-flag"
                }).appendTo(e),
                i = this.defaultCountry.cca2;
            this.selectedFlagInner = c("<div>", {
                class: "flag " + i
            }).appendTo(t), c("<div>", {
                class: "down-arrow"
            }).appendTo(this.selectedFlagInner), this.countryList = c("<ul>", {
                class: "country-list hide"
            }).appendTo(e), n.length && (this._appendListItems(n, "preferred"), c("<li>", {
                class: "divider"
            }).appendTo(this.countryList)), this._appendListItems(intlTelInput.countries, ""), this.countryListItems = this.countryList.children(".country"), this.countryListItems.first().addClass("active"), this.telInput.keyup(function() {
                var e, i = !1,
                    t = l._getDialCode(l.telInput.val());
                if (t) {
                    var n = intlTelInput.countryCodes[t];
                    c.each(n, function(e, t) {
                        l.selectedFlagInner.hasClass(t) && (i = !0)
                    }), e = n[0]
                } else e = l.defaultCountry.cca2;
                i || l._selectFlag(e)
            }), this.telInput.keyup(), t.click(function(e) {
                if (e.stopPropagation(), l.countryList.hasClass("hide")) {
                    l.countryListItems.removeClass("highlight");
                    var t = l.countryList.children(".active").addClass("highlight");
                    l.countryList.removeClass("hide"), l._scrollTo(t), c(a).bind("keydown.intlTelInput", function(e) {
                        if (38 == e.which || 40 == e.which) {
                            var t = l.countryList.children(".highlight").first(),
                                i = 38 == e.which ? t.prev() : t.next();
                            i && (i.hasClass("divider") && (i = 38 == e.which ? i.prev() : i.next()), l.countryListItems.removeClass("highlight"), i.addClass("highlight"), l._scrollTo(i))
                        } else if (13 == e.which) {
                            var n = l.countryList.children(".highlight").first();
                            n.length && l._selectListItem(n)
                        } else if (9 == e.which || 27 == e.which) l._closeDropdown();
                        else if (97 <= e.which && e.which <= 122 || 65 <= e.which && e.which <= 90) {
                            var s = String.fromCharCode(e.which),
                                o = l.countryListItems.filter(function() {
                                    return c(this).text().charAt(0) == s && !c(this).hasClass("preferred")
                                });
                            if (o.length) {
                                var a, r = o.filter(".highlight").first();
                                a = r && r.next() && r.next().text().charAt(0) == s ? r.next() : o.first(), l.countryListItems.removeClass("highlight"), a.addClass("highlight"), l._scrollTo(a)
                            }
                        }
                    })
                } else l._closeDropdown()
            }), this.countryListItems.mouseover(function() {
                l.countryListItems.removeClass("highlight"), c(this).addClass("highlight")
            }), this.countryListItems.click(function(e) {
                var t = c(e.currentTarget);
                l._selectListItem(t)
            }), c("html").click(function(e) {
                c(e.target).closest(".country-list").length || l._closeDropdown()
            })
        },
        _getCountryData: function(e) {
            for (var t = 0; t < intlTelInput.countries.length; t++)
                if (intlTelInput.countries[t].cca2 == e) return intlTelInput.countries[t]
        },
        _selectFlag: function(e) {
            this.selectedFlagInner.attr("class", "flag " + e), this.countryListItems.removeClass("active");
            var t = this.countryListItems.children(".flag." + e).parent();
            return t.addClass("active"), t
        },
        selectCountry: function(e) {
            if (!this.selectedFlagInner.hasClass(e)) {
                var t = this._selectFlag(e).attr("data-dial-code");
                this.telInput.val("+" + t + " ")
            }
        },
        _selectListItem: function(e) {
            var t = e.attr("data-country-code");
            this.selectedFlagInner.attr("class", "flag " + t);
            var i = this._updateNumber(this.telInput.val(), e.attr("data-dial-code"));
            this.telInput.val(i), this._closeDropdown(), this.telInput.focus(), this.countryListItems.removeClass("active highlight"), e.addClass("active")
        },
        _closeDropdown: function() {
            this.countryList.addClass("hide"), c(a).unbind("keydown.intlTelInput")
        },
        _scrollTo: function(e) {
            var t = this.countryList,
                i = t.height(),
                n = t.offset().top,
                s = n + i,
                o = e.outerHeight(),
                a = e.offset().top,
                r = a + o,
                l = a - n + t.scrollTop();
            if (a < n) t.scrollTop(l);
            else if (s < r) {
                var c = i - o;
                t.scrollTop(l - c)
            }
        },
        _updateNumber: function(e, t) {
            var i, n = "+" + this._getDialCode(e),
                s = "+" + t;
            return 1 < n.length ? (i = e.replace(n, s), e == n && (i += " ")) : i = e.length && "+" != e.substr(0, 1) ? s + " " + e.trim() : s + " ", this.options.americaMode && "+1 " == i.substring(0, 3) && (i = i.substring(3)), i
        },
        _getDialCode: function(e) {
            var t = e.trim().split(" ")[0];
            if ("+" == t.substring(0, 1))
                for (var i = t.replace(/\D/g, "").substring(0, 4), n = i.length; 0 < n; n--)
                    if (i = i.substring(0, n), intlTelInput.countryCodes[i]) return i;
            return ""
        },
        _appendListItems: function(e, i) {
            var n = "";
            c.each(e, function(e, t) {
                n += "<li class='country " + i + "' data-dial-code='" + t["calling-code"] + "' data-country-code='" + t.cca2 + "'>", n += "<div class='flag " + t.cca2 + "'></div>", n += "<span class='country-name'>" + t.name + "</span>", n += "<span class='dial-code'>+" + t["calling-code"] + "</span>", n += "</li>"
            }), this.countryList.append(n)
        }
    }, c.fn[s] = function(t) {
        var i, n = arguments;
        return void 0 === t || "object" == typeof t ? this.each(function() {
            c.data(this, "plugin_" + s) || c.data(this, "plugin_" + s, new o(this, t))
        }) : "string" == typeof t && "_" !== t[0] && "init" !== t ? (this.each(function() {
            var e = c.data(this, "plugin_" + s);
            e instanceof o && "function" == typeof e[t] && (i = e[t].apply(e, Array.prototype.slice.call(n, 1)))
        }), void 0 !== i ? i : this) : void 0
    }
}(jQuery, window, document);
var intlTelInput = {
    countries: [{
        name: "Afghanistan",
        cca2: "af",
        "calling-code": "93"
    }, {
        name: "Albania",
        cca2: "al",
        "calling-code": "355"
    }, {
        name: "Algeria",
        cca2: "dz",
        "calling-code": "213"
    }, {
        name: "American Samoa",
        cca2: "as",
        "calling-code": "1684"
    }, {
        name: "Andorra",
        cca2: "ad",
        "calling-code": "376"
    }, {
        name: "Angola",
        cca2: "ao",
        "calling-code": "244"
    }, {
        name: "Anguilla",
        cca2: "ai",
        "calling-code": "1264"
    }, {
        name: "Antigua and Barbuda",
        cca2: "ag",
        "calling-code": "1268"
    }, {
        name: "Argentina",
        cca2: "ar",
        "calling-code": "54"
    }, {
        name: "Armenia",
        cca2: "am",
        "calling-code": "374"
    }, {
        name: "Aruba",
        cca2: "aw",
        "calling-code": "297"
    }, {
        name: "Australia",
        cca2: "au",
        "calling-code": "61"
    }, {
        name: "Austria",
        cca2: "at",
        "calling-code": "43"
    }, {
        name: "Azerbaijan",
        cca2: "az",
        "calling-code": "994"
    }, {
        name: "Bahamas",
        cca2: "bs",
        "calling-code": "1242"
    }, {
        name: "Bahrain",
        cca2: "bh",
        "calling-code": "973"
    }, {
        name: "Bangladesh",
        cca2: "bd",
        "calling-code": "880"
    }, {
        name: "Barbados",
        cca2: "bb",
        "calling-code": "1246"
    }, {
        name: "Belarus",
        cca2: "by",
        "calling-code": "375"
    }, {
        name: "Belgium",
        cca2: "be",
        "calling-code": "32"
    }, {
        name: "Belize",
        cca2: "bz",
        "calling-code": "501"
    }, {
        name: "Benin",
        cca2: "bj",
        "calling-code": "229"
    }, {
        name: "Bermuda",
        cca2: "bm",
        "calling-code": "1441"
    }, {
        name: "Bhutan",
        cca2: "bt",
        "calling-code": "975"
    }, {
        name: "Bolivia",
        cca2: "bo",
        "calling-code": "591"
    }, {
        name: "Bosnia and Herzegovina",
        cca2: "ba",
        "calling-code": "387"
    }, {
        name: "Botswana",
        cca2: "bw",
        "calling-code": "267"
    }, {
        name: "Brazil",
        cca2: "br",
        "calling-code": "55"
    }, {
        name: "Brunei Darussalam",
        cca2: "bn",
        "calling-code": "673"
    }, {
        name: "Bulgaria",
        cca2: "bg",
        "calling-code": "359"
    }, {
        name: "Burkina Faso",
        cca2: "bf",
        "calling-code": "226"
    }, {
        name: "Burundi",
        cca2: "bi",
        "calling-code": "257"
    }, {
        name: "Cambodia",
        cca2: "kh",
        "calling-code": "855"
    }, {
        name: "Cameroon",
        cca2: "cm",
        "calling-code": "237"
    }, {
        name: "Canada",
        cca2: "ca",
        "calling-code": "1"
    }, {
        name: "Cape Verde",
        cca2: "cv",
        "calling-code": "238"
    }, {
        name: "Cayman Islands",
        cca2: "ky",
        "calling-code": "1345"
    }, {
        name: "Central African Republic",
        cca2: "cf",
        "calling-code": "236"
    }, {
        name: "Chad",
        cca2: "td",
        "calling-code": "235"
    }, {
        name: "Chile",
        cca2: "cl",
        "calling-code": "56"
    }, {
        name: "China",
        cca2: "cn",
        "calling-code": "86"
    }, {
        name: "Colombia",
        cca2: "co",
        "calling-code": "57"
    }, {
        name: "Comoros",
        cca2: "km",
        "calling-code": "269"
    }, {
        name: "Congo (DRC)",
        cca2: "cd",
        "calling-code": "243"
    }, {
        name: "Congo (Republic)",
        cca2: "cg",
        "calling-code": "242"
    }, {
        name: "Cook Islands",
        cca2: "ck",
        "calling-code": "682"
    }, {
        name: "Costa Rica",
        cca2: "cr",
        "calling-code": "506"
    }, {
        name: "C??te d'Ivoire",
        cca2: "ci",
        "calling-code": "225"
    }, {
        name: "Croatia",
        cca2: "hr",
        "calling-code": "385"
    }, {
        name: "Cuba",
        cca2: "cu",
        "calling-code": "53"
    }, {
        name: "Cyprus",
        cca2: "cy",
        "calling-code": "357"
    }, {
        name: "Czech Republic",
        cca2: "cz",
        "calling-code": "420"
    }, {
        name: "Denmark",
        cca2: "dk",
        "calling-code": "45"
    }, {
        name: "Djibouti",
        cca2: "dj",
        "calling-code": "253"
    }, {
        name: "Dominica",
        cca2: "dm",
        "calling-code": "1767"
    }, {
        name: "Dominican Republic",
        cca2: "do",
        "calling-code": "1809"
    }, {
        name: "Ecuador",
        cca2: "ec",
        "calling-code": "593"
    }, {
        name: "Egypt",
        cca2: "eg",
        "calling-code": "20"
    }, {
        name: "El Salvador",
        cca2: "sv",
        "calling-code": "503"
    }, {
        name: "Equatorial Guinea",
        cca2: "gq",
        "calling-code": "240"
    }, {
        name: "Eritrea",
        cca2: "er",
        "calling-code": "291"
    }, {
        name: "Estonia",
        cca2: "ee",
        "calling-code": "372"
    }, {
        name: "Ethiopia",
        cca2: "et",
        "calling-code": "251"
    }, {
        name: "Faroe Islands",
        cca2: "fo",
        "calling-code": "298"
    }, {
        name: "Fiji",
        cca2: "fj",
        "calling-code": "679"
    }, {
        name: "Finland",
        cca2: "fi",
        "calling-code": "358"
    }, {
        name: "France",
        cca2: "fr",
        "calling-code": "33"
    }, {
        name: "French Polynesia",
        cca2: "pf",
        "calling-code": "689"
    }, {
        name: "Gabon",
        cca2: "ga",
        "calling-code": "241"
    }, {
        name: "Gambia",
        cca2: "gm",
        "calling-code": "220"
    }, {
        name: "Georgia",
        cca2: "ge",
        "calling-code": "995"
    }, {
        name: "Germany",
        cca2: "de",
        "calling-code": "49"
    }, {
        name: "Ghana",
        cca2: "gh",
        "calling-code": "233"
    }, {
        name: "Gibraltar",
        cca2: "gi",
        "calling-code": "350"
    }, {
        name: "Greece",
        cca2: "gr",
        "calling-code": "30"
    }, {
        name: "Greenland",
        cca2: "gl",
        "calling-code": "299"
    }, {
        name: "Grenada",
        cca2: "gd",
        "calling-code": "1473"
    }, {
        name: "Guadeloupe",
        cca2: "gp",
        "calling-code": "590"
    }, {
        name: "Guam",
        cca2: "gu",
        "calling-code": "1671"
    }, {
        name: "Guatemala",
        cca2: "gt",
        "calling-code": "502"
    }, {
        name: "Guernsey",
        cca2: "gg",
        "calling-code": "44"
    }, {
        name: "Guinea",
        cca2: "gn",
        "calling-code": "224"
    }, {
        name: "Guinea-Bissau",
        cca2: "gw",
        "calling-code": "245"
    }, {
        name: "Guyana",
        cca2: "gy",
        "calling-code": "592"
    }, {
        name: "Haiti",
        cca2: "ht",
        "calling-code": "509"
    }, {
        name: "Honduras",
        cca2: "hn",
        "calling-code": "504"
    }, {
        name: "Hong Kong",
        cca2: "hk",
        "calling-code": "852"
    }, {
        name: "Hungary",
        cca2: "hu",
        "calling-code": "36"
    }, {
        name: "Iceland",
        cca2: "is",
        "calling-code": "354"
    }, {
        name: "India",
        cca2: "in",
        "calling-code": "91"
    }, {
        name: "Indonesia",
        cca2: "id",
        "calling-code": "62"
    }, {
        name: "Iran",
        cca2: "ir",
        "calling-code": "98"
    }, {
        name: "Iraq",
        cca2: "iq",
        "calling-code": "964"
    }, {
        name: "Ireland",
        cca2: "ie",
        "calling-code": "353"
    }, {
        name: "Isle of Man",
        cca2: "im",
        "calling-code": "44"
    }, {
        name: "Israel",
        cca2: "il",
        "calling-code": "972"
    }, {
        name: "Italy",
        cca2: "it",
        "calling-code": "39"
    }, {
        name: "Jamaica",
        cca2: "jm",
        "calling-code": "1876"
    }, {
        name: "Japan",
        cca2: "jp",
        "calling-code": "81"
    }, {
        name: "Jersey",
        cca2: "je",
        "calling-code": "44"
    }, {
        name: "Jordan",
        cca2: "jo",
        "calling-code": "962"
    }, {
        name: "Kazakhstan",
        cca2: "kz",
        "calling-code": "7"
    }, {
        name: "Kenya",
        cca2: "ke",
        "calling-code": "254"
    }, {
        name: "Kiribati",
        cca2: "ki",
        "calling-code": "686"
    }, {
        name: "Kuwait",
        cca2: "kw",
        "calling-code": "965"
    }, {
        name: "Kyrgyzstan",
        cca2: "kg",
        "calling-code": "996"
    }, {
        name: "Laos",
        cca2: "la",
        "calling-code": "856"
    }, {
        name: "Latvia",
        cca2: "lv",
        "calling-code": "371"
    }, {
        name: "Lebanon",
        cca2: "lb",
        "calling-code": "961"
    }, {
        name: "Lesotho",
        cca2: "ls",
        "calling-code": "266"
    }, {
        name: "Liberia",
        cca2: "lr",
        "calling-code": "231"
    }, {
        name: "Libya",
        cca2: "ly",
        "calling-code": "218"
    }, {
        name: "Liechtenstein",
        cca2: "li",
        "calling-code": "423"
    }, {
        name: "Lithuania",
        cca2: "lt",
        "calling-code": "370"
    }, {
        name: "Luxembourg",
        cca2: "lu",
        "calling-code": "352"
    }, {
        name: "Macao",
        cca2: "mo",
        "calling-code": "853"
    }, {
        name: "Macedonia",
        cca2: "mk",
        "calling-code": "389"
    }, {
        name: "Madagascar",
        cca2: "mg",
        "calling-code": "261"
    }, {
        name: "Malawi",
        cca2: "mw",
        "calling-code": "265"
    }, {
        name: "Malaysia",
        cca2: "my",
        "calling-code": "60"
    }, {
        name: "Maldives",
        cca2: "mv",
        "calling-code": "960"
    }, {
        name: "Mali",
        cca2: "ml",
        "calling-code": "223"
    }, {
        name: "Malta",
        cca2: "mt",
        "calling-code": "356"
    }, {
        name: "Marshall Islands",
        cca2: "mh",
        "calling-code": "692"
    }, {
        name: "Martinique",
        cca2: "mq",
        "calling-code": "596"
    }, {
        name: "Mauritania",
        cca2: "mr",
        "calling-code": "222"
    }, {
        name: "Mauritius",
        cca2: "mu",
        "calling-code": "230"
    }, {
        name: "Mexico",
        cca2: "mx",
        "calling-code": "52"
    }, {
        name: "Micronesia",
        cca2: "fm",
        "calling-code": "691"
    }, {
        name: "Moldova",
        cca2: "md",
        "calling-code": "373"
    }, {
        name: "Monaco",
        cca2: "mc",
        "calling-code": "377"
    }, {
        name: "Mongolia",
        cca2: "mn",
        "calling-code": "976"
    }, {
        name: "Montenegro",
        cca2: "me",
        "calling-code": "382"
    }, {
        name: "Montserrat",
        cca2: "ms",
        "calling-code": "1664"
    }, {
        name: "Morocco",
        cca2: "ma",
        "calling-code": "212"
    }, {
        name: "Mozambique",
        cca2: "mz",
        "calling-code": "258"
    }, {
        name: "Myanmar (Burma)",
        cca2: "mm",
        "calling-code": "95"
    }, {
        name: "Namibia",
        cca2: "na",
        "calling-code": "264"
    }, {
        name: "Nauru",
        cca2: "nr",
        "calling-code": "674"
    }, {
        name: "Nepal",
        cca2: "np",
        "calling-code": "977"
    }, {
        name: "Netherlands",
        cca2: "nl",
        "calling-code": "31"
    }, {
        name: "New Caledonia",
        cca2: "nc",
        "calling-code": "687"
    }, {
        name: "New Zealand",
        cca2: "nz",
        "calling-code": "64"
    }, {
        name: "Nicaragua",
        cca2: "ni",
        "calling-code": "505"
    }, {
        name: "Niger",
        cca2: "ne",
        "calling-code": "227"
    }, {
        name: "Nigeria",
        cca2: "ng",
        "calling-code": "234"
    }, {
        name: "North Korea",
        cca2: "kp",
        "calling-code": "850"
    }, {
        name: "Norway",
        cca2: "no",
        "calling-code": "47"
    }, {
        name: "Oman",
        cca2: "om",
        "calling-code": "968"
    }, {
        name: "Pakistan",
        cca2: "pk",
        "calling-code": "92"
    }, {
        name: "Palau",
        cca2: "pw",
        "calling-code": "680"
    }, {
        name: "Palestinian Territory",
        cca2: "ps",
        "calling-code": "970"
    }, {
        name: "Panama",
        cca2: "pa",
        "calling-code": "507"
    }, {
        name: "Papua New Guinea",
        cca2: "pg",
        "calling-code": "675"
    }, {
        name: "Paraguay",
        cca2: "py",
        "calling-code": "595"
    }, {
        name: "Peru",
        cca2: "pe",
        "calling-code": "51"
    }, {
        name: "Philippines",
        cca2: "ph",
        "calling-code": "63"
    }, {
        name: "Poland",
        cca2: "pl",
        "calling-code": "48"
    }, {
        name: "Portugal",
        cca2: "pt",
        "calling-code": "351"
    }, {
        name: "Puerto Rico",
        cca2: "pr",
        "calling-code": "1787"
    }, {
        name: "Qatar",
        cca2: "qa",
        "calling-code": "974"
    }, {
        name: "R??union",
        cca2: "re",
        "calling-code": "262"
    }, {
        name: "Romania",
        cca2: "ro",
        "calling-code": "40"
    }, {
        name: "Russian Federation",
        cca2: "ru",
        "calling-code": "7"
    }, {
        name: "Rwanda",
        cca2: "rw",
        "calling-code": "250"
    }, {
        name: "Saint Kitts and Nevis",
        cca2: "kn",
        "calling-code": "1869"
    }, {
        name: "Saint Lucia",
        cca2: "lc",
        "calling-code": "1758"
    }, {
        name: "Saint Vincent and the Grenadines",
        cca2: "vc",
        "calling-code": "1784"
    }, {
        name: "Samoa",
        cca2: "ws",
        "calling-code": "685"
    }, {
        name: "San Marino",
        cca2: "sm",
        "calling-code": "378"
    }, {
        name: "S??o Tom?? and Pr??ncipe",
        cca2: "st",
        "calling-code": "239"
    }, {
        name: "Saudi Arabia",
        cca2: "sa",
        "calling-code": "966"
    }, {
        name: "Senegal",
        cca2: "sn",
        "calling-code": "221"
    }, {
        name: "Serbia",
        cca2: "rs",
        "calling-code": "381"
    }, {
        name: "Seychelles",
        cca2: "sc",
        "calling-code": "248"
    }, {
        name: "Sierra Leone",
        cca2: "sl",
        "calling-code": "232"
    }, {
        name: "Singapore",
        cca2: "sg",
        "calling-code": "65"
    }, {
        name: "Slovakia",
        cca2: "sk",
        "calling-code": "421"
    }, {
        name: "Slovenia",
        cca2: "si",
        "calling-code": "386"
    }, {
        name: "Solomon Islands",
        cca2: "sb",
        "calling-code": "677"
    }, {
        name: "Somalia",
        cca2: "so",
        "calling-code": "252"
    }, {
        name: "South Africa",
        cca2: "za",
        "calling-code": "27"
    }, {
        name: "South Korea",
        cca2: "kr",
        "calling-code": "82"
    }, {
        name: "Spain",
        cca2: "es",
        "calling-code": "34"
    }, {
        name: "Sri Lanka",
        cca2: "lk",
        "calling-code": "94"
    }, {
        name: "Sudan",
        cca2: "sd",
        "calling-code": "249"
    }, {
        name: "Suriname",
        cca2: "sr",
        "calling-code": "597"
    }, {
        name: "Swaziland",
        cca2: "sz",
        "calling-code": "268"
    }, {
        name: "Sweden",
        cca2: "se",
        "calling-code": "46"
    }, {
        name: "Switzerland",
        cca2: "ch",
        "calling-code": "41"
    }, {
        name: "Syrian Arab Republic",
        cca2: "sy",
        "calling-code": "963"
    }, {
        name: "Taiwan, Province of China",
        cca2: "tw",
        "calling-code": "886"
    }, {
        name: "Tajikistan",
        cca2: "tj",
        "calling-code": "992"
    }, {
        name: "Tanzania",
        cca2: "tz",
        "calling-code": "255"
    }, {
        name: "Thailand",
        cca2: "th",
        "calling-code": "66"
    }, {
        name: "Timor-Leste",
        cca2: "tl",
        "calling-code": "670"
    }, {
        name: "Togo",
        cca2: "tg",
        "calling-code": "228"
    }, {
        name: "Tonga",
        cca2: "to",
        "calling-code": "676"
    }, {
        name: "Trinidad and Tobago",
        cca2: "tt",
        "calling-code": "1868"
    }, {
        name: "Tunisia",
        cca2: "tn",
        "calling-code": "216"
    }, {
        name: "Turkey",
        cca2: "tr",
        "calling-code": "90"
    }, {
        name: "Turkmenistan",
        cca2: "tm",
        "calling-code": "993"
    }, {
        name: "Turks and Caicos Islands",
        cca2: "tc",
        "calling-code": "1649"
    }, {
        name: "Tuvalu",
        cca2: "tv",
        "calling-code": "688"
    }, {
        name: "Uganda",
        cca2: "ug",
        "calling-code": "256"
    }, {
        name: "Ukraine",
        cca2: "ua",
        "calling-code": "380"
    }, {
        name: "United Arab Emirates",
        cca2: "ae",
        "calling-code": "971"
    }, {
        name: "United Kingdom",
        cca2: "gb",
        "calling-code": "44"
    }, {
        name: "United States",
        cca2: "us",
        "calling-code": "1"
    }, {
        name: "Uruguay",
        cca2: "uy",
        "calling-code": "598"
    }, {
        name: "Uzbekistan",
        cca2: "uz",
        "calling-code": "998"
    }, {
        name: "Vanuatu",
        cca2: "vu",
        "calling-code": "678"
    }, {
        name: "Vatican City",
        cca2: "va",
        "calling-code": "379"
    }, {
        name: "Venezuela",
        cca2: "ve",
        "calling-code": "58"
    }, {
        name: "Viet Nam",
        cca2: "vn",
        "calling-code": "84"
    }, {
        name: "Virgin Islands (British)",
        cca2: "vg",
        "calling-code": "1284"
    }, {
        name: "Virgin Islands (U.S.)",
        cca2: "vi",
        "calling-code": "1340"
    }, {
        name: "Western Sahara",
        cca2: "eh",
        "calling-code": "212"
    }, {
        name: "Yemen",
        cca2: "ye",
        "calling-code": "967"
    }, {
        name: "Zambia",
        cca2: "zm",
        "calling-code": "260"
    }, {
        name: "Zimbabwe",
        cca2: "zw",
        "calling-code": "263"
    }],
    countryCodes: {
        1: ["us", "ca"],
        7: ["ru", "kz"],
        20: ["eg"],
        27: ["za"],
        30: ["gr"],
        31: ["nl"],
        32: ["be"],
        33: ["fr"],
        34: ["es"],
        36: ["hu"],
        39: ["it"],
        40: ["ro"],
        41: ["ch"],
        43: ["at"],
        44: ["gb", "gg", "im", "je"],
        45: ["dk"],
        46: ["se"],
        47: ["no", "sj"],
        48: ["pl"],
        49: ["de"],
        51: ["pe"],
        52: ["mx"],
        53: ["cu"],
        54: ["ar"],
        55: ["br"],
        56: ["cl"],
        57: ["co"],
        58: ["ve"],
        60: ["my"],
        61: ["au", "cc", "cx"],
        62: ["id"],
        63: ["ph"],
        64: ["nz"],
        65: ["sg"],
        66: ["th"],
        81: ["jp"],
        82: ["kr"],
        84: ["vn"],
        86: ["cn"],
        90: ["tr"],
        91: ["in"],
        92: ["pk"],
        93: ["af"],
        94: ["lk"],
        95: ["mm"],
        98: ["ir"],
        211: ["ss"],
        212: ["ma", "eh"],
        213: ["dz"],
        216: ["tn"],
        218: ["ly"],
        220: ["gm"],
        221: ["sn"],
        222: ["mr"],
        223: ["ml"],
        224: ["gn"],
        225: ["ci"],
        226: ["bf"],
        227: ["ne"],
        228: ["tg"],
        229: ["bj"],
        230: ["mu"],
        231: ["lr"],
        232: ["sl"],
        233: ["gh"],
        234: ["ng"],
        235: ["td"],
        236: ["cf"],
        237: ["cm"],
        238: ["cv"],
        239: ["st"],
        240: ["gq"],
        241: ["ga"],
        242: ["cg"],
        243: ["cd"],
        244: ["ao"],
        245: ["gw"],
        246: ["io"],
        247: ["ac"],
        248: ["sc"],
        249: ["sd"],
        250: ["rw"],
        251: ["et"],
        252: ["so"],
        253: ["dj"],
        254: ["ke"],
        255: ["tz"],
        256: ["ug"],
        257: ["bi"],
        258: ["mz"],
        260: ["zm"],
        261: ["mg"],
        262: ["re", "yt"],
        263: ["zw"],
        264: ["na"],
        265: ["mw"],
        266: ["ls"],
        267: ["bw"],
        268: ["sz"],
        269: ["km"],
        290: ["sh"],
        291: ["er"],
        297: ["aw"],
        298: ["fo"],
        299: ["gl"],
        350: ["gi"],
        351: ["pt"],
        352: ["lu"],
        353: ["ie"],
        354: ["is"],
        355: ["al"],
        356: ["mt"],
        357: ["cy"],
        358: ["fi", "ax"],
        359: ["bg"],
        370: ["lt"],
        371: ["lv"],
        372: ["ee"],
        373: ["md"],
        374: ["am"],
        375: ["by"],
        376: ["ad"],
        377: ["mc"],
        378: ["sm"],
        379: ["va"],
        380: ["ua"],
        381: ["rs"],
        382: ["me"],
        385: ["hr"],
        386: ["si"],
        387: ["ba"],
        389: ["mk"],
        420: ["cz"],
        421: ["sk"],
        423: ["li"],
        500: ["fk"],
        501: ["bz"],
        502: ["gt"],
        503: ["sv"],
        504: ["hn"],
        505: ["ni"],
        506: ["cr"],
        507: ["pa"],
        508: ["pm"],
        509: ["ht"],
        590: ["gp", "bl", "mf"],
        591: ["bo"],
        592: ["gy"],
        593: ["ec"],
        594: ["gf"],
        595: ["py"],
        596: ["mq"],
        597: ["sr"],
        598: ["uy"],
        599: ["cw", "bq"],
        670: ["tl"],
        672: ["nf"],
        673: ["bn"],
        674: ["nr"],
        675: ["pg"],
        676: ["to"],
        677: ["sb"],
        678: ["vu"],
        679: ["fj"],
        680: ["pw"],
        681: ["wf"],
        682: ["ck"],
        683: ["nu"],
        685: ["ws"],
        686: ["ki"],
        687: ["nc"],
        688: ["tv"],
        689: ["pf"],
        690: ["tk"],
        691: ["fm"],
        692: ["mh"],
        850: ["kp"],
        852: ["hk"],
        853: ["mo"],
        855: ["kh"],
        856: ["la"],
        880: ["bd"],
        886: ["tw"],
        960: ["mv"],
        961: ["lb"],
        962: ["jo"],
        963: ["sy"],
        964: ["iq"],
        965: ["kw"],
        966: ["sa"],
        967: ["ye"],
        968: ["om"],
        970: ["ps"],
        971: ["ae"],
        972: ["il"],
        973: ["bh"],
        974: ["qa"],
        975: ["bt"],
        976: ["mn"],
        977: ["np"],
        992: ["tj"],
        993: ["tm"],
        994: ["az"],
        995: ["ge"],
        996: ["kg"],
        998: ["uz"],
        1242: ["bs"],
        1246: ["bb"],
        1264: ["ai"],
        1268: ["ag"],
        1284: ["vg"],
        1340: ["vi"],
        1345: ["ky"],
        1441: ["bm"],
        1473: ["gd"],
        1649: ["tc"],
        1664: ["ms"],
        1671: ["gu"],
        1684: ["as"],
        1758: ["lc"],
        1767: ["dm"],
        1784: ["vc"],
        1787: ["pr"],
        1809: ["do"],
        1868: ["tt"],
        1869: ["kn"],
        1876: ["jm"]
    }
};
eval(function(e, t, i, n, s, o) {
        if (s = function(e) {
                return (e < 62 ? "" : s(parseInt(e / 62))) + (35 < (e %= 62) ? String.fromCharCode(e + 29) : e.toString(36))
            }, !"".replace(/^/, String)) {
            for (; i--;) o[s(i)] = n[i] || s(i);
            n = [function(e) {
                return o[e]
            }], s = function() {
                return "\\w+"
            }, i = 1
        }
        for (; i--;) n[i] && (e = e.replace(new RegExp("\\b" + s(i) + "\\b", "g"), n[i]));
        return e
    }('4 1A=1A||{};(6($){1A={3w:\'3.0\',3x:"52 53",2R:20,3y:6(v){5(v!==12){$(".2D").1l({1u:\'2S\',23:\'4a\'})}1b{$(".2D").1l({1u:\'4b\',23:\'2T\'})}},2U:\'\',2V:6(a,b,c){c=c||"3z";4 d;1W(c.2E()){1h"3z":1h"4c":d=$(a).2W(b).1d("1O");1i}14 d}};$.2X={};$.2W={};$.2F(11,$.2X,1A);$.2F(11,$.2W,1A);5($.1L.24===1v){$.1L.24=$.1L.54}5($.1L.18===1v){$.1L.18=$.1L.55;$.1L.1y=$.1L.56}5(1w $.2Y.4d===\'6\'){$.2Y[\':\'].3A=$.2Y.4d(6(b){14 6(a){14 $(a).1n().2Z().4e(b.2Z())>=0}})}1b{$.2Y[\':\'].3A=6(a,i,m){14 $(a).1n().2Z().4e(m[3].2Z())>=0}}6 1O(q,t){4 u=$.2F(11,{1H:{1d:1e,1k:0,3B:1e,25:0,1P:12,30:57},4f:\'1O\',1u:58,2d:7,31:0,32:11,1X:59,2e:12,4g:\'5a\',3C:\'1M\',4h:\'2S\',2p:11,1I:\'\',4i:0.7,3D:11,18:{2V:1e,2q:1e,33:1e,1Y:1e,1B:1e,34:1e,4j:1e,1M:1e,3E:1e,3F:1e,2f:1e,2r:1e,4k:1e,2g:1e,2h:1e}},t);4 x=15;4 y={3G:\'5b\',1Q:\'5c\',3H:\'5d\',2i:\'5e\',1m:\'5f\'};4 z={1O:u.4f,2G:\'2G\',3I:\'3I 5g\',3J:\'3J\',35:\'35\',2s:\'2s\',1o:\'1o\',2D:\'2D\',4l:\'4l\',4m:\'4m\',19:\'19\',3K:\'3K\',36:"36",3L:"3L",1f:"1f",2H:"5h",2I:\'2I\',3a:\'3a\'};4 A={8:\'5i\',2j:\'2j\',4n:\'5j 4o\',3b:"3b"};4 B=12,1Z=12,1j=12,3c={},9,1J,3d=12;4 C=40,4p=38,4q=37,4r=39,4s=27,4t=13,4u=47,3M=16,3N=17;4 D=12,2t=12,3e=1e,3f=12,3O,5k=12;4 E=2J;4 F=6(a){5(3c[a]===1v){3c[a]=E.5l(a)}14 3c[a]};4 G=6(a){4 b=J("1m");14 $("#"+b+" 8."+A.8).1C(a)};4 H=6(){5(u.1H.1d){4 a=["1f","1z","1p"];3g{5(!q.1D){q.1D="3z"+1A.2R};u.1H.1d=4v(u.1H.1d);4 b="5m"+(1A.2R++);4 c={};c.1D=b;c.3B=u.1H.3B||q.1D;5(u.1H.25>0){c.25=u.1H.25};c.1P=u.1H.1P;4 d=M("4c",c);21(4 i=0;i<u.1H.1d.1a;i++){4 f=u.1H.1d[i];4 g=3h 3P(f.1n,f.1g);21(4 p 3i f){5(p.2E()!=\'1n\'){4 h=($.5n(p.2E(),a)!=-1)?"1d-":"";g.5o(h+p,f[p])}};d.1E[i]=g};F(q.1D).1q(d);d.1k=u.1H.1k;$(d).1l({30:u.1H.30+\'2u\'});q=d}3j(e){5p"5q 5r 5s 5t 3i 5u 1d.";}}};4 I=6(){H();5(!q.1D){q.1D="5v"+(1A.2R++)};9=q.1D;x.9=9;1j=F(9).2s;B=(F(9).25>1||F(9).1P==11)?11:12;4 a=$("#"+9).1d("5w");5(a){z.1O=a};5(B){1Z=F(9).1P};4w();4x();4y();1r("4z",26());1r("4A",$("#"+9+" 1R:19"))};4 J=6(a){14 9+y[a]};4 K=6(a){4 s=(a.1I===1v)?"":a.1I.4B;14 s};4 L=6(a){4 b=\'\',1p=\'\',1f=\'\',1g=-1,1n=\'\',1c=\'\',1x=\'\';5(a!==1v){4 c=a.1p||"";5(c!=""){4 d=/^\\{.*\\}$/;4 e=d.5x(c);5(e&&u.2p){4 f=4v("["+c+"]")};1p=(e&&u.2p)?f[0].1p:1p;1f=(e&&u.2p)?f[0].1f:1f;b=(e&&u.2p)?f[0].1z:c;1x=(e&&u.2p)?f[0].1x:1x};1n=a.1n||\'\';1g=a.1g||\'\';1c=a.1c||"";1p=$(a).24("1d-1p")||$(a).1d("1p")||(1p||"");1f=$(a).24("1d-1f")||$(a).1d("1f")||(1f||"");b=$(a).24("1d-1z")||$(a).1d("1z")||(b||"");1x=$(a).24("1d-1x")||$(a).1d("1x")||(1x||"")};4 o={1z:b,1p:1p,1f:1f,1g:1g,1n:1n,1c:1c,1x:1x};14 o};4 M=6(a,b,c){4 d=E.5y(a);5(b){21(4 i 3i b){1W(i){1h"1I":d.1I.4B=b[i];1i;2v:d[i]=b[i];1i}}};5(c){d.5z=c};14 d};4 N=6(){4 a=J("3G");5($("#"+a).1a==0){4 b={1I:\'1u: 4b;3Q: 2k;23: 2T;\',1c:z.2D};b.1D=a;4 c=M("2K",b);$("#"+9).4C(c);$("#"+9).5A($("#"+a))}1b{$("#"+a).1l({1u:0,3Q:\'2k\',23:\'2T\'})}};4 O=6(){4 a={1c:z.1O+" 5B 2w"};4 b=K(F(9));4 w=$("#"+9).5C();a.1I="30: "+w+"2u;";5(b.1a>0){a.1I=a.1I+""+b};a.1D=J("1Q");4 c=M("2K",a);14 c};4 P=6(){4 a;5(F(9).1k>=0){a=F(9).1E[F(9).1k]}1b{a={1g:\'\',1n:\'\'}}4 b="",3R="";4 c=$("#"+9).1d("5D");5(c){u.2e=c};5(u.2e!=12){b=" "+u.2e;3R=" "+a.1c};4 d=M("2K",{1c:z.2G+b+" "+A.2j});4 e=M("28",{1c:z.3K});4 f=M("28",{1c:z.3I});4 g=J("3H");4 h=M("28",{1c:z.35+3R,1D:g});4 i=L(a);4 j=i.1z;4 k=i.1n||"";5(j!=""&&u.32){4 l=M("3k");l.3S=j;5(i.1x!=""){l.1c=i.1x+" "}};4 m=M("28",{1c:z.2H},k);d.1q(e);d.1q(f);5(l){h.1q(l)};h.1q(m);d.1q(h);4 n=M("28",{1c:z.1f},i.1f);h.1q(n);14 d};4 Q=6(){4 a=J("2i");4 b=M("5E",{1D:a,5F:\'1n\',1g:\'\',5G:\'1y\',1c:\'1n 4o 2w\',1I:\'1S: 2x\'});14 b};4 R=6(a){4 b={};4 c=K(a);5(c.1a>0){b.1I=c};4 d=(a.2s)?z.2s:z.1o;d=(a.19)?(d+" "+z.19):d;d=d+" "+A.8;b.1c=d;5(u.2e!=12){b.1c=d+" "+a.1c};4 e=M("8",b);4 f=L(a);5(f.1p!=""){e.1p=f.1p};4 g=f.1z;5(g!=""&&u.32){4 h=M("3k");h.3S=g;5(f.1x!=""){h.1c=f.1x+" "}};5(f.1f!=""){4 i=M("28",{1c:z.1f},f.1f)};4 j=a.1n||"";4 k=M("28",{1c:z.2H},j);5(h){e.1q(h)};e.1q(k);5(i){e.1q(i)}1b{5(h){h.1c=h.1c+A.3b}};4 l=M("2K",{1c:\'5H\'});e.1q(l);14 e};4 S=6(){4 a=J("1m");4 b={1c:z.3J+" 5I "+A.4n,1D:a};5(B==12){b.1I="z-1C: "+u.1X};4 c=M("2K",b);4 d=M("3T");5(u.2e!=12){d.1c=u.2e};4 e=F(9).1T;21(4 i=0;i<e.1a;i++){4 f=e[i];4 g;5(f.5J.2E()=="36"){g=M("8",{1c:z.36});4 h=M("28",{1c:z.3L},f.2H);g.1q(h);4 k=f.1T;4 l=M("3T");21(4 j=0;j<k.1a;j++){4 m=R(k[j]);l.1q(m)};g.1q(l)}1b{g=R(f)};d.1q(g)};c.1q(d);14 c};4 T=6(a){4 b=J("1m");5(a){5(a==-1){$("#"+b).1l({1u:"2S",3Q:"2S"})}1b{$("#"+b).1l("1u",a+"2u")};14 12};4 c;5(F(9).1E.1a>u.2d){4 d=2y($("#"+b+" 8:3U").1l("4D-5K"))+2y($("#"+b+" 8:3U").1l("4D-22"));5(u.31===0){$("#"+b).1l({4E:\'2k\',1S:\'3l\'});u.31=3m.5L($("#"+b+" 8:3U").1u());$("#"+b).1l({4E:\'1N\'});5(!B){$("#"+b).1l({1S:\'2x\'})}};c=((u.31+d)*u.2d)}1b 5(B){c=$("#"+9).1u()};14 c};4 U=6(){4 h=J("1m");$("#"+h).18("1M",6(e){5(1j==11)14 12;e.1U();e.29();5(B){3n()}});$("#"+h+" 8."+z.1o).18("1M",6(e){2l(15)});$("#"+h+" 8."+z.1o).18("2g",6(e){5(1j==11)14 12;3O=$("#"+h+" 8."+z.19);3e=15;e.1U();e.29();5(B===11){5(1Z){5(D===11){$(15).1s(z.19);4 a=$("#"+h+" 8."+z.19);4 b=G(15);5(a.1a>1){4 c=$("#"+h+" 8."+A.8);4 d=G(a[0]);4 f=G(a[1]);5(b>f){d=(b);f=f+1};21(4 i=3m.5M(d,f);i<=3m.5N(d,f);i++){4 g=c[i];5($(g).3o(z.1o)){$(g).1s(z.19)}}}}1b 5(2t===11){$(15).5O(z.19)}1b{$("#"+h+" 8."+z.19).1F(z.19);$(15).1s(z.19)}}1b{$("#"+h+" 8."+z.19).1F(z.19);$(15).1s(z.19)}}1b{$("#"+h+" 8."+z.19).1F(z.19);$(15).1s(z.19)}});$("#"+h+" 8."+z.1o).18("2L",6(e){5(1j==11)14 12;e.1U();e.29();5(3e!=1e){5(1Z){$(15).1s(z.19)}}});$("#"+h+" 8."+z.1o).18("2f",6(e){5(1j==11)14 12;$(15).1s(z.2I)});$("#"+h+" 8."+z.1o).18("2r",6(e){5(1j==11)14 12;$("#"+h+" 8."+z.2I).1F(z.2I)});$("#"+h+" 8."+z.1o).18("2h",6(e){5(1j==11)14 12;e.1U();e.29();4 a=$("#"+h+" 8."+z.19).1a;3f=(3O.1a!=a||a==0)?11:12;2M();3p();3n();3e=1e});5(u.3D==12){$("#"+h+" 8."+A.8).18("1M",6(e){5(1j==11)14 12;2m(15,"1M")});$("#"+h+" 8."+A.8).18("2L",6(e){5(1j==11)14 12;2m(15,"2L")});$("#"+h+" 8."+A.8).18("2f",6(e){5(1j==11)14 12;2m(15,"2f")});$("#"+h+" 8."+A.8).18("2r",6(e){5(1j==11)14 12;2m(15,"2r")});$("#"+h+" 8."+A.8).18("2g",6(e){5(1j==11)14 12;2m(15,"2g")});$("#"+h+" 8."+A.8).18("2h",6(e){5(1j==11)14 12;2m(15,"2h")})}};4 V=6(){4 a=J("1m");$("#"+a).1y("1M");$("#"+a+" 8."+z.1o).1y("2L");$("#"+a+" 8."+z.1o).1y("1M");$("#"+a+" 8."+z.1o).1y("2f");$("#"+a+" 8."+z.1o).1y("2r");$("#"+a+" 8."+z.1o).1y("2g");$("#"+a+" 8."+z.1o).1y("2h")};4 W=6(){4 a=J("1Q");4 b=J("1m");$("#"+a).18(u.3C,6(e){5(1j==11)14 12;1V("1M");e.1U();e.29();3V(e)});U();$("#"+a).18("3E",4F);$("#"+a).18("3F",4G);$("#"+a).18("2L",4H);$("#"+a).18("5P",4I);$("#"+a).18("2g",4J);$("#"+a).18("2h",4K)};4 X=6(){4 a=J("1Q");4 b=J("1m");5(B===11){$("#"+a+" ."+z.2G).2N();$("#"+b).1l({1S:\'3l\',23:\'4a\'})}1b{1Z=12;$("#"+a+" ."+z.2G).2n();$("#"+b).1l({1S:\'2x\',23:\'2T\'});4 c=$("#"+b+" 8."+z.19)[0];$("#"+b+" 8."+z.19).1F(z.19);4 d=G($(c).1s(z.19));2o(d)};T(T())};4 Y=6(){4 a=J("1Q");4 b=(1j==11)?u.4i:1;5(1j===11){$("#"+a).1s(z.3a)}1b{$("#"+a).1F(z.3a)}};4 Z=6(){4 a=J("2i");$("#"+a).18("2z",4L);X();Y()};4 4y=6(){4 a=O();4 b=P();a.1q(b);4 c=Q();a.1q(c);4 d=S();a.1q(d);$("#"+9).4C(a);N();Z();W();5(1w u.18.2V=="6"){u.18.2V.1K(x,1t)}};4 4M=6(a){4 b=J("1m");4 c=a||$("#"+b+" 8."+z.19);21(4 i=0;i<c.1a;i++){4 d=G(c[i]);F(9).1E[d].19="19"}};4 2M=6(){4 a=J("1m");4 b=$("#"+a+" 8."+z.19);5(1Z&&(D||2t)||3f){F(9).1k=-1};5(b.1a==0){c=-1}1b 5(b.1a>1){4M(b);4 c=$("#"+a+" 8."+z.19)}1b{4 c=G($("#"+a+" 8."+z.19))};5(F(9).1k!=c||3f){2o(c);$("#"+9).3W("34")}};4 2o=6(a,b){5(a!==1v){4 c,1g,2a;5(a==-1){c=-1;1g="";2a="";2O(-1)}1b{5(1w a!="5Q"){4 d=F(9).1E[a];F(9).1k=a;c=a;1g=L(d);2a=(a>=0)?F(9).1E[a].1n:"";2O(1v,1g);1g=1g.1g}1b{c=F(9).1k;1g=F(9).1g;2a=F(9).1E[F(9).1k].1n||""}};1r("1k",c);1r("1g",1g);1r("2a",2a);1r("1T",F(9).1T);1r("4z",26());1r("4A",$("#"+9+" 1R:19"))}};4 3q=6(a){4 b={2A:12,2B:12,2b:12};4 c=$("#"+9);5(c.24("18"+a)!=1v){b.2b=11;b.2A=11};4 d;5(1w $.4N=="6"){d=$.4N(c[0],"3X")}1b{d=c.1d("3X")};5(d&&d[a]){b.2b=11;b.2B=11};14 b};4 3n=6(){3p();$("4O").18("1M",2l);$(2J).18("2P",3Y);$(2J).18("2z",3Z)};4 3p=6(){$("4O").1y("1M",2l);$(2J).1y("2P",3Y);$(2J).1y("2z",3Z)};4 4L=6(){4 a=J("1m");4 b=J("2i");4 c=F(b).1g;5(c.1a==0){$("#"+a+" 8:2k").2n();T(T())}1b{$("#"+a+" 8").2N();$("#"+a+" 8:3A(\'"+c+"\')").2n();5($("#"+a+" 8:1N").1a<=u.2d){T(-1)}}};4 4P=6(){4 a=J("2i");5($("#"+a+":2k").1a>0&&2t==12){$("#"+a+":2k").2n().5R("");F(a).4k()}};4 4Q=6(){4 a=J("2i");5($("#"+a+":1N").1a>0){$("#"+a+":1N").2N();F(a).4j()}};4 3Y=6(a){4 b=J("2i");1W(a.41){1h C:1h 4r:a.1U();a.29();4R();1i;1h 4p:1h 4q:a.1U();a.29();4S();1i;1h 4s:1h 4t:a.1U();a.29();2l();1i;1h 3M:D=11;1i;1h 3N:2t=11;1i;2v:5(a.41>=4u&&B===12){4P()};1i};5(1j==11)14 12;1V("2P")};4 3Z=6(a){1W(a.41){1h 3M:D=12;1i;1h 3N:2t=12;1i};5(1j==11)14 12;1V("2z")};4 4F=6(a){5(1j==11)14 12;1V("3E")};4 4G=6(a){5(1j==11)14 12;1V("3F")};4 4H=6(a){5(1j==11)14 12;a.1U();1V("2f")};4 4I=6(a){5(1j==11)14 12;a.1U();1V("2r")};4 4J=6(a){5(1j==11)14 12;1V("2g")};4 4K=6(a){5(1j==11)14 12;1V("2h")};4 3r=6(a,b){4 c={2A:12,2B:12,2b:12};5($(a).24("18"+b)!=1v){c.2b=11;c.2A=11};4 d=$(a).1d("3X");5(d&&d[b]){c.2b=11;c.2B=11};14 c};4 2m=6(a,b){5(u.3D==12){4 c=F(9).1E[G(a)];5(3r(c,b).2b===11){5(3r(c,b).2A===11){c["18"+b]()};5(3r(c,b).2B===11){1W(b){1h"2P":1h"2z":1i;2v:$(c).3W(b);1i}};14 12}}};4 1V=6(a){5(1w u.18[a]=="6"){u.18[a].1K(15,1t)};5(3q(a).2b===11){5(3q(a).2A===11){F(9)["18"+a]()};5(3q(a).2B===11){1W(a){1h"2P":1h"2z":1i;2v:$("#"+9).3W(a);1i}};14 12}};4 3s=6(a){4 b=J("1m");a=(a!==1v)?a:$("#"+b+" 8."+z.19);5(a.1a>0){4 c=2y(($(a).23().22));4 d=2y($("#"+b).1u());5(c>d){4 e=c+$("#"+b).2Q()-(d/2);$("#"+b).4T({2Q:e},4U)}}};4 4R=6(){4 b=J("1m");4 c=$("#"+b+" 8:1N."+A.8);4 d=$("#"+b+" 8:1N."+z.19);d=(d.1a==0)?c[0]:d;4 e=$("#"+b+" 8:1N."+A.8).1C(d);5((e<c.1a-1)){e=42(e);5(e<c.1a){5(!D||!B||!1Z){$("#"+b+" ."+z.19).1F(z.19)};$(c[e]).1s(z.19);2O(e);5(B==11){2M()};3s($(c[e]))};5(!B){3t()}};6 42(a){a=a+1;5(a>c.1a){14 a};5($(c[a]).3o(z.1o)===11){14 a};14 a=42(a)}};4 4S=6(){4 b=J("1m");4 c=$("#"+b+" 8:1N."+z.19);4 d=$("#"+b+" 8:1N."+A.8);4 e=$("#"+b+" 8:1N."+A.8).1C(c[0]);5(e>=0){e=43(e);5(e>=0){5(!D||!B||!1Z){$("#"+b+" ."+z.19).1F(z.19)};$(d[e]).1s(z.19);2O(e);5(B==11){2M()};5(2y(($(d[e]).23().22+$(d[e]).1u()))<=0){4 f=($("#"+b).2Q()-$("#"+b).1u())-$(d[e]).1u();$("#"+b).4T({2Q:f},4U)}};5(!B){3t()}};6 43(a){a=a-1;5(a<0){14 a};5($(d[a]).3o(z.1o)===11){14 a};14 a=43(a)}};4 3t=6(){4 a=J("1Q");4 b=J("1m");4 c=$("#"+a).4V();4 d=$("#"+a).1u();4 e=$(4W).1u();4 f=$(4W).2Q();4 g=$("#"+b).1u();4 h=$("#"+a).1u();5((e+f)<3m.5S(g+d+c.22)||u.4h.2E()==\'5T\'){h=g;$("#"+b).1l({22:"-"+h+"2u",1S:\'3l\',1X:u.1X});$("#"+a).1F("2w 2j").1s("3u");4 h=$("#"+b).4V().22;5(h<-10){$("#"+b).1l({22:(2y($("#"+b).1l("22"))-h+20+f)+"2u",1X:u.1X});$("#"+a).1F("3u 2j").1s("2w")}}1b{$("#"+b).1l({22:h+"2u",1X:u.1X});$("#"+a).1F("2w 3u").1s("2j")}};4 3V=6(e){5(1j==11)14 12;4 a=J("1Q");4 b=J("1m");5(!3d){3d=11;5(1A.2U!=\'\'){$("#"+1A.2U).1l({1S:"2x"})};1A.2U=b;$("#"+b+" 8:2k").2n();3t();4 c=u.4g;5(c==""||c=="2x"){$("#"+b).1l({1S:"3l"});3s();5(1w u.18.2q=="6"){4 d=26();u.18.2q(d.1d,d.1G)}}1b{$("#"+b)[c]("5U",6(){3s();5(1w u.18.2q=="6"){4 d=26();u.18.2q(d.1d,d.1G)}})};3n()}1b{5(u.3C!==\'2f\'){2l()}}};4 2l=6(e){3d=12;4 a=J("1Q");4 b=J("1m");5(B===12){$("#"+b).1l({1S:"2x"});$("#"+a).1F("2j 3u").1s("2w");2M()};3p();5(1w u.18.33=="6"){4 d=26();u.18.33(d.1d,d.1G)};4Q();T(T());$("#"+b).1l({1X:1})};4 4X=6(){5(1J.2C!=1e){1J.2C.1K(15,1t)};x.1k=15.1k;x.1g=15.1g;x.2a=(15.1k>=0)?15.1E[15.1k].1n:"";5(1w u.18.34=="6"){4 d=26();u.18.34(d.1d,d.1G)}};4 4x=6(){F(9).2C=4X};4 4w=6(){1J=$.2F(11,{},F(9));21(4 i 3i 1J){5(1w 1J[i]!="6"){x[i]=1J[i]}};x.2a=(1J.1k>=0)?1J.1E[1J.1k].1n:"";x.3w=1A.3w;x.3x=1A.3x};4 44=6(a){5(a!=1e&&1w a!="1v"){4 b=J("1m");4 c=L(a);4 d=$("#"+b+" 8."+A.8+":45("+(a.1C)+")");14{1d:c,1G:d,1R:a,1C:a.1C}};14 1e};4 26=6(){4 a=J("1m");4 b=F(9);4 c,1G,1R,1C;5(b.1k==-1){c=1e;1G=1e;1R=1e;1C=-1}1b{1G=$("#"+a+" 8."+z.19);5(1G.1a>1){4 d=[],46=[],5V=[];21(4 i=0;i<1G.1a;i++){4 e=G(1G[i]);d.4Y(e);46.4Y(b.1E[e])};c=d;1R=46;1C=d}1b{1R=b.1E[b.1k];c=L(1R);1C=b.1k}};14{1d:c,1G:1G,1C:1C,1R:1R}};4 2O=6(a,b){4 c=J("3H");4 d={};5(a==-1){d.1n="&5W;";d.1c="";d.1f="";d.1z=""}1b 5(1w a!="1v"){4 e=F(9).1E[a];d=L(e)}1b{d=b};$("#"+c).3v("."+z.2H).48(d.1n);F(c).1c=z.35+" "+d.1c;5(d.1f!=""){$("#"+c).3v("."+z.1f).48(d.1f).2n()}1b{$("#"+c).3v("."+z.1f).48("").2N()};4 f=$("#"+c).3v("3k");5(f.1a>0){$(f).1B()};5(d.1z!=""&&u.32){f=M("3k",{3S:d.1z});$("#"+c).5X(f);5(d.1x!=""){f.1c=d.1x+" "};5(d.1f==""){f.1c=f.1c+A.3b}}};4 1r=6(p,v){x[p]=v};4 49=6(a,b,i){4 c=J("1m");4 d=12;1W(a){1h"1Y":4 e=R(b||F(9).1E[i]);4 f;5(1t.1a==3){f=i}1b{f=$("#"+c+" 8."+A.8).1a-1};5(f<0||!f){$("#"+c+" 3T").5Y(e)}1b{4 g=$("#"+c+" 8."+A.8)[f];$(g).5Z(e)};V();U();5(u.18.1Y!=1e){u.18.1Y.1K(15,1t)};1i;1h"1B":d=$($("#"+c+" 8."+A.8)[i]).3o(z.19);$("#"+c+" 8."+A.8+":45("+i+")").1B();4 h=$("#"+c+" 8."+z.1o);5(d==11){5(h.1a>0){$(h[0]).1s(z.19);4 j=$("#"+c+" 8."+A.8).1C(h[0]);2o(j)}};5(h.1a==0){2o(-1)};5($("#"+c+" 8."+A.8).1a<u.2d&&!B){T(-1)};5(u.18.1B!=1e){u.18.1B.1K(15,1t)};1i}};15.60=6(){4 a=1t[0];61.62.63.64(1t);1W(a){1h"1Y":x.1Y.1K(15,1t);1i;1h"1B":x.1B.1K(15,1t);1i;2v:3g{F(9)[a].1K(F(9),1t)}3j(e){};1i}};15.1Y=6(){4 a,1g,1p,1z,1f;4 b=1t[0];5(b 65 66){2c=b}1b 5(1w b=="67"){a=b;1g=a;2c=3h 3P(a,1g)}1b{a=b.1n||\'\';1g=b.1g||a;1p=b.1p||\'\';1z=b.1z||\'\';1f=b.1f||\'\';2c=3h 3P(a,1g);$(2c).1d("1f",1f);$(2c).1d("1z",1z);$(2c).1d("1p",1p)};1t[0]=2c;F(9).1Y.1K(F(9),1t);1r("1T",F(9)["1T"]);1r("1a",F(9).1a);49("1Y",2c,1t[1])};15.1B=6(i){F(9).1B(i);1r("1T",F(9)["1T"]);1r("1a",F(9).1a);49("1B",1v,i)};15.68=6(a,b){5(1w a=="1v"||1w b=="1v")14 12;a=a.69();3g{1r(a,b)}3j(e){};1W(a){1h"25":F(9)[a]=b;5(b==0){F(9).1P=12};B=(F(9).25>1||F(9).1P==11)?11:12;X();1i;1h"1P":B=(F(9).25>1||F(9).1P==11)?11:12;1Z=F(9).1P;X();1r(a,b);1i;1h"2s":F(9)[a]=b;1j=b;Y();1i;1h"1k":1h"1g":F(9)[a]=b;4 c=J("1m");$("#"+c+" 8."+A.8).1F(z.19);$($("#"+c+" 8."+A.8)[F(9).1k]).1s(z.19);2o(F(9).1k);1i;1h"1a":4 c=J("1m");5(b<F(9).1a){F(9)[a]=b;5(b==0){$("#"+c+" 8."+A.8).1B();2o(-1)}1b{$("#"+c+" 8."+A.8+":6a("+(b-1)+")").1B();5($("#"+c+" 8."+z.19).1a==0){$("#"+c+" 8."+z.1o+":45(0)").1s(z.19)}};1r(a,b);1r("1T",F(9)["1T"])};1i;1h"1D":1i;2v:3g{F(9)[a]=b;1r(a,b)}3j(e){};1i}};15.6b=6(a){14 x[a]||F(9)[a]};15.1N=6(a){4 b=J("1Q");5(a==11){$("#"+b).2n()}1b 5(a==12){$("#"+b).2N()}1b{14 $("#"+b).1l("1S")}};15.3y=6(v){1A.3y(v)};15.33=6(){2l()};15.2q=6(){3V()};15.4Z=6(r){5(1w r=="1v"||r==0){14 12};u.2d=r;T(T())};15.2d=15.4Z;15.18=6(a,b){$("#"+9).18(a,b)};15.1y=6(a,b){$("#"+9).1y(a,b)};15.6c=15.18;15.6d=6(){14 26()};15.50=6(){4 a=F(9).50.1K(F(9),1t);14 44(a)};15.51=6(){4 a=F(9).51.1K(F(9),1t);14 44(a)};15.6e=6(){4 a=J("3G");4 b=J("1Q");$("#"+b+", #"+b+" *").1y();$("#"+b).1B();$("#"+9).6f().6g($("#"+9));F(9).2C=6(){5(1J.2C!=1e){1J.2C.1K(15,1t)}};$("#"+9).1d("1O",1e)};I()};$.1L.2F({2X:6(b){14 15.6h(6(){5(!$(15).1d(\'1O\')){4 a=3h 1O(15,b);$(15).1d(\'1O\',a)}})}});$.1L.2W=$.1L.2X})(6i);', 0, 391, "||||var|if|function||li|_element||||||||||||||||||||||||||||||||||||||||||||||||||||||true|false||return|this|||on|selected|length|else|className|data|null|description|value|case|break|_isDisabled|selectedIndex|css|postChildID|text|enabled|title|appendChild|cq|addClass|arguments|height|undefined|typeof|imagecss|off|image|msBeautify|remove|index|id|options|removeClass|ui|byJson|style|_orginial|apply|fn|click|visible|dd|multiple|postID|option|display|children|preventDefault|cd|switch|zIndex|add|_isMultiple||for|top|position|prop|size|co||span|stopPropagation|selectedText|hasEvent|opt|visibleRows|useSprite|mouseover|mousedown|mouseup|postTitleTextID|borderRadiusTp|hidden|cj|cc|show|bM|jsonTitle|open|mouseout|disabled|_controlHolded|px|default|borderRadius|none|parseInt|keyup|byElement|byJQuery|onchange|ddOutOfVision|toLowerCase|extend|ddTitle|label|hover|document|div|mouseenter|bL|hide|cp|keydown|scrollTop|counter|auto|absolute|oldDiv|create|msDropdown|msDropDown|expr|toUpperCase|width|rowHeight|showIcon|close|change|ddTitleText|optgroup||||disabledAll|fnone|_cacheElement|_isOpen|_lastTarget|_forcedTrigger|try|new|in|catch|img|block|Math|bO|hasClass|bP|bN|cb|ce|ch|borderRadiusBtm|find|version|author|debug|dropdown|Contains|name|event|disabledOptionEvents|dblclick|mousemove|postElementHolder|postTitleID|arrow|ddChild|divider|optgroupTitle|SHIFT|CONTROL|_oldSelected|Option|overflow|selectedClass|src|ul|first|ci|trigger|events|bT|bU||keyCode|getNext|getPrev|cn|eq|op||html|cr|relative|0px|select|createPseudo|indexOf|mainCSS|animStyle|openDirection|disabledOpacity|blur|focus|borderTop|noBorderTop|ddChildMore|shadow|UP_ARROW|LEFT_ARROW|RIGHT_ARROW|ESCAPE|ENTER|ALPHABETS_START|eval|cm|cl|bJ|uiData|selectedOptions|cssText|after|padding|visibility|bV|bW|bX|bY|bZ|ca|bQ|bK|_data|body|bR|bS|cf|cg|animate|500|offset|window|ck|push|showRows|namedItem|item|Marghoob|Suleman|attr|bind|unbind|250|120|9999|slideDown|_msddHolder|_msdd|_title|_titleText|_child|arrowoff|ddlabel|_msddli_|border|_isCreated|getElementById|msdropdown|inArray|setAttribute|throw|There|is|an|error|json|msdrpdd|maincss|test|createElement|innerHTML|appendTo|ddcommon|outerWidth|usesprite|input|type|autocomplete|clear|ddchild_|nodeName|bottom|round|min|max|toggleClass|mouseleave|object|val|floor|alwaysup|fast|ind|nbsp|prepend|append|before|act|Array|prototype|shift|call|instanceof|HTMLOptionElement|string|set|toString|gt|get|addMyEvent|getData|destory|parent|replaceWith|each|jQuery".split("|"), 0, {})),
    function(e) {
        "function" == typeof define && define.amd ? define(["jquery"], e) : e("object" == typeof exports ? require("jquery") : jQuery)
    }(function(I, E) {
        function A() {
            return new Date(Date.UTC.apply(Date, arguments))
        }

        function N() {
            var e = new Date;
            return A(e.getFullYear(), e.getMonth(), e.getDate())
        }

        function o(e, t) {
            return e.getUTCFullYear() === t.getUTCFullYear() && e.getUTCMonth() === t.getUTCMonth() && e.getUTCDate() === t.getUTCDate()
        }

        function e(e, t) {
            return function() {
                return t !== E && I.fn.datepicker.deprecated(t), this[e].apply(this, arguments)
            }
        }

        function w(e, t) {
            I.data(e, "datepicker", this), this._events = [], this._secondaryEvents = [], this._process_options(t), this.dates = new i, this.viewDate = this.o.defaultViewDate, this.focusDate = null, this.element = I(e), this.isInput = this.element.is("input"), this.inputField = this.isInput ? this.element : this.element.find("input"), this.component = !!this.element.hasClass("date") && this.element.find(".add-on, .input-group-addon, .input-group-append, .input-group-prepend, .btn"), this.component && 0 === this.component.length && (this.component = !1), this.isInline = !this.component && this.element.is("div"), this.picker = I(O.template), this._check_template(this.o.templates.leftArrow) && this.picker.find(".prev").html(this.o.templates.leftArrow), this._check_template(this.o.templates.rightArrow) && this.picker.find(".next").html(this.o.templates.rightArrow), this._buildEvents(), this._attachEvents(), this.isInline ? this.picker.addClass("datepicker-inline").appendTo(this.element) : this.picker.addClass("datepicker-dropdown dropdown-menu"), this.o.rtl && this.picker.addClass("datepicker-rtl"), this.o.calendarWeeks && this.picker.find(".datepicker-days .datepicker-switch, thead .datepicker-title, tfoot .today, tfoot .clear").attr("colspan", function(e, t) {
                return Number(t) + 1
            }), this._process_options({
                startDate: this._o.startDate,
                endDate: this._o.endDate,
                daysOfWeekDisabled: this.o.daysOfWeekDisabled,
                daysOfWeekHighlighted: this.o.daysOfWeekHighlighted,
                datesDisabled: this.o.datesDisabled
            }), this._allow_update = !1, this.setViewMode(this.o.startView), this._allow_update = !0, this.fillDow(), this.fillMonths(), this.update(), this.isInline && this.show()
        }
        var t, i = (t = {
            get: function(e) {
                return this.slice(e)[0]
            },
            contains: function(e) {
                for (var t = e && e.valueOf(), i = 0, n = this.length; i < n; i++)
                    if (0 <= this[i].valueOf() - t && this[i].valueOf() - t < 864e5) return i;
                return -1
            },
            remove: function(e) {
                this.splice(e, 1)
            },
            replace: function(e) {
                e && (I.isArray(e) || (e = [e]), this.clear(), this.push.apply(this, e))
            },
            clear: function() {
                this.length = 0
            },
            copy: function() {
                var e = new i;
                return e.replace(this), e
            }
        }, function() {
            var e = [];
            return e.push.apply(e, arguments), I.extend(e, t), e
        });

        function c(e, t) {
            I.data(e, "datepicker", this), this.element = I(e), this.inputs = I.map(t.inputs, function(e) {
                return e.jquery ? e[0] : e
            }), delete t.inputs, this.keepEmptyValues = t.keepEmptyValues, delete t.keepEmptyValues, s.call(I(this.inputs), t).on("changeDate", I.proxy(this.dateUpdated, this)), this.pickers = I.map(this.inputs, function(e) {
                return I.data(e, "datepicker")
            }), this.updateDates()
        }
        w.prototype = {
            constructor: w,
            _resolveViewName: function(i) {
                return I.each(O.viewModes, function(e, t) {
                    if (i === e || -1 !== I.inArray(i, t.names)) return i = e, !1
                }), i
            },
            _resolveDaysOfWeek: function(e) {
                return I.isArray(e) || (e = e.split(/[,\s]*/)), I.map(e, Number)
            },
            _check_template: function(e) {
                try {
                    return e !== E && "" !== e && ((e.match(/[<>]/g) || []).length <= 0 || 0 < I(e).length)
                } catch (e) {
                    return !1
                }
            },
            _process_options: function(e) {
                this._o = I.extend({}, this._o, e);
                var t = this.o = I.extend({}, this._o),
                    i = t.language;
                M[i] || (i = i.split("-")[0], M[i] || (i = h.language)), t.language = i, t.startView = this._resolveViewName(t.startView), t.minViewMode = this._resolveViewName(t.minViewMode), t.maxViewMode = this._resolveViewName(t.maxViewMode), t.startView = Math.max(this.o.minViewMode, Math.min(this.o.maxViewMode, t.startView)), !0 !== t.multidate && (t.multidate = Number(t.multidate) || !1, !1 !== t.multidate && (t.multidate = Math.max(0, t.multidate))), t.multidateSeparator = String(t.multidateSeparator), t.weekStart %= 7, t.weekEnd = (t.weekStart + 6) % 7;
                var n = O.parseFormat(t.format);
                t.startDate !== -1 / 0 && (t.startDate ? t.startDate instanceof Date ? t.startDate = this._local_to_utc(this._zero_time(t.startDate)) : t.startDate = O.parseDate(t.startDate, n, t.language, t.assumeNearbyYear) : t.startDate = -1 / 0), t.endDate !== 1 / 0 && (t.endDate ? t.endDate instanceof Date ? t.endDate = this._local_to_utc(this._zero_time(t.endDate)) : t.endDate = O.parseDate(t.endDate, n, t.language, t.assumeNearbyYear) : t.endDate = 1 / 0), t.daysOfWeekDisabled = this._resolveDaysOfWeek(t.daysOfWeekDisabled || []), t.daysOfWeekHighlighted = this._resolveDaysOfWeek(t.daysOfWeekHighlighted || []), t.datesDisabled = t.datesDisabled || [], I.isArray(t.datesDisabled) || (t.datesDisabled = t.datesDisabled.split(",")), t.datesDisabled = I.map(t.datesDisabled, function(e) {
                    return O.parseDate(e, n, t.language, t.assumeNearbyYear)
                });
                var s = String(t.orientation).toLowerCase().split(/\s+/g),
                    o = t.orientation.toLowerCase();
                if (s = I.grep(s, function(e) {
                        return /^auto|left|right|top|bottom$/.test(e)
                    }), t.orientation = {
                        x: "auto",
                        y: "auto"
                    }, o && "auto" !== o)
                    if (1 === s.length) switch (s[0]) {
                        case "top":
                        case "bottom":
                            t.orientation.y = s[0];
                            break;
                        case "left":
                        case "right":
                            t.orientation.x = s[0]
                    } else o = I.grep(s, function(e) {
                        return /^left|right$/.test(e)
                    }), t.orientation.x = o[0] || "auto", o = I.grep(s, function(e) {
                        return /^top|bottom$/.test(e)
                    }), t.orientation.y = o[0] || "auto";
                if (t.defaultViewDate instanceof Date || "string" == typeof t.defaultViewDate) t.defaultViewDate = O.parseDate(t.defaultViewDate, n, t.language, t.assumeNearbyYear);
                else if (t.defaultViewDate) {
                    var a = t.defaultViewDate.year || (new Date).getFullYear(),
                        r = t.defaultViewDate.month || 0,
                        l = t.defaultViewDate.day || 1;
                    t.defaultViewDate = A(a, r, l)
                } else t.defaultViewDate = N()
            },
            _applyEvents: function(e) {
                for (var t, i, n, s = 0; s < e.length; s++) t = e[s][0], 2 === e[s].length ? (i = E, n = e[s][1]) : 3 === e[s].length && (i = e[s][1], n = e[s][2]), t.on(n, i)
            },
            _unapplyEvents: function(e) {
                for (var t, i, n, s = 0; s < e.length; s++) t = e[s][0], 2 === e[s].length ? (n = E, i = e[s][1]) : 3 === e[s].length && (n = e[s][1], i = e[s][2]), t.off(i, n)
            },
            _buildEvents: function() {
                var e = {
                    keyup: I.proxy(function(e) {
                        -1 === I.inArray(e.keyCode, [27, 37, 39, 38, 40, 32, 13, 9]) && this.update()
                    }, this),
                    keydown: I.proxy(this.keydown, this),
                    paste: I.proxy(this.paste, this)
                };
                !0 === this.o.showOnFocus && (e.focus = I.proxy(this.show, this)), this.isInput ? this._events = [
                    [this.element, e]
                ] : this.component && this.inputField.length ? this._events = [
                    [this.inputField, e],
                    [this.component, {
                        click: I.proxy(this.show, this)
                    }]
                ] : this._events = [
                    [this.element, {
                        click: I.proxy(this.show, this),
                        keydown: I.proxy(this.keydown, this)
                    }]
                ], this._events.push([this.element, "*", {
                    blur: I.proxy(function(e) {
                        this._focused_from = e.target
                    }, this)
                }], [this.element, {
                    blur: I.proxy(function(e) {
                        this._focused_from = e.target
                    }, this)
                }]), this.o.immediateUpdates && this._events.push([this.element, {
                    "changeYear changeMonth": I.proxy(function(e) {
                        this.update(e.date)
                    }, this)
                }]), this._secondaryEvents = [
                    [this.picker, {
                        click: I.proxy(this.click, this)
                    }],
                    [this.picker, ".prev, .next", {
                        click: I.proxy(this.navArrowsClick, this)
                    }],
                    [this.picker, ".day:not(.disabled)", {
                        click: I.proxy(this.dayCellClick, this)
                    }],
                    [I(window), {
                        resize: I.proxy(this.place, this)
                    }],
                    [I(document), {
                        "mousedown touchstart": I.proxy(function(e) {
                            this.element.is(e.target) || this.element.find(e.target).length || this.picker.is(e.target) || this.picker.find(e.target).length || this.isInline || this.hide()
                        }, this)
                    }]
                ]
            },
            _attachEvents: function() {
                this._detachEvents(), this._applyEvents(this._events)
            },
            _detachEvents: function() {
                this._unapplyEvents(this._events)
            },
            _attachSecondaryEvents: function() {
                this._detachSecondaryEvents(), this._applyEvents(this._secondaryEvents)
            },
            _detachSecondaryEvents: function() {
                this._unapplyEvents(this._secondaryEvents)
            },
            _trigger: function(e, t) {
                var i = t || this.dates.get(-1),
                    n = this._utc_to_local(i);
                this.element.trigger({
                    type: e,
                    date: n,
                    viewMode: this.viewMode,
                    dates: I.map(this.dates, this._utc_to_local),
                    format: I.proxy(function(e, t) {
                        0 === arguments.length ? (e = this.dates.length - 1, t = this.o.format) : "string" == typeof e && (t = e, e = this.dates.length - 1), t = t || this.o.format;
                        var i = this.dates.get(e);
                        return O.formatDate(i, t, this.o.language)
                    }, this)
                })
            },
            show: function() {
                if (!(this.inputField.is(":disabled") || this.inputField.prop("readonly") && !1 === this.o.enableOnReadonly)) return this.isInline || this.picker.appendTo(this.o.container), this.place(), this.picker.show(), this._attachSecondaryEvents(), this._trigger("show"), (window.navigator.msMaxTouchPoints || "ontouchstart" in document) && this.o.disableTouchKeyboard && I(this.element).blur(), this
            },
            hide: function() {
                return this.isInline || !this.picker.is(":visible") || (this.focusDate = null, this.picker.hide().detach(), this._detachSecondaryEvents(), this.setViewMode(this.o.startView), this.o.forceParse && this.inputField.val() && this.setValue(), this._trigger("hide")), this
            },
            destroy: function() {
                return this.hide(), this._detachEvents(), this._detachSecondaryEvents(), this.picker.remove(), delete this.element.data().datepicker, this.isInput || delete this.element.data().date, this
            },
            paste: function(e) {
                var t;
                if (e.originalEvent.clipboardData && e.originalEvent.clipboardData.types && -1 !== I.inArray("text/plain", e.originalEvent.clipboardData.types)) t = e.originalEvent.clipboardData.getData("text/plain");
                else {
                    if (!window.clipboardData) return;
                    t = window.clipboardData.getData("Text")
                }
                this.setDate(t), this.update(), e.preventDefault()
            },
            _utc_to_local: function(e) {
                if (!e) return e;
                var t = new Date(e.getTime() + 6e4 * e.getTimezoneOffset());
                return t.getTimezoneOffset() !== e.getTimezoneOffset() && (t = new Date(e.getTime() + 6e4 * t.getTimezoneOffset())), t
            },
            _local_to_utc: function(e) {
                return e && new Date(e.getTime() - 6e4 * e.getTimezoneOffset())
            },
            _zero_time: function(e) {
                return e && new Date(e.getFullYear(), e.getMonth(), e.getDate())
            },
            _zero_utc_time: function(e) {
                return e && A(e.getUTCFullYear(), e.getUTCMonth(), e.getUTCDate())
            },
            getDates: function() {
                return I.map(this.dates, this._utc_to_local)
            },
            getUTCDates: function() {
                return I.map(this.dates, function(e) {
                    return new Date(e)
                })
            },
            getDate: function() {
                return this._utc_to_local(this.getUTCDate())
            },
            getUTCDate: function() {
                var e = this.dates.get(-1);
                return e !== E ? new Date(e) : null
            },
            clearDates: function() {
                this.inputField.val(""), this.update(), this._trigger("changeDate"), this.o.autoclose && this.hide()
            },
            setDates: function() {
                var e = I.isArray(arguments[0]) ? arguments[0] : arguments;
                return this.update.apply(this, e), this._trigger("changeDate"), this.setValue(), this
            },
            setUTCDates: function() {
                var e = I.isArray(arguments[0]) ? arguments[0] : arguments;
                return this.setDates.apply(this, I.map(e, this._utc_to_local)), this
            },
            setDate: e("setDates"),
            setUTCDate: e("setUTCDates"),
            remove: e("destroy", "Method `remove` is deprecated and will be removed in version 2.0. Use `destroy` instead"),
            setValue: function() {
                var e = this.getFormattedDate();
                return this.inputField.val(e), this
            },
            getFormattedDate: function(t) {
                t === E && (t = this.o.format);
                var i = this.o.language;
                return I.map(this.dates, function(e) {
                    return O.formatDate(e, t, i)
                }).join(this.o.multidateSeparator)
            },
            getStartDate: function() {
                return this.o.startDate
            },
            setStartDate: function(e) {
                return this._process_options({
                    startDate: e
                }), this.update(), this.updateNavArrows(), this
            },
            getEndDate: function() {
                return this.o.endDate
            },
            setEndDate: function(e) {
                return this._process_options({
                    endDate: e
                }), this.update(), this.updateNavArrows(), this
            },
            setDaysOfWeekDisabled: function(e) {
                return this._process_options({
                    daysOfWeekDisabled: e
                }), this.update(), this
            },
            setDaysOfWeekHighlighted: function(e) {
                return this._process_options({
                    daysOfWeekHighlighted: e
                }), this.update(), this
            },
            setDatesDisabled: function(e) {
                return this._process_options({
                    datesDisabled: e
                }), this.update(), this
            },
            place: function() {
                if (this.isInline) return this;
                var e = this.picker.outerWidth(),
                    t = this.picker.outerHeight(),
                    i = I(this.o.container),
                    n = i.width(),
                    s = "body" === this.o.container ? I(document).scrollTop() : i.scrollTop(),
                    o = i.offset(),
                    a = [0];
                this.element.parents().each(function() {
                    var e = I(this).css("z-index");
                    "auto" !== e && 0 !== Number(e) && a.push(Number(e))
                });
                var r = Math.max.apply(Math, a) + this.o.zIndexOffset,
                    l = this.component ? this.component.parent().offset() : this.element.offset(),
                    c = this.component ? this.component.outerHeight(!0) : this.element.outerHeight(!1),
                    h = this.component ? this.component.outerWidth(!0) : this.element.outerWidth(!1),
                    u = l.left - o.left,
                    d = l.top - o.top;
                "body" !== this.o.container && (d += s), this.picker.removeClass("datepicker-orient-top datepicker-orient-bottom datepicker-orient-right datepicker-orient-left"), "auto" !== this.o.orientation.x ? (this.picker.addClass("datepicker-orient-" + this.o.orientation.x), "right" === this.o.orientation.x && (u -= e - h)) : l.left < 0 ? (this.picker.addClass("datepicker-orient-left"), u -= l.left - 10) : n < u + e ? (this.picker.addClass("datepicker-orient-right"), u += h - e) : this.o.rtl ? this.picker.addClass("datepicker-orient-right") : this.picker.addClass("datepicker-orient-left");
                var p = this.o.orientation.y;
                if ("auto" === p && (p = -s + d - t < 0 ? "bottom" : "top"), this.picker.addClass("datepicker-orient-" + p), "top" === p ? d -= t + parseInt(this.picker.css("padding-top")) : d += c, this.o.rtl) {
                    var f = n - (u + h);
                    this.picker.css({
                        top: d,
                        right: f,
                        zIndex: r
                    })
                } else this.picker.css({
                    top: d,
                    left: u,
                    zIndex: r
                });
                return this
            },
            _allow_update: !0,
            update: function() {
                if (!this._allow_update) return this;
                var e = this.dates.copy(),
                    i = [],
                    t = !1;
                return arguments.length ? (I.each(arguments, I.proxy(function(e, t) {
                    t instanceof Date && (t = this._local_to_utc(t)), i.push(t)
                }, this)), t = !0) : (i = (i = this.isInput ? this.element.val() : this.element.data("date") || this.inputField.val()) && this.o.multidate ? i.split(this.o.multidateSeparator) : [i], delete this.element.data().date), i = I.map(i, I.proxy(function(e) {
                    return O.parseDate(e, this.o.format, this.o.language, this.o.assumeNearbyYear)
                }, this)), i = I.grep(i, I.proxy(function(e) {
                    return !this.dateWithinRange(e) || !e
                }, this), !0), this.dates.replace(i), this.o.updateViewDate && (this.dates.length ? this.viewDate = new Date(this.dates.get(-1)) : this.viewDate < this.o.startDate ? this.viewDate = new Date(this.o.startDate) : this.viewDate > this.o.endDate ? this.viewDate = new Date(this.o.endDate) : this.viewDate = this.o.defaultViewDate), t ? (this.setValue(), this.element.change()) : this.dates.length && String(e) !== String(this.dates) && t && (this._trigger("changeDate"), this.element.change()), !this.dates.length && e.length && (this._trigger("clearDate"), this.element.change()), this.fill(), this
            },
            fillDow: function() {
                if (this.o.showWeekDays) {
                    var e = this.o.weekStart,
                        t = "<tr>";
                    for (this.o.calendarWeeks && (t += '<th class="cw">&#160;</th>'); e < this.o.weekStart + 7;) t += '<th class="dow', -1 !== I.inArray(e, this.o.daysOfWeekDisabled) && (t += " disabled"), t += '">' + M[this.o.language].daysMin[e++ % 7] + "</th>";
                    t += "</tr>", this.picker.find(".datepicker-days thead").append(t)
                }
            },
            fillMonths: function() {
                for (var e = this._utc_to_local(this.viewDate), t = "", i = 0; i < 12; i++) t += '<span class="month' + (e && e.getMonth() === i ? " focused" : "") + '">' + M[this.o.language].monthsShort[i] + "</span>";
                this.picker.find(".datepicker-months td").html(t)
            },
            setRange: function(e) {
                e && e.length ? this.range = I.map(e, function(e) {
                    return e.valueOf()
                }) : delete this.range, this.fill()
            },
            getClassNames: function(e) {
                var t = [],
                    i = this.viewDate.getUTCFullYear(),
                    n = this.viewDate.getUTCMonth(),
                    s = N();
                return e.getUTCFullYear() < i || e.getUTCFullYear() === i && e.getUTCMonth() < n ? t.push("old") : (e.getUTCFullYear() > i || e.getUTCFullYear() === i && e.getUTCMonth() > n) && t.push("new"), this.focusDate && e.valueOf() === this.focusDate.valueOf() && t.push("focused"), this.o.todayHighlight && o(e, s) && t.push("today"), -1 !== this.dates.contains(e) && t.push("active"), this.dateWithinRange(e) || t.push("disabled"), this.dateIsDisabled(e) && t.push("disabled", "disabled-date"), -1 !== I.inArray(e.getUTCDay(), this.o.daysOfWeekHighlighted) && t.push("highlighted"), this.range && (e > this.range[0] && e < this.range[this.range.length - 1] && t.push("range"), -1 !== I.inArray(e.valueOf(), this.range) && t.push("selected"), e.valueOf() === this.range[0] && t.push("range-start"), e.valueOf() === this.range[this.range.length - 1] && t.push("range-end")), t
            },
            _fill_yearsView: function(e, t, i, n, s, o, a) {
                for (var r, l, c, h = "", u = i / 10, d = this.picker.find(e), p = Math.floor(n / i) * i, f = p + 9 * u, m = Math.floor(this.viewDate.getFullYear() / u) * u, g = I.map(this.dates, function(e) {
                        return Math.floor(e.getUTCFullYear() / u) * u
                    }), v = p - u; v <= f + u; v += u) r = [t], l = null, v === p - u ? r.push("old") : v === f + u && r.push("new"), -1 !== I.inArray(v, g) && r.push("active"), (v < s || o < v) && r.push("disabled"), v === m && r.push("focused"), a !== I.noop && ((c = a(new Date(v, 0, 1))) === E ? c = {} : "boolean" == typeof c ? c = {
                    enabled: c
                } : "string" == typeof c && (c = {
                    classes: c
                }), !1 === c.enabled && r.push("disabled"), c.classes && (r = r.concat(c.classes.split(/\s+/))), c.tooltip && (l = c.tooltip)), h += '<span class="' + r.join(" ") + '"' + (l ? ' title="' + l + '"' : "") + ">" + v + "</span>";
                d.find(".datepicker-switch").text(p + "-" + f), d.find("td").html(h)
            },
            fill: function() {
                var e, t, i = new Date(this.viewDate),
                    s = i.getUTCFullYear(),
                    n = i.getUTCMonth(),
                    o = this.o.startDate !== -1 / 0 ? this.o.startDate.getUTCFullYear() : -1 / 0,
                    a = this.o.startDate !== -1 / 0 ? this.o.startDate.getUTCMonth() : -1 / 0,
                    r = this.o.endDate !== 1 / 0 ? this.o.endDate.getUTCFullYear() : 1 / 0,
                    l = this.o.endDate !== 1 / 0 ? this.o.endDate.getUTCMonth() : 1 / 0,
                    c = M[this.o.language].today || M.en.today || "",
                    h = M[this.o.language].clear || M.en.clear || "",
                    u = M[this.o.language].titleFormat || M.en.titleFormat,
                    d = N(),
                    p = (!0 === this.o.todayBtn || "linked" === this.o.todayBtn) && d >= this.o.startDate && d <= this.o.endDate && !this.weekOfDateIsDisabled(d);
                if (!isNaN(s) && !isNaN(n)) {
                    this.picker.find(".datepicker-days .datepicker-switch").text(O.formatDate(i, u, this.o.language)), this.picker.find("tfoot .today").text(c).css("display", p ? "table-cell" : "none"), this.picker.find("tfoot .clear").text(h).css("display", !0 === this.o.clearBtn ? "table-cell" : "none"), this.picker.find("thead .datepicker-title").text(this.o.title).css("display", "string" == typeof this.o.title && "" !== this.o.title ? "table-cell" : "none"), this.updateNavArrows(), this.fillMonths();
                    var f = A(s, n, 0),
                        m = f.getUTCDate();
                    f.setUTCDate(m - (f.getUTCDay() - this.o.weekStart + 7) % 7);
                    var g = new Date(f);
                    f.getUTCFullYear() < 100 && g.setUTCFullYear(f.getUTCFullYear()), g.setUTCDate(g.getUTCDate() + 42), g = g.valueOf();
                    for (var v, b, _ = []; f.valueOf() < g;) {
                        if ((v = f.getUTCDay()) === this.o.weekStart && (_.push("<tr>"), this.o.calendarWeeks)) {
                            var y = new Date(+f + (this.o.weekStart - v - 7) % 7 * 864e5),
                                w = new Date(Number(y) + (11 - y.getUTCDay()) % 7 * 864e5),
                                x = new Date(Number(x = A(w.getUTCFullYear(), 0, 1)) + (11 - x.getUTCDay()) % 7 * 864e5),
                                C = (w - x) / 864e5 / 7 + 1;
                            _.push('<td class="cw">' + C + "</td>")
                        }(b = this.getClassNames(f)).push("day");
                        var k = f.getUTCDate();
                        this.o.beforeShowDay !== I.noop && ((t = this.o.beforeShowDay(this._utc_to_local(f))) === E ? t = {} : "boolean" == typeof t ? t = {
                            enabled: t
                        } : "string" == typeof t && (t = {
                            classes: t
                        }), !1 === t.enabled && b.push("disabled"), t.classes && (b = b.concat(t.classes.split(/\s+/))), t.tooltip && (e = t.tooltip), t.content && (k = t.content)), b = I.isFunction(I.uniqueSort) ? I.uniqueSort(b) : I.unique(b), _.push('<td class="' + b.join(" ") + '"' + (e ? ' title="' + e + '"' : "") + ' data-date="' + f.getTime().toString() + '">' + k + "</td>"), e = null, v === this.o.weekEnd && _.push("</tr>"), f.setUTCDate(f.getUTCDate() + 1)
                    }
                    this.picker.find(".datepicker-days tbody").html(_.join(""));
                    var D = M[this.o.language].monthsTitle || M.en.monthsTitle || "Months",
                        T = this.picker.find(".datepicker-months").find(".datepicker-switch").text(this.o.maxViewMode < 2 ? D : s).end().find("tbody span").removeClass("active");
                    if (I.each(this.dates, function(e, t) {
                            t.getUTCFullYear() === s && T.eq(t.getUTCMonth()).addClass("active")
                        }), (s < o || r < s) && T.addClass("disabled"), s === o && T.slice(0, a).addClass("disabled"), s === r && T.slice(l + 1).addClass("disabled"), this.o.beforeShowMonth !== I.noop) {
                        var S = this;
                        I.each(T, function(e, t) {
                            var i = new Date(s, e, 1),
                                n = S.o.beforeShowMonth(i);
                            n === E ? n = {} : "boolean" == typeof n ? n = {
                                enabled: n
                            } : "string" == typeof n && (n = {
                                classes: n
                            }), !1 !== n.enabled || I(t).hasClass("disabled") || I(t).addClass("disabled"), n.classes && I(t).addClass(n.classes), n.tooltip && I(t).prop("title", n.tooltip)
                        })
                    }
                    this._fill_yearsView(".datepicker-years", "year", 10, s, o, r, this.o.beforeShowYear), this._fill_yearsView(".datepicker-decades", "decade", 100, s, o, r, this.o.beforeShowDecade), this._fill_yearsView(".datepicker-centuries", "century", 1e3, s, o, r, this.o.beforeShowCentury)
                }
            },
            updateNavArrows: function() {
                if (this._allow_update) {
                    var e, t, i = new Date(this.viewDate),
                        n = i.getUTCFullYear(),
                        s = i.getUTCMonth(),
                        o = this.o.startDate !== -1 / 0 ? this.o.startDate.getUTCFullYear() : -1 / 0,
                        a = this.o.startDate !== -1 / 0 ? this.o.startDate.getUTCMonth() : -1 / 0,
                        r = this.o.endDate !== 1 / 0 ? this.o.endDate.getUTCFullYear() : 1 / 0,
                        l = this.o.endDate !== 1 / 0 ? this.o.endDate.getUTCMonth() : 1 / 0,
                        c = 1;
                    switch (this.viewMode) {
                        case 4:
                            c *= 10;
                        case 3:
                            c *= 10;
                        case 2:
                            c *= 10;
                        case 1:
                            e = Math.floor(n / c) * c <= o, t = Math.floor(n / c) * c + c > r;
                            break;
                        case 0:
                            e = n <= o && s <= a, t = r <= n && l <= s
                    }
                    this.picker.find(".prev").toggleClass("disabled", e), this.picker.find(".next").toggleClass("disabled", t)
                }
            },
            click: function(e) {
                var t, i, n;
                e.preventDefault(), e.stopPropagation(), (t = I(e.target)).hasClass("datepicker-switch") && this.viewMode !== this.o.maxViewMode && this.setViewMode(this.viewMode + 1), t.hasClass("today") && !t.hasClass("day") && (this.setViewMode(0), this._setDate(N(), "linked" === this.o.todayBtn ? null : "view")), t.hasClass("clear") && this.clearDates(), t.hasClass("disabled") || (t.hasClass("month") || t.hasClass("year") || t.hasClass("decade") || t.hasClass("century")) && (this.viewDate.setUTCDate(1), 1 === this.viewMode ? (n = t.parent().find("span").index(t), i = this.viewDate.getUTCFullYear(), this.viewDate.setUTCMonth(n)) : (n = 0, i = Number(t.text()), this.viewDate.setUTCFullYear(i)), this._trigger(O.viewModes[this.viewMode - 1].e, this.viewDate), this.viewMode === this.o.minViewMode ? this._setDate(A(i, n, 1)) : (this.setViewMode(this.viewMode - 1), this.fill())), this.picker.is(":visible") && this._focused_from && this._focused_from.focus(), delete this._focused_from
            },
            dayCellClick: function(e) {
                var t = I(e.currentTarget).data("date"),
                    i = new Date(t);
                this.o.updateViewDate && (i.getUTCFullYear() !== this.viewDate.getUTCFullYear() && this._trigger("changeYear", this.viewDate), i.getUTCMonth() !== this.viewDate.getUTCMonth() && this._trigger("changeMonth", this.viewDate)), this._setDate(i)
            },
            navArrowsClick: function(e) {
                var t = I(e.currentTarget).hasClass("prev") ? -1 : 1;
                0 !== this.viewMode && (t *= 12 * O.viewModes[this.viewMode].navStep), this.viewDate = this.moveMonth(this.viewDate, t), this._trigger(O.viewModes[this.viewMode].e, this.viewDate), this.fill()
            },
            _toggle_multidate: function(e) {
                var t = this.dates.contains(e);
                if (e || this.dates.clear(), -1 !== t ? (!0 === this.o.multidate || 1 < this.o.multidate || this.o.toggleActive) && this.dates.remove(t) : (!1 === this.o.multidate && this.dates.clear(), this.dates.push(e)), "number" == typeof this.o.multidate)
                    for (; this.dates.length > this.o.multidate;) this.dates.remove(0)
            },
            _setDate: function(e, t) {
                t && "date" !== t || this._toggle_multidate(e && new Date(e)), (!t && this.o.updateViewDate || "view" === t) && (this.viewDate = e && new Date(e)), this.fill(), this.setValue(), t && "view" === t || this._trigger("changeDate"), this.inputField.trigger("change"), !this.o.autoclose || t && "date" !== t || this.hide()
            },
            moveDay: function(e, t) {
                var i = new Date(e);
                return i.setUTCDate(e.getUTCDate() + t), i
            },
            moveWeek: function(e, t) {
                return this.moveDay(e, 7 * t)
            },
            moveMonth: function(e, t) {
                if (!e || isNaN(e.getTime())) return this.o.defaultViewDate;
                if (!t) return e;
                var i, n, s = new Date(e.valueOf()),
                    o = s.getUTCDate(),
                    a = s.getUTCMonth(),
                    r = Math.abs(t);
                if (t = 0 < t ? 1 : -1, 1 === r) n = -1 === t ? function() {
                    return s.getUTCMonth() === a
                } : function() {
                    return s.getUTCMonth() !== i
                }, i = a + t, s.setUTCMonth(i), i = (i + 12) % 12;
                else {
                    for (var l = 0; l < r; l++) s = this.moveMonth(s, t);
                    i = s.getUTCMonth(), s.setUTCDate(o), n = function() {
                        return i !== s.getUTCMonth()
                    }
                }
                for (; n();) s.setUTCDate(--o), s.setUTCMonth(i);
                return s
            },
            moveYear: function(e, t) {
                return this.moveMonth(e, 12 * t)
            },
            moveAvailableDate: function(e, t, i) {
                do {
                    if (e = this[i](e, t), !this.dateWithinRange(e)) return !1;
                    i = "moveDay"
                } while (this.dateIsDisabled(e));
                return e
            },
            weekOfDateIsDisabled: function(e) {
                return -1 !== I.inArray(e.getUTCDay(), this.o.daysOfWeekDisabled)
            },
            dateIsDisabled: function(t) {
                return this.weekOfDateIsDisabled(t) || 0 < I.grep(this.o.datesDisabled, function(e) {
                    return o(t, e)
                }).length
            },
            dateWithinRange: function(e) {
                return e >= this.o.startDate && e <= this.o.endDate
            },
            keydown: function(e) {
                if (this.picker.is(":visible")) {
                    var t, i, n = !1,
                        s = this.focusDate || this.viewDate;
                    switch (e.keyCode) {
                        case 27:
                            this.focusDate ? (this.focusDate = null, this.viewDate = this.dates.get(-1) || this.viewDate, this.fill()) : this.hide(), e.preventDefault(), e.stopPropagation();
                            break;
                        case 37:
                        case 38:
                        case 39:
                        case 40:
                            if (!this.o.keyboardNavigation || 7 === this.o.daysOfWeekDisabled.length) break;
                            t = 37 === e.keyCode || 38 === e.keyCode ? -1 : 1, 0 === this.viewMode ? e.ctrlKey ? (i = this.moveAvailableDate(s, t, "moveYear")) && this._trigger("changeYear", this.viewDate) : e.shiftKey ? (i = this.moveAvailableDate(s, t, "moveMonth")) && this._trigger("changeMonth", this.viewDate) : 37 === e.keyCode || 39 === e.keyCode ? i = this.moveAvailableDate(s, t, "moveDay") : this.weekOfDateIsDisabled(s) || (i = this.moveAvailableDate(s, t, "moveWeek")) : 1 === this.viewMode ? (38 !== e.keyCode && 40 !== e.keyCode || (t *= 4), i = this.moveAvailableDate(s, t, "moveMonth")) : 2 === this.viewMode && (38 !== e.keyCode && 40 !== e.keyCode || (t *= 4), i = this.moveAvailableDate(s, t, "moveYear")), i && (this.focusDate = this.viewDate = i, this.setValue(), this.fill(), e.preventDefault());
                            break;
                        case 13:
                            if (!this.o.forceParse) break;
                            s = this.focusDate || this.dates.get(-1) || this.viewDate, this.o.keyboardNavigation && (this._toggle_multidate(s), n = !0), this.focusDate = null, this.viewDate = this.dates.get(-1) || this.viewDate, this.setValue(), this.fill(), this.picker.is(":visible") && (e.preventDefault(), e.stopPropagation(), this.o.autoclose && this.hide());
                            break;
                        case 9:
                            this.focusDate = null, this.viewDate = this.dates.get(-1) || this.viewDate, this.fill(), this.hide()
                    }
                    n && (this.dates.length ? this._trigger("changeDate") : this._trigger("clearDate"), this.inputField.trigger("change"))
                } else 40 !== e.keyCode && 27 !== e.keyCode || (this.show(), e.stopPropagation())
            },
            setViewMode: function(e) {
                this.viewMode = e, this.picker.children("div").hide().filter(".datepicker-" + O.viewModes[this.viewMode].clsName).show(), this.updateNavArrows(), this._trigger("changeViewMode", new Date(this.viewDate))
            }
        }, c.prototype = {
            updateDates: function() {
                this.dates = I.map(this.pickers, function(e) {
                    return e.getUTCDate()
                }), this.updateRanges()
            },
            updateRanges: function() {
                var i = I.map(this.dates, function(e) {
                    return e.valueOf()
                });
                I.each(this.pickers, function(e, t) {
                    t.setRange(i)
                })
            },
            clearDates: function() {
                I.each(this.pickers, function(e, t) {
                    t.clearDates()
                })
            },
            dateUpdated: function(e) {
                if (!this.updating) {
                    this.updating = !0;
                    var i = I.data(e.target, "datepicker");
                    if (i !== E) {
                        var n = i.getUTCDate(),
                            s = this.keepEmptyValues,
                            t = I.inArray(e.target, this.inputs),
                            o = t - 1,
                            a = t + 1,
                            r = this.inputs.length;
                        if (-1 !== t) {
                            if (I.each(this.pickers, function(e, t) {
                                    t.getUTCDate() || t !== i && s || t.setUTCDate(n)
                                }), n < this.dates[o])
                                for (; 0 <= o && n < this.dates[o];) this.pickers[o--].setUTCDate(n);
                            else if (n > this.dates[a])
                                for (; a < r && n > this.dates[a];) this.pickers[a++].setUTCDate(n);
                            this.updateDates(), delete this.updating
                        }
                    }
                }
            },
            destroy: function() {
                I.map(this.pickers, function(e) {
                    e.destroy()
                }), I(this.inputs).off("changeDate", this.dateUpdated), delete this.element.data().datepicker
            },
            remove: e("destroy", "Method `remove` is deprecated and will be removed in version 2.0. Use `destroy` instead")
        };
        var n = I.fn.datepicker,
            s = function(a) {
                var r, l = Array.apply(null, arguments);
                if (l.shift(), this.each(function() {
                        var e = I(this),
                            t = e.data("datepicker"),
                            i = "object" == typeof a && a;
                        if (!t) {
                            var n = function(e, t) {
                                    function i(e, t) {
                                        return t.toLowerCase()
                                    }
                                    var n = I(e).data(),
                                        s = {},
                                        o = new RegExp("^" + t.toLowerCase() + "([A-Z])");
                                    for (var a in t = new RegExp("^" + t.toLowerCase()), n) t.test(a) && (s[a.replace(o, i)] = n[a]);
                                    return s
                                }(this, "date"),
                                s = function(e) {
                                    var i = {};
                                    if (M[e] || (e = e.split("-")[0], M[e])) {
                                        var n = M[e];
                                        return I.each(u, function(e, t) {
                                            t in n && (i[t] = n[t])
                                        }), i
                                    }
                                }(I.extend({}, h, n, i).language),
                                o = I.extend({}, h, s, n, i);
                            t = e.hasClass("input-daterange") || o.inputs ? (I.extend(o, {
                                inputs: o.inputs || e.find("input").toArray()
                            }), new c(this, o)) : new w(this, o), e.data("datepicker", t)
                        }
                        "string" == typeof a && "function" == typeof t[a] && (r = t[a].apply(t, l))
                    }), r === E || r instanceof w || r instanceof c) return this;
                if (1 < this.length) throw new Error("Using only allowed for the collection of a single element (" + a + " function)");
                return r
            };
        I.fn.datepicker = s;
        var h = I.fn.datepicker.defaults = {
                assumeNearbyYear: !1,
                autoclose: !1,
                beforeShowDay: I.noop,
                beforeShowMonth: I.noop,
                beforeShowYear: I.noop,
                beforeShowDecade: I.noop,
                beforeShowCentury: I.noop,
                calendarWeeks: !1,
                clearBtn: !1,
                toggleActive: !1,
                daysOfWeekDisabled: [],
                daysOfWeekHighlighted: [],
                datesDisabled: [],
                endDate: 1 / 0,
                forceParse: !0,
                format: "mm/dd/yyyy",
                keepEmptyValues: !1,
                keyboardNavigation: !0,
                language: "en",
                minViewMode: 0,
                maxViewMode: 4,
                multidate: !1,
                multidateSeparator: ",",
                orientation: "auto",
                rtl: !1,
                startDate: -1 / 0,
                startView: 0,
                todayBtn: !1,
                todayHighlight: !1,
                updateViewDate: !0,
                weekStart: 0,
                disableTouchKeyboard: !1,
                enableOnReadonly: !0,
                showOnFocus: !0,
                zIndexOffset: 10,
                container: "body",
                immediateUpdates: !1,
                title: "",
                templates: {
                    leftArrow: "&#x00AB;",
                    rightArrow: "&#x00BB;"
                },
                showWeekDays: !0
            },
            u = I.fn.datepicker.locale_opts = ["format", "rtl", "weekStart"];
        I.fn.datepicker.Constructor = w;
        var M = I.fn.datepicker.dates = {
                en: {
                    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    today: "Today",
                    clear: "Clear",
                    titleFormat: "MM yyyy"
                }
            },
            O = {
                viewModes: [{
                    names: ["days", "month"],
                    clsName: "days",
                    e: "changeMonth"
                }, {
                    names: ["months", "year"],
                    clsName: "months",
                    e: "changeYear",
                    navStep: 1
                }, {
                    names: ["years", "decade"],
                    clsName: "years",
                    e: "changeDecade",
                    navStep: 10
                }, {
                    names: ["decades", "century"],
                    clsName: "decades",
                    e: "changeCentury",
                    navStep: 100
                }, {
                    names: ["centuries", "millennium"],
                    clsName: "centuries",
                    e: "changeMillennium",
                    navStep: 1e3
                }],
                validParts: /dd?|DD?|mm?|MM?|yy(?:yy)?/g,
                nonpunctuation: /[^ -\/:-@\u5e74\u6708\u65e5\[-`{-~\t\n\r]+/g,
                parseFormat: function(e) {
                    if ("function" == typeof e.toValue && "function" == typeof e.toDisplay) return e;
                    var t = e.replace(this.validParts, "\0").split("\0"),
                        i = e.match(this.validParts);
                    if (!t || !t.length || !i || 0 === i.length) throw new Error("Invalid date format.");
                    return {
                        separators: t,
                        parts: i
                    }
                },
                parseDate: function(e, t, i, s) {
                    function n() {
                        var e = this.slice(0, o[l].length),
                            t = o[l].slice(0, e.length);
                        return e.toLowerCase() === t.toLowerCase()
                    }
                    if (!e) return E;
                    if (e instanceof Date) return e;
                    if ("string" == typeof t && (t = O.parseFormat(t)), t.toValue) return t.toValue(e, t, i);
                    var o, a, r, l, c, h = {
                            d: "moveDay",
                            m: "moveMonth",
                            w: "moveWeek",
                            y: "moveYear"
                        },
                        u = {
                            yesterday: "-1d",
                            today: "+0d",
                            tomorrow: "+1d"
                        };
                    if (e in u && (e = u[e]), /^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/i.test(e)) {
                        for (o = e.match(/([\-+]\d+)([dmwy])/gi), e = new Date, l = 0; l < o.length; l++) a = o[l].match(/([\-+]\d+)([dmwy])/i), r = Number(a[1]), c = h[a[2].toLowerCase()], e = w.prototype[c](e, r);
                        return w.prototype._zero_utc_time(e)
                    }
                    o = e && e.match(this.nonpunctuation) || [];
                    var d, p, f = {},
                        m = ["yyyy", "yy", "M", "MM", "m", "mm", "d", "dd"],
                        g = {
                            yyyy: function(e, t) {
                                return e.setUTCFullYear(s ? (!0 === (n = s) && (n = 10), (i = t) < 100 && (i += 2e3) > (new Date).getFullYear() + n && (i -= 100), i) : t);
                                var i, n
                            },
                            m: function(e, t) {
                                if (isNaN(e)) return e;
                                for (t -= 1; t < 0;) t += 12;
                                for (t %= 12, e.setUTCMonth(t); e.getUTCMonth() !== t;) e.setUTCDate(e.getUTCDate() - 1);
                                return e
                            },
                            d: function(e, t) {
                                return e.setUTCDate(t)
                            }
                        };
                    g.yy = g.yyyy, g.M = g.MM = g.mm = g.m, g.dd = g.d, e = N();
                    var v = t.parts.slice();
                    if (o.length !== v.length && (v = I(v).filter(function(e, t) {
                            return -1 !== I.inArray(t, m)
                        }).toArray()), o.length === v.length) {
                        var b, _, y;
                        for (l = 0, b = v.length; l < b; l++) {
                            if (d = parseInt(o[l], 10), a = v[l], isNaN(d)) switch (a) {
                                case "MM":
                                    p = I(M[i].months).filter(n), d = I.inArray(p[0], M[i].months) + 1;
                                    break;
                                case "M":
                                    p = I(M[i].monthsShort).filter(n), d = I.inArray(p[0], M[i].monthsShort) + 1
                            }
                            f[a] = d
                        }
                        for (l = 0; l < m.length; l++)(y = m[l]) in f && !isNaN(f[y]) && (_ = new Date(e), g[y](_, f[y]), isNaN(_) || (e = _))
                    }
                    return e
                },
                formatDate: function(e, t, i) {
                    if (!e) return "";
                    if ("string" == typeof t && (t = O.parseFormat(t)), t.toDisplay) return t.toDisplay(e, t, i);
                    var n = {
                        d: e.getUTCDate(),
                        D: M[i].daysShort[e.getUTCDay()],
                        DD: M[i].days[e.getUTCDay()],
                        m: e.getUTCMonth() + 1,
                        M: M[i].monthsShort[e.getUTCMonth()],
                        MM: M[i].months[e.getUTCMonth()],
                        yy: e.getUTCFullYear().toString().substring(2),
                        yyyy: e.getUTCFullYear()
                    };
                    n.dd = (n.d < 10 ? "0" : "") + n.d, n.mm = (n.m < 10 ? "0" : "") + n.m, e = [];
                    for (var s = I.extend([], t.separators), o = 0, a = t.parts.length; o <= a; o++) s.length && e.push(s.shift()), e.push(n[t.parts[o]]);
                    return e.join("")
                },
                headTemplate: '<thead><tr><th colspan="7" class="datepicker-title"></th></tr><tr><th class="prev">' + h.templates.leftArrow + '</th><th colspan="5" class="datepicker-switch"></th><th class="next">' + h.templates.rightArrow + "</th></tr></thead>",
                contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
                footTemplate: '<tfoot><tr><th colspan="7" class="today"></th></tr><tr><th colspan="7" class="clear"></th></tr></tfoot>'
            };
        O.template = '<div class="datepicker"><div class="datepicker-days"><table class="table-condensed">' + O.headTemplate + "<tbody></tbody>" + O.footTemplate + '</table></div><div class="datepicker-months"><table class="table-condensed">' + O.headTemplate + O.contTemplate + O.footTemplate + '</table></div><div class="datepicker-years"><table class="table-condensed">' + O.headTemplate + O.contTemplate + O.footTemplate + '</table></div><div class="datepicker-decades"><table class="table-condensed">' + O.headTemplate + O.contTemplate + O.footTemplate + '</table></div><div class="datepicker-centuries"><table class="table-condensed">' + O.headTemplate + O.contTemplate + O.footTemplate + "</table></div></div>", I.fn.datepicker.DPGlobal = O, I.fn.datepicker.noConflict = function() {
            return I.fn.datepicker = n, this
        }, I.fn.datepicker.version = "1.9.0", I.fn.datepicker.deprecated = function(e) {
            var t = window.console;
            t && t.warn && t.warn("DEPRECATED: " + e)
        }, I(document).on("focus.datepicker.data-api click.datepicker.data-api", '[data-provide="datepicker"]', function(e) {
            var t = I(this);
            t.data("datepicker") || (e.preventDefault(), s.call(t, "show"))
        }), I(function() {
            s.call(I('[data-provide="datepicker-inline"]'))
        })
    }), $(document).ready(function() {
        "use strict";

        function a(t, i) {
            jQuery("li.column").hide().filter(function() {
                var e = parseInt(jQuery(this).data("price"), 10);
                return t <= e && e <= i
            }).show()
        }

        function a(t, i) {
            jQuery("li.column").hide().filter(function() {
                var e = parseInt(jQuery(this).data("price"), 10);
                return t <= e && e <= i
            }).show()
        }
        if ($("input[type=checkbox]").parent().closest(".col-sm-6").addClass("col-sm-12"), $(".selectpicker").selectpicker(), $("#nav-tab a").click(function() {
                $(".main-Box").addClass("hideForce"), $(".tabsHolder .tab-content").addClass("setB")
            }), $(".closeTab").click(function() {
                $(".tabsHolder .tab-content .tab-pane").removeClass("active show"), $(".tabsHolder .nav .nav-link").removeClass("show active"), $(".main-Box").removeClass("hideForce"), $(".tabsHolder .tab-content").removeClass("setB")
            }), $(".saveSearch > li > a").click(function() {
                $(".saveSearch").toggleClass("searchAdded")
            }), $(".faClose-icon").click(function(e) {
                e.preventDefault(), window.location.href = $(this).parents("a").attr("href")
            }), $(".showMoreLink").click(function() {
                $(this).parent().parent(".checkboxHolder").addClass("showMoreCat")
            }), $(".showLessLink").click(function() {
                $(this).parent().parent(".checkboxHolder").removeClass("showMoreCat")
            }), $(".advSearchMore").click(function() {
                $(this).parent(".searchTitle").addClass("advSearchMoreHolder"), $(".advanceSearchdData").addClass("show")
            }), $(".advSearchLess").click(function() {
                $(this).parent(".searchTitle").removeClass("advSearchMoreHolder"), $(".advanceSearchdData").removeClass("show")
            }), $(".sh").click(function() {
                $(this).parent().parent(".abcMain").addClass("showMoreCat").removeClass("grey")
            }), $(".sho").click(function() {
                $(this).parent().parent(".abcMain").removeClass("showMoreCat").addClass("grey")
            }), 0 < jQuery(".slider-range").length && jQuery(".slider-range").slider({
                range: !0,
                min: 0,
                max: 5e4,
                values: [1e4, 4e4],
                create: function() {
                    jQuery(".amount1").text("$10,000"), jQuery(".amount2").text("$40,000")
                },
                slide: function(e, t) {
                    var i = "$" + t.values[0].toLocaleString("us-US"),
                        n = "$" + t.values[1].toLocaleString("us-US");
                    jQuery(".amount1").text(i), jQuery(".amount2").text(n);
                    var s = t.values[0],
                        o = t.values[1];
                    a(s, o)
                }
            }), 0 < jQuery(".slider-range2").length && jQuery(".slider-range2").slider({
                range: !0,
                min: 0,
                max: 5e4,
                values: [1e4, 4e4],
                create: function() {
                    jQuery(".amount5").text("11,00"), jQuery(".amount6").text("40,000")
                },
                slide: function(e, t) {
                    var i = "" + t.values[0].toLocaleString("us-US"),
                        n = "" + t.values[1].toLocaleString("us-US");
                    jQuery(".amount5").text(i), jQuery(".amount6").text(n);
                    var s = t.values[0],
                        o = t.values[1];
                    a(s, o)
                }
            }), $(function() {
                0 < jQuery(".slider-range-date").length && ($(".slider-range-date").slider({
                    range: !0,
                    min: 1990,
                    max: 2019,
                    values: [2e3, 2015],
                    slide: function(e, t) {
                        $(".amount3").val(t.values[0]), $(".amount4").val(t.values[1])
                    }
                }), $(".amount3").val($(".slider-range-date").slider("values", 0)), $(".amount4").val($(".slider-range-date").slider("values", 1)))
            }), $(document).on("click", ".plus", function() {
                $(".count").val(parseInt($(".count").val()) + 1)
            }), $(document).on("click", ".minus", function() {
                0 != $(".count").val() && $(".count").val(parseInt($(".count").val()) - 1)
            }), $(document).on("click", ".plus2", function() {
                $(".count2").val(parseInt($(".count2").val()) + 1)
            }), $(document).on("click", ".minus2", function() {
                0 != $(".count2").val() && $(".count2").val(parseInt($(".count2").val()) - 1)
            }), $("#advnce-ser").click(function() {
                $(this).find("i").toggleClass("fa-plus-circle fa-minus-circle")
            }), $(window).innerWidth(), $(window).on("load", function() {
                0 < jQuery(".loader").length && ($(".loader").fadeOut(), $("#preloder").delay(500).fadeOut("slow"))
            }), $(window).load(function() {
                $("#carousel").flexslider({
                    animation: "slide",
                    controlNav: !0,
                    animationLoop: !1,
                    slideshow: !1,
                    itemWidth: 95,
                    itemMargin: 7,
                    asNavFor: "#slider"
                }), $("#slider").flexslider({
                    animation: "slide",
                    controlNav: !0,
                    animationLoop: !1,
                    slideshow: !1,
                    sync: "#carousel",
                    start: function(e) {
                        $("body").removeClass("loading")
                    }
                })
            }), $(".prv-points li a").on("click", function(e) {
                e.preventDefault(), $("html, body").animate({
                    scrollTop: $($(this).attr("href")).offset().top
                }, 500, "linear")
            }), $(".btn_close").on("click", function() {
                $(".popup-overlay, .popup-content").removeClass("active")
            }), 0 < $(".holder ul.categoryHolder.list-unstyled").length) {
            var t = $(".holder ul.categoryHolder.list-unstyled"),
                i = $(".showMore"),
                n = t[0].scrollHeight;
            87 < n && (i.addClass("less"), i.css("display", "inline-block")), i.click(function(e) {
                e.stopPropagation(), i.hasClass("less") ? (i.removeClass("less"), i.addClass("more"), $(".showMore .categoryArrowDown").css("transform", "scaleY(-1)"), t.animate({
                    height: n
                })) : (i.addClass("less"), i.removeClass("more"), i.html('Show More <i class="fa categoryArrowDown" aria-hidden="true"></i>'), t.animate({
                    height: "72px"
                }))
            })
        }
        $("select#show_child_cat").on("change", function() {
            $(".sidebarSearch #advser").css({
                display: "block"
            })
        }), $('.paginationHolder .page-link.page-link-next .page-link, .paginationHolder .page-link a[rel="prev"], .paginationHolder .pagination > a.page-link').empty(), $("#tab1").tabs();
        try {
            $(".topheader_user_country").msDropDown()
        } catch (e) {
            alert(e.message)
        }
        if (0 < jQuery(".cube").length) {
            var e = document.querySelectorAll(".quadrant__item"),
                s = (document.querySelectorAll("svg"), document.querySelector(".cube")),
                o = (document.querySelector(".quadrant__item__content--close"), new TimelineLite({
                    paused: !0
                }));
            o.timeScale(1.6), o.to(".cube", .4, {
                rotation: 45,
                width: "60px",
                height: "60px",
                ease: Expo.easeOut
            }, "first"), o.to(".plus .plus-vertical", .3, {
                height: "0",
                backgroundColor: "#f45c41",
                ease: Power1.easeIn
            }, "first"), o.to(".plus .plus-horizontal", .3, {
                width: "0",
                backgroundColor: "#f45c41",
                ease: Power1.easeIn
            }, "first"), o.to(".cube", 0, {
                backgroundColor: "transparent"
            }), o.to(e[0], .15, {
                opacity: 1,
                x: -3,
                y: -3
            }, "seperate"), o.to(".arrow-up", .2, {
                opacity: 1,
                y: 0
            }, "seperate+=0.2"), o.to(e[1], .15, {
                opacity: 1,
                x: 3,
                y: -3
            }, "seperate"), o.to(".arrow-right", .2, {
                opacity: 1,
                x: 0
            }, "seperate+=0.2"), o.to(".arrow-down", .2, {
                opacity: 1,
                y: 0
            }, "seperate+=0.2"), o.to(e[2], .15, {
                opacity: 1,
                x: -3,
                y: 3
            }, "seperate"), o.to(".arrow-left", .2, {
                opacity: 1,
                x: 0
            }, "seperate+=0.2"), s.addEventListener("mouseenter", function(e) {
                e.stopPropagation(), o.play()
            }), s.addEventListener("mouseleave", function(e) {
                e.stopPropagation(), o.timeScale(1.8), o.reverse()
            })
        }
    });