<?php /* dashboard.php */ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dashboard — CodeSprout</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
:root{--bg:#0f1226;--card:#171b34;--muted:#8ea0d0;--txt:#e8ecff;--pri:#7c5cff;--pri2:#00e1ff;--ok:#36d399}
*{box-sizing:border-box}
body{margin:0;font-family:Inter,system-ui; color:var(--txt); background:
  radial-gradient(1000px 500px at 90% -10%, rgba(0,225,255,.12), transparent 60%),
  radial-gradient(1000px 500px at -10% 30%, rgba(124,92,255,.12), transparent 60%),
  var(--bg);
  min-height:100svh;
}
nav{display:flex; justify-content:space-between; align-items:center; padding:16px 22px}
.brand{display:flex; align-items:center; gap:10px}
.logo{width:30px; height:30px; border-radius:8px; background:conic-gradient(from 210deg,var(--pri),var(--pri2))}
.btn{padding:10px 14px;border-radius:12px;border:1px solid #2b2f54;background:#111433;color:var(--txt);cursor:pointer}
.main{max-width:1100px;margin:0 auto;padding:18px; display:grid; grid-template-columns:1.2fr .8fr; gap:16px}
.card{background:linear-gradient(180deg,#171b34,#121531); border:1px solid #283060; border-radius:16px; padding:18px}
h2{margin:0 0 8px}
.progress{height:14px; background:#0b0e26; border-radius:999px; border:1px solid #293060; overflow:hidden}
.progress>div{height:100%; background:linear-gradient(90deg,var(--pri),var(--pri2))}
.kpis{display:grid; grid-template-columns:repeat(3,1fr); gap:10px}
.kpi{background:#0b0e26; border:1px solid #293060; border-radius:12px; padding:12px; text-align:center}
.lesson{display:flex; align-items:center; justify-content:space-between; gap:10px; padding:12px; border-radius:12px; border:1px solid #2b2f54; background:#10143a; margin:8px 0}
.lesson button{background:linear-gradient(90deg,var(--pri),var(--pri2)); border:none; color:#0a0c1a; padding:8px 12px; border-radius:10px; font-weight:800; cursor:pointer}
.badges{display:flex; gap:8px; flex-wrap:wrap}
.tag{padding:6px 10px; background:#0b0e26; border:1px solid #2b2f54; border-radius:999px; font-size:12px}
@media(max-width:900px){.main{grid-template-columns:1fr}}
</style>
</head>
<body>
  <nav>
    <div class="brand"><div class="logo"></div><strong>CodeSprout</strong></div>
    <div class="actions">
      <button class="btn" onclick="go('lessons.php')">Lessons</button>
      <button class="btn" onclick="go('progress.php')">Progress</button>
      <button class="btn" onclick="logout()">Logout</button>
    </div>
  </nav>

  <div class="main">
    <div class="card">
      <h2 id="hi">Welcome!</h2>
      <p style="color:#8ea0d0">Your learning journey at a glance.</p>
      <div class="kpis">
        <div class="kpi"><div style="font-size:26px" id="xp">0</div><div style="color:#8ea0d0">XP</div></div>
        <div class="kpi"><div style="font-size:26px" id="done">0/5</div><div style="color:#8ea0d0">Challenges</div></div>
        <div class="kpi"><div style="font-size:26px" id="lvl">Lv 1</div><div style="color:#8ea0d0">Level</div></div>
      </div>
      <h3 style="margin-top:16px">Overall Progress</h3>
      <div class="progress"><div id="bar" style="width:0%"></div></div>
      <div style="margin-top:14px">
        <div class="lesson"><div><strong>Start Path</strong><div style="color:#8ea0d0;font-size:13px">Variables, Functions, Loops, Arrays, Conditions</div></div><button onclick="go('lessons.php')">Continue</button></div>
      </div>
    </div>
    <div class="card">
      <h3>Badges</h3>
      <div class="badges" id="badges"></div>
      <p style="color:#8ea0d0; margin-top:8px">Earn badges by passing challenges.</p>
    </div>
  </div>

<script>
function go(h){ window.location.href=h; }
function getCurrent(){
  const email=localStorage.getItem('cs_current'); const users=JSON.parse(localStorage.getItem('cs_users')||'{}');
  return users[email]||null;
}
function setCurrent(u){
  const users=JSON.parse(localStorage.getItem('cs_users')||'{}'); users[u.email]=u; localStorage.setItem('cs_users',JSON.stringify(users));
}
function logout(){ localStorage.removeItem('cs_current'); window.location.href='index.php'; }

(function init(){
  const u=getCurrent(); if(!u){ window.location.href='login.php'; return; }
  document.getElementById('hi').textContent=`Welcome, ${u.name} 👋`;
  const total=5;
  const solved = Object.values(u.progress||{}).filter(Boolean).length;
  document.getElementById('done').textContent=`${solved}/${total}`;
  document.getElementById('xp').textContent = u.xp||0;
  const lvl = 1 + Math.floor((u.xp||0)/200);
  document.getElementById('lvl').textContent = `Lv ${lvl}`;
  document.getElementById('bar').style.width = Math.round((solved/total)*100)+'%';
  const wrap=document.getElementById('badges');
  (u.badges||[]).forEach(b=>{
    const el=document.createElement('span'); el.className='tag'; el.textContent=b; wrap.appendChild(el);
  });
})();
</script>
</body>
</html>
