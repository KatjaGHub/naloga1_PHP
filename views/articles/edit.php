<div class="container">
    <h3>Uredi novico</h3>
    <form action="index.php?controller=articles&action=update" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($article->id); ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Naslov:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($article->title); ?>" required>
        </div>
        <div class="mb-3">
            <label for="abstract" class="form-label">Povzetek:</label>
            <textarea class="form-control" id="abstract" name="abstract" rows="3" required><?php echo htmlspecialchars($article->abstract); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Besedilo:</label>
            <textarea class="form-control" id="text" name="text" rows="5" required><?php echo htmlspecialchars($article->text); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Posodobi</button>
    </form>
</div>