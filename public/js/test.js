var bds = bds || {};
bds.se = bds.se || {};
bds.se.store = (function() {
        var r = {},
            v = window,
            s = v.document,
            z = "localStorage",
            e = "globalStorage",
            y = "__storejs__",
            w;
        r.disabled = false;
        r.set = function(b, a) {};
        r.get = function(a) {};
        r.remove = function(a) {};
        r.clear = function() {};
        r.transact = function(d, a, c) {
                var b = r.get(d);
                if (c == null) {
                        c = a;
                        a = null
                }
                if (typeof b == "undefined") {
                        b = a || {}
                }
                c(b);
                r.set(d, b)
        };
        r.getAll = function() {};
        r.serialize = function(a) {
                return String(a)
        };
        r.deserialize = function(a) {
                if (typeof a != "string") {
                        return undefined
                }
                return a
        };
        function A() {
                try {
                        return (z in v && v[z])
                } catch (a) {
                        return false
                }
        }
        function p() {
                try {
                        return (e in v && v[e] && v[e][v.location.hostname])
                } catch (a) {
                        return false
                }
        }
        if (A()) {
                w = v[z];
                r.set = function(b, a) {
                        if (a === undefined) {
                                return r.remove(b)
                        }
                        w.setItem(b, r.serialize(a))
                };
                r.get = function(a) {
                        return r.deserialize(w.getItem(a))
                };
                r.remove = function(a) {
                        w.removeItem(a)
                };
                r.clear = function() {
                        w.clear()
                };
                r.getAll = function() {
                        var c = {};
                        for (var a = 0; a < w.length; ++a) {
                                var b = w.key(a);
                                c[b] = r.get(b)
                        }
                        return c
                }
        } else {
                if (p()) {
                        w = v[e][v.location.hostname];
                        r.set = function(b, a) {
                                if (a === undefined) {
                                        return r.remove(b)
                                }
                                w[b] = r.serialize(a)
                        };
                        r.get = function(a) {
                                return r.deserialize(w[a] && w[a].value)
                        };
                        r.remove = function(a) {
                                delete w[a]
                        };
                        r.clear = function() {
                                for (var a in w) {
                                        delete w[a]
                                }
                        };
                        r.getAll = function() {
                                var c = {};
                                for (var a = 0; a < w.length; ++a) {
                                        var b = w.key(a);
                                        c[b] = r.get(b)
                                }
                                return c
                        }
                } else {
                        if (s.documentElement.addBehavior) {
                                var t, x;
                                try {
                                        x = new ActiveXObject("htmlfile");
                                        x.open();
                                        x.write('<script>document.w=window<\/script><iframe src="/favicon.ico"></iframe>');
                                        x.close();
                                        t = x.w.frames[0].document;
                                        w = t.createElement("div")
                                } catch (u) {
                                        w = s.createElement("div");
                                        t = s.body
                                }
                                function B(a) {
                                        return function() {
                                                var b = Array.prototype.slice.call(arguments, 0);
                                                b.unshift(w);
                                                t.appendChild(w);
                                                w.addBehavior("#default#userData");
                                                w.load(z);
                                                var c = a.apply(r, b);
                                                t.removeChild(w);
                                                return c
                                        }
                                }
                                function q(a) {
                                        return "_" + a
                                }
                                r.set = B(function(a, c, b) {
                                        c = q(c);
                                        if (b === undefined) {
                                                return r.remove(c)
                                        }
                                        a.setAttribute(c, r.serialize(b));
                                        a.save(z)
                                });
                                r.get = B(function(b, a) {
                                        a = q(a);
                                        return r.deserialize(b.getAttribute(a))
                                });
                                r.remove = B(function(b, a) {
                                        a = q(a);
                                        b.removeAttribute(a);
                                        b.save(z)
                                });
                                r.clear = B(function(a) {
                                        var d = a.XMLDocument.documentElement.attributes;
                                        a.load(z);
                                        for (var b = 0, c; c = d[b]; b++) {
                                                a.removeAttribute(c.name)
                                        }
                                        a.save(z)
                                });
                                r.getAll = B(function(a) {
                                        var f = a.XMLDocument.documentElement.attributes;
                                        a.load(z);
                                        var c = {};
                                        for (var b = 0, d; d = f[b]; ++b) {
                                                c[d] = r.get(d)
                                        }
                                        return c
                                })
                        }
                }
        }
        try {
                r.set(y, y);
                if (r.get(y) != y) {
                        r.disabled = true
                }
                r.remove(y)
        } catch (u) {
                r.disabled = true
        }
        return r
})();
bds.se.sugStorage = (function() {
        var g, a, c, o = "__SUGGESTION__",
            n = "__OPTIONS__";
        var b = (function() {
                var w = /['"\\\/\<\>\n\r]/g,
                    v = {
                                "'": "\\x27",
                                '"': "\\x22",
                                "\\": "\\\\",
                                "/": "\\/",
                                "\n": "\\\\n",
                                "\r": "\\\\r",
                                "<": "&lt;",
                                ">": "&gt;"
                    };
                var u = function(x) {
                        return v[x] || x
                };
                return function(x) {
                        return x.replace(w, u)
                }
        })();
        var r = function() {
                return '{"query": "' + this.query + '", "pinyin": "' + (this.pinyin ? this.pinyin : "") + '", "date": "' + this.date + '"}'
        };
        var h = function(w) {
                var u = [];
                for (var v in w) {
                        u.push('"' + v + '": "' + w[v] + '"')
                }
                return "{" + u.join(",") + "}"
        };
        var f = function(u, v) {
                if (v !== undefined) {
                        c[u] = v;
                        bds.se.store.set(n, h(c));
                        return v
                }
                return c[u] || ""
        };
        var t = function() {
                return bds.se.store && !bds.se.store.disabled
        };
        var e = function(v) {
                if (v && v.query && v.pinyin && v.date) {
                        v.toString = r;
                        if (!(a[v.query] && a[v.pinyin])) {
                                g.push(v)
                        } else {
                                for (var x = 0, y = 0; x < g.length; x++) {
                                        if (v.query == g[x].query && v.pinyin == g[x].pinyin) {
                                                y = 1;
                                                break
                                        }
                                }
                                if (y === 0) {
                                        g.push(v)
                                }
                        }
                        if (a[v.query] == undefined) {
                                a[v.query] = [v]
                        } else {
                                for (var w = 0, y = 0, u = a[v.query].length; w < u; w++) {
                                        if (a[v.query][w].pinyin == v.pinyin || a[v.query][w].query == v.query) {
                                                y = 1;
                                                break
                                        }
                                }
                                if (y === 0) {
                                        a[v.query].push(v)
                                }
                        }
                        if (a[v.pinyin] == undefined) {
                                a[v.pinyin] = [v]
                        } else {
                                for (var w = 0, y = 0, u = a[v.pinyin].length; w < u; w++) {
                                        if (a[v.pinyin][w].query == v.query) {
                                                y = 1;
                                                break
                                        }
                                }
                                if (y === 0) {
                                        a[v.pinyin].push(v)
                                }
                        }
                        bds.se.store.set(o, "[" + g.join(",") + "]");
                        return g.length
                }
                return false
        };
        var p = function(w) {
                var u = [];
                for (var v in a) {
                        if (new RegExp("^" + w, "img").test(v)) {
                                u = u.concat(a[v])
                        }
                }
                return u
        };
        var j = function(u) {
                return g
        };
        var q = function() {
                g = [];
                a = {};
                bds.se.store.set(o, "");
                return g.length
        };
        var m = function() {
                return g.length
        };
        var s = function(u) {
                if (!u || !u.query || !u.pinyin) {
                        return false
                }
                var v;
                for (i = 0; i < g.length; i++) {
                        if (u.query == g[i].query && u.pinyin == g[i].pinyin) {
                                v = g[i];
                                g.splice(i, 1);
                                break
                        }
                }
                if (v === undefined) {
                        return false
                } else {
                        bds.se.store.set(o, "[" + g.join(",") + "]");
                        l();
                        return v
                }
        };
        var k = function(u) {
                if (s(u)) {
                        return e({
                                query: u.query,
                                pinyin: u.pinyin,
                                date: new Date().getTime()
                        })
                }
                return false
        };
        var d = function() {
                var u = g[0];
                if (u) {
                        return s({
                                query: u.query,
                                pinyin: u.pinyin
                        })
                }
                return false
        };
        var l = function() {
                a = {};
                var B = bds.se.store.get(n);
                if (B) {
                        c = (new Function("return (" + B + ")"))()
                } else {
                        c = {}
                }
                var w = bds.se.store.get(o);
                if (!w) {
                        g = []
                } else {
                        g = (new Function("return (" + w + ")"))();
                        for (var z = 0, v = g.length; z < v; z++) {
                                var x = g[z];
                                x.toString = r;
                                if (a[x.query] == undefined) {
                                        a[x.query] = [x]
                                } else {
                                        for (var y = 0, A = 0, u = a[x.query].length; y < u; y++) {
                                                if (a[x.query][y].pinyin == x.pinyin || a[x.query][y].query == x.query) {
                                                        A = 1;
                                                        break
                                                }
                                        }
                                        if (A === 0) {
                                                a[x.query].push(x)
                                        }
                                }
                                if (a[x.pinyin] == undefined) {
                                        a[x.pinyin] = [x]
                                } else {
                                        for (var y = 0, A = 0, u = a[x.pinyin].length; y < u; y++) {
                                                if (a[x.pinyin][y].query == x.query) {
                                                        A = 1;
                                                        break
                                                }
                                        }
                                        if (A === 0) {
                                                a[x.pinyin].push(x)
                                        }
                                }
                        }
                }
        };
        l();
        return {
                isSupport: t,
                reset: q,
                getCount: m,
                set: e,
                get: p,
                getAll: j,
                edit: k,
                remove: s,
                pop: d,
                option: f
        }
})();
bds.se.sug = function() {
        var lenStorage;
        var isSetSug = 1;
        var isSetSugStorage = 1;
        if (bds.comm.personalData) {
                var set = eval("(" + bds.comm.personalData + ")");
                if (set.errno == 0 && set.sugSet && set.sugSet.ErrMsg == "SUCCESS") {
                        if (set.sugSet.value == 0) {
                                isSetSug = 0
                        }
                }
                if (set.errno == 0 && set.sugStoreSet && set.sugStoreSet.ErrMsg == "SUCCESS") {
                        if (set.sugStoreSet.value == 0) {
                                isSetSugStorage = 0
                        }
                }
        }
        function storeSug() {
                if (bds.se.sugStorage.isSupport() && navigator.cookieEnabled && (bds.comm.user != "" && !isSetSugStorage)) {
                        bds.se.sugStorage.reset()
                }
                function checkSugCount() {
                        while (bds.se.sugStorage.getCount() >= 50) {
                                bds.se.sugStorage.pop()
                        }
                        return true
                }
                function queryString(param) {
                        var base = window.document.location.search,
                            reg = new RegExp("[&|?]" + param + "=([^&]*)", "i");
                        if (reg.test(base)) {
                                return RegExp.$1
                        }
                        return null
                }
                if (bds.comm.user != "" && bds.comm.ishome === 0 && bds.se.sugStorage.isSupport() && navigator.cookieEnabled && isSetSugStorage == 1) {
                        var query = encodeURIComponent(bds.comm.query),
                            pinyin = encodeURIComponent(bds.comm.pinyin),
                            date = new Date().getTime();
                        if (query && pinyin) {
                                checkSugCount();
                                var dataArray = bds.se.sugStorage.getAll(),
                                    i = 0,
                                    l = dataArray.length,
                                    isExist = false;
                                for (; i < l; i++) {
                                        if (dataArray[i].query == query && dataArray[i].pinyin == pinyin) {
                                                isExist = true;
                                                break
                                        }
                                }
                                if (isExist) {
                                        bds.se.sugStorage.edit({
                                                query: query,
                                                pinyin: pinyin
                                        })
                                } else {
                                        bds.se.sugStorage.set({
                                                query: query,
                                                pinyin: pinyin,
                                                date: date
                                        })
                                }
                        }
                }
        }
        storeSug();
        var rsv_sug1 = 0,
            rsv_sug3 = 0,
            rsv_sug4 = 0,
            rsv_temp_time = 0,
            rsv_temp_flag = false,
            rsv_timer = null;
        var isIE = (/msie (\d+)/i.test(navigator.userAgent) && !window.opera) ? parseInt(RegExp.$1) : 0;
        var isQuirk = (document.compatMode == "BackCompat");
        function G(id) {
                return document.getElementById(id)
        }
        function C(tg) {
                return document.createElement(tg)
        }
        function trim(str) {
                return String(str).replace(new RegExp("(^[\\s\\t\\xa0\\u3000]+)|([\\u3000\\xa0\\s\\t]+\x24)", "g"), "")
        }
        function trimAS(str) {
                return String(str).replace(new RegExp("[\\s\\t\\xa0\\u3000]", "g"), "")
        }
        function addEvent(elem, type, handler) {
                if (isIE) {
                        elem.attachEvent("on" + type, (function(elm) {
                                return function() {
                                        handler.call(elm)
                                }
                        })(elem))
                } else {
                        elem.addEventListener(type, handler, false)
                }
        }
        function stopDefault(e) {
                if (isIE) {
                        e.returnValue = false
                } else {
                        e.preventDefault()
                }
        }
        function addStyle(styleStr) {
                if (isIE) {
                        var styleSheet = document.createStyleSheet();
                        styleSheet.cssText = styleStr
                } else {
                        var style = document.createElement("style");
                        style.type = "text/css";
                        style.appendChild(document.createTextNode(styleStr));
                        document.getElementsByTagName("HEAD")[0].appendChild(style)
                }
        }
        function addTj(o) {
                var fm = document.forms[0];
                for (var i in o) {
                        if (o[i] == undefined) {
                                if (G("bdsug_ipt_" + i)) {
                                        fm.removeChild(G("bdsug_ipt_" + i))
                                }
                        } else {
                                if (!_hasi(i)) {
                                        fm.appendChild(CHI(i, o[i]))
                                } else {
                                        _hasi(i).value = o[i]
                                }
                        }
                }
                function CHI(n, v) {
                        var elem = C("INPUT");
                        elem.type = "hidden";
                        elem.name = n;
                        elem.id = "bdsug_ipt_" + n;
                        elem.value = v;
                        return elem
                }
        }
        function _hasi(s) {
                var fm = document.forms[0];
                var _i = false;
                var _iarr = fm.getElementsByTagName("INPUT");
                for (var i = 0; i < _iarr.length; i++) {
                        if (s == _iarr[i].getAttribute("name")) {
                                _i = _iarr[i];
                                return _i
                        } else {
                                _i = false
                        }
                }
        }
        function rmTj(o) {
                var fm = document.forms[0];
                for (var i in o) {
                        if (i == "f") {
                                if (_hasi("f")) {
                                        if (_hasi("f").id == "bdsug_ipt_f") {
                                                fm.removeChild(G("bdsug_ipt_f"))
                                        } else {
                                                _hasi("f").value = "8"
                                        }
                                }
                        } else {
                                if (G("bdsug_ipt_" + i)) {
                                        fm.removeChild(G("bdsug_ipt_" + i))
                                }
                        }
                }
        }
        var sugT = 0;
        if (typeof window.bdsug != "object" || window.bdsug == null) {
                window.bdsug = {}
        }
        bdsug.sug = {};
        bdsug.sugkeywatcher = {};
        var MessageDispatcher = (function() {
                function addReceiver(msgType) {
                        var queues = this.__MSG_QS__;
                        if (!queues[msgType]) {
                                queues[msgType] = []
                        }
                        for (var i = 1, n = arguments.length, r; i < n; i++) {
                                queues[msgType].push(arguments[i])
                        }
                }
                function dispatchMsg(msg) {
                        var q = this.__MSG_QS__[msg.type];
                        if (q == null) {
                                return
                        }
                        for (var i = 0, n = q.length; i < n; i++) {
                                q[i].rm(msg)
                        }
                }
                return {
                        ini: function(obj) {
                                obj.__MSG_QS__ = {};
                                obj.on = addReceiver;
                                obj.dm = dispatchMsg;
                                return obj
                        }
                }
        })();
        var Inpt = (function() {
                var ipt = G("kw");
                var div;
                var circleTimer = 0;
                var requestTimer = 0;
                var oldValue = "";
                var keyValue = "";
                var mouseOverValue = null;
                var isClkSdiv = false;
                var beforeStart = true;
                var rsv_sug;
                var btn = G("su");
                addEvent(btn, "mousedown", addInputTime);
                addEvent(btn, "keydown", addInputTime);
                addEvent(G("kw"), "paste", function() {
                        addTj({
                                rsv_n: 2
                        });
                        if (sugT == 0) {
                                sugT = new Date().getTime()
                        }
                });
                function addInputTime() {
                        addTj({
                                inputT: sugT > 0 ? (new Date().getTime() - sugT) : 0
                        })
                }
                function mousedown() {
                        if (beforeStart) {
                                Inpt.dm({
                                        type: "start"
                                });
                                beforeStart = false
                        }
                }
                function keydown(e) {
                        if (sugT == 0) {
                                sugT = new Date().getTime()
                        }
                        if (beforeStart) {
                                Inpt.dm({
                                        type: "start"
                                });
                                beforeStart = false
                        }
                        e = e || window.event;
                        if (e.keyCode == 9 || e.keyCode == 27) {
                                Inpt.dm({
                                        type: "hide_div"
                                })
                        }
                        if (e.keyCode == 13) {
                                stopDefault(e);
                                Inpt.dm({
                                        type: "key_enter"
                                })
                        }
                        if (e.keyCode == 86 && e.ctrlKey) {
                                addTj({
                                        rsv_n: 2
                                })
                        }
                        if (div.style.display != "none") {
                                if (e.keyCode == 38) {
                                        stopDefault(e);
                                        Inpt.dm({
                                                type: "key_up"
                                        })
                                }
                                if (e.keyCode == 40) {
                                        Inpt.dm({
                                                type: "key_down"
                                        })
                                }
                        } else {
                                if (e.keyCode == 38 || e.keyCode == 40) {
                                        Inpt.dm({
                                                type: "need_data",
                                                wd: ipt.value
                                        })
                                }
                        }
                }
                function circle() {
                        var nowValue = ipt.value;
                        if (nowValue == oldValue && nowValue != "" && nowValue != keyValue && nowValue != mouseOverValue) {
                                if (requestTimer == 0 && mouseOverValue != 0) {
                                        requestTimer = setTimeout(function() {
                                                Inpt.dm({
                                                        type: "need_data",
                                                        wd: nowValue
                                                })
                                        }, 100)
                                }
                        } else {
                                clearTimeout(requestTimer);
                                requestTimer = 0;
                                oldValue = nowValue;
                                if (nowValue == "") {
                                        Inpt.dm({
                                                type: "hide_div"
                                        })
                                }
                                if (keyValue != ipt.value) {
                                        keyValue = ""
                                }
                        }
                }
                function circleStart() {
                        circleTimer = setInterval(circle, 10)
                }
                function circleStop() {
                        clearInterval(circleTimer)
                }
                function stopMSinput() {
                        if (isClkSdiv) {
                                window.event.cancelBubble = true;
                                window.event.returnValue = false;
                                isClkSdiv = false
                        }
                }
                function setAutocomplete(c) {
                        ipt.blur();
                        ipt.setAttribute("autocomplete", c);
                        ipt.focus()
                }
                function stopSubmit(e) {
                        var e = e || window.event;
                        if (e.keyCode == 13) {
                                stopDefault(e)
                        }
                }
                ipt.setAttribute("autocomplete", "off");
                var keywatched = false;
                bdsug.sugkeywatcher.on = function() {
                        if (!keywatched) {
                                if (isIE) {
                                        ipt.attachEvent("onkeydown", keydown)
                                } else {
                                        ipt.addEventListener("keydown", keydown, false)
                                }
                                keywatched = true
                        }
                };
                bdsug.sugkeywatcher.off = function() {
                        if (keywatched) {
                                if (isIE) {
                                        ipt.detachEvent("onkeydown", keydown)
                                } else {
                                        ipt.removeEventListener("keydown", keydown, false)
                                }
                                keywatched = false
                        }
                };
                bdsug.sugkeywatcher.on();
                addEvent(ipt, "mousedown", mousedown);
                addEvent(ipt, "beforedeactivate", stopMSinput);
                if (window.opera) {
                        addEvent(ipt, "keypress", stopSubmit)
                }
                return MessageDispatcher.ini({
                        rm: function(evtObj) {
                                switch (evtObj.type) {
                                case "div_ready":
                                        div = evtObj.sdiv;
                                        keyValue = ipt.value;
                                        circleStart();
                                        break;
                                case "clk_submit":
                                        circleStop();
                                        ipt.blur();
                                        ipt.value = evtObj.wd;
                                        break;
                                case "ent_submit":
                                        circleStop();
                                        ipt.blur();
                                        break;
                                case "key_select":
                                        mouseOverValue = evtObj.selected || 0;
                                        break;
                                case "close":
                                        circleStop();
                                        setAutocomplete("on");
                                        break;
                                case "mousedown_tr":
                                        if (navigator.userAgent.toLowerCase().indexOf("webkit") != -1) {
                                                circleStop();
                                                setTimeout(circleStart, 2000)
                                        }
                                        isClkSdiv = true;
                                        break
                                }
                        }
                })
        })();
        var Sdiv = (function() {
                var div;
                var ipt = G("kw");
                var tb;
                var selected = -1;
                var dataArray;
                var dataObj;
                var oq;
                var ie6frm;
                function ct() {
                        var trs = tb.rows;
                        for (var i = 0; i < trs.length; i++) {
                                trs[i].className = "ml"
                        }
                }
                function getSelected() {
                        if (typeof(tb) != "undefined" && tb != null && div.style.display != "none") {
                                var trs = tb.rows;
                                for (var i = 0; i < trs.length; i++) {
                                        if (trs[i].className == "mo") {
                                                return [i, trs[i].cells[0].innerHTML]
                                        }
                                }
                        }
                        return [-1, ""]
                }
                function hide() {
                        if (isIE && isIE <= 6) {
                                ie6frm.style.display = "none"
                        }
                        div.style.display = "none"
                }
                function mouseover() {
                        ct();
                        this.className = "mo"
                }
                function mousedown(e) {
                        Sdiv.dm({
                                type: "mousedown_tr"
                        });
                        if (!isIE) {
                                e.stopPropagation();
                                e.preventDefault();
                                return false
                        }
                }
                function click(i) {
                        var j = i;
                        return function() {
                                var word = dataArray[j].value;
                                hide();
                                var id = 0;
                                if (typeof dataArray[j].ala != "undefined") {
                                        id = dataObj[dataArray[j].ala].id
                                }
                                Sdiv.dm({
                                        type: "clk_submit",
                                        oq: G("kw").value,
                                        wd: word,
                                        rsp: j,
                                        rsv_sug5: id
                                })
                        }
                }
                function close(e) {
                        e = e || window.event;
                        stopDefault(e);
                        Sdiv.dm({
                                type: "close"
                        });
                        hide();
                        (new Image()).src = "http://sclick.baidu.com/w.gif?fm=suggestion&title=%B9%D8%B1%D5&t=" + new Date().getTime()
                }
                function resize() {
                        var iptwh = [ipt.offsetWidth + 15, ipt.offsetHeight + 10];
                        div.style.width = ((isIE && isQuirk) ? iptwh[0] : iptwh[0] - 2) + "px";
                        div.style.top = ((isIE && isQuirk) ? iptwh[1] : iptwh[1] - 1) + "px";
                        div.style.display = "block";
                        if (isIE && isIE <= 6) {
                                ie6frm.style.top = ((isIE && isQuirk) ? iptwh[1] : iptwh[1] - 1) + "px";
                                ie6frm.style.width = ((isIE && isQuirk) ? iptwh[0] : iptwh[0] - 2) + "px"
                        }
                }
                function setBold(q, str) {
                        if (q && str) {
                                var query = trim(q);
                                if (str.indexOf(query) == 0) {
                                        str = boldSugText(str, query)
                                } else {
                                        if (str.indexOf(trimAS(q)) == 0) {
                                                query = trimAS(q);
                                                str = boldSugText(str, query)
                                        } else {}
                                }
                        }
                        return str
                }
                function boldSugText(text, key) {
                        text = text.replace(/&/g, "&amp;");
                        text = text.replace(/</g, "&lt;");
                        text = text.replace(/>/g, "&gt;");
                        key = key.replace(/&/g, "&amp;");
                        key = key.replace(/</g, "&lt;");
                        key = key.replace(/>/g, "&gt;");
                        var str_begin = "<span>" + key + "</span>";
                        var len = key.length;
                        var str_end = "<b>" + text.substring(len) + "</b>";
                        return (str_begin + str_end)
                }
                function changeData(data) {
                        var word = G("kw").value,
                            reg = /[^\x00-\xff]/g,
                            dataArray = [],
                            tempArray = [];
                        lenStorage = 0;
                        for (var i = 0; i < data.length; i++) {
                                var temp = {};
                                temp.value = data[i];
                                temp.from = 0;
                                dataArray.push(temp)
                        }
                        if (bds.comm.user == "" || !bds.se.sugStorage.isSupport() || !navigator.cookieEnabled || (bds.comm.user != "" && !isSetSugStorage)) {
                                resultData = addAlaData(dataArray) || dataArray;
                                return resultData
                        } else {
                                if (word.replace(reg, "mm").length <= 3) {
                                        return dataArray
                                } else {
                                        for (var i = 0; i < data.length; i++) {
                                                var temp = {};
                                                temp.value = data[i];
                                                temp.from = 0;
                                                dataArray.push(temp)
                                        }
                                        var localData = bds.se.sugStorage.get(encodeURIComponent(word));
                                        localData.sort(function(a, b) {
                                                return a.date - b.date
                                        });
                                        for (i = 0; i < localData.length; i++) {
                                                for (var j = i + 1; j < localData.length; j++) {
                                                        if (localData[i].query == localData[j].query) {
                                                                localData.splice(j, 1);
                                                                j--
                                                        }
                                                }
                                        }
                                        for (i = localData.length - 1; i >= 0; i--) {
                                                var temp = {};
                                                temp.value = decodeURIComponent(localData[i].query);
                                                temp.from = 1;
                                                temp.pinyin = localData[i].pinyin;
                                                tempArray.push(temp);
                                                lenStorage++;
                                                if (i == localData.length - 2) {
                                                        break
                                                }
                                        }
                                        data = tempArray.concat(dataArray);
                                        for (i = 0; i < data.length; i++) {
                                                for (j = i + 1; j < data.length; j++) {
                                                        if (data[i].value == data[j].value) {
                                                                data.splice(j, 1);
                                                                j--
                                                        }
                                                }
                                        }
                                        resultData = addAlaData(data) || data;
                                        return resultData
                                }
                        }
                        function addAlaData(data) {
                                var alaData = [];
                                for (var i = 0; i < dataObj.length; i++) {
                                        for (var j = 0; j < data.length; j++) {
                                                if (dataObj[i].key == data[j].value) {
                                                        if (data[j].from == 1) {
                                                                lenStorage--
                                                        }
                                                        data.splice(j, 1)
                                                }
                                        }
                                        var temp = {};
                                        temp.value = dataObj[i].key;
                                        temp.from = 0;
                                        temp.ala = i;
                                        alaData.unshift(temp)
                                }
                                data = alaData.concat(data);
                                while (data.length > 10) {
                                        data.pop()
                                }
                                return data
                        }
                }
                function draw() {
                        dataArray = changeData(dataArray);
                        if (dataArray.length <= 0) {
                                hide();
                                return
                        }
                        tb = C("TABLE");
                        tb.id = "st";
                        tb.cellSpacing = 0;
                        tb.cellPadding = 2;
                        var tbd = C("tbody");
                        tb.appendChild(tbd);
                        for (var i = 0, l = dataArray.length; i < l; i++) {
                                var tr = tbd.insertRow(-1);
                                addEvent(tr, "mouseover", mouseover);
                                addEvent(tr, "mouseout", ct);
                                addEvent(tr, "mousedown", mousedown);
                                addEvent(tr, "click", click(i));
                                var td = tr.insertCell(-1);
                                var str = setBold(oq, dataArray[i].value);
                                if (dataArray[i].from == 1) {
                                        str = '<u class="sug_del" title="如您不需要此搜索历史提示，&#13;可在右上角搜索设置中关闭">删除</u>' + str;
                                        td.className = "sug_storage"
                                }
                                if (typeof dataArray[i].ala != "undefined") {
                                        td.innerHTML = strAla(str, dataArray[i].ala);
                                        td.className = "sug_ala"
                                } else {
                                        td.innerHTML = str
                                }
                        }
                        div.innerHTML = "";
                        div.appendChild(tb);
                        resize();
                        if (isIE && isIE <= 6) {
                                ie6frm.style.display = "block";
                                ie6frm.style.left = 0 + "px";
                                ie6frm.style.top = ipt.offsetHeight + 15 + "px";
                                ie6frm.style.width = ipt.offsetWidth + "px";
                                ie6frm.style.height = div.offsetHeight - 1 + "px"
                        }
                        var u = div.getElementsByTagName("u");
                        for (var i = 0; i < u.length; i++) {
                                u[i].onclick = function(e) {
                                        var selected = getSelected()[0];
                                        var e = e || window.event;
                                        var target = e.target || e.srcElement;
                                        target.parentNode.parentNode.parentNode.removeChild(target.parentNode.parentNode);
                                        if (isIE && isIE <= 6) {
                                                ie6frm.style.height = div.offsetHeight - 1 + "px"
                                        }
                                        var img = window["BD_PS_C" + (new Date()).getTime()] = new Image();
                                        img.src = "http://sclick.baidu.com/w.gif?q=" + encodeURIComponent(dataArray[selected].value) + "&fm=beha&rsv_sug=del&rsv_sid=11&t=" + new Date().getTime() + "&path=http://www.baidu.com";
                                        bds.se.sugStorage.remove({
                                                query: encodeURIComponent(dataArray[selected].value),
                                                pinyin: dataArray[selected].pinyin
                                        });
                                        dataArray.splice(selected, 1);
                                        Sdiv.dm({
                                                type: "update_data",
                                                word: G("kw").value,
                                                data: dataArray
                                        });
                                        if (lenStorage > 0) {
                                                lenStorage--
                                        }
                                        if (lenStorage <= 0 && dataArray.length == 0) {
                                                hide();
                                                div.innerHTML = ""
                                        }
                                        if (window.event) {
                                                e.cancelBubble = true
                                        } else {
                                                e.stopPropagation()
                                        }
                                }
                        }
                        addTj({
                                rsv_sug: lenStorage
                        })
                }
                function strAla(str, n) {
                        var html = [];
                        switch (dataObj[n].type) {
                        case "1":
                                html.push("<h3>" + dataObj[n].key + "</h3>");
                                html.push("<p>" + dataObj[n].word);
                                if (dataObj[n].word_add) {
                                        html.push(" <span>（" + dataObj[n].word_add + "）</span>")
                                }
                                html.push("</p>");
                                break;
                        case "2":
                                html.push("<h3>" + dataObj[n].key + " - 百度安全认证</h3>");
                                html.push("<p>" + dataObj[n].word);
                                if (dataObj[n].word_add) {
                                        html.push(" <span>（" + dataObj[n].word_add + "）</span>")
                                }
                                html.push("</p>");
                                break;
                        default:
                                html.push(str)
                        }
                        return html.join("")
                }
                function enter() {
                        selected = getSelected()[0];
                        if (selected == -1) {
                                Sdiv.dm({
                                        type: "submit"
                                })
                        } else {
                                Sdiv.dm({
                                        type: "ent_submit",
                                        oq: oq,
                                        wd: getSelected()[1],
                                        rsp: selected
                                })
                        }
                }
                function keyup() {
                        selected = getSelected()[0];
                        ct();
                        if (selected == 0) {
                                Sdiv.dm({
                                        type: "key_select",
                                        selected: ""
                                });
                                G("kw").value = oq;
                                selected--;
                                rmTj({
                                        oq: oq,
                                        sug: dataArray[selected],
                                        rsv_n: 1,
                                        rsp: selected,
                                        f: 3,
                                        rsv_sug: rsv_sug,
                                        rsv_sug5: 0
                                })
                        } else {
                                if (selected == -1) {
                                        selected = dataArray.length
                                }
                                selected--;
                                var tr = tb.rows[selected];
                                tr.className = "mo";
                                Sdiv.dm({
                                        type: "key_select",
                                        selected: dataArray[selected].value
                                });
                                G("kw").value = dataArray[selected].value;
                                var id = 0;
                                if (typeof dataArray[selected].ala != "undefined") {
                                        id = dataObj[dataArray[selected].ala].id
                                }
                                addTj({
                                        oq: oq,
                                        sug: dataArray[selected].value,
                                        rsv_n: 1,
                                        rsp: selected,
                                        f: 3,
                                        rsv_sug: rsv_sug,
                                        rsv_sug5: id
                                })
                        }
                }
                function keydown() {
                        selected = getSelected()[0];
                        ct();
                        if (selected == dataArray.length - 1) {
                                Sdiv.dm({
                                        type: "key_select",
                                        selected: ""
                                });
                                G("kw").value = oq;
                                selected = -1;
                                rmTj({
                                        oq: oq,
                                        sug: dataArray[selected],
                                        rsv_n: 1,
                                        rsp: selected,
                                        f: 3,
                                        rsv_sug: rsv_sug,
                                        rsv_sug5: 0
                                })
                        } else {
                                selected++;
                                var tr = tb.rows[selected];
                                tr.className = "mo";
                                Sdiv.dm({
                                        type: "key_select",
                                        selected: dataArray[selected].value
                                });
                                G("kw").value = dataArray[selected].value;
                                var id = 0;
                                if (typeof dataArray[selected].ala != "undefined") {
                                        id = dataObj[dataArray[selected].ala].id
                                }
                                addTj({
                                        oq: oq,
                                        sug: dataArray[selected].value,
                                        rsv_n: 1,
                                        rsp: selected,
                                        f: 3,
                                        rsv_sug: rsv_sug,
                                        rsv_sug5: id
                                })
                        }
                }
                return MessageDispatcher.ini({
                        rm: function(evtObj) {
                                switch (evtObj.type) {
                                case "div_ready":
                                        div = evtObj.sdiv;
                                        ie6frm = evtObj.frm;
                                        break;
                                case "give_data":
                                        oq = evtObj.data.q;
                                        dataArray = evtObj.data.s;
                                        var dataObjTemp = evtObj.data.z || [];
                                        dataObj = [];
                                        for (var i = 0; i < dataObjTemp.length; i++) {
                                                var d = dataObjTemp[i];
                                                if (d.type == 1 || d.type == 2) {
                                                        dataObj.push(dataObjTemp[i])
                                                }
                                        }
                                        rsv_sug = evtObj.data.t;
                                        draw();
                                        break;
                                case "key_enter":
                                        enter();
                                        break;
                                case "key_up":
                                        keyup();
                                        break;
                                case "key_down":
                                        keydown();
                                        break;
                                case "hide_div":
                                        hide();
                                        break;
                                case "mousedown_other":
                                        hide();
                                        break;
                                case "window_blur":
                                        hide();
                                        break;
                                case "need_resize":
                                        resize();
                                        break
                                }
                        }
                })
        })();
        var Form0 = (function() {
                var fm = document.forms[0];
                function resetform() {
                        if (G("bdsug_ipt_sug")) {
                                if (G("bdsug_ipt_sug").value == trim(G("kw").value)) {
                                        rmTj({
                                                rsv_n: 1,
                                                sug: 1
                                        })
                                } else {
                                        rmTj({
                                                f: 1
                                        })
                                }
                        }
                }
                addEvent(fm, "submit", resetform);
                function submit() {
                        resetform();
                        addTj({
                                inputT: sugT > 0 ? (new Date().getTime() - sugT) : 0
                        });
                        fm.submit()
                }
                function submitTj(o) {
                        addTj(o);
                        addTj({
                                inputT: sugT > 0 ? (new Date().getTime() - sugT) : 0
                        });
                        rmTj({
                                sug: 1,
                                rsv_n: 1
                        });
                        fm.submit()
                }
                return MessageDispatcher.ini({
                        rm: function(evtObj) {
                                switch (evtObj.type) {
                                case "clk_submit":
                                        submitTj({
                                                oq: evtObj.oq,
                                                rsp: evtObj.rsp,
                                                f: 3,
                                                rsv_sug: lenStorage,
                                                rsv_sug2: 1,
                                                rsv_sug5: evtObj.rsv_sug5
                                        });
                                        break;
                                case "ent_submit":
                                        submitTj({
                                                oq: evtObj.oq,
                                                rsp: evtObj.rsp,
                                                f: 3,
                                                rsv_sug: lenStorage,
                                                rsv_sug2: 0
                                        });
                                        break;
                                case "submit":
                                        submit();
                                        break
                                }
                        }
                })
        })();
        var Data = (function() {
                var dataObj = {};
                function processData(word) {
                        if (typeof dataObj[word] == "undefined") {
                                Data.dm({
                                        type: "request_data",
                                        wd: word
                                })
                        } else {
                                Data.dm({
                                        type: "give_data",
                                        data: dataObj[word]
                                })
                        }
                }
                function addData(d) {
                        dataObj[d.q] = d;
                        Data.dm({
                                type: "give_data",
                                data: dataObj[d.q]
                        })
                }
                function updateData(word, data) {
                        if (typeof dataObj[word] != "undefined") {
                                if (data.length > 0) {
                                        var temp = [];
                                        for (var i = 0; i < data.length; i++) {
                                                temp.push(data[i].value)
                                        }
                                        dataObj[word].s = temp;
                                        Data.dm({
                                                type: "give_data",
                                                data: dataObj[word]
                                        })
                                }
                        }
                }
                return MessageDispatcher.ini({
                        rm: function(eventObj) {
                                switch (eventObj.type) {
                                case "response_data":
                                        addData(eventObj.data);
                                        break;
                                case "need_data":
                                        processData(eventObj.wd);
                                        break;
                                case "update_data":
                                        updateData(eventObj.word, eventObj.data);
                                        break
                                }
                        }
                })
        })();
        var Request = (function() {
                var dataElm;
                var cookieSwitch;
                function getDataScript(wd) {
                        var requestUrl = bds.comm.sugHost || "http://suggestion.baidu.com/su";
                        Request.dm({
                                type: "need_cookie"
                        });
                        if (dataElm) {
                                document.body.removeChild(dataElm)
                        }
                        dataElm = C("SCRIPT");
                        dataElm.src = requestUrl + "?wd=" + encodeURIComponent(wd) + "&p=" + cookieSwitch + "&cb=window.bdsug.sug&sid=" + bds.comm.sid + "&t=" + (new Date()).getTime();
                        dataElm.charset = "gb2312";
                        document.body.appendChild(dataElm);
                        addTj({
                                rsv_sug3: ++rsv_sug3
                        });
                        rsv_temp_time = new Date().getTime();
                        rsv_temp_flag = false;
                        rsv_timer = setTimeout(function() {
                                addTj({
                                        rsv_sug4: rsv_sug4 += 5000
                                });
                                rsv_temp_flag = true
                        }, 5000)
                }
                return MessageDispatcher.ini({
                        rm: function(evtObj) {
                                switch (evtObj.type) {
                                case "request_data":
                                        getDataScript(evtObj.wd);
                                        break;
                                case "give_cookie":
                                        var _sug = evtObj.sug;
                                        if (_sug > 0) {
                                                _sug = 3
                                        }
                                        cookieSwitch = _sug;
                                        break
                                }
                        }
                })
        })();
        bdsug.sug = function(dataObj) {
                bdsug.dm({
                        type: "response_data",
                        data: dataObj
                });
                if (!rsv_temp_flag) {
                        var ipt = G("kw");
                        if (ipt.value.toLowerCase() == dataObj.q) {
                                addTj({
                                        rsv_sug1: ++rsv_sug1
                                })
                        }
                        clearTimeout(rsv_timer);
                        addTj({
                                rsv_sug4: rsv_sug4 += (new Date().getTime() - rsv_temp_time)
                        })
                }
        };
        bdsug.sugPreRequest = function() {};
        bdsug.initSug = function() {
                bdsug.dm({
                        type: "init"
                });
                var requestUrl = bds.comm.sugHost || "http://suggestion.baidu.com/su";
                var dataElm;
                if (dataElm) {
                        document.body.removeChild(dataElm)
                }
                dataElm = C("SCRIPT");
                dataElm.src = requestUrl + "?wd=&cb=window.bdsug.sugPreRequest&sid=" + bds.comm.sid + "&t=" + (new Date()).getTime();
                dataElm.charset = "gb2312";
                document.body.appendChild(dataElm)
        };
        MessageDispatcher.ini(bdsug);
        var Cookie = (function() {
                function close() {
                        if (navigator.cookieEnabled) {
                                document.cookie = "su=0; domain=www.baidu.com"
                        }
                }
                function getSug() {
                        var p = (navigator.cookieEnabled && /sug=(\d)/.test(document.cookie) ? RegExp.$1 : 3);
                        Cookie.dm({
                                type: "give_cookie",
                                sug: p
                        })
                }
                return MessageDispatcher.ini({
                        rm: function(evtObj) {
                                switch (evtObj.type) {
                                case "close":
                                        close();
                                        break;
                                case "need_cookie":
                                        getSug();
                                        break
                                }
                        }
                })
        })();
        var GlobalCtrl = (function() {
                var ipt = G("kw");
                var div;
                var fm = document.forms[0];
                var ie6iframe;
                function listenZoom() {
                        if (div.offsetWidth != 0 && ipt.offsetWidth != div.offsetWidth) {
                                GlobalCtrl.dm({
                                        type: "need_resize"
                                })
                        }
                }
                function createDiv() {
                        div = C("DIV");
                        div.id = "sd_" + new Date().getTime();
                        div.style.display = "none";
                        fm.appendChild(div);
                        if (isIE && isIE <= 6) {
                                ie6iframe = C("IFRAME");
                                ie6iframe.style.display = "none";
                                ie6iframe.style.position = "absolute";
                                div.parentNode.insertBefore(ie6iframe, div)
                        }
                }
                function docMouseDown(e) {
                        e = e || window.event;
                        var elm = e.target || e.srcElement;
                        if (elm == ipt) {
                                return
                        }
                        while (elm = elm.parentNode) {
                                if (elm == div) {
                                        return
                                }
                        }
                        GlobalCtrl.dm({
                                type: "mousedown_other"
                        })
                }
                function windowBlur() {
                        GlobalCtrl.dm({
                                type: "window_blur"
                        })
                }
                function initi() {
                        var dI = "#" + div.id;
                        var cssBuf = [];
                        GlobalCtrl.dm({
                                type: "div_ready",
                                sdiv: div,
                                frm: ie6iframe
                        });
                        setInterval(listenZoom, 100);
                        addEvent(document, "mousedown", docMouseDown);
                        addEvent(window, "blur", windowBlur);
                        cssBuf.push(dI + "{border:1px solid #817F82;position:absolute;top:32px;left:0}");
                        cssBuf.push(dI + " table{width:100%;background:#fff;cursor:default}");
                        cssBuf.push(dI + " td{color:#000;font:14px arial;height:25px;line-height:25px;padding:0 8px}");
                        cssBuf.push(dI + " td b{color:#000}");
                        cssBuf.push(dI + " .mo{background:#ebebeb}");
                        cssBuf.push(dI + " .ml{background:#fff}");
                        cssBuf.push(dI + " td.sug_storage{color:#7A77C8}");
                        cssBuf.push(dI + " td.sug_storage b{color:#7A77C8}");
                        cssBuf.push(dI + " .sug_del{font-size:12px;color:#666;text-decoration:underline;float:right;cursor:pointer;display:none}");
                        cssBuf.push(dI + " .mo .sug_del{display:block}");
                        cssBuf.push(dI + " .sug_ala{border-bottom:1px solid #e6e6e6}");
                        cssBuf.push(dI + " td h3{line-height:14px;margin:6px 0 4px 0;font-size:12px;font-weight:normal;color:#7B7B7B;padding-left:20px;background:url(img/sug_bd.png) no-repeat left center}");
                        cssBuf.push(dI + " td p{font-size:14px;font-weight:bold;padding-left:20px}");
                        cssBuf.push(dI + " td p span{font-size:12px;font-weight:normal;color:#7B7B7B}");
                        addStyle(cssBuf.join(""))
                }
                bdsug.sug.initial = initi;
                return MessageDispatcher.ini({
                        rm: function(evtObj) {
                                switch (evtObj.type) {
                                case "start":
                                        initi();
                                        break;
                                case "init":
                                        createDiv();
                                        break
                                }
                        }
                })
        })();
        Inpt.on("need_data", Data);
        Inpt.on("close_div", Sdiv);
        Inpt.on("key_enter", Sdiv);
        Inpt.on("key_up", Sdiv);
        Inpt.on("key_down", Sdiv);
        Inpt.on("hide_div", Sdiv);
        Inpt.on("start", GlobalCtrl);
        Data.on("request_data", Request);
        Data.on("give_data", Sdiv);
        bdsug.on("response_data", Data);
        bdsug.on("init", GlobalCtrl);
        Sdiv.on("update_data", Data);
        Sdiv.on("clk_submit", Inpt, Form0);
        Sdiv.on("ent_submit", Inpt, Form0);
        Sdiv.on("submit", Form0);
        Sdiv.on("key_select", Inpt);
        Sdiv.on("close", Inpt, Cookie);
        Sdiv.on("mousedown_tr", Inpt);
        GlobalCtrl.on("mousedown_other", Sdiv);
        GlobalCtrl.on("need_resize", Sdiv);
        GlobalCtrl.on("div_ready", Inpt, Sdiv);
        GlobalCtrl.on("window_blur", Sdiv);
        Request.on("need_cookie", Cookie);
        Cookie.on("give_cookie", Request);
        window.bdsug.initSug()
};
var sethfPos = sethfPos || 0;
(function() {
        var s = "http://www.baidu.com/",
            o = navigator.userAgent.indexOf("MSIE") != -1 && !window.opera,
            t = Math.random() * 100,
            z = "百度一下，你就知道",
            c = "";
        window.fa = function(B) {
                try {
                        if (window.sidebar) {
                                window.sidebar.addPanel(z, s, "")
                        } else {
                                if (window.opera && window.print) {
                                        B.setAttribute("rel", "sidebar");
                                        B.setAttribute("href", s);
                                        B.setAttribute("title", z);
                                        B.click()
                                } else {
                                        window.external.AddFavorite(s, z)
                                }
                        }
                } catch (p) {}
        };
        function d(p) {
                if (p) {
                        var e = p.parentNode;
                        if (e) {
                                e.style.marginBottom = "20px";
                                e.style.marginTop = "2px"
                        }
                }
        }
        if (o) {
                try {
                        var A = /se /gi.test(navigator.userAgent);
                        var q = /AppleWebKit/gi.test(navigator.userAgent) && /theworld/gi.test(navigator.userAgent);
                        var k = /theworld/gi.test(navigator.userAgent);
                        var r = /360se/gi.test(navigator.userAgent);
                        var a = /360chrome/gi.test(navigator.userAgent);
                        var f = /greenbrowser/gi.test(navigator.userAgent);
                        var w = /qqbrowser/gi.test(navigator.userAgent);
                        var m = /tencenttraveler/gi.test(navigator.userAgent);
                        var j = /maxthon/gi.test(navigator.userAgent);
                        var x = /krbrowser/gi.test(navigator.userAgent);
                        var l = /BIDUBrowser/gi.test(navigator.userAgent) && (typeof window.external.GetVersion != "undefined");
                        var b = false;
                        try {
                                b = +external.twGetVersion(external.twGetSecurityID(window)).replace(/\./g, "") > 1013
                        } catch (v) {}
                        if (A || b || q || k || r || a || f || w || m || j || x || l) {
                                var h = sethfPos ? document.getElementById("set_f") : document.getElementById("setf");
                                if (h) {
                                        h.style.display = "inline";
                                        if (sethfPos) {
                                                d(h);
                                                c = "favorites"
                                        }
                                }
                        } else {
                                var g = sethfPos ? document.getElementById("set_h") : document.getElementById("seth");
                                var u = g && g.isHomePage(s);
                                if (!u) {
                                        var g = sethfPos ? document.getElementById("set_h") : document.getElementById("seth");
                                        if (g) {
                                                g.style.display = "inline";
                                                if (sethfPos) {
                                                        d(g);
                                                        c = "home"
                                                }
                                        }
                                } else {
                                        if (sethfPos) {
                                                c = "home_exist"
                                        }
                                }
                                if (t <= 1) {
                                        var n = encodeURIComponent(window.document.location.href),
                                            y = window["BD_PS_C" + (new Date()).getTime()] = new Image();
                                        y.src = "http://nsclick.baidu.com/v.gif?pid=201&pj=hps&hp=" + u + "&path=" + n + "&t=" + new Date().getTime();
                                        return true
                                }
                        }
                } catch (v) {}
        } else {
                var h = sethfPos ? document.getElementById("set_f") : document.getElementById("setf");
                if (h) {
                        h.style.display = "inline"
                }
                if (sethfPos) {
                        d(h);
                        c = "favorites"
                }
        }
        if (c && sethfPos) {
                ns_c({
                        fm: "sethf_show",
                        tab: c
                })
        }
})();