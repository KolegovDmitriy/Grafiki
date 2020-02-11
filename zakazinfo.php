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
  
  //echo "Аякс сработал";
  //echo $zakaz;// Переданная переменная с заказом 


 // --- Запрос для получения количества строк ----
  $sql = iconv('UTF-8', 'windows-1251', "Select count(ds.Ключ) 
       From Догспец AS ds With (NoLock)
       Left JOIN Договор As dog With (NoLock) On ds.Договор=dog.Ключ
       Left JOIN _operation As op With (NoLock) On op.sale_id=ds.Ключ
       Left JOIN _inf_workname As i With (NoLock) On op.operation_KEY=i.Номер       
       Where dog.Номер='$zakaz' and dog.Вид=101 and dog.[Юр.лицо]=1 
       and op.enable=1");
                         
  $count_rows   =   $dbh->query($sql)->fetchColumn();
        
      //  echo $count_rows;// количество строк в запросе

  // -----------------------------------------------

     // --- Запрос получения операций для позиций заказа ----
     $sql = iconv('UTF-8', 'windows-1251', "Select dbo._шаблоны_GET_НомерЗаказа(ds.Ключ) as Position ,
                                                   i.Название,
                                                   dog.Номер,
                                                   ds.Ключ ,
                                                   convert(varchar(20), time_beg,4) as time_beg,
                                                   convert(varchar(20), op.time_end,4) as time_end,
                                                   comment,
                                                   CAST(qty_made AS int) as Тираж,                                                 
                                                   op.group_id,
                                                   op.sale_id,
                                                   op.npp,
                                                   op.parent, 
                                                   t.Номер,
                                                   t.Название,
                                                   CAST(ds.Количество AS int) as Количество,
                                                   org.Название,
                                                   qty,
                                                   qty_made
     --, op.* 
     From Догспец AS ds With (NoLock)
     Left JOIN Договор As dog With (NoLock) On ds.Договор=dog.Ключ
     Left JOIN Организация AS org  With (NoLock) on dog.Грузополучатель = org.Ключ
     Left JOIN _operation As op With (NoLock) On op.sale_id=ds.Ключ
     Left JOIN _inf_workname As i With (NoLock) On op.operation_KEY=i.Номер
     Left JOIN ТМЦ As t With (NoLock) On ds.[Субконто 1]=t.Ключ
     
     
     Where dog.Номер='$zakaz' and dog.Вид=101 and dog.[Юр.лицо]=1 
     and op.enable=1
     order by sale_id,npp ");
                       
     $sth   =   $dbh->query($sql);
 // -----------------------------------------------------------


  if ($sth->rowCount() == 0) {

      ?>
      <br />
      <h1>Заказ не обнаружен.</h1>
      <?

     } else {   


   // ------ Получаем в массив операции и позиции заказа ----
    $newArr = array(); 
      $i = 0;
     while($u = $sth->fetch()) {  
       foreach ($u as $key => $value) 
      // echo $key."<br>";
       $u[iconv('windows-1251', 'UTF-8', $key)] = iconv('windows-1251', 'UTF-8', $value);
        $i++; 
        $newArr[$i][] = $u[0];
        $newArr[$i][] = $u[1];      
        $newArr[$i][] = $u[2];    
        $newArr[$i][] = $u[3];    
        $newArr[$i][] = $u[4];
        $newArr[$i][] = $u[5];    
        $newArr[$i][] = $u[6];   
        $newArr[$i][] = $u[7];
        $newArr[$i][] = $u[8];
        $newArr[$i][] = $u[9];
        $newArr[$i][] = $u[10];
        $newArr[$i][] = $u[11];
        $newArr[$i][] = $u[12];
        $newArr[$i][] = $u[13];
        $newArr[$i][] = $u[14];
        $newArr[$i][] = $u[15];
        $newArr[$i][] = $u[16];
        $newArr[$i][] = $u[17];
       }
  // ---------------------------------------------------------


  echo '<script src="https://code.jquery.com/jquery-1.12.4.js"></script>';
  echo '<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';
  echo '<script type="text/javascript" src="js/grafikizakaz.js"></script>';
  echo '<script>'.
   '$( function() {'.
   '$( "#accordion" ).accordion();'.
     'active: 1'.
     'collapsible: true'.
  '} );'.
  '</script>';

      //  echo "<pre>";
      //  print_r ($newArr);    
      //  echo "</pre>";
  

      echo '<div id="accordion">';// шаблон аккардиона  

      for ($k=1;$k<$count_rows;$k++){ 
  
        // if($newArr[$k][0] != $newArr[$k-1][0]) {
         if($newArr[$k][0] != $nk) {
          // echo "<h3 class='myh2'>".$newArr[$k][0]."&nbsp&nbsp".$newArr[$k][12]."&nbsp&nbsp".$newArr[$k][13]."&nbspТ:".$newArr[$k][14]."</h3>";
          echo "<h3 class='myh2'>".$newArr[$k][0]."&nbsp&nbsp".$newArr[$k][13]."&nbspТираж: ".$newArr[$k][14]."&nbsp".$newArr[$k][15]."</h3>";
         




          $date_today = date("d.m.y"); //присвоено 12.03.15
   
          //echo("Текущая дата: $date_today .");


          echo "<div class = 'accont'><table>";
          echo "<tr><th>Операции</th> <th>Старт</th> <th>Финиш</th> <th>Коментарий</th> <th>Готово</th> </th>";
            for ($h=0;$h<$count_rows;$h++){ 
              if($newArr[$h][0] == $newArr[$k][0]) {
                
                //echo "<tr class =\" if($newArr[$h][16] == $newArr[$h][17]) echo 'trgreen';  \"> <td>". $newArr[$h][1]."</td> <td>".$newArr[$h][4]."</td> <td>".$newArr[$h][5]."</td> <td>".$newArr[$h][6]."</td> <td>".$newArr[$h][7]."</td>    <td>".$newArr[$h][16]."</td><td>".$newArr[$h][17]."</td>    </tr>";



                echo "<tr class=\"";
                // if (($newArr[$h][11] == $u[12])) echo " trgreen ";
                 //if (($newArr[$h][11] == 0) and ($newArr[$h][11] == $newArr[$h+1][12]   )) echo " trgreen ";      
                 if ($newArr[$h][10] == $newArr[$h+1][11]) echo " trgreen ";            
                echo "  \"  >";                        
                
                echo "<td class=\" ";
                if (($newArr[$h][16] < $newArr[$h][17]) or (($newArr[$h][16] == $newArr[$h][17])) ) echo "tdgreen";   
                if ($newArr[$h][11] > 0) echo " tdmargin ";              
                echo " \"> ";            
                //if ($newArr[$h][11] > 0) echo "&nbsp&nbsp "; 
                //echo $newArr[$h+1][11];
                echo $newArr[$h][1]."</td>"; 

                echo "<td class=\" ";
                if (($newArr[$h][16] < $newArr[$h][17]) or (($newArr[$h][16] == $newArr[$h][17])) ) echo "tdgreen";
                echo " \"> ";                
                echo $newArr[$h][4]."</td>";

                echo "<td class=\" ";
                if (($newArr[$h][16] < $newArr[$h][17]) or (($newArr[$h][16] == $newArr[$h][17])) ) echo "tdgreen";
                if (  strtotime($newArr[$h][5]) < strtotime($date_today) and (  !(($newArr[$h][16] < $newArr[$h][17]) or (($newArr[$h][16] == $newArr[$h][17])) ) )    ) echo " tdred";
                
                echo " \"> ";                
                echo $newArr[$h][5]."</td>";

                echo "<td class=\" ";
                if (($newArr[$h][16] < $newArr[$h][17]) or (($newArr[$h][16] == $newArr[$h][17])) ) echo "tdgreen";
                echo " \"> ";                
                echo $newArr[$h][6]."</td>";

                echo "<td class=\" ";
                if (($newArr[$h][16] < $newArr[$h][17]) or (($newArr[$h][16] == $newArr[$h][17])) ) echo "tdgreen";
                echo " \"> ";                
                echo $newArr[$h][7]."</td>";

                // echo "<td class=\" ";
                // if (($newArr[$h][16] < $newArr[$h][17]) or (($newArr[$h][16] == $newArr[$h][17])) ) echo "tdgreen";
                // echo " \"> ";                
                // echo $newArr[$h][10]."</td>";

                // echo "<td class=\" ";
                // if (($newArr[$h][16] < $newArr[$h][17]) or (($newArr[$h][16] == $newArr[$h][17])) ) echo "tdgreen";
                // echo " \"> ";                
                // echo $newArr[$h][11]."</td>";

                // echo  "<td class='tdgreen'>".$newArr[$h][4]."</td>"; 
                // echo  "<td class='tdgreen'>".$newArr[$h][5]."</td>";  
                // echo  "<td class='tdgreen'>".$newArr[$h][6]."</td>";  
                // echo  "<td class='tdgreen'>".$newArr[$h][7]."</td>";     
                // echo  "<td>".$newArr[$h][16]."</td>"; 
                // echo  "<td>".$newArr[$h][17]."</td>";     
                // echo  "</tr>";

                // echo  "<td >".$newArr[$h][4]."</td>"; 
                // echo  "<td >".$newArr[$h][5]."</td>";  
                // echo  "<td >".$newArr[$h][6]."</td>";  
                // echo  "<td >".$newArr[$h][7]."</td>";     
                // echo  "<td>".$newArr[$h][16]."</td>"; 
                // echo  "<td>".$newArr[$h][17]."</td>";     
                // echo  "</tr>";
              }     
              
            }
          echo "</table></div>";
          $nk = $newArr[$k][0];
        }
      }
     echo '</div>'; // echo '<div id="accordion">'; 
    
    







    }

?>