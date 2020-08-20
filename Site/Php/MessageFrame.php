<?php
include('config.php');
session_start();
$query="call MakeSeen('".$_SESSION['user']."','".$_GET['sender']."')";
if(!mysqli_query($dbc,$query))
{

  echo "<script>alert('Mesajlar Güncellenemedi')</script>";
}
if(isset($_POST['Privateer']))
{
header("location:SendPrivate.php?user=".$_SESSION['user']."&Receiver=".$_GET['sender']."&Message=".$_POST['mess']."&PosterId=".$_POST['poster']."");

}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
 <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
 <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   <head>
     <meta charset="utf-8">
     <link style=" border-radius: 50%;" rel = "icon" href ="../Img/icon.png"
         type = "image/x-icon">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" type="text/css" href="../css/reset.css">
         <link rel="stylesheet" type="text/css" href="../css/Frame.css">

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
echo"
      <ul class='nav navbar-nav'>
        <li class='dropdown'>
          <a style='text-decoration:none;' href='#' class='dropdown-toggle' data-toggle='dropdown'>Seçenekler<span class='glyphicon glyphicon-user pull-right'></span></a>
          <ul class='dropdown-menu'>
            <li><a href='MesajlarıSil.php?sender=".$_GET['sender']."'>Mesajları Sil<span class='glyphicon glyphicon-cog pull-right'></span></a></li>
            <li class='divider'></li>
            <li><a href='#'>Bildirimleri Aç <span class='glyphicon glyphicon-stats pull-right'></span></a></li>
            <li class='divider'></li>
          <li><a target='_blank' href='Eye.php?eye=".$_GET['sender']."'>Profiline Git<span class='glyphicon glyphicon-stats pull-right'></span></a></li>

          </ul>
        </li>
      </ul>";

    $dbc->next_result();
  $sql1 = "select * from chat where (Sender='".$_SESSION['user']."' and Send_Active=1 and Receiver='".$_GET['sender']."') or (Receiver='".$_SESSION['user']."' and Sender='".$_GET['sender']."' and Rec_Active=1);";
    $result=@mysqli_query($dbc,$sql1);

      if ($result->num_rows > 0) {
        echo" <div id='1' class='msg_history'>";
        while($row=$result->fetch_assoc())
        {
if($row['Receiver']==$_GET['sender']){
  echo"
  <div class='outgoing_msg'>
    <div class='sent_msg'>
      <p>".$row['Message']."</p>
      <span class='time_date'>".$row['Clock']."</div>
  </div>";
        }
            if($row['Receiver']==$_SESSION['user']){
              echo "  <div class='incoming_msg'>
                  <div class='received_msg'>
                    <div class='received_withd_msg'>
                      <p>".$row['Message']."</p>
                      <span class='time_date'> ".$row['Clock']."";if($row['PosterId']!="-1"){echo "<a target='_blank' style='text-decoration:none;'href='Göster.php?subject=".$row['PosterId']."'>@ilan".$row['PosterId']."</a>";}echo "</span></div>
                  </div>
                </div>";
          }
            $poster=$row['PosterId'];

        }
        echo    "  </div></div><div class='type_msg'>
              <div class='input_msg_write'>
              <form style='height:100%;widht:100%' action=MessageFrame.php?sender=".$_GET['sender']." method=post>
                <input style='height:100%;widht:100%' name='mess' type='text' class='write_msg' placeholder='Type a message' />
                <input type='hidden' name='poster' value='".$poster."'>
                <input style='background-color:#05728f;'  name='Privateer' type='submit' class='text-light float-right profile-edit-btn' >
                 </form>
        </div></div>";


      }
      if ($result->num_rows==0){
      echo    "  </div></div><div class='type_msg'>
            <div class='input_msg_write'>
            <form style='height:100%;widht:100%' action=MessageFrame.php?sender=".$_GET['sender']." method=post>
              <input style='height:100%;widht:100%' name='mess' type='text' class='write_msg' placeholder='Type a message' />
              <input type='hidden' name='poster' value='-1'>
              <input style='background-color:#05728f;'  name='Privateer' type='submit' class='text-light float-right profile-edit-btn' >
               </form>
      </div></div> ";
}
 ?>
    </div>
   </body>
   <script type="text/javascript">
   window.onload=function () {
   var objDiv = document.getElementById("1");
   objDiv.scrollTop = objDiv.scrollHeight;
}
   </script>
 </html>
