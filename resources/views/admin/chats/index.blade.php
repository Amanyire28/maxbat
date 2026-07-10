@extends('admin.layout')
@section('title','Customer Chats')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Bebas Neue',sans-serif;font-size:26px;color:#fff;text-transform:uppercase;letter-spacing:1px;">Customer Chats</h2>
        <p style="color:rgba(255,255,255,0.4);font-size:13px;margin-top:4px;">All customer conversations</p>
    </div>
</div>

<div class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Last Message</th>
                    <th>Last Activity</th>
                    <th>Unread</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @forelse($rooms as $room)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:36px;height:36px;border-radius:50%;background:var(--green-light);border:1px solid var(--green-border);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--green);font-size:14px;flex-shrink:0;">
                            {{ strtoupper(substr($room->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight:600;color:#fff;">{{ $room->user->name }}</div>
                            <div style="font-size:12px;color:rgba(255,255,255,0.4);">{{ $room->user->email }}</div>
                        </div>
                    </div>
                </td>
                <td style="max-width:260px;">
                    @if($room->latestMessage)
                    <div style="color:rgba(255,255,255,0.65);font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:240px;">
                        @if($room->latestMessage->sender_type === 'admin')
                            <span style="color:var(--green);font-size:11px;font-weight:700;margin-right:4px;">YOU:</span>
                        @endif
                        {{ $room->latestMessage->body }}
                    </div>
                    @else
                    <span style="color:rgba(255,255,255,0.25);font-size:13px;">No messages yet</span>
                    @endif
                </td>
                <td style="color:rgba(255,255,255,0.4);font-size:13px;">
                    {{ $room->last_message_at ? $room->last_message_at->diffForHumans() : '—' }}
                </td>
                <td>
                    @if($room->unread_count > 0)
                    <span style="background:var(--red);color:#fff;font-size:11px;font-weight:700;padding:3px 8px;border-radius:100px;">
                        {{ $room->unread_count }} new
                    </span>
                    @else
                    <span style="color:rgba(255,255,255,0.25);font-size:13px;">—</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.chats.show', $room) }}" class="btn btn-green btn-sm">
                        <i class="fa fa-comments"></i> Open Chat
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;color:rgba(255,255,255,0.3);padding:48px;">
                    <i class="fa fa-comments" style="font-size:36px;display:block;margin-bottom:12px;opacity:0.3;"></i>
                    No customer conversations yet.
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($rooms->hasPages())
    <div class="pagination-wrap">{{ $rooms->links() }}</div>
    @endif
</div>
@endsection
