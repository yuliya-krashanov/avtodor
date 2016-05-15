<?php require_once ROOT.'/engine/templates/header.php'; ?>
<?php 
  
  // example id for getStationRow
  $id_station = 1;
  // get
  $getDeviceValue = $this->getDeviceValue();
  $getStationRow = $this->getStationRow($id_station);

?>
     <div class="container">
       <div class="row">
           <div class="sidebar">
               <div class="row marginLeft">
                   <h1>M08 567 <span><?php echo $lang_arr['index_km']?></span>
                       <img src="engine/templates/assets/img/pencil.png">
                   </h1>
                   <div class="online"></div>
                   <div class="work-online"><?php echo $lang_arr['pass_normal']?></div>
               </div>
               <div class="row">
                   <ul class="nav nav-pills">
                       <li><a href="?opt=passport&tmp=meteo_info"><div><img src="engine/templates/assets/img/menu1.png"></div><span><?php echo $lang_arr['pass_meteo_info']?></span></a></li>
                       <li><a href="?opt=passport&tmp=devices"><div><img src="engine/templates/assets/img/menu2.png"></div><span><?php echo $lang_arr['pass_devices']?></span></a></li>
                       <li><a href="?opt=passport&tmp=history"><div><img src="engine/templates/assets/img/menu3.png"></div><span><?php echo $lang_arr['pass_history']?></span></a></li>
                       <li class="active"><a href="?opt=passport&tmp=equipment"><div><img src="engine/templates/assets/img/menu4.png"></div><span><?php echo $lang_arr['pass_equip']?></span></a></li>
                       <li><a href="?opt=passport&tmp=all_indicators"><div><img src="engine/templates/assets/img/menu5.png"></div><span><?php echo $lang_arr['pass_all_indicat']?></span></a></li>
                   </ul>
               </div>
           </div>
        <div class="content">
          <div class="row page5_block1">
              <table class="table table-striped" id="equipment-table-left" rel="<?php echo $id_station; ?>">                  
                  <tr>
                    <th><?php echo $lang_arr['pass_device']?> </th>
                    <th>imei</th>
                    <th><?php echo $lang_arr['pass_character']?></th>
                  </tr>
                  <?php 
                      foreach ($getStationRow as $key => $value) {
                          $getDevices_by_id = $this->getDevices_by_id($value);
                          foreach ($getDevices_by_id as $k => $v) {                      
                            echo ' <tr id="device'.$v['id'].'" rel="'.$v['id'].'">
                                    <td>'.$v['id'].'</td>
                                    <td>
                                     '.$v['imei'].'
                                      <div></div>
                                    </td>
                                  </tr>';
                          }
                      }
                  ?>
              </table>
              <div class="page5_table2">
                  <table class="table"> 
                    <tr>
                      <td>ip</td>
                      <td id="table2_ip">10.151.237.157</td>
                    </tr>
                    <tr>
                      <td>sim</td>
                      <td id="table2_sim">3806377434</td>
                    </tr>
                    <tr>
                      <td>id</td>
                      <td id="table2_id">59</td>
                    </tr>
                    <tr>
                      <td><?php echo $lang_arr['pass_period_sec']?></td>
                      <td id="table2_period">600</td>
                    </tr>
                    <tr>
                      <td><?php echo $lang_arr['pass_last_connect']?></td>
                      <td id="table2_last_connect">24/03/15  17:06:49</td>
                    </tr>
                    <tr>
                      <td><?php echo $lang_arr['pass_sign_lvl']?></td>
                      <td id="table2_sq">-88dbm</td>
                    </tr>
                    <tr>
                      <td><?php echo $lang_arr['pass_voltage']?></td>
                      <td id="table2_pv">12.95V</td>
                    </tr>
                    <tr>
                      <td><?php echo $lang_arr['pass_soft_v']?></td>
                      <td id="table2_ver">MSC_V1.0</td>
                    </tr>
                    <tr>
                      <td><?php echo $lang_arr['pass_discl']?></td>
                      <td><?php echo $lang_arr['pass_norm']?></td>
                    </tr>
                  </table>  
                  <div id="link1">
                      <a href="#"><?php echo $lang_arr['pass_rem_dev_hub']?></a>
                  </div>                 
              </div>
          </div>

          <div class="row page5_table3">
              <table class="table" id="add_device_table"> 
                <tr>
                  <th><?php echo $lang_arr['pass_add_dev_hub']?></th>
                  <th>IMEI</th>
                  <th>SIM</th>
                  <th>ID</th>
                </tr>
                  <?php 
                      foreach ($getDeviceValue as $key => $value) {
                          $getDevices_by_id = $this->getDevices_by_id($value);
                          foreach ($getDevices_by_id as $k => $v) {                      
                            echo ' <tr id="add_device'.$v['id'].'">
                                    <td>'.$v['id'].'</td>
                                    <td id="imei'.$v['id'].'">'.$v['imei'].'</td>
                                    <td>'.$v['phone'].'</td>
                                    <td>'.$v['id'].'</td>
                                    <td id="checkfix"><input rel="'.$v['id'].'" type="checkbox" name="itemSelect[]"></td>
                                  </tr>';
                          }
                      }
                  ?>

              </table>  
          </div>         
          <a href="#" id="del_link"><?php echo $lang_arr['pass_del_dot']?></a>
          <a href="#" id="save_link"><?php echo $lang_arr['pass_save']?></a>
        </div>
      </div>
    </div>
<?php require_once ROOT.'/engine/templates/footer.php'; ?>