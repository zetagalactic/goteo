<?php if($this->projects):
  $config = $this->channel->getConfig();
  $map_config = $config['map'];

  $params = [
    'channel' => $this->channel->id
  ];

  if ($map_config['geojson']) {
    $params['geojson'] = urlencode($map_config['geojson']);
  }

?>

<div class="section map">
  <div class="container">
    <div class="row">
      <h2 class="title"><span class="icon icon-news icon-3x"></span><?= $this->t('channel-call-map-section-title') ?></h2>

      <?php 
        $summary = $this->channel->getSummary();
      ?>
      <div class="row impact-data">
        <div class="col-sm-4 col-md-4 item">
            <span><?= amount_format($summary['amount']) ?></span>
            <div class="description">
                <?= $this->t('channel-call-impact-data-amount') ?>
            </div>
        </div>
        <div class="col-sm-3 col-md-4 item">
              <span><?= $summary['projects'] ?></span>
            <div class="description">
                <?= $this->t('channel-call-impact-data-projects')  ?>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 item">
            <span> <?= $summary['investors'] ?></span>
            <div class="description">
              <?= $this->t('channel-call-impact-data-investors') ?>
            </div>
        </div>
      </div>

      <iframe src="/map?<?= http_build_query($params) ?>"
            width="100%"
            height="500"
            style="border:none;"
            allowfullscreen></iframe>
    </div>
  </div>
</div>

<?php endif; ?>