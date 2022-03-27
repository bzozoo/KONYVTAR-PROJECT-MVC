<?php
include VIEW_PATH . 'layout/header.view.php';
?>
<?php if (isset($book)) : ?>

    <main>
        <section class="container text-center mt-3 mb-5">
            <h3 class="display-6">
                <strong><?= $book["title"] ?></strong> - Könyv
            </h3>
        </section>

        <section class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <h4 class="d-flex justify-content-between">
                        Könyv adatai:

                        <div class="btn-group">
                            <a class="btn btn-outline-warning" href="/">
                                Vissza
                            </a>
                            <a class="btn btn-danger" href="/delete?id=<?= $book["id"] ?>">
                                Törlés
                            </a>
                        </div>
                    </h4>

                    <table class="table table-striped">
                        <tr>
                            <th>Szerző</th>
                            <td><?= $book['author'] ?></td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td><?= $book['isbn'] ?></td>
                        </tr>
                        <tr>
                            <th>Nyelv</th>
                            <td><?= $book['language'] ?></td>
                        </tr>
                        <tr>
                            <th>Kiadás éve</th>
                            <td><?= $book['published_at'] ?></td>
                        </tr>
                        <tr>
                            <th>Azonosító szám</th>
                            <td><?= $book['stock_number'] ?></td>
                        </tr>
                    </table>

                </div>
                <div class="col-12 col-lg-4">
                    <h4>Kölcsönzési adatok</h4>

                    <ul class="list-group">
                        <li class="list-group-item d-grid">
                            <a href="#" class="btn btn-success disabled">Kölcsönzés</a>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <h6 class="text-success">Kölcsönzés</h6>
                            <small class="text-muted">2022.12.11 12:00</small>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <h6 class="text-warning">Visszavétel</h6>
                            <small class="text-muted">2022.12.11 11:00</small>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <h6 class="text-success">Kölcsönzés</h6>
                            <small class="text-muted">2022.12.10  12:00</small>
                        </li>

                    </ul>

                </div>
            </div>
        </section>

    </main>




<?php endif; ?>

<?php
include VIEW_PATH . 'layout/footer.view.php';
?>