<?php
    $all_product_categories = getAllProductCategories();
    $all_recent_product_categories = getAllRecentProductCategories(); 
?>
<!-- Product Category Menu Item-->
<div data-accordion-tab="toggle">
    <div class="accordion-title d-flex gap-10 align-items-center justify-content-between">
        <h5><?php echo e(translate('Product Categories')); ?></h5>
        <i class="icofont-caret-down"></i>
    </div>
    <div class="accordion-content">
        <ul class="nav nav-tabs small-tabs pl-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#product_categories_recent"
                    role="tab"><?php echo e(translate('Most Recent')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#product_categories_all"
                    role="tab"><?php echo e(translate('View All')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#product_categories_searched"
                    role="tab"><?php echo e(translate('Search')); ?></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="product_categories_recent" role="tabpanel">
                <ul class="item-check-list pages-check-list">
                    <?php for($i = 0; $i < sizeof($all_recent_product_categories); $i++): ?>
                        <li>
                            <label class="menu-item-title">
                                <input type="checkbox" class="menu-item-checkbox"
                                    id="recent_product_cat_<?php echo e($all_recent_product_categories[$i]->id); ?>">
                                <?php echo e($all_recent_product_categories[$i]->name); ?>

                            </label>
                        </li>
                    <?php endfor; ?>
                </ul>
                <p class="button-controls d-flex justify-content-between gap-10 align-items-center pt-3 border-top2">
                    <span class="list-controls">
                        <input type="checkbox" id="select_recent_product_cat" class="select-all"
                            onclick="selectItemToMenu('#select_recent_product_cat','#product_categories_recent')">
                        <label for="page-tab8" class="cursor-pointer"><?php echo e(translate('Select All')); ?></label>
                    </span>

                    <span class="add-to-menu">
                        <input type="button" class="submit-add-to-menu" value="Add to Menu"
                            onclick="addItemToMenu('#recent_product_cat_' , <?php echo e(json_encode($all_recent_product_categories)); ?> ,'product_category')">
                    </span>
                </p>
            </div>
            <div class="tab-pane fade" id="product_categories_all" role="tabpanel">
                <ul class="item-check-list pages-check-list">
                    <?php for($i = 0; $i < sizeof($all_product_categories); $i++): ?>
                        <li>
                            <label class="menu-item-title">
                                <input type="checkbox" class="menu-item-checkbox"
                                    id="all_product_cat_<?php echo e($all_product_categories[$i]->id); ?>">
                                <?php echo e($all_product_categories[$i]->name); ?>

                            </label>
                        </li>
                    <?php endfor; ?>
                </ul>
                <p class="button-controls d-flex justify-content-between gap-10 align-items-center pt-3 border-top2">
                    <span class="list-controls">
                        <input type="checkbox" id="select_all_product_cat" class="select-all"
                            onclick="selectItemToMenu('#select_all_product_cat', '#product_categories_all')">
                        <label for="page-tab8" class="cursor-pointer"><?php echo e(translate('Select All ')); ?></label>
                    </span>

                    <span class="add-to-menu">
                        <input type="button" class="submit-add-to-menu" value="Add to Menu"
                            onclick="addItemToMenu('#all_product_cat_' , <?php echo e(json_encode($all_product_categories)); ?> ,'product_category')">
                    </span>
                </p>
            </div>
            <div class="tab-pane fade" id="product_categories_searched" role="tabpanel">
                <div class="pt-3">
                    <input type="search" class="theme-input-style" placeholder="Search" id="search_product_category"
                        onkeyup="searchItem('#search_product_category', '#searched_product_category_list' , '<?php echo e(route('core.search.product.category.by.keywords')); ?>')">
                </div>
                <div id="searched_product_category_list">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Product Category Menu Item-->
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/menu/include/product_category_menu_item.blade.php ENDPATH**/ ?>