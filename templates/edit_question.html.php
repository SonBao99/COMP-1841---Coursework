<div class="card-body pb-0">
    <table class="table table-borderless">
        <form class="col-md-8" action="edit_question.php?question_id=<?php echo $question['question_id']; ?>" method="post" enctype="multipart/form-data">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Title</h5>
                    <p class="card-text text-muted" style="font-size: 0.9rem;">Be specific and imagine you’re asking a question to another person</p>
                </div>
                <div class="card-body">
                    <input class="form-control" placeholder="e.g. Is there an R function for finding the index of an element in a vector?" value="<?php echo $question['title']; ?>" name="title">
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">What are the details of your question?</h5>
                    <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">Introduce the problem and expand on what you put in the title</p>
                </div>
                <div class="card-body">
                    <textarea class="form-control que" style="height: 150px; overflow-y: auto;" name="body"><?php echo isset($question_id) ? $question['body'] : ''; ?></textarea>

                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Tags</h5>
                    <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">Add up to 5 tags to describe what your question is about</p>
                </div>
                <div class="card-body">
                    <select class="form-control" name="tag_id">
                        <?php foreach ($tags as $tag) : ?>
                            <option value="<?php echo $tag['tag_id']; ?>"><?php echo $tag['name']; ?></option>
                        <?php endforeach; ?>

                        <!-- Add more options for other tags -->
                    </select>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Post an image</h5>
                    <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">Post an image that best represents your question</p>
                </div>
                <div class="card-body">
                    <img src="<?php echo $question['question_image']; ?>" class="img-fluid mb-3" alt="Question Image" style="max-width: 50%; height: auto;">
                    <input class="form-control" type="file" id="formFile" name="question_image">
                </div>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
    </table>
</div>