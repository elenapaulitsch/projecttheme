
  </div><!-- #content -->

  <footer id="colophon" class="site-footer">
    <div class="footer-content container-lg">
      <div class="footer-social-column">
        <div class="footer-branding">
          <?php
          $one_page = get_page_by_path( 'samsa' );
          $footer_logo_url = $one_page ? get_permalink( $one_page ) . '#hero-basic' : home_url( '/#hero-basic' );
          get_template_part( 'template-parts/components/logo', null, array( 'url' => $footer_logo_url ) );
          ?>
        </div>
        <div class="footer-socials" aria-label="<?php esc_attr_e( 'Social media', 'textdomaintomodify' ); ?>">
          <span class="footer-social-icon" role="img" aria-label="X">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4l14 16M19 4L5 20" /></svg>
          </span>
          <span class="footer-social-icon" role="img" aria-label="Instagram">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <rect x="3.5" y="3.5" width="17" height="17" rx="5" />
              <circle cx="12" cy="12" r="4" />
              <circle class="footer-social-dot" cx="17.5" cy="6.5" r="1" />
            </svg>
          </span>
          <span class="footer-social-icon" role="img" aria-label="YouTube">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <rect x="2.5" y="5" width="19" height="14" rx="4" />
              <path class="footer-social-play" d="M10 9l5 3-5 3z" />
            </svg>
          </span>
          <span class="footer-social-icon" role="img" aria-label="LinkedIn">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <text x="3" y="19">in</text>
            </svg>
          </span>
        </div>
      </div>

      <div class="footer-contact" id="kontakte">
        <h2><?php esc_html_e( 'Kontakte', 'textdomaintomodify' ); ?></h2>
        <address>
          <p>Graßnitzberg 23, 8432</p>
          <p><a href="tel:+4366434589404">+43 664 34589404</a></p>
          <p><a href="mailto:samsa@gmail.com">samsa@gmail.com</a></p>
        </address>
      </div>

      <nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer menu', 'textdomaintomodify' ); ?>">
        <h2><?php esc_html_e( 'Menü', 'textdomaintomodify' ); ?></h2>
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'menu-main',
            'menu_id'        => 'footer-menu',
            'menu_class'     => 'footer-menu',
            'container'      => false,
          )
        );
        ?>
      </nav>
    </div>
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
