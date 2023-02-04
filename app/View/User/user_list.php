<main class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="mt-5">
        <h1 class="fw-bold lh-1 mb-3">Hi <?= $model['user']['name'] ?? '' ?>
        </h1>
        <h2 class="fw-bold lh-1 mb-3">
            List Pengguna Kamu
        </h2>
    </div>
    <div class="mt-5"
         style="overflow: auto">
        <table id="table_id"
               class="display">

            <thead>
                <tr>

                    <td>
                        Id Pengguna
                    </td>
                    <td>
                        Nama Pengguna
                    </td>
                    <td>
                        Password
                    </td>
                    <td>
                        Nama Depan
                    </td>
                    <td>
                        Nama Belakang
                    </td>
                    <td>
                        No Hp
                    </td>
                    <td>
                        Alamat
                    </td>
                    <td>
                        Id Akses
                    </td>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($model['users'] as $value) { ?>
                <tr>

                    <td>
                        <?= $value['IdPengguna'] ?>
                    </td>
                    <td>
                        <?= $value['NamaPengguna'] ?>
                    </td>
                    <td>
                        <?= $value['Password'] ?>
                    </td>
                    <td>
                        <?= $value['NamaDepan'] ?>
                    </td>
                    <td>
                        <?= $value['NamaBelakang'] ?>
                    </td>
                    <td>
                        <?= $value['NoHp'] ?>
                    </td>
                    <td>
                        <?= $value['Alamat'] ?>
                    </td>
                    <td>
                        <?= $value['IdAkses'] ?>
                    </td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>