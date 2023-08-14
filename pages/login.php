<?php
require_once './inc/db.php';

use inc\db;

$db              = new Db( 'localhost', 'tasks_db', 'root', '' );
$emailMessage    = '';
$passwordMessage = '';
if ( isset( $_POST ) ) {
	$email    = $_POST['email'] ?? '';
	$password = $_POST['password'] ?? '';

	$validation = false;
	if ( $email === '' ) {
		$emailMessage = 'Email is required.';
	}

	if ( $password === '' ) {
		$passwordMessage = 'Password is required.';
	}

	if ( $email && $password ) {
		try {
			$user = $db->query( "SELECT * FROM tk_users WHERE email = :email AND password = :password", [ 'email'    => $email,
			                                                                                              'password' => md5( $password )
			] );
			if ( ! empty( $user ) ) {
				$validation       = true;
				$user             = reset( $user );
				$_SESSION['user'] = $user;
				$db->CloseConnection();
				header( 'Location: ?action=home' );
			}


		} catch ( Exception $exception ) {
			echo $exception->getMessage();
		}

	}


}
?>
<div class="container">
    <div class="row vh-100">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="card login-form-wrapper">
                <div class="card-body">
					<?php
					if ( $_SERVER["REQUEST_METHOD"] === 'POST' && ! $validation ) {
						?>
                        <div class="alert alert-danger">
                            <p><?php echo isset( $emailMessage ) ? $emailMessage : ''; ?></p>
                            <p><?php echo isset( $passwordMessage ) ? $passwordMessage : ''; ?></p>
                        </div>
						<?php
					}
					?>
                    <form action="?action=login" method="post" name="login_form" novalidate>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required/>

                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required/>

                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
