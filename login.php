<?php include 'db.php'; 
  
  // Take user to dashboard if already logged in
  if(isset($_SESSION['is_loggedin'])) {
    _redirect('dashboard.php');
  }
  
  // Allow only post request
  if(is_post('login')) {
      
    // Process login
    $username = _post('username');
    $pass = _post('password');

    // Let's hash incoming password
    $password = md5($pass);
    
    // Get user from db using our custom find_one function
    $user = find_one('users', "where username = '{$username}' AND password = '{$password}' ");

    // Authenticate user
    if($username == $user->username) {
      // Let's create user custom sessions
      $_SESSION['user_logged_id'] = $user->id;
      $_SESSION['is_loggedin'] = true;

      // Take user to his/her dashboard
      _redirect('dashboard.php');
    } else {
      // Take user back to login and flash an error alert message
      _set_alert('e', 'Invalid login details. Try Again ');
      _redirect('login.php');
    }
  } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Account Creation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<div class="header clearfix">
  <nav>
    <ul class="nav nav-pills float-right">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="login.php">Login</a>
      </li>
    </ul>
  </nav>
  <h3 class="text-muted">logique9ja</h3>
</div>
<?php _get_flash_message('notice');?>
<div class="card">
  <form action="login.php" method="post" class="">
    <div class="card-body">
        <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" required="">
        </div>
    </div>
    <div class="card-footer clearfix">
      <p>Don't have an account? <a href="register.php">Register here</a></p>
        <p><button type="submit" name="login" class="btn btn-info float-right">Login</button></p>
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