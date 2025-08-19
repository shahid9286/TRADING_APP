<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blocked Account</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Account Blocked</h4>
                <p>Your account has been blocked. Please contact the administrator for more information.</p>
                <hr>
                <p class="mb-0">If you have any questions, please contact support.</p>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger mt-3">Logout</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
