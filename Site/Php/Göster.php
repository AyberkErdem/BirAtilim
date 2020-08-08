<?php
require_once('config.php');
session_start();

if(isset($_POST['Yolla']))
{
  $query=("insert into chat values('','".$_GET['user']."','".$_GET['subject']."','".$_POST['mesaj']."','".$_POST['price']."','0')");
  if(mysqli_query($dbc,$query))
  {
echo"<script>window.location='Göster.php?user=".$_GET['user']."&subject=".$_GET['subject']."';</script>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

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
      $sql = "SELECT * FROM poster  where Id='".$_GET['subject']."'";
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
           $sql1 = "SELECT * FROM chat  where PosterId='".$_GET['subject']."'";
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
  <form class="" action="Göster.php?user=<?php echo $_GET['user']; ?>&subject=<?php echo $_GET['subject'];?>" method='post'>
      <textarea name='mesaj' rows='8' cols='80'></textarea>
         <input name="price" type="number" value="1000" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
      <input type='submit' name='Yolla' value='Gönder'>
  </form>


</div>
  </body>
</html>
