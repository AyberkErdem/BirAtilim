<?php
include('config.php');
session_start();
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
      <meta name="description" content="Bir atilim">
      <meta name="author" content="Ayberk Erdem">
      <meta name="keywords" content="Bir atilim,Ayberk Erdem">
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
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php">
                <img title="Bir Atilim" src="../Img/logo.png" alt="Logo">
            </a>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php">
                <img title="Bir Atilim" src="../Img/left.png" alt="Logo">
            </a>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php">
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
                    <a href="YeniIlan.php" class="nav-link m-2 btn btn-warning nav-active">İlan Oluştur</a>
                </li>
                <li class="nav-item">
                    <button onclick="myFunction()" class="nav-link m-2 dropbtn btn btn-warning">Kişisel Şeyler</button>
                    <div id="myDropdown" class="dropdown-content">
                      <a class="bg-warning text-muted" href="ilanlarım.php">İlanlarım</a>
                      <a class="bg-warning text-muted" onclick="Fav()">Favorilerim</a>
                          <a class="bg-warning text-muted" href="Mesajlar.php">Mesajlarım</a>
                      <a class="bg-warning text-muted" href="MyPage.php">Ayarlarım</a>

    </div>

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
           $sql1 = "select  DISTINCT Sender  from chat where Receiver='".$_SESSION['user']."'  order by Seen ASC";
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
                   echo "<div id='context-menu'> <div class='item'>
                      <a href='#".$row['Sender']."' class='context-menu__link'>
                      <i class='fa fa-cut'></i> Cut
                        </a>
                      </div>
                      <div class='item'>
                      <i class='fa fa-clone'></i> Copy
                      </div>
                      <div class='item'>
                      <i class='fa fa-paste'></i> Paste
                      </div>
                      <div class='item'>
                      <i class='fa fa-trash-o'></i> Delete
                      </div>
                      <hr>
                      <div class='item'>
                      <i class='fa fa-refresh'></i> Reload
                      </div>
                      <div class='item'>
                      <i class='fa fa-times'></i> Exit
                      </div>
                      </div>
                   <div class='chat_list'>
                     <div class='chat_people'>
                       <div class='chat_img'> <img src='https://ptetutorials.com/images/user-profile.png' alt='sunil'> </div>
                       <div class='chat_ib'>
                         <h5><a style='text-decoration:none;' href='MessageFrame.php?user=".$_SESSION['user']."&sender=".$row['Sender']."' target='MessageFrame'>".$row['Sender']."</a> </h5>

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

          function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }
          function İlanlarım()
          {



            window.location="ilanlarım.php";

          }
          function Fav()
          {


            var Name="<?php echo $_SESSION['user']; ?>";

            var x=getCookie(Name);
            var user="<?php echo $_SESSION['user'];?>";

            window.location="ilanlarım.php?favori="+x+"";
          }
          function GoPoster()
          {
            var url_string = window.location.href;
            var url = new URL(url_string);

            var x = document.getElementById("posterid").value;
            window.location="Göster.php?subject="+x;
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
          <script>
          window.addEventListener("contextmenu",function(event){
      event.preventDefault();
      var contextElement = document.getElementById("context-menu");
      contextElement.style.top = event.offsetY + "px";
      contextElement.style.left = event.offsetX + "px";
      contextElement.classList.add("active");
    });
    window.addEventListener("click",function(){
      document.getElementById("context-menu").classList.remove("active");
    });

   </script>
  </body>
</html>
