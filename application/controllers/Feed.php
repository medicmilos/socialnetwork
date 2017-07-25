<?php

class Feed extends MY_Controller {

    private $podaci = array();

    public function __construct() {
        parent::__construct();

        $this->podaci['title'] = "Social network | Feed";

        $menu = $this->ucitajLeviMenuSajta();
        $this->podaci['leviMenu'] = $menu;
        $menu = $this->ucitajDesniMenuSajta();
        $this->podaci['desniMenu'] = $menu;
        $menu = $this->ucitajFooterMenuSajta();
        $this->podaci['footerMenu'] = $menu;

        $this->load->helper('form');
    }

    public function index() {
        $this->load->library("pagination");
        if ($this->session->userdata('ulogovan')) {
            //za what is new
            $form_tag_atributi = array('class' => 'form-inline', 'name' => 'login'); //,'onSubmit'=>'return provera();'
            $this->podaci['form_tag_atributi'] = $form_tag_atributi;
            $description_atributi = array('id' => 'taPost', 'name' => 'taPost', 'rows' => '6', 'cols' => '98.5');
            $this->podaci['description_atributi'] = $description_atributi;
            $submit_atributi = array('id' => 'btnPost', 'name' => 'btnPost', 'value' => 'Submit post', 'class' => 'btn btn-primary');
            $this->podaci['submit_atributi'] = $submit_atributi;
            //za komentare
            $form_tag_atributi = array('name' => 'comment'); //,'onSubmit'=>'return provera();'
            $this->podaci['form_tag_atributi'] = $form_tag_atributi;
            $comment_atributi = array('id' => 'taPost', 'name' => 'taPost', 'rows' => '6', 'cols' => '64.5');
            $this->podaci['comment_atributi'] = $comment_atributi;
            $submit_atributi = array('id' => 'btnSubmit', 'name' => 'btnSubmit', 'value' => 'Submit post', 'class' => 'btn btn-primary');
            $this->podaci['submit_atributi'] = $submit_atributi;

            //paginacija postova
            $this->load->model('Posts_model', 'posts');
            $data['total_rows'] = $this->posts->brojPostova();
            $data['base_url'] = base_url() . "Feed/index/";
            $data['per_page'] = 5;
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

            
            
            
            
            //ANKETA
            $this->load->model('Anketa_model');
            $this->podaci["polldata"]= $this->Anketa_model->getactivepoll(); 
            //o korisniku podaci

            $iduser = $this->session->userdata('id_korisnik');
            $this->load->model('Korisnik_model', 'korisnik');
            $this->korisnik->id_korisnik = $iduser;
            $korisnikoviPodaci = $this->korisnik->vratiSveOKorisnikuUsername();

            $FirstName = $korisnikoviPodaci->FirstName;
            $LastName = $korisnikoviPodaci->LastName;
            $avatar = $korisnikoviPodaci->avatar;

            $this->podaci["podaciOkorisniku"] = array("firstname" => $FirstName, "lastname" => $LastName, "avatar" => $avatar);

            //ucitavanje aknkete    

            $this->load->model("Anketa_model", "anketa");
            $rezultat1 = $this->anketa->dohvatiAnketu();

            $this->podaci["podaciZaAnketu"] = $rezultat1;
            //ucitavanje ODGOVORA aknkete    

            $this->load->model("Anketa_model", "anketa");
            $rezultat2 = $this->anketa->dohvatiOdgovoreAnkete();

            $this->podaci["podaciZaAnketuOdgovori"] = $rezultat2;
            //paginacija
            $this->pagination->initialize($data);
            $this->posts->limit = 5;

            if ($this->uri->segment(3) != null) {
                $this->posts->offset = $this->uri->segment(3);
            } else {
                $this->posts->offset = 0;
            }

            $this->load->model("Posts_model", "post");
            $lajkovi = $this->posts->dalijeLajkovan();
            $this->podaci["dalijeLajkovao"] = $lajkovi;


            //svi postovi na pocetnoj stranici
            $this->posts->id_korisnik = $this->session->userdata('id_korisnik');
            $sviPostovi = $this->posts->dohvatiSvePostove();
            $korPostTime = array('post' => array());
            
            foreach ($sviPostovi as $post) {
                $korPostTime['post'][] = array('description' => $post, 'postTime' => $this->time_elapsed_string($post->time));
            }
            $this->podaci["podaciOpostu"] = $korPostTime;
            
            //svi komentari na sve postove na pocetnoj stranici
            $komentari = $this->posts->dohvatiKomentareKorisnik();
            $this->podaci["komentariKorisnik"] = $komentari;
            $postovi = $this->posts->dohvatiPostoveKorisnik();
            $this->podaci["postoviKorisnik"] = $postovi;



            $this->load->view('header');
            $this->load->view('content', $this->podaci);
            $this->load->view('footer');
        } else {
            redirect("logovanje");
        }
    }

    public function comment() {
        $email = $this->session->userdata('email');
        $id_post = $this->input->post("id_post");
        $comment = $this->input->post("taPost");

        $this->load->model('Posts_model', 'posts');
        $this->posts->Email = $email;
        $this->posts->id_post = $id_post;
        $this->posts->comment = $comment;


        if ($this->posts->unosKomentara()) {
            redirect('Feed');
        } else {
            echo "Error with posting your comment, pls try again later.";
        }
    }

    public function proveraLajkova($id) {
        $this->load->model('Posts_model', 'post');
        $this->post->id_korisnik = $this->session->userdata('id_korisnik');
        $this->post->id_pist = $id;
        $proveraLajkova = $this->posts->proveraLajkova();

        //var_dump($proveraLajkova);
        $this->podaci["dalijelajkovao"] = $proveraLajkova;
        return $proveraLajkova;
    }

   /* public function ajaxAnketa($id) {
        $userIP = $this->input->ip_address();
        $this->load->model('Anketa_model', 'anketa');
        $this->anketa->userIP = $userIP;
        $result = $this->anketa->dohvatiUserIP();

        if (@$result) {
            $this->load->model("Anketa_model", "anketa");
            $rezultat1 = $this->anketa->dohvatiAnketu();


            $idPoll = $rezultat1['id_poll'];
            $this->load->model('Anketa_model', 'anketa');
            $this->anketa->id_poll = $userIP;
            $result3 = $this->anketa->dohvatiOdredjenuAnketu();

            foreach ($result3 as $value) {
                echo $value['answer'] . " : " . $value['votes'] . "<br/>";
            }

            echo "<div class='already'>You already voted.</div>"; #vratiti rez glasanja
        } else {
            if ($id != '0') {
                $query = "INSERT INTO poll_votes VALUES('','" . $_GET['answers'] . "','" . $_SERVER["REMOTE_ADDR"] . "')";
                $query2 = "UPDATE poll_answers SET votes = votes + 1 WHERE id_answers='" . $_GET['answers'] . "'";
                include('konekcija.php');
                $result = mysql_query($query, $konekcija);
                mysql_query($query2, $konekcija);
                mysql_close($konekcija);

                echo "<div class='thanks'>Thanks for vote.</div>";
                $query11 = "SELECT * FROM poll WHERE active='1'";
                include('konekcija.php');
                $result22 = mysql_query($query11, $konekcija);
                $r2 = mysql_fetch_array($result22);

                $query3 = "SELECT * FROM poll_answers WHERE id_poll='" . $r2['id_poll'] . "'";
                $result3 = mysql_query($query3, $konekcija);
                mysql_close($konekcija);

                while ($red = mysql_fetch_array($result3)) {
                    echo $red['answer'] . " : " . $red['votes'] . "<br/>";
                }
            } else {
                echo "<div class='already'>Select an answer!</div>";
            }
        }
    }*/
    public function ajaxAnketa($id) {
        
    }
    /* public function Like() {

      } */
}
