<?php
function autoLoader($className)
{
    require_once __DIR__ . '\\'.$className . '.php';
}
spl_autoload_register('autoLoader');

require_once 'layout_start.php';
//include 'db.php';
use app\Paginator;

$paginator = new Paginator();
$paginator->qtyrec = 5;
$paginator->table = 'region';
$paginator->file = basename(__FILE__);
$paginator->user = "mysql";
$paginator->pass = "";
$paginator->database = "bd";
$paginator->prepare($pdo);

// Определяем метод запроса
$method = $_SERVER['REQUEST_METHOD'];

// Получаем данные из тела запроса
$formData = getFormData($method);

// Получение данных из тела запроса
function getFormData($method)
{

    // GET или POST: данные возвращаем как есть
    if ($method === 'GET') return $_GET;
    if ($method === 'POST') return $_POST;

    // PUT, PATCH или DELETE
    $data = array();
    $exploded = explode('&', file_get_contents('php://input'));
    //В $exploded
    //Array
    //(
    //    [0] => key1=res1
    //    [1] => key2=res2
    //)

    foreach ($exploded as $pair) {
        $item = explode('=', $pair);
        //В $item
        //Array
        //(
        //    [0] => key1
        //    [1] => res1
        //)
        if (count($item) == 2) {
            $data[urldecode($item[0])] = urldecode($item[1]);
        }
    }
    //В $data
    //Array
    //(
    //    [key1] => res1
    //    [key2] => res2
    //)
    return $data;
}
// Разбираем url
$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);

// Определяем роутер и url data
$router = $urls[0];   //первое значение после слеша
$urlData = array_slice($urls, 1); //в массиве остаток только

// Подключаем файл-роутер и запускаем главную функцию
if ($router != '') {
    include_once 'routers/' . $router . '.php';
    route($method, $urlData, $formData);
}
else
{

?>
<h1>Основная таблица</h1>
<?php $array = $paginator->out;
    $arrayId = array();
    $i = 0;
    foreach ($array as $item) {
        $arrayId[$i] = $item;
        $i++;
    }
?>
<a href="/region/create" class="btn btn-info" style="margin: 1em;">Создать</a>
<table class="table equal-width">
    <thead>
    <th>ID</th>
    <th>Имя</th>
    <th>Новое значение</th>
    <th>Действие</th>
    </thead>
    <tbody>
    <?php foreach ($array as $item) { ?>
        <tr>
            <td style="width: 10%"> <?php echo $item['id'] ?> </td>
            <td  style="width: 45%"> <?php echo $item['name'] ?> </td>
            <td  style="width: 45%">
                <label>
                    <input type="text" name="name" value="<?php echo $item['name'] ?>" class="input">
                </label>
            </td>
            <td>
                <form action="/region/<?= $item['id'] ?>/update" method="post" style="display: inline; margin-left: -120px">
                    <button type="submit" class="btn btn-primary">Изменить</button>
                </form>
                <a href="/region/<?= $item['id'] ?>/delete" class="btn btn-danger">Удалить</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php $paginator->viewPaginator(); ?>

<script type="text/javascript">
    $(function () {
        var input = $(".input");

        input.mouseover(function () {
            $(this).css({'border': '1px solid lightskyblue'});
        });

        input.mouseout(function () {
            $(this).css({'border': '0px solid lightskyblue'});
        });
        input.click(function () {
            $(this).css({'display': 'block'});
        });

    });
</script>

<?php require_once 'layout_end.php' ?>
<?php } ?>