<?php
namespace App\Dao;

use Core\AbstractDao;
use PDO;

class MonsterDao extends AbstractDao
{

    function getMonsters(): array
    {
        $query = $this->db->prepare("select * from monster");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getMonsterById($idMonster): array
    {      
        $query = $this->db->prepare("select * from monster where id=:id");
        $query->execute([":id" => $idMonster]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function insertMonster($newMonster)
    {
        $query = $this->db->prepare("insert into monster values ('',:name,:nickname,:description,:specie,:element,:weakagainst,:lenghtmin,:lenghtmax,:generation,:agro)");
        $query->execute([
            ":name" => $newMonster["name"],
            ":nickname" => $newMonster["nickname"],
            ":description" => $newMonster["description"],
            ":specie" => $newMonster["specie"],
            ":element" => $newMonster["element"],
            ":weakagainst" => $newMonster["weakagainst"],
            ":lenghtmin" => $newMonster["lenghtmin"],
            ":lenghtmax" => $newMonster["lenghtmax"],
            ":generation" => $newMonster["generation"],
            ":agro" => $newMonster["agro"]
        ]);
    }

    function editMonster($newMonster)
    {
        $query = $this->db->prepare("update monster set name=:name,nickname=:nickname,description=:description,specie=:specie,element=:element,weakagainst=:weakagainst,lengthmin=:lenghtmin,lengthmax=:lenghtmax,generation=:generation,agro=:agro where id=:id");
        $query->execute([
            ":name" => $newMonster["name"],
            ":nickname" => $newMonster["nickname"],
            ":description" => $newMonster["description"],
            ":specie" => $newMonster["specie"],
            ":element" => $newMonster["element"],
            ":weakagainst" => $newMonster["weakagainst"],
            ":lenghtmin" => $newMonster["lenghtmin"],
            ":lenghtmax" => $newMonster["lenghtmax"],
            ":generation" => $newMonster["generation"],
            ":agro" => $newMonster["agro"],
            ":id" => $newMonster["id"]
        ]);
    }

    function deleteMonster($idMonster)
    {       
        $query = $this->db->prepare("delete from monster where id=:idMonster");
        $query->execute([":idMonster" => $idMonster]);
    }
}
