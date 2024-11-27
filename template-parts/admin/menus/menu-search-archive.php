<?php
/**
 * Menu search Account
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>*
 *
 * @var Array     $args              Args
 */
?>
<div class="wrap">

    <h1><?= __('Search account',UTBF_TEXT_DOMAIN); ?></h1>

    <form method="get" action="">

        <p class="search-box">
            <label class="screen-reader-text" for="user-search-input"><?= __('Search account',UTBF_TEXT_DOMAIN); ?>:</label>
            <input type="hidden" name="page" value="users_search">
            <input type="search" id="user-search-input" name="s" value="<?php if(isset($_GET['s'])): echo $_GET['s']; endif;?>">
            <input type="submit" id="search-submit" class="button" value="<?= __('Search account',UTBF_TEXT_DOMAIN); ?>">
        </p>

        <div class="tablenav top">

            <div class="tablenav-pages">
                <?php
                load_template( UTBF_THEME_PATH . '/template-parts/admin/components/post-per-page.php',null,$args);
                ?>
            </div>

        </div>

        <?php if($args['count']>$args['ppp_get']) : ?>
            <div class="tablenav top">

                <div class="tablenav-pages">
                    <?php
                    load_template( UTBF_THEME_PATH . '/template-parts/admin/components/pagination.php',null,array_merge($args,['layout'=>'thead']));
                    ?>
                </div>

            </div>
        <?php endif; ?>

        <table class="wp-list-table widefat fixed striped table-view-list users">
            <thead>
                <tr>
                    <th scope="col" id="parent" class="manage-column column-parent"><?= __('Parent',UTBF_TEXT_DOMAIN); ?></th>
                    <th scope="col" id="Childs" class="manage-column column-childs"><?= __('Childs',UTBF_TEXT_DOMAIN); ?></th>
                    <th scope="col" id="email" class="manage-column column-email"><?= __('Email',UTBF_TEXT_DOMAIN); ?></th>
                </tr>
            </thead>
            <tbody id="the-list" data-wp-lists="list:user">
                <?php if(!empty($args['users'])):?>
                    <?php foreach($args['users'] as $user): ?>
                        <?php
                        load_template( UTBF_THEME_PATH . '/template-parts/admin/menus/menu-search-item.php',null,$user);
                        ?>
                    <?php endforeach; ?>
                <?php else:?>
                    <tr >
                        <td class="colspanchange" colspan="3">
                            <?= __('No result', UTBF_TEXT_DOMAIN);?>
                        </td>
                    </tr>
                <?php endif;?>

            </tbody>
            <tfoot>
                <tr>
                    <th scope="col" class="manage-column column-parent"><?= __('Parent',UTBF_TEXT_DOMAIN); ?></th>
                    <th scope="col" class="manage-column column-childs"><?= __('Childs',UTBF_TEXT_DOMAIN); ?></th>
                    <th scope="col" class="manage-column column-email"><?= __('Email',UTBF_TEXT_DOMAIN); ?></th>
                </tr>
            </tfoot>
        </table>


        <?php if($args['count']>$args['ppp_get']) : ?>
            <div class="tablenav bottom">

                <div class="tablenav-pages">
                    <?php
                    load_template( UTBF_THEME_PATH . '/template-parts/admin/components/pagination.php',null,array_merge($args,['layout'=>'tfoot']));
                    ?>
                </div>

            </div>
        <?php endif; ?>


    </form>

</div>