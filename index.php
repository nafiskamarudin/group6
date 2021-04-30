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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "homepage.php";
  $MM_redirectLoginFailed = "loginfailpage.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_cousework_2, $cousework_2);
  
  $LoginRS__query=sprintf("SELECT username, password FROM staff WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $cousework_2) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
#form1 table tr td blockquote blockquote blockquote p {
	color: #00F;
}
</style>
</head>

<body background ="image\Grey-And-White-Background-0-items-0-client-centre.jpg">

<body>

<div class="header">
			<div>
				<div align="center"></div>

<form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">
  <p>&nbsp;</p>
  <p align="center"><img src="image/logo.png" width="100" height="100" /></p>
<p align="center">&nbsp;</p>
  <blockquote>
    <h1 align="center">SIGN IN TO YOUR ACCOUNT</h1>
    <p align="center">(STAFF ONLY)</p>
  </blockquote>
  <table width="532" height="253" align="center">
    <tr>
      <td width="132"><p>USERNAME</p></td>
      
      <td width="477"><p>
        <label for="username"></label>
        <input type="text" name="username" id="username" />
      </p>
      <h5>*For example: JohnStephens </h5></td>
    </tr>
    <tr>
      <td>PASSWORD</td>
      <td><p>
        <label for="password"></label>
        <input type="text" name="password" id="password" />
      </p>
      <h5>*For example: john123 </h5></td>
    </tr>
    <tr>
      <td height="63" colspan="2"><blockquote>
        <blockquote>
          <blockquote>
            <h1 align="center">
              <input type="submit" name="submit" id="submit" value="login" />
            </h1>
            </blockquote>
          </blockquote>
        </blockquote></td>
    </tr>
  </table>
</form>
</body>
</html>