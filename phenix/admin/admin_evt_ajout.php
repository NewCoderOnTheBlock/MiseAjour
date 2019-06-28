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

//addevt 1,2
//Ajout d'evenement par l'administrateur a tous (eve_util_id=0) ou individuel
if ($addevt) {
  $zlUtil += 0;
  if ($zlUtil > 0) {
    $DB_CX->DbQuery("SELECT CONCAT(".$FORMAT_NOM_UTIL.") AS nomUtil FROM ${PREFIX_TABLE}utilisateur WHERE util_id=".$zlUtil);
    if (!$DB_CX->DbNumRows()) {
      $nomUtil = $DB_CX->DbResult(0,0);
    }
  }
  if ($zlUtil== -1) {
    $nomUtil = trad("ADMIN_ADEVT_TOUS");
    $zlUtil=0;
    $ckPartage = "O";
  }

  switch ($addevt) {
    case 1 : $titrePage = trad("ADMIN_ADEVT_TITRE"); break;
    case 2 : $titrePage = trad("ADMIN_ADEVT_TITRE1"); break;
  }

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/import.png\">".trad("ADMIN_AJOUT_EVE"),"<B>".sprintf(trad("ADMIN_ETAPE"), $addevt)."</B> - ".$titrePage);

  if ($addevt==2) {
    $ckEntete += 0;
    if ($ckPartage != "O")
      $ckPartage = "N";
    if (!empty($ztFile)) {
      $nbAjout = $nbRejet = 0;
      $listeOK = $listeKO = "";
      $fContents = @file($ztFile);
      for ($cpt=$ckEntete;$cpt<count($fContents);$cpt++) {
        list($dateDebEvt,$dateFinEvt,$libEvt,$typeEvt,$couleurEvt) = explode(";",$fContents[$cpt]);
        list($jDeb,$mDeb,$aDeb) = explode("/",$dateDebEvt);
        if (empty($dateFinEvt)) { // Si la date de fin n'est pas renseigne -> on prend la date de debut
          $dateFinEvt = $dateDebEvt;
        }
        list($jFin,$mFin,$aFin) = explode("/",$dateFinEvt);
        if (ereg ("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $dateDebEvt) && ereg ("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $dateFinEvt) && checkdate($mDeb,$jDeb,$aDeb) && checkdate($mFin,$jFin,$aFin)) {
          // Insertion dans la base
          $DB_CX->DbQuery("INSERT INTO ".$PREFIX_TABLE."evenement (eve_date_debut,eve_date_fin,eve_libelle,eve_type,eve_couleur,eve_util_id,eve_partage) VALUES ('".$aDeb."-".$mDeb."-".$jDeb."','".$aFin."-".$mFin."-".$jFin."','".addslashes(trim($libEvt))."',".($typeEvt+0).",'".trim($couleurEvt)."',".$zlUtil.",'".$ckPartage."')");
          if ($DB_CX->DbAffectedRows()) {
            $nbAjout++;
            $listeOK .= $fContents[$cpt]."<BR>";
          } else {
            $nbRejet++;
            $listeKO .= $fContents[$cpt]."<BR>";
          }
        } else {
          $nbRejet++;
          $listeKO .= $fContents[$cpt]."<BR>";
        }
      }
      if ($nbAjout) {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$nbAjout.sprintf(trad("ADMIN_ADEVT_AJOUT_TBL"), "${PREFIX_TABLE}evenement", $nomUtil)."\n";
        echo "  <BLOCKQUOTE>".$listeOK."</BLOCKQUOTE>\n";
      }
      if ($nbRejet) {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\">".$nbRejet.trad("ADMIN_ADEVT_NO_AJOUT")."<BR>\n";
        echo "  <BLOCKQUOTE>".$listeKO."</BLOCKQUOTE>\n";
      }
    } else {
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".trad("ADMIN_ADEVT_NO_FICHIER")."</FONT><BR>\n";
      $addevt=1;
    }
  }

  if ($addevt==1) {
    //Recuperation de la liste des utilisateurs
    $DB_CX->DbQuery("SELECT util_id, CONCAT(".$FORMAT_NOM_UTIL.") AS nomUtil FROM ${PREFIX_TABLE}utilisateur ORDER BY nomUtil");
    echo ("  <BR><FORM method=\"post\" action=\"${NOM_PAGE}&addevt=2\" name=\"frmAdmEvt\" id=\"frmAdmEvt\" enctype=\"multipart/form-data\">
    <TABLE border=0 cellspacing=0 cellpadding=0 align=\"center\">
      <TR><TD height=\"20\">".trad("ADMIN_CPT_UTIL_EVT")."&nbsp;&nbsp;<SELECT name=\"zlUtil\" size=1 tabindex=\"1\">
        <OPTION value=\"-1\">".trad("ADMIN_TOUS_COMPTE")."</OPTION>\n");
    while ($enr = $DB_CX->DbNextRow()) {
      $selected = ($zlUtil == $enr['util_id']) ? " selected" : "";
      echo "        <OPTION value=\"".$enr['util_id']."\"".$selected.">".$enr['nomUtil']."</OPTION>\n";
    }
    echo ("</SELECT></TD></TR>
      <TR><TD height=\"20\">".trad("ADMIN_ADEVT_FICH_IMPORT")."</TD></TR>
      <TR><TD height=\"20\">".trad("ADMIN_ADEVT_FICH_CVS")."&nbsp;&nbsp;<INPUT type=\"file\" class=\"texte\" name=\"ztFile\" tabindex=\"2\"></TD></TR>
      <TR><TD height=\"20\"><INPUT type=\"checkbox\" class=\"Case\" name=\"ckEntete\" value=\"1\" tabindex=\"3\"".(($ckEntete=="1") ? " checked" : "").">&nbsp;&nbsp;".trad("ADMIN_ADEVT_FICH_PLNG")."</TD></TR>
      <TR><TD height=\"20\"><INPUT type=\"checkbox\" class=\"Case\" name=\"ckPartage\" value=\"O\" tabindex=\"4\"".(($ckPartage=="O") ? " checked" : "").">&nbsp;&nbsp;".trad("ADMIN_ADEVT_PARTAGE")."</TD></TR>
      <TR><TD align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_IMPORT")."\" tabindex=\"5\" onclick=\"javascript: document.frmAdmEvt.submit();\"></TD></TR>
    </TABLE>
  </FORM>
  <SCRIPT language=\"JavaScript\"><!-- document.frmAdmEvt.zlUtil.focus(); --></SCRIPT>");
  }
}
?>
