<div class="sidebar">
    <div class="sidebar-header">
        <div class="d-flex align-items-center">
            <div class="sidebar-icon mr-10">
                <i class="fa-solid fa-user"></i>
            </div>
            <p>Hello, <?php echo $_SESSION['admin_name']; ?></p>
        </div>
    </div>
    <ul class="sidebar-list">
        <li><a class="sidebar-items" href="list_category.php"><i class="fa-solid fa-layer-group"></i> Category</a></li>
        <li><a class="sidebar-items" href="total_books.php"><i class="fa-solid fa-book-open"></i> Book</a></li>
        <li><a class="sidebar-items" href="admin_orders.php"><i class="fa-solid fa-basket-shopping"></i> Order</a></li>
        <li><a class="sidebar-items" href="message_admin.php"><i class="fa-solid fa-envelope"></i> Message</a></li>
        <li><a class="sidebar-items" href="users_detail.php"><i class="fa-solid fa-user"></i> Users</a></li>
    </ul>
</div>