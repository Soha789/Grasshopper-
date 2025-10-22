<?php /* progress.php */ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Your Progress — CodeSprout</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
:root{--bg:#0f1226;--card:#171b34;--txt:#e8ecff;--muted:#8ea0d0;--pri:#7c5cff;--pri2:#00e1ff}
body{margin:0;font-family:Inter,system-ui;color:var(--txt);background:
  radial-gradient(1000px 500px at 90% -10%, rgba(0,225,255,.12), transparent 60%),
  radial-gradient(1000px 500px at -10% 30%, rgba(124,92,255,.12), transparent 60%),
  var(--bg)}
nav{display:flex;justify-content:space-between;align-items:center;padding:16px 22px}
.btn{padding:10px 14px;border-radius:12px;border:1px solid #2b2f54;background:#111433;color:var(--txt);cursor:pointer}
.main{max-width:980px;margin:0 auto;padding:18px; display:grid; grid-template-columns:1fr .8fr; gap:16px}
.card{background:linear-gradient(180deg,#171b34,#121531); border:1px solid #283060; border-radius:16px; padding:18px}
.row{display:flex; align-items:center; justify-content:space-between; padding:10px 12px; border:1px solid #2b2f54; border-radius:12px; background:#10143a; margin:8px 0}
.badges{display:flex; gap:8px; flex-wrap:wrap}
.tag{padding:6px 10px; background:#0b0e26; border:1px solid #2b2f54; border-radius:999px; font-size:12px}
.progress{height:14px; background:#0b0e26; border-radius:999px; border:1px solid #293060; overflow:hidden}
.progress>div{height:100%; background:linear-gradient(90deg,var(--pri),var(--pri2))}
@media(max-width:900px){.main{grid-template-columns:1fr}}
</style>
</head>
<body>
  <nav>
    <div style="display:flex;align-items:center;gap:10px"><div style="width:28px;height:28px;border-radius:7px;background:conic-gradient(from 210deg,#7c5cff,#00e1ff)"></div><strong>CodeSprout</strong></div>
    <div>
      <button class="btn" onclick="go('dashboard.php')">Dashboard</button>
      <button class="btn" onclick="go('lessons.php')">Lessons</button>
      <button class="btn" onclick="resetProgress()">Reset</button>
    </div>
  </nav>

  <div class="main">
    <div class="card">
      <h2>Progress Overview</h2>
      <div id="rows"></div>
    </div>
    <div class="card">
      <h3>Badges</h3>
      <div class="badges" id="badges"></div>
      <h3 style="margin-top:16px">XP</h3>
      <div class="progress"><div id="bar" style="width:0%"></div></div>
      <div style="margin-top:6px;color:#8ea0d0"><span id="xp">0</span> XP total</div>
    </div>
  </div>

<script>
function go(h){window.location.href=h;}
const titles={1:"Variables 101",2:"Functions Basics",3:"Arrays & Map",4:"FizzBuzz",5:"Sum with Loop"};
function getUser(){
  const email=localStorage.getItem('cs_current'); const users=JSON.parse(localStorage.getItem('cs_users')||'{}');
  return users[email]||null;
}
function setUser(u){
  const users=JSON.parse(localStorage.getItem('cs_users')||'{}'); users[u.email]=u; localStorage.setItem('cs_users',JSON.stringify(users));
}
(function render(){
  const u=getUser(); if(!u){ window.location.href='login.php'; return; }
  const rows=document.getElementById('rows');
  let solved=0;
  for(let i=1;i<=5;i++){
    const pass = (u.progress||{})[i]==true;
    if(pass) solved++;
    const row=document.createElement('div'); row.className='row';
    row.innerHTML=`<div><strong>${titles[i]}</strong><div style="color:#8ea0d0;font-size:13px">${pass?'Completed ✓':'Not done'}</div></div>
    <div><button class="btn" onclick="go('challenge.php?id=${i}')">${pass?'Review':'Start'}</button></div>`;
    rows.appendChild(row);
  }
  document.getElementById('xp').textContent = u.xp||0;
  const pct = Math.min(100, Math.round(((u.xp||0)%200)/200*100));
  document.getElementById('bar').style.width = pct+'%';
  const b=document.getElementById('badges'); (u.badges||[]).forEach(x=>{ const t=document.createElement('span'); t.className='tag'; t.textContent=x; b.appendChild(t); });
})();
function resetProgress(){
  if(!confirm("Reset your progress, XP, and badges?")) return;
  const u=getUser(); if(!u) return;
  u.progress={}; u.xp=0; u.badges=[]; setUser(u);
  for(let i=1;i<=5;i++) localStorage.removeItem('cs_editor_'+i);
  location.reload();
}
</script>
</body>
</html>
