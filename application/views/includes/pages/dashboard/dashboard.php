

<!-- Start content -->
<div class="content">
    <div class="container">
        <?php
        $this->load->helper('alertMSG');
        echo getAlertMSG();
        if ($iframes) {

            $user = $this->session->userdata('user');

            if (isset($user->gid) && $user->gid <= 2) {
                for ($i = 1; $i <= count($iframes); $i++) {
                    if (isset($iframes[$i]->name)) {
                        ?>
                        <div class="item" id="<?php echo $i; ?>" <?php echo (isset($iframes[$i]->status) && $iframes[$i]->status < 1) ? 'style="display:none"' : ''; ?>>
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
            } else if (isset($user->gid) && $user->gid == 3) {
                ?>
                <div class="inner-content">
                    <?php
                    include('includes/hashratemonitor.php');
                    ?>
                </div>
                <?php
            }
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
<?php
if (isset($user->gid) && $user->gid <= 2) {
    ?>
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
console.log(json);
                        $('#' + id).hide();
                    }
                })

            }
        }


    </script>
    <script>
        function openIframe(fid) {
            console.log(fid);
            if(fid == 'headerwidget'){
                
                if($('#1').css('display') != 'none'){
                    console.log($('#1').css('display'));
                    return false;
                }
            }
            if(fid == 'contentwidget'){
                
                if($('#2').css('display') != 'none'){
                    console.log($('#2').css('display'));
                    return false;
                }
            }
            if(fid == 'finance'){
                console.log($('#3').css('display'));
                if($('#3').css('display') != 'none'){
                    return false;
                }
            }
            if(fid == 'hashratemonitor'){
                console.log($('#4').css('display'));
                if($('#4').css('display') != 'none'){
                    return false;
                }
            }
            if (fid) {
                $.ajax({
                    method: "POST",
                    url: '<?php echo base_url(); ?>main/iframes_json',
                    data: {fid: fid, desctop: $("#desctop").val(), type: 'open'},
                    dataType: "json",
                    error: function (request, error) {
                        console.log(arguments);
                        alert(" Can't do because: " + error);
                    },
                    success: function (json) {
                        console.log(json)
                        $('#' + json.order).show();
                    }
                })

            }
        }
    </script>
    <?php
}
?>

<footer class="footer text-right">
    © 2018-19. All rights reserved.
</footer>

