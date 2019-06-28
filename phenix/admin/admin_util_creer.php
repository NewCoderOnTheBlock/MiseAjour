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

//nvcpt 1,2
//Creation d'un compte utilisateur (mode admin)
if ($nvcpt) {
  $ztNom    = ($AUTO_UPPERCASE == true) ? strtoupper($ztNom) : ucfirst(strtolower($ztNom));
  $ztPrenom = ucfirst($ztPrenom);

  switch ($nvcpt) {
    case 1 : $titrePage = trad("ADMIN_COMPT_UTIL"); break;
    case 2 : $titrePage = sprintf(trad("ADMIN_ENR_UTIL"),$ztPrenom,$ztNom); break;
  }

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/ajout.png\">".trad("ADMIN_CREER_COMPTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), $nvcpt)."</B> - ".$titrePage);

// etape 2
// Compte rendu de la creation du compte
  if ($nvcpt==2) {
    // Verifie si le login choisi n'est pas deja utilise
    $DB_CX->DbQuery("SELECT util_id FROM ${PREFIX_TABLE}utilisateur WHERE util_login='".$ztLogin."'");
    if (!$DB_CX->DbNumRows()) {
      $DB_CX->DbQuery("INSERT INTO ${PREFIX_TABLE}utilisateur (util_nom, util_prenom, util_login, util_passwd, util_url_export) VALUES ('".$ztNom."', '".$ztPrenom."', '".$ztLogin."', '".$ztPasswdMD5."', '".md5(uniqid(rand()))."')");
      if ($DB_CX->DbAffectedRows() && $idUtil=$DB_CX->DbInsertID()) {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_ENR_AJOUT_TBL"), "${PREFIX_TABLE}utilisateur");
        $DB_CX->DbQuery("INSERT INTO ${PREFIX_TABLE}calepin_groupe (cgr_util_id, cgr_nom) VALUES (".$idUtil.", '".trad("COMMUN_NON_CLASSE")."')");
        if ($DB_CX->DbAffectedRows())
          echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_ENR_AJOUT_TBL"), "${PREFIX_TABLE}calepin_groupe");
        else
          echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_ECHEC_AJOUT_TBL"), "${PREFIX_TABLE}calepin_groupe")."</FONT>";
        $DB_CX->DbQuery("INSERT INTO ${PREFIX_TABLE}favoris_groupe (fgr_util_id, fgr_nom) VALUES (".$idUtil.", '".trad("COMMUN_NON_CLASSE")."')");
        if ($DB_CX->DbAffectedRows())
          echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_ENR_AJOUT_TBL"), "${PREFIX_TABLE}favoris_groupe");
        else
          echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_ECHEC_AJOUT_TBL"), "${PREFIX_TABLE}favoris_groupe")."</FONT>";
        $DB_CX->DbQuery("INSERT INTO ${PREFIX_TABLE}droit (droit_util_id, droit_admin) VALUES (".$idUtil.", '".(($ckIsAdmin!="O") ? "N" : "O")."')");
        if ($DB_CX->DbAffectedRows())
          echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_ENR_AJOUT_TBL"), "${PREFIX_TABLE}droit");
        else
          echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_ECHEC_AJOUT_TBL"), "${PREFIX_TABLE}droit")."</FONT>";
      } else {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_ECHEC_AJOUT_TBL"), "${PREFIX_TABLE}utilisateur")."</FONT>";
      }
    } else {
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_UTIL_EXISTE"), $ztLogin)."</FONT>";
    }
  }

// etape 1
// Renseignement des informations du compte a creer
  $casseNom = ($AUTO_UPPERCASE == true) ? "uppercase" : "capitalize";
  echo ("  <BR><FORM method=\"post\" action=\"${NOM_PAGE}&nvcpt=2\" name=\"frmUtilCreer\" id=\"frmUtilCreer\">
    <TABLE border=0 cellspacing=0 cellpadding=0 width=\"100%\">
      <TR><TD align=\"right\" height=\"20\" width=\"50%\">".trad("ADMIN_LBL_NOM")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"text\" name=\"ztNom\" size=\"25\" maxlength=\"32\" tabindex=\"1\" value=\"\" style=\"text-transform:".$casseNom.";\" class=\"texte\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_PRENOM")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"text\" name=\"ztPrenom\" size=\"25\" maxlength=\"32\" tabindex=\"2\" value=\"\" style=\"text-transform: capitalize;\" class=\"texte\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_LOGIN")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"text\" name=\"ztLogin\" size=\"15\" maxlength=\"12\" tabindex=\"3\" value=\"\" class=\"texte\">&nbsp;&nbsp;&nbsp;<INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_AUTO")."\" name=\"btAutoLogin\" tabindex=\"4\" onclick=\"javascript: loginAuto(document.frmUtilCreer);\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_MDP")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"password\" name=\"ztPasswd\" size=\"15\" maxlength=\"12\" tabindex=\"5\" value=\"\" class=\"texte\"><INPUT type=\"hidden\" name=\"ztPasswdMD5\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_CONF_MDP")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"password\" name=\"ztConfirmPasswd\" size=\"15\" maxlength=\"12\" tabindex=\"6\" value=\"\" class=\"texte\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_UTIL_EST_ADMIN")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"checkbox\" class=\"Case\" name=\"ckIsAdmin\" value=\"O\" class=\"Case\" tabindex=\"7\"></TD></TR>
      <TR><TD colspan=2 align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_ENREGISTRER")."\" tabindex=\"8\" onclick=\"javascript: return saisieOK(document.frmUtilCreer);\"></TD></TR>
    </TABLE>
  </FORM>
  <SCRIPT language=\"JavaScript\"><!-- document.frmUtilCreer.ztNom.focus(); --></SCRIPT>");
}
?>
