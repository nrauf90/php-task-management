
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Task Management</title>
	<!-- Font Awesome -->
	<link
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
		rel="stylesheet"
	/>
	<!-- Google Fonts -->
	<link
		href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
		rel="stylesheet"
	/>
	<!-- MDB -->
	<link
		href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
		rel="stylesheet"
	/>

    <link rel="stylesheet" href="./assets/style.css">
	<!-- MDB -->
	<script
		type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"
	></script>
</head>
<body>

<?php
if(isset($_SESSION) && !empty($_SESSION['user'])){
    ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->


        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
               Task Management
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="?action=home">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=list-tasks">Tasks</a>
                </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <!-- Icon -->
            <a class="text-reset me-3" href="?action=logout" title="Logout">
                <i class="fas fa-lock"></i>
            </a>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
<?php
}

