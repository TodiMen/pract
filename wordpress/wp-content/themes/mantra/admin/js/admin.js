/*!
 * Admin js
 */

function media_upload( button_class) {
	if (!window.wp || !window.wp.media || !window.wp.media.editor || !window.wp.media.editor.send || !window.wp.media.editor.send.attachment) return;
    var _custom_media = true,
    _orig_send_attachment = wp.media.editor.send.attachment;
    jQuery('body').on('click',button_class, function(e) {
		uploadparent = jQuery(this).closest('div');
		var button_id ='#'+jQuery(this).attr('id');
		/* console.log(button_id); */
		var self = jQuery(button_id);
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = jQuery(button_id);
		/* var id = button.attr('id').replace('_button', ''); */
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media  ) {
				/* jQuery('.custom_media_id').val(attachment.id); */
				uploadparent.find('.slideimages').val(attachment.url);
				uploadparent.find('.imagebox').attr('src',attachment.url);
				/* jQuery('.custom_media_image').attr('src',attachment.url).css('display','block');   */
			} else {
				return _orig_send_attachment.apply( button_id, [props, attachment] );
			}
		}
		wp.media.editor.open(button);
		return false;
    });
}

jQuery(document).ready(function() {

	var uploadparent = 0;
	media_upload( '.upload_image_button' );

	// Show/hide slides
	jQuery('.slidetitle').click(function() {
		jQuery(this).next().toggle("fast");
	});

	// Jquery confim window on reset to defaults
	jQuery('#mantra_defaults').click( function() {
		if (!confirm('Reset Mantra Settings to Defaults?')) { return false; }
	});

	// Hide or show dimmensions
	jQuery('#mantra_dimselect').change(function() {
		if	(jQuery('#mantra_dimselect option:selected').val()=="Absolute") {
			jQuery('#relativedim').hide("normal");jQuery('#absolutedim').show("normal");
		} else {
			jQuery('#relativedim').show("normal");jQuery('#absolutedim').hide("normal");
		}
	});

	if (jQuery('#mantra_dimselect option:selected').val()=="Absolute") {
		jQuery('#relativedim').hide("normal");jQuery('#absolutedim').show("normal");}
	else {
		jQuery('#relativedim').show("normal");jQuery('#absolutedim').hide("normal");
	}


	// Hide or show slider settings
	jQuery('#mantra_slideType').change(function() {
		jQuery('.slideDivs').hide("normal");
		switch (jQuery('#mantra_slideType option:selected').val()) {

			case "Slider Shortcode" :
			jQuery('#sliderShortcode').show("normal");
			jQuery('#sliderParameters').hide("normal");
			break;

			case "Custom Slides" :
			jQuery('#sliderCustomSlides').show("normal");
			jQuery('#sliderParameters').show("normal");
			break;

			case "Latest Posts" :
			jQuery('#sliderLatestPosts').show("normal");
			jQuery('#sliderParameters').show("normal");
			break;

			case "Random Posts" :
			jQuery('#sliderRandomPosts').show("normal");
			jQuery('#sliderParameters').show("normal");
			break;

			case "Sticky Posts" :
			jQuery('#sliderStickyPosts').show("normal");
			jQuery('#sliderParameters').show("normal");
			break;

			case "Latest Posts from Category" :
			jQuery('#sliderLatestCateg').show("normal");
			jQuery('#sliderParameters').show("normal");
			break;

			case "Random Posts from Category" :
			jQuery('#sliderRandomCateg').show("normal");
			jQuery('#sliderParameters').show("normal");
			break;

			case "Specific Posts" :
			jQuery('#sliderSpecificPosts').show("normal");
			jQuery('#sliderParameters').show("normal");
			break;

		}//switch

	});//function

	jQuery('#mantra_slideType').trigger('change');

	//Slide type value
	$sliderNr = jQuery('#mantra_slideType').val();

	//Show category if a category type is selected
	if ($sliderNr=="Latest Posts from Category" || $sliderNr=="Random Posts from Category" )
			jQuery('#slider-category').show();
	else 	jQuery('#slider-category').hide();

	//Show number of slides if that's the case
	if ($sliderNr=="Latest Posts" || $sliderNr =="Random Posts" || $sliderNr =="Sticky Posts" ||  $sliderNr=="Latest Posts from Category" || $sliderNr=="Random Posts from Category" )
			jQuery('#slider-post-number').show();
	else 	jQuery('#slider-post-number').hide();

	//On change
	jQuery('#mantra_slideType').change(function(){
		$sliderNr=jQuery('#mantra_slideType').val();
	//Show category if a category type is selected
		if ($sliderNr=="Latest Posts from Category" || $sliderNr=="Random Posts from Category" )
				jQuery('#slider-category').show();
		else 	jQuery('#slider-category').hide();
	//Show number of slides if that's the case
		if ($sliderNr=="Latest Posts" || $sliderNr =="Random Posts" || $sliderNr =="Sticky Posts" || $sliderNr=="Latest Posts from Category" || $sliderNr=="Random Posts from Category" )
				jQuery('#slider-post-number').show();
		else 	jQuery('#slider-post-number').hide();
		 });//onchange funciton



	// Create accordion from existing settings table
	jQuery('.form-table').wrap('<div>');
	jQuery(function() {
		if (jQuery( "#accordion h2" ).length > 0) {
			// wordpress 4.4+ changed headings to h2
			jQuery( "#accordion" ).accordion({
					header: 'h2',
					heightStyle: "content",
					collapsible: true,
					navigation: true,
					active: false
				});
			} else {
			jQuery( "#accordion" ).accordion({
					header: 'h3',
					autoHeight: false, // for jQueryUI <1.10
					heightStyle: "content", // required in jQueryUI 1.10
					collapsible: true,
					navigation: true,
					active: false
				});
			}
	});

	if (vercomp(jQuery.ui.version,"1.9.0")) {
		// tooltip function is included since jQuery UI 1.9.0
		tooltip_terain();
		startfarb("#mantra_backcolor","#mantra_backcolor2");
		startfarb("#mantra_headercolor","#mantra_headercolor2");
		startfarb("#mantra_contentbg","#mantra_contentbg2");
		startfarb("#mantra_menubg","#mantra_menubg2");
		startfarb("#mantra_s1bg","#mantra_s1bg2");
		startfarb("#mantra_s2bg","#mantra_s2bg2");
		startfarb("#mantra_prefootercolor","#mantra_prefootercolor2");
		startfarb("#mantra_footercolor","#mantra_footercolor2");
		startfarb("#mantra_titlecolor","#mantra_titlecolor2");
		startfarb("#mantra_descriptioncolor","#mantra_descriptioncolor2");
		startfarb("#mantra_contentcolor","#mantra_contentcolor2");
		startfarb("#mantra_linkscolor","#mantra_linkscolor2");
		startfarb("#mantra_hovercolor","#mantra_hovercolor2");
		startfarb("#mantra_headtextcolor","#mantra_headtextcolor2");
		startfarb("#mantra_headtexthover","#mantra_headtexthover2");
		startfarb("#mantra_sideheadbackcolor","#mantra_sideheadbackcolor2");
		startfarb("#mantra_sideheadtextcolor","#mantra_sideheadtextcolor2");
		startfarb("#mantra_footerheader","#mantra_footerheader2");
		startfarb("#mantra_footertext","#mantra_footertext2");
		startfarb("#mantra_footerhover","#mantra_footerhover2");
		startfarb("#mantra_fpsliderbordercolor","#mantra_fpsliderbordercolor2");
		startfarb("#mantra_fronttitlecolor","#mantra_fronttitlecolor2");
	} else {
		jQuery("#mantra_backcolor").addClass('colorthingy');
		jQuery("#mantra_headercolor").addClass('colorthingy');
		jQuery("#mantra_contentbg").addClass('colorthingy');
		jQuery("#mantra_menubg").addClass('colorthingy');
		jQuery("#mantra_s1bg").addClass('colorthingy');
		jQuery("#mantra_s2bg").addClass('colorthingy');
		jQuery("#mantra_prefootercolor").addClass('colorthingy');
		jQuery("#mantra_footercolor").addClass('colorthingy');
		jQuery("#mantra_titlecolor").addClass('colorthingy');
		jQuery("#mantra_descriptioncolor").addClass('colorthingy');
		jQuery("#mantra_contentcolor").addClass('colorthingy');
		jQuery("#mantra_linkscolor").addClass('colorthingy');
		jQuery("#mantra_hovercolor").addClass('colorthingy');
		jQuery("#mantra_headtextcolor").addClass('colorthingy');
		jQuery("#mantra_sideheadbackcolor").addClass('colorthingy');
		jQuery("#mantra_sideheadtextcolor").addClass('colorthingy');
		jQuery("#mantra_footerheader").addClass('colorthingy');
		jQuery("#mantra_footertext").addClass('colorthingy');
		jQuery("#mantra_headtexthover").addClass('colorthingy');
		jQuery("#mantra_footerhover").addClass('colorthingy');
		jQuery("#mantra_fpsliderbordercolor").addClass('colorthingy');
		jQuery("#mantra_fronttitlecolor").addClass('colorthingy');
		jQuery('.colorthingy').each(function(){
			id = "#"+jQuery(this).attr('id');
			jQuery(this).on('keyup',function(){coloursel(this)});
			coloursel(this);
		});
		// inform the user about the old partially unsupported version
		jQuery("#jsAlert").after("<div class='updated fade' style='clear:left; font-size: 16px;'><p>Mantra has detected you are running an old version of Wordpress (jQuery) and will be running in compatibility mode. Some features may not work correctly. Consider updating your Wordpress to the latest version.</p></div>");
	}

	jQuery('#jsAlert').hide();

});// ready


function startfarb(a,b) {
	jQuery(b).css('display','none');
	jQuery(b).farbtastic(a);

	jQuery(a).click(function() {
			if(jQuery(b).css('display') == 'none')	{
                                        			jQuery(b).parents('.ui-accordion-content').addClass('ui-accordion-content-overflow');
                                                       jQuery(b).css('display','inline-block').hide().show(300);
                                                       }
		});

	jQuery(document).mousedown( function() {
			jQuery(b).hide(700, function(){ jQuery(b).parents('.ui-accordion-content').removeClass('ui-accordion-content-overflow'); });
			// todo: find a better way to remove class after the fade on IEs
		});
}

function tooltip_terain() {
	jQuery('#accordion small').parent('div').append('<a class="tooltip"><img src="'+mantra_tooltip_icon_url+'" /></a>').each(function() {
		var tooltip_info = jQuery(this).children('small').html();
		jQuery(this).children('.tooltip').tooltip({content : tooltip_info});
		jQuery(this).children('.tooltip').tooltip( "option", "items", "a" );
		jQuery(this).children('.tooltip').tooltip( "option", "hide", "false");
		jQuery(this).children('small').remove();
		if (!jQuery(this).hasClass('slmini') && !jQuery(this).hasClass('slidercontent') && !jQuery(this).hasClass('slideDivs')) jQuery(this).addClass('tooltip_div');
	});
}

function coloursel(el){
	var id = "#"+jQuery(el).attr('id');
	jQuery(id+"2").hide();
	var bgcolor = jQuery(id).val();
	if (bgcolor <= "#666666") { jQuery(id).css('color','#ffffff'); } else { jQuery(id).css('color','#000000'); };
	jQuery(id).css('background-color',jQuery(id).val());
}

function vercomp(ver, req) {
    var v = ver.split('.');
    var q = req.split('.');
    for (var i = 0; i < v.length; ++i) {
        if (q.length == i) { return true; } // v is bigger
        if (parseInt(v[i]) == parseInt(q[i])) { continue; } // nothing to do here, move along
        else if (parseInt(v[i]) > parseInt(q[i])) { return true; } // v is bigger
        else { return false; } // q is bigger
    }
    if (v.length != q.length) { return false; } // q is bigger
    return true; // v = q;
}

// Change border for selected inputs
function changeBorder(idName, className) {
	jQuery('.'+className).removeClass( 'checkedClass' );
	jQuery('.'+className).removeClass( 'borderful' );
	jQuery('#'+idName).addClass( 'borderful' );

	return 0;
}

/* FB like button */
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

/* Twitter follow button */
window.twttr = (function (d, s, id) {
  var t, js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src= "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
  return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });
}(document, "script", "twitter-wjs"));

/* FIN */
