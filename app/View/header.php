<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title><?= $model['title'] ?? 'Login Management' ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
        <script type="text/javascript"
                src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <link rel="stylesheet"
              type="text/css"
              href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">

        <script type="text/javascript"
                charset="utf8"
                src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
        </script>
    </head>

    <body>