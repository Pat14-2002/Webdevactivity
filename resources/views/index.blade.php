<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .user-card {
            background-color: #fff;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: 0.2s ease-in-out;
        }
        .user-card:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Users List</h3>
                </div>
                <div class="card-body">
                    @isset($users)
                        @if($users->isEmpty())
                            <div class="alert alert-warning text-center">
                                No users found.
                            </div>
                        @else
                            <div class="row g-3">
                                @foreach ($users as $user)
                                    <div class="col-md-6">
                                        <div class="user-card">
                                            <strong>{{ $user->name }}</strong><br>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="alert alert-danger text-center">
                            <strong>Error:</strong> Users data not available.
                        </div>
                    @endisset
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS (optional, for components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
