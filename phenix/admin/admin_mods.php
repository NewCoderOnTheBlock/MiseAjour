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

// =============================================================================
// MOD Installer for Phenix Agenda
// code by MaxWho17
// release 2008-07-11 * version 0.20.0
// =============================================================================


$file_unzip="inc/unzip.lib.php";

//instmod 1,2,3,4,5,6,7,8
// Gestion des mods
if ($instmod) {
  // --- parametrage -----------------------------------------------------------
  // emplacement des fichiers sauvegardes
  $repSav="admin/mods/saved";
  // emplacement des fichiers dezippes
  $repZip="admin/mods/unzipped";
  // emplacement des fichiers mods
  $repMod="admin/mods";
  // emplacement des fichiers scripts
  $repScr="admin/mods/script";
  // ---------------------------------------------------------------------------

  // --- emplacement des icones ------------------------------------------------
  $icnOk="<IMG src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">";
  $icnKo="<IMG src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\">";
  $icnWarn="<IMG src=\"image/actionwarning.gif\" alt=\"\" align=\"absmiddle\">";
  $icnIns="<IMG src=\"image/admin/mods.png\" alt=\"\" align=\"absmiddle\">";
  $icnDes="<IMG src=\"image/admin/note.png\" alt=\"\" align=\"absmiddle\">";
  // ---------------------------------------------------------------------------

  $fZipList="fziplist.txt";  // nom du fichier liste du zip
  $tag="// Mod applied :";  // libelle du tag : ne pas modifier

  // ***************************************************************************
  // *** Definition des fonctions **********************************************
  // ***************************************************************************

    // --- verification du format des repertoires ------------------------------
    function verifDossier($dossier) {
      if (substr($dossier,-1)!="/" && strlen($dossier)>0) {
        return $dossier.="/";
      } else {
        return $dossier;
      }
    }
    // -------------------------------------------------------------------------

    // --- verification des droits en lecture/ecriture -------------------------
    function droitEcriture($rtest) {
      $rcrt="";
      $rtest=substr($rtest,0,strrpos($rtest,"/"));
      foreach (explode("/",$rtest) as $rept) {
        //on test le dossier
        $rcrt.=$rept;
        if (!is_dir("./".$rcrt)) {
          if (@mkdir($rcrt,0755)===false) {return false;}
        }
        $rcrt.="/";
        //on test avec un fichier tmp
        $rtmp=uniqid(mt_rand()).".tmp";
        if (($ftmp=@fopen($rtmp,"a"))===false) {
          return false;
        } else {
          @fclose($ftmp);
          @unlink($rtmp);
        }
      }
      return true;
    }
    // -------------------------------------------------------------------------

    // --- creation recurcive des repertoires ----------------------------------
    function creerRep($rnew) {
      $rcrt="";
      $rnew=substr($rnew,0,strrpos($rnew,"/"));
      foreach (explode("/",$rnew) as $repn) {
        $rcrt.=$repn;
        if (!is_dir("./".$rcrt)) {
          @mkdir($rcrt,0755);
        }
        $rcrt.="/";
      }
    }
    // -------------------------------------------------------------------------

    // --- suppression recurcive des repertoires -------------------------------
    function detruireRep($rold) {
      $rsec=explode("/",$rold);
      $rsup=$rold;
      krsort($rsec);
      foreach ($rsec as $repo) {
        if (is_dir("./".$rsup)) {
          @rmdir($rsup);
        }
        $rsup=substr($rsup,0,-(strlen($repo)+1));
      }
    }
    // -------------------------------------------------------------------------

    // --- copie complete de repertoire ----------------------------------------
    function copieRepEntier($source,$dest) {
      global $nbcpy;
      creerRep(verifDossier($dest));
      if ($rep=@opendir($source)) {
        while ($file=readdir($rep)) {
          if ($file!="." && $file!=".." && $file!="") {
            if (is_dir("./".$source."/".$file)) {
              copieRepEntier($source."/".$file,$dest."/".$file);
            } else {
              if ((@copy($source."/".$file,$dest."/".$file))!==false) {$nbcpy++;}
            }
          }
        }
        closedir($rep);
      }
    }

    // --- decompression du zip ------------------------------------------------
    function dezipperMod($fmod) {
      global $file_unzip,$repZip,$znom,$zerm,$objZip,$fmor,$zroot,$fzip,$fZipList;
      if ((@include($file_unzip))===false) {return 101;}
      $fzip=array();
      $objZip = new SimpleUnzip($fmod);
      for ($i=0;$i<($objZip->Count());$i++) {
        if (($zerr=$objZip->GetError($i))==0) {
          $zrep=$objZip->GetPath($i)."/";
          if (strlen($zrep)>1) {creerRep($repZip.$zrep);} else {$zrep="";}
          $znom=$objZip->GetName($i);
          $fzip[]=$zrep.$znom;
          // si le mod est contenu dans un dossier du meme nom que le zip
          if ($znom==substr($fmor,0,-3)."txt" && $zrep!="") {$zroot=$zrep;}
          if (($fm=@fopen($repZip.$zrep.$znom, "wb"))===false) {return 103;}
          $zdat=$objZip->GetData($i);
          if (@fwrite($fm, $zdat)===false) {return 104;}
          @fclose($fm);
        } else {
          $zerm=$objZip->GetErrorMsg($i);
          return $zerr+110;
        }
      }
      if (($fzl=@fopen($repZip.$fZipList, "w"))!==false) {
        foreach ($fzip as $fz) {fputs($fzl,$fz."\n");}
        @fclose($fzl);
      }
      return 0;
    }
    // -------------------------------------------------------------------------

    // --- verification du tag des fichiers ------------------------------------
    function verifTag() {
      global $tabModsDB,$tag;
      foreach ($tabModsDB as $key=>$mod) {
        if (@file_exists($mod['mod_fichier'])) {
          if (($fTag=@fopen($mod['mod_fichier'], "r"))!==false) {
            $nblig=0;
            $line=$tag;
            $lenTag=20+strlen($tag);
            // on prend uniquement les lignes taggues dans la limite de 50 lignes
            while (!feof($fTag) && $nblig<50 && strpos($line,$tag)!==false) {
              $nblig++;
              $line=fgets($fTag);
              if (strlen($line)>$lenTag) {
                if (substr(trim($line),$lenTag,-2)==$mod['mod_nom']." ") {
                  $tabModsDB[$key]['mod_ok']=1;
                  break;
                }
              }
            }
            @fclose($fTag);
          }
        }
      }
      clearstatcache();
    }
    // -------------------------------------------------------------------------

    // --- lecture du mod ------------------------------------------------------
    function lectureMod($fmod) {
      global $modLine,$nbop,$mdTit,$mdVer,$mdAut,$mdIde,$mdDes,$mdReq,$mdHis,$mdPrv,$pxPatch;
      $modLine[0][0]=$fnc=$nbop=$desc=$hist=0;
      if (($fm=@fopen($fmod, "r"))===false) {return 201;}
      while (!feof($fm)) {
        $line=fgets($fm);
        if (substr($line,0,1)!="#" && strlen(trim($line))>0) {
          $modLine[0][0]++;
          $modLine[$modLine[0][0]][0]=$fnc;
          $modLine[$modLine[0][0]][1]=$line;
        }
        // lecture recurcive de la description
        if ($desc && substr($line,0,2)=="##") {
          if (strlen(trim(substr($line,2)))>0) {
            $mdDes[]=rtrim(substr($line,2));
          } elseif ($mdDes[count($mdDes)-1]!="") {
            $desc=false;
          }
        }
        // lecture recurcive de l'historique
        if ($hist && substr($line,0,2)=="##") {
          if (strlen(trim(substr($line,2)))>0 && substr($line,0,3)!="###") {
            $mdHis[]=rtrim(substr($line,2));
          } elseif (substr($line,0,3)=="###") {
            $hist=false;
          }
        }
        // lecture des commentaires
        if (strpos($line,"## MOD Title:")!==false) {$mdTit=trim(substr($line,13));}
        if (strpos($line,"## MOD Version:")!==false) {$mdVer=trim(substr($line,15));}
        if (strpos($line,"## MOD Author:")!==false) {$mdAut=trim(substr($line,14));}
        if (strpos($line,"## MOD Idea:")!==false) {$mdIde=trim(substr($line,12));}
        if (strpos($line,"## MOD Preview:")!==false) {$mdPrv=trim(substr($line,15));}
        if (strpos($line,"## MOD Description:")!==false) {$desc=true;$mdDes[]=trim(substr($line,19));}
        if (strpos($line,"## PX Version Required:")!==false) {$mdReq=trim(substr($line,23));}
        if (strpos($line,"## PX Patch:")!==false) {$pxPatch=trim(substr($line,12));}
        if (strpos($line,"## MOD History:")!==false) {$hist=true;}
        // lecture des instructions
        if (strpos($line,"-[ COPY ]-")!==false) {$fnc=1;$nbop++;}
        if (strpos($line,"-[ SQL ]-")!==false) {$fnc=2;$nbop++;}
        if (strpos($line,"-[ DIY INSTRUCTIONS ]-")!==false) {$fnc=3;$nbop++;}
        if (strpos($line,"-[ OPEN ]-")!==false) {$fnc=4;$nbop++;}
        if (strpos($line,"-[ FIND ]-")!==false) {$fnc=5;$nbop++;}
        if (strpos($line,"-[ AFTER, ADD ]-")!==false) {$fnc=6;$nbop++;}
        if (strpos($line,"-[ BEFORE, ADD ]-")!==false) {$fnc=7;$nbop++;}
        if (strpos($line,"-[ REPLACE WITH ]-")!==false) {$fnc=8;$nbop++;}
        if (strpos($line,"-[ INCREMENT ]-")!==false) {$fnc=9;$nbop++;}
        if (strpos($line,"-[ IN-LINE FIND ]-")!==false) {$fnc=10;$nbop++;}
        if (strpos($line,"-[ IN-LINE AFTER, ADD ]-")!==false) {$fnc=11;$nbop++;}
        if (strpos($line,"-[ IN-LINE BEFORE, ADD ]-")!==false) {$fnc=12;$nbop++;}
        if (strpos($line,"-[ IN-LINE REPLACE WITH ]-")!==false) {$fnc=13;$nbop++;}
        if (strpos($line,"-[ IN-LINE INCREMENT ]-")!==false) {$fnc=14;$nbop++;}
        if (strpos($line,"-[ FIND BEGINNING WITH ]-")!==false) {$fnc=15;$nbop++;}
        if (strpos($line,"-[ SAVE/CLOSE ALL FILES ]-")!==false) {$fnc=99;$nbop++;}
      }
      fclose($fm);
      if ($modLine[0][0]>0) {
        $modLine[0][0]++;
        $modLine[$modLine[0][0]][0]=99;
        $modLine[$modLine[0][0]][1]="EoM";
      }
      if ($nbop==0) {return 202;}
      return 0;
    }
    // -------------------------------------------------------------------------

    // --- installation du mod -------------------------------------------------
    function installMod($noSql) {
      global $modLine,$posLig,$errDtl,$errLig,$errBlk,$inlBlk,$cpOrig,$DB_CX,$PREFIX_TABLE,$diyMsg,$repZip,$repSav,$fOrig,$fDest,$fmor,$ckVerif,$ckDebug,$instDate,$localTime,$nbcpy,$nbsql,$nbfic,$instmod,$pxPatch,$tag;
      $instDate=date("Y-m-d",$localTime);
      $posLig=$posFic=$posTag=$nbcpy=$nbsql=$nbfic=0;
      $errLig=$ficOpen="";
      $fOrig=$fDest=$fndPut=false;
      $diyMsg=$errBlk=$inlBlk=array();
      while ($posLig!=$modLine[0][0]) {
        $posLig++;
        $nInstruc=$modLine[$posLig][0];
        switch ($nInstruc) {
        // copy ***********************************
        case 1:
          if ($instmod!=7) {  // on est pas en reinstallation
            // on separe le fichier source et le fichier de destination
            if (substr(ltrim($modLine[$posLig][1]),0,4)=="copy" && strpos($modLine[$posLig][1]," to ")) {
              list($cpOrig,$cpDest)=explode(" to ",substr($modLine[$posLig][1],4));
            } elseif (strpos($modLine[$posLig][1],"--->")) {
              list($cpOrig,$cpDest)=explode("--->",$modLine[$posLig][1]);
            } else {
              $errLig=$posLig;
              $errBlk[]=$modLine[$posLig][1];
              return 314;
            }
            $cpOrig=trim($cpOrig);
            $cpDest=trim($cpDest);
            // si la source est un repertoire, on copie l'integralite
            if (substr($cpOrig,-1,1)=="/") {
              if (!$ckVerif) {
                copieRepEntier($repZip.substr($cpOrig,0,-1),substr(verifDossier($cpDest),0,-1));
                clearstatcache();
                if ($nbcpy==0) {return 312;}
              }
            } else {
              // si la destination est un repertoire, on prend le nom d'origine
              if (substr($cpDest,-1,1)=="/") {$cpDest.=basename($cpOrig);}
              // on test si le rep est la racine et on enleve le / au debut
              if (substr($cpDest,0,1)=="/") {$cpDest=substr($cpDest,1);}
              if (!$ckVerif) {
                creerRep($cpDest);
                // on test si la copie doit se faire a partir du zip
                if (@file_exists($repZip.$cpOrig)) {
                  if ((@copy($repZip.$cpOrig,$cpDest))===false) {return 312;}
                } elseif ($cpOrig!=$cpDest) {
                  // ou a l'interieur de phenix
                  if (@file_exists($cpOrig)) {
                    if ((@copy($cpOrig,$cpDest))===false) {return 313;}
                  } else {
                    return 311;
                  }
                } else {
                  return 310;
                }
              }
              $nbcpy++;
            }
          }
          break;
        // sql ***********************************
        case 2:
          if (!$noSql) {
            while ($modLine[$posLig][0]==$nInstruc) {
              $sqlBlk="";
              $debLig=$posLig;
              // si la requete est sur plusieurs lignes, on les regroupes
              while (substr(rtrim($modLine[$posLig][1]),-1,1)!=";") {
                $sqlBlk.=trim($modLine[$posLig][1]);
                $posLig++;
                if ($modLine[$posLig][0]!=$nInstruc) {return 325;}
              }
              $sqlBlk.=trim($modLine[$posLig][1]);
              // on remplace le prefix et on execute la requete
              $sqlBlk=str_replace('${prefix}',$PREFIX_TABLE,$sqlBlk);
              if (!$ckVerif) {
                if (!$DB_CX->DbQuery($sqlBlk)) {
                  // on exclu la mention d'erreur sur ajout de champ, d'index, de table, sauf en mode deboguage
                  if (($DB_CX->DbErrorNo($link)!=1060 && $DB_CX->DbErrorNo($link)!=1062 && $DB_CX->DbErrorNo($link)!=1050) || $ckDebug) {
                    if (!empty($errDtl)) {$errDtl.=" / ";}
                    $errDtl.=$DB_CX->DbErrorNo($link)." - ".$DB_CX->DbError();
                    if (!empty($errLig)) {$errLig.=", ";}
                    $errLig.=$debLig;
                    for ($i=$debLig;$i<=$posLig;$i++) {
                      $errBlk[]=str_replace('${prefix}',$PREFIX_TABLE,$modLine[$i][1]);
                    }
                  }
                }
              }
              $posLig++;
              // on comptabilise uniquement les requetes reussies sauf en debug
              if (!$DB_CX->DbErrorNo($link) || $ckDebug) {$nbsql++;}
            }
            $posLig--;
            if (!empty($errBlk) && $instmod!=5) {return 324;}
          }
          break;
        // do it yourself ***********************************
        case 3:
          $diyMsg[]=$modLine[$posLig][1];
          break;
        // open ***********************************
        case 4:
          // fermeture du fichier precedent avant d'ouvrir le nouveau
          if ($fOrig || $fDest) {
            if (!$ckVerif) {
              while (!feof($fOrig)) {
                $line=fgets($fOrig);
                fputs($fDest,$line);
              }
              @fclose($fDest);
            }
            @fclose($fOrig);
          }
          // lecture de l'entete pour verifier que le mod n'est pas deja installe
          if (@file_exists(trim($modLine[$posLig][1]))) {
            if (($fOrig=@fopen(trim($modLine[$posLig][1]), "r"))===false) {
              $errDtl=trim($modLine[$posLig][1]);
              return 341;
            }
            // on prend uniquement les lignes taggues dans la limite de 50 lignes
            $posTag=0;
            $line=$tag;
            $lenTag=20+strlen($tag);
            while (!feof($fOrig) && $posTag<50 && strpos($line,$tag)!==false) {
              $posTag++;
              $line=fgets($fOrig);
              if (strlen($line)>$lenTag) {
                if (substr(trim($line),$lenTag,-2)==$fmor." ") {
                  if ($instmod==4 || $pxPatch) {  //on est en desinstall ou c'est un patch
                    break;
                  } else {
                    // on extrait la date
                    $errDtl=substr($line,7+strlen($tag),10);
                    return 342;
                  }
                }
              }
            }
            @fclose($fOrig);
          } else {
            $errDtl=trim($modLine[$posLig][1]);
            return 340;
          }
          // copie du fichier a modifier dans le repertoire temporaire
          if (!$ckVerif) {
            $fs=$repSav.trim($modLine[$posLig][1]);
            if (strpos(trim($modLine[$posLig][1]),"/")!==false) {creerRep($fs);}
            if (!@rename(trim($modLine[$posLig][1]),$fs)) {
              @copy(trim($modLine[$posLig][1]),$fs);
              @unlink(trim($modLine[$posLig][1]));
            }
          } else {
            $fs=trim($modLine[$posLig][1]);
          }
          // ecriture de l'entete dans le fichier a modifier
          if (($fOrig=@fopen($fs, "r"))===false) {
            $errDtl=$fs;
            return 344;
          }
          if (!$ckVerif) {
            if (($fDest=@fopen(trim($modLine[$posLig][1]), "w"))===false) {
              $errDtl=trim($modLine[$posLig][1]);
              return 345;
            }
            if ($instmod!=4 && !$pxPatch) {  //on est pas en desinstall et ce n'est pas un patch
              // on extrait l'extension du fichier pour les tags
              $fpar=explode(".",trim($modLine[$posLig][1]));
              $fTypeExt=$fpar[(count($fpar)-1)];
              // on choisi le tag en fonction de l'extension
              if ($fTypeExt=="php") {
                fputs($fDest,"<?php ".$tag." ".$instDate." * ".$fmor." ?".">\n");
              } else {
                fputs($fDest,"/**** ".$tag." ".$instDate." * ".$fmor." */\n");
              }
            }
          }
          $ficOpen=trim($modLine[$posLig][1]);
          $posFic=0;
          $nbfic++;
          break;
        // find ***********************************
        case 5:
          // si aucun fichier n'est ouvert
          if (!$fOrig) {
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 351;
          }
          $finded[0]=0;
          $fndPut=false;
          while (!feof($fOrig) && $modLine[$posLig][0]==$nInstruc) {
            $posFic++;
            $line=fgets($fOrig);
            if (trim($line)==trim($modLine[$posLig][1])) {
              // si on trouve on met en cache
              $finded[0]++;
              $finded[$finded[0]]=$line;
              $posLig++;
            } else {
              if ($finded[0]!=0) {
                // si la recherche est partielle, on ecrit le cache et on continue
                for ($i=1;$i<=$finded[0];$i++) {
                  if (!$ckVerif) {
                    fputs($fDest,$finded[$i]);
                  }
                  $posLig--;
                }
                $finded[0]=0;
              }
              if (!$ckVerif) {
                // si on est en desinstall, on supprime le tag
                if (!($instmod==4 && $posFic==$posTag)) {fputs($fDest,$line);}
              }
            }
          }
          // si rien n'a ete trouve
          if ($finded[0]==0) {
            $errDtl=$ficOpen;
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 352;
          }
          $posLig--;
          break;
        // after, add ***********************************
        case 6:
          // si rien n'a ete trouve
          if ($finded[0]==0) {
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 361;
          }
          // on inscrit le cache et apres le bloc
          if (!$ckVerif && !$fndPut) {
            for ($i=1;$i<=$finded[0];$i++) {
              fputs($fDest,$finded[$i]);
            }
            $fndPut=true;
          }
          while ($modLine[$posLig][0]==$nInstruc) {
            if (!$ckVerif) {
              fputs($fDest,$modLine[$posLig][1]);
            }
            $posLig++;
          }
          $posLig--;
          break;
        // before, add ***********************************
        case 7:
          // si rien n'a ete trouve
          if ($finded[0]==0) {
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 371;
          }
          // on inscrit le bloc avant le cache
          while ($modLine[$posLig][0]==$nInstruc) {
            if (!$ckVerif) {
              fputs($fDest,$modLine[$posLig][1]);
            }
            $posLig++;
          }
          $posLig--;
          if (!$ckVerif && !$fndPut) {
            for ($i=1;$i<=$finded[0];$i++) {
              fputs($fDest,$finded[$i]);
            }
            $fndPut=true;
          }
          break;
        // replace with ***********************************
        case 8:
          // si rien n'a ete trouve ou que l'instruction precedente n'est pas un find
          // on exclut ainsi le find beginning with qui pose probleme a la desinstall
          if ($finded[0]==0 || ($modLine[$posLig-1][0]==15 && $instmod!=4)) {
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 381;
          }
          // on inscrit le bloc de remplacement
          while ($modLine[$posLig][0]==$nInstruc) {
            if (!$ckVerif) {
              fputs($fDest,$modLine[$posLig][1]);
            }
            $posLig++;
          }
          $posLig--;
          break;
        // increment ***********************************
        case 9:
          break;
        // in-line find ***********************************
        case 10:
          // si rien n'a ete trouve
          if ($finded[0]==0) {
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 401;
          }
          $fndBlk[0]=0;
          // on cherche le bloc dans le cache
          for ($i=1;$i<=$finded[0];$i++) {
            if (($posFnd=strpos($finded[$i],trim($modLine[$posLig][1])))!==false) {
              $fndBlk[0]=$i;
              $fndBlk[1]=substr($finded[$i],0,$posFnd);
              $fndBlk[2]=trim($modLine[$posLig][1]);
              $fndBlk[3]=substr($finded[$i],$posFnd+strlen(trim($modLine[$posLig][1])));
              break;
            }
          }
          // si rien n'a ete trouve
          if ($fndBlk[0]==0) {
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            for ($i=1;$i<=$finded[0];$i++) {
              $inlBlk[]=$finded[$i];
            }
            return 402;
          }
          break;
        // in-line after, add ***********************************
        case 11:
          // si rien n'a ete trouve
          if ($fndBlk[0]==0) {
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 411;
          }
          // on inscrit le bloc jusqu'a la ligne concernee
          if (!$ckVerif) {
            for ($i=1;$i<=$finded[0];$i++) {
              if ($fndBlk[0]==$i) {
                $fndLine=$fndBlk[1].$fndBlk[2].trim($modLine[$posLig][1]).$fndBlk[3];
                // pour les in-line successifs on met a jour le bloc
                $fndBlk[3]=trim($modLine[$posLig][1]).$fndBlk[3];
              } else {
                $fndLine=$finded[$i];
              }
              // si l'instruction suivante est un in-line on modifie le cache
              if ($modLine[$posLig+1][0]>9 && $modLine[$posLig+1][0]<15) {
                $finded[$i]=$fndLine;
              } else {
                fputs($fDest,$fndLine);
              }
            }
          }
          break;
        // in-line before, add ***********************************
        case 12:
          // si rien n'a ete trouve
          if ($fndBlk[0]==0) {
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 421;
          }
          // on inscrit le bloc jusqu'a la ligne concernee
          if (!$ckVerif) {
            for ($i=1;$i<=$finded[0];$i++) {
              if ($fndBlk[0]==$i) {
                $fndLine=$fndBlk[1].trim($modLine[$posLig][1]).$fndBlk[2].$fndBlk[3];
                // pour les in-line successifs on met a jour le bloc
                $fndBlk[1]=$fndBlk[1].trim($modLine[$posLig][1]);
              } else {
                $fndLine=$finded[$i];
              }
              // si l'instruction suivante est un in-line on modifie le cache
              if ($modLine[$posLig+1][0]>9 && $modLine[$posLig+1][0]<15) {
                $finded[$i]=$fndLine;
              } else {
                fputs($fDest,$fndLine);
              }
            }
          }
          break;
        // in-line replace ***********************************
        case 13:
          // si rien n'a ete trouve
          if ($fndBlk[0]==0) {
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 431;
          }
          // on inscrit le bloc jusqu'a la ligne concernee
          if (!$ckVerif) {
            for ($i=1;$i<=$finded[0];$i++) {
              if ($fndBlk[0]==$i) {
                $fndLine=$fndBlk[1].trim($modLine[$posLig][1]).$fndBlk[3];
                // pour les in-line successifs on met a jour le bloc
                $fndBlk[2]=trim($modLine[$posLig][1]);
              } else {
                $fndLine=$finded[$i];
              }
              // si l'instruction suivante est un in-line on modifie le cache
              if ($modLine[$posLig+1][0]>9 && $modLine[$posLig+1][0]<15) {
                $finded[$i]=$fndLine;
              } else {
                fputs($fDest,$fndLine);
              }
            }
          }
          break;
        // in-line increment ***********************************
        case 14:
          break;
        // find beginning with ***********************************
        case 15:
          // si aucun fichier n'est ouvert
          if (!$fOrig) {
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 451;
          }
          $finded[0]=0;
          $fndPut=false;
          while (!feof($fOrig) && $modLine[$posLig][0]==$nInstruc) {
            $posFic++;
            $line=fgets($fOrig);
            $lnComp=trim($modLine[$posLig][1]);
            if (substr(ltrim($line),0,strlen($lnComp))==$lnComp) {
              // si on trouve on met en cache
              $finded[0]++;
              $finded[$finded[0]]=$line;
              $posLig++;
            } else {
              if ($finded[0]!=0) {
                // si la recherche est partielle, on ecrit le cache et on continue
                for ($i=1;$i<=$finded[0];$i++) {
                  if (!$ckVerif) {
                    fputs($fDest,$finded[$i]);
                  }
                  $posLig--;
                }
                $finded[0]=0;
              }
              if (!$ckVerif) {
                // si on est en desinstall, on supprime le tag
                if (!($instmod==4 && $posFic==$posTag)) {fputs($fDest,$line);}
              }
            }
          }
          // si rien n'a ete trouve
          if ($finded[0]==0) {
            $errDtl=$ficOpen;
            $errLig=$posLig;
            $i=$posLig;
            while ($modLine[$i][0]==$nInstruc) {
              $errBlk[]=$modLine[$i][1];
              $i++;
            }
            return 452;
          }
          $posLig--;
          break;
        // save & close on eom ***********************************
        case 99:
          if ($fOrig || $fDest) {
            if (!$ckVerif) {
              while (!feof($fOrig)) {
                $posFic++;
                $line=fgets($fOrig);
                if (!($instmod==4 && $posFic==$posTag)) {fputs($fDest,$line);}
              }
              @fclose($fDest);
            }
            @fclose($fOrig);
          }
          $posLig=$modLine[0][0];
          break;
        }
      }
      return 0;
    }
    // -------------------------------------------------------------------------

    // --- preparation du script de desinstallation ----------------------------
    function genereDesinstall($fmor) {
      global $DB_CX,$PREFIX_TABLE,$tabModsDB,$modLine,$posLig,$errDtl,$errLig,$errBlk,$nbop;
      // lecture de la liste des fichiers du mod en base
      $tabModsDB=array();
      $DB_CX->DbQuery("SELECT * FROM ${PREFIX_TABLE}mods WHERE mod_nom='".$fmor."' ORDER BY mod_id");
      while ($enr=$DB_CX->DbNextRow()) {
        $tabModsDB[]=$enr;
      }
      // verif si les fichiers sont taggues
      verifTag();

      // generation du script de desinstall
      $posLig=$modLineDes[0][0]=0;
      while ($posLig!=$modLine[0][0]) {
        $posLig++;
        $nInstruc=$modLine[$posLig][0];
        switch ($nInstruc) {
        // copy ***********************************
        case 1:
          break;
        // sql ***********************************
        case 2:
          break;
        // do it yourself ***********************************
        case 3:
          break;
        // open ***********************************
        case 4:
          // si le fichier est taggues on continue sinon on passe au suivant
          $lnFic=0;
          foreach ($tabModsDB as $key=>$mod) {
            if (trim($modLine[$posLig][1])==$mod['mod_fichier']) {$lnFic=$key;}
          }
          if ($tabModsDB[$lnFic]['mod_ok']) {
            $modLineDes[0][0]++;
            $modLineDes[$modLineDes[0][0]][0]=$nInstruc;
            $modLineDes[$modLineDes[0][0]][1]=$modLine[$posLig][1];
          } else {
            // on avance jusqu'au prochain open
            $posLig++;
            $preCod=-1;
            while ($modLine[$posLig][0]!=99 && $modLine[$posLig][0]!=$nInstruc) {
              $posLig++;
              // on decompte les instructions pour les stats
              if ($preCod!=$modLine[$posLig][0]) {
                $nbop--;
                $preCod=$modLine[$posLig][0];
              }
            }
            $posLig--;
          }
          break;
        // find ***********************************
        case 5:
          $finded[0]=0;
          while ($modLine[$posLig][0]==$nInstruc) {
            $finded[0]++;
            $finded[$finded[0]]=$modLine[$posLig][1];
            $posLig++;
          }
          $posLig--;
          break;
        // after, add ***********************************
        case 6:
          // si l'instruction precedente est un find beginning with on la supprime
          if ($modLineDes[$modLineDes[0][0]][0]==15) {
            $modLineDes[0][0]-=$finded[0];
          }
          // on cherche le bloc
          while ($modLine[$posLig][0]==$nInstruc) {
            $modLineDes[0][0]++;
            $modLineDes[$modLineDes[0][0]][0]=5; //find
            $modLineDes[$modLineDes[0][0]][1]=$modLine[$posLig][1];
            $posLig++;
          }
          $posLig--;
          // pour effacer on ajoute un replace vide
          $modLineDes[0][0]++;
          $modLineDes[$modLineDes[0][0]][0]=8; //replace
          $modLineDes[$modLineDes[0][0]][1]="";
          break;
        // before, add ***********************************
        case 7:
          // si l'instruction precedente est un find beginning with on la supprime
          if ($modLineDes[$modLineDes[0][0]][0]==15) {
            $modLineDes[0][0]-=$finded[0];
          }
          // on cherche le bloc
          while ($modLine[$posLig][0]==$nInstruc) {
            $modLineDes[0][0]++;
            $modLineDes[$modLineDes[0][0]][0]=5; //find
            $modLineDes[$modLineDes[0][0]][1]=$modLine[$posLig][1];
            $posLig++;
          }
          $posLig--;
          // pour effacer on ajoute un replace vide
          $modLineDes[0][0]++;
          $modLineDes[$modLineDes[0][0]][0]=8; //replace
          $modLineDes[$modLineDes[0][0]][1]="";
          break;
        // replace with ***********************************
        case 8:
          // on cherche le bloc et on remplace par le cache
          while ($modLine[$posLig][0]==$nInstruc) {
            $modLineDes[0][0]++;
            $modLineDes[$modLineDes[0][0]][0]=5; //find
            $modLineDes[$modLineDes[0][0]][1]=$modLine[$posLig][1];
            $posLig++;
          }
          $posLig--;
          for ($i=1;$i<=$finded[0];$i++) {
            $modLineDes[0][0]++;
            $modLineDes[$modLineDes[0][0]][0]=8; //replace
            $modLineDes[$modLineDes[0][0]][1]=$finded[$i];
          }
          break;
        // increment ***********************************
        case 9:
          break;
        // in-line find ***********************************
        case 10:
          $fndBlk[2]=$modLine[$posLig][1];
          break;
        // in-line after, add ***********************************
        case 11:
          // on cherche le bloc
          $modLineDes[0][0]++;
          $modLineDes[$modLineDes[0][0]][0]=10; //in-line find
          $modLineDes[$modLineDes[0][0]][1]=$modLine[$posLig][1];
          // pour effacer on ajoute un in-line replace vide
          $modLineDes[0][0]++;
          $modLineDes[$modLineDes[0][0]][0]=13; //in-line replace
          $modLineDes[$modLineDes[0][0]][1]="";
          break;
        // in-line before, add ***********************************
        case 12:
          // on cherche le bloc
          $modLineDes[0][0]++;
          $modLineDes[$modLineDes[0][0]][0]=10; //in-line find
          $modLineDes[$modLineDes[0][0]][1]=$modLine[$posLig][1];
          // pour effacer on ajoute un in-line replace vide
          $modLineDes[0][0]++;
          $modLineDes[$modLineDes[0][0]][0]=13; //in-line replace
          $modLineDes[$modLineDes[0][0]][1]="";
          break;
        // in-line replace ***********************************
        case 13:
          // on cherche le bloc et on remplace par le cache
          $modLineDes[0][0]++;
          $modLineDes[$modLineDes[0][0]][0]=10; //in-line find
          $modLineDes[$modLineDes[0][0]][1]=trim($modLine[$posLig][1]);
          $modLineDes[0][0]++;
          $modLineDes[$modLineDes[0][0]][0]=13; //in-line replace
          $modLineDes[$modLineDes[0][0]][1]=$fndBlk[2];
          break;
        // in-line increment ***********************************
        case 14:
          break;
        // find beginning with ***********************************
        case 15:
          // on vide le cache
          $finded[0]=1;
          $finded[$finded[0]]="";
          $modLineDes[0][0]++;
          $modLineDes[$modLineDes[0][0]][0]=$nInstruc;
          $modLineDes[$modLineDes[0][0]][1]=$modLine[$posLig][1];
          break;
        // save & close on eom ***********************************
        case 99:
          $modLineDes[0][0]++;
          $modLineDes[$modLineDes[0][0]][0]=$nInstruc;
          $modLineDes[$modLineDes[0][0]][1]=$modLine[$posLig][1];
          break;
        }
      }
      $modLine=$modLineDes;
      return 0;
    }
    // -------------------------------------------------------------------------

    // --- purge des fichiers temporaires --------------------------------------
    function purgerFicTemp($temp) {
      global $modLine,$repSav,$fmod,$repZip,$fzip,$fZipList;
      switch ($temp) {
      case "sav":
        // purge des fichiers sauvegardes
        for ($posLig=1;$posLig<=$modLine[0][0];$posLig++) {
          if ($modLine[$posLig][0]==4) {
            if (@file_exists($repSav.trim($modLine[$posLig][1]))) {
              @unlink($repSav.trim($modLine[$posLig][1]));
            }
            detruireRep($repSav.trim($modLine[$posLig][1]));
          }
        }
        detruireRep($repSav);
        break;
      case "mod":
        // purge de la copie du fichier mod
        if (@file_exists($fmod)) {
          @unlink($fmod);
        }
        detruireRep($fmod);
        break;
      case "zip":
        // purge des fichiers dezippes
        if ($fzip==$fZipList) {
          if (($fzl=@fopen($repZip.$fZipList, "r"))!==false) {
            $fzip=array();
            while (!feof($fzl)) {
              $fzip[]=fgets($fzl);
            }
            @fclose($fzl);
          }
        }
        @unlink($repZip.$fZipList);
        foreach ($fzip as $fz) {
          $fz=$repZip.trim($fz);
          if (@file_exists($fz)) {
            @unlink($fz);
          }
          detruireRep($fz);
        }
        break;
      }
      return 0;
    }
    // -------------------------------------------------------------------------

    // --- restauration des fichiers originaux ---------------------------------
    function restaureSav() {
      global $modLine,$repSav;
      for ($i=1;$i<=$modLine[0][0];$i++) {
        if ($modLine[$i][0]==4) {
          if (@file_exists($repSav.trim($modLine[$i][1]))) {
            @unlink(trim($modLine[$i][1]));
            if (!@rename($repSav.trim($modLine[$i][1]),trim($modLine[$i][1]))) {
              @copy($repSav.trim($modLine[$i][1]),trim($modLine[$i][1]));
              @unlink($repSav.trim($modLine[$i][1]));
            }
          }
        }
      }
    }
    // -------------------------------------------------------------------------

    // --- affichage des statistiques ------------------------------------------
    function affStats() {
      global $icnOk,$nbop,$nbcpy,$nbsql,$nosql,$nbfic;
      echo($icnOk.sprintf(trad("INSTMOD_STAT_INSTRUC"),$nbop,($nbop>1 ? trad("INSTMOD_PLURIEL"):""))."<BR>\n");
      if ($nbcpy>0) {
        echo($icnOk.sprintf(trad("INSTMOD_STAT_COPY"),$nbcpy,($nbcpy>1 ? trad("INSTMOD_PLURIEL"):""))."<BR>\n");
      }
      if ($nbsql>0 && !$nosql) {
        echo($icnOk.sprintf(trad("INSTMOD_STAT_SQL"),$nbsql,($nbsql>1 ? trad("INSTMOD_PLURIEL"):""))."<BR>\n");
      }
      if ($nbfic>0) {
        echo($icnOk.sprintf(trad("INSTMOD_STAT_FICHIER"),$nbfic,($nbfic>1 ? trad("INSTMOD_PLURIEL"):""))."<BR>\n");
      }
    }
    // -------------------------------------------------------------------------

    // --- gestion des erreurs -------------------------------------------------
    function afficheErreur($errCode) {
      global $NOM_PAGE,$piedPage,$file_unzip,$znom,$zerm,$fmor,$cpOrig,$errDtl,$errLig,$errBlk,$inlBlk,$zroot,$icnKo,$icnWarn,$ckDebug,$checked,$fzip,$fZipList,$instmod,$upd,$desMult,$actNom,$warnver;
      if ($errCode!=0) {
        switch ($errCode) {
        // erreurs de decompression du zip
        case 101:
          $errMsg=sprintf(trad("INSTMOD_ERR_LECT"),$fmor); break;
        case 103:
        case 104:
          $errMsg=sprintf(trad("INSTMOD_ERR_EXT"),$znom); break;
        case 110:
        case 111:
        case 112:
        case 113:
        case 114:
        case 115:
        case 116:
        case 117:
          $errMsg=sprintf(trad("INSTMOD_ERR_ZIP"),$fmor)." :<BR>&nbsp;--> <I>".($errCode-110)." - ".$zerm."</I>"; break;
        // erreurs de lecture du mod
        case 201:
          $errMsg=sprintf(trad("INSTMOD_ERR_LECT"),$fmor); break;
        case 202:
          $errMsg=sprintf(trad("INSTMOD_ERR_VALID"),$fmor); break;
        // erreurs d'installation du mod
        case 310:
        case 311:
          $errMsg=sprintf(trad("INSTMOD_ERR_ACCES"),$cpOrig); break;
        case 312:
        case 313:
          $errMsg=sprintf(trad("INSTMOD_ERR_COPIE"),$cpOrig); break;
        case 314:
          $errMsg=trad("INSTMOD_ERR_INSTRUC")." : ".trad("INSTMOD_ERR_COPY"); break;
        case 324:
          $errMsg=trad("INSTMOD_ERR_SQL")." : <I>".$errDtl."</I>"; break;
        case 325:
          $errMsg=trad("INSTMOD_ERR_SQL")." : ".trad("INSTMOD_ERR_SQL_PV"); break;
        case 340:
          $errMsg=sprintf(trad("INSTMOD_ERR_ACCES"),$errDtl); break;
        case 341:
          $errMsg=sprintf(trad("INSTMOD_ERR_LECT"),$errDtl); break;
        case 342:
          $errMsg=sprintf(trad("INSTMOD_ERR_DEJA"),date("d/m/Y",strtotime($errDtl))); break;
        case 344:
          $errMsg=sprintf(trad("INSTMOD_ERR_LECT"),$errDtl); break;
        case 345:
          $errMsg=sprintf(trad("INSTMOD_ERR_ECRIT"),$errDtl); break;
        case 351:
          $errMsg=trad("INSTMOD_ERR_INSTRUC")." : ".trad("INSTMOD_ERR_FIND"); break;
        case 352:
          $errMsg=sprintf(trad("INSTMOD_ERR_NON_TROUVE"),$errDtl); break;
        case 361:
          $errMsg=trad("INSTMOD_ERR_INSTRUC")." : ".trad("INSTMOD_ERR_AFTER"); break;
        case 371:
          $errMsg=trad("INSTMOD_ERR_INSTRUC")." : ".trad("INSTMOD_ERR_BEFORE"); break;
        case 381:
          $errMsg=trad("INSTMOD_ERR_INSTRUC")." : ".trad("INSTMOD_ERR_REPLACE"); break;
        case 401:
          $errMsg=trad("INSTMOD_ERR_INSTRUC")." : ".trad("INSTMOD_ERR_INL_FIND"); break;
        case 402:
          $errMsg=sprintf(trad("INSTMOD_ERR_INL_NON_TROUVE"),$errLig-1); break;
        case 411:
          $errMsg=trad("INSTMOD_ERR_INSTRUC")." : ".trad("INSTMOD_ERR_INL_AFTER"); break;
        case 421:
          $errMsg=trad("INSTMOD_ERR_INSTRUC")." : ".trad("INSTMOD_ERR_INL_BEFORE"); break;
        case 431:
          $errMsg=trad("INSTMOD_ERR_INSTRUC")." : ".trad("INSTMOD_ERR_INL_REPLACE"); break;
        case 451:
          $errMsg=trad("INSTMOD_ERR_INSTRUC")." : ".trad("INSTMOD_ERR_BEGIN"); break;
        case 452:
          $errMsg=sprintf(trad("INSTMOD_ERR_NON_TROUVE"),$errDtl); break;
        }
        // affichage de l'erreur ou de l'avetissement
        echo($icnKo."<FONT color=\"#ff0000\">".trad("INSTMOD_ERREUR")." ".$errCode." : ".$errMsg."</FONT><BR>\n");
        if (!empty($inlBlk)) {
          echo("<BR>");
          echo("<TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"100%\" class=\"code\" style=\"color: #006600;\"><TR><TD>\n");
          foreach ($inlBlk as $line) {
            preg_match('/^\s+/',$line,$spcFnd);
            echo(preg_replace('/^\s+/',str_repeat("&nbsp;",strlen($spcFnd[0])),htmlentities($line))."<BR>\n");
          }
          echo("</TD></TR></TABLE>\n");
        }
        if (!empty($errBlk)) {
          echo("<BR>&nbsp;<I>".sprintf(trad("INSTMOD_LIGNE"),$errLig)."</I>\n");
          echo("<TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"100%\" class=\"code\" style=\"color: #006600;\"><TR><TD>\n");
          foreach ($errBlk as $line) {
            preg_match('/^\s+/',$line,$spcFnd);
            echo(preg_replace('/^\s+/',str_repeat("&nbsp;",strlen($spcFnd[0])),htmlentities($line))."<BR>\n");
          }
          echo("</TD></TR></TABLE>\n");
        }
        if (!$desMult) {echo("<FORM method=\"post\" action=\"".$NOM_PAGE."&instmod=1\" name=\"frmAdmModError\" id=\"frmAdmModError\">\n");}
        if ($errCode==324) {  //erreur d'execution sql
          echo("<BR><BR>".$icnWarn.trad("INSTMOD_AVERT_SQL")."<BR><BR>\n");
          echo("<BR><CENTER><INPUT type=\"button\" class=\"Bouton\" name=\"btNoSql\" value=\"".trad("INSTMOD_BT_NOSQL")."\" onclick=\"javascript: document.location.href='".$NOM_PAGE."&instmod=3&nosql=1".(($ckDebug)?"&ckDebug=1":"").(($zroot)?"&zroot=".urlencode($zroot):"")."&fmor=".urlencode($fmor).(($checked)?"&checked=1":"").(($fzip)?"&fzip=".$fZipList:"")."';\">&nbsp;&nbsp;&nbsp;");
        } elseif ($errCode==342 && $upd) {  //le mod existe deja avec une version differente
          if ($warnver) {
            echo("<BR><TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"500\" bgcolor=\"#ff0000\">
            <TR><TD><FONT color=\"#ffffff\"><B>".trad("INSTMOD_AVERT_VERSION")."</B></FONT></TD></TR>
            </TABLE><BR>\n");
          }
          echo("<BR><CENTER><INPUT type=\"button\" class=\"Bouton\" name=\"btMAJ\" value=\"".trad("INSTMOD_BT_MAJ")."\" onclick=\"javascript: document.location.href='".$NOM_PAGE."&instmod=5".(($ckDebug)?"&ckDebug=1":"").(($zroot)?"&zroot=".urlencode($zroot):"")."&fmor=".urlencode($fmor).(($checked)?"&checked=1":"").(($fzip)?"&fzip=".$fZipList:"")."&fmoa=".urlencode($actNom)."';\">&nbsp;&nbsp;&nbsp;");
        } else {
          if ($instmod==4) {  //on est en desinstall
            echo("<BR>".$icnWarn.trad("INSTMOD_DESINST_ANNUL")."<BR>\n");
          } else {
            echo("<BR>".$icnWarn.trad("INSTMOD_INST_ANNUL")."<BR>\n");
          }
          echo("<BR>");
          if (!$desMult) {echo("<CENTER>");}
        }
        if (!$desMult) {
          echo("<SCRIPT language=\"JavaScript\" type=\"text/javascript\">\n");
          echo("<!--\n");
          echo("if (document.getElementById('divPreviewImg') != null)\n");
          echo("  document.getElementById('divPreviewSpc').style.display=\"none\";\n");
          echo("  document.getElementById('divPreviewImg').style.display=\"none\";\n");
          echo("//-->\n");
          echo("</SCRIPT>\n");
          echo("<INPUT type=\"button\" class=\"Bouton\" name=\"btRetour\" value=\"".trad("INSTMOD_BT_RETOUR")."\" onclick=\"javascript: document.frmAdmModError.submit();\"></CENTER>\n");
          echo("</FORM>\n");
        }
      }
    }
    // -------------------------------------------------------------------------

    // --- affichage des instructions du fichier mod pour deboguage ------------
    function affInfoDebug() {
      global $fmor,$modLine;
      echo("<BR><TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"100%\" class=\"code\" style=\"color: #006600;\">\n");
      echo("<TR><TD></TD><TD></TD><TD><B>".trad("INSTMOD_LEGENDE")."</B> :  ");
      // definition des symboles de la legende
      $tabImg=array(1=>array("COPY","evenement/evenement7.gif"),
                    2=>array("SQL","calepin/icq.gif"),
                    3=>array("DIY INSTRUCTIONS","calepin/aim.gif"),
                    4=>array("OPEN","calepin/groupe.gif"),
                    5=>array("FIND","recherche_note.gif"),
                    6=>array("AFTER ADD","suivant_n.gif"),
                    7=>array("BEFORE ADD","precedent_n.gif"),
                    8=>array("REPLACE WITH","recurrent.gif"),
                    10=>array("IN-LINE FIND","recherche_note.gif"),
                    11=>array("IN-LINE AFTER ADD","suivant_n.gif"),
                    12=>array("IN-LINE BEFORE ADD","precedent_n.gif"),
                    13=>array("IN-LINE REPLACE WITH","recurrent.gif"),
                    15=>array("FIND BEGINNING WITH","recherche_note.gif"),
                    99=>array("SAVE/CLOSE","popup_close.gif"));
      foreach ($tabImg as $key=>$value) {
        echo("<IMG src=\"image/".$value[1]."\" alt=\"\" align=\"absmiddle\"> ".$value[0].", ".(($key==7 || $key==13) ? "<BR>" : ""));
      }
      echo("</TD></TR>\n");
      echo("<TR><TD></TD><TD></TD><TD><BR><B>".$fmor."</B></TD></TR>\n");
      //$preCod=$modLine[1][0];
      $preCod=-1;
      for ($i=1;$i<=$modLine[0][0];$i++) {
        if ($preCod!=$modLine[$i][0]) {
          $preCod=$modLine[$i][0];
          $bdTab=" style=\"border-top: solid 1px #D1D7DC;\"";
        } else {
          $bdTab="";
        }
        echo("<TR><TD align=\"right\"".$bdTab."><B>".$i."</B></TD>\n");
        echo("<TD align=\"center\"".$bdTab."><IMG src=\"image/".$tabImg[$modLine[$i][0]][1]."\" alt=\"".$tabImg[$modLine[$i][0]][0]."\"></TD>\n");
        preg_match('/^\s+/',$modLine[$i][1],$spcFnd);
        echo("<TD align=\"left\"".$bdTab.">".($modLine[$i][0]==4 ? "<B>" : "").preg_replace('/^\s+/',str_repeat("&nbsp;",strlen($spcFnd[0])),htmlentities($modLine[$i][1])).($modLine[$i][0]==4 ? "</B>" : "")."</TD></TR>\n");
      }
      echo("</TABLE>\n");
    }
    // -------------------------------------------------------------------------

  // ***************************************************************************


  // ***************************************************************************
  // *** Preparation des variables et affichage de l'entete ********************
  // ***************************************************************************

  // mise au norme des dossiers avec un slash final
  $repSav=verifDossier($repSav);
  $repZip=verifDossier($repZip);
  $repMod=verifDossier($repMod);
  $repScr=verifDossier($repScr);
  $zroot=verifDossier($zroot);

  // si le nom du mod est fourni, on le cherche au bon endroit
  if ($fmor) {
    if ($instmod==4 || $instmod==5 || $instmod==7) { // on est en mode desinstallation(4), mise a jour(5), ou reinstallation(7)
      $fmod=$repMod.$fmor;
    } else {
      $fmod=$repZip.$zroot.$fmor;
    }
  }
 
  // extraction du nom de fichier et son extension
  if (!empty($ztFile)) {
    $fmor=$ztFile_name;
    $fpar=explode(".",$fmor);
    $fext=$fpar[(count($fpar)-1)];
    $fmod=$ztFile;
  }
  if (!$ckVerif && $instmod==2) {$instmod=3;}       // mode verif
  if (!$checked && $instmod==3) {$nchecked=1;}      // mode install
  if ($instmod==4) {$nchecked=2;}                   // mode desinstall
  if ($instmod==5) {$nchecked=($checked ? 2 : 3);}  // mode mise a jour
  if ($instmod==6) {$nchecked=4;}                   // mode desinstall multiple
  if ($instmod==7) {$nchecked=5;}                   // mode reinstall
  if ($instmod==8) {$nchecked=6;}                   // mode reinstall multiple

  // Selection de l'entete de page
  switch ($instmod) {
    case 1: $titrePage=trad("INSTMOD_TITRE_SELECT"); break;
    case 2: $titrePage=trad("INSTMOD_TITRE_VERIF"); break;
    case 3: $titrePage=trad("INSTMOD_TITRE_INSTALL"); break;
    case 4: $titrePage=trad("INSTMOD_TITRE_DESINSTALL"); break;
    case 5: $titrePage=trad("INSTMOD_TITRE_MAJ"); break;
    case 6: $titrePage=trad("INSTMOD_TITRE_DESINSTALL_MULTIPLE"); break;
    case 7: $titrePage=trad("INSTMOD_TITRE_REINSTALL"); break;
    case 8: $titrePage=trad("INSTMOD_TITRE_REINSTALL_MULTIPLE"); break;
  }
  
  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=\"0\" src=\"image/admin/mods.png\">".trad("ADMIN_INST_MOD"),"<B>".sprintf(trad("ADMIN_ETAPE"),($instmod-$nchecked))."</B> - ".$titrePage.($ckDebug ? " <FONT color=\"#ff0000\">(".trad("INSTMOD_TITRE_DEBUG").")</FONT>" : ""));

  echo("<TABLE width=\"100%\" cellspacing=\"2\" cellpadding=\"5\" border=\"0\"><TR><TD>");
  $piedPage = "</TD></TR></TABLE>".$piedPage;
  
  
  // ***************************************************************************
  // *** Phase 1 - Selection du mod ********************************************
  // ***************************************************************************
  if ($instmod==1) {

    // --- purge des fichiers temporaires eventuels ----------------------------
    if (is_dir("./".$repSav)) {
      detruireRep($repSav);
    }
    if (@file_exists($repZip.$fZipList)) {
      $fzip=$fZipList;
      purgerFicTemp("zip");
    }
    // -------------------------------------------------------------------------

    // --- recherche des mods deja installes -----------------------------------
    // lecture de la liste en base
    $tabModsDB=array();
    $DB_CX->DbQuery("SELECT * FROM ${PREFIX_TABLE}mods ORDER BY mod_date, mod_id");
    while ($enr=$DB_CX->DbNextRow()) {
      $tabModsDB[]=$enr;
    }
    // verif si les fichiers sont taggues
    verifTag();
    // verif coherence de chaque mod
    $nbLig=0;
    $nbOk=1;
    $nomMod="";
    $tabMods=array();
    $tabModsDB[]=array();
    $modKo=false;
    $execScript=array();
    foreach ($tabModsDB as $key=>$mod) {
      if ($nomMod!=$mod['mod_nom']) {
        //si le mod est un patch, on l'efface
        if (stristr($nomMod,"patch")!==false && @file_exists($repMod.$nomMod)) {
          $fmod=$repMod.$nomMod;
          purgerFicTemp("mod");
        }
        if ($nomMod=="PXScript" && $execScript['mod_version']==$APPLI_VERSION) {
          //on ne fait rien si c'est un script
        } elseif ($nbLig==$nbOk) {
          //tous les tags ont ete trouves
          $tabMods[]=$tabModsDB[$key-1];
        } elseif ($nbOk==0 && !@file_exists($repMod.$nomMod)) {
          //aucun tag trouve et pas de fichier mod, on efface en base
          $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}mods WHERE mod_nom='".$nomMod."'");
          //evenuellement on supprime le script
          if (@file_exists($repScr.$execScript['mod_fichier'])) {
            $fmod=$repScr.$execScript['mod_fichier'];
            purgerFicTemp("mod");
          }
        } elseif ($nbOk<$nbLig) {
          //certains tags non trouves, on indique une erreur
          $tabModsDB[$key-1]['mod_ok']=-1;
          $tabMods[]=$tabModsDB[$key-1];
          $modKo=true;
        }
        $nomMod=$mod['mod_nom'];
        $nbLig=$nbOk=0;
      }
      // si on doit executer un script
      if ($mod['mod_nom']=="PXScript" && @file_exists($repScr.$mod['mod_fichier'])) {
        $execScript=$mod;
      }
      // si le mod est ok
      if ($mod['mod_ok'] && stristr($nomMod,"patch")===false) {$nbOk++;}
      $nbLig++;
    }

    $nbmod=count($tabMods);
    // -------------------------------------------------------------------------  

    // --- affichage page d'accueil --------------------------------------------
    echo("<BR>");
    // si un script est a executer et que la version est correcte
    if ($execScript['mod_version']==$APPLI_VERSION) {
      echo("<DIV id=\"divScript\" style=\"width:100%; display:block;\">
      <TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"500\" bgcolor=\"#ff0000\">
      <TR><TD><FONT color=\"#ffffff\"><B>".trad("INSTMOD_AVERT_SCRIPT")."</B></FONT></TD></TR>
      </TABLE><BR>
      <SCRIPT language=\"JavaScript\" type=\"text/javascript\">
      <!--
        //Barre de progression durant l'execution de script
        var w3c=(document.getElementById)?true:false;
        var ie=(document.all)?true:false;
        var N=-1;
        var progressBar;

        function CreateProgressBar(w,h,bgc,brdW,brdC,blkC,speed,blocks,count,action){
          if(ie||w3c){
            var t='<br><div id=\"_xpbar'+(++N)+'\" style=\"display:none; position:relative; overflow:hidden;\">';
            t+='<B>".trad("INSTMOD_TRAITEMENT")."</B>';
            t+='<div style=\" position:relative; overflow:hidden; width:'+w+'px; height:'+h+'px; background-color:'+bgc+'; border-color:'+brdC+'; border-width:'+brdW+'px; border-style:solid; font-size:1px;\">';
            t+='<span id=\"blocks'+N+'\" style=\"left:-'+(h*2+1)+'px; position:absolute; font-size:1px\">';
            for(i=0;i<blocks;i++){
              t+='<span style=\"background-color:'+blkC+'; left:-'+((h*i)+i)+'px; font-size:1px; position:absolute; width:'+h+'px; height:'+h+'px; '
              t+=(ie)?'filter:alpha(opacity='+(100-i*(100/blocks))+')':'-Moz-opacity:'+((100-i*(100/blocks))/100);
              t+='\"></span>';
            }
            t+='</span></div></div>';
            document.write(t);
            var bA=(ie)?document.all['blocks'+N]:document.getElementById('blocks'+N);
            bA.bar=(ie)?document.all['_xpbar'+N]:document.getElementById('_xpbar'+N);
            bA.blocks=blocks;
            bA.N=N;
            bA.w=w;
            bA.h=h;
            bA.speed=speed;
            bA.ctr=0;
            bA.count=count;
            bA.action=action;
            bA.togglePause=togglePause;
            bA.showBar=function(){
              this.bar.style.display=\"block\";
            }
            bA.hideBar=function(){
              this.bar.style.display=\"none\";
            }
            bA.tid=setInterval('startBar('+N+')',speed);
            return bA;
          }
        }
        function startBar(bn){
          var t=(ie)?document.all['blocks'+bn]:document.getElementById('blocks'+bn);
          if(parseInt(t.style.left)+t.h+1-(t.blocks*t.h+t.blocks)>t.w){
            t.style.left=-(t.h*2+1)+'px';
            t.ctr++;
            if(t.ctr>=t.count){
              eval(t.action);
              t.ctr=0;
            }
          } else
            t.style.left=(parseInt(t.style.left)+t.h+1)+'px';
        }
        function togglePause(){
          if(this.tid==0){
            this.tid=setInterval('startBar('+this.N+')',this.speed);
          } else {
            clearInterval(this.tid);
            this.tid=0;
          }
        }

        // Execution de script avec barre de progression
        function execScript() {
          document.getElementById('btnScriptExec').disabled=true;
          progressBar.showBar();
          parent.window.frames['trash_".$sid."'].window.location.href = \"".$repScr.$execScript['mod_fichier']."?sid=".$sid."\";
        }
      //-->
      </SCRIPT>
      <TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
      <TR><TD align=\"center\"><BR><B>".$execScript['mod_titre']."</B>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type=\"button\" class=\"Bouton\" name=\"btnScriptExec\" value=\"".trad("INSTMOD_BT_EXECUTER")."\" onclick=\"javascript:if (!this.disabled) {execScript();}\"></TD></TR>
      <TR><TD align=\"center\"><SCRIPT language=\"JavaScript\" type=\"text/javascript\"> progressBar=CreateProgressBar(250,15,'white',1,'#06679F','#06679F',85,7,3,''); </SCRIPT></TD></TR>
      </TABLE>
      </DIV>\n");
    }
    // on affiche les messages d'avertissement
    echo("<DIV id=\"divNoScript\" style=\"width:100%; display:".(($execScript['mod_version']==$APPLI_VERSION)?"none":"block").";\">
    <TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"500\" bgcolor=\"#ff0000\">
    <TR><TD><FONT color=\"#ffffff\"><B>".trad("INSTMOD_AVERT_SAUV")."</B></FONT></TD></TR>
    </TABLE><BR>
    <TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"500\" bgcolor=\"#ff0000\">
    <TR><TD><FONT color=\"#ffffff\"><B>".trad("INSTMOD_AVERT_VERIF")."</B></FONT></TD></TR>
    </TABLE><BR>\n");
    // si un mod est en erreur on affiche un message
    if ($modKo) {
      echo("<BR><TABLE align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <TR><TD>".$icnWarn.trad("INSTMOD_ERR_MOD_INSTALLE")."</TD></TR>
      </TABLE><BR><BR>\n");
    } else {
      // sinon on permet l'install d'un nouveau mod
      echo("<FORM method=\"post\" action=\"".$NOM_PAGE."&instmod=2".(($ckDebug)?"&ckDebug=1":"")."\" name=\"frmAdmModFile\" id=\"frmAdmModFile\" enctype=\"multipart/form-data\">
      <TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
      <TR><TD>".trad("INSTMOD_CHOIX_FICHIER")." : <INPUT type=\"file\" class=\"texte\" name=\"ztFile\" tabindex=\"1\"></TD></TR>
      <TR><TD><INPUT type=\"checkbox\" class=\"Case\" name=\"ckVerif\" value=\"1\" tabindex=\"2\" checked>&nbsp;".trad("INSTMOD_CHOIX_VERIF")."</TD></TR>");
      if ($AFF_INFO_DEBUG) {
        echo("<TR><TD><INPUT type=\"checkbox\" class=\"Case\" name=\"ckDebug\" value=\"1\">&nbsp;".trad("INSTMOD_CHOIX_DEBUG")."</TD></TR>");
      }
      echo("<TR><TD align=\"center\"><BR><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("INSTMOD_BT_CONTINUER")."\" tabindex=\"3\" onclick=\"javascript:if (document.frmAdmModFile.ztFile.value=='') window.alert('".trad("INSTMOD_JS_CHOIX_FICHIER")."'); else document.frmAdmModFile.submit();\"></TD></TR>
      </TABLE></FORM><BR>\n");
    }
    // si au moins 1 mod installe, on affiche la liste
    if ($nbmod>0) {
      // si au moins 2 mods installes, on prepare les options de suppression et reinstallation multiple
      if ($nbmod>1) {
        echo("<FORM method=\"post\" action=\"".$NOM_PAGE."&instmod=6".(($ckDebug)?"&ckDebug=1":"")."\" name=\"frmAdmModSelect\" id=\"frmAdmModSelect\" enctype=\"multipart/form-data\">\n");
      }
      echo("<TABLE align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"500\" class=\"paddingDG3\" style=\"border: solid 1px ".$AgendaBordureTableau.";\">
      <TR><TD colspan=\"3\" align=\"center\" height=\"15\" width=\"100%\" class=\"sousMenu\" style=\"border-bottom: solid 1px ".$AgendaBordureTableau.";\">".sprintf(trad("INSTMOD_TOPO_INSTALL"),$nbmod,($nbmod>1 ? trad("INSTMOD_PLURIEL") : ""))."</TD></TR>\n");
      $iColor=1;
      foreach ($tabMods as $mod) {
        echo("<TR bgcolor=\"".$bgColor[$iColor++%2]."\" height=\"19\">");
        // si au moins 2 mods installes, on affiche les cases a cocher
        if ($nbmod>1) {
          if (@file_exists($repMod.$mod['mod_nom'])) {
            // si le mod est en erreur, on le coche par defaut
            echo("<TD width=\"1%\"><INPUT type=\"checkbox\" class=\"Case\" name=\"selMod".$mod['mod_id']."\" value=\"".$mod['mod_nom']."\"".(($mod['mod_ok']==-1) ? " checked" : "")."></TD>");
          } else {
            echo("<TD></TD>");
          }
        }
        echo("<TD nowrap>".(($mod['mod_ok']==-1)?"<FONT color=\"#ff0000\">":"").sprintf(trad("INSTMOD_MOD_TITRE"),$mod['mod_titre'],$mod['mod_version']).(($mod['mod_ok']==-1)?"</FONT>&nbsp;".$icnWarn:"")."</TD><TD align=\"right\">");
        if (@file_exists($repMod.$mod['mod_nom'])) {
          if ($mod['mod_ok']==-1) {
            echo("<INPUT type=\"button\" class=\"bouton\" name=\"btReins\" value=\"".trad("INSTMOD_BT_R")."\" title=\"".trad("INSTMOD_BT_REINSTALLER")."\" style=\"width:16px\" onclick=\"javascript: if (confirm('".sprintf(trad("INSTMOD_JS_CONFIRME_REINSTALLER"),addslashes($mod['mod_titre']))."')) window.location.href='".$NOM_PAGE."&instmod=7&fmor=".urlencode($mod['mod_nom'])."';\">&nbsp;");
          }
          echo("<INPUT type=\"button\" class=\"bouton\" name=\"btSuppr\" value=\"".trad("INSTMOD_BT_S")."\" title=\"".trad("INSTMOD_BT_SUPPRIMER")."\" style=\"width:16px\" onclick=\"javascript: if (confirm('".sprintf(trad("INSTMOD_JS_CONFIRME_SUPPRIMER"),addslashes($mod['mod_titre']))."')) window.location.href='".$NOM_PAGE."&instmod=4&fmor=".urlencode($mod['mod_nom'])."';\">");
        }
        echo("</TD></TR>\n");
      }
      echo("</TABLE>\n");
      // si au moins 2 mods installes, on affiche l'option de suppression multiple
      if ($nbmod>1) {
        echo("<SCRIPT language=\"JavaScript\" type=\"text/javascript\">
        <!--
        // Fonction de controle de selection de plusieurs checkbox
        function verifSelectCk(_mode) {
          var _checked = 0;
          for (var i=0; i<document.frmAdmModSelect.elements.length; i++) {
            if (document.frmAdmModSelect.elements[i].name.substr(0,6)==\"selMod\") {
              if (document.frmAdmModSelect.elements[i].checked==true) {
                _checked++;
              }
            }
          }
          if (_checked>1) {
            if (_mode==\"suppr\") {
              // suppression
              if (confirm(\"".trad("INSTMOD_JS_CONFIRME_SUPPR_SELECT")."\")) {
                document.frmAdmModSelect.action=\"".$NOM_PAGE."&instmod=6".(($ckDebug)?"&ckDebug=1":"")."\";
                document.frmAdmModSelect.submit();
              }
            } else {
              // reinstallation
              if (confirm(\"".trad("INSTMOD_JS_CONFIRME_REINSTALL_SELECT")."\")) {
                document.frmAdmModSelect.action=\"".$NOM_PAGE."&instmod=8".(($ckDebug)?"&ckDebug=1":"")."\";
                document.frmAdmModSelect.submit();
              }
            }
          } else {
            window.alert(\"".trad("INSTMOD_JS_SELECT_MULTIPLE")."\");
          }
        }
        //-->
        </SCRIPT>
        <TABLE align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"500\">
        <TR><TD align=\"right\">");
        // si un mod est en erreur on affiche le bouton de reinstallation
        if ($modKo) {
          echo("<A onclick=\"javascript: verifSelectCk('reinstall');\" style=\"cursor:pointer;\">".trad("INSTMOD_BT_REINSTALL_SELECT")."</A> - ");
        }
        echo("<A onclick=\"javascript: verifSelectCk('suppr');\" style=\"cursor:pointer;\">".trad("INSTMOD_BT_SUPPR_SELECT")."</A></TD></TR>
        </TABLE>
        </FORM>\n");

      }
      echo("<BR>\n");
    }
    echo("</DIV>\n");
  }
  
  // ***************************************************************************
  // *** Phase 2 - Verification du mod *****************************************
  // ***************************************************************************
  if ($instmod==2) {

    // on verifie les droits pour les dossiers temporaires
    if ($droitsTmp=droitEcriture($repMod)) {
      if ($droitsTmp=droitEcriture($repSav)) {
        if ($droitsTmp=droitEcriture($repZip)) {
          // on lance l'install en mode verif
          $ckVerif=true;
          $instmod=3;
        }
      }
    }
    if (!$droitsTmp) {
      // on affiche l'erreur sur les droits
      echo($icnKo."<FONT color=\"#ff0000\">".trad("INSTMOD_ERR_DROITS")."</FONT><BR>
      <BR><TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"500\" bgcolor=\"#ff0000\">
      <TR><TD><FONT color=\"#ffffff\"><B>".trad("INSTMOD_AVERT_DROITS")."</B></FONT></TD></TR>
      </TABLE><BR>
      <FORM method=\"post\" action=\"".$NOM_PAGE."&instmod=1\" name=\"frmAdmModTmp\" id=\"frmAdmModTmp\">
      <BR><CENTER><INPUT type=\"button\" class=\"Bouton\" name=\"btRetour\" value=\"".trad("INSTMOD_BT_RETOUR")."\" onclick=\"javascript: document.frmAdmModTmp.submit();\"></CENTER>
      </FORM>\n");
    }
  }
  
  // ***************************************************************************
  // *** Phase 3 - Installation du mod *****************************************
  // ***************************************************************************

  // --- processus d'installation ----------------------------------------------
  function procInstall() {
    global $fext,$repZip,$zroot,$fzip,$fZipList,$repMod,$repSav,$fmor,$fmod,$droitsTmp,$icnOk,$icnKo,$icnWarn,$icnIns,$ckVerif,$ckDebug,$instmod,$errCode,$errDtl,$upd,$insMult,$actNom;
    global $mdTit,$mdVer,$mdHis,$mdAut,$mIde,$mdDes,$mdPrv,$mdReq,$mdFic,$modLine,$nosql,$fOrig,$fDest,$instDate,$checked,$nbfic,$diyMsg,$pxPatch,$warnver;
    global $DB_CX,$PREFIX_TABLE,$bgColor,$AgendaBordureTableau,$APPLI_VERSION,$NOM_PAGE;

    // dezippage eventuel
    if ($fext=="zip" && $instmod!=5 && $instmod!=7) {  // on est pas en mise a jour, ni en reinstall
      creerRep($repZip);
      $errCode=dezipperMod($fmod);
      if ($errCode) {
        afficheErreur($errCode);
        if ($droitsTmp) purgerFicTemp("sav");
        purgerFicTemp("zip");
        return; //retour au script principal
      } else {
        $zipped=$icnOk.trad("INSTMOD_OK_ZIP")."<BR>\n";
      }
      $fmor=substr($fmor,0,-3)."txt";
      $fmod=$repZip.$zroot.$fmor;
    }

    // lecture du fichier mod
    $errCode=lectureMod($fmod);
    if ($errCode) {
      afficheErreur($errCode);
      if ($droitsTmp) purgerFicTemp("sav");
      if ($fext=="zip") purgerFicTemp("zip");
      return; //retour au script principal
    } else {
      if (!$insMult) {
        if (!$ckVerif) {
          if (!empty($mdTit)) {echo($icnIns."&nbsp;".sprintf(trad("INSTMOD_MOD_TITRE"),$mdTit,$mdVer)."<BR><BR>");}
        }
        echo($zipped);
        echo($icnOk.trad("INSTMOD_OK_MOD")."<BR>\n");
      }
      // recherche du mod en base
      if ($instmod!=5 && $instmod!=7) {  // on est pas en mise a jour, ni en reinstall
        $DB_CX->DbQuery("SELECT mod_version, mod_nom, mod_date FROM ${PREFIX_TABLE}mods WHERE mod_titre='".addslashes($mdTit)."'");
        if ($DB_CX->DbNumRows()) {
          $errCode=342;
          $errDtl=$DB_CX->DbResult(0,"mod_date");
          $actVer=$DB_CX->DbResult(0,"mod_version");
          $actNom=$DB_CX->DbResult(0,"mod_nom");
          if ($actVer!=$mdVer && @file_exists($repMod.$actNom)) {$upd=true;}
          $checked=1;
        }
      }
      // recap des infos du mod
      if ($ckVerif) {
        echo("<BR><IMG src=\"image/calepin/note.gif\" alt=\"\" align=\"absmiddle\">&nbsp;&nbsp;&nbsp;".trad("INSTMOD_INFO_TROUVE")."<BR>\n");
        echo("<TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"100%\" bgcolor=\"".$bgColor[0]."\" style=\"border: solid 1px ".$AgendaBordureTableau.";\">\n");
        if (empty($mdTit)) {$mdTit=trad("INSTMOD_INFO_NON_TROUVE");}
        echo("<TR><TD align=\"right\" width=\"25%\"><I>".trad("INSTMOD_INFO_TITRE")."</I> : </TD><TD>".$mdTit."</TD></TR>\n");
        if (empty($mdVer)) {$mdVer=trad("INSTMOD_INFO_NON_TROUVE");}
        echo("<TR><TD align=\"right\" valign=\"top\"><I>".trad("INSTMOD_INFO_VERSION")."</I> : </TD>\n");
        if (!empty($mdHis)) {
          echo("<TD onclick=\"javascript:classToggle(document.getElementById('divHist'),'displayNone','displayBlock',document.getElementById('imgHist'),'image/');\" style=\"cursor:pointer;\">".$mdVer."&nbsp;&nbsp;<IMG id=\"imgHist\" src=\"image/expand1.gif\" alt=\"".trad("INSTMOD_INFO_HISTO")."\" align=\"absmiddle\">\n");
          echo("<DIV id=\"divHist\" class=\"displayNone\" style=\"width:100%;\">\n");
          echo("<BR><I><U>".trad("INSTMOD_INFO_HISTO")."</U></I> :<BR>\n");
          // affichage des lignes de l'historique
          foreach ($mdHis as $hist) {
            preg_match('/^\s+/',$hist,$spcFnd);
            echo(preg_replace('/^\s+/',str_repeat("&nbsp;",floor(strlen($spcFnd[0])/2)),htmlentities($hist))."<BR>\n");
            //echo(htmlentities($hist)."<BR>");  // affichage sans identation
          }
          echo("<BR></DIV>\n");
        } else {
          echo("<TD>".$mdVer);
        }
        echo("</TD></TR>\n");
        if (empty($mdAut)) {$mdAut=trad("INSTMOD_INFO_NON_TROUVE");}
        echo("<TR><TD align=\"right\"><I>".trad("INSTMOD_INFO_AUTEUR")."</I> : </TD><TD>".$mdAut."</TD></TR>\n");
        if (!empty($mdIde)) {echo("<TR><TD align=\"right\"><I>".trad("INSTMOD_INFO_IDEE")."</I> : </TD><TD>".$mdIde."</TD></TR>\n");}
        if (empty($mdDes)) {$mdDes[]=trad("INSTMOD_INFO_NON_TROUVE");}
        echo("<TR><TD align=\"right\" valign=\"top\"><I>".trad("INSTMOD_INFO_DESCRIPTION")."</I> : </TD><TD>\n");
          // affichage des lignes de description
          foreach ($mdDes as $desc) {
            if ($desc!="") {
              echo($desc."<BR>\n");
            }
          }
          echo("</TD></TR>\n");
        // affichage de l'image de preview
        if (!empty($mdPrv) && !($errCode && !$upd)) {
          if (@file_exists($repZip.trim($mdPrv))) {
            echo("<TR><TD><DIV id=\"divPreviewSpc\" style=\"display:block;\">&nbsp;</DIV></TD><TD><DIV id=\"divPreviewImg\" style=\"display:block;\"><IMG src=".$repZip.trim($mdPrv)."></DIV></TD></TR>\n");
          }
        }
        if (empty($mdReq)) {$mdReq=trad("INSTMOD_INFO_NON_TROUVE");}
        if (strpos($mdReq,$APPLI_VERSION)===false) {$warnver=true;}
        echo("<TR><TD align=\"right\"><I>".trad("INSTMOD_INFO_PHENIX")."</I> : </TD><TD>".($warnver ? "<FONT color=\"#ff0000\">" : "").$mdReq.($warnver ? "</FONT>&nbsp;".$icnWarn : "")."</TD></TR>\n");
        // affichage de la liste des fichiers
        $mdFic=array();
        for ($i=1;$i<=$modLine[0][0];$i++) {
          if ($modLine[$i][0]==4) {$mdFic[]=trim($modLine[$i][1]);}
        }
        if (!empty($mdFic)) {
          echo("<TR><TD align=\"right\" valign=\"top\"><I>".trad("INSTMOD_INFO_FICHIER")."</I> : </TD><TD>\n");
            // affichage de la liste des fichiers
            foreach ($mdFic as $fic) {
              if ($fic!="") {
                echo($fic."<BR>\n");
              }
            }
            echo("</TD></TR>\n");
        }
        echo("</TABLE><BR>\n");
      }
      // le mod est en base, on propose la mise a jour
      if ($errCode) {
        afficheErreur($errCode);
        // on garde le fichier mod au chaud
        creerRep($repZip.$zroot);
        @move_uploaded_file($fmod,$repZip.$zroot.$fmor);
        if ($droitsTmp) purgerFicTemp("sav");
        if ($fext=="zip" && !$upd) purgerFicTemp("zip");
        if ($ckDebug) {affInfoDebug();}
        return; //retour au script principal
      }
    }

    // installation du mod
    if (!$ckVerif) {creerRep($repSav);}
    $errCode=installMod($nosql);
    if ($errCode) {
      // affichage du detail de l'erreur sauf en installation multiple
      if (!$insMult) {
        afficheErreur($errCode);
      } else {
        echo($icnKo.sprintf(trad("INSTMOD_MOD_TITRE"),$mdTit,$mdVer)."<BR>\n");
        flush();
      }
      if ($errCode==324) {
        // on garde le fichier mod au chaud
        creerRep($repZip.$zroot);
        @move_uploaded_file($fmod,$repZip.$zroot.$fmor);
      } else {
        if ($fOrig) {@fclose($fOrig);}
        if ($fDest) {@fclose($fDest);}
        // restauration des fichiers originaux
        if (!$ckVerif) {restaureSav();}
      }
    } elseif (!$ckVerif) {
      // affichage des statistiques sauf en installation multiple
      if (!$insMult) {
        affStats();
        echo($icnOk.trad("INSTMOD_TERMINE")."<BR><BR>\n");
      } else {
        echo($icnOk.sprintf(trad("INSTMOD_MOD_TITRE"),$mdTit,$mdVer)."<BR>\n");
        flush();
      }
      // on enregistre en base pour chaque fichier sauf si c'est un patch
      if (!$pxPatch) {
        for ($i=1;$i<=$modLine[0][0];$i++) {
          if ($modLine[$i][0]==4) {
            $DB_CX->DbQuery("INSERT INTO ${PREFIX_TABLE}mods (mod_fichier, mod_nom, mod_titre, mod_version, mod_date) VALUES ('".trim($modLine[$i][1])."','".$fmor."','".addslashes($mdTit)."','".$mdVer."','".$instDate."')");
          }
        }
      }
      // on sauvegarde le fichier mod pour plus tard...
      // sauf dans les cas ou aucun fichier n'est modifie, ou on est en reinstall, ou c'est un patch
      if ($nbfic>0 && $instmod!=7 && !$pxPatch) {
        if ($fzip || $nosql || $checked) {
          if (!@rename($fmod,$repMod.$fmor)) {
            @copy($fmod,$repMod.$fmor);
            @unlink($fmod);
          }
        } else {
          @move_uploaded_file($fmod,$repMod.$fmor);
        }
      }
      // affichage du do it yourself sauf en reinstall
      if (!empty($diyMsg) && $instmod!=7) {
        echo($icnWarn.trad("INSTMOD_DIY")." :<BR>
        <TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"100%\" class=\"code\" style=\"color: #006600;\"><TR><TD>\n");
        foreach ($diyMsg as $line) {
          preg_match('/^\s+/',$line,$spcFnd);
          echo(preg_replace('/^\s+/',str_repeat("&nbsp;",strlen($spcFnd[0])),htmlentities($line))."<BR>\n");
        }
        echo("</TD></TR></TABLE><BR><BR>\n");
      }
      if (!$insMult) {  // si on est pas en installation multiple
        echo("<FORM method=\"post\" action=\"".$NOM_PAGE."&instmod=1\" name=\"frmAdmModNew\" id=\"frmAdmModNew\">\n");
        echo("<CENTER><INPUT type=\"button\" class=\"Bouton\" name=\"btNouveau\" value=\"".trad("INSTMOD_BT_NOUVEAU")."\" onclick=\"javascript: document.frmAdmModNew.submit();\"></CENTER>\n");
        echo("</FORM>\n");
      }
    } else {
      // on est en mode verif
      creerRep($repZip.$zroot);
      @move_uploaded_file($fmod,$repZip.$zroot.$fmor);
      echo($icnOk.trad("INSTMOD_VERIF_OK")."<BR><BR>\n");
      if ($warnver) {
        echo("<TABLE align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"500\" bgcolor=\"#ff0000\">
        <TR><TD><FONT color=\"#ffffff\"><B>".trad("INSTMOD_AVERT_VERSION")."</B></FONT></TD></TR>
        </TABLE><BR><BR>\n");
      }
      echo("<FORM method=\"post\" action=\"".$NOM_PAGE."&instmod=3".(($ckDebug)?"&ckDebug=1":"").(($zroot)?"&zroot=".urlencode($zroot):"")."&fmor=".urlencode($fmor)."&checked=1".(($fext=="zip")?"&fzip=".$fZipList:"")."\" name=\"frmAdmModInstall\" id=\"frmAdmModInstall\">\n");
      echo("<CENTER><INPUT type=\"button\" class=\"Bouton\" name=\"btInstall\" value=\"".trad("INSTMOD_BT_INSTALLER")."\" onclick=\"javascript: document.frmAdmModInstall.submit();\">&nbsp;&nbsp;&nbsp;<INPUT type=\"button\" class=\"Bouton\" name=\"btRetour\" value=\"".trad("INSTMOD_BT_RETOUR")."\" onclick=\"javascript: document.location.href='".$NOM_PAGE."&instmod=1';\"></CENTER>\n");
      echo("</FORM>\n");
    }
    // -------------------------------------------------------------------------

    // affichage des infos de deboguage
    if ($ckDebug) {affInfoDebug();}

    // --- purge des fichiers temporaires --------------------------------------
    if ($errCode!=324) {
      if (!$ckVerif || $errCode) purgerFicTemp("sav");
      if ($fzip && (!$ckVerif || ($errCode && !$nosql))) purgerFicTemp("zip");
      elseif (($nosql || $checked) && $instmod!=7) purgerFicTemp("mod");
      if ($errCode && !$nosql) detruireRep($repZip);
    }
  }
  // ---------------------------------------------------------------------------
  
  if ($instmod==3) {
    procInstall();
  }

  // ***************************************************************************
  // *** Phase 4 - Desinstallation du mod **************************************
  // ***************************************************************************
  
  // --- processus de desinstallation ------------------------------------------
  function procDesinstall() {
    global $repSav,$fmor,$fmod,$icnOk,$icnKo,$icnDes,$ckDebug,$mdTit,$mdVer,$nosql,$fOrig,$fDest,$upd,$desMult,$reins,$errCode,$DB_CX,$PREFIX_TABLE,$NOM_PAGE;

    // lecture du fichier mod
    $errCode=lectureMod($fmod);
    if ($errCode) {
      afficheErreur($errCode);
      return; //retour au script principal
    } else {
      if (!$desMult) {
        if (!empty($mdTit)) {echo($icnDes."&nbsp;".sprintf(trad("INSTMOD_MOD_TITRE"),$mdTit,$mdVer)."<BR><BR>\n");}
        echo($icnOk.trad("INSTMOD_OK_MOD")."<BR>\n");
      }
    }

    // generation du script de desinstallation
    $errCode=genereDesinstall($fmor);
    if ($errCode) {
      afficheErreur($errCode);
      return; //retour au script principal
    }

    // desinstallation du mod
    creerRep($repSav);
    $errCode=installMod($nosql);
    if ($errCode) {
      // affichage du detail de l'erreur sauf en desinstallation multiple
      if (!$desMult) {
        afficheErreur($errCode);
      } else {
        echo($icnKo.sprintf(trad("INSTMOD_MOD_TITRE"),$mdTit,$mdVer)."<BR>\n");
        flush();
      }
      if ($fOrig) {@fclose($fOrig);}
      if ($fDest) {@fclose($fDest);}
      // restauration des fichiers originaux
      restaureSav();
    } else {
      // affichage des statistiques sauf en desinstallation multiple
      if (!$desMult) {
        affStats();
        echo($icnOk.trad("INSTMOD_DESINSTALL_TERMINE")."<BR><BR>\n");
      } else {
        echo($icnOk.sprintf(trad("INSTMOD_MOD_TITRE"),$mdTit,$mdVer)."<BR>\n");
        flush();
      }
      // on efface le mod en base
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}mods WHERE mod_nom='".$fmor."'");
      // on efface le fichier mod sauf en reinstall
      if (!$reins) {
        purgerFicTemp("mod");
      }
      // on purge les fichiers de sauvegarde
      purgerFicTemp("sav");

      if (!$upd && !$desMult && !$reins) {  // si on est pas en mise a jour, ni en desinstallation multiple, ni en reinstallation
        echo("<FORM method=\"post\" action=\"".$NOM_PAGE."&instmod=1\" name=\"frmAdmModReturn\" id=\"frmAdmModReturn\">\n");
        echo("<CENTER><INPUT type=\"button\" class=\"Bouton\" name=\"btRetour\" value=\"".trad("INSTMOD_BT_RETOUR")."\" onclick=\"javascript: document.frmAdmModReturn.submit();\"></CENTER>\n");
        echo("</FORM>\n");
      }
    }

    // affichage des infos de deboguage
    if ($ckDebug) {affInfoDebug();}

  }
  // ---------------------------------------------------------------------------

  if ($instmod==4) {
    procDesinstall();
  }

  // ***************************************************************************
  // *** Phase 5 - Mise a jour du mod ******************************************
  // ***************************************************************************
  if ($instmod==5) {

    // on passe en mode desinstallation
    $instmod=4;
    $upd=true;
    // on sauve les infos de mise a jour
    $fmor_new=$fmor;
    $fmor=$fmoa;
    $fmod=$repMod.$fmor;
    // desinstallation de l'ancien mod
    procDesinstall();

    // si pas d'erreur de desinstall, on install la maj
    if (!$errCode) {
      echo("<BR>\n");

      // on renseigne l'emplacement du nouveau mod
      $fmor=$fmor_new;
      $fmod=$repZip.$zroot.$fmor;
      // on revient en mode mise a jour
      $instmod=5;
      // installation du nouveau mod
      procInstall();
    }
    
  }
  
  // ***************************************************************************
  // *** Phase 6 - Desinstallation multiple ************************************
  // ***************************************************************************
  if ($instmod==6) {

    echo($icnDes."&nbsp;<B>".trad("INSTMOD_TITRE_DESINSTALL_MULTIPLE")." :<B><BR><BR>\n");

    // on passe en mode desinstallation
    $instmod=4;
    $desMult=true;

    // desinstallation des mods selectionnes dans l'ordre inverse
    $listVar=array_keys($GLOBALS);
    for ($i=count($listVar)-1;$i>=0;$i--) {
      if (substr($listVar[$i],0,6)=="selMod") {
        $fmor=$GLOBALS[$listVar[$i]];
        $fmod=$repMod.$fmor;
        procDesinstall();
      }
    }

    // on affiche le bouton de retour
    echo("<BR><FORM method=\"post\" action=\"".$NOM_PAGE."&instmod=1\" name=\"frmAdmModReturn\" id=\"frmAdmModReturn\">\n");
    echo("<CENTER><INPUT type=\"button\" class=\"Bouton\" name=\"btRetour\" value=\"".trad("INSTMOD_BT_RETOUR")."\" onclick=\"javascript: document.frmAdmModReturn.submit();\"></CENTER>\n");
    echo("</FORM>\n");

  }

  // ***************************************************************************
  // *** Phase 7 - Reinstallation du mod ***************************************
  // ***************************************************************************
  if ($instmod==7) {

    // on passe en mode desinstallation
    $instmod=4;
    $reins=true;
    // desinstallation du mod
    procDesinstall();

    // si pas d'erreur de desinstall, on reinstall
    if (!$errCode) {
      echo("<BR>\n");

      // on revient en mode reinstallation
      $instmod=7;
      $nosql=true;  // pas besoin de sql puisque c'est la meme version du mod
      // reinstallation du mod
      procInstall();
    }

  }

  // ***************************************************************************
  // *** Phase 8 - Reinstallation multiple *************************************
  // ***************************************************************************
  if ($instmod==8) {

    echo($icnDes."&nbsp;<B>".trad("INSTMOD_TITRE_DESINSTALL_MULTIPLE")." :</B><BR><BR>\n");

    // on passe en mode desinstallation
    $instmod=4;
    $desMult=true;
    $reins=true;

    // desinstallation des mods selectionnes dans l'ordre inverse
    $listVar=array_keys($GLOBALS);
    for ($i=count($listVar)-1;$i>=0;$i--) {
      if (substr($listVar[$i],0,6)=="selMod") {
        $fmor=$GLOBALS[$listVar[$i]];
        $fmod=$repMod.$fmor;
        procDesinstall();
        // si la desinstall est en erreur on supprime le mod de la reinstall
        if ($errCode) {
          unset($GLOBALS[$listVar[$i]]);
        }
      }
    }

    echo("<BR><BR>".$icnIns."&nbsp;<B>".trad("INSTMOD_TITRE_REINSTALL_MULTIPLE")." :</B><BR><BR>\n");

    // on revient en mode reinstallation
    $instmod=7;
    $insMult=true;
    $nosql=true;  // pas besoin de sql puisque c'est la meme version du mod
    // reinstallation des mods selectionnes sauf ceux en erreur de desinstall
    foreach ($GLOBALS as $key=>$value) {
      if (substr($key,0,6)=="selMod") {
        $fmor=$value;
        $fmod=$repMod.$fmor;
        procInstall();
      }
    }

    // on affiche le bouton de retour
    echo("<BR><FORM method=\"post\" action=\"".$NOM_PAGE."&instmod=1\" name=\"frmAdmModReturn\" id=\"frmAdmModReturn\">\n");
    echo("<CENTER><INPUT type=\"button\" class=\"Bouton\" name=\"btRetour\" value=\"".trad("INSTMOD_BT_RETOUR")."\" onclick=\"javascript: document.frmAdmModReturn.submit();\"></CENTER>\n");
    echo("</FORM>\n");

  }

}
?>
