<main class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="mt-5">
        <h1 class="display-4 fw-bold lh-1 mb-3">Selamat datang <?= $model[
          'user'
        ]['name'] ?? '' ?>
        </h1>
        <h2 class="display-4 fw-bold lh-1 mb-3">Kamu login sebagai <?= $model[
          'access'
        ]['description'] ?? '' ?>
        </h2>
    </div>
</main>