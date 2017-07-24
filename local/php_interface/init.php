<?php

    use Bitrix\Main\Diag\Debug;

    CModule::AddAutoloadClasses(
        "",
        array(
            'CustomIBlock' => '/local/php_interface/classes/CustomIBlock.php',
        )
    );
    
    AddEventHandler("main", "OnBeforeEventAdd", array("MyClass", "OnBeforeEventAddHandler"));
    AddEventHandler("main", "OnBeforeEventSend", array("MyClass", "OnBeforeEventSendHandler"));
    class MyClass
    {
        
        function OnBeforeEventSendHandler($arFields, $arTemplate) {
            Debug::writeToFile(array('RESULT_ID' => $arFields["RS_RESULT_ID"], 'fields'=>$arTemplate["MESSAGE"]), "form");
        }
    
        function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
        {
            if ($event == "FORM_FILLING_SIMPLE_FORM_1") {
                $arFields["CUSTOM"] = "ok";
            }
        }
    }