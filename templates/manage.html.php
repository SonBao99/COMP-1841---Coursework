<!-- Default Tabs -->
<div class="tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Users</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Questions</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Tags</button>
        </li>
    </ul>
    <div class="tab-content pt-2" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th><b>ID</b></th>
                        <th>UserName</th>
                        <th>Role</th>
                        <th data-type="date" data-format="YYYY/DD/MM">Created date</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['user_id']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['role_id']; ?></td>
                            <td><?php echo date('Y/d/m', strtotime($user['created_at'])); ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown_<?php echo $user['user_id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="userDropdown_<?php echo $user['user_id']; ?>">
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUserModal_<?php echo $user['user_id']; ?>"><i class="bi bi-pencil"></i> Edit</button></li>
                                        <li><a class="dropdown-item" href="../delete/delete_user.php?user_id=<?php echo $user['user_id']; ?>" onclick="confirmDelete('user', <?php echo $user['user_id']; ?>)"><i class="bi bi-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th><b>ID</b></th>
                        <th>Author</th>
                        <th>Title</th>
                        <th data-type="date" data-format="YYYY/DD/MM">Created</th>
                        <th>Tag</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($questions as $question) : ?>
                        <tr>
                            <td><?php echo $question['question_id']; ?></td>
                            <td><?php echo $question['user_id']; ?></td>
                            <td><a href="../read/questions.php?question_id=<?php echo $question['question_id']; ?>"><?php echo $question['title']; ?></a>
                            </td>
                            <td><?php echo date('Y/d/m', strtotime($question['created_at'])); ?></td>
                            <td><?php echo $question['tag_id']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="questionDropdown_<?php echo $question['question_id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="questionDropdown_<?php echo $question['question_id']; ?>">
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editQuestionModal_<?php echo $question['question_id']; ?>">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>
                                        </li>
                                        <li><a class="dropdown-item" href="../delete/delete_question.php?question_id='<?php echo $question['question_id']; ?>" onclick="confirmDelete('question', <?php echo $question['question_id']; ?>)"><i class="bi bi-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th><b>ID</b></th>
                        <th>Name</th>
                        <th>No. of questions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tags as $tag) : ?>
                        <tr>
                            <td><?php echo $tag['tag_id']; ?></td>
                            <td><a href="../read/questions_tag.php?tag_id=<?php echo $tag['tag_id']; ?>"><?php echo $tag['name']; ?></a>
                            </td>
                            <td><?php echo $tag['num_questions']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="tagDropdown_<?php echo $tag['tag_id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="tagDropdown_<?php echo $tag['tag_id']; ?>">
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTagModal_<?php echo $tag['tag_id']; ?>">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>
                                        </li>
                                        <li><a class="dropdown-item" href="../delete/delete_tag.php?tag_id=<?php echo $tag['tag_id']; ?>" onclick="confirmDelete('tag', <?php echo $tag['tag_id']; ?>)"><i class="bi bi-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($users as $user) : ?>
    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal_<?php echo $user['user_id']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel_<?php echo $user['user_id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel_<?php echo $user['user_id']; ?>">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="../edit/edit_user.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                        <div class="col-12">
                            <label for="inputName_<?php echo $user['user_id']; ?>" class="form-label">Username</label>
                            <input type="text" class="form-control" value="<?php echo $user['username'] ?>" name="username" id="inputName_<?php echo $user['user_id']; ?>">
                        </div>
                        <div class="col-12">
                            <label for="inputRole_<?php echo $user['user_id']; ?>" class="form-label">Role</label>
                            <select id="inputRole_<?php echo $user['user_id']; ?>" class="form-select" name="role_id">
                                <option selected value="<?php echo $user['role_id']; ?>"><?php echo $user['role_id']; ?>
                                </option>
                                <option value="1">1 - Admin</option>
                                <option value="2">2 - User</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inputEmail_<?php echo $user['user_id']; ?>" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $user['email'] ?>" id="inputEmail_<?php echo $user['user_id']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Edit Question Modal -->
<?php foreach ($questions as $question) : ?>
    <div class="modal fade" id="editQuestionModal_<?php echo $question['question_id']; ?>" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing question -->
                    <form class="row g-3" action="../edit/edit_question.php?question_id=<?php echo $question['question_id']; ?>" method="post">
                        <!-- Hidden input for question ID -->
                        <input type="hidden" name="question_id" id="question_id">
                        <!-- Question title -->
                        <div class="col-12">
                            <label for="question_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="question_title" name="title" value="<?php echo $question['title']; ?>">
                            <label for="question_description" class="form-label">Description</label>
                            <textarea class="form-control" id="question_description" name="body" rows="3"><?php echo $question['body']; ?></textarea>
                            <label for="question_author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="question_author" name="user_id" value="<?php echo $question['user_id']; ?>"><br>

                            <?php if ($question['question_image'] !== null) : ?>
                                <label for="question_image" class="form-label">Image</label>
                                <img src="<?php echo $question['question_image']; ?>" class="img-fluid mb-3" alt="Question Image" style="max-width: 50%; height: auto;">
                                <input class="form-control" type="file" id="formFile" name="question_image"><br>
                            <?php endif; ?>

                            <label for="question_tags" class="form-label">Tags</label>
                            <select id="question_tags" class="form-select" name="tag_id">
                                <option selected value="<?php echo $tag['name']; ?>">
                                    <?php echo $question['tag_id']; ?>
                                </option>
                                <?php foreach ($tags as $tag) : ?>
                                    <option value="<?php echo $tag['tag_id']; ?>"><?php echo $tag['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<!-- Edit Tag Modal -->
<?php foreach ($tags as $tag) : ?>
    <div class="modal fade" id="editTagModal_<?php echo $tag['tag_id']; ?>" tabindex="-1" aria-labelledby="editTagModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTagModalLabel">Edit Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing tag -->
                    <form class="row g-3" action="../edit/edit_tag.php?tag_id=<?php echo $tag['tag_id']; ?>" method="post">
                        <!-- Hidden input for tag ID -->
                        <input type="hidden" name="tag_id" value="<?php echo $tag['tag_id']; ?>">
                        <!-- Tag name -->
                        <div class="col-12">
                            <label for="tag_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="tag_name" name="name" value="<?php echo $tag['name']; ?>">

                            <label for="tag_description" class="form-label">Description</label>
                            <textarea class="form-control" id="tag_description" name="description" rows="3"><?php echo $tag['description']; ?></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<script>
    function confirmDelete(itemType, itemId) {
        var confirmMessage = "Are you sure you want to delete this ";
        switch (itemType) {
            case 'user':
                confirmMessage += "user?";
                break;
            case 'question':
                confirmMessage += "question?";
                break;
            case 'tag':
                confirmMessage += "tag?";
                break;
            default:
                return;
        }
        if (confirm(confirmMessage)) {
            window.location.href = "delete_" + itemType + ".php?" + itemType + "_id=" + itemId;
        } else {
            // Prevent the default behavior of the link
            event.preventDefault();
            return false;
        }
    }
</script>