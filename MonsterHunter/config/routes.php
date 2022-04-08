<?php
use App\Controller\MainController;

$router->map("GET","/monsters",function (){ 
$mainController = new MainController();
$mainController->getMonsters();
});


$router->map("GET","/monster/[i:id]",function ($id){

$mainController = new MainController();
$mainController->getMonsterById($id);

    
});

$router->map("POST","/monster",function(){

$mainController = new MainController();
$mainController->newMonster();

});

$router->map("POST","/monster/delete",function(){
    $mainController = new MainController();
    $mainController->deleteMonster();

});

$router->map("PUT","/monster/edit",function(){
    $mainController = new MainController();
    $mainController->editMonster();

});