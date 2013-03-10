<?php

/**
 * Description of AboutusPagesTable
 *
 * @author elshafey
 */
class BooksTable extends CMSTable {

    /**
     *
     * @return Books 
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
                ->join('b.PageDetails', 'bd', Doctrine\ORM\Query\Expr\Join::WITH, 'b.namespace= ?1')
                ->orderBy('b.pageOrder ', ' ASC ');

        $qb->addSelect('s,sd')
                ->join('b.parent', 's', Doctrine\ORM\Query\Expr\Join::WITH, 's.namespace= ?2')
                ->join('s.PageDetails', 'sd');

        $qb->addSelect('c,cd')
                ->join('s.parent', 'c', Doctrine\ORM\Query\Expr\Join::WITH, 'c.namespace= ?3')
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

    public static function advancedSearch($criteria) {

        /* @var My_Controller  */
        $CI = get_instance();
        /* @var $qb \Doctrine\ORM\QueryBuilder */
        $qb = $CI->doctrine->em->createQueryBuilder();

        $cms = self::getInstance();

        $qb->select('p,pd')
                ->from('\Entities\Pages', 'p')
                ->join('p.PageDetails', 'pd', Doctrine\ORM\Query\Expr\Join::WITH, '   p.namespace = ?10 ');

        if (isset($criteria['title']) && $criteria['title'] != '') {
            $qb->join('p.PageDetails', 't', Doctrine\ORM\Query\Expr\Join::WITH, ' t.name= ?11 AND p.namespace = ?12 ')
                    ->andWhere('t.value LIKE ?1 ');
        }
        if (isset($criteria['author']) && $criteria['author'] != '') {
            $qb->join('p.PageDetails', 'a', Doctrine\ORM\Query\Expr\Join::WITH, ' a.name= ?13 AND p.namespace = ?14 ')
                    ->andWhere('a.value LIKE ?2 ');
        }

        if (isset($criteria['isbn']) && $criteria['isbn'] != '') {
            $qb->join('p.PageDetails', 'i', Doctrine\ORM\Query\Expr\Join::WITH, ' i.name= ?15 AND p.namespace = ?16 ')
                    ->andWhere('i.value LIKE ?3 ');
        }

        if (isset($criteria['category']) && $criteria['category'] != '') {
            $qb->join('p.PageDetails', 'c', Doctrine\ORM\Query\Expr\Join::WITH, ' c.name= ?17 AND p.namespace = ?18 ')
                    ->andWhere('c.value LIKE ?4 ');
        }

        if (isset($criteria['subcategory']) && $criteria['subcategory'] != '') {
            $qb->andWhere('p.parent = ?5 ');
        }
        $qb->andWhere('p.isActive = 1');
        /* @var $q Doctrine\ORM\Query */
        $q = $qb->getQuery()
                ->setParameter('10', $cms->namespace);


        if (isset($criteria['title']) && $criteria['title'] != '') {
            $q->setParameter('1', "%{$criteria['title']}%");
            $q->setParameter('11', 'title');
            $q->setParameter('12', $cms->namespace);
        }
        if (isset($criteria['author']) && $criteria['author'] != '') {
            $q->setParameter('2', "%{$criteria['author']}%");
            $q->setParameter('13', 'author');
            $q->setParameter('14', $cms->namespace);
        }

        if (isset($criteria['isbn']) && $criteria['isbn'] != '') {
            $q->setParameter('3', "%{$criteria['isbn']}%");
            $q->setParameter('15', 'isbn');
            $q->setParameter('116', $cms->namespace);
        }

        if (isset($criteria['category']) && $criteria['category'] != '') {
            $q->setParameter('4', $criteria['category']);
            $q->setParameter('17', 'category');
            $q->setParameter('18', $cms->namespace);
        }

        if (isset($criteria['subcategory']) && $criteria['subcategory'] != '') {
            $q->setParameter('5', $criteria['subcategory']);
        }

        $res = $q->getResult(Doctrine\ORM\Query::HYDRATE_ARRAY);

        return (self::getFloatHydration($res));
    }

    public static function quickSearch($q) {

        /* @var My_Controller  */
        $CI = get_instance();
        /* @var $qb \Doctrine\ORM\QueryBuilder */
        $qb = $CI->doctrine->em->createQueryBuilder();

        $cms = self::getInstance();

        /* @var $query Doctrine\ORM\Query */
        $query = $qb->select('p,pds')
                ->from('\Entities\Pages', 'p')
                ->join('p.PageDetails', 'pds', Doctrine\ORM\Query\Expr\Join::WITH, '   p.namespace = ?1 ')
                ->join('p.PageDetails', 'pd', Doctrine\ORM\Query\Expr\Join::WITH, '   p.namespace = ?1 ')
                ->join('p.parent', 's')->join('s.PageDetails', 'spd')
                ->join('s.parent', 'c')->join('c.PageDetails', 'cpd')
                ->where('( pd.value LIKE ?2 OR spd.value LIKE ?3  OR cpd.value LIKE ?4 )')
                ->andWhere('p.isActive = 1')
                ->getQuery();
        $query->setParameter('1', 'books');
        $query->setParameter('2', "%$q%");
        $query->setParameter('3', "%$q%");
        $query->setParameter('4', "%$q%");
        
//        echo $query->getSQL();exit;
        return (self::getFloatHydration($query->getResult(Doctrine\ORM\Query::HYDRATE_ARRAY)));
    }

}

?>
