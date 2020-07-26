<?php
require_once('config.php');
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
    <tr>
    <th>İlan Sahibi</th>
    <th>Resim</th>
    <th>Açıklama</th>
    <th>Adres</th>
    <th>İlana Git</th>
    </tr>
      <?php require_once('config.php');
      $sql = "SELECT * FROM poster  order by Id ASC";
        $result=@mysqli_query($dbc,$sql);
          if ($result->num_rows > 0) {
            while($row=$result->fetch_assoc())
            {?><tr>
              <?php
                echo "<td>".$row['UserName']."</td>
                <td><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='150' widht='100'</td>
                <td>".$row['Description']."</td>
                <td>".$row['adress']."</td>

                <td><a target='_blank' href='Göster.php?subject=".$row['Id']."'>İlana Git</a></td></form></td>";
                  ?></tr><?php
            }
          }
          else
          {
            echo"Nothing new here...";
          }
       ?>
       <div border='1'height='700' widht='400' class="">
         <table>
         <tr>
         <th>İlan Sahibi</th>
         <th>Resim</th>
         <th>Açıklama</th>
         <th>Adres</th>
         <th>İlana Git</th>
         </tr>
           <?php require_once('config.php');
           $sql1 = "SELECT * FROM chat  where PosterId='".$_GET['subject']."'";
             $result=@mysqli_query($dbc,$sql1);
               if ($result->num_rows > 0) {
                 while($row=$result->fetch_assoc())
                 {?><tr>
                   <?php
                     echo "<td>".$row['UserName']."</td>
                     <td><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='150' widht='100'</td>
                     <td>".$row['Description']."</td>
                     <td>".$row['adress']."</td>

                     <td><a target='_blank' href='Göster.php?subject=".$row['Id']."'>İlana Git</a></td></form></td>";
                       ?></tr><?php
                 }
               }
               else
               {
                 echo"Nothing new here...";
               }
            ?>
         </div>
          
  </body>
</html>
