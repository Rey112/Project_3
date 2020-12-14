<?php include('header.php'); ?>

    <h1>Ask New Question</h1>

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="submit_question">
        <input type="hidden" name="userId" value="<?php echo $userId; ?>">

        <div class="form-group">
            <label for="title">Question Of Choice</label>
            <input type="text" name="questionOfChoice" value="<?php echo $questions['questionTitle']; ?>">
        </div>

        <div class="form-group">
            <label for="title">Question Body</label>
            <input type="text" name="questionBody" value="<?php echo $questions['questionBody'];?>">
             <textarea name="questionBody" id="questionBody" rows="4" cols="50">
                Enter the question in the body provided.
            </textarea>
        </div>

        <div class="form-group">
            <label for="title">Question Skills</label>
            <input type="text" name="questionSkills" value="<?php echo $questions['questionSkills'];?>">
        </div>

        <input type="submit" class="btn btn-primary" value="Add Question">

    </form>

<?php include('footer.php'); ?>
