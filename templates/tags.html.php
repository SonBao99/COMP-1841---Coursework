<div class="container">
    <div class="row">
        <?php foreach ($tags as $tag) : ?>
            <div class="col-md-3">
                <div class="card tag-card">
                    <div class="card-header">
                        <h5 class="badge bg-secondary"><a href="questions_tag.php?tag_id=<?php echo $tag['tag_id']; ?>" class="tag" style ="color: white;"><?php echo htmlspecialchars($tag['name']); ?></a></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo htmlspecialchars(truncateDescription($tag['description'], 50)); ?></p>
                    </div>
                    <div class="card-footer">
                        <?php echo htmlspecialchars($tag['num_questions']); ?> question(s)
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
