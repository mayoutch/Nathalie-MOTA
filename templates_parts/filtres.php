<!-- génèrer une interface utilisateur avec des sélecteurs déroulants pour filtrer les photos par catégorie, format et tri par date. 
Ces filtres sont générés dynamiquement à partir des données de catégories et de termes de taxonomie récupérées depuis WordPress. -->
<script>
      function autoSubmit() {
        document.querySelector('form').submit();
      }
</script>
<?php
if (isset($_GET["categories-photos"])) {
$cat  = $_GET["categories-photos"];
    } else { 
 $cat = "";
}

if (isset($_GET["formaty"])) {
    $formatg  = $_GET["formaty"];
        } else { 
            $formatg = "";
    }

if (isset($_GET["tri"])) {
    $tri  = $_GET["tri"];
        } else { 
            $tri = "";
    }
?>
<form action="#" method="GET">
<div class="filters-container">
    <div class="filters hidden">
        <div class="filter">
            <select name="categories-photos" onchange="autoSubmit()" id="filter-category" class="filter-category">
                <option value="">Catégories</option>
                <?php
                $categories = get_terms('categories_photos', array(
                    'hide_empty' => false,
                ));
                foreach ($categories as $category) { ?>
                    <option value="<?php echo $category->slug ?>" <?php if ($category->slug == $cat) { echo "selected"; } ?>><?php echo $category->name ?></option>';
                
                <?php 
                }
                ?>
            </select>
        </div>

        <div class="filter">
            <select name="formaty" onchange="autoSubmit()" id="filter-format" class="filter-format">
                <option value="">Formats</option>
                <?php
                $formatsarray = get_terms('formats',array(
                    'hide_empty' => false,
                ));
                foreach ($formatsarray as $formatarray) { ?>
                    <option value="<?php echo $formatarray->slug ?>" <?php if ($formatarray->slug == $formatg) { echo "selected"; } ?>><?php echo $formatarray->name ?></option>
               <?php
                }
                ?>
            </select>
        </div>

        <div class="filter">
            <select name="tri" onchange="autoSubmit()" id="filter-tri" class="filter-tri">
                <option value="">Trier par</option>
                <option value="ASC" <?php if ($tri == "ASC") { echo "selected"; } ?>>Croissant</option>
                <option value="DESC" <?php if ($tri == "DESC") { echo "selected"; } ?>>Décroissant</option>
            </select>
        </div>
    </div>
</div>
</form>