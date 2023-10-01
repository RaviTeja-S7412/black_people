<?php
  $this->load->view('includes/header')
?>

    <!-- page content starts -->
    <div class="page-content">
      <div class="header">Create Schedule </div>
      <div class="" style="margin-top:20px;overflow: auto">
        <div class="row mb-2">
          <div class="col-md-4">
            <label>Station</label>
            <select class="form-control" id="station">
              <option value="">Select Station</option>
              <option value="Mooyah">Mooyah</option>
              <option value="Dining">Dining</option>
              <option value="Zen">Zen</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Employees</label>
            <select class="form-control" id="employees">
              <option value="">Select Employee</option>
              <? $users = $this->db->order_by("id","desc")->get_where("tbl_users", ["role"=>"employee", "status"=>"Active"])->result(); 
                 foreach($users as $k => $u){
              ?>
                <option value="<? echo $u->id ?>"><? echo $u->first_name." ".$u->last_name ?></option>
              <? } ?>  
            </select>
          </div>
        </div>
        <div id='calendar'></div>
      </div>
    </div>
    <!--  -->
    <!-- page content ends -->

    
<?php
  $this->load->view('includes/footer')
?>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<? 

  $sdata = [];                
  $schedules = $this->db->get_where("tbl_schedules")->result(); 
  foreach($schedules as $s){
    $edata = $this->db->get_where('tbl_users', ['role'=>'employee','id'=>$s->employee_id])->row();
    $sdata[] = [
      "title" => $edata->first_name." ".$edata->last_name,
      "start" => $s->start_time,
      "end" => $s->end_time
    ];
  }

?>

<script>

  function convert(str) {
    var date = new Date(str),
    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
    day = ("0" + date.getDate()).slice(-2);
    return [date.getFullYear(), mnth, day].join("-");
  }

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: { center: 'dayGridMonth,timeGridWeek,listWeek' },
      initialView: 'timeGridWeek',
      selectable: true,
      slotDuration: {
        "hours": 1
      },
      select: function(info) {

        var stime = new Date(info.start);
        var etime = new Date(info.end);

        var start_time = convert(stime)+" "+stime.toString().split(" ")[4];
        var end_time = convert(etime)+" "+etime.toString().split(" ")[4];

        addSchedule(start_time, end_time);
        /* calendar.addEvent({
          "title": "Demo event",
          start: info.start,
          end: info.end
        }); */

      },
      // dateClick: function() {
      //   alert('a day has been clicked!');
      // },
      events: <? echo json_encode($sdata) ?>
    });
    calendar.render();
  });

  function addSchedule(start_time, end_time){
    var station = $("#station").val();
    var employees = $("#employees").val();

    if(station == ""){
      Swal.fire(
          'Error',
          'Please Select Station',
          'error'
      )
      return false;
    }

    if(employees == ""){
      Swal.fire(
          'Error',
          'Please Select Employee',
          'error'
      )
      return false;
    }

    $.ajax({
      method: 'post',
      url: "<? echo base_url('dashboard/insertSchedule') ?>",
      data: {'station': station, "employee_id": employees, 'start_time': start_time, 'end_time': end_time},
      dataType:'json',
      success: function(data){
        if(data.status){
          Swal.fire(
            'Success',
            data.msg,
            'success'
          )
          setTimeout(() => {
            window.location.reload();
          }, 3000);
        }else{
          Swal.fire(
            'Error',
            data.msg,
            'error'
          )
        }
      },
      error: function(){
        
      }
    })

  }

</script>