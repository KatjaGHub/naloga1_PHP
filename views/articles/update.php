
<div class="container">
    <h3>Moje novice</h3>

    <?php if (empty($articles)): ?>
        <p>Nimate še objavljenih novic.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Naslov</th>
                    <th>Povzetek</th>
                    <th>Datum objave</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($article->title); ?></td>
                        <td><?php echo htmlspecialchars($article->abstract); ?></td>
                        <td><?php echo htmlspecialchars($article->date); ?></td>
                        <td>
                            <a href="index.php?controller=articles&action=show&id=<?php echo $article->id; ?>" class="btn btn-sm btn-info">Prikaži</a>
                            <a href="index.php?controller=articles&action=edit&id=<?php echo $article->id; ?>" class="btn btn-sm btn-warning">Uredi</a>
                            <a href="index.php?controller=articles&action=delete&id=<?php echo $article->id; ?>" class="btn btn-sm btn-danger">Izbriši</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>