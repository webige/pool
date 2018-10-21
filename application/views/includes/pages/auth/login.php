

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"> Sign In to <strong class="text-custom">PoolWork</strong> </h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal m-t-20" method="POST" action="<?php echo base_url(); ?>auth/qrvalidate" aria-label="Login">
                <input type="hidden" name="_token" value="6VAenSycPsOHEGzptCQ2cis6mMdyEPqxBybJlCE3">       
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input id="email" type="email" class="form-control" name="email" value="" placeholder="E-mail" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="secret" type="text" class="form-control" placeholder="secret number" name="secret" required>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input  id="checkbox-signup" type="checkbox" name="remember" >
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Login</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a class="text-dark" href="<?php echo base_url(); ?>auth/passreset">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>
            </form>




        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 text-center">
            <p>Don't have an account? <a href="<?php echo base_url(); ?>auth/register" class="text-primary m-l-5"><b>Sign Up</b></a></p>
        </div>
    </div>

</div>


