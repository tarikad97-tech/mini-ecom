document.getElementById("loginfrm").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch("http://localhost/mini_ecommerce/mini-ecom/Back-office/admin/login.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    console.log(data.message);
    if(data.message === "success"){
      window.location.href = "http://localhost/mini_ecommerce/mini-ecom/";
    }
  })
  .catch(error => {
    console.error("Error:", error);
  });   
});