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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Jellyfish base de donne">
<meta name="author" content="Fabien Lenoir">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Form Emissions</title>
<link href="Bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="cal.js"></script>


 <style>
      body { padding-top: 60px; /* 60px to make the container go all the way
      to the bottom of the topbar */ }
    </style>
  <link href="Bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
      </script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

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

    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">
            Enregistrement emissions
          </a>
          <ul class="nav">
            <li>
              <a href="Jellyfish.php">
                Retour Jellyfish
              </a>
            </li>
            <li>
              <a href="#">
                About
              </a>
            </li>
            <li>
              <a href="#">
                Contact
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

<?PHP $date = date("Y-m-d"); 
	  $Time = date("H:i");?>



<div class="container-fluid">

<p></p>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">

  <div class="row-fluid 1">
  
    <div class="span6">
  
  
    <input name="id" type="hidden" id="id" />
Cat&eacute;gorie :
<select name="emission">
 
<option value="39 minutes chrono">39 minutes chrono</option>        
<option value="7L Actu" <?php if (!(strcmp("actu", ""))) {echo "SELECTED";} ?>>7L Actu</option>
		<option value="7L Decouvertes" <?php if (!(strcmp("7ldecou", ""))) {echo "SELECTED";} ?>>7L Decouvertes</option>
		<option value="7L Eco" <?php if (!(strcmp("7leco", ""))) {echo "SELECTED";} ?>>7L Eco</option>
		<option value="7L Musique" <?php if (!(strcmp("7lmusic", ""))) {echo "SELECTED";} ?>>7L Musique</option>
<option value="Bouge ta ville">Bouge ta ville</option>
<option value="Esprit Jeunes">Esprit Jeunes</option>		
<option value="Evenement" <?php if (!(strcmp("evenement", ""))) {echo "SELECTED";} ?>>Game in TV</option>
		<option value="Game in TV" <?php if (!(strcmp("gitv", ""))) {echo "SELECTED";} ?>>Evenement</option>
		<option value="Grand Tourisme" <?php if (!(strcmp("gt", ""))) {echo "SELECTED";} ?>>Grand Tourisme</option>
		<option value="Invit&eacute;">Invit&eacute; Actu</option>
		<option value="In Citu">In Citu</option>
		<option value="Nul ... La Loi">Nul ... La Loi</option>
		<option value="Nrj">Nrj</option>
		<option value="Ma Boite">Ma Boite</option>
		<option value="Mag Redac" <?php if (!(strcmp("magredac", ""))) {echo "SELECTED";} ?>>Mag Redac</option>
		<option value="Municipales">Municipales</option>
		<option value="On en parle">On en parle</option>
		<option value="On pr&eacute;pare le Match">On pr&eacute;pare le Match</option>
		<option value="Opinion sur rue">Opinion sur rue</option>
		<option value="PAD" <?php if (!(strcmp("pad", ""))) {echo "SELECTED";} ?>>PAD</option>
		<option value="Pres de chez vous">Pres de chez vous</option>		
		<option value="Publicit&eacute;s">Publicit&eacute;s</option>
        <option value="Rushes" <?php if (!(strcmp("rushes", ""))) {echo "SELECTED";} ?>>Rushes</option>
        <option value="Rando">Rando</option>
		
		<option value="Sport" <?php if (!(strcmp("sport", ""))) {echo "SELECTED";} ?>>Sport</option>
		<option value="Studio 7L" <?php if (!(strcmp("studio", ""))) {echo "SELECTED";} ?>>Studio 7L</option>
		<option value="S&eacute;ries">S&eacute;ries</option>
		<option value="Telescopie">Telescopie</option>
		<option value="Teleshopping">T&eacute;l&eacute;shopping</option>
		<option value="">item1</option>
    </select>
  
  <p>
    Fichier : 
    <input name="fichier" type="text" id="fichier" value="<?php echo $row_changeemissions['fichier']; ?>" />

    <form id="upload_form" method="post" enctype="multipart/form-data" action="upload.php">
   
    <input name="fichier" type="file" />     
    </p>
  

  &nbsp;&nbsp;&nbsp;&nbsp;
  Date d'enregistrement : 
  <input name="daterec" type="text" id="daterec" value="<?php echo $date ; ?>" size="10" maxlength="10" />&nbsp;<img src="calendar_icon.png" align=center onClick="javascript:open_cal('daterec');">
  
  &nbsp;&nbsp;&nbsp;&nbsp;
  Date de diffusion :  
  <input name="datediff" type='text'id="datediff" onclick="this.form.orderdate.value" size="10" maxlength="10" />
  &nbsp;<img src="calendar_icon.png" align=center onClick="javascript:open_cal('datediff');">
  
  



</p>

  <p>Titre :
    <input name="contenu" type="text" id="contenu" size="69" maxlength="69" />  
    &nbsp;
	N° émission : 
    <input name="dureep1" type="text" id="dureep1" value="" size="4" maxlength="4" />	
  &nbsp;

  <form id="upload_form" method="post" enctype="multipart/form-data" action="upload.php">
   
    <label>S&eacute;lectionnez un fichier :
    <input name="fichier" type="file" />
    </label>
   </p>

   

	</p>
  &nbsp; Lieu : <input name="lieu" type="text" id="lieu" size="40" maxlength="40" />
  &nbsp;&nbsp;&nbsp;Auteur :
  <select name="plateau" id="plt">
        <option value="Brachard.O" <?php if (!(strcmp("ob", ""))) {echo "SELECTED";} ?>>Brachard.O</option>
		<option value="Brun.J" <?php if (!(strcmp("jb", ""))) {echo "SELECTED";} ?>>Brun.J</option>
		<option value="Cardon.C">Cardon.C</option>
		<option value="Chassagon.F" <?php if (!(strcmp("fc", ""))) {echo "SELECTED";} ?>>Chassagon.F</option>
		<option value="Crouzet.T" <?php if (!(strcmp("tc", ""))) {echo "SELECTED";} ?>>Crouzet.T</option>
		<option value="Davril.JY" <?php if (!(strcmp("tc", ""))) {echo "SELECTED";} ?>>Davril.JY</option>
		<option value="Doerler.E">Doerler.E</option>
		<option value="Grellier.A">Grellier.A</option>
		<option value="Helleux.F" <?php if (!(strcmp("fh", ""))) {echo "SELECTED";} ?>>Helleux.F</option>
		<option value="Kerebel.M" <?php if (!(strcmp("mk", ""))) {echo "SELECTED";} ?>>Kerebel.M</option>
		<option value="Meck.M" <?php if (!(strcmp("mm", ""))) {echo "SELECTED";} ?>>Meck.M</option>
		<option value="Mougeolle.S" <?php if (!(strcmp("sm", ""))) {echo "SELECTED";} ?>>Mougeolle.S</option>
		<option value="Ployard.A">Ployard.A</option>
		<option value="Pras.G">Pras.G</option>
		<option value="Revouy.F" <?php if (!(strcmp("Revouy.F", ""))) {echo "SELECTED";} ?>>Revouy.F</option>
		<option value="Robert.S">Robert.S</option>
		<option value="Roirand.O" <?php if (!(strcmp("or", ""))) {echo "SELECTED";} ?>>Roirand.O</option>
		<option value="Rossignol.C">Rossignol.C</option>
		<option value="Tardoski.L">Tardoski.L</option>
		<option value="Van De Velde.P" <?php if (!(strcmp("pvdv", ""))) {echo "SELECTED";} ?>>Van De Velde.P</option>
		<option value="Vicente.S" <?php if (!(strcmp("sv", ""))) {echo "SELECTED";} ?>>Vicente.S</option>
		<option value="Vuillemin.E" <?php if (!(strcmp("ev", ""))) {echo "SELECTED";} ?>>Vuillemin.E</option>
		<option value="Autre" <?php if (!(strcmp("au", ""))) {echo "SELECTED";} ?>>Autre</option>
        
    </select>
</p>
  </div>


    <div class="span6">
    <!-- HTML5 <video> element -->

    <video width="640" height="264" 
           controls preload="auto" 
           data-setup='{"controls": true, "autoplay": false, "preload": "auto"}' 
           >
        <!-- HTML5 <video> sources -->
        <source src="Video/<?php echo $row_changeemissions['fichier']; ?>" type='video/mp4'/>
        <source src="./folder/video.webm" type='video/webm; codecs="vp8, vorbis"'/>
        <source src="./folder/video.ogv" type='video/ogg; codecs="theora, vorbis"'/>
    </video>
            <p>
            $videofile ="<?php echo $row_changeemissions['fichier']; ?>"
            echo $videofile
            </p>
    </div>
</div> <!-- fin de div Row 1 -->

 <div class="row-fluid 2">

  
   <div class="span4">
  
  <p>Invit&eacute;s / Synthé 1 : 
    <input name="ctr" type="text" id="ctr" size="40" maxlength="40" />
  </p>
  <p>Invit&eacute;s / Synthé 2 : 
    <input name="scripte" type="text" id="scripte" size="40" maxlength="40" />
  <p>Invit&eacute;s / Synthé 3 : 
    <input name="tsev" type="text" id="tsev" size="40" maxlength="40" />
  <p>Invit&eacute;s / Synthé 4 : 
    <input name="tses" type="text" id="tses" size="40" maxlength="40" />
  <p>Invit&eacute;s / Synthé 5 :  
    <input name="tsel" type="text" id="tsel" size="40" maxlength="40" />
  </div>
  
  <div class="span4">
    <div align="left">
      <p>ID : 
    <input name="dureep2" type="text" id="dureep1" value="" size="8" maxlength="8" />&nbsp;
	  </p>
    </div>
    
  <div align="left">envoy&eacute; en R&eacute;gie Finale
    <input name="envfinale" type="checkbox" id="envfinale" value="checkbox" />
      </p>
	   <p>Archiv&eacute;
          <input name="cartonfin" type="checkbox" id="cartonfin" value="checkbox" />
        </p>
		  <p align="left">Num&eacute;ro DVD :
      <input name="fauxdepart" type="text" id="fauxdepart" value="0000" size="10" maxlength="10" />
          </p>
    <p align="left">Num&eacute;ro Boite : 
    <input name="envnodal" type="text" id="envnodal" value="0000" size="10" maxlength="10" />
	  </p>
  </div>
  </div>
    
      <div class="span4" id="boxduree">
        <p>Heure Mise en Place :
          <input name="hstart" type="text" id="hstart" value="00:00:00" size="8" maxlength="8" />
        </p>
        <p>Heure PAT :
          <input name="hpat" type="text" id="hpat" value="00:00:00" size="8" maxlength="8" />
        <p>Heure Fin :
          <input name="hend" type="text" id="hend" value="00:00:00" size="8" maxlength="8" />
        <p>Dur&eacute;e Totale :
          <input name="duree" type="text" id="duree" value="00:00:00" size="8" maxlength="8" />
        </p>
        </p>
      </div>

</div> <!-- fin de  row 2 -->

<div class="row-fluid 3">

      <div class="span8">
  <p>Référence SACEM / KOKA : 
    <textarea name="commentaires" class="input-xxlarge" id="commentaires"></textarea>
   
    <button class="btn btn-primary" type="submit">Ajouter <i class="icon-white icon-ok-sign"></i> </button>
  </p>
 </div>
  
  </div> <!-- fin de row 3 -->
  
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp; </p>

</div>

<div class="row-fluid 4">

<div class="span4 offset5"><a href="Jellyfish.php" class="Style1">Page Principale </a></div>
</div>

</body>
</html>