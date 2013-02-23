<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class PressreleasesTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new Pressreleases();
    }
}

?>
