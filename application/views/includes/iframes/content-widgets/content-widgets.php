<script type="text/javascript">
    
    
    calculateBtc = $('.calculateBtc');
    calculateBtcToUsd = $('.calculateBtcToUsd');


    jQuery(document).ready(function ($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });

        $('.bootstrap-touchspin-up').click(function () {
            var val = parseInt($("input[name='calculator']").val()) + 1;
            console.log(val)
            $("input[name='calculator']").val(val);
        });

        $('.bootstrap-touchspin-down').click(function () {
            var val = parseInt($("input[name='calculator']").val());
            if (val > 0) {
                val -= 1;
                $("input[name='calculator']").val(
                        val
                        );
            }

        });


        $("input[name='calculator']").keyup(function () {
            $(this).val(this.value.replace(/[^0-9\.]/g,''));
            if ($.isNumeric($(this).val())) {

                if ($(this).val() == 0) {
                    calculateBtc.html("0.00000");
                    calculateBtcToUsd.html(" 0.00000");
                } else {
                    var data = {
                        hashrate: $(this).val(),
                        rate: $(this).attr('data-btc-rate')
                    };

                    $.post('<?php echo base_url(); ?>contentwidget/calculate', data)
                            .done(function (res) {
                                calculateBtc.html(res['coinsPerDay']);
                                calculateBtcToUsd.html(res['usdPerDay']);
                                console.log(res);
                            })
                }


            }

        });

    });


</script>

<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-3">
        <div class="card-box widget-box-2 bg-white">
            <h4 class="text-dark">Payout Currency  <i class="fa fa-arrow-circle-down" ></i></h4>
            <div class="row">
                <div class="col-md-6">
                    <h2>
                        <i class="cf crypto-size cf-btc-alt"></i>
                    </h2>
                </div>
                <div class="col-md-6">
                    <h5>
                        <p> USD : <?php echo $bittrex_btcusd; ?></p>
                    </h5>
                </div>
            </div>
            <p class="text-muted">BTC  (Bittrex):
                <span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i>10.25% (24h)</span>
            </p>


        </div>
    </div>        <div class="col-md-6 col-sm-6 col-lg-3">
        <div class="card-box widget-box-2 bg-white">
            <h4 class="text-dark" style="margin: 0 0 25px 0;">SHA256 CALCULATOR</h4>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group bootstrap-touchspin">
                            <span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-down" type="button">-</button></span>
                            <span class="input-group-addon bootstrap-touchspin-prefix">th</span>   
                            <input id="demo0" type="text" value="0" name="calculator" 
                                   class="form-control" style="display: block;"
                                   />
                            <span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span>
                            <span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-up" type="button">+</button></span>                    </div>
                    </div>
                </div>
            </div>

            <p class="text-muted">

                <span class="calculateBtc"> 0.00000 </span> /  <span class="calculateBtcToUsd"> 0.00000 </span><span> USD 24 h </span>
                <br>
                1 TH = <span class="thDefault">
                    0.0000351553
                </span> BTC
            </p>

        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3">
        <div class="card-box widget-box-2 bg-white">

            <span class="mini-stat-icon bg-pink"><i class="ion-android-contacts text-white"></i></span>
            <div class="mini-stat-info text-right text-dark">
                <span class="counter text-dark"><?php echo $fullworkers['users']; ?></span>
                Users
            </div>

            <div class="mini-stat-info text-right text-dark">
                <span class="counter text-dark"><?php echo $fullworkers['workers']; ?></span>
                Workers
            </div>
            <h5 class="text-uppercase"> SHA256 </h5>


        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3">
        <div class="card-box widget-box-2 bg-white">
            <h4 class="text-dark"> H-RATE <span class="pull-right">SHA256</span></h4>
            <div class="row">

                <div class="col-md-12">
                    <h5>
                        <p> POOL <span class="pull-right"><?php echo $allhashrates['all'] ?> PH</span> </p>
                        <p> YOUR <span class="pull-right"><?php echo $allhashrates['my'] ?> PH</span> </p>
                    </h5>
                </div>
            </div>
            <p class="text-muted"><?php echo $allhashrates['my'] * 100 / $allhashrates['all']; ?>% OF POOL</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-3">

        <div class="card-box widget-box-2 bg-white">
            <div class="row">

                <div class="col-md-6">
                    <h2>
                        <i class="cf crypto-size cf-ltc"></i>
                    </h2>
                </div>
                <div class="col-md-6">
                    <h5>
                        <p> USD : 12312312</p>
                        <p> EUR : 12312312</p>
                    </h5>
                </div>
            </div>
            <p class="text-muted">BTC  (BINANCE):
                <span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i>10.25% (24h)</span>
            </p>

        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3">

        <div class="card-box widget-box-2 bg-white">
            <div class="row">

                <div class="col-md-6">
                    <h2>
                        <i class="cf crypto-size cf-btc-alt"></i>
                    </h2>
                </div>
                <div class="col-md-6">
                    <h5>
                        <p> USD : 12312312</p>
                        <p> EUR : 12312312</p>
                    </h5>
                </div>
            </div>
            <p class="text-muted">BTC  (BINANCE):
                <span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i>10.25% (24h)</span>
            </p>

        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3">
        <div class="card-box widget-box-2 bg-white">
            <h5 style="margin-top: -7px;">H-RATE PER GROUP <span class="pull-right"> SHA256 </span></h5>

            <div class="row">

                <div class="col-md-7">

                    <span class="btn btn-purple btn-rounded waves-effect waves-light"> GROUP 1 </span>

                </div>
                <div class="col-md-5">
                    <h5>
                        <p>33/ <span class="color-red">3</span>
                            <br> Workers
                            <br> 123.3 TH </p>
                    </h5>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3">
        <div class="card-box widget-box-2 bg-white">
            <div class="row">

                <div class="col-md-7">

                    <h1>
                        <?php echo $allusers; ?>
                    </h1>

                </div>
                <div class="col-md-5">

                    <h2> <i class="fa fa-users" style="font-size: 1.6em; color: #64C5A4;"></i> </h2>
                </div>
            </div>
            <h4 class="text-muted">Users
                <span class="pull-right"></span>
            </h4>
        </div>
    </div>  
</div>