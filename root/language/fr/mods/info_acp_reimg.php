<?php
/**
*
* reimg [French]
*
* @package language
* @copyright (c) 2011 DavidIQ.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// NOTE TO TRANSLATORS:  Text in parenthesis refers to keys on the keyboard

$lang = array_merge($lang, array(
	'ACP_CAT_REIMG'					=> 'ReIMG Image Resizer',
	'ACP_REIMG_CONFIG'				=> 'ReIMG Image Resizer configuration',
	'ACP_REIMG_CONFIG_EXPLAIN'		=> 'ReIMG Image Resizer redimensionne les images côté client en utilisant JavaScript et utilise divers effets pour agrandir les images.',

	'REIMG_VERSION'					=> 'Version ReIMG',
	'REIMG_ENABLE'					=> 'Activer ReIMG Image Resizer',
	'REIMG_OPTIONS'					=> 'Options ReIMG Image Resizer',
	'REIMG_SETTINGS'				=> 'Paramètres Image resize',
	'REIMG_MAX_SIZE'				=> 'Dimensions maXimaleS de l\'imAGE',
	'REIMG_MAX_SIZE_EXPLAIN'		=> 'Si l\'image est plus grande que la taille maximum, elle sera redimenssionnée, mettre 0 pour désactiver le redimensionnement horizontal et ou vertical.',
	'REIMG_REL_WIDTH'				=> 'Largeur maximale de l\'image',
	'REIMG_REL_WIDTH_EXPLAIN'		=> 'Si l\'image est plus grande que la largeur maximum, elle sera redimenssionnée, mettre 0 pour pour désactiver le redimenssionnement.',
	'REIMG_SWAP_PORTRAIT'			=> 'Taille originale paysage et portrait',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'	=> 'Si des dimensions légèrement infèrieures aux maximales sont appliquées pour des images de type paysage ou portrait, elles seront quand même redimensionnées',
	'REIMG_LINK_METHOD'				=> 'Zoom',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'Selectionnez la méthode pour zoomer',

	'reimg_linking_methods'			=> array(
		'button'			=> 'Bouton de zoom',
		'link'				=> 'Lien externe',
		'button_link'		=> 'Les deux',
	),

	'REIMG_ZOOM_METHOD'				=> 'Choisissez la méthode pour zoomer',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Sélectionnez la méthode pour afficher l\'original<br /><br />NOTE: Si vous souhaitez désactiver une sélection, suivez les instructions qui apparaissent à côté de la description.',

	'reimg_zooming_methods'			=> array(
		'_blank' 		=> 'Nouvelle fenêtre',
		'_default' 		=> 'Par défaut',
		'_exturl' 		=> 'Lien externe',
		'_litebox' 		=> 'Litebox',
		'_litebox1'		=> array(
								'Cliquer sur l\'image pour zoomer.',
								'Litebox 1:1',
							),
		'_highslide'	=> array(
								'Utilisez le lien pour télécharger le pack Highslide JS ZIP, puis placer le dossier <em>highslide</em> dans le répertoire <em>reimg</em>.',
								'<a href="http://highslide.com/download.php" style="text-decoration: underline;">Highslide</a>',
							),
		'_lytebox'		=> array(
								'Utiliser le lien pour télécharger le pack Lytebox ZIP, puis dézipper <em>lytebox</em> dans un dossier vide et placer dans le répertoire <em>reimg</em>. Pour une compatibilité avec IE9, le TAG X-UA-Compatible doit être modifié dans overall_header.html.',
								'<a href="http://www.dolem.com/lytebox/" style="text-decoration: underline;">Lytebox</a>',
							),
	),

	'REIMG_IGNORE_SIG_IMG'			=> 'Ignorez les images dans les signatures',
	'REIMG_IGNORE_SIG_IMG_EXPLAIN'	=> 'Si activé, les images dans les signatures ne seront pas redimenssionnées',
	'REIMG_ATTACHMENTS'				=> 'Activez ReIMG pour les images en fichiers joints',
	'REIMG_ATTACHMENTS_EXPLAIN'		=> 'Désactivez la création des vignettes lorsque l\'image est appliquée. (non rétroactif, à savoir quee les anciennes pièces jointes ne seront pas affectées, si vous modifiez ce paramètre)',

	'REIMG_UPDATED'					=> 'Les paramètres ReIMG Image Resizer ont été mis à jour.',

	'LOG_REIMG_UPDATED'				=> '<strong>Paramètres de mise à jour de ReIMG Image Resizer</strong>',
));

$lang = array_merge($lang, array(
	'acl_a_reimg'	=> array('lang' => 'Gestion des paramètres de ReIMG Image Resizer', 'cat' => 'Paramètres')
));

