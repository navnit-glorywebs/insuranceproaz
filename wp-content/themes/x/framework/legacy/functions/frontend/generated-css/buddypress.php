<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/OUTPUT/BUDDYPRESS.PHP
// -----------------------------------------------------------------------------
// Global CSS output for BuddyPress.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Base Styles
// =============================================================================

?>

/* Base Styles
// ========================================================================== */

<?php if ( class_exists( 'BuddyPress' ) ) : ?>

  .buddypress .x-item-list-tabs-nav > ul > li > a:hover,
  .buddypress .x-item-list-tabs-nav > ul > li.current > a,
  .buddypress .x-item-list-tabs-nav > ul > li.selected > a,
  .buddypress .x-item-list-tabs-subnav > ul > li > a:hover,
  .buddypress .x-item-list-tabs-subnav > ul > li.current > a,
  .buddypress .x-list-item-meta-inner > a:hover,
  .buddypress .x-list-item-meta-inner > .generic-button > a:hover,
  .buddypress .x-list-item-meta-inner > .meta > a:hover,
  .buddypress .activity-list .activity-comments .ac-form a:hover {
    color: <?php echo $x_site_link_color; ?>;
  }

  .buddypress .x-bp-count,
  .buddypress .x-item-list-tabs-nav > ul > li > a span,
  .buddypress .button-nav a,
  .buddypress #item-buttons a,
  .buddypress .x-btn-bp,
  .buddypress #whats-new-form #aw-whats-new-submit,
  .buddypress #search-groups-form #groups_search_submit,
  .buddypress .activity-list .activity-comments .ac-form input[type="submit"],
  .buddypress .standard-form input[type="submit"],
  .buddypress .standard-form div.submit input[type="button"],
  #wp-toolbar li#wp-admin-bar-my-account a span.count,
  #wp-toolbar li#wp-admin-bar-my-account-with-avatar a span.count,
  #wp-toolbar li#wp-admin-bar-bp-notifications #ab-pending-notifications,
  #wp-toolbar li#wp-admin-bar-bp-notifications #ab-pending-notifications.alert {
    background-color: <?php echo $x_site_link_color; ?>;
  }

  .buddypress .button-nav a:hover,
  .buddypress #item-buttons a:hover,
  .buddypress .x-btn-bp:hover,
  .buddypress #whats-new-form #aw-whats-new-submit:hover,
  .buddypress #search-groups-form #groups_search_submit:hover,
  .buddypress .activity-list .activity-comments .ac-form input[type="submit"]:hover,
  .buddypress .standard-form input[type="submit"]:hover {
    background-color: <?php echo $x_site_link_color_hover; ?>;
  }

  .buddypress .x-list-item-header .activity,
  .buddypress .x-list-item-header .time-since,
  .buddypress .x-list-item-meta-inner > a,
  .buddypress .x-list-item-meta-inner > .generic-button > a,
  .buddypress .x-list-item-meta-inner > .meta,
  .buddypress .x-list-item-meta-inner > .meta > a,
  .buddypress .activity-list .activity-comments .ac-form a,
  .buddypress .activity-list .x-activity-comments-inner > ul .acomment-options > a:after {
    color: <?php echo $x_body_font_color; ?>;
  }
  #header-cover-image {
    background: url(<?php echo bp_attachments_get_attachment( 'url', array( 'item_id' => bp_displayed_user_id() ) ); ?>) center;
    background-size: cover;
    display: block;
    height:200px;
    margin: 0 0 15px;
  }
<?php endif; ?>