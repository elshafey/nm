<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class PublishingSolutionsTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new PublishingSolutions();
    }
}

?>
