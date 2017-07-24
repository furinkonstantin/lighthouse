<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Книги");
?>
<?
    $customIBlock = new CustomIBlock();
    $books = $customIBlock->GetElementsByIBlockId(9, array(), array("ID" => "DESC"), array(
        "PROPERTY_COUNT_PAGES",
        "PROPERTY_PUBLISHER",
        "PROPERTY_COVER_TYPE"
    ));
    //На уровне компонента бы создал result_modifier.php и произвел выборку по авторам, которым принадлежат данные книги
    $booksIds = array();
    $resBooks = array();
    foreach($books as $arBook) {
        $booksIds[] = $arBook["ID"];
        $resBooks[$arBook["ID"]] = $arBook;
    }
    $authors = $customIBlock->GetElementsByIBlockId(8, array("PROPERTY_BOOKS" => $booksIds), array(), array(
        "PROPERTY_BOOKS"
    ));
    foreach($authors as $author) {
        $resBooks[$author["PROPERTY_BOOKS_VALUE"]]["AUTHORS"][] = $author; 
    }
?>
<table class="table table-condensed">
    <thead>
        <tr>
            <th>№ п/п</th> <? //Можно было через GetMessage и создать папку lang/ru/ в папке шаблона сайта ?>
            <th>Название</th>
            <th>Количество страниц</th>
            <th>Издатель</th>
            <th>Вид обложки</th>
            <th>Авторы</th>
        </tr>
    </thead>
    <tbody>
        <? $count = 1; ?>
        <? foreach($resBooks as $i => $arBook):?>
            <tr>
                <td><?=$count?></td>
                <td><a href="<?=$arBook["DETAIL_PAGE_URL"]?>"><?=$arBook["NAME"]?></a></td>
                <td><?=$arBook["PROPERTY_COUNT_PAGES_VALUE"]?></td>
                <td><?=$arBook["PROPERTY_PUBLISHER_VALUE"]?></td>
                <td><?=$arBook["PROPERTY_COVER_TYPE_VALUE"]?></td>
                <td>
                    <? foreach($arBook["AUTHORS"] as $arAuthor):?>
                        <?=$arAuthor["NAME"]?><br/>
                    <? endforeach;?>
                </td>
            </tr>
            <? $count++; ?>
        <? endforeach;?>
    </tbody>
</table>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>