<?php

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link style=" border-radius: 50%;" rel = "icon" href ="../Img/icon.png"
         type = "image/x-icon">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" type="text/css" href="../css/reset.css">
         <link rel="stylesheet" type="text/css" href="../css/Mesaj.css">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
     <title></title>
   </head>
   <body>
<?php
require_once('config.php');
  $sql1 = "select  *  from chat where Receiver='".$_GET['user']."'and Sender='".$_GET['sender']."' OR  Receiver='".$_GET['sender']."'and Sender='".$_GET['user']."'order by Id ASC";
    $result=@mysqli_query($dbc,$sql1);
      if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc())
        {
if($row['Receiver']==$_GET['sender']){
  echo"
  <div class='outgoing_msg'>
    <div class='sent_msg'>
      <p>".$row['Message']."</p>
      <span class='time_date'>".$row['Date']."</div>
  </div>";
        }
            if($row['Receiver']==$_GET['user']){
              echo "  <div class='incoming_msg'>
                  <div class='received_msg'>
                    <div class='received_withd_msg'>
                      <p>".$row['Message']."</p>
                      <span class='time_date'> ".$row['Date']."</span></div>
                  </div>
                </div>";
          }
        }
      }
 ?>
   </body>
 </html>
