<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start();

class Shields extends CI_Controller {

        public $xauth;
        public $showname;

        public function __construct(){
            parent::__construct();

            $this->load->helper(array('form', 'url', 'html', 'directory', 'cookie', 'file'));
            $this->load->library(array('form_validation', 'security', 'pagination', 'session', 'excel'));
            $this->perPage = 25;
            $this->load->model('sql_models');
            $this->load->model('sql_models_adm');
            @date_default_timezone_set('Africa/Lagos');

            /*if(!$this->sql_models->validate_adminx()){
                $this->xauth = 0;
            }else{
                $this->xauth = 1;
            }*/


            function convertTime1($difference){
                $days = intval($difference / 86400); 
                $difference = $difference % 86400;
                $hours = intval($difference / 3600)+($days*24); 
                $difference = $difference % 3600;
                $minutes = intval($difference / 60); 
                $difference = $difference % 60;
                $seconds = intval($difference); 
                $check_zero = $days;
                if($check_zero<=0 && $hours>0)
                    return ("$hours hrs, $minutes mins time");
                else if($check_zero<=0 && $hours<=0)
                    return ("<font style='color:#FF4040'>Expired</font>");
                else
                    return ("$days days time");
            }


            function kilomega( $val ) {
                if( $val < 1000 ) return $val;
                $val = round((float)($val/1000),1);
                if( $val < 1000 ) return "${val}k";
                $val = round((float)($val/1000),1);
                return "${val}m";
            }


            function time_ago($date){
                $periods=array("sec","min","hr","day","week","month","year","decade");
                $lengths=array("60","60","24","7","4.35","12","10");
                $now=time();
                @$mydate=strtotime($date);
                if($now>$mydate){
                    $difference=$now-$mydate;
                    $tense="ago";
                }else{
                    $difference=$mydate-$now;
                    $tense="from now";
                }
                for($j=0; $difference>=$lengths[$j] && $j<count($lengths)-1; $j++){
                    $difference/=$lengths[$j];
                }
                $difference=intval($difference);
                    //$difference=round($difference,PHP_ROUND_HALF_DOWN);
                if($difference!=1){
                    $periods[$j].='s';
                }
                return "$difference $periods[$j] {$tense}";
            }


            function cleanStr($string) {
               $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
               return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
            }


            
        }



    public function login(){
        $data['page_name'] = "login";
        $data['page_title'] = "Login";
        if($this->sql_models->validate_adminx()) redirect('shields/');
        $this->load->view("shields/login", $data);
    }



    public function index(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_title'] = "Administrator";
        $data['page_name'] = "";
        $data['header_names'] = "Administrator";
        $ipaddrs = $_SERVER['REMOTE_ADDR'];
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['riders'] = $this->sql_models->getDetails("members", "rid", "", "result_array");
        $this->load->view("shields/header", $data);
        $this->load->view("shields/index", $data);
        $this->load->view("shields/footer", $data);
    }



    public function add_customer(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "add_customer";
        $data['header_names'] = "ADD CUSTOMER";
        $data['page_title'] = "Add Customer";
        $data['datamsg'] = "You have successfully added a customer";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/all_pages", $data);
        $this->load->view("shields/footer", $data);
    }


    public function add_riders(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "add_riders";
        $data['header_names'] = "ADD RIDERS";
        $data['page_title'] = "Add Riders";
        $data['datamsg'] = "You have successfully added a rider";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/all_pages", $data);
        $this->load->view("shields/footer", $data);
    }


    public function customers(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "customers";
        $data['header_names'] = "VIEW CUSTOMERS";
        $data['page_title'] = "View Customers ";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/all_pages", $data);
        $this->load->view("shields/footer", $data);
    }


    public function riders(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "riders";
        $data['header_names'] = "VIEW RIDERS";
        $data['page_title'] = "View Riders ";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/all_pages", $data);
        $this->load->view("shields/footer", $data);
    }

    

    public function add_mission(){
        if(!$this->sql_models->validate_adminx()) redirect('shields/login');
        $data['page_name'] = "add_mission";
        $data['header_names'] = "ADD MISSION";
        $data['page_title'] = "Add Mission ";
        $data['datamsg'] = "";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("shields/header", $data);
        $this->load->view("shields/all_pages", $data);
        $this->load->view("shields/footer", $data);
    }




    public function fetch_records(){
        $url_task = $this->uri->segment(3); // view_customers
        $url_id = $this->uri->segment(4);
        if($url_id!="")
            $uid = substr($url_id, 0, -5);
        else
            $uid=0;
        $url_task1="";

        //echo $url_task."ddd<br>"; //customers
        //echo $uid."sss<br>";
        // exit;

        $fetch_data = $this->sql_models_adm->make_datatables($url_task, $url_task1, $uid);
        $data = array();
        $conts = 1;
        foreach($fetch_data as $row){   
            $sub_array = array();
            $ids = $row->id;
            $nows = substr(time(), -5);
            $ids_hash = $ids.$nows;

            
            if($url_task=="customers"){
                $id1 = $row->id1;
                $names = ucwords($row->names);
                $emails = $row->emails;
                $addr = $row->addr;
                $phone = $row->phone;
                $pics = $row->pics;
                $date_created = $row->date_created;
                if($date_created!="")
                    $date_created = date("D jS M Y h:ia", strtotime($date_created));
                else
                    $date_created = "";

                if($pics!=""){
                    $pics1 = base_url()."profiles/".$pics;
                    $pics = "<div class='img_1'><img src='$pics1'></div>";
                }

                if($phone=="")
                    $phone1 = "<i style='color:#888;'>Not Specified</i>";
                else
                    $phone1 = "<a href='tel:$phone'>$phone</a>";
            }


            if($url_task=="riders"){
                $id1 = $row->id1;
                $names = ucwords($row->names);
                $emails = $row->emails;
                $addr = $row->addr;
                $phone = $row->phone;
                $pics = $row->pics;
                $date_created = $row->date_created;
                if($date_created!="")
                    $date_created = date("D jS M Y h:ia", strtotime($date_created));
                else
                    $date_created = "";

                if($pics!=""){
                    $pics1 = base_url()."profiles/".$pics;
                    $pics = "<div class='img_1'><img src='$pics1'></div>";
                }

                if($phone=="")
                    $phone1 = "<i style='color:#888;'>Not Specified</i>";
                else
                    $phone1 = "<a href='tel:$phone'>$phone</a>";
            }


            if($url_task=="add_mission"){
                $ids = $row->id1;
                $names = ucwords($row->names);
                $phones = $row->phone;
                $is_engaged = $row->is_engaged;
                
                if($is_engaged == 0){
                    $assgins = '<button class="btn btn-primary btn-xs assign_rider_now" id="assign_rider_now'.$ids.'" captn="0" capn2="" rider_id="'.$ids.'">Assign Now </button>

                    <button class="btn btn-primary btn-xs assign_rider_now2" onclick="javascript:alert(\'This rider is already engaged!\');" style="opacity:0.5; display:none;" captn="0" id="'.$ids.'">Assign Now </button>&nbsp;';
                }else{
                    $assgins = '<button class="btn btn-primary btn-xs" onclick="javascript:alert(\'This rider is already engaged!\');" style="opacity:0.5;">Assign Now </button>&nbsp;';
                }
            }


            


            $btns1='';
            /*$btns1 .= '<button class="btns btn-danger btn-lg btn_delete" data-title="Delete" data-toggle="modal" 
            data-target="#delete_dv" for_id="'.$ids.'" for_page="enter_activity">
            <i class="fa fa-trash-o"></i></button>';*/

            $btns1 .= '<button class="tabledit-delete-button btn btn-sm btn-danger btn_delete" type="button" style="float:none; margin:4px;" data-title="Delete" data-toggle="modal" data-target="#delete_dv" for_id="'.$ids.'"><span class="ti-trash"></span></button>';
            

            if($url_task=="customers"){
                $sub_array[] = $conts;
                $sub_array[] = $names;
                $sub_array[] = "<a href='mailto:$emails'>$emails</a>";
                $sub_array[] = $phone1;
                $sub_array[] = $pics;
                $sub_array[] = $addr;
                $sub_array[] = $date_created;
                $sub_array[] = $btns1;
            }


            if($url_task=="riders"){
                $sub_array[] = $conts;
                $sub_array[] = $names;
                $sub_array[] = "<a href='mailto:$emails'>$emails</a>";
                $sub_array[] = $phone1;
                $sub_array[] = $pics;
                $sub_array[] = $date_created;
                $sub_array[] = $btns1;
            }


            if($url_task=="add_mission"){
                $sub_array[] = $conts;
                $sub_array[] = $assgins;
                $sub_array[] = $names;
                $sub_array[] = $phones;
                //$sub_array[] = ucwords($vehicle_type);
            }

            $data[] = $sub_array;
            $conts++;
        }

        $output = array(
            "draw"              =>  intval($_POST["draw"]),
            "recordsTotal"      =>  $this->sql_models_adm->get_all_data($url_task, $url_task1, $uid),
            "recordsFiltered"   =>  $this->sql_models_adm->get_filtered_data($url_task, $url_task1, $uid, '', '', ''),
            //"data1"              =>  "sssss",
            "data"              =>  $data
        );
        echo json_encode($output);
    }



    function logout(){
        $cookie = array(
            'name'   => 'adm_logis_uname',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );

        $cookie1 = array(
            'name'   => 'adm_logis_pass',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );

        delete_cookie($cookie);
        delete_cookie($cookie1);
        redirect('shields/login');
    }



    
    
    public function settings(){
        if($this->sql_models->validate_adminx()) redirect('shields/login');
        $data['show_name'] = "Admin";
        $data['page_name'] = "settings";
        $data['header_names'] = "SETTINGS";
        $data['page_title'] = "Admin Settings";
        $data['url_id'] = "";
        $data['datamsg'] = "Your Password Has Been Updated!";
        $data['datamsg1'] = "Settings have been updated!";
        $data['datamsg2'] = "A new location has been added!";
        //$data['unread_msg'] = $this->unread_msg;
        $this->load->view("shields/header", $data);
        $this->load->view("shields/all_pages", $data);
        $this->load->view("shields/footer", $data);
    }


    
    

    public function logme_adm(){
        $this->form_validation->set_rules('txtuser', 'username', 'required|trim');
        $this->form_validation->set_rules('txtpas1s', 'password', 'required|trim');
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $data = array(
                'emails' => $this->input->post('txtuser'),
                'pass1'=> sha1($this->input->post('txtpas1s'))
                    );
            $is_correct = $this->sql_models->get_admin_logins($data);
            if($is_correct){
                $user_mail = $this->input->post('txtuser');
                $user_mail = sha1(strtolower($user_mail));
                $user_pass = sha1($this->input->post('txtpas1s'));

                $newdata = array(
                    'adm_uname_ider'  => $user_mail,
                    'pass1s_ider'     => $user_pass,
                    'logged_in_ider' => TRUE
                );
                $this->session->set_userdata($newdata);
                    echo "success1";
                
            }else{
                
                echo "Login credentials do not match!";

            }
        }
    }

    



}
