<footer class="site-footer">
    <div class="container footer-main">

        <div class="footer-brand">
            <a href="/" class="brand">
                <img src="{{ asset('images/fdp-logo.png') }}" alt="Future Digital Productions" class="footer-logo">
            </a>
            <p class="footer-tagline">Cinematic storytelling, delivered fast.</p>
            <address class="footer-contact">
                <a href="mailto:hello@futuredigitalproductions.com">hello@futuredigitalproductions.com</a>
                <a href="tel:+440000000000">+44 0000 000000</a>
            </address>
            <div class="footer-social">
                <a href="#" class="footer-social-link" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </a>
                <a href="#" class="footer-social-link" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                </a>
                <a href="#" class="footer-social-link" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"/>
                    </svg>
                </a>
            </div>
        </div>

        <nav class="footer-nav-group" aria-label="Services">
            <h4 class="footer-nav-heading">Services</h4>
            <ul class="footer-nav-list">
                <li><a href="/services/weddings">Weddings</a></li>
                <li><a href="/services/music-videos">Music Videos</a></li>
                <li><a href="/services/corporate">Corporate</a></li>
                <li><a href="/services/content-for-business">Content for Business</a></li>
                <li><a href="/services/vox-pops">Vox Pops</a></li>
                <li><a href="/services/events">Events</a></li>
            </ul>
        </nav>

        <nav class="footer-nav-group" aria-label="Company">
            <h4 class="footer-nav-heading">Company</h4>
            <ul class="footer-nav-list">
                <li><a href="/about">About</a></li>
                <li><a href="/portfolio">Portfolio</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/get-a-quote">Get a Quote</a></li>
                <li><a href="/privacy-policy">Privacy Policy</a></li>
            </ul>
        </nav>

    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>&copy; {{ date('Y') }} Future Digital Productions. All rights reserved.</p>
        </div>
    </div>
</footer>
