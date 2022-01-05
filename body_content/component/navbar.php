<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Halo, <?=$_SESSION['sess_user']['user']['username']?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="?page=profile">PROFILE</a>
            </li>
            <?php
                $menu = '';
                foreach ($arr_menu[$_SESSION['sess_user']['role']] as $data) {
                    $menu .= '<li class="nav-item">';
                    $menu .= '<a class="nav-link" href="'.$data['link'].'">'.$data['label'].'</a>';
                    $menu .= '</li>';
                }
                echo $menu;
            ?>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">Log Out</a>
        </div>
    </div>
</nav>