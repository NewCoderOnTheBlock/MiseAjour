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

//deladm 1
//Recuperation des comptes administrateur existants
if ($deladm==1) {
  $zlAdmin += 0;

  if ($zlAdmin) {
    $DB_CX->DbQuery("SELECT admin_login FROM ${PREFIX_TABLE}admin WHERE admin_id=".$zlAdmin);
    if ($DB_CX->DbNumRows()) {
      AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/sup.png\">".trad("ADMIN_SUP_COMPTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), 2)."</B> - ".sprintf(trad("ADMIN_TITRE_DEL_CPT_ADM"), $DB_CX->DbResult(0,0)));
      // Suppression du compte
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}admin WHERE admin_id =".$zlAdmin);
      if ($DB_CX->DbAffectedRows())
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL1"), "${PREFIX_TABLE}admin")."<BR>\n";
    } else {
      AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/sup.png\">".trad("ADMIN_SUP_COMPTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), 1)."</B> - ".trad("ADMIN_SELECT_ADMIN"));
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".trad("ADMIN_IMP_DEL_CPT")."</FONT><BR>\n";
    }
  } else {
    AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/sup.png\">".trad("ADMIN_SUP_COMPTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), 1)."</B> - ".trad("ADMIN_SELECT_ADMIN"));
  }

  //Recuperation de la liste des administrateurs sauf celui actuellement connecte
  $DB_CX->DbQuery("SELECT admin_id, admin_login FROM ${PREFIX_TABLE}admin WHERE admin_id!=".$idAdmin." ORDER BY admin_login");
  echo ("  <BR><TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2 width=\"400\" bgcolor=\"red\">
    <TR><TD><FONT color=\"white\"><B>".trad("ADMIN_RQ_SAUVE_BASE")."</B></FONT></TD></TR>
  </TABLE><BR>
  <FORM method=\"post\" action=\"${NOM_PAGE}&deladm=1\" name=\"frmAdmSupp\" id=\"frmAdmSupp\">
    <TABLE width=\"100%\" border=0 cellspacing=0 cellpadding=0>
      <TR><TD align=\"center\" height=\"20\">".trad("ADMIN_DEL_CPT_ADM")."&nbsp;&nbsp;<SELECT name=\"zlAdmin\" size=1>
        <OPTION value=\"0\">".trad("ADMIN_SUP_CPT_SELECT")."</OPTION>\n");
  while ($enr = $DB_CX->DbNextRow()) {
    echo "        <OPTION value=\"".$enr['admin_id']."\">".$enr['admin_login']."</OPTION>\n";
  }
  echo ("      </SELECT></TD></TR>
      <TR><TD align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_SUPPRIMER")."\" onclick=\"javascript: if (document.frmAdmSupp.zlAdmin.value!='0' && confirm('".trad("ADMIN_CONF_SUP_CPT")."')) document.frmAdmSupp.submit();\"></TD></TR>
    </TABLE>
  </FORM>
  <SCRIPT language=\"JavaScript\"><!-- document.frmAdmSupp.zlAdmin.focus(); --></SCRIPT>");
}
?>
