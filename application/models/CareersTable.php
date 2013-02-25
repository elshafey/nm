<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class CareersTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new Careers();
    }
}

?>
