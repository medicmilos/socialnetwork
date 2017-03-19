<?php

class Admin extends MY_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('ulogovan')) {
            redirect('Logovanje');
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("Admin_model", "admin");
    }

    public function index() {
        
         //paginacija postova 
            $data['total_rows'] = $this->admin->brojKorisnika();
            $data['base_url'] = base_url() . "Admin/index/";
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
            $this->admin->limit = 3;

            if ($this->uri->segment(3) != null) {
                $this->admin->offset = $this->uri->segment(3);
            } else {
                $this->admin->offset = 0;
            }
        $useri = $this->admin->dohvatiUsere();
        $this->data['useri'] = $useri;
        $this->data['klasa1'] = "active";
        $this->data['tabela'] = "korisnik";

        $this->load->view("admin.php", $this->data);
    }

    public function menu() {
        $menu = $this->admin->dohvatiMenu();
        $this->data['menu'] = $menu;
        $this->data['klasa2'] = "active";
        $this->data['tabela'] = "menu";

        $this->load->view("admin.php", $this->data);
    }

    public function poll() {
        $poll = $this->admin->dohvatiPoll();
        $this->data['poll'] = $poll;
        $this->data['klasa3'] = "active";
        $this->data['tabela'] = "poll";

        $this->load->view("admin.php", $this->data);
    }

    public function posts() {
        $post = $this->admin->dohvatiPostove();
        $this->data['post'] = $post;
        $this->data['klasa4'] = "active";
        $this->data['tabela'] = "posts";

        $this->load->view("admin.php", $this->data);
    }

    public function comments() {
        $comment = $this->admin->dohvatiKomentare();
        $this->data['comment'] = $comment;
        $this->data['klasa5'] = "active";
        $this->data['tabela'] = "comments";

        $this->load->view("admin.php", $this->data);
    }

    public function delete($ide) {
        $id = $ide;
        $tabela = $this->uri->segment(4);
        $kolona = $this->uri->segment(5);
        $this->admin->id = $id;
        $this->admin->tabela = $tabela;
        $this->admin->kolona = $kolona;
        $rez = $this->admin->delete();

        if ($rez) {
            if ($tabela == "korisnik") {
                $this->session->set_flashdata('success', 1);
                redirect("Admin");
            } else {
                $this->session->set_flashdata('success', 1);
                redirect("Admin/" . $tabela . "/success");
            }
        }
        $this->load->view("admin.php", $this->data);
    }

    public function update($id = NULL) {
        $tabela = $this->uri->segment(4);
        if ($id == NULL) {
            $id = $this->input->post("uredjajId");
            $tabela = $this->input->post("tabela");
        }


        if ($tabela == "korisnik") {
            $this->data['klasa1'] = "active";
            $this->data["updateK"] = $this->admin->dohvatiKorisnika($id);

            $this->form_validation->set_rules('tbFirstName', 'First Name', 'trim|required');
            $this->form_validation->set_rules('tbLastName', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('tbEmail', 'Email', 'trim|required');
            $this->form_validation->set_rules('tbPassword', 'Password', 'trim|required');
            $this->form_validation->set_rules('tbStatus', 'Status', 'trim|required');
            $this->form_validation->set_rules('tbRole', 'Role', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view("admin.php", $this->data);
            } else {
                $ulogae = "";
                if ($this->input->post("tbRole") == "korisnik") {
                    $ulogae = 2;
                } else if ($this->input->post("tbRole") == "admin") {
                    $ulogae = 1;
                }
                $value = array("FirstName" => $this->input->post("tbFirstName"), "LastName" => $this->input->post("tbLastName"), "email" => $this->input->post("tbEmail"), "password" => md5($this->input->post("tbPassword")), "status" => $this->input->post("tbStatus"), "id_uloga" => $ulogae);
                $rez = $this->admin->urediKorisnika($id, $value);
                if ($rez) {
                    $this->session->set_flashdata('obavestenje', "<div class='alert alert-success' role='lert'<strong>Well done!</strong> User successfully updated.</div>");
                } else {
                    $this->session->set_flashdata('lobavestenje', "<div class='alert alert-danger' role='lert'<strong>Warning!</strong>User unsuccessfully updated. </div>");
                }
                redirect("Admin");
            }
        } else if ($tabela == "menu") {
            $this->data['klasa2'] = "active";
            $this->data["updateM"] = $this->admin->dohvatiMenu1($id);

            $this->form_validation->set_rules('tbMenuPlace', 'Menu place', 'trim|required');
            $this->form_validation->set_rules('tbName', 'Name', 'trim|required');
            $this->form_validation->set_rules('tbLink', 'Link', 'trim|required');
            $this->form_validation->set_rules('tbClass', 'Class', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view("admin.php", $this->data);
            } else {
                $value = array("menu_place" => $this->input->post("tbMenuPlace"), "name" => $this->input->post("tbName"), "link" => $this->input->post("tbLink"), "class" => $this->input->post("tbClass"));
                $rez = $this->admin->urediMenu($id, $value);
                if ($rez) {
                    $this->session->set_flashdata('obavestenje', "<div class='alert alert-success' role='lert'<strong>Well done!</strong> Menu successfully updated.</div>");
                } else {
                    $this->session->set_flashdata('lobavestenje', "<div class='alert alert-danger' role='lert'<strong>Warning!</strong>Menu unsuccessfully updated. </div>");
                }
                redirect("Admin/menu");
            }
        } else if ($tabela == "poll") {
            $this->data['klasa3'] = "active";
            $this->data["updateP"] = $this->admin->dohvatiPoll1($id);

            $this->form_validation->set_rules('tbQuestion', 'Question', 'trim|required');
            $this->form_validation->set_rules('tbActive', 'Active', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view("admin.php", $this->data);
            } else {
                $value = array("question" => $this->input->post("tbQuestion"), "active" => $this->input->post("tbActive"));
                $rez = $this->admin->urediPoll($id, $value);
                if ($rez) {
                    $this->session->set_flashdata('obavestenje', "<div class='alert alert-success' role='lert'<strong>Well done!</strong> Poll successfully updated.</div>");
                } else {
                    $this->session->set_flashdata('lobavestenje', "<div class='alert alert-danger' role='lert'<strong>Warning!</strong>Poll unsuccessfully updated. </div>");
                }
                redirect("Admin/poll");
            }
        } else if ($tabela == "posts") {
            $this->data['klasa4'] = "active";
            $this->data["updatePost"] = $this->admin->dohvatiPost($id);

            $this->form_validation->set_rules('tbDescription', 'Text', 'trim|required');
            $this->form_validation->set_rules('tbIdKorisnik', 'Id user', 'trim|required');
            $this->form_validation->set_rules('tbTime', 'Time', 'trim|required');
            $this->form_validation->set_rules('tbLikes', 'Likes', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view("admin.php", $this->data);
            } else {
                $value = array("description" => $this->input->post("tbDescription"), "id_korisnik" => $this->input->post("tbIdKorisnik"), "time" => $this->input->post("tbTime"), "likes" => $this->input->post("tbLikes"));
                $rez = $this->admin->urediPost($id, $value);
                if ($rez) {
                    $this->session->set_flashdata('obavestenje', "<div class='alert alert-success' role='lert'<strong>Well done!</strong> Post successfully updated.</div>");
                } else {
                    $this->session->set_flashdata('lobavestenje', "<div class='alert alert-danger' role='lert'<strong>Warning!</strong>Post unsuccessfully updated. </div>");
                }
                redirect("Admin/posts");
            }
        } else if ($tabela == "comments") {
            $this->data['klasa4'] = "active";
            $this->data["updateC"] = $this->admin->dohvatiComment($id);

            $this->form_validation->set_rules('tbIdPost', 'Id post', 'trim|required');
            $this->form_validation->set_rules('tbUser', 'User', 'trim|required');
            $this->form_validation->set_rules('tbComment', 'Comment', 'trim|required');
            $this->form_validation->set_rules('tbTime', 'Time', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view("admin.php", $this->data);
            } else {
                $value = array("id_post" => $this->input->post("tbIdPost"), "email" => $this->input->post("tbUser"), "comment" => $this->input->post("tbComment"), "time" => $this->input->post("tbTime"));
                $rez = $this->admin->urediComment($id, $value);
                if ($rez) {
                    $this->session->set_flashdata('obavestenje', "<div class='alert alert-success' role='lert'<strong>Well done!</strong> Comment successfully updated.</div>");
                } else {
                    $this->session->set_flashdata('lobavestenje', "<div class='alert alert-danger' role='lert'<strong>Warning!</strong>Comment unsuccessfully updated. </div>");
                }
                redirect("Admin/comments");
            }
        }
    }

    public function add($tabela) {

        if ($tabela == "korisnik") {
            $this->data['klasa1'] = "active";
            $this->data['dodajK'] = TRUE;
            
            $this->form_validation->set_rules('tbFirstName', 'First Name', 'required|trim');
            $this->form_validation->set_rules('tbLastName', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('tbEmail', 'Email', 'required|trim');
            $this->form_validation->set_rules('tbPassword', 'Password', 'required|trim');
            $this->form_validation->set_rules('tbUloga', 'Uloga', 'required|trim');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view("admin.php", $this->data);
            } else {
                $x = $this->randomString(10);
                $value = array(
                    'FirstName' => $this->input->post('tbFirstName'),
                    'LastName' => $this->input->post('tbLastName'),
                    'avatar' => 'default.png',
                    'email' => $this->input->post('tbEmail'),
                    'password' => md5($this->input->post('tbPassword')),
                    'status' => 1,
                    'code' => $x,
                    'id_uloga' => $this->input->post('tbUloga')
                );
                $rez = $this->admin->dodajKorisnika($value);
                if ($rez) {
                    $this->session->set_flashdata('obavestenje', "<div class='alert alert-success' role='lert'<strong>Well done!</strong> User successfully added.</div>");
                } else {
                    $this->session->set_flashdata('lobavestenje', "<div class='alert alert-danger' role='lert'<strong>Warning!</strong>User unsuccessfully added. </div>");
                }
                redirect("Admin");
            }
        } else if ($tabela == "menu") {
            $this->data['klasa2'] = "active";
            $this->data['dodajM'] = TRUE;
            
            $this->form_validation->set_rules('tbMenuPlace', 'Menu place', 'trim|required');
            $this->form_validation->set_rules('tbName', 'Name', 'trim|required');
            $this->form_validation->set_rules('tbLink', 'Link', 'trim|required');
            $this->form_validation->set_rules('tbClass', 'Class', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view("admin.php", $this->data);
            } else {
                $value = array(
                    'menu_place' => $this->input->post('tbMenuPlace'),
                    'name' => $this->input->post('tbName'),
                    'link' => $this->input->post('tbLink'),
                    'class' => $this->input->post('tbClass')
                );
                $rez = $this->admin->dodajMenu($value);
                if ($rez) {
                    $this->session->set_flashdata('obavestenje', "<div class='alert alert-success' role='lert'<strong>Well done!</strong> Menu successfully added.</div>");
                } else {
                    $this->session->set_flashdata('lobavestenje', "<div class='alert alert-danger' role='lert'<strong>Warning!</strong>Menu unsuccessfully added. </div>");
                }
                redirect("Admin/menu");
            }
        } else if ($tabela == "posts") {
            $this->data['klasa3'] = "active";
            $this->data['dodajPost'] = TRUE;
            
            $this->form_validation->set_rules('tbDescription', 'Text', 'trim|required');
            $this->form_validation->set_rules('tbIdKorisnik', 'Id user', 'trim|required'); 
            $this->form_validation->set_rules('tbLikes', 'Likes', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view("admin.php", $this->data);
            } else {
                $value = array(
                    'description' => $this->input->post('tbDescription'),
                    'id_korisnik' => $this->input->post('tbIdKorisnik'),
                    'likes' => $this->input->post('tbLikes')
                );
                $rez = $this->admin->dodajPost($value);
                if ($rez) {
                    $this->session->set_flashdata('obavestenje', "<div class='alert alert-success' role='lert'<strong>Well done!</strong> Post successfully added.</div>");
                } else {
                    $this->session->set_flashdata('lobavestenje', "<div class='alert alert-danger' role='lert'<strong>Warning!</strong>Post unsuccessfully added. </div>");
                }
                redirect("Admin/posts");
            }
        }else if ($tabela == "comments") {
            $this->data['klasa5'] = "active";
            $this->data['dodajComment'] = TRUE;
            
            $this->form_validation->set_rules('tbIdPost', 'Id post', 'trim|required');
            $this->form_validation->set_rules('tbUser', 'User', 'trim|required');
            $this->form_validation->set_rules('tbComment', 'Comment', 'trim|required'); 

            if ($this->form_validation->run() == FALSE) {

                $this->load->view("admin.php", $this->data);
            } else {
                $value = array(
                    'id_post' => $this->input->post('tbIdPost'),
                    'email' => $this->input->post('tbUser'),
                    'comment' => $this->input->post('tbComment')
                );
                $rez = $this->admin->dodajComment($value);
                if ($rez) {
                    $this->session->set_flashdata('obavestenje', "<div class='alert alert-success' role='lert'<strong>Well done!</strong> Comment successfully added.</div>");
                } else {
                    $this->session->set_flashdata('lobavestenje', "<div class='alert alert-danger' role='lert'<strong>Warning!</strong>Comment unsuccessfully added. </div>");
                }
                redirect("Admin/comments");
            }
        }else if ($tabela == "poll") {
            $this->data['klasa3'] = "active";
            $this->data['dodajPoll'] = TRUE;
            
            $this->form_validation->set_rules('tbQuestion', 'Question', 'trim|required');
            $this->form_validation->set_rules('tbAnswer1', 'Answer 1', 'trim|required');
             $this->form_validation->set_rules('tbAnswer2', 'Answer 2', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view("admin.php", $this->data);
            } else {
                $valueQ = array(
                    'question' => $this->input->post('tbQuestion')
                );
                $valueA1 = $this->input->post('tbAnswer1');
                $valueA2 = $this->input->post('tbAnswer2');
                
                $rez = $this->admin->dodajPoll($valueQ);
                
                $this->admin->dodajQ1($valueA1,$rez);
                $this->admin->dodajQ2($valueA2,$rez);
                
                if ($rez) {
                    $this->session->set_flashdata('obavestenje', "<div class='alert alert-success' role='lert'<strong>Well done!</strong> Comment successfully added.</div>");
                } else {
                    $this->session->set_flashdata('lobavestenje', "<div class='alert alert-danger' role='lert'<strong>Warning!</strong>Comment unsuccessfully added. </div>");
                }
                redirect("Admin/poll");
            }
        }
    }

    public function randomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
