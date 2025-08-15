<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Update Section')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_css'); ?>
    <style>
        .color-picker {
            width: 50px !important;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('/public/backend/assets/plugins/select2/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
    <div>
        <?php if($section_details != null): ?>
            <form action="<?php echo e(route('theme.tlcommerce.home.page.sections.update')); ?>" method="POST" class="row">
                <?php echo csrf_field(); ?>
                <div class="col-lg-8">
                    <div class="card mb-30">
                        <div class="card-header bg-white border-bottom2">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h4><?php echo e(getHomePageSectionProperties($section_details->id, 'title') != null ? getHomePageSectionProperties($section_details->id, 'title') : 'Section'); ?>

                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row mb-20 d-none">
                                <div class="col-sm-12">
                                    <select class="area-disabled layout theme-input-style" id="layout"readonly>
                                        <option value="ads" <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'ads'): echo 'selected'; endif; ?>>
                                            <?php echo e(translate('Ads')); ?>

                                        </option>
                                        <option value="blogs" <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'blogs'): echo 'selected'; endif; ?>>
                                            <?php echo e(translate('Blogs')); ?>

                                        </option>
                                        <?php if(isActivePluging('flashdeal')): ?>
                                            <option value="flashdeal" <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'flashdeal'): echo 'selected'; endif; ?>>
                                                <?php echo e(translate('Flash Deal')); ?>

                                            </option>
                                        <?php endif; ?>
                                        <option value="featured_product" <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'featured_product'): echo 'selected'; endif; ?>>
                                            <?php echo e(translate('Featured Product')); ?>

                                        </option>
                                        <option value="category_slider" <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'category_slider'): echo 'selected'; endif; ?>>
                                            <?php echo e(translate('Category Slider')); ?>

                                        </option>
                                        <option value="product_collection" <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'product_collection'): echo 'selected'; endif; ?>>
                                            <?php echo e(translate('Product Collection')); ?>

                                        </option>
                                        <option value="custom_product_section" <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'custom_product_section'): echo 'selected'; endif; ?>>
                                            <?php echo e(translate('Custom Product Section')); ?>

                                        </option>
                                    </select>
                                    <?php if($errors->has('layout')): ?>
                                        <div class="invalid-input"><?php echo e($errors->first('layout')); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-12 mt-10">
                                    <div
                                        class="section_layout <?php echo e(getHomePageSectionProperties($section_details->id, 'layout') == 'category_slider' ? 'category_slider' : 'd-none'); ?>">
                                        <img src="<?php echo e(asset('/public/themes/tlcommerce/assets/img/category_slide.png')); ?>">
                                    </div>
                                    <div
                                        class="section_layout <?php echo e(getHomePageSectionProperties($section_details->id, 'layout') == 'flashdeal' ? 'flashdeal' : 'd-none'); ?>">
                                        <img src="<?php echo e(asset('/public/themes/tlcommerce/assets/img/deals.png')); ?>">
                                    </div>
                                    <div
                                        class="section_layout <?php echo e(getHomePageSectionProperties($section_details->id, 'layout') == 'product_collection' ? 'product_collection' : 'd-none'); ?>">
                                        <img src="<?php echo e(asset('/public/themes/tlcommerce/assets/img/collections.png')); ?>">
                                    </div>
                                    <div
                                        class="section_layout <?php echo e(getHomePageSectionProperties($section_details->id, 'layout') == 'custom_product_section' ? 'custom_product_section' : 'd-none'); ?>">
                                        <img src="<?php echo e(asset('/public/themes/tlcommerce/assets/img/collections.png')); ?>">
                                    </div>
                                    <div
                                        class="section_layout <?php echo e(getHomePageSectionProperties($section_details->id, 'layout') == 'featured_product' ? 'featured_product' : 'd-none'); ?> ">
                                        <img
                                            src="<?php echo e(asset('/public/themes/tlcommerce/assets/img/featured_product.png')); ?>">
                                    </div>
                                    <div
                                        class="section_layout <?php echo e(getHomePageSectionProperties($section_details->id, 'layout') == 'blogs' ? 'blogs' : 'd-none'); ?> ">
                                        <img src="<?php echo e(asset('/public/themes/tlcommerce/assets/img/blog.png')); ?>">
                                    </div>
                                    <div
                                        class="section_layout <?php echo e(getHomePageSectionProperties($section_details->id, 'layout') == 'ads' ? 'ads' : 'd-none'); ?> ">
                                        <div class="selected_ads_layout row m-0">
                                            <?php echo $__env->make(
                                                'theme/tlcommerce::backend.homepage.sections.ads.ads_layout_options_edit',
                                                [
                                                    'layout' => getHomePageSectionProperties(
                                                        $section_details->id,
                                                        'content'),
                                                    'details' => $section_details,
                                                ]
                                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                    <?php if(isActivePluging('multivendor')): ?>
                                        <div
                                            class="section_layout <?php echo e(getHomePageSectionProperties($section_details->id, 'layout') == 'seller_list' ? 'seller_list' : 'd-none'); ?> ">
                                            <h4 class="mt-3"><?php echo e(translate('With Banner')); ?></h4>
                                            <hr>
                                            <img
                                                src="<?php echo e(asset('/public/themes/tlcommerce/assets/img/seller_with_banner.png')); ?>">
                                            <h4 class="mt-3"><?php echo e(translate('Without Banner')); ?></h4>
                                            <hr>
                                            <img
                                                src="<?php echo e(asset('/public/themes/tlcommerce/assets/img/seller_without_banner.png')); ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="card mb-30">
                        <div class="card-header bg-white border-bottom2">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h4><?php echo e(translate('Section Properties')); ?></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="layout-options">
                                <!--Section Properties-->
                                <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'product_collection'): ?>
                                    <?php echo $__env->make(
                                        'theme/tlcommerce::backend.homepage.sections.product_collection.collection_options_edit',
                                        [
                                            'details' => $section_details,
                                        ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                                <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'category_slider'): ?>
                                    <?php echo $__env->make(
                                        'theme/tlcommerce::backend.homepage.sections.category_slider.category_slider_option_edit',
                                        [
                                            'details' => $section_details,
                                        ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                                <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'flashdeal'): ?>
                                    <?php echo $__env->make(
                                        'theme/tlcommerce::backend.homepage.sections.flash_deal.deal_option_edit',
                                        [
                                            'details' => $section_details,
                                        ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                                <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'featured_product'): ?>
                                    <?php echo $__env->make(
                                        'theme/tlcommerce::backend.homepage.sections.featured_product.featured_product_options_edit',
                                        [
                                            'details' => $section_details,
                                        ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                                <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'custom_product_section'): ?>
                                    <?php echo $__env->make(
                                        'theme/tlcommerce::backend.homepage.sections.custom_collection.custom_product_section_edit_option',
                                        [
                                            'details' => $section_details,
                                        ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                                <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'blogs'): ?>
                                    <?php echo $__env->make(
                                        'theme/tlcommerce::backend.homepage.sections.blogs.blogs_options_edit',
                                        [
                                            'details' => $section_details,
                                        ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                                <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'ads'): ?>
                                    <?php echo $__env->make(
                                        'theme/tlcommerce::backend.homepage.sections.ads.ads_option_edit',
                                        [
                                            'details' => $section_details,
                                        ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                                <?php if(getHomePageSectionProperties($section_details->id, 'layout') == 'seller_list'): ?>
                                    <?php echo $__env->make(
                                        'theme/tlcommerce::backend.homepage.sections.seller_list.seller_section_options_edit',
                                        [
                                            'details' => $section_details,
                                        ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                                <!--End Section Properties-->
                            </div>
                            <input type="hidden" name="layout" class="layout-input"
                                value="<?php echo e(getHomePageSectionProperties($section_details->id, 'layout')); ?>">
                            <input type="hidden" name="id" class="layout-input" value="<?php echo e($section_details->id); ?>">
                            <div class="form-row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn long"><?php echo e(translate('Save Changes')); ?></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <p class="alert alert-danger text-center"><?php echo e(translate('Section not found')); ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php echo $__env->make('core::base.media.partial.media_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <script src="<?php echo e(asset('/public/backend/assets/plugins/select2/select2.min.js')); ?>"></script>
    <script>
        (function($) {
            "use strict";
            initDropzone();
            //Select ads layout
            $('.select-ads-layout').on('change', function(e) {
                let selected_ads_layout = $("select#adsLayout option").filter(":selected").val();;
                let data = {
                    'layout': selected_ads_layout,
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: data,
                    url: '<?php echo e(route('theme.tlcommerce.home.page.sections.ads.layout.options')); ?>',
                    success: function(data) {
                        $('.selected_ads_layout').html(data);
                    }
                });
            });
        })(jQuery);

        function selectColor(e, color) {
            let target = e.target;
            $(target).closest('.addon').find('.color-input').val(color);
        }
    </script>
    <?php if(isActivePluging('multivendor')): ?>
        <?php echo $__env->make('theme/tlcommerce::backend.homepage.sections.seller_list.selller_dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::base.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/backend/homepage/edit_home_page_section.blade.php ENDPATH**/ ?>