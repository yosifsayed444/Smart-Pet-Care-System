<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="container mt-5">

<h2>Contact Messages</h2>

<table class="table table-bordered mt-4">

<thead>

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Subject</th>
<th>Message</th>
<th>Date</th>

</tr>

</thead>

<tbody>

<?php if(!empty($messages)): ?>

<?php foreach($messages as $msg): ?>

<tr>

<td><?= $msg['id'] ?></td>

<td><?= $msg['name'] ?></td>

<td><?= $msg['email'] ?></td>

<td><?= $msg['subject'] ?></td>

<td><?= $msg['message'] ?></td>

<td><?= $msg['created_at'] ?></td>

</tr>

<?php endforeach; ?>

<?php endif; ?>

</tbody>

</table>

</div>

<!-- <?php require __DIR__ . '/../layouts/footer.php'; ?> -->