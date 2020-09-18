<?php

class Sql_models_adm extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }



    
    var $order_column = array(null, "*");


    function make_datatables($tbls, $params, $params2){
        //echo $tbls; exit;
        $tbls1="";
        $params2="";
        if($tbls=="customers") $tbls1 = "members";
        if($tbls=="riders"){$tbls1 = "members"; $params2="riders";}
        if($tbls=="add_mission"){$tbls1 = "members"; $params2="riders";}

        $this->fetchUsers($tbls1, $params, $params2);
        if($_POST["length"] != -1){
            $this->db->limit($_POST["length"], $_POST["start"]);
        }
        $query = $this->db->get();
        return $query->result();
    }


    
    public function get_filtered_data($tbls, $params, $params2){
        $tbls1="";
        $params2="";
        if($tbls=="customers") $tbls1 = "members";
        if($tbls=="riders"){$tbls1 = "members"; $params2="riders";}
        if($tbls=="add_mission"){$tbls1 = "members"; $params2="riders";}
        
        $this->fetchUsers($tbls1, $params, $params2);
        $query = $this->db->get();
        return $query->num_rows();
    }



    function get_all_data($tbls, $params, $params2){
        //echo $tbls; exit;
        $tbls1="";
        $this->db->select("*");
        if($tbls == "customers") $this->db->from('members');
        if($tbls == "riders") $this->db->from('members');
        if($tbls == "add_mission") $this->db->from('members');

        
        return $this->db->count_all_results();
    }


    

    function fetchUsers($tbls, $params, $params2){
        //echo $tbls."wwww<br>$params2"; exit;
        $nowtime = time();
        $txtsrchs = $_POST['search']['value'];

        $captn="mem";
        if($params2=="riders") $captn="rid";


        if($tbls=="members"){
            $this->db->select('mem.*, mem.id as id1');
            $this->db->from('members mem');
            $this->db->where('user_type', $captn);

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs = "(mem.names like '%$txtsrchs%' OR mem.emails like '%$txtsrchs%' OR mem.phone like '%$txtsrchs%')";
                $this->db->where("$srchs");
            }
            $this->db->order_by('mem.id', 'desc');
        }
        
        


    }

    

}

?>