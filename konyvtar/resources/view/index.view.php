<?php
include VIEW_PATH . 'layout/header.view.php';
?>

    <main>
        <section class="container text-center mt-3">
            <h3 class="display-6">
                Könyvek
            </h3>
        </section>

        <section class="container album py-3">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
                <div class="col">
                    <article class="card shadow" style="height: 100%">
                        <!--img src="" alt="" class="card-img-top"/-->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"> Könyv Hozzáadása </h5>
                            <p class="card-text d-grid mt-4">
                                <a class="btn btn-success btn-lg" href="/create">Létrehozás</a>
                            </p>
                        </div>
                    </article>
                </div>

                <?php if (isset($data) && count($data) > 0): ?>
                    <?php foreach ($data as $book): ?>
                        <div class="col">
                            <article class="card shadow" style="height: 100%">
                                <!--img src="" alt="" class="card-img-top"/-->
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"> <?= $book['title'] ?> </h5>
                                    <p class="card-text">
                                        <small class="text-secondary"><?= $book['author'] ?></small>

                                    <div class="btn-group mt-auto">
                                        <a href="/details?id=<?= $book["id"] ?>" class="btn btn-sm btn-outline-primary">Részletek</a>
                                        <a href="/edit?id=<?= $book["id"] ?>" class="btn btn-sm btn-outline-warning">Szerkesztés</a>
                                    </div>
                                    </p>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    Nincsenek könyvek a rendszerben!
                <?php endif; ?>
            </div>
        </section>

    </main>


<?php
include VIEW_PATH . 'layout/footer.view.php';
?>