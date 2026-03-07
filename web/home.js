const foods=document.querySelectorAll(".food");

let index=0;

setInterval(()=>{

foods[index].classList.remove("active");

index++;

if(index>=foods.length){

index=0;

}

foods[index].classList.add("active");

},3500);


/* sparks */

const frame=document.querySelector(".neon-frame");

for(let i=0;i<10;i++){

let s=document.createElement("div");

s.className="spark";

s.style.top=Math.random()*100+"%";

s.style.left=Math.random()*100+"%";

s.style.animationDelay=Math.random()*5+"s";

frame.appendChild(s);

}