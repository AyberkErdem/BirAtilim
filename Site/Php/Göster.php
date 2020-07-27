<?php
require_once('config.php');
session_start();
if(isset($_POST['Yolla']))
{
  $query=("insert into chat values('','".$_SESSION['user']."','".$_SESSION['IlanNo']."','".$_POST['mesaj']."','".$_POST['price']."')");
  if(mysqli_query($dbc,$query))
  {

  }
  else
  {
    echo"<script>alert('mesajı atamadık')</script>";
  }

}
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
    </tr>
      <?php require_once('config.php');
      $sql = "SELECT * FROM poster  where Id='".$_SESSION['IlanNo']."'";
        $result=@mysqli_query($dbc,$sql);
          if ($result->num_rows > 0) {
            while($row=$result->fetch_assoc())
            {?><tr>
              <?php
                echo "<td>".$row['UserName']."</td>
                <td><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='300' widht='100'</td>
                <td>".$row['Description']."</td>
                <td>".$row['adress']."</td>";
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
         <th>From</th>
         <th>Message</th>
         <th>Value</th>
         </tr>
           <?php require_once('config.php');
           $sql1 = "SELECT * FROM chat  where PosterId='".$_SESSION['IlanNo']."'";
             $result=@mysqli_query($dbc,$sql1);
               if ($result->num_rows > 0) {
                 while($row=$result->fetch_assoc())
                 {?><tr>
                   <?php
                     echo "<td>".$row['Sender']."</td>
                     <td>".$row['Message']."</td>
                     <td>".$row['Value']."</td>";
                       ?></tr><?php
                 }
               }
               else
               {
                 echo"Nothing new here...";
               }
            ?>
          </table>
         </div>
         <br>
<div class="">
  <form class="" action="Göster.php" method="post">
      <textarea name="mesaj" rows="8" cols="80"></textarea>
      <input type="number" name="price" value=""placeholder="Fiyat Verin">
      <input type="submit" name="Yolla" value="Gönder">
  </form>


</div>
  </body>
</html>
