<?
  require "config.php";

  try {
      //$dbh = new PDO("odbc:poni32_test1", $msdb_User, $msdb_Pass);// тестовая база test_26_11_2019_9h
      $dbh = new PDO("odbc:poni32", $msdb_User, $msdb_Pass);
      $dbh->exec('SET CHARACTER SET utf8');
      } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        }
    
    
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );  
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );  
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );    

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ru">

  <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Kolegov Dmitriy"> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 

<!-- ------------ CSS ---------------- -->
<!-- <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" type="text/css" href="css/works.css">
<!-- --------------------------------- -->

<!-- -------------- js --------------- -->    
<!-- <script type="text/javascript" src="js/bootstrap.min.js"></script>   -->
<!-- <script src='js/jquery-3.4.1.js'></script>  -->
<!-- --------------------------------  -->

<!-- <link rel="stylesheet" type="text/css" href="css/jquery-ui.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.css"> -->

<!-- <link rel="stylesheet" type="text/css" href="css/my.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="css/jquery.mobile.icons.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="css/jquery.mobile.structure-1.4.5.min.css"> -->

<!-- <script src="js/jquery-ui.js"></script>  -->
<!-- <script src = "js/jquery-1.11.1.min.js"> </ script>-->
<!-- <script src = "js/jquery.mobile-1.4.5.min.js"> </ script>  -->

<!-- с документации -->
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Графики</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" src="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" src="css/Style.css">
 
  

<!-- -------------- -->
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="js/grafikizakaz.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion();
     active: true;
    //  collapsible: true;
  } );
  </script>



  </head>

  <body >   

    <?
       // ------ блок ввода заказа ------
       echo "<div class='block-inp '><h2>Введите номер заказа</h2>";
       echo '<div ><input type="number" class=" inp-zakaz" min = "0" max = "1000000">';  
       echo "<button type='button' class='btn-zakaz ' onclick='getzakaz()'>Ввести</button></div></div>";

       // -------------------------------

       // ------- Блок вывода -----------
      echo '<div class="output-block"></div>';
       // -------------------------------

     
  ?>
 
  </body>
</html>