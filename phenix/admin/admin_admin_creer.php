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

//nvadm 1,2
//Creation d'un compte administrateur (mode admin)
if ($nvadm) {
  switch ($nvadm) {
    case 1 : $titrePage = trad("ADMIN_CPT_ADMIN"); break;
    case 2 : $titrePage = sprintf(trad("ADMIN_ENREG_ADMIN"),$ztLogin); break;
  }

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/ajout.png\">".trad("ADMIN_CREER_COMPTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), $nvadm)."</B> - ".$titrePage);

// etape 2
// Compte rendu de la creation du compte
  if ($nvadm==2) {
    // Verifie si le login choisi n'est pas deja utilise
    $DB_CX->DbQuery("SELECT admin_id FROM ${PREFIX_TABLE}admin WHERE admin_login='".$ztLogin."'");
    if (!$DB_CX->DbNumRows()) {
      $DB_CX->DbQuery("INSERT INTO ${PREFIX_TABLE}admin (admin_login, admin_passwd) VALUES ('".$ztLogin."','".$ztPasswdMD5."')");
      if ($DB_CX->DbAffectedRows()) {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_ENR_AJOUT_TBL"), "${PREFIX_TABLE}admin")."<BR>\n";
      } else {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_ECHEC_AJOUT_TBL"), "${PREFIX_TABLE}admin")."</FONT><BR>\n";
      }
    } else {
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_ADMIN_EXISTE"), $ztLogin)."</FONT><BR>\n";
    }
  }

// etape 1
// Renseignement des informations du compte a creer
  echo ("  <BR><FORM method=\"post\" action=\"${NOM_PAGE}&nvadm=2\" name=\"frmAdmCreer\" id=\"frmAdmCreer\">
    <TABLE border=0 cellspacing=0 cellpadding=0 width=\"100%\">
      <TR><TD align=\"right\" height=\"20\" width=\"50%\">".trad("ADMIN_LBL_LOGIN")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"text\" name=\"ztLogin\" size=\"15\" maxlength=\"12\" tabindex=\"1\" value=\"\" class=\"texte\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_MDP")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"password\" name=\"ztPasswd\" size=\"15\" maxlength=\"12\" tabindex=\"2\" value=\"\" class=\"texte\"><INPUT type=\"hidden\" name=\"ztPasswdMD5\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_CONF_MDP")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"password\" name=\"ztConfirmPasswd\" size=\"15\" maxlength=\"12\" tabindex=\"3\" value=\"\" class=\"texte\"></TD></TR>
      <TR><TD colspan=2 align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_ENREGISTRER")."\" tabindex=\"4\" onclick=\"javascript: return saisieOK(document.frmAdmCreer);\"></TD></TR>
    </TABLE>
  </FORM>
  <SCRIPT language=\"JavaScript\"><!-- document.frmAdmCreer.ztLogin.focus(); --></SCRIPT>");
}
?>
