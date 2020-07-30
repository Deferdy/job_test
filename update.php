<?php
  session_start();
  require 'admin/database.php';

  if(!isset($_SESSION['name'])){
    $isSuccess = false ;
    header("Location: login.php");
    exit;
  } 
 
  if(!empty($_GET['id'])) {
    $id = checkInput($_GET['id']) ;
  }
     
  $imageError =  $amenitieError = $descriptionError = $addressError = $parametreError  = $description = $image = $address = $parametre =  $amenitie ="";
     $isSuccess = false;

  if(!empty($_POST)) 
    {
        $description               = checkInput($_POST['description']);
        $address              = checkInput($_POST['address']);
        $parametre               = checkInput($_POST['parametre']);
        $amenitie               = checkInput($_POST['amenitie']);
        // $image        = checkInput ($_FILES['image']['name']);
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
        
          $isimageUpdated = false;
        }


        else {
          $isUploadSuccess = true;

          if($imageExtension != 'jpg' && $imageExtension != 'png' && $imageExtension != 'jpeg' && $imageExtension != 'gif')
          {
            $imageError = " файл не валиден , не правильное расширение" ;
            $isUploadSuccess = false;
          }
          if(file_exists($imagePath)){
          $imageError = " Файл уже существует , меняйте название файла" ;
          $isUploadSuccess = false ;

          }
          if($_FILES['image']['size'] > 8000){
            $imageError = "файл не должен превышать 8КВ и расширение должно быть 'jpg' , 'jpeg' , 'png' или 'gif' ";
            $isUploadSuccess = false;
          }
           if ($isUploadSuccess){
            if (!move_uploaded_file($_FILES['image']['top name'], $imagePath)){
              $imageError =" ошибка при загрузке файла ";
              $isUploadSuccess =false;
            }
           }

        }
      
        if( $isSuccess && $imageUpdated && $isUploadSuccess or ($isSuccess && !$isimageUpdated)) 
        {
            $db = Database::connect();
            if($isimageUpdated) { 
            $statement = $db->prepare(" UPDATE exercice set description =? , address =?, parametre=?, amenitie =? , image =?  WHERE id=?");
            $statement->execute(array($description,$address,$parametre,$amenitie , $image , $id));

            }
            else {
              $statement = $db->prepare(" UPDATE exercice set description =? , address =?, parametre=?, amenitie =? WHERE id=?");
            $statement->execute(array($description,$address,$parametre,$amenitie, $id));


            }
        
            Database::disconnect();
            header("Location: admin.php");
            
        }


    }
  
    
    else{
        $db =Database::connect();
        $statement = $db->prepare("SELECT * FROM exercice WHERE id=?");
        $statement->execute(array($id));
        $item = $statement->fetch() ; 
        $description = $item['description'];
        $address =$item['address'];
        $parametre  =$item['parametre'];   
        $amenitie=$item['amenitie'];
        $image  =$item['image'];
        Database::disconnect();
    }

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
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
          <b><ul class="nav navbar-nav">
            <li><a style="color: white "  href="admin.php">Кабинет администрации</a></li>
            <li><a style="color: white " href="insert.php"> Наполнение базы данных </a></li>
            <li><a style="color: white" href="index.php">Выход из профиля админа </a></li>     
          </ul></b>
        </div>
      </div>
    </div><br>
    <div id="view">
      <div class="previeww"><br><br>    
        <div class='col-sm-6' style='padding-left: 80px;'>
          <h4 style="margin-bottom: 25px;"> <strong> Отредактирование объекта </strong></h4>
          <form class="form" role="form"  action="<?php echo 'update.php?id='.$id ;?>" method="POST" >
            <p> <strong> Описание  :</strong><br><textarea name='description' type='text' cols='30' rows='3'   placeholder="Описание"><?php echo $description; ?></textarea>
            <span class="help-inline" style="color: red"><?php echo $descriptionError;?></span></p>
            <p><strong>Адресс :</strong><br><input name='address' type='text' size='27' maxlength='125' value="<?php echo $address; ?>"  placeholder="Адрес">
            <span class="help-inline" style="color: red"><?php echo $addressError;?></span></p>
            <p><strong>Набор параметров:</strong><br /> <textarea name='parametre' id='text' cols='30' rows='3' placeholder="Набор параметров" ><?php echo $parametre; ?></textarea>
            <span class="help-inline" style="color: red"><?php echo $parametreError;?></span></p>
            <p><strong> Набор удобств  :</strong><br><textarea name='amenitie' type='text' cols='30' rows='3'   placeholder="Набор удобств"><?php echo $amenitie; ?></textarea>
            <span class="help-inline" style="color: red"><?php echo $amenitieError;?></span></p>
            <p><strong>Фотография : </strong><br><?php echo $image;?><input type="file" name="image" id="image" />
            <span class="help-inline" style="color: red"><?php echo $imageError;?></span></p>   
            <p> <p> <input type='submit' class ="btn btn-success" name='submit' id='submit' value='Отредактировать объект'></p> </p>
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-6 site">
      <div class="thumbnail">
        <img src="<?php echo '../images/'.$image;?>" >
      </div>
    </div>
  </body>
</html>

 
