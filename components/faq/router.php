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

function routes_faq()
{
    return array(
        array(
            '_uri' => '/^faq\/([0-9]+)$/i',
            1      => 'id'
        ),
        array(
            '_uri' => '/^faq\/([0-9]+)\-([0-9]+)$/i',
            1      => 'id',
            2      => 'page'
        ),
        array(
            '_uri' => '/^faq\/quest([0-9]+).html$/i',
            'do'   => 'read',
            1      => 'id'
        ),
        array(
            '_uri' => '/^faq\/delquest([0-9]+).html$/i',
            'do'   => 'delquest',
            1      => 'quest_id'
        ),
        array(
            '_uri' => '/^faq\/sendquest.html$/i',
            'do'   => 'sendquest'
        ),
        array(
            '_uri' => '/^faq\/sendquest([0-9]+).html$/i',
            'do'   => 'sendquest',
            1      => 'category_id'
        )
    );
}
