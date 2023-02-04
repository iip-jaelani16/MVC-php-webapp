<main class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="mt-5">
        <h1 class="fw-bold lh-1 mb-3">Hi <?= $model['user']['name'] ?? '' ?>
        </h1>
        <h2 class="fw-bold lh-1 mb-3">
            List Barang <?= $model['access']['accessId'] == 1
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
                        IdBarang
                    </td>
                    <td>
                        NamaBarang
                    </td>
                    <td>
                        Keterangan
                    </td>
                    <td>
                        Satuan
                    </td>
                    <td align="center">
                        Action
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model['products'] as $value) { ?>
                <tr>
                    <td>
                        <?= $value['IdBarang'] ?>
                    </td>
                    <td>
                        <?= $value['NamaBarang'] ?>
                    </td>
                    <td>
                        <?= $value['Keterangan'] ?>
                    </td>
                    <td>
                        <?= $value['Satuan'] ?>
                    </td>
                    <td>
                        <div style="display:flex;flex-direction:row; gap:10px">
                            <?php if ($model['access']['accessId'] == 3) { ?>
                            <a href="#"
                               class="btn btn-primary">
                                Beli
                            </a>
                            <?php } else { ?>
                            <a href="#"
                               class="btn btn-primary">
                                Update
                            </a>
                            <a href="#"
                               class="btn btn-danger">
                                Delete
                            </a>
                            <?php } ?>

                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>