@extends('layouts.app')
@section('title', 'Careers — Join MaxBat')
@section('meta_desc', 'Join the MaxBat team. Discover current job opportunities for ECU tuning specialists, mechanics, and automotive engineers.')

@section('content')
<style>
    .careers-hero {
        padding: 80px 0 50px;
        background: linear-gradient(rgba(10,10,10,0.85), rgba(15,15,15,1)), url('{{ asset('storage/maxbat.jpg') }}') center/cover no-repeat;
        text-align: center;
        border-bottom: 1px solid var(--border);
    }
    .careers-hero h1 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 56px;
        letter-spacing: 2px;
        color: #fff;
        margin-bottom: 12px;
        text-transform: uppercase;
    }
    .careers-hero p {
        font-size: 16px;
        color: var(--muted);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }
    .careers-section {
        padding: 60px 0 90px;
        background: #0f0f0f;
    }
    .job-card {
        background: #161616;
        border: 1px solid var(--border);
        border-radius: 12px;
        margin-bottom: 20px;
        padding: 30px;
        transition: all 0.3s;
    }
    .job-card:hover {
        border-color: var(--green-border);
        box-shadow: 0 12px 32px rgba(0,0,0,0.4);
    }
    .job-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 18px;
    }
    .job-title-group h3 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 26px;
        letter-spacing: 1px;
        color: #fff;
        text-transform: uppercase;
        margin-bottom: 6px;
    }
    .job-meta {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
        font-size: 13px;
        color: var(--muted);
    }
    .job-meta span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .job-meta span i {
        color: var(--green);
    }
    .job-type-badge {
        background: var(--green-light);
        color: var(--green);
        border: 1px solid var(--green-border);
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 100px;
        letter-spacing: 1px;
    }
    .job-body {
        margin-bottom: 24px;
        border-top: 1px solid rgba(255,255,255,0.05);
        padding-top: 18px;
    }
    .job-desc {
        color: rgba(255,255,255,0.7);
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 20px;
    }
    .job-reqs h4 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 18px;
        letter-spacing: 1px;
        color: #fff;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .job-reqs ul {
        list-style: none;
        padding: 0;
    }
    .job-reqs li {
        position: relative;
        padding-left: 20px;
        font-size: 14px;
        color: rgba(255,255,255,0.6);
        margin-bottom: 8px;
        line-height: 1.6;
    }
    .job-reqs li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: var(--green);
        font-weight: bold;
    }
    .job-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 24px;
    }
    .btn-apply {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: var(--green);
        color: #000;
        font-family: 'Barlow', sans-serif;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-apply:hover {
        background: #68e000;
    }
    .btn-apply-whatsapp {
        background: transparent;
        border: 1px solid rgba(37,211,102,0.3);
        color: #25D366;
    }
    .btn-apply-whatsapp:hover {
        background: rgba(37,211,102,0.1);
    }
</style>

<section class="careers-hero" aria-labelledby="careers-title">
    <div class="container">
        <h1 id="careers-title">Join MaxBat</h1>
        <p>We are engineered for performance. If you have the passion, skill, and drive to deliver precision automotive solutions, check out our current openings below.</p>
    </div>
</section>

<section class="careers-section" aria-label="Available Positions">
    <div class="container" style="max-width: 900px;">
        @forelse($careers as $career)
        <article class="job-card reveal">
            <div class="job-header">
                <div class="job-title-group">
                    <h3>{{ $career->title }}</h3>
                    <div class="job-meta">
                        <span><i class="fa fa-map-marker-alt"></i> {{ $career->location }}</span>
                        @if($career->salary)
                            <span><i class="fa fa-money-bill-wave"></i> {{ $career->salary }}</span>
                        @endif
                    </div>
                </div>
                <span class="job-type-badge">{{ $career->type }}</span>
            </div>
            
            <div class="job-body">
                <div class="job-desc">
                    {!! nl2br(e($career->description)) !!}
                </div>
                <div class="job-reqs">
                    <h4>Requirements & Experience</h4>
                    <ul>
                        @foreach(explode("\n", $career->requirements) as $req)
                            @if(trim($req))
                                <li>{{ trim($req) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                
                <div class="job-actions">
                    <a href="mailto:info@maxbat.rs?subject=Application for {{ rawurlencode($career->title) }}" class="btn-apply">
                        <i class="fa fa-envelope"></i> Apply via Email
                    </a>
                    <a href="https://wa.me/256701244403?text={{ rawurlencode('Hello MaxBat, I would like to apply for the position of ') }}{{ rawurlencode($career->title) }}{{ rawurlencode('. Please find attached my details and CV.') }}" 
                       target="_blank" rel="noopener noreferrer" class="btn-apply btn-apply-whatsapp">
                        <i class="fab fa-whatsapp"></i> Quick Apply WhatsApp
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div style="text-align: center; padding: 60px 20px; border: 1px dashed rgba(255,255,255,0.1); border-radius: 14px; background: #161616;">
            <i class="fa fa-briefcase" style="font-size: 48px; color: var(--green); opacity: 0.3; margin-bottom: 16px; display: block;"></i>
            <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 24px; color: #fff; text-transform: uppercase;">No Open Positions Right Now</h3>
            <p style="color: var(--muted); font-size: 14px; margin-top: 6px; max-width: 420px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                We are always interested in meeting talented tuners, engineers, and specialists. Send your CV to <a href="mailto:info@maxbat.rs" style="color: var(--green); text-decoration: underline;">info@maxbat.rs</a> and we will keep you in mind for future opportunities.
            </p>
        </div>
        @endforelse
    </div>
</section>
@endsection
