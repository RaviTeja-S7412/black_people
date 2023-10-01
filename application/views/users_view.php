<?php
  $this->load->view('includes/header')
?>

<div class="content">
    <div class="search-bar">
      <form id="search-form" action="UserResult.html" method="GET">
      <button type="submit">Search</button>
    </div>




<h2 align="center"><centre>Request Listings</centre></h2>
  <table id="users_datatable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th><b>S.No</b></th>
            <th><b>User ID</b></th>
            <th><b>User Name</b></th>
            <th><b>Mobile</b></th>
            <th><b>Email</b></th>
            <!-- <th><b>Password</b></th> -->
            <th><b>Status</b></th>
            <th><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
    <?php 
    if(!empty($data)){
        $i =1;
        foreach($data as $d){?>
            <tr>
            `id`, ``, ``, ``, `email`, `password`, `station`, `created_date`, `role`, `status`
                <td><?php echo $i;?></td>
                <td><?php echo $d['id'];?></td>
                <td><?php echo $d['first_name']." ".$d['last_name'];?></td>
                <td><?php echo $d['mobile'];?></td>
                <td><?php echo $d['email'];?></td>
                <!-- <td><?php echo $d['password'];?></td> -->
                <td><?php if($d['status'] == 1){ echo "Active";}else{echo "Inactine";}?></td>
                <td> 
                    <i class="fa fa-edit edit_users" id="edit_users" user_id = <?php echo $d['id'];?> style="font-size:12px;color:#00FFFF"></i>
                    <?php 
                        if($d['status'] == 1){?>
                            <i class="fa fa-trash delete_users" id="delete_users" user_id = <?php echo $d['id'];?> status = <?php echo $d['status'];?> style="font-size:12px;color:#FF0000"></i>
                        <?php }else{?>
                            <i class="fa fa-check delete_users" id="delete_users" user_id = <?php echo $d['id'];?> status = <?php echo $d['status'];?>style="font-size:12px;color:#66CDAA"></i>
                        <?php }?>
                    <?PHP ?>
                </td>
            </tr>
        <?php
        $i++;}
    }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <th><b>S.No</b></th>
            <th><b>User ID</b></th>
            <th><b>User Name</b></th>
            <th><b>Email</b></th>
            <!-- <th><b>Password</b></th> -->
            <th><b>Status</b></th>
            <th><b>Action</b></th>
        </tr>
    </tfoot>
</table>


 

<script>
    $(document).ready(function(){
        simpledatatable();

        $(document).on("click", ".add_users", function(){
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


    });
    function simpledatatable(){
        $(function () {
            $("#users_datatable").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["excel", "pdf"]
            }).buttons().container().appendTo("#users_datatable_wrapper .col-md-6:eq(0)");
        });
    }
</script>

</body>
</html>

    
<?php
  $this->load->view('includes/footer')
?>