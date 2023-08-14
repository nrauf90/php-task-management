<?php
session_start();
$action = $_GET['action'] ?? '';
require_once './pages/header.php';

switch ( $action ) {
	case 'login':
		require './pages/login.php';
		break;
	case 'logout':
		unset( $_SESSION['user'] );
		session_destroy();
		header( 'Location: ?action=login' );
		break;
	case 'home':
		if ( isset( $_SESSION ) && ! empty( $_SESSION['user'] ) ) {
			require './pages/dashboard.php';
		} else {
			header( 'Location: ?action=login' );
		}
		break;
	case 'add-task':
		if ( isset( $_SESSION ) && ! empty( $_SESSION['user'] ) ) {
			require './pages/add-new-task.php';
		} else {
			header( 'Location: ?action=login' );
		}
		break;
	case 'list-tasks':
		if ( isset( $_SESSION ) && ! empty( $_SESSION['user'] ) ) {
			require './pages/list-tasks.php';
		} else {
			header( 'Location: ?action=login' );
		}
		break;
	case 'update-task':
		if ( isset( $_SESSION ) && ! empty( $_SESSION['user'] ) ) {
			require './pages/update-task.php';
		} else {
			header( 'Location: ?action=login' );
		}
		break;
	default:
		if ( isset( $_SESSION ) && ! empty( $_SESSION['user'] ) ) {
			header( 'Location: ?action=home' );
		}
		require './pages/login.php';
}
