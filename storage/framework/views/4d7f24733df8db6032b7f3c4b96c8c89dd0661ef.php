  <?php
      $settings_details = getGeneralSettingsDetails();
      $system_current_version = systemCurrentVersion();
  ?>
  <footer class="footer">
      <div class="d-flex footer-wraper justify-content-between pr-2 w-100">
          <p class="mb-0"><?php echo xss_clean($settings_details['copyright_text']); ?></p>
          <p class="mb-0">Version <?php echo e($system_current_version); ?></p>
      </div>
  </footer>
<?php /**PATH /var/www/tl-commerce-saas/tlcommercesaas/Core/Views/base/layouts/footer.blade.php ENDPATH**/ ?>