
<h3 class="black mb-3"><?php echo e(translate('Footer')); ?></h3>
<input type="hidden" name="option_name" value="footer">


<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4 mb-3">
        <label class="font-16 bold black"><?php echo e(translate('Custom Footer Style')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('Switch on for custom footer style.')); ?></span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_footer" value="0">
            <input type="checkbox"
                <?php echo e(isset($option_settings['custom_footer']) && $option_settings['custom_footer'] == 1 ? 'checked' : ''); ?>

                name="custom_footer" id="custom_footer" value="1">
            <span class="control" id="custom_footer_switch">
                <span class="switch-off">Disable</span>
                <span class="switch-on">Enable</span>
            </span>
        </label>
    </div>
</div>



<div id="custom_footer_switch_on_field">
    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Custom Footer Padding.')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Footer Padding.')); ?></span>
        </div>
        <div class="col-xl-7 offset-xl-1 row">
            <div class="input-group my-2  col-xl-4">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="custom_footer_padding_top"
                    id="custom_footer_padding_top" placeholder="<?php echo e(translate('Top')); ?>"
                    value="<?php echo e(isset($option_settings['custom_footer_padding_top']) ? $option_settings['custom_footer_padding_top'] : ''); ?>">
            </div>

            <div class="input-group my-2  col-xl-4">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="custom_footer_padding_bottom"
                    id="custom_footer_padding_bottom" placeholder="<?php echo e(translate('Bottom')); ?>"
                    value="<?php echo e(isset($option_settings['custom_footer_padding_bottom']) ? $option_settings['custom_footer_padding_bottom'] : ''); ?>">
            </div>

            <div class="input-group my-2  col-xl-4">
                <select class="form-control select" name="custom_footer_padding_unit" id="custom_footer_padding_unit">
                    <option value="px"
                        <?php echo e(isset($option_settings['custom_footer_padding_unit']) && $option_settings['custom_footer_padding_unit'] == 'px' ? 'selected' : ''); ?>>
                        px</option>
                </select>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Footer Background Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Background Color')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="footer_background_color"
                        value="<?php echo e(isset($option_settings['footer_background_color']) ? $option_settings['footer_background_color'] : ''); ?>">

                    <input type="color" class="" id="footer_background_color"
                        value="<?php echo e(isset($option_settings['footer_background_color']) ? $option_settings['footer_background_color'] : '#fafafa'); ?>">
                    <label for="footer_background_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="footer_background_color_transparent" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['footer_background_color_transparent']) && $option_settings['footer_background_color_transparent'] == 1 ? 'checked' : ''); ?>

                            name="footer_background_color_transparent" id="footer_background_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="footer_background_color_transparent"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Footer Text Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Text Color')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="footer_text_color"
                        value="<?php echo e(isset($option_settings['footer_text_color']) ? $option_settings['footer_text_color'] : ''); ?>">

                    <input type="color" class="" id="footer_text_color"
                        value="<?php echo e(isset($option_settings['footer_text_color']) ? $option_settings['footer_text_color'] : '#fafafa'); ?>">
                    <label for="footer_text_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="footer_text_color_transparent" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['footer_text_color_transparent']) && $option_settings['footer_text_color_transparent'] == 1 ? 'checked' : ''); ?>

                            name="footer_text_color_transparent" id="footer_text_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="footer_text_color_transparent"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Footer Anchor Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Footer Anchor Color')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="footer_anchor_color"
                        value="<?php echo e(isset($option_settings['footer_anchor_color']) ? $option_settings['footer_anchor_color'] : ''); ?>">

                    <input type="color" class="" id="footer_anchor_color"
                        value="<?php echo e(isset($option_settings['footer_anchor_color']) ? $option_settings['footer_anchor_color'] : '#fafafa'); ?>">
                    <label for="footer_anchor_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="footer_anchor_color_transparent" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['footer_anchor_color_transparent']) && $option_settings['footer_anchor_color_transparent'] == 1 ? 'checked' : ''); ?>

                            name="footer_anchor_color_transparent" id="footer_anchor_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="footer_anchor_color_transparent"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Footer Anchor Hover Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Footer Anchor Hover Color')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="footer_anchor_hover_color"
                        value="<?php echo e(isset($option_settings['footer_anchor_hover_color']) ? $option_settings['footer_anchor_hover_color'] : ''); ?>">

                    <input type="color" class="" id="footer_anchor_hover_color"
                        value="<?php echo e(isset($option_settings['footer_anchor_hover_color']) ? $option_settings['footer_anchor_hover_color'] : '#fafafa'); ?>">
                    <label for="footer_anchor_hover_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="footer_anchor_hover_color_transparent" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['footer_anchor_hover_color_transparent']) && $option_settings['footer_anchor_hover_color_transparent'] == 1 ? 'checked' : ''); ?>

                            name="footer_anchor_hover_color_transparent" id="footer_anchor_hover_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="footer_anchor_hover_color_transparent"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/backend/theme/option-form/footer.blade.php ENDPATH**/ ?>