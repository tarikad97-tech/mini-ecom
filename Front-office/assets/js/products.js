fetch("http://localhost/mini_ecommerce/mini-ecom/Back-office/public/allproducts.php")
.then(res => res.json())
.then(data => {
    let html = "";
    data.forEach(p => {
        html += `
            <div class="product-card">
            <div class="image-wrapper">
            <img src="${p.image}" alt="Product Name">
             <span class="category-label">${p.category_id}</span>
             </div>
              <div class="product-info">
              <h3>${p.name}</h3>
                    <p class="description">${p.description}.</p>
 <div class="price-row">
                         <span class="price">${p.price}DH</span>
                         <button class="add-btn">Add to Cart</button>
                     </div>
                     </div>
               
            </div>
        `;
    });
    document.getElementById("product-grid").innerHTML = html;
});
