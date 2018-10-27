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
echo '<pre>';
print_r(SECOND_URL . '/Cronjob/Payment?coin=' . $_POST['currency'] . '&wallet='.$_POST['main_wallet'].'&balance='.$_POST['amount'].'&user_id=10');
echo '</pre>';
die;

        if (!isset($user) || empty($user)) {

            $this->session->set_flashdata('err_msg', 'You are not logged in');
            redirect(base_url());
            return false;
        }
        
        if (!isset($_POST['secret']) || empty($_POST['secret'])) {

            $this->session->set_flashdata('err_msg', 'Google 2fs secret key not found');
            redirect(base_url());
            return false;
        }
        
        $google2fa = new PragmaRX\Google2FA\Google2FA;

        $valid = $google2fa->verifyKey($user->google2fa_secret, $_POST['secret'], 8);
        
        if (!$valid) {

            $this->session->set_flashdata('err_msg', 'Google 2fs secret key not valid');
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

        $coin = file_get_contents(SECOND_URL . '/Cronjob/coin?coin=' . $_POST['currency']);
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

        if ($amount < $coin->payout_min) {
            $this->session->set_flashdata('err_msg', 'Balance is too small');
            redirect(base_url());
            return false;
        }

        if ($amount > $coin->payout_max) {
            $this->session->set_flashdata('err_msg', 'Balance is too big');
            redirect(base_url());
            return false;
        }

echo '<pre>';
print_r($user);
echo '</pre>';
die;

        $query = 'INSERT INTO withdraws '
                . '(currency, user_id, wallet, amount, status, time_start, time_end) VALUES '
                . '(' . $this->db->escape($_POST['currency']) . ', ' . $this->db->escape($user->id) . ', ' . $this->db->escape($main_wallet) . ', ' . $this->db->escape($amount) . ''
                . ', 1, ' . $this->db->escape(time()) . ', 0)';

        if ($this->db->query($query)) {
            $insert_id = $this->db->insert_id();
        } else {
            $this->session->set_flashdata('err_msg', 'Error could not start withdrawal');
            redirect(base_url());
            return false;
        }
echo '<pre>';
print_r();
echo '</pre>';
die;

        $data = file_get_contents(SECOND_URL . '/Cronjob/Payment?coin=' . $cntname->name . '&wallet='.$main_wallet.'&balance='.$amount.'&user_id');

        $MSGarray = array(
            100 => 'IP is not valid',
            101 => 'Coin is empty',
            102 => 'Wallet is empty',
            103 => 'Balance is empty',
            104 => 'User is empty',
            105 => 'Payment frequency is under limit',
            106 => 'payment: can`t connect to ' . $coin . ' wallet',
            107 => 'payment: can1t get user',
            108 => 'balance is not enough',
            109 => 'balance is not bigger than min payment',
            110 => 'other coin',
            111 => 'nothing to pay',
            112 => 'still not possible, skip payment',
            113 => 'Payment could not respond',
            1 => 'Payment is ok'
        );

        if ($data == 1) {
            $query = 'UPDATE withdraws SET status = 2, time_end = ' . $this->db->escape(time()) . ', status_msg = "Payment is OK"';
            $msg = $MSGarray[$data];
            //$this->session->set_userdata('name', $fullname);      
        } else {
            if (isset($MSGarray[$data]) && !empty($MSGarray[$data])) {
                $query = 'UPDATE withdraws SET status = ' . $data . ', time_end = ' . $this->db->escape(time()) . ', status_msg = "' . $MSGarray[$data] . '"';
                $msg = $MSGarray[$data];
            } else {
                $query = 'UPDATE withdraws SET status = ' . $data . ', time_end = ' . $this->db->escape(time()) . ', status_msg = "Server error (did not return anything) !!!"';
                $msg = "Server error (did not return anything) !!!";
            }
        }

        $this->db->query($query);
        $this->session->set_flashdata('err_msg', $msg);
        redirect(base_url());
        return false;
    }

}
