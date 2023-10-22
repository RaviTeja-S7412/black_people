<?php
$this->load->view('includes/header')
?>

<style>
  body {
    font-family: Arial, sans-serif;
  }

  header {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
  }

  .container {
    margin: 0px 0px;
    max-width: 1200px;
    padding: 10px;
    background-color: #f5f5f5;
  }

  .content {
    margin-top: 20px;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .form-group label {
    display: block;
    font-size: 18px;
    margin-bottom: 10px;
    color: #333;
    font-weight: bold;
  }

  .form-group input[type="file"] {
    display: block;
    padding: 10px;
    font-size: 16px;
    width: 100%;
  }

  .form-group button {
    background-color: maroon;
    color: #fff;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }

  .success-message {
    color: green;
    font-weight: bold;
    margin-top: 10px;
  }

  .error-message {
    color: red;
    font-weight: bold;
    margin-top: 10px;
  }

  #file-list {
    margin-top: 20px;
  }

  #file-list h2 {
    font-size: 18px;
    margin-bottom: 10px;
  }

  #files {
    list-style-type: none;
    padding: 0;
    min-height: 215px;
  }

  #files li {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ccc;
    margin-bottom: 5px;
  }

  #files li button {
    background-color: maroon;
    color: #fff;
    padding: 5px 10px;
    font-size: 14px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }
</style>
<div class="content">
  <h1>Uploaded Files</h1>
  <div id="message-container">
    <? if ($this->session->flashdata('success')) {
      echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
    } elseif ($this->session->flashdata('error')) {
      echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
    } ?>
  </div>
  <form id="upload-form" action="<? echo base_url('dashboard/upload_files') ?>" method="post" enctype="multipart/form-data">
    <div class="row" style="width: 99%;">
      <div class="col-md-3">
        <div class="form-group">
          <label for="file">Title:</label>
          <input type="text" class="form-control" name="title" required>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="file">Select a file:</label>
          <input type="file" id="file" name="file" accept=".pdf, .txt" required>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="file">Author:</label>
          <input type="text" class="form-control" name="author" required>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="file">Published Year:</label>
          <input type="number" class="form-control" name="year" required>
        </div>
      </div>
    </div>
    <div class="form-group" style="width: 100px;">
      <button type="submit">Upload</button>
    </div>
  </form>

  <div id="file-list">
    <h2>Files:</h2>
    <ul id="files">
      <?

        if($this->session->userdata("role") == "employee"){
          $this->db->where("created_by", $this->session->userdata("user_id"));
        }
        $pdfs = $this->db->order_by("id","desc")->get_where("tbl_pdfs")->result();
        foreach ($pdfs as $pdf) {
          $udata = $this->db->get_where("tbl_users",["id"=>$pdf->created_by])->row();
          echo '<li id="file-item-1" style="width:99%">' . $pdf->file_name .' ('.$udata->first_name. ' ' .$udata->last_name.') <button onclick="archiveFunction('.$pdf->id.')">Delete</button></li>';
        }

      ?>
    </ul>
  </div>

  <?php
  $this->load->view('includes/footer')
  ?>

  <script>
    function archiveFunction(id) {

      Swal.fire({
        title: 'Do you want to delete the pdf?',
        showDenyButton: true,
        // showCancelButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: `No`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire('PDF Deleted Successfully', '', 'success')
          $.ajax({
            method: 'POST',
            data: {
              'id': id
            },
            url: '<?php echo base_url() ?>dashboard/deletePdf/' + id,
            success: function(data) {
              console.log(data);
              location.reload();
            }
          });
        } else if (result.isDenied) {
          Swal.fire('Your Selected pdf is safe :)', '', 'info')
        }
      })

    }
  </script>