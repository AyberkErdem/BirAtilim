<?php
include('config.php');

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
  <title>Bir atilim</title>
</head>
  <body style="overflow-y=hidden;">
    <nav style="background-color:#88001b;" class="navbar navbar-expand-lg navbar-light ">
        <div class="d-flex flex-grow-1">
            <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php?user=<?php echo $_GET['user']; ?>">
                <img title="Bir Atilim" src="../Img/logo.png" alt="Logo">
            </a>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php?user=<?php echo $_GET['user']; ?>">
                <img title="Bir Atilim" src="../Img/left.png" alt="Logo">
            </a>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php?user=<?php echo $_GET['user']; ?>">
                <img title="Bir Atilim" src="../Img/home.png" alt="Logo">
            </a>
            <a class="navbar-brand-two mx-auto d-lg-none d-inline-block" href="#">
                <img  src="//placehold.it/40?text=LOGO" alt="logo">
            </a>
            <div class="w-100 text-right">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar">
            <ul class="navbar-nav ml-auto flex-nowrap">
                <li class="nav-item">
                    <a href="YeniIlan.php?user=<?php echo $_GET['user'] ?>" class="nav-link m-2 btn btn-warning nav-active">İlan Oluştur</a>
                </li>
                <li class="nav-item">
                    <button  onclick="İlanlarım()" class="nav-link m-2 btn btn-warning">İlanlarım</button>
                </li>
                <li class="nav-item">
                    <button  onclick="Fav()" class="nav-link m-2 btn btn-warning">Favorilerim</button>
                </li>
                <li class="nav-item">
                    <a href="MyPage.php?user=<?php echo $_GET['user'];?>" class="nav-link m-2 btn btn-warning">Ayarlarım</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link m-2 btn btn-warning">Bize Yazın</a>
                </li>
            </ul>
        </div>
        <form class="navbar-form"  method="post">
      <div class="input-group">
          <input type="text" class="form-control" placeholder="İlan ara(Id veya Tür araması)" name="search">
          <div class="input-group-btn">
              <input type="submit" name='Ara' value="Ara" class="glyphicon glyphicon-search btn btn-primary">

          </div>
      </div>

      </form>
    </nav>

         <?php
         require_once('config.php');
           $sql1 = "select  DISTINCT Sender  from chat where Receiver='".$_GET['user']."'  order by Seen ASC";
             $result=@mysqli_query($dbc,$sql1);
               if ($result->num_rows > 0) {
                 echo "<div class='container '>

                 <div class='messaging'>
                       <div class='inbox_msg'>
                         <div class='inbox_people'>
                           <div class='headind_srch'>
                             <div class='recent_heading'>
                               <h4>List</h4>
                             </div>
                             <div class='srch_bar'>
                               <div class='stylish-input-group'>
                                 <input type='text' class='search-bar'  placeholder='Search' >
                                 <span class='input-group-addon'>
                                 <button onclick='MessageLook()' type='button'> <i class='fa fa-search' aria-hidden='true'></i> </button>
                                 </span> </div>
                             </div>
                           </div>   <div class='inbox_chat'>";
                 while($row=$result->fetch_assoc())
                 {
                   echo "


                   <div class='chat_list'>
                     <div class='chat_people'>
                       <div class='chat_img'> <img src='https://ptetutorials.com/images/user-profile.png' alt='sunil'> </div>
                       <div class='chat_ib'>
                         <h5><a style='text-decoration:none;' href='MessageFrame.php?user=".$_GET['user']."&sender=".$row['Sender']."' target='MessageFrame'>".$row['Sender']."</a> </h5>

                       </div>
                     </div>
                  </div>


                          ";
                     ?><?php
                 }
                 echo"
                    </div>
                 </div>
                  <div  class='mesgs'>
                     <iframe style='position:relative;align=bottom;' width='100%' height='100%'  name='MessageFrame' class='msg_history'></iframe>

              </div>
                  </div>
                     </div>

               </div>
             </div>";
               }
               else
               {
                 echo"<p style='margin-top:25px;' class='text-center text-dark bg-success'>Yeni Mesajınız yoktur</p>";
               }
            ?>

          </div>
          </div>
          <script type="text/javascript">

          function İlanlarım()
          {


            var user="<?php echo $_GET['user'];?>";

            window.location="ilanlarım.php?user="+user+"";

          }
          function Fav()
          {


            var Name="<?php echo $_GET['user']; ?>";

            var x=getCookie(Name);
            var user="<?php echo $_GET['user'];?>";

            window.location="ilanlarım.php?user="+user+"&favori="+x+"";
          }
          function GoPoster()
          {
            var url_string = window.location.href;
            var url = new URL(url_string);
            var c = url.searchParams.get("user");
            var x = document.getElementById("posterid").value;
            window.location="Göster.php?user="+c+"&subject="+x;
          }
          function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
              var c = ca[i];
              while (c.charAt(0) == ' ') {

                c = c.substring(1);
              }
              if (c.indexOf(name) == 0) {

                return c.substring(name.length, c.length);
              }
            }
            return "";
          }
          </script>
  </body>
</html>
