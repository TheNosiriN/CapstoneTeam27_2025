document.addEventListener("DOMContentLoaded", function () {
  document.querySelector("form").addEventListener("submit", function (e) {
    let email = document.querySelector("[name='email']").value.trim();
    let password = document.querySelector("[name='password']").value.trim();

    if (email === "" || password === "") {
      alert("Both fields are required.");
      e.preventDefault();
    }
  });
});
