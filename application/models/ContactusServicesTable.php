<?php

/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class ContactusServicesTable extends CMSTable {

    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance() {
        return new ContactusServices();
    }

}

?>
