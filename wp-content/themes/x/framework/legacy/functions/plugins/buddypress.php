<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/BUDDYPRESS.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Define Constants
//   02. Styles
//   03. Activity
//   04. Members
//   05. Groups
//   06. Blogs
//   07. Item Buttons
//   08. Item Meta
//   09. Miscellaneous
//   10. Template Includes
// =============================================================================


// Define Constants
// =============================================================================

if ( ! defined( 'BP_AVATAR_THUMB_WIDTH' ) ) {
  define( 'BP_AVATAR_THUMB_WIDTH', 45 );
}

if ( ! defined( 'BP_AVATAR_THUMB_HEIGHT' ) ) {
  define( 'BP_AVATAR_THUMB_HEIGHT', 45 );
}

if ( ! defined( 'BP_AVATAR_FULL_WIDTH' ) ) {
  define( 'BP_AVATAR_FULL_WIDTH', 100 );
}

if ( ! defined( 'BP_AVATAR_FULL_HEIGHT' ) ) {
  define( 'BP_AVATAR_FULL_HEIGHT', 100 );
}



// Styles
// =============================================================================

function x_buddypress_enqueue_styles( $stack, $ext ) {
  wp_deregister_style( 'bp-legacy-css' );
  wp_deregister_style( 'bp-admin-bar' );
  wp_enqueue_style( 'x-buddypress', X_TEMPLATE_URL . '/framework/dist/css/site/buddypress/' . $stack . $ext . '.css', [ 'x-stack' ], X_ASSET_REV, 'all' );
}

add_action( 'x_enqueue_styles', 'x_buddypress_enqueue_styles', 10, 2 );


// Activity
// =============================================================================

//
// Alters the text that is appended to the end of an excerpt in the activity
// feed.
//

if ( ! function_exists( 'x_buddypress_activity_excerpt_append_text' ) ) :
  function x_buddypress_activity_excerpt_append_text() {

    return __( 'Read More', '__x__' );

  }
  add_filter( 'bp_activity_excerpt_append_text', 'x_buddypress_activity_excerpt_append_text' );
endif;


//
// Alters the length of the excerpt that appears in the activity feed.
//

if ( ! function_exists( 'x_buddypress_activity_excerpt_length' ) ) :
  function x_buddypress_activity_excerpt_length() {

    return 400;

  }
  add_filter( 'bp_activity_excerpt_length', 'x_buddypress_activity_excerpt_length' );
endif;


//
// The output of the list item header for activity loop items.
//

if ( ! function_exists( 'x_buddypress_activity_list_item_header' ) ) :
  function x_buddypress_activity_list_item_header() { ?>

    <div class="x-list-item-header">
      <div class="x-list-item-avatar-wrap activity-avatar">
        <a href="<?php bp_activity_user_link(); ?>">
          <?php bp_activity_avatar(); ?>
        </a>
      </div>
      <div class="x-list-item-header-info">
        <?php bp_activity_action(); ?>
      </div>
    </div>

  <?php }
endif;


//
// Remove "button" class so that the element can be styled correctly.
//

if ( ! function_exists( 'x_buddypress_get_activity_delete_link' ) ) :
  function x_buddypress_get_activity_delete_link( $link ) {

    return str_replace( 'class="button ', 'class="', $link );

  }
  add_filter( 'bp_get_activity_delete_link', 'x_buddypress_get_activity_delete_link' );
endif;



// Members
// =============================================================================

//
// Class output for the loop items in the main members loop.
//

if ( ! function_exists( 'x_buddypress_members_loop_item_class' ) ) :
  function x_buddypress_members_loop_item_class() {

    echo ( bp_loggedin_user_id() == bp_get_member_user_id() ) ? 'member-item current-member-item' : 'member-item';

  }
endif;

// Disable cover images for members
// add_filter( 'bp_is_profile_cover_image_active', '__return_false' );

//
// The output of the list item header for members loop items.
//

if ( ! function_exists( 'x_buddypress_members_list_item_header' ) ) :
  function x_buddypress_members_list_item_header() { ?>

    <div class="x-list-item-header">
      <div class="x-list-item-avatar-wrap item-avatar">
        <a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar(); ?></a>
      </div>
      <div class="x-list-item-header-info">
        <p>
          <a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
          <?php if ( bp_get_member_latest_update() ) : ?>
            <span class="update"> <?php bp_member_latest_update( array( 'length' => 150, 'view_link' => false ) ); ?></span>
          <?php endif; ?>
          <span class="activity"><?php bp_member_last_active(); ?></span>
        </p>
      </div>
    </div>

  <?php }
endif;


//
// Alters the excerpt length used for messages.
//

if ( ! function_exists( 'x_buddypress_get_message_thread_excerpt' ) ) :
  function x_buddypress_get_message_thread_excerpt() {

    GLOBAL $messages_template;

    return strip_tags( bp_create_excerpt( $messages_template->thread->last_message_content, 200 ) );

  }
  add_filter( 'bp_get_message_thread_excerpt', 'x_buddypress_get_message_thread_excerpt' );
endif;



// Groups
// =============================================================================

//
// Essentially a copy of the bp_groups_members_template_part() function, which
// is used to output the Group members template. This was copied over so that
// the ".x-item-list-tabs-subnav" class could be added.
//

if ( ! function_exists( 'x_buddypress_groups_members_template_part' ) ) :
  function x_buddypress_groups_members_template_part() { ?>

    <div class="x-item-list-tabs-subnav item-list-tabs" id="subnav" role="navigation">
      <ul>
        <li class="groups-members-search" role="search">
          <?php bp_directory_members_search_form(); ?>
        </li>
        <?php bp_groups_members_filter(); ?>
        <?php do_action( 'bp_members_directory_member_sub_types' ); ?>
      </ul>
    </div>
    <div id="members-group-list" class="group_members dir-list">
      <?php bp_get_template_part( 'groups/single/members' ); ?>
    </div>

  <?php }
endif;


//
// The output of the list item header for groups loop items.
//

if ( ! function_exists( 'x_buddypress_groups_list_item_header' ) ) :
  function x_buddypress_groups_list_item_header() { ?>

    <div class="x-list-item-header">
      <div class="x-list-item-avatar-wrap item-avatar">
        <a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumb&width=45&height=45' ); ?></a>
      </div>

      <div class="x-list-item-header-info item-header">
        <p>
          <a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a>
          <span class="activity"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span>
        </p>
      </div>
    </div>

  <?php }
endif;


//
// The output of the list item header for groups invites loop items.
//

if ( ! function_exists( 'x_buddypress_groups_invites_list_item_header' ) ) :
  function x_buddypress_groups_invites_list_item_header() { ?>

    <div class="x-list-item-header">
      <div class="x-list-item-avatar-wrap item-avatar">
        <?php bp_group_invite_user_avatar(); ?>
      </div>
      <div class="x-list-item-header-info">
        <p>
          <?php bp_group_invite_user_link(); ?>
          <span class="activity"><?php bp_group_invite_user_last_active(); ?></span>
        </p>
      </div>
    </div>

  <?php }
endif;



// Disable cover images for groups
add_filter( 'bp_is_groups_cover_image_active', '__return_false' );


// Blogs
// =============================================================================

//
// The output of the list item header for blogs loop items.
//

if ( ! function_exists( 'x_buddypress_blogs_list_item_header' ) ) :
  function x_buddypress_blogs_list_item_header() { ?>

    <div class="x-list-item-header">
      <div class="x-list-item-avatar-wrap item-avatar">
        <a href="<?php bp_blog_permalink(); ?>"><?php bp_blog_avatar( 'type=thumb' ); ?></a>
      </div>
      <div class="x-list-item-header-info">
        <p>
          <a href="<?php bp_blog_permalink(); ?>"><?php bp_blog_name(); ?></a>
          <span class="activity"><?php bp_blog_last_active(); ?></span>
        </p>
      </div>
    </div>

  <?php }
endif;


//
// Alters the output of the bp_get_blog_latest_post() function to only say,
// "Latest Post" for the link text instead of the full post title to prevent
// overly long title names from causing layout issues.
//

if ( ! function_exists( 'x_buddypress_get_blog_latest_post' ) ) :
  function x_buddypress_get_blog_latest_post() {

    GLOBAL $blogs_template;

    $latest_post_title = bp_get_blog_latest_post_title();

    if ( ! empty( $latest_post_title ) ) {
      $output = '<a href="' . $blogs_template->blog->latest_post->guid . '" title="' . $latest_post_title . '">' . __( 'Latest Post', '__x__' ) . '</a>';
    } else {
      $output = __( 'No Posts Yet', '__x__' );
    }

    return $output;

  }
  add_filter( 'bp_get_blog_latest_post', 'x_buddypress_get_blog_latest_post' );
endif;



// Item Buttons
// =============================================================================

//
// A login item button added to the item header for group and member profiles
// when the user looking at the page is not signed in.
//

if ( ! function_exists( 'x_buddypress_login_item_buttons' ) ) :
  function x_buddypress_login_item_buttons() {

    if ( is_user_logged_in() ) {
      return false;
    }

    ?>

    <div class="generic-button">
      <a href="<?php echo wp_login_url(); ?>"><?php _e( 'Log in', '__x__' ); ?></a>
    </div>

    <?php if ( bp_get_signup_allowed() ) : ?>
      <div class="generic-button">
        <a href="<?php echo bp_get_signup_page(); ?>"><?php _e( 'Register', '__x__' ); ?></a>
      </div>
    <?php endif; ?>

  <?php }
  add_action( 'bp_group_header_actions', 'x_buddypress_login_item_buttons' );
  add_action( 'bp_member_header_actions', 'x_buddypress_login_item_buttons' );
endif;


//
// A settings item button added to the item header for member profiles when a
// user is logged in to provide quick settings access.
//

if ( ! function_exists( 'x_buddypress_current_member_item_buttons' ) ) :
  function x_buddypress_current_member_item_buttons() {
    if ( bp_is_my_profile() ) { ?>

      <div class="generic-button">
        <a href="<?php echo trailingslashit( bp_loggedin_user_domain() . bp_get_settings_slug() ); ?>"><?php _e( 'Edit Settings', '__x__' ); ?></a>
      </div>

    <?php }
  }
  add_action( 'bp_member_header_actions', 'x_buddypress_current_member_item_buttons' );
endif;



// Item Meta
// =============================================================================

//
// A meta block in the item meta that appears only when users are not logged
// in on the site. If signups are not allowed, only the "Log in" link will be
// displayed.
//

if ( ! function_exists( 'x_buddypress_logged_out_meta' ) ) :
  function x_buddypress_logged_out_meta() {

    if ( is_user_logged_in() ) {
      return false;
    }

    ?>

    <div class="meta log-in-register">
      <a href="<?php echo wp_login_url(); ?>"><?php _e( 'Log in', '__x__' ); ?></a>
      <?php if ( bp_get_signup_allowed() ) : ?>
        &#x2219; <a href="<?php echo bp_get_signup_page(); ?>"><?php _e( 'Register', '__x__' ); ?></a>
      <?php endif; ?>
    </div>

  <?php }
endif;


//
// Adds a meta link in the item meta that only appears in members lists when
// the current item belongs to the same member that is logged in. Provides a
// quick way to see personal activity.
//

if ( ! function_exists( 'x_buddypress_members_loop_item_current_member_meta_link' ) ) :
  function x_buddypress_members_loop_item_current_member_meta_link() {

    if ( bp_loggedin_user_id() == bp_get_member_user_id() ) { ?>

      <a href="<?php bp_member_permalink(); ?>"><?php _e( 'Your Activity', '__x__' ); ?></a>

    <?php }

  }
  add_action( 'bp_directory_members_actions', 'x_buddypress_members_loop_item_current_member_meta_link' );
  add_action( 'bp_group_members_list_item_action', 'x_buddypress_members_loop_item_current_member_meta_link' );
endif;



// Miscellaneous
// =============================================================================

//
// Outputs a navigation item with quick links to BuddyPress-specific components
// such as the activity feed, current member profile, et cetera.
//

if ( ! function_exists( 'x_buddypress_navbar_menu' ) ) :
  function x_buddypress_navbar_menu( $items, $args ) {

    if ( class_exists( 'BuddyPress' ) && x_get_option( 'x_buddypress_header_menu_enable' ) == '1' && did_action( 'x_classic_headers' ) ) {

      if ( bp_is_active( 'activity' ) ) {
        $logged_out_link = bp_get_activity_directory_permalink();
      } else if ( bp_is_active( 'groups' ) ) {
        $logged_out_link = bp_get_groups_directory_permalink();
      } else {
        $logged_out_link = bp_get_members_directory_permalink();
      }

      $top_level_link = ( is_user_logged_in() ) ? bp_loggedin_user_domain() : $logged_out_link;
      $submenu_items  = '';

      if ( bp_is_active( 'activity' ) ) {
        $submenu_items .= '<li class="menu-item menu-item-buddypress-navigation"><a href="' . bp_get_activity_directory_permalink() . '" class="cf"><i class="x-icon-thumbs-up" data-x-icon-s="&#xf164;" aria-hidden="true"></i> <span>' . x_get_option( 'x_buddypress_activity_title' ) . '</span></a></li>';
      }

      if ( bp_is_active( 'groups' ) ) {
        $submenu_items .= '<li class="menu-item menu-item-buddypress-navigation"><a href="' . bp_get_groups_directory_permalink() . '" class="cf"><i class="x-icon-sitemap" data-x-icon-s="&#xf0e8;" aria-hidden="true"></i> <span>' . x_get_option( 'x_buddypress_groups_title' ) . '</span></a></li>';
      }

      if ( is_multisite() && bp_is_active( 'blogs' ) ) {
        $submenu_items .= '<li class="menu-item menu-item-buddypress-navigation"><a href="' . bp_get_blogs_directory_permalink() . '" class="cf"><i class="x-icon-file" data-x-icon-s="&#xf15b;" aria-hidden="true"></i> <span>' . x_get_option( 'x_buddypress_blogs_title' ) . '</span></a></li>';
      }

      $submenu_items .= '<li class="menu-item menu-item-buddypress-navigation"><a href="' . bp_get_members_directory_permalink() . '" class="cf"><i class="x-icon-male" data-x-icon-s="&#xf183;" aria-hidden="true"></i> <span>' . x_get_option( 'x_buddypress_members_title' ) . '</span></a></li>';

      if ( ! is_user_logged_in() ) {
        if ( bp_get_signup_allowed() ) {
          $submenu_items .= '<li class="menu-item menu-item-buddypress-navigation"><a href="' . bp_get_signup_page() . '" class="cf"><i class="x-icon-pencil" data-x-icon-s="&#xf303;" aria-hidden="true"></i> <span>' . x_get_option( 'x_buddypress_register_title' ) . '</span></a></li>';
          $submenu_items .= '<li class="menu-item menu-item-buddypress-navigation"><a href="' . bp_get_activation_page() . '" class="cf"><i class="x-icon-key" data-x-icon-s="&#xf084;" aria-hidden="true"></i> <span>' . x_get_option( 'x_buddypress_activate_title' ) . '</span></a></li>';
        }
        $submenu_items .= '<li class="menu-item menu-item-buddypress-navigation"><a href="' . wp_login_url() . '" class="cf"><i class="x-icon-sign-in" data-x-icon-s="&#xf2f6;" aria-hidden="true"></i> <span>' . __( 'Log in', '__x__' ) . '</span></a></li>';
      } else {
        $submenu_items .= '<li class="menu-item menu-item-buddypress-navigation"><a href="' . bp_loggedin_user_domain() . '" class="cf"><i class="x-icon-cog" data-x-icon-s="&#xf013;" aria-hidden="true"></i> <span>' . __( 'Profile', '__x__' ) . '</span></a></li>';
        $submenu_items .= '<li class="menu-item menu-item-buddypress-navigation"><a href="' . wp_logout_url() . '" class="cf"><i class="x-icon-sign-logout" data-x-icon-s="&#xf2f5;" aria-hidden="true"></i> <span>' . __( 'Log out', '__x__' ) . '</span></a></li>';
      }

      if ( $args->theme_location == 'primary' ) {
        $items .= '<li class="menu-item current-menu-parent menu-item-has-children x-menu-item x-menu-item-buddypress">'
                  . '<a href="' . $top_level_link . '" class="x-btn-navbar-buddypress">'
                    . '<span><i class="x-icon-user" data-x-icon-s="&#xf007;" aria-hidden="true"></i><span class="x-hidden-desktop"> ' . __( 'Social', '__x__' ) . '</span></span>'
                  . '</a>'
                  . '<ul class="sub-menu">'
                    . $submenu_items
                  . '</ul>'
                . '</li>';
      }
    }

    return $items;

  }
  add_filter( 'wp_nav_menu_items', 'x_buddypress_navbar_menu', 9997, 2 );
endif;


//
// A custom title function that returns the desired data based upon the current
// location in the theme.
//

if ( ! function_exists( 'x_buddypress_get_the_title' ) ) :
  function x_buddypress_get_the_title() {

    if ( bp_is_user() ) {
      $output = bp_get_displayed_user_fullname();
    } else if ( bp_is_current_component( 'activity' ) ) {
      $output = x_get_option( 'x_buddypress_activity_title' );
    } else if ( bp_is_current_component( 'groups' ) ) {
      if ( bp_is_group() ) {
        $output = bp_get_current_group_name();
      } else {
        $output = x_get_option( 'x_buddypress_groups_title' );
      }
    } else if ( bp_is_current_component( 'members' ) ) {
      $output = x_get_option( 'x_buddypress_members_title' );
    } else if ( bp_is_current_component( 'blogs' ) ) {
      $output = x_get_option( 'x_buddypress_blogs_title' );
    } else if ( bp_is_current_component( 'register' ) ) {
      $output = x_get_option( 'x_buddypress_register_title' );
    } else if ( bp_is_current_component( 'activate' ) ) {
      $output = x_get_option( 'x_buddypress_activate_title' );
    } else {
      $output = get_the_title();
    }

    return $output;

  }
endif;


//
// A custom subtitle function that returns the desired data based upon the
// current location in the theme.
//

if ( ! function_exists( 'x_buddypress_get_the_subtitle' ) ) :
  function x_buddypress_get_the_subtitle() {

    if ( bp_is_current_component( 'activity' ) ) {
      $output = x_get_option( 'x_buddypress_activity_subtitle' );
    } else if ( bp_is_current_component( 'groups' ) ) {
      $output = x_get_option( 'x_buddypress_groups_subtitle' );
    } else if ( bp_is_current_component( 'members' ) ) {
      $output = x_get_option( 'x_buddypress_members_subtitle' );
    } else if ( bp_is_current_component( 'blogs' ) ) {
      $output = x_get_option( 'x_buddypress_blogs_subtitle' );
    } else if ( bp_is_current_component( 'register' ) ) {
      $output = x_get_option( 'x_buddypress_register_subtitle' );
    } else if ( bp_is_current_component( 'activate' ) ) {
      $output = x_get_option( 'x_buddypress_activate_subtitle' );
    } else {
      $output = '';
    }

    return $output;

  }
endif;


//
// Checks if the current component is one that should display a landmark
// header.
//

if ( ! function_exists( 'x_buddypress_is_component_with_landmark_header' ) ) :
  function x_buddypress_is_component_with_landmark_header() {

    if (
      bp_is_activity_directory()            ||
      bp_is_groups_directory()              ||
      bp_is_members_directory()             ||
      bp_is_blogs_directory()               ||
      bp_is_current_component( 'register' ) ||
      bp_is_current_component( 'activate' )
    ) {
      return true;
    } else {
      return false;
    }

  }
endif;



// Breadcrumbs
// =============================================================================

add_filter( 'x_breadcrumbs_integrate', function( $crumbs ) {

  if ( ! is_buddypress() ) {
    return $crumbs;
  }

  global $wp;
  $crumbs = [];

  if ( bp_is_group() ) {

    $crumbs[] = array(
      'type'  => 'bp_group',
      'url'   => bp_get_groups_directory_permalink(),
      'label' => x_get_option( 'x_buddypress_groups_title' ),
    );

  } elseif ( bp_is_user() ) {

    $crumbs[] = array(
      'type'  => 'bp_user',
      'url'   => bp_get_members_directory_permalink(),
      'label' => x_get_option( 'x_buddypress_members_title' ),
    );

  }

  $crumbs[] = array(
    'type'  => 'bp',
    'url'   => home_url( $wp->request . '/' ),
    'label' => x_buddypress_get_the_title(),
  );

  return $crumbs;

}, 20);


// Template Includes
// =============================================================================

add_theme_support('buddypress-use-legacy'); // Use legacy as default template

add_filter( 'bp_get_template_stack', function($stack) {
  if (!get_option("x_buddypress_templates_enable", true)) {
    return $stack;
  }

  return array_merge([ X_TEMPLATE_PATH . '/framework/legacy/templates/buddypress'], $stack);
});
