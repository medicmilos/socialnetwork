<?php

class Profile extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->podaci['title'] = "Social network | Feed";

        $menu = $this->ucitajLeviMenuSajta();
        $this->podaci['leviMenu'] = $menu;
        $menu = $this->ucitajFooterMenuSajta();
        $this->podaci['footerMenu'] = $menu;
        $menu = $this->ucitajDesniMenuSajta();
        $this->podaci['desniMenu'] = $menu;
        
        $this->load->helper('form');
        $this->load->helper('file');
    }

    public function index() {
        if ($this->session->userdata('ulogovan')) {
            $form_tag_atributi = array('class' => 'form-inline', 'name' => 'login'); //,'onSubmit'=>'return provera();'
            $this->podaci['form_tag_atributi'] = $form_tag_atributi;
            $description_atributi = array('id' => 'taPost', 'name' => 'taPost', 'rows' => '6', 'cols' => '98.5');
            $this->podaci['description_atributi'] = $description_atributi;
            $submit_atributi = array('id' => 'btnPost', 'name' => 'btnPost', 'value' => 'Submit post', 'class' => 'btn btn-primary');
            $this->podaci['submit_atributi'] = $submit_atributi;
        } else {
            redirect("logovanje");
        }
    }

    public function user($id) {
        $form_tag_atributi = array('class' => 'form-inline', 'name' => 'login'); //,'onSubmit'=>'return provera();'
        $this->podaci['form_tag_atributi'] = $form_tag_atributi;
        $description_atributi = array('id' => 'taPost', 'name' => 'taPost', 'rows' => '6', 'cols' => '98.5');
        $this->podaci['description_atributi'] = $description_atributi;
        $submit_atributi = array('id' => 'btnPost', 'name' => 'btnPost', 'value' => 'Submit post', 'class' => 'btn btn-primary');
        $this->podaci['submit_atributi'] = $submit_atributi;

        if (isset($id)) {
            $this->load->model('Korisnik_model', 'korisnik');
            $this->korisnik->id_korisnik = $id;
            $korisnikoviPodaci = $this->korisnik->vratiSveOKorisnikuUsername();

            $FirstName = $korisnikoviPodaci->FirstName;
            $LastName = $korisnikoviPodaci->LastName;
            $avatar = $korisnikoviPodaci->avatar;

            $this->podaci["podaciOkorisniku"] = array("firstname" => $FirstName, "lastname" => $LastName, "avatar" => $avatar);






            $this->load->model("Posts_model", "post");
            $lajkovi = $this->post->dalijeLajkovan();
            $this->podaci["dalijeLajkovao"] = $lajkovi;


            //dohvati da li je subscribe ili ne
            $this->load->model("Korisnik_model");
            $subs = $this->Korisnik_model->subscribed($this->session->userdata('id_korisnik'), $id);
            $this->podaci["dalijeSubscribed"] = $subs;
            //dohvati da li je subscribe ili ne BROJ
            $this->load->model("Korisnik_model");
            $subs = $this->Korisnik_model->subscribedNumber($id);
            var_dump($subs);
            $this->podaci["dalijeSubscribedBroj"] = $subs;
            //svi subscriberi koji se prikazuju na profilu korisnika
            $this->load->model("Korisnik_model");
            $subs2 = $this->Korisnik_model->subscribedUseri($id);
            $this->podaci["subscribedUseri"] = $subs2;


            // $id_korisnik = $this->session->userdata('id_korisnik');
            $this->load->model('Posts_model', 'posts');
            $this->posts->id_korisnik = $id;
            $korisnikoviPostovi = $this->posts->dohvatiKorisnikovePostove();


            $korPostTime = array('post' => array());
            foreach ($korisnikoviPostovi as $post) {
                $korPostTime['post'][] = array('description' => $post, 'postTime' => $this->time_elapsed_string($post->time));
            }


            $this->podaci["podaciOpostu"] = $korPostTime;

            //svi komentari na sve postove na pocetnoj stranici
            $komentari = $this->posts->dohvatiKomentareKorisnik();
            $this->podaci["komentariKorisnik"] = $komentari;
            $postovi = $this->posts->dohvatiPostoveKorisnik();
            $this->podaci["postoviKorisnik"] = $postovi;
        } else {
            $this->load->model('Korisnik_model', 'korisnik');
            $this->korisnik->id_korisnik = $this->session->userdata('id_korisnik');
            $korisnikoviPodaci = $this->korisnik->vratiSveOKorisnikuUsername();

            $FirstName = $korisnikoviPodaci->FirstName;
            $LastName = $korisnikoviPodaci->LastName;
            $avatar = $korisnikoviPodaci->avatar;

            $this->podaci["podaciOkorisniku"] = array("firstname" => $FirstName, "lastname" => $LastName, "avatar" => $avatar);



            //dohvati da li je subscribe ili ne
            $this->load->model("Korisnik_model");
            $subs = $this->Korisnik_model->subscribed($this->session->userdata('id_korisnik'), $id);
            $this->podaci["dalijeSubscribed"] = $subs;



            //lajkovi na postovima
            $this->load->model("Posts_model", "post");
            $lajkovi = $this->post->dalijeLajkovan();
            $this->podaci["dalijeLajkovao"] = $lajkovi;


            // $id_korisnik = $this->session->userdata('id_korisnik');
            $this->load->model('Posts_model', 'posts');
            $this->posts->id_korisnik = $this->session->userdata('id_korisnik');
            $korisnikoviPostovi = $this->posts->dohvatiKorisnikovePostove();


            $korPostTime = array('post' => array());
            foreach ($korisnikoviPostovi as $post) {
                $korPostTime['post'][] = array('description' => $post, 'postTime' => $this->time_elapsed_string($post->time));
            }


            $this->podaci["podaciOpostu"] = $korPostTime;

            //svi komentari na sve postove na pocetnoj stranici
            $komentari = $this->posts->dohvatiKomentareKorisnik();
            $this->podaci["komentariKorisnik"] = $komentari;
            $postovi = $this->posts->dohvatiPostoveKorisnik();
            $this->podaci["postoviKorisnik"] = $postovi;
        }
        $this->load->view('header');
        $this->load->view('profile', $this->podaci);
        $this->load->view('footer');
    }

    public function initKorsinik() {
        if ($this->session->userdata('ulogovan')) {
            $this->load->model('Korisnik_model', 'korisnik');
            $this->korisnik->id_korisnik = $id;
            $korisnikoviPodaci = $this->korisnik->vratiSveOKorisnikuUsername();

            $FirstName = $korisnikoviPodaci->FirstName;
            $LastName = $korisnikoviPodaci->LastName;
            $avatar = $korisnikoviPodaci->avatar;

            $this->podaci["podaciOkorisniku"] = array("firstname" => $FirstName, "lastname" => $LastName, "avatar" => $avatar);
        }
    }

    public function avatar() {
        $file = $this->input->post('avatar');

        $config['upload_path'] = './images/members/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload("avatar")) {
            $email = $this->session->userdata('email');
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = './images/members/' . $file_name;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 201;
            $config['new_image'] = './images/members/thumbnail/' . $file_name;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $this->load->model('Korisnik_model', 'korisnik');
            $this->korisnik->avatar = $file_name;
            $this->korisnik->Email = $email;

            if ($this->korisnik->promeniAvatar()) {
                $id_korisnik = $this->session->userdata('id_korisnik');
                redirect('Profile/user/' . $id_korisnik);
            } else {
                echo "Error with uploading your image, pls try again later.";
            }
        } else {
            echo "Error with uploading your image, pls try again later.";
        }
    }

    public function post() {
        $id_korisnik = $this->session->userdata('id_korisnik');
        $description = $this->input->post("taPost");

        $this->load->model('Posts_model', 'posts');
        $this->posts->id_korisnik = $id_korisnik;
        $this->posts->description = $description;

        if ($this->posts->unosPosta()) {
            redirect('Feed');
        } else {
            echo "Error with posting your post, pls try again later.";
        }
    }

    public function addfriend($fiend) {
        $id_korisnik = $this->session->userdata('id_korisnik');
        $this->load->model('Korisnik_model', 'friends');
        $this->friends->id_korisnik = $id_korisnik;
        $this->friends->id_friend = $fiend;

        if ($this->friends->dodajPrijatelja()) {
            redirect('Feed');
        } else {
            echo "Error with adding your friend, pls try again later.";
        }
    }

    public function friends() {
        $this->load->view('header');

        $this->load->model("Korisnik_model");
        $subs2 = $this->Korisnik_model->subscribedUseri($this->session->userdata('id_korisnik'));
        $this->podaci["subscribedTo"] = $subs2;

        $this->load->view('subscribedto', $this->podaci);
        $this->load->view('footer');
    }

}
