<div class="card top-selling overflow-auto">
    <div class="card-body pb-0">
        <p class="card-title" style="font-size: 30px">
            <?php echo $question['title']; ?>
        </p>
        <!-- Display the question image -->
        <?php if (!empty($question['question_image'])) : ?>
            <img src="<?php echo $question['question_image']; ?>" class="img-fluid mb-3" alt="Question Image" style="max-width: 80%; height: auto;">
        <?php endif; ?>
        <div>
            <div class="card-body mb-4 shadow-mb">
                <div class="question-header">
                    <h5 class="question-title">
                        <p href="#" class="text-dark">
                            <?php echo $question['body']; ?>
                        </p>
                    </h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <?php
                        // Retrieve tag name based on tag_id using the function
                        $tag_name = getTagNameById($pdo, $question['tag_id']);
                        ?>
                        <span class="badge rounded-pill bg-secondary me-1">
                            <?php echo $tag_name; ?>
                        </span>
                    </div>
                </div>
                <div class="question-body mb-2 mt-2">
                    <div class="question-footer d-flex justify-content-between mt-2">
                        <a href="#" class="text-muted ms-4"><i class="bi bi-clock"></i>
                            <?php echo $question['created_at']; ?></a>
                        <div>
                            <small>asked by</small><a href="#">
                                <?php echo get_username_by_id($question['user_id']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h5 class="card-title">Answer</h5>

<?php if (empty($answers)) : ?>
    <p>No answers yet, be the first one now!</p>
<?php else : ?>
    <?php foreach ($answers as $answer) : ?>
        <div class="card">
            <div class="card-body mt-3">
                <p class="card-text">
                    <?php echo $answer['body']; ?>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="card-text mb-0">
                        <a href=""><?php echo get_username_by_id($answer['user_id']); ?> </a>
                        <small class="text-muted">answered <?php echo calculateTimeLabel($answer['created_at']); ?> ago</small>
                    </p>
                    <?php if (isset($_SESSION['user_id']) && $answer['user_id'] == $_SESSION['user_id']) : ?>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editAnswerModal_<?php echo $answer['answer_id']; ?>">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                </li>
                                <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
                                <li>
                                    <a class="dropdown-item" href="../delete/delete_answer.php?answer_id=<?php echo $answer['answer_id']; ?>" onclick="return confirmDelete(<?php echo $answer['answer_id']; ?>)">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
<?php endif; ?>

<?php foreach ($answers as $answer) : ?>
    <div class="modal fade" id="editAnswerModal_<?php echo $answer['answer_id']; ?>" tabindex="-1" aria-labelledby="editAnswerModalLabel_<?php echo $answer['answer_id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAnswerModalLabel_<?php echo $answer['answer_id']; ?>">Edit Answer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing answer -->
                    <form class="row g-3" action="../edit/edit_answer.php?answer_id=<?php echo $answer['answer_id']; ?>" method="post">
                        <!-- Hidden input for answer ID -->
                        <input type="hidden" name="answer_id" value="<?php echo $answer['answer_id']; ?>">
                        <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
                        <!-- Answer body -->
                        <div class="col-12">
                            <label for="edit_answer_body_<?php echo $answer['answer_id']; ?>" class="form-label">Answer</label>
                            <textarea class="form-control" id="edit_answer_body_<?php echo $answer['answer_id']; ?>" name="body" rows="3"><?php echo $answer['body']; ?></textarea>
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







<hr>

<form method="post" action="../create/answer.php">
    <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
    <div class="mb-3">
        <p class="card-title" style="font-size: 20px">Your Answer</p>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body"></textarea>
    </div>
    <?php if (isset($_SESSION['user_id'])) : ?>
        <button type="submit" class="btn btn-primary" style="padding: 0.5rem 0.5rem; font-size: 0.75rem;">Post your
            Answer</button>
    <?php else : ?>
        <button type="submit" class="btn btn-primary" style="padding: 0.5rem 0.5rem; font-size: 0.75rem;" disabled>Post
            your Answer</button>
    <?php endif; ?>
</form>