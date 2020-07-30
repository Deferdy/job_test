<?php
  session_start();
  require 'admin/database.php';
  if(!isset($_SESSION['name'])){
    $isSuccess = false ;
    header("Location: login.php");
    exit;
  }
    
  $imageError = $amenitieError = $amenitie = $descriptionError = $addressError = $parametreError = $image = $description = $address = $parametre = $message = " ";

  if(!empty($_POST)) {

      $description           = checkInput($_POST['description']);
      $address              = checkInput($_POST['address']);
      $parametre             = checkInput($_POST['parametre']);
      $amenitie                = checkInput($_POST['amenitie']);
      $image        = checkInput ($_FILES['image']['name']);
      $imagePath    = 'images/' . basename($image);
      $imageExtension = pathinfo($imagePath,PATHINFO_EXTENSION);
      $isSuccess          = true;
      $isUploadSuccess = false;

      if(empty($description)) 
      {
          $descriptionError = 'заполните поле';
          $isSuccess = false;
      }

      if(empty($address)) 
      {
          $addressError = 'заполните поле';
          $isSuccess = false;
          
          
      } 

       if(empty($parametre)) 
      {
          $parametreError = 'заполните поле';
          $isSuccess = false;
                  
      } 

       if(empty($amenitie)) 
      {
          $amenitieError = 'заполните поле';
          $isSuccess = false;        
          
      } 

      if(empty($image))
      {
        $imageError ='добавьте файл';
        $isSuccess = false;
      }


      else {
        $isUploadSuccess = true;

        if($imageExtension != 'jpg' && $imageExtension != 'png' && $imageExtension != 'jpeg' && $imageExtension != 'gif')
        {
          $imageError = " файл не валиден , не правильное расширение" ;
          $isUploadSuccess = false;
        }
        if(file_exists($imagePath)){
        $imageError = "Файл уже существует либо меняйте название файла" ;
        $isUploadSuccess = false ;

        }
        if($_FILES['image']['size'] > 8000){
          $imageError = "файл не должен превышать 8КВ и расширение должно быть 'jpg' , 'jpeg' , 'png' или 'gif' ";
          $isUploadSuccess = false;
        }
       
      }
    
    
      if($isSuccess && $isUploadSuccess ) 
      {
          $db = Database::connect();
          $statement = $db->prepare(" INSERT INTO exercice (description,address,parametre,amenitie , image ) values(?, ?, ? ,?,?)");
          $statement->execute(array($description, $address, $parametre , $amenitie , $image));
          Database::disconnect();
          header("Location: admin.php");
       
      }
  }


  function checkInput($data) 
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    $data = htmlentities($data);
    return $data;
  }
?>


<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Cabinet </title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </head>
  <body>
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
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
          <li><a style="color: white "  href="admin.php">Кабинет администрации</a></li>
          <li><a style="color: white" href="index.php">Выход из профиля админа </a></li>         
        </ul></b>
      </div>
    </div>
  </div><br></br><br>         
  <div id="view"></div>
    <div class="previeww">
      <div class='add' style='padding-left: 80px;'>
        <h4 style="margin-bottom: 25px;"><strong> Наполнение базы данных </strong> </h4>
        <form class="form" role="form"  action="insert.php" method="POST" enctype= multipart/form-data >
          <p><strong> Описание  :</strong><br><textarea name='description' type='text' cols='30' rows='3'  placeholder="Описание"><?php echo $description; ?></textarea>
          <span class="help-inline" style="color: red"><?php echo $descriptionError ;?></span></p>
          <p><strong>Адресс :</strong><br><input name='address' type='text' size='28' maxlength='125' value="<?php echo $address; ?>"  placeholder="Адрес">
          <span class="help-inline" style="color: red"><?php echo $addressError;?></span></p>
          <p><strong>Набор параметров:</strong><br /> <textarea name='parametre' id='text' cols='30' rows='3' placeholder="Набор параметров" ><?php echo $parametre; ?></textarea>
          <span class="help-inline" style="color: red"><?php echo $parametreError;?></span></p>
          <p><strong> Набор удобств  :</strong><br><textarea name='amenitie' type='text' cols='30' rows='3'   placeholder="Набор удобств"><?php echo $amenitie; ?></textarea>
          <span class="help-inline" style="color: red"><?php echo $amenitieError;?></span></p>
          <p><strong>Фотография : </strong><input type="file" name="image" id="image" >
          <span class="help-inline" style="color: red"><?php echo $imageError;?></span></p>
          <p> <input type='submit' class="btn btn-success" name='submit' id='submit' value='Наполнить базу данных'>
          <span class="help-inline" style="color: green"><?php echo $message;?></span></p>
        </form>
     </div>
    </div>
  </body>
</html>

 
