<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kalender Konsultasi Dokter — Gabe Medica</title>
<link rel="icon" type="image/png" href="{{ asset('images/gabe-medica-icon.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --bg-page: #ffffff;
    --bg-muted: #f8fafc;
    --bg-subtle: #f1f5f9;
    --border: #e2e8f0;
    --border-light: #f1f5f9;
    
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-tertiary: #94a3b8;
    --icon-default: #64748b;
    
    /* Gabe Medica Navy Brand Colors */
    --brand-primary: #012D68;
    --brand-primary-hover: #083E88;
    --brand-primary-tint: #EFF6FF;
    --brand-dark: #001F4D;
    --action-bg: #012D68;
    --action-text: #ffffff;
    
    /* Gray Booked Colors (Requirement 6) */
    --booked-bg: #F1F5F9;
    --booked-border: #CBD5E1;
    --booked-text: #334155;
    --booked-badge-bg: #E2E8F0;
    --booked-badge-text: #475569;

    --status-online: #10B981;
    --now-indicator: #012D68;

    --font-sans: "Plus Jakarta Sans", "Inter", system-ui, -apple-system, sans-serif;
    --radius-sm: 6px;
    --radius-md: 8px;
    --radius-lg: 14px;
    --radius-full: 999px;
    --shadow-xs: 0 1px 2px rgba(15, 23, 42, 0.05);
    --shadow-md: 0 4px 12px rgba(15, 23, 42, 0.08);
    --shadow-lg: 0 12px 28px rgba(15, 23, 42, 0.12);
    
    --sidebar-w: 220px;
    --panel-w: 260px;
    --hour-h: 64px;
  }
  
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: var(--font-sans);
    font-size: 13px;
    line-height: 20px;
    color: var(--text-secondary);
    background: var(--bg-muted);
    -webkit-font-smoothing: antialiased;
  }
  button { font: inherit; color: inherit; background: none; border: 0; cursor: pointer; }
  input, select, textarea { font: inherit; color: inherit; }
  svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 1.6; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
  :focus-visible { outline: 2px solid var(--brand-primary); outline-offset: 2px; }

  .app { display: flex; min-height: 100vh; background: var(--bg-page); }

  /* ===== Sidebar ===== */
  .sidebar {
    width: var(--sidebar-w);
    flex-shrink: 0;
    border-right: 1px solid var(--border);
    padding: 16px 12px;
    display: flex;
    flex-direction: column;
    background: var(--bg-page);
    position: sticky;
    top: 0;
    height: 100vh;
  }
  .brand {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 4px 6px 18px;
    color: var(--text-primary);
    font-weight: 700;
    font-size: 14px;
  }
  .brand img {
    height: 32px;
    width: auto;
    object-fit: contain;
  }
  .role-indicator-badge {
    font-size: 10px;
    font-weight: 700;
    background: var(--brand-primary-tint);
    border: 1px solid #BFDBFE;
    color: var(--brand-primary);
    border-radius: 4px;
    padding: 2px 6px;
    margin-left: auto;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .nav { display: flex; flex-direction: column; gap: 3px; }
  .nav a, .nav button.item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 10px;
    border-radius: var(--radius-md);
    color: var(--text-secondary);
    text-decoration: none;
    width: 100%;
    text-align: left;
    font-weight: 500;
    transition: all .15s;
  }
  .nav a svg, .nav button.item svg { width: 18px; height: 18px; color: var(--icon-default); }
  .nav a:hover, .nav button.item:hover { background: var(--bg-subtle); color: var(--text-primary); }
  .nav a.active { background: var(--brand-primary-tint); color: var(--brand-primary); font-weight: 700; }
  .nav a.active svg { color: var(--brand-primary); }
  hr.divider { border: 0; border-top: 1px solid var(--border); margin: 12px 0; }
  
  .spacer { flex: 1; }
  .user {
    display: flex;
    align-items: center;
    gap: 10px;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 10px;
    box-shadow: var(--shadow-xs);
    position: relative;
    background: #fff;
  }
  .avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    font-size: 12px;
    font-weight: 700;
    color: #fff;
    background: var(--brand-primary);
    position: relative;
    flex-shrink: 0;
  }
  .user .status {
    position: absolute;
    right: -1px;
    bottom: -1px;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: var(--status-online);
    border: 2px solid #fff;
  }
  .user strong { display: block; font-size: 12px; color: var(--text-primary); line-height: 16px; font-weight: 600; }
  .user small { display: block; font-size: 11px; color: var(--text-tertiary); line-height: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 110px; }
  
  .logout-btn {
    margin-top: 8px;
    width: 100%;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 11.5px;
    font-weight: 500;
    border-radius: var(--radius-md);
    border: 1px solid var(--border);
    background: #fff;
    color: var(--text-secondary);
    transition: all .15s;
  }
  .logout-btn:hover { background: #fee2e2; border-color: #fca5a5; color: #dc2626; }

  /* ===== Main ===== */
  .main { flex: 1; min-width: 0; padding: 20px 24px 32px; }
  
  /* Topbar */
  .topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 18px;
  }
  .crumbs { display: flex; align-items: center; gap: 6px; color: var(--text-tertiary); font-size: 12px; }
  .crumbs .cur {
    background: var(--bg-subtle);
    border-radius: var(--radius-sm);
    padding: 2px 8px;
    color: var(--text-secondary);
    font-weight: 600;
    border: 1px solid var(--border);
  }
  
  .topbar-actions { display: flex; align-items: center; gap: 10px; }
  
  /* Role View Switcher Segmented Control */
  .mode-switcher {
    display: inline-flex;
    align-items: center;
    background: #e2e8f0;
    padding: 2.5px;
    border-radius: 999px;
    border: 1px solid var(--border);
  }
  .mode-btn {
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 600;
    color: var(--text-secondary);
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .mode-btn.active {
    background: #ffffff;
    color: var(--brand-primary);
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }
  
  .search {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 210px;
    height: 36px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 0 10px;
    box-shadow: var(--shadow-xs);
    background: #fff;
    color: var(--text-tertiary);
  }
  .search input { border: 0; outline: 0; flex: 1; font: inherit; min-width: 0; background: transparent; color: var(--text-primary); }
  .kbd { font-size: 10px; font-weight: 600; border: 1px solid var(--border); border-radius: 4px; padding: 0 5px; line-height: 16px; }

  /* Page Heading & Doctor Tabs (Requirement 3) */
  .heading-wrapper {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    margin-bottom: 12px;
  }
  h1 { font-size: 21px; line-height: 28px; font-weight: 700; letter-spacing: -0.01em; color: var(--text-primary); }
  .view-badge-indicator {
    font-size: 11.5px;
    font-weight: 600;
    color: var(--brand-primary);
    background: var(--brand-primary-tint);
    padding: 3px 10px;
    border-radius: 999px;
    border: 1px solid #BFDBFE;
  }

  /* Doctor Filter Tabs (Replaces All events, shared, public, archived) */
  .tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    background: var(--bg-muted);
    border: 1px solid var(--border);
    padding: 3px;
    border-radius: var(--radius-md);
    margin-bottom: 16px;
    width: fit-content;
    max-width: 100%;
  }
  .tab {
    height: 30px;
    padding: 0 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    color: var(--text-secondary);
    border: 1px solid transparent;
    transition: all 0.15s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
  }
  .tab .dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--text-tertiary);
  }
  .tab:hover { color: var(--text-primary); background: rgba(255,255,255,0.6); }
  .tab.active {
    background: #ffffff;
    color: var(--brand-primary);
    border-color: var(--border);
    box-shadow: var(--shadow-xs);
  }
  .tab.active .dot { background: var(--brand-primary); }

  /* ===== Calendar Card ===== */
  .card {
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    background: #fff;
    overflow: hidden;
    box-shadow: var(--shadow-xs);
  }
  
  /* Toolbar */
  .toolbar {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    border-bottom: 1px solid var(--border);
    flex-wrap: wrap;
    background: #ffffff;
  }
  .date-badge {
    width: 42px;
    height: 44px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    text-align: center;
    box-shadow: var(--shadow-xs);
    overflow: hidden;
  }
  .date-badge small {
    display: block;
    font-size: 10px;
    line-height: 15px;
    font-weight: 700;
    color: var(--text-tertiary);
    background: var(--bg-muted);
    border-bottom: 1px solid var(--border);
    text-transform: uppercase;
  }
  .date-badge b { display: block; font-size: 16px; line-height: 24px; color: var(--text-primary); font-weight: 800; }
  
  .date-title { margin-right: auto; margin-left: 4px; }
  .date-title h2 { font-size: 16px; line-height: 22px; font-weight: 700; letter-spacing: -0.01em; color: var(--text-primary); }
  .date-title span { font-size: 12px; color: var(--text-tertiary); line-height: 16px; display: block; }
  
  .btn {
    height: 36px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 0 12px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
    font-size: 12.5px;
    background: #fff;
    box-shadow: var(--shadow-xs);
    color: var(--text-primary);
    transition: all .15s;
  }
  .btn:hover { background: var(--bg-subtle); border-color: #cbd5e1; }
  .btn.icon { width: 36px; padding: 0; justify-content: center; border: 0; box-shadow: none; color: var(--icon-default); }
  .btn.primary {
    background: var(--brand-primary);
    color: #ffffff;
    border-color: var(--brand-primary);
  }
  .btn.primary:hover { background: var(--brand-primary-hover); }
  
  .seg { display: inline-flex; border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-xs); overflow: hidden; }
  .seg button { height: 34px; min-width: 34px; display: grid; place-items: center; color: var(--icon-default); transition: background .15s; }
  .seg button:hover { background: var(--bg-subtle); color: var(--text-primary); }
  .seg button.today { padding: 0 16px; border-inline: 1px solid var(--border); font-weight: 600; font-size: 12px; color: var(--text-primary); }

  /* Body: Time Grid & Right Panel */
  .body {
    display: grid;
    grid-template-columns: 1fr var(--panel-w);
    height: 580px;
  }

  /* Time Grid */
  .grid {
    overflow-y: auto;
    position: relative;
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 transparent;
  }
  .grid-inner {
    position: relative;
    height: calc(var(--hour-h) * 10 + 16px);
    padding-top: 10px;
  }
  .hour { display: flex; height: var(--hour-h); }
  .hour .lbl {
    width: 60px;
    flex-shrink: 0;
    text-align: right;
    padding-right: 12px;
    font-size: 11px;
    font-weight: 600;
    color: var(--text-tertiary);
    transform: translateY(-9px);
  }
  .hour .line { flex: 1; border-top: 1px solid var(--border-light); position: relative; }
  .hour .line::after { content: ""; position: absolute; left: 0; right: 0; top: 50%; border-top: 1px dashed #f1f5f9; }

  /* Events Container */
  .events { position: absolute; left: 60px; right: 0; top: 10px; bottom: 0; }
  
  /* Generic event card style */
  .event {
    position: absolute;
    left: 6px;
    right: 12px;
    border-radius: var(--radius-md);
    padding: 8px 12px;
    border: 1px solid;
    font-size: 11.5px;
    line-height: 16px;
    overflow: hidden;
    cursor: pointer;
    transition: all .2s ease;
    text-align: left;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .event:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-1px);
  }
  .event.selected {
    border-width: 1.5px !important;
    box-shadow: 0 0 0 3px rgba(1, 45, 104, 0.16) !important;
  }

  /* Gray Booked Event Styling (Requirement 6) */
  .event.booked {
    background: var(--booked-bg) !important;
    border-color: var(--booked-border) !important;
    color: var(--booked-text) !important;
  }
  .event.booked:hover {
    background: #e2e8f0 !important;
    border-color: #94a3b8 !important;
  }
  
  .event-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 2px;
  }
  .event-header b {
    font-size: 12px;
    font-weight: 700;
    color: #1e293b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  
  /* Badge 'Sudah Terbook' */
  .badge-booked {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: var(--booked-badge-bg);
    color: var(--booked-badge-text);
    font-size: 9.5px;
    font-weight: 700;
    padding: 1px 6px;
    border-radius: 4px;
    border: 1px solid #cbd5e1;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    flex-shrink: 0;
  }
  .badge-booked::before {
    content: "";
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #64748b;
  }

  .event-meta {
    font-size: 11px;
    font-weight: 500;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* Current time red/navy line */
  .now {
    position: absolute;
    left: 0;
    right: 0;
    border-top: 1.5px solid var(--now-indicator);
    pointer-events: none;
    z-index: 10;
  }
  .now::before {
    content: "";
    position: absolute;
    left: 56px;
    top: -4.5px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--now-indicator);
  }
  .now em {
    position: absolute;
    left: 0;
    top: -10px;
    width: 52px;
    text-align: right;
    font-style: normal;
    font-size: 10.5px;
    font-weight: 700;
    color: var(--brand-primary);
    background: #fff;
    padding-right: 4px;
  }

  /* ===== Right Side Panel ===== */
  .panel {
    border-left: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    min-height: 0;
    background: #fafbfc;
  }
  
  /* Mini Calendar Month Picker */
  .mini { padding: 14px 14px 10px; background: #fff; border-bottom: 1px solid var(--border); }
  .mini-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;
  }
  .mini-head strong { font-size: 13px; color: var(--text-primary); font-weight: 700; }
  .mini-head button {
    width: 24px;
    height: 24px;
    border-radius: 6px;
    display: grid;
    place-items: center;
    color: var(--icon-default);
  }
  .mini-head button:hover { background: var(--bg-subtle); color: var(--text-primary); }
  
  .mini-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    row-gap: 3px;
    text-align: center;
  }
  .mini-grid .dow {
    font-size: 10.5px;
    font-weight: 700;
    color: var(--text-tertiary);
    line-height: 22px;
    text-transform: uppercase;
  }
  .d {
    width: 26px;
    height: 26px;
    margin: 0 auto;
    border-radius: 50%;
    font-size: 11.5px;
    font-weight: 500;
    color: var(--text-secondary);
    position: relative;
    display: grid;
    place-items: center;
    transition: all .15s;
  }
  .d:hover { background: var(--bg-subtle); color: var(--text-primary); }
  .d.out { color: #cbd5e1; }
  .d.sel {
    background: var(--brand-primary) !important;
    color: #fff !important;
    font-weight: 700;
    box-shadow: 0 2px 6px rgba(1, 45, 104, 0.3);
  }
  .d.has::after {
    content: "";
    position: absolute;
    bottom: 2px;
    left: 50%;
    width: 3.5px;
    height: 3.5px;
    margin-left: -1.75px;
    border-radius: 50%;
    background: var(--brand-primary);
  }
  .d.sel.has::after { background: #ffffff; }

  /* Event / Booking Details in Right Panel */
  .detail {
    padding: 16px;
    flex: 1;
    overflow-y: auto;
    position: relative;
    scrollbar-width: thin;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .detail-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 8px;
  }
  .detail-head h3 {
    font-size: 14.5px;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 20px;
  }
  .detail-meta-list {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .meta-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: var(--text-secondary);
  }
  .meta-row svg { color: var(--icon-default); width: 15px; height: 15px; }
  
  /* Medical Information Cards (Admin View - Requirement 6) */
  .medical-info-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 10px 12px;
    margin-top: 4px;
    box-shadow: var(--shadow-xs);
  }
  .medical-info-card h4 {
    font-size: 11.5px;
    font-weight: 700;
    color: var(--brand-primary);
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 5px;
  }
  .medical-info-card p {
    font-size: 12px;
    line-height: 17px;
    color: var(--text-primary);
    word-break: break-word;
  }

  /* Privacy Notice for Patient View (Requirement 2) */
  .patient-privacy-notice {
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
    border-radius: 10px;
    padding: 12px;
    font-size: 11.5px;
    color: var(--text-secondary);
    line-height: 17px;
  }
  .patient-privacy-notice b { color: var(--text-primary); }

  /* Detail Action Buttons */
  .detail-actions {
    margin-top: auto;
    padding-top: 12px;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .btn-danger {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #b91c1c;
    font-size: 12px;
    font-weight: 600;
    height: 36px;
    border-radius: var(--radius-md);
    transition: background .15s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }
  .btn-danger:hover { background: #fee2e2; }

  /* ===== Interactive Booking Modal (Requirements 4 & 5) ===== */
  .modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.45);
    backdrop-filter: blur(4px);
    z-index: 100;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.25s ease;
  }
  .modal-backdrop.open {
    opacity: 1;
    pointer-events: auto;
  }
  .modal {
    position: fixed;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -48%) scale(0.97);
    width: 92%;
    max-width: 520px;
    background: #ffffff;
    border-radius: 20px;
    padding: 24px;
    z-index: 101;
    box-shadow: var(--shadow-lg);
    opacity: 0;
    pointer-events: none;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    max-height: 90vh;
    overflow-y: auto;
  }
  .modal.open {
    transform: translate(-50%, -50%) scale(1);
    opacity: 1;
    pointer-events: auto;
  }
  .modal-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
  }
  .modal-head h3 { font-size: 17px; font-weight: 700; color: var(--brand-primary); }
  .modal-close {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    color: var(--icon-default);
  }
  .modal-close:hover { background: var(--bg-subtle); color: var(--text-primary); }
  
  .form-group { margin-bottom: 14px; }
  .form-group label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 5px;
  }
  .form-control {
    width: 100%;
    height: 40px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 0 12px;
    font-size: 13px;
    background: #fff;
    color: var(--text-primary);
    transition: border-color .15s;
  }
  .form-control:focus {
    border-color: var(--brand-primary);
    box-shadow: 0 0 0 3px rgba(1, 45, 104, 0.15);
  }
  textarea.form-control {
    height: 72px;
    padding: 8px 12px;
    resize: vertical;
  }

  .alert-warning-box {
    background: #fffbeb;
    border: 1px solid #fde68a;
    border-radius: 8px;
    padding: 10px 12px;
    color: #92400e;
    font-size: 12px;
    margin-bottom: 14px;
    display: none;
  }

  /* Toast notification */
  .toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #0f172a;
    color: #fff;
    padding: 10px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    box-shadow: var(--shadow-lg);
    z-index: 200;
    opacity: 0;
    transform: translateY(-10px);
    pointer-events: none;
    transition: all 0.25s ease;
  }
  .toast.show {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
  }

  /* Responsive styling */
  @media (max-width: 1024px) {
    :root { --panel-w: 230px; }
  }
  @media (max-width: 860px) {
    .sidebar { display: none; }
    .main { padding: 14px; }
    .body { grid-template-columns: 1fr; height: auto; }
    .grid { height: 480px; }
    .panel { border-left: 0; border-top: 1px solid var(--border); }
    .search { width: 100%; }
    .topbar { flex-wrap: wrap; }
    .heading-wrapper { flex-direction: column; gap: 8px; }
  }
</style>
</head>
<body>

<!-- SVG Icons Sprite -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="i-home" viewBox="0 0 24 24"><path d="M3 10.5 12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/></symbol>
    <symbol id="i-dash" viewBox="0 0 24 24"><path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/></symbol>
    <symbol id="i-cal" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></symbol>
    <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></symbol>
    <symbol id="i-doc" viewBox="0 0 24 24"><path d="M6 3h8l5 5v13H6z"/><path d="M14 3v5h5M9 13h6M9 17h6"/></symbol>
    <symbol id="i-gear" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></symbol>
    <symbol id="i-ext" viewBox="0 0 24 24"><path d="M14 4h6v6M20 4 10 14M18 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h5"/></symbol>
    <symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></symbol>
    <symbol id="i-l" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></symbol>
    <symbol id="i-r" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></symbol>
    <symbol id="i-cl" viewBox="0 0 24 24"><path d="m15 18-6-6 6-6"/></symbol>
    <symbol id="i-cr" viewBox="0 0 24 24"><path d="m9 18 6-6-6-6"/></symbol>
    <symbol id="i-cd" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></symbol>
    <symbol id="i-plus" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></symbol>
    <symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
    <symbol id="i-trash" viewBox="0 0 24 24"><path d="M4 7h16M10 11v6M14 11v6M6 7l1 12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2l1-12M9 7V4h6v3"/></symbol>
    <symbol id="i-logout" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></symbol>
    <symbol id="i-close" viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12"/></symbol>
    <symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></symbol>
    <symbol id="i-stethoscope" viewBox="0 0 24 24"><path d="M4.5 3v5a4.5 4.5 0 0 0 9 0V3M19 10v2a7 7 0 0 1-14 0v-2M9 19v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2"/><circle cx="18" cy="10" r="1"/></symbol>
  </defs>
</svg>

<div class="app">
  <!-- ========== SIDEBAR (Requirement 1: Sama Bentuknya) ========== -->
  <aside class="sidebar">
    <div class="brand">
      <a href="{{ route('home') }}" title="Gabe Medica">
        <img src="{{ asset('images/gabe-medica-logo.png') }}" alt="Gabe Medica" />
      </a>
      <span id="sidebarRoleBadge" class="role-indicator-badge">Admin</span>
    </div>

    <nav class="nav" aria-label="Navigasi utama">
      <a href="{{ route('home') }}">
        <svg><use href="#i-home"/></svg>
        <span>Beranda Pasien</span>
      </a>
      <a href="javascript:void(0)" class="active" aria-current="page">
        <svg><use href="#i-cal"/></svg>
        <span>Jadwal Dokter</span>
      </a>
      <a href="{{ route('home') }}#doctors-grid">
        <svg><use href="#i-user"/></svg>
        <span>Daftar Dokter</span>
      </a>
    </nav>

    <hr class="divider">

    <div class="spacer"></div>

    <!-- Active User Card -->
    <div class="user">
      <div class="avatar" id="sidebarAvatar">
        {{ $user['initials'] ?? 'AL' }}
        <i class="status"></i>
      </div>
      <div>
        <strong id="sidebarUserName">{{ $user['name'] ?? 'Amélie Laurent' }}</strong>
        <small id="sidebarUserRole">{{ $user['role'] ?? 'Administrator' }}</small>
      </div>
    </div>
    
    <!-- Logout / Back Button -->
    <form action="{{ route('logout') }}" method="POST" class="mt-2">
      @csrf
      <button type="submit" class="logout-btn">
        <svg style="width:14px;height:14px"><use href="#i-logout"/></svg>
        <span>Keluar Portal</span>
      </button>
    </form>
  </aside>

  <!-- ========== MAIN CONTENT ========== -->
  <main class="main">
    <!-- Topbar with Mode Toggle -->
    <div class="topbar">
      <div class="crumbs">
        <svg><use href="#i-home"/></svg>
        <svg style="width:12px"><use href="#i-cr"/></svg>
        <span>Gabe Medica</span>
        <svg style="width:12px"><use href="#i-cr"/></svg>
        <span class="cur" id="crumbModeTitle">Kalender (Admin)</span>
      </div>

      <div class="topbar-actions">
        <!-- Interactive View Switcher (Admin vs Pasien) -->
        <div class="mode-switcher" title="Ganti tampilan antara Mode Pasien dan Mode Admin">
          <button id="modePatientBtn" class="mode-btn" onclick="setCalendarRole('patient')">
            <svg style="width:13px;height:13px"><use href="#i-stethoscope"/></svg>
            <span>Mode Pasien</span>
          </button>
          <button id="modeAdminBtn" class="mode-btn active" onclick="setCalendarRole('admin')">
            <svg style="width:13px;height:13px"><use href="#i-shield"/></svg>
            <span>Mode Admin</span>
          </button>
        </div>

        <!-- Quick Search -->
        <label class="search">
          <svg><use href="#i-search"/></svg>
          <input id="q" placeholder="Cari jadwal dokter..." aria-label="Cari jadwal">
          <span class="kbd">⌘K</span>
        </label>
      </div>
    </div>

    <!-- Heading & Role Status -->
    <div class="heading-wrapper">
      <div>
        <h1>Kalender Jadwal Dokter</h1>
        <p style="font-size:12px;color:var(--text-tertiary);margin-top:2px;">Kelola dan tinjau ketersediaan jam praktik konsultasi di klinik Gabe Medica.</p>
      </div>
      <div id="roleBadgeIndicator" class="view-badge-indicator">
        Mode: Administrator Klinik
      </div>
    </div>

    <!-- Doctor Filter Tabs (Requirement 3: all events, shared, public, archived diganti nama-nama dokter) -->
    <div class="tabs" role="tablist" aria-label="Filter Dokter">
      <button class="tab active" data-doctor="all" onclick="filterDoctor('all')">
        <span class="dot"></span>Semua Dokter
      </button>
      <button class="tab" data-doctor="dr-lina" onclick="filterDoctor('dr-lina')">
        <span class="dot" style="background:#E11D48"></span>Dr. Lina Wijaya (Cardiologist)
      </button>
      <button class="tab" data-doctor="dr-anaya" onclick="filterDoctor('dr-anaya')">
        <span class="dot" style="background:#4F46E5"></span>Dr. Anaya Kapoor (Neurologist)
      </button>
      <button class="tab" data-doctor="dr-saran" onclick="filterDoctor('dr-saran')">
        <span class="dot" style="background:#012D68"></span>Dr. Saran Mitchell (Orthopedist)
      </button>
    </div>

    <!-- Main Calendar Card -->
    <section class="card">
      <!-- Toolbar -->
      <div class="toolbar">
        <div class="date-badge">
          <small id="badgeMonth">Jan</small>
          <b id="badgeDay">10</b>
        </div>
        <div class="date-title">
          <h2 id="dateTitle">January 10, 2025</h2>
          <span id="dateDow">Friday</span>
        </div>

        <div class="seg">
          <button id="prevDay" aria-label="Hari sebelumnya"><svg><use href="#i-l"/></svg></button>
          <button class="today" id="todayBtn">Hari Ini</button>
          <button id="nextDay" aria-label="Hari berikutnya"><svg><use href="#i-r"/></svg></button>
        </div>

        <div style="margin-left:auto; display:flex; gap:8px; align-items:center;">
          <!-- Action Button (Booking Jadwal) -->
          <button id="btnOpenBookingModal" class="btn primary" onclick="openBookingModal()">
            <svg><use href="#i-plus"/></svg>
            <span id="btnActionText">+ Booking Jadwal</span>
          </button>
        </div>
      </div>

      <!-- Body: Time Grid & Right Detail Panel -->
      <div class="body">
        <!-- Left: Time Grid (8 AM - 5 PM) -->
        <div class="grid" id="grid">
          <div class="grid-inner" id="gridInner">
            <!-- Hour Rows (8 AM to 5 PM) -->
            <div id="hoursContainer"></div>

            <!-- Dynamic Booked Events (Requirement 6: Abu-Abu & Sudah Terbook) -->
            <div class="events" id="eventsContainer"></div>

            <!-- Red/Navy Current Time Indicator -->
            <div class="now" id="nowIndicator">
              <em id="nowTimeLbl">2:20 PM</em>
            </div>
          </div>
        </div>

        <!-- Right Side Panel: Mini Calendar & Details (Requirement 2 & 6) -->
        <aside class="panel">
          <!-- Mini Month Picker -->
          <div class="mini">
            <div class="mini-head">
              <button aria-label="Bulan sebelumnya" onclick="shiftMonth(-1)"><svg><use href="#i-cl"/></svg></button>
              <strong id="miniMonthTitle">January 2025</strong>
              <button aria-label="Bulan berikutnya" onclick="shiftMonth(1)"><svg><use href="#i-cr"/></svg></button>
            </div>
            <div class="mini-grid" id="miniGrid"></div>
          </div>

          <!-- Selected Slot / Booking Details -->
          <div class="detail" id="detailPanel">
            <div class="detail-head">
              <h3 id="dTitle">Detail Konsultasi</h3>
            </div>
            
            <div class="detail-meta-list">
              <div class="meta-row">
                <svg><use href="#i-cal"/></svg>
                <span id="dDate">Friday, Jan 10, 2025</span>
              </div>
              <div class="meta-row">
                <svg><use href="#i-clock"/></svg>
                <span id="dTime">09:00 AM - 10:00 AM</span>
              </div>
              <div class="meta-row">
                <svg><use href="#i-user"/></svg>
                <span id="dDoctor">Dr. Lina Wijaya (Cardiologist)</span>
              </div>
            </div>

            <!-- Dynamic Medical Information (Admin View) or Privacy Notice (Patient View) -->
            <div id="dMedicalInfoSection"></div>

            <!-- Actions in Detail Panel -->
            <div class="detail-actions" id="dActionsSection"></div>
          </div>
        </aside>
      </div>
    </section>
  </main>
</div>

<!-- ========================================== -->
<!-- Interactive Booking Modal (Requirements 4 & 5) -->
<!-- ========================================== -->
<div id="bookingModalBackdrop" class="modal-backdrop" onclick="closeBookingModal()"></div>
<div id="bookingModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="modal-head">
    <h3 id="modalTitle">Booking Jadwal Konsultasi Dokter</h3>
    <button class="modal-close" onclick="closeBookingModal()" aria-label="Tutup Modal">
      <svg><use href="#i-close"/></svg>
    </button>
  </div>

  <div id="modalAlertBox" class="alert-warning-box"></div>

  <form id="bookingForm" onsubmit="handleBookingSubmit(event)">
    <div class="form-group">
      <label for="bmDoctor">Pilih Dokter Spesialis:</label>
      <select id="bmDoctor" class="form-control" required onchange="checkSlotAvailability()">
        <option value="dr-lina">Dr. Lina Wijaya — Spesialis Jantung (Cardiologist)</option>
        <option value="dr-anaya">Dr. Anaya Kapoor — Spesialis Saraf (Neurologist)</option>
        <option value="dr-saran" selected>Dr. Saran Mitchell — Spesialis Tulang (Orthopedist)</option>
      </select>
    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
      <div class="form-group">
        <label for="bmDate">Tanggal Konsultasi:</label>
        <input type="date" id="bmDate" class="form-control" value="2025-01-10" required onchange="checkSlotAvailability()">
      </div>

      <div class="form-group">
        <label for="bmHour">Jam Praktik:</label>
        <select id="bmHour" class="form-control" required onchange="checkSlotAvailability()">
          <option value="8">08:00 AM - 09:00 AM</option>
          <option value="9">09:00 AM - 10:00 AM</option>
          <option value="10">10:00 AM - 11:00 AM</option>
          <option value="11">11:00 AM - 12:00 PM</option>
          <option value="12">12:00 PM - 01:00 PM</option>
          <option value="13">01:00 PM - 02:00 PM</option>
          <option value="14" selected>02:00 PM - 03:00 PM</option>
          <option value="15">03:00 PM - 04:00 PM</option>
          <option value="16">04:00 PM - 05:00 PM</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="bmPatientName">Nama Lengkap Pasien:</label>
      <input type="text" id="bmPatientName" class="form-control" placeholder="Masukkan nama pasien..." required value="{{ $user['name'] ?? 'Rina Anggraini' }}">
    </div>

    <div class="form-group">
      <label for="bmKeluhan">Keluhan Utama (Gejala yang Dirasakan):</label>
      <textarea id="bmKeluhan" class="form-control" placeholder="Contoh: Nyeri persendian lutut kanan sejak 3 hari, terasa sakit saat berjalan..." required></textarea>
    </div>

    <div class="form-group">
      <label for="bmRiwayat">Riwayat Penyakit Sebelumnya / Alergi Obat:</label>
      <textarea id="bmRiwayat" class="form-control" placeholder="Contoh: Tidak ada riwayat hipertensi, alergi terhadap antibiotik penisilin..."></textarea>
    </div>

    <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
      <button type="button" class="btn" onclick="closeBookingModal()">Batal</button>
      <button type="submit" id="bmSubmitBtn" class="btn primary">
        <span>Konfirmasi Booking</span>
      </button>
    </div>
  </form>
</div>

<!-- Global Toast Notification -->
<div id="appToast" class="toast"></div>

<!-- ========================================== -->
<!-- Script Logika Kalender (Requirements 2, 4, 5, 6) -->
<!-- ========================================== -->
<script>
/* ---------- Data Master Dokter (Requirement 3) ---------- */
const DOCTORS = {
  'dr-lina': { id: 'dr-lina', name: 'Dr. Lina Wijaya', specialty: 'Cardiologist', color: '#E11D48' },
  'dr-anaya': { id: 'dr-anaya', name: 'Dr. Anaya Kapoor', specialty: 'Neurologist', color: '#4F46E5' },
  'dr-saran': { id: 'dr-saran', name: 'Dr. Saran Mitchell', specialty: 'Orthopedist', color: '#012D68' }
};

/* ---------- Data Booking Mock Awal (Requirement 5: Logika Tanpa Database) ---------- */
const DEFAULT_BOOKINGS = [
  {
    id: 'b-1',
    date: '2025-01-10',
    doctorId: 'dr-lina',
    doctorName: 'Dr. Lina Wijaya',
    specialty: 'Cardiologist',
    startHour: 9, // 9:00 AM
    durationHours: 1,
    patientName: 'Rina Anggraini',
    patientInitials: 'RA',
    keluhan: 'Nyeri dada sebelah kiri dan sesak napas ringan setelah berolahraga.',
    riwayatPenyakit: 'Hipertensi grade 1 (terkontrol rutin), tidak ada riwayat alergi obat.',
    status: 'booked'
  },
  {
    id: 'b-2',
    date: '2025-01-10',
    doctorId: 'dr-anaya',
    doctorName: 'Dr. Anaya Kapoor',
    specialty: 'Neurologist',
    startHour: 10, // 10:00 AM
    durationHours: 1,
    patientName: 'Budi Santoso',
    patientInitials: 'BS',
    keluhan: 'Migrain berdenyut di sisi kepala kanan sejak 3 hari berturut-turut.',
    riwayatPenyakit: 'Riwayat vertigo tahun 2022, alergi obat paracetamol.',
    status: 'booked'
  },
  {
    id: 'b-3',
    date: '2025-01-10',
    doctorId: 'dr-saran',
    doctorName: 'Dr. Saran Mitchell',
    specialty: 'Orthopedist',
    startHour: 13.5, // 1:30 PM (13:30)
    durationHours: 1.5,
    patientName: 'Dewi Lestari',
    patientInitials: 'DL',
    keluhan: 'Nyeri dan pembengkakan pada lutut kanan setelah cedera saat bermain bulutangkis.',
    riwayatPenyakit: 'Dislokasi bahu kanan tahun 2019, tidak ada alergi.',
    status: 'booked'
  }
];

/* Ambil data dari localStorage agar perubahan sesi bertahan secara lokal tanpa DB */
function loadBookings() {
  try {
    const saved = localStorage.getItem('gabe_medica_calendar_bookings');
    if (saved) return JSON.parse(saved);
  } catch (e) {
    console.error('Error loading bookings from localStorage', e);
  }
  return [...DEFAULT_BOOKINGS];
}

function saveBookings(data) {
  try {
    localStorage.setItem('gabe_medica_calendar_bookings', JSON.stringify(data));
  } catch (e) {
    console.error('Error saving bookings to localStorage', e);
  }
}

let BOOKINGS = loadBookings();

/* State Kalender */
let currentRole = "{{ $role ?? 'admin' }}"; // 'admin' atau 'patient'
let activeDoctorFilter = 'all'; // 'all', 'dr-lina', 'dr-anaya', 'dr-saran'
let selectedDateStr = '2025-01-10'; // YYYY-MM-DD
let activeBookingId = 'b-3';

const DOW_NAMES = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const MONTH_NAMES = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

/* ---------- Render Jam di Time Grid (8 AM – 5 PM) ---------- */
function initHourGrid() {
  const container = document.getElementById("hoursContainer");
  container.innerHTML = "";
  for (let h = 8; h <= 17; h++) {
    const lbl = (h % 12 || 12) + " " + (h < 12 ? "AM" : "PM");
    container.insertAdjacentHTML("beforeend", `
      <div class="hour" data-hour="${h}">
        <span class="lbl">${lbl}</span>
        <div class="line" onclick="handleEmptySlotClick(${h})" title="Klik untuk booking di jam ${lbl}"></div>
      </div>
    `);
  }
}

/* Format Jam Desimal ke Teks Waktu */
function formatHourDecimal(dec) {
  const h = Math.floor(dec);
  const m = Math.round((dec - h) * 60);
  const period = h < 12 ? "AM" : "PM";
  const displayH = (h % 12 || 12);
  const displayM = m < 10 ? "0" + m : m;
  return `${displayH}:${displayM} ${period}`;
}

/* ---------- Render Events ke Grid (Requirement 2 & 6: Abu-abu & Sudah Terbook) ---------- */
function renderEvents() {
  const container = document.getElementById("eventsContainer");
  container.innerHTML = "";

  // Filter booking berdasarkan tanggal aktif dan dokter aktif
  const filtered = BOOKINGS.filter(b => {
    const matchDate = b.date === selectedDateStr;
    const matchDoctor = (activeDoctorFilter === 'all') || (b.doctorId === activeDoctorFilter);
    return matchDate && matchDoctor;
  });

  filtered.forEach(b => {
    const topPx = (b.startHour - 8) * 64;
    const heightPx = Math.max(b.durationHours * 64 - 4, 38);
    const isSelected = b.id === activeBookingId;

    const startTimeStr = formatHourDecimal(b.startHour);
    const endTimeStr = formatHourDecimal(b.startHour + b.durationHours);

    // Requirement 2:
    // Jika Admin: Tampilkan Nama Pasien + Badge Sudah Terbook
    // Jika Pasien: Tampilkan 'Sudah Terbook' + 'Booked' (Nama Pasien Tersembunyi demi Privasi)
    const titleText = currentRole === 'admin' ? b.patientName : 'Sudah Terbook';
    const subText = `${startTimeStr} - ${endTimeStr} · ${b.doctorName}`;

    const btn = document.createElement("button");
    btn.className = `event booked ${isSelected ? 'selected' : ''}`;
    btn.dataset.id = b.id;
    btn.style.top = topPx + "px";
    btn.style.height = heightPx + "px";

    btn.innerHTML = `
      <div class="event-header">
        <b>${titleText}</b>
        <span class="badge-booked">Sudah Terbook</span>
      </div>
      <div class="event-meta">
        <svg style="width:13px;height:13px;"><use href="#i-clock"/></svg>
        <span>${subText}</span>
      </div>
    `;

    btn.addEventListener("click", () => selectBooking(b.id));
    container.appendChild(btn);
  });

  // Perbarui detail panel
  renderDetailPanel();
}

/* ---------- Render Detail Panel (Requirement 2 & 6) ---------- */
function renderDetailPanel() {
  const booking = BOOKINGS.find(b => b.id === activeBookingId);
  const dTitle = document.getElementById("dTitle");
  const dDate = document.getElementById("dDate");
  const dTime = document.getElementById("dTime");
  const dDoctor = document.getElementById("dDoctor");
  const infoSec = document.getElementById("dMedicalInfoSection");
  const actSec = document.getElementById("dActionsSection");

  if (!booking) {
    dTitle.textContent = "Slot Jadwal Tersedia";
    dDate.textContent = formatDateDisplay(selectedDateStr);
    dTime.textContent = "Pilih slot untuk reservasi";
    dDoctor.textContent = activeDoctorFilter !== 'all' ? DOCTORS[activeDoctorFilter].name : "Semua Dokter Praktik";
    
    infoSec.innerHTML = `
      <div class="patient-privacy-notice">
        <b>Status: Slot Kosong</b><br>
        Slot pada jam dan tanggal ini belum terbooking. Anda dapat membuat janji konsultasi baru dengan mengklik tombol di bawah ini.
      </div>
    `;
    actSec.innerHTML = `
      <button class="btn primary" style="width:100%;height:38px;justify-content:center;" onclick="openBookingModal()">
        + Booking di Slot Ini
      </button>
    `;
    return;
  }

  // Waktu format
  const startStr = formatHourDecimal(booking.startHour);
  const endStr = formatHourDecimal(booking.startHour + booking.durationHours);
  
  dDate.textContent = formatDateDisplay(booking.date);
  dTime.textContent = `${startStr} - ${endStr}`;
  dDoctor.textContent = `${booking.doctorName} (${booking.specialty})`;

  // Requirement 2 & 6:
  // TAMPILAN ADMIN: Ada Nama Pasien, Keluhan, dan Riwayat Penyakit Sebelumnya
  if (currentRole === 'admin') {
    dTitle.innerHTML = `
      <span>${booking.patientName}</span>
      <span class="badge-booked" style="margin-top:4px;display:inline-flex;">Sudah Terbook</span>
    `;

    infoSec.innerHTML = `
      <div class="medical-info-card">
        <h4>
          <svg style="width:14px;height:14px;"><use href="#i-doc"/></svg>
          Keluhan Pasien:
        </h4>
        <p>${escapeHtml(booking.keluhan || 'Tidak ada catatan keluhan.')}</p>
      </div>

      <div class="medical-info-card" style="margin-top:8px;">
        <h4>
          <svg style="width:14px;height:14px;"><use href="#i-shield"/></svg>
          Riwayat Penyakit Sebelumnya:
        </h4>
        <p>${escapeHtml(booking.riwayatPenyakit || 'Tidak ada riwayat penyakit atau alergi obat yang dilaporkan.')}</p>
      </div>
    `;

    actSec.innerHTML = `
      <button class="btn-danger" onclick="cancelBooking('${booking.id}')">
        <svg style="width:14px;height:14px"><use href="#i-trash"/></svg>
        Batalkan Booking Ini
      </button>
    `;
  } 
  // TAMPILAN PASIEN: Identitas Pasien Dirahasiakan, Hanya Tahu Sudah Terbook (Requirement 2 & 4)
  else {
    dTitle.innerHTML = `
      <span>Sudah Terbook</span>
      <span class="badge-booked" style="margin-top:4px;display:inline-flex;">Jadwal Terisi</span>
    `;

    infoSec.innerHTML = `
      <div class="patient-privacy-notice">
        <b>Slot Ini Sudah Direservasi</b><br>
        Dokter ${booking.doctorName} telah memiliki jadwal konsultasi dengan pasien lain pada jam ini. Demi privasi medis, identitas pasien dirahasiakan.<br><br>
        <b style="color:#b91c1c;">Perhatian (Requirement 4):</b> Anda tidak dapat membooking dokter ini di jam dan tanggal yang sama. Silakan pilih jam atau dokter lain yang masih tersedia.
      </div>
    `;

    actSec.innerHTML = `
      <button class="btn" disabled style="width:100%;height:38px;justify-content:center;opacity:0.6;cursor:not-allowed;background:#e2e8f0;color:#64748b;">
        Slot Tidak Tersedia
      </button>
      <button class="btn primary" style="width:100%;height:38px;justify-content:center;" onclick="openBookingModal()">
        Cari Jam Lain yang Tersedia
      </button>
    `;
  }
}

function selectBooking(id) {
  activeBookingId = id;
  document.querySelectorAll(".event").forEach(b => b.classList.toggle("selected", b.dataset.id === id));
  renderDetailPanel();
}

function handleEmptySlotClick(hour) {
  activeBookingId = null;
  document.querySelectorAll(".event").forEach(b => b.classList.remove("selected"));
  renderDetailPanel();
  openBookingModal(hour);
}

/* Batalkan booking (Khusus Admin) */
function cancelBooking(id) {
  if (!confirm("Apakah Anda yakin ingin membatalkan jadwal konsultasi ini? Slot jam akan kembali kosong.")) {
    return;
  }
  BOOKINGS = BOOKINGS.filter(b => b.id !== id);
  saveBookings(BOOKINGS);
  activeBookingId = null;
  renderEvents();
  renderMiniCalendar();
  showToast("Jadwal booking berhasil dibatalkan. Slot jam kini kosong.");
}

/* ---------- Switch Role Pasien / Admin ---------- */
function setCalendarRole(role) {
  currentRole = role;

  // Toggle button active
  document.getElementById("modePatientBtn").classList.toggle("active", role === 'patient');
  document.getElementById("modeAdminBtn").classList.toggle("active", role === 'admin');

  // Update Header Badges
  const badgeTitle = role === 'admin' ? 'Kalender (Admin)' : 'Kalender (Pasien)';
  document.getElementById("crumbModeTitle").textContent = badgeTitle;
  
  const indicator = document.getElementById("roleBadgeIndicator");
  indicator.textContent = role === 'admin' ? 'Mode: Administrator Klinik' : 'Mode: Pasien / Publik';
  indicator.style.color = role === 'admin' ? '#012D68' : '#047857';
  indicator.style.background = role === 'admin' ? '#EFF6FF' : '#ECFDF5';
  indicator.style.borderColor = role === 'admin' ? '#BFDBFE' : '#A7F3D0';

  // Update Sidebar
  document.getElementById("sidebarRoleBadge").textContent = role === 'admin' ? 'Admin' : 'Pasien';
  document.getElementById("sidebarRoleBadge").style.color = role === 'admin' ? '#012D68' : '#047857';
  document.getElementById("sidebarRoleBadge").style.background = role === 'admin' ? '#EFF6FF' : '#ECFDF5';
  
  // Action button text
  document.getElementById("btnActionText").textContent = role === 'admin' ? '+ Tambah Jadwal Pasien' : '+ Booking Jadwal Dokter';

  // Render ulang events & detail
  renderEvents();
  showToast(`Beralih ke tampilan ${role === 'admin' ? 'Administrator' : 'Pasien'}.`);
}

/* ---------- Filter Dokter (Requirement 3) ---------- */
function filterDoctor(docId) {
  activeDoctorFilter = docId;
  document.querySelectorAll(".tab").forEach(t => {
    t.classList.toggle("active", t.dataset.doctor === docId);
  });
  renderEvents();
}

/* ---------- Validasi Duplikasi Booking (Requirement 4) ---------- */
function checkSlotAvailability() {
  const docId = document.getElementById("bmDoctor").value;
  const dateVal = document.getElementById("bmDate").value;
  const hourVal = parseFloat(document.getElementById("bmHour").value);
  const alertBox = document.getElementById("modalAlertBox");
  const submitBtn = document.getElementById("bmSubmitBtn");

  // Periksa apakah slot dokter, tanggal, dan jam tersebut sudah ada di BOOKINGS
  const isConflict = BOOKINGS.some(b => {
    if (b.doctorId === docId && b.date === dateVal) {
      // Periksa tumpang tindih jam
      const bStart = b.startHour;
      const bEnd = b.startHour + b.durationHours;
      const newStart = hourVal;
      const newEnd = hourVal + 1;
      return (newStart < bEnd && newEnd > bStart);
    }
    return false;
  });

  if (isConflict) {
    const docName = DOCTORS[docId]?.name || 'Dokter';
    alertBox.innerHTML = `⚠️ <b>Jadwal Bentrok (Requirement 4):</b> ${docName} sudah terbooking pada jam dan tanggal ini! Anda tidak dapat membooking di jam yang sama. Silakan pilih jam atau dokter lain.`;
    alertBox.style.display = "block";
    submitBtn.disabled = true;
    submitBtn.style.opacity = "0.5";
    submitBtn.style.cursor = "not-allowed";
    return false;
  } else {
    alertBox.style.display = "none";
    submitBtn.disabled = false;
    submitBtn.style.opacity = "1";
    submitBtn.style.cursor = "pointer";
    return true;
  }
}

/* ---------- Form Booking Submit (Requirement 5: Logika Tanpa Database) ---------- */
function handleBookingSubmit(e) {
  e.preventDefault();

  if (!checkSlotAvailability()) {
    return;
  }

  const docId = document.getElementById("bmDoctor").value;
  const dateVal = document.getElementById("bmDate").value;
  const hourVal = parseFloat(document.getElementById("bmHour").value);
  const patientNameVal = document.getElementById("bmPatientName").value.trim();
  const keluhanVal = document.getElementById("bmKeluhan").value.trim();
  const riwayatVal = document.getElementById("bmRiwayat").value.trim();

  const docObj = DOCTORS[docId];

  // Buat objek booking baru
  const newBooking = {
    id: 'b-' + Date.now(),
    date: dateVal,
    doctorId: docId,
    doctorName: docObj.name,
    specialty: docObj.specialty,
    startHour: hourVal,
    durationHours: 1,
    patientName: patientNameVal,
    patientInitials: patientNameVal.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase() || 'P',
    keluhan: keluhanVal,
    riwayatPenyakit: riwayatVal,
    status: 'booked'
  };

  BOOKINGS.push(newBooking);
  saveBookings(BOOKINGS);

  closeBookingModal();

  // Geser tanggal ke tanggal yang baru dibooking
  selectedDateStr = dateVal;
  activeBookingId = newBooking.id;
  updateDateHeader();
  renderMiniCalendar();
  renderEvents();

  showToast(`✅ Janji konsultasi berhasil dibooking untuk ${docObj.name}!`);
}

/* ---------- Modal Handling ---------- */
function openBookingModal(hourDefault = null) {
  document.getElementById("bookingModalBackdrop").classList.add("open");
  document.getElementById("bookingModal").classList.add("open");

  document.getElementById("bmDate").value = selectedDateStr;
  if (hourDefault !== null && hourDefault >= 8 && hourDefault <= 16) {
    document.getElementById("bmHour").value = hourDefault;
  }
  if (activeDoctorFilter !== 'all') {
    document.getElementById("bmDoctor").value = activeDoctorFilter;
  }

  checkSlotAvailability();
}

function closeBookingModal() {
  document.getElementById("bookingModalBackdrop").classList.remove("open");
  document.getElementById("bookingModal").classList.remove("open");
  document.getElementById("modalAlertBox").style.display = "none";
}

/* ---------- Mini Calendar (Month Grid) ---------- */
let miniCalYear = 2025;
let miniCalMonth = 0; // 0 = Jan

function renderMiniCalendar() {
  const container = document.getElementById("miniGrid");
  container.innerHTML = "";

  document.getElementById("miniMonthTitle").textContent = `${MONTH_NAMES[miniCalMonth]} ${miniCalYear}`;

  ["Mo","Tu","We","Th","Fr","Sa","Su"].forEach(d => {
    container.insertAdjacentHTML("beforeend", `<div class="dow">${d}</div>`);
  });

  const firstDayIndex = (new Date(miniCalYear, miniCalMonth, 1).getDay() + 6) % 7;
  const daysInMonth = new Date(miniCalYear, miniCalMonth + 1, 0).getDate();
  const prevMonthDays = new Date(miniCalYear, miniCalMonth, 0).getDate();

  // Hari out dari bulan sebelumnya
  for (let i = firstDayIndex - 1; i >= 0; i--) {
    const dNum = prevMonthDays - i;
    container.insertAdjacentHTML("beforeend", `<div class="d out">${dNum}</div>`);
  }

  // Hari dalam bulan ini
  for (let d = 1; d <= daysInMonth; d++) {
    const mm = String(miniCalMonth + 1).padStart(2, '0');
    const dd = String(d).padStart(2, '0');
    const dateKey = `${miniCalYear}-${mm}-${dd}`;

    const isSel = (dateKey === selectedDateStr);
    const hasBooking = BOOKINGS.some(b => b.date === dateKey);

    const b = document.createElement("button");
    b.className = `d ${isSel ? 'sel' : ''} ${hasBooking ? 'has' : ''}`;
    b.textContent = d;
    b.addEventListener("click", () => {
      selectedDateStr = dateKey;
      updateDateHeader();
      renderMiniCalendar();
      renderEvents();
    });
    container.appendChild(b);
  }
}

function shiftMonth(delta) {
  miniCalMonth += delta;
  if (miniCalMonth < 0) {
    miniCalMonth = 11;
    miniCalYear--;
  } else if (miniCalMonth > 11) {
    miniCalMonth = 0;
    miniCalYear++;
  }
  renderMiniCalendar();
}

/* ---------- Update Date Header Toolbar ---------- */
function updateDateHeader() {
  const [y, m, d] = selectedDateStr.split('-').map(Number);
  const dt = new Date(y, m - 1, d);
  const mName = MONTH_NAMES[dt.getMonth()];
  const dowName = DOW_NAMES[dt.getDay()];

  document.getElementById("dateTitle").textContent = `${mName} ${d}, ${y}`;
  document.getElementById("dateDow").textContent = dowName;
  document.getElementById("badgeDay").textContent = d;
  document.getElementById("badgeMonth").textContent = mName.substring(0, 3);
}

function formatDateDisplay(dateStr) {
  const [y, m, d] = dateStr.split('-').map(Number);
  const dt = new Date(y, m - 1, d);
  return `${DOW_NAMES[dt.getDay()]}, ${MONTH_NAMES[dt.getMonth()].substring(0, 3)} ${d}, ${y}`;
}

function shiftDay(delta) {
  const [y, m, d] = selectedDateStr.split('-').map(Number);
  const dt = new Date(y, m - 1, d + delta);
  const yyyy = dt.getFullYear();
  const mm = String(dt.getMonth() + 1).padStart(2, '0');
  const dd = String(dt.getDate()).padStart(2, '0');
  selectedDateStr = `${yyyy}-${mm}-${dd}`;

  miniCalYear = yyyy;
  miniCalMonth = dt.getMonth();

  updateDateHeader();
  renderMiniCalendar();
  renderEvents();
}

document.getElementById("prevDay").onclick = () => shiftDay(-1);
document.getElementById("nextDay").onclick = () => shiftDay(1);
document.getElementById("todayBtn").onclick = () => {
  selectedDateStr = '2025-01-10';
  miniCalYear = 2025;
  miniCalMonth = 0;
  updateDateHeader();
  renderMiniCalendar();
  renderEvents();
};

/* Helper escape HTML */
function escapeHtml(str) {
  return str.replace(/[&<>"']/g, m => ({
    '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'
  })[m]);
}

/* Toast Message */
function showToast(msg) {
  const toast = document.getElementById("appToast");
  toast.textContent = msg;
  toast.classList.add("show");
  setTimeout(() => toast.classList.remove("show"), 3200);
}

/* Shortcut Ctrl+K / Cmd+K */
document.addEventListener("keydown", e => {
  if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === "k") {
    e.preventDefault();
    document.getElementById("q").focus();
  }
  if (e.key === "Escape") {
    closeBookingModal();
  }
});

/* Inisialisasi Pertama Kali */
window.addEventListener("DOMContentLoaded", () => {
  initHourGrid();
  updateDateHeader();
  renderMiniCalendar();
  setCalendarRole(currentRole);
});
</script>
</body>
</html>
