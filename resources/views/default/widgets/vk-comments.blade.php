<div class="row">
    <div class="col-lg-4">

        <!-- Виджет для комментариев -->
        <!-- Put this script tag to the <head> of your page -->
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

        <script type="text/javascript">
            VK.init({apiId: 5319349, onlyWidgets: true});
        </script>

        <!-- Put this div tag to the place, where the Comments block will be -->
        <div id="vk_comments"></div>
        <script type="text/javascript">
            VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
        </script>

    </div>
    <div class="col-lg-4">

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5&appId=191056347930494";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5"></div>

    </div>
    <div class="col-lg-4">



    </div>
</div>