<?php
	include("verifAuth.php");
?>
<div>

	<h2 style="text-align:center">Gestion du site</h2>

    <br />

    <h2 style="text-align:center;color:red;">/!\ SEUL UN INFORMATICIEN QUI SAIT CE QU'IL FAIT EST HABILITE A MODIFIER LES PARAMETRES CI-DESSOUS. CEUX-CI GERENT L'ENSEMBLE DE LA CONFIGURATION DU SITE. /!\<br /><br /><u>/!\ LE MIEUX EST DE QUITTER CETTE PAGE AU PLUS VITE ! /!\</u></h2>
    
    <script type="text/javascript" src="gestion_site_js.js"></script>
    <br />
    
    <p>
        <input type="button" id="btn_redim" value="Redimensionner les images" onclick="redimensionner();" />
        <span id="loader"></span>
    </p>
    
   	<div>
    <br />
    
    	<h3>Configuration du site</h3>
        
        <br />
        
        <?php
		
        $config = simplexml_load_file('../libs/config.xml');
		
		
		echo '<form method="post" action="save_config.php">
		<label for="modee">Modification du mode : </label>
		<select id="modee" onchange="change_mode(this.value);">';
		
		$mode = $config->mode;
		
		foreach($config->children() as $m)
		{
			if($m->getName() != "mode")
			{
				if($mode == $m->getName())
					echo '<option selected="selected" value="' . $m->getName() . '">' . $m->getName() . '</option>';
				else
					echo '<option value="' . $m->getName() . '">' . $m->getName() . '</option>';
			}
		}
        
        echo '</select><br /><br />
		
		<label for="mode">Utiliser le mode : </label>
		<select name="mode" id="mode">';
		
		foreach($config->children() as $m)
		{
			if($m->getName() != "mode")
			{
				if($mode == $m->getName())
					echo '<option selected="selected">' . $m->getName() . '</option>';
				else
					echo '<option>' . $m->getName() . '</option>';
			}
		}
		
		echo '</select><br /><br />';
		
		
		function liste($name, $v)
		{
			$lst_true = '<select name="' . $name . '"><option value="true" selected="selected">Oui</option><option value="false">Non</option></select>';
			$lst_false = '<select name="' . $name . '"><option value="true">Oui</option><option value="false" selected="selected">Non</option></select>';
			
			$tmp = 'lst_' . $v;
			
			return $$tmp;
		}
		
		
		$tab_true_false = array('true', 'false');
		
		
		foreach($config->children() as $m)
		{
			if($m->getName() != "mode")
			{
				$m = $m->getName();
				
				echo '<table id="' . $m . '"';
				
				if($mode != $m)
					echo ' style="display:none"';
				
				echo '>
						<tr>
							<th>Nom</th>
							<th>Valeur</th>
						</tr>';
				
				foreach($config->$m->children() as $child)
				{
					echo '<tr>
							<td>' . $child->getName() . '</td>
							<td>';
							
					$val = (string) $child;
  
					
					if(in_array($val, $tab_true_false))
					{
						$tmp = 'lst_' . $val;
						
						echo liste(($child->getName() . '_' . $m), $val);
					}
					else
						echo '<input type="text" name="' . $child->getName() . '_' . $m .'" size="' . (strlen($val) + 5) . '" value="' . $val . '" />';
							
					echo '</td>
						</tr>';
				}
				
				echo '</table>';
			}
			
		}
		
		
		echo '<input type="submit" value="Enregistrer" />
			<input type="hidden" name="config" />
		</form>';

		unset($config);
        
        ?>
    
    </div>
    
</div>

