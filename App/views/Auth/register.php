<!DOCTYPE html>
<html>

<head>
    <title>Register</title>

</head>

<body>


    <form method="POST">

        <!-- Username -->

        <label>Username</label>

        <input
            type="text"
            name="username" "
                                    value=" <?php echo $_POST['username'] ?? '' ?>">

        <?php if (! empty($errors['username'])): ?>

            <small>
                <?php echo $errors['username'] ?>
            </small>

        <?php endif; ?>

        </div>


        <!-- Email -->

        <label>Email</label>

        <input
            type="text"
            name="email" "
                                    value=" <?php echo $_POST['email'] ?? '' ?>">

        <?php if (! empty($errors['email'])): ?>

            <small>
                <?php echo $errors['email'] ?>
            </small>

        <?php endif; ?>

        </div>


        <!-- Phone -->

        <label>Phone</label>

        <input
            type="text"
            name="phone" "
                                    value=" <?php echo $_POST['phone'] ?? '' ?>">

        <?php if (! empty($errors['phone'])): ?>

            <small>
                <?php echo $errors['phone'] ?>
            </small>

        <?php endif; ?>

        </div>


        <!-- Password -->

        <label>Password</label>

        <input
            type="password"
            name="password" ">

                                <?php if (! empty($errors['password'])): ?>

                                    <small>
                                        <?php echo $errors['password'] ?>
                                    </small>

                                <?php endif; ?>

                            </div>


                            <button
                                type=" submit"
            ess w-100">
        Register
        </button>

        <divmt-3">

            <a href="/SE1_Project/auth">
                Already have account?
            </a>

            </div>

    </form>

</body>