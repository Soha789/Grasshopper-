<?php /* challenge.php */ $id = isset($_GET['id'])? (int)$_GET['id'] : 1; ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Challenge <?php echo $id; ?> — CodeSprout</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
:root{--bg:#0f1226;--card:#171b34;--txt:#e8ecff;--muted:#8ea0d0;--pri:#7c5cff;--pri2:#00e1ff;--ok:#36d399;--bad:#ff6b6b}
*{box-sizing:border-box}
body{margin:0;font-family:Inter,system-ui;color:var(--txt);background:
  radial-gradient(1000px 500px at 90% -10%, rgba(0,225,255,.12), transparent 60%),
  radial-gradient(1000px 500px at -10% 30%, rgba(124,92,255,.12), transparent 60%),
  var(--bg)}
nav{display:flex;justify-content:space-between;align-items:center;padding:16px 22px}
.btn{padding:10px 14px;border-radius:12px;border:1px solid #2b2f54;background:#111433;color:var(--txt);cursor:pointer}
.main{max-width:1100px;margin:0 auto;padding:18px; display:grid; grid-template-columns:1fr 1fr; gap:16px}
.card{background:linear-gradient(180deg,#171b34,#121531); border:1px solid #283060; border-radius:16px; padding:18px}
h2{margin:0 0 10px}
textarea#editor{width:100%; height:280px; background:#0b0e26; border:1px solid #2b2f54; border-radius:12px; color:var(--txt); padding:12px; font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace}
.actions{display:flex; gap:10px; flex-wrap:wrap}
.run{background:linear-gradient(90deg,var(--pri),var(--pri2)); color:#0a0c1a; border:none; padding:10px 14px; border-radius:12px; font-weight:800; cursor:pointer}
.hint{background:#0b0e26; border:1px solid #2b2f54; padding:8px 12px; border-radius:10px; cursor:pointer}
pre{white-space:pre-wrap; margin:0}
.badge{padding:6px 10px; background:#0b0e26; border:1px solid #2b2f54; border-radius:999px; color:#9fb2ffbd; font-size:12px}
.result{padding:10px; border-radius:12px; background:#0b0e26; border:1px solid #2b2f54; min-height:60px}
.modal{
  position:fixed; inset:0; display:none; place-items:center; background:rgba(0,0,0,.5);
}
.modal .box{background:#111433; border:1px solid #2b2f54; padding:18px; border-radius:16px; width:min(480px,94%); text-align:center}
@media(max-width:900px){.main{grid-template-columns:1fr}}
</style>
</head>
<body>
  <nav>
    <div style="display:flex;align-items:center;gap:10px"><div style="width:28px;height:28px;border-radius:7px;background:conic-gradient(from 210deg,#7c5cff,#00e1ff)"></div><strong>CodeSprout</strong></div>
    <div>
      <button class="btn" onclick="go('lessons.php')">Back to Lessons</button>
      <button class="btn" onclick="go('dashboard.php')">Dashboard</button>
    </div>
  </nav>

  <div class="main">
    <div class="card">
      <h2 id="title">Challenge</h2>
      <p id="desc" style="color:#8ea0d0"></p>
      <div class="actions">
        <button class="run" onclick="runTests()">▶ Run Tests</button>
        <button class="hint" onclick="toggle('hint')">💡 Hint</button>
        <button class="hint" onclick="toggle('solution')">🧩 Solution</button>
      </div>
      <div id="hint" class="card" style="display:none; margin-top:10px"></div>
      <div id="solution" class="card" style="display:none; margin-top:10px"></div>
    </div>

    <div class="card">
      <div style="display:flex;align-items:center;justify-content:space-between">
        <strong>Editor</strong>
        <span id="badge" class="badge"></span>
      </div>
      <textarea id="editor"></textarea>
      <div style="height:10px"></div>
      <div class="result" id="result"></div>
    </div>
  </div>

  <div id="win" class="modal">
    <div class="box">
      <h3>🎉 Great job!</h3>
      <p>You earned <strong>50 XP</strong> and unlocked a badge.</p>
      <button class="run" onclick="closeWin()">Continue</button>
    </div>
  </div>

<script>
function go(h){window.location.href=h;}
function q(k){return new URLSearchParams(window.location.search).get(k);}
const id = parseInt(q('id')||'1',10);

const challenges={
  1:{
    title:"Variables 101",
    desc:"Create a variable named name with value 'Soha' and return it from a function whoAmI().",
    starter:`// Create a variable named \`name\` equal to "Soha"
// Then write a function whoAmI() that returns that variable

`,
    hint:"Use let or const. Example: const name = \"Soha\"; function whoAmI(){ return name; }",
    solution:`const name = "Soha";
function whoAmI(){ return name; }`,
    tests:`(function(){ try{
      const f = new Function(editorVal + "; return typeof whoAmI==='function' ? whoAmI() : '__NO__';");
      const out = f(); return out==="Soha" ? true : "Expected 'Soha' got: "+out;
    }catch(e){ return e.message; } })()`,
    badge:"🌱 Variable Sprout"
  },
  2:{
    title:"Functions Basics",
    desc:"Write function sum(a,b) that returns a+b.",
    starter:`// Write a function sum(a,b) that returns a+b
`,
    hint:"Use return a + b;",
    solution:`function sum(a,b){ return a+b; }`,
    tests:`(function(){ try{
      const f = new Function(editorVal + "; return typeof sum==='function' ? [sum(2,3), sum(-1,6)] : '__NO__';");
      const out = f(); if(out==='__NO__') return "sum is not defined";
      return (out[0]===5 && out[1]===5) ? true : "Wrong sums: "+JSON.stringify(out);
    }catch(e){ return e.message; } })()`,
    badge:"🧠 Function Rookie"
  },
  3:{
    title:"Arrays & Map",
    desc:"Create function doubleAll(arr) that returns a new array with each number * 2 using map.",
    starter:`// doubleAll([1,2,3]) -> [2,4,6]
`,
    hint:"Use arr.map(x => x*2)",
    solution:`function doubleAll(arr){ return arr.map(x=>x*2); }`,
    tests:`(function(){ try{
      const f = new Function(editorVal + "; return typeof doubleAll==='function' ? doubleAll([1,2,3]) : '__NO__';");
      const out = f(); if(out==='__NO__') return "doubleAll is not defined";
      return (Array.isArray(out) && out.join(',')==='2,4,6') ? true : "Expected [2,4,6], got: "+JSON.stringify(out);
    }catch(e){ return e.message; } })()`,
    badge:"🧩 Array Tinkerer"
  },
  4:{
    title:"FizzBuzz",
    desc:"Write fizzBuzz(n) that returns 'Fizz' if divisible by 3, 'Buzz' if divisible by 5, 'FizzBuzz' if both, else the number.",
    starter:`// fizzBuzz(15) -> "FizzBuzz"
`,
    hint:"Check 15 first, then 3, then 5. Use % (modulo).",
    solution:`function fizzBuzz(n){
  if(n%15===0) return "FizzBuzz";
  if(n%3===0) return "Fizz";
  if(n%5===0) return "Buzz";
  return n;
}`,
    tests:`(function(){ try{
      const f = new Function(editorVal + "; return typeof fizzBuzz==='function' ? [fizzBuzz(3),fizzBuzz(5),fizzBuzz(15),fizzBuzz(2)] : '__NO__';");
      const out = f(); if(out==='__NO__') return "fizzBuzz is not defined";
      return (out[0]==="Fizz" && out[1]==="Buzz" && out[2]==="FizzBuzz" && out[3]===2) ? true : "Unexpected: "+JSON.stringify(out);
    }catch(e){ return e.message; } })()`,
    badge:"⚡ Logic Runner"
  },
  5:{
    title:"Sum with Loop",
    desc:"Write total(arr) that returns the sum of numbers using a for loop.",
    starter:`// total([1,2,3]) -> 6
`,
    hint:"Initialize sum=0; loop, add each value; return sum.",
    solution:`function total(arr){ let s=0; for(let i=0;i<arr.length;i++){ s+=arr[i]; } return s; }`,
    tests:`(function(){ try{
      const f = new Function(editorVal + "; return typeof total==='function' ? [total([1,2,3]), total([5,-2,4])] : '__NO__';");
      const out = f(); if(out==='__NO__') return "total is not defined";
      return (out[0]===6 && out[1]===7) ? true : "Wrong totals: "+JSON.stringify(out);
    }catch(e){ return e.message; } })()`,
    badge:"📈 Loop Learner"
  }
};

const c = challenges[id] || challenges[1];
document.getElementById('title').textContent = c.title;
document.getElementById('desc').textContent = c.desc;
document.getElementById('hint').textContent = c.hint;
document.getElementById('solution').textContent = c.solution;
document.getElementById('badge').textContent = c.badge;

const editor = document.getElementById('editor');
const saved = localStorage.getItem('cs_editor_'+id);
editor.value = saved || c.starter;
let editorVal = editor.value;
editor.addEventListener('input', ()=>{ editorVal = editor.value; localStorage.setItem('cs_editor_'+id, editorVal); });

function toggle(id){ const el=document.getElementById(id); el.style.display = (el.style.display==='none'?'block':'none'); }

function getUser(){
  const email=localStorage.getItem('cs_current'); const users=JSON.parse(localStorage.getItem('cs_users')||'{}');
  return users[email]||null;
}
function setUser(u){
  const users=JSON.parse(localStorage.getItem('cs_users')||'{}'); users[u.email]=u; localStorage.setItem('cs_users',JSON.stringify(users));
}

function runTests(){
  const resultEl=document.getElementById('result');
  try{
    const res = eval(c.tests);
    if(res===true){
      resultEl.innerHTML = "<span style='color:var(--ok)'>✅ All tests passed.</span>";
      award();
    }else{
      resultEl.innerHTML = "<span style='color:var(--bad)'>❌ "+res+"</span>";
    }
  }catch(e){
    resultEl.textContent = "Error: "+e.message;
  }
}

function award(){
  const u = getUser(); if(!u){ window.location.href='login.php'; return; }
  u.progress = u.progress||{};
  if(!u.progress[id]){
    u.progress[id] = true;
    u.xp = (u.xp||0) + 50;
    u.badges = u.badges||[];
    if(u.badges.indexOf(c.badge)===-1) u.badges.push(c.badge);
    setUser(u);
    document.getElementById('win').style.display='grid';
  }
}

function closeWin(){
  document.getElementById('win').style.display='none';
  // move to next or back to lessons
  const next = id+1; if(next<=5) window.location.href='challenge.php?id='+next; else window.location.href='progress.php';
}
</script>
</body>
</html>
