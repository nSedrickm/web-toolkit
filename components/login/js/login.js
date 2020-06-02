//select form inputs to validate
var password = $('.password').val();
var email = $('.email').val();

$('#submit-btn').click(function () {
    //Validation of valid email address.
    if (email === '' || indexat < 1 || (indexdot - indexat) < 2) {
        alert('Please enter a valid email address');
        $('.email').focus();
    }

    //Validation of password
    if (password == '') {
        alert('please enter a password');
        $('.password').focus();
    }
});

//toggle password view
$(".toggle").on('click', function () {
    var $pwd = $(".pwd");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});

