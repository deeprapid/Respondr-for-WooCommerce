<?php

class respondrSettings {
	
	function __construct() {
		add_action( 'admin_menu', array( $this, 'respondrMenus' ) );
	}
	
	function respondrMenus(){
		add_menu_page( 'Respondr', 'respondr', 'manage_options', 'respondr.php', array( $this, 'respondrSettingsMenu' ), 'dashicons-analytics', 90 );	
	}
	
	function respondrSettingsMenu() {
		// POST ACTION
		if( isset($_POST) && !empty( $_POST['idsite'] ) ){
			$idsite = $_POST['idsite'];
			
			if ( get_option( 'respondr_siteid' ) !== false ) {
				$update = update_option( 'respondr_siteid', $idsite );
			} else {
				$update = add_option( 'respondr_siteid', $idsite );
				var_dump( $idsite );
			}
			
			if( $update ) {
				echo '<div class="updated"><p>Settings saved.</p></div>';
			} else {
				echo '<div class="error"><p>An error ocurred</p></div>';
				var_dump( $update );
			}
		}
		
		// GET CURRENT SITEID
		if( get_option( 'respondr_siteid' ) ) {
			$currentID = get_option( 'respondr_siteid' );
		}
	
		// FORM
		echo '<div class="wrap">';
			echo '<h2>Respondr Settings</h2>';
			
			echo '<form method="post">';
				echo '<table class="form-table">';
					echo '<tr>';
						echo '<td>';
							echo '<label for="idsite">IDSITE</label><br/>';
						echo '</td>';
						echo '<td>';
							echo '<input name="idsite" type="number" required placeholder="IDSITE" ';
								if( isset( $currentID ) ) { echo 'value="'.$currentID.'"';}
							echo ' /><br/>';
							echo '<span class="description">IDSITE can be found in your Respondr dashboard</span>';
						echo '</td>';
					echo '</tr>';
					echo '<tr><td colspan="2">';
						echo '<p class="submit"><input type="submit" class="buuton button-primary" value="Save Settings" /></p>';
					echo '</td></tr>';
				echo '</table>';
			echo '</form>';
		echo '</div>';
	}
}

?>