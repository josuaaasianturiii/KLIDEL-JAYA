<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Calendar — Gabe Medica</title>
<link rel="icon" type="image/png" href="{{ asset('images/gabe-medica-icon.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --bg-page:#fff; --bg-muted:#fafafa; --bg-subtle:#f5f5f5;
    --border:#e5e5e5; --border-light:#efefef;
    --text-primary:#171717; --text-secondary:#525252; --text-tertiary:#8a8a8a;
    --icon-default:#6b6b6b;
    --action-bg:#171717; --action-text:#fff;
    --status-online:#17b26a; --now-indicator:#6b6b6b;
    --event-neutral-bg:#f5f5f5; --event-neutral-border:#e5e5e5; --event-neutral-text:#333;
    --event-purple-bg:#f1e9fb; --event-purple-border:#dccbf3; --event-purple-text:#5b2ba8;
    --event-blue-bg:#e7effe; --event-blue-border:#c7d8fa; --event-blue-text:#1f3fa3;
    --font-sans:"Inter",system-ui,-apple-system,"Segoe UI",sans-serif;
    --radius-sm:6px; --radius-md:8px; --radius-lg:12px; --radius-full:999px;
    --shadow-xs:0 1px 2px rgba(16,24,40,.05);
    --sidebar-w:190px; --panel-w:230px; --hour-h:62px;
  }
  *{box-sizing:border-box;margin:0;padding:0}
  body{font-family:var(--font-sans);font-size:13px;line-height:20px;color:var(--text-secondary);background:var(--bg-muted);-webkit-font-smoothing:antialiased}
  button{font:inherit;color:inherit;background:none;border:0;cursor:pointer}
  svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:1.5;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0}
  :focus-visible{outline:2px solid var(--text-primary);outline-offset:2px}

  .app{display:flex;min-height:100vh;background:var(--bg-page)}

  /* ===== Sidebar ===== */
  .sidebar{width:var(--sidebar-w);flex-shrink:0;border-right:1px solid var(--border);padding:12px 10px;display:flex;flex-direction:column;background:var(--bg-page);position:sticky;top:0;height:100vh}
  .brand{display:flex;align-items:center;gap:8px;padding:4px 6px 14px;color:var(--text-primary);font-weight:600;font-size:14px}
  .brand .logo{width:22px;height:22px;border:3.5px solid var(--text-primary);border-radius:50%;border-right-color:transparent}
  .brand .admin-badge{font-size:10px;font-weight:600;background:#f5f5f5;border:1px solid var(--border);border-radius:4px;padding:1px 5px;margin-left:auto;color:var(--text-tertiary)}
  .nav{display:flex;flex-direction:column;gap:2px}
  .nav a,.nav button.item{display:flex;align-items:center;gap:12px;padding:8px 10px;border-radius:var(--radius-md);color:var(--text-secondary);text-decoration:none;width:100%;text-align:left;font-weight:500;transition:background .15s}
  .nav a svg,.nav button.item svg{width:18px;height:18px;color:var(--icon-default)}
  .nav a:hover,.nav button.item:hover{background:var(--bg-subtle)}
  .nav a.active{background:var(--bg-subtle);color:var(--text-primary);font-weight:600}
  .nav .trail{margin-left:auto}
  hr.divider{border:0;border-top:1px solid var(--border);margin:10px 0}
  .sub{display:grid;grid-template-rows:1fr;transition:grid-template-rows .15s ease}
  .sub.closed{grid-template-rows:0fr}
  .sub>div{overflow:hidden}
  .sub a{padding-left:40px;font-weight:500}
  .count{margin-left:auto;font-size:11px;font-weight:500;color:var(--text-tertiary);background:var(--bg-subtle);border:1px solid var(--border);border-radius:var(--radius-full);min-width:22px;text-align:center;line-height:16px;padding:0 5px}
  .badge-online{margin-left:auto;display:inline-flex;align-items:center;gap:5px;font-size:11px;font-weight:500;border:1px solid var(--border);border-radius:var(--radius-sm);padding:0 6px;color:var(--text-primary);background:#fff}
  .dot{width:6px;height:6px;border-radius:50%;background:var(--status-online)}
  #foldersChev{transition:transform .15s}
  #foldersChev.rot{transform:rotate(180deg)}
  .spacer{flex:1}
  .user{display:flex;align-items:center;gap:8px;border:1px solid var(--border);border-radius:var(--radius-lg);padding:8px;box-shadow:var(--shadow-xs);position:relative;background:#fff}
  .avatar{width:32px;height:32px;border-radius:50%;display:grid;place-items:center;font-size:12px;font-weight:600;color:#fff;position:relative;flex-shrink:0}
  .user .status{position:absolute;right:-1px;bottom:-1px;width:9px;height:9px;border-radius:50%;background:var(--status-online);border:2px solid #fff}
  .user strong{display:block;font-size:12px;color:var(--text-primary);line-height:16px}
  .user small{display:block;font-size:11px;color:var(--text-tertiary);line-height:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:96px}
  .logout-btn{margin-top:8px;width:100%;height:32px;display:flex;align-items:center;justify-content:center;gap:6px;font-size:11.5px;font-weight:500;border-radius:var(--radius-md);border:1px solid var(--border);background:#fff;color:var(--text-secondary);transition:all .15s}
  .logout-btn:hover{background:#fee2e2;border-color:#fca5a5;color:#dc2626}

  /* ===== Main ===== */
  .main{flex:1;min-width:0;padding:20px 24px 32px}
  .topbar{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:18px}
  .crumbs{display:flex;align-items:center;gap:6px;color:var(--text-tertiary)}
  .crumbs .cur{background:var(--bg-subtle);border-radius:var(--radius-sm);padding:2px 8px;color:var(--text-secondary);font-weight:500;border:1px solid var(--border)}
  .topbar-actions{display:flex;align-items:center;gap:10px}
  .switch-portal{font-size:12px;font-weight:500;color:var(--text-secondary);text-decoration:none;padding:6px 12px;border-radius:var(--radius-md);border:1px solid var(--border);background:#fff;box-shadow:var(--shadow-xs);display:flex;align-items:center;gap:6px;transition:all .15s}
  .switch-portal:hover{background:var(--bg-subtle);color:var(--text-primary)}
  .search{display:flex;align-items:center;gap:8px;width:220px;height:36px;border:1px solid var(--border);border-radius:var(--radius-md);padding:0 10px;box-shadow:var(--shadow-xs);background:#fff;color:var(--text-tertiary)}
  .search input{border:0;outline:0;flex:1;font:inherit;min-width:0;background:transparent;color:var(--text-primary)}
  .kbd{font-size:10px;font-weight:500;border:1px solid var(--border);border-radius:4px;padding:0 5px;line-height:16px}
  h1{font-size:20px;line-height:28px;font-weight:600;letter-spacing:-.01em;color:var(--text-primary);margin-bottom:12px}

  .tabs{display:inline-flex;padding:2px;gap:2px;background:var(--bg-muted);border:1px solid var(--border);border-radius:var(--radius-md);margin-bottom:16px}
  .tab{height:28px;padding:0 10px;border-radius:6px;font-size:12px;font-weight:500;color:var(--text-tertiary);border:1px solid transparent}
  .tab:hover{color:var(--text-secondary)}
  .tab.active{background:#fff;color:var(--text-primary);border-color:var(--border);box-shadow:var(--shadow-xs)}

  /* ===== Calendar card ===== */
  .card{border:1px solid var(--border);border-radius:var(--radius-lg);background:#fff;overflow:hidden}
  .toolbar{display:flex;align-items:center;gap:8px;padding:14px 16px;border-bottom:1px solid var(--border);flex-wrap:wrap}
  .date-badge{width:40px;height:44px;border:1px solid var(--border);border-radius:var(--radius-md);text-align:center;box-shadow:var(--shadow-xs);overflow:hidden}
  .date-badge small{display:block;font-size:10px;line-height:14px;font-weight:600;color:var(--text-tertiary);background:var(--bg-muted);border-bottom:1px solid var(--border);text-transform:uppercase}
  .date-badge b{display:block;font-size:16px;line-height:24px;color:var(--text-primary)}
  .date-title{margin-right:auto;margin-left:4px}
  .date-title h2{font-size:16px;line-height:22px;font-weight:600;letter-spacing:-.01em;color:var(--text-primary)}
  .date-title span{font-size:12px;color:var(--text-tertiary);line-height:16px;display:block}
  .btn{height:36px;border:1px solid var(--border);border-radius:var(--radius-md);padding:0 12px;display:inline-flex;align-items:center;gap:6px;font-weight:500;background:#fff;box-shadow:var(--shadow-xs);color:var(--text-primary);transition:background .15s}
  .btn:hover{background:var(--bg-subtle)}
  .btn.icon{width:36px;padding:0;justify-content:center;border:0;box-shadow:none;color:var(--icon-default)}
  .btn.primary{background:var(--action-bg);color:var(--action-text);border-color:var(--action-bg)}
  .btn.primary:hover{background:#2b2b2b}
  .btn.primary:active{background:#000}
  .seg{display:inline-flex;border:1px solid var(--border);border-radius:var(--radius-md);box-shadow:var(--shadow-xs);overflow:hidden}
  .seg button{height:34px;min-width:34px;display:grid;place-items:center;color:var(--icon-default);transition:background .15s}
  .seg button:hover{background:var(--bg-subtle)}
  .seg button.today{padding:0 18px;border-inline:1px solid var(--border);font-weight:500;color:var(--text-primary)}
  .menu-wrap{position:relative}
  .menu{position:absolute;right:0;top:40px;min-width:140px;background:#fff;border:1px solid var(--border);border-radius:var(--radius-md);box-shadow:0 8px 24px rgba(16,24,40,.1);padding:4px;z-index:10;display:none}
  .menu.open{display:block}
  .menu button{display:block;width:100%;text-align:left;padding:6px 10px;border-radius:6px;color:var(--text-secondary)}
  .menu button:hover,.menu button.sel{background:var(--bg-subtle);color:var(--text-primary)}

  .body{display:grid;grid-template-columns:1fr var(--panel-w);height:560px}

  /* time grid */
  .grid{overflow-y:auto;position:relative;scrollbar-width:thin;scrollbar-color:#d4d4d4 transparent}
  .grid-inner{position:relative;height:calc(var(--hour-h) * 10 + 8px);padding-top:8px}
  .hour{display:flex;height:var(--hour-h);}
  .hour .lbl{width:50px;flex-shrink:0;text-align:right;padding-right:8px;font-size:11px;color:var(--text-tertiary);transform:translateY(-9px)}
  .hour .line{flex:1;border-top:1px solid var(--border-light);position:relative}
  .hour .line::after{content:"";position:absolute;left:0;right:0;top:50%;border-top:1px dashed var(--border-light);opacity:.6}
  .events{position:absolute;left:50px;right:0;top:8px}
  .event{position:absolute;left:4px;right:10px;border-radius:var(--radius-sm);padding:6px 8px;border:1px solid;font-size:11px;line-height:15px;overflow:hidden;cursor:pointer;transition:box-shadow .15s,border-color .15s;text-align:left}
  .event:hover{box-shadow:var(--shadow-xs)}
  .event b{display:block;font-weight:600}
  .event span{display:block;font-weight:500;opacity:.85}
  .event.neutral{background:var(--event-neutral-bg);border-color:var(--event-neutral-border);color:var(--event-neutral-text)}
  .event.purple{background:#F3E8FF;border-color:var(--event-purple-border);color:var(--event-purple-text)}
  .event.blue{background:#E0F2FE;border-color:var(--event-blue-border);color:var(--event-blue-text)}
  .event.selected{border-width:1.5px;box-shadow:0 0 0 3px rgba(23,23,23,.06)}
  .now{position:absolute;left:0;right:0;border-top:1px solid var(--now-indicator);pointer-events:none;z-index:2}
  .now::before{content:"";position:absolute;left:46px;top:-4px;width:7px;height:7px;border-radius:50%;background:var(--now-indicator)}
  .now em{position:absolute;left:0;top:-9px;width:44px;text-align:right;font-style:normal;font-size:11px;font-weight:500;color:var(--text-primary);background:#fff}

  /* side panel */
  .panel{border-left:1px solid var(--border);display:flex;flex-direction:column;min-height:0}
  .mini{padding:16px 14px 12px}
  .mini-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
  .mini-head strong{font-size:13px;color:var(--text-primary)}
  .mini-head button{width:24px;height:24px;border-radius:6px;display:grid;place-items:center;color:var(--icon-default)}
  .mini-head button:hover{background:var(--bg-subtle)}
  .mini-grid{display:grid;grid-template-columns:repeat(7,1fr);row-gap:4px;text-align:center}
  .mini-grid .dow{font-size:11px;font-weight:500;color:var(--text-primary);line-height:24px}
  .d{width:28px;height:28px;margin:0 auto;border-radius:50%;font-size:12px;color:var(--text-secondary);position:relative;display:grid;place-items:center;transition:background .15s}
  .d:hover{background:var(--bg-subtle)}
  .d.out{color:#b5b5b5}
  .d.sel{background:var(--action-bg);color:#fff;font-weight:600}
  .d.has::after{content:"";position:absolute;bottom:1px;left:50%;width:3px;height:3px;margin-left:-1.5px;border-radius:50%;background:var(--text-tertiary)}
  .d.sel.has::after{background:#fff;bottom:2px}

  .detail{border-top:1px solid var(--border);padding:14px;flex:1;overflow-y:auto;position:relative;scrollbar-width:thin}
  .detail-head{display:flex;align-items:center;gap:4px;margin-bottom:8px}
  .detail-head h3{font-size:14px;font-weight:600;color:var(--text-primary);margin-right:auto}
  .detail-head button{width:24px;height:24px;border-radius:6px;display:grid;place-items:center;color:var(--icon-default)}
  .detail-head button:hover{background:var(--bg-subtle)}
  .meta{display:flex;align-items:center;gap:8px;font-size:12px;color:var(--text-secondary);margin-bottom:6px;line-height:18px}
  .meta svg{color:var(--icon-default)}
  .guests{display:flex;align-items:center;margin:12px 0 8px}
  .guests .avatar{width:26px;height:26px;font-size:10px;border:2px solid #fff;margin-left:-6px}
  .guests .avatar:first-child{margin-left:0}
  .guests .add{width:26px;height:26px;border:1px solid var(--border);border-radius:50%;display:grid;place-items:center;margin-left:6px;color:var(--icon-default)}
  .sum{font-size:11px;color:var(--text-tertiary);margin-bottom:14px}
  .sum b{color:var(--text-primary);font-weight:600}
  .about h4{font-size:12px;font-weight:600;color:var(--text-primary);margin-bottom:6px}
  .about p{font-size:12px;line-height:18px;color:var(--text-tertiary);margin-bottom:10px}

  /* ===== Responsive ===== */
  @media (max-width:1100px){
    :root{--panel-w:200px}
  }
  @media (max-width:900px){
    .sidebar{display:none}
    .main{padding:16px}
    .body{grid-template-columns:1fr;height:auto}
    .grid{height:460px}
    .panel{border-left:0;border-top:1px solid var(--border)}
    .search{width:100%}
    .topbar{flex-wrap:wrap}
  }
  @media (prefers-reduced-motion:reduce){*{transition:none!important}}
</style>
</head>
<body>
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="i-home" viewBox="0 0 24 24"><path d="M3 10.5 12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/></symbol>
    <symbol id="i-dash" viewBox="0 0 24 24"><path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/></symbol>
    <symbol id="i-report" viewBox="0 0 24 24"><path d="M3 3v18h18M8 17v-5M13 17V8M18 17v-9"/></symbol>
    <symbol id="i-layers" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="6" rx="1.5"/><rect x="3" y="14" width="18" height="6" rx="1.5"/></symbol>
    <symbol id="i-folder" viewBox="0 0 24 24"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></symbol>
    <symbol id="i-cal" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></symbol>
    <symbol id="i-gear" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></symbol>
    <symbol id="i-support" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3.5"/><path d="m5.6 5.6 3.9 3.9M14.5 14.5l3.9 3.9M18.4 5.6l-3.9 3.9M9.5 14.5l-3.9 3.9"/></symbol>
    <symbol id="i-ext" viewBox="0 0 24 24"><path d="M14 4h6v6M20 4 10 14M18 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h5"/></symbol>
    <symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></symbol>
    <symbol id="i-l" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></symbol>
    <symbol id="i-r" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></symbol>
    <symbol id="i-cl" viewBox="0 0 24 24"><path d="m15 18-6-6 6-6"/></symbol>
    <symbol id="i-cr" viewBox="0 0 24 24"><path d="m9 18 6-6-6-6"/></symbol>
    <symbol id="i-cu" viewBox="0 0 24 24"><path d="m18 15-6-6-6 6"/></symbol>
    <symbol id="i-cd" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></symbol>
    <symbol id="i-plus" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></symbol>
    <symbol id="i-copy" viewBox="0 0 24 24"><rect x="9" y="9" width="11" height="11" rx="2"/><path d="M5 15V6a2 2 0 0 1 2-2h9"/></symbol>
    <symbol id="i-trash" viewBox="0 0 24 24"><path d="M4 7h16M10 11v6M14 11v6M6 7l1 12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2l1-12M9 7V4h6v3"/></symbol>
    <symbol id="i-edit" viewBox="0 0 24 24"><path d="M4 20h4L19 9a2.8 2.8 0 0 0-4-4L4 16z"/></symbol>
    <symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
    <symbol id="i-bell" viewBox="0 0 24 24"><path d="M6 9a6 6 0 1 1 12 0c0 6 2 7 2 7H4s2-1 2-7M10 20a2 2 0 0 0 4 0"/></symbol>
    <symbol id="i-more" viewBox="0 0 24 24"><circle cx="12" cy="5" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="12" cy="19" r="1"/></symbol>
    <symbol id="i-logout" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></symbol>
  </defs>
</svg>

<div class="app">
  <!-- ========== SIDEBAR ========== -->
  <aside class="sidebar">
    <div class="brand">
      <img src="{{ asset('images/gabe-medica-logo.png') }}" alt="Gabe Medica" style="height:26px;width:auto;max-width:115px;object-fit:contain;margin-right:auto;" />
      <span class="admin-badge">Admin</span>
    </div>

    <nav class="nav" aria-label="Navigasi utama">
      <a href="#"><svg><use href="#i-dash"/></svg>Dashboard</a>
      <a href="#"><svg><use href="#i-report"/></svg>Reporting</a>
      <a href="#"><svg><use href="#i-layers"/></svg>Projects</a>
    </nav>
    <hr class="divider">
    <nav class="nav">
      <button class="item" id="foldersBtn" aria-expanded="true"><svg><use href="#i-folder"/></svg>Folders<svg class="trail" id="foldersChev"><use href="#i-cu"/></svg></button>
      <div class="sub" id="foldersSub"><div>
        <a href="#">View all<span class="count">18</span></a>
        <a href="#">Recent<span class="count">8</span></a>
        <a href="#">Favorites<span class="count">6</span></a>
        <a href="#">Shared<span class="count">4</span></a>
      </div></div>
    </nav>
    <hr class="divider">
    <nav class="nav">
      <a href="{{ route('admin.calendar') }}" class="active" aria-current="page"><svg><use href="#i-cal"/></svg>Calendar</a>
      <a href="#"><svg><use href="#i-gear"/></svg>Settings</a>
      <a href="#"><svg><use href="#i-support"/></svg>Support<span class="badge-online"><i class="dot"></i>Online</span></a>
      <a href="{{ route('home') }}" title="Buka Portal Pasien Gabe Medica"><svg><use href="#i-ext"/></svg>Portal Pasien<svg class="trail" style="width:14px;height:14px"><use href="#i-ext"/></svg></a>
    </nav>

    <div class="spacer"></div>
    <div class="user">
      <div class="avatar" style="background:#7c5cbf">
        {{ strtoupper(substr($admin->name ?? 'Amélie Laurent', 0, 1).substr(strstr($admin->name ?? 'Amélie Laurent', ' ') ?: 'L', 1, 1)) }}
        <i class="status"></i>
      </div>
      <div>
        <strong>{{ $admin->name ?? 'Amélie Laurent' }}</strong>
        <small>{{ $admin->email ?? 'admin@aihealth.com' }}</small>
      </div>
    </div>
    
    <!-- Logout Button -->
    <form action="{{ route('logout') }}" method="POST" class="mt-2">
      @csrf
      <button type="submit" class="logout-btn">
        <svg style="width:14px;height:14px"><use href="#i-logout"/></svg>
        <span>Keluar (Logout)</span>
      </button>
    </form>
  </aside>

  <!-- ========== MAIN ========== -->
  <main class="main">
    <div class="topbar">
      <div class="crumbs">
        <svg><use href="#i-home"/></svg><svg style="width:12px"><use href="#i-cr"/></svg>
        <span>Untitled UI</span><svg style="width:12px"><use href="#i-cr"/></svg>
        <span class="cur">Calendar (Admin)</span>
      </div>

      <div class="topbar-actions">
        <a href="{{ route('home') }}" class="switch-portal">
          <svg style="width:14px;height:14px"><use href="#i-ext"/></svg>
          <span>Ke Portal Pasien / User</span>
        </a>
        <label class="search"><svg><use href="#i-search"/></svg><input id="q" placeholder="Search" aria-label="Search"><span class="kbd">⌘K</span></label>
      </div>
    </div>

    <h1>Calendar</h1>

    <div class="tabs" role="tablist">
      <button class="tab active" role="tab">All events</button>
      <button class="tab" role="tab">Shared</button>
      <button class="tab" role="tab">Public</button>
      <button class="tab" role="tab">Archived</button>
    </div>

    <section class="card">
      <!-- Toolbar -->
      <div class="toolbar">
        <div class="date-badge"><small>Jan</small><b id="badgeDay">10</b></div>
        <div class="date-title"><h2 id="dateTitle">January 10, 2025</h2><span id="dateDow">Friday</span></div>
        <button class="btn icon" aria-label="Cari event"><svg><use href="#i-search"/></svg></button>
        <div class="seg">
          <button id="prevDay" aria-label="Sebelumnya"><svg><use href="#i-l"/></svg></button>
          <button class="today" id="todayBtn">Today</button>
          <button id="nextDay" aria-label="Berikutnya"><svg><use href="#i-r"/></svg></button>
        </div>
        <div class="menu-wrap">
          <button class="btn" id="viewBtn" aria-haspopup="true"><span id="viewLabel">Day view</span><svg><use href="#i-cd"/></svg></button>
          <div class="menu" id="viewMenu">
            <button class="sel">Day view</button><button>Week view</button><button>Month view</button><button>Year view</button>
          </div>
        </div>
        <button class="btn primary" onclick="alert('Fitur tambah event admin akan segera aktif.')"><svg><use href="#i-plus"/></svg>Add event</button>
      </div>

      <div class="body">
        <!-- Time grid -->
        <div class="grid" id="grid">
          <div class="grid-inner" id="gridInner">
            <div id="hours"></div>
            <div class="events" id="events">
              <button class="event neutral" data-id="standup" style="top:62px;height:24px"><b>Friday standup</b></button>
              <button class="event purple" data-id="olivia" style="top:124px;height:62px"><b>Olivia x Riley</b><span>10:00 AM</span></button>
              <button class="event blue selected" data-id="demo" style="top:341px;height:124px"><b>Product demo</b><span>1:30 PM</span></button>
            </div>
            <div class="now" id="now"><em id="nowLbl">2:20 PM</em></div>
          </div>
        </div>

        <!-- Right panel -->
        <aside class="panel">
          <div class="mini">
            <div class="mini-head">
              <button aria-label="Bulan sebelumnya"><svg><use href="#i-cl"/></svg></button>
              <strong>January 2025</strong>
              <button aria-label="Bulan berikutnya"><svg><use href="#i-cr"/></svg></button>
            </div>
            <div class="mini-grid" id="mini"></div>
          </div>

          <div class="detail" id="detail">
            <div class="detail-head">
              <h3 id="dTitle">Product demo</h3>
              <button aria-label="Duplicate" onclick="alert('Duplikasi event...')"><svg><use href="#i-copy"/></svg></button>
              <button aria-label="Delete" onclick="alert('Hapus event...')"><svg><use href="#i-trash"/></svg></button>
              <button aria-label="Edit" onclick="alert('Edit event...')"><svg><use href="#i-edit"/></svg></button>
            </div>
            <div class="meta"><svg><use href="#i-cal"/></svg><span id="dDate">Friday, Jan 10, 2025</span></div>
            <div class="meta"><svg><use href="#i-clock"/></svg><span id="dTime">1:30 PM - 3:30 PM</span></div>
            <div class="meta"><svg><use href="#i-bell"/></svg><span id="dRem">10 min before</span></div>

            <div class="guests" id="guests"></div>
            <div class="sum"><b id="gCount">6 guests</b> | <span id="gYes">5 yes</span> | <span id="gWait">1 awaiting</span></div>

            <div class="about">
              <h4>About this event</h4>
              <p id="dAbout">Sienna is inviting you to a scheduled Zoom meeting.</p>
              <p id="dTopic">Topic: Product demo for the new dashboard and Q&amp;A session.</p>
            </div>
          </div>
        </aside>
      </div>
    </section>
  </main>
</div>

<script>
/* ---------- Data ---------- */
const EVENTS = {
  standup:{title:"Friday standup",time:"9:00 AM - 9:30 AM",rem:"5 min before",guests:["AL","JM","KS"],yes:3,wait:0,about:"Daily team sync, held every weekday morning.",topic:"Topic: Blockers, progress, and priorities for the day."},
  olivia:{title:"Olivia x Riley",time:"10:00 AM - 11:00 AM",rem:"15 min before",guests:["OL","RI"],yes:2,wait:0,about:"One-on-one catch up between Olivia and Riley.",topic:"Topic: Quarterly goals and feedback."},
  demo:{title:"Product demo",time:"1:30 PM - 3:30 PM",rem:"10 min before",guests:["AL","JM","KS","DP","MT","OR"],yes:5,wait:1,about:"Sienna is inviting you to a scheduled Zoom meeting.",topic:"Topic: Product demo for the new dashboard and Q&A session."}
};
const COLORS=["#7c5cbf","#e07a5f","#3d8bd9","#2a9d8f","#d6a21e","#c0587e"];

/* ---------- Jam di time grid (8 AM – 5 PM) ---------- */
const hours=document.getElementById("hours");
for(let h=8;h<=17;h++){
  const lbl=(h%12||12)+" "+(h<12?"AM":"PM");
  hours.insertAdjacentHTML("beforeend",`<div class="hour"><span class="lbl">${lbl}</span><div class="line"></div></div>`);
}

/* ---------- Indikator waktu sekarang (statis 2:20 PM, sesuai template) ---------- */
function placeNow(h,m){
  const top=8+((h-8)+m/60)*62;
  document.getElementById("now").style.top=top+"px";
}
placeNow(14,20);
document.getElementById("grid").scrollTop=0;

/* ---------- Mini calendar (Januari 2025, minggu mulai Senin) ---------- */
const mini=document.getElementById("mini");
["Mo","Tu","We","Th","Fr","Sa","Su"].forEach(d=>mini.insertAdjacentHTML("beforeend",`<div class="dow">${d}</div>`));
const hasEvent=new Set(["0-1","0-30","1-4"]);   // bulan(0=Jan,1=Feb) - tanggal
let selectedKey="0-10";
const cells=[];
function addCell(day,month,out){
  const b=document.createElement("button");
  b.className="d"+(out?" out":"");
  b.textContent=day;
  b.dataset.key=month+"-"+day;
  if(hasEvent.has(b.dataset.key))b.classList.add("has");
  b.addEventListener("click",()=>selectDay(b.dataset.key,day,month));
  mini.appendChild(b);cells.push(b);
}
[30,31].forEach(d=>addCell(d,-1,true));
for(let d=1;d<=31;d++)addCell(d,0,false);
for(let d=1;d<=9;d++)addCell(d,1,true);

const DOW=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
const MON=["January","February"];
function selectDay(key,day,month){
  selectedKey=key;
  cells.forEach(c=>c.classList.toggle("sel",c.dataset.key===key));
  const date=new Date(2025,month,day);
  const name=date.toLocaleString("en-US",{month:"long"});
  document.getElementById("dateTitle").textContent=`${name} ${day}, 2025`;
  document.getElementById("dateDow").textContent=DOW[date.getDay()];
  document.getElementById("badgeDay").textContent=day;
  document.querySelector(".date-badge small").textContent=name.slice(0,3);
  document.getElementById("dDate").textContent=`${DOW[date.getDay()]}, ${name.slice(0,3)} ${day}, 2025`;
}
selectDay("0-10",10,0);

/* ---------- Prev / Today / Next ---------- */
function shift(delta){
  const [m,d]=selectedKey.split("-").map(Number);
  const date=new Date(2025,m,d+delta);
  if(date.getFullYear()!==2025||date.getMonth()>1)return;
  const key=date.getMonth()+"-"+date.getDate();
  selectDay(key,date.getDate(),date.getMonth());
}
document.getElementById("prevDay").onclick=()=>shift(-1);
document.getElementById("nextDay").onclick=()=>shift(1);
document.getElementById("todayBtn").onclick=()=>selectDay("0-10",10,0);

/* ---------- Detail event ---------- */
function renderGuests(list){
  const g=document.getElementById("guests");g.innerHTML="";
  list.forEach((ini,i)=>{
    const a=document.createElement("div");a.className="avatar";a.textContent=ini;
    a.style.background=ini==="OR"?"#8a8a8a":COLORS[i%COLORS.length];g.appendChild(a);
  });
  g.insertAdjacentHTML("beforeend",`<button class="add" aria-label="Tambah guest" onclick="alert('Tambah guest...')"><svg style="width:14px;height:14px"><use href="#i-plus"/></svg></button>`);
}
function showEvent(id){
  const e=EVENTS[id];
  document.getElementById("dTitle").textContent=e.title;
  document.getElementById("dTime").textContent=e.time;
  document.getElementById("dRem").textContent=e.rem;
  document.getElementById("dAbout").textContent=e.about;
  document.getElementById("dTopic").textContent=e.topic;
  document.getElementById("gCount").textContent=e.guests.length+" guests";
  document.getElementById("gYes").textContent=e.yes+" yes";
  document.getElementById("gWait").textContent=e.wait+" awaiting";
  renderGuests(e.guests);
  document.querySelectorAll(".event").forEach(b=>b.classList.toggle("selected",b.dataset.id===id));
}
document.querySelectorAll(".event").forEach(b=>b.addEventListener("click",()=>showEvent(b.dataset.id)));
showEvent("demo");

/* ---------- Tabs ---------- */
document.querySelectorAll(".tab").forEach(t=>t.addEventListener("click",()=>{
  document.querySelectorAll(".tab").forEach(x=>x.classList.remove("active"));
  t.classList.add("active");
}));

/* ---------- Folders collapse ---------- */
const fBtn=document.getElementById("foldersBtn"),fSub=document.getElementById("foldersSub"),fChev=document.getElementById("foldersChev");
fBtn.addEventListener("click",()=>{
  const closed=fSub.classList.toggle("closed");
  fBtn.setAttribute("aria-expanded",!closed);
  fChev.classList.toggle("rot",closed);
});

/* ---------- Dropdown view ---------- */
const vBtn=document.getElementById("viewBtn"),vMenu=document.getElementById("viewMenu");
vBtn.addEventListener("click",e=>{e.stopPropagation();vMenu.classList.toggle("open")});
vMenu.querySelectorAll("button").forEach(b=>b.addEventListener("click",()=>{
  vMenu.querySelectorAll("button").forEach(x=>x.classList.remove("sel"));
  b.classList.add("sel");
  document.getElementById("viewLabel").textContent=b.textContent;
  vMenu.classList.remove("open");
}));
document.addEventListener("click",()=>vMenu.classList.remove("open"));

/* ---------- Shortcut ⌘K / Ctrl+K ---------- */
document.addEventListener("keydown",e=>{
  if((e.metaKey||e.ctrlKey)&&e.key.toLowerCase()==="k"){e.preventDefault();document.getElementById("q").focus()}
});
</script>
</body>
</html>
