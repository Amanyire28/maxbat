@extends('admin.layout')
@section('title', 'Chat — '.$chatRoom->user->name)
@section('content')

@push('styles')
<style>
    .chat-wrap{display:grid;grid-template-columns:1fr;gap:20px;}
    @media(min-width:900px){.chat-wrap{grid-template-columns:280px 1fr;}}
    .customer-info{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:24px;}
    .cust-avatar{width:64px;height:64px;border-radius:50%;background:var(--green-light);border:2px solid var(--green-border);display:flex;align-items:center;justify-content:center;font-family:'Bebas Neue',sans-serif;font-size:28px;color:var(--green);margin:0 auto 14px;}
    .cust-name{text-align:center;font-family:'Bebas Neue',sans-serif;font-size:20px;color:#fff;text-transform:uppercase;letter-spacing:1px;}
    .cust-email{text-align:center;font-size:13px;color:rgba(255,255,255,0.4);margin-top:4px;word-break:break-all;}
    .cust-meta{margin-top:20px;display:flex;flex-direction:column;gap:10px;}
    .cust-meta-row{display:flex;align-items:center;gap:8px;font-size:13px;color:rgba(255,255,255,0.5);}
    .cust-meta-row i{color:var(--green);width:16px;text-align:center;}

    .chat-card{background:var(--card);border:1px solid var(--border);border-radius:12px;overflow:hidden;display:flex;flex-direction:column;}
    .chat-header{padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
    .chat-header h3{font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;letter-spacing:1px;color:#fff;}
    .chat-messages{height:460px;overflow-y:auto;padding:20px;display:flex;flex-direction:column;gap:12px;scroll-behavior:smooth;}
    .chat-messages::-webkit-scrollbar{width:4px;}
    .chat-messages::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.1);border-radius:2px;}

    .msg{display:flex;flex-direction:column;max-width:72%;}
    .msg.mine{align-self:flex-end;align-items:flex-end;}
    .msg.theirs{align-self:flex-start;align-items:flex-start;}
    .msg-bubble{padding:10px 14px;border-radius:12px;font-size:14px;line-height:1.55;word-break:break-word;}
    .msg.mine .msg-bubble{background:var(--green);color:#000;border-bottom-right-radius:3px;}
    .msg.theirs .msg-bubble{background:#252525;color:#fff;border-bottom-left-radius:3px;}
    .msg-meta{font-size:11px;color:rgba(255,255,255,0.35);margin-top:4px;padding:0 2px;}

    .chat-input-area{padding:16px 20px;border-top:1px solid var(--border);display:flex;gap:10px;align-items:flex-end;}
    .chat-textarea{flex:1;background:#252525;border:1px solid rgba(255,255,255,0.10);color:#fff;padding:11px 14px;border-radius:8px;font-family:'Barlow',sans-serif;font-size:14px;resize:none;min-height:44px;max-height:120px;transition:border-color 0.2s;line-height:1.5;}
    .chat-textarea:focus{outline:none;border-color:var(--green);}
    .chat-textarea::placeholder{color:rgba(255,255,255,0.2);}
    .send-btn{width:44px;height:44px;border-radius:8px;background:var(--green);border:none;color:#000;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background 0.2s;}
    .send-btn:hover{background:#68e000;}
    .send-btn:disabled{background:#333;color:#666;cursor:not-allowed;}
</style>
@endpush

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.chats.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-arrow-left"></i> All Chats</a>
    <span style="color:rgba(255,255,255,0.35);font-size:14px;">Chat with {{ $chatRoom->user->name }}</span>
</div>

<div class="chat-wrap">

    {{-- CUSTOMER INFO --}}
    <div>
        <div class="customer-info">
            <div class="cust-avatar">{{ strtoupper(substr($chatRoom->user->name, 0, 1)) }}</div>
            <div class="cust-name">{{ $chatRoom->user->name }}</div>
            <div class="cust-email">{{ $chatRoom->user->email }}</div>
            <div class="cust-meta">
                <div class="cust-meta-row"><i class="fa fa-calendar"></i> Joined {{ $chatRoom->user->created_at->format('d M Y') }}</div>
                <div class="cust-meta-row"><i class="fa fa-comments"></i> {{ $chatRoom->messages->count() }} messages</div>
            </div>
        </div>
    </div>

    {{-- CHAT --}}
    <div class="chat-card">
        <div class="chat-header">
            <h3><i class="fa fa-comments" style="color:var(--green);margin-right:8px;"></i> Conversation</h3>
            <span style="font-size:12px;color:rgba(255,255,255,0.35);">Updates every 4s</span>
        </div>

        <div class="chat-messages" id="chatMessages">
            @forelse($chatRoom->messages as $msg)
            <div class="msg {{ $msg->sender_type === 'admin' ? 'mine' : 'theirs' }}" data-id="{{ $msg->id }}">
                <div class="msg-bubble">{{ $msg->body }}</div>
                <div class="msg-meta">
                    {{ $msg->sender_type === 'admin' ? 'You' : $chatRoom->user->name }}
                    · {{ $msg->created_at->format('d M Y, H:i') }}
                </div>
            </div>
            @empty
            <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:rgba(255,255,255,0.3);text-align:center;padding:40px;">
                <i class="fa fa-comments" style="font-size:36px;margin-bottom:12px;opacity:0.3;"></i>
                <p>No messages yet. Send the first message!</p>
            </div>
            @endforelse
        </div>

        <div class="chat-input-area">
            <textarea id="chatInput" class="chat-textarea" placeholder="Type your reply…" rows="1" maxlength="2000"></textarea>
            <button class="send-btn" id="sendBtn" title="Send reply">
                <i class="fa fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    const messagesEl = document.getElementById('chatMessages');
    const inputEl    = document.getElementById('chatInput');
    const sendBtn    = document.getElementById('sendBtn');
    const SEND_URL   = '{{ route("admin.chats.send", $chatRoom) }}';
    const POLL_URL   = '{{ route("admin.chats.poll", $chatRoom) }}';
    const CSRF       = '{{ csrf_token() }}';

    let lastId = 0;
    document.querySelectorAll('.msg[data-id]').forEach(el => {
        lastId = Math.max(lastId, parseInt(el.dataset.id));
    });

    function scrollToBottom() { messagesEl.scrollTop = messagesEl.scrollHeight; }
    scrollToBottom();

    function escHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function appendMessage(msg) {
        const empty = messagesEl.querySelector('[style*="height:100%"]');
        if (empty) empty.remove();

        const isMine = msg.sender_type === 'admin';
        const div = document.createElement('div');
        div.className = 'msg ' + (isMine ? 'mine' : 'theirs');
        div.dataset.id = msg.id;
        div.innerHTML = `
            <div class="msg-bubble">${escHtml(msg.body)}</div>
            <div class="msg-meta">${isMine ? 'You' : '{{ addslashes($chatRoom->user->name) }}'} · ${escHtml(msg.date)}, ${escHtml(msg.time)}</div>
        `;
        messagesEl.appendChild(div);
        lastId = Math.max(lastId, msg.id);
        scrollToBottom();
    }

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
        } catch(e) { inputEl.value = body; }
        finally { sendBtn.disabled = false; inputEl.focus(); }
    }

    sendBtn.addEventListener('click', sendMessage);
    inputEl.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });
    inputEl.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });

    async function poll() {
        try {
            const res = await fetch(`${POLL_URL}?since=${lastId}`, {headers:{'X-Requested-With':'XMLHttpRequest'}});
            const msgs = await res.json();
            msgs.forEach(m => appendMessage(m));
        } catch(e) {}
    }
    setInterval(poll, 4000);
})();
</script>
@endpush
@endsection
