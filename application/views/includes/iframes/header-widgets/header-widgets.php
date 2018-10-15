
<div class="row">
    <div class="col-sm-12">
        <div class="card-box widget-inline">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-primary md md-add-shopping-cart"></i> 
                            <b data-plugin="counterup">
                            <?php echo $items['active_workers']; ?>
                            </b>
                        </h3>
                        <h4 class="text-muted"> Active Workers  </h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-custom md md-attach-money"></i> 
                            <b data-plugin="counterup">
                            <?php echo $items['balance']; ?>
                            </b>
                        </h3>
                        <h4 class="text-muted">Unpaid Balance</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center">
                        <h3><i class="text-pink md md-account-child"></i>
                            <b data-plugin="counterup"></b>
                        </h3>
                        <h4 class="text-muted">User: <?php echo $items['user']; ?></h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-inline-box text-center b-0">
                        <h3><i class="text-purple md md-visibility"></i> <b data-plugin="counterup"></b></h3>
                        <h4 class="text-muted">IP  <?php echo $items['ip']; ?></h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>