<?php
add_filter('the_content', 'agrega_recetario_a_pagina');

function agrega_recetario_a_pagina($content) {

    wp_enqueue_style('front-lasemillasa', PLUGIN_PATH.'css/front-lasemillasa.css');

    if (is_page(esc_attr(get_option('id_pagina')))) {
        echo $content;
        $pagina = esc_url(get_permalink(get_option('id_pagina_resultado')));
        ?>
        <script>
            function formSubmit()
            {
                document.getElementById("form-mostrar-productos").submit();
            }
        </script>
        <form method="post" action="<?php echo $pagina; ?>" id="form-mostrar-productos">
            <ul class="lista-pasos">
                <li class="item-paso">  <div class="paso">1</div> SELECCIONE ANIMAL</li>
                <li class="item-select">
                    <select name="id_animal" id="id_animal">
                        <?php
                        $args = array('post_type' => 'animal');
                        $loop = new WP_Query($args);
                        while ($loop->have_posts()) : $loop->the_post();
                            ?>
                            <option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
                            <?php
                        endwhile;
                        ?>
                    </select>

                </li>
            </ul>


            <ul class="lista-pasos">
                <li class="item-paso">  <div class="paso">2</div> SELECCIONE ENFERMEDAD</li>
                <li class="item-select">
                    <select name="id_enfermedad" id="id_enfermedad">
                        <?php
                        $args = array('post_type' => 'enfermedad');
                        $loop = new WP_Query($args);
                        while ($loop->have_posts()) : $loop->the_post();
                            ?>
                            <option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
                            <?php
                        endwhile;
                        ?>
                    </select>
                </li>
            </ul>
            <button type="button" class="busca-productos" onclick="formSubmit();">Buscar</button>
        </form>
        <?php
    }
}

//add_filter('the_content', 'agrega_recetario_a_pagina_resultado');

function agrega_recetario_a_pagina_resultado($content, $url_plugin) {
    wp_enqueue_style('front-lasemillasa', $url_plugin . 'css/front-lasemillasa.css');

    if (esc_attr(get_option('slug_productos')) != "") {
        $products_slug = esc_attr(get_option('slug_productos'));
    } else {
        $products_slug = 'product';
    }

    if (is_page(esc_attr(get_option('id_pagina_resultado')))) {
        echo $content;
        $pagina = esc_url(get_permalink(get_option('id_pagina_resultado')));


        if (isset($_POST['id_animal']) && isset($_POST['id_enfermedad'])) {
            ?>
            <div class="content-detalle-receta">
                <?php
                wp_reset_query();
                global $wpdb;
                $sql = "SELECT * FROM " . $wpdb->prefix . "recetas WHERE id_animal=" . $_POST['id_animal']
                        . " AND id_enfermedad=" . $_POST['id_enfermedad'];

                $product = $wpdb->get_results(
                        $sql, ARRAY_A
                );

                foreach ($product as $products) {
                    //$args = array('post_type' => $products_slug, 'p' => $products['id_producto']);
                    //get_post_meta($products['id_producto'], '_regular_price', true);
                    $loop = new WP_Query($args);
                    if ($loop->have_posts()) {
//                    while($loop->have_posts()){
//                        $loop->the_post();
//                        the_title();
//                        
//                    }
//                    
                    }
                    wp_reset_query();
                }
                ?>
            </div>
            <button type="button" class="busca-productos" onclick="window.history.back();">Regresar</button>
            <?php
        }
    }
}
