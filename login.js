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
   e.preventDefault();                                   
    let formData = new FormData(loginForm);                

    fetch('login.php', { method:'POST', body:formData })   
    .then(res => res.json())                               
    .then(data => {
        if(data.success){                                  
            // ===== عرض الترابيزة قبل التحويل (اختياري) =====
            let tableId = sessionStorage.getItem('table_id');
            if(tableId){
                alert("You are at Table #" + tableId);
            }

            // ===== التحويل حسب الدور =====
            if(data.role === 'admin'){                     
                window.location.href = 'admin_dashboard.php'; // Admin Dashboard
            } else if(data.role === 'staff'){               
                window.location.href = 'staff_orders.php';   // Staff
            } else {                                       
                window.location.href = 'home.php';          // Customer
            }
        } else {                                           
            alert(data.message);                       
        }
    })
    .catch(err => console.error(err));                     
}