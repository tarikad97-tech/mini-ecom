const params = new URLSearchParams(window.location.search);
const id = params.get("id");

fetch("api/get_product.php?id=" + id)
.then(res => res.json())
.then(p => {
    document.getElementById("name").innerText = p.name;
    document.getElementById("price").innerText = p.price + " $";
});