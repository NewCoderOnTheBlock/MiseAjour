<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" /> 
<title>Interface stagiaire</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="scripts/maj_note.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
</head>

<body>

<div id="corps">

    <div id="menu">
    
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="index.php?p=10">Déconnexion</a></li>
  <li><a href="index3.php?p=1">gérer les news</a></li>
</ul>
      
      <script type="text/javascript">


var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</div>
	<div id="contenu">
	<?php 
	if($_SESSION['user_type']!="s"){
		?>
        <script type="text/javascript">
            <!--
            window.location.replace("index.php?p=10");
            -->
            </script>
        <?php
		
	}
	else{
	
	
		switch ($_GET['p']) {	
					case 1:
						require("manage_news_stg.php");
						break;
                    case 2:
                        require("manage_cat_news_stg.php");
                        break;
					default :
						require("manage_news_stg.php");
						break;
					
		}
	}

		?>
    
    
    </div>

</div>


</body>
</html>