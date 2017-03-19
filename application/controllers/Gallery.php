<?php

class Gallery extends MY_Controller {

    private $podaci = array();

    public function __construct() {
        parent::__construct();

        $this->podaci['title'] = "Social network | Gallery";

        $menu = $this->ucitajLeviMenuSajta();
        $this->podaci['leviMenu'] = $menu;
        $menu = $this->ucitajDesniMenuSajta();
        $this->podaci['desniMenu'] = $menu;
        $menu = $this->ucitajFooterMenuSajta();
        $this->podaci['footerMenu'] = $menu;
        $this->load->model("Gallery_model","galerija");
    }

    public function index() {
        $this->load->library("pagination");
        $this->load->view('header');
         //paginacija postova
            $this->load->model('Posts_model', 'posts');
            $data['total_rows'] = $this->galerija->brojSlika();
            $data['base_url'] = base_url() . "Gallery/index/";
            $data['per_page'] = 3;
            $data['num_links'] = 2;
            $data['full_tag_open'] = "<ul class='pagination'>";
            $data['full_tag_close'] = "</ul>";
            $data['num_tag_open'] = '<li>';
            $data['num_tag_close'] = '</li>';
            $data['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $data['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $data['next_tag_open'] = "<li>";
            $data['next_tagl_close'] = "</li>";
            $data['prev_tag_open'] = "<li>";
            $data['prev_tagl_close'] = "</li>";
            $data['first_tag_open'] = "<li>";
            $data['first_tagl_close'] = "</li>";
            $data['last_tag_open'] = "<li>";
            $data['last_tagl_close'] = "</li>";

          
            
        
          //paginacija
            $this->pagination->initialize($data);
            $this->galerija->limit = 3;

            if ($this->uri->segment(3) != null) {
                $this->galerija->offset = $this->uri->segment(3);
            } else {
                $this->galerija->offset = 0;
            }
        
        
        $rez=$this->galerija->dohvatiSlike();
        $this->podaci["galerija"]=$rez; 
        
        $this->load->view('gallery', $this->podaci);
        $this->load->view('footer');
    }

}
