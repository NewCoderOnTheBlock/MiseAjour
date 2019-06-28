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

//Optimisation de la base de donnees
if ($optimize) {
  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/optim.png\">".trad("ADMIN_OPT_DB"),sprintf(trad("ADMIN_TITRE_OPTIMIZE"), strtoupper($cfgBase)));

  // Creation d'une nouvelle instance pour l'execution de requetes en boucle
  $DB = new Db($DB_CX->ConnexionID);
  // On extrait la liste des tables et demarre l'optimisation par table
  $DB_CX->DbListTable($cfgBase);
  while (list($table_name) = $DB_CX->DbNextRow()) {
    // On ne traite que les tables "Phenix"
    if (ereg("^${PREFIX_TABLE}",$table_name)) {
      if ($DB->DbQuery("OPTIMIZE TABLE ".$table_name)) {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_TBL_OPTIMIZE"), $table_name)."\n";
      } else {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_TBL_NON_OPTIMIZE"), $table_name)."\n";
      }
    }
  }
  echo "  <BR><BR>\n";
}
?>
