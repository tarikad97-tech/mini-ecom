fetch("api/get_cart.php")
.then(res => res.json())
.then(data => {
    let html = "";
    data.forEach(item => {
        html += `
            <p>${item.name} x ${item.qty}</p>
        `;
    });
    document.getElementById("cart").innerHTML = html;
});