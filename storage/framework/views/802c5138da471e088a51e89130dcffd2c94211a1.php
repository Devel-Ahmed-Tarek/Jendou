<?php
    $widget_title = isset($value) && isset($value['widget_title']) ? $value['widget_title'] : '';
    $mail = isset($value) && isset($value['mail']) ? $value['mail'] : '';
    $mobile = isset($value) && isset($value['mobile']) ? $value['mobile'] : '';
    $address = isset($value) && isset($value['address']) ? $value['address'] : '';
?>
<form action="#" class=" widget_input_field_form px-3 py-3 bg-white"
    onsubmit="event.preventDefault(); widgetInputFormSubmit(this);">
    
    <div class="row mb-3">
        <div class="col-12">
            <ul class="nav nav-tabs nav-fill border-light border-0">
                <?php
                    $languages = getAllLanguages();
                ?>
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if($language->code == $lang): ?> active border-0 <?php else: ?> bg-light <?php endif; ?> py-2"
                            href="javascript:void(0)"
                            onclick="getSidebarWidgetTranslationField(this,<?php echo e($sidebar_has_widget_id); ?>,<?php echo e($widget_id); ?>,'<?php echo e($language->code); ?>')">
                            <img src="<?php echo e('/public/flags/' . '/' . $language->code . '.png'); ?>" width="20px"
                                title="<?php echo e($language->name); ?>">
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <input type="hidden" name="lang" value="<?php echo e($lang); ?>">
    
    <div class="form-group">
        <label for="widget_title" class=""><?php echo e(translate('Widget Title')); ?></label>
        <input type="text" class="form-control" id="widget_title" name="widget_title"
            placeholder="<?php echo e(translate('Widget Title')); ?>" value="<?php echo e($widget_title); ?>">
    </div>

    <div class="<?php if(!empty($lang) && $lang != getdefaultlang()): ?> area-disabled <?php endif; ?>">
        <div class="form-group">
            <label for="mail" class=""><?php echo e(translate('Mail')); ?></label>
            <input type="text" class="form-control" id="mail" name="mail"
                placeholder="<?php echo e(translate('Widget Title')); ?>" value="<?php echo e($mail); ?>"
                <?php if(!empty($lang) && $lang != getdefaultlang()): ?> disabled <?php endif; ?>>
        </div>

        <div class="form-group">
            <label for="mobile" class=""><?php echo e(translate('Mobile')); ?></label>
            <input type="text" class="form-control" id="mobile" name="mobile"
                placeholder="<?php echo e(translate('Widget Title')); ?>" value="<?php echo e($mobile); ?>"
                <?php if(!empty($lang) && $lang != getdefaultlang()): ?> disabled <?php endif; ?>>
        </div>

        <div class="form-group">
            <label for="address"><?php echo e(translate('Address')); ?></label>
            <textarea id="address" name="address" class="theme-input-style style--two" placeholder="<?php echo e(translate('Address')); ?>"
                <?php if(!empty($lang) && $lang != getdefaultlang()): ?> disabled <?php endif; ?>><?php echo e($address); ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label><?php echo e(translate('Social Links: ')); ?></label>
        <a href="javascript:void(0);" class="style--two" onclick="authorSocialLink()"><?php echo e(translate('Set Social Links From Theme Options')); ?></a>
    </div>

    <div class="px-3 row justify-content-between">
        <div>
            <a href="javascript:;void(0)" class="text-danger"
                onclick="removeFromSidebar(this)"><?php echo e(translate('Delete')); ?></a>
            <span class="mx-1">|</span>
            <a href="javascript:;void(0)" class="text-info"
                onclick="closeSidebarDropMenu(this)"><?php echo e(translate('Done')); ?></a>
        </div>
        <button type="submit" class="btn btn-primary sm"><?php echo e(translate('Save')); ?></button>
    </div>
</form>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/backend/widgets/widget-forms/address_widget.blade.php ENDPATH**/ ?>