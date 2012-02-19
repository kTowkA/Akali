<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Страница</title>
    </head>
    <body>
        <script>javascript: function param(b, a) {
            //window.alert(b+a);
            document.forma.text.value=b;
            document.forma.actionn.value=a;   
            document.forma.action='ed.php';
            document.forma.submit();
            //window.alert(document.forma.info.value);
        };</script>
        <form name="forma" action="index.php" method="GET">
            <input name="text" type="hidden" value="0" />
            <input name="actionn" type="hidden" value="0" />
            <input name="info" type="hidden" value="0" />
            <button onclick="javascript:document.forma.action='index.php'; document.forma.submit();">показать бд</button>       
        </form>
        <?php
        if (isset($_GET['text'])) {
            require_once 'login.php';
            $db_server = mysql_connect($db_hostname, $db_username, $db_password);
            if (!$db_server)
                die("Невозможно подключиться к mysql" . mysql_error());
            mysql_select_db($db_database)
                    or die("Невозможно выбрать бд" . mysql_error());
            mysql_query('SET NAMES utf8');
            $query = "SELECT b.id_book, b.name, ph.name
                      FROM `books` b, `publishing_house` ph
                      WHERE b.id_publishing_house = ph.id_publishing_house";
            $result = mysql_query($query);
            if (!$result)
                die("Невозможно выполнить запрос" . mysql_error());
            while ($row = mysql_fetch_row($result)) {
                echo "<br />книга: " . $row[1] . "<br />";
                $query2 = "SELECT a.*
                      FROM `author_books` ab, `author` a
                      WHERE ab.id_author=a.id_author AND ab.id_book=" . $row[0] . "";
                $result2 = mysql_query($query2);
                if (!$result2)
                    die("Невозможно выполнить запрос" . mysql_error());
                while ($row2 = mysql_fetch_row($result2)) {
                    echo "автор: " . $row2[1] . " " . $row2[2] . " " . $row2[3] . "<br />";
                }

                echo "Издательский дом: " . $row[2] . "<br />";

                echo "<a href='#' class='upg' id='" . $row[0] . "' onclick='javascript: param(this.id, this.className);' style='text-decoration:none'>Редактирование </a><a href='#' class='del' id='" . $row[0] . "' onclick='javascript: param(this.id, this.className);' style='text-decoration:none'> Удаление</a><br /><br />";
            }
            echo "<a href='#' class='new' id='wtf' onclick='javascript: param(this.id, this.className);' style='text-decoration:none;'>Новая книга</a>";
            mysql_close($db_server);
        } else {    
        }
        ?>
    </body>
</html>
