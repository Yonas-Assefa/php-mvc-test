<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #7c7d80;
            --secondary-color: #94a3b8;
            --light-color: #f9fafb;
            --dark-color: #374151;
            --accent-color: #6b7280;
            --muted-color: #64748b;
            --border-color: #e2e8f0;
            --card-bg: #ffffff;
            --stripe-color: #f8fafc;
        }
        
        body {
            background-color: var(--light-color);
            color: var(--dark-color);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        .navbar-brand {
            font-weight: 600;
            letter-spacing: -0.025em;
        }
        
        .card {
            border-radius: 0.5rem;
            overflow: hidden;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            background-color: var(--card-bg);
        }
        
        .card-header {
            border-bottom: 1px solid var(--border-color);
            background-color: var(--card-bg);
            padding: 1rem 1.25rem;
        }
        
        .table th {
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .badge {
            font-weight: 500;
        }
        
        .btn-dark {
            background-color: var(--dark-color);
            border-color: var(--dark-color);
        }
        
        .btn-outline-dark {
            color: var(--dark-color);
            border-color: var(--dark-color);
        }
        
        .btn-outline-dark:hover {
            background-color: var(--dark-color);
            color: white;
        }
        
        .bg-dark-subtle {
            background-color: var(--dark-color) !important;
            color: white;
        }
        
        a {
            color: var(--dark-color);
            text-decoration: none;
        }
        
        a:hover {
            color: var(--accent-color);
        }
        
        .table {
            --bs-table-hover-bg: rgba(0,0,0,0.02);
        }
        
        .table-light {
            --bs-table-bg: var(--light-color);
        }
        
        .table-striped > tbody > tr:nth-of-type(odd) {
            --bs-table-accent-bg: var(--stripe-color);
        }
        
        .table-striped > tbody > tr:nth-of-type(odd) > * {
            box-shadow: inset 0 0 0 9999px var(--stripe-color);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg mb-4 shadow-sm" style="background-color: var(--dark-color);">
        <div class="container">
            <a class="navbar-brand text-white" href="<?php echo URLROOT; ?>">
                <i class="bi bi-database-fill"></i> <?php echo SITENAME; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo URLROOT; ?>">
                            <i class="bi bi-house-fill"></i> Home
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container"> 