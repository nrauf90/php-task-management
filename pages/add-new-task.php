<?php
require_once './inc/db.php';

use inc\db;
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
	    $db    = new Db( 'localhost', 'tasks_db', 'root', '' );
	    $user  = $_SESSION['user'];
	    $task = $db->query( 'INSERT INTO tk_tasks(user_id, title, description, status) VALUES (:user_id, :title, :description, :status)', ['user_id'=> $user['id'], 'title' => trim($title), 'description' => trim($description), 'status' => $status ] );
	    if($task > 0 ) {
		    $successMessage =  'Successfully created a new task!';
	    }
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h2>Add New Task</h2>
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
            <form action="?action=add-task" method="post" name="task_form" novalidate>
                <!-- title input -->
                <div class="form-outline mb-4">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" required/>
                </div>

                <!-- description input -->
                <div class="form-outline mb-4">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                              required></textarea>
                </div>

                <!-- status input -->
                <div class="form-outline mb-4">
                    <label for="description">Status</label>
                    <select name="status" class="form-control" required>
                        <option value=""></option>
                        <option value="pending">Pending</option>
                        <option value="inprogress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="hold">Hold</option>
                    </select>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Add Task</button>
            </form>
        </div>
    </div>
</div>
