<?php
include VIEW_PATH . 'layout/header.view.php';
?>

<main>
    <section class="container text-center mt-3 mb-5">
        <h3 class="display-6">
            Könyv Hozzáadása
        </h3>
    </section>

    <form class="container" action="/create" method="post">

        <div class="form-floating mb-3">
            <input name="stock_number" value="" class="form-control" id="azonositoSzam" type="text" placeholder="Azonosító szám"/>
            <label for="azonositoSzam">Azonosító szám</label>
        </div>
        <div class="form-floating mb-3">
            <input name="title" value="" class="form-control" id="cim" type="text"
                   placeholder="Cím"/>
            <label for="cim">Cím</label>
        </div>
        <div class="form-floating mb-3">
            <input name="author" value="" class="form-control" id="szerzo" type="text"
                   placeholder="Szerző"/>
            <label for="szerzo">Szerző</label>
        </div>
        <div class="form-floating mb-3">
            <input name="published_at" value="" class="form-control" id="kiadasEve"
                   type="text" placeholder="Kiadás éve"/>
            <label for="kiadasEve">Kiadás éve</label>
        </div>
        <div class="form-floating mb-3">
            <input name="language" value="" class="form-control" id="nyelv" type="text"
                   placeholder="Nyelv"/>
            <label for="nyelv">Nyelv</label>
        </div>
        <div class="form-floating mb-3">
            <input name="isbn" value="" class="form-control" id="isbn" type="text"
                   placeholder="ISBN"/>
            <label for="isbn">ISBN</label>
        </div>
        <div class="d-grid">
            <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Mentés</button>
        </div>
    </form>

</main>
<?php
include VIEW_PATH . 'layout/footer.view.php';
?>