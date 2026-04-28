<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="help-sidebar">
    <h3>Quick Links</h3>
    <ul>
        <li><a href="help.php" style="<?php echo ($current_page == 'help.php') ? 'color: #e67e22; font-weight: bold;' : ''; ?>"><i class="fa-solid fa-circle-question"></i> Help Center (FAQs)</a></li>
        <li><a href="shipping.php" style="<?php echo ($current_page == 'shipping.php') ? 'color: #e67e22; font-weight: bold;' : ''; ?>"><i class="fa-solid fa-truck"></i> Shipping Policy</a></li>
        <li><a href="cancellations.php" style="<?php echo ($current_page == 'cancellations.php') ? 'color: #e67e22; font-weight: bold;' : ''; ?>"><i class="fa-solid fa-rotate-left"></i> Cancellations & Refunds</a></li>
        <li><a href="terms.php" style="<?php echo ($current_page == 'terms.php') ? 'color: #e67e22; font-weight: bold;' : ''; ?>"><i class="fa-solid fa-file-contract"></i> Terms & Conditions</a></li>
        <li><a href="contact.php" style="<?php echo ($current_page == 'contact.php') ? 'color: #e67e22; font-weight: bold;' : ''; ?>"><i class="fa-solid fa-headset"></i> Contact Us</a></li>
        <li><a href="profile.php?tab=orders"><i class="fa-solid fa-box-open"></i> Track My Order</a></li>
    </ul>
</div>
