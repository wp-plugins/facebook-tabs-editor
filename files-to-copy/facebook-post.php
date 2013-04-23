pluginstyle
<ul class="blognews">
            <?php
            require( '../../../wp-load.php' );
            query_posts('showposts=3');
            if (have_posts()) : while (have_posts()) : the_post();
                    ?>
                    <li>
                        <h2><a target="_parent" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <span>Posted on <?php the_time('l jS F, Y') ?></span><br />
                        <?php the_excerpt(); ?>
                    </li>
                    <?php
                endwhile;
            else: echo "no posts";
            endif;
            ?>
            <?php wp_reset_query(); ?>
        </ul>
