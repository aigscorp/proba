<?php
class Model_Main extends Model {

    public function get_cat()
    {

        $sql = "SELECT * FROM categories";
        $res = mysqli_query($this->connect(), $sql);
        if (!$res) {
            return NULL;
        }

        $arr_cat = [];
        $rows = mysqli_num_rows($res);
        if ($rows != 0) {
            for ($i = 0; $i < $rows; $i++) {
                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                if (empty($arr_cat[$row['parent_id']])) {
                    $arr_cat[$row['parent_id']] = array();
                }
                $arr_cat[$row['parent_id']][] = $row;
            }

            return $arr_cat;
        }
    }

    public function is_cat($arr, $parent_id=0){
        if(empty($arr[$parent_id])) return 0;
        return 1;
    }

    public function view_cat($arr, $parent_id=0){

        if(empty($arr[$parent_id])) return;
        $str = '<ul class="main">';

        for($i = 0; $i < count($arr[$parent_id]); $i++){
            $li = '<li>';
            $b = $this->is_cat($arr, $arr[$parent_id][$i]['id']);
            if($b == 1){
                $str .= '<div style="display: flex;" class="hide-brand"><span class="tree_open"></span>';
            }else{
                $str .= '<div>';
            }
            $data = $li . '<a href="#" class="item" data-cat="' . $arr[$parent_id][$i]['id'] . '" data-parent="' .
                $parent_id . '">' . $arr[$parent_id][$i]['title'] . '</a>';
            $str .= $data;
            $str .= $this->view_cat($arr, $arr[$parent_id][$i]['id']);
            $str .= '</div></li>';
        }

        $str .= '</ul>';
        return $str;
    }

}