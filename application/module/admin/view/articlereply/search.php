<?php
$link_search = HTMLROOT . 'admin/article/list/';
?>
<form action="<?php echo $link_search;?>" method="post">
Keyword:<input type="text" name="keyword" />
<input type="submit" name="submit" value="Search" />
</form>
