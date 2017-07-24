<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<? if (!empty($_REQUEST["ELEMENT_ID"])):?>
    <?
        $APPLICATION->IncludeComponent("bitrix:form.result.new", "requests", Array(
                "SEF_MODE" => "Y", 
                "WEB_FORM_ID" => "1", 
                "LIST_URL" => "result_list.php", 
                "EDIT_URL" => "result_edit.php", 
                "SUCCESS_URL" => "", 
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_SHADOW" => "N",
                "AJAX_OPTION_JUMP" => "Y",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CHAIN_ITEM_TEXT" => "", 
                "CHAIN_ITEM_LINK" => "", 
                "IGNORE_CUSTOM_TEMPLATE" => "Y", 
                "USE_EXTENDED_ERRORS" => "Y", 
                "CACHE_TYPE" => "A", 
                "CACHE_TIME" => "3600", 
                "SEF_FOLDER" => "/", 
                "VARIABLE_ALIASES" => Array(
                )
            )
        );
    ?>
<? endif; ?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>