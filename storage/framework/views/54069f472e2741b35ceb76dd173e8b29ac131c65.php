 <div class="form-row mb-20">
     <div class="col-sm-12">
         <label class="font-14 bold black"><?php echo e(translate('Background Color')); ?> </label>
     </div>
     <div class="col-sm-12">
         <div class="input-group addon">
             <input type="text" name="bg_color" class="color-input form-control style--two" placeholder="#fffff"
                 value="<?php echo e(getHomePageSectionProperties($section_id, 'bg_color')); ?>">
             <div class="input-group-append">
                 <input type="color" class="input-group-text theme-input-style2 color-picker" id="colorPicker"
                     value="<?php echo e(getHomePageSectionProperties($section_id, 'bg_color')); ?>"
                     oninput="selectColor(event,this.value)">
             </div>
         </div>
         <?php if($errors->has('bg_color')): ?>
             <div class="invalid-input"><?php echo e($errors->first('bg_color')); ?></div>
         <?php endif; ?>
     </div>
 </div>
 <div class="form-row mb-20">
     <div class="col-sm-12">
         <label class="font-14 bold black"><?php echo e(translate('Background Image')); ?> </label>
     </div>
     <div class="col-md-12">
         <?php echo $__env->make('core::base.includes.media.media_input', [
             'input' => 'bg_image',
             'data' => getHomePageSectionProperties($section_id, 'bg_image'),
         ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <?php if($errors->has('bg_image')): ?>
             <div class="invalid-input"><?php echo e($errors->first('bg_image')); ?></div>
         <?php endif; ?>
     </div>
 </div>
 <div class="form-row mb-20">
     <div class="col-sm-12">
         <label class="font-14 bold black"> <?php echo e(translate('Background Size')); ?> </label>
     </div>
     <div class="col-sm-12">
         <select class="theme-input-style" name="background_size">
             <option value="cover" <?php if(getHomePageSectionProperties($section_id, 'background_size') == 'cover'): echo 'selected'; endif; ?>><?php echo e(translate('cover')); ?></option>
             <option value="auto" <?php if(getHomePageSectionProperties($section_id, 'background_size') == 'auto'): echo 'selected'; endif; ?>><?php echo e(translate('auto')); ?></option>
             <option value="contain" <?php if(getHomePageSectionProperties($section_id, 'background_size') == 'contain'): echo 'selected'; endif; ?>><?php echo e(translate('contain')); ?></option>
             <option value="initial" <?php if(getHomePageSectionProperties($section_id, 'background_size') == 'initial'): echo 'selected'; endif; ?>><?php echo e(translate('initial')); ?></option>
             <option value="revert" <?php if(getHomePageSectionProperties($section_id, 'background_size') == 'revert'): echo 'selected'; endif; ?>><?php echo e(translate('revert')); ?></option>
             <option value="inherit" <?php if(getHomePageSectionProperties($section_id, 'background_size') == 'inherit'): echo 'selected'; endif; ?>><?php echo e(translate('inherit')); ?></option>
             <option value="revert-layer" <?php if(getHomePageSectionProperties($section_id, 'background_size') == 'revert-layer'): echo 'selected'; endif; ?>><?php echo e(translate('revert-layer')); ?>

             </option>
             <option value="unset" <?php if(getHomePageSectionProperties($section_id, 'background_size') == 'unset'): echo 'selected'; endif; ?>><?php echo e(translate('unset')); ?></option>
         </select>
         <?php if($errors->has('background_size')): ?>
             <div class="invalid-input"><?php echo e($errors->first('background_size')); ?></div>
         <?php endif; ?>
     </div>
 </div>
 <div class="form-row mb-20">
     <div class="col-sm-12">
         <label class="font-14 bold black"> <?php echo e(translate('Background Position')); ?> </label>
     </div>
     <div class="col-sm-12">
         <select class="theme-input-style" name="background_position">
             <option value="bottom" <?php if(getHomePageSectionProperties($section_id, 'background_position') == 'bottom'): echo 'selected'; endif; ?>><?php echo e(translate('bottom')); ?></option>
             <option value="center" <?php if(getHomePageSectionProperties($section_id, 'background_position') == 'center'): echo 'selected'; endif; ?>><?php echo e(translate('center')); ?></option>
             <option value="inherit" <?php if(getHomePageSectionProperties($section_id, 'background_position') == 'inherit'): echo 'selected'; endif; ?>><?php echo e(translate('inherit')); ?></option>
             <option value="initial" <?php if(getHomePageSectionProperties($section_id, 'background_position') == 'initial'): echo 'selected'; endif; ?>><?php echo e(translate('initial')); ?></option>
             <option value="left" <?php if(getHomePageSectionProperties($section_id, 'background_position') == 'left'): echo 'selected'; endif; ?>><?php echo e(translate('left')); ?></option>
             <option value="revert" <?php if(getHomePageSectionProperties($section_id, 'background_position') == 'revert'): echo 'selected'; endif; ?>><?php echo e(translate('revert')); ?></option>
             <option value="revert-layer" <?php if(getHomePageSectionProperties($section_id, 'background_position') == 'revert-layer'): echo 'selected'; endif; ?>><?php echo e(translate('revert-layer')); ?>

             </option>
             <option value="right" <?php if(getHomePageSectionProperties($section_id, 'background_position') == 'right'): echo 'selected'; endif; ?>><?php echo e(translate('right')); ?></option>
             <option value="top" <?php if(getHomePageSectionProperties($section_id, 'background_position') == 'top'): echo 'selected'; endif; ?>><?php echo e(translate('top')); ?></option>
             <option value="unset" <?php if(getHomePageSectionProperties($section_id, 'background_position') == 'unset'): echo 'selected'; endif; ?>><?php echo e(translate('unset')); ?></option>
         </select>
         <?php if($errors->has('background_position')): ?>
             <div class="invalid-input"><?php echo e($errors->first('background_position')); ?></div>
         <?php endif; ?>
     </div>
 </div>
 <div class="form-row mb-20">
     <div class="col-sm-12">
         <label class="font-14 bold black"> <?php echo e(translate('Background Repeat')); ?> </label>
     </div>
     <div class="col-sm-12">
         <select class="theme-input-style" name="background_repeat">
             <option value="no-repeat" <?php if(getHomePageSectionProperties($section_id, 'background_repeat') == 'no-repeat'): echo 'selected'; endif; ?>>no-repeat</option>
             <option value="repeat" <?php if(getHomePageSectionProperties($section_id, 'background_repeat') == 'repeat'): echo 'selected'; endif; ?>>repeat</option>
         </select>
         <?php if($errors->has('background_repeat')): ?>
             <div class="invalid-input"><?php echo e($errors->first('background_repeat')); ?></div>
         <?php endif; ?>
     </div>
 </div>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/backend/homepage/properties/background_properties_edit.blade.php ENDPATH**/ ?>