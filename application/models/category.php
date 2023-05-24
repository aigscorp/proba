<?php
class Category extends Model {

    public function insertItem($data){
        $title = "'" . $data['title'] . "'";
        $parent_id = "'" . $data['parent_id'] . "'";

        $sql = "INSERT INTO categories (title, parent_id) VALUES (" . $title . ", " . $parent_id . ")";
        $res = mysqli_query($this->connect(), $sql);

        if($res){
            $id = mysqli_insert_id($this->connect());
        }else{
            $id = null;
        }

        return $id;
    }

    public function updateItem($data){
        $id = "'" . $data['id'] . "'";
        $parent_id = "'" . $data['parent_id'] . "'";
        $title = "'" . $data['title'] . "'";
        $sql = "UPDATE categories SET title = " . $title . " WHERE id = " . $id . " and parent_id = " . $parent_id;

        $res = mysqli_query($this->connect(), $sql);
        return $res;
    }

    public function removeItem($id, &$arr){
        $sql = "SELECT c2.id as id FROM `categories` as c1, 
            (SELECT * from categories) as c2 WHERE c1.id = c2.parent_id and c1.id=" . $id;

        $r = mysqli_query($this->connect(), $sql);
        $rows = mysqli_num_rows($r);
        if($rows){
            for($i = 0; $i < $rows; $i++){
                $row = mysqli_fetch_assoc($r);
                $arr[] = $row['id'];
                $this->removeItem($row['id'], $arr);
            }
        }
    }

    public function deleteItem($data){
        $sql = "DELETE FROM categories WHERE id IN ('" . $data . "' )";
        $del = mysqli_query($this->connect(), $sql);
        return $del;
    }

}