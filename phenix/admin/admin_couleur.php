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

// modcoul 1,2,3 = modification des couleurs des notes
if ($modcoul) {
  if ($modcoul==1) {
    function affCouleur() {
      $tbCouleur = array('#00FF00','#00FF33','#00FF66','#00FF99','#00FFCC','#00FFFF','#33FF00','#33FF33','#33FF66','#33FF99','#33FFCC','#33FFFF','#66FF00','#66FF33','#66FF66','#66FF99','#66FFCC','#66FFFF','#99FF00','#99FF33','#99FF66','#99FF99','#99FFCC','#99FFFF','#CCFF00','#CCFF33','#CCFF66','#CCFF99','#CCFFCC','#CCFFFF','#FFFF00','#FFFF33','#FFFF66','#FFFF99','#FFFFCC','#FFFFFF','#00CC00','#00CC33','#00CC66','#00CC99','#00CCCC','#00CCFF','#33CC00','#33CC33','#33CC66','#33CC99','#33CCCC','#33CCFF','#66CC00','#66CC33','#66CC66','#66CC99','#66CCCC','#66CCFF','#99CC00','#99CC33','#99CC66','#99CC99','#99CCCC','#99CCFF','#CCCC00','#CCCC33','#CCCC66','#CCCC99','#CCCCCC','#CCCCFF','#FFCC00','#FFCC33','#FFCC66','#FFCC99','#FFCCCC','#FFCCFF','#009900','#009933','#009966','#009999','#0099CC','#0099FF','#339900','#339933','#339966','#339999','#3399CC','#3399FF','#669900','#669933','#669966','#669999','#6699CC','#6699FF','#999900','#999933','#999966','#999999','#9999CC','#9999FF','#CC9900','#CC9933','#CC9966','#CC9999','#CC99CC','#CC99FF','#FF9900','#FF9933','#FF9966','#FF9999','#FF99CC','#FF99FF','#006600','#006633','#006666','#006699','#0066CC','#0066FF','#336600','#336633','#336666','#336699','#3366CC','#3366FF','#666600','#666633','#666666','#666699','#6666CC','#6666FF','#996600','#996633','#996666','#996699','#9966CC','#9966FF','#CC6600','#CC6633','#CC6666','#CC6699','#CC66CC','#CC66FF','#FF6600','#FF6633','#FF6666','#FF6699','#FF66CC','#FF66FF','#003300','#003333','#003366','#003399','#0033CC','#0033FF','#333300','#333333','#333366','#333399','#3333CC','#3333FF','#663300','#663333','#663366','#663399','#6633CC','#6633FF','#993300','#993333','#993366','#993399','#9933CC','#9933FF','#CC3300','#CC3333','#CC3366','#CC3399','#CC33CC','#CC33FF','#FF3300','#FF3333','#FF3366','#FF3399','#FF33CC','#FF33FF','#000000','#000033','#000066','#000099','#0000CC','#0000FF','#330000','#330033','#330066','#330099','#3300CC','#3300FF','#660000','#660033','#660066','#660099','#6600CC','#6600FF','#990000','#990033','#990066','#990099','#9900CC','#9900FF','#CC0000','#CC0033','#CC0066','#CC0099','#CC00CC','#CC00FF','#FF0000','#FF0033','#FF0066','#FF0099','#FF00CC','#FF00FF');
      $nbLigne = 0;
      $strOut = "";
      $intTdDisp = $intTblDisp = 0;
      for ($i=0;$i<count($tbCouleur);$i++) {
         if ($intTblDisp%12==0 && $intTdDisp!=0) {
          $strOut .= "            </TR>\n            <TR>\n";
          $intTdDisp = 0;
          $nbLigne++;
        }
        $strColor = $tbCouleur[$i];
        if ($nbLigne>0 && ($intTblDisp%12 != 0))
          $classCel = " class=\"bordTL\"";
        elseif ($nbLigne>0)
          $classCel = " class=\"bordT\"";
        elseif ($intTblDisp%12 != 0)
          $classCel = " class=\"bordL\"";
        else
          $classCel = "";
        $strOut .= "              <TD style=\"text-decoration:none; width:8px; height:9px; margin:0px; padding:0px; background-color:".$strColor."; cursor:pointer;\" onClick=\"javascript:fctSetColor('".$strColor."');\" onMouseOver=\"javascript:fctOver('".$strColor."');\" onMouseOut=\"javascript:fctOut();\"$classCel></TD>\n";
         $intTdDisp++;
         $intTblDisp++;
      }
      echo $strOut;
    }
?>
  <SCRIPT language="JavaScript" type="text/javascript">
  <!--
    var objCurrent = objCurrent1 = null;
    var strColor = '', strCurrent = '';
    var CurrentColor, CurrentTextColor;

    fctOver = function(strColor) {
      document.getElementById('objPreview').innerHTML = strColor;
      document.getElementById('objPreview').style.backgroundColor = strColor;
    }

    fctOut = function() {
      document.getElementById('objPreview').innerHTML = CurrentTextColor;
      document.getElementById('objPreview').style.backgroundColor = CurrentColor;
    }

    fctSetColor = function(strColor) {
      objCurrent.value = strColor;
      objCurrent1.style.backgroundColor = strColor;
      objCurrent.style.backgroundColor = strColor;
      fctHide();
    }

    fctHide = function() {
      document.getElementById('tblGlobal').style.display = 'none';
      objCurrent = null;
    }

    fctReset = function() {
      objCurrent.style.backgroundColor = CurrentColor;
      if (CurrentTextColor != '&nbsp;') {
        objCurrent.value = CurrentTextColor;
      }
      strCurrent = '';
    }

    fctCancel = function() {
      fctReset();
      fctHide();
    }

    fctRAZ = function(objForm,objForm1,objForm2) {
      objForm.style.backgroundColor = "";
      objForm.value = "";
      objForm1.style.backgroundColor = "";
      objForm1.value = "";
      objForm2.value = "0";
    }

    fctShow = function(objForm,objForm1) {
      if (objForm) {
        objCurrent = objForm;
        objCurrent1 = objForm1;
        CurrentColor = objCurrent.style.backgroundColor;
        CurrentTextColor = objForm.value;
        if (objForm.value + '' != '') {
          strColor = objForm.value.replace('#', '');
          fctOut();
        } else {
          CurrentTextColor='&nbsp;';
          fctReset();
        }
        fctReset();
        strCurrent = strColor;
      }
      if (objCurrent) {
        if (document.getElementById('tblGlobal').style.display != 'block') {
          document.getElementById('tblGlobal').style.display = 'block';
        }
      }
    }

    function fctAnnul(theForm) {
      theForm.action= "<?php echo ${NOM_PAGE}; ?>&modcoul=1";
      theForm.submit();
      return (true);
    }

    function fctDefaut(theForm) {
      theForm.action= "<?php echo ${NOM_PAGE}; ?>&modcoul=3";
      theForm.submit();
      return (true);
    }
  //-->
  </SCRIPT>
<?php
  }

// etape 1
// Recuperation des couleurs et des libelles associes
  if ($modcoul==1) {

    AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/coul.png\">".trad("ADMIN_MAJ_COUL"),"<B>".sprintf(trad("ADMIN_ETAPE"), 1)."</B> - ".trad("ADMIN_TITRE_COULEUR"));

    $iColor="0";
    echo ("  <FORM method=\"post\" action=\"${NOM_PAGE}&modcoul=2\" name=\"formAdmCouleur\" id=\"formAdmCouleur\">
    <TABLE width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=0 style=\"text-align:left;\">
    <TR><TD><TABLE width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=0 style=\"text-align:center;\">
      <TR bgcolor=\"".$bgColor[$iColor%2]."\">\n");

    $DB_CX->DbQuery("SELECT * FROM ${PREFIX_TABLE}couleurs WHERE cou_util_id=0 OR cou_util_id=".$USER_SUBSTITUE." ORDER BY cou_libelle");
    $nbCouleurs = $DB_CX->DbNumRows();
    if ($nbCouleurs<14 && $nbCouleurs>0) {
      $HtblPal= 350/($nbCouleurs+$nbCouleurs%2);
    } else {
      $HtblPal=26;
    }
    $NCoul=0;
    while($enr=$DB_CX->DbNextRow()) {
      $NCoul++;
      $classCel = ($NCoul>2) ? "bordTR" : "bordR";
      echo "        <TD class=\"".$classCel."\" height=\"".$HtblPal."\" valign=\"middle\">&nbsp;<INPUT type=\"hidden\" name=\"id_color".$NCoul."\" value=\"".$enr['cou_id']."\"><INPUT type=\"text\" class=\"texte\" name=\"nom_color".$NCoul."\" value=\"".$enr['cou_libelle']."\" size=\"28\" maxlength=\"100\" style=\"background-color:".$enr['cou_couleur'].";\">&nbsp;<INPUT type=\"text\" class=\"texte\" name=\"f_color".$NCoul."\" value=\"".$enr['cou_couleur']."\" size=\"10\" maxlength=\"20\" style=\"background-color:".$enr['cou_couleur'].";\">&nbsp;<INPUT type=\"button\" class=\"bouton\" name=\"btVisuPl".$NCoul."\" value=\"".trad("ADMIN_BP_MOD")."\" title=\"".trad("ADMIN_MOD_COUL")."\" style=\"width:16px\" onclick='fctShow(document.formAdmCouleur.f_color".$NCoul.",document.formAdmCouleur.nom_color".$NCoul.");'>&nbsp;<INPUT type=\"button\" class=\"bouton\" name=\"btCupCl".$NCoul."\" value=\"".trad("ADMIN_BP_SUP")."\" title=\"".trad("ADMIN_SUP_COUL")."\" style=\"width:16px\" onclick='fctRAZ(document.formAdmCouleur.f_color".$NCoul.",document.formAdmCouleur.nom_color".$NCoul.",document.formAdmCouleur.id_color".$NCoul.");'></TD>\n";
      if ($NCoul%2 == 0)
        echo "      </TR>\n      <TR bgcolor=\"".$bgColor[++$iColor%2]."\">\n";
    }

    for ($i=$NCoul%2;$i<2;$i++) {
      $NCoul++;
      $classCel = ($NCoul>2) ? "bordTR" : "bordR";
      echo "        <TD class=\"".$classCel."\" height=\"".$HtblPal."\" valign=\"middle\">&nbsp;<INPUT type=\"hidden\" name=\"id_color".$NCoul."\" value=\"0\"><INPUT type=\"text\" class=\"texte\" name=\"nom_color".$NCoul."\" value=\"\" size=\"28\" maxlength=\"100\">&nbsp;<INPUT type=\"text\" class=\"texte\" name=\"f_color".$NCoul."\" value=\"\" size=\"10\" maxlength=\"20\">&nbsp;<INPUT type=\"button\" class=\"bouton\" name=\"btVisuPl".$NCoul."\" value=\"".trad("ADMIN_BP_MOD")."\" title=\"".trad("ADMIN_MOD")."\" style=\"width:16px\" onclick='fctShow(document.formAdmCouleur.f_color".$NCoul.",document.formAdmCouleur.nom_color".$NCoul.");'>&nbsp;<INPUT type=\"button\" class=\"bouton\" name=\"btCupCl".$NCoul."\" value=\"".trad("ADMIN_BP_SUP")."\" title=\"".trad("ADMIN_SUP")."\" style=\"width:16px\" onclick='fctRAZ(document.formAdmCouleur.f_color".$NCoul.",document.formAdmCouleur.nom_color".$NCoul.",document.formAdmCouleur.id_color".$NCoul.");'></TD>\n";
    }
    echo ("      </TR>
      </TABLE><INPUT type=\"hidden\" name=\"NCoul\" value=\"".$NCoul."\"></TD>
      <TD bgcolor=\"".$bgColor[1]."\" width=\"107\" valign=\"top\">
        <TABLE id=\"tblGlobal\" border=\"0\" style=\"display:none;\" cellpadding=\"0\" cellspacing=\"0\">
        <TR>
          <TD><TABLE id=\"tblName\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
            <TR>\n");
    affCouleur();
    echo ("            </TR>
          </TABLE></TD>
        </TR>
        <TR>
          <TD><TABLE border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
            <TR><TD class=\"bordT\" style=\"width:100%; height:18px; line-height:18px; font-family:Tahoma;font-size:8pt;color:black;text-align:center;\" id=\"objPreview\" >&nbsp;</TD></TR>
            <TR><TD class=\"bordT\" style=\"width:100%; height:25px; line-height:25px; font-family:Tahoma;font-size:8pt;color:black;text-align:center;\"><INPUT type=\"button\" class=\"Bouton\" name=\"btAnnul\" value=\"".trad("ADMIN_BP_ANNUL")."\" onclick=\"javascript: return fctCancel();\"></TD></TR>
          </TABLE></TD>
        </TR>
      </TABLE></TD>
    </TR>
    <TR bgcolor=\"".$bgColor[++$iColor%2]."\">
      <TD class=\"bordT\" colspan=3 align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"submit\" class=\"Bouton\" name=\"btEnvoyer\" value=\"".trad("ADMIN_BT_VALIDER")."\">&nbsp;&nbsp;&nbsp;<INPUT type=\"button\" class=\"Bouton\" name=\"btAnnuler\" value=\"".trad("ADMIN_BP_ANNUL")."\" onclick=\"javascript: return fctAnnul(document.formAdmCouleur);\">&nbsp;&nbsp;&nbsp;<INPUT type=\"button\" class=\"Bouton\" name=\"btDefaut\" value=\"".trad("ADMIN_BP_DEFAUT")."\" onclick=\"javascript: if (confirm('".trad("ADMIN_RESET_COUL")."')) return fctDefaut(document.formAdmCouleur);\"></TD>
    </TR>
    </TABLE>\n");
  }

// etape 2
// Enregistrement en base des couleurs personnalisees
  if ($modcoul==2) {
    AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/coul.png\">".trad("ADMIN_MAJ_COUL"),"<B>".sprintf(trad("ADMIN_ETAPE"), 2)."</B> - ".trad("ADMIN_TITRE1_COULEUR"));

    $listeIdCoul = "0";
    $nbUpdate = $nbInsert = $nbDelete = 0;
    for ($tt=1;$tt<=$NCoul;$tt++) {
      $fa = "f_color".$tt;
      $fb = "nom_color".$tt;
      $fc = "id_color".$tt;
      $$fc += 0;
      if ($$fa!="") {
        if ($$fb=="") $$fb="--";
        if ($$fc>0) {
          // C'est un UPDATE
          $DB_CX->DbQuery("UPDATE ${PREFIX_TABLE}couleurs SET cou_libelle='".$$fb."', cou_couleur='".$$fa."' WHERE cou_id=".$$fc." AND cou_util_id=0;");
          if ($DB_CX->DbAffectedRows()) {
            $nbUpdate++;
          }
          $listeIdCoul .= ",".$$fc;
        } else {
          // C'est un INSERT
          $DB_CX->DbQuery("INSERT INTO ${PREFIX_TABLE}couleurs (cou_libelle, cou_couleur, cou_util_id)
                     VALUES ('".$$fb."','".$$fa."',0)");
          if ($DB_CX->DbAffectedRows()) {
            $nbInsert++;
            $listeIdCoul .= ",".$DB_CX->DbInsertID();
          }
        }
      }
    }
    // Suppression des couleurs inusitees
    $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}couleurs WHERE cou_id NOT IN(".$listeIdCoul.") AND cou_util_id=0;");
    $nbDelete=$DB_CX->DbAffectedRows();

    //Fin de la mise a jour du fichier de couleur
    if ($nbUpdate || $nbInsert || $nbDelete) {
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_MODCOUL_OK"), "${PREFIX_TABLE}couleurs")."\n";
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_MODCOUL_CR"), $nbInsert, $nbUpdate, $nbDelete)."\n";
    } else {
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_MODCOUL_KO"), "${PREFIX_TABLE}couleurs")."\n";
    }
    echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_MODCOUL_FIN")."<BR><BR>\n";
  }

// etape 3
// Restauration de couleurs par defaut
  if ($modcoul==3) {
    AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/coul.png\">".trad("ADMIN_MAJ_COUL"),"<B>".sprintf(trad("ADMIN_ETAPE"), 2)."</B> - ".trad("ADMIN_TITRE1_COULEUR"));

    $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}couleurs WHERE cou_util_id=0;");
    $DB_CX->DbQuery("INSERT INTO ${PREFIX_TABLE}couleurs (cou_libelle, cou_couleur, cou_util_id)
                     VALUES ('Rouge','#F08080',0), ('Orange','orange',0), ('Jaune','yellow',0), ('Vert','green',0),
                     ('Olive','olive',0), ('Marron','brown',0), ('Beige','beige',0), ('Bleu','dodgerblue',0),
                     ('Violet','violet',0), ('Corail','#F08080',0), ('Rose','pink',0);");

    //Fin de la mise a jour du fichier de couleur
    echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_MODCOUL_OK"), "${PREFIX_TABLE}couleurs")."\n";
    echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("ADMIN_MODCOUL_FIN")."<BR><BR>\n";
  }
}
?>
