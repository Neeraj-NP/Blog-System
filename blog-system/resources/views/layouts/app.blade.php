<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BlogYaari – Latest Sarkari Updates')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=Hind:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --saffron: #FF6B00;
            --deep-saffron: #E55A00;
            --navy: #0A1931;
            --navy-light: #132645;
            --white: #FFFFFF;
            --off-white: #FFF8F0;
            --gray-100: #F5F5F5;
            --gray-200: #E8E8E8;
            --gray-500: #888;
            --gray-700: #444;
            --green: #27ae60;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 20px rgba(0,0,0,0.12);
            --shadow-lg: 0 8px 40px rgba(0,0,0,0.16);
            --radius: 12px;
            --radius-sm: 8px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Hind', sans-serif;
            background: var(--off-white);
            color: var(--navy);
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: var(--navy);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }
        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-icon {
            width: 40px; height: 40px;
            background: var(--saffron);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }
        .brand-text {
            font-family: 'Baloo 2', cursive;
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            line-height: 1;
        }
        .brand-text span { color: var(--saffron); }
        .brand-tagline {
            font-size: 0.65rem;
            color: rgba(255,255,255,0.5);
            display: block;
            letter-spacing: 0.5px;
        }
        .nav-links { display: flex; align-items: center; gap: 24px; }
        .nav-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--saffron); }
        .btn-admin {
            background: var(--saffron);
            color: white !important;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600 !important;
            transition: background 0.2s !important;
        }
        .btn-admin:hover { background: var(--deep-saffron) !important; color: white !important; }
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
        }
        .hamburger span {
            display: block;
            width: 25px; height: 2px;
            background: white;
            border-radius: 2px;
            transition: 0.3s;
        }

        /* ── HERO ── */
        .hero {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 60%, #1a3a5c 100%);
            padding: 60px 20px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -50%; left: -20%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(255,107,0,0.15) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero h1 {
            font-family: 'Baloo 2', cursive;
            font-size: clamp(1.8rem, 5vw, 3rem);
            font-weight: 800;
            color: white;
            margin-bottom: 12px;
        }
        .hero h1 span { color: var(--saffron); }
        .hero p {
            color: rgba(255,255,255,0.65);
            font-size: 1rem;
            max-width: 500px;
            margin: 0 auto;
        }

        /* ── FILTER BAR ── */
        .filter-section {
            background: white;
            border-bottom: 2px solid var(--gray-200);
            position: sticky;
            top: 64px;
            z-index: 900;
            box-shadow: var(--shadow-sm);
        }
        .filter-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .filter-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }
        .search-box {
            flex: 1;
            min-width: 200px;
            position: relative;
        }
        .search-box input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-family: 'Hind', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
            background: var(--gray-100);
        }
        .search-box input:focus { border-color: var(--saffron); background: white; }
        .search-box i {
            position: absolute;
            left: 12px; top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            font-size: 0.85rem;
        }
        .filter-select {
            padding: 10px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-family: 'Hind', sans-serif;
            font-size: 0.9rem;
            outline: none;
            cursor: pointer;
            background: var(--gray-100);
            color: var(--navy);
            transition: border-color 0.2s;
        }
        .filter-select:focus { border-color: var(--saffron); background: white; }
        .filter-date {
            padding: 10px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-family: 'Hind', sans-serif;
            font-size: 0.9rem;
            outline: none;
            cursor: pointer;
            background: var(--gray-100);
            color: var(--navy);
        }
        .filter-date:focus { border-color: var(--saffron); background: white; }
        .btn-reset {
            padding: 10px 16px;
            background: transparent;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            cursor: pointer;
            color: var(--gray-700);
            font-size: 0.85rem;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-reset:hover { border-color: var(--saffron); color: var(--saffron); }

        /* ── CATEGORY PILLS ── */
        .category-pills {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px 20px;
            display: flex;
            gap: 8px;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .category-pills::-webkit-scrollbar { display: none; }
        .pill {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            border: 1.5px solid var(--gray-200);
            background: white;
            color: var(--gray-700);
            white-space: nowrap;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .pill:hover, .pill.active {
            background: var(--saffron);
            border-color: var(--saffron);
            color: white;
        }

        /* ── MAIN LAYOUT ── */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 28px;
            align-items: start;
        }

        /* ── BLOG CARDS ── */
        .blogs-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .blogs-header h2 {
            font-family: 'Baloo 2', cursive;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--navy);
        }
        .result-count {
            font-size: 0.85rem;
            color: var(--gray-500);
        }
        #blogs-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .blog-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
        }
        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }
        .blog-card-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--navy) 0%, #1a3a5c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .blog-card-img img {
            width: 100%; height: 100%;
            object-fit: cover;
        }
        .blog-card-img .placeholder-icon {
            opacity: 0.4;
        }
        .blog-card-category {
            position: absolute;
            top: 10px; left: 10px;
            background: var(--saffron);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .blog-card-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }
        .blog-card-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }
        .blog-card-meta span {
            font-size: 0.75rem;
            color: var(--gray-500);
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .blog-card-title {
            font-family: 'Baloo 2', cursive;
            font-size: 1rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 8px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .blog-card-desc {
            font-size: 0.85rem;
            color: var(--gray-700);
            line-height: 1.6;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 14px;
        }
        .blog-card-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--saffron);
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            transition: gap 0.2s;
        }
        .blog-card-link:hover { gap: 10px; }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-500);
            grid-column: 1 / -1;
        }
        .empty-state i { font-size: 3rem; margin-bottom: 16px; opacity: 0.4; display: block; }
        .empty-state h3 { font-size: 1.2rem; margin-bottom: 8px; color: var(--navy); }

        /* ── LOADING SPINNER ── */
        .loading-overlay {
            display: none;
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(255,248,240,0.8);
            align-items: center;
            justify-content: center;
            border-radius: var(--radius);
            z-index: 10;
        }
        .blogs-wrapper { position: relative; }
        .spinner {
            width: 40px; height: 40px;
            border: 3px solid var(--gray-200);
            border-top-color: var(--saffron);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── SIDEBAR ── */
        .sidebar { display: flex; flex-direction: column; gap: 20px; }
        .sidebar-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }
        .sidebar-card-header {
            background: var(--navy);
            padding: 14px 20px;
            font-family: 'Baloo 2', cursive;
            font-weight: 700;
            color: white;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .sidebar-card-body { padding: 16px; }
        .cat-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--gray-100);
            cursor: pointer;
            transition: color 0.2s;
        }
        .cat-item:last-child { border-bottom: none; }
        .cat-item:hover .cat-name { color: var(--saffron); }
        .cat-name { font-size: 0.9rem; font-weight: 500; }
        .cat-count {
            background: var(--saffron);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
        }

        /* ── PAGINATION ── */
        .pagination-wrapper {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }
        .pagination { display: flex; gap: 6px; list-style: none; }
        .pagination li a, .pagination li span {
            display: block;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 0.9rem;
            text-decoration: none;
            color: var(--navy);
            border: 1.5px solid var(--gray-200);
            background: white;
            transition: all 0.2s;
        }
        .pagination li.active span {
            background: var(--saffron);
            border-color: var(--saffron);
            color: white;
        }
        .pagination li a:hover { border-color: var(--saffron); color: var(--saffron); }

        /* ── FOOTER ── */
        footer {
            background: var(--navy);
            color: rgba(255,255,255,0.6);
            text-align: center;
            padding: 28px 20px;
            margin-top: 60px;
            font-size: 0.85rem;
        }
        footer strong { color: var(--saffron); }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .content-grid { grid-template-columns: 1fr; }
            .sidebar { display: none; }
        }
        @media (max-width: 600px) {
            .nav-links { display: none; }
            .nav-links.open {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 64px; left: 0; right: 0;
                background: var(--navy-light);
                padding: 20px;
                gap: 16px;
                z-index: 999;
            }
            .hamburger { display: flex; }
            .navbar { position: relative; }
            .filter-inner { gap: 8px; }
            .filter-date { width: 100%; }
            #blogs-container { grid-template-columns: 1fr; }
            .hero { padding: 40px 20px 30px; }
        }

        /* ── ANIMATIONS ── */
        .blog-card { animation: fadeUp 0.4s ease both; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
    @yield('head')
</head>
<body>

<nav class="navbar">
    <div class="navbar-inner">
        <a href="{{ route('blog.index') }}" class="navbar-brand">
            <div class="brand-icon"><i class="fas fa-newspaper"></i></div>
            <div>
                <div class="brand-text">Blog<span>Yaari</span></div>
                <span class="brand-tagline">सरकारी अपडेट्स • Sarkari Updates</span>
            </div>
        </a>
        <div class="nav-links" id="navLinks">
            <a href="{{ route('blog.index') }}"><i class="fas fa-home"></i> Home</a>
            <a href="{{ route('admin.login') }}" class="btn-admin"><i class="fas fa-lock"></i> Admin</a>
        </div>
        <div class="hamburger" id="hamburger" onclick="toggleNav()">
            <span></span><span></span><span></span>
        </div>
    </div>
</nav>

@yield('content')

<footer>
    <p>© {{ date('Y') }} <strong>BlogYaari</strong> — All Rights Reserved &nbsp;|&nbsp; Built with ❤️ using Laravel & jQuery</p>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@yield('scripts')
<script>
function toggleNav() {
    document.getElementById('navLinks').classList.toggle('open');
}
</script>
</body>
</html>
