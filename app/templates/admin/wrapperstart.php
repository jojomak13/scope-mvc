<!-- Main wrapper  -->
<div id="main-wrapper">
    <!-- Page wrapper  -->
    <div class="page-wrapper" style="height:1200px;">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary"><?= $head ?></h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="/"><?= @$text_home ?></a></li>
                    <?php if(isset($main_page_head)) echo '<li class="breadcrumb-item"><a href="#">'. $main_page_head .'</a></li>';
                    ?>
                    <li class="breadcrumb-item"><a href="#"><?= @$head ?></a></li>
                   
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        
        <script>
        window.onload = function(){
        <?php
            $msgs = $this->messenger->getMessages();
            if(!empty($msgs)): foreach($msgs as $data):
        ?>
                msg("<?= $data[0] ?>", "<?= $data[1] ?>", "<?= $data[2]?>")
        <?php endforeach; endif;?>
            }
        </script>
             
            
       
