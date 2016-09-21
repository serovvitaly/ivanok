<div id="social-content-container"></div>
<script>
    function showSocialContent(user_sid) {
        return;
        $.ajax({
            url: '/social-content',
            dataType: 'json',
            type: 'get',
            data: {
                user_sid: user_sid
            },
            success: function(json){
                $('#social-content-container').html(json.html);
            }
        });
    }
    showSocialContent('vitaly.serov');
</script>