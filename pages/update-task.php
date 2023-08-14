<?php
require_once './inc/db.php';

use inc\db;
$db    = new Db( 'localhost', 'tasks_db', 'root', '' );
$user  = $_SESSION['user'];

$errorMessage = '';
$successMessage = '';
if ( ! empty( $_POST ) ) {
	$title = $_POST['title'] ?? '';
	$description = $_POST['description'] ?? '';
	$status = $_POST['status'] ?? '';
	if ( $title === '' ) {
		$errorMessage = '<p>Title is required.</p>';
	}
	if ( $description === '' ) {
		$errorMessage .= '<p>Description is required.</p>';
	}
	if ( $status === '' ) {
		$errorMessage .= '<p>Status is required.</p>';
	}

	if($errorMessage === ''){

		$task = $db->query( 'UPDATE tk_tasks SET  title = :title , description= :description, status = :status WHERE id=:id AND user_id=:user_id', ['id' => $_GET['id'], 'user_id'=> $user['id'], 'title' => trim($title), 'description' => trim($description), 'status' => $status ] );
		if($task > 0 ) {
			$successMessage =  'Successfully updated task!';
		}
	}
}

$taskId = $_GET['id'];

$task = $db->query('SELECT * FROM tk_tasks WHERE id=:taskId AND user_id=:user_id', ['taskId'=> $taskId, 'user_id' => $user['id']]);
$task = reset($task);
if(!empty($task)){
	$title = $task['title'];
	$description = $task['description'];
	$status = $task['status'];
}
?>

<div class="container">
	<div class="row">
		<div class="col-12 mt-4">
			<h2>Update Task</h2>
			<?php if ( $errorMessage !== '') { ?>
				<div class="alert alert-danger">
					<?php echo ( isset( $errorMessage ) ) ? $errorMessage : ''; ?>
				</div>
			<?php } ?>
			<?php if ( $successMessage !== '') { ?>
				<div class="alert alert-success">
					<?php echo ( isset( $successMessage ) ) ? $successMessage : ''; ?>
				</div>
			<?php } ?>
			<form action="?action=update-task&id=<?php echo $taskId;?>" method="post" name="task_form" novalidate>
				<!-- title input -->
				<div class="form-outline mb-4">
					<label for="title">Title</label>
					<input type="text" id="title" name="title" class="form-control" value="<?php echo isset($title)?$title:''?>" required/>

				</div>

				<!-- description input -->
				<div class="form-outline mb-4">
					<label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                              required><?php echo isset($description)?$description:''?>
                    </textarea>

				</div>

				<!-- status input -->
				<div class="form-outline mb-4">
					<label for="description">Status</label>
					<select name="status" class="form-control" required>
						<option value=""></option>
						<option value="pending" <?php echo (isset($status) && $status === 'pending')?'selected':'';?>>Pending</option>
						<option value="inprogress" <?php echo (isset($status) && $status === 'inprogress')?'selected':'';?>>In Progress</option>
						<option value="completed" <?php echo (isset($status) && $status === 'completed')?'selected':'';?>>Completed</option>
						<option value="hold" <?php echo (isset($status) && $status === 'hold')?'hold':'';?>>Hold</option>
					</select>

				</div>

				<!-- Submit button -->
				<button type="submit" class="btn btn-primary btn-block mb-4">Add Task</button>
			</form>
		</div>
	</div>
</div>
