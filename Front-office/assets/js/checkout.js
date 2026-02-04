document.getElementById("checkoutForm").addEventListener("submit", e => {
    e.preventDefault();

    const data = new FormData(e.target);

    fetch("api/checkout.php", {
        method: "POST",
        body: data
    })
    .then(res => res.json())
    .then(r => {
        if (r.success) {
            window.location = "order_success.php?id=" + r.order_id;
        }
    });
});