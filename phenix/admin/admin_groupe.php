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
<?php if ($groupe == 1) { ?>
  <SCRIPT language="JavaScript" type="text/javascript">

    function genereListe(_liste, _tabTexte, _tabValue, _tailleTab) {
      for (var i=0; i<_tailleTab; i++)
        _liste.options[i]=new Option(_tabTexte[i], _tabValue[i]);
    }

    function bubbleSort(_tabText, _tabValue,_tailleTab) {
      var i,s;

      do {
        s=0;
        for (i=1; i<_tailleTab; i++)
          if (_tabText[i-1] > _tabText[i]) {
            y = _tabText[i-1];
            _tabText[i-1] = _tabText[i];
            _tabText[i] = y;
            y = _tabValue[i-1];
            _tabValue[i-1] = _tabValue[i];
            _tabValue[i] = y;
            s = 1;
          }
      } while (s);
    }

    function videListe(_liste) {
      var cpt = _liste.options.length;

      for(var i=0; i<cpt; i++) {
        _liste.options[0] = null;
      }
    }

    function selectUtil(_listeSource, _listeDest) {
      var i,j;
      var ok = false;
      var tabDestTexte = new Array();
      var tabDestValue = new Array();
      var tailleTabDest = 0;

      for (i=0; i<_listeDest.options.length; i++) {
        tabDestTexte[tailleTabDest]   = _listeDest.options[i].text;
        tabDestValue[tailleTabDest++] = _listeDest.options[i].value;
      }

      for (j=_listeSource.options.length-1; j>=0; j--) {
        if (_listeSource.options[j].selected) {
          ok = true;
          tabDestTexte[tailleTabDest]   = _listeSource.options[j].text;
          tabDestValue[tailleTabDest++] = _listeSource.options[j].value;
          _listeSource.options[j] = null;
        }
      }

      if (ok) {
        //Trie du tableau
        bubbleSort(tabDestTexte, tabDestValue, tailleTabDest);
        //Vide la liste destination
        videListe(_listeDest);
        //Recree la liste
        genereListe(_listeDest, tabDestTexte, tabDestValue, tailleTabDest);
      }
    }

    //Fonction pour selectionner tous les utilisateurs d'une liste source et les transferer dans une liste destination
    function selectAll(_listeSource, _listeDest) {
      for (var i=0; i<_listeSource.options.length; i++) {
        _listeSource.options[i].selected = true;
      }
      selectUtil(_listeSource, _listeDest);
    }

    function recupSelection(_liste, _champ) {
      _champ.value = "";
      for (var i=0; i<_liste.options.length; i++) {
        _champ.value += ((i) ? "," : "") + _liste.options[i].value;
      }
    }
    var grpWin;
    function AjoutGrp(theForm) {
      var _width = 320, _height = 120;
      var posX = (Math.max(screen.width,_width)-_width)/2;
      var posY = (Math.max(screen.height,_height)-_height)/2;
      var _position = (navigator.appVersion.match('MSIE')) ? ',top=' + posY + ',left=' + posX : ',screenY=' + posY + ',screenX=' + posX;
      recupSelection(theForm.zlConsulte, theForm.sChoix);
      theForm.target = "AjoutGrp_<?php echo $sid; ?>";
      theForm.action = "agenda_groupe_global.php?sid=<?php echo $sid; ?>&tcMenu=<?php echo $tcMenu; ?>&tcPlg=<?php echo $tcPlg; ?>&sd=<?php echo $sd; ?>&utilgr=O";
      grpWin = window.open('','AjoutGrp_<?php echo $sid; ?>','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=1,width=' + _width + ',height=' + _height + _position);
      theForm.submit();
    }


    function SauvGrp(theForm) {
      theForm.ztActionGrp.value="SauvGrp";
      theForm.action="agenda_traitement.php?sid=<?php echo $sid; ?>&tcMenu=<?php echo $tcMenu; ?>&tcPlg=<?php echo $tcPlg; ?>&sd=<?php echo $sd; ?>&utilgr=O";
      recupSelection(theForm.zlConsulte, theForm.sChoix);
      theForm.submit();
      return (true);
    }

    function SupGrp(theForm) {
      theForm.ztActionGrp.value="SupGrp";
      theForm.action="agenda_traitement.php?sid=<?php echo $sid; ?>&tcMenu=<?php echo $tcMenu; ?>&tcPlg=<?php echo $tcPlg; ?>&sd=<?php echo $sd; ?>&utilgr=O";
      theForm.submit();
      return (true);
    }

    function changeGgr(theForm) {
      if (theForm.ggr.value == "0|0") {
        theForm.btAjoutGgr.value = "<?php echo trad("ADMIN_ADD"); ?>";
        theForm.btSupprGgr.disabled = true;
        selectAll(theForm.zlConsulte, theForm.zlUtilisateur);
        return (false);
      } else {
        theForm.ztActionGrp.value="NvGr";
        theForm.submit();
        return (true);
      }
    }

     function saisieOK(theForm) {
      recupSelection(theForm.zlConsulte, theForm.sChoix);
      if (trim(theForm.sChoix.value) == "") {
        window.alert("<?php echo trad("PLGL_SELECT_PERSONNE"); ?>");
        theForm.zlUtilisateur.focus();
        return (false);
      }

      theForm.ztActionGrp.value="NvAff";
      theForm.submit();
      return (true);
    }
  //-->
  </SCRIPT>
<?php } ?>
<?php
//Gestion des groupes d'utilisateur
if ($groupe) {
  $labelBouton = trad("ADMIN_ADD");
  $actionCreer = true;
  if (($ztActionGrp=="NvGr") && ($ggr!="0|0")) {
    list($grpg, $sChoix) = explode('|', $ggr);
    $labelBouton = trad("ADMIN_MOD");
    $tChoix= explode (',', $sChoix);
    $LstUser= array();
    $DB_CX->DbQuery("SELECT util_id, CONCAT(".$FORMAT_NOM_UTIL.") AS nomUtil FROM ${PREFIX_TABLE}utilisateur LEFT JOIN ${PREFIX_TABLE}planning_affecte ON paf_util_id=util_id LEFT JOIN ${PREFIX_TABLE}planning_partage ON ppl_util_id=util_id WHERE (LENGTH(CONCAT(util_nom, util_prenom)) > 0)");
     while ($enr=$DB_CX->DbNextRow())
      $LstUser[]=$enr['util_id'];
    $result = array_intersect ($LstUser, $tChoix);
    $sChoix = implode(",", $result);
    $actionCreer = false;
  }

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/group.png\">".trad("ADMIN_GROUPE"),trad("ADMIN_GROUPE_CHOIX"),"575");

  echo ("  <FORM action=\"${NOM_PAGE}&groupe=1\" method=\"post\" name=\"frmChoixGrp\" name=\"frmChoixGrp\">
    <TABLE align=\"center\" cellspacing=\"0\" width=\"575\" cellpadding=\"0\" border=\"0\">
    <TR bgcolor=\"".$bgColor[1]."\">
      <TD class=\"bordRBas\">".trad("ADMIN_LISTE_PERSONNES")."</TD>
      <TD class=\"bordBas\" colspan=\"2\" width=\"436\"><TABLE cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" align=\"center\">
        <TR>
          <TH>".trad("PLGL_PERSONNES_POSSIBLES")."</TH>
          <TH>&nbsp;</TH>
          <TH>".trad("PLGL_PERSONNES_SELECTION")."</TH>
        </TR>
        <TR>
          <TD><SELECT name=\"zlUtilisateur\" id=\"zlUtilisateur\" size=\"8\" multiple style=\"width:200px;\">\n");

  // Liste des personnes selectionnees
  $aChoix = explode(",", $sChoix);
  // Liste des utilisateurs
  $DB_CX->DbQuery("SELECT DISTINCT util_id, CONCAT(".$FORMAT_NOM_UTIL.") AS nomUtil FROM ${PREFIX_TABLE}utilisateur WHERE (LENGTH(CONCAT(util_nom, util_prenom)) > 0) ORDER BY nomUtil");

  while ($enr=$DB_CX->DbNextRow()) {
    $selected = "";
    //Recherche si l'utilisateur a ete selectionne
    for ($i=0; $i<count($aChoix) && empty($selected); $i++) {
      $selected = ($aChoix[$i] == $enr['util_id']) ? " selected" : "";
    }
    echo "            <OPTION value=\"".$enr['util_id']."\"".$selected.">".htmlspecialchars($enr['nomUtil'])."</OPTION>\n";
  }
  echo ("          </SELECT></TD>
          <TD align=\"center\" valign=\"middle\"><TABLE border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
            <TR>
              <TD>&nbsp;<INPUT type=\"button\" class=\"PickList\" name=\"btSelect\" id=\"btSelect\" value=\"&#155;\" title=\"".trad("PLGL_AJOUT_SELECTION")."\" onClick=\"javascript: selectUtil(document.frmChoixGrp.zlUtilisateur, document.frmChoixGrp.zlConsulte);\">&nbsp;</TD>
            </TR>
            <TR>
              <TD height=\"7\"></TD>
            </TR>
            <TR>
              <TD>&nbsp;<INPUT type=\"button\" class=\"PickList\" name=\"btSelect\" id=\"btSelect\" value=\"&#187;\" title=\"".trad("PLGL_AJOUT_TOUS")."\" onclick=\"javascript: selectAll(document.frmChoixGrp.zlUtilisateur, document.frmChoixGrp.zlConsulte);\">&nbsp;</TD>
            </TR>
            <TR>
              <TD height=\"7\"></TD>
            </TR>
            <TR>
              <TD nowrap>&nbsp;<INPUT type=\"button\" class=\"PickList\" name=\"btDeselect\" id=\"btDeselect\" value=\"&#139;\" title=\"".trad("PLGL_ENLEVE_SELECTION")."\" onclick=\"javascript: selectUtil(document.frmChoixGrp.zlConsulte, document.frmChoixGrp.zlUtilisateur);\">&nbsp;</TD>
            </TR>
            <TR>
              <TD height=\"7\"></TD>
            </TR>
            <TR>
              <TD nowrap>&nbsp;<INPUT type=\"button\" class=\"PickList\" name=\"btDeselect\" id=\"btDeselect\" value=\"&#171;\" title=\"".trad("PLGL_ENLEVE_TOUS")."\" onclick=\"javascript: selectAll(document.frmChoixGrp.zlConsulte, document.frmChoixGrp.zlUtilisateur);\">&nbsp;</TD>
            </TR>
          </TABLE></TD>
          <TD><SELECT name=\"zlConsulte\" id=\"zlConsulte\" size=\"8\" multiple style=\"width:200px\"></SELECT></TD>
        </TR>
      </TABLE></TD>
    </TR>
    <TR bgcolor=\"".$bgColor[0]."\" height=\"23\" valign=\"middle\">
      <TD class=\"bordRBas\">".trad("PLGL_CHOIX_GR")."</TD>
      <TD class=\"bordBas\" colspan=\"2\"><SELECT name=\"ggr\" size=\"1\" onChange=\"javascript: changeGgr(document.frmChoixGrp);\">
        <OPTION value=\"0|0\">(".trad("PLGL_NO_GR").")</OPTION>\n");
      $DB_CX->DbQuery("SELECT gr_util_id, gr_util_nom, gr_util_liste FROM ${PREFIX_TABLE}groupe_util");
      while ($rsUtil = $DB_CX->DbNextRow()) {
        $selected = ($grpg == $rsUtil[0]) ? " selected" : "";
        echo "        <OPTION value=\"".$rsUtil[0]."|".$rsUtil[2]."\"".$selected.">".$rsUtil[1]."</OPTION>\n";
      }
      echo ("      </SELECT>&nbsp;&nbsp;&nbsp;
        <INPUT type=\"button\" class=\"bouton\" name=\"btAjoutGgr\" value=\"".$labelBouton."\" onclick=\"javascript: AjoutGrp(document.frmChoixGrp);\">&nbsp;&nbsp;&nbsp;
        <INPUT type=\"button\" class=\"bouton\" name=\"btSupprGgr\" value=\"".trad("ADMIN_SUP")."\" onclick=\"javascript: if (confirm('".trad("ADMIN_GR_SUP")."')) SupGrp(document.frmChoixGrp);\"".(($actionCreer) ? " disabled" : "")."></TD>
    </TR>
    <TR bgcolor=\"".$bgColor[1]."\">
      <TD colspan=\"3\" align=\"center\" valign=\"middle\" height=\"30\">
        <INPUT type=\"button\" class=\"bouton\" name=\"btModifGgr\" value=\"".trad("ADMIN_ENR")."\"  onclick=\"javascript: SauvGrp(document.frmChoixGrp);\">
      </TD>
  </TR>
  </TABLE>
  <INPUT type=\"hidden\" name=\"sChoix\" value=\"\">
  <INPUT type=\"hidden\" name=\"ztActionGrp\" value=\"\">
  </FORM>\n");
}
?>
