<?php
  include 'db.php';

  // Take user to dashboard if already loggedin
  if(isset($_SESSION['is_loggedin'])) {
    _redirect('dashboard.php');
  }

  if(isset($_POST['register'])) {
    $fullname = trim($_POST['fullname']);
    $usertype = trim($_POST['type']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password_1 = trim($_POST['password_1']);
    $password_2 = trim($_POST['password_2']);

    // Check password match
    if($password_1 != $password_2) {
      _set_alert('e', "Passwords didn't matched");
      _redirect('register.php');
    }

    // hashed password
    $password = md5($password_1);

    // Check existing users by username and email address
    $check_existing = $con->query("SELECT * from users where username = '{$username}'");

    if($check_existing->num_rows > 0) {
      _set_alert('e', 'Username already registered');
      _redirect('register.php');
    }


    // If user donot exist, continue with insert
    $sql = "INSERT INTO users (full_name, user_type, username,email,password) VALUES ('$fullname', '$usertype','$username','$email','$password')";

   if($con->query($sql) === True) {
      _set_alert('s', 'Registration was successful. Login now');
      _redirect('login.php');
    } else {
      _set_alert('e', 'Failed to register you. Try Again! <b>Reasons:</b> ' . $con->error);
      _redirect('register.php');
    }

    $con->close();

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<div class="header clearfix">
  <nav>
    <ul class="nav nav-pills float-right">
    	<li class="nav-item">
        <a class="nav-link " href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="register.php">Register <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
    </ul>
  </nav>
  <h3 class="text-muted">logiqueCode</h3>
</div>
<?=_get_flash_message('notice')?>
<div class="card">
  <form action="register.php" method="post" class="">
    <div class="card-body">
        <div class="form-group">
            <label for="">Full Name</label>
            <input type="text" name="fullname" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="">user_type</label>
            <select name="type" id="" class="form-control">
              <option value="">select type...</option>
              <option value="Admin">Admin</option>
              <option value="Member">Member</option>
            </select>

        <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password_1" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="">Confirm Password</label>
            <input type="password" name="password_2" class="form-control" required="">
        </div>
    </div>
    <div class="card-footer clearfix">
      <p>Already a member? <a href="login.php">Login here</a></p>
        <p><button type="submit" name="register" class="btn btn-info float-right">Register</button></p>
    </div>
  </form>
</div>


<footer class="footer">
  <p>&copy; logique9ja <?=date('Y')?></p>
</footer>

</div> <!-- /container -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>