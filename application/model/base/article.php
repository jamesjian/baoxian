<?php
namespace App\Model\Base;

use \Zx\Model\Mysql;

/*

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `content` text,
  `cat_id` tinyint(2) DEFAULT '1',
  `status` tinyint(1) DEFAULT '1' COMMENT '1: active, 0: inactive',
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
*/
class Article {

    /**
     *
     * @param int $id
     * @return 1D array or boolean when false 
     */
    public static function get_one($id) {
        $sql = "SELECT a.*, ac.title as cat_name
            FROM article a
            LEFT JOIN article_category ac ON a.cat_id=ac.id
            WHERE a.id=:id
        ";
		$params = array(':id'=>$id);
        return Mysql::select_one($sql, $params);
    }    
	/**
     *
     * @param string $where
     * @return 1D array or boolean when false 
     */
    public static function get_one_by_where($where) {
        $sql = "SELECT a.*, ac.title as cat_name
            FROM article a
            LEFT JOIN article_category ac ON a.cat_id=ac.id
            WHERE $where
        ";
		$params = array();
        return Mysql::select_one($sql, $params);
    }

	
    public static function get_all($where = '1', $offset = 0, $row_count = MAXIMUM_ROWS, $order_by = 'a.display_order', $direction = 'ASC') {
        $sql = "SELECT a.*, ac.title as cat_name
            FROM article a
            LEFT JOIN article_category ac ON a.cat_id=ac.id
            WHERE $where
            ORDER BY :order_by :direction
            LIMIT $offset, $row_count
        ";
		$params = array(':order_by'=>$order_by, ':direction'=>$direction);
        return Mysql::select_all($sql, $params);
    }
    public static function get_num($where = '1') {
        $sql = "SELECT COUNT(id) AS num
            FROM blog 
            WHERE $where
        ";
        $result = Mysql::select_one($sql);
		if ($result) {
			return $result['num'];
		} else {
			return false;
		}
    }
    public static function create($arr) {
        $sql = "INSERT INTO article SET " . Mysql::concat_field_name_and_value($arr);
        return Mysql::insert($sql);
    }

    public static function update($id, $arr) {
        $sql = "UPDATE article SET " . Mysql::concat_field_name_and_value($arr) .
                ' WHERE id=:id';
		$params = array(':id'=>$id);
        return Mysql::exec($sql, $params);
    }

    public static function delete($id) {
        $sql = "Delete FROM article WHERE id=:id";
		$params = array(':id'=>$id);
        return Mysql::exec($sql, $params);
    }

}