<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | SpotIn</title>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700&display=swap" rel="stylesheet">

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family: 'Orbitron', sans-serif;
    }

    body{
        overflow:hidden;
    }

    /* ===== BACKGROUND SAME AS SITE ===== */
    .lang-overlay{
        position: fixed;
        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;

        background:
            linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
            radial-gradient(circle at 20% 30%, #ff3cac44 , transparent 50%),
            radial-gradient(circle at 80% 70%, #00e5ff44 , transparent 50%),
            url("brick.jpg");

        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

        z-index: 9999;
    }

    /* ===== BOX ===== */
    .lang-box{
        width: 430px;
        padding: 40px;
        border-radius: 25px;
        text-align: center;

        background: rgba(0,0,0,0.45);
        border: 1px solid rgba(0,229,255,0.3);

        box-shadow:
            0 0 25px #00e5ff55,
            0 0 60px #ff3cac33;

        backdrop-filter: blur(12px);

        animation: pop 0.6s ease, glow 6s ease-in-out infinite;
    }

    @keyframes pop{
        from{transform: scale(0.8); opacity:0;}
        to{transform: scale(1); opacity:1;}
    }

    @keyframes glow{
        0%{
            box-shadow: 0 0 20px #00e5ff44, 0 0 40px #ff3cac33;
        }
        50%{
            box-shadow: 0 0 45px #00e5ff88, 0 0 90px #ff3cac55;
        }
        100%{
            box-shadow: 0 0 20px #00e5ff44, 0 0 40px #ff3cac33;
        }
    }

    /* ===== LOGO ===== */
    .logo{
        font-size: 1.4rem;
        color: #00e5ff;
        text-shadow: 0 0 12px #00e5ff;
        margin-bottom: 10px;
        letter-spacing: 3px;
    }

    /* ===== TITLE ===== */
    h2{
        color: #fff;
        font-size: 1.8rem;
        margin-bottom: 10px;
        text-shadow: 0 0 15px #ff3cac;
    }

    p{
        color: #cbd5e1;
        font-size: 0.9rem;
        margin-bottom: 25px;
    }

    /* ===== BUTTONS ===== */
    .flags{
        display:flex;
        flex-direction:column;
        gap:15px;
    }

    .lang-btn{
        position: relative;
        padding: 15px;
        border-radius: 15px;

        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);

        color: white;
        cursor: pointer;

        transition: 0.3s;
        overflow: hidden;

        font-size: 1rem;
    }

    .lang-btn:hover{
        transform: translateY(-4px);
        border-color: #00e5ff;
        box-shadow:
            0 0 15px #00e5ff,
            0 0 35px #ff3cac55;
    }

    /* glow sweep */
    .lang-btn::before{
        content:"";
        position:absolute;
        top:0;
        left:-100%;
        width:100%;
        height:100%;
        background: linear-gradient(90deg, transparent, rgba(0,229,255,0.25), transparent);
        transition: 0.5s;
    }

    .lang-btn:hover::before{
        left:100%;
    }

    </style>
</head>

<body>

<div class="lang-overlay">

    <div class="lang-box">

        <div class="logo">Alibaba</div>

        <h2>Welcome to Alibaba</h2>

        <p>Choose your preferred language / اختر لغتك المفضلة</p>

        <div class="flags">

            <button class="lang-btn" onclick="setLang('en')">
                 English
            </button>

            <button class="lang-btn" onclick="setLang('ar')">
                 العربية
            </button>

        </div>

    </div>

</div>

<script>
function setLang(lang){
    fetch("set_lang.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({lang: lang})
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            window.location.href = "home.php";
        }
    });
}
</script>

</body>
</html>