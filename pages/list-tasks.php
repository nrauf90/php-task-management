<?php
require_once './inc/db.php';

use inc\db;

$db    = new Db( 'localhost', 'tasks_db', 'root', '' );
$user  = $_SESSION['user'];
$tasks = $db->query( 'SELECT * FROM tk_tasks WHERE user_id= :user_id', [ 'user_id' => $user['id'] ] );
$db->CloseConnection();
//print_r($tasks);
?>
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <a href="?action=add-task" class="btn btn-primary"><i class="fa fa-add"></i> Add Task</a>
            <table class="table align-middle mb-0 bg-white mt-4">
                <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach ( $tasks as $key => $val ): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <?php echo $key + 1;?>
                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1"><?php echo $val['title']?></p>
                        </td>
                        <td>
                            <?php
                            $badgeClass = '';
                                switch ($val['status']){
                                    case 'inprogress':
                                        $badgeClass = 'primary';
                                        break;
                                    case 'hold':
                                        $badgeClass = 'danger';
                                        break;
                                    case 'completed':
                                        $badgeClass = 'success';
                                        break;
                                    default:
                                        $badgeClass = 'warning';
                                }
                            ?>
                            <span class="badge badge-<?php echo $badgeClass;?> rounded-pill d-inline"><?php echo strtoupper($val['status']);?></span>
                        </td>
                        <td>Senior</td>
                        <td>Senior</td>
                        <td>
                            <a
                                    href="?action=update-task&id=<?php echo $val['id']?>"
                                    class="btn btn-link btn-rounded btn-sm fw-bold"
                                    data-mdb-ripple-color="dark"
                            >
                                Edit
                            </a>
                        </td>
                    </tr>
				<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
