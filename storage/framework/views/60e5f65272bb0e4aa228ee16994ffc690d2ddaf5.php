<?php
    $media_file_type = config('settings.media_file_type');
    $media_type = array_flip(config('settings.media_type'));
    $year_months = getMonthsForUploadedFiles();
?>

<!-- Media List -->
<ul class="attachments list-unstyled" id="attachment-list">
    <?php
        $data = json_encode($media_ids);
    ?>
    <?php $__currentLoopData = $all_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li onclick="nextMediaSlide(event,'<?php echo e($data); ?>','<?php echo e($media->id); ?>')"
            id="list_item_<?php echo e($media->id); ?>">
            <div class="attachment-preview">
                <div class="thumbnail">
                    <?php
                        $media_path = getFilePath($media->id);
                        if ($media->file_type == 'pdf') {
                            $media_path = project_asset('/backend/assets/img/pdf-placeholder.png');
                        } elseif ($media->file_type == 'zip') {
                            $media_path = project_asset('/backend/assets/img/zip-placeholder.png');
                        } elseif ($media->file_type == 'mp4' || $media->file_type == 'video') {
                            $media_path = project_asset('/backend/assets/img/mp4-placeholder.png');
                        }
                    ?>
                    <img class="lozad" src="<?php echo e($media_path); ?>" alt="<?php echo e($media->alt); ?>" />
                </div>
            </div>

            <button type="button" class="check" id="check_<?php echo e($media->id); ?>">
                <i class="icofont-check icon-check"></i>
                <i class="icofont-minus icon-minus"></i>
            </button>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<!-- /Media List -->
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/Core/Views/base/media/partial/media_list.blade.php ENDPATH**/ ?>