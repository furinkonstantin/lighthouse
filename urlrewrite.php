<?
$arUrlRewrite = array(
    array(
		"CONDITION" => "#^/books/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_ID=$1",
		"ID" => "",
		"PATH" => "/books/detail.php",
	),
);

?>