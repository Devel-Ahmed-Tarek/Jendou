<div class="card">
    <div class="card-body">
        <?php if(count($currencies) > 0): ?>
            <div class="form-row mb-20">
                <div class="col-sm-4">
                    <label class="font-14 bold black"><?php echo e(translate('Defalt currency')); ?>

                    </label>
                </div>
                <div class="col-sm-4">
                    <select class="form-control" name="default_currency">
                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($currency->id); ?>" <?php if(getEcommerceSetting('default_currency') == $currency->id): ?> selected <?php endif; ?>>
                                <?php echo e($currency->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <p class="mt-0 font-13"> <?php echo e(translate('You can manage your currencies from')); ?>

                        <a href="<?php echo e(route('plugin.tlcommercecore.ecommerce.all.currencies')); ?>"
                            class="btn-link"><?php echo e(translate('Currencies Module')); ?>

                        </a>
                    </p>
                </div>
            </div>
        <?php else: ?>
            <p class="mt-0 font-13">
                <?php echo e(translate('To set default currency, plaese create a currency')); ?> <a
                    href="<?php echo e(route('plugin.tlcommercecore.ecommerce.all.currencies')); ?>"
                    class="btn-link"><?php echo e(translate('click here')); ?></a></p>
        <?php endif; ?>

        <?php
            $all_pages = \Core\Models\TlPage::where('publish_status', config('settings.general_status.active'))
                ->select('id', 'title')
                ->get();
        ?>
        <div class="form-row mb-20">
            <div class="col-sm-4">
                <label class="font-14 bold black"><?php echo e(translate('Customer Term & Condition Page')); ?>

                </label>
            </div>
            <div class="col-sm-4">
                <select class="form-control" name="customer_term_condition_page">
                    <option value=""><?php echo e(translate('Select a page')); ?></option>
                    <?php $__currentLoopData = $all_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($page->id); ?>" <?php if(getEcommerceSetting('customer_term_condition_page') == $page->id): echo 'selected'; endif; ?>>
                            <?php echo e($page->title); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-sm-4">
                <p class="mt-0 font-13">
                    <?php echo e(translate('To create new page or manage existing pages from')); ?>

                    <a href="<?php echo e(route('core.page')); ?>" class="btn-link"><?php echo e(translate('Pages Module')); ?>

                    </a>
                </p>
            </div>
        </div>
        <?php if(isActivePluging('multivendor')): ?>
            <div class="form-row mb-20">
                <div class="col-sm-4">
                    <label class="font-14 bold black"><?php echo e(translate('Seller Term & Condition Page')); ?>

                    </label>
                </div>
                <div class="col-sm-4">
                    <select class="form-control" name="seller_term_condition_page">
                        <option value=""><?php echo e(translate('Select a page')); ?></option>
                        <?php $__currentLoopData = $all_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($page->id); ?>" <?php if(getEcommerceSetting('seller_term_condition_page') == $page->id): echo 'selected'; endif; ?>>
                                <?php echo e($page->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <p class="mt-0 font-13">
                        <?php echo e(translate('To create new page or manage existing pages from')); ?>

                        <a href="<?php echo e(route('core.page')); ?>" class="btn-link"><?php echo e(translate('Pages Module')); ?>

                        </a>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/ecommerce-settings/general.blade.php ENDPATH**/ ?>