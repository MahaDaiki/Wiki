
function validateForm() {
    var username = document.getElementById('signup-user').value;
    var email = document.getElementById('signup-email').value;
    var password = document.getElementById('signup-pass').value;
    var confirmPassword = document.getElementById('signup-pass-repeat').value;

    var usernameRegex = /^[a-zA-Z0-9_]{2,20}$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;

    if (!usernameRegex.test(username)) {
        alert("Invalid username format");
        console.log("laaaa")
    }

    else if (!emailRegex.test(email)) {
        alert("Invalid email format");
        
    }

    else if (!passwordRegex.test(password)) {
        alert("Password must contain at least one uppercase letter, one lowercase letter, one digit, and be at least 6 characters long");
        
    }

    else if (password !== confirmPassword) {
        alert("Error: Passwords do not match.");  
    }
    else{
    return true; }
}
function togglePassword(inputId, eyeId) {
    var passwordInput = document.getElementById(inputId);
    var eyeIcon = document.getElementById(eyeId);
    var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    eyeIcon.textContent = type === 'password' ? '👁️' : '👁️';
}

// function switchForm(tab) {

//     if (tab === 'login') {
//         history.pushState(null, null, 'index.php?action=Login');
//     } else {
//         history.pushState(null, null, 'index.php?action=Register');
//     }
// }
// document.getElementById('loginForm').addEventListener('submit', function () {
//     switchForm('login');
// });

// document.getElementById('registerForm').addEventListener('submit', function () {
//     switchForm('register');
// });


