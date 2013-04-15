<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Bmain</title>
<link href="Css/board.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
<?php $date = date("d-m-Y"); ?>
<!--
function MM_controlSound(x, _sndObj, sndFile) { //v3.0
  var i, method = "", sndObj = eval(_sndObj);
  if (sndObj != null) {
    if (navigator.appName == 'Netscape') method = "play";
    else {
      if (window.MM_WMP == null) {
        window.MM_WMP = false;
        for(i in sndObj) if (i == "ActiveMovie") {
          window.MM_WMP = true; break;
      } }
      if (window.MM_WMP) method = "play";
      else if (sndObj.FileName) method = "run";
  } }
  if (method) eval(_sndObj+"."+method+"()");
  else window.location = sndFile;
}
//-->
</script>

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

  <div id="Header">
  
    <div align="left"><table width="100%" border="0" align="left" id="Tableauheader">
      <tr align="left" valign="middle">
          <td width="23%" height="8" nowrap><div align="left">&nbsp;<img src="Fonds/Logo_jelly.png" alt="logo" width="40">&nbsp;</div></td>
          <td width="25%"valign="middle" nowrap><div align="center">
            <p class="textecontenue2">&nbsp;&nbsp;<span class="Style1">JELLYFISH</span>&nbsp;&nbsp;&nbsp;&nbsp;le&nbsp;&nbsp;&nbsp;<?php echo $date ?></p>
          </div></td>
          <td width="32%"valign="middle" nowrap><div id="tools" align="center">
            <p class="petit"><span class="petit2"><span class="Style2"><a href="formemissions.php" target="_parent"><img src="images/Text.png" alt="emission" width="40" height="40" hspace="10" border="0"></a></span></span><span class="Style2"><a href="recherche.php" target="_parent"><img src="images/globe.png" alt="rechercher" width="40" height="40" hspace="10" border="0"></a><a href="agenda.html" target="_parent"></a><span class="Style3"><a href="agenda.html" target="_parent"><img src="images/ical.png" alt="agenda" width="40" height="40" hspace="10" border="0" class="Style2"></a></span></span><span class="petit2 Style2"></span><span class="petit2"></span><a href="formcameras.php" target="_parent"><img src="images/Movies.png" alt="cameras" width="40" height="40" hspace="10" border="0" class="Style2"></a></p>
        </div></td>
          <td width="20%" valign="middle" nowrap><div align="center" class="textechamps">
           <p class="textechamps"><font color="#FFFFFF">&nbsp;&nbsp;&nbsp;Plein écran</font> Plein ecran F11</p>
          </div></td>
      </tr>
        <tr valign="middle">
          
        </tr>
      </table>
      <div align="left"><a href="#"></a></div>    
    </div>
  </div>
	
	


  
  <div id="Table3">
    <td width="100%" nowrap="nowrap" bgcolor="#FF0000"><div align="center" id="Hauttableau">
      <table width="100%" border="1" align="center" bordercolor="#666600">
        <tr>
          <th width="11%" scope="col">D&eacute;part</th>
          <th width="6%" scope="col">Modif</th>
		  <th width="12%" scope="col">Cam&eacute;ra</th>
          <th width="50%" scope="col">Emprunteur</th>
		  <th width="10%" scope="col">Voiture</th>
		  <th width="19%" scope="col">Retour</th>
        </tr>
      </table>
    </div></td>
</div>
  
  <div id="TableauA" ><?php require_once('boardNodal2012.php'); ?> 
</div>
  
</div>

</body>
</html>
