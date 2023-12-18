<!-- génèrer une interface utilisateur avec des sélecteurs déroulants pour filtrer les photos par catégorie, format et tri par date. 
Ces filtres sont générés dynamiquement à partir des données de catégories et de termes de taxonomie récupérées depuis WordPress. -->

<div class="filters-container">
    <div class="filters hidden">
        <div class="filter">
            <select name="categories-photos" id="filter-category" class="filter-category">
                <option value="">Catégories</option> 
                <option value="reception">Réception</option>
                <option value="mariage">Mariage</option>
                <option value="television">Télévision</option>
                <option value="concert">Concert</option>  
                <?php
                $categories = get_categories(array(
                    'taxonomy' => 'categories-photos',
                    'hide_empty' => false,
                ));
                foreach ($categories as $category) {
                    echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="filter">
            <select name="formats" id="filter-format" class="filter-format">
                <option value="">Formats</option>
                <?php
                $formats = get_categories(array(
                    'taxonomy' => 'formats',
                    'hide_empty' => false,
                ));
                foreach ($formats as $format) {
                    echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="filter">
            <select name="tri" id="filter-tri" class="filter-tri">
                <option value="">Trier par</option>
                <?php
                $dates = get_posts(array(
                    'posts_per_page' => -1,
                    'post_type' => 'photos',
                    'fields' => 'ids',
                    'date_query' => array(
                        array(
                            'after' => '1 January 2000',
                        ),
                    ),
                ));

                $years = array_unique(array_map(function ($post_id) {
                    return get_the_date('Y', $post_id);
                }, $dates));

                rsort($years);

                foreach ($years as $year) {
                    echo '<option value="' . $year . '">' . $year . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
</div>
