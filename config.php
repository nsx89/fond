<?php

return [
    'routes' => [
        'admin/ajax' => 'adminAjax',
        'admin/logout' => 'adminLogout',
        'admin/([a-zA-Z0-9-_/]+)' => 'adminPanel/$1',
        'admin' => 'admin',
        'cms' => 'admin',
        'helpers/([a-zA-Z0-9-/]+)' => 'HelpersController/$1',
        'user/ajax' => 'userAjax',
        'statii' => 'ArticlesController',
        'statii/([a-zA-Z0-9-/]+)' => 'ArticlesController/$1',
        '/' => 'PageController',
        '^([a-zA-Z0-9-._/]+)$' => 'PageController/$1',
        '(.*)' => 'error',
    ],
    'adminPanel' => [
        'pages' => 'Страницы',
        'modules' => [
            '' => 'Модули',
            'banners' => 'Баннеры',
            'video' => 'Видео',
            'volunteers' => 'Волонтеры',
            'documents' => 'Документы',
            'medals' => 'Медали',
        ],
        'articles' => 'Статьи',
        'users' => [
            '' => 'Пользователи',
            'users' => 'Пользователи',
            'users_ip' => 'Разрешённые IP адреса для входа',
        ],
        'forms' => 'Заявки',
        'seo' => 'SEO',
        'settings' => 'Настройки',
    ]
];

?>
