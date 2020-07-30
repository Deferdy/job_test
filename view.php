<?php
  require 'admin/database.php';

  if(isset($_SESSION['name'])){
    header("Location: admin.php");
    exit;
  }

  if(!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
  }
     
  $db = Database::connect();
  $statement = $db->prepare("SELECT exercice.id, exercice.description, exercice.address, exercice.image, exercice.parametre , exercice.amenitie FROM exercice WHERE exercice.id = ?");
  $statement->execute(array($id));
  $item = $statement->fetch();
  Database::disconnect();

  function checkInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Application</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <b><ul class="nav navbar-nav">
            <li><a style="color: white " href="index.php"> Старт </a></li>   
          </ul></b>
        </div>
      </div>
    </div><br><br><br><br>
    <div class="container admin">
      <div class="row">
        <div class="col-sm-6">
          <h1><strong> Просмотр объекта</strong></h1><br>
          <form>
            <div class="form-group">
              <label>Описание :</label><?php echo '  '.$item['description'];?>
            </div>
            <div class="form-group">
              <label>Адрес:</label><?php echo '  '.$item['address'];?>
            </div>
            <div class="form-group">
              <label>Набор параметров:</label><?php echo '  '.$item['parametre'];?>
            </div>
            <div class="form-group">
              <label>Набор удобств:</label><?php echo '  '.$item['amenitie'];?>
            </div>
          </form> <br>
          <div class="form-actions">
            <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> выйти</a>
          </div>
        </div> <br><br><br><br><br>
        <div class="col-sm-6 site">
          <div class="thumbnail">
            <img src="<?php echo '../images/'.$item['image'];?>" >         
          </div>
        </div>
      </div>
    </div>   
  </body>
</html>

