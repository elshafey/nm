<?php

function more_less_str($str){
//    pre_print($str);
    $lines=  explode('<br />', trim($str));
    
    $lessed=$lines[0];
    if(count($lines)>=2){
        $words=explode(' ', $lines[0]);
        if(count($words)>30){
            $arr=array_slice($words,0,40);
            $lessed=implode(' ',$arr);
        }else{
            $lessed=implode(' ',$words);
            $words2=explode(' ', $lines[1]);
            if(count($words)+  count($words2)>=60){
                $arr=array_slice($words2,0,20);
                $lessed.='<br>'.implode(' ',$arr);
            }else{
                $lessed.='<br>'.implode(' ',$words2);
            }
        }
    }else{
        $words=explode(' ', $lines[0]);
        if(count($words)>54){
            $arr=array_slice($words,0,40);
            $lessed=implode(' ',$arr);
        }
    }
    $lessed=(count(explode(' ',trim($str)))<=count(explode(' ',trim($lessed))))? $lessed:$lessed.'...<span class="see_more link">'.lang('global_more').'</span>';
    return
    '<div class="lessed">'.$lessed.'</div>'
    .'<div class="mored"  style="display:none">'.implode('<br>', $lines).' <span class="see_less">...Less</span></div>'    
        ;    
//    pre_print($lines);
}

function sub_string_from_start($string,$length){
    $striped=htmlspecialchars_decode(strip_tags($string));
    return (array_shift(explode('<br/>', wordwrap($striped,$length,'<br/>'))).((strlen($striped)>$length)?'...':''));
}

function get_cell_name($column, $row) {
    if ($column < 26) {
        return chr(($column) + 65) . ($row);
    } else {
        return chr(floor($column / 26) + 64) . chr(($column % 26) + 65) . ($row);
    }
}
