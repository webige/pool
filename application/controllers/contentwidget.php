<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contentwidget extends CI_Controller {

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

        //https://bittrex.com/api/v1.1/public/getticker?market=USD-BTC
        //https://api.binance.com/api/v3/ticker/price
        $data['iframe'] = true;
        $data['title'] = '';
        $data['view'] = 'content-widgets';
        $data['view_pg'] = 'content-widgets';

        $data['bittrex_btcusd'] = $this->getBittrexTicker();
        $data['binance_ltcbtc'] = $this->getBinanceTicker();
        $data['fullworkers'] = $this->getAllWorkersNumber();
        $data['allusers'] = $this->getAllUsers();
        $data['allhashrates'] = $this->getAllHashRates();
        
        $this->load->view('index', $data);
    }

    public function getBittrexTicker($type = 'USD-BTC') {
        $ticker = file_get_contents('https://bittrex.com/api/v1.1/public/getticker?market=' . $type);
        $ticker = json_decode($ticker);

        if ($ticker->success) {
            return $ticker->result->Last;
        }
        return 0;
    }

    public function getBinanceTicker($type = 'LTCBTC') {
        $ticker = file_get_contents('https://api.binance.com/api/v3/ticker/price');
        $ticker = json_decode($ticker);
      
        if ($ticker) {
            foreach($ticker as $row){
                
                if($row->symbol == $type){
                    return $row->price;
                }
            }
        }
        return 0;
    }
    
    public function getAllWorkersNumber($script = 'sha256') {
        $this->load->model('contentwidgetmodel');
        $result = $this->contentwidgetmodel->getAllWorkersNumber($script);

        return $result;
    }
    
    public function getAllUsers() {
        $this->load->model('contentwidgetmodel');
        $result = $this->contentwidgetmodel->getAllUsers();

        return $result;
    }
    
    public function getAllHashRates() {
        $this->load->model('contentwidgetmodel');
        $result = $this->contentwidgetmodel->getAllHashRates();

        return $result;
    }
    
    public function calculate(){
        $res['coinsPerDay'] = 0;
        $res['usdPerDay'] = 0;
        return $res;
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
