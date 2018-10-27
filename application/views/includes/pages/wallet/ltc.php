<!-- Start content -->
<div class="content">
    <div class="container">
        <?php
        $this->load->helper('alertMSG');
        echo getAlertMSG();

        $user = $this->session->userdata('user');
        ?>
        <script type="text/javascript">

            $(document).ready(function () {
                $('#amount').keyup(function () { this.value=this.value.replace(/[^0-9\.]/g,'');});
                $('#transfer_button').click(function () {
                    var wallet = $('#main_wallet').val();
                    var amount = parseFloat($('#amount').val());
                    var password = $('#password').val();

                    if (wallet == '' || wallet == ' ') {
                        alert('wallet is empty');
                        return false;
                    }
                    if (amount == '' || amount == ' ' || amount == 0) {
                        alert('amount is empty');
                        return false;
                    }
                    if (password == '' || password == ' ') {
                        alert('password is empty');
                        return false;
                    }
                    if($('#wallet_secret').val().length != 6){
                        alert('Google 2fs must contain 6 letter');
                        return false;
                    }

                    var userAmount = '<?php echo $user->balance; ?>';

                    console.log(userAmount);
                    if (amount < userAmount) {
                        alert('balance not enough');
                        //return false;
                    }

                    $('#transfer_form').submit();

                });
            });

        </script>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">
                        <a class="btn btn-success popupForm" href="javascript:void (0)">
                            Update Main Wallet
                        </a>
                    </h4>

                    <div class="pull-right">
                        <span class="cf crypto-size-big cf-btc-alt">  LTC</span>
                    </div>

                    <div class="p-20">
                        <form method="POST">


                            <input type="hidden" name="currency" value="LTC">

                            <div class="row">

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Wallet Address</label>

                                        <input type="text" class="form-control" id="main_wallet" placeholder="xxxxxxx" disabled="disabled" name="address" data-ignore="true" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Transfer</label>
                                        <input type="password" class="form-control " value="" name="password" data-ignore="true">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Password</label>
                                        <input type="password" class="form-control " id="main_wallet_editable" name="password" data-ignore="true">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Google 2fa</label>
                                        <input type="password" class="form-control " id="wallet_secret" value="" name="secret" data-ignore="true">
                                    </div>
                                </div>

                            </div>

                            <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>

    </div> <!-- container -->

</div>

<!-- content -->

<footer class="footer text-right">
    © 2018-19. All rights reserved.
</footer>

