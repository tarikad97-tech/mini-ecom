<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<div class="admin-header">Order Details</div>

<div class="admin-container">

 <?php
    
    include 'sidebar.php';
    ?>

    <div class="content">
        <h2>Order Details</h2>

        <p><strong>Customer:</strong> Sanae</p>
        <p><strong>Total:</strong> 300$</p>
        <p><strong>Status:</strong> Pending</p>

        <h3>Products</h3>

        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>iPhone</td>
                <td>2</td>
                <td>600$</td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>