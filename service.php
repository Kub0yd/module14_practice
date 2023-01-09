<?php 
//возвращает список пользователей
function getUsersList() {
    $users = [
        'admin' => ['id' => '1', 'password' => '132432'],
        'test' => ['id' => '2', 'password' => '123'],
    ];
   return $users;
}
//проверяет существует ли пользователь с указанным логином
function existsUser($login) {
    $userSet = false;
    foreach (array_keys(getUsersList()) as $value) {
        if ($value === $login) {
            $userSet = true;
            break;  
        }
    }
    return $userSet;
};
// true тогда, когда существует пользователь с указанным логином и введенный им пароль прошел проверку
function checkPassword($login, $password) {
    $users =  getUsersList();
    return strval($password) === $users[strval($login)]['password'];
 };
 //возвращает либо имя вошедшего на сайт пользователя, либо null.
function getCurrentUser() {
    return $_SESSION['login'];
};

