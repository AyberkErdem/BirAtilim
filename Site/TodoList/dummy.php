<div class='row col-md-6 col-md-offset-2 custyle'>
   <table class='table table-striped custab'>
   <thead>
       <tr>
           <th>Sender</th>
           <th>Message</th>
           <th>Date</th>

           <th class='text-center'>Action</th>

       </tr>
   </thead>
   <?php
   require_once('config.php');
     $sql1 = "SELECT * FROM chat  where PosterId='".$_GET['subject']."'";
       $result=@mysqli_query($dbc,$sql1);
         if ($result->num_rows > 0) {
           ?>
              <?php
           while($row=$result->fetch_assoc())
           {?>
             <?php
             echo "<tr>
                 <td>".$row['Sender']."</td>
                 <td>".$row['Message']."</td>
                 <td>".$row['Date']."</td>
             </tr>";
               ?>

   <?php
           }
         }
         else
         {
           echo"İlk Mesajı Siz Atın";
         }
      ?>

          
   </table>
   </div>
