<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Писатели");
?>

<?
    $customIBlock = new CustomIBlock();
    $authors = $customIBlock->GetElementsByIBlockId(8, array(), array(), array(
        "PROPERTY_BOOKS"
    ));
    $booksIds = array();
    foreach($authors as $author) {
        $booksIds[] = $author["PROPERTY_BOOKS_VALUE"];
    }
    $booksIds = array_unique($booksIds);
    $books = $customIBlock->GetElementsByIBlockId(9, array("ID" => $booksIds), array(), array());
    $resBooks = array();
    foreach($books as $arBook) {
        $resBooks[$arBook["ID"]] = $arBook;
    }
    $resAuthors = array();
    foreach($authors as $author) {
        $resAuthors[$author["ID"]]["FIELDS"] = $author;
        $resAuthors[$author["ID"]]["BOOKS"][] = $resBooks[$author["PROPERTY_BOOKS_VALUE"]];
    }
?>
<table class="table table-condensed">
    <thead>
        <tr>
            <th>№ п/п</th>
            <th>Автор</th>
            <th>Книги</th>
        </tr>
    </thead>
    <tbody>
        <? $count = 1; ?>
        <? foreach($resAuthors as $i => $arAuthor):?>
            <tr>
                <td><?=$count?></td>
                <td><?=$arAuthor["FIELDS"]["NAME"]?></td>
                <td>
                    <? foreach($arAuthor["BOOKS"] as $arBook):?>
                        <?=$arBook["NAME"]?><br/>
                    <? endforeach;?>
                </td>
            </tr>
            <? $count++; ?>
        <? endforeach;?>
    </tbody>
</table>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>