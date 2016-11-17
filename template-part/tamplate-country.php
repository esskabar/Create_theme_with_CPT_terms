<div class="row">
    <?php if ($country->parent == 0): ?>
        <div class="col-lg-3">
            <h1 class="country-title text-right"><?php echo $country->name; ?></h1>
        </div>
        <div class="col-lg-9">
            <?php
            $terms = get_term_children($country->term_id, 'location');
            if (!empty($terms)):
                foreach ($terms as $city):
                    $city = get_term($city, 'location');
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="city-title text-left"><?php echo $city->name?></h3>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                        $args = array(
                            'post_type' => 'branchs',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'location',
                                    'field' => 'term_id',
                                    'terms' => $city->term_id
                                )
                            )
                        );
                        $posts = get_posts($args);
                        foreach ($posts as $post) :
                            setup_postdata($post); ?>
                            <div class="col-md-4">
                                <p class="title"><?php echo get_the_title($post->ID); ?></p>

                                <p class="adress">Adress: <?php the_field('adress',$post->ID)?></p>

                                <p class="phone">Phone: +<?php the_field('phone',$post->ID)?></p>

                                <p class="website">Website: <?php the_field('website',$post->ID)?></p>

                                <p class="email">Email: <?php the_field('email',$post->ID)?></p>
                            </div>
                        <?php endforeach;?>
                    </div>
                <?php endforeach;?>
            <?php else :?>
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="city-title text-left">&nbsp;</h3>
                    </div>
                </div>

                <div class="row">
                    <?php
                    $args = array(
                        'post_type' => 'branchs',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'location',
                                'field' => 'term_id',
                                'terms' => $country->term_id,
                            )
                        )
                    );
                    $posts = get_posts($args);
                    foreach ($posts as $post) :
                        setup_postdata($post); ?>
                        <div class="col-md-4">
                            <p class="title"><?php echo get_the_title($post->ID); ?></p>

                            <p class="adress">Adress: <?php the_field('adress',$post->ID); ?></p>

                            <p class="phone">Phone: +<?php the_field('phone',$post->ID); ?></p>

                            <p class="website">Website: <?php the_field('website',$post->ID); ?></p>

                            <p class="email">Email: <?php the_field('email',$post->ID); ?></p>
                        </div>
                    <?php endforeach;?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif;?>
</div>