  <?php
  include('config.php');
  $query="select * from user Where Name='".$_GET['User']."'";
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
          $query=("CALL EditProfile('".$_GET['User']."','".$content."','".$_POST['Name']."','".$_POST['Password1']."','".$_POST['Email']."','".$_POST['Phone']."')");
          if(mysqli_query($dbc,$query))
          {
            $_SESSION['user']=$_POST['Name'];
          echo"<script>window.location='Home.php?subject=".$_GET['user'].";</script>";
          }
        }
        else
        {
          echo "<script>alert('Değiştirilmek istenen şifreler uyuşmuyor...');</script>";
        }
      }
      else {
        $query=("CALL EditProfile('".$_GET['User']."','".$content."','".$_POST['Name']."','".$row['Password']."','".$_POST['Email']."','".$_POST['Phone']."')");
        if(mysqli_query($dbc,$query))
        {
          $_SESSION['user']=$_POST['Name'];
          header("location:home.php");
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
      <?php
      $sql = "select * FROM user  where Name='".$_GET['User']."'";
        $result=@mysqli_query($dbc,$sql);
          if ($result->num_rows > 0) {
            $resim = mysqli_fetch_array($result);}
            ?>
      <div class="container register">
                      <div class="row">

                          <div class="col-md-3 register-left">

                            <div class="profile-img">
                                <img src='data:image/jpeg;base64,<?php echo base64_encode($row['ProfilePic'])  ?>'
                                        alt="image"/style="height:300px; width:180px; overflow:auto;">
                                <div class="file btn btn-lg btn-primary">
                                                              Change Photo
                                                              <form enctype="multipart/form-data" class="col-md-9" action="Editor.php?User=<?php echo $row['Name'] ?>" method="post">
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
                                                  <input name="PasswordOriginal" type="password" class="form-control" placeholder="Password" value="" />
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
