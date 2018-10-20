<?php
        $user = $this->session->userdata('user');
        $this->load->helper('userdesctop');
        
        $usd = getDesctop($user->id);
?>
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

                <li class="text-muted menu-title">Navigation</li>

                <li>
                    <a href="<?php echo base_url(); ?>?d=1" class="waves-effect <?php echo (!$this->input->get('d') && $usd->desctop == 1) ? 'active':''; ?>"><i class="ti-home"></i> <span> Dashboard 1</span> </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>?d=2" class="waves-effect <?php echo (!$this->input->get('d') && $usd->desctop == 2) ? 'active':''; ?>"><i class="ti-home"></i> <span> Dashboard 2</span> </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>?d=3" class="waves-effect <?php echo (!$this->input->get('d') && $usd->desctop == 3) ? 'active':''; ?>"><i class="ti-home"></i> <span> Dashboard 3</span> </a>
                </li>
                <li >
                    <a href="#" class="waves-effect"><i class="fa fa-pie-chart"></i> <span> FINANCE </span> </a>
                </li>
                <li>
                    <a href="#" class="waves-effect "><i class="fa fa-area-chart"></i> <span> HASHRATE MONITOR </span> </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0)" class="waves-effect"><i class="fa fa-google-wallet"></i> <span> WALLETS </span>  <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>wallet/btc">Wallets BTC</a></li>
                        <li><a href="<?php echo base_url(); ?>wallet/ltc">Wallets LTC</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bolt"></i> <span> SETTINGS </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>users">WORKERS ASSIGN</a></li>
                        <li><a href="#">GROUPS TREE</a></li>
                        <li><a href="#">ACCOUNT SETTINGS</a></li>
                        <li><a href="#">SECURITY</a></li>
                    </ul>
                </li>



            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>