<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CountriesTable
 *
 * @author elshafey
 */
class CountriesTable{
    
    public static function getList(){
        /* @var $CI My_Controller */
        $CI=  get_instance();
        return $CI->doctrine->em->createQuery('SELECT c FROM \\Entities\\Countries c ORDER BY c.name')
                ->getResult(Doctrine\ORM\Query::HYDRATE_ARRAY);
    }
}

?>
