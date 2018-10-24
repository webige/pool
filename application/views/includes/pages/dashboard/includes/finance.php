<script>

    $(document).ready(function(){

//       
//            $('#datatable-buttons').bootstrapTable("removeAll");
//            var data = [
//                {
//                    checkbox: '<div class="label label-table "> <input type="checkbox" class="group_radio_val" name="group" value="' + name + '"></div>',
//                    name: name,
//                    worker: '',
//                    status: '<div class="label label-table label-warning"> Failed</div>'
//                }
//            ]
//            $('#datatable-buttons').bootstrapTable("load", data);
//            return false;
        

        var k = '<?php echo base_url(); ?>finance/getData';

        $.ajax({
            type: 'POST',
            url: k,
            dataType: 'json',
            success: function (data) {
                var newRowContent = '';
                $('#datatable-buttons').bootstrapTable("load", data);

                // $("#demo-custom-toolbar tbody").append(newRowContent);
                console.log(data);
            }
        })

});</script>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Financial Statement</b></h4>

            <table id="datatable-buttons" data-toggle="table"
                   
                   data-search="true"

                   data-show-toggle="false"
                   data-show-columns="false"
                   data-sort-name="id"
                   data-cardView="false"


                   data-pagination="true"

                   class="table-bordered "
                   style="border-collapse:collapse;">
                <thead>
                    <tr>
<!--                        <th ></th>
                        <th data-field="checkbox" data-sortable="true" >Edit Group</th>-->
                        <th data-field="id" data-sortable="true">ID</th>
                        <th data-field="wallet" data-sortable="true">to wallet</th>
                        <th data-field="time_start" data-sortable="true">date requested</th>
                        <th data-field="time_end" data-sortable="true">date processed</th>
                        <th data-field="status" data-sortable="true">status</th>
                        <th data-field="operation" data-sortable="true">operation</th>
                        <th data-field="commission" data-sortable="true">commission</th>
                        <th data-field="amount_net" data-sortable="true">amount net</th>
                        <th data-field="balance_after" data-sortable="true">balance after</th>
                        <th data-field="tunover_after" data-sortable="true">tunover after</th>
                        <th data-field="details" data-sortable="true">details</th>
                    </tr>
                </thead>


                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>