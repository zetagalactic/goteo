<?php

$channel=$this->channel;

$this->layout("layout", [
    'bodyClass' => 'channel home',
    'title' => $channel->name,
    'meta_description' => $channel->description
    ]);

$this->section('content');

?>

<div id="sub-header-secondary" class="sub-header-channel">
    <div class="owner-info">
        <div class="avatar">
            <img src="<?php echo SITE_URL . '/image/' . $channel->logo->name; ?>" alt="<?php echo $channel->name ?>"/><br />
            <!-- enlaces sociales (iconitos como footer) -->
            <ul>
                <?php if (!empty($channel->facebook)): ?>
               <li class="facebook"><a href="<?php echo htmlspecialchars($channel->facebook) ?>" target="_blank">F</a></li>
                <?php endif ?>
                <?php if (!empty($channel->google)): ?>
                <li class="google"><a href="<?php echo htmlspecialchars($channel->google) ?>" target="_blank">G</a></li>
                <?php endif ?>
                   <?php if (!empty($channel->twitter)): ?>
                <li class="twitter"><a href="<?php echo htmlspecialchars($channel->twitter) ?>" target="_blank">T</a></li>
                <?php endif ?>
                <?php if (!empty($channel->linkedin)): ?>
                <li class="linkedin"><a href="<?php echo htmlspecialchars($channel->linkedin) ?>" target="_blank">L</a></li>
                <?php endif ?>
            </ul>                   
        </div>              
        <div class="info">
            <!-- Nombre y texto presentación -->
            <p><strong><?php echo $channel->name ?></strong> <?php echo $channel->description; ?></p>
            <!-- 2 webs -->
            <!--
            <ul>
                <?php $c=0; foreach ($user->webs as $link): ?>
                <li><a href="<?php echo htmlspecialchars($link->url) ?>" target="_blank"><?php echo htmlspecialchars($link->url) ?></a></li>
                <?php $c++; if ($c>=2) break; endforeach ?>
            </ul>
            -->
        </div>
    </div>
</div>


<div id="channel-main">
    <div id="side">
    
    <?php foreach ($this->side_order as $sideitem=>$sideitemName) {
            echo $this->insert("channel/partials/side/$sideitem");
    } ?>
    </div>

    <div id="content">
        <?php
        echo $this->insert("channel/partials/home/promotes");
        // primero los ocultos, los destacados si esta el buscador lateral lo ponemos anyway
        //if (isset($this->side_order['searcher'])) echo $this->insert("channel/partials/home/discover");
        //if (isset($this->side_order['categories'])) echo $this->insert("channel/partials/home/discat");
      
        /*if (isset($this->searcher['promote'])) echo $this->insert("channel/partials/home/promotes");
        else 
        {
            foreach ($this->order as $item=>$itemName)
                if (!empty($vars[$item])) echo $this->insert("channel/partials/home/$item");
        }*/
        ?>
    </div>
</div>

<?php $this->replace() ?>
<?php $this->section('footer') ?>

<?php if (isset($vars['side_order']['searcher']) || isset($vars['side_order']['categories'])) : ?>
<!-- funcion jquery para mostrar uno y ocultar el resto -->
<script type="text/javascript">
    $(function(){
        $(".show_cat").click(function (event) {
            event.preventDefault();

            if ($("#node-projects-"+$(this).attr('href')).is(":visible")) {
                $(".button").removeClass('current');
                $(".rewards").removeClass('current');
                $(".categories").removeClass('current');
                $(".node-projects").hide();
            } else {
                $(".button").removeClass('current');
                $(".rewards").removeClass('current');
                $(".categories").removeClass('current');
                $(".node-projects").hide();
                $(this).parents('div').addClass('current');
                $("#node-projects-"+$(this).attr('href')).show();
            }

        });
    });
</script>
<?php endif; ?>

<?php $this->append() ?>
