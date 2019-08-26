<?php
class User_model extends CI_Model{
    
    public function userlogin($data){

        if(empty($data['userid']) || empty($data['pass'])){
            return "User name or password is empty";
        }

        $this->db->select('*');
        $this->db->from('users');
        $where = ['userid ='=> $data['userid'],'pass ='=> md5($data['pass']),'status' => 1];
        $this->db->where($where);
        $user = $this->db->get()->result_array();

        if(!empty($user)){
            $user = reset($user);

            //set session data
            $session_data = array(
                'uid' => $user['uid'],
                'email' => $user['email'],
                'name' => $user['name'],
                'login_state' => TRUE,
            );
            $this->session->set_userdata($session_data);

            //update login details and history
            $this->record_login($user, $data['login_type']);

            return "Welcome back!!!!";
        }else{
            return "User name or password not correct";
        }
    }

    public function record_login($user, $login_type)
    {   

        //login details
        $this->db->select('*');
        $this->db->from('login_details');
        $where = ['uid ='=> $user['uid'],'logintype ='=> $login_type];
        $this->db->where($where);
        $details = $this->db->get()->result_array();
        
        if(!empty($details)){
            $this->db->where('id', $details[0]['id']);
            $this->db->set('logincount', $details[0]['logincount']+1, FALSE);
            $this->db->set('updated', 'NOW()', FALSE);
            $this->db->update('login_details');
        }
        else{
            $details_data = array(
                'uid'=> $user['uid'],
                'logintype' => $login_type,
                'logincount' => 1,
                'updated' => date('Y-m-d H:i:s')
            );
            $this->db->insert('login_details', $details_data);
        }
        
        //login history
        if($login_type == 1){
            $ltype = 'Email';
        }
        elseif($login_type == 2){
            $ltype = 'Google';
        }
        else{
            $ltype = 'Facebook';
        }
        $this->db->insert('login_history', array('uid'=> $user['uid'], 'logintype'=> $ltype));
    }

    public function userinfo($uid)
    {   

        $userinfoarr = array();
        $this->db->select('*');
        $this->db->from('users');
        $where = ['uid ='=> $uid];
        $this->db->where($where);
        $userinfoarr = $this->db->get()->result_array();
        if(!empty($userinfoarr)){
            $userinfoarr = reset($userinfoarr);
        }
        return $userinfoarr;
    }

    public function delete_user($uid)
    {   
        $userarr = array();
        $this->db->select('*');
        $this->db->from('users');
        $where = ['uid ='=> $uid];
        $this->db->where($where);
        $userarr = $this->db->get()->result_array();
        if(!empty($userarr)){
            $this->db->where('uid', $userarr[0]['uid']);
            $this->db->set('status', 0);
            $this->db->set('deleted', 'NOW()', FALSE);
            if($this->db->update('users')){
                return 'Deleted successfully.';
            }

        }
        else{
            return 'User not found.';
        }
        return $userinfoarr;
    }


    public function create_account($data){
        
        if(!empty($data['email'])){
            $msg = '';
            $this->db->select('*');
            $this->db->from('users');
            $where = ['email ='=> $data['email']];
            $this->db->where($where);
            $user = $this->db->get()->result_array();

            if(!empty($user) && $user[0]['status'] == 1){
                    $this->session->set_flashdata('msg','Email id already exists');
                    redirect(base_url('user/register'));
            }
            else{
                if(!empty($user) && $user[0]['status'] == 0){
                    $msg = 'Your account deleted, Existed from '.$user[0]['created'].' to '.$user[0]['deleted'];
                }
                
                $userid = preg_replace('/([^@]*).*/', '$1', $data['email']);
                $userid = uniqid($userid);
                $pass = $this->randomPassword();
                
                //create an account
                $details_data = array(
                    'userid' => $userid,
                    'name' => $data['name'],
                    'pass' => md5($pass),
                    'age' => $data['age'],
                    'gender' => $data['gender'],
                    'email' => $data['email'],
                    'role' => 2,//default auth user
                    'latitude' => $data['lat'],
                    'longitude' => $data['long'],
                    'status' => 1,
                );

                if($this->db->insert('users', $details_data)){
                    
                    //send mail
                    $mail_params = array(
                        'userid'=> $userid, 
                        'email' => $data['email'], 
                        'pass' => $pass, 
                        'name' => $data['name']);
                    $mailstatus = $this->send_mail($mail_params);

                    //login after register
                    $logindata['userid'] = $userid;
                    $logindata['pass'] = $pass;
                    $logindata['login_type'] = 1;
                    
                    $msg .= $this->model->userlogin($logindata);

                    $msg = ($mailstatus == 1) ? $msg.", Mail sent!" : $msg.", Mail not sent";
                    $this->session->set_flashdata('msg',$msg);
                    redirect(base_url('user/profile'));
                }
            }
        }
    }

    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    private function send_mail($params){
        $config = Array(
            'protocol' =>'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => '<your mail here>',
            'smtp_pass' => '<your password here>',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
            );

        $this->load->library('email', $config);

        $this->email->from('<your mail here>', 'Social App');
        $this->email->to($params['email']);
        $this->email->subject("Your social app account got created!!!");
        $this->email->message('Hi '.$params['name'].
                            ' <br>Following are your login details: <br>'.
                            ' User ID: '.$params['userid'].
                            ' <br> Password: '.$params['pass']);
        $this->email->set_newline("\r\n");
        if($this->email->send()){
            return 0;
        }else{
            return 1;
        }
    }
}
?>