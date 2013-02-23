<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class NewsTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new News();
    }
    
    public static function getLatest(){
        
        return self::getList(true,3);
    }
}

?>
