
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
             <iframe src="<?php echo base_url() ?>headerwidget/" style="border:none; width: 100%;" frameborder="0" scrolling="no" onload="resizeIframe(this, 0)"></iframe> 
             <iframe src="<?php echo base_url() ?>contentwidget/" style="border:none; width: 100%;" frameborder="0" scrolling="no" onload="resizeIframe(this, 0)"></iframe> 
             <iframe src="<?php echo base_url() ?>hashratemonitor/" style="border:none; width: 100%;" frameborder="0" scrolling="no" onload="resizeIframe(this, 420)"></iframe> 
             <iframe src="<?php echo base_url() ?>finance/" style="border:none; width: 100%;" frameborder="0" scrolling="no" onload="resizeIframe(this, 0)"></iframe> 
            <?php
            /*
            include('widgets/header-widgets.php');
            include('widgets/content-widgets.php');
            include('widgets/hashrate-monitor.php');
            include('widgets/finance.php');
             * 
             */
            ?>
        </div> <!-- container -->

    </div>

    <!-- content -->

    <footer class="footer text-right">
        © 2018-19. All rights reserved.
    </footer>

</div>
