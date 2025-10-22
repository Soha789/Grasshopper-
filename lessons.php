<?php /* lessons.php */ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Lessons — CodeSprout</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
:root{--bg:#0f1226;--card:#171b34;--txt:#e8ecff;--muted:#8ea0d0;--pri:#7c5cff;--pri2:#00e1ff}
body{margin:0;font-family:Inter,system-ui;color:var(--txt);background:
  radial-gradient(1000px 500px at 90% -10%, rgba(0,225,255,.12), transparent 60%),
  radial-gradient(1000px 500px at -10% 30%, rgba(124,92,255,.12), transparent 60%),
  var(--bg)}
nav{display:flex;justify-content:space-between;align-items:center;padding:16px 22px}
.btn{padding:10px 14px;border-radius:12px;border:1px solid #2b2f54;background:#111433;color:var(--txt);cursor:pointer}
.main{max-width:980px;margin:0 auto;padding:18px}
.card{background:linear-gradient(180deg,#171b34,#121531); border:1px solid #283060; border-radius:16px; padding:18px}
.list{display:grid; gap:12px}
.item{display:flex; align-items:center; justify-content:space-between; gap:10px; padding:12px; border-radius:12px; border:1px solid #2b2f54; background:#10143a}
.item small{color:var(--muted)}
.item button{background:linear-gradient(90deg,var(--pri),var(--pri2)); border:none; color:#0a0c1a; padding:8px 12px; border-radius:10px; font-weight:800; cursor:pointer}
.badge{padding:4px 8px;border-radius:999px;background:#0b0e26;border:1px solid #2b2f54;color:#9fb2ffbd;font-size:12px}
</style>
</head>
<body>
  <nav>
    <div style="display:flex;align-items:center;gap:10px"><div style="width:28px;height:28px;border-radius:7px;background:conic-gradient(from 210deg,#7c5cff,#00e1ff)"></div><strong>CodeSprout</strong></div>
    <div>
      <button class="btn" onclick="go('dashboard.php')">Dashboard</button>
      <button class="btn" onclick="go('progress.php')">Progress</button>
    </div>
  </nav>

  <div class="main">
    <div class="card">
      <h2>Beginner Path</h2>
      <p style="color:#8ea0d0">Work through each challenge. Your progress saves automatically.</p>
      <div class="list" id="list"></div>
    </div>
  </div>

<script>
function go(h){window.location.href=h;}
const lessons=[
  {id:1, title:"Variables 101", desc:"Create and read variables", badge:"🌱 Variable Sprout"},
  {id:2, title:"Functions Basics", desc:"Write a function that returns a value", badge:"🧠 Function Rookie"},
  {id:3, title:"Arrays & Map", desc:"Transform arrays the smart way", badge:"🧩 Array Tinkerer"},
  {id:4, title:"FizzBuzz", desc:"Conditionals + loops classic", badge:"⚡ Logic Runner"},
  {id:5, title:"Sum with Loop", desc:"Accumulate totals from arrays", badge:"📈 Loop Learner"},
];
function getUser(){
  const email=localStorage.getItem('cs_current'); const users=JSON.parse(localStorage.getItem('cs_users')||'{}');
  return users[email]||null;
}
(function render(){
  const u=getUser(); if(!u){ window.location.href='login.php'; return; }
  const list=document.getElementById('list');
  lessons.forEach(ls=>{
    const done = (u.progress||{})[ls.id]==true;
    const row=document.createElement('div'); row.className='item';
    row.innerHTML=`
      <div>
        <strong>${ls.title}</strong>
        <div><small>${ls.desc}</small></div>
      </div>
      <div style="display:flex;align-items:center;gap:8px">
        ${done?`<span class="badge">Completed ✓</span>`:''}
        <button onclick="openChallenge(${ls.id})">${done?'Review':'Start'}</button>
      </div>`;
    list.appendChild(row);
  });
})();
function openChallenge(id){ window.location.href='challenge.php?id='+id; }
</script>
</body>
</html>
