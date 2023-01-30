<?php

function general_admin_notice(){
  
  if ( function_exists( 'acf_get_field_groups' ) ) {
    $groups = acf_get_field_groups();
    $sync   = array();
    // bail early if no field groups
    if( empty( $groups ) )
      return;
    // find JSON field groups which have not yet been imported
    foreach( $groups as $group ) {
      // vars
      $local    = acf_maybe_get( $group, 'local', false );
      $modified = acf_maybe_get( $group, 'modified', 0 );
      $private  = acf_maybe_get( $group, 'private', false );
      // ignore DB / PHP / private field groups
      if( $local !== 'json' || $private ) {
        // do nothing
      } elseif( ! $group[ 'ID' ] ) {
        $sync[ $group[ 'key' ] ] = $group;
      } elseif( $modified && $modified > get_post_modified_time( 'U', true, $group[ 'ID' ], true ) ) {
        $sync[ $group[ 'key' ] ]  = $group;
      }
    }
    // bail if no sync needed
    if( empty( $sync ) )
      return;
    if( ! empty( $sync ) ) {
      echo '<div class="notice notice-error"><p>In order to avoid conflicts between different branches of the site please <a href="'.get_admin_url().'edit.php?post_type=acf-field-group&post_status=sync">sync the acf fields</a></p><p>If you are seeing this message and do not know what it means, please reach out to the site developer</p></div>';
    }
  }
}

add_action('admin_notices', 'general_admin_notice');


?>