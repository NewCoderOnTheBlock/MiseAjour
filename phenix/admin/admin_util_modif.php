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

// modcpt 1,2,3 = modification d'un compte utilisateur
if ($modcpt) {
  $zlUtil += 0;

  if ($zlUtil) {
    $DB_CX->DbQuery("SELECT util_nom, util_prenom, util_login, util_passwd, droit_admin FROM ${PREFIX_TABLE}utilisateur, ${PREFIX_TABLE}droit WHERE droit_util_id=util_id AND util_id =".$zlUtil);
    if ($UtilData = $DB_CX->DbNextRow()) {
      $nomUtil = $UtilData['util_nom'];
      $prenomUtil = $UtilData['util_prenom'];
      $droitUtil = $UtilData['droit_admin'];
    } else {
      $modcpt = 1;
    }
  }
  $ztNom    = ($AUTO_UPPERCASE == true) ? strtoupper($ztNom) : ucfirst(strtolower($ztNom));
  $ztPrenom = ucfirst($ztPrenom);

  switch ($modcpt) {
    case 1 : $titrePage = trad("ADMIN_SELECT_UTIL"); break;
    case 2 : $titrePage = sprintf(trad("ADMIN_MOD_UTIL"), $prenomUtil, $nomUtil); break;
    case 3 : $titrePage = sprintf(trad("ADMIN_ENR_MOD_UTIL"), $ztPrenom, $ztNom); break;
  }

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/mod.png\">".trad("ADMIN_MAJ_COMPTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), $modcpt)."</B> - ".$titrePage);

// etape 3
// Compte rendu de la modification du compte
  if ($zlUtil && $modcpt==3) {
    // Verifie si le login choisi n'est pas deja utilise
    $DB_CX->DbQuery("SELECT util_id FROM ${PREFIX_TABLE}utilisateur WHERE util_login='".$ztLogin."' AND util_id!=".$zlUtil);
    if (!$DB_CX->DbNumRows()) {
      $DB_CX->DbQuery("UPDATE ${PREFIX_TABLE}utilisateur SET util_nom='".$ztNom."', util_prenom='".$ztPrenom."', util_login='".$ztLogin."', util_passwd='".$ztPasswdMD5."' WHERE util_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()) {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_ENR_MOD_TBL"), "${PREFIX_TABLE}utilisateur")."<BR>\n";
        if ($ztNom == $UtilData['util_nom'])
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_ENR_MOD_NOM_INCHANGE")."<BR>\n";
        else
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_ENR_MOD_NOM_CHANGE"), $UtilData['util_nom'], $ztNom)."<BR>\n";
        if ($ztPrenom == $UtilData['util_prenom'])
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_ENR_MOD_PRENOM_INCHANGE")."<BR>\n";
        else
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_ENR_MOD_PRENOM_CHANGE"), $UtilData['util_prenom'], $ztPrenom)."<BR>\n";
        if ($ztLogin == $UtilData['util_login'])
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_ENR_MOD_LOGIN_INCHANGE")."<BR>\n";
        else
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_ENR_MOD_LOGIN_CHANGE"), $UtilData['util_login'], $ztLogin)."<BR>\n";
        if ($ztPasswdMD5 == $UtilData['util_passwd'])
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_ENR_MOD_MDP_INCHANGE")."<BR>\n";
        else
          echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_ENR_MOD_MDP_CHANGE")."<BR>\n";
      } else {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_MOD_UTIL_INCHANGE"), "${PREFIX_TABLE}utilisateur")."</FONT><BR>\n";
      }
      // Changement des droits d'administration
      if($ckIsAdmin!="O") {
        // Avant de retirer un administrateur on verifie qu'il en restera encore au moins un
        $DB_CX->DbQuery("SELECT droit_util_id FROM ${PREFIX_TABLE}droit WHERE droit_admin='O' AND droit_util_id!=".$zlUtil);
        $ckIsAdmin = ($DB_CX->DbNumRows()) ? "N" : "O";
      }
      $DB_CX->DbQuery("UPDATE ${PREFIX_TABLE}droit SET droit_admin='".$ckIsAdmin."' WHERE droit_util_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows())
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_ENR_MOD_TBL"), "${PREFIX_TABLE}droit")."<BR>\n";
      else
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_MOD_UTIL_INCHANGE"), "${PREFIX_TABLE}droit")."</FONT><BR>\n";
    } else {
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_ENR_UTIL_EXISTE"), $ztLogin)."</FONT><BR>\n";
    }
  }

// etape 1
// Recuperation de la liste des comptes utilisateurs existants et choix du compte a modifier
  $DB_CX->DbQuery("SELECT util_id, CONCAT(".$FORMAT_NOM_UTIL.") AS nomUtil FROM ${PREFIX_TABLE}utilisateur ORDER BY nomUtil");
  echo ("  <BR><FORM method=\"post\" action=\"${NOM_PAGE}&modcpt=2\" name=\"frmUtilListe\" id=\"frmUtilListe\">
    <TABLE width=\"100%\" border=0 cellspacing=0 cellpadding=0>
      <TR><TD align=\"center\" height=\"20\">".trad("ADMIN_CPT_UTIL_MOD")."&nbsp;&nbsp;<SELECT name=\"zlUtil\" size=1>\n");
  while ($enr = $DB_CX->DbNextRow()) {
    $selected = ($zlUtil == $enr['util_id']) ? " selected" : "";
    echo "        <OPTION value=\"".$enr['util_id']."\"".$selected.">".$enr['nomUtil']."</OPTION>\n";
  }
  echo ("      </SELECT></TD></TR>
      <TR><TD align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_MODIFIER")."\" onclick=\"javascript: document.frmUtilListe.submit();\"></TD></TR>
    </TABLE>
  </FORM>
  <SCRIPT language=\"JavaScript\"><!-- document.frmUtilListe.zlUtil.focus(); --></SCRIPT>");

// etape 2
// Modification du compte utilisateur
  if ($zlUtil && $modcpt==2) {
    $casseNom = ($AUTO_UPPERCASE == true) ? "uppercase" : "capitalize";
    echo "</TD>
  </TR>
  <TR>
    <TD bgcolor=\"".$bgColor[0]."\"><BR><FORM method=\"post\" action=\"${NOM_PAGE}&modcpt=3\" name=\"frmUtilModif\" id=\"frmUtilModif\">
    <INPUT type=\"hidden\" name=\"zlUtil\" value=\"".$zlUtil."\">
    <TABLE border=0 cellspacing=0 cellpadding=0 width=\"100%\">
      <TR><TD align=\"right\" height=\"20\" width=\"50%\">".trad("ADMIN_LBL_NOM")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"text\" name=\"ztNom\" size=\"25\" maxlength=\"32\" tabindex=\"1\" value=\"".$UtilData['util_nom']."\" style=\"text-transform:".$casseNom.";\" class=\"texte\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_PRENOM")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"text\" name=\"ztPrenom\" size=\"25\" maxlength=\"32\" tabindex=\"2\" value=\"".$UtilData['util_prenom']."\" style=\"text-transform: capitalize;\" class=\"texte\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_LOGIN")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"text\" name=\"ztLogin\" size=\"15\" maxlength=\"12\" tabindex=\"3\" value=\"".$UtilData['util_login']."\" class=\"texte\">&nbsp;&nbsp;&nbsp;<INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_AUTO")."\" name=\"btAutoLogin\" tabindex=\"4\" onclick=\"javascript: loginAuto(document.frmUtilModif);\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_NVMDP")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"password\" name=\"ztPasswd\" size=\"15\" maxlength=\"12\" tabindex=\"5\" value=\"\" class=\"texte\"><INPUT type=\"hidden\" name=\"ztPasswdMD5\" value=\"".$UtilData['util_passwd']."\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_LBL_CONF_MDP")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"password\" name=\"ztConfirmPasswd\" size=\"15\" maxlength=\"12\" tabindex=\"6\" value=\"\" class=\"texte\"></TD></TR>
      <TR><TD align=\"right\" height=\"20\">".trad("ADMIN_UTIL_EST_ADMIN")."</TD><TD>&nbsp;&nbsp;<INPUT type=\"checkbox\" class=\"Case\" name=\"ckIsAdmin\" value=\"O\" class=\"Case\" tabindex=\"7\"".(($UtilData['droit_admin']=="O") ? " checked" : "")."></TD></TR>
      <TR><TD colspan=2 align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_ENREGISTRER")."\" tabindex=\"8\" onclick=\"javascript: return saisieOK(document.frmUtilModif);\"></TD></TR>
    </TABLE>
    </FORM></TD>
  </TR>
  <TR>
    <TD bgcolor=\"".$bgColor[1]."\">
      <TABLE border=0 cellspacing=0 cellpadding=0 width=\"100%\">
        <TR>
          <TD align=\"center\" height=\"30\" width=\"50%\">
            <FORM method=\"post\" action=\"agenda_traitement.php?sid=".$sid."&sd=".date("Y-n-j", $sd)."&tcMenu=13&tcPlg=1&ztAction=SUBST&suid=".$zlUtil."\" name=\"frmUtilModifPrf\" id=\"frmUtilModifPrf\">
            <INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_MODIF_PROFIL")."\" onclick=\"document.frmUtilModifPrf.submit();\" tabindex=\"9\">
            </FORM>
          </TD>
        </TR> 
      </TABLE>";
  }
}
?>
