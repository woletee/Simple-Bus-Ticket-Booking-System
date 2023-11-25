<!-- Navigation Bar -->
<header>
    <nav>
        <!-- Rest of the navigation code -->

        <!-- Super Admin Button -->
        <div>
            <a href="#" class="nav-item" onclick="openSuperAdminForm()"><i class="fas fa-user-shield" style="margin-right: 0.4rem;"></i>Super Admin</a>
        </div>
    </nav>
</header>

<!-- Super Admin Form Modal -->
<div class="modal fade" id="superAdminModal" tabindex="-1" aria-labelledby="superAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="superAdminModalLabel">Super Admin Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="superadmin_page.php" method="POST">
                    <div class="mb-3">
                        <label for="superAdminUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="superAdminUsername" name="superAdminUsername">
                    </div>
                    <div class="mb-3">
                        <label for="superAdminPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="superAdminPassword" name="superAdminPassword">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success" name="superAdminSubmit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Rest of your code -->

<!-- Script -->
<script>
    function openSuperAdminForm() {
        $('#loginModal').modal('hide');
        $('#superAdminModal').modal('show');
    }
</script>

<?php
    // Check if the form is submitted
    if (isset($_POST['superAdminSubmit'])) {
        // Get the entered username and password
        $username = $_POST['superAdminUsername'];
        $password = $_POST['superAdminPassword'];

        // Check if the entered credentials match the expected values
        if ($username === 'admin' && $password === 'admin') {
            // Redirect the user to superadmin_page.php
            header("Location: superadmin_page.php");
            exit;
        } else {
            // Invalid credentials, display an error message or take appropriate action
            echo "Invalid username or password";
        }
    }
?>



