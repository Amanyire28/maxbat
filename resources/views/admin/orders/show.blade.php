@extends('admin.layout')
@section('title','Order #'.$order->id)
@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
    <span style="color:rgba(255,255,255,0.35);">Order #{{ $order->id }}</span>
    @php
        $badge = match($order->status){
            'pending'=>'badge-new','confirmed'=>'badge-progress','shipped'=>'badge-progress',
            'delivered'=>'badge-completed','cancelled'=>'badge-cancelled',default=>'badge-new'
        };
    @endphp
    <span class="badge {{ $badge }}">{{ ucfirst($order->status) }}</span>
</div>

<div style="display:grid;grid-template-columns:1fr;gap:20px;">
    @media(min-width:900px){style="grid-template-columns:1fr 320px;"}

    {{-- ORDER ITEMS --}}
    <div class="form-card">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:20px;text-transform:uppercase;color:#fff;margin-bottom:20px;letter-spacing:1px;">
            <i class="fa fa-shopping-cart" style="color:var(--green);margin-right:8px;"></i> Order Items
        </h3>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid rgba(255,255,255,0.07);">
                    <th style="text-align:left;padding:10px 0;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.4);">Product</th>
                    <th style="text-align:center;padding:10px 0;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.4);">Qty</th>
                    <th style="text-align:right;padding:10px 0;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.4);">Price</th>
                    <th style="text-align:right;padding:10px 0;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.4);">Subtotal</th>
                </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
            <tr style="border-bottom:1px solid rgba(255,255,255,0.04);">
                <td style="padding:14px 0;color:#fff;font-weight:600;">{{ $item['name'] }}</td>
                <td style="padding:14px 0;text-align:center;color:rgba(255,255,255,0.6);">{{ $item['qty'] }}</td>
                <td style="padding:14px 0;text-align:right;color:rgba(255,255,255,0.6);">${{ number_format($item['price'], 2) }}</td>
                <td style="padding:14px 0;text-align:right;color:var(--green);font-family:'Bebas Neue',sans-serif;font-size:18px;">${{ number_format($item['price'] * $item['qty'], 2) }}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="padding-top:16px;font-weight:700;text-align:right;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:1px;font-size:13px;">Total</td>
                    <td style="padding-top:16px;text-align:right;color:var(--green);font-family:'Bebas Neue',sans-serif;font-size:26px;">${{ number_format($order->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        @if($order->notes)
        <div style="margin-top:20px;padding-top:16px;border-top:1px solid rgba(255,255,255,0.07);">
            <div class="form-label">Customer Notes</div>
            <p style="color:rgba(255,255,255,0.65);font-size:14px;margin-top:6px;line-height:1.6;">{{ $order->notes }}</p>
        </div>
        @endif
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 320px;gap:20px;margin-top:20px;" class="order-side-grid">
    <div class="form-card">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;color:#fff;margin-bottom:16px;letter-spacing:1px;">Customer</h3>
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
            <div style="width:44px;height:44px;border-radius:50%;background:var(--green-light);border:1px solid var(--green-border);display:flex;align-items:center;justify-content:center;color:var(--green);font-family:'Bebas Neue',sans-serif;font-size:20px;">
                {{ strtoupper(substr($order->user->name, 0, 1)) }}
            </div>
            <div>
                <div style="font-weight:600;color:#fff;">{{ $order->user->name }}</div>
                <div style="font-size:13px;color:rgba(255,255,255,0.4);">{{ $order->user->email }}</div>
            </div>
        </div>
        <div style="font-size:13px;color:rgba(255,255,255,0.4);">Ordered {{ $order->created_at->format('d M Y, H:i') }}</div>
    </div>

    <div class="form-card">
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:18px;text-transform:uppercase;color:#fff;margin-bottom:16px;letter-spacing:1px;">Update Status</h3>
        <form method="POST" action="{{ route('admin.orders.status', $order) }}">
            @csrf @method('PATCH')
            <div class="form-group" style="margin-bottom:14px;">
                <select name="status" class="form-control">
                    @foreach(['pending','confirmed','shipped','delivered','cancelled'] as $s)
                    <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-green" style="width:100%;justify-content:center;">
                <i class="fa fa-save"></i> Save Status
            </button>
        </form>
    </div>
</div>
@endsection
