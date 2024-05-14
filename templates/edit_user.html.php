

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="../edit_user.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>"><br>
        <label for="role">Role:</label><br>
        <select id="role" name="role_id">
            <option value="1" <?php if($role == 1) echo 'selected'; ?>>Admin</option>
            <option value="2" <?php if($role == 2) echo 'selected'; ?>>User</option>
        </select><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
