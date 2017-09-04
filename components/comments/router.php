<?php

/*
 *                           InstantCMS v1.10.6
 *                        http://www.instantcms.ru/
 *
 *                   written by InstantCMS Team, 2007-2015
 *                produced by InstantSoft, (www.instantsoft.ru)
 *
 *                        LICENSED BY GNU/GPL v2
 */

function routes_comments()
{
    return array(
        array(
            '_uri' => '/^comments\/add$/i',
            'do'   => 'add'
        ),
        array(
            '_uri' => '/^comments\/edit$/i',
            'do'   => 'edit'
        ),
        array(
            '_uri' => '/^comments\/delete\/([0-9]+)$/i',
            'do'   => 'delete',
            1      => 'id'
        ),
        array(
            '_uri' => '/^comments\/page\-([0-9]+)$/i',
            'do'   => 'view',
            1      => 'page'
        ),
        array(
            '_uri' => '/^comments\/by_user_([a-zA-z0-9\.]+)$/i',
            'do'   => 'view',
            1      => 'login'
        ),
        array(
            '_uri' => '/^comments\/by_user_([a-zA-z0-9\.]+)\/page\-([0-9]+)$/i',
            'do'   => 'view',
            1      => 'login',
            2      => 'page'
        )
    );
}
