<?php
/**
 * Render
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @since 1.0.0
 */
function render_utbf_register_form( $props, $content, $render_slug ) {
    // Module specific props added on $this->get_fields()
    $title = $props['title'];

    // Render module content
    $output = sprintf(
        '<h2 class="dicm-title">%1$s</h2>
        <div class="dicm-content">%2$s</div>',
        esc_html( $title ),
        et_sanitized_previously( $content )
    );

    // Render wrapper
    return $output;
}