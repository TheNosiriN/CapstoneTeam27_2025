function validateForm() {
  let firstName = document.forms["signup"]["first_name"].value.trim();
  let lastName = document.forms["signup"]["last_name"].value.trim();
  let email = document.forms["signup"]["email"].value.trim();
  let password = document.forms["signup"]["password"].value;
  let phoneNumber = document.forms["signup"]["phone_number"].value.trim();
  let birthday = document.forms["signup"]["birthday"].value.trim();

  let passwordPattern =
    /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  let phonePattern = /^\d{10,15}$/;

  if (!password.match(passwordPattern)) {
    alert(
      "Password must be at least 8 characters long, include one uppercase letter, one number, and one special character."
    );
    return false;
  }
  if (!phoneNumber.match(phonePattern)) {
    alert("Invalid phone number. It should be 10-15 digits.");
    return false;
  }
  return true;
}
