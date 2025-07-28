<?php

    include 'connection.php';

    $id = $_GET['updateid'];

     $sql = "select * from `crudapp`.`users` where id=$id"; 
     $result = mysqli_query($connect, $sql);

     $row = mysqli_fetch_assoc($result);

     $username = $row ['username'];
     $email = $row ['email'];
     $password = $row ['password'];


    if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "update `crudapp`.`users` set
    username = '$username', 
    email = '$email', 
    password = '$password'
    where `users`.`id` = $id"; 

    $result = mysqli_query($connect, $sql);

    if($result){

      echo " <script> 
               alert('Update form has been submited');
               window.location.href = 'display.php'      
             </script
      ";


        // header('location: update.php');
    }else{
        die(mysqli_connect_error($connect));
    }

    mysqli_close($connect);

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Curd App</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #2980b9, #6dd5fa);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-container {
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      width: 350px;
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
      background: #f0f0f0;
    }
    button {
      width: 100%;
      padding: 12px;
      background: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover {
      background: #2980b9;
    }

    .error-message {
    color: red;
    font-size: 0.9em;
    margin-top: 2px;
    display: block;
  }

  input.invalid {
    border: 2px solid red;
  }
  </style>
</head>
<body>

   

<div class="form-container">
  <h2>Create Update Account</h2>
  <form id="registerForm" method="POST" onsubmit="return validateForm()">
    <label>Username</label>
    <input type="text" name="username" id="username" placeholder="Username" value="<?php echo $username?>">
    <span class="error-message" id="username-error"></span>

    <label>Email</label>
    <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $email?>">
    <span class="error-message" id="email-error"></span>

    <label>Password</label>
    <input type="password" name="password" id="password" placeholder="Password" value="<?php echo $password?>">
    <span class="error-message" id="password-error"></span>

    <button type="submit" name="submit">Update</button>
  </form>
</div>


</body>

<script>
  function validateForm() {
    let isValid = true;

    // Clear previous errors
    const fields = ['username', 'email', 'password'];
    fields.forEach(field => {
      document.getElementById(field).classList.remove('invalid');
      document.getElementById(field + '-error').textContent = '';
    });

    // Validate each field
    fields.forEach(field => {
      const input = document.getElementById(field);
      if (input.value.trim() === '') {
        input.classList.add('invalid');
        document.getElementById(field + '-error').textContent = 'This field is required';
        isValid = false;
      }
    });

    return isValid; // prevent form submission if false
  }
</script>

</html>
