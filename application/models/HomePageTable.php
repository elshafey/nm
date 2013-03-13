<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class HomePageTable extends StaticPagesTable {
    
    /**
     *
     * @return HomePage 
     */
    public static function getInstance(){
        return new HomePage();
    }
}

?>
