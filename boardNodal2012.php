<?php require_once('Connections/Nodal.php'); ?>
<?php 
// ne pas modifier les variables
$date = date("Y-m-d");
$Time = date("His");

?>

<?
//passage en format de date /heure en francais
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
?>


<?php

// Recordset2

mysql_select_db($database_Nodal, $Nodal);
$query_Recordset2 = sprintf("SELECT * FROM emissions WHERE emissions.`date`='$date' ORDER BY `date`ASC",$colname1_Recordset2);
$Recordset2 = mysql_query($query_Recordset2, $Nodal) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);



// Recordset4


mysql_select_db($database_Nodal, $Nodal);
$query_Recordset4 = sprintf("SELECT * FROM cameras WHERE cameras.`hret`='%s'IS NULL ORDER BY `dateout`ASC",$colname2_Recordset4);
$Recordset4 = mysql_query($query_Recordset4, $Nodal) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);





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
.Style3 {
	color: #333333;
	font-size: 24px;
}
.Style6 {font-size: 18px}
.Style9 {font-size: 24; color: #999999;}
-->
</style>
</head>



<?php if ($totalRows_Recordset2 > 0) { // Show if recordset not empty ?>

<div id="Table1">

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
    <td width="10%" height="50" align="center" nowrap bgcolor="#E9F2F3" class="textREC1"><?php echo $fin; ?> </td>
    <td width="8%" height="50" colspan="2" nowrap bgcolor="#F9FCFF" class="TEXTEDUREE"><?php echo $duree ; ?>
    <div align="center"></div>    </td>
    <td width="17%" height="50" align="left" nowrap bgcolor="#F9FCFF" class="textecoordonnee"><?php echo $row_Recordset2['source']; ?><span class="textecoordonnee2"><br>
      </span></td>
    <td height="50" colspan="2" align="left" bgcolor="#F9FCFF" class="TEXTEDUREE">&nbsp;<span class="textecoordonnee2"><?php echo ucwords($row_Recordset2['contenu']); ?></span></td>

    <td width="3%"  class="TEXTEDUREE"><a href="changeemissions.php?id=<?php echo $row_Recordset2['id']; ?>"><img src="Fonds/modif.png" alt="modif" width="16" height="16" border="0" align="right"></a></td>
    <td width="3%"  align="center" class="TEXTEDUREE"><a href="javascript:BRB_PHP_DelWithCon('delete.php','id',<?php echo $row_Recordset2['id']; ?>,'Etes vous sûr de vouloir supprimer la ligne?');"><img src="Fonds/sup.png" alt="supprimer" width="14" height="15" hspace="10" border="0" align="absmiddle"></a></td>
 
    <td width="18%" height="50" colspan="2" nowrap bgcolor="#F9FCFF" class="textechamps2"><div align="right"><span class="textREC"><img src="<?php echo $image; ?>" width="30" height="30" align="right"></span><span class="textecoordonnee">&nbsp;</span><span class="textREC1"><?php echo strtoupper($row_Recordset2['via']); ?></span><span class="textREC">&nbsp;</span></div>    </td>
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


 
  
 <div id="Table5"></div>
  
  
    
  
<?php if ($totalRows_Recordset4 > 0) { // Show if recordset not empty ?>
  <div id="Table4">
    
	
    <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <?php do //affichage de l'heure et minute sans seconde pour l'heure de début et de fin de l'enregistrement
{   $dateout = $row_Recordset4['dateout'];
	$datein = $row_Recordset4['datein'];
	$Hdepart = $row_Recordset4['hdep'];
	$Hretour = $row_Recordset4['hret'];
		
	$h = substr($Hdepart, 0, 2);
	$m = substr($Hdepart, 3, 2);
	$hdep="$h:$m";
	
	$h = substr($Hretour, 0, 2);
	$m = substr($Hretour, 3, 2);
	$hret ="$h$m";
	?>
			
	
	
	
      <tr bgcolor="#E9F2F3">
        <td width="11%"  align="center" nowrap class="TEXTEDUREE"><?php echo $dateout; ?><br>
          <span class="textechamps2"><?php echo $hdep; ?></span></td>

        <td width="3%"  class="TEXTEDUREE"><a href="changecameras.php?id=<?php echo $row_Recordset4['id']; ?>"><img src="Fonds/modif.png" alt="modif" width="16" height="16" border="0" align="right"></a></td>
        <td width="3%"  align="center" class="TEXTEDUREE"><a href="javascript:BRB_PHP_DelWithCon('deletecameras.php','id',<?php echo $row_Recordset4['id']; ?>,'Etes vous sûr de vouloir supprimer la ligne?');"><img src="Fonds/sup.png" alt="supprimer" width="14" height="15" hspace="10" border="0" align="absmiddle"></a></td>
        <td width="12%" align="left" valign="top" nowrap><span class="textechamps2 Style3"><span class="textecoordonnee2"><?php echo $row_Recordset4['camera']; ?></span></span><span class="textecoordonnee"><br>
        </span><span class="textechamps2"><?php echo $row_Recordset4['DD']; ?><br>   
		<?php echo $row_Recordset4['hf']; ?></span></td>
		     </td>
        
		<td width="50%" colspan="2" align="left" valign="top" class="textecontenue"><p><span class="textecoordonnee2"><?php echo $row_Recordset4['emprunteur']; ?></span>            
          <p><span class="textechamps2"><?php echo $row_Recordset4['remarques']; ?></span><span class="textecoordonnee2"></span></p>
      </td>
	  <td width="10%"  align="left" valign="top" nowrap><span class="textechamps2 Style3"><span class="textecoordonnee2"><?php echo $row_Recordset4['voiture']; ?></span></span><span class="textecoordonnee"><br>
        </td>
	  	  <td width="8%"  align="center" nowrap class="TEXTEDUREE"><?php echo $datein; ?><br><?php echo $hret; ?></td>      </tr>
      <tr bgcolor="#C2DBFC">
        <td height="2" colspan="9" nowrap bgcolor="#4F6B8E"></td>
      </tr>
      <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
    </table>
  </div>
 <?php } // Show if recordset not empty ?>
 
 
 
 
 
 
 </body>
</html>
<?php


mysql_free_result($Recordset2);

mysql_free_result($Recordset4);


?>
