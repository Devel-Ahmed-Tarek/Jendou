<?php
    // Theme Option and Settings
    $generalSettings = getGeneralSettingsDetails();
    $active_theme = getActiveTheme();
    $contact_option = getThemeOption('contact', $active_theme->id);
    $breadcrumb_title = front_translate('Contact');
    $title = front_translate('Get In Touch');
    $subtitle = front_translate('Whether you have a question, want to start a project or simply want to connect. Feel free to send me a message in the contact form');
    $name_placeholder = front_translate('Your Name');
    $email_placeholder = front_translate('Your Email');
    $subject_placeholder = front_translate('Subject');
    $message_placeholder = front_translate('Your Message');
    $btn_text = front_translate('Submit');
    $contact_image = true;
    $image_path = false;
    
    //contact page field
    if (!empty($contact_option) && $contact_option['custom_contact_style'] == 1) {
        $title = isset($contact_option['contact_title']) ? front_translate($contact_option['contact_title']) : '';
        $subtitle = isset($contact_option['contact_subtitle']) ? front_translate($contact_option['contact_subtitle']) : '';
        $name_placeholder = isset($contact_option['contact_name_placeholder']) ? front_translate($contact_option['contact_name_placeholder']) : '';
        $email_placeholder = isset($contact_option['contact_email_placeholder']) ? front_translate($contact_option['contact_email_placeholder']) : '';
        $subject_placeholder = isset($contact_option['contact_subject_placeholder']) ? front_translate($contact_option['contact_subject_placeholder']) : '';
        $message_placeholder = isset($contact_option['contact_message_placeholder']) ? front_translate($contact_option['contact_message_placeholder']) : '';
        $btn_text = isset($contact_option['contact_button_text']) ? front_translate($contact_option['contact_button_text']) : '';
        if (isset($contact_option['contact_image_show']) && $contact_option['contact_image_show'] == 1) {
            if (isset($contact_option['custom_contact_image']) && $contact_option['custom_contact_image'] != null) {
                $contact_image = true;
                $image_path = asset(getFilePath($contact_option['custom_contact_image']));
            }
        } else {
            $contact_image = false;
        }
    }
    
    // page options title css for breadcrumb
    $page_options = themeOptionToCss('page', $active_theme->id);
    $page_title_tag = 'h1';
    $is_title = true;
    $is_breadcrumb = true;
    $overlay = '';
    if (isset($page_options['condition']['custom_page_c']) && $page_options['condition']['custom_page_c'] == '1') {
        $page_title_tag = isset($page_options['static']['page_title_tag_s']) ? $page_options['static']['page_title_tag_s'] : 'h1';
        $is_breadcrumb = isset($page_options['condition']['breadcrumb_hide_show_c']) && $page_options['condition']['breadcrumb_hide_show_c'] == '1' ? true : false;
        $is_title = isset($page_options['condition']['page_title_c']) && $page_options['condition']['page_title_c'] == '1' ? true : false;
        $overlay = isset($page_options['condition']['overlay_c']) && $page_options['condition']['overlay_c'] == '1' ? 'bg-overlay' : '';
    }
    
?>


<?php $__env->startSection('seo'); ?>
    
    <title> <?php echo e($breadcrumb_title); ?></title>
    <meta name="title" content="<?php echo e(front_translate('Contact')); ?>">
    <meta name="description" content="<?php echo e($generalSettings['site_meta_description']); ?>">
    <meta name="keywords" content="<?php echo e($generalSettings['site_meta_keywords']); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e($breadcrumb_title); ?>">
    <meta property="og:description" content="<?php echo e($generalSettings['site_meta_description']); ?>">
    <meta name="twitter:card" content="<?php echo e($generalSettings['site_meta_description']); ?>">
    <meta name="twitter:title" content="<?php echo e($breadcrumb_title); ?>">
    <meta name="twitter:description" content="<?php echo e($generalSettings['site_meta_description']); ?>">
    <meta name="twitter:image" content="<?php echo e(asset(getFilePath($generalSettings['site_meta_image']))); ?>">
    <meta property="og:image" content="<?php echo e(asset(getFilePath($generalSettings['site_meta_image']))); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('themes/default/public/assets/css/blog.css')); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('/public/backend/assets/plugins/select2/select2.min.css')); ?>">
    <!--  End select2  -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title  <?php echo e($overlay); ?>">
        <div class="container">
            <?php if($is_title): ?>
                <?php echo makeTitleTag($page_title_tag, $breadcrumb_title, 'title'); ?>

            <?php endif; ?>
            <?php if($is_breadcrumb): ?>
                <ul class="nav">
                    <li><a href="<?php echo e(route('theme.default.home')); ?>"><?php echo e(front_translate('Home')); ?></a></li>
                    <li class="active"><?php echo e(front_translate('Contact')); ?></li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <!-- End of Page title -->

    <div class="container pt-120 pb-120">
        <?php if($contact_image && $image_path): ?>
            <!-- Contact Cover -->
            <div class="contact-cover text-center">
                <img src="<?php echo e($image_path); ?> " alt="contact image" class="img-fluid">
            </div>
            <!-- End of Contact Cover -->
        <?php endif; ?>

        <div class="biz-contact-form">
            <!-- Contact Form Title -->
            <div class="title text-center">
                <h2><?php echo e($title); ?></h2>
                <p><?php echo e($subtitle); ?></p>
            </div>
            <!-- End of Contact Form Title -->

            <div class="my-contact-form-cover">
                <form class="my-contact-form" action="<?php echo e(route('theme.default.send.message')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo e($name_placeholder); ?>"
                                required>
                            <?php if($errors->has('name')): ?>
                                <p class="text-danger"><?php echo e($errors->first('name')); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control"
                                placeholder="<?php echo e($email_placeholder); ?>" required>
                            <?php if($errors->has('email')): ?>
                                <p class="text-danger"><?php echo e($errors->first('email')); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="subject" class="form-control"
                                placeholder="<?php echo e($subject_placeholder); ?>" required>
                            <?php if($errors->has('subject')): ?>
                                <p class="text-danger"><?php echo e($errors->first('subject')); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-12">
                            <textarea name="message" class="form-control" placeholder="<?php echo e($message_placeholder); ?>" required></textarea>
                            <?php if($errors->has('message')): ?>
                                <p class="text-danger"><?php echo e($errors->first('message')); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary"><?php echo e($btn_text); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme/default::frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/default/resources/views/frontend/pages/contact.blade.php ENDPATH**/ ?>