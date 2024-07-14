<?php require "partials/head.php" ?>
    <div class="min-h-full">
        <?php require "partials/nav.php" ?>
        <?php require "partials/banner.php" ?>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <?php foreach ($notes as $note) : ?>
                    <li>
                        <a href = "/note?id=<?= $note["id"]?>">
                            <?= $note["title"]?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

<?php require "partials/footer.php" ?>