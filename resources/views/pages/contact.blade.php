@extends('layouts.app')
@section('title', 'Contact — MaxBat Automobil')
@section('meta_desc', 'Get in touch with MaxBat Automobil. Request a quote, book a consultation or ask about our services.')

@push('styles')
<style>
    .contact-grid { display: grid; grid-template-columns: 1fr; gap: 48px; margin-top: 48px; }
    @media(min-width:1024px){ .contact-grid { grid-template-columns: 1fr 1.5fr; } }
    .contact-info h3 { font-family: 'Bebas Neue', sans-serif; font-size: 30px; font-weight: 400; text-transform: uppercase; color: #fff; margin-bottom: 20px; }
    .contact-details { display: flex; flex-direction: column; gap: 16px; margin-bottom: 32px; }
    .contact-item { display: flex; align-items: flex-start; gap: 12px; }
    .contact-item-icon { width: 40px; height: 40px; border-radius: 8px; background: var(--green-light); border: 1px solid var(--green-border); display: flex; align-items: center; justify-content: center; color: var(--green); font-size: 16px; flex-shrink: 0; }
    .contact-item-text .label { font-size: 11px; color: var(--card-subtext); text-transform: uppercase; letter-spacing: 1px; }
    .contact-item-text .val { font-size: 15px; color: #fff; margin-top: 2px; }
    .contact-form { display: flex; flex-direction: column; gap: 14px; }
    .form-row { display: grid; grid-template-columns: 1fr; gap: 14px; }
    @media(min-width:768px){ .form-row { grid-template-columns: 1fr 1fr; } }
    .form-group { display: flex; flex-direction: column; gap: 6px; }
    .form-group label { font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--card-subtext); }
    .form-input, .form-select, .form-textarea { background: #252525; border: 1px solid rgba(255,255,255,0.10); color: #fff; padding: 14px 16px; border-radius: 6px; font-family: 'Barlow', sans-serif; font-size: 15px; transition: border-color 0.3s; width: 100%; }
    .form-input::placeholder, .form-textarea::placeholder { color: rgba(255,255,255,0.25); }
    .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: var(--green); box-shadow: 0 0 0 3px var(--green-light); }
    .form-select { appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235BC800' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E"); background-color: #252525; background-repeat: no-repeat; background-position: right 12px center; }
    .form-select option { background: #252525; color: #fff; }
    .form-textarea { resize: vertical; min-height: 120px; }
    .whatsapp-btn { display: inline-flex; align-items: center; gap: 10px; padding: 14px 24px; border-radius: 6px; background: #25D366; color: #fff; font-family: 'Barlow', sans-serif; font-size: 15px; font-weight: 700; text-transform: uppercase; transition: all 0.3s; margin-top: 16px; }
    .whatsapp-btn:hover { background: #22c55e; transform: translateY(-2px); }
    .map-placeholder { margin-top: 60px; border-radius: 14px; overflow: hidden; aspect-ratio: 21/9; background: var(--card-bg); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; }
    .map-placeholder i { font-size: 48px; color: var(--green); }
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="page-hero-breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fa fa-chevron-right"></i>Contact</div>
    <h1>Get In <span>Touch</span></h1>
    <p>Ready to unlock your vehicle's true potential? Fill in the form or reach us directly via WhatsApp.</p>
</div>

<section class="section-pad" style="background:var(--section-dark);">
    <div class="container">
        <div class="contact-grid">
            <div class="reveal-left">
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <div class="contact-details">
                        <div class="contact-item"><div class="contact-item-icon"><i class="fa fa-map-marker-alt"></i></div><div class="contact-item-text"><div class="label">Address</div><div class="val">Industrijska bb, Belgrade, Serbia</div></div></div>
                        <div class="contact-item"><div class="contact-item-icon"><i class="fa fa-phone"></i></div><div class="contact-item-text"><div class="label">Phone 1</div><div class="val"><a href="tel:+256703560021" style="color:#fff;">+256 703 560 021</a></div></div></div>
                        <div class="contact-item"><div class="contact-item-icon"><i class="fa fa-phone"></i></div><div class="contact-item-text"><div class="label">Phone 2</div><div class="val"><a href="tel:+256784425788" style="color:#fff;">+256 784 425 788</a></div></div></div>
                        <div class="contact-item"><div class="contact-item-icon"><i class="fa fa-envelope"></i></div><div class="contact-item-text"><div class="label">Email</div><div class="val"><a href="mailto:info@maxbat.rs" style="color:#fff;">info@maxbat.rs</a></div></div></div>
                        <div class="contact-item"><div class="contact-item-icon"><i class="fa fa-clock"></i></div><div class="contact-item-text"><div class="label">Working Hours</div><div class="val">Mon–Fri: 08:00–18:00 · Sat: 09:00–14:00</div></div></div>
                    </div>
                    <a href="https://wa.me/256701244403?text=Hello%20MaxBat%2C%20I%20would%20like%20to%20book%20a%20consultation." class="whatsapp-btn" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                    </a>
                    <a href="https://t.me/256701244403" class="whatsapp-btn" style="background:#229ED9;margin-top:10px;" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-telegram-plane"></i> Message on Telegram
                    </a>
                </div>
            </div>
            <div class="reveal-right">
                @if(session('success'))
                    <div style="padding:20px 24px;border-radius:12px;background:rgba(91,200,0,0.10);border:1px solid rgba(91,200,0,0.30);color:#5BC800;font-weight:700;font-size:16px;margin-bottom:20px;">
                        <i class="fa fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif
                <form class="contact-form" method="POST" action="{{ route('contact.submit') }}" aria-label="Booking form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group"><label for="name">Full Name *</label><input class="form-input" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your full name" required></div>
                        <div class="form-group"><label for="phone">Phone *</label><input class="form-input" type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+256 XXX XXX XXX" required></div>
                    </div>
                    <div class="form-group"><label for="email">Email</label><input class="form-input" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="your@email.com"></div>
                    <div class="form-row">
                        <div class="form-group"><label for="make">Vehicle Make *</label>
                            <select class="form-select" id="make" name="vehicleMake" required><option value="" disabled selected>Select Make</option><option>BMW</option><option>Mercedes-Benz</option><option>Audi</option><option>Volkswagen</option><option>Porsche</option><option>Nissan</option><option>Toyota</option><option>Other</option></select>
                        </div>
                        <div class="form-group"><label for="model">Vehicle Model *</label><input class="form-input" type="text" id="model" name="vehicleModel" value="{{ old('vehicleModel') }}" placeholder="e.g. M3, C63, RS4" required></div>
                    </div>
                    <div class="form-group"><label for="service">Service Required *</label>
                        <select class="form-select" id="service" required><option value="" disabled selected>Select Service</option><option>Key Programming</option><option>ECU Programming</option><option>Gearbox / TCU Programming</option><option>ECU Tuning</option><option>Vehicle Diagnostics</option><option>Performance Upgrade</option><option>Turbo System</option><option>Exhaust System</option><option>Automotive Electronics</option><option>Maintenance Service</option><option>Fleet Solutions</option><option>General Inquiry</option></select>
                    </div>
                    <div class="form-group"><label for="message">Additional Details</label><textarea class="form-textarea" id="message" name="message" placeholder="Tell us about your vehicle and what you're looking to achieve...">{{ old('message') }}</textarea></div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;"><i class="fa fa-paper-plane"></i> Send Request</button>
                </form>
                <div id="formSuccess" style="display:none;" role="alert"></div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@endpush

