<?php
	require_once("perpage.php");	
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	
	$name = "";
	$code = "";
	
	$queryCondition = "";
	if(!empty($_POST["search"])) {
		foreach($_POST["search"] as $k=>$v){
			if(!empty($v)) {

				$queryCases = array("name","code");
				if(in_array($k,$queryCases)) {
					if(!empty($queryCondition)) {
						$queryCondition .= " AND ";
					} else {
						$queryCondition .= " WHERE ";
					}
				}
				switch($k) {
					case "name":
						$name = $v;
						$queryCondition .= "hostname LIKE '" . $v . "%'";
						break;
					case "code":
						$code = $v;
						$queryCondition .= "mac_address LIKE '" . $v . "%'";
						break;
				}
			}
		}
	}
	$orderby = " ORDER BY id desc"; 
	$sql = "SELECT * FROM router " . $queryCondition;
	$href = 'index.php';					
		
	$perPage = 2; 
	$page = 1;
	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}
	$start = ($page-1)*$perPage;
	if($start < 0) $start = 0;
		
	$query =  $sql . $orderby .  " limit " . $start . "," . $perPage; 
	$result = $db_handle->runQuery($query);
	
	if(!empty($result)) {
		$result["perpage"] = showperpage($sql, $perPage, $href);
	}
?>
<html>
	<head>
	<title>Router CRUD</title>
	<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<h2>Router CRUD</h2>
		<div style="text-align:right;margin:20px 0px 10px;">
		<a id="btnAddAction" href="add.php">Add New</a>
		</div>
    <div id="toys-grid">      
			<form name="frmSearch" method="post" action="index.php">
			<div class="search-box">
			<p><input type="text" placeholder="HostName" name="search[name]" class="demoInputBox" value="<?php echo $name; ?>"	/><input type="text" placeholder="MAC Address" name="search[code]" class="demoInputBox" value="<?php echo $code; ?>"	/><input type="submit" name="go" class="btnSearch" value="Search"><input type="reset" class="btnSearch" value="Reset" onclick="window.location='index.php'"></p>
			</div>
			
			<table cellpadding="10" cellspacing="1">
			<thead>
					<tr>
					  <th><strong>HostName</strong></th>
					  <th><strong>SAPID</strong></th>          
					  <th><strong>MAC Address</strong></th>
					  <th><strong>Loopback</strong></th>
					  <th><strong>Remarks</strong></th>
					</tr>
			</thead>
			<tbody>
					<?php
					//print_r($result);
					if(!empty($result)) {
						foreach($result as $k=>$v) {
						  if(is_numeric($k)) {
					?>
          <tr>
					<td><?php echo $result[$k]["hostname"]; ?></td>
					<td><?php echo $result[$k]["sapid"]; ?></td>
					<td><?php echo $result[$k]["mac_address"]; ?></td>
					<td><?php echo $result[$k]["loopback"]; ?></td>
					<td><?php echo $result[$k]["remarks"]; ?></td> 
					<td>
					<a class="btnEditAction" href="edit.php?id=<?php echo $result[$k]["id"]; ?>">Edit</a> <a class="btnDeleteAction" href="delete.php?action=delete&id=<?php echo $result[$k]["id"]; ?>">Delete</a>
					</td>
					</tr>
					<?php
						  }
					   }
                    }
					if(isset($result["perpage"])) {
					?>
					<tr>
					<td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
					</tr>
					<?php } ?>
				<tbody>
			</table>
			</form>	
		</div>
	</body>
</html>