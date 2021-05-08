<?php

namespace app;

use PDO;

class Paginator
{
    public $qtyrec; //Количество записей
    public $table;  //Имя таблицы
    public $out;    //Выходной поток
    public $file;   //Текущее имя исполняемого файла. Нужно писать так - $paginator->file = basename(__FILE__);
    public $user;   // Имя пользователя БД
    public $pass;   //Пароль пользователя БД
    public $database; //Имя БД
    private $str_pag; // Количество страниц для пагинации

    public function prepare($pdo)  //$pdo - экземляр драйвера БД
    {
        $host = "localhost";
        $user = $this->user;
        $pass = $this->pass;
        $database = $this->database;
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$database;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, $user, $pass, $opt);
        // Пагинация

        // Текущая страница
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else $page = 1;

        $art = ($page * $this->qtyrec) - $this->qtyrec;

        // Определяем все количество записей в таблице
        $query = "SELECT COUNT(*) FROM " . $this->table;
        $res = $pdo->query($query);
        $array = $res->fetch(PDO::FETCH_ASSOC);
        $total = $array['COUNT(*)']; // всего записей

        // Количество страниц для пагинации
        $this->str_pag = ceil($total / $this->qtyrec);


        // Запрос и вывод записей
        $query = 'SELECT * FROM ' . $this->table . ' LIMIT ' . $art . ',' . $this->qtyrec;
        $stmt = $pdo->query($query);
        $this->out = $stmt->fetchAll();
    }

    public function viewPaginator()
    {
        $file = $this->file; ?>
        <div class="btn-group" role="group" aria-label="Basic example">
            <?php
            for ($i = 1; $i <= $this->str_pag; $i++) {  ?>
                <a href="<?= $file ?>?page=<?= $i ?>" class='btn btn-outline-primary'> <?= $i ?> </a>
            <?php
            }
            echo '</div>';
    }
}