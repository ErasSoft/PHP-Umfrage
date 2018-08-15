<?php
#############################################################################################
# Copyright des PHP-Umfrage Scripts by ErasSoft.de (2009)                                   #
#############################################################################################

# Hier kann man das aussehen der Ergebnisse nach Ablauf der Zeit ändern
# Das Copyright Zeichen, sowie der link zu ErasSoft Homepage...
# müssen innerhalb der Ergebnisse gut sichtbar bleiben!

$ErasSoft_copyright = "<a target=\"_blank\" href=\"http://erassoft.de\">©ErasSoft</a>";


echo"
<h2>Umfrage</h2>
Zurzeit keine neue Umfrage.<br><br><br>
<font size=\"-2\">(<a href=\"".$umfrage_erassoft_datei."action=archiv\">Umfrage Archiv anzeigen</a>)</font><br>";

#include("ergebnisse.php");

?>