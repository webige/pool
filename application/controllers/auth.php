<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $user = $this->session->userdata('user');
        ;

        if (isset($user) && !empty($user)) {
            redirect(base_url() . 'index.php/');
            return false;
        }

        $data['title'] = 'login';
        $data['view'] = 'auth';
        $data['view_pg'] = 'login';

        $this->load->view('index', $data);
    }

    public function register() {
        $user = $this->session->userdata('user');

        if (isset($user) && !empty($user)) {
            redirect(base_url() . 'index.php/');
            return false;
        }

        $data['title'] = 'register';
        $data['view'] = 'auth';
        $data['view_pg'] = 'register';

        $this->load->view('index', $data);
    }

    public function save() {

        $post = $_POST;

        if (!isset($post['name']) || strlen($post['name']) < 6) {

            $this->session->set_flashdata('err_msg', 'Name field must be minimum 6 digit');
            redirect(base_url() . 'auth/register');
            return false;
        }

        if (!isset($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {

            $this->session->set_flashdata('err_msg', 'Email is not valid');
            redirect(base_url() . 'auth/register');
            return false;
        }

        if (!isset($post['password']) || strlen($post['password']) < 6) {

            $this->session->set_flashdata('err_msg', 'Password field must be minimum 6 digit');
            redirect(base_url() . 'auth/register');
            return false;
        }

        if (!isset($post['password_confirmation']) || $post['password'] != $post['password_confirmation']) {

            $this->session->set_flashdata('err_msg', 'Passwords do not match');
            redirect(base_url() . 'auth/register');
            return false;
        }

        $post['ip'] = $this->get_client_ip();

        $query = 'SELECT * FROM users WHERE name = ' . $this->db->escape($post['name']) . '';
        $cntname = $this->db->query($query)->result();

        if (count($cntname) > 0) {
            $this->session->set_flashdata('err_msg', 'Name already exists');
            redirect(base_url() . 'auth/register');
            return false;
        }

        $query = 'SELECT * FROM users WHERE email = ' . $this->db->escape($post['email']) . '';
        $cntname = $this->db->query($query)->result();

        if (count($cntname) > 0) {
            $this->session->set_flashdata('err_msg', 'Email already exists');
            redirect(base_url() . 'auth/register');
            return false;
        }


        $google2fa = new PragmaRX\Google2FA\Google2FA;
        $key = $google2fa->generateSecretKey();
        $post['google2fa_secret'] = $google2fa->generateSecretKey();

        $this->load->model('authmodel');
        $result = $this->authmodel->saveuser($post);
        if ($result) {
            $this->session->set_flashdata('good_msg', 'Registered Succesfully');
            $this->session->set_flashdata('rpost', $post);
            redirect(base_url() . 'auth/qrvalidate');
            return false;
        } else {
            $this->session->set_flashdata('err_msg', 'Can not register');
            redirect(base_url() . 'auth/register');
            return false;
        }
        return false;
    }

    public function qrvalidate() {
        $post = array();
        if ($this->session->userdata('rpost')) {
        $post = $this->session->userdata('rpost');
        }

        if (!isset($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {

            $this->session->set_flashdata('err_msg', 'Email is not valid');
            redirect(base_url() . 'auth/register');
            return false;
        }

        $query = ' SELECT u.*, a.id AS user_id, a.coinid, a.last_earning, a.balance FROM users  AS u '
                . ' LEFT JOIN `accounts` AS a ON a.username = u.name '
                . ' WHERE email = ' . $this->db->escape($post['email']) . ' AND password = ' . $this->db->escape(md5($post['password'])) . ' ';
        $cntname = $this->db->query($query)->row();
        $google2fa = new PragmaRX\Google2FA\Google2FA;
        $google2fa->setAllowInsecureCallToGoogleApis(true);

        $google2fa_url = $google2fa->getQRCodeGoogleUrl(
                'poolworks', $cntname->email, $cntname->google2fa_secret
        );
        

        $data['qrurl'] = $google2fa_url;
        $data['title'] = 'Bar code';
        $data['view'] = 'auth';
        $data['view_pg'] = 'barcode';
        $this->session->unset_userdata('rpost');
        $this->load->view('index', $data);
    }

    public function login() {


        $google2fa = new PragmaRX\Google2FA\Google2FA;
        $post = $_POST;
       
        if (!isset($post['secret']) || empty($post['secret'])) {
         
            $this->session->set_flashdata('err_msg', 'Secret key is empty');
            redirect(base_url() . 'auth/register');
            return false;
        }



        if (!isset($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
          
            $this->session->set_flashdata('err_msg', 'Email is not valid');
            redirect(base_url() . 'auth/register');
            return false;
        }

        
        $query = ' SELECT u.*, a.id AS user_id, a.coinid, a.last_earning, a.balance FROM users  AS u '
                . ' LEFT JOIN `accounts` AS a ON a.username = u.name '
                . ' WHERE email = ' . $this->db->escape($post['email']) . ' AND password = ' . $this->db->escape(md5($post['password'])) . ' ';
        $cntname = $this->db->query($query)->row();

        $secret = $post['secret'];

        $valid = $google2fa->verifyKey($cntname->google2fa_secret, $secret, 8);


        if (!$valid) {
         
            $this->session->set_flashdata('err_msg', 'Secret Number is not valid');
            redirect(base_url() . 'auth/register');
            return false;
        }
        if (!$cntname) {
          
            $this->session->set_flashdata('err_msg', 'Email or password do not match');
            redirect(base_url() . 'auth/register');
            return false;
        } else {
            

            $this->session->set_userdata('user', $cntname);
            redirect(base_url() . 'index.php');
            return false;
        }

        return false;
    }

    public function logout() {
        $this->session->unset_userdata('user');
        //$this->session->sess_destroy();
        redirect(base_url() . 'index.php');
        return false;
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP') && getenv('HTTP_CLIENT_IP') != '::1') {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR') && getenv('HTTP_X_FORWARDED_FOR') != '::1') {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED') && getenv('HTTP_X_FORWARDED') != '::1') {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR') && getenv('HTTP_FORWARDED_FOR') != '::1') {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED') && getenv('HTTP_FORWARDED') != '::1') {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR') && getenv('REMOTE_ADDR') != '::1') {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

}
