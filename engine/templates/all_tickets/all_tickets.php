<?php require_once ROOT.'/engine/templates/header.php'; ?>
    <div class="row tickets_top_menu">
        <div class="col-sm-8 col-md-8 col-lg-7 tickets_left_part">
            <ul>
                <li id="tickets_logo"><a href="#">LOGO</a></li>
                <li><a href="#">КАРТА</a></li>
                <li><a href="#">КАМЕРЫ</a></li>
                <li><a href="#">ТАБЛО</a></li>
            </ul>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-5 tickets_right_part">
            <div class="main-menu">
                <span>Игорь Дементьев</span>
                <img id="tickets_show_menu" src="/engine/templates/assets/img/open_menu.png">
                <div class="tickets_menu">
                    <img src="/engine/templates/assets/img/tickets_triangle.png">
                    <p>Области:</p>
                    <ul>
                        <li>Днепропетровская обл.</li>
                        <li>Черкасская обл.</li>
                        <li>Киевская обл.</li>
                        <li>Львовская обл.</li>
                        <li>Полтавская обл.</li>
                        <li>Харьковская обл.</li>
                        <li>Мои тикеты</li>
                        <li>Выйти </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row tickets_content">
     <?php foreach($all_tickets as $value): ?>
      <div class="col-sm-4 col-md-4 col-lg-4 tickets_block">
          <div class="tickets_block_head">
            <span><?=$value['id']?></span>
            <span class=" <?php if ($value['finish'] == 1) { echo 'check-text'; } else { echo 'open-text'; } ?> ">
              <?php if ($value['finish'] == 1) { echo 'НА ПРОВЕРКЕ'; } else if($value['finish'] == 0){echo "ЗАКРЫТ";} else { echo 'ОТКРЫТ'; } ?> 
              <a href=""><img src="/engine/templates/assets/img/comments.png"> 3</a>
              </span>
          </div>
          <div class="tickets_block_content">
            <div>
              <p><span>ДАТА</span> <br><?=$value['date']?></p>
              <p><span>СТАНЦИЯ</span> <br> <?$arr=$this->parseAddress($value['address']); echo $arr[road]." ".$arr[km]?></p>
            </div>
            <p><span><br>ПРИМЕЧАНИЕ</span> <br><?=$value['note']?></p>
          </div>
          <div class="tickets_block_footer">
            <a href="#">Смотреть</a>
            <a href="#">Завершить</a>
          </div>
      </div>
      <?php endforeach ?>
    </div>
<?php require_once ROOT.'/engine/templates/footer.php'; ?>