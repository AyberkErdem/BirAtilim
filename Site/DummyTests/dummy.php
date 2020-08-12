<?php
$_GET['favori']="47,44";
$_GET['user']="Erdem";
 ?>
<script type="text/javascript">
window.location="../Php/MyPostersJson.php?user=<?php if(isset($_GET['favori'])){echo"".$_GET['user']."&favori=".$_GET['favori']."";}else {echo $_GET['user'];}  ?>";
</script>
