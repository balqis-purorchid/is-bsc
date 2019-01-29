<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    
    function __construct(){
        parent::__construct();
    }
    
    public function index($msg = NULL){
        // Load our view to be displayed
        // to the user
        $data['msg'] = $msg;
        $this->load->view('login_view', $data);
    }
    
    public function process(){
        // Load the model
        $this->load->model('login_model');
        // Validate the user can login
        $result = $this->login_model->validate();
        echo '<script>console.log("Your stuff here")</script>';
       	//echo "<script>console.log('$result')</script>";
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            $msg = '<font color=red>Invalid username and/or password.</font><br />';
            $this->index($msg);
        }else{
            // kalau akun memang ada, cek status kadaluarsanya
            if ($this->session->userdata('status') == 'false') {
                redirect('instrument');
            }
            else {
                $msg = '<font color=red>Kuesioner sudah ditutup.</font><br />';
                $this->session->sess_destroy();
                $this->index($msg);
            }
            
        }
    }
}
?>