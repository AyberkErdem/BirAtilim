<?php

if(isset($_POST['submit_image']))
{
  $datas=array("","","","","");
   $filename=$_FILES['upload_file']['name'];
  $tmpname=$_FILES['upload_file']['tmp_name'];
  $filetype=$_FILES['upload_file']['type'];
  for ($i=0; $i <=count($tmpname)-1 ; $i++) {
    $name=addslashes($filename[$i]);
    $tmp=addslashes(file_get_contents($tmpname[$i]));
    $datas[$i]=$tmp;
    echo $datas[$i];
  }
}

?>
<html>
<head>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script>
$(document).ready(function()
{
 $('form').ajaxForm(function()
 {
  alert("Uploaded SuccessFully");
 });
});

function preview_image()
{

document.getElementById(""+x+"").src=URL.createObjectURL(event.target.files[0]);
x++;
}
var x=0;
var y;
$(document).ready(function(){
$("#remover").click(function(){
  document.getElementById(""+y+"").src="";
  alert(x);
    x--;
      alert(x);
});
});
function reply_click(clicked_id)
  {
  y=clicked_id;


  }
</script>
</head>
<body>
<div id="wrapper">
 <form action="anotherdummy.php" method="post" enctype="multipart/form-data">
  <input type="file" id="upload_file" name="upload_file[]" onchange="preview_image();"/multiple>
  <input type="submit" name='submit_image' value="Upload Image"/>

 </form>
 <button id='remover'>Remove selected image</button>
 <div id="image_preview"></div>
 <img id='0' onclick="reply_click(this.id)" src="" alt="1.">
 <img id='1' onclick="reply_click(this.id)" src="" alt="2.">
 <img id='2' onclick="reply_click(this.id)" src="" alt="3.">
 <img id='3' onclick="reply_click(this.id)" src="" alt="4.">
 <img id='4' onclick="reply_click(this.id)" src="" alt="5.">
</div>
</body>
</html>
