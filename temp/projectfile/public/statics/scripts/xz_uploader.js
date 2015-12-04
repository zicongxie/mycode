var xz_uploader = {
	init: function(opts){
		var get_upload_url = "http://192.168.0.97:19110/uptoken";//获取的上传链接
		var upload_url = ""; // 上传链接

		var defaults = {
			selector: '',//上传按钮
			input_name: '',
			thumb_height: 90, //缩略图高度
			thumb_width: 90, //缩略图宽度
			label: '点击选择图片',
			multiple: true,//是否批量上传
			show: null,
			file_num_limit: 4,//文件数量限制
			file_val: 'img',//表单名
			callback: function(){}
		}

		$.extend(defaults,opts);
		opts = defaults;

		var opt = {
			thumb:{height:opts.thumb_height,width:opts.thumb_width,allowMagnify:false,crop: true},
			pick: {
				id: opts.selector,
				label: opts.label,
				multiple : opts.multiple
			},
			accept: {
				title: 'Images',
				extensions: 'gif,jpg,jpeg,bmp,png',
				mimeTypes: 'image/*'
			},
			swf: './js/Uploader.swf',
			chunked: true,
			server: 'fileupload.php',
			fileNumLimit: opts.file_num_limit,
			fileVal: opts.file_val
		};

		var uploader = WebUploader.create(opt);

		$(opts.selector).find('.webuploader-pick').css({
			width:opts.thumb_width,
			height:opts.thumb_height,
			lineHeight: opts.thumb_height+'px'
		});

		uploader.on('fileQueued', function(){
			$.getJSON(get_upload_url,function(data){
				if(data.code == 100){
					upload_url = data.upurl;
					uploader.options.server = data.upurl;

					if(opts.multiple){
						var img_con = $(opts.selector).closest('.img-ul').eq(0);
						var up_pre = ' <li class="newItem">'+
						'<div class="percent" style="float:left; width:'+opts.thumb_width+'px;height:'+opts.thumb_height+'px;border:1px dashed #569AEE; color:#569AEE; line-height:'+opts.thumb_height+'px; text-align:center;">0%</div></li>';
						$(up_pre).prependTo(img_con);
					}

					uploader.upload();
				}
			},'jsonp');
		});

      if(opts.multiple){

        uploader.on('uploadProgress', function(file,percent){
            $(opts.selector).closest('.img-ul').find('.percent').text(parseInt(percent*100)+'%');
        });

			uploader.on('uploadSuccess',function(f,r){
				var img_con = $(opts.seletor).closest('.img-ul');
            var delete_button = '<img src="statics/images/car_store/more_serial_cover_close.png" class="xzuploader-close" />';
				var li_inner = delete_button +'<img width="90" height="90" src="'+r.msg.url+'"><input type="hidden" name="'+opts.input_name+'" value="'+r.msg.url+'"/>';

				$(opts.selector).closest('.img-ul').find('.percent').closest('.newItem').eq(0).html(li_inner);
			});

			$images = $(opts.selector).closest('ul').find('.saved');
			$.each($images, function(){
				var uploaded_img_val = $(this).find('.uploaded-img').attr('data-img');
				//处理已上传图片
				if(uploaded_img_val){
					var uploaded_img_html = '<img src="statics/images/car_store/more_serial_cover_close.png" class="xzuploader-close" data-multi="1" />'+
					'<img width="'+opts.thumb_width+'" height="'+opts.thumb_height+'" src="'+uploaded_img_val+'">'+
					'<input type="hidden" name="'+opts.input_name+'" value="'+uploaded_img_val+'">';
					$(this).closest('li').prepend(uploaded_img_html);
				}

			})


      }

		//删除上传图片
		$(document).on('click','.xzuploader-close',function(){
			var isMultiple = parseInt($(this).attr('data-multi'));
			if(isMultiple){//是否多图上传
				$(this).closest('.newItem').remove();
			}else{
				var $newItem = $(this).closest('.newItem');
				$newItem.find('.uploaded-img').remove();//删除缩略图
				$newItem.find('input[type="hidden"]').remove();//删除表单值
				$(this).remove();//删除按钮
			}
		});


		if(opts.show && !opts.multiple){
			$upload_button = $(opts.selector);
			var uploaded_img_val = $upload_button.data('img') || false;

			//处理已上传图片
			if(uploaded_img_val){
				var uploaded_img_html = '<div class="uploaded-img" style=" position: absolute; top:-1px; left:-1px; z-index: 100; width: '+opts.thumb_width+'px; height: '+opts.thumb_height+'px; background-image: url('+uploaded_img_val+'); background-size: 100%;"></div>'+
				'<img data-multi="0" style="z-index:101" src="statics/images/car_store/more_serial_cover_close.png" class="xzuploader-close">'+
				'<input type="hidden" name="'+opts.input_name+'" value="'+uploaded_img_val+'">';

				$upload_button.prepend(uploaded_img_html);
			}

			//上传成功
			uploader.on('uploadSuccess',function(f,r){
				var $uploader_trigger = $(opts.selector).closest('li').find('div').eq(0);
            var delete_button = '<img data-multi="0" style="z-index:101" src="statics/images/car_store/more_serial_cover_close.png" class="xzuploader-close" />';
				var html =  $('<div class="uploaded-img" style="position:absolute;top:-1px; left:-1px;z-index:100;"></div>');

				$uploader_trigger.css('position','relative');
				html.css({
					'background-image':'url('+r.msg.url+')',
					'background-size':'100% auto',
					width: opts.thumb_width+'px',
					height: opts.thumb_height+'px'
				});
				$uploader_trigger.append(html);
				$uploader_trigger.append(delete_button);
				$uploader_trigger.append('<input type="hidden" name="'+opts.input_name+'" value="'+r.msg.url+'"/>');
			});

			// var percent_html = '<div class="percent" style="display:none; background:#fff;position:absolute;z-index:102; left:0; top:0; float:left;width:'+opts.thumb_width+'px;height:'+opts.thumb_height+'px;border:1px dashed #569AEE; color:#569AEE; line-height:'+opts.thumb_height+'px; text-align:center;">0%</div>';

			// $(opts.selector).closest('.newItem').append(percent_html);
			// $percent = $(opts.selector).closest('.newItem').find('.percent');

			uploader.on('uploadProgress', function(file,percent){
				var ptext = parseInt(percent*100)+'%';
				// $percent.text(ptext);
				$(opts.selector).find('.webuploader-pick').text(ptext);
				if(ptext != '100%'){
					// $(opts.selector).hide();
					// $percent.show();
				}else{
					$(opts.selector).find('.webuploader-pick').text(opts.label);
					// $(opts.selector).show();
					// $percent.hide();
				}
			});
		}

		return uploader;
	}
};
