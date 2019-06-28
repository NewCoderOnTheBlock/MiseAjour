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

//param 1
//MAJ du fichier de configuration
if ($param==1) {
?>
  <SCRIPT language="JavaScript" type="text/javascript">
  <!--
    function autoriseFCKE(theForm,_val,_all) {
      var _statut = (_val=="N");
      if (!_all) {
        theForm.zlFCKEbar.disabled=_statut;
        if (_val=="N")
          autoriseFCKE(theForm,"N",true);
        else
          autoriseFCKE(theForm,theForm.zlFCKEbar.value,true);
      }
    }
  //-->
  </SCRIPT>
<?php
  $DB_CX->DbQuery("SHOW FIELDS FROM ".$PREFIX_TABLE."utilisateur");
  while ($champ = $DB_CX->DbNextRow()) {
    $rsProfil[$champ[Field]]=$champ['Default'];
  }

  // Generation des variables pour les jours affiches par defaut dans les planning hebdomadaires et mensuels
  for ($i=1; $i<8; $i++) {
    ${"bt".$i} = substr($rsProfil['util_semaine_type'],$i-1,1);
  }

  $iColor = 1;
  $tabIndex = 1;

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/param.png\">".trad("ADMIN_PARAM"),"<B>".sprintf(trad("ADMIN_ETAPE"), 1)."</B> - ".trad("ADMIN_TITRE_MAJ_PARAM"));
?>
  <FORM method="post" action="<?php echo ${NOM_PAGE}; ?>&param=2" name="frmAdmParam" id="frmAdmParam">
    <TABLE cellspacing="0" cellpadding="0" border="0" width="100%">
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_JOURNEE_TYPE"); ?></TD>
      <TD nowrap class="bordBas"><TABLE cellspacing="0" cellpadding="0" width="320" border="0">
        <TR bgcolor="<?php echo $bgColor[$iColor%2]; ?>">
          <TD width="50%" nowrap><?php echo trad("PROFIL_JOUR_DEBUTE"); ?>&nbsp;<SELECT name="zlHeureDebut" size="1" tabindex="<?php echo $tabIndex++; ?>">
<?php
  for ($i=0; $i<23.5;$i=$i+0.5) {
    $selected = ($i == $rsProfil['util_debut_journee']) ? " selected" : "";
    echo "            <OPTION value=\"".$i."\"".$selected.">".afficheHeure($i,$i,$formatHeure)."</OPTION>\n";
  }
?>
          </SELECT></TD>
          <TD width="50%" nowrap><?php echo trad("PROFIL_JOUR_TERMINE"); ?>&nbsp;<SELECT name="zlHeureFin" size="1" tabindex="<?php echo $tabIndex++; ?>">
<?php
  for ($i=0.5; $i<24;$i=$i+0.5) {
    $selected = ($i == $rsProfil['util_fin_journee']) ? " selected" : "";
    echo "            <OPTION value=\"".$i."\"".$selected.">".afficheHeure($i,$i,$formatHeure)."</OPTION>\n";
  }
?>
          </SELECT></TD>
        </TR>
      </TABLE></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_AFFICH_NOM"); ?></TD>
      <TD class="bordBas"><SELECT name="zlFormatNom" size="1" tabindex="<?php echo $tabIndex++; ?>">
        <OPTION value="0"<?php if ($rsProfil['util_format_nom']=="0") echo " selected"; ?>><?php echo trad("PROFIL_NOM_PRENOM"); ?></OPTION>
        <OPTION value="1"<?php if ($rsProfil['util_format_nom']=="1") echo " selected"; ?>><?php echo trad("PROFIL_PRENOM_NOM"); ?></OPTION>
      </SELECT></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_TELEPHONE"); ?></TD>
      <TD class="bordBas"><LABEL for="vf"><INPUT type="radio" name="rdTelephone" value="O" class="Case" id="vf" tabindex="<?php echo $tabIndex++; ?>"<?php if ($rsProfil['util_telephone_vf']!="N") echo " checked"; ?>>&nbsp;<?php echo trad("COMMUN_OUI"); ?></LABEL>&nbsp;&nbsp;&nbsp;&nbsp;<LABEL for="novf"><INPUT type="radio" name="rdTelephone" value="N" class="Case" id="novf" tabindex="<?php echo $tabIndex++; ?>"<?php if ($rsProfil['util_telephone_vf']=="N") echo " checked"; ?>>&nbsp;<?php echo trad("COMMUN_NON"); ?></LABEL>&nbsp;&nbsp;<?php echo trad("PROFIL_STYLE_TELEPHONE"); ?></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_LANGUE"); ?></TD>
      <TD class="bordBas"><SELECT name="zlLangue" size="1" tabindex="<?php echo $tabIndex++; ?>">
<?php
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
  foreach ($tabLangue as $key=>$val) {
    $selected = ($rsProfil['util_langue'] == $key) ? " selected" : "";
    echo "        <OPTION value=\"".$key."\"".$selected.">".$val."</OPTION>\n";
  }
?>
      </SELECT></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_INTERFACE"); ?></TD>
      <TD class="bordBas"><SELECT name="zlInterface" size="1" tabindex="<?php echo $tabIndex++; ?>">
<?php
  // Recuperation des noms d'interface directement dans les fichiers du repertoire "skins"
  $rep = opendir("./skins");
  while ($file = readdir($rep)) {
    if ($file!=".." && $file!="." && $file!="" && $file!="index.htm") {
      if (!is_dir("skins/".$file) && $fd = @fopen("skins/".$file, "r")) {
        $ligne = fread($fd, 200);
        $pos1 = @strpos($ligne,"\"");
        $pos2 = @strpos(substr($ligne,$pos1+1),"\"");
        $typeSkin = substr(stristr($ligne,"SkinAccueil="),12,1);
        if ($typeSkin!=1)
          $tabInterface[substr($file,0,@strpos($file,"."))] = trim(@substr($ligne,$pos1+1,$pos2));
        fclose($fd);
      }
    }
  }
  closedir($rep);
  clearstatcache();
  ksort($tabInterface);
  foreach ($tabInterface as $nomFic=>$nomSkin) {
    if (!empty($nomSkin)) {
      $selected = (strcasecmp($rsProfil['util_interface'], $nomFic)==0) ? " selected" : "";
      echo "        <OPTION value=\"".$nomFic."\"".$selected.">".$nomSkin."</OPTION>\n";
    }
  }
?>
      </SELECT></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_FCKE"); ?></TD>
      <TD class="bordBas"><SELECT name="zlFCKE" onchange="javascript: autoriseFCKE(document.frmAdmParam,this.value,false);"><OPTION value="O"<?php echo (($rsProfil['util_fcke']!="N") ? " selected" : "").">".trad("COMMUN_OUI"); ?></OPTION><OPTION value="N"<?php echo (($rsProfil['util_fcke']=="N") ? " selected" : "").">".trad("COMMUN_NON"); ?></OPTION></SELECT>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <B><?php echo trad("PROFIL_LIB_FCKE_OUTILS"); ?></B>&nbsp;<SELECT name="zlFCKEbar"<?php echo (($rsProfil['util_fcke']=="N") ? " disabled" : ""); ?>>
        <OPTION value="Basic"<?php if ($rsProfil['util_fcke_toolbar']== "Basic") echo " selected"; ?>><?php echo trad("PROFIL_FKE_OPT1"); ?></OPTION>
        <OPTION value="Intermed"<?php if ($rsProfil['util_fcke_toolbar'] == "Intermed") echo " selected"; ?>><?php echo trad("PROFIL_FKE_OPT2"); ?></OPTION>
        <OPTION value="Extend"<?php if ($rsProfil['util_fcke_toolbar'] == "Extend") echo " selected"; ?>><?php echo trad("PROFIL_FKE_OPT3"); ?></OPTION>
        <OPTION value="Full"<?php if ($rsProfil['util_fcke_toolbar'] == "Full") echo " selected"; ?>><?php echo trad("PROFIL_FKE_OPT4"); ?></OPTION></SELECT></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_PLANNING"); ?></TD>
      <TD class="bordBas"><SELECT name="zlPlanning" size="1" tabindex="<?php echo $tabIndex++; ?>">
        <OPTION value="0"<?php if ($rsProfil['util_planning']==0) echo " selected"; ?>><?php echo trad("PROFIL_PLG_QUOT"); ?></OPTION>
        <OPTION value="1"<?php if ($rsProfil['util_planning']==1) echo " selected"; ?>><?php echo trad("PROFIL_PLG_HEBDO"); ?></OPTION>
        <OPTION value="2"<?php if ($rsProfil['util_planning']==2) echo " selected"; ?>><?php echo trad("PROFIL_PLG_MENS"); ?></OPTION>
        <OPTION value="6"<?php if ($rsProfil['util_planning']==6) echo " selected"; ?>><?php echo trad("PROFIL_PLG_QUOTGLOB"); ?></OPTION>
        <OPTION value="5"<?php if ($rsProfil['util_planning']==5) echo " selected"; ?>><?php echo trad("PROFIL_PLG_HEBDGLOB"); ?></OPTION>
        <OPTION value="4"<?php if ($rsProfil['util_planning']==4) echo " selected"; ?>><?php echo trad("PROFIL_PLG_MENSGLOB"); ?></OPTION>
        <OPTION value="13"<?php if ($rsProfil['util_planning']==13) echo " selected"; ?>><?php echo trad("PROFIL_PLG_CHOIX"); ?></OPTION>
      </SELECT>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <B><?php echo trad("PROFIL_LIB_DISPO"); ?></B>&nbsp;<SELECT name="zlMenuDispo" size="1" tabindex="<?php echo $tabIndex++; ?>">
        <OPTION value="9"<?php if ($rsProfil['util_menu_dispo']==9) echo " selected"; ?>><?php echo trad("PROFIL_DISPO_QUOT"); ?></OPTION>
        <OPTION value="8"<?php if ($rsProfil['util_menu_dispo']==8) echo " selected"; ?>><?php echo trad("PROFIL_DISPO_HEBDO"); ?></OPTION>
      </SELECT></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_SEMAINE"); ?></TD>
      <TD class="bordBas"><LABEL for="lundi"><INPUT type="checkbox" name="bt1" value="1" tabindex="<?php echo $tabIndex++; ?>"<?php if ($bt1==1) echo " checked"; ?> class="case" id="lundi">&nbsp;<?php echo trad("PROFIL_LUN"); ?></LABEL>&nbsp;&nbsp;
        <LABEL for="mardi"><INPUT type="checkbox" name="bt2" value="1" tabindex="<?php echo $tabIndex++; ?>"<?php if ($bt2==1) echo " checked"; ?> class="case" id="mardi">&nbsp;<?php echo trad("PROFIL_MAR"); ?></LABEL>&nbsp;&nbsp;
        <LABEL for="mercredi"><INPUT type="checkbox" name="bt3" value="1" tabindex="<?php echo $tabIndex++; ?>"<?php if ($bt3==1) echo " checked"; ?> class="case" id="mercredi">&nbsp;<?php echo trad("PROFIL_MER"); ?></LABEL>&nbsp;&nbsp;
        <LABEL for="jeudi"><INPUT type="checkbox" name="bt4" value="1" tabindex="<?php echo $tabIndex++; ?>"<?php if ($bt4==1) echo " checked"; ?> class="case" id="jeudi">&nbsp;<?php echo trad("PROFIL_JEU"); ?></LABEL>&nbsp;&nbsp;
        <LABEL for="vendredi"><INPUT type="checkbox" name="bt5" value="1" tabindex="<?php echo $tabIndex++; ?>"<?php if ($bt5==1) echo " checked"; ?> class="case" id="vendredi">&nbsp;<?php echo trad("PROFIL_VEN"); ?></LABEL>&nbsp;&nbsp;
        <LABEL for="samedi"><INPUT type="checkbox" name="bt6" value="1" tabindex="<?php echo $tabIndex++; ?>"<?php if ($bt6==1) echo " checked"; ?> class="case" id="samedi">&nbsp;<?php echo trad("PROFIL_SAM"); ?></LABEL>&nbsp;&nbsp;
        <LABEL for="dimanche"><INPUT type="checkbox" name="bt7" value="1" tabindex="<?php echo $tabIndex++; ?>"<?php if ($bt7==1) echo " checked"; ?> class="case" id="dimanche">&nbsp;<?php echo trad("PROFIL_DIM"); ?></LABEL></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_PRECISION"); ?></TD>
      <TD class="bordBas"><SELECT name="zlPrecision" size="1" tabindex="<?php echo $tabIndex++; ?>">
        <OPTION value="1"<?php if ($rsProfil['util_precision_planning']==1) echo " selected"; ?>><?php echo trad("PROFIL_PREC_30_MN"); ?></OPTION>
        <OPTION value="2"<?php if ($rsProfil['util_precision_planning']==2) echo " selected"; ?>><?php echo trad("PROFIL_PREC_15_MN"); ?></OPTION>
      </SELECT>&nbsp;&nbsp;<?php echo trad("PROFIL_PREC_PLANNING"); ?></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_DUREE"); ?></TD>
      <TD class="bordBas"><SELECT name="zlDureeNote" size="1" tabindex="<?php echo $tabIndex++; ?>">
        <OPTION value="1"<?php if ($rsProfil['util_duree_note']==1) echo " selected"; ?>><?php echo trad("PROFIL_DUREE_15_MN"); ?></OPTION>
        <OPTION value="2"<?php if ($rsProfil['util_duree_note']==2) echo " selected"; ?>><?php echo trad("PROFIL_DUREE_30_MN"); ?></OPTION>
        <OPTION value="3"<?php if ($rsProfil['util_duree_note']==3) echo " selected"; ?>><?php echo trad("PROFIL_DUREE_45_MN"); ?></OPTION>
        <OPTION value="4"<?php if ($rsProfil['util_duree_note']==4) echo " selected"; ?>><?php echo trad("PROFIL_DUREE_1_H"); ?></OPTION>
      </SELECT>&nbsp;&nbsp;<?php echo trad("PROFIL_DUREE_SEL_AUTO"); ?></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_ASPECT"); ?></TD>
      <TD class="bordBas"><LABEL for="barree"><INPUT type="radio" name="rdBarree" value="O" class="Case" id="barree" tabindex="<?php echo $tabIndex++; ?>"<?php if ($rsProfil['util_note_barree']!="N") echo " checked"; ?>>&nbsp;<FONT style="text-decoration:line-through;"><?php echo trad("PROFIL_ASPECT_BARREE"); ?></FONT></LABEL>&nbsp;&nbsp;&nbsp;&nbsp;<LABEL for="nonbarree"><INPUT type="radio" name="rdBarree" value="N" class="Case" id="nonbarree" tabindex="<?php echo $tabIndex++; ?>"<?php if ($rsProfil['util_note_barree']=="N") echo " checked"; ?>>&nbsp;<?php echo trad("PROFIL_ASPECT_NON_BARREE"); ?></LABEL></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_FUSEAU"); ?></TD>
      <TD class="bordBas"><SELECT name="zlFuseauHoraire" size="1" tabindex="<?php echo $tabIndex++; ?>">
<?php
  // On recupere la liste des fuseaux horaires
  $DB_CX->DbQuery("SELECT tzn_zone, tzn_libelle, tzn_gmt FROM ${PREFIX_TABLE}timezone ORDER BY tzn_gmt, tzn_libelle");
  while ($enr = $DB_CX->DbNextRow()) {
    $selected = ($rsProfil['util_timezone'] == $enr['tzn_zone']) ? " selected" : "";
    $signe = ($enr['tzn_gmt']<0) ? "-" : "+";
    $gmt = abs($enr['tzn_gmt']);
    echo "        <OPTION value=\"".$enr['tzn_zone']."\"".$selected.">(GMT".$signe.afficheHeure(floor($gmt),$gmt).") ".htmlentities($enr['tzn_libelle'])."</OPTION>\n";
  }
?>
      </SELECT><BR>
      <LABEL for="fuseau"><INPUT type="checkbox" name="ckFuseauPartage" value="O" class="Case" id="fuseau" tabindex="<?php echo $tabIndex++; ?>"<?php if ($rsProfil['util_timezone_partage']=="O") echo " checked"; ?>>&nbsp;<?php echo trad("PROFIL_FUSEAU_ORIGINE"); ?></LABEL></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_FORMAT_AFFICHAGE"); ?></TD>
      <TD class="bordBas"><SELECT name="zlFormatHeure" size="1" tabindex="<?php echo $tabIndex++; ?>">
        <OPTION value="24"<?php if ($rsProfil['util_format_heure']=="24") echo " selected"; ?>><?php echo trad("PROFIL_AFFICHAGE_24"); ?></OPTION>
        <OPTION value="12"<?php if ($rsProfil['util_format_heure']=="12") echo " selected"; ?>><?php echo trad("PROFIL_AFFICHAGE_12"); ?></OPTION>
      </SELECT></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>" height="21">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_MENU_ONCLICK"); ?></TD>
      <TD class="bordBas"><LABEL for="onclickok"><INPUT type="radio" name="rdOnClick" value="O" class="Case" id="onclickok" tabindex="<?php echo $tabIndex++; ?>"<?php if ($rsProfil['util_menuonclick']!="N") echo " checked"; ?>>&nbsp;<?php echo trad("COMMUN_OUI"); ?></LABEL>&nbsp;&nbsp;&nbsp;&nbsp;<LABEL for="onclickno"><INPUT type="radio" name="rdOnClick" value="N" class="Case" id="onclickno" tabindex="<?php echo $tabIndex++; ?>"<?php if ($rsProfil['util_menuonclick']=="N") echo " checked"; ?>>&nbsp;<?php echo trad("COMMUN_NON"); ?></LABEL></TD>
    </TR>
<?php
  if ($rsProfil['util_rappel_delai']) {
    $rdRappel1 = "";
    $rdRappel2 = " checked";
  } else {
    $rdRappel1 = " checked";
    $rdRappel2 = "";
  }
?>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas"><?php echo trad("PROFIL_RAPPEL_CREATION"); ?></TD>
      <TD class="bordBas" style="padding:0px;"><TABLE cellspacing="0" cellpadding="0" width="100%" border="0">
        <TR>
          <TD height="20"><IMG src="image/trans.gif" alt="" width="2" height="1" border="0"><LABEL for="rdRappel1"><INPUT type="radio" name="rdRappel" id="rdRappel1" value="1" tabindex="<?php echo $tabIndex++; ?>" class="Case"<?php echo $rdRappel1; ?>>&nbsp;<?php echo trad("PROFIL_PAS_RAPPEL"); ?></LABEL></TD>
        </TR>
        <TR>
          <TD height="20"><IMG src="image/trans.gif" alt="" width="2" height="1" border="0"><LABEL for="rdRappel2"><INPUT type="radio" name="rdRappel" id="rdRappel2" value="2" tabindex="<?php echo $tabIndex++; ?>" class="Case"<?php echo $rdRappel2; ?>>&nbsp;<?php echo trad("COMMUN_LIB_RAPPEL"); ?></LABEL>&nbsp;<SELECT name="zlRappelDelai" tabindex="<?php echo $tabIndex++; ?>" onFocus="document.frmAdmParam.rdRappel[1].checked='true';">
<?php
  if (!$rsProfil['util_rappel_delai']) {
    $rsProfil['util_rappel_delai'] = 5;
    $rsProfil['util_rappel_type'] = 1;
    $rsProfil['util_rappel_email'] = 0;
  }
  for ($i=1;$i<60;$i++) {
    $selected = ($rsProfil['util_rappel_delai']==$i) ? " selected" : "";
    echo "            <OPTION value=\"".$i."\"".$selected.">".$i."</OPTION>\n";
  }
?>
          </SELECT>
          <SELECT name="zlRappelType" tabindex="<?php echo $tabIndex++; ?>" onFocus="document.frmAdmParam.rdRappel[1].checked='true';">
            <OPTION value="1"<?php if ($rsProfil['util_rappel_type']==1) echo " selected"; ?>><?php echo trad("COMMUN_MINUTE"); ?></OPTION>
            <OPTION value="60"<?php if ($rsProfil['util_rappel_type']==60) echo " selected"; ?>><?php echo trad("COMMUN_HEURE"); ?></OPTION>
            <OPTION value="1440"<?php if ($rsProfil['util_rappel_type']==1440) echo " selected"; ?>><?php echo trad("COMMUN_JOUR"); ?></OPTION>
          </SELECT>&nbsp;<?php echo trad("COMMUN_AVANCE"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<LABEL for="AlEmail"><INPUT type="checkbox" name="ckRappelEmail" value="1" class="Case" id="AlEmail" tabindex="<?php echo $tabIndex++; ?>"<?php if ($rsProfil['util_rappel_email']==1) echo " checked"; ?>>&nbsp;<?php echo trad("PROFIL_COPIE_MAIL"); ?></LABEL></TD>
        </TR>
      </TABLE></TD>
    </TR>
<?php
  if ($rsProfil['util_rappel_anniv']) {
    $rdAnniv1 = "";
    $rdAnniv2 = " checked";
  }
  else {
    $rdAnniv1 = " checked";
    $rdAnniv2 = "";
  }
?>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas"><?php echo trad("PROFIL_LIB_RAPPEL_ANNIV"); ?></TD>
      <TD class="bordBas" style="padding:0px;"><TABLE cellspacing="0" cellpadding="0" width="100%" border="0">
        <TR>
          <TD height="20"><IMG src="image/trans.gif" alt="" width="2" height="1" border="0"><LABEL for="rdAnniv1"><INPUT type="radio" name="rdRappelAnniv" id="rdAnniv1" value="1" tabindex="<?php echo $tabIndex++; ?>" class="Case"<?php echo $rdAnniv1; ?>>&nbsp;<?php echo trad("PROFIL_PAS_RAPPEL"); ?></LABEL></TD>
        </TR>
        <TR>
          <TD height="20"><IMG src="image/trans.gif" alt="" width="2" height="1" border="0"><LABEL for="rdAnniv2"><INPUT type="radio" name="rdRappelAnniv" id="rdAnniv2" value="2" tabindex="<?php echo $tabIndex++; ?>" class="Case"<?php echo $rdAnniv2; ?>>&nbsp;<?php echo trad("COMMUN_LIB_RAPPEL"); ?></LABEL>&nbsp;<SELECT name="zlRappelAnniv" tabindex="<?php echo $tabIndex++; ?>" onFocus="document.frmAdmParam.rdRappelAnniv[1].checked='true';">
<?php
  if (!$rsProfil['util_rappel_anniv']) {
    $rsProfil['util_rappel_anniv'] = 1;
    $rsProfil['util_rappel_anniv_coeff'] = 1440;
    $rsProfil['util_rappel_anniv_email'] = 0;
  }
  for ($i=1;$i<60;$i++) {
    $selected = ($rsProfil['util_rappel_anniv']==$i) ? " selected" : "";
    echo "            <OPTION value=\"".$i."\"".$selected.">".$i."</OPTION>\n";
  }
?>
          </SELECT>
          <SELECT name="zlRappelAnnivCoeff" tabindex="<?php echo $tabIndex++; ?>" onFocus="document.frmAdmParam.rdRappelAnniv[1].checked='true';">
            <OPTION value="1"<?php if ($rsProfil['util_rappel_anniv_coeff']==1) echo " selected"; ?>><?php echo trad("COMMUN_MINUTE"); ?></OPTION>
            <OPTION value="60"<?php if ($rsProfil['util_rappel_anniv_coeff']==60) echo " selected"; ?>><?php echo trad("COMMUN_HEURE"); ?></OPTION>
            <OPTION value="1440"<?php if ($rsProfil['util_rappel_anniv_coeff']==1440) echo " selected"; ?>><?php echo trad("COMMUN_JOUR"); ?></OPTION>
          </SELECT>&nbsp;<?php echo trad("COMMUN_AVANCE"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<LABEL for="annivEmail"><INPUT type="checkbox" name="ckAnnivEmail" value="1" class="Case" id="annivEmail" tabindex="<?php echo $tabIndex++; ?>"<?php if ($rsProfil['util_rappel_anniv_email']==1) echo " checked"; ?>>&nbsp;<?php echo trad("PROFIL_COPIE_MAIL"); ?></LABEL></TD>
        </TR>
      </TABLE></TD>
    </TR>
<?php
  $champs = $DB_CX->DbQuery("SHOW FIELDS FROM ".$PREFIX_TABLE."droit");
  while ($champ = $DB_CX->DbNextRow()) {
    if ($champ[Field]=="droit_profils") $dr_PROFILS=$champ['Default'];
    if ($champ[Field]=="droit_agendas") $dr_AGENDAS=$champ['Default'];
    if ($champ[Field]=="droit_notes") $dr_NOTES=$champ['Default'];
    if ($champ[Field]=="droit_aff") $dr_Aff=$champ['Default'];
  }
  $dr_Aff_Login = substr($dr_Aff,0,1);
  $dr_Aff_MDP = substr($dr_Aff,1,1);
  $dr_Aff_THEME = substr($dr_Aff,2,1);
?>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad('PROFIL_LIB_DROITS_AFFICHAGE'); ?></TD>
      <TD class="bordBas"><LABEL for="IeMdp1"><INPUT type="checkbox" name="dr_Aff_Login" value="1" class="Case" id="IeMdp1" tabindex="<?php echo $tabIndex++; ?>"<?php if ($dr_Aff_Login=="1") echo " checked"; ?>>&nbsp;<?php echo trad('PROFIL_ADMIN_LOGIN'); ?></LABEL>&nbsp;&nbsp;
        <LABEL for="IeMdp2"><INPUT type="checkbox" name="dr_Aff_MDP" value="1" class="Case" id="IeMdp2" tabindex="<?php echo $tabIndex++; ?>"<?php if ($dr_Aff_MDP=="1") echo " checked"; ?>>&nbsp;<?php echo trad('PROFIL_ADMIN_PWD'); ?></LABEL>&nbsp;&nbsp;
        <LABEL for="IeMdp3"><INPUT type="checkbox" name="dr_Aff_THEME" value="1" class="Case" id="IeMdp3" tabindex="<?php echo $tabIndex++; ?>"<?php if ($dr_Aff_THEME=="1") echo " checked"; ?>>&nbsp;<?php echo trad('PROFIL_ADMIN_THEME'); ?></LABEL></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_DROITS_PROFILS"); ?></TD>
      <TD class="bordBas"><SELECT name="zlAMProfils" size="1" style="width: 330px;" tabindex="<?php echo $tabIndex++; ?>">
        <OPTION value="<?php echo _DROIT_PROFIL_RIEN; ?>"<?php if ($dr_PROFILS==_DROIT_PROFIL_RIEN) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_PROFILS_1'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_PROFIL_PARAM_BASE; ?>"<?php if ($dr_PROFILS==_DROIT_PROFIL_PARAM_BASE) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_PROFILS_2'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_PROFIL_PARAM_PARTAGE; ?>"<?php if ($dr_PROFILS==_DROIT_PROFIL_PARAM_PARTAGE) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_PROFILS_3'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_PROFIL_AUTRE_PARAM_BASE; ?>"<?php if ($dr_PROFILS==_DROIT_PROFIL_AUTRE_PARAM_BASE) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_PROFILS_4'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_PROFIL_AUTRE_PARAM_PARTAGE; ?>"<?php if ($dr_PROFILS>=_DROIT_PROFIL_AUTRE_PARAM_PARTAGE) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_PROFILS_5'); ?></OPTION>
      </SELECT></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_DROITS_AGENDAS"); ?></TD>
      <TD class="bordBas"><SELECT name="zlAMAgendas" size="1" style="width: 330px;" tabindex="<?php echo $tabIndex++; ?>">
        <OPTION value="<?php echo _DROIT_AGENDA_SEUL; ?>"<?php if ($dr_AGENDAS==_DROIT_AGENDA_SEUL) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_AGENDAS_1'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_AGENDA_PARTAGE; ?>"<?php if ($dr_AGENDAS==_DROIT_AGENDA_PARTAGE) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_AGENDAS_2'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_AGENDA_TOUS; ?>"<?php if ($dr_AGENDAS==_DROIT_AGENDA_TOUS) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_AGENDAS_3'); ?></OPTION>
      </SELECT></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD class="bordRBas" height="20"><?php echo trad("PROFIL_LIB_DROITS_NOTES"); ?></TD>
      <TD class="bordBas"><SELECT name="zlAMNotes" size="1" style="width: 330px;" tabindex="<?php echo $tabIndex++; ?>">
        <OPTION value="<?php echo _DROIT_NOTE_CONSULT_SEUL; ?>"<?php if ($dr_NOTES==_DROIT_NOTE_CONSULT_SEUL) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_NOTES_1'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_NOTE_CONSULT_RECHERCHE; ?>"<?php if ($dr_NOTES==_DROIT_NOTE_CONSULT_RECHERCHE) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_NOTES_2'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_NOTE_STANDARD_SANS_APPR; ?>"<?php if ($dr_NOTES==_DROIT_NOTE_STANDARD_SANS_APPR) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_NOTES_3'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_NOTE_STANDARD; ?>"<?php if ($dr_NOTES==_DROIT_NOTE_STANDARD) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_NOTES_4'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_NOTE_MODIF_STATUT; ?>"<?php if ($dr_NOTES==_DROIT_NOTE_MODIF_STATUT) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_NOTES_5'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_NOTE_MODIF_CREATION; ?>"<?php if ($dr_NOTES==_DROIT_NOTE_MODIF_CREATION) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_NOTES_6'); ?></OPTION>
        <OPTION value="<?php echo _DROIT_NOTE_COMPLET; ?>"<?php if ($dr_NOTES==_DROIT_NOTE_COMPLET) echo " selected"; ?>><?php echo trad('PROFIL_ADMIN_NOTES_7'); ?></OPTION>
      </SELECT></TD>
    </TR>
    <TR bgcolor="<?php echo $bgColor[++$iColor%2]; ?>">
      <TD colspan=2 align="center" valign="middle" height="30"><INPUT type="submit" class="Bouton" name="envoyer" value="<?php echo trad("ADMIN_BT_VALIDER"); ?>"></TD>
    </TR>
    </TABLE>
  </FORM>
<?php
}
//param 2
//Fin de la mise a jour
if ($param==2) {
  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/param.png\">".trad("ADMIN_PARAM"),"<B>".sprintf(trad("ADMIN_ETAPE"), 2)."</B> - ".trad("ADMIN_TITRE_FIN_MAJ"));

  $dr_Aff=($dr_Aff_Login+0).($dr_Aff_MDP+0).($dr_Aff_THEME+0);

  // Recuperation des Saisies
  if ($rdTelephone!="N")
    $rdTelephone = "O";
  $zlPlanning += 0;
  if ($zlPrecision!="2")
    $zlPrecision = "1";
  $SEMAINE_TYPE= "";
  for ($i=1; $i<8; $i++)
    $SEMAINE_TYPE .= ${"bt".$i} + 0;
  if ($rdRappel != 2) {
    $zlRappelDelai = 0;
    $zlRappelType  = 1;
    $ckRappelEmail = 0;
  } elseif ($ckRappelEmail != 1)
    $ckRappelEmail = 0;
  if ($zlFormatNom!="1")
    $zlFormatNom = "0";
  if ($zlMenuDispo!="9")
    $zlMenuDispo = "8";
  if ($rdBarree!="N")
    $rdBarree = "O";
  if ($rdOnClick!="N")
    $rdOnClick = "O";
  if ($rdRappelAnniv != 2) {
    $zlRappelAnniv = 0;
    $zlRappelAnnivCoeff = 1440;
    $ckAnnivEmail = 0;
  } elseif ($ckAnnivEmail != 1)
    $ckAnnivEmail = 0;
  if ($ckFuseauPartage!="O")
    $ckFuseauPartage = "N";
  if ($zlFCKE!="O")
    $zlFCKE = "N";

  $SEMAINE_TYPE= "";
  for ($i=1; $i<8; $i++)
    $SEMAINE_TYPE .= ${"bt".$i} + 0;

  $sql  = "ALTER TABLE ${PREFIX_TABLE}utilisateur";
  $sql .= " CHANGE util_interface util_interface varchar(32) NOT NULL DEFAULT '".$zlInterface."',";
  $sql .= " CHANGE util_debut_journee util_debut_journee float(10,2) NOT NULL DEFAULT '".$zlHeureDebut."',";
  $sql .= " CHANGE util_fin_journee util_fin_journee float(10,2) NOT NULL DEFAULT '".$zlHeureFin."',";
  $sql .= " CHANGE util_telephone_vf util_telephone_vf enum('O','N') NOT NULL DEFAULT '".$rdTelephone."',";
  $sql .= " CHANGE util_planning util_planning tinyint(3) unsigned DEFAULT '".$zlPlanning."',";
  $sql .= " CHANGE util_precision_planning util_precision_planning enum('1','2') NOT NULL DEFAULT '".$zlPrecision."',";
  $sql .= " CHANGE util_semaine_type util_semaine_type varchar(7) NOT NULL DEFAULT '".$SEMAINE_TYPE."',";
  $sql .= " CHANGE util_duree_note util_duree_note enum('1','2','3','4') NOT NULL DEFAULT '".$zlDureeNote."',";
  $sql .= " CHANGE util_rappel_delai util_rappel_delai tinyint(3) unsigned NOT NULL DEFAULT '".$zlRappelDelai."',";
  $sql .= " CHANGE util_rappel_type util_rappel_type smallint(5) unsigned NOT NULL DEFAULT '".$zlRappelType."',";
  $sql .= " CHANGE util_rappel_email util_rappel_email tinyint(3) unsigned NOT NULL DEFAULT '".$ckRappelEmail."',";
  $sql .= " CHANGE util_format_nom util_format_nom enum('0','1') NOT NULL DEFAULT '".$zlFormatNom."',";
  $sql .= " CHANGE util_menu_dispo util_menu_dispo enum('8','9') NOT NULL DEFAULT '".$zlMenuDispo."',";
  $sql .= " CHANGE util_note_barree util_note_barree enum('O','N') NOT NULL DEFAULT '".$rdBarree."',";
  $sql .= " CHANGE util_menuonclick util_menuonclick enum('O','N') NOT NULL DEFAULT '".$rdOnClick."',";
  $sql .= " CHANGE util_rappel_anniv util_rappel_anniv tinyint(3) unsigned NOT NULL DEFAULT '".$zlRappelAnniv."',";
  $sql .= " CHANGE util_rappel_anniv_coeff util_rappel_anniv_coeff smallint(4) unsigned NOT NULL DEFAULT '".$zlRappelAnnivCoeff."',";
  $sql .= " CHANGE util_rappel_anniv_email util_rappel_anniv_email tinyint(3) unsigned NOT NULL DEFAULT '".$ckAnnivEmail."',";
  $sql .= " CHANGE util_langue util_langue varchar(10) NOT NULL DEFAULT '".$zlLangue."',";
  $sql .= " CHANGE util_fcke util_fcke enum('O','N') NOT NULL DEFAULT '".$zlFCKE."',";
  $sql .= " CHANGE util_fcke_toolbar util_fcke_toolbar varchar(20) NOT NULL DEFAULT '".$zlFCKEbar."',";
  $sql .= " CHANGE util_timezone util_timezone varchar(40) NOT NULL DEFAULT '".$zlFuseauHoraire."',";
  $sql .= " CHANGE util_timezone_partage util_timezone_partage enum('O','N') NOT NULL DEFAULT '".$ckFuseauPartage."',";
  $sql .= " CHANGE util_format_heure util_format_heure enum('12','24') NOT NULL DEFAULT '".$zlFormatHeure."'";
  $DB_CX->DbQuery($sql);

  $sql  = "ALTER TABLE ${PREFIX_TABLE}droit";
  $sql .= " CHANGE droit_profils droit_profils SMALLINT( 5 ) NOT NULL DEFAULT '".$zlAMProfils."',";
  $sql .= " CHANGE droit_agendas droit_agendas SMALLINT( 5 ) NOT NULL DEFAULT '".$zlAMAgendas."',";
  $sql .= " CHANGE droit_notes droit_notes SMALLINT( 5 ) NOT NULL DEFAULT '".$zlAMNotes."',";
  $sql .= " CHANGE droit_aff droit_aff VARCHAR( 5 ) NOT NULL DEFAULT '".$dr_Aff."'";
  $DB_CX->DbQuery($sql);

  //Fin de la mise a jour des parametres
  echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_MAJCFG2_FIN")."<BR><BR>\n";
}
?>
