<?php
  $this->load->view('includes/header')
?>

    <!-- page content starts -->
    <div class="page-content">
      <div class="header">Schedules <a class="float-right btn btn-primary btn-sm" href="<? echo base_url('dashboard/createSchedule') ?>">Create Schedule</a></div>
      <div class="" style="margin-top:20px;">
        <div class="table-responsive">
          <table id="example" class="display" style="width:100%;">
            <thead>
                <tr>
                    <th>Station</th>
                    <th>Employee</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
              <? $schedules = $this->db->order_by("id","desc")->get_where("tbl_schedules")->result(); 
                 foreach($schedules as $k => $u){
                  $edata = $this->db->get_where('tbl_users', ['role'=>'employee','id'=>$u->employee_id])->row();
              ?>
                <tr>
                    <td><? echo $u->station ?></td>
                    <td><? echo $edata->first_name." ".$edata->last_name ?></td>
                    <td><? echo $u->start_time ?></td>
                    <td><? echo $u->end_time ?></td>
                </tr>
              <? } ?>  
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!--  -->
    <!-- page content ends -->
    
<?php
  $this->load->view('includes/footer')
?>


<script>
  $(document).ready(function(){
    $("#example").dataTable();
  })
</script>