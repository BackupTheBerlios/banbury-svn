<?php
if(isset($_POST['UserName']) && isset($_POST['Mail'])){
	include("php/NewPass.php");
	include("Content/Erfolg.html");
}elseif(UserLoggedIn()){
	include("Content/LoggedIn.html");
}else{
	include("Content/index.html");
}
?>