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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO emissions (id, `date`, hstart, hpat, hend, dureep1, dureep2, emission, plt, contenu, datediff, ctr, scripte, tsev, tses, tsel, cartonfin, fauxdepart, envnodal, envfinale, commentaires, duree, lieu, fichier) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['daterec'], "date"),
                       GetSQLValueString($_POST['hstart'], "date"),
                       GetSQLValueString($_POST['hpat'], "date"),
                       GetSQLValueString($_POST['hend'], "date"),
                       GetSQLValueString($_POST['dureep1'], "date"),
                       GetSQLValueString($_POST['dureep2'], "date"),
                       GetSQLValueString($_POST['emission'], "text"),
                       GetSQLValueString($_POST['plateau'], "text"),
                       GetSQLValueString($_POST['contenu'], "text"),
                       GetSQLValueString($_POST['datediff'], "date"),
                       GetSQLValueString($_POST['ctr'], "text"),
                       GetSQLValueString($_POST['scripte'], "text"),
                       GetSQLValueString($_POST['tsev'], "text"),
                       GetSQLValueString($_POST['tses'], "text"),
                       GetSQLValueString($_POST['tsel'], "text"),
                       GetSQLValueString(isset($_POST['cartonfin']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['fauxdepart'], "text"),
                       GetSQLValueString($_POST['envnodal'], "text"),
                       GetSQLValueString(isset($_POST['envfinale']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['commentaires'], "text"),
					   GetSQLValueString($_POST['duree'], "text"),
					   GetSQLValueString($_POST['lieu'], "text"),
             GetSQLValueString($_POST['fichier'], "text"));

  mysql_select_db($database_Nodal, $Nodal);
  $Result1 = mysql_query($insertSQL, $Nodal) or die(mysql_error());

  $insertGoTo = "formemissions.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>