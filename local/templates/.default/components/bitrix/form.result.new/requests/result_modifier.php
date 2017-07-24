<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?php

    $customIBlock = new CustomIBlock();
    $books = $customIBlock->GetElementsByIBlockId(
        9, 
        array(
            "ID" => $_REQUEST["ELEMENT_ID"]
        ), 
        array("ID" => "DESC"), 
        array(
            "PROPERTY_COUNT_PAGES",
            "PROPERTY_PUBLISHER",
            "PROPERTY_COVER_TYPE"
        )
    );
    $book = $books[0];
    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
        if ($arQuestion["STRUCTURE"][0]["FIELD_ID"] == "1") {
            $arQuestion["HTML_CODE"] = str_replace("value=\"\"", "value=\"".$book["NAME"]."\" readonly=\"readonly\"", $arQuestion["HTML_CODE"]);
        }
        $arResult["QUESTIONS"][$FIELD_SID] = $arQuestion;
    }