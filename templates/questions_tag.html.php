<div class="card top-selling overflow-auto">
    <div class="card-body pb-0 mt-4">
        <table class="table table-borderless">
            <div class="d-flex justify-content-between align-items-center">
                <p class="card-title" style="font-size: 30px">
                    <?php echo '[' . $tag['name'] . '] '; ?>
                </p>
            </div>
            <div class="card-body mb-4 shadow-mb">
                <div class="question-header">
                    <h5 class="question-title">
                        <p href="#" class="text-dark">
                            <?php echo $tag['description']; ?>
                        </p>
                    </h5>
                </div>
            </div>
            <hr>

                <div>
                    <?php
                    foreach ($questions as $question) {
                        $tag_name = getTagNameById($pdo, $question['tag_id']);
                        $num_replies = getNumberReplies($pdo, $question['question_id']);
                    ?>
                        <div class="question mb-4 shadow-mb">
                            <div class="question-header">
                                <h5 class="question-title">
                                    <a href="questions.php?question_id=<?php echo $question['question_id']; ?>"><?php echo $question['title']; ?></a>
                                </h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge rounded-pill bg-secondary me-1"><?php echo $tag_name; ?></span>
                                    <p href="#" class="text-muted">
                                        <i class="bi bi-clock"></i> <?php echo calculateTimeLabel($question['created_at']); ?> ago
                                    </p>

                                </div>
                            </div>

                            <div class="question-body mb-2 mt-2">
                                <a href="#" class="text-muted">
                                    <?php echo get_username_by_id($question['user_id']); ?>
                                </a>
                            </div>
                            <div class="question-footer d-flex justify-content-between mt-2">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="text-muted me-2"><i class="bi bi-eye-fill"></i> <?php echo $question['views']; ?> Views</a>
                                    <!-- Display the number of replies -->
                                    <a href="#" class="text-muted me-2"><i class="bi bi-chat-dots-fill"></i> <?php echo $num_replies; ?> Answers</a>
                                    <a href="#" class="text-muted me-2"><i class="bi bi-thumbs-up-fill"></i> Votes</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php
                    }
                    ?>
                </div>
        </table>
    </div>
</div>