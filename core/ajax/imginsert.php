<?php

/*
 *                           InstantCMS v1.10.7
 *                        http://www.instantcms.ru/
 *
 *                   written by InstantCMS Team, 2007-2017
 *                produced by InstantSoft, (www.instantsoft.ru)
 *
 *                        LICENSED BY GNU/GPL v2
 */

// при ajaxfileupload HTTP_X_REQUESTED_WITH не передается, устанавливем его - костыль :-) см. /core/ajax/ajax_core.php
$_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

define('PATH', __DIR__ . '/../..');

include(PATH . '/core/ajax/ajax_core.php');

// загружать могут только авторизованные
if ( !$inUser->id ) {
    cmsCore::halt();
}

// Получаем компонент, с которого идет загрузка
$component = cmsCore::request('component', 'str', '');

// Проверяем установлен ли он
if ( !$inCore->isComponentInstalled($component) ) {
    cmsCore::halt();
}

// Загружаем конфигурацию компонента
$cfg = $inCore->loadComponentConfig($component);

// проверяем не выключен ли он
if ( !$cfg['component_enabled'] ) {
    cmsCore::halt();
}

// id места назначения
$target_id = cmsCore::request('target_id', 'int', 0);

// место назначения в компоненте
$target = cmsCore::request('target', 'str', '');

$cfg = array_merge(array(
    'img_max'   => 50,
    'img_on'    => 1,
    'watermark' => 1,
    'img_w'     => 900,
    'img_h'     => 900
        ), $cfg);

// Разрешена ли загрузка
if ( !$cfg['img_on'] ) {
    cmsCore::jsonOutput(
            array(
        'error' => $_LANG['UPLOAD_IMG_IS_DISABLE'],
        'msg'   => ''
            ), false
    );
}

// Не превышен ли лимит
if ( cmsCore::getTargetCount($target_id) >= $cfg['img_max'] ) {
    cmsCore::jsonOutput(
            array(
        'error' => $_LANG['UPLOAD_IMG_LIMIT'],
        'msg'   => ''
            ), false
    );
}

// Подготавливаем класс загрузки фото
$inUploadPhoto                = cmsUploadPhoto::getInstance();
$inUploadPhoto->upload_dir    = PATH . '/upload/';
$inUploadPhoto->dir_medium    = $component . '/';
$inUploadPhoto->medium_size_w = $cfg['img_w'];
$inUploadPhoto->medium_size_h = $cfg['img_h'];
$inUploadPhoto->is_watermark  = $cfg['watermark'];
$inUploadPhoto->only_medium   = true;
$inUploadPhoto->input_name    = 'attach_img';

// загружаем фото
$file = $inUploadPhoto->uploadPhoto();

if ( !$file ) {
    cmsCore::jsonOutput(
            array(
        'error' => cmsCore::uploadError(),
        'msg'   => ''
            ), false
    );
}

$fileurl = '/upload/' . $component . '/' . $file['filename'];

cmsCore::registerUploadImages($target_id, $target, $fileurl, $component);

cmsCore::jsonOutput(array( 'error' => '', 'msg' => $fileurl ), false);
