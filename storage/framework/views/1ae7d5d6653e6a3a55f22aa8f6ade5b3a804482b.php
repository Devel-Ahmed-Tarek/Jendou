<?php
    $site_seo_properties = cache()->rememberForever('site-seo-properties', function () {
        return \Core\Repositories\SettingsRepository::siteSeoProperties();
    });

    $tenant_id = getGeneralSetting('tenant_id');
?>

<?php $__env->startSection('seo'); ?>
    <title><?php echo e($site_seo_properties['site_title']); ?></title>
    <meta name="title" content="<?php echo e($site_seo_properties['site_meta_title']); ?>" />
    <meta name="description" content="<?php echo e($site_seo_properties['site_meta_description']); ?>" />
    <meta name="keywords" content="<?php echo e($site_seo_properties['site_meta_keywords']); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo e($site_seo_properties['site_meta_title']); ?>" />
    <meta property="og:description" content="<?php echo e($site_seo_properties['site_meta_description']); ?>" />
    <meta property="og:image" content="<?php echo e($site_seo_properties['site_meta_image']); ?>" />
    <meta name="twitter:card" content="<?php echo e($site_seo_properties['site_meta_description']); ?>" />
    <meta name="twitter:title" content="<?php echo e($site_seo_properties['site_meta_title']); ?>" />
    <meta name="twitter:description" content="<?php echo e($site_seo_properties['site_meta_description']); ?>" />
    <meta name="twitter:image" content="<?php echo e($site_seo_properties['site_meta_image']); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('builder-css-link'); ?>
    <?php if(isActivePluging('tlcommerce-pagebuilder') && isset($page) && $page->page_type == 'builder'): ?>
        <?php
            $active_theme = getActiveTheme();
            $builder_css_file = base_path("themes/{$active_theme->location}/public/builder-assets/{$tenant_id}/css/{$page->permalink}.css");
            $builder_css_path = asset("themes/{$active_theme->location}/public/builder-assets/{$tenant_id}/css/{$page->permalink}.css");
        ?>
        <?php if(file_exists($builder_css_file)): ?>
            <link rel="stylesheet" href="<?php echo e($builder_css_path . '?v=' . time()); ?>">
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme/tlcommerce::frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/frontend/pages/home.blade.php ENDPATH**/ ?>