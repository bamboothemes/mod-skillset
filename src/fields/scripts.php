<?php
/**
* @package Author
* @author Joomla Bamboo
* @website www.joomlabamboo.com
* @email design@joomlabamboo.com
* @copyright Copyright (c) 2013 Joomla Bamboo. All rights reserved.
* @license GNU General Public License version 2 or later
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Mod_zensocial
 * @subpackage	Form
 * @since		1.6
 */

class JFormFieldScripts extends JFormField
{
	protected $type = 'scripts';

	protected function getInput()
	{

		$document = JFactory::getDocument();
		$root = JURI::root();


		if (version_compare(JVERSION, '3.0', '<'))
		{
			$document->addScript(''.$root.'modules/mod_zensocial/js/admin/jquery-1.8.3.min.js');
			$document->addScript(''.$root.'modules/mod_zensocial/js/admin/jquery.noconflict.js');
		}
		else
		{
		
		}

		ob_start();

		?>
		
			<div id="skills-demo">
			
			
			</div>
			
			
			
		<a class="new-skill btn btn-success" style="margin: 30px 0" >Add a new skill</a>
			<div id="skills-field">
			</div>
			<div id="holder"></div>
			<script type="text/javascript">
			
				jQuery(document).ready(function() {
				
					// A a new skillset
					jQuery("button").on('click', function() {
						getvalues();
					});
					
				
					var skillform = '<fieldset><input type="text" class="skill input-large" placeholder="Type your skill…"><br /><br /><input class="skill-level input-large" type="text" placeholder="Type your skill level"><input class="color" type="text" value="#e67e22,#d35400"><br /><br /><a class="remove-skill btn btn-danger">Remove skill</a><br /><br /><br /><br /><div style="border-bottom:1px solid #eee;margin-bottom: 30px;"></div></fieldset>';
					
					
					// A a new skillset
					jQuery(".new-skill").on('click', function() {
						jQuery("#skills-field").prepend(skillform);
						return false;
					});
					
					
					// Remove a skillset
					jQuery(".remove-skill").live('click', function() {
						jQuery(this).parent().remove();	
						
						getvalues();
						triggerdemo();
						
						return false;
					});
					
					
					jQuery( "#skills-field input" ).live('blur', function() {
						
						getvalues();
						triggerdemo();
					
					});
					
					setvalues();
					triggerdemo();
					
					jQuery('#skills-demo .zen-skillbar').live('click', function() {
						jQuery('#skills-demo .zen-skillbar').removeClass('active').addClass('inactive');
						jQuery(this).removeClass('inactive').addClass('active');
						jQuery('.minicolors').fadeIn();
						
						// `this` is the DOM element that was clicked
						  var index = jQuery( "#skills-demo .zen-skillbar" ).index( this ) + 1;
						  jQuery('#skills-field fieldset').removeClass('active');
						  jQuery('#skills-field fieldset:nth-child('+index+')').addClass('active');
				
					});
					
					
					jQuery('#jform_params_color').live('bind', function() {
						getcolors() 
						getvalues();
					});
					
					jQuery('#jform_params_color').live('blur', function() {
						getcolors() 
						getvalues();
					});
					
					jQuery('.minicolors span').live('click', function() {
						getcolors() 
						getvalues();
					});
					
					
					function setvalues() {
						
						jQuery('#skills-demo').empty();
						
						var skills = jQuery('#jform_params_skills').val();
						
						skills = skills.split('|');
						
						jQuery(skills).each(function( key, value) {
							if(value !=="") {
							
								var items = value.split(',');
								
								jQuery("#skills-field").append(
									'<fieldset><input type="text" class="skill input-large" placeholder="Type your skill…" value="'+ items[0] + '"><br /><br /><input class="skill-level input-large" type="text" placeholder="Type your skill level" value="' + items[1] + '"><input class="color" type="text" value="' + items[2] + ',' + items[3] + '"><br /><br /><a class="remove-skill btn btn-danger">Remove skill</a><br /><br /><br /><br /><div style="border-bottom:1px solid #eee;margin-bottom: 30px;"></div></fieldset>');
							}
						});

					}
					
					function getcolors() {
						var currentcolor = jQuery('#jform_params_color').val();
						var darker = ColorLuminance(currentcolor, -0.1)
						jQuery('#skills-demo .active .zen-skillbar-bar').css({'background-color':currentcolor});
						jQuery('#skills-demo .active .zen-skillbar-title').css({'background-color':darker});
						jQuery('#skills-demo .zen-skillbar').removeClass('active').removeClass('inactive');
						jQuery('fieldset.active .color').val(currentcolor + ','+ darker);
						jQuery('.minicolors').fadeOut();
					}
					
					
					function triggerdemo() {
						
						jQuery('#skills-demo').empty();
						
						var skills = jQuery('#jform_params_skills').val();
						
						skills = skills.split('|');
						
						jQuery(skills).each(function( key, value) {
							if(value !=="") {
							
								var items = value.split(',');		
									
								jQuery("#skills-demo").append('<div class="zen-skillbar clearfix " data-percent="'+ items[1] + '"><div class="zen-skillbar-title" style="background: '+ items[3]+'"><span>'+ items[0] + '</span></div><div class="zen-skillbar-bar" style="background:'+ items[2]+'"></div><div class="zen-skill-bar-percent">'+ items[1] + '</div></div> <!-- End Skill Bar -->');
								
							}
						});
						
						// Animate the bar
						jQuery('.zen-skillbar').each(function(){
								jQuery(this).find('.zen-skillbar-bar').animate({
									width:jQuery(this).attr('data-percent')
								},3000);
						});
					}
					
					function getvalues() {
						jQuery('#holder').html('');
						
						jQuery( "#skills-field input" ).each(function( index ) {
							
							var input = jQuery(this).val();
							
							jQuery('#holder').append(input);
							
							if(jQuery(this).hasClass('skill')) {
								jQuery('#holder').append(',');
							}
							
							if(jQuery(this).hasClass('skill-level')) {
								jQuery('#holder').append(',');
							}
							
							if(jQuery(this).hasClass('color')) {
								jQuery('#holder').append('|');
							}
						});
						
						jQuery('#jform_params_skills').val(jQuery('#holder').html());
					}
					
					
					function ColorLuminance(hex, lum) {
					
						// validate hex string
						hex = String(hex).replace(/[^0-9a-f]/gi, '');
						if (hex.length < 6) {
							hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
						}
						lum = lum || 0;
					
						// convert to decimal and change luminosity
						var rgb = "#", c, i;
						for (i = 0; i < 3; i++) {
							c = parseInt(hex.substr(i*2,2), 16);
							c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
							rgb += ("00"+c).substr(c.length);
						}
					
						return rgb;
					}

				});
			</script>
			
			<style>
			
			.minicolors,
			input.color,
			#jform_params_skills,
			#jform_params_skills-lbl,
			#holder {
				display: none;
			}
			
			.zen-skillbar {
				position:relative;
				display:block;
				margin-bottom:15px;
				width:100%;
				background:#eee;
				height:35px;
				border-radius:3px;
				-moz-border-radius:3px;
				-webkit-border-radius:3px;
				-webkit-transition:0.4s linear;
				-moz-transition:0.4s linear;
				-ms-transition:0.4s linear;
				-o-transition:0.4s linear;
				transition:0.4s linear;
				-webkit-transition-property:width, background-color;
				-moz-transition-property:width, background-color;
				-ms-transition-property:width, background-color;
				-o-transition-property:width, background-color;
				transition-property:width, background-color;
				cursor: pointer;
			}
			
			.zen-skillbar.active {
				opacity: 1;
			}
			
			.zen-skillbar.inactive {
				opacity: 0.6;
			}
			
			.zen-skillbar-title {
				position:absolute;
				top:0;
				left:0;
				opacity: 1.0;
			width:110px;
				font-weight:bold;
				font-size:13px;
				color:#ffffff;
				background:#6adcfa;
				-webkit-border-top-left-radius:3px;
				-webkit-border-bottom-left-radius:4px;
				-moz-border-radius-topleft:3px;
				-moz-border-radius-bottomleft:3px;
				border-top-left-radius:3px;
				border-bottom-left-radius:3px;
			}
			
			.zen-skillbar-title span {
				display:block;
				background:rgba(0, 0, 0, 0.1);
				padding:0 20px;
				height:35px;
				line-height:35px;
				-webkit-border-top-left-radius:3px;
				-webkit-border-bottom-left-radius:3px;
				-moz-border-radius-topleft:3px;
				-moz-border-radius-bottomleft:3px;
				border-top-left-radius:3px;
				border-bottom-left-radius:3px;
			}
			
			.zen-skillbar-bar {
				height:35px;
				width:0px;
				background:#6adcfa;
				border-radius:3px;
				-moz-border-radius:3px;
				-webkit-border-radius:3px;
			}
			
			.zen-skill-bar-percent {
				position:absolute;
				right:10px;
				top:0;
				font-size:11px;
				height:35px;
				line-height:35px;
				color:#ffffff;
				color:rgba(0, 0, 0, 0.4);}
				</style>
			<?php

		return ob_get_clean();
	}
}
