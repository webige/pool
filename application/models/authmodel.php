<?php

class authmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function saveuser($data) {

        if (empty($data)) {
            return false;
        }
        

        $mysql_date = date('Y-m-d G:i:s', time());
        $query = 'INSERT INTO users (`name`,`email`,`password`,`gid`,`ip`,`created_day`,`google2fa_secret`) VALUES'
                . ' ('
                . '' . $this->db->escape($data['name']) . ','
                . '' . $this->db->escape($data['email']) . ','
                . '' . $this->db->escape(md5($data['password'])) . ','
                . '1,'
                . '' . $this->db->escape($data['ip']) . ','
                . '' . $this->db->escape($mysql_date) . ''
                . '' . $this->db->escape($data['google2fa_secret']) . ''
                . ')';
        $ins = $this->db->query($query);
        if ($ins) {
            return true;
        }
        return false;
    }

}
