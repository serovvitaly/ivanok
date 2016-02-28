<div class="modal fade" id="login-and-regist-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New message</h4>
            </div>
            <div class="modal-body">

                <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>

                <div class="btn btn-primary" onclick="VK.Auth.login(authInfo);">ВК</div>

                <script language="javascript">
                    VK.init({
                        apiId: 5319349
                    });
                    function authInfo(response) {
                        if (response.session) {
                            //alert('user: '+response.session.mid);
                        } else {
                            //alert('not auth');
                        }
                    }
                    VK.Auth.getLoginStatus(authInfo);
                </script>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showLoginAndRegistModal() {
        $('#login-and-regist-modal').modal('show');
    }
</script>