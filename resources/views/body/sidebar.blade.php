<aside class="left-sidebar" data-sidebarbg="skin6">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="sidebar-item"> 
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/" aria-expanded="false">
                    <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                </a>
            </li>

            @auth
                @if(auth()->user()->role == 'admin')
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/contest/contests" aria-expanded="false">
                            <i class="mdi mdi-code-not-equal-variant"></i><span class="hide-menu">Contests</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/contestant/contests" aria-expanded="false">
                            <i class="mdi mdi-account-outline"></i><span class="hide-menu">Contestants</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/judge/contests" aria-expanded="false">
                            <i class="mdi mdi-account-network"></i><span class="hide-menu">Judges</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/criteria/contests" aria-expanded="false">
                            <i class="mdi mdi-clipboard-text"></i><span class="hide-menu">Criterias</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/judgement/contests" aria-expanded="false">
                            <i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Contest Judging</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/result/results" aria-expanded="false">
                            <i class="mdi mdi-certificate"></i><span class="hide-menu">Contest Rewards</span>
                        </a>
                    </li>
                @elseif(auth()->user()->role == 'judge')
                    <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/judge/judgement/contest_contestants/{{ auth()->user()->id }}" aria-expanded="false">
                            <i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Contest Judging</span>
                        </a>
                    </li>
                @endif
            @endauth
            
          </ul>

      </nav>
      <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>