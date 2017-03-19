<div class="container">
    <div class="row equal">

        <div class="aside-left-parent col-xs-12 col-sm-3">  
            <nav role="navigation" class=" navbar-default">  
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> 
                <div class="aside-left col-xs-12 col-sm-8"> 
                    <div id="navbarCollapse" class="collapse navbar-collapse nav-justified">
                        <?php if (isset($leviMenu)): ?>
                            <ul class="nav nav-tabs nav-stacked">
                                <?php foreach ($leviMenu as $link): ?>
                                    <?php if ($link->link == "Profile/user") { ?>
                                        <li>

                                            <?php print anchor($link->link . "/" . $_SESSION["id_korisnik"], "<span class='left-icon " . $link->class . "'></span><span>" . $link->name . "</span>"); ?>
                                        </li>
                                    <?php } else { ?>
                                        <li>

                                            <?php print anchor($link->link, "<span class='left-icon " . $link->class . "'></span><span>" . $link->name . "</span>"); ?>
                                        </li>

                                    <?php } ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>

        <div class="profile userprofile col-xs-12 col-sm-9">
            <div class="profileLeft col-xs-12 col-sm-4">
                <div class="profileLeft1 col-xs-12 col-sm-12">
                    <div class="profileLeftInner1 col-xs-12 col-sm-12">
                        <?php
                        if (isset($podaciOkorisniku)) {
                            echo "<img src=" . base_url() . "images/members/thumbnail/" . $podaciOkorisniku['avatar'] . " width=200 height=201 >";
                        }
                        ?> 
                    </div>


                    <?php if ($this->uri->segment('3') == $_SESSION["id_korisnik"]) { ?>
                        <div class="profileLeftInner2 col-xs-12 col-sm-12">


                            <span id='avatar_span'>
                                <p>Change picture</p>
                                <?php print form_open_multipart('Profile/avatar'); ?>
                                <?php print form_upload(array('id' => 'avatar forma_avatar', 'name' => 'avatar', 'class' => 'form-control', 'onchange' => 'javascript:this.form.submit();')) ?> 
                                <?php print form_close(); ?>
                            </span>

                        </div>

                    <?php } else { ?> 

                        <?php
                        if (!isset($dalijeSubscribed)) {
                            echo "<p id='notsubscribed'><a href='" . base_url() . "Profile/addfriend/" . $this->uri->segment('3') . "' >Subscribe</a></p>";
                        } else {
                            echo "<p id='subscribed'>Subscribed</p>";
                        }
                    }
                    ?>

                </div>
                <div class="profileLeft2 col-xs-12 col-sm-12">
                    <p>Subscribed to:</p>
                    <?php
                    if (isset($subscribedUseri)) {
                        foreach ($subscribedUseri as $value) {
                            echo "<a href='" . base_url() . "Profile/user/" . $value->id_korisnik . "'>" . $value->FirstName . " " . $value->LastName . "</a><br/>";
                        }
                    } else {
                        echo "nije subscribovato nikoga";
                    }
                    ?>

                </div>
            </div>
            <div class="profileRight col-xs-12 col-sm-8">
                <div class="profileRight1 col-xs-12 col-sm-12"> 
                    <div class="profileRightInner1 col-xs-12 col-sm-12">
                        <h4>
                            <?php
                            if (isset($podaciOkorisniku)) {
                                echo $podaciOkorisniku['firstname'] . " " . $podaciOkorisniku['lastname'];
                            }
                            ?>
                        </h4>
                    </div>			
                    <div class="profileRightInner2 col-xs-12 col-sm-12">

                    </div>			
                    <div class="profileRightInner3 col-xs-12 col-sm-12">
                        <?php
                        if (!isset($dalijeSubscribedBroj)) {
                            echo "Subscribed to: 0 users";
                        } else {
                            echo "Subscribed to: " . $dalijeSubscribedBroj . " users";
                        }
                        ?>
                    </div> 
                </div>


                        <?php if ($this->uri->segment('3') == $_SESSION["id_korisnik"]) { ?>
                    <div class="profileRight3 col-xs-12 col-sm-12">
                        <?php print form_open($base_url . 'Profile/post', $form_tag_atributi); ?>
                                            <span>
                                        <?php
                                        if (isset($podaciOkorisniku)) {
                                            echo "<img src=" . base_url() . "images/members/" . $podaciOkorisniku['avatar'] . "" . " width='200' height='201' " . " >";
                                        }
                                        ?> 
                                            </span>
                                            <label name='tbTitle' id='tbTitle'>What's new?</label><br/> 
                                            <div id='dodatak'>
                                                <?php print form_textarea($description_atributi); ?>
                                                <div id='p'></div><br/> 
                                                <?php echo form_submit($submit_atributi); ?>
                                                <input type='button' name='btnClose' class="btn btn-primary" id='btnClose' value='Close'/></br>
                                            </div>

                        <?php print form_close(); ?>
                    </div>
                        <?php } ?>
                        <?php
                            if (isset($podaciOpostu)) {

                                foreach ($podaciOpostu['post'] as $value) {

                                    $liked = "";
                                    $notliked = "";
                                    $komentar = "";


                                    //KOMENTARI NA POSTOVE

                                    foreach ($postoviKorisnik as $value3) {

                                        if ($value3->id_post == $value['description']->id_post) {
                                            foreach ($komentariKorisnik as $value4) {
                                                if ($value4->id_post == $value3->id_post) {
                                                    
                                                    $phpdate = date("d M", strtotime($value3->time))." at ".date("g:i a", strtotime($value3->time));
                                                    
                                                    $komentar .= "
                                                                    <div class='commentblk profileRight4Inner1 col-xs-12 col-sm-12'><div class='profileRight4Inner12 col-xs-12 col-sm-12'><img src=" . base_url() . "images/members/" . $value4->avatar . "" . " width='200' height='201' " . " ><div class='usercontent'><div class='flname'><a href='" . base_url() . "Profile/user/" . $value4->id_korisnik . "'>" . $value4->FirstName . " " . $value4->LastName . "</a></div><div class='posttime'>" . $phpdate . "</div></div></div><div class='profileRight4Inner12 col-xs-12 col-sm-12'><div class='descuser'>" . $value4->comment . "</div></div></div><br/>";
                                                }
                                            }
                                        }
                                    }


                                    if ($value['description']->likes != 0) {



                                        //LAJKOVANJE

                                        foreach ($dalijeLajkovao as $value2) {


                                            if ($_SESSION['id_korisnik'] == $value2->id_korisnik && $value2->id_post == $value['description']->id_post) {

                                                $liked = "<span id='srcelike" . $value['description']->id_post . "'><img id='slikanolike slikanolike" . $value['description']->id_post . "' src='" . base_url() . "images/like.png' > </span> Liked <span id='brojlike" . $value['description']->id_post . "' class='brojbold'>" . $value['description']->likes . "</span>";
                                            } else if ($_SESSION['id_korisnik'] != $value2->id_korisnik && $value2->id_post == $value['description']->id_post) {

                                                $liked = "<span id='srcelike" . $value['description']->id_post . "'><img id='slikanolike slikanolike" . $value['description']->id_post . "' src='" . base_url() . "images/like.png' > </span><span id='ataglike" . $value['description']->id_post . "'><a href='#' onClick='ajaxLike(" . $value['description']->id_post . ")'>Like </a></span><span class='brojbold' id='brojlike" . $value['description']->id_post . "'>" . $value['description']->likes . "</span>";
                                            }
                                        }
                                    } else {
                                        $notliked = "<span id='srcelike" . $value['description']->id_post . "'><img id='slikanolike'  src='" . base_url() . "images/like.png' > </span><span id='ataglike" . $value['description']->id_post . "'><a href='#' onClick='ajaxLike(" . $value['description']->id_post . ")'>Like</a></span><span class='brojbold' id='brojlike" . $value['description']->id_post . "'></span>";
                                    }



                                    echo ("

                                             <div class='profileRight4 col-xs-12 col-sm-12' > 
                                                    <div class='profileRight4Inner1 col-xs-12 col-sm-12'>
                                                            <div class='profileRight4Inner12 col-xs-12 col-sm-12'>


                                                                            <img src=" . base_url() . "images/members/" . $value['description']->avatar . "" . " width='34' height='34' " . " ><div class='usercontent'><div class='flname'><a href='" . base_url() . "Profile/user/" . $value['description']->id_korisnik . "'>" . $value['description']->FirstName . " " . $value['description']->LastName . "</a></div><div class='posttime'>" . $value['postTime'] . "</div></div>


                                                            </div>
                                                            <div class='profileRight4Inner12 col-xs-12 col-sm-12'>

                                                                            <div class='descuser'>" . $value['description']->description . "</div> 
                                                            </div>
                                                    </div>
                                                    <div class='profileRight4Inner2 col-xs-12 col-sm-12'>
                                                            <div class='likeblock'>


                                                            " . @$liked . "" . @$notliked . "





                                                            </div><div class='commentblock' >
                                                            " . form_open($base_url . 'Feed/comment', $form_tag_atributi) . " 
                                                            " . form_input(array(
                                        'type' => 'hidden',
                                        'name' => 'id_post',
                                        'value' => $value['description']->id_post,
                                    )) . "
                                                            <div>
                                                                    <a href='' class='reply'>Comment</a>
                                                            </div>
                                                            " . form_close() . "
                                                            </div>
                                                    </div>
                                                    " . @$komentar . "
                                            </div> 
                                            ");
                                }
                            }
                        ?>
            </div>
        </div>
    </div>
</div> 
