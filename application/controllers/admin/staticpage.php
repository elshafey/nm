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
        'achievements'=>array('page_title','page_content','page_url'),
        'portfolio'=>array('page_title','page_content','page_url'),
        'careers'=>array('page_title','page_content','page_url'),
        'downloads'=>array('page_title','page_content','page_url'),
        'contactus'=>array('page_title','page_content','page_url'),
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
                break;
            case 'achievements':
                $this->url_prefix = Urls::URL_PREFIX_ACHIEVEMENTS;
                $this->_model = 'HomePage';
                $this->_redirect = 'achievements';
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
            default:
                break;
        }
        $page = StaticPagesTable::getPage($type);
        $model = $this->_model;
        
        /* @var $cms CMS */
        if ($page){
            $cms=new $model($page['id']);
            $this->data['id'] = $page['id'];
        }else {
            $cms=new $model();
        }
        $cms->setUpColumn(array('name'=>'type','value'=>$type));
        if(isset($this->_render_fields[$type])){
            $cms->render_fields=$this->_render_fields[$type];
        }
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
        $this->data['form'] = $form;
        $this->data['cancel']=  $this->_redirect;
        $this->load_view('form');
    }

}

?>
