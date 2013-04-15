<?php require_once('Connections/Nodal.php'); ?>
<?php
$colname_ResDate = "-1";
if (isset($_POST['rechdate'])) {
  $colname_ResDate = (get_magic_quotes_gpc()) ? $_POST['rechdate'] : addslashes($_POST['rechdate']);
}
mysql_select_db($database_Nodal, $Nodal);
$query_ResDate = sprintf("SELECT `date`, id, hstart, hend, contenu, emission, ctr, scripte, tsev, tses, tsel, fauxdepart FROM emissions WHERE `date` = '%s'", $colname_ResDate);
$ResDate = mysql_query($query_ResDate, $Nodal) or die(mysql_error());
$row_ResDate = mysql_fetch_assoc($ResDate);
$totalRows_ResDate = mysql_num_rows($ResDate);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="Css/emission.css" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" type="text/css" href="Css/print.css" media="print" /> 

<style type="text/css">
<!--
.Style1 {font-family: Arial, Helvetica, sans-serif}
.Style4 {font-family: Arial, Helvetica, sans-serif; color: #CCCCCC; }
.Style6 {font-family: Arial, Helvetica, sans-serif; color: #CCCCCC; font-size: 14px; }
-->
</style>
</head>

<body>

<div class="page">
<?php if ($totalRows_ResDate > 0) { // Show if recordset not empty ?>
  <p align="left">La recherche a donn&eacute; : <a href="resultats_print.php"></a></p>
  <table width="960" border="1" cellspacing="0">
    <tr>
      <th width="101" scope="col"><span class="Style1">Date</span></th>
      <th width="170" scope="col"><span class="Style1">Titre</span></th>
      <th width="80" class="Style1" scope="col">Catégorie</th>
      <th width="400" scope="col"><span class="Style1">Invit&eacute;s / Synth&eacute;s</span></th>
      <td width="80"><div align="center" class="Style1">DVD <a href="resultats_print.php"></a> </div></td>
      <td width="20"><span class="Style1">Modifier</span></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><span class="Style6"><?php echo $row_ResDate['date']; ?></span></td>
        <td><div align="center"><span class="Style4"><?php echo $row_ResDate['contenu']; ?></span></div></td>
        <td><div align="center"><span class="Style4"><?php echo $row_ResDate['emission']; ?></span></div></td>
        <td><ul>
		  <li class="Style4"><?php echo $row_ResDate['ctr']; ?></li>
		  <li class="Style4"><?php echo $row_ResDate['scripte']; ?></li>
		  <li class="Style4"><?php echo $row_ResDate['tsev']; ?></li>
		  <li class="Style4"><?php echo $row_ResDate['tses']; ?></li>
          <li class="Style4"><?php echo $row_ResDate['tsel']; ?></li>
		  </ul></td>
        <td nowrap="nowrap"><p align="center" class="Style4"><?php echo $row_ResDate['fauxdepart']; ?></p></td>
        <td nowrap="nowrap"><div align="center"><a href="changeemissions.php?id=<?php echo $row_ResDate['id']; ?>"><img src="Fonds/modif.png" alt="modifier" width="16" height="16" border="0" align="middle" dynsrc="changeemissions.php?id=<?php echo $row_ResDate['id']; ?>" /></a></div></td>
      </tr>
      <?php } while ($row_ResDate = mysql_fetch_assoc($ResDate)); ?>
  </table>
  <?php } // Show if recordset not empty ?><p>&nbsp;</p>
  <?php if ($totalRows_ResDate == 0) { // Show if recordset empty ?>
    <p>Il n'y a rien dans la base de donn&eacute;es .</p>
    <?php } // Show if recordset empty ?></body>
</html>
<?php
mysql_free_result($ResDate);
?>
</div>