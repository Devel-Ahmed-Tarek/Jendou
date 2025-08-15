<?php
    // Theme Options and Settings
    $tlpage = Core\Models\TlPage::where('id', $page->id)->first();
    $rtl = getActiveFrontLangRTL();
    $active_theme = getActiveTheme();
    $page_options = themeOptionToCss('page', $active_theme->id);
    $page_title_tag = 'h1';
    $is_title = true;
    $is_breadcrumb = true;
    $overlay = '';
    $page_layout = 'no_sidebar';
    $page_sidebar = 'page_sidebar';
    if (isset($page_options['condition']['custom_page_c']) && $page_options['condition']['custom_page_c'] == '1') {
        $page_title_tag = isset($page_options['static']['page_title_tag_s']) ? $page_options['static']['page_title_tag_s'] : 'h1';
        $is_breadcrumb = isset($page_options['condition']['breadcrumb_hide_show_c']) && $page_options['condition']['breadcrumb_hide_show_c'] == '1' ? true : false;
        $is_title = isset($page_options['condition']['page_title_c']) && $page_options['condition']['page_title_c'] == '1' ? true : false;
        $overlay = isset($page_options['condition']['overlay_c']) && $page_options['condition']['overlay_c'] == '1' ? 'bg-overlay' : '';
        $page_layout = isset($page_options['condition']['page_layout_c']) && $page_options['condition']['page_layout_c'] != '' ? $page_options['condition']['page_layout_c'] : 'no_sidebar';
        $page_sidebar = isset($page_options['condition']['page_sidebar_setting_c']) && $page_options['condition']['page_sidebar_setting_c'] != '' ? $page_options['condition']['page_sidebar_setting_c'] : 'page_sidebar';
    }
?>


<?php $__env->startSection('seo'); ?>
    
    <title><?php echo e($tlpage->translation('title', getFrontLocale())); ?></title>
    <meta name="title" content="<?php echo e($tlpage->meta_title); ?>">
    <meta name="description" content="<?php echo e($tlpage->meta_description); ?>">
    <meta name="keywords" content="<?php echo e(getGeneralSetting('site_meta_keywords')); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e($tlpage->meta_title); ?>">
    <meta property="og:description" content="<?php echo e($tlpage->meta_description); ?>">
    <meta name="twitter:card" content="<?php echo e($tlpage->meta_title); ?>">
    <meta name="twitter:title" content="<?php echo e($tlpage->meta_title); ?>">
    <meta name="twitter:description" content="<?php echo e($tlpage->meta_description); ?>">
    <meta name="twitter:image" content="<?php echo e($tlpage->meta_image ? asset(getFilePath($tlpage->meta_image)) : ''); ?>">
    <meta property="og:image" content="<?php echo e($tlpage->meta_image ? asset(getFilePath($tlpage->meta_image)) : ''); ?>">
    <meta property="og:image:width" content="1200">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-css'); ?>
    <?php
        $builder_css_file = base_path("themes/{$active_theme->location}/public/builder-assets/css/{$page->permalink}.css");
        $builder_css_path = asset("themes/{$active_theme->location}/public/builder-assets/css/{$page->permalink}.css");
    ?>
    <?php if(isActivePluging('pagebuilder') && $page->page_type == 'builder' && file_exists($builder_css_file)): ?>
        <link rel="stylesheet" href="<?php echo e($builder_css_path.'?v='.time()); ?>">
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(!(isActivePluging('pagebuilder') && $page->page_type == 'builder')): ?>
        <!-- Page title -->
        <div class="page-title <?php echo e($overlay); ?>">
            <div class="container">
                <?php if($is_title): ?>
                    <!-- Title Tag -->
                    <?php $title = $tlpage->translation('title',getFrontLocale()); ?>
                    <?php echo makeTitleTag($page_title_tag, $title, 'title'); ?>

                    <!-- Title Tag -->
                <?php endif; ?>

                <?php if($is_breadcrumb): ?>
                    <ul class="nav">
                        <!--core frontend to backend-->
                        <li><a href="/"><?php echo e(front_translate('Home')); ?></a></li>
                        <?php
                            $parentUrl = getParentUrl($tlpage);
                            $parents = preg_split('#/#', $parentUrl, -1, PREG_SPLIT_NO_EMPTY);
                        ?>
                        <?php if(count($parents)): ?>
                            <?php for($i = 0; $i < count($parents); $i++): ?>
                                <?php
                                    $parent = Core\Models\TlPage::where('permalink', $parents[$i])->first();
                                ?>
                                <li>
                                    <a
                                        href="<?php echo e(route('theme.default.viewPage', ['permalink' => getParentUrl($parent) . $parent->permalink])); ?>"><?php echo e($parent->translation('title', getFrontLocale())); ?></a>
                                </li>
                            <?php endfor; ?>
                        <?php endif; ?>
                        <li class="active"><?php echo e($tlpage->translation('title', getFrontLocale())); ?></li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <!-- End of Page title -->
    <?php endif; ?>

        <?php if(isActivePluging('pagebuilder') && $page->page_type == 'builder'): ?>
            <?php if ($__env->exists('plugin/pagebuilder::builders.builder-section', ['page_sections' => $page_sections])) echo $__env->make('plugin/pagebuilder::builders.builder-section', ['page_sections' => $page_sections], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <div class="container pb-80 pt-40">
                <div class="row">
                    <div class="<?php echo e($page_layout == 'no_sidebar' ? 'col-lg-12' : 'col-lg-8'); ?> <?php echo e($page_layout == 'left_sidebar' ? 'order-2' : 'order-1'); ?>"
                        id="page_section">
                        <?php if($page->visibility == 'password'): ?>
                            
                            <section class="my-5" id="password_box">
                                <div class="nl-bg-ol"></div>
                                <div class="container">
                                    <div class="newsletter pt-40 pb-40">
                                        <div class="text-center mb-4">
                                            <h3>
                                                <?php echo e(front_translate('This Page is Password protected. Please Enter The Correct Password To See This Page.')); ?>

                                            </h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-10 offset-lg-1">
                                                <form action="javascript:void(0)" id="page_password_form">
                                                    <div class="input-group">
                                                        <input type="hidden" name="permalink"
                                                            value="<?php echo e($page->permalink); ?>">
                                                        <input type="password" class="form-control" id="page_password"
                                                            name="password"
                                                            placeholder="<?php echo e(front_translate('Enter Page Password')); ?>">
                                                    </div>
                                                </form>
                                                <span class="text-danger my-2" id="password_message"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            
                        <?php endif; ?>
                        <div id="page_details">
                            <div class="page-thumb">
                                <?php if(isset($page->page_image)): ?>
                                    <img src="<?php echo e(asset(getFilePath($page->page_image))); ?>" alt=""
                                        class="img-fluid">
                                <?php endif; ?>
                            </div>
                            <div class="page_content">
                                
                                <?php echo xss_clean(fix_image_urls($tlpage->translation('content', getFrontLocale()))); ?>

                                
                            </div>
                        </div>
                    </div>

                    <?php if($page_layout != 'no_sidebar'): ?>
                        <div class="col-lg-4 <?php echo e($page_layout == 'left_sidebar' ? 'order-1' : 'order-2'); ?>">
                            <?php if ($__env->exists('theme/default::frontend.includes.sidebar.sidebar', [
                                'type' => $page_sidebar,
                            ])) echo $__env->make('theme/default::frontend.includes.sidebar.sidebar', [
                                'type' => $page_sidebar,
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
    
    <script src="<?php echo e(asset('/public/backend/assets/plugins/js-cookie/js.cookie.min.js')); ?>"></script>
    <script>
        (function($) {
            'use strict';
            $(document).ready(function() {
                // if page is password protected then remove the contents
                if ('<?php echo e($page->visibility); ?>' == 'password') {
                    var page_details = $('#page_details').detach();
                }

                // checking if page cookie is available and getting it (For password protected page)
                if (Cookies.get('<?php echo e($page->permalink); ?>')) {
                    $('#password_box').remove();
                    $('#page_section').append(page_details);
                }

                // if the blog is password protected
                $('#page_password').on('keypress', function(e) {
                    if (e.which === 13) {
                        var formData = $('#page_password_form').serializeArray();
                        $.ajax({
                            type: "post",
                            url: '<?php echo e(route('theme.default.page.password.load')); ?>',
                            data: formData,
                            success: function(res) {
                                if (res.success) {
                                    $('#password_box').remove();
                                    $('#page_section').append(page_details);
                                    // Cookies expired on 1 day
                                    Cookies.set('<?php echo e($page->permalink); ?>', JSON.stringify({
                                        page: "<?php echo e($page->permalink); ?>"
                                    }), {
                                        expires: 1,
                                        path: '<?php echo e(env('APP_URL')); ?>'
                                    });
                                } else {
                                    toastr.error(res.error,
                                        "<?php echo e(front_translate('Error!')); ?>");
                                }
                            },
                            error: function(data, textStatus, jqXHR) {
                                toastr.error("Content Request Failed",
                                    "<?php echo e(front_translate('Error!')); ?>");
                            }
                        });
                    }
                });

                // Banner Slider Carousal Initialize
                let RTL = false;
                if ('<?php echo e($rtl); ?>') {
                    RTL = true;
                }

                // Slider Banner Carousel
                let sync1 = $(".banner-slider");
                sync1
                    .owlCarousel({
                        rtl: RTL,
                        items: 4,
                        slideSpeed: 2000,
                        autoplay: true,
                        loop: true,
                        responsiveRefreshRate: 200,
                        animateIn: false,
                        animateOut: false,
                        margin: 0,
                        responsive: {
                            0: {
                                items: 1
                            },
                            768: {
                                items: 2
                            },
                            1024: {
                                items: 3
                            },
                            1440: {
                                items: 4
                            }
                        }
                    });

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme/default::frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/default/resources/views/frontend/pages/page.blade.php ENDPATH**/ ?>