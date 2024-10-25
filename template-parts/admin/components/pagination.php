<?php
/**
 * Pagination
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var String     $count                Count
 * @var String     $ppp_get              Post Per Page
 * @var String     $layout               Layout
 * @var Integer    $paged                Paged
 * @var String     $slug_paged           Slug paged
 */
?>
<?php if($args['count']>$args['ppp_get']) : ?>
    <div class="admin-pagination d-flex<?php if($args['layout']=='all'): echo' pagination-all'; endif;?>" data-ppp="<?= $args['ppp_get']; ?>">
        <div class="tablenav-pages d-flex align-items-center ml-auto ml-lg-0 mt-lg-2 mt-0">
            <?php if($args['layout']!='all'):?>
                <span class="displaying-num"><?= $args['count'] ?> <?php if($args['count']>1): echo __('elements', UTBF_TEXT_DOMAIN); else:  echo __('element', UTBF_TEXT_DOMAIN); endif?></span>
            <?php endif; ?>
            <span class="pagination-links ml-10 d-flex align-items-center">
                <?php //PREV ?>
                <?php if($args['layout']=='all'):?>
                    <div class="prev-page button button-secondary pagination disabled">
                        <span class="screen-reader-text"><?= __( 'Previous page',UTBF_TEXT_DOMAIN); ?></span><span aria-hidden="true">‹</span>
                    </div>
                <?php else: ?>
                    <?php if ( $args['paged'] > 1 ) : ?>
                        <a class="prev-page button button-secondary pagination" href="<?= replace_query_arg(UTBF_CURRENT_URL,$args['slug_paged'],($args['paged']-1)); ?>">
                            <span class="screen-reader-text"><?= __( 'Previous page',UTBF_TEXT_DOMAIN); ?></span><span aria-hidden="true">‹</span>
                        </a>
                    <?php else: ?>
                        <span class="tablenav-pages-navspan button button-secondary disabled pagination" aria-hidden="true">‹</span>
                <?php endif; ?>
                <?php endif; ?>
                <?php //PAGINATION ?>
                <span class="paging-input mx-5">
                    <?php if($args['layout']=='all'):?>
                        <?php for ($i = 1; $i <= ceil($args['count']/$args['ppp_get']); $i++): ?>
                            <?php if ($i == $args['paged']): ?>
                                <li class="active"><span aria-current="page" class="page-numbers current" data-paged="<?= $i; ?>"><?php echo $i; ?></span></li>
                            <?php else: ?>
                                <li>
                                    <span class="page-numbers" data-paged="<?= $i; ?>">
                                        <?= $i; ?>
                                    </span>
                                </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php endif; ?>
                    <?php if($args['layout']=='thead'):?>
                        <label for="current-page-selector" class="screen-reader-text">
                            <?= __( 'Current page',UTBF_TEXT_DOMAIN); ?>
                        </label>
                        <div class="current-page"
                            id="current-page-selector"
                            data-slug-p="<?= $args['slug_paged']; ?>"
                            contenteditable="true"
                            onblur="
                                updateUrl();
                            "
                            onkeydown="
                                if (event.key === 'Enter') {
                                    event.preventDefault(); // Prevent line break
                                    updateUrl();
                                }
                            "
                            style="cursor: pointer; display: inline-block;border-radius: 4px;padding: 5px 10px 5px 10px; border: 1px solid #8c8f94; text-align: center;background:#fff;">
                            <?= $args['paged']; ?>
                        </div>
                        <script>
                            function updateUrl() {
                                var currentUrl = window.location.href;
                                var slugP = document.getElementById('current-page-selector').getAttribute('data-slug-p');
                                var selectedValue = document.getElementById('current-page-selector').innerText.trim();
                                var regex = new RegExp('([?&])' + encodeURIComponent(slugP) + '=.*?(&|$)', 'i');
                                if (regex.test(currentUrl)) {
                                    currentUrl = currentUrl.replace(regex, '$1' + encodeURIComponent(slugP) + '=' + encodeURIComponent(selectedValue) + '$2');
                                } else {
                                    currentUrl += (currentUrl.includes('?') ? '&' : '?') + encodeURIComponent(slugP) + '=' + encodeURIComponent(selectedValue);
                                }
                                window.location.href = currentUrl;
                            }
                        </script>
                    <?php endif; ?>
                    <?php if($args['layout']!='all'):?>
                        <span class="tablenav-paging-text">
                            <?php if($args['layout']=='tfoot'):?>
                                <?= $args['paged'] ?>
                            <?php endif; ?>
                            <?= __( 'on',UTBF_TEXT_DOMAIN); ?>
                            <span class="total-pages"><?= ceil($args['count']/$args['ppp_get']); ?></span>
                        </span>
                    <?php endif; ?>
                </span>
               <?php //NEXT ?>
               <?php if($args['layout']=='all'):?>
                    <div class="next-page button button-secondary pagination">
                        <span class="screen-reader-text"><?= __( 'Next page',UTBF_TEXT_DOMAIN); ?></span><span aria-hidden="true">›</span>
                    </div>
                <?php else: ?>
                    <?php if ( $args['paged'] < ceil($args['count']/$args['ppp_get']) ) : ?>
                        <a class="next-page button button-secondary pagination" href="<?= replace_query_arg(UTBF_CURRENT_URL,$args['slug_paged'],($args['paged']+1)); ?>">
                            <span class="screen-reader-text"><?= __( 'Next page',UTBF_TEXT_DOMAIN); ?></span><span aria-hidden="true">›</span>
                        </a>
                    <?php else: ?>
                        <span class="tablenav-pages-navspan button button-secondary disabled pagination" aria-hidden="true">›</span>
                    <?php endif; ?>
                <?php endif; ?>
            </span>
        </div>
    </div>
<?php endif; ?>