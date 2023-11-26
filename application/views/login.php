<!DOCTYPE html>
<html>
<head>

    
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Login Page</title>
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
    <h2><span style="color: red; font-family: Verdana, Geneva, Tahoma, sans-serif;">Login Page</span></h2>
    
    <form method="POST" id="loginUser">
        <div>
            <label for="username">Email:</label>
            <input type="text" id="email" name="email" style="width: 280px;" required="">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" style="width: 280px;" required="">
        </div>
        <div class="container">
            <input type="submit" value="Login" style="width: 100px; padding: 1;">
        </div>
        <div align="center">
            <a href="<? echo base_url('home/register') ?>">Register Here</a>
        </div>
        <div align="center">
            <a href="<? echo base_url('home/forgot') ?>">Forgot Password</a>
        </div>
    </form>
    
</body>


<script>
    $(document).ready(function(){
        $("#loginUser").submit(function(e){
        e.preventDefault();
        var fdata = $(this).serialize();
        $.ajax({
            "url": "<?php echo base_url("home/do_login") ?>",
            "type": "POST",
            "data" : fdata,
            "dataType": 'json',
            "success" : function(data){
            if(data.status == 200){
                // setTimeout(home, 3000); 
                window.location.href = "<?php echo base_url("home/dashboard")?>";
            }else{
                Swal.fire(
                'Error',
                data.message,
                'error'
                )
            }
            },
            "error" : function(data){
            console.log(data);
            }
        })
        })

    });
</script>
</html>
