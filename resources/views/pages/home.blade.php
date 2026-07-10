@extends('layouts.app')
@section('title', 'MaxBat Automobil — Engineered For Performance')
@section('meta_desc', 'Premium ECU tuning, performance upgrades, diagnostics, exhaust systems and automotive electronics.')

@push('styles')
<style>
    .hero { position: relative; min-height: 100svh; display: flex; align-items: center; overflow: hidden; }
    .hero-bg { position: absolute; inset: 0; z-index: 0; }
    .hero-bg video { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; }
    .hero-content { position: relative; z-index: 1; padding: 140px 0 100px; width: 100%; }
    .hero-inner { display: flex; align-items: flex-start; justify-content: space-between; gap: 48px; width: 100%; }
    .hero-left { flex: 1; min-width: 0; }
    .hero-right { display: none; flex-direction: column; gap: 14px; flex-shrink: 0; margin-top: 58px; }
    @media(min-width:1024px){ .hero-right { display: flex; } }
    .hero-badge {
        display: none; align-items: center; gap: 8px;
        background: rgba(91,200,0,0.10); border: 1px solid rgba(91,200,0,0.30);
        border-radius: 100px; padding: 6px 16px; margin-bottom: 24px;
        font-size: 12px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--green);
    }
    @media(min-width:1024px){ .hero-badge { display: inline-flex; } }
    .hero-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--green); animation: blink 1.5s infinite; display: inline-block; }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }
    .hero-title {
        font-family: 'Bebas Neue', sans-serif; font-size: clamp(52px, 13vw, 116px);
        font-weight: 400; text-transform: uppercase; line-height: 0.95; letter-spacing: -1px; margin-bottom: 24px;
    }
    .hero-title .accent { color: var(--green); display: block; }
    .hero-subtitle { font-size: clamp(16px,2vw,19px); color: rgba(255,255,255,0.82); max-width: 560px; line-height: 1.75; margin-bottom: 40px; font-weight: 300; }
    .hero-ctas { display: flex; flex-wrap: wrap; gap: 14px; }
    /* Mobile: center all hero text and buttons */
    @media(max-width:1023px){
        .hero-left { text-align: center; }
        .hero-title { letter-spacing: 0; }
        .hero-subtitle { margin-left: auto; margin-right: auto; }
        .hero-ctas { justify-content: center; }
    }
    .hero-trust-card {
        display: flex; align-items: center; gap: 16px;
        background: rgba(0,0,0,0.45); border: 1px solid rgba(255,255,255,0.10); border-left: 3px solid var(--green);
        border-radius: 8px; padding: 16px 22px; backdrop-filter: blur(12px); transition: background 0.3s, border-color 0.3s; min-width: 270px;
    }
    .hero-trust-card:hover { background: rgba(91,200,0,0.12); border-color: rgba(91,200,0,0.35); }
    .hero-trust-card i { font-size: 22px; color: var(--green); flex-shrink: 0; width: 28px; text-align: center; }
    .hero-trust-card-text .title { font-family: 'Barlow', sans-serif; font-size: 15px; font-weight: 700; color: #fff; line-height: 1.2; }
    .hero-trust-card-text .sub { font-size: 12px; color: rgba(255,255,255,0.50); margin-top: 3px; }
    .hero-scroll {
        position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%);
        display: flex; flex-direction: column; align-items: center; gap: 8px;
        font-size: 11px; letter-spacing: 2px; text-transform: uppercase; color: #888; z-index: 2;
        animation: scrollBounce 2s ease infinite;
    }
    .hero-scroll span { width: 1px; height: 40px; background: linear-gradient(to bottom, var(--green), transparent); }
    @keyframes scrollBounce { 0%,100%{transform:translateX(-50%) translateY(0)} 50%{transform:translateX(-50%) translateY(8px)} }
    /* Services preview */
    .services-grid { display: grid; grid-template-columns: 1fr; gap: 16px; margin-top: 48px; }
    @media(min-width:640px){ .services-grid { grid-template-columns: repeat(2,1fr); } }
    @media(min-width:1024px){ .services-grid { grid-template-columns: repeat(4,1fr); } }
    .service-card {
        position: relative; overflow: hidden; padding: 36px 32px; border-radius: 14px;
        background: var(--card-bg); border: 1px solid var(--border); transition: all 0.35s ease; cursor: pointer;
    }
    .service-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: var(--green); transform: scaleX(0); transform-origin: left; transition: transform 0.35s ease;
    }
    .service-card:hover::before { transform: scaleX(1); }
    .service-card:hover { border-color: var(--green-border); box-shadow: 0 12px 44px rgba(0,0,0,0.5); transform: translateY(-3px); }
    .service-icon { width: 54px; height: 54px; border-radius: 10px; background: var(--green-light); border: 1px solid var(--green-border); display: flex; align-items: center; justify-content: center; font-size: 22px; color: var(--green); margin-bottom: 22px; transition: all 0.3s; }
    .service-card:hover .service-icon { background: var(--green); color: #000; }
    .service-card h3 { font-family: 'Bebas Neue', sans-serif; font-size: 22px; font-weight: 400; text-transform: uppercase; margin-bottom: 10px; color: #fff; }
    .service-card p { color: var(--card-subtext); font-size: 15px; line-height: 1.65; margin-bottom: 22px; }
    .service-link { display: inline-flex; align-items: center; gap: 7px; font-family: 'Barlow', sans-serif; font-size: 13px; font-weight: 700; text-transform: uppercase; color: var(--green); transition: gap 0.25s; }
    .service-card:hover .service-link { gap: 11px; }
    .service-number { position: absolute; top: 20px; right: 22px; font-family: 'Bebas Neue', sans-serif; font-size: 60px; color: rgba(255,255,255,0.04); line-height: 1; pointer-events: none; }
    /* Why cards */
    .why-grid { display: grid; grid-template-columns: 1fr; gap: 24px; margin-top: 48px; }
    @media(min-width:640px){ .why-grid { grid-template-columns: repeat(2,1fr); } }
    @media(min-width:1024px){ .why-grid { grid-template-columns: repeat(4,1fr); } }
    .why-card { padding: 40px 32px; border-radius: 14px; text-align: center; background: var(--card-bg); border: 1px solid var(--border); transition: border-color 0.3s, transform 0.3s, box-shadow 0.3s; }
    .why-card:hover { border-color: var(--green-border); transform: translateY(-3px); box-shadow: 0 12px 44px rgba(0,0,0,0.5); }
    .why-icon { width: 68px; height: 68px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 26px; }
    .why-icon.green { background: var(--green-light); color: var(--green); border: 1px solid var(--green-border); }
    .why-icon.red { background: rgba(225,6,0,0.12); color: var(--red,#E10600); border: 1px solid rgba(225,6,0,0.25); }
    .why-card h3 { font-family: 'Bebas Neue', sans-serif; font-size: 24px; font-weight: 400; text-transform: uppercase; margin-bottom: 10px; color: #fff; }
    .why-card p { color: var(--card-subtext); font-size: 15px; line-height: 1.65; }
    .counter-val { font-family: 'Bebas Neue', sans-serif; font-size: 52px; font-weight: 400; color: var(--green); display: block; margin-top: 18px; line-height: 1; }
    /* Finder */
    .finder-section { background: var(--section-dark); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
    .finder-inner { display: flex; flex-direction: column; gap: 24px; padding: 48px 0; }
    .finder-header h2 { font-family: 'Bebas Neue', sans-serif; font-size: 30px; font-weight: 400; text-transform: uppercase; color: #fff; }
    .finder-header p { color: var(--card-subtext); font-size: 15px; margin-top: 8px; }
    .finder-form { display: grid; grid-template-columns: 1fr; gap: 12px; }
    .finder-select { appearance: none; -webkit-appearance: none; background: #252525; border: 1px solid rgba(255,255,255,0.12); color: #fff; padding: 14px 40px 14px 16px; border-radius: 6px; font-family: 'Barlow', sans-serif; font-size: 15px; width: 100%; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235BC800' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; transition: border-color 0.3s; }
    .finder-select:focus { outline: none; border-color: var(--green); }
    .finder-select option { background: #252525; color: #fff; }
    @media(min-width:768px){ .finder-inner { flex-direction: row; align-items: flex-end; gap: 40px; } .finder-header { flex-shrink: 0; max-width: 260px; } .finder-form { flex: 1; grid-template-columns: repeat(4,1fr); } }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="hero" id="hero" aria-label="Hero">
    <div class="hero-bg" aria-hidden="true">
        <video autoplay muted loop playsinline preload="auto">
            <source src="{{ asset('storage/max bat 2.mp4') }}" type="video/mp4">
        </video>
    </div>
    <div class="container hero-content">
        <div class="hero-inner">
            <div class="hero-left">
                <div class="hero-badge">
                    <span style="width:6px;height:6px;border-radius:50%;background:var(--green);display:inline-block;"></span>
                    Certified Performance Workshop
                </div>
                <h1 class="hero-title reveal">
                    <span style="color:#7CFC00;">MaxBat<br>Automobil</span>
                    <span class="accent">Engineered<br>For Performance</span>
                </h1>
                <p class="hero-subtitle reveal" style="transition-delay:0.15s;">
                    Premium ECU tuning, diagnostics, performance upgrades, turbo systems, exhaust solutions and automotive electronics — built for enthusiasts and professionals who demand more.
                </p>
                <div class="hero-ctas reveal" style="transition-delay:0.25s;">
                    <a href="{{ route('products') }}" class="btn btn-outline-light">
                        <i class="fa fa-arrow-right"></i> Explore Products
                    </a>
                    <a href="{{ route('services') }}" class="btn btn-primary">
                        <i class="fa fa-tools"></i> Our Services
                    </a>
                </div>
            </div>
            <div class="hero-right reveal" style="transition-delay:0.3s;" role="list" aria-label="Trust indicators">
                <div class="hero-trust-card" role="listitem">
                    <i class="fa fa-user-shield"></i>
                    <div class="hero-trust-card-text"><div class="title">Certified Technicians</div><div class="sub">BOSCH &amp; Alientech certified</div></div>
                </div>
                <div class="hero-trust-card" role="listitem">
                    <i class="fa fa-gem"></i>
                    <div class="hero-trust-card-text"><div class="title">Premium Components</div><div class="sub">OEM-grade &amp; motorsport spec</div></div>
                </div>
                <div class="hero-trust-card" role="listitem">
                    <i class="fa fa-stethoscope"></i>
                    <div class="hero-trust-card-text"><div class="title">Vehicle Diagnostics</div><div class="sub">Full OBD-II live data analysis</div></div>
                </div>
                <div class="hero-trust-card" role="listitem">
                    <i class="fa fa-bolt"></i>
                    <div class="hero-trust-card-text"><div class="title">Performance Upgrades</div><div class="sub">Dyno-verified power gains</div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-scroll" aria-hidden="true">Scroll<span></span></div>
</section>

{{-- VEHICLE FINDER --}}
<section class="finder-section" id="finder" aria-label="Vehicle compatibility finder">
    <div class="container">
        <div class="finder-inner">
            <div class="finder-header">
                <h2>Find Your<br><span style="color:var(--green)">Compatible Parts</span></h2>
                <p>Select your vehicle to see compatible products and services instantly.</p>
            </div>
            <form class="finder-form" onsubmit="return false;" role="search" aria-label="Vehicle search">
                <select class="finder-select" aria-label="Vehicle Make" id="vehicleMake"><option value="" disabled selected>Vehicle Make</option><option>BMW</option><option>Mercedes-Benz</option><option>Audi</option><option>Volkswagen</option><option>Porsche</option><option>Nissan</option><option>Toyota</option><option>Subaru</option><option>Ford</option></select>
                <select class="finder-select" aria-label="Vehicle Model" id="vehicleModel"><option value="" disabled selected>Vehicle Model</option></select>
                <select class="finder-select" aria-label="Vehicle Year"><option value="" disabled selected>Year</option><option>2024</option><option>2023</option><option>2022</option><option>2021</option><option>2020</option><option>2019</option><option>2018</option><option>2017</option><option>2016</option></select>
                <select class="finder-select" aria-label="Engine Type"><option value="" disabled selected>Engine</option><option>2.0T TSI / TFSI</option><option>3.0T Inline-6</option><option>4.0T V8</option><option>5.0L V10</option><option>2.5L Boxer</option><option>3.8TT V6</option></select>
                <a href="{{ route('products') }}" class="btn btn-primary" style="height:50px;white-space:nowrap;">
                    <i class="fa fa-search"></i> Find Products
                </a>
            </form>
        </div>
    </div>
</section>

{{-- SERVICES PREVIEW --}}
<section class="section-pad" id="services" style="
    position:relative;overflow:hidden;
    background: url('{{ asset('storage/maxbat.jpg') }}') center/cover no-repeat;
">
    <div class="container" style="position:relative;z-index:1;">
        <div class="reveal" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;">
            <div>
                <div class="section-label">What We Do</div>
                <h2 class="section-title dark">Our <span>Services</span></h2>
            </div>
            <a href="{{ route('services') }}" class="btn btn-outline">All Services <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="services-grid">
            @forelse($services as $index => $s)
            <article class="service-card reveal" style="transition-delay:{{ $index * 0.05 }}s;">
                <div class="service-number">{{ str_pad($s->sort_order, 2, '0', STR_PAD_LEFT) }}</div>
                <div class="service-icon"><i class="fa {{ $s->icon }}"></i></div>
                <h3>{{ $s->name }}</h3>
                <p>{{ $s->description }}</p>
                <a href="{{ route('services') }}" class="service-link">Learn More <i class="fa fa-arrow-right"></i></a>
            </article>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:40px;color:rgba(255,255,255,0.3);">No services yet.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- WHY MAXBAT --}}
<section class="section-pad" style="background:var(--section-dark);">
    <div class="container">
        <div class="reveal" style="text-align:center;">
            <div class="section-label" style="justify-content:center;">Why Choose Us</div>
            <h2 class="section-title" style="text-align:center;">Why <span>MaxBat</span></h2>
        </div>
        <div class="why-grid">
            <div class="glass-card why-card reveal">
                <div class="why-icon green"><i class="fa fa-tachometer-alt"></i></div>
                <h3>Performance</h3>
                <p>Every build is validated on our dynamometer for guaranteed power gains, every single time.</p>
                <span class="counter-val" data-target="850">0</span>
                <small style="color:rgba(255,255,255,0.4);font-size:12px;text-transform:uppercase;letter-spacing:1px;">Vehicles Tuned</small>
            </div>
            <div class="glass-card why-card reveal" style="transition-delay:0.1s">
                <div class="why-icon red"><i class="fa fa-shield-alt"></i></div>
                <h3>Reliability</h3>
                <p>OEM-grade and motorsport-spec components with full warranty on all work performed.</p>
                <span class="counter-val" data-target="99">0</span>
                <small style="color:rgba(255,255,255,0.4);font-size:12px;text-transform:uppercase;letter-spacing:1px;">% Satisfaction Rate</small>
            </div>
            <div class="glass-card why-card reveal" style="transition-delay:0.2s">
                <div class="why-icon green"><i class="fa fa-graduation-cap"></i></div>
                <h3>Expertise</h3>
                <p>Technicians hold certifications from BOSCH, Alientech, and major European programs.</p>
                <span class="counter-val" data-target="15">0</span>
                <small style="color:rgba(255,255,255,0.4);font-size:12px;text-transform:uppercase;letter-spacing:1px;">Years Experience</small>
            </div>
            <div class="glass-card why-card reveal" style="transition-delay:0.3s">
                <div class="why-icon red"><i class="fa fa-flask"></i></div>
                <h3>Innovation</h3>
                <p>Continuously investing in cutting-edge diagnostic tools, tuning software and R&amp;D facilities.</p>
                <span class="counter-val" data-target="120">0</span>
                <small style="color:rgba(255,255,255,0.4);font-size:12px;text-transform:uppercase;letter-spacing:1px;">Brands Supported</small>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Counter animation
const counterObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !entry.target.dataset.counted) {
            entry.target.dataset.counted = 'true';
            const target = parseInt(entry.target.dataset.target);
            let start = 0;
            const inc = target / (2000 / 16);
            const timer = setInterval(() => {
                start += inc;
                if (start >= target) { start = target; clearInterval(timer); }
                entry.target.textContent = Math.floor(start);
            }, 16);
        }
    });
}, { threshold: 0.5 });
document.querySelectorAll('.counter-val[data-target]').forEach(el => counterObserver.observe(el));

// Vehicle finder dynamic models
const modelsByMake = {
    'BMW':['M2/M3/M4','M5/M8','335i/340i','440i','X5M/X6M'],
    'Mercedes-Benz':['AMG C63','AMG E63','AMG GT','CLA 45','A45 AMG'],
    'Audi':['RS3','RS4/RS5','RS6/RS7','R8','S3/S4'],
    'Volkswagen':['Golf R','Golf GTI','Passat TSI','Tiguan','Arteon R'],
    'Porsche':['911 Turbo','911 GT3','Cayenne GTS','Macan Turbo','Panamera'],
    'Nissan':['GT-R R35','370Z','Skyline R34'],
    'Toyota':['Supra A90','GR Yaris','GR86'],
    'Subaru':['WRX STI','Impreza STI','Forester XT'],
    'Ford':['Focus RS','Fiesta ST','Mustang GT500'],
};
const makeEl = document.getElementById('vehicleMake');
const modelEl = document.getElementById('vehicleModel');
if (makeEl && modelEl) {
    makeEl.addEventListener('change', function() {
        const models = modelsByMake[this.value] || [];
        modelEl.innerHTML = '<option value="" disabled selected>Vehicle Model</option>';
        models.forEach(m => { const o = document.createElement('option'); o.textContent = m; modelEl.appendChild(o); });
    });
}
</script>
@endpush

