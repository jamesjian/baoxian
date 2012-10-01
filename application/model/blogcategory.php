<?php

namespace App\Model\Base;

use \Zx\Model\Mysql;

class Articlecategory {

    public static function get_one($id) {
        $sql = "SELECT *
            FROM article_category
            WHERE id=$id
        ";
        return Mysql::select_one($sql);
    }

    public static function get_all($offset = 0, $row_count = MAXIMUM_ROWS, $order_by = 'name', $direction = 'ASC', $where = '1') {
        $sql = "SELECT *
            FROM article_category
            WHERE $where
            LIMIT $offset, $row_count
            ORDER BY $order_by $direction
        ";
        return Mysql::select_all($sql);
    }

    public static function create($arr) {
        $sql = "INSERT INTO article_category SET " . Mysql::concat_field_name_and_value($arr);
        return Mysql::insert($sql);
    }

    public static function update($id, $arr) {
        $sql = "UPDATE article_category SET " . Mysql::concat_field_name_and_value($arr) .
                ' WHERE id=$id';
        return Mysql::exec($sql);
    }

    public static function delete($id) {
        $sql = "Delete FROM article_category WHERE id=$id";
        return Mysql::exec($sql);
    }

}