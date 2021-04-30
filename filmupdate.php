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
  $updateSQL = sprintf("UPDATE film SET film_id=%s, title=%s, description=%s, release_year=%s, original_language_id=%s, language_id=%s, rental_duration=%s, rental_rate=%s, length=%s, replacement_cost=%s, rating=%s, special_features=%s, last_update=%s WHERE film_id=%s",
                       GetSQLValueString($_POST['film_id'], "int"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['release_year'], "date"),
                       GetSQLValueString($_POST['original_language_id'], "int"),
                       GetSQLValueString($_POST['language_id'], "int"),
                       GetSQLValueString($_POST['rental_duration'], "int"),
                       GetSQLValueString($_POST['rental_rate'], "text"),
                       GetSQLValueString($_POST['length'], "int"),
					   GetSQLValueString($_POST['replacement_cost'], "text"),
					   GetSQLValueString($_POST['rating'], "text"),
					   GetSQLValueString($_POST['special_features'], "text"),
					   GetSQLValueString($_POST['last_update'], "date"));

  mysql_select_db($database_cousework_2, $cousework_2);
  $Result1 = mysql_query($updateSQL, $cousework_2) or die(mysql_error());

  $updateGoTo = "film.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}



$colname_Recordset1 = "-1";
if (isset($_GET['film_id'])) {
  $colname_Recordset1 = $_GET['film_id'];
}
mysql_select_db($database_cousework_2, $cousework_2);
$query_Recordset1 = sprintf("SELECT * FROM film WHERE film_id = %s", GetSQLValueString($colname_Recordset1, "int"));
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
<h1 align="center">UPDATE FILM INFORMATION</h1>
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
<form action="<?php echo $row_Recordset1['']; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Film_id:</td>
      <td><?php echo $row_Recordset1['film_id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Title:</td>
      <td><input type="text" name="title" value="<?php echo htmlentities($row_Recordset1['title'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Description:</td>
      <td><input type="text" name="description" value="<?php echo htmlentities($row_Recordset1['description'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Release_year:</td>
      <td><input type="text" name="release_year" value="<?php echo htmlentities($row_Recordset1['release_year'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Original_language_id:</td>
      <td><input type="text" name="original_language_id" value="<?php echo htmlentities($row_Recordset1['original_language_id'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Language_id:</td>
      <td><input type="text" name="language_id" value="<?php echo htmlentities($row_Recordset1['language_id'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rental_duration:</td>
      <td><input type="text" name="rental_duration" value="<?php echo htmlentities($row_Recordset1['rental_duration'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rental_rate:</td>
      <td><input type="text" name="rental_rate" value="<?php echo htmlentities($row_Recordset1['rental_rate'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">length:</td>
      <td><input type="text" name="length" value="<?php echo htmlentities($row_Recordset1['length'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Replacement_cost:</td>
      <td><input type="text" name="replacement_cost" value="<?php echo htmlentities($row_Recordset1['replacement_cost'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">rating:</td>
      <td><input type="text" name="rating" value="<?php echo htmlentities($row_Recordset1['rating'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">special_features:</td>
      <td><input type="text" name="special_features" value="<?php echo htmlentities($row_Recordset1['special_features'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
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
  <input type="hidden" name="film_id" value="<?php echo $row_Recordset1['film_id']; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center"><a href="film.php"><img src="image/back-button.png" alt="" width="83" height="34" /></a> </p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
