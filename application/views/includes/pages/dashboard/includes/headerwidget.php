
<script type="text/javascript">


    jQuery(document).ready(function () {
console.log('data');
        $.get('<?php echo base_url(); ?>headerwidget/getAllheaderWidget', function (data) {
            console.log('data');
            console.log(data);
            if (data) {
                $('#user_active_workers').html(data['active_workers']);
                $('#user_balance').html(data['balance']);
                $('#user_user').html('User: ' + data['user']);
                $('#user_ip').html('IP ' + data['ip']);
            }
        }, "json");
    });

</script>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box widget-inline">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-primary md md-add-shopping-cart"></i> 
                            <b id="user_active_workers">
                                <?php //echo $items['active_workers']; ?>
                            </b>
                        </h3>
                        <h4 class="text-muted"> Active Workers  </h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-custom md md-attach-money"></i> 
                            <b id="user_balance">
                                <?php //echo $items['balance']; ?>
                            </b>
                        </h3>
                        <h4 class="text-muted">Unpaid Balance</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-pink md md-account-child"></i>
                            <b ></b>
                        </h3>
                        <h4 class="text-muted"  id="user_user"><?php //echo $items['user'];  ?></h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center b-0">
                        <h3><i class="text-purple md md-visibility"></i> <b ></b></h3>
                        <h4 class="text-muted" id="user_ip"> <?php //echo $items['ip'];  ?></h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>