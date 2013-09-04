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
    
    public static function getListUrl(){
        return Urls::URL_PREFIX_EVENTS_LIST;
    }
}

?>
