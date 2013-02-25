<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class DownloadsTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new Downloads();
    }
}

?>
