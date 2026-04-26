<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>
<?php if (! empty($_SESSION['success'])): ?> <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <script> Swal.fire({ icon: 'success', title: 'Success', text: '<?php echo $_SESSION['success'] ?>' }); </script> <?php unset($_SESSION['success']); ?> <?php endif; ?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Users Management</h2>

        <div><a href="<?php echo ROOT ?>/admin/addUser"
           class="btn btn-primary">

            Add New User

        </a>
        <a href="<?php echo ROOT ?>/admin/dashboard"
           class="btn btn-secondary">

            Back

        </a></div>

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