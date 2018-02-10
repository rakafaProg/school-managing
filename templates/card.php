

    <!-- This template recives an array named $params:

    [
        'image-url' => 'url',
        'name' => 'url',
        'meta' => 'url',
        'description' => ['1' , '2'],
        'buttons' => [
            [
                'color' => 'green',
                'href' => 'url',
                'text' => 'edit'
            ],
            [
                'color' => 'red',
                'href' => 'url',
                'text' => 'delete'
            ]
        ]
    ] -->


  <div class="card">
    <div class="content">
      <img class="ui circular image profile-img right floated" src="<?= $params['image-url'] ?>">
      <div class="header">
        <?= $params['name'] ?>
      </div>
      <div class="meta">
        <?= $params['meta'] ?>
      </div>
      <?php foreach ($params['description'] as $desc) { ?>
        <div class="description">
          <?= $desc ?>
        </div>
      <?php } ?>
    </div>

    <div class="extra content">
      <div class="ui two buttons">
        <?php foreach ($params['buttons'] as $btn) { ?>
            <a class="ui basic <?= $btn['color'] ?> button"
              href="<?= $btn['href'] ?>">
              <?= $btn['text'] ?>
            </a>
        <?php } ?>
      </div>
    </div>

  </div>
