<?php
 if (isset($_POST['submit'])) {
   $url = $_POST['URL'].'/robots.txt';

require 'vendor/autoload.php';
/*
$cont = file_get_contents($url);
var_dump(file_get_contents($url));
$size = filesize($cont);
echo $size."<br>";
*/
$flag =file_exists($url);
var_dump($flag);
echo "<br>";
$is_robot = file_get_contents($url)?true:false;
$parser = new RobotsTxtParser(file_get_contents($url));//http://ladygrad.com.ua/robots.txt
var_dump($parser);
var_dump((bool)$parser);
$content = $parser->getContent();
//$show = $parser->render();
$size = strlen($content);
$size_flag = false;
if($size <= 32000){
  $size_flag = true;
}
//var_dump($content);
//echo $content;
////$size = filesize($content);
echo $size."<br>";
$mainHost = $parser->getHost();
//echo $mainHost."<br>";
var_dump($mainHost);
$status = $parser->setHttpStatusCode(200);
echo $status."<br>";
$sitemaps_array = $parser->getSitemaps();
var_dump($sitemaps_array);
var_dump(http_response_code());
 }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title></title>
  </head>
  <body>
    <table>
      <!-- -------------1----->
      <?php if($is_robot): ?>
    <tr>
      <td rowspan="2">1</td>
      <td rowspan="2">Проверка наличия файла robots.txt</td>
      <td rowspan="2" class="okey">OK</td>
      <td>Состояние</td>
      <td>Файл robots.txt присутствует</td>
    </tr>
    <tr>
      <td>Рекомендации</td>
      <td>Доработки не требуются</td>
   </tr>
 <?php else: ?>
    <tr>
      <td rowspan="2">1</td>
      <td rowspan="2">Проверка наличия файла robots.txt</td>
      <td rowspan="2" class="error">Ошибка</td>
      <td>Состояние</td>
      <td>Файл robots.txt отсутствует</td>
    </tr>
    <tr>
      <td>Рекомендации</td>
      <td>Программист: Создать файл robots.txt и разместить его на сайте.</td>

    </tr>
    <?php endif; ?>

<!-- -------------2----->
  <?php if($mainHost && $is_robot): ?>
<tr>
  <td rowspan="2">6</td>
  <td rowspan="2">Проверка указания директивы Host</td>
  <td rowspan="2" class="okey">OK</td>
  <td>Состояние</td>
  <td>Директива Host указана</td>
</tr>
<tr>
  <td>Рекомендации</td>
  <td>Доработки не требуются</td>

</tr>
<?php else: ?>
<tr>
  <td rowspan="2">6</td>
  <td rowspan="2">Проверка указания директивы Host</td>
  <td rowspan="2" class="error">Ошибка</td>
  <td>Состояние</td>
  <td>В файле robots.txt не указана директива Host</td>
</tr>
<tr>
  <td>Рекомендации</td>
  <td>Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.</td>

</tr>
<?php endif; ?>
<!-- ----------3-------->
  <?php if(true && $is_robot): ?>
<tr>
  <td rowspan="2">8</td>
  <td rowspan="2">Проверка количества директив Host, прописанных в файле</td>
  <td rowspan="2" class="okey">OK</td>
  <td>Состояние</td>
  <td>В файле прописана 1 директива Host</td>
</tr>
<tr>
  <td>Рекомендации</td>
  <td>Доработки не требуются</td>

</tr>
<?php else: ?>
<tr>
  <td rowspan="2">8</td>
  <td rowspan="2">Проверка количества директив Host, прописанных в файле</td>
  <td rowspan="2" class="error">Ошибка</td>
  <td>Состояние</td>
  <td>В файле прописано несколько директив Host</td>
</tr>
<tr>
  <td>Рекомендации</td>
  <td>Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта.</td>

</tr>
<?php endif; ?>
<!-- -----------4------->
  <?php if($size_flag && $is_robot): ?>
<tr>
  <td rowspan="2">10</td>
  <td rowspan="2">Проверка размера файла robots.txt</td>
  <td rowspan="2" class="okey">OK</td>
  <td>Состояние</td>
  <td>Размер файла robots.txt составляет <?= $size ?>, что находится в пределах допустимой нормы</td>
</tr>
<tr>
  <td>Рекомендации</td>
  <td>Доработки не требуются</td>

</tr>
<?php else: ?>
<tr>
  <td rowspan="2">10</td>
  <td rowspan="2">Проверка размера файла robots.txt</td>
  <td rowspan="2" class="error">Ошибка</td>
  <td>Состояние</td>
  <td>Размера файла robots.txt составляет <?= $size ?>, что превышает допустимую норму</td>
</tr>
<tr>
  <td>Рекомендации</td>
  <td>Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32 Кб.</td>

</tr>
<?php endif; ?>
<!-- ----------5-------->
  <?php if($sitemaps_array && $is_robot): ?>
<tr>
  <td rowspan="2">11</td>
  <td rowspan="2">Проверка указания директивы Sitemap</td>
  <td rowspan="2" class="okey">OK</td>
  <td>Состояние</td>
  <td>Директива Sitemap указана</td>
</tr>
<tr>
  <td>Рекомендации</td>
  <td>Доработки не требуются</td>

</tr>
<?php else: ?>
<tr>
  <td rowspan="2">11</td>
  <td rowspan="2">Проверка указания директивы Sitemap</td>
  <td rowspan="2" class="error">Ошибка</td>
  <td>Состояние</td>
  <td>В файле robots.txt не указана директива Sitemap</td>
</tr>
<tr>
  <td>Рекомендации</td>
  <td>Программист: Добавить в файл robots.txt директиву Sitemap</td>

</tr>
<?php endif; ?>
<!-- -------6----------->
  <?php if(false && $is_robot): ?>
<tr>
  <td rowspan="2">12</td>
  <td rowspan="2">Проверка кода ответа сервера для файла robots.txt</td>
  <td rowspan="2" class="okey">OK</td>
  <td>Состояние</td>
  <td>Файл robots.txt отдаёт код ответа сервера 200</td>
</tr>
<tr>
  <td>Рекомендации</td>
  <td>Доработки не требуются</td>

</tr>
<?php else: ?>
<tr>
  <td rowspan="2">12</td>
  <td rowspan="2">Проверка кода ответа сервера для файла robots.txt</td>
  <td rowspan="2" class="error">Ошибка</td>
  <td>Состояние</td>
  <td>При обращении к файлу robots.txt сервер возвращает код ответа (указать код)</td>
</tr>
<tr>
  <td>Рекомендации</td>
  <td>Программист: Файл robots.txt должны отдавать код ответа 200, иначе файл не будет обрабатываться. Необходимо настроить сайт таким образом, чтобы при обращении к файлу robots.txt сервер возвращает код ответа 200</td>

</tr>
<?php endif; ?>
    </table>
  </body>
</html>
