<?php require_once('Connections/Nodal.php'); ?>
<?php
$colname_Resultats = "-1";
if (isset($_POST['recherche'])) {
  $colname_Resultats = (get_magic_quotes_gpc()) ? $_POST['recherche'] : addslashes($_POST['recherche']);
}
mysql_select_db($database_Nodal, $Nodal);
$query_Resultats = sprintf("SELECT `datediff`, id, hstart, hend, contenu, emission, ctr, scripte, tsev, tses, tsel, duree, dureep1, dureep2, fauxdepart FROM emissions WHERE contenu LIKE '%%%s%%' OR ctr LIKE '%%%s%%' OR scripte LIKE '%%%s%%' OR tsev LIKE '%%%s%%' OR emission LIKE '%%%s%%' OR tses LIKE '%%%s%%' OR tsel LIKE '%%%s%%'ORDER BY `datediff`", $colname_Resultats,$colname_Resultats,$colname_Resultats,$colname_Resultats,$colname_Resultats,$colname_Resultats,$colname_Resultats);
$Resultats = mysql_query($query_Resultats, $Nodal) or die(mysql_error());
$row_Resultats = mysql_fetch_assoc($Resultats);
$totalRows_Resultats = mysql_num_rows($Resultats);
?>

<script language="JavaScript" type="text/JavaScript">
<!--
function BRB_PHP_DelWithCon(deletepage_url,field_name,field_value,messagetext) { //v1.0 - Deletes a record with confirmation
  if (confirm(messagetext)==1){
  	location.href = eval('\"'+deletepage_url+'?'+field_name+'='+field_value+'\"');
  }
}
//-->
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="Css/emission.css" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" type="text/css" href="Css/print.css" media="print" /> 

<style type="text/css">
<!--
@page { size:landscape; }
.Style1 {font-family: Arial, Helvetica, sans-serif}
.Style4 {font-family: Arial, Helvetica, sans-serif; color: #333333; }
.Style6 {font-family: Arial, Helvetica, sans-serif; color: #666666; font-size: 14px; }
-->
</style>
</head>

<body>

<div class="page">
<?php if ($totalRows_Resultats > 0) { // Show if recordset not empty ?>
  <p align="left">La recherche a donn&eacute; : <a href="resultats_print.php"></a></p>
  <table width="980" border="1" cellspacing="0">
    <tr>
      <th width="70" scope="col"><span class="Style1">Date</span></th>
      <th width="80" class="Style1" scope="col">Catégorie</th>
      <th width="170" class="Style1" scope="col">Titre</th>
      <th width="320" scope="col"><span class="Style1">Invit&eacute;s / Synth&eacute;s</span></th>
      <td width="80" class="Style1">Dur&eacute;e</td>
      <td width="80" class="Style1">ID</td>
      <td width="40"><div align="center" class="Style1">DVD <a href="resultats_print.php"></a> </div></td>
      <td width="60"><span class="Style6">Modif / Suppr </span></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><span class="Style6"><?php echo $row_Resultats['datediff']; ?></span></td>
        <td><div align="center"><span class="Style4"><?php echo $row_Resultats['emission']; ?></span>
            </p>
            <span class="Style4">N&deg; <?php echo $row_Resultats['dureep1']; ?></span></div>
          </span></td>
        <td><span class="Style4"><?php echo $row_Resultats['contenu']; ?></span></td>
        <td><ul>
		  <li class="Style4"><?php echo $row_Resultats['ctr']; ?></li>
		  <li class="Style4"><?php echo $row_Resultats['scripte']; ?></li>
		  <li class="Style4"><?php echo $row_Resultats['tsev']; ?></li>
		  <li class="Style4"><?php echo $row_Resultats['tses']; ?></li>
          <li class="Style4"><?php echo $row_Resultats['tsel']; ?></li>
        </ul></td>
        <td nowrap="nowrap" class="Style4"><?php echo $row_Resultats['duree']; ?></td>
        <td nowrap="nowrap" class="Style4"><?php echo $row_Resultats['dureep2']; ?></td>
        <td nowrap="nowrap"><p class="Style4"><?php echo $row_Resultats['fauxdepart']; ?></p></td>
        <td nowrap="nowrap"><div align="center"><a href="changeemissions.php?id=<?php echo $row_Resultats['id']; ?>"><img src="Fonds/modif.png" alt="modifier" width="16" height="16" border="0" align="middle" dynsrc="changeemissions.php?id=<?php echo $row_Resultats['id']; ?>" /></a> &nbsp;&nbsp;&nbsp;<a href="javascript:BRB_PHP_DelWithCon('delete.php','id',<?php echo $row_Resultats['id']; ?>,'Etes vous s&ucirc;r de vouloir supprimer la ligne?');"><img src="Fonds/sup.png" alt="supprimer" width="16" height="16" border="0" align="middle" /></a></div></td>
      </tr>
      <?php } while ($row_Resultats = mysql_fetch_assoc($Resultats)); ?>
  </table>
  <?php } // Show if recordset not empty ?><p>&nbsp;</p>
  <?php if ($totalRows_Resultats == 0) { // Show if recordset empty ?>
    <p>Il n'y a rien dans la base de donn&eacute;es .</p>
    <?php } // Show if recordset empty ?></body>
</html>
<?php
mysql_free_result($Resultats);
?>
</div>