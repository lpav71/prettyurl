<?php
use app\Debugger;
function route($method, $urlData, $formData)
{
    // GET /region/create
    if ($method === 'GET' && count($urlData) === 1 && $urlData[0] === 'create') {
        ?>
        <form action="/region/store" method="post">
            <div class="form-group">
                <label for="name" style="width: 400px">Наименование
                    <input name="name" type="text" class="form-control" id="exampleInputPassword1">
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
        <?php
    }

    // POST /region/store
    if ($method === 'POST' && count($urlData) === 1 && $urlData[0] === 'store') {
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/db.php";
        require($path);

        $stmt = $pdo->prepare("INSERT INTO region(name) VALUES (:name)");
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->execute();

        header("location: /");
    }

    // POST /region/updateall
    if ($method === 'POST' && count($urlData) === 1 && $urlData[0] === 'updateall') {
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/db.php";
        require($path);
        //
        $regs = $_POST;
        $keys = array_keys($regs);  // Массив ключей
        foreach ($keys as $key) {
            $z = $_POST[$key];
            echo $key . ' ' . $z . "<br>";
        }
        return;
    }

    // POST /region/{regionId}/update
    if ($method === 'POST' && count($urlData) === 2 && $urlData[1] === 'update') {
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/db.php";
        require($path);
        //

        echo 'update '.$urlData[0];
        return;
    }

    // GET /region/{regionId}/delete
    if ($method === 'GET' && count($urlData) === 2 && $urlData[1] === 'delete') {
        // Получаем id товара
        $regionId = $urlData[0];

        include 'db.php';
        $stmt = $pdo->prepare("DELETE FROM region WHERE id= :id");
        $stmt->bindParam(':id', $regionId);
        $stmt->execute();

        header("location: /");
    }

    // GET /region/{regionId}/locality
    if ($method === 'GET' && count($urlData) === 2 && $urlData[1] === 'locality') {
        // Получаем id товара
        $regionId = $urlData[0];

        include_once $urlData[1] . '.php';
    }
    return;
}
