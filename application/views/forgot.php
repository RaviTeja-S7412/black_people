<!DOCTYPE html>
<html>

<head>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Forgot Password</title>
    <style>
        h2 {
            text-align: center;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('<? echo base_url('assets/images/') ?>login.jpeg');
            background-size: 1300px;
            padding: 20px;
        }

        form {
            max-width: 300px;
            margin: auto;
            margin-top: 50px;
            background-color: darkgray;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            opacity: 1;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #101315;
            color: #ffffff;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh;
        }
    </style>
</head>

<body>

    <div class="login-content forgot">
        <h2><span style="color: red; font-family: Verdana, Geneva, Tahoma, sans-serif;">Forgot Password</span></h2>
        <form method="POST" id="forgotUser">
            <div>
                <label for="email">Email address:</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="">
            </div>
            <div class="container">
                <input type="submit" value="Submit" style="width: 100px; padding: 1;">
            </div>
            <div align="center">
                <a href="<? echo base_url() ?>">Login</a>
            </div>
        </form>
    </div>    

    <div class="login-content change" style="display: none">
        <h2><span style="color: red; font-family: Verdana, Geneva, Tahoma, sans-serif;">Change Password</span></h2>
        <form method="post" id="changePass">
          <div class="form-group">
            <label for="email">Password:</label>
            <input type="password" name="password" class="form-control" id="email" placeholder="Enter password" required="">
          </div>
          <div class="form-group">
            <label for="email">Confirm Password:</label>
            <input type="password" name="cpassword" class="form-control" id="email" placeholder="Enter Confirm password" required="">
          </div>
          <input type="hidden" name="email" id="changeEmail" required>
          <div class="container">
                <input type="submit" value="Submit" style="width: 100px; padding: 1;">
            </div>
          <div align="center">
            <a href="<? echo base_url() ?>">Login</a>
          </div>
        </form>
      </div>

</body>


<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/js/bootstrap.min.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

<script>
    function otp() {
        $("#myModal").modal('show')
    }

    function login() {
        window.location.href = "<? echo base_url('home/login') ?>"
    }

    $("#changePass").submit(function(e) {
        e.preventDefault();
        var fdata = $(this).serialize();
        $.ajax({
            "url": "<?php echo base_url("home/updatePassword") ?>",
            "type": "POST",
            "data": fdata,
            "dataType": 'json',
            "success": function(data) {
                if (data.status == 200) {

                    Swal.fire(
                        'Success',
                        data.message,
                        'success'
                    )
                    setTimeout(login, 3000)

                } else {
                    Swal.fire(
                        'Error',
                        data.message,
                        'error'
                    )
                }
            },
            "error": function(data) {
                console.log(data);
            }
        })
    })
    $("#verifyOtp").submit(function(e) {
        e.preventDefault();
        var fdata = $(this).serialize();
        $.ajax({
            "url": "<?php echo base_url("home/confirmOtp") ?>",
            "type": "POST",
            "data": fdata,
            "dataType": 'json',
            "success": function(data) {
                if (data.status == 200) {

                    $("#changeEmail").val(data.email)
                    $("#myModal").modal('hide')

                    Swal.fire(
                        'Success',
                        data.message,
                        'success'
                    )
                    $(".forgot").hide();
                    $(".change").show();
                } else {
                    Swal.fire(
                        'Error',
                        data.message,
                        'error'
                    )
                }
            },
            "error": function(data) {
                console.log(data);
            }
        })
    })

    $(document).ready(function() {
        $("#forgotUser").submit(function(e) {
            e.preventDefault();
            var fdata = $(this).serialize();
            $.ajax({
                "url": "<?php echo base_url("home/sendOtp") ?>",
                "type": "POST",
                "data": fdata,
                "dataType": 'json',
                "success": function(data) {
                    if (data.status == 200) {

                        $("#user_id").val(data.email);
                        $("#changeEmail").val(data.email)
                        $(".forgot").hide();
                        $(".change").show();

                       
                        /*  setTimeout(otp, 3000); */
                    } else {
                        Swal.fire(
                            'Error',
                            data.message,
                            'error'
                        )
                    }
                },
                "error": function(data) {
                    console.log(data);
                }
            })
        })
    })
</script>

</html>