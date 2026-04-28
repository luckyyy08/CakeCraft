<link rel="stylesheet" href="assets/css/footer.css">

<footer class="premium-footer">
    <div class="footer-container">
        
        <!-- About Section -->
        <div class="footer-col" style="flex: 1.5;">
            <h4><i class="fa-solid fa-cake-candles" style="color: #749343; margin-right: 8px;"></i> CakeCraft</h4>
            <p>CakeCraft is Nashik's premier destination for exquisite cakes, stunning floral arrangements, and curated gift hampers. We blend artistry with the finest ingredients to craft unforgettable moments for every celebration.</p>
            
            <div class="social-icons-premium">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="footer-col">
            <h4>Customer Support</h4>
            <ul class="footer-links">
                <li><a href="help.php">Help Center (FAQs)</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="shipping.php">Shipping & Delivery</a></li>
                <li><a href="cancellations.php">Return & Refunds</a></li>
                <li><a href="terms.php">Terms & Conditions</a></li>
            </ul>
        </div>

        <!-- Contact & Newsletter -->
        <div class="footer-col" style="flex: 1.5;">
            <h4>Get In Touch</h4>
            
            <div class="contact-info">
                <i class="fa-solid fa-location-dot"></i>
                <span>123 Bakery Lane, College Road,<br>Nashik, Maharashtra 422005</span>
            </div>
            <div class="contact-info">
                <i class="fa-solid fa-phone"></i>
                <span>+91 98765 43210<br><small style="color:#888;">(9:00 AM - 9:00 PM)</small></span>
            </div>
            <div class="contact-info">
                <i class="fa-solid fa-envelope"></i>
                <span>support@cakecraft.com</span>
            </div>

            <div class="newsletter-box">
                <h5 style="color: #fff; font-size: 14px; margin-bottom: 10px; font-weight: 500;">Subscribe for Offers!</h5>
                <form class="newsletter-input" onsubmit="event.preventDefault(); alert('Thank you for subscribing to CakeCraft!');">
                    <input type="email" placeholder="Enter your email address" required>
                    <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bottom Footer -->
    <div class="footer-bottom">
        <div class="footer-bottom-content">
            <div class="copyright">
                &copy; <?php echo date("Y"); ?> CakeCraft. All rights reserved. | Handcrafted with <i class="fa-solid fa-heart" style="color: #d81b60;"></i> in Nashik.
            </div>
            <div class="payment-icons">
                <i class="fa-brands fa-cc-visa" title="Visa"></i>
                <i class="fa-brands fa-cc-mastercard" title="MasterCard"></i>
                <i class="fa-brands fa-cc-paypal" title="PayPal"></i>
                <i class="fa-brands fa-cc-apple-pay" title="Apple Pay"></i>
                <i class="fa-brands fa-google-pay" title="Google Pay"></i>
            </div>
        </div>
    </div>
</footer>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if(isset($_SESSION['status']) && $_SESSION['status'] != ''): ?>
            Swal.fire({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            <?php 
                unset($_SESSION['status']);
                unset($_SESSION['status_code']);
            ?>
        <?php endif; ?>
    });
</script>