<?php /* signup.php */ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sign up — CodeSprout</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
:root{--bg:#0f1226;--card:#171b34;--pri:#7c5cff;--txt:#e8ecff;--muted:#9fb2ff9c}
body{margin:0;font-family:Inter,system-ui; color:var(--txt); background:radial-gradient(900px 500px at 80% -10%, rgba(124,92,255,.2), transparent 60%), var(--bg); min-height:100svh; display:grid; place-items:center}
.wrap{width:min(880px,96%); display:grid; grid-template-columns:1.1fr .9fr; gap:18px}
.card{background:linear-gradient(180deg,#171b34,#121531); border:1px solid #283060; border-radius:16px; padding:22px; box-shadow:0 8px 30px rgba(0,0,0,.35)}
h1{margin:0 0 10px}
label{display:block; font-size:14px; color:var(--muted); margin-top:10px}
input{width:100%; padding:12px 14px; border-radius:12px; background:#0b0e26; border:1px solid #272c58; color:var(--txt); margin-top:6px}
.btn{margin-top:14px; width:100%; padding:12px 16px; border:none; border-radius:14px; font-weight:800; cursor:pointer;
background:linear-gradient(90deg,#7c5cff,#00e1ff); color:#0a0c1a}
a{color:#cfe4ff}
.hero{display:flex; gap:14px; flex-direction:column; justify-content:center}
.badge{display:inline-flex; gap:8px; align-items:center; background:#0b0e26; border:1px solid #293060; padding:8px 10px; border-radius:999px; font-size:13px}
@media(max-width:900px){.wrap{grid-template-columns:1fr}}
</style>
</head>
<body>
  <div class="wrap">
    <div class="hero card">
      <span class="badge">🎯 Beginner Friendly</span>
      <h1>Create your account</h1>
      <p style="color:#9fb2ff9c">Track progress, earn badges, and save your lessons.</p>
      <ul style="margin:0 0 0 18px; color:#9fb2ffbd">
        <li>Interactive JavaScript challenges</li>
        <li>Hints & solutions inside each lesson</li>
        <li>Gamified rewards & XP</li>
      </ul>
    </div>
    <div class="card">
      <form onsubmit="event.preventDefault(); signup();">
        <label>Name</label><input id="name" required placeholder="Soha">
        <label>Email</label><input id="email" type="email" required placeholder="you@example.com">
        <label>Password</label><input id="pass" type="password" required placeholder="••••••••">
        <button class="btn">Create account</button>
      </form>
      <p style="margin-top:10px; color:#9fb2ff9c">Already have an account? <a href="login.php">Log in</a></p>
    </div>
  </div>
<script>
function signup(){
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim().toLowerCase();
  const pass = document.getElementById('pass').value;
  if(pass.length<6){ alert("Password must be at least 6 characters."); return; }
  const users = JSON.parse(localStorage.getItem('cs_users')||'{}');
  if(users[email]){ alert("Account already exists. Please log in."); window.location.href="login.php"; return; }
  users[email] = {name,email,pass, createdAt: Date.now(), xp:0, badges:[], progress:{}};
  localStorage.setItem('cs_users', JSON.stringify(users));
  localStorage.setItem('cs_current', email);
  // JS redirection
  window.location.href = "dashboard.php";
}
</script>
</body>
</html>
