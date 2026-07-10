<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard') — MaxBat Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;700&family=Barlow+Condensed:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{
            --green:#5BC800;--green-light:rgba(91,200,0,0.12);--green-border:rgba(91,200,0,0.25);
            --red:#E10600;--bg:#0f0f0f;--card:#1a1a1a;--card2:#222;
            --border:rgba(255,255,255,0.07);--text:#f0f0f0;--muted:rgba(255,255,255,0.5);
            --sidebar:200px;
        }
        html,body{height:100%;font-family:'Barlow',sans-serif;background:var(--bg);color:var(--text);font-size:15px;line-height:1.6;}
        a{text-decoration:none;color:inherit;}
        button{cursor:pointer;font-family:inherit;}
        input,select,textarea{font-family:'Barlow',sans-serif;}

        /* LAYOUT */
        .admin-wrap{display:flex;min-height:100vh;}

        /* SIDEBAR */
        .sidebar{
            width:var(--sidebar);flex-shrink:0;background:#111;border-right:1px solid var(--border);
            display:flex;flex-direction:column;position:fixed;top:0;left:0;bottom:0;z-index:100;
            transition:transform 0.3s;
        }
        .sidebar-logo{
            padding:20px 16px;border-bottom:1px solid var(--border);
            display:flex;align-items:center;gap:10px;
        }
        .sidebar-logo img{height:38px;width:auto;border-radius:5px;}
        .sidebar-logo span{font-family:'Bebas Neue',sans-serif;font-size:16px;color:#fff;text-transform:uppercase;letter-spacing:1px;}
        .sidebar-nav{flex:1;padding:12px 0;overflow-y:auto;}
        .nav-section{padding:8px 16px 4px;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.3);}
        .sidebar-link{
            display:flex;align-items:center;gap:10px;padding:10px 16px;
            font-size:14px;font-weight:500;color:var(--muted);
            border-left:3px solid transparent;transition:all 0.2s;
        }
        .sidebar-link i{width:18px;text-align:center;font-size:15px;}
        .sidebar-link:hover{color:#fff;background:rgba(255,255,255,0.04);border-left-color:rgba(91,200,0,0.4);}
        .sidebar-link.active{color:var(--green);background:var(--green-light);border-left-color:var(--green);}
        .sidebar-footer{padding:16px;border-top:1px solid var(--border);}
        .sidebar-footer form button{
            width:100%;padding:9px 14px;border-radius:6px;
            background:rgba(225,6,0,0.12);border:1px solid rgba(225,6,0,0.2);
            color:#ff6b6b;font-size:13px;font-weight:700;text-transform:uppercase;
            letter-spacing:1px;display:flex;align-items:center;gap:8px;justify-content:center;
            transition:all 0.2s;
        }
        .sidebar-footer form button:hover{background:rgba(225,6,0,0.2);color:#ff4444;}

        /* MAIN */
        .main-area{flex:1;margin-left:var(--sidebar);display:flex;flex-direction:column;min-height:100vh;}

        /* TOPBAR */
        .topbar{
            height:60px;background:#111;border-bottom:1px solid var(--border);
            display:flex;align-items:center;justify-content:space-between;padding:0 24px;
            position:sticky;top:0;z-index:50;
        }
        .topbar-title{font-family:'Bebas Neue',sans-serif;font-size:20px;font-weight:400;text-transform:uppercase;letter-spacing:1px;}
        .topbar-right{display:flex;align-items:center;gap:16px;}
        .topbar-user{display:flex;align-items:center;gap:10px;font-size:14px;color:var(--muted);}
        .topbar-avatar{width:34px;height:34px;border-radius:50%;background:var(--green);display:flex;align-items:center;justify-content:center;font-weight:700;color:#000;font-size:14px;}
        .hamburger-admin{display:none;background:none;border:none;color:#fff;font-size:20px;cursor:pointer;}

        /* PAGE */
        .page-content{padding:28px 24px;flex:1;}

        /* CARDS */
        .stat-cards{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-bottom:28px;}
        @media(min-width:1024px){.stat-cards{grid-template-columns:repeat(6,1fr);}}
        .stat-card{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:22px 20px;display:flex;align-items:center;gap:16px;transition:border-color 0.3s;}
        .stat-card:hover{border-color:var(--green-border);}
        .stat-icon{width:48px;height:48px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;}
        .stat-icon.green{background:var(--green-light);color:var(--green);border:1px solid var(--green-border);}
        .stat-icon.red{background:rgba(225,6,0,0.12);color:var(--red);border:1px solid rgba(225,6,0,0.2);}
        .stat-icon.blue{background:rgba(59,130,246,0.12);color:#60a5fa;border:1px solid rgba(59,130,246,0.2);}
        .stat-icon.orange{background:rgba(251,146,60,0.12);color:#fb923c;border:1px solid rgba(251,146,60,0.2);}
        .stat-num{font-family:'Bebas Neue',sans-serif;font-size:32px;font-weight:400;color:#fff;line-height:1;}
        .stat-label{font-size:12px;color:var(--muted);margin-top:4px;text-transform:uppercase;letter-spacing:1px;}

        /* TABLE */
        .table-card{background:var(--card);border:1px solid var(--border);border-radius:12px;overflow:hidden;}
        .table-card-header{padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}
        .table-card-title{font-family:'Bebas Neue',sans-serif;font-size:18px;font-weight:400;text-transform:uppercase;letter-spacing:1px;}
        .table-wrap{overflow-x:auto;}
        table{width:100%;border-collapse:collapse;}
        thead tr{border-bottom:1px solid var(--border);}
        th{padding:12px 16px;text-align:left;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--muted);}
        td{padding:13px 16px;font-size:14px;border-bottom:1px solid rgba(255,255,255,0.04);}
        tr:last-child td{border-bottom:none;}
        tr:hover td{background:rgba(255,255,255,0.02);}
        .badge{display:inline-block;padding:3px 10px;border-radius:100px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;}
        .badge-new{background:rgba(59,130,246,0.15);color:#60a5fa;border:1px solid rgba(59,130,246,0.25);}
        .badge-progress{background:rgba(251,146,60,0.15);color:#fb923c;border:1px solid rgba(251,146,60,0.25);}
        .badge-completed{background:var(--green-light);color:var(--green);border:1px solid var(--green-border);}
        .badge-cancelled{background:rgba(225,6,0,0.12);color:#ff6b6b;border:1px solid rgba(225,6,0,0.2);}

        /* FORMS */
        .form-card{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:28px;}
        .form-grid{display:grid;grid-template-columns:1fr;gap:18px;}
        @media(min-width:768px){.form-grid-2{grid-template-columns:1fr 1fr;}}
        .form-group{display:flex;flex-direction:column;gap:7px;}
        .form-label{font-size:12px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--muted);}
        .form-control{background:#252525;border:1px solid rgba(255,255,255,0.10);color:#fff;padding:11px 14px;border-radius:7px;font-size:14px;transition:border-color 0.2s;width:100%;}
        .form-control:focus{outline:none;border-color:var(--green);box-shadow:0 0 0 3px var(--green-light);}
        .form-control::placeholder{color:rgba(255,255,255,0.2);}
        select.form-control{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%235BC800' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;background-color:#252525;padding-right:36px;}
        select.form-control option{background:#252525;}
        textarea.form-control{resize:vertical;min-height:100px;}

        /* BUTTONS */
        .btn{display:inline-flex;align-items:center;gap:8px;padding:9px 20px;border-radius:6px;font-family:'Barlow',sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;transition:all 0.2s;border:none;cursor:pointer;}
        .btn-green{background:var(--green);color:#000;}
        .btn-green:hover{background:#68e000;}
        .btn-sm{padding:6px 14px;font-size:12px;}
        .btn-danger{background:rgba(225,6,0,0.15);border:1px solid rgba(225,6,0,0.25);color:#ff6b6b;}
        .btn-danger:hover{background:rgba(225,6,0,0.25);}
        .btn-ghost{background:rgba(255,255,255,0.06);border:1px solid var(--border);color:var(--muted);}
        .btn-ghost:hover{color:#fff;border-color:rgba(255,255,255,0.2);}

        /* ALERTS */
        .alert{padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:14px;}
        .alert-success{background:var(--green-light);border:1px solid var(--green-border);color:var(--green);}
        .alert-error{background:rgba(225,6,0,0.1);border:1px solid rgba(225,6,0,0.2);color:#ff6b6b;}

        /* SEARCH */
        .search-bar{display:flex;gap:10px;flex-wrap:wrap;}
        .search-input{background:#252525;border:1px solid var(--border);color:#fff;padding:9px 14px;border-radius:6px;font-size:14px;width:260px;}
        .search-input:focus{outline:none;border-color:var(--green);}

        /* PAGINATION */
        .pagination-wrap{padding:16px 20px;border-top:1px solid var(--border);}
        .pagination-wrap .pagination{display:flex;gap:6px;flex-wrap:wrap;}
        .pagination-wrap .page-link{padding:6px 12px;border-radius:5px;background:var(--card2);border:1px solid var(--border);color:var(--muted);font-size:13px;text-decoration:none;transition:all 0.2s;}
        .pagination-wrap .page-link:hover,.pagination-wrap .page-item.active .page-link{background:var(--green);color:#000;border-color:var(--green);}

        /* TOGGLE */
        .toggle-switch{position:relative;width:40px;height:22px;display:inline-block;}
        .toggle-switch input{opacity:0;width:0;height:0;}
        .toggle-slider{position:absolute;inset:0;background:#333;border-radius:22px;cursor:pointer;transition:0.2s;}
        .toggle-slider::before{content:'';position:absolute;width:16px;height:16px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:0.2s;}
        input:checked+.toggle-slider{background:var(--green);}
        input:checked+.toggle-slider::before{transform:translateX(18px);}

        /* MOBILE RESPONSIVE */
        @media(max-width:768px){
            .sidebar{transform:translateX(-100%);}
            .sidebar.open{transform:translateX(0);}
            .main-area{margin-left:0;}
            .hamburger-admin{display:block;}
            .page-content{padding:16px;}
        }
    </style>
</head>
<body>
<div class="admin-wrap">

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="adminSidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('storage/maxbat.jpg') }}" alt="MaxBat">
            <span>Admin</span>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>
            <div class="nav-section">Manage</div>
            <a href="{{ route('admin.chats.index') }}" class="sidebar-link {{ request()->routeIs('admin.chats.*') ? 'active' : '' }}">
                <i class="fa fa-comments"></i> Chats
                @php $unread = \App\Models\ChatRoom::withCount(['unreadByAdmin as u'])->get()->sum('u'); @endphp
                @if($unread > 0)
                <span style="margin-left:auto;background:var(--red);color:#fff;font-size:10px;font-weight:700;padding:2px 7px;border-radius:100px;">{{ $unread }}</span>
                @endif
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fa fa-shopping-cart"></i> Orders
                @php $pendingOrders = \App\Models\Order::where('status','pending')->count(); @endphp
                @if($pendingOrders > 0)
                <span style="margin-left:auto;background:var(--green);color:#000;font-size:10px;font-weight:700;padding:2px 7px;border-radius:100px;">{{ $pendingOrders }}</span>
                @endif
            </a>
            <a href="{{ route('admin.inquiries.index') }}" class="sidebar-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                <i class="fa fa-envelope"></i> Inquiries
            </a>
            <a href="{{ route('admin.file-submissions.index') }}" class="sidebar-link {{ request()->routeIs('admin.file-submissions.*') ? 'active' : '' }}">
                <i class="fa fa-file-upload"></i> File Submissions
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="fa fa-shopping-bag"></i> Products
            </a>
            <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fa fa-tools"></i> Services
            </a>
            <a href="{{ route('admin.vehicles.index') }}" class="sidebar-link {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}">
                <i class="fa fa-car"></i> Vehicle Database
            </a>
            <a href="{{ route('admin.cars-for-sale.index') }}" class="sidebar-link {{ request()->routeIs('admin.cars-for-sale.*') ? 'active' : '' }}">
                <i class="fa fa-car-side"></i> Cars for Sale
            </a>
            <a href="{{ route('admin.videos.index') }}" class="sidebar-link {{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">
                <i class="fa fa-video"></i> Videos
            </a>
            <a href="{{ route('admin.careers.index') }}" class="sidebar-link {{ request()->routeIs('admin.careers.*') ? 'active' : '' }}">
                <i class="fa fa-briefcase"></i> Careers
            </a>
            <div class="nav-section">Site</div>
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <i class="fa fa-external-link-alt"></i> View Website
            </a>
        </nav>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"><i class="fa fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="main-area">
        <div class="topbar">
            <div style="display:flex;align-items:center;gap:14px;">
                <button class="hamburger-admin" id="sidebarToggle"><i class="fa fa-bars"></i></button>
                <span class="topbar-title">@yield('title','Dashboard')</span>
            </div>
            <div class="topbar-right">
                <div class="topbar-user">
                    <div class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>
        </div>

        <div class="page-content">
            @if(session('success'))
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error"><i class="fa fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </div>
</div>

{{-- Mobile overlay --}}
<div id="sidebarOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:99;" onclick="closeSidebar()"></div>

<script>
const toggle = document.getElementById('sidebarToggle');
const sidebar = document.getElementById('adminSidebar');
const overlay = document.getElementById('sidebarOverlay');
if(toggle){
    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
    });
}
function closeSidebar(){
    sidebar.classList.remove('open');
    overlay.style.display = 'none';
}
</script>
@stack('styles')
@stack('scripts')
</body>
</html>
