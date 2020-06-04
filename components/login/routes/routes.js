var express = require("express");
var router = express.Router();
var bodyParser = require("body-parser");
var urlencodedParser = bodyParser.urlencoded({ extended: true });
var chalk = require("chalk");

/* GET home page. */
router.get("/", function(req, res, next) {
  res.render("index", { title: "Login" });
});

router.get("/account", function(req, res, next) {
  res.render("account", {
    alert: false,
    title: "Logged in"
  });
});

router.post("/login", urlencodedParser, function(req, res, next) {
  var email = req.body.email;
  var password = req.body.password;
  var passwordError = "Wrong password";
  var emailError = "Wrong email";

  //some basic validateion
  if (
    (password != "######" || password == "") &&
    (email != "email@example.com" || email == "")
  ) {
    console.log(chalk.red(emailError + " and " + passwordError + " entered."));

    res.render("index", {
      alert: true,
      title: "Login failed",
      message: emailError + " and " + passwordError
    });
  } else if (email != "email@example.com" || email == "") {
    console.log(chalk.red(emailError));

    res.render("index", {
      alert: true,
      title: "Login failed",
      message: emailError
    });
  } else if (password != "######" || password == "") {
    console.log(chalk.red(passwordError));

    res.render("index", {
      alert: true,
      title: "Login failed",
      message: passwordError
    });
  } else {
    console.log(chalk.green("login Successful"));

    res.redirect("/account");
  }
});

module.exports = router;
