<?php
/**
 * Description of AchievementTable
 *
 * @author elshafey
 */
class AchievementsTable extends CMSTable {
    
    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance(){
        return new Achievements();
    }
}

?>
