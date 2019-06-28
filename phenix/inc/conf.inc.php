<?php
  /**************************************************************************\
  * Phenix Agenda                                                            *
  * http://phenix.gapi.fr                                                    *
  * Written by    Stephane TEIL            <phenix-agenda@laposte.net>       *
  * Contributors  Christian AUDEON (Omega) <christian.audeon@gmail.com>      *
  *               Maxime CORMAU (MaxWho17) <maxwho17@free.fr>                *
  *               Mathieu RUE (Frognico)   <matt_rue@yahoo.fr>               *
  *               Bernard CHAIX (Berni69)  <ber123456@free.fr>               *
  * --------------------------------------------                             *
  *  This program is free software; you can redistribute it and/or modify it *
  *  under the terms of the GNU General Public License as published by the   *
  *  Free Software Foundation; either version 2 of the License, or (at your  *
  *  option) any later version.                                              *
  \**************************************************************************/

// ----------------------------------------------------------------------------
// Parametres de l'application
// ----------------------------------------------------------------------------
  $APPLI_VERSION = "5.51";
  $APPLI_LANGUE  = "fr"; // Langue par defaut de Phenix pour la page d'identification notamment

// ----------------------------------------------------------------------------
// Connexion a la base
// ----------------------------------------------------------------------------
  //~ $cfgHote       = "db922.1and1.fr"; // Serveur MySQL
  //~ $cfgUser       = "dbo206617947"; // Utilisateur
  //~ $cfgPass       = "D5ZEtV4h"; // Mot de passe
  //~ $cfgBase       = "db206617947"; // Nom de la base
  //~ $PREFIX_TABLE  = "agenda_"; // Permet de prefixer le nom des tables dans votre base de donnees
  
  $cfgHote       = "localhost"; // Serveur MySQL
  $cfgUser       = "root"; // Utilisateur
  $cfgPass       = ""; // Mot de passe
  $cfgBase       = "db206617947"; // Nom de la base
  $PREFIX_TABLE  = "agenda_"; // Permet de prefixer le nom des tables dans votre base de donnees
  $CHEMIN_ABSOLU = true;
  if ($_GET['msg']!="6") {
    // Selon votre version de PHP, il vous faudra peut-etre indiquer ici le chemin absolu
    include("../phenix/inc/db_class.inc.php");
  }

  define("_CONF_INC_LOADED",true);
?>
