<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>StrCode - Error Explainer</title>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;}

:root{
    --g:#39ff8a;
    --g2:#00e5a0;
    --g3:#22c55e;
    --cyan:#38bdf8;
    --ink:#03090f;
    --ink2:#071520;
    --ink3:#0d2035;
    --text:#e8f4f0;
    --muted:#5a8a7a;
    --r:18px;
}

html{scroll-behavior:smooth;}
body{
    font-family:'Outfit',sans-serif;
    min-height:100vh;
    background:var(--ink);
    color:var(--text);
    overflow-x:hidden;
}

#bgCanvas{
    position:fixed;inset:0;
    width:100%;height:100%;
    z-index:0;pointer-events:none;
    opacity:0.55;
}

/* ── NAVBAR ── */
.navbar{
    position:sticky;top:0;z-index:200;
    display:flex;justify-content:space-between;align-items:center;
    padding:0 48px;height:64px;
    background:rgba(3,9,15,0.82);
    backdrop-filter:blur(28px);-webkit-backdrop-filter:blur(28px);
    border-bottom:1px solid rgba(57,255,138,0.08);
}
.navbar-brand{display:flex;align-items:center;gap:11px;text-decoration:none;}
.brand-icon{
    width:36px;height:36px;
    background:linear-gradient(135deg,var(--g3),var(--g));
    border-radius:10px;
    display:flex;align-items:center;justify-content:center;font-size:17px;
    box-shadow:0 0 18px rgba(57,255,138,0.45),inset 0 1px 0 rgba(255,255,255,0.15);
}
.navbar h2{
    font-family:'JetBrains Mono',monospace;
    font-size:19px;font-weight:700;
    color:var(--g);letter-spacing:3px;
}
.nav-links{display:flex;align-items:center;gap:4px;}
.nav-links a{
    text-decoration:none;color:rgba(232,244,240,0.5);
    font-size:14px;font-weight:500;padding:7px 15px;border-radius:8px;
    transition:all 0.2s;
}
.nav-links a:hover{color:var(--text);background:rgba(57,255,138,0.07);}
.nav-links a.signup-btn{
    background:linear-gradient(135deg,var(--g3),var(--g));
    color:#021a0a;font-weight:700;padding:8px 22px;border-radius:10px;
    box-shadow:0 4px 18px rgba(57,255,138,0.3);
}
.nav-links a.signup-btn:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(57,255,138,0.45);}

/* theme toggle */
.theme-toggle-wrap{position:relative;display:flex;align-items:center;margin-left:10px;}
.theme-toggle-wrap::before{
    content:'';position:absolute;inset:-2px;border-radius:40px;
    background:conic-gradient(from 0deg,#39ff8a,#06b6d4,#818cf8,#f472b6,#39ff8a);
    opacity:0;transition:opacity 0.4s;z-index:0;
    animation:spinGlow 4s linear infinite;
}
.theme-toggle-wrap:hover::before{opacity:0.55;}
@keyframes spinGlow{from{filter:hue-rotate(0deg)}to{filter:hue-rotate(360deg)}}
.theme-switch{
    width:68px;height:32px;border-radius:40px;
    background:rgba(57,255,138,0.06);cursor:pointer;padding:3px;
    transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);
    display:inline-flex;align-items:center;
    border:1px solid rgba(57,255,138,0.14);
    position:relative;z-index:1;overflow:hidden;
}
.theme-switch::before{
    content:'✦ ✦';position:absolute;right:8px;
    font-size:6px;color:rgba(255,255,255,0.35);
    letter-spacing:3px;transition:opacity 0.3s;pointer-events:none;
}
.switch-circle{
    width:26px;height:26px;border-radius:50%;
    background:linear-gradient(135deg,#0d2035,#1a3a50);
    display:flex;justify-content:center;align-items:center;
    transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);
    font-size:13px;box-shadow:0 2px 8px rgba(0,0,0,0.5);
    position:relative;z-index:2;flex-shrink:0;
}
.switch-circle::after{
    content:'';position:absolute;inset:-3px;border-radius:50%;
    background:conic-gradient(from 0deg,#818cf8,#39ff8a,#06b6d4,#818cf8);
    z-index:-1;opacity:0;transition:opacity 0.3s;
    animation:spinRing 3s linear infinite;
}
@keyframes spinRing{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
.theme-switch:hover .switch-circle::after{opacity:0.8;}
.theme-label{
    position:absolute;bottom:-26px;left:50%;transform:translateX(-50%);
    font-size:10px;font-weight:600;letter-spacing:0.5px;color:var(--muted);
    white-space:nowrap;opacity:0;transition:opacity 0.2s;pointer-events:none;text-transform:uppercase;
}
.theme-toggle-wrap:hover .theme-label{opacity:1;}

/* ── WELCOME ── */
#welcome{text-align:left;margin:20px 48px 0;position:relative;z-index:1;}
#welcome h2{
    font-family:'JetBrains Mono',monospace;
    font-size:13px;color:var(--g);font-weight:500;
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(57,255,138,0.07);
    border:1px solid rgba(57,255,138,0.18);
    padding:6px 16px;border-radius:50px;letter-spacing:0.5px;
}

/* ── HERO ── */
.hero{
    text-align:center;padding:52px 20px 20px;
    position:relative;z-index:1;
}
.hero-badge{
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(57,255,138,0.06);border:1px solid rgba(57,255,138,0.16);
    padding:7px 20px;border-radius:50px;
    font-size:12px;color:var(--g);font-weight:600;
    margin-bottom:28px;letter-spacing:1.5px;text-transform:uppercase;
    font-family:'JetBrains Mono',monospace;
    animation:heroFadeUp 0.7s ease both;
}
.hero-badge .dot{width:6px;height:6px;background:var(--g);border-radius:50%;animation:pulse 2s infinite;}
@keyframes pulse{
    0%,100%{opacity:1;transform:scale(1);box-shadow:0 0 0 0 rgba(57,255,138,0.4)}
    50%{opacity:0.6;transform:scale(1.4);box-shadow:0 0 0 6px rgba(57,255,138,0)}
}

/* hero h1 — word-by-word reveal */
.hero h1{
    font-family:'Outfit',sans-serif;
    font-size:clamp(32px,5vw,58px);font-weight:900;line-height:1.12;
    max-width:760px;margin:0 auto 0;letter-spacing:-2px;
    overflow:visible;
}

/* each word wrapped in a span.hw fades+slides up */
.hero h1 .hw{
    display:inline-block;
    opacity:0;
    transform:translateY(22px);
    animation:wordUp 0.55s cubic-bezier(0.22,1,0.36,1) forwards;
}
.hero h1 .hw:nth-child(1){animation-delay:0.08s}
.hero h1 .hw:nth-child(2){animation-delay:0.18s}
.hero h1 .hw:nth-child(3){animation-delay:0.28s}
.hero h1 .hw:nth-child(4){animation-delay:0.38s}
.hero h1 .hw:nth-child(5){animation-delay:0.48s}
@keyframes wordUp{
    to{opacity:1;transform:translateY(0)}
}

/* accent span — shimmer sweep after appearing */
.hero h1 .accent{
    display:inline-block;
    background:linear-gradient(100deg,var(--g) 0%,var(--cyan) 40%,var(--g) 80%);
    background-size:200% auto;
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
    animation:wordUp 0.55s cubic-bezier(0.22,1,0.36,1) 0.54s both,
              shimmer 3.5s linear 1.2s infinite;
    position:relative;
}
@keyframes shimmer{
    0%{background-position:200% center}
    100%{background-position:-200% center}
}

/* underline drawn under "AI clarity." */
.accent-wrap{
    position:relative;
    display:inline-block;
    white-space:nowrap;
}
.accent-wrap::after{
    content:'';
    position:absolute;
    left:0;bottom:-4px;
    width:100%;height:2px;
    background:linear-gradient(90deg,var(--g),var(--cyan));
    border-radius:2px;
    transform:scaleX(0);transform-origin:left;
    animation:lineGrow 0.5s ease 1.1s forwards;
}
@keyframes lineGrow{to{transform:scaleX(1)}}

/* hero-sub — gentle fade up, delayed */
.hero-sub{
    max-width:480px;margin:20px auto 0;
    color:var(--muted);font-size:15px;line-height:1.8;
    opacity:0;transform:translateY(12px);
    animation:heroFadeUp 0.6s ease 0.75s both;
}
@keyframes heroFadeUp{
    to{opacity:1;transform:translateY(0)}
}

/* light-mode hero overrides */
.light-mode .hero h1{color:#0d1f17;}
.light-mode .hero-sub{color:#4a7a65;}

/* ══ MAIN GRID ══ */
.main-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:0;
    max-width:1120px;
    margin:44px auto 0;
    padding:0 32px;
    position:relative;z-index:1;
    align-items:stretch;
}

/* ── LEFT PANEL ── */
.left-panel{
    background:linear-gradient(160deg,rgba(7,21,32,0.97) 0%,rgba(3,9,15,0.99) 100%);
    border:1px solid rgba(57,255,138,0.1);
    border-right:none;
    border-radius:24px 0 0 24px;
    padding:44px 36px;
    position:relative;overflow:hidden;
    display:flex;flex-direction:column;justify-content:space-between;
    min-height:520px;
}
/* corner brackets */
.left-panel::before{
    content:'';position:absolute;top:0;left:0;
    width:160px;height:160px;
    border-top:2px solid rgba(57,255,138,0.3);
    border-left:2px solid rgba(57,255,138,0.3);
    border-radius:24px 0 0 0;pointer-events:none;
}
.left-panel::after{
    content:'';position:absolute;bottom:0;right:0;
    width:80px;height:80px;
    border-bottom:1px solid rgba(56,189,248,0.18);
    border-right:1px solid rgba(56,189,248,0.18);
    pointer-events:none;
}
/* floating orbs */
.orb{position:absolute;border-radius:50%;filter:blur(55px);pointer-events:none;}
.orb-1{
    width:280px;height:280px;
    background:radial-gradient(circle,rgba(57,255,138,0.1),transparent 65%);
    top:-80px;right:-80px;
    animation:orbFloat1 8s ease-in-out infinite;
}
.orb-2{
    width:200px;height:200px;
    background:radial-gradient(circle,rgba(56,189,248,0.08),transparent 65%);
    bottom:-40px;left:-40px;
    animation:orbFloat2 11s ease-in-out infinite;
}
@keyframes orbFloat1{0%,100%{transform:translate(0,0) scale(1)}50%{transform:translate(-30px,40px) scale(1.1)}}
@keyframes orbFloat2{0%,100%{transform:translate(0,0) scale(1)}50%{transform:translate(30px,-30px) scale(1.08)}}

/* scan line */
.scanline{
    position:absolute;top:0;left:0;right:0;height:2px;
    background:linear-gradient(90deg,transparent,var(--g),transparent);
    animation:scan 4s ease-in-out infinite;opacity:0.35;z-index:3;
}
@keyframes scan{
    0%{top:0%;opacity:0}10%{opacity:0.35}90%{opacity:0.35}100%{top:100%;opacity:0}
}

/* terminal widget */
.terminal{
    background:rgba(0,0,0,0.6);
    border:1px solid rgba(57,255,138,0.13);
    border-radius:14px;overflow:hidden;
    position:relative;z-index:2;
    box-shadow:0 20px 50px rgba(0,0,0,0.6),0 0 0 1px rgba(57,255,138,0.04);
}
.terminal-bar{
    display:flex;align-items:center;gap:7px;
    padding:10px 16px;
    background:rgba(57,255,138,0.04);
    border-bottom:1px solid rgba(57,255,138,0.08);
}
.tb{width:12px;height:12px;border-radius:50%;}
.tb.r{background:#ff5f57;box-shadow:0 0 6px #ff5f5780;}
.tb.y{background:#febc2e;box-shadow:0 0 6px #febc2e80;}
.tb.g{background:#28c840;box-shadow:0 0 6px #28c84080;}
.terminal-title{
    margin-left:6px;font-family:'JetBrains Mono',monospace;
    font-size:11px;color:rgba(57,255,138,0.4);letter-spacing:1px;
}
.terminal-body{padding:18px 20px;font-family:'JetBrains Mono',monospace;font-size:12px;line-height:1.9;}
.t-line{display:flex;align-items:flex-start;gap:10px;margin-bottom:2px;}
.t-prompt{color:var(--g);opacity:0.55;user-select:none;flex-shrink:0;}
.t-cmd{color:rgba(232,244,240,0.72);}
.t-cmd .kw{color:var(--g);}
.t-cmd .str{color:#fbbf24;}
.t-cmd .err{color:#f87171;}
.t-cmd .ok{color:var(--g);}
.t-cursor{
    display:inline-block;width:8px;height:14px;
    background:var(--g);border-radius:1px;
    animation:blink 1.1s step-end infinite;
    vertical-align:middle;margin-left:2px;opacity:0.85;
}
@keyframes blink{0%,100%{opacity:0.85}50%{opacity:0}}

/* feature list */
.feature-list{display:flex;flex-direction:column;gap:10px;position:relative;z-index:2;margin-top:26px;}
.feature-item{
    display:flex;align-items:center;gap:12px;
    padding:12px 16px;
    background:rgba(57,255,138,0.04);
    border:1px solid rgba(57,255,138,0.09);
    border-radius:12px;transition:all 0.3s;
    animation:fadeSlideIn 0.6s ease both;
}
.feature-item:nth-child(1){animation-delay:0.1s}
.feature-item:nth-child(2){animation-delay:0.2s}
.feature-item:nth-child(3){animation-delay:0.3s}
@keyframes fadeSlideIn{from{opacity:0;transform:translateX(-16px)}to{opacity:1;transform:translateX(0)}}
.feature-item:hover{
    background:rgba(57,255,138,0.08);
    border-color:rgba(57,255,138,0.2);
    transform:translateX(4px);
}
.fi-icon{
    width:34px;height:34px;border-radius:10px;
    background:rgba(57,255,138,0.1);
    display:flex;align-items:center;justify-content:center;
    font-size:16px;flex-shrink:0;
}
.fi-text strong{display:block;font-size:13px;font-weight:700;color:var(--text);margin-bottom:2px;letter-spacing:-0.2px;}
.fi-text span{font-size:11px;color:var(--muted);font-weight:400;}

/* ── RIGHT FORM PANEL ── */
.form-panel{
    background:rgba(7,21,32,0.94);
    border:1px solid rgba(57,255,138,0.1);
    border-left:1px solid rgba(57,255,138,0.05);
    border-radius:0 24px 24px 0;
    padding:44px 40px;
    position:relative;overflow:hidden;
}
.form-panel::before{
    content:'';position:absolute;inset:0;
    background:radial-gradient(ellipse 60% 50% at 100% 0%,rgba(56,189,248,0.04),transparent);
    pointer-events:none;
}
.form-title{
    font-family:'Outfit',sans-serif;
    font-size:22px;font-weight:800;margin-bottom:6px;
    letter-spacing:-0.8px;color:var(--text);
}
.form-sub{
    color:var(--muted);font-size:12px;margin-bottom:30px;
    font-family:'JetBrains Mono',monospace;
    display:flex;align-items:center;gap:6px;
}
.form-sub::before{content:'>';color:var(--g);opacity:0.55;}

.field-group{margin-bottom:22px;}
label{
    display:flex;align-items:center;gap:8px;
    font-size:11px;font-weight:700;
    letter-spacing:1.5px;text-transform:uppercase;
    color:rgba(90,138,122,0.9);margin-bottom:10px;
    font-family:'JetBrains Mono',monospace;
}
.label-icon{font-size:14px;}

select,textarea{
    width:100%;padding:13px 16px;border-radius:12px;
    border:1px solid rgba(57,255,138,0.1);
    background:rgba(0,0,0,0.4);color:var(--text);
    font-family:'JetBrains Mono',monospace;font-size:13px;
    transition:all 0.3s;outline:none;
    appearance:none;-webkit-appearance:none;
}
.select-wrap{position:relative;}
.select-wrap::after{
    content:'⌄';position:absolute;right:14px;top:50%;transform:translateY(-50%);
    color:var(--muted);pointer-events:none;font-size:18px;font-weight:700;
}
select:focus,textarea:focus{
    border-color:rgba(57,255,138,0.45);
    box-shadow:0 0 0 3px rgba(57,255,138,0.08),0 0 20px rgba(57,255,138,0.05);
    background:rgba(0,0,0,0.55);
}
select option{background:#071520;color:#e8f4f0;}
textarea{height:155px;resize:none;line-height:1.75;font-size:12.5px;}
textarea::placeholder{color:rgba(90,138,122,0.4);font-style:italic;}

button[type="submit"]{
    width:100%;padding:15px 20px;border:none;border-radius:13px;
    font-family:'Outfit',sans-serif;font-size:15px;font-weight:800;letter-spacing:0.3px;
    background:linear-gradient(135deg,#16a34a,#39ff8a,#22c55e);
    background-size:200% 200%;color:#021a0a;cursor:pointer;
    transition:all 0.35s;margin-top:10px;
    position:relative;overflow:hidden;
    animation:gradShift 5s ease infinite;
}
@keyframes gradShift{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
button[type="submit"]::before{
    content:'';position:absolute;inset:0;
    background:linear-gradient(135deg,rgba(255,255,255,0.18),transparent 60%);
    opacity:0;transition:0.3s;
}
button[type="submit"]:hover{transform:translateY(-3px);box-shadow:0 14px 36px rgba(57,255,138,0.45),0 0 0 1px rgba(57,255,138,0.3);}
button[type="submit"]:hover::before{opacity:1;}
button[type="submit"]:active{transform:translateY(-1px);}

/* ── ANSWER SECTION ── */
.answer-container{
    max-width:1120px;margin:24px auto 60px;
    padding:0 32px;position:relative;z-index:1;
}
.answer-box-wrapper{
    background:rgba(7,21,32,0.94);
    border:1px solid rgba(57,255,138,0.1);
    border-radius:22px;overflow:hidden;
    box-shadow:0 8px 40px rgba(0,0,0,0.5);
    transition:all 0.3s;position:relative;
}
.answer-box-wrapper::before{
    content:'';position:absolute;top:0;left:0;right:0;height:1px;
    background:linear-gradient(90deg,transparent,rgba(57,255,138,0.4),transparent);
    pointer-events:none;
}
.answer-box-wrapper:hover{
    box-shadow:0 16px 56px rgba(0,0,0,0.6),0 0 0 1px rgba(57,255,138,0.12);
}
.answer-header{
    display:flex;align-items:center;justify-content:space-between;
    padding:16px 28px;
    border-bottom:1px solid rgba(57,255,138,0.07);
    background:rgba(57,255,138,0.03);
}
.answer-header-left{display:flex;align-items:center;gap:12px;}
.answer-dot{
    width:8px;height:8px;background:var(--g);border-radius:50%;
    box-shadow:0 0 12px var(--g);animation:pulse 2.5s infinite;
}
.answer-header h3{
    font-family:'JetBrains Mono',monospace;
    font-size:13px;font-weight:600;color:var(--g);
    letter-spacing:1.5px;text-transform:uppercase;
}
.traffic-lights{display:flex;gap:7px;align-items:center;}
.tl{width:12px;height:12px;border-radius:50%;}
.tl.red{background:#ff5f57;box-shadow:0 0 6px #ff5f5770;}
.tl.yellow{background:#febc2e;box-shadow:0 0 6px #febc2e70;}
.tl.green{background:#28c840;box-shadow:0 0 6px #28c84070;}

.levels{display:flex;gap:8px;padding:16px 28px 0;}
.level{
    font-family:'JetBrains Mono',monospace;
    font-size:11px;font-weight:500;
    padding:4px 12px;border-radius:20px;letter-spacing:0.5px;
}

.answer-body{padding:24px 32px;}
.answer-text{
    font-family:'JetBrains Mono',monospace;
    font-size:13.5px;line-height:1.9;
    color:rgba(232,244,240,0.85);
    white-space:pre-wrap;word-break:break-word;min-height:60px;
}
.answer-text:empty::before{
    content:"// No error analyzed yet. Submit an error above \2191";
    color:rgba(90,138,122,0.3);font-style:italic;
}

.answer-actions{
    display:flex;align-items:center;justify-content:flex-end;
    padding:16px 28px;
    border-top:1px solid rgba(57,255,138,0.07);
    background:rgba(0,0,0,0.2);gap:12px;
}
.copy-btn{
    display:inline-flex;align-items:center;gap:8px;
    padding:10px 20px;border:1px solid rgba(57,255,138,0.2);
    border-radius:10px;background:rgba(57,255,138,0.06);
    color:var(--g);font-family:'Outfit',sans-serif;
    font-size:13px;font-weight:700;cursor:pointer;
    transition:all 0.25s;width:auto;margin:0;letter-spacing:0.3px;
}
.copy-btn:hover{
    background:rgba(57,255,138,0.14);border-color:rgba(57,255,138,0.4);
    transform:translateY(-2px);box-shadow:0 6px 20px rgba(57,255,138,0.18);
}
.back-btn{
    display:inline-flex;align-items:center;gap:8px;
    padding:10px 24px;border-radius:10px;
    background:linear-gradient(135deg,var(--g3),var(--g));
    color:#021a0a;font-family:'Outfit',sans-serif;
    font-size:13px;font-weight:800;text-decoration:none;
    transition:all 0.25s;letter-spacing:0.2px;
}
.back-btn:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(57,255,138,0.38);}

/* ── FOOTER ── */
.footer{
    text-align:center;padding:24px;
    color:rgba(90,138,122,0.4);font-size:12px;
    border-top:1px solid rgba(57,255,138,0.05);
    position:relative;z-index:1;
    font-family:'JetBrains Mono',monospace;letter-spacing:0.8px;
}

/* ══ LIGHT MODE ══ */
body.light-mode{
    background:#f0fdf4;color:#0d1f17;
    --text:#0d1f17;--muted:#4a7a65;
    --g:#16a34a;--g2:#22c55e;--g3:#15803d;
}
.light-mode .navbar{background:rgba(240,253,244,0.88);border-bottom:1px solid rgba(22,163,74,0.12);}
.light-mode .navbar h2{color:#16a34a;}
.light-mode .nav-links a{color:#4a7a65;}
.light-mode .nav-links a:hover{background:rgba(22,163,74,0.07);color:#0d1f17;}
.light-mode .nav-links a.signup-btn{color:#052e16;}
.light-mode #welcome h2{color:#16a34a;background:rgba(22,163,74,0.07);border-color:rgba(22,163,74,0.2);}
.light-mode .hero-badge{background:rgba(22,163,74,0.07);border-color:rgba(22,163,74,0.18);color:#16a34a;}
.light-mode .hero-badge .dot{background:#16a34a;}
.light-mode .left-panel{background:linear-gradient(160deg,rgba(220,252,231,0.97),rgba(240,253,244,0.99));border-color:rgba(22,163,74,0.15);}
.light-mode .left-panel::before{border-color:rgba(22,163,74,0.3);}
.light-mode .terminal{background:rgba(3,9,15,0.92);}
.light-mode .feature-item{background:rgba(22,163,74,0.05);border-color:rgba(22,163,74,0.12);}
.light-mode .feature-item:hover{background:rgba(22,163,74,0.1);border-color:rgba(22,163,74,0.25);}
.light-mode .fi-text strong{color:#0d1f17;}
.light-mode .fi-text span{color:#4a7a65;}
.light-mode .fi-icon{background:rgba(22,163,74,0.1);}
.light-mode .form-panel{background:rgba(255,255,255,0.92);border-color:rgba(22,163,74,0.1);}
.light-mode .form-title{color:#0d1f17;}
.light-mode label{color:#4a7a65;}
.light-mode select,.light-mode textarea{background:rgba(255,255,255,0.95);color:#0d1f17;border-color:rgba(22,163,74,0.15);}
.light-mode select:focus,.light-mode textarea:focus{border-color:rgba(22,163,74,0.5);box-shadow:0 0 0 3px rgba(22,163,74,0.1);background:white;}
.light-mode .answer-box-wrapper{background:rgba(255,255,255,0.94);border-color:rgba(22,163,74,0.1);}
.light-mode .answer-header{background:rgba(22,163,74,0.03);}
.light-mode .answer-header h3{color:#16a34a;}
.light-mode .answer-dot{background:#16a34a;box-shadow:0 0 12px #16a34a;}
.light-mode .answer-text{color:#0d1f17;}
.light-mode .answer-actions{background:rgba(0,0,0,0.02);}
.light-mode .copy-btn{background:rgba(22,163,74,0.07);border-color:rgba(22,163,74,0.2);color:#16a34a;}
.light-mode .copy-btn:hover{background:rgba(22,163,74,0.14);}
.light-mode .footer{color:rgba(74,122,101,0.4);}
.light-mode .theme-switch{background:rgba(251,191,36,0.1);border-color:rgba(251,191,36,0.25);}
.light-mode .theme-switch::before{opacity:0;}
.light-mode .switch-circle{transform:translateX(36px);background:linear-gradient(135deg,#fbbf24,#f59e0b);box-shadow:0 2px 12px rgba(251,191,36,0.5);}
.light-mode #bgCanvas{opacity:0.1;}

/* ── RESPONSIVE ── */
@media(max-width:820px){
    .main-grid{grid-template-columns:1fr;padding:0 16px;}
    .left-panel{border-radius:24px 24px 0 0;border-right:1px solid rgba(57,255,138,0.1);border-bottom:none;min-height:auto;}
    .form-panel{border-radius:0 0 24px 24px;border-left:1px solid rgba(57,255,138,0.1);border-top:none;}
    .navbar{padding:14px 20px;}
    .hero{padding:36px 16px 16px;}
    #welcome{margin:16px 20px 0;}
    .answer-container{padding:0 16px;margin-top:20px;}
    .answer-actions{flex-wrap:wrap;}
    .copy-btn,.back-btn{flex:1;justify-content:center;}
}
</style>
</head>

<body class="dark-mode">

<canvas id="bgCanvas"></canvas>

<!-- ── NAVBAR ── -->
<nav class="navbar">
    <div class="navbar-brand">
        <div class="brand-icon">⚡</div>
        <h2>StrCode</h2>
    </div>
    <div class="nav-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('CreateUser') }}" class="signup-btn">Sign Up</a>

        @if(Auth::check())
        <a href="{{ route('logout') }}">Logout</a>
        @else
        <a href="{{ route('login') }}">Log in</a>
        @endif

        <div class="theme-toggle-wrap">
            <div class="theme-switch" id="themeToggle">
                <div class="switch-circle" id="switchCircle">🌙</div>
            </div>
            <span class="theme-label">Toggle theme</span>
        </div>
    </div>
</nav>

<!-- ── WELCOME ── -->
<div id="welcome">
    @if (Auth::check())
    <h2>👾 Welcome, {{ Auth::user()->name }}</h2>
    @endif
</div>

<!-- ── HERO ── -->
<section class="hero">
    <div class="hero-badge">
        <span class="dot"></span>
        AI-Powered Error Analysis
    </div>
    <h1>
        <span class="hw">Decode</span>&nbsp;<span class="hw">your</span>&nbsp;<span class="hw">errors</span>&nbsp;<span class="hw">with</span>&nbsp;<span class="hw"><span class="accent-wrap"><span class="accent">AI clarity.</span></span></span>
    </h1>
    <p class="hero-sub">Paste your stack trace, select your language, and let our AI break down the problem and provide exact fixes.</p>
</section>

<!-- ══ MAIN GRID ══ -->
<div class="main-grid">

    <!-- LEFT — animated creative panel -->
    <div class="left-panel">
        <div class="scanline"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>

        <div class="terminal">
            <div class="terminal-bar">
                <div class="tb r"></div>
                <div class="tb y"></div>
                <div class="tb g"></div>
                <span class="terminal-title">strcode — error-analyzer</span>
            </div>
            <div class="terminal-body">
                <div class="t-line">
                    <span class="t-prompt">$</span>
                    <span class="t-cmd"><span class="kw">strcode</span> analyze <span class="str">--lang python</span></span>
                </div>
                <div class="t-line">
                    <span class="t-prompt">›</span>
                    <span class="t-cmd"><span class="err">TypeError:</span> unsupported operand</span>
                </div>
                <div class="t-line">
                    <span class="t-prompt">›</span>
                    <span class="t-cmd">  type(s) for +: 'int' 'str'</span>
                </div>
                <div class="t-line" style="margin-top:6px">
                    <span class="t-prompt">⚡</span>
                    <span class="t-cmd"><span class="ok">Analyzing error...</span></span>
                </div>
                <div class="t-line">
                    <span class="t-prompt">›</span>
                    <span class="t-cmd"><span class="ok">✓</span> Root cause identified</span>
                </div>
                <div class="t-line">
                    <span class="t-prompt">›</span>
                    <span class="t-cmd"><span class="ok">✓</span> Fix: use <span class="kw">int()</span> or <span class="kw">str()</span> cast</span>
                </div>
                <div class="t-line" style="margin-top:4px">
                    <span class="t-prompt">$</span>
                    <span class="t-cmd"><span class="t-cursor"></span></span>
                </div>
            </div>
        </div>

        <div class="feature-list">
            <div class="feature-item">
                <div class="fi-icon">🔍</div>
                <div class="fi-text">
                    <strong>Deep Error Analysis</strong>
                    <span>Understands stack traces across all major languages</span>
                </div>
            </div>
            <div class="feature-item">
                <div class="fi-icon">⚡</div>
                <div class="fi-text">
                    <strong>Instant Fix Suggestions</strong>
                    <span>Exact code patches, not vague hints</span>
                </div>
            </div>
            <div class="feature-item">
                <div class="fi-icon">🧠</div>
                <div class="fi-text">
                    <strong>Root Cause Explanation</strong>
                    <span>Understand why it broke, not just how to fix it</span>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT — form -->
    <div class="form-panel">
        <div class="form-title">Understand Coding Errors Clearly</div>
        <p class="form-sub">paste your error · get a clear explanation</p>

        <form method="POST" action="{{ route('errorExplainer') }}">
            @csrf

            <div class="field-group">
                <label><span class="label-icon">‹›</span> Programming Language</label>
                <div class="select-wrap">
                    <select name="language">
                        <option value="" disabled selected>Select the language...</option>
                        <option value="Python">Python</option>
                        <option value="Java">Java</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="C++">C++</option>
                        <option value="C">C</option>
                        <option value="C#">C#</option>
                        <option value="Go">Go</option>
                        <option value="Rust">Rust</option>
                        <option value="Swift">Swift</option>
                        <option value="HTML">HTML</option>
                        <option value="CSS">CSS</option>
                        <option value="TypeScript">TypeScript</option>
                        <option value="Ruby">Ruby</option>
                        <option value="R">R</option>
                    </select>
                </div>
            </div>

            <div class="field-group">
                <label><span class="label-icon">🐛</span> Error Message / Stack Trace</label>
                <textarea
                    name="error_message"
                    placeholder="Paste the terrifying red text here..."
                ></textarea>
            </div>

            <button type="submit">⚡ Explain Error</button>
        </form>
    </div>

</div>

<!-- ── ANSWER CONTAINER ── -->
<div class="answer-container">
    <div class="answer-box-wrapper">

        <div class="answer-header">
            <div class="answer-header-left">
                <div class="answer-dot"></div>
                <h3>🧠 Error Explanation</h3>
            </div>
            <div class="traffic-lights">
                <div class="tl red"></div>
                <div class="tl yellow"></div>
                <div class="tl green"></div>
            </div>
        </div>

        <div class="levels">
            <span id="beginner" class="level"></span>
            <span id="intermediate" class="level"></span>
            <span id="advanced" class="level"></span>
        </div>

        <div class="answer-body">
            <div class="answer-text" id="answerText">{{ $answer ?? "" }}</div>
        </div>

        <div class="answer-actions">
            <button class="copy-btn" id="copyed" onclick="copyText()">📋 Copy</button>
            <a href="{{ route('home') }}" class="back-btn">↩ Analyze Another Error</a>
        </div>

    </div>
</div>

<!-- ── FOOTER ── -->
<footer class="footer">
    © StrCode • Code Error Explainer ⚡
</footer>

<script>
/* textarea auto expand */
let textarea = document.querySelector("textarea");
textarea.addEventListener("input", function(){
    textarea.style.height="auto";
    textarea.style.height=textarea.scrollHeight+"px";
});

/* button loading effect */
const form = document.querySelector("form");
const btn = document.querySelector("button");
form.addEventListener("submit", function(){
    btn.innerText="Analyzing...";
    btn.style.opacity="0.7";
});

/* theme toggle */
let body = document.querySelector("body");
let switchcircle = document.querySelector(".switch-circle");

let osthem = window.matchMedia("(prefers-color-scheme: dark)").matches;
if(!osthem){
    body.classList.remove("dark-mode");
    body.classList.add("light-mode");
    switchcircle.textContent = "☀️";
}

switchcircle.addEventListener("click", function(){
    body.classList.remove("dark-mode");
    body.classList.toggle("light-mode");
    switchcircle.textContent = body.classList.contains("light-mode") ? "☀️" : "🌙";
});

/* copy text */
function copyText(){
    const text = document.getElementById("answerText").innerText;
    if(!text.trim()) return;
    navigator.clipboard.writeText(text).then(() => {
        const b = document.getElementById("copyed");
        const orig = b.innerText;
        b.innerText = "✅ Copied!";
        setTimeout(() => b.innerText = orig, 2000);
    });
}

/* starfield canvas */
(function(){
    const canvas = document.getElementById("bgCanvas");
    const ctx = canvas.getContext("2d");
    let W, H, stars = [];
    const STAR_COUNT = 90;
    const LINE_DIST = 140;

    function resize(){
        W = canvas.width = window.innerWidth;
        H = canvas.height = window.innerHeight;
    }

    function initStars(){
        stars = [];
        for(let i = 0; i < STAR_COUNT; i++){
            stars.push({
                x: Math.random() * W,
                y: Math.random() * H,
                r: Math.random() * 1.2 + 0.3,
                vx: (Math.random() - 0.5) * 0.25,
                vy: (Math.random() - 0.5) * 0.25,
                opacity: Math.random() * 0.5 + 0.2
            });
        }
    }

    function draw(){
        ctx.clearRect(0, 0, W, H);
        for(let i = 0; i < stars.length; i++){
            for(let j = i + 1; j < stars.length; j++){
                const dx = stars[i].x - stars[j].x;
                const dy = stars[i].y - stars[j].y;
                const dist = Math.sqrt(dx*dx + dy*dy);
                if(dist < LINE_DIST){
                    const alpha = (1 - dist / LINE_DIST) * 0.18;
                    ctx.beginPath();
                    ctx.strokeStyle = `rgba(57,255,138,${alpha})`;
                    ctx.lineWidth = 0.6;
                    ctx.moveTo(stars[i].x, stars[i].y);
                    ctx.lineTo(stars[j].x, stars[j].y);
                    ctx.stroke();
                }
            }
        }
        stars.forEach(s => {
            ctx.beginPath();
            ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(57,255,138,${s.opacity})`;
            ctx.fill();
            s.x += s.vx; s.y += s.vy;
            if(s.x < 0) s.x = W;
            if(s.x > W) s.x = 0;
            if(s.y < 0) s.y = H;
            if(s.y > H) s.y = 0;
        });
        requestAnimationFrame(draw);
    }

    resize(); initStars(); draw();
    window.addEventListener("resize", () => { resize(); initStars(); });
})();
</script>

</body>
</html>