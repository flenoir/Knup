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
  $insertSQL = sprintf("INSERT INTO cameras (id, camera, voiture, dateout, datein, hdep, hret, emprunteur, remarques, DD, K7, batterie1, batterie2, sm58, canon, hf, xlr, firewire, cache, minette, housse, pied) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
					   GetSQLValueString($_POST['camera'], "text"),
					   GetSQLValueString($_POST['voiture'], "text"),
                       GetSQLValueString($_POST['dateout'], "date"),
					   GetSQLValueString($_POST['datedin'], "date"),
					   GetSQLValueString($_POST['hdep'], "text"),
					   GetSQLValueString($_POST['hret'], "text"),
					   GetSQLValueString($_POST['emprunteur'], "text"),
					   GetSQLValueString($_POST['remarques'], "text"),
					   GetSQLValueString($_POST['DD'], "text"),
					   GetSQLValueString(isset($_POST['K7']) ? "true" : "", "defined","'Y'","'N'"),
					   GetSQLValueString(isset($_POST['batterie1']) ? "true" : "", "defined","'Y'","'N'"),
					   GetSQLValueString(isset($_POST['batterie2']) ? "true" : "", "defined","'Y'","'N'"),
					   GetSQLValueString(isset($_POST['sm58']) ? "true" : "", "defined","'Y'","'N'"),
					   GetSQLValueString(isset($_POST['canon']) ? "true" : "", "defined","'Y'","'N'"),
					   GetSQLValueString($_POST['hf'], "text"),
					   GetSQLValueString(isset($_POST['xlr']) ? "true" : "", "defined","'Y'","'N'"),
					   GetSQLValueString(isset($_POST['firewire']) ? "true" : "", "defined","'Y'","'N'"),
					   GetSQLValueString(isset($_POST['cache']) ? "true" : "", "defined","'Y'","'N'"),
					   GetSQLValueString(isset($_POST['minette']) ? "true" : "", "defined","'Y'","'N'"),
					   GetSQLValueString(isset($_POST['housse']) ? "true" : "", "defined","'Y'","'N'"),
					   GetSQLValueString(isset($_POST['pied']) ? "true" : "", "defined","'Y'","'N'"));
					

  mysql_select_db($database_Nodal, $Nodal);
  $Result1 = mysql_query($insertSQL, $Nodal) or die(mysql_error());

  $insertGoTo = "formcameras.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Form Emissions</title>
<link href="Css/camera.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="cal.js"></script>

   <SCRIPT LANGUAGE="JavaScript">
   
  
   function mafonction(modifcategorie){
   
    if (modifcategorie =="nrj" |"rushes" ) 
      document.getElementById("boxduree").style.display="none";
    else 
      document.getElementById("boxduree").style.display="inline";
	 	 }
    </SCRIPT>
 
<style type="text/css">
<!--
.Style1 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
</head>

<body>

<?PHP $date = date("Y-m-d"); 
	  $Time = date("H:i:s");?>

<div class="header" id="header">
 <p>Formulaire Cam&eacute;ras </p> 
</div>

<div id="content">

<p></p>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <div class="themecontent">
  
  
  
  
    <input name="id" type="hidden" id="id" />
Cam&eacute;ra :
<select name="camera">
  <option value="---">---</option>
  <option value="Cam&eacute;ra 1">Cam&eacute;ra 1</option>
  <option value="Cam&eacute;ra 2">Cam&eacute;ra 2</option>
  <option value="Cam&eacute;ra 3">Cam&eacute;ra 3</option>
  <option value="Cam&eacute;ra 4">Cam&eacute;ra 4</option>
  <option value="Cam&eacute;ra 5">Cam&eacute;ra 5</option>
  <option value="Cam&eacute;ra 6">Cam&eacute;ra 6</option>
  <option value="Cam&eacute;ra 7">Cam&eacute;ra 7</option>
  <option value="Cam&eacute;ra 8">Cam&eacute;ra 8</option>
  <option value="Cam&eacute;ra AE1">Cam&eacute;ra AE1</option>
  <option value="Mini cam">Mini cam</option>
		
    </select>
  
  &nbsp;&nbsp;&nbsp;&nbsp;
  Date de d&eacute;part : 
  <input name="dateout" type="text" id="dateout" value="<?php echo $date ; ?>" size="10" maxlength="10" />
  &nbsp;<img src="calendar_icon.png" align=center onClick="javascript:open_cal('dateout');">
  
  &nbsp;&nbsp;&nbsp;&nbsp;
  Date de retour prevue:  
  <input name="datedin" type='text'id="datedin" onclick="this.form.orderdate.value" size="10" maxlength="10" />
  &nbsp;<img src="calendar_icon.png" align=center onClick="javascript:open_cal('datedin');">
  
 <p> 

  &nbsp;&nbsp;&nbsp;Emprunteur :
  <select name="emprunteur" id="emprunteur">
        <option value="---" <?php if (!(strcmp("---", ""))) {echo "SELECTED";} ?>>---</option>
		<option value="Brachard.O" <?php if (!(strcmp("ob", ""))) {echo "SELECTED";} ?>>Brachard.O</option>
		<option value="Brun.J" <?php if (!(strcmp("jb", ""))) {echo "SELECTED";} ?>>Brun.J</option>
		<option value="Cardon.C">Cardon.C</option>
		<option value="Chassagon.F" <?php if (!(strcmp("fc", ""))) {echo "SELECTED";} ?>>Chassagon.F</option>
		<option value="Crouzet.T" <?php if (!(strcmp("tc", ""))) {echo "SELECTED";} ?>>Crouzet.T</option>
		<option value="Doerler.E">Doerler.E</option>
		<option value="Grellier.A">Grellier.A</option>
		<option value="Kerebel.M" <?php if (!(strcmp("mk", ""))) {echo "SELECTED";} ?>>Kerebel.M</option>
		<option value="Lamoussiere.J" <?php if (!(strcmp("lj", ""))) {echo "SELECTED";} ?>>Lamoussiere.J</option>
		<option value="Meck.M" <?php if (!(strcmp("mm", ""))) {echo "SELECTED";} ?>>Meck.M</option>
		<option value="Mougeolle.S" <?php if (!(strcmp("sm", ""))) {echo "SELECTED";} ?>>Mougeolle.S</option>
		<option value="Ployard.A">Ployard.A</option>
		<option value="Pras.G">Pras.G</option>
		<option value="Roque.S">Roque.S</option>
		<option value="Roirand.O" <?php if (!(strcmp("or", ""))) {echo "SELECTED";} ?>>Roirand.O</option>
		<option value="Rossignol.C">Rossignol.C</option>
		<option value="Tardoski.L">Tardoski.L</option>
		<option value="Van De Velde.P" <?php if (!(strcmp("pvdv", ""))) {echo "SELECTED";} ?>>Van De Velde.P</option>
		<option value="Vicente.S" <?php if (!(strcmp("sv", ""))) {echo "SELECTED";} ?>>Vicente.S</option>
		<option value="Vuillemin.E" <?php if (!(strcmp("ev", ""))) {echo "SELECTED";} ?>>Vuillemin.E</option>
		<option value="Stagiaire" <?php if (!(strcmp("st", ""))) {echo "SELECTED";} ?>>Stagiaire</option>
		<option value="Maintenance" <?php if (!(strcmp("mt", ""))) {echo "SELECTED";} ?>>Maintenance</option>
		<option value="Autre" <?php if (!(strcmp("au", ""))) {echo "SELECTED";} ?>>Autre</option>
        
    </select>
 &nbsp;&nbsp;&nbsp;&nbsp;
Heure depart :
          <input name="hdep" type="text" id="hdep" value="<?php echo $Time ; ?>" size="8" maxlength="8" />
        
		&nbsp;&nbsp;&nbsp;&nbsp;
        Heure retour :
          <input name="hret" type="text" id="hret"  size="8" maxlength="8" />

</p>

 DD :
    <select name="DD">


<option value="---" <?php if (!(strcmp("---", ""))) {echo "SELECTED";} ?>>---</option>          
<option value="DD 1" <?php if (!(strcmp("DD1", ""))) {echo "SELECTED";} ?>>DD 1</option>
<option value="DD 2" <?php if (!(strcmp("DD2", ""))) {echo "SELECTED";} ?>>DD 2</option>
<option value="DD 3" <?php if (!(strcmp("DD3", ""))) {echo "SELECTED";} ?>>DD 3</option>
<option value="DD 4" <?php if (!(strcmp("DD4", ""))) {echo "SELECTED";} ?>>DD 4</option>
<option value="DD 5" <?php if (!(strcmp("DD5", ""))) {echo "SELECTED";} ?>>DD 5</option>
<option value="DD 6" <?php if (!(strcmp("DD6", ""))) {echo "SELECTED";} ?>>DD 6</option>
<option value="DD 7" <?php if (!(strcmp("DD7", ""))) {echo "SELECTED";} ?>>DD 7</option>
<option value="DD 8" <?php if (!(strcmp("DD8", ""))) {echo "SELECTED";} ?>>DD 8</option>
<option value="DD 9" <?php if (!(strcmp("DD9", ""))) {echo "SELECTED";} ?>>DD 9</option>
<option value="DD 10" <?php if (!(strcmp("DD10", ""))) {echo "SELECTED";} ?>>DD 10</option>
<option value="DD 11" <?php if (!(strcmp("DD11", ""))) {echo "SELECTED";} ?>>DD 11</option>
<option value="DD 12" <?php if (!(strcmp("DD12", ""))) {echo "SELECTED";} ?>>DD 12</option>
		
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	K7 : 
    <input name="K7" type="checkbox" id="K7" value="checkbox" />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 Voiture :
    <select name="voiture">


<option value="---" <?php if (!(strcmp("---", ""))) {echo "SELECTED";} ?>>---</option>          
<option value="644" <?php if (!(strcmp("644", ""))) {echo "SELECTED";} ?>>644</option>
<option value="649" <?php if (!(strcmp("649", ""))) {echo "SELECTED";} ?>>649</option>
<option value="652" <?php if (!(strcmp("652", ""))) {echo "SELECTED";} ?>>652</option>
<option value="656" <?php if (!(strcmp("656", ""))) {echo "SELECTED";} ?>>656</option>
<option value="659" <?php if (!(strcmp("659", ""))) {echo "SELECTED";} ?>>659</option>
<option value="664" <?php if (!(strcmp("664", ""))) {echo "SELECTED";} ?>>664</option>
<option value="666" <?php if (!(strcmp("666", ""))) {echo "SELECTED";} ?>>666</option>
<option value="671" <?php if (!(strcmp("671", ""))) {echo "SELECTED";} ?>>671</option>
    </select>
	</p>
 
  </div>
  
  <div class="contentduree" id="boxduree">
        
		<p align="right">Sm 58 :
          <input name="sm58" type="checkbox" id="sm58" value="checkbox" />
        </p>
		
		<p align="right">Micro Canon :
          <input name="canon" type="checkbox" id="canon" value="checkbox" />
        </p>
				
		 <p align="right">Micro HF :
    <select name="hf">


<option value="---" <?php if (!(strcmp("---", ""))) {echo "SELECTED";} ?>>---</option>           
<option value="hf 1" <?php if (!(strcmp("hf1", ""))) {echo "SELECTED";} ?>>HF 1</option>
<option value="hf 2" <?php if (!(strcmp("hf2", ""))) {echo "SELECTED";} ?>>HF 2</option>
<option value="hf 3" <?php if (!(strcmp("hf3", ""))) {echo "SELECTED";} ?>>HF 3</option>
<option value="hf 4" <?php if (!(strcmp("hf4", ""))) {echo "SELECTED";} ?>>HF 4</option>
<option value="hf 5" <?php if (!(strcmp("hf5", ""))) {echo "SELECTED";} ?>>HF 5</option>
<option value="hf 6" <?php if (!(strcmp("hf6", ""))) {echo "SELECTED";} ?>>HF 6</option>
		
    </select>
		
    
        </p>
  </div>
      
  
   <div class="contentcable">
   
  	  <p align="right">Housse: 
    <input name="housse" type="checkbox" id="housse" value="checkbox" />
	  </p>
	<p align="right">Cable XLR : 
    <input name="xlr" type="checkbox" id="xlr" value="checkbox" />
     </p>
	    <p align="right">Cable Firewire : 
    <input name="firewire" type="checkbox" id="firewire" value="checkbox" />
	  </p>
  </div>
  
  <div class="contentequipe">   
   <p align="right">Batterie 1 :
    <input name="batterie1" type="checkbox" id="batterie1" value="checkbox" />
     </p>
	  <p align="right">Batterie 2 :
      <input name="batterie2" type="checkbox" id="batterie2" value="checkbox" />
     </p>
	<p align="right">Cache objectif: 
    <input name="cache" type="checkbox" id="cache" value="checkbox" />
     </p>
	  
	  <p align="right">Pied :
          <input name="pied" type="checkbox" id="pied" value="checkbox" />
      </p> 
	 
  </div>
  
  <div class="contentcommentaire">
  <p>Remarques : 
    <textarea name="remarques" cols="60" id="remarques"></textarea>&nbsp;&nbsp;
    <input name="ajouter" type="submit" id="ajouter" value="Ajouter"/>
  </p>
 </div>
   
  
  
  <input type="hidden" name="MM_insert" value="form1">
</form>



</div>

<div id="footer"><a href="Jellyfish.php" class="Style1">Page Principale </a></div>

</div> 

</body>
</html>