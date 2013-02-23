<?php

/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class StaticPagesTable extends CMSTable {

    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance() {
        return new StaticPages();
    }

    public static function getPage($type) {
        /* @var My_Controller  */
        $CI = get_instance();
        /* @var $qb \Doctrine\ORM\QueryBuilder */
        $qb = $CI->doctrine->em->createQueryBuilder();
        $page=$qb->select('s,sd')
                ->from('\Entities\Pages', 's')
                ->join('s.PageDetails', 'sd', Doctrine\ORM\Query\Expr\Join::WITH, 's.namespace= ?1')
                ->join('s.PageDetails', 'sq')
                ->where('sq.name= ?2 and sq.value= ?3 ')
                ->getQuery()
                ->setParameter('1', 'staticpages')
                ->setParameter('2', 'type')
                ->setParameter('3', $type)
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        if($page)
            return array_shift (self::getFloatHydration($page));
        return FALSE;
    }

}

?>
