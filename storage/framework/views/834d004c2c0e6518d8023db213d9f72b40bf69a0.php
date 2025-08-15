 <div class="card">
     <div class="card-body">
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black"><?php echo e(translate('New Order Email Notification')); ?>

                 </label>
             </div>
             <div class="col-sm-6">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="admin_new_order_email_notification" <?php if(getEcommerceSetting('admin_new_order_email_notification') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black"><?php echo e(translate('Order Refund Email Notification')); ?>

                 </label>
             </div>
             <div class="col-sm-6">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="admin_order_refund_email_notification" <?php if(getEcommerceSetting('admin_order_refund_email_notification') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black"><?php echo e(translate('Order Cancel Email Notification')); ?>

                 </label>
             </div>
             <div class="col-sm-6">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="admin_order_cancel_email_notification" <?php if(getEcommerceSetting('admin_order_cancel_email_notification') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black"><?php echo e(translate('Product Review Email Notification')); ?>

                 </label>
             </div>
             <div class="col-sm-6">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="admin_product_review_email_notification" <?php if(getEcommerceSetting('admin_product_review_email_notification') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <?php if(isActivePluging('wallet')): ?>
             <div class="form-row mb-20">
                 <div class="col-sm-6">
                     <label class="font-14 bold black"><?php echo e(translate('Wallet Recharge Email Notification')); ?>

                     </label>
                 </div>
                 <div class="col-sm-6">
                     <label class="switch glow primary medium">
                         <input type="checkbox" name="admin_wallet_recharge_email_notification"
                             <?php if(getEcommerceSetting('admin_wallet_recharge_email_notification') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                         <span class="control"></span>
                     </label>
                 </div>
             </div>
             <div class="form-row mb-20">
                 <div class="col-12">
                     <h5 class="text text-danger mb-2"><?php echo e(translate('Note')); ?></h5>
                     <p class="mt-0 font-13">
                         <?php echo e(translate('Enable  email notification you need to complete email configuration and Cron Job setup')); ?>

                         <br>
                         <a href="<?php echo e(route('core.email.smtp.configuration')); ?>"
                             class="btn-link"><?php echo e(translate('Configure Email')); ?>

                         </a>
                     </p>
                 </div>
             </div>
         <?php endif; ?>
     </div>
 </div>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/ecommerce-settings/email-notification.blade.php ENDPATH**/ ?>