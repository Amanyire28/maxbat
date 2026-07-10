@extends('layouts.app')
@section('title', 'Videos — MaxBat Gallery')
@section('meta_desc', 'Watch MaxBat performance upgrades, dyno runs, ECU tuning demos, and automotive reviews in action.')

@section('content')
<style>
    .videos-hero {
        padding: 80px 0 50px;
        background: linear-gradient(rgba(10,10,10,0.85), rgba(15,15,15,1)), url('{{ asset('storage/maxbat.jpg') }}') center/cover no-repeat;
        text-align: center;
        border-bottom: 1px solid var(--border);
    }
    .videos-hero h1 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 56px;
        letter-spacing: 2px;
        color: #fff;
        margin-bottom: 12px;
        text-transform: uppercase;
    }
    .videos-hero p {
        font-size: 16px;
        color: var(--muted);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }
    .videos-section {
        padding: 60px 0 90px;
        background: #0f0f0f;
    }
    .videos-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }
    @media(min-width: 768px) {
        .videos-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media(min-width: 1024px) {
        .videos-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    .video-card {
        background: #161616;
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .video-card:hover {
        border-color: var(--green-border);
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.5);
    }
    .video-wrapper {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        background: #000;
    }
    .video-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        border: none;
    }
    .video-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .video-cat {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1.5px;
        color: var(--green);
        margin-bottom: 8px;
    }
    .video-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 20px;
        letter-spacing: 0.5px;
        color: #fff;
        text-transform: uppercase;
        margin-bottom: 10px;
        line-height: 1.2;
    }
    .video-desc {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
        margin-top: auto;
    }
    .category-filters {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }
    .filter-btn {
        background: #161616;
        border: 1px solid var(--border);
        color: var(--muted);
        padding: 8px 18px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .filter-btn:hover, .filter-btn.active {
        background: var(--green);
        color: #000;
        border-color: var(--green);
    }
</style>

<section class="videos-hero" aria-labelledby="videos-title">
    <div class="container">
        <h1 id="videos-title">MaxBat Video Gallery</h1>
        <p>Watch our engineering process, client vehicles, dyno tuning runs, and product guides in motion.</p>
    </div>
</section>

<section class="videos-section" aria-label="Videos Showcase">
    <div class="container">
        
        @php
            $categories = $videos->pluck('category')->filter()->unique();
        @endphp

        @if($categories->count() > 0)
        <div class="category-filters" role="tablist">
            <button class="filter-btn active" onclick="filterVideos('all')" role="tab" aria-selected="true">All Videos</button>
            @foreach($categories as $cat)
                <button class="filter-btn" onclick="filterVideos('{{ Str::slug($cat) }}')" role="tab" aria-selected="false">{{ $cat }}</button>
            @endforeach
        </div>
        @endif

        <div class="videos-grid">
            @forelse($videos as $video)
                @php
                    $embedUrl = $video->video_url;
                    // YouTube URL conversion
                    preg_match("/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/ ]{11})/", $video->video_url, $matches);
                    if (isset($matches[1])) {
                        $embedUrl = "https://www.youtube.com/embed/" . $matches[1];
                    } else {
                        // Vimeo URL conversion
                        preg_match("/vimeo\.com\/(?:video\/)?([0-9]+)/", $video->video_url, $matches);
                        if (isset($matches[1])) {
                            $embedUrl = "https://player.vimeo.com/video/" . $matches[1];
                        }
                    }
                @endphp
                <article class="video-card reveal {{ $video->category ? Str::slug($video->category) : '' }}">
                    <div class="video-wrapper">
                        <iframe src="{{ $embedUrl }}" 
                                title="{{ $video->title }}" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                        </iframe>
                    </div>
                    <div class="video-body">
                        <span class="video-cat">{{ $video->category ?? 'General' }}</span>
                        <h3 class="video-title">{{ $video->title }}</h3>
                        @if($video->description)
                            <p class="video-desc">{{ $video->description }}</p>
                        @endif
                    </div>
                </article>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; border: 1px dashed rgba(255,255,255,0.1); border-radius: 14px; background: #161616;">
                    <i class="fa fa-video" style="font-size: 48px; color: var(--green); opacity: 0.3; margin-bottom: 16px; display: block;"></i>
                    <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 24px; color: #fff; text-transform: uppercase;">No Videos Available</h3>
                    <p style="color: var(--muted); font-size: 14px; margin-top: 6px;">Check back later for tuning and dyno run updates.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<script>
function filterVideos(slug) {
    const cards = document.querySelectorAll('.video-card');
    const buttons = document.querySelectorAll('.filter-btn');
    
    buttons.forEach(btn => {
        btn.classList.remove('active');
        btn.setAttribute('aria-selected', 'false');
    });
    
    // Set active button
    event.target.classList.add('active');
    event.target.setAttribute('aria-selected', 'true');

    cards.forEach(card => {
        if (slug === 'all') {
            card.style.display = '';
        } else {
            if (card.classList.contains(slug)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        }
    });
}
</script>
@endsection
