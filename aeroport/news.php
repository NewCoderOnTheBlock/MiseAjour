<?php

	session_start();

	require_once('includes/tpl_base.php');


	// le fil d'ariane

	$tab_ariane = array(
						array(
							'ARIANE' => $ariane_accueil,
							'LIEN' => 'index.html'
							),
						array(
							'ARIANE' => $speed_news,
							'LIEN' => ''
							)
						);

	foreach($tab_ariane as $tab)
	{
		$tpl->setBlock('fil', array(
									'ARIANE' => $tab['ARIANE'],
									'LIEN' => $tab['LIEN']
									)
						);
	}


    if(isset($_GET['cat']) && is_numeric($_GET['cat']))
        $_POST['cat'] = intval($_GET['cat']);

    if(isset($_GET['news']) && is_numeric($_GET['news']))
    {
        $tab_n = get_une_news(intval($_GET['news']));

        $tpl->set(array(
                        "PUBLIE_LE" => $publie_le,
                        "TYPE" => "UNE",
                        "TITRE_PAGE" => $speed_news,
                        "TITRE" => $tab_n['TITRE'],
                        "DATE" => $tab_n['DATE'],
                        "TEXTE" => $tab_n['TEXTE'],
                        "CAT" => $tab_n['CAT'],
                        "ID_CAT" => $tab_n['ID_CAT'],
                        "DANS" => $dans
                        )
                );
    }
    else
    {
        $cat = (isset($_POST['cat'])) ? intval($_POST['cat']) : "";

        $nb_news = get_nb_news($cat);

        $nb_par_page = 3;
        $nb_pages = ceil($nb_news / $nb_par_page);

        $nb_pages = ($nb_pages == 0) ? 1 : $nb_pages;


        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? intval($_GET['page']) : 1;

        $page = ($page > $nb_pages) ? 1 : $page;

        $deb = ($page - 1) * $nb_par_page;
        $fin = $nb_par_page;



        $p_courante = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

        $tab_pagination = pagination($p_courante, $nb_pages);

        for($i = 0; $i < count($tab_pagination); $i++)
            $tpl->setBlock('pagination', 'PAGE', $tab_pagination[$i]);


        $tpl->set(array(
                    "PAGE" => $page,
                    "PRECEDENT" => $page - 1,
                    "SUIVANT" => $page + 1,
                    "NB_PAGE" => $nb_pages
                    )
                );



        foreach(get_news($deb, $fin, $cat) as $tab)
        {
            $tpl->setBlock('news', array(
                                        'TITRE' => $tab['TITRE'],
                                        'TEXTE' => $tab['TEXTE'],
                                        'DATE' => $tab['DATE'],
                                        'CAT' => $tab['CAT'],
                                        'ID_CAT' => $tab['ID_CAT']
                                        )
                            );
        }


        $tpl->set(array(
                        "TITRE_PAGE" => $speed_news,
                        "TXT_NB_MESSAGE" => $txt_nb_message,
                        "PAGE_PRECEDENT" => $page_precedent,
                        "PAGE_SUIVANT" => $page_suivant,
                        "PUBLIE_LE" => $publie_le,
                        "TYPE" => "TOUS",
                        "DANS" => $dans,
                        "CHOIX_CAT" => $choix_categorie,
                        "LST_CAT" => get_lst_cat(),
                        "CAT_CHERCHER" => $cat
                        )
                );
    }

    $tpl->parse("aeroport/news.html");

?>
