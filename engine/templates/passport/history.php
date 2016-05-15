<?php require_once ROOT.'/engine/templates/header.php'; ?>
     <div class="container">
       <div class="row">
           <div class="sidebar">
               <div class="row marginLeft">
                   <h1>M08 567 <span>км</span>
                       <img src="engine/templates/assets/img/pencil.png">
                   </h1>
                   <div class="online"></div>
                   <div class="work-online">РАБОТАЕТ</div>
               </div>
               <div class="row">
                   <ul class="nav nav-pills">
                       <li><a href="?opt=passport&tmp=meteo_info"><div><img src="engine/templates/assets/img/menu1.png"></div><span>МЕТЕОИНФА</span></a></li>
                       <li><a href="?opt=passport&tmp=devices"><div><img src="engine/templates/assets/img/menu2.png"></div><span>ПРИБОРЫ</span></a></li>
                       <li class="active"><a href="?opt=passport&tmp=history"><div><img src="engine/templates/assets/img/menu3.png"></div><span>ИСТОРИЯ</span></a></li>
                       <li><a href="?opt=passport&tmp=equipment"><div><img src="engine/templates/assets/img/menu4.png"></div><span>КОМПЛЕКТАЦИЯ</span></a></li>
                       <li><a href="?opt=passport&tmp=all_indicators"><div><img src="engine/templates/assets/img/menu5.png"></div><span>ВСЕ ПОКАЗАТЕЛИ</span></a></li>
                   </ul>
               </div>
           </div>
        <div class="col-xs-11 col-sm-9 col-md-9 col-lg-9 content">
             <div class="tickets-history-panel">
                  <h3>История тикетов</h3>
              </div>

              <div class="tickets-management">
                  <table id="tickets-table">
                      <thead>
                          <tr class="tickets-history-header">
                              <th>Тикет</th>
                              <th>Статус</th>
                              <th>Дата</th>
                              <th>Ответственный</th>
                              <th>Примечание</th>
                          </tr>
                      </thead>
                      <tbody>
                           <?php foreach($all_tickets as $value):?>
                                <tr class="bg-tbl">
                                    <td class="b-r-2 i-checkbox">
                                        <div class="checkbox-wrap custom-checkbox-style">
                                            <input id="<?=$value['id']?>" data-check="<?=$value['id']?>" type="checkbox">
                                            <label for="check1">
                                            </label>
                                        </div>
                                        <div class="checkbox-text"><?=$value['id']?></div>
                                    </td>
                                    <td class="b-r history_ticket_status <?php if ($value['finish'] == 1) { echo 'check-text'; } else { echo 'open-text'; } ?>  b-r-stat">
                                        <?php if ($value['finish'] == 1) { echo 'На проверке'; } else if($value['finish'] == 0){echo "Закрыт";} else { echo 'Открыт'; } ?>
                                    </td>
                                    <td class="b-r"><?=$value['date']?></td>
                                    <td class="b-r"><?=$value['liable']?></td>
                                    <td class="b-r"><?=$value['note']?></td>
                                    <td class="b-r-2 hidd-text click"><p id="<?=$value['id']?>">Смотреть</p></td>
                                </tr>
                            <?php endforeach ?>
                      </tbody>
                  </table>
                  <div class="tickets-control-panel">
                      <button class="control-btn" id="history_del_ticket">Завершить</button>
                      <button class="control-btn" id="history_process_ticket">Взять в работу</button>
                  </div>
              </div>

              <div class="ticket-creator">
                  <div class="ticket-creator-top-panel">
                      <div class="row">
                          <div class="col-sm-2">
                              <p>
                              Тикет: <span id="tickets_id"><?php echo $get_message['0']['id_alarm_tickets']; ?></span>
                              </p>
                          </div>
                          <div class="col-sm-8">
                              <p>Тип: <span id="tickets_note"><?php echo $get_message['0']['note']; ?></span></p>
                          </div>
                          <div class="col-sm-2">
                              <p>Дата: <span id="tickets_date"><?php echo $get_message['0']['date']; ?></span></p>
                          </div>
                      </div>
                  </div>
                  <div class="ticket-creator-main-section">
                      <div class="row">
                          <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7 left-side">
                              <div class="tickets-wrap">
<!--                                  tickets set ajax-->
                              </div>
                          </div>
                          <div class="col-sm-5 col-md-5 col-xs-5 col-lg-5 right-side">
                              <div class="form-wrap">
                                  <h3>Добавить комментарий</h3>
                                  <form action="" method="POST" id="loadImage" enctype="multipart/form-data">
                                      <textarea name="" id="message_sender" cols="30" rows="10" placeholder="Ваш комментарий"></textarea>
                                      <div class="buttons-panel">
                                         <input class="control-btn" id="message_send" type="submit" id="add_message" value="Добавить" />
                                         <div class="input-file-history link">Добавить файл
                                         	<input type="file" name="my_file" id="my_file" value="Добавить файл">
                                         </div>
                                         <input id="main-user-id" type="hidden" value="<?=$_SESSION['user_id']?>">
                                         <input id="main-user-name" type="hidden" value="<?=$_SESSION['name']?>">
                                         <input id="main-user-lastname" type="hidden" value="<?=$_SESSION['lastname']?>">
                                      </div>
                                     <div class="upload-indicators-panel">
                                        <!-- ajax -->
                                     </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        </div>
      </div>
    </div>
<?php require_once ROOT.'/engine/templates/footer.php'; ?>