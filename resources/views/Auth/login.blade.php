<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Success & Error Messages --}}
            @if(session('success'))
                <div class="alert alert-success text-center w-100">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('fail'))
                <div class="alert alert-danger text-center w-100">
                    {{ session('fail') }}
                </div>
            @endif

            {{-- User Form --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white text-center">
                    <h5>{{ isset($user) ? 'Update User' : 'Create User' }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}">
                        @csrf
                        @if(isset($user))
                            @method('PUT') <!-- Use PUT for updating existing users -->
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                         @if(isset($user))
                                                        <input type="email" name="email" class="form-control" value="{{ $user->email}}" required>
@else
    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
@endif

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Leave blank to keep current password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Buttons: Logout, Create/Update, Cancel --}}
                        <div class="d-flex justify-content-between mt-3">
                            <form method="POST" action="{{ route('auth.logout') }}" id="logout-form">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" id="create-btn">
                                {{ isset($user) ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Show success message on Create button click
    document.getElementById("create-btn").addEventListener("click", function () {
        alert("User successfully created or updated!");
    });

    // Show logout confirmation on Logout button click
    document.getElementById("logout-form").addEventListener("click", function () {
        alert("You have been logged out.");
    });
       // Ensure Logout Works
    document.getElementById("logout-btn").addEventListener("click", function () {
        alert("You have been logged out successfully!");
    });
      // Show confirmation message after clicking Create
    document.getElementById("user-form").addEventListener("submit", function () {
        alert("User successfully created or updated!");
    });

    // Show confirmation message when logging out
    document.getElementById("logout-form").addEventListener("submit", function () {
        alert("You have been logged out successfully.");
    });

</script>
