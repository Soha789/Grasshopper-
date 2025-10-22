<?php /* index.php */ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CodeSprout — Learn to Code, Playfully</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
:root{
  --bg:#0f1226; --card:#171b34; --muted:#8ea0d0; --pri:#7c5cff; --pri2:#00e1ff;
  --txt:#e8ecff; --ok:#36d399; --warn:#ffd166; --bad:#ff6b6b;
  --ring: 0 0 0 3px rgba(124,92,255,.25);
}
*{box-sizing:border-box}
body{
  margin:0; font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;
  color:var(--txt); background:
    radial-gradient(1200px 600px at 80% -10%, rgba(0,225,255,.12), transparent 60%),
    radial-gradient(1000px 500px at -10% 20%, rgba(124,92,255,.15), transparent 60%),
    var(--bg);
  min-height:100svh; display:flex; flex-direction:column;
}
nav{
  display:flex; align-items:center; justify-content:space-between; gap:12px;
  padding:16px 24px; position:sticky; top:0; backdrop-filter: blur(8px);
}
.brand{display:flex; align-items:center; gap:10px; font-weight:800; letter-spacing:.5px}
.logo{
  width:38px; height:38px; border-radius:10px; background:
    conic-gradient(from 210deg, var(--pri), var(--pri2));
  box-shadow:0 10px 40px rgba(124,92,255,.35);
}
nav .actions a, nav .actions button{
  padding:10px 16px; border-radius:12px; border:1px solid #2a2f57;
  background:linear-gradient(180deg,#1a1f3e,#141735); color:var(--txt);
  text-decoration:none; cursor:pointer; transition:.2s; font-weight:600
}
nav .actions a:hover, nav .actions button:hover{transform:translateY(-1px); box-shadow:var(--ring)}
.hero{
  display:grid; grid-template-columns:1.1fr 0.9fr; gap:28px; padding:40px 24px 24px; max-width:1100px; margin:0 auto; width:100%;
}
h1{
  font-size:clamp(28px,4.6vw,48px); line-height:1.08; margin:8px 0 12px;
  background:linear-gradient(90deg,#fff, #cfe4ff 40%, #b1a3ff); -webkit-background-clip:text; color:transparent;
}
.sub{color:var(--muted); font-size:clamp(14px,2vw,18px); max-width:60ch}
.cta{display:flex; gap:12px; margin-top:18px; flex-wrap:wrap}
.btn{
  padding:12px 18px; border:none; border-radius:14px; font-weight:800; cursor:pointer;
  background:linear-gradient(90deg, var(--pri), var(--pri2)); color:#0a0c1a; box-shadow:0 10px 30px rgba(0,225,255,.25);
}
.btn.sec{background:#121531; color:var(--txt); border:1px solid #2b2f54}
.card{
  background:linear-gradient(180deg,#171b34,#131634); border:1px solid #262b58; border-radius:16px;
  padding:18px; box-shadow:0 10px 30px rgba(0,0,0,.25)
}
.grid{display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-top:18px}
.kpi{display:flex; align-items:center; gap:10px; color:var(--muted); font-size:14px}
.kpi strong{font-size:20px; color:#fff}
footer{margin-top:auto; padding:22px; text-align:center; color:#9fb2ff69; font-size:13px}
@media(max-width:900px){ .hero{grid-template-columns:1fr} .grid{grid-template-columns:1fr} }
</style>
</head>
<body>
  <nav>
    <div class="brand"><div class="logo"></div> <span>CodeSprout</span></div>
    <div class="actions">
      <a href="login.php">Log in</a>
      <a href="signup.php">Sign up</a>
    </div>
  </nav>

  <section class="hero">
    <div>
      <h1>Master Coding the fun way. Tiny lessons, big wins.</h1>
      <p class="sub">Interactive mini-lessons, live code editor, instant feedback, and a rewards system that makes learning addictive—just like Grasshopper, but crafted for you.</p>
      <div class="cta">
        <button class="btn" onclick="go('signup.php')">Start Free — Get Badges</button>
        <button class="btn sec" onclick="go('login.php')">I already have an account</button>
      </div>
      <div class="grid">
        <div class="card">
          <h3>Interactive Editor</h3><p class="sub">Write & run JavaScript directly in your browser. Tests verify your code instantly.</p>
        </div>
        <div class="card">
          <h3>Lesson Path</h3><p class="sub">Bite-sized lessons with hints & solutions so you never feel stuck.</p>
        </div>
        <div class="card">
          <h3>Gamified Progress</h3><p class="sub">Earn XP, unlock badges, level up, and keep your streak alive.</p>
        </div>
      </div>
      <div class="kpi">
        <strong>Beginner-friendly</strong> • No setup • Works on mobile
      </div>
    </div>
    <div class="card">
      <h3>Live Preview</h3>
      <p class="sub">Try a tiny challenge. Type the correct greeting and hit Run.</p>
      <textarea id="demo" class="card" style="height:120px; width:100%; background:#0e1130; color:#e8ecff; border-radius:12px; border:1px solid #2b2f54; padding:12px;">// Write a function greet() that returns "Hello, world!"
function greet(){
  return "Hello, world!";
}</textarea>
      <button class="btn" style="margin-top:10px" onclick="runDemo()">Run</button>
      <pre id="out" class="card" style="margin-top:10px; white-space:pre-wrap; background:#0a0d26"></pre>
    </div>
  </section>

  <footer>© <span id="y"></span> CodeSprout. Learn daily, level up weekly.</footer>

<script>
function go(href){ window.location.href = href; }
document.getElementById('y').textContent = new Date().getFullYear();
function safeEval(src){
  try{
    const f = new Function(src+"; return typeof greet==='function'?greet():undefined;");
    return f();
  }catch(e){ return e.message; }
}
function runDemo(){
  const val = document.getElementById('demo').value;
  const r = safeEval(val);
  const ok = r==="Hello, world!";
  document.getElementById('out').textContent = ok ? "✅ Tests passed!" : "❌ Expected 'Hello, world!' but got: "+r;
}
</script>
</body>
</html>
