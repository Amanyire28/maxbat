@extends('admin.layout')
@section('title','Products')
@section('content')

<div class="table-card">
    <div class="table-card-header">
        <span class="table-card-title">All Products</span>
        <a href="{{ route('admin.products.create') }}" class="btn btn-green btn-sm"><i class="fa fa-plus"></i> Add Product</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Badge</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" style="width:54px;height:40px;object-fit:cover;border-radius:6px;">
                        @else
                            <div style="width:54px;height:40px;border-radius:6px;background:#2a2a2a;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.3);font-size:18px;"><i class="fa fa-image"></i></div>
                        @endif
                    </td>
                    <td style="font-weight:600;color:#fff;">{{ $product->name }}</td>
                    <td style="color:var(--green);">{{ $product->category }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->badge ?? '—' }}</td>
                    <td>
                        <span class="badge {{ $product->active ? 'badge-completed' : 'badge-cancelled' }}">
                            {{ $product->active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td style="display:flex;gap:6px;">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-ghost btn-sm"><i class="fa fa-edit"></i></a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">No products yet. <a href="{{ route('admin.products.create') }}" style="color:var(--green);">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $products->links() }}</div>
</div>
@endsection
