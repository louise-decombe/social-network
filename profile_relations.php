
            <div class="test">  
                <article>
                    <span>
                        VOS RELATIONS
                    </span>
                    <img class="underline_wave" src="img/wave.png" alt="underline_wave">
                
                    <?php 
                        foreach ($user_followers as $followers){ ?>

                        <div class="followers">
                            <img class="followers_img" src="<?=$followers['photo'] ?>" alt="follower_mini_pic">
                            <span><?=$followers['firstname']?><?=$followers['lastname']?></span>
                        </div>

                    <?php
                        }
                    ?>
                </article>
            </div>
           