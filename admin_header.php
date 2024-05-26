
<body>

    <header>
        <div class="mainlogo">
            <div class="logo">
                <a href="admin_index.php"><span>MuseBook &</span>
                    <span class="me">Chill</span></a>
            </div>
        </div>
        <div class="nav">
            <a href="admin_index.php">Home</a>
            <a href="add_books.php">Add Books</a>
            <a href="admin_orders.php">Orders</a>
            <a href="message_admin.php">Message</a>
            <a href="users_detail.php">Users</a>

        </div>
        <div class="right">
            <div class="log_info">
                <p>Hello <?php echo $_SESSION['admin_name']; ?></p>
            </div>
            <a class="Btn" href="logout.php?logout=<?php echo $_SESSION['admin_name']; ?>">logout</a>
        </div>
    </header>

</body>

</html>