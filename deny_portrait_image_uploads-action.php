<?php
/**
 * Plugin Name: Deny Portrait Image Uploads
 * Description: Prevents Uploads of images greater than 2048px width (Works Natively)
 * Version:     1.3.0
 * Author:      spix
 * Author URI:  https://github.com/spix18/Deny-Portrait-Image-Uploads-For-WordPress
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 */

function spix_deny_portrait_images($file){
    $type = explode('/',$file['type']);

    if($type[0] == 'image'){
        list( $width, $imagetype, $hwstring, $mime, $rgb_r_cmyk, $bit ) = getimagesize( $file['tmp_name'] );
        if($width > 2048){ // I added 100,000 as sometimes there are more rows/columns than visible pixels depending on the format
            $file['error'] = '<p style="color:red;">This image is portrait, resize it or take a landscape photo before sending it, ideally below 2048px.</p>';
        }
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter','spix_deny_portrait_images');