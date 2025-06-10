<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> </head>
<body class="bg-light">  <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Success Message --}}
           @if(session('success'))
    <div class="d-flex justify-content-center">
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    </div>
@endif


            {{-- Create New User --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0"> Add a New User!</h3>
                </div>
                <div class="card-body" style="background-color:rgb(145, 109, 216);">
    <form method="POST" action="{{ route('users.store') }}">

                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div><div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>  <div class="col-md-4">Add
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Users List --}}
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Users List</h3>
                </div>
                <div class="card-body">
    @if($users->isEmpty())
        <div class="alert alert-warning text-center">
            Thank you
        </div>

                    @else
                        <div class="row g-3">
                            @foreach ($users as $user)
                                <div class="col-md-4">
                                    <div class="user-card">
                                        <strong>{{ $user->name }}</strong><br>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<style>
        .user-card {
            background-color: rgb(9, 180, 223);
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: 0.2s ease-in-out;
        }
        .user-card:hover {
            transform: translateY(-3px);
        }
    </style><!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>