 <div class="card">
     <div class="card-body">
         <?php if(!isTenant() && !isActivePluging('wallet')): ?>
             <p class="mt-0 font-13"><?php echo e(translate('You need to active or install')); ?> <a
                     href="<?php echo e(route('core.plugins.index')); ?>" class="btn-link">Wallet Plugin</a>
                 <?php echo e(translate('to manage wallets')); ?></p>
         <?php endif; ?>
         <div class="<?php echo e(isActivePluging('wallet') ? '' : 'area-disabled mb-0'); ?>">
             <div class="form-row mb-20">
                 <div class="col-sm-6">
                     <label class="font-14 bold black"><?php echo e(translate('Enable online recharge')); ?>

                     </label>
                 </div>
                 <div class="col-sm-6">
                     <label class="switch glow primary medium">
                         <input type="checkbox" name="enable_wallet_online_recharge" <?php if(getEcommerceSetting('enable_wallet_online_recharge') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                         <span class="control"></span>
                     </label>
                 </div>
             </div>
             <div class="form-row mb-20">
                 <div class="col-sm-6">
                     <label class="font-14 bold black"><?php echo e(translate('Enable offline recharge')); ?>

                     </label>
                 </div>
                 <div class="col-sm-6">
                     <label class="switch glow primary medium">
                         <input type="checkbox" name="enable_wallet_offline_recharge" <?php if(getEcommerceSetting('enable_wallet_offline_recharge') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                         <span class="control"></span>
                     </label>
                 </div>
             </div>
             <div class="form-row mb-20">
                 <div class="col-sm-6">
                     <label class="font-14 bold black"><?php echo e(translate('Minimum recharge amount')); ?>

                     </label>
                 </div>
                 <div class="col-sm-3">
                     <input type="number" class="theme-input-style" name="minimum_wallet_recharge_amount"
                         value="<?php echo e(getEcommerceSetting('minimum_wallet_recharge_amount')); ?>">
                 </div>
             </div>
         </div>

     </div>
 </div>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/ecommerce-settings/wallet.blade.php ENDPATH**/ ?>