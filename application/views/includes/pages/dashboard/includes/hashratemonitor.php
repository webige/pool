<div class="row">

    <script>
        var timeFormat = 'MM/DD/YYYY HH:mm';

        function newDate(days) {
            return moment().add(days, 'd').toDate();
        }

        function newDateString(days) {
            return moment().add(days, 'd').format(timeFormat);
        }

        var color = Chart.helpers.color;


        window.onload = function () {
            var ctx = document.getElementById('canvas').getContext('2d');
            var ctxh = document.getElementById('canvas');
            ctxh.height = 100;
            $.getJSON('<?php echo base_url(); ?>Hashratemonitor/getHasRates', function (data) {

                var xAx1 = [];
                var yAx1 = [];

                var xAx7 = [];
                var yAx7 = [];

                var xAx30 = [];
                var yAx30 = [];

                var xAx90 = [];
                var yAx90 = [];

                var sin = [];
                var labels = [];
                var i = 0;

                $.each(data['1day'], function (index, value) {
                    xAx1.push(value.time);
                    yAx1.push({
                        x: value.time,
                        y: value.hashrate
                    });
                    //yAx1.push(value.hashrate);
                    labels.push(newDate(i));
                    i++;
                });

                var i = 0;
                $.each(data['7day'], function (index, value) {
                    yAx7.push({
                        x: value.time,
                        y: value.hashrate
                    });

                    i++;
                });
                
                var i = 0;
                $.each(data['30day'], function (index, value) {
                    yAx30.push({
                        x: value.time,
                        y: value.hashrate
                    });

                    i++;
                });
                
                var i = 0;
                $.each(data['90day'], function (index, value) {
                    yAx90.push({
                        x: value.time,
                        y: value.hashrate
                    });

                    i++;
                });
                
                var config = {
                    type: 'line',
                    data: {
                        // labels: xAx1,
                        datasets: [{
                                label: '1 day Hashrate',
                                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                                borderColor: window.chartColors.red,
                                fill: false,
                                data: yAx1,
                            }
                            ,
                            {
                                label: '7 day Hashrate',
                                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                                borderColor: window.chartColors.blue,
                                fill: false,
                                data: yAx7,
                            }, {
                                label: '30 day Hashrate',
                                backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
                                borderColor: window.chartColors.green,
                                fill: false,
                                data: yAx30,
                            },
                            {
                                label: '90 day Hashrate',
                                backgroundColor: color(window.chartColors.brown).alpha(0.5).rgbString(),
                                borderColor: window.chartColors.brown,
                                fill: false,
                                data: yAx90,
                            }
                        ]
                    },
                    options: {
                        title: {
                            text: 'Chart.js Time Scale'
                        },
                        scales: {
                            xAxes: [{
                                    type: 'time',
                                    time: {
                                        format: timeFormat,
                                        //round: 'day',
                                        tooltipFormat: 'll HH:mm'
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Date'
                                    }
                                }],
                            yAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'value'
                                    }
                                }]
                        },
                    }
                };
                window.myLine = new Chart(ctx, config);
            });


        };

        function getWorkers(name, id) {

            if (id == '' || id == ' ') {
                $('#demo-custom-toolbar').bootstrapTable("removeAll");
                var data = [
                    {
                        checkbox: '<div class="label label-table "> <input type="checkbox" class="group_radio_val" name="group" value="' + name + '"></div>',
                        name: name,
                        worker: '',
                        status: '<div class="label label-table label-warning"> Failed</div>'
                    }
                ]
                $('#demo-custom-toolbar').bootstrapTable("load", data);
                return false;
            }

            var k = '<?php echo base_url(); ?>Hashratemonitor/getWorkers';

            $.ajax({
                type: 'POST',
                url: k,
                data: {id: id, name: name},
                dataType: 'json',
                success: function (data) {
                    var newRowContent = '';
                    $('#demo-custom-toolbar').bootstrapTable("load", data);

                    // $("#demo-custom-toolbar tbody").append(newRowContent);
                    console.log(data);
                }
            })

        }

        function addNew() {
            var val = '';
            $('.group_radio_val').each(function () {
                if ($(this).prop("checked")) {
                    val = $(this).val();
                }
                //console.log($(this).prop("checked"));
            });
            if (val) {
                var k = '<?php echo base_url(); ?>Hashratemonitor/getGroup';
                $.ajax({
                    type: 'POST',
                    url: k,
                    data: {id: val},
                    dataType: 'json',
                    success: function (data) {

                        $('#filed_name').val(data['name']);
                        $('#filed_name').attr('disabled', 'disabled');
                        $('#filed_email').val(data['email']);
                        $('#filed_id').val(data['id']);
                        //console.log(data);
                    }
                });
            } else {
                $('#filed_name').val('');
                $('#filed_name').removeAttr('disabled', 'disabled');
                $('#filed_email').val('');
                $('#filed_id').val('');
            }
            $('.popupForm').click();
            return false;
        }

        function saveChanges() {
            var name = $('#filed_name').val();
            var email = $('#filed_email').val();
            var id = $('#filed_id').val();

            var password = $('#filed_Password').val();
            var password1 = $('#filed_Password1').val();

            if (name == '' || name == ' ') {
                alert('name is empty');
                return false;
            }

            if (email == '' || name == ' ') {
                alert('email is empty');
                return false;
            }

            if (!validateEmail(email)) {
                alert('email is not valid');
                return false;
            }

            if (password != password1) {
                alert('passwords do not match');
                return false;
            }

            if (password.length != 0 && password.length < 6) {
                alert('passwords minimum length must be 6');
                return false;
            }

            if (id == '' || id == ' ') {
                if (password == '' || password == ' ') {
                    alert('passwordis empty');
                    return false;
                }
            }

            var k = '<?php echo base_url(); ?>Hashratemonitor/saveGroupChanges';
            $.ajax({
                type: 'POST',
                url: k,
                data: {id: id, email: email, name: name, password: password},
                dataType: 'json',
                success: function (data) {

                    if (data['ok'] == 1) {
                        alert('Saved Successfully !!!');
                        if (data['insert'] == 1) {
                            $('#table-row').append('<button class="btn btn-primary waves-effect waves-brown " onclick="getWorkers("")">' + name + '</button>')
                        }

                    } else if (data['ok'] == 2) {
                        alert('Name or email already exists !!!');
                    } else {
                        alert('Did Not Save !!!');
                    }
                    $('.close').click();
                    return false;
                    //console.log(data);
                }
            });

        }
        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

    </script>

    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title"><b>Line Chart</b></h4>
            <div class="line-chart">
                <canvas id="canvas"></canvas>
            </div>
        </div>
    </div>


    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Custom Toolbar</b></h4>
            <p class="text-muted font-13">
                Worker List
            </p>

            <div id="toolbar-row">

                <?php
                $user = $this->session->userdata('user');
                if ($groups) {
                    foreach ($groups as $row) {
                        ?>
                        <button class="btn btn-primary waves-effect waves-brown " onclick="getWorkers('<?php echo $row->name; ?>', '<?php echo $row->id; ?>')">
                            <?php echo $row->name; ?>
                        </button>
                        <?php
                    }
                }

                if ($user->gid == 3) {
                    ?>
                    <button class="btn btn-primary waves-effect waves-brown " onclick="getWorkers('<?php echo $user->name; ?>', '<?php echo $user->id; ?>')">
                        <?php echo $user->name; ?>
                    </button>
                    <?php
                }
                ?>

                <button style="display: none;" class="btn btn-primary waves-effect waves-light popupForm" >
                    <span class="btn-label"><i class="fa fa-check"></i></span>
                    Add User
                </button>
            </div>
            <?php
            if ($user->gid < 3) {
                ?>
                <div class="columns columns-right btn-group pull-right" onclick="addNew()"><button class="btn btn-default" type="button" name="toggle" title="Toggle"><i class="glyphicon glyphicon-list-alt icon-list-alt"></i></button></div>
                <?php
            }
            ?>


            <table id="demo-custom-toolbar"  data-toggle="table"
                   data-toolbar="#toolbar-row"
                   data-search="true"

                   data-show-toggle="false"
                   data-show-columns="false"
                   data-sort-name="id"
                   data-cardView="false"


                   data-pagination="true"

                   class="table-bordered "
                   style="border-collapse:collapse;"
                   >
                <thead>
                    <tr>

                        <th ></th>
                        <th data-field="checkbox" data-sortable="true" >Edit Group</th>
                        <th data-field="name" data-sortable="true">Group</th>
                        <th data-field="worker" data-sortable="true" data-formatter="dateFormatter">Worker</th>
                        <th data-field="status" data-align="center" data-sortable="true" data-formatter="statusFormatter">Status</th>
                        <th data-field="time" data-align="center" data-sortable="true" data-sorter="dateFormatter">Start date</th>
                        <th data-field="last-date" data-align="center" data-sortable="true" data-sorter="dateFormatter">Last date</th>
                        <th data-field="miners" data-align="center" data-sortable="true" >Miners</th>
                        <th data-field="hashrate" data-align="center" data-sortable="true" >H-rate active</th>
                        <th data-field="hashrate24" data-align="center" data-sortable="true" >H-rate 24H</th>
                        <th data-field="hashrateavg" data-align="center" data-sortable="true">H-rate 24 avg</th>

                    </tr>
                </thead>

                <tbody>
                    <!--
                                        <tr  id="29" data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                    
                                            <td >  <button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                                            <td>29</td>
                                            <td>GR1</td>
                                            <td>GR1.1</td>
                                            <td>Active</td>
                                            <td>25.12.18</td>
                                            <td>25.12.18</td>
                                            <td>3</td>
                                            <td>25.43</td>
                                            <td>27.30</td>
                                            <td>55.55</td>
                    
                                        </tr>
                    -->

                </tbody>
            </table>
        </div>
    </div>


</div>
<div id="con-close-modal" class="modal fade modalWindow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form class="ajax-form formEditable" method="POST" action="http://178.128.5.98/users" data-redirect="true">
            <input type="hidden" name="parent_id" value="24">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="filed_name" class="control-label">Name *</label>
                                <input type="text" class="form-control" id="filed_name" placeholder="John Doe" name="name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="filed_email" class="control-label">Email</label>
                                <input type="email" class="form-control" id="filed_email" placeholder="example@mail.com" name="email" data-ignore="true">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="filed_password" class="control-label">Password</label>
                                <input type="password" class="form-control " id="filed_Password" value=""  name="password" data-ignore="true" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="filed_password1" class="control-label">Repeat Password</label>
                                <input type="password" class="form-control "  value="" id="filed_Password1" name="password" data-ignore="true" >
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="filed_id" >
                        <!-- <div class="col-md-12">
                             <div class="form-group">
                                 <label for="field-3" class="control-label">Role</label>
                                 <select class="form-control" name="role">
                                     <option value="3">Farm Client</option>
                                 </select>
                             </div>
                         </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info waves-effect waves-light" onclick="saveChanges();">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div><!-- /.modal -->