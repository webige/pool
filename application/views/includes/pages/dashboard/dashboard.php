
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <?php
            if ($iframes) {
                ?>

                <?php
                for ($i = 1; $i <= count($iframes); $i++) {
                    if (isset($iframes[$i])) {
                        ?>
                        <div class="item" id="<?php echo $i; ?>">
                            Move from here
                            <iframe src="<?php echo base_url() . $iframes[$i] ?>/" style="border:none; width: 100%;" frameborder="0" scrolling="no" onload="resizeIframe(this, <?php echo $iframes[$i] == 'hashratemonitor' ? 420 : 0; ?>)"></iframe>

                        </div>
                        <?php
                    }
                }
                ?>
                <?php
            }
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
    <script>
        $(function () {

            $('.container').sortable({

                stop: function (event, ui) {
                    var elm = $(".item").toArray();
                    var ids = [];
                    var ifrms = <?php echo json_encode($iframes); ?>

                    $.each(elm, function (i, val) {
                        ids[i] = ifrms[val.id]

                    });
                    console.log(ids)
                    if (ids) {
                        $.ajax({
                            method: "POST",
                            url: '<?php echo base_url(); ?>main/iframes_json',
                            data: {ids: ids}

                        })
                    }
                }

            })
        });



    </script>
    <footer class="footer text-right">
        © 2018-19. All rights reserved.
    </footer>

</div>
