<?php

/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class UrlsTable extends CMSTable {

    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance() {
        return new Urls();
    }
    
    
}

?>
