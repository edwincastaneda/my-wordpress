<p>
    Seleccione el animal, la enfermedad y el producto asociado a ello y luego haga click en el boton Agregar.<br/>
    (Debe de haber ingresado previamente los animales, enfermedades y productos)
</p>
<?php 
if(isset($_GET['error'])){
$error=explode(",", $_GET['error']);
}
?>
<form method="post" action="<?php echo PLUGIN_PATH . "actions/add.php"; ?>" novalidate="novalidate">
    <table class="form-table">
        <tr>
            <td style="width:50%">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="id_animal">Animal:</label>
                            </th>
                            <td>
                                <select name="id_animal" id="id_animal" class="regular-text select-lssa">
                                    <option value="--" > - Seleccione - </option>
                                    <?php
                                    $args = array('post_type' => 'animal');
                                    $loop = new WP_Query($args);
                                    while ($loop->have_posts()) : $loop->the_post();
                                    $id=get_the_ID();
                                        ?>
                                        <option value="<?php the_ID(); ?>" <?php if($id==$error[0]){echo "selected";}?>><?php the_title(); ?></option>
                                        <?php
                                    endwhile;
                                    wp_reset_query();
                                    ?>
                                </select>
                                <?php 
                                if(isset($error[0]) && $error[0]==1){?>
                                <em class="error error-id_animal">¡Debe de seleccionar una opción!</em>
                                <?php }?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="id_enfermedad">Enfermedad:</label>
                            </th>
                            <td>
                                <select name="id_enfermedad" id="id_enfermedad" class="regular-text select-lssa">
                                    <option value="--" > - Seleccione - </option>
                                    <?php
                                    $args = array('post_type' => 'enfermedad');
                                    $loop = new WP_Query($args);
                                    while ($loop->have_posts()) : $loop->the_post();
                                    $id=get_the_ID();
                                        ?>
                                        <option value="<?php the_ID(); ?>" <?php if($id==$error[1]){echo "selected";}?>><?php the_title(); ?></option>
                                        <?php
                                    endwhile;
                                    wp_reset_query();
                                    ?>
                                </select>
                                <?php 
                                if(isset($error[1]) && $error[1]==1){?>
                                <em class="error error-id_enfermedad">¡Debe de seleccionar una opción!</em>
                                <?php }?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="id_producto">Producto:</label>
                            </th>
                            <td>
                                <select name="id_producto" id="id_producto" class="regular-text select-lssa">
                                    <option value="--" > - Seleccione - </option>
                                    <?php
                                    if (esc_attr(get_option('slug_productos')) != "") {
                                        $products_slug = esc_attr(get_option('slug_productos'));
                                    } else {
                                        $products_slug = 'product';
                                    }

                                    $args = array('post_type' => $products_slug);
                                    $loop = new WP_Query($args);
                                    $hidden = "";
                                    while ($loop->have_posts()) : $loop->the_post();
                                        
                                        $image_id = get_post_thumbnail_id();
                                        $imagesize = "thumbnail";
                                        $image_url = wp_get_attachment_image_src($image_id, $imagesize, true);
                                        $thumb = $image_url[0];
                                        $hidden.='<input type="hidden" value="' . $thumb . '" id="producto-' . get_the_ID() . '"/>';
                                        $id=get_the_ID();
                                        ?>
                                        <option value="<?php the_ID(); ?>" <?php if($id==$error[2]){echo "selected";}?>> <?php the_title(); ?></option>

                                        <?php
                                    endwhile;
                                    wp_reset_query();
                                    ?>    
                                </select>
                                <?php echo $hidden ?>
                                <?php 
                                if(isset($error[2]) && $error[2]==1){?>
                                <em class="error error-id_producto">¡Debe de seleccionar una opción!</em>
                                <?php }?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                 <?php 
                                if(isset($_GET['success']) && $_GET['success']==1){?>
                                <em class="success">Realizado!</em>
                                <?php }?>
            </td>
            <td style="width:50%; text-align: center;">
                <div class="content-preview"><img id="imagen-producto" style="width:100%; heigth:100%;" src=""/></div>
            </td>
        </tr>
    </table>

    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Agregar"></p>
</form>
<!-- data table -->
<table id="tabla" class="wp-list-table widefat fixed posts stripe">
    <thead>
        <tr>
            <!--<th width="45">#</th>-->
            <th class="manage-column" width="25%">Animal</th>
            <th class="manage-column" width="25%">Enfermedad</th>
            <th class="manage-column" width="50%">Productos</th>
        </tr>
    </thead>
    <tbody>
        <?php
        global $wpdb;

        $sql = "SELECT 
                    R.id, 
                    R.id_animal, 
                    PA.post_title AS titulo_animal, 
                    PA.post_content AS content_animal,
                    R.id_enfermedad, 
                    PE.post_title AS titulo_enfermedad, 
                    PE.post_content AS content_enfermedad
                    FROM " . $wpdb->prefix . "recetas R 
                    LEFT JOIN wp_posts PA ON PA.ID=R.id_animal 
                    LEFT JOIN wp_posts PE ON PE.ID=R.id_enfermedad
                    LEFT JOIN wp_posts PP ON PP.ID=R.id_producto
                    GROUP BY R.id_animal, R.id_enfermedad ORDER BY R.id";

        $recetas = $wpdb->get_results($sql, ARRAY_A);

        foreach ($recetas as $receta) {
            ?>
            <tr>
                <td>
                    <b><?php echo $receta['titulo_animal']; ?></b><br/>
                    <em><?php echo $receta['content_animal']; ?></em>
                </td>
                <td><b><?php echo $receta['titulo_enfermedad']; ?></b></br>
                    <em><?php echo $receta['content_enfermedad']; ?></em>
                </td>
                <td>
                    <table class="wp-list-table widefat fixed posts">
                        <?php
                        $product = $wpdb->get_results(
                                "SELECT * FROM " . $wpdb->prefix . "recetas WHERE id_animal=" . $receta['id_animal']
                                . " AND id_enfermedad=" . $receta['id_enfermedad'], ARRAY_A
                        );

                        foreach ($product as $products) {
                            $args = array('post_type' => $products_slug, 'p' => $products['id_producto']);
                            $loop = new WP_Query($args);
                            if ($loop->have_posts()) {
                                $loop->the_post();
                                ?>
                                <tr>
                                    <td class="tabla-thumbail">
                                        <b><?php
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('thumbnail', array('class' => 'thumbail-producto'));
                                            } else {
                                                echo '<img class="thumbail-producto" src="' . get_bloginfo('stylesheet_directory') . '/images/thumbnail-default.jpg" />';
                                            }
                                            ?></b> 
                                    </td>
                                    <td class="tabla-titulo">
                                        <b><?php the_title(); ?></b>
                                    </td>

                                    <td class="right">
                                        <form class="boton-eliminar" method="post" action="<?php echo PLUGIN_PATH . "actions/delete.php"; ?>" novalidate="novalidate">
                                            <input type="hidden" name="id" value="<?php echo $products['id']; ?>"/>
                                            <input type="submit" name="submit" id="submit" class="button button-primary" value="Eliminar">
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            wp_reset_query();
                        }
                        ?>
                    </table>
                </td>
            </tr>    
        <?php } ?>
    </tbody>
</table>

