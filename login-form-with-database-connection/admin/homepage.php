<?php
session_start();
include '../connect.php';

if(!isset($_SESSION['admin_name'])){
    header("Location: ../admin_login.php");
    exit();
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$count = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9; }
        .header { display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { margin: 0; color: #333; }
        .logout-btn { background: #e74c3c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 30px; background: white; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background-color: #333; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Dashboard: <?php echo $_SESSION['admin_name']; ?></h1>
        <a href="../logout.php" class="logout-btn">Logout</a>
    </div>

    <h3>Registered Users</h3>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['firstName']; ?></td>
                <td><?php echo $row['lastName']; ?></td>
                <td><?php echo $row['email']; ?></td>
            </tr>
            <?php $count++; endwhile; ?>
        </table>
    <?php else: ?>
        <p>No users found in database.</p>
    <?php endif; ?>

</body>
</html>