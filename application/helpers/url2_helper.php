<?php

function is_ajax() {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
        return true;
    }

    return false;
}

function check_is_set($field_name) {
    if (isset($_POST[$field_name]) && $_POST[$field_name] != 0)
        return true;

    return false;
}

function pre_print($obj, $with_exit = true) {
    echo "<pre>";
    print_r($obj);
    if ($with_exit)
        exit;
}

function get_seeker_job_template() {
    return ' - <a target="_blank" href="' . base_url()
            . 'ef/profile/view_vacancy/' . '%s'
            . '" style="color: rgb(40, 144, 182);">' . '%s'
            . '</a> - ' . '%s';
}

function save_url() {

    $urls = UrlsTable::getList();

    if ($urls) {
        $php_code = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
";
        foreach ($urls as $url) {
            $php_code.=sprintf(ROUTS_ITEM_TEMPLATE, $url['routed'], $url['url_prefix']) . '
';
        }
    }
    file_put_contents('application/config/auto_routes.php', $php_code);
}

function get_routed_url($url_original) {
    global $route;
    $url_routed = array_search($url_original, $route);
    if ($url_routed) {
        return site_url($url_routed);
    }

    return site_url($url_original);
}

function print_meta_data($url, $page_title) {
    $meta = '';

    if ($url) {
        $meta.='<meta name="description" content="' . $url['meta_description'] . '" />
        <meta name="keywords" content="' . $url['meta_keywords'] . '" />
        <meta name="title" content="' . $url['meta_title'] . '" />
        <title>' . ($url['meta_title'] ? $url['meta_title'] : $page_title) . '</title>';
    } else {
        $meta.='<title>' . $page_title . '</title>';
    }

    return $meta;
}

function top_side_link() {
    /* @var $CI My_Controller */
    $CI = get_instance();
    $html='';
    if (trim(Urls::URL_PREFIX_PARTNERS,'/') == trim(implode('/', $CI->uri->rsegments),'/')){
        $html = '<div class="request-proposal"><a href="'.get_routed_url('home/become_partner').'">' . lang('home_menu_become_agent') . '</a></div>';
    }elseif(trim(implode('/', $CI->uri->rsegments),'/')!='home/become_partner'){
        $html = '<div class="request-proposal"><a href="'.get_routed_url('home/request_proposal').'">' . lang('home_menu_request_prposal') . '</a></div>';
    }
    
    return $html;
}

?>
