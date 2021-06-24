

<article class='mb-3'>
    <h2>
        <a href="./post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
    </h2>
    <p class="lead">
        by <a href="./view_by_author.php?author_name=<?php echo $post_author; ?>"><?php echo $post_author ?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
    <hr>
    <a href="./post.php?post_id=<?php echo $post_id ?>">
        <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="">
    </a>
    
    <hr>
    <p><?php echo shorten_string($post_content, 150) ?></p>
    <a class="btn btn-primary" href="./post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
</article>

