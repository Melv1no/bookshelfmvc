<body>
    <p>Books present in the <a href="index.php?page=bookshelf">bookshelf</a></p>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="row">Name</th>
                <th scope="row">Author</th>
                <th scope="row">Summary</th>
                <th scope="row">Year</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($books as $book) {
            ?>
                <tr>
                    <th><?= htmlspecialchars($book['name']) ?></th>
                    <th><?= nl2br(htmlspecialchars($book['author'])) ?></th>
                    <th><?= htmlspecialchars($book['summary']) ?></th>
                    <th><?= nl2br(htmlspecialchars($book['year'])) ?></th>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</body>