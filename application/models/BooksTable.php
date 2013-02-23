<?php

/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class BooksTable extends CMSTable {

    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance() {
        return new Books();
    }

    public static function getList($active_only = false, $limit = '', $offset = '') {
        /* @var My_Controller  */
        $CI = get_instance();
        /* @var $qb \Doctrine\ORM\QueryBuilder */
        $qb = $CI->doctrine->em->createQueryBuilder();
        $qb->select('b,bd')
                ->from('\Entities\Pages', 'b')
                ->join('b.PageDetails', 'bd',  Doctrine\ORM\Query\Expr\Join::WITH,'b.namespace= ?1' )
                ->orderBy('b.pageOrder ', ' ASC ');

        $qb->addSelect('s,sd')
                ->join('b.parent', 's',  Doctrine\ORM\Query\Expr\Join::WITH,'s.namespace= ?2' )
                ->join('s.PageDetails', 'sd');
        
        $qb->addSelect('c,cd')
                ->join('s.parent', 'c',  Doctrine\ORM\Query\Expr\Join::WITH,'c.namespace= ?3' )
                ->join('c.PageDetails', 'cd');
        
        if ($active_only)
            $qb->andWhere('p.is_active=1');
        if ($limit) {
            $qb->setMaxResults($limit);
        }
        if ($offset) {
            $qb->setFirstResult($offset);
        }
        
        $res = $qb->getQuery()
                ->setParameter('1', "books")
                ->setParameter('2', "subcategories")
                ->setParameter('3', "categories")
                ->getResult(Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        return (self::getFloatHydration($res));
    }

}

?>
