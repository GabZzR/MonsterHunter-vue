<?php

namespace App\Controller;

use App\Dao\MonsterDao;


class MainController
{
    function getMonsters()
    {
   header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
        $dao = new MonsterDao();
        $dataRaw = $dao->getMonsters();
    
        echo json_encode($dataRaw);
    }

    function getMonsterById($idMonster)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $dao = new MonsterDao();
        $dataRaw = $dao->getMonsterById($idMonster);
 
        echo json_encode($dataRaw);
    }

    function newMonster()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        $newMonster = json_decode(file_get_contents('php://input'), true);
        if (empty($newMonster)) {
            
                //on degage
        } else {
            $dao = new MonsterDao();
            $dao->insertMonster($newMonster);
        }
    }

    function deleteMonster()
    {
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Content-Type: application/json");

        $updatedMonster = json_decode(file_get_contents('php://input'), true);
        
        $idMonster = filter_var($updatedMonster["id"],FILTER_VALIDATE_INT);

echo $idMonster;
        $dao = new MonsterDao();
        $dao->deleteMonster($idMonster);
    }

    function editMonster()
    {
        $updatedMonster = json_decode(file_get_contents('php://input'), true);
        if (empty($updatedMonster)) {
            
                //on degage
        } else {
            $dao = new MonsterDao();
            $dao->editMonster($updatedMonster);
        }        
    }
}
