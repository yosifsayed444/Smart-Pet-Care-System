<h3>
    Login
</h3>

<form method="POST">

    <div>

        <label>Email</label>

        <input
            type="text"
            name="email">

        <?php if (! empty($errors['email'])): ?>

            <small>
                <?php echo $errors['email'] ?>
            </small>

        <?php endif; ?>

    </div>

    <div>

        <label>Password</label>

        <input
            type="password"
            name="password">

        <?php if (! empty($errors['password'])): ?>

            <small>
                <?php echo $errors['password'] ?>
            </small>

        <?php endif; ?>

    </div>


    <button
        type="submit">
        Login
    </button>

    <div>

        <a href="/SE1_Project/auth/register">
            Create Account
        </a>

    </div>

</form>