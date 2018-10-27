
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"> Sign In to <strong class="text-custom">PoolWork</strong> </h3>
        </div>

        <div class="panel-body">
           
                                <div class="form-group ">
                    <div class="col-xs-12">
                        <img src="<?php echo $qrurl; ?>" alt="">
                    </div>
                                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input id="secret" type="text" class="form-control" name="secret" value="" placeholder="Secret Number" required autofocus>
                    </div>
                </div>


                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <a href="<?php echo base_url().'/auth'; ?>" class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Validate</button>
                    </div>
                </div>


       




        </div>
    </div>


</div>



