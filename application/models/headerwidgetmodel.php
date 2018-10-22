<?php

class headerwidgetmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getActiveWorkers($script = 'sha256') {

        $user = $this->session->userdata('user');
 
        if(!$user->user_id){
            return 0;
        }

        $query = 'SELECT * FROM `workers` WHERE userid = ' . $user->user_id;
        
        $res = file_get_contents(SECOND_URL.'/allworkersnumber_api.php?algo='.$script);

        if($res){
            $res = json_decode($res);
            return count($res);
        }
      
        return 0;
    }

}
