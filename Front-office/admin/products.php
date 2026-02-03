<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<div class="admin-header">Products</div>

<div class="admin-container">

    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="categories.php">Categories</a>
        <a href="products.php">Products</a>
        <a href="orders.php">Orders</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h2>Products</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1</td>
                <td>iPhone</td>
                <td>1200$</td>
                <td>10</td>
                <td>
                    <a class="btn">Edit</a>
                    <a class="btn btn-danger">Delete</a>
                </td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>