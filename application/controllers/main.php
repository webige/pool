<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

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


        if (!isset($user) || empty($user)) {
            redirect(base_url() . 'auth');
            return false;
        }

        if (!isset($this->session->script) || empty($this->session->script)) {
            $this->session->script = 'sha256';
        }

        $this->load->helper('userdesctop');

        $usd = getDesctop($user->id);
        if ($this->input->get('d')) {
            $d_arr = array(1, 2, 3);
            $desctop = $this->input->get('d');
            if (!in_array($desctop, $d_arr)) {
                $desctop = 1;
            }
        } else {
            $desctop = $usd->desctop;
        }

        $this->load->model('mainmodel');

        $data['iframes'] = $this->mainmodel->getIframePositions($desctop);
        $data['title'] = 'dashboard';
        $data['view'] = 'dashboard';
        $data['view_pg'] = 'dashboard';
        $data['user'] = $user;
        $data['usd'] = $usd;

        $data['groups'] = array();

        if ($user->gid <= 2) {
            $data['groups'] = $this->getGroups();
        }

        $this->load->view('index', $data);
    }

    public function setAlgo() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            redirect(base_url());
            return false;
        }

        if (isset($_GET['algo']) && !empty($_GET['algo'])) {
            if ($_GET['algo'] == 'sha256' || $_GET['algo'] == 'scrypt' || $_GET['algo'] == 'x11') {
                
                $this->session->script = $_GET['algo'];
            }
        }
        redirect(base_url());
        return false;
    }

    public function getGroups() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            return array();
        }
        $this->load->model('mainmodel');
        $result = $this->mainmodel->getGroups();

        return $result;
    }

    public function iframes_json() {
        $this->load->model('mainmodel');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $d_arr = array(1, 2, 3);

            $desctop = $this->input->post('desctop');
            if (!in_array($desctop, $d_arr)) {
                $desctop = 1;
            }

            if ($this->input->post('type') == 'del') {
                $name = $this->input->post('fid');
                $this->mainmodel->deleteIframePosition($name, $desctop);
            } elseif ($this->input->post('type') == 'open') {
                $name = $this->input->post('fid');
                $this->mainmodel->openIframePosition($name, $desctop);
                $json = $this->mainmodel->getIframeByName($name, $desctop);



                echo json_encode($json);
            } else {
                $json_ids = $this->input->post('ids');
                if ($json_ids) {

                    $ids = $json_ids;
                    if (is_array($ids)) {
                        if ($this->mainmodel->hasUserPosition($desctop)) {
                            $this->mainmodel->updateIframePositions($ids, $desctop);
                        } else {
                            $this->mainmodel->setIframePositions($ids, $desctop);
                        }
                    }
                }
            }
        }
        die;
    }

}
