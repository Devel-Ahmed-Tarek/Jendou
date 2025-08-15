 <?php
     //pickup order from  plugin
     $isactivatePickupPoint = isActivePluging('pickuppoint');
     $order_pickup_point_active_link_file_links = [];
     $order_pickup_point_active_link_file =
         base_path() . '/plugins/pickuppoint/views/includes/submenu/order_active_link.json';
     if (file_exists($order_pickup_point_active_link_file)) {
         $order_pickup_point_active_link_file_links = json_decode(
             file_get_contents($order_pickup_point_active_link_file),
             true,
         );
     }
     $isactivateMultivendor = isActivePluging('multivendor');
     //Seller Products from  plugin
     $seller_products_active_link_file_links = [];
     $seller_products_active_link_file =
         base_path() . '/plugins/multivendor/views/includes/submenu/products_active_link.json';
     if (file_exists($seller_products_active_link_file)) {
         $seller_products_active_link_file_links = json_decode(
             file_get_contents($seller_products_active_link_file),
             true,
         );
     }
     //Seller order from  plugin
     $order_seller_active_link_file_links = [];
     $order_seller_active_link_file =
         base_path() . '/plugins/multivendor/views/includes/submenu/order_active_link.json';
     if (file_exists($order_seller_active_link_file)) {
         $order_seller_active_link_file_links = json_decode(file_get_contents($order_seller_active_link_file), true);
     }
 ?>
 <!--Products Module-->
 <?php if(auth()->user()->can('Manage Add New Product') ||
         auth()->user()->can('Manage Inhouse Products') ||
         auth()->user()->can('Manage Colors') ||
         auth()->user()->can('Manage Brands') ||
         auth()->user()->can('Manage Categories') ||
         auth()->user()->can('Manage Attributes') ||
         auth()->user()->can('Manage Units') ||
         auth()->user()->can('Manage Product Reviews') ||
         auth()->user()->can('Manage Product collections') ||
         auth()->user()->can('Manage Product Tags') ||
         auth()->user()->can('Manage Product Conditions')): ?>
     <li
         class="<?php echo e(Request::routeIs($seller_products_active_link_file_links, ['plugin.tlcommercecore.product.reviews.list','plugin.tlcommercecore.product.collection.products','plugin.tlcommercecore.product.collection.edit','plugin.tlcommercecore.product.collection.add.new','plugin.tlcommercecore.product.collection.list','plugin.tlcommercecore.product.edit','plugin.tlcommercecore.product.list','plugin.tlcommercecore.product.add.new','plugin.tlcommercecore.product.units.edit','plugin.tlcommercecore.product.attributes.values.edit','plugin.tlcommercecore.product.attributes.values','plugin.tlcommercecore.product.attributes.edit','plugin.tlcommercecore.product.attributes.add','plugin.tlcommercecore.product.attributes.list','plugin.tlcommercecore.product.tags.edit','plugin.tlcommercecore.product.tags.add.new','plugin.tlcommercecore.product.tags.list','plugin.tlcommercecore.product.conditions.edit','plugin.tlcommercecore.product.conditions.new','plugin.tlcommercecore.product.conditions.list','plugin.tlcommercecore.product.units.new','plugin.tlcommercecore.product.units.list','plugin.tlcommercecore.product.colors.edit','plugin.tlcommercecore.product.colors.list','plugin.tlcommercecore.product.colors.new','plugin.tlcommercecore.product.brand.edit','plugin.tlcommercecore.product.brand.new','plugin.tlcommercecore.product.category.list','plugin.tlcommercecore.product.category.new','plugin.tlcommercecore.product.category.edit','plugin.tlcommercecore.product.brand.list'])? 'active sub-menu-opened': ''); ?>">
         <a href="#">
             <i class="icofont-bucket1"></i>
             <span class="link-title"> <?php echo e(translate('Products')); ?></span>
         </a>
         <ul class="nav sub-menu">
             <?php if(auth()->user()->can('Manage Add New Product')): ?>
                 <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.add.new']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.product.add.new')); ?>"><?php echo e(translate('Add New Product')); ?></a>
                 </li>
             <?php endif; ?>
             <?php if(auth()->user()->can('Manage Inhouse Products')): ?>
                 <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.list']) ? 'active ' : ''); ?>">
                     <a href="<?php echo e(route('plugin.tlcommercecore.product.list')); ?>">
                         <?php if($isactivateMultivendor): ?>
                             <?php echo e(translate('Inhouse Products')); ?>

                         <?php else: ?>
                             <?php echo e(translate('All Products')); ?>

                         <?php endif; ?>
                     </a>
                 </li>
                 <?php if($isactivateMultivendor): ?>
                     <?php if ($__env->exists('plugin/multivendor::includes.submenu.products')) echo $__env->make('plugin/multivendor::includes.submenu.products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <?php endif; ?>
             <?php endif; ?>
             <?php if(auth()->user()->can('Manage Colors')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.colors.edit', 'plugin.tlcommercecore.product.colors.list', 'plugin.tlcommercecore.product.colors.new']) ? 'active ' : ''); ?>">
                     <a href="<?php echo e(route('plugin.tlcommercecore.product.colors.list')); ?>"><?php echo e(translate('Colors')); ?></a>
                 </li>
             <?php endif; ?>
             <?php if(auth()->user()->can('Manage Brands')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.brand.edit', 'plugin.tlcommercecore.product.brand.list', 'plugin.tlcommercecore.product.brand.new']) ? 'active ' : ''); ?>">
                     <a href="<?php echo e(route('plugin.tlcommercecore.product.brand.list')); ?>"><?php echo e(translate('Brands')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Categories')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.category.list', 'plugin.tlcommercecore.product.category.new', 'plugin.tlcommercecore.product.category.edit']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.product.category.list')); ?>"><?php echo e(translate('Categories')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Attributes')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.attributes.values.edit', 'plugin.tlcommercecore.product.attributes.values', 'plugin.tlcommercecore.product.attributes.edit', 'plugin.tlcommercecore.product.attributes.add', 'plugin.tlcommercecore.product.attributes.list']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.product.attributes.list')); ?>"><?php echo e(translate('Attributes')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Units')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.units.edit', 'plugin.tlcommercecore.product.units.new', 'plugin.tlcommercecore.product.units.list']) ? 'active ' : ''); ?>">
                     <a href="<?php echo e(route('plugin.tlcommercecore.product.units.list')); ?>"><?php echo e(translate('Units')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Product Reviews')): ?>
                 <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.reviews.list']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.product.reviews.list')); ?>"><?php echo e(translate('Product Reviews')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Product collections')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.collection.list']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.product.collection.list')); ?>"><?php echo e(translate('Product collections')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Product Tags')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.tags.edit', 'plugin.tlcommercecore.product.tags.add.new', 'plugin.tlcommercecore.product.tags.list']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.product.tags.list')); ?>"><?php echo e(translate('Product Tags')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Product conditions')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.product.conditions.edit', 'plugin.tlcommercecore.product.conditions.new', 'plugin.tlcommercecore.product.conditions.list']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.product.conditions.list')); ?>"><?php echo e(translate('Product conditions')); ?></a>
                 </li>
             <?php endif; ?>
         </ul>
     </li>
 <?php endif; ?>

 <!--End Products Module-->
 <!--Orders Module-->
 <?php if(auth()->user()->can('Manage Inhouse Orders') || auth()->user()->can('Manage Pickup Point Order')): ?>
     <li
         class="<?php echo e(Request::routeIs($order_pickup_point_active_link_file_links, $order_seller_active_link_file_links, ['plugin.tlcommercecore.orders.details', 'plugin.tlcommercecore.orders.inhouse']) ? 'active sub-menu-opened' : ''); ?>">
         <a href="#">
             <i class="icofont-cart"></i>
             <span class="link-title"><?php echo e(translate('Orders')); ?></span>
         </a>
         <ul class="nav sub-menu">
             <?php if(auth()->user()->can('Manage Inhouse Orders')): ?>
                 <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.orders.inhouse']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.orders.inhouse')); ?>"><?php echo e(translate('Inhouse Orders')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if($isactivateMultivendor): ?>
                 <?php if ($__env->exists('plugin/multivendor::includes.submenu.order')) echo $__env->make('plugin/multivendor::includes.submenu.order', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <?php endif; ?>
             <?php if($isactivatePickupPoint): ?>
                 <?php if ($__env->exists('plugin/pickuppoint::includes.submenu.order')) echo $__env->make('plugin/pickuppoint::includes.submenu.order', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <?php endif; ?>

         </ul>
     </li>
 <?php endif; ?>

 <!--End Orders Module-->

 <?php if(auth()->user()->can('Manage Customers')): ?>
     <!--Customer Module-->
     <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.customers.list']) ? 'active' : ''); ?>">
         <a href="<?php echo e(route('plugin.tlcommercecore.customers.list')); ?>">
             <i class="icofont-users-alt-4"></i>
             <span class="link-title"><?php echo e(translate('Customers')); ?></span>
         </a>

     </li>
     <!--End Customer module-->
 <?php endif; ?>

 <!--Shippings Module-->
 <?php
     //carrier  plugin
     $isactivateCarrier = isActivePluging('carrier');
     $shipping_carrier_active_link_file_links = [];
     $shipping_carrier_active_link_file =
         base_path() . '/plugins/carrier/views/includes/submenu/shipping_active_link.json';
     if (file_exists($shipping_carrier_active_link_file)) {
         $shipping_carrier_active_link_file_links = json_decode(
             file_get_contents($shipping_carrier_active_link_file),
             true,
         );
     }
     //pickup  plugin
     $isactivatePickupPoint = isActivePluging('pickuppoint');
     $shipping_pickup_point_active_link_file_links = [];
     $shipping_pickup_point_active_link_file =
         base_path() . '/plugins/pickuppoint/views/includes/submenu/shipping_active_link.json';
     if (file_exists($shipping_pickup_point_active_link_file)) {
         $shipping_pickup_point_active_link_file_links = json_decode(
             file_get_contents($shipping_pickup_point_active_link_file),
             true,
         );
     }
     //delivery boy plugun
     $isactivateDeliveryBoy = isActivePluging('deliveryboy');
     $shipping_delivery_boy_active_link_file_links = [];
     $shipping_delivery_boy_active_link_file =
         base_path() . '/plugins/deliveryboy/views/includes/submenu/shipping_active_link.json';
     if (file_exists($shipping_delivery_boy_active_link_file)) {
         $shipping_delivery_boy_active_link_file_links = json_decode(
             file_get_contents($shipping_delivery_boy_active_link_file),
             true,
         );
     }
 ?>

 <?php if(auth()->user()->can('Manage Shipping & Delivery') ||
         auth()->user()->can('Manage Pickup Points') ||
         auth()->user()->can('Manage Carriers') ||
         auth()->user()->can('Manage Locations')): ?>

     <li
         class="<?php echo e(Request::routeIs($shipping_carrier_active_link_file_links, $shipping_delivery_boy_active_link_file_links, $shipping_pickup_point_active_link_file_links, ['plugin.tlcommercecore.shipping.profile.manage', 'plugin.tlcommercecore.shipping.profile.form', 'plugin.tlcommercecore.shipping.configuration', 'plugin.tlcommercecore.shipping.locations.cities.edit', 'plugin.tlcommercecore.shipping.locations.cities.add.new', 'plugin.tlcommercecore.shipping.locations.cities.list', 'plugin.tlcommercecore.shipping.locations.states.edit', 'plugin.tlcommercecore.shipping.locations.states.new.add', 'plugin.tlcommercecore.shipping.locations.states.list', 'plugin.tlcommercecore.shipping.locations.country.edit', 'plugin.tlcommercecore.shipping.locations.country.new', 'plugin.tlcommercecore.shipping.locations.country.list']) ? 'active sub-menu-opened' : ''); ?>">
         <a href="#">
             <i class="icofont-ship"></i>
             <span class="link-title"><?php echo e(translate('Shippings')); ?></span>
         </a>
         <ul class="nav sub-menu">
             <?php if(auth()->user()->can('Manage Shipping & Delivery')): ?>
                 <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.shipping.configuration']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.shipping.configuration')); ?>"><?php echo e(translate('Shipping & Delivery')); ?></a>
                 </li>
             <?php endif; ?>


             <?php if($isactivatePickupPoint): ?>
                 <?php if(auth()->user()->can('Manage Pickup Points')): ?>
                     <?php if ($__env->exists('plugin/pickuppoint::includes.submenu.shipping')) echo $__env->make('plugin/pickuppoint::includes.submenu.shipping', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <?php endif; ?>
             <?php endif; ?>

             <?php if($isactivateCarrier): ?>
                 <?php if(auth()->user()->can('Manage Carriers')): ?>
                     <?php if ($__env->exists('plugin/carrier::includes.submenu.shipping')) echo $__env->make('plugin/carrier::includes.submenu.shipping', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <?php endif; ?>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Locations')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.shipping.locations.cities.edit', 'plugin.tlcommercecore.shipping.locations.cities.add.new', 'plugin.tlcommercecore.shipping.locations.cities.list', 'plugin.tlcommercecore.shipping.locations.states.edit', 'plugin.tlcommercecore.shipping.locations.states.new.add', 'plugin.tlcommercecore.shipping.locations.states.list', 'plugin.tlcommercecore.shipping.locations.country.edit', 'plugin.tlcommercecore.shipping.locations.country.new', 'plugin.tlcommercecore.shipping.locations.country.list']) ? 'active sub-menu-opened' : ''); ?>">
                     <a href="<?php echo e(route('core.languages')); ?>"><?php echo e(translate('Locations')); ?></a>
                     <ul class="nav sub-menu">
                         <li
                             class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.shipping.locations.country.edit', 'plugin.tlcommercecore.shipping.locations.country.new', 'plugin.tlcommercecore.shipping.locations.country.list']) ? 'active ' : ''); ?>">
                             <a
                                 href="<?php echo e(route('plugin.tlcommercecore.shipping.locations.country.list')); ?>"><?php echo e(translate('Countries')); ?></a>
                         </li>
                         <li
                             class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.shipping.locations.states.edit', 'plugin.tlcommercecore.shipping.locations.states.new.add', 'plugin.tlcommercecore.shipping.locations.states.list']) ? 'active ' : ''); ?>">
                             <a
                                 href="<?php echo e(route('plugin.tlcommercecore.shipping.locations.states.list')); ?>"><?php echo e(translate('States')); ?></a>
                         </li>
                         <li
                             class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.shipping.locations.cities.edit', 'plugin.tlcommercecore.shipping.locations.cities.add.new', 'plugin.tlcommercecore.shipping.locations.cities.list']) ? 'active ' : ''); ?>">
                             <a
                                 href="<?php echo e(route('plugin.tlcommercecore.shipping.locations.cities.list')); ?>"><?php echo e(translate('Cities')); ?></a>
                         </li>
                     </ul>
                 </li>
             <?php endif; ?>
         </ul>
     </li>
 <?php endif; ?>

 <!--End Shippings Module-->



 <!--Payments Module-->
 <?php if(auth()->user()->can('Manage Payment Methods') || auth()->user()->can('Manage Transaction history')): ?>
     <li
         class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.payments.methods', 'plugin.tlcommercecore.payments.transactions.history']) ? 'active sub-menu-opened' : ''); ?>">
         <a href="#">
             <i class="icofont-money"></i>
             <span class="link-title"><?php echo e(translate('Payments')); ?></span>
         </a>
         <ul class="nav sub-menu">
             <?php if(auth()->user()->can('Manage Payment Methods')): ?>
                 <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.payments.methods']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.payments.methods')); ?>"><?php echo e(translate('Payment Methods')); ?></a>
                 </li>
             <?php endif; ?>
             <?php if(auth()->user()->can('Manage Transaction history')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.payments.transactions.history']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.payments.transactions.history')); ?>"><?php echo e(translate('Transaction history')); ?></a>
                 </li>
             <?php endif; ?>
         </ul>
     </li>
 <?php endif; ?>
 <!--End Payments Module-->


 <!--Marketings Module-->
 <?php
     //flashdeal plugin
     $isactivateFlashdeal = isActivePluging('flashdeal');
     $marketing_active_link_file_links = [];
     $marketing_active_link_file = base_path() . '/plugins/flashdeal/views/includes/submenu/marketing_active_link.json';
     if (file_exists($marketing_active_link_file)) {
         $marketing_active_link_file_links = json_decode(file_get_contents($marketing_active_link_file), true);
     }
     //coupon plugin
     $isactivateCoupon = isActivePluging('coupon');
     $marketing_coupon_active_link_file_links = [];
     $marketing_coupon_active_link_file =
         base_path() . '/plugins/coupon/views/includes/submenu/marketing_active_link.json';
     if (file_exists($marketing_coupon_active_link_file)) {
         $marketing_coupon_active_link_file_links = json_decode(
             file_get_contents($marketing_coupon_active_link_file),
             true,
         );
     }
 ?>
 <?php if(auth()->user()->can('Manage Flash Deals') ||
         auth()->user()->can('Manage Coupons') ||
         auth()->user()->can('Manage Custom notification')): ?>
     <li
         class="<?php echo e(Request::routeIs($marketing_coupon_active_link_file_links, $marketing_active_link_file_links, ['plugin.tlcommercecore.marketing.custom.notification', 'plugin.tlcommercecore.marketing.custom.notification.create.new']) ? 'active sub-menu-opened' : ''); ?>">
         <a href="#">
             <i class="icofont-megaphone"></i>
             <span class="link-title"><?php echo e(translate('Marketing')); ?></span>
         </a>
         <ul class="nav sub-menu">
             <?php if($isactivateFlashdeal): ?>
                 <?php if ($__env->exists('plugin/flashdeal::includes.submenu.marketing')) echo $__env->make('plugin/flashdeal::includes.submenu.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <?php endif; ?>
             <?php if($isactivateCoupon): ?>
                 <?php if ($__env->exists('plugin/coupon::includes.submenu.marketing')) echo $__env->make('plugin/coupon::includes.submenu.marketing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <?php endif; ?>
             <?php if(auth()->user()->can('Manage Custom notification')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.marketing.custom.notification', 'plugin.tlcommercecore.marketing.custom.notification.create.new']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.marketing.custom.notification')); ?>"><?php echo e(translate('Custom Notification')); ?></a>
                 </li>
             <?php endif; ?>
         </ul>
     </li>
 <?php endif; ?>
 <!--End Marketings Module-->
 <!--Report Module-->
 <?php if(auth()->user()->can('Manage Product Reports') ||
         auth()->user()->can('Manage Keyword Search Reports') ||
         auth()->user()->can('Manage Wishlist Reports')): ?>
     <li
         class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.reports.search.keyword', 'plugin.tlcommercecore.reports.products.wishlist', 'plugin.tlcommercecore.reports.products']) ? 'active sub-menu-opened' : ''); ?>">
         <a href="#">
             <i class="icofont-list"></i>
             <span class="link-title"><?php echo e(translate('Reports')); ?></span>
         </a>
         <ul class="nav sub-menu">
             <?php if(auth()->user()->can('Manage Product Reports')): ?>
                 <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.reports.products']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.reports.products')); ?>"><?php echo e(translate('Product Reports')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Keyword Search Reports')): ?>
                 <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.reports.search.keyword']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.reports.search.keyword')); ?>"><?php echo e(translate('Keyword Search Reports')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Wishlist Reports')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.reports.products.wishlist']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.reports.products.wishlist')); ?>"><?php echo e(translate('Wishlist Reports')); ?></a>
                 </li>
             <?php endif; ?>
         </ul>
     </li>
 <?php endif; ?>
 <!--End Report Module-->

 <!--Ecommerce Settings Module-->
 <?php if(auth()->user()->can('Manage Taxes') ||
         auth()->user()->can('Manage Settings') ||
         auth()->user()->can('Manage Currencies') ||
         auth()->user()->can('Manage Product Share Options')): ?>
     <li
         class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.ecommerce.edit.currency', 'plugin.tlcommercecore.ecommerce.add.currency', 'plugin.tlcommercecore.ecommerce.all.currencies', 'plugin.tlcommercecore.ecommerce.configuration', 'plugin.tlcommercecore.ecommerce.settings.taxes.manage.rates', 'plugin.tlcommercecore.products.share.options', 'plugin.tlcommercecore.ecommerce.settings.taxes.list']) ? 'active sub-menu-opened' : ''); ?>">
         <a href="#">
             <i class="icofont-interface"></i>
             <span class="link-title"><?php echo e(translate('Ecommerce Settings')); ?></span>
         </a>
         <ul class="nav sub-menu">
             <?php if(auth()->user()->can('Manage Settings')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.ecommerce.configuration']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.ecommerce.configuration')); ?>"><?php echo e(translate('Settings')); ?></a>
                 </li>
             <?php endif; ?>
             <?php if(auth()->user()->can('Manage Currencies')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.ecommerce.all.currencies']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.ecommerce.all.currencies')); ?>"><?php echo e(translate('Currencies')); ?></a>
                 </li>
             <?php endif; ?>

             <?php if(auth()->user()->can('Manage Product Share Options')): ?>
                 <li class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.products.share.options']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.products.share.options')); ?>"><?php echo e(translate('Product Share Options')); ?></a>
                 </li>
             <?php endif; ?>
             <?php if(auth()->user()->can('Manage Taxes')): ?>
                 <li
                     class="<?php echo e(Request::routeIs(['plugin.tlcommercecore.ecommerce.settings.taxes.manage.rates', 'plugin.tlcommercecore.ecommerce.settings.taxes.list']) ? 'active ' : ''); ?>">
                     <a
                         href="<?php echo e(route('plugin.tlcommercecore.ecommerce.settings.taxes.list')); ?>"><?php echo e(translate('Tax')); ?></a>
                 </li>
             <?php endif; ?>
         </ul>
     </li>
 <?php endif; ?>
 <!--End Ecommerce Settings Module-->
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/tlecommercecore/views/includes/navbar.blade.php ENDPATH**/ ?>