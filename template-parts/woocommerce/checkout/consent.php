<?php
/**
 * Consent
 *
 * @package      WordPress
 * @author       "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @var Array     $args              Args
 */
?>
<div class="wc-block-checkout__consent-blog space-mt-20">
    <label>
        <?=  __( "Authorization to publish photos on the secure blog", UTBF_TEXT_DOMAIN ); ?>&nbsp;<span class="required">*</span>
    </label>
    <div>
        <?php $checked = (isset($_POST['consent-blog']))?  $_POST['consent-blog'] : false;?>
        <input type="radio" name="consent-blog" <?php if($checked ==  __( 'Yes', UTBF_TEXT_DOMAIN )): echo 'checked'; endif;?> value="<?=  __( 'Yes', UTBF_TEXT_DOMAIN ); ?>"/><?=  __( 'Yes', UTBF_TEXT_DOMAIN ); ?>
        <input type="radio" name="consent-blog" <?php if($checked == __( 'No', UTBF_TEXT_DOMAIN )): echo 'checked'; endif;?> value="<?=  __( 'No', UTBF_TEXT_DOMAIN ); ?>"/><?=  __( 'No', UTBF_TEXT_DOMAIN ); ?>
    </div>
</div>
<div class="wc-block-checkout__consent-communication space-mt-20 space-mb-20">
    <label>
        <?=  __( "Authorization to publish photos on the association's communication tools (website, FB, IG, etc.)", UTBF_TEXT_DOMAIN ); ?>&nbsp;<span class="required">*</span>
    </label>
    <div>
        <?php $checked = (isset($_POST['consent-communication']))?  $_POST['consent-communication'] : false;?>
        <input type="radio" name="consent-communication" <?php if($checked ==  __( 'Yes', UTBF_TEXT_DOMAIN )): echo 'checked'; endif;?> value="<?=  __( 'Yes', UTBF_TEXT_DOMAIN ); ?>"/><?=  __( 'Yes', UTBF_TEXT_DOMAIN ); ?>
        <input type="radio" name="consent-communication" <?php if($checked == __( 'No', UTBF_TEXT_DOMAIN )): echo 'checked'; endif;?> value="<?=  __( 'No', UTBF_TEXT_DOMAIN ); ?>"/><?=  __( 'No', UTBF_TEXT_DOMAIN ); ?>
    </div>
</div>