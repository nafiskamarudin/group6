<?php require_once('Connections/cousework_2.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE rental SET rental_date=%s, inventory_id=%s, customer_id=%s, return_date=%s, staff_id=%s, last_update=%s WHERE rental_id=%s",
                       GetSQLValueString($_POST['rental_date'], "date"),
                       GetSQLValueString($_POST['inventory_id'], "int"),
                       GetSQLValueString($_POST['customer_id'], "int"),
                       GetSQLValueString($_POST['return_date'], "date"),
                       GetSQLValueString($_POST['staff_id'], "int"),
                       GetSQLValueString($_POST['last_update'], "date"),
                       GetSQLValueString($_POST['rental_id'], "int"));

  mysql_select_db($database_cousework_2, $cousework_2);
  $Result1 = mysql_query($updateSQL, $cousework_2) or die(mysql_error());

  $updateGoTo = "rental.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['rental_id'])) {
  $colname_Recordset1 = $_GET['rental_id'];
}
mysql_select_db($database_cousework_2, $cousework_2);
$query_Recordset1 = sprintf("SELECT * FROM rental WHERE rental_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $cousework_2) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body background ="image\Grey-And-White-Background-0-items-0-client-centre.jpg">

<body>

<div class="header">
			<div>
<div align="center"></div>

<p align="center"><img src="image/logo.png" width="100" height="100" /></p>
<p align="center">&nbsp;</p>
<h1 align="center">UPDATE RENTAL INFORMATION</h1>
<blockquote>
  <blockquote>
    <blockquote>
      <blockquote>
        <blockquote>
          <blockquote>
            <blockquote>
              <blockquote>
                <blockquote>&nbsp;</blockquote>
              </blockquote>
            </blockquote>
          </blockquote>
        </blockquote>
      </blockquote>
    </blockquote>
  </blockquote>
</blockquote>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rental_id:</td>
      <td><?php echo $row_Recordset1['rental_id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rental_date:</td>
      <td><input type="text" name="rental_date" value="<?php echo htmlentities($row_Recordset1['rental_date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Inventory_id:</td>
      <td><input type="text" name="inventory_id" value="<?php echo htmlentities($row_Recordset1['inventory_id'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Customer_id:</td>
      <td><input type="text" name="customer_id" value="<?php echo htmlentities($row_Recordset1['customer_id'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Return_date:</td>
      <td><input type="text" name="return_date" value="<?php echo htmlentities($row_Recordset1['return_date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Staff_id:</td>
      <td><input type="text" name="staff_id" value="<?php echo htmlentities($row_Recordset1['staff_id'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Last_update:</td>
      <td><input type="text" name="last_update" value="<?php echo htmlentities($row_Recordset1['last_update'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="rental_id" value="<?php echo $row_Recordset1['rental_id']; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center"><a href="rental.php"><img src="image/back-button.png" alt="" width="83" height="34" /></a> </p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
