<!DOCTYPE html>
<html>
<head>
    <title>Тестовое phpDev</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">


    <script>
        $(document).ready(function() {
            function loadData(page, perPage) {
                $.ajax({
                    url: 'getData.php',
                    type: 'POST',
                    data: {page: page, perPage: perPage},
                    success: function(response) {
                        $('#dataContainer').html(response);
                    }
                });
            }

            loadData(1, 10);

            $(document).on('click', '.pagination li a', function() {
                var page = $(this).data('page');
                var perPage = $('#perPage').val();
                loadData(page, perPage);
            });

            $(document).on('change', '#perPage', function() {
                var page = 1;
                var perPage = $(this).val();
                loadData(page, perPage);
            });
        });
    </script>
</head>
<body>
   
    <div id="dataContainer"></div>
    <div class="centerblock">
        <label for="perPage">Количество записей на странице:</label>
        <select id="perPage">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="20">20</option>
        </select>
    </div>
</body>
</html>