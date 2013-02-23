<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class EventsTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new Events();
    }
}

?>
