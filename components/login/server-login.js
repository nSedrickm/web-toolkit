var http = require("http");
var express = require('express');
var app = express();
var bodyParser = require('body-parser');
var urlencodedParser = bodyParser.urlencoded({ extended: true });

// Running Server Details.
var server = app.listen(8082, function () {
    var port = server.address().port
    console.log("app listening on port %s", port)
});


app.get('/', function (req, res) {
    res.send("This is server side. please login from the browser");
});

app.post('/', urlencodedParser, function (req, res) {

    var email = req.body.email;
    var password = req.body.password;
    var passwordError = 'Wrong password';
    var emailError = 'Wrong email';

    //loggin contents received from form
    console.log(req.body);

    var html = '';

    html += `<!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
            integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Audiowide&display=swap" rel="stylesheet">
        <link href="http://127.0.0.1:8000//css/style.css" rel="stylesheet">

    </head>

    <body>

      <div class="container-fluid py-5">
      <div class="row justify-content-center align-items-center">
      <span class="border border-primary h2  text-primary bg-light py-5 px-4 rounded-circle logo">User Login</span>
      </div>
          <div class="row justify-content-center align-items-center mt-3"> `;

    html += `<span class= " h3 text-success text-center">Login Successful</span>'
            </div>`;
    html += '<div class="row justify-content-center align-items-center mt-2">';
    html += '<p class= " h5 text-dark text-center">email: ' + email + '</p>';
    html += '</div>'
    html += '<div class="row justify-content-center align-items-center mt-2 ">';
    html += '<p class= "h5 text-dark text-center">password: ' + password + '</p>';
    html += '</div>'

    html += `</div>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
          integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
          crossorigin="anonymous"></script>
          <!-- serving script from localhost at port 8000 -->
          <script src="http://127.0.0.1:8000/js/login.js" async defer></script>
  </body>

  </html>"`;

    var htmlError = '';

    htmlError += `<!DOCTYPE html>
  <html>

  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>login</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">
      <link href="https://fonts.googleapis.com/css?family=Audiowide&display=swap" rel="stylesheet">
      <link href="http://127.0.0.1:8000//css/style.css" rel="stylesheet">

  </head>

  <body>

    <div class="container-fluid py-5">
    <div class="row justify-content-center align-items-center">
    <span class="border border-primary h2  text-primary bg-light py-5 px-4 rounded-circle logo">User Login</span>
    </div>
        <div class="row justify-content-center align-items-center mt-3"> `;

    htmlError += `<span class= " h3 text-danger text-center">Login failed!</span>'
          </div>`;


    // area for writting error messages

    var emailErrorMessage = '<div class="row justify-content-center align-items-center mt-2">';

    var passwordErrorMessage = '<div class="row justify-content-center align-items-center mt-2 ">';



    var htmlErrorContinuation = `</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <!-- serving script from localhost at port 8000 -->

    <script src="http://127.0.0.1:8000/js/login.js" async defer></script>
</body>

</html>"`;

    //login form to eliminate the need to go back to previous login page

    var loginForm = `    <div class="container-fluid py-5">
<div class="row justify-content-center align-items-center">
    <div class="col col-sm-6 col-md-6 col-lg-4">
        <form class="form" name ="form" action="http://localhost:8082/" method="post">
            <div class="form-group">
                <label for="email"class = "text-primary h5">email</label>
                <input type="email" class="form-control form-control-lg email" placeholder="email@example.com"
                    name="email">
            </div>
            <div class="form-group">
                <label for="password" class ="text-primary h5">password</label>
                <div class="input-group">

                    <input type="password" class="form-control form-control-lg pwd border-right-0 password"
                        value="######" name="password">
                    <span class="input-group-btn">
                        <button class="btn btn-default toggle btn-lg border border-left-0 rounded-0"
                            type="button"><i class="fa fa-eye"></i></button>
                    </span>
                </div>
            </div>

                <button type='submit' class="btn btn-primary btn-lg">Sign in</button>
        </form>
    </div>
</div>
</div> `;

    //testing password and email for authentication

    if ((password != '######' || password == '') && (email != 'email@example.com' || email == '')) {
        console.log(emailError + ' and ' + passwordError + ' entered.');
        res.write(htmlError);
        res.write(emailErrorMessage += '<p class= " h5 text-dark text-center">email: ' + emailError + '</p>' + '</div>');
        res.write(passwordErrorMessage += '<p class= "h5 text-dark text-center">password: ' + passwordError + '</p>' + '</div>');
        res.write(loginForm);
        res.write(htmlErrorContinuation);
        res.end();

    }
    else if (email != 'email@example.com' || email == '') {
        console.log(emailError);
        res.write(htmlError);
        res.write(emailErrorMessage += '<p class= " h5 text-dark text-center">email: ' + emailError + '</p>' + '</div>');
        res.write(loginForm);
        res.write(htmlErrorContinuation);
        res.end();
    }
    else if (password != '######' || password == '') {
        console.log(passwordError);
        res.write(htmlError);
        res.write(passwordErrorMessage += '<p class= "h5 text-dark text-center">password: ' + passwordError + '</p>' + '</div>');
        res.write(loginForm);
        res.write(htmlErrorContinuation);
        res.end();
    }

    else {
        console.log("login Successful");
        res.send(html)
    }

});
