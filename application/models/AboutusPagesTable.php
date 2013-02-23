<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class AboutusPagesTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new AboutusPages();
    }
}

?>
