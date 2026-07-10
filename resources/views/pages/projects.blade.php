@extends('layouts.app')
@section('title', 'Projects — MaxBat Automobil')
@section('meta_desc', 'View our completed performance builds, ECU tunes, turbo upgrades and exhaust installations.')

@push('styles')
<style>
    .showcase-filter { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 40px; margin-bottom: 32px; }
    .filter-btn { padding: 9px 22px; border-radius: 5px; font-family: 'Barlow', sans-serif; font-size: 14px; font-weight: 700; text-transform: uppercase; background: rgba(255,255,255,0.06); border: 1px solid var(--border); color: rgba(255,255,255,0.6); transition: all 0.25s; cursor: pointer; }
    .filter-btn.active, .filter-btn:hover { background: var(--green); color: #000; border-color: var(--green); }
    .showcase-grid { display: grid; grid-template-columns: 1fr; gap: 16px; }
    @media(min-width:640px){ .showcase-grid { grid-template-columns: repeat(2,1fr); } .showcase-item.large { grid-column: span 2; aspect-ratio: 16/7; } }
    @media(min-width:1024px){ .showcase-grid { grid-template-columns: repeat(3,1fr); } .showcase-item.large { grid-column: span 2; } }
    .showcase-item { position: relative; border-radius: 10px; overflow: hidden; aspect-ratio: 4/3; cursor: pointer; }
    .showcase-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .showcase-item:hover img { transform: scale(1.08); }
    .showcase-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 60%); opacity: 0; transition: opacity 0.3s; display: flex; align-items: flex-end; padding: 20px; }
    .showcase-item:hover .showcase-overlay { opacity: 1; }
    .showcase-info h4 { font-family: 'Bebas Neue', sans-serif; font-size: 20px; font-weight: 400; text-transform: uppercase; color: #fff; }
    .showcase-info span { font-size: 13px; color: var(--green); font-weight: 500; }
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="page-hero-breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fa fa-chevron-right"></i>Projects</div>
    <h1>Project <span>Showcase</span></h1>
    <p>Completed installations and upgrades — real cars, real results, real engineering.</p>
</div>

<section class="section-pad" style="background:var(--section-alt);">
    <div class="container">
        <div class="showcase-filter" role="group" aria-label="Filter projects">
            <button class="filter-btn active" data-filter="all" aria-pressed="true">All Projects</button>
            <button class="filter-btn" data-filter="ecu" aria-pressed="false">ECU Tuning</button>
            <button class="filter-btn" data-filter="turbo" aria-pressed="false">Turbo Builds</button>
            <button class="filter-btn" data-filter="exhaust" aria-pressed="false">Exhaust</button>
            <button class="filter-btn" data-filter="performance" aria-pressed="false">Full Builds</button>
        </div>
        <div class="showcase-grid">
            @foreach([
                ['https://images.unsplash.com/photo-1542362567-b07e54358753?w=1200&q=80','BMW M4 Competition Build','Stage 3 Full Build · 580hp','performance','large'],
                ['https://images.unsplash.com/photo-1626248801379-51a0748a5f96?w=800&q=80','AMG C63 S ECU Tune','Stage 2 Map · +85hp','ecu',''],
                ['https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?w=800&q=80','Audi RS3 Akrapovič','Exhaust Install','exhaust',''],
                ['https://images.unsplash.com/photo-1597007066704-67bf2068d5b2?w=800&q=80','VW Golf R Turbo Build','Hybrid Turbo · +140hp','turbo',''],
                ['https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80','Porsche 911 GT Package','Full Performance Build','performance',''],
            ] as $item)
            <div class="showcase-item {{ $item[4] }} reveal" data-category="{{ $item[2] }}">
                <img src="{{ $item[0] }}" alt="{{ $item[1] }}" loading="lazy">
                <div class="showcase-overlay">
                    <div class="showcase-info"><h4>{{ $item[1] }}</h4><span>{{ $item[3] }}</span></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => { b.classList.remove('active'); b.setAttribute('aria-pressed','false'); });
        btn.classList.add('active'); btn.setAttribute('aria-pressed','true');
        const filter = btn.dataset.filter;
        document.querySelectorAll('.showcase-item[data-category]').forEach(item => {
            item.style.display = (filter === 'all' || item.dataset.category === filter) ? '' : 'none';
        });
    });
});
</script>
@endpush

