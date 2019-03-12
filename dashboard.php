<?php include 'db.php'; 

  if(!isset($_SESSION['is_loggedin'])) {
  	_set_alert('e', "Register new account or login to your existing account.");
  	_redirect('login.php');
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<div class="header clearfix">
  <nav>
    <ul class="nav nav-pills float-right">
      <li class="nav-item">
        <a class="nav-link active" href="logout.php">Logout <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </nav>
  <h3 class="text-muted">logique9ja</h3>
</div>

<?php 
	_get_flash_message('notice');
	$user = find_one('users', ['id', $_SESSION['user_logged_id']]);
?>
<div class="alert alert-info">Welcome <b><?=$user->username?></b>, this is your dashboard.</div>
<div class="card">

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