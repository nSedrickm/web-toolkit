var express = require("express");
var router = express.Router();
var bodyParser = require("body-parser");
var urlencodedParser = bodyParser.urlencoded({ extended: true });

/* GET home page. */
router.get("/", function(req, res, next) {
  res.render("index", { title: "Login" });
});

router.post("/login", urlencodedParser, function(req, res, next) {
  var email = req.body.email;
  var password = req.body.password;
  var passwordError = "Wrong password";
  var emailError = "Wrong email";

  //loggin contents received from form
  console.log(req.body);

  //some basic validateion

  if (
    (password != "######" || password == "") &&
    (email != "email@example.com" || email == "")
  ) {
    console.log(emailError + " and " + passwordError + " entered.");

    res.render("index", {
      alert: true,
      title: "Login failed",
      message: emailError + " and " + passwordError
    });
  } else if (email != "email@example.com" || email == "") {
    console.log(emailError);

    res.render("index", {
      alert: true,
      title: "Login failed",
      message: emailError
    });
  } else if (password != "######" || password == "") {
    console.log(passwordError);

    res.render("index", {
      alert: true,
      title: "Login failed",
      message: passwordError
    });
  } else {
    console.log("login Successful");

    res.render("account", {
      alert: false,
      title: "Logged in"
    });
  }
});

module.exports = router;
