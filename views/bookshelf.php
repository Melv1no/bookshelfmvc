<!-- to display success message at action !-->
<?php if (isset($_GET['msg']) && $_GET['msg'] == 'created-success') { ?>
    <div class="alert alert-success" role="alert" style="display:block;">
        book is successfuly created !
    </div>
<?php } else if (isset($_GET['msg']) && $_GET['msg'] == 'edited-success') { ?>
    <div class="alert alert-info" role="alert" style="display:block;">
        book is successfuly edited !
    </div>
<?php } else if (isset($_GET['msg']) && $_GET['msg'] == 'deleted-success') { ?>
    <div class="alert alert-danger" role="alert" style="display:block;">
        book is successfuly deleted !
    </div>
<?php } ?>


<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- Form to create book in database !-->
            <p>Create book</p>
            <form id="createform" method="post" action="index.php?action=create">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author:</label>
                    <input type="text" id="author" name="author" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Year:</label>
                    <input type="number" id="year" name="year" class="form-control" min="0" max="9999" required>
                </div>
                <div class="mb-3">
                    <label for="summary" class="form-label">Summary:</label>
                    <textarea id="summary" name="summary" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <!-- Form to edit book in database !-->
        <div class="col-md-4">
            <p>Edit book</p>
            <form id="editform" method="post" action="index.php?action=edit">
                <label for="id" class="form-label">Select a book to edit:</label>
                <select name="id" id="id" class="form-select">
                    <?php foreach ($books as $book) { ?>
                        <option value="<?= htmlspecialchars($book['id']) ?>">
                            <?= htmlspecialchars($book['name']) ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author:</label>
                    <input type="text" id="author" name="author" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Year:</label>
                    <input type="number" id="year" name="year" class="form-control" min="0" max="9999" required>
                </div>
                <div class="mb-3">
                    <label for="summary" class="form-label">Summary:</label>
                    <textarea id="summary" name="summary" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

        <!-- Form to delete book in database !-->
        <div class="col-md-4">
            <p>Delete book</p>
            <form id="deleteform" method="post" action="index.php?action=delete">
                <div class="mb-3">
                    <label for="id" class="form-label">Select a book to delete:</label>
                    <select name="id" id="id" class="form-select">
                        <?php foreach ($books as $book) { ?>
                            <option value="<?= htmlspecialchars($book['id']) ?>">
                                <?= htmlspecialchars($book['name']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>