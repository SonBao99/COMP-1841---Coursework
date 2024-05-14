<div class="card top-selling overflow-auto">
    <div class="card-body pb-0 mt-4">
        <table class="table table-borderless">
            <?php if (!empty($questions)) : ?>
                <div>
                    <?php foreach ($questions as $question) :
                    ?>
                        <div class="question mb-4 shadow-mb">
                            <div class="question-header">
                                <h5 class="question-title d-flex justify-content-between">
                                    <a href="../read/questions.php?question_id=<?php echo $question['question_id']; ?>"><?php echo $question['title']; ?></a>
                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions</i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="../edit/edit_question.php?question_id=<?php echo $question['question_id']; ?>"><i class="bi bi-pencil"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="../delete/delete_question.php?question_id=<?php echo $question['question_id']; ?>" onclick="return confirmDelete(<?php echo $question['question_id']; ?>)"><i class="bi bi-trash"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </h5>

                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Display the tag name -->
                                    <?php $tag_name = getTagNameById($pdo, $question['tag_id']); ?>
                                    <span class="badge rounded-pill bg-secondary me-1"><?php echo $tag_name; ?></span>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="text-muted me-2"><i class="bi bi-eye-fill"></i> <?php echo $question['views']; ?> Views</a>
                                        <!-- Display the number of answers -->
                                        <?php $num_replies = getNumberReplies($pdo, $question['question_id']); ?>
                                        <a href="#" class="text-muted me-2"><i class="bi bi-chat-dots-fill"></i> <?php echo $num_replies; ?> Answers</a>
                                    </div>
                                    <p href="#" class="text-muted">
                                        <i class="bi bi-clock"></i> <?php echo calculateTimeLabel($question['created_at']); ?> ago
                                    </p>
                                </div>

                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <h5>You haven't asked any questions yet!</h5>
            <?php endif; ?>
        </table>
    </div>
</div>

<script>
    function confirmDelete(questionId) {
        if (confirm("Are you sure you want to delete this question?")) {
            window.location.href = "../delete/delete_question.php?question_id=" + questionId;
        } else {
            // Prevent the default behavior of the link
            event.preventDefault();
            return false;
        }
    }
</script>