<?php
    use Plugin\TlcommerceCore\Repositories\SettingsRepository;
    $active_tab = request()->has('tab') && request()->get('tab') != null ? request()->get('tab') : 'general';
?>


<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Ecommerce Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_css'); ?>
    <style>
        @media only screen and (max-width: 767px) {
            .theme-option-tab-wrap {
                grid-template-columns: 51px 1fr !important;
            }
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
    <div class="theme-option-container">
        <form id="ecommerce-settings-form">
            <div class="theme-option-sticky d-flex align-items-center justify-content-between bg-white border-bottom2 p-3">
                <div class="theme-option-logo d-none d-sm-block">
                    <h4><?php echo e(translate('Ecommerce Settings')); ?></h4>
                </div>
            </div>
            <div class="theme-option-tab-wrap">
                <div class="nav flex-column border-right2 py-3" aria-orientation="vertical">
                    <a class="nav-link <?php echo e($active_tab == 'general' ? 'active' : ''); ?>"
                        href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'general'])); ?>">
                        <i class="icofont-ui-settings" title="<?php echo e(translate('General')); ?>"></i>
                        <span><?php echo e(translate('General')); ?></span>
                    </a>

                    <a class="nav-link <?php echo e($active_tab == 'products' ? 'active' : ''); ?>"
                        href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'products'])); ?>">
                        <i class="icofont-bucket1" title="<?php echo e(translate('Products')); ?>"></i>
                        <span><?php echo e(translate('Products')); ?></span>
                    </a>

                    <a class="nav-link <?php echo e($active_tab == 'checkout' ? 'active' : ''); ?>"
                        href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'checkout'])); ?>">
                        <i class="icofont-cart" title="<?php echo e(translate('Checkout')); ?>"></i>
                        <span><?php echo e(translate('Checkout')); ?></span>
                    </a>

                    <a class="nav-link <?php echo e($active_tab == 'customers' ? 'active' : ''); ?>"
                        href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'customers'])); ?>">
                        <i class="icofont-people" title="<?php echo e(translate('Customers')); ?>"></i>
                        <span><?php echo e(translate('Customers')); ?></span>
                    </a>

                    <a class="nav-link <?php echo e($active_tab == 'orders' ? 'active' : ''); ?>"
                        href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'orders'])); ?>">
                        <i class="icofont-handshake-deal" title="<?php echo e(translate('Orders')); ?>"></i>
                        <span><?php echo e(translate('Orders')); ?></span>
                    </a>

                    <a class="nav-link <?php echo e($active_tab == 'payments' ? 'active' : ''); ?>"
                        href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'payments'])); ?>">
                        <i class="icofont-pay" title="<?php echo e(translate('Payments')); ?>"></i>
                        <span><?php echo e(translate('Payments')); ?></span>
                    </a>

                    <?php if(isActivePluging('wallet')): ?>
                        <a class="nav-link <?php echo e($active_tab == 'wallet' ? 'active' : ''); ?>"
                            href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'wallet'])); ?>">
                            <i class="icofont-wallet" title="<?php echo e(translate('Wallet')); ?>"></i>
                            <span><?php echo e(translate('Wallet')); ?></span>
                        </a>
                    <?php endif; ?>

                    <a class="nav-link <?php echo e($active_tab == 'invoice' ? 'active' : ''); ?>"
                        href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'invoice'])); ?>">
                        <i class="icofont-copy-invert" title="<?php echo e(translate('Invoice')); ?>"></i>
                        <span><?php echo e(translate('Invoice')); ?></span>
                    </a>

                    <a class="nav-link <?php echo e($active_tab == 'email-notification' ? 'active' : ''); ?>"
                        href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'email-notification'])); ?>">
                        <i class="icofont-ui-email" title="<?php echo e(translate('Email Notification')); ?>"></i>
                        <span><?php echo e(translate('Email Notification')); ?></span>
                    </a>

                    <a class="nav-link <?php echo e($active_tab == 'tax' ? 'active' : ''); ?>"
                        href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'tax'])); ?>">
                        <i class="icofont-money-bag" title="<?php echo e(translate('Tax')); ?>"></i>
                        <span><?php echo e(translate('Tax')); ?></span>
                    </a>

                    <?php if(isActivePluging('multivendor')): ?>
                        <a class="nav-link <?php echo e($active_tab == 'shop' ? 'active' : ''); ?>"
                            href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration', ['tab' => 'shop'])); ?>">
                            <i class="icofont-prestashop" title="<?php echo e(translate('Shop Settings')); ?>"></i>
                            <span><?php echo e(translate('Shop Settings')); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="tab-content">
                    <!--General Settings-->
                    <div class="tab-pane fade <?php echo e($active_tab == 'general' ? 'show active' : ''); ?>" id="general">
                        <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.general')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!--End General Settings-->
                    <!--Product Settings-->
                    <div class="tab-pane fade <?php echo e($active_tab == 'products' ? 'show active' : ''); ?>" id="products">
                        <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.products')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!--End Product Settings-->
                    <!--Checkout Settings-->
                    <div class="tab-pane fade <?php echo e($active_tab == 'checkout' ? 'show active' : ''); ?>" id="checkout">
                        <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.checkout')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.checkout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!--End Checkout Settings-->
                    <!--Customer Settings-->
                    <div class="tab-pane fade <?php echo e($active_tab == 'customers' ? 'show active' : ''); ?>" id="customers">
                        <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.customer')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.customer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!--End Customer Settings-->
                    <!--Order Settings-->
                    <div class="tab-pane fade <?php echo e($active_tab == 'orders' ? 'show active' : ''); ?>" id="orders">
                        <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.orders')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.orders', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!--End Order Settings-->
                    <!--Payment Settings-->
                    <div class="tab-pane fade <?php echo e($active_tab == 'payments' ? 'show active' : ''); ?>" id="payments">
                        <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.payment')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!--End Payment Settings-->
                    <!--Wallet Settings-->
                    <div class="tab-pane fade <?php echo e($active_tab == 'wallet' ? 'show active' : ''); ?>" id="wallet">
                        <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.wallet')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.wallet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!--End Wallet Settings-->
                    <!--Invoice Settings-->
                    <div class="tab-pane fade <?php echo e($active_tab == 'invoice' ? 'show active' : ''); ?>" id="invoice">
                        <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.invoice')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.invoice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!--End Invoice Settings-->
                    <!--Email Notification Settings-->
                    <div class="tab-pane fade <?php echo e($active_tab == 'email-notification' ? 'show active' : ''); ?>"
                        id="emailNotification">
                        <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.email-notification')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.email-notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!--End Email Notification Settings-->
                    <!--Tax Settings-->
                    <div class="tab-pane fade <?php echo e($active_tab == 'tax' ? 'show active' : ''); ?>" id="tax">
                        <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.tax')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.tax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!--End Tax Settings-->
                    <!--Shop Settings-->
                    <?php if(isActivePluging('multivendor')): ?>
                        <div class="tab-pane fade <?php echo e($active_tab == 'shop' ? 'show active' : ''); ?>" id="shopSettings">
                            <?php if ($__env->exists('plugin/tlecommercecore::ecommerce-settings.shop')) echo $__env->make('plugin/tlecommercecore::ecommerce-settings.shop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                    <!--End Shop Settings-->
                </div>
            </div>

            <div class="theme-option-sticky d-flex justify-content-end bg-white border-top2 p-3">
                <div class="theme-option-action_bar">
                    <button class="btn long ecommerce-settings-update-btn">
                        <?php echo e(translate('Save Changes')); ?>

                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php echo $__env->make('core::base.media.partial.media_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <script>
        (function($) {
            "use strict";
            initDropzone();
            /**
             * Enable and disable product review settings
             * 
             **/
            $('.enable-product-review').on('change', function(e) {
                if ($('input[name="enable_product_reviews"]').is(':checked')) {
                    $('.product-review-setting-group').removeClass('d-none');
                } else {
                    $('.product-review-setting-group').addClass('d-none');
                }
            });
            /**
             *Enable and disable order amount
             *  
             **/
            $('.enable-minumun-order-amount').on('change', function(e) {
                if ($('input[name="enable_minumun_order_amount"]').is(":checked")) {
                    $('.minimum-order-amount').removeClass('d-none');
                } else {
                    $('.minimum-order-amount').addClass('d-none');
                }
            });
            /**
             * Enable and disable coupon
             * 
             **/
            $('.enable-coupon-in-checkout').on('change', function(e) {
                if ($('input[name="enable_coupon_in_checkout"]').is(':checked')) {
                    $('.multiple-coupon-checkout').removeClass('d-none')
                } else {
                    $('.multiple-coupon-checkout').addClass('d-none')
                }
            });
            /**
             * Generate shop slug
             * 
             **/
            $(".shop-name").change(function(e) {
                e.preventDefault();
                let name = $(".shop-name").val();
                let permalink = string_to_slug(name);
                $("#permalink").html(permalink);
                $("#permalink_input_field").val(permalink);
                $(".permalink-input-group").removeClass("d-none");
                $(".permalink-editor").addClass("d-none");
                $(".permalink-edit-btn").removeClass("d-none");
            });
            /*edit permalink*/
            $(".permalink-edit-btn").on("click", function(e) {
                e.preventDefault();
                let permalink = $("#permalink").html();
                $("#permalink-updated-input").val(permalink);
                $(".permalink-edit-btn").addClass("d-none");
                $(".permalink-editor").removeClass("d-none");
            });
            /*Cancel permalink edit*/
            $(".permalink-cancel-btn").on("click", function(e) {
                e.preventDefault();
                $("#permalink-updated-input").val();
                $(".permalink-editor").addClass("d-none");
                $(".permalink-edit-btn").removeClass("d-none");
            });
            /*Update permalink*/
            $(".permalink-save-btn").on("click", function(e) {
                e.preventDefault();
                let input = $("#permalink-updated-input").val();
                let updated_permalink = string_to_slug(input);
                $("#permalink_input_field").val(updated_permalink);
                $("#permalink").html(updated_permalink);
                $(".permalink-editor").addClass("d-none");
                $(".permalink-edit-btn").removeClass("d-none");
            });
            /**
             * Save ecommmerce settings
             * 
             * 
             **/
            $('.ecommerce-settings-update-btn').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: $("#ecommerce-settings-form").serialize(),
                    url: '<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration.update')); ?>',
                    success: function(response) {
                        if (response.success) {
                            toastr.success('<?php echo e(translate('Updated successfully')); ?>');
                        } else {
                            toastr.error('<?php echo e(translate('Update Failed. Please try again')); ?>');
                        }
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            $.each(response.responseJSON.errors, function(field_name, error) {
                                toastr.error(error);
                            })
                        } else {
                            toastr.error('<?php echo e(translate('Update Failed. Please try again')); ?>');
                        }
                    }
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::base.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/ecommerce-settings/settings.blade.php ENDPATH**/ ?>