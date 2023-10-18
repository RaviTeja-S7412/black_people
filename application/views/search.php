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

  .loader {
    width: 100px;
    height: 100px;
    border-radius: 100%;
    position: relative;
    margin: 0 auto;
  }

  /* LOADER 1 */

  #loader-1:before,
  #loader-1:after {
    content: "";
    position: absolute;
    top: -10px;
    left: -10px;
    width: 100%;
    height: 100%;
    border-radius: 100%;
    border: 10px solid transparent;
    border-top-color: #3498db;
  }

  #loader-1:before {
    z-index: 100;
    animation: spin 1s infinite;
  }

  #loader-1:after {
    border: 10px solid #ccc;
  }

  @keyframes spin {
    0% {
      -webkit-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
</style>

<div class="content">
  <div class="search-bar">
    <form method="post" id="searchPdf">
      <input id="search" type="text" name="search" placeholder="Search..." required>
      <button id="search-button" type="submit">Search</button>

      <div class="dropdown">
        <button type="submit">Sort By</button>
        <div class="dropdown-content">
          <a href="javascript:void(0)" class="filter" sort_by="year">Year</a>
          <a href="javascript:void(0)" class="filter" sort_by="author">Author</a>
        </div>
      </div>
    </form>
    <h1>Search Results<span class="pull-right m-4 resultCount" style="font-size: 18px;"></span></h1>

    <div class="result">
    </div>

  </div>
</div>

<?php
$this->load->view('includes/footer')
?>

<script>
  $(".filter").click(function() {
    var sort_by = $(this).attr('sort_by');
    var fdata = {
      "search": $("#search").val(),
      "sort_by": sort_by
    };
    search(fdata);
  })

  function search(fdata) {
    $.ajax({
      method: 'post',
      url: "<? echo base_url('home/getPdfdata') ?>",
      data: fdata,
      dataType: 'json',
      beforeSend: function() {
        $(".result").html('<div class="bg" align="center" style="margin-top: 50px;"><div class="loader" id="loader-1"></div></div>')
      },
      success: function(data) {

        var text = '';
        if (data.length > 0) {
          var rText = data.length == 1 ? 'result' : 'results';
          $(".resultCount").html(data.length + ' ' + rText + ' found')
          data.map((t) => {
            var url = '<? echo base_url() ?>' + t.pdf_file + '';
            var wText = t.word_count == 1 ? 'word' : 'words';
            text += '<div class="result-container"><div class="link-container"><a href="' + url + '" target="_blank">' + t.file_name + '</a><a href="' + url + '" target="_blank" download style=""><i class="fa fa-download" style="font-size: 20px; padding: 0px;"></i></a><span class="pull-right m-4">' + t.word_count + ' ' + wText + ' found</span><br><span class="" style="font-style: italic;margin-left: 20px;">' + t.author + ' - ' + t.year + '</span></div><div class="description-container">' + t.text + '</div></div>';
          })
        } else {
          text += '<p>No Matches Found</p>';
        }
        $('.result').html(text);

      },
      error: function(data) {
        console.log(data);
      }
    })
  }

  $("#searchPdf").submit(function(e) {
    e.preventDefault();
    var fdata = {
      "search": $("#search").val()
    };
    search(fdata)
  })
</script>