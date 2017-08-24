<?php
/**
 * The template for displaying meta box in page/post
 *
 * This adds Layout Options, Select Sidebar, Header Freatured Image Options, Single Page/Post Image Layout
 * This is only for the design purpose and not used to save any content
 *
 * @package Fabulous Fluid
 */


/**
 * Class to Add, Render and save metabox options
 *
 * @since Fabulous Fluid 0.2
 */
class FabulousFluidMetaBox {
	private $meta_box;

	private $fields;

	/**
	* Constructor
	*
	* @since Fabulous Fluid 0.2
	*
	* @access public
	*
	*/
	public function __construct( $meta_box_id, $meta_box_title, $post_type ) {

		$this->meta_box = array (
							'id' 		=> $meta_box_id,
							'title' 	=> $meta_box_title,
							'post_type' => $post_type,
							);

		$this->fields = array(
							'fabulous-fluid-layout-option',
							'fabulous-fluid-header-image',
							'fabulous-fluid-featured-image',
							);


		// Add metaboxes
		add_action( 'add_meta_boxes', array( $this, 'add' ) );

		add_action( 'save_post', array( $this, 'save' ) );
   	}

	/**
	* Add Meta Box for multiple post types.
	*
	* @since Fabulous Fluid 1.
	*
	* @access public
	*/
	public function add( $postType ) {
		if( in_array( $postType, $this->meta_box['post_type'] ) ) {
			add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $postType );
		}
	}

	/**
	* Renders metabox
	*
	* @since Fabulous Fluid 0.2
	*
	* @access public
	*/
	public function show() {
		global $post;

		$layout_options			= fabulous_fluid_metabox_layouts();
		$featured_image_options	= fabulous_fluid_metabox_featured_image_options();
		$header_image_options 	= fabulous_fluid_metabox_header_featured_image_options();


	    // Use nonce for verification
	    wp_nonce_field( basename( __FILE__ ), 'fabulous_fluid_custom_meta_box_nonce' );

	    // Begin the field table and loop  ?>
	    <div id="fabulous-fluid-ui-tabs" class="ui-tabs">
		    <ul class="fabulous-fluid-ui-tabs-nav" id="fabulous-fluid-ui-tabs-nav">
		    	<li><a href="#frag1"><?php _e( 'Layout Options', 'fabulous-fluid' ); ?></a></li>
		    	<li><a href="#frag3"><?php _e( 'Header Featured Image Options', 'fabulous-fluid' ); ?></a></li>
		    	<li><a href="#frag4"><?php _e( 'Single Page/Post Image Layout ', 'fabulous-fluid' ); ?></a></li>
		    </ul>
		    <div id="frag1" class="catch_ad_tabhead">
		    	<table id="layout-options" class="form-table" width="100%">
		            <tbody>
		                <tr>
		                    <select name="fabulous-fluid-layout-option" id="custom_element_grid_class">
		      					<?php
			                    foreach ( $layout_options as $field ) {
			                        $metalayout = get_post_meta( $post->ID, 'fabulous-fluid-layout-option', true );
			                        if( empty( $metalayout ) ){
			                            $metalayout='default';
			                        }
			                   	?>
			                   		<option value="<?php echo $field['value']; ?>" <?php selected( $metalayout, $field['value'] ); ?>><?php echo $field['label']; ?></option>
		    					<?php
		    					} // end foreach
			                    ?>
		                    </select>
		                </tr>
		            </tbody>
		        </table>
		    </div>

		    <div id="frag3" class="catch_ad_tabhead">
		    	<table id="header-image-metabox" class="form-table" width="100%">
		            <tbody>
		                <tr>
		                    <?php
		                    foreach ( $header_image_options as $field ) {

							 	$metaheader = get_post_meta( $post->ID, $field['id'], true );

		                        if ( empty( $metaheader ) ){
		                            $metaheader='default';
		                        }
		                    ?>

		                        <td style="width: 100px;">
		                            <label class="description">
		                                <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metaheader ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
		                            </label>
		                        </td>

		                    <?php
		                    } // end foreach
		                    ?>
		                </tr>
		            </tbody>
		        </table>
		    </div>

		    <div id="frag4" class="catch_ad_tabhead">
		    	<table id="featured-image-metabox" class="form-table" width="100%">
		            <tbody>
		                <tr>
		                    <?php
		                    foreach ($featured_image_options as $field) {

							 	$metaimage = get_post_meta( $post->ID, $field['id'], true );

		                        if (empty( $metaimage ) ){
		                            $metaimage='default';
		                        }
		                    ?>
		                        <td style="width: 100px;">
		                            <label class="description">
		                                <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metaimage ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
		                            </label>
		                        </td>

		                    <?php
		                    } // end foreach
		                    ?>
		                </tr>
		            </tbody>
		        </table>
		    </div>
		</div>
	<?php
	}

	/**
	 * Save custom metabox data
	 *
	 * @action save_post
	 *
	 * @since Fabulous Fluid 0.2
	 *
	 * @access public
	 */
	public function save( $post_id ) {
		global $post_type;

		$post_type_object = get_post_type_object( $post_type );

	    if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                      // Check Autosave
	    || ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
	    || ( ! in_array( $post_type, $this->meta_box['post_type'] ) )                  // Check if current post type is supported.
	    || ( ! check_admin_referer( basename( __FILE__ ), 'fabulous_fluid_custom_meta_box_nonce') )    // Check nonce - Security
	    || ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) )  // Check permission
	    {
	      return $post_id;
	    }

	    foreach ( $this->fields as $field ) {
			$old = get_post_meta( $post_id, $field, true);

			$new = $_POST[ $field ];

			delete_post_meta( $post_id, $field );

			if ( '' == $new || array() == $new ) {
				return;
			}
			else {
				if ( ! update_post_meta ($post_id, $field, sanitize_key ( $new ) ) ) {
					add_post_meta($post_id, $field, sanitize_key ( $new ), true );
				}
			}
		} // end foreach
	}
}

$fabulous_fluid_metabox = new FabulousFluidMetaBox(
	'fabulous-fluid-options', 					//metabox id
	__( 'Fabulous Fluid Options', 'fabulous-fluid' ), //metabox title
	array( 'page', 'post' )				//metabox post types
);
