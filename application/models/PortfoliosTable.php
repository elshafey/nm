<?php
/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class PortfoliosTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new Portfolios();
    }
}

?>
