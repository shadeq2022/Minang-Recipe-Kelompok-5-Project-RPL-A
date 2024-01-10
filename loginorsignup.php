<?php
include('./dbConnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/main.min.css">
  <link rel="stylesheet" href="assets/css/font-awesmome/css/all.css">
  <link rel="stylesheet" href="assets/css/home.css">
  <link rel="stylesheet" href="preview/style-prev.css">
  <title>Minang Recipe</title>
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand me-auto" href="index.php">
        <img src="assets/img/Minang Recipe.png"></a>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvass-title" id="offcanvasNavbarLabel"><img src="assets/img/Minang Recipe.png"></h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link mx-lg-3 <?php if ($currentPage === 'home') echo 'active'; ?>" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-3 <?php if ($currentPage === 'resep') echo 'active'; ?>" href="resep-utama.php">Resep</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-3 <?php if ($currentPage === 'bantuan') echo 'active'; ?>" href="bantuan.php">Bantuan</a>
            </li>
          </ul>
        </div>
      </div>
      
      
      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <!-- END -->
<style>
    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .custom-link a {
        text-decoration: none;
    }

    .custom-link a:hover {
        text-decoration: underline;
    }

    .nav-link {
        color: black;
    }

    .icon-size {
        width: 27px;
        margin-right: 5px;
    }

    .custom-link a {
        text-decoration: none;
    }

    .custom-link a:hover {
        text-decoration: underline;
    }

    .nav-link {
        color: black;
    }

    .strong-pri {
        color: #AA6514;
    }



    hr {
        border: none;
        /* Menghilangkan garis bawaan */
        border-bottom: 2px solid #AA6514;
        /* Mengatur garis bawah dengan ketebalan 2px dan warna hitam (#000) */
        margin: 10px 0;
        /* Memberi sedikit ruang di atas dan di bawah garis */
    }
</style>


<main class="d-flex flex-nowrap">
    <div class="container mt-4 px-5 py-5" id="container-wrapper">
        <div class="row mb-3">

            <!-- card -->
            <div class="col-lg-12 mb-5 text-center">
                
            </div>
            <div class="col-md-6 text-center">
                <h5 class="text-info mb-3">
                    Jika sudah mendaftar ! Silahkan Login
                </h5>

                <div class="card mb-6">

                    <div class="form-group p-3">
                        <!-- Thumbnail dan Data -->
                        <form role="form" id="usLoginForm">
                            <div class="mb-3">
                                <strong class="strong-pri"><label for="usLogemail"
                                        class="form-label">Email:</label></strong>
                                <input type="email" class="form-control mb-3" name="usLogemail" id="usLogemail"
                                    required>

                                <strong class="strong-pri"><label for="usLogpass"
                                        class="form-label">Password:</label></strong>
                                <input type="password" class="form-control mb-3" name="usLogpass" id="usLogpass"
                                    required>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary d-grid gap-4 col-11 mx-auto"
                                    id="usLoginBtn" onclick="checkUsLogin()">Masuk</button>
                                <div class="d-grid gap-4 col-11 mx-auto">
                                    <div id="statusLogMsg"></div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 text-center mb-3">
            <h5 class="text-info mb-4">
                Belum punya akun? Silahkan Daftar
            </h5>

            <div class="card mb-2">

                <div class="form-group p-3">
                    <!-- Thumbnail dan Data -->
                    <form id="usRegForm" class="needs-validation" novalidate action="prosesdaftar.php" method="post">
                        <div class="mb-3">
                            <strong class="strong-pri"><label for="usname" class="form-label">Nama:</label></strong>
                            <input type="nama" class="form-control mb-3" name="usname" id="usname" required>


                            <strong class="strong-pri"><label for="usemail" class="form-label">Email
                                    address:</label></strong>
                            <input type="email" class="form-control mb-3" name="usemail" id="usemail" required>
                            <div class="invalid-feedback">
                            </div>
                            <div class="valid-feedback">
                            </div>

                            <strong class="strong-pri"><label for="uspass" class="form-label">Password:</label></strong>
                            <input type="password" class="form-control mb-3" name="uspass" id="uspass" required>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary d-grid gap-4 col-11 mx-auto mb-3" type="submit" id="submitButton"
                                disabled>Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Start Footer & Including JS-->
<?php
  include('./mainInclude/footer.php');
?>
<!-- End Footer-->

<script>
  // Script untuk Bootstrap validation
(() => {
  'use strict'

  const forms = document.querySelectorAll('.needs-validation')

  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})();

// Pengecekan tambahan untuk email yang sudah terdaftar
const emailField = document.getElementById('usemail');
const usernameField = document.getElementById('usname');
const passwordField = document.getElementById('uspass');
const submitButton = document.getElementById('submitButton');

const validateForm = () => {
  const validEmail = emailField.classList.contains('is-valid');
  const validUsername = usernameField.value.trim() !== '';
  const validPassword = passwordField.value.trim() !== '';

  submitButton.disabled = !(validEmail && validUsername && validPassword);
};

emailField.addEventListener('input', function () {
  const email = emailField.value;

  // Validasi dengan regular expression untuk format email
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailPattern.test(email)) {
    emailField.classList.remove('is-valid');
    emailField.classList.add('is-invalid');
    emailField.nextElementSibling.innerText = 'Email tidak valid!';
    submitButton.disabled = true;
    return;
  }

  fetch(`check_email.php?email=${email}`)
    .then(response => response.json())
    .then(data => {
      if (data.exists) {
        emailField.classList.remove('is-valid');
        emailField.classList.add('is-invalid');
        emailField.nextElementSibling.innerText = 'Email sudah terdaftar!';
        submitButton.disabled = true;
      } else {
        emailField.classList.remove('is-invalid');
        emailField.classList.add('is-valid');
        emailField.nextElementSibling.innerText = '';
        submitButton.disabled = false;
      }

      validateForm(); // Periksa semua field setelah validasi email
    //   console.log('Response from server:', data);
    })
    .catch(error => {
      console.error('Error:', error);
    });
});

usernameField.addEventListener('input', validateForm);
passwordField.addEventListener('input', validateForm);

</script>

