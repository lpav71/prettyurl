<?php
use app\debugger;

// Подключение к БД
include 'db.php';

?>
    <!doctype html>
    <html lang="ru">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
              integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
              crossorigin="anonymous">
        <script src="/js/jquery-3.5.1.min.js"></script>

        <link rel="stylesheet" href="/css/index.css">

        <title>REGIONS</title>
    </head>
<body>
<div class="container">
<?php
/*
$kol - количество записей для вывода
$art - с какой записи выводить
$total - всего записей
$page - текущая страница
$str_pag - количество страниц для пагинации
*/

// Пагинация

// Текущая страница
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else $page = 1;

$kol = 3;  //количество записей для вывода
$art = ($page * $kol) - $kol;
//echo $art . '<br>';

// Определяем все количество записей в таблице
$res = $pdo->query("SELECT COUNT(*) FROM region");
$array = $res->fetch(PDO::FETCH_ASSOC);
$total = $array['COUNT(*)']; // всего записей
//echo $total . '<br>';

// Количество страниц для пагинации
$str_pag = ceil($total / $kol);
//echo $str_pag . '<br>';


// Запрос и вывод записей
$query = 'SELECT * FROM region LIMIT ' . $art . ',' . $kol;
$stmt = $pdo->query($query);
$array = $stmt->fetchAll();

?>
    <table class="table">
        <?php foreach ($array as $arr) { ?>
            <tr>
                <td><?= $arr['id'] ?></td>
                <td><?= $arr['name'] ?></td>
            </tr>
        <?php } ?>
    </table>
<?php
// формируем пагинацию
?>
<div class="btn-group" role="group" aria-label="Basic example">
<?php
for ($i = 1; $i <= $str_pag; $i++) {
    echo "<a href=pagination.php?page=".$i." class='btn btn-outline-primary'>".$i."</a>";
}
?>
</div>
