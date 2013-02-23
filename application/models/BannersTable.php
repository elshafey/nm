<?php
/**
 * Description of BannersTable
 *
 * @author elshafey
 */
class BannersTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new Banners();
    }
}

?>
