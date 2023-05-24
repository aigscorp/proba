<?php
    require_once 'application/core/model.php';
    require_once 'application/models/category.php';

    $cat = new Category();

    $data = file_get_contents('php://input');
    $res = json_decode($data, true);

//    echo json_encode(['status'=>$data]);

    if($res['type'] == 'add'){
        $out = $cat->insertItem($res);
        if($out){
            echo json_encode(['status'=>'success', 'id'=>$out]);
        }else{
            echo json_encode(['status'=>'failed', 'id'=>$out]);
        }
        exit;
    }
    if($res['type'] == 'edit'){
        $out = $cat->updateItem($res);
        echo json_encode(['status'=>'success', 'id'=>$out, 'res'=>$res]);
        exit;
    }

    if($res['type'] == 'remove'){
        $brr = [];
        $cat->removeItem($res['id'], $brr);
        $brr[] = $res['id'];

        $str = implode("','", $brr);
//        $sql = "DELETE FROM categories WHERE id IN ('" . $str . "' )";
//        $del = mysqli_query($db, $sql);
        $del = $cat->deleteItem($str);

        echo json_encode(['status'=>'deleted', 'del'=>$del]);
        exit;
    }

?>
