<?php
$this->load->helper('alertMSG');
echo getAlertMSG();
?> 

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"> Validate to <strong class="text-custom">PoolWork</strong> </h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal m-t-20" method="POST" action="<?php echo base_url(); ?>auth/qrlogin" aria-label="Login">

                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="secret" type="text" class="form-control" placeholder="secret number" name="secret" required>
                    </div>
                </div>


                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Login</button>
                    </div>
                </div>

            </form>




        </div>
    </div>

</div>


