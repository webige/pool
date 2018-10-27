<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="<?php echo base_url(); ?>" class="logo"><i class="icon-magnet icon-c-logo"></i><span>P<i class="md md-album"></i><i class="md md-album"></i>LW<i class="md md-album"></i>RK</span></a>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button class="button-menu-mobile open-left waves-effect waves-light">
                            <i class="md md-menu"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>


                    <form role="search" class="navbar-left app-search pull-left hidden-xs">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>

                    <ul class="nav navbar-nav hidden-xs" style="margin-left: 40px;">
                        <li><a href="<?php echo base_url(); ?>main/setalgo?algo=sha256" class="waves-effect waves-light topActive" style="border-left: 1px solid #ffffff;">SHA256 >> 123 PH</a></li>
                        <li><a href="<?php echo base_url(); ?>main/setalgo?algo=scrypt" class="waves-effect waves-light "  style="border-left: 1px solid #ffffff;">SCRYPT >> 12 GH</a></li>
                        <li><a href="<?php echo base_url(); ?>main/setalgo?algo=x11" class="waves-effect waves-light "  style="border-left: 1px solid #ffffff;">X11 >> 123 TH</a></li>

                    </ul>


                    <ul class="nav navbar-nav navbar-right pull-right">
                        <!--
                         <li class="hidden-xs">
                             <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>
                         </li>
                        -->
                        <li class="dropdown top-menu-item-xs">
                            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                <img src="<?php echo base_url(); ?>assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle">
                            </a>
                            <ul class="dropdown-menu">
                                <!--<li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a></li>
                                <li class="divider"></li>-->
                                <li>
                                    <a href="<?php echo base_url(); ?>auth/logout" >
                                        <i class="ti-power-off m-r-10 text-danger"></i> Logout
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
