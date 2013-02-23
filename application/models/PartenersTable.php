<?php
/**
 * Description of BannersTable
 *
 * @author elshafey
 */
class PartenersTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new Parteners();
    }
}

?>
