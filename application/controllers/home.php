<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use Doctrine\ORM\Query\Expr;

/*
  | -------------------------------------------------------------------
  | Dashboard Controller
  | -------------------------------------------------------------------
  | This file represent dashboard controller class extending asfour controller class.
  | This class is responsible for displaying the available functionality in the module.
 */

class Home extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->get_common_data();
    }

    /**
     * Index - Display the default page view
     */
    public function index() {
        $this->template->set_template('home');
        $this->data['home_page'] = StaticPagesTable::getPage('home');
        $this->data['news'] = NewsTable::getLatest();
        $this->data['banners'] = BannersTable::getList(true);
        $this->data['latest_release']=  BooksTable::getListBy('is_latest_release', '1');
        $this->data['most_popular']=  BooksTable::getListBy('is_most_popular', '1');
//        pre_print($this->data['latest_release'],false);
//        pre_print($this->data['most_popular']);
        $this->template->add_css('layout/css/nivo/themes/default/default.css');
        $this->template->add_css('layout/css/nivo/themes/light/light.css');
        $this->template->add_css('layout/css/nivo/themes/dark/dark.css');
        $this->template->add_css('layout/css/nivo/themes/bar/bar.css');
        $this->template->add_css('layout/css/nivo/nivo-slider.css');
        $this->template->add_js('layout/js/jquery/nivo/jquery.nivo.slider.pack.js');
        
        $this->template->add_js('layout/js/popup.js');
        $this->template->add_js('layout/js/home.js');
        $this->template->add_css('layout/css/popup.css');
        $this->template->write_view('content', 'home/index', $this->data);
        $this->template->render();
    }

    public function faqs(){
        $this->data['faqs'] = FaqsTable::getList(true);
        $this->data['page_title'] = lang('home_menu_faqs');
        
        $this->template->write_view('content', 'home/faqs', $this->data);
        $this->template->render();
    }

    public function downloads(){
        $this->data['page'] = StaticPagesTable::getPage('downloads');
        $this->data['downloads'] = DownloadsTable::getList(true);
        $this->data['page_title'] = ($this->data['page'])? $this->data['page']['page_title'][get_locale()]:lang('home_menu_downloads');
        
        $this->template->write_view('content', 'home/downloads', $this->data);
        $this->template->render();
    }
    
    public function careers(){
        $this->data['page'] = StaticPagesTable::getPage('career');
        $this->data['list'] = CareersTable::getList(true);
        $this->data['page_title'] = ($this->data['page'])? $this->data['page']['page_title'][get_locale()]:lang('home_menu_careers');
        
        $this->template->write_view('content', 'home/careers', $this->data);
        $this->template->render();
    }
    
    public function career_details($id){
        $this->data['item'] = CareersTable::getOneBy('id', $id);
        $this->data['page_title'] = $this->data['item']['job_title'][get_locale()];
        $this->template->write_view('content', 'home/career_details', $this->data);
        $this->template->render();
    }
    
    public function aboutus($id){
        $this->get_common_news_details($id,'AboutusPages');
    }
    
    public function news() {
        $this->data['page_title'] = lang('home_menu_media_center_news');
        $this->get_common_news();
    }

    public function news_details($id) {
        $this->get_common_news_details($id);
    }

    public function events() {
        $this->data['page_title'] = lang('home_menu_media_center_events');
        $this->get_common_news('Events');
    }
    
    public function event_details($id) {
        $this->get_common_news_details($id,'Events');
    }

    public function press() {
        $this->data['page_title'] = lang('home_menu_media_center_press_release');
        $this->get_common_news('Pressreleases');
    }
    
    public function press_details($id) {
        $this->get_common_news_details($id,'Pressreleases');
    }

    public function generate_models() {

        if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
            try {
                echo '<pre>';
                $this->doctrine->generateEntities();
            } catch (Exception $exc) {

                echo $exc->__toString();
                exit;
            }
        }
    }

    public function portfolio(){
        $this->data['page'] = StaticPagesTable::getPage('portfolio');
        $this->data['portfolios'] = PortfoliosTable::getList(true);
        $this->data['page_title'] = $this->data['page']['page_title'][get_locale()];
        
        $this->template->write_view('content', 'home/portfolio', $this->data);
        $this->template->render();
    }

    public function portfolio_details($id){
        $this->get_common_news_details($id,'Portfolios');
    }

    public function partners(){
        
        $this->data['portfolios'] = PartenersTable::getList(true);
        $this->data['page_title'] = lang('home_menu_partners');
        
        $this->template->write_view('content', 'home/partners', $this->data);
        $this->template->render();
    }


    private function get_common_data() {
        $this->data['aboutus'] = AboutusPagesTable::getList(true);
        $this->data['original_path'] = implode('/', $this->uri->rsegments);
        $this->data['url'] = UrlsTable::getOneBy('url_prefix', $this->data['original_path']);
    }

    private function get_common_news($model = 'News') {

        $modelTable = $model . 'Table';
        $this->data['list'] = $modelTable::getList(true);

        $this->template->write_view('content', 'home/news', $this->data);
        $this->template->render();
    }

    private function get_common_news_details($id, $model = 'News') {

        $modelTable = $model . 'Table';
        $this->data['item'] = $modelTable::getOneBy('id', $id);
        $this->data['page_title'] = $this->data['item']['page_title'][get_locale()];
        $this->template->write_view('content', 'home/news_details', $this->data);
        $this->template->render();
    }

}

/* End of file: dashboard.php */
/* Location: ./application/core/dashboard.php */
?>
