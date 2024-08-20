<?php

function lang($x) {

    static $lang = array(
        "home"             => "Home",
        "add_customers"    => "Add Customers",
        "sidebar"          => "Sidebar",
        "newProject"       => "New Items...",
        "actions"          => "Actions",
        "Settings"         => "Settings",
        "Profile"          => "Profile",
        "logout"           => "Sign out",
        "Sidebar"          => "Sidebar",
        "add"              => "Add",
        "edit"             => "Edit",
        "delete"           => "Delete",
        "view"             => "View",
        "search"           => "Search",
        "name"             => "Name",
        "email"            => "Email",
        "gender"           => "Gender",
        "country"          => "Country",
        "age"              => "Age",
        "date"             => "Date",
        "add_user"         => "Add user",
        "edit_user"        => "Edit user",
        "delete_user"      => "Delete user",
        "view_user"        => "View user",
        "search_user"      => "Search user",
        "FullName"         => "Full Name",
        "lastUpdated"      => "Last updated",
        "control_system"   => "Control System",
        "editProfile"      => "Edit Profile",
        "info-project"     => "Info All Project",
        "activeUsers"      => "Active Users",
        "catagories"       => "Catagories",
        "orders"           => "Orders",
        "Admin"            => "Admin",
        "active"           => "Active",
        "inactive"         => "Inactive",
        "all"              => "All",
        "notification"     => "Notification",
        "messages"         => "Messages",
        "Mangers"          => "Mangers",
        "showItems"        => "Show Items",
    );

    return isset($lang[$x]) ? $lang[$x] : "Undefined key: $x";
}
?>