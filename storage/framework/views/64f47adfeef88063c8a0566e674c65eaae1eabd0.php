<?php
    $widget_title = isset($value) && isset($value['widget_title']) ? $value['widget_title'] : '';
    $newsletter_short_desc = isset($value) && isset($value['newsletter_short_desc']) ? $value['newsletter_short_desc']:'';
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
                            href="javascript:void(0)" onclick="getSidebarWidgetTranslationField(this,<?php echo e($sidebar_has_widget_id); ?>,<?php echo e($widget_id); ?>,'<?php echo e($language->code); ?>')">
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

    <div class="form-group">
        <label for="newsletter_short_desc"><?php echo e(translate('Newsletter Short Desc')); ?></label>
        <textarea id="newsletter_short_desc" name="newsletter_short_desc"
            class="theme-input-style style--two" placeholder="<?php echo e(translate('Newsletter Short Desc')); ?>"><?php echo e($newsletter_short_desc); ?></textarea>
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
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/backend/widgets/widget-forms/newsletter_widget.blade.php ENDPATH**/ ?>