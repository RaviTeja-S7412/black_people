<?php
$this->load->view('includes/header')
?>

<div class="content">

    <div class="row">
        <div class="col-md-10">
            <h2 align="center">
                <centre>Users List</centre>
            </h2>
        </div>
        <div class='col-md-2'><!-- <button type="button" class="btn btn-primary btn-sm add_users mt-3 mr-3" style="float:right;" id="add_users" name="add_users">Add User</button> --></div>
    </div>
        <div class="container-fluid">
            <table id="users_datatable" class="table table-striped" style="width:90%">
                <thead>
                    <tr>
                        <th><b>S.No</b></th>
                        <th><b>Name</b></th>
                        <th><b>Mobile</b></th>
                        <th><b>Email</b></th>
                        <th><b>Role</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($data)) {
                        $i = 1;
                        foreach ($data as $d) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $d['first_name'] . " " . $d['last_name']; ?></td>
                                <td><?php echo $d['mobile']; ?></td>
                                <td><?php echo $d['email']; ?></td>
                                <td><?php echo $d['role']; ?></td>
                                <!-- <td><?php echo $d['password']; ?></td> -->
                                <td>
                                    <i class="fa fa-edit edit_users" id="edit_users" user_id=<?php echo $d['id']; ?> style="font-size:12px;color:#00FFFF"></i>
                                    
                                    <i class="fa fa-trash delete_users" id="delete_users" user_id=<?php echo $d['id']; ?> status=<?php echo $d['status']; ?> style="font-size:12px;color:#FF0000"></i>
                                    
                                </td>
                            </tr>
                    <?php
                            $i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
        $this->load->view('includes/footer')
        ?>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Add Module</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="record_id" id="record_id" value="">
                        <div class="row">

                            <div class="col-4">
                                <div class="form-group">
                                    <lable>First Name</lable>
                                    <input type="text" class="form-control form-control-sm" id="fname">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <lable>Last Name</lable>
                                    <input type="text" class="form-control form-control-sm" id="lname">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <lable>Email</lable>
                                    <input type="text" class="form-control form-control-sm" id="email">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <lable>Mobile</lable>
                                    <input type="text" class="form-control form-control-sm" id="mobile">
                                </div>
                            </div>

                            <!-- <div class="col-4">
                      <div class="form-group">
                        <lable>Role</lable>
                        <select class="form-control form-control-sm" id="role">
                            <option value="admin">Admin</option>
                            <option value="employee">Employee</option>
                      </div>
                    </div> -->

                            <div class="col-4">
                                <div class="form-group">
                                    <lable>Password</lable>
                                    <input type="text" class="form-control form-control-sm" id="password">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <lable>Confirm Password</lable>
                                    <input type="text" class="form-control form-control-sm" id="cpassword">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-8">
                                    <p style="display: none; color:red;" id="error">Please Recheck The Data</p>
                                    <p style="display: none; color:red;" id="error1">Password and confirm password should be same</p>

                                </div>

                                <div class="col-8">
                                    <button type="button" class="btn btn-primary add_user_submit" style="float:right" id="add_user_submit">Submit</button>
                                </div>
                            </div>
                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                simpledatatable();

                $(document).on("click", ".add_users", function() {
                    $("#record_id").val("");
                    $("#fname").val("");
                    $("#lname").val("");
                    $("#email").val("");
                    $("#mobile").val("");
                    $("#password").val("");
                    $("#cpassword").val("");
                    $("#designation").val("");
                    $("#erroe").hide();
                    $("#erroe1").hide();
                    $("#myModal").modal('show');
                });

                $(document).on("click", "#add_user_submit", function() {
                    var record_id = $("#record_id").val();
                    var fname = $("#fname").val();
                    var lname = $("#lname").val();
                    var email = $("#email").val();
                    var mobile = $("#mobile").val();
                    var password = $("#password").val();
                    var cpassword = $("#cpassword").val();
                    var designation = $("#designation1").val();

                    if (designation == "" || fname == "" || email == "" || mobile == "" || password == "") {
                        $("#error").show();
                        var valid1 = false;
                    } else {
                        var valid1 = true;
                    }

                    if (password != cpassword) {
                        $("#error1").show();
                        var valid2 = false;
                    } else {
                        var valid2 = true;
                    }

                    if (valid1 == false || valid2 == false) {} else {
                        $.ajax({
                            url: "<?php echo base_url("users/saveData") ?>",
                            type: "post",
                            data: {
                                fname: fname,
                                record_id: record_id,
                                lname: lname,
                                email: email,
                                mobile: mobile,
                                password: password
                            },
                            success: function(res) {
                                // alert(res)
                                if (res == "success") {
                                    if (record_id == "") {
                                        alert('New User Added Successfully.')
                                    } else {
                                        alert('Updated Successfully.')
                                    }
                                } else if (res == "error1") {
                                    alert('For This Email Already One User Exist.')
                                } else {
                                    alert('Somthing Went Wrong Try Again Later.')
                                }
                                window.location.href = "<? echo base_url() . "users/view" ?>";
                            }
                        });
                    }
                });

                $(document).on("click", ".edit_users", function() {
                    var user_id = $(this).attr('user_id');
                    $.ajax({
                        url: "<?php echo base_url("users/getUserDetails") ?>",
                        type: "post",
                        dataType: "json",
                        data: {
                            user_id: user_id
                        },
                        success: function(res) {
                            // console(res)
                            $.each(res, function(index, val) {
                                // alert(val['first_name'])
                                $("#record_id").val(val['id']);
                                $("#fname").val(val['first_name']);
                                $("#lname").val(val['last_name']);
                                $("#email").val(val['email']);
                                $("#mobile").val(val['mobile']);
                                $("#password").val(val['password']);
                                $("#cpassword").val(val['password']);
                                $("#myModal").modal('show');
                            })
                        }
                    });
                });

                $(document).on("click", ".delete_users", function() {
                    var user_id = $(this).attr('user_id');
                    var status = $(this).attr('status');
                    if (confirm("Are you sure?") == true) {
                        $.ajax({
                            url: "<?php echo base_url("users/deleteUser") ?>",
                            type: "post",
                            data: {
                                user_id: user_id,
                                status: status
                            },
                            success: function(res) {
                                // alert(res)
                                if (res == "success") {
                                    alert('Updated Successfully.')
                                } else {
                                    alert('Somthing Went Wrong Try Again Later.')
                                }
                                $("#myModal").modal('hide');
                                window.location.href = "<? echo base_url() . "users/view" ?>";
                            }
                        });
                    }
                });



            });

            function simpledatatable() {
                $(function() {
                    $("#users_datatable").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        // "buttons": ["excel", "pdf"]
                    });
                });
            }
        </script>
