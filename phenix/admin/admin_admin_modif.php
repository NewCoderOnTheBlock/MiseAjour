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

// modadm 1,2,3 = modification d'un compte administrateur
if ($modadm) {
  $zlAdmin += 0;

  if ($zlAdmin) {
    $DB_CX->DbQuery("SELECT admin_login, admin_passwd FROM ${PREFIX_TABLE}admin WHERE admin_id=".$zlAdmin);
    if ($AdmData = $DB_CX->DbNextRow()) {
      $nomAdm = $AdmData['admin_login'];
    } else {
      $modadm = 1;
    }
  }

  switch ($modadm) {
    case 1 : $titrePage = trad("ADMIN_SELECT_ADMIN"); break;
    case 2 : $titrePage = sprintf(trad("ADMIN_MOD_ADMIN"), $nomAdm); break;
    case 3 : $titrePage = sprintf(trad("ADMIN_ENR_MOD_UTIL"), $nomAdm); break;
  }

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/mod.png\">".trad("ADMIN_MAJ_COMPTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), $modadm)."</B> - ".$titrePage);

// etape 3
// Compte rendu de la modification du compte
  if ($zlAdmin && $modadm==3) {
    // Verifie si le login choisi n'est pas deja utilise
    $DB_CX->DbQuery("SELECT admin_id FROM ${PREFIX_TABLE}admin WHERE admin_login='".$ztLogin."' AND admin_id!=".$zlAdmin);
    if (!$DB_CX->DbNumRows()) {
      $DB_CX->DbQuery("UPDATE ${PREFIX_TABLE}admin SET admin_login='".$ztLogin."',admin_passwd='".$ztPasswdMD5."' WHERE admin_id=".$zlAdmin);
      if ($DB_CX->DbAffectedRows()) {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_ENR_MOD_TBL"), "${PREFIX_TABLE}admin")."<BR>\n";
        if ($ztLogin == $AdmData['admin_login'])
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_ENR_MOD_LOGIN_INCHANGE")."<BR>\n";
        else
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_ENR_MOD_LOGIN_CHANGE"), $AdmData['admin_login'], $ztLogin)."<BR>\n";
        if ($ztPasswdMD5 == $AdmData['admin_passwd'])
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_ENR_MOD_MDP_INCHANGE")."<BR>\n";
        else
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_ENR_MOD_MDP_CHANGE")."<BR>\n";
      } else
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_MOD_UTIL_INCHANGE"), "${PREFIX_TABLE}admin")."</FONT><BR>\n";
    } else {
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_ADMIN_EXISTE"), $ztLogin)."</FONT><BR>\n";
    }
  }

// etape 1
// Recuperation de la liste des comptes administrateurs existants et choix du compte a modifier
  $DB_CX->DbQuery("SELECT admin_id, admin_login FROM ${PREFIX_TABLE}admin ORDER BY admin_login");
  echo ("  <BR><FORM method=\"post\" action=\"${NOM_PAGE}&modadm=2\" name=\"frmAdmListe\" id=\"frmAdmListe\">
    <TABLE width=\"100%\" border=0 cellspacing=0 cellpadding=0>
      <TR><TD align=\"center\" height=\"20\">".trad("ADMIN_MOD_CPT_ADM")."&nbsp;&nbsp;<SELECT name=\"zlAdmin\" size=1>\n");
  while ($enr = $DB_CX->DbNextRow()) {
    $selected = ($zlAdmin == $enr['admin_id']) ? " selected" : "";
    echo "        <OPTION value=\"".$enr['admin_id']."\"".$selected.">".$enr['admin_login']."</OPTION>\n";
  }
  echo ("      </SELECT></TD></TR>
      <TR><TD align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_MODIFIER")."\" onclick=\"javascript: document.frmAdmListe.submit();\"></TD></TR>
    </TABLE>
  </FORM>
  <SCRIPT language=\"JavaScript\"><!-- document.frmAdmListe.zlAdmin.focus(); --></SCRIPT>");

// etape 2
// Modification du compte administrateur
  if ($zlAdmin && $modadm==2) {
    echo "</TD>
  </TR>
  <TR>
    <TD bgcolor=\"".$bgColor[0]."\"><BR><FORM method=\"post\" action=\"${NOM_PAGE}&modadm=3\" name=\"frmAdmModif\" id=\"frmAdmModif\">
    <INPUT type=\"hidden\" name=\"zlAdmin\" value=\"".$zlAdmin."\">
    <TABLE border=0 cellspacing=0 cellpadding=0 width=\"100%\">
      <TR><TD align=\"right\" height=\"20\" width=\"50%\">".trad("ADMIN_LBL_LOGIN")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"text\" name=\"ztLogin\" size=\"15\" maxlength=\"12\" tabindex=\"3\" value=\"".$AdmData['admin_login']."\" class=\"texte\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_MDP")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"password\" name=\"ztPasswd\" size=\"15\" maxlength=\"12\" tabindex=\"5\" value=\"\" class=\"texte\"><INPUT type=\"hidden\" name=\"ztPasswdMD5\" value=\"".$AdmData['admin_passwd']."\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_CONF_MDP")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"password\" name=\"ztConfirmPasswd\" size=\"15\" maxlength=\"12\" tabindex=\"6\" value=\"\" class=\"texte\"></TD></TR>
      <TR><TD colspan=2 align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_ENREGISTRER")."\" tabindex=\"7\" onclick=\"javascript: return saisieOK(document.frmAdmModif);\"></TD></TR>
    </TABLE>
  </FORM>";
  }
}
?>
