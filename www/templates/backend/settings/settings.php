<div class="row">
    <div class="col-xs-2 col-md-1">
        <div class="stat-icon" style="color:#56F5A0;">
            <i class="fa fa-gear fa-3x stat-elem"></i>
        </div>
    </div>
    <div class="col-xs-9 col-md-10">
        <h1>Settings</h1>
    </div>
</div>
<hr>
<br>
<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Change Password
                </h3>
            </div>
            <div class="panel-body">
                <form id="password_form">
                    <div class="form-group">
                        <label>
                            Enter Password
                        </label>
                        <input type="password" name="password" data-require="1" data-validate="password" class="form-control">
                        <div class="validate-message error-require">
                            Field is required
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            Repeat Password
                        </label>
                        <input type="password" name="repeat_password" data-require="1" data-validate="repeat_password" class="form-control">
                        <div class="validate-message error-require">
                            Field is required
                        </div>
                        <div class="validate-message error-validate">
                            Passwords differ
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save Settings" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function () {
        $("#password_form").submit(function()
        {
            if(validate('password_form')) {
                var params = {
                    'action': 'save_password',
                    'get_from_form': 'password_form',
                    'callback': function (msg) {
                        ajax_respond(msg,
                            function (respond) {
                                Notifier.success('The Password has Been Changed', 'Success');
                            });
                    }
                };
                ajax(params);
            }
            return false;
        });
    });
</script>