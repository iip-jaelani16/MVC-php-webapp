<main class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="mt-5">
        <h1 class="fw-bold lh-1 mb-3">Hi <?= $model['user']['name'] ?? '' ?>
        </h1>
        <h2 class="fw-bold lh-1 mb-3">
            List Penjualan <?= $model['access']['accessId'] == 1
              ? 'Semua Seller'
              : 'Kamu' ?>
        </h2>
    </div>
    <div class="mt-5"
         style="overflow: auto">
        <table id="table_id"
               class="display">

            <thead>
                <tr>
                    <td>
                        IdPenjualan
                    </td>
                    <td>
                        JumlahPenjualan
                    </td>
                    <td>
                        HargaJual
                    </td>
                    <td>
                        IdPengguna
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model['sales'] as $value) { ?>
                <tr>
                    <td>
                        <?= $value['IdPenjualan'] ?>
                    </td>
                    <td>
                        <?= $value['JumlahPenjualan'] ?>
                    </td>
                    <td>
                        <?= $value['HargaJual'] ?>
                    </td>
                    <td>
                        <?= $value['IdPengguna'] ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>