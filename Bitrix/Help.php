<!-- Вывод масива, только для админа -->
<?
global $USER;
if($USER -> IsAdmin()){
    echo('<pre>');
    print_r($yourArray);
}
?>
<!-- Вывод масива, только для админа -->

<!-- ======================================================================= -->
dsadasdas
<!-- Получение пользовательских свойств раздела -->
<?$fSections = CIBlockSection::GetList(
    false,
    Array("IBLOCK_ID" => /*Тут id инфоблока*/ , "ID" => /*Тут id раздела*/ , "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y"),
    false,
    Array("Здесь название св-ва"),
    false
);    
    $flSections = $fSections->Fetch();
    $links =  $flSections["Здесь название св-ва"];
    echo $links;
?>
<!-- Получение пользовательских свойств раздела -->

<!-- ======================================================================= -->

<!-- Получение id раздела по вложености -->
<?
$scRes = CIBlockSection::GetNavChain(
    $arResult['IBLOCK_ID'],
    $arResult['IBLOCK_SECTION_ID'],
    array("ID","DEPTH_LEVEL")
);
$ROOT_SECTION_ID = 0;
while($arGrp = $scRes->Fetch()){
// определяем корневой раздел
if ($arGrp['DEPTH_LEVEL'] == 1){
$ROOT_SECTION_ID = $arGrp['ID'];
}
}
?>
<!-- Получение id раздела по вложености -->

<!-- ======================================================================= -->

<!-- Наложение вотермарик на уже загруженные картинки -->
<?
$arWaterMark = Array(
    array(
       "name" => "watermark",
       "position" => "bottomright", // Положение
       "type" => "image",
       "size" => "real",
       "file" => $_SERVER["DOCUMENT_ROOT"].'/upload/copy.png', // Путь к картинке
       "fill" => "exact",
   )

/* Если картинка выводится CFile::GetPath*/
   $img_slide = [
    'ID' => // Здесь вставляем путь к картинке которую нужно зарезайзить как пример вот --> $arElement["DETAIL_PICTURE"],
    'SRC' => CFile::GetPath(// Здесь вставляем путь к картинке),
    'WIDTH' => '',
    'HEIGHT' => ''
];
/* Если картинка выводится CFile::GetPath*/

);
/* Если картинка выводится CFile::GetPath*/
$imgWatermark = CFile::ResizeImageGet($img_slide['ID'], array('width' => $img_slide['WIDTH'], 'height' => $img_slide['HEIGHT']), BX_RESIZE_IMAGE_EXACT, false, $watermarkOne, false, 100)['src'];
 /* Если картинка выводится CFile::GetPath*/


 $arFileTmp = CFile::ResizeImageGet(
// Здесь вставляем путь к картинке которую нужно зарезайзить как пример вот --> $arElement["DETAIL_PICTURE"],
   array("width" => 250, "height" => 127),
   BX_RESIZE_IMAGE_EXACT,
   true,
   $arWaterMark
);
?>
<!-- Наложение вотермарик на уже загруженные картинки -->

<!-- ======================================================================= -->

<!-- Добавление тега canonical для пагинации -->
<?
//Добавляем этот код в bitrix/php_interface/init.php
AddEventHandler('main', 'OnEpilog' , array('CMainPager', 'OnEpilogHandler'));
class CMainPager {
    public static function OnEpilogHandler() {
       if (isset($_GET['PAGEN_1']) && intval($_GET['PAGEN_1'])>0)
       {
           $title = $GLOBALS['APPLICATION']->GetPageProperty("title");
           $GLOBALS['APPLICATION']->SetPageProperty('title', $title.' – Страница '.intval($_GET['PAGEN_1']));
           $description = $GLOBALS['APPLICATION']->GetProperty("description");
           $GLOBALS['APPLICATION']->SetPageProperty('description', $description.' – Страница '.intval($_GET['PAGEN_1']));
           global $APPLICATION;
           $APPLICATION->AddHeadString('<li nk href="https://'.$_SERVER['HTTP_HOST'].$APPLICATION->sDirPath.'" rel="canonical" />',true);

       }
       elseif (isset($_GET['PAGEN_2']) && intval($_GET['PAGEN_2'])>0)
       {
           $title = $GLOBALS['APPLICATION']->GetPageProperty("title");
           $GLOBALS['APPLICATION']->SetPageProperty('title', $title.' – Страница '.intval($_GET['PAGEN_2']));
           $description = $GLOBALS['APPLICATION']->GetProperty("description");
           $GLOBALS['APPLICATION']->SetPageProperty('description', $description.' – Страница '.intval($_GET['PAGEN_2']));
           global $APPLICATION;
           $APPLICATION->AddHeadString('<li nk href="https://'.$_SERVER['HTTP_HOST'].$APPLICATION->sDirPath.'" rel="canonical" />',true);

       }
   }
}
?>
<!-- Добавление тега canonical для пагинации -->

<!-- ======================================================================= -->