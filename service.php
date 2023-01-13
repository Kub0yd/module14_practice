<?php 
//возвращает список пользователей
function getUsersList() {
    $users = [
        'admin' => ['id' => '1', 'password' => md5('132432')],
        'test' => ['id' => '2', 'password' => md5('123')],
        'Kub' => ['id' => '3', 'password' => md5('321')],
    ];
   return $users;
}
//проверяет существует ли пользователь с указанным логином
function existsUser($login) {
    $userSet = false;
    foreach (array_keys(getUsersList()) as $value) {
        if ($value === trim($login)) {
            $userSet = true;
            break;  
        }
    }
    return $userSet;
};
// true тогда, когда существует пользователь с указанным логином и введенный им пароль прошел проверку
function checkPassword($login, $password) {
    $users =  getUsersList();
    return strval(trim($password)) === $users[strval(trim($login))]['password'];
 };
 //возвращает либо имя вошедшего на сайт пользователя, либо null.
function getCurrentUser() {
    return $_SESSION['login'];
};

