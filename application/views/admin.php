<div class="container top">
    
    <div class="row">
        <div class="span12 columns">
            <div class="well">

                <ul class="nav nav-pills">
                    <li role="presentation"><a href="<?php echo base_url(); ?>Feed">Home</a></li>
                    <li role="presentation" class="<?php
                    if (isset($klasa1)) {
                        echo $klasa1;
                    }
                    ?>"><a href="<?php echo base_url(); ?>Admin">Users</a></li>
                    <li role="presentation" class="<?php
                    if (isset($klasa2)) {
                        echo $klasa2;
                    }
                    ?>"><a href="<?php echo base_url(); ?>Admin/menu">Menu</a></li>
                    <li role="presentation" class="<?php
                    if (isset($klasa3)) {
                        echo $klasa3;
                    }
                    ?>"><a href="<?php echo base_url(); ?>Admin/poll">Poll</a></li>
                    <li role="presentation" class="<?php
                    if (isset($klasa4)) {
                        echo $klasa4;
                    }
                    ?>"><a href="<?php echo base_url(); ?>Admin/posts">Posts</a></li>
                    <li role="presentation" class="<?php
                    if (isset($klasa5)) {
                        echo $klasa5;
                    }
                    ?>"><a href="<?php echo base_url(); ?>Admin/comments">Comments</a></li>
                </ul>

            </div>
            <?php
            if (@$_SESSION["success"] == 1) {
                echo "<div class='alert alert-success' role='lert'
  <strong>Well done!</strong> You successfully executed your command.
</div>";
            }
            ?>
            <div class="page-header users-header">
                <h2>

                    <a href="<?php base_url(); ?><?php
                    if (empty($this->uri->segment(2))) {
                        echo "Admin/add/korisnik";
                    } else {
                        echo "add/" . $this->uri->segment(2);
                    }
                    ?>" class="btn btn-primary">Add a new</a> 
                </h2>
            </div>
            <?php
            echo $this->session->flashdata("obavestenje");
            echo $this->session->flashdata("lobavestenje");
            ?>
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <?php if (isset($useri)) { ?>
                        <tr>
                            <th class="header">#</th>
                            <th class="yellow header headerSortDown">First Name</th>
                            <th class="green header">Last Name</th>
                            <th class="red header">Avatar</th>
                            <th class="red header">Email</th>
                            <th class="red header">Status</th>
                            <th class="red header">Role</th>
                            <th class="red header">Manage</th>
                        </tr>
                    <?php } else if (isset($menu)) { ?>
                        <tr>
                            <th class="header">#</th>
                            <th class="yellow header headerSortDown">Menu place</th>
                            <th class="green header">Link name</th>
                            <th class="red header">Link</th>
                            <th class="red header">Class</th> 
                            <th class="red header">Manage</th>
                        </tr>
                    <?php } else if (isset($poll)) { ?>
                        <tr>
                            <th class="header">#</th>
                            <th class="yellow header headerSortDown">Question</th>
                            <th class="green header">Active</th> 
                            <th class="red header">Manage</th>
                        </tr>
                    <?php } else if (isset($post)) { ?>
                        <tr>
                            <th class="header">#</th>
                            <th class="yellow header headerSortDown">Text</th>
                            <th class="green header">User</th> 
                            <th class="red header">Likes</th>
                            <th class="red header">Manage</th>
                        </tr>
                    <?php } else if (isset($comment)) { ?>
                        <tr>
                            <th class="header">#</th>
                            <th class="yellow header headerSortDown">Post</th>
                            <th class="green header">User</th> 
                            <th class="red header">Comment</th>
                            <th class="red header">Manage</th>
                        </tr>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php
                    if (isset($updateK)) {
                        echo anchor("Admin", "Go back");
                        echo "<div class='container'><div class='row equal'><div class=' col-sm-offset-4'>";
                        echo validation_errors();
                        echo form_open_multipart('Admin/update');

                        echo "<label>First Name:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbFirstName', 'id' => 'firstname', 'class' => 'form-control', 'value' => $updateK->FirstName)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Last Name:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbLastName', 'class' => 'form-control', 'value' => $updateK->LastName)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Avatar:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo "<img width='50' height='50' src='" . base_url() . "images/members/" . $updateK->avatar . "'><br/>";
                        echo "</div><br/><br/><br/>";
                        echo "<label>Email:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbEmail', 'class' => 'form-control', 'value' => $updateK->email)) . "<br/>";
                        echo "</div><br/><br/><br/>";
                        echo "<label>Password:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbPassword', 'class' => 'form-control', 'value' => $updateK->password)) . "<br/>";
                        echo "</div><br/><br/><br/>";
                        echo "<label>Status:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbStatus', 'class' => 'form-control', 'value' => $updateK->status)) . "<br/>";
                        echo "</div><br/><br/><br/>";
                        echo "<label>Role:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbRole', 'class' => 'form-control', 'value' => $updateK->uloga)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo form_hidden('uredjajId', $updateK->id_korisnik);
                        echo form_hidden('tabela', 'korisnik');
                        echo form_submit(array('name' => 'btnUpisi', 'class' => 'btn btn-primary', 'value' => 'Update'));

                        echo form_close();
                        echo "</div></div></div>";
                        
                    } else if (isset($updateM)) {
                        echo anchor("Admin/menu", "Go back");
                        echo "<div class='container'><div class='row equal'><div class=' col-sm-offset-4'>";
                        echo validation_errors();
                        echo form_open_multipart('Admin/update');

                        echo "<label>Menu place:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbMenuPlace', 'class' => 'form-control', 'value' => $updateM->menu_place)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Link Name:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbName', 'class' => 'form-control', 'value' => $updateM->name)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Link:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbLink', 'class' => 'form-control', 'value' => $updateM->link)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Class:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbClass', 'class' => 'form-control', 'value' => $updateM->class)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo form_hidden('uredjajId', $updateM->id_menu);
                        echo form_hidden('tabela', "menu");

                        echo form_submit(array('name' => 'btnUpisi', 'class' => 'btn btn-primary', 'value' => 'Update'));

                        echo form_close();
                        echo "</div></div></div>";
                       
                    } else if (isset($updateP)) {
                        echo anchor("Admin/poll", "Go back");
                        echo "<div class='container'><div class='row equal'><div class=' col-sm-offset-4'>";
                        echo validation_errors();
                        echo form_open_multipart('Admin/update');

                        echo "<label>Question:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbQuestion', 'class' => 'form-control', 'value' => $updateP->question)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Active:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbActive', 'class' => 'form-control', 'value' => $updateP->active)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo form_hidden('uredjajId', $updateP->id_poll);
                        echo form_hidden('tabela', "poll");

                        echo form_submit(array('name' => 'btnUpisi', 'class' => 'btn btn-primary', 'value' => 'Update'));

                        echo form_close();
                        echo "</div></div></div>";
                    } else if (isset($updatePost)) {
                        echo anchor("Admin/posts", "Go back");
                        echo "<div class='container'><div class='row equal'><div class=' col-sm-offset-4'>";
                        echo validation_errors();
                        echo form_open_multipart('Admin/update');

                        echo "<label>Text:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbDescription', 'class' => 'form-control', 'value' => $updatePost->description)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Id user:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbIdKorisnik', 'class' => 'form-control', 'value' => $updatePost->id_korisnik)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Time:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbTime', 'class' => 'form-control', 'value' => $updatePost->time)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Likes:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbLikes', 'class' => 'form-control', 'value' => $updatePost->likes)) . "<br/>";
                        echo "</div><br/><br/><br/>";
                        echo form_hidden('uredjajId', $updatePost->id_post);
                        echo form_hidden('tabela', "posts");

                        echo form_submit(array('name' => 'btnUpisi', 'class' => 'btn btn-primary', 'value' => 'Update'));

                        echo form_close();
                        echo "</div></div></div>";
                    } else if (isset($updateC)) {
                        echo anchor("Admin/comments", "Go back");
                        echo "<div class='container'><div class='row equal'><div class=' col-sm-offset-4'>";
                        echo validation_errors();
                        echo form_open_multipart('Admin/update');

                        echo "<label>Post:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbIdPost', 'class' => 'form-control', 'value' => $updateC->id_post)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>User:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbUser', 'class' => 'form-control', 'value' => $updateC->email)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Comment:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbComment', 'class' => 'form-control', 'value' => $updateC->comment)) . "<br/>";
                        echo "</div><br/><br/><br/>";

                        echo "<label>Time:</label><br/>";
                        echo "<div class='col-sm-4'>";
                        echo form_input(array('name' => 'tbTime', 'class' => 'form-control', 'value' => $updateC->time)) . "<br/>";
                        echo "</div><br/><br/><br/>";
                        echo form_hidden('uredjajId', $updateC->id_comment);
                        echo form_hidden('tabela', "comments");

                        echo form_submit(array('name' => 'btnUpisi', 'class' => 'btn btn-primary', 'value' => 'Update'));

                        echo form_close();
                        echo "</div></div></div>";
                    }
                    
                    if (isset($useri)) {
                        foreach ($useri as $row) {

                            echo '<tr>';
                            echo '<td>' . $row->id_korisnik . '</td>';
                            echo '<td>' . $row->FirstName . '</td>';
                            echo '<td>' . $row->LastName . '</td>';
                            echo '<td>' . $row->avatar . '</td>';
                            echo '<td>' . $row->email . '</td>';
                            echo '<td>' . $row->status . '</td>';
                            echo '<td>' . $row->id_uloga . '</td>';
                            echo '<td class="crud-actions">
                  <a href="' . base_url() . 'Admin/update/' . $row->id_korisnik . '/korisnik" class="btn btn-info">view & edit</a> 
                  <a href="' . base_url() . 'Admin/delete/' . $row->id_korisnik . '/' . $tabela . '/id_korisnik" class="btn btn-danger">delete</a>
                </td>';
                            echo '</tr>';
                        }
                    } else if (isset($menu)) {
                        foreach ($menu as $row) {
                            echo '<tr>';
                            echo '<td>' . $row->id_menu . '</td>';
                            echo '<td>' . $row->menu_place . '</td>';
                            echo '<td>' . $row->name . '</td>';
                            echo '<td>' . $row->link . '</td>';
                            echo '<td>' . $row->class . '</td>';
                            echo '<td class="crud-actions">
                  <a href="' . base_url() . 'Admin/update/' . $row->id_menu . '/menu" class="btn btn-info">view & edit</a> 
                  <a href="' . base_url() . 'Admin/delete/' . $row->id_menu . '/' . $tabela . '/id_menu" class="btn btn-danger">delete</a>
                </td>';
                            echo '</tr>';
                        }
                    } else if (isset($poll)) {
                        foreach ($poll as $row) {
                            echo '<tr>';
                            echo '<td>' . $row->id_poll . '</td>';
                            echo '<td>' . $row->question . '</td>';
                            echo '<td>' . $row->active . '</td>';
                            echo '<td class="crud-actions">
                  <a href="' . base_url() . 'Admin/update/' . $row->id_poll . '/poll" class="btn btn-info">view & edit</a> 
                  <a href="' . base_url() . 'Admin/delete/' . $row->id_poll . '/' . $tabela . '/id_poll" class="btn btn-danger">delete</a>
                </td>';
                            echo '</tr>';
                        }
                    } else if (isset($post)) {
                        foreach ($post as $row) {
                            echo '<tr>';
                            echo '<td>' . $row->id_post . '</td>';
                            echo '<td>' . $row->description . '</td>';
                            echo '<td>' . $row->id_korisnik . '</td>';
                            echo '<td>' . $row->likes . '</td>';
                            echo '<td class="crud-actions">
                  <a href="' . base_url() . 'Admin/update/' . $row->id_post . '/posts" class="btn btn-info">view & edit</a> 
                  <a href="' . base_url() . 'Admin/delete/' . $row->id_post . '/' . $tabela . '/id_post" class="btn btn-danger">delete</a>
                </td>';
                            echo '</tr>';
                        }
                    } else if (isset($comment)) {
                        foreach ($comment as $row) {
                            echo '<tr>';
                            echo '<td>' . $row->id_comment . '</td>';
                            echo '<td>' . $row->id_post . '</td>';
                            echo '<td>' . $row->email . '</td>';
                            echo '<td>' . $row->comment . '</td>';
                            echo '<td class="crud-actions">
                  <a href="' . base_url() . 'Admin/update/' . $row->id_comment . '/comments" class="btn btn-info">view & edit</a> 
                  <a href="' . base_url() . 'Admin/delete/' . $row->id_comment . '/' . $tabela . '/id_comment" class="btn btn-danger">delete</a> 
                </td>';
                            echo '</tr>';
                        }
                    }
                    ?>      
                </tbody> 
            </table> 

            <?php
            if (isset($dodajK)) {
                echo anchor("Admin/posts", "Go back");
                echo "<div class='container'><div class='row equal'><div class=' col-sm-offset-4'>";
                echo validation_errors();
                echo form_open('Admin/add/korisnik');

                echo "<label>First Name:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbFirstName', 'class' => 'form-control', 'value' => set_value("tbFirstName"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Last Name:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbLastName', 'class' => 'form-control', 'value' => set_value("tbLastName"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Email:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbEmail', 'class' => 'form-control', 'value' => set_value("tbEmail"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Password:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_password(array('name' => 'tbPassword', 'class' => 'form-control', 'value' => set_value("tbPassword"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Uloga:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbUloga', 'class' => 'form-control', 'value' => set_value("tbUloga"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo form_submit(array('name' => 'btnUpisi', 'class' => 'btn btn-info', 'value' => 'Add'));
                echo form_close();
                echo "</div></div></div>";
            } else if (isset($dodajM)) {
                echo anchor("Admin/menu", "Go back");
                echo "<div class='container'><div class='row equal'><div class=' col-sm-offset-4'>";
                echo validation_errors();
                echo form_open('Admin/add/menu');

                echo "<label>Menu place:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbMenuPlace', 'class' => 'form-control', 'value' => set_value("tbMenuPlace"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Name:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbName', 'class' => 'form-control', 'value' => set_value("tbName"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Link:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbLink', 'class' => 'form-control', 'value' => set_value("tbLink"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Class:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_password(array('name' => 'tbClass', 'class' => 'form-control', 'value' => set_value("tbClass"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo form_submit(array('name' => 'btnUpisi', 'class' => 'btn btn-info', 'value' => 'Add'));
                echo form_close();
                echo "</div></div></div>";
            } else if (isset($dodajPost)) {
                echo anchor("Admin/posts", "Go back");
                echo "<div class='container'><div class='row equal'><div class=' col-sm-offset-4'>";
                echo validation_errors();
                echo form_open('Admin/add/posts');

                echo "<label>Text:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbDescription', 'class' => 'form-control', 'value' => set_value("tbDescription"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Id user:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbIdKorisnik', 'class' => 'form-control', 'value' => set_value("tbIdKorisnik"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Likes:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbLikes', 'class' => 'form-control', 'value' => set_value("tbLikes"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo form_submit(array('name' => 'btnUpisi', 'class' => 'btn btn-info', 'value' => 'Add'));
                echo form_close();
                echo "</div></div></div>";
            } else if (isset($dodajComment)) {
                echo anchor("Admin/comments", "Go back");
                echo "<div class='container'><div class='row equal'><div class=' col-sm-offset-4'>";
                echo validation_errors();
                echo form_open('Admin/add/comments');

                echo "<label>Post:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbIdPost', 'class' => 'form-control', 'value' => set_value("tbIdPost"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>User:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbUser', 'class' => 'form-control', 'value' => set_value("tbUser"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Comment:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbComment', 'class' => 'form-control', 'value' => set_value("tbComment"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo form_submit(array('name' => 'btnUpisi', 'class' => 'btn btn-info', 'value' => 'Add'));
                echo form_close();
                echo "</div></div></div>";
            } else if (isset($dodajPoll)) {
                echo anchor("Admin/comments", "Go back");
                echo "<div class='container'><div class='row equal'><div class=' col-sm-offset-4'>";
                echo validation_errors();
                echo form_open('Admin/add/poll');

                echo "<label>Question:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbQuestion', 'class' => 'form-control', set_value("tbQuestion"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Answer 1:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbAnswer1', 'class' => 'form-control', set_value("tbAnswer1"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo "<label>Answer 2:</label><br/>";
                echo "<div class='col-sm-4'>";
                echo form_input(array('name' => 'tbAnswer2', 'class' => 'form-control', set_value("tbAnswer2"))) . "<br/>";
                echo "</div><br/><br/><br/>";

                echo form_submit(array('name' => 'btnUpisi', 'class' => 'btn btn-info', 'value' => 'Add'));
                echo form_close();
                echo "</div></div></div>";
            }echo $this->pagination->create_links();
            ?> 

        </div>  
    </div>