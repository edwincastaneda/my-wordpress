
<ul>
    <li>
        1. Ingrese el slug de productos definido para el plugin Woocommerce.<br/>
        <em>(De no ingresarse se utilizará la opción predeterminada <span style="text-decoration: underline;">'product'</span> )</em>
    </li>
    <li>
        2. Seleccione la página donde desea mostrar la busqueda de recetas.
    </li>
    <li>
        3. Seleccione la página donde desea mostrar los resultados de las recetarios.
    </li>
</ul>

<form method="post" action="options.php">
    <?php settings_fields('la_semilla_grupo_opciones'); ?>
    <?php do_settings_sections('la_semilla_grupo_opciones'); ?>
   
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row">
                    <label for="slug_productos">Slug de productos de Woocommerce:</label>
                </th>
                <td>
                    <input name="slug_productos" id="slug_productos" class="mini-text"
                           value="<?php echo esc_attr(get_option('slug_productos')); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="id_pagina">Página para desplegar el formulario de busqueda: </label>
                </th>
                <td>
                    <select name="id_pagina" id="id_pagina" class="regular-text select-lssa"> 
                        <option value="">Seleccione</option> 
                        <?php
                        $seleccionada = esc_attr(get_option('id_pagina'));
                        $pages = get_pages();
                        foreach ($pages as $page) {
                            if ($page->ID == $seleccionada) {
                                $option = '<option value="' . $page->ID . '" selected>';
                            } else {
                                $option = '<option value="' . $page->ID . '">';
                            }
                            $option .= $page->post_title;
                            $option .= '</option>';
                            echo $option;
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="id_pagina_resultado">Página para desplegar el resultado de las busquedas: </label>
                </th>
                <td>
                    <select name="id_pagina_resultado" id="id_pagina_resultado" class="regular-text select-lssa"> 
                        <option value="">Seleccione</option> 
                        <?php
                        $seleccionada = esc_attr(get_option('id_pagina_resultado'));
                        $pages = get_pages();
                        foreach ($pages as $page) {
                            if ($page->ID == $seleccionada) {
                                $option = '<option value="' . $page->ID . '" selected>';
                            } else {
                                $option = '<option value="' . $page->ID . '">';
                            }
                            $option .= $page->post_title;
                            $option .= '</option>';
                            echo $option;
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <?php submit_button(); ?>
   
</form>