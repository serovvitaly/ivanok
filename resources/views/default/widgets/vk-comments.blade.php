<div class="row">
    <div class="col-lg-12">

        <!-- Виджет для комментариев -->
        <!-- Put this script tag to the <head> of your page -->
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

        <script type="text/javascript">
            VK.init({apiId: 5319349, onlyWidgets: true});
        </script>

        <!-- Put this div tag to the place, where the Comments block will be -->
        <div id="vk_comments"></div>
        <script type="text/javascript">
            VK.Widgets.Comments("vk_comments", {limit: 10, width: "665", attach: "*"});
        </script>


        <!-- Виджет рекомендаций -->
        <!-- Put this script tag to the <head> of your page -->
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

        <script type="text/javascript">
            VK.init({apiId: 5319349, onlyWidgets: true});
        </script>

        <!-- Put this div tag to the place, where the Like block will be -->
        <div id="vk_recommended"></div>
        <script type="text/javascript">
            VK.Widgets.Recommended("vk_recommended", {limit: 5, period: 'month'});
        </script>

    </div>
</div>