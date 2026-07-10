@extends('admin.layout')
@section('title', 'Cars for Sale')
@section('content')

<div class="table-card">
    <div class="table-card-header">
        <span class="table-card-title">Second-Hand Cars For Sale</span>
        <a href="{{ route('admin.cars-for-sale.create') }}" class="btn btn-green btn-sm"><i class="fa fa-plus"></i> Add Car listing</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Vehicle</th>
                    <th>Price</th>
                    <th>Mileage</th>
                    <th>Specs</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cars as $car)
                <tr>
                    <td>
                        @if($car->image)
                            <img src="{{ asset('storage/'.$car->image) }}" style="width:72px;height:48px;object-fit:cover;border-radius:6px;border:1px solid rgba(255,255,255,0.1);">
                        @else
                            <div style="width:72px;height:48px;border-radius:6px;background:#2a2a2a;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.2);font-size:20px;"><i class="fa fa-car"></i></div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:600;color:#fff;">{{ $car->make }} {{ $car->model }}</div>
                        <div style="font-size:12px;color:var(--muted);">Year: {{ $car->year }}</div>
                    </td>
                    <td style="font-family:'Bebas Neue',sans-serif;font-size:18px;color:var(--green);">
                        UGX {{ number_format($car->price, 0) }}
                    </td>
                    <td>{{ number_format($car->mileage) }} km</td>
                    <td>
                        <span style="font-size:12px;color:#aaa;background:rgba(255,255,255,0.05);padding:2px 6px;border-radius:4px;display:inline-block;">{{ $car->transmission }}</span>
                        <span style="font-size:12px;color:#aaa;background:rgba(255,255,255,0.05);padding:2px 6px;border-radius:4px;display:inline-block;">{{ $car->fuel_type }}</span>
                    </td>
                    <td>
                        <span class="badge {{ $car->active ? 'badge-completed' : 'badge-cancelled' }}">
                            {{ $car->active ? 'Available' : 'Hidden' }}
                        </span>
                    </td>
                    <td style="display:flex;gap:6px;align-items:center;height:65px;">
                        <a href="{{ route('admin.cars-for-sale.edit', $car->id) }}" class="btn btn-ghost btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                        <form method="POST" action="{{ route('admin.cars-for-sale.destroy', $car->id) }}" onsubmit="return confirm('Delete this car listing?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:rgba(255,255,255,0.3);padding:32px;">
                        No cars listed for sale yet. <a href="{{ route('admin.cars-for-sale.create') }}" style="color:var(--green);">List one</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $cars->links() }}</div>
</div>
@endsection
