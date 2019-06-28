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

  $Fich_mod_lng[] = "_mod-xxxxxxxxx.php";

  for ($i = 0; $i < count($Fich_mod_lng); $i++) {
    if (file_exists("lang/mods/".$APPLI_LANGUE.$Fich_mod_lng[$i])) {
      include $APPLI_LANGUE.$Fich_mod_lng[$i];
    } elseif (file_exists("lang/mods/fr".$Fich_mod_lng[$i])) {
        include "fr".$Fich_mod_lng[$i];
    }
  }
?>
