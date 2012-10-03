<?php
include 'search.php';
?>

<?php
if ($blog_list) {

$link_title = HTML_ROOT . 'admin/blog/list/orderby_direction_page_number';
$link_rank = HTML_ROOT . 'admin/blog/list/orderby_direction_page_number';
?>
<table>
<tr>
<th><a href='<?php echo $link_title;?>'>title</a></th>
<th>action</th>
</tr>
<?php
    foreach ($blog_list as $blog) {
	$blog_id = $blog['id'];
	$link_delete = HTML_ROOT . 'admin/blog/delete/' . $blog_id;
	$link_update = HTML_ROOT . 'admin/blog/update/' . $blog_id;
?>
<tr>
<td><?php echo $blog['title'];?></tr>
<td><a href='<?php echo link_delete;?>'>delete</a></td>
<td><a href='<?php echo link_update;?>'>update</a></td>
</tr>
<?php
    }
	?>
	</table>
<?php
}
$link_prefix = ADMIN_HTML_ROOT . 'blog/retrieve/';	
$link_postfix = "$orderby/$direction";
include ADMIN_VIEW_PATH . 'templates/pagination.php';




