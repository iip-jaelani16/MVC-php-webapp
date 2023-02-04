<?php
if (isset($model['user']) && $model['user']['name'] !== null) { ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse"
             id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link"
                       aria-current="page"
                       href="/">Dashboard</a>
                </li>
                <?php if ($model['access']['accessId'] == 1) { ?>
                <li class="nav-item">
                    <a class="nav-link"
                       href="users">Pengguna</a>
                </li>
                <?php } ?>
                <?php if (
                  $model['access']['accessId'] == 3 ||
                  $model['access']['accessId'] == 2 ||
                  $model['access']['accessId'] == 1
                ) { ?>
                <li class="nav-item">
                    <a class="nav-link"
                       href="/product">List Barang</a>
                </li>
                <?php } ?>
                <?php if (
                  $model['access']['accessId'] == 2 ||
                  $model['access']['accessId'] == 1
                ) { ?>
                <li class="nav-item">
                    <a class="nav-link"
                       href="/sale">Penjualan</a>
                </li>
                <?php } ?>
                <?php if (
                  $model['access']['accessId'] == 3 ||
                  $model['access']['accessId'] == 1
                ) { ?>
                <li class="nav-item">
                    <a href="/purchase"
                       class="nav-link">Pembelian</a>
                </li>
                <?php } ?>
            </ul>
            <div class="d-flex">
                <a href="/users/logout"
                   class="w-100 btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</nav>
<?php }
?>