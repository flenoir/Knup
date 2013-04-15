<?php require_once('Connections/Nodal.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM emissions WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_Nodal, $Nodal);
  $Result1 = mysql_query($deleteSQL, $Nodal) or die(mysql_error());

  $deleteGoTo = "Jellyfish.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM emissions WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_Nodal, $Nodal);
  $Result1 = mysql_query($deleteSQL, $Nodal) or die(mysql_error());

  $deleteGoTo = "Jellyfish.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Resultats = "-1";
if (isset($_GET['id'])) {
  $colname_Resultats = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_Nodal, $Nodal);
$query_Resultats = sprintf("SELECT * FROM emissions WHERE id = %s", $colname_Resultats);
$Resultats = mysql_query($query_Resultats, $Nodal) or die(mysql_error());
$row_Resultats = mysql_fetch_assoc($Resultats);
$totalRows_Resultats = mysql_num_rows($Resultats);

$colname_Recordset4 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset4 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_Nodal, $Nodal);
$query_Recordset4 = sprintf("SELECT * FROM emissions WHERE id = %s", $colname_Recordset4);
$Recordset4 = mysql_query($query_Recordset4, $Nodal) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Document sans nom</title>
</head>

<body>
</body>
</html>
<?php
mysql_free_result($row_Resultats);

mysql_free_result($Recordset4);
?>
