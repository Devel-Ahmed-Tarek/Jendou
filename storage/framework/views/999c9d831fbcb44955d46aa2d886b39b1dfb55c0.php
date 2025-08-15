<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Homepage Builder')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_css'); ?>
    <style>
        .ui-state-default {
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
    <div class="border-bottom2 pb-3 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-sm-2"><i class="icofont-ui-home mr-1"></i><?php echo e(translate('Home Page Sections')); ?></h4>
        <div class="d-flex flex-wrap">
            <a href="<?php echo e(route('theme.tlcommerce.home.page.sections.new')); ?>"
                class="btn long"><?php echo e(translate('Add New Section')); ?></a>
        </div>
    </div>
    <div class="card mb-20 py-2">
        <div class="card-bod">
            <div class="payment-method-items">
                <div class="payment-method-item">
                    <div class="payment-method-item-header px-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="payment-logo">
                                <h5><?php echo e(translate('Banner Slider')); ?></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-15">
                            <a href="<?php echo e(route('theme.tlcommerce.sliders')); ?>">
                                <?php echo e(translate('Manage Slider')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(count($sections) > 0): ?>
        <div id="sortable">
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div id="item-<?php echo e($section->id); ?>" class="card mb-20 ui-state-default py-2">
                    <div class="card-bod">
                        <div class="payment-method-items">
                            <div class="payment-method-item">
                                <div class="payment-method-item-header px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="payment-logo">
                                            <h5><i
                                                    class="icofont-drag mr-1"></i><?php echo e(getHomePageSectionProperties($section->id, 'title')); ?>

                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-15">
                                        <a
                                            href="<?php echo e(route('theme.tlcommerce.home.page.sections.edit', ['id' => $section->id])); ?>">
                                            <i class="icofont-ui-edit"></i>
                                        </a>
                                        <label class="switch glow primary medium">
                                            <input type="checkbox" class="change-status" data-section="<?php echo e($section->id); ?>"
                                                <?php echo e($section->status == config('settings.general_status.active') ? 'checked' : ''); ?>>
                                            <span class="control"></span>
                                        </label>
                                        <a href="#" class="delete-section text-danger"
                                            data-section="<?php echo e($section->id); ?>">
                                            <i class="icofont-ui-delete"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p class="alert alert-danger text-center"><?php echo e(translate('No Section Found')); ?></p>
    <?php endif; ?>
    <!--Delete Modal-->
    <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6"><?php echo e(translate('Delete Confirmation')); ?></h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1"><?php echo e(translate('Are you sure to delete this section')); ?>?</p>
                    <form method="POST" action="<?php echo e(route('theme.tlcommerce.home.page.sections.remove')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="delete-section-id" name="id">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal"><?php echo e(translate('cancel')); ?></button>
                        <button type="submit" class="btn long mt-2"><?php echo e(translate('Delete')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Delete Modal-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $("#sortable").sortable({
            update: function(e, u) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    url: '<?php echo e(route('theme.tlcommerce.home.page.sections.sorting')); ?>',
                    type: 'post',
                    data: data,
                    success: function(result) {
                        location.reload();
                    },
                    complete: function() {
                        location.reload();
                    }
                });
            }

        });
        /**
         * 
         * Delete section
         * 
         * */
        $('.delete-section').on('click', function(e) {
            e.preventDefault();
            let $this = $(this);
            let id = $this.data('section');
            $("#delete-section-id").val(id);
            $('#delete-modal').modal('show');
        });
        /**
         * 
         * Change  status 
         * 
         * */
        $('.change-status').on('click', function(e) {
            e.preventDefault();
            let $this = $(this);
            let id = $this.data('section');
            $.post('<?php echo e(route('theme.tlcommerce.home.page.sections.update.status')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                id: id
            }, function(data) {
                location.reload();
            })

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::base.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/themes/tlcommerce/resources/views/backend/homepage/home_page_sections.blade.php ENDPATH**/ ?>