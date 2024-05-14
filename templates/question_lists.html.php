<div class="card top-selling overflow-auto">
    <form id="sortForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"> Sort <i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Sort By</h6>
                </li>
                <li><button type="submit" class="dropdown-item" name="sort_column" value="created_at|DESC">Date
                        (Descending)</button></li>
                <li><button type="submit" class="dropdown-item" name="sort_column" value="created_at|ASC">Date
                        (Ascending)</button></li>
                <li><button type="submit" class="dropdown-item" name="sort_column" value="views|DESC">Views
                        (Descending)</button></li>
                <li><button type="submit" class="dropdown-item" name="sort_column" value="views|ASC">Views
                        (Ascending)</button></li>
            </ul>
        </div>
    </form>


    <div class="card-body pb-0 mt-4">
        <?php foreach ($questions as $question): ?>
            <article class="question mb-4 shadow-mb">
                <div class="question-header">
                    <h5 class="question-title">
                        <a href="questions.php?question_id=<?php echo $question['question_id']; ?>">
                            <?php echo $question['title']; ?>
                        </a>
                    </h5>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span
                            class="badge rounded-pill bg-secondary me-1"><?php echo getTagNameById($pdo, $question['tag_id']); ?></span>

                    </div>
                </div>

                <div class="question-footer d-flex justify-content-between mt-2">
                    <div class="d-flex align-items-center">
                        <a href="#" class="text-muted me-2"><i class="bi bi-eye-fill"></i>
                            <?php echo $question['views']; ?> Views</a>
                        <!-- Display the number of replies -->
                        <a href="#" class="text-muted me-2"><i class="bi bi-chat-dots-fill"></i>
                            <?php echo getNumberReplies($pdo, $question['question_id']); ?> Answers</a>
                    </div>
                    <a href="#">
                        <?php echo get_username_by_id($question['user_id']); ?>
                        <span class="text-muted">asked <?php echo calculateTimeLabel($question['created_at']); ?>
                            ago</span>
                    </a>

                </div>
            </article>
            <hr>
        <?php endforeach; ?>
    </div>
</div>

