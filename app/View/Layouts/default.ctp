<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
        echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
        echo $this->Html->script('//malsup.github.com/jquery.form.js');
	?>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script src="http://datatables.net/media/blog/bootstrap/paging.js"></script>
    <link href="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>

    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>

    <script>
        function confirmPost(url,msg) {
            if (confirm(msg)) {
                var $form = $('<form/>').attr({action: url,method: 'post'});
                $('body').append($form);
                $form.submit();
                return true;
            } else {
                return false;
            }
        }
        function model(url) {
            var $dialog = $('<div class="modal fade"></div>').load(url, function() {
                $dialog.modal().on('hidden.bs.modal', function() {
                    $dialog.remove();
                });
            });
        }
        function popover($element, message, options) {
            var defaultSetting = {
                placement: 'top',
                html: true,
                content: message
            };
            var settings = $.extend({}, defaultSetting, options);
            var _popover = $element.popover(settings);
            _popover.data('bs.popover').options.content = message;
            return _popover;
        }
        function initForm($target) {
            $target = $target || $('body');
            $('form:not([init])', $target).each(function() {
                $(this).prop('novalidate',true);
                $(this).validate();
                $(this).attr('init', true);
            });
        }
        function pageInit($target) {
            $.validator.setDefaults({
                showErrors: function(map, list) {
                    $.each( this.successList , function(index, value) {
                        var $elem = $(value);
                        var errContainerId = $elem.attr('errContainerId');
                        if (errContainerId) {
                            if ($("#"+errContainerId).length) {
                                $elem = $("#"+errContainerId);
                            }
                        }
                    });
                    $.each( list , function(index, value) {
                        var $elem = $(value.element);
                        var errContainerId = $elem.attr('errContainerId');
                        if (errContainerId) {
                            if ($("#"+errContainerId).length) {
                                $elem = $("#"+errContainerId);
                            }
                        }
                        var $popover = popover($elem, '<i class="icon-warning-sign" style="color:red"></i>&nbsp;'+value.message);
                        $popover.popover('show');
                    });
                }
            });

            initForm($target);
        }
        $(function() {
            pageInit();
            $('body').on('shown.bs.modal','.modal', function() {
                pageInit($(this));
            });
            $('body').on('hidden.bs.popover','.popover', function (elem) {
                console.log(elem)
            });
            $(document).ajaxComplete(function(event, xhr, settings) {
                if (settings.dataType=='html') {
                }
            });
        })
    </script>
</head>
<body>
	<div id="container" class="container">
		<div id="header" class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li <?=$this->params['controller']=='special_execs' ? 'class=\'active\'' : ''?>><?php echo $this->Html->link('Special Exec', array('controller'=>'special_execs','action'=>'index')); ?></li>
                <li <?=$this->params['controller']=='sections' ? 'class=\'active\'' : ''?>><?php echo $this->Html->link('Section', array('controller'=>'sections','action'=>'index')); ?></li>
                <li <?=$this->params['controller']=='products' ? 'class=\'active\'' : ''?>><?php echo $this->Html->link('Product', array('controller'=>'products','action'=>'index')); ?></li>
                <li <?=$this->params['controller']=='packages' ? 'class=\'active\'' : ''?>><?php echo $this->Html->link('Package', array('controller'=>'packages','action'=>'index')); ?></li>
                <li <?=$this->params['controller']=='channels' ? 'class=\'active\'' : ''?>><?php echo $this->Html->link('Channel', array('controller'=>'channels','action'=>'index')); ?></li>
                <li <?=$this->params['controller']=='section_mixes' ? 'class=\'active\'' : ''?>><?php echo $this->Html->link('Section Mix', array('controller'=>'section_mixes','action'=>'index')); ?></li>
            </ul>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
