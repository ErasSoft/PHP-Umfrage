<?php
#############################################################################################
# Copyright des PHP-Umfrage Scripts by ErasSoft.de (2009)                                   #
#############################################################################################

# Hiermit kann man den Cookie f�r die Cookie sperre setzen...
# include("umfrage/cookie.php"); diesen Teil in den Header deiner Seite,
# um ein Cookie beim absenden des Formulars zu setzen

#####################################################

# Cookiedauer in Tagen? (Standart: 3)
$umfrage_erassoft_cookiedauer =  3;

# Cookiename w�hlen
$umfrage_erassoft_cookie_name=   "umfrage";

# Name der Radio Buttons w�hlen (bei settings.php ggf. auch �ndern)
$umfrage_erassoft_name =         "umfragerassoft";



if(isset($_POST[$umfrage_erassoft_name]))
{
# Cookie setzen
$umfrage_erassoft_cookiedauer = $umfrage_erassoft_cookiedauer * 60 * 60 * 24;
$inhalt="ok";
setcookie($umfrage_erassoft_cookie_name, $inhalt, time()+$umfrage_erassoft_cookiedauer);
}

?>