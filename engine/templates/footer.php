    <!--              main library            -->
    <script src="engine/templates/assets/js/jquery.min.js"></script>
    <script src="engine/templates/assets/js/bootstrap.min.js"></script>
    <!--              ajax Query                  -->
    <script src="engine/templates/assets/js/ajaxQuery.js"></script>
    <script src="engine/templates/assets/js/MyScript.js"></script>
    <!--              google settings           -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAP4CxdPWSqP9zo7zNeR7aCW9gU6EGJHBQ"></script>
<!--    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->
    <script src="engine/templates/assets/js/googleSettings.js"></script>
    <!--              login Page              -->
    <script src="engine/templates/assets/js/highcharts.js"></script>
    <script src="engine/templates/assets/js/exporting.js"></script>
    <script src="engine/templates/assets/js/settings-graph.js"></script>
    <script src="engine/templates/assets/js/passport.js"></script>
    <script src="engine/templates/assets/js/classie.js"></script>
    <?php
    if ($_GET['opt'] == 'auth') {
        ?>
            <script src="engine/templates/assets/js/main.js"></script>
        <?php
    }
    if ($_GET['opt'] == 'admin') {
        ?>
        <script src="engine/templates/assets/js/all_tickets.js"></script>
        <?php if ($_GET['tmp'] == 'settings') { ?>
            <script src="engine/templates/assets/js/settings-page.js"></script>
            <script src="engine/templates/assets/js/jquery.rwdImageMaps.min.js"></script>
            <script src="engine/templates/assets/js/jquery.maphilight.resize.min.js"></script>
            <script src="engine/templates/assets/js/responsive-map-main.js"></script>
        <?php
        }
    }
    if ($_GET['opt'] == 'passport') {
        if($_GET['tmp'] == 'history'){ ?>
            <script src="engine/templates/assets/js/jquery.uploadify.min.js"></script>
            <script src="engine/templates/assets/js/passport-history.js"></script>
        <?php }
        if($_GET['tmp'] == 'meteo_info' || $this->tmp == 'meteo_info'){ ?>
            <script src="engine/templates/assets/js/drawGraph.js"></script>
        <?php }
        if($_GET['tmp'] == 'all_indicators'){ ?>
            <script src="engine/templates/assets/js/all_indicators.js"></script>
        <?php }?>
        <script src="engine/templates/assets/js/passport.js"></script>
        <script src="engine/templates/assets/js/exporting.js"></script>
        <script src="engine/templates/assets/js/settings-graph.js"></script>
        <script src="engine/templates/assets/js/moment.js"></script>
        <script src="engine/templates/assets/js/daterangepicker.js"></script>
        <?php
    }
    if ($_GET['opt'] == 'index' || $_GET['opt'] == '') {
        ?>
    <!--        Yuliya        -->
    <script src="engine/templates/assets/js/sidebarEffects.js"></script>
    <script src="engine/templates/assets/js/main_y.js"></script>
    <?php }
    if ($_GET[opt] == 'all_tickets') {
        ?>
        <script src="engine/templates/assets/js/all_tickets.js"></script>
    <?php } ?>

</body>
</html>