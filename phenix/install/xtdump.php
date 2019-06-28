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
  $path = "../";
  include($path."inc/xtdump.inc.php");

  /* Header */
  $header = "<CENTER><BR>
<TABLE width=620 cellpadding=0 cellspacing=0 align=\"center\">
<COL width=1 style=\"background-color:#2D7DA7\">
<COL width=600>
<COL width=1 style=\"background-color:#2D7DA7\">
  <TR>
    <TD></TD>
    <TD bgcolor=\"#2D7DA7\" align=\"center\" style=\"font: bold 14px; font-family: verdana;\">..::: DreaXTeam ::: XT-Dump v0.7 :::..</TD>
    <TD></TD>
  </TR>
  <TR>
    <TD></TD>
    <TD bgcolor=\"#ABD5D5\" align=\"left\" class=\"texte\"><BR>";

  /* Footer */
  $footer = "
      <BR><CENTER><A href=\"http://dreaxteam.net\" class=\"link\" target=\"_blank\">Copyrights &copy; 2001-2003 DreaXTeaM</A><BR></CENTER>
      <BR>
    </TD>
    <TD></TD>
  </TR>
  <TR>
    <TD height=1 colspan=3></TD>
  </TR>
</TABLE>
<BR>
</CENTER>";

  /* Mode Sauvegarde de la Base - Data Save Mode */
  if ($action == 'save') {
    if (!is_array($tbls)) {
      echo $header."<CENTER><font color=\"red\"><B>".trad("XTDUMP_NO_TABLE")."</B></font></CENTER><BR>\n".$footer."<CENTER><A href=\"${NOM_PAGE}?inst_lang=".$inst_lang."&backup=1\"><B>".trad("XTDUMP_RETOUR")."</B></A></CENTER><BR></TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>";
      exit;
    }

    if($f_cut == 1) {
      if (!is_numeric($fz_max)) {
        echo $header."<CENTER><font color=\"red\"><B>".trad("XTDUMP_TAILLE_FICH")."</B></font></CENTER><BR>\n".$footer."<CENTER><A href=\"${NOM_PAGE}?inst_lang=".$inst_lang."&backup=1\"><B>".trad("XTDUMP_RETOUR")."</B></A></CENTER><BR></TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>";
        exit;
      }
      if ($fz_max < 200000) {
        echo $header."<CENTER><font color=\"red\"><B>".trad("XTDUMP_TAILLE_FICH2")."</B></font></CENTER><BR>\n".$footer."<CENTER><A href=\"${NOM_PAGE}?inst_lang=".$inst_lang."&backup=1\"><B>".trad("XTDUMP_RETOUR")."</B></A></CENTER><BR></TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>";
        exit;
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
    if ($opt == 1) {
      $sv_s = true;
      $sv_d = true;
    } else if ($opt == 2) {
      $sv_s = true;
      $sv_d = false;
      $fc   = "_struct";
    } else if ($opt == 3) {
      $sv_s = false;
      $sv_d = true;
      $fc   = "_data";
    } else {
      exit;
    }

    $fext = "." . $savmode;
    $fich = $nomdb . $fc . $fext;

    /* Ecraser ou non le fichier */
    $dte = "";
    if ($ecraz != 1) {
      $dte = date("dMy_Hi")."_";
    }

    $gz = "";
    if ($file_type == '1') {
      $gz .= ".gz";
    }

    $fcut = false;
    $ftbl = false;
    $f_nm = array();
    if($f_cut == 1) {
      $fcut = true;
      $fz_max = $fz_max;
      $nbf = 1;
      $f_size = 170;
    }
    if ($f_tbl == 1) {
      $ftbl = true;
    } else {
      if (!$fcut) {
        open_file($path."backup/dump_".$dte.$nomdb.$fc.$fext.$gz,$file_type,$nomdb);
      } else {
        open_file($path."backup/dump_".$dte.$nomdb.$fc."_1".$fext.$gz,$file_type,$nomdb);
      }
    }
    $nbf = 1;
    ($db = @mysql_connect($serveur, $utilisateur, $motdepasse)) or die($header."<CENTER><IMG border=0 src=\"actionko.gif\"><font color=\"#ff0000\">".trad("XTDUMP_IMP_CONNECT_SRV")."</font></CENTER><BR>\n".$footer."<CENTER><A href=\"${NOM_PAGE}?inst_lang=".$inst_lang."&backup=1\"><B>".trad("XTDUMP_RETOUR")."</B></A></CENTER><BR></TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");
    @mysql_select_db($nomdb,$db) or die($header."<CENTER><IMG border=0 src=\"actionko.gif\"><font color=\"#ff0000\">".trad("XTDUMP_IMP_CONNECT_BASE")."</font></CENTER><BR>\n".$footer."<CENTER><A href=\"${NOM_PAGE}?inst_lang=".$inst_lang."&backup=1\"><B>".trad("XTDUMP_RETOUR")."</B></A></CENTER><BR></TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");

    $tblsv = do_backup($prefixe, $drp_tbl, $file_type, $nomdb, $fz_max);

    @mysql_close();
    if (!$ftbl) {
      close_file($file_type);
    }
    echo $header."
  <CENTER>".sprintf(trad("XTDUMP_FICH_SAUV"), substr($tblsv,0,strlen($tblsv)-2))."<BR><BR></CENTER>
  <TABLE border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <COL width=1 style=\"background-color:#2D7DA7\">
  <COL valign=\"middle\">
  <COL width=1 style=\"background-color:#2D7DA7\">
  <COL valign=\"middle\" align=\"right\">
  <COL width=1 style=\"background-color:#2D7DA7\">
  <TR>
    <TD bgcolor=\"#2D7DA7\" colspan=5></TD>
  </TR>
  <TR>
    <TD></TD>
    <TD bgcolor=\"#338CBD\" align=\"center\" class=\"texte\"><font size=1><B>".trad("XTDUMP_TITRE_NOM")."</B></font></TD>
    <TD></TD>
    <TD bgcolor=\"#338CBD\" align=\"center\" class=\"texte\"><font size=1><B>".trad("XTDUMP_TITRE_TAILLE")."</B></font></TD>
    <TD></TD>
  </TR>
  <TR>
    <TD bgcolor=\"#2D7DA7\" colspan=5></TD>
  </TR>";
    reset($f_nm);
    while (list($i,$val) = each($f_nm)) {
      $coul = '#99CCCC';
      if ($i % 2) {
        $coul = '#CFE3E3';
      }
      echo "<TR>
    <TD></TD>
    <TD bgcolor=".$coul." class=\"texte\">&nbsp;<A href=\"".$val."\" class=\"link\" target=\"_blank\">".$val."&nbsp;</A></TD>
    <TD></TD>";
      $fz_tmp = filesize($val);
      if ($fcut && ($fz_tmp > $fz_max)) {
        echo "<TD bgcolor=".$coul." class=\"texte\">&nbsp;<font size=1 color=\"red\">".sprintf(trad("XTDUMP_IMP_OCTET"), $fz_tmp)."</font>&nbsp;</TD><TD></TD></TR>";
      } else {
        echo "<TD bgcolor=".$coul." class=\"texte\">&nbsp;<font size=1>".sprintf(trad("XTDUMP_IMP_OCTET"), $fz_tmp)."</font>&nbsp;</TD><TD></TD></TR>";
      }
      echo "<TR><TD bgcolor=\"#2D7DA7\" colspan=5></TD></TR>";
    }
    echo "</TABLE><BR>";
    echo $footer;
  }

  elseif ($action == 'connect') {
    /* Verification des parametres de connexion */
    /* Check connection parameters */
    ($db = @mysql_connect($serveur, $utilisateur, $motdepasse)) or die($header."<CENTER><IMG border=0 src=\"actionko.gif\"><font color=\"#ff0000\"><B>".trad("XTDUMP_IMP_CONNECT_SRV")."</font></CENTER><BR>\n".$footer."<CENTER><A href=\"${NOM_PAGE}?inst_lang=".$inst_lang."&backup=1\"><B>".trad("XTDUMP_RETOUR")."</B></A></CENTER><BR></TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");
    @mysql_select_db($nomdb,$db) or die($header."<CENTER><IMG border=0 src=\"actionko.gif\"><font color=\"#ff0000\"><B>".trad("XTDUMP_IMP_CONNECT_BASE")."</font></CENTER><BR>\n".$footer."<CENTER><A href=\"${NOM_PAGE}?inst_lang=".$inst_lang."&backup=1\"><B>".trad("XTDUMP_RETOUR")."</B></A></CENTER><BR></TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");

    // Liste des tables a sauvegarder
    $tables = mysql_list_tables($nomdb);
    $nb_tbl = 0;
    $lst_tbl = "";
    while (list($tb_nom) = mysql_fetch_array($tables)) {
      // On ne traite que les tables "Phenix"
      if (ereg("^${prefixe}",$tb_nom)) {
        $coul = ($nb_tbl % 2) ? '#CFE3E3' : '#99CCCC';
        $lst_tbl .= ("    <TR>
      <TD></TD>
      <TD bgcolor=\"".$coul."\"><INPUT type=\"checkbox\" name=\"tbls[".$nb_tbl."]\" value=\"".$tb_nom."\"></TD>
      <TD></TD>
      <TD bgcolor=\"".$coul."\">&nbsp;&nbsp;&nbsp;".$tb_nom."</TD>
      <TD></TD>
    </TR>
    <TR>
      <TD bgcolor=\"#2D7DA7\" colspan=5></TD>
    </TR>\n");
        $nb_tbl++;
      }
    }

    echo $header."
  <SCRIPT language=\"javascript\">
  <!--
  function checkall() {
    var i = 0;
    while (i < $nb_tbl) {
      a = 'tbls[' + i + ']';
      document.frmBackup.elements[a].checked = true;
      i = i+1;
    }
  }

  function decheckall() {
    var i = 0;
    while (i < $nb_tbl) {
      a = 'tbls[' + i + ']';
      document.frmBackup.elements[a].checked = false;
      i = i+1;
    }
  }
  //-->
  </SCRIPT>
  <CENTER>
  <FORM action=\"${NOM_PAGE}?inst_lang=".$inst_lang."\" method=\"post\" name=\"frmBackup\" id=\"frmBackup\">
    <INPUT type=\"hidden\" name=\"action\" value=\"save\">
    <INPUT type=\"hidden\" name=\"backup\" value=\"3\">
    <INPUT type=\"hidden\" name=\"serveur\" value=\"$serveur\">
    <INPUT type=\"hidden\" name=\"nomdb\" value=\"$nomdb\">
    <INPUT type=\"hidden\" name=\"utilisateur\" value=\"$utilisateur\">
    <INPUT type=\"hidden\" name=\"motdepasse\" value=\"$motdepasse\">
    <TABLE border=\"0\" width=\"400\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"texte\">
    <COL width=1 style=\"background-color:#2D7DA7\">
    <COL width=30 align=\"center\" valign=\"middle\">
    <COL width=1 style=\"background-color:#2D7DA7\">
    <COL width=350>
    <COL width=1 style=\"background-color:#2D7DA7\">
    <TR>
      <TD bgcolor=\"#2D7DA7\" colspan=5></TD>
    </TR>
    <TR>
      <TD></TD>
      <TD bgcolor=\"#336699\"><INPUT type=\"checkbox\" name=\"selc\" title=\"".trad("XTDUMP_SELECT_ALL")."\" onclick=\"javascript: if (document.frmBackup.selc.checked==true){checkall();}else{decheckall();}\"></TD>
      <TD></TD>
      <TD bgcolor=\"#338CBD\" align=\"center\">".trad("XTDUMP_NOM_TBL")."</TD>
      <TD></TD>
    </TR>
    <TR>
      <TD bgcolor=\"#2D7DA7\" colspan=5></TD>
    </TR>\n";
    echo $lst_tbl;

    mysql_close();

    echo ("    </TABLE>
    <BR><BR>
    <TABLE align=\"center\" border=0>
    <TR>
      <TD align=\"left\" class=\"texte\">
      <HR>
        <INPUT type=\"radio\" name=\"savmode\" value=\"csv\"> ".trad("XTDUMP_SAUV_CVS")."<BR>
        <INPUT type=\"radio\" name=\"savmode\" value=\"sql\" checked> ".trad("XTDUMP_SAUV_SQL")."<BR>
      <HR>
        <INPUT type=\"radio\" name=\"opt\" value=\"1\" checked> ".trad("XTDUMP_STRUCTURE")."<BR>
        <INPUT type=\"radio\" name=\"opt\" value=\"2\"> ".trad("XTDUMP_STRUCTURE1")."<BR>
        <INPUT type=\"radio\" name=\"opt\" value=\"3\"> ".trad("XTDUMP_STRUCTURE2")."<BR>
      <HR>
        <INPUT type=\"checkbox\" name=\"drp_tbl\" value=\"1\" checked> ".trad("XTDUMP_AJOUT")."<BR>
        <INPUT type=\"checkbox\" name=\"ecraz\" value=\"1\" checked> ".trad("XTDUMP_ECRASE")."<BR>
        <INPUT type=\"checkbox\" name=\"f_tbl\" value=\"1\"> ".trad("XTDUMP_FICH_TBL")."<BR>
        <INPUT type=\"checkbox\" name=\"f_cut\" value=\"1\"> ".trad("XTDUMP_TAILLE_MAX")." <INPUT type=\"text\" name=\"fz_max\" value=\"200000\" class=\"form\"> ".trad("XTDUMP_OCTET")."<BR>
        <INPUT type=\"checkbox\" name=\"file_type\" value=\"1\"> ".trad("XTDUMP_GZIP")."<BR>
      </TD>
    </TR>
    </TABLE>
    <BR><BR>
    <INPUT type=\"submit\" value=\" ".trad("XTDUMP_SAUVER")." \" class=\"form\">
  </FORM>
  </CENTER>".$footer);
  }

  else {
    /* Page Par Defaut - Default Page */
    echo $header . "
  <FORM action=\"${NOM_PAGE}\" method=\"post\">
    <INPUT type=\"hidden\" name=\"action\" value=\"connect\">
    <INPUT type=\"hidden\" name=\"backup\" value=\"2\">
    <INPUT type=\"hidden\" name=\"inst_lang\" value=\"$inst_lang\">
    <TABLE border=0 align=\"center\">
    <COL>
    <COL align=\"left\">
    <TR>
      <TD class=\"texte\">".trad("XTDUMP_SERVEUR")."</TD>
      <TD><INPUT type=\"text\" name=\"serveur\" size=\"30\" value=\"$cfgHote\" class=\"form\"></TD>
    </TR>
    <TR>
      <TD class=\"texte\">".trad("XTDUMP_BASE")."</TD>
      <TD><INPUT type=\"text\" name=\"nomdb\" size=\"30\" value=\"$cfgBase\" class=\"form\"></TD>
    </TR>
    <TR>
      <TD class=\"texte\">".trad("XTDUMP_USER")."</TD>
      <TD><INPUT type=\"text\" name=\"utilisateur\" size=\"30\" value=\"$cfgUser\" class=\"form\"></TD>
    </TR>
    <TR>
      <TD class=\"texte\">".trad("XTDUMP_MDP")."</TD>
      <TD><INPUT type=\"Password\" name=\"motdepasse\" size=\"30\" value=\"$cfgPass\" class=\"form\"></TD>
    </TR>
    <TR>
      <TD class=\"texte\">".trad("INSTALL_MAJCFG_BDDPFX")."</TD>
      <TD><INPUT type=\"text\" name=\"prefixe\" size=\"30\" value=\"$PREFIX_TABLE\" class=\"form\"></TD>
    </TR>
    </TABLE>
    <BR><BR>
    <CENTER><INPUT type=\"submit\" value=\" ".trad("XTDUMP_CONNECT")." \" class=\"form\"></CENTER>
  </FORM>
  <BR><CENTER><A href=\"http://dreaxteam.net\" class=\"link\" target=\"_blank\">Copyrights &copy; 2001-2003 DreaXTeaM</A><BR></CENTER>
    <BR>
    </TD>
    <TD></TD>
  </TR>
  <TR>
    <TD height=1 colspan=3></TD>
  </TR>
  </TABLE>
  <BR>
  </CENTER>";
  }
?>
