<?php
    $options = explode('_', $layout);
?>
<?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-<?php echo e($option); ?>" style="border:1px dotted">
        <?php
            $image = $key + 1 . '_' . $option . '_image';
            $url = $key + 1 . '_' . $option . '_url';
        ?>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black"><?php echo e(translate('Image')); ?> </label>
            </div>
            <div class="col-md-12">
                <?php echo $__env->make('core::base.includes.media.media_input', [
                    'input' => $image,
                    'data' => getHomePageSectionProperties($section_details->id, $image),
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black"><?php echo e(translate('Url')); ?> </label>
            </div>
            <div class="col-md-12">
                <input type="text" class="theme-input-style" name="<?php echo e($url); ?>"
                    value="<?php echo e(getHomePageSectionProperties($section_details->id, $url)); ?>">
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/backend/homepage/sections/ads/ads_layout_options_edit.blade.php ENDPATH**/ ?>