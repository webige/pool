<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <script type="text/javascript">
                function addWallet() {
                    var val = $('#example-input1-group1').val();
                    if (confirm("Dow you really want to change your LTC wallet?") == true) {
                        if (val) {
                            var k = 'http://localhost/poolworks.io/wallet/addWallet';

                            $.ajax({
                                type: 'POST',
                                url: k,
                                data: {name: val, type: 2},
                                dataType: 'json',
                                success: function (data) {
                                    if (data['ok'] = 1) {
                                        $('#main_wallet').val(data['wallet']);
                                        $('#example-input1-group1').val(data['wallet']);
                                        $('#main_wallet_editable').val(data['wallet']);
                                        alert('Wallet added successfully');
                                    } else {
                                        alert('Wallet did not add !!!');
                                    }
                                    return false;

                                }
                            })

                        }
                    }


                }
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
                                            <?php
                                            $value = '';
                                            if (isset($wallet->wallet) && !empty($wallet->wallet)) {
                                                $value = $wallet->wallet;
                                            }
                                            ?>
                                            <input type="text" class="form-control" id="main_wallet" placeholder="xxxxxxx" disabled="disabled" name="address" data-ignore="true" value="<?php echo $value; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="field-3" class="control-label">Transfer</label>
                                            <input type="password" class="form-control " value="" name="password" data-ignore="true">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="field-3" class="control-label">Transfer</label>
                                            <p>LTC To Wallet</p>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="field-3" class="control-label">LTC</label>
                                            <input type="password" class="form-control " id="main_wallet_editable" value="<?php echo $value; ?>" name="password" data-ignore="true">
                                        </div>
                                    </div>

                                </div>

                                <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title">
                            <a class="btn btn-success popupForm" href="javascript:void (0)" data-different-modal-classname=".modalWindowDiff">
                                Update Main Wallet
                            </a>
                        </h4>
                        <div class="pull-right">
                            <span class="cf crypto-size-big cf-btc-alt">  LTC</span>
                        </div>

                        <div class="p-20">
                            <div class="row">

                                <form>


                                    <div class="form-group col-md-12">

                                        <label>Address </label>

                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-info waves-effect waves-light" onclick="addWallet();">Add/Edit Wallet</button>
                                            </div>
                                            <input type="text" id="example-input1-group1" name="address" class="form-control" value="<?php echo $value; ?>">
                                        </div>
                                    </div>

                                </form>

                            </div>

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

</div>