<?php

class Sql_models extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }



    

    function send_mail($from_email, $to_email, $from_name, $messages, $subj){
        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->from($from_email, $from_name);
        $this->email->to($to_email);
        $this->email->subject($subj);
        $this->email->message($messages);
        if($this->email->send())
            return true;
        else
            return false;
    }



    public function searchStr($keyword) {
        $this->db->select('names, phone, emails, addr');
        $this->db->order_by('names', 'ASC');
        $this->db->like('names', $keyword);
        return $this->db->get_where('members', array('user_type' => 'mem'))->result_array();
    }


    public function searchStr_click() {
        $this->db->select('names, phone, emails, addr');
        $this->db->order_by('names', 'ASC');
        return $this->db->get_where('members', array('user_type' => 'mem'))->result_array();
    }


    function getLocs(){
        $query = $this->db->get('locations');
        return $query;
    }


    function getPrice1($pickups, $deliverys){
        $this->db->select('price')->from('distance_price')->where("from_loc", $pickups)->where('to_loc', $deliverys);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('price');
            //return $query->result_array();
        }else{
            return 0;
        }
    }



    function update_adm_password($new_pass, $oldpass){
        $this->db->select('id, pass1')->from('admin_tbls');
        $this->db->where('pass1', $oldpass);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $this->db->where('pass1', $oldpass);
            $this->db->set('pass1', $new_pass);
            $this->db->update('admin_tbls');
            return true;
        }else{
            return false;
        }
    }


    
    function deleteTblRecords($txt_dbase_table, $txtall_id){

        if($txt_dbase_table == "xxxxxx"){
            $this->db->select('files')->from('quiz_questions')->where('id', $txtall_id);
            $query = $this->db->get();
            $files = $query->row('files');
            $in_folder1="quizes/$files";
            if(is_readable($in_folder1)) @unlink($in_folder1);

            $this->db->where('id', $txtall_id);
            $query = $this->db->delete('quiz_questions');
        }

        if($query) return true; else return false;
    }

    

    function adminSettings(){
        $this->db->select('*')->from('settings1')->where('id', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    

    function bringSettings(){
        $this->db->select('*')->from('distance_price');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    function delete_memb_pics($file1, $folders){
        $in_folder1 = $folders.$file1;
        if(is_readable($in_folder1)){
            @unlink($in_folder1);
            return true;
        }else{
            return false;
        }
    }


    function getDetails($tbl, $columns, $memid, $arr){
        $this->db->select('names, emails, pics, phone, addr')->from($tbl);

        if($memid!="") $this->db->where('id', $memid);
        if($columns!="") $this->db->where('user_type', $columns);

        $query = $this->db->get();
        if($query->num_rows() > 0){
            if($arr == "result_array")
                return $query->result_array();
            else
                return $query->row_array();
        }else{
            return false;
        }
    }



    function auth_details($users, $passwords){
        $this->db->select('id')->from('admin_tbls')->where('pass1', sha1($passwords))->where('uname', $users);
        $now = 865000;
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $cookie = array(
                'name'   => 'adm_logis_uname',
                'value'  => sha1($users),
                'expire' => $now,
                'secure' => FALSE
            );
            $cookie1 = array(
                'name'   => 'adm_logis_pass',
                'value'  => sha1($passwords),
                'expire' => $now,
                'secure' => FALSE
            );
            set_cookie($cookie);
            set_cookie($cookie1);
            return true;
        }else{
            return false;
        }
    }


    
    function validate_adminx(){
        $adm_uname = $this->input->cookie('adm_logis_uname', TRUE);
        $adm_pass = $this->input->cookie('adm_logis_pass', TRUE);
        if(isset($adm_pass) && $adm_pass!=''){
            $this->db->select('id')->from('admin_tbls')->where('pass1', $adm_pass)->where('sha1(uname)', $adm_uname);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }




    function get_user_logins($data){
        $emails = $data['emails'];
        $pass = $data['pass'];
        $now = 865000;
        $this->db->select('pass1')->from('members')->where("(emails='$emails' or phone='$emails')");
        $query = $this->db->get();
        if($query->num_rows() > 0 && password_verify($pass, $query->row('pass1'))){
            $passwords = $query->row('pass1');
            $cookie = array(
                'name'   => 'icont_uname',
                'value'  => sha1($emails),
                'expire' => $now,
                'secure' => FALSE
            );
            $cookie1 = array(
                'name'   => 'icont_pass',
                'value'  => $passwords,
                'expire' => $now,
                'secure' => FALSE
            );
            set_cookie($cookie);
            set_cookie($cookie1);
            return true;
        }else{
            return false;
        }
    }




    function validateMember(){
        $suser = $this->input->cookie('icont_uname', TRUE);
        $spass = $this->input->cookie('icont_pass', TRUE);
        $this->db->select('id')->from('members')->where("(sha1(emails)='$suser' or sha1(phone)='$suser')")->where('passwords', $spass);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            //return sha1($query->row('id'));
            return true;
        }else{
            return false;
        }
    }




    function approveIDS($id1, $columns, $tbls){
        $query = $this->db->get_where($tbls, array('id' => $id1));
        if ($query->num_rows() > 0){
            $approved = $query->row()->$columns;
            $this->db->where('id', $id1);

            if($approved == 0){
                $this->db->set($columns, 1);
            }else{
                $this->db->set($columns, 0);
            }
            $query = $this->db->update($tbls);
            return ($query) ? true : false;
        }
    }


    function totalCounts($tbl, $params){
        $this->db->select('count(id) as allcount')->from($tbl);
        if($params!="")
            $this->db->where('paid', $params);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }



    function approveQrys($ids, $colums, $tbl, $duratn, $aparams){
        if($tbl == "members"){
            $query = $this->db->get_where($tbl, array('id' => $ids));
            $approved = $query->row()->approved;
            $agents = $query->row()->agents;

            if($colums=="approved"){
                if($approved == 0){
                    $this->db->where('id', $ids)->where('paid', 1);
                    $this->db->set($colums, 1);
                    $this->db->set('mem_type', 'spon');
                    $query = $this->db->update($tbl);
                }else{
                    $this->db->where('id', $ids);
                    $this->db->set($colums, 0);
                    $this->db->set('mem_type', 'mem');
                    $query = $this->db->update($tbl);
                }
            }

            if($query){
                return true;
            }else{
                return false;
            }
        }

    }



    var $order_column = array(null, "*");
    function make_datatables($tbls, $params, $params2, $start_date, $end_date){
        //echo $params2; exit;
        $tbls1="";
        $params3="public_view";
        $params4="";
        
        if($tbls=="transfer_history"){ $tbls1 = "transfer_history"; $params3 = "private_view"; }

        $this->fetchUsers($tbls1, $params, $params2, $params3, $params4, $start_date, $end_date);
        if($_POST["length"] != -1){
            $this->db->limit($_POST["length"], $_POST["start"]);
        }
        if($params2!="" && $params2!="inbox" && $params2!="sent"){
            if($tbls1=="contests" && $params3 == "private_view")
                $this->db->where('user_id', $params2);
        }
        $query = $this->db->get();
        return $query->result();
    }


    
    public function get_filtered_data($tbls, $params, $params2, $params3, $start_date, $end_date){
        $tbls1="";
        $params3="public_view";
        $params4="";
        if($tbls=="transfer_history"){ $tbls1 = "transfer_history"; $params3 = "private_view"; }

        $this->fetchUsers($tbls1, $params, $params2, $params3, $params4, $start_date, $end_date);
        // if($params!="" && $params>0)
        //     $this->db->where('memid', $params);
        if($params2!=""){
            if($tbls1=="contests" && $params3 == "private_view"){
                $this->db->where('user_id', $params2);
            }

            if($tbls=="support"){
                $this->db->where('user_id', $params2);
            }
        }

        /*if($start_date!="" && $end_date!=""){
            $srchs = "(all_votes.date_created BETWEEN '$start_date' AND '$end_date')";
            $this->db->where("$srchs");
        }*/

        $query = $this->db->get();
        return $query->num_rows();
    }


    function get_all_data($tbls, $params, $params2, $start_date, $end_date){
        $tbls1="";
        $this->db->select("*");
        if($tbls == "transfer_history") $this->db->from('transfer_history');

        if($params2!=""){
            if($tbls=="contests" && $params3 == "private_view")
                $this->db->where('user_id', $params2);
            
            if(($tbls=="support" || $tbls=="announcement"))
                $this->db->where('user_id', $params2);
        }
        return $this->db->count_all_results();
    }


    

    function fetchUsers($tbls, $params, $params2, $params3, $params4, $start_date, $end_date){
        //echo $tbls."wwww"; exit;
        $nowtime = time();
        $txtsrchs = $_POST['search']['value'];


        
        if($tbls=="xxxxx" && $params3=="xxxxxx"){
            $this->db->select('conts.*, mem.id AS memid, mem.names');
            $this->db->from('contests conts');
            if($params2 != "") $this->db->where('conts.user_id', $params2);

            $this->db->join('members mem', 'mem.id = conts.user_id');

            if($params != ""){
                if(isset($txtsrchs) && $txtsrchs!=""){
                    $srchs = "(mem.names like '%$txtsrchs%' OR mem.nickname like '%$txtsrchs%')";
                }
            }

            if(isset($txtsrchs) && $txtsrchs!=""){
                $srchs .= "(conts.title like '%$txtsrchs%' OR conts.premium like '%$txtsrchs%')";
            }

            if(isset($txtsrchs) && $txtsrchs!=""){
                $this->db->where("$srchs");
            }

            $this->db->order_by('conts.id', 'desc');
        }
    }



    function update_inserts_records($data, $memid, $tbl){
        if($memid != "")
            $query1 = $this->db->where('md5(id)', $memid)->update($tbl, $data);
        else
            $query1 = $this->db->insert($tbl, $data);

        if($query1){
            // $names1 = explode(' ', $data['names']);
            // return ucwords($names1[0]);
            return true;
        }else{
            return false;
        }
    }



    function updateSettings1($data, $tbl){
        $query = $this->db->where('id', 1)->update($tbl, $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    

    

}

?>