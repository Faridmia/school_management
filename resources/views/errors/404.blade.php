<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | School Management</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Source Sans 3', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .error-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            max-width: 520px;
            width: 100%;
            text-align: center;
        }
        .error-code {
            font-size: 96px;
            font-weight: 800;
            color: #0d6efd;
            line-height: 1;
            margin-bottom: 10px;
            letter-spacing: -2px;
        }
        .error-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 12px;
        }
        .error-desc {
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 25px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-code">404</div>
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-desc">Oops! The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        <div class="d-flex justify-content-center gap-2">
            @if(Auth::check())
                <a href="
                    @if(Auth::user()->user_type == 1) {{ url('admin/dashboard') }}
                    @elseif(Auth::user()->user_type == 2) {{ url('teacher/dashboard') }}
                    @elseif(Auth::user()->user_type == 3) {{ url('student/dashboard') }}
                    @elseif(Auth::user()->user_type == 4) {{ url('parent/dashboard') }}
                    @endif
                " class="btn btn-primary px-4 py-2">
                    <i class="bi bi-speedometer2 me-1"></i> Go to Dashboard
                </a>
            @else
                <a href="{{ url('/') }}" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-house-door me-1"></i> Back to Home
                </a>
            @endif
            <button onclick="window.history.back()" class="btn btn-outline-secondary px-3 py-2">
                <i class="bi bi-arrow-left me-1"></i> Go Back
            </button>
        </div>
    </div>
</body>
</html>
