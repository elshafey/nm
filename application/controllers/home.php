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

    function under_costruction() {
        $this->data['navigator'] = array('<span class="sub-item"> &gt; تحت الإنشاء</span>');
        $this->data['page_title'] = 'تحت الإنشاء';

        $this->template->write_view('content', 'home/under_costruction', $this->data);
        $this->template->render();
    }

    /**
     * Index - Display the default page view
     */
    public function index() {
        $this->template->set_template('home');
        $this->data['home_page'] = StaticPagesTable::getPage('home');
        $this->data['news'] = NewsTable::getListBy('is_home', 1);
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
        if ($_POST) {
            $_POST['cv_file'] = ' ';
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
            $this->form_validation->set_rules('cv_file', '', 'required_file|match_types[pdf,txt,doc,docx]|match_size[2024]|xss_clean');

            if ($this->form_validation->run()) {
                $interests = lang('home_careers_apply_interests');
                if (isset($_POST['interests'])) {
                    foreach ($_POST['interests'] as $key => $value) {
                        $_POST['interests'][$key] = $interests[$key];
                    }
                }
                $body =
                        lang('home_careers_apply_interest_title') . ": " . implode(' - ', $_POST['interests']) . "<br>"
                        . lang('home_careers_apply_name') . ": {$_POST['name']}<br>"
                        . lang('home_careers_apply_mobile') . ": {$_POST['mobile']}<br>"
                        . lang('home_careers_apply_home_number') . ": {$_POST['home_number']}<br>"
                        . lang('home_careers_apply_email') . ": {$_POST['email']}<br>"
                        . lang('home_careers_apply_birthday') . ": {$_POST['birthday']}<br>"
                        . lang('home_careers_apply_nationality') . ": {$_POST['nationality']}<br>"
                        . lang('home_careers_apply_military') . ": {$_POST['military']}<br>"
                        . lang('home_careers_apply_marital') . ": {$_POST['marital']}<br>"
                        . lang('home_careers_apply_position') . ": {$_POST['position']}<br>"
                        . lang('home_careers_apply_employer') . ": {$_POST['employer']}<br>"
                        . lang('home_careers_apply_start_date') . ": {$_POST['start_date']}<br>"
                        . lang('home_careers_apply_brief_description') . ": {$_POST['brief_description']}<br>"
                ;
                move_uploaded_file($_FILES['cv_file']['tmp_name'], 'uploads/files/'.$_FILES['cv_file']['name']);
                $this->email->attach($_FILES['cv_file']['tmp_name']);
                send_email(CAREERS_EMAIL, $_POST['email'], $_POST['name'], $_POST['name'] . ' Application Via Nahdet Misr', $body);
                unlink('uploads/files/'.$_FILES['cv_file']['name']);
                redirect('/');
            }
        }

        $this->data['page'] = StaticPagesTable::getPage('careers');
        $this->data['list'] = CareersTable::getList(true);
        $this->data['page_title'] = ($this->data['page']) ? $this->data['page']['page_title'][get_locale()] : lang('home_menu_careers');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->add_css('layout/css/form.' . get_locale() . '.css');
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
        $this->get_common_news_details($id, 'Projects');
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

    public function portfolio() {

        if (isset($_GET['per_page']))
            $offset = $_GET['per_page'];
        else
            $offset = 0;

        $this->data['page'] = StaticPagesTable::getPage('portfolio');
        $this->data['portfolios'] = PortfoliosTable::getList(true, 10, $offset);

        $this->load->library('pagination');
        $config['base_url'] = get_routed_url(Urls::URL_PREFIX_PORTFOLIO) . '?';
        $config['total_rows'] = PortfoliosTable::getCount();
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 4;
        $config['page_query_string'] = TRUE;

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

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
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->write_view('content', 'home/partners', $this->data);
        $this->template->render();
    }

    public function preview_book($id) {

        $this->data['book'] = BooksTable::getOneBy('id', $id);
        $this->data['book']['SubCategories2'] = SubCategories2Table::getOneBy('id', $this->data['book']['parent_id']);
        $this->data['book']['SubCategories'] = SubCategoriesTable::getOneBy('id', $this->data['book']['subcategory']);
        $this->data['book']['SubCategories']['Categories'] = CategoriesTable::getOneBy('id', $this->data['book']['category']);
        $this->data['meta_share'] =
                '<meta property="og:url" content="' . base_url() . 'home/preview_book/' . $id . '"/>' .
                '<meta property="og:image" content="' . base_url() . $this->data['book']['img'] . '" />' .
                '<meta property="og:site_name" content="Nahdet Misr"/>' .
                '<meta property="og:description" content="' . html_entity_decode(strip_tags($this->data['book']['brief_description'][get_locale()])) . '"/>';

        $this->data['page_title'] = $this->data['book']['title'][get_locale()];
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->write_view('content', 'home/book_details', $this->data);
        $this->template->render();
    }

    public function quick_search($pager = 0) {
        if (!$_GET || !isset($_GET['q']) && $_GET['q'])
            redirect('/');
        $_POST = $_GET;

        $this->form_validation->set_rules('q', '', 'xss_clean');
        $this->form_validation->run();
        $this->data['books'] = BooksTable::quickSearch($_POST['q'], 10, $pager);
        $this->setup_pagination('quick_search');

        $this->data['page_title'] = lang('home_menu_quick_search');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';

        $this->template->write_view('content', 'home/search_result', $this->data);
        $this->template->render();
    }

    public function advanced_search($pager = 0) {
        if ($_GET)
            $_POST = $_GET;

        if ($_POST) {

            $this->data['books'] = BooksTable::advancedSearch($_POST, 10, $pager);
            $this->setup_pagination();

            $this->form_validation->set_rules('title', '', 'xss_clean');
            $this->form_validation->set_rules('author', '', 'xss_clean');
            $this->form_validation->set_rules('isbn', '', 'xss_clean');
            $this->form_validation->set_rules('category', '', 'xss_clean');
            $this->form_validation->set_rules('subcategory', '', 'xss_clean');
            $this->form_validation->set_rules('subcategory2', '', 'xss_clean');
            $this->form_validation->run();
            if ($_POST['category'])
                $this->data['subcategories'] = SubCategoriesTable::getListByCat($_POST['category'], true);

            if (isset($_POST['subcategory']) && $_POST['subcategory'])
                $this->data['subcategories2'] = SubCategories2Table::getListByCat($_POST['subcategory'], true);
        }
        $this->data['categories'] = CategoriesTable::getList(true);
        $this->data['page_title'] = lang('home_menu_advances_search');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . lang('home_menu_advances_search') . '</span>';
        $this->template->add_css('layout/css/form.' . get_locale() . '.css');
        $this->template->write_view('content', 'home/advanced_search', $this->data);
        $this->template->render();
    }

    private function setup_pagination($action = 'advanced_search') {

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'home/' . $action . '/';
        $config['total_rows'] = BooksTable::getCount();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['num_links'] = 4;

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
    }

    public function get_subcategories($id) {
        $this->data['subcategories'] = SubCategoriesTable::getListByCat($id, true);
        $this->load->view('home/_subcategories', $this->data);
    }

    public function get_subcategories2($id) {
        $this->data['subcategories2'] = SubCategories2Table::getListByCat($id, true);
        $this->load->view('home/_subcategories2', $this->data);
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
                        . (isset($_POST['ask_about']) ? 'Ask about:' . implode(', ', $_POST['ask_about']) : '')
                ;

                send_email(CONTACT_US_EMAIL, $_POST['email'], $_POST['full_name'], 'Contact Us Form Via Nahdet Misr', $body);
                redirect('/');
            }
        }
        $page = StaticPagesTable::getPage('contactus');
        $this->data['page'] = $page;
        $this->data['services'] = ContactusServicesTable::getList(true);
        $this->data['page_title'] = ($page) ? $page['page_title'][get_locale()] : lang('home_menu_contact_us');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->data['countries'] = CountriesTable::getList();
        $this->template->add_css('layout/css/form.' . get_locale() . '.css');
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

                send_email(BECOME_AGENT_MAIL, $_POST['email'], $_POST['full_name'], 'Becom Agent Form Via Nahdet Misr', $body);
                redirect('/');
            }
        }
        $page = StaticPagesTable::getPage('become_agent');
        $this->data['url'] = StaticUrlsTable::getOneBy('url_prefix', Urls::URL_PREFIX_PARTNERS);
        $this->data['page'] = $page;
        $this->data['page_title'] = ($page) ? $page['page_title'][get_locale()] : lang('home_menu_become_agent');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->add_css('layout/css/form.' . get_locale() . '.css');
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
            $this->form_validation->set_rules('department', '', 'required|xss_clean');
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
                switch ($_POST['department']) {
                    case 'marketting':
                        $to = 'marketing@nahdetmisr.com,nehad.hashem@nahdetmisr.com';
                        break;
                    case 'rights':
                        $to = 'rights@nahdetmisr.com,nehad.hashem@nahdetmisr.com';
                        break;
                    case 'publishing':
                        $to = 'rights@nahdetmisr.com,nehad.hashem@nahdetmisr.com';
                        break;
                    case 'customer_service':
                        $to = 'customerservice@nahdetmisr.com,marketing@nahdetmisr.com,nehad.hashem@nahdetmisr.com';
                        break;
                    case 'sales':
                        $to = 'customerservice@nahdetmisr.com,marketing@nahdetmisr.com,nehad.hashem@nahdetmisr.com';
                        break;
                }
                send_email($to, $_POST['email'], $_POST['full_name'], 'Request Propsal Form Via Nahdet Misr', $body);
                redirect('/');
            }
        }
        $page = StaticPagesTable::getPage('request_prposal');
        $this->data['page'] = $page;
        $this->data['is_request_proposal'] = true;
        $this->data['page_title'] = ($page) ? $page['page_title'][get_locale()] : lang('home_menu_request_prposal');
        $this->data['navigator'][] = '<span class="sub-item"> &gt; ' . $this->data['page_title'] . '</span>';
        $this->template->add_css('layout/css/form.' . get_locale() . '.css');
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
        $this->data['side_banner'] = StaticPagesTable::getPage('side-banner');

        if (!$this->data['url']) {
            $this->data['original_path'].='/';
            $this->data['url'] = StaticUrlsTable::getOneBy('url_prefix', $this->data['original_path']);
        }
    }

    private function get_common_news($model = 'News') {

        if (isset($_GET['per_page']))
            $offset = $_GET['per_page'];
        else
            $offset = 0;

        $modelTable = $model . 'Table';
        $this->data['list'] = $modelTable::getList(true, 10, $offset);

        $this->load->library('pagination');
        $config['base_url'] = get_routed_url($modelTable::getListUrl()) . '?';
        $config['total_rows'] = $modelTable::getCount();
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
//        $config['uri_segment'] = 3;
        $config['num_links'] = 4;
        $config['page_query_string'] = TRUE;

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

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

    public function import_books() {
        set_time_limit(0);
        require 'PHPExcel-1.7.7/PHPExcel.php';
        $objPHPExcel = PHPExcel_IOFactory::load('uploads/books.xls');

        $k = 1;
        foreach ($objPHPExcel->getSheet()->getRowIterator(3) as $i => $row) {
            $_POST = array();
            $book_post = array();
            echo $row->getRowIndex() . '<br>';
            foreach ($row->getCellIterator() as $cell) {
                if ($cell->getColumn() == 'A') {
                    $book_post['isbn'] = $cell->getValue();
                }
                if ($cell->getColumn() == 'B') {
                    $cat['ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'C') {
                    $cat['en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'D') {
                    $subcat['ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'E') {
                    $subcat['en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'F') {
                    $subcat2['ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'G') {
                    $subcat2['en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'H') {
                    $book_post['pages_count'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'I') {
                    $book_post['title_en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'J') {
                    $book_post['title_ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'K') {
                    $book_post['author_en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'L') {
                    $book_post['author_ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'M') {
                    $book_post['brief_description_en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'N') {
                    $book_post['brief_description_ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'O' && $cell->getValue() != '') {
                    $book_post['preview'] = 'uploads/files/' . $cell->getValue();
                }

                if ($cell->getColumn() == 'P' && $cell->getValue() != '') {
                    $book_post['img'] = 'uploads/images/' . $cell->getValue();
                }
            }

            $this->form_validation = new My_Form_validation();
            $category = CategoriesTable::getOneBy('name', $cat['en-us']);
            $category_id = '';
            if ($category) {
                $category_id = $category['id'];
            } else {
                $category_post['name_en-us'] = $cat['en-us'];
                $category_post['name_ar-eg'] = $cat['ar-eg'];
                $category_post['page_order'] = $k;
                $category_post['is_active'] = 1;
                $_POST = $category_post;
                $form = new Forms(new Categories());
                if ($form->process()) {
                    $category = CategoriesTable::getOneBy('name', $cat['en-us']);
                    $category_id = $category['id'];
                } else {
//                    pre_print($this->form_validation->_error_array,false);
                    echo $form->renderFields();
                }
            }

            $this->form_validation = new My_Form_validation();
            $subcategory = SubCategoriesTable::getOneBy('name', $subcat['en-us']);
            $subcategory_id = '';
            if ($subcategory) {
                $subcategory_id = $subcategory['id'];
            } else {
                $subcategory_post['name_en-us'] = $subcat['en-us'];
                $subcategory_post['name_ar-eg'] = $subcat['ar-eg'];
                $subcategory_post['page_order'] = $k;
                $subcategory_post['is_active'] = 1;
                $subcategory_post['parent_id'] = $category_id;
                $_POST = $subcategory_post;
                $form = new Forms(new SubCategories());
                if ($form->process()) {
                    $subcategory = SubCategoriesTable::getOneBy('name', $subcat['en-us']);
                    $subcategory_id = $subcategory['id'];
                } else {
//                    echo $form->renderFields();
                }
//                        pre_print($form->cms->page);
            }

            $this->form_validation = new My_Form_validation();
            $subcategory2 = SubCategories2Table::getOneBy('name', $subcat2['en-us']);
            $subcategory2_id = '';
            if ($subcategory2) {
                $subcategory2_id = $subcategory2['id'];
            } else {
                $subcategory2_post['name_en-us'] = $subcat2['en-us'];
                $subcategory2_post['name_ar-eg'] = $subcat2['ar-eg'];
                $subcategory2_post['page_order'] = $k;
                $subcategory2_post['is_active'] = 1;
                $subcategory2_post['parent_id'] = $subcategory_id;
                $subcategory2_post['category'] = $category_id;
                $_POST = $subcategory2_post;
                $form = new Forms(new SubCategories2());
                if ($form->process()) {
                    $subcategory2 = SubCategories2Table::getOneBy('name', $subcat2['en-us']);
                    $subcategory2_id = $subcategory2['id'];
                } else {
//                    echo $form->renderFields();
                }
//                        pre_print($form->cms->page);
            }


            $book_post['img_alt'] = $book_post['img'];
            $book_post['img_title'] = $book_post['title_en-us'];
            $book_post['meta_title'] = $book_post['title_en-us'] . ' ' . $book_post['title_ar-eg'];
            $book_post['meta_keywords'] = $book_post['title_en-us'] . ' ' . $book_post['title_ar-eg'];
            $book_post['meta_description'] = $book_post['title_en-us'] . ' ' . $book_post['title_ar-eg'];
            $book_post['is_active'] = 1;
            $book_post['is_latest_release'] = 0;
            $book_post['is_most_popular'] = 0;

            $book_post['category'] = $category_id;
            $book_post['subcategory'] = $subcategory_id;
            $book_post['parent_id'] = $subcategory2_id;
            $book_post['page_order'] = $k;
            $book_post['routed'] = Urls::URL_PREFIX_BOOK;
//            pre_print($book_post);
            $_POST = $book_post;

            $this->form_validation = new My_Form_validation();
            $form = new Forms(new Books());
            if (!$form->process()) {
//                echo $form->renderFields();
                $errors[] = $book_post;
            }
            $k++;
        }

        if (isset($errors) && $errors)
            file_put_contents('non-uploded.txt', serialize($errors));
    }

    public function list_non_uploaded() {
        pre_print(unserialize(file_get_contents('non-uploded.txt')));
    }

}

/* End of file: dashboard.php */
/* Location: ./application/core/dashboard.php */
?>
