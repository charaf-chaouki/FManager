<?php
     require_once('config.php');
     require_once('autoload.php');
  
     if(!isset($_SESSION))
     {
         session_start();
     }

     if(isset($_SESSION['fm_logged']))
     {
        header('location: index.php');
     }

     if(isset($_POST['username']))
     {
          if(Auth::login($_POST['username'], $_POST['password']))
          {
             header('location: index.php');
          }
          else
          {
                $error = "Your username or password is invalid";
          }
     }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>FM - Authentification</title>

        <!-- Favicon -->
        <link rel="icon" href="assets/img/logo.png">

        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.1/css/bootstrap.min.css" integrity="sha512-siwe/oXMhSjGCwLn+scraPOWrJxHlUgMBMZXdPe2Tnk3I0x3ESCoLz7WZ5NTH6SZrywMY+PB1cjyqJ5jAluCOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- JQUERY CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.1/js/bootstrap.min.js"></script>

        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/main.css">

        <!-- Main js -->
        <script src="assets/js/main.js"></script>
    </head>
    <body>
        <form action="" method="post">
        <div class="d-flex justify-content-center mt-4">
            <div class="login-container">
                <div class="logo-container">
                    <img src="assets/img/logo.png">
                </div>
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger p-2">
                        <?php echo $error ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                     <input type="text" name="username" class="form-control" placeholder="Email">
                </div>
                <div class="form-group mt-3">
                     <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <button class="btn btn-success login-btn">Sign in</button>
            </div>
        </div>
        </form>
    </body>
</html>