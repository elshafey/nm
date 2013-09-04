<?php
/**
 * Description of ProjectsTable
 *
 * @author elshafey
 */
class ProjectsTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new Projects();
    }
    
    public static function getListUrl(){
        return Urls::URL_PREFIX_PROJECTS_LIST;
    }
}

?>
