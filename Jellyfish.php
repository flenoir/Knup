<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Bmain</title>
<link href="Bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">

<?php $date = date("d-m-Y"); ?>


<script language="JavaScript" type="text/javascript">
<!--
function BRB_PHP_DelWithCon(deletepage_url,field_name,field_value,messagetext) { //v1.0 - Deletes a record with confirmation
  if (confirm(messagetext)==1){
  	location.href = eval('\"'+deletepage_url+'?'+field_name+'='+field_value+'\"');
  }
}
//-->
</script>

<style type="text/css">
<!--
.Style1 {
	font-size: 18px;
	color: #0000CC;
	font-family: "Century Gothic";
}
.Style2 {font-size: 14px}
.Style3 {font-weight: bold; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif;}
-->
</style>
</head>

<body>
<div id="Global">

  <div class="row-fluid-header">

    <div class="span1"><img src="Fonds/Ballonbasket.gif" alt="logo"></div>
    <div class="span2 offset1">JELLYFISH</div>
    <div class="span1">le&nbsp;<?php echo $date ?></div>
    <div class="span3 offset1"><a href="formemissions.php" target="_parent"><img src="images/Text.png" alt="emission"></a>
      &nbsp;<a href="recherche.php" target="_parent"><img src="images/globe.png" alt="rechercher"></a>
      &nbsp;<a href="agenda.html" target="_parent"><img src="images/ical.png" alt="agenda"></a>
      &nbsp;<a href="formcameras.php" target="_parent"><img src="images/Movies.png" alt="cameras"></a>
    </div>
    <div class="span2 offset2">Plein ecran F11</div>

  </div>
  
	
  <div id="Table3">
    <td width="100%" nowrap="nowrap" bgcolor="#FF0000"><div align="center" id="Hauttableau">
      <table width="100%" border="1" align="center" bordercolor="#666600">
        <tr>
          <th width="10%" scope="col">D&eacute;but</th>
          <th width="10%" scope="col">fin</th>
		  <th width="8%" scope="col">Dur&eacute;e</th>
          <th width="48%" scope="col">Titre</th>
		  <th width="6%" scope="col">Voiture</th>
		  <th width="21%" scope="col">Identifiant</th>
        </tr>
      </table>
    </div></td>
</div>
  
  <div id="TableauA" ><?php require_once('boardNodal2012.php'); ?> 
</div>
  
</div>

</body>
</html>
