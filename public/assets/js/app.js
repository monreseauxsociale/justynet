// Preloader hide on load
window.addEventListener('load', ()=>{
  const p=document.getElementById('preloader');
  if(p){ setTimeout(()=> p.classList.add('hidden'), 450); }
});

// Feed reactions and comments
document.addEventListener('click', (e)=>{
  const reactBtn = e.target.closest('.react-btn');
  if(reactBtn){
    fetch('/post/react', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:`post_id=${reactBtn.dataset.id}&type=${reactBtn.dataset.type}`});
  }
  const cSend = e.target.closest('.comment-send');
  if(cSend){
    const parent = cSend.closest('.card-body');
    const input = parent.querySelector('.comment-input');
    fetch('/post/comment', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:`post_id=${cSend.dataset.id}&text=${encodeURIComponent(input.value)}`}).then(()=>{input.value='';});
  }
});

// Messaging
(function(){
  const userList=document.getElementById('userList');
  const thread=document.getElementById('thread');
  const input=document.getElementById('msgInput');
  const send=document.getElementById('msgSend');
  let withId=null;
  function render(messages){
    if(!thread) return;
    thread.innerHTML = messages.map(m=>`<div class="msg ${m.from_id==CURRENT_USER?'me':'you'}"><div>${escapeHtml(m.text)}</div><div class="small text-muted">${m.created_at}</div></div>`).join('');
    thread.scrollTop = thread.scrollHeight;
  }
  async function load(){
    if(!withId) return;
    const r=await fetch(`/messages/thread?with=${withId}`);
    const j=await r.json();
    render(j.messages||[]);
  }
  if(userList){
    userList.addEventListener('click', (e)=>{
      const it=e.target.closest('.user-item');
      if(!it) return;
      withId = it.dataset.id;
      load();
    });
  }
  if(send){
    send.addEventListener('click', async ()=>{
      if(!withId||!input.value.trim()) return;
      await fetch('/messages/send',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:`to=${withId}&text=${encodeURIComponent(input.value)}`});
      input.value='';
      load();
    });
    setInterval(load, 2000);
  }
})();

function escapeHtml(s){return s.replace(/[&<>"']/g,c=>({"&":"&amp;","<":"&lt;",">":"&gt;","\"":"&quot;","'":"&#39;"}[c]))}

// Notifications API
if ('Notification' in window) {
  if (Notification.permission === 'default') {
    Notification.requestPermission();
  }
  setInterval(async ()=>{
    try{
      const r = await fetch('/notifications');
      const items = await r.json();
      (items||[]).forEach(n=>{
        new Notification(n.title || 'Justy', { body: n.body || '', icon: '/assets/img/icon-192.png' });
        fetch('/notifications/read', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:`id=${n.id}`});
      });
    }catch(e){}
  }, 15000);
}

// Service worker for optional push/static caching
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/sw.js').catch(()=>{});
}