<div class="form-row mb-20">
    <div class="col-sm-12">
        <label class="font-14 bold black"><?php echo e(translate('Padding')); ?> </label>
    </div>
    <div class="col-sm-3">
        <div class="input-group addon">
            <input type="text" class="form-control radius-0" name="padding_top" id="left-right-addons" placeholder="00"
                value="<?php echo e(getHomePageSectionProperties($section_id, 'padding_top')); ?>">
            <div class="input-group-append">
                <span class="input-group-text style--three black bold">px</span>
            </div>
        </div>
        <smal><?php echo e(translate('Top')); ?></smal>
        <?php if($errors->has('padding_top')): ?>
            <div class="invalid-input"><?php echo e($errors->first('padding_top')); ?></div>
        <?php endif; ?>
    </div>
    <div class="col-sm-3">
        <div class="input-group addon">
            <input type="text" class="form-control radius-0" name="padding_right" id="left-right-addons"
                placeholder="00" value="<?php echo e(getHomePageSectionProperties($section_id, 'padding_right')); ?>">
            <div class="input-group-append">
                <span class="input-group-text style--three black bold">px</span>
            </div>
        </div>
        <smal><?php echo e(translate('Right')); ?></smal>
        <?php if($errors->has('padding_right')): ?>
            <div class="invalid-input"><?php echo e($errors->first('padding_right')); ?></div>
        <?php endif; ?>
    </div>
    <div class="col-sm-3">
        <div class="input-group addon">
            <input type="text" class="form-control radius-0" name="padding_bottom" id="left-right-addons"
                placeholder="00" value="<?php echo e(getHomePageSectionProperties($section_id, 'padding_bottom')); ?>">
            <div class="input-group-append">
                <span class="input-group-text style--three black bold">px</span>
            </div>
        </div>
        <smal><?php echo e(translate('Bottom')); ?></smal>
        <?php if($errors->has('padding_bottom')): ?>
            <div class="invalid-input"><?php echo e($errors->first('padding_bottom')); ?></div>
        <?php endif; ?>
    </div>
    <div class="col-sm-3">
        <div class="input-group addon">
            <input type="text" class="form-control radius-0" name="padding_left" id="left-right-addons"
                placeholder="00" value="<?php echo e(getHomePageSectionProperties($section_id, 'padding_left')); ?>">
            <div class="input-group-append">
                <span class="input-group-text style--three black bold">px</span>
            </div>
        </div>
        <smal><?php echo e(translate('Left')); ?></smal>
        <?php if($errors->has('padding_left')): ?>
            <div class="invalid-input"><?php echo e($errors->first('padding_left')); ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="form-row mb-20">
    <div class="col-sm-12">
        <label class="font-14 bold black"><?php echo e(translate('Margin')); ?> </label>
    </div>
    <div class="col-sm-3">
        <div class="input-group addon">
            <input type="text" class="form-control radius-0" name="margin_top" id="left-right-addons"
                placeholder="00" value="<?php echo e(getHomePageSectionProperties($section_id, 'margin_top')); ?>">
            <div class="input-group-append">
                <span class="input-group-text style--three black bold">px</span>
            </div>
        </div>
        <smal><?php echo e(translate('Top')); ?></smal>
        <?php if($errors->has('margin_top')): ?>
            <div class="invalid-input"><?php echo e($errors->first('margin_top')); ?></div>
        <?php endif; ?>
    </div>
    <div class="col-sm-3">
        <div class="input-group addon">
            <input type="text" class="form-control radius-0" name="margin_right" id="left-right-addons"
                placeholder="00" value="<?php echo e(getHomePageSectionProperties($section_id, 'margin_right')); ?>">
            <div class="input-group-append">
                <span class="input-group-text style--three black bold">px</span>
            </div>
        </div>
        <smal><?php echo e(translate('Right')); ?></smal>
        <?php if($errors->has('margin_right')): ?>
            <div class="invalid-input"><?php echo e($errors->first('margin_right')); ?></div>
        <?php endif; ?>
    </div>
    <div class="col-sm-3">
        <div class="input-group addon">
            <input type="text" class="form-control radius-0" name="margin_bottom" id="left-right-addons"
                placeholder="00" value=" <?php echo e(getHomePageSectionProperties($section_id, 'margin_bottom')); ?>">
            <div class="input-group-append">
                <span class="input-group-text style--three black bold">px</span>
            </div>
        </div>
        <smal><?php echo e(translate('Bottom')); ?></smal>
        <?php if($errors->has('margin_bottom')): ?>
            <div class="invalid-input"><?php echo e($errors->first('margin_bottom')); ?></div>
        <?php endif; ?>
    </div>
    <div class="col-sm-3">
        <div class="input-group addon">
            <input type="text" class="form-control radius-0" name="margin_left" id="left-right-addons"
                placeholder="00" value="<?php echo e(getHomePageSectionProperties($section_id, 'margin_left')); ?>">
            <div class="input-group-append">
                <span class="input-group-text style--three black bold">px</span>
            </div>
        </div>
        <smal><?php echo e(translate('Left')); ?></smal>
        <?php if($errors->has('margin_left')): ?>
            <div class="invalid-input"><?php echo e($errors->first('margin_left')); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/backend/homepage/properties/advance_properties_edit.blade.php ENDPATH**/ ?>