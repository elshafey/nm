<?php

require_once APPPATH . 'controllers/admin/CMSController.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of aboutus
 *
 * @author elshafey
 */
class Staticpage extends CMSController {

    protected $_model = 'StaticPages';
    protected $_controller = 'staticpage';
    var $url_prefix = '';

    protected $_render_fields=array(
        'home'=>array('page_title','page_content','video_path','video_image','page_url'),
        'side-banner'=>array('side_banner','ajax_banner'),
        'partener'=>array('page_title','page_content','page_url'),
        'projects'=>array('page_title','page_content','page_url'),
        'portfolio'=>array('page_title','page_content','page_url'),
        'careers'=>array('page_title','page_content','page_url'),
        'downloads'=>array('page_title','page_content','page_url'),
        'contactus'=>array('page_title','page_content','page_url'),
        'digital_solutions'=>array('page_title','page_content','page_url'),
        'educational_solutions'=>array('page_title','page_content','page_url'),
        'publishing_solutions'=>array('page_title','page_content','page_url'),
        'custom_solutions'=>array('page_title','page_content','page_url'),
    );


    public function __construct() {
        parent::__construct();
    }

    function edit($type) {
        $this->data['type'] = $type;
        $this->data['page_title'] = lang($this->data['controller'] . '_'.$type.'_form_edit_page_title');
        switch ($type) {
            case 'home':
                $this->_model = 'HomePage';
                $this->_redirect = 'home';
                break;
            case 'side-banner':
                $this->_model = 'HomePage';
                $this->_redirect = 'side-banner';
                break;
            case 'achievements':
                $this->url_prefix = Urls::URL_PREFIX_ACHIEVEMENTS;
                $this->data['view_url']=false;
                $this->_redirect = 'achievement';
                break;
            case 'affiliated_companies':
                $this->url_prefix = Urls::URL_PREFIX_AFFILIATED_COMPANIES;
                $this->data['view_url']=false;
                $this->_redirect = 'affiliated_companies';
                break;
            case 'portfolio':
                $this->url_prefix = Urls::URL_PREFIX_PORTFOLIO;
                $this->_model = 'HomePage';
                $this->_redirect = 'portfolio';
                break;
            case 'careers':
                $this->url_prefix = Urls::URL_PREFIX_CAREERS;
                $this->_model = 'HomePage';
                $this->_redirect = 'career';
                break;
            case 'downloads':
                $this->url_prefix = Urls::URL_PREFIX_DOWNLOADS;
                $this->_model = 'HomePage';
                $this->_redirect = 'download';
                break;
            case 'contactus':
                $this->url_prefix = Urls::URL_PREFIX_CONTACT_US;
                $this->_model = 'HomePage';
                $this->_redirect = 'contactus';
                break;
            case 'faqs':
                $this->url_prefix = Urls::URL_PREFIX_FAQS;
                $this->_redirect = 'faq';
                break;
            case 'aboutus':
                $this->url_prefix = Urls::URL_PREFIX_ABOUTUS;
                $this->_redirect = 'aboutus';
                $this->data['view_url']=false;
                break;
            case 'publishing_solutions':
                $this->url_prefix = Urls::URL_PREFIX_PUBLISHING_SOLUTIONS;
                $this->_redirect = 'publishing_solutions';
                $this->_model = 'HomePage';
//                $this->data['view_url']=false;
                break;
            case 'educational_solutions':
                $this->url_prefix = Urls::URL_PREFIX_EDUCATIONAL_SOLUTIONS;
                $this->_redirect = 'educational_solutions';
                $this->_model = 'HomePage';
//                $this->data['view_url']=false;
                break;
            case 'digital_solutions':
                $this->url_prefix = Urls::URL_PREFIX_DIGITAL_SOLUTIONS;
                $this->_redirect = 'digital_solutions';
                $this->_model = 'HomePage';
//                $this->data['view_url']=false;
                break;
            case 'custom_solutions':
                $this->url_prefix = Urls::URL_PREFIX_CUSTOM_SOLUTIONS;
                $this->_redirect = 'custom_solutions';
                $this->_model = 'HomePage';
//                $this->data['view_url']=false;
                break;
            case 'news':
                $this->url_prefix = Urls::URL_PREFIX_NEWS_LIST;
                $this->_redirect = 'news';
                break;
            case 'events':
                $this->url_prefix = Urls::URL_PREFIX_EVENTS_LIST;
                $this->_redirect = 'events';
                break;
            case 'news':
                $this->url_prefix = Urls::URL_PREFIX_PRESS_LIST;
                $this->_redirect = 'pressreleases';
                break;
            case 'partener':
                $this->url_prefix = Urls::URL_PREFIX_PARTNERS;
                $this->_model = 'HomePage';
                $this->_redirect = 'partener';
            case 'projects':
                $this->url_prefix = Urls::URL_PREFIX_PROJECTS_LIST;
                $this->_model = 'HomePage';
                $this->_redirect = 'project';
                break;
            default:
                break;
        }
        
        $cms=  $this->get_cms($type);
        $cms->setUpColumn(array('name'=>'type','value'=>$type));
        /* @var $form Forms */
        $form = new Forms($cms);
        
        if ($form->process()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('global_edited_successfully')
            );

            $this->session->set_flashdata("message", $message);
            if (is_ajax()) {
                echo 'success';
                exit;
            } else {
                redirect('admin/' . $this->_redirect);
            }
        }
        $this->data['type']=$type;
        $this->data['form'] = $form;
        $this->data['cancel']=  $this->_redirect;
        $this->load_view('form');
    }

    /**
     *
     * @param string $type
     * @return CMS 
     */
    private function get_cms($type){
        $page = StaticPagesTable::getPage($type);
        $model = $this->_model;
        
        /* @var $cms CMS */
        if ($page){
            $cms=new $model($page['id']);
            $this->data['id'] = $page['id'];
        }else {
            $cms=new $model();
        }
        
        if(isset($this->_render_fields[$type])){
            $cms->render_fields=$this->_render_fields[$type];
        }
        
        return $cms;
    }
}

?>
