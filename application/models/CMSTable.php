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

    public static function getListBy($field, $value, $active_only = true,$namespace='') {
        $cms = static::getInstance();
//        echo '<pre>';
        /* @var My_Controller  */
        $CI = get_instance();
        /* @var $qb \Doctrine\ORM\QueryBuilder */
        $qb = $CI->doctrine->em->createQueryBuilder();
        $qb->orderBy('p.pageOrder');
        if ($cms->isParentField($field)) {
            $qb->select('p,pd')
                    ->from('\Entities\Pages', 'p')
                    ->join('p.PageDetails', 'pd')
                    ->andWhere('p.' . $field . '= ?3 ')
                    ->andwhere('p.namespace = ?1 ');
            if ($active_only)
                $qb->andWhere('p.isActive= 1 ');
            $q = $qb->getQuery()
                    ->setParameter('1', "" . ($namespace? $namespace:$cms->namespace))
                    ->setParameter('3', "" . $value)
            ;
        } else {
            $qb->select('p,pd')
                    ->from('\Entities\Pages', 'p')
                    ->join('p.PageDetails', 'q', Doctrine\ORM\Query\Expr\Join::WITH, 'q.name = ?2 AND q.value= ?3 ')
                    ->join('p.PageDetails', 'pd')
                    ->andwhere('p.namespace = ?1 ');
            if ($active_only)
                $qb->andWhere('p.isActive= 1 ');
            $q = $qb->getQuery()
                    ->setParameter('1', "" . ($namespace? $namespace:$cms->namespace))
                    ->setParameter('2', "" . $field)
                    ->setParameter('3', "" . $value)
            ;
        }
//        echo $q->getSQL();exit;
        $res = $q->setHydrationMode(\Doctrine\ORM\Query::HYDRATE_ARRAY)
                ->execute();
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
        /* @var $q Doctrine\ORM\Query */
        if ($cms->isParentField($field)) {
            $q = $qb->select('p,pd')
                    ->from('\Entities\Pages', 'p')
                    ->join('p.PageDetails', 'pd')
                    ->andWhere('p.' . $field . '= ?3 ')
                    ->andwhere('p.namespace = ?1 ')
                    ->getQuery()
                    ->setParameter('1', "" . $cms->namespace)
                    ->setParameter('3', "" . $value)
            ;
        } else {
            $q = $qb->select('p,pd')
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
        $q->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, TRUE);
        $res = $q->setHydrationMode(\Doctrine\ORM\Query::HYDRATE_ARRAY)
                ->execute();
        
        if ($res) {
            return array_shift(self::getFloatHydration($res));
        }
        return false;
    }

    public static function getFloatHydration($res) {

        $pages = array();
        $template=self::getModelTemplate();
        foreach ($res as $i => $rec) {

            $page = $template;
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

    public static function getModelTemplate(){
        $template=array();
        $cms = static::getInstance();
        foreach ($cms->columns as $column) {
            if(!isset($column['value'])){
                $template[$column['name']]='';
            }elseif(!($column['value'] instanceof CMS)){
                $template[$column['name']]=  isset($column['value'])? $column['value']:'';
            }
        }
        return $template;
    }

    static function convertNametoUnderScored($key) {
        return strtolower(implode('_', preg_split('/(?=[A-Z])/', $key)));
    }

}

?>
