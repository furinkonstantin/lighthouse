<?php
    
    class CustomIBlock {
    
        const CACHE_TIME = 604800;
    
        /***
            $arSelect - на случай, если много свойств у инфоблока, то нерационально отбирать все поля, а так можно было использовать запрос с полной выборкой свойств через метод CIBlockResult::GetNextElement
        ***/
        public function GetElementsByIBlockId($iblockId, $arFilter = array(), $arSort = array(), $arSelectProperties = array()) {
            if (!CModule::IncludeModule("iblock")) {
                die("Модуль \"Информационные блоки\" не подключен");
            }
            $obCache = new CPHPCache;
            $cache_id = $iblockId;
            $life_time = self::CACHE_TIME;
            $cacheData = $obCache->InitCache($life_time, $cache_id, "/");
            $res = array();
            if($cacheData):
                $vars = $obCache->GetVars();
                $res = $vars["ELEMENTS"];
            else:
                $arrFilter = array("IBLOCK_ID" => $iblockId);
                if (!empty($arFilter)) {
                    $arrFilter = array_merge($arrFilter, $arFilter);
                }
                $arSelectFields = array(
                    "ID",
                    "IBLOCK_ID",
                    "IBLOCK_SECTION_ID",
                    "NAME",
                    "ACTIVE_FROM",
                    "TIMESTAMP_X",
                    "DETAIL_PAGE_URL",
                    "LIST_PAGE_URL",
                    "DETAIL_TEXT",
                    "DETAIL_TEXT_TYPE",
                    "PREVIEW_TEXT",
                    "PREVIEW_TEXT_TYPE",
                    "PREVIEW_PICTURE",
                );
                if (!empty($arSelectProperties)) {
                    $arSelectFields = array_merge($arSelectFields, $arSelectProperties);
                }
                $query = CIBlockElement::GetList($arSort, $arrFilter, false, array(), $arSelectFields);
                while($ob = $query->GetNext())
                {
                    $res[] = $ob;
                }
            endif;
            if($obCache->StartDataCache()):
              $obCache->EndDataCache(array("ELEMENTS" => $res));
            endif;
            return $res;
        }
        
    }