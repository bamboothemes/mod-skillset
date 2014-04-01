<?php
/**
 * @copyright	Copyright (c) 2014 Joomla. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$skills = rtrim($params->get('skills'), "|");

$skills = explode('|', $skills);

	if($params->get('display') == "skills") {
		foreach ( $skills as $skill ) { 
		
			$skill = explode(',', $skill);
			
		?>
			<div class="zen-skillbar clearfix " data-percent="<?php echo $skill[1];?>%">
				<div class="zen-skillbar-title" style="background: <?php echo $skill[3];?>"><span><?php echo $skill[0];?></span></div>
				<div class="zen-skillbar-bar" style="background: <?php echo $skill[2];?>"></div>
				<div class="zen-skill-bar-percent"><?php echo $skill[1];?>%</div>
			</div> 
		
		<?php } ?>
		
		<script>
		
		
			// Only trigger the effect if the item is visible
			jQuery(window).scroll(function(event) {
			  
			  jQuery('.zen-skillbar').each(function(i, el){
			  
			  	var el = jQuery(el);
			  	
			  	if (el.visible(true)) {
			  	  jQuery(this).find('.zen-skillbar-bar').animate({
			  	  	width:jQuery(this).attr('data-percent')
			  	  },3000); 
			  
			  	}
			  	 
			   });
			   
			});
			
		</script>
		
	<?php } 
	
	
	if($params->get('display') == "count") {
		
		$totalitems = count($skills);
		foreach ( $skills as $key => $skill ) { 
		
			$skill = explode(',', $skill); 
			$count = str_replace('%', '', $skill[1]);
			?>
		
			<div id="count-<?php echo $key;?>-<?php echo $module->id;?>" class="skill-count-item skill-count-items-<?php echo $totalitems;?> skill-count-item<?php echo $key;?>">
				<h2></h2>
				<p><strong><?php echo $skill[0];?></strong></p>
			</div>
			
			<script>
			
				// Only trigger the effect if the item is visible
				jQuery(window).scroll(function(event) {
				
					jQuery('.skill-count-item').each(function(i, el){
					
						var el = jQuery(el);
						
						if (el.visible(true)) {
							if(jQuery('#count-<?php echo $key;?>-<?php echo $module->id;?> h2').text() == '') {
							
							
								countup('#count-<?php echo $key;?>-<?php echo $module->id;?> h2', '<?php echo $count;?>');
						  	}
						}
					});
				});
							
			</script>
		<?php } ?>
		
		
		<script>
			
			
			function countup(element, total) {
			   
			    var current = 0;
			    var finish = total;
			    var miliseconds = 1000;
			    var rate = 1;
				
				if(current == 0) {
				    var counter = setInterval(function(){
				         if(current >= finish) clearInterval(counter);
				         jQuery(element).text(current);
				         current = parseInt(current) + parseInt(rate);
				    }, miliseconds / (finish / rate));
				}
			};
		
		</script>
		
	<?php }
	?>
	
<script>


	(function($) {
		
		  /**
		   * Copyright 2012, Digital Fusion
		   * Licensed under the MIT license.
		   * http://teamdf.com/jquery-plugins/license/
		   *
		   * @author Sam Sehnert
		   * @desc A small plugin that checks whether elements are within
		   *     the user visible viewport of a web browser.
		   *     only accounts for vertical position, not horizontal.
		   */
		
		  $.fn.visible = function(partial) {
		    
		      var $t            = $(this),
		          $w            = $(window),
		          viewTop       = $w.scrollTop(),
		          viewBottom    = viewTop + $w.height(),
		          _top          = $t.offset().top,
		          _bottom       = _top + $t.height(),
		          compareTop    = partial === true ? _bottom : _top,
		          compareBottom = partial === true ? _top : _bottom;
		    
		    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
		
		  };
		    
		})(jQuery);
</script>