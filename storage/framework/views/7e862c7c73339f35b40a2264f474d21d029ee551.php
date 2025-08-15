<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Themes')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
    <div class="align-items-center border-bottom2 d-flex flex-wrap gap-10 justify-content-between mb-4 pb-3">
        <h4><i class="icofont-ui-theme"></i> <?php echo e(translate('Themes')); ?></h4>
        <?php if(!isTenant()): ?>
            <div class="d-flex align-items-center gap-10 flex-wrap">
                <a href="<?php echo e(route('core.themes.create')); ?>" class="btn long"><?php echo e(translate('Install New Theme')); ?></a>
            </div>
        <?php endif; ?>
    </div>
    <?php if(!isTenant()): ?>
        <div class="app-items theme-items">
            <div class="row">
                <?php $__currentLoopData = $themes->where('type', 'saas'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-30">
                        <div class="app-item">
                            <div class="app-icon">
                                <img src="<?php echo e(asset('/themes' . '/' . $theme->location . '/banner.png')); ?>"
                                    alt="<?php echo e($theme->name); ?>" />
                            </div>
                            <div class="app-details">
                                <h4 class="app-name"><?php echo e($theme->name); ?></h4>
                            </div>
                            <div class="app-footer">
                                <div class="app-author">
                                    <?php echo e(translate('By:')); ?>

                                    <a href="<?php echo e($theme->url); ?>" target="_blank"><?php echo e($theme->author); ?></a>
                                </div>
                                <div class="app-version"><?php echo e(translate('Version:')); ?> <?php echo e($theme->version); ?></div>
                                <div class="app-description" title="<?php echo e($theme->name); ?>">
                                    <?php echo e($theme->description); ?>

                                </div>
                                <div class="app-actions">
                                    <?php if($theme->is_activated == 1): ?>
                                        <button class="btn sm btn-success btn-trigger-change-status"
                                            data-theme="<?php echo e($theme->id); ?>">
                                            <i class="icofont-ui-check"></i> <?php echo e(translate('Activated')); ?>

                                        </button>
                                    <?php else: ?>
                                        <button class="btn sm btn-info btn-trigger-change-status activate-theme"
                                            data-theme="<?php echo e($theme->id); ?>">
                                            <?php echo e(translate('Activate')); ?>

                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="row mr-0 mt-2">
                <div class="border-bottom2 col-lg-12 mb-4 mx-3 pb-3 px-0">
                    <h4><i class="icofont-ui-theme"></i> <?php echo e(translate('Tenant Themes')); ?></h4>
                </div>
                <?php $__currentLoopData = $themes->where('type', 'store'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-30">
                        <div class="app-item">
                            <div class="app-icon">
                                <img src="<?php echo e(asset('/themes' . '/' . $theme->location . '/banner.png')); ?>"
                                    alt="<?php echo e($theme->name); ?>" />
                            </div>
                            <div class="app-details">
                                <h4 class="app-name"><?php echo e($theme->name); ?></h4>
                            </div>
                            <div class="app-footer">
                                <div class="app-author">
                                    <?php echo e(translate('By:')); ?>

                                    <a href="<?php echo e($theme->url); ?>" target="_blank"><?php echo e($theme->author); ?></a>
                                </div>
                                <div class="app-version"><?php echo e(translate('Version:')); ?> <?php echo e($theme->version); ?></div>
                                <div class="app-description" title="<?php echo e($theme->name); ?>">
                                    <?php echo e($theme->description); ?>

                                </div>
                                <div class="app-actions">
                                    <?php if($theme->is_activated == 1): ?>
                                        <button class="btn sm btn-success btn-trigger-change-status"
                                            data-theme="<?php echo e($theme->id); ?>"><?php echo e(translate('Active')); ?>

                                        </button>
                                    <?php else: ?>
                                        <button class="btn sm btn-info btn-trigger-change-status activate-theme"
                                            data-theme="<?php echo e($theme->id); ?>">
                                            <?php echo e(translate('Activate')); ?>

                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if(isTenant()): ?>
        <div class="app-items theme-items">
            <div class="row">
                <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-30">
                        <div class="app-item">
                            <div class="app-icon">
                                <img src="<?php echo e(asset('/themes' . '/' . $theme->location . '/banner.png')); ?>"
                                    alt="<?php echo e($theme->name); ?>" />
                            </div>
                            <div class="app-details">
                                <h4 class="app-name"><?php echo e(str_replace('TL', 'E-', $theme->name)); ?></h4>
                            </div>
                            <div class="app-footer">
                                <div class="app-actions">
                                    <?php if($theme->is_activated == 1): ?>
                                        <button class="btn sm btn-success btn-trigger-change-status"
                                            data-theme="<?php echo e($theme->id); ?>">
                                            <i class="icofont-ui-check"></i> <?php echo e(translate('Activated')); ?>

                                        </button>
                                    <?php else: ?>
                                        <button class="btn sm btn-info btn-trigger-change-status activate-theme"
                                            data-theme="<?php echo e($theme->id); ?>">
                                            <?php echo e(translate('Activate')); ?>

                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
    <!--Active Modal-->
    <div id="active-modal" class="delete-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6"><?php echo e(translate('activate Confirmation')); ?></h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1"><?php echo e(translate('Are you sure to active this theme')); ?>?</p>
                    <form method="POST" action="<?php echo e(route('core.themes.activate')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="active-theme-id" name="id">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal"><?php echo e(translate('cancel')); ?></button>
                        <button type="submit" class="btn long mt-2"><?php echo e(translate('Activate')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Active  Modal-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <script>
        /**
         * Activate theme
         * */
        $('.activate-theme').on('click', function(e) {
            "use strict";
            e.preventDefault();
            let $this = $(this);
            let id = $this.data('theme');
            $("#active-theme-id").val(id);
            $('#active-modal').modal('show');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::base.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/Core/Views/base/themes/index.blade.php ENDPATH**/ ?>