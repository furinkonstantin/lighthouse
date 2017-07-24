<?php
    
    class CustomIBlock {
    
        const CACHE_TIME = 604800;
    
        /***
            $arSelect - �� ������, ���� ����� ������� � ���������, �� ������������� �������� ��� ����, � ��� ����� ���� ������������ ������ � ������ �������� ������� ����� ����� CIBlockResult::GetNextElement
        ***/
        public function GetElementsByIBlockId($iblockId, $arFilter = array(), $arSort = array(), $arSelectProperties = array()) {
            if (!CModule::IncludeModule("iblock")) {
                die("������ \"�������������� �����\" �� ���������");
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