
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <?php
            if ($iframes) {

                for ($i = 1; $i <= count($iframes); $i++) {
                    if (isset($iframes[$i]->name)) {
                        ?>
                        <div class="item" id="<?php echo $i; ?>" <?php echo $iframes[$i]->status < 1 ? 'style="display:none"' : ''; ?>>
                            <div class="handle" style="cursor: move">Move from here</div>
                            <span style="cursor: pointer" onclick="deleteIframe('<?php echo $iframes[$i]->name; ?>',<?php echo $i; ?>);" >X (CLOSE)</span>
                            <div class="inner-content">
                                <?php
                                include('includes/' . $iframes[$i]->name . '.php');
                                ?>
                            </div>
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
        <input type="hidden" id="desctop" value="<?php echo $this->input->get('d') ? $this->input->get('d') : $usd->desctop; ?>"/>
    </div>

    <!-- content -->
    <script>
        $(document).ready(function () {

            $('.container').sortable({
                stop: function (event, ui) {
                    var elm = $(".item").toArray();
                    var ids = [];
                    var ifrms = <?php echo json_encode($iframes); ?>

                    $.each(elm, function (i, val) {
                        ids[i] = ifrms[val.id].name

                    });
                    console.log(ids)
                    if (ids) {

                        $.ajax({
                            method: "POST",
                            url: '<?php echo base_url(); ?>main/iframes_json',
                            data: {ids: ids, desctop: $("#desctop").val()},
                            dataType: "text",
                            error: function (request, error) {
                                console.log(arguments);
                                alert(" Can't do because: " + error);
                            },
                        })
                    }
                },
                handle: ".handle"

            })
        });

        function deleteIframe(fid, id) {
            if (fid) {
                $.ajax({
                    method: "POST",
                    url: '<?php echo base_url(); ?>main/iframes_json',
                    data: {fid: fid, desctop: $("#desctop").val(), type: 'del'},
                    dataType: "text",
                    error: function (request, error) {
                        console.log(arguments);
                        alert(" Can't do because: " + error);
                    },
                    success: function (json) {
                        
                        $('#' + id).hide();
                    }
                })
                
            }
        }


    </script>
    <footer class="footer text-right">
        © 2018-19. All rights reserved.
    </footer>

</div>
