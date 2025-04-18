<?php 
/**
* Metabox for Page Layout
*
* @package arilewp
*
*/ 

function arilewp_add_sidebar_layout_box(){
    add_meta_box(  'arilewp_sidebar_layout', __( 'Sidebar Layout', 'arilewp' ), 'arilewp_sidebar_layout_callback', 'page', 'normal', 'high' );
}
add_action( 'admin_init', 'arilewp_add_sidebar_layout_box' );

	
	$arilewp_sidebar_layout = array( 

    'right-sidebar' => array(
         'value'     => 'right-sidebar',
    	 'thumbnail' => get_template_directory_uri() . '/assets/img/theme-right-sidebar.png'         
     ),   
    'no-sidebar'     => array(
    	 'value'     => 'no-sidebar',
    	 'thumbnail' => get_template_directory_uri() . '/assets/img/theme-fullwidth.png'
   	),    
    'left-sidebar' => array(
         'value'     => 'left-sidebar',
    	 'thumbnail' => get_template_directory_uri() . '/assets/img/theme-left-sidebar.png'         
    ),
  
);

function arilewp_sidebar_layout_callback(){
    global $post , $arilewp_sidebar_layout;


    wp_nonce_field( basename( __FILE__ ), 'arilewp_nonce' );
?>
 
<table class="form-table">
    <tr>
        <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template for the Default Page Templates', 'arilewp' ); ?></em></td>
    </tr>

    <tr>
        <td>
        <?php  
            foreach( $arilewp_sidebar_layout as $field ){  
                $layout = sanitize_text_field( get_post_meta( $post->ID, '_sidebar_layout', true ) ); ?>

            <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                <label class="description">
                    <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span><br/>
                    <input type="radio" name="arilewp_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout ); if( empty( $layout ) ){ checked( $field['value'], 'right-sidebar' ); }?>/>
                </label>
            </div>
            <?php } // end foreach 
            ?>
            <div class="clear"></div>
        </td>
    </tr>
</table>
 
<?php 
}
function arilewp_save_sidebar_layout( $post_id ){
      global $arilewp_sidebar_layout , $post;

       // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'arilewp_nonce' ] ) || !wp_verify_nonce( $_POST[ 'arilewp_nonce' ], basename( __FILE__ ) ) )
        return;
    
 // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;

    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }
    foreach( $arilewp_sidebar_layout as $field ){  
        //Execute this saving function
        $old = get_post_meta( $post_id, '_sidebar_layout', true ); 
        $new = isset( $_POST['arilewp_sidebar_layout'] ) ? sanitize_key( $_POST['arilewp_sidebar_layout'] ) : 'right-sidebar';
        if( $new && $new != $old ) {  
            update_post_meta( $post_id, '_sidebar_layout', $new );  
        }elseif( '' == $new && $old ) {  
            delete_post_meta( $post_id, '_sidebar_layout', $old );  
        } 
     } // end foreach     
}
add_action( 'save_post' , 'arilewp_save_sidebar_layout' );