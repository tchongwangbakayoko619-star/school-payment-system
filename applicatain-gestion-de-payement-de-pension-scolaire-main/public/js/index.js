
document.addEventListener('DOMContentLoaded', function() {
    // Progressive display of notifications
    const notificationsArea = document.getElementById('notifications-area');
    const notifications = notificationsArea.querySelectorAll('.alert');

    notifications.forEach((notification, index) => {
        notification.style.opacity = 0;
        notification.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            notification.style.opacity = 1;
            notification.style.transform = 'translateY(0)';
            notification.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out';
        }, 100 * (index + 1)); // Progressive delay
    });

    // Confirmation before logout
    const logoutLink = document.querySelector('.logout-link');
    if (logoutLink) {
        logoutLink.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent immediate navigation
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = this.getAttribute('href'); // Redirect if user confirms
            }
        });
    }

    // Button click animation (example for any button with .btn class)
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.add('clicked');
            setTimeout(() => {
                this.classList.remove('clicked');
            }, 300); // Remove class after 300ms
        });
    });

    // Scroll to top button functionality
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    if (scrollToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        });

        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
function previewImage(event) {
    const imagePreview = document.getElementById('studentImagePreview');
    imagePreview.style.display = 'block';
    imagePreview.src = URL.createObjectURL(event.target.files[0]);
}

function togglePasswordVisibility() {
    const passwordInput = document.getElementById('initialPassword');
    const toggleIcon = document.getElementById('togglePassword');
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    }
}
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('studentImagePreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; // Affiche l'image
        }

        reader.readAsDataURL(input.files[0]); // Lit le fichier image comme une URL de données
    } else {
        preview.src = '#'; // Réinitialise la source de l'image
        preview.style.display = 'none'; // Cache l'image par défaut
    }
}