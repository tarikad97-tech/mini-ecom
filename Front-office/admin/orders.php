<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<div class="admin-header">Orders</div>

<div class="admin-container">

    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="categories.php">Categories</a>
        <a href="products.php">Products</a>
        <a href="orders.php">Orders</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h2>Orders</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Sanae</td>
                <td>300$</td>
                <td>Pending</td>
                <td>
                    <a class="btn">View</a>
                </td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>