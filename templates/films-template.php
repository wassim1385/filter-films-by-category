<?php
/* Template Name: Movies Template */

get_header();

echo "<h2>" . get_the_title() . "</h2>";

$films = new WP_Query(
    array(
        'post_type' => 'films',
        'posts_per_page' => -1,
        'status' => 'publish'
    ));
?>
    <div class="wj-filter">
        <?php
        $terms = get_terms( array( 'taxonomy' => 'film_cat' ) );
        if( $terms ) : ?>
            <select id="cat" name="cat">
            <option value="">Select Category</option>
            <?php foreach( $terms as $term ) : ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>
    <?php if( $films->have_posts() ) : ?>
        <div class="wj-films">
            <?php while( $films->have_posts() ) : $films->the_post(); ?>
            <article class="film">
                <?php if( has_post_thumbnail() ) { ?>
                    <picture><a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="img-fluid"></a></picture>
                <?php } ?>
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <?php $cats = get_the_terms( get_the_ID(), 'film_cat' ); 
                    if( ! empty( $cats ) ) {
                        foreach( $cats as $cat ) { ?>
                            <span><b>Category:</b> <a href="<?php echo get_term_link( $cat, 'film_cat' ); ?>"><?php echo $cat->name; ?></a></span>
                        <?php }
                    }
                ?>
                </article>
            <?php
            endwhile; wp_reset_postdata(); ?>
        </div>
    <?php endif;
        

get_footer(); ?>