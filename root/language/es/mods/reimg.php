<?php
/**
*
* reimg [Spañish] traducido por: fagndark
*
* @package language
* @version $Id: reimg.php 8775 2009-06-05 09:30:12Z DavidIQ $
* @copyright (c) 2009 DavidIQ.com
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
	'LOADING_TEXT'			=> 'Cargando...',
	'LOADING_TITLE'			=> 'Click para cancelar',
	'FOCUS_TITLE'			=> 'Click para traer al frente',
	'FULL_EXPAND_TITLE'		=> 'Expandir al tamaño real (f)',
	'CREDITS_TEXT'			=> 'Powered by <i>Highslide JS</i>',
	'CREDITS_TITLE'			=> 'Ir a la página de Highslide JS',
	'PREVIOUS_TEXT'			=> 'Anterior',
	'NEXT_TEXT'				=> 'Siguiente',
	'MOVE_TEXT'				=> 'Mover',
	'CLOSE_TEXT'			=> 'Cerrar',
	'CLOSE_TITLE'			=> 'Cerrar (esc)',
	'RESIZE_TITLE' 			=> 'Redimencionar',
	'PLAY_TEXT' 			=> 'Iniciar',
	'PLAY_TITLE' 			=> 'Iniciar slideshow (barra espaciadora)',
	'PAUSE_TEXT' 			=> 'Pausa',
	'PAUSE_TITLE' 			=> 'Pausar slideshow (barra espaciadora)',
	'PREVIOUS_TITLE' 		=> 'Anterior (flecha izquierda)',
	'NEXT_TITLE' 			=> 'Siguiente (flecha derecha)',
	'MOVE_TITLE' 			=> 'Mover',
	'IMAGE_NUMBER' 			=> 'Imagen %1 de %2',
	'RESTORE_TITLE' 		=> 'Click para cerrar la imagen, arrastrar para mover. Use las flechas derecha e izquierda para siguiente y anterior.',
	
	'REIMG_SETTINGS'				=> 'Ajustes de tamaño de imagen',
	'REIMG_MAX_SIZE'				=> 'Dimensiones máximas de imagen',
	'REIMG_MAX_SIZE_EXPLAIN'		=> 'Cuando una imagen es más grande que esto se redimensionará. Poner a 0 para desactivar el redimensionado horizontal y/o vertical.',
	'REIMG_REL_WIDTH'				=> 'Ancho máximo relativo de la imagen',
	'REIMG_REL_WIDTH_EXPLAIN'		=> 'Cuando una imagen es más ancha que esto, se redimensionará. Poner a 0 para ignorar el ancho relativo.',
	'REIMG_SWAP_PORTRAIT'				=> 'Normalizar horizontal/vertical',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'		=> 'Si se establece en si las dimensiones máximas se aplicarán holgadamente, pero el tamaño vertical y horizontal se redimensionará en la misma proporción. Si se establece en no, el ancho y/o alto se forzarán estrictamente.',
	'REIMG_LINK_METHOD'				=> 'Zooming link',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'Select the method that is used to link to the original, larger image.',
	'REIMG_LINK_BUTTON'				=> 'Zooming button',
	'REIMG_LINK_IMAGE'				=> 'Link resized image',
	'REIMG_LINK_BOTH'				=> 'Both',
	'REIMG_ZOOM_BLANK'				=> 'Ventana nueva',
	'REIMG_ZOOM_DEFAULT'				=> 'Enlace normal',
	'REIMG_ZOOM_EXTURL'				=> 'Enlace externo',
	'REIMG_ZOOM_LITEBOX'				=> 'Lightbox',
	'REIMG_ZOOM_LITEBOX_1_1'			=> 'Lightbox 1:1',
	'REIMG_ZOOM_LITEBOX_RESIZED'			=> 'Lightbox redimencionado',
	'REIMG_ZOOM_HIGHSLIDE'			=> 'Highslide',
	'REIMG_ZOOM_METHOD'				=> 'Método zoom',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Seleccione el método que se usará para enlazar a la imagen original más grande.<br/>NOTA en Highslide: Si desea usar Highslide, note por favor que  primero debe descargar el paquete ZIP Highslide de <a href="http://highslide.com/download.php">aquí</a> y colocar los archivos descomprimidos del <em>highslide</em> en el directorio <em>reimg/highslide</em> de su foro.',
	'REIMG_IGNORE_SIG_IMG'			=> 'Ignorar imagenes en firmas',
	'REIMG_IGNORE_SIG_IMG_EXPLAIN'	=> 'Si se establece en si entonces las imagenes en firmas no se redimencionarán.',
	
	'IMG_ICON_REIMG_LOADING'		=> 'Loading',
	'IMG_ICON_REIMG_ZOOM_IN'	=> 'Acercar',
	'IMG_ICON_REIMG_ZOOM_OUT'	=> 'Alejar',
	
	'REIMG_ZOOM_IN'				=> 'Acercar (dimensiones reales: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'			=> 'Alejar',
));

?>