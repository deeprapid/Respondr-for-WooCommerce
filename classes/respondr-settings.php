<?php

class respondrSettings {
	
	function __construct() {
		add_action('admin_menu', array($this, 'respondrMenus'));
	}
	
	function respondrMenus(){
		add_menu_page('Respondr', 'respondr', 'manage_options', 'respondr.php', array($this, 'respondrSettingsMenu'), 'dashicons-analytics', 90);
	}
	
	function respondrSettingsMenu() {
		// POST ACTION
		if(isset($_POST) && !empty($_POST['siteId'])){
			$siteId = $_POST['siteId'];
			
			if (get_option('respondr_siteid') !== false) {
				$update = update_option('respondr_siteid', $siteId);
			} else {
				$update = add_option('respondr_siteid', $siteId);
			}
			
			if($update) {
				echo '<div class="updated"><p>Settings saved.</p></div>';
			} else {
				echo '<div class="error"><p>An error ocurred.</p></div>';
			}
		}
		
		// GET CURRENT SITEID
        $currentID = get_option('respondr_siteid');

		// FORM
		echo '<div class="wrap">';
			echo '<h2>Respondr Settings</h2>';
			echo '<form method="post">';
				echo '<table class="form-table">';
					echo '<tr>';
						echo '<td>';
							echo '<label for="siteId">Site ID</label><br/>';
						echo '</td>';
						echo '<td>';
							echo '<input name="siteId" type="text" required placeholder="Site ID" value="' . ($currentID ?: '') . '">';
							echo '<br />';
							echo '<span class="description">Site ID can be found in your Respondr dashboard.</span>';
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
                        echo '<td colspan="2">';
						    echo '<p class="submit"><input type="submit" class="button button-primary" value="Save Settings"/></p>';
					    echo '</td>';
                    echo '</tr>';
				echo '</table>';
			echo '</form>';
		echo '</div>';
	}
}
