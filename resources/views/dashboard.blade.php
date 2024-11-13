<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Add Bootstrap or custom CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Optional) -->
            <div class="col-md-2 bg-light">
                <h4 class="text-center">Dashboard</h4>
                <ul class="list-group">
                    <li class="list-group-item"><a href="#">Home</a></li>
                    <li class="list-group-item"><a href="#">Profile</a></li>
                    <li class="list-group-item"><a href="#">Settings</a></li>
                    <li class="list-group-item"><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <div class="row my-4">
                    <div class="col">
                        <h2>Hi, {{ Auth::user()->name }}!</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Your Dashboard</h5>
                                <p class="card-text">Welcome to the user dashboard! Here you can see your activities and manage your account.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Activities</h5>
                                <p class="card-text">View the latest activities you've performed.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap or custom JS for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
