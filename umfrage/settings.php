<?php
#############################################################################################
# Copyright des Umfrage Scripts by ErasSoft.de (2009)                                       #
#############################################################################################

# Hier kann man die Umfrage einstellen





################### Hier kann man die Umfrage erstellen ###################

# Frage wählen
$umfrage_erassoft_frage =        "Ja oder Nein?";

# Antwortmöglichkeiten wählen (normal Zahl)
$umfrage_erassoft_anzahl =        2;

# Antwortmöglichkeiten 1 bis X (mehr/weniger sind erlaubt, einfach entfernen oder weiterführen)
$umfrage_erassoft_antwort[0] =   "Ja";
$umfrage_erassoft_antwort[1] =   "Nein";


# Ende der Umfrage wählen (Datum)
# Format (Jahr.Monat.Tag) z.B:   "1990.08.24";
# Freilassen für keine Datumsbeschränkung...
$umfrage_erassoft_ende =         "2100.01.01";

# Text fürs Ende der Umfrage, die in der Umfrage angezigt wird (ausgabe.php)
# z.B:                           "Diese Umfrage endet am 24.08.1990";
# Freilassen für keinen Text...
$umfrage_erassoft_endText =      "Diese Umfrage endet am 01.01.2100";


# Maximal weite der Grafischen Ansicht (Standart: 250px)
$umfrage_erassoft_prozent_maxweite = 200;



################### IP-Bannlist Einstellungen ###################

# Ip Gruppe eingeben die gebannt werden sollen...
# z.B. "192.168.1.0" kann man schreiben...
# "192.168" <-- Wird dann dauerhaft gesperrt !!!
# (mehr/weniger sind erlaubt, einfach entfernen oder weiterführen)

$umfrage_erassoft_bannip[0] =    "";
$umfrage_erassoft_bannip[1] =    "";



################### Sonstige Einstellungen ###################

# Ordner wählen (Standard: "umfrage")
$umfrage_erassoft_ordner =       "umfrage";

# Datei wählen (Standard: "index.php?")
$umfrage_erassoft_datei =        "umfrage.php?";

# Datei wählen (Standard: "ips.dat")
$umfrage_erassoft_ipsdatei =     "ips.dat";

# Ergebnisse mit anzeigen? (true/false)
$umfrage_erassoft_erg_link =     true;

# Umfrage Archiv (ältere Umfragen) mit anzeigen? (true/false)
$umfrage_erassoft_archiv_link =  false;

# Name der Radio Buttons wählen (bei cookie.php ggf. auch ändern!)
$umfrage_erassoft_name =         "umfragerassoft";

# Cookiesperre? (true/false) (Einstellungen in cookie.php ändern!)
$umfrage_erassoft_cookie =       true;

?>