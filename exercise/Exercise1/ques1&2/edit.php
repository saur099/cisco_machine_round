<?php
error_reporting(E_ALL);
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["submit"])) {
   $query = "UPDATE `router` SET `hostname`='".$_POST["hostname"]."', `loopback`='".$_POST["loopback"]."', `mac_address`='".$_POST["mac_address"]."', `sapid`='".$_POST["sapid"]."' WHERE `router`.`id` = ".$_GET["id"];
   //echo $query; die;
    $result = $db_handle->executeQuery($query);
	if(!$result){
		$message = "Problem in Editing! Please Retry!";
	} else {
		header("Location:index.php");
	}
}
$result = $db_handle->runQuery("SELECT * FROM router WHERE id='" . $_GET["id"] . "'");
?>
<link href="style.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function validate() {
	var valid = true;	
	$(".demoInputBox").css('background-color','');
	$(".info").html('');
	
	if(!$("#hostname").val()) {
		$("#name-info").html("(required)");
		$("#name").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#sapid").val()) {
		$("#code-info").html("(required)");
		$("#sapid").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#mac_address").val()) {
		$("#category-info").html("(required)");
		$("#mac_address").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#loopback").val()) {
		$("#price-info").html("(required)");
		$("#loopback").css('background-color','#FFFFDF');
		valid = false;
	}	
	
	return valid;
}
</script>
<form name="frmToy" method="post" action="" id="frmToy" onClick="return validate();">
<div id="mail-status"></div>
<div>
<label style="padding-top:20px;">Host Name</label>
<span id="name-info" class="info"></span><br/>
<input type="text" name="hostname" id="hostname" value="<?php echo $result[0]["hostname"]; ?>" class="demoInputBox">
</div>
<div>
<label>SAPID</label>
<span id="code-info" class="info"></span><br/>
<input type="text" name="sapid" id="sapid" value="<?php echo $result[0]["sapid"]; ?>" class="demoInputBox">
</div>
<div>
<label>Mac Address</label> 
<span id="category-info" class="info"></span><br/>
<input type="text" name="mac_address" id="mac_address" value="<?php echo $result[0]["mac_address"]; ?>" class="demoInputBox">
</div>
<div>
<label>Loopback</label> 
<span id="price-info" class="info"></span><br/>
<input type="text" name="loopback" id="loopback" value="<?php echo $result[0]["loopback"]; ?>" class="demoInputBox">
</div>
<div>
<label>Remarks</label> 
<span id="stock_count-info" class="info"></span><br/>
<input type="text" name="remarks" id="remarks" value="<?php echo $result[0]["remarks"]; ?>" class="demoInputBox">
</div>
<div>
<input type="submit" name="submit" id="btnAddAction" value="Save" />
</div>
</div>