<!DOCTYPE html>
<?php
    include "includes/header.php";
?>

<body style="background-color:#fffefb;">
    <!-- Navigation -->
    <?php
        include "includes/nav.php";
    ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
                <?php
                    if(isset($_GET['cat'])){
                        $c_id = $_GET['cat'];
                        $query = "SELECT * FROM ".POSTS_TABLE." WHERE post_cater_id = {$c_id} AND post_status = 'Published';";
                        
                        $result = mysqli_query($connect, $query);
                        echo '<div id = "alert_edit" >';
                        query_confirm($result);
                        echo '<div>';
                        if(mysqli_num_rows($result) > 0){
                ?>
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    
                            while($row = mysqli_fetch_assoc($result)){
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_tags = $row['post_tags'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_view_count = $row['post_view_count'];
                                $post_status = $row['post_status'];
                                $post_cater_id = $row['post_cater_id'];
                                $post_content = $row['post_content'];
                ?>
                
                <h1 class="page-header">
                    <a href = "post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>                    
                </h1>

                <p class="lead">
                    by 
                    <a href="author_post.php?author=<?php echo $post_author; ?>">
                        <?php echo $post_author; ?>
                    </a>
                </p>

                <p>
                    <span class = "glyphicon glyphicon-time"></span> 
                    Posted on 
                    <?php echo "{$post_date}"; ?>
                </p>
                
                <p style='font-family:Rockwell;'>
                    <?php echo $post_view_count ?> views
                </p>

                <p style='font-family:Rockwell;'>
                    <strong>
                        <?php echo "# {$post_tags}"; ?>
                    </strong>
                </p>


                <div style='padding-bottom: 50px; padding-top: 40px;'>
                    <img class = "img-responsive" src = "image/<?php echo $post_image;?>" alt="<?php echo $post_image;?>">
                </div>

                <p>
                        <div style="overflow:hidden; white-space: nowrap; text-overflow: ellipsis; height: 200px; margin-bottom:10px;">
                            <?php
                                $post_content = base64_decode($post_content);
                                echo $post_content;
                            ?> 
                        </div>
                                
                                <div class="mt-4">
                                    <a class = "btn btn-primary" href = "post.php?p_id=<?php echo $post_id; ?>">
                                        Read More <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </div> 
                                <hr>
                    <?php
                            }
                        }
                        else{
                            echo"
                                <div class='col-md-8'>
                                    <p class = 'lead'>
                                        Sorry, No Article in this Catergory now
                                        <br>
                                        Here are other categories......            
                                    </p>
                                    <ol class='list-group list-group-numbered' style='font: size 500px; font-family: Helvetica, Arial, sans-serif;'>
                            ";
                            global $connect;

                            $q = "SELECT * FROM ". CATER_TABLE;
                            $select_cater_sidebar = mysqli_query($connect, $q);
                            if($select_cater_sidebar){
                                while($fetch_row = mysqli_fetch_assoc($select_cater_sidebar)){
                                    $title = $fetch_row['cat_title'];
                                    $id = $fetch_row['cat_id'];
                                    echo "
                                        <li class='list-group-item'>
                                            <a href='category.php?cat={$id}'> {$title} </a>
                                        </li>
                                    ";
                                }
                            }
                             
                            echo"
                                    </ol>
                                    <a class = 'btn btn-primary' href = 'index.php'>
                                        Back to the home page <span class='glyphicon glyphicon-chevron-right'></span>
                                    </a>
                                </div>
                            ";
                        }
                    ?>
                </p>
                
                <?php 
                    }
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
                include "includes/sidebar.php";
            ?>
    </div>
        <!-- /.row -->

        <hr>
        <?php
            include "includes/footer.php";
        ?>

</body>

</html>
