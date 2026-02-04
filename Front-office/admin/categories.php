<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<div class="admin-header">Categories</div>

<div class="admin-container">

    <?php
    
    include 'sidebar.php';
    ?>

    <div class="content">
        <h2>Categories</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Phones</td>
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