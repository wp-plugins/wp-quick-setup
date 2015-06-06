/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




$(document).ready(function () {

	$(document).ajaxComplete(function (event, xhr, settings) {
		if (xhr.status === 202) {
			$.notify("Saved successfully", {position: "right bottom", className: 'success'});
		}
//		else {
//			$.notify("Error!!! Please try again", {position: "right bottom"});
//		}
	});

	$('select').material_select();


	$('.do-quick-setup').click(function (e) {
		e.preventDefault();
		var form = $(this).closest('form');
		var validator = $('#preffered_domain').parsley();
		validator.validate();
		if(!validator.isValid())
			return;
		
		var checked = form.serializeArray();
		var formData = {'action': 'wes_perform_quick_setup'};
		$.each(checked, function (index, ele) {
			formData[ele.name] = ele.value;
		});
		var _this = this;
		$(_this).attr('disabled', 'disabled').text('Performaing action... Please wait...');
		$.post(ajaxurl, formData, function () {
			$(_this).removeAttr('disabled').text('Quick Setup');
		});
	});

	$('.select-all').click(function(event) {  //on click
        if(this.checked) { // check select status
            $(this).closest('form').find('[type="checkbox"]').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $(this).closest('form').find('[type="checkbox"]').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });


	var checkboxes = $('.expand-chechbox');
	checkboxes.change(function () {
		$(this).parent().next().slideToggle();
	});

	$('.create-blank-pages').click(function () {
		$('[name="blank_page_names"]').css('border-bottom', '1px solid #ccc')
		var pageNames = $('[name="blank_page_names"]').val();
		var pages = pageNames.split(',');
		if (pages[0] === "") {
			$('[name="blank_page_names"]').css('border-bottom', '1px solid red')
			return;
		}
		var _this = this;
		$(this).attr('disabled', 'true').text('Creating pages....');
		$.post(ajaxurl,
				{
					action: 'wes_create_blank_pages',
					page_names: pages
				},
		function () {
			$('[name="blank_page_names"]').val('');
			var span = $('&nbsp; <span style="color:green"><b>Done</b></span>');
			$(_this).removeAttr('disabled')
					.text('Create Blank Pages');
		});
	});

	$('.create-categories').click(function () {
		$('[name="categories_names"]').css('border-bottom', '1px solid #ccc')
		var categoriesNames = $('[name="categories_names"]').val();
		var categories = categoriesNames.split(',');
		if (categories[0] === "") {
			$('[name="categories_names"]').css('border-bottom', '1px solid red')
			return;
		}
		var _this = this;
		$(this).attr('disabled', 'true').text('Creating categories....');
		$.post(ajaxurl,
				{
					action: 'wes_create_categories',
					categories_names: categories
				},
		function () {
			$('[name="categories_names"]').val('');
			var span = $('&nbsp; <span style="color:green"><b>Done</b></span>');
			$(_this).removeAttr('disabled')
					.text('Create Categories');
		});
	});

	function install_plugin(plugins, index) {
		var plugin = plugins[index];
		var _this = this;
		var pName = $('#' + plugin.name).next().text();
		$(this).attr('disabled', 'true').text('Installing ' + pName + '... This might take time... Please Wait');
		$.post(ajaxurl,
				{
					action: 'wes_install_plugins',
					plugin_urls: [plugin.value]
				},
		function () {
			$(_this).removeAttr('disabled').text('Install');
			if(index === plugins.length - 1){
				$('[name="plugin_urls"]').val('');
			}
			if (index < plugins.length) {
				index++;
				install_plugin.call(_this, plugins, index);
			}
		});
	}
	
	function install_theme(themes, index) {
		var theme = themes[index];
		var _this = this;
		var pName = $('#' + theme.name).next().text();
		$(this).attr('disabled', 'true').text('Installing ' + pName + '... This might take time... Please Wait');
		$.post(ajaxurl,
				{
					action: 'wes_install_themes',
					theme_urls: [theme.value]
				},
		function () {
			$(_this).removeAttr('disabled').text('Install');
			if(index === themes.length - 1){
				$('[name="theme_urls"]').val('');
			}
			if (index < themes.length) {
				index++;
				install_theme.call(_this, themes, index);
			}
		});
	}

	$('.install-plugins').click(function (e) {
		e.preventDefault();
		var form = $(this).closest('form');
		var plugins = form.serializeArray();
		if(plugins.length > 0){
			install_plugin.call(this, plugins, 0);
		}
	});
	
	
	$('.install-plugin-from-url').click(function(){
		var validator = $('#install-plugins-checkbox').parsley();
		validator.validate();
		if(!validator.isValid()){
			return;
		}
		$('[name="plugin_urls"]').css('border-bottom', '1px solid #ccc')
		var pluginUrls = $('[name="plugin_urls"]').val();
		var pluginUrls = pluginUrls.split(',');
		var plugins = []
		$.each(pluginUrls, function(index, url){
			var _name = url.split('/').pop();
			plugins.push({
				name : _name,
				value : url
			});
		});
		install_plugin.call(this, plugins, 0);
	});
	
	
	$('.install-theme-from-url').click(function(){
		var validator = $('#install-themes-checkbox').parsley();
		validator.validate();
		if(!validator.isValid()){
			return;
		}
		var themes = [];
		var themeUrls = $('[name="theme_urls"]').val();
		var themeUrls = themeUrls.split(',');
		$.each(themeUrls, function(index, url){
			var _name = url.split('/').pop();
			themes.push({
				name : _name,
				value : url
			});
		});
		install_theme.call(this, themes, 0);
	})

	$('.save-timezone').click(function () {
		var timeZoneString = $('#juqs_timezone_string').val();
		var UTC = $('#juqs_gmt_offset').val();
		if (timeZoneString === '' && UTC === '') {
			return;
		}

		$.post(ajaxurl, {
			action: 'wes_save_timezone',
			timezone_string: timeZoneString,
			utc: UTC
		}, function () {

		})
	});

	$('.save-front-page').click(function () {
		var showOnFront = $("input[name=show_on_front]:checked").val();
		var pageOnFront = $('[name="page_on_front"]').val();
		var pageForPosts = $('[name="page_for_posts"]').val();
		var rssUseExcerpt = $('[name="rss_use_excerpt"]:checked').val();
		if (showOnFront === 'page' && OnFront == 0 && pageForPosts == 0) {
			return;
		}

		$.post(ajaxurl, {
			action: 'wes_save_front_page',
			show_on_front: showOnFront,
			page_on_front: pageOnFront,
			page_for_posts: pageForPosts,
			rss_use_excerpt : rssUseExcerpt
		}, function () {

		})
	});
	
	$('.save-dateformat').click(function () {
		var dateFormat = $("input[name=date_format]:checked").val();
		if(dateFormat === 'custom'){
			dateFormat = $('[name="date_format_custom"]').val();
		}
		
		var timeFormat = $("input[name=time_format]:checked").val();
		if(timeFormat === 'custom'){
			timeFormat = $('[name="time_format_custom"]').val();
		}
		
		$.post(ajaxurl, {
			action: 'wes_save_date_time_format',
			date_format : dateFormat,
			time_format : timeFormat
		})
	})

	$("input[name='date_format']").click(function () {
		if ("date_format_custom_radio" != $(this).attr("id"))
			$("input[name='date_format_custom']").val($(this).val()).siblings('.example').text($(this).next('label').text());
	});
	$("input[name='date_format_custom']").focus(function () {
		$('#date_format_custom_radio').prop('checked', true);
	});

	$("input[name='time_format']").click(function () {
		if ("time_format_custom_radio" != $(this).attr("id"))
			$("input[name='time_format_custom']").val($(this).val()).siblings('.example').text($(this).next('label').text());
	});
	$("input[name='time_format_custom']").focus(function () {
		$('#time_format_custom_radio').prop('checked', true);
	});
	$("input[name='date_format_custom'], input[name='time_format_custom']").change(function () {
		var format = $(this);
		format.siblings('.spinner').addClass('is-active');
		$.post(ajaxurl, {
			action: 'date_format_custom' == format.attr('name') ? 'date_format' : 'time_format',
			date: format.val()
		}, function (d) {
			format.siblings('.spinner').removeClass('is-active');
			format.siblings('.example').text(d);
		});
	});

	if ($("input[name=show_on_front]:checked").val() == "posts") {
		$("#page_on_front").attr("disabled", "disabled");
		$("#page_for_posts").attr("disabled", "disabled");
	}
	if ($("input[name=show_on_front]:checked").val() == "page") {
		$("#page_on_front").removeAttr("disabled");
		$("#page_for_posts").removeAttr("disabled");
	}
	$("input[name=show_on_front]").change(function () {
		if ($("input[name=show_on_front]:checked").val() == "posts") {
			$("#page_on_front").attr("disabled", "disabled");
			$("#page_for_posts").attr("disabled", "disabled");
		}
		if ($("input[name=show_on_front]:checked").val() == "page") {
			$("#page_on_front").removeAttr("disabled");
			$("#page_for_posts").removeAttr("disabled");
		}
	});
});