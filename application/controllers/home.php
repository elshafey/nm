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
        $this->data['latest_release'] = BooksTable::getListBy('is_latest_release', '1');
        $this->data['most_popular'] = BooksTable::getListBy('is_most_popular', '1');
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

    public function faqs() {
        $this->data['navigator'] = array('<span class="sub-item"> &gt; ' . lang('home_menu_faqs') . '</span>');
        $this->data['faqs'] = FaqsTable::getList(true);
        $this->data['page_title'] = lang('home_menu_faqs');

        $this->template->write_view('content', 'home/faqs', $this->data);
        $this->template->render();
    }

    public function publishing_solutions($id) {
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_publishing_solutions') . '</span>';
        $this->side_menu_page($id, 'PublishingSoluionsTable');
    }

    public function educational_solutions($id) {
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_educational_solutions') . '</span>';
        $this->side_menu_page($id, 'EducationalSoluionsTable');
    }

    public function digital_solutions($id) {
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_digital_solutions') . '</span>';
        $this->side_menu_page($id, 'DigitalSoluionsTable');
    }

    private function side_menu_page($id, $table) {
        $page = $table::getOneBy('id', $id);
        $this->data['downloads'] = CMSTable::getListBy('parent', $id, true, SIDE_MENU_DOWNLOADS_NAMESPACE);
        $this->data['page_title'] = $page['title'][get_locale()];
        $this->data['page']['page_content'][get_locale()] = $page['content'][get_locale()];
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->write_view('content', 'home/downloads', $this->data);
        $this->template->render();
    }

    public function downloads() {
        $this->data['page'] = StaticPagesTable::getPage('downloads');
        $this->data['downloads'] = DownloadsTable::getList(true);
        $this->data['page_title'] = ($this->data['page']) ? $this->data['page']['page_title'][get_locale()] : lang('home_menu_downloads');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';

        $this->template->write_view('content', 'home/downloads', $this->data);
        $this->template->render();
    }

    public function achievements() {
        $this->data['page'] = StaticPagesTable::getPage('achievements');
        $this->data['page_title'] = ($this->data['page']) ? $this->data['page']['page_title'][get_locale()] : lang('home_menu_achievements');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->write_view('content', 'home/achievements', $this->data);
        $this->template->render();
    }

    public function careers() {
        $this->data['page'] = StaticPagesTable::getPage('career');
        $this->data['list'] = CareersTable::getList(true);
        $this->data['page_title'] = ($this->data['page']) ? $this->data['page']['page_title'][get_locale()] : lang('home_menu_careers');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->write_view('content', 'home/careers', $this->data);
        $this->template->render();
    }

    public function career_details($id) {
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_CAREERS) . '">' . lang('home_menu_careers') . '</a></span>';
        $this->data['item'] = CareersTable::getOneBy('id', $id);
        $this->data['page_title'] = $this->data['item']['job_title'][get_locale()];
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->write_view('content', 'home/career_details', $this->data);
        $this->template->render();
    }

    public function aboutus($id) {
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_aboutus') . '</span>';
        $this->get_common_news_details($id, 'AboutusPages');
    }

    public function news() {
        $this->data['page_title'] = lang('home_menu_media_center_news');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_media_center_news') . '</span>';
        $this->get_common_news();
    }

    public function news_details($id) {
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_NEWS_LIST) . '">' . lang('home_menu_media_center_news') . '</a></span>';
        $this->get_common_news_details($id);
    }

    public function events() {
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_media_center_events') . '</span>';
        $this->data['page_title'] = lang('home_menu_media_center_events');
        $this->get_common_news('Events');
    }

    public function event_details($id) {
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_EVENTS_LIST) . '">' . lang('home_menu_media_center_events') . '</a></span>';
        $this->get_common_news_details($id, 'Events');
    }

    public function press() {

        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_media_center_press_release') . '</span>';
        $this->data['page_title'] = lang('home_menu_media_center_press_release');
        $this->get_common_news('Pressreleases');
    }

    public function press_details($id) {
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_PRESS_LIST) . '">' . lang('home_menu_media_center_press_release') . '</a></span>';
        $this->get_common_news_details($id, 'Pressreleases');
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

    public function portfolio() {
        $this->data['page'] = StaticPagesTable::getPage('portfolio');
        $this->data['portfolios'] = PortfoliosTable::getList(true);
        $this->data['page_title'] = $this->data['page']['page_title'][get_locale()];
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';

        $this->template->write_view('content', 'home/portfolio', $this->data);
        $this->template->render();
    }

    public function portfolio_details($id) {
        $page = StaticPagesTable::getPage('portfolio');
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_PORTFOLIO) . '">' . $page['page_title'][get_locale()] . '</a></span>';
        $this->get_common_news_details($id, 'Portfolios');
    }

    public function partners() {

        $this->data['partners']['content'] = PartenersTable::getListBy('type', 1, true);
        $this->data['partners']['business'] = PartenersTable::getListBy('type', 2, true);

        $this->data['page_title'] = lang('home_menu_partners');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_partners') . '</span>';
        $this->template->write_view('content', 'home/partners', $this->data);
        $this->template->render();
    }

    public function preview_book($id) {

        $this->data['book'] = BooksTable::getOneBy('id', $id);
        $this->data['book']['SubCategories'] = SubCategoriesTable::getOneBy('id', $this->data['book']['parent_id']);
        $this->data['book']['SubCategories']['Categories'] = CategoriesTable::getOneBy('id', $this->data['book']['category']);

        $this->data['page_title'] = $this->data['book']['title'][get_locale()];
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->write_view('content', 'home/book_details', $this->data);
        $this->template->render();
    }

    public function quick_search() {
        if (!$_GET || !isset($_GET['q']) && $_GET['q'])
            redirect('/');
        $_POST = $_GET;
        $this->form_validation->set_rules('q', '', 'xss_clean');
        $this->form_validation->run();
        $this->data['books'] = BooksTable::quickSearch($_POST['q']);
        $this->data['page_title'] = lang('home_menu_quick_search');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';

        $this->template->write_view('content', 'home/search_result', $this->data);
        $this->template->render();
    }

    public function advanced_search() {

        if ($_POST) {

            $this->data['books'] = BooksTable::advancedSearch($_POST);

            $this->form_validation->set_rules('title', '', 'xss_clean');
            $this->form_validation->set_rules('author', '', 'xss_clean');
            $this->form_validation->set_rules('isbn', '', 'xss_clean');
            $this->form_validation->set_rules('category', '', 'xss_clean');
            $this->form_validation->set_rules('subcategory', '', 'xss_clean');
            $this->form_validation->run();
            if ($_POST['category'])
                $this->data['subcategories'] = SubCategoriesTable::getListByCat($_POST['category']);
        }
        $this->data['categories'] = CategoriesTable::getList(true);
        $this->data['page_title'] = lang('home_menu_advances_search');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_advances_search') . '</span>';
        $this->template->add_css('layout/css/form.css');
        $this->template->write_view('content', 'home/advanced_search', $this->data);
        $this->template->render();
    }

    public function get_subcategories($id) {
        $this->data['subcategories'] = SubCategoriesTable::getListByCat($id);
        $this->load->view('home/_subcategories', $this->data);
    }

    public function contact_us() {
        if ($_POST) {

            $this->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
            $this->form_validation->set_rules('full_name', '', 'required|xss_clean');
            $this->form_validation->set_rules('country', '', 'xss_clean');
            $this->form_validation->set_rules('company', '', 'xss_clean');
            $this->form_validation->set_rules('ask_about', '', 'xss_clean');
            $this->form_validation->set_rules('tel', '', 'xss_clean');
            $this->form_validation->set_rules('email', '', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('security_code', '', 'required|capatcha|xss_clean');
            $this->form_validation->set_rules('comment', '', 'required|xss_clean');
            if ($this->form_validation->run()) {
                $body =
                        "Full name: {$_POST['full_name']}<br>"
                        . ($_POST['country'] ? "Country: {$_POST['country']}<br>" : "" )
                        . ($_POST['company'] ? "Company: {$_POST['company']}<br>" : "" )
                        . ($_POST['tel'] ? "Telephone: {$_POST['tel']}<br>" : "" )
                        . ($_POST['email'] ? "Email: {$_POST['email']}<br>" : "" )
                        . "Comment: {$_POST['comment']}<br>"
                        . ($_POST['ask_about'] ? 'Ask about:' . implode(', ', $_POST['ask_about']) : '')
                ;
                
                send_email(CONTACT_US_EMAIL, 'Contact Us Form', $body);
                redirect('/');
            }
        }
        $page = StaticPagesTable::getPage('contactus');
        $this->data['page'] = $page;
        $this->data['services'] = ContactusServicesTable::getList(true);
        $this->data['page_title'] = ($page) ? $page['page_title'][get_locale()] : lang('home_menu_contact_us');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->data['countries'] = CountriesTable::getList();
        $this->template->add_css('layout/css/form.css');
        $this->template->write_view('content', 'home/contact_us', $this->data);
        $this->template->render();
    }

    public function capatcha() {
        require 'application/libraries/capatcha.php';
        new Captcha(120, 26);
    }

    private function get_common_data() {
        $this->data['aboutus'] = AboutusPagesTable::getList(true);
        $this->data['publishing_solutions'] = PublishingSoluionsTable::getList(true);
        $this->data['educational_solutions'] = EducationalSoluionsTable::getList(true);
        $this->data['digital_solutions'] = DigitalSoluionsTable::getList(true);
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
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->write_view('content', 'home/news_details', $this->data);
        $this->template->render();
    }

}

/* End of file: dashboard.php */
/* Location: ./application/core/dashboard.php */
?>
