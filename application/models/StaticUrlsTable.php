<?php

/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class StaticUrlsTable extends CMSTable {

    /**
     *
     * @return StaticUrls 
     */
    public static function getInstance() {
        return new StaticUrls();
    }
    
    
}

?>
