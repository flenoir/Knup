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

</head>

<body>
<div id="Global">

  <div id="Header">
  
    <div align="left"><table width="100%" border="0" align="left" id="Tableauheader">
      <tr align="left" valign="middle">
          <td width="23%" height="8" nowrap><div align="left"><img src="Fonds/logo_Ocktet.PNG" alt="logo_ocktet" width="84" height="31"><span class="petit2">for</span><img src="Fonds/logo.jpg"width="71" height="35"></div></td>
          <td width="25%"valign="middle" nowrap><div align="center">
            <p class="textecontenue2">&nbsp;&nbsp;NODAL&nbsp;&nbsp;&nbsp;&nbsp;le&nbsp;&nbsp;&nbsp;<?php echo $date ?></p>
          </div></td>
          <td width="32%"valign="middle" nowrap><div align="center">
            <p class="petit"><span class="petit2"><a href="formemissions.php" target="_parent">Ajouter</a>&nbsp;&nbsp; <a href="recherche.php" target="_parent">Rechercher</a></span>&nbsp;&nbsp;<span class="petit2"><a href="" target="_parent">Archives</a> &nbsp;</span>&nbsp;</p>
          </div></td>
          <td width="20%" valign="middle" nowrap><div align="center" class="textechamps">
            <p class="textechamps"><font color="#FFFFFF">Plein écran</font> F11</p>
          </div></td>
        </tr>
        <tr valign="middle">
          <td height="8" colspan="4"valign="middle" nowrap="nowrap"></td>
        </tr>
      </table>
      <div align="right"><a href="#"></a></div>
    </div>
  </div>
	
    <DIV id="TICKER" style="display:none; border-top:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC; overflow:hidden; background-color:#FFFFFF; width:100%" onmouseover="TICKER_PAUSED=true" onmouseout="TICKER_PAUSED=false"> 
		<span style='background-color:#7FB51A;'> &nbsp; &nbsp; <font color="#FFFFFF"> <B>Nodal</B></font>&nbsp; &nbsp; </span> &nbsp; <B>Il faut demander la VI pour tous les signaux sport</B>&nbsp; 
		<span style='background-color:#FFAA00;'> &nbsp; &nbsp; <font color="#FFFFFF"> <B>Actu</B></font>&nbsp; &nbsp; </span> &nbsp; <B>Mahmoud Abas est à Paris</B>&nbsp; 
		<span style='background-color:#0088FF;'> &nbsp; &nbsp; <B><A href="http://192.168.219.5/urt/"><font color="#FFFFFF">Infos VS</font></a></B>&nbsp; &nbsp; </span> &nbsp; <B>Le VS-94.1 est au <A href="http://www.printemps-bourges.com/"><u>Printemps de Bourges</u></a> pour le Week-end. <a href="http://www.mioplanet.com/solutions/desktopticker/index_fr.htm"><U>Plus d'info</U></a></B>&nbsp;		</DIV>
<script language="JavaScript" src="webticker_lib.js" type="text/javascript"></script>

  
  <div id="Hauttableau">
    <td width="100%" nowrap="nowrap" bgcolor="#FF0000"><div align="center">
      <table width="100%" border="1" align="center" bordercolor="#666600">
        <tr>
          <th width="9%" scope="col">D&eacute;but</th>
          <th width="9%" scope="col">Fin</th>
          <th width="82%" scope="col">Attendu</th>
        </tr>
      </table>
    </div></td>
  </div>
  
  <div id="TableauA" ><?php require_once('boardNodal.php'); ?> 
</div>
  
</div>

</body>
</html>
