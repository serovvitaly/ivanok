<div class="row">
    <div class="col-lg-3">

        <!-- Виджет «Публикация ссылок» -->
        <!-- Put this script tag to the <head> of your page -->
        <script type="text/javascript" src="http://vk.com/js/api/share.js?93" charset="windows-1251"></script>

        <!-- Put this script tag to the place, where the Share button will be -->
        <script type="text/javascript"><!--
            document.write(VK.Share.button(false,{type: "round", text: "Поделиться"}));
            --></script>
    </div>
    <div class="col-lg-3">

        <!-- Виджет «Мне нравится» -->
        <!-- Put this script tag to the <head> of your page -->
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

        <script type="text/javascript">
            VK.init({apiId: 5319349, onlyWidgets: true});
        </script>

        <!-- Put this div tag to the place, where the Like block will be -->
        <div id="vk_like"></div>
        <script type="text/javascript">
            VK.Widgets.Like("vk_like", {type: "button", height: 24});
        </script>

    </div>
    <div class="col-lg-3">

        <!-- Виджет «Подписаться на автора» -->
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

        <!-- VK Widget -->
        <div id="vk_subscribe"></div>
        <script type="text/javascript">
            VK.Widgets.Subscribe("vk_subscribe", {}, 167600225);
        </script>

    </div>
    <div class="col-lg-3">

        <a target="_blank" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share" data-mrc-config="{'cm' : '1', 'sz' : '30', 'st' : '1', 'tp' : 'mm'}">Нравится</a>
        <script src="https:/connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>

        <a href="https://twitter.com/VitaliySerov" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @VitaliySerov</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


        <div id="ok_shareWidget"></div>
        <script>
            !function (d, id, did, st) {
                var js = d.createElement("script");
                js.src = "https://connect.ok.ru/connect.js";
                js.onload = js.onreadystatechange = function () {
                    if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                        if (!this.executed) {
                            this.executed = true;
                            setTimeout(function () {
                                OK.CONNECT.insertShareWidget(id,did,st);
                            }, 0);
                        }
                    }};
                d.documentElement.appendChild(js);
            }(document,"ok_shareWidget","https://apiok.ru","{width:125,height:25,st:'oval',sz:12,ck:1}");
        </script>


    </div>
</div>