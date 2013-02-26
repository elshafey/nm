<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class FaqsTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new Faqs();
    }
}

?>
