
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class='col-md-6'>
      <p class='text-primary'>Favori       <input type='checkbox' onclick='Favourite()' id='favori' value='Favori işaretle'></p>
    </div>
    <div class='col-md-6'>
      <p class='text-primary'>Favori       <input type='button' onclick='deleteCookie("favori")' id='favori' value='Favori işaretle'></p>
    </div>

  </body>
  <script type="text/javascript">
  function Favourite()
  {
    if (document.getElementById('favori').checked)
    {
      var credit=getCookie("favori");
        setCookie("favori",credit+"|"+<?php echo "45" ;?>,30);
            alert(getCookie("favori"));
    } else {
      var str=getCookie("favori");
      var credit=str.replace("|"+<?php echo "45"; ?>, "");
      deleteCookie(name);
      setCookie("favori",credit,30);
      alert(getCookie("favori"));
    }
  }
  function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=../DummyTests/";
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
function deleteCookie(name)
{

  document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  alert(getCookie(favori));

}

function checkCookie() {
  var user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}
  </script>
</html>
var Name="<?php echo $_GET['user']; ?>";

if (document.getElementById('favori').checked==true)
{
  var credit=getCookie(Name);
  if(credit=="")
  {
    setCookie(Name,<?php echo $_GET['subject'] ;?>,30);
  }
  else
  {
    setCookie(Name,credit+","+<?php echo $_GET['subject'] ;?>,30);
  }

alert(getCookie(Name));

} else {
  var str=getCookie(Name);
  var x=str.search(",");
  if(x!="-1")
  {
    if(str.replace(","+<?php echo $_GET['subject']; ?>, "")!=str)
    {
  var credit=str.replace(","+<?php echo $_GET['subject']; ?>, "");
  deleteCookie(Name);
  setCookie(Name,credit,30);
    alert(getCookie(Name));
    }
    else if(str.replace(","+<?php echo $_GET['subject']; ?>, "")==str)
    {
  var credit=str.replace(<?php echo $_GET['subject']; ?>+",", "");
  deleteCookie(Name);
  setCookie(Name,credit,30);
    alert(getCookie(Name));
    }
  }
    else
    {
        deleteCookie(Name);
          alert(getCookie(Name));
    }

}
