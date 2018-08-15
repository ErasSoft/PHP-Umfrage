<?php
#############################################################################################
# Copyright des Umfrage Scripts by ErasSoft.de (2009)                                       #
# Scriptänderungen dürfen nur mit Einzugsermächtigung von Eras vorgenommen werden           #
#############################################################################################


#############################################################################################
#                                    WICHTIG                                                #
# Mit dem PHP-Befehl:                                                                       #
# include("umfrage/umfrage.php");                                                           #
# kann die Umfrage angezeigt werden                                                         #
#############################################################################################


#############################################################################################
#                                Dateien Überblick:                                         #
#                                                                                           #
#   ausgabe.php   = Dort wird die Umfrage ausgegeben, das Copyright Zeichen und der         #
#                   Link dazu muss innerhalb der Umfrage gut sichtbar bestehen bleiben      #
#   ergebnisse.php= Dort werden die Ergebnisse ausgegeben, das Copyright Zeichen und der    #
#                   Link dazu muss innerhalb der Umfrage gut sichtbar bestehen bleiben      #
#   ende.php      = Dort wird alles nach ablauf der Zeit ausgegeben                         #
#   bann.php      = Dort wird alles angezeigt, wenn der User einen Bann erhählt             #
#   archiv.php    = Dort kommen die Ergebnisse aller vergangenen Umfragen rein              #
#   settings.php  = Dort kann man die Umfrage einstellen, Fragen/Antworten usw.             #
#   index.php     = Es kann eine index.php Seite erstellt werden, ohne das sie gelöscht wird#
#                                                                                           #
#   ergebnisse.dat= Dort stehen die Ergebnisse drin                                         #
#   ips.dat       = Dort stehen die Ips der gevoteten Personen drin                         #
#   balken.png    = Picture Datei der grafischen Ansicht                                    #
#                                                                                           #
# Alle Dateien müssen mit dem Recht 777 ausgestattest sein, damit dieses Script funktioniert#
#############################################################################################






#################################################
### Umfrage - Script Beginn - (c)ErasSoft     ###
#################################################

echo"
<!-- Umfrage Beginn -->
<!-- (c)ErasSoft.de -->
";

# Einstellungen auslesen
include("settings.php");

# Korektur der Einstellungen...
$umfrage_erassoft_anzahl = $umfrage_erassoft_anzahl - 1;

# IP auslesen
$ip = getenv ("REMOTE_ADDR");

# "&action=..." auslesen (ergebnisse/archiv)
$umfrage_action=$_GET['action'];



# Alte Umfrage Ergebnisse anzeigen?
if($umfrage_erassoft_archiv_link==true)
{
  if($umfrage_action=='archiv')
  {
  $archiv_anzeigen=1;
  }
}


if(isset($archiv_anzeigen))
{
# Vergangene Umfragen anzeigen...
include("archiv.php");
}
else
{


### Umfrage DATUM Ende? ###

# Punkt ersetzen durch nix
$umfrage_erassoft_ende = str_replace(".", "", "$umfrage_erassoft_ende");
$umfrage_erassoft_aktuelles_datum = date("Ymd",time());


# Kein Datum für Ende der Umfrage?
if($umfrage_erassoft_ende=='')
{
$umfrage_erassoft_ende=$umfrage_erassoft_aktuelles_datum+1;
}


# Ende der Umfrage
if($umfrage_erassoft_ende<=$umfrage_erassoft_aktuelles_datum)
{


  # ergebnisse.dat öffnen und in eine Variable speichern
    $umfrage_datei = fopen("$umfrage_erassoft_ordner/ergebnisse.dat","r");
    $umfrage_erassoft_ergebnisse = file("$umfrage_erassoft_ordner/ergebnisse.dat");
     fclose($umfrage_datei);

  # Stimmen ausrechnen
  $umfrage_erassoft_maximal = 0;
  for($i=0; $i<=$umfrage_erassoft_anzahl; $i++)
  {
  $umfrage_erassoft_maximal = $umfrage_erassoft_maximal + $umfrage_erassoft_ergebnisse[$i];
  }

  # Prozentrechnung
  if($umfrage_erassoft_maximal==0)
  {
  $umfrage_erassoft_prozent=0;
  }
  else
  {
    for($i=0; $i<=$umfrage_erassoft_anzahl; $i++)
    {
    $umfrage_erassoft_prozent[$i] = 100 * $umfrage_erassoft_ergebnisse[$i] / $umfrage_erassoft_maximal;
    $umfrage_erassoft_prozent[$i] = round($umfrage_erassoft_prozent[$i],2);

    $umfrage_erassoft_prozent_maxweite = 250;
    $umfrage_erassoft_prozent_weite[$i] = $umfrage_erassoft_prozent[$i] * $umfrage_erassoft_prozent_maxweite / 100;
    $umfrage_erassoft_prozent_restweite[$i] = $umfrage_erassoft_prozent_maxweite - $umfrage_erassoft_prozent_weite[$i];
    }
  }

# Nach Ablauf der Zeit anzeigen
include("ende.php");

}
else
{

### BANN ###
# Ersten zwei Gruppen deiner IP lesen
    # Zweiten . Position bestimmen (IP)
    $umfrage_bannip_punkt=0;
    $umfrage_erassoft_länge = strlen($ip);
      for($b=0;$b<=$umfrage_erassoft_länge;$b++)
      {
      $umfrage_erassoft_test = substr($ip, $b, 1);
        if($umfrage_erassoft_test=='.')
        {
        $umfrage_bannip_punkt=$umfrage_bannip_punkt+1;
          if($umfrage_bannip_punkt>=2)
          {
          $umfrage_erassoft_zeichen_pos=$b;
          $b=$umfrage_erassoft_länge;
          }
        }
      }
    # Ersten Zwei IP-Gruppen anzeigen
    $umfrage_erassoft_deinip = substr($ip,0,$umfrage_erassoft_zeichen_pos); 

# Bannliste lesen
  for($a=0;$a<=65025;$a++)
  {
    if(isset($umfrage_erassoft_bannip[$a]))
    {
    # Zweiten . Position bestimmen (BANN-IP)
    $umfrage_bannip_punkt=0;
    $umfrage_erassoft_länge = strlen($umfrage_erassoft_bannip[$a]);
      for($b=0;$b<=$umfrage_erassoft_länge;$b++)
      {
      $umfrage_erassoft_test = substr($umfrage_erassoft_bannip[$a], $b, 1);
        if($umfrage_erassoft_test=='.')
        {
        $umfrage_bannip_punkt=$umfrage_bannip_punkt+1;
          if($umfrage_bannip_punkt>=2)
          {
          $umfrage_erassoft_zeichen_pos=$b;
          $b=$umfrage_erassoft_länge;
          }
        }
      }
    # Ersten Zwei IP-Gruppen anzeigen
    $umfrage_erassoft_bannip[$a] = substr($umfrage_erassoft_bannip[$a],0,$umfrage_erassoft_zeichen_pos); 

      if($umfrage_erassoft_bannip[$a]==$umfrage_erassoft_deinip)
      {
      $umfrage_erassoft_ip_bann=1;
      }
    }
    else
    {
    $a=65025;
    }
  }
### /BANN ###



# Bann aktiv?
if(isset($umfrage_erassoft_ip_bann))
{
  # ergebnisse.dat öffnen und in eine Variable speichern
    $umfrage_datei = fopen("$umfrage_erassoft_ordner/ergebnisse.dat","r");
    $umfrage_erassoft_ergebnisse = file("$umfrage_erassoft_ordner/ergebnisse.dat");
     fclose($umfrage_datei);

  # Stimmen ausrechnen
  $umfrage_erassoft_maximal = 0;
  for($i=0; $i<=$umfrage_erassoft_anzahl; $i++)
  {
  $umfrage_erassoft_maximal = $umfrage_erassoft_maximal + $umfrage_erassoft_ergebnisse[$i];
  }

  # Prozentrechnung
  if($umfrage_erassoft_maximal==0)
  {
  $umfrage_erassoft_prozent=0;
  }
  else
  {
    for($i=0; $i<=$umfrage_erassoft_anzahl; $i++)
    {
    $umfrage_erassoft_prozent[$i] = 100 * $umfrage_erassoft_ergebnisse[$i] / $umfrage_erassoft_maximal;
    $umfrage_erassoft_prozent[$i] = round($umfrage_erassoft_prozent[$i]);

    $umfrage_erassoft_prozent_maxweite = 250;
    $umfrage_erassoft_prozent_weite[$i] = $umfrage_erassoft_prozent[$i] * $umfrage_erassoft_prozent_maxweite / 100;
    $umfrage_erassoft_prozent_restweite[$i] = $umfrage_erassoft_prozent_maxweite - $umfrage_erassoft_prozent_weite[$i];
    }
  }

# Bann Seite anzeigen
include("bann.php");
}
else
{

### Ips.dat öffnen und in eine Variable speichern ($umfrage_erassoft_ipsdatei) ################################
    $umfrage_datei = fopen("$umfrage_erassoft_ordner/$umfrage_erassoft_ipsdatei","r");
    $umfrage_ips   = file("$umfrage_erassoft_ordner/$umfrage_erassoft_ipsdatei");
     fclose($umfrage_datei);

$umfrage_ips_zeilen = count($umfrage_ips);

# Ist die IP schon gespeichert oder noch nicht.
 for($i=0;$i<=$umfrage_ips_zeilen;$i++)
 {

# | Zeichen Position bestimmen
 $umfrage_erassoft_länge = strlen($umfrage_ips[$i]);
   for($a=0;$a<=$umfrage_erassoft_länge;$a++)
   {
   $umfrage_erassoft_test = substr($umfrage_ips[$i], $a, 1);
    if($umfrage_erassoft_test=='|')
    {
    $umfrage_erassoft_zeichen_pos=$a;
    $a=$umfrage_erassoft_länge;
    }
   }

# Antwort ausblenden (nur IP anzeigen)
 $umfrage_ips[$i] = substr($umfrage_ips[$i],($umfrage_erassoft_zeichen_pos+1),($umfrage_erassoft_länge-$umfrage_erassoft_zeichen_pos)); 

# Enter ersetzen durch nix
 $umfrage_ips[$i] = str_replace("
", "", "$umfrage_ips[$i]");


  if($ip==$umfrage_ips[$i])
  {
  # Ergebnisse statt Umfrage anzeigen
  $umfrage_anzeigen=0;
  # IP ist die selbe wie in der Datei (End of File)
  $i=$umfrage_ips_zeilen;
  }
  else
  {
  # Weitergucken
    if($umfrage_ips[$i]=='')
    {
    # Umfrage anzeigen
    $umfrage_anzeigen=1;
    # End of File
    $i=$umfrage_ips_zeilen;
    }
  }
 }


# Cookiesperre?
if($umfrage_erassoft_cookie==true)
{
  if(isset($_COOKIE[$umfrage_erassoft_cookie_name]))
  {
  $umfrage_anzeigen=0;
  }
}


# Ergebnisse anzeigen?
if($umfrage_erassoft_erg_link==true)
{
  if($umfrage_action=='ergebnisse')
  {
  $umfrage_anzeigen=0;
  }
}


if($umfrage_anzeigen==1)
{


### Umfrage wurde abgeschickt ####################################################
    if(isset($_POST[$umfrage_erassoft_name]))
    {
    # IP in ips.dat speichern
    $umfrage_datei = fopen("$umfrage_erassoft_ordner/$umfrage_erassoft_ipsdatei","a");
    $umfrage_erassoft_ip_erg=$_POST[$umfrage_erassoft_name];
    $umfrage_erassoft_ip_erg=$umfrage_erassoft_ip_erg+1;
    $umfrage_daten = "$umfrage_erassoft_ip_erg|$ip\n";
    rewind($umfrage_datei);
    fwrite($umfrage_datei,$umfrage_daten);
    fclose($umfrage_datei);

    # ergebnisse.dat auslesen
    $umfrage_datei = fopen("$umfrage_erassoft_ordner/ergebnisse.dat","r");
    $umfrage_erassoft_ergebnisse = file("$umfrage_erassoft_ordner/ergebnisse.dat");
    fclose($umfrage_datei);

    # Ergebnis in ergebnisse.dat speichern
    $umfrage_datei = fopen("$umfrage_erassoft_ordner/ergebnisse.dat","w+");

    # Ergebniss intern durch 0 ersetzen
    for($i=0;$i<=$umfrage_erassoft_anzahl;$i++)
    {
      if($umfrage_erassoft_ergebnisse[$i]=='')
      {
      $umfrage_erassoft_ergebnisse[$i] = 0;
      }
    }

    # Enter ersetzen durch nix
    for($i=0;$i<=$umfrage_erassoft_anzahl;$i++)
    {
     $umfrage_erassoft_ergebnisse[$i] = str_replace("
", "", "$umfrage_erassoft_ergebnisse[$i]");

    }

    # Dein eingegebenes Ergebnis auslesen
    $umfrage_erassoft_name=$_POST[$umfrage_erassoft_name];
    $i=$umfrage_erassoft_name;

    # Dein eingegebenes Ergebnis um 1 in der Datenbank erhöhen
    $umfrage_erassoft_ergebnisse[$i]=$umfrage_erassoft_ergebnisse[$i]+1;

    # ergebnisse.dat Daten neu erfassen
    $umfrage_datenNEU = $umfrage_erassoft_ergebnisse[0];
    for($i=1;$i<=$umfrage_erassoft_anzahl;$i++)
    {
    $umfrage_datenNEU = "$umfrage_datenNEU\n$umfrage_erassoft_ergebnisse[$i]";
    }

    # Neue ergebnisse.dat speichern/ersetzen
    rewind($umfrage_datei);
    fwrite($umfrage_datei,$umfrage_datenNEU);
    fclose($umfrage_datei);

    # Ergebnisse statt Umfrage anzeigen
    $umfrage_anzeigen=0;

    }
    else
    {

### Ips.dat öffnen und in eine Variable speichern ################################
    $umfrage_datei = fopen("$umfrage_erassoft_ordner/$umfrage_erassoft_ipsdatei","r");
    $umfrage_ips   = file("$umfrage_erassoft_ordner/$umfrage_erassoft_ipsdatei");
    fclose($umfrage_datei);

    $umfrage_ips_zeilen = count($umfrage_ips);

    # Ist die IP schon gespeichert oder noch nicht.
    for($i=0;$i<=$umfrage_ips_zeilen;$i++)
    {

    # | Zeichen Position bestimmen
    $umfrage_erassoft_länge = strlen($umfrage_ips[$i]);
      for($a=0;$a<=$umfrage_erassoft_länge;$a++)
      {
      $umfrage_erassoft_test = substr($umfrage_ips[$i], $a, 1);
        if($umfrage_erassoft_test=='|')
        {
        $umfrage_erassoft_zeichen_pos=$a;
        $a=$umfrage_erassoft_länge;
        }
      }

    # Antwort ausblenden (nur IP anzeigen)
    $umfrage_ips[$i] = substr($umfrage_ips[$i],($umfrage_erassoft_zeichen_pos+1),($umfrage_erassoft_länge-$umfrage_erassoft_zeichen_pos)); 

    # Enter ersetzen durch nix
    $umfrage_ips[$i] = str_replace("
", "", "$umfrage_ips[$i]");

    if($ip==$umfrage_ips[$i])
    {
    # Ergebnisse statt Umfrage anzeigen
    $umfrage_anzeigen=0;
    # IP ist die selbe wie in der Datei (End of File)
    $i=$umfrage_ips_zeilen;
    }
    else
    {
    # Weitergucken
      if($umfrage_ips[$i]=='')
      {
      # Umfrage anzeigen
      $umfrage_anzeigen=1;
      # End of File
      $i=$umfrage_ips_zeilen;
      }
    }
   }
  }
}


### Ausgabe ######################################################################
if($umfrage_anzeigen>=1)
{
# Umfrage anzeigen
include("ausgabe.php");
}
else
{
# Ergebnis anzeigen

# ergebnisse.dat öffnen und in eine Variable speichern
    $umfrage_datei = fopen("$umfrage_erassoft_ordner/ergebnisse.dat","r");
    $umfrage_erassoft_ergebnisse = file("$umfrage_erassoft_ordner/ergebnisse.dat");
     fclose($umfrage_datei);

# Stimmen ausrechnen
$umfrage_erassoft_maximal = 0;
for($i=0; $i<=$umfrage_erassoft_anzahl; $i++)
{
$umfrage_erassoft_maximal = $umfrage_erassoft_maximal + $umfrage_erassoft_ergebnisse[$i];
}

# Prozentrechnung
if($umfrage_erassoft_maximal==0)
{
  for($i=0; $i<=$umfrage_erassoft_anzahl; $i++)
  {
  $umfrage_erassoft_ergebnisse[$i] = 0;
  $umfrage_erassoft_prozent[$i] = 0;
  $umfrage_erassoft_prozent_weite[$i] = 0;
  $umfrage_erassoft_prozent_restweite[$i] = 0;
  }
}
else
{
  for($i=0; $i<=$umfrage_erassoft_anzahl; $i++)
  {
  $umfrage_erassoft_prozent[$i] = 100 * $umfrage_erassoft_ergebnisse[$i] / $umfrage_erassoft_maximal;
  $umfrage_erassoft_prozent[$i] = round($umfrage_erassoft_prozent[$i],2);
  $umfrage_erassoft_prozent_weite[$i] = $umfrage_erassoft_prozent[$i] * $umfrage_erassoft_prozent_maxweite / 100;
  $umfrage_erassoft_prozent_restweite[$i] = $umfrage_erassoft_prozent_maxweite - $umfrage_erassoft_prozent_weite[$i];
  }
}
# Ergebnisse anzeigen
include("ergebnisse.php");
}
}
}
}
echo"

<!-- (c)ErasSoft.de -->
<!-- Umfrage Ende -->
";
?>