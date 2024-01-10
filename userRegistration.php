<!-- Mulai Form Daftar User -->
<form id="usRegForm" class="needs-validation" novalidate action="prosesdaftar.php" method="post">
    <div class="mb-3">
        <label for="usname" class="form-label">Nama</label>
        <small id="statusMsg1"></small>
        <input type="text" class="form-control" name="usname" id="usname" required>
    </div>
    <div class="mb-3">
        <label for="usemail" class="form-label">Email address</label>
        <small id="statusMsg2"></small>
        <input type="email" class="form-control" name="usemail" id="usemail" required placeholder="name@example.com">
        <div class="invalid-feedback">
        </div>
        <div class="valid-feedback">
        </div>
    </div>
    <div class="mb-3">
        <label for="uspass" class="form-label">Password</label>
        <small id="statusMsg3"></small>
        <input type="password" class="form-control" name="uspass" id="uspass" required>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary d-grid gap-4 col-11 mx-auto" type="submit" id="submitButton" disabled>Daftar</button>
    </div>
</form>
</div>
<!-- Akhir Form Daftar User -->

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

