<?php

/**
 * Description of CMSTable
 *
 * @author elshafey
 */
class CMSTable {

    /**
     *
     * @return CMS 
     */
    public static function getInstance() {
        return new CMS();
    }

    public static function getList($active_only = false, $limit = '', $offset = '') {
        $cms = static::getInstance();
//        echo '<pre>';
        /* @var My_Controller  */
        $CI = get_instance();
        /* @var $qb \Doctrine\ORM\QueryBuilder */
        $qb = $CI->doctrine->em->createQueryBuilder();
        $qb->select('p,pd')
                ->from('\Entities\Pages', 'p')
                ->join('p.PageDetails', 'pd')
                ->andwhere('p.namespace = ?1 ')
                ->orderBy('p.pageOrder ', ' ASC ');

        if ($active_only)
            $qb->andWhere('p.isActive= 1 ');
        if ($limit) {
            $qb->setMaxResults($limit);
        }
        if ($offset) {
            $qb->setFirstResult($offset);
        }

        $res =
                new \Doctrine\ORM\Tools\Pagination\Paginator(
                                $qb->getQuery()
                                ->setParameter('1', "" . $cms->namespace)
                                ->setHydrationMode(\Doctrine\ORM\Query::HYDRATE_ARRAY));
        if ($res) {
            return self::getFloatHydration($res);
        }
        return array();
    }

    public static function getOneBy($field, $value) {
        $cms = static::getInstance();
//        echo '<pre>';
        /* @var My_Controller  */
        $CI = get_instance();
        /* @var $qb \Doctrine\ORM\QueryBuilder */
        $qb = $CI->doctrine->em->createQueryBuilder();

        if ($cms->isParentField($field)) {
            $q=$qb->select('p,pd')
                    ->from('\Entities\Pages', 'p')
                    ->join('p.PageDetails', 'pd')
                    ->andWhere('p.' . $field . '= ?3 ')
                    ->andwhere('p.namespace = ?1 ')
                    ->getQuery()
                    ->setParameter('1', "" . $cms->namespace)
                    ->setParameter('3', "" . $value)
            ;
        } else {
            $q=$qb->select('p,pd')
                    ->from('\Entities\Pages', 'p')
                    ->join('p.PageDetails', 'q', Doctrine\ORM\Query\Expr\Join::WITH, 'q.name = ?2 AND q.value= ?3 ')
                    ->join('p.PageDetails', 'pd')
                    ->andwhere('p.namespace = ?1 ')
                    ->getQuery()
                    ->setParameter('1', "" . $cms->namespace)
                    ->setParameter('2', "" . $field)
                    ->setParameter('3', "" . $value)
            ;
        }
        
        $res = $q->setHydrationMode(\Doctrine\ORM\Query::HYDRATE_ARRAY)
                ->execute();
        if ($res) {
            return array_shift(self::getFloatHydration($res));
        }
        return false;
    }

    public static function getFloatHydration($res) {

        $pages = array();
        foreach ($res as $i => $rec) {

            $page = array();
            foreach ($rec as $key => $value) {
                $name = self::convertNametoUnderScored($key);
                if ($key == 'PageDetails') {
                    foreach ($value as $detail) {
                        if ($detail['langCode'])
                            $page[$detail['name']][$detail['langCode']] = $detail['value'];
                        else
                            $page[$detail['name']] = $detail['value'];
                    }
                }elseif ($value instanceof DateTime) {
                    $page[$name] = $value->format('Y-m-d');
                } elseif ($key == 'parent') {
                    $page[ucfirst($value['namespace'])] = array_shift(self::getFloatHydration(array($value)));
                } elseif ($key == 'Pages') {
                    $page[ucfirst($value[0]['namespace'])] = self::getFloatHydration(array($value));
                } else {
                    $page[$name] = $value;
                }
            }
            $pages[] = $page;
        }
        return $pages;
    }

    static function convertNametoUnderScored($key) {
        return strtolower(implode('_', preg_split('/(?=[A-Z])/', $key)));
    }

}

?>
