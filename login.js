// Slide Toggle
let signinBtn = document.querySelector('.signinBtn');
let signupBtn = document.querySelector('.signupBtn');
let body = document.querySelector('body');

signupBtn.onclick = () => body.classList.add('slide');
signinBtn.onclick = () => body.classList.remove('slide');

// Signup AJAX
const signupForm = document.querySelector('#signupForm');
signupForm.onsubmit = function(e){
    e.preventDefault();
    let formData = new FormData(signupForm);

    fetch('register.php', { method:'POST', body:formData })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            if(data.role === 'staff'){
                window.location.href = 'staff_orders.php';
            } else {
                window.location.href = 'home.php';
            }
        } else {
            document.querySelector('#signupError').textContent = data.message;
        }
    })
    .catch(err => console.error(err));
}

// Login AJAX
const loginForm = document.querySelector('#loginForm');
loginForm.onsubmit = function(e){
    e.preventDefault();
    let formData = new FormData(loginForm);

    fetch('login.php', { method:'POST', body:formData })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            if(data.role === 'staff'){
                window.location.href = 'staff_orders.php';
            } else {
                window.location.href = 'home.php';
            }
        } else {
                alert(data.message);
        }
    })
    .catch(err => console.error(err));
}
