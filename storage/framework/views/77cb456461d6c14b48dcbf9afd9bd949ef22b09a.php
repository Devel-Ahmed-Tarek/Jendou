<!--Wallet Module-->
<?php if(auth()->user()->can('Manage Offline Payment Methods') || auth()->user()->can('Manage Wallet Transactions')): ?>
    <li
        class="<?php echo e(Request::routeIs(['plugin.wallet.recharge.offline.payment.methods', 'plugin.wallet.configuration', 'plugin.wallet.transaction.list']) ? 'active sub-menu-opened' : ''); ?>">
        <a href="#">
            <i class="icofont-wallet"></i>
            <span class="link-title"><?php echo e(translate('Wallet')); ?></span>
        </a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage Wallet Transactions', 'Manage Offline Payment Methods'])): ?>
            <ul class="nav sub-menu">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Wallet Transactions')): ?>
                    <li class="<?php echo e(Request::routeIs(['plugin.wallet.transaction.list']) ? 'active ' : ''); ?>">
                        <a href="<?php echo e(route('plugin.wallet.transaction.list')); ?>"><?php echo e(translate('Wallet Transactions')); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Offline Payment Methods')): ?>
                    <li class="<?php echo e(Request::routeIs(['plugin.wallet.recharge.offline.payment.methods']) ? 'active ' : ''); ?>">
                        <a
                            href="<?php echo e(route('plugin.wallet.recharge.offline.payment.methods')); ?>"><?php echo e(translate('Offline Payment Methods')); ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    </li>
<?php endif; ?>
<!--End Wallet Module-->
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/plugins/wallet/views/includes/navbar.blade.php ENDPATH**/ ?>