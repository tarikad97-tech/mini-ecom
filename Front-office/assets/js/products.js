fetch("api/get_products.php")
.then(res => res.json())
.then(data => {
    let html = "";
    data.forEach(p => {
        html += `
            <div class="product">
                <h3>${p.name}</h3>
                <p>${p.price} $</p>
                <a href="product.php?id=${p.id}">View</a>
            </div>
        `;
    });
    document.getElementById("products").innerHTML = html;
});