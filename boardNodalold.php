<?php require_once('Connections/Nodal.php'); ?>
<?php 
// ne pas modifier les variables
$date = date("d-m-Y");
$Time = date("His");
$Time1 = "010000";//modification de la plage orange à -1 heure
$HTTP_POST_VARS['date']=$Time; 
$HTTP_POST_VARS['date1']=$Time1;
$HTTP_POST_VARS['datejour']=date("ymd");?>
<?php
$colname2_Recordset1 = "000000";
if (isset($HTTP_POST_VARS['datejour'])) {
  $colname2_Recordset1 = (get_magic_quotes_gpc()) ? $HTTP_POST_VARS['datejour'] : addslashes($HTTP_POST_VARS['datejour']);
}
$colname_Recordset1 = "130200";
if (isset($HTTP_POST_VARS['date'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $HTTP_POST_VARS['date'] : addslashes($HTTP_POST_VARS['date']);
}
$colname1_Recordset1 = "010000";
if (isset($HTTP_POST_VARS['date1'])) {
  $colname1_Recordset1 = (get_magic_quotes_gpc()) ? $HTTP_POST_VARS['date1'] : addslashes($HTTP_POST_VARS['date1']);
}
mysql_select_db($database_Nodal, $Nodal);
$query_Recordset1 = sprintf("SELECT * FROM bddnodal WHERE bddnodal.`date` ='%s'  AND `hstart` > '%s'+'%s' ORDER BY `Hstart` ASC", $colname2_Recordset1,$colname_Recordset1,$colname1_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $Nodal) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname1_Recordset2 = "050227";
if (isset($HTTP_POST_VARS['datejour'])) {
  $colname1_Recordset2 = (get_magic_quotes_gpc()) ? $HTTP_POST_VARS['datejour'] : addslashes($HTTP_POST_VARS['datejour']);
}
$colname_Recordset2 = "000000";
if (isset($HTTP_POST_VARS['date'])) {
  $colname_Recordset2 = (get_magic_quotes_gpc()) ? $HTTP_POST_VARS['date'] : addslashes($HTTP_POST_VARS['date']);
}
mysql_select_db($database_Nodal, $Nodal);
$query_Recordset2 = sprintf("SELECT * FROM bddnodal WHERE bddnodal.`date` ='%s' AND `hstart` <= '%s'  AND `hend`>='%s' ORDER BY `Hend` ASC", $colname1_Recordset2,$colname_Recordset2,$colname_Recordset2);
$Recordset2 = mysql_query($query_Recordset2, $Nodal) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname2_Recordset3 = "000000";
if (isset($HTTP_POST_VARS['datejour'])) {
  $colname2_Recordset3 = (get_magic_quotes_gpc()) ? $HTTP_POST_VARS['datejour'] : addslashes($HTTP_POST_VARS['datejour']);
}
$colname_Recordset3 = "125500";
if (isset($HTTP_POST_VARS['date'])) {
  $colname_Recordset3 = (get_magic_quotes_gpc()) ? $HTTP_POST_VARS['date'] : addslashes($HTTP_POST_VARS['date']);
}
$colname1_Recordset3 = "010000";
if (isset($HTTP_POST_VARS['date1'])) {
  $colname1_Recordset3 = (get_magic_quotes_gpc()) ? $HTTP_POST_VARS['date1'] : addslashes($HTTP_POST_VARS['date1']);
}
mysql_select_db($database_Nodal, $Nodal);
$query_Recordset3 = sprintf("SELECT * FROM bddnodal WHERE bddnodal.`date` ='%s'   AND (bddnodal.`hstart`>'%s' AND  bddnodal.`hstart` < '%s' + '%s') ORDER BY bddnodal.`hstart`", $colname2_Recordset3,$colname_Recordset3,$colname_Recordset3,$colname1_Recordset3);
$Recordset3 = mysql_query($query_Recordset3, $Nodal) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

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

<html>
<head>
<title>BoardNodal</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="60"> 
<link href="Css/board.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {font-size: 18}
-->
</style>
</head>

 <?PHP 
 if ($row_Recordset2['attendu']=="") // ou if (!isset($ton_info)) en fonction de ta façon de récupérer ta variable 
{ 
// tu n'affiches rien ou autre chose 
} 
else 
{ 
?> 


<div id="Table2">

<table width="100%" height="55" border="0" align="center" cellpadding="0" cellspacing="0">
  

    <?php do //affichage de l'heure et minute sans seconde pour l'heure de début et de fin de l'enregistrement
{   $Hdebut = $row_Recordset2['hstart'];
	$Hfin = $row_Recordset2['hend'];
		
	$h = substr($Hdebut, 0, 2);
	$m = substr($Hdebut, 3, 2);
	$debut="$h:$m";
	
	$h = substr($Hfin, 0, 2);
	$m = substr($Hfin, 3, 2);
	$fin ="$h:$m";
	
	$duree=$fin-$debut;
	$duree="$h:$m";
	$image = "";
	//conditions d'affichage des différentes images d'alerte .
		if ($Hdebut !="") { $image = "Fonds/p-rouge.gif" ;} else { $image = "Fonds/pixelblanc.jpg";}
	//conditions d'alerte audio	 
	  ?>
  <tr>
    <td width="10%" height="50" align="center" nowrap bgcolor="#F9FCFF" class="textREC1"><?php echo $debut ; ?></td>
    <td width="10%" height="50" align="center" nowrap bgcolor="#F9FCFF" class="textREC1"><?php echo $fin; ?> </td>
    <td width="8%" height="50" colspan="2" nowrap bgcolor="#F9FCFF" class="TEXTEDUREE"><?php echo $duree ; ?>
    <div align="center"></div>    </td>
    <td width="17%" height="50" align="left" nowrap bgcolor="#F9FCFF" class="textecoordonnee"><?php echo $row_Recordset2['source']; ?><span class="textecoordonnee2"><br>
      </span></td>
    <td height="50" colspan="2" align="left" bgcolor="#F9FCFF" class="textREC">&nbsp;<span class="textREC"><?php echo ucwords($row_Recordset2['attendu']); ?></span></td>
    <td width="21%" height="50" colspan="2" nowrap bgcolor="#F9FCFF" class="textechamps2"><div align="right"><span class="textREC"><img src="<?php echo $image; ?>" width="30" height="30" align="right"></span><span class="textecoordonnee">&nbsp;</span><span class="textREC1"><?php echo strtoupper($row_Recordset2['via']); ?></span><span class="textREC">&nbsp;</span></div>    </td>
  </tr>
  <tr bgcolor="#FF6600">
    <td height="5" colspan="9" nowrap class="petit"></td>
  </tr>
  <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
  
</table>
</div>

<?PHP // ligne 82
} 
?> 


<?PHP 
 if ($row_Recordset3['attendu']=="") // ou if (!isset($ton_info)) en fonction de ta façon de récupérer ta variable 
{ 
// tu n'affiches rien ou autre chose 
} 
else 
{ 
?>



<div id="Table3">

<table width="100%" height="0" border="0" align="center" cellpadding="0" cellspacing="0">
  

    <?php do //affichage de l'heure et minute sans seconde pour l'heure de début et de fin de l'enregistrement
{   $Time = date("His");
	$Hdebut = $row_Recordset3['hstart'];
	$Hfin = $row_Recordset3['hend'];
	
	$h = substr($Hdebut, 0, 2);
	$m = substr($Hdebut, 3, 2);
	$debut="$h:$m";
	
	$h = substr($Hfin, 0, 2);
	$m = substr($Hfin, 3, 2);
	$fin ="$h:$m";
	
	$imageset3 = "";
	//conditions d'affichage des différentes images d'alerte .
		//if ($Hdebut == ""){ $image = "Fonds/pixelblanc.jpg";} 
		//elseif (($Hdebut >= $time  ) and ($time >= $Hdebut - $cinq )) { $image = "Fonds/5.gif" ;} else { $image = "Fonds/pixelblanc.jpg";}
		if ($row_Recordset3['theme']=="duplex"){$imageset3 = "Fonds/alerte.gif";} else { $imageset3 = "Fonds/pixelblanc.jpg";}
		if ($row_Recordset3['attendu']=="foot"){$imageset3 = "Fonds/ballon.gif";} else { $imageset3 = "Fonds/pixelblanc.jpg";}
	
	
	?>
  <tr>
    <td width="10%" height="50" align="center" nowrap bgcolor="#FFCC66" class="textecoordonnee2"><?php echo $debut; ?> </td>
    <td width="8%" height="50" align="center" nowrap bgcolor="#FFCC66" class="textecoordonnee2">  <?php echo $fin; ?></td>
    <td width="23" height="50" bgcolor="#FFCC66" class="TEXTEDUREE"><p align="center"><a href="formchange.php?id=<?php echo $row_Recordset3['id']; ?>"> <img src="Fonds/modif.png" alt="modifier" width="16" height="16" border="0" align="right" dynsrc="formchange.php?id=<?php echo $row_Recordset3['id']; ?>"></a></p>    </td>
    <td width="38" height="50" align="center" bgcolor="#FFCC66" class="TEXTEDUREE"><a href="javascript:BRB_PHP_DelWithCon('delete.php','id',<?php echo $row_Recordset3['id']; ?>,'Etes vous sûr de vouloir supprimer la ligne?');"><img src="Fonds/sup.png" alt="supprimer" width="14" height="15" hspace="10" border="0" align="absmiddle"></a><a href="javascript:BRB_PHP_DelWithCon('delete.php','id',<?php echo $row_Recordset3['id']; ?>,'Etes vous sûr de vouloir supprimer la ligne?');"></a></td>
    <td width="100" height="50" align="left" nowrap bgcolor="#FFCC66"><div align="left"><span class="textecoordonnee">ORG
      : </span><span class="textechamps2"><?php echo $row_Recordset3['source']; ?></span><span class="textecoordonnee"><br>
  &nbsp;VIA : </span><span class="textecoordonnee2"><a href="#" target="_blank" class="textechamps2" onClick="window.open('config.php?openfiche=<?php echo $row_Recordset3['id'] ?>','_blank','toolbar=0, location=0, directories=0, status=0, scrollbars=0, resizable=0, copyhistory=0, menuBar=0, width=700, height=400');return(false)"><?php echo strtoupper($row_Recordset3['via']); ?></a></span><a href="formchange.php?bddnodal=<?php echo $row_Recordset4['id']; ?>"></a><br>
    <span class="textecoordonnee"> </span></div></td>
    <td width="329" height="50" align="left" bgcolor="#FFCC66" class="textecontenue"><div align="left"><img src="<?php echo $imageset3 ;?>"align="left"30><span class="textecontenue">&nbsp;</span><span class="textecoordonnee2"><?php echo $row_Recordset3['attendu']; ?></span></div></td>
  </tr>
  <tr>
    <td height="5" colspan="6" nowrap bgcolor="#FF9933"></td>
  </tr>
  <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
 
</table>
</div>


<?PHP // ligne 173
} 
?> 

 <?PHP 
 if ($row_Recordset1['attendu']=="") // ou if (!isset($ton_info)) en fonction de ta façon de récupérer ta variable 
{ 
// tu n'affiches rien ou autre chose 
} 
else 
{ 
?> 


<div id="Table1">

<table width="100%" height="55" border="0" align="center" cellpadding="0" cellspacing="0">
  

    
  <?php do //affichage de l'heure et minute sans seconde pour l'heure de début et de fin de l'enregistrement
{   $Hdebut = $row_Recordset1['hstart'];
	$Hfin = $row_Recordset1['hend'];
		
	$h = substr($Hdebut, 0, 2);
	$m = substr($Hdebut, 3, 2);
	$debut="$h:$m";
	
	$h = substr($Hfin, 0, 2);
	$m = substr($Hfin, 3, 2);
	$fin ="$h:$m";
	?>
  <tr>
    <td width="10%" height="50" align="center" nowrap bgcolor="#F9FCFF" class="textecoordonnee2"><?php echo $debut; ?></td>
    <td width="8%" height="50" align="center" nowrap bgcolor="#F9FCFF" class="textecoordonnee2"><?php echo $fin; ?></td>
    <td width="23" height="50" bgcolor="#F9FCFF" class="TEXTEDUREE"><a href="formchange.php?id=<?php echo $row_Recordset1['id']; ?>"><img src="Fonds/modif.png" alt="modif" width="16" height="16" border="0" align="right"></a></td>
    <td width="38" height="50" align="center" bgcolor="#F9FCFF" class="TEXTEDUREE"><a href="javascript:BRB_PHP_DelWithCon('delete.php','id',<?php echo $row_Recordset1['id']; ?>,'Etes vous sûr de vouloir supprimer la ligne?');"><img src="Fonds/sup.png" alt="supprimer" width="14" height="15" hspace="10" border="0" align="absmiddle"></a></td>
    <td width="100" height="50" align="left" valign="top" nowrap bgcolor="#F9FCFF"><span class="textecoordonnee">ORG
        : </span><span class="textechamps2"><?php echo $row_Recordset1['source']; ?></span><span class="textecoordonnee"><br>
&nbsp;Via : </span><span class="textecoordonnee2"><a href="#" class="textechamps2"><?php echo strtoupper($row_Recordset1['via']); ?></a></span><br>    </td>
    <td width="329" height="50" colspan="2" align="left" bgcolor="#F9FCFF" class="textecontenue"> <span class="textecontenue">&nbsp;</span><span class="textecoordonnee2"><?php echo $row_Recordset1['attendu']; ?></span> </td>
  </tr>
  <tr bgcolor="#C2DBFC">
    <td height="5" colspan="7" nowrap></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</div>

<?PHP // ligne 173
} 
?> 


</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
