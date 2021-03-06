<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'penggajian-t-form',
                        'enableAjaxValidation'=>false,
                )); ?>

	<div class="mws-form-message info">Fields with <span class="required">*</span> are required.</div>  
                <div class="mws-form-inline">   
                    <table>
                        <tr>
                            <td width="50%">
                                <div class="mws-form-row">
                                    <?php echo CHtml::label('Jenis Pengeluaran','KPengeluarankasT_jenispengeluaran_id'); ?>
                                    <div class="mws-form-item">
                                        <?php echo CHtml::activedropDownList($modPengeluarankas,'jenispengeluaran_id',CHtml::listData($modPengeluarankas->getJenispengeluaranItems(),'jenispengeluaran_id','jenispengeluaran_nama'),array('empty'=>'-- Pilih --','style'=>'width:110px')); ?>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <?php echo CHtml::label('Tgl Pengeluaran','KPengeluarankasT_tglpengeluaran'); ?>
                                    <div class="mws-form-item">
                                        <?php $this->widget('MyDateTimePicker',array(
                                            'model'=>$modPengeluarankas,
                                            'attribute'=>'tglpengeluaran',
                                            'language'=>'',
                                            'mode'=>'date', //use "time","date" or "datetime" (default)
                                            'options'=>array(
                                                'changeYear'=>false,
                                                'changeMonth'=>false,
                                                'yearRange'=>'-70y:+4y',
                                                'maxDate'=>'d',
                                                'showAnim'=>'fold',
                                                'timeText'=>'Waktu',
                                                'hourText'=>'Jam',
                                                'minuteText'=>'Menit',
                                                'secondText'=>'Detik',
                                                'showSecond'=>false,
                                                'timeFormat'=>'hh:mm:ss',
                                            ),
                                            'htmlOptions'=>array(
                                                'value'=>date('Y-m-d'),
                                            'readonly'=>true,
                                            'onkeypress'=>"return $(this).focusNextInputField(event)",
                                            ),
                                            ));?>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <?php echo CHtml::label('No Pengeluaran','KPengeluarankasT_nopengeluaran'); ?>
                                    <div class="mws-form-item">
                                        <?php
                                            $command = Yii::app()->db->createCommand()->select('MAX(nopengeluaran) AS maxnumber')->from('pengeluarankas_t')->queryAll();
                                            $maxnumber = $command[0]['maxnumber'];
                                            $urutan = $maxnumber + 1;
                                            $nomor = CustomFormat::pad_zero($urutan,5,TRUE);
                                        ?>
                                        <?php echo CHtml::activeTextField($modPengeluarankas,'nopengeluaran',array('class'=>'digit-short','value'=>$nomor)); ?>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <?php echo CHtml::label('Keperluan','KPengeluarankasT_untukkeperluan'); ?>
                                    <div class="mws-form-item">
                                        <?php echo CHtml::activeTextField($modPengeluarankas,'untukkeperluan',array('class'=>'digit-medium','maxlength'=>50,'value'=>'Gaji karyawan')); ?>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <?php echo CHtml::label('Penerima','KPengeluarankasT_namapenerima'); ?>
                                    <div class="mws-form-item">
                                        <?php echo CHtml::activeTextField($modPengeluarankas,'namapenerima',array('class'=>'digit-medium','value'=>$model->karyawan->nama_karyawan,'readonly'=>true)); ?>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <?php echo CHtml::label('Keterangan','KPengeluarankasT_keterangan'); ?>
                                    <div class="mws-form-item">
                                        <?php echo CHtml::activeTextArea($modPengeluarankas,'keterangan',array('cols'=>10,'rows'=>15)); ?>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <?php echo CHtml::label('Jumlah Keluar',''); ?>
                                    <div class="mws-form-item">
                                        <?php echo CHtml::activeTextField($modPengeluarankas,'jmlkeluar',array('class'=>'digit-medium','value'=>$model->penerimaanbersih)); ?>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <?php echo CHtml::label('Pegawai Pengeluaran','KPengeluarankasT_pegpengeluran'); ?>
                                    <div class="mws-form-item">
                                        <?php echo CHtml::activedropDownList($modPengeluarankas,'pegpengeluran',CHtml::listData($modPengeluarankas->getKaryawanItems(),'nama_karyawan','nama_karyawan'),array('empty'=>'-- Pilih --','style'=>'width:234px')); ?>
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <?php echo CHtml::label('Pegawai Mengetahui','KPengeluarankasT_pegmengetahui'); ?>
                                    <div class="mws-form-item">
                                        <?php echo CHtml::activedropDownList($modPengeluarankas,'pegmengetahui',CHtml::listData($modPengeluarankas->getKaryawanItems(),'nama_karyawan','nama_karyawan'),array('empty'=>'-- Pilih --','style'=>'width:234px')) ?>
                                    </div>
                                </div>
                                
                                
                            </td>
                   </tr>
               </table>
                </div>
                 <div class="mws-button-row">
                    <?php
                        echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', array('class' => 'mws-button blue'))."&nbsp; &nbsp;";
//                        echo CHtml::htmlButton(Yii::t('mds','Bayarkan'),array('class'=>'mws-button blue', 'type'=>'button','onclick'=>'print(\'PRINT\')'))."&nbsp; &nbsp;";
                    ?>

                </div>   
                    
                <?php $this->endWidget(); ?>
            </div>
        </div>    	
    </div><!-- form -->
<style>
    
table {
            	color:#323232;
	font:13px/1.5 'PTSansRegular', Arial, Helvetica, sans-serif;
                font-size:0.9em;
}    
.dialog {
    padding: 3px;
}
.digit12 {
    width:120px;
}
.mws-form input[type=text]
{
    	border-radius:0px;
                border:1px solid #C5C5C5;
                height:19px;
                margin-bottom:2px;
                margin-top:2px;
                padding:2px;
                line-height:18px;
                height:19px;
}

.mws-form input[disabled]
{
                background:#000000;
}
.mws-form
{
    	color:#323232;
	font:13px/1.5 'PTSansRegular', Arial, Helvetica, sans-serif;
                font-size:0.9em;
                clear:both;
	display:block;
}
.mws-form .mws-form-inline .mws-form-item
{
	margin-left:136px;
}
.mws-form .mws-form-inline label
{
	width:120px;
	display:block;
	float:left;
	margin-right:16px;
}
.mws-form .mws-form-row:before,
.mws-form .mws-form-row:after
{
	content: '.';
	display: block;
	overflow: hidden;
	visibility: hidden;
	font-size: 0;
	line-height: 0;
	width: 0;
	height: 0;
}

.mws-form .mws-form-row:after
{
	clear: both;
}

.mws-form .mws-form-row
{
	zoom: 1;
}

.digit2 {
    width:30px;
}
.mws-form textarea
{
	height:10em;
	resize:none;
}
.mws-button.blue {
    background-color: #4386BC;
    background-image: -moz-linear-gradient(#5D9ED2, #4386BC);
    border: 1px solid #416B8B;
    color: #FFFFFF;
    width: auto;
    display:block;
    float:right;
}
.mws-button, .ui-button {
    border: 0 none;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 1px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    font-family: 'PTSansRegular',Arial,Helvetica,sans-serif;
    outline: medium none;
    padding: 6px 9px;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4);
}
.mws-form .mws-form-item select, 
.mws-form .mws-form-item textarea, 
.mws-form .mws-form-item .mws-textinput, 
.mws-form .mws-form-item.large select, 
.mws-form .mws-form-item.large textarea, 
.mws-form .mws-form-item.large .mws-textinput
{
                border-radius:0px;
                margin-top:5px;
                margin-bottom:5px;
	width:100%;
}

.mws-form .mws-form-item.medium select, 
.mws-form .mws-form-item.medium textarea, 
.mws-form .mws-form-item.medium .mws-textinput
{
                border-radius:0px;
	width:75%;
}

.mws-form .mws-form-item.small select, 
.mws-form .mws-form-item.small textarea, 
.mws-form .mws-form-item.small .mws-textinput
{
                border-radius:0px;
	width:55%;
}

.mws-form select, 
.mws-form textarea, 
.mws-form .mws-textinput, 
.mws-form .file
{
	border:1px solid #c5c5c5;
	padding:3px;
	color:#323232;
	margin:0;
	background-color:#ffffff;
	outline:none;
	width:300px;
	/* CSS 3 */
	
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	-o-border-radius:4px;
	-khtml-border-radius:4px;
	border-radius:4px;
	
	box-sizing: border-box;
	-moz-box-sizing: border-box;
	-ms-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-khtml-box-sizing: border-box;
	
	-moz-box-shadow:inset 0px 1px 3px rgba(128, 128, 128, 0.1);
	-o-box-shadow:inset 0px 1px 3px rgba(128, 128, 128, 0.1);	
	-webkit-box-shadow:inset 0px 1px 3px rgba(128, 128, 128, 0.1);
	-khtml-box-shadow:inset 0px 1px 3px rgba(128, 128, 128, 0.1);
	box-shadow:inset 0px 1px 3px rgba(128, 128, 128, 0.1);
}

.mws-form select:disabled, 
.mws-form textarea:disabled, 
.mws-form .mws-textinput:disabled
{
	background:#f0f0f0;
}

.mws-form select.error, 
.mws-form textarea.error, 
.mws-form .mws-textinput.error
{
	border-color:#eb979b;
}
.input-append{

}
.mws-ic-16.ic-calendar-1{background-image:url(css/icons/16/calendar_1.png);display:inline-block;height:19px;width:19px;background-repeat: no-repeat;}
.add-on
{

/*    border-radius: 0 3px 3px 0;*/
    margin-left: -1px;
/*    margin-right: 0;*/
    background-color: #F5F5F5;
    border: 1px solid #CCCCCC;
/*    border-radius: 3px 0 0 3px;*/
    color: #999999;
    display: block;
    float: left;
    font-weight: normal;
    height: 19px;
    line-height: 18px;
    margin-right: -1px;
    min-width: 16px;
    padding: 2px;
    text-align: center;
    text-shadow: 0 1px 0 #FFFFFF;
    width: auto;
}
</style>
<style>
/*
 * jQuery UI Datepicker 1.8.16
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Datepicker#theming
 */
.ui-datepicker{ width: 180px; background:url(../../../images/jui/datepicker/datepicker-bg.png) repeat-x; display:none; padding:10px; font-size:12px; z-index:1999 !important; }
.ui-datepicker .ui-datepicker-header{ position:relative; padding:.2em 0; background-image:url(../../../images/core/mws-inset.png); 
	/* CSS 3 */ 
	-webkit-box-shadow:0px 1px 0px rgba(255, 255, 255, 0.15), inset 0px 1px 2px rgba(0, 0, 0, 0.5); 
	-moz-box-shadow:0px 1px 0px rgba(255, 255, 255, 0.15), inset 0px 1px 2px rgba(0, 0, 0, 0.5); 
	-o-box-shadow:0px 1px 0px rgba(255, 255, 255, 0.15), inset 0px 1px 2px rgba(0, 0, 0, 0.5); 
	-khtml-box-shadow:0px 1px 0px rgba(255, 255, 255, 0.15), inset 0px 1px 2px rgba(0, 0, 0, 0.5); 
	box-shadow:0px 1px 0px rgba(255, 255, 255, 0.15), inset 0px 1px 2px rgba(0, 0, 0, 0.5);
}
.ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next { position:absolute; top: 2px; width: 1.8em; height: 1.8em; }
.ui-datepicker .ui-datepicker-prev { left:2px; }
.ui-datepicker .ui-datepicker-next { right:2px; }
.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span { display: block; position: absolute; left: 50%; margin-left: -8px; top: 50%; margin-top: -8px;  }
.ui-datepicker .ui-datepicker-title { margin: 0 2.3em; line-height: 1.8em; text-align: center; }

.ui-datepicker .ui-datepicker-title select { font-size:1em; margin:1%; padding:0; -webkit-border-radius:0; -moz-border-radius:0; border-radius:0; }
.ui-datepicker select.ui-datepicker-month-year {width: 100%;}
.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year { width: 48%;}

.ui-datepicker table { width: 100%; border-collapse: collapse; margin:5px 0 0 0; }
.ui-datepicker table thead { background:url(../../../images/jui/datepicker/datepicker-stitch.png) repeat-x; }
.ui-datepicker th { color:#ffffff; text-align:center; padding:2px 0; padding-bottom:5px; }
.ui-datepicker td { border: 1px solid #97969b; background-color:#eae8f1; text-align: center; }
.ui-datepicker td span, .ui-datepicker td a { display: block; text-decoration: none; color:#333333 !important; padding: 3px 2px; text-shadow:none;  }
.ui-datepicker td.ui-state-disabled { background-color:#bbbac1; opacity:1; filter:Alpha(100); }
.ui-datepicker td.ui-datepicker-week-col { border:none; color:#ffffff; background-color:transparent; padding:3px 2px; }


.ui-datepicker .ui-datepicker-buttonpane { background-image: none; margin: .7em 0 0 0; padding:0 .2em; border-left: 0; border-right: 0; border-bottom: 0; }
.ui-datepicker .ui-datepicker-buttonpane button {
	outline:none;
	padding:4px 6px;
	cursor:pointer;
	float:right;

	background-color:#96c742;
	color:#ffffff;
	border:1px solid #507E0C;
	
	/* CSS 3 */
	
	-webkit-box-shadow:inset 0px 1px 0px rgba(255, 255, 255, 0.3), 0px 1px 1px rgba(0, 0, 0, 0.15);
	-moz-box-shadow:inset 0px 1px 0px rgba(255, 255, 255, 0.3), 0px 1px 1px rgba(0, 0, 0, 0.15);
	-o-box-shadow:inset 0px 1px 0px rgba(255, 255, 255, 0.3), 0px 1px 1px rgba(0, 0, 0, 0.15);
	-khtml-box-shadow:inset 0px 1px 0px rgba(255, 255, 255, 0.3), 0px 1px 1px rgba(0, 0, 0, 0.15);
	box-shadow:inset 0px 1px 0px rgba(255, 255, 255, 0.3), 0px 1px 1px rgba(0, 0, 0, 0.15);
	
	background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #addf58), color-stop(100%, #96c742));
	background-image: -webkit-linear-gradient(#addf58,#96c742);
	background-image: -moz-linear-gradient(#addf58,#96c742);
	background-image: -o-linear-gradient(#addf58,#96c742);
	background-image: linear-gradient(#addf58,#96c742);
}
.ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current { float:left; }

.ui-datepicker .ui-datepicker-buttonpane button:active
{
	/* CSS 3 */
	
	-webkit-box-shadow:inset 0px 0px 6px rgba(0, 0, 0, 0.2) !important;
	-moz-box-shadow:inset 0px 0px 6px rgba(0, 0, 0, 0.2) !important;
	-o-box-shadow:inset 0px 0px 6px rgba(0, 0, 0, 0.2) !important;
	-khtml-box-shadow:inset 0px 0px 6px rgba(0, 0, 0, 0.2) !important;
	box-shadow:inset 0px 0px 6px rgba(0, 0, 0, 0.2) !important;
}

/* with multiple calendars */
.ui-datepicker.ui-datepicker-multi { width:auto; }
.ui-datepicker-multi .ui-datepicker-group { float:left; margin:0 0.5%; }
.ui-datepicker-multi .ui-datepicker-group table { width:100%; margin:5px 0 0 0; }
.ui-datepicker-multi-2 .ui-datepicker-group { width:49%; }
.ui-datepicker-multi-3 .ui-datepicker-group { width:32.333%; }
.ui-datepicker-multi-4 .ui-datepicker-group { width:24%; }
.ui-datepicker-multi .ui-datepicker-group-last .ui-datepicker-header { border-left-width:0; }
.ui-datepicker-multi .ui-datepicker-group-middle .ui-datepicker-header { border-left-width:0; }
.ui-datepicker-multi .ui-datepicker-buttonpane { clear:left; }
.ui-datepicker-row-break { clear:both; width:100%; font-size:0em; }

/* RTL support */
.ui-datepicker-rtl { direction: rtl; }
.ui-datepicker-rtl .ui-datepicker-prev { right: 2px; left: auto; }
.ui-datepicker-rtl .ui-datepicker-next { left: 2px; right: auto; }
.ui-datepicker-rtl .ui-datepicker-prev:hover { right: 1px; left: auto; }
.ui-datepicker-rtl .ui-datepicker-next:hover { left: 1px; right: auto; }
.ui-datepicker-rtl .ui-datepicker-buttonpane { clear:right; }
.ui-datepicker-rtl .ui-datepicker-buttonpane button { float: left; }
.ui-datepicker-rtl .ui-datepicker-buttonpane button.ui-datepicker-current { float:right; }
.ui-datepicker-rtl .ui-datepicker-group { float:right; }
.ui-datepicker-rtl .ui-datepicker-group-last .ui-datepicker-header { border-right-width:0; border-left-width:1px; }
.ui-datepicker-rtl .ui-datepicker-group-middle .ui-datepicker-header { border-right-width:0; border-left-width:1px; }

/* IE6 IFRAME FIX (taken from datepicker 1.5.3 */
.ui-datepicker-cover {
    display: none; /*sorry for IE5*/
    display/**/: block; /*sorry for IE5*/
    position: absolute; /*must have*/
    z-index: -1; /*must have*/
    filter: mask(); /*must have*/
    top: -4px; /*must have*/
    left: -4px; /*must have*/
    width: 200px; /*must have*/
    height: 200px; /*must have*/
}


/*
 * jQuery UI CSS Framework 1.8.16
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Theming/API
 *
 * To view and modify this theme, visit http://jqueryui.com/themeroller/?ffDefault=Trebuchet%20MS,%20Tahoma,%20Verdana,%20Arial,%20sans-serif&fwDefault=bold&fsDefault=1.1em&cornerRadius=4px&bgColorHeader=f6a828&bgTextureHeader=12_gloss_wave.png&bgImgOpacityHeader=35&borderColorHeader=e78f08&fcHeader=ffffff&iconColorHeader=ffffff&bgColorContent=eeeeee&bgTextureContent=03_highlight_soft.png&bgImgOpacityContent=100&borderColorContent=dddddd&fcContent=333333&iconColorContent=222222&bgColorDefault=f6f6f6&bgTextureDefault=02_glass.png&bgImgOpacityDefault=100&borderColorDefault=cccccc&fcDefault=1c94c4&iconColorDefault=ef8c08&bgColorHover=fdf5ce&bgTextureHover=02_glass.png&bgImgOpacityHover=100&borderColorHover=fbcb09&fcHover=c77405&iconColorHover=ef8c08&bgColorActive=ffffff&bgTextureActive=02_glass.png&bgImgOpacityActive=65&borderColorActive=fbd850&fcActive=eb8f00&iconColorActive=ef8c08&bgColorHighlight=ffe45c&bgTextureHighlight=03_highlight_soft.png&bgImgOpacityHighlight=75&borderColorHighlight=fed22f&fcHighlight=363636&iconColorHighlight=228ef1&bgColorError=b81900&bgTextureError=08_diagonals_thick.png&bgImgOpacityError=18&borderColorError=cd0a0a&fcError=ffffff&iconColorError=ffd27a&bgColorOverlay=666666&bgTextureOverlay=08_diagonals_thick.png&bgImgOpacityOverlay=20&opacityOverlay=50&bgColorShadow=000000&bgTextureShadow=01_flat.png&bgImgOpacityShadow=10&opacityShadow=20&thicknessShadow=5px&offsetTopShadow=-5px&offsetLeftShadow=-5px&cornerRadiusShadow=5px
 */


/* Component containers
----------------------------------*/
.ui-widget { font-family: 'PTSansRegular', Arial, Helvetica, sans-serif; }
.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button { font-family: 'PTSansRegular', Arial, Helvetica, sans-serif; }
.ui-widget-content, .ui-widget-content a { color: #333333; }
.ui-widget-header, .ui-widget-header a { color: #ffffff; }

/* Interaction states
----------------------------------*/
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default { }
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited { text-decoration: none; }
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, 
.ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus { }
.ui-state-hover a, .ui-state-hover a:hover { text-decoration: none; }
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active { }
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited { text-decoration: none; }
.ui-widget :active { outline: none; }

/* Interaction Cues
----------------------------------*/

/*.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight  { background: #c5d52b; }
.ui-state-highlight a, .ui-widget-content .ui-state-highlight a,.ui-widget-header .ui-state-highlight a { color: #363636; }*/

.ui-state-error, .ui-widget-content .ui-state-error, .ui-widget-header .ui-state-error {border: 1px solid #EB979B; background: #FFCBCA; color: #9B4449; }
.ui-state-error a, .ui-widget-content .ui-state-error a, .ui-widget-header .ui-state-error a { color: #ffffff; }
.ui-state-error-text, .ui-widget-content .ui-state-error-text, .ui-widget-header .ui-state-error-text { color: #ffffff; }

.ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary { font-weight: bold; }
.ui-priority-secondary, .ui-widget-content .ui-priority-secondary,  .ui-widget-header .ui-priority-secondary { font-weight: normal; }

.ui-state-disabled, .ui-widget-content .ui-state-disabled, .ui-widget-header .ui-state-disabled { opacity:.35; filter:Alpha(35); background-image:none; }

/* Icons
----------------------------------*/

/* states and images */
.ui-icon { width: 16px; height: 16px; background-image:url(../../../images/jui/ui-icons.png); }
.ui-icon
{
	padding:0;
	display:block;
	cursor:pointer;
	
	/* CSS 3 */
	
	-webkit-border-radius:2px;
	-moz-border-radius:2px;
	-o-border-radius:2px;
	border-radius:2px;
}

.ui-accordion-header .ui-icon, 
.ui-dialog-titlebar-close .ui-icon
{
	-webkit-box-shadow:0 0 0 3px rgba(0, 0, 0, 0.3), 0 1px 0 3px rgba(255, 255, 255, 0.05), 0 1px 0 rgba(0, 0, 0, 0.5);
	-moz-box-shadow:0 0 0 3px rgba(0, 0, 0, 0.3), 0 1px 0 3px rgba(255, 255, 255, 0.05), 0 1px 0 rgba(0, 0, 0, 0.5);
	box-shadow:0 0 0 3px rgba(0, 0, 0, 0.3), 0 1px 0 3px rgba(255, 255, 255, 0.05), 0 1px 0 rgba(0, 0, 0, 0.5);
}

/* positioning */
.ui-icon-carat-1-n { background-position: 0 0; }
.ui-icon-carat-1-ne { background-position: -16px 0; }
.ui-icon-carat-1-e { background-position: -32px 0; }
.ui-icon-carat-1-se { background-position: -48px 0; }
.ui-icon-carat-1-s { background-position: -64px 0; }
.ui-icon-carat-1-sw { background-position: -80px 0; }
.ui-icon-carat-1-w { background-position: -96px 0; }
.ui-icon-carat-1-nw { background-position: -112px 0; }
.ui-icon-carat-2-n-s { background-position: -128px 0; }
.ui-icon-carat-2-e-w { background-position: -144px 0; }
.ui-icon-triangle-1-n { background-position: 0 -16px; }
.ui-icon-triangle-1-ne { background-position: -16px -16px; }
.ui-icon-triangle-1-e { background-position: -32px -16px; }
.ui-icon-triangle-1-se { background-position: -48px -16px; }
.ui-icon-triangle-1-s { background-position: -64px -16px; }
.ui-icon-triangle-1-sw { background-position: -80px -16px; }
.ui-icon-triangle-1-w { background-position: -96px -16px; }
.ui-icon-triangle-1-nw { background-position: -112px -16px; }
.ui-icon-triangle-2-n-s { background-position: -128px -16px; }
.ui-icon-triangle-2-e-w { background-position: -144px -16px; }
.ui-icon-arrow-1-n { background-position: 0 -32px; }
.ui-icon-arrow-1-ne { background-position: -16px -32px; }
.ui-icon-arrow-1-e { background-position: -32px -32px; }
.ui-icon-arrow-1-se { background-position: -48px -32px; }
.ui-icon-arrow-1-s { background-position: -64px -32px; }
.ui-icon-arrow-1-sw { background-position: -80px -32px; }
.ui-icon-arrow-1-w { background-position: -96px -32px; }
.ui-icon-arrow-1-nw { background-position: -112px -32px; }
.ui-icon-arrow-2-n-s { background-position: -128px -32px; }
.ui-icon-arrow-2-ne-sw { background-position: -144px -32px; }
.ui-icon-arrow-2-e-w { background-position: -160px -32px; }
.ui-icon-arrow-2-se-nw { background-position: -176px -32px; }
.ui-icon-arrowstop-1-n { background-position: -192px -32px; }
.ui-icon-arrowstop-1-e { background-position: -208px -32px; }
.ui-icon-arrowstop-1-s { background-position: -224px -32px; }
.ui-icon-arrowstop-1-w { background-position: -240px -32px; }
.ui-icon-arrowthick-1-n { background-position: 0 -48px; }
.ui-icon-arrowthick-1-ne { background-position: -16px -48px; }
.ui-icon-arrowthick-1-e { background-position: -32px -48px; }
.ui-icon-arrowthick-1-se { background-position: -48px -48px; }
.ui-icon-arrowthick-1-s { background-position: -64px -48px; }
.ui-icon-arrowthick-1-sw { background-position: -80px -48px; }
.ui-icon-arrowthick-1-w { background-position: -96px -48px; }
.ui-icon-arrowthick-1-nw { background-position: -112px -48px; }
.ui-icon-arrowthick-2-n-s { background-position: -128px -48px; }
.ui-icon-arrowthick-2-ne-sw { background-position: -144px -48px; }
.ui-icon-arrowthick-2-e-w { background-position: -160px -48px; }
.ui-icon-arrowthick-2-se-nw { background-position: -176px -48px; }
.ui-icon-arrowthickstop-1-n { background-position: -192px -48px; }
.ui-icon-arrowthickstop-1-e { background-position: -208px -48px; }
.ui-icon-arrowthickstop-1-s { background-position: -224px -48px; }
.ui-icon-arrowthickstop-1-w { background-position: -240px -48px; }
.ui-icon-arrowreturnthick-1-w { background-position: 0 -64px; }
.ui-icon-arrowreturnthick-1-n { background-position: -16px -64px; }
.ui-icon-arrowreturnthick-1-e { background-position: -32px -64px; }
.ui-icon-arrowreturnthick-1-s { background-position: -48px -64px; }
.ui-icon-arrowreturn-1-w { background-position: -64px -64px; }
.ui-icon-arrowreturn-1-n { background-position: -80px -64px; }
.ui-icon-arrowreturn-1-e { background-position: -96px -64px; }
.ui-icon-arrowreturn-1-s { background-position: -112px -64px; }
.ui-icon-arrowrefresh-1-w { background-position: -128px -64px; }
.ui-icon-arrowrefresh-1-n { background-position: -144px -64px; }
.ui-icon-arrowrefresh-1-e { background-position: -160px -64px; }
.ui-icon-arrowrefresh-1-s { background-position: -176px -64px; }
.ui-icon-arrow-4 { background-position: 0 -80px; }
.ui-icon-arrow-4-diag { background-position: -16px -80px; }
.ui-icon-extlink { background-position: -32px -80px; }
.ui-icon-newwin { background-position: -48px -80px; }
.ui-icon-refresh { background-position: -64px -80px; }
.ui-icon-shuffle { background-position: -80px -80px; }
.ui-icon-transfer-e-w { background-position: -96px -80px; }
.ui-icon-transferthick-e-w { background-position: -112px -80px; }
.ui-icon-folder-collapsed { background-position: 0 -96px; }
.ui-icon-folder-open { background-position: -16px -96px; }
.ui-icon-document { background-position: -32px -96px; }
.ui-icon-document-b { background-position: -48px -96px; }
.ui-icon-note { background-position: -64px -96px; }
.ui-icon-mail-closed { background-position: -80px -96px; }
.ui-icon-mail-open { background-position: -96px -96px; }
.ui-icon-suitcase { background-position: -112px -96px; }
.ui-icon-comment { background-position: -128px -96px; }
.ui-icon-person { background-position: -144px -96px; }
.ui-icon-print { background-position: -160px -96px; }
.ui-icon-trash { background-position: -176px -96px; }
.ui-icon-locked { background-position: -192px -96px; }
.ui-icon-unlocked { background-position: -208px -96px; }
.ui-icon-bookmark { background-position: -224px -96px; }
.ui-icon-tag { background-position: -240px -96px; }
.ui-icon-home { background-position: 0 -112px; }
.ui-icon-flag { background-position: -16px -112px; }
.ui-icon-calendar { background-position: -32px -112px; }
.ui-icon-cart { background-position: -48px -112px; }
.ui-icon-pencil { background-position: -64px -112px; }
.ui-icon-clock { background-position: -80px -112px; }
.ui-icon-disk { background-position: -96px -112px; }
.ui-icon-calculator { background-position: -112px -112px; }
.ui-icon-zoomin { background-position: -128px -112px; }
.ui-icon-zoomout { background-position: -144px -112px; }
.ui-icon-search { background-position: -160px -112px; }
.ui-icon-wrench { background-position: -176px -112px; }
.ui-icon-gear { background-position: -192px -112px; }
.ui-icon-heart { background-position: -208px -112px; }
.ui-icon-star { background-position: -224px -112px; }
.ui-icon-link { background-position: -240px -112px; }
.ui-icon-cancel { background-position: 0 -128px; }
.ui-icon-plus { background-position: -16px -128px; }
.ui-icon-plusthick { background-position: -32px -128px; }
.ui-icon-minus { background-position: -48px -128px; }
.ui-icon-minusthick { background-position: -64px -128px; }
.ui-icon-close { background-position: -80px -128px; }
.ui-icon-closethick { background-position: -96px -128px; }
.ui-icon-key { background-position: -112px -128px; }
.ui-icon-lightbulb { background-position: -128px -128px; }
.ui-icon-scissors { background-position: -144px -128px; }
.ui-icon-clipboard { background-position: -160px -128px; }
.ui-icon-copy { background-position: -176px -128px; }
.ui-icon-contact { background-position: -192px -128px; }
.ui-icon-image { background-position: -208px -128px; }
.ui-icon-video { background-position: -224px -128px; }
.ui-icon-script { background-position: -240px -128px; }
.ui-icon-alert { background-position: 0 -144px; }
.ui-icon-info { background-position: -16px -144px; }
.ui-icon-notice { background-position: -32px -144px; }
.ui-icon-help { background-position: -48px -144px; }
.ui-icon-check { background-position: -64px -144px; }
.ui-icon-bullet { background-position: -80px -144px; }
.ui-icon-radio-off { background-position: -96px -144px; }
.ui-icon-radio-on { background-position: -112px -144px; }
.ui-icon-pin-w { background-position: -128px -144px; }
.ui-icon-pin-s { background-position: -144px -144px; }
.ui-icon-play { background-position: 0 -160px; }
.ui-icon-pause { background-position: -16px -160px; }
.ui-icon-seek-next { background-position: -32px -160px; }
.ui-icon-seek-prev { background-position: -48px -160px; }
.ui-icon-seek-end { background-position: -64px -160px; }
.ui-icon-seek-start { background-position: -80px -160px; }
/* ui-icon-seek-first is deprecated, use ui-icon-seek-start instead */
.ui-icon-seek-first { background-position: -80px -160px; }
.ui-icon-stop { background-position: -96px -160px; }
.ui-icon-eject { background-position: -112px -160px; }
.ui-icon-volume-off { background-position: -128px -160px; }
.ui-icon-volume-on { background-position: -144px -160px; }
.ui-icon-power { background-position: 0 -176px; }
.ui-icon-signal-diag { background-position: -16px -176px; }
.ui-icon-signal { background-position: -32px -176px; }
.ui-icon-battery-0 { background-position: -48px -176px; }
.ui-icon-battery-1 { background-position: -64px -176px; }
.ui-icon-battery-2 { background-position: -80px -176px; }
.ui-icon-battery-3 { background-position: -96px -176px; }
.ui-icon-circle-plus { background-position: 0 -192px; }
.ui-icon-circle-minus { background-position: -16px -192px; }
.ui-icon-circle-close { background-position: -32px -192px; }
.ui-icon-circle-triangle-e { background-position: -48px -192px; }
.ui-icon-circle-triangle-s { background-position: -64px -192px; }
.ui-icon-circle-triangle-w { background-position: -80px -192px; }
.ui-icon-circle-triangle-n { background-position: -96px -192px; }
.ui-icon-circle-arrow-e { background-position: -112px -192px; }
.ui-icon-circle-arrow-s { background-position: -128px -192px; }
.ui-icon-circle-arrow-w { background-position: -144px -192px; }
.ui-icon-circle-arrow-n { background-position: -160px -192px; }
.ui-icon-circle-zoomin { background-position: -176px -192px; }
.ui-icon-circle-zoomout { background-position: -192px -192px; }
.ui-icon-circle-check { background-position: -208px -192px; }
.ui-icon-circlesmall-plus { background-position: 0 -208px; }
.ui-icon-circlesmall-minus { background-position: -16px -208px; }
.ui-icon-circlesmall-close { background-position: -32px -208px; }
.ui-icon-squaresmall-plus { background-position: -48px -208px; }
.ui-icon-squaresmall-minus { background-position: -64px -208px; }
.ui-icon-squaresmall-close { background-position: -80px -208px; }
.ui-icon-grip-dotted-vertical { background-position: 0 -224px; }
.ui-icon-grip-dotted-horizontal { background-position: -16px -224px; }
.ui-icon-grip-solid-vertical { background-position: -32px -224px; }
.ui-icon-grip-solid-horizontal { background-position: -48px -224px; }
.ui-icon-gripsmall-diagonal-se { background-position: -64px -224px; }
.ui-icon-grip-diagonal-se { background-position: -80px -224px; }

/* Misc visuals
----------------------------------*/

/* Corner radius */
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl { -moz-border-radius-topleft: 4px; -webkit-border-top-left-radius: 4px; -khtml-border-top-left-radius: 4px; -o-border-top-left-radius: 4px; border-top-left-radius: 4px; }
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr { -moz-border-radius-topright: 4px; -webkit-border-top-right-radius: 4px; -khtml-border-top-right-radius: 4px; -o-border-top-right-radius: 4px; border-top-right-radius: 4px; }
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl { -moz-border-radius-bottomleft: 4px; -webkit-border-bottom-left-radius: 4px; -khtml-border-bottom-left-radius: 4px; -o-border-bottom-left-radius: 4px; border-bottom-left-radius: 4px; }
.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br { -moz-border-radius-bottomright: 4px; -webkit-border-bottom-right-radius: 4px; -khtml-border-bottom-right-radius: 4px; -o-border-bottom-right-radius: 4px; border-bottom-right-radius: 4px; }

/* Overlays */
.ui-widget-overlay { background: #666666; opacity: 0.5;filter:Alpha(Opacity=50); }
</style>