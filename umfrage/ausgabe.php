<?php
#############################################################################################
# Copyright des PHP-Umfrage Scripts by ErasSoft.de (2009)                                   #
#############################################################################################

# Hier kann man das aussehen der Umfrage ändern
# Das Copyright Zeichen, sowie der link zu ErasSoft Homepage...
# müssen innerhalb der Umfrage gut sichtbar bleiben!

$ErasSoft_copyright = "<a target=\"_blank\" href=\"http://erassoft.de\">©ErasSoft</a>";

# Infos:
# $umfrage_erassoft_antwort[$i]   = Antwortsmöglichkeit[Zahl] (siehe settings.php)
# $umfrage_erassoft_name          = Name des Radio Buttons
# $umfrage_erassoft_endText       = Umfrage Ende Text (siehe settings.php)



echo"
<h2>Umfrage</h2>

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
 <td>

<b>Frage: \"$umfrage_erassoft_frage\"</b>
<br><br><br>
<form action='' method='post'>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";

for($i=0; $i<=$umfrage_erassoft_anzahl; $i++)
{
echo"
<tr>
 <td><input type='Radio' name='$umfrage_erassoft_name' value='$i'></td>
 <td height=\"20\" width=\"5\"></td>
 <td>$umfrage_erassoft_antwort[$i]</td>
</tr>";
}
echo"
</table><br>

 </td>
 <td width=\"35\"></td>
 <td><img src=\"$umfrage_erassoft_ordner/bild.png\" border=\"0\"></td>
</tr>
</table>

<input type='submit' value='abschicken'>";

if($umfrage_erassoft_erg_link==true)
{
echo"
<font size=\"-2\">(<a href=\"".$umfrage_erassoft_datei."action=ergebnisse\">Ergebnisse anzeigen</a>)</font><br>";
}
echo"
<font size=\"-2\"><i>$umfrage_erassoft_endText</i></font>
</form>";

?>