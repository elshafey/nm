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
    
    public static function getListUrl(){
        return Urls::URL_PREFIX_NEWS_LIST;
    }
}

?>
