// ===== التحكم في حركة الـ Slide بين Sign in و Sign up =====
let signinBtn = document.querySelector('.signinBtn');  // زرار تسجيل الدخول
let signupBtn = document.querySelector('.signupBtn');  // زرار تسجيل حساب جديد
let body = document.querySelector('body');            // العنصر الرئيسي body

// لما ادوس على signupBtn اعمل Slide
signupBtn.onclick = () => body.classList.add('slide');

// لما ادوس على signinBtn رجع Slide تاني
signinBtn.onclick = () => body.classList.remove('slide');



// =====   عمل حساب جديد   =====
const signupForm = document.querySelector('#signupForm');                       // فورم التسجيل
signupForm.onsubmit = function(e){
    e.preventDefault();                                                         // امنع اعادة تحميل الصفحة
    let formData = new FormData(signupForm);                                    // باخد البيانات من الفورم

    fetch('register.php', { method:'POST', body:formData })                     // ابعت البيانات للسيرفر
    .then(res => res.json())                                                    // استقبل الرد كـ JSON ده الحمام الزاجل بتاعى بين السيرفر و ال js
    .then(data => {
        if(data.success){                                                       // لو التسجيل نجح
            if(data.role === 'staff'){                                          // لو الموظف
                window.location.href = 'staff_orders.php';                      // روح لصفحة الطلبات
            } else { // لو زبون
                window.location.href = 'home.php';                              // روح للصفحة الرئيسية
            }
        } else { // لو في مشكلة
            document.querySelector('#signupError').textContent = data.message;  // اعرض رسالة الخطأ
        }
    })
    .catch(err => console.error(err));                                          // لو فيه مشكلة في الاتصال
}



// ===== تسجيل الدخول   =====
const loginForm = document.querySelector('#loginForm');    // فورم تسجيل الدخول
loginForm.onsubmit = function(e){
    e.preventDefault();                                    // امنع الفورم من اعادة تحميل الصفحة
    let formData = new FormData(loginForm);                // باخد البيانات من الفورم

    fetch('login.php', { method:'POST', body:formData })   // ابعت البيانات للسيرفر
    .then(res => res.json())                               // استقبل الرد كـ JSON ده الحمام الزاجل بتاعى بين السيرفر و ال js
    .then(data => {
        if(data.success){                                  // لو تسجيل الدخول نجح
            if(data.role === 'staff'){                     // لو الموظف
                window.location.href = 'staff_orders.php'; // روح لصفحة الطلبات
            } else {                                       // لو زبون
                window.location.href = 'home.php';         // روح للصفحة الرئيسية
            }
        } else {                                           // لو في مشكلة
                alert(data.message);                       // اعرض رسالة الخطأ في alert
        }
    })
    .catch(err => console.error(err));                     // لو فيه مشكلة في الاتصال
}