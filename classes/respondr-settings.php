<?php

class respondrSettings {
	
	function __construct() {
		add_action( 'admin_menu', array( $this, 'respondrMenus' ) );
	}
	
	function respondrMenus(){
		add_options_page( 'Respondr', 'Respondr', 'manage_options', 'respondr.php', array( $this, 'respondrSettingsMenu' ), 'dashicons-analytics', 95 );	
	}
	
	function respondrSettingsMenu() {
		// POST ACTION
		if( isset($_POST) && !empty( $_POST['siteId'] ) ){
			$siteId = $_POST['siteId'];
			
			if ( get_option( 'respondr_siteid' ) !== false ) {
				$update = update_option( 'respondr_siteid', $siteId );
			} else {
				$update = add_option( 'respondr_siteid', $siteId );
				var_dump( $siteId );
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
							echo '<label for="siteId">Site Id</label><br/>';
						echo '</td>';
						echo '<td>';
							echo '<input name="siteId" type="text" size="50" required placeholder="siteId" ';
								if( isset( $currentID ) ) { echo 'value="'.$currentID.'"';}
							echo ' /><br/>';
							echo '<span class="description">Site Id can be found under Account Settings > Sites at www.respondr.io.</span>';
						echo '</td>';
					echo '</tr>';
					echo '<tr><td colspan="2">';
						echo '<p class="submit"><input type="submit" class="buuton button-primary" value="Save Settings" /></p>';
						echo '<p>Don\'t have a Respondr account? <a target="_blank" href="https://signup.respondr.io">Sign up</a>.</p>';
					echo '</td></tr>';
				echo '</table>';
			echo '</form>';
		echo '</div>';
	}
}

?>