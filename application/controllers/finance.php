<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {

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
        $data['view'] = 'finance';
        $data['view_pg'] = 'finance';

        $this->load->view('index', $data);
    }

    public function getData() {
        $user = $this->session->userdata('user');
        $this->load->model('financemodel');
        $this->load->helper('finance');
        if (!isset($user) || empty($user)) {
            die;
        }
        
        $finance = $this->financemodel->getData();
        
        $item = array();
        if ($finance){
            $i = 0;
            foreach ($finance as $one){
                $item[$i] = new stdclass();
                $item[$i]->id = $one->id;
                $item[$i]->wallet = $one->wallet;
                $item[$i]->time_start = date('d.m.Y', $one->time_start);
                $item[$i]->time_end = date('d.m.Y', $one->time_end);
                $item[$i]->status = getStatus($one->status);
                $item[$i]->operation = $one->operation ? $one->operation : 0;
                $item[$i]->commission = $one->commission;
                $item[$i]->amount = $one->amount;
                $item[$i]->balance_after = $one->balance_after;
                $item[$i]->tunover_after = $one->tunover_after;
                $item[$i]->details = $one->details;
                $i++;
            }
        }
        echo json_encode($item);
        die;
    }

}
