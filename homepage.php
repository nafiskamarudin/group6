<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "loginfailpage.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
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

<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  <p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p>
  <h1 align="center">WELCOME TO STAFF HOME PAGE</h1>
<p align="center">&nbsp;</p>
<p align="center"><a href="filmcategory.php"><img src="image/IMG_2805.PNG" width="184" height="64" /></a> <a href="film.php"><img src="image/IMG_2806.PNG" width="184" height="64" /></a> <a href="inventory.php"><img src="image/IMG_2807.PNG" width="184" height="64" /></a><a href="language.php"><img src="image/IMG_2808.PNG" width="184" height="64" /></a></p>
<p align="center"><a href="filmtext.php"><img src="image/IMG_2809.PNG" width="184" height="64" /></a> <a href="store.php"><img src="image/IMG_2810.PNG" width="184" height="64" /></a> <a href="rental.php"><img src="image/IMG_2811.PNG" width="184" height="64" /></a> <a href="category.php"><img src="image/IMG_2812.PNG" width="184" height="64" /></a></p>
<p align="center"><a href="customer.php"><img src="image/IMG_2813.PNG" width="184" height="64" /></a> <a href="staff.php"><img src="image/IMG_2814.PNG" width="184" height="64" /></a> <a href="actor.php"><img src="image/IMG_2815.PNG" width="184" height="64" /></a> <a href="filmactor.php"><img src="image/IMG_2816.PNG" width="184" height="64" /></a></p>
<p align="center"><a href="payment.php"><img src="image/IMG_2817.PNG" width="184" height="64" /></a> <a href="address.php"><img src="image/IMG_2818.PNG" width="184" height="64" /></a> <a href="city.php"><img src="image/IMG_2819.PNG" width="184" height="64" /></a> <a href="country.php"><img src="image/IMG_2820.PNG" width="184" height="64" /></a></p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><a href="<?php echo $logoutAction ?>"><img src="image/271-2715210_logout-button-icon-png.png" width="178" height="67" /></a></p>
<blockquote>
  <blockquote>
    <blockquote>
      <blockquote>
        <blockquote>
          <blockquote>
            <blockquote>
              <blockquote>
                <blockquote>
                  <p align="left">&nbsp;</p>
                </blockquote>
              </blockquote>
            </blockquote>
          </blockquote>
        </blockquote>
      </blockquote>
    </blockquote>
  </blockquote>
</blockquote>
</body>
</html>
