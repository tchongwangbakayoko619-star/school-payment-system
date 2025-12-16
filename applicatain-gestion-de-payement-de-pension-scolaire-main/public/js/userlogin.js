
const form = document.getElementById('login-form');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const messageBox = document.getElementById('message-box');
const togglePasswordIcon = document.getElementById('toggle-password');

// Afficher / cacher le mot de passe
togglePasswordIcon.addEventListener('click', function () {
  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordInput.setAttribute('type', type);
  
  // Modifier l'icône en fonction de l'état du mot de passe
  if (type === 'password') {
  
    togglePasswordIcon.classList.remove('fa-eye');
    togglePasswordIcon.classList.add('fa-eye-slash');
  } else {
    togglePasswordIcon.classList.remove('fa-eye-slash');
    togglePasswordIcon.classList.add('fa-eye');
  }
});

// Enlève les erreurs dès que l'utilisateur tape
emailInput.addEventListener('input', () => {
  emailInput.classList.remove('is-invalid');
});
passwordInput.addEventListener('input', () => {
  passwordInput.classList.remove('is-invalid');
});

// Validation du formulaire
form.addEventListener('submit', function (e) {
  e.preventDefault();
  let valid = true;
  messageBox.innerHTML = '';

  if (!emailInput.value.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/)) {
    emailInput.classList.add('is-invalid');
    valid = false;
  }

  if (passwordInput.value.length < 6) {
    passwordInput.classList.add('is-invalid');
    valid = false;
  }

  if (valid) {
    messageBox.innerHTML = '<div class="alert alert-success">Connexion réussie !</div>';
    setTimeout(() => {
      window.location.href = 'dashboard.html';
    }, 1000);
  } else {
    messageBox.innerHTML = '<div class="alert alert-danger">Erreur de connexion. Vérifiez vos identifiants.</div>';
  }
});
