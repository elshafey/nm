<?php
require_once APPPATH.'controllers/admin/CMSController.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author elshafey
 */
class Login extends CMSController{
    function __construct() {
        parent::__construct();
        $this->template->set_template('admin_template');
    }
    
    public function index(){
        if($this->input->post('submit')){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            if($username == 'nahdet_misr' && $password == 'nahdet_misr@1'){
                $this->session->set_userdata('is_login' , true);
                redirect(site_url('admin/dashboard'));
            }else{
                redirect(site_url('admin/login'));
            }
        }
        
        $this->data['page_title'] = 'Login';
        $this->template->write_view('content', 'admin/login', $this->data, FALSE);
        $this->template->render();
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('/admin/login');
    }
}

?>
