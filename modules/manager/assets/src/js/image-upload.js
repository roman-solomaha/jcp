/**
 * Created by roman on 25.05.15.
 */
;
(function ($) {
    $.fn.imageUpload = function () {
        var args = arguments;
        var settings = {
            placeholder: 'http://lorempixel.com/300/300',
            extensions: ['gif', 'png', 'jpg', 'jpeg'],
            maxSize: 10,
            alt: ''
        };

        this.each(function(){
            var field = $(this);

            $.extend(settings, field.data());

            $.each(args, function () {
                if (typeof this === 'object') {
                    $.extend(settings, this);
                }
            });

            var error = [];

            var wrapper = wrapInput();

            var image = wrapper.find('img');

            var removeBtn = wrapper.find('.image-upload-remove');

            function wrapInput() {
                if(!field.parent().hasClass('image-upload-wrap')){
                    field.wrap('<span class="image-upload-wrap"></span>');
                    return field.parent()
                        .append('<img class="image-upload-img"/>',
                        '<button type="button" class="image-upload-remove" title="Remove image">&times;</button>');
                }
                return field.parent();
            }

            function createObjectURL(file) {
                if (window.URL && window.URL.createObjectURL) {
                    return window.URL.createObjectURL(file);
                } else if (window.webkitURL) {
                    return window.webkitURL.createObjectURL(file);
                }
                return false;
            }

            function errorHandler(message) {
                error.push(message);
                if (settings.error) {
                    console.error(error);
                    settings.error.apply(field, error);
                }
            }

            function clearResizeBlock(){
                wrapper.find('.resize-and-crop').remove();
                wrapper.append('<img class="image-upload-img"/>');
                image = wrapper.find('.image-upload-img');
                image.attr('alt', settings.alt);
                return image;
            }

            image.attr('alt', settings.alt);

            if (!settings.image) {
                settings.image = settings.placeholder;
            }

            image.attr('src', settings.image);

            field.on('change', function () {
                var file, blob;
                var ext = this.value.split('.').pop().toLowerCase();

                if ($.inArray(ext, settings.extensions) == -1) {
                    errorHandler('You can only select the picture with extension ' + settings.extensions);
                    return;
                }

                file = $(this).prop('files')[0];

                if (file.size > settings.maxSize * 1024 * 1024) {
                    errorHandler('The file must be less than ' + settings.maxSize + 'MB');
                    return;
                }

                blob = createObjectURL(file);

                if (!blob) {
                    errorHandler('Your browser is very old!');
                    return;
                }

                if(wrapper.find('.resize-and-crop').length > 0){
                    image = clearResizeBlock();
                }

                image.attr('src', blob);

                settings.update ? settings.update.apply(field, [field, image]) : false
            });

            removeBtn.on('click', function (event) {
                event.preventDefault();
                if(wrapper.find('.resize-and-crop').length > 0){
                    image = clearResizeBlock();
                }

                image.attr('src', settings.placeholder);

                field.wrap('<form>').closest('form').trigger('reset').children(':file').unwrap();
                $(settings.filename).val('');

                settings.remove ? settings.remove.apply(field, [field, image]) : false;
            });

            $.each(args, function () {
                if (typeof this === 'function') {
                    return this.apply(field, [field, image]);
                }
            });

            return field;
        });
    };
}(window.jQuery));