 <div class="card">
     <div class="card-body">
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black"><?php echo e(translate('Enable billing address')); ?>

                 </label>
             </div>
             <div class="col-sm-6">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_billing_address" <?php if(getEcommerceSetting('enable_billing_address') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label
                     class="font-14 bold black "><?php echo e(translate('Use the shipping address as the billing address by default')); ?>

                 </label>
             </div>
             <div class="cl-sm-1">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="use_shipping_address_as_billing_address" <?php if(getEcommerceSetting('use_shipping_address_as_billing_address') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black "><?php echo e(translate('Enable guest checkout')); ?>

                 </label>
             </div>
             <div class="col-sm-6">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_guest_checkout" <?php if(getEcommerceSetting('enable_guest_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>


         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black "><?php echo e(translate('Send invoice to customer email')); ?>

                 </label>
             </div>
             <div class="col-sm-1">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="send_invoice_to_customer_mail" <?php if(getEcommerceSetting('send_invoice_to_customer_mail') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
             <div class="col-sm-5">
                 <p class="mt-0 font-13">
                     <?php echo e(translate('Enable sending invoice to customer you need to complete email configuration and Cron Job setup')); ?>

                     <br>
                     <a href="<?php echo e(route('core.email.smtp.configuration')); ?>"
                         class="btn-link"><?php echo e(translate('Configure Email')); ?>

                     </a>
                 </p>
             </div>
         </div>
         <div class="form-row mb-20 <?php echo e(isActivePluging('coupon') ? '' : 'area-disabled mb-0'); ?>">
             <div class="col-sm-6">
                 <label class="font-14 bold black "><?php echo e(translate('Enable coupon in checkout')); ?>

                 </label>
             </div>
             <div class="col-sm-1">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_coupon_in_checkout" class="enable-coupon-in-checkout"
                         <?php if(getEcommerceSetting('enable_coupon_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
             <?php if(isActivePluging('coupon')): ?>
                 <div class="col-sm-5">
                     <p class="mt-0 font-13"><?php echo e(translate('You can manage your coupons from ')); ?>

                         <a href="<?php echo e(route('plugin.tlcommercecore.marketing.coupon.list')); ?>" class="btn-link">
                             Coupons Module
                         </a>
                     </p>
                 </div>
             <?php endif; ?>

         </div>
         <?php if(isActivePluging('coupon')): ?>
             <div
                 class="form-row mb-20 multiple-coupon-checkout <?php echo e(getEcommerceSetting('enable_coupon_in_checkout') == config('settings.general_status.active') ? '' : 'd-none'); ?>">
                 <div class="col-sm-6">
                     <label class="font-14 bold black "><?php echo e(translate('Enable multiple coupon in single order')); ?>

                     </label>
                 </div>
                 <div class="col-sm-6">
                     <label class="switch glow primary medium">
                         <input type="checkbox" name="enable_multiple_coupon_in_checkout" <?php if(getEcommerceSetting('enable_multiple_coupon_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                         <span class="control"></span>
                     </label>
                 </div>
             </div>
         <?php endif; ?>
         <!--Wallet-->
         <?php if(isActivePluging('wallet')): ?>
             <div class="form-row mb-20">
                 <div class="col-sm-6">
                     <label class="font-14 bold black "><?php echo e(translate('Enable wallet in checkout')); ?>

                     </label>
                 </div>
                 <div class="col-sm-6">
                     <label class="switch glow primary medium">
                         <input type="checkbox" name="enable_wallet_in_checkout" <?php if(getEcommerceSetting('enable_wallet_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                         <span class="control"></span>
                     </label>
                 </div>
             </div>
         <?php endif; ?>
         <!--End wallet-->
         <!--Order note-->
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black "><?php echo e(translate('Enable order note')); ?>

                 </label>
             </div>
             <div class="col-sm-6">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_order_note_in_checkout" <?php if(getEcommerceSetting('enable_order_note_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <!--End order note-->
         <!--Documents-->
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black "><?php echo e(translate('Enable document in checkout')); ?>

                 </label>
             </div>
             <div class="col-sm-6">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_document_in_checkout" <?php if(getEcommerceSetting('enable_document_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <!--End Documents-->
         <!--Carriers-->
         <div class="form-row mb-20 <?php echo e(isActivePluging('carrier') ? '' : 'area-disabled mb-0'); ?>">
             <div class="col-sm-6">
                 <label class="font-14 bold black "><?php echo e(translate('Enable carrier in checkout')); ?>

                 </label>
             </div>
             <div class="col-sm-1">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_carrier_in_checkout" <?php if(getEcommerceSetting('enable_carrier_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
             <?php if(isActivePluging('carrier')): ?>
                 <div class="col-sm-5">
                     <p class="mt-0 font-13"><?php echo e(translate('Manage your')); ?>

                         <a href="<?php echo e(route('plugin.carrier.list')); ?>" class="btn-link">3rd Party
                             Carriers
                         </a>
                     </p>
                 </div>
             <?php endif; ?>
         </div>
         <!--End carriers-->
         <!--Pickup points-->
         <div class="form-row mb-20 <?php echo e(isActivePluging('pickuppoint') ? '' : 'area-disabled mb-0'); ?>">
             <div class="col-sm-6">
                 <label class="font-14 bold black "><?php echo e(translate('Enable pickup point in checkout')); ?>

                 </label>
             </div>
             <div class="col-sm-1">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_pickuppoint_in_checkout" <?php if(getEcommerceSetting('enable_pickuppoint_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
             <?php if(isActivePluging('pickuppoint')): ?>
                 <div class="col-sm-5">
                     <p class="mt-0 font-13"><?php echo e(translate('Manage your')); ?>

                         <a href="<?php echo e(route('plugin.pickuppoint.pickup.points')); ?>" class="btn-link">
                             Pickup Points
                         </a>
                     </p>
                 </div>
             <?php endif; ?>
         </div>
         <?php if(!isActivePluging('pickuppoint')): ?>
             <div class="form-row mb-20">
                 <div class="col-12">
                     <p class="mt-0 font-13">
                         <?php echo e(translate('To enable pickup point you need to active')); ?>

                         <a href="<?php echo e(route('core.plugins.index')); ?>" class="btn-link">
                             Pickup Point Plugin
                         </a>
                     </p>
                 </div>
             </div>
         <?php endif; ?>
         <!--End Pickup points-->
         <!--Min order amount-->
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black "><?php echo e(translate('Enable minimum order amount')); ?>

                 </label>
             </div>
             <div class="col-sm-6">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_minumun_order_amount" class="enable-minumun-order-amount"
                         <?php if(getEcommerceSetting('enable_minumun_order_amount') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <div
             class="form-row mb-20 minimum-order-amount <?php echo e(getEcommerceSetting('enable_minumun_order_amount') == config('settings.general_status.active') ? '' : 'd-none'); ?>">
             <label class="font-14 bold black col-sm-6"><?php echo e(translate('Minimum order amount')); ?>

             </label>
             <input type="number" name="min_order_amount" value="<?php echo e(getEcommerceSetting('min_order_amount')); ?>"
                 class="theme-input-style col-sm-6" placeholder="0.00">
         </div>
         <!--End mi order amount-->
         <h4 class="mb-3">Checkout Form</h4>
         <div class="form-row mb-20">
             <div class="col-sm-4">
                 <label class="font-14 bold black ">
                     <?php echo e(translate('Name')); ?>

                 </label>
             </div>
             <div class="col-sm-4 align-items-center d-flex gap-10">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_name_in_checkout" <?php if(getEcommerceSetting('enable_name_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
                 <label class="font-14 bold black">Enable/ Disbale</label>
             </div>
             <div class="col-sm-4 align-items-center d-flex gap-10">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="name_required_in_checkout" <?php if(getEcommerceSetting('name_required_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
                 <label class="font-14 bold black">Required/ Optional</label>
             </div>
         </div>

         <div class="form-row mb-20">
             <div class="col-sm-4">
                 <label class="font-14 bold black ">
                     <?php echo e(translate('Email')); ?>

                 </label>
             </div>
             <div class="col-sm-4 align-items-center d-flex gap-10">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_email_in_checkout" <?php if(getEcommerceSetting('enable_email_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
                 <label class="font-14 bold black">Enable/ Disbale</label>
             </div>
             <div class="col-sm-4 align-items-center d-flex gap-10">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="email_required_in_checkout" <?php if(getEcommerceSetting('email_required_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
                 <label class="font-14 bold black">Required/ Optional</label>
             </div>
         </div>

         <div class="form-row mb-20">
             <div class="col-sm-4">
                 <label class="font-14 bold black ">
                     <?php echo e(translate('Phone')); ?>

                 </label>
             </div>
             <div class="col-sm-4 align-items-center d-flex gap-10">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_phone_in_checkout" <?php if(getEcommerceSetting('enable_phone_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
                 <label class="font-14 bold black">Enable/ Disbale</label>
             </div>
             <div class="col-sm-4 align-items-center d-flex gap-10">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="phone_required_in_checkout" <?php if(getEcommerceSetting('phone_required_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
                 <label class="font-14 bold black">Required/ Optional</label>
             </div>
         </div>

         <div class="form-row mb-20">
             <div class="col-sm-4">
                 <label class="font-14 bold black ">
                     <?php echo e(translate('Address')); ?>

                 </label>
             </div>
             <div class="col-sm-4 align-items-center d-flex gap-10">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_address_in_checkout" <?php if(getEcommerceSetting('enable_address_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
                 <label class="font-14 bold black">Enable/ Disbale</label>
             </div>
             <div class="col-sm-4 align-items-center d-flex gap-10">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="address_required_in_checkout" <?php if(getEcommerceSetting('address_required_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
                 <label class="font-14 bold black">Required/ Optional</label>
             </div>
         </div>

         <div class="form-row mb-20">
             <div class="col-sm-4">
                 <label class="font-14 bold black ">
                     <?php echo e(translate('Post Code')); ?>

                 </label>
             </div>
             <div class="col-sm-4 align-items-center d-flex gap-10">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_post_code_in_checkout" <?php if(getEcommerceSetting('enable_post_code_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
                 <label class="font-14 bold black">Enable/ Disbale</label>
             </div>
             <div class="col-sm-4 align-items-center d-flex gap-10">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="post_code_required_in_checkout" <?php if(getEcommerceSetting('post_code_required_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
                 <label class="font-14 bold black">Required/ Optional</label>
             </div>
         </div>

         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black "><?php echo e(translate('Enable personal information in guest checkout')); ?>

                 </label>
             </div>
             <div class="col-sm-6">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="enable_personal_info_guest_checkout" <?php if(getEcommerceSetting('enable_personal_info_guest_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black "><?php echo e(translate('Enable create account in guest checkout')); ?>

                 </label>
             </div>
             <div class="col-sm-5">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="create_account_in_guest_checkout" <?php if(getEcommerceSetting('create_account_in_guest_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
         </div>
         <div class="form-row mb-20">
             <div class="col-sm-6">
                 <label class="font-14 bold black ">
                     <?php echo e(translate('Hide Country, State and city dropdown in checkout')); ?>

                 </label>
             </div>
             <div class="col-sm-1">
                 <label class="switch glow primary medium">
                     <input type="checkbox" name="hide_country_state_city_in_checkout" <?php if(getEcommerceSetting('hide_country_state_city_in_checkout') == config('settings.general_status.active')): echo 'checked'; endif; ?>>
                     <span class="control"></span>
                 </label>
             </div>
             <div class="col-sm-5">
                 <p class="mt-0 font-13">
                     <?php echo e(translate('If you enable hide Country, State and city dropdown in checkout then you must select Flat rate shipping cost or Product wise shiping cost. Based on shipping profile not working')); ?>

                     <a href="<?php echo e(route('plugin.tlcommercecore.shipping.configuration')); ?>" class="btn-link">
                         <?php echo e(translate('Configure Shipping Options')); ?>

                     </a>
                 </p>
             </div>
         </div>
     </div>
 </div>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/ecommerce-settings/checkout.blade.php ENDPATH**/ ?>