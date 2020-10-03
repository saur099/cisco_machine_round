<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["submit"])) {
    $query = "INSERT INTO `router`(`sapid`, `hostname`, `loopback`, `mac_address`, `remarks`) VALUES ('".$_POST["sapid"]."','".$_POST["hostname"]."','".$_POST["loopback"]."','".$_POST["mac"]."','".$_POST["remarks"]."')";
        $result = $db_handle->executeQuery($query);
    if(!$result){
			$message="Problem in Adding to database. Please Retry.";
	} else {
		header("Location:index.php");
	}
}
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
	if(!$("#mac").val()) {
		$("#category-info").html("(required)");
		$("#mac").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#loopback").val()) {
		$("#price-info").html("(required)");
		$("#loopback").css('background-color','#FFFFDF');
		valid = false;
	}	
	
	return valid;
}

// Validation on Router
function host() 
{
   var maxLength = 18;
   var host = $("#hostname").val();
   //alert(host.length);
   if ( isNaN(host) ) { 
	 $("#name-info").html("(integer should be there)");
   $("#name").css('background-color','#FFFFDF'); return false; }
   else
   {
	   if(host.length == maxLength)  return false;
		else
		{
		 $("#name-info").html("(Must be 18 character)");
		 $("#name").css('background-color','#FFFFDF'); 
		 return true;
		}
   }
   
   
}
// Validation on Router
function sapid() 
{
   var maxLength = 18;
   var sapid = $("#sapid").val();
   //alert(host.length);
   if ( isNaN(sapid) ) { 
	 $("#name-info").html("(integer should be there)");
     $("#name").css('background-color','#FFFFDF'); return false; }
   else
   {
	   if(sapid.length == maxLength)  return false;
		else
		{
		 $("#name-info").html("(Must be 18 character)");
		 $("#name").css('background-color','#FFFFDF'); 
		 return true;
		}
   }
}
</script>
<form name="frmToy" method="post" action="" id="frmToy" onClick="return validate();">
<div id="mail-status"></div>
<div>
<label style="padding-top:20px;">Host Name</label>
<span id="name-info" class="info"></span><br/>
<input type="text" name="hostname" onKeyPress="return host();" id="hostname" maxlength="18" class="demoInputBox">
</div>
<div>
<label>SAPID</label>
<span id="code-info" class="info"></span><br/>
<input type="text" name="sapid" id="sapid" onKeyPress="return sapid();" class="demoInputBox">
</div>
<div>
<label>Mac Address</label> 
<span id="category-info" class="info"></span><br/>
<input type="text" name="mac" id="mac" pattern='^(([\da-fA-F]{2}[-:]){5}[\da-fA-F]{2})$' class="demoInputBox">
</div>
<div>
<label>Loopback IPv4</label> 
<span id="price-info" class="info"></span><br/>
<input type="text" name="loopback" id="loopback"  pattern='((^|\.)((25[0-5]_*)|(2[0-4]\d_*)|(1\d\d_*)|([1-9]?\d_*))){4}_*$' class="demoInputBox">
</div>
<div>
<label>Remarks</label> 
<span id="stock_count-info" class="info"></span><br/>
<input type="text" name="remarks" id="remarks" class="demoInputBox">
</div>
<div>
<input type="submit" name="submit" id="btnAddAction" value="Add" />
</div>
</div>