<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form id="form_edit2" name="form_edit" action="ed.php" method="GET">
            <input name="book_id" type="hidden" value="00"> 
            <input name="act" type="hidden" value="00" />
            <div style="display: none;" id="con_edit">
                <H2 id="zag">Изменение книги</H2>
                <input id="book" name="bk" type="text" size="23" value="">
                <b><br />Авторы</b><br>
                <input type="checkbox" name="check[]" id="option1" value="1">Иванов Иван Иванович<br>
                <input type="checkbox" name="check[]" id="option2" value="2">Петров Петр Петрович<br>
                <input type="checkbox" name="check[]" id="option3" value="3">Алексеев Алексей Алексеевич<br> 
                <b>Издательство</b><br>
                <SELECT NAME="PH" size="1">
                    <OPTION id="s1" VALUE="1">Какой-то</option>
                    <OPTION id="s2" VALUE="2">Что-то</option>
                    <OPTION id="s3" VALUE="3">Бдыщ</option>
                    <OPTION id="s4" VALUE="4">Bazzinga</option>
                </SELECT>
            </div>
            <div style="display: none;" name="delete_con">

            </div>  

            <?php
            if (isset($_GET['actionn'])) { //если переход с главной
                switch ($_GET['actionn']) { //показать книгу которую хотим изменить
                    case 'upg': {
                            echo '<script>document.getElementById("con_edit").style.display="block";</script>';
                            require_once 'login.php';
                            $db_server = mysql_connect($db_hostname, $db_username, $db_password);
                            if (!$db_server)
                                die("Невозможно подключиться к mysql" . mysql_error());
                            mysql_select_db($db_database)
                                    or die("Невозможно выбрать бд" . mysql_error());
                            mysql_query('SET NAMES utf8');
                            $query = "SELECT b.id_book, b.name, ph.name, ph.id_publishing_house
                      FROM `books` b, `publishing_house` ph
                      WHERE b.id_book=" . intval($_GET['text']) . " and b.id_publishing_house = ph.id_publishing_house";
                            $result = mysql_query($query);
                            if (!$result)
                                die("Невозможно выполнить запрос" . mysql_error());
                            $row = mysql_fetch_row($result);
                            echo '<script>document.getElementById("book").value="' . $row[1] . '"</script>';
                            $query2 = "SELECT a.*
                      FROM `author_books` ab, `author` a
                      WHERE ab.id_author=a.id_author AND ab.id_book=" . $row[0] . "";
                            $result2 = mysql_query($query2);
                            if (!$result2)
                                die("Невозможно выполнить запрос" . mysql_error());
                            while ($row2 = mysql_fetch_row($result2)) {
                                echo '<script>document.getElementById("option' . $row2[0] . '").checked=true;</script>';
                            }
                            echo '<script>document.getElementById("s' . $row[3] . '").selected=true;</script>';
                            mysql_close($db_server);
                            echo '<script>javascript: document.form_edit.book_id.value="' . $_GET['text'] . '"</script>';
                            echo '<script>javascript: document.form_edit.act.value="upg"</script>';
                            break;
                        }
                    case 'del': { //показать книгу,которую хотим удалить
                            require_once 'login.php';
                            $db_server = mysql_connect($db_hostname, $db_username, $db_password);
                            if (!$db_server)
                                die("Невозможно подключиться к mysql" . mysql_error());
                            mysql_select_db($db_database)
                                    or die("Невозможно выбрать бд" . mysql_error());
                            mysql_query('SET NAMES utf8');
                            $query = "SELECT b.id_book, b.name, ph.name
                      FROM `books` b, `publishing_house` ph
                      WHERE b.id_book=" . intval($_GET['text']) . " and b.id_publishing_house = ph.id_publishing_house";
                            $result = mysql_query($query);
                            if (!$result)
                                die("Невозможно выполнить запрос" . mysql_error());
                            $row = mysql_fetch_row($result);
                            echo "<H2>Вы хотите удалить эту книгу?</H2>";
                            echo "книга: " . $row[1] . "<br />";
                            $query2 = "SELECT a.*
                      FROM `author_books` ab, `author` a
                      WHERE ab.id_author=a.id_author AND ab.id_book=" . $row[0] . "";
                            $result2 = mysql_query($query2);
                            if (!$result2)
                                die("Невозможно выполнить запрос" . mysql_error());
                            while ($row2 = mysql_fetch_row($result2)) {
                                echo "автор: " . $row2[1] . " " . $row2[2] . " " . $row2[3] . "<br />";
                            }
                            echo "Издательский дом: " . $row[2] . "<br /><br />";
                            mysql_close($db_server);
                            echo '<script>javascript: document.form_edit.book_id.value="' . $_GET['text'] . '"</script>';
                            echo '<script>javascript: document.form_edit.act.value="del"</script>';
                            // echo '<script>window.alert(document.form_edit.act.value)</script>';
                            break;
                        }
                    case 'new': {
                            echo '<script>javascript: document.form_edit.act.value="new";</script>';
                            echo '<script>document.getElementById("zag").innerHTML="Новая книга"</script>';
                            echo '<script>document.getElementById("con_edit").style.display="block";</script>';
                            break;
                        }
                }
            } else
            if (isset($_GET['book_id'])) {
                switch ($_GET['act']) {
                    case 'del': {
                            require_once 'login.php';
                            $db_server = mysql_connect($db_hostname, $db_username, $db_password);
                            if (!$db_server)
                                die("Невозможно подключиться к mysql" . mysql_error());
                            mysql_select_db($db_database)
                                    or die("Невозможно выбрать бд" . mysql_error());
                            mysql_query('SET NAMES utf8');
                            $query = "DELETE
                      FROM `books` 
                      WHERE id_book=" . intval($_GET['book_id']) . "";
                            $result = mysql_query($query);
                            if (!$result)
                                die("Невозможно выполнить запрос" . mysql_error());
                            $query = "DELETE
                      FROM `author_books` 
                      WHERE id_book=" . intval($_GET['book_id']) . "";
                            $result = mysql_query($query);
                            if (!$result)
                                die("Невозможно выполнить запрос" . mysql_error());
                            else
                                echo '<script>window.alert("Удалили!"); document.form_edit.action="index.php"; document.form_edit.submit();</script>';
                            mysql_close($db_server);
                            break;
                        }
                    case 'upg': {
                            $error=0;
                            require_once 'login.php';
                            $db_server = mysql_connect($db_hostname, $db_username, $db_password);
                            if (!$db_server)
                            {
                                $error=1;
                                die("Невозможно подключиться к mysql" . mysql_error());
                            }
                            mysql_select_db($db_database)
                                    or die("Невозможно выбрать бд" . mysql_error());
                            mysql_query('SET NAMES utf8');
                            $query = "UPDATE `test`.`books` SET `name` = '" . $_GET['bk'] . "',`id_publishing_house` = '" . $_GET['PH'] . "' WHERE `books`.`id_book` =" . intval($_GET['book_id']) . ";";
                            $result = mysql_query($query);
                            if (!$result) {
                                 $error=1;
                                die("Невозможно выполнить запрос" . mysql_error());
                            }
                            if (isset($_GET['check'])) {
                                $query = "DELETE FROM `author_books` WHERE id_book=" . intval($_GET['book_id']) . "";
                                $result = mysql_query($query);
                                if (!$result)
                                {
                                     $error=1;
                                    die("Невозможно выполнить запрос" . mysql_error());
                                }
                                $check = $_GET['check'];
                                foreach ($check as $ch) {
                                    $query3 = "INSERT INTO `test`.`author_books` (`id_author`, `id_book`) VALUES ('" . $ch . "', '" . $_GET['book_id'] . "');;";
                                    $result3 = mysql_query($query3);
                                    if (!$result3) {
                                         $error=1;
                                        die("Невозможно выполнить запрос" . mysql_error());
                                    }
                                }
                            }
                            if ($error==0)
                            {
                                    echo '<script>window.alert("Изменили!"); document.form_edit.action="index.php"; document.form_edit.submit();</script>';    
                            }
                            else
                            {
                                     echo '<script>window.alert("Изменить не получилось!"); document.form_edit.action="index.php"; document.form_edit.submit();</script>';   
                            }
                            mysql_close($db_server);
                            break;
                        }
                    case 'new': {
                            $error = 0;
                            require_once 'login.php';
                            $db_server = mysql_connect($db_hostname, $db_username, $db_password);
                            if (!$db_server)
                                die("Невозможно подключиться к mysql" . mysql_error());
                            mysql_select_db($db_database)
                                    or die("Невозможно выбрать бд" . mysql_error());
                            mysql_query('SET NAMES utf8');
                            $query = "INSERT INTO `books`(`id_book` ,`name` ,`id_publishing_house`) VALUES (NULL , '" . $_GET['bk'] . "', '" . $_GET['PH'] . "');";
                            $result = mysql_query($query);
                            if (!$result) {
                                $error = 1;
                                die("Невозможно выполнить запрос" . mysql_error());
                            } else {
                                if (isset($_GET['check'])) {
                                    $check = $_GET['check'];
                                    $query2 = "SELECT * FROM `books` ORDER BY `id_book` DESC LIMIT 0,1";
                                    $result2 = mysql_query($query2);
                                    if (!$result2) {
                                        $error = 1;
                                        die("Невозможно выполнить запрос" . mysql_error());
                                    }
                                    $row2 = mysql_fetch_row($result2);

                                    foreach ($check as $ch) {
                                        $query3 = "INSERT INTO `test`.`author_books` (`id_author`, `id_book`) VALUES ('" . $ch . "', '" . $row2[0] . "');;";
                                        $result3 = mysql_query($query3);
                                        if (!$result3) {
                                            $error = 1;
                                            die("Невозможно выполнить запрос" . mysql_error());
                                        }
                                    }
                                }
                            }
                            if ($error == 0)
                                echo '<script>window.alert("Добавили!"); document.form_edit.action="index.php"; document.form_edit.submit();</script>';
                            else
                                echo '<script>window.alert("Произошла ошибка!"); document.form_edit.action="index.php"; document.form_edit.submit();</script>';
                            mysql_close($db_server);
                            break;
                        }
                }
            }
            ?>
            <button onclick="javascript: document.form_edit.submit();">Принять</button>
            <button onclick="javascript: document.form_edit.action='index.php'; document.form_edit.submit();" name="cancel">Отмена</button>
        </form>  
    </body>
</html>
