<nav class="navbar navbar-default navbar-static-top">
    <!-- Top Navigation Bar -->
    <div class="container">
        <!-- Center the company name -->
        <a class="navbar-brand mx-auto" href="#">{{ env('COMPANY_NAME') }}</a>
    </div>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="myTabs" role="tablist">

        <li class="nav-item active" role="presentation">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" aria-expanded="true">Home</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="reports-tab" data-toggle="tab" href="#reports" role="tab" aria-controls="reports" aria-selected="false">Reports</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
      </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="others-tab" data-toggle="tab" href="#others" role="tab" aria-controls="others" aria-selected="false">Others</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="myTabsContent">
        <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
            <!-- Content for the Home tab goes here -->
            @include('partials.nav.home')
        </div>
        <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
            <!-- Content for the Reports tab goes here -->
            @include('partials.nav.reports')
        </div>
        <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
          <!-- Content for the Reports tab goes here -->
          @include('partials.nav.admin')
        </div>
        <div class="tab-pane fade" id="others" role="tabpanel" aria-labelledby="others-tab">
            <!-- Content for the Others tab goes here -->
            @include('partials.nav.others')
        </div>
    </div>
</nav>
