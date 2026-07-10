<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard — MaxBat Automobil</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--green:#5BC800;--green-light:rgba(91,200,0,0.12);--green-border:rgba(91,200,0,0.25);--bg:#0f0f0f;--card:#1a1a1a;--border:rgba(255,255,255,0.07);--text:#f0f0f0;--muted:rgba(255,255,255,0.45);}
        html,body{height:100%;font-family:'Barlow',sans-serif;background:var(--bg);color:var(--text);font-size:15px;}
        a{text-decoration:none;color:inherit;}

        /* LAYOUT */
        .layout{display:flex;flex-direction:column;min-height:100vh;}

        /* TOPBAR */
        .topbar{background:#111;border-bottom:1px solid var(--border);height:60px;display:flex;align-items:center;justify-content:space-between;padding:0 20px;position:sticky;top:0;z-index:100;}
        .topbar-logo{display:flex;align-items:center;gap:10px;}
        .topbar-logo img{height:36px;border-radius:5px;}
        .topbar-logo span{font-family:'Bebas Neue',sans-serif;font-size:17px;letter-spacing:1px;color:#fff;}
        .topbar-right{display:flex;align-items:center;gap:14px;}
        .topbar-avatar{width:34px;height:34px;border-radius:50%;background:var(--green);display:flex;align-items:center;justify-content:center;font-weight:700;color:#000;font-size:14px;flex-shrink:0;}
        .topbar-name{font-size:14px;color:var(--muted);}
        .logout-btn{display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:6px;background:rgba(225,6,0,0.1);border:1px solid rgba(225,6,0,0.2);color:#ff6b6b;font-size:13px;font-weight:600;cursor:pointer;font-family:'Barlow',sans-serif;}
        .logout-btn:hover{background:rgba(225,6,0,0.2);}

        /* MAIN */
        .main{flex:1;padding:28px 20px;max-width:900px;margin:0 auto;width:100%;}

        /* WELCOME */
        .welcome{margin-bottom:28px;}
        .welcome h1{font-family:'Bebas Neue',sans-serif;font-size:32px;color:#fff;text-transform:uppercase;letter-spacing:1px;}
        .welcome p{color:var(--muted);font-size:14px;margin-top:4px;}

        /* CHAT CARD */
        .chat-card{background:var(--card);border:1px solid var(--border);border-radius:14px;overflow:hidden;display:flex;flex-direction:column;}
        .chat-header{padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px;}
        .chat-header-icon{width:40px;height:40px;border-radius:50%;background:var(--green-light);border:1px solid var(--green-border);display:flex;align-items:center;justify-content:center;color:var(--green);font-size:16px;flex-shrink:0;}
        .chat-header-text h3{font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;letter-spacing:1px;color:#fff;}
        .chat-header-text p{font-size:12px;color:var(--muted);margin-top:2px;}
        .online-dot{width:8px;height:8px;background:var(--green);border-radius:50%;display:inline-block;margin-left:6px;animation:pulse 2s infinite;}
        @keyframes pulse{0%,100%{opacity:1}50%{opacity:0.4}}

        /* MESSAGES */
        .chat-messages{height:420px;overflow-y:auto;padding:20px;display:flex;flex-direction:column;gap:12px;scroll-behavior:smooth;}
        .chat-messages::-webkit-scrollbar{width:4px;}
        .chat-messages::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.1);border-radius:2px;}

        .msg{display:flex;flex-direction:column;max-width:72%;}
        .msg.mine{align-self:flex-end;align-items:flex-end;}
        .msg.theirs{align-self:flex-start;align-items:flex-start;}
        .msg-bubble{padding:10px 14px;border-radius:12px;font-size:14px;line-height:1.55;word-break:break-word;}
        .msg.mine .msg-bubble{background:var(--green);color:#000;border-bottom-right-radius:3px;}
        .msg.theirs .msg-bubble{background:#252525;color:#fff;border-bottom-left-radius:3px;}
        .msg-meta{font-size:11px;color:var(--muted);margin-top:4px;padding:0 2px;}
        .msg-sender{font-weight:700;color:var(--green);margin-right:4px;}
        .msg.mine .msg-sender{color:rgba(0,0,0,0.6);}

        /* EMPTY STATE */
        .chat-empty{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:40px;text-align:center;}
        .chat-empty i{font-size:40px;color:rgba(255,255,255,0.1);margin-bottom:12px;}
        .chat-empty p{color:var(--muted);font-size:14px;}

        /* INPUT */
        .chat-input-area{padding:16px 20px;border-top:1px solid var(--border);display:flex;gap:10px;align-items:flex-end;}
        .chat-textarea{flex:1;background:#252525;border:1px solid rgba(255,255,255,0.10);color:#fff;padding:11px 14px;border-radius:8px;font-family:'Barlow',sans-serif;font-size:14px;resize:none;min-height:44px;max-height:120px;overflow-y:auto;transition:border-color 0.2s;line-height:1.5;}
        .chat-textarea:focus{outline:none;border-color:var(--green);}
        .chat-textarea::placeholder{color:rgba(255,255,255,0.2);}
        .send-btn{width:44px;height:44px;border-radius:8px;background:var(--green);border:none;color:#000;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background 0.2s;}
        .send-btn:hover{background:#68e000;}
        .send-btn:disabled{background:#333;color:#666;cursor:not-allowed;}

        /* QUICK LINKS */
        .quick-links{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:14px;margin-top:24px;}
        .quick-card{background:var(--card);border:1px solid var(--border);border-radius:10px;padding:18px;display:flex;align-items:center;gap:12px;transition:border-color 0.2s;}
        .quick-card:hover{border-color:var(--green-border);}
        .quick-card i{font-size:20px;color:var(--green);width:24px;text-align:center;}
        .quick-card-text .title{font-size:14px;font-weight:600;color:#fff;}
        .quick-card-text .sub{font-size:12px;color:var(--muted);margin-top:2px;}
    </style>
</head>
<body>
<div class="layout">

    {{-- TOPBAR --}}
    <header class="topbar">
        <a href="{{ route('home') }}" class="topbar-logo">
            <img src="{{ asset('storage/maxbat.jpg') }}" alt="MaxBat">
            <span>MaxBat Portal</span>
        </a>
        <div class="topbar-right">
            <div class="topbar-name" style="display:flex;align-items:center;gap:8px;">
                <div class="topbar-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <span>{{ $user->name }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn"><i class="fa fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </header>

    <div class="main">
        @if(session('success'))
        <div style="background:var(--green-light);border:1px solid var(--green-border);color:var(--green);padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:14px;">
            <i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        {{-- WELCOME --}}
        <div class="welcome">
            <h1>Hello, {{ explode(' ', $user->name)[0] }} 👋</h1>
            <p>Chat with our team below — we typically reply within a few hours.</p>
        </div>

        {{-- CHAT --}}
        <div class="chat-card">
            <div class="chat-header">
                <div class="chat-header-icon"><i class="fa fa-comments"></i></div>
                <div class="chat-header-text">
                    <h3>MaxBat Support <span class="online-dot"></span></h3>
                    <p>Ask us anything about your vehicle, services or orders</p>
                </div>
            </div>

            <div class="chat-messages" id="chatMessages">
                @if($room->messages->isEmpty())
                <div class="chat-empty">
                    <i class="fa fa-comments"></i>
                    <p>No messages yet. Say hello and we'll get back to you shortly!</p>
                </div>
                @else
                @foreach($room->messages as $msg)
                <div class="msg {{ $msg->sender_type === 'customer' ? 'mine' : 'theirs' }}" data-id="{{ $msg->id }}">
                    <div class="msg-bubble">{{ $msg->body }}</div>
                    <div class="msg-meta">{{ $msg->created_at->format('d M Y, H:i') }}</div>
                </div>
                @endforeach
                @endif
            </div>

            <div class="chat-input-area">
                <textarea
                    id="chatInput"
                    class="chat-textarea"
                    placeholder="Type your message…"
                    rows="1"
                    maxlength="2000"
                ></textarea>
                <button class="send-btn" id="sendBtn" title="Send message">
                    <i class="fa fa-paper-plane"></i>
                </button>
            </div>
        </div>

        {{-- QUICK LINKS --}}
        <div class="quick-links">
            <a href="{{ route('services') }}" class="quick-card">
                <i class="fa fa-tools"></i>
                <div class="quick-card-text"><div class="title">Our Services</div><div class="sub">ECU tuning, diagnostics & more</div></div>
            </a>
            <a href="{{ route('products') }}" class="quick-card">
                <i class="fa fa-shopping-bag"></i>
                <div class="quick-card-text"><div class="title">Products</div><div class="sub">Browse performance parts</div></div>
            </a>
            <a href="{{ route('contact') }}" class="quick-card">
                <i class="fa fa-phone"></i>
                <div class="quick-card-text"><div class="title">Contact Us</div><div class="sub">Call or visit our workshop</div></div>
            </a>
        </div>
    </div>
</div>

<script>
(function() {
    const messagesEl = document.getElementById('chatMessages');
    const inputEl    = document.getElementById('chatInput');
    const sendBtn    = document.getElementById('sendBtn');
    const POLL_URL   = '{{ route("customer.chat.poll") }}';
    const SEND_URL   = '{{ route("customer.chat.send") }}';
    const CSRF       = '{{ csrf_token() }}';

    // Track highest message ID for polling
    let lastId = 0;
    document.querySelectorAll('.msg[data-id]').forEach(el => {
        lastId = Math.max(lastId, parseInt(el.dataset.id));
    });

    function scrollToBottom() {
        messagesEl.scrollTop = messagesEl.scrollHeight;
    }
    scrollToBottom();

    function appendMessage(msg) {
        // Remove empty state if present
        const empty = messagesEl.querySelector('.chat-empty');
        if (empty) empty.remove();

        const isMine = msg.sender_type === 'customer';
        const div = document.createElement('div');
        div.className = 'msg ' + (isMine ? 'mine' : 'theirs');
        div.dataset.id = msg.id;
        div.innerHTML = `
            <div class="msg-bubble">${escHtml(msg.body)}</div>
            <div class="msg-meta">${escHtml(msg.date)}, ${escHtml(msg.time)}</div>
        `;
        messagesEl.appendChild(div);
        lastId = Math.max(lastId, msg.id);
        scrollToBottom();
    }

    function escHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // Send message
    async function sendMessage() {
        const body = inputEl.value.trim();
        if (!body) return;
        sendBtn.disabled = true;
        inputEl.value = '';
        inputEl.style.height = 'auto';
        try {
            const res = await fetch(SEND_URL, {
                method: 'POST',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest'},
                body: JSON.stringify({ body })
            });
            const msg = await res.json();
            if (msg.id) appendMessage(msg);
        } catch(e) {
            inputEl.value = body; // restore on error
        } finally {
            sendBtn.disabled = false;
            inputEl.focus();
        }
    }

    sendBtn.addEventListener('click', sendMessage);
    inputEl.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });

    // Auto-resize textarea
    inputEl.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });

    // Poll every 4 seconds for new messages
    async function poll() {
        try {
            const res = await fetch(`${POLL_URL}?since=${lastId}`, {
                headers: {'X-Requested-With':'XMLHttpRequest'}
            });
            const msgs = await res.json();
            msgs.forEach(m => appendMessage(m));
        } catch(e) {}
    }
    setInterval(poll, 4000);
})();
</script>
</body>
</html>
