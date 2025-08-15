<div class="card">
    <div class="card-body">
        <div class="form-row mb-20">
            <label class="font-14 bold black col-sm-4"><?php echo e(translate('Order code prefix')); ?>

            </label>
            <div class="col-sm-4">
                <input type="text" name="order_code_prefix" value="<?php echo e(getEcommerceSetting('order_code_prefix')); ?>"
                    class="theme-input-style" placeholder="<?php echo e(translate('Enter prefix')); ?>">
            </div>
        </div>
        <div class="form-row mb-20">
            <label class="font-14 bold black col-sm-4"><?php echo e(translate('Order code prefix seperator')); ?>

            </label>
            <div class="col-sm-4">
                <input type="text" name="order_code_prefix_seperator"
                    value="<?php echo e(getEcommerceSetting('order_code_prefix_seperator')); ?>" class="theme-input-style"
                    placeholder="<?php echo e(translate('Enter prefix seperator')); ?>">
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-4">
                <label class="font-14 bold black"><?php echo e(translate('Can cancel order within')); ?>

                </label>
            </div>
            <div class="col-sm-4">
                <div class="input-group addon">
                    <input type="text" name="cancel_order_time_limit"
                        value="<?php echo e(getEcommerceSetting('cancel_order_time_limit')); ?>" placeholder="0"
                        class="form-control style--two">
                    <div class="input-group-append">
                        <select class="form-control" name="cancel_order_time_limit_unit">
                            <option value="<?php echo e(config('tlecommercecore.time_unit.Days')); ?>"
                                <?php if(getEcommerceSetting('cancel_order_time_limit_unit') == config('tlecommercecore.time_unit.Days')): ?> selected <?php endif; ?>>
                                <?php echo e(translate('Days')); ?></option>
                            <option value="<?php echo e(config('tlecommercecore.time_unit.Hours')); ?>"
                                <?php if(getEcommerceSetting('cancel_order_time_limit_unit') == config('tlecommercecore.time_unit.Hours')): ?> selected <?php endif; ?>>
                                <?php echo e(translate('Hours')); ?></option>
                            <option value="<?php echo e(config('tlecommercecore.time_unit.Minutes')); ?>"
                                <?php if(getEcommerceSetting('cancel_order_time_limit_unit') == config('tlecommercecore.time_unit.Minutes')): ?> selected <?php endif; ?>>
                                <?php echo e(translate('Minutes')); ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-4">
                <label class="font-14 bold black"><?php echo e(translate('Can return order within')); ?>

                </label>
            </div>
            <div class="col-sm-4">
                <div class="input-group addon">
                    <input type="text" name="return_order_time_limit"
                        value="<?php echo e(getEcommerceSetting('return_order_time_limit')); ?>" placeholder="0"
                        class="form-control style--two">
                    <div class="input-group-append">
                        <select class="form-control" name="return_order_time_limit_unit">
                            <option value="<?php echo e(config('tlecommercecore.time_unit.Days')); ?>"
                                <?php if(getEcommerceSetting('return_order_time_limit_unit') == config('tlecommercecore.time_unit.Days')): ?> selected <?php endif; ?>>
                                <?php echo e(translate('Days')); ?></option>
                            <option value="<?php echo e(config('tlecommercecore.time_unit.Hours')); ?>"
                                <?php if(getEcommerceSetting('return_order_time_limit_unit') == config('tlecommercecore.time_unit.Hours')): ?> selected <?php endif; ?>>
                                <?php echo e(translate('Hours')); ?></option>
                            <option value="<?php echo e(config('tlecommercecore.time_unit.Minutes')); ?>"
                                <?php if(getEcommerceSetting('return_order_time_limit_unit') == config('tlecommercecore.time_unit.Minutes')): ?> selected <?php endif; ?>>
                                <?php echo e(translate('Minutes')); ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/ecommerce-settings/orders.blade.php ENDPATH**/ ?>