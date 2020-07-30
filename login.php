<?php
  session_start();
  require('admin/database.php');
  $db = Database::connect();

  if (isset ($_SESSION['name'])){
    header("Location: admin.php");
    exit;
  }
  
  $req = $db->query('SELECT * FROM admin');
  $data = $req->fetch(); 
  $Error = "" ;

  if(!empty($_POST)) {
    $name      = checkInput($_POST['name']);
    $password  = checkInput($_POST['password']);   
  }

  if (isset($name) AND isset($password)){
    $_SESSION['name'] = $data['name'];
    $_SESSION['password'] =$data['password'];

    if( $name== $_SESSION['name'] && $password== $_SESSION['password'])  {  
     
      header("Location: admin.php");
      exit;
  } else if ($name != $_SESSION['name'] && $password != $_SESSION['password'){
      $Error ="Ошибка о Введенных доступах";
      echo $Error ;
    } else{  
        $Error ="Введенные данные не верные!";
        echo $Error ;
      }
  }

  function checkInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Application </title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </head>
  <body>  
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <b> <ul class="nav navbar-nav">
            <li><a style="color: white" href="index.php"> Старт</a></li>
          </ul></b>
        </div>
      </div>
    </div><br></br><br></br>
    <section>
      <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
              <div class="signup-form">
                 <center>   <p style="padding-top: 45px"><h3> Администрация</h3> </p>  
                    <form class="form-inline" action="login.php" method="post" style="margin-top: 25px"> 
                      <P><label class="sr-only" for="inlineFormInput"></label></P>
                      <P><input type="text" name="name" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" value="" placeholder="Логин"></P>
                      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <input type="password" name="password" class="form-control" id="inlineFormInputGroup" value="" placeholder="Пароль">
                      </div><br></br>
                      <input type="submit" name="submit" class="btn btn-primary btn-lg" value="войти"/>
                    </form> 
                    <b><span style="color: red"><?php echo $Error; ?></span></b>
                  </center>
                </div><br/><br/>
              </div>
            </div>
          </div>
    </section>

  </body>
</html>