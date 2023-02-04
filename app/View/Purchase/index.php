<main class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="mt-5">
        <h1 class="fw-bold lh-1 mb-3">Hi <?= $model['user']['name'] ?? '' ?>
        </h1>
        <h2 class="fw-bold lh-1 mb-3">
            List Pembelian <?= $model['access']['accessId'] == 1
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
                        IdPembelian
                    </td>
                    <td>
                        JumlahPembelian
                    </td>
                    <td>
                        HargaBeli
                    </td>
                    <td>
                        IdPengguna
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model['purchases'] as $value) { ?>
                <tr>
                    <td>
                        <?= $value['IdPembelian'] ?>
                    </td>
                    <td>
                        <?= $value['JumlahPembelian'] ?>
                    </td>
                    <td>
                        <?= $value['HargaBeli'] ?>
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