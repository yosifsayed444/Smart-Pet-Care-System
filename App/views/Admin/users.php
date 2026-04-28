<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-layout">
    <?php require __DIR__ . '/../layouts/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Users Management</h2>
            <a href="<?php echo ROOT ?>/admin/addUser" class="btn btn-sm btn-primary">Add New User</a>
        </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="thead-dark">

                    <tr>

                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

<?php if (! empty($users)): ?>

<?php foreach ($users as $row): ?>

<tr>

<td><?php echo $row['id'] ?></td>

<td><?php echo $row['username'] ?></td>

<td><?php echo $row['email'] ?></td>

<td><?php echo $row['phone'] ?></td>

<td><?php echo $row['role'] ?></td>

<td>

<a href="<?php echo ROOT ?>/admin/editUser/<?php echo $row['id'] ?>"
   class="btn btn-sm btn-warning">

Edit

</a>

<a href="<?php echo ROOT ?>/admin/deleteUser/<?php echo $row['id'] ?>"
   class="btn btn-sm btn-danger"
   onclick="return confirm('Delete this user?')">

Delete

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="6" class="text-center">

No Users Found

</td>

</tr>

<?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- <?php require __DIR__ . '/../layouts/footer.php'; ?> -->