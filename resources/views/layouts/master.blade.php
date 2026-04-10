<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Khóa học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; box-shadow: 2px 0 5px rgba(0, 0, 0, .05); z-index: 100; }
        .nav-link { color: #495057; font-weight: 500; transition: all 0.2s ease-in-out; padding: 10px 15px; }
        .nav-link:hover { color: #0d6efd; background-color: #f1f5f9; border-radius: 8px; }
        .nav-link.active { color: #0d6efd; background-color: #e2e8f0; border-radius: 8px; font-weight: 600; }
        .fs-7 { font-size: 0.85rem; letter-spacing: 0.5px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar p-3 position-fixed h-100">
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <h4 class="mb-4 mt-2 text-primary text-center fw-bold">
                        <i class="bi bi-mortarboard-fill me-2"></i> CMS Admin
                    </h4>
                </a>
                <hr>
                
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item mb-1 mt-3">
                        <span class="text-muted fw-bold text-uppercase fs-7 ms-3">Quản lý Khóa học</span>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->routeIs('courses.index', 'courses.show', 'courses.edit') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                            <i class="bi bi-journal-album me-2"></i> Danh sách Khóa học
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('courses.create') ? 'active' : '' }}" href="{{ route('courses.create') }}">
                            <i class="bi bi-plus-square me-2"></i> Thêm Khóa học
                        </a>
                    </li>

                    <li class="nav-item mb-1 mt-3">
                        <span class="text-muted fw-bold text-uppercase fs-7 ms-3">Quản lý Học viên</span>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->routeIs('enrollments.index') ? 'active' : '' }}" href="{{ route('enrollments.index') }}">
                            <i class="bi bi-people-fill me-2"></i> Danh sách Đăng ký
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('enrollments.create') ? 'active' : '' }}" href="{{ route('enrollments.create') }}">
                            <i class="bi bi-person-plus-fill me-2"></i> Đăng ký Học viên
                        </a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 offset-md-3 offset-lg-2">
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> <strong>Thành công!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Lỗi!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="bi bi-exclamation-octagon-fill me-2"></i> <strong>Vui lòng kiểm tra lại dữ liệu:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
                
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>