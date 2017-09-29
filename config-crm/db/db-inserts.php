<?php
$inserts = array(
    'root'  => "INSERT INTO users (firstname,lastname,login_crm,password_crm) SELECT 'root', 'root', 'root', 'pass1234' AS tmp WHERE NOT EXISTS ( SELECT login_crm FROM users WHERE login_crm = 'root' ) LIMIT 1",
    'root'  => "INSERT INTO users_role (role_id,user_id) SELECT '1','1' AS tmp WHERE NOT EXISTS ( SELECT role_id,user_id FROM users_role WHERE role_id = '1' AND user_id = '1' ) LIMIT 1",
    'role1' => "INSERT INTO role (role_name) SELECT 'MASTER_ADMIN' AS tmp WHERE NOT EXISTS ( SELECT role_name FROM role WHERE role_name = 'MASTER_ADMIN' ) LIMIT 1",
    'perm1' => "INSERT INTO perm (perm_name) SELECT 'getUsers' AS tmp WHERE NOT EXISTS ( SELECT perm_name FROM perm WHERE perm_name = 'getUsers' ) LIMIT 1",
    'perm2' => "INSERT INTO perm (perm_name) SELECT 'addUser' AS tmp WHERE NOT EXISTS ( SELECT perm_name FROM perm WHERE perm_name = 'addUser' ) LIMIT 1",
    'perm3' => "INSERT INTO perm (perm_name) SELECT 'editUser' AS tmp WHERE NOT EXISTS ( SELECT perm_name FROM perm WHERE perm_name = 'editUser' ) LIMIT 1",
    'perm4' => "INSERT INTO perm (perm_name) SELECT 'showAdminPage' AS tmp WHERE NOT EXISTS ( SELECT perm_name FROM perm WHERE perm_name = 'showAdminPage' ) LIMIT 1",
               );
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

