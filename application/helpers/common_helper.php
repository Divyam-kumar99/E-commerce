<?php

    function resizeimage($source_path,$new,$w,$h){
        // this couldnot be used in helper
        $CI =& get_instance();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_path;
        $config['new_image'] = $new;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] =TRUE;
        $config['width']         =$w;
        $config['height']       =$h;
        $config['thumb_marker']  =""; //to remove _thumb from the img name in thumb folder

        $CI->load->library('image_lib');
        $CI->image_lib->initialize($config);
        $CI->image_lib->resize();
        $CI->image_lib->clear();
        // echo $CI->image_lib->display_errors();
        // exit; //to display errors
    
}
?>