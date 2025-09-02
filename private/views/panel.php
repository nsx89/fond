<?php require __DIR__ . '/../views/layouts/header.php'; ?>
    <div class='admin_panel'>
        <aside class='admin_nav'>
            <nav>
                <?php

                $URI = strtok($_SERVER["REQUEST_URI"], '?');

                foreach (\app\Models\Admin::getMenu() as $file => $name):
                    $i = 0;

                    $num = '';
                    switch ($file) {
                        case 'forms':
                            $forms = app\Models\Forms::findWhere("WHERE `read` = 0");
                            if (!empty($forms)) {
                                $num = count($forms);
                            }
                            break;
                        case 'orders':
                            $orders = app\Models\Orders::findWhere("WHERE `read` = 0");
                            if (!empty($orders)) {
                                $num = count($orders);
                            }
                            break;
                    }

                    if (!is_array($name)): ?>
                        <a href='/admin/<?= $file ?>'
                            class='admin_menu_link <?= (strpos($URI,'admin/'.$file) != '') ? 'admin_menu_link_act' : '' ?>'>
                            <?= $name ?> <i><?= $num ?></i>
                        </a>
                    <?php else:
                        $nn = array_shift($name);
                        $f = 0;
                        foreach ($name as $fn=>$nm) :
                            if($URI == '/admin/' . $fn) { $f = 1; }
                        endforeach;
                        ?>
                        <div class='admin_menu_link admin_menu_link2<?= ($f == 1)?' admin_menu_link_act':'' ?>'>
                            <span><?= $nn ?> <i><?= $num ?></i></span>
                            <div class='admin_panel-open-block<?= ($f == 1)?' set':'' ?>'>
                                <?php foreach ($name as $fn=>$nm) : ?>
                                    <?
                                    $num_child = '';
                                    switch ($fn) {
                                        case 'orders':
                                            $num_child = $num;
                                            break;
                                    }
                                    ?>
                                    <div class='leftLink<?= ($URI == '/admin/' . $fn) ? ' leftLinkAct' : '' ?>'>
                                        <a href='/admin/<?= $fn ?>' class='admin_link'>
                                            <?= $nm ?> <i><?= $num_child ?></i>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <? endif;
                endforeach; ?>
            </nav>

            <div class='admin_copyright'>
            </div>
        </aside>
        <div class='admin_content'>
             <div class='admin_content_scroll'>
                 <?= ($this->module) ?: 'Данный модуль не существует' ?>
             </div>
        </div>
        <? if(isset($_GET['add']) || isset($_GET['edit']) || isset($_GET['edit_item']) || isset($_GET['edit_property']) || $_SERVER['REQUEST_URI'] == '/admin/settings') : ?>
            <div class='button save'>Сохранить</div>
        <? endif; ?>
    </div>
<?php require __DIR__ . '/../views/layouts/footer.php';
