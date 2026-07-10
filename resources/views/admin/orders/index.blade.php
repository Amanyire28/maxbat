@extends('admin.layout')
@section('title','Orders')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Bebas Neue',sans-serif;font-size:26px;color:#fff;text-transform:uppercase;letter-spacing:1px;">Orders</h2>
        <p style="color:rgba(255,255,255,0.4);font-size:13px;margin-top:4px;">Customer product orders</p>
    </div>
    <div class="search-bar">
        <form method="GET">
            <select name="status" class="form-control" style="width:160px;" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                @foreach(['pending','confirmed','shipped','delivered','cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Customer</th><th>Items</th><th>Total</th><th>Status</th><th>Date</th><th></th></tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
            <tr>
                <td style="color:rgba(255,255,255,0.35);">#{{ $order->id }}</td>
                <td>
                    <div style="font-weight:600;color:#fff;">{{ $order->user->name }}</div>
                    <div style="font-size:12px;color:rgba(255,255,255,0.4);">{{ $order->user->email }}</div>
                </td>
                <td style="color:rgba(255,255,255,0.65);">{{ count($order->items) }} item{{ count($order->items) > 1 ? 's' : '' }}</td>
                <td style="color:var(--green);font-weight:700;font-family:'Bebas Neue',sans-serif;font-size:18px;">
                    ${{ number_format($order->total, 2) }}
                </td>
                <td>
                    @php
                        $badge = match($order->status) {
                            'pending'   => 'badge-new',
                            'confirmed' => 'badge-progress',
                            'shipped'   => 'badge-progress',
                            'delivered' => 'badge-completed',
                            'cancelled' => 'badge-cancelled',
                            default     => 'badge-new',
                        };
                    @endphp
                    <span class="badge {{ $badge }}">{{ ucfirst($order->status) }}</span>
                </td>
                <td style="color:rgba(255,255,255,0.4);font-size:13px;">{{ $order->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-ghost btn-sm"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;color:rgba(255,255,255,0.3);padding:48px;">
                <i class="fa fa-shopping-cart" style="font-size:36px;display:block;margin-bottom:12px;opacity:0.3;"></i>
                No orders yet.
            </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="pagination-wrap">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
