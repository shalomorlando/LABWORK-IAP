//create a function to validate our form
//the function is called when the function is submitted

function validateForm() {
    var fname = document.forms["user_details"]["first_name"].value;
    var lname = document.forms["user_details"]["last_name"].value;
    var city = document.forms["user_details"]["city_name"].value;
    if (fname == "" || lname == "" || city == "") {
      alert("Not all required details were supplied");
      return false;
    }
  }