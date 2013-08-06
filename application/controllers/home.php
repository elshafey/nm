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
        $this->data['news'] = NewsTable::getListBy('is_home',1);
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

    public function publishing_solutions($id = '') {
        $this->get_inside_banner(Urls::URL_PREFIX_PUBLISHING_SOLUTIONS);
        if ($id) {
            $this->data['navigator'][] = '<span class="sub-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_PUBLISHING_SOLUTIONS) . '">' . lang('home_publishing_solutions') . '</a></span>';
            $this->side_menu_page($id, 'PublishingSolutionsTable');
        } else {
            $this->side_menu_main_page('publishing_solutions');
        }
    }

    public function educational_solutions($id = '') {
        $this->get_inside_banner(Urls::URL_PREFIX_EDUCATIONAL_SOLUTIONS);
        if ($id) {
            $this->data['navigator'][] = '<span class="sub-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_EDUCATIONAL_SOLUTIONS) . '">' . lang('home_educational_solutions') . '</a></span>';
            $this->side_menu_page($id, 'EducationalSolutionsTable');
        } else {
            $this->side_menu_main_page('educational_solutions');
        }
    }

    public function digital_solutions($id = '') {
        $this->get_inside_banner(Urls::URL_PREFIX_DIGITAL_SOLUTIONS);
        if ($id) {
            $this->data['navigator'][] = '<span class="sub-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_DIGITAL_SOLUTIONS) . '">' . lang('home_digital_solutions') . '</a></span>';
            $this->side_menu_page($id, 'DigitalSolutionsTable');
        } else {
            $this->side_menu_main_page('digital_solutions');
        }
    }

    public function custom_solutions($id = '') {
        $this->get_inside_banner(Urls::URL_PREFIX_DIGITAL_SOLUTIONS);
        if ($id) {
            $this->data['navigator'][] = '<span class="sub-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_CUSTOM_SOLUTIONS) . '">' . lang('home_custom_solutions') . '</a></span>';
            $this->side_menu_page($id, 'CustomSolutionsTable');
        } else {
            $this->side_menu_main_page('custom_solutions');
        }
    }

    private function side_menu_main_page($type) {
        $this->data['page'] = StaticPagesTable::getPage($type);
        $this->data['page_title'] = $this->data['page']['page_title'][get_locale()];
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->write_view('content', 'home/side_menu_main_page', $this->data);
        $this->template->render();
    }

    private function side_menu_page($id, $table) {
        $page = $table::getOneBy('id', $id);
        $this->data['downloads'] = DownloadsTable::getListBy('parent', $id, true, SIDE_MENU_DOWNLOADS_NAMESPACE);
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

    public function achievements($id) {
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_achievements') . '</span>';
        $this->get_inside_banner(Urls::URL_PREFIX_ACHIEVEMENTS);
        $this->get_common_news_details($id, 'Achievements');
    }

    public function careers() {
        if($_POST){
            $this->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
            $this->form_validation->set_rules('interests', '', 'xss_clean');
            $this->form_validation->set_rules('name', '', 'required|xss_clean');
            $this->form_validation->set_rules('mobile', '', 'required|xss_clean');
            $this->form_validation->set_rules('home_number', '', 'xss_clean');
            $this->form_validation->set_rules('birthday', '', 'required|xss_clean');
            $this->form_validation->set_rules('email', '', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('security_code', '', 'required|capatcha|xss_clean');
            $this->form_validation->set_rules('nationality', '', 'required|xss_clean');
            $this->form_validation->set_rules('military', '', 'required|xss_clean');
            $this->form_validation->set_rules('marital', '', 'required|xss_clean');
            $this->form_validation->set_rules('position', '', 'xss_clean');
            $this->form_validation->set_rules('employer', '', 'xss_clean');
            $this->form_validation->set_rules('start_date', '', 'xss_clean');
            $this->form_validation->set_rules('brief_description', '', 'required|xss_clean');
            if ($this->form_validation->run()) {
                $interests=lang('home_careers_apply_interests');
                foreach ($_POST['interests'] as $key => $value) {
                    $_POST['interests'][$key]=$interests[$key];
                }
                $body =
                        lang('home_careers_apply_interest_title').": ".  implode(' - ', $_POST['interests'])."<br>"
                        . lang('home_careers_apply_name').": {$_POST['name']}<br>"
                        . lang('home_careers_apply_mobile').": {$_POST['mobile']}<br>"
                        . lang('home_careers_apply_home_number').": {$_POST['home_number']}<br>"
                        . lang('home_careers_apply_email').": {$_POST['email']}<br>"
                        . lang('home_careers_apply_birthday').": {$_POST['birthday']}<br>"
                        . lang('home_careers_apply_nationality').": {$_POST['nationality']}<br>"
                        . lang('home_careers_apply_military').": {$_POST['military']}<br>"
                        . lang('home_careers_apply_marital').": {$_POST['marital']}<br>"
                        . lang('home_careers_apply_position').": {$_POST['position']}<br>"
                        . lang('home_careers_apply_employer').": {$_POST['employer']}<br>"
                        . lang('home_careers_apply_start_date').": {$_POST['start_date']}<br>"
                        . lang('home_careers_apply_brief_description').": {$_POST['brief_description']}<br>"
                ;
                send_email(CAREERS_EMAIL, $_POST['name'].' Application', $body);
                redirect('/');
            }
        }
        $this->data['page'] = StaticPagesTable::getPage('careers');
        $this->data['list'] = CareersTable::getList(true);
        $this->data['page_title'] = ($this->data['page']) ? $this->data['page']['page_title'][get_locale()] : lang('home_menu_careers');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->add_css('layout/css/form.css');
        $this->template->write_view('content', 'home/careers', $this->data);
        $this->template->render();
    }

    public function career_details($id) {
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_CAREERS) . '">' . lang('home_menu_careers') . '</a></span>';
        $this->data['item'] = CareersTable::getOneBy('id', $id);
        $this->data['page_title'] = $this->data['item']['job_title'][get_locale()];
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->get_inside_banner(Urls::URL_PREFIX_CAREERS);
        $this->template->write_view('content', 'home/career_details', $this->data);
        $this->template->render();
    }

    public function aboutus($id) {
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_aboutus') . '</span>';
        $this->get_inside_banner(Urls::URL_PREFIX_ABOUTUS);
        $this->get_common_news_details($id, 'AboutusPages');
    }

    public function affiliated_companies($id) {
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_affiliated_companies') . '</span>';
        $this->get_inside_banner(Urls::URL_PREFIX_AFFILIATED_COMPANIES);
        $this->get_common_news_details($id, 'AffiliatedCompanies');
    }

    public function news() {
        $this->data['page_title'] = lang('home_menu_media_center_news');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_media_center_news') . '</span>';
        $this->data['url_prefix'] = Urls::URL_PREFIX_NEWS_DETAILS;
        $this->get_common_news();
    }

    public function news_details($id) {
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_NEWS_LIST) . '">' . lang('home_menu_media_center_news') . '</a></span>';
        $this->get_inside_banner(Urls::URL_PREFIX_NEWS_LIST);
        $this->get_common_news_details($id);
    }

    public function projects_main() {
        $this->data['page_title'] = lang('home_menu_projects');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_projects') . '</span>';
        $this->data['url_prefix'] = Urls::URL_PREFIX_PROJECTS;
        $this->get_common_news('Projects');
    }

    public function projects($id) {
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_PROJECTS_LIST) . '">' . lang('home_menu_projects') . '</a></span>';
        $this->get_inside_banner(Urls::URL_PREFIX_PROJECTS_LIST);
        $this->get_common_news_details($id,'Projects');
    }

    public function events() {
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_media_center_events') . '</span>';
        $this->data['page_title'] = lang('home_menu_media_center_events');
        $this->data['url_prefix'] = Urls::URL_PREFIX_EVENT_DETAILS;
        $this->get_common_news('Events');
    }

    public function event_details($id) {
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_EVENTS_LIST) . '">' . lang('home_menu_media_center_events') . '</a></span>';
        $this->get_inside_banner(Urls::URL_PREFIX_EVENTS_LIST);
        $this->get_common_news_details($id, 'Events');
    }

    public function press() {
        $this->data['url_prefix'] = Urls::URL_PREFIX_PRESS_DETAILS;
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_media_center_press_release') . '</span>';
        $this->data['page_title'] = lang('home_menu_media_center_press_release');
        $this->get_common_news('Pressreleases');
    }

    public function press_details($id) {
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_PRESS_LIST) . '">' . lang('home_menu_media_center_press_release') . '</a></span>';
        $this->get_inside_banner(Urls::URL_PREFIX_PRESS_LIST);
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
        $this->get_inside_banner(Urls::URL_PREFIX_PORTFOLIO);
        $this->data['navigator'][] = '<span class="main-item"> &gt; <a href="' . get_routed_url(Urls::URL_PREFIX_PORTFOLIO) . '">' . $page['page_title'][get_locale()] . '</a></span>';
        $this->get_common_news_details($id, 'Portfolios');
    }

    public function partners() {

        $this->data['partners']['content'] = PartenersTable::getListBy('type', 1, true);
        $this->data['partners']['business'] = PartenersTable::getListBy('type', 2, true);
        $this->data['page'] = StaticPagesTable::getPage('partener');
        $this->data['page_title'] = $this->data['page']['page_title'][get_locale()];
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' .  $this->data['page_title'] . '</span>';
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
                $this->data['subcategories'] = SubCategoriesTable::getListByCat($_POST['category'],true);
        }
        $this->data['categories'] = CategoriesTable::getList(true);
        $this->data['page_title'] = lang('home_menu_advances_search');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_advances_search') . '</span>';
        $this->template->add_css('layout/css/form.css');
        $this->template->write_view('content', 'home/advanced_search', $this->data);
        $this->template->render();
    }

    public function get_subcategories($id) {
        $this->data['subcategories'] = SubCategoriesTable::getListByCat($id,true);
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

    public function become_partner() {
        if ($_POST) {
            $this->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
            $this->form_validation->set_rules('full_name', '', 'required|xss_clean');
            $this->form_validation->set_rules('company', '', 'xss_clean');
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

                send_email(CONTACT_US_EMAIL, 'Becom Agent Form', $body);
                redirect('/');
            }
        }
        $page = StaticPagesTable::getPage('become_agent');
        $this->data['url'] = StaticUrlsTable::getOneBy('url_prefix', Urls::URL_PREFIX_PARTNERS);
        $this->data['page'] = $page;
        $this->data['page_title'] = ($page) ? $page['page_title'][get_locale()] : lang('home_menu_become_agent');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->add_css('layout/css/form.css');
        $this->template->write_view('content', 'home/become_agent', $this->data);
        $this->template->render();
    }

    public function request_proposal() {
        if ($_POST) {

            $this->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
            $this->form_validation->set_rules('full_name', '', 'required|xss_clean');
            $this->form_validation->set_rules('company', '', 'xss_clean');
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

                send_email(CONTACT_US_EMAIL, 'Request Propsal Form', $body);
                redirect('/');
            }
        }
        $page = StaticPagesTable::getPage('request_prposal');
        $this->data['page'] = $page;
        $this->data['page_title'] = ($page) ? $page['page_title'][get_locale()] : lang('home_menu_request_prposal');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->add_css('layout/css/form.css');
        $this->template->write_view('content', 'home/become_agent', $this->data);
        $this->template->render();
    }

    public function capatcha() {
        require 'application/libraries/capatcha.php';
        new Captcha(120, 26);
    }

    private function get_common_data() {
        $this->data['aboutus'] = AboutusPagesTable::getList(true);
        $this->data['affiliated_companies'] = AffiliatedCompaniesTable::getList(true);
        $this->data['achievements'] = AchievementsTable::getList(true);
        $this->data['publishing_solutions'] = PublishingSolutionsTable::getList(true);
        $this->data['educational_solutions'] = EducationalSolutionsTable::getList(true);
        $this->data['digital_solutions'] = DigitalSolutionsTable::getList(true);
        $this->data['custom_solutions'] = CustomSolutionsTable::getList(true);
        $this->data['original_path'] = implode('/', $this->uri->rsegments);
        $this->data['url'] = StaticUrlsTable::getOneBy('url_prefix', $this->data['original_path']);

        if (!$this->data['url']) {
            $this->data['original_path'].='/';
            $this->data['url'] = StaticUrlsTable::getOneBy('url_prefix', $this->data['original_path']);
        }
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

    private function get_inside_banner($url_prefix) {
        $url = StaticUrlsTable::getOneBy('url_prefix', $url_prefix);
        $this->data['url']['img'] = $url['img'];
        $this->data['url']['img_alt'] = $url['img_alt'];
        $this->data['url']['img_title'] = $url['img_title'];
    }

}

/* End of file: dashboard.php */
/* Location: ./application/core/dashboard.php */
?>
