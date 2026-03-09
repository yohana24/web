// ============================
// الصور اللي بتتغير
// ============================

const foods = document.querySelectorAll(".food");

let index = 0;

setInterval(() => {

    // بشيل ال active  من الصورة الحالية
    foods[index].classList.remove("active");

    // بروح للصورة اللي بعدها
    index++;

    // لما بوصل ل اخر صورة ابدء من جديد
    if (index >= foods.length) {
        index = 0;
    }

    // بحط ال active على الصورة الجديدة
    foods[index].classList.add("active");

    //مدة عرض الصورة الواحدة
}, 7000);


// ============================
// الشكل اللي حوالين الصورة
// ============================

//بستدعى ال frame  
const frame = document.querySelector(".neon-frame");

for (let i = 0; i < 10; i++) {                            //عدد الشرارات = قوة التأثير

    let spark = document.createElement("div");            //بعمل <div></div>

    spark.className = "spark";                            //<div class = "spark"></div>

    spark.style.top = Math.random() * 100 + "%";          //تحديد مكان عشوائى من 0% ل 100% بس
    spark.style.left = Math.random() * 100 + "%";

    spark.style.animationDelay = Math.random() * 5 + "s"; //كل شرارة تبدأ الحركة فى وقت مختلف

    frame.appendChild(spark);                             //كل شرارة جوا neon-frame
}