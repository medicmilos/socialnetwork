$(document).ready(function () {
    /*---------------------------SUBMIT POST---------------------------------------------------------*/
    $("#dodatak").hide();
    $("#tbTitle").click(function () {
        $("#dodatak").slideDown();
    });
    $("#btnClose").click(function () {
        $("#dodatak").toggle(function () {
            $(this).find('div').slideUp();
        });
    });
    /*---------------------------komentarisanje posta---------------------------------------------------------*/
    $('body').on('click', '.reply', function (e) {
        e.preventDefault();
        $(this).parent().html("<div id='dodatak2'><textarea name='taPost' id='taPost' rows='3' cols='64.5'></textarea><div id='p'></div><br/><input type='submit' name='btnPost' class='btn btn-primary' id='btnPost' value='Submit comment'/><input type='button' name='btnClose' class='btn btn-primary' id='btnClose' value='Close'/></br></div> ");
    });
    $('body').on('click', '#btnClose', function (e) {
        $(this).parent().html("<a href='' class='reply'>Comment</a>");
    });
    /*---------------------------progress bar---------------------------------------------------------*/
    $('.progress .progress-bar').progressbar();
    /*---------------------------asdsadasdsdsada---------------------------------------------------------*/
    $('#regexpForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            tbEmail: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            tbPassword: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    },
                    different: {
                        field: 'tbEmail',
                        message: 'The password cannot be the same as username'
                    },
                    regexp: {
                        regexp: /^[\w\s\/\.\_\d]{4,}$/,
                        message: 'The password cannot be shorter than 4 chars'
                    }

                }
            }
        }
    });
    $('#formaRegistracija').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            tbFirstName: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    },
                    stringLength: {
                        min: 2,
                        max: 20,
                        message: 'The first name must be more than 6 and less than 20 characters long'
                    },
                    regexp: {
                        regexp: /^[A-Z]{1}[a-z]{2,20}$/,
                        message: 'The first name must start with capital letter'
                    }
                }
            },
            tbLastName: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    },
                    stringLength: {
                        min: 3,
                        max: 20,
                        message: 'The last name must be more than 3 and less than 20 characters long'
                    },
                    regexp: {
                        regexp: /^[A-Z]{1}[a-z]{2,20}$/,
                        message: 'The last name must start with capital letter'
                    }

                }
            },
            tbEmail: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            tbPassword: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    },
                    different: {
                        field: 'tbFirstName',
                        message: 'The password cannot be the same as first name'
                    },
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'The password must be more than 4 and less than 20 characters long'
                    }
                }
            },
            tbPasswordConfirm: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    },
                    identical: {
                        field: 'tbPassword',
                        message: 'The password and its confirm are not the same'
                    },
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'The re-password must be more than 4 and less than 20 characters long'
                    }
                }
            },
            optradio: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            }
        }
    });
    $('#confirmform').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            tbEmail: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            tbPassword: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    },
                    different: {
                        field: 'tbEmail',
                        message: 'The password cannot be the same as username'
                    },
                    regexp: {
                        regexp: /^[\w\s\/\.\_\d]{4,}$/,
                        message: 'The password cannot be shorter than 4 chars'
                    }

                }
            }
        }
    });
        $('#contact').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            tbEmail: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            tbName: {
                validators: {
                    notEmpty: {
                        message: 'The full name is required'
                    },
                    regexp: {
                        regexp: /^[A-Z]{1}[a-z]{2,20}$/,
                        message: 'The name must start with capital letter'
                    }

                }
            },
             taMessage: {
                validators: {
                    notEmpty: {
                        message: 'The message is required'
                    }

                }
            }
        }
    });
});


function ajaxLike(id) {
    var xhttp;

    if (window.XMLHttpRequest) {
        xhttp = new XMLHttpRequest();
    } else {
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhttp.open("POST", "http://localhost:1234/network/Ajax/dodajLike/" + id, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("brojlike" + id).innerHTML = +JSON.parse(xhttp.responseText).likes + +1;
            document.getElementById("srcelike" + id).innerHTML = " <img id='slikalike' src='images/like.png'/> ";
            document.getElementById("ataglike" + id).innerHTML = " Liked ";
        }
    }
}


var http;
function ajaxprovera() {
    if (window.XMLHttpRequest) {
        http = new XMLHttpRequest();
    } else {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    http.open("GET", "poll.php", true);
    http.send();
    http.onreadystatechange = write_poll;
}
function write_poll() {
    if (http.readyState == 4) {
        document.getElementById("statistika2").innerHTML = http.responseText;
    }

}
function poll_vote() {
    if (window.XMLHttpRequest) {
        http = new XMLHttpRequest();
    } else {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    http.open("GET", "Feed/ajaxAnketa/" + getanswer(), true);
    http.send();
    http.onreadystatechange = write_poll;


}
function getanswer() {

    var n = parseInt(document.getElementById("numbofradio").value);
    var check = 0;

    for (var i = 1; i < n; i++) {
        if (document.getElementById("" + i).checked) {
            check = document.getElementById("" + i).value;
        }

    }
    return check;
}