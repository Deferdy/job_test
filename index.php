<?php 
  session_start();
  if(isset($_SESSION['name'])){
    header("Location: admin.php");
    exit;
  }
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" >
    <meta name="author" content="">
    <meta name="description" content="">
    <title>Application</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <b><ul class="nav navbar-nav">
            <li><a style="color: white" href="login.php"> Вход админа </a></li>     
          </ul></b>
        </div>
      </div>
    </div><br><br><br><br><br><br><br><br> 
    <div class="container">
      <center>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th width='100'>Объект недвижимости</th>
              <th width="100">Просмотр</th>
            </tr>
          </thead>
          <tbody>     
            <?php                                     
              // connect to database
                require('admin/database.php');
                $db = Database::connect();
              // define how many results you want per page    
              $results_per_page = 3;
              // find out the number of results stored in database  
              $result =$db->query('SELECT * FROM exercice ');

              $number_of_results = $result -> rowCount(); 
              // determine number of total pages available
              $number_of_pages = ceil($number_of_results/$results_per_page); 
              // determine which page number visitor is currently on
              if (!isset($_GET['page'])) {
                $page = 1;
              } else {
                $page = $_GET['page'];
              }
              // determine the sql LIMIT starting number for the results on the displaying page
              $this_page_first_result = ($page-1)*$results_per_page;
              // retrieve selected results from database and display them on page
              //$sql='SELECT * FROM information LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
              $sql = 'SELECT * FROM exercice ORDER BY exercice.id DESC  LIMIT ' . $this_page_first_result . ',' .  $results_per_page ;
              $result = $db ->query ($sql);       
              while($data = $result-> fetch()) {
                echo  '<tr>';
                echo  '<td> <img src="images/'. $data['image'] . '" ></td>';
                echo '<td width="100">';
                echo '<a class="btn btn-primary btn-sm" href="view.php?id='.$data['id'].'"><span class="glyphicon glyphicon-eye-open btn-xs"></span> просмотр</a>';
                echo'</td>';
                echo '</tr>';
              }    
            ?>
          </tbody>
        </table><br><br><br>
        <?php
            // display the links to the pages
          for ($page=1;$page<=$number_of_pages;$page++) {
            echo '<a href="index.php?page=' .  $page  . '">'.'<span class="active" >' .  $page .'</span>&nbsp;&nbsp;&nbsp;' . '</a> ';
          }
        ?>
      </center>
    </div><br><br><br><br><br><br><br>   
  </body>
</html>











