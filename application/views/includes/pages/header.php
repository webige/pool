<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title><?php echo $title; ?></title>

        <link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css" />
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>assets/css/cryptofont.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
        
        <!--        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
        <!--  <style>
          .sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
          .sortable .item { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
          .sortable .item iframe { position: absolute; margin-left: -1.3em; }
        
          .sortable .item:hover {
            cursor: pointer;
        }
        
        .sortable .item{
            cursor: move;
        }
          </style>-->


        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>

        <script>
            function resizeIframe(obj, add) {
                obj.style.height = parseInt(obj.contentWindow.document.body.scrollHeight) + add + 'px';
            }
        </script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/counterup/jquery.counterup.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/counterup/jquery.counterup.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/Chart.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/utils.js"></script>



        <script src="<?php echo base_url(); ?>assets/plugins/waypoints/lib/jquery.waypoints.js"></script>

        <!-- DataTables -->
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/pages/jquery.bs-table.js"></script>
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/pages/jquery.sweet-alert.init.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/core.js"></script>
        <!-- END DataTables -->
    </head>
    <body>