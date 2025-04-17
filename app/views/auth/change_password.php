<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $data['title']; ?> - <?= APP_NAME; ?></title>
    <link href="<?= BASEURL; ?>css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <pre>
        <?php print_r($_SESSION); ?>
    </pre>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <!-- Basic forgot password form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <h3 class="fw-light my-4">New Password</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Forgot password form-->
                                    <form action="<?= BASEURL; ?>auth/updatePassword" method="POST">
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control" id="inputPassword" name="inputPassword" type="password" minlength="8" placeholder="Enter password" autocomplete="off" oninput="validatePasswordStrength(this.value)" required />
                                            <div class="mt-1">
                                                <small id="passwordStrength" class="form-text"></small>
                                            </div>
                                        </div>
                                        <script>
                                            function validatePasswordStrength(password) {
                                                const strengthIndicator = document.getElementById('passwordStrength');
                                                const passwordInput = document.getElementById('inputPassword');
                                                let strength = 'Weak';
                                                let color = 'text-danger';

                                                if (password.length >= 8) {
                                                    const hasUpperCase = /[A-Z]/.test(password);
                                                    const hasLowerCase = /[a-z]/.test(password);
                                                    const hasNumbers = /[0-9]/.test(password);
                                                    const hasSpecialChars = /[!@#$%^&*(),.?":{}|<>]/.test(password);

                                                    if (hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChars) {
                                                        strength = 'Strong';
                                                        color = 'text-success';
                                                    } else if ((hasUpperCase || hasLowerCase) && hasNumbers) {
                                                        strength = 'Medium';
                                                        color = 'text-warning';
                                                    }
                                                }

                                                strengthIndicator.textContent = `Password Strength: ${strength}`;
                                                strengthIndicator.className = `form-text ${color}`;

                                                if (strength === 'Weak') {
                                                    passwordInput.classList.add('is-invalid');
                                                    passwordInput.classList.remove('is-valid');
                                                } else {
                                                    passwordInput.classList.add('is-valid');
                                                    passwordInput.classList.remove('is-invalid');
                                                }
                                            }
                                        </script>
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                            <input class="form-control" id="inputConfirmPassword" name="inputConfirmPassword" minlength="8" type="password" placeholder="Confirm password" autocomplete="off" required oninput="if (this.value === document.getElementById('inputPassword').value) { this.classList.add('is-valid'); this.classList.remove('is-invalid'); } else { this.classList.add('is-invalid'); this.classList.remove('is-valid'); }" />
                                        </div>
                                        <!-- Form Group (submit options)-->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="footer-admin mt-auto footer-dark">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &copy; <?= APP_NAME; ?> <?= date('Y'); ?></div>
                        <div class="col-md-6 text-md-end small">
                            <a href="#!">Privacy Policy</a>
                            &middot;
                            <a href="#!">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= BASEURL; ?>js/scripts.js"></script>
</body>

</html>
