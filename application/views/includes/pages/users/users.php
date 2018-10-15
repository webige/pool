  <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

              

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Custom Toolbar</b></h4>
                <p class="text-muted font-13">
                    Worker List
                </p>

                <div id="toolbar-row">

                    <button class="btn btn-primary waves-effect waves-light popupForm" >
                                   <span class="btn-label"><i class="fa fa-check"></i></span>
                        Add User
                    </button>
                </div>



                <table id="demo-custom-toolbar"  data-toggle="table"
                       data-toolbar="#toolbar-row"
                       data-search="true"
                       
                       data-show-toggle="true"
                       data-show-columns="true"
                       data-sort-name="id"
                       
                       
                       data-pagination="true"
                       
                       class="table-bordered "
                       style="border-collapse:collapse;"
                >
                    <thead>
                    <tr>
                        
                        <th ></th>
                        <th data-field="id" data-sortable="true" >Order ID</th>
                        <th data-field="name" data-sortable="true">Name</th>
                        <th data-field="date" data-sortable="true" data-formatter="dateFormatter">Order Date</th>
                        <th data-field="amount" data-align="center" data-sortable="true" data-sorter="priceSorter">Price</th>
                        <th data-field="user-status" data-align="center" data-sortable="true" data-formatter="statusFormatter">Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                                            <tr  id="29" data-toggle="collapse" data-target="#demo1" class="accordion-toggle">

                            <td >  <button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                            <td>29</td>
                            <td>sgfsvh</td>
                            <td>dhdadk@gmail.com</td>
                            <td>farmclient</td>
                            <td>Active</td>

                            <td>

                                <button type="button" class="btn btn-success waves-effect waves-light popupForm"
                                        data-route="http://178.128.5.98/users/get/by/id"
                                        data-id="29">
                                                   <span class="btn-label"><i class="fa fa-compass"></i>
                                                   </span>Add Worker
                                </button>


                                <button type="button" class="btn btn-info  waves-effect waves-light editForm"
                                        data-route="http://178.128.5.98/users/get/by/id"
                                        data-id="29">
                                                   <span class="btn-label"><i class="fa fa-exclamation"></i>
                                                   </span>Edit
                                </button>

                                <button type="button" class="btn btn-danger  waves-effect waves-light editForm"
                                        data-route="http://178.128.5.98/users/get/by/id"
                                        data-id="">
                                                   <span class="btn-label"><i class="fa fa-close"></i>
                                                   </span>Delete
                                </button>


                            </td>
                        </tr>

                        <tr id="28">
                        <td colspan="12" class="hiddenRow">
                            <div class="accordian-body collapse" id="demo1">
                                <table class="table-bordered">
                                    <thead>

                                    <tr>
                                        <th>Access Key</th>
                                        <th>Secret Key</th>
                                        <th>Status </th><th> Created</th><th> Expires</th><th>Actions</th></tr>
                                    </thead>
                                    <tbody>
                                    <tr><td>access-key-1</td>
                                        <td>secretKey-1</td>
                                        <td>Status</td>
                                        <td>some date</td>
                                        <td>some date</td>
                                        <td>
                                            <a href="#" class="btn btn-default btn-sm">
                                                <i class="glyphicon glyphicon-cog"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </td>
                        </tr>
                    
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
                                <label for="field-3" class="control-label">Name *</label>
                                <input type="text" class="form-control" id="field-3" placeholder="John Doe" name="name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Email</label>
                                <input type="email" class="form-control" id="field-3" placeholder="example@mail.com" name="email" data-ignore="true">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Password</label>
                                <input type="password" class="form-control "  value=""  name="password" data-ignore="true" >
                            </div>
                        </div>
                        <div class="col-md-12">
                                                            <div class="form-group">
                                    <label for="field-3" class="control-label">Role</label>
                                    <select class="form-control" name="role">
                                                                                    <option value="3">Farm Client</option>
                                                                            </select>
                                </div>
                                                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div><!-- /.modal -->
            </div> <!-- container -->

        </div>

        <!-- content -->

        <footer class="footer text-right">
            © 2018-19. All rights reserved.
        </footer>

    </div>
