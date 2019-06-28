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

//backup 1,2,3
//Sauvegarde de la base de donnees
if ($backup) {

  switch ($backup) {
    case 1 : $titrePage = trad("ADMIN_BACKUP_TITRE1"); break;
    case 2 : $titrePage = trad("ADMIN_BACKUP_TITRE2"); break;
    case 3 : $titrePage = trad("ADMIN_BACKUP_TITRE3"); break;
  }

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/sql.png\">".trad("ADMIN_SAVE_DB"),"<B>".sprintf(trad("ADMIN_ETAPE"), $backup)."</B> - ".$titrePage);

?>
  <SCRIPT language="JavaScript" type="text/javascript">
  <!--
    // Poste le formulaire pour l'enregistrement des parametres
    function enregParam(theForm) {
      theForm.backup.value="3";
      submitForm(theForm);
    }
    function submitForm(theForm) {
      theForm.XT_TAILLE_FIC.disabled=false;
      theForm.XT_MAIL.disabled=false;
      theForm.submit();
    }
  //-->
  </SCRIPT>
<?php
###########################################################################
##                      -=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-=-               ##
##                      XT-DUMP v 0.7 :  Mysql Dump System               ##
##                      -=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-=-               ##
##                                                                       ##
## -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- ##
##                                                                       ##
##     Copyright (c) 2001-2003 by DreaXTeam (webmaster@dreaxteam.net)    ##
##                          http://dreaxteam.net                         ##
##                                                                       ##
## This program is free software. You can redistribute it and/or modify  ##
## it under the terms of the GNU General Public License as published by  ##
## the Free Software Foundation.                                         ##
###########################################################################

/*
  NE PLUS MODIFIER LE FICHIER EN DESSOUS DE CETTE LIGNE (Sauf si vous savez ce que vous faites ;) )
  DO NOT MODIFY THE FILE BELOW THIS LINE (unless you know what you're doing ;)).
*/

  @set_time_limit(600);
  $path = "";
  include($path."inc/xtdump.inc.php");

  /* Header */
  $header = "<BR><CENTER>";

  /* Footer */
  $footer = "<BR><A href=\"http://dreaxteam.net\" target=\"_blank\">XT-Dump v0.7 - Copyrights &copy; 2001-2003 DreaXTeaM</A><BR><BR></CENTER>";

// ----------------------------------------------------------------------------
// EXECUTION DE LA SAUVEGARDE
// ----------------------------------------------------------------------------
  if ($backup==2) {
    if (!is_array($tbls)) {
      die($header."<FONT color=\"red\"><B>".trad("XTDUMP_NO_TABLE")."</B></FONT><BR><BR><FORM><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("XTDUMP_RETOUR")."\" onclick=\"window.location.href ='${NOM_PAGE}&backup=1'\"></FORM><BR>".$footer."</TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");
    }
    if($XT_SCINDER_FIC == 1) {
      if (!is_numeric($XT_TAILLE_FIC)) {
        die($header."<FONT color=\"red\"><B>".trad("XTDUMP_TAILLE_FICH")."</B></FONT><BR><BR><FORM><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("XTDUMP_RETOUR")."\" onclick=\"window.location.href ='${NOM_PAGE}&backup=1'\"><BR></FORM>".$footer."</TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");
      }
      if ($XT_TAILLE_FIC < 200000) {
        die($header."<FONT color=\"red\"><B>".trad("XTDUMP_TAILLE_FICH2")."</B></FONT><BR><BR><FORM><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("XTDUMP_RETOUR")."\" onclick=\"window.location.href ='${NOM_PAGE}&backup=1'\"><BR></FORM>".$footer."</TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");
      }
    }

    /* Linearisation du tableau */
    $tbl = array();
    $tbl[] = reset($tbls);
    if (count($tbls) > 1) {
      $a = true;
      while ($a != false) {
        $a = next($tbls);
        if ($a != false) {
          $tbl[] = $a;
        }
      }
    }

    /* Gestion des Options de sauvegarde */
    if ($XT_TYPE_SAV == "1") {
      $sv_s = true;
      $sv_d = true;
    } else if ($XT_TYPE_SAV == "2") {
      $sv_s = true;
      $sv_d = false;
      $fc   = "_struct";
    } else if ($XT_TYPE_SAV == "3") {
      $sv_s = false;
      $sv_d = true;
      $fc   = "_data";
    } else {
      exit;
    }

    $fext = "." . $XT_FORMAT_SAV;
    $fich = $cfgBase . $fc . $fext;

    /* Ecraser ou non le fichier */
    $dte = "";
    if ($XT_ECRASE != "1") {
      $dte = date("dMy_Hi")."_";
    }

    $gz = "";
    if ($XT_COMPRESS_GZIP == "1") {
      $gz .= ".gz";
    }

    $fcut = false;
    $ftbl = false;
    $f_nm = array();
    if($XT_SCINDER_FIC == "1") {
      $fcut = true;
      $fzmax = $XT_TAILLE_FIC;
      $nbf = 1;
      $f_size = 170;
    }
    if ($XT_FIC_PAR_TABLE == "1") {
      $ftbl = true;
    } else {
      if (!$fcut) {
        open_file($path."backup/dump_".$dte.$cfgBase.$fc.$fext.$gz,$XT_COMPRESS_GZIP,$cfgBase);
      } else {
        open_file($path."backup/dump_".$dte.$cfgBase.$fc."_1".$fext.$gz,$XT_COMPRESS_GZIP,$cfgBase);
      }
    }
    $nbf = 1;

    /* Verification des parametres de connexion */
    ($db = @mysql_connect($cfgHote, $cfgUser, $cfgPass)) or die($header."&nbsp;&nbsp;<IMG border=0 src=\"./image/actionko.gif\" align=\"absmiddle\"><font color=\"#ff0000\">".trad("XTDUMP_IMP_CONNECT_SRV")."</FONT><BR><BR><FORM><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("XTDUMP_RETOUR")."\" onclick=\"window.location.href ='${NOM_PAGE}&backup=1'\"></FORM><BR>".$footer."</TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");
    @mysql_select_db($cfgBase,$db) or die($header."&nbsp;&nbsp;<IMG border=0 src=\"./image/actionko.gif\" align=\"absmiddle\"><font color=\"#ff0000\">".trad("XTDUMP_IMP_CONNECT_BASE")."</FONT><BR><BR><FORM><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("XTDUMP_RETOUR")."\" onclick=\"window.location.href ='${NOM_PAGE}&backup=1'\"></FORM><BR>".$footer."</TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");

    $tblsv = do_backup($PREFIX_TABLE, $XT_DROP_TABLE, $XT_COMPRESS_GZIP, $cfgBase, $fzmax);

    @mysql_close();
    if (!$ftbl) {
      close_file($XT_COMPRESS_GZIP);
    }
    echo ($header.sprintf(trad("XTDUMP_FICH_SAUV"), $tblsv)."<BR><BR>
  <TABLE width=\"400\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" style=\"border-collapse:separate;\" bgcolor=\"$AgendaBordureTableau\">
  <TR>
    <TD class=\"sousMenu\" align=\"center\"><B>".trad("XTDUMP_TITRE_NOM")."</B></TD>
    <TD class=\"sousMenu\" align=\"center\"><B>".trad("XTDUMP_TITRE_TAILLE")."</B></TD>
  </TR>\n");
    reset($f_nm);
    while (list($i,$val) = each($f_nm)) {
      $coul = $bgColor[0];
      if ($i % 2) {
        $coul = $bgColor[1];
      }
      echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;<A href=\"".$val."\" target=\"_blank\">".$val."</A>&nbsp;</TD>\n");
      $fz_tmp = filesize($val);
      if ($fcut && ($fz_tmp > $fzmax)) {
        echo ("    <TD bgcolor=".$coul.">&nbsp;<FONT color=\"red\">".sprintf(trad("XTDUMP_IMP_OCTET"), $fz_tmp)."</FONT>&nbsp;</TD>
    </TR>\n");
      } else {
        echo ("    <TD bgcolor=".$coul.">&nbsp;".sprintf(trad("XTDUMP_IMP_OCTET"), $fz_tmp)."&nbsp;</TD>
      </TR>\n");
      }
    }
    echo "  </TABLE><BR>";
    echo $footer;
  }


// ----------------------------------------------------------------------------
// ENREGISTREMENT DE LA CONFIGURATION
// ----------------------------------------------------------------------------
  elseif ($backup==3) {

    if (!is_array($tbls)) {
      die($header."<FONT color=\"red\"><B>".trad("XTDUMP_NO_TABLE")."</B></FONT><BR><BR><FORM><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("XTDUMP_RETOUR")."\" onclick=\"window.location.href ='${NOM_PAGE}&backup=1'\"></FORM><BR>".$footer."</TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");
    }
    if($XT_SCINDER_FIC == 1) {
      if (!is_numeric($XT_TAILLE_FIC)) {
        die($header."<FONT color=\"red\"><B>".trad("XTDUMP_TAILLE_FICH")."</B></FONT><BR><BR><FORM><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("XTDUMP_RETOUR")."\" onclick=\"window.location.href ='${NOM_PAGE}&backup=1'\"></FORM><BR>".$footer."</TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");
      }
      if ($XT_TAILLE_FIC < 200000) {
        die($header."<FONT color=\"red\"><B>".trad("XTDUMP_TAILLE_FICH2")."</B></FONT><BR><BR><FORM><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("XTDUMP_RETOUR")."\" onclick=\"window.location.href ='${NOM_PAGE}&backup=1'\"></FORM><BR>".$footer."</TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");
      }
    }

    $XT_PERIODICITE = set2nul($XT_PERIODICITE);
    $XT_ECRASE = set2nul($XT_ECRASE);
    $XT_COMPRESS_GZIP = set2nul($XT_COMPRESS_GZIP);
    $XT_SCINDER_FIC = set2nul($XT_SCINDER_FIC);
    $XT_FIC_PAR_TABLE = set2nul($XT_FIC_PAR_TABLE);
    $XT_DROP_TABLE = set2nul($XT_DROP_TABLE);
    $XT_ENVOI_MAIL = set2nul($XT_ENVOI_MAIL);
    if ($XT_PERIODICITE=="0")
      $XT_ENVOI_MAIL = "0";

    // Insertion ou mise a jour en base des parametres
    insertOrUpdate('XT_MAIL', $XT_MAIL, 1);
    insertOrUpdate('XT_ENVOI_MAIL', $XT_ENVOI_MAIL, 1);
    insertOrUpdate('XT_TYPE_SAV', $XT_TYPE_SAV, 1);
    insertOrUpdate('XT_PERIODICITE', $XT_PERIODICITE, 1);
    insertOrUpdate('XT_FORMAT_SAV', $XT_FORMAT_SAV, 1);
    insertOrUpdate('XT_ECRASE', $XT_ECRASE, 1);
    insertOrUpdate('XT_TAILLE_FIC', $XT_TAILLE_FIC, 1);
    insertOrUpdate('XT_COMPRESS_GZIP', $XT_COMPRESS_GZIP, 1);
    insertOrUpdate('XT_SCINDER_FIC', $XT_SCINDER_FIC, 1);
    insertOrUpdate('XT_DROP_TABLE', $XT_DROP_TABLE, 1);
    insertOrUpdate('XT_FIC_PAR_TABLE', $XT_FIC_PAR_TABLE, 1);
    insertOrUpdate('XT_TABLE_SAV', implode(",",$tbls), 1);
    insertOrUpdate('XT_NEXT_SAV', 0, 1);

    echo $header;
    echo ("<TABLE width=\"400\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" style=\"border-collapse:separate;\" bgcolor=\"$AgendaBordureTableau\">
  <TR>
    <TD class=\"sousMenu\" align=\"center\"><B>".trad("XTDUMP_TITRE_PARAM")."</B></TD>
    <TD class=\"sousMenu\" align=\"center\"><B>".trad("XTDUMP_TITRE_VALEUR")."</B></TD>
  </TR>\n");
    $iColor=0;
    $coul=$bgColor[++$iColor%2];

    // Periodicite de sauvegarde
    echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_PERIOD")."&nbsp;</A></TD>
    <TD bgcolor=".$coul." align=\"center\">&nbsp;".trad("XTDUMP_PERIOD_".$XT_PERIODICITE)."&nbsp;</TD>
  </TR>\n");

    // Envoi sauvegarde par mail
    $coul=$bgColor[++$iColor%2];
    echo ("   <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_MAIL")."&nbsp;</A></TD>\n");
    if ($XT_PERIODICITE!="0" && $XT_ENVOI_MAIL=="1") {
      echo ("    <TD bgcolor=".$coul." align=\"center\">&nbsp;<font color=\"green\">".trad("XTDUMP_OUI")."</font>&nbsp;</TD>
  </TR>\n");
      $coul=$bgColor[++$iColor%2];
      echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_MAIL_ADR")."&nbsp;</A></TD>
    <TD bgcolor=".$coul." align=\"center\">&nbsp;".$XT_MAIL."&nbsp;</TD>
  </TR>\n");
    } else {
      echo ("<TD bgcolor=".$coul." align=\"center\">&nbsp;<font color=\"red\">".trad("XTDUMP_NON")."</font>&nbsp;</TD>
  </TR>\n");
    }

    // Type de sauvegarde
    $coul=$bgColor[++$iColor%2];
    echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_TYPE_SAVE")."&nbsp;</A></TD>
    <TD bgcolor=".$coul." align=\"center\">&nbsp;".trad("XTDUMP_TYPE_".strtoupper($XT_FORMAT_SAV))."&nbsp;</TD>
  </TR>\n");

    // Mode de sauvegarde
    $coul=$bgColor[++$iColor%2];
    echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_MODE_SAVE")."&nbsp;</A></TD>
    <TD bgcolor=".$coul." align=\"center\">&nbsp;".trad("XTDUMP_MODE_SAVE_".$XT_TYPE_SAV)."&nbsp;</TD>
  </TR>\n");

    // Suppression des tables
    $coul=$bgColor[++$iColor%2];
    echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_DROP_TABLE")."&nbsp;</A></TD>
    <TD bgcolor=".$coul." align=\"center\">&nbsp;");
    if ($XT_DROP_TABLE == 1){
      echo ("<font color=\"green\">".trad("XTDUMP_OUI")."</font>&nbsp;</TD>
  </TR>\n");
    } else {
      echo ("<font color=\"red\">".trad("XTDUMP_NON")."</font>&nbsp;</TD>
  </TR>\n");
    }

    // Un fichier par table
    $coul=$bgColor[++$iColor%2];
    echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_FICH_SAVE")."&nbsp;</A></TD>
    <TD bgcolor=".$coul." align=\"center\">&nbsp;");
    if ($XT_FIC_PAR_TABLE=="1") {
      echo ("<font color=\"green\">".trad("XTDUMP_OUI")."</font>&nbsp;</TD>
  </TR>\n");
    } else {
      echo ("<font color=\"red\">".trad("XTDUMP_NON")."</font>&nbsp;</TD>
  </TR>\n");
    }

    // Ecraser les sauvegardes existantes
    $coul=$bgColor[++$iColor%2];
    echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_ECR_FICH_SAVE")."&nbsp;</A></TD>
    <TD bgcolor=".$coul." align=\"center\">&nbsp;");
    if ($XT_ECRASE=="1") {
      echo ("<font color=\"green\">".trad("XTDUMP_OUI")."</font>&nbsp;</TD>
  </TR>\n");
    } else {
      echo ("<font color=\"red\">".trad("XTDUMP_NON")."</font>&nbsp;</TD>
  </TR>\n");
    }

    // Scinder les fichiers
    $coul=$bgColor[++$iColor%2];
    echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_SCI_FICH_SAVE")."&nbsp;</A></TD>
    <TD bgcolor=".$coul." align=\"center\">&nbsp;");
    if ($XT_SCINDER_FIC == 1) {
      echo ("<font color=\"green\">".trad("XTDUMP_OUI")."</font>&nbsp;</TD>
  </TR>\n");
      $coul=$bgColor[++$iColor%2];
      echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_TAIL_FICH_SAVE")."&nbsp;</A></TD>
    <TD bgcolor=".$coul." align=\"center\">&nbsp;".$XT_TAILLE_FIC."&nbsp;</TD>
  </TR>\n");
    } else {
      echo ("<font color=\"red\">".trad("XTDUMP_NON")."</font>&nbsp;</TD>
  </TR>\n");
    }

    // Compression GZip
    $coul=$bgColor[++$iColor%2];
    echo ("  <TR>
    <TD bgcolor=".$coul.">&nbsp;".trad("XTDUMP_GZIP_SAVE")."&nbsp;</A></TD>
    <TD bgcolor=".$coul." align=\"center\">&nbsp;");
    if ($XT_COMPRESS_GZIP == "1") {
      echo ("<font color=\"green\">".trad("XTDUMP_OUI")."</font>&nbsp;</TD>
  </TR>\n");
    } else {
      echo ("<font color=\"red\">".trad("XTDUMP_NON")."</font>&nbsp;</TD>
  </TR>\n");
    }

    echo "  </TABLE><BR>";
    echo $footer;
  }


// ----------------------------------------------------------------------------
// CHOIX DES PARAMETRES DE LA SAUVEGARDE
// ----------------------------------------------------------------------------
  else {
    $DB_CX->DbQuery("SELECT param, valeur FROM ${PREFIX_TABLE}configuration WHERE groupe=1");
    if ($DB_CX->DbNumRows()) {
      while ($enr = $DB_CX->DbNextRow()) {
        ${$enr['param']} = $enr['valeur'];
      }
      $tbl = explode(",",$XT_TABLE_SAV);
      if(($XT_TAILLE_FIC+0)<200000)
        $XT_TAILLE_FIC = "200000";
    } else {
      $tbl = array();
      $XT_TAILLE_FIC = "200000";
      $XT_DROP_TABLE = "1";
      $XT_COMPRESS_GZIP = "1";
      $XT_SCINDER_FIC = "1";
    }

    // Liste des tables a sauvegarder
    $tables = $DB_CX->DbListTable($cfgBase);
    $nb_tbl = 0;
    $lst_tbl = "";
    while (list($tb_nom) = $DB_CX->DbNextRow()) {
      // On ne traite que les tables "Phenix"
      if (ereg("^${PREFIX_TABLE}",$tb_nom)) {
        $coul = $bgColor[$nb_tbl % 2];
        $ckc = (in_array($tb_nom,$tbl)) ? " checked" : "";

        $lst_tbl .= ("    <TR>
      <TD bgcolor=\"".$coul."\"><INPUT type=\"checkbox\" name=\"tbls[".$nb_tbl."]\" value=\"".$tb_nom."\" ".$ckc."></TD>
      <TD bgcolor=\"".$coul."\">&nbsp;".$tb_nom."</TD>
    </TR>\n");
        $nb_tbl++;
      }
    }

    echo ($header."
  <SCRIPT language=\"javascript\">
  <!--
  function checkall() {
    var i = 0;
    while (i < $nb_tbl) {
      a = 'tbls[' + i + ']';
      document.frmAdmBackup.elements[a].checked = true;
      i = i+1;
    }
  }

  function decheckall() {
    var i = 0;
    while (i < $nb_tbl) {
      a = 'tbls[' + i + ']';
      document.frmAdmBackup.elements[a].checked = false;
      i = i+1;
    }
  }
  //-->
  </SCRIPT>
  <CENTER>
  <FORM action=\"${NOM_PAGE}\" method=\"post\" name=\"frmAdmBackup\" id=\"frmAdmBackup\">
    <INPUT type=\"hidden\" name=\"backup\" value=\"2\">
    <TABLE border=\"0\" width=\"550\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" style=\"border-collapse:separate;\" bgcolor=\"$AgendaBordureTableau\">
    <COL width=30 align=\"center\" valign=\"middle\">
    <COL width=520>
    <TR height=\"20\">
      <TD class=\"sousMenu\"><INPUT type=\"checkbox\" name=\"selc\" title=\"".trad("XTDUMP_SELECT_ALL")."\" onclick=\"javascript: if (document.frmAdmBackup.selc.checked==true){checkall();}else{decheckall();}\"></TD>
      <TD class=\"sousMenu\" align=\"center\">".trad("XTDUMP_NOM_TBL")."</TD>
    </TR>\n");
    echo $lst_tbl;

    if ($XT_FORMAT_SAV == "csv") {
      $ck_csv = " checked";
      $ck_sql = "";
    }  else {
      $ck_csv = "";
      $ck_sql = " checked";
    }

    if ($XT_TYPE_SAV == "3") { $ck_opt3 = " checked"; }
    elseif ($XT_TYPE_SAV == "2") { $ck_opt2 = " checked"; }
    else { $ck_opt1 = " checked"; }

    if ($XT_DROP_TABLE == "1") { $ck_drp_tbl = " checked"; }
    if ($XT_ECRASE == "1") { $ck_ecraz = " checked"; }
    if ($XT_FIC_PAR_TABLE == "1") { $ck_ftbl = " checked"; }
    if ($XT_SCINDER_FIC == "1") { $ck_fcut = " checked"; }
    if ($XT_COMPRESS_GZIP == "1") { $ck_file_type = " checked"; }
    if ($XT_ENVOI_MAIL == "1") { $ck_rp_mail = " checked"; }
    if ($XT_PERIODICITE == '3') { $ck_typ_sav_XT3 = " checked"; }
    elseif ($XT_PERIODICITE == '2') { $ck_typ_sav_XT2 = " checked"; }
    elseif ($XT_PERIODICITE == '1') { $ck_typ_sav_XT1 = " checked"; }
    else { $ck_typ_sav_XT0 = " checked"; }

    echo ("    </TABLE>
    <BR>
    <TABLE border=\"0\" width=\"550\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" style=\"border-collapse:separate;\" bgcolor=\"$AgendaBordureTableau\">
    <TR height=\"20\" valign=\"middle\">
      <TD class=\"sousMenu\" align=\"center\">".trad("XTDUMP_CONFIG")."</TD>
    </TR>
    <TR bgcolor=\"".$bgColor[0]."\">
      <TD><TABLE border=\"0\" width=\"550\" cellpadding=\"0\" cellspacing=\"0\">
        <COL width=300 align=\"left\" valign=\"top\">
        <COL width=30>
        <COL width=220 align=\"left\" valign=\"top\">
        <TR>
          <TD>
            <INPUT type=\"radio\" name=\"XT_FORMAT_SAV\" value=\"csv\" ".$ck_csv."> ".trad("XTDUMP_SAUV_CVS")."<BR>
            <INPUT type=\"radio\" name=\"XT_FORMAT_SAV\" value=\"sql\" ".$ck_sql."> ".trad("XTDUMP_SAUV_SQL")."
          </TD>
          <TD>&nbsp;</TD>
          <TD>
            <INPUT type=\"radio\" name=\"XT_TYPE_SAV\" value=\"1\" ".$ck_opt1.">".trad("XTDUMP_STRUCTURE")."<BR>
            <INPUT type=\"radio\" name=\"XT_TYPE_SAV\" value=\"2\" ".$ck_opt2.">".trad("XTDUMP_STRUCTURE1")."<BR>
            <INPUT type=\"radio\" name=\"XT_TYPE_SAV\" value=\"3\" ".$ck_opt3.">".trad("XTDUMP_STRUCTURE2")."
          </TD>
        </TR>
      </TABLE></TD>
    </TR>
    <TR bgcolor=\"".$bgColor[1]."\">
      <TD><TABLE border=\"0\" width=\"550\" cellpadding=\"0\" cellspacing=\"0\">
        <COL width=300 align=\"left\" valign=\"top\">
        <COL width=30>
        <COL width=220 align=\"left\" valign=\"top\">
        <TR>
          <TD>
            <INPUT type=\"checkbox\" name=\"XT_FIC_PAR_TABLE\" value=\"1\" ".$ck_ftbl."> ".trad("XTDUMP_FICH_TBL")."<BR>
            <INPUT type=\"checkbox\" name=\"XT_DROP_TABLE\" value=\"1\" ".$ck_drp_tbl."> ".trad("XTDUMP_AJOUT")."
          </TD>
          <TD>&nbsp;</TD>
          <TD>
            <INPUT type=\"checkbox\" name=\"XT_ECRASE\" value=\"1\" ".$ck_ecraz."> ".trad("XTDUMP_ECRASE")."<BR>
            <INPUT type=\"checkbox\" name=\"XT_COMPRESS_GZIP\" value=\"1\" ".$ck_file_type."> ".trad("XTDUMP_GZIP")."
          </TD>
        </TR>
        <TR>
          <TD height=\"20\" colspan=\"3\">
            <INPUT type=\"checkbox\" name=\"XT_SCINDER_FIC\" value=\"1\"".$ck_fcut." onclick=\"javascript:onOff(this,document.frmAdmBackup.XT_TAILLE_FIC);\"> ".trad("XTDUMP_TAILLE_MAX")." <INPUT type=\"text\" class=\"Texte\" name=\"XT_TAILLE_FIC\" value=\"".$XT_TAILLE_FIC."\" > ".trad("XTDUMP_OCTET")."
          </TD>
        </TR>
      </TABLE></TD>
    </TR>
    </TABLE>
    <BR>
    <TABLE border=\"0\" width=\"550\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" style=\"border-collapse:separate;\" bgcolor=\"$AgendaBordureTableau\">
    <TR height=\"20\" valign=\"middle\">
      <TD class=\"sousMenu\" align=\"center\">".trad("XTDUMP_PARAM")."</TD>
    </TR>
    <TR bgcolor=\"".$bgColor[0]."\">
      <TD><TABLE border=\"0\" width=\"550\" cellpadding=\"0\" cellspacing=\"0\">
        <COL width=300 align=\"left\" valign=\"middle\">
        <COL width=30>
        <COL width=220 align=\"left\" valign=\"middle\">
        <TR>
          <TD>
            <INPUT type=\"radio\" name=\"XT_PERIODICITE\" value=\"0\" ".$ck_typ_sav_XT0."> ".trad("XTDUMP_TYPE_SV1")."<BR>
            <INPUT type=\"radio\" name=\"XT_PERIODICITE\" value=\"1\" ".$ck_typ_sav_XT1."> ".trad("XTDUMP_TYPE_SV2")."
          </TD>
          <TD>&nbsp;</TD>
          <TD>
            <INPUT type=\"radio\" name=\"XT_PERIODICITE\" value=\"2\" ".$ck_typ_sav_XT2."> ".trad("XTDUMP_TYPE_SV3")."<BR>
            <INPUT type=\"radio\" name=\"XT_PERIODICITE\" value=\"3\" ".$ck_typ_sav_XT3."> ".trad("XTDUMP_TYPE_SV4")."
          </TD>
        </TR>
      </TABLE></TD>
    </TR>
    <TR bgcolor=\"".$bgColor[1]."\" height=\"20\">
      <TD>
        <INPUT type=\"checkbox\" name=\"XT_ENVOI_MAIL\" value=\"1\" ".$ck_rp_mail." onclick=\"javascript:onOff(this,document.frmAdmBackup.XT_MAIL);\"> ".trad("XTDUMP_RP_MAIL")." <INPUT type=\"text\" class=\"Texte\" size=\"50\" name=\"XT_MAIL\" value=\"".$XT_MAIL."\">
      </TD>
    </TR>
    </TABLE>
    <SCRIPT language=\"JavaScript\" type=\"text/javascript\">
    <!--
      onOff(document.frmAdmBackup.XT_SCINDER_FIC,document.frmAdmBackup.XT_TAILLE_FIC);
      onOff(document.frmAdmBackup.XT_ENVOI_MAIL,document.frmAdmBackup.XT_MAIL);
      function onOff(_ck,_obj) {
        if (_ck.checked) {
          _obj.disabled=false;
          _obj.style.backgroundColor='$FormulaireFondInput';
        } else {
          _obj.disabled=true;
          _obj.style.backgroundColor='#EEEEEE';
        }
      }
    //-->
    </SCRIPT>
    <BR>
    <INPUT type=\"submit\" class=\"bouton\" value=\"".trad("XTDUMP_EXECUTE")."\">
    &nbsp;&nbsp;&nbsp;<INPUT type=\"button\" class=\"bouton\" value=\"".trad("XTDUMP_SAV_CONFIG")."\" onclick=\"javascript: enregParam(document.frmAdmBackup);\">
    <BR>
  </FORM>
  </CENTER><BR>".$footer);
  }
}
?>
