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
?>
<?php if ($config==1) { ?>
  <SCRIPT language="JavaScript" type="text/javascript">
  <!--
    function autoriseFCKE(theForm,_val,_all) {
      var _statut = (_val=="NON");
      if (!_all) {
        theForm.autorise_fcke.disabled=_statut;
        if (_val=="NON")
          autoriseFCKE(theForm,"NON",true);
        else
          autoriseFCKE(theForm,theForm.autorise_fcke.value,true);
      } else {
        theForm.fcke_toolbar.disabled=_statut;
        theForm.fcke_base.disabled=_statut;
        theForm.fcke_browse.disabled=_statut;
        theForm.fcke_upload.disabled=_statut;
      }
    }
  //-->
  </SCRIPT>
<?php } ?>

<?php
//config 1
//Choix des parametres de configuration
if ($config==1) {

  function listeLangue($selectLangue) {
    // Recuperation des noms de langue directement dans les fichiers du repertoire "lang"
    $rep = opendir("./lang");
    while ($file = readdir($rep)) {
      if ($file!=".." && $file!="." && $file!="" && $file!="index.htm") {
        if (!is_dir("lang/".$file) && $fd = @fopen("lang/".$file, "r")) {
          while (!@feof($fd)) {
            $ligne = @fgets($fd);
            if (@strpos($ligne,"['COMMUN_NOM_LANGUE']")!==false) {
              $pos1 = @strpos($ligne,"\"");
              $pos2 = @strpos(substr($ligne,$pos1+1),"\"");
              break;
            }
          }
          $tabLangue[substr($file,0,@strpos($file,"."))] = @substr($ligne,$pos1+1,$pos2);
          fclose($fd);
        }
      }
    }
    closedir($rep);
    clearstatcache();
    $str = "";
    foreach ($tabLangue as $key=>$val) {
      $selected = ($selectLangue == $key) ? " selected" : "";
      $str .= "<OPTION value=\"".$key."\"".$selected.">".$val."</OPTION>";
    }
    return $str;
  }

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/outils.png\">".trad("ADMIN_MAJ_CFG"),"<B>".sprintf(trad("ADMIN_ETAPE"), 1)."</B> - ".trad("ADMIN_TITRE_MAJ_CFG"));

  $iColor=1;

  echo ("  <FORM method=\"post\" action=\"${NOM_PAGE}&config=2\" name=\"frmAdmConfig\" id=\"frmAdmConfig\">
      <TABLE align=\"center\" border=\"0\" style=\"text-align:left;\">
      <TR bgcolor=\"".$bgColor[$iColor%2]."\"><TD>".trad("ADMIN_CONNECT")."</TD><TD><SELECT name=\"cheminabsolu\"><OPTION value=\"true\"".(($CHEMIN_ABSOLU) ? " selected" : "").">".trad("ADMIN_CONNECT_A")."</OPTION><OPTION value=\"false\"".((!$CHEMIN_ABSOLU) ? " selected" : "").">".trad("ADMIN_CONNECT_R")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_CONNECT_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_LANG")."</TD><TD><SELECT name=\"langue\">".listeLangue($LANGUE_CFG)."</SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_LANG_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_SUPNOTEAFF")."</TD><TD><SELECT name=\"suppr\"><OPTION value=\"OUI\"".(($AUTORISE_SUPPR) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$AUTORISE_SUPPR) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_SUPNOTEAFF_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_SESSION")."</TD><TD><INPUT type=\"text\" class=\"Texte\" name=\"session\" size=\"3\" value=\"$DUREE_SESSION\"></TD><TD><I>".trad("ADMIN_MAJCFG_SESSION_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_IDCOOKIE")."</TD><TD><SELECT name=\"cookauth\"><OPTION value=\"OUI\"".(($COOKIE_AUTH) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$COOKIE_AUTH) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_IDCOOKIE_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_NAMECOOKIE")."</TD><TD><INPUT type=\"text\" class=\"Texte\" name=\"cooknom\" size=\"10\" value=\"$COOKIE_NOM\"></TD><TD><I>".trad("ADMIN_MAJCFG_NAMECOOKIE_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_DURCOOKIE")."</TD><TD><INPUT type=\"text\" class=\"Texte\" name=\"cookduree\" size=\"3\" value=\"$COOKIE_DUREE\"></TD><TD><I>".trad("ADMIN_MAJCFG_DURCOOKIE_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_CREATIONCOMPTES")."</TD><TD><SELECT name=\"public\"><OPTION value=\"OUI\"".(($PUBLIC) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$PUBLIC) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_CREATIONCOMPTES_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_RECHARGEP")."</TD><TD><INPUT type=\"text\" class=\"Texte\" name=\"reload\" size=\"3\" value=\"$RELOAD_PLANNING\"></TD><TD><I>".trad("ADMIN_MAJCFG_RECHARGEP_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_TRANSMAJ")."</TD><TD><SELECT name=\"majuscule\"><OPTION value=\"OUI\"".(($AUTO_UPPERCASE) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$AUTO_UPPERCASE) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_TRANSMAJ_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_MODIFPART")."</TD><TD><SELECT name=\"modif_partage\"><OPTION value=\"OUI\"".(($MODIF_PARTAGE) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$MODIF_PARTAGE) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_MODIFPART_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_RECHMAJ")."</TD><TD><SELECT name=\"check_version\"><OPTION value=\"OUI\"".(($CHECK_VERSION) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$CHECK_VERSION) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_RECHMAJ_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_RECHARGECAL")."</TD><TD><SELECT name=\"reload_calendar\"><OPTION value=\"OUI\"".(($RELOAD_CALENDAR) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$RELOAD_CALENDAR) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_RECHARGECAL_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_SKINACCUEIL")."</TD><TD><SELECT name=\"index_style\" size=\"1\">
");
  // Recuperation des noms d'interface directement dans les fichiers du repertoire "skins"
  $rep = opendir("./skins");
  while ($file = readdir($rep)) {
    if ($file!=".." && $file!="." && $file!="" && $file!="index.htm") {
      if (!is_dir("skins/".$file) && $fd = @fopen("skins/".$file, "r")) {
        $ligne = fread($fd, 200);
        $pos1 = @strpos($ligne,"\"");
        $pos2 = @strpos(substr($ligne,$pos1+1),"\"");
        $typeSkin = substr(stristr($ligne,"SkinAccueil="),12,1);
        if ($typeSkin!=2)
          $tabInterface[substr($file,0,@strpos($file,"."))] = trim(@substr($ligne,$pos1+1,$pos2));
        fclose($fd);
      }
    }
  }
  closedir($rep);
  clearstatcache();
  ksort($tabInterface);
  if (!file_exists("skins/".$INDEX_STYLE.".php")) {
    $INDEX_STYLE = $APPLI_STYLE;
  }
  foreach ($tabInterface as $nomFic=>$nomSkin) {
    if (!empty($nomSkin)) {
      $selected = (strcasecmp($INDEX_STYLE, $nomFic)==0) ? " selected" : "";
      echo "        <OPTION value=\"".$nomFic."\"".$selected.">".$nomSkin."</OPTION>\n";
    }
  }
  echo ("      </SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_SKINACCUEIL_DEF")."</I></TD></TR>
      <TR bgcolor=\"#999999\"><TD>".trad("ADMIN_MAJCFG_AUTHTML")."</TD><TD><SELECT name=\"autorise_html\" onchange=\"javascript: autoriseFCKE(document.frmAdmConfig,this.value,false);\"><OPTION value=\"OUI\"".(($AUTORISE_HTML) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$AUTORISE_HTML) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_AUTHTML_DEF")."</I></TD></TR>
      <TR bgcolor=\"#BBBBBB\"><TD style=\"padding-left:7px;\">".trad("ADMIN_MAJCFG_AUTEDITHTML")."</TD><TD><SELECT name=\"autorise_fcke\" onchange=\"javascript: autoriseFCKE(document.frmAdmConfig,this.value,true);\"".((!$AUTORISE_HTML) ? " disabled" : "")."><OPTION value=\"OUI\"".(($AUTORISE_FCKE_CFG) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$AUTORISE_FCKE_CFG) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_AUTEDITHTML_DEF")."</I></TD></TR>
      <TR bgcolor=\"#DDDDDD\"><TD style=\"padding-left:14px;\">".trad("ADMIN_MAJCFG_OUTILHTML")."</TD><TD><SELECT name=\"fcke_toolbar\"".((!$AUTORISE_FCKE_CFG) ? " disabled" : "")."><OPTION value=\"User\"".((($FCKE_TOOLBAR_CFG == "User")) ? " selected" : "").">".trad("ADMIN_FKE_OPT0")."</OPTION><OPTION value=\"Basic\"".((($FCKE_TOOLBAR_CFG == "Basic")) ? " selected" : "").">".trad("ADMIN_FKE_OPT1")."</OPTION><OPTION value=\"Intermed\"".(($FCKE_TOOLBAR_CFG == "Intermed") ? " selected" : "").">".trad("ADMIN_FKE_OPT2")."</OPTION><OPTION value=\"Extend\"".(($FCKE_TOOLBAR_CFG == "Extend") ? " selected" : "").">".trad("ADMIN_FKE_OPT3")."</OPTION><OPTION value=\"Full\"".((($FCKE_TOOLBAR_CFG == "Full")) ? " selected" : "").">".trad("ADMIN_FKE_OPT4")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_OUTILHTML_DEF")."</I></TD></TR>
      <TR bgcolor=\"#DDDDDD\"><TD style=\"padding-left:14px;\">".trad("ADMIN_MAJCFG_REPNAV")."</TD><TD><INPUT type=\"text\" class=\"Texte\" name=\"fcke_base\" size=\"25\" value=\"$FCKE_BASE\"".((!$AUTORISE_FCKE_CFG) ? " disabled" : "")."></TD><TD><I>".trad("ADMIN_MAJCFG_REPNAV_DEF")."</I></TD></TR>
      <TR bgcolor=\"#DDDDDD\"><TD style=\"padding-left:14px;\">".trad("ADMIN_MAJCFG_NAVFIC")."</TD><TD><SELECT name=\"fcke_browse\"".((!$AUTORISE_FCKE_CFG) ? " disabled" : "")."><OPTION value=\"OUI\"".(($FCKE_BROWSE) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$FCKE_BROWSE) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_NAVFIC_DEF")."</I></TD></TR>
      <TR bgcolor=\"#DDDDDD\"><TD style=\"padding-left:14px;\">".trad("ADMIN_MAJCFG_UPFIC")."</TD><TD><SELECT name=\"fcke_upload\"".((!$AUTORISE_FCKE_CFG) ? " disabled" : "")."><OPTION value=\"OUI\"".(($FCKE_UPLOAD) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$FCKE_UPLOAD) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_UPFIC_DEF")."</I></TD></TR>
      <TR><TD class=\"ProfilMenuActif\" colspan=3 align=\"center\">".trad("ADMIN_MAJCFG_TITREMAIL")."</TD></TR>
  <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_SRVSMTP")."</TD><TD colspan=2><INPUT type=\"text\" class=\"Texte\" name=\"serveurSMTP\" size=\"30\" value=\"$SMTP_SERVER\">&nbsp;&nbsp;&nbsp;<I>".trad("ADMIN_MAJCFG_SRVSMTP_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_PRTSMTP")."</TD><TD colspan=2><INPUT type=\"text\" class=\"Texte\" name=\"portSMTP\" size=\"30\" value=\"$SMTP_PORT\">&nbsp;&nbsp;&nbsp;<I>".trad("ADMIN_MAJCFG_PRTSMTP_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_LOGSMTP")."</TD><TD colspan=2><INPUT type=\"text\" class=\"Texte\" name=\"logSMTP\" size=\"30\" value=\"$SMTP_LOGIN\">&nbsp;&nbsp;&nbsp;<I>".trad("ADMIN_MAJCFG_LOGSMTP_DEF")."</I></TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_MDPSMTP")."</TD><TD colspan=2><INPUT type=\"password\" class=\"Texte\" name=\"pwdSMTP\" size=\"30\" value=\"$SMTP_PASSWORD\">&nbsp;&nbsp;&nbsp;<I>".trad("ADMIN_MAJCFG_MDPSMTP_DEF")."</I></TD></TR>
      <TR><TD class=\"ProfilMenuActif\" colspan=3 align=\"center\">".trad("ADMIN_MAJCFG_TITREDEBUG")."</TD></TR>
      <TR bgcolor=\"".$bgColor[++$iColor%2]."\"><TD>".trad("ADMIN_MAJCFG_INFODEBUG")."</TD><TD><SELECT name=\"info_debug\"><OPTION value=\"OUI\"".(($AFF_INFO_DEBUG) ? " selected" : "").">".trad("COMMUN_OUI")."</OPTION><OPTION value=\"NON\"".((!$AFF_INFO_DEBUG) ? " selected" : "").">".trad("COMMUN_NON")."</OPTION></SELECT></TD><TD><I>".trad("ADMIN_MAJCFG_INFODEBUG_DEF")."</I></TD></TR>
      <TR><TD colspan=3 align=\"center\" height=\"30\" class=\"bordT\"><INPUT type=\"submit\" class=\"Bouton\" name=\"envoyer\" value=\"".trad("ADMIN_BT_VALIDER")."\"></TD></TR>
      </TABLE>
  </FORM>");
}
?>
<?php
//config 2
//Enregistrement de parametres de configuration
if ($config==2) {
  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/outils.png\">".trad("ADMIN_MAJ_CFG"),"<B>".sprintf(trad("ADMIN_ETAPE"), 2)."</B> - ".trad("ADMIN_TITRE2_MAJ_CFG"));

  //Test d'ouverture en ecriture du fichier de configuration
  ($fc=fopen($file_config,"w")) or die ("  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\"><FONT color=\"#ff0000\">".trad("ADMIN_MAJCFG_ERRFIC")."</FONT><BR>&nbsp;</TD></TR></TABLE></TD></TR></TABLE></BODY></HTML>");
  fputs($fc,"<?php\n");
  fputs($fc,"  /**************************************************************************\\\n");
  fputs($fc,"  * Phenix Agenda                                                            *\n");
  fputs($fc,"  * http://phenix.gapi.fr                                                    *\n");
  fputs($fc,"  * Written by    Stephane TEIL            <phenix-agenda@laposte.net>       *\n");
  fputs($fc,"  * Contributors  Christian AUDEON (Omega) <christian.audeon@gmail.com>      *\n");
  fputs($fc,"  *               Maxime CORMAU (MaxWho17) <maxwho17@free.fr>                *\n");
  fputs($fc,"  *               Mathieu RUE (Frognico)   <matt_rue@yahoo.fr>               *\n");
  fputs($fc,"  *               Bernard CHAIX (Berni69)  <ber123456@free.fr>               *\n");
  fputs($fc,"  * --------------------------------------------                             *\n");
  fputs($fc,"  *  This program is free software; you can redistribute it and/or modify it *\n");
  fputs($fc,"  *  under the terms of the GNU General Public License as published by the   *\n");
  fputs($fc,"  *  Free Software Foundation; either version 2 of the License, or (at your  *\n");
  fputs($fc,"  *  option) any later version.                                              *\n");
  fputs($fc,"  \**************************************************************************/\n\n");
  fputs($fc,"// ----------------------------------------------------------------------------\n");
  fputs($fc,"// ".trad("ADMIN_CONFIG_INC_LG17")."\n");
  fputs($fc,"// ----------------------------------------------------------------------------\n");
  fputs($fc,"  \$APPLI_VERSION = \"${APPLI_VERSION}\";\n");
  fputs($fc,"  \$APPLI_LANGUE  = \"$langue\"; // ".trad("ADMIN_CONFIG_INC_LG20")."\n\n");
  fputs($fc,"// ----------------------------------------------------------------------------\n");
  fputs($fc,"// ".trad("ADMIN_CONFIG_INC_LG23")."\n");
  fputs($fc,"// ----------------------------------------------------------------------------\n");
  fputs($fc,"  \$cfgHote       = \"".$cfgHote."\"; // ".trad("ADMIN_CONFIG_INC_LG25")."\n");
  fputs($fc,"  \$cfgUser       = \"".$cfgUser."\"; // ".trad("ADMIN_CONFIG_INC_LG26")."\n");
  fputs($fc,"  \$cfgPass       = \"".$cfgPass."\"; // ".trad("ADMIN_CONFIG_INC_LG27")."\n");
  fputs($fc,"  \$cfgBase       = \"".$cfgBase."\"; // ".trad("ADMIN_CONFIG_INC_LG28")."\n");
  fputs($fc,"  \$PREFIX_TABLE  = \"".$PREFIX_TABLE."\"; // ".trad("ADMIN_CONFIG_INC_LG29")."\n");
  fputs($fc,"  \$CHEMIN_ABSOLU = ".$cheminabsolu.";\n");
  if ($cheminabsolu=="true") {
    $path_file_class = realpath("inc/db_class.inc.php");
    $path_file_class = str_replace("\\","/",$path_file_class);
  } else {
    $path_file_class="inc/db_class.inc.php";
  }
  fputs($fc,"  if (\$_GET['msg']!=\"6\") {\n    // ".trad("ADMIN_CONFIG_INC_LG32")."\n");
  fputs($fc,"    include(\"".$path_file_class."\");\n");
  fputs($fc,"  }\n\n");
  fputs($fc,"  define(\"_CONF_INC_LOADED\",true);\n");
  fputs($fc,"?>");
  fclose($fc);

  if ($autorise_html!="OUI" || $autorise_fcke!="OUI") {
    $autorise_fcke = $fcke_browse = $fcke_upload = "NON";
    $fcke_toolbar = "Intermed";
    $fcke_base = "/UserFiles/";
  }

  insertOrUpdate("APPLI_VERSION",${APPLI_VERSION},0);
  insertOrUpdate("APPLI_LANGUE",$langue,0);
  insertOrUpdate("AUTORISE_SUPPR",$suppr,0);
  insertOrUpdate("DUREE_SESSION",($session+0),0);
  insertOrUpdate("COOKIE_AUTH",$cookauth,0);
  insertOrUpdate("COOKIE_NOM",$cooknom,0);
  insertOrUpdate("COOKIE_DUREE",$cookduree,0);
  insertOrUpdate("PUBLIC",$public,0);
  insertOrUpdate("RELOAD_PLANNING",($reload+0),0);
  insertOrUpdate("AUTO_UPPERCASE",$majuscule,0);
  insertOrUpdate("MODIF_PARTAGE",$modif_partage,0);
  insertOrUpdate("CHECK_VERSION",$check_version,0);
  insertOrUpdate("RELOAD_CALENDAR",$reload_calendar,0);
  insertOrUpdate("AUTORISE_HTML",$autorise_html,0);
  insertOrUpdate("AUTORISE_FCKE",$autorise_fcke,0);
  insertOrUpdate("INDEX_STYLE",$index_style,0);
  insertOrUpdate("FCKE_TOOLBAR",$fcke_toolbar,0);
  insertOrUpdate("FCKE_BASE",$fcke_base,0);
  insertOrUpdate("FCKE_BROWSE",$fcke_browse,0);
  insertOrUpdate("FCKE_UPLOAD",$fcke_upload,0);
  insertOrUpdate("SMTP_SERVER",$serveurSMTP,0);
  insertOrUpdate("SMTP_PORT",$portSMTP,0);
  insertOrUpdate("SMTP_LOGIN",$logSMTP,0);
  insertOrUpdate("SMTP_PASSWORD",$pwdSMTP,0);
  insertOrUpdate("AFF_INFO_DEBUG",$info_debug,0);

  //Fin de la mise a jour du fichier de configuration
  echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_MAJCFG2_OK"), "<B>conf.inc.php</B>")."<BR>\n";
  echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_MAJCFG2_FIN")."<BR><BR>\n";
}
?>
