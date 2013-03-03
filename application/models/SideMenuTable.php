<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class SideMenuTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new SideMenu();
    }
}

?>
