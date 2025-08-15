<div class="card">
    <div class="card-body">
        <div class="form-row mb-20">
            <div class="col-sm-4">
                <label class="font-14 bold black"><?php echo e(translate('Business Email')); ?></label>
            </div>
            <div class="col-sm-8">
                <input type="email" name="invoice_email" class="theme-input-style"
                    value="<?php echo e(getEcommerceSetting('invoice_email')); ?>" />
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-4">
                <label class="font-14 bold black"><?php echo e(translate('Business Phone')); ?></label>
            </div>
            <div class="col-sm-8">
                <input type="text" name="invoice_phone" class="theme-input-style"
                    value="<?php echo e(getEcommerceSetting('invoice_phone')); ?>" />
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-4">
                <label class="font-14 bold black"><?php echo e(translate('Business Address')); ?></label>
            </div>
            <div class="col-sm-8">
                <textarea name="invoice_address" class="theme-input-style"> <?php echo e(getEcommerceSetting('invoice_address')); ?></textarea>
            </div>
        </div>

        <div class="form-row mb-20">
            <div class="col-sm-4">
                <label class="font-14 bold black"><?php echo e(translate('Invoice & Shipping Label Logo')); ?></label>
            </div>
            <div class="col-sm-8">
                <?php echo $__env->make('core::base.includes.media.media_input', [
                    'input' => 'invoice_logo',
                    'data' => getEcommerceSetting('invoice_logo'),
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-4">
                <label class="font-14 bold black"><?php echo e(translate('Invoice Paid Image')); ?></label>
            </div>
            <div class="col-sm-8">
                <?php echo $__env->make('core::base.includes.media.media_input', [
                    'input' => 'invoice_paid_image',
                    'data' => getEcommerceSetting('invoice_paid_image'),
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-4">
                <label class="font-14 bold black"><?php echo e(translate('Invoice Unpaid Image')); ?></label>
            </div>
            <div class="col-sm-8">
                <?php echo $__env->make('core::base.includes.media.media_input', [
                    'input' => 'invoice_unpaid_image',
                    'data' => getEcommerceSetting('invoice_unpaid_image'),
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/ecommerce-settings/invoice.blade.php ENDPATH**/ ?>