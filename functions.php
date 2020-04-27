<?php

function helloWorld($username){
    return  "Hello World $username";
}

$users = [
    [
        'name' => 'Bob',
        'surname' => 'Martin',
        'age' => 75,
        'gender' => 'man',
        'avatar' => 'https://i.ytimg.com/vi/sDnPs_V8M-c/hqdefault.jpg',
        'animals' => ['dog', 'horse']
    ],
    [
        'name' => 'Alice',
        'surname' => 'Merton',
        'age' => 25,
        'gender' => 'woman',
        'avatar' => 'https://i.scdn.co/image/d44a5d71596b03b5dc6f5bbcc789458700038951',
        'animals' => ['dog', 'cat']
    ],
    [
        'name' => 'Jack',
        'surname' => 'Sparrow',
        'age' => 45,
        'gender' => 'man',
        'avatar' => 'https://pbs.twimg.com/profile_images/427547618600710144/wCeLVpBa_400x400.jpeg',
        'animals' => ['cat', 'dog', 'parrot']
    ],
    [
        'name' => 'Angela',
        'surname' => 'Merkel',
        'age' => 60,
        'gender' => 'woman',
        'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg/330px-Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg',
        'animals' => ['alligator', 'horse', 'dog']
    ]
];
if (!empty($_POST)) {
    $users[] = $_POST;
}

function sortFields($userA, $userB){
    $order = $_GET['order'] ?? 'asc';
    if(!empty($_GET['order']) && $_GET['order'] == 'asc') {
        return $userA[$_GET['sort']] <=> $userB[$_GET['sort']];
    }
    return $userB[$_GET['sort']] <=> $userA[$_GET['sort']];
}
// Search Max Ages in Users
$ages = array_column($users, 'age');
$maxAge = array_keys($ages, max($ages));
$olderUser = [];
foreach ($maxAge as $index) {
    $olderUser[] = $users[$index];
}

if (!empty($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'id':
            if (!empty($_GET['order']) && $_GET['order'] == 'desc') {
                krsort($users);
            } else {
                ksort($users);
            }
            $users = array_values($users);
            break;
        case 'name':
        case 'surname':
        case 'age':
        case 'gender':
            usort($users, 'sortFields');
    }
}
$animals = [];
foreach ($users as $user) {
    $animals = array_merge($animals, $user['animals']);
}

$animalsFilter = array_unique($animals);

if (!empty($_GET['filter'])) {
    switch ($_GET['filter']) {
        case 'man':
            foreach ($users as $key => $user) {
                if ($user['gender'] !== 'man') {
                    unset($users[$key]);
                }
            }
            break;
        case 'woman':
            foreach ($users as $key => $user) {
                if ($user['gender'] !== 'woman') {
                    unset($users[$key]);
                }
            }
            break;
        case 'covid':
            foreach ($users as $key => $user) {
                if ($user['age'] < 60) {
                    unset($users[$key]);
                }
            }
            break;
        case 'dog':
        case 'cat':
        case 'horse':
        case 'parrot':
        case 'alligator':
            foreach ($users as $key => $user) {
                $index = array_search($_GET['filter'], $user['animals']);
                if (false === $index) {
                    unset($users[$key]);
                }
            }
            break;
        default:
            break;
    }
}
?>