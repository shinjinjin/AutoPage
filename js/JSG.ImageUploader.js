var JSG = JSG || {};

JSG.imgUploader = function (config) {

    //default config
    var defConfig = {
        fileLimits: 1, //圖檔數量的限制 (-1 是不限制)
        actionUrl: null, //圖檔上傳的處理程式
        delUrl: null,
        fileInputName: 'myfile', //檔案輸入框的名稱
        inputContainer: null, //檔案輸入框的放置位置
        previewContainer: null, //預覽圖檔的放置位置
        hideInputIfReachLimits: true, //達到檔案數量限制時是否隱藏輸入框，若否，則採用 disable
        confirmDeleteMsg: '確認刪除?',
        previewClass: 'JSGImgPreview',
        elementPrefix: 'JSGImgUploader',
        loadingIcon: 'js/upload/images/loading_indicator_big.gif',
        deleteIcon: 'js/upload/images/icon_delete.gif',
        outputDelimiter: ',',
        existImages: '',
        uniqueId: null
    };
    config = $.extend(defConfig, config);

    //check containers
    config.inputContainer = $('#' + config.inputContainer);
    if (config.inputContainer.length == 0) {
        alert('Input container not exist!');
        return null;
    }
    config.previewContainer = $('#' + config.previewContainer);
    if (config.previewContainer.length == 0) {
        alert('Preview container not exist!');
        return null;
    }

    //generate unique id
    while (config.uniqueId == null) {
        var tmpId = parseInt(Math.random() * 10000, 10);
        if ($('#' + tmpId + '_form1').length == 0)
            config.uniqueId = tmpId;
    }

    var currentFileCount = 0;
    var currentFormCount = 0;
    var currentFormId = null;
    var files = [];
    /*
files = [
{
available: true,
ready: false,
filename: ''
},
{
available: false, //deleted
ready: true,
filename: '1.jpg'
}
];
*/

    //initial exist images
    if (config.existImages != '') {
        var existImages = config.existImages.split(config.outputDelimiter);
        currentFileCount = currentFormCount = existImages.length;
        for (var i = 0; i < currentFileCount; ++i) {
            files.push({
                available: true,
                ready: true,
                filename: existImages[i]
            });
            generatePreview(i + 1);

            (function () {
                var fileseq = i;
                var $deleteIcon = $('<img src="' + existImages[i] + '" width="160" height="120" /><div style="position: absolute; right: 0; top: 0; cursor: pointer"><img src="' + config.deleteIcon + '" /></div>')
                    .click(function () {
						
						
						
                            //remove uploaded file
                            delete_image(files[fileseq].filename);
                            files[fileseq].available = false;
                            --currentFileCount;
                            $(this).parent().fadeOut();
                            toggleInputLimits();

						
						
						
/*                        if (confirm(config.confirmDeleteMsg)) {
                            //remove uploaded file
                            delete_image(files[fileseq].filename);
                            files[fileseq].available = false;
                            --currentFileCount;
                            $(this).parent().fadeOut();
                            toggleInputLimits();

                        }
*/                    });
                //' + existImages[i] + '
                var elmId = config.elementPrefix + config.uniqueId + '_preview' + (i + 1);
                $('#' + elmId)
                    .css('backgroundImage', 'url()')
                    .append($deleteIcon);
            })();
        }
        toggleInputLimits();
    }

    function toggleInputLimits() {
        if (config.fileLimits == -1 || (currentFileCount < config.fileLimits)) {
            if (config.hideInputIfReachLimits) {
                $('#' + currentFormId).show();
            } else {
                $('#' + currentFormId).children('input').attr('disabled', false);
            }
        } else {
            if (config.hideInputIfReachLimits) {
                $('#' + currentFormId).hide();
            } else {
                $('#' + currentFormId).children('input').attr('disabled', true);
            }
        }
    }

    function generatePreview(cnt) {
        var elmId = config.elementPrefix + config.uniqueId + '_preview' + cnt;

        $('<div class="' + config.previewClass + '" id="' + elmId + '" style="position: relative;"></div>')

        .css('backgroundImage', 'url(' + config.loadingIcon + ')')
            .appendTo(config.previewContainer);
    }

    function delete_image(imgname) {
        $.ajax({
            url: config.delUrl + imgname,
            type: 'GET',
            dataType: 'json',
            error: function () {
                alert('delete image Error');
            },
//            success: function (data) {
//                  if ('success' in data ) {
//				if ('success' in data)
//					alert(data.success);  ////改過
//				}
//            }

        });
    }

    (function generateNewInput() {
        var uploadHandler = function () {
            files.push({
                available: true,
                ready: false,
                filename: ''
            });

            var _seqid = parseInt($(this).attr('seqid'), 10);
            var handleUploadSuccess = function (data) {
                var fileseq = _seqid - 1;
                var elmId = config.elementPrefix + config.uniqueId + '_preview' + _seqid;
                files[fileseq].ready = true;

                //error
                if ('error' in data || !('success' in data)) {
                    if ('error' in data)
                        alert(data.error);
                    else
                        alert('unknow error!');

                    files[fileseq].available = false;
                    --currentFileCount;
                    $('#' + elmId).fadeOut();
                    toggleInputLimits();
                    return;
                }

                files[fileseq].filename = data.success;
                var w = 160;
                var h = 120;

                var img = new Image();
                img.src = data.success;
                var w1 = img.width;
                var h1 = img.height;
                //alert(data.success);
                //alert(img.width);
                /*      if(img.width >0 && img.height>0)
{
  if(img.width/img.height >= w/h)
  {
		  if(img.width > w)
		  {
				  w1 = w;
				  h1 = (img.height*w) / img.width;
		  }
		  else
		  {
				  w1 = img.width;
				  h1 = img.height;
		  }
		   
		  }
		  else
		  {
		  if(img.height > h)
		  {
				  h1 = h;
				  w1 = (img.width * h) / img.height;
		  }
		  else
		  {
				  w1 = img.width;
				  h1 = img.height;
		  }
  }
}
 
*/

                w1 = 160;
                h1 = 120;

                var len1 = files.length;
                var filenames1 = [];
                for (var i = 0; i < len1; ++i)
                    if (files[i].available == true && files[i].ready == true)
                        filenames1.push(files[i].filename);
                filenames1.join(config.outputDelimiter);
                $('#resultGetFiles').html('<input type="hidden" value="' + filenames1.join(config.outputDelimiter) + '" name="imgarrar">');
                var $deleteIcon = $('<img src="' + data.success + '" width="' + Math.floor(w1) + '" height="' + Math.floor(h1) + '" /><div style="position: absolute; right: 0; top: 0; cursor: pointer"><img src="' + config.deleteIcon + '" /></div>')
                    .click(function () {
						
                            //remove uploaded file
                            files[fileseq].available = false;
                            --currentFileCount;
                            $(this).parent().fadeOut();
                            toggleInputLimits();
                            delete_image(data.success);
                            var len2 = files.length;
                            var filenames2 = [];
                            for (var i = 0; i < len2; ++i)
                                if (files[i].available == true && files[i].ready == true) {
                                    filenames2.push(files[i].filename);

                                }

                            filenames2.join(config.outputDelimiter);
                            $('#resultGetFiles').html('<input type="hidden" value="' + filenames2.join(config.outputDelimiter) + '" name="imgarrar">');
						
/*                        if (confirm(config.confirmDeleteMsg)) 
						{

                            //remove uploaded file
                            files[fileseq].available = false;
                            --currentFileCount;
                            $(this).parent().fadeOut();
                            toggleInputLimits();
                            delete_image(data.success);
                            var len2 = files.length;
                            var filenames2 = [];
                            for (var i = 0; i < len2; ++i)
                                if (files[i].available == true && files[i].ready == true) {
                                    filenames2.push(files[i].filename);

                                }

                            filenames2.join(config.outputDelimiter);
                            $('#resultGetFiles').html('<input type="hidden" value="' + filenames2.join(config.outputDelimiter) + '" name="imgarrar">');
                        }
*/						
						
						
						
						
						
                    });
                $('#' + elmId)
                //  .css('backgroundImage', 'url(' + data.success + ')')
                //.append($deleteIcon);
                .css('backgroundImage', 'url()')
                    .append($deleteIcon);
            }; //end of handleUploadSuccess

            $(this).parent().ajaxSubmit({
                success: handleUploadSuccess,
                dataType: 'json'
            });
            ++currentFileCount;
            generatePreview(currentFormCount);
            generateNewInput();
            toggleInputLimits();
        }; //end of uploadHandler

        var preFormId = config.elementPrefix + config.uniqueId + '_form' + currentFormCount;
        $('#' + preFormId).hide();

        ++currentFormCount;
        currentFormId = config.elementPrefix + config.uniqueId + '_form' + currentFormCount;
        var currentInputId = config.elementPrefix + config.uniqueId + '_input' + currentFormCount;
        var $fileInput = $('<input type="file" id="' + currentInputId + '" name="' + config.fileInputName + '" multiple />')
            .change(uploadHandler)
            .attr('seqid', currentFormCount);

        $('<form id="' + currentFormId + '" action="' + config.actionUrl + '" method="POST" enctype="multipart/form-data" style="margin:0; display: inline"></form>')
            .append($fileInput)
            .appendTo(config.inputContainer);
        toggleInputLimits();
    }());

    //public functions
    return {
        isReady: function () {
            var len = files.length;
            for (var i = 0; i < len; ++i)
                if (files[i].available == true && files[i].ready == false)
                    return false;
            return true;
        },
        getFiles: function () {
            var len = files.length;
            var filenames = [];
            for (var i = 0; i < len; ++i)
                if (files[i].available == true && files[i].ready == true)
                    filenames.push(files[i].filename);
            return filenames.join(config.outputDelimiter);
        }
    };

};