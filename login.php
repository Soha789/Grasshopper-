<?php /* login.php */ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Log in — CodeSprout</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
:root{--bg:#0f1226;--card:#171b34;--pri:#7c5cff;--txt:#e8ecff;--muted:#9fb2ff9c}
body{margin:0;font-family:Inter,system-ui; color:var(--txt); background:radial-gradient(900px 500px at 20% -10%, rgba(0,225,255,.16), transparent 60%), var(--bg); min-height:100svh; display:grid; place-items:center}
.card{background:linear-gradient(180deg,#171b34,#121531); border:1px solid #283060; border-radius:16px; padding:22px; width:min(560px,94%)}
h1{margin:0 0 10px}
label{display:block; font-size:14px; color:var(--muted); margin-top:10px}
input{width:100%; padding:12px 14px; border-radius:12px; background:#0b0e26; border:1px solid #272c58; color:var(--txt); margin-top:6px}
.btn{margin-top:14px; width:100%; padding:12px 16px; border:none; border-radius:14px; font-weight:800; cursor:pointer;
background:linear-gradient(90deg,#7c5cff,#00e1ff); color:#0a0c1a}
a{color:#cfe4ff}
</style>
</head>
<body>
  <div class="card">
    <h1>Welcome back</h1>
    <p style="color:#9fb2ff9c">Log in to continue your lessons and streak.</p>
    <form onsubmit="event.preventDefault(); login();">
      <label>Email</label><input id="email" type="email" required>
      <label>Password</label><input id="pass" type="password" required>
      <button class="btn">Log in</button>
    </form>
    <p style="margin-top:10px; color:#9fb2ff9c">New here? <a href="signup.php">Create an account</a></p>
  </div>
<script>
function login(){
  const email = document.getElementById('email').value.trim().toLowerCase();
  const pass = document.getElementById('pass').value;
  const users = JSON.parse(localStorage.getItem('cs_users')||'{}');
  if(!users[email] || users[email].pass!==pass){ alert("Invalid credentials."); return; }
  localStorage.setItem('cs_current', email);
  window.location.href="dashboard.php";
}
</script>
</body>
</html>
