<HEAD>
<!-- first: the CSS layout of LeanBack Player -->
<link rel="stylesheet" type="text/css" href="./Leanback/css.player/leanbackPlayer.default.css"/>
 
<!-- second: the Javascript file of LeanBack Player -->
<script type="text/javascript" src="./Leanback/js.player/leanbackPlayer.pack.js"></script>
 
<!-- third: additional language files of LeanBack Player; -->
<!-- make sure you add at least the english translation ("en") -->
<script type="text/javascript" src="./Leanback/js.player/leanbackPlayer.en.js"></script>
<script type="text/javascript" src="./Leanback/js.player/leanbackPlayer.fr.js"></script>
</HEAD>

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE emissions SET hstart=%s, hpat=%s, hend=%s, dureep1=%s, dureep2=%s, emission=%s, plt=%s, contenu=%s, datediff=%s, ctr=%s, scripte=%s, tsev=%s, tses=%s, tsel=%s, cartonfin=%s, fauxdepart=%s, envnodal=%s, envfinale=%s, commentaires=%s, duree=%s, lieu=%s, fichier=%s WHERE id=%s",
                       GetSQLValueString($_POST['hstart'], "date"),
                       GetSQLValueString($_POST['hpat'], "date"),
                       GetSQLValueString($_POST['hend'], "date"),
					   GetSQLValueString($_POST['dureep1'], "text"),
                       GetSQLValueString($_POST['dureep2'], "text"),
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
                       GetSQLValueString($_POST['duree'], "date"),
					   GetSQLValueString($_POST['lieu'], "text"),
             GetSQLValueString($_POST['fichier'], "text"),
					   GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Nodal, $Nodal);
  $Result1 = mysql_query($updateSQL, $Nodal) or die(mysql_error());

  $updateGoTo = "Jellyfish.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_changeemissions = "-1";
if (isset($_GET['id'])) {
  $colname_changeemissions = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_Nodal, $Nodal);
$query_changeemissions = sprintf("SELECT * FROM emissions WHERE id = %s", $colname_changeemissions);
$changeemissions = mysql_query($query_changeemissions, $Nodal) or die(mysql_error());
$row_changeemissions = mysql_fetch_assoc($changeemissions);
$totalRows_changeemissions = mysql_num_rows($changeemissions);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Form Emissions</title>
<link href="Css/emission.css" rel="stylesheet" type="text/css" />
</head>

<body>


<?PHP $date = date("Y-m-d"); 
	    $Time = date("H:i");
?>

<div  id="header">
 <p>Modification des &eacute;missions</p> 
</div>

<div id="content">

<p></p>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <div class="contenttheme">
  
  
  
  
    <input name="id" type="hidden" id="id" value="<?php echo $row_changeemissions['id']; ?>" />
Cat&eacute;gorie:
  <select name="emission" id="emission">
    <option value="<?php echo $row_changeemissions['emission']?>"><?php echo $row_changeemissions['emission']?></option>
<option value="39 minutes chrono">39 minutes chrono</option>    
<option value="7L Actu">7L Actu</option>
    <option value="7L D&eacute;couvertes">7L D&eacute;couvertes</option>
	<option value="7L Eco">7L Eco</option>
	<option value="7L Musique">7L Musique</option>
	<option value="Bouge ta ville">Bouge ta ville</option>
	<option value="Esprit Jeunes">Esprit Jeunes</option>
	<option value="Evenement">Evenement</option>
	<option value="Game in TV">Game in TV</option>
	<option value="Grand Tourisme">Grand Tourisme</option>
    <option value="Invité">invite actu</option>
    <option value="In Citu">In Citu</option>
	<option value="Nul ... La Loi">Nul ... La Loi</option>
	<option value="Ma Boite">Ma Boite</option>
	<option value="Nrj">Nrj</option>
	<option value="Mag Redac">Mag Redac</option>
	<option value="Municipales">Municipales</option>
	<option value="On en parle">On en parle</option>
	<option value="On pr&eacute;pare le Match">On pr&eacute;pare le Match</option>
	<option value="Opinion sur rue">Opinion sur rue</option>
	<option value="PAD">PAD</option>
	<option value="Pres de chez vous">Pres de chez vous</option>
	<option value="Publicit&eacute;s">Publicit&eacute;s</option>
	<option value="Rando">Rando</option>
	<option value="Rushes">Rushes</option>
	<option value="S&eacute;ries">S&eacute;ries</option>
	<option value="Sport">Sport</option>
	<option value="Studio 7L">Studio 7L</option>
	<option value="Telescopie">Telescopie</option>
	<option value="T&eacute;l&eacute;shopping">T&eacute;l&eacute;shopping</option>
	<option value="<?php echo $row_changeemissions['emission']?>"><?php echo $row_changeemissions['emission']?></option>
	    <?php
do {  
?>
    <?php
} while ($row_changeemissions = mysql_fetch_assoc($changeemissions));
  $rows = mysql_num_rows($changeemissions);
  if($rows > 0) {
      mysql_data_seek($changeemissions, 0);
	  $row_changeemissions = mysql_fetch_assoc($changeemissions);
  }
?>
      </select> 
  
  &nbsp;&nbsp;&nbsp;&nbsp;
  Date d'enregistrement : 
  <input name="daterec" type="text" id="daterec" value="<?php echo $row_changeemissions['date']; ?>" size="10" maxlength="10" />
  
   &nbsp;&nbsp;&nbsp;&nbsp;
  Date de diffusion : 
  <input name="datediff" type="text" id="datediff" value="<?php echo $row_changeemissions['datediff']; ?>" size="10" maxlength="10" />
  
</p>


  <p>Titre :
    <input name="contenu" type="text" id="contenu" value="<?php echo $row_changeemissions['contenu']; ?>" size="69" maxlength="69" />    
    &nbsp;
	N° émission : 
    <input name="dureep1" type="text" id="dureep1" value="<?php echo $row_changeemissions['dureep1']; ?>" size="4" maxlength="4" />	
   &nbsp;
  Fichier : 
    <input name="fichier" type="text" id="fichier" value="<?php echo $row_changeemissions['fichier']; ?>" size="40" maxlength="40" />

    <form id="upload_form" method="post" enctype="multipart/form-data" action="upload.php">
   
    <input name="fichier" type="file" />


	</p>
  <p>Lieu : <input name="lieu" type="text" id="lieu" value="<?php echo $row_changeemissions['lieu']; ?>" size="40" maxlength="40" /> &nbsp;
     &nbsp; &nbsp; &nbsp;
    Auteur :
      <select name="plateau" id="plt">
        <option value="<?php echo $row_changeemissions['plt']?>"><?php echo $row_changeemissions['plt']?></option>
        <option value="Brachard.O">Brachard.O</option>
        <option value="Brun.J">Brun.J</option>
        <option value="Cardon.C">Cardon.C</option>
        <option value="Rossignol.C">Rossignol.C</option>
        <option value="Chassagon.F">Chassagon.F</option>
        <option value="Crouzet.T">Crouzet.T</option>
        <option value="Davril.JY">Davril.JY</option>
        <option value="Doerler.E">Doerler.E</option>
        <option value="Grellier.A">Grellier.A</option>
        <option value="Helleux.F">Helleux.F</option>
        <option value="Kerebel.M">Kerebel.M</option>
        <option value="Meck.M">Meck.M</option>
        <option value="Mougeolle.S">Mougeolle.S</option>
        <option value="Ployard.A">Ployard.A</option>
        <option value="Pras.G">Pras.G</option>
        <option value="Revouy.F">Revouy.F</option>
        <option value="Robert.S">Robert.S</option>
        <option value="Roirand.O">Roirand.O</option>
        <option value="Tardoski.L">Tardoski.L</option>
        <option value="Van De Velde.P">Van De Velde.P</option>
        <option value="Vicente.S">Vicente.S</option>
        <option value="Vuillemin.E">Vuillemin.E</option>
        <option value="au">Autre</option>
        <option value="<?php echo $row_changeemissions['plt']?>"><?php echo $row_changeemissions['plt']?></option>
        <?php
do {  
?>
        <?php
} while ($row_changeemissions = mysql_fetch_assoc($changeemissions));
  $rows = mysql_num_rows($changeemissions);
  if($rows > 0) {
      mysql_data_seek($changeemissions, 0);
	  $row_changeemissions = mysql_fetch_assoc($changeemissions);
  }
?>
      </select>
   </p>
  </div>
  
   <div class="contentequipe">
  <p>Invit&eacute;s / Synthé 1 : 
    <input name="ctr" type="text" id="ctr" value="<?php echo $row_changeemissions['ctr']; ?>" size="40" maxlength="40" />
  </p>
  <p>Invit&eacute;s / Synthé 2 : 
    <input name="scripte" type="text" id="scripte" value="<?php echo $row_changeemissions['scripte']; ?>" size="40" maxlength="40" />
  <p>Invit&eacute;s / Synthé 3 : 
    <input name="tsev" type="text" id="tsev" value="<?php echo $row_changeemissions['tsev']; ?>" size="40" maxlength="40" />
  <p>Invit&eacute;s / Synthé 4 : 
    <input name="tses" type="text" id="tses" value="<?php echo $row_changeemissions['tses']; ?>" size="40" maxlength="40" />
  <p>Invit&eacute;s / Synthé 5 : 
    <input name="tsel" type="text" id="tsel" value="<?php echo $row_changeemissions['tsel']; ?>" size="40" maxlength="40" />

  </div>

$videofile ="<?php echo $row_changeemissions['fichier']; ?>"
echo $videofile

<div class="playercontent">
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
</div>



  
  <div class="checkbox">
   <p>ID : 
    <input name="dureep2" type="text" id="dureep2" value="<?php echo $row_changeemissions['dureep2']; ?>" size="8" maxlength="8" />
	  </p>
	  </p>
  envoy&eacute; en R&eacute;gie Finale
<input name="envfinale" type="checkbox" id="envfinale" <?php if($row_changeemissions['envfinale'] == "Y"){echo" CHECKED";}?> />
  </p>
  Archivé 
    <input name="cartonfin" type="checkbox" id="cartonfin" <?php if($row_changeemissions['cartonfin'] == "Y"){echo" CHECKED";}?>>
  </p>
 <p>Num&eacute;ro DVD : 
    <input name="fauxdepart" type="text" id="fauxdepart" value="<?php echo $row_changeemissions['fauxdepart']; ?>" size="10" maxlength="10" />
	  </p>
 <p>Num&eacute;ro Boite : 
    <input name="envnodal" type="text" id="envnodal" value="<?php echo $row_changeemissions['envnodal']; ?>" size="10" maxlength="10" />
	
  </div>
  
 
  
  <div class="contentduree">
  <p>Heure Mise en Place : 
    <input name="hstart" type="text" id="hstart" value="<?php echo $row_changeemissions['hstart']; ?>" size="8" maxlength="8" />

  </p>
  <p>Heure PAT : 
    <input name="hpat" type="text" id="hpat" value="<?php echo $row_changeemissions['hpat']; ?>" size="8" maxlength="8" />
	
  <p>Heure Fin : 
    <input name="hend" type="text" id="hend" value="<?php echo $row_changeemissions['hend']; ?>" size="8" maxlength="8" />
	  
  <p>Dur&eacute;e Totale : 
    <input name="duree" type="text" id="duree" value="<?php echo $row_changeemissions['duree']; ?>" size="8" maxlength="8" />
  </p>
  </div>
  
  
  
  
  <div class="contentcommentaire">
  <p>Référence SACEM / KOKA :
    <textarea name="commentaires" cols="50" id="commentaires"><?php echo $row_changeemissions['commentaires']; ?></textarea>
    <input name="modifier" type="submit" id="modifier" value="Modifier"/>
  </p>
 </div>
  
  
  
  
  <input type="hidden" name="MM_update" value="form1">
</form>
<p>&nbsp; </p>

</div>

<div id="footer"><a href="Jellyfish.php">page accueil</a></div>
</div>

</body>
</html>
<?php
mysql_free_result($changeemissions);
?>