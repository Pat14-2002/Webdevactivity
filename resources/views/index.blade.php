<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Gradient background for the entire page */
        body {
            background: linear-gradient(to bottom, rgb(141, 60, 178), rgb(181, 29, 130));
            color: white;
        }

        .user-card {
            background: linear-gradient(to right, rgb(153, 10, 196), rgb(210, 164, 219));
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(171, 76, 76, 0.05);
            transition: 0.2s ease-in-out;
        }
        .user-card:hover {
            transform: translateY(-3px);
        }
    </style>

</head>
<body>

    {{-- Success & Failure Messages --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    

    @if(session('fail'))
        <div class="alert alert-danger text-center">
            {{ session('fail') }}
        </div>
    

    <div class="container mt-4">
        {{-- Logout Button --}}
        <div class="d-flex justify-content-end">
            <a href="{{ route('auth.logout') }}" class="btn btn-danger">Logout</a>
        </div>

        {{-- Update User Form --}}
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white text-center">
                <h5>Update User</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}">
                    @csrf
                    @if(isset($user)) 
                        @method('PUT') <!-- Only use PUT when updating an existing user -->
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ optional($user)->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                        @error('password')
                            <span class="text-danger"></span>
                        
                    </div>

                    {{-- Buttons: Logout, Update, Cancel --}}
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('auth.logout') }}" class="btn btn-danger">Logout</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            {{ isset($user) ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
