<?php
/**
 * Description of AffiliatedCompaniesTable
 *
 * @author elshafey
 */
class AffiliatedCompaniesTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new AffiliatedCompanies();
    }
}

?>
