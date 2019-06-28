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

//delcpt 1
//Recuperation des comptes utilisateurs existants
if ($delcpt==1) {
  $zlUtil += 0;

  if ($zlUtil) {
    $DB_CX->DbQuery("SELECT CONCAT(".$FORMAT_NOM_UTIL.") FROM ${PREFIX_TABLE}utilisateur WHERE util_id=".$zlUtil." AND util_id!=".$idUser);
    if ($DB_CX->DbNumRows()) {
      AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/sup.png\">".trad("ADMIN_SUP_COMPTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), 2)."</B> - ".sprintf(trad("ADMIN_TITRE_DEL_CPT_UTIL") ,$DB_CX->DbResult(0,0)));
      echo "  <BR>\n";
      // Suppression du compte et de toutes les enregistrements non partages qui s'y rattachent
      $DB_CX->DbQuery("SELECT age_id FROM ${PREFIX_TABLE}agenda WHERE age_util_id=".$zlUtil);
      $liste="0";
      while ($enr = $DB_CX->DbNextRow()) {
        $liste.=",".$enr['age_id'];
      }
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}agenda WHERE age_id IN (".$liste.")");
      $totAge = $DB_CX->DbAffectedRows();
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}agenda_concerne WHERE aco_age_id IN (".$liste.") OR aco_util_id=".$zlUtil);
      $totAco = $DB_CX->DbAffectedRows();
      // Suppression des notes devenues "orphelines"
      $DB_CX->DbQuery("SELECT DISTINCT age_id FROM ${PREFIX_TABLE}agenda LEFT JOIN ${PREFIX_TABLE}agenda_concerne ON aco_age_id=age_id WHERE aco_age_id IS NULL");
      $liste="0";
      while ($enr = $DB_CX->DbNextRow()) {
        $liste.=",".$enr['age_id'];
      }
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}agenda WHERE age_id IN (".$liste.")");
      $totAge += $DB_CX->DbAffectedRows();
      if ($totAge>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$totAge.sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}agenda")."<BR>\n";
      if ($totAco>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$totAco.sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}agenda_concerne")."<BR>\n";
      // MAJ des notes dont le createur etait l'utilisateur supprime
      $DB_CX->DbQuery("UPDATE ${PREFIX_TABLE}agenda SET age_createur_id=age_util_id WHERE age_createur_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_MAJ_TBL"), "${PREFIX_TABLE}agenda")."<BR>\n";
      // MAJ des notes dont le modificateur etait l'utilisateur supprime
      $DB_CX->DbQuery("UPDATE ${PREFIX_TABLE}agenda SET age_modificateur_id=age_createur_id WHERE age_modificateur_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_MAJ_TBL"), "${PREFIX_TABLE}agenda")."<BR>\n";
      // On ne supprime que les contacts non partages par l'utilisateur
      $DB_CX->DbQuery("SELECT cal_id FROM ${PREFIX_TABLE}calepin WHERE cal_util_id=".$zlUtil." AND cal_partage='N'");
      $liste="0";
      while ($enr = $DB_CX->DbNextRow()) {
        $liste.=",".$enr['cal_id'];
      }
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}calepin WHERE cal_id IN (".$liste.")");
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}calepin")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}calepin_appartient WHERE cap_cal_id IN (".$liste.")");
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}calepin_appartient")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}calepin_groupe WHERE cgr_util_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}calepin_groupe")."<BR>\n";
      // On ne supprime que les evenements non partages par l'utilisateur
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}evenement WHERE eve_util_id=".$zlUtil." AND eve_partage='N'");
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}evenement")."<BR>\n";
      // On ne supprime que les favoris non partages par l'utilisateur
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}favoris WHERE fav_util_id=".$zlUtil." AND fav_partage='N'");
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}favoris")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}favoris_groupe WHERE fgr_util_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}favoris_groupe")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}information WHERE info_emetteur_id=".$zlUtil." OR info_destinataire_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}information")."<BR>\n";
      // On ne supprime que les libelles non partages par l'utilisateur
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}libelle WHERE lib_util_id=".$zlUtil." AND lib_partage='N'");
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}libelle")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}memo WHERE mem_util_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}memo")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}planning_affecte WHERE paf_util_id=".$zlUtil." OR paf_consultant_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}planning_affecte")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}planning_partage WHERE ppl_util_id=".$zlUtil." OR ppl_consultant_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}planning_partage")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}global_groupe WHERE ggr_util_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}global_groupe")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}droit WHERE droit_util_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL1"), "${PREFIX_TABLE}droit")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}agenda_export WHERE aex_util_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL1"), "${PREFIX_TABLE}agenda_export")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}planning_affichage WHERE aff_util_id=".$zlUtil." OR aff_consultant_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}planning_affichage")."<BR>\n";
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}sid WHERE sid_util_id=".$zlUtil);
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}utilisateur WHERE util_id=".$zlUtil);
      if ($DB_CX->DbAffectedRows()>0)
        echo "  &nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL1"), "${PREFIX_TABLE}utilisateur")."<BR>\n";
    } else {
      AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/sup.png\">".trad("ADMIN_SUP_COMPTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), 1)." - <BR>".trad("ADMIN_SELECT_UTIL"));
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".trad("ADMIN_IMP_DEL_CPT")."</FONT><BR>\n";
    }
  } else {
    AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/sup.png\">".trad("ADMIN_SUP_COMPTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), 1)."</B> - ".trad("ADMIN_SELECT_UTIL"));
  }

  //Recuperation de la liste des utilisateurs sauf le compte utilisateur actuellement connecte
  $DB_CX->DbQuery("SELECT util_id, CONCAT(".$FORMAT_NOM_UTIL.") AS nomUtil FROM ${PREFIX_TABLE}utilisateur WHERE util_id!=".$idUser." ORDER BY nomUtil");
  echo ("  <BR><TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2 width=\"400\" bgcolor=\"red\">
    <TR><TD><FONT color=\"white\"><B>".trad("ADMIN_RQ_SAUVE_BASE")."</B></FONT></TD></TR>
  </TABLE><BR>
  <FORM method=\"post\" action=\"${NOM_PAGE}&delcpt=1\" name=\"frmUtilSupp\" id=\"frmUtilSupp\">
    <TABLE width=\"100%\" border=0 cellspacing=0 cellpadding=0>
      <TR><TD align=\"center\" height=\"20\">".trad("ADMIN_DEL_CPT_UTIL")."&nbsp;&nbsp;<SELECT name=\"zlUtil\" size=1>
        <OPTION value=\"0\">".trad("ADMIN_SUP_CPT_SELECT")."</OPTION>\n");
  while ($enr = $DB_CX->DbNextRow()) {
    echo "        <OPTION value=\"".$enr['util_id']."\">".$enr['nomUtil']."</OPTION>\n";
  }
  echo ("      </SELECT></TD></TR>
      <TR><TD align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_SUPPRIMER")."\" onclick=\"javascript: if (document.frmUtilSupp.zlUtil.value!='0' && confirm('".trad("ADMIN_CONF_SUP_CPT")."')) document.frmUtilSupp.submit();\"></TD></TR>
    </TABLE>
  </FORM>
  <SCRIPT language=\"JavaScript\"><!-- document.frmUtilSupp.zlUtil.focus(); --></SCRIPT>");
}
?>
