<?php
 /*
   Plugin Name: YS Sanitize Output
   Plugin URI:  http://www.ysahin.com/wp-plugins/sanitize-output
   Description: Removes white spaces and tabs from html, css and javascript in your sites html output. Reduces your page size by about 30%.
   Version: 1.0
   Author: ysahin
   Author URI: http://ysahin.com
   License: GPL2
   */

function ysSanitizeOutput_load () {
	ob_start("ysSanitizeOutput_process");
}
function ysSanitizeOutput_process($buffer){
	$search = array(
        '/\>[^\S ]+/s',  
        '/[^\S ]+\</s',  
        '/(\s)+/s',
        '/<!--(.*)-->/Uis',    
        '/\/\*(.*)\*\//Uis', 
    );
    $replace = array(
        '>',
        '<',
        '\\1',
        '',
        ''
    );	
    $buffer = preg_replace($search, $replace, $buffer);
    $buffer = str_replace(': ', ':', $buffer);
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}
add_action( 'get_header', 'ysSanitizeOutput_load' );
?>
