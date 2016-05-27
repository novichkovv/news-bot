<div style="height: 100px;" class="hidden-xs"></div>
<div class="row">
    <div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4">
        <section class="panel panel-transparent">
            <header class="panel-heading text-center">
            </header>
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-1">
                            <input type="text" name="email" class="form-control transparent-input" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-1">
                            <label for="inputPassword1" class="control-label"></label>
                            <input type="password" name="password" class="form-control transparent-input" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-1 col-lg-10">
                            <div class="checkbox">
                                <div class="squaredFour">
                                    <input type="checkbox" value="1" id="squaredFour" name="remember" class="styled-checkbox" checked>
                                    <label for="squaredFour"></label>
                                </div>
                                <span class="styled-checkbox-label">Remember me</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <button type="submit" name="login_btn" class="btn btn-danger btn-lg">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function () {
        $('body').css("background-color", "#B4D9E5;");
    });
</script>
