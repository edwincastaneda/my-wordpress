<?php

function agrega_recetario($content) {

    wp_enqueue_style('front-lasemillasa', PLUGIN_PATH . 'css/front-lasemillasa.css');
    echo $content;
    
    
    if (is_page(esc_attr(get_option('id_pagina')))) {
        
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
    
     if (is_page(esc_attr(get_option('id_pagina_resultado')))) {

        if (esc_attr(get_option('slug_productos')) != "") {
            $products_slug = esc_attr(get_option('slug_productos'));
        } else {
            $products_slug = 'product';
        }

        if (isset($_POST['id_animal']) && isset($_POST['id_enfermedad'])) {
            ?>
            <div class="content-detalle-receta">
                <table border="1">
                    <tbody>
                        <tr>
                    <b>Animal:</b> <?php echo get_the_title($_POST['id_animal']); ?><br/>
                    <b>Enfermedad:</b> <?php echo get_the_title($_POST['id_enfermedad']); ?>
                    </tr>
            <?php
            global $wpdb;
            $sql = "SELECT * FROM " . $wpdb->prefix . "recetas WHERE id_animal=" . $_POST['id_animal']
                    . " AND id_enfermedad=" . $_POST['id_enfermedad'];

            $product = $wpdb->get_results(
                    $sql, ARRAY_A
            );

            if (count($product) > 0) {
                foreach ($product as $products) {
                    $args = array('post_type' => $products_slug, 'p' => $products['id_producto']);
                    $loop = new WP_Query($args);
                    if ($loop->have_posts()) {
                        $loop->the_post();
                        ?>
                                <tr>
                                    <td class="center"><?php echo get_the_title(); ?></td>
                                </tr>
                                <tr>
                                    <td class="producto-descripcion"><?php echo get_post_field('post_content', $products['id_producto']); ?></td>
                                </tr>
                                <tr>
                                    <td class="center"><?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('large', array('class' => 'img-descripcion-producto'));
                        } else {
                            echo '<img class="img-descripcion-producto" src="' . get_bloginfo('stylesheet_directory') . '/images/thumbnail-default.jpg" />';
                        }
                        ?>
                                    </td>
                                </tr>

                        <?php
                    }
                }
            } else {
                ?>
                        <tr> 
                            <td class="center">SIN RESULTADOS</td>
                        </tr>
                <?php
            }


            wp_reset_query();
        }
        ?>
                </tbody>
            </table>

        </div>
        <button type="button" class="busca-productos" onclick="window.history.back();">Regresar</button>
        <?php
    }

}

add_filter('the_content', 'agrega_recetario');
