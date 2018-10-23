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

    public function transfer() {
        $user = $this->session->userdata('user');
        ;
      
        if (!isset($user) || empty($user)) {

            $this->session->set_flashdata('err_msg', 'You are not logged in');
            redirect(base_url());
            return false;
        }

        if (!isset($_POST['main_wallet']) || empty($_POST['main_wallet'])) {

            $this->session->set_flashdata('err_msg', 'Please enter main wallet');
            redirect(base_url());
            return false;
        }

        if (!isset($_POST['amount']) || empty($_POST['amount'])) {

            $this->session->set_flashdata('err_msg', 'Please enter main amount');
            redirect(base_url());
            return false;
        }

        if (!isset($_POST['password']) || empty($_POST['password'])) {

            $this->session->set_flashdata('err_msg', 'Please enter password');
            redirect(base_url());
            return false;
        }

        if (md5($_POST['password']) != $user->password) {
            $this->session->set_flashdata('err_msg', 'Password is incorrect');
            redirect(base_url());
            return false;
        }

        if (!isset($_POST['currency']) || empty($_POST['currency'])) {
            $this->session->set_flashdata('err_msg', 'currency not defined');
            redirect(base_url());
            return false;
        }

        $main_wallet = $_POST['main_wallet'];
        $amount = $_POST['amount'];

        $coin = file_get_contents(SECOND_URL . '/coin_api.php?coin=' . $_POST['currency']);
        if ($coin) {
            $coin = json_decode($coin);
        } else {
            $this->session->set_flashdata('err_msg', 'currency not defined');
            redirect(base_url());
            return false;
        }

        if ($user->balance < $amount + $coin->txfee) {
            $this->session->set_flashdata('err_msg', 'Balance is not enough');
            redirect(base_url());
            return false;
        }

        if ($user->balance < $coin->payout_min) {
            $this->session->set_flashdata('err_msg', 'Balance is too small');
            redirect(base_url());
            return false;
        }

        if ($user->balance > $coin->payout_max) {
            $this->session->set_flashdata('err_msg', 'Balance is too big');
            redirect(base_url());
            return false;
        }


        $query = 'INSERT INTO withdraws '
                . '(currency, user_id, wallet, amount, status, time_start, time_end) VALUES '
                . '(' . $this->db->escape($_POST['currency']) . ', ' . $this->db->escape($user->id) . ', ' . $this->db->escape($main_wallet) . ', ' . $this->db->escape($amount) . ''
                . ', 1, ' . $this->db->escape(time()) . ', 0)';
        
        if($this->db->query($query)){
            $insert_id = $this->db->insert_id();
        }
        else{
            $this->session->set_flashdata('err_msg', 'Error could not start withdrawal');
            redirect(base_url());
            return false;
        }

        die;

        if (!$name || !$type) {
            die;
        }
    }

}
