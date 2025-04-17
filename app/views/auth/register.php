<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - <?= APP_NAME; ?></title>
    <link href="<?= BASEURL; ?>css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= BASEURL; ?>assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <!-- Basic registration form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <h3 class="fw-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Registration form-->
                                    <form action="<?= BASEURL; ?>auth/registration" method="POST" class="needs-validation">
                                        <!-- Form Row-->
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <!-- Form Group (first name)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputFirstName">First Name</label>
                                                    <input class="form-control" id="inputFirstName" name="inputFirstName" type="text" placeholder="Enter first name" autocomplete="off" minlength="2" required pattern="[A-Za-z\s]+" value="<?= isset($_POST['inputFirstName']) ? htmlspecialchars($_POST['inputFirstName'], ENT_QUOTES, 'UTF-8') : ''; ?>" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); if (this.value.length < this.minLength) { this.classList.add('is-invalid'); this.classList.remove('is-valid'); } else if (this.checkValidity()) { this.classList.add('is-valid'); this.classList.remove('is-invalid'); }" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (last name)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputLastName">Last Name</label>
                                                    <input class="form-control" id="inputLastName" name="inputLastName" type="text" placeholder="Enter last name" autocomplete="off" minlength="2" required pattern="[A-Za-z\s]+" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, ''); if (this.value.length < this.minLength) { this.classList.add('is-invalid'); this.classList.remove('is-valid'); } else if (this.checkValidity()) { this.classList.add('is-valid'); this.classList.remove('is-invalid'); }" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputUsername">Username</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Enter username" name="inputUsername" id="inputUsername" required autocomplete="off" pattern="[A-Za-z0-9]+" oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g, '')" />
                                                    <button class="btn btn-outline-primary" type="button" onclick="checkUsername();">Check</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPhone">Whatsapp Number</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Enter whatsapp number" name="inputPhone" id="inputPhone" required autocomplete="off" pattern="\+?[0-9\s]+" oninput="this.value = this.value.replace(/[^0-9\s+]/g, ''); " />
                                                    <button class="btn btn-outline-primary" type="button" onclick="checkPhone();">Check</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Form Row -->
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <!-- Form Group (password)-->
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
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (confirm password)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                    <input class="form-control" id="inputConfirmPassword" name="inputConfirmPassword" minlength="8" type="password" placeholder="Confirm password" autocomplete="off" required oninput="if (this.value === document.getElementById('inputPassword').value) { this.classList.add('is-valid'); this.classList.remove('is-invalid'); } else { this.classList.add('is-invalid'); this.classList.remove('is-valid'); }" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form Group (create account submit)-->
                                        <button type="submit" class="btn btn-primary" onclick="return validateUsername();">Create Account</button>
                                        <div id="loadingSpinner" class="spinner-border text-primary d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <script>
                                            function validateUsername() {
                                                const usernameInput = document.getElementById('inputUsername');
                                                const firstNameInput = document.getElementById('inputFirstName');
                                                const lastNameInput = document.getElementById('inputLastName');
                                                const passwordInput = document.getElementById('inputPassword');
                                                const confirmPasswordInput = document.getElementById('inputConfirmPassword');
                                                const loadingSpinner = document.getElementById('loadingSpinner');

                                                if (!usernameInput.classList.contains('is-valid')) {
                                                    alert('Please check the username availability first and ensure it is available.');
                                                    return false;
                                                }

                                                if (firstNameInput.value.trim().length < 2) {
                                                    alert('First name must be at least 2 characters long.');
                                                    firstNameInput.focus();
                                                    return false;
                                                }

                                                if (lastNameInput.value.trim() === '') {
                                                    alert('Last name cannot be empty.');
                                                    lastNameInput.focus();
                                                    return false;
                                                }

                                                if (passwordInput.value.length < 8) {
                                                    alert('Password must be at least 8 characters long.');
                                                    passwordInput.focus();
                                                    return false;
                                                }

                                                if (passwordInput.value !== confirmPasswordInput.value) {
                                                    alert('Passwords do not match.');
                                                    confirmPasswordInput.focus();
                                                    return false;
                                                }

                                                // Show the spinner while processing
                                                loadingSpinner.classList.remove('d-none');
                                                return true;
                                            }
                                        </script>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="<?= BASEURL; ?>auth">Have an account? Go to login</a></div>
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
    <script>
        // Bootstrap form validation
        (function() {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');

            Array.from(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
    <script>
        function checkUsername() {
            const username = document.getElementById('inputUsername').value;
            if (username) {
                // Perform an AJAX request to check username availability
                fetch('<?= BASEURL; ?>auth/checkUsername', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            username: username
                        }),
                    })
                    .then(response => {
                        console.log('Response:', response);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data:', data);
                        if (data.status === 'available') {
                            alert(`Username "${username}" is available!`);
                            document.getElementById('inputUsername').classList.add('is-valid');
                            document.getElementById('inputUsername').classList.remove('is-invalid');
                        } else if (data.status === 'exists') {
                            alert(`Username "${username}" is already taken.`);
                            document.getElementById('inputUsername').classList.add('is-invalid');
                            document.getElementById('inputUsername').classList.remove('is-valid');
                        } else {
                            alert('Unexpected response from the server.');
                            document.getElementById('inputUsername').classList.remove('is-valid', 'is-invalid');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while checking the username.');
                    });
            } else {
                alert('Please enter a username to check.');
            }
        }
    </script>
    <script>
        function checkPhone() {
            const phone = document.getElementById('inputPhone').value;
            if (phone) {
                // Perform an AJAX request to check phone availability
                fetch('<?= BASEURL; ?>auth/checkPhone', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            phone: phone
                        }),
                    })
                    .then(response => {
                        console.log('Response:', response);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data:', data);
                        if (data.status === 'available') {
                            alert(`Number "${phone}" is available!`);
                            document.getElementById('inputPhone').classList.add('is-valid');
                            document.getElementById('inputPhone').classList.remove('is-invalid');
                        } else if (data.status === 'exists') {
                            alert(`Number "${phone}" is already taken.`);
                            document.getElementById('inputPhone').classList.add('is-invalid');
                            document.getElementById('inputPhone').classList.remove('is-valid');
                        } else {
                            alert('Unexpected response from the server.');
                            document.getElementById('inputPhone').classList.remove('is-valid', 'is-invalid');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while checking the number phone.');
                    });
            } else {
                alert('Please enter a number phone to check.');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= BASEURL; ?>js/scripts.js"></script>
</body>

</html>
