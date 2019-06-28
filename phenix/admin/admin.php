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

// Gestion des rapports d'erreurs
error_reporting (E_ALL ^ E_NOTICE);

if ($droit_ADMIN=="O" && !$idAdmin) {
?>
  <SCRIPT language="JavaScript" src="inc/MD5.js" type="text/javascript"></SCRIPT>
  <SCRIPT language="JavaScript">
  <!--
    function saisieOKLog(theForm) {
      if (trim(theForm.ztLoginAdm.value) == "") {
        window.alert("<?php echo trad("ADMIN_ERREUR_LOGIN"); ?>");
        theForm.ztLoginAdm.focus();
        return (false);
      }

      if (trim(theForm.ztPasswdAdm.value) == "") {
        window.alert("<?php echo trad("ADMIN_ERREUR_PASSWORD"); ?>");
        theForm.ztPasswdAdm.focus();
        return (false);
      }

      //Cryptage MD5 du mot de passe avant submit (s'il a ete renseigne)
       theForm.ztPasswdMD5Adm.value = MD5(theForm.ztPasswdAdm.value);
      //Mot de passe en clair supprime
      theForm.ztPasswdAdm.value = "";
      return (true);
    }
  //-->
  </SCRIPT>
  <TABLE cellspacing="0" cellpadding="0" width="100%" border="0">
  <TR>
    <TD height="28" class="sousMenu">&nbsp;</TD>
  </TR>
  </TABLE>
  <BR><BR><FORM action="agenda.php?sid=<?php echo $sid; ?>&tcMenu=<?php echo _MENU_ADMIN; ?>&tcPlg=<?php echo $tcPlg; ?>" method="post" name="formLogAdmin" id="formLogAdmin" onsubmit="javascript: return saisieOKLog(this);">
    <TABLE border="0" cellspacing="1" cellpadding="0" align="center" style="border-collapse:separate;" bgcolor="<?php echo $AgendaBordureTableau; ?>">
        <TR>
          <TD class="ProfilMenuActif" align="center" valign="middle" height="22" style="font-size:12px;"><B><?php echo sprintf(trad("TITRE_ADMIN"), $APPLI_VERSION); ?></B></TD>
        </TR>
        <TR>
          <TD align="center" bgcolor="<?php echo $bgColor[1]; ?>"><TABLE border="0" cellspacing="0" cellpadding="2" style="font-size:11px;">
            <TR>
              <TD height="18" colspan=2>&nbsp;</TD>
              <TD rowspan=4 align="center" width="80"><IMG src="image/admin/admin.png" alt="" width="64" height="64" border="0"></TD>
            </TR>
            <TR>
              <TD height="22">&nbsp;<?php echo trad("ADMIN_UTILISATEUR"); ?>&nbsp;</TD>
              <TD><INPUT type="text" class="Texte" name="ztLoginAdm" size="15" maxlength="12" value=""></TD>
            </TR>
            <TR>
              <TD height="22" nowrap>&nbsp;<?php echo trad("ADMIN_PASSWORD"); ?>&nbsp;</TD>
              <TD><INPUT type="password" class="Texte" name="ztPasswdAdm" size="15" maxlength="12" value=""><INPUT type="hidden" name="ztPasswdMD5Adm"></TD>
            </TR>
            <TR>
              <TD height="50" colspan="3" align="center" valign="middle"><INPUT type="submit" class="Bouton" value="<?php echo trad("ADMIN_CONNECTER"); ?>" name="btSubmitAdm"></TD>
            </TR>
          </TABLE></TD>
        </TR>
    </TABLE>
  </FORM>
  <SCRIPT type="text/javascript">
  <!--
    document.formLogAdmin.ztLoginAdm.focus();
  //-->
  </SCRIPT>
<?php
} elseif ($droit_ADMIN=="O") {
  $NOM_PAGE = "agenda.php?sid=".$sid."&tcMenu="._MENU_ADMIN."&tcPlg=".$tcPlg;

  $config   += 0;
  $modcoul  += 0;
  $delcpt   += 0;
  $nvcpt    += 0;
  $modcpt   += 0;
  $backup   += 0;
  $addevt   += 0;
  $delevt   += 0;
  $delnote  += 0;
  $optimize += 0;
  $deladm   += 0;
  $nvadm    += 0;
  $modadm   += 0;
  $groupe   += 0;
  $param    += 0;
  $instmod  += 0;

  if ($adm_choix=="config")
    $config=1;
  else if ($adm_choix=="delcp")
    $delcpt=1;
  else if ($adm_choix=="nvcpt")
    $nvcpt=1;
  else if ($adm_choix=="modcpt")
    $modcpt=1;
  else if ($adm_choix=="backup")
    $backup=1;
  else if ($adm_choix=="addevt")
    $addevt=1;
  else if ($adm_choix=="delevt")
    $delevt=1;
  else if ($adm_choix=="delnote")
    $delnote=1;
  else if ($adm_choix=="optimize")
    $optimize=1;
  else if ($adm_choix=="nvadm")
    $nvadm=1;
  else if ($adm_choix=="modadm")
    $modadm=1;
  else if ($adm_choix=="deladm")
    $deladm=1;
  else if ($adm_choix=="modcoul")
    $modcoul=1;
  else if ($adm_choix=="groupe")
    $groupe=1;
  else if ($adm_choix=="param")
    $param=1;
  else if ($adm_choix=="instmod")
    $instmod=1;

  $file_config  = "inc/conf.inc.php";
  $file_calendarcss =  "css/calendar_css.php";
  $file_calendarjs =  "inc/calendar.js";
  $file_calendarsetup =  "inc/calendar-setup.js.php";
  $file_checkdatejs =  "inc/checkdate.js.php";

  if ($nvcpt || $modcpt==2 || $nvadm || $modadm==2 ) {
?>
  <SCRIPT language="JavaScript" src="inc/MD5.js" type="text/javascript"></SCRIPT>
  <SCRIPT language="JavaScript">
  <!--
    //Genere automatiquement un login
    function loginAuto(theForm) {
      var prenomUtil, nomUtil, loginUtil;

      if ((theForm.ztNom.value != "") && (theForm.ztPrenom.value != "")) {
        prenomUtil = theForm.ztPrenom.value;
        nomUtil = theForm.ztNom.value;
        loginUtil = prenomUtil.substr(0,1) + nomUtil.replace(/ +/gi, "");
        loginUtil = loginUtil.substr(0,12);
        theForm.ztLogin.value = loginUtil.toLowerCase();
      }
      else {
        window.alert("<?php echo trad("ADMIN_JAVA_NOM_PRENOM"); ?>");
        theForm.ztNom.focus();
      }
    }

    //Verifie la saisie
    function saisieOK(theForm) {
<?php if ($nvcpt) { ?>
      if (trim(theForm.ztNom.value) == "") {
        alert("<?php echo trad("ADMIN_JAVA_NOM"); ?>");
        theForm.ztNom.focus();
        return (false);
      }
      if (trim(theForm.ztPrenom.value) == "") {
        alert("<?php echo trad("ADMIN_JAVA_PRENOM"); ?>");
        theForm.ztPrenom.focus();
        return (false);
      }
<?php }?>
      if (trim(theForm.ztLogin.value) == "") {
        window.alert("<?php echo trad("ADMIN_JAVA_LOGIN"); ?>");
        theForm.ztLogin.focus();
        return (false);
      }

<?php if ($nvcpt || $nvadm) { ?>
      if (trim(theForm.ztPasswd.value) == "") {
        window.alert("<?php echo trad("ADMIN_JAVA_MDP"); ?>");
        theForm.ztPasswd.focus();
        return (false);
      }
<?php } ?>
      if (theForm.ztPasswd.value != theForm.ztConfirmPasswd.value) {
        window.alert("<?php echo trad("ADMIN_JAVA_MDPDIFF"); ?>");
        theForm.ztPasswd.value = "";
        theForm.ztConfirmPasswd.value = "";
        theForm.ztPasswd.focus();
        return (false);
      }

      //Cryptage MD5 du mot de passe avant submit (s'il a ete renseigne)
      if (trim(theForm.ztConfirmPasswd.value) != "") {
        theForm.ztPasswdMD5.value = MD5(theForm.ztConfirmPasswd.value);
        //Mots de passe en clair supprimes
        theForm.ztPasswd.value = "";
        theForm.ztConfirmPasswd.value = "";
      }

      theForm.submit();
      return (true);
    }
  //-->
  </SCRIPT>
<?php
  }

  function AffSousTitre($titreModule,$titreTableau,$tailleTab="720") {
    global $AgendaBordureTableau, $sid, $bgColor, $tcPlg;
    echo ("  <TABLE cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
  <TR>
    <TD class=\"sousMenu\" width=\"150\">&nbsp;</TD>
    <TD class=\"sousMenu\" height=\"28\">".$titreModule."</TD>
    <TD class=\"sousMenu\" width=\"150\" align=\"right\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_MENU_ADMIN")."\" onClick=\"window.location.href ='agenda.php?sid=".$sid."&tcMenu="._MENU_ADMIN."&tcPlg=".$tcPlg."'\">&nbsp;</TD>
  </TR>
  </TABLE>
  <BR><TABLE border=\"0\" cellspacing=1 cellpadding=0 style=\"border-collapse:separate;\" bgcolor=\"$AgendaBordureTableau\" align=\"center\" width=\"$tailleTab\">
  <TR>
    <TD class=\"ProfilMenuActif\" height=\"22\" align=\"center\">".$titreTableau."</TD>
  </TR>
  <TR>
    <TD bgcolor=\"".$bgColor[1]."\">\n");
  }

  $piedPage="</TD></TR></TABLE>";

  //MAJ du fichier de configuration
  if ($config) { include("admin_config.php"); echo $piedPage; }

  //MAJ du fichier de couleur
  elseif ($modcoul) { include("admin_couleur.php"); echo $piedPage; }

  //Suppression d'un compte utilisateur (mode admin)
  elseif ($delcpt) { include("admin_util_suppr.php"); echo $piedPage; }

  //Creation d'un compte utilisateur (mode admin)
  elseif ($nvcpt) { include("admin_util_creer.php"); echo $piedPage; }

  //Modification d'un compte utilisateur (mode admin)
  elseif ($modcpt) { include("admin_util_modif.php"); echo $piedPage; }

  //Creation d'un compte administrateur (mode admin)
  elseif ($nvadm) { include("admin_admin_creer.php"); echo $piedPage; }

  //Modification d'un compte administrateur (mode admin)
  elseif ($modadm) { include("admin_admin_modif.php"); echo $piedPage; }

  //Suppression d'un compte administrateur (mode admin)
  elseif ($deladm) { include("admin_admin_suppr.php"); echo $piedPage; }

  //Sauvegarde de la base de donnees
  elseif ($backup) { include("admin_backup.php"); echo $piedPage; }

  //Optimisation de la base de donnees
  elseif ($optimize) { include("admin_optimisation.php"); echo $piedPage; }

  //Ajout d'evenement par l'administrateur a tous (eve_util_id=0) ou individuel
  elseif ($addevt) { include("admin_evt_ajout.php"); echo $piedPage; }

  //Suppression des evenements crees par l'administrateur (eve_util_id=0)
  elseif ($delevt) { include("admin_evt_suppr.php"); echo $piedPage; }

  //Suppression des notes avant une date donnee
  elseif ($delnote) { include("admin_note_suppr.php"); echo $piedPage; }

  //Gestion des groupes d'utilisateur
  elseif ($groupe) { include("admin_groupe.php"); echo $piedPage; }

  //Gestion des parametres utilisateur
  elseif ($param) { include("admin_param.php"); echo $piedPage; }

  //Installation d'un mod
  elseif ($instmod) { include("admin_mods.php"); echo $piedPage; }

  //Menu general d'administration
  else {
    echo ("  <TABLE cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
    <TR><TD class=\"sousMenu\" height=\"28\"><B>".trad("ADMIN_MENU")."</B></TD></TR>
  </TABLE>
  <BR>
  <TABLE cellspacing=1 cellpadding=0 style=\"border-collapse:separate;\" bgcolor=\"$AgendaBordureTableau\" align=\"center\" width=\"720\">
  <TR valign=\"middle\" height=\"30\" align=\"center\">
    <TD bgcolor=\"".$bgColor[1]."\" width=\"25%\">".trad("ADMIN_MENU_1")."</TD>
    <TD bgcolor=\"".$bgColor[0]."\" width=\"25%\">".trad("ADMIN_MENU_2")."</TD>
    <TD bgcolor=\"".$bgColor[1]."\" width=\"25%\">".trad("ADMIN_MENU_3")."</TD>
    <TD bgcolor=\"".$bgColor[0]."\" width=\"25%\">".trad("ADMIN_MENU_4")."</TD>
  </TR>
  <TR valign=\"top\">
    <TD bgcolor=\"".$bgColor[1]."\"><A href=\"${NOM_PAGE}&adm_choix=param\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/param.png\">".trad("ADMIN_PARAM")."</A><BR>
      <A href=\"${NOM_PAGE}&adm_choix=config\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/outils.png\">".trad("ADMIN_MAJ_CFG")."</A><BR>
      <A href=\"${NOM_PAGE}&adm_choix=backup\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/sql.png\">".trad("ADMIN_SAVE_DB")."</A><BR>
      <A href=\"${NOM_PAGE}&adm_choix=optimize\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/optim.png\">".trad("ADMIN_OPT_DB")."</A><BR>
      <A href=\"${NOM_PAGE}&adm_choix=instmod\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/mods.png\">".trad("ADMIN_INST_MOD")."</A>
    </TD>

    <TD bgcolor=\"".$bgColor[0]."\"><A href=\"${NOM_PAGE}&adm_choix=nvcpt\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/ajout.png\">".trad("ADMIN_CREER_COMPTE")."</A><BR>
      <A href=\"${NOM_PAGE}&adm_choix=modcpt\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/mod.png\">".trad("ADMIN_MAJ_COMPTE")."</A><BR>\n");
    $DB_CX->DbQuery("SELECT util_id FROM ${PREFIX_TABLE}utilisateur");
    // Impossible de supprimer le dernier compte utilisateur existant (en l'occurrence celui actuellement connecte)
    if ($DB_CX->DbNumRows()>1) {
      echo "      <A href=\"${NOM_PAGE}&adm_choix=delcp\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/sup.png\">".trad("ADMIN_SUP_COMPTE")."</A><BR>\n";
    }
    echo ("      <A href=\"${NOM_PAGE}&adm_choix=groupe\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/group.png\">".trad("ADMIN_GROUPE")."</A>
    </TD>

    <TD bgcolor=\"".$bgColor[1]."\"><A href=\"${NOM_PAGE}&adm_choix=nvadm\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/ajout.png\">".trad("ADMIN_CREER_COMPTE")."</A><BR>
      <A href=\"${NOM_PAGE}&adm_choix=modadm\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/mod.png\">".trad("ADMIN_MAJ_COMPTE")."</A><BR>\n");
    $DB_CX->DbQuery("SELECT admin_id FROM ${PREFIX_TABLE}admin");
    // Impossible de supprimer le dernier compte administrateur existant (en l'occurrence celui actuellement connecte)
    if ($DB_CX->DbNumRows()>1) {
      echo "      <A href=\"${NOM_PAGE}&adm_choix=deladm\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/sup.png\">".trad("ADMIN_SUP_COMPTE")."</A><BR>\n";
    }
    echo ("    </TD>

    <TD bgcolor=\"".$bgColor[0]."\"><A href=\"${NOM_PAGE}&adm_choix=addevt\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/import.png\">".trad("ADMIN_AJOUT_EVE")."</A><BR>\n");
    $DB_CX->DbQuery("SELECT eve_id FROM ${PREFIX_TABLE}evenement WHERE eve_util_id=0");
    // Pas de lien si il n'y a pas d'evenement commun
    if ($DB_CX->DbNumRows()>1) {
      echo "      <A href=\"${NOM_PAGE}&adm_choix=delevt\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/vider.png\">".trad("ADMIN_SUP_EVE")."</A><BR>\n";
    }
    echo ("      <A href=\"${NOM_PAGE}&adm_choix=delnote\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/note.png\">".trad("ADMIN_SUP_NOTE")."</A><BR>
      <A href=\"${NOM_PAGE}&adm_choix=modcoul\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/admin/coul.png\">".trad("ADMIN_MAJ_COUL")."</A>
    </TD>
  </TR>
  <TR>
    <TD colspan=4 valign=\"middle\" height=\"30\" align=\"center\" bgcolor=\"".$bgColor[0]."\"><A href=\"agenda_traitement.php?sid=".$sid."&ztDiscon=Admin&tcPlg=".$tcPlg."\"><IMG align=\"absmiddle\" hspace=\"5\" vspace=\"3\" border=0 src=\"image/quitter.gif\">".trad("ADMIN_DISCONNECT")."</TD>
  </TR>
  </TABLE>");
  }
} else {
  // L'utilisateur n'a rien a faire sur cette page
  echo ("  <TABLE cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
    <TR><TD class=\"sousMenu\" height=\"28\">&nbsp;</B></TD></TR>
  </TABLE>
  <BR>");
}
?>
