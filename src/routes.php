<?php
extract($_GET);

if (!isset($section) || $section == 'home'):
    include 'main/main-index.php';

// INSTRUMENTS
elseif ($section == 'instruments' and $_login):
    if ($sbs == 'performancecontext'):
        include 'instruments/performance-context.php';
    elseif ($sbs == 'teamhealth'):
        include 'instruments/team-health.php';
    elseif ($sbs == 'teamhealth2'):
        include 'instruments/team-health-II.php';
    elseif ($sbs == 'competitiveprofile'):
        include 'instruments/competitive-profile.php';
    elseif ($sbs == 'managerprofile'):
        include 'instruments/manager-profile.php';
    elseif ($sbs == 'strategicfocus'):
        include 'instruments/strategic-focus.php';
    elseif ($sbs == 'naturaltalent'):
        include 'instruments/natural-talent.php';
    else:
        include 'src/error.php';
    endif;

// RESULTS
elseif ($section == 'results' and $_admin):
    if ($sbs == 'performanceresult'):
        include 'results/performance-context.php';
    elseif ($sbs == 'teamresult'):
        include 'results/team-health.php';
    elseif ($sbs == 'teamresult2'):
        include 'results/team-health-II.php';
    elseif ($sbs == 'competitiveresult'):
        include 'results/competitive-profile.php';
    elseif ($sbs == 'managerresult'):
        include 'results/manager-profile.php';
    elseif ($sbs == 'strategicfocusresult'):
        include 'results/strategic-focus.php';
    elseif ($sbs == 'naturaltalentresult'):
        include 'results/natural-talent.php';
    else:
        include 'src/error.php';
    endif;

// CONSOLIDATED
elseif ($section == 'consolidated' and $_admin):
    if ($sbs == 'performanceconsolidated'):
        include 'consolidated/performance-context.php';
    elseif ($sbs == 'teamconsolidated'):
        include 'consolidated/team-health.php';
    elseif ($sbs == 'team2consolidated'):
        include 'consolidated/team-health-II.php';
    elseif ($sbs == 'competitiveconsolidated'):
        include 'consolidated/competitive-profile.php';
    else:
        include 'src/error.php';
    endif;

/// ADMINISTRACION
// USERS
elseif ($section == 'users' and ($_admin)):
    if ($sbs == 'createuser'):
        include 'admin/users/create-user.php';
    elseif ($sbs == 'manageusers'):
        include 'admin/users/manage-users.php';
    elseif ($sbs == 'edituser'):
        include 'admin/users/edit-user.php';
    else:
        include 'src/error.php';
    endif;

// GROUPS
elseif ($section == 'groups' and ($_admin)):
    if ($sbs == 'creategroup'):
        include 'admin/groups/create-group.php';
    elseif ($sbs == 'managegroups'):
        include 'admin/groups/manage-groups.php';
    elseif ($sbs == 'editgroup'):
        include 'admin/groups/edit-group.php';
    else:
        include 'src/error.php';
    endif;

// USER MENU
elseif ($section == 'adminusers' and $_login):
    if ($sbs == 'editprofile'):
        include 'admin/users/edit-profile.php';
    elseif ($sbs == 'changepass'):
        include 'admin/users/change-password.php';
    else:
        include 'src/error.php';
    endif;

elseif ($section == 'forgotpass'):
    include 'admin/users/retrieve-password.php';
else:
    include 'src/error.php';
endif;
