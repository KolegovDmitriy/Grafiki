

//99999999999999999999999999999999999999999999999

// $newArr[$u[0]][] = $u[1]; 
                //  $newArr = array($u[0]=>"Значение","первый"=>"Значение");


                 
                //  [$u[0]][] = $u[1]; 
                 
                 //$newArr[] = $u[0];  



      //  echo "<pre>";
      //  print_r ($u);
      //  echo "</pre>";
                // echo "<br>u0".$u[0];
                // echo "<br>u1".$u[1];



      //  for ($r=0;$r<60;$r++){ 
  
      //   if($newArr[$r-1][0] != $newArr[$r][0])  echo $newArr[$r+1][0]."<br>";
      
      //   echo $r."--".$newArr[$r][1]."<br>";
      // }

// echo $newArr[1][0]."<br>";
// echo $newArr[1][1];
// echo "<br>=================<br>";
      //  echo "<pre>";
      //  print_r ($newArr);    
      //  echo "</pre>";

      // $tt = $newArr;

       
      // foreach ($newArr as $key => $value) 
      // $newArr[iconv('windows-1251', 'UTF-8', $key)] = iconv('windows-1251', 'UTF-8', $value);




        // echo "<br>-----------------------------<br>";
        // echo $arrayPosition[1]."<br>";
        // echo $arrayPosition[2]."<br>";
        // print_r($arrayPosition);
        // $count_arrayPosition = count($arrayPosition);
        // echo "<br>кол-во элементов".$count_arrayPosition;
        // echo "<br>-----------------------------";




    //    echo '<div id="accordion">';// ==================================  

    //     for ($i = 0; $i < $count_arrayPosition; $i++){         
    //       echo "<h3 class='myh2'>".$arrayPosition[$i]."</h3>";
          
    //       echo "<div>"; 

    //       while($b = $sth->fetch()) {   
    //         foreach ($b as $key => $value) 
    //           $b[iconv('windows-1251', 'UTF-8', $key)] = iconv('windows-1251', 'UTF-8', $value);                   
    //           // if($b[Position] == $arrayPosition[$i]) echo "<p>". $b['Название']."</p><br>";  
    //           var_dump($b[Position]);
    //       }       
    //       echo "</div>";
          
    //     }//for ($i = 0; $i <= $count_arrayPosition; $i++)  
    //    echo '</div>'; // echo '<div id="accordion">'; // ===============




     }//  if ($sth->rowCount() == 0) {



     // для разработки параметры заданы
  $sql = iconv('UTF-8', 'windows-1251', "Select dbo._шаблоны_GET_НомерЗаказа(ds.Ключ) as Position ,i.Название
  --,dog.Номер,ds.Ключ ,time_beg,op.time_end,comment,qty_made,op.group_id,op.sale_id,op.npp,op.parent
  --, op.* 
  From Догспец AS ds With (NoLock)
  Left JOIN Договор As dog With (NoLock) On ds.Договор=dog.Ключ
  Left JOIN _operation As op With (NoLock) On op.sale_id=ds.Ключ
  Left JOIN _inf_workname As i With (NoLock) On op.operation_KEY=i.Номер
  
  
  Where dog.Номер='111335' and dog.Вид=101 and dog.[Юр.лицо]=1 
  and op.enable=1
  order by sale_id,npp ");
                    
  $sth   =   $dbh->query($sql);


  echo '<div id="accordion">';

  while($u = $sth->fetch()) {  
    foreach ($u as $key => $value) 
    $u[iconv('windows-1251', 'UTF-8', $key)]=iconv('windows-1251', 'UTF-8', $value);
    //echo $u['Position'].$u['Название'].$u['']."<br>";

  if ($u[Position]!=$dk) {
    // Разделитель оборудования
    if ($dk>0) { ?> <br clear="all" /> <? }
   
    ?>

    <h3 class='myh2'><? echo $u['Position']; ?></h3>

    <?
      //$dk=$u[device_key];
      //echo " <div><p>".$u['Название']."</p><br></div>";

  }
}

  echo '<div>';

//99999999999999999999999999999999999999999999999






















echo '<div id="accordion">';// ==================================
   
   $Positin_last = 0;

   while($u = $sth->fetch()) {  
     foreach ($u as $key => $value) 
     $u[iconv('windows-1251', 'UTF-8', $key)] = iconv('windows-1251', 'UTF-8', $value);
   

    if ($Positin_last != $u[Position])  echo "<h3 class='myh2'>".$u[Position]."</h3><div> "; ?>
     
     
     <?
        if ($Positin_last == $u[Position]) echo "<br>".$u['Название'].$u['']."<br> ";    

        //echo "</div>";       
        $Positin_last = $u[Position];
    
    }

     echo '</div>'; // echo '<div id="accordion">'; // =========================














// --------------------- Шаблон аккардиона -------------
//  echo '<div id="accordion">
//  <h3>Section 1</h3>
//  <div>
//    <p>Mauris mauris ante, blandit et, ultrices a, suscipit eget.
//    Integer ut neque. Vivamus nisi metus, molestie vel, gravida in,
//    condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros.
//    Nam mi. Proin viverra leo ut odio.</p>
//  </div>
//  <h3>Section 2</h3>
//  <div>
//    <p>Sed non urna. Phasellus eu ligula. Vestibulum sit amet purus.
//    Vivamus hendrerit, dolor aliquet laoreet, mauris turpis velit,
//    faucibus interdum tellus libero ac justo.</p>
//  </div>
//  <h3>Section 3</h3>
//  <div>
//    <p>Nam enim risus, molestie et, porta ac, aliquam ac, risus.
//    Quisque lobortis.Phasellus pellentesque purus in massa.</p>
//    <ul>
//      <li>List item one</li>
//      <li>List item two</li>
//      <li>List item three</li>
//    </ul>
//  </div>
// </div>';
 // ---------------- шаблон аккардиона ---------------
 
 
 <?

  require "config.php";

  try {
    //$dbh = new PDO("odbc:poni32_test1", $msdb_User, $msdb_Pass);// тестовая база
    $dbh = new PDO("odbc:poni32", $msdb_User, $msdb_Pass);
    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
      }
    
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );  
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );  
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );     


 $Sale_id_in_base = 0; // Есть запись в базе 0 - Нет записей с выбранным Sale_id и npp в БД; 1 - Нет записей с выбранным 
                        //Sale_id и npp в БД флаг начала операции для кнопки выполнения операции в модальном окне;

  //  $sql = iconv('UTF-8', 'windows-1251', "SELECT * FROM dbo._шаблоны_Антон_listworks(".$_SESSION[reg].", 1, 1)
  // 			   WHERE [sale_id]='$si' AND [npp]='$npp'");


  // для разработки параметры заданы
  $sql = iconv('UTF-8', 'windows-1251', "SELECT * FROM dbo._шаблоны_Антон_listworks(88, 1, 1)
  WHERE [sale_id]='$si' AND [npp]='$npp'");
                    
  $sth   =   $dbh->query($sql);

  while($u = $sth->fetch()) {  
    foreach ($u as $key => $value) 
      $u[iconv('windows-1251', 'UTF-8', $key)]=iconv('windows-1251', 'UTF-8', $value);


    if ($count_si_npp == ''){
      // ----------------------------------------------------------------------------------
      echo "<div class='label-zakaz'>";    
      echo "<div>$u[npp]. $u[_inf_workname_name]</div><div>\n";

      echo "<hr>\n";

      echo "<div> Тираж: ".round($u[qty])." шт, Пригон: ".round($u[qty_obrazec_prigon])." шт";    
      if ($u[qty_made]>0) echo ", сдано ".round($u[qty_made])." шт";
      echo ".</div>\n";

      echo "<hr>\n";

      echo "<div>$u[comment]</div>";
      echo "<br>\n";
      echo "<div align=left>Продажа: $u[_Sale_manager_name]</div>";
      echo "<div align=left>Исполнитель: $u[Ответственный_name]</div>";
      echo "<div align=left>Оператор: $u[Дизайнер_тек_операции_name]</div>";
      // ----------------------------------------------------------------------------------

      if ($u[calc_IS_Close]==1) {
          // закрытые заказы
        echo "<div class=zclose>Закрыто:".date("d M Y",strtotime($u[time_made]))." - $u[Кем_выполнено]</div>";
      }
      
      echo "<h2>Отгрузка: ".date("d M Y",strtotime($u[Дата_отгрузки]))."</h2>\n";

      // ----------------------------------------------------------------------------------
    } else{
      echo "<div class = 'plita_edit'>";    

        // ----------------------- Получили выбранные для плиты Sale id и npp ----------------------
        // -- Преобразуем строку с Sale id и npp выбранные для плиты в массив ----------------------
        $rstr = str_replace("!",":",$count_si_npp);  // заменили "!" на ":" // $count_si_npp строка из js с SALE ID и npp
        $sstr = explode(":",$rstr); // по разделителю ":" создали массив из Sale id(четный индекс) и npp(не чётный индекс)  
        
        $array_zakaz_name = explode(";",$count_zakaz); // по разделителю ";" создали массив с заказам/позиция        

        $k = 0;//счётчик для перебора массива заказов
        for ($i=0;$i<count($sstr)-2;$i++){ 
          $SaleID = 0;
          $NPP = 0;
          $array_zakaz = '';
          // -- Получаем Sail id и npp в цикле --        
          $SaleID = $sstr[$i] ;// Для проверки на существующий Sale_id для плиты// получили в массиве Sale_id          
          $NPP = $sstr[$i+1];  // Для проверки на существующий по Sale_id - npp// получили в массиве npp                     
          $i++; // Для получения следующего Sale id +1
          
        // ----------------------------------------------------------------------------------------
        $number_plita = 0;

        $plita_status_made = -1; // -1 - Плита не создана 0 - плита создана 1 - подготовка завершена 2 - начато изготовление плиты 3 - закончено изготовление плиты
        // -------------- Сравниваем выбранные Sale id c Sail id в таблице плит -------------------
          $sql = "SELECT * FROM _plita_pattern"; // Присваиваем переменной запрос SQL как обычную строку
          $pp1 = $dbh->query($sql); // Передаём SQL запрос в PDO (PDOStatement Object ( [queryString] => SELECT * FROM _operation_work )) 
          // -- Перебераем все строки в таблице и сравниваем с отобранными Sale id и npp --
            while ($row = $pp1->fetch()){ // пока есть строки, то перебераем запрос  
              if (($row['Sale_id'] == $SaleID) and ($row['npp'] == $NPP)) {
                $plita_status_made = $row['status_made'];
                $number_plita = $row['PLITA'];
              }
            }

            echo "<label class = 'zakaz_v_plite'> <div> <input type='checkbox' value='$SaleID:$NPP'!'' > </div><div><h4>".$array_zakaz_name[$k]."</h4></div></label><br>";
            $k++; // создаём индекс следубщего заказа

        }
        echo "<h3 id='plita_modal'>Плита № ".$number_plita."</h3></div>";
        //-------------------------------------------------------------------------------------------

   if ($plita_status_made >= 0){
      echo "<div class='btn_plita_edit'> <button type='button' class='btn mb - 1 btn-outline-danger' onclick='edit_plita(5)'>Удалить</button> ";
      echo "<button type='button' class='btn ml-1 mt - 1 btn-outline-success' onclick='edit_plita(6)'>Добавить</button>";
      echo "<input class='form-control ml-1 add_zakaz_v_plitu ' type='text'  onkeyup=\"this.value = this.value.replace ( /[^0-9/]/g, '')\"  >  ";    
    
   }



   if ($plita_status_made == 1){

    echo "<hr>";
      // --------------------- Создание Select списка оборудования цифры  --------------------------------

      $device_cifra =  $dbh->query("SELECT * FROM _inf_device where enable = 1 and department = 69"); 
      echo '<div>'. 
            '<select class="btn mt-1 btn-outline-warning btn-block cifra_device" id = "cifra_device">';     
            echo "<option value='0'>Выберите оборудование</option>"; 
      ?>
      
      <?php
      
          while($dc = $device_cifra->fetch()){  
            foreach ($dc as $key => $value) 
              $dc[$key]=iconv('windows-1251', 'UTF-8', $value); 
              echo "<option value=".$dc[0].">".$dc[2]."</option>";   
          }
      ?>
        
      <?php
          echo '</select>'.
      '</div>';  
      // -------------------------------------------------------------------------------------------------
    }
       echo "</div>"; // echo "<div class = 'plita_edit'>";
  

    }

    if ($u[calc_IS_Close]==0) {
      echo "<div class = 'block_tiraj'>";
      echo "<hr id='hr_hude'>\n";
      echo "<div class='gl-tiraj'>
              <h5 class='tiraj'>Для закрытия тиража</h5>
              <input class='form-control qty' type='text' id='workqty' value=".round($u[qty] + $u[qty_obrazec_prigon] - $u[qty_made])."> <h5>шт.</h5> </div>";    
      echo "</div>";

      echo '<div id="request_result">  </div> ';

      echo "<hr>";

?>        


  
  
<?php

// -------------------------------------------------------------------------------------------------

//----------- Обработка статуса(открыт закрыт) операций кроме клише --------------
$sql = "SELECT * FROM _operation_work";
$ow1 = $dbh->query($sql);

while($ow = $ow1->fetch()) {  
  foreach ($ow as $key1 => $value1) 
    $ow[iconv('windows-1251', 'UTF-8', $key1)]=iconv('windows-1251', 'UTF-8', $value1);
    // Статус 0 - Когда нет записи в таблице тогда НАЧАТЬ
    // Статус 1 - Когда есть запись в таблице время начала тогда ЗАВЕРШИТЬ
    // Статус 2 - Когда есть запись в таблице время завершения но заказ не закрыт тогда НАЧАТЬ 

    if (($ow['Sale_id'] == $u[sale_id]) and ($ow['npp'] == $u[npp]) and ($ow['manager_begin'] > 0)) $Sale_id_in_base = 1; // Если есть запись с Sale id и npp то время начало операции и ключ сотрудника Begin уже есть  
    if (($ow['Sale_id'] == $u[sale_id]) and ($ow['npp'] == $u[npp]) and ($ow['manager_end']   > 0)) $Sale_id_in_base = 2; // 


} 
// -----------------------------------------------------------------------------------------

// ------- В зависимости от состояния операции начата или нет существует плита или нет ---
// -------------------- отображаются кнопки для старта операции --------------------------
 echo '<div class="button_op">';

  if ($u[_inf_workname_nomer] == 70008){
    if ($plita_status_made == -1) //Если плиты не существует то НАЧАТЬ ПОДГОТОВКУ
         echo '<input type="button" class=" btn btn-primary btn_start_op" name="" id="" value="Начать подготовку плиты    " onclick="start_op(1)">';                      
    if ($plita_status_made == 0)// Если плита существует и не закончена подготовка
          echo '<input type="button" class="btn btn-primary btn_start_op" name="" id="" value="Завершить подготовку плиты " onclick="start_op(2)"> '; 
    if ($plita_status_made == 1)// Если закончена подготовка плиты то начать выполнение   
            echo '<input type="button" class="btn btn-primary btn_start_op" name="" id="" value="Начать операцию   " onclick="start_op(3)">'; 
    if ($plita_status_made >= 2) // Если операция начата то закончить выполнение
              echo '<input type="button" class="btn btn-primary btn_start_op" name="" id="" value="Завершить операцию" onclick="start_op(4)">';    

  } 
  else {

          if ($Sale_id_in_base == 0) // Если нет записи в таблице с Sale id и npp  тоесть Если == 1 значит запись есть
            echo '<input type="button" class="btn btn-primary btn_start_op" name="" id="" value="Начать операцию   " onclick="start_op(3)">';
          if ($Sale_id_in_base == 1)
            echo '<input type="button" class="btn btn-primary btn_start_op" name="btn_start_op_4" id="" value="Завершить операцию" onclick="start_op(4)">';
          if ($Sale_id_in_base == 2)
            echo '<input type="button" class="btn btn-primary btn_start_op" name="btn_start_op_7" id="" value="Начать операцию(начатую)" onclick="start_op(7)">';

      echo '</div>'; 
    }        


  '<!------------ /Менюшка с выбором начала и окончания операции ------------------------->';
  
  echo  '</div> <!--<div class="button_action"> -->';


  echo '<div class="modal_exit"><button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button></div>';




  ?>


  <?
    }
   }
   ?>



// ===================================================

<?

  require "config.php";

  // определяем участок
  if ($reg<1) $reg=88;

  $_SESSION[reg]=$reg;

  $treg[53]="Участок печати";
  $treg[25]="Участок вырубки и тиснения";
  $treg[28]="Участок упаковки";
  $treg[31]="Швейный участок";
  $treg[88]="Участок цифровой печати";

  // время отсечки далеких заказов для разных участков
  $tlim[53]="+5 day";
  $tlim[25]="+2 day";
  $tlim[28]="+2 day";
  $tlim[31]="+2 day";
  $tlim[88]="+5 day";


  function str_limit($s, $n=80)
  { 

    if (strlen($s)>$n) {
      $s = substr($s, 0, $n); //режем строку от 0 до limit
      
      $s= substr($s, 0, strrpos($s, ' ' ));    
      //берем часть обрезанной строки от 0 до последнего пробела
    }

    return $s;
  }

// тестовая база odbcad32  test_26_11_2019_9h

  try {
      //$dbh = new PDO("odbc:poni32_test1", $msdb_User, $msdb_Pass);// тестовая база
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
  <meta name="author" content="Gukin Anton, Kolegov Dmitriy">
  <meta http-equiv="refresh" content="1200">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
  <link rel="stylesheet" type="text/css" href="css/works.css">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

  <title><? echo $treg[$reg]; ?></title>
 
  <script src='js/jquery-2.0.3.min.js'></script>
  <script type="text/javascript" src="js/window.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>  
    
  </head>

  <body >   

    <?



  // --------------- Создание Select списка сотрудников цифры функция -------------------------------
  // -----получает данные из таблицы шаблоны дизайнеров в графиках в модальном окне -----------------

  
  echo '<div class="user_id_menu">';

  echo '<div class="panel text-center "><h3 text-center>Сотрудник: </h3>'.      
      '<select class="btn btn-info mb-2 ml-1" name="id_user" id="select_user">';   
      echo "<option value='0'>Не выбран</option>";

      $user_cifra =  $dbh->query("SELECT * FROM [dbo].[_php_desiner]()"); 
  ?>
  
  <?php
  
      while($uc = $user_cifra->fetch()){  
        foreach ($uc as $key => $value) 
          $uc[$key]=iconv('windows-1251', 'UTF-8', $value);
          echo "<option value=".$uc['id'].">".$uc['f']."</option>";              
      }

  ?>
    
  <?php
     echo '</select></div> <br><br>';  

echo '</div>'; //<!--class="user_id_menu" -->


$operation_w = $dbh->query('SELECT * FROM _operation_work') -> fetchAll(PDO::FETCH_UNIQUE);

     //iconv - функция переводящая строку в указанную кодировку 

    $sql = iconv('UTF-8', 'windows-1251', " SELECT * FROM [dbo].[_шаблоны_Антон_listworks_plita]($reg,1,0) 
                                                        order by [device_key] DESC,
                                                                (case when status_made = 3 then 1 else 0 end ) asc, 
                                                                (case when PLITA <>0 then 1 else 0 end ) desc , 
                                                                PLITA ,  
                                                                [calc_IS_Close],
                                                                --[time_beg], 
                                                                [Это_Инди_01] DESC, 
                                                                [otgruzka_data] , 
                                                                [time_end]" );


    // [dbo].[_шаблоны_Антон_listworks] ( ключ_отдела, выводить_дату_отгрузки_1_или_0, выводить_список_дизайнеров_1_или_0 )

    $sth   =  $dbh->query($sql);

    if ($sth->rowCount() == 0) {
      ?>
      <br /><br /><br /><br />
      <h1>Заказы в очереди на выполнение не обнаруженны.</h1>
      <?
    } else {

      while($u = $sth->fetch()) {  

        foreach ($u as $key => $value) 
        $u[iconv('windows-1251', 'UTF-8', $key)]=iconv('windows-1251', 'UTF-8', $value);
               
       
        if ($u[device_key]!=$dk) {
        // Разделитель оборудования
        if ($dk>0) { ?> <br clear="all" /> <? }
       
        ?>

        <!-- //if ($u[device_key] == 116) echo "<button type='button' class='btn btn-outline-secondary btn-sm ml-2 mb-1 btn_clear'>Редактировать</button>"; -->
        <?php //if ($u[device_key] == 116) echo "<button type='button' class='btn btn-outline-secondary btn-sm mb-1  btn_clear'>Очистить</button>"; ?>
        <div><h2 class='myh2'>  <? echo "* ".$u[device_name]." *";  ?></h2></div>

        <?
          $dk=$u[device_key];
          }

          if ((strtotime($tlim[$reg])>strtotime(substr($u[time_beg],0,10))) OR ($_SESSION[reg]==88)) {
            // отсекаем очень далекие заказы

            echo "<div  class=\"";

            if ($u[Это_Инди_01]==1) echo "indi";

            if ((strtotime("now")>strtotime($u[Дата_отгрузки])) and ($u[calc_IS_Close]!=1)) {
                echo "verybad";
              } elseif ($u[calc_IS_Close]==1) { 
                echo "greey";
                } elseif (strtotime("-1 day")>strtotime(substr($u[time_end],0,10))) { 
                  echo "red";
                  } elseif (strtotime("now")>strtotime(substr($u[time_beg],0,10))) { 
                    echo "yellow";
                    } else {
                        echo "green";
                      }         
            echo " block_plita\">";

            if ($u[calc_IS_Close] == 1) {// закрытые заказы                              
              echo "<div class='zname'>".str_limit($u[_inf_workname_name])."</div>";        
              echo "<div class='zzakaz'>".$u[Договор_Номер]."/".$u[позиция_в_Договоре]."</div>";       
              // echo '<button type="button" class="btn btn-dark">'.$u[Договор_Номер].'/'.$u[позиция_в_Договоре].'</button>';       
              echo "<div>".round($u[qty_made])." шт<br>"."Закрыто:".date("d M",strtotime($u[time_made]))."<br>".$u[Кем_выполнено]."</div>";
            }  else {// не закрытые заказы
                 echo "<div class='zname'>".str_limit($u[_inf_workname_name]);   

                if (($u[_inf_workname_nomer]==70008) or ($u[_inf_workname_nomer]==70058)) {
                          echo '<input type="checkbox" name ="check_plita[]" class="clcheckbox" id="idcheckbox" value='.$u[sale_id].':'.$u[npp].'!'.$u[Договор_Номер]."/".$u[позиция_в_Договоре].' onchange = "plita_key()">'; // для изготовления плит 
       
                  }
                echo "</div>";
                
               echo "<div>";
               echo "<div class=\"nzakaz\"><button type='button' class='btn btn-outline-secondary  p-0 m-0 btn-lg btn-block btn-nzakaz ";
              //-------------------------------------------------------------------------------
              //if ($u[started_01]!=1) //------- Выполнение начато 
     
              if($u[stm]==2) echo "active"; // Выполнение начато для операций клише

              foreach ($operation_w as $keyow => $valueow) {
                if (($u[sale_id] == $valueow[Sale_id]) and ($u[npp] ==  $valueow[npp]) and ($valueow[manager_end] == 0) ){ // для ПОНИ осовной 
                 // if (($u[sale_id] == $keyow) and ($u[npp] ==  $valueow[0]) and ($valueow[5] == 0)){  // для тестовой базы
                  echo "active";// Выполнение начато для операций кроме клише 
                } 
              }                
           //---------------------------------------------------------------------------------                           
                      echo "' data-toggle='modal' data-target='#exampleModalCenter' onclick=\"set(".$u[sale_id].",".$u[npp].",".$u[Договор_Номер].",".$u[позиция_в_Договоре].") ; return false;\"> ".$u[Договор_Номер]."/".$u[позиция_в_Договоре];
                  echo " </button></div>";

                    echo "<div class='count'>";
                      echo round($u[qty])." (".round($u[qty_obrazec_prigon]).")";
                      if ($u[qty_made]>0) echo "-".round($u[qty_made]);
                      echo "шт<br>".date("d M",strtotime($u[time_beg]))." -- ".date("d M",strtotime($u[time_end]));
                    echo "</div>";
                echo "</div>";
            
               echo "<div>".str_limit($u[comment])."</div>";

                echo "<div>";
                if ($u[device_key]==116) {
                  // дополнительная отметка для фрезы.        
                  echo "<p>Плита №:&nbsp;<p class='plita_n'>"?>  <?php 
                  echo $u[PLITA];
                  echo "</p>&nbsp;Станок:"; 
                    if ($u[device_plita] == 133) echo "б/у - НЕМЕЦ"; elseif ($u[device_plita] == 134) echo "SD-80709 КИТ"; else  $u[device_plita]; 
                  echo "</p><br>";              
                }            
                echo "<p>Отгрузка:".date("d M",strtotime($u[Дата_отгрузки]))."</div>";
              }

             echo "</div>";
             echo "</div>";

          }//else {// не закрытые заказы
        } //if ((strtotime($tlim[$reg])>strtotime(substr($u[time_beg],0,10))) OR ($_SESSION[reg]==88))
      }//while($u = $sth->fetch()) {

        
?>
  
  <?php

?>

      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" > 
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">

            <div class="modal-header"><h4></h4>
              <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal titleямясч</h5> -->
              <h5 class="modal-title" id="exampleModalLongTitle"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
             </div><!-- class="modal-header" -->

            <div class="modal-body" id="div-modal">
             </div> <!--class="modal-body" -->        

           </div> <!--class="modal-content" -->
         </div> <!--     class="modal-dialog   -->
     </div> <!--  class="modal fade"  -->
      <!-- Modal -->





  </body>
</html>


