
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
                       <li class="active"><a href="?opt=passport&tmp=devices"><div><img src="engine/templates/assets/img/menu2.png"></div><span>ПРИБОРЫ</span></a></li>
                       <li><a href="?opt=passport&tmp=history"><div><img src="engine/templates/assets/img/menu3.png"></div><span>ИСТОРИЯ</span></a></li>
                       <li><a href="?opt=passport&tmp=equipment"><div><img src="engine/templates/assets/img/menu4.png"></div><span>КОМПЛЕКТАЦИЯ</span></a></li>
                       <li><a href="?opt=passport&tmp=all_indicators"><div><img src="engine/templates/assets/img/menu5.png"></div><span>ВСЕ ПОКАЗАТЕЛИ</span></a></li>
                   </ul>
               </div>
           </div>
        <div class="content">
            <div class="row">  
                test
            </div>
        </div>
<?php require_once ROOT.'/engine/templates/footer.php'; ?>