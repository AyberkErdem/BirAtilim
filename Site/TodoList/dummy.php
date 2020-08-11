<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    include('../Php/config.php');
      $sql4 = "call getChat(44,'Ayberk')";
        $result=@mysqli_query($dbc,$sql4);
        if ($result->num_rows > 0) {
            ?>
               <?php
            while($row=$result->fetch_assoc())
            {?>
              <?php
              echo $row['Message'];
                ?><?php
            }
          }
          else
          {
            echo"İlk Mesajı Siz Atın";
          }
       ?>

  </body>
</html>
