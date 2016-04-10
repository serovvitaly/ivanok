<?php return; ?>

<div id="gogogogg" style="background: red; position: absolute; padding: 20px;" onmousemove="bodyMouseMove()">
    <!-- Put this script tag to the <head> of your page -->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

    <script type="text/javascript">
        VK.init({apiId: 5319349});
    </script>

    <!-- Put this div tag to the place, where Auth block will be -->
    <div id="vk_auth"></div>
    <script type="text/javascript">
        VK.Widgets.Auth("vk_auth", {width: "200px", onAuth: function(data) {
            alert('user '+data['uid']+' authorized');
        } });
    </script>
</div>
<script>
    function bodyMouseMove() {
        console.log('gf')
    }

    $(document).ready(function(){

        document.getElementById('gogogogg').onmousemove(function(){
            console.log('uyyyuu')
        });

        console.log('Document ready...');

        console.log(document.body.onmousemove);

        document.body.addEventListener('onmousemove', function(){
            console.log('he')
        })
    })
</script>
