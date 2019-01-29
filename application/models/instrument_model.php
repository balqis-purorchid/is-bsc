<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instrument_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    // pengambilan nomor pengisi terakhir
    public function count_responden($id_bsc, $putaran) {
        //select last row dari bsc yg diinginkan
        $this->db->select('pengisi_ke');
        $this->db->from('tb_jawaban');
        $this->db->where('id_bsc', $id_bsc);
        $this->db->where('putaran', $putaran);
        $this->db->order_by('pengisi_ke', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get()->result();
        if(!$result) {
            $result = 0;
        } else{
            $result = $result[0]->pengisi_ke;
        }
        return $result;
    }

    // pengambilan data untuk melihat putaran sekarang
    public function get_putaran($id_bsc) {
        // get last inserted id yang id bsc nya sama
        $this->db->select('*');
        $this->db->from('tb_jawaban');
        // $this->db->where('id_nilai', max('id_nilai'));
        $this->db->where('id_bsc', $id_bsc);
        $this->db->order_by('id_jawaban', 'desc');
        $this->db->limit(1);
        return $this->db->get()->row();//return berupa 1 objek

    }

    public function load_bsc(){
        // grab user input
        $id_bsc = $this->session->userdata('bscid');
        
        //get organisasi, perspektif sama nilainya
        $this->db->select('*');
        $this->db->from('tb_bsc');
        $this->db->where('id_bsc', $id_bsc);
        $query = $this->db->get()->row();

        $id_org = $query->id_org;
        $perspektif = $query->perspektif;
        $id_sistem = $query->id_sistem;

        //get instrumen yang digunakan di bsc
        $this->db->select('*');
        $this->db->from('tb_instrumen_dipakai');
        $this->db->join('tb_instrumen', 'tb_instrumen.id_instrumen = tb_instrumen_dipakai.id_instrumen');
        $this->db->where('id_bsc', $id_bsc);
        $instrumen = $this->db->get()->result();
        
        return array(
            'id_org' => $id_org,
            'perspektif' => $perspektif,
            'id_sistem' => $id_sistem,
            'instrumen' => $instrumen,
        );
    }

    public function post_jawaban($bsc, $tipe, $pengisi, $putaran, $arr_jawaban, $tgl) {
        //post jawaban
        foreach ($arr_jawaban as $id_pakai_instrumen => $jawaban) {
            $dataJawaban = array(
                'id_jawaban' => '',
                'id_bsc' => $bsc,
                'putaran' => $putaran,
                'pengisi_ke' => $pengisi,
                'tipe_pengisi' => $tipe,
                'id_pakai_instrumen' => $id_pakai_instrumen,
                'jawaban' => $jawaban,
                'tanggal_masuk' => $tgl
            );
            $this->db->insert('tb_jawaban', $dataJawaban);
        }
       
    }
}