<?php
include('../Php/config.php');
if(isset($_POST['submit_image']))
{
  $stopper=-1;
  $datas=array("","","","","");
    $urls=array();
if($_POST['im0']!="")
{
  $stopper=0;
}
if($_POST['im1']!="")
{
  $stopper=1;
}
if($_POST['im2']!="")
{
  $stopper=2;
}
if($_POST['im3']!="")
{
  $stopper=3;
}
if($_POST['im4']!="")
{
  $stopper=4;
}
    $filename=$_FILES['upload_file']['name'];
    $tmpname=$_FILES['upload_file']['tmp_name'];
    $filetype=$_FILES['upload_file']['type'];
      echo count($tmpname)-1;
    for ($i=0; $i <=count($tmpname)-1 ; $i++) {
      if($i==$stopper)
      {

      }
      else
      {
        $name=addslashes($filename[$i]);
        $tmp=addslashes(file_get_contents($tmpname[$i]));
        $datas[$i]=$tmp;
      }

    }
    $query=("insert into dummtable values('','".$datas[0]."','','".$datas[1]."','".$datas[2]."','".$datas[3]."','".$datas[4]."')");
    mysqli_query($dbc,$query);
/*
  for ($i=0; $i <count($urls) ; $i++) {
    $name=addslashes($filename[$i]);
      echo $name;
    $tmp=addslashes(file_get_contents($tmpname[$i]));
    $datas[$i]=$tmp;

  }
  */
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
  var items=new Array();
function preview_image()
{

  var total_file=document.getElementById("upload_file").files.length;
  x=0;
    document.getElementById("0").src="";
      document.getElementById("1").src="";
        document.getElementById("2").src="";
          document.getElementById("3").src="";
            document.getElementById("4").src="";

   for(var i=0;i<total_file;i++)
   {

  document.getElementById(""+x+"").src=URL.createObjectURL(event.target.files[i]);
  items[i]=event.target.files[i].name;
  x++;
   }




}
var x=0;
var y;
function remover(){
  document.getElementById(""+y+"").src="";
  document.getElementById(y+"hid").value= items[y];
}


function reply_click(clicked_id)
  {
  y=clicked_id;


  }
</script>
</head>
<body>
<div id="wrapper">
  <form action="anotherdummy.php" method="post" enctype="multipart/form-data">
   <input accept="image/jpeg" type="file" id="upload_file" name="upload_file[]" onchange="preview_image();" multiple/>
   <input type="submit" name='submit_image' value="Upload Image"/>
<input id='0hid' type="hidden" name='im0' value=""/>
<input id='1hid' type="hidden" name='im1' value=""/>
<input id='2hid'  type="hidden" name='im2' value=""/>
<input id='3hid' type="hidden" name='im3' value=""/>
<input id='4hid'  type="hidden" name='im4' value=""/>
 </form>
 <button onclick="remover()" id='remover'>Remove selected image</button>
 <div id="image_preview"></div>
 <img id='0' onclick="reply_click(this.id)" src="" alt="1.">
 <img id='1' onclick="reply_click(this.id)" src="" alt="2.">
 <img id='2' onclick="reply_click(this.id)" src="" alt="3.">
 <img id='3' onclick="reply_click(this.id)" src="" alt="4.">
 <img id='4' onclick="reply_click(this.id)" src="" alt="5.">
</div>
</body>
</html>
