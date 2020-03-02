<?php
/**
 * Blog section
 *
 * This is the template for the content of blog section
 *
 * @package Theme Palace
 * @subpackage Music Freak
 * @since Music Freak 1.0.0
 */
if ( ! function_exists( 'music_freak_add_blog_section' ) ) :
    /**
    * Add blog section
    *
    *@since Music Freak 1.0.0
    */
    function music_freak_add_blog_section() {
    	$options = music_freak_get_theme_options();
        // Check if blog is enabled on frontpage
        $blog_enable = apply_filters( 'music_freak_section_status', true, 'blog_section_enable' );

        if ( true !== $blog_enable ) {
            return false;
        }
        // Get blog section details
        $section_details = array();
        $section_details = apply_filters( 'music_freak_filter_blog_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render blog section now.
        music_freak_render_blog_section( $section_details );
    }
endif;

if ( ! function_exists( 'music_freak_get_blog_section_details' ) ) :
    /**
    * blog section details.
    *
    * @since Music Freak 1.0.0
    * @param array $input blog section details.
    */
    function music_freak_get_blog_section_details( $input ) {
        $options = music_freak_get_theme_options();

        // Content type.
        $blog_content_type  = $options['blog_content_type'];
        
        $content = array();
        switch ( $blog_content_type ) {
        	
            case 'category':
                $cat_id = ! empty( $options['blog_content_category'] ) ? $options['blog_content_category'] : '';
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 7,
                    'cat'               => absint( $cat_id ),
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            case 'recent':
                $cat_ids = ! empty( $options['blog_category_exclude'] ) ? $options['blog_category_exclude'] : array();
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 7,
                    'category__not_in'  => ( array ) $cat_ids,
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            default:
            break;
        }


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = music_freak_trim_content( 15 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';
                $page_post['thumbnail'] = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'thumbnail' ) : '';

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// blog section content details.
add_filter( 'music_freak_filter_blog_section_details', 'music_freak_get_blog_section_details' );


if ( ! function_exists( 'music_freak_render_blog_section' ) ) :
  /**
   * Start blog section
   *
   * @return string blog content
   * @since Music Freak 1.0.0
   *
   */
   function music_freak_render_blog_section( $content_details = array() ) {
        $options = music_freak_get_theme_options();
        $i = 1;
        $count = count( $content_details );

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="latest-posts" class="relative page-section">
            <div class="wrapper">
                <?php if ( ! empty( $options['blog_title'] ) ) : ?>
                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $options['blog_title'] ); ?></h2>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <!-- supports col-1 and col-2 -->
                <div class="section-content <?php echo ( $count > 2 ) ? 'col-2' : 'col-1'; ?> clear">
                    <div class="archive-blog-wrapper clear">
                        <?php foreach ( $content_details as $content ) : 
                            if ( $i < 3 ) : ?>
                                <article class="<?php echo ! empty( $content['image'] ) ? 'has' : 'no'; ?>-post-thumbnail">
                                    <div class="post-wrapper">
                                        <?php if ( ! empty( $content['image'] ) ) : ?>
                                            <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                                            </div><!-- .featured-image -->
                                        <?php endif; ?>

                                        <div class="entry-container">
                                            <div class="entry-meta">
                                                <?php 
                                                    music_freak_posted_on( $content['id'] );
                                                    echo music_freak_author( $content['id'] );
                                                ?>
                                            </div><!-- .entry-meta -->

                                            <header class="entry-header">
                                                <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                            </header>

                                            <div class="entry-content">
                                                <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                            </div><!-- .entry-content -->

                                            <span class="cat-links">
                                                <?php the_category( '', '', $content['id'] ); ?>
                                            </span><!-- .cat-links -->
                                        </div><!-- .entry-container -->
                                    </div><!-- .post-wrapper -->
                                </article>
                            <?php endif; 

                            if ( $i == 2 ) : ?>
                                </div><!-- .archive-blog-wrapper -->
                            <?php endif; 

                            if ( $i == 2 && $count > 2 ) : ?>
                                <div class="blog-posts-wrapper">
                            <?php endif; 

                            if ( $i > 2 ) : ?>
                                <article class="<?php echo ! empty( $content['image'] ) ? 'has' : 'no'; ?>-post-thumbnail">
                                    <div class="post-wrapper">
                                        <?php if ( ! empty( $content['thumbnail'] ) ) : ?>
                                            <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['thumbnail'] ); ?>');">
                                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                                            </div><!-- .featured-image -->
                                        <?php endif; ?>

                                        <div class="entry-container">
                                            <header class="entry-header">
                                                <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                            </header>

                                            <div class="entry-meta">
                                                <?php 
                                                    music_freak_posted_on( $content['id'] );
                                                    echo music_freak_author( $content['id'] );
                                                ?>
                                            </div><!-- .entry-meta -->
                                        </div><!-- .entry-container -->
                                    </div><!-- .post-wrapper -->
                                </article>
                            <?php endif; 
                        $i++; endforeach;
                            
                    if ( $count > 2 ) : ?>
                        </div><!-- .blog-posts-wrapper -->
                    <?php endif; ?>
                </div><!-- .section-content -->

            </div><!-- .wrapper -->
        </div><!-- #latest-posts -->

    <?php }
endif;