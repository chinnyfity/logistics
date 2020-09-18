<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node extends CI_Controller {

    public $xauth;
    public $show_name;

    public function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url', 'html', 'directory', 'cookie'));
        $this->load->library(array('form_validation', 'security', 'pagination', 'session', 'encrypt', 'Compress', 'nativesession'));
        $this->load->library('controller_list');
        
        $this->perPage = 20;
        $this->form_validation->set_message('valid_email', 'Invalid email entered');
        $this->form_validation->set_message('alpha_space', 'Invalid name entered');
        $this->form_validation->set_message('is_unique', 'This %s already exists');
        //$this->form_validation->set_message('max_length', 'The field "%s" is too long, cant\'t proceed!');
        $this->form_validation->set_message('regex_match[/^[0-9]{6,11}$/]', 'Phone must contain numbers and a maximum of 11 digits!');
        $this->load->model('sql_models');

        @date_default_timezone_set('Africa/Lagos');

        $this->mailHeader = "<html>
        <head>
            <style id='media-query' type='text/css'>
                body{
                    font-size: 16px !important;
                    font-family: Roboto,Arial,sans-serif;
                    color: #222;
                    line-height: 22px;
                }
                a{text-decoration:none;}
                .body_msg{
                    background: #eee;
                    padding: 10px 16px;
                }

                @media only screen and (max-width:900px) {
                    img{
                        width: 100%;
                    }
                    body{
                        font-size: 17.5px !important;
                    }
                }
            </style>
        </head>
        <body>
        <div style='margin-top:0px; text-align:center; width:100%'><img src='".base_url()."images/email_banner.jpg'></div>
        <div class='body_msg'>";


        $this->mailFooter = "<p style='margin-top:10px; font-size: 15px; line-height: 22px;'>
                    <b>iContestPRO</b><br>
                    #1 Multiple Contest Platform.<br>
                    <a href='https://icontestpro.com' style='color:#0066FF' target='_blank'>https://icontestpro.com</a></p>";
        
        $this->mailFooter .= "</div></body></html>";

        function kilomega( $val ) {
            if( $val < 1000 ) return $val;
            $val = round((float)($val/1000),1);
            if( $val < 1000 ) return "${val}k";
            $val = round((float)($val/1000),1);
            return "${val}m";
        }


        $offset_num1 = 1; $offset_num2 = 2; $offset_num3 = 3;
        if($_SERVER['HTTP_HOST'] == "localhost"){
            $offset_num1 = 2; $offset_num2 = 3; $offset_num3 = 4;
        }

        $uri = $_SERVER['REQUEST_URI'];
        $exploded_uri = explode('/', $uri);
        $this->url0="";
        $this->url0_i="";
        $url1=""; $url2="";
        if(isset($exploded_uri[$offset_num1]) && $exploded_uri[$offset_num1]!=""){
            $this->url0 = $exploded_uri[$offset_num1];
            $this->url0_i = $exploded_uri[$offset_num1]."/";
        }
        if(isset($exploded_uri[$offset_num2]) && $exploded_uri[$offset_num2]!=""){
            $url1 = $exploded_uri[$offset_num2]."/";
        }
        //if($exploded_uri[3]!="") $url1 = $exploded_uri3;
        if(isset($exploded_uri[$offset_num3]) && $exploded_uri[$offset_num3]!="") $url2 = $exploded_uri[$offset_num3]."/";
        $this->url_params = $this->url0_i.$url1.$url2;
            

        //$this->myID = "";

        function hash_password($password){
           return password_hash($password, PASSWORD_BCRYPT);
        }

        function time_ago($date){
            $time_ago = strtotime($date);
            $cur_time   = time();
            $time_elapsed   = $cur_time - $time_ago;
            $seconds    = $time_elapsed ;
            $minutes    = round($time_elapsed / 60 );
            $hours      = round($time_elapsed / 3600);
            $days       = round($time_elapsed / 86400 );
            $weeks      = round($time_elapsed / 604800);
            $months     = round($time_elapsed / 2600640 );
            $years      = round($time_elapsed / 31207680 );

            // Seconds
            if($seconds <= 60){
                return "just now";
            }
            //Minutes
            else if($minutes <= 60){
                if($minutes==1){
                    return "1 min ago";
                }
                else{
                    return "$minutes mins ago";
                }
            }
            //Hours
            else if($hours <= 24){
                if($hours==1){
                    return "1 hr ago";
                }else{
                    return "$hours hrs ago";
                }
            }
            //Days
            else if($days <= 7){
                if($days==1){
                    return "yesterday";
                }else{
                    return "$days days ago";
                }
            }
            //Weeks
            else if($weeks <= 4.3){
                if($weeks==1){
                    return "1 wk ago";
                }else{
                    return "$weeks wks ago";
                }
            }
            //Months
            else if($months <=12){
                if($months==1){
                    return "1 mnth ago";
                }else{
                    return "$months mnths ago";
                }
            }
            //Years
            else{
                if($years==1){
                    return "1 yr ago";
                }else{
                    return "$years yrs ago";
                }
            }
        }


        function cleanStr($string) {
           $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
           return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        }


        function cleanStrInputs($string) {
           $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
           return preg_replace('/[^A-Za-z0-9_\-\@\.]/', '', $string); // Removes special chars.
        }

        function cleanStrInputsDash($string) {
           $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
           return preg_replace('/[^A-Za-z0-9_\-\@\.]/', '', $string); // Removes special chars.
        }


        function convertTime($difference){
            $days = intval($difference / 86400); 
            $difference = $difference % 86400;
            $hours = intval($difference / 3600)+($days*24); 
            $difference = $difference % 3600;
            $minutes = intval($difference / 60);
            $difference = $difference % 60;
            $seconds = intval($difference); 
            $check_zero = $days;
            if($check_zero<=0)
                return ("<font style='font-size:14px;'>".$hours."hrs</font>");
            else
                return ($days." Days");
        }


    }



    function send_mail($from_email, $to_email, $from_name, $messages, $subj){
        $this->load->library('email');
        $this->email->initialize(array(
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.sendgrid.net',
          'smtp_user' => 'apikey',
          'smtp_pass' => 'xxxxx',
          //'smtp_port' => 465,
          'smtp_port' => 587,
          'crlf' => "\r\n",
          'newline' => "\r\n"
        ));

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


    
    function getMemName(){
        return $this->sql_models->getMemDetails();
    }



    public function profile(){
        if($this->isCompatible()) redirect('compatibility');
        $mem_id = $this->uri->segment(2);
        $mem_id1 = substr($mem_id, 0, -5);

        $model_details = $this->sql_models->fetchAMembers($mem_id1);
        if(!$model_details) redirect('');

        $this->sql_models->updateViews1($mem_id1, 'members');

        $names = ucwords($model_details['names']);
        $nickname = ucwords($model_details['nickname']);
        if(strlen($names)<=2) $names = ucwords($nickname);

        $data['page_title'] = ucwords($names);
        $data['page_name'] = "profile";
        $data['page_header'] = "";
        //echo $this->myID; exit;
        $data['ent_parti'] = $this->sql_models->entryParticipated('entries', $mem_id1);

        $data['mdetls'] = $model_details;
        $this->load->view("header", $data);
        $this->load->view("single-model", $data);
        $this->load->view('footer', $data);
    }




    function add_members(){
        $txtpgname = $this->input->post('txtpgname');
        $this->form_validation->set_rules('txtnames', 'Names', 'required|trim|min_length[3]|alpha_space');
        $this->form_validation->set_rules('txtemail', 'Email', 'required|trim|is_unique[members.emails]|valid_email');
        if($txtpgname=="add_riders")
            $this->form_validation->set_rules('txtpass', 'Password', 'required|trim|min_length[5]');

        $this->form_validation->set_rules('txtphone', 'Phone Number', 'required|trim|numeric|regex_match[/^[0-9\+]{6,11}$/]');
        if($txtpgname=="add_customer")
            $this->form_validation->set_rules('txtaddr', 'Address', 'required|trim');
        
        
        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors());
        }else{

            $txtnames = $this->input->post('txtnames');
            $email = cleanStrInputs(strtolower($this->input->post('txtemail')));
            $txtpass = hash_password($this->input->post('txtpass'));
            $txtphone = $this->input->post('txtphone');
            $txtaddr = $this->input->post('txtaddr');
            $txtpgname = $this->input->post('txtpgname');
            $memType = "rid";
            $for_pass = $txtpass;
            $for_addr = "";
            if($txtpgname=="add_customer"){
                $memType = "mem";
                $for_pass = "";
                $for_addr = $txtaddr;
            }
            
            $newdata2 = array(
                'user_type'     => $memType,
                'names'         => $txtnames,
                'emails'        => $email,
                'pass1'         => $for_pass,
                'phone'         => $txtphone,
                'addr'          => $for_addr,
                'date_created'  => date("Y-m-d g:i a", time())
            );

            if($txtphone=="")
                $txtphone="<i style='color:#777'>Not Specified</i>";

            $memids = $this->sql_models->update_inserts_recs($newdata2, '', 'members');
            if(!$memids)
                $arrs = array('type' => 'error', 'msg'=>'Error in network connection!');
            else{

                if($txtpgname=="add_riders"){ // send mail to rider
                    //////////////////FOR EMAILS/////////////////////////
                        $message_contents = "<p style='margin-top:16px; font-size: 16px;'><b>Hello ".ucwords($txtnames).",</b></p>";
                        $message_contents .= "<p style='margin-top:5px; font-size: 15px; line-height: 20px;'>
                        The administrator has created a rider account for you with the following details:</p>";

                        $message_contents .= "<p style='margin:0px 0 20px 0'>                        
                        <b>Email:</b> ".strtolower($this->input->post('txtemail'))."<br>
                        <b>Password:</b> ".$this->input->post('txtpass')."<br>
                        <b>Phone:</b> $txtphone<br>
                        <b>Link to download our app:</b>*****</p>";
                    //////////////////FOR EMAILS///////////////////////// 

                    $subj = "New Rider Account";
                    $from = "Rider Account <noReply@websitename.com>";
                    $to = $email;
                    $from_name = "Rider Account Creation @ WebsiteName";

                    $message_contents1 = $this->mailHeader.$message_contents.$this->mailFooter;
                    $this->send_mail($from, $to, $from_name, $message_contents1, $subj);
                }
                $arrs = array('type'=>'success', 'msg'=>"");
            }
        }
        echo json_encode($arrs);
    }



    public function myprofile(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['page_name'] = "profile";
        $data['header_names'] = "MY PROFILE";
        $data['page_title'] = "Profile ";
        // $data['unread_msg'] = $this->unread_msg;
        $data['states1'] = $this->sql_models->fetchStates();
        $data['city1'] = $this->sql_models->fetchCitys($this->states);
        $data['datamsg'] = "You have successfully updated your profile.";
        $data['datamsg1'] = "";
        $data['url_id'] = "";
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function settings(){
        if($this->isCompatible()) redirect('compatibility');
        if($this->myID=="") redirect('');
        $data['show_name'] = $this->myfullname;
        $data['page_name'] = "settings";
        $data['header_names'] = "MY SETTINGS";
        $data['page_title'] = "My Settings";
        $data['url_id'] = "";
        $data['datamsg'] = "Your password has been updated!";
        $data['datamsg1'] = "";
        //$data['unread_msg'] = $this->unread_msg;
        $this->load->view("dashboard/header", $data);
        $this->load->view("dashboard/index", $data);
    }


    public function getSearches(){
        $keyword = $this->input->post('keyword');

        if(isset($keyword) && $keyword!=""){
            $result = $this->sql_models->searchStr($keyword);
            foreach ($result as $rs) {
                $phone = $rs['phone'];
                $addr = $rs['addr'];
                $stnames = ucwords($rs['names']);
                $emails = $rs['emails'];
                $stnames1 = str_replace("&", "and", $stnames);
                if($phone=="")
                    $phone1 = "<i>(phone: not specified)</i>";
                else
                    $phone1 = "<i>(phone:</b> $phone)</i>";
                $returnStr = str_replace($this->input->post('keyword'), '<b style="color:#960">'.$this->input->post('keyword').'</b>', $stnames.' '.$phone1);
                echo '<li class="set_item" setItem="'.str_replace(array("'"), "\'", $stnames1).'" phone="'.$phone.'" names="'.$stnames.'" emails="'.$emails.'" addr="'.$addr.'"><i class="fa fa-user"></i> &nbsp;'.$returnStr.'</li>';
            }
        }
    }



    public function getSearches_click(){
        $result = $this->sql_models->searchStr_click();
        foreach ($result as $rs) {
            $phone = $rs['phone'];
            $addr = $rs['addr'];
            $stnames = ucwords($rs['names']);
            $emails = $rs['emails'];
            $stnames1 = str_replace("&", "and", $stnames);
            if($phone=="")
                $phone1 = "<i>(phone: not specified)</i>";
            else
                $phone1 = "<i>(phone:</b> $phone)</i>";
            $returnStr = str_replace($this->input->post('keyword'), '<b style="color:#960">'.$this->input->post('keyword').'</b>', $stnames.' '.$phone1);
            echo '<li class="set_item" setItem="'.str_replace(array("'"), "\'", $stnames1).'" phone="'.$phone.'" names="'.$stnames.'" emails="'.$emails.'" addr="'.$addr.'"><i class="fa fa-user"></i> &nbsp;'.$returnStr.'</li>';
        }
    }


    function getPrice(){
        $pickups = $this->input->post('pickups');
        $deliverys = $this->input->post('deliverys');
        echo $this->sql_models->getPrice1($pickups, $deliverys);
    }


    
    function show_nearby_riders(){
        $pickups = $this->input->post('pickups');
        $this->db->select('*')->from('members')->where('user_type', "rid");

        if(isset($pickups) && $pickups!=""){
            $srchs = "(addr like '%$pickups%')";
            $this->db->where("$srchs");
        }

        $this->db->order_by('id', 'desc');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $fetch_data = $query->result_array();
            echo '<option value="" selected>-Select NearBy Rider-</option>';
            foreach($fetch_data as $row)
            {
                $ids1 = $row['id'];
                $rider_name = ucwords($row['names']);
                $phone = $row['phone'];
                if($phone!="") $phone1 = "($phone)"; else $phone1="<i>Not Specified</i>";
                echo "<option value='$ids1'>$rider_name $phone1</option>";
            }
        }else{
            echo '<option value="" selected>No rider found in this location</option>';
        }
    }
    

    function approve_paids(){
        $ids = $this->input->post('ids');
        $subscription = $this->input->post('subscription');
        $names = ucfirst($this->input->post('names'));
        $emails = $this->input->post('emails');
        $approve_it = $this->sql_models->approvePaids($ids, $subscription, $names, $emails, 'member_subscription');
        //echo $approve_it;
    }



    function update_my_pass(){
        $this->form_validation->set_rules('txtpass1', 'old password', 'required|trim');
        $this->form_validation->set_rules('txtpass2', 'new password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('txtpass3', 'confirm password', 'required|trim|matches[txtpass2]|min_length[5]');
        $oldpass = $this->input->post('txtpass1');
        $admin_type = $this->input->post('admin_type');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $new_pass = hash_password($this->input->post('txtpass3'));
            $updated = $this->sql_models->update_adm_password(sha1($this->input->post('txtpass3')), sha1($oldpass));

            if($updated){
                $now = 865000;
                if($admin_type=="00") $cookie_name = "adm_password_iconts"; else $cookie_name = "icont_pass";
                $cookie = array(
                    'name'   => $cookie_name,
                    'value'  => $new_pass,
                    'expire' => $now,
                    'secure' => FALSE
                );
                set_cookie($cookie);
                echo "pass1_updated";
            }else{
                echo "Invalid old password!";
            }
        }
    }



    function update_my_settings(){
        $this->form_validation->set_rules('txtloc_from[]', 'Location From', 'trim');
        $this->form_validation->set_rules('txtloc_to[]', 'Location To', 'trim');
        $this->form_validation->set_rules('txtloc_price[]', 'Price', 'trim|numeric');
        
        $txtloc_from = $this->input->post('txtloc_from');
        $txtloc_to = $this->input->post('txtloc_to');
        $txtloc_price = $this->input->post('txtloc_price');
        //$query = false;
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $kk=1;
            if($txtloc_from){
                foreach ($txtloc_from as $index=>$loc_from) {
                    $txtloc_to1      = $txtloc_to[$index];
                    $txtloc_price1   = $txtloc_price[$index];

                    $this->db->where('id', $kk);
                    $this->db->set("from_loc", $loc_from);
                    $this->db->set("to_loc", $txtloc_to1);
                    $this->db->set("price", $txtloc_price1);
                    $query = $this->db->update("distance_price");
                    $kk++;
                }
            }
            echo "setting_updated";
        }
    }



    function add_location(){
        $txtf_loc = $this->input->post('txtf_loc');
        $txtt_loc = $this->input->post('txtt_loc');
        $txtp = $this->input->post('txtp');

        $data = array(
            'from_loc'      => $txtf_loc,
            'to_loc'        => $txtt_loc,
            'price'         => $txtp
        );
        $query1 = $this->db->insert("distance_price", $data);
    }




    function logmein(){
        $this->form_validation->set_rules('txtlog_email', 'Email or Phone', 'required|trim');
        $this->form_validation->set_rules('txtlog_pass', 'Password', 'required|trim');

        if($this->form_validation->run() == FALSE){
            $arrs = array('type'=>'error', 'msg'=>validation_errors(), 'msg1'=>'', 'msg2'=>'');
        }else{
            $data = array(
                'emails' => cleanStrInputs(strtolower($this->input->post('txtlog_email'))),
                'pass' => $this->input->post('txtlog_pass')
            );

            $is_correct_id = $this->sql_models->get_user_logins($data);

            $retain_page_id1 = $this->input->cookie('retain_page_id1', TRUE);
            $retain_page_name = $this->input->cookie('retain_page_name', TRUE);
            $retain_page_params3 = $this->input->cookie('retain_page_params3', TRUE);

            if($is_correct_id){
                $arrs = array('type'=>'success', 'msg'=>$retain_page_id1, 'msg1'=>$retain_page_name, 'msg2'=>$retain_page_params3);
            }else{
                $arrs = array('type' => 'error', 'msg'=>'Invalid details entered!', 'msg1'=>'', 'msg2'=>'');
            }
        }
        echo json_encode($arrs);
    }



    /*function logouts(){
        $cookie = array(
            'name'   => 'logis_uname',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );
        $cookie1 = array(
            'name'   => 'logis_pass',
            'value'  => '',
            'expire' => '0',
            'secure' => FALSE
        );
        delete_cookie($cookie);
        delete_cookie($cookie1);
        redirect('shields/login');
    }*/




    function logme_adms(){
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('pass', 'password', 'required|trim');
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $is_correct_id = $this->sql_models->auth_details(strtolower($this->input->post('username')), strtolower($this->input->post('pass')));

            if($is_correct_id){
                echo "successor1";
            }else{
                echo "Invalid details entered!";
            }
        }
    }




}






