<?php
#############################################################################################
# Copyright des PHP-Umfrage Scripts by ErasSoft.de (2009)                                   #
#############################################################################################

# Hier kann man das aussehen der Ergebnisse ändern
# Das Copyright Zeichen, sowie der link zu ErasSoft Homepage...
# müssen innerhalb der Ergebnisse gut sichtbar bleiben!

$ErasSoft_copyright = "<a target=\"_blank\" href=\"http://erassoft.de\">©ErasSoft</a>";

# Infos:
# $umfrage_erassoft_frage                 = Gestellte Frage
# $umfrage_erassoft_maximal               = Maximale abgegebene Stimmen
# $umfrage_erassoft_antwort[$i]           = Antwortsmöglichkeit[Zahl] (siehe settings.php)
# $umfrage_erassoft_ergebnisse[$i]        = Abgegebene Stimmen[Zahl]
# $umfrage_erassoft_prozent[$i]           = Abgegebene Stimmen in Prozent[Zahl]

# $umfrage_erassoft_prozent_maxweite      = Die Maximale weite der Grafischen Ansicht
# $umfrage_erassoft_prozent_weite[$i]     = Weite der Prozente[Zahl]
# $umfrage_erassoft_prozent_restweite[$i] = Restweite[Zahl]



echo"
<h2>Ergebnisse</h2>

<b>Die Frage war: \"$umfrage_erassoft_frage\"</b>
<br><br><br>";


echo"
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
 <td height=\"25\"><b>Antworten:</b></td>
 <td width=\"20\"></td>
 <td><b>Stimmen:</b></td>
 <td width=\"20\"></td>
 <td><b>Prozentzahl:</b></td>
 <td width=\"20\"></td>
 <td><b>Grafische Ansicht:</b></td>
</tr>";

for($i=0; $i<=$umfrage_erassoft_anzahl; $i++)
{
echo"
<tr>
 <td height=\"17\">$umfrage_erassoft_antwort[$i]</td>
 <td></td>
 <td><div align=\"right\">$umfrage_erassoft_ergebnisse[$i]</div></td>
 <td></td>
 <td><div align=\"right\">$umfrage_erassoft_prozent[$i] %</div></td>
 <td></td>
 <td>
   <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
   <tr>
    <td background=\"$umfrage_erassoft_ordner/balken.png\" width=\"$umfrage_erassoft_prozent_weite[$i]\"> </td>
    <td width=\"$umfrage_erassoft_prozent_restweite[$i]\">&nbsp;</td>
   </tr>
   </table>
 </td>
</tr>";
}
echo"
<tr>
 <td height=\"25\" colspan=\"7\"></td>
</tr>
<tr>
 <td></td>
 <td></td>
 <td><div align=\"right\"><i>$umfrage_erassoft_maximal</i></div></td>
 <td colspan=\"4\">&nbsp;<i>Stimmen wurden abgegeben</i></td>
</tr>
</table><br>";
if($umfrage_erassoft_archiv_link==true)
{
echo"
<font size=\"-2\">(<a href=\"".$umfrage_erassoft_datei."action=archiv\">Umfrage Archiv anzeigen</a>)</font><br>";
}

?>