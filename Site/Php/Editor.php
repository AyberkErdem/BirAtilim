  <?php
  include('config.php');
  $query="select * from user Where Name='".$_GET['user']."'";
  $response=@mysqli_query($dbc,$query);
  $row=$response->fetch_assoc();
  if(isset($_POST['edit'])&&$_POST['PasswordOriginal']==$row['Password']){
  {
    $content="";
     $file_size = $_FILES['image']['size'];
     if($file_size!=0)
     {
        $filename = $_FILES['image']['name'];
        $tmpname = $_FILES['image']['tmp_name'];
    	  $file_size = $_FILES['image']['size'];
    	  $file_type = $_FILES['image']['type'];
    	  $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $fp  = fopen($tmpname, 'r');
        $content = fread($fp, filesize($tmpname));
        $content = addslashes($content);
        fclose($fp);
      }
      if(isset($_POST['Password1'])&&isset($_POST['Password2']))
      {
        if($_POST['Password1']==$_POST['Password2'])
        {
          $query=("CALL EditProfile('".$_GET['user']."','".$content."','".$_POST['Name']."','".$_POST['Password1']."','".$_POST['Email']."','".$_POST['Phone']."')");
          if(mysqli_query($dbc,$query))
          {

          header("Location:Home.php?user=".$_POST['Name']."");
          }
        }
        else
        {
          header("Location:Home.php?user=".$_POST['Name']."");
        }
      }
      else {
        $query=("CALL EditProfile('".$_GET['user']."','".$content."','".$_POST['Name']."','".$row['Password']."','".$_POST['Email']."','".$_POST['Phone']."')");
        if(mysqli_query($dbc,$query))
        {

            header("Location:Home.php?user=".$_POST['Name']."");
        }
      }

  }}

   ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!--- Include the above in your HEAD tag ---------->
    <head>
      <meta charset="utf-8">

      <link rel="stylesheet" type="text/css" href="../css/reset.css">
      <link rel="stylesheet" type="text/css" href="../css/Editor.css">
      <title></title>
    </head>
    <body>
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
                      <a href="Mesajlar.php?user=<?php echo $_GET['user'];?>" class="nav-link m-2 btn btn-warning">Mesajlar</a>
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
      $sql = "select * FROM user  where Name='".$_GET['user']."'";
        $result=@mysqli_query($dbc,$sql);
          if ($result->num_rows > 0) {
            $resim = mysqli_fetch_array($result);}
            ?>
      <div class="container register">
                      <div class="row">

                          <div class="col-md-3 register-left">

                            <div class="profile-img">
                                <img src='data:image/jpeg;base64,<?php echo base64_encode($resim['ProfilePic']);  ?>'onerror="this.onerror=null;this.src='../Img/person.png';"
                                        alt="image"/style="height:200px; width:200px; overflow:hidden;">
                                <div class="file btn btn-lg btn-primary">
                                                              Change Photo
                                                              <form enctype="multipart/form-data" class="col-md-9" action="Editor.php?User=<?php echo $_GET['user'] ?>" method="post">
                                                              <input type="file" name="image" accept="image/jpeg">
                                                          </div>
                            </div>
                          </div>

                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                                      <h3 class=" register-heading"><p style=" pointer-events: none;" class=" btn btn-dark">Edit Your Profile</p></h3>

                                      <div class="row register-form">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <input name="Name" type="text" class="form-control" placeholder="Kullanıcı Adı" value="<?php echo $row['Name']; ?>" />
                                              </div>
                                              <div class="form-group">
                                                  <input autocomplete="new-password" name="PasswordOriginal" type="password" class="form-control" placeholder="Current Password" value="" />
                                              </div>
                                              <div class="form-group">
                                                  <input name="Password1" type="password" class="form-control" placeholder="Re type Password" value="" />
                                              </div>

                                              <div class="form-group">

                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <input name="Email" type="email" class="form-control" placeholder="Email" value="<?php echo $row['Email']; ?>" />
                                              </div>
                                              <div class="form-group">
                                                  <input type="text" minlength="10" maxlength="10" name="Phone" class="form-control" placeholder="Phone Number" value="<?php if($row['Phone']!=""){echo $row['Phone'];} ?>"
                                                  />
                                              </div>
                                              <div class="form-group">
                                                  <input name="Password2" type="password" class="form-control"  placeholder="Confirm Password *" value="" />
                                              </div>
                                                <div class="form-group">
                                              <input name="edit" type="submit" class="btn btn-block profile-edit-btn btn-success"  value="Onayla"/>
                                                  </div>
                                                </form>
                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </div>
                      </div>

                  </div>
    </body>
  </html>
