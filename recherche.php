<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="Css/recherche.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="cal.js"></script>
</head>

<body>

<div id="header">
  <div align="center">Page de Recherche</div>
</div>


<div id="content">
<p align="center">Recherche base &eacute;missions </p>
<div class="contenu"><form id="form1" name="form1" method="post" action="resultats.php">
  Recherche par Mots-cl&eacute;s: 
      <label>
  <input name="recherche" type="text" id="recherche" />
  </label>
  <label>
  <input type="submit" name="Submit" value="Submit" />
  </label>
</form></div>
<div class="contenu"><form id="form2" name="form2" method="post" action="resdate.php">
  Recherche par Date &nbsp;<img src="calendar_icon.png" align="center" onclick="javascript:open_cal('rechdate');" />  : 
  <label>
  <input name="rechdate" type="text" id="rechdate" onclick="this.form.orderdate.value" size="10" maxlength="10" >&nbsp;  </label>
  

  
  <label>
  <input type="submit" name="Submit2" value="Submit" />
  </label>
</form></div>
<div class="contenu"><form id="form1" name="form1" method="post" action="reslieu.php">
  Recherche par Lieu : 
      <label>
  <input name="rechlieu" type="text" id="rechlieu" />
  </label>
  <label>
  <input type="submit" name="Submit" value="Submit" />
  </label>
</form></div>

<div class="contenu"><form id="form2" name="form2" method="post" action="rechdroits.php">
  Recherche SACEM / KOKA : 
      <label>
  <input name="rechdroits" type="text" id="rechdroits" />
  </label>
  <label>
  <input type="submit" name="Submit" value="Submit" />
  </label>
</form></div>



<p align="center">Recherche base cam&eacute;ras et voiture </p>





<strong>
<div class="contenu"><form id="form3" name="form3" method="post" action="rescam.php">
  Recherche g&eacute;n&eacute;rale: 
      <label>
  <input name="rescam" type="text" id="rescam" />
  </label>
  <label>
  <input type="submit" name="Submit" value="Submit" />
  </label>
</form></div><div class="contenu"><form id="form3" name="form3" method="post" action="rechcam.php">
  Recherche par Camera : 
      <label><span class="themecontent">
      <select name="rechcam">
        <option value="---">---</option>
        <option value="Cam&eacute;ra 1">Cam&eacute;ra 1</option>
        <option value="Cam&eacute;ra 2">Cam&eacute;ra 2</option>
        <option value="Cam&eacute;ra 3">Cam&eacute;ra 3</option>
        <option value="Cam&eacute;ra 4">Cam&eacute;ra 4</option>
        <option value="Cam&eacute;ra 5">Cam&eacute;ra 5</option>
        <option value="Cam&eacute;ra 6">Cam&eacute;ra 6</option>
        <option value="Cam&eacute;ra 7">Cam&eacute;ra 7</option>
        <option value="Cam&eacute;ra 8">Cam&eacute;ra 8</option>
        <option value="Mini cam">Mini cam</option>
      </select>
      </span></label>
  <label>
  <input type="submit" name="Submit" value="Submit" />
  </label>
</form></div></strong>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<div id="footer"><a href="#">footer link</a> | <a href="#">footer link</a></div>
</body>
</html>
