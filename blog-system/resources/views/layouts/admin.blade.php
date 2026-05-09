<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') – BlogYaari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=Hind:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --saffron: #FF6B00;
            --deep-saffron: #E55A00;
            --navy: #0A1931;
            --navy-light: #132645;
            --sidebar-w: 240px;
            --topbar-h: 60px;
            --white: #fff;
            --gray-100: #F5F5F5;
            --gray-200: #E8E8E8;
            --gray-500: #888;
            --gray-700: #444;
            --green: #27ae60;
            --red: #e74c3c;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 20px rgba(0,0,0,0.12);
            --radius: 12px;
            --radius-sm: 8px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Hind', sans-serif; background: #F0F2F5; color: var(--navy); display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--navy);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform 0.3s;
        }
        .sidebar-brand {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-icon {
            width: 36px; height: 36px;
            background: var(--saffron);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: white;
        }
        .brand-name {
            font-family: 'Baloo 2', cursive;
            font-weight: 800;
            font-size: 1.2rem;
            color: white;
        }
        .brand-name span { color: var(--saffron); }
        .sidebar-tag {
            font-size: 0.65rem;
            background: rgba(255,107,0,0.2);
            color: var(--saffron);
            padding: 2px 8px;
            border-radius: 20px;
            margin-top: 6px;
            display: inline-block;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .nav-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.35);
            padding: 4px 10px;
            margin: 12px 0 4px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            margin-bottom: 2px;
        }
        .nav-item:hover { background: rgba(255,255,255,0.1); color: white; }
        .nav-item.active { background: var(--saffron); color: white; }
        .nav-item i { width: 18px; text-align: center; font-size: 0.9rem; }
        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .admin-avatar {
            width: 36px; height: 36px;
            background: var(--saffron);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: 0.9rem;
        }
        .admin-name { font-size: 0.85rem; font-weight: 600; color: white; }
        .admin-role { font-size: 0.72rem; color: rgba(255,255,255,0.4); }

        /* TOPBAR */
        .topbar {
            height: var(--topbar-h);
            background: white;
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            box-shadow: var(--shadow-sm);
            z-index: 90;
        }
        .topbar-title {
            font-family: 'Baloo 2', cursive;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--navy);
        }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .btn-view-site {
            padding: 7px 16px;
            background: transparent;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            color: var(--gray-700);
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-view-site:hover { border-color: var(--saffron); color: var(--saffron); }
        .hamburger-admin {
            display: none;
            cursor: pointer;
            padding: 4px;
            flex-direction: column;
            gap: 5px;
        }
        .hamburger-admin span { display: block; width: 22px; height: 2px; background: var(--navy); border-radius: 2px; }

        /* MAIN */
        .main-content {
            margin-left: var(--sidebar-w);
            margin-top: var(--topbar-h);
            flex: 1;
            padding: 28px;
            min-height: calc(100vh - var(--topbar-h));
        }

        /* CARDS */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .stat-card {
            background: white;
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-icon {
            width: 50px; height: 50px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .stat-icon.orange { background: rgba(255,107,0,0.1); color: var(--saffron); }
        .stat-icon.navy { background: rgba(10,25,49,0.1); color: var(--navy); }
        .stat-icon.green { background: rgba(39,174,96,0.1); color: var(--green); }
        .stat-icon.red { background: rgba(231,76,60,0.1); color: var(--red); }
        .stat-value { font-family: 'Baloo 2', cursive; font-size: 1.8rem; font-weight: 800; line-height: 1; }
        .stat-label { font-size: 0.8rem; color: var(--gray-500); font-weight: 500; }

        /* TABLE */
        .panel {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            margin-bottom: 24px;
        }
        .panel-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .panel-title {
            font-family: 'Baloo 2', cursive;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .panel-body { padding: 0; }
        table { width: 100%; border-collapse: collapse; }
        th {
            background: var(--gray-100);
            padding: 12px 16px;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-500);
            text-align: left;
        }
        td { padding: 12px 16px; border-bottom: 1px solid var(--gray-100); font-size: 0.9rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--gray-100); }

        /* BADGES */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge-saffron { background: rgba(255,107,0,0.12); color: var(--saffron); }
        .badge-green { background: rgba(39,174,96,0.12); color: var(--green); }
        .badge-red { background: rgba(231,76,60,0.12); color: var(--red); }
        .badge-navy { background: rgba(10,25,49,0.12); color: var(--navy); }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
            font-family: 'Hind', sans-serif;
        }
        .btn-primary { background: var(--saffron); color: white; }
        .btn-primary:hover { background: var(--deep-saffron); color: white; }
        .btn-secondary { background: var(--navy); color: white; }
        .btn-secondary:hover { background: var(--navy-light); color: white; }
        .btn-danger { background: var(--red); color: white; }
        .btn-danger:hover { background: #c0392b; color: white; }
        .btn-outline { background: transparent; border: 1.5px solid var(--gray-200); color: var(--gray-700); }
        .btn-outline:hover { border-color: var(--saffron); color: var(--saffron); }
        .btn-sm { padding: 5px 12px; font-size: 0.8rem; }
        .action-btns { display: flex; gap: 6px; }

        /* FORM */
        .form-card { background: white; border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); padding: 28px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 7px; color: var(--navy); }
        .form-label span { color: var(--red); margin-left: 3px; }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-family: 'Hind', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
            color: var(--navy);
            background: white;
        }
        .form-control:focus { border-color: var(--saffron); }
        textarea.form-control { resize: vertical; min-height: 120px; }
        .form-hint { font-size: 0.78rem; color: var(--gray-500); margin-top: 5px; }
        .form-check { display: flex; align-items: center; gap: 8px; }
        .form-check input[type="checkbox"] { width: 18px; height: 18px; accent-color: var(--saffron); cursor: pointer; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-actions { display: flex; gap: 12px; align-items: center; margin-top: 8px; }
        .error-msg { color: var(--red); font-size: 0.8rem; margin-top: 5px; }
        .img-preview { max-width: 200px; border-radius: 8px; margin-top: 10px; display: none; }

        /* ALERTS */
        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: rgba(39,174,96,0.1); border: 1px solid rgba(39,174,96,0.3); color: #1e7e34; }
        .alert-danger { background: rgba(231,76,60,0.1); border: 1px solid rgba(231,76,60,0.3); color: var(--red); }

        /* THUMB */
        .blog-thumb {
            width: 50px; height: 50px;
            border-radius: 8px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--navy), #1a3a5c);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.3); font-size: 1.2rem;
            overflow: hidden;
        }
        .blog-thumb img { width: 100%; height: 100%; object-fit: cover; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .topbar { left: 0; }
            .main-content { margin-left: 0; }
            .hamburger-admin { display: flex; }
            .form-row { grid-template-columns: 1fr; }
            .stat-grid { grid-template-columns: 1fr 1fr; }
        }

        /* Logout form */
        .logout-form { width: 100%; }
        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            background: rgba(231,76,60,0.12);
            color: #e74c3c;
            border: none;
            cursor: pointer;
            font-family: 'Hind', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .logout-btn:hover { background: rgba(231,76,60,0.25); }

        /* Pagination */
        .pagination { display: flex; gap: 6px; list-style: none; margin: 16px 20px; }
        .pagination li a, .pagination li span {
            display: block;
            padding: 7px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            text-decoration: none;
            color: var(--navy);
            border: 1.5px solid var(--gray-200);
            background: white;
        }
        .pagination li.active span { background: var(--saffron); border-color: var(--saffron); color: white; }
    </style>
    @yield('head')
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <div class="brand-icon"><i class="fas fa-newspaper"></i></div>
            <span class="brand-name">Blog<span>Yaari</span></span>
        </a>
        <div class="sidebar-tag"><i class="fas fa-shield-alt"></i> Admin Panel</div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <div class="nav-section-label">Content</div>
        <a href="{{ route('admin.blogs.index') }}" class="nav-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i> All Blogs
        </a>
        <a href="{{ route('admin.blogs.create') }}" class="nav-item {{ request()->routeIs('admin.blogs.create') ? 'active' : '' }}">
            <i class="fas fa-plus-circle"></i> Add Blog
        </a>
        <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Categories
        </a>
        <div class="nav-section-label">Site</div>
        <a href="{{ route('blog.index') }}" target="_blank" class="nav-item">
            <i class="fas fa-external-link-alt"></i> View Site
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="admin-info">
            <div class="admin-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
            <div>
                <div class="admin-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                <div class="admin-role">Administrator</div>
            </div>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>

<!-- Topbar -->
<header class="topbar">
    <div style="display:flex; align-items:center; gap:14px;">
        <div class="hamburger-admin" id="hamburgerAdmin" onclick="toggleSidebar()">
            <span></span><span></span><span></span>
        </div>
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('blog.index') }}" target="_blank" class="btn-view-site">
            <i class="fas fa-eye"></i> View Site
        </a>
    </div>
</header>

<!-- Main Content -->
<main class="main-content">
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@yield('scripts')
<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}

// Image preview
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function() {
        const preview = document.getElementById('img-preview');
        if (this.files && this.files[0] && preview) {
            const reader = new FileReader();
            reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
</body>
</html>
