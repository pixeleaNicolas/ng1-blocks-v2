<?php
/**
 * Plugin Name:       Ng1 Blocks V2
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.6
 * Requires PHP:      7.2
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ng1-blocks-v2
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function create_block_ng1_blocks_v2_block_init() {
	// Récupère tous les sous-dossiers dans /build
	$block_folders = glob(__DIR__ . '/build/*', GLOB_ONLYDIR);
	
	// Enregistre chaque bloc trouvé
	foreach ($block_folders as $block_folder) {
		// Vérifie la présence des fichiers requis
		$required_files = array(
			'block.json',
			'index.js',
			'style-index.css'
		);
		
		$files_exist = true;
		foreach ($required_files as $file) {
			if (!file_exists($block_folder . '/' . $file)) {
				$files_exist = false;
				error_log('Fichier manquant pour le bloc ' . basename($block_folder) . ': ' . $file);
				break;
			}
		}
		
		// Enregistre le bloc uniquement si tous les fichiers sont présents
		if ($files_exist) {
			register_block_type($block_folder);
		}
	}
}
add_action('init', 'create_block_ng1_blocks_v2_block_init');
