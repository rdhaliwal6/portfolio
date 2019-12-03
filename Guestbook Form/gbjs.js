document.getElementById("guest-form").onsubmit = validate;

function validate() {

    var isValid = true;

    var errors = document.getElementsByClassName("err");
    for (var i = 0; i < errors.length; i++) {
        errors[i].style.visibility = "hidden";
    }

    //Check first name
    var first =
        document.getElementById("firstName").value;
    if (first == "") {
        var errFirst = document.getElementById("err-fname");
        errFirst.style.visibility = "visible";
        isValid = false;
    }

    //Check last name
    var last =
        document.getElementById("lastName").value;
    if (last == "") {
        var errLast = document.getElementById("err-lname");
        errLast.style.visibility = "visible";
        isValid = false;
    }
    var url = document.getElementById("linkUrl").value;
    if(!url =="" && !isValidURL(url)){
        var errUrl = document.getElementById("err-Url");
        errUrl.style.visibility = "visible";
        isValid = false;
    }
    var email = document.getElementById("email").value;
    var errMail = document.getElementById("err-Email");
    if (!validateEmail(email)) {
        errMail.style.visibility = "visible";
        isValid = false;
    }

    var mail = document.getElementById("email-list");

    if(mail.checked && email == "")
    {
        errMail.style.visibility = "visible";
        isValid = false;
    }

    var meet = document.getElementById("meetMe").value;
    if (meet == "none") {
        var errMeet = document.getElementById("err-Meet");
        errMeet.style.visibility = "visible";
        isValid = false;
    }

    return isValid;
}

//Hide other when not clicked

$('#meetMe').change(function() {
    var selected = $(this).val();
    if(selected == 'Other'){
        $('#other1').css("display", "block");
    }
    else{
        $('#other1').css("display", "none");
    }
});

$(document).ready(function(){

    $("#email-format").css("display","none");

    $("#email-list").on("click", function () {
        if ($("#email-list").is(":checked"))
        {
            //Show
            $("#email-format").css("display","block");
        }
        else
        {
            //Hide
            $("#email-format").css("display","none")
        }
    });
});

function validateEmail(email){
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function isValidURL(string) {
    /*
    var res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    var c1 = (res !== null)
*/
    var contains = (string.indexOf('https://www.linkedin.com') > -1); //true
    return (contains);
};



