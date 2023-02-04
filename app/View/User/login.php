<main>
    <?php if (isset($model['error'])) { ?>
    <div class="row">
        <div class="alert alert-danger"
             role="alert">
            <?= $model['error'] ?>
        </div>
    </div>
    <?php } ?>

    <div class="row align-items-center g-lg-5 py-5">

        <div class="col-md-10 mx-auto col-lg-5">
            <h1 class="text-center">LOGIN</h1>
            <form class="p-4 p-md-5 border rounded-3 bg-light"
                  method="post"
                  action="/users/login">
                <div class="form-floating mb-3">
                    <input name="NamaPengguna"
                           type="text"
                           class="form-control"
                           id="id"
                           placeholder="id"
                           value="<?= $_POST['NamaPengguna'] ?? '' ?>">
                    <label for="id">Nama Pengguna</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="Password"
                           type="password"
                           class="form-control"
                           id="password"
                           placeholder="password">
                    <label for="password">Password</label>
                </div>
                <!-- <div class="form-floating mb-3">
                    <select name="IdAkses"
                            id="id-access"
                            class="form-select">
                        <?php foreach ($model['accessList'] as $value) { ?>
                        <option value="<?= $value['IdAkses'] ?>">
                            <?= $value['NamaAkses'] ?>
                        </option>
                        <?php } ?>
                    </select>
                    <label for="id-access">Id Access</label>
                </div> -->
                <button class="w-100 btn btn-lg btn-primary"
                        type="submit">Login</button>
            </form>
        </div>
    </div>


</main>