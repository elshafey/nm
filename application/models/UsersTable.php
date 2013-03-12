<?php

/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class UsersTable extends CMSTable {

    /**
     *
     * @return Users 
     */
    public static function getInstance() {
        return new Users();
    }

}

?>
