<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hashratemonitor extends CI_Controller {

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
        $data['view'] = 'hashrate-monitor';
        $data['view_pg'] = 'hashrate-monitor';

        $data['groups'] = array();

        if ($user->gid <= 2) {
            $data['groups'] = $this->getGroups();
        }



        $this->load->view('index', $data);
    }

    public function getHasRates() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            die;
        }
        if (isset($this->session->script) && !empty($this->session->script)) {
            $script = $this->session->script;
        } else {
            $this->session->script = 'sha256';
            $script = $this->session->script;
        }
        $this->load->model('hashratemonitormodel');
        $result = $this->hashratemonitormodel->getHasRates($script);

        echo json_encode($result);
        die;
    }

    public function getHasRatesFromYiimp7day() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            die;
        }

        $data = file_get_contents(SECOND_URL . 'Cronjob/hashuser');


        if ($data) {
            $data = json_decode($data);

            foreach ($data as $row) {
                $query = 'INSERT INTO hashuser7d (userid, time, hashrate, hashrate_bad, algo) '
                        . 'VALUES (' . $this->db->escape($row['userid']) . ','
                        . '' . $this->db->escape($row['time']) . ', '
                        . '' . $this->db->escape($row['hashrate']) . ', '
                        . '' . $this->db->escape($row['hashrate_bad']) . ', '
                        . '' . $this->db->escape($row['algo']) . ' '
                        . ')';
                $this->db->query($query);
            }
        }


        echo 'good';
        die;
    }

    public function getHasRatesFromYiimp30day() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            die;
        }
        $data = file_get_contents(SECOND_URL . 'Cronjob/hashuser');


        if ($data) {
            $data = json_decode($data);

            foreach ($data as $row) {
                $query = 'INSERT INTO hashuser30d (userid, time, hashrate, hashrate_bad, algo) '
                        . 'VALUES (' . $this->db->escape($row['userid']) . ','
                        . '' . $this->db->escape($row['time']) . ', '
                        . '' . $this->db->escape($row['hashrate']) . ', '
                        . '' . $this->db->escape($row['hashrate_bad']) . ', '
                        . '' . $this->db->escape($row['algo']) . ' '
                        . ')';
                $this->db->query($query);
            }
        }


        echo 'good';
        die;
    }

    public function getHasRatesFromYiimp90day() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            die;
        }
        $data = file_get_contents(SECOND_URL . 'Cronjob/hashuser');


        if ($data) {
            $data = json_decode($data);

            foreach ($data as $row) {
                $query = 'INSERT INTO hashuser90d (userid, time, hashrate, hashrate_bad, algo) '
                        . 'VALUES (' . $this->db->escape($row['userid']) . ','
                        . '' . $this->db->escape($row['time']) . ', '
                        . '' . $this->db->escape($row['hashrate']) . ', '
                        . '' . $this->db->escape($row['hashrate_bad']) . ', '
                        . '' . $this->db->escape($row['algo']) . ' '
                        . ')';
                $this->db->query($query);
            }
        }


        echo 'good';
        die;
    }

    public function getGroups() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            return array();
        }
        $this->load->model('hashratemonitormodel');
        $result = $this->hashratemonitormodel->getGroups();

        return $result;
    }

    public function getWorkers() {
        $user = $this->session->userdata('user');
        if (!isset($user) || empty($user)) {
            die;
        }

        $id = $_POST['id'];
        if (!$id) {
            die;
        }
        $name = $_POST['name'];
        if (!$name) {
            die;
        }

        $target = $this->yaamp_hashrate_constant();
        $interval = $this->yaamp_hashrate_step();
        $delay = time() - $interval;

        $interval1 = 60 * 60 * 24;
        $delay1 = time() - $interval1;

        $data = file_get_contents(SECOND_URL . 'Cronjob/userworkers?usrnm=' . $name);

        if ($data) {
            $ddt = json_decode($data);
            $all = $ddt;
        } else {
            $ttest = array();
            $ttest[0] = new stdclass();
            $ttest[0]->worker = '';
            $ttest[0]->id = '';
            $ttest[0]->time = '';
            $ttest[0]->miners = '';
            $ttest[0]->name = '';
            $ttest[0]->status = '';
            $ttest[0]->checkbox = '';
            echo json_encode($ttest);
            die;
        }

        $worker = 'empty';

        $alln = array();
        $i = 0;
        $a = 0;
        foreach ($all as $key => $row) {
            if (empty($row->worker)) {
                $row->worker = 'empty';
            }

            if ($a == 0) {

                $alln[$i] = new stdclass();
                $worker = $row->worker;
                $alln[$i]->worker = $worker;
                $alln[$i]->id = $row->id;
                $alln[$i]->time = date('d.m.Y', $row->time);
                $alln[$i]->miners = $i + 1;
                $alln[$i]->name = $row->name;
                $alln[$i]->status = '<div class="label label-table label-success"> Active</div>';
                $alln[$i]->checkbox = '<div class="label label-table "> <input type="checkbox" class="group_radio_val" name="group" value="' . $row->name . '"></div>';
            } else {
                if ($worker != $row->worker) {
                    $i++;
                    $worker = $row->worker;
                    $alln[$i] = new stdclass();
                    $alln[$i]->worker = $worker;
                    $alln[$i]->id = $row->id;
                    $alln[$i]->time = date('d.m.Y', $row->time);
                    $alln[$i]->miners = $i + 1;
                    $alln[$i]->name = $row->name;
                    $alln[$i]->status = '<div class="label label-table label-success"> Active</div>';
                    $alln[$i]->checkbox = '<div class="label label-table "> <input type="checkbox" class="group_radio_val"  name="group" value="' . $row->name . '"></div>';
                } else {
                    $alln[$i]->id = $alln[$i]->id . '_' . $row->id;
                    $alln[$i]->miners = $i + 1;
                }
            }



            $a++;
        }


        foreach ($alln as $key => $row) {
            //$query = "SELECT (sum(difficulty) * $target / $interval / 1000) AS total FROM shares WHERE valid AND time>$delay AND workerid IN (" . $row->id . ")";
            //$hsrat = $this->db->query($query)->row();


            $data = file_get_contents(SECOND_URL . 'Cronjob/hashstat?id=' . $row->id . '&target=' . $target . '&interval=' . $interval . '&delay=' . $delay . '&interval1=' . $interval1 . '&delay1=' . $delay1);

            if ($data) {
                $data = json_decode($data);

                $alln[$key]->hashrate = $data->hsrat->total ? $this->Itoa2($data->hsrat->total) . 'h/s' : '';

                $alln[$key]->hashrate24 = $data->hsrat24->total ? $this->Itoa2($data->hsrat24->total) . 'h/s' : '';

                $alln[$key]->hashrateavg = $data->hsratavg->total ? $this->Itoa2($data->hsratavg->total) . 'h/s' : '';
            }
        }

        echo json_encode($alln);
        die;
    }

    public function getGroup() {
        $user = $this->session->userdata('user');
        if (!isset($user) || empty($user)) {
            die;
        }

        $id = $_POST['id'];
        if (!$id) {
            die;
        }

        $query = 'SELECT * FROM users WHERE name = ' . $this->db->escape($id) . '';
        $hsrat = $this->db->query($query)->row();

        echo json_encode($hsrat);
        die;
    }

    public function saveGroupChanges() {
        $user = $this->session->userdata('user');
        $msg = array('ok' => 0);
        if (!isset($user) || empty($user) || $user->gid <= 2) {
            $msg = array('ok' => 0);
        } else {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (!$name || !$email) {
                $msg = array('ok' => 0);
            } else {
                if (!empty($id)) {

                    if ($password) {
                        $set = ' email = ' . $this->db->escape($email) . ', password = ' . $this->db->escape($password) . ' ';
                    } else {
                        $set = ' email = ' . $this->db->escape($email) . '';
                    }

                    $query = 'UPDATE users SET ' . $set . ' WHERE id = ' . $this->db->escape($id) . '';
                    if ($this->db->query($query)) {
                        $msg = array('ok' => 1, 'insert' => 0);
                    } else {
                        $msg = array('ok' => 0);
                    }
                } else {

                    if (empty($password)) {
                        $msg = array('ok' => 0);
                    } else {

                        $query = 'SELECT * FROM users WHERE name = ' . $this->db->escape($name) . ' OR email = ' . $this->db->escape($email) . '';
                        $cn = $this->db->query($query)->num_rows();

                        if ($cn > 0) {
                            $msg = array('ok' => 2);
                        } else {
                            $ip = $this->get_client_ip();
                            $created_day = date('Y-m-d G:i:s', time());

                            $query = 'INSERT INTO users (parent_id, name, email, password, gid, ip, created_day) '
                                    . 'VALUES (' . $this->db->escape($user->id) . ','
                                    . '' . $this->db->escape($name) . ', '
                                    . '' . $this->db->escape($email) . ', '
                                    . '' . $this->db->escape(md5($password)) . ', '
                                    . '3, '
                                    . '' . $this->db->escape($ip) . ', '
                                    . '' . $this->db->escape($created_day) . ' '
                                    . ')';
                            if ($this->db->query($query)) {
                                $msg = array('ok' => 1, 'insert' => 1, 'id' => $this->db->insert_id());
                            } else {
                                $msg = array('ok' => 0);
                            }
                        }
                    }
                }
            }
        }
        echo json_encode($msg);
        die;
    }

    function yaamp_hashrate_constant($algo = null) {
        return pow(2, 42);  // 0x400 00000000
    }

    function yaamp_hashrate_step() {
        return 300;
    }

    function Itoa2($i, $precision = 1) {
        $s = '';
        if ($i >= 1000 * 1000 * 1000 * 1000 * 1000)
            $s = round(floatval($i) / 1000 / 1000 / 1000 / 1000 / 1000, $precision) . " P";
        else if ($i >= 1000 * 1000 * 1000 * 1000)
            $s = round(floatval($i) / 1000 / 1000 / 1000 / 1000, $precision) . " T";
        else if ($i >= 1000 * 1000 * 1000)
            $s = round(floatval($i) / 1000 / 1000 / 1000, $precision) . " G";
        else if ($i >= 1000 * 1000)
            $s = round(floatval($i) / 1000 / 1000, $precision) . " M";
        else if ($i >= 1000)
            $s = round(floatval($i) / 1000, $precision) . " k";
        else
            $s = round(floatval($i), $precision);

        return $s;
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
