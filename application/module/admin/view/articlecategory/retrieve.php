<?php
\Zx\Message\Message::show_message();
include 'search.php';
$create_link = ADMIN_HTML_ROOT . 'articlecategory/create';
?>
<a href="<?php echo $create_link;?>">Create</a>
<?php
if ($cat_list) {
$link_prefix = ADMIN_HTML_ROOT . "articlecategory/retrieve/$current_page/";
$next_direction = ($direction == 'ASC') ? 'DESC' : 'ASC';  //change direction
$link_postfix =  "/$next_direction/$search";
$link_id = $link_prefix . 'id' . $link_postfix;
$link_title = $link_prefix . 'title' . $link_postfix;
$link_title_en = $link_prefix . 'title_en' . $link_postfix;
$link_url = $link_prefix . 'url' . $link_postfix;
$link_display_order = $link_prefix . 'display_order' . $link_postfix;
$link_status = $link_prefix . 'status' . $link_postfix;
$direction_img = ($direction == 'ASC') ? HTML_ROOT . 'image/icon/up.png' : 
                                         HTML_ROOT . 'image/icon/down.png'; 
\Zx\Message\Message::show_message();
?>
<table>
<tr>
<th><a href='<?php echo $link_id;?>'>id</a><img src="<?php echo $direction_img;?>" /></th>
<th><a href='<?php echo $link_title;?>'>title</a><img src="<?php echo $direction_img;?>" /></th>
<th><a href='<?php echo $link_title_en;?>'>title(en)</a><img src="<?php echo $direction_img;?>" /></th>
<th><a href='<?php echo $link_url;?>'>URL</a><img src="<?php echo $direction_img;?>" /></th>
<th>Articles</th>
<th><a href='<?php echo $link_display_order;?>'>display_order</a><img src="<?php echo $direction_img;?>" /></th>
<th><a href='<?php echo $link_status;?>'>status</a><img src="<?php echo $direction_img;?>" /></th>
<th>delete</th>
<th>update</th>
</tr>

<?php
    foreach ($cat_list as $cat) {
	$cat_id = $cat['id'];
	$link_article = ADMIN_HTML_ROOT . 'article/retrieve_by_cat_id/' . $cat_id;
	$link_delete = ADMIN_HTML_ROOT . 'articlecategory/delete/' . $cat_id;
	$link_update = ADMIN_HTML_ROOT . 'articlecategory/update/' . $cat_id;
?>
<tr>
	<td><?php echo $cat['id'];?></td>
	<td><?php echo $cat['title'];?></td>
	<td><?php echo $cat['title_en'];?></td>
	<td><?php echo $cat['url'];?></td>
	<td><a href='<?php echo $link_article;?>'>Articles</a></td>
	<td><?php echo $cat['display_order'];?></td>
	<td><?php echo $cat['status'];?></td>
	<td><a href='<?php echo $link_delete;?>' class="delete_article_cat">delete</a></td>
	<td><a href='<?php echo $link_update;?>'>update</a></td>
</tr>
<?php
    }
	?>
	</table>
<?php
$link_prefix = ADMIN_HTML_ROOT . 'articlecategory/retrieve/';	
$link_postfix = "/$order_by/$direction/$search";
include ADMIN_VIEW_PATH . 'templates/pagination.php';
} else {
	echo 'No record.';
}




