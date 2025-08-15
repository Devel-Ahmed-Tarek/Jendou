<?php
    $media_file_type = config('settings.media_file_type');
    $media_type = array_flip(config('settings.media_type'));
    $year_months = getMonthsForUploadedFiles();
?>
<!-- Media Manager -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active border-left-0" id="media-library-tab" data-toggle="tab" href="#media-library"
            role="tab" aria-controls="media-library" aria-selected="false"><?php echo e(translate('Media Library')); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="upload-files-tab" data-toggle="tab" href="#upload-files" role="tab"
            aria-controls="upload-files" aria-selected="true"><?php echo e(translate('Upload Files')); ?></a>
    </li>

</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="upload-files" role="tabpanel" aria-labelledby="upload-files-tab">
        <!-- Upload -->
        <div id="file-drop-area-wrappper" class="p-20 bg-white">
            <!-- Dropzone Start -->
            <form method="post" action="#" id="uploaded" enctype="multipart/form-data" class="dropzone style--two"
                id="dropzone" name="media_file">
                <?php echo csrf_field(); ?>
                <div class="d-flex justify-content-center flex-column align-items-center align-self-center"
                    data-dz-message>
                    <div class="dz-message bold c2 font-20 mb-3">
                        <?php echo e(translate('Click or Drop files here to upload')); ?>

                        <i class="icofont-cloud-upload"></i>
                    </div>
                </div>
            </form>

            <!-- Dropzone End -->
        </div>
        <!-- End Upload -->
    </div>
    <div class="tab-pane fade show active" id="media-library" role="tabpanel" aria-labelledby="media-library-tab">
        <div class="attachment-wrap border-bottom2">
            <div class="attachment">

                <div class="media-toolbar">
                    <div class="media-toolbar-secondary align-items-center d-flex gap-15">
                        <div class="filter-items">
                            <div class="media-filter-wrap">
                                <select id="media-file-filters"
                                    class="attachment-filters max-content theme-input-style border border-secondary rounded"
                                    onchange="filtermedia()">
                                    <option value="all"><?php echo e(translate('All File Type')); ?></option>
                                    <?php $__currentLoopData = $media_file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"
                                            <?php echo e(isset($selected_file_type) && $selected_file_type == $key ? 'selected' : ''); ?>>
                                            <?php echo e($value); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <select id="media-date-filters"
                                    class="attachment-filters theme-input-style border border-secondary rounded"
                                    onchange="filtermedia()">
                                    <option value="all"><?php echo e(translate('All dates')); ?></option>
                                    <?php $__currentLoopData = $year_months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"
                                            <?php echo e(isset($search_date) && $search_date == $key ? 'selected' : ''); ?>>
                                            <?php echo e($value); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <!--Multiple Select Switcher-->
                        <div class="align-items-center bg-light d-flex rounded" id="multiselectMediaWrapper">
                            <label class="position-relative">
                                <input type="checkbox" class="d-none" name="multiselectMediaCheckbox"
                                    id="multiselectMediaCheckbox">
                                <span class="checkmark"></span>
                            </label>
                            <label for="multiselectMediaCheckbox"
                                class="cursor-pointer"><?php echo e(translate('Select Multiple')); ?></label>
                        </div>
                        <!--End Multitple Select Switcher-->
                    </div>
                    <div class="media-toolbar-primary search-form">
                        <input type="search" id="media-search-input" placeholder="Search media items.."
                            class="search theme-input-style border border-secondary rounded"
                            value="<?php echo e(isset($search_input) ? $search_input : ''); ?>" onchange="filtermedia()" />
                    </div>
                </div>



                <div class="all-attachments">

                    <div id="filtered_media">

                    </div>

                    <div class="d-none load-more-wrapper mt-3 text-center">
                        <p class="load-more-count" id="show_count"></p>
                        <div class="d-flex justify-content-center gap-10" id="load_more">
                            <button type="button" class="btn btn-fill sm load-more" onclick="updateMediaPerPage()">
                                <?php echo e(translate('Load more')); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(Request::routeIs(['core.media.page'])): ?>
                <div class="d-flex justify-content-end pt-3 bg-white border-top2 px-3">
                    <button type="button" class="btn sm btn-danger mb-3" id="delete-media" onclick="deleteMediaFile()"
                        disabled>
                        <?php echo e(translate('Delete Permanently')); ?>

                    </button>
                </div>
            <?php endif; ?>
        </div>
        <div class="d-flex justify-content-end pt-3">
            <?php if(!Request::routeIs(['core.media.page'])): ?>
                <button type="button" class="btn sm btn-info insert_image">
                    <?php echo e(translate('Insert')); ?>

                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Media Manager -->
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/Core/Views/base/media/partial/media_manager.blade.php ENDPATH**/ ?>