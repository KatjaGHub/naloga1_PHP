<div class="container">
    <h3>Objavi novico</h3>
    <form action="/articles/store" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Naslov:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="abstract" class="form-label">Povzetek:</label>
            <textarea class="form-control" id="abstract" name="abstract" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Besedilo:</label>
            <textarea class="form-control" id="text" name="text" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Objavi</button>
    </form>
</div>