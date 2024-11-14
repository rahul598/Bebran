<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="{{ url(Admin_Prefix) }}" class="nav-link {{ (Request::is(Admin_Prefix) ? 'active' : '') }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
          <span class="right badge badge-danger">Home</span>
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'general-settings') || Request::is(Admin_Prefix.'email-template') || Request::is(Admin_Prefix.'footer-settings') || Request::is(Admin_Prefix.'header-settings') || Request::is(Admin_Prefix.'profile') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'general-settings') || Request::is(Admin_Prefix.'email-template') || Request::is(Admin_Prefix.'footer-settings') || Request::is(Admin_Prefix.'header-settings') || Request::is(Admin_Prefix.'profile') ? 'active' : '') }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>
          Admin Setting
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'profile') }}" class="nav-link {{ (Request::is(Admin_Prefix.'profile') ? 'active' : '') }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Admin Profile</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'general-settings') }}" class="nav-link {{ (Request::is(Admin_Prefix.'general-settings') ? 'active' : '') }}">
            <i class="far fa-circle nav-icon"></i>
            <p>General Settings</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'header-settings') }}" class="nav-link {{ (Request::is(Admin_Prefix.'header-settings') ? 'active' : '') }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Header Settings</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'footer-settings') }}" class="nav-link {{ (Request::is(Admin_Prefix.'footer-settings') ? 'active' : '') }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Footer Settings</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'email-template') }}" class="nav-link {{ (Request::is(Admin_Prefix.'email-template') ? 'active' : '') }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Email Template</p>
          </a>
        </li> -->
       
        <li class="nav-item">
          <a href="{{ url('admin/logout') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('Logout') }}</p>
          </a>
        </li>
      </ul>
    </li>
    <!-- <li class="nav-item has-treeview {{ (Request::is('job') || Request::is('job/view/*') || Request::is('service-category') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is('job') || Request::is('job/view/*') || Request::is('service-category') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Job Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('job') }}" class="nav-link {{ (Request::is('job') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>List Job</p>
          </a>
        </li>
      </ul>
    </li> -->
    <!-- <li class="nav-item has-treeview {{ (Request::is('categorypage') || Request::is('categorypage/add') || Request::is('categorypage/edit/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is('categorypage') || Request::is('categorypage/add') || Request::is('categorypage/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Category Pages Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('categorypage') }}" class="nav-link {{ (Request::is('categorypage') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>List Category Page</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('categorypage/add') }}" class="nav-link {{ (Request::is('categorypage/add') || Request::is('categorypage/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add Category Page</p>
          </a>
        </li>
      </ul>
    </li> -->
    {{-- <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'media-library-images') || Request::is(Admin_Prefix.'media-library-images/add') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'media-library-images/add') || Request::is(Admin_Prefix.'media-library-images/add') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Media Library Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'media-library-images') }}" class="nav-link {{ (Request::is(Admin_Prefix.'media-library-images') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Media Library Images List</p>
          </a>
        </li>
      </ul>
    </li> --}}
    <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'page') || Request::is(Admin_Prefix.'page/add') || Request::is(Admin_Prefix.'page/edit/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'page') || Request::is(Admin_Prefix.'page/add') || Request::is(Admin_Prefix.'page/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Pages Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'page') }}" class="nav-link {{ (Request::is(Admin_Prefix.'page') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Pages</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'page/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'page/add') || Request::is(Admin_Prefix.'page/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add Page</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'service') || Request::is(Admin_Prefix.'service/add') || Request::is(Admin_Prefix.'service/edit/*') || Request::is(Admin_Prefix.'service-category') || Request::is(Admin_Prefix.'service-category/add') || Request::is(Admin_Prefix.'service-category/edit/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'service') || Request::is(Admin_Prefix.'service/add') || Request::is(Admin_Prefix.'service/edit/*') || Request::is(Admin_Prefix.'service-category') || Request::is(Admin_Prefix.'service-category/add') || Request::is(Admin_Prefix.'service-category/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Service Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'service') }}" class="nav-link {{ (Request::is(Admin_Prefix.'service') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Services</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'service/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'service/add') || Request::is(Admin_Prefix.'service/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add Service</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'service-category') }}" class="nav-link {{ (Request::is(Admin_Prefix.'service-category') || Request::is(Admin_Prefix.'service-category/add') || Request::is(Admin_Prefix.'service-category/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>List Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'tag') }}" class="nav-link {{ (Request::is(Admin_Prefix.'tag') || Request::is(Admin_Prefix.'tag/add') || Request::is(Admin_Prefix.'tag/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>List Tag</p>
          </a>
        </li> -->
      </ul>
    </li>
    <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'pricing') || Request::is(Admin_Prefix.'pricing/add') || Request::is(Admin_Prefix.'pricing/edit/*') || Request::is(Admin_Prefix.'pricing-category') || Request::is(Admin_Prefix.'pricing-category/add') || Request::is(Admin_Prefix.'pricing-category/edit/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'pricing') || Request::is(Admin_Prefix.'pricing/add') || Request::is(Admin_Prefix.'pricing/edit/*') || Request::is(Admin_Prefix.'pricing-category') || Request::is(Admin_Prefix.'pricing-category/add') || Request::is(Admin_Prefix.'pricing-category/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Pricing Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'pricing') }}" class="nav-link {{ (Request::is(Admin_Prefix.'pricing') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Pricings</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'pricing/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'pricing/add') || Request::is(Admin_Prefix.'pricing/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add Pricing</p>
          </a>
        </li>
      </ul>
    </li>
    <!-- Pricing Plan Packages -->
      <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'package-category') || Request::is(Admin_Prefix.'package-category/add') || Request::is(Admin_Prefix.'package-category/edit/*') || Request::is(Admin_Prefix.'package-type') || Request::is(Admin_Prefix.'package-type/add') || Request::is(Admin_Prefix.'package-type/edit/*')
       || Request::is(Admin_Prefix.'feature-title') || Request::is(Admin_Prefix.'feature-title/add') || Request::is(Admin_Prefix.'feature-title/edit/*') || Request::is(Admin_Prefix.'feature-sub-title') || Request::is(Admin_Prefix.'feature-sub-title/add') || Request::is(Admin_Prefix.'feature-sub-title/edit/*') || Request::is(Admin_Prefix.'package-plan')
       || Request::is(Admin_Prefix.'package-plan/add') || Request::is(Admin_Prefix.'package-plan/edit/*') || Request::is(Admin_Prefix.'feature/add') || Request::is(Admin_Prefix.'feature/edit/*') ? 'menu-open' : '') }}">
        
        <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'package-category') || Request::is(Admin_Prefix.'package-category/add') || Request::is(Admin_Prefix.'package-category/edit/*') || Request::is(Admin_Prefix.'package-type') || Request::is(Admin_Prefix.'package-type/add') || Request::is(Admin_Prefix.'package-type/edit/*')
         || Request::is(Admin_Prefix.'feature-title') || Request::is(Admin_Prefix.'feature-title/add') || Request::is(Admin_Prefix.'feature-title/edit/*') || Request::is(Admin_Prefix.'feature-sub-title') || Request::is(Admin_Prefix.'feature-sub-title/add') || Request::is(Admin_Prefix.'feature-sub-title/edit/*') || Request::is(Admin_Prefix.'package-plan')
         || Request::is(Admin_Prefix.'package-plan/add') || Request::is(Admin_Prefix.'package-plan/edit/*') || Request::is(Admin_Prefix.'feature/add') || Request::is(Admin_Prefix.'feature/edit/*') ? 'active' : '') }}">
          <i class="nav-icon fas fa-list"></i>
          <p>
            Packages Section
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url(Admin_Prefix.'package-category') }}" class="nav-link {{ (Request::is(Admin_Prefix.'package-category') || Request::is(Admin_Prefix.'package-category/add') || Request::is(Admin_Prefix.'package-category/edit/*') ? 'active' : '') }}">
              <i class="far fa-star nav-icon"></i>
              <p>Package Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(Admin_Prefix.'package-type') }}" class="nav-link {{ (Request::is(Admin_Prefix.'package-type') || Request::is(Admin_Prefix.'package-type/add') || Request::is(Admin_Prefix.'package-type/edit/*') ? 'active' : '') }}">
              <i class="far fa-star nav-icon"></i>
              <p>Package Type</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(Admin_Prefix.'package-plan') }}" class="nav-link {{ (Request::is(Admin_Prefix.'package-plan') || Request::is(Admin_Prefix.'package-plan/add') || Request::is(Admin_Prefix.'package-plan/edit/*') ? 'active' : '') }}">
              <i class="far fa-star nav-icon"></i>
              <p>Package Plan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(Admin_Prefix.'feature-title') }}" class="nav-link {{ (Request::is(Admin_Prefix.'feature-title') || Request::is(Admin_Prefix.'feature-title/add') || Request::is(Admin_Prefix.'feature-title/edit/*') ? 'active' : '') }}">
              <i class="far fa-star nav-icon"></i>
              <p>Feature Title</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(Admin_Prefix.'feature-sub-title') }}" class="nav-link {{ (Request::is(Admin_Prefix.'feature-sub-title') || Request::is(Admin_Prefix.'feature-sub-title/add') || Request::is(Admin_Prefix.'feature-sub-title/edit/*') ? 'active' : '') }}">
              <i class="far fa-star nav-icon"></i>
              <p>Feature Sub Title</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(Admin_Prefix.'feature/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'feature/add') || Request::is(Admin_Prefix.'feature/edit/*') ? 'active' : '') }}">
              <i class="far fa-star nav-icon"></i>
              <p>Update Feature</p>
            </a>
          </li>
        </ul>
      </li>
    <!-- Pricing Plan -->
    <!-- OUR WORK -->
    <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'seo-landing') || Request::is(Admin_Prefix.'seo-landing/add') || Request::is(Admin_Prefix.'case-study') || Request::is(Admin_Prefix.'case-study/add') || Request::is(Admin_Prefix.'caseStudiesCategory') || Request::is(Admin_Prefix.'portfolio') || Request::is(Admin_Prefix.'portfolio/add') || Request::is(Admin_Prefix.'portfolio/edit/*') || Request::is(Admin_Prefix.'portfolioCategory') || Request::is(Admin_Prefix.'portfolioCategory/add') || Request::is(Admin_Prefix.'portfolioCategory/edit/*') || Request::is(Admin_Prefix.'sample') || Request::is(Admin_Prefix.'sample/add') || Request::is(Admin_Prefix.'sample/edit/*') || Request::is(Admin_Prefix.'sampleCategory') || Request::is(Admin_Prefix.'sampleCategory/add') || Request::is(Admin_Prefix.'sampleCategory/edit/*') || Request::is(Admin_Prefix.'mediaCoverage') || Request::is(Admin_Prefix.'mediaCoverage/add') || Request::is(Admin_Prefix.'mediaCoverage/edit/*') || Request::is(Admin_Prefix.'mediaCoverageCategory') || Request::is(Admin_Prefix.'mediaCoverageCategory/add') || Request::is(Admin_Prefix.'mediaCoverageCategory/edit/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'seo-landing/add') || Request::is(Admin_Prefix.'seo-landing') || Request::is(Admin_Prefix.'case-study') || Request::is(Admin_Prefix.'case-study/add') || Request::is(Admin_Prefix.'caseStudiesCategory') || Request::is(Admin_Prefix.'portfolio') || Request::is(Admin_Prefix.'portfolio/add') || Request::is(Admin_Prefix.'portfolio/edit/*') || Request::is(Admin_Prefix.'portfolioCategory') || Request::is(Admin_Prefix.'portfolioCategory/add') || Request::is(Admin_Prefix.'portfolioCategory/edit/*') || Request::is(Admin_Prefix.'sample') || Request::is(Admin_Prefix.'sample/add') || Request::is(Admin_Prefix.'sample/edit/*') || Request::is(Admin_Prefix.'sampleCategory') || Request::is(Admin_Prefix.'sampleCategory/add') || Request::is(Admin_Prefix.'sampleCategory/edit/*') || Request::is(Admin_Prefix.'mediaCoverage') || Request::is(Admin_Prefix.'mediaCoverage/add') || Request::is(Admin_Prefix.'mediaCoverage/edit/*') || Request::is(Admin_Prefix.'mediaCoverageCategory') || Request::is(Admin_Prefix.'mediaCoverageCategory/add') || Request::is(Admin_Prefix.'mediaCoverageCategory/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Our Work Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'seo-result-landing') || Request::is(Admin_Prefix.'seo-landing') || Request::is(Admin_Prefix.'seo-landing/add') ? 'menu-open' : '') }}">
          <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'seo-result-landing') || Request::is(Admin_Prefix.'seo-landing') || Request::is(Admin_Prefix.'seo-landing/add') ? 'active' : '') }}">
            <i class="far fa-folder-open"></i>
            <p>
              Result Section
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'seo-result-landing') }}" class="nav-link {{ (Request::is(Admin_Prefix.'seo-result-landing') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Seo Result Landing</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'seo-landing') }}" class="nav-link {{ (Request::is(Admin_Prefix.'seo-landing') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Results List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'seo-landing/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'seo-landing/add') || Request::is(Admin_Prefix.'seo-landing/edit/*') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Add Result</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'caseStudiesLanding') || Request::is(Admin_Prefix.'case-study') || Request::is(Admin_Prefix.'case-study/add') || Request::is(Admin_Prefix.'case-study/edit/*') || Request::is(Admin_Prefix.'caseStudiesCategory') || Request::is(Admin_Prefix.'caseStudiesCategory/add') || Request::is(Admin_Prefix.'caseStudiesCategory/edit/*') ? 'menu-open' : '') }}">
          <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'caseStudiesLanding') || Request::is(Admin_Prefix.'case-study') || Request::is(Admin_Prefix.'case-study/add') || Request::is(Admin_Prefix.'case-study/edit/*') || Request::is(Admin_Prefix.'caseStudiesCategory') || Request::is(Admin_Prefix.'caseStudiesCategory/add') || Request::is(Admin_Prefix.'caseStudiesCategory/edit/*') ? 'active' : '') }}">
            <i class="far fa-folder-open"></i>
            <p>
              Case Studies Section
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'caseStudiesLanding') }}" class="nav-link {{ (Request::is(Admin_Prefix.'caseStudiesLanding') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Case Studies Landing</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'case-study') }}" class="nav-link {{ (Request::is(Admin_Prefix.'case-study') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Case Studies</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'case-study/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'case-study/add') || Request::is(Admin_Prefix.'case-study/edit/*') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Add Case Studies</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'caseStudiesCategory') }}" class="nav-link {{ (Request::is(Admin_Prefix.'caseStudiesCategory') || Request::is(Admin_Prefix.'caseStudiesCategory/add') || Request::is(Admin_Prefix.'caseStudiesCategory/edit/*') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Case Studies Category</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'portfolioLanding') || Request::is(Admin_Prefix.'portfolio') || Request::is(Admin_Prefix.'portfolio/add') || Request::is(Admin_Prefix.'portfolio/edit/*') || Request::is(Admin_Prefix.'portfolioCategory') || Request::is(Admin_Prefix.'portfolioCategory/add') || Request::is(Admin_Prefix.'portfolioCategory/edit/*') ? 'menu-open' : '') }}">
          <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'portfolioLanding') || Request::is(Admin_Prefix.'portfolio') || Request::is(Admin_Prefix.'portfolio/add') || Request::is(Admin_Prefix.'portfolio/edit/*') || Request::is(Admin_Prefix.'portfolioCategory') || Request::is(Admin_Prefix.'portfolioCategory/add') || Request::is(Admin_Prefix.'portfolioCategory/edit/*') ? 'active' : '') }}">
            <i class="far fa-folder-open"></i>
            <p>
              Portfolio Section
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'portfolioLanding') }}" class="nav-link {{ (Request::is(Admin_Prefix.'portfolioLanding') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Portfolio Landing</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'portfolio') }}" class="nav-link {{ (Request::is(Admin_Prefix.'portfolio') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Portfolio</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'portfolio/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'portfolio/add') || Request::is(Admin_Prefix.'portfolio/edit/*') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Add Portfolio</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'portfolioCategory') }}" class="nav-link {{ (Request::is(Admin_Prefix.'portfolioCategory') || Request::is(Admin_Prefix.'portfolioCategory/add') || Request::is(Admin_Prefix.'portfolioCategory/edit/*') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Portfolio Category</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'sampleLanding') || Request::is(Admin_Prefix.'sample') || Request::is(Admin_Prefix.'sample/add') || Request::is(Admin_Prefix.'sample/edit/*') || Request::is(Admin_Prefix.'sampleCategory') || Request::is(Admin_Prefix.'sampleCategory/add') || Request::is(Admin_Prefix.'sampleCategory/edit/*') ? 'menu-open' : '') }}">
          <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'sampleLanding') || Request::is(Admin_Prefix.'sample') || Request::is(Admin_Prefix.'sample/add') || Request::is(Admin_Prefix.'sample/edit/*') || Request::is(Admin_Prefix.'sampleCategory') || Request::is(Admin_Prefix.'sampleCategory/add') || Request::is(Admin_Prefix.'sampleCategory/edit/*') ? 'active' : '') }}">
            <i class="far fa-folder-open"></i>
            <p>
              Sample Section
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'sampleLanding') }}" class="nav-link {{ (Request::is(Admin_Prefix.'sampleLanding') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Sample Landing</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'sample') }}" class="nav-link {{ (Request::is(Admin_Prefix.'sample') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Sample</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'sample/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'sample/add') || Request::is(Admin_Prefix.'sample/edit/*') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Add Sample</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'sampleCategory') }}" class="nav-link {{ (Request::is(Admin_Prefix.'sampleCategory') || Request::is(Admin_Prefix.'sampleCategory/add') || Request::is(Admin_Prefix.'sampleCategory/edit/*') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Sample Category</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'mediaCoverageLanding') || Request::is(Admin_Prefix.'mediaCoverage') || Request::is(Admin_Prefix.'mediaCoverage/add') || Request::is(Admin_Prefix.'mediaCoverage/edit/*') || Request::is(Admin_Prefix.'mediaCoverageCategory') || Request::is(Admin_Prefix.'mediaCoverageCategory/add') || Request::is(Admin_Prefix.'mediaCoverageCategory/edit/*') ? 'menu-open' : '') }}">
          <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'mediaCoverageLanding') || Request::is(Admin_Prefix.'mediaCoverage') || Request::is(Admin_Prefix.'mediaCoverage/add') || Request::is(Admin_Prefix.'mediaCoverage/edit/*') || Request::is(Admin_Prefix.'mediaCoverageCategory') || Request::is(Admin_Prefix.'mediaCoverageCategory/add') || Request::is(Admin_Prefix.'mediaCoverageCategory/edit/*') ? 'active' : '') }}">
            <i class="far fa-folder-open"></i>
            <p>
              Media Coverage Section
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'mediaCoverageLanding') }}" class="nav-link {{ (Request::is(Admin_Prefix.'mediaCoverageLanding') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Media Coverage Landing</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'mediaCoverage') }}" class="nav-link {{ (Request::is(Admin_Prefix.'mediaCoverage') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Media Coverage</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'mediaCoverage/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'mediaCoverage/add') || Request::is(Admin_Prefix.'mediaCoverage/edit/*') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Add Media Coverage</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'mediaCoverageCategory') }}" class="nav-link {{ (Request::is(Admin_Prefix.'mediaCoverageCategory') || Request::is(Admin_Prefix.'mediaCoverageCategory/add') || Request::is(Admin_Prefix.'mediaCoverageCategory/edit/*') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Media Coverage Category</p>
              </a>
            </li> --}}
          </ul>
        </li>
      </ul>
      
    </li>
    <!-- OUR WORK -->
  
    <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'blog') || Request::is(Admin_Prefix.'blog/add') || Request::is(Admin_Prefix.'blog/edit/*') || Request::is(Admin_Prefix.'category') || Request::is(Admin_Prefix.'category/add') || Request::is(Admin_Prefix.'category/edit/*') || Request::is(Admin_Prefix.'tag') || Request::is(Admin_Prefix.'tag/add') || Request::is(Admin_Prefix.'tag/edit/*') || Request::is(Admin_Prefix.'comment') || Request::is(Admin_Prefix.'comment/view/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'blog') || Request::is(Admin_Prefix.'blog/add') || Request::is(Admin_Prefix.'blog/edit/*') || Request::is(Admin_Prefix.'category') || Request::is(Admin_Prefix.'category/add') || Request::is(Admin_Prefix.'category/edit/*') || Request::is(Admin_Prefix.'tag') || Request::is(Admin_Prefix.'tag/add') || Request::is(Admin_Prefix.'tag/edit/*') || Request::is(Admin_Prefix.'comment') || Request::is(Admin_Prefix.'comment/view/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Blog Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'blog') }}" class="nav-link {{ (Request::is(Admin_Prefix.'blog') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Blogs</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'blog/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'blog/add') || Request::is(Admin_Prefix.'blog/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add Blog</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'category') }}" class="nav-link {{ (Request::is(Admin_Prefix.'category') || Request::is(Admin_Prefix.'category/add') || Request::is(Admin_Prefix.'category/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Categories</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'news') || Request::is(Admin_Prefix.'news/add') || Request::is(Admin_Prefix.'news/edit/*') || Request::is(Admin_Prefix.'newsCategory') || Request::is(Admin_Prefix.'newsCategory/add') || Request::is(Admin_Prefix.'newsCategory/edit/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'news') || Request::is(Admin_Prefix.'news/add') || Request::is(Admin_Prefix.'news/edit/*') || Request::is(Admin_Prefix.'newsCategory') || Request::is(Admin_Prefix.'newsCategory/add') || Request::is(Admin_Prefix.'newsCategory/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
        News Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'news') }}" class="nav-link {{ (Request::is(Admin_Prefix.'news') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>News</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'news/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'news/add') || Request::is(Admin_Prefix.'news/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add News</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'newsCategory') }}" class="nav-link {{ (Request::is(Admin_Prefix.'newsCategory') || Request::is(Admin_Prefix.'newsCategory/add') || Request::is(Admin_Prefix.'newsCategory/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>News Categories</p>
          </a>
        </li>
      </ul>
    </li>
    <!-- Case Studies -->
    {{-- <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'case-study') || Request::is(Admin_Prefix.'case-study/add') || Request::is(Admin_Prefix.'case-study/edit/*') || Request::is(Admin_Prefix.'caseStudiesCategory') || Request::is(Admin_Prefix.'caseStudiesCategory/add') || Request::is(Admin_Prefix.'caseStudiesCategory/edit/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'case-study') || Request::is(Admin_Prefix.'case-study/add') || Request::is(Admin_Prefix.'case-study/edit/*') || Request::is(Admin_Prefix.'caseStudiesCategory') || Request::is(Admin_Prefix.'caseStudiesCategory/add') || Request::is(Admin_Prefix.'caseStudiesCategory/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Case Studies Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'case-study') }}" class="nav-link {{ (Request::is(Admin_Prefix.'case-study') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>List Case Studies</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'case-study/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'case-study/add') || Request::is(Admin_Prefix.'case-study/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add Case Studies</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'caseStudiesCategory') }}" class="nav-link {{ (Request::is(Admin_Prefix.'caseStudiesCategory') || Request::is(Admin_Prefix.'caseStudiesCategory/add') || Request::is(Admin_Prefix.'caseStudiesCategory/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>List Case Studies Category</p>
          </a>
        </li>
      </ul>
    </li> --}}
    <!-- End case studies -->
    
    <!-- <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'testimonial') || Request::is(Admin_Prefix.'testimonial/add') || Request::is(Admin_Prefix.'testimonial/edit/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'testimonial') || Request::is(Admin_Prefix.'testimonial/add') || Request::is(Admin_Prefix.'testimonial/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Testimonial Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'testimonial') }}" class="nav-link {{ (Request::is(Admin_Prefix.'testimonial') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>List Testimonial</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'testimonial/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'testimonial/add') || Request::is(Admin_Prefix.'testimonial/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add Testimonial</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview {{ (Request::is('service-time') || Request::is('service-time/add') || Request::is('service-time/edit/*') || Request::is('skill') || Request::is('skill/add') || Request::is('skill/edit/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is('service-time') || Request::is('service-time/add') || Request::is('service-time/edit/*') || Request::is('skill') || Request::is('skill/add') || Request::is('skill/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Master Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('skill') }}" class="nav-link {{ (Request::is('skill') || Request::is('skill/add') || Request::is('skill/edit/*') ? 'active' : '') }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Skill</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('service-time') }}" class="nav-link {{ (Request::is('service-time') || Request::is('service-time/add') || Request::is('service-time/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>List Job Time</p>
          </a>
        </li>
      </ul>
    </li> -->


    {{-- <li class="nav-item has-treeview active">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Contact Forms
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'blog') }}" class="nav-link {{ (Request::is(Admin_Prefix.'blog') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Home Form</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'blog/add') }}" class="nav-link">
            <i class="far fa-star nav-icon"></i>
            <p>Blog Form</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'category') }}" class="nav-link">
            <i class="far fa-star nav-icon"></i>
            <p>Contact Form</p>
          </a>
        </li>
      </ul>
    </li>
     --}}
     <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'countries') || Request::is(Admin_Prefix.'countries/add') || Request::is(Admin_Prefix.'city-service') || Request::is(Admin_Prefix.'city-service/add') || Request::is(Admin_Prefix.'business-service/add')|| Request::is(Admin_Prefix.'business-service')|| Request::is(Admin_Prefix.'business-service/add')|| Request::is(Admin_Prefix.'business-service')|| Request::is(Admin_Prefix.'countries/edit/*') ||Request::is(Admin_Prefix.'city-business-service/add') ||Request::is(Admin_Prefix.'city-business-service')|| Request::is(Admin_Prefix.'cities') || Request::is(Admin_Prefix.'cities/add') || Request::is(Admin_Prefix.'cities/edit/*')  ? 'menu-open' : '') }}">

      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'countries') || Request::is(Admin_Prefix.'city-service') || Request::is(Admin_Prefix.'city-service/add') || Request::is(Admin_Prefix.'business-service/add')|| Request::is(Admin_Prefix.'business-service')|| Request::is(Admin_Prefix.'countries/add') || Request::is(Admin_Prefix.'countries/edit/*') || Request::is(Admin_Prefix.'cities') || Request::is(Admin_Prefix.'cities/add') ||Request::is(Admin_Prefix.'business-service/add') ||Request::is(Admin_Prefix.'city-business-service/add') ||Request::is(Admin_Prefix.'city-business-service')|| Request::is(Admin_Prefix.'business-service') || Request::is(Admin_Prefix.'cities/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Dynamic Pages
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
          <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'city-service') || Request::is(Admin_Prefix.'city-service/add') || Request::is(Admin_Prefix.'city-service/edit/*') ? 'menu-open' : '') }}">
            <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'city-service') || Request::is(Admin_Prefix.'city-service/add') ? 'active' : '') }}">
              <i class="nav-icon far fa-folder-open"></i>
              <p>
                Service In City
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url(Admin_Prefix.'city-service') }}" class="nav-link {{ (Request::is(Admin_Prefix.'city-service') ? 'active' : '') }}">
                  <i class="far fa-star nav-icon"></i>
                  <p>City Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url(Admin_Prefix.'city-service/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'city-service/add') || Request::is(Admin_Prefix.'service/edit/*') ? 'active' : '') }}">
                  <i class="far fa-star nav-icon"></i>
                  <p>Add City Service</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'business-service') || Request::is(Admin_Prefix.'business-service/add') || Request::is(Admin_Prefix.'city-service/edit/*') ? 'menu-open' : '') }}">
            <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'business-service') || Request::is(Admin_Prefix.'business-service/add') ? 'active' : '') }}">
              <i class="nav-icon far fa-folder-open"></i>
              <p>
                 Service For Business
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url(Admin_Prefix.'business-service') }}" class="nav-link {{ (Request::is(Admin_Prefix.'business-service') ? 'active' : '') }}">
                  <i class="far fa-star nav-icon"></i>
                  <p>Business Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url(Admin_Prefix.'business-service/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'business-service/add') || Request::is(Admin_Prefix.'service/edit/*') ? 'active' : '') }}">
                  <i class="far fa-star nav-icon"></i>
                  <p>Add Business Service</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'city-business-service') || Request::is(Admin_Prefix.'city-business-service/add') || Request::is(Admin_Prefix.'city-service/edit/*') ? 'menu-open' : '') }}">
            <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'city-business-service') || Request::is(Admin_Prefix.'city-business-service/add') ? 'active' : '') }}">
              <i class="nav-icon far fa-folder-open"></i>
              <p>
                City + Business
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url(Admin_Prefix.'city-business-service') }}" class="nav-link {{ (Request::is(Admin_Prefix.'city-business-service') ? 'active' : '') }}">
                  <i class="far fa-star nav-icon"></i>
                  <p>City + Business</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url(Admin_Prefix.'city-business-service/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'city-business-service/add') || Request::is(Admin_Prefix.'city-business-service/edit/*') ? 'active' : '') }}">
                  <i class="far fa-star nav-icon"></i>
                  <p>Add City + Business Service</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url(Admin_Prefix.'cities') }}" class="nav-link {{ (Request::is(Admin_Prefix.'cities') ? 'active' : '') }}">
              <i class="far fa-star nav-icon"></i>
              <p>Cities</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(Admin_Prefix.'business') }}" class="nav-link {{ (Request::is(Admin_Prefix.'business') ? 'active' : '') }}">
              <i class="far fa-star nav-icon"></i>
              <p>Business</p>
            </a>
          </li>
      </ul>
    </li>

     <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'form-list') || Request::is(Admin_Prefix.'guest-forms-data') || Request::is(Admin_Prefix.'service-form') || Request::is(Admin_Prefix.'contact_us') || Request::is(Admin_Prefix.'guest-forms-data')  ? 'menu-open' : '') }}">

      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'form-list') || Request::is(Admin_Prefix.'guest-forms-data') || Request::is(Admin_Prefix.'home-form') || Request::is(Admin_Prefix.'service-form') || Request::is(Admin_Prefix.'contact_us') || Request::is(Admin_Prefix.'guest-forms-data') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Enquiry Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'form-list') }}" class="nav-link {{ (Request::is(Admin_Prefix.'form-list') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Enquiry Forms</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'guest-forms-data') }}" class="nav-link {{ (Request::is(Admin_Prefix.'guest-forms-data') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Guest Forms</p>
          </a>
        </li>
        {{-- <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'guest-forms-data') || Request::is(Admin_Prefix.'blog-comment-form') ||  Request::is(Admin_Prefix.'service-form') || Request::is(Admin_Prefix.'contact_us')  ? 'menu-open' : '') }}">

          <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'guest-post-section') || Request::is(Admin_Prefix.'guest-forms-data') ? 'active' : '') }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Guest Post Section
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url(Admin_Prefix.'guest-forms-data') }}" class="nav-link {{ (Request::is(Admin_Prefix.'guest-forms-data') ? 'active' : '') }}">
                <i class="far fa-star nav-icon"></i>
                <p>Guest Forms</p>
              </a>
            </li>
          </ul>
        </li> --}}
      </ul>
    </li>
   
    <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'user') || Request::is(Admin_Prefix.'user/customer') || Request::is(Admin_Prefix.'user/add') || Request::is(Admin_Prefix.'user/edit/*') || Request::is(Admin_Prefix.'user/view/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'user') || Request::is(Admin_Prefix.'user/customer') || Request::is(Admin_Prefix.'user/add') || Request::is(Admin_Prefix.'user/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          User Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'user') }}" class="nav-link {{ (Request::is(Admin_Prefix.'user') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Admin</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'user/customer') }}" class="nav-link {{ (Request::is(Admin_Prefix.'user/customer') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>List Customer</p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'user/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'user/add') || Request::is(Admin_Prefix.'user/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add User</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'price_widget_feature_list') || Request::is(Admin_Prefix.'price_widget_feature') || Request::is(Admin_Prefix.'price_widget') || Request::is(Admin_Prefix.'price_widget_list') || Request::is(Admin_Prefix.'price_widget/list') || Request::is(Admin_Prefix.'price_widget/add')  ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'price_widget_feature_list') || Request::is(Admin_Prefix.'price_widget_feature') || Request::is(Admin_Prefix.'price_widget') || Request::is(Admin_Prefix.'price_widget_list') || Request::is(Admin_Prefix.'price_widget/list') || Request::is(Admin_Prefix.'price_widget/add') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Price Widget 
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'price_widget') }}" class="nav-link {{ (Request::is(Admin_Prefix.'price_widget') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add Price Widget</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'user/customer') }}" class="nav-link {{ (Request::is(Admin_Prefix.'user/customer') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>List Customer</p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'price_widget_list') }}" class="nav-link {{ (Request::is(Admin_Prefix.'price_widget_list') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Price Widget List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'price_widget_feature_list') }}" class="nav-link {{ (Request::is(Admin_Prefix.'price_widget_feature_list') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Price Widget Features List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'price_widget_feature') }}" class="nav-link {{ (Request::is(Admin_Prefix.'price_widget_feature') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add Price Widget Features</p>
          </a>
        </li>
      </ul>
    </li>
    
    <!--payment gateway--> 
    <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'payment') || Request::is(Admin_Prefix.'payment/update') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'payment') || Request::is(Admin_Prefix.'payment/update') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Payment Gateway 
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'payment') }}" class="nav-link {{ (Request::is(Admin_Prefix.'payment') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Payment</p>
          </a>
        </li> 
      </ul>
    </li>
    
    
    <?php /**/?>
    {{-- <li class="nav-item has-treeview {{ (Request::is(Admin_Prefix.'seo-landing')  || Request::is(Admin_Prefix.'seo-landing/add') || Request::is(Admin_Prefix.'seo-landing/edit/*') ? 'menu-open' : '') }}">
      <a href="javascript:void(0);" class="nav-link {{ (Request::is(Admin_Prefix.'seo-landing') || Request::is(Admin_Prefix.'seo-landing/add') || Request::is(Admin_Prefix.'seo-landing/edit/*') ? 'active' : '') }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          SEO Landing Section
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'seo-landing') }}" class="nav-link {{ (Request::is(Admin_Prefix.'seo-landing') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Seo Landing List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url(Admin_Prefix.'seo-landing/add') }}" class="nav-link {{ (Request::is(Admin_Prefix.'seo-landing/add') || Request::is(Admin_Prefix.'seo-landing/edit/*') ? 'active' : '') }}">
            <i class="far fa-star nav-icon"></i>
            <p>Add Seo Landing</p>
          </a>
        </li>
      </ul>
    </li> --}}
    
    <?php /**/?>
    
    <!-- <li class="nav-header">EXAMPLES</li> -->
  </ul>
</nav>
