<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instrument extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->check_isvalidated();
    }
    
    public function index(){
        // Add a link to logout
        $this->load->model('instrument_model');

        //load scorecard
        $data_get = $this->instrument_model->load_bsc();

        $data['id_org'] = $data_get['id_org'];
        $data['perspektif'] = $data_get['perspektif'];
        $data['id_sistem'] = $data_get['id_sistem'];
        $data['instrumen'] = $data_get['instrumen'];
        

        $this->load->view('instrument_view', $data);
    }
    
    private function check_isvalidated(){
        if(! $this->session->userdata('validated_r')){
            redirect('login');
        }
    }

    public function do_logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

    public function pengisian() {
        $this->load->model('instrument_model');
        $tipe = $this->input->post('tipe');
        $jawaban = $this->input->post('instrumen');

        // pengecekan ini putaran berapa
        $last = $this->instrument_model->get_putaran($this->session->userdata('bscid'));
        $now = new DateTime();
        $putaran = 1;
        //kalau belum ada alias responden pertama
        if (! $last) {
            $putaran = 1;
        }
        else {
             //cek apakah si last row nilai ini udah lebih dari 6 bulan
            $tgl_msk = date_modify((new DateTime($last->tanggal_masuk)), '+6 month');
            if ($now >= date_modify($tgl_msk, '-3 day')) {
                $putaran = $last->putaran + 1;
            } else {
                $putaran = $last->putaran;
            }
        }
        $tgl = date_format($now, 'Y-m-d');

        // pengecekan ini pengisi ke berapa dengan nyari nomor pengisi terakhir
        $pengisi = $this->instrument_model->count_responden($this->session->userdata('bscid'), $putaran) + 1;
        
        //post jawaban
        $this->instrument_model->post_jawaban($this->session->userdata('bscid'), $tipe, $pengisi, $putaran, $jawaban, $tgl);
        // echo '<a href="'.base_url().'instrument/do_logout"><button type="button" class="btn btn-default">Log out</button></a>';

        //input ke database lewat model
        // $this->load->model('instrument_model');
        // $this->instrument_model->post_nilai($sum);

        //setelah pengisian, otomatis logout
        $this->do_logout();
        redirect('instrument');
    }
    
}
?>