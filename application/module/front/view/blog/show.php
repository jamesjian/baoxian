<div class='zx-front-left'>			
    <div class='zx-front-left1'>
        <?php include FRONT_VIEW_PATH . 'templates/left_google_ads.php'; ?>
    </div>	
    <div class='zx-front-left2'>
<?php
if ($blog) {
echo $blog->cat_name, BR;
?>
<article>
	<header>
<?php

echo $blog->title, BR;
?>
</header>
<section>
<div>
<?php
echo $blog->description, BR;
?>
</div>
</section>
</article>
<?php
}
?>
    </div>
</div>
<div class='zx-front-right'>
    <div class='zx-front-right1'>
        <?php
        //tag cloud or search
        include 'tag_cloud.php';
        ?>
    </div>	
    <div class='zx-front-right2'>
        <?php include FRONT_VIEW_PATH . 'templates/right_google_ads.php'; ?>
    </div>
    <div class='zx-front-right3'>
        <?php
//related contents
        if ($related_blogs) {
            ?>
            <nav>
                <ul>
                    <?php
                    foreach ($related_blogs as $blog) {
                        $read_more_link = HTMLROOT . 'front/blog/show/' . $blog['id'];
                        ?>		
                        <li><?php echo "<a href='$read_more_link'>" . $blog->title . "</a>";
                        ?>
                        </li>
        <?php
    }//foreach
    ?>
                </ul>
            </nav>	
            <?php
        }//if ($related_blogs)
        ?>
    </div>
</div>
