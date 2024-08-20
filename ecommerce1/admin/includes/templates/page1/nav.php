<div id="sidebarId" class="position-relative d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar ">
    <span style="right: 10px; top: 2px" class="position-absolute">
        <button class="btn" onclick="toggleSidebar()">
            <i class="bi bi-x-circle"></i>
        </button>
    </span>

    <a href="member.php?do=info&id=<?= $_SESSION['id'] ?>"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="bi bi-lightning-charge"></i>
        <span class="fs-4 sidebar-text"><?= $_SESSION['admin']?></span>
    </a>
    <hr />
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?= $pageTitle == 'Home page' ? 'active' : '' ?>"
                aria-current="page">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#home" />
                </svg>
                <span class="sidebar-text"> <?= lang("home") ?> </span>
            </a>
        </li>

        <li>
            <a href="member.php?do=add" class="nav-link text-white <?= $pageTitle == 'Member Page' ? 'active' : '' ?>">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#people-circle" />
                </svg>
                <span class="sidebar-text"><?= lang("add_customers") ?></span>
            </a>
        </li>
        <li>
            <a href="info.php" class="nav-link text-white <?= $pageTitle == 'Info Page' ? 'active' : '' ?>">
                <svg class="bi pe-none me-2 " style="margin: -23px;" width="16" height="16">
                    <i class="bi bi-clipboard-data-fill "></i>
                </svg>
                <span class="sidebar-text mx-1"><?= lang("info-project") ?></span>
            </a>
        </li>
        <li>
            <a href="activeUser.php" class="nav-link text-white <?= $pageTitle == 'Active Page' ? 'active' : '' ?>">
                <svg class="bi pe-none me-2 " style="margin: -23px;" width="16" height="16">
                    <i class="bi bi-person-fill-lock"></i>
                </svg>
                <span class="sidebar-text mx-1"><?= lang("activeUsers") ?></span>
            </a>
        </li>
        <li>
            <a href="Catagories.php" class="nav-link text-white <?= $pageTitle == 'Catagories Page' ? 'active' : '' ?>">
                <svg class="bi pe-none me-2 " style="margin: -23px;" width="16" height="16">
                    <i class="bi bi-handbag-fill"></i>
                </svg>
                <span class="sidebar-text mx-1"><?= lang("catagories") ?></span>
            </a>
        </li>
        <li>
            <a href="showItems.php" class="nav-link text-white <?= $pageTitle == 'items Page' ? 'active' : '' ?>">
                <svg class="bi pe-none me-2 " style="margin: -23px;" width="16" height="16">
                    <i class="bi bi-bag-check-fill"></i>
                </svg>
                <span class="sidebar-text mx-1"><?= lang("showItems") ?></span>
            </a>
        </li>
        <li>
            <a href="orders.php" class="nav-link text-white <?= $pageTitle == 'Orders Page' ? 'active' : '' ?>">
                <svg class="bi pe-none me-2 " style="margin: -23px;" width="16" height="16">
                    <i class="bi bi-hourglass-split"></i>
                </svg>
                <span class="sidebar-text mx-1"><?= lang("orders") ?></span>
            </a>
        </li>
        <li>
            <a href="notification.php"
                class="nav-link text-white <?= $pageTitle == 'Notification Page' ? 'active' : '' ?>">
                <svg class="bi pe-none me-2 " style="margin: -23px;" width="16" height="16">
                    <i class="bi bi-bell-fill"></i>
                </svg>
                <span class="sidebar-text mx-1"><?= lang("notification") ?></span>
            </a>
        </li>
        <li>
            <a href="messages.php" class="nav-link text-white <?= $pageTitle == 'messages Page' ? 'active' : '' ?>">
                <svg class="bi pe-none me-2 " style="margin: -23px;" width="16" height="16">
                    <i class="bi bi-chat-text-fill"></i>
                </svg>
                <span class="sidebar-text mx-1"><?= lang("messages") ?></span>
            </a>
        </li>
        <li>
            <a href="Mangers.php" class="nav-link text-white <?= $pageTitle == 'Mangers Page' ? 'active' : '' ?>">
                <svg class="bi pe-none me-2 " style="margin: -23px;" width="16" height="16">
                    <i class="bi bi-database-fill-gear"></i>
                </svg>
                <span class="sidebar-text mx-1"><?= lang("Mangers") ?></span>
            </a>
        </li>
        <a href="Admin.php" class="nav-link text-white <?= $pageTitle == 'Admin Page' ? 'active' : '' ?>">
            <svg class="bi pe-none me-2 " style="margin: -23px;" width="16" height="16">
                <i class="bi bi-shield-lock-fill"></i>
            </svg>
            <span class="sidebar-text mx-1"><?= lang("Admin") ?></span>
        </a>
        </li>
    </ul>
    <hr />
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= $page1 . '/img/img1.jpg' ?>" alt="" width="32" height="32" class="rounded-circle me-2" />
            <strong class="sidebar-text">
                <?php
                if(!isset($_SESSION['id'])){header('Location: index.php');}
                 $dataID =    $_SESSION['id'] ;
                 $stmt = $conn->prepare("SELECT fullName FROM users WHERE userID = $dataID"); $stmt->execute(); $row = $stmt->fetch();
    if(!empty($row['fullName'])){echo $row['fullName'];}else{header('Location: index.php');}  ?>
            </strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="addItems.php?do=add"><?= lang('newProject') ?></a></li>
            <li><a class="dropdown-item" href="#"><?= lang('Settings') ?></a></li>
            <li><a class="dropdown-item"
                    href="member.php?do=edit&id=<?=$_SESSION['id'] ?>"><?= lang('editProfile') ?></a></li>
            <li><a class="dropdown-item" href="member.php?do=info&id=<?= $_SESSION['id'] ?>"><?= lang('Profile') ?></a>
            </li>
            <li>
                <hr class="dropdown-divider" />
            </li>
            <li><a class="dropdown-item" href="logout.php"><?= lang('logout') ?></a></li>
        </ul>
    </div>
</div>