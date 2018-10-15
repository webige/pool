<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class wallet extends CI_Controller {

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
            redirect(base_url() . 'auth');
            return false;
        }

        $data['title'] = 'wallet btc';
        $data['view'] = 'wallet';
        $data['view_pg'] = 'btc';

        $this->load->view('index', $data);
    }

    public function btc() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            redirect(base_url() . 'auth');
            return false;
        }

        $data['title'] = 'wallet btc';
        $data['view'] = 'wallet';
        $data['view_pg'] = 'btc';

        $this->load->model('walletmodel');
        $data['wallet'] = $this->walletmodel->getWallets(1);

        $this->load->view('index', $data);
    }

    public function ltc() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            redirect(base_url() . 'auth');
            return false;
        }

        $data['title'] = 'wallet ltc';
        $data['view'] = 'wallet';
        $data['view_pg'] = 'ltc';

        $this->load->model('walletmodel');
        $data['wallet'] = $this->walletmodel->getWallets(2);

        $this->load->view('index', $data);
    }

    public function addWallet() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            die;
        }
        $name = $_POST['name'];
        $type = $_POST['type'];
        if (!$name || !$type) {
            die;
        }
        $msg = array('ok' => 0);

        $query = 'SELECT * FROM wallets WHERE user_id = ' . $this->db->escape($user->id) . ' AND type = ' . $type;
        $num = $this->db->query($query)->num_rows();
        if ($num > 0) {
            $query = 'UPDATE wallets SET walelt = ' . $this->db->escape($name) . ' WHERE user_id = ' . $this->db->escape($user->id) . ' AND type = ' . $type;
            if ($this->db->query($query)) {
                $msg = array('ok' => 1, 'wallet' => $name);
            }
        } else {
            $query = 'INSERT INTO wallets (user_id, wallet, type) VALUES (' . $this->db->escape($user->id) . ', ' . $this->db->escape($name) . ', ' . $this->db->escape($type) . ')';
            if ($this->db->query($query)) {
                $msg = array('ok' => 1, 'wallet' => $name);
            }
        }
        
        echo json_encode($msg);
        die;
        
    }

}
