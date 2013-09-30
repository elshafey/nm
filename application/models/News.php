<?php

class News extends CMS {

    var $namespace = 'news';

    public function __construct($id = null) {
        parent::__construct($id);
//        pre_print($this);
    }

    protected function setUp() {
        parent::setUp();
        $value = array();
        foreach (get_lang_list() as $key => $lang) {
            $value[$key] = '';
        }
        $this->setUpColumn(
                array(
                    'name' => 'page_title',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));
        $this->setUpColumn(
                array(
                    'name' => 'page_content',
                    'validation' => 'required',
                    'required' => true,
                    'outType' => 'content',
                    'multi' => true,
                    'value' => $value,
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
                    'name' => 'pdf',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'file_uploader',
                    'multi' => true,
                    'value' => $value,
        ));

        $this->setUpColumn(
                array(
                    'name' => 'img_alt',
                    'validation' => 'xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        $this->setUpColumn(
                array(
                    'name' => 'img_title',
                    'validation' => 'xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        $this->setUpColumn(
                array(
                    'name' => 'page_url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_NEWS_DETAILS),
        ));


        $this->setUpColumn(
                array(
                    'name' => 'is_home',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'checkbox',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'doc_id',
                    'multi' => true,
                    'value' => $value,
        ));

        $this->setUpColumn(
                array(
                    'name' => 'access_key',
                    'multi' => true,
                    'value' => $value,
        ));

        $this->render_fields = array('page_title', 'page_content', 'pdf', 'img', 'img_alt', 'img_title', 'page_url', 'page_order', 'is_home', 'is_active');
    }

    function onFlush(\Entities\Pages &$page) {
        parent::onFlush($page);

        foreach ($this->pdf as $code => $value) {
            if (trim($value) && file_exists($value)) {
                $path = getcwd() . '/' . $value;

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
                $pageDetail = $CI->doctrine->em->createQuery('SELECT pd FROM \Entities\PageDetails pd where pd.name= ?2 and pd.Pages= ?1 AND pd.langCode= ?3 ')
                        ->setParameter('1', $page->getId())
                        ->setParameter('2', 'access_key')
                        ->setParameter('3', $code)
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
                $pageDetail = $CI->doctrine->em->createQuery('SELECT pd FROM \Entities\PageDetails pd where pd.name= ?2 and pd.Pages= ?1 AND pd.langCode= ?3 ')
                        ->setParameter('1', $page->getId())
                        ->setParameter('2', 'doc_id')
                        ->setParameter('3', $code)
                        ->getSingleResult();
                if (!$pageDetail) {
                    $pageDetail = new \Entities\PageDetails();
                } else {
                    $ch = curl_init('http://api.scribd.com/api?method=docs.delete&api_key=3r190500l02rmjeficw4l&doc_id=' . $pageDetail->getValue());
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);
                }
                $pageDetail->setPages($page);
                $pageDetail->setName('doc_id');
                $pageDetail->setValue($xml->doc_id);
                $CI->doctrine->em->persist($pageDetail);

                $CI->doctrine->em->flush();
            }
        }
    }

}
