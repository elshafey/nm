<?php

/**
 * @property $id
 * @property \Entities\Pages $parent_id 
 * @property $is_active
 * @property $page_order
 * @property $created_on
 * @property $updated_on
 * @property  \Entities\Pages $page
 */
class CMS {

    var $namespace = '';
    var $columns;
    var $render_fields = array('page_order', 'is_active');
    protected $parent_columns = array('id', 'is_active', 'page_order', 'parent_id', 'created_on', 'updated_on');
    protected $page = null;

    public function __construct($id = null) {
        $this->id = $id;
        $this->setUp();
        if ($id)
            $this->getOne();
    }

    protected function getOne($id = NULL) {
        /* @var $CI My_Controller */
        $CI = get_instance();

        $page = $CI->doctrine->em->createQueryBuilder()
                ->select('p,pd,url,upd,pr,prd')
                ->from('Entities\\Pages', 'p')
                ->join('p.PageDetails', 'pd')
                ->leftJoin('p.parent', 'pr')
                ->leftJoin('pr.PageDetails', 'prd')
                ->leftJoin('p.Pages', 'url', \Doctrine\ORM\Query\Expr\Join::WITH, 'url.namespace= ?2')
                ->leftJoin('url.PageDetails', 'upd')
                ->where('p.id = ?1')
                ->getQuery()
                ->setParameter('1', $this->id)
                ->setParameter('2', "url")
                ->getResult();

        $this->populate($page[0]);
    }

    public function isParentField($field){
        return in_array($field, $this->parent_columns);
    }


    public function populate(\Entities\Pages &$page) {

        $this->page = $page;

        $this->id = $page->getId();
        $this->page_order = $page->getPageOrder();
        $this->is_active = $page->getIsActive();
        $this->created_on = $page->getCreatedOn()->format('Y-m-d H:i:s');
        $this->updated_on = $page->getUpdatedOn()->format('Y-m-d H:i:s');
        if ($page->getParent()){
            $this->parent_id = $page->getParent();
        }

        /* @var $pageDetail \Entities\PageDetails */
        $multi = array();
        foreach ($page->getPageDetails() as $pageDetail) {
            $name = $pageDetail->getName();
            if ($pageDetail->getLangCode()) {
                $multi[$name][$pageDetail->getLangCode()] = $pageDetail->getValue();
                $this->$name = $multi[$name];
            } else {
                $this->$name = $pageDetail->getValue();
            }
        }

        foreach ($page->getPages() as $subPage) {
            foreach ($this->columns as $key => $column) {
                if (isset($column['value']) && $column['value'] instanceof CMS && $column['value']->namespace == $subPage->getNamespace()) {
                    $this->columns[$key]['value']->populate($subPage);
                }
            }
        }
    }

    protected function setUp() {
        $this->setUpColumn(
                array(
                    'name' => 'id',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'hidden',
                )
        );
        $this->setUpColumn(
                array(
                    'name' => 'parent_id',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'hidden',
                    'value' => '',
                )
        );
        $this->setUpColumn(
                array(
                    'name' => 'is_active',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'checkbox',
                    'value' => '',
                )
        );
        $this->setUpColumn(
                array(
                    'name' => 'page_order',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
                )
        );
        $this->setUpColumn(
                array(
                    'name' => 'created_on',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'textbox',
                )
        );
        $this->setUpColumn(
                array(
                    'name' => 'updated_on',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'textbox',
                )
        );
    }

    public function __set($name, $value) {
        if ($name == 'parent_id' && !$value instanceof \Entities\Pages) {
            /* @var $CI My_Controller */
            $CI = get_instance();
            $this->columns[$name]['value'] = $CI->doctrine->em->find('\Entities\Pages', $value);
        } else {
            $this->columns[$name]['value'] = $value;
        }
    }

    public function &__get($name) {
        if (isset($this->columns[$name]['value'])) {
            return $this->columns[$name]['value'];
        } else {
            $null = null;
            return $null;
        }
    }

    public function setUpColumn($column) {
        foreach ($column as $key => $value) {
            $this->columns[$column['name']][$key] = $value;
        }
    }

    public function delete() {
        /* @var $CI My_Controller */
        $CI = get_instance();
        $CI->doctrine->em->remove($this->page);
        $CI->doctrine->em->flush();
    }

    public function save() {
        /* @var $CI My_Controller */
        $CI = get_instance();

        $page = $this->assign();
//        pre_print($page);
        $CI->doctrine->em->flush();
        $this->onFlush($page);
    }

    protected function onFlush(\Entities\Pages &$page) {
        foreach ($this->columns as $name => $column) {
            if (isset($column['value']) && $column['value'] instanceof CMS) {
                $column['value']->onFlush($page);
            }
        }
    }

    /**
     *
     * @return \Entities\Pages 
     */
    protected function assign() {
        /* @var $CI My_Controller */
        $CI = get_instance();

        /* @var $page Entities\Pages */
        $page = &$this->page;
        if (!$page) {
            $page = new Entities\Pages();
            $page->setCreatedOn(new \DateTime("now"));
        }

        if ($this->is_active !== null)
            $page->setIsActive($this->is_active);
        if ($this->page_order)
            $page->setPageOrder($this->page_order);

        if ($this->parent_id) {
            $page->setParent($this->parent_id);
        }

        $page->setUpdatedOn(new \DateTime("now"));
        $page->setNamespace($this->namespace);
        $CI->doctrine->em->persist($page);

        foreach ($this->columns as $key => $column) {
            if (!in_array($key, $this->parent_columns)) {
                if ($column['value'] instanceof CMS) {
                    $this->columns[$key]['value']->parent_id = $page;
                    $page->addPage($this->columns[$key]['value']->assign());
                } else {
                    if (isset($column['multi']) && $column['multi']) {
                        foreach ($column['value'] as $code => $value) {
                            $this->setPageDetails($key, $value, $code);
                        }
                    } else {
                        $this->setPageDetails($key, $column['value']);
                    }
                }
            }
        }

        return $page;
    }

    /**
     *
     * @param string $name
     * @param string $code
     * @return \Entities\PageDetails 
     */
    protected function setPageDetails($name, $value, $code = null) {

        if ($this->page->getId()) {
            foreach ($this->page->getPageDetails() as $pageDetail) {
                if ($pageDetail->getName() == $name && $pageDetail->getLangCode() == $code) {
                    break;
                }
            }
            if (!($pageDetail->getName() == $name && $pageDetail->getLangCode() == $code)) {
                $pageDetail = new \Entities\PageDetails();
            }
        } else {
            $pageDetail = new \Entities\PageDetails();
        }

        $pageDetail->setName($name);
        $pageDetail->setValue($value);
        $pageDetail->setLangCode($code);

        if (!$pageDetail->getId()) {
            $pageDetail->setPages($this->page);
            $this->page->addPageDetail($pageDetail);
        }

        /* @var $CI My_Controller */
        $CI = get_instance();
        $CI->doctrine->em->persist($pageDetail);
        return $this;
    }

}
