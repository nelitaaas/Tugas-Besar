<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php 
        
                    Yii::app()->clientScript->registerCoreScript('jquery');
                    $cs=Yii::app()->clientScript;
                    $cs->registerScriptFile(Yii::app()->baseUrl . '/plugins/elrte/js/elrte.min.js', CClientScript::POS_HEAD);
                    $cs->registerScriptFile(Yii::app()->baseUrl . '/plugins/elfinder/js/elfinder.min.js', CClientScript::POS_HEAD);
                    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/demo.formelements.js', CClientScript::POS_HEAD);
                    $cs->registerCssFile(Yii::app()->baseUrl . '/plugins/elrte/css/elrte.full.css');
                    $cs->registerCssFile(Yii::app()->baseUrl . '/plugins/elfinder/css/elfinder.css');
                    $cs->registerScriptFile(Yii::app()->baseUrl . '/assets/48d296df/jui/js/jquery-ui-i18n.min.js', CClientScript::POS_END);
                    $cs->registerScriptFile(Yii::app()->baseUrl . '/assets/2dae5394/jquery-ui-timepicker-addon.js', CClientScript::POS_END);
                    ?>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

                    <!-- Required Stylesheets -->
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/text.css" media="screen" />
                    <link rel="stylesheet" type="tex    t/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fonts/ptsans/stylesheet.css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fluid.css" media="screen" />

                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mws.style.css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/icons/icons.css" media="screen" />

                    <!-- Demo and Plugin Stylesheets -->
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/demo.css" media="screen" />

                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/colorpicker/colorpicker.css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jimgareaselect/css/imgareaselect-default.css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.print.css" media="print" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/tipsy/tipsy.css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/sourcerer/Sourcerer-1.2.css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jgrowl/jquery.jgrowl.css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/spinner/spinner.css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jui/jquery.ui.css" media="screen" />
<!--                    <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/prettyPhoto.css" media="screen" />-->

                    <!-- Theme Stylesheet -->
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mws.theme.css" media="screen" />

                    <!-- JavaScript Plugins -->

                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.min.js"></script>

                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jimgareaselect/jquery.imgareaselect.min.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery.dualListBox-1.3.min.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jgrowl/jquery.jgrowl.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery.filestyle.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.min.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery.dataTables.js"></script>
                    <!--[if lt IE 9]>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/excanvas.min.js"></script>
                    <![endif]-->
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/jquery.flot.min.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/jquery.flot.pie.min.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/jquery.flot.stack.min.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/jquery.flot.resize.min.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/colorpicker/colorpicker.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/tipsy/jquery.tipsy.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/sourcerer/Sourcerer-1.2.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery.placeholder.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery.validate.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery.mousewheel.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/spinner/ui.spinner.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>

                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/mws.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo.js"></script>
                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/themer.js"></script>
  

                    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo.dashboard.js"></script>
<!--                    <script type="text/javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.prettyPhoto.js"></script>-->
                     
                    <title><?php echo Yii::app()->name?></title>                   <style >.placeholder{text-align: center; padding-left:30px;}</style>
                  <style>
                      body{
                          background-image: none;
                      }
                      .mws-panel .mws-panel-body{
                          border-top-width: 4px;
                          box-shadow:0px 0px 0px 0px rgba(0,0,0);
                      }
                      .wrapform 
                        {
                            width:100%;
                            margin-bottom: 20px;
                        }

                        .kolom{
                            width: 45%;
                            float:left;
/*                            background:black;*/
/*                            height:200px;*/
                            margin-botom:40px;
                            
                        }
                  </style>
</head>

<body>
    <?php echo $content; ?>
    </body>
    </html>