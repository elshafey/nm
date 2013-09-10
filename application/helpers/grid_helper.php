<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function load_grid_files() {
    $CI = &get_instance();
    $CI->template->add_css("layout/css/grid/jquery-ui-1.8.2.custom.css");
    $CI->template->add_js("layout/js/jquery/jquery-ui.min.js");
    $CI->template->add_css("layout/css/grid/ui.jqgrid.css");
    $CI->template->add_css("layout/css/grid/ui.multiselect.css");
    $CI->template->add_js("layout/js/grid/jquery.layout.js");
    $CI->template->add_js("layout/js/grid/i18n/grid.locale-" . get_locale() . ".js");
    $CI->template->add_js("layout/js/grid/jquery.jqGrid.min.js");
    $CI->template->add_js("layout/js/grid/jquery.tablednd.js");
    $CI->template->add_js("layout/js/grid/jquery.contextmenu.js");
    $CI->template->add_js("layout/js/grid/ui.multiselect.js");
}

function get_grid_json($data) {
    $array = array();
    if ($data) {
        foreach ($data as $index => $items) {
            foreach ($items as $key => $value) {
                $exploded = explode('_', $key);
                unset($exploded[0]);
                $array[$index][implode('_', $exploded)] = $value;
            }
        }
    }
    return $array;
}

function active_icon($state, $controller, $id) {
    return
            '<a href="' . site_url("admin/$controller/" . ($state ? 'deactivate' : 'activate') . "/$id") . '">'
            . '<img height="18" src="' . base_url("layout/images/" . ($state ? 'active' : 'inactive') . '.png') . '" />'
            . '</a>';
}

function order_icon($order, $controller, $id) {
    return
            '<div class="order_change">' . $order . '</div>' .
            '<div class="arrows">' .
            (
            ($order > 1) ?
                    '<a href="' . site_url("admin/$controller/orderup/$id/$order") . '" class="ui-icon ui-icon-circle-arrow-n">
                        &nbsp
                    </a>' : '<div class="empty_arrow"></div>'
            ) .
            '<a href="' . site_url("admin/$controller/orderdown/$id/$order") . '" class="ui-icon ui-icon-circle-arrow-s" >
                        &nbsp
             </a>' .
            '</div>';
}

function build_grid(array $fields, $controller, $json, $i = 2, $url = '', $loadonce = true, $out = true) {

    $script = '<script>';
    if ($json)
        $script.="var mydata =$json;";
    $script.='
        jQuery("#list' . $i . '").jqGrid(
        { 
            direction:"' . get_dir() . '",';
    if ($url != '') {
        $script.='datatype:"json",';
        $script.='url:"' . site_url($url) . '?' . convert_post_to_get() . '",';
    } else {
        $script.='datatype: "local",';
    }

    $script.='colNames:[';
    foreach ($fields as $field)
        $script.='"' . lang("{$controller}_{$field}") . '",';

    $script.='"' . lang('global_page_order') . '",' .
            '"' . lang('global_is_active') . '",' .
            '"",' .
            '"",' .
            '],' .
            'colModel:' .
            '[';
    foreach ($fields as $field)
        $script.='{name:"' . $field . '",index:"' . $field . '",width:180},';

    $script.='{name:"page_order",index:"page_order",width:80,sorttype:function(cell,row){return parseInt($(cell).text());}},' .
            '{name:"is_active",index:"is_active",width:80,classes:\'grid_center\'},' .
            '{name:"edit",index:"edit",width:80},' .
            '{name:"delete",index:"delete",width:80}' .
            '],' .
            'rowNum:10,' .
            'rowList:[10,20,30],' .
            'height:230,' .
            'width:910,' .
            "pager: '#pager$i'," .
            "sortname: 'page_order'," .
            "viewrecords: true," .
            "sortorder: 'desc',";
    if ($json) {
        $script.="data: mydata,";
    }
    if ($loadonce) {
        $script.="loadonce: true";
    }
    $script.="});";
    $script.="jQuery('#list$i').jqGrid('navGrid','#pager$i',{edit:false,add:false,del:false,search:false});";

    $script.="</script>";
    if ($out)
        echo $script;
}

?>