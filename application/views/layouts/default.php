<!DOCTYPE html> 
<html>
<head>
    <title><?php echo $title; ?></title>
    <link href="/public/styles/style.css" rel="stylesheet">
    <script src="/public/scripts/password.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
</head>
<body>
	<?php if (isset($_SESSION['admin'])): ?>
		<nav class="menu">
            <ul>
                <li> <a href="/admin/posts">Users</a> </li>
                <li> <a href="/admin/add">Add user</a> </li>
                <li> <a href="/admin/logout">Exit</a> </li> 
            </ul>
        </nav>
	<?php endif; ?>
    <?php echo $content; ?>
</body>
</html> 