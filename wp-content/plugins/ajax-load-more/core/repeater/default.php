<li<?php if (! has_post_thumbnail() ) { echo ' class="no-img"'; } ?>>
   <?php if ( has_post_thumbnail() ) { the_post_thumbnail(array(150,150));
   }?>
   <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
<?php
                sharing_display( '', true );
                if ( class_exists( 'Jetpack_Likes' ) ) {
                    $custom_likes = new Jetpack_Likes;
                    echo $custom_likes->post_likes( '' );
                }
                ?>
</li>