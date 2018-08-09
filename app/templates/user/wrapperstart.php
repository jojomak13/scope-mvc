<div class="wrapper">
    <div class="inner-page">
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
    
             