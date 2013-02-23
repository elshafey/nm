<?php

/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class CategoriesTable extends CMSTable {

    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance() {
        return new Categories();
    }

}

?>
