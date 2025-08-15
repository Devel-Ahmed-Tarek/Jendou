 <?php if(isActivePluging('tlecommercecore')): ?>
     <?php
         $categories = \Plugin\TlcommerceCore\Models\ProductCategory::where('parent', null)
             ->where('status', config('settings.general_status.active'))
             ->orderBy('id', 'ASC')
             ->get();
     ?>
     <ul class="nav nav-tabs mb-20" id="myTab" role="tablist">
         <li class="nav-item">
             <a class="nav-link active" id="content-info-tab" data-toggle="tab" href="#content-info" role="tab"
                 aria-controls="content-info" aria-selected="true"><?php echo e(translate('Content')); ?></a>
         </li>
         <li class="nav-item">
             <a class="nav-link" id="background-tab" data-toggle="tab" href="#background" role="tab"
                 aria-controls="background" aria-selected="false"><?php echo e(translate('Background')); ?></a>
         </li>
         <li class="nav-item">
             <a class="nav-link" id="button-tab" data-toggle="tab" href="#button" role="tab" aria-controls="button"
                 aria-selected="false"><?php echo e(translate('Button')); ?></a>
         </li>
         <li class="nav-item">
             <a class="nav-link" id="advanced-tab" data-toggle="tab" href="#advanced" role="tab"
                 aria-controls="button" aria-selected="false"><?php echo e(translate('Advanced')); ?></a>
         </li>
     </ul>
     <div class="tab-content" id="myTabContent">
         <!--General info-->
         <div class="tab-pane fade show active" id="content-info" role="tabpanel" aria-labelledby="content-info-tab">

             <div class="form-row mb-20">
                 <div class="col-sm-12">
                     <label class="font-14 bold black"><?php echo e(translate('Select Option')); ?></label>
                 </div>
                 <div class="col-sm-12">
                     <select class="theme-input-style custom-product-options" name="content" required
                         onchange="selectProductOption()">
                         <option value="new_arrival" <?php if(getHomePageSectionProperties($details->id, 'content') == 'new_arrival'): echo 'selected'; endif; ?>><?php echo e(translate('New Arrival')); ?>

                         </option>
                         <option value="featured" <?php if(getHomePageSectionProperties($details->id, 'content') == 'featured'): echo 'selected'; endif; ?>><?php echo e(translate('Featured Products')); ?>

                         </option>
                         <option value="top_selling" <?php if(getHomePageSectionProperties($details->id, 'content') == 'top_selling'): echo 'selected'; endif; ?>><?php echo e(translate('Top Selling')); ?>

                         </option>
                         <option value="top_reviewed" <?php if(getHomePageSectionProperties($details->id, 'content') == 'top_reviewed'): echo 'selected'; endif; ?>><?php echo e(translate('Top Reviewed')); ?>

                         </option>
                         <option value="category" <?php if(getHomePageSectionProperties($details->id, 'content') == 'category'): echo 'selected'; endif; ?>><?php echo e(translate('Category wise')); ?></option>
                     </select>

                     <?php if($errors->has('content')): ?>
                         <div class="invalid-input"><?php echo e($errors->first('content')); ?></div>
                     <?php endif; ?>
                 </div>
             </div>
             <div class="form-row mb-20 category-options <?php if(getHomePageSectionProperties($details->id, 'content') != 'category'): ?> d-none <?php endif; ?>">
                 <div class="col-sm-12">
                     <label class="font-14 bold black"><?php echo e(translate('Select Category')); ?></label>
                 </div>
                 <div class="col-sm-12">
                     <select class="theme-input-style" name="category">
                         <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($category->id); ?>" <?php if(getHomePageSectionProperties($details->id, 'category') == $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?>

                             </option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                     <?php if($errors->has('category')): ?>
                         <div class="invalid-input"><?php echo e($errors->first('category')); ?></div>
                     <?php endif; ?>
                 </div>
             </div>
             <div class="form-row mb-20">
                 <div class="col-sm-12">
                     <label class="font-14 bold black"><?php echo e(translate('Title')); ?> </label>
                 </div>
                 <div class="col-sm-12">
                     <div class="input-group addon">
                         <input type="text" name="title"
                             value="<?php echo e(getHomePageSectionProperties($details->id, 'title')); ?>"
                             class="theme-input-style" placeholder="Title" required>

                     </div>
                     <?php if($errors->has('title')): ?>
                         <div class="invalid-input"><?php echo e($errors->first('title')); ?></div>
                     <?php endif; ?>
                     <small><?php echo e(translate('Title is visible in homepage. Transalate to another language')); ?> <a
                             href="<?php echo e(route('core.languages')); ?>"><?php echo e(translate('click here')); ?>.</a></small>
                 </div>
             </div>
             <div class="form-row mb-20">
                 <div class="col-sm-12">
                     <label class="font-14 bold black"><?php echo e(translate('Title Color')); ?> </label>
                 </div>
                 <div class="col-sm-12">
                     <div class="input-group addon">
                         <input type="text" name="title_color" class="color-input form-control style--two"
                             placeholder="#fffff"
                             value="<?php echo e(getHomePageSectionProperties($details->id, 'title_color')); ?>">
                         <div class="input-group-append">
                             <input type="color" class="input-group-text theme-input-style2 color-picker"
                                 id="colorPicker"
                                 value="<?php echo e(getHomePageSectionProperties($details->id, 'title_color')); ?>"
                                 oninput="selectColor(event,this.value)">
                         </div>
                     </div>
                     <?php if($errors->has('title_color')): ?>
                         <div class="invalid-input"><?php echo e($errors->first('title_color')); ?></div>
                     <?php endif; ?>
                 </div>
             </div>
         </div>
         <!--End general info-->
         <!--Background-->
         <div class="tab-pane fade" id="background" role="tabpanel" aria-labelledby="background-tab">
             <?php echo $__env->make('theme/tlcommerce::backend.homepage.properties.background_properties_edit', [
                 'section_id' => $details->id,
             ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         </div>
         <!--End background-->
         <!--Button-->
         <div class="tab-pane fade" id="button" role="tabpanel" aria-labelledby="button-tab">
             <div class="form-row mb-20">
                 <div class="col-sm-12">
                     <label class="font-14 bold black"><?php echo e(translate('Button Title')); ?> </label>
                 </div>
                 <div class="col-sm-12">
                     <input type="text" name="btn_title" class="theme-input-style"
                         value="<?php echo e(getHomePageSectionProperties($details->id, 'btn_title')); ?>"
                         placeholder="<?php echo e(translate('Button Title')); ?>">
                     <?php if($errors->has('btn_title')): ?>
                         <div class="invalid-input"><?php echo e($errors->first('btn_title')); ?></div>
                     <?php endif; ?>
                     <small><?php echo e(translate('Button title is visible in homepage. Transalate to another language')); ?> <a
                             href="<?php echo e(route('core.languages')); ?>"><?php echo e(translate('click here')); ?>.</a></small>
                 </div>
             </div>
             <?php echo $__env->make('theme/tlcommerce::backend.homepage.properties.button_properties_edit', [
                 'section_id' => $details->id,
             ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         </div>
         <!--End button-->
         <!--Advanced-->
         <div class="tab-pane fade" id="advanced" role="tabpanel" aria-labelledby="advanced-tab">
             <?php echo $__env->make('theme/tlcommerce::backend.homepage.properties.advance_properties_edit', [
                 'section_id' => $details->id,
             ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         </div>
         <!--End advance-->
     </div>
 <?php endif; ?>
 <script>
     function selectProductOption() {
         let layout = $(".custom-product-options").val();
         if (layout === 'category') {
             $('.category-options').removeClass('d-none');
         } else {
             $('.category-options').addClass('d-none');
         }
     }
 </script>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/backend/homepage/sections/custom_collection/custom_product_section_edit_option.blade.php ENDPATH**/ ?>