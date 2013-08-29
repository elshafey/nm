<?php

class Books extends CMS {

    var $namespace = 'books';

    public function __construct($id = null) {
        parent::__construct($id);
        if ($id) {
            $this->setUpColumn(
                    array(
                        'name' => 'parent_id',
                        'select_list' => SubCategories2Table::getListByCat($this->subcategory),
                    )
            );
            $this->setUpColumn(
                    array(
                        'name' => 'subcategory',
                        'select_list' => SubCategoriesTable::getListByCat($this->category),
                    )
            );
        }
//        pre_print($this);
    }

    public function setUp() {
        parent::setUp();
        $value = array();
        foreach (get_lang_list() as $key => $lang) {
            $value[$key] = '';
        }

        $this->setUpColumn(
                array(
                    'name' => 'category',
                    'outType' => 'select',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'select_list' => CategoriesTable::getList(),
                    'select_txt_field' => 'name',
                    'value' => '',
                )
        );

        $this->setUpColumn(
                array(
                    'name' => 'subcategory',
                    'outType' => 'select',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'select_list' => array(),
                    'select_txt_field' => 'name',
                    'value' => '',
                )
        );

        $this->setUpColumn(
                array(
                    'name' => 'parent_id',
                    'outType' => 'select',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'select_list' => array(),
                    'select_txt_field' => 'name',
                )
        );

        $this->setUpColumn(
                array(
                    'name' => 'title',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));

        $this->setUpColumn(
                array(
                    'name' => 'brief_description',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'content',
                    'multi' => true,
                    'value' => $value,
        ));

        $this->setUpColumn(
                array(
                    'name' => 'author',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));

        $this->setUpColumn(
                array(
                    'name' => 'isbn',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'img',
                    'validation' => 'required|xss_clean',
                    'required' => false,
                    'outType' => 'img_uploader',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'preview',
                    'validation' => 'required|xss_clean',
                    'required' => false,
                    'outType' => 'file_uploader',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'pages_count',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'is_latest_release',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'checkbox',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'is_most_popular',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'checkbox',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'img_alt',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'img_title',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'doc_id',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'access_key',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'book_url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_BOOK),
        ));


        array_push($this->render_fields, 'is_latest_release');
        array_push($this->render_fields, 'is_most_popular');
        array_unshift($this->render_fields, 'pages_count');
        array_unshift($this->render_fields, 'book_url');
        array_unshift($this->render_fields, 'img_title');
        array_unshift($this->render_fields, 'img_alt');
        array_unshift($this->render_fields, 'img');
        array_unshift($this->render_fields, 'preview');
        array_unshift($this->render_fields, 'isbn');
        array_unshift($this->render_fields, 'author');
        array_unshift($this->render_fields, 'brief_description');
        array_unshift($this->render_fields, 'title');
        array_unshift($this->render_fields, 'parent_id');
        array_unshift($this->render_fields, 'subcategory');
        array_unshift($this->render_fields, 'category');
        
    }

    function onFlush(\Entities\Pages &$page) {
        parent::onFlush($page);
        $path = getcwd() . '/' . $this->preview;
        
        $ch = curl_init('http://api.scribd.com/api?method=docs.upload&api_key=3r190500l02rmjeficw4l');
        $post_data = array(
            'file' => '@' . $path,
        );

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        $xml = simplexml_load_string($output);
        
        /* @var $CI My_Controller */
        $CI = get_instance();
        //inserting access key
        $pageDetail = $CI->doctrine->em->createQuery('SELECT pd FROM \Entities\PageDetails pd where pd.name= ?2 and pd.Pages= ?1 ')
                ->setParameter('1', $page->getId())
                ->setParameter('2', 'access_key')
                ->getSingleResult();

        if (!$pageDetail) {
            $pageDetail = new \Entities\PageDetails();
        }
        $pageDetail->setPages($page);
        $pageDetail->setName('access_key');
        $pageDetail->setValue($xml->access_key);
        $CI->doctrine->em->persist($pageDetail);
        $CI->doctrine->em->flush();

        //inserting doc id
        $pageDetail = $CI->doctrine->em->createQuery('SELECT pd FROM \Entities\PageDetails pd where pd.name= ?2 and pd.Pages= ?1 ')
                ->setParameter('1', $page->getId())
                ->setParameter('2', 'doc_id')
                ->getSingleResult();
        if (!$pageDetail) {
            $pageDetail = new \Entities\PageDetails();
        } else {
            $ch = curl_init('http://api.scribd.com/api?method=docs.delete&api_key=3r190500l02rmjeficw4l&doc_id='.$pageDetail->getValue());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
        }
        $pageDetail->setPages($page);
        $pageDetail->setName('doc_id');
        $pageDetail->setValue($xml->doc_id);
        $CI->doctrine->em->persist($pageDetail);

        $CI->doctrine->em->flush();
//        exit;
    }

}
