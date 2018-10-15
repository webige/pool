<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Headerwidget extends CI_Controller {

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

        if (!isset($user) || empty($user)) {
            die;
        }

        $data['iframe'] = true;
        $data['title'] = '';
        $data['view'] = 'header-widgets';
        $data['view_pg'] = 'header-widgets';
        
        $data['items']['active_workers'] = $this->active_workers();
        $data['items']['user'] = $user->name;
        $data['items']['balance'] = $user->balance;
        $data['items']['ip'] = $this->get_client_ip();

        $this->load->view('index', $data);
    }
    
    public function active_workers() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            return false;
        }

        $this->load->model('headerwidgetmodel');
        $result = $this->headerwidgetmodel->getActiveWorkers();

        return $result;
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
