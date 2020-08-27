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
   <meta name="description" content="Bir Atilim">
   <meta name="author" content="Ayberk Erdem">
   <meta name="keywords" content="Bir atilim,Ayberk Erdem">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" type="text/css" href="../css/reset.css">
   <link rel="stylesheet" type="text/css" href="../css/Home.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

     <title></title>
   </head>
   <body>
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

     $sql = "select * from test.old_poster_data where Poster_Id='".$_GET['subject']."'";
       $result=@mysqli_query($dbc,$sql);
         if ($result->num_rows > 0) {
           while($row=$result->fetch_assoc())
           {
             $date = date_create($row['Date']);
               echo "<div  class='container '>
               <div class='card bg-warning'>
                 <div class='container-fliud'>
                   <div class='wrapper row'>
                     <div class='preview col-md-6'>
                       <div class='preview-pic tab-content'>
                         <div class='tab-pane active' id='pic-1'><img src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='300' widht='100'/></div>
                       </div>
                     </div>
                     <div class='details col-md-6'>
                     <div class='tab-content profile-tab' id='myTabContent'>
                     <div class='tab-pane fade show active float-right' id='home' role='tabpanel' aria-labelledby='home-tab'>
                       <h3 class='product-title '>Buraya Filtre İçeriği Gelir</h3>

                       <p class='product-description'> ".$row['Description']." </p>
                         <h4 class='price '>İlan Yayın Tarihi</h4>
                         <p class='product-description '> " .date_format($date, 'd-m-Y')." </p>
                       <h4 class='price '>İlan Sahibi</h4>
                        <p class='product-description '> " .$row['UserName']." </p>";
             }
           }
           mysqli_free_result($result);
         $dbc->next_result();
         echo"
                 <div style='display:block;' class='wrapper row'>
                   <div style='width: 650px;height:200px;overflow:auto;' >
                      <table  class='table table-striped custab'>
                      <thead>
                          <tr>
                              <th>Fatura Id</th>
                              <th>Alıcı</th>
                               <th>Fiyat</th>

                          </tr>
                      </thead>";
           $nesquik="select * from test.receipt where PosterId='".$_GET['subject']."'";
           $result=@mysqli_query($dbc,$nesquik);
             if ($result->num_rows > 0) {
               while($row=$result->fetch_assoc())
               {
                 echo "<tr>";
                  echo"
                     <td style='font-size:0.7em;'>".$row['Id']."</td>
                      <td style='font-size:0.7em;'>".$row['Buyer']."</td>
                       <td style='font-size:0.7em;'>".$row['Spended']."</td>
                 </tr>";;
               }
             }
   ?>
   </body>
 </html>
