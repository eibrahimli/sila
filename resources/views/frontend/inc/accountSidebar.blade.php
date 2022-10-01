<aside id="sidebarContent" class="u-sidebar u-sidebar__lg" aria-labelledby="sidebarNavToggler">
  <div class="u-sidebar__scroller">
    <div class="u-sidebar__container">
      <div class="js-scrollbar u-header-sidebar__footer-offset pb-3">
        <!-- Toggle Button -->
        <div class="d-flex align-items-center pt-4 px-7">
          <button type="button" class="close ml-auto" aria-controls="sidebarContent" aria-haspopup="true"
                  aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false"
                  data-unfold-target="#sidebarContent" data-unfold-type="css-animation"
                  data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight"
                  data-unfold-duration="500">
            <i class="ec ec-close-remove"></i>
          </button>
        </div>
        <!-- End Toggle Button -->

        <!-- Content -->
        <div class="js-scrollbar u-sidebar__body">
          <div class="u-sidebar__content u-header-sidebar__content">
            <!-- Login -->            
            <sign-in google_redirect_url="{{ route('auth.google.redirect') }}" facebook_redirect_url="{{ route('auth.facebook.redirect') }}"></sign-in>
            <!-- Signup -->
            <sign-up></sign-up>
            <!-- End Signup -->
            <!-- Forgot Password -->
            <email></email>
            <!-- End Forgot Password -->
          </div>
        </div>
        <!-- End Content -->
      </div>
    </div>
  </div>
</aside>
