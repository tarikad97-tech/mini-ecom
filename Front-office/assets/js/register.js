<<<<<<< HEAD
document.getElementById("registerform").addEventListener("submit", function (e) {
=======
document.getElementById("registerfrm").addEventListener("submit", function (e) {
>>>>>>> fe107523e3ffa606ce3c43c4eaab6700ce3544be
  e.preventDefault();

  const formData = new FormData(this);

  fetch("http://localhost/mini_ecommerce/mini-ecom/Back-office/public/register.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    console.log(data.message);
    if(data.message === "success"){
      window.location.href = "http://localhost/mini_ecommerce/mini-ecom/Front-office/login.php";
    }
  })
  .catch(error => {
    console.error("Error:", error);
  });   
});