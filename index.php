<?php
include "output.php";
class DirectoryModel {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getDescendantsAsTree($parentId) {
        $stmt = $this->pdo->prepare("
            SELECT id, name
            FROM directory
            WHERE parent_id = :parentId
        ");
        $stmt->bindParam(':parentId', $parentId, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tree = [];
        foreach ($results as $result) {
            $tree[$result['id']] = [
                'name' => $result['name'],
                'children' => $this->getDescendantsAsTree($result['id']),
            ];
        }
        return $tree;
    }


    public function getDescendantsAsFlatList($parentId) {
        $stmt = $this->pdo->prepare("
            SELECT id, name
            FROM directory
            WHERE parent_id = :parentId
        ");
        $stmt->bindParam(':parentId', $parentId, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $descendants = [];
        foreach ($results as $result) {
            $descendants[] = $result;
            $descendants = array_merge($descendants, $this->getDescendantsAsFlatList($result['id']));
        }
        return $descendants;
    }
}

