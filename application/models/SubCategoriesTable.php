<?php

/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class SubCategoriesTable extends CMSTable {

    /**
     *
     * @return AboutusPages 
     */
    public static function getInstance() {
        return new SubCategories();
    }

    public static function getListByCat($parent_id, $active_only = false, $limit = '', $offset = '') {
        $cms = SubCategoriesTable::getInstance();
        /* @var My_Controller  */
        $CI = get_instance();
        /* @var $qb \Doctrine\ORM\QueryBuilder */
        $qb = $CI->doctrine->em->createQueryBuilder();
        $qb->select('p,pd')
                ->from('\Entities\Pages', 'p')
                ->join('p.PageDetails', 'pd')
                ->andwhere('p.namespace = ?1 ')
                ->andWhere('p.parent = ?2 ')
                ->orderBy('p.pageOrder ', ' ASC ');

        if ($active_only)
            $qb->andWhere('p.is_active=1');
        if ($limit) {
            $qb->setMaxResults($limit);
        }
        if ($offset) {
            $qb->setFirstResult($offset);
        }

        $res = $qb->getQuery()
                ->setParameter('1', "" . $cms->namespace)
                ->setParameter('2', "" . $parent_id)
                ->getResult(Doctrine\ORM\Query::HYDRATE_ARRAY);
        if ($res) {
            return self::getFloatHydration($res);
        }
        return array();
        }
        static function getList($active_only = false, $limit = '', $offset = '') {
            
        /* @var My_Controller  */
        $CI = get_instance();
        /* @var $qb \Doctrine\ORM\QueryBuilder */
        $qb = $CI->doctrine->em->createQueryBuilder();
        $qb->select('b,bd')
                ->from('\Entities\Pages', 'b')
                ->join('b.PageDetails', 'bd', Doctrine\ORM\Query\Expr\Join::WITH, 'b.namespace= ?1')
                ->orderBy('b.pageOrder ', ' ASC ');

        $qb->addSelect('c,cd')
                ->join('b.parent', 'c', Doctrine\ORM\Query\Expr\Join::WITH, 'c.namespace= ?3')
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
                ->setParameter('1', "subcategories")
                ->setParameter('3', "categories")
                ->getResult(Doctrine\ORM\Query::HYDRATE_ARRAY);

        return (self::getFloatHydration($res));
    }

}

?>
